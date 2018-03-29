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
                <label class="layui-form-label">顶级分栏</label>
                <div class="layui-input-block">
                    <select name="menu-box-parent-name" id="menu-box-parent-name">
                    <option value="0">顶级分栏</option>
                    <?php foreach($menu_array as $_k=>$_v):?>
                    <option value="<?php echo $_v['id']?>" <?php if(isset($menu_info['pid']) && $_v['id'] == $menu_info['pid']):?>selected=""<?php endif;?>><?php echo $_v['menu_name']?></option>
                    <?php endforeach;?>
                  </select>
                </div>
            </div>
            
            <div class="layui-form-item">
              <label class="layui-form-label">栏目名</label>
              <div class="layui-input-block">
                  <input type="text" id="menu-box-name" name="menu-box-name" value="<?php echo isset($menu_info['menu_name'])?$menu_info['menu_name']:'';?>"  autocomplete="off" placeholder="请输入栏目名" class="layui-input menu-box-input">
              </div>
            </div>
            
            <div class="layui-form-item">
              <label class="layui-form-label">页面地址</label>
              <div class="layui-input-block">
                  <input type="text" id="menu-box-url" name="menu-box-url" value="<?php echo isset($menu_info['url'])?$menu_info['url']:'';?>" autocomplete="off" placeholder="请输入页面地址" class="layui-input menu-box-input" >
              </div>
            </div>

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="menu-box-status" value="1" title="使用" <?php if(isset($menu_info['status']) && $menu_info['status'] == 1):?>checked=""<?php endif;?>>
                  <input type="radio" name="menu-box-status" value="2" title="禁用" <?php if(isset($menu_info['status']) && $menu_info['status'] == 2):?>checked=""<?php endif;?>>
                </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">栏目排序</label>
              <div class="layui-input-block">
                  <input type="number" id="menu-box-sort" name="menu-box-sort" value="<?php echo isset($menu_info['sort'])?$menu_info['sort']:'';?>" autocomplete="off" placeholder="" class="layui-input menu-box-input" />
              </div>
              <input type="hidden" id="menu-box-id" name="menu-box-id" value="<?php echo isset($menu_info['id'])?$menu_info['id']:0;?>" >
            </div>

            <div class="layui-form-item">
              <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" lay-submit="" lay-filter="add-menu-from">立即提交</button>
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
                    form.on('submit(add-menu-from)', function(data) {
                        var loadIndex = layer.load(1, {shade: [0.1,'#fff']});
                        var pid       = $('#menu-box-parent-name').val();
                        var menu_name = $.trim($('#menu-box-name').val());
                        if(menu_name == ''){
                            layer.close(loadIndex);layer.msg('栏目名为必填项', {icon: 5});return false;
                        }
                        var url       = $.trim($('#menu-box-url').val());
                        if(url == '' && pid != 0){
                            layer.close(loadIndex);layer.msg('页面地址为必填项', {icon: 5});return false;
                        }
                        var sort      = $('#menu-box-sort').val();
                        var status    = $('input:radio[name="menu-box-status"]:checked').val();
                        if(status==null){
                            layer.close(loadIndex);layer.msg('请选择菜单状态', {icon: 5});return false;
                        }
                        
                        var parent_index = parent.layer.getFrameIndex(window.name);
                        var id = $('#menu-box-id').val();
                        $.ajax({
                            url:'/auth/change-menu-info',
                            type:'post',
                            data:{id:id,pid:pid,menu_name:menu_name,url:url,status:status,sort:sort},
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