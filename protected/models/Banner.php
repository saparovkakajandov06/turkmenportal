<?php

/**
 * This is the model class for table "tbl_banner".
 *
 * The followings are the available columns in table 'tbl_banner':
 * @property integer $id
 * @property integer $format_type
 * @property string $description
 * @property string $adsense_code
 * @property integer $width
 * @property integer $height
 * @property integer $type
 * @property integer $url
 * @property integer $view_count
 * @property integer $click_count
 * @property integer $related_user_id
 * @property integer $status
 */
class Banner extends ActiveRecord
{
    public $image;
    public $exceptions = array();
    public $dimensions = '';
    public $bannerType = '';
    public $thumb = '';
    const FORMAT_TYPE_DESKTOP = 0, FORMAT_TYPE_MOBILE = 1;

    public function getFormatTypeOptions()
    {
        return array(
            self::FORMAT_TYPE_DESKTOP => Yii::t('app', 'FORMAT_TYPE_DESKTOP'),
            self::FORMAT_TYPE_MOBILE => Yii::t('app', 'FORMAT_TYPE_MOBILE'),
        );
    }

    public function getFormatTypeText()
    {
        $formatTypeOptions = $this->formatTypeOptions;
        return isset($formatTypeOptions[$this->format_type]) ? $formatTypeOptions[$this->format_type] : Yii::t('app', '$FORMAT_TYPE_UNKNOWN');
    }


    const STATUS_DISABLED = 0, STATUS_ENABLED = 1, STATUS_EXPIRED = 2;

    public function getStatusOptions()
    {
        return array(
            self::STATUS_DISABLED => Yii::t('app', 'STATUS_DISABLED'),
            self::STATUS_ENABLED => Yii::t('app', 'STATUS_ENABLED'),
            self::STATUS_EXPIRED => Yii::t('app', 'STATUS_EXPIRED'),
        );
    }


    public function getStatusText()
    {
        $statusOptions = $this->statusOptions;
        return isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : Yii::t('app', 'STATUS_UNKNOWN');
    }


    function behaviors()
    {
        return array_merge(parent::behaviors(), array(
            'xupload' => array(
                'class' => 'ext.xupload.components.XUploadBehavior',
                'state_name' => 'state_banner',
                'related_table_name' => 'tbl_banner_to_documents',
            ),
        ));
    }


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_banner';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type', 'required'),
            array('format_type, width, height, type', 'numerical', 'integerOnly' => true),
            array('description', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, format_type, description, adsense_code, width, height, type,url,related_user_id,date_expire,status', 'safe'),
            array('id, format_type, description, adsense_code, width, height, type,url,related_user_id,date_expire,status', 'safe', 'on' => 'search'),
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
            'documents' => array(self::MANY_MANY, 'Documents', 'tbl_banner_to_documents(banner_id,documents_id)'),
            'banner_type' => array(self::BELONGS_TO, 'BannerType', 'type'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'id'),
            'format_type' => Yii::t('app', 'Banner format'),
            'description' => Yii::t('app', 'Banner description'),
            'adsense_code' => Yii::t('app', 'adsense_code'),
            'width' => Yii::t('app', 'width'),
            'height' => Yii::t('app', 'height'),
            'related_user_id' => Yii::t('app', 'related_user_id'),
            'type' => Yii::t('app', 'type'),
            'url' => Yii::t('app', 'url'),
            'dimensions' => Yii::t('app', 'dimensions'),
            'bannerType' => Yii::t('app', 'bannerType'),
            'thumb' => Yii::t('app', 'Thumb'),
            'view_count' => Yii::t('app', 'View count'),
            'click_count' => Yii::t('app', 'Click count'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'create_username' => Yii::t('app', 'create_username'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
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
        if (isset($_GET['Banner']['status'])){
            $status = $_GET['Banner']['status'];

            if (strlen($status) > 0 && $status < 3){
                $status = (int)$status;
            } else {
                $status = null;
            }
            $this->status = $status;
        } else {
            $this->status = 1;
        }

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('format_type', $this->format_type);
        $criteria->compare('description', $_GET['Banner']['description'], true);
        $criteria->compare('adsense_code', $this->adsense_code, true);
        $criteria->compare('width', $this->width);
        $criteria->compare('height', $this->height);
        $criteria->compare('type', $this->type);
        $criteria->compare('related_user_id', $this->related_user_id);
        $criteria->compare('url', $_GET['Banner']['url']);
        $criteria->compare('image', '');
        $criteria->compare('status',$this->status);

        if (count($this->exceptions) > 0)
            $criteria->addNotInCondition('id', $this->exceptions);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 50),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Banner the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function getThumbPath($width = null, $height = null, $type = '', $is_cropped = false, $with_watermark = true, $with_no_image = true)
    {
        $bannerType = $this->banner_type;
        if (isset($bannerType) && $bannerType->type != BannerType::TYPE_FLASH)
            return parent::getThumbPath($width, $height, $type, $is_cropped, $with_watermark, $with_no_image);
    }


    public function getDimensionsText()
    {
        $bannerType = $this->banner_type;
        if (isset($bannerType)) {
            return $bannerType->width . 'x' . $bannerType->height;
        }
        return "";
    }


    public function getBannerTypeText()
    {
        $bannerType = $this->banner_type;
        if (isset($bannerType)) {
            return $bannerType->type_name . ' (' . $bannerType->getTypeText() . ")";
        }
        return "";
    }
}
