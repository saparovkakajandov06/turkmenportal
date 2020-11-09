<?php

/**
 * This is the model class for table "tbl_auto_models".
 *
 * The followings are the available columns in table 'tbl_auto_models':
 * @property string $id
 * @property string $make_id
 * @property string $name
 */
class AutoModels extends ActiveRecordWOD
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_auto_models';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('make_id', 'length', 'max'=>20),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, make_id, name', 'safe', 'on'=>'search'),
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
                    'automake'=>array(self::BELONGS_TO,'AutoMakes', 'make_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                        'id' => Yii::t('app', 'id'),
                        'make_id' => Yii::t('app', 'make_id'),
                        'name' => Yii::t('app', 'name'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('make_id',$this->make_id,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AutoModels the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        
    public function getListByMakeId($make_id=null){
        if(!isset ($make_id) || strlen(trim($make_id))==0)
            return array();
        else{
            $data= AutoModels::model()->findAllByAttributes(array('make_id'=>$make_id));
            return $data=CHtml::listData($data,'id','name');
        }

    }
}
