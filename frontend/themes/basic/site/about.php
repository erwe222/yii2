<?php
   /* @var $this yii\web\View */
   use yii\helpers\Html;
   $this->title = 'About';
   $this->params['breadcrumbs'][] = $this->title;
   $this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, developing,
      views, meta, tags']);
   $this->registerMetaTag(['name' => 'description', 'content' => 'This is the
      description of this page!'], 'description');
?>

<div class = "site-about">
   <h1><?= Html::encode($this->title) ?></h1>
	sadsa
   <p style = "color: red;"> 这是一个“关于页面”，现在正在使用的视图文件是：<pre><?php echo __FILE__;?></pre> </p> 
</div>