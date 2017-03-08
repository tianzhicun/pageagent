<?php

namespace app\models\agent;

use Yii;
use app\models\Pagination;
use common\helper\CommonTools;

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
    
    public function getInfo()
    {
        $info = [
            'erid' => $this->erid,
            'proid' => $this->proid,
            'status' => $this->status,
            'keyword' => $this->keyword,
            'erweima' => $this->erweima,
            'create' => date('Y-m-d H:i:s',$this->create),
        ];
        return $info;
    }
    
    public static function CreateErweima($args){
        //print_r($args);exit;
        $ret = [];
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $keyword = isset($args['keyword']) ? $args['keyword'] : '';
        $erwei= isset($args['erweima']) ? $args['erweima'] : '';
    
        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            $path = CommonTools::genQRcode($erwei,$proid);
            //$path =  $_SERVER['DOCUMENT_ROOT'].$path;
            $erweima = new Erweima();
            $erweima->proid = $proid;
            $erweima->keyword = $keyword;
            $erweima->erweima = $path;
            $erweima->status = '1';
            $erweima->create = time();
            $erweima->save();
            $dbTrans->commit();
            $ret['erid'] = $erweima->erid;
        } catch (Exception $e) {
            $dbTrans->rollback();
            $ret['err'] = $e->getMessage();
        }
        return $ret;
    }
    
    public static function getErweimaList($args)
    {
        $size = isset($args['size']) ? $args['size'] : '1000';
        $p = isset($args['p']) ? $args['p'] : '1';
        $erid = isset($args['erid']) ? $args['erid'] : '';
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $where = ['AND'];
        if($erid){
            $where[] = 'erid='."'$erid'";
        }
        if($proid){
            $where[] = 'proid='."'$proid'";
        }
        $query = Erweima::find()->where($where)->distinct();
        return Pagination::getDataList($query, $p, $size);
    }
}
