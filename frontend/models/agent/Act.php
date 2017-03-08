<?php

namespace app\models\agent;

use Yii;

/**
 * This is the model class for table "{{%act}}".
 *
 * @property integer $actid
 * @property string $actname
 * @property integer $actstatus
 * @property integer $createtime
 */
class Act extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%act}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actstatus', 'createtime'], 'integer'],
            [['actname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'actid' => 'Actid',
            'actname' => 'Actname',
            'actstatus' => 'Actstatus',
            'createtime' => 'Createtime',
        ];
    }
}
