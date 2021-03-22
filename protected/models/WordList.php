<?php

/**
 * This is the model class for table "tbl_word_filter".
 *
 * The followings are the available columns in table 'tbl_word_filter':
 * @property integer $id
 * @property string $word
 * @property string $definition
 * @property string $content
 * @property integer $type
 */
class WordList extends CActiveRecord
{

    public $default_scope = array('sort_newest');

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_word_filter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('word', 'required'),
            array('word', 'unique'),
			array('word', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, word ', 'safe', 'on'=>'search'),
		);
	}


    public function scopes()
    {
        return array(
            'sort_newest' => array(
                'order' => 't.id desc',
            ),
//            'sterling' => array(
//                'condition' => 'type=0',
//            )
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
			'word' => 'Word',
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
		$criteria->compare('word',$this->word,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WordList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function search2()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('word',$this->word,true);

        $criteria->scopes = $this->default_scope;

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 20,
                'pageVar' => 'page',
            ),
        ));
    }

    public static function filterWords()
    {
        $word = WordList::model()->findAll();
        $word = CHtml::listData($word, 'id', 'word');
        if (!is_dir(Yii::getPathOfAlias('application.runtime.WordFilter'))) {
            mkdir(Yii::getPathOfAlias('application.runtime.WordFilter'));
        }
        file_put_contents(Yii::getPathOfAlias('application.runtime.WordFilter') . '/sterling.json',json_encode($word));

    }
}
