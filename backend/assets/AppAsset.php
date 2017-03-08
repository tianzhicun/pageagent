<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/utiljs/jquery/jquery-3.1.1.min.js',
        'js/utiljs/underscore/underscore-min.js',
        'js/api.js',
        'js/mobile.js',
        'js/vue.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
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