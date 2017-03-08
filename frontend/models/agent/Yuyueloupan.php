<?php

namespace app\models\agent;

use Yii;
use app\models\Pagination;

/**
 * This is the model class for table "{{%yuyueloupan}}".
 *
 * @property integer $yid
 * @property integer $hlid
 * @property string $phone
 * @property string $username
 * @property integer $status
 * @property string $yuyuedate
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
            'yuyuedate' => 'yuyuedate',
        ];
    }
    
    public function getInfo()
    {
        $info = [
            'yid' => $this->yid,
            'hlid' => $this->hlid,
            'phone' => $this->phone,
            'username' => $this->username,
            'status' => $this->status,
            'create' => date('Y-m-d H:i:s',$this->create),
            'yuyuedate' => $this->yuyuedate,
        ];
        return $info;
    }
    
    public static function createLoupan($args)
    {
        //Array ( [username] => 66 [phone] => 66 [source] => 1 [proid] => 26 )
        $ret = [];
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $source = isset($args['source']) ? $args['source'] : '';
        $phone = isset($args['phone']) ? $args['phone'] : '';
        $username = isset($args['username']) ? $args['username'] : '';
        $yuyuedate = isset($args['yuyuedate']) ? $args['yuyuedate'] : '';
    
        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            //根据proid和source匹配home，找到hlid
            $where = ['AND'];
            if($proid){
                $where[] = 'proid='.$proid;
            }
            if($source){
                $where[] = 'source='.$source;
            }
            //是否存在首页
            $isexit_home = Homepagelog::find()->where($where)->one();
            if($isexit_home){
                $whereand = ['AND'];
                if($phone){
                    $whereand[] = 'phone='.$phone;
                }
                if($username){
                    $whereand[] =  "username='$username'";
                }
                //判断是否已经预约了楼盘
                $if_agent = Yuyueloupan::find()->where($whereand)->one();
                if($if_agent){
                    $ret['err'] = '您已经预约了楼盘';
                }else{
                    $agent = new Yuyueloupan();
                    $agent->hlid = $isexit_home->hlid;
                    $agent->phone = $phone;
                    $agent->username = $username;
                    $agent->yuyuedate = $yuyuedate;
                    $agent->create = time();
                    $agent->save();
                    $dbTrans->commit();
                    $ret['yid'] = $agent->yid;
                }
            }else{
                $ret['err'] = '不存在首页数据';
            }
        } catch (Exception $e) {
            $dbTrans->rollback();
            $ret['err'] = $e->getMessage();
        }
        return $ret;
    }
    
    public static function getLoupanList($args)
    {
        $size = isset($args['size']) ? $args['size'] : '1000';
        $p = isset($args['p']) ? $args['p'] : '1';
        $hlid = isset($args['hlid']) ? $args['hlid'] : '';
         
        $where = ['AND'];
        if($hlid){
            $where[] = 'hlid='."'$hlid'";
        }
        $query = Yuyueloupan::find()->where($where)->distinct();
        return Pagination::getDataList($query, $p, $size);
    }
}
