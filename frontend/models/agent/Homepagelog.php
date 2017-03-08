<?php

namespace app\models\agent;

use Yii;
use app\models\Pagination;
use common\models\User;
use common\helper\CommonTools;

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
 * @property integer $link
 * @property integer $create
 * @property integer $actid
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
            'create' => date('Y-m-d H:i:s',$this->create),
        ];
    }
    
    public function getInfo()
    {
        switch ($this->equip){
            case 1:
                $result = '手机';
                break;
            case 2:
                $result = '电脑';
                break;
            case 3:
                $result = 'ipad';
                break;
            default:
                $result = '手机';
                break;
        }
        switch ($this->source){
            case 1:
                $re = '微信';
                break;
            case 2:
                $re = 'qq';
                break;
            case 3:
                $re = '房讯网';
                break;
            default:
                $re = '手机';
                break;
        }
        $info = [
            'hlid' => $this->hlid,
            'proid' => $this->proid,
            'ip' => $this->ip,
            'equip' => $result,
            'islink' => $this->islink,
            'source' => $re,
            'status' => $this->status,
            'create' =>date('Y-m-d H:i:s',$this->create),
            'link' =>$this->link,
            'actid' =>$this->actid,
        ];
        $actexpand_list = $this->getActexpand()->all();
        if($actexpand_list){
          foreach ($actexpand_list as $data){
            $list_act[] = $data->getInfo();
          }
            $info['agent_list'] = $list_act;
            $info['agent_num'] = Signup::find(['hlid'=>$this->hlid])->count();
        }
        $ques_list = $this->getQues()->all();
        if($ques_list){
            foreach ($ques_list as $data_ques){
                $list_ques[] = $data_ques->getInfo();
            }
            $info['question_list'] = $list_ques;
            $info['question_num'] = Question::find(['hlid'=>$this->hlid])->count();
        }
        $loupan_list = $this->getLoupan()->all();
        if($loupan_list){
            foreach ($loupan_list as $data_loupan){
                $list_loupan[] = $data_loupan->getInfo();
            }
            $info['loupan_list'] = $list_loupan;
            $info['loupan_num'] = Yuyueloupan::find(['hlid'=>$this->hlid])->count();
        }
        $pro_list = $this->getPro()->all();
        if($pro_list){
            foreach ($pro_list as $data_pro){
                $list_pro[] = $data_pro->getInfo();
            }
            $info['pro_list'] = $list_pro;
            $info['visit_num'] = Project::find(['proid'=>$this->proid])->count();
        }
        return $info;
    }
    
    public function getActexpand()
    {
        return $this->hasMany(Signup::className(), ['hlid' => 'hlid']);
    }
    
    public function getQues()
    {
        return $this->hasMany(Question::className(), ['hlid' => 'hlid']);
    }
    
    public function getLoupan()
    {
        return $this->hasMany(Yuyueloupan::className(), ['hlid' => 'hlid']);
    }
    
    public function getPro()
    {
        return $this->hasMany(Project::className(), ['proid' => 'proid']);
    }
    
    public static function getHomeList($args)
    {
        $p = isset($args['p']) ? $args['p'] : '1';
        $size = isset($args['size']) ? $args['size'] : '2';
        $username = isset($args['username']) ? $args['username'] : '';
        $actid = isset($args['actid']) ? $args['actid'] : '';
        
        $user = User::findOne(['username'=>$username]);
        if($user){
            $proid = $user->proid;
        }
        $where = ['AND'];
        if($proid){
            $where[] = 'proid='."'$proid'";
        }else{
            $where[] = 'proid='."''";
        }
        if($actid){
            $where[] = 'actid='."'$actid'";
        }
        $query = Homepagelog::find()->where($where)->distinct();
        //print_r($query->createCommand()->getRawSql());exit;
        return Pagination::getDataList($query, $p, $size);
    }
    
    //创建的时候确定是什么推广
   public static function CreateHome($args){
        $ret = [];
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $source = isset($args['source']) ? $args['source'] : '';
        $link = isset($args['link']) ? $args['link'] : '';
        $dbTrans = \Yii::$app->db->beginTransaction();
        try {
            $where = ['AND'];
            if($proid){
                $where[] = 'proid='.$proid;
            }
            if($source){
                $where[] = 'source='.$source;
            }
            if($link){
                $where[] = 'link='.$link;
            }else{
                $where[] = 'link=0';
            }
            //是否存在首页
            $isexit_home = Homepagelog::find()->where($where)->one();
            if($isexit_home){
                $ips = CommonTools::getIPAddr();
                $where[] = 'ip='."'$ips'";
                $isexit_homes = Homepagelog::find()->where($where)->one();
                if($isexit_homes){
                    $ret['err'] = $isexit_homes->hlid;
                }else{
                    $pros = new Homepagelog();
                    $pros->proid = $proid;
                    $pros->ip = CommonTools::getIPAddr();
                    if(self::isMobile()){
                        $pros->equip = 1;
                    }else{
                        $pros->equip = 2;
                    }
                    $pros->link = $link;
                    $pros->source = $source;
                    $pros->create = time();
                    $pros->status = '1';
                    //默认是0，0是什么都没有设置
                    $pros->actid = $link;
                    $pros->save();
                    $dbTrans->commit();
                    $ret['err'] = $pros->hlid; 
                }
            }else{
                $pro = new Homepagelog();
                $pro->proid = $proid;
                $pro->ip = CommonTools::getIPAddr();
                if(self::isMobile()){
                    $pro->equip = 1;
                }else{
                    $pro->equip = 2;
                }
                $pro->link = $link;
                $pro->source = $source;
                $pro->create = time();
                $pro->status = '1';
                //默认是0，0是什么都没有设置
                $pro->actid = $link;
                $pro->save();
                $dbTrans->commit();
                $ret['err'] = $pro->hlid;
            }
        } catch (Exception $e) {
            $dbTrans->rollback();
            $ret['err'] = $e->getMessage();
        }
        return $ret;
    }
    
    //判断是手机还是电脑
    public static function isMobile(){
        $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
        function CheckSubstrs($substrs,$text){
            foreach($substrs as $substr){
                if(false!==strpos($text,$substr)){
                    return true;
                }else{
                    return false;
                }
            }
        }
        $mobile_os_list=array('Google Wireless Transcoder','Windows
    
CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','
    
Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
        $mobile_token_list=array
    
        ('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240
    
','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry
    
','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-
    
SGH','Wapaka','DoCoMo','iPhone','iPod');
        $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||
    
        CheckSubstrs($mobile_token_list,$useragent);
        if ($found_mobile){
            return true;
        }else{
            return false;
        }
    }
}
