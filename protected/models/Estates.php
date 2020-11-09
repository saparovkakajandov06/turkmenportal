<?php

/**
 * This is the model class for table "tbl_estates".
 *
 * The followings are the available columns in table 'tbl_estates':
 * @property string $id
 * @property string $region_id
 * @property string $category_id
 * @property string $phone
 * @property string $mail
 * @property string $web
 * @property integer $type
 * @property string $room
 * @property string $year
 * @property string $meter
 * @property string $price
 * @property integer $currency
 * @property string $rating
 * @property string $period
 * @property string $views
 * @property string $likes
 * @property integer $status
 * @property string $edited_username
 * @property string $create_username
 * @property string $date_added
 * @property string $date_modified
 */
class Estates extends ActiveRecord
{
    public $catalog_category_id;
    public $year_start;
    public $year_end;
    public $price_start;
    public $price_end;
    public $meter_start;
    public $meter_end;
    public $fulltitle;
    public $except;

    private $_url;
    private $_urlupdate;

    const TYPE_KVARTIRA = 1, TYPE_DOM = 2, TYPE_ZEMELNYY_UCASTOK = 3, TYPE_GARAZ = 4, TYPE_SKLAD = 5, TYPE_MAGAZIN = 6, TYPE_OFIS = 7, TYPE_OTHER = 8;

    public function getTypeOptions($counter = false)
    {
        $types = array(
            self::TYPE_KVARTIRA => Yii::t('app', 'TYPE_KVARTIRA'),
            self::TYPE_DOM => Yii::t('app', 'TYPE_DOM'),
            self::TYPE_ZEMELNYY_UCASTOK => Yii::t('app', 'TYPE_ZEMELNYY_UCASTOK'),
            self::TYPE_GARAZ => Yii::t('app', 'TYPE_GARAZ'),
            self::TYPE_SKLAD => Yii::t('app', 'TYPE_SKLAD'),
            self::TYPE_MAGAZIN => Yii::t('app', 'TYPE_MAGAZIN'),
            self::TYPE_OFIS => Yii::t('app', 'TYPE_OFIS'),
            self::TYPE_OTHER => Yii::t('app', 'TYPE_OTHER'),
        );

        if ($counter == true) {
            foreach ($types as $key => $type) {
                $criteria = new CDbCriteria();
                $criteria->compare('status', 1);
                $criteria->compare('type', $key);
                $criteria->compare('category_id', $this->category_id);
                $type .= ' (' . $this->count($criteria) . ")";
                $types[$key] = $type;
            }
        }

        return $types;
    }

    public function getTypeText()
    {
        $typeOptions = $this->typeOptions;
        return isset($typeOptions[$this->type]) ? $typeOptions[$this->type] : Yii::t('app', '');
    }


    public function getRoomOptions()
    {
        $rooms = array();
        for ($i = 1; $i < 15; $i++) {
            $rooms[$i] = $i;
        }
        return $rooms;
    }

//        const EDUCATION_TYPE_MEDIUM = 1, EDUCATION_TYPE_MEDIUM_SPECIAL= 2, EDUCATION_TYPE_HIGH = 3; 
//        
//        public function getEducationTypes() {
//              return array(
//                  self::EDUCATION_TYPE_MEDIUM => Yii::t('app','EDUCATION_TYPE_MEDIUM'),
//                  self::EDUCATION_TYPE_MEDIUM_SPECIAL => Yii::t('app','EDUCATION_TYPE_MEDIUM_SPECIAL'),
//                  self::EDUCATION_TYPE_HIGH => Yii::t('app','EDUCATION_TYPE_HIGH'),
//              );
//        }
//
//
//        public function getEducationText() {
//             $educationTypes = $this->educationTypes;
//             return isset($educationTypes[$this->education]) ? $educationTypes[$this->education] : Yii::t('app','EDUCATION_TYPE_UNKNOWN');
//        }
//        
    public function behaviors()
    {
        return array_merge(parent::behaviors(), array(
                'xupload' => array(
                    'class' => 'ext.xupload.components.XUploadBehavior',
                    'state_name' => 'state_estates',
                    'related_table_name' => 'tbl_estates_to_documents',
                )
            )
        );
    }


    public function scopes()
    {
        return array(
            'published' => array(
                'condition' => 't.status=1 AND t.date_modified <= NOW()',
            ),
            'active' => array(
                'condition' => 't.date_end is not null AND t.date_end >= NOW()',
            ),
            'passive' => array(
                'condition' => 't.date_end < NOW()',
            ),
            'enabled' => array(
                'condition' => 't.status=1',
            ),

            'sort_newest' => array(
                'order' => 't.date_added desc',
            ),
        );
    }


    public function createAbsoluteUrl()
    {
        if ($this->_url === null)
            $this->_url = Yii::app()->createAbsoluteUrl('estates/view', array('id' => $this->id));
        return $this->_url;
    }

    public function getUrl()
    {
        if ($this->_url === null)
            $this->_url = Yii::app()->createAbsoluteUrl('estates/view', array('id' => $this->id));
        return $this->_url;
    }

    public function getUrlupdate()
    {
        if ($this->_urlupdate === null)
            $this->_urlupdate = Yii::app()->createUrl('item/index', array('code' => 'estates', 'id' => $this->id,));

        return $this->_urlupdate;
    }


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_estates';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('views, likes,category_id', 'required'),
            array('type, status', 'numerical', 'integerOnly' => true),
            array('region_id', 'length', 'max' => 20),
            array('category_id', 'length', 'max' => 11),
            array('phone, mail, web, year, meter, price, rating, edited_username, create_username', 'length', 'max' => 255),
            array('room, views, likes', 'length', 'max' => 10),
            array('period, date_added, date_modified', 'safe'),
            array('mail', 'email'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('title,description,year_start,year_end,meter_start,meter_end,price_start,price_end,id, region_id, category_id, phone, mail, web, type, room, year, meter, price,currency, rating, period, views, likes, status, edited_username, create_username, date_added, date_modified', 'safe'),
            array('title,description,year_start,year_end,meter_start,meter_end,price_start,price_end,id, region_id, category_id, phone, mail, web, type, room, year, meter, price, currency, rating, period, views, likes, status, edited_username, create_username, date_added, date_modified', 'safe', 'on' => 'search'),
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
            'descriptions' => array(self::HAS_MANY, 'EstatesDescription', 'estates_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'region' => array(self::BELONGS_TO, 'Regions', 'region_id'),
            'documents' => array(self::MANY_MANY, 'Documents', 'tbl_estates_to_documents(estates_id,documents_id)'),
            'comment_count' => array(self::STAT, 'Comments', 'tbl_estates_to_comments(estates_id,comment_id)'),
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
            'phone' => Yii::t('app', 'phone'),
            'mail' => Yii::t('app', 'mail'),
            'web' => Yii::t('app', 'web'),
            'type' => Yii::t('app', 'type'),
            'room' => Yii::t('app', 'room'),
            'year' => Yii::t('app', 'year'),
            'meter' => Yii::t('app', 'meter'),
            'price' => Yii::t('app', 'price'),
            'currency' => Yii::t('app', 'currency'),
            'rating' => Yii::t('app', 'rating'),
            'period' => Yii::t('app', 'period'),
            'views' => Yii::t('app', 'views'),
            'likes' => Yii::t('app', 'likes'),
            'status' => Yii::t('app', 'status'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'create_username' => Yii::t('app', 'create_username'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
            'owner' => Yii::t('app', 'owner'),
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
        $criteria->compare('region_id', $this->region_id);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('mail', $this->mail, true);
        $criteria->compare('web', $this->web, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('room', $this->room, true);
        $criteria->compare('year', $this->year, true);
        $criteria->compare('meter', $this->meter, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('currency', $this->currency);
        $criteria->compare('rating', $this->rating, true);
        $criteria->compare('period', $this->period, true);
        $criteria->compare('views', $this->views, true);
        $criteria->compare('likes', $this->likes, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('edited_username', $this->edited_username, true);
        $criteria->compare('create_username', $this->create_username, true);
        $criteria->compare('date_added', $this->date_added, true);
        $criteria->compare('date_modified', $this->date_modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Estates the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function getCategoryMixedName()
    {
        if (isset ($this->category))
            return $this->category->getMixedDescriptionModel()->name;
    }


    public function getMixedCategoryModel()
    {
        return $this->category;
    }


    public function searchForCategory($limit = 50, $models = false)
    {
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;

//            $criteria=new CDbCriteria;


//            $criteria->compare('category_id', $category_id);
        $criteria->scopes = array('enabled', 'sort_newest');

        if (!empty($this->year_start) && !empty($this->year_end) && is_numeric($this->year_start) && is_numeric($this->year_end)) {
            $criteria->addCondition("t.year >= :year_start and t.year <= :year_end");
            $criteria->params = array_merge($criteria->params, array(':year_start' => (int)$this->year_start, ':year_end' => (int)$this->year_end));
        } elseif (!empty($this->year_start) && is_numeric($this->year_start)) {
            $criteria->addCondition("t.year >= :year_start");
            $criteria->params = array_merge($criteria->params, array(':year_start' => (int)$this->year_start));
        } elseif (!empty($this->year_end) && is_numeric($this->year_end)) {
            $criteria->addCondition("t.year <= :year_end");
            $criteria->params = array_merge($criteria->params, array(':year_end' => (int)$this->year_end));
        }


        if (!empty($this->price_start) && !empty($this->price_end) && is_numeric($this->price_start) && is_numeric($this->price_end)) {
            $criteria->addCondition("t.price >= :price_start and t.price <= :price_end");
            $criteria->params = array_merge($criteria->params, array(':price_start' => (int)$this->price_start, ':price_end' => (int)$this->price_end));
        } elseif (!empty($this->price_start)) {
            $criteria->addCondition("t.price >= :price_start");
            $criteria->params = array_merge($criteria->params, array(':price_start' => (int)$this->price_start));
        } elseif (!empty($this->price_end)) {
            $criteria->addCondition("t.price <= :price_end");
            $criteria->params = array_merge($criteria->params, array(':price_end' => (int)$this->price_end));
        }


        if (!empty($this->meter_start) && !empty($this->meter_end) && is_numeric($this->meter_start) && is_numeric($this->meter_end)) {
            $criteria->addCondition("t.meter >= :meter_start and t.meter <= :meter_end");
            $criteria->params = array_merge($criteria->params, array(':meter_start' => (int)$this->meter_start, ':meter_end' => (int)$this->meter_end));
        } elseif (!empty($this->meter_start)) {
            $criteria->addCondition("t.meter >= :meter_start");
            $criteria->params = array_merge($criteria->params, array(':meter_start' => (int)$this->meter_start));
        } elseif (!empty($this->meter_end)) {
            $criteria->addCondition("t.meter <= :meter_end");
            $criteria->params = array_merge($criteria->params, array(':meter_end' => (int)$this->meter_end));
        }


        if ($this->except) {
            $criteria->addNotInCondition('t.id', $this->except);
        }

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


    public function getTitle()
    {
        if ($this->title === null || strlen(trim($this->title)) == 0) {
            $this->title = $this->getFulltitle();
        }

        return $this->title;
    }


    public function getFulltitle()
    {
        if ($this->fulltitle === null || strlen(trim($this->fulltitle)) == 0) {
            if (isset($this->type))
                $this->fulltitle .= ' <b>' . $this->getTypeText() . '</b> ';

            if (isset($this->meter)) {
                if (is_numeric($this->meter)) {
                    $this->fulltitle .= ' <b>' . number_format($this->meter, 2) . '</b> ' . Yii::t('app', 'meter_short');
                }
            }

            if (isset($this->room)) {
                if (is_numeric($this->room) && $this->room > 0) {
                    $this->fulltitle .= ' <b>' . $this->room . '</b> ' . Yii::t('app', 'room_short');
                }
            }

            if (isset($this->price)) {
                if (!isset($this->currency) || strlen(trim($this->currency)) == 0) {
                    $this->currency = ItemForm::CURRENCY_MANAT;
                }
                $currency_options = ItemForm::getCurrencyOptions();
                $this->fulltitle .= ' <b>' . number_format($this->price, 2) . '</b> ' . $currency_options[$this->currency];
            }
        }

        return $this->fulltitle;
    }


}
