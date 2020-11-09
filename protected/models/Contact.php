<?php

/**
 * This is the model class for table "tbl_contact".
 *
 * The followings are the available columns in table 'tbl_contact':
 * @property integer $id
 * @property string $last_name
 * @property string $first_name
 * @property string $company_name
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $email
 * @property string $phone
 * @property string $fax
 * @property string $comments
 * @property string $date_added
 * @property string $date_modified
 * @property string $edited_username
 * @property string $create_username
 */
class Contact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('last_name, first_name, address, city, email, comments', 'required'),
			array('email', 'email'),
			array('last_name, company_name, email, phone', 'length', 'max'=>250),
			array('first_name, address, city, country, fax, edited_username, create_username', 'length', 'max'=>255),
			array('date_added, date_modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, last_name, first_name, company_name, address, city, country, email, phone, fax, comments, date_added, date_modified, edited_username, create_username', 'safe', 'on'=>'search'),
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
			'last_name' => 'Last Name',
			'company_name' => 'Company Name',
			'address' => 'Address',
			'city' => 'City',
			'country' => 'Country',
			'email' => Yii::t('app','email'),
			'phone' => Yii::t('app','phone'),
			'comments' => Yii::t('app','comments'),
			'first_name' => Yii::t('app','first_name'),
			'fax' => 'Fax',
			'date_added' => 'Date Added',
			'date_modified' => 'Date Modified',
			'edited_username' => 'Edited Username',
			'create_username' => 'Create Username',
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
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_modified',$this->date_modified,true);
		$criteria->compare('edited_username',$this->edited_username,true);
		$criteria->compare('create_username',$this->create_username,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
