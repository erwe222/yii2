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
    <title>萌宝购物</title>
    <link rel="stylesheet" type="text/css" href="/assets/mobiles/mobile/css/core.css">
    <link rel="stylesheet" type="text/css" href="/assets/mobiles/mobile/css/icon.css">
    <link rel="stylesheet" type="text/css" href="/assets/mobiles/mobile/css/home.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="iTunesArtwork@2x.png" sizes="114x114" rel="apple-touch-icon-precomposed">
    <style type="text/css">
        #scrollBg{ width: 100%; height: 45px; line-height: 45px;background: rgba(251,55,67,0.8); display: none; z-index:-1; position: fixed; left: 0; top:0; text-align: center; font-size: 20px; color: #fff; }
    </style>
</head>
<body>

	<header class="aui-header-default aui-header-fixed aui-header-clear-bg"> <!-- aui-header-clear-bg 清除背景色 -->
		<a href="#" class="aui-header-item">
                    <i class="aui-icon aui-icon-code"></i>
		</a>
		<div class="aui-header-center aui-header-center-clear"  style="margin-right:50px;">
			<div class="aui-header-search-box" style="background-color:#fff">
				<i class="aui-icon aui-icon-small-search"></i>
				<input id="" type="text"  placeholder="手机狂欢节 抢 iPhone X" class="aui-header-search">
			</div>
		</div>
		<a href="#" class="aui-header-item-icon" style="position:absolute; right:-35px; top:0;">
			<i class="aui-icon aui-icon-member-1"></i>
		</a>
		<div id="scrollBg"></div>
	</header>
	<div class="aui-content-box">
		<div class="aui-banner-content " data-aui-slider>
			<div class="aui-banner-wrapper">
				<div class="aui-banner-wrapper-item">
					<a href="#">
						<img src="/assets/mobiles/mobile/img/banner/news-banner2.jpg">
					</a>
				</div>
				<div class="aui-banner-wrapper-item">
					<a href="#">
						<img src="/assets/mobiles/mobile/img/banner/news-banner1.jpg">
					</a>
				</div>
				<div class="aui-banner-wrapper-item">
					<a href="#">
						<img src="/assets/mobiles/mobile/img/banner/news-banner3.jpg">
					</a>
				</div>
				<div class="aui-banner-wrapper-item">
					<a href="#">
						<img src="/assets/mobiles/mobile/img/banner/news-banner1.jpg">
					</a>
				</div>
			</div>
			<div class="aui-banner-pagination"></div>
		</div>
		<section class="aui-grid-content">
			<div class="aui-grid-row aui-grid-row-clears"> <!-- aui-grid-row-clear 清除 a标签 上下的边距 -->
                                <a href="<?= Url::toRoute('user/my-sign')?>" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-sign"></i>
					<p class="aui-grid-row-label">每日签到</p>
				</a>
				<a href="<?= Url::toRoute('user/my-sign')?>" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-time"></i>
					<p class="aui-grid-row-label">限时抢购</p>
				</a>
				<a href="<?= Url::toRoute('user/my-sign')?>" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-vip"></i>
					<p class="aui-grid-row-label">会员专享</p>
				</a>
				<a href="<?= Url::toRoute('user/my-sign')?>" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-group"></i>
					<p class="aui-grid-row-label">好货拼团</p>
				</a>
				<a href="<?= Url::toRoute('user/my-sign')?>" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-share"></i>
					<p class="aui-grid-row-label">分享领券</p>
				</a>
				<a href="my-sign.html" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-recharges"></i>
					<p class="aui-grid-row-label">手机充值</p>
				</a>
				<a href="<?= Url::toRoute('user/my-sign')?>" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-finance"></i>
					<p class="aui-grid-row-label">金融理财</p>
				</a>
				<a href="<?= Url::toRoute('user/my-sign')?>" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-appliance"></i>
					<p class="aui-grid-row-label">电器商城</p>
				</a>
				<a href="<?= Url::toRoute('user/my-sign')?>" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-supermarket"></i>
					<p class="aui-grid-row-label">萌宝超市</p>
				</a>
				<a href="<?= Url::toRoute('user/main')?>" class="aui-grid-row-item">
					<i class="aui-icon-large aui-icon-personal"></i>
					<p class="aui-grid-row-label">个人中心</p>
				</a>
			</div>
		</section>
		<section class="aui-content-six aui-border-t " style="background-color: #fff;">
			<div class="aui-flex-col aui-flex-center aui-border-tb">
				<div class="aui-flex-item-4 aui-flex-row aui-flex-middle aui-padded-10 aui-border-b">
					<h3 class="aui-text-danger">电器城抢购</h3>
					<p>全场低至299</p>
					<img src="/assets/mobiles/mobile/img/ad/f1.jpg">
				</div>
				<div class="aui-flex-item-8 aui-border-l">
					<div class="aui-flex-col aui-padded-10 aui-border-b">
						<div class="aui-flex-item-12">
							<div class="aui-flex-item-9">
								<h3 class="aui-text-info">创维新品</h3>
								<p>好品质选创维新品上市</p>
							</div>
							<div class="aui-flex-item-3 aui-text-right"><img src="/assets/mobiles/mobile/img/ad/f2.jpg"></div>
						</div>
					</div>
					<div class="aui-flex-col aui-border-b">
						<div class="aui-flex-item-6 aui-padded-10 " style="position: relative;">
							<h5 class="aui-text-warning">拍摄一族</h5>
							<p>喜欢旅游拍摄</p>
							<img src="/assets/mobiles/mobile/img/ad/f3.jpg">
						</div>
						<div class="aui-flex-item-6 aui-padded-10 aui-border-l ">
							<h5 class="aui-text-success">每日坚果</h5>
							<p>每天补充一下</p>
							<img src="/assets/mobiles/mobile/img/ad/f5.jpg">
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="aui-avd-content clearfix">
			<a href="#">
				<img src="/assets/mobiles/mobile/img/pd/cf-1.jpg" alt="">
			</a>
			<a href="#">
				<img src="/assets/mobiles/mobile/img/pd/cf-3.jpg" alt="">
			</a>
		</div>
		<div class="aui-title-head">
			<img src="/assets/mobiles/mobile/img/icon/i-i1.png"  alt="">
		</div>
		<div class="aui-slide-box aui-slide-box-clear">
			<div class="aui-slide-list">
				<ul class="aui-slide-item-list">
					<li class="aui-slide-item-item">
						<a href="#" class="v-link">
							<img class="v-img" src="/assets/mobiles/mobile/img/ad/tou-6.jpg">
						</a>
					</li>
					<li class="aui-slide-item-item">
						<a href="#" class="v-link">
							<img class="v-img" src="/assets/mobiles/mobile/img/ad/tou-5.jpg">
						</a>
					</li>
					<li class="aui-slide-item-item">
						<a href="#" class="v-link">
							<img class="v-img" src="/assets/mobiles/mobile/img/ad/tou-4.jpg">
						</a>
					</li>
					<li class="aui-slide-item-item">
						<a href="#" class="v-link">
							<img class="v-img" src="/assets/mobiles/mobile/img/ad/tou-3.jpg">
						</a>
					</li>
					<li class="aui-slide-item-item">
						<a href="#" class="v-link">
							<img class="v-img" src="/assets/mobiles/mobile/img/ad/tou-2.jpg">
						</a>
					</li>
					<li class="aui-slide-item-item">
						<a href="#" class="v-link">
							<img class="v-img" src="/assets/mobiles/mobile/img/ad/tou-1.jpg">
						</a>
					</li>
				</ul>
			</div>

		</div>
		<div class="aui-title-head">
			<img src="/assets/mobiles/mobile/img/icon/i-i2.png"  alt="">
		</div>
		<div class="aui-list-content">
			<div class="aui-list-item">
				<div class="aui-list-item-img">
					<img src="/assets/mobiles/mobile/img/pd/cf-4.jpg" alt="">
				</div>
				<div class="aui-slide-box">
					<div class="aui-slide-list">
						<ul class="aui-slide-item-list">
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/pd-zf-6.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">自动滚筒洗衣机 变频 碳晶银 蒸汽杀菌 智能水循环</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥4999</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥5699</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/pd-zf-7.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">科克兰 盐焗烘烤开心果 1.36千克</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥99</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥198</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/pd-zf-8.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">榙榙 咸鸭蛋黄饼干 80克/袋</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥12.9</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥49</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/pd-zf-9.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">唯他可可 椰子水饮料 330毫升/盒 12盒</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥189</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥299</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/pd-zf-8.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">巴黎水 含气青柠味饮料 330毫升 24</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥129</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥199</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/pd-zf-7.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">calbee 卡乐比 日本进口休闲零食佳可比黄油味薯条 90克/盒</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥19.9</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥49</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/pd-zf-6.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">Calbee 卡乐比 日本进口休闲膨化零食 佳可丽色拉味薯条 60克/杯</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥19</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥49</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/pd-zf-8.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">Calbee 卡乐比 日本进口休闲膨化零食 佳可丽色拉味薯条 60克/杯</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥19</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥49</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/pd-zf-6.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">Calbee 卡乐比 日本进口休闲膨化零食 佳可丽色拉味薯条 60克/杯</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥19</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥49</span>
									</p>
								</a>
							</li>
						</ul>
					</div>

				</div>
			</div>
			<div class="aui-title-head">
				<img src="/assets/mobiles/mobile/img/icon/i-i3.png"  alt="">
			</div>
			<div class="aui-list-item">
				<div class="aui-list-item-img">
					<img src="/assets/mobiles/mobile/img/pd/cf-5.jpg" alt="">
				</div>
				<div class="aui-slide-box">
					<div class="aui-slide-list">
						<ul class="aui-slide-item-list">
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-31.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">Whoo 后 秘贴焕然新生精华液护肤礼盒 精华45毫升</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥349</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥499</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-32.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">Sulwhasoo 雪花秀 润燥精华60毫升</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥99</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥198</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-17.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">雅诗兰黛 红石榴护肤三件套  红色正能</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥399</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥999</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="#" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-18.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">Whoo 后 拱辰享水 水妍护肤套装 </p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥189</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥299</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-19.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">惊喜水分套装 持续补水维持平衡</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥1349</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥4199</span>
									</p>
								</a>
							</li>
						</ul>
					</div>

				</div>
			</div>
			<div class="aui-title-head">
				<img src="/assets/mobiles/mobile/img/icon/i-i4.png"  alt="">
			</div>
			<div class="aui-list-item">
				<div class="aui-list-item-img">
					<img src="/assets/mobiles/mobile/img/pd/cf-7.jpg" alt="">
				</div>
				<div class="aui-slide-box">
					<div class="aui-slide-list">
						<ul class="aui-slide-item-list">
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-25.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">LA 女士宽松毛衣纯色针织衫外套长袖上衣</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥249</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥499</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-26.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">FIRSTMIX秋季新款宽松圆领女式针织开衫</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥99</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥198</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-27.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">maxwin 马威 女式八分袖针织连衣裙</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥122.9</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥149</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-28.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">唯他可可 椰子水饮料 330毫升/盒 12盒</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥189</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥299</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-29.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">巴黎水 含气青柠味饮料 330毫升 24</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥129</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥199</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-30.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">calbee 卡乐比 日本进口休闲零食佳可比黄油味薯条 90克/盒</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥19.9</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥49</span>
									</p>
								</a>
							</li>
						</ul>
					</div>

				</div>
			</div>
			<div class="aui-title-head">
				<img src="/assets/mobiles/mobile/img/icon/i-i5.png"  alt="">
			</div>
			<div class="aui-list-item">
				<div class="aui-list-item-img">
					<img src="/assets/mobiles/mobile/img/pd/cf-8.jpg" alt="">
				</div>
				<div class="aui-slide-box">
					<div class="aui-slide-list">
						<ul class="aui-slide-item-list">
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-20.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">nissen 凹凸纵横弹性沙发套</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥31149</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥11499</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-21.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">日本NITORI尼达利 三折坐垫 长毛条纹 浅棕 </p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥1199</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥1198</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-22.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 对伴沙发</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥2399</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥9999</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
									<img class="v-img" src="/assets/mobiles/mobile/img/pd/sf-23.jpg">
									<p class="aui-slide-item-title aui-slide-item-f-els">商城精选 韵白系列沙发三人位</p>
									<p class="aui-slide-item-info">
										<span class="aui-slide-item-price">¥9189</span>&nbsp;&nbsp;<span class="aui-slide-item-mrk">¥21299</span>
									</p>
								</a>
							</li>
							<li class="aui-slide-item-item">
								<a href="<?= Url::toRoute('product/detail')?>" class="v-link">
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
			</div>
		</div>

		<div class="aui-recommend">
			<img src="/assets/mobiles/mobile/img/bg/icon-tj1.jpg" alt="">
			<!--<h2>为你推荐</h2>-->
		</div>
		<section class="aui-list-product">
			<div class="aui-list-product-box">
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
				<a href="<?= Url::toRoute('product/detail')?>" class="aui-list-product-item">
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
	<script type="text/javascript">
        $(function () {
            //绑定滚动条事件
            //绑定滚动条事件
            $(window).bind("scroll", function () {
                var sTop = $(window).scrollTop();
                var sTop = parseInt(sTop);
                if (sTop >= 40) {
                    if (!$("#scrollBg").is(":visible")) {
                        try {
                            $("#scrollBg").slideDown();
                        } catch (e) {
                            $("#scrollBg").show();
                        }
                    }
                }
                else {
                    if ($("#scrollBg").is(":visible")) {
                        try {
                            $("#scrollBg").slideUp();
                        } catch (e) {
                            $("#scrollBg").hide();
                        }
                    }
                }
            });
        })
	</script>
</body>
</html>