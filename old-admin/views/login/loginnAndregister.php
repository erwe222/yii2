<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>后台登录</title>
    <script>
        if (window != window.top) top.location.href = self.location.href;
    </script>
    <link rel="stylesheet" href="/assets/plug/layui/css/layui.css"  media="all">
    <link href="/assets/plug/login/login.css" rel="stylesheet">
    <link href="/assets/plug/login/normalize.css" rel="stylesheet">
    <link href="/assets/plug/login/demo.css" rel="stylesheet">
    <link href="/assets/plug/login/component.css" rel="stylesheet">
    <style>
        canvas {position: absolute;z-index: -1;}
        .kit-login-box header h1 {line-height: normal;}
        .kit-login-box header {height: auto;}
        .content {position: relative;}
        .codrops-demos {position: absolute;bottom: 0;left: 40%;z-index: 10;}
        .codrops-demos a {border: 2px solid rgba(242, 242, 242, 0.41);color: rgba(255, 255, 255, 0.51);}
        .kit-pull-right button,.kit-login-main .layui-form-item input {background-color: transparent;color: white;}
        .kit-login-main .layui-form-item input::-webkit-input-placeholder {color: #ccc;opacity:0.5;}
        .kit-login-main .layui-form-item input:-moz-placeholder {color: #ccc;opacity:0.5;}
        .kit-login-main .layui-form-item input::-moz-placeholder {color: #ccc;opacity:0.5;}
        .kit-login-main .layui-form-item input:-ms-input-placeholder {color: #ccc;opacity:0.5;}
        .kit-pull-right button:hover {border-color: #009688;color: #009688}
    </style>
</head>
<body class="kit-login-bg" >
    <div class="container demo-1">
        <div class="content">
            <div id="large-header" class="large-header" style="height: 589px;">
                <canvas id="demo-canvas" width="1366" height="589"></canvas>
                <div class="kit-login-box">
                    <header>
                        <h1>后台管理系统</h1>
                    </header>
                    <div class="kit-login-main">
                        <form class="layui-form" method="post">
                            <div class="layui-form-item">
                                <label class="kit-login-icon">
                                    <i class="layui-icon">&#xe612;</i>
                                </label>
                                <input type="text" name="userName" lay-verify="required" autocomplete="off" placeholder="用户名输入" class="layui-input" id="cus-username-input">
                            </div>
                            <div class="layui-form-item">
                                <label class="kit-login-icon">
                                    <i class="layui-icon">&#xe642;</i>
                                </label>
                                <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="密码输入" class="layui-input" id="cus-pwd-input">
                            </div>
                            <div class="layui-form-item">
                                <label class="kit-login-icon">
                                    <i class="layui-icon">&#xe642;</i>
                                </label>
                                <input type="text" name="validCode" lay-verify="required" autocomplete="off" placeholder="验证码" class="layui-input" maxlength="6" id="cus-code-input">
                                <span class="form-code" id="changeCode" style="position:absolute;right:2px; top:2px;">
                                    <?= \yii\captcha\Captcha::widget(['name'=>'captchaimg','captchaAction'=>'login/captcha','imageOptions'=>['id'=>'captcha-img', 'title'=>'换一个', 'alt'=>'换一个', 'style'=>'cursor:pointer;margin-left:25px;'],'template'=>'{image}']);?>
                                </span>
                            </div>
                            <div class="layui-form-item">
                                <div class="kit-pull-left kit-login-remember">
                                    <div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary" id="cus-check"><span>记住帐号?</span>
                                        <i class="layui-icon"></i>
                                    </div>
                                </div>
                                <div class="kit-pull-right">
                                    <button class="layui-btn layui-btn-primary" lay-submit="" lay-filter="login">
                                        <i class="layui-icon" >&#xe65b;</i> 登录
                                    </button>
                                </div>
                                <div class="kit-clear"></div>
                            </div>
                        </form>
                    </div>
                    <footer>
                        <!--<p>后台管理系统 © <a href="http://blog.zhengjinfan.cn/" style="color:white; font-size:18px;" target="_blank">ydong.xin</a></p>-->
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/custom/js/jquery.min.js" ></script>
    <script src="/assets/plug/layui/layui.js" charset="utf-8"></script>
    <script src="/assets/plug/login/TweenLite.min.js"></script>
    <script src="/assets/plug/login/EasePack.min.js"></script>
    <script src="/assets/plug/login/rAF.js"></script>
    <script src="/assets/plug/login/demo-1.js"></script>
    <script>
        layui.use(['layer', 'form'], function() {
            var layer = layui.layer,
                form = layui.form;
                form.on('submit(login)', function(data) {
                    var loadIndex = layer.load(1, {
                        shade: [0.3, '#333']
                    });
                    var rememberme = $('#cus-check').hasClass('layui-form-checked') ?'yes':'no';
                    var username = $.trim($('#cus-username-input').val());
                    var pwd = $.trim($('#cus-pwd-input').val());
                    var code = $.trim($('#cus-code-input').val());
                    $.ajax({
                        url:'/login/post-login',
                        type:'post',
                        data:{username:username,password:pwd,rememberme:rememberme,code:code},
                        dataType:'json',
                        success:function(res){
                            layer.close(loadIndex);
                            console.log(res);
                            if(res.code == 200){
                                window.location.href = '/';
                                return false;
                            }else if(res.code == 302){
                                layer.msg('用户不存在');
                            }else if(res.code == 303){
                                layer.msg('密码输入错误');
                            }else if(res.code == 304){
                                layer.msg('用户已被锁定...');
                            }else if(res.code == 403){
                                layer.msg('验证码输入错误');
                            }
                        }
                    });
                    return false;
                });
        });
        
        
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
        
        $('#cus-check').on('click',function(){
            if($(this).hasClass('layui-form-checked')){
                $(this).removeClass('layui-form-checked');
                
            }else{
                $(this).addClass('layui-form-checked');
            }
        });
</script>


<div class="layui-layer-move"></div></body></html>