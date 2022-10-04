<?php

/**
 * This is the model class for table "tbl_banner_type".
 *
 * The followings are the available columns in table 'tbl_banner_type':
 * @property integer $id
 * @property integer $banner_id
 * @property integer $view_count
 * @property integer $click_count
 * @property integer $status
 */
class BannerStatistics extends CActiveRecord
{
    /**
     * @var array|int|mixed|null
     */
//    private $view_count;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_banner_statistics';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('view_count, click_count, banner_id, status', 'numerical', 'integerOnly' => true),
            array ('date_created', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
            array ('date_updated', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
        );
    }

//    public function relations()
//    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
//        return array(
//            'banners' => array(self::HAS_MANY, 'Banner', 'type'),
//        );
//    }

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

}
