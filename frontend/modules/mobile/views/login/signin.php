<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="apple-themes-web-app-capable" content="yes">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta content="email=no" name="format-detection">
    <meta name="format-detection" content="telephone=no">
    <title>登录</title> 
    <link rel="stylesheet" href="/assets/mobiles/mobile/dabian/css/main.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="/assets/mobiles/mobile/dabian/css/sign.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/mobiles/mobile/css/common.css"/>
  </head>

  <body>
    <div class="sign_box">
      <div class="logo_box">
        <img src="/assets/mobiles/mobile/img/_logo.png"/>
      </div>

      <div class="input_box" style="margin-top: 0.5rem;">
        <div class="input_box_left">
          账号
        </div>
        <div class="input_box_right">
          <input type="text"  id="phone_number" placeholder="请输入手机号码" />
        </div>
      </div>
      <div class="input_box">
        <div class="input_box_left">
          密码
        </div>
        <div class="input_box_right">
          <input type="password"  id="cord_number" placeholder="请填写密码"/>
        </div>
      </div>

      <div class="input_box btn_sm" style="margin-top: 0.4rem;">
        <input type="button" id="res_btn" value="登录" />
      </div>
      <div class="input_box btn_sm" style="margin-top: 0.08rem;">
        <p>
          <img src="/assets/mobiles/mobile/dabian/img/check.png"/>
          我已阅读并同意
          <a href="#">服务条款</a>
        </p>
      </div>

      <div class="forget_box" style="margin-top:40px;">
        <a href="<?= \yii\helpers\Url::toRoute('login/findpwd') ?>">忘记密码?</a>
        <a href="<?= \yii\helpers\Url::toRoute('login/register') ?>">新用户注册</a>
      </div>

      <div class="line_gray"></div>
      <div class="three_box">
        使用其他账号登录
      </div>
      
      <div class="wechat_sign">
        <a href="#">
          <img src="/assets/mobiles/mobile/dabian/img/wechat_sign.png"/>
          <p>微信登录</p>
        </a>
      </div>
    </div>

    <script type="text/javascript" src="/assets/mobiles/mobile/dabian/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/dabian/js/common.js"></script>
    <script type="text/javascript" src="/assets/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/functions.js"></script>
<script>
    
    
   $(function(){
       $('#res_btn').on('click',function(){
           var username = $.trim($('#phone_number').val());
           var password = $.trim($('#cord_number').val());
           if(username == ''){
               layer.msg('请填写登录账号。。。');
               return false;
           }else if(password == ''){
               layer.msg('请填写登录密码。。。');
               return false;
           }
           showLoadingBox(1,'loging','登录中...');
           $.ajax({
               url:'post-signin',
               type:'post',
               dataType:'json',
               data:{username:username,password:password},
               complete:function(XHR, TS){
                   
               },
               success:function(res){
                   if(res.code == 200){
                       showLoadingBox(1,'loging','登录成功');
                       setTimeout(function(){
                            window.location.href="/mobile/index/index"; 
                       },1000);
                   }else if(res.code == 201){
                       showLoadingBox(2);
                       layer.msg('当前用户不存在。。。');
                   }else if(res.code == 202){
                       showLoadingBox(2);
                       layer.msg('登录密码填写错误。。。');
                   }
               }
           });
       });
   });
</script>
  </body>

</html>