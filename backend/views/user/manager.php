<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 角色管理 </nav>
<div class="Hui-article">
    <article class="cl pd-20">
        <div class="text-c"> 
            <form action="javascript:void(0)" id="search-route-from">
                <input type="text" name="username" placeholder=" 登录名" style="width:150px" class="input-text">
                <input type="text" name="email" placeholder=" 邮箱" style="width:150px" class="input-text">
                <button  class="btn btn-success me-table-reload" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
                <button  class="btn btn-success" type="reset"><i class="Hui-iconfont">&#xe66c;</i> 重置</button>
            </form>
        </div><br/>
        <div class="cl pd-5 bg-1 bk-gray"> 
            <span class="l"> 
                <a class="btn btn-primary radius" href="javascript:void(0);" data-toggle="modal" data-target="#role-add-modal"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a> 
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
                    <input type="hidden"  value="0" name="id" id="edit-id">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>登录名：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="登录名" id="username" name="username">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" placeholder="邮箱" name="email" id="email">
                        </div>
                    </div>
                    
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <label><input type="radio"  name="status"  value="10" checked="">启用</label>&nbsp;&nbsp;
                            <label><input type="radio"  name="status"  value="0">禁用</label>
                        </div>
                    </div>
                    
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属角色：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <select class="select" id="menumodel-menu_pid" name="role_name">
                                <option value="">请选择角色...</option>
                                <?php if(count($role_infos) > 0):?>
                                    <?php foreach ($role_infos as $_v):?>
                                    <option value="<?php echo $_v['name'];?>"><?php echo $_v['name'];?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>登录密码：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="password" class="input-text" placeholder="登录密码" name="password" id="password">
                        </div>
                    </div>
                    
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="password" class="input-text" placeholder="登录密码" name="password2" id="password2">
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
        sAjaxSource: "/user/get-manager-list",
        columns: [
            {title: '',data: 'id',visible:false},
            {title: '登录名',data: 'username',width:150},
            {title: '邮箱',data: 'email',align: 'center'},
            {title: '所属角色',data: 'role_name',align: 'center',width:200},
            {title: '状态',data: 'status',width:40,
                render:function(data, type, row, meta) {
                    if(data == 10){
                        return '<i class="icon Hui-iconfont" style="font-size:20px;" title="启用">&#xe6e1;</i>'
                    }else{
                        return '<i class="icon Hui-iconfont" style="font-size:20px;" title="禁用">&#xe631;</i>';
                    }
                }
            },
            {title: '创建时间',data: 'created_at',align: 'center',width:200},
            {title: '操作',data: null,orderable: false,width:50,
                render:function(data, type, row, meta) {
                    var edit  = '<a style="text-decoration:none" class="ml-5"   title="编辑" onclick="MeTable.edit('+meta.row+')"><i class="Hui-iconfont"></i></a>';
                    return edit;
                }
            },
        ],
        columnDefs: [
            { orderable: false,targets: [0,1,2,3,4,6]},
        ]
    };

    var option = {mTableId:'#table-route-list',mRefresh:'.me-table-reload',mSearchFormId:'#search-route-from'}
    var MeTable = new MyTable(option,tableOption);
    MeTable.edit = function(id){
        var data = this.getRowData(id);
        $('#username').attr('disabled',true);
        $('#form-route-add').setForm(data);
        $('#password,#password2').attr('disabled',true).parent().parent().hide();
        $('#role-add-modal').modal('show');
    }
    MeTable.hideModal = function(){
        $('#username').attr('disabled',false);
        $('#password,#password2').attr('disabled',false).parent().parent().show();
        $('#form-route-add')[0].reset();
        $('#edit-id').val(0);
        $("#form-route-add").validate().resetForm();  ;
    }
    MeTable.editSubmit = function(){
        var url = $('#edit-id').val() == 0?"/user/add-manager":'/user/update-manager';
        var obj = {url:url,data:$('#form-route-add').serializeArray()}
        this.save(obj);
        $('#role-add-modal').modal('hide');
    }
    $('#role-add-modal').on('hide.bs.modal',MeTable.hideModal);
    $("#form-route-add").validate({
        rules:{email:{required:true,email: true}},
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
