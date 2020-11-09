<?php
class RegionHeaderWidget extends CWidget
{
    public $maxSubCatCount;
    public $region_id;
    public $region_code;
    public $category_id;
    public $category_code;
    public $categoy_index_url;
    
    
    public function init() {
        parent::init();
    }
    
    
    public function run()
    {
        $criteria=new CDbCriteria();
        $criteria->compare('t.code', $this->category_code,false,'OR');
        $criteria->compare('t.id', $this->category_id,false,'OR');
        $categoryModel = Category::model()->no_parent()->find($criteria);

        $criteria=new CDbCriteria();
        $criteria->with=array('parent');
        $criteria->compare('parent.code', $this->region_code,false,'OR');
        $criteria->compare('parent.id', $this->region_id,false,'OR');
        $sub_regions = Regions::model()->sort_by_sort_order()->findAll($criteria);
        
        if(isset ($sub_regions) && isset($categoryModel) && count($sub_regions)>0){
            $this->render('RegionHeaderWidget', array('sub_regions'=>$sub_regions,'categoryModel'=>$categoryModel));
        }
    }
}
?>
