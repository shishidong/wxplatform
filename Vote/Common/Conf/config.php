<?php
// +----------------------------------------------------------------------
// | 设计开发：Webster  Tel:17095135002 邮箱：master@580bang.com
// +----------------------------------------------------------------------
return array(
	//'配置项'=>'配置值'
		//数据库配置信息
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'vote', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => 'root', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => 'webster_', // 数据库表前缀
		'DB_CHARSET'=> 'utf8', // 字符集
		'DB_DEBUG'  =>  false, // 数据库调试模式
		//查询解析缓存
		'DB_SQL_BUILD_CACHE' => true,
		'DB_SQL_BUILD_LENGTH' => 20,
		//公众号配置
		'WX_APPID'=>'',//AppID(应用ID)
		'WX_SECRET'=>'',//AppSecret(应用密钥)

);