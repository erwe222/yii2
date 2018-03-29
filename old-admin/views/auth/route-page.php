<style>
    .cus-menu-querybox{margin-top:10px;}
    .cus-menu-querybox input,.cus-menu-querybox button{height:30px;line-height:30px;}
</style>

<div class="demoTable cus-menu-querybox layui-form">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="text"  placeholder="路由权限" autocomplete="off" class="layui-input" id="cus-query-1">
        </div>
        <div class="layui-input-inline">
            <input type="text"  placeholder="权限描述" autocomplete="off" class="layui-input" id="cus-query-2">
        </div>
        <button class="layui-btn layui-btn-normal" onclick="routeActive.search()"><i class="layui-icon">&#xe615;</i></button>
        <button class="layui-btn layui-btn-warm" onclick="routeActive.resetSearch()">重 置</button>
    </div>
</div>

<p class="layui-btn-group demoTable">
    <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="routeActive.getCheckData()"><i class="layui-icon" >&#xe640;</i> 批量删除</button>
    <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="routeActive.add('')"><i class="layui-icon">&#xe654;</i>添加权限</button>
    <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="routeActive.refresh()"><i class="layui-icon">&#x1002;</i>刷 新</button>
</p>

<table id="route-table" lay-filter="route-table-demo"></table>
<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="edit"><i class="layui-icon">&#xe642;</i></a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i></a>
</script>
<script>
$(function(){
    var length = $(window).height() - $('#route-table').offset().top - 45 -35;
    var myTable = layui.table,form = layui.form;
    var index = '';
    var options = { //其它参数在此省略
          id:'idTest',
          elem: '#route-table',
          url: '/auth/route-data-list',
          height:length,
          method: 'post',
          cellMinWidth:80,
          cols: [[ //标题栏
              {checkbox: true, LAY_CHECKED: false},
              {field: 'name', title: '路由权限', width: 200},
              {field: 'description', title: '权限描述', minWidth: 150},
              {field: 'created_at', title: '操作时间', width: 170,sort: true},
              {fixed: 'right', width:120, align:'center', toolbar: '#barDemo',title:'操 作'},
          ]],
          skin: 'row', //表格风格
          even: true,
          page: true, //是否显示分页
          limits: [10,20,30,50],
          limit: 10,
          done: function(res, curr, count){
              //curr 得到当前页码  count 得到数据总量
              /*res 如果是异步请求数据方式，res即为你接口返回的信息。
                如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度*/
            layer.close(index);
         }
    };
  
    myTable.render(options);
    
    routeActive = {
        getCheckData: function(){ //获取选中数据
          var checkStatus = myTable.checkStatus(options.id) , data = checkStatus.data;
          if(data.length > 0){
                var arr = [];
                $.each(data, function(key,val) {
                    arr.push(val.name);
                });
                this.delete(arr);
          }else{
              layer.msg('请选择删除行');
          }
        },
        refresh:function(obj){//表格刷新
            index = layer.msg('数据请求中...', {time:0,icon: 16,shade: 0.01});
            var whereObj = $.extend(obj, obj);
            myTable.reload(options.id, {
                url: options.url,
                method: options.method,
                where: obj
            });
        },
        search: function(){
            index = layer.msg('数据请求中...', {time:0,icon: 16,shade: 0.01});
            myTable.reload(options.id, {
              page: {curr: 1/**重新从第 1 页开始**/},
              where: {
                  where: {
                      name           : $.trim($('#cus-query-1').val()),
                      description    : $.trim($('#cus-query-2').val()),
                  }
              }
            });
        },
        resetSearch:function(){
            $('#cus-query-1,#cus-query-2').val('');
        },
        add:function(name){
            var title = '<i class="layui-icon">&#xe654;</i>添加权限信息';
            if(name != ''){
                title = '<i class="layui-icon">&#xe642;</i>编辑权限信息';
            }
            layer.open({
              title:title,
              type: 2,
              area: ['500px', '250px'],
              fixed: true, //不固定
              resize:false,
              maxmin: false,
              content: '/auth/get-route-box?route_name='+name,
              end:function(){
                  routeActive.refresh();
              }
            });
        },
        delete:function(arr){
            layer.confirm('确定要删除这些记录吗', function(index){
                layer.close(index);
                var loadIndex = layer.load(1, {shade: [0.1,'#fff']});
                $.ajax({
                    url:'/auth/delete-route-info',
                    type:'post',
                    data:{routes:arr},
                    dataType:'json',
                    success:function(res){
                        layer.close(loadIndex);
                        var icon = res.code ==200?6:5;
                        layer.msg(res.message, {icon: icon});
                        if(res.code ==200){
                            setTimeout(function(){
                                routeActive.refresh();
                            },2000);
                        }
                    }
                });
            });
        }
    };

    myTable.on('sort(route-table-demo)', function(obj){
        routeActive.refresh({orderBy:obj.field,sort:obj.type});
    });
  
    //监听工具条
    myTable.on('tool(route-table-demo)', function(obj){
      var data = obj.data;
      if(obj.event === 'del'){
          var arr = [data.name];
          routeActive.delete(arr);
      } else if(obj.event === 'edit'){
          routeActive.add(data.name);
      }
    });
});
</script>