<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/assets/plug/layui/css/layui.css"  media="all">
    <style>
        .layui-layout-body{padding:10px;}
        /*.menu-box-input{width:300px}*/
    </style>
</head>
    <body class="layui-layout-body">
        <div style="width:400px;min-height:100px;margin:0 auto;">
            <form class="layui-form layui-form-pane">
            
                <div class="layui-form-item">
                  <label class="layui-form-label">登录名</label>
                  <div class="layui-input-block">
                      <input type="text" id="manager-box-name" value=""  autocomplete="off" placeholder="请填写登录名" lay-verify="required" class="layui-input menu-box-input">
                  </div>
                </div>
            
                <div class="layui-form-item">
                  <label class="layui-form-label">邮件地址</label>
                  <div class="layui-input-block">
                      <input type="text" id="manager-box-email"  value="" autocomplete="off" placeholder="请填写邮箱地址" class="layui-input menu-box-input" >
                  </div>
                </div>

                <div class="layui-form-item">
                  <label class="layui-form-label">登录密码</label>
                  <div class="layui-input-block">
                      <input type="password" id="manager-box-password"  value="" autocomplete="off" placeholder="请设置登录密码" lay-verify="required" class="layui-input menu-box-input" >
                  </div>
                </div>
                
                <div class="layui-form-item">
                  <label class="layui-form-label">确认密码</label>
                  <div class="layui-input-block">
                      <input type="password" id="manager-box-password2"  value="" autocomplete="off" placeholder="请填写确认密码" lay-verify="required" class="layui-input menu-box-input" >
                  </div>
                </div>
                
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-block">
                        <input type="radio" name="manager-box-status" value="10" title="启用" checked="" />
                        <input type="radio" name="manager-box-status" value="0"  title="禁用" />
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-normal" lay-submit="" lay-filter="add-marager-from">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
        </form>
        </div>
        
        <script src="/assets/plug/layui/layui.js" charset="utf-8"></script>
        <script src="/assets/custom/js/jquery.min.js" ></script>
        <script>
            layui.use(['layer', 'form'], function() {
                var layer = layui.layer,
                    form = layui.form;
                    form.on('submit(add-marager-from)', function(data) {
                        var loadIndex      = layer.load(1, {shade: [0.1,'#fff']});
                        var username       = $.trim($('#manager-box-name').val());
                        var email          = $.trim($('#manager-box-email').val());
                        var password       = $.trim($('#manager-box-password').val());
                        var password2      = $.trim($('#manager-box-password2').val());
                        if(username.length < 6){
                            layer.msg('登录名不能小于六位字符。。', {icon: 5});
                            layer.close(loadIndex);
                            return false;
                        }
                        if(password != password2){
                            layer.msg('两次密码输入不一致。。', {icon: 5});
                            layer.close(loadIndex);
                            return false;
                        }
                        var status         = $('input:radio[name="manager-box-status"]:checked').val();
                        var parent_index   = parent.layer.getFrameIndex(window.name);
                        $.ajax({
                            url:'/auth/add-manager-info',
                            type:'post',
                            data:{username:username,email:email,password:password,password2:password2,status:status},
                            dataType:'json',
                            success:function(res){
                                layer.close(loadIndex);
                                layer.msg(res.message);
                                setTimeout(function(){
                                   parent.layer.close(parent_index);
                                },1000);
                            },
                            error:function(e,t){
                                if(e.status == 403){
                                    layer.close(loadIndex);
                                    layer.msg('对不起，您现在还没获得该操作的权限!', {icon: 5});
                                }else{
                                    layer.msg('对不起，网络繁忙请稍后再试!', {icon: 5});
                                }
                            }
                        });
                        return false;
                    });
            });
        </script>
    </body>
</html>