<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//判断是否是登录页面
if (Yii::$app->controller->action->id === 'login') {
    echo $this->render('main-login',['content' => $content]);
} else {
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo ArrayHelper::getValue(Yii::$app->params, 'domain_name','---');?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/assets/plug/layui/css/layui.css"  media="all">
    <style>
        a{text-decoration: none !important;}
    </style>
    <link href="/assets/plug/pace/pace-theme-barber-shop.css" rel="stylesheet"/>
    <!--<link href="/assets/custom/css/blue_skin.css" rel="stylesheet"/>-->
    <script src="/assets/plug/pace/pace.min.js" ></script>
    <script src="/assets/custom/js/jquery.min.js" ></script>
</head>
    <body class="layui-layout-body">
        <div class="layui-layout layui-layout-admin">
            <?php $this->beginBody() ?>
                <!--头部布局文件-->
                <?= $this->render('header.php') ?>

                <!--导航栏布局文件-->
                <?= $this->render('left.php') ?>

                <!--主体内容布局文件-->
                <div class="layui-body" >
                   <div style="padding: 15px;">
                        <!--<div style="width:100px;min-height: 20px;background:#ccc;position:fixed;right:5px;padding:5px;">
                            <div style="text-align:center;font-weight: bold;" id="cus-nav">工具条 <span style="display: inline-block;float: right;" id="cus-nev-tubiao">▲</span></div>
                            <ul style="margin-top: 15px;display: none;" id="cus-nav-ul">
                                <li><a onclick="colorPicker()"><input id="full"   type="hidden" />拾色器</a></li>
                            </ul>
                        </div>-->
                        <?= \admin\widgets\BreadcrumbWidget::widget();?>
                      <?= $this->render('content.php',['content' => $content]) ?>
                    </div>
                </div>
                
                <div class="layui-footer" style="text-align: center;color: #6693C2;"> © ydong.xin - 远购网</div>
            <?php $this->endBody() ?>
        </div>
        <script src="/assets/plug/layui/layui.all.js" charset="utf-8"></script>
        
        
        <!--<script src="/assets/plug/bootstrap3-editable/js/bootstrap-editable.js"></script>-->
        <link rel="stylesheet" type="text/css" href="/assets/plug/color-picker/spectrum.css">
        <script type="text/javascript" src="/assets/plug/color-picker/spectrum.js"></script>
        <script type='text/javascript' src='/assets/plug/color-picker/prettify.js'></script>
        <script type='text/javascript' src='/assets/plug/color-picker/toc.js'></script>
        <script type='text/javascript' src='/assets/plug/color-picker/docs.js'></script>
        <script>
            $('#cus-nav').on('click',function(){
                if($('#cus-nav-ul').css('display') == 'block'){
                    $('#cus-nev-tubiao').html('▼');
                    $('#cus-nav-ul').hide();
                }else{
                    $('#cus-nav-ul').show();
                    $('#cus-nev-tubiao').html('▲');
                }
            });
        </script>
        <script>
            //演示动画
            $('.cus-header-img').on('mouseover', function(){
              var othis = $(this), anim = othis.data('anim');

              //停止循环
              if(othis.hasClass('layui-anim-loop')){
                return othis.removeClass(anim);
              }

              othis.removeClass(anim);

              setTimeout(function(){
                othis.addClass(anim);
              });
              //恢复渐隐
              if(anim === 'layui-anim-fadeout'){
                setTimeout(function(){
                  othis.removeClass(anim);
                }, 1300);
              }
            });
            
            //退出操作
            $('#cus-to-logout').on('click',function(){
                layer.msg('您确定要退出登录吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['退出', '取消']
                    ,yes: function(index){
                        layer.close(index);
                        layer.msg('退出中,请稍等...', {time: 0,icon: 16,shade: 0.01});
                        $.ajax({
                              url:'/login/logout',
                              type:'post',
                              dataType:'json',
                              success:function(res){
                                  console.log(res);
                                  if(res.code == 200){
                                      window.location.href = '/login/login';
                                      return false;
                                  }
                              }
                        });
                    }
                });
            });
            
            $('#cus-reload-current').on('click',function(){
                
                $(this).html('<i class="layui-icon layui-anim layui-anim-rotate layui-anim-loop">&#x1002;</i>加载中...');
                window.location.reload();
            });

//            layui.util.fixbar({
//                bar1: true,
//                bar2: true,
//                top:  true
//                ,click: function(type){
//                  console.log(type);
//                  if(type === 'bar1'){
//                    alert('点击了bar1')
//                  }
//                }
//            }); 
            
        </script>
        <?=$this->blocks['javascript']?>
    </body>
</html>
    <?php $this->endPage() ?>
<?php } ?>
