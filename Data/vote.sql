# Host: 121.41.73.77  (Version: 5.6.21-log)
# Date: 2015-12-30 09:26:54
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "webster_baoming"
#

DROP TABLE IF EXISTS `webster_baoming`;
CREATE TABLE `webster_baoming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '姓名',
  `mynum` varchar(30) DEFAULT NULL COMMENT '号牌',
  `phone` varchar(11) DEFAULT '' COMMENT '手机号码',
  `touxiang` text COMMENT '头像',
  `touxiang_big` text COMMENT '大图像',
  `count` float(10,0) DEFAULT '0' COMMENT '当前票数',
  `usort` varchar(255) DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '0' COMMENT '状态 1 正常 0 未审核',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='报名表';

#
# Data for table "webster_baoming"
#

/*!40000 ALTER TABLE `webster_baoming` DISABLE KEYS */;
INSERT INTO `webster_baoming` VALUES (1,'西瓜测试','100861','17095135002','/Public/Uploads/2015-12-28/small_5680f89aedfdb.png',NULL,1,'0',1,'2015-12-28 16:42:41'),(2,'尉业来','0223','13223112365','/Public/Uploads/2015-12-28/small_1451309056.jpg',NULL,2,'0',1,'2015-12-28 21:24:22'),(3,'还有个','02235','13223156423','/Public/Uploads/2015-12-28/small_1451309222.jpg',NULL,1,'0',1,'2015-12-28 21:27:31'),(4,'风清扬','02253','1321568654','/Public/Uploads/2015-12-28/small_14513117121c470.jpg',NULL,0,'0',1,'2015-12-28 22:08:47'),(5,'高高高','030506','1596365258','/Public/Uploads/2015-12-28/small_14513123712a7f2.jpg',NULL,1,'0',1,'2015-12-28 22:20:02'),(6,'测试大图','1008611','17095135002','/Public/Uploads/2015-12-29/small_145139106296767.jpg',NULL,0,'0',1,'2015-12-29 20:11:05'),(7,'1223','1122','17095135002','/Public/Uploads/2015-12-29/small_1451391274ddd19.jpg',NULL,0,'0',1,'2015-12-29 20:15:45'),(8,'1222','1231321','232112','/Public/Uploads/2015-12-29/small_145139139010017.jpg','/Public/Uploads/2015-12-29/145139139010017.jpg',0,'0',1,'2015-12-29 20:16:40'),(9,'123333','1221111','2222222','/Public/Uploads/2015-12-29/small_1451395894ebd95.jpg','/Public/Uploads/2015-12-29/1451395894ebd95.jpg',0,'0',1,'2015-12-29 21:31:46');
/*!40000 ALTER TABLE `webster_baoming` ENABLE KEYS */;

#
# Structure for table "webster_qdrenyuan"
#

DROP TABLE IF EXISTS `webster_qdrenyuan`;
CREATE TABLE `webster_qdrenyuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qd_name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `qd_phone` varchar(14) DEFAULT NULL COMMENT '手机号码',
  `qd_zuowei` varchar(255) DEFAULT NULL COMMENT '座位号',
  `qd_gongsi` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `qd_invite` varchar(50) DEFAULT NULL COMMENT '邀请人',
  `qd_invitephone` varchar(14) DEFAULT NULL COMMENT '邀请人手机号码',
  `qd_time` varchar(255) DEFAULT '0' COMMENT '签到时间',
  `qd_status` varchar(50) DEFAULT '未签到' COMMENT '签到状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='签到人员信息管理';

#
# Data for table "webster_qdrenyuan"
#

/*!40000 ALTER TABLE `webster_qdrenyuan` DISABLE KEYS */;
INSERT INTO `webster_qdrenyuan` VALUES (1,'张三','13233223322','1排3座','','邹冯','18778782233','2015-12-29','已签到'),(2,'李四','13233223322','2排3座','','米雪','18778782233','0','未签到'),(3,'王苏','13233223322','3排3座','','曾二','18778782233','0','未签到'),(4,'冯清','13233223322','4排3座','','曾二','18778782233','0','未签到');
/*!40000 ALTER TABLE `webster_qdrenyuan` ENABLE KEYS */;

#
# Structure for table "webster_setscreen"
#

DROP TABLE IF EXISTS `webster_setscreen`;
CREATE TABLE `webster_setscreen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `screen_logo` text COMMENT '大屏logo',
  `screen_music` text COMMENT '音乐外链',
  `screen_video` text COMMENT '视频外链',
  `is_music` int(11) DEFAULT NULL COMMENT '是否开启音乐',
  `is_video` int(11) DEFAULT NULL COMMENT '是否开启视频',
  `is_screen` int(11) DEFAULT NULL COMMENT '是否开启大屏',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='大屏设置';

#
# Data for table "webster_setscreen"
#

/*!40000 ALTER TABLE `webster_setscreen` DISABLE KEYS */;
INSERT INTO `webster_setscreen` VALUES (1,'/Public/Uploads/2015-12-28/56812c499f122.png','http://mp3.haoduoge.com/music7/153159.mp3','http://player.youku.com/embed/XMjY3MzgzODg0',1,1,1,'2015-12-28 20:37:17');
/*!40000 ALTER TABLE `webster_setscreen` ENABLE KEYS */;

#
# Structure for table "webster_siteinfo"
#

DROP TABLE IF EXISTS `webster_siteinfo`;
CREATE TABLE `webster_siteinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(255) DEFAULT NULL COMMENT '网站名称',
  `siteurl` text COMMENT '网站网址',
  `sitelogo` text COMMENT '网站logo',
  `sitedesc` text COMMENT '网站描述',
  `sitekeywords` text COMMENT '网站关键词',
  `siteicp` varchar(255) DEFAULT NULL COMMENT '网站备案号码',
  `sitecode` text COMMENT '网站统计代码',
  `sitestatus` int(11) DEFAULT NULL COMMENT '网站状态',
  `statusdesc` text COMMENT '网站关闭原因',
  `active_info` text NOT NULL COMMENT '活动介绍',
  `vip_info` text NOT NULL COMMENT '奖品设置',
  `rule_info` text NOT NULL COMMENT '活动规则',
  `vote_rule` text NOT NULL COMMENT '投票规则',
  `vote_status` int(11) NOT NULL DEFAULT '0' COMMENT '是否开启投票',
  `gs_title` varchar(255) DEFAULT NULL COMMENT '公示标题',
  `gs_content` text COMMENT '公示内容',
  `gs_status` varchar(255) NOT NULL DEFAULT '0' COMMENT '是否开启公示',
  `vote_btime` int(11) DEFAULT NULL COMMENT '投票开始时间',
  `vote_etime` int(11) DEFAULT NULL COMMENT '投票结束时间',
  `sign_btime` int(11) DEFAULT NULL COMMENT '签到开始时间',
  `sign_etime` int(11) DEFAULT NULL COMMENT '签到结束时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='网站基本信息表';

#
# Data for table "webster_siteinfo"
#

/*!40000 ALTER TABLE `webster_siteinfo` DISABLE KEYS */;
INSERT INTO `webster_siteinfo` VALUES (1,'年会投票','toupiao.580bang.com','/Public/Uploads/2015-12-28/56812c5f7b38d.png','年会投票','年会投票','苏ICP备14010218号','',1,'为了能让您访问更快更稳定，同时为您提供更高品质的服务，我们正在维护系统。因此目前网站的部分功能不能使用，请稍后再回来。给您造成了不便，请谅解!','年会投票','年会投票','年会投票','&lt;p&gt;\r\n\t&lt;span style=&quot;line-height:2;font-size:14px;&quot;&gt;1、投票时间：2015年10月15日0:00~2015年10月24日24:00&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;line-height:2;font-size:14px;&quot;&gt; 2、每位用户每天可以投5票，但是每天只能给同一作品投1票。&lt;/span&gt;&lt;br /&gt;\r\n&lt;span style=&quot;line-height:2;font-size:14px;&quot;&gt; 3、我们会对活动投票全程监控，如发现非正常投票及刷票行为，将取消投票者所有票数，情节严重者，将取消相关参赛者的参赛资格。&lt;/span&gt; \r\n&lt;/p&gt;',1,'','&lt;p style=&quot;text-align:justify;text-indent:20pt;margin-left:0pt;&quot; class=&quot;MsoNormal&quot;&gt;\r\n\t&lt;br /&gt;\r\n&lt;/p&gt;','1',1451025144,1451543544,1451347200,1451520000);
/*!40000 ALTER TABLE `webster_siteinfo` ENABLE KEYS */;

#
# Structure for table "webster_user"
#

DROP TABLE IF EXISTS `webster_user`;
CREATE TABLE `webster_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1:启用 0:禁止',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `last_login_time` int(11) unsigned NOT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `login_time` int(11) unsigned NOT NULL COMMENT '最后登录时间',
  `login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '登录IP',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "webster_user"
#

/*!40000 ALTER TABLE `webster_user` DISABLE KEYS */;
INSERT INTO `webster_user` VALUES (1,'Webster','5c2a8d4350404a979d655cff223d3d4e',1,'123',1451402542,'0.0.0.0',1451403760,'0.0.0.0'),(2,'admin','434d711276d2ed2068e7a02499fac15c',1,'',1451361051,'202.102.85.22',1451376645,'202.102.85.17'),(3,'admin2','da85aa58d4f1f0d842dd5fe5e3e9d7dd',1,'',1451353473,'202.102.85.17',1451367049,'125.88.189.17');
/*!40000 ALTER TABLE `webster_user` ENABLE KEYS */;

#
# Structure for table "webster_vote"
#

DROP TABLE IF EXISTS `webster_vote`;
CREATE TABLE `webster_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL COMMENT '微信是openid，电脑是cookie',
  `ipaddr` varchar(255) DEFAULT NULL COMMENT '投票的ip地址',
  `b_id` int(11) DEFAULT NULL COMMENT '报名对象对应的id',
  `time` int(11) DEFAULT NULL COMMENT '投票时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='投票记录表';

#
# Data for table "webster_vote"
#

/*!40000 ALTER TABLE `webster_vote` DISABLE KEYS */;
INSERT INTO `webster_vote` VALUES (1,'b70268afe34c0c00a1d7ab3fea68137b','222.73.144.31',2,1451312217),(2,'c92b9116d91d0e5737675c9d2e2eb29d','120.52.18.54',2,1451312320),(3,'39178a39b4085cf908777e4292abc11b','202.102.85.22',3,1451312879),(4,'b3db8e62b905ce384bbe0f762ba44a58','202.102.85.16',1,1451314465),(5,'be2546401e9f0cb638bfbdacbaf6dd4b','222.73.144.27',5,1451377332);
/*!40000 ALTER TABLE `webster_vote` ENABLE KEYS */;
