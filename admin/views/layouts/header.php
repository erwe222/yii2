<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
?>
<div class="layui-header">
    <div class="layui-logo" style="font-weight:bold;font-size:24px;">后台管理</div>
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">商品管理</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">系统信息</a></dd>
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">
                <i class="layui-icon" >&#xe61b;</i> 皮肤<span class="layui-nav-more"></span></a>
            <dl class="layui-nav-child skin layui-anim layui-anim-upbit">
                <dd><a href="javascript:;" data-skin="default" style="color:#393D49;"><i class="layui-icon"></i> 默认</a></dd>
                <dd><a href="javascript:;" data-skin="orange" style="color:#ff6700;"><i class="layui-icon"></i> 橘子橙</a></dd>
                <dd><a href="javascript:;" data-skin="green" style="color:#00a65a;"><i class="layui-icon"></i> 原谅绿</a></dd>
                <dd><a href="javascript:;" data-skin="pink" style="color:#FA6086;"><i class="layui-icon"></i> 少女粉</a></dd>
                <dd><a href="javascript:;" data-skin="blue.1" style="color:#00c0ef;"><i class="layui-icon"></i> 天空蓝</a></dd>
                <dd><a href="javascript:;" data-skin="red" style="color:#dd4b39;"><i class="layui-icon"></i> 枫叶红</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:;" style="color:red;">
                <img src="<?php echo ArrayHelper::getValue(Yii::$app->view->params['seller_info'], 'image','/assets/custom/images/center-photo.png');?>" class="cus-header-img layui-nav-img layui-anim layui-anim-rotate" data-anim="layui-anim-rotate">
                <?php echo ArrayHelper::getValue(Yii::$app->view->params['seller_info'], 'username','---');?>
            </a>
            <dl class="layui-nav-child">
                <dd><a href="<?= Url::toRoute('user/my-info')?>">基本资料</a></dd>
              <dd><a href="">安全设置</a></dd>
              <dd id="cus-to-logout"><a href="javascript:void(0)">退出登录</a></dd>
            </dl>
         </li>
    </ul>
  </div>