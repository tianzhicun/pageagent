<?php
namespace common\base;

use yii\filters\AccessRule;

class BaseAccessRule extends AccessRule
{

    public $allow = true;

    public function allows($action, $user, $request)
    {
        if (null === $this->matchAction($action)){
            return null;
        }
        if ($this->matchAction($action) 
            && $this->matchRole($user) 
            && $this->matchIP($request->getUserIP()) 
            && $this->matchVerb($request->getMethod()) 
            && $this->matchController($action->controller) 
            && $this->matchCustom($action)) {
            return $this->allow ? true : false;
        } else {
            return $this->allow ? false : true;
        }
    }

    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        $userIdentify = $user->identity;
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (! $user->getIsGuest()) {
                    return true;
                }
            } elseif ($userIdentify) {
                if ($userIdentify->type === $role) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     *
     * @return true|false|null 匹配|不匹配|action不在匹配规则内
     *        
     */
    protected function matchAction($action)
    {
        $ret = null;
        if (empty($this->actions)) {
            $ret = true;
        } elseif (isset($this->actions[$action->id])){
            $ret = $this->checkArgs($_POST, $this->actions[$action->id]);
        } elseif (in_array($action->id, $this->actions, true)) {
            $ret = true;
        }
        return $ret;
    }

    public function checkArgs($args, $arr_option)
    {
        $ret = true;
        foreach ($arr_option as $k => $v) {
            if(is_array($v)){
                if($v[0] && ! $this->checkArgs($args[$k], $v[1])){
                    $ret = false;
                    break;
                }
            }elseif($v && ! isset($args[$k])) {
                $ret = false;
                break;
            }
        }
        return $ret;
    }
}