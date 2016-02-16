<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="<?php echo ($siteinfo["sitedesc"]); ?>">
<meta name="keywords" content="<?php echo ($siteinfo["sitekeywords"]); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo ($siteinfo["sitename"]); ?>-在线投票</title>
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<!-- No Baidu Siteapp-->
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="webster"/>
<meta name="msapplication-TileColor" content="#0e90d2">
<link rel="stylesheet" href="/wxplatform/Public/Static/Css/amazeui.min.css">
<link rel="stylesheet" href="/wxplatform/Public/Static/Css/app.css">
</head>
<body>
<section class="container"> 
<section class="header">
	<img style="max-width:200px;margin:0 auto" src="/wxplatform/Public/Static/Images/index1.png" class="am-img-responsive am-animation-slide-top" alt=""/>
	<img style="max-width:300px;margin:5px auto" src="/wxplatform/Public/Static/Images/index2.png" class="am-img-responsive am-animation-scale-up" alt=""/>
</section> 
<section class="am-container am-animation-slide-left" style="padding-top:20px;">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><table data-am-widget="gallery" class="am-table" style="background:#fff;margin-bottom:15px;" data-am-gallery="{pureview: 1}">
		<tbody>
		<tr>
			<td style="vertical-align:middle;"><img src="<?php echo ($vo["touxiang"]); ?>" style="width:100px;height:100px" data-rel="<?php echo ($vo["touxiang_big"]); ?>"/></td>
			<td style="vertical-align:middle;font-weight:bold">姓名：<?php echo ($vo["name"]); ?><br><br>号牌：<?php echo ($vo["mynum"]); ?></td>
			<td style="text-align:center;vertical-align:middle;"><button type="button" class="am-btn am-btn-danger am-radius" onclick="vote(<?php echo ($vo["id"]); ?>)">投她一票</button></td>
		</tr>
		</tbody>
	</table><?php endforeach; endif; else: echo "" ;endif; ?>
</section>
<section class="footer">
	<img style="width:100%" src="/wxplatform/Public/Static/Images/index3.png" class="am-img-responsive" alt=""/>
</section> 
</section> 

<!-- js -->
<script src="/wxplatform/Public/Static/Js/jquery-1.8.3.min.js"></script>
<!-- <script src="/wxplatform/Public/Static/Js/jquery.lazyload.min.js"></script> -->
<script src="/wxplatform/Public/Static/Js/amazeui.min.js"></script>
<script src="/wxplatform/Public/Static/Js/app.js"></script>
<script src="/wxplatform/Public/Layer/layer.min.js"></script>
<script>
// $(function() {
//     $("img.lazy").lazyload({ 
//     	//threshold : 400,
//     	effect : "fadeIn" 
//     });
// });
function fleshVerify(){  
    //重载验证码 
    var time = new Date().getTime(); 
        document.getElementById('verifyImg').src= '<?php echo U("Index/verify");?>'+'?'+Math.random(); 
 }
function vote(id){
	layer.open({
	    type: 1,
	    title:'投票二次验证',
	    shadeClose:true,
	    skin: 'layui-layer-rim', //加上边框
	    area: ['80%', '350px'], //宽高
	    content: '<div style="text-align:center"><img id="verifyImg" style="cursor:pointer" width="100%" height="80" alt="验证码" src="<?php echo U("Index/verify");?>" onclick="fleshVerify()" title="点击我刷新验证码"><hr><input type="text" id="verify" placeholder="请输入验证码" style="padding:5px;width:80%;height:45px;"><input type="hidden" id="p_id" value="'+id+'"><br><br><button type="button" style="width:80%;height:45px;font-size:24px;background-color:#dc3e77;border:none;color:#fff" onclick="votedo()">确定投票</button><br><br><p>*请输入上方验证码（点击验证码可刷新）</p></div>'
	});
}
function votedo(){
	layer.load(1);
	var verify=document.getElementById("verify").value;
	var p_id=document.getElementById("p_id").value;
	if(verify==''||verify==null||verify==undefined){
		layer.closeAll('loading');
		layer.msg('验证码不能为空！');
	}else{
		$.get("<?php echo U('Index/vote');?>",{p_id:p_id,verify:verify},function(data){
			layer.closeAll('loading');
	    	if(data=='1'){
	    		layer.closeAll('page');
	    		layer.msg('投票成功！');
	    	}
			if(data=='code_false'){
				layer.msg('验证码错误！');   		
			}
			if(data=='noopen'){
				layer.msg('投票还未开始！');   		
			}
			if(data=='over'){
				layer.msg('投票已结束！');   		
			}
			if(data=='9'){
				layer.msg('您已经投过票啦！'); 
			}
			if(data=='0'){
				layer.msg('投票未开启！'); 
			}
			if(data=='0000'){
				layer.msg('禁止投票！'); 
			}
		}); 
	}
}
</script>
</body>
</html>