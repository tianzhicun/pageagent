<?php

use yii\helpers\Url;
use backend\assets\AppAsset;
use app\models\agent\Project;
/* @var $this yii\web\View */

$this->title = '首页';
AppAsset::addScript($this,'js/pageagent/index.js');

session_start();
if( !isset($_COOKIE["user"]) ){
    setcookie("user","newGuest",time()+3600*24);
    $newvisit = true;
}else {
    setcookie("user","oldGuest");
}
?>
<div class="site-index">

    <div class="jumbotron">
      首页
    </div>
      <div class='index' id="info" style="padding-left: 1000px;">
          <a href="<?= Url::to(['site/createagent','proid'=>$_GET['proid'],'source'=>$_GET['source']])?>"><button type="button" class="btn btn-primary">成为经纪人</button></a></br>
          <a href="<?= Url::to(['site/createloupan','proid'=>$_GET['proid'],'source'=>$_GET['source']])?>"><button type="button" class="btn btn-primary">预约楼盘</button></a></br>
          <a href="<?= Url::to(['site/createques','proid'=>$_GET['proid'],'source'=>$_GET['source']])?>"><button type="button" class="btn btn-primary">我要提问</button></a></br>
          <a href=""><button type="button" class="btn btn-primary">一键导航</button></a></br>
          <a href=""><button type="button" class="btn btn-primary">一键拨号</button></a>
          <a href="<?= Url::to(['site/index','proid'=>$_GET['proid'],'source'=>$_GET['source']])?>"><button type="button" class="btn btn-primary">回到首页</button></a>
     </div>
</div>
<script type="text/javascript">
    var proid ="<?= isset($model['proid']) ? $model['proid'] : '';?>";
    var source ="<?= isset($model['source']) ? $model['source'] : '';?>";
    var link ="<?= isset($model['link']) ? $model['link'] : '';?>";
    var newvisit= "<?= isset($newvisit) ? $newvisit : false;?>";
</script>






















