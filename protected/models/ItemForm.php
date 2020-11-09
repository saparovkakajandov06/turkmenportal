<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ItemForm extends CFormModel {
    public $id;
    public $username;
    public $owner;
    public $email;
    public $phone;
    public $region_id;
    public $category_id;
    public $currency;
    public $date_end;

    public $title;
    public $description;
    public $price;
    public $photos;

    public $documents = array();
    public $docs = array();

    const CURRENCY_MANAT = 1, CURRENCY_DOLLAR = 2;
    public static function getCurrencyOptions() {
        return array(
            self::CURRENCY_MANAT => Yii::t('app', 'CURRENCY_MANAT'),
//            self::CURRENCY_DOLLAR => Yii::t('app', 'CURRENCY_DOLLAR'),
        );
    }

    public function getCurrencyText() {
        $typeOptions = $this->getCurrencyOptions();
        return isset($typeOptions[$this->currency]) ? $typeOptions[$this->currency] : Yii::t('app', '$CURRENCY_UNKNOWN');
    }



    const END_DATE_7 = 7, END_DATE_14= 14, END_DATE_30= 30, END_DATE_60= 60, END_DATE_90= 90, END_DATE_180= 180;
    public static function getDateEndOptions() {
        return array(
            self::END_DATE_7 => Yii::t('app', 'END_DATE_7'),
            self::END_DATE_14 => Yii::t('app', 'END_DATE_14'),
            self::END_DATE_30 => Yii::t('app', 'END_DATE_30'),
            self::END_DATE_60 => Yii::t('app', 'END_DATE_60'),
            self::END_DATE_90 => Yii::t('app', 'END_DATE_90'),
            self::END_DATE_180 => Yii::t('app', 'END_DATE_180'),
        );
    }


    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('title', 'required'),
            array('phone',  'numerical', 'integerOnly'=>true),
//            array('phone', 'validatePhone'),
            array('id,category_id,region_id, username,email,phone,title,description,price,currency,date_end,owner', 'safe'),
            array('email', 'email'),
        );
    }


    public function validatePhone($attribute,$params){
        if (strlen($this->phone)>0 && !$this->hasErrors($attribute)) {
            Yii::setPathOfAlias('libphonenumber',Yii::getPathOfAlias('application.vendors.libphonenumber'));
            $phonenumber=new \libphonenumber\LibPhone($this->phone);
            if(!$phonenumber->validate()){
                $this->addError($attribute, Yii::t('app','phonenumber_validation'));
            }
        }
    }


    function behaviors() {
        return array_merge(parent::behaviors(), array(
                'xupload' => array(
                    'class' => 'ext.xupload.components.XUploadBehavior',
                    'state_name' => 'state_item',
//                'related_table_name' => 'tbl_blog_to_documents',
                )
            )
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'title' => Yii::t("app", "item_title"),
            'description' => Yii::t("app", "item_description"),
            'category_id' => Yii::t("app", "item_category_id"),
            'region_id' => Yii::t("app", "item_region_id"),
            'email' => Yii::t("app", "item_email"),
            'phone' => Yii::t("app", "item_phone"),
            'username' => Yii::t("app", "item_username"),
            'owner' => Yii::t("app", "owner"),
            'date_end' => Yii::t("app", "item_date_end"),
        );
    }



    public function getDateEnd(){
        if(isset($this->date_end) && strlen(trim($this->date_end)) && is_numeric($this->date_end)){
            $dateTime= new DateTime();
            $dateTime->add(new DateInterval('P'.$this->date_end.'D'));
            return $dateTime->format('Y-m-d H:i:s');
        }
        return null;
    }

    public static function convertDateEnd($dateEnd){
        if(isset($dateEnd) && strlen(trim($dateEnd)) && is_numeric($dateEnd)){
            $dateTime= new DateTime();
            $dateTime->add(new DateInterval('P'.$dateEnd.'D'));
            return $dateTime->format('Y-m-d H:i:s');
        }
        return null;
    }


    public function setDateEnd($date){
        $dateEnd= new DateTime($date);
        $today=new DateTime();
        if($dateEnd>$today){
            $diff=$dateEnd->diff($today);
            $date_options=self::getDateEndOptions();
            foreach ($date_options as $key=>$option){
                if($key>$diff->days){
                    $this->date_end=$key;
                    break;
                }
            }
        }
    }

}
