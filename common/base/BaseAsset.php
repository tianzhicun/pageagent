<?php
namespace common\base;

use yii\web\AssetBundle;

class BaseAsset extends AssetBundle
{
    // 定义按需加载js方法，注意加载顺序在最后
    public static function addScript($view, $jsfile)
    {
        $view->registerJsFile(\Yii::getAlias('@web/') . $jsfile, [
            get_called_class(),
            'depends' => get_called_class()
        ]);
    }
    
    // 定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile)
    {
        $view->registerCssFile(\Yii::getAlias('@web/') . $cssfile, [
            get_called_class(),
            'depends' => get_called_class()
        ]);
    }
}