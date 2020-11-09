<?php

/**
 * This is the model class for table "tbl_video_resolutions".
 *
 * The followings are the available columns in table 'tbl_video_resolutions':
 * @property integer $id
 * @property integer $document_id
 * @property string $path
 * @property integer $width
 * @property integer $height
 */
class VideoResolutions extends CActiveRecord
{
    public $url;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_video_resolutions';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('document_id, path, width, height', 'required'),
            array('document_id, width, height', 'numerical', 'integerOnly' => true),
            array('path', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, document_id, path, width, height', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'document_id' => 'Document',
            'path' => 'Path',
            'width' => 'Width',
            'height' => 'Height',
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
        $criteria->compare('document_id', $this->document_id);
        $criteria->compare('path', $this->path, true);
        $criteria->compare('width', $this->width);
        $criteria->compare('height', $this->height);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return VideoResolutions the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
