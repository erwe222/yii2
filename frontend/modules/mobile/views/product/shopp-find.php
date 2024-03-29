<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no, email=no"/>
	<meta charset="UTF-8">
	<title>优购优品网</title>
	<link rel="stylesheet" href="/assets/mobiles/mobile/css/core.css">
	<link rel="stylesheet" href="/assets/mobiles/mobile/css/icon.css">
	<link rel="stylesheet" href="/assets/mobiles/mobile/css/home.css">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link href="iTunesArtwork@2x.png" sizes="114x114" rel="apple-touch-icon-precomposed">
	<style>
		.n-tabs {
			position: fixed;
			top:44px;
			left: 0;
			width: 100%;
			height: 41px;
			overflow: hidden;
			z-index: 1000;
			background-color: #fff;
			box-shadow: 0 0 4PX 0PX rgba(155,143,143,0.6);
			-webkit-box-shadow: 0 0 4PX 0PX rgba(155,143,143,0.6);
			-moz-box-shadow: 0 0 4PX 0PX rgba(155,143,143,0.6);
		}
		.n-tabs .edge {
			position: fixed;
			top: 0;
			height: 41px;
			width: 100%;
			border-bottom: 1px solid #e5e5e5;
		}
		.n-tabs .n-tabContainer {
			-webkit-overflow-scrolling: touch;
			position: relative;
			top: 0;
			left: 0;
			overflow-x: auto;
			overflow-y: hidden;
			padding-left: 16px;
			height: 51px;
			font-size: 14px;
			color: #333;
			white-space: nowrap;
		}
		.n-tabs .n-tabContainer .navtab {
			display: -webkit-box;
			display: -webkit-flex;
			display: flex;
		}

		.n-tabs .n-tabContainer .n-tabItem {
			-webkit-box-flex: 1;
			-webkit-flex-grow: 1;
			flex-grow: 1;
			-webkit-flex-shrink: 0;
			flex-shrink: 0;
			display: inline-block;
			height: 41px;
			line-height: 41px;
			text-align: center;
			margin-left: 20px;
		}
		.n-tabs .n-tabContainer .n-tabItem:first-child {
			margin-left: 0;
		}
		.n-tabs .n-tabContainer .n-tabItem .current {
			display: inline-block;
			height: 41px;
			border-bottom: 2px solid #e31436;
			color: #e31436;
		}
	</style>
</head>
<body>

	<header class="aui-header-default aui-header-fixed ">
		<a href="#" class="aui-header-item">
			<i class="aui-icon aui-icon-back"></i>
		</a>
		<div class="aui-header-center aui-header-center-clear">
			<div class="aui-header-center-logo">
				<div><img src="/assets/mobiles/mobile/img/user/icon-dis.png" alt=""></div>
			</div>
		</div>
		<a href="#" class="aui-header-item-icon">
			<i class="aui-icon aui-icon-packet"></i>
			<i class="aui-icon aui-icon-member"></i>
		</a>
	</header>
	<section class="n-tabs">
		<ul class="n-tabContainer" id="auto-id-1509603311057">
			<li class="n-tabItem" data-id="homepage">
				<a href="#" id="homepage" class="current">精选</a>
			</li>
			<li class="n-tabItem" data-id="44114">
				<a href="#" id="44114" class="">直播</a>
			</li>
			<li class="n-tabItem" data-id="15394">
				<a href="#" id="15394" class="">视频购</a>
			</li>
			<li class="n-tabItem" data-id="01436">
				<a href="#" id="01436" class="">社区</a>
			</li>
			<li class="n-tabItem" data-id="18211">
				<a href="#" id="18211" class="">家居生活</a>
			</li>
			<li class="n-tabItem" data-id="83651">
				<a href="#" id="83651" class="">生鲜</a>
			</li>
			<li class="n-tabItem" data-id="37957">
				<a href="#" id="37957" class="">数码</a>
			</li>
			<li class="n-tabItem" data-id="74029">
				<a href="#" id="74029" class="">个人洗护</a>
			</li>
			<li class="n-tabItem" data-id="73179">
				<a href="#" id="73179" class="">海外直邮</a>
			</li>
			<li class="n-tabItem" data-id="41804">
				<a href="#" id="41804" class="">服饰鞋靴</a>
			</li>
		</ul>
	</section>

	<div class="aui-content-box" style="padding-top:41px;">
		<div class="aui-banner-content aui-fixed-top" data-aui-slider>
			<div class="aui-banner-wrapper">
				<div class="aui-banner-wrapper-item">
					<a href="#">
						<img src="/assets/mobiles/mobile/img/banner/find-2.jpg">
					</a>
				</div>
				<div class="aui-banner-wrapper-item">
					<a href="#">
						<img src="/assets/mobiles/mobile/img/banner/find-1.jpg">
					</a>
				</div>
				<div class="aui-banner-wrapper-item">
					<a href="#">
						<img src="/assets/mobiles/mobile/img/banner/find-3.jpg">
					</a>
				</div>
			</div>
			<div class="aui-banner-pagination"></div>
		</div>
		<!-- 卡片模块 三列 begin -->
		<section class="aui-card-content">
			<div class="aui-card-box">
				<div class="aui-card-box-user">
					<img src="/assets/mobiles/mobile/img/user/user0.png" alt="">
				</div>
				<div class="aui-card-box-name">
					<h2 class="aui-card-box-name">时尚优购店铺</h2>
					<span class="aui-card-box-btn">关注</span>
				</div>
				<div class="aui-card-box-time">9月10日发布</div>
			</div>
			<div class="aui-card-media-inner">
				<div class="aui-card-media-inner-title">双11你的购物车我全包了</div>
				<div class="aui-card-media-inner-padded">
					<div class="aui-card-media-inner-col-xs-3">
						<img src="/assets/mobiles/mobile/img/pd/sf-7.jpg" alt="">
					</div>
					<div class="aui-card-media-inner-col-xs-3">
						<img src="/assets/mobiles/mobile/img/pd/sf-5.jpg" alt="">
					</div>
					<div class="aui-card-media-inner-col-xs-3">
						<img src="/assets/mobiles/mobile/img/pd/sf-6.jpg" alt="">
					</div>
				</div>
			</div>
		</section>
		<!-- 卡片模块 三列 end -->
		<div class="aui-dri"></div>
		<!-- 卡片模块 三列 begin -->
		<section class="aui-card-content">
			<div class="aui-card-box">
				<div class="aui-card-box-user">
					<img src="/assets/mobiles/mobile/img/user/user9.png" alt="">
				</div>
				<div class="aui-card-box-name">
					<h2 class="aui-card-box-name">艾畅的家族</h2>
					<span class="aui-card-box-btn">关注</span>
				</div>
				<div class="aui-card-box-time">9月10日发布</div>
			</div>
			<div class="aui-card-media-inner">
				<div class="aui-card-media-inner-title">双11你的购物车我全包了</div>
				<div class="aui-card-media-inner-padded">
					<div class="aui-card-media-inner-col-xs-3">
						<img src="/assets/mobiles/mobile/img/pd/pd-zf-6.jpg" alt="">
					</div>
					<div class="aui-card-media-inner-col-xs-3">
						<img src="/assets/mobiles/mobile/img/pd/pd-zf-7.jpg" alt="">
					</div>
					<div class="aui-card-media-inner-col-xs-3">
						<img src="/assets/mobiles/mobile/img/pd/pd-zf-8.jpg" alt="">
					</div>
				</div>
			</div>
		</section>
		<!-- 卡片模块 三列 end -->
		<div class="aui-dri"></div>
		<!-- 卡片模块 begin -->
		<section class="aui-card-content">
			<div class="aui-card-box">
				<div class="aui-card-box-user">
					<img src="/assets/mobiles/mobile/img/user/user2.png" alt="">
				</div>
				<div class="aui-card-box-name">
					<h2 class="aui-card-box-name">轻量科技</h2>
					<span class="aui-card-box-btn">关注</span>
				</div>
				<div class="aui-card-box-time">11月10日前</div>
			</div>
			<div class="aui-card-media">
				<div class="aui-card-media-item">
					<img src="/assets/mobiles/mobile/img/pd/sf-18.jpg" />
				</div>
				<div class="aui-card-media-inner">
					<div class="aui-card-media-text">
						<p>时尚女神节 抢5折优惠券转身变女神 你想要的这里都有</p>
					</div>
					<div class="aui-card-media-describe">
						<span>1.1万人浏览 2390件宝贝</span>
					</div>
				</div>
			</div>
			<div class="aui-card-media">
				<div class="aui-card-media-item">
					<img src="/assets/mobiles/mobile/img/pd/sf-9.jpg" />
				</div>
				<div class="aui-card-media-inner">
					<div class="aui-card-media-text">
						<p>时尚女神节 抢5折优惠券转身变女神 你想要的这里都有</p>
					</div>
					<div class="aui-card-media-describe">
						<span>1.1万人浏览 2390件宝贝</span>
					</div>
				</div>
			</div>
			<div class="aui-card-media">
				<div class="aui-card-media-item">
					<img src="/assets/mobiles/mobile/img/pd/sf-22.jpg" />
				</div>
				<div class="aui-card-media-inner">
					<div class="aui-card-media-text">
						<p>每日坚果750g零食果干无添加混合坚果孕妇食品小</p>
					</div>
					<div class="aui-card-media-describe">
						<span>1.1万人浏览 2390件宝贝</span>
					</div>
				</div>
			</div>

		</section>
		<!-- 卡片模块 end -->
		<div class="aui-dri"></div>
		<!-- 卡片模块 begin -->
		<section class="aui-card-content">
			<div class="aui-card-box">
				<div class="aui-card-box-user">
					<img src="/assets/mobiles/mobile/img/user/user4.png" alt="">
				</div>
				<div class="aui-card-box-name">
					<h2 class="aui-card-box-name">艾佳生活</h2>
					<span class="aui-card-box-btn">关注</span>
				</div>
				<div class="aui-card-box-time">10月10日发布</div>
			</div>
			<div class="aui-card-media">
				<div class="aui-card-media-item">
					<img src="/assets/mobiles/mobile/img/pd/sf-10.jpg" />
				</div>
				<div class="aui-card-media-inner">
					<div class="aui-card-media-text">
						席梦思（Simmons） 原装进口独立袋弹簧 软硬适中 艾乔安娜承托 灰蓝白 1500*2000*280灰蓝白 1500*2000*280
					</div>
					<div class="aui-card-media-describe">
						<span>1.1万人浏览 2390件宝贝</span>
					</div>
				</div>
			</div>

		</section>
		<!-- 卡片模块 end -->
		<div class="aui-dri"></div>
		<!-- 卡片模块 begin -->
		<section class="aui-card-content">
			<div class="aui-card-box">
				<div class="aui-card-box-user">
					<img src="/assets/mobiles/mobile/img/user/user3.png" alt="">
				</div>
				<div class="aui-card-box-name">
					<h2 class="aui-card-box-name">小虾米</h2>
					<span class="aui-card-box-btn">关注</span>
				</div>
				<div class="aui-card-box-time">10月10日发布</div>
			</div>
			<div class="aui-card-media">
				<div class="aui-card-media-item">
					<img src="/assets/mobiles/mobile/img/pd/sf-19.jpg" />
				</div>
				<div class="aui-card-media-inner">
					<div class="aui-card-media-text">
						席梦思（Simmons） 原装进口独立袋弹簧 软硬适中 艾乔安娜承托 灰蓝白 1500*2000*280灰蓝白 1500*2000*280
					</div>
					<div class="aui-card-media-describe">
						<span>1.1万人浏览 2390件宝贝</span>
					</div>
				</div>
			</div>
			<div class="aui-card-media">
				<div class="aui-card-media-item">
					<img src="/assets/mobiles/mobile/img/pd/sf-11.jpg" />
				</div>
				<div class="aui-card-media-inner">
					<div class="aui-card-media-text">
						ML权力的游戏史塔克家族徽章印花短袖T恤1700140 黑色AK权力的游戏史塔克家族徽章印花短袖T恤1700140 黑色 L
					</div>
					<div class="aui-card-media-describe">
						<span>1.1万人浏览 2390件宝贝</span>
					</div>
				</div>
			</div>

		</section>
		<!-- 卡片模块 end -->
		<div class="aui-dri"></div>
		<!-- 卡片模块 begin -->
		<section class="aui-card-content">
			<div class="aui-card-box">
				<div class="aui-card-box-user">
					<img src="/assets/mobiles/mobile/img/user/user2.png" alt="">
				</div>
				<div class="aui-card-box-name">
					<h2 class="aui-card-box-name">每天都坚果一下</h2>
					<span class="aui-card-box-btn">关注</span>
				</div>
				<div class="aui-card-box-time">10月10日发布</div>
			</div>
			<div class="aui-card-media">
				<div class="aui-card-media-item">
					<img src="/assets/mobiles/mobile/img/pd/sf-8.jpg" />
				</div>
				<div class="aui-card-media-inner">
					<div class="aui-card-media-text">
						沃隆 每日坚果750g零食果干无添加混合坚果孕妇食品小包装礼盒 成人A款=25g*30袋
					</div>
					<div class="aui-card-media-describe">
						<span>1.1万人浏览 2390件宝贝</span>
					</div>
				</div>
			</div>

		</section>
		<!-- 卡片模块 end -->

		<div class="aui-dri" style="margin-bottom:20px;"></div>
		<div class="aui-list-content">
			<div class="aui-list-item">
				<div class="aui-list-item-img">
					<img src="/assets/mobiles/mobile/img/pd/cf-6.jpg" alt="">
				</div>
				<div class="aui-slide-box">
					<div class="aui-slide-list">
						<ul class="aui-slide-item-list">
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-20.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">nissen 凹凸纵横弹性沙发套</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥31149</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥11499</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-21.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">日本NITORI尼达利 三折坐垫 长毛条纹 浅棕 </p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥1199</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥1198</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-22.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 对伴沙发</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥2399</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥9999</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-23.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 韵白系列沙发三人位</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥9189</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥21299</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-24.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 韵白系列沙发单人位</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥2349</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥4199</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-24.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 韵白系列沙发单人位</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥2349</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥4199</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-24.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 韵白系列沙发单人位</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥2349</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥4199</span>
									</p>
								</a>
							</li>
						</ul>
					</div>

				</div>
				<div class="aui-slide-box">
					<div class="aui-slide-list">
						<ul class="aui-slide-item-list">
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-19.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">nissen 凹凸纵横弹性沙发套</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥31149</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥11499</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-18.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">日本NITORI尼达利 三折坐垫 长毛条纹 浅棕 </p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥1199</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥1198</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-17.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 对伴沙发</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥2399</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥9999</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-16.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 韵白系列沙发三人位</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥9189</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥21299</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-15.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 韵白系列沙发单人位</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥2349</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥4199</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-15.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 韵白系列沙发单人位</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥2349</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥4199</span>
									</p>
								</a>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</div>
		<div class="aui-recommend">
			<img src="/assets/mobiles/mobile/img/bg/icon-tj2.jpg" alt="">
			<!--<h2>为你推荐</h2>-->
		</div>
		<section class="aui-list-product">
			<div class="aui-list-product-box">
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-15.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-14.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-13.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-12.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-11.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-10.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-9.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-8.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-16.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-17.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-18.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-19.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-20.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-21.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-22.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
				<a href="javascript:;" class="aui-list-product-item">
					<div class="aui-list-product-item-img">
						<img src="/assets/mobiles/mobile/img/pd/sf-23.jpg" alt="">
					</div>
					<div class="aui-list-product-item-text">
						<h3>KOBE LETTUCE 秋冬新款 女士日系甜美纯色半高领宽松套头毛衣针织衫</h3>
						<div class="aui-list-product-mes-box">
							<div>
							<span class="aui-list-product-item-price">
								<em>¥</em>
								399.99
							</span>
								<span class="aui-list-product-item-del-price">
								¥495.65
							</span>
							</div>
							<div class="aui-comment">986评论</div>
						</div>
					</div>
				</a>
			</div>
		</section>
	</div>

	<?= $this->render('../layouts/footer.php') ?>
	<script type="text/javascript" src="/assets/mobiles/mobile/js/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/mobiles/mobile/js/aui.js"></script>
</body>
</html>