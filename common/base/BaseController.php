<?php
namespace common\base;

use yii\web\Controller;
use yii\web\HttpException;
use yii\base\UserException;

class BaseController extends Controller
{
    public function actionError(){
        $this->getView()->title = "错误页面";
        $this->layout = false;
        
        if (($exception = \Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, \Yii::t('yii', 'Page not found.'));
        }
        
        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($exception instanceof \Exception) {
            $name = $exception->getName();
        } else {
            $name = $this->defaultName ?: \Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }
        
        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = $this->defaultMessage ?: \Yii::t('yii', 'An internal server error occurred.');
        }
        return $this->render('error', [
            'name' => $name,
            'message' => $message,
            'exception' => $exception
        ]);
    }
}