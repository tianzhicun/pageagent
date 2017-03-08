<?php
namespace frontend\components\api\module;


use app\models\agent\Project;
use app\models\agent\Erweima;
use app\models\agent\Link;
use app\models\agent\Homepagelog;
use app\models\agent\Signup;
use app\models\agent\Yuyueloupan;
use app\models\agent\Question;
class PageAgentApi extends BaseAdapter
{
    //快马基础接口
    public function behaviors()
    {
        return [
            'access' => [
                'class' => ApiFilter::className(),
                'rules' => [
                    [
                        'actions' => [
                            // 创建或修改公司子表
                            'create_pro' => [
                               'proid'=>false,
                               'cpmpany'=>true,
                               'name'=>true,
                            ],
                            // 获取项目列表
                            'get_pro_list' => [
                                'p' => false,
                                'size' => false,
                                'proid' => false,
                            ],
                            // 创建或修改二维码
                            'create_erweima' => [
                                'proid'=>false,
                                'keyword'=>false,
                                'erweima'=>false,
                            ],
                            // 获取二维码列表
                            'get_erweima_list' => [
                                'p' => false,
                                'size' => false,
                                'erid' => false,
                                'proid' => false,
                            ],
                            // 创建或修改链接
                            'create_link' => [
                                'proid'=>false,
                                'keyword'=>true,
                                'link'=>true,
                            ],
                            // 获取链接列表
                            'get_link_list' => [
                                'p' => false,
                                'size' => false,
                                'lid' => false,
                                'proid' => false,
                            ],
                            'bind_pro'=>[
                                'proid' => false,
                                'proname' => false,
                            ],
                            'bind_act'=>[
                                'proid' => false,
                                'proname' => false,
                            ],
                            'get_home_list'=>[
                                'size'=>false,
                                'p' => false,
                                'username'=>false,
                                'actid'=>false,
                            ],
                            //成为经纪人
                            'create_agent'=>[
                                'username' => false,
                                'phone' => false,
                                'source' => false,
                                'proid' => false,
                            ],
                            //根据来源和项目id创建主页表
                            'create_home'=>[
                                'source' => false,
                                'proid' => false,
                                'link' => false,
                            ],
                            //预约楼盘
                            'create_loupan'=>[
                                'username' => false,
                                'phone' => false,
                                'yuyuedate'=>false,
                                'source' => false,
                                'proid' => false,
                            ],
                            //预约楼盘
                            'create_ques'=>[
                                'username' => false,
                                'question' => false,
                                'source' => false,
                                'proid' => false,
                            ],
                            'get_jjr_list' =>[
                                'hlid'=>false,
                            ],
                            'get_ques_list' =>[
                                'hlid'=>false,
                            ],
                            'get_loupan_list' =>[
                                'hlid'=>false,
                            ],
                            //获取开发商后台推广分类
                            'get_type_list' =>[
                            ],
                            //增加页面的访问数目
                            'add_new_num' =>[
                               'proid'=>false,
                            ],
                        ]
                    ],
                    [
                        'roles' => [
                            '@'
                        ],
                        'actions' => []
                    ]
                ]
            ]
        ];
    }

    
    public function actionCreate_pro()
    {
        $code = self::CODE_SUCCESS;
        $data = Project::CreatePro($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionGet_pro_list(){
        $code = self::CODE_SUCCESS;
        $data = Project::getProList($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionCreate_erweima()
    {
        $code = self::CODE_SUCCESS;
        $data = Erweima::CreateErweima($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionGet_erweima_list(){
        $code = self::CODE_SUCCESS;
        $data = Erweima::getErweimaList($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionCreate_link()
    {
        $code = self::CODE_SUCCESS;
        $data = Link::CreateLink($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionGet_link_list(){
        $code = self::CODE_SUCCESS;
        $data = Link::getLinkList($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionBind_pro(){
        $code = self::CODE_SUCCESS;
        $data = Project::bindPro($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionBind_act(){
        $code = self::CODE_SUCCESS;
        $data = Project::bindAct($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionGet_home_list(){
        $code = self::CODE_SUCCESS;
        $data = Homepagelog::getHomeList($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionCreate_agent(){
        $code = self::CODE_SUCCESS;
        $data = Signup::createAgent($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionCreate_loupan(){
        $code = self::CODE_SUCCESS;
        $data = Yuyueloupan::createLoupan($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionCreate_ques(){
        $code = self::CODE_SUCCESS;
        $data = Question::createQues($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionCreate_home(){
        $code = self::CODE_SUCCESS;
        $data = Homepagelog::createHome($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionGet_jjr_list(){
        $code = self::CODE_SUCCESS;
        $data = Signup::getJjrList($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionGet_loupan_list(){
        $code = self::CODE_SUCCESS;
        $data = Yuyueloupan::getLoupanList($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionGet_ques_list(){
        $code = self::CODE_SUCCESS;
        $data = Question::getQuesList($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionGet_type_list(){
        $code = self::CODE_SUCCESS;
        $data = Project::getTypeList($_POST);
        return [
            $code,
            $data
        ];
    }
    
    public function actionAdd_new_num(){
        $code = self::CODE_SUCCESS;
        $data = Project::addNewVisit($_POST);
        return [
            $code,
            $data
        ];
    }
}