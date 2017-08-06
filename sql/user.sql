/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : bobo

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 201aaaa7-08-01 23:34:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL COMMENT '用户名',
  `password` char(30) DEFAULT NULL,
  `salt` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `add_time` int(10) unsigned DEFAULT NULL,
  `log_time` int(10) unsigned DEFAULT NULL,
  `adminRole` enum('2','1') DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `login_ip` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'siki--a', 'a46590c0e4c0ae5acf9fde3786f10f', '598060ad987c9', 'sadas@ac.com', '1501555850', null, '2', '2147483647', '19216811');
INSERT INTO `user` VALUES ('2', 'nvasdasd', 'e5804bb574cb7a6dd19f0fd0328d01', '598064a5945d0', 'qweqwe@sd.com', '1501563460', null, '1', '2147483647', '0');
INSERT INTO `user` VALUES ('3', 'qqqq', '', '59800ab109e30', '1111@126.com', '1501563569', null, '1', '11123123', '0');
INSERT INTO `user` VALUES ('4', '123123', 'ab6789d1cbd2a964a48d234d7d2c75', '59800b1e492e1', 'dqw1@126.com', '1501563678', null, '2', '11111111', '0');
INSERT INTO `user` VALUES ('5', 'aaaaa', 'eb59f99bbce01bcb2babb0797f01dd', '598013a73b41c', '112850df11@126.com', '1501565863', null, '1', '8888888', '0');
INSERT INTO `user` VALUES ('6', 'ewrwer', 'bb4847f3c2b467ebc4fdbcebb6efb4', '59802ccee6b96', '4984we@sd.com', '1501572302', null, '1', '88888813', '0');
INSERT INTO `user` VALUES ('7', 'qweqweqw', '2bd6dccca012fbaf23637ea581f6f3', '5980380263610', 'sdjasd@asd', '1501575170', null, '2', '13232321', '0');
