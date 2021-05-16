<?php

/**
 * @property string $title
 * @property string $text
 * @property string $url
 */
class Search extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
//        return 'view_search';
        return 'tbl_search';
    }
    
    
    private $_material;
 
    public function getMaterial()
    {
        if ($this->_material === null){
//            if ($this->material_import){
//                Yii::import($this->material_import);
//            }   
            $this->_material = CActiveRecord::model($this->material_class)->findByPk($this->material_id);
        }
         
        return $this->_material;
    }


    public function searchApi($per_page = 10, $page = 0)
    {
        if (!isset($per_page))
            $per_page = 10;
        if (!isset($page))
            $page = 0;


        if(isset ($_POST['query']))
            $query=trim($_POST['query']);
        elseif(isset ($_GET['query']))
            $query=trim($_GET['query']);

        if(isset ($_POST['query']))
            $query=trim($_POST['query']);
        elseif(isset ($_GET['query']))
            $query=trim($_GET['query']);
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('title', $query);
        $criteria->addSearchCondition('text', $query, true, 'OR');

        if(isset ($_GET['category_id'])){
            $category_id=trim($_GET['category_id']);
            $criteria->compare('category_id', $category_id);
        }
        if(isset ($_GET['region_id'])){
            $region_id=trim($_GET['region_id']);
            $criteria->compare('region_id', $region_id);
        }

        $criteria->order='date_added desc';

        $dp = new CActiveDataProvider($this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)), 2),
            array(
                'criteria' => $criteria,
                'pagination' =>  array(
                    'pageSize' => $per_page,
                    'pageVar' => 'page',
                    'currentPage'=> $page,
                ),
            ));
        return $dp;
    }


}
?>
