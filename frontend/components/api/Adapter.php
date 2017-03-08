<?php
namespace frontend\components\api;

use frontend\components\api\module\BaseAdapter;
use frontend\components\api\module\PageAgentApi;

class Adapter extends BaseAdapter
{

    const MODULE_PAGEAGENT = 'PAGEAGENT';

    public $auth = [];

    public function actions()
    {
        return [
            self::MODULE_PAGEAGENT => [ 
                'class' => PageAgentApi::className()
            ],
        ];
    }

    public function handle($path)
    {
        header('Access-Control-Allow-Origin: *');
        $ret = self::getCodeArray(self::CODE_ERROR_UNKNOW);
        if ($path) {
            $args = explode('/', $path);
            if (sizeof($args) > 1 && isset($this->auth[$args[0]])) {
                $ret = $this->runAction(strtoupper($args[0]), $args[1]);
            } else {
                $ret = self::getCodeArray(self::CODE_ERROR_AUTH);
            }
        }
        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    }
}