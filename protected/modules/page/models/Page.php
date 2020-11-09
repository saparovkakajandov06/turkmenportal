<?php

/**
 * This is the model class for table "tbl_page".
 *
 * The followings are the available columns in table 'tbl_page':
 * @property integer $id
 * @property integer $type
 * @property integer $parent_id
 * @property string $code
 * @property integer $top
 * @property integer $slider
 * @property integer $column
 * @property integer $sort_order
 * @property integer $status
 * @property string $date_added
 * @property string $date_modified
 * @property string $edited_username
 * @property string $create_username
 */
class Page extends ActiveRecord
{
        private $_url;
        public $title;
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_page';
	}

        const TYPE_DEFAULT_PAGE =0, TYPE_PARTIAL_PAGE = 1,TYPE_PARTIAL_FOOTER_PAGE = 2,TYPE_SUB_PAGE = 3;

        
        
        public function getUrl(){
            if ($this->_url === null)
                $this->_url = Yii::app()->createAbsoluteUrl('page/page/view', array('id'=>$this->id));
            return strlen(trim($this->_url))>0 ? $this->_url : "#";
        }
        
        function behaviors() {
            return array_merge(parent::behaviors(),array(
                'xupload' => array(
                    'class' => 'ext.xupload.components.XUploadBehavior',
                    'state_name' => 'state_page',
                    'related_table_name' => 'tbl_page_to_documents',
              )
            ));
        }

        public function getTypeOptions() {
              return array(
                  self::TYPE_DEFAULT_PAGE => Yii::t('app', 'TYPE_DEFAULT_PAGE'),
//                  self::TYPE_PARTIAL_PAGE => Yii::t('app', 'TYPE_PARTIAL_PAGE'),
//                  self::TYPE_PARTIAL_FOOTER_PAGE => Yii::t('app', 'TYPE_PARTIAL_FOOTER_PAGE'),
                  self::TYPE_SUB_PAGE => Yii::t('app', 'TYPE_SUB_PAGE'),
              );
        }


        public function getTypeText() {
              $typeOptions = $this->typeOptions;
              return isset($typeOptions[$this->type]) ?
                      $typeOptions[$this->type] : Yii::t('app','$LNG_STATUS_UNKNOWN');
        }

        
        public function scopes()
        {
            return array(
               
                
                'enabled'=>array(
                    'condition'=>'t.status=1',
                ),
                
                'slider'=>array(
                    'condition'=>'t.slider=1',
                ),
                
                'sort_newest'=>array(
                    'order'=>'t.date_added desc',
                ),
                
                'sort_by_order'=>array(
                    'order'=>'t.sort_order',
                ),
                
                'sort_by_order_desc'=>array(
                    'order'=>'t.sort_order desc',
                ),
                
                'no_parent'=>array(
                    'condition'=>'t.parent_id is null OR type=0',
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
			array('top, status', 'required'),
			array('parent_id, top, column, sort_order, status', 'numerical', 'integerOnly'=>true),
			array('code, edited_username, create_username', 'length', 'max'=>255),
			array('date_added, date_modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,slider, type,parent_id, code, top, column, sort_order, status, date_added, date_modified, edited_username, create_username', 'safe'),
			array('id, slider,type,parent_id, code, top, column, sort_order, status, date_added, date_modified, edited_username, create_username', 'safe', 'on'=>'search'),
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
                    'descriptions' => array(self::HAS_MANY, 'PageDescription', 'page_id'),
                    'category'=>array(self::BELONGS_TO,'Category', 'category_id'),
                    'parent'=>array(self::BELONGS_TO,'Page', 'parent_id'),
                    'documents'=>array(self::MANY_MANY,'Documents', 'tbl_page_to_documents(page_id,documents_id)'),
                    'files'=>array(self::MANY_MANY,'Documents', 'tbl_page_to_files(page_id,documents_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'code' => 'Code',
			'top' => 'Top',
			'column' => 'Column',
			'sort_order' => 'Sort Order',
			'status' => 'Status',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('top',$this->top);
		$criteria->compare('slider',$this->slider);
		$criteria->compare('column',$this->column);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_modified',$this->date_modified,true);
		$criteria->compare('edited_username',$this->edited_username,true);
		$criteria->compare('create_username',$this->create_username,true);
		
                $criteria->order="id desc";

                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function getParentPages($code=null){
            $criteria=new CDbCriteria();
            $criteria->scopes=array("enabled");
            $criteria->compare('code', $code);
            $pageModels=$this->findAll($criteria);
            
            $data=array();
            foreach ($pageModels as $pageModel){
                $data[$pageModel->id]=$pageModel->getMixedDescriptionModel()->title;
            }
            return $data;
        }
        
        
        public function getTitle(){
            if(!isset($this->title)){
                $this->title=$this->getMixedDescriptionModel()->title;
            }
            return $this->title;
        }
        
        
        public function getParentTitle(){
            $parent=$this->parent;
            if(isset($parent)){
                return $parent->getMixedDescriptionModel()->title;
            }
            return "";
        }
        
        
}
