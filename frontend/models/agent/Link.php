<?php

namespace app\models\agent;

use Yii;
use app\models\Pagination;

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
    
    public function getInfo()
    {
        $info = [
            'lid' => $this->lid,
            'proid' => $this->proid,
            'status' => $this->status,
            'keyword' => $this->keyword,
            'link' => $this->link,
            'create' => date('Y-m-d H:i:s',$this->create),
        ];
        return $info;
    }
    
    public static function CreateLink($args){
        $ret = [];
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $keyword = isset($args['keyword']) ? $args['keyword'] : '';
        $lin= isset($args['link']) ? $args['link'] : '';
    
        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            $link = new Link();
            $link->proid = $proid;
            $link->keyword = $keyword;
            $link->link = $lin;
            $link->status = '1';
            $link->create = time();
            $link->save();
            $dbTrans->commit();
            $ret['lid'] = $link->lid;
        } catch (Exception $e) {
            $dbTrans->rollback();
            $ret['err'] = $e->getMessage();
        }
        return $ret;
    }
    
    public static function getLinkList($args)
    {
        $size = isset($args['size']) ? $args['size'] : '1000';
        $p = isset($args['p']) ? $args['p'] : '1';
        $lid = isset($args['lid']) ? $args['lid'] : '';
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $where = ['AND'];
        if($lid){
            $where[] = 'lid='."'$lid'";
        }
        if($proid){
            $where[] = 'proid='."'$proid'";
        }
        $query = Link::find()->where($where)->distinct();
        return Pagination::getDataList($query, $p, $size);
    }
}
