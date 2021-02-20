<?php

class ItemController2 extends Controller
{

    public $layout = '//layouts/column2_admin';


    public function filters()
    {
        return array('rights',);
    }

    //public function allowedActions() { return 'createQuick,create';}


    public function actionIndex($code = null, $id = null)
    {
        $this->layout = "//layouts/user_profile";

        $photos = new XUploadForm;
        $model = new ItemForm();
        $model->currency = ItemForm::CURRENCY_MANAT;

        $user = Yii::app()->getModule('user')->user();
        if (isset($user)) {
            $model->username = $user->username;
            $model->owner = trim($user->profile->firstname . " " . $user->profile->lastname);
            $model->email = $user->email;
        }

        $dynamicModel = '';
        $dynamic_content = '';
        $state_name = 'state_item';
        $category_id = $_GET['category_id'];
        $this->pageTitle = Yii::t('app', 'item_add_form');


        $item_id = $id;
        $flag = true;
        if (isset($_POST['ItemForm'])) {
            if (Yii::app()->user->hasState($state_name)) {
                $documents = Yii::app()->user->getState($state_name);
                foreach ($documents as $docs) {
                    if (is_file($docs['path'])) {
                        $model->documents[] = $docs;
                    }
                }
                if (isset($model->documents) && is_array($model->documents) && count($model->documents) > 0) {
                    Yii::app()->user->setState($state_name, $model->documents);
                }
            }

            $model->attributes = $_POST['ItemForm'];
            if (isset($_POST['Catalog'])) {
                $categoryModel = Category::model()->findByPk($model->category_id);
                if (isset($model->id)) {
                    $dynamicModel = Catalog::model()->findByPk($model->id);
                }
                if (!isset($dynamicModel))
                    $dynamicModel = new Catalog();

                $dynamicModel->attributes = $_POST['Catalog'];
                $dynamicModel->parent_category_id = $categoryModel->parent_id;
                $dynamicModel->title_ru = $dynamicModel->title_tm = $model->title;
                $dynamicModel->description_ru = $dynamicModel->description_tm = $model->description;
                if (!Yii::app()->WordFilter->sterling($dynamicModel->title_ru) || !Yii::app()->WordFilter->sterling($dynamicModel->description_ru)){
                    $this->redirect(array('index'));
                }
                if (!$this->validateTabular(array($model, $dynamicModel))) {
                    $dynamic_content = $this->renderPartial('//catalog/_item_form', array('model' => $dynamicModel), true, false);
                } else {
                    $dynamicModel->region_id = $model->region_id;
                    $dynamicModel->category_id = $model->category_id;
                    $dynamicModel->create_username = $model->username;
                    $dynamicModel->phone = $model->phone;
                    $dynamicModel->mail = $model->email;
                    $dynamicModel->status = Catalog::STATUS_ENABLED;
                    $dynamicModel->date_end = $model->getDateEnd();
                    $dynamicModel->owner = $model->owner;

                    try {
                        $committed = false;
                        $transaction = Yii::app()->db->beginTransaction();
                        $dynamicModel->documents = Documents::model()->saveDocuments('catalog', 'state_item', true);
                        if ($dynamicModel->saveWithRelated(array('documents'))) {
                            $transaction->commit();
                            $committed = true;
                        } else {
                            echo "ERROR";
                            exit(0);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error', "Catalog doredilmedi");
                        $dynamicModel->addError('id', $e->getMessage());
                    }

                    if ($committed == true) {
                        $this->sendAlertEmail($dynamicModel, 'catalog/view');
                        $this->redirect(array('user/announcement'));
                    }
                }
            }


            if (isset($_POST['Auto'])) {
                if (isset($model->id)) {
                    $dynamicModel = Auto::model()->findByPk($model->id);
                }
                if (!isset($dynamicModel))
                    $dynamicModel = new Auto();

                $dynamicModel->category_id = $model->category_id;
                $dynamicModel->attributes = $_POST['Auto'];
                if (!$this->validateTabular(array($model, $dynamicModel))) {
                    $dynamic_content = $this->renderPartial('//auto/_item_form', array('model' => $dynamicModel), true, false);
                } else {
                    $dynamicModel->title = $model->title;
                    $dynamicModel->description = $model->description;
                    $dynamicModel->region_id = $model->region_id;
                    $dynamicModel->category_id = $model->category_id;
                    $dynamicModel->create_username = $model->username;
                    $dynamicModel->phone = $model->phone;
                    $dynamicModel->mail = $model->email;
                    $dynamicModel->status = Auto::STATUS_ENABLED;
                    $dynamicModel->owner = $model->owner;
                    $dynamicModel->date_end = $model->getDateEnd();
                    $dynamicModel->other_options = serialize($dynamicModel->other_options);
                    if (!Yii::app()->WordFilter->sterling($dynamicModel->title) || !Yii::app()->WordFilter->sterling($dynamicModel->description)){
                        $this->redirect(array('index'));
                    }
                    try {
                        $committed = false;
                        $transaction = Yii::app()->db->beginTransaction();
                        $dynamicModel->documents = Documents::model()->saveDocuments('autos', 'state_item', true);
                        if ($dynamicModel->saveWithRelated(array('documents'))) {
                            $transaction->commit();
                            $committed = true;
                        } else {
                            echo "ERROR";
                            exit(0);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error', "Auto doredilmedi");
                        $dynamicModel->addError('id', $e->getMessage());
                    }

                    if ($committed == true) {
                        $this->sendAlertEmail($dynamicModel, 'auto/view');
                        $this->redirect(array('user/announcement'));
                    }
                }
            }


            if (isset($_POST['Estates'])) {
                if (isset($model->id)) {
                    $dynamicModel = Estates::model()->findByPk($model->id);
                }
                if (!isset($dynamicModel)) {
                    $dynamicModel = new Estates();
                    $dynamicModel->status = Estates::STATUS_ENABLED;
                }


                $dynamicModel->attributes = $_POST['Estates'];
                $dynamicModel->category_id = $model->category_id;


                if (!$this->validateTabular(array($model, $dynamicModel))) {
                    $dynamic_content = $this->renderPartial('//estates/_item_form', array('model' => $dynamicModel), true, false);
                } else {
                    $dynamicModel->title = $model->title;
                    $dynamicModel->description = $model->description;
                    $dynamicModel->region_id = $model->region_id;
                    $dynamicModel->category_id = $model->category_id;
                    $dynamicModel->phone = $model->phone;
                    $dynamicModel->mail = $model->email;
                    $dynamicModel->create_username = $model->username;
                    $dynamicModel->owner = $model->owner;
                    $dynamicModel->date_end = $model->getDateEnd();
                    $dynamicModel->status = Estates::STATUS_ENABLED;
                    if (!Yii::app()->WordFilter->sterling($dynamicModel->title) || !Yii::app()->WordFilter->sterling($dynamicModel->description)){
                        $this->redirect(array('index'));
                    }
                    try {
                        $committed = false;
                        $transaction = Yii::app()->db->beginTransaction();
                        $dynamicModel->documents = Documents::model()->saveDocuments('estates', 'state_item', true);
                        if ($dynamicModel->saveWithRelated(array('documents'))) {
                            $transaction->commit();
                            $committed = true;
                        } else {
                            echo "ERROR";
                            exit(0);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error', "Auto doredilmedi");
                        $dynamicModel->addError('id', $e->getMessage());
                    }

                    if ($committed == true) {
                        $this->sendAlertEmail($dynamicModel, 'estates/view');
                        $this->redirect(array('user/announcement'));
                    }
                }
            }


            if (isset($_POST['Advert'])) {
                if (isset($model->id)) {
                    $dynamicModel = Advert::model()->findByPk($model->id);
                }
                if (!isset($dynamicModel))
                    $dynamicModel = new Advert();

                $categoryModel = Category::model()->findByPk($model->category_id);
                $dynamicModel->status = Advert::STATUS_ENABLED;
                $dynamicModel->attributes = $_POST['Advert'];
                $dynamicModel->parent_category_id = $categoryModel->parent_id;

                if (!$this->validateTabular(array($model, $dynamicModel))) {
                    $dynamic_content = $this->renderPartial('//advert/_item_form', array('model' => $dynamicModel), true, false);
                } else {
                    $dynamicModel->title = $model->title;
                    $dynamicModel->description = $model->description;
                    $dynamicModel->region_id = $model->region_id;
                    $dynamicModel->category_id = $model->category_id;
                    $dynamicModel->create_username = $model->username;
                    $dynamicModel->phone = $model->phone;
                    $dynamicModel->mail = $model->email;
                    $dynamicModel->date_end = $model->getDateEnd();
                    $dynamicModel->owner = $model->owner;
                    $dynamicModel->status = Advert::STATUS_ENABLED;
                    if (!Yii::app()->WordFilter->sterling($dynamicModel->title) || !Yii::app()->WordFilter->sterling($dynamicModel->description)){
                        $this->redirect(array('index'));
                    }
                    if (isset($dynamicModel->catalog_category_id)) {
                        $dynamicModel->category_id = $dynamicModel->catalog_category_id;
                    }

                    try {
                        $committed = false;
                        $transaction = Yii::app()->db->beginTransaction();
                        $dynamicModel->documents = Documents::model()->saveDocuments('adverts', 'state_item', true);
                        if ($dynamicModel->saveWithRelated(array('documents'))) {
                            $transaction->commit();
                            $committed = true;
                        } else {
                            echo "ERROR";
                            exit(0);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error', "Advert doredilmedi");
                        $dynamicModel->addError('id', $e->getMessage());
                    }

                    if ($committed == true) {
                        $this->sendAlertEmail($dynamicModel, 'advert/view');
                        $this->redirect(array('user/announcement'));
                    }
                }
            }


            if (isset($_POST['Work'])) {
                if (isset($model->id)) {
                    $dynamicModel = Work::model()->findByPk($model->id);
                }
                if (!isset($dynamicModel)) {
                    $dynamicModel = new Work();
                    $dynamicModel->status = Work::STATUS_ENABLED;
                }


                $dynamicModel->attributes = $_POST['Work'];
                $dynamicModel->status = Advert::STATUS_ENABLED;
                $dynamicModel->category_id = $model->category_id;

                if (!$this->validateTabular(array($model, $dynamicModel))) {

//                        print_r($model->getErrors());
//                        print_r($dynamicModel->getErrors());
                    $dynamic_content = $this->renderPartial('//work/_item_form', array('model' => $dynamicModel), true, false);
                } else {
                    $dynamicModel->title = $model->title;
                    $dynamicModel->description = $model->description;
                    $dynamicModel->region_id = $model->region_id;
                    $dynamicModel->category_id = $model->category_id;
                    $dynamicModel->create_username = $model->username;
                    $dynamicModel->phone = $model->phone;
                    $dynamicModel->mail = $model->email;
                    $dynamicModel->date_end = $model->getDateEnd();
                    $dynamicModel->owner = $model->owner;
                    $dynamicModel->status = Work::STATUS_ENABLED;
                    if (!Yii::app()->WordFilter->sterling($dynamicModel->title) || !Yii::app()->WordFilter->sterling($dynamicModel->description)){
                        $this->redirect(array('index'));
                    }
                    try {
                        $committed = false;
                        $transaction = Yii::app()->db->beginTransaction();
                        $dynamicModel->documents = Documents::model()->saveDocuments('work', 'state_item', true);
                        if ($dynamicModel->saveWithRelated(array('documents'))) {
                            $transaction->commit();
                            $committed = true;
                        } else {
                            echo "ERROR";
                            exit(0);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::app()->user->setFlash('error', "Work doredilmedi");
                        $dynamicModel->addError('id', $e->getMessage());
                    }

                    if ($committed == true) {
                        $this->sendAlertEmail($dynamicModel, 'work/view');
                        $this->redirect(array('user/announcement'));
                    }
                }
            }
        } else {
            $model->emptyTempList();
        }


        switch ($code) {
            case 'work':
                $dynamicModel = Work::model()->findByPk($item_id);
                if (isset($dynamicModel)) {
                    $itemCategoryModel = $dynamicModel->category;
                    if (isset($itemCategoryModel)) {
                        $itemParentCategoryModel = $itemCategoryModel->parent;
                        if (isset($itemParentCategoryModel) && isset($itemParentCategoryModel->parent_id) && $itemParentCategoryModel->parent_id > 0) {
                            $itemCategoryModel = $itemParentCategoryModel;
                        }
                    }

                    if (isset($itemCategoryModel)) {
                        $model->category_id = $itemCategoryModel->id;
                        $dynamicModel->parent_category_id = $itemCategoryModel->id;
                        $dynamicModel->catalog_category_id = $dynamicModel->category_id;
                    } else {
                        $model->category_id = $dynamicModel->category_id;
                    }


//                        $itemCategoryModel = Category::model()->findByAttributes(array('code'=>'employees'));
//                        if (isset($itemCategoryModel))
//                            $model->category_id = $itemCategoryModel->id;

                    $model->id = $dynamicModel->id;
                    $model->title = $dynamicModel->title;
                    $model->description = $dynamicModel->description;
                    $model->region_id = $dynamicModel->region_id;
                    $model->username = $dynamicModel->create_username;
                    $model->phone = $dynamicModel->phone;
                    $model->email = $dynamicModel->mail;
                    $model->owner = $dynamicModel->owner;
                    $model->setDateEnd($dynamicModel->date_end);


                    $dynamicModel->setStateName('state_item');
                    $dynamicModel->reloadTempList();
                    $dynamicModel->reloadDocumentsList(true);
                    $model->documents = $dynamicModel->docs;
                    $dynamic_content = $this->renderPartial('//work/_item_form', array('model' => $dynamicModel), true, false);
                }
                break;


            case 'auto':
                $dynamicModel = Auto::model()->findByPk($item_id);
                if (!isset($dynamicModel) && isset($category_id)) {
                    $dynamicModel = new Auto();
                    $childModel = Category::model()->enabled_for_announcement()->findByAttributes(array('parent_id' => $category_id));
                    if (isset($childModel))
                        $dynamicModel->category_id = $childModel->id;
                    else
                        $dynamicModel->category_id = $category_id;
                }

                if (isset($dynamicModel)) {
                    $itemCategoryModel = $dynamicModel->category;
                    if (isset($itemCategoryModel)) {
                        $itemParentCategoryModel = $itemCategoryModel->parent;
                        if (isset($itemParentCategoryModel) && isset($itemParentCategoryModel->parent_id) && $itemParentCategoryModel->parent_id > 0) {
                            $itemCategoryModel = $itemParentCategoryModel;
                        }
                    }

                    if (isset($itemCategoryModel))
                        $model->category_id = $itemCategoryModel->id;


                    $autoModel = $dynamicModel->automodel;
                    if (isset($autoModel)) {
                        $dynamicModel->make_id = $autoModel->make_id;
                    }

                    if (isset($dynamicModel->other_options))
                        $dynamicModel->other_options = unserialize($dynamicModel->other_options);


                    $model->id = $dynamicModel->id;
                    $model->title = $dynamicModel->title;
                    $model->description = $dynamicModel->description;
                    $model->region_id = $dynamicModel->region_id;
                    $model->username = $dynamicModel->create_username;
                    $model->phone = $dynamicModel->phone;
                    $model->email = $dynamicModel->mail;
                    $model->owner = $dynamicModel->owner;
                    $model->setDateEnd($dynamicModel->date_end);

                    $dynamicModel->setStateName('state_item');
                    $dynamicModel->reloadTempList();
                    $dynamicModel->reloadDocumentsList(true);
                    $model->documents = $dynamicModel->docs;

                    $dynamic_content = $this->renderPartial('//auto/_item_form', array('model' => $dynamicModel), true, false);
                }
                break;

            case 'estates':
                $dynamicModel = Estates::model()->findByPk($item_id);
                if (isset($dynamicModel)) {
                    $itemCategoryModel = $dynamicModel->category;
                    if (isset($itemCategoryModel)) {
                        $itemParentCategoryModel = $itemCategoryModel->parent;
                        if (isset($itemParentCategoryModel) && isset($itemParentCategoryModel->parent_id) && $itemParentCategoryModel->parent_id > 0) {
                            $itemCategoryModel = $itemParentCategoryModel;
                        }
                    }

                    if (isset($itemCategoryModel))
                        $model->category_id = $itemCategoryModel->id;


                    $model->id = $dynamicModel->id;
                    $model->title = $dynamicModel->title;
                    $model->description = $dynamicModel->description;
                    $model->region_id = $dynamicModel->region_id;
                    $model->username = $dynamicModel->create_username;
                    $model->phone = $dynamicModel->phone;
                    $model->email = $dynamicModel->mail;
                    $model->owner = $dynamicModel->owner;
                    $model->setDateEnd($dynamicModel->date_end);

                    $dynamicModel->setStateName('state_item');
                    $dynamicModel->reloadTempList();
                    $dynamicModel->reloadDocumentsList(true);
                    $model->documents = $dynamicModel->docs;

                    $dynamic_content = $this->renderPartial('//estates/_item_form', array('model' => $dynamicModel), true, false);
                }
                break;


            case 'advert':
                $dynamicModel = Advert::model()->findByPk($item_id);
                if (isset($dynamicModel)) {
                    $itemCategoryModel = $dynamicModel->category;
                    if (isset($itemCategoryModel)) {
                        $itemParentCategoryModel = $itemCategoryModel->parent;
                        if (isset($itemParentCategoryModel) && isset($itemParentCategoryModel->parent_id) && $itemParentCategoryModel->parent_id > 0) {
                            $itemCategoryModel = $itemParentCategoryModel;
                        }
                    }

                    if (isset($itemCategoryModel)) {
                        $model->category_id = $itemCategoryModel->id;
                        $dynamicModel->parent_category_id = $itemCategoryModel->id;
                        $dynamicModel->catalog_category_id = $dynamicModel->category_id;
                    } else {
                        $model->category_id = $dynamicModel->category_id;
                    }

                    $model->id = $dynamicModel->id;
                    $model->title = $dynamicModel->title;
                    $model->description = $dynamicModel->description;
                    $model->region_id = $dynamicModel->region_id;
                    $model->username = $dynamicModel->create_username;
                    $model->phone = $dynamicModel->phone;
                    $model->email = $dynamicModel->mail;
                    $model->owner = $dynamicModel->owner;
                    $model->setDateEnd($dynamicModel->date_end);

                    $dynamicModel->setStateName('state_item');
                    $dynamicModel->reloadTempList();
                    $dynamicModel->reloadDocumentsList(true);
                    $model->documents = $dynamicModel->docs;
                    $dynamic_content = $this->renderPartial('//advert/_item_form', array('model' => $dynamicModel), true, false);
                }
                break;


            case 'catalog':
                $dynamicModel = Catalog::model()->findByPk($item_id);
                if (!isset($dynamicModel) && isset($category_id)) {
                    $dynamicModel = new Catalog();
                    $dynamicModel->category_id = $category_id;
                }
                if (isset($dynamicModel)) {
                    $itemCategoryModel = $dynamicModel->category;
                    if (isset($itemCategoryModel)) {
                        $itemParentCategoryModel = $itemCategoryModel->parent;
                        if (isset($itemParentCategoryModel) && isset($itemParentCategoryModel->parent_id) && $itemParentCategoryModel->parent_id > 0) {
                            $itemCategoryModel = $itemParentCategoryModel;
                        }
                    }

                    if (isset($itemCategoryModel)) {
                        $model->category_id = $itemCategoryModel->id;
                        $dynamicModel->parent_category_id = $itemCategoryModel->id;
                        $dynamicModel->catalog_category_id = $dynamicModel->category_id;
                    } else {
                        $model->category_id = $dynamicModel->category_id;
                    }

                    $model->id = $dynamicModel->id;
                    $model->title = $dynamicModel->getTitle();
                    $model->description = $dynamicModel->getDescription();
                    $model->region_id = $dynamicModel->region_id;
                    $model->username = $dynamicModel->create_username;
                    $model->phone = $dynamicModel->phone;
                    $model->email = $dynamicModel->mail;
                    $model->owner = $dynamicModel->owner;
                    $model->setDateEnd($dynamicModel->date_end);

                    $dynamicModel->setStateName('state_item');
                    $dynamicModel->reloadTempList();
                    $dynamicModel->reloadDocumentsList(true);
                    $model->documents = $dynamicModel->docs;
                    $dynamic_content = $this->renderPartial('//catalog/_item_form', array('model' => $dynamicModel), true, false);
                }
        }


        if ($flag = true) {
            $this->render('add', array('photos' => $photos, 'model' => $model, 'dynamic_content' => $dynamic_content));
        }
    }



//
//
//    protected function sendAlertEmail($model,$view){
//        $documents=$model->documents;
//        $attachments=array();
//        foreach ($documents as $doc){
//            $path=$doc->getRealPath();
//            if(isset($path))
//                $attachments[$path]=$doc->name;
//        }
//        $to=Yii::app()->params['adminAlertEmail'];
//        $subject=Yii::app()->controller->truncate($model->getTitle(),5,35).' ('.Yii::t('app', 'item_add_form').')';
//        return Yii::app()->controller->sendTemplateEmail($to,$subject, $view, array('model'=>$model), $attachments);
//    }


    public function actionCategory()
    {
        $category_id = $_POST['ItemForm']['category_id'];

        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        if (isset($category_id)) {
            $categoryModel = Category::model()->findByPk($category_id);
            if (isset($categoryModel)) {
                $parentCategoryModel = $categoryModel->parent;
                if (isset($parentCategoryModel))
                    $this->renderPartial('//item/_dynamic_form', array('categoryModel' => $categoryModel, 'parentCategoryModel' => $parentCategoryModel), false, true);
            }
        }
    }


    protected function validateTabular($models)
    {
        if (count(CJSON::decode(CActiveForm::validateTabular($models))) == 0)
            return true;
        return false;
    }


    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $folder = 'upload/';// folder for uploaded files
        $folder = trim(Yii::app()->params['uploadfolder'], '/');

        $allowedExtensions = array("jpg");//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $fileSize = filesize($folder . $result['filename']);//GETTING FILE SIZE
        $fileName = $result['filename'];//GETTING FILE NAME

        echo $return;// it's array
    }


    public function actionDelete($id, $class)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                if (isset($class) && isset($id)) {
                    $dynamicModel = CActiveRecord::model($class)->findByPk($id);
                    if (Yii::app()->user->id) {
                        $userModel = User::model()->findByPk(Yii::app()->user->id);
                    }

//                    print_r($dynamicModel->attributes);

                    if (isset($dynamicModel) && isset($userModel)) {
                        if ($dynamicModel->create_username == $userModel->username) {
                            if ($dynamicModel->delete()) {
                                echo "deleted";
                            } else
                                echo "not deleted";
                        } else {
                            throw new CHttpException(403, Yii::t('app', 'You are not authorized to perform this action'));
                        }
                    }
                }
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(array('admin'));
            }
        } else
            throw new CHttpException(400, Yii::t('app', 'Invalid request.'));

    }
}