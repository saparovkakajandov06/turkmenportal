<?php

/**
 * @property string $create_username
 * @property string $date_added
 * @property int    $region_id
 * @property int    $category_id
 * @property string $title
 * @property string $text
 * @property int    $material_id
 * @property string $material_import
 * @property string $material_class
 */

class Announcement extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'user_announcement';
    }
    
    
    private $_material;
    public function getMaterial()
    {
        if ($this->_material === null){
//            if ($this->material_import){
//                Yii::import($this->material_import);
//            }   
            $this->_material = CActiveRecord::model($this->material_class)->findByPk($this->material_id);
        }
         
        return $this->_material;
    }
    
    
    
    
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('title, text,material_id,material_import,material_class,region_id,category_id,create_username,date_added', 'safe'),
            );
    }
    
    
    public function search()
    {
            $criteria=new CDbCriteria;
            $criteria->compare('material_id',$this->material_id);
            $criteria->compare('material_import',$this->material_import);
            $criteria->compare('material_class',$this->material_class);
            $criteria->compare('region_id',$this->region_id);
            $criteria->compare('category_id',$this->category_id);
            $criteria->compare('title',$this->title,true);
            $criteria->compare('text',$this->text,true);
            $criteria->compare('create_username',$this->create_username,true);
            $criteria->compare('date_added',$this->date_added,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>20,
                    ),
            ));
    }
}
?>
