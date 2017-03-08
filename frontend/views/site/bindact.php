<?php

use frontend\assets\AppAsset;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '网上行';
AppAsset::addCss($this,'css/admindex.css');
AppAsset::addScript($this,'js/pageagent/bindact.js');
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
<h1>绑定活动</h1>
<br>
<div class="form-horizontal" id="info">
    <div class="form-group">
        <label for="proname" class="col-sm-2 control-label">绑定活动名称</label>
        <div class="col-sm-10">
            <input  id="proname" type="text" class="form-control" v-model="proname">
        </div>
    </div>
    <div class="submit-btn">
        <button type="button" class="btn btn-success btn-lg" v-on:click="submit">提 交</button>
        <button type="button" class="btn btn-warning btn-lg" v-on:click="cancel">返 回</button>
    </div>
</div>
<script type="text/javascript">
    var proid ="<?= isset($model['proid']) ? $model['proid'] : '';?>";
</script>
