<?php

require_once( __DIR__ . '/../predis/autoload.php');
Predis\Autoloader::register();

class AutoController extends Controller {

    public $layout = '//layouts/column2_admin';
    public $regionsList = array();
    public $autoMakesList = array();
    public $autoModelsList = array();
    public $categoriesList = array();

    public function filters() {
        return array('rights - cronPurge,cronTmcars,cron,nesipetsinSync,tmcarsTest');
    }


    public function actionCron() {
        echo "</br>CRON AUTO status disable BEGIN";
        $criteria = new CDbCriteria;
//        $criteria->addCondition('DATE_ADD(date_end, INTERVAL -3 DAY)  < NOW()');
        $criteria->addCondition('date_end < NOW()');
        $rownum = Auto::model()->updateAll(array('status' => 0), $criteria);
        echo "</br>Total updated " . $rownum . ' cloumns';
        echo "</br>CRON AUTO status disable END";


        echo "</br>CRON OLDER AUTO DELETE BEGIN";
        $criteria = new CDbCriteria;
        $criteria->limit = 100;
//        $criteria->addCondition('date_end < DATE_ADD(NOW(), INTERVAL -2 MONTH) and status=0');
        $criteria->addCondition('status=0 OR phone is null');
//        $criteria->addCondition('id>=20380');
        $autos = Auto::model()->findAll($criteria);

        $rownum = 0;
        foreach ($autos as $autoModel) {
//            $autoModel->deleteDocumentsOnly();
            $autoModel->delete();
            $rownum++;
        }

        echo "</br>Total deleted " . $rownum . ' cloumns';
        echo "</br>CRON AUTO END";
    }


    public function actionCronPurge() {
        echo "</br>CRON PURGE DUBLICATE AUTOS BEGIN";
        $criteria = new CDbCriteria;
        $criteria->limit = 200;
//        $criteria->addCondition('date_end < DATE_ADD(NOW(), INTERVAL -2 MONTH) and status=0');
//        $criteria->addCondition('status=0 OR phone is null');
        $criteria->group = 'tmcars_id';
        $criteria->having = 'count(tmcars_id)>1';
//        $criteria->order = 'id desc';
        $autos = Auto::model()->findAll($criteria);
        $rownum = 0;
        foreach ($autos as $autoModel) {
            $autoModel->delete();
            $rownum++;
        }


        $criteria = new CDbCriteria;
        $criteria->limit = 200;
        $criteria->addCondition('date_added > DATE_ADD(NOW(), INTERVAL -1 DAY) and status=1 and tmcars_id is null and phone is NOT null');
        $criteria->group = 'phone';
        $criteria->having = 'count(phone)>1';
        $criteria->order = 'id desc';
        $autos = Auto::model()->findAll($criteria);
        $rownum = 0;
        foreach ($autos as $autoModel) {
            $docs = $autoModel->documents;
            if (count($docs) == 0) {
                $autoModel->delete();
                $rownum++;
            }
        }

        echo "</br>Total purged " . $rownum . ' cloumns';
        echo "</br>CRON PURGE DUBLICATE AUTOS END";
    }


    //public function allowedActions() { return 'createQuick,create';}


    public function actionView($id) {
        $this->layout = '//layouts/column2';
        if (isset ($_GET['ajax']) && $_GET['ajax'] == 'comments_listview') {
            $this->renderPartial('//comments/listview', array('related_relation' => 'autos', 'related_relation_id' => $id));
        } else {
            $model = $this->loadModel($id);
            if ($model === null || $model->status != 1)
                throw new CHttpException(404, 'auto not found');
            $url = $model->getUrl();
            Yii::app()->clientScript->registerLinkTag('canonical', null, $url);
            if (strpos(Yii::app()->request->url, 'index.php') !== false)
                $this->redirect($url, true, 301);

            $this->meta_description = $model->description;
            $this->meta_keyword = $model->category->getFullTitle(false, ',');
            $title = $model->getTitle();
            if (isset($title) && strlen(trim($title)) > 0)
                $this->pageTitle = $title;
            else
                $this->pageTitle = $model->description;

            if (isset($model->region_id) && strlen(trim($model->region_id)) > 0) {
                $this->pageTitle .= " " . $model->getRegionName();
            }

            $this->pageTitle = $this->pageTitle . ' | ' . Yii::app()->params['title'];

            $client = new Predis\Client();
//
            if (!$client->exists('view_count_auto_' . $id))
                $client->set('view_count_auto_' . $id, 0);

            $client->incr('view_count_auto_' . $id);
//            $model->saveCounters(array('views' => 1));

            $this->render('view', array(
                'model' => $model,
            ));
        }
    }

    public function actionCreate() {
        $photos = new XUploadForm;
        $model = new Auto;
        $descriptions = array();
        $languages = Language::model()->findAllByAttributes(array('status' => 1));
        foreach ($languages as $language) {
            $descriptionModel = new AutoDescription();
            $descriptionModel->language_id = $language->id;
            $descriptions[$language->id] = $descriptionModel;
        }


        if (isset($_POST['Auto']) && isset($_POST['AutoDescription'])) {
            $model->setAttributes($_POST['Auto']);
            $model->descriptions = $_POST['AutoDescription'];
            if (isset($_POST['Auto']['categories']))
                $model->categories = $_POST['Auto']['categories'];
            if (isset($_POST['Auto']['regions']))
                $model->regions = $_POST['Auto']['regions'];

            try {
                $committed = false;
                $transaction = Yii::app()->db->beginTransaction();
                $model->documents = Documents::model()->saveDocuments('autos', 'state_auto', true);
                if ($model->saveWithRelated(array('descriptions', 'categories', 'regions', 'documents'))) {
                    $transaction->commit();
                    $committed = true;
                } else
                    $descriptions = $model->descriptions;
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Auto doredilmedi");
                $model->addError('id', $e->getMessage());
            }

            if ($committed == true) {
                EUserFlash::setSuccessMessage('Doredildi');
                if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'descriptions' => $descriptions,
            'photos' => $photos,
        ));
    }


    public function actionUpdate($id) {
        $photos = new XUploadForm;
        $model = $this->loadModel($id);
        $descriptions = array();
        $languages = Language::model()->findAllByAttributes(array('status' => 1));
        foreach ($languages as $language) {
            $descriptionModel = AutoDescription::model()->findByAttributes(array('language_id' => $language->id, 'autos_id' => $model->id));
            if (isset($descriptionModel))
                $descriptions[$language->id] = $descriptionModel;
            else {
                $descriptionModel = new AutoDescription();
                $descriptionModel->language_id = $language->id;
                $descriptions[$language->id] = $descriptionModel;
            }
        }


        if (isset($_POST['Auto']) && isset($_POST['AutoDescription'])) {
            $model->setAttributes($_POST['Auto']);
            $model->descriptions = $_POST['AutoDescription'];
            if (isset($_POST['Auto']['categories']))
                $model->categories = $_POST['Auto']['categories'];
            if (isset($_POST['Auto']['regions']))
                $model->regions = $_POST['Auto']['regions'];

            $committed = false;
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $model->documents = Documents::model()->saveDocuments('autos', 'state_auto', true);
                if ($model->saveWithRelated(array('descriptions', 'categories', 'regions', 'documents' => array('append' => true)))) {
                    $transaction->commit();
                    $committed = true;
                } else
                    $descriptions = $model->descriptions;
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::app()->user->setFlash('error', "Auto doredilmedi");
                $model->addError('id', $e->getMessage());
            }
            if ($committed == true) {
                EUserFlash::setSuccessMessage('Auto doredildi');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'descriptions' => $descriptions,
            'photos' => $photos,
        ));
    }


    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            try {
                $model = $this->loadModel($id);
                $model->delete();
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


    public function actionAdmin() {
        $model = new Auto('search');
        $model->unsetAttributes();

        if (isset($_GET['Auto']))
            $model->setAttributes($_GET['Auto']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionToggle($id, $attribute, $model) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id, $model);
            //loadModel($id, $model) from giix
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            $model->save(true, array($attribute));

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function loadModel($id) {
        $model = Auto::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }


    public function actionIndex($path = null, $category_id = null) {
        $this->layout = '//layouts/column2';
        if (isset($category_id)) {
            $modelCategory = Category::model()->findByPk($category_id);
            if (Yii::app()->request->requestUri != $modelCategory->url)
                $this->redirect($modelCategory->url, true, 301);
        }

        $modelAuto = new Auto('search');
        $modelAuto->unsetAttributes();
        if (isset($_GET['Auto'])) {
            $modelAuto->setAttributes($_GET['Auto']);
        }

//        if(isset($path) && strlen(trim($path))>0)
//            $modelCategory = Category::model()->findByPath($path);
//        elseif(isset($category_id))
//            $modelCategory = Category::model()->findByPk($category_id);
//        else
//            $modelCategory = Category::model()->no_parent()->findByAttributes(array('code'=>'auto'));

        if (isset($path) && strlen(trim($path)) > 0)
            $modelCategory = Category::model()->findByPath($path);
        else {
            $modelCategory = Category::model()->no_parent()->findByAttributes(array('code' => 'auto'));
            if (Yii::app()->request->requestUri != $modelCategory->url)
                $this->redirect($modelCategory->url, true, 301);
        }


        if (isset($modelCategory)) {
            $this->setMetaFromCategory($modelCategory);
        } else {
            $path_tr = Category::model()->translatePath($path);
            $modelCategory = Category::model()->findByPath($path_tr);
            if (isset($modelCategory))
                $this->redirect($modelCategory->url, true);
            throw new CHttpException(404, 'Not found');
        }

        Yii::app()->clientScript->registerLinkTag('canonical', null, $modelCategory->getUrl(true));

        if (isset($modelCategory) && isset($modelCategory->parent_id) && $modelCategory->parent_id > 0)
            $modelAuto->category_id = $modelCategory->id;

        $this->render('index', array(
            'modelCategory' => $modelCategory,
            'modelAuto' => $modelAuto,
        ));
    }


    public function actionCronTmcars() {
        $regions = RegionsDescription::model()->findAllByAttributes(array('language_id' => 1));
        $this->regionsList = CHtml::listData($regions, 'region_id', 'region_name');

        $autoMakes = AutoMakes::model()->findAll();
        $this->autoMakesList = CHtml::listData($autoMakes, 'name', 'id');

        $autoModels = AutoModels::model()->findAll();
        $this->autoModelsList = CHtml::listData($autoModels, 'name', 'id', 'make_id');

        $this->categoriesList = Category::model()->getListByParentCode('auto');


        $criteria = new CDbCriteria();
        $criteria->order = 'tmcars_date DESC';
        $criteria->addCondition('tmcars_id is not null');
        $latestTmcarsModel = Auto::model()->find($criteria);

        if (isset($latestTmcarsModel)) {
            $latestDate = $latestTmcarsModel->tmcars_date;
            $latestDate = DateTime::createFromFormat('Y-m-d H:i:s', $latestDate);
//            $latestDate =date("Y-m-d H:i:s", strtotime($latestDate));
//            $latestDate=new DateTime($latestDate);
        } elseif (!isset($latestDate)) {
            $latestDate = '2017-06-13T05:59:18Z';
            $latestDate = new DateTime($latestDate);
        }


        $offset = 0;
        echo "</br> latestDate: " . $latestDate->format('Y-m-d H:i:s');


        $cars_list = array();
        $continue = true;
        while ($continue == true) {
            if (!isset($offset))
                break;

            if ((int)$offset >= 800) {
                break;
            }

            echo "</br> offset: " . $offset;
            $listUrl = 'http://tapgo.biz:8080/tmcars/carProduct/getCars?max=100&sort=publishedDate&order=desc&offset=' . $offset;
            $result = $this->getCurl($listUrl);
            $result_array = json_decode($result, true);

            if (isset($result_array['cars'])) {
                $cars = $result_array['cars'];
                $while_break = false;
                foreach ($cars as $car) {
                    if (isset($car['publishedDate'])) {
                        $pubDate = new DateTime($car['publishedDate']);
                        $pubDate->setTimezone(new DateTimeZone('Asia/Ashgabat'));
//                        echo "</br>pubDate: " . $pubDate->format('y-m-d H:i:s');
//                        echo "</br>latestDate: " . $latestDate->format('y-m-d H:i:s');
//                        echo "</br>ID: " . $car['id'];
                        if ($pubDate->format('U') > $latestDate->format('U')) {
//                            $autoModelTemp = Auto::model()->findByAttributes(array('tmcars_id' => $car['id']));
//                            if (!isset($autoModelTemp))
                            $cars_list[] = $car;
                        } else {
                            $while_break = true;
                            break;
                        }
                    }
                }

                if ($while_break == false) {
                    $offset += 100;
                    $continue = true;
                } else {
                    $continue = false;
                    break;
                }
            } else {
                $continue = false;
                break;
            }
        }


        $cars_list = array_reverse($cars_list);
//        echo "<pre>";
//        print_r($cars_list);
//        echo "</pre>";
//        exit(1);

        $saved = 0;
        foreach ($cars_list as $key => $car) {
            if ($saved > 15)
                break;
            if ($this->saveTmCarsToTpModel($car['id'])) {
                $saved++;
                echo "SAVED id: " . $car['id'];
            } else {
                echo "</br>FAILED id: " . $car['id'];
            }
        }

        $this->actionCronPurge();
    }


    public function actionTmcarsTest() {
        if (isset($_GET['id'])) {

            $regions = RegionsDescription::model()->findAllByAttributes(array('language_id' => 1));
            $this->regionsList = CHtml::listData($regions, 'region_id', 'region_name');

            $autoMakes = AutoMakes::model()->findAll();
            $this->autoMakesList = CHtml::listData($autoMakes, 'name', 'id');

            $autoModels = AutoModels::model()->findAll();
            $this->autoModelsList = CHtml::listData($autoModels, 'name', 'id', 'make_id');

            $this->categoriesList = Category::model()->getListByParentCode('auto');

            $this->saveTmCarsToTpModel($_GET['id']);
        }
    }


    protected function saveTmCarsToTpModel($tmcars_id) {
        $time_start = microtime(true);
        echo "<pre>";
        print_r($time_start);
        echo "</pre>";
        echo "</br>saveTmCarsToTpModel";

        $autoModelTemp = Auto::model()->findByAttributes(array('tmcars_id' => $tmcars_id));
        if (isset($autoModelTemp)) {
            echo "</br>Already have:";
            return false;
        }

        echo "</br>GEcmeli:)) ";
//        return;

        $listUrl = 'http://tapgo.biz:8080/tmcars/carProduct/get?id=' . $tmcars_id . '&devId=8f79f1610dfc7594';
//        $listUrl = 'http://tapgo.biz:8080/tmcars/carProduct/get?id=' . $tmcars_id;
        $result = $this->getCurl($listUrl);
        $car = json_decode($result, true);
        $committed = false;

        $time_start = microtime(true);
        echo "After getDetail Url:<pre>";
        print_r($time_start);
        print_r($car);
        echo "</pre>";

        $colorsList = Auto::getColorOptions();
        $bodyTypeList = Auto::getBodyTypeOptions();
        $transmissionList = Auto::getTransmissionOptions();

        echo "</br>before phone check";
        echo "<pre>";
        print_r($car);
        echo "</pre>";
        if (isset($car) && isset($car['sellerPhoneNumber'])) {
            echo "</br>Phone number check passed";
            try {
                $autoModel = new Auto();
                $autoModel->title_calc = false;
                $autoModel->phone = $car['sellerPhoneNumber'];

                $region = array_search($car['cityName'], $this->regionsList);
                if (isset($region) && $region)
                    $autoModel->region_id = $region;
                else {
                    $regionDescriptionModelRu = new RegionsDescription();
                    $regionDescriptionModelRu->region_name = $car['cityNameRu'];
                    $regionDescriptionModelRu->language_id = 2; //default russian language

                    $regionDescriptionModelTm = new RegionsDescription();
                    $regionDescriptionModelTm->region_name = $car['cityName'];
                    $regionDescriptionModelTm->language_id = 1; //turkmen language

                    $regionModel = new Regions();
                    $regionModel->descriptions = array($regionDescriptionModelRu, $regionDescriptionModelTm);
                    $regionModel->status = 1;
                    if ($regionModel->saveWithRelated(array('descriptions'))) {
                        $autoModel->region_id = $regionModel->id;
                        $regions = RegionsDescription::model()->findAllByAttributes(array('language_id' => 1));
                        $this->regionsList = CHtml::listData($regions, 'region_id', 'region_name');
                    }

                }
                $time_start = microtime(true);
                echo "Region pass:<pre>";
                print_r($time_start);
                echo "</pre>";

                if (isset($this->autoMakesList[$car['brandName']])) {
                    $autoModel->make_id = $this->autoMakesList[$car['brandName']];

                    if (isset($this->autoModelsList[$autoModel->make_id][$car['modelName']])) {
                        $autoModel->model_id = $this->autoModelsList[$autoModel->make_id][$car['modelName']];
                    } else {
                        $model = new AutoModels();
                        $model->make_id = $autoModel->make_id;
                        $model->name = $car['modelName'];
                        if ($model->save()) {
                            $autoModel->model_id = $model->id;
                        }
                    }
                } else {
                    $make = new AutoMakes();
                    $make->name = $car['brandName'];
                    if ($make->save()) {
                        $model = new AutoModels();
                        $model->make_id = $make->id;
                        $model->name = $car['modelName'];
                        if ($model->save()) {
                            $autoModel->model_id = $model->id;
                        }
                    }
                }


                if (!isset($autoModel->model_id)) {
                    echo "<br> MODEL_IS is null";
                    return false;
                }
                $time_start = microtime(true);
                echo "Brand model pass:<pre>";
                print_r($time_start);
                echo "</pre>";


                $autoModel->year = $car['year'];
                $autoModel->description = $car['description'];
                $autoModel->engine_capacity = $car['engine'];
                $autoModel->isCredit = $car['isCredit'];

                $categoryName = 'Продам';
                if ($car['isSwap']) {
                    $categoryName = 'Обмен';
                }

                $category = array_search($categoryName, $this->categoriesList);
                if (isset($category) && $category)
                    $autoModel->category_id = $category;
                else {
                    echo "<br>No Category in list";
                    return false;
                }

                $color = array_search($car['colorRu'], $colorsList);
                if (isset($color) && $color)
                    $autoModel->color = $color;

                $autoModel->trip = $car['mileage'];
                $autoModel->odometer_unit = Auto::ODOMETER_KM;
                $autoModel->price = $car['price'];
                $autoModel->currency = Auto::CURRENCY_MANAT;
                $autoModel->date_added = $car['publishedDate'];

                $ownBodyType = 'BODYTYPE_' . $car['bodyType'];
                $reflection = new ReflectionClass('Auto');
                if ($reflection->hasConstant($ownBodyType)) {
                    if (isset($bodyTypeList[constant("Auto::$ownBodyType")]))
                        $autoModel->bodytype = constant("Auto::$ownBodyType");
                }

                $ownTransmission = trim('TRANSMISSION_' . $car['transmissionType']);
                if (isset($car['transmissionType']) && isset($transmissionList[constant("Auto::$ownTransmission")]))
                    $autoModel->transmission = constant("Auto::$ownTransmission");
                $autoModel->lineid = $car['sellerLineId'];
                $autoModel->tmcars_id = $tmcars_id;

                $pubDate = new DateTime($car['publishedDate']);
                $pubDate->setTimezone(new DateTimeZone('Asia/Ashgabat'));
                $autoModel->tmcars_date = $pubDate->format('Y-m-d H:i:s');

                $autoModel->create_username = 'tmcars';
                $autoModel->edited_username = 'tmcars';
                $autoModel->auto_condition = Auto::AUTO_CONDITION_OLD;
                $autoModel->status = Auto::STATUS_ENABLED;
                $autoModel->date_end = ItemForm::convertDateEnd(ItemForm::END_DATE_14);

                $newsPhotos = array();
                $state_name = 'state_tmcars';

                $time_start = microtime(true);
                echo "Before Images:<pre>";
                print_r($time_start);
                echo "</pre>";
                if (isset($car['productImages'])) {
                    $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
                    $path = realpath($uploadfolder . "/tmp/tmcars/") . "/";
                    foreach ($car['productImages'] as $image) {
                        $filename = md5(Yii::app()->user->id . microtime() . 'tmcars') . '.jpg';
                        $file_path = $path . $filename;
                        if ($this->downloadImage($image, $file_path)) {
                            $newsPhotos[] = array(
                                "path" => $file_path,
                                "filename" => $filename,
                                'name' => $autoModel->getTitle(),
                            );
                        }
                    }
                }
                $time_start = microtime(true);
                echo "After Images:<pre>";
                print_r($time_start);
                echo "</pre>";

                Yii::app()->user->setState($state_name, $newsPhotos);
                $autoModel->documents = Documents::model()->saveDocuments('autos', $state_name, true, 'images', true);
                if ($autoModel->saveWithRelated(array('documents'))) {
//                if ($autoModel->saveWithRelated(array('documents' => array('append' => true)))) {
                    $committed = true;
                } else {
                    echo "<pre>";
                    print_r($autoModel->getErrors());
                    echo "</pre>";
                }
            } catch (Exception $e) {
                $autoModel->addError('id', $e->getMessage());
                echo "<pre>";
                echo "Exception occured";
                print_r($e->getMessage());
                print_r($autoModel->getErrors());
                throw new CHttpException(500, $e->getMessage());
                echo "</pre>";
            }

            $time_start = microtime(true);
            echo "Finalization:<pre>";
            print_r($time_start);
            echo "</pre>";
            if ($committed == true) {
                echo "</br>ID: " . $autoModel->id;
                return true;
            }

            echo "<br>general failed";
            return false;
        }
    }


    public function actionNesipetsinSync() {
        header('Content-type: application/json');
        if (isset($_GET['fromId'])) {
            $fromId = $_GET['fromId'];
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 50;

            $autoModel = new Auto();
            $dataProvider = $autoModel->searchForNesipetsin($limit, $fromId);
            if (isset($dataProvider)) {
                echo CJSON::encode($dataProvider->getData());
            }
        } else {
            echo CJSON::encode(array());
        }

    }


}