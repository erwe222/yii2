

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link href="/assets/public/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/public/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/assets/public/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/assets/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<title>后台登录</title>
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
<style>
    #loginform-verifycode { height:27px;z-index:5px;padding-left: 8px;width: 207px;}
    .help-block-error{margin-bottom: -10px;color:red}
</style>
</head>
<body>
<div class="header"><p style="color:#FFF;font-size: 30px;margin-left:10px;">后台管理系统</p></div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
                    <?php $form = ActiveForm::begin([
                            'action' => ['/login/login'],
                            'method'=>'post',
                            'enableClientValidation' => true,
                            'options'=>[
                                'class'=>'form form-horizontal',
                            ]
                        ]);
                    ?>
                        <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <?= $form->field($model, 'username')->textInput(['placeholder'=>'账户','autofocus' => true,'class'=>'input-text','style'=>'width:300px'])->label(false) ?>
                                </div>
                        </div>
                        <div class="row cl">
                                <label class="form-label col-xs-4 col-sm-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                                <div class="formControls col-xs-8 col-sm-9">
                                    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'密码','class'=>'input-text','style'=>'width:300px'])->label(false) ?>
                                </div>
                        </div>

            <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-3"></label>
                            <div class="formControls col-xs-8">
                                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'template' => '{input}{image}','captchaAction'=>'/login/captcha',
                                    'imageOptions'=>['id'=>'captcha-img','style'=>'cursor: pointer; margin-left: 5px; height: 28px; margin-top: 1px;']
                                    ])->label(false);
                                ?>
                            </div>
            </div>
            <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-3"></label>
                            <div class="formControls col-xs-8">
                                <?= $form->field($model, 'rememberMe')->checkbox(['class'=>'pull-left'])->label('记住用户名') ?>
                            </div>
            </div>
            <div class="row cl">
                            <label class="form-label col-xs-4 col-sm-3"></label>
                            <div class="formControls col-xs-8">
                                <input type="submit" class="btn btn-success size-M" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;" >
                                <input type="reset" class="btn btn-default size-M fr" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;" style="margin-left: 136px;">
                            </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


<div class="footer">Copyright ©2017-2018 www.xxx.com All Rights Reserved. </div>
<script type="text/javascript" src="/assets/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/assets/public/static/h-ui/js/H-ui.js"></script>
<script>

        //解决验证码不刷新的问题
    $('#captcha-img').click(function () {
         $.ajax({
            //使用ajax请求site/captcha方法，加上refresh参数，接口返回json数据
                url: "/login/captcha?refresh",
                dataType: 'json',
                cache: false,
                success: function (data) {
                //将验证码图片中的图片地址更换
                    $("#captcha-img").attr('src', data['url']);
                }
        });
    });
</script>
</body>
</html>

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录界面</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="/assets/public/loginfile/iconfont/style.css" type="text/css" rel="stylesheet">
<style>
    body{color:#fff; font-family:"微软雅黑"; font-size:14px;}
    .wrap1{position:absolute; top:0; right:0; bottom:0; left:0; margin:auto }/*把整个屏幕真正撑开--而且能自己实现居中*/
    .main_content{background:url(images/main_bg.png) repeat; margin-left:auto; margin-right:auto; text-align:left; float:none; border-radius:8px;}
    .form-group{position:relative;}
    .login_btn{display:block; background:#3872f6; color:#fff; font-size:15px; width:100%; line-height:50px; border-radius:3px; border:none; }
    .login_input{width:100%; border:1px solid #3872f6; border-radius:3px; line-height:40px; padding:2px 5px 2px 30px; background:none;}
    .icon_font{position:absolute; bottom:15px; left:10px; font-size:18px; color:#3872f6;}
    .font16{font-size:16px;}
    .mg-t20{margin-top:20px;}
    @media (min-width:200px){.pd-xs-20{padding:20px;}}
    @media (min-width:768px){.pd-sm-50{padding:50px;}}
    #grad {
      background: -webkit-linear-gradient(#4990c1, #52a3d2, #6186a3); /* Safari 5.1 - 6.0 */
      background: -o-linear-gradient(#4990c1, #52a3d2, #6186a3); /* Opera 11.1 - 12.0 */
      background: -moz-linear-gradient(#4990c1, #52a3d2, #6186a3); /* Firefox 3.6 - 15 */
      background: linear-gradient(#4990c1, #52a3d2, #6186a3); /* 标准的语法 */
    }
</style>

</head>

<body style="background:url(/assets/public/loginfile/images/bg.jpg) no-repeat;">
    
    <div class="container wrap1" style="height:450px;">
            <!-- <h2 class="mg-b20 text-center">远东技术</h2> -->
            <div class="col-sm-8 col-md-5 center-auto pd-sm-50 pd-xs-20 main_content">
                <!-- <p class="text-center font16">用户登录</p> -->
                 <h2 class="mg-b20 text-center">远东技术</h2>
                 <form onsubmit="return false;" autocomplete="off">
                    <div class="form-group mg-t20">
                        <i class="icon-user icon_font"></i>
                        <input type="text" class="login_input"  placeholder="请输入用户名" autocomplete="off" value=""/>
                    </div>
                    <div class="form-group mg-t20">
                        <i class="icon-lock icon_font"></i>
                        <input type="text" class="login_input" id="passpwd" placeholder="请输入密码" autocomplete="off" value=""/>
                    </div>
                    <div class="checkbox mg-b25">
                        <label>
                            <input type="checkbox" />记住我的登录信息
                        </label>
                    </div>
                    <button style="submit" class="login_btn">登 录</button>
                </form>
        </div>
    </div>
    
    <script type="text/javascript" src="/assets/lib/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $(function(){
//           alert('asd');
           $('#passpwd').attr('type','password').val(''); 
        });
         $('#login_btn').on('click',function(){
                alert('kthis');
         });
    </script>
</body>
</html>


