<?php
class PollsWidget extends CWidget
{
    public $poll_id;

    public function init() {
        parent::init();
    }
    
    
    public function run()
    {
//        $criteria=new CDbCriteria();
//        $criteria->scopes=array('enabled');
//        $criteria->order = 'RAND()';
//        if(isset($this->poll_id)){
//            $pollsModel=Polls::model()->findByPk($this->poll_id);
//        }else
//            $pollsModel=Polls::model()->find($criteria);
//        
//        if(isset($pollsModel))
//            $pollsAnswers= PollsAnswers::model()->sort_by_order()->enabled()->findAllByAttributes(array('polls_id'=>$pollsModel->id));
//        if(isset($pollsAnswers) && count($pollsAnswers)>0){
////            echo "<pre>";
////            print_r($pollsAnswers);
////            echo "</pre>";
//            $this->render('PollsWidget', array('pollsAnswers'=>$pollsAnswers,'pollsModel'=>$pollsModel));
//        }
    }
}
?>
