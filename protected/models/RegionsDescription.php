<?php

/**
 * This is the model class for table "tbl_regions_description".
 *
 * The followings are the available columns in table 'tbl_regions_description':
 * @property integer $id
 * @property integer $region_id
 * @property integer $language_id
 * @property string $region_name
 */
class RegionsDescription extends ActiveRecordWOD
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_regions_description';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('region_id, language_id, region_name', 'required'),
			array('region_id, language_id', 'numerical', 'integerOnly'=>true),
			array('region_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, region_id, language_id, region_name', 'safe', 'on'=>'search'),
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
                     'language' => array(self::BELONGS_TO, 'Language', 'language_id'),
                     'region' => array(self::BELONGS_TO, 'Regions', 'region_id'),
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
                    'language_id' => Yii::t('app', 'language_id'),
                    'region_name' => Yii::t('app', 'region_name'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('region_name',$this->region_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        
        

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegionsDescription the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
