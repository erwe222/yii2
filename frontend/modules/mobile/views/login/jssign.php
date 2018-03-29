<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title></title>
		<script src="/assets/jssign/js/mui.min.js"></script>
		<link href="/assets/jssign/css/mui.min.css" rel="stylesheet" />
		<script type="text/javascript" src="/assets/jssign/js/jquery.js"></script>
		<script type="text/javascript" src="/assets/jssign/js/jSignature.min.js"></script>
		<!--[if lt IE 9]>
		<script type="text/javascript" src="js/flashcanvas.js"></script>
		<![endif]-->
	</head>

	<body>
	    <div style="width: 100%;height:40px;background: red;text-align:center;line-height:40px; ">欢迎来到个性签名写字板</div>
		<div id="signature" style="height: 100%;"></div>
		<div style="width: 100%;height:40px;background: green;text-align:center;line-height:40px;position: fixed;bottom: 0px;">
			<div style='float:left;width:50%;' id="clear">重置</div>
			<div style='float:left;width:50%;border:1px solid #fff;border-top: 0px;border-right:0px;' id="save">保存</div>
			<!-- <div style='float:left;width:50%;' id="export">保存</div> -->
		</div>
		<!-- <div id="pic" /> -->
		<p id="base" style="width:100%;"></p>
		<script type="text/javascript" charset="utf-8">
			mui.plusReady(function() {
				plus.screen.lockOrientation('landscape-secondary');
			});
			$(document).ready(function() {
				var dHeight = document.body.scrollHeight - 80;
		        var dWidth = document.body.scrollWidth;
		        $("#signature").jSignature({height:dHeight,width:dWidth, signatureLine:false});//初始化调整手写屏大小  
			});
			document.getElementById("clear").addEventListener('tap', function() {
				$("#signature").jSignature("reset");
				$("#pic")[0].innerHTML = '';
			});
			document.getElementById("save").addEventListener('tap', function() {
				var datapair = $("#signature").jSignature("getData", "image");
				var array = datapair.splice(",");
				console.log(array[1]);
				// mui.toast(array[1]);
				mui.toast('保存成功');
			});
			document.getElementById("export").addEventListener('tap', function() {
				var datapair = $("#signature").jSignature("getData", "image");
				var i = new Image();
				i.src = "data:" + datapair[0] + "," + datapair[1];
				$(i).appendTo($("#pic"));
			});
		</script>
	</body>

</html>