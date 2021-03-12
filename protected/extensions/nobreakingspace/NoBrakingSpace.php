<?php
/**
 * Created by PhpStorm.
 * User: ecmngnt
 * Date: 3/12/21
 * Time: 9:42 PM
 */

class NoBrakingSpace extends CActiveRecordBehavior
{

    public $attributes;

        public function beforeSave($event){

            foreach ($this->attributes as $attribute){
                $this->owner->{$attribute} = preg_replace('/\xc2\xa0/', ' ', $this->owner->{$attribute});
            }

            parent::beforeSave($event);
        }


}