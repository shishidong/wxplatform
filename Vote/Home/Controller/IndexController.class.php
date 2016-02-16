<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	protected function _initialize(){
		//读取网站配置
		$this->siteinfo=M('siteinfo')->where('id=1')->find();
		//判断网站是否正常
		if($this->siteinfo['sitestatus']=='0'){//关闭状态
			$this->redirect('Public/errors');
		}
		//判断电脑还是手机
		//if(isMobile()){
		 	//限定只能在微信打开
		 	//if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')== false) {
		 	//	$this->error('请用微信客户端打开！');
		 	//}else{
		 		$value=cookie('visitor');
		 		if(empty($value)){
		 			$cookie_id= md5(time() . mt_rand(0,1000));
		 			cookie('visitor',$cookie_id,1296000); // 指定cookie保存时间15天
		 		}
		 	//}
		// }else{
		 	//$this->error('请用手机打开！');
		//}
	}
    public function index(){
    	$list=M('baoming')->where(array('status'=>'1'))->select();
    	$this->assign('list',$list);
        $this->display();
    }
    //报名页面
    public function baoming(){
    	if(IS_POST){
    			$rules = array(
    					array('name','require','姓名必须！'),
    					array('mynum','require','号牌必须！'),
    					array('phone','require','手机号码必须！'),
    					array('mynum','','请勿重复报名！',0,'unique',1),
    			);
    			
    			if (!M('baoming')->validate($rules)->create()){
    				$this->error(M('baoming')->getError());
    			}else{
	    			$data['name']=I('name');
	    			$data['mynum']=I('mynum');
	    			$data['phone']=I('phone');
	    			$data['touxiang']=I('touxiang');
	    			$data['touxiang_big']=I('touxiang_big');
	    			if(M('baoming')->add($data)){
	    				$this->success('报名成功，请等待审核通过！');
	    			}else{
	    				$this->error('报名失败！');
	    			}
    			}
    	}else{
    		$this->display();
    	}
    }
    //验证码生成
    public function verify(){
    	$config = array(
    			'fontSize' =>45, // 验证码字体大小
    			'length' =>4, // 验证码位数
    			'useNoise' => true, // 关闭验证码杂点
    			'codeSet'	=>	'0123456789',
    			'bg'=>array( 255, 255, 255)
    	);
    	$Verify = new \Think\Verify($config);
    	$Verify->entry();
    }
    //投票操作
    public function vote(){
    	if(IS_AJAX){
    		if($this->siteinfo['vote_status']=='1'){
    			//判断投票时间段
    			if($this->siteinfo['vote_btime']>time()){
    				//投票还未开始
    				echo 'noopen';	
    			}elseif($this->siteinfo['vote_etime']<time()){
    				//投票已结束
    				echo 'over';
    			}else{
    				$verify=I('GET.verify');
    				//校对验证码
    				if(!check_verify($verify)){
    					echo 'code_false';
    				}else{
    					$value=cookie('visitor');
    					//获取到投票对象
    					$data['b_id']=I('GET.p_id');
    					$data['cookie_id']=$value;
    					$data['ipaddr']=get_client_ip();
    					$data['time']=time();
    					$b_status=M('baoming')->where(array('id'=>I('GET.p_id')))->getField('status');
    					if($b_status=='0'){
    						echo 0;
    					}elseif ($b_status=='5'){
    						echo 0000;//停止投票
    					}else{
    						//同一个cookie_id只能投一票
    						$num=M('vote')->where(array('cookie_id'=>$value))->find();
    						if(!empty($num)){
    							echo 9;
    							return false;
    						}
    						//判断每个独立ip只能投1次
    						$ipnum=M('vote')->where(array('ipaddr'=>$data['ipaddr']))->find();
    						if(!empty($ipnum)){
    							echo 9;
    							return false;
    						}
    						if(M('vote')->add($data)){
    							//更新投票数据
    							$result=M("baoming")->lock(true)->where('id='.I('GET.p_id'))->setInc('count');
    							if($result){
    								echo 1;
    							}
    						}
    					}
    				}
    			}
    		}else{
    			echo '0';//投票未开启
    		}
    	}	
    }
    //图片上传
    public function serverimg(){
    	$img = isset($_POST['img'])? $_POST['img'] : '';
    	// 获取图片
    	list($type, $data) = explode(',', $img);
    	// 判断类型
    	if(strstr($type,'image/jpeg')!==''){
    		$ext = '.jpg';
    	}elseif(strstr($type,'image/gif')!==''){
    		$ext = '.gif';
    	}elseif(strstr($type,'image/png')!==''){
    		$ext = '.png';
    	}
    	// 生成的文件名
    	$photo = time().dechex(mt_rand(65536,1048575)).$ext;
	    if (!file_exists('Public/Uploads/'.date('Y-m-d',time()))){ 
	    	mkdir ('Public/Uploads/'.date('Y-m-d',time())); 
	    	// 生成文件
	    	file_put_contents("Public/Uploads/".date('Y-m-d',time()).'/'.$photo, base64_decode($data), true);
	    	// 返回
	    	header('content-type:application/json;charset=utf-8');
	    	//生成缩略图
	    	$file_path="./Public/Uploads/".date('Y-m-d',time()).'/'.$photo;
	    	$file_mini="./Public/Uploads/".date('Y-m-d',time()).'/'.'small_'.$photo;
	    	$images=new \Think\Image();
	    	$images->open($file_path);
	    	$images->thumb(150,150)->save($file_mini);

	    	$ret = array(
	    			'img'=>"/Public/Uploads/".date('Y-m-d',time()).'/small_'.$photo,
	    			'img_big'=>"/Public/Uploads/".date('Y-m-d',time()).'/'.$photo,
	    		);
	    	echo json_encode($ret);
	    	
	    	
	
	    }else{
	    	// 生成文件
	    	file_put_contents("Public/Uploads/".date('Y-m-d',time()).'/'.$photo, base64_decode($data), true);
	    	// 返回
	    	header('content-type:application/json;charset=utf-8');
	    	//生成缩略图
	    	$file_path="./Public/Uploads/".date('Y-m-d',time()).'/'.$photo;
	    	$file_mini="./Public/Uploads/".date('Y-m-d',time()).'/'.'small_'.$photo;
	    	$images=new \Think\Image();
	    	$images->open($file_path);
	    	$images->thumb(150,150)->save($file_mini);

	    	$ret = array(
	    			'img'=>"/Public/Uploads/".date('Y-m-d',time()).'/small_'.$photo,
	    			'img_big'=>"/Public/Uploads/".date('Y-m-d',time()).'/'.$photo,
	    		);
	    	echo json_encode($ret);
	    }
    	
    }
    //现场签到页面
    public function qiandao(){
    	if(IS_AJAX){
    		//判断签到时间段
    		if($this->siteinfo['sign_btime']>time()){
    			//签到还未开始
    			echo 'noopen';
    		}elseif($this->siteinfo['sign_etime']<time()){
    			//签到已结束
    			echo 'over';
    		}else{
    			//查询是否存在此人员 如果存在更新签到状态并返回前台座位号
    			$qdinfo=M('qdrenyuan')->where(array('qd_name'=>I('qd_name')))->find();
    			
    			if(empty($qdinfo)){
    				echo 0;
    			}else{
    				if(!empty($_COOKIE['qd_name'])){
    					if($_COOKIE['qd_name']==I('qd_name')){
    						echo '9_'.$qdinfo['qd_zuowei'];//已签到
    					}else{
    						echo '0000';//已签到
    					}
    			
    				}else{
    					if($qdinfo['qd_status']=='未签到'){
    						//更新状态
    						$data = array('qd_time'=>date('Y-m-d',time()),'qd_status'=>'已签到');
    						M('qdrenyuan')->where(array('qd_name'=>I('qd_name')))->setField($data);
    						//保存签到信息到本地 cookie
    						cookie('qd_name',I('qd_name'),360000);
    						cookie('qd_zuowei',$qdinfo['qd_zuowei'],360000);
    						echo '1_'.$qdinfo['qd_zuowei'];
    					}else{
    						echo '9_'.$qdinfo['qd_zuowei'];//已签到
    					}
    				}
    			}
    		}
    	}else{
    		$this->display();
    	}
    }

}
?>