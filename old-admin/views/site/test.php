<?= \seller\widgets\BreadcrumbWidget::widget([
    'navarr'=>[
        ['name'=>'自营店管理','href'=>'/classify/menu'],
        ['name'=>'分类模块管理','href'=>''],
    ]
]);?>

<style>
    .cus-menu-querybox{margin-top:10px;}
    .cus-menu-querybox input,.cus-menu-querybox button{height:30px;line-height:30px;}
</style>

<div class="demoTable cus-menu-querybox layui-form">
    <div class="layui-form-item">
        <div class="layui-input-inline" style="width:150px;">
            <select name="status">
              <option value="">请选择用户状态</option>
              <option value="all" selected="">全部</option>
              <option value="10">未锁定</option>
              <option value="0">已锁定</option>
            </select>
        </div>
        <div class="layui-input-inline">
            <input type="text" name="sdfasd"  placeholder="分类名" autocomplete="off" class="layui-input" id="cus-query-1">
        </div>
        <div class="layui-input-inline">
             <input type="text" name="password"  placeholder="时间" autocomplete="off" class="layui-input" id="cus-query-2">
        </div>
        <button class="layui-btn layui-btn-normal" onclick="active.search()"><i class="layui-icon">&#xe615;</i></button>
        <button class="layui-btn layui-btn-warm" onclick="active.resetSearch()">重 置</button>
    </div>
</div>

<div class="layui-btn-group demoTable">
  <button class="layui-btn myEvent layui-btn-sm" data-type="getCheckData">获取选中行数据</button>
  <button class="layui-btn myEvent layui-btn-sm" data-type="getCheckLength">获取选中数目</button>
  <button class="layui-btn myEvent layui-btn-sm" data-type="isAll">验证是否全选</button>
  <button class="layui-btn myEvent layui-btn-sm" data-type="add">添加数据</button>
  <button class="layui-btn myEvent layui-btn-sm" data-type="refresh">表格刷新</button>
</div>

<table id="demo" lay-filter="my-demo"></table>


<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script type="text/html" id="switchTpl">
  <!-- 这里的 checked 的状态只是演示 -->
  <input type="checkbox" name="sex" value="{{d.status}}" lay-skin="switch" lay-text="女|男" lay-filter="sexDemo" {{ d.status == 0 ? 'checked' : '' }}>
</script>

<script type="text/html" id="checkboxTpl">
  <!-- 这里的 checked 的状态只是演示 -->
  <input type="checkbox" value="{{d.status}}" title="锁定" lay-filter="lockDemo" {{ d.status == 0 ? 'checked' : '' }}>
</script>
<script>
$(function(){
    var length = $(window).height() - $('#demo').offset().top - 45 -35;
    var myTable = layui.table,form = layui.form;
    var index = '';
    var options = { //其它参数在此省略
          id:'idTest',
          elem: '#demo',
          url: '/classify/get-post-data-menu',
          height:length,
          method: 'post',
          cellMinWidth:80,
          cols: [[ //标题栏
              {checkbox: true, LAY_CHECKED: false},
              {field: 'id', title: 'ID', width: 80, sort: true},
              {field: 'username', title: '管理员ID', width: 120},
              {field: 'auth_key', title: '动作', width: 150,event: 'setSign'},
              {field: 'password_hash', title: '描述', width: 150,edit: 'text'},
              {field: 'created_at', title: '操作时间', minWidth: 150,sort: true},
              {field:'sex', title:'性别', width:85, templet: '#switchTpl', unresize: true},
              {field:'status', title:'是否锁定', width:110, templet: '#checkboxTpl', unresize: true},
              {fixed: 'right', width:178, align:'center', toolbar: '#barDemo',title:'操 作'},
          ]],
          skin: 'row', //表格风格
          even: true,
          page: true, //是否显示分页
          limits: [20],
          limit: 20,
          done: function(res, curr, count){
              //curr 得到当前页码  count 得到数据总量
              /*res 如果是异步请求数据方式，res即为你接口返回的信息。
                如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度*/
            layer.close(index);
         }
    };
  
    myTable.render(options);
    
    active = {
        getCheckData: function(){ //获取选中数据
          var checkStatus = myTable.checkStatus(options.id) , data = checkStatus.data;
          layer.alert(JSON.stringify(data));
        }
        ,getCheckLength: function(){ //获取选中数目
          var checkStatus = myTable.checkStatus(options.id) , data = checkStatus.data;
          layer.msg('选中了：'+ data.length + ' 个');
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
              where: {key: {id: 'sss'}}
            });
        },
        resetSearch:function(){
            $('#cus-query-1,#cus-query-2').val('');
        },
        add:function(){
            alert('sdaf');
        }
    };

    //监听表格复选框选择
    myTable.on('checkbox(my-demo)', function(obj){
      console.log(obj.checked); //当前是否选中状态
      console.log(obj.data); //选中行的相关数据
      console.log(obj.type); //如果触发的是全选，则为：all，如果触发的是单选，则为：one
    });

    myTable.on('sort(my-demo)', function(obj){
        active.refresh({orderBy:obj.field,sort:obj.type});
    });
  
    //监听工具条
    myTable.on('tool(my-demo)', function(obj){
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
          layer.prompt({formType: 2,title: '标题',value: data.sign}, function(value, index){
            layer.close(index);
            //这里一般是发送修改的Ajax请求
            //同步更新表格和缓存对应的值
            obj.update({action: value});
          });
      }
    });

    //监听单元格编辑
    myTable.on('edit(my-demo)', function(obj){
        var value = obj.value //得到修改后的值
        ,data = obj.data //得到所在行所有键值
        ,field = obj.field; //得到字段
        layer.msg('[ID: '+ data.id +'] ' + field + ' 字段更改为：'+ value);
    });

    //监听性别操作
    form.on('switch(sexDemo)', function(obj){
      layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
      //obj.elem.checked = false;
    });
  
    //监听锁定操作
    form.on('checkbox(lockDemo)', function(obj){
        layer.tips(obj.elem.checked?'已锁定':'已解锁',obj.othis);
        //layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
        //obj.elem.checked = false;
    });

    $('.myEvent').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });
});
</script>