<?php

/**
 * This is the model class for table "tbl_comments".
 *
 * The followings are the available columns in table 'tbl_comments':
 * @property integer $id
 * @property integer $parent_id
 * @property string $text
 * @property string $related_to
 * @property integer $like_count
 * @property integer $dislike_count
 * @property integer $status
 * @property string $edited_username
 * @property string $create_username
 * @property string $date_added
 * @property string $date_modified
 * @property string $related_relation
 * @property integer $related_relation_id
 */
class Comments extends ActiveRecord
{
    public $default_scope = array('enabled', 'sort_newest');

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_comments';
    }


    private $_material;

    public function getMaterial()
    {
//        echo "getMaterial";
        if ($this->_material === null) {
//            if ($this->material_import){
//                Yii::import($this->material_import);
//            }
            $this->_material = CActiveRecord::model($this->related_to)->findByPk($this->related_relation_id);
        }

        return $this->_material;
    }


    public function getMaterialTitle()
    {
        $related = $this->getMaterial();

        if (isset($related)) {
//            echo "<pre>";
//            print_r($related->getTitle());
//            echo "</pre>";

            return $related->getTitle();
        }
    }

    public function getMaterialUrl()
    {
        $related = $this->getMaterial();

        if (isset($related)) {
            return $related->url;
        }
    }

//        protected function beforeValidate()
//        {
//            if($this->isNewRecord)
//            {
//                $ip=Yii::app()->controller->getRealIp();
//                $this->ip_added=$this->ip_modified=ip2long($ip);
//            }
//            else
//            {
//                $ip=Yii::app()->controller->getRealIp();
//                $this->ip_modified=ip2long($ip);
//            }
//
//            return parent::beforeValidate();
//        } 


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status', 'required'),
            array('parent_id, like_count, status,dislike_count', 'numerical', 'integerOnly' => true),
            array('edited_username, create_username', 'length', 'max' => 255),
            array('text, date_added, date_modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, related_relation,related_relation_id,parent_id, text, like_count,dislike_count, status, edited_username, create_username, date_added, date_modified', 'safe'),
            array('id, related_relation,related_relation_id,parent_id, text, like_count,dislike_count, status, edited_username, create_username, date_added, date_modified', 'safe', 'on' => 'search'),
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
            'blogs' => array(self::MANY_MANY, 'Blog', 'tbl_blog_to_comments(comment_id,blog_id)'),
            'catalogs' => array(self::MANY_MANY, 'Catalog', 'tbl_catalog_to_comments(comment_id,catalog_id)'),
            'autos' => array(self::MANY_MANY, 'Auto', 'tbl_auto_to_comments(comment_id,auto_id)'),
            'estates' => array(self::MANY_MANY, 'Estates', 'tbl_estates_to_comments(comment_id,estates_id)'),
            'works' => array(self::MANY_MANY, 'Work', 'tbl_work_to_comments(comment_id,work_id)'),
//                    'employers'=>array(self::MANY_MANY,'Employers', 'tbl_employers_to_comments(comment_id,employers_id)'),
//                    'employees'=>array(self::MANY_MANY,'Employees', 'tbl_employees_to_comments(comment_id,employees_id)'),
            'compositions' => array(self::MANY_MANY, 'Compositions', 'tbl_compositions_to_comments(comment_id,compositions_id)'),
            'childrens' => array(self::HAS_MANY, 'Comments', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'id'),
            'parent_id' => Yii::t('app', 'parent_id'),
            'text' => Yii::t('app', 'text'),
            'like_count' => Yii::t('app', 'like_count'),
            'dislike_count' => Yii::t('app', 'dislike_count'),
            'related_to' => Yii::t('app', 'related_to'),
            'status' => Yii::t('app', 'status'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'create_username' => Yii::t('app', 'create_username'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
        );
    }


    public function scopes()
    {
        return array(
            'enabled' => array(
                'condition' => 't.status=1',
            ),

            'sort_newest' => array(
                'order' => 't.date_added desc',
            ),

            'sort_oldest' => array(
                'order' => 't.date_added asc',
            ),
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('like_count', $this->like_count);
        $criteria->compare('dislike_count', $this->dislike_count);
        $criteria->compare('status', $this->status);
        $criteria->compare('edited_username', $this->edited_username, true);
        $criteria->compare('create_username', $this->create_username, true);
        $criteria->compare('date_added', $this->date_added, true);
        $criteria->compare('date_modified', $this->date_modified, true);

        $criteria->scopes = $this->default_scope;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    public function searchForRender()
    {
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;
//        $criteria->compare('t.status', 1);
        $criteria->addCondition('parent_id is null');

        $criteria->compare('related_relation_id',$this->related_relation_id);
        $criteria->compare('related_relation',$this->related_relation);

//        if (isset ($this->related_relation) && isset ($this->related_relation_id)) {
//            $criteria->with = array("$this->related_relation");
//            $criteria->together = true;
//            $criteria->compare($this->related_relation . ".id", $this->related_relation_id);
//        }

        $criteria->scopes = $this->default_scope;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    public function searchForUsers($limit = 50)
    {
        $this->default_scope = array('sort_newest');
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;


        $dp = new CActiveDataProvider($this,
            array(
                'criteria' => $criteria,
                'pagination' => array('pageSize' => 25)
            ));
        return $dp;
    }


    public function searchForMostCommented($limit = 10)
    {
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;


        $dp = new CActiveDataProvider($this,
            array(
                'criteria' => $criteria,
                'pagination' => array('pageSize' => 25)
            ));
        return $dp;
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Comments the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function getOwnerModel()
    {
        if (isset($this->create_username)) {
            $userModel = User::model()->findByAttributes(array('username' => $this->create_username));
            if (isset($userModel))
                return $userModel;
        }
    }

    public function getOwnerAvatar($width = null, $height = null, $type = null)
    {
        if (isset($this->create_username)) {
            $userModel = User::model()->findByAttributes(array('username' => $this->create_username));
            if (isset($userModel)) {
                return $userModel->getUserAvatar($width, $height, $type);
            }
        }
    }
}
