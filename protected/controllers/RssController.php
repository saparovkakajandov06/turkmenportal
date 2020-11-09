<?php

class RssController extends Controller
{


    public function actionIndex()
    {
        Yii::import('ext.feed.*');
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');

        // RSS 2.0 is the default type
        $feed = new EFeed();
        $feed->title = 'Новости Туркменистана - ' . Yii::app()->name;
        $feed->description = 'Cамые последнии новости, столичные афиши, эксклюзивные фоторепортажи о последних событиях и много интересного о Туркменистане. Приглашайте друзей и знакомых... Мы всем вам будем рады!';
//            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
//            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');

        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', Yii::app()->getBaseUrl(true) . '/rss');

        // * self reference
//            $feed->addChannelTag('atom:link','http://www.ramirezcobos.com/rss/');
        // Load all tables of the application in the schema
//            Yii::app()->db->schema->getTables();
//            // clear the cache of all loaded tables
//            Yii::app()->db->schema->refresh();

//            Yii::app()->db->schema->getTable('tablename', true);

        $blogs = Blog::model()->enabled()->not_translated()->not_photoreport()->rss()->sort_newest()->findAll(
            array(
                "limit" => 30,
                'order' => 'id desc',
            )
        );

        foreach ($blogs as $blog) {
//                $categoryModel=$blog->getMixedCategoryModel();
//                $categoryModel=$blog->category;
//                if(isset($categoryModel) && $categoryModel->id==25)
//                    continue;


            $item = $feed->createNewItem();
//            $item->title = $blog->title_ru . ' - ' . $blog->getUrl(true);
            $item->title = $blog->title_ru;
            $item->link = $blog->getUrl();
            $item->date = $this->dateToW3C($blog->date_added);
            $item->addTag('guid', trim($blog->getUrl()), array('isPermaLink' => 'true'));


            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $blog->text_ru);
            $item->description = Yii::app()->controller->truncate(strip_tags($full_text), 25, 300);

            $full_text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $full_text);
            $item->addTag('content:encoded', $full_text);

            $document = $blog->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                    $path = Yii::app()->getBaseUrl(true) . $path;
                        $type = image_type_to_mime_type(exif_imagetype($path));
                        $imgsize = filesize($uploadfolder . "/" . trim($document->path, '/'));
                        list($width, $height) = getimagesize($uploadfolder . "/" . trim($document->path, '/'));

                        $item->setEncloser($path, $imgsize, $type);
                        $item->addTag('media:content', null,
                            array(
                                'url' => $path,
                                'type' => $type,
                                'expression' => "full",
                                'width' => "$width",
                                'height' => "$height",
                            ));


                    } catch (Exception $e) {
                    $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

//                $item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');
//                $item->addTag('content', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('image', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', 'http://www.ramirezcobos.com/',array('isPermaLink'=>'true'));
            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }

    public function dateToW3C($date)
    {
        if (is_int($date))
            return date(DATE_W3C, $date);
        else
            return date(DATE_W3C, strtotime($date));
    }

    public function actionTm()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();

        $feed->title = 'Turkmenportal Habarlary - Turkmenportal.com';
        $feed->description = 'Türkmenistanda bolup geçýän iň soňky wakalar, täzelikler we habarlar';

//            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
//            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');

        $feed->addChannelTag('language', 'tk-TM');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://www.turkmenportal.com/rss/tm');

        // * self reference
//            $feed->addChannelTag('atom:link','http://www.ramirezcobos.com/rss/');

        $blogs = Blog::model()->enabled()->translated()->sort_newest()->findAll(
            array(
                "limit" => 30,
            )
        );

        foreach ($blogs as $blog) {
//                $categoryModel=$blog->category;
//                if(isset($categoryModel) && $categoryModel->id==25)
//                    continue;

            $item = $feed->createNewItem();
            $url = $blog->getTmUrl();
//            $item->title = $blog->title_tm . ' - ' . $url;
            $item->title = $blog->title_tm . ' - ' . $url;
            $item->link = $url;
            $item->date = $this->dateToW3C($blog->date_added);
            $item->addTag('guid', trim($blog->id), array('isPermaLink' => 'false'));

//            $item->description = CHtml::image($blog->getThumbPath(530, 420, 'auto'), $blog->title_tm, array('align' => "left", 'hspace' => "5")) . Yii::app()->controller->truncate($blog->text_tm, 25, 300);

            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $blog->text_tm);
            $item->description = Yii::app()->controller->truncate(strip_tags($full_text), 25, 300);


            $document = $blog->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $item->setEncloser($path, null, image_type_to_mime_type(exif_imagetype($path)));
                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

//                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', 'http://www.ramirezcobos.com/',array('isPermaLink'=>'true'));
            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }

    public function actionEn()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');

        $feed->title = 'Turkmenportal News - Turkmenportal.com';
        $feed->description = 'Latest events and news in Türkmenistan';

//            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
//            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');

        $feed->addChannelTag('language', 'en');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://www.turkmenportal.com/rss/en');

        // * self reference
//            $feed->addChannelTag('atom:link','http://www.ramirezcobos.com/rss/');

        $blogs = Blog::model()->enabled()->translated_en()->not_photoreport()->sort_newest()->findAll(
            array(
                "limit" => 30,
            )
        );

        foreach ($blogs as $blog) {
//                $categoryModel=$blog->category;
//                if(isset($categoryModel) && $categoryModel->id==25)
//                    continue;

            $item = $feed->createNewItem();
            $url = $blog->getEnUrl();
//            $item->title = $blog->title_tm . ' - ' . $url;
//            $item->title = $blog->title_en . ' - ' . $url;
            $item->title = $blog->title_en;
            $item->link = $url;
            $item->date = $this->dateToW3C($blog->date_added);
            $item->addTag('guid', trim($url), array('isPermaLink' => 'true'));

            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $blog->text_en);
            $item->description = Yii::app()->controller->truncate(strip_tags($full_text), 25, 300);

            $full_text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $full_text);
            $item->addTag('content:encoded', $full_text);


            $document = $blog->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $type = image_type_to_mime_type(exif_imagetype($path));
                        $imgsize = filesize($uploadfolder . "/" . trim($document->path, '/'));
                        list($width, $height) = getimagesize($uploadfolder . "/" . trim($document->path, '/'));

                        $item->setEncloser($path, $imgsize, $type);
                        $item->addTag('media:content', null,
                            array(
                                'url' => $path,
                                'type' => $type,
                                'expression' => "full",
                                'width' => "$width",
                                'height' => "$height",
                            ));


                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

//                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', 'http://www.ramirezcobos.com/',array('isPermaLink'=>'true'));
            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }

    public function actionSport()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();

        $feed->title = 'Спорт Туркменистана - Turkmenportal.com';
        $feed->description = 'Все новости, достижения, статьи, обзоры спорта Туркменистана';

//            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
//            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');

        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://www.turkmenportal.com/rss/sport');

//            $feed->addChannelTag('atom:link','http://www.ramirezcobos.com/rss/');

        $criteria = new CDbCriteria;
        $criteria->with = array("category");
        $criteria->together = true;
        $criteria->compare('category.alias_ru', 'sport');
        $criteria->scopes = array('enabled', 'not_translated', 'sort_newest');
        $criteria->limit = 30;
        $blogs = Blog::model()->cache(50)->findAll($criteria);

        foreach ($blogs as $blog) {
            $item = $feed->createNewItem();
//            $item->title = $blog->title_ru . ' - ' . $blog->getUrl();
            $item->title = $blog->title_ru;
            $item->link = $blog->getUrl();
            $item->date = $this->dateToW3C($blog->date_added);
            $item->addTag('guid', trim($blog->id), array('isPermaLink' => 'false'));

//            $item->description = CHtml::image($blog->getThumbPath(530, 420, 'auto'), $blog->title_ru, array('align' => "left", 'hspace' => "5")) . Yii::app()->controller->truncate($blog->text_ru, 25, 300);

            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $blog->text_ru);
            $item->description = Yii::app()->controller->truncate(strip_tags($full_text), 25, 300);

            $full_text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $full_text);
            $item->addTag('content:encoded', $full_text);


            $document = $blog->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $item->setEncloser($path, null, image_type_to_mime_type(exif_imagetype($path)));
                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

//                $item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');
//                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', 'http://www.ramirezcobos.com/',array('isPermaLink'=>'true'));
            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }

    public function actionSporttm()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();

        $feed->title = 'Türkmen Sport - Turkmenportal.com';
        $feed->description = 'Ähli Türkmen sportunyň tarapdarlary we janköýerleri barde!!!';

//            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
//            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');

        $feed->addChannelTag('language', 'tk-TM');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://www.turkmenportal.com/rss/sporttm');

//            $feed->addChannelTag('atom:link','http://www.ramirezcobos.com/rss/');

        $criteria = new CDbCriteria;
        $criteria->with = array("category");
//            $criteria->together=true;
        $criteria->compare('category.alias_tm', 'sport');
        $criteria->scopes = array('enabled', 'translated', 'sort_newest');
        $criteria->limit = 30;
        $blogs = Blog::model()->findAll($criteria);

        foreach ($blogs as $blog) {
            $item = $feed->createNewItem();
            $url = $blog->getTmUrl();
//            $item->title = $blog->title_tm . ' - ' . $url;
            $item->title = $blog->title_tm;
            $item->link = $url;
            $item->date = $this->dateToW3C($blog->date_added);
            $item->addTag('guid', trim($blog->id), array('isPermaLink' => 'false'));

//            $item->description = CHtml::image($blog->getThumbPath(530, 420, 'auto'), $blog->title_tm, array('align' => "left", 'hspace' => "5")) . Yii::app()->controller->truncate($blog->text_tm, 25, 300);
            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $blog->text_tm);
            $item->description = Yii::app()->controller->truncate(strip_tags($full_text), 25, 300);

            $full_text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $full_text);
            $item->addTag('content:encoded', $full_text);

            $document = $blog->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $item->setEncloser($path, null, image_type_to_mime_type(exif_imagetype($path)));
                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }
//                $item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');
//                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', 'http://www.ramirezcobos.com/',array('isPermaLink'=>'true'));
            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }

    public function actionComposition()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');

        $feed->title = 'Публикации Туркменпортала - ' . Yii::app()->name;
        $feed->description = 'Cамые последнии новости, столичные афиши, эксклюзивные фоторепортажи о последних событиях и много интересного о Туркменистане. Приглашайте друзей и знакомых... Мы всем вам будем рады!';

//            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
//            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');
        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', Yii::app()->getBaseUrl(true) . '/rss/composition');

        $compositions = Compositions::model()->enabled()->not_translated()->sort_newest()->findAll(
            array(
                "limit" => 30,
            )
        );

        foreach ($compositions as $composition) {
//                $categoryModel=$blog->category;
//                if(isset($categoryModel) && $categoryModel->id==25)
//                    continue;

            $item = $feed->createNewItem();
            $url = $composition->getUrl();
//            $item->title = $composition->title_ru . ' - ' . $url;
            $item->title = $composition->title_ru;
            $item->link = $url;
            $item->date = $this->dateToW3C($composition->date_added);
            $item->addTag('guid', trim($composition->id), array('isPermaLink' => 'false'));

//            $item->description = CHtml::image($composition->getThumbPath(530, 420, 'auto'), $composition->title_ru, array('align' => "left", 'hspace' => "5")) . Yii::app()->controller->truncate($composition->content_ru, 25, 300);
            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $composition->content_ru);
            $item->description = Yii::app()->controller->truncate(strip_tags($full_text), 25, 300);

            $full_text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $full_text);
            $item->addTag('content:encoded', $full_text);

            $document = $composition->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $type = image_type_to_mime_type(exif_imagetype($path));
                        $imgsize = filesize($uploadfolder . "/" . trim($document->path, '/'));
                        list($width, $height) = getimagesize($uploadfolder . "/" . trim($document->path, '/'));

                        $item->setEncloser($path, $imgsize, $type);
                        $item->addTag('media:content', null,
                            array(
                                'url' => $path,
                                'type' => $type,
                                'expression' => "full",
                                'width' => "$width",
                                'height' => "$height",
                            ));


                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

//                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', 'http://www.ramirezcobos.com/',array('isPermaLink'=>'true'));
            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }

    public function actionCompositionTm()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();

        $feed->title = 'Turkmenportal Makalalary- ' . Yii::app()->name;
        $feed->description = 'Türkmenistanda bolup geçýän iň soňky wakalar, täzelikler, habarlar we makalalar';

//            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
//            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');
        $feed->addChannelTag('language', 'tk-TM');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', Yii::app()->getBaseUrl(true) . '/rss/compositionTm');

        $compositions = Compositions::model()->enabled()->translated()->sort_newest()->findAll(
            array(
                "limit" => 30,
            )
        );

        foreach ($compositions as $composition) {
//                $categoryModel=$blog->category;
//                if(isset($categoryModel) && $categoryModel->id==25)
//                    continue;

            $item = $feed->createNewItem();
            $url = $composition->getTmUrl();
//            $item->title = $composition->title_ru . ' - ' . $url;
            $item->title = $composition->title_tm;
            $item->link = $url;
            $item->date = $this->dateToW3C($composition->date_added);
            $item->addTag('guid', trim($composition->id), array('isPermaLink' => 'false'));

//            $item->description = CHtml::image($composition->getThumbPath(530, 420, 'auto'), $composition->title_ru, array('align' => "left", 'hspace' => "5")) . Yii::app()->controller->truncate($composition->content_ru, 25, 300);
            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $composition->content_tm);
            $item->description = Yii::app()->controller->truncate(strip_tags($full_text), 25, 300);

            $full_text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $full_text);
            $item->addTag('content:encoded', $full_text);

            $document = $composition->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $item->setEncloser($path, null, image_type_to_mime_type(exif_imagetype($path)));
                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

//                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', 'http://www.ramirezcobos.com/',array('isPermaLink'=>'true'));
            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }

    public function actionPhotoreport()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();
        $feed->title = 'Фоторепортажи Туркменпортала - ' . Yii::app()->name;
        $feed->description = 'Cамые последнии новости, столичные афиши, эксклюзивные фоторепортажи о последних событиях и много интересного о Туркменистане. Приглашайте друзей и знакомых... Мы всем вам будем рады!';
        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', Yii::app()->getBaseUrl(true) . '/rss/photoreport');

        $modelCategory = Category::model()->no_parent()->findByAttributes(array('code' => 'photoreport'));
        $criteria = new CDbCriteria;
        $criteria->scopes = array('enabled', 'not_translated', 'rss', 'sort_newest');
        $criteria->compare('t.parent_category_id', $modelCategory->id);
        $criteria->limit = 30;

        $photoreports = Photoreport::model()->findAll($criteria);
        foreach ($photoreports as $photoreport) {
            $item = $feed->createNewItem();
            $item->title = $photoreport->title_ru;
            $item->link = $photoreport->getUrl(true);
            $item->date = $this->dateToW3C($photoreport->date_added);
            $item->addTag('guid', trim($photoreport->id), array('isPermaLink' => 'false'));


            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $photoreport->text_ru);
            $item->description = Yii::app()->controller->truncate(strip_tags($full_text), 25, 300);

            $full_text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $full_text);
            $item->addTag('content:encoded', $full_text);

            $document = $photoreport->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $item->setEncloser($path, null, image_type_to_mime_type(exif_imagetype($path)));
                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }



//        public function actionMobile()
//        {
//
//
//            Yii::import('ext.feed.*');
//            // RSS 2.0 is the default type
//            $feed = new EFeed();
//
//            $feed->title= 'Новости Туркменистана - Turkmenportal.com';
//            $feed->description = 'Cамые последнии новости, столичные афиши, эксклюзивные фоторепортажи о последних событиях и много интересного о Туркменистане. Приглашайте друзей и знакомых... Мы всем вам будем рады!';
//
////            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
////            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');
//
//            $feed->addChannelTag('language', 'ru-ru');
//            $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
//            $feed->addChannelTag('link', 'http://www.turkmenportal.com/rss' );
//
//            $blogs=array();
//            $blog_categories=  Category::model()->findAllByAttributes(array('status'=>'1','parent_id'=>282));
//            foreach ($blog_categories as $blog_category) {
//                $criteria=new CDbCriteria;
//                $criteria->with=array("categories");
//                $criteria->together=true;
//                $criteria->compare('categories.id', $blog_category->id);
//
//                if(isset($_GET['pubDate'])){
//                    $pubDate=$_GET['pubDate'];
//                    $criteria->addCondition('date_added>"'.$pubDate.'" OR date_modified>"'.$pubDate.'"');
//                }
//
//                $criteria->scopes=array('enabled','not_translated','sort_newest');
//                $criteria->limit=10;
//                $cat_blogs=Blog::model()->findAll($criteria);
//                foreach($cat_blogs as $c_blog){
//                    $blogs[]=$c_blog;
//                }
//            }
//
//
//
//
//            foreach ($blogs as $blog)
//            {
//                if(!isset($blog))
//                    continue;
//
//                $item = $feed->createNewItem();
//                $item->title = $blog->title_ru;
//                $item->link = $blog->getUrl(true);
//                $item->date = $this->dateToW3C($blog->date_added);
////                $item->description = CHtml::image($blog->getThumbPath(300,224,'auto'),$blog->title_ru,array('align'=>"left", 'hspace'=>"5")).Yii::app()->controller->truncate($blog->text_ru,25,300);
//                $item->description = $blog->description_ru;
////                $item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');
//
//                $item->addTag('title_short', Yii::app()->controller->truncate($blog->title_ru, 15,100));
//                $item->addTag('content', $blog->text_ru);
//                $item->addTag('image', $blog->getThumbPath(568,424,'h',true,false));
////                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', trim($blog->id));
////                $item->addTag('category', $blog->category->name_ru);
//                $item->addTag('category', $blog->getMixedCategoryModel()->getMixedName());
//                $item->addTag('category_id', $blog->getMixedCategoryModel()->id);
//                $item->addTag('type', 1);
//                $feed->addItem($item);
//            }
//
//
//            $compositionCategory=  Category::model()->findByPk(355);
//            $criteria=new CDbCriteria;
//            if(isset($_GET['pubDate'])){
//                $pubDate=$_GET['pubDate'];
//                $criteria->addCondition('date_added>"'.$pubDate.'" OR date_modified>"'.$pubDate.'"');
//            }
//
//            $criteria->addCondition('length(title_ru)>5');
//            $criteria->scopes=array('enabled','sort_newest');
//            $criteria->limit=15;
//            $compositions = Compositions::model()->findAll($criteria);
//
//
//            foreach ($compositions as $composition)
//            {
//                if(!isset($composition))
//                    continue;
//
//                $item = $feed->createNewItem();
//                $item->title = $composition->title_ru;
//                $item->link = $composition->getUrl(true);
//                $item->date = $this->dateToW3C($composition->date_added);
////                $item->description = CHtml::image($blog->getThumbPath(300,224,'auto'),$blog->title_ru,array('align'=>"left", 'hspace'=>"5")).Yii::app()->controller->truncate($blog->text_ru,25,300);
//                $item->description = $composition->title_ru;
////                $item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');
//
//                $item->addTag('title_short', Yii::app()->controller->truncate($composition->title_ru, 15,100));
//                $item->addTag('content', $composition->content_ru);
//                $item->addTag('image', $composition->getThumbPath(568,424,'h',true,false));
////                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', trim($composition->id));
////                $item->addTag('category', $blog->category->name_ru);
//                $item->addTag('category', $compositionCategory->getMixedName());
//                $item->addTag('category_id', $compositionCategory->id);
//                $item->addTag('type', 1);
//                $feed->addItem($item);
//            }
//
//
//
//
//
//            if(count($blogs)==0)
//            {
//                $item = $feed->createNewItem();
//                $feed->addItem($item);
////                Yii::app()->end();
//            }
//
//            $feed->generateFeed();
//            Yii::app()->end();
//
//        }

    public function actionPhotoreportTm()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();
        $feed->title = 'Fotoreportažlar - ' . Yii::app()->name;
        $feed->description = 'Türkmenistanda bolup geçýän iň soňky wakalar, täzelikler we habarlar';
        $feed->addChannelTag('language', 'tk-TM');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', Yii::app()->getBaseUrl(true) . '/rss/photoreportTm');

        $modelCategory = Category::model()->no_parent()->findByAttributes(array('code' => 'photoreport'));
        $criteria = new CDbCriteria;
        $criteria->scopes = array('enabled', 'translated', 'rss', 'sort_newest');
        $criteria->compare('t.parent_category_id', $modelCategory->id);
        $criteria->limit = 30;

        $photoreports = Photoreport::model()->findAll($criteria);
        foreach ($photoreports as $photoreport) {
            $item = $feed->createNewItem();
            $item->title = $photoreport->title_tm;
            $item->link = $photoreport->getTmUrl();
            $item->date = $this->dateToW3C($photoreport->date_added);
            $item->addTag('guid', trim($photoreport->id), array('isPermaLink' => 'false'));


            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $photoreport->text_tm);
            $item->description = Yii::app()->controller->truncate(strip_tags($full_text), 25, 300);

            $full_text = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $full_text);
            $item->addTag('content:encoded', $full_text);

            $document = $photoreport->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $item->setEncloser($path, null, image_type_to_mime_type(exif_imagetype($path)));
                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }
            $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();
    }

    public function actionYandex()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
        $feed->headerNamespaces = array(
            "xmlns:yandex" => "http://news.yandex.ru",
            "xmlns:media" => "http://search.yahoo.com/mrss/",
        );

        $feed->title = 'Новости Туркменистана - Turkmenportal.com';
        $feed->description = 'Cамые последнии новости, столичные афиши, эксклюзивные фоторепортажи о последних событиях и много интересного о Туркменистане. Приглашайте друзей и знакомых... Мы всем вам будем рады!';

//            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
//            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');

        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'https://turkmenportal.com/rss/yandex');
        $feed->addChannelTag('yandex:logo', 'http://turkmenportal.com/themes/turkmenportal/img/tp_logo180x180.png');
//            $feed->addChannelTag('yandex:logo  type="square"', 'http://turkmenportal.com/themes/turkmenportal/img/logo_ru.jpg' );


        $criteria = new CDbCriteria;
        $criteria->addCondition('t.date_modified > ' . strtotime('-1 week'));
        $criteria->scopes = array('enabled', 'rss', 'not_translated', 'sort_newest', 'not_photoreport');
        $criteria->limit = 40;
        $blogs = Blog::model()->findAll($criteria);


        foreach ($blogs as $blog) {
            if (!isset($blog))
                continue;

            $item = $feed->createNewItem();
            $item->title = $blog->title_ru;
            $item->link = $blog->getUrl(true);
            $item->date = $this->dateToW3C($blog->date_added);
            $item->addTag('guid', trim($blog->id), array('isPermaLink' => 'false'));

//                $item->description = CHtml::image($blog->getThumbPath(300,224,'auto'),$blog->title_ru,array('align'=>"left", 'hspace'=>"5")).Yii::app()->controller->truncate($blog->text_ru,25,300);
            $item->description = $blog->description_ru;
            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $blog->text_ru);
            $item->addTag('yandex:full-text', strip_tags($full_text));

            $item->addTag('yandex:genre', "message");
            $categoryModel = $blog->category;
            if (isset($categoryModel))
                $item->addTag('category', $categoryModel->name);
//
            $document = $blog->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $type = image_type_to_mime_type(exif_imagetype($path));
                        $imgsize = filesize($uploadfolder . "/" . trim($document->path, '/'));
                        list($width, $height) = getimagesize($uploadfolder . "/" . trim($document->path, '/'));

                        $item->setEncloser($path, $imgsize, $type);
                        $item->addTag('media:content', null,
                            array(
                                'url' => $path,
                                'type' => $type,
                                'expression' => "full",
                                'width' => "$width",
                                'height' => "$height",
                            ));


                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

            if (strlen($blog->text_ru) > 20)
                $feed->addItem($item);
        }


        $criteria = new CDbCriteria;
        $criteria->addCondition('t.date_modified > ' . strtotime('-1 week'));
        $criteria->scopes = array('enabled', 'rss', 'not_translated', 'sort_newest');
        $criteria->limit = 40;
        $compositions = Compositions::model()->findAll($criteria);


        foreach ($compositions as $composition) {
            if (!isset($composition))
                continue;

            $item = $feed->createNewItem();
            $item->title = $composition->title_ru;
            $item->link = $composition->getUrl(true);
            $item->date = $this->dateToW3C($composition->date_added);
            $item->addTag('guid', trim($composition->id), array('isPermaLink' => 'false'));

//                $item->description = CHtml::image($composition->getThumbPath(300,224,'auto'),$composition->title_ru,array('align'=>"left", 'hspace'=>"5")).Yii::app()->controller->truncate($composition->text_ru,25,300);
//                $item->description = $composition->description_ru;
//                $item->setEncloser('http://www.tester.com', '1283629', 'audio/mpeg');
            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $composition->content_ru);
            $item->addTag('yandex:full-text', strip_tags($full_text));

            $item->addTag('yandex:genre', "article");
            $categoryModel = $composition->category;
            if (isset($categoryModel))
                $item->addTag('category', $categoryModel->name);

            $document = $composition->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $item->setEncloser($path, null, image_type_to_mime_type(exif_imagetype($path)));
                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

//
//                $item->addTag('description', Yii::app()->controller->truncate($composition->title_ru, 15,100));
//                $item->addTag('image', $composition->getThumbPath(568,424,'h',true,false));
////                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
//                $item->addTag('guid', trim($composition->id));

            if (strlen($composition->content_ru) > 20)
                $feed->addItem($item);
        }


        $feed->generateFeed("yandex");
        Yii::app()->end();
    }

    public function actionRambler()
    {


        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();
        $feed->headerNamespaces = array(
            "xmlns:rambler" => "http://news.rambler.ru"
        );

        $feed->title = 'Новости Туркменистана - Turkmenportal.com';
        $feed->description = 'Cамые последнии новости, столичные афиши, эксклюзивные фоторепортажи о последних событиях и много интересного о Туркменистане. Приглашайте друзей и знакомых... Мы всем вам будем рады!';

//            $feed->setImage('Testing RSS 2.0 EFeed class','http://www.ramirezcobos.com/rss',
//            'http://www.yiiframework.com/forum/uploads/profile/photo-7106.jpg');

        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://turkmenportal.com/rss/rambler');


        $criteria = new CDbCriteria;
//            $criteria->with=array("categories");
//            $criteria->together=true;
        $criteria->addCondition('t.date_modified > ' . strtotime('-1 week'));
        $criteria->scopes = array('enabled', 'rss', 'not_translated', 'sort_newest', 'not_photoreport');
        $criteria->limit = 40;
        $blogs = Blog::model()->findAll($criteria);


        foreach ($blogs as $blog) {
            if (!isset($blog))
                continue;

            $item = $feed->createNewItem();
            $item->title = $blog->title_ru;
            $item->link = $blog->getUrl(true);
            $item->date = $this->dateToW3C($blog->date_added);
            $item->addTag('guid', trim($blog->id), array('isPermaLink' => 'false'));

//                $item->description = CHtml::image($blog->getThumbPath(300,224,'auto'),$blog->title_ru,array('align'=>"left", 'hspace'=>"5")).Yii::app()->controller->truncate($blog->text_ru,25,300);
            $item->description = $blog->description_ru;
            $full_text = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $blog->text_ru);
            $item->addTag('rambler:full-text', strip_tags($full_text));

            $categoryModel = $blog->category;
            if (isset($categoryModel))
                $item->addTag('category', $categoryModel->name);

            $document = $blog->getDocument();
            if (isset($document)) {
                $path = $document->getRealPath();
                if (isset($path) && strlen(trim($path)) > 5) {
                    try {
                        $path = Yii::app()->getBaseUrl(true) . $path;
                        $item->setEncloser($path, null, image_type_to_mime_type(exif_imagetype($path)));
                    } catch (Exception $e) {
                        $item->setEncloser($path, null, 'image/jpeg');
                    }
                }
            }

//                $item->addTag('description', Yii::app()->controller->truncate($blog->title_ru, 15,100));
//                $item->addTag('image', $blog->getThumbPath(568,424,'h',true,false));
//                $item->addTag('author', 'thisisnot@myemail.com (Antonio Ramirez)');
            $item->addTag('guid', trim($blog->id), array("isPermaLink" => "false"));
//                $item->setEncloser($blog->getThumbPath(568,424,'h',true,false), '1283629', 'audio/mpeg');

            if (strlen($blog->text_ru) > 20)
                $feed->addItem($item);
        }

        $feed->generateFeed();
        Yii::app()->end();

    }
}

?>