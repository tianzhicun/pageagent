<?php

use frontend\assets\AppAsset;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '网上行';
AppAsset::addCss($this,'css/admindex.css');
AppAsset::addScript($this,'js/pageagent/admindex.js');

?>
<div class="site-index">

    <div class="jumbotron">
       欢迎来到网上行行销系统
       这是管理员后台
    </div>
        <h1>项目信息列表</h1>
    <a href="<?= Url::to(['site/createpro'])?>"><button type="button" class="btn btn-primary">新增项目</button></a>
<table class="table" id="info">
    <tr>
        <th>项目编号</th>
        <th>公司名称</th>
        <th>项目名称</th>
        <th>创建时间</th>
        <th>项目二维码</th>
        <th>项目链接</th>
        <th>绑定开发商</th>
        <th>绑定活动</th>
    </tr>
    <tr v-for="item in proinfo">
        <td>{{item.proid}}</td>
        <td>{{item.company}}</td>
        <td>{{item.name}}</td>
        <td>{{item.create}}</td>
        <td>
            <a type="button" class="btn btn-warning btn-xs" href="erweima?proid={{item.proid}}">添加二维码</a>
        </td>
        <td>
            <a type="button" class="btn btn-warning btn-xs" href="link?proid={{item.proid}}">添加链接</a>
        </td>
         <td>
            <a type="button" class="btn btn-warning btn-xs" href="bindpro?proid={{item.proid}}">绑定开发商</a>
        </td>
        <td>
            <a type="button" class="btn btn-warning btn-xs" href="bindact?proid={{item.proid}}">绑定活动</a>
        </td>
    </tr>
</table>
</div>
