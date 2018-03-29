<style>
    .cus-elem-quote-rgt .cus-span{display:inline-block;width:30px;height:20px;line-height: 20px;background:#01AAED;text-align:center;font-weight:bold;color:#FFF;cursor:pointer;}
    .cus-elem-quote-rgt .cus-span:hover{background:#5FB878;}
    .cus-elem-quote-rgt .cus-span-select{background:#5FB878;}
    
    .cus-images-box{width:150px;height:150px;background:green;float:left;position:relative;margin-left:5px;margin-top:5px;}
    .cus-images-box .cus-images-tool{bottom:0px;position:absolute;width:100%;height:25px;z-index:2;background:#000;line-height:25px;text-align:right;display:none;}
    .cus-images-box .cus-images-tool span i{color:#FFF;font-weight:bold;cursor:pointer;}
    .font-color-green{color:green}
</style>

<div class="layui-elem-quote cus-elem-quote" >
    <i class="layui-icon">&#xe63a;</i> 请完善个人信息
    <div style="float:right;" class="cus-elem-quote-rgt">
        <span>选项 </span>
        <span class="cus-span cus-span-select">1</span>
        <span class="cus-span">2</span>
        <span class="cus-span">3</span>
    </div>
</div>       
<div class="layui-tab">
    <div class="layui-tab-content " id="cus-layui-tab-content">
      <div class="layui-tab-item layui-show">
            <div style="width:80%;height:100%;margin-left:30px;">
                  <font style="color:#01AAED;font-size:20px;font-weight:bold;">登录信息</font>
                  <hr class="layui-bg-blue" >
                  <table class="layui-table" lay-size="sm">
                      <tr>
                        <td width="150">登录名</td><td>admin</td>
                      </tr>
                      <tr>
                        <td>我的邮箱</td><td>83715079@qq..com</td>
                      </tr>
                      <tr>
                        <td>登录时间</td><td>2016-11-27 09:21:50</td>
                      </tr>
                      <tr>
                        <td>累计登录</td><td>123</td>
                      </tr>
                      <tr>
                        <td>上次登录时间</td><td>2016-11-26 09:21:50</td>
                      </tr>
                      <tr>
                        <td>IP地址</td><td>59.110.168.230</td>
                      </tr>
                  </table>
            </div>
            <div style="width:80%;height:100%;margin-left:30px;">
                <font style="color:#01AAED;font-size:20px;font-weight:bold;">操作记录</font>
                <hr class="layui-bg-blue" >
                <div style="width:100%;height:300px;border:1px solid #ccc;">
                    <div style="width:100%;height:30px;background:#ccc;line-height:30px;text-align:right;">
                        <div style="float:left;color:#5FB878;font-weight:bold;"><i class="layui-icon">&#xe688;</i> 记录日志</div>
                        <div style="float:right;">
                              <span style="color:#1E9FFF;font-weight:bold;cursor:pointer" title='刷新'><i class="layui-icon">&#x1002;</i></span>
                              <span style="color:#1E9FFF;font-weight:bold;cursor:pointer" title='上一页'><i class="layui-icon">&#xe603;</i></span>
                              <span style="color:#1E9FFF;font-weight:bold;cursor:pointer" title='下一页'><i class="layui-icon">&#xe602;</i></span>
                        </div>
                    </div>
                    <div style="height:270px;overflow-y:auto;width:100%">
                        <table class="layui-table" >
                          <tr>
                            <td width="150">登录名</td><td>admin</td>
                          </tr>
                          <tr>
                            <td>我的邮箱</td><td>83715079@qq..com</td>
                          </tr>
                          <tr>
                            <td>登录时间</td><td>2016-11-27 09:21:50</td>
                          </tr>
                          <tr>
                            <td>累计登录</td><td>123</td>
                          </tr>
                          <tr>
                            <td>上次登录时间</td><td>2016-11-26 09:21:50</td>
                          </tr>
                          <tr>
                            <td>IP地址</td><td>59.110.168.230</td>
                          </tr>
                          <tr>
                            <td width="150">登录名</td><td>admin</td>
                          </tr>
                          <tr>
                            <td>我的邮箱</td><td>83715079@qq..com</td>
                          </tr>
                          <tr>
                            <td>登录时间</td><td>2016-11-27 09:21:50</td>
                          </tr>
                          <tr>
                            <td>累计登录</td><td>123</td>
                          </tr>
                          <tr>
                            <td>上次登录时间</td><td>2016-11-26 09:21:50</td>
                          </tr>
                          <tr>
                            <td>IP地址</td><td>59.110.168.230</td>
                          </tr>
                      </table>
                    </div>
                </div>
            </div>
      </div>
      <div class="layui-tab-item">
          <fieldset class="layui-elem-field layui-field-title" >
              <legend>我的信息</legend>
            </fieldset> 
         <div class="layui-tab">
            <ul class="layui-tab-title" >
                <li class="layui-this">我的信息</li>
                <li>我的相册</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    阿什顿发送到
                </div>
              <div class="layui-tab-item">
                  <?php foreach($album_list as $key=>$_v):?>
                  <div  class="cus-xiangce cus-images-box">
                      <image src="<?php echo $_v['save_url'];?>"  width='150' height='150' class="cus-images-img" data-imagesrc="<?php echo $_v['save_url'];?>" data-start="<?php echo $key;?>" data-pid="<?php echo $_v['id'];?>" />
                        <div class="cus-images-tool">
                            <span ><i class="layui-icon" >&#xe615;</i></span>
                            <span ><i class="layui-icon" >&#xe640;</i></span>
                            <span ><i class="layui-icon" >&#xe601;</i></span>
                            &nbsp;
                        </div>
                  </div>
                  <?php endforeach;?>
                  
                  <div class="layui-upload-drag" id="test10" style="border:1px solid #ccc;float:left;margin-left:5px;width: 90px;height: 89px;margin-top:5px;">
                    <i class="layui-icon"></i>
                    <p>点击上传，或将文件拖拽到此处</p>
                  </div>
              </div>
            </div>
        </div>
      </div>
      <div class="layui-tab-item">
          <fieldset class="layui-elem-field layui-field-title" >
              <legend>个人设置</legend>
          </fieldset>
          <div style="width:800px;min-height:300px;margin:0 auto;">
              <div style="width:100%;height:30px;line-height:30px;background:#F5F5F5;">
                    <div style="float:left;font-weight:bold;color:#01AAED;width:200px;">&nbsp;你已经完成配置信息的45% </div>
                    <div class="layui-progress" style="width:590px;float:left;margin-top:13px;">
                        <div class="layui-progress-bar layui-bg-orange" lay-percent="30%" style="width: 30%;"></div>
                    </div>
              </div>
              
              <hr class="layui-bg-blue" style="margin-top:30px;">
              <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                    <ul class="layui-tab-title">
                        <li class="layui-this">我的信息</li>
                        <li>修改密码</li>
                    </ul>
                    <div class="layui-tab-content" style="min-height: 100px;border:1px solid #ccc;">
                        <div class="layui-tab-item layui-show">
                            <font style="color:#01AAED;font-size:20px;font-weight:bold;">基本信息</font>
                            <hr class="layui-bg-blue" >
                            <form class="layui-form" action="">
                                <div class="layui-form-item">
                                  <label class="layui-form-label font-color-green">登录名</label>
                                  <div class="layui-input-block">
                                      <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input" value="<?= $info['username'];?>" readonly="readonly" />
                                  </div>
                                </div>

                                <div class="layui-form-item">
                                  <div class="layui-inline">
                                    <label class="layui-form-label font-color-green">联系方式</label>
                                    <div class="layui-input-inline">
                                        <input type="tel" name="phone" lay-verify="required|phone" autocomplete="off" class="layui-input" value="<?= $info['user_telephone'];?>">
                                    </div>
                                  </div>

                                  <div class="layui-inline">
                                    <label class="layui-form-label font-color-green">邮箱地址</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="email" lay-verify="email" autocomplete="off" class="layui-input" value="<?= $info['email'];?>">
                                    </div>
                                  </div>
                                </div>

                                <div class="layui-form-item">
                                  <div class="layui-inline">
                                    <label class="layui-form-label font-color-green">QQ</label>
                                    <div class="layui-input-inline">
                                        <input type="tel" name="qq"  autocomplete="off" class="layui-input" value="<?= $info['user_qq'];?>">
                                    </div>
                                  </div>

                                  <div class="layui-inline">
                                    <label class="layui-form-label font-color-green">微信</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="wechat"  autocomplete="off" class="layui-input" value="<?= $info['user_wechat'];?>">
                                    </div>
                                  </div>
                                </div>

                                <div class="layui-form-item">
                                  <div class="layui-inline">
                                    <label class="layui-form-label font-color-green">出生日期</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="date" id="date" lay-verify="date" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input" value="<?= $info['birth_date'];?>">
                                    </div>
                                  </div>
                                </div>

                                  <div class="layui-form-item">
                                    <label class="layui-form-label font-color-green">性别</label>
                                    <div class="layui-input-block">
                                      <input type="radio" name="sex" value="1" title="男" <?php if($info['sex'] == 1):?>checked=""<?php endif;?>>
                                      <input type="radio" name="sex" value="2" title="女" <?php if($info['sex'] == 2):?>checked=""<?php endif;?>>
                                    </div>
                                  </div>
                                  <div class="layui-form-item layui-form-text">
                                        <label class="layui-form-label font-color-green">个人宣言</label>
                                        <div class="layui-input-block">
                                            <textarea placeholder="请输入内容" class="layui-textarea" name="declaration"><?= $info['declaration']?></textarea>
                                        </div>
                                  </div>
                                <div class="layui-form-item">
                                  <div class="layui-input-block">
                                    <button class="layui-btn layui-btn-normal" lay-submit="" lay-filter="submit-my-info">立即提交</button>
                                    <button type="reset" class="layui-btn layui-btn-primary" id="test">重置</button>
                                  </div>
                                </div>
                              </form>
                            <font style="color:#01AAED;font-size:20px;font-weight:bold;">附加信息</font>
                            <hr class="layui-bg-blue" >
                        </div>
                        <div class="layui-tab-item">
                            <form class="layui-form cus-change-pwd-form" action="">
                                <div class="layui-form-item">
                                    <label class="layui-form-label font-color-green" >旧密码</label>
                                  <div class="layui-input-block">
                                      <input type="password" name="old_password" lay-verify="required" autocomplete="off" placeholder="请填写原始密码" class="layui-input" value="" />
                                  </div>
                                </div>
                                <div class="layui-form-item">
                                  <label class="layui-form-label font-color-green">新密码</label>
                                  <div class="layui-input-block" >
                                      <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="请填写新密码" class="layui-input" value="" />
                                  </div>
                                </div>
                                <div class="layui-form-item">
                                  <label class="layui-form-label font-color-green">确认密码</label>
                                  <div class="layui-input-block">
                                      <input type="password" name="password2" lay-verify="required" autocomplete="off" placeholder="请填写确认密码" class="layui-input" value="" />
                                  </div>
                                </div>
                                
                                <div class="layui-form-item">
                                  <div class="layui-input-block">
                                    <button class="layui-btn layui-btn-normal" lay-submit="" lay-filter="submit-my-password">立即提交</button>
                                  </div>
                                </div>
                              </form>
                        </div>
                    </div>
              </div>
      </div>
    </div>
</div>



<script>
    $(function(){
        $('#test').trigger('click');
    });
    
    layui.use(['upload','laydate'], function(){
        var upload = layui.upload,laydate = layui.laydate;
        //日期
        laydate.render({
          elem: '#date'
        });
        upload.render({
            elem: '#test10'
            ,url: '/admin/upload-images'
            ,done: function(res){
              console.log(res)
            }
        });
    });

    //监听提交
    layui.form.on('submit(submit-my-info)', function(data){
        var loadIndex2 = layer.load(1, {shade: [0.3, '#333']});
        $.ajax({
            url:'/admin/change-admin-info',
            type:'post',
            data:data.field,
            dataType:'json',
            success:function(res){
                layer.close(loadIndex2);
                if(res.code == 200){
                    layer.msg('信息修改成功', {icon: 6});
                }else{
                    layer.msg('信息修改失败', {icon: 5});
                }
            }
        });
        return false;
    });
    
    //监听提交
    layui.form.on('submit(submit-my-password)', function(data){
        var loadIndex2 = layer.load(1, {shade: [0.3, '#333']});
        if(data.field.password != data.field.password2 ){
            layer.close(loadIndex2);
            layer.msg('确认密码输入错误', {icon: 5});
            return false;
        }
        $.ajax({
            url:'/admin/change-admin-pwd',
            type:'post',
            data:data.field,
            dataType:'json',
            success:function(res){
                layer.close(loadIndex2);
                if(res.code == 200){
                    $('.cus-change-pwd-form input').val('');
                    layer.msg('密码修改成功', {icon: 6});
                }else{
                    layer.msg(res.message, {icon: 5});
                }
            }
        });
      
        return false;
    });
    
    $('.cus-span').on('click',function(){
        var val = parseInt($(this).text()) - 1;
        var obj = $('#cus-layui-tab-content > .layui-tab-item');
        $.each($('.cus-span'),function(index, value){
            if(val == index){
                $(this).addClass('cus-span-select');
            }else{
                $(this).removeClass('cus-span-select');
            }
        });

        $.each(obj, function(index, value) {
            if(val == index){
                $(this).addClass('layui-show').addClass('cus-span-select');
            }else{
                $(this).removeClass('layui-show').removeClass('cus-span-select');
            }
        });
    });

    $('.cus-xiangce').hover(function(){
        $(this).find('.cus-images-tool').show();
    },function(){
       $(this).find('.cus-images-tool').hide();
    });
    
    $('.cus-images-img').on('click',function(){
        var data = [];
        $('.cus-images-img').each(function(){
            var that = $(this);
            data.push({
                "alt": "图片名",
                "pid": that.data('pid'), //图片id
                "src": that.data('imagesrc'), //原图地址
                "thumb": "" //缩略图地址
            });
        });
        
        var start = $(this).data('start');
        var json = {
            photos: {
                "title": "我的相册", //相册标题
                "id": 123, //相册id
                "start": start, //初始显示的图片序号，默认0
                "data": data
              } //格式见API文档手册页
             ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机
        }
        layer.photos(json);
        //window.parent.myPhones(ddd);
    });
    
</script>