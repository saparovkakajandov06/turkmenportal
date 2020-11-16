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
class CompositionsWrapper extends Compositions
{


    public function apiSearchForCategory($per_page = 10, $page = 0) {
        if (!isset($per_page))
            $per_page = 10;
        if (!isset($page))
            $page = 0;
        $criteria = new CDbCriteria;
        $criteria->with = array("category", "category.parent");

        $criteria->compare('category_id', $this->category_id);
        $criteria->scopes = array('enabled', 'sort_newest');

        $criteria->addCondition('length(title_' . Yii::app()->language . ') > 0 ');


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
