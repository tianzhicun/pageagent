<?php

namespace app\models\agent;

use Yii;

/**
 * This is the model class for table "{{%question}}".
 *
 * @property integer $qid
 * @property integer $hlid
 * @property string $question
 * @property string $answer
 * @property integer $status
 * @property integer $create
 * @property integer $anwsertime
 * @property integer $ifanwser
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%question}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qid' => 'Qid',
            'hlid' => '主页id',
            'question' => '提问问题',
            'answer' => '开发商回答',
            'status' => '状态   状态 1：启用  0：禁用',
            'create' => 'Create',
            'anwsertime' => 'Anwsertime',
            'ifanwser' => '1：提问过  0：没有提问',
        ];
    }
}
