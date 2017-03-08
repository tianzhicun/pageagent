<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use frontend\assets\AppAsset;
$this->title = '网上行';
AppAsset::addScript($this,'js/pageagent/erweima.js');
?>
<div class="site-index">
    <div class="jumbotron">
       欢迎来到网上行行销系统
       这是管理员后台
    </div>
        <h1>项目信息列表</h1>
    <a href="<?= Url::to(['site/createerweima','proid'=>$_GET['proid']])?>"><button type="button" class="btn btn-primary">新增二维码</button></a>
<table class="table" id="info">
    <tr>
        <th>二维码编号</th>
        <th>项目编号</th>
        <th>二维码关键词</th>
        <th>二维码</th>
        <th>创建时间</th>
    </tr>
    <tr v-for="item in erweimainfo">
        <td>{{item.erid}}</td>
        <td>{{item.proid}}</td>
        <td>{{item.keyword}}</td>
        <td><img alt="二维码" src="http://pageangent.yuntumedia.com{{item.erweima}}"/>
        </td>
        <td>{{item.create}}</td>
    </tr>
</table>
</div>
<script type="text/javascript">
    var proid ="<?= isset($_GET['proid']) ? $_GET['proid'] : '';?>";
</script>