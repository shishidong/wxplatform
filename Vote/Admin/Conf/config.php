<?php
return array(
	//'配置项'=>'配置值'
		//模板配置
		'TMPL_PARSE_STRING'  =>array(
				'__ROOT__' => 'http://'.$_SERVER['SERVER_NAME'], // 更改默认的/Public 替换规则
				'__PUBLIC__' => 'http://'.$_SERVER['SERVER_NAME'].'/Public',
				'__CSS__'    => 'http://'.$_SERVER['SERVER_NAME'].'/Public/Admin/Css',
				'__JS__'     => 'http://'.$_SERVER['SERVER_NAME'].'/Public/Admin/Js', // 增加新的JS类库路径替换规则
				'__EDITOR__'     => 'http://'.$_SERVER['SERVER_NAME'].'/Public/Kindeditor',
				'__IMAGES__' => 'http://'.$_SERVER['SERVER_NAME'].'/Public/Admin/Images', // 增加新的上传路径替换规则
				'__LAYER__'     => 'http://'.$_SERVER['SERVER_NAME'].'/Public/Layer',
		),
		'TMPL_FILE_DEPR'=>'_',
);