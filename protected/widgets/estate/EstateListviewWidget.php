<?php
class EstateListviewWidget extends CWidget
{
    public $count;
    public $category_code;
    public $parent_category_code;
    public $category_id;
    public $item_class;
    public $show_all=true;
    public $show_header;
    public $show_sub_header;
    public $estateModel;
    public $categoryModel;
    public $is_tableview;
    public $is_only_listview;
    public $show_photo;

    
    
    public function init() {
        $this->estateModel=new Estates();
        $this->estateModel->unsetAttributes();

        parent::init();
    }
    
    
    public function run()
    {
            $pagination_count=$this->count;
            if($this->show_all==false)
                $pagination_count=0;    
        
            if (isset($_GET['mini_search'])){
                $this->catalogModel->mini_search=$_GET['mini_search'];
            }

            $dataProvider=$this->estateModel->searchForIndex($pagination_count);
            if($dataProvider->totalItemCount>0 || isset($_GET['mini_search']))
                $this->render('EstateListviewWidget', array('dataProvider'=>$dataProvider));
    }
}
?>
