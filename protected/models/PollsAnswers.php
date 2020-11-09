<?php

/**
 * This is the model class for table "tbl_polls_answers".
 *
 * The followings are the available columns in table 'tbl_polls_answers':
 * @property string $id
 * @property string $polls_id
 * @property string $views
 * @property string $sort_order
 * @property string $likes
 * @property integer $dislikes
 * @property integer $status
 * @property string $edited_username
 * @property string $create_username
 * @property string $date_added
 * @property string $date_modified
 */
class PollsAnswers extends ActiveRecord
{
        public $answer;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_polls_answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('polls_id', 'required'),
			array('dislikes,polls_id, status,sort_order', 'numerical', 'integerOnly'=>true),
			array('views, likes', 'length', 'max'=>10),
			array('edited_username, create_username', 'length', 'max'=>255),
			array('date_added, date_modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,answer,sort_order, polls_id,views, likes, dislikes, status, edited_username, create_username, date_added, date_modified', 'safe', 'on'=>'search'),
		);
	}

        public function scopes()
        {
            return array(
             
                'enabled'=>array(
                    'condition'=>'t.status=1',
                ),
                
                'sort_by_order' => array(
                    'order' => 't.sort_order desc',
                ),
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
                    'descriptions' => array(self::HAS_MANY, 'PollsAnswersDescription', 'polls_answers_id'),
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
                    'sort_order' => Yii::t('app', 'sort_order'),
                    'views' => Yii::t('app', 'views'),
                    'likes' => Yii::t('app', 'likes'),
                    'dislikes' => Yii::t('app', 'dislikes'),
                    'status' => Yii::t('app', 'status'),
                    'edited_username' => Yii::t('app', 'edited_username'),
                    'create_username' => Yii::t('app', 'create_username'),
                    'date_added' => Yii::t('app', 'date_added'),
                    'date_modified' => Yii::t('app', 'date_modified'),
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
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('likes',$this->likes,true);
		$criteria->compare('dislikes',$this->dislikes);
		$criteria->compare('status',$this->status);
		$criteria->compare('edited_username',$this->edited_username,true);
		$criteria->compare('create_username',$this->create_username,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_modified',$this->date_modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function searchByLanguage(){
            $dataProvider=$this->search();
            $criteria=$dataProvider->criteria;
            $criteria->with=array("descriptions","descriptions.language");
            $criteria->together=true;

            $criteria->compare('descriptions.answer', $this->answer,true);
            $criteria->order="t.id desc";

            $criteria->select=array('t.*','descriptions.answer as answer');
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination' => array('pageSize' => 25),
            ));
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PollsAnswers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
//        public function getMixedDescriptionModel(){
//            $descriptions=$this->descriptions;
//            if(isset ($descriptions) && count($descriptions)==1){
//                return $descriptions[0];
//            }
//            else{
//                foreach ($descriptions as $description) {
//                    if($description->language->code==Yii::app()->language){
//                        return $description;
//                    }
//                }
//            }
//        }
}
