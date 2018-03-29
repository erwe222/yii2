<style>
    .cus-menu-querybox{margin-top:10px;}
    .cus-menu-querybox input,.cus-menu-querybox button{height:30px;line-height:30px;}
</style>

<div class="demoTable cus-menu-querybox layui-form">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="text"  placeholder="角色名" autocomplete="off" class="layui-input" id="cus-query-1">
        </div>
        <button class="layui-btn layui-btn-normal" onclick="roleActive.search()"><i class="layui-icon">&#xe615;</i></button>
        <button class="layui-btn layui-btn-warm" onclick="roleActive.resetSearch()">重 置</button>
    </div>
</div>

<p class="layui-btn-group demoTable">
  <!--<button class="layui-btn layui-btn-normal layui-btn-sm" onclick="roleActive.getCheckData()" ><i class="layui-icon">&#xe640;</i> 批量删除</button>-->
  <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="roleActive.add('')" ><i class="layui-icon">&#xe654;</i>添加角色</button>
  <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="roleActive.refresh()" ><i class="layui-icon">&#x1002;</i>刷 新</button>
</p>

<table id="role-table" lay-filter="role-table-demo"></table>
<script type="text/html" id="role-table-barDemo">
  <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="edit"><i class="layui-icon">&#xe642;</i></a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i></a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="editRoute"><i class="layui-icon">&#xe631;</i></a>
</script>
<script>
$(function(){
    var length = $(window).height() - $('#role-table').offset().top - 45 -35;
    var myTable = layui.table,form = layui.form;
    var index = '';
    var options = { //其它参数在此省略
          id:'role-table-id',
          elem: '#role-table',
          url: '/auth/role-data-list',
          height:length,
          method: 'post',
          cellMinWidth:80,
          cols: [[ //标题栏
              {checkbox: true, LAY_CHECKED: false},
              {field: 'name', title: '角色名', width: 200},
              {field: 'description', title: '角色描述', minWidth: 150},
              {field: 'created_at', title: '操作时间', width: 170,sort: true},
              {fixed: 'right', width:150, align:'center', toolbar: '#role-table-barDemo',title:'操 作'},
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
    
    roleActive = {
        getCheckData: function(){ //获取选中数据
          var checkStatus = myTable.checkStatus(options.id) , data = checkStatus.data;
          if(data.length > 0){
              var arr = [];
                $.each(data, function(key,val) {
                    arr.push(val.id);
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
                  }
              }
            });
        },
        resetSearch:function(){
            $('#cus-query-1,#cus-query-2').val('');
        },
        add:function(name){
            var title = '<i class="layui-icon">&#xe654;</i>添加角色信息';
            if(name != ''){
                title = '<i class="layui-icon">&#xe642;</i>编辑角色信息';
            }
            layer.open({
              title:title,
              type: 2,
              area: ['500px', '250px'],
              fixed: true, //不固定
              resize:false,
              maxmin: false,
              content: '/auth/get-role-box?role_name='+name,
              end:function(){
                  roleActive.refresh();
              }
            });
        },delete:function(name){
            layer.confirm('确定要删除这些记录吗', function(index){
                layer.close(index);
                var loadIndex = layer.load(1, {shade: [0.1,'#fff']});
                $.ajax({
                    url:'/auth/delete-role-info',
                    type:'post',
                    data:{name:name},
                    dataType:'json',
                    success:function(res){
                        layer.close(loadIndex);
                        var icon = res.code ==200?6:5;
                        layer.msg(res.message, {icon: icon});
                        if(res.code ==200){
                            setTimeout(function(){
                                roleActive.refresh();
                            },2000);
                        }
                    }
                });
            });
        }
    };

    myTable.on('sort(role-table-demo)', function(obj){
        roleActive.refresh({orderBy:obj.field,sort:obj.type});
    });
  
    //监听工具条
    myTable.on('tool(role-table-demo)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            roleActive.delete(data.name);
        } else if(obj.event === 'edit'){
            roleActive.add(data.name);
        } else if(obj.event === 'editRoute'){
            var json = {
                        id: 'my-iinfo',
                        title: "编辑("+data.name+")权限",
                        icon: "&#xe642;",
                        url: '/auth/get-edit-role-route-box?role_name='+data.name
                    };
            window.parent.tabAdd(json);
        }
    });
});
</script>