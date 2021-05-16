<?php

class DOSpaceService
{
    public $key = "K4RMSJ3XHGU3W6CFTEBY";
    public $secret = "hwMKwnDqYRivuAZpBPpKCJtgO0saAp/+I35F4oGkK48";
    public $space_name = "turkmenportal";
    public $region = "nyc3";
    public $space;

    public function __construct()
    {
        $this->space = new SpacesConnect($this->key, $this->secret, $this->space_name, $this->region);
    }


    public function uploadToSpace($localPath, $spacePath, $access = 'private')
    {
        echo "uploadToSpace: localPath: " . $localPath . ' spacePath: ' . $spacePath;
        try {
            if (file_exists($localPath)) {
                $this->space->uploadFile($localPath, $access, $spacePath);
                return true;
            }
//            else {
//                echo "file does not exist on localPath: " . $localPath;
//            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }

        return false;
    }


    public function downloadFromSpace($download_file, $save_as)
    {
        if ($this->space->doesObjectExist($download_file) && !file_exists($save_as)) {
            $this->space->downloadFile($download_file, $save_as);
            return true;
        }
        return false;
    }

    public function deleteFromSpace($spacePath)
    {
//        echo '</br> DELETE PATH:' . $spacePath;
        if ($this->space->doesObjectExist($spacePath)) {
            $this->space->deleteObject($spacePath);
            return true;
        }
        return false;
    }

    public function deleteMatchingObjects($regex, $options = array())
    {
        echo '</br> DELETE MATCHING OBJECTS REGEX:' . $regex;
//        if ($this->space->doesObjectExist($spacePath)) {
        $this->space->deleteMatchingObject($regex, $options);
        return true;
//        }
//        return false;
    }

    public function downloadFromDirectory($pathToDirectory, $prefix = '')
    {
        $this->space->client->downloadBucket($pathToDirectory, $this->space->space, $prefix);
        return true;
    }


}