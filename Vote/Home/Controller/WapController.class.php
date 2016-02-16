<?php
namespace Home\Controller;
use Think\Controller;
class WapController extends Controller {
	protected function _initialize(){
		//读取网站配置
		$this->siteinfo=M('siteinfo')->where('id=1')->find();
		//判断网站是否正常
		if($this->siteinfo['sitestatus']=='0'){//关闭状态
			$this->redirect('Public/errors');
		}
		//判断电脑还是手机
		if(!isMobile()){
			$this->redirect('Index/index');
		}
	}
    public function index(){
    	//读取作品
    	$Product = M('product'); // 实例化User对象
    	$count      = $Product->count();// 查询满足要求的总记录数
    	$Page       = new \Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show       = $Page->show();// 分页显示输出
    	// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$list = $Product->order('p_tjtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('list',$list);// 赋值数据集
    	$this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }
}