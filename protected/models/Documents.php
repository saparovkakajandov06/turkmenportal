<?php

/**
 * This is the model class for table "tbl_documents".
 *
 * The followings are the available columns in table 'tbl_documents':
 * @property integer $id
 * @property string $path
 * @property string $cropped_path
 * @property string $name
 * @property string $group
 */
class Documents extends ActiveRecordWOD
{
    public $state_name;
    public $cache_class;
    public $resize_quality = 85;
    public $resized_imagesize = false;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_documents';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_main', 'boolean'),
            array('path, name, group', 'length', 'max' => 255),
//            array ('video_path', 'file', 'types' => 'mp4, ogv', 'safe' => false),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id,alt,name,caption,author,is_main path, title_en,title_tm,title_ru, group, cropped_path, video_path', 'safe'),
            array('id,alt,name,caption,author,is_main path, title_en,title_tm,title_ru, group, cropped_path, video_path', 'safe', 'on' => 'search'),
        );
    }


    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'resolutions' => array(self::HAS_MANY, 'VideoResolutions', 'document_id'),
        );
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'id'),
            'path' => Yii::t('app', 'path'),
            'cropped_path' => Yii::t('app', 'cropped_path'),
            'video_path' => Yii::t('app', 'video_path'),
            'name' => Yii::t('app', 'name'),
            'group' => Yii::t('app', 'group'),
            'temp_id' => Yii::t('app', 'temp_id'),
            'alt' => Yii::t('app', 'alt'),
            'caption' => Yii::t('app', 'caption'),
            'title' => Yii::t('app', 'title'),
            'author' => Yii::t('app', 'author'),
            'is_main' => Yii::t('app', 'is_main'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('path', $this->path, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('group', $this->group, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


//    public function generateVideoResolutions()
//    {
//        if (isset($this->video_path) && strlen(trim($this->video_path)) > 5) {
//            $videouploadfolder = trim(Yii::app()->params['videouploadfolder'], '/');
//            $videoResolutions = Yii::app()->params['videoResolutions'];
//
//            $full_video_path = $videouploadfolder . $this->video_path;
//            if (is_file($full_video_path) && isset($videoResolutions) && is_array($videoResolutions)) {
//                $utf = new Utf();
//                $videoConvertedService = new VideoConverterService();
//                $videoConvertedService->document_id = $this->id;
//                $info = pathinfo($full_video_path);
//                $extension = $info['extension'];
//
//                $target_savefolder = $videouploadfolder . '/' . 'resolutions';
//                if (!is_dir($target_savefolder)) {
//                    mkdir($target_savefolder);
//                    chmod($target_savefolder, 0777);
//                }
//
//                foreach ($videoResolutions as $resoultion) {
//                    $target_filename = $utf->utf8_substr(basename($full_video_path), 0, $utf->utf8_strrpos(basename($full_video_path), '.')) . '-' . $this->id . '-' . $resoultion['width'] . 'x' . $resoultion['height'] . '.' . $extension;
//                    $videoConvertedService->convert($full_video_path, $target_savefolder . '/' . $target_filename, $resoultion['width'], $resoultion['height']);
//                }
//            }
//        }
//    }


    public function generateVideoHLS()
    {
        if (isset($this->video_path) && strlen(trim($this->video_path)) > 5) {
            $videouploadfolder = trim(Yii::app()->params['videouploadfolder'], '/');
            $full_video_path = $videouploadfolder . $this->video_path;
            $full_video_url = 'https://turkmenportal.com/' . $videouploadfolder . $this->video_path;

            if (is_file($full_video_path)) {
                $videoConvertedService = new VideoConverterService();
                $videoConvertedService->document_id = $this->id;

                $utf = new Utf();
                $target_hls_foldername = dirname($this->video_path) . '/' . $utf->utf8_substr(basename($full_video_path), 0, $utf->utf8_strrpos(basename($full_video_path), '.'));  //example will be blogs/videofilename/
                $target_savefolder = $videouploadfolder . '/' . 'videohls' . '/' . trim($target_hls_foldername, '/');
                if (!is_dir($target_savefolder)) {
                    mkdir($target_savefolder);
                    chmod($target_savefolder, 0777);
                }

//                $videoConvertedService->convertHLS($full_video_path, $target_savefolder);
                $videoConvertedService->triggerConvertHLS($full_video_path, $full_video_url, $target_savefolder);
            }
        }
    }


    public function getVideoPath()
    {
        $videouploadfolder = trim(Yii::app()->params['videouploadfolder'], '/');
        if (isset($this->video_path) && strlen(trim($this->video_path)) > 0) {
            if (!is_file($videouploadfolder . $this->video_path)) {

                $video_save_folder = dirname($videouploadfolder . $this->video_path);
                if (!is_dir($video_save_folder)) {
                    mkdir($video_save_folder);
                    chmod($video_save_folder, 0777);
                }

                $doSpaceService = new DOSpaceService();
                if (!$doSpaceService->downloadFromSpace($videouploadfolder . $this->video_path, $videouploadfolder . $this->video_path))
                    return;
            }
            return $videouploadfolder . $this->video_path;
        }

        return false;
    }

    public function saveDocuments($foldergroup = null, $statename = null, $save = false, $group = 'images', $uploadToSpace = true)
    {
        $doSpaceService = new DOSpaceService();
        if (!isset ($foldergroup))
            $foldergroup = 'others';
        if (!isset ($statename))
            $statename = 'temp_document';

        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
        $videouploadfolder = trim(Yii::app()->params['videouploadfolder'], '/');
        $returnModels = array();

        $console = false;

        try {
            $test = Yii::app()->user;
        }
        catch (CException $e)  {
            $console = true;
        }


        //If we have pending images
        if (Yii::app()->user->hasState($statename) || $console) {
            if (!$console){
                $documents = Yii::app()->user->getState($statename);
            } else {
                $documents = array();
            }

            //Resolve the final path for our images
            $path = $uploadfolder . "/{$foldergroup}/";
            $video_save_path = $videouploadfolder . "/{$foldergroup}/";
            //Create the folder and give permissions if it doesnt exists
            if (!is_dir($path)) {
                mkdir($path);
                chmod($path, 0777);
            }


            $is_main = false;
            foreach ($documents as $document) {
                if (isset($document['is_main']) && $document['is_main'] == 1)
                    $is_main = true;
            }

            if ($is_main == false) {
                if (isset($documents[0])) {
                    $documents[0]['is_main'] = 1;
                }
            }
            //Now lets create the corresponding models and move the files
            foreach ($documents as $temp_doc) {
                $saveToDb = true;

                $doc = new Documents();
                if (isset($temp_doc['id']) && strlen(trim($temp_doc['id'])) > 0)
                    $doc = Documents::model()->findByPk($temp_doc['id']);

                if (!isset($doc))
                    continue;

                try {
                    if (is_file($temp_doc["path"])) {
                        if (rename($temp_doc["path"], $path . $temp_doc["filename"])) {
                            if ($uploadToSpace == true) {
                                $doSpaceService->uploadToSpace($path . $temp_doc["filename"], $path . $temp_doc["filename"]);
                            }
                            chmod($path . $temp_doc["filename"], 0777);
                            $doc->path = "/" . $foldergroup . "/" . $temp_doc["filename"];
                        }
                    }

                    //process video content
                    if (isset($temp_doc["video_path"]) && is_file($temp_doc["video_path"])) {
                        if (!is_dir($video_save_path)) {
                            mkdir($video_save_path);
                            chmod($video_save_path, 0777);
                        }

                        if (rename($temp_doc["video_path"], $video_save_path . basename($temp_doc["video_path"]))) {
                            chmod($video_save_path . basename($temp_doc["video_path"]), 0777);
                            if ($uploadToSpace == true) {
                                $doSpaceService->uploadToSpace($video_save_path . basename($temp_doc["video_path"]), $video_save_path . basename($temp_doc["video_path"]));
                            }

                            $doc->video_path = "/" . $foldergroup . "/" . basename($temp_doc["video_path"]);
                        }
                    }
                } catch (Exception $e) {
                    Yii::log($e->getMessage(), 'error');
                    $saveToDb = false;
                }

                if ($saveToDb) {
                    $doc->group = $group;

                    if (isset($temp_doc["title_en"]))
                        $doc->title_en = $temp_doc["title_en"];
                    if (isset($temp_doc["title_tm"]))
                        $doc->title_tm = $temp_doc["title_tm"];
                    if (isset($temp_doc["title_ru"]))
                        $doc->title_ru = $temp_doc["title_ru"];
                    if (isset($temp_doc["alt"]))
                        $doc->alt = $temp_doc["alt"];
                    if (isset($temp_doc["title"]))
                        $doc->title = $temp_doc["title"];
                    if (isset($temp_doc["caption"]))
                        $doc->caption = $temp_doc["caption"];
                    if (isset($temp_doc["author"]))
                        $doc->author = $temp_doc["author"];
                    if (isset($temp_doc["is_main"]))
                        $doc->is_main = $temp_doc["is_main"];

//                    if (!Yii::app()->db->currentTransaction) // only start transaction if none is running already
//                        $transaction = Yii::app()->db->beginTransaction();
                    if ($save == true) {
                        if ($doc->save(false)) {
                            $doc->generateVideoHLS();
                        }
                    }
                    $returnModels[] = $doc;
//                    if ($transaction)
//                        $transaction->commit(); // commit on success if transaction was started in this behavior
//                    elseif ($transaction)
//                        $transaction->rollback(); // rollback on errors if transaction was started in this behavior
                } else {
                    //You can also throw an execption here to rollback the transaction
                    Yii::log($temp_doc["path"] . " is not a file", CLogger::LEVEL_WARNING);
                }
            }
            if ($save == true){
                if (!$console){
                    Yii::app()->user->setState($statename, null);
                }
            }
        }

        return $returnModels;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Documents the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function fullDelete($related_table_name = null)
    {
        if (!isset($this->id))
            return;
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
        $file = realpath($uploadfolder . $this->path);
        if (is_file($file)) {
            unlink($file);
        }

        $videouploadfolder = trim(Yii::app()->params['videouploadfolder'], '/');
        $video_file = realpath($videouploadfolder . $this->video_path);
        if (is_file($video_file)) {
            unlink($video_file);
        }


        $doSpaceService = new DOSpaceService();
        $doSpaceService->deleteFromSpace($uploadfolder . $this->path);
        $doSpaceService->deleteFromSpace($videouploadfolder . $this->video_path);


        $hls = VideoHls::model()->findByAttributes(array('document_id' => $this->id));
        if (isset($hls)) {
            $hls_folder = dirname($hls->playlist_path);
            if (is_dir($hls_folder)) {
                echo '</br>IS_DIR TRUE: ' . $hls_folder;
                $this->delete_files($hls_folder);
            }
            $hls->delete();

            $doSpaceService->deleteMatchingObjects($hls_folder);
        }

        if (isset($related_table_name) && strlen(trim($related_table_name)) > 0) {
            $this->removeFromRelationsTable($related_table_name, $this->id);
        }
        return $this->delete();
    }


    public function delete_files($target)
    {
        echo '</br>IN delete_files target:' . $target;
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

            foreach ($files as $file) {
                $this->delete_files($file);
            }

            rmdir($target);
        } elseif (is_file($target)) {
            unlink($target);
        }
    }


    public function getVideoHlsPlaylistUrl()
    {
        $hls = VideoHls::model()->findByAttributes(array('document_id' => $this->id));

        if (!file_exists($hls->playlist_path)) {
            $playlistDirPath = dirname($hls->playlist_path);
            if (!is_dir($playlistDirPath)) {
                if (mkdir($playlistDirPath, '0777', true))
                    chmod($playlistDirPath, 0777);
                else
                    return;
            }
            $doSpaceService = new DOSpaceService();
            if (!$doSpaceService->downloadFromDirectory($playlistDirPath, $playlistDirPath))
                return;
        }

//        $videouploadfolder = trim(Yii::app()->params['videouploadfolder'], '/');
        if (isset($hls->playlist_path) && strlen(trim($hls->playlist_path)) > 0)
            return Yii::app()->baseUrl . '/' . $hls->playlist_path;

        return false;
    }

    public function removeFromRelationsTable($tablename, $documentsId)
    {
        $sql = "DELETE FROM " . $tablename . " WHERE documents_id=:documentsId";
//        echo "</br>Remove from relation table docId: " . $documentsId;
//        echo "</br>sql: " . $sql;

        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":documentsId", $documentsId, PDO::PARAM_INT);
        return $command->execute();
    }

    public function setToAttributes($statename)
    {
        //If we have pending images

        if (Yii::app()->user->hasState($statename)) {
            $documents = Yii::app()->user->getState($statename);

            //Now lets create the corresponding models and move the files

            foreach ($documents as $image) {
                if (is_file($image["path"])) {
                    $docs = new Documents();
                    $docs->name = $image["name"];
                    $docs->path = $image["path"];
                    $docs->group = $image["mime_type"];
                    $returnModels[] = $docs;
                }
            }
        }

        return $returnModels;
    }

    public function resize($width, $height, $type = "", $is_cropped = false, $with_watermark = true)
    {

        switch ($type) {
            case "h":
                $type = Image::HEIGHT;
                break;
            case "w":
                $type = Image::WIDTH;
                break;
            case "n":
                $type = Image::NONE;
                break;
            case "p":
                $type = Image::PRECISE;
                break;
            case "i":
                $type = Image::INVERSE;
                break;
            case "auto":
                $type = Image::AUTO;
                break;
            case 'crop':
                $type = Image::CROP;
                break;
        }


        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
        $filename = trim($this->path, '/');
//        $filename = $this->path;
        $scale = 1;


        try {
            if (!file_exists($uploadfolder . "/" . $filename) || !is_file($uploadfolder . "/" . $filename)) {
                $spaceFilename = $uploadfolder . "/" . $filename;
                $spaceFilename = str_replace('//', '/', $spaceFilename);

                $dirPath = dirname($uploadfolder . "/" . $filename);
                if (!is_dir($dirPath)) {
                    if (mkdir($dirPath))
                        chmod($dirPath, 0777);
                    else
                        return;
                }
                $doSpaceService = new DOSpaceService();
                if (!$doSpaceService->downloadFromSpace($spaceFilename, $spaceFilename))
                    return;
            }

            if (isset($this->cropped_path) && strlen(trim($this->cropped_path)) > 0 && $is_cropped == true) {
                if (file_exists($uploadfolder . "/" . $this->cropped_path) && is_file($uploadfolder . "/" . $this->cropped_path)) {
                    $filename = $this->cropped_path;
                    $datas = getimagesize($uploadfolder . "/" . $filename);
                    $scale = $width / $datas[0];
                    $width = $datas[0];
                    $height = $datas[1];
                }
            }

            $width = ($width * $scale);
            $height = ($height * $scale);


            $this->resized_imagesize = getimagesize($uploadfolder . "/" . $filename);
            $info = pathinfo($filename);
            $extension = $info['extension'];

            $old_image = $filename;
            $utf = new Utf();
            $new_image = 'cache' . '/' . $utf->utf8_substr($filename, 0, $utf->utf8_strrpos($filename, '.')) . '-' . $this->id . '-' . $width . 'x' . $height . '-' . $type . '.' . $extension;
            $new_image = preg_replace('/\s+/', '_', $new_image);

            if (!file_exists($uploadfolder . "/" . $new_image) || (filemtime($uploadfolder . "/" . $old_image) > filemtime($uploadfolder . "/" . $new_image))) {
                $path = '';
                $directories = explode('/', dirname(str_replace('../', '', $new_image)));
                foreach ($directories as $directory) {
                    $path = $path . '/' . $directory;

                    if (!file_exists($uploadfolder . "/" . $path)) {
                        @mkdir($uploadfolder . "/" . $path, 0777);
                    }
                }

                list($width_orig, $height_orig) = $this->resized_imagesize;
                $ext = pathinfo($uploadfolder . "/" . $old_image, PATHINFO_EXTENSION);


                if (($width_orig != $width || $height_orig != $height) && $ext != 'swf' && $ext != 'mp4') {
                    $image = new EasyImage($uploadfolder . "/" . $old_image);
//                    $image = new EasyImage($uploadfolder . "/" . $old_image, 'Imagick');  //serverda shu dur
//                $image->driver='Imagick';
//                                if($type=='auto'){
//                                    $new_height=$width*$height_orig/$width_orig;
//                                    $image->resize($width, $new_height);
//                                }else
                    $image->resize($width, $height, $type);
//                                    $image->thumbSrcOf($uploadfolder ."/". $old_image,array(
//                                        'resize' => array('width' => $, 'height' => 100),
////                                        'rotate' => array('degrees' => 90),
////                                        'sharpen' => 50,
//                                        'background' => '#ffffff',
////                                        'type' => 'jpg',
////                                        'quality' => 60,
//                                    ));
//                                    Yii::app()->easyImage->thumbOf('image.png',
//                                        array(
//                                            'resize' => array('width' => 100, 'height' => 100),
//                                            'rotate' => array('degrees' => 90),
//                                            'sharpen' => 50,
//                                            'background' => '#ffffff',
//                                            'type' => 'jpg',
//                                            'quality' => 60,
//                                        ));

//                    if (($width >= 350 || $height >= 350) && $with_watermark == true) {
//                        if (file_exists($uploadfolder . "/" . 'watermark.png')) {
//                            $mark = new EasyImage($uploadfolder . "/" . 'watermark.png');
//                            $image->watermark($mark, true, true);
//                        }
//                    }

//                $image->background('ffffff');
//                    $image->sharpen(25);

//                }
                    $image->save($uploadfolder . "/" . $new_image, $this->resize_quality);
//                                $thumb=Yii::app()->phpThumb->create($uploadfolder ."/". $old_image);
//                                $thumb->resize($width, $height);
//                                $thumb->save($uploadfolder ."/". $new_image);
                } else {
                    copy($uploadfolder . "/" . $old_image, $uploadfolder . "/" . $new_image);
                }
            }

            $thumb = Yii::app()->baseUrl . '/' . $uploadfolder . "/" . $new_image;
//        echo "THUMB:";
//        echo $thumb;
//        exit(1);
            return $thumb;
        } catch (Exception $e) {
            Yii::log($e->getTraceAsString(), 'error');
//            echo "<pre>";
//            print_r($e->getMessage());
//            echo "</pre>";
            return "";
        }
    }

    public function deleteImagePath($path)
    {
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
        if (isset($path) && file_exists($uploadfolder . $path)) {
            $realUrl = $uploadfolder . $path;
            if (file_exists($realUrl))
                unlink($realUrl);
        } else
            return false;
    }

    public function createCroppedImage($cropped_path, $realWidth, $width = 1, $height = 0, $x = 0, $y = 0, $ratio = 0.75)
    {
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
        $image = $uploadfolder . $this->path;
        $thumbname = $uploadfolder . $cropped_path;

        if (!file_exists($image))
            return false;

        if ($width == 1 || $height == 0) {
            $datas = getimagesize($image);
            $height = $datas[1];
            $width = $height * $ratio;
        }

        if ($realWidth > $width)
            $realWidth = $width;

        $scale = $realWidth / $width;
        $newWidth = ceil($width * $scale);
        $newHeight = ceil($height * $scale);

        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        //saving the image into memory (for manipulation with GD Library)
        $source = imagecreatefromjpeg($image);
        imagecopyresampled($newImage, $source, 0, 0, $x, $y, $newWidth, $newHeight, $width, $height);
        imagejpeg($newImage, $thumbname, 100);
        chmod($thumbname, 0777);
    }

    public function getRealPath()
    {
        if (!isset($this->path))
            return;
        else
            return $this->getUploadedPath($this->path);
    }

//    public function getVideoResolutions()
//    {
//        $resolutions = $this->resolutions;
//        if (is_array($resolutions)) {
//            foreach ($resolutions as $key => $resolution) {
//                if (isset($resolution->path)) {
//                    $resolution->url = Yii::app()->baseUrl . '/' . $resolution->path;
//                    $resolutions[$key] = $resolution;
//                }
//            }
//            return $resolutions;
//        }
//
//        return false;
//    }

    public function getUploadedPath($path)
    {
        $uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
        $filePath = trim($path, '/');

        if (!file_exists($uploadfolder . "/" . $filePath) || !is_file($uploadfolder . "/" . $filePath)) {
            $spaceFilename = $uploadfolder . "/" . $filePath;
            $spaceFilename = str_replace('//', '/', $spaceFilename);
            $dirPath = dirname($uploadfolder . "/" . $filePath);
            if (!is_dir($dirPath)) {
                if (mkdir($dirPath))
                    chmod($dirPath, 0777);
                else
                    return;
            }
            $doSpaceService = new DOSpaceService();
            if (!$doSpaceService->downloadFromSpace($spaceFilename, $spaceFilename))
                return;
        }
        return Yii::app()->baseUrl . '/' . $uploadfolder . "/" . $filePath;
    }

    public function getVideoUrl()
    {
        $videouploadfolder = trim(Yii::app()->params['videouploadfolder'], '/');
        if (isset($this->video_path) && strlen(trim($this->video_path)) > 0)
            return Yii::app()->baseUrl . '/' . $videouploadfolder . $this->video_path;

        return false;
    }


    public function getTitle()
    {
        $attribute = 'title_' . Yii::app()->getLanguage();
        return $this->{$attribute};
    }
}
