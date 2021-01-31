<?php

/**
 * This is the model class for table "tbl_locations_info".
 *
 * The followings are the available columns in table 'tbl_locations_info':
 * @property integer $id
 * @property integer $location_id
 * @property string $continent
 * @property string $country_code
 * @property string $country_flag
 * @property string $country_capital
 * @property string $country_phone
 * @property string $country_neighbours
 * @property string $region
 * @property string $city
 * @property string $asn
 * @property string $org
 * @property string $isp
 * @property string $timezone
 * @property string $timezone_name
 * @property string $timezone_gmt
 * @property string $currency
 * @property string $currency_code
 * @property string $currency_symbol
 * @property double $currency_rates
 *
 * The followings are the available model relations:
 * @property TblUserLocations $location
 */
class LocationsInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_locations_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('location_id', 'required'),
			array('location_id', 'numerical', 'integerOnly'=>true),
			array('currency_rates', 'numerical'),
			array('continent, org, isp', 'length', 'max'=>255),
			array('country_code, country_phone, timezone_gmt, currency_code', 'length', 'max'=>10),
			array('country_flag, asn', 'length', 'max'=>20),
			array('country_capital, country_neighbours, timezone_name', 'length', 'max'=>150),
			array('region, city, timezone', 'length', 'max'=>100),
			array('currency', 'length', 'max'=>75),
			array('currency_symbol', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, location_id, continent, country_code, country_flag, country_capital, country_phone, country_neighbours, region, city, asn, org, isp, timezone, timezone_name, timezone_gmt, currency, currency_code, currency_symbol, currency_rates', 'safe', 'on'=>'search'),
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
			'location' => array(self::BELONGS_TO, 'TblUserLocations', 'location_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'location_id' => 'Location',
			'continent' => 'Continent',
			'country_code' => 'Country Code',
			'country_flag' => 'Country Flag',
			'country_capital' => 'Country Capital',
			'country_phone' => 'Country Phone',
			'country_neighbours' => 'Country Neighbours',
			'region' => 'Region',
			'city' => 'City',
			'asn' => 'Asn',
			'org' => 'Org',
			'isp' => 'Isp',
			'timezone' => 'Timezone',
			'timezone_name' => 'Timezone Name',
			'timezone_gmt' => 'Timezone Gmt',
			'currency' => 'Currency',
			'currency_code' => 'Currency Code',
			'currency_symbol' => 'Currency Symbol',
			'currency_rates' => 'Currency Rates',
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
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('continent',$this->continent,true);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('country_flag',$this->country_flag,true);
		$criteria->compare('country_capital',$this->country_capital,true);
		$criteria->compare('country_phone',$this->country_phone,true);
		$criteria->compare('country_neighbours',$this->country_neighbours,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('asn',$this->asn,true);
		$criteria->compare('org',$this->org,true);
		$criteria->compare('isp',$this->isp,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('timezone_name',$this->timezone_name,true);
		$criteria->compare('timezone_gmt',$this->timezone_gmt,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('currency_code',$this->currency_code,true);
		$criteria->compare('currency_symbol',$this->currency_symbol,true);
		$criteria->compare('currency_rates',$this->currency_rates);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LocationsInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
