<?php

namespace app\models\agent;

use Yii;
use app\models\Pagination;

/**
 * This is the model class for table "{{%question}}".
 *
 * @property integer $qid
 * @property integer $hlid
 * @property string $question
 * @property string $answer
 * @property string $username
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
    
    public function getInfo()
    {
        $info = [
            'qid' => $this->qid,
            'hlid' => $this->hlid,
            'question' => $this->question,
            'status' => $this->status,
            'create' => date('Y-m-d H:i:s',$this->create),
            'anwsertime' => date('Y-m-d H:i:s',$this->anwsertime),
            'ifanwser' => $this->ifanwser,
            'username' => $this->username,
        ];
        return $info;
    }
    
    public static function createQues($args)
    {
        $ret = [];
        $proid = isset($args['proid']) ? $args['proid'] : '';
        $source = isset($args['source']) ? $args['source'] : '';
        $question = isset($args['question']) ? $args['question'] : '';
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
            //是否存在首页
            $isexit_home = Homepagelog::find()->where($where)->one();
            if($isexit_home){
                $whereand = ['AND'];
                if($question){
                    $whereand[] = "question='$question'";
                }
                if($username){
                    $whereand[] =  "username='$username'";
                }
                //判断是否已经预约了楼盘
                $if_agent = Question::find()->where($whereand)->one();
                if($if_agent){
                    $ret['err'] = '您已经提问过了';
                }else{
                    $agent = new Question();
                    $agent->hlid = $isexit_home->hlid;
                    $agent->question = $question;
                    $agent->username = $username;
                    $agent->answer = '';
                    $agent->create = time();
                    $agent->ifanwser = 0;
                    $agent->save();
                    $dbTrans->commit();
                    $ret['qid'] = $agent->qid;
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
    
    public static function getQuesList($args)
    {
        $size = isset($args['size']) ? $args['size'] : '1000';
        $p = isset($args['p']) ? $args['p'] : '1';
        $hlid = isset($args['hlid']) ? $args['hlid'] : '';
         
        $where = ['AND'];
        if($hlid){
            $where[] = 'hlid='."'$hlid'";
        }
        $query = Question::find()->where($where)->distinct();
        return Pagination::getDataList($query, $p, $size);
    }
}
