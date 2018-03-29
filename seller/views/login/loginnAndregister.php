<!DOCTYPE html>
<html>
<head>
    <title>登录&注册</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link rel="stylesheet" href="/assets/custom/css/style.css" type="text/css" media="all">
    <style>
        .cus-send-code{background:#ccc !important;cursor: not-allowed !important;color:red !important;}
        .cus-errortip{color:#9DA7AA !important;}
        .lgrg-eye {
            display: none;
            width: 24px;
            height: 14px;
            background-position: 0 -19px;
            position: absolute;
            top: 15px;
            right: 20px;
            cursor: pointer;
        }
        .lgrg-eye{
            display: inline-block;
            background: url(/assets/custom/images/icon_t.png) no-repeat;
            background-position: 0 -19px;
        }
        .lgrg-eye-on {
            background-position: 0 -36px;
        }
    </style>
</head>
<body>
    <div class="container w3layouts agileits" style="margin-top:10%;">
        <div class="login w3layouts agileits">
                <h2>登 录</h2>
                <form action="#" method="post">
                    <input type="text" Name="Userame" placeholder="登录名" required="" maxlength="16" id="cus-username-input" class="cus-login-blur" />
                    <input type="password" Name="Password" placeholder="密码" required="" maxlength="16" id="cus-pwd-input" class="cus-login-blur" />
                </form>
                <ul class="tick w3layouts agileits" style="margin-top:10px;">
                    <li>
                        <input type="checkbox" id="brand1" value="">
                        <label for="brand1"><span></span>记住我</label>
                        <span style="display: inline-block;float: right;color:#fff;cursor: pointer;">忘记密码？</span>
                    </li>
                </ul>
                <p class="cus-errortip" id="cus-login-errtip"></p>
                <div class="send-button w3layouts agileits" style="margin-top:17px;">
                    <input type="submit" value="登 录" style="width:100%;" id="cus-to-login" />
                </div>
                <div class="clear"></div>
            </div>
        
            <div class="register w3layouts agileits">
                <h2>注 册</h2>
                <form action="#" method="post">
                    <input type="text" Name="Phone Number" placeholder="手机号码" required="" maxlength="14" id="cus-reg-mobile" class="cus-register-blur" />
                    
                    <div style="position: relative;">
                    <input type="password" Name="Password" placeholder="密码" required="" maxlength="16" id="cus-reg-pwd" class="cus-register-blur" />
                        <i id="cus-cat-val"  class="lgrg-eye" style="display: inline;position:absolute;top: 64px;right: 8px;cursor:pointer;" ></i>
                    </div>
                    
                    <div style="position: relative;">
                        <input type="text" Name="Password" placeholder="验证码" required="" maxlength="6" id="cus-reg-code" class="cus-register-blur" />
                        <div style="width:100px;height:25px;background: #2EC4F5;color:#fff;position:absolute;top: 110px;right: 0;cursor:pointer;border-radius:5px;padding:3px;text-align: center;" id="cus-get-code">获取验证码</div>
                    </div>
                </form>
                <p class="cus-errortip" id="cus-register-errtip"></p>
                <div class="send-button w3layouts agileits">
                        <input type="submit" value="商家免费加入" style="width:100%;" id="cus-to-register" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
    </div>
    <div class="footer w3layouts agileits">
        <p>Copyright &copy; ydong.xin </p>
    </div>
    <script src="/assets/custom/js/jquery.min.js" ></script>
    <script>
          /**
            * 手机号格式化
            */
           function mobileFormater(val){
               var value = val.replace(/[^0-9]/g,"");
               var len = value.length;
               if(len  <= 3){
                   return value.slice(0,3);
               }else if(len  <= 7){
                   return value.slice(0,3) + ' ' +  value.slice(3,7);
               }else{
                   return value.slice(0,3) + ' ' +  value.slice(3,7) + ' ' + value.slice(7,11);
               }
           }

           /**
            * 去除手机号中的空格
            */
           function mobileFormater2(val){
               return val.replace(/[^0-9]/g,"");
           }

           /**
            * 验证手机号格式
            */
           function checkMobile(val){
               var myreg = /^1(3|4|5|7|8)\d{9}$/; 
               return myreg.test(val);
           }

           /**
            * 密码格式验证
            */
           function checkPassWord(password) {
               var str = password;
               if (str == null || str.length < 8) {
                   return false;
               }
               var reg = new RegExp(/^(?![^a-zA-Z]+$)(?!\D+$)/);
               if (reg.test(str))
                   return true;
           };
        
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
                                example.html( "已发送("+time+"S)");
                                if(time === 0) {
                                    example.html(btnName);
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

            var btn_sunmit = $('#cus-get-code');
            var className = 'cus-send-code';
            var btnName = '点击获取';
            var obj = new VerificationCode(btn_sunmit,className,btnName);
            obj.start();

            btn_sunmit.on('click',function(){
                if(!obj.veriftyTime()){
                    var mobile = $.trim(mobileFormater2($('#cus-reg-mobile').val()));
                    if(mobile.length == 0){
                        $('#cus-register-errtip').text('手机号不能为空');
                        return false;
                    }else if(!checkMobile(mobile)){
                        $('#cus-register-errtip').text('请输入正确的手机号');
                        return false;
                    }else{
                        $('#cus-register-errtip').text('');
                    }

                    $.ajax({
                        url:'/login/send-reg-code',
                        type:'post',
                        data:{username:mobile},
                        dataType:'json',
                        success:function(res){
                            console.log(res);
                            if(res.code == 200){
                                if(obj.setCodeTime()){
                                    obj.CountDown();
                                    $('#cus-register-errtip').text('');
                                }
                            }else{
                                $('#cus-register-errtip').text(res.message);
                            }
                        }
                    });
                }
            });

            $('#cus-to-login').on('click',function(){
                var _this = $(this);
                var username = $.trim($('#cus-username-input').val());
                var pwd = $.trim($('#cus-pwd-input').val());
                if(username.length == 0){
                    $('#cus-login-errtip').text('登录名不能为空');
                    return false;
                }else if(pwd.length == 0){
                    $('#cus-login-errtip').text('密码不能为空');
                    return false;
                }else{
                    $('#cus-login-errtip').text('');
                }

                _this.attr('disabled',true);
                var t = 1,tip = '登录中，请稍等';
                _this.val(tip+'...');
                var time = setInterval(function () {
                    if(t == 1){
                        t = 2;_this.val(tip+'.  ');
                    }else if(t == 2){
                        t = 3;_this.val(tip+'.. ');
                    }else{
                        t = 1;_this.val(tip+'...');
                    }
                }, 1000);

                var rememberme = $('#brand1').is(':checked') ?'yes':'no';

                $.ajax({
                    url:'/login/post-login',
                    type:'post',
                    data:{username:username,password:pwd,rememberme:rememberme},
                    dataType:'json',
                    success:function(res){
                        console.log(res);
                        clearTimeout(time);
                        if(res.code == 200){
                            window.location.href = '/';
                            return false;
                        }else if(res.code == 302){
                            $('#cus-login-errtip').text('用户不存在');
                        }else if(res.code == 303){
                            $('#cus-login-errtip').text('密码输入错误');
                        }else if(res.code == 304){
                            $('#cus-login-errtip').text('用户已被锁定...');
                        }
                        _this.attr("disabled",false).val('登 录'); 
                    }
                });
            });

            $('#cus-to-register').on('click',function(){
                var _this = $(this);
                var mobile = $.trim(mobileFormater2($('#cus-reg-mobile').val()));
                var pwd = $.trim($('#cus-reg-pwd').val());
                var code = $.trim($('#cus-reg-code').val());
                if(mobile.length == 0){
                    $('#cus-register-errtip').text('手机号不能为空');
                    return false;
                }else if(!checkMobile(mobile)){
                    $('#cus-register-errtip').text('请输入正确的手机号');
                    return false;
                }else if(pwd.length == 0){
                    $('#cus-register-errtip').text('密码不能为空');
                    return false;
                }else if(!checkPassWord(pwd)){
                    $('#cus-register-errtip').text('注:密码格式为8位以上的字母加数字组合');
                    return false;
                }else if(code.length == 0){
                    $('#cus-register-errtip').text('验证码不能为空');
                    return false;
                }else{
                    $('#cus-register-errtip').text('');
                }
                _this.attr("disabled",true); 

                var t = 1;
                var tip = '注册中，请稍等';
                _this.val(tip+'...');
                var time = setInterval(function () {
                    if(t == 1){
                        t = 2;_this.val(tip+'.  ');
                    }else if(t == 2){
                        t = 3;_this.val(tip+'.. ');
                    }else{
                        t = 1;_this.val(tip+'...');
                    }
                }, 1000);
                
                $.ajax({
                    url:'/login/post-register',
                    type:'post',
                    data:{username:mobile,password:pwd,code:code},
                    dataType:'json',
                    success:function(res){
                        console.log(res);
                        clearTimeout(time);
                        if(res.code == 200){
                            window.location.href = '/';
                            return false;
                        }else if(res.code == 302){
                            $('#cus-register-errtip').text('该手机号已被使用');
                        }else if(res.code == 303){
                            $('#cus-register-errtip').text('验证码验证失败');
                        }else if(res.code == 304){
                            $('#cus-register-errtip').text('网络繁忙，请稍后重试...');
                        }
                        _this.attr("disabled",false).val('商家免费加入'); 
                    }
                });
            });

            $('.cus-register-blur').focus(function(){
                $('#cus-register-errtip').text('');
            });
            
            $('.cus-login-blur').focus(function(){
                $('#cus-login-errtip').text('');
            });
            
            $('#cus-reg-mobile').on('input',function(){
                var _this = $(this);
                _this.val(mobileFormater(_this.val()));
            });
            
            $('#cus-cat-val').on('click',function(){
                if($(this).hasClass('lgrg-eye-on')){
                    $(this).removeClass('lgrg-eye-on');
                    $('#cus-reg-pwd').attr('type','password');
                }else{
                    $(this).addClass('lgrg-eye-on');
                    $('#cus-reg-pwd').attr('type','text');
                }
            });
            
            $('#cus-reg-code').on('input',function(){
                var _this = $(this);
                _this.val(mobileFormater2(_this.val()));
            });
    </script>
</body>
</html>