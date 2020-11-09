<?php

class TagController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
        
        
        public function actionAutocomplete()
        {
           if(Yii::app()->request->isAjaxRequest && isset($_GET['q']) && strlen(trim( $_GET['q'] ))>1)
           {
              $name = $_GET['q']; 
              $limit = min($_GET['limit'], 50); 
              $criteria = new CDbCriteria;
              $criteria->addSearchCondition('name','%'.$name.'%',false);
              $criteria->limit = $limit;
              $tagModelArray = Tag::model()->findAll($criteria);
              $returnVal = '';
              foreach($tagModelArray as $tagModel)
              {
                 $returnVal .= $tagModel->getAttribute('name').'|'
                                             .$tagModel->getAttribute('id')."\n";
              }
              echo $returnVal;
           }
        }
        
        
        public function actionJson()
        {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-type: application/json');

            $this->layout = false;
            if(isset($_GET['tag'])){

                $criteria=new CDbCriteria(array(
                    'limit' => 10
                ));

                $criteria->addSearchCondition('name', $_GET['tag']);

                $tags = Tag::model()->findAll($criteria);            

                $returnVal = array();
                foreach($tags as $tag)
                {
                   $returnVal[]= array('label'=>$tag->getAttribute('name'));
                }
                  
                echo json_encode($returnVal);
//                $this->render('json', array('tags' => $tags));
            }
        }
}