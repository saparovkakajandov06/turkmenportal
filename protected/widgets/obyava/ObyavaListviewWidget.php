<?php
class ObyavaListviewWidget extends CWidget
{
    public $count;
    public $category_code;
    public $parent_category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $show_header;
    public $show_sub_header;
    public $catalogModel;
    public $categoryModel;
    public $is_tableview;
    public $is_only_listview;
    public $show_photo;

    
    
    public function init() {
        $this->catalogModel=new Catalog();
        $this->catalogModel->unsetAttributes();
        $this->catalogModel->category_code=$this->category_code;

        parent::init();
    }
    
    
    public function run()
    {
            $pagination_count=$this->count;
            if($this->show_all==false)
                $pagination_count=0;    

            $dataProvider=$this->catalogModel->searchForCategory($pagination_count);

            if($dataProvider->totalItemCount>0 || isset($_GET['mini_search']))
                $this->render('ObyavaListviewWidget', array('dataProvider'=>$dataProvider));
    }
}
?>
