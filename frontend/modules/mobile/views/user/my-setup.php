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
	<title>设置</title>
	<link rel="stylesheet" href="/assets/mobiles/mobile/css/core.css">
	<link rel="stylesheet" href="/assets/mobiles/mobile/css/icon.css">
	<link rel="stylesheet" href="/assets/mobiles/mobile/css/home.css">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link href="iTunesArtwork@2x.png" sizes="114x114" rel="apple-touch-icon-precomposed">
        <style>
		.aui-Popup{
			width:260px;
			height: 120px;
			line-height:90px;
			border:1px solid #a7b0b8;
			background:#fff;
			z-index:100;
			position:fixed;
			top:20%;
			left:50%;
			margin-left:-130px;
			color:#7c7c7c;
			font-size:14px;
			text-align:center;
		}
	</style>
</head>
<body style="background:#f0f0f0">
    <header class="aui-header-default aui-header-fixed ">
		<a href="javascript:history.back(-1)" class="aui-header-item">
			<i class="aui-icon aui-icon-back"></i>
		</a>
		<div class="aui-header-center aui-header-center-clear">
			<div class="aui-header-center-logo">
				<div class="">设置</div>
			</div>
		</div>
		<a href="#" class="aui-header-item-icon"   style="min-width:0">
			<i class="aui-icon aui-icon-share-pd"></i>
		</a>
	</header>
    <section class="aui-myOrder-content">
        <div class="aui-product-set">
            <a href="<?= Url::toRoute('user/my-user')?>" class="aui-address-cell aui-fl-arrow aui-fl-arrow-clear" >
                    <div class="aui-address-cell-bd">个人信息</div>
                    <div class="aui-address-cell-ft"></div>
            </a>
            <a href="my-address.html" class="aui-address-cell aui-fl-arrow aui-fl-arrow-clear" data-ydui-actionsheet="{target:'#actionSheet',closeElement:'#cancel'}">
                    <div class="aui-address-cell-bd">我的实名认证</div>
                    <div class="aui-address-cell-ft"></div>
            </a>
            <a href="<?= Url::toRoute('user/my-address')?>" class="aui-address-cell aui-fl-arrow aui-fl-arrow-clear" >
                    <div class="aui-address-cell-bd">我的收货地址</div>
                    <div class="aui-address-cell-ft"></div>
            </a>
            <a href="<?= Url::toRoute('user/my-message')?>" class="aui-address-cell aui-fl-arrow aui-fl-arrow-clear" >
                    <div class="aui-address-cell-bd">消息通知</div>
                    <div class="aui-address-cell-ft"></div>
            </a>
            <div class="aui-dri"></div>
            <a href="#" class="aui-address-cell aui-fl-arrow aui-fl-arrow-clear" data-ydui-actionsheet="{target:'#actionSheet',closeElement:'#cancel'}">
                    <div class="aui-address-cell-bd">关于我们</div>
                    <div class="aui-address-cell-ft">v1.0</div>
            </a>
        </div>
        <div class="aui-out">
            <a href="<?= Url::toRoute('login/logout')?>">退出当前账号</a>
        </div>
    </section>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/aui.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/functions.js"></script>
    <script>
        
        


    </script>
</body>
</html>