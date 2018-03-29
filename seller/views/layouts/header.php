<?php
use yii\helpers\Url;
?>
<div class="layui-header">
    <div class="layui-logo" style="font-weight:bold;font-size:24px;">商家后台</div>
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
          <a href="javascript:;" style="color:red;">
          <img src="" class="cus-header-img layui-nav-img layui-anim layui-anim-rotate" data-anim="layui-anim-rotate">
          <?php echo Yii::$app->view->params['seller_info']['username']?>
        </a>
        <dl class="layui-nav-child">
            <dd><a href="<?= Url::toRoute('user/my-info')?>">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
          <dd id="cus-to-logout"><a href="javascript:void(0)">退出登录</a></dd>
        </dl>
      </li>
    </ul>
  </div>