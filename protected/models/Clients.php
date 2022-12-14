<?php

/**
 * This is the model class for table "tbl_clients".
 *
 * The followings are the available columns in table 'tbl_clients':
 * @property integer $id
 * @property string $client_name
 * @property string $description
 * @property string $agent
 * @property string $agent_info
 * @property integer $status
 * @property string $date_created
 */
class Clients extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_clients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_name, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('client_name, description, agent_info', 'length', 'max'=>255),
			array('agent', 'length', 'max'=>100),
			array('date_created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, client_name, description, agent, agent_info, status, date_created', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'client_name' => 'Client Name',
			'description' => 'Description',
			'agent' => 'Agent',
			'agent_info' => 'Agent Info',
			'status' => 'Status',
			'date_created' => 'Date Created',
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
		$criteria->compare('client_name',$this->client_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('agent',$this->agent,true);
		$criteria->compare('agent_info',$this->agent_info,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clients the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getListClients() {
        $id = 'clients';
        $val = Yii::app()->cache->get('clients');
        if (!$val):
            $criteria = new CDbCriteria();
            $criteria->addCondition('status = 1');
            $criteria->order = 'client_name asc';
            $data = Clients::model()->findAll($criteria);
            $data = CHtml::listData($data, 'id', 'client_name');
        else:
            $data = Yii::app()->cache->get($id);
        endif;
        return $data;
    }

}
