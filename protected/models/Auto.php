<?php

/**
 * This is the model class for table "tbl_auto".
 *
 * The followings are the available columns in table 'tbl_auto':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $region_id
 * @property string $category_id
 * @property string $phone
 * @property string $mail
 * @property string $web
 * @property string $model_id
 * @property string $year
 * @property string $trip
 * @property integer $odometer_unit
 * @property string $price
 * @property string $engine_capacity
 * @property integer $transmission
 * @property integer $bodytype
 * @property integer $auto_condition
 * @property integer $color
 * @property integer $drivetrain
 * @property string $other_options
 * @property string $rating
 * @property string $period
 * @property string $views
 * @property string $likes
 * @property string $dislikes
 * @property string $date_end
 * @property string $date_added
 * @property string $date_modified
 * @property string $create_username
 * @property string $edited_username
 * @property integer $status
 * @property integer $owner
 * @property string $lineid
 * @property integer $tmcars_id
 * @property integer $tmcars_date
 * @property integer $isCredit
 */
class Auto extends ActiveRecord
{

    public $fulltitle;
    public $make_id;
    public $catalog_category_id;
    public $year_start;
    public $year_end;
    public $price_start;
    public $price_end;
    public $trip_start;
    public $trip_end;
    public $engine_capacity_start;
    public $engine_capacity_end;
    public $except;
    public $title_calc = true;

    private $_url;
    private $_urlupdate;
    private $_model;


    public function getUrl()
    {
        if ($this->_url === null)
            $this->_url = Yii::app()->createAbsoluteUrl('auto/view', array('id' => $this->id));
        return $this->_url;
    }


    public function getUrlupdate()
    {
        if ($this->_urlupdate === null)
            $this->_urlupdate = Yii::app()->createUrl('item/index', array('code' => 'auto', 'id' => $this->id));
        return $this->_urlupdate;
    }


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_auto';
    }


    public function behaviors()
    {
        return array_merge(parent::behaviors(), array(
                'xupload' => array(
                    'class' => 'ext.xupload.components.XUploadBehavior',
                    'state_name' => 'state_auto',
                    'related_table_name' => 'tbl_auto_to_documents',
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
            'enabled' => array(
                'condition' => 't.status=1',
            ),

            'sort_newest' => array(
                'order' => 't.date_added desc',
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
            array('make_id,model_id,views, likes,category_id', 'required'),
            array('mail', 'email'),
            array('status,price_start,price_end', 'numerical', 'integerOnly' => true),
            array('region_id, category_id, model_id', 'length', 'max' => 20),
            array('owner, phone, mail, web, trip, price, rating, create_username, edited_username', 'length', 'max' => 255),
            array('year, views, likes', 'length', 'max' => 10),
            array('period, date_added,make_id, model_id,date_modified,description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('currency, odometer_unit,engine_capacity, transmission, bodytype, auto_condition, color, drivetrain, other_options,year_start,year_end,price_start,price_end,trip_start,engine_capacity_start, engine_capacity_end, trip_end, id, region_id,make_id, category_id, phone, mail, web, model_id, year, trip, price, rating, period, views, likes, dislikes, date_end, date_added, date_modified, create_username, edited_username, status,description', 'safe'),
            array('currency, odometer_unit,engine_capacity, transmission, bodytype, auto_condition, color, drivetrain, other_options,year_start,year_end,price_start,price_end,trip_start,engine_capacity_start, engine_capacity_end, trip_end, id, region_id,make_id, category_id, phone, mail, web, model_id, year, trip, price, rating, period, views, likes, dislikes, date_end, date_added, date_modified, create_username, edited_username, status,description', 'safe', 'on' => 'search'),
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
//                    'descriptions' => array(self::HAS_MANY, 'AutoDescription', 'autos_id'),
//                    'category'=>array(self::BELONGS_TO,'Category', 'category_id'),
            'category' => array(self::BELONGS_TO, 'AutoCategory', 'category_id'),
            'automodel' => array(self::BELONGS_TO, 'AutoModels', 'model_id'),
            'region' => array(self::BELONGS_TO, 'Regions', 'region_id'),
            'documents' => array(self::MANY_MANY, 'Documents', 'tbl_auto_to_documents(auto_id,documents_id)'),
            'comment_count' => array(self::STAT, 'Comments', 'tbl_auto_to_comments(auto_id,comment_id)'),
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
            'model_id' => Yii::t('app', 'model_id'),
            'year' => Yii::t('app', 'year'),
            'trip' => Yii::t('app', 'trip'),
            'price' => Yii::t('app', 'price'),
            'rating' => Yii::t('app', 'rating'),
            'period' => Yii::t('app', 'period'),
            'views' => Yii::t('app', 'views'),
            'likes' => Yii::t('app', 'likes'),
            'dislikes' => Yii::t('app', 'dislikes'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
            'create_username' => Yii::t('app', 'create_username'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'status' => Yii::t('app', 'status'),
            'make_id' => Yii::t('app', 'make_id'),
            'engine_capacity' => Yii::t('app', 'engine_capacity'),
            'transmission' => Yii::t('app', 'transmission'),
            'bodytype' => Yii::t('app', 'bodytype'),
            'color' => Yii::t('app', 'color'),
            'drivetrain' => Yii::t('app', 'drivetrain'),
            'auto_condition' => Yii::t('app', 'condition'),
            'other_options' => Yii::t('app', 'other_options'),
            'owner' => Yii::t('app', 'owner'),
            'isCredit' => Yii::t('app', 'isCredit'),
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('region_id', $this->region_id);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('mail', $this->mail, true);
        $criteria->compare('web', $this->web, true);
        $criteria->compare('model_id', $this->model_id, true);
//                $criteria->compare('year',$this->year,true);
//                $criteria->compare('trip',$this->trip,true);
        $criteria->compare('odometer_unit', $this->odometer_unit);
//                $criteria->compare('price',$this->price,true);
        $criteria->compare('currency', $this->currency);
//                $criteria->compare('engine_capacity',$this->engine_capacity,true);
        $criteria->compare('transmission', $this->transmission);
        $criteria->compare('bodytype', $this->bodytype);
        $criteria->compare('auto_condition', $this->auto_condition);
        $criteria->compare('color', $this->color);
        $criteria->compare('drivetrain', $this->drivetrain);
        $criteria->compare('other_options', $this->other_options, true);
        $criteria->compare('rating', $this->rating, true);
        $criteria->compare('period', $this->period, true);
        $criteria->compare('views', $this->views, true);
        $criteria->compare('likes', $this->likes, true);
        $criteria->compare('dislikes', $this->dislikes);
        $criteria->compare('date_added', $this->date_added, true);
        $criteria->compare('date_modified', $this->date_modified, true);
        $criteria->compare('create_username', $this->create_username, true);
        $criteria->compare('edited_username', $this->edited_username, true);
        $criteria->compare('status', $this->status);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    public function searchByLanguage()
    {
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;

//            $criteria->with=array("descriptions","descriptions.language");
        $criteria->together = true;
//            $criteria->compare('language.code', Yii::app()->language);
//            $criteria->compare('descriptions.description', $this->description,true);
//            $criteria->order="t.id desc";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
        ));
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Auto the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function searchForNesipetsin($limit = 5, $fromId = null)
    {
        $criteria = new CDbCriteria();

//        $criteria->scopes = array('enabled', 'sort_newest');
        $criteria->limit = $limit;
        $criteria->offset = 0;
        $criteria->select = array('id', 'phone', 'date_added');
        $criteria->order = 't.id asc';

        if (isset($fromId) && strlen(trim($fromId)) > 0) {
            $criteria->addCondition('id>' . $fromId);
        }

        $dp = new CActiveDataProvider($this,
            array(
                'criteria' => $criteria,
                'pagination' => ($limit > 0) ? false : array(
                    'pageSize' => Yii::app()->params['pageSize'],
                    'pageVar' => 'page',
                )
            ));


        return $dp;
    }


    public function searchForIndex($limit = 5)
    {
        $criteria = new CDbCriteria();

        $criteria->scopes = array('enabled', 'sort_newest');
        $criteria->limit = $limit;
        $criteria->offset = 0;

        $dp = new CActiveDataProvider($this,
            array(
                'criteria' => $criteria,
                'pagination' => ($limit > 0) ? false : array(
                    'pageSize' => Yii::app()->params['pageSize'],
                    'pageVar' => 'page',
                )
            ));


        return $dp;
    }


    public function searchForCategory($category_id = null, $limit = 50, $models = false)
    {
        $criteria = new CDbCriteria;
        if (isset($this->category_id) && strlen(trim($this->category_id)) > 0) {
            $criteria->compare('category_id', $this->category_id);
        }

        if (isset($this->make_id) && strlen(trim($this->make_id)) > 0) {
            $criteria->with = array("automodel");
            $criteria->compare('automodel.make_id', $this->make_id);
        }

        if (isset($this->model_id) && strlen(trim($this->model_id)) > 0) {
            $criteria->compare('model_id', $this->model_id);
        }

        if (isset($this->region_id) && strlen(trim($this->region_id)) > 0) {
            $criteria->compare('region_id', $this->region_id);
        }

        $criteria->compare('auto_condition', $this->auto_condition);
        $criteria->compare('drivetrain', $this->drivetrain);
        $criteria->compare('transmission', $this->transmission);
        $criteria->compare('bodytype', $this->bodytype);
        $criteria->compare('color', $this->color);
        $criteria->compare('category_id', $category_id);
        $criteria->scopes = array('enabled', 'sort_newest');

        if (!empty($this->year_start) && !empty($this->year_end) && is_numeric($this->year_start) && is_numeric($this->year_end)) {
            $criteria->addCondition("t.year >= '" . (int)$this->year_start . "' and t.year <= '" . (int)$this->year_end . "' ");
        } elseif (!empty($this->year_start) && is_numeric($this->year_start)) {
            $criteria->addCondition("t.year >= '" . (int)$this->year_start . "'");
        } elseif (!empty($this->year_end) && is_numeric($this->year_end)) {
            $criteria->addCondition("t.year <= '" . (int)$this->year_end . "'");
        }

        if (!empty($this->price_start) && !empty($this->price_end) && is_numeric($this->price_start) && is_numeric($this->price_end)) {
            $criteria->addCondition("t.price >= '" . (float)$this->price_start . "' and t.price <= '" . (float)$this->price_end . "' ");
        } elseif (!empty($this->price_start) && is_numeric($this->price_start)) {
            $criteria->addCondition("t.price >= '" . (float)$this->price_start . "'");
        } elseif (!empty($this->price_end) && is_numeric($this->price_end)) {
            $criteria->addCondition("t.price <= '" . (float)$this->price_end . "'");
        }


        if (!empty($this->trip_start) && !empty($this->trip_end) && is_numeric($this->trip_start) && is_numeric($this->trip_end)) {
            $criteria->addCondition("t.trip >= '" . (float)$this->trip_start . "' and t.trip <= '" . (float)$this->trip_end . "' ");
        } elseif (!empty($this->trip_start) && is_numeric($this->trip_start)) {
            $criteria->addCondition("t.trip >= '" . (float)$this->trip_start . "'");
        } elseif (!empty($this->trip_end) && is_numeric($this->trip_end)) {
            $criteria->addCondition("t.trip <= '" . (float)$this->trip_end . "'");
        }

        if (!empty($this->engine_capacity_start) && !empty($this->engine_capacity_end) && is_numeric($this->engine_capacity_start) && is_numeric($this->engine_capacity_end)) {
            $criteria->addCondition("t.engine_capacity >= '" . (float)$this->engine_capacity_start . "' and t.engine_capacity <= '" . (float)$this->engine_capacity_end . "' ");
        } elseif (!empty($this->engine_capacity_start) && is_numeric($this->engine_capacity_start)) {
            $criteria->addCondition("t.engine_capacity >= '" . (float)$this->engine_capacity_start . "'");
        } elseif (!empty($this->engine_capacity_end) && is_numeric($this->engine_capacity_end)) {
            $criteria->addCondition("t.engine_capacity <= '" . (float)$this->engine_capacity_end . "'");
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
                    )
                ));
            return $dp;
        } else {
            return $this->findAll($criteria);
        }
    }


    public function getMixedCategoryModel()
    {
        return $this->category;
    }

    public function getCategoryName()
    {
        $category = $this->category;
        if (isset($category))
            return $category->name;
    }


    public function getMixedAutoModelModel()
    {
        return $this->automodel;
    }


    ///ENUMERATORS

    const BODYTYPE_SEDAN = 1,
        BODYTYPE_UNIVERSAL = 2,
        BODYTYPE_HATCHBACK = 3,
        BODYTYPE_MINIVAN = 4,
        BODYTYPE_JEEP = 5,
        BODYTYPE_COMPARTMENT = 6,
        BODYTYPE_CABRIOLET = 7,
        BODYTYPE_MINIBUS = 8,
        BODYTYPE_VAN = 9,
        BODYTYPE_CROSSOVER = 10,
        BODYTYPE_OFF_ROADER = 11,
        BODYTYPE_TRUCK = 12,
        BODYTYPE_MOTORBIKE = 13,
        BODYTYPE_PICKUP = 14,
        BODYTYPE_BUS = 15;

    public static function getBodyTypeOptions()
    {
        return array(
            self::BODYTYPE_SEDAN => Yii::t('app', 'BODYTYPE_SEDAN'),
            self::BODYTYPE_UNIVERSAL => Yii::t('app', 'BODYTYPE_UNIVERSAL'),
            self::BODYTYPE_HATCHBACK => Yii::t('app', 'BODYTYPE_HATCHBACK'),
            self::BODYTYPE_MINIVAN => Yii::t('app', 'BODYTYPE_MINIVAN'),
            self::BODYTYPE_JEEP => Yii::t('app', 'BODYTYPE_JEEP'),
            self::BODYTYPE_COMPARTMENT => Yii::t('app', 'BODYTYPE_COMPARTMENT'),
            self::BODYTYPE_CABRIOLET => Yii::t('app', 'BODYTYPE_CABRIOLET'),
            self::BODYTYPE_MINIBUS => Yii::t('app', 'BODYTYPE_MINIBUS'),
            self::BODYTYPE_VAN => Yii::t('app', 'BODYTYPE_VAN'),
            self::BODYTYPE_CROSSOVER => Yii::t('app', 'BODYTYPE_CROSSOVER'),
            self::BODYTYPE_OFF_ROADER => Yii::t('app', 'BODYTYPE_OFF_ROADER'),
            self::BODYTYPE_TRUCK => Yii::t('app', 'BODYTYPE_TRUCK'),
            self::BODYTYPE_MOTORBIKE => Yii::t('app', 'BODYTYPE_MOTORBIKE'),
            self::BODYTYPE_PICKUP => Yii::t('app', 'BODYTYPE_PICKUP'),
            self::BODYTYPE_BUS => Yii::t('app', 'BODYTYPE_BUS'),
        );
    }

    public function getBodyTypeText()
    {
        $typeOptions = $this->getBodyTypeOptions();
        if (isset($this->bodytype))
            return isset($typeOptions[$this->bodytype]) ? $typeOptions[$this->bodytype] : '';
        return '';
    }


    const AUTO_CONDITION_OLD = 1, AUTO_CONDITION_NEW = 2, AUTO_CONDITION_CRASHED = 3;

    public function getAutoConditionOptions()
    {
        return array(
            self::AUTO_CONDITION_OLD => Yii::t('app', 'CONDITION_OLD'),
            self::AUTO_CONDITION_NEW => Yii::t('app', 'CONDITION_NEW'),
            self::AUTO_CONDITION_CRASHED => Yii::t('app', 'CONDITION_CRASHED'),
        );
    }

    public function getAutoConditionText()
    {
        $typeOptions = $this->getAutoConditionOptions();
        return isset($typeOptions[$this->auto_condition]) ? $typeOptions[$this->auto_condition] : '';
    }


    const ODOMETER_KM = 1, ODOMETER_MILE = 2;

    public function getOdometerUnitOptions()
    {
        return array(
            self::ODOMETER_KM => Yii::t('app', 'ODOMETER_KM'),
            self::ODOMETER_MILE => Yii::t('app', 'ODOMETER_MILE'),
        );
    }

    public function getOdometerUnitText()
    {
        $typeOptions = $this->getOdometerUnitOptions();
        return isset($typeOptions[$this->odometer_unit]) ? $typeOptions[$this->odometer_unit] : '';
    }


    const COLOR_WHITE = 1, COLOR_YELLOW = 2, COLOR_GREEN = 3, COLOR_BROWN = 4, COLOR_RED = 5, COLOR_ORANGE = 6, COLOR_SILVER = 7, COLOR_GREY = 8, COLOR_BLUE = 9, COLOR_VIOLET = 10, COLOR_BLACK = 11, COLOR_OTHER = 12, COLOR_WET_ASPHALT = 13, COLOR_METALLIC = 14;

    public static function getColorOptions()
    {
        return array(
            self::COLOR_WHITE => Yii::t('app', 'COLOR_WHITE'),
            self::COLOR_YELLOW => Yii::t('app', 'COLOR_YELLOW'),
            self::COLOR_GREEN => Yii::t('app', 'COLOR_GREEN'),
            self::COLOR_BROWN => Yii::t('app', 'COLOR_BROWN'),
            self::COLOR_RED => Yii::t('app', 'COLOR_RED'),
            self::COLOR_ORANGE => Yii::t('app', 'COLOR_ORANGE'),
            self::COLOR_SILVER => Yii::t('app', 'COLOR_SILVER'),
            self::COLOR_GREY => Yii::t('app', 'COLOR_GREY'),
            self::COLOR_BLUE => Yii::t('app', 'COLOR_BLUE'),
            self::COLOR_VIOLET => Yii::t('app', 'COLOR_VIOLET'),
            self::COLOR_BLACK => Yii::t('app', 'COLOR_BLACK'),
            self::COLOR_WET_ASPHALT => Yii::t('app', 'COLOR_WET_ASPHALT'),
            self::COLOR_METALLIC => Yii::t('app', 'COLOR_METALLIC'),
            self::COLOR_OTHER => Yii::t('app', 'COLOR_OTHER'),
        );
    }

    public function getColorText()
    {
        $typeOptions = $this->getColorOptions();
        return isset($typeOptions[$this->color]) ? $typeOptions[$this->color] : '';
    }


    const TRANSMISSION_MECHANIC = 1, TRANSMISSION_MANUAL = 1, TRANSMISSION_AUTOMATIC = 2, TRANSMISSION_ROBOT = 3, TRANSMISSION_VARY = 4, TRANSMISSION_TIPTRONIC = 5;

    public static function getTransmissionOptions()
    {
        return array(
            self::TRANSMISSION_MECHANIC => Yii::t('app', 'TRANSMISSION_MECHANIC'),
            self::TRANSMISSION_AUTOMATIC => Yii::t('app', 'TRANSMISSION_AUTOMATIC'),
            self::TRANSMISSION_TIPTRONIC => Yii::t('app', 'TRANSMISSION_TIPTRONIC'),
//                 self::TRANSMISSION_VARY => Yii::t('app','TRANSMISSION_VARY'),
        );
    }

    public function getTransmissionText()
    {
        $transmissionTypeOptions = $this->getTransmissionOptions();
        return isset($transmissionTypeOptions[$this->transmission]) ? $transmissionTypeOptions[$this->transmission] : '';
    }


    const DRIVETRAIN_FRONT = 1, DRIVETRAIN_BACK = 2, DRIVETRAIN_FULL = 3;

    public function getDrivetrainOptions()
    {
        return array(
            self::DRIVETRAIN_FRONT => Yii::t('app', 'DRIVETRAIN_FRONT'),
            self::DRIVETRAIN_BACK => Yii::t('app', 'DRIVETRAIN_BACK'),
            self::DRIVETRAIN_FULL => Yii::t('app', 'DRIVETRAIN_FULL'),
        );
    }

    public function getDrivetrainText()
    {
        $transmissionTypeOptions = $this->getDrivetrainOptions();
        return isset($transmissionTypeOptions[$this->drivetrain]) ? $transmissionTypeOptions[$this->drivetrain] : '';
    }


    const OPTION_CONDITIONER = 1, OPTION_LEATHER = 2, OPTION_LUKE = 3, OPTION_AUTOMATIC_PARKING = 4, OPTION_AIRBAG = 5;

    public function getOtherOptions()
    {
        return array(
            self::OPTION_CONDITIONER => Yii::t('app', 'OPTION_CONDITIONER'),
            self::OPTION_LEATHER => Yii::t('app', 'OPTION_LEATHER'),
            self::OPTION_LUKE => Yii::t('app', 'OPTION_LUKE'),
            self::OPTION_AUTOMATIC_PARKING => Yii::t('app', 'OPTION_AUTOMATIC_PARKING'),
            self::OPTION_AIRBAG => Yii::t('app', 'OPTION_AIRBAG'),
        );
    }

    public function getOtherOptionsText()
    {
        $transmissionTypeOptions = $this->getOtherOptions();
        return isset($transmissionTypeOptions[$this->other_options]) ? $transmissionTypeOptions[$this->other_options] : '';
    }


    public function getEngineCapacityOptions()
    {
        $capacity_list = array('1.0', '1.2', '1.4', '1.5', '1.6', '1.8', '1.9', '2.0', '2.2', '2.3', '2.4', '2.5', '2.8', '3.0', '3.2', '3.5', '4.0', '4.5', '5', '6');
        $formatted_capacity_list = array();
        foreach ($capacity_list as $value) {
            $formatted_capacity_list[$value] = $value . " " . Yii::t('app', 'litre');
        }
        return $formatted_capacity_list;

    }


    public function getModel()
    {

        if ($this->_model === null) {
            $automodel = $this->automodel;
            if (isset($automodel)) {
                $automake = $automodel->automake;
                if (isset($automake)) {
                    $this->_model = $automake->name . " " . $automodel->name;

                }
            }
        }
        return $this->_model;
    }


    public function getFulltitle()
    {
        if ($this->fulltitle === null || strlen(trim($this->fulltitle)) == 0) {

//                $this->fulltitle=  strip_tags($this->title);

            $this->fulltitle = '<b>' . $this->getModel() . '</b>';
            if (isset($this->year))
                $this->fulltitle .= ' <b>' . $this->year . '</b> ' . Yii::t('app', 'year');

            if (isset($this->trip) && strlen(trim($this->trip)) > 1)
                $this->fulltitle .= ' <b>' . number_format((float)$this->trip, 2) . '</b> ' . $this->getOdometerUnitText();

            if (isset($this->price) && strlen(trim($this->price)) > 1) {
                if (!isset($this->currency) || strlen(trim($this->currency)) == 0) {
                    $this->currency = ItemForm::CURRENCY_MANAT;
                }
                $currency_options = ItemForm::getCurrencyOptions();
                $this->fulltitle .= '<span itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                            <b> <span itemprop="price"> ' . number_format($this->price, 0) . '</span></b> 
                                </span> 
                            <link itemprop="availability" href="http://schema.org/InStock">
                                    <meta itemprop="priceCurrency" content="' . $currency_options[$this->currency] . '">
                                    ' . $currency_options[$this->currency];
            }
        }

        return $this->fulltitle;
    }


    public function getTitle()
    {
        if (($this->title_calc != false) && ($this->title === null || strlen(trim($this->title)) == 0)) {
            $this->title = $this->getModel();
            if (isset($this->year))
                $this->title .= ' ' . $this->year . ' ' . Yii::t('app', 'year');
        }

        return $this->title;
    }


    public function getDetails($label = false)
    {
        $content_text = "";
        if (isset($this->model_id) && strlen(trim($this->model_id)) > 0) {
            if ($label == true)
                $content_text .= Yii::t('app', 'make_id') . ': ' . $this->getModel() . ', ';
            else
                $content_text .= $this->getModel() . ', ';
        }

        if (isset($this->color) && strlen(trim($this->color)) > 0) {
            if ($label == true)
                $content_text .= Yii::t('app', 'color') . ": " . $this->getColorText() . ', ';
            else
                $content_text .= $this->getColorText() . ', ';
        }

        if (isset($this->bodytype) && strlen(trim($this->bodytype)) > 0) {
            if ($label == true)
                $content_text .= Yii::t('app', 'bodytype') . ": " . $this->getBodyTypeText() . ', ';
            else {
                $content_text .= $this->getBodyTypeText() . ', ';
            }
        }

        if (isset($this->odometer_unit) && strlen(trim($this->odometer_unit)) > 0) {
            $this->trip = (double)$this->trip;
            if (is_double($this->trip))
                $this->trip = number_format($this->trip, 2);
            if ($this->trip > 0) {
                if ($label == true)
                    $content_text .= Yii::t('app', 'trip') . ": <i>" . $this->trip . "</i> " . $this->getOdometerUnitText() . ', ';
                else
                    $content_text .= $this->trip . ' ' . $this->getOdometerUnitText() . ', ';
            }
        }

        if (isset($this->transmission) && strlen(trim($this->transmission)) > 0) {
            if ($label == true)
                $content_text .= Yii::t('app', 'transmission') . ": " . $this->getTransmissionText() . ', ';
            else
                $content_text .= $this->getTransmissionText() . ', ';
        }

        if (isset($this->engine_capacity) && strlen(trim($this->engine_capacity)) > 0) {
            if ($label == true)
                $content_text .= Yii::t('app', 'engine_capacity') . ": " . $this->engine_capacity . Yii::t('app', 'litre') . ', ';
            else
                $content_text .= $this->engine_capacity . Yii::t('app', 'litre') . ', ';
        }

        if (isset($this->drivetrain) && strlen(trim($this->drivetrain)) > 0) {
//                if($label==true)
            $content_text .= Yii::t('app', 'drivetrain') . ": " . $this->getDrivetrainText() . '. ';
//                else
//                    $content_text.=$this->getDrivetrainText().'. ';
        }

        $content_text = preg_replace("/(,\s,)/", '', $content_text);
        return $content_text;
    }


    public function deleteDocumentsOnly()
    {
        echo "</br> Delete documents only: ";

        $documents = $this->documents;
        if (isset($documents)) {
            foreach ($documents as $doc) {
                echo "</br> fullDelete for document id:" . $doc->id;
                $doc->fullDelete('tbl_auto_to_documents');
            }
        }
    }

    protected function beforeDelete()
    {
        echo "</br> Before delete: ";

        $documents = $this->documents;
        if (isset($documents)) {
            foreach ($documents as $doc) {
                echo "</br> fullDelete for document id:" . $doc->id;
                $doc->fullDelete('tbl_auto_to_documents');
            }
        }
        return parent::beforeDelete();
    }
}
