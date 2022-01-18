<?php

/**
 * This is the model class for table "tbl_blog".
 *
 * The followings are the available columns in table 'tbl_blog':
 * @property string $edited_username
 * @property string $create_username
 * @property string $date_added
 * @property string $date_modified
 */
abstract class ActiveRecord extends CActiveRecord
{
    public $title, $description, $text;
    public $photo_name = '';
    public $related_document = null;

    private $_translated = array();

//        public $docs=array();

    const STATUS_DISABLED = 0, STATUS_ENABLED = 1;

    public function getTranslated()
    {
        $translatedLanguages = Yii::app()->params['translatedLanguages'];
        foreach ($translatedLanguages as $key => $lang) {
            $attribute = 'title_' . $key;
            if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) < 3) {
                $this->_translated[$key] = false;
            } else
                $this->_translated[$key] = true;
        }

        return $this->_translated;
    }


    public function getStatusOptions()
    {
        return array(
            self::STATUS_DISABLED => Yii::t('app', 'disabled'),
            self::STATUS_ENABLED => Yii::t('app', 'enabled'),
        );
    }


    public function getStatusText()
    {
        $statusOptions = $this->statusOptions;
        return isset($statusOptions[$this->status]) ?
            '<span class="zakaz_status' . $this->status . '">' . $statusOptions[$this->status] . '</span>' : Yii::t('app', '$LNG_STATUS_UNKNOWN');
    }

    public function getTitle()
    {
        $attribute = 'title';
        return $this->{$attribute};
    }

    public function getDescription()
    {
        $attribute = 'description';
        return $this->{$attribute};
    }

    protected function beforeValidate()
    {
        if ($this->isNewRecord) {
            if ($this->hasAttribute('date_added') && $this->hasAttribute('date_modified')) {
                $tempArr = explode('-', $this->date_added);
                if (strlen(trim($this->date_added)) > 0 && $tempArr[0] > 0) {
                    $this->date_added = $this->date_modified = date('Y-m-d H:i:s', strtotime($this->date_added));
                } else {
                    $this->date_added = $this->date_modified = date('Y-m-d H:i:s');
                }
            }
            if ($this->hasAttribute('create_username')) {
                if (isset (Yii::app()->user->id) && strlen(trim($this->create_username)) == 0)
                    $this->create_username = $this->edited_username = Yii::app()->getModule('user')->user()->username;
            }
        } else {
            if ($this->hasAttribute('date_modified'))
                $this->date_modified = new CDbExpression('NOW()');

            if ($this->hasAttribute('edited_username')) {
                if(Yii::app()->user->id == 12281){

                } elseif(isset (Yii::app()->user->id))
                    $this->edited_username = Yii::app()->getModule('user')->user()->username;
            }
        }

        return parent::beforeValidate();
    }


    public function behaviors()
    {
        return array('ESaveRelatedBehavior' => array(
            'class' => 'application.components.ESaveRelatedBehavior')
        );
    }


//    public function getTmpImagePath() {
//        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
//        $thumb = '';
//
//        if (isset ($this->documents) && is_array($this->documents) && count($this->documents) > 0) {
//            $document = $this->documents[0];
//            $thumb = $uploadfolder . $document->path;
//        }
//
//        return $thumb;
//    }


    public function getDocuments()
    {
//        $documents = $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency('Documents'))->documents;
//            $documents=$this->documents;

        $id = $this->tableName() . $this->getPrimaryKey();
//        $documents = $this->getRelated('documents');
//        return $documents;
//
        $documents = Yii::app()->cache->get($id);
        $ctagCacheDependency = new CTagCacheDependency(get_class($this));

        if ($documents === false || $ctagCacheDependency->getHasChanged()) {
            $documents = $this->cache(Yii::app()->params['cache_duration'], $ctagCacheDependency)->documents;
//            $documents = $this->getRelated('documents');
            Yii::app()->cache->set($id, $documents);
        }

        return $documents;
    }


    public function getDocument()
    {
        $documents = $this->getDocuments();
        if (isset ($documents) && is_array($documents) && count($documents) > 0) {
            $document = $documents[0];

            foreach ($documents as $doc) {
                if ($doc['is_main'] == '1')
                    $document = $doc;
            }

            if (isset($document->name))
                $this->photo_name = $document->name;

            if (isset($document)) {
                $this->related_document = $document;
            }

            return $document;
        }

        return null;
    }


    public function getThumbPath($width = null, $height = null, $type = '', $is_cropped = false, $with_watermark = true, $with_no_image = false)
    {
//            return $this->getTmpImagePath();

        $thumb = "";
        $width = isset ($width) ? $width : 180;
        $height = isset ($height) ? $height : 180;
        $document = $this->getDocument();

        if (isset($document)) {
            $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
            $thumb = $document->resize($width, $height, $type, $is_cropped, $with_watermark);
        } elseif ($with_no_image == true) {
            $document = new Documents();
            $document->path = 'no_image.png';
            $document->name = 'no_photo';
            $thumb = $document->resize($width, $height, $type, $is_cropped, $with_watermark);
        }

        return $thumb;
    }


    public function getThumbAsGallery($thumb_width = null, $thumb_height = null, $width = null, $height = null, $type = "")
    {
        $thumb_width = isset ($thumb_width) ? $thumb_width : 130;
        $thumb_height = isset ($thumb_height) ? $thumb_height : 120;

        $width = isset ($width) ? $width : 400;
        $height = isset ($height) ? $height : 400;

        $thumb_path = $this->getThumbPath($thumb_width, $thumb_height, $type, false, true, false);

        if (isset($thumb_path) && strlen(trim($thumb_path)) > 1) {
            $galery_image = $this->getThumbPath($width, $height, $type, false, true, false);
            return CHtml::link(CHtml::image($thumb_path, '', array('data-src' => $thumb_path, 'data-src-retina' => $thumb_path, 'style' => "opacity: 1;")),
                $galery_image,
                array('title' => $this->photo_name, 'class' => 'image_wrapper', 'data-rel' => "prettyPhoto[gallery]", 'rel' => "prettyPhoto[gallery]")
            );
        }
        return "";
    }


    public function getPhotoswipeGallery($thumb_width = null, $thumb_height = null, $width = null, $height = null, $type = "auto", $is_cropped = true, $with_watermark = null)
    {
        $thumb_width = isset ($thumb_width) ? $thumb_width : 130;
        $thumb_height = isset ($thumb_height) ? $thumb_height : 120;

        $width = isset ($width) ? $width : 900;
        $height = isset ($height) ? $height : 800;

//            $documents=$this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->documents;
        $documents = $this->documents;
        $data = array();
        if (isset ($documents) && is_array($documents) && count($documents) > 0) {
            foreach ($documents as $document) {
                if (isset($document->is_main) && $document->is_main == 1)
                    $thumb = $document->resize($thumb_width * 2, $thumb_width * 2, $type, $is_cropped, $with_watermark);
                else
                    $thumb = $document->resize($thumb_width, $thumb_width, $type, $is_cropped, $with_watermark);
                $galery_image = $document->resize($width, $width, $type, $is_cropped, $with_watermark);
                $mob_image = $document->resize(400, 400, $type, $is_cropped, $with_watermark);

                if ($type == "auto") {
                    $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
                    if (is_file($uploadfolder . "/" . $document->path))
                        list($width, $height) = getimagesize($uploadfolder . "/" . $document->path);
                }

                if (isset($galery_image) && strlen(trim($galery_image)) > 2) {
                    $data[] = array(
                        "src" => $galery_image,
                        "width" => $width,
                        "height" => $height,
                        "thumb" => $thumb,
                        "med" => array("src" => $mob_image, 'width' => $width, "height" => $height),
                        "caption" => $document->caption,
                        "alt" => $document->alt,
                        "title" => $document->title,
                        "author" => $document->author,
                        "is_main" => $document->is_main,
                    );
                }
            }
        }

        return $data;
    }


    public function getMixedDescriptionModel()
    {
        $descriptions = $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->descriptions;
        if (isset ($descriptions) && count($descriptions) == 1) {
            return $descriptions[0];
        } else {
            foreach ($descriptions as $description) {
                if ($description->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->language->code == Yii::app()->language) {
                    return $description;
                }
            }
        }
    }


    public function getRegionName()
    {
        $region = $this->region;
        if (isset($region)) {
            $description = $region->getMixedDescriptionModel();
            if (isset($description))
                return $description->region_name;
        } else
            return "";
    }


    public function getCommentCount()
    {
        $comment_count = $this->comment_count;
        if (isset($comment_count)) {
            return $comment_count;
        } else {
            return 0;
        }
    }


    protected function beforeFind()
    {
//                echo "BEFORE_FIND: class: ".get_class($this);
//                $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)));
        parent::beforeFind();
    }


    protected function afterDelete()
    {
        Yii::app()->cache->set(get_class($this), microtime(true), 0);
        parent::afterDelete();
    }


    protected function beforeDelete()
    {
        parent::beforeDelete();
        try {
            if (isset($this)) {
                $documents = $this->documents;
                if (isset($documents) && is_array($documents) && count($documents) > 0) {
                    foreach ($documents as $doc) {
                        $doc->fullDelete($this->related_table_name);
                    }
                }
            }
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
        return true;
    }


    protected function afterSave()
    {
//            $activation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl(implode(Yii::app()->controller->module->recoveryUrl),array("activkey" => $user->activkey, "email" => $user->email));

//            echo "AFTER_SAVE: class: ".get_class($this)." time: ".microtime(true);
        Yii::app()->cache->set(get_class($this), microtime(true), 0);
        parent::afterSave();
//            exit(1);
    }

    const CURRENCY_MANAT = 1, CURRENCY_DOLLAR = 2;

    public static function getCurrency($currency)
    {
        if (isset($currency)) {
            $currencyOptions = array(
                self::CURRENCY_MANAT => Yii::t('app', 'CURRENCY_MANAT'),
                self::CURRENCY_DOLLAR => Yii::t('app', 'CURRENCY_DOLLAR'),
            );
            return isset($currencyOptions[$currency]) ? $currencyOptions[$currency] : Yii::t('app', '$CURRENCY_UNKNOWN');
        }
    }


    public function getOwnerFullname()
    {
        $owner = "";
        $me = $this;
        if (isset($me->owner) && is_string($me->owner) && strlen(trim($me->owner)) > 0) {
            $owner = $me->owner;
        } else {
            if (isset($me->create_username)) {
                $userModel = User::model()->findByAttributes(array('username' => $me->create_username));
                if (isset($userModel)) {
                    $profileModel = $userModel->profile;
                    if (isset($profileModel))
                        $owner = $profileModel->firstname . ' ' . $profileModel->lastname;
                } else
                    $owner = $me->create_username;
            }
        }

        if (isset($owner) && strlen(trim($owner)) > 0) {
            return $owner;
        } else {
            return "";
        }


    }


    public function hasRelatedVideo()
    {
        if (isset($this->related_document)) {
            $hls = VideoHls::model()->findByAttributes(array('document_id' => $this->related_document->id));
            return $this->related_document->getVideoPath() && isset($hls);

        }
        return false;
    }

    public function saveCounters($counters)
    {
        Yii::trace(get_class($this) . '.saveCounters()', 'system.db.ar.CActiveRecord');
        $builder = $this->getCommandBuilder();
        $table = $this->getTableSchema();
        $criteria = $builder->createPkCriteria($table, $this->getOldPrimaryKey());
        $command = $builder->createUpdateCounterCommand($this->getTableSchema(), $counters, $criteria);
        if ($command->execute()) {
            foreach ($counters as $name => $value)
                $this->$name = $this->$name + $value;
            return true;
        } else
            return false;
    }

    public function incCounter($field_name, $count = 1)
    {
        $data = Yii::app()->cache->get('counter_list');
        if (!isset($data[$this->id])) {
            $data[$this->id]['count'] = $this->$field_name;
            $data[$this->id]['field_name'] = $field_name;
            $data[$this->id]['table_name'] = $this->tableName();
        }

        $data[$this->id]['count'] += $count;

        Yii::app()->cache->delete('counter_list');
        Yii::app()->cache->set('counter_list', $data);
        return $data[$this->id]['count'];
    }

}