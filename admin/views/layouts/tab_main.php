<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo ArrayHelper::getValue(Yii::$app->params, 'domain_name','---');?></title>
        <link rel="stylesheet" href="/assets/plug/layui/css/layui.css" media="all">
        <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
        <link rel="stylesheet" href="/assets/build/css/app.css" media="all">
        <link rel="stylesheet" href="/assets/build/css/themes/default.css" media="all" id="cus-tab-theme">
    </head>
    <body class="kit-theme">
        <div class="layui-layout layui-layout-admin kit-layout-admin">
            <div class="layui-header">
                <div class="layui-logo">后台管理</div>
                <div class="layui-logo kit-logo-mobile">K</div>
                <ul class="layui-nav layui-layout-left kit-nav">
                    <li class="layui-nav-item" id="cus-user-info"><a href="javascript:;">个人中心</a></li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">主题皮肤</a>
                        <dl class="layui-nav-child cus-click-themes">
                            <dd><a href="javascript:;" data-skin="default" style="color:#393D49 !important;"><i class="layui-icon"></i> 默认</a></dd>
                            <dd><a href="javascript:;" data-skin="orange" style="color:#ff6700 !important;"><i class="layui-icon"></i> 橘子橙</a></dd>
                            <dd><a href="javascript:;" data-skin="green" style="color:#00a65a !important;"><i class="layui-icon"></i> 原谅绿</a></dd>
                            <dd><a href="javascript:;" data-skin="pink" style="color:#FA6086 !important;"><i class="layui-icon"></i> 少女粉</a></dd>
                            <dd><a href="javascript:;" data-skin="blue" style="color:#00c0ef !important;"><i class="layui-icon"></i> 天空蓝</a></dd>
                            <dd><a href="javascript:;" data-skin="red" style="color:#dd4b39 !important;"><i class="layui-icon"></i> 枫叶红</a></dd>
                        </dl>
                    </li>
                </ul>
                <ul class="layui-nav layui-layout-right kit-nav">
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <img src="<?php echo ArrayHelper::getValue(Yii::$app->view->params['seller_info'], 'image','/assets/custom/images/center-photo.png');?>" class="cus-header-img layui-nav-img layui-anim layui-anim-rotate" data-anim="layui-anim-rotate">
                            <?php echo ArrayHelper::getValue(Yii::$app->view->params['seller_info'], 'username','---');?>
                        </a>
                        
                        <dl class="layui-nav-child">
                            <dd><a href="<?= Url::toRoute('user/my-info')?>">基本资料</a></dd>
                            <dd><a href="javascript:;">安全设置</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item"><a href="javascript:;" id="cus-to-logout"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a></li>
                </ul>
            </div>

            <div class="layui-side layui-bg-black kit-side">
                <div class="layui-side-scroll">
                    <div class="kit-side-fold"><i class="fa fa-navicon" aria-hidden="true"></i></div>
                    <ul class="layui-nav layui-nav-tree" lay-filter="kitNavbar" kit-navbar>
                        <?= \admin\widgets\LeftMenuWidget::widget();?>
                    </ul>
                </div>
            </div>
            <div class="layui-body" id="container" >
                <div style="padding: 15px;">主体内容加载中,请稍等...</div>
            </div>

            <div class="layui-footer">2017 &copy;<a href="/">后台管理</a></div>
        </div>
        <script src="/assets/plug/layui/layui.js"></script>
        <script src="/assets/custom/js/jquery.min.js" ></script>
        <script>
            //初始化界面
            var conf_mainUrl  = '/index/main';
            var layer;
            var tab;
            layui.config({
                base: '/assets/build/js/'
            }).use(['app', 'message', 'tab'], function() {
                var app = layui.app,
                $ = layui.jquery,
                layer = layui.layer;
                tab = layui.tab;
                //主入口
                app.set({
                    type: 'iframe'
                }).init();
                
                
                $('#cus-user-info').on('click',function(){
                    tab.tabAdd({
                        id: 'my-iinfo',
                        title: "管理员信息",
                        icon: "&#xe612;",
                        url: "admin/my-info"
                    });
                });
            });
            
            function tabAdd(json){
                tab.tabAdd(json);
            }
            
            //退出操作
            $('#cus-to-logout').on('click',function(){
                layer.msg('您确定要退出登录吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['退出', '取消']
                    ,yes: function(index){
                        layer.close(index);
                        layer.msg('退出中,请稍等...', {time: 0,icon: 16,shade: 0.01});
                        $.ajax({
                              url:'/login/logout',
                              type:'post',
                              dataType:'json',
                              success:function(res){
                                  console.log(res);
                                  if(res.code == 200){
                                      window.location.href = '/login/login';
                                      return false;
                                  }
                              }
                        });
                    }
                });
            });
            
            /**
             * 我的相册
             * @param {type} html
             * @returns {undefined}
             */
            function myPhones(ddd){
                layer.photos(ddd);
            }
            
            $('.cus-click-themes  dd').on('click',function(){
                var $that = $(this);
                var skin = $that.children('a').data('skin');
                var href = '/assets/build/css/themes/'+skin+'.css';
                skinTheme.changeThemeSkin(href);
                skinTheme.setThemeSkin(href);
            });
            
            var skinTheme = {
                skinFlag:'themeSkin',
                getThemeSkin:function(){
                    return localStorage.getItem(this.themeSkin);
                },
                setThemeSkin:function(href){
                    localStorage.setItem(this.themeSkin,href);
                },
                changeThemeSkin:function(href){
                    $('#cus-tab-theme').attr('href',href);
                }
            };
            
            $(function(){
                var skin = skinTheme.getThemeSkin();
                if(skin != null){
                    skinTheme.changeThemeSkin(skin);
                }
            });
        </script>
    </body>
</html>