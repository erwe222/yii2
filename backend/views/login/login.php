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
<link href="/assets/lib/layui/css/layui.css" type="text/css" rel="stylesheet">
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
                 <h2 class="mg-b20 text-center">远东科技</h2>
                 <form onsubmit="return false;" autocomplete="off">
                    <div class="form-group mg-t20">
                        <i class="icon-user icon_font"></i>
                        <input type="text" class="login_input" id="username" placeholder="请输入用户名" autocomplete="off" value=""/>
                    </div>
                    <div class="form-group mg-t20">
                        <i class="icon-lock icon_font"></i>
                        <input type="password" class="login_input" id="password" placeholder="请输入密码" autocomplete="off" value=""/>
                    </div>
                    <div class="checkbox mg-b25">
                        <label>
                            <input type="checkbox" id="rememberMe"/>记住我的登录信息
                        </label>
                    </div>
                    <button style="submit" class="login_btn">立即登录</button>
                </form>
        </div>
    </div>
    
    <script type="text/javascript" src="/assets/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/lib/layer/2.4/layer.js"></script>
    <script>
         $('.login_btn').on('click',function(){
            var username = $('#username').val();
            var password = $('#password').val();
            var rememberMe = $('#rememberMe').is(':checked');
            if($.trim(username) == ''){
                layer.msg('您填写用户名...'); return false;
            }else if($.trim(password) == ''){
                layer.msg('您填写用户名密码...'); return false;
            }
            $('.login_btn').text('登录中...');
            $.ajax({
                url:'/login/ajax-login',
                type:'post',
                data:{username:username,password:password,rememberMe:rememberMe},
                dataType:'json',
                success:function(res){
                    if(res.errCode == 301){
                        $('.login_btn').text('立即登录');
                        layer.msg('您填写的用户名不存在...'); 
                    }else if(res.errCode == 302){
                        $('.login_btn').text('立即登录');
                        layer.msg('您填写的用户民密码错误...'); 
                    }else if(res.errCode == 200){
                        $('.login_btn').text('登录成功...');
                        layer.msg('登录成功', function(){
                          location.reload();
                        });   
                    }
                }
            });
         });
         
    </script>
</body>
</html>
