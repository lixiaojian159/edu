/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : 127.0.0.1:3306
 Source Schema         : edu

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 22/01/2019 17:23:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` int(1) NOT NULL COMMENT '角色',
  `status` int(1) NOT NULL COMMENT '状态',
  `create_time` int(13) NOT NULL,
  `update_time` int(13) NOT NULL,
  `login_time` int(13) NOT NULL COMMENT '登陆时间',
  `login_count` int(5) NOT NULL COMMENT '登陆次数',
  `is_delete` int(1) NULL DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@qq.com', 1, 1, 0, 0, 1548140445, 10, NULL);
INSERT INTO `user` VALUES (3, 'summer123', 'd41d8cd98f00b204e9800998ecf8427e', 'summer123@qq.com', 1, 1, 1, 1548148953, 1647483647, 5, NULL);

SET FOREIGN_KEY_CHECKS = 1;
