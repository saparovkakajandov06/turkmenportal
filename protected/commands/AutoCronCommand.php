<?php


class AutoCronCommand extends CConsoleCommand
{

    public $regionsList = array();
    public $autoMakesList = array();
    public $autoModelsList = array();
    public $categoriesList = array();


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
                        $filename = md5(microtime() . 'tmcars') . '.jpg';
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


    public function getCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function downloadImage($url, $filename)
    {
        if (file_exists($filename)) {
            @unlink($filename);
        }
        $fp = fopen($filename, 'w');
        if ($fp) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            $result = parse_url($url);
            curl_setopt($ch, CURLOPT_REFERER, $result['scheme'] . '://' . $result['host']);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0');
            $raw = curl_exec($ch);
            curl_close($ch);
            if ($raw) {
                fwrite($fp, $raw);
//                    echo "TYPE: ".mime_content_type($filename);
            }
            fclose($fp);
            if (!$raw) {
                @unlink($filename);
                return false;
            }
            return true;
        }
        return false;
    }
}