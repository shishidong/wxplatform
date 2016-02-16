<?php
// +----------------------------------------------------------------------
// | 设计开发：Webster  Tel:17095135002 邮箱：chenwei@js789.com.cn
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;

class PublicController extends Controller {
	protected function _initialize(){
		//读取网站配置
		$this->siteinfo=M('siteinfo')->where('id=1')->find();
	}
    public function errors(){
        $this->display();
    }
}