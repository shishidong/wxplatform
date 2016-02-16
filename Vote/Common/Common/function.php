<?php
function check_verify($code, $id = ''){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}
function getipinfo(){
	header("Content-Type:text/html;   charset=utf-8");
	$url = 'http://1111.ip138.com/ic.asp';  //这儿填页面地址
	$info=httpGet($url);
	$p = "%<center>(.*?)</center>%si";
	preg_match_all($p, $info, $arr);
	
	$info=$arr[1];
	$str1 = explode("[",iconv('GB2312', 'UTF-8',$info[0]));
	$str2 = explode("]",$str1[1]);
	$ip=$str2[0].'_'.substr($str2[1],10);
	return $ip;
}
function httpGet($url) {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_TIMEOUT, 500);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_URL, $url);

	$res = curl_exec($curl);
	curl_close($curl);

	return $res;
}
//栓为数组
function object2array(&$object) {
	$object =  json_decode( json_encode( $object),true);
	return  $object;
}
//数据库相关
//处理方法
function rmdirr($dirname) {
	if (!file_exists($dirname)) {
		return false;
	}
	if (is_file($dirname) || is_link($dirname)) {
		return unlink($dirname);
	}
	$dir = dir($dirname);
	if ($dir) {
		while (false !== $entry = $dir->read()) {
			if ($entry == '.' || $entry == '..') {
				continue;
			}
			//递归
			rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
		}
	}
}

//公共函数
//获取文件修改时间
function getfiletime($file, $DataDir) {
	$a = filemtime($DataDir . $file);
	$time = date("Y-m-d H:i:s", $a);
	return $time;
}

//获取文件的大小
function getfilesize($file, $DataDir) {
	$perms = stat($DataDir . $file);
	$size = $perms['size'];
	// 单位自动转换函数
	$kb = 1024;         // Kilobyte
	$mb = 1024 * $kb;   // Megabyte
	$gb = 1024 * $mb;   // Gigabyte
	$tb = 1024 * $gb;   // Terabyte

	if ($size < $kb) {
		return $size . " B";
	} else if ($size < $mb) {
		return round($size / $kb, 2) . " KB";
	} else if ($size < $gb) {
		return round($size / $mb, 2) . " MB";
	} else if ($size < $tb) {
		return round($size / $gb, 2) . " GB";
	} else {
		return round($size / $tb, 2) . " TB";
	}
}
//截取字符串
function subtext($text, $length)
{
	if(mb_strlen($text, 'utf8') > $length)
		return mb_substr($text, 0, $length, 'utf8').'...';
	return $text;
}
//友好时间显示开始
/**
 * 友好的时间显示
 *
 * @param int    $sTime 待显示的时间
 * @param string $type  类型. normal | mohu | full | ymd | other
 * @param string $alt   已失效
 * @return string
 */
function fdate($sTime,$type = 'mohu',$alt = 'false') {
	//sTime=源时间，cTime=当前时间，dTime=时间差
	$cTime        =    time();
	$dTime        =    $cTime - $sTime;
	$dDay        =    intval(date("z",$cTime)) - intval(date("z",$sTime));
	//$dDay        =    intval($dTime/3600/24);
	$dYear        =    intval(date("Y",$cTime)) - intval(date("Y",$sTime));
	//normal：n秒前，n分钟前，n小时前，日期
	if($type=='normal'){
		if( $dTime < 60 ){
			return $dTime."秒前";
		}elseif( $dTime < 3600 ){
			return intval($dTime/60)."分钟前";
			//今天的数据.年份相同.日期相同.
		}elseif( $dYear==0 && $dDay == 0  ){
			//return intval($dTime/3600)."小时前";
			return '今天'.date('H:i',$sTime);
		}elseif($dYear==0){
			return date("m月d日 H:i",$sTime);
		}else{
			return date("Y-m-d H:i",$sTime);
		}
	}elseif($type=='mohu'){
		if( $dTime < 60 ){
			return $dTime."秒前";
		}elseif( $dTime < 3600 ){
			return intval($dTime/60)."分钟前";
		}elseif( $dTime >= 3600 && $dDay == 0  ){
			return intval($dTime/3600)."小时前";
		}elseif( $dDay > 0 && $dDay<=7 ){
			return intval($dDay)."天前";
		}elseif( $dDay > 7 &&  $dDay <= 30 ){
			return intval($dDay/7) . '周前';
		}elseif( $dDay > 30 ){
			return intval($dDay/30) . '个月前';
		}
		//full: Y-m-d , H:i:s
	}elseif($type=='full'){
		return date("Y-m-d , H:i:s",$sTime);
	}elseif($type=='ymd'){
		return date("Y-m-d",$sTime);
	}else{
		if( $dTime < 60 ){
			return $dTime."秒前";
		}elseif( $dTime < 3600 ){
			return intval($dTime/60)."分钟前";
		}elseif( $dTime >= 3600 && $dDay == 0  ){
			return intval($dTime/3600)."小时前";
		}elseif($dYear==0){
			return date("Y-m-d H:i:s",$sTime);
		}else{
			return date("Y-m-d H:i:s",$sTime);
		}
	}
}

//判断是电脑还是手机
function isMobile(){
	$useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	$useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
	function CheckSubstrs($substrs,$text){
		foreach($substrs as $substr)
			if(false!==strpos($text,$substr)){
			return true;
		}
		return false;
	}
	$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
	$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');

	$found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||
	CheckSubstrs($mobile_token_list,$useragent);

	if ($found_mobile){
		return true;
	}else{
		return false;
	}
}