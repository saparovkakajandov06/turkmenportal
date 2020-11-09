<?php

/**
 * This is the model class for table "tbl_catalog".
 *
 * The followings are the available columns in table 'tbl_catalog':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $owner
 * @property string $alias
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
class Advert extends ActiveRecord
{


    public $parent_category_id, $catalog_category_id, $title, $description, $content, $name, $parent_category_code, $category_code, $file, $image, $mini_search, $category_name;
    public $state_name = 'state_advert';
    public $price_start;
    public $price_end;
    public $year_start;
    public $year_end;
    public $except;

    /**
     * @return string the associated database table name
     */
    private $_url;
    private $_urlupdate;


    public function getUrl()
    {
        if ($this->_url === null)
            $this->_url = Yii::app()->createAbsoluteUrl('advert/view', array('id' => $this->id));
        return strlen(trim($this->_url)) > 0 ? $this->_url : "#";
    }


    public function getUrlupdate(){
        if ($this->_urlupdate === null)
            if(Yii::app()->user->checkAccess('Advert.Update')){
                $this->_urlupdate = Yii::app()->createUrl('item/index', array('code'=>'advert','id'=>$this->id));
            }

        return $this->_urlupdate;
    }

//    public function getUrlupdate()
//    {
//        if ($this->_urlupdate === null)
//            if (Yii::app()->user->checkAccess('Catalog.Update'))
//                $this->_urlupdate = Yii::app()->createUrl('advert/update', array('id' => $this->id));
//            else
//                $this->_urlupdate = Yii::app()->createUrl('advert/general', array('id' => $this->id));
//
//        return $this->_urlupdate;
//    }


    public function behaviors()
    {
        return array_merge(parent::behaviors(), array(
                'xupload' => array(
                    'class' => 'ext.xupload.components.XUploadBehavior',
                    'state_name' => $this->state_name,
                    'related_table_name' => 'tbl_advert_to_documents',
                )
            )
        );
    }


    public function tableName()
    {
        return 'tbl_advert';
    }

    public function scopes()
    {
        return array(
            'published' => array(
                'condition' => 't.status=1 AND t.date_modified <= NOW()',
            ),

            'enabled' => array(
                'condition' => 't.status=1',
            ),

            'sort_newest' => array(
                'order' => 't.date_added desc',
            ),
            'with_description' => array(
                'condition' => "language.code='" . Yii::app()->language . "'",
                'with' => array("descriptions", "descriptions.language"),
                'together' => true,
                'select' => array('t.*', 'descriptions.title as title', 'descriptions.description as description', 'descriptions.text as text')
            ),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status', 'numerical', 'integerOnly' => true),
            array('region_id, category_id', 'length', 'max' => 20),
            array('owner, address, phone, mail, web, rating, edited_username, create_username', 'length', 'max' => 255),
            array('views, dislikes, likes', 'length', 'max' => 10),
            array('period, date_added, date_modified', 'safe'),
            array('alias', 'ext.LocoTranslitFilter', 'translitAttribute' => 'title'),
            array('mail', 'email'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('owner, catalog_category_id,id, currency,title,description, content,  alias, name,title,price,description, region_id, category_id, address, phone, mail, web, rating, period, views, dislikes,likes, status, edited_username, create_username, date_added, date_modified', 'safe'),
            array('owner, id,name,title,price,description, region_id, category_id, address, phone, mail, web, rating, period, views, dislikes,likes, status, edited_username, create_username, date_added, date_modified', 'safe', 'on' => 'search'),
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
//            'descriptions' => array(self::HAS_MANY, 'CatalogDescription', 'catalog_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'region' => array(self::BELONGS_TO, 'Regions', 'region_id'),
            'documents' => array(self::MANY_MANY, 'Documents', 'tbl_advert_to_documents(advert_id,documents_id)'),
            'comment_count' => array(self::STAT, 'Comments', 'tbl_advert_to_comments(advert_id,comment_id)'),
        );
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'id'),
            'region_id' => Yii::t('app', 'region_id'),
            'category_id' => Yii::t('app', 'category_id'),
            'temp_old_cat_id_zapas' => Yii::t('app', 'temp_old_cat_id_zapas'),
            'address' => Yii::t('app', 'address'),
            'phone' => Yii::t('app', 'phone'),
            'mail' => Yii::t('app', 'mail'),
            'web' => Yii::t('app', 'web'),
            'rating' => Yii::t('app', 'rating'),
            'period' => Yii::t('app', 'period'),
            'views' => Yii::t('app', 'views'),
            'likes' => Yii::t('app', 'likes'),
            'dislikes' => Yii::t('app', 'dislikes'),
            'status' => Yii::t('app', 'status'),
            'owner' => Yii::t('app', 'owner'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'create_username' => Yii::t('app', 'create_username'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
            'catalog_category_id' => Yii::t('app', 'catalog_category_id'),
            'title' => Yii::t('app', 'title'),
            'description' => Yii::t('app', 'description'),
            'content' => Yii::t('app', 'content'),
            'price' => Yii::t('app', 'price'),
            'currency' => Yii::t('app', 'currency'),
            'year' => Yii::t('app', 'year'),
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

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.region_id', $this->region_id);
        $criteria->compare('t.category_id', $this->category_id);
        $criteria->compare('t.address', $this->address, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('mail', $this->mail, true);
        $criteria->compare('web', $this->web, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('currency', $this->currency);
        $criteria->compare('rating', $this->rating, true);
        $criteria->compare('period', $this->period, true);
        $criteria->compare('views', $this->views, true);
        $criteria->compare('likes', $this->likes, true);
        $criteria->compare('dislikes', $this->dislikes, true);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.owner', $this->owner, true);
        $criteria->compare('t.edited_username', $this->edited_username, true);
        $criteria->compare('t.create_username', $this->create_username, true);
        $criteria->compare('t.date_added', $this->date_added, true);
        $criteria->compare('t.date_modified', $this->date_modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Catalog the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function getTitle()
    {
        $attribute = 'title';
        return $this->{$attribute};
    }


    public function setTitle($value)
    {
        $attribute = 'title';
        $this->{$attribute} = $value;
    }


    public function getDescription()
    {
        $attribute = 'description';
        return $this->{$attribute};
    }


    public function setDescription($value)
    {
        $attribute = 'description';
        $this->{$attribute} = $value;
    }



    public function getDetails($label = false)
    {
        $content_text = "";
        if (isset($this->description)) {
            if ($label == true)
                $content_text .= Yii::t('app', 'description') . ': ' . $this->description . ', ';
            else
                $content_text .= $this->description. ', ';
        }

        if (isset($this->category_id)) {
            if ($label == true)
                $content_text .= Yii::t('app', 'category_id') . ': ' . $this->category->name . ', ';
            else
                $content_text .= $this->category->name . ', ';
        }

        if (isset($this->region_id)) {
            if ($label == true)
                $content_text .= Yii::t('app', 'region_id') . ': ' . $this->getRegionName() . ', ';
            else
                $content_text .= $this->getRegionName() . ', ';
        }
//
//        if (isset($this->color)) {
//            if ($label == true)
//                $content_text .= Yii::t('app', 'color') . ": " . $this->getColorText() . ', ';
//            else
//                $content_text .= $this->getColorText() . ', ';
//        }
//
//        if (isset($this->bodytype)) {
//            if ($label == true)
//                $content_text .= Yii::t('app', 'bodytype') . ": " . $this->getBodyTypeText() . ', ';
//            else
//                $content_text .= $this->getBodyTypeText() . ', ';
//        }
//
//        if (isset($this->odometer_unit)) {
//            if ($label == true)
//                $content_text .= Yii::t('app', 'trip') . ": <i>" . $this->trip . "</i> " . $this->getOdometerUnitText() . ', ';
//            else
//                $content_text .= $this->getOdometerUnitText() . ', ';
//        }
//
//        if (isset($this->transmission)) {
//            if ($label == true)
//                $content_text .= Yii::t('app', 'transmission') . ": " . $this->getTransmissionText() . ', ';
//            else
//                $content_text .= $this->getTransmissionText() . ', ';
//        }
//
//        if (isset($this->engine_capacity)) {
//            if ($label == true)
//                $content_text .= Yii::t('app', 'engine_capacity') . ": " . $this->engine_capacity . Yii::t('app', 'litre') . ', ';
//            else
//                $content_text .= $this->engine_capacity . Yii::t('app', 'litre') . ', ';
//        }
//
//        if (isset($this->drivetrain)) {
////                if($label==true)
//            $content_text .= Yii::t('app', 'drivetrain') . ": " . $this->getDrivetrainText() . '. ';
////                else
////                    $content_text.=$this->getDrivetrainText().'. ';
//        }

        return $content_text;
    }

    public function searchForCategory($limit = 50, $models = false, $beforeToday = null)
    {
        $criteria = new CDbCriteria;
//            $criteria->with=array("category");

        if (isset($this->parent_category_id)) {
//                $criteria->with=array("category");
//                $criteria->compare('category.parent_id', $this->parent_category_id);
            $criteria->compare('t.parent_category_id', $this->parent_category_id);
        }

        if ($this->category_id)
            $criteria->compare('t.category_id', $this->category_id);
//            if($this->category_code)
//                $criteria->compare('category.code', $this->category_code);
//            if($this->parent_category_code)
//                $criteria->compare('category.parent_code', $this->parent_category_code);


        if ($this->except) {
            $criteria->addNotInCondition('t.id', $this->except);
        }


        if (isset($this->mini_search)) {
            $criteria->with = array("category", "category.parent", 'descriptions');
            $criteria->together = true;
            $criteria->compare('descriptions.title', $this->mini_search, true);
        }


//            $criteria->select=array('id','category_id','title_'.Yii::app()->language,'content_'.Yii::app()->language);
        $criteria->scopes = array('enabled', 'sort_newest');

        if ($limit > 0) {
            $criteria->limit = $limit;
            $criteria->offset = 0;
        }


        if ($models == false) {
//               $dp= new CActiveDataProvider(self::model()->cache(Yii::app()->params['cache_duration'],new CTagCacheDependency(get_class($this)), 2),
            $dp = new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'pagination'=>($limit > 0) ? false : array(
                        'pageSize'=> Yii::app()->params['pageSize'],
                        'pageVar'=>'page',
                    ),
                ));
            return $dp;
        } else {
//                return $this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)))->findAll($criteria);
            return $this->findAll($criteria);
        }
    }


    
    public function searchByLanguage()
    {
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;

//            $criteria->with=array("descriptions","descriptions.language");
        $criteria->with = array("category");
//            $criteria->together=true;
//            $criteria->compare('language.code', Yii::app()->language);
//            $criteria->compare('t.category_id'.Yii::app()->language, $this->title,true);
        $criteria->compare('t.title_' . Yii::app()->language, $this->title, true);
        $criteria->compare('t.name_' . Yii::app()->language, $this->name, true);
        $criteria->compare('t.description_' . Yii::app()->language, $this->description, true);
        $criteria->order = "t.id desc";


        $criteria->select = array('t.*', 'category.name_' . Yii::app()->language . ' as category_name');
        return new CActiveDataProvider(self::model()->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)), 2), array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['pageSize'],
                'pageVar'=>'page',
            ),
        ));
    }




}
