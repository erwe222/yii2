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
    <title>新用户注册</title> 
    <link rel="stylesheet" href="/assets/mobiles/mobile/dabian/css/main.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="/assets/mobiles/mobile/dabian/css/sign.css"/>
    <style>
      .cus-inout{
        width: 100%;height: 0.7rem;border: none;font-size: 0.26rem;outline: none;
      }
    #cus-yzm-code{
      width: 100%;height: 0.7rem;border: none;font-size: 0.26rem;outline: none;border-bottom: 1px solid #E7E7E7 !important;
    }
    #cus-yan-btn{
      background:none;
      margin-top:5px;
      padding: 3px;
      border: 1px solid #ccc;
      border-radius:5px;

    }
    .cus-classback{
      color: #fff;
      background: #CCC !important;
    }
    </style>
  </head>

  <body>
    <div class="sign_box" style="margin-top:20%;">

      <div class="logo_box">
        <img src="/assets/mobiles/mobile/dabian/img/_logo.png"/>
      </div>
      <div class="input_box" style="margin-top: 0.5rem;">
        <div class="input_box_left">
          手机号
        </div>
        <div class="input_box_right">
          <input type="text"  class='cus-inout' id="cus-username" placeholder="请输入手机号码"  />
        </div>
      </div>
      <div class="input_box">
        <div class="input_box_left">
          密&nbsp;&nbsp;&nbsp;&nbsp;码
        </div>
        <div class="input_box_right">
          <input type="password"  class='cus-inout' id="cus-password" placeholder="请填写密码"/>
        </div>
      </div>

      <div class="input_box">
        <div class="input_box_left">
          确认密码
        </div>
        <div class="input_box_right">
          <input type="password"  class='cus-inout' id="cus-confirm-password" placeholder="请填确认密码"/>
        </div>
      </div>

      <div class="input_box">
        <div class="input_box_left">
          短信验证
        </div>
        <div class="input_box_right">
          <input type="text" id="cus-yzm-code" onkeyup="this.value=this.value.replace(/[^\d]/g,'') " onafterpaste="this.value=this.value.replace(/[^\d]/g,'') "  placeholder="请填写短信验证码" maxlength="6" />
        </div>
      </div>

      <div class="input_box" style="text-align: right;" >
        <div class="input_box_right" style="width: 250px;border: none;display: block;float: right;">
          <input type="button" value="发送短信"  id="cus-yan-btn" />
        </div>
      </div>

      <div class="input_box btn_sm" style="margin-top: 0.08rem;text-align:left;color:#ccc !important;">
        <p style="color:#ccc !important;">注:密码格式为8位以上的字母加数字组合</p>
      </div>


      <div class="input_box btn_sm" style="margin-top: 0.4rem;">
        <input type="button" id="res_btn" value="立即注册" />
      </div>
      <div class="input_box btn_sm" style="margin-top: 0.08rem;">
        <p>
          <img src="/assets/mobiles/mobile/dabian/img/check.png"/>
          我已阅读并同意
          <a href="#">服务条款</a> | 
          <a href="<?= \yii\helpers\Url::toRoute('login/signin') ?>">已有账号？</a>
        </p>
      </div>



    </div>
<script type="text/javascript" src="/assets/mobiles/mobile/js/functions.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/dabian/js/jquery.min.js"></script>
    
    <script type="text/javascript" src="/assets/mobiles/mobile/dabian/js/common.js"></script>
    <script type="text/javascript" src="/assets/lib/layer/2.4/layer.js"></script>
<script>


   $(function(){
        $('#cus-username').on('keyup',function(){
          $(this).val(mobileFormater($(this).val()));
        });

        function VerificationCode(example,className,btnName){
        this.cacheFlag = 'code_data';

        /*刷新时间为60秒*/
        this.time = 60;

        /**获取验证码缓存时间**/
        this.getCodeTime = function(){
            var res = localStorage.getItem(this.cacheFlag);
            return res;
        }

        /*设置验证码刷新的时间*/
        this.setCodeTime = function(){
            var mydate = new Date();
            var date = mydate.getTime();
            localStorage.setItem(this.cacheFlag, date);
            return true;
        }

        /**判断验证码时间是否有效*/
        this.veriftyTime = function() {
            var cache = localStorage.getItem(this.cacheFlag);
            if (cache !== null || cache !== '') {
                var mydate = new Date();
                var minute = (mydate.getTime() - parseInt(cache)) / 1000;
                if (minute < this.time) {
                    return true;
                }
            }

            localStorage.removeItem(this.cacheFlag);
            return false;
        }

        //倒计时触发
        this.CountDown = function(){
            var cache = localStorage.getItem(this.cacheFlag);
            if(cache !== null || cache !== ''){
                var mydate = new Date();
                var minute = parseInt((mydate.getTime() - parseInt(cache)) / 1000);
                var time = parseInt(this.time - minute);
                if(time > 0){
                    example.addClass(className);
                    t2 = setInterval(function(){
                        time--;
                        example.val(time +"S重新发送");
                        if(time === 0) {
                            example.val(btnName);
                            example.removeClass(className);
                            clearInterval(t2);
                        }
                    }, 1000);
                }
            }else{
                example.removeClass(className);
            }
        }

        /*刷新页面触发事件*/
        this.start = function(){
            if(this.veriftyTime()){
                this.CountDown();
            }
        }
    }

        var btn_sunmit = $('#cus-yan-btn');
        var className = 'cus-classback';
        var btnName = '获取验证码';
        var obj = new VerificationCode(btn_sunmit,className,btnName);
        obj.start();
        btn_sunmit.on('click',function(){
        if(!obj.veriftyTime()){
            var username   = mobileFormater2($.trim($('#cus-username').val()));
            if(username == '' || !checkMobile(mobileFormater2(username))){
               layer.msg('请填写正确的手机号...');
               return false;
            }
            $.ajax({
                url:'send-code',
                type:'post',
                dataType:'json',
                data:{username:username},
                success:function(res){
                    if(res.errCode == 200){
                        if(obj.setCodeTime()){
                            obj.CountDown();
                            layer.msg('短信发送成功。。。');
                        }
                    }else{
                        layer.msg(res.errMsg);
                    }
                }
            });
        }
    });
        var isSubmit = false;
        $('#res_btn').on('click',function(){
           var username   = mobileFormater2($.trim($('#cus-username').val()));
           var password   = $.trim($('#cus-password').val());
           var password2  = $.trim($('#cus-confirm-password').val());
           var code     = $.trim($('#cus-yzm-code').val());
           if(username == '' || !checkMobile(mobileFormater2(username))){
               layer.msg('请填写正确的手机号...');
               return false;
           }
           if(password == ''){
               layer.msg('请填写密码...');
               return false;
           }
           var reg = new RegExp(/^(?![^a-zA-Z]+$)(?!\D+$)/);
           if(!reg.test(password)){
               layer.msg('密码格式不正确...');
               return false;
           }
           if(password2 == ''){
               layer.msg('请填写确认密码...');
               return false;
           }
           if(password != password2){
               layer.msg('确认密码填写错误...');
               return false;
           }
           if(code == ''){
              layer.msg('请填写短信验证码...');
               return false;
           }
           if(isSubmit){
               return false;
           }
           
           $.ajax({
               url:'post-register',
               type:'post',
               dataType:'json',
               data:{username:username,password:password,password2:password2,code:code},
               complete:function(XHR, TS){
                   
               },
               success:function(res){
                   console.log(res);
                   if(res.errCode == 200){
                        layer.msg('注册成功。。。');
                        window.setTimeout(function(){
                            window.location.href="/mobile/index/index";
                        },1000);
                   }else if(res.errCode == 302){
                       isSubmit = false;
                       layer.msg('用户已存在。。。');
                   }else if(res.errCode == 301){
                       isSubmit = false;
                       layer.msg('注册失败。。。');
                   }
               }
           });
       });
   });
</script>
  </body>

</html>