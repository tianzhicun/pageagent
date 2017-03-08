<?php

namespace app\models\agent;

use Yii;
use app\models\Pagination;

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
    
    public function getInfo()
    {
        $info = [
            'agentid' => $this->agentid,
            'hlid' => $this->hlid,
            'phone' => $this->phone,
            'username' => $this->username,
            'selflink' => $this->selflink,
            'selferweima' => $this->selferweima,
            'status' => $this->status,
            'create' => date('Y-m-d H:i:s',$this->create),
        ];
        return $info;
    }
    
    public static function createAgent($args)
    {
        //Array ( [username] => 66 [phone] => 66 [source] => 1 [proid] => 26 )
        $ret = [];
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $source = isset($args['source']) ? $args['source'] : '';
        $phone = isset($args['phone']) ? $args['phone'] : '';
        $username = isset($args['username']) ? $args['username'] : '';
        
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
            //print_r(Homepagelog::find()->where($where)->createCommand()->getRawSql())
            //是否存在首页
            $isexit_home = Homepagelog::find()->where($where)->one();
            if($isexit_home){
                $whereand = ['AND'];
                if($phone){
                    $whereand[] = 'phone='.$phone;
                }
                if($username){
                    $whereand[] = "username='$username'";
                }
                //判断是否已经是经纪人
                $if_agent = Signup::find()->where($whereand)->one();
                if($if_agent){
                    $ret['err'] = '您已经是经纪人';
                }else{
                    $agent = new Signup();
                    $agent->hlid = $isexit_home->hlid;
                    $agent->phone = $phone;
                    $agent->username = $username;
                    $agent->create = time();
                    $agent->save();
                    $dbTrans->commit();
                    $ret['agentid'] = $agent->agentid;
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
    
    public static function getJjrList($args)
    {
        $size = isset($args['size']) ? $args['size'] : '1000';
        $p = isset($args['p']) ? $args['p'] : '1';
        $hlid = isset($args['hlid']) ? $args['hlid'] : '';
       
        $where = ['AND'];
        if($hlid){
            $where[] = 'hlid='."'$hlid'";
        }
        $query = Signup::find()->where($where)->distinct();
        return Pagination::getDataList($query, $p, $size);
    }
    
}
