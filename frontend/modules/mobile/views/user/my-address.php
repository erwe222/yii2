<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no, email=no"/>
    <meta charset="UTF-8">
    <title>收货地址</title>
    <link rel="stylesheet" href="/assets/mobiles/mobile/css/core.css">
    <link rel="stylesheet" href="/assets/mobiles/mobile/css/icon.css">
    <link rel="stylesheet" href="/assets/mobiles/mobile/css/home.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="iTunesArtwork@2x.png" sizes="114x114" rel="apple-touch-icon-precomposed">
</head>
<body style="background:#eee">
    <header class="aui-header-default aui-header-fixed ">
        <a href="javascript:history.back(-1)" class="aui-header-item"><i class="aui-icon aui-icon-back"></i></a>
        <div class="aui-header-center aui-header-center-clear">
            <div class="aui-header-center-logo"><div class="">收货地址</div></div>
        </div>
        <a href="#" class="aui-header-item-icon"   style="min-width:0"><i class="aui-icon"></i></a>
    </header>
    <section class="aui-myOrder-content">
        <?php if(count($addr_infos) > 0):?>
            <?php foreach($addr_infos as $k=>$v):?>
                <div class="aui-Address-box" data-addrid="<?= $v['id']?>">
                    <div class="aui-Address-box-item">
                        <div class="aui-Address-box-item-bd"><p><?= $v['consignee']?></p></div>
                        <div class="aui-Address-box-item-ft"><p><?= $v['mobile']?></p></div>
                    </div>
                    <div class="aui-Address-box-item">
                        <div class="aui-Address-box-item-bd"><p><?= $v['city'].' '.$v['address']?></p></div>
                    </div>
                    <div class="aui-Address-box-item">
                        <div class="aui-Address-box-item-bd">
                            <p><input type="checkbox" class="check goods-check goodsCheck" <?php if($v['is_default'] == 'y'):?>checked="checked"<?php endif;?>   name="check-id" style="background-size: 17px 17px;" value='<?= $v['id']?>' /> 
                            <em style="padding-left:24px;" >默认地址</em></p>
                        </div>
                        <div class="aui-Address-box-item-ft cus-remove-addr"><p>删除</p></div>&nbsp;&nbsp<span style="color:red">|</span>&nbsp;&nbsp; 
                        <div class="aui-Address-box-item-ft "><p><a href="<?= Url::toRoute(['user/edit-address', 'addrid' => $v['id']])?>">编辑</a></p></div>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>

        
        <div class="aui-out">
                <a href="<?= Url::toRoute('user/edit-address')?>">新建收货地址</a>
        </div>
    </section>

    <script type="text/javascript" src="/assets/mobiles/mobile/js/jquery.min.js"></script>
    <!--<script type="text/javascript" src="/assets/mobiles/mobile/js/aui.js"></script>-->
    <script type="text/javascript" src="/assets/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/functions.js"></script>
    <script type="text/javascript">
        $('.goodsCheck').on('click',function(){
            var obj=document.getElementsByName('check-id');
            var check_id = $(this).val();
            var default_id = 0;
            for(var i=0; i<obj.length; i++){
                if(obj[i].checked && obj[i].value != check_id){
                    default_id = obj[i].value;
                }
                obj[i].checked = (obj[i].value == check_id)?true:false;
            }
            $.ajax({
               url:'update-default-addr',
               type:'post',
               dataType:'json',
               data:{addrid:check_id},
               complete:function(XHR, TS){},
               success:function(res){
                   if(res.errCode != 200){
                       for(var i=0; i<obj.length; i++){
                            obj[i].checked = (obj[i].value == default_id)?true:false;
                       }
                   }
                   layer.msg(res.errMsg);
               }
            });
        });

        $('.cus-remove-addr').on('click',function(){
            var _this = $(this);
            //获取地址id号
            var addrId = $(this).parent().parent().data('addrid');
            layer.msg('你确定要删除吗？', {
              time: 0 //不自动关闭
              ,btn: ['确定', '取消']
              ,yes: function(index){
                    var log = layer.msg('删除中...', {time: 0,icon: 16,shade: 0.01});
                    $.ajax({
                        url:'del-addr',
                        type:'post',
                        dataType:'json',
                        data:{addrid:addrId},
                        complete:function(XHR, TS){},
                        success:function(res){
                            //处理成功后移除节点
                            layer.close(log);
                            if(res.errCode == 200){
                                _this.parent().parent().remove();
                            }
                            layer.msg(res.errMsg);
                        }
                     });
              }
            });
        });
    </script>
</body>
</html>