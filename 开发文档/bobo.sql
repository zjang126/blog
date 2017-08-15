/*
Navicat MySQL Data Transfer

Source Server         : aaa
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : bobo

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-08-16 00:56:19
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
  `is_delete` smallint(6) NOT NULL DEFAULT '0' COMMENT '0表示在回收站,1表示上线',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('15', 'aaa', '&lt;p&gt;aaaa&lt;/p&gt;', '23', 'Article/2017-08-14/5991990ae17f0.jpg', 'Article/2017-08-14/thumb_5991990ae17f0.jpg', '1502714122', '0');
INSERT INTO `article` VALUES ('16', 'bbb', '&lt;p&gt;aaaa&lt;/p&gt;', '23', 'Article/2017-08-14/59919944994dd.gif', 'Article/2017-08-14/thumb_59919944994dd.gif', '1502714180', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth
-- ----------------------------
INSERT INTO `auth` VALUES ('7', '管理员管理', 'User', 'index', '0');
INSERT INTO `auth` VALUES ('8', '管理员添加', 'User', 'add', '7');
INSERT INTO `auth` VALUES ('12', '管理员编辑', 'User', 'upd', '7');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'd', '0', null, '1501829126');
INSERT INTO `category` VALUES ('23', '12312', '1', null, null);
INSERT INTO `category` VALUES ('24', '5125', '1', null, null);
INSERT INTO `category` VALUES ('25', '123', '1', null, null);

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `log_time` int(10) DEFAULT NULL,
  `add_time` int(10) DEFAULT NULL,
  `salt` varchar(30) DEFAULT NULL,
  `login_ip` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `role_name` varchar(30) NOT NULL COMMENT '角色名',
  `role_id_list` text COMMENT '所拥有的权限',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '*');
INSERT INTO `role` VALUES ('10', '用户管理', '7,8,9');

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
  `add_time` int(10) unsigned DEFAULT '0',
  `log_time` int(10) DEFAULT NULL,
  `role_id` varchar(11) NOT NULL,
  `phone` bigint(11) DEFAULT NULL,
  `login_ip` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'siki', '607ffbbb7c4e6d5e3d481a30a0dc533c', '5986c9c06e130', '624141368@ac.com', '1501555850', '1502702326', '1', '13268226717', '2130706433');
INSERT INTO `user` VALUES ('3', 'qqqq', '9763a535153c84d46e7d47c801a66767', '5981bd2d4dbd1', '1111@121.com', '1501563569', '1502008488', '1', '15325887488', '2130706433');
INSERT INTO `user` VALUES ('5', 'aaaaa', 'eb59f99bbce01bcb2babb0797f01dd', '598013a73b41c', '112850df11@126.com', '1501565863', '0', '1', '13268774874', '0');
INSERT INTO `user` VALUES ('6', '超级小明', '311fae07eb725497aaac56da4d253766', '5986919ba72f5', 'sadasd@151.com', '1501991323', '1502005537', '1', '13268447874', '2130706433');
INSERT INTO `user` VALUES ('7', 'dasge', '80a1f346e60fdffcf98c23c7ec9469b0', '598f12755deba', '62asdasddas@a.csdfasfom', '1502548597', '0', '1', '13268665400', '0');
