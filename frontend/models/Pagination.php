<?php

namespace app\models;

use yii\db\Query;
class Pagination
{
    public static function getDataList(Query $query, $p, $size,$actid = NULL){
        $count = $query->count();
        $data_list = $query->offset(($p -1) * $size)->limit($size)->all();
        $list = [];
        foreach ($data_list as $data){
            $list[] = $data->getInfo($actid);
        }
        $total = ceil($count/$size);
        return [
            'cur' => $p,
            'size' => $size,
            'total' => $total,
            'count' => $count,
            'list' => $list
        ];
    }
    
    public static function getDataLists(Query $query, $p, $size,$actid = NULL){
        $count = $query->count();
        $data_list = $query->offset(($p -1) * $size)->limit($size)->all();
        $list = [];
        foreach ($data_list as $data){
            $list[] = $data->getInfos($actid);
        }
        $newarr = array();
        foreach($list as $_arr){
            if(!isset($newarr[$_arr['name']])){
                $newarr[$_arr['name']] = $_arr;
            }
        }
        $total = ceil($count/$size);
        return [
            'cur' => $p,
            'size' => $size,
            'total' => $total,
            'count' => $count,
            'list' => $newarr
        ];
    }
    
    public static function getActConfig(Query $query){
        $data_list = $query->one();
        $configs = $data_list->getInfo();
        return $configs;
    }
}