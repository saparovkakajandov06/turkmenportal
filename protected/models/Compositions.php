<?php

/**
 * This is the model class for table "tbl_compositions".
 *
 * The followings are the available columns in table 'tbl_compositions':
 * @property string $id
 * @property integer $region_id
 * @property integer $category_id
 * @property integer $is_turkmenistan
 * @property string $tmp_cat_name
 * @property string $title_ru
 * @property string $title_tm
 * @property string $content_ru
 * @property string $content_tm
 * @property string $web
 * @property string $views
 * @property string $likes
 * @property integer $dislikes
 * @property string $date_added
 * @property string $date_modified
 * @property string $edited_username
 * @property string $create_username
 * @property integer $status
 * @property integer $is_rss
 */
class Compositions extends ActiveRecord {

    public $parent_category_id, $catalog_category_id, $parent_category_code, $category_code;
    public $title, $description, $content, $category_name;
    public $parent_category_code_list = array('compositions', 'compositions_tm', 'ashgabat2017');
//        public $search_for_turkmenistan


    private $_url;
    private $_urlupdate;

    public function createAbsoluteUrl() {
        if ($this->_url === null)
            $this->_url = Yii::app()->createAbsoluteUrl('compositions/view', array('id' => $this->id));
        return $this->_url;
    }

    public function getUrl() {
        if ($this->_url === null)
            $this->_url = Yii::app()->createAbsoluteUrl('compositions/view', array('id' => $this->id));

        $this->_url = trim($this->_url, '/');
//            $this->_url=str_replace('https:',"http:",$this->_url);
        return $this->_url;
    }


    public function getTmUrl() {
        if ($this->_url === null)
            $this->_url = DMultilangHelper::addSpecificLangToUrl(Yii::app()->createUrl('composition/view', array('id' => $this->id)), 'tm');
        $this->_url = Yii::app()->getBaseUrl(true) . $this->_url;
//        $this->_url = str_replace('https:', "http:", $this->_url);
        return $this->_url;
//            return Yii::app()->createAbsoluteUrl($this->_url);
    }


    public function getMixedCategoryModel() {
        return $this->category;
    }

    public function scopes() {
        return array(
            'published' => array(
                'condition' => 't.status=1 AND t.date_modified <= NOW()',
            ),
            'enabled' => array(
                'condition' => 't.status=1',
            ),
            'translated' => array(
                'condition' => 't.title_tm is not null AND CHAR_LENGTH(t.title_tm)>10',
            ),
            'not_translated' => array(
                'condition' => 't.title_ru is not null AND CHAR_LENGTH(t.title_ru)>10',
            ),
            'rss' => array(
                'condition' => 't.is_rss=1',
            ),
            'sort_newest' => array(
                'order' => 't.id desc',
            ),
            'sort_trend_asc' => array(
//                'select' => "date_added, (TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW()))/(visited_count*visited_count*visited_count)*100 as rating",
//                'select' => "date_added, (TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW()))/(visited_count*visited_count*visited_count*visited_count) as rating",
//                'select' => "date_added, (TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW()))/(visited_count*visited_count*visited_count) as rating",
//                'select' => "date_added, (TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW()))/(visited_count*visited_count) as rating",
                'order' => "views desc",
//                'condition' => "date_added > DATE_ADD(NOW(), INTERVAL -30 DAY)",
            ),
        );
    }


    function behaviors() {
        return array_merge(parent::behaviors(), array(
            'xupload' => array(
                'class' => 'ext.xupload.components.XUploadBehavior',
                'state_name' => 'state_composition',
                'related_table_name' => 'tbl_compositions_to_documents',
            ),
            'PingBehavior' => array(
                'class' => 'DPingBehavior',
                'urlAttribute' => 'url',
            ),
        ));
    }


    public function getUrlupdate() {
        if ($this->_urlupdate === null)
            $this->_urlupdate = Yii::app()->createUrl('blog/update', array('id' => $this->id));
        return $this->_urlupdate;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_compositions';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('views, likes', 'required'),
            array('category_id, region_id, dislikes, status', 'numerical', 'integerOnly' => true),
            array('tmp_cat_name, title_ru, title_tm, web, edited_username, create_username', 'length', 'max' => 255),
            array('views, likes', 'length', 'max' => 10),
            array('content_ru, content_tm, date_added, date_modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, is_rss, sort_order, region_id, category_id, tmp_cat_name, title_ru, title_tm,title_en, title, content_ru, content_tm, content_en,content, description, web, views, likes, dislikes, date_added, date_modified, edited_username, create_username, status', 'safe'),
            array('id, is_rss, sort_order, region_id, category_id, tmp_cat_name, title_ru, title_tm, title_en,title, content_ru, content_tm, content_en,content, description, web, views, likes, dislikes, date_added, date_modified, edited_username, create_username, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'region_id' => array(self::BELONGS_TO, 'Regions', 'region_id'),
            'documents' => array(self::MANY_MANY, 'Documents', 'tbl_compositions_to_documents(compositions_id,documents_id)'),
            'comment_count' => array(self::STAT, 'Comments', 'tbl_compositions_to_comments(compositions_id,comment_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'region_id' => 'Region',
            'tmp_cat_name' => 'Tmp Cat Name',
            'title_ru' => 'Title Ru',
            'title_tm' => 'Title Tm',
            'content_ru' => 'Content Ru',
            'content_tm' => 'Content Tm',
            'web' => 'Web',
            'views' => 'Views',
            'likes' => 'Likes',
            'dislikes' => 'Dislikes',
            'status' => 'Status',
            'is_rss' => Yii::t('app', 'is_rss'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'create_username' => Yii::t('app', 'create_username'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
            'category_id' => Yii::t('app', 'category_id'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.category_id', $this->category_id);
        $criteria->compare('t.region_id', $this->region_id);
        $criteria->compare('t.tmp_cat_name', $this->tmp_cat_name, true);
        $criteria->compare('t.title_ru', $this->title_ru, true);
        $criteria->compare('t.title_tm', $this->title_tm, true);
        $criteria->compare('t.content_ru', $this->content_ru, true);
        $criteria->compare('t.content_tm', $this->content_tm, true);
        $criteria->compare('t.web', $this->web, true);
        $criteria->compare('t.views', $this->views, true);
        $criteria->compare('t.likes', $this->likes, true);
        $criteria->compare('t.dislikes', $this->dislikes);
        $criteria->compare('t.date_added', $this->date_added, true);
        $criteria->compare('t.date_modified', $this->date_modified, true);
        $criteria->compare('t.edited_username', $this->edited_username, true);
        $criteria->compare('t.create_username', $this->create_username, true);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.is_rss', $this->is_rss);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Compositions the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    public function searchByLanguage() {
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;

//            $criteria->compare('language.code', Yii::app()->language);
//            $criteria->compare('descriptions.title', $this->title,true);
//            $criteria->compare('descriptions.description', $this->description,true);
        $criteria->with = array("category");
        $criteria->order = "t.id desc";
        $criteria->compare('t.title_' . Yii::app()->language, $this->title, true);
        $criteria->compare('t.content_' . Yii::app()->language, $this->content, true);

        $criteria->select = array('t.*', 'category.name_' . Yii::app()->language . ' as category_name');
        return new CActiveDataProvider(self::model()->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)), 2), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['pageSize'],
                'pageVar' => 'page',
            ),
        ));
    }


    public function searchForCategory($limit = 50, $models = false, $except = array()) {
        $criteria = new CDbCriteria;
        $criteria->with = array("category", "category.parent");

        $criteria->compare('category_id', $this->category_id);
        $criteria->scopes = array('enabled', 'sort_newest');
        if (isset($except) && count($except) > 0)
            $criteria->addNotInCondition('t.id', $except);

        $criteria->addCondition('length(title_' . Yii::app()->language . ') > 0 ');

        if ($limit > 0) {
            $criteria->limit = $limit;
            $criteria->offset = 0;
        }

        if ($models == false) {
            $dp = new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'pagination' => ($limit > 0) ? false : array(
                        'pageSize' => Yii::app()->params['pageSize'],
                        'pageVar' => 'page',
                    ),
                ));

            return $dp;
        } else {
            return $this->findAll($criteria);
        }
    }


    public function searchForWidgetByCategory($limit = 50, $models = false, $beforeToday = null) {
        $criteria = new CDbCriteria;

        $criteria->with = array("category" => array('select' => array('code', 'id', 'parent_id')));

        if (isset($this->parent_category_id))
            $criteria->compare('category.parent_id', $this->parent_category_id);
        if ($this->category_id)
            $criteria->compare('t.category_id', $this->category_id);
        if ($this->category_code)
            $criteria->compare('category.code', $this->category_code);
        if ($this->parent_category_code) {
            $parentCategoryModel = Category::model()->findParentCategoryByCode($this->parent_category_code);
            if (isset($parentCategoryModel)) {
                $criteria->compare('category.parent_id', $parentCategoryModel->id);
            }
        }

        $criteria->addCondition('length(title_' . Yii::app()->language . ') > 0 ');

        if (isset($beforeToday)) {
            if ($beforeToday == 1)
                $criteria->addCondition('t.period < "' . date('Y-m-d', strtotime('today')) . '"');
            else
                $criteria->addCondition('t.period >= "' . date('Y-m-d', strtotime('today')) . '"');
        }


        $criteria->scopes = array('enabled', 'sort_newest');

        if ($limit > 0) {
            $criteria->limit = $limit;
            $criteria->offset = 0;
        }

        $criteria->select = array('id', 'date_added', 'title_' . Yii::app()->language, 'content_' . Yii::app()->language);

        if ($models == false) {
            $dp = new CActiveDataProvider($this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)), 2),
                array(
                    'criteria' => $criteria,
                    'pagination' => ($limit > 0) ? false : array(
                        'pageSize' => Yii::app()->params['pageSize'],
                        'pageVar' => 'page',
                    ),
                ));
            return $dp;
        } else {
            return $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->findAll($criteria);
//                return $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->findAll($criteria);
        }
    }


    public function searchForIndex($limit = 50, $models = false, $except = array()) {
        $criteria = new CDbCriteria;

        if ($this->category_id)
            $criteria->compare('t.category_id', $this->category_id);
//
        if (isset($this->parent_category_id)) {
            $criteria->with = array("category");
            $criteria->compare('category.parent_id', $this->parent_category_id);
        }
        if ($this->category_code) {
            $criteria->with = array("category");
            $criteria->compare('category.code', $this->category_code);
        }
        if ($this->parent_category_code) {
            $criteria->with = array("category.parent");
            $criteria->compare('parent.code', $this->parent_category_code);
        }


        $criteria->addCondition('length(title_' . Yii::app()->language . ') > 0 ');
        if (isset($except) && count($except) > 0)
            $criteria->addNotInCondition('t.id', $except);


//            $criteria->with=array("category","category.parent");
//            $criteria->compare('category_id', $this->category_id);
        $criteria->scopes = array('enabled');
        if (!empty($this->pub_date)) {
            $criteria->addCondition("t.date_added  >= '$this->pub_date 00:00:00' and t.date_added <= '$this->pub_date 23:59:59'");
        }

        if ($limit > 0) {
            $criteria->limit = $limit;
            $criteria->offset = 0;
        }


        if ($models == false) {
            $dp = new CActiveDataProvider($this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)), 2),
//               $dp= new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'pagination' => ($limit > 0) ? false : array(
                        'pageSize' => Yii::app()->params['pageSize'],
                        'pageVar' => 'page',
                    ),
                ));
//                $dp->setTotalItemCount(count($this->findAll($criteria)));
            return $dp;
        } else {
            return $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->findAll($criteria);
        }
    }


    public function getTitle() {
        $attribute = 'title_' . Yii::app()->getLanguage();
        if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) {
            $attribute = 'title_ru';
            if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) {
                $attribute = 'title_tm';
            }
        }

        return $this->{$attribute};
    }


    public function setTitle($value) {
        $attribute = 'title_' . Yii::app()->getLanguage();
        $this->{$attribute} = $value;
    }


    public function getContent() {
        $attribute = 'content_' . Yii::app()->getLanguage();
        if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) {
            $attribute = 'content_ru';
            if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) {
                $attribute = 'content_tm';
            }
        }
        return $this->{$attribute};
    }


    public function setContent($value) {
        $attribute = 'content_' . Yii::app()->getLanguage();
        $this->{$attribute} = $value;
    }


    public function getMixedCategoryName() {
        if (isset($this->category))
            return $this->category->name;
        return "";
    }


}
