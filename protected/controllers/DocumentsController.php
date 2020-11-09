<?php

class DocumentsController extends Controller
{
    public $layout = '//layouts/column2_admin';

    public function actionDelete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $related_table_name = isset($_GET['related_table_name']) ? $_GET['related_table_name'] : null;

        if (isset($id)) {
            // we only allow deletion via POST request
            $model = Documents::model()->findByPk($id);
            $model->fullDelete($related_table_name);
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }


    public function actionCrop($id)
    {
//                Yii::import('application.extensions.js.*');
        $model = Documents::model()->findByPk($id);
        if (isset($_GET['classs'])) {
            $model->cache_class = $_GET['classs'];
        } else {
            $model->cache_class = "dsfsd";
        }
        if (isset($model))
            $this->render('//documents/crop', array('model' => $model));
        else
            $this->redirect(Yii::app()->user->returnUrl);

    }


    public function actionRegisterHls($id, $targetfolder)
    {
        $hls = VideoHls::model()->findByAttributes(array('document_id' => $id));
        if (!$hls) {
            $hls = new VideoHls();
        }

        $hls->document_id = $id;
        $hls->playlist_path = $targetfolder;
        try {
            if ($hls->save()) {
                $to = Yii::app()->params['adminAlertEmail'];
                $subject = 'Video Convert finished';
                $message = 'Video Convert finished';
                $this->sendEmail($to, $subject, $message);
                echo "SYNCED WITH SPACE 44";
            } else {
                echo "NOT SYNCED WITH SPACE";
                echo "<pre>";
                print_r($hls->getErrors());
                echo "</pre>";
            }
        } catch (Exception $e) {
            echo 'Error occured could not sync to space';
            print_r($e->getMessage());
        }

    }


    public function actionSyncSpace()
    {
        echo "in actionSyncSpace";
        if (isset($_GET['id']) && isset($_GET['path']) && isset($_GET['width']) && $_GET['height'] && is_file($_GET['path'])) {
            $resolution = VideoResolutions::model()->findByAttributes(array('document_id' => $_GET['id'], 'path' => $_GET['path']));
            if (!$resolution) {
                $resolution = new VideoResolutions();
                $resolution->document_id = $_GET['id'];
                $resolution->path = $_GET['path'];
                $resolution->width = $_GET['width'];
                $resolution->height = $_GET['height'];
                try {
                    if ($resolution->save()) {
                        echo "SYNCED WITH SPACE 44";
                        echo "<pre>";
                        print_r($resolution->attributes);
                        echo "</pre>";
                        $doSpaceService = new DOSpaceService();
                        $doSpaceService->uploadToSpace($_GET['path'], $_GET['path']);
                    } else {
                        echo "NOT SYNCED WITH SPACE";
                        echo "<pre>";
                        print_r($resolution->getErrors());
                        echo "</pre>";
                    }
                } catch (Exception $e) {
                    echo 'Error occured could not sync to space';
                    print_r($e->getMessage());
                }
            } else {
                echo "ALREADY EXISTS";
            }
        } else {
            echo "NOT PROVIDED ALL PARAMS";
        }
    }


    public function actionTest()
    {
        $doSpaceService = new DOSpaceService();
//        $hls_folder = dirname('images/videouploads/videohls/blogs/c107ee7f680e1f28956fe6b098c1da5f/playlist.m3u8');
//        $doSpaceService->deleteMatchingObjects($hls_folder);

        $playlistDirPath = dirname('images/videouploads/videohls/blogs/209c842d7da0bd4114ac5fe21ac261c5/240p_000.ts');
        if (!is_dir($playlistDirPath)) {
            if (mkdir($playlistDirPath))
                chmod($playlistDirPath, 0777);
            else
                return;
        }

        echo "Playlist dir name: " . $playlistDirPath;

        $doSpaceService = new DOSpaceService();
        $result = $doSpaceService->downloadFromDirectory($playlistDirPath, $playlistDirPath);
        echo "<pre>";
        print_r($result);
        echo "</pre>";
//        if (!$doSpaceService->downloadFromDirectory($playlistDirPath))

//
////        $config = [
////            'version' => 'latest',
////            'region' => 'nyc3',
////            'endpoint' => 'https://nyc3.digitaloceanspaces.com',
////            'credentials' => [
////                'key' => 'K4RMSJ3XHGU3W6CFTEBY',
////                'secret' => 'hwMKwnDqYRivuAZpBPpKCJtgO0saAp/+I35F4oGkK48',
////            ]
////        ];
////        $bucket = 'digitaloceanspaces.com';
////        $key = 'images/videouploads/export-x264.mp4';
////        $ffmpeg = Streaming\FFMpeg::create($config);
////        $video = $ffmpeg->fromS3($config, $bucket, $key);
//
//
////
////        $ffmpeg = Streaming\FFMpeg::create();
//////        $video = $ffmpeg->fromS3($config, $bucket, $key);
////        $video = $ffmpeg->open('images/videouploads/test.mp4');
////        $video->HLS()
////            ->X264()
////            ->setTsSubDirectory('ts_files2')
////            ->autoGenerateRepresentations([720, 360])// You can limit the numbers of representatons
////            ->save('images/test.m3u8');
//
////        $model = Documents::model()->findByPk($id);
////        $model->generateVideoResolutions();
////                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
////                if ($flag) {
////                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
////                    $this->renderPartial('//harytlar/harytlar_create_dialog', array('harytModel' => $model), false, true);
////                }
//
////        $this->renderPartial('//documents/crop_dialog', array ('model' => $model), false, true);
    }


    public function actionEditDialog()
    {
        $model = new Documents();
        $videos = new XUploadForm;

        $flag = true;
        if ($_POST['Documents']) {
            $flag = false;
            $return = array();
            $state_name = $_POST['Documents']['state_name'];
            $filename = $_POST['Documents']['name'];
            if (isset($state_name) && isset($filename)) {
                $documents = Yii::app()->user->getState($state_name);
                if (isset($documents) && is_array($documents)) {
                    foreach ($documents as $key => $doc) {
                        if (isset($documents[$key]['is_main']) && isset($_POST['Documents']['is_main']) && $_POST['Documents']['is_main'] == 1)
                            $documents[$key]['is_main'] = 0;

                        if ($doc['filename'] == $filename) {
                            $model->setAttributes($_POST['Documents']);
                            $return = $documents[$key] = array_merge($doc, $_POST['Documents']);
                        }

//                        echo "<pre>";
//                        print_r($_POST);
//                        print_r($model->getAttributes());
//                        echo "</pre>";
                    }
                }
                Yii::app()->user->setState($state_name, $documents);
                echo CJSON::encode($return);
            }
        }
        if ($flag) {

            if (isset($_GET['file']) && isset($_GET['state_name'])) {
                $documents = Yii::app()->user->getState($_GET['state_name']);
                if (isset($documents) && is_array($documents)) {
                    foreach ($documents as $doc) {
                        if ($doc['filename'] == $_GET['file']) {
                            $model->id = $_GET['id'];
                            $model->name = $_GET['file'];
                            $model->state_name = $_GET["state_name"];
                            $model->title_en = $doc["title_en"];
                            $model->title_tm = $doc["title_tm"];
                            $model->title_ru = $doc["title_ru"];
                            $model->alt = $doc["alt"];
                            $model->caption = $doc["caption"];
                            $model->author = $doc["author"];
                            $model->is_main = $doc["is_main"];
                            $model->video_path = $doc["video_path"];
                            $model->group = $doc["group"];
                        }
                    }
                }
            }

            Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            $this->renderPartial('//documents/edit_dialog', array('model' => $model, 'videos' => $videos), false, true);
        }

    }


    public function actionAjaxCrop()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $x = $_POST["x"];
            $y = $_POST["y"];
            $width = $_POST["w"];
            $height = $_POST["h"];

            $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
            $newname = "small_" . date("d_H_i_s");
            $model = Documents::model()->findByPk($id);
            if (isset($model->cropped_path) && file_exists($uploadfolder . $model->cropped_path))
                $model->deleteImagePath($model->cropped_path);
            if (isset($model->path)) {
                $path_array = array_reverse(explode('/', $model->path));
                $cropped_path = trim($model->path, $path_array[0]) . 'cropped_' . $path_array[0];
                $model->createCroppedImage($cropped_path, 600, $width, $height, $x, $y);

                if ($model->saveAttributes(array("cropped_path" => $cropped_path))) {
                    if (isset($_GET['cache_class'])) {
                        Yii::app()->cache->set($_GET['cache_class'], microtime(true), 0);
                    }
                }
            }
        }
    }


//    public function actionCheckPath()
//    {
//        $documents = Documents::model()->findAll();
//        foreach ($documents as $doc) {
//            $path = $doc->getUploadedPath($doc->path);
//            if (!is_file($path)) {
//                $doc->is_file = false;
//                $doc->update();
//            }
//        }
//    }


    public function actionDeleteVideo()
    {
        $path_delete = $_GET['path'];
        $filepath = realpath($path_delete);
        if (is_file($filepath)) {
            unlink($filepath);
        }
        // echo $filepath;
    }


}