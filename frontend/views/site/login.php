<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;

$this->title = '网上行';
AppAsset::addCss($this, 'css/font-awesome.min.css');
AppAsset::addCss($this, 'css/reset200802.css');
AppAsset::addCss($this, 'css/login.css');
?>
<div id="content">
     <form action="" method="post">
    <div class="login-header">
        <img src="<?=Yii::getAlias('@web')?>/img/logo.png"/>
    </div>
            <div class="login-input-box">
                <span class="icon fa fa-user"></span>
                <input type="text" name="username" value="<?= $model['username'] ?>"  placeholder="Please enter your email/phone">
            </div>
            <div class="login-input-box">
                <span class=" icon fa fa-lock"></span>
                <input type="password" name="password" value="<?= $model['password'] ?>" placeholder="Please enter your password">
            </div>
        <div class="remember-box">
            <label>
                <input type="checkbox">&nbsp;Remember Me
            </label>
        </div>
        <div class="login-button-box">
            <button type="submit" >登录系统</button>
        </div>
    <div class="logon-box">
        <a href="">Forgot?</a>
        <a href="">Register</a>
    </div>
    </form>
</div>
