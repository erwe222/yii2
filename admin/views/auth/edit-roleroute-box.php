
        <table class="layui-table" lay-skin="line" id="role-route-list">
            <colgroup><col width="5"><col width="150"><col width="200"><col></colgroup>
            <thead><tr><th><input type="checkbox" value="" id="all" ></th><th>权限</th><th>权限描述</th></tr></thead>
        </table>
        <div style="height:400px;overflow-y:auto;margin-top:-10px;">
            <table class="layui-table" lay-skin="line" style="margin-top:0px;" id="role-route-list2">
                <colgroup><col width="5"><col width="150"><col width="200"><col></colgroup>
                <tbody style="height:50px;overflow-y: ">
                  <?php foreach ($rules as $key=>$_v):?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $_v['name']?>" name="<?php echo 'routes['.$_v['name'].']'?>" 
                        <?php if(array_key_exists($key, $role_rules)){echo 'checked="checked"';}?>></td>
                        <td><?php echo $_v['description']?></td>
                        <td><?php echo $_v['name']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            
        </div>
        <div style="text-align:center;margin-top:20px;">
            <button class="layui-btn layui-btn-radius layui-btn-normal" onclick="submit()"><i class="layui-icon">&#xe618;</i>提交修改</button>
            <!--<button class="layui-btn layui-btn-radius layui-btn-primary" onclick="colse()"><i class="layui-icon">&#x1006;</i>关闭窗口</button>-->
        </div>
        <script src="/assets/custom/js/jquery.min.js" ></script>
        <script>
            var layer;
            layui.use(['layer', 'form'], function() {
                layer = layui.layer;
            });
            
            $(document).on('click', '#role-route-list thead th input:checkbox' , function(){
                var that = this;
                $('#role-route-list2 tbody tr td input:checkbox').each(function(){
                    this.checked = that.checked;
                });
            }).on('click', '#role-route-list2 tbody tr td input:checkbox' , function(){
                load();
            });

            function load(){
               var checkbox_num = $('#role-route-list2 tbody tr td input:checkbox').length
                var checked_num = $('#role-route-list2 tbody tr td input:checkbox:checked').length;
                if(checkbox_num == checked_num){
                    document.getElementById("all").checked = true;
                }else{
                    document.getElementById("all").checked = false;
                } 
            }
            
            function submit(){
                var loadIndex = layer.load(1, {shade: [0.3, '#fff']});
                var arr = [];
                $('#role-route-list2 tbody tr td input:checkbox:checked').each(function(){
                        arr.push($(this).val());
                });
                var name = "<?php echo $name;?>"; 
                $.ajax({
                    url:'/auth/change-role-route',
                    type:'post',
                    data:{routes:arr,name:name},
                    dataType:'json',
                    success:function(res){
                        layer.close(loadIndex);
                        var icon = res.code ==200?6:5;
                        layer.msg(res.message, {icon: icon});
                        setTimeout(function(){
                            parent.layer.close(parent.layer.getFrameIndex(window.name));
                        },1000);
                    },
                    error:function(e,t){
                        if(e.status == 403){
                            layer.close(loadIndex);
                            layer.msg('对不起，您现在还没获得该操作的权限!', {icon: 5});
                        }else{
                            layer.msg('对不起，网络繁忙请稍后再试!', {icon: 5});
                        }
                    }
                });
            }
            
            function colse(){
                parent.layer.close(parent.layer.getFrameIndex(window.name));
            }

            $(function(){load();})
        </script>
