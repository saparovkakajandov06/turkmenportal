<?php

class Service extends CActiveRecord {
    public function tableName() {
        return 'tbl_service';
    }


    public function relations() {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
}

?>