<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="apple-themes-web-app-capable" content="yes">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta content="email=no" name="format-detection">
    <meta name="format-detection" content="telephone=no">
    <title>个人中心</title>
    <link rel="stylesheet" href="/assets/mobiles/mobile/dabian/css/main.css" type="text/css" media="all">
    <link rel="stylesheet" href="/assets/mobiles/mobile/dabian/css/modify-main.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/assets/mobiles/mobile/mui/css/mui.css">
    <link rel="stylesheet" href="/assets/mobiles/mobile/dabian/css/public.css" />
    <link rel="stylesheet" href="/assets/mobiles/mobile/css/paypwdbox.css" />
    <link rel="stylesheet" href="/assets/mobiles/mobile/css/core.css">
    <link rel="stylesheet" href="/assets/mobiles/mobile/css/home.css">
    <style type="text/css">
		.cus-popup-box{width: 98%;height: 130px;position: fixed;bottom: 0px;z-index: 998;margin-left: 1%;text-align: center;display: none;}
		.cus-popup-shang{padding-top: 10px;width: 100%;height: 80px;border-radius:5px;background:#ccc;}
		.cus-popup-shang p{font-size: 18px;font-weight: bold;color: #fff;}
		.cus-popup-center{background:#ccc;width: 100%;	height: 40px;border-radius:5px;padding-top:10px;margin-top: 5px;}
		.hr{width: 90%;background:#fff;height: 2px;}
		.file{position: absolute;opacity: 0;width: 100%;left: 0;}
		.cp_list ul li{padding-left:0px;}
    </style>
</head>
    <body >
        <header id="header">
            <div class="header_con">
            <a href="javascript:history.go(-1);"><span></span>
				</a>
                <div class="top_tit">个人中心</div>
                <div class="right_div"><a href=""></a></div>
            </div>
        </header>
        
        <!--页面加载 开始-->
        <div id="preloader">
                <div id="status">
                        <p class="center-text"><span>拼命加载中···</span></p>
                </div>
        </div>
        
        <!--页面加载 结束-->
        <div id="content_div_b" class="p_bottom">
            <div class="cp_list">
                <ul class="photo-center" id="photo-center">
					<li>
						<img src="/assets/mobiles/mobile/dabian/images/center-photo.png" onclick="upload()">
					</li>
					<a href="#" onclick="upload()"><i>头像</i></a>
				</ul>
				<ul>
					<li>手机号
						<a><span><?php echo $user_info['username']?></span></a>
					</li>
					<i></i>
				</ul>
				<ul>
					<li> 微信号
						<a href="#" id="edit-wechat"><span>未绑定</span></a>
					</li>
					<a href="#"><i></i></a>
				</ul>
				<ul class="borefeff4" >
					<li >性别 <span id="edit-sex"><?php echo ($user_info['sex'] == 1)?'男':'女';?></span></li>
					<i></i>
				</ul>
				<ul>
					<li>地区 <span id='J_Address'>安徽省 六安市</span></li>
					<i></i>
				</ul>

				<ul>
					<li>震动 <span class="shock"></span></li>
				</ul>
				<ul>
					<li>闹铃 <span class="clock"></span></li>
				</ul>

				<ul class="borefeff4" onclick="setPayPwd()">
					<li> 设置交易密码 <span >未设置</span></li>
					<a><i></i></a>
				</ul>
            </div>
        </div>

		<div class="cus-popup-box">
			<div class="cus-popup-shang">
				<p style="height: 30px;">
					<span>相册</span>
					<input type="file" name="" class="file" />
				</p>
				<hr style="hr" />
				<p style="margin-top: 5px;">
					<span>相机</span>
					<input type="file" name="" class="file" accept="image/*" capture="camera" />
				</p>
			</div>

			<div class="cus-popup-center" onclick="cancelUpload()">取 消</div>
		</div>

		<div id="cus-edit-wechat" style="display: none;">
			
		</div>
	<script src="/assets/mobiles/mobile/mui/js/mui.min.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/dabian/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/dabian/js/common.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/PayPwdBox.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/aui.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/city.js"></script>
    <script type="text/javascript" src="/assets/lib/layer/2.4/layer.js"></script>
	<script>
			var wechatBox = '';
			var sexBox    = '';

			$('#edit-wechat').on('click',function(){
				wechatBox = layer.open({
				  type: 1,
				  skin: 'layui-layer-rim', //加上边框
				  area: ['90%', '180px'], //宽高
				  title:'绑定微信号',
				  content: '<div style="padding:10px; "><p><input type="text" name="" value="" style="width: 100%;" placeholder="输入微信号" id="cus-Wechat-val" /></p><button type="button" class="mui-btn mui-btn-primary mui-btn-outlined" style="width: 100%;" onclick="submitWechat()">蓝色</button></div>'
				});
			});

			function submitWechat(){
				alert($('#cus-Wechat-val').val());

				layer.close(wechatBox);
			}

			$('#edit-sex').on('click',function(){
				sexBox = layer.open({
				  type: 1,
				  skin: 'layui-layer-rim', //加上边框
				  area: ['90%', '130px'], //宽高
				  title:'修改性别',
				  content: '<div style="padding:10px; "><p><span style="font-size:18px;line-height:35px;padding-right:20px;">性别:</span><button type="button" class="mui-btn mui-btn-success ">♂男</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="mui-btn mui-btn-primary mui-btn-outlined">♂女</button></p></div>'
				});
			});

			function submitSex(){

			}


			!function () {
	            var $target = $('#J_Address');

	            $target.citySelect();

	            $target.on('click', function (event) {
	                event.stopPropagation();
	                $target.citySelect('open');
	            });

	            $target.on('done.ydui.cityselect', function (ret) {
	                $(this).html(ret.provance + ' ' + ret.city + ' ' + ret.area);
	            });
	        }();

            var payBox = new PayPwdBox({title:'设置交易密码'},function(pwd){
                console.log(pwd);
                alert(pwd);
            });

            $(document).ready(function() {
            	
                $(".shock").click(function() {
                        $(this).toggleClass("shock-off");
                });
            });

            $(document).ready(function() {
                    $(".clock").click(function() {
                            $(this).toggleClass("clock-on");
                    });
            });

            function upload(){
                    $('.cus-popup-box').fadeIn();
            }

            function cancelUpload(){
                    $('.cus-popup-box').fadeOut(500);
            }

            function setPayPwd(){
                payBox.show();
            }
	</script>
    </body>
</html>