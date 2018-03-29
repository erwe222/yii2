<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
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
    <script src="/assets/custom/js/jquery.min.js" ></script>
</head>
    <body>
        <script src="/assets/plug/layui/layui.all.js" charset="utf-8"></script>
        <?php $this->beginBody() ?>
            <?= $this->render('content.php',['content' => $content]) ?>
        <?php $this->endBody() ?>
        
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
            
            $('#cus-reload-current').on('click',function(){
                $(this).html('<i class="layui-icon layui-anim layui-anim-rotate layui-anim-loop">&#x1002;</i>加载中...');
                window.location.reload();
            });
        </script>

    </body>
</html>
    <?php $this->endPage() ?>

