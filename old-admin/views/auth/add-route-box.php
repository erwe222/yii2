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
            <form class="layui-form layui-form-pane" action="">
            
            <div class="layui-form-item">
              <label class="layui-form-label">路由权限</label>
              <div class="layui-input-block">
                  <input type="text" id="route-box-name" name="route-box-name" value="<?php echo isset($route_info['name'])?$route_info['name']:'';?>"  autocomplete="off" placeholder="请填写路由权限 例如: /xxx/xxx " class="layui-input menu-box-input" <?php if(!$is_add):?>readonly="readonly"<?php endif;?>>
              </div>
            </div>
            
            <div class="layui-form-item">
              <label class="layui-form-label">权限描述</label>
              <div class="layui-input-block">
                  <input type="text" id="route-box-description" name="route-box-description" value="<?php echo isset($route_info['description'])?$route_info['description']:'';?>" autocomplete="off" placeholder="请填写权限描述" class="layui-input menu-box-input" >
              </div>
              <input type="hidden" id="route-box-flag" value="<?php if($is_add):?>add<?php else:?>edit<?php endif;?>">
            </div>

            <div class="layui-form-item">
              <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" lay-submit="" lay-filter="add-route-from">立即提交</button>
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
                    form.on('submit(add-route-from)', function(data) {
                        var loadIndex   = layer.load(1, {shade: [0.1,'#fff']});
                        var name        = $.trim($('#route-box-name').val());
                        var description = $.trim($('#route-box-description').val());
                        var flag        = $.trim($('#route-box-flag').val());
                        if(name == ''){layer.close(loadIndex);layer.msg('权限为必填项', {icon: 5});return false;}
                        if(description == ''){layer.close(loadIndex);layer.msg('权限描述为必填项', {icon: 5});return false;}
                        var parent_index = parent.layer.getFrameIndex(window.name);
                        $.ajax({
                            url:'/auth/change-route-info',
                            type:'post',
                            data:{name:name,description:description,flag:flag},
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