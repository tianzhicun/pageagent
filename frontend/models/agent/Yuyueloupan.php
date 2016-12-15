<?php

namespace app\models\agent;

use Yii;

/**
 * This is the model class for table "{{%yuyueloupan}}".
 *
 * @property integer $yid
 * @property integer $hlid
 * @property string $phone
 * @property string $username
 * @property integer $status
 * @property integer $create
 */
class Yuyueloupan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%yuyueloupan}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'yid' => 'Yid',
            'hlid' => 'Hlid',
            'phone' => 'Phone',
            'username' => 'Username',
            'status' => 'Status',
            'create' => 'Create',
        ];
    }
}
