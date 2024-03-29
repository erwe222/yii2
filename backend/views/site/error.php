<?php
use yii\helpers\Html;
$this->title = $name;
?>
<nav class="breadcrumb">
    <i class="Hui-iconfont"></i> <a href="/" class="maincolor">首页</a> 
    <span class="c-999 en">&gt;</span><span class="c-666">空白页</span>
</nav>
<div class="Hui-article">
        <article class="cl pd-20">
                <section class="page-404 minWP text-c">
                  <p class="error-title"><i class="Hui-iconfont va-m" style="font-size:80px">&#xe656;</i><span class="va-m"> <?= $name ?></span></p>
                  <p class="error-description"><?= nl2br(Html::encode($message)) ?></p>
                  <p class="error-info">您可以：<a href="javascript:;" onclick="history.go(-1)" class="c-primary">&lt; 返回上一页</a><span class="ml-20">|</span><a href="/" class="c-primary ml-20">去首页 &gt;</a></p>
                </section>
        </article>
</div>
