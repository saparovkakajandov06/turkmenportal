<?php

/**
 * This is the model class for table "tbl_category".
 *
 * The followings are the available columns in table 'tbl_category':
 * @property integer $id
 * @property string $image
 * @property integer $parent_id
 * @property integer $top
 * @property integer $is_announcement
 * @property integer $column
 * @property integer $code
 * @property string $name_tm
 * @property string $name_ru
 * @property string $description_tm
 * @property string $description_ru
 * @property string $meta_description_tm
 * @property string $meta_description_ru
 * @property string $alias_tm
 * @property string $alias_ru
 * @property integer $sort_order
 * @property integer $status
 * @property string $date_added
 * @property string $date_modified
 */
class AutoCategory extends Category
{
    
        /**
	 * @return string the associated database table name
	 */
//	public function tableName(){
//		return 'tbl_category';
//	}
//        
    
//        public $name,$description,$is_used;
        private $_url;
        private $_name;
        protected $urlPrefix='auto/avto/';
        
 
        public function getUrl($absolute=false)
        {
//            return Yii::app()->request->baseUrl;
            if ($this->_url === null)
                $this->_url = Yii::app()->request->baseUrl . '/' .$this->urlPrefix .$this->{$this->aliasAttribute} . Yii::app()->urlManager->urlSuffix;
            return $this->_url;
        }   

        
}
