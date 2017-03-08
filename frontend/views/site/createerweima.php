<?php

use frontend\assets\AppAsset;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '网上行';
AppAsset::addCss($this,'css/admindex.css');
AppAsset::addScript($this,'js/pageagent/createerweima.js');
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
<h1>创建二维码</h1>
<br>
<div class="form-horizontal" id="info">
    <div class="form-group">
        <label for="keyword" class="col-sm-2 control-label">二维码关键词</label>
        <div class="col-sm-10">
            <input  id="keyword" type="text" class="form-control" v-model="keyword">
        </div>
    </div>
    <div class="form-group">
        <label for="erweima" class="col-sm-2 control-label">二维码链接</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" v-model="erweima">
        </div>
    </div>
    <div class="submit-btn">
        <button type="button" class="btn btn-success btn-lg" v-on:click="submit">提 交</button>
        <button type="button" class="btn btn-warning btn-lg" v-on:click="cancel">返 回</button>
    </div>
</div>
<script type="text/javascript">
    var proid ="<?= isset($_GET['proid']) ? $_GET['proid'] : '';?>";
</script>