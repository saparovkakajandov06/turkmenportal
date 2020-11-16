<?php

/**
 * This is the model class for table "tbl_catalog".
 *
 * The followings are the available columns in table 'tbl_catalog':
 * @property string $id
 * @property string $title_tm
 * @property string $title_ru
 * @property string $description_tm
 * @property string $description_ru
 * @property string $content_tm
 * @property string $content_ru
 * @property string $alias_tm
 * @property string $alias_ru
 * @property string $region_id
 * @property string $category_id
 * @property string $address
 * @property string $price
 * @property integer $currency
 * @property string $phone
 * @property string $mail
 * @property string $web
 * @property string $rating
 * @property string $period
 * @property string $views
 * @property string $likes
 * @property string $dislikes
 * @property integer $status
 * @property string $edited_username
 * @property string $create_username
 * @property string $date_added
 * @property string $date_modified
 */
class CatalogWrapper extends Catalog
{


    public function apiSearchForCategory($per_page = 10, $page = 0) {
        if (!isset($per_page))
            $per_page = 10;
        if (!isset($page))
            $page = 0;
        $criteria = new CDbCriteria;

        if (isset($this->parent_category_id)) {
            $criteria->compare('t.parent_category_id', $this->parent_category_id);
        }

        if ($this->category_id)
            $criteria->compare('t.category_id', $this->category_id);

        if ($this->parent_category_code) {
            $criteria->with = array("category.parent");
            $criteria->compare('parent.code', $this->parent_category_code);
        }

        if ($this->except) {
            $criteria->addNotInCondition('t.id', $this->except);
        }

        if (isset($this->mini_search)) {
            $criteria->with = array("category", "category.parent", 'descriptions');
            $criteria->together = true;
            $criteria->compare('descriptions.title', $this->mini_search, true);
        }

        if (isset($beforeToday)) {
            if ($beforeToday == 1)
                $criteria->addCondition('t.period < "' . date('Y-m-d', strtotime('today')) . '"');
            else
                $criteria->addCondition('t.period >= "' . date('Y-m-d', strtotime('today')) . '"');
        }

        $criteria->scopes = array('enabled', 'sort_date_modified');

        $dp = new CActiveDataProvider($this,
            array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => $per_page,
                    'pageVar' => 'page',
                    'currentPage'=> $page,
                ),
            ));
        return $dp;
    }




}
