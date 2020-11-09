<?php
class BackendController extends Controller {

    public $layout='//layouts/column2_admin';


    public function filters() { return array( 'rights', ); }
    //public function allowedActions() { return 'createQuick,create';}


    public function actionIndex() {
        $this->render('index', array());
    }
}