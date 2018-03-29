<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $infos[0]['title'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/assets/mobiles/mobile/mui/css/mui.css">
</head>
<body>
    <header class="mui-bar mui-bar-nav">
        <a href="javascript:history.go(-1);" class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
        <h1 class="mui-title">通知详情</h1>
    </header>
    <div class="mui-content">
        <div class="mui-content-padded">
            <h5 style="text-align: center;font-size: 16px;color:#757573;"><?php echo $infos[0]['title'];?></h5>
            <h6 style="text-indent:20px;">通知时间：<?php echo date('m-d H:i',strtotime($infos[0]['create_time']));?></h6>
            <p style="text-indent:20px;margin-top: 20px;">
                <?php echo $infos[0]['message'];?>
            </p>
        </div>
    </div>
</body>
</html>