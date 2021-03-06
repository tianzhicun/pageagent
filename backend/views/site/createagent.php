<?php

use yii\helpers\Url;
use backend\assets\AppAsset;
/* @var $this yii\web\View */

$this->title = '成为经纪人';
AppAsset::addScript($this,'js/pageagent/createagent.js');
?>

<style>
    h1{
        text-align: center;
    }
    .submit-btn{
        text-align: center;
    }
    .btn{
        margin-left: 60px;
    }
</style>
<div class="site-index">
    <div class="jumbotron">
      成为经纪人
    </div>
       <div class='index' style="padding-left: 1000px;">
      <a href="<?= Url::to(['site/createagent','proid'=>$_GET['proid'],'source'=>$_GET['source']])?>"><button type="button" class="btn btn-primary">成为经纪人</button></a></br>
      <a href=""><button type="button" class="btn btn-primary">一键导航</button></a></br>
      <a href=""><button type="button" class="btn btn-primary">一键拨号</button></a>
      <a href="<?= Url::to(['site/index','proid'=>$_GET['proid'],'source'=>$_GET['source']])?>"><button type="button" class="btn btn-primary">回到首页</button></a>
      </div>
</div>
<h1>成为经纪人</h1>
<br>
<div class="form-horizontal" id="info">
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-10">
            <input  id="username" type="text" class="form-control" v-model="username">
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">电话</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" v-model="phone">
        </div>
    </div>
    <div class="submit-btn">
        <button type="button" class="btn btn-success btn-lg" v-on:click="submit">提 交</button>
        <button type="button" class="btn btn-warning btn-lg" v-on:click="cancel">返 回</button>
    </div>
</div>
<script type="text/javascript">
    var proid ="<?= isset($model['proid']) ? $model['proid'] : '';?>";
    var source ="<?= isset($model['source']) ? $model['source'] : '';?>";
</script>
