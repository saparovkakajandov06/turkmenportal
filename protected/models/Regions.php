<?php

/**
 * This is the model class for table "tbl_regions".
 *
 * The followings are the available columns in table 'tbl_regions':
 * @property integer $id
 * @property integer $parent_id
 * @property string $code
 * @property integer $sort_order
 * @property integer $status
 * @property string $date_added
 * @property string $date_modified
 * @property string $edited_username
 * @property string $create_username
 */
class Regions extends ActiveRecord {
    public $name, $description;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_regions';
    }


    public function scopes() {
        return array(
            'enabled' => array(
                'condition' => 't.status=1',
            ),

            'sort_by_sort_order' => array(
                'order' => 't.sort_order asc',
            ),

            'with_parent' => array(
                'condition' => 't.parent_id is not null',
            ),

            'with_description' => array(
                'condition' => "language.code='" . Yii::app()->language . "'",
                'with' => array("descriptions", "descriptions.language"),
                'together' => true,
                'select' => array('t.*', 'descriptions.region_name as name')
            ),

            'sort_by_alpha' => array(
                'order' => 'descriptions.region_name asc',
            ),
        );
    }


    function behaviors() {
        return array_merge(parent::behaviors(), array(
            'ESaveRelatedBehavior' => array('class' => 'application.components.ESaveRelatedBehavior'),
        ));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status', 'required'),
            array('parent_id, sort_order, status', 'numerical', 'integerOnly' => true),
            array('edited_username, create_username', 'length', 'max' => 255),
            array('date_added, date_modified,code', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, parent_id,code, sort_order, status, date_added, date_modified, edited_username, create_username', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'descriptions' => array(self::HAS_MANY, 'RegionsDescription', 'region_id'),
            'parent' => array(self::BELONGS_TO, 'Regions', 'parent_id'),
            'children' => array(self::HAS_MANY, 'Regions', 'parent_id'),
        );
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'id'),
            'parent_id' => Yii::t('app', 'parent_id'),
            'code' => Yii::t('app', 'code'),
            'sort_order' => Yii::t('app', 'sort_order'),
            'status' => Yii::t('app', 'status'),
            'date_added' => Yii::t('app', 'date_added'),
            'date_modified' => Yii::t('app', 'date_modified'),
            'edited_username' => Yii::t('app', 'edited_username'),
            'create_username' => Yii::t('app', 'create_username'),
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('sort_order', $this->sort_order);
        $criteria->compare('status', $this->status);
        $criteria->compare('code', $this->code);
        $criteria->compare('date_added', $this->date_added, true);
        $criteria->compare('date_modified', $this->date_modified, true);
        $criteria->compare('edited_username', $this->edited_username, true);
        $criteria->compare('create_username', $this->create_username, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Regions the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


    public function getRegionsListByTree() {
        $criteria = new CDbCriteria();
        $criteria->scopes = array('enabled');
//            $criteria->addCondition('parent_id is not null');

        $datas = Regions::model()->findAll($criteria);
        $list = array();
        foreach ($datas as $data) {
            $name = '';
            if (isset($data->getMixedDescriptionModel()->region_name) && strlen(trim($data->getMixedDescriptionModel()->region_name)) > 0) {
                if (isset($data->parent))
                    $name = $data->parent->getMixedDescriptionModel()->region_name . ' > ';
                $name .= $data->getMixedDescriptionModel()->region_name;
                $list[$data->id] = $name;
            }
        }
        return $list;
    }


    public function getMixedDescriptionModel() {
        $descriptions = $this->descriptions;
        if (isset ($descriptions) && count($descriptions) == 1) {
            return $descriptions[0];
        } else {
            foreach ($descriptions as $description) {
                if ($description->language->code == Yii::app()->language) {
                    return $description;
                }
            }
        }
    }


    public function searchByLanguage() {
        $dataProvider = $this->search();
        $criteria = $dataProvider->criteria;

        $criteria->with = array("descriptions", "descriptions.language");
        $criteria->together = true;
        $criteria->compare('language.code', Yii::app()->language);
        $criteria->compare('descriptions.region_name', $this->name, true);
        $criteria->order = "t.id desc";

        $criteria->select = array('t.*', 'descriptions.region_name as name');
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 20),
        ));
    }


    public function getParentRegionsList() {
        $criteria = new CDbCriteria();
        $criteria->scopes = array('with_description', 'enabled', 'sort_by_alpha');
        $criteria->addCondition('parent_id is null or parent_id=0');

        $data = Regions::model()->findAll($criteria);
        $data = CHtml::listData($data, 'id', 'name');
        return $data;
    }


    public function getListByParentCode($parent_code) {
        $criteria = new CDbCriteria();
        $criteria->with = array('parent');
        $criteria->scopes = array('with_description', 'enabled', 'sort_by_sort_order');
        $criteria->compare('parent.code', $parent_code);

        $data = Regions::model()->findAll($criteria);
        $data = CHtml::listData($data, 'id', 'name');
        return $data;
    }


    public function getParentName() {
        $parent = $this->parent;
        if (isset($parent)) {
            return $parent->getMixedDescriptionModel()->region_name;
        } else
            return "";
    }


    public function getMixedName()
    {
        $descriptionModel=$this->getMixedDescriptionModel();
        if(isset($descriptionModel)){
            return $descriptionModel->region_name;
        }
    }

}
