<?php
class AdvertListWidget extends CWidget
{
    public $count;
    public $category_code;
    public $parent_category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $is_truncate=true;
    public $categoryModel;
    public $maxPagerCount=8;
    public $advertModel;
    public $itemView;
    public $headerText;
    public $headerCssClass;


    public function init() {
        parent::init();
        if(!isset($this->item_class))
            $this->item_class='col-md-4';
        if(!isset($this->count))
            $this->count=10;
        if(!isset($this->itemView))
            $this->itemView='/_views/_tilesview';

        $this->advertModel= new Advert('search');
        $this->advertModel->unsetAttributes();

        if (isset ($this->category_code)) {
            $this->categoryModel = Category::model()->findByAttributes(array ('code' => $this->category_code));
            if (isset($this->categoryModel->parent_id) && $this->categoryModel->parent_id>0){
                $this->advertModel->category_id = $this->categoryModel->id;
            } else{
                $this->advertModel->parent_category_id = $this->categoryModel->parent_id;
            }
        }

//        if (isset ($this->parent_category_id)) {
//            $this->categoryModel = Category::model()->findByPk($this->parent_category_id);
//            if (isset($this->categoryModel))
//                $this->advertModel->parent_category_id = $this->categoryModel->id;
//        }
//
//        if (isset ($this->parent_category_code)) {
//            $this->categoryModel = Category::model()->findParentCategoryByCode($this->parent_category_code);
//            if (isset($this->categoryModel))
//                $this->advertModel->parent_category_id = $this->categoryModel->id;
//        }

    }

    public function run()
    {
        $dataProvider=$this->advertModel->searchForCategory($this->count);
        if($dataProvider->totalItemCount>0)
            $this->render('AdvertListWidget', array('dataProvider'=>$dataProvider));
    }
}
?>
