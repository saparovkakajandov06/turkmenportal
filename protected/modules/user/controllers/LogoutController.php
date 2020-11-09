<?php

class LogoutController extends Controller
{
	public $defaultAction = 'logout';
	
	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
                if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
                    $this->redirect(Yii::app()->controller->module->returnLogoutUrl);
	}
        
        

}