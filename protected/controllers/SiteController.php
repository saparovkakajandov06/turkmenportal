<?php

class SiteController extends Controller
{

    public $layout = '//layouts/column2';

    public function filters()
    {
        return array('rights - test');
    }

//
//        public function filters()
//        {
//            return array(
//                'accessControl',
//            );
//        }
//
//        public function accessRules()
//        {
//            return array(
//                array('allow',  // allow all users to perform 'index' and 'view' actions
//                        'actions'=>array('index','search','upload','ajaxLogin','ajaxLogout','fileupload'),
//                        'users' => array('*'),
//                ),
//                array('allow',  // allow all users to perform 'index' and 'view' actions
//                        'actions'=>array('admin'),
//                        'roles' => array('Site.Admin'),
//                ),
//                array('allow',  // allow all users to perform 'index' and 'view' actions
//                        'actions'=>array('login','logout','error','changelanguage'),
//                        'users' => array('*'),
//                ),
//
//                array('deny',  // deny all users
//                        'users'=>array('*'),
//                ),
//            );
//        }


    public function actionUpload($state_name = null)
    {

        if (!isset ($state_name))
            $state_name = 'temp_document';
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');

        //Here we define the paths where the files will be stored temporarily
        $path = realpath($uploadfolder . "/tmp/") . "/";
        $publicPath = $uploadfolder . "/tmp/";
        $thumbPath = realpath($uploadfolder . "/tmp/thumbs/") . "/";

        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT'])
            && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
        ) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }


        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"])) {
            if ($_GET["_method"] == "delete") {
                if ($_GET["file"][0] !== '.') {
                    $file = $path . $_GET["file"];
                    if (is_file($file)) {
                        unlink($file);
                    }
                    $thumbFile = $thumbPath . $_GET["file"];
                    if (is_file($thumbFile)) {
                        unlink($thumbFile);
                    }
                }
                echo json_encode(true);
            }
        } else {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'file');
            //We check that the file was successfully uploaded
            if ($model->file !== null) {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                //(optional) Generate a random name for our file
                $filename = md5(Yii::app()->user->id . microtime() . $model->name);
                $filename .= "." . $model->file->getExtensionName();
                if ($model->validate()) {
                    //Move our file to our temporary dir
//                            chmod( $path, 0777 );
                    $model->file->saveAs($path . $filename);
                    chmod($path . $filename, 0777);
                    chmod($thumbPath, 0777);

//                            $image = new Image($path.$filename);
//                            $image->resize(180,180,'w');
//                            $image->save($thumbPath.$filename);
//
                    $type = explode('/', $model->file->type);
                    if ($type[0] == 'image') {
                        $thumb = Yii::app()->phpThumb->create($path . $filename);
                        $thumb->resize(100, 75, 'h');
                        $thumb->save($thumbPath . $filename);
                    }

                    //Now we need to save this path to the user's session
                    if (Yii::app()->user->hasState($state_name)) {
                        $newsPhotos = Yii::app()->user->getState($state_name);
                    } else {
                        $newsPhotos = array();
                    }

                    $newsPhotos[] = array(
                        "path" => $path . $filename,
                        //the same file or a thumb version that you generated
                        "thumb" => $thumbPath . $filename,
                        "filename" => $filename,
                        'size' => $model->size,
                        'mime' => $model->mime_type,
                        'name' => $model->name,
                        "thumbnail_url" => Yii::app()->baseUrl . '/' . $publicPath . "thumbs/$filename",
                        "delete_url" => $this->createUrl("upload", array(
                            "_method" => "delete",
                            "file" => $filename,
                        )),
                        "edit_url" => $this->createUrl("//documents/editDialog", array(
                            "_method" => "edit",
                            "file" => $filename,
                            "state_name" => $state_name
                        )),
                    );
                    Yii::app()->user->setState($state_name, $newsPhotos);


                    //Now we need to tell our widget that the upload was succesfull
                    //We do so, using the json structure defined in
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                        "name" => $filename,
                        "type" => $model->mime_type,
                        "size" => $model->size,
                        "url" => $publicPath . $filename,
                        "thumbnail_url" => Yii::app()->baseUrl . '/' . $publicPath . "thumbs/$filename",
                        "edit_url" => $this->createUrl("//documents/editDialog", array(
                            "_method" => "edit",
                            "file" => $filename,
                            "state_name" => $state_name
                        )),
                        "delete_url" => $this->createUrl("upload", array(
                            "_method" => "delete",
                            "file" => $filename
                        )),
                        "delete_type" => "POST"
                    )));
                } else {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array("error" => $model->getErrors('file'),
                        )));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()),
                        CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }


    public function actionFileupload($state_name = null)
    {

        if (!isset ($state_name))
            $state_name = 'temp_document';
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');

        //Here we define the paths where the files will be stored temporarily
        $path = realpath($uploadfolder . "/tmp/") . "/";
        $publicPath = $uploadfolder . "/tmp/";
        $thumbPath = realpath($uploadfolder . "/tmp/thumbs/") . "/";
        $formatIconsPath = realpath($uploadfolder . "/format_icons/") . "/";
        $formatIconsUrl = $uploadfolder . "/format_icons/";
        $thumbFileIconName = 'fileupload_icon.png';


        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT'])
            && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
        ) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"])) {
            if ($_GET["_method"] == "delete") {
                if ($_GET["file"][0] !== '.') {
                    $file = $path . $_GET["file"];
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                echo json_encode(true);
            }
        } else {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'file');
            //We check that the file was successfully uploaded
            if ($model->file !== null) {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                //(optional) Generate a random name for our file
                $filename = md5(Yii::app()->user->id . microtime() . $model->name);
                $filename .= "." . $model->file->getExtensionName();
                $extension_name = $model->file->getExtensionName() . '.jpg';

                if (file_exists($formatIconsPath . $extension_name)) {
                    if (copy($formatIconsPath . $extension_name, $thumbPath . $extension_name))
                        $thumbFileIconName = $extension_name;
                }

                if ($model->validate()) {
                    //Move our file to our temporary dir
//                            chmod( $path, 0777 );
                    $model->file->saveAs($path . $filename);
                    chmod($path . $filename, 0777);
                    chmod($thumbPath, 0777);

                    //Now we need to save this path to the user's session
                    if (Yii::app()->user->hasState($state_name)) {
                        $newsPhotos = Yii::app()->user->getState($state_name);
                    } else {
                        $newsPhotos = array();
                    }

                    $newsPhotos[] = array(
                        "path" => $path . $filename,
                        //the same file or a thumb version that you generated
                        "thumb" => $thumbPath . $thumbFileIconName,
                        "filename" => $filename,
                        'size' => $model->size,
                        'mime' => $model->mime_type,
                        'name' => $model->name,
                    );
                    Yii::app()->user->setState($state_name, $newsPhotos);


                    //Now we need to tell our widget that the upload was succesfull
                    //We do so, using the json structure defined in
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                        "name" => $model->name,
                        "type" => $model->mime_type,
                        "size" => $model->size,
                        "url" => $publicPath . $filename,
                        "thumbnail_url" => Yii::app()->baseUrl . "/" . $formatIconsUrl . $thumbFileIconName,
                        "delete_url" => $this->createUrl("fileupload", array(
                            "_method" => "delete",
                            "file" => $filename
                        )),
                        "delete_type" => "POST"
                    )));
                } else {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array("error" => $model->getErrors('file'),
                        )));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()),
                        CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }


    public function actionVideoUpload($state_name = null)
    {
//        if (!isset ($state_name))
//            $state_name = 'temp_document';

        $videouploadfolder = trim(Yii::app()->params['videouploadfolder'], '/');
        //Here we define the paths where the files will be stored temporarily
        $temp_path = $videouploadfolder . "/tmp/";
        if (!file_exists($temp_path)) {
            @mkdir($temp_path, 0777);
        }

        if (!empty($_FILES)) {
            $file = CUploadedFile::getInstanceByName('video');
            $filename = md5(Yii::app()->user->id . microtime() . $_FILES['video']['name']) . '_org';
            $filename .= "." . $file->getExtensionName();

            move_uploaded_file($_FILES['video']['tmp_name'], $temp_path . $filename);
            echo $temp_path . $filename;
        } else {
            echo "FILES is empty";
        }
    }


    public function actionAjaxSearch()
    {
        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        $this->renderPartial('//site/mini_search', array('model' => $model), false, true);
    }


    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }


    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionSearch($type = null)
    {
        $this->layout = '//layouts/column1';

        $searchFormModel = new SearchForm();

        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $search = $_POST['search'];
        $blogDescriptionModel = new BlogDescription('search');
        $blogDescriptionModel->unsetAttributes();
        $blogDescriptionModel->title = $search;
//                $blogDescriptionModel->description=$search;
//                $blogDescriptionModel->text=$search;

        $catalogDescriptionModel = new CatalogDescription('search');
        $catalogDescriptionModel->unsetAttributes();
        $catalogDescriptionModel->title = $search;
//                $catalogDescriptionModel->description=$search;
//                $catalogDescriptionModel->name=$search;


        $this->render('search', array(
            'blogDescriptionModel' => $blogDescriptionModel,
            'catalogDescriptionModel' => $catalogDescriptionModel,
            'searchFormModel' => $searchFormModel,
        ));
    }


    public function actionAdmin()
    {
        $this->layout = '//layouts/column2_admin';

        $model = new Contact('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Contact']))
            $model->attributes = $_GET['Contact'];
        $this->render('//contact/admin', array(
            'model' => $model
        ));
    }


    public function actionIndex()
    {
//        Yii::app()->cache->flush();
        $this->layout = '//layouts/column2_wrapper';
        $this->pageTitle = Yii::t('app', 'site_name');
        $modelBlog = new Blog('search');
        $modelBlog->unsetAttributes();


        $this->render('index', array());
    }


    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $this->pageTitle = Yii::t('app', 'error');
        $this->layout = '//layouts/column1';

        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo "haha :). ";
//                echo $error['message'];
            } else {
                if (Yii::app()->errorHandler->error['code'] == 404) {
                    if (Yii::app()->errorHandler->error['message'] == 'auto not found') {
                        $this->render('error_404_auto', $error);
                    } else
                        $this->render('error_404', $error);
                } else
                    $this->render('error', $error);
            }
        }
    }


    /**
     * Displays the contact page
     */
    public function actionContact()
    {

        $model = Catalog::model()->findByPk('12364');
        $documents = $model->documents;
        $attachments = array();
        foreach ($documents as $doc) {
            $attachments[$doc->getRealPath()] = $doc->name;
        }
//        $to=array('batya224@mail.ru','batya224@gmail.com');
        $toString = 'ipm6ns@glockapps.com; allanb@glockapps.awsapps.com; marispurinsh@aol.com; caseywrighde@aol.de; baileehinesfr@aol.fr; brendarodgersuk@aol.co.uk; ingridmejiasri@aol.com; keelyrichardrk@aol.com; julianachristensen@aol.com; bcc@spamcombat.com; glock.julia@bol.com.br; drteskissl@eclipso.de; exosf@glockeasymail.com; s.exploitation@free.fr; s.client@free.fr; s.webmastering@free.fr; carloscohenm@freenet.de; emailtester493@gmail.com; glockapp.aurelio@gmail.com; lanawallert@gmail.com; maceynicholsonqw@gmail.com; kennethsimonmce@gmail.com; bennybaldwinfte@gmail.com; heidigriffithgd@gmail.com; verifycom79@gmx.com; verifyde79@gmx.de; gd@desktopemail.com; verify79@buyemailsoftware.com; frankiebeckerp@hotmail.com; verify79ssl@laposte.net; amandoteo79@libero.it; glocktest@vendasrd.com.br; b2bdeliver79@mail.com; verifymailru79@mail.ru; verify79ssl@netcourrier.com; nsallan@expertarticles.com; grantglover@openmailbox.org; brendonosbornx@outlook.com; tristonreevestge@outlook.com.br; brittanyrocha@outlook.de; glencabrera@outlook.fr; christopherfranklinhk@outlook.com; kaceybentleyerp@outlook.com; meaghanwittevx@outlook.com; aileenjamesua@outlook.com; verify79@seznam.cz; glock1@sfr.fr; glock2@sfr.fr; glock3@sfr.fr; sa79@justlan.com; amandoteo79@virgilio.it; verify79@web.de; sebastianalvarezv@yahoo.com.br; verifyca79@yahoo.ca; emailtester493@yahoo.com; testiotestiko@yahoo.co.uk; justynbenton@yahoo.com; loganbridgesrk@yahoo.com; rogertoddw@yahoo.com; darianhuffg@yahoo.com; verifyndx79@yandex.ru; verifynewssl@zoho.com; chazb@userflowhq.com; lamb@glockdb.com';
        $to = explode(';', $toString);
        return Yii::app()->controller->sendTemplateEmail($to, 'test', 'catalog/view', array('model' => $model), $attachments);


//        $this->layout='//layouts/column2';
//
//		$model=new Contact();
//        $model->unsetAttributes();
//
//		if(isset($_POST['Contact']))
//		{
//			$model->attributes=$_POST['Contact'];
//			$model->last_name="-";
//			$model->address="-";
//			$model->city="-";
//
//			if($model->save())
//			{
//				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
//				mail(Yii::app()->params['adminEmail'],$model->first_name." - ".$model->phone,$model->comments,$headers);
//				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
//				$this->refresh();
//			}
//		}
//		$this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }


    public function actionChangelanguage()
    {
        $lang = (strtolower($_GET['lang']));
        if (isset ($lang)) {
            Yii::app()->session['lang'] = $lang;
//                $this->redirect(Yii::app()->user->returnUrl);
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    public function actionTest()
    {
        Yii::app()->cache->flush();
        $this->render('test');
    }

}