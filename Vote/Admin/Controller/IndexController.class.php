<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		$this->display();
    }
    //验证登录
    public function checklogin(){
    	if(IS_POST){
    		$loguser=I('POST.username');
    		$logpass=I('POST.password');
    		if(empty($loguser)||empty($logpass)){
    			$this->error('用户名或密码必须！');
    		}else{
    			//校验用户是否存在
    			$user=M("user")->where(array('username'=>$loguser))->find();
    			if(empty($user)){
    				$this->error('用户不存在！');
    				return false;
    			}else{
    				if($user["status"]=='0'){
    					$this->error('该用户已禁用！请联系管理员！');
    					return false;
    				}else{
    					if(md5($logpass)!==$user["password"]){
    						$this->error('密码错误！');
    						return false;
    					}else{
    						//拆分IP
    						$ipinfo=explode("_",getipinfo());
    						//session相关登录信息
    						session('sys_time',time());//session登录时间
    						session('sys_lasttime',date("Y-m-d H:i:s", $user["last_login_time"]));//session上次登录时间
    						session('sys_name',$user["username"]);
    						//同步登陆信息
    						$data["login_time"]=time();
    						$data["last_login_time"]=$user["login_time"];
    						$data["login_ip"]=get_client_ip();
    						$data["last_login_ip"]=$user["login_ip"];
    						if(M("user")->where(array("username"=>$loguser))->save($data)){
    							$this->success('登录成功！正在跳转...',U('System/main'));
    						}else{
    							$this->error('登录失败！');
    						}
    					}
    				}
    			}
    		}
    	}else{
    		$this->error('未授权访问！',U('Index/login'));
    	}
    }
    //注销登录
    public function loginout(){
    	if(!empty($_SESSION['sys_name'])){
    		unset($_SESSION['sys_name']);
    		$_SESSION=array();
    		session_destroy();
    		$this->success('登出成功',U('Index/index'));
    	}else{
    		$this->error('已经登出了',U('Index/index'));
    	}
    }
}