# Host: localhost  (Version: 5.5.53)
# Date: 2018-07-04 23:49:30
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "module"
#

DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '模块名称',
  `url_template` varchar(256) NOT NULL DEFAULT '' COMMENT '访问url',
  `icon_tag` varchar(30) NOT NULL DEFAULT '' COMMENT '生成图标用',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上一级id',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8 COMMENT='模块';

#
# Data for table "module"
#

INSERT INTO `module` VALUES (100,'demo','/web/demo','th',0,'2018-07-02 20:00:00'),(101,'列表和多标签展示','/web/demo/tab','th-list',100,'2018-07-02 20:00:00'),(102,'表单展示','/web/demo/form','inbox',100,'2018-07-02 20:00:00'),(200,'管理','/web/manage','window',0,'2018-07-02 20:00:00'),(201,'模块管理','/web/manage/module','scale',200,'2018-07-02 20:00:00'),(202,'权限管理','/web/manage/permission','cog',200,'2018-07-02 20:00:00'),(203,'用户管理','/web/manage/user','user',200,'2018-07-02 20:00:00');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '''''',
  `name` varchar(50) NOT NULL DEFAULT '''''' COMMENT '名称',
  `pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `scope_ids` tinytext COMMENT '权限id列表',
  `roles` tinytext COMMENT '角色',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'xqdwjk216@gmail.com','gavin','123123','100,101,102,200,201,202,203','admin','1970-01-01 00:00:00');

#
# Structure for table "user_role"
#

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL DEFAULT '''''' COMMENT '角色名称',
  `scope_module_ids` tinytext NOT NULL COMMENT '可访问的模块列表',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色字典表';

#
# Data for table "user_role"
#

