<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 
	<span class="c-gray en">&gt;</span> 个人信息管理 
	<span class="c-gray en">&gt;</span> 密码修改 
</nav>
<div class="panel panel-primary" style="width: 600px;margin:0 auto;margin-top:20px;">
	<div class="panel-header">修改密码</div>
	<div class="panel-body">
		<form action="/user/edit-manager-pwd" method="post" class="form form-horizontal" id="manager-pwd-form">
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">旧密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" autocomplete="off" placeholder="旧密码" name="old_password">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">新密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" autocomplete="off" placeholder="新密码" name='password' id='password'>
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">确认密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" autocomplete="off" placeholder="确认密码" name="confirm_password">
				</div>
			</div>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<input class="btn btn-primary radius" type="submit" value="提交">
				</div>
			</div>
		</form>
	</div>
</div>
<?php $this->beginBlock('javascript') ?>
<script type="text/javascript">
    $("#manager-pwd-form").validate({
        rules:{
        	old_password:{required:true,minlength:6},
        	password:{required:true,minlength:6},
        	confirm_password:{equalTo:"#password"},
       	},
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
        	var obj = {url:'/user/edit-manager-pwd',data:$('#manager-pwd-form').serializeArray()}
        	sendAjax(obj);
        	return false;
        }
    });
</script>
<?php $this->endBlock() ?>