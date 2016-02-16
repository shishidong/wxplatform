<?php
// +----------------------------------------------------------------------
// | 设计开发：Webster  Tel:17095135002 邮箱：chenwei@js789.com.cn
// +----------------------------------------------------------------------
namespace Admin\Controller;

use Home\Controller\PublicController;
class SystemController extends CommonController {
	public function index(){
		$info = array(
				'操作系统'=>PHP_OS,
				'运行环境'=>$_SERVER["SERVER_SOFTWARE"],
				'PHP运行方式'=>php_sapi_name(),
				'内核版本'=>THINK_VERSION,
				'上传附件限制'=>ini_get('upload_max_filesize'),
				'执行时间限制'=>ini_get('max_execution_time').'秒',
				'服务器时间'=>date("Y年n月j日 H:i:s"),
				'北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
				'服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
				'服务器总剩余空间'=>round((disk_free_space(".")/(1024*1024)),2).'M',
				'产品设计与研发'=>'Webster（西瓜）',
		);
		$this->assign('info',$info);
		$this->display();
	}
    public function main(){
        $this->display();
    }
    //网站配置页
    public function setsite(){
    	$this->display();
    }
    //网站配置更新操作
    public function setsitedo(){
    	if(IS_POST){
    		$upload = new \Think\Upload();// 实例化上传类
    		$upload->maxSize   =     3145728 ;// 设置附件上传大小
    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    		$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    		// 上传单个文件
    		$info   =   $upload->uploadOne($_FILES['sitelogo']);
    		if(!$info) {// 上传错误提示错误信息
    			$data['sitename']=I('POST.sitename');
    			$data['siteurl']=I('POST.siteurl');
    			$data['sitedesc']=I('POST.sitedesc');
    			$data['sitekeywords']=I('POST.sitekeywords');
    			$data['active_info']=I('POST.active_info');
    			$data['vip_info']=I('POST.vip_info');
    			$data['rule_info']=I('POST.rule_info');
    			
    			$data['vote_rule']=I('POST.vote_rule');
    			$data['vote_status']=I('POST.vote_status');
    			$data['vote_btime']=strtotime(I('POST.vote_btime'));
    			$data['vote_etime']=strtotime(I('POST.vote_etime'));
    			$data['sign_btime']=strtotime(I('POST.sign_btime'));
    			$data['sign_etime']=strtotime(I('POST.sign_etime'));
    			$data['gs_title']=I('POST.gs_title');
    			$data['gs_content']=I('POST.gs_content');
    			$data['gs_status']=I('POST.gs_status');
    			
    			$data['siteicp']=I('POST.siteicp');
    			$data['sitecode']=I('POST.sitecode');
    			$data['sitestatus']=I('POST.sitestatus');
    			$data['statusdesc']=I('POST.statusdesc');
    			 
    			if(M('siteinfo')->where('id=1')->save($data)){
    				$this->success('保存成功！');
    			}else{
    				$this->error('未修改任何内容！');
    			}
    		}else{// 上传成功 获取上传文件信息
    			$sitelogo='/Public/Uploads/'.$info['savepath'].$info['savename'];
    			$data['sitename']=I('POST.sitename');
    			$data['siteurl']=I('POST.siteurl');
    			$data['sitelogo']=$sitelogo;
    			$data['sitedesc']=I('POST.sitedesc');
    			$data['sitekeywords']=I('POST.sitekeywords');
    			$data['active_info']=I('POST.active_info');
    			$data['vip_info']=I('POST.vip_info');
    			$data['rule_info']=I('POST.rule_info');
    			
    			$data['vote_rule']=I('POST.vote_rule');
    			$data['vote_status']=I('POST.vote_status');
    			$data['vote_btime']=strtotime(I('POST.vote_btime'));
    			$data['vote_etime']=strtotime(I('POST.vote_etime'));
    			$data['sign_btime']=strtotime(I('POST.sign_btime'));
    			$data['sign_etime']=strtotime(I('POST.sign_etime'));
    			$data['gs_title']=I('POST.gs_title');
    			$data['gs_content']=I('POST.gs_content');
    			$data['gs_status']=I('POST.gs_status');
    			
    			$data['siteicp']=I('POST.siteicp');
    			$data['sitecode']=I('POST.sitecode');
    			$data['sitestatus']=I('POST.sitestatus');
    			$data['statusdesc']=I('POST.statusdesc');
    		
    			if(M('siteinfo')->where('id=1')->save($data)){
    				$this->success('保存成功！');
    			}else{
    				$this->error('未修改任何内容！');
    			}
    		}
    	}
    }
    
    //添加管理员
    public function adduserdo(){
    	if(IS_POST){
    		//验证用户名规则 字母和数字集合 且字母开头
    		if(preg_match('/^[0-9a-zA-Z]+$/',I('POST.username'))){
    			if(preg_match('/^[0-9a-zA-Z]+$/',I('POST.password'))){
    				$username=I('POST.username');
    				$password=I('POST.password');
    				$status=I('POST.status');
    				$remark=I('POST.remark');
    				 
    				if(empty($username)||empty($password)){
    					$this->error("账户和密码必须！");
    				}else{
    					//验证用户名是否存在
    					$list=M('user')->where(array('username'=>I('POST.username')))->find();
    					if(empty($list)){
    						$data['username']=I('POST.username');
    						$data['password']=MD5(I('POST.password'));
    						$data['status']=I('POST.status');
    						$data['remark']=I('POST.remark');
    						$data['role']='1';//此版本不支持权限控制
    						if(M("user")->add($data)){
    							$this->success("添加成功！");
    						}else{
    							$this->error("添加失败！");
    						}
    					}else{
    						$this->error("该用户已存在！");
    					}
    				}
    			}else{
    				$this->error("密码格式不合法！");
    			}
    		}else{
    			$this->error("登录名不合法！");
    		}
    	}else{
    		$this->error("非法表单！");
    	}
    }
    //管理员列表
    public function userlist(){
    	//查询出所有票券
    	$User = M('user'); // 实例化User对象
    	$count      = $User->where('id>1')->count();// 查询满足要求的总记录数
    	$Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show       = $Page->show();// 分页显示输出
    	// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$list = $User->where('id>1')->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('list',$list);// 赋值数据集
    	$this->assign('page',$show);// 赋值分页输出
    	$this->display(); // 输出模板
    }
    //编辑用户
    public function edituser(){
    	$id=I('GET.id');
    	if(empty($id)){
    		$this->error('非法请求！');
    	}else{
    		$this->user=M('user')->where(array('id'=>$id))->find();
    		$this->display();
    	}
    }
    //编辑用户操作
    public function edituserdo(){
    	if(IS_POST){
    		$id=I('POST.id');
    		$password=I('POST.password');
    		$status=I('POST.status');
    		$remark=I('POST.remark');
    		//如果为空更新排除密码字段外的所有
    		if(empty($password)){
    			$data['status']=I('POST.status');
    			$data['remark']=I('POST.remark');
    			if(M('user')->where(array('id'=>I('POST.id')))->save($data)){
    				$this->success('更新成功！');
    			}else{
    				$this->error('更新失败！');
    			}
    		}else{
    			if(preg_match('/^[0-9a-zA-Z]+$/',I('POST.password'))){
    				$data['password']=MD5(I('POST.password'));
    				$data['status']=I('POST.status');
    				$data['remark']=I('POST.remark');
    				if(M('user')->where(array('id'=>I('POST.id')))->save($data)){
    					$this->success('更新成功！');
    				}else{
    					$this->error('更新失败！');
    				}
    			}else{
    				$this->error("密码格式不合法！");
    			}
    		}	
    	}else{
    		$this->error("非法表单！");
    	}
    }
    //批量删除用户
    public function deluser(){
    	if(IS_AJAX){
    		$ids=I('POST.ids');
    		//拆分字符串
    		$arr = explode(",", $ids);
    		for($i=0; $i< count($arr); $i++) {
    			$result=M('user')->where(array('id'=>$arr[$i]))->delete();
    		}
    		//返回成功码
    		echo 'success';
    	}else{
    		$this->error("非法请求！");
    	}
    }
    public function addvote(){
    	if(IS_POST){
    		$upload = new \Think\Upload();// 实例化上传类
    		$upload->maxSize   =     3145728 ;// 设置附件上传大小
    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    		$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    		// 上传单个文件
    		$info   =   $upload->uploadOne($_FILES['touxiang']);
    		if(!$info) {// 上传错误提示错误信息
    			$this->error($upload->getError());
    		}else{
    			$rules = array(
    					array('name','require','姓名必须！'),
    					array('mynum','require','号牌必须！'),
    					array('phone','require','手机号码必须！'),
    					array('mynum','','请勿重复添加！',0,'unique',1),
    			);
    			
    			if (!M('baoming')->validate($rules)->create()){
    				$this->error(M('baoming')->getError());
    			}else{
	    			//生成缩略图
	    			$file_path='./Public/Uploads/'.$info['savepath'].$info['savename'];
	    			$file_mini='./Public/Uploads/'.$info['savepath'].'small_'.$info['savename'];
	    			$images=new \Think\Image();
	    			$images->open($file_path);
	    			$images->thumb(150,150)->save($file_mini);
	    			$touxiang='/Public/Uploads/'.$info['savepath'].'small_'.$info['savename'];
	    			$data['name']=I('name');
	    			$data['mynum']=I('mynum');
	    			$data['phone']=I('phone');
	    			$data['status']='1';
	    			$data['touxiang']=$touxiang;
	    			if(M('baoming')->add($data)){
	    				$this->success('添加成功！');
	    			}else{
	    				$this->error('报名失败！');
	    			}
    			}
    		}
    	}else{
    		$this->display();
    	}
    }
    //投票列表
    public function votelist(){
    	//查询出所有票券
    	$Product = M('baoming'); // 实例化User对象
    	$count      = $Product->count();// 查询满足要求的总记录数
    	$Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show       = $Page->show();// 分页显示输出
    	// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$list = $Product->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
    	$this->assign('list',$list);// 赋值数据集
    	$this->assign('page',$show);// 赋值分页输出
    	$this->display(); // 输出模板
    }
    public function editVotesort(){
    	foreach($_POST as $k=>$v){
    		$k = str_replace('usort','',$k);
    		$data[$k]=$v;
    		M('baoming')->where(array('id'=>$k))->setField('usort',$v);
    	}
    	$this->success('保存成功');
    }
    //批量删除投票
    public function delvotes(){
    	if(IS_AJAX){
    		$ids=I('POST.ids');
    		//拆分字符串
    		$arr = explode(",", $ids);
    		for($i=0; $i< count($arr); $i++) {
    			$result=M('baoming')->where(array('id'=>$arr[$i]))->delete();
    			$result=M('vote')->where(array('b_id'=>$arr[$i]))->delete();
    		}
    		//返回成功码
    		echo 'success';
    	}else{
    		$this->error("非法请求！");
    	}
    }
    //批量审核投票
    public function checkvotes(){
    	if(IS_AJAX){
    		$ids=I('POST.ids');
    		//拆分字符串
    		$arr = explode(",", $ids);
    		for($i=0; $i< count($arr); $i++) {
    			$result=M('baoming')->where(array('id'=>$arr[$i]))->setField('status','1');
    		}
    		//返回成功码
    		echo 'success';
    	}else{
    		$this->error("非法请求！");
    	}
    }
    //投票编辑
    public function editvote(){
    	if(IS_POST){
    		$upload = new \Think\Upload();// 实例化上传类
    		$upload->maxSize   =     3145728 ;// 设置附件上传大小
    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    		$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    		// 上传单个文件
    		$info   =   $upload->uploadOne($_FILES['touxiang']);
    		if(!$info) {// 上传错误提示错误信息
    			$rules = array(
    					array('name','require','姓名必须！'),
    					array('mynum','require','号牌必须！'),
    					array('phone','require','手机号码必须！'),
    			);
    			
    			if (!M('baoming')->validate($rules)->create()){
    				$this->error(M('baoming')->getError());
    			}else{
    				$data['id']=I('id');
    				$data['name']=I('name');
    				$data['mynum']=I('mynum');
    				$data['phone']=I('phone');
    				$data['status']=I('status');
    				if(M('baoming')->save($data)){
    					$this->success('编辑成功！');
    				}else{
    					$this->error('编辑失败！');
    				}
    			}
    		}else{
    			$rules = array(
    					array('name','require','姓名必须！'),
    					array('mynum','require','号牌必须！'),
    					array('phone','require','手机号码必须！'),
    			);
    			 
    			if (!M('baoming')->validate($rules)->create()){
    				$this->error(M('baoming')->getError());
    			}else{
    				//生成缩略图
	    			$file_path='./Public/Uploads/'.$info['savepath'].$info['savename'];
	    			$file_mini='./Public/Uploads/'.$info['savepath'].'small_'.$info['savename'];
	    			$images=new \Think\Image();
	    			$images->open($file_path);
	    			$images->thumb(150,150)->save($file_mini);
	    			$touxiang='/Public/Uploads/'.$info['savepath'].'small_'.$info['savename'];
    				$data['id']=I('id');
    				$data['name']=I('name');
    				$data['mynum']=I('mynum');
    				$data['phone']=I('phone');
    				$data['status']=I('status');
    				$data['touxiang']=$touxiang;
    				if(M('baoming')->save($data)){
    					$this->success('编辑成功！');
    				}else{
    					$this->error('编辑失败！');
    				}
    			}
    		}
    	}else{
    		$this->vote=M('baoming')->where(array('id'=>I('GET.id')))->find();
    		$this->display();
    	}
    }
    //投票列表
    public function whovote(){
    	if(IS_GET){
    		$id=I('GET.id');
    		$list=M('vote')->order('time desc')->where(array('b_id'=>$id))->select();
    		$this->assign('list',$list);
    		$this->display();
    	}
    }
    //大屏幕
    public function screen(){
    	//获取报名表信息
    	$baoming=M('baoming')->where(array('status'=>'1'))->order('count desc')->select();
    	//计算总票数
    	$this->znum=M('baoming')->where(array('status'=>'1'))->sum('count');
    	//大屏设置
    	$this->screen=M('setscreen')->where(array('id'=>'1'))->find();
    	$this->assign('baoming',$baoming);
    	if($this->screen['is_screen']=='1'){
    		$this->display();
    	}else{
    		$this->error('请先开启大屏幕！',U('System/main'));
    	}
    	
    }
    //大屏幕动态请求
    public function ajaxscreen(){
    	//获取报名表信息
    	$baoming=M('baoming')->where(array('status'=>'1'))->order('count desc')->select();
    	//计算总票数
    	$this->znum=M('baoming')->where(array('status'=>'1'))->sum('count');
    	//组装字段给前台
    	$string='';
    	for($i=0;$i<count($baoming);$i++){
    		$string=$string.'
    				<tr style="width:100%">
		<td style="width:35px;line-height:35px;"><img style="width:35px;height:35px;" src="'.$baoming[$i][touxiang].'"></td>
		<td style="width:1245px">
    				<div class="skillbar clearfix " data-percent="'.round($baoming[$i][count]/$this->znum*100,2).'%">
	<div class="skillbar-title"><span>'.$baoming[$i][name].'（'.$baoming[$i][count].'票）</span></div>
	<div class="skillbar-bar" style="background: #'.substr(strtok(substr(strrchr($baoming[$i][touxiang],"/"),1), '.'),-6).';"></div>
	<div class="skill-bar-percent">'.round($baoming[$i][count]/$this->znum*100,2).'%</div>
</div></td>
	</tr>
    				';
    	}
    	echo $string;
    }
    //大屏设置
    public function setscreen(){
    	if(IS_POST){
    		$upload = new \Think\Upload();// 实例化上传类
    		$upload->maxSize   =     3145728 ;// 设置附件上传大小
    		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    		$upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
    		// 上传单个文件
    		$info   =   $upload->uploadOne($_FILES['screen_logo']);
    		if(!$info) {// 上传错误提示错误信息
    			$data['screen_music']=I('screen_music');
    			$data['screen_video']=I('screen_video');
    			$data['is_music']=I('is_music');
    			$data['is_video']=I('is_video');
    			$data['is_screen']=I('is_screen');
    			$data['time']=date('Y-m-d H:i:s',time());
    			if(M('setscreen')->where('id=1')->save($data)){
    				$this->success('保存成功！');
    			}else{
    				$this->error('保存失败！');
    			}
    		}else{
    			$screenlogo='/Public/Uploads/'.$info['savepath'].$info['savename'];
    			$data['screen_logo']=$screenlogo;
    			$data['screen_music']=I('screen_music');
    			$data['screen_video']=I('screen_video');
    			$data['is_music']=I('is_music');
    			$data['is_video']=I('is_video');
    			$data['is_screen']=I('is_screen');
    			$data['time']=date('Y-m-d H:i:s',time());
    			if(M('setscreen')->where('id=1')->save($data)){
    				$this->success('保存成功！');
    			}else{
    				$this->error('保存失败！');
    			}
    		}
    	}else{
    		$this->screen=M('setscreen')->where(array('id'=>'1'))->find();
    		$this->display();
    	}
    }
    //签到设置
    public function signinlist(){
    	//查询出所有票券
    	$Qdrenyuan = M('qdrenyuan'); // 实例化User对象
    	$count      = $Qdrenyuan->count();// 查询满足要求的总记录数
    	$Page       = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
    	$show       = $Page->show();// 分页显示输出
    	// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$list = $Qdrenyuan->limit($Page->firstRow.','.$Page->listRows)->order('id')->select();
    	$this->assign('list',$list);// 赋值数据集
    	$this->assign('page',$show);// 赋值分页输出
    	$this->display(); // 输出模板
    }
    //上传excel到服务器并且写入到数据库
    public function importexcel(){
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize   =     3145728 ;// 设置附件上传大小
    	$upload->exts      =     array('xls', 'xlsx');// 设置附件上传类型
    	$upload->rootPath  =      './Public/Uploads/Excel/'; // 设置附件上传根目录
    	// 上传单个文件
    	$info   =   $upload->uploadOne($_FILES['exceltpl']);
    	if(!$info) {// 上传错误提示错误信息
    		$this->error($upload->getError());
    	}else{// 上传成功 获取上传文件信息
    		$filename = "./Public/Uploads/Excel/".$info['savepath'].$info['savename'];
    		//echo ("<script>parent.callback1('$filesrc')</script>");
    		$ExcelToArrary=new ExcelToArrary();//实例化
    		$res=$ExcelToArrary->read($filename,"UTF-8",$info['ext']);//传参,判断office2007还是office2003 
    			
    		foreach ( $res as $k => $v ) //循环excel表
    		{
    			$k=$k-2;//addAll方法要求数组必须有0索引
    			$data[$k]['qd_name'] = $v [0];//注意 因为比前台取这个唯一标识 导入模板中的id行 应该有区分 否则会出错
    			$data[$k]['qd_phone'] = $v [1];//创建二维数组
    			$data[$k]['qd_zuowei'] = $v [2];
    			$data[$k]['qd_gongsi'] = $v [3];
    			$data[$k]['qd_invite'] = $v [4];
    			$data[$k]['qd_invitephone'] = $v [5];
    		}
    		//存入数据库
    		$result=M('qdrenyuan')->addAll($data);
    		if(!$result)
    		{
    			$this->error('导入数据库失败');
    			exit();
    		}else{
    			$this->success('导入数据成功！');
    		}
    	}
    }
    //批量删除签到人员
    public function delqiandao(){
    	if(IS_AJAX){
    		$ids=I('POST.ids');
    		//拆分字符串
    		$arr = explode(",", $ids);
    		for($i=0; $i< count($arr); $i++) {
    			$result=M('qdrenyuan')->where(array('id'=>$arr[$i]))->delete();
    		}
    		//返回成功码
    		echo 'success';
    	}else{
    		$this->error("非法请求！");
    	}
    }
    //导出签到人员为txt
    public function outtxt(){
    	$ua = $_SERVER["HTTP_USER_AGENT"];
    	$filename = "抽奖名单.txt";
    	$encoded_filename = urlencode($filename);
    	$encoded_filename = str_replace("+", "%20", $encoded_filename);
    	header("Content-Type: application/octet-stream");
    	if (preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT']) ) {
    		header('Content-Disposition:  attachment; filename="' . $encoded_filename . '"');
    	} elseif (preg_match("/Firefox/", $_SERVER['HTTP_USER_AGENT'])) {
    		header('Content-Disposition: attachment; filename*="utf8' .  $filename . '"');
    	} else {
    		header('Content-Disposition: attachment; filename="' .  $filename . '"');
    	}
    	//读取已签到的列表
    	$list=M('qdrenyuan')->where(array('qd_status'=>'已签到'))->select();
    	//循环输出到txt
    	for($i=0;$i<count($list);$i++){
    		echo $list[$i]['qd_name'].' '.substr_replace($list[$i]['qd_phone'],'****',3,4)."\r\n";
    	}
    }
}


/* Excel数组转换类 */
class ExcelToArrary {
	public function __construct() {
		Vendor('Excel.PHPExcel.PHPExcel');//引入phpexcel类(注意你自己的路径)
		Vendor("Excel.PHPExcel.PHPExcel.IOFactory");
	}
	public function read($filename,$encode,$file_type){
		if(strtolower ( $file_type )=='xls')//判断excel表类型为2003还是2007
		{
			Vendor("Excel.PHPExcel.PHPExcel.Reader.Excel5");
			$objReader = \PHPExcel_IOFactory::createReader('Excel5');
		}elseif(strtolower ( $file_type )=='xlsx')
		{
			Vendor("Excel.PHPExcel.PHPExcel.Reader.Excel2007");
			$objReader = \PHPExcel_IOFactory::createReader('Excel2007');
		}
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($filename);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$highestRow = $objWorksheet->getHighestRow();
		$highestColumn = $objWorksheet->getHighestColumn();
		$highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
		$excelData = array();
		for ($row = 2; $row <= $highestRow; $row++) {
			for ($col = 0; $col < $highestColumnIndex; $col++) {
				$excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
			}
		}
		return $excelData;
	}
}