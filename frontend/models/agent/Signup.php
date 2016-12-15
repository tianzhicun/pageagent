<?php

namespace app\models\agent;

use Yii;

/**
 * This is the model class for table "{{%signup}}".
 *
 * @property integer $agentid
 * @property integer $hlid
 * @property string $phone
 * @property string $username
 * @property string $selflink
 * @property string $selferweima
 * @property integer $status
 * @property integer $create
 */
class Signup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%signup}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'agentid' => 'Agentid',
            'hlid' => '主页id',
            'phone' => '电话',
            'username' => '姓名',
            'selflink' => '专属链接',
            'selferweima' => '专属二维码',
            'status' => '状态 1：启用  0：禁用',
            'create' => 'Create',
        ];
    }
}
