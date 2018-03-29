<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 角色管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="Hui-article">
    <article class="cl pd-20">
         <div class="text-c"> 
            <form action="javascript:void(0)" id="search-role-from">
                <input type="text" name="name" placeholder="父级栏目"  class="input-text table-search-input">
                <button name="" id="submit" class="btn btn-success me-table-reload" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
                <button name="" id="submit" class="btn btn-success" type="reset"><i class="Hui-iconfont">&#xe66c;</i> 重置</button>
            </form>
        </div><br/>
        <div class="cl pd-5 bg-1 bk-gray">
            <span class="l">
                <a class="btn btn-primary radius" href="javascript:void(0);" data-toggle="modal" data-target="#role-add-modal"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> 
                <a class="btn btn-primary radius btn-success me-table-reload" href="javascript:;"><i class="Hui-iconfont">&#xe68f;</i> 刷新</a> 
            </span> 
            <span class="r">共有数据：<strong>54</strong> 条</span> </div>
        <div class="mt-10">
            <table class="table table-border table-bordered table-hover table-bg" id="table-role-list"></table>
        </div>
    </article>
</div>

<div id="role-add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content radius">
            <form class="form form-horizontal" id="form-route-add">
                <div class="modal-header">
                    <h3 class="modal-title">添加栏目</h3><a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" placeholder="角色名" name="name" id="role-name">
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">描述：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" placeholder="描述" name="description" id="role-description">
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
        sAjaxSource: "/role/get-role-list",
        columns: [
            {data:null,title:'<input type="checkbox" />',width:30,orderable:false,class:'table-checkbox',visible:false,
                render:function(data){
                    return '<input type="checkbox" value="' + data["name"] + '" />';
                }
            },
            {title: '角色',data: 'name'},
            {title: '描述',data: 'description'},
            {title: '添加时间',data: 'created_at',width:150},
            {title: '修改时间',data: 'updated_at',width:150},
            {title: '操作',data: null,orderable: false,width:150,
                render:function(data, type, row, meta) {
                    var edit  = '<a title="编辑信息" onclick="MeTable.edit('+meta.row+')">编辑信息</a> ';
                    var edit2  = '<a title="编辑权限" href="/role/edit-role?name='+ data["name"] +'">编辑权限</a> ';
                    var del = '<a title="删除" onclick="MeTable.del(\''+data["name"]+'\')">删除</a>';
                    return edit + edit2 + del;
                }
            },
        ],
        columnDefs: [
            { orderable: false,targets: [0,1,2,4]},
        ]
    };

    var option = {mTableId:'#table-role-list',mRefresh:'.me-table-reload',mSearchFormId:'#search-role-from'}

    var MeTable = new MyTable(option,tableOption);

    MeTable.edit = function(id){
        var data = this.getRowData(id);
        $('#role-name').attr('disabled',true);
        $('#form-route-add').setForm(data);
        $('#role-add-modal').modal('show');
    }

    MeTable.hideModal = function(){
        $('#role-name').attr('disabled',false);
        $('#form-route-add')[0].reset();
        $("#form-route-add").validate().resetForm();  ;
    }

    MeTable.editSubmit = function(){
        var url = $('#role-name').attr('disabled') ?'/role/update':'/role/create';
        var obj = {url:url,data:{name:$.trim($('#role-name').val()),description:$.trim($('#role-description').val())}}
        this.save(obj);
        $('#role-add-modal').modal('hide');
    }

    MeTable.del = function(index){
        var loadloging = layer.confirm('您是确定要删除这条条记录吗？', {
          btn: ['确定','取消']
        }, function(){
            MeTable.save({url:'/role/delete',data:{name:index}});
            layer.close(loadloging);
        }, function(){
            layer.msg('您取消的删除操作！', {time: 2000});
        });
    }

    $('#role-add-modal').on('hide.bs.modal',MeTable.hideModal);
    $("#form-route-add").validate({
        rules:{name:{required:true,minlength:2},description:{required:true}},
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