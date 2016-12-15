<?php

namespace app\models\agent;

use Yii;

/**
 * This is the model class for table "{{%homepagelog}}".
 *
 * @property integer $hlid
 * @property integer $proid
 * @property string $ip
 * @property integer $equip
 * @property integer $islink
 * @property string $source
 * @property integer $status
 * @property integer $create
 */
class Homepagelog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%homepagelog}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hlid' => 'Hlid',
            'proid' => '项目id',
            'ip' => 'ip',
            'equip' => '设备  1：手机  2：电脑  3：ipad',
            'islink' => '是否是链接  1：是链接   2：二维码',
            'source' => '来源',
            'status' => '状态   状态 1：启用  0：禁用',
            'create' => '创建时间',
        ];
    }
}
