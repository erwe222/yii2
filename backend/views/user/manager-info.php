<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 
    <span class="c-gray en">&gt;</span> 个人信息管理 
    <span class="c-gray en">&gt;</span> 个人信息 
</nav>

<div class="panel panel-default" style="width: 80%;margin:0 auto;margin-top:20px;">
    <div class="panel-header">个人信息</div>
    <div class="panel-body">
        <form action="" method="post" class="form form-horizontal" id="manager-info-form" novalidate="novalidate">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">登录名：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input class="input-text" placeholder="" name="username" id="user_name" type="text" disabled="" value="<?php echo $admin_info->username?>">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">所属角色：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input class="input-text" placeholder="" name="role_name" id="role_name" type="text" disabled="" value="<?php echo $role_name?>">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">邮箱：</label>
                <div class="formControls col-xs-8 col-sm-6">
                    <input class="input-text valid" placeholder="@" name="email" id="user_email" type="text" value="<?php echo $admin_info->email?>">
                </div>
            </div>
            
            <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-3">手机号：</label>
                    <div class="formControls col-xs-8 col-sm-6">
                            <input class="input-text" autocomplete="off" placeholder="手机" name="user_telephone" id="user_telephone" type="text" value="<?php echo $admin_info->user_telephone?>">
                    </div>
            </div>
            
            <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-3">微信：</label>
                    <div class="formControls col-xs-8 col-sm-6">
                            <input class="input-text" autocomplete="off" placeholder="微信" name="user_wechat" id="user_wechat" type="text" value="<?php echo $admin_info->user_wechat?>">
                    </div>
            </div>
            
            <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-3">QQ号：</label>
                    <div class="formControls col-xs-8 col-sm-6">
                            <input class="input-text" autocomplete="off" placeholder="QQ号" name="user_qq" id="user_qq" type="text" value="<?php echo $admin_info->user_qq?>">
                    </div>
            </div>

<!--            <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-3">备注：</label>
                    <div class="formControls col-xs-8 col-sm-6">
                        <textarea class="textarea" placeholder="说点什么...最少输入10个字符" name="beizhu" onkeyup="$.Huitextarealength(this,500)"></textarea>
                        <p class="textarea-numberbar"><em class="textarea-length">0</em>/500</p>
                    </div>
            </div>-->

            <div class="row cl">
                    <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                            <input class="btn btn-primary" value="&nbsp;&nbsp;保存 / 修改&nbsp;&nbsp;" type="submit">
                    </div>
            </div>
        </form>
    </div>
</div>

<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    $("#manager-info-form").validate({
        rules:{
            email:{required:true,email:true},
            user_telephone:{isMobile:true},
       	},
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            var obj = {url:'/user/edit-manager-info',data:$('#manager-info-form').serializeArray()}
            sendAjax(obj);
            return false;
        }
    });
</script>
<?php $this->endBlock() ?>
