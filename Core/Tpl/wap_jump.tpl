<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<title>友情提示</title> 
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">
<link href="__PUBLIC__/Static/Css/tip.css" rel="stylesheet" type="text/css">
</head> 
<body>
	<div class="errorbg"><img src="__PUBLIC__/Static/Images/tip.jpg"></div>
	<div class="tu"><img src="<present name="message">__PUBLIC__/Static/Images/success.png<else/>__PUBLIC__/Static/Images/error.png</present>"><div class="msg" style="margin-top:15px"><present name="message"><?php echo($message); ?><else/><?php echo($error); ?></present></div><div class="msg" style="color:#999999;font-size:12px"><span id="wait"><?php echo($waitSecond); ?></span>秒后自动跳转<a id="href" style="display:none" href="<?php echo($jumpUrl); ?>">点击手动跳转</a></div></div>
<script type="text/javascript">

(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 2000);
})();

</script>
</body></html>