<?php

class WidgetsController extends Controller {

//    public $layout = '//layouts/column2_admin';

    public function filters() {
        return array('rights',);
    }

    
    public function actionPartial() {
        if (Yii::app()->getRequest()->getIsAjaxRequest()) {
            if(Yii::app()->request->isPostRequest) {    
                $data=$_POST;
                if(isset($data['widget'])){
                    $widget= $data['widget'];
                    unset($data['widget']);
                }
                
                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
                Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
                Yii::app()->clientScript->scriptMap['jquery.yiilistview.js'] = false;
                $this->renderPartial('_partial', array('widget'=>$widget,'data'=>$data), false,true);
            }
        }
    }


    public function actionCalendar() {
//        if (Yii::app()->getRequest()->getIsAjaxRequest()) {
//            if(Yii::app()->request->isPostRequest) {
                $data=$_POST;
                if(isset($data['widget'])){
                    $widget= $data['widget'];
                    unset($data['widget']);
                }

                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
                Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
                Yii::app()->clientScript->scriptMap['jquery.yiilistview.js'] = false;
                $this->renderPartial('_calendar', array('widget'=>$widget,'data'=>$data), false,true);
//            }
//        }
    }
    

}