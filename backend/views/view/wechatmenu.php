<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 微信管理 <span class="c-gray en">&gt;</span> 公众号菜单管理 
</nav>


    <blockquote class="layui-elem-quote">注意：下述演示中的颜色只是做一个区分作用，并非栅格内置。</blockquote>
    

  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">公众号菜单</label>
    <div class="layui-input-block">
        <textarea placeholder="请输入内容" class="layui-textarea" style="min-height:400px;"><?php echo $menu;?></textarea>
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" lay-submit="" lay-filter="demo1" onclick="test()">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>

<script>
    function test(){
        $.ajax({
            url:'/api/update-wechat-menu',
            type:'post',
            data:{username:$('.layui-textarea').val()},
            success:function(res){
               layer.msg('数据更新成功。。', {icon: 6});
            }
        });
    }

</script>
    
    