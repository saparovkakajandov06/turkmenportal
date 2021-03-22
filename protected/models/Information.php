<?php

/**
 * This is the model class for table "tbl_information".
 *
 * The followings are the available columns in table 'tbl_information':
 * @property integer $id
 * @property string $code
 * @property integer $bottom
 * @property integer $sort_order
 * @property integer $status
 */
class Information extends ActiveRecord
{
    
        public $title, $description;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_information';
	}
        
        
        public function scopes()
        {
            return array(
                'enabled'=>array(
                    'condition'=>'t.status=1',
                ),
               
                'sort_by_order'=>array(
                    'order'=>'t.sort_order',
                ),
                'sort_id'=>array(
                    'order'=>'t.id',
                ),
                'is_bottom'=>array(
                    'condition'=>"bottom=1",
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
			array('bottom, sort_order, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,code, bottom, sort_order, status', 'safe'),
			array('id,code, title, description, bottom, sort_order, status', 'safe', 'on'=>'search'),
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
                         'descriptions' => array(self::HAS_MANY, 'InformationDescription', 'information_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Page Code',
			'bottom' => 'Bottom',
			'sort_order' => 'Sort Order',
			'status' => 'Status',
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
		$criteria->compare('bottom',$this->bottom);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('status',$this->status);
		$criteria->compare('t.code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        
               
        public function searchByLanguage(){
            $dataProvider=$this->search();
            $criteria=$dataProvider->criteria;
             
            $criteria->with=array("descriptions","descriptions.language");
            $criteria->together=true;
//            $criteria->compare('language.code', Yii::app()->language);
            $criteria->compare('descriptions.title', $this->title,true);
            $criteria->compare('descriptions.description', $this->description,true);
            $criteria->order="t.id desc";

            
            $criteria->select=array('t.*','descriptions.title as title','descriptions.description as description',);
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination' => array('pageSize' => 25),
            ));
        }
        
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Information the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
