<?php

class RelatedNewsWidget extends CWidget {
    public $count;
    public $category_id;
    public $item_class;
    public $show_all;
    public $except;
    public $ajax = false;
    public $model;


    public function init() {
        $this->model = new Blog();
        $this->model->unsetAttributes();
        $this->model->reset_related_sort = true;

        parent::init();
    }


    public function run() {
//        if ($this->ajax) {
//            $this->render('//related/RelatedNewsWidget');
//        } else {

        //related category initialized at init() function
        if (isset ($this->category_id))
            $this->model->category_id = $this->category_id;
        if (isset ($this->except)){
            if(!is_array($this->except))
                $this->except=array($this->except);
            $this->model->except = $this->except;
        }
        $relatedDataProvider = $this->model->searchForCategory($this->count);

        $this->model->unsetAttributes();
        $this->model->reset_related_sort = true;
        $recentDataProvider = $this->model->not_photoreport()->searchForCategory($this->count);

        $this->model->unsetAttributes();
        $this->model->default_scope = array('enabled', 'not_photoreport', 'sort_trend_asc');
        $this->model->reset_related_sort = true;
        $popularDataProvider = $this->model->searchForCategory($this->count);

        if ($relatedDataProvider->totalItemCount > 0)
            $this->render('//related/RelatedNewsWidget', array('relatedDataProvider' => $relatedDataProvider, 'popularDataProvider' => $popularDataProvider, 'recentDataProvider' => $recentDataProvider));
//        }

    }
}

?>
