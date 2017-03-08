<?php
namespace common\base;

use yii\db\ActiveRecord;

class BaseActiveRecord extends ActiveRecord
{
    public function getInfo(){
        return $this->toArray();
    }
}