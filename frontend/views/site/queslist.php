<?php

/* @var $this yii\web\View */
use frontend\assets\AppAsset;
$this->title = '经纪人列表';
AppAsset::addScript($this,'js/pageagent/queslist.js');
?>
<div class="site-index">
    <div class="jumbotron">
       欢迎来到网上行行销系统
       这是提问列表列表
    </div>
<table class="table" id="info">
    <tr>
        <th>编号</th>
        <th>主页id</th>
        <th>提问问题</th>
        <th>提问者名称</th>
        <th>开发商回答</th>
        <th>回答时间</th>
        <th>创建时间</th>
    </tr>
    <tr v-for="item in jjrinfo">
        <td>{{item.qid}}</td>
        <td>{{item.hlid}}</td>
        <td>{{item.question}}</td>
        <td>{{item.username}}</td>
        <td>{{item.answer||'2016-12-25号刚刚开盘'}}</td>
         <td>{{item.create}}</td>
        <td>{{item.create}}</td>
    </tr>
</table>
</div>
<script type="text/javascript">
    var hlid ="<?= isset($_GET['hlid']) ? $_GET['hlid'] : '';?>";
</script>