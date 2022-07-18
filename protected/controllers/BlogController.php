<?php

require_once( __DIR__ . '/../predis/autoload.php');
Predis\Autoloader::register();

class BlogController extends Controller
{

    public $layout = '//layouts/column2_admin';


    public function filters()
    {
        return array('rights',);
    }

    //public function allowedActions() { return 'createQuick,create';}


    public function actionView($id)
    {
        $this->layout = '//layouts/blog/column2';
        if (isset ($_GET['ajax']) && $_GET['ajax'] == 'comments_listview') {
            $this->renderPartial('//comments/listview', array('related_relation' => 'blogs', 'related_relation_id' => $id));
        } else {
            $model = $this->loadModel($id);
            $lang_title = 'title_' . Yii::app()->language;
            $boll = true;
            if (Yii::app()->user->id){
                $boll =false;
            } elseif ($model->status == 1) {
                $boll = false;
            }
            if ($model === null || !isset($model->{$lang_title}) || strlen(trim($model->{$lang_title})) < 5 || $boll)
                throw new CHttpException(404, 'Not found');
            $url = $model->getUrl(true);

//            Yii::app()->clientScript->registerLinkTag('canonical1', null, Yii::app()->getBaseUrl(true).Yii::app()->request->getOriginalUrl());
            Yii::app()->clientScript->registerLinkTag('canonical', null, $url);
//            if(strpos(Yii::app()->request->url, 'index.php')!==false || strcmp(Yii::app()->request->url,$url)!=0)
            if (strpos(Yii::app()->request->url, 'index.php') !== false)
                $this->redirect($url, true, 301);

//            if ( Yii::app()->getBaseUrl(true).Yii::app()->request->getOriginalUrl() != $url)
//                $this->redirect($url, true, 301);

            $now = new DateTime();
            $now->modify('-3 day');
            $date_added = new DateTime($model->date_added);

            $client = new Predis\Client();
//
            if (!$client->exists('view_count_blog_' . $id))
                $client->set('view_count_blog_' . $id, 0);

            if ($date_added > $now) {

                $client->incrby('view_count_blog_' . $id, rand(1, 3));
//                $model->saveCounters(array('visited_count' => rand(1, 3)));
            } else {
                $client->incr('view_count_blog_' . $id);
//                $model->saveCounters(array('visited_count' => 1));
            }

            $this->render('view', array(
                'model' => $model,
            ));
        }
    }


    public function actionLike($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);
            if ($model->saveCounters(array('like_count' => 1))) {
                echo CJSON::encode(array(
                    'status' => 'success',
                    'message' => Yii::t('app', 'comment_like_success'),
                ));
            }
        } else
            echo CJSON::encode(array(
                'status' => 'error',
                'message' => Yii::t('app', 'comment_like_error'),
            ));
    }


    public function actionDislike($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = $this->loadModel($id);
            if ($model->saveCounters(array('dislike_count' => 1))) {
                echo CJSON::encode(array(
                    'status' => 'success',
                    'message' => Yii::t('app', 'dislike_success'),
                ));
            }
        } else {
            echo CJSON::encode(array(
                'status' => 'error',
                'message' => Yii::t('app', 'dislike_error'),
            ));
        }
    }


    public function actionCreate()
    {
        $photos = new XUploadForm;
        $model = new Blog;

        if (isset($_POST['Blog'])) {

            if ($_POST['Blog']['date_added'] > date('Y-m-d H:i')){
                Yii::app()->user->setFlash('error', "Date cannot be in the future");

                return $this->render('create', array(
                    'model' => $model,
                    'photos' => $photos,
                ));
            }

            $state = Yii::app()->user->getState('state_blog');;

            if (!isset($state)){
                Yii::app()->user->setFlash('error', "Images cannot be empty!");

                $this->redirect(Yii::app()->request->UrlReferrer, array(
                    'model'     => $model,
                    'photos'    => $photos,
                ));
            }

            $model->setAttributes($_POST['Blog']);
            $model->tagstm->setTags($_POST['tagstm']);
            $model->tagsru->setTags($_POST['tagsru']);

            try {
                $committed = false;
                $transaction = Yii::app()->db->beginTransaction();
                $model->documents = Documents::model()->saveDocuments('blogs', $model->state_name, true);
                if ($model->saveWithRelated(array('regions', 'documents' => array('append' => true)))) {
                    $transaction->commit();
                    $committed = true;
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Blog doredilmedi");
                $model->addError('id', $e->getMessage());
            }

            if ($committed == true) {
                $this->sendAlertEmail($model, 'blog/view', 'Blog doredildi');
                EUserFlash::setSuccessMessage('Doredildi');
                if (isset($_POST['save_create'])) {
                    Yii::app()->user->setFlash('success', "Blog created successeful!");
                    $this->redirect(array('//blog/create'));
                } else {
                    $this->redirect(array('admin'));
                }
            }
        } else {
            $model->reloadTempList(!isset($_SERVER['HTTP_X_REQUESTED_WITH']));
        }

        $this->render('create', array(
            'model' => $model,
            'photos' => $photos,
        ));
    }


    public function actionUpdate($id)
    {
        $photos = new XUploadForm;
        $model = $this->loadModel($id);

        if (isset($_POST['Blog'])) {
            if ($_POST['Blog']['date_added'] > date('Y-m-d H:i')){
                Yii::app()->user->setFlash('error', "Date cannot be in the future");

                return $this->render('update', array(
                    'model' => $model,
                    'photos' => $photos,
                ));
            }

            $state = Yii::app()->user->getState('state_blog');
//            var_dump(empty($state)); die;
            if (empty($state)){
                Yii::app()->user->setFlash('error', "Image cannot be empty");

                return $this->render('update', array(
                    'model' => $model,
                    'photos' => $photos,
                ));
            }

            $model->setAttributes($_POST['Blog']);
            if (isset($_POST['Blog']['regions']))
                $model->regions = $_POST['Blog']['regions'];

            $committed = false;
            $transaction = Yii::app()->db->beginTransaction();
            $model->tagstm->setTags($_POST['tagstm']);
            $model->tagsru->setTags($_POST['tagsru']);
            $model->documents = Documents::model()->saveDocuments('blogs', $model->state_name, true);
            try {
                if ($model->saveWithRelated(array('regions', 'documents' => array('append' => false)))) {
                    $transaction->commit();
                    $committed = true;
                } else {
                    $model->documents = Documents::model()->saveDocuments('blogs', 'state_blogs');
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Blog doredilmedi");
                $model->addError('id', $e->getMessage());
            }
            if ($committed == true) {
                $this->sendAlertEmail($model, 'blog/view', 'Blog uytgedildi');
                EUserFlash::setSuccessMessage('Blog doredildi');
                Yii::app()->user->setFlash('success', "Blog updated successeful!");
                $this->redirect(array('admin'));
            }
        } else {
            $model->reloadTempList(!isset($_SERVER['HTTP_X_REQUESTED_WITH']));
            $model->reloadDocumentsList(true);
        }

        $this->render('update', array(
            'model' => $model,
            'photos' => $photos,
        ));
    }


    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $blogModel = $this->loadModel($id);
                $documents = $blogModel->documents;
                if (isset($documents)) {
                    foreach ($documents as $doc) {
                        $doc->fullDelete('tbl_blog_to_documents');
                    }
                }
                $blogModel->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(array('admin'));
            }
        } else
            throw new CHttpException(400,
                Yii::t('app', 'Invalid request.'));
    }


    public function actionAdmin()
    {

        $model = new Blog('search');
        $model->unsetAttributes();

        if (isset($_GET['Blog'])) {
            $model->setAttributes($_GET['Blog']);
        }

        $view = 'admin';
        if (Yii::app()->user->getIsSuperuser()){
            $view = 'superadmin';
        }


        $this->render($view, array(
            'model' => $model,
        ));
    }


    public function actionToggle($id, $attribute, $model)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id, $model);
            //loadModel($id, $model) from giix
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            if ($model->save()) {
                $title = 'Blog uytgedildi uytgan field: ' . $model->getAttributeLabel($attribute) . ' - ' . $model->$attribute;
                $this->sendAlertEmail($model, 'blog/view', $title);
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }


    public function loadModel($id)
    {
        $model = Blog::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }


    public function actionIndex($path = null, $category_id = null, $region_id = null)
    {
        $this->layout = '//layouts/blog/column2';
        if (isset($category_id)) {
            $modelCategory = Category::model()->findByPk($category_id);
            if (Yii::app()->request->requestUri != $modelCategory->url)
                $this->redirect($modelCategory->url, true, 301);
        }

        if (!isset($_GET['Blog_sort']))
            $_GET['Blog_sort'] = 'date_added.desc';

        $modelBlog = new Blog('search');
        $modelCategory = Category::model()->findByPath($path);

        if (isset($modelCategory))
            $this->setMetaFromCategory($modelCategory);
        else {
            $path_tr = Category::model()->translatePath($path);
            $modelCategory = Category::model()->findByPath($path_tr);
            if (isset($modelCategory))
                $this->redirect($modelCategory->url, true);
            throw new CHttpException(404, 'Not found');
        }

        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0)
            $modelBlog->category_id = $modelCategory->id;
        elseif (isset ($modelCategory) && ($modelCategory->parent_id == null || $modelCategory->parent_id == 0))
            $modelBlog->parent_category_id = $modelCategory->id;


        $this->render('index', array(
            'modelCategory' => $modelCategory,
            'modelBlog' => $modelBlog,
        ));
    }


    public function actionCalendar()
    {
        $this->layout = '//layouts/blog/column2';

        $modelBlog = new Blog('search');
        if (isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])) {
            $modelBlog->pub_date = $_GET['year'] . "-" . $_GET['month'] . "-" . $_GET['day'];
            $modelBlog->pub_date_formatted = $_GET['day'] . "-" . $_GET['month'] . "-" . $_GET['year'];
        }


        $modelCategory = Category::model()->no_parent()->findByAttributes(array('code' => 'news'));
        $this->setMetaFromCategory($modelCategory);

        $this->render('index', array(
            'modelCategory' => $modelCategory,
            'modelBlog' => $modelBlog,
        ));
    }


}