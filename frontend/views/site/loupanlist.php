<?php

/* @var $this yii\web\View */
use frontend\assets\AppAsset;
$this->title = '预约楼盘列表列表';
AppAsset::addScript($this,'js/pageagent/loupanlist.js');
?>
<div class="site-index">
    <div class="jumbotron">
       欢迎来到网上行行销系统
       这是预约楼盘列表
    </div>
<table class="table" id="info">
    <tr>
        <th>编号</th>
        <th>主页id</th>
        <th>电话</th>
        <th>姓名</th>
        <th>预约时间</th>
        <th>创建时间</th>
    </tr>
    <tr v-for="item in jjrinfo">
        <td>{{item.yid}}</td>
        <td>{{item.hlid}}</td>
        <td>{{item.phone}}</td>
        <td>{{item.username}}</td>
        <td>{{item.yuyuedate}}</td>
        <td>{{item.create}}</td>
    </tr>
</table>
</div>
<script type="text/javascript">
    var hlid ="<?= isset($_GET['hlid']) ? $_GET['hlid'] : '';?>";
</script>