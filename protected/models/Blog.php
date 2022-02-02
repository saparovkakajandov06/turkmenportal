<?php

/**
 * This is the model class for table "tbl_blog".
 *
 * The followings are the available columns in table 'tbl_blog':
 * @property integer $id
 * @property integer $like_count
 * @property integer $visited_count
 * @property integer $sort_order
 * @property integer $status
 * @property integer $is_main
 * @property integer $category_id
 * @property integer $parent_category_id
 * @property integer $is_photoreport
 * @property integer $is_clients
 * @property integer $is_interview
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
 * @property integer $is_rss
 *
 *
 */
class Blog extends ActiveRecord
{
    public $client_id, $worker_id;
    public $category_id, $category_code, $parent_category_code;
    public $title, $description, $text;
    public $category_name;
    public $tag;
    public $blog_category_id;
    public $pub_date;
    public $pub_date_formatted;
    public $except;
    public $categoryid_except;
    public $default_scope = array('enabled', 'sort_newest', 'sort_by_date_desc', 'sort_by_order_desc');
    public $reset_related_sort = false;
    public $parent_category_code_list = array('news', 'photoreport');
    public $video = false;

    private $_url;
    private $_urlupdate;

    public function createAbsoluteUrl()
    {
        if ($this->_url === null)
            $this->_url = Yii::app()->createAbsoluteUrl('blog/view', array('id' => $this->id));
        return $this->_url;
    }


    public function getUrl($absolute = false)
    {
        if ($this->_url === null)
//                $this->_url = Yii::app()->createAbsoluteUrl('blog/view', array('id'=>$this->id));
            $this->_url = Yii::app()->createAbsoluteUrl('blog/view', array(
                'id' => $this->id,
                'alias' => $this->{alias . '_' . Yii::app()->getLanguage()},
            ));


//        if($absolute==false)
//            $this->_url = str_replace('https:', "http:", $this->_url);

        $this->_url = trim($this->_url, '/');
        return strlen(trim($this->_url)) > 0 ? $this->_url : "#";
    }

//        public function getUrl(){
//            if ($this->_url === null)
//                $this->_url = Yii::app()->createAbsoluteUrl('catalog/view', array('id'=>$this->id));
//            return strlen(trim($this->_url))>0 ? $this->_url : "#";
//        }

    public function getTmUrl()
    {
        if ($this->_url === null)
            $this->_url = DMultilangHelper::addSpecificLangToUrl(Yii::app()->createUrl('blog/view', array('id' => $this->id)), 'tm');
        $this->_url = Yii::app()->getBaseUrl(true) . $this->_url;
//        $this->_url = str_replace('https:', "http:", $this->_url);
        return $this->_url;
//            return Yii::app()->createAbsoluteUrl($this->_url);
    }

    public function getEnUrl()
    {
        if ($this->_url === null)
            $this->_url = DMultilangHelper::addSpecificLangToUrl(Yii::app()->createUrl('blog/view', array('id' => $this->id)), 'en');
        $this->_url = Yii::app()->getBaseUrl(true) . $this->_url;
//        $this->_url = str_replace('https:', "http:", $this->_url);
        return $this->_url;
//            return Yii::app()->createAbsoluteUrl($this->_url);
    }


    public function getUrlupdate()
    {
        if ($this->_urlupdate === null)
            $this->_urlupdate = Yii::app()->createUrl('blog/update', array('id' => $this->id));
        return $this->_urlupdate;
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Blog the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    function behaviors()
    {
        return array_merge(parent::behaviors(), array(
            'xupload' => array(
                'class' => 'ext.xupload.components.XUploadBehavior',
                'state_name' => 'state_blog',
                'related_table_name' => 'tbl_blog_to_documents',
            ),
            'PingBehavior' => array(
                'class' => 'DPingBehavior',
                'urlAttribute' => 'url',
            ),
            'ESaveRelatedBehavior' => array('class' => 'application.components.ESaveRelatedBehavior'),
            'tagstm' => array(
                'class' => 'ext.taggable.EARTaggableBehavior',
                // Table where tags are stored
                'tagTable' => 'tbl_tag',
                'tagModel' => 'Tag',
                // Cross-table that stores tag-model connections.
                // By default it's your_model_tableTag
                'tagBindingTable' => 'tbl_blog_to_tag_tm',
                // Foreign key in cross-table.
                // By default it's your_model_tableId
                'modelTableFk' => 'blog_id',
                // Tag table PK field
                'tagTablePk' => 'id',
                // Tag name field
                'tagTableName' => 'name',
                // Tag counter field
                // if null (default) does not write tag counts to DB
//                    'tagTableCount' => 'count',
                // Tag binding table tag ID
                'tagBindingTableTagId' => 'tag_id',
                // Caching component ID. If false don't use cache.
                // Defaults to false.
                'cacheID' => 'cache',

                // Save nonexisting tags.
                // When false, throws exception when saving nonexisting tag.
                'createTagsAutomatically' => true,

//                    // Default tag selection criteria
//                    'scope' => array(
//                        'condition' => ' t.user_id = :user_id ',
//                        'params' => array( ':user_id' => Yii::app()->user->id ),
//                    ),

//                     Values to insert to tag table on adding tag
//                    'insertValues' => array(
//                        'lang_idss' => 1,
//                    ),
            ),
            'tagsru' => array(
                'class' => 'ext.taggable.EARTaggableBehavior',
                'tagTable' => 'tbl_tag',
                'tagModel' => 'Tag',
                'tagBindingTable' => 'tbl_blog_to_tag_ru',
                'modelTableFk' => 'blog_id',
                'tagTablePk' => 'id',
                'tagTableName' => 'name',
                'tagBindingTableTagId' => 'tag_id',
                'cacheID' => 'cache',
                'createTagsAutomatically' => true,
            ),
            'tagsen' => array(
                'class' => 'ext.taggable.EARTaggableBehavior',
                'tagTable' => 'tbl_tag',
                'tagModel' => 'Tag',
                'tagBindingTable' => 'tbl_blog_to_tag_en',
                'modelTableFk' => 'blog_id',
                'tagTablePk' => 'id',
                'tagTableName' => 'name',
                'tagBindingTableTagId' => 'tag_id',
                'cacheID' => 'cache',
                'createTagsAutomatically' => true,
            ),
            'changeNoBreakingSpace' => array(
                'class' => 'ext.nobreakingspace.NoBrakingSpace',
                'attributes' => array(
                    'title_ru', 'title_tm', 'title_en',
                    'description_ru', 'description_tm', 'description_en',
                    'text_ru', 'text_tm', 'text_en'
                )
            ),
            'loggingRecord' => array(
                'class' => 'ext.loggingrecord.LoggingRecord',
                'client_id' => $this->client_id,
                'worker_id' => $this->worker_id
            )
        ));
    }


//        
//        public function defaultScope()
//        {
//            return array(
//                'order' => 't.sort_order',
//            );      
//
//        }
//        
    public function scopes()
    {
        return array(
            'published' => array(
                'condition' => 't.status=1 AND t.date_modified <= NOW()',
            ),

            'translated_en' => array(
                'condition' => 't.title_en is not null AND CHAR_LENGTH(t.title_en)>10',
            ),

            'translated' => array(
                'condition' => 't.title_tm is not null AND CHAR_LENGTH(t.title_tm)>10',
            ),

            'not_translated' => array(
                'condition' => 't.title_ru is not null AND CHAR_LENGTH(t.title_ru)>10',
            ),

            'enabled' => array(
                'condition' => 't.status=1',
            ),

            'rss' => array(
                'condition' => 't.is_rss=1',
            ),

            'sort_newest' => array(
                'order' => 't.id desc',
            ),

            'sort_by_order' => array(
                'order' => 't.sort_order',
            ),

            'sort_by_order_desc' => array(
                'order' => 't.sort_order desc',
            ),

            'sort_by_date_desc' => array(
                'order' => 't.date_added desc',
            ),

            'most_popular' => array(
                'order' => 't.visited_count desc',
            ),

            'main' => array(
                'condition' => "is_main=1",
            ),

            'photoreport' => array(
                'condition' => "is_photoreport=1",
            ),

            'not_photoreport' => array(
                'condition' => "is_photoreport=0",
            ),

//            'sort_trend_desc' => array(
//                'select' => "DATEDIFF(NOW(), date_added)/visited_count as rating",
//                'order' => "rating desc",
//                'condition' => "date_added <  DATE_ADD(NOW(), INTERVAL -45 DAY) AND visited_count>1000",
//            ),

            'sort_trend_simple_asc' => array(
                'select' => "DATEDIFF(NOW(), date_added)/visited_count as rating",
                'order' => "rating asc",
                'condition' => "date_added > DATE_ADD(NOW(), INTERVAL -45 DAY) AND visited_count>1000",
            ),

            'sort_trend_asc' => array(
//                'select' => "date_added, (TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW()))/(visited_count*visited_count*visited_count)*100 as rating",
//                'select' => "date_added, (TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW()))/(visited_count*visited_count*visited_count*visited_count) as rating",
//                'select' => "date_added, (TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW()))/(visited_count*visited_count*visited_count) as rating",
                'select' => "date_added, (TIMESTAMPDIFF(HOUR, date_added, NOW())*TIMESTAMPDIFF(HOUR, date_added, NOW()))/(visited_count*visited_count) as rating",
                'order' => "rating asc, visited_count desc",
                'condition' => "date_added > DATE_ADD(NOW(), INTERVAL -30 DAY) AND date_added < DATE_ADD(NOW(), INTERVAL -5 HOUR) AND visited_count>600",
            ),

            'with_description' => array(
                'condition' => "language.code='" . Yii::app()->language . "'",
                'with' => array("descriptions", "descriptions.language"),
                'together' => true,
                'select' => array('t.*', 'descriptions.title as title', 'descriptions.description as description', 'descriptions.text as text')
            ),
        );
    }


    public function scope_except($data = array())
    {
        $this->getDbCriteria()->addNotInCondition('t.id', $data);
        return $this;
    }


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_blog';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status', 'required'),
            array('like_count, visited_count, sort_order, status, is_main, is_clients', 'numerical', 'integerOnly' => true),
            array('edited_username', 'length', 'max' => 255),
            array('title_tm,title_ru,title_en', 'length', 'max' => 170),
            array('date_added, date_modified', 'safe'),
            array('alias_tm', 'ext.LocoTranslitFilter', 'translitAttribute' => 'title_tm', 'setOnEmpty' => false),
            array('alias_ru', 'ext.LocoTranslitFilter', 'translitAttribute' => 'title_ru', 'setOnEmpty' => false),
            array('alias_en', 'ext.LocoTranslitFilter', 'translitAttribute' => 'title_en', 'setOnEmpty' => false),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, is_rss, is_interview, parent_category_id, category_id, web,is_photoreport, text_tm,text_ru,text_en, title_tm,title_ru,title_en, description_tm,description_ru,description_en,  like_count, visited_count, sort_order, status, is_main, is_clients, edited_username,create_username, date_added, date_modified, dislike_count', 'safe'),
            array('id, title, is_rss, is_interview, parent_category_id, category_id, web, is_photoreport, text_tm,text_ru,text_en,title_tm,title_ru,title_en, description_tm,description_ru,description_en,  like_count, visited_count, sort_order, status, is_main, is_clients, edited_username, create_username,date_added, date_modified,dislike_count', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
//                    'descriptions' => array(self::HAS_MANY, 'BlogDescription', 'blog_id'),
//                    'categories'=>array(self::MANY_MANY,'Category', 'tbl_blog_to_category(blog_id,category_id)'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'regions' => array(self::MANY_MANY, 'Regions', 'tbl_blog_to_regions(blog_id,region_id)'),
            'documents' => array(self::MANY_MANY, 'Documents', 'tbl_blog_to_documents(blog_id,documents_id)'),
            'documents_count' => array(self::STAT, 'Documents', 'tbl_blog_to_documents(blog_id,documents_id)'),
            'comment_count' => array(self::STAT, 'Comments', 'tbl_blog_to_comments(blog_id,comment_id)'),
            'worker' => array(self::HAS_ONE, 'WorkersLog', 'model_id', 'on' => "worker.model='".get_class($this)."'" ),
            'client' => array(self::HAS_ONE, 'ClientLog', 'model_id', 'on' => "client.model='".get_class($this)."'" ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'id'),
            'like_count' => Yii::t('app', 'like_count'),
            'dislike_count' => Yii::t('app', 'dislike_count'),
            'visited_count' => Yii::t('app', 'visited_count'),
            'sort_order' => Yii::t('app', 'sort_order'),
            'status' => Yii::t('app', 'status'),
            'is_main' => Yii::t('app', 'is_main'),
            'is_photoreport' => Yii::t('app', 'is_photoreport'),
            'is_clients' => Yii::t('app', 'is_clients'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'create_username' => Yii::t('app', 'create_username'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
            'category_id' => Yii::t('app', 'category_id'),
            'tmp_cat_id' => Yii::t('app', 'tmp_cat_id'),
            'tmp_cat_name' => Yii::t('app', 'tmp_cat_name'),
            'tbl_doc_name' => Yii::t('app', 'tbl_doc_name'),
            'temp_id' => Yii::t('app', 'temp_id'),
            'temp_city_id' => Yii::t('app', 'temp_city_id'),
            'temp_cat_name' => Yii::t('app', 'temp_cat_name'),
            'web' => Yii::t('app', 'web'),
            'parent_category_id' => Yii::t('app', 'parent_category_id'),
            'is_rss' => Yii::t('app', 'is_rss'),
            'is_interview' => Yii::t('app', 'is_interview'),
            'client_id' => 'Client',
            'worker_id' => 'Worker',
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('is_rss', $this->is_rss);
        $criteria->compare('like_count', $this->like_count);
        $criteria->compare('visited_count', $this->visited_count);
        $criteria->compare('sort_order', $this->sort_order);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('is_main', $this->is_main);
        $criteria->compare('is_photoreport', $this->is_photoreport);
        $criteria->compare('is_interview', $this->is_interview);
        $criteria->compare('is_clients', $this->is_clients);
        $criteria->compare('web', $this->web, true);
        $criteria->compare('edited_username', $this->edited_username, true);
        $criteria->compare('create_username', $this->create_username, true);
        $criteria->compare('date_added', $this->date_added, true);
        $criteria->compare('date_modified', $this->date_modified, true);

        $criteria->compare('t.title_ru', $this->title_ru, true);
        $criteria->compare('t.title_tm', $this->title_tm, true);

        $criteria->compare('t.description_ru', $this->description_ru, true);
        $criteria->compare('t.description_ru', $this->description_tm, true);

        $criteria->compare('t.text_ru', $this->text_ru, true);
        $criteria->compare('t.text_tm', $this->text_tm, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    public function searchByLanguage()
    {
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;

        $criteria->compare('t.title_ru', $this->title, true, 'OR');
        $criteria->compare('t.title_tm', $this->title, true, 'OR');
        $criteria->join = "LEFT JOIN tbl_clients_log c ON t.id = c.model_id and c.model='".get_class($this)."' "
        ."LEFT JOIN tbl_workers_log w ON t.id = w.model_id and w.model='".get_class($this)."'";
        $criteria->compare('c.client_id', $this->client_id);
        $criteria->compare('w.worker_id', $this->worker_id);

        if (!isset($_GET['Blog_sort']))
            $criteria->order = "t.id desc";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['pageSize'],
                'pageVar' => 'page',
            ),
        ));
    }


    public function searchForCategory($limit = 5, $models = false)
    {
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

        if ($limit > 0) {
            $criteria->limit = $limit;
            $criteria->offset = 0;
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

        if ($per_page === 0 && $_GET['api']){
            $per_page = 10;
        } else {
            $per_page = $per_page ? $per_page : Yii::app()->params['pageSize'];
        }
        if (!$_GET['api']) $page--;

        $criteria->select = array('t.id', 't.title_' . Yii::app()->language, 't.text_' . Yii::app()->language, 't.alias_' . Yii::app()->language, 't.description_' . Yii::app()->language, 'visited_count', 'date_added', 'category_id', 'like_count', 'status', 'is_photoreport');
        if ($models == false) {
            $dp = new CActiveDataProvider($this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)), 2),
//               $dp= new CActiveDataProvider($this, 
                array(
                    'criteria' => $criteria,
                    'pagination' => ($limit > 0) ? false : array(
                        'pageSize' => $per_page,
                        'pageVar' => 'page',
                        'currentPage' => $page,
                    ),
                ));
//                $dp->setTotalItemCount(count($this->findAll($criteria)));
            return $dp;
        } else {
            return $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->findAll($criteria);
//                return $this->findAll($criteria);
        }
    }


    public function getTitle()
    {
        $attribute = 'title_' . Yii::app()->getLanguage();
        if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) {
            $attribute = 'title_ru';
            if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) {
                $attribute = 'title_tm';
            }
        }

        return $this->{$attribute};
    }


    public function setTitle($value)
    {
        $attribute = 'title_' . Yii::app()->getLanguage();
        $this->{$attribute} = $value;
    }


    public function getText()
    {
        $attribute = 'text_' . Yii::app()->getLanguage();
        if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) {
            $attribute = 'text_ru';
            if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) {
                $attribute = 'text_tm';
            }
        }
        return $this->{$attribute};
    }


    public function setText($value)
    {
        $attribute = 'text_' . Yii::app()->getLanguage();
        $this->{$attribute} = $value;
    }

    public function getDescription($strict = false)
    {
        $attribute = 'description_' . Yii::app()->getLanguage();
        if ((!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) && $strict == false) {
            $attribute = 'description_ru';
            if (!isset($this->{$attribute}) || strlen(trim($this->{$attribute})) == 0) {
                $attribute = 'description_tm';
            }
        }
        return $this->{$attribute};
    }

    public function setDescription($value)
    {
        $attribute = 'description_' . Yii::app()->getLanguage();
        $this->{$attribute} = $value;
    }


    public function getMixedDescriptionModel()
    {
        return $this;
    }

    public function apiSearchForCategory($per_page = 10, $page = 0)
    {
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

        if (isset($this->except) && count($this->except) > 0) {
            $criteria->addNotInCondition('t.id', $this->except);
        }
        if (isset($this->categoryid_except) && count($this->categoryid_except) > 0) {
            $criteria->addNotInCondition('t.category_id', $this->categoryid_except);
        }
        if ($this->video == true){
            $criteria->join = 'LEFT JOIN tbl_blog_to_documents rel ON `t`.`id` = `rel`.`blog_id`'
                .'LEFT JOIN tbl_documents doc ON `rel`.`documents_id` = `doc`.`id`';
            $criteria->addCondition('length(doc.video_path) > 0 ');
        }

        $criteria->addCondition('length(t.title_' . Yii::app()->language . ') > 0 ');

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
