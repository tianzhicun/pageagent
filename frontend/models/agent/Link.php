<?php

namespace app\models\agent;

use Yii;

/**
 * This is the model class for table "{{%link}}".
 *
 * @property integer $lid
 * @property integer $proid
 * @property integer $status
 * @property string $keyword
 * @property string $link
 * @property integer $create
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%link}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lid' => 'Lid',
            'proid' => '项目id',
            'status' => '1：启用  0：禁用',
            'keyword' => '链接关键词',
            'link' => '链接',
            'create' => 'Create',
        ];
    }
}
