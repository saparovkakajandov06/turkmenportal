<?php

class BlogWrapper extends Blog
{
    


    public function apiSearchForCategory($per_page = 5, $page = 0)
    {
        $criteria = new CDbCriteria;

        if (isset($this->parent_category_id)) {
            $criteria->compare('t.parent_category_id', $this->parent_category_id);
        }
        if ($this->category_id)
            $criteria->compare('t.category_id', $this->category_id);

        if (isset($this->except) && count($this->except) > 0) {
            $criteria->addNotInCondition('t.id', $this->except);
        }
        if (isset($this->categoryid_except) && count($this->categoryid_except) > 0) {
            $criteria->addNotInCondition('t.category_id', $this->categoryid_except);
        }
        $criteria->addCondition('length(title_' . Yii::app()->language . ') > 0 ');

        $criteria->scopes = $this->default_scope;

        if (!empty($this->pub_date) && Yii::app()->controller->validateDateTime($this->pub_date . ' 00:00:00', 'Y-n-j H:i:s')) {
            $criteria->addCondition("t.date_added >= :pub_date_start and t.date_added <= :pub_date_end");
            $criteria->params = array_merge($criteria->params, array(':pub_date_start' => $this->pub_date . ' 00:00:00', ':pub_date_end' => $this->pub_date . ' 23:59:59'));
        }

        if ($this->reset_related_sort == true) {
            $_GET['Blog_sort_temp'] = $_GET['Blog_sort'];
            unset($_GET['Blog_sort']);
        } else {
            if (isset($_GET['Blog_sort_temp'])) {
                $_GET['Blog_sort'] = $_GET['Blog_sort_temp'];
                unset($_GET['Blog_sort_temp']);
            }
        }


        $criteria->select = array('t.id', 't.title_' . Yii::app()->language, 't.text_' . Yii::app()->language, 't.alias_' . Yii::app()->language, 't.description_' . Yii::app()->language, 'visited_count', 'date_added', 'category_id', 'like_count', 'status', 'is_photoreport');
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
