<?php

namespace app\models\agent;

use Yii;

/**
 * This is the model class for table "{{%erweima}}".
 *
 * @property integer $erid
 * @property integer $proid
 * @property integer $status
 * @property string $keyword
 * @property string $erweima
 * @property integer $create
 */
class Erweima extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%erweima}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'erid' => 'Erid',
            'proid' => 'Proid',
            'status' => '状态 1：启用  0：禁用',
            'keyword' => '二维码关键词',
            'erweima' => '二维码',
            'create' => 'Create',
        ];
    }
}
