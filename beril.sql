/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MariaDB
 Source Server Version : 100506
 Source Host           : localhost:3306
 Source Schema         : beril

 Target Server Type    : MariaDB
 Target Server Version : 100506
 File Encoding         : 65001

 Date: 14/12/2021 22:38:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kullanicilar
-- ----------------------------
DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE `kullanicilar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `un` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kullanicilar
-- ----------------------------
INSERT INTO `kullanicilar` VALUES (1, 'Beril Tezcan', 'beril', 'b');

-- ----------------------------
-- Table structure for yazilar
-- ----------------------------
DROP TABLE IF EXISTS `yazilar`;
CREATE TABLE `yazilar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanici_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `baslik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `yazi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yazilar
-- ----------------------------
INSERT INTO `yazilar` VALUES (1, '1', 'txt 1', 'lorem ipsum');
INSERT INTO `yazilar` VALUES (2, '1', 'txt 2', 'java');
INSERT INTO `yazilar` VALUES (3, '1', 'txt 3', 'php');


SET FOREIGN_KEY_CHECKS = 1;
