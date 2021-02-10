<?php

/**
 * This is the model class for table "tbl_info_cities".
 *
 * The followings are the available columns in table 'tbl_info_cities':
 * @property integer $id
 * @property integer $citi_id
 * @property string $citi_name
 * @property string $state
 * @property string $country
 * @property string $lon
 * @property string $lat
 * @property integer $visibility
 * @property integer $status
 */
class InfoCities extends ActiveRecord
{


    public $default_scope = array('enabled', 'visibility','sort_by_order_desc' );




    public function getUrl($absolute = false)
    {
        $url = Yii::app()->createAbsoluteUrl('weather/view', array(
            'id' => $this->id,
            'alias' => strtolower($this->getCitiName()),
        ));

        $url = trim($url, '/');
        return strlen(trim($url)) > 0 ? $url : "#";
    }


    public function getTmUrl()
    {
        $url = DMultilangHelper::addSpecificLangToUrl(
            Yii::app()->createUrl('weather/view', array(
                'id' => $this->id,
                'alias' => strtolower($this->getCitiName()),
            )), 'tm');
        $url = Yii::app()->getBaseUrl(true) . $url;
        return $url;
    }

    public function getEnUrl()
    {
        $url = DMultilangHelper::addSpecificLangToUrl(
            Yii::app()->createUrl('weather/view', array(
                'id' => $this->id,
                'alias' => strtolower($this->getCitiName()),
            )), 'en');
        $url = Yii::app()->getBaseUrl(true) . $url;
        return $url;
    }

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_info_cities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('citi_id, citi_name, lon, lat', 'required'),
			array('citi_id, visibility, status, sort_order, top', 'numerical', 'integerOnly'=>true),
			array('citi_name, name_ru, name_tm, name_en', 'length', 'max'=>150),
			array('state, country, lat', 'length', 'max'=>11),
			array('lon', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, citi_id, name_ru, name_tm, name_en,  citi_name, state, country, lon, lat, visibility, status', 'safe', 'on'=>'search'),
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
			'citi_id' => 'Citi',
			'citi_name' => 'Citi Name',
            'name_ru' => 'Name RU',
            'name_tm' => 'Name TM',
            'name_en' => 'Name EN',
			'state' => 'State',
			'country' => 'Country',
			'lon' => 'Lon',
			'lat' => 'Lat',
            'sort_order' => 'Sort Order',
            'visibility' => 'Visibility',
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
		$criteria->compare('citi_id',$this->citi_id);
        $criteria->compare('citi_name',$this->citi_name,true);
        $criteria->compare('name_ru',$this->name_ru,true);
        $criteria->compare('name_en',$this->name_en,true);
        $criteria->compare('name_tm',$this->name_tm,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('lon',$this->lon,true);
		$criteria->compare('lat',$this->lat,true);
        $criteria->compare('sort_order',$this->sort_order);
        $criteria->compare('visibility',$this->visibility);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InfoCities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function scopes()
    {
        return array(
            'enabled' => array(
                'condition' => 'status=1',
            ),
            'visibility' => array(
                'condition' => 'visibility=1',
            ),
            'sort_by_order' => array(
                'order' => 'sort_order',
            ),
            'top' => array(
                'condition' => 'top=1',
            ),
            'list' => array(
                'condition' => 'top=0',
            ),
            'sort_by_order_desc' => array(
                'order' => 'sort_order desc',
            ),
        );
    }


    public function selectVisibility($type = 'top')
    {
        $criteria = new CDbCriteria;

        $criteria->scopes = array('enabled', 'visibility','sort_by_order_desc', "$type");

         $dp = new CActiveDataProvider($this->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency(get_class($this)), 2),
//               $dp= new CActiveDataProvider($this,
                array(
                    'criteria' => $criteria,
                    'pagination' => false,
                ));
            return $dp;

    }


    public function getName()
    {
        $lang  = yii::app()->language;

            return $this->{name.'_'.$lang};
    }

    public function getCitiName()
    {
        return $this->citi_name;
    }

}
