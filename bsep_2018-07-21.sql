# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.31.242 (MySQL 5.5.56-MariaDB)
# Database: bsep
# Generation Time: 2018-07-21 03:56:23 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table module
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '模块名称',
  `url_template` varchar(256) NOT NULL DEFAULT '' COMMENT '访问url',
  `icon_tag` varchar(30) NOT NULL DEFAULT '' COMMENT '生成图标用',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上一级id',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块';

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;

INSERT INTO `module` (`id`, `name`, `url_template`, `icon_tag`, `parent_id`, `create_time`)
VALUES
	(100,'Dashboard','/web','th',0,'2018-07-02 20:00:00'),
	(101,'列表和多标签展示','/m:web/v:demo-tab','th-list',100,'2018-07-02 20:00:00'),
	(102,'表单展示','/m:web/v:demo-form','inbox',100,'2018-07-02 20:00:00'),
	(103,'模态框','/m:web/v:demo-modal','heart',100,'1970-01-01 00:00:00'),
	(104,'模态框(静态)','/m:web/v:demo-modal-static','leaf',100,'1970-01-01 00:00:00'),
	(200,'管理','/web','window',0,'2018-07-02 20:00:00'),
	(201,'模块管理','/m:web/v:module-list','scale',200,'2018-07-02 20:00:00'),
	(202,'权限管理','/m:web/v:scope-list','cog',200,'2018-07-02 20:00:00'),
	(203,'用户管理','/m:web/v:user-list','user',200,'2018-07-02 20:00:00');

/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table test_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `test_page`;

CREATE TABLE `test_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '模块名称',
  `url_template` varchar(256) NOT NULL DEFAULT '' COMMENT '访问url',
  `icon_tag` varchar(30) NOT NULL DEFAULT '' COMMENT '生成图标用',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上一级id',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块';

LOCK TABLES `test_page` WRITE;
/*!40000 ALTER TABLE `test_page` DISABLE KEYS */;

INSERT INTO `test_page` (`id`, `name`, `url_template`, `icon_tag`, `parent_id`, `create_time`)
VALUES
	(100,'菜单','/m:web/v:tpl-menu','th',0,'2018-07-02 20:00:00'),
	(101,'列表和多标签展示','/m:web/v:demo-tab','th-list',100,'2018-07-02 20:00:00'),
	(102,'表单展示(登录页)','/m:web/v:user-login','inbox',100,'2018-07-02 20:00:00'),
	(103,'模态框','/m:web/v:demo-modal','heart',100,'1970-01-01 00:00:00'),
	(104,'模态框(静态)','/m:web/v:demo-modal-static','leaf',100,'1970-01-01 00:00:00'),
	(201,'模块管理','/m:web/v:module-list','scale',200,'2018-07-02 20:00:00'),
	(202,'权限管理','/m:web/v:scope-list','cog',200,'2018-07-02 20:00:00'),
	(203,'用户管理','/m:web/v:user-list','user',200,'2018-07-02 20:00:00');

/*!40000 ALTER TABLE `test_page` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '''''',
  `name` varchar(50) NOT NULL DEFAULT '''''' COMMENT '名称',
  `pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `scope_ids` tinytext COMMENT '权限id列表',
  `roles` tinytext COMMENT '角色',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `email`, `name`, `pwd`, `scope_ids`, `roles`, `create_time`, `modify_time`)
VALUES
	(3,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(4,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(5,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(6,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(7,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(8,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(9,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(10,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(11,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(12,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(13,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(14,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(15,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(16,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(17,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(18,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(19,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(20,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(21,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(22,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(23,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(24,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(25,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(26,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(27,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(28,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(29,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(30,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(31,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(32,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(33,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(34,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(35,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(36,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(37,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(38,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(39,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(40,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(41,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(42,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(43,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(44,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(45,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(46,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(47,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(48,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(49,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(50,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(51,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(52,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(53,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(54,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(55,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(56,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(57,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(58,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(59,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(60,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(61,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(64,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin1','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(65,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(67,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(68,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(69,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(71,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(72,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(73,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(74,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(75,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(76,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(77,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(78,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(79,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00'),
	(80,'xqdwjk216@gmail.com','gavin','123123','100,101,102,103,104,200,201,202,203','admin','1970-01-01 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL DEFAULT '''''' COMMENT '角色名称',
  `scope_module_ids` tinytext NOT NULL COMMENT '可访问的模块列表',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色字典表';




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
