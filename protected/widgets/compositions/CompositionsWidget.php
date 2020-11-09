<?php
class CompositionsWidget extends CWidget
{
    public $count;
    public $category_code;
    public $parent_category_code;
    public $category_id;
    public $parent_category_id;
    public $item_class;
    public $show_all=true;
    public $show_photo;
    public $show_header;
    public $compositionsModel;
    public $itemView='_listview_item';
    public $viewType='list';

    public $show_image=true;
    public $show_title=true;
    public $show_description=true;


    
    public function init() {
        $this->compositionsModel=new Compositions();
        $this->compositionsModel->unsetAttributes();

        if(isset ($this->category_id)){
            $this->compositionsModel->category_id=$this->category_id;
        }
        if(isset ($this->category_code)){
            $this->compositionsModel->category_code=$this->category_code;
        }
        
        if(isset ($this->parent_category_id)){
            $this->compositionsModel->parent_category_id=$this->parent_category_id;
        }
        
        if(isset ($this->parent_category_code)){
            $this->compositionsModel->parent_category_code=$this->parent_category_code;
        }
        
        
        if(!isset ($this->show_header))
            $this->show_header=false;
        
        
        parent::init();
    }
    
    
    public function run()
    {
        
        $pagination_count=$this->count;
        if($this->show_all==false)
            $pagination_count=0;    
        
        $dataProvider=$this->compositionsModel->searchForWidgetByCategory($pagination_count);
        if($dataProvider->totalItemCount>0)
            $this->render('CompositionsWidget', array('dataProvider'=>$dataProvider));
    }
}
?>
