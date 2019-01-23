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

 Date: 23/01/2019 17:26:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for grade
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade`  (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称',
  `length` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学制',
  `price` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学费',
  `create_time` int(13) NOT NULL COMMENT '创建时间',
  `update_time` int(13) NOT NULL COMMENT '修改时间',
  `delete_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '删除时间',
  `is_delete` int(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
  `student_id` int(5) NOT NULL COMMENT '外键(学生id)',
  `status` int(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of grade
-- ----------------------------
INSERT INTO `grade` VALUES (1, 'php高级就业班', '13个月', '20000', 0, 1548234876, NULL, 0, 2, 0);

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student`  (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学生姓名',
  `age` int(5) NOT NULL COMMENT '学生年龄',
  `mobile` int(11) NOT NULL COMMENT '手机号',
  `ceate_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `delete_time` int(11) NOT NULL COMMENT '软删除',
  `is_delete` int(1) NOT NULL COMMENT '是否删除',
  `status` int(1) NOT NULL COMMENT '状态',
  `grade_id` int(11) NOT NULL COMMENT '外键(班级)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher`  (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '教师姓名',
  `degree` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学历',
  `mobile` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手机号',
  `school` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '毕业学校',
  `hiredate` int(11) NOT NULL COMMENT '入职时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '软删除',
  `is_delete` int(1) NOT NULL COMMENT '是否删除',
  `status` int(1) NOT NULL COMMENT '状态',
  `grade_id` int(2) NOT NULL COMMENT '外键(班级)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES (1, '朱老师', '本科', '18633899380', '西安电子科技大学', 0, 0, 0, NULL, 0, 1, 1);

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
  `is_delete` int(1) NULL DEFAULT 0 COMMENT '软删除',
  `delete_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@qq.com', 1, 1, 0, 0, 1548228679, 25, 0, NULL);
INSERT INTO `user` VALUES (3, 'summer', 'e10adc3949ba59abbe56e057f20f883e', 'summer@qq.com', 0, 1, 1, 1548222625, 1548210089, 7, 0, NULL);
INSERT INTO `user` VALUES (4, 'zhangyc', 'e10adc3949ba59abbe56e057f20f883e', 'zhangyc@qq.com', 1, 1, 1548207102, 1548222287, 1548209223, 3, 0, NULL);
INSERT INTO `user` VALUES (5, 'gurui', 'e10adc3949ba59abbe56e057f20f883e', 'gurui@qq.com', 1, 1, 1548222814, 1548222814, 1548228660, 2, 0, NULL);
INSERT INTO `user` VALUES (6, 'liujin', 'e10adc3949ba59abbe56e057f20f883e', 'liujin@qq.com', 1, 1, 1548222926, 1548222926, 0, 0, 0, NULL);

SET FOREIGN_KEY_CHECKS = 1;
