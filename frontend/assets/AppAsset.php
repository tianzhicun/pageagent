<?php

namespace frontend\assets;

use common\base\BaseAsset;

/**
 * Main horsespread application asset bundle.
 */
class AppAsset extends BaseAsset
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
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
}
