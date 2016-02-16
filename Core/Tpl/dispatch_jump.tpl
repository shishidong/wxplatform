<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
跳转提示
</title>
<style type="text/css">
*{padding:0;margin:0}body{background:#fff;font-family:'微软雅黑';color:#333;font-size:18px;padding-top:20px;}.message{max-width:400px;margin:auto;border:1px solid #4399CB;padding:10px 0;margin-top:30px}.head{background: transparent url("__PUBLIC__/Static/Images/lefttop.gif") repeat-x scroll 0% 0%;width:100%;color:#ffffff;height:40px;line-height:40px;margin-top:-11px;text-align:center;}.content{width:100%}.success,.error{text-align:center;margin-top:30px;font-size:24px;}.jump{text-align:center;margin-top:20px}
</style>
</head>
<body>
<div class="message">
	<div class="head">
	  <span>系统提示:</span>
	</div>
	<div class="content">
	  <?php if(isset($message)) {?>
		<p class="success">
		  :)
		  <?php echo($message); ?>
		</p>
		<?php }else{?>
		<p class="error">
		  :(
		  <?php echo($error); ?>
		</p>
		<?php }?>
		<p class="detail"></p>
		<p class="jump">
		  	<a id="href" href="<?php echo($jumpUrl); ?>"> 点击直接跳转...</a><br /><br/>
		  	等待时间：<b id="wait"><?php echo($waitSecond); ?></b>
		</p>
	</div>
</div>
<script type="text/javascript">
  (function() {
    var wait = document.getElementById('wait'),
    href = document.getElementById('href').href;
    var interval = setInterval(function() {
      var time = --wait.innerHTML;
      if (time <= 0) {
        location.href = href;
        clearInterval(interval);
      };
    },
    1000);
  })();
</script>
</body>
</html>