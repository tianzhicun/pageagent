<?php
namespace common\base;

use yii\filters\AccessControl;

class BaseAccessControl extends AccessControl
{

    public $ruleConfig = [
        'class' => 'common\base\BaseAccessRule'
    ];

    protected function denyAccess($user)
    {
        if ($user->getIsGuest()) {
            $user->loginRequired();
        } else {
            return \Yii::$app->getResponse()->redirect(\Yii::$app->getHomeUrl());
        }
    }
}