/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : edu

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-01-21 22:28:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '0', '0');
