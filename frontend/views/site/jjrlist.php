<?php

/* @var $this yii\web\View */
use frontend\assets\AppAsset;
$this->title = '经纪人列表';
AppAsset::addScript($this,'js/pageagent/jjrlist.js');
?>
<div class="site-index">
    <div class="jumbotron">
       欢迎来到网上行行销系统
       这是经纪人列表
    </div>
<table class="table" id="info">
    <tr>
        <th>编号</th>
        <th>主页id</th>
        <th>电话</th>
        <th>姓名</th>
        <th>创建时间</th>
    </tr>
    <tr v-for="item in jjrinfo">
        <td>{{item.agentid}}</td>
        <td>{{item.hlid}}</td>
        <td>{{item.phone}}</td>
        <td>{{item.username}}</td>
        <td>{{item.create}}</td>
    </tr>
</table>
</div>
<script type="text/javascript">
    var hlid ="<?= isset($_GET['hlid']) ? $_GET['hlid'] : '';?>";
</script>