<?php

/**
 * @property string $profession_id
 * @property string $branch_id
 * @property string $url
 */
class Work extends ActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'view_work';
    }
    
    
    public function scopes() {
        return array(
            'sort_newest' => array(
                'order' => 't.date_added desc',
            ),
        );
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
    
    
    
    public function search($query=null)
    {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('profession_id',$this->profession_id);
            $criteria->compare('branch_id',$this->branch_id);
            $criteria->compare('region_id',$this->region_id);
            $criteria->compare('material_class',$this->material_class);
            $criteria->scopes=array('sort_newest');
   
            if(isset($query)){
                $criteria->addSearchCondition('description', $query,true);
                $criteria->addSearchCondition('others', $query, true, 'OR');
            }
            
            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                            'pageSize'=>50,
                    ),
            ));
    }
    
    
     public function searchForIndex($limit=5){
            $criteria=new CDbCriteria();
            $criteria->scopes=array('sort_newest');

            $criteria->limit=$limit;
            $criteria->offset=0;
            
            $dp= new CActiveDataProvider($this, 
              array(
                  'criteria'=>$criteria,
                  'pagination' => ($limit>0) ? false: array('pageSize' => 50)
            ));
            
            
            return $dp;
     }




    protected function afterSave() {
        $this->updateWorkView();
        parent::afterSave();
    }


    protected function afterDelete() {
        parent::beforeDelete();
        $this->updateWorkView();
    }


    protected function updateWorkView(){
        Yii::app()->db->createCommand("
            CREATE OR REPLACE VIEW view_work AS
                SELECT ee.description as description, CONCAT(ee.experience,ee.computer_experience) as others, ee.date_added, ee.profession_id, ee.branch_id, ee.region_id, ee.views, ee.likes, ee.id AS material_id, 'application.models.Employees' AS material_import, 'Employees' AS material_class FROM `tbl_employees` ee UNION 
                SELECT er.description as description, CONCAT(er.job_name,er.requirement) as others, er.date_added, er.profession_id, er.branch_id, er.region_id, er.views, er.likes, er.id AS material_id, 'application.models.Employers' AS material_import, 'Employers' AS material_class FROM `tbl_employers` er 
        ")->execute();

        echo "work index updated";
    }

}
?>
