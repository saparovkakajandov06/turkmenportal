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
abstract class ActiveRecordWOD extends ActiveRecord
{
        protected function beforeFind() {
//                $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)));
                parent::beforeFind();
        }
        
        protected function afterDelete() {
            Yii::app()->cache->set(get_class($this), microtime(true), 0);
            parent::afterDelete();
        }
        
        protected function afterSave() {
            Yii::app()->cache->set(get_class($this), microtime(true), 0);
            parent::afterSave();
        }
        
}
