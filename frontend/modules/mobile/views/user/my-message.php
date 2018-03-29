<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hello MUI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="stylesheet" href="/assets/mobiles/mobile/mui/css/mui.css">
        <style type="text/css">
            .mui-content > .mui-table-view:first-child {
                margin-top: 0px; 
            }
            .mui-table-cell{color:#837E7E;}
            .isread{color:#ccc !important;font-size:14px;}
            .time{font-size:12px;display: inline-block;float:right;color:#ccc;}
        </style>
    </head>
<body>
        <header class="mui-bar mui-bar-nav">
            <a href="javascript:history.go(-1);" class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
            <h1 class="mui-title">我的消息</h1>
        </header>
        <!--下拉刷新容器-->
        <div id="pullrefresh" class="mui-content mui-scroll-wrapper">
            <div class="mui-scroll">
                <ul id="OA_task_2" class="mui-table-view">
                        
                </ul>
            </div>
        </div>

    <script src="/assets/mobiles/mobile/mui/js/mui.min.js"></script>
    <script type="text/javascript" src="/assets/mobiles/mobile/js/jquery.min.js"></script>
    <script>
            var pageindex = 0; 
            var pageNum   = 1;
            
            mui.init({
                pullRefresh: {
                    container: '#pullrefresh',
                    up: {
                        contentrefresh: '正在加载...',
                        callback: pullupRefresh
                    }
                }
            });

            /**
             * 获取数据
             */
            function loadData(){
                $.ajax({
                    url:'/mobile/user/get-message-list',
                    data:{pageindex:pageindex},
                    type:'POST',
                    dataType:'json',
                    success:function(res){
                        console.log(res);
                        pageNum = res.page_num;
                        var table = document.body.querySelector('.mui-table-view');
                        $.each(res.infos, function(key, obj) {
                            var cells = document.body.querySelectorAll('.mui-table-view-cell');
                            var li = document.createElement('li');
                            li.setAttribute('cusherf',obj.id);
							li.className = 'mui-table-view-cell';
							var isread = '';
							if(obj.is_read == 1){
								isread = '<span class="isread">☛</span>';
							}
                            li.innerHTML = '<div class="mui-slider-right mui-disabled" data="1"><a class="mui-btn mui-btn-red">删除</a></div><div class="mui-slider-handle mui-table"><div class="mui-table-cell">'+isread+obj.title+'<span class="time">'+obj.create_time+'</span></div></div>';
                            table.appendChild(li);
                        });
                    }
                });
            }
            
            /**
             * 上拉加载具体业务实现
             */
            function pullupRefresh() {
                setTimeout(function() {
                    mui('#pullrefresh').pullRefresh().endPullupToRefresh((++pageindex > pageNum)); //参数为true代表没有更多数据了。
                    loadData();
                }, 1500);
            }

            if (mui.os.plus) {
                mui.plusReady(function() {
                    setTimeout(function() {
                        mui('#pullrefresh').pullRefresh().pullupLoading();
                    }, 1000);

                });
            } else {
                mui.ready(function() {
                    mui('#pullrefresh').pullRefresh().pullupLoading();
                });
            }

            (function($) {
                var btnArray = ['确认', '取消'];
                //第二个demo，向左拖拽后显示操作图标，释放后自动触发的业务逻辑
                $('#OA_task_2').on('slideleft', '.mui-table-view-cell', function(event) {
                    var elem = this;
                    var id = this.getAttribute("cusherf");
                    mui.confirm('确认删除该条记录？', '温馨提示', btnArray, function(e) {
                        if (e.index == 0) {
                            $.ajax({
                                url:'del-message',
                                data:{id:id},
                                type:'POST',
                                dataType:'json',
                                success:function(res){
                                    console.log(res);
                                    if(res.errCode != 200){
                                        mui.toast('删除失败',{ duration:'short', type:'div' }) 
                                    }else{
                                    	 mui.toast('删除成功',{ duration:'short', type:'div' }) 
                                    }
                                }
                            });

                            elem.parentNode.removeChild(elem);
                        } else {
                            setTimeout(function() {
                                    $.swipeoutClose(elem);
                            }, 0);
                        }
                    });
                });

                $('#OA_task_2').on('tap', '.mui-table-view-cell', function(event) {
                    window.location.href = 'my-message-info?id='+this.getAttribute("cusherf")
                });
            })(mui);
    </script>
    </body>
</html>