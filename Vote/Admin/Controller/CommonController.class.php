<?php
// +----------------------------------------------------------------------
// | 设计开发：Webster  Tel:17095135002 邮箱：chenwei@js789.com.cn
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller {
	protected function _initialize(){
		$this->siteinfo=M('siteinfo')->where('id=1')->find();
		if(empty($_SESSION['sys_name'])){
			$this->error('登陆超时，请重新登录！',U('Index/index'));
		}
		//设置超时为30分钟开发阶段暂时禁用
		
		$nowtime = time();
		$s_time = $_SESSION['sys_time'];
		if (($nowtime - $s_time) > 1800) {
			unset($_SESSION['sys_name']);
			session_destroy();
			$this->error('登陆超时，请重新登录！',U('Index/index'));
		} else {
			session('sys_time',time());
		}
   	}
}