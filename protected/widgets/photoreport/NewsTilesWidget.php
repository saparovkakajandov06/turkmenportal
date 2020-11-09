<?php
class NewsTilesWidget extends CWidget
{
    public $count;
    public $category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $is_truncate=true;
    public $categoryModel;
    public $maxPagerCount=8;
    
    
    public function init() {
        parent::init();
    }
    
    
    public function run()
    {
        $blogModels=Blog::model()->sort_newest()->enabled()->findAll(array('limit'=>13));
        $mainBlogModel=$blogModels[0]; 
        $newestBlogModels=  array_splice($blogModels,1);
        $bottomBlogModels=  array_splice($newestBlogModels,-6);
        
        $popularRange=new DateTime();
        $popularRange->modify('-4 week');
        
//        $criteriaPopular=new CDbCriteria();
//        $criteriaPopular->addCondition('t.date_modified > '.  $popularRange->format('Y-m-d'));
//        $criteriaPopular->scopes="most_popular";
//        $criteriaPopular->limit=5;
//        $criteriaPopular->select=array('t.id');
//        $criteriaPopular->order='t.id';
//        
//        $popularBlogModels=Blog::model()->findAll($criteriaPopular);
//        $popularBlogModels=Blog::model()->most_popular()->findAll(array('limit'=>5,'condition'=>'t.date_modified > '.  strtotime('-4 week') ));
       
        
        
        $this->render('NewsTilesWidget', array('bottomBlogModels'=>$bottomBlogModels,'mainBlogModel'=>$mainBlogModel,'newestBlogModels'=>$newestBlogModels, 'popularBlogModels'=>$popularBlogModels));
    }
}
?>
