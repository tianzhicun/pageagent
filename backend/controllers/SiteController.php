<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'error','createagent','createloupan','createques'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
        ];
    }

    public function actionIndex()
    {
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $source = isset($_GET['source']) ? $_GET['source'] : '';
        $link = isset($_GET['link']) ? $_GET['link'] : '';
        $model = [
            'proid'=>$proid,
            'source'=>$source,
            'link' =>$link,
        ];
        return $this->render('index',['model'=>$model]);
    }
    
    public function actionCreateagent()
    {
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $source = isset($_GET['source']) ? $_GET['source'] : '';
        $model = [
            'proid'=>$proid,
            'source'=>$source,
        ];
        return $this->render('createagent',['model'=>$model]);
    }
    
    public function actionCreateloupan()
    {
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $source = isset($_GET['source']) ? $_GET['source'] : '';
        $model = [
            'proid'=>$proid,
            'source'=>$source,
        ];
        return $this->render('createloupan',['model'=>$model]);
    }
    
    public function actionCreateques()
    {
        $proid = isset($_GET['proid']) ? $_GET['proid'] : '';
        $source = isset($_GET['source']) ? $_GET['source'] : '';
        $model = [
            'proid'=>$proid,
            'source'=>$source,
        ];
        return $this->render('createques',['model'=>$model]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
