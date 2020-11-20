<?php

class LentaNewsWidget extends CWidget
{
    public $count;
    public $category_code;
    public $item_class;
    public $show_all;
    public $ajax = false;


    public function init()
    {
        if (!isset ($this->category_code))
            $this->category_code = 'news';
        parent::init();
    }


    public function run()
    {
        if ($this->ajax) {
            $this->render('//lenta/LentaNewsWidget');
        } else {
            $blogModel = new Blog();
            $blogModel->unsetAttributes();
            $blogModel->reset_related_sort = true;
            $recentDataProvider = Blog::model()->not_photoreport()->searchForCategory($this->count);

            $blogModel = new Blog();
            $blogModel->unsetAttributes();
            $blogModel->default_scope = array('enabled', 'not_photoreport','sort_trend_asc');
            $blogModel->reset_related_sort = true;
            $popularDataProvider = $blogModel->searchForCategory($this->count);
            if ($recentDataProvider->totalItemCount > 0)
                $this->render('//lenta/LentaNewsWidget', array('recentDataProvider' => $recentDataProvider, 'popularDataProvider' => $popularDataProvider));
        }

    }
}

?>
