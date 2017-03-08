<?php

use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::addScript($this,'js/pageagent/createques.js');
/* @var $this yii\web\View */

$this->title = '提问';
?>
<div class="site-index">
    <div class="jumbotron">
    
      首页
    </div>
          <div class='index' style="padding-left: 1000px;">
      <a href="<?= Url::to(['site/createques','proid'=>$_GET['proid'],'source'=>$_GET['source']])?>"><button type="button" class="btn btn-primary">我要提问</button></a></br>
      <a href=""><button type="button" class="btn btn-primary">一键导航</button></a></br>
      <a href=""><button type="button" class="btn btn-primary">一键拨号</button></a>
      <a href="<?= Url::to(['site/index','proid'=>$_GET['proid'],'source'=>$_GET['source']])?>"><button type="button" class="btn btn-primary">回到首页</button></a>
      </div>
</div>
<div class="form-horizontal" id="info">
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-10">
            <input  id="username" type="text" class="form-control" v-model="username">
        </div>
    </div>
    <div class="form-group">
        <label for="question" class="col-sm-2 control-label">提问问题</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" v-model="question">
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






















