<style>
    .cus-menu-querybox{margin-top:10px;}
    .cus-menu-querybox input,.cus-menu-querybox button{height:30px;line-height:30px;}
</style>

<div class="demoTable cus-menu-querybox layui-form">
    <div class="layui-form-item">
        <div class="layui-input-inline" style="width:150px;">
            <select name="status" id="user-query-1">
              <option value="">请选择启用状态</option>
              <option value="all" selected="">全部</option>
              <option value="0">未启用</option>
              <option value="10">已启用</option>
            </select>
        </div>
        <div class="layui-input-inline">
            <input type="text"  placeholder="手机号" autocomplete="off" class="layui-input" id="user-query-2">
        </div>
        <div class="layui-input-inline">
            <input type="text"  placeholder="电子邮件" autocomplete="off" class="layui-input" id="user-query-3">
        </div>
        <button class="layui-btn layui-btn-normal" onclick="userActive.search()"><i class="layui-icon">&#xe615;</i></button>
        <button class="layui-btn layui-btn-warm" onclick="userActive.resetSearch()">重 置</button>
    </div>
</div>

<p class="layui-btn-group demoTable">
   <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="userActive.refresh()" ><i class="layui-icon">&#x1002;</i>刷 新</button>
</p>

<table id="user-table" lay-filter="user-table-demo"></table>

<script type="text/html" id="user-name-tpl">
  {{d.sex == 1?'男':'女'}}
</script>

<script type="text/html" id="user-page-tpl">
  <input type="checkbox" value="{{d.id}}" title="启用" lay-filter="lockDemo" {{ d.status == 10 ? 'checked' : '' }}>
</script>
<script>
$(function(){
    var length = $(window).height() - $('#user-table').offset().top - 45 -35;
    var myTable = layui.table,form = layui.form;
    var index = '';
    var options = { //其它参数在此省略
          id:'user-table-id',
          elem: '#user-table',
          url: '/auth/uses-data-list',
          height:length,
          method: 'post',
          cellMinWidth:80,
          cols: [[ //标题栏
              {field: 'id', title: 'ID', width: 80, sort: true},
              {field: 'username', title: '手机号', width: 150},
              {field: 'sex', title: '性别', width: 80,templet:'#user-name-tpl'},
              {field: 'email', title: '电子邮件', minWidth: 150},
              {field: 'created_at', title: '注册时间', width: 170,sort: true},
              {field:'status', title:'是否启用', width:110, templet: '#user-page-tpl', unresize: true}
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
    
    userActive = {
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
                      status:$('#user-query-1').val(),
                      username: $.trim($('#user-query-2').val()),
                      email:$('#user-query-3').val(),
                  }
              }
            });
        },
        resetSearch:function(){
            $('#user-query-1,#user-query-2,#user-query-3').val('');
        }
    };

    //监听表格复选框选择
    myTable.on('checkbox(user-table-demo)', function(obj){
      console.log(obj.checked); //当前是否选中状态
      console.log(obj.data); //选中行的相关数据
      console.log(obj.type); //如果触发的是全选，则为：all，如果触发的是单选，则为：one
    });

    myTable.on('sort(user-table-demo)', function(obj){
        userActive.refresh({orderBy:obj.field,sort:obj.type});
    });
  
    //监听工具条
    myTable.on('tool(user-table-demo)', function(obj){
      var data = obj.data;
      if(obj.event === 'detail'){
          layer.msg('ID：'+ data.id + ' 的查看操作');
      } else if(obj.event === 'del'){
          layer.confirm('真的删除行么', function(index){
            obj.del();
            layer.close(index);
          });
      } else if(obj.event === 'edit'){
          layer.alert('编辑行：<br>'+ JSON.stringify(data));
      }else if(obj.event === 'setSign'){//监听单元格事件
          //查看详情
      }
    });
  
    //监听锁定操作
    form.on('checkbox(lockDemo)', function(obj){
        var status = obj.elem.checked ?10:0;
        var user_id = this.value;
        $.ajax({
            url:'/auth/change-user-status',
            type:'post',
            data:{user_id:user_id,status:status},
            dataType:'json',
            success:function(res){
                console.log(res);
                if(res.code !== 200){
                    layer.tips('更新失败',obj.othis);
                    userActive.refresh();
                }else{
                    layer.tips(obj.elem.checked?'已启用':'已禁用',obj.othis);
                }
            }
        });
    });
});
</script>