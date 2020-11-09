<?php

/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 * @version 1.4
 *
 * @property string $urlAttribute
 * @property string $titleAttribute
 * @property string $aliasAttribute
 * @property string $linkActiveAttribute
 * @property string $requestPathAttribute
 *
 * @property integer[] $array
 * @property mixed $assocList
 * @property mixed $aliasList
 * @property mixed $menuList
 */
class XUploadBehavior extends CActiveRecordBehavior
{

    public $docs = array();
    public $state_name = 'state_default';
    public $documents_relation = 'documents';
    public $uploadfolder = "";
    public $related_table_name = "";


    public function reloadTempList($clear_old_state = false)
    {
        if ($clear_old_state) {
            Yii::app()->user->setState($this->state_name, null);
        }

        if (Yii::app()->user->hasState($this->state_name)) {
            $documents = Yii::app()->user->getState($this->state_name);
            foreach ($documents as $docs) {
                if (isset($docs['path']) && is_file($docs['path'])) {
                    $this->docs[] = $docs;
                }
            }

            if (isset($this->docs) && is_array($this->docs) && count($this->docs) > 0) {
                Yii::app()->user->setState($this->state_name, $this->docs);
            }
        }

    }


    public function reloadDocumentsList($attachSession = FALSE)
    {
        if (!isset($this->uploadfolder) || strlen($this->uploadfolder) == 0)
            $this->uploadfolder = trim(Yii::app()->params['uploadfolder'], '/');
        $path = realpath($this->uploadfolder);


        $model = $this->getOwner();
        $documents = $model->{$this->documents_relation};
        $temps = array();
        if (isset($documents) && is_array($documents)) {
            foreach ($documents as $docs) {
                $temp_docs = array(
                    "id" => $docs["id"],
                    "path" => $path . $docs["path"],
                    "thumb" => $docs->resize(100, 75, 'h'),
                    "filename" => $docs["name"],
                    "size" => "0",
                    "mime" => "",
                    "name" => $docs["name"],
                    "alt" => $docs["alt"],
                    "author" => $docs["author"],
                    "title_ru" => $docs["title_ru"],
                    "title_tm" => $docs["title_tm"],
                    "title_en" => $docs["title_en"],
                    "caption" => $docs["caption"],
                    "is_main" => $docs["is_main"],
                    "video_path" => $docs["video_path"],
                    "thumbnail_url" => $docs->resize(100, 75, 'h'),
                    "delete_url" => Yii::app()->createUrl("//documents/delete", array('id' => $docs["id"], 'related_table_name' => $this->related_table_name)),
                    "edit_url" => Yii::app()->controller->createUrl("//documents/editDialog", array(
                        "_method" => "edit",
                        "file" => $docs["name"],
                        "state_name" => $this->state_name
                    )),
                );

                if (is_file($temp_docs['path'])) {
                    $temps[] = $temp_docs;
                } else {
                    $docs->fullDelete($this->related_table_name);
                }
            }

            foreach ($temps as $key => $tmp) {
                $found = false;
                foreach ($this->docs as $dkey => $doc) {
                    if ((isset($tmp['id']) && isset($doc['id']) && $doc["id"] == $tmp['id']) || (isset($tmp['filename']) && isset($doc['filename']) && $doc["filename"] == $tmp['filename']))
                        $found = true;
                }

                if ($found == false) {
                    $this->docs[] = $tmp;
                }

            }

            if ($attachSession == true) {
//                echo "<pre>";
//                print_r($this->state_name);
//                print_r($this->docs);
//                echo "</pre>";

                Yii::app()->user->setState($this->state_name, $this->docs);
//                Yii::app( )->user->setState($this->state_name,array());
            }
        }
    }


    public function getDocs()
    {
        return $this->docs;
    }


    public function emptyTempList()
    {
        if (Yii::app()->user->hasState($this->state_name)) {
            Yii::app()->user->setState($this->state_name, null);
        }
    }


    /**
     * @param array $docs
     */
    public function setDocs($docs)
    {
        $this->docs = $docs;
    }

    /**
     * @param string $state_name
     */
    public function setStateName($state_name)
    {
        $this->state_name = $state_name;
    }

    /**
     * @param string $documents_relation
     */
    public function setDocumentsRelation($documents_relation)
    {
        $this->documents_relation = $documents_relation;
    }

    /**
     * @param string $uploadfolder
     */
    public function setUploadfolder($uploadfolder)
    {
        $this->uploadfolder = $uploadfolder;
    }

    /**
     * @param string $related_table_name
     */
    public function setRelatedTableName($related_table_name)
    {
        $this->related_table_name = $related_table_name;
    }


}
