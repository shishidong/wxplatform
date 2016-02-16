<?php
// +----------------------------------------------------------------------
// | 设计开发：Webster  Tel:17095135002 邮箱：chenwei@js789.com.cn
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\MySQLReback;

class BaksqlController extends CommonController {
	protected function _initialize(){
		$DataDir = "Data/";
		mkdir($DataDir);
		$config = array(
				'host' => C('DB_HOST'),
				'port' => C('DB_PORT'),
				'userName' => C('DB_USER'),
				'userPassword' => C('DB_PWD'),
				'dbprefix' => C('DB_PREFIX'),
				'charset' => 'UTF8',
				'path' => $DataDir,
				'isCompress' => 1, //是否开启gzip压缩
				'isDownload' => 0
		);
		$this->mr = new MySQLReback($config);
		$this->mr->setDBName(C('DB_NAME'));
	}
	
    public function index() {
        $lists = $this->MyScandir('Data/');
        $this->assign("datadir","Data/");
        $this->assign("lists", $lists);
        $this->display();
    }
	//备份数据库操作
	public function backup(){
		$this->mr->backup();
		$this->success( '数据库备份成功！');
	}
    //还原数据库操作
    public function restore(){
    	$this->mr->recover($_GET['File']);
    	$this->success( '数据库还原成功！');
    }
    //数据库删除操作
    public function delbak(){
    	if (@unlink("Data/" . $_GET['File'])) {
    		$this->success('删除成功！');
    	} else {
    		$this->error('删除失败！');
    	}
    }
    //数据库下载操作
    public function downbak(){
    	function DownloadFile($fileName) {
    		ob_end_clean();
    		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    		header('Content-Description: File Transfer');
    		header('Content-Type: application/octet-stream');
    		header('Content-Length: ' . filesize($fileName));
    		header('Content-Disposition: attachment; filename=' . basename($fileName));
    		readfile($fileName);
    	}
    	DownloadFile("Data/" . $_GET['file']);
    	exit();
    }
    
    private function MyScandir($FilePath = './', $Order = 0) {
        $FilePath = opendir($FilePath);
        while (false !== ($filename = readdir($FilePath))) {
            $FileAndFolderAyy[] = $filename;
        }
        $Order == 0 ? sort($FileAndFolderAyy) : rsort($FileAndFolderAyy);
        return $FileAndFolderAyy;
    }
}