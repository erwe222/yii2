<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 
    <span class="c-gray en">&gt;</span> 角色权限编辑 
</nav>
<div class="Hui-article">
    <div class="panel panel-default" style="width:80%;margin:0 auto;margin-top:10px;margin-bottom: 50px;">
        <div class="panel-header">角色权限编辑</div>
        <div class="panel-body">
            <form action='/role/edit-role-route' method="post">
            <table class="table table-border table-striped" id="role-route-list">
                <thead>
                    <tr>
                        <th><input type="checkbox" value="" id="all" ></th>
                        <th>权限</th>
                        <th>权限描述</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rules as $key=>$_v):?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $_v['name']?>" name="<?php echo 'routes['.$_v['name'].']'?>" 
                        <?php if(array_key_exists($key, $role_rules)){
                            echo 'checked="checked"';
                        }
                    ?>

                        ></td>
                        <td><?php echo $_v['description']?></td>
                        <td><?php echo $_v['name']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <p align="center" style="margin-top:10px;">
                <input type="hidden" name="name" value="<?php echo $name?>">
                <button class='btn btn-warning radius' type="reset">重置</button>
                &nbsp;&nbsp;
                <button class="btn btn-primary radius" type='submit'>提交</button >
            </p>
            </form>
        </div>
    </div>
</div>

<?php $this->beginBlock('javascript') ?>
<script>
    $(document).on('click', '#role-route-list thead th input:checkbox' , function(){
        var that = this;
        $(this).find('tr > td:first-child input:checkbox').each(function(){
            this.checked = that.checked;
        });
    }).on('click', '#role-route-list tbody td input:checkbox' , function(){
        load();
    });

    function load(){
       var checkbox_num = $('#role-route-list tbody td input:checkbox').length
        var checked_num = $('#role-route-list tbody td input:checkbox:checked').length;
        if(checkbox_num == checked_num){
            document.getElementById("all").checked = true;
        }else{
            document.getElementById("all").checked = false;
        } 
    }

    $(function(){load();})
</script>
<?php $this->endBlock() ?>
