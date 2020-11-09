<?php

/**
 * This is the model class for table "tbl_polls_description".
 *
 * The followings are the available columns in table 'tbl_polls_description':
 * @property integer $id
 * @property integer $polls_id
 * @property integer $language_id
 * @property string $question
 * @property string $title
 */
class PollsDescription extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_polls_description';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language_id, question,title', 'required'),
			array('polls_id, language_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, polls_id, language_id, title, question', 'safe'),
			array('id, polls_id, language_id, title, question', 'safe', 'on'=>'search'),
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
                     'polls' => array(self::BELONGS_TO, 'Polls', 'polls_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id' => Yii::t('app', 'id'),
                    'polls_id' => Yii::t('app', 'polls_id'),
                    'language_id' => Yii::t('app', 'language_id'),
                    'title' => Yii::t('app', 'title'),
                    'question' => Yii::t('app', 'question'),
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
		$criteria->compare('polls_id',$this->polls_id);
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PollsDescription the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
