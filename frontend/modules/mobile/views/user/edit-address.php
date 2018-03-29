<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no, email=no"/>
    <meta charset="UTF-8">
    <title>新建地址</title>
    <link rel="stylesheet" href="/assets/mobiles/mobile/css/core.css">
    <link rel="stylesheet" href="/assets/mobiles/mobile/css/icon.css">
    <link rel="stylesheet" href="/assets/mobiles/mobile/css/home.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="iTunesArtwork@2x.png" sizes="114x114" rel="apple-touch-icon-precomposed">
    <style>
        .m-cell {
            background-color: #FFF;
            position: relative;
            z-index: 1;
            margin-bottom: .35rem;
            height: 3rem;
            line-height: 3rem;
        }
        
        /* 有些资料显示需要写，有些显示不需要，但是在编辑器webstorm中该属性不被识别 */
        ::-webkit-input-placeholder {color: #888;}
        :-moz-placeholder {color: #888;}
        ::-moz-placeholder {color: #888;}
        :-ms-input-placeholder {color: #888;}
    </style>
</head>
<body style="background:#eee">
    <header class="aui-header-default aui-header-fixed ">
        <a href="javascript:history.back(-1)" class="aui-header-item"><i class="aui-icon aui-icon-back"></i></a>
        <div class="aui-header-center aui-header-center-clear">
            <div class="aui-header-center-logo"><div class=""><?php if($is_edit):?>编辑地址<?php else:?>新建地址<?php endif;?></div></div>
        </div>
        <a href="#" class="aui-header-item-icon"   style="min-width:0"><i class="aui-icon"></i></a>
    </header>


    <section class="aui-myOrder-content">
        <div class="aui-prompt"><i class="aui-icon aui-prompt-sm"></i>填写您的地址信息</div>
        <div class="aui-Address-box">
            <p>
                <input class="aui-Address-box-input" type="text" placeholder="收货人姓名" id="cus-consignee" value="<?php if($is_edit):?><?= $addr_info['consignee']?><?php endif;?>" />
            </p>
            <p>
                <input class="aui-Address-box-input" type="text" placeholder="手机号码" id="cus-mobile" value="<?php if($is_edit):?><?= $addr_info['mobile']?><?php endif;?>" />
            </p>
            <p>
                <input class="aui-Address-box-input" type="text" readonly id="J_Address"  placeholder="所在地区" value="<?php if($is_edit):?><?= $addr_info['city']?><?php endif;?>" />
            </p>
            <p>
            	<?php if($is_edit):?>
					<textarea class="aui-Address-box-text" placeholder="街道， 小区门牌等详细地址" rows="3" id="cus-address" ><?= $addr_info['address']?></textarea>
            		<?php else:?>
					<textarea class="aui-Address-box-text" placeholder="街道， 小区门牌等详细地址" rows="3" id="cus-address" ></textarea>
            	<?php endif;?>
            </p>
        </div>
		<style type="text/css">
			.checkimg{
				width: 43px;height: 18px;float: left;margin-left:-21px;
			}
			.nocheckimg{
				width: 43px;height: 18px;float: left;margin-left:4px;
			}

		</style>

        <div style="margin-left: 10px;padding-bottom: 20px;height: 18px;">
		  <div  style="width: 21.5px;height: 18px;overflow:hidden;float: left;">
				<img src="/assets/mobiles/mobile/dabian/img/check_one.png"  
				class="
					<?php if($is_edit):?>
						<?php if($addr_info['is_default'] == 'y'):?>checkimg<?php else:?>nocheckimg<?php endif;?>
					<?php else:?>
						nocheckimg
					<?php endif;?>
				 	imgcalss" 
					onclick="clickDefault()" 
			    />
		  </div>
          <div style="height: 18px;float: left;margin-left: 0px;padding-top:2px;" onclick="clickDefault()">&nbsp;&nbsp;默认地址</div>
        </div>

        <div class="aui-out">
            <a class="red-color" style="color:#fff" id="cus-btn">保存并使用</a>
        </div>
    </section>

    <script type="text/javascript" src="/assets/mobiles/mobile/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/aui.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/city.js"></script>
    <script type="text/javascript" src="/assets/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/functions.js"></script>
    <script type="text/javascript">
        function clickDefault(){
            if($('.imgcalss').hasClass('checkimg')){
                $('.imgcalss').removeClass('checkimg').addClass('nocheckimg');
            }else{
                $('.imgcalss').removeClass('nocheckimg').addClass('checkimg');
            }
        }

        $('#cus-mobile').on('keyup',function(){
            $(this).val(mobileFormater($(this).val()));
        });
        
        var isSubmit = false;
        $('#cus-btn').on('click',function(){
            var id              = '<?php if($is_edit):?><?= $addr_info['id']?><?php else:?>0<?php endif;?>';
            var consignee 	= $.trim($('#cus-consignee').val());
            var mobile 		= mobileFormater2($.trim($('#cus-mobile').val()));
            var city 		= $.trim($('#J_Address').val());
            var address 	= $.trim($('#cus-address').val());
            var is_default  = 'n';
            if(consignee == ''){layer.msg('收货人姓名不能为空...');return false;}
            if(mobile == ''){layer.msg('联系方式不能为空...');return false;}
            if(!checkMobile(mobileFormater2(mobile))){layer.msg('请填写正确的联系方式...');return false;}
            if(city == ''){layer.msg('城市地址不能为空...');return false;}
            if(address == ''){layer.msg('详细地址不能为空...');return false;}
            if($('.imgcalss').hasClass('checkimg')){
				is_default = 'y';
            }

            if(isSubmit){return false;}
            isSubmit = true;
            $.ajax({
               url:'address-save',
               type:'post',
               dataType:'json',
               data:{id:id,consignee:consignee,mobile:mobile,city:city,address:address,is_default:is_default},
               complete:function(XHR, TS){},
               success:function(res){
                   if(res.errCode == 200){
                   		layer.msg(res.errMsg);
                   		setTimeout(function(){
							window.location.href="/mobile/user/my-address"; 
                   		},1000);
                   }else{
                   	isSubmit = false;
                       layer.msg(res.errMsg);
                   }
               }
            });
        });

    </script>

    <script>
        /**
         * 默认调用
         */
        !function () {
            var $target = $('#J_Address');

            $target.citySelect();

            $target.on('click', function (event) {
                event.stopPropagation();
                $target.citySelect('open');
            });

            $target.on('done.ydui.cityselect', function (ret) {
                $(this).val(ret.provance + ' ' + ret.city + ' ' + ret.area);
            });
        }();
        /**
         * 设置默认值
         */
        !function () {
            var $target = $('#J_Address2');

            $target.citySelect({
                provance: '新疆',
                city: '乌鲁木齐市',
                area: '天山区'
            });


            $target.on('click', function (event) {
                event.stopPropagation();
                $target.citySelect('open');
            });

            $target.on('done.ydui.cityselect', function (ret) {
                $(this).val(ret.provance + ' ' + ret.city + ' ' + ret.area);
            });
        }();
    </script>

</body>
</html>