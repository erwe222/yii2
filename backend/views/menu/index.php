<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 菜单管理 </nav>
<div class="Hui-article">
    <article class="cl pd-20">
        <div class="text-c"> 
            <form action="javascript:void(0)" id="search-route-from">
                <span class="select-box" style="width:80px">
                    <select class="select" size="1" name="status" >
                      <option value="all" selected >全部</option>
                      <option value="1">启用</option>
                      <option value="2">禁用</option>
                    </select>
                </span>
                <input type="text" name="menu_name" placeholder="栏目"  class="input-text table-search-input">
                <button name="" id="submit" class="btn btn-success me-table-reload" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
                <button name="" id="submit" class="btn btn-success" type="reset"><i class="Hui-iconfont">&#xe66c;</i> 重置</button>
            </form>
        </div><br/>
        <div class="cl pd-5 bg-1 bk-gray"> 
            <span class="l"> 
                <a class="btn btn-danger radius" href="javascript:;"  onclick="MeTable.del()"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
                <a class="btn btn-primary radius" href="javascript:void(0);" data-toggle="modal" data-target="#role-add-modal"><i class="Hui-iconfont">&#xe600;</i> 添加栏目</a> 
                <a class="btn btn-primary radius btn-success me-table-reload" ><i class="Hui-iconfont">&#xe68f;</i> 刷新</a> 
            </span> 
            <span class="r">共有数据：<strong id='data-total'>0</strong> 条</span> 
        </div>
        <div class="mt-10">
            <table class="table table-border table-bordered table-hover table-bg table-striped" id="table-route-list"></table>
        </div>
    </article>
</div>
<div id="role-add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:999">
    <div class="modal-dialog">
        <div class="modal-content radius">
            <form class="form form-horizontal" id="form-route-add">
                <div class="modal-header">
                    <h3 class="modal-title">添加栏目</h3><a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body">
                    <input id="menumodel-menu_id"  name="id" value="0"  type="hidden">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>父级栏目：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                                <select class="select" id="menumodel-menu_pid" name="pid">
                                    <?php foreach ($menu_list as $_v):?>
                                    <option value="<?php echo $_v['id']?>"><?php echo $_v['menu_name']?></option>
                                    <?php endforeach;?>
                                </select>
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>栏目名：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" placeholder="栏目名" name="menu_name" id="menu_name">
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">图标：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" placeholder="图标" name="icons" id="icons" style="width: 300px;">&nbsp;<a class="label label-secondary radius" onclick="layer_show('图标','/site/icon',600,400)">查看图标</a>
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">访问地址：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" placeholder="访问地址" name="url" id="url">
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">状态：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <label><input type="radio"  name="status"  value="1" checked="">启用</label>&nbsp;&nbsp;
                            <label><input type="radio"  name="status"  value="2">禁用</label>
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">排序字段：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" placeholder="排序字段" name="sort" id="sort" onkeyup="this.value = this.value.replace(/[^0-9.]/g,'')">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" >
                    <button class="btn btn-primary">确定</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
var tableOption = {
        sAjaxSource: "/menu/get-menu-list",
        columns: [
            {data:null,title:'<input type="checkbox" />',width:30,orderable:false,class:'table-checkbox',
                render:function(data){
                    return '<input type="checkbox" value="' + data["id"] + '" />';
                }
            },
            {title: '父级栏目',data: 'parent_name',width:150,
                render:function(data, type, row, meta) {
                    return (data == '' || data==  null)?'顶级分栏':data;
                }
            },
            {title: '栏目',data: 'menu_name',align: 'center'},
            {title: '路由',data: 'url'},
            {title: '图标',data: 'icons'},
            {title: '状态',data: 'status',width:50,
                render:function(data, type, row, meta) {
                    return data == 1? '<span class="label label-success radius">已启用</span>': '<span class="label label-danger radius">禁&nbsp;&nbsp;&nbsp;用</span>';
                }
            },
            {title: '排序',data: 'sort',align: 'center',width:50},
            {title: '创建时间',data: 'created_at',align: 'center',width:200},
            {title: '操作',data: null,orderable: false,width:50,
                render:function(data, type, row, meta) {
                    var edit  = '<a style="text-decoration:none" class="ml-5"   title="编辑" onclick="MeTable.edit('+meta.row+')"><i class="Hui-iconfont"></i></a>';
                    var del = '<a style="text-decoration:none" class="ml-5"   title="删除" onclick="MeTable.del(\''+data["id"]+'\')"><i class="Hui-iconfont">&#xe609;</i></a>';
                    return edit + del;
                }
            },
        ],
        columnDefs: [
            { orderable: false,targets: [0,1,2,3,4,5,6]},
        ]
    };

    var option = {mTableId:'#table-route-list',mRefresh:'.me-table-reload',mSearchFormId:'#search-route-from'}

    var MeTable = new MyTable(option,tableOption);

    MeTable.edit = function(id){
        var data = this.getRowData(id);
        $('#route-name').attr('disabled',true);
        $('#form-route-add').setForm(data);
        $('#role-add-modal').modal('show');
    }

    MeTable.hideModal = function(){
        $('#route-name').attr('disabled',false);
        $('#form-route-add')[0].reset();
        $("#form-route-add").validate().resetForm();
        $('#menumodel-menu_id').val(0);
    }

    MeTable.editSubmit = function(){
        var url = parseInt($('#menumodel-menu_id').val()) == 0 ? '/menu/create':'/menu/update';
        var obj = {url:url,data:$('#form-route-add').serializeArray()}
        this.save(obj);
        $('#role-add-modal').modal('hide');
    }

    MeTable.del = function(index){
        if(index == undefined){
            var data = this.getCheckBoxSelect();
        }else{
            var data = [index];
        }
        var loadloging = layer.confirm('您是确定要删除'+data.length+'条记录吗？', {
          btn: ['确定','取消']
        }, function(){
            MeTable.save({url:'/menu/delete',data:{id:data}});
            layer.close(loadloging);
        }, function(){
            layer.msg('您取消的删除操作！', {time: 2000});
        });
    }

    $('#role-add-modal').on('hide.bs.modal',MeTable.hideModal);
    $("#form-route-add").validate({
        rules:{menu_name:{required:true},sort:{required:true,digits:true}},
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            MeTable.editSubmit();
            return false;
        }
    });

    $(function(){MeTable.init();});
</script>
<?php $this->endBlock() ?>
