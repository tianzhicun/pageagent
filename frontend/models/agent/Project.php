<?php

namespace app\models\agent;

use Yii;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property integer $proid
 * @property string $cpmpany
 * @property string $name
 * @property string $status
 * @property integer $create
 * @property integer $erid
 * @property integer $lid
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project}}';
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'proid' => '项目id',
            'cpmpany' => '公司名称',
            'name' => '项目名称',
            'status' => '项目状态   状态 1：启用  0：禁用',
            'create' => 'Create',
            'erid' => '二维码',
            'lid' => '链接',
        ];
    }
}
