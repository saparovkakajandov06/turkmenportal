<?php

/**
 * This is the model class for table "tbl_banner_type".
 *
 * The followings are the available columns in table 'tbl_banner_type':
 * @property integer $id
 * @property string $type_name
 * @property string $description
 * @property integer $width
 * @property integer $height
 * @property integer $type
 * @property integer $is_mobile_enabled
 * @property integer $status
 */
class BannerType extends CActiveRecord
{

    public $bannersTitle;
    public $size;
    const TYPE_IMAGE = 0, TYPE_FLASH = 1, TYPE_IMAGE_RANDOM = 2, TYPE_IMAGE_SLIDER = 3, TYPE_ADSENSE = 4;
    const BANNER_TYPE_DESKTOP_ONLY = 0, BANNER_TYPE_ALL = 1, BANNER_TYPE_MOBILE_ONLY = 2;

    public static function getTypeOptions()
    {
        return array(
            self::TYPE_IMAGE => Yii::t('app', 'TYPE_IMAGE_STATIC'),
            self::TYPE_ADSENSE => Yii::t('app', 'TYPE_ADSENSE'),
            self::TYPE_IMAGE_RANDOM => Yii::t('app', 'TYPE_IMAGE_RANDOM'),
            self::TYPE_FLASH => Yii::t('app', 'TYPE_FLASH'),
            self::TYPE_IMAGE_SLIDER => Yii::t('app', 'TYPE_IMAGE_SLIDER'),
        );
    }


    public function getTypeText()
    {
        $typeOptions = $this->typeOptions;
        return isset($typeOptions[$this->type]) ? $typeOptions[$this->type] : Yii::t('app', '$TYPE_UNKNOWN');
    }

    public static function getBannerTypeOptions()
    {
        return array(
            self::BANNER_TYPE_DESKTOP_ONLY => Yii::t('app', 'BANNER_TYPE_DESKTOP_ONLY'),
            self::BANNER_TYPE_MOBILE_ONLY => Yii::t('app', 'BANNER_TYPE_MOBILE_ONLY'),
            self::BANNER_TYPE_ALL => Yii::t('app', 'BANNER_TYPE_ALL'),
        );
    }

    public function getBannerTypeText()
    {
        $typeOptions = $this->getBannerTypeOptions();
        return isset($typeOptions[$this->is_mobile_enabled]) ? $typeOptions[$this->is_mobile_enabled] : Yii::t('app', '$TYPE_UNKNOWN');
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_banner_type';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type_name,description', 'required'),
            array('width, height', 'numerical', 'integerOnly' => true),
            array('type_name,description', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type_name,description, width, height,type,is_mobile_enabled,status', 'safe'),
            array('id, type_name,description, width, height,type,is_mobile_enabled,status', 'safe', 'on' => 'search'),
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
            'banners' => array(self::HAS_MANY, 'Banner', 'type'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => Yii::t('app', 'type'),
            'is_mobile_enabled' => Yii::t('app', 'is_mobile_enabled'),
            'type_name' => Yii::t('app', 'code'),
            'description' => Yii::t('app', 'item_description'),
            'width' => 'Width',
            'height' => 'Height',
            'size' => 'Size',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('type_name', $this->type_name, true);
        $criteria->compare('width', $this->width);
        $criteria->compare('height', $this->height);
        $criteria->compare('type', $this->type);
        $criteria->compare('is_mobile_enabled', $this->is_mobile_enabled);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BannerType the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function getBannersTitle()
    {
        $banners = $this->banners;
        $this->bannersTitle = "";
        if (isset($banners)) {
            foreach ($banners as $banner) {
                $this->bannersTitle .= " " . $banner->description . ', ';
            }
        }
        return trim($this->bannersTitle, ",");
    }


    public function getSize()
    {
        if (isset($this->width) && isset($this->height))
            return $this->width . " x " . $this->height;
        return "";
    }


    public function getEnabledBanners()
    {
        return Banner::model()->findAllByAttributes(array('type' => $this->id, 'status' => Banner::STATUS_ENABLED));
    }
}
