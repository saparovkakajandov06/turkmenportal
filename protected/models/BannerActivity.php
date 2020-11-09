<?php

/**
 * This is the model class for table "tbl_banner_activity".
 *
 * The followings are the available columns in table 'tbl_banner_activity':
 * @property integer $id
 * @property integer $banner_id
 * @property integer $activity_type
 * @property string $date_added
 * @property string $date_modified
 */
class BannerActivity extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_banner_activity';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('banner_id, activity_type', 'required'),
            array('banner_id, activity_type', 'numerical', 'integerOnly' => true),
            array('date_added, date_modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, banner_id, activity_type, date_added, date_modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'banner_id' => 'Banner',
            'activity_type' => 'Activity Type',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('banner_id', $this->banner_id);
        $criteria->compare('activity_type', $this->activity_type);
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
     * @return BannerActivity the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    protected function beforeValidate() {
        if ($this->isNewRecord) {
            if ($this->hasAttribute('date_added') && $this->hasAttribute('date_modified')) {
                $tempArr = explode('-', $this->date_added);
                if (strlen(trim($this->date_added)) > 0 && $tempArr[0] > 0) {
                    $this->date_added = $this->date_modified = date('Y-m-d H:i:s', strtotime($this->date_added));
                } else {
                    $this->date_added = $this->date_modified = date('Y-m-d H:i:s');
                }
            }
        } else {
            $this->date_modified = new CDbExpression('NOW()');
        }

        return parent::beforeValidate();
    }


    const ACTIVITY_TYPE_VIEW = 1, ACTIVITY_TYPE_CLICK = 2;

    public function getActivityTypeOptions() {
        return array(
            self::ACTIVITY_TYPE_VIEW => Yii::t('app', 'ACTIVITY_TYPE_VIEW'),
            self::ACTIVITY_TYPE_CLICK => Yii::t('app', 'ACTIVITY_TYPE_CLICK'),
        );
    }

    public function getActivityTypeText() {
        $typeOptions = $this->getActivityTypeOptions();
        return isset($typeOptions[$this->activity_type]) ? $typeOptions[$this->activity_type] : '';
    }

}
