<?php
// +----------------------------------------------------------------------
// | 设计开发：Webster  Tel:17095135002 邮箱：master@580bang.com
// +----------------------------------------------------------------------
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
//绑定模块到当前目录
define('BIND_MODULE','Admin');
//定义缓存目录
define('RUNTIME_PATH','./Temp/');
// 定义应用目录
define('APP_PATH','./Vote/');
// 引入ThinkPHP入口文件
require './Core/Core.php';
// 这里是入口文件，一般不需要修改