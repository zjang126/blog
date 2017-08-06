/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : bobo

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2017-08-06 16:48:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text COMMENT '文章的内容',
  `cat_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '文章的所属分类id',
  `img_url` varchar(150) NOT NULL DEFAULT '' COMMENT '存放原图的路径',
  `thumb_url` varchar(150) NOT NULL DEFAULT '' COMMENT '存放缩略图的路径',
  `add_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('2', 'ewr', 'wqerwer', '24', '', '', '1501776424');
INSERT INTO `article` VALUES ('3', 'sadasdasd', '&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822947211931.jpg&quot; title=&quot;1501822947211931.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822947490347.jpg&quot; title=&quot;1501822947490347.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822947774442.jpeg&quot; title=&quot;1501822947774442.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822947421065.jpg&quot; title=&quot;1501822947421065.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822947128424.gif&quot; title=&quot;1501822947128424.gif&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822947122494.jpg&quot; title=&quot;1501822947122494.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822947771129.jpg&quot; title=&quot;1501822947771129.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822947152805.jpg&quot; title=&quot;1501822947152805.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822947842648.bmp&quot; title=&quot;1501822947842648.bmp&quot;/&gt;sadasdASDASDFASDFSDFASDAFASDFSDFS&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948728958.jpeg&quot; title=&quot;1501822948728958.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948556745.jpg&quot; title=&quot;1501822948556745.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948937404.jpg&quot; title=&quot;1501822948937404.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948120028.jpg&quot; title=&quot;1501822948120028.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948451446.jpeg&quot; title=&quot;1501822948451446.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948109546.jpeg&quot; title=&quot;1501822948109546.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948120445.jpeg&quot; title=&quot;1501822948120445.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948471111.jpeg&quot; title=&quot;1501822948471111.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948989687.jpeg&quot; title=&quot;1501822948989687.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948978542.jpeg&quot; title=&quot;1501822948978542.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948519823.jpeg&quot; title=&quot;1501822948519823.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948894286.jpeg&quot; title=&quot;1501822948894286.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170804/1501822948767557.jpeg&quot; title=&quot;1501822948767557.jpeg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', '23', '2017-08-04/5983ffee12649.jpg', '2017-08-04/thumb_5983ffee12649.jpg', '1501822958');
INSERT INTO `article` VALUES ('4', 'sadasd', '&lt;p&gt;&lt;img src=&quot;http://pblog.net/Public/Admin/utf8-php/dialogs/emotion/images/jx2/j_0003.gif&quot;/&gt;dasdasd&lt;img src=&quot;/ueditor/php/upload/image/20170805/1501921176610276.jpg&quot; title=&quot;1501921176610276.jpg&quot; alt=&quot;AB97LJ[J[9{5B%YCP_~GK9W.jpg&quot;/&gt;&lt;/p&gt;', '24', '2017-08-04/598419a4b1e96.jpg', '2017-08-04/thumb_598419a4b1e96.jpg', '1501829540');

-- ----------------------------
-- Table structure for auth
-- ----------------------------
DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `auth_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(30) NOT NULL,
  `auth_c` varchar(30) DEFAULT NULL,
  `auth_a` varchar(255) DEFAULT NULL,
  `auth_pid` smallint(5) NOT NULL,
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth
-- ----------------------------
INSERT INTO `auth` VALUES ('7', '管理员管理', 'User', 'index', '0');
INSERT INTO `auth` VALUES ('8', '管理员添加', 'User', 'add', '7');
INSERT INTO `auth` VALUES ('9', '管理员编辑', 'User', 'upd', '7');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cat_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(35) DEFAULT NULL,
  `pid` int(6) DEFAULT '0',
  `add_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'd', '0', null, '1501829126');
INSERT INTO `category` VALUES ('23', '12312', '1', null, null);
INSERT INTO `category` VALUES ('24', '5125', '1', null, null);
INSERT INTO `category` VALUES ('25', '123', '1', null, null);
INSERT INTO `category` VALUES ('28', 'dashgf', '25', '1501748085', null);
INSERT INTO `category` VALUES ('29', '@@$8', '0', '1501935630', null);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `role_name` varchar(30) NOT NULL COMMENT '角色名',
  `role_id_list` text COMMENT '所拥有的权限',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '*');
INSERT INTO `role` VALUES ('10', '靓坤', '7,8,9');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL COMMENT '用户名',
  `password` char(32) DEFAULT NULL,
  `salt` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `add_time` int(10) unsigned DEFAULT NULL,
  `log_time` int(10) DEFAULT NULL,
  `role_id` varchar(11) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `login_ip` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'siki', '607ffbbb7c4e6d5e3d481a30a0dc533c', '5986c9c06e130', '624141368@ac.com', '1501555850', '1502007773', '1', '2147483647', '2130706433');
INSERT INTO `user` VALUES ('3', 'qqqq', '9763a535153c84d46e7d47c801a66767', '5981bd2d4dbd1', '1111@126.com', '1501563569', '1502008488', '10', '11123123', '2130706433');
INSERT INTO `user` VALUES ('4', '123123', 'ab6789d1cbd2a964a48d234d7d2c75', '59800b1e492e1', 'dqw1@126.com', '1501563678', null, '10', '11111111', '0');
INSERT INTO `user` VALUES ('5', 'aaaaa', 'eb59f99bbce01bcb2babb0797f01dd', '598013a73b41c', '112850df11@126.com', '1501565863', null, '10', '8888888', '0');
INSERT INTO `user` VALUES ('6', '超级小明', '311fae07eb725497aaac56da4d253766', '5986919ba72f5', 'sadasd@151.com', '1501991323', '1502005537', '10', '84475847', '2130706433');
