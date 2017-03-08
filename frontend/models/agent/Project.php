<?php

namespace app\models\agent;

use Yii;
use app\models\Pagination;
use common\models\User;

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
 * @property integer $actid
 * @property integer $visit
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
    
    public function getInfo()
    {
        $info = [
            'proid' => $this->proid,
            'company' => $this->cpmpany,
            'name' => $this->name,
            'status' => $this->status,
            'create' => date('Y-m-d H:i:s',$this->create),
            'erid' => $this->erid,
            'lid' => $this->lid,
            'actid' => $this->actid,
            'visit' => $this->visit,
        ];
        return $info;
    }
    
    public function getInfos()
    {
        $info = [
            'proid' => $this->proid,
            'actid' => $this->actid,
        ];
        $user = $this->getTuiguang()->one();
        if($user){
            $info['name'] = $user->actname;
        }
        return $info;
    }
    
    public function getTuiguang(){
        return $this->hasOne(Act::className(), ['actid' => 'actid']);
    }
    
    public static function CreatePro($args){
        //print_r($args);exit;
        $ret = [];
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $cpmpany = isset($args['cpmpany']) ? $args['cpmpany'] : '';
        $name= isset($args['name']) ? $args['name'] : '';

        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            if($proid){
                $where = ['AND'];
                if($proid){
                    $where[] = 'proid='.$proid;
                }
                //是否存在项目
                $isexit_pro = Project::find()->where($where)->one();
                if($isexit_pro){
                    if(isset($args['cpmpany'])){
                        $isexit_pro->cpmpany = $cpmpany;
                    }
                    if(isset($args['name'])){
                        $isexit_pro->name = $name;
                    }
                    if ($isexit_pro->save()) {
                        $dbTrans->commit();
                        $ret['proid'] = $isexit_gift->proid;
                    } else {
                        $ret['err'] = $isexit_gift->errors;
                    }
                }else{
                    $ret['err'] = '该项目不可以修改';
                }
            }else{
                $pro = new Project();
                $pro->proid = $proid;
                $pro->cpmpany = $cpmpany;
                $pro->name = $name;
                $pro->create = time();
                $pro->status = '1';
                if($pro->save()){
                   $link = [
                       'proid'=>$pro->proid,
                       'keyword'=>'默认链接关键字',
                       'link'=>"http://pageangent.yuntumedia.com/site/index?proid=$pro->proid&source=1&link=1",
                   ];
                   $erweima = [
                       'proid'=>$pro->proid,
                       'keyword'=>'默认二维码',
                       'erweima'=>"http://pageangent.yuntumedia.com/site/index?proid=$pro->proid&source=1&link=1",
                   ];
                   $lin = new Link();
                   $erwei = new Erweima();
                   $lin->CreateLink($link);
                   $erwei->CreateErweima($erweima);
                }
                $dbTrans->commit();
                $ret['proid'] = $pro->proid;
            }
        } catch (Exception $e) {
            $dbTrans->rollback();
            $ret['err'] = $e->getMessage();
        }
        return $ret;
    }
    
    public static function getProList($args)
    {
        $size = isset($args['size']) ? $args['size'] : '1000';
        $p = isset($args['p']) ? $args['p'] : '1';
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $where = ['AND'];
        if($proid){
            $where[] = 'proid='."'$proid'";
        }
        $query = Project::find()->where($where)->distinct();
        return Pagination::getDataList($query, $p, $size);
    }
    
    public static function bindPro($args)
    {
        $username = isset($args['proname']) ? $args['proname'] : '';
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $where = ['AND'];
        
        //查找是否存在这个用户
        $user = User::findOne(['username'=>$username]);
        if($user && $proid){
            $user->proid = $proid;
            $user->save();
        }
    }
    
    public static function bindAct($args)
    {
        //print_r($args);exit;   先注册开发商，之后创建项目（创建二维码和链接），绑定开发商和活动，首页展示用的文件
        $username = isset($args['proname']) ? $args['proname'] : '';
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $where = ['AND'];
    
        //查找是否存在这个活动
        $act = Act::findOne(['actname'=>$username]);
        //查找是否有这个活动
        $pro = Project::findOne(['proid'=>$proid]);
        if($act && $pro){
            $pro->actid = $act->actid;
            $pro->save();
        }
    }
    
    public static function getTypeList($args)
    {
        $size = isset($args['size']) ? $args['size'] : '1000';
        $p = isset($args['p']) ? $args['p'] : '1';
        $where = ['AND'];
        $query = Project::find()->where($where)->distinct();
        return Pagination::getDataLists($query, $p, $size);
    }
    
    //新用户增加访问量
    public static function addNewVisit($proid)
    {
        $pro = Project::findOne(['proid'=>$proid]);
        $pro->visit = $pro->visit + 1;
        $pro->save();
    }
}
