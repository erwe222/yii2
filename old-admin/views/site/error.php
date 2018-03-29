<?php if($exception && $exception->statusCode == 404):?>
<link rel="stylesheet" type="text/css" href="/assets/plug/error/css/error_404.css" />
<div class="error_404">
  <div class="container clearfix">
    <div class="error_pic"></div>
    <div class="error_info">
      <h2>
        <p>对不起，您访问的页面不存在！</p>
      </h2>
      <div class="operate">
        <input class="global_btn btn_89bf43" onClick="location.href='/'" type="button" value="返回主页">
        <input class="global_btn btn_39dec8 ml1" onClick="history.go(-1)" type="button" value="返回上一页">
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(function(){
        $("#back_top > a").click(function(){
            $("html, body").animate({scrollTop:"0px"},1000);return false
        });
    })
</script>
<?php elseif($exception && $exception->statusCode != 404):?>
    <style type="text/css">
        body{ margin:0; padding:0; background:#efefef; font-family:Georgia, Times, Verdana, Geneva, Arial, Helvetica, sans-serif; }
        div#mother{ margin:0 auto; width:943px; height:572px; position:relative; }
        div#errorBox{ background: url(/assets/plug/error/images/shiyanyisu.com_bg.png) no-repeat top left; width:943px; height:572px; margin:auto; }
        div#errorText{ color:#39351e; padding:115px 0 0 446px }
        div#errorText p{ width:303px; font-size:14px; line-height:26px; }
        div.link{ /*background:#f90;*/ height:50px; width:145px; float:left; }
        div#home{ margin:20px 0 0 444px;}
        div#contact{ margin:20px 0 0 25px;}
        h1{ font-size:40px; margin-bottom:35px; }
    </style>
    <div id="mother">
        <div id="errorBox">
                <div id="errorText">
                    <h1>Sorry...系统错误！</h1>
                    <p>     
                        [<?php echo $exception->statusCode;?>]&nbsp;&nbsp;<?php echo $exception->getMessage();?>
                    </p>
                </div>
                <a href="http://www.17sucai.com/" title="返回首页">
                    <div class="link" id="home"></div>
                </a>
                <a href="http://www.17sucai.com/" title="联系管理员">
                    <div class="link" id="contact"></div>
                </a>
        </div>
    </div>
<?php endif;?>