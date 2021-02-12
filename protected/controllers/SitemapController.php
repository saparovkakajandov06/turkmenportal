<?php

    class SitemapController extends Controller
    {
        public function actionIndex()
        {
            if (!$xml = Yii::app()->cache->get('sitemap1'))
            {    
                $classes = array(
//                    'Blog' => array(DSitemap::DAILY, 0.8),
//                    'Compositions' => array(DSitemap::WEEKLY, 0.2),
                    'Catalog' => array(DSitemap::DAILY, 0.5), 
                    'Advert' => array(DSitemap::DAILY, 0.5),
                    'Work' => array(DSitemap::DAILY, 0.5),
                    'Estates' => array(DSitemap::DAILY, 0.5),
                    'Auto' => array(DSitemap::DAILY, 0.5),
                );    

                $sitemap = new DSitemap();

                $categories=Category::model()->enabled()->findAll();
                foreach($categories as $category){
                    $tmUrl=$category->getTmUrl(true);
                    $url=$category->getUrl(true);
                    $url=str_replace('http:',"https:",$url);
                    $tmUrl=str_replace('http:',"https:",$tmUrl);
                    $sitemap->addUrl($url, DSitemap::YEARLY,'1');
                    $sitemap->addUrl($tmUrl, DSitemap::YEARLY,'1');
                }


                $blogs=Blog::model()->published()->sort_newest()->not_translated()->findAll(['limit'=>5000]);
                foreach($blogs as $blog){
                    $url=$blog->getUrl();
                    $url=str_replace('http:',"https:",$url);
                    $sitemap->addUrl($url, DSitemap::DAILY,'0.8',$blog->date_modified);
                }

                $tmBlogs=Blog::model()->published()->sort_newest()->translated()->findAll(['limit'=>5000]);
                foreach($tmBlogs as $blog){
                    $tmUrl=$blog->getTmUrl();
                    $tmUrl=str_replace('http:',"https:",$tmUrl);
                    $sitemap->addUrl($tmUrl, DSitemap::DAILY,'0.8',$blog->date_modified);
                }

//                $cities = InfoCities::model()->enabled()->visibility()->findAll(['limit'=>200]);
//                foreach($cities as $city){
//                    $url = $city->getUrl(true);
//                    $tmUrl = $city->getTmUrl(true);
//                    $enUrl = $city->getEnUrl(true);
//                    $url=str_replace('http:',"https:",$url);
//                    $tmUrl=str_replace('http:',"https:",$tmUrl);
//                    $enUrl=str_replace('http:',"https:",$enUrl);
//                    $sitemap->addUrl($url, DSitemap::HOURLY,'0.6');
//                    $sitemap->addUrl($enUrl, DSitemap::HOURLY,'0.6');
//                    $sitemap->addUrl($tmUrl, DSitemap::HOURLY,'0.6',date('Y-m-d H:i:s', time()));
//                }

                $compositions=Compositions::model()->published()->sort_newest()->not_translated()->findAll(['limit'=>2000]);
                foreach($compositions as $composition){
                    $url=$composition->getUrl();
                    $url=str_replace('http:',"https:",$url);
                    $sitemap->addUrl($url, DSitemap::DAILY,'0.8',$composition->date_modified);
                }

                $tmCompositions=Compositions::model()->published()->sort_newest()->translated()->findAll(['limit'=>2000]);
                foreach($tmCompositions as $tmComposition){
                    $tmUrl=$tmComposition->getTmUrl();
                    $tmUrl=str_replace('http:',"https:",$tmUrl);
                    $sitemap->addUrl($tmUrl, DSitemap::DAILY,'0.8',$tmComposition->date_modified);
                }


                foreach ($classes as $class=>$options){
                    $sitemap->addModels(CActiveRecord::model($class)->sort_newest()->published()->findAll(['limit'=>2000]), $options[0], $options[1]);
                }

////
//                echo "<pre>";
//                print_r($sitemap->items);
//                echo "</pre>";
//                exit(1);

                $xml = $sitemap->render();
                Yii::app()->cache->set('sitemap1', $xml, 3600*6);
            }

            header("Content-type: text/xml");
            echo $xml;
            Yii::app()->end();      
        }
        
        
        
        
    }
?>