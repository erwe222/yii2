<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 </nav>
<div class="Hui-article">
    <article class="cl pd-20">
        <div class="text-c"> 
            <form action="javascript:void(0)" id="search-route-from">
                <input type="text" name="name" placeholder=" 权限" class="input-text table-search-input">
                <input type="text" name="description"  placeholder=" 描述" class="input-text table-search-input">
                <button name="" id="submit" class="btn btn-success me-table-reload" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
                <button name="" id="submit" class="btn btn-success" type="reset"><i class="Hui-iconfont">&#xe66c;</i> 重置</button>
            </form>
        </div><br/>
        <div class="cl pd-5 bg-1 bk-gray"> 
            <span class="l"> 
                <a class="btn btn-danger radius" href="javascript:;"  onclick="MeTable.del()"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
                <a class="btn btn-primary radius" href="javascript:void(0);" data-toggle="modal" data-target="#role-add-modal"><i class="Hui-iconfont">&#xe600;</i> 添加权限</a> 
                <a class="btn btn-primary radius btn-success me-table-reload" ><i class="Hui-iconfont">&#xe68f;</i> 刷新</a> 
            </span> 
            <span class="r">共有数据：<strong id='data-total'>0</strong> 条</span> </div>
            <div class="mt-10">
                <table class="table table-border table-bordered table-hover table-bg table-striped" id="table-route-list"></table>
            </div>
    </article>
</div>
<div id="role-add-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:999">
    <div class="modal-dialog">
        <div class="modal-content radius">
            <form action="" method="post" class="form form-horizontal" id="form-route-add">
                <div class="modal-header">
                    <h3 class="modal-title">添加后台权限</h3><a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="权限" id="route-name" name="name">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">权限描述：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" placeholder="权限描述" name="description" id="description">
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
        sAjaxSource: "/route/get-route-list",
        columns: [
            {data:null,title:'<input type="checkbox" >',width:30,orderable:false,class:'table-checkbox',textAlign:'center',
                render:function(data){
                    return '<input type="checkbox" value="' + data["name"] + '" />';
                }
            },
            {title: '权限',data: 'name',
                render:function(data, type, row, meta) {
                    return '<a href="'+data+'">'+data+'</a>';
                }
            },
            {title: '描述',data: 'description'},
            {title: '添加时间',data: 'created_at',orderable: true},
            {title: '修改时间',data: 'updated_at',orderable: true},
            {title: '操作',data: null,orderable: false,width:50,
                render:function(data, type, row, meta) {
                    var edit  = '<a style="text-decoration:none" class="ml-5"   title="编辑" onclick="MeTable.edit('+meta.row+')"><i class="Hui-iconfont"></i></a>';
                    var del = '<a style="text-decoration:none" class="ml-5"   title="删除" onclick="MeTable.del(\''+data["name"]+'\')"><i class="Hui-iconfont">&#xe609;</i></a>';
                    return edit + del;
                }
            },
        ],
        columnDefs: [
            { orderable: false,targets: [0,1,2,3,4]},
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
        $("#form-route-add").validate().resetForm();  ;
    }
    MeTable.editSubmit = function(){
        var url = $('#route-name').is(':disabled') ?'/route/update':'/route/assign';
        var obj = {url:url,data:{name:$('#route-name').val(),description:$('#description').val()}}
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
            MeTable.save({url:'/route/remove',data:{routes:data}});
            layer.close(loadloging);
        }, function(){
            layer.msg('您取消的删除操作！', {time: 2000});
        });
    }
    $('#role-add-modal').on('hide.bs.modal',MeTable.hideModal);
    $("#form-route-add").validate({
        rules:{name:{required:true,minlength:6},description:{required:true}},
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
