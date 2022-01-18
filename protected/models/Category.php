<?php

/**
 * This is the model class for table "tbl_category".
 *
 * The followings are the available columns in table 'tbl_category':
 * @property integer $id
 * @property string $image
 * @property integer $parent_id
 * @property integer $related_category_id
 * @property integer $top
 * @property integer $is_announcement
 * @property integer $column
 * @property integer $code
 * @property string $url_prefix
 * @property string $name_tm
 * @property string $name_ru
 * @property string $description_tm
 * @property string $description_ru
 * @property string $meta_description_tm
 * @property string $meta_description_ru
 * @property string $alias_tm
 * @property string $alias_ru
 * @property integer $sort_order
 * @property integer $status
 * @property string $date_added
 * @property string $date_modified
 */
class Category extends ActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_category';
    }


//        public $name,$description,$is_used;
    private $_url;
    public $parent_name;
    protected $urlPrefix = '';


    public function getUrl($absolute = false) {
//        echo "BASE: ".Yii::app()->request->baseUrl;
        if ($this->_url === null) {
//            $this->_url = Yii::app()->request->baseUrl . '/' . $this->urlPrefix . $this->getPath("/", true) . Yii::app()->urlManager->urlSuffix;
            $this->_url = '/' . $this->urlPrefix . $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->getPath("/", true) . Yii::app()->urlManager->urlSuffix;
//            $this->_url =  $this->urlPrefix . $this->cache(Yii::app()->params['cache_duration'],new CTagCacheDependency(get_class($this)))->getPath() . Yii::app()->urlManager->urlSuffix;
            $this->_url = DMultilangHelper::addLangToUrl($this->_url);
            if ($absolute == true)
                $this->_url = Yii::app()->getBaseUrl(true) . '/' . trim($this->_url, '/');
        }
        return $this->_url;
    }


    public function getTmUrl($absolute = false) {

//        echo "BASE: ".Yii::app()->getBaseUrl(true);
//        if ($this->_url === null){
//            $this->_url = Yii::app()->request->baseUrl . '/' . $this->urlPrefix . $this->getPath("/", true) . Yii::app()->urlManager->urlSuffix;
        $path = $this->getPath("/", true);
        $path = $this->urlPrefixValue . '/' . ltrim($this->translatePath($path, 'tm'), '/');
        $url = DMultilangHelper::addSpecificLangToUrl($this->urlPrefix . $path . Yii::app()->urlManager->urlSuffix, 'tm');

//            $url = $this->urlPrefix .$path. Yii::app()->urlManager->urlSuffix;
        if ($absolute == true)
            $url = Yii::app()->getBaseUrl(true) . '/' . trim($url, '/');

//            $this->_url =  $this->urlPrefix . $this->cache(Yii::app()->params['cache_duration'],new CTagCacheDependency(get_class($this)))->getPath() . Yii::app()->urlManager->urlSuffix;
//            $url=$url,'tm');
//        }
        return $url;
    }


    public function behaviors() {
        return array_merge(parent::behaviors(), array(
                'CategoryTreeBehavior' => array(
                    'class' => 'DCategoryTreeBehavior',
                    'titleAttribute' => 'name_' . Yii::app()->getLanguage(),
                    'aliasAttribute' => 'alias_' . Yii::app()->getLanguage(),
                    'urlAttribute' => 'url',
                    'urlPrefix' => 'url_prefix',
                    'requestPathAttribute' => 'path',
                    'parentAttribute' => 'parent_id',
                    'parentRelation' => 'parent',
                    'defaultCriteria' => array(
                        'order' => 't.sort_order ASC'
                    ),
                ),
                'xupload' => array(
                    'class' => 'ext.xupload.components.XUploadBehavior',
                    'state_name' => 'state_category',
                    'related_table_name' => 'tbl_category_to_documents',
                )
            )
        );
    }


    public function scopes() {
        return array(
            'topmenu' => array(
                'condition' => 't.top=1 AND t.parent_id is null',
                'order' => 'sort_order asc',
//                    'limit'=>5,
            ),

            'published' => array(
                'condition' => 't.status=1',
            ),

            'is_top' => array(
                'condition' => 't.top=1',
            ),

            'not_topmenu' => array(
                'condition' => 't.top=0 AND t.parent_id is null',
                'order' => 'sort_order asc',
            ),

            'no_parent' => array(
                'condition' => 't.parent_id is null',
            ),

            'no_related' => array(
                'condition' => 't.related_category_id is null',
            ),

            'with_parent' => array(
                'condition' => 't.parent_id is not null',
            ),

            'sort_by_alpha' => array(
                'order' => 't.name_' . Yii::app()->language . ' asc',
            ),

            'sort_by_sort_order' => array(
                'order' => 't.sort_order asc',
            ),

            'sort_by_sort_order_desc' => array(
                'order' => 't.sort_order desc',
            ),

            'enabled' => array(
                'condition' => 't.status=1',
            ),

            'enabled_for_announcement' => array(
                'condition' => 't.is_announcement=1',
            ),

            'mobile' => array(
                'condition' => 'not t.id in (293,288,286)',
            ),

//                'with_description'=>array(
//                    'condition'=>"language.code='".Yii::app()->language."'",
//                    'with'=>array("descriptions","descriptions.language"),
//                    'together'=>true,
//                    'select'=>array('t.*','descriptions.name as name','descriptions.description as description')
//                ),
        );
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//			array(' column', 'required'),
            array('parent_id, top, column, sort_order, status', 'numerical', 'integerOnly' => true),
            array('image', 'length', 'max' => 255),
            array('date_added, date_modified,code', 'safe'),
            array('alias_tm', 'ext.LocoTranslitFilter', 'translitAttribute' => 'name_tm'),
            array('alias_ru', 'ext.LocoTranslitFilter', 'translitAttribute' => 'name_ru'),
            array('alias_en', 'ext.LocoTranslitFilter', 'translitAttribute' => 'name_en'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, url_prefix, related_category_id, name_tm, name_ru,name_en,description_tm, description_ru,description_en, meta_description_tm, meta_description_ru,meta_description_en,meta_keyword_tm, meta_keyword_ru,meta_keyword_en, alias_tm, alias_ru,alias_en, is_announcement, image,name,description, parent_id, top, code,column, sort_order, status, date_added, date_modified', 'safe'),
            array('id, url_prefix,related_category_id,image,name,description, parent_id, top, code,column, sort_order, status, date_added, date_modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
//                     'descriptions' => array(self::HAS_MANY, 'CategoryDescription', 'category_id'),
            'parent' => array(self::BELONGS_TO, 'Category', 'parent_id'),
            'children' => array(self::HAS_MANY, 'Category', 'parent_id'),
            'related_children' => array(self::HAS_MANY, 'Category', 'related_category_id'),
            'related' => array(self::BELONGS_TO, 'Category', 'related_category_id'),
            'documents' => array(self::MANY_MANY, 'Documents', 'tbl_category_to_documents(category_id,documents_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'id'),
            'temp_old_id' => Yii::t('app', 'temp_old_id'),
            'image' => Yii::t('app', 'image'),
            'parent_id' => Yii::t('app', 'parent_id'),
            'related_category_id' => Yii::t('app', 'related_category_id'),
            'code' => Yii::t('app', 'code'),
            'top' => Yii::t('app', 'top'),
            'column' => Yii::t('app', 'column'),
            'sort_order' => Yii::t('app', 'sort_order'),
            'status' => Yii::t('app', 'status'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'create_username' => Yii::t('app', 'create_username'),
            'temp_ru_name' => Yii::t('app', 'temp_ru_name'),
            'is_used' => Yii::t('app', 'is_used'),
            'url_prefix' => Yii::t('app', 'url_prefix'),
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

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.image', $this->image, true);
        $criteria->compare('t.code', $this->code, true);
        $criteria->compare('t.related_category_id', $this->related_category_id);
        $criteria->compare('t.parent_id', $this->parent_id);
        $criteria->compare('t.top', $this->top);
        $criteria->compare('t.is_announcement', $this->is_announcement);
        $criteria->compare('t.column', $this->column);
        $criteria->compare('t.sort_order', $this->sort_order);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.url_prefix', $this->url_prefix, true);
        $criteria->compare('t.date_added', $this->date_added, true);
        $criteria->compare('t.date_modified', $this->date_modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    public function searchByLanguage() {
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;

//            $criteria->compare('language.code', Yii::app()->language);
        $criteria->compare('name_' . Yii::app()->language, $this->name, true);
        $criteria->compare('description_' . Yii::app()->language, $this->description, true);
        $criteria->order = "t.id desc";

//            $criteria->select=array('t.*','descriptions.name as name','descriptions.description as description',);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
        ));
    }


    public function searchAnnouncements($code = null, $parent_id = null) {
        $criteria = new CDbCriteria();
        if (isset($parent_id)) {
            $criteria->compare('parent_id', $parent_id);
        } else {
            $criteria->addCondition('t.parent_id is not null');
        }

        if (isset($code)) {
            $criteria->with = array("parent");
            $criteria->compare('parent.code', $code);
            $criteria->compare('t.code', $code, false, 'OR');
        }

        $criteria->addCondition('t.name_' . Yii::app()->language . ' is not null');
        $criteria->scopes = array('enabled', 'enabled_for_announcement', 'sort_by_alpha');

        $data = Category::model()->findAll($criteria);
        return $data;
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    public function getSiblingCategories($category_id) {
        $criteria = new CDbCriteria();
        $categoryModel = Category::model()->findByPk($category_id);
        if (isset($categoryModel)) {
            $criteria->compare('t.parent_id', $categoryModel->parent_id);
        }
        $criteria->addCondition('t.name_' . Yii::app()->language . ' is not null');
        $criteria->scopes = array('enabled', 'sort_by_alpha');

        $data = Category::model()->findAll($criteria);
        $data = CHtml::listData($data, 'id', 'name_' . Yii::app()->language);
        return $data;
    }


    public function getListByParentCode($parent_code) {
        $criteria = new CDbCriteria();
        $criteria->with = array("parent");
        $criteria->compare('parent.code', $parent_code);
        $criteria->addCondition('t.name_' . Yii::app()->language . ' is not null');
        $criteria->scopes = array('enabled', 'sort_by_alpha');

            $data = Category::model()->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency('Category'), 1)->findAll($criteria);
        $data = CHtml::listData($data, 'id', 'name_' . Yii::app()->language);
        return $data;
    }


    public function getListByParentId($parent_id) {
        $data = array();
        if (isset($parent_id) && strlen(trim($parent_id)) > 0) {
            $criteria = new CDbCriteria();
            $criteria->compare('parent_id', $parent_id);
            $criteria->addCondition('t.name_' . Yii::app()->language . ' is not null');
            $criteria->scopes = array('enabled', 'sort_by_alpha');

            $data = Category::model()->findAll($criteria);
            var_dump();die;
            $data = CHtml::listData($data, 'id', 'name_' . Yii::app()->language);
        }

        return $data;
    }


    public function getSubcategoryList() {

        $criteria = new CDbCriteria();
        $criteria->compare('parent_id', $this->id);
        $criteria->addCondition('t.name_' . Yii::app()->language . ' is not null');
        $criteria->scopes = array('enabled');

        $criteria->select = array('id', 'parent_id', 'url_prefix', 'name_' . Yii::app()->language, 'alias_' . Yii::app()->language);

        return $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->findAll($criteria);
//            return $this->findAll($criteria);

    }


    public function getCatalogCategoriesList() {
        $criteria = new CDbCriteria();
//            $criteria->compare('top', 0);
        $criteria->scopes = array('enabled', 'sort_by_alpha');
        $criteria->addCondition('parent_id is null');
        $criteria->addCondition('name_' . Yii::app()->language . ' is not null');


        $data = Category::model()->findAll($criteria);
        $data = CHtml::listData($data, 'id', 'name_' . Yii::app()->language);
        return $data;
    }


    public function getAnnouncementCategories($parent_id = null) {
        $criteria = new CDbCriteria();
        $criteria->with = array('parent');
        $criteria->scopes = array('enabled', 'enabled_for_announcement');

        $criteria->addCondition('t.name_' . Yii::app()->language . ' is not null');
        if (isset($parent_id))
            $criteria->compare('t.parent_id', $parent_id);
        else
            $criteria->addCondition('t.parent_id is not null and parent.parent_id is null');

        $criteria->select = array('t.*', 'parent.name_' . Yii::app()->language . ' as parent_name');
        $criteria->order = "parent.sort_order asc";

        $dataTemp = Category::model()->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class(new Category())), 2)->findAll($criteria);

        $data = array();
        foreach ($dataTemp as $value) {
            if (isset($parent_id))
                $data[$value->id] = $value->name;
            else
                $data[$value->parent_name][$value->id] = $value->name;
        }

        return $data;
    }


    public function getParentCategoriesList($codeList = array()) {
        $criteria = new CDbCriteria();
        $criteria->scopes = array('enabled', 'sort_by_alpha');
        $criteria->addCondition('parent_id is null');
        $criteria->addCondition('name_' . Yii::app()->language . ' is not null');
        if (count($codeList) > 0) {
            $criteria->addInCondition('code', $codeList);
        }

        $data = Category::model()->findAll($criteria);
        $data = CHtml::listData($data, 'id', 'name_' . Yii::app()->language);
        return $data;
    }


    function getCategoryTreeList() {
        $criteria = new CDbCriteria();
        $criteria->with = array('parent');
        $criteria->scopes = array('enabled', 'sort_by_alpha');

        $criteria->addCondition('t.name_' . Yii::app()->language . ' is not null');
        $criteria->addCondition('t.parent_id is not null');
        $criteria->select = array('t.*', 'parent.name_' . Yii::app()->language . ' as parent_name');

        $dataTemp = Category::model()->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class(new Category())), 2)->findAll($criteria);
//            $dataTemp=CHtml::listData($dataTemp,'id','name');

        $data = array();
        foreach ($dataTemp as $value) {
            $data[$value->parent_name][$value->id] = $value->name;
        }

        return $data;
    }


    function isCategoryUsed() {
        $sql = 'SELECT count(*) FROM tbl_catalog WHERE category_id=' . $this->id;
        $command = Yii::app()->db->createCommand($sql);
//            $command->bindParam(':cat_id', $this->id,  PDO::PARAM_INT);
        $count = $command->queryScalar();
        if (isset($count) && $count > 0)
            return Yii::t('app', 'Yes');

        $sql = 'SELECT count(*) FROM tbl_blog WHERE category_id=' . $this->id;
        $command = Yii::app()->db->createCommand($sql);
//            $command->bindParam(':cat_id', $this->id,  PDO::PARAM_INT);
        $count = $command->queryScalar();
        if (isset($count) && $count > 0)
            return Yii::t('app', 'Yes');

        $sql = 'SELECT count(*) FROM tbl_auto WHERE category_id=' . $this->id;
        $command = Yii::app()->db->createCommand($sql);
//            $command->bindParam(':cat_id', $this->id,  PDO::PARAM_INT);
        $count = $command->queryScalar();
        if (isset($count) && $count > 0)
            return Yii::t('app', 'Yes');

        $sql = 'SELECT count(*) FROM tbl_estates WHERE category_id=' . $this->id;
        $command = Yii::app()->db->createCommand($sql);
//            $command->bindParam(':cat_id', $this->id,  PDO::PARAM_INT);
        $count = $command->queryScalar();
        if (isset($count) && $count > 0)
            return Yii::t('app', 'Yes');


        return '<span style="color:#f11;">' . Yii::t('app', 'No') . '</span>';
    }


    public function getName() {
        $attribute = 'name_' . Yii::app()->getLanguage();
//            if(!isset($this->{$attribute}) || strlen(trim($this->{$attribute}))==0){
//                $attribute = 'name_ru';
//                if(!isset($this->{$attribute}) || strlen(trim($this->{$attribute}))==0){
//                    $attribute = 'name_tm';
//                }
//            }
//            
        return $this->{$attribute};
    }


    public function setName($value) {
        $attribute = 'name_' . Yii::app()->getLanguage();
        $this->{$attribute} = $value;
    }


    public function getDescription() {
        $attribute = 'description_' . Yii::app()->getLanguage();
//            if(!isset($this->{$attribute}) || strlen(trim($this->{$attribute}))==0){
//                $attribute = 'description_ru';
//                if(!isset($this->{$attribute}) || strlen(trim($this->{$attribute}))==0){
//                    $attribute = 'description_tm';
//                }
//            }
        return $this->{$attribute};
    }


    public function setDescription($value) {
        $attribute = 'description_' . Yii::app()->getLanguage();
        $this->{$attribute} = $value;
    }


    protected function getParents($with_self) {
        if (!isset($this->id)) return;

        $categoryModel = self::model()->findByPk($this->id);
        $categories = array();

        if ($with_self == TRUE)
            $categories[] = $categoryModel;

        if (isset($categoryModel->parent_id) && $categoryModel->parent_id > 0) {
            $categoryModel = self::model()->findByPk($categoryModel->parent_id);

            if (isset($categoryModel)) {
                $categories[] = $categoryModel;
                if (isset($categoryModel->parent_id) && $categoryModel->parent_id > 0) {
                    $categoryModel = self::model()->findByPk($categoryModel->parent_id);
                    if (isset($categoryModel))
                        $categories[] = $categoryModel;
                }
            }
        } else
            return $categories;


        return array_reverse($categories);
    }


    public function getParentInheritance($with_self = TRUE) {
        if (!isset($this->id)) return;

//            $parents[]=$this;
        $parents = $this->getParents($with_self);
        $name = "";
        foreach ($parents as $key => $cat) {
            $name .= $cat->getAttribute("name_" . Yii::app()->language);
            if ((count($parents) - 1) > $key)
                $name .= " -> ";
        }

        return $name;
    }


    public function getParentName() {
        $parent = $this->parent;
        if (isset($parent)) {
            return $parent->getName();
        } else
            return "";
    }


    public function getRelatedCategoryName() {
        $related = $this->related;
        if (isset($related)) {
            return $related->getName();
        } else
            return "";
    }


    public function findParentCategoryByCode($code) {
        $parentCategoryModel = Category::model()->sort_by_alpha()->findByAttributes(array('code' => $code, 'parent_id' => null));
        return $parentCategoryModel;
    }
//
//        public function findParentCategoryByPrimary($id){
//            $parentCategoryModel=Category::model()->findByPk($id);
//            return $parentCategoryModel;
//        }


//        public function getMixedDescriptionModel(){
//            $descriptions=$this->descriptions;
//            if(isset ($descriptions) && count($descriptions)==1){
//                return $descriptions[0];
//            }
//            else{
//                foreach ($descriptions as $description) {
//                    if($description->language->code==Yii::app()->language){
//                        return $description;
//                    }
//                }
//            }
//        }
//        

    public function getChilds($parent_id)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $parent_id);
        return Category::model()->findAll($criteria);
    }
}
