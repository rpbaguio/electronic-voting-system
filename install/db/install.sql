/*
Navicat MySQL Data Transfer

Source Server         : Vagrant
Source Server Version : 50546
Source Host           : localhost:3306
Source Database       : evs

Target Server Type    : MYSQL
Target Server Version : 50546
File Encoding         : 65001

Date: 2016-10-18 15:12:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_group`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_group`;
CREATE TABLE `tbl_group` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_group
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_person`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_person`;
CREATE TABLE `tbl_person` (
  `id` int(9) NOT NULL,
  `role_id` tinyint(1) NOT NULL DEFAULT '2',
  `is_validated` tinyint(1) NOT NULL DEFAULT '0',
  `is_voted` tinyint(1) NOT NULL DEFAULT '0',
  `is_candidate` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` tinyint(1) NOT NULL DEFAULT '0',
  `position_id` tinyint(1) NOT NULL DEFAULT '0',
  `access_code` char(64) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `dt_updated` datetime NOT NULL,
  `dt_registered` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_person
-- ----------------------------
INSERT INTO `tbl_person` VALUES ('1', '1', '1', '0', '0', '0', '0', 'c4aaaad21e5abc061eb209bd9c8d5b91497c7b1271005a56bbe0ac21a128459f', '0', '0000-00-00 00:00:00', '2016-08-09 18:02:35');
INSERT INTO `tbl_person` VALUES ('2', '2', '0', '0', '0', '0', '0', '', '0', '0000-00-00 00:00:00', '2016-10-12 09:10:57');
INSERT INTO `tbl_person` VALUES ('3', '2', '0', '0', '0', '0', '0', '', '0', '0000-00-00 00:00:00', '2016-10-12 09:11:29');
INSERT INTO `tbl_person` VALUES ('4', '2', '0', '0', '0', '0', '0', '', '0', '0000-00-00 00:00:00', '2016-10-12 10:24:59');
INSERT INTO `tbl_person` VALUES ('5', '2', '0', '0', '0', '0', '0', '', '0', '0000-00-00 00:00:00', '2016-10-12 10:25:23');
INSERT INTO `tbl_person` VALUES ('6', '2', '0', '0', '0', '0', '0', '', '0', '0000-00-00 00:00:00', '2016-10-18 04:54:39');

-- ----------------------------
-- Table structure for `tbl_person_info`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_person_info`;
CREATE TABLE `tbl_person_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `birth_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_person_info
-- ----------------------------
INSERT INTO `tbl_person_info` VALUES ('1', 'Admin', '', 'Admin', 'Undefine', 'male-default-avatar.png', '0000-00-00');
INSERT INTO `tbl_person_info` VALUES ('2', 'Raymond', '', 'Baguio', 'Male', null, '1983-10-19');
INSERT INTO `tbl_person_info` VALUES ('3', 'Maria', '', 'Clara', 'Female', null, '1983-10-19');
INSERT INTO `tbl_person_info` VALUES ('4', 'John', '', 'Doe', 'Male', null, '1983-10-19');
INSERT INTO `tbl_person_info` VALUES ('5', 'Bernadith', '', 'Villegas', 'Female', null, '1983-10-19');
INSERT INTO `tbl_person_info` VALUES ('6', 'Juan', '', 'Dela Cruz', 'Male', null, '1983-10-19');

-- ----------------------------
-- Table structure for `tbl_position`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_position`;
CREATE TABLE `tbl_position` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `max_selection` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_position
-- ----------------------------
INSERT INTO `tbl_position` VALUES ('1', 'President', '1');
INSERT INTO `tbl_position` VALUES ('2', 'Vice President', '1');
INSERT INTO `tbl_position` VALUES ('3', 'Secretary General', '1');
INSERT INTO `tbl_position` VALUES ('4', 'Treasurer', '1');
INSERT INTO `tbl_position` VALUES ('5', 'Auditor', '1');
INSERT INTO `tbl_position` VALUES ('6', 'Senators', '6');

-- ----------------------------
-- Table structure for `tbl_role`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE `tbl_role` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_role
-- ----------------------------
INSERT INTO `tbl_role` VALUES ('1', 'Admin', 'Administrator');
INSERT INTO `tbl_role` VALUES ('2', 'Voter', 'Voter');

-- ----------------------------
-- Table structure for `tbl_settings`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_settings`;
CREATE TABLE `tbl_settings` (
  `id` tinyint(1) NOT NULL,
  `sys_header` varchar(255) NOT NULL,
  `sys_slogan` varchar(255) NOT NULL,
  `sys_footer` varchar(255) NOT NULL,
  `sys_logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_settings
-- ----------------------------
INSERT INTO `tbl_settings` VALUES ('1', 'EVS&reg;', 'Electronic Voting System', '&copy; <?=date(\'Y\')?> RP Creative Studio', '');

-- ----------------------------
-- Table structure for `tbl_tally`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tally`;
CREATE TABLE `tbl_tally` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(9) NOT NULL,
  `candidate_id` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_tally
-- ----------------------------
