<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use frontend\models\SignupForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout', 'signup'],
                'rules' => [
                    [
                    'actions' => ['login', 'signup','error','index','api'],
                    'allow' => true,
                    ],
                    [
                        'actions' => ['loupanlist','queslist','jjrlist','bindpro','bindact','logout','backend','devindex','admindex','createpro','erweima','link','createerweima','createlink'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays 默认首页.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    //开发商首页
    public function actionDevindex()
    {
        $username =  Yii::$app->user->identity->username;
        $model = [
            'username'=>$username,
        ];
        return $this->render('devindex',['model'=>$model]);
    }
    
    //管理员首页
    public function actionAdmindex()
    {
        return $this->render('admindex');
    }
    

    /**
     * 登录
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            $this->redirect('@web/site/backend');
        } else {
            //print_r('111');exit;
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionBackend(){
        switch (Yii::$app->user->identity->username) {
            case 'wsx':
                $this->redirect("@web/site/admindex" );
                break;
            default:
                $this->redirect("@web/site/devindex");
                break;
        }
    }
    
    //管理员创建项目
    public function actionCreatepro(){
        return $this->render('createpro');
    }

    /**
     * 退出
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * 注册
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    //return $this->goHome();
                    return $this->redirect('@web/site/backend');
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    //api请求
    public function actionApi($path = null)
    {
        Yii::$app->api->handle($path);
    }
    
    public function actionErweima(){
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $model = [
            'proid'=>$proid,
        ];
        return $this->render('erweima',['model'=>$model]);
    }
    
    public function actionLink(){
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $model = [
            'proid'=>$proid,
        ];
        return $this->render('link',['model'=>$model]);
    }
    
    public function actionBindpro(){
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $model = [
            'proid'=>$proid,
        ];
        return $this->render('bindpro',['model'=>$model]);
    }
    
    public function actionBindact(){
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $model = [
            'proid'=>$proid,
        ];
       // print_r($model);exit;
        return $this->render('bindact',['model'=>$model]);
    }
    
    //经纪人列表
    public function actionJjrlist(){
        $hlid = isset($_GET['hlid']) ? $_GET['hlid'] : '';
        $model = [
            'hlid'=>$hlid,
        ];
        return $this->render('jjrlist',['model'=>$model]);
    }
    
    public function actionQueslist(){
        $hlid = isset($_GET['hlid']) ? $_GET['hlid'] : '';
        $model = [
            'hlid'=>$hlid,
        ];
        return $this->render('queslist',['model'=>$model]);
    }
    
    public function actionLoupanlist(){
        $hlid = isset($_GET['hlid']) ? $_GET['hlid'] : '';
        $model = [
            'hlid'=>$hlid,
        ];
        return $this->render('loupanlist',['model'=>$model]);
    }
    
    public function actionCreateerweima(){
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $model = [
            'proid'=>$proid,
        ];
        return $this->render('createerweima',['model'=>$model]);
    }
    
    public function actionCreatelink(){
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $model = [
            'proid'=>$proid,
        ];
        return $this->render('createlink',['model'=>$model]);
    }
}
