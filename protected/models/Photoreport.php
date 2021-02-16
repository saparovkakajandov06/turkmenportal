<?php


/**
 * This is the model class for table "tbl_blog".
 *
 * The followings are the available columns in table 'tbl_blog':
 * @property integer $category_id
 *
 *
 * @property integer $id
 * @property string $image
 * @property integer $like_count
 * @property integer $visited_count
 * @property integer $sort_order
 * @property integer $status
 * @property integer $is_main
 * @property integer $is_photoreport
 * @property integer $is_clients
 * @property string $web
 * @property string $edited_username
 * @property string $date_added
 * @property string $date_modified
 *
 * @property string $title_tm
 * @property string $title_ru
 * @property string $descrpition_tm
 * @property string $descrpition_ru
 * @property string $text_tm
 * @property string $text_ru
 *
 *
 */
class Photoreport extends Blog {

    public $default_scope = array('enabled', 'sort_newest');
    public $video = false;

    private $_url;
    private $_urlupdate;


    public function createAbsoluteUrl() {
        if ($this->_url === null)
            $this->_url = Yii::app()->createAbsoluteUrl('photoreport/view', array('id' => $this->id));
        return $this->_url;
    }


    public function getUrl($absolute = false) {

        $this->_url = Yii::app()->createUrl('photoreport/view', array(
            'id' => $this->id,
            'alias' => $this->{alias . '_' . Yii::app()->getLanguage()},
        ));

        if ($absolute == true)
            $this->_url = Yii::app()->createAbsoluteUrl($this->_url);
        return $this->_url;
    }


    public function getTmUrl() {
        if ($this->_url === null)
            $this->_url = DMultilangHelper::addSpecificLangToUrl(Yii::app()->createUrl('photoreport/view', array('id' => $this->id)), 'tm');
        $this->_url = Yii::app()->getBaseUrl(true) . $this->_url;
//        $this->_url = str_replace('https:', "http:", $this->_url);
        return $this->_url;
//            return Yii::app()->createAbsoluteUrl($this->_url);
    }


    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    public function searchForCategory($limit = 5, $models = false) {

        if (isset($_GET['page']))
            $page = (int)$_GET['page'];
        if (isset($_GET['per_page']))
            $per_page = (int)$_GET['per_page'];

        $criteria = new CDbCriteria;

        if (isset($this->parent_category_id)) {
            $criteria->compare('t.parent_category_id', $this->parent_category_id);
        }

        if ($this->category_id)
            $criteria->compare('t.category_id', $this->category_id);

        if ($this->video == true){
            $criteria->join = 'LEFT JOIN tbl_blog_to_documents rel ON `t`.`id` = `rel`.`blog_id`'
                .'LEFT JOIN tbl_documents doc ON `rel`.`documents_id` = `doc`.`id`';
            $criteria->addCondition('length(doc.video_path) > 0 ');
        }

        if (isset($this->except) && count($this->except) > 0) {
            $criteria->addNotInCondition('t.id', $this->except);
        }

//        $criteria->scopes=array('enabled');
        $criteria->scopes = $this->default_scope;


        if (!empty($this->pub_date)) {
            $criteria->addCondition("t.date_added >= :pub_date_start and t.date_added <= :pub_date_end");
            $criteria->params = array_merge($criteria->params, array(':pub_date_start' => $this->pub_date . ' 00:00:00', ':pub_date_end' => $this->pub_date . ' 23:59:59'));
        }


        if ($limit > 0) {
            $criteria->limit = $limit;
            $criteria->offset = 0;
        }

        $criteria->select = array('t.id', 't.title_' . Yii::app()->language, 't.text_' . Yii::app()->language, 't.alias_' . Yii::app()->language, 't.description_' . Yii::app()->language, 'visited_count', 'date_added', 'category_id', 'like_count', 'status', 'is_photoreport');

        if ($per_page === 0 && $_GET['api']){
            $per_page = 10;
        } else {
            $per_page = $per_page ? $per_page : Yii::app()->params['pageSize'];
        }
        if (!$_GET['api']) $page--;

        if ($models == false) {
            $dp = new CActiveDataProvider($this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency('Blog'), 2),
//           $dp= new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'pagination' => ($limit > 0) ? false : array(
                        'pageSize' => $per_page,
                        'pageVar' => 'page',
                        'currentPage' => $page,
                    )
                ));

//                $dp->setTotalItemCount(count($this->findAll($criteria)));
            return $dp;
        } else {
            return $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency('Blog'), 2)->findAll($criteria);
        }
    }

}
