<style>
    .cus-menu-querybox{margin-top:10px;}
    .cus-menu-querybox input,.cus-menu-querybox button{height:30px;line-height:30px;}
</style>

<div class="cus-menu-querybox layui-form">
    <div class="layui-form-item">
        <div class="layui-input-inline" style="width:150px;">
            <select name="status" id="cus-query-2">
              <option value="">请选择启用状态</option>
              <option value="all" selected="">全部</option>
              <option value="2">未启用</option>
              <option value="1">已启用</option>
            </select>
        </div>
        <div class="layui-input-inline">
            <input type="text" name="sdfasd"  placeholder="菜单名(模糊匹配)" autocomplete="off" class="layui-input" id="cus-query-1">
        </div>
        <button class="layui-btn layui-btn-normal" onclick="menuActive.search()"><i class="layui-icon">&#xe615;</i></button>
        <button class="layui-btn layui-btn-warm" onclick="menuActive.resetSearch()">重 置</button>
    </div>
</div>

<p class="layui-btn-group">
  <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="menuActive.getCheckData()"><i class="layui-icon">&#xe640;</i> 批量删除</button>
  <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="menuActive.add(0)"><i class="layui-icon">&#xe654;</i>添加菜单</button>
  <button class="layui-btn layui-btn-normal layui-btn-sm" onclick="menuActive.refresh()"><i class="layui-icon">&#x1002;</i>刷 新</button>
</p>

<table id="menu-table" lay-filter="menu-table-demo"></table>


<script type="text/html" id="menu-barDemo">
  <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="edit" ><i class="layui-icon">&#xe642;</i></a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i></a>
</script>


<script type="text/html" id="menu-name-tpl">
  {{#  if(d.pid == 0){ }}
    <span style="color: #F581B1;">{{ d.parent_name }}</span>
  {{#  } else { }}
    {{ d.parent_name }}
  {{#  } }}
</script>
<script type="text/html" id="menu-checkbox">
  <input type="checkbox" value="{{d.id}}" title="启用" lay-filter="lockDemo" {{ d.status == 1 ? 'checked' : '' }}>
</script>
<script>
$(function(){
    var length = $(window).height() - $('#menu-table').offset().top - 45 -35;
    var myTable = layui.table,form = layui.form;
    var index = '';
    var options = { //其它参数在此省略
          id:'menu-table-id',
          elem: '#menu-table',
          url: '/auth/menu-data-list',
          height:length,
          method: 'post',
          cellMinWidth:80,
          cols: [[ //标题栏
              {checkbox: true, LAY_CHECKED: false},
              {field: 'id', title: 'ID', width: 80, sort: true},
              {field: 'parent_name', title: '父级栏目', width: 150,templet:'#menu-name-tpl'},
              {field: 'menu_name', title: '菜单名', width: 150},
              {field: 'icons', title: '图标', width: 150,event: 'setSign'},
              {field: 'url', title: '页面地址', width: 150},
              {field:'status', title:'是否启用', width:110, templet: '#menu-checkbox', unresize: true},
              {field: 'created_at', title: '操作时间', width: 170,sort: true},
              {fixed: 'right', width:110, align:'center', toolbar: '#menu-barDemo',title:'操 作'},
          ]],
          skin: 'row', //表格风格
          even: true,
          page: true, //是否显示分页
          limits: [10,20,30,50],
          limit: 10,
          done: function(res, curr, count){
              //curr 得到当前页码  count 得到数据总量 res 如果是异步请求数据方式，res即为你接口返回的信息。如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
            layer.close(index);
          },
          error:function(e,t){
              if(e.status == 403){
                  layer.close(index);
                  layer.msg('对不起，您现在还没获得该操作的权限!', {icon: 5});
              }
          }
    };

    myTable.render(options);
    
    menuActive = {
        getCheckData: function(){ //获取选中数据
          var checkStatus = myTable.checkStatus(options.id) , data = checkStatus.data;
          //layer.alert(JSON.stringify(data));
          var arr = [];
            $.each(data, function(key,val) {
                arr.push(val.id);
            });
            this.delete(arr);
        }
        ,isAll: function(){ //验证是否全选
          var checkStatus = myTable.checkStatus(options.id);
          layer.msg(checkStatus.isAll ? '全选': '未全选')
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
                      menu_name: $.trim($('#cus-query-1').val()),
                      status:$('#cus-query-2').val(),
                  }
              }
            });
        },
        resetSearch:function(){
            $('#cus-query-1,#cus-query-2').val('');
        },
        add:function(id){
            var title = '<i class="layui-icon">&#xe654;</i>添加菜单信息';
            if(id != 0){
                title = '<i class="layui-icon">&#xe642;</i>编辑菜单信息';
            }
            layer.open({
              title:title,
              type: 2,
              area: ['500px', '400px'],
              fixed: true, //不固定
              resize:false,
              maxmin: false,
              content: '/auth/get-menu-box?menu_id='+id,
              end:function(){
                setTimeout(function(){
                    menuActive.refresh();
                },1000);
              }
            });
        },
        delete:function(arr){
            layer.confirm('确定要删除这些记录吗', function(index){
                layer.close(index);
                var loadIndex = layer.load(1, {shade: [0.1,'#fff']});
                $.ajax({
                    url:'/auth/delete-menu-info',
                    type:'post',
                    data:{menus:arr},
                    dataType:'json',
                    success:function(res){
                        layer.close(loadIndex);
                        var icon = res.code ==200?6:5;
                        layer.msg(res.message, {icon: icon});
                        if(res.code ==200){
                            setTimeout(function(){
                                menuActive.refresh();
                            },1000);
                        }
                    }
                });
            });
        }
    };

    //监听表格复选框选择
    myTable.on('checkbox(menu-table-demo)', function(obj){
      console.log(obj.checked); //当前是否选中状态
      console.log(obj.data); //选中行的相关数据
      console.log(obj.type); //如果触发的是全选，则为：all，如果触发的是单选，则为：one
    });

    myTable.on('sort(menu-table-demo)', function(obj){
        menuActive.refresh({orderBy:obj.field,sort:obj.type});
    });

    //监听工具条
    myTable.on('tool(menu-table-demo)', function(obj){
      var data = obj.data;
      if(obj.event === 'del'){
          var arr = [data.id];
          menuActive.delete(arr);
      } else if(obj.event === 'edit'){
          menuActive.add(data.id);
      }
    });
  
    //监听锁定操作
    form.on('checkbox(lockDemo)', function(obj){
        var status = obj.elem.checked ?1:2;
        $.ajax({
            url:'/auth/change-menu-info',
            type:'post',
            data:{id:this.value,status:status},
            dataType:'json',
            success:function(res){
                if(res.code !== 200){
                    layer.tips('更新失败',obj.othis);
                    menuActive.refresh();
                }else{
                    layer.tips(obj.elem.checked?'已启用':'已禁用',obj.othis);
                }
            }
        });
    });
});
</script>