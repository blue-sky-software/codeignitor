/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : survey

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-03-10 09:06:48
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `survey_answer`
-- ----------------------------
DROP TABLE IF EXISTS `survey_answer`;
CREATE TABLE `survey_answer` (
  `aid` bigint(20) NOT NULL AUTO_INCREMENT,
  `qid` bigint(20) NOT NULL,
  `ipaddr` text NOT NULL,
  `answerdate` datetime NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `answer_choice` text,
  `answer_comment` text,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_answer
-- ----------------------------
INSERT INTO `survey_answer` VALUES ('1', '1', '192.168.1.108', '0000-00-00 00:00:00', null, '0', '3', 'I like really.');
INSERT INTO `survey_answer` VALUES ('2', '1', '192.168.1.106', '0000-00-00 00:00:00', null, '0', '9', 'Not so.');
INSERT INTO `survey_answer` VALUES ('3', '1', '192.168.1.110', '0000-00-00 00:00:00', null, '0', '9', 'OK.');
INSERT INTO `survey_answer` VALUES ('4', '7', '192.168.1.108', '0000-00-00 00:00:00', null, '0', 'Marlboro/Dunhil', null);
INSERT INTO `survey_answer` VALUES ('5', '5', '192.168.1.108', '0000-00-00 00:00:00', null, '0', 'Yes', null);

-- ----------------------------
-- Table structure for `survey_answer_detail`
-- ----------------------------
DROP TABLE IF EXISTS `survey_answer_detail`;
CREATE TABLE `survey_answer_detail` (
  `adid` bigint(20) NOT NULL AUTO_INCREMENT,
  `aid` bigint(20) NOT NULL,
  `qdid` bigint(20) NOT NULL,
  `a_v0` text,
  `a_v1` text,
  `a_v2` text,
  `a_v3` text,
  `a_v4` text,
  `a_v5` text,
  `a_v6` text,
  `a_v7` text,
  `a_v8` text,
  `a_v9` text,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_answer_detail
-- ----------------------------
INSERT INTO `survey_answer_detail` VALUES ('1', '1', '1', '5', null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `survey_answer_detail` VALUES ('2', '1', '2', 'comments', null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `survey_answer_detail` VALUES ('3', '4', '3', null, null, null, null, null, null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for `survey_answer_option`
-- ----------------------------
DROP TABLE IF EXISTS `survey_answer_option`;
CREATE TABLE `survey_answer_option` (
  `aoid` bigint(20) NOT NULL AUTO_INCREMENT,
  `qtid` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `key` text NOT NULL,
  `status` smallint(11) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL,
  PRIMARY KEY (`aoid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_answer_option
-- ----------------------------
INSERT INTO `survey_answer_option` VALUES ('1', '1', 'Display Options', '1', '', null, '0', '1');
INSERT INTO `survey_answer_option` VALUES ('2', '1', 'Display Options', '2', '', null, '0', '2');
INSERT INTO `survey_answer_option` VALUES ('3', '1', 'Answer Choices', '3', '', null, '0', '3');
INSERT INTO `survey_answer_option` VALUES ('4', '1', 'Add \"Other\" choice field ', '4', '', null, '0', '4');
INSERT INTO `survey_answer_option` VALUES ('5', '1', 'Add \"Comment\" field ', '5', '', null, '0', '5');

-- ----------------------------
-- Table structure for `survey_page`
-- ----------------------------
DROP TABLE IF EXISTS `survey_page`;
CREATE TABLE `survey_page` (
  `pid` bigint(20) NOT NULL AUTO_INCREMENT,
  `sid` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `desc` text,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_page
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_question`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question`;
CREATE TABLE `survey_question` (
  `qid` bigint(20) NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) NOT NULL,
  `question` text NOT NULL,
  `qtid` bigint(20) NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `is_required` int(11) NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_question
-- ----------------------------
INSERT INTO `survey_question` VALUES ('1', '1', 'Which digit do you prefer?', '1', null, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0');
INSERT INTO `survey_question` VALUES ('5', '1', 'Do you smoke?', '1', null, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0');
INSERT INTO `survey_question` VALUES ('7', '1', 'What cigarettes do you like?', '2', null, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '0');

-- ----------------------------
-- Table structure for `survey_question_detail`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question_detail`;
CREATE TABLE `survey_question_detail` (
  `qdid` bigint(20) NOT NULL AUTO_INCREMENT,
  `qid` bigint(20) NOT NULL,
  `aoid` bigint(20) NOT NULL,
  `q_v0` text,
  `q_v1` text,
  `q_v2` text,
  `q_v3` text,
  `q_v4` text,
  `q_v5` text,
  `q_v6` text,
  `q_v7` text,
  `q_v8` text,
  `q_v9` text,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qdid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_question_detail
-- ----------------------------
INSERT INTO `survey_question_detail` VALUES ('1', '1', '3', '0/1/2/3/4/5/6/7/8/9', null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `survey_question_detail` VALUES ('2', '1', '5', 'my choice field Label', '2', '4', '5', null, null, null, null, null, null, null, '0');
INSERT INTO `survey_question_detail` VALUES ('3', '5', '1', '2', null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `survey_question_detail` VALUES ('4', '1', '1', '4', null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `survey_question_detail` VALUES ('5', '5', '3', 'Yes/No', null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `survey_question_detail` VALUES ('6', '7', '2', '3', null, null, null, null, null, null, null, null, null, null, '0');
INSERT INTO `survey_question_detail` VALUES ('7', '7', '3', 'Craven/Marlboro/Dunhil', null, null, null, null, null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for `survey_question_type`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question_type`;
CREATE TABLE `survey_question_type` (
  `qtid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` smallint(11) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `image_url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qtid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_question_type
-- ----------------------------
INSERT INTO `survey_question_type` VALUES ('1', 'Multiple Choice (Only One Answer)', null, '0', '', '1');
INSERT INTO `survey_question_type` VALUES ('2', 'Multiple Choice (Multiple Answers)', null, '0', '', '2');
INSERT INTO `survey_question_type` VALUES ('3', 'Comment/Essay Box', null, '0', '', '3');
INSERT INTO `survey_question_type` VALUES ('4', 'Ranking', null, '0', '', '4');
INSERT INTO `survey_question_type` VALUES ('5', 'Matrix of Choices (Only One Answer per Row)', null, '0', '', '5');
INSERT INTO `survey_question_type` VALUES ('6', 'Matrix of Choices (Multiple Answers per Row)', null, '0', '', '6');
INSERT INTO `survey_question_type` VALUES ('7', 'Matrix of Textboxes', null, '0', '', '7');
INSERT INTO `survey_question_type` VALUES ('8', 'Matrix of Drop-down Menus', null, '0', '', '8');
INSERT INTO `survey_question_type` VALUES ('9', 'Single Textbox', null, '0', '', '9');
INSERT INTO `survey_question_type` VALUES ('10', 'Multiple Textboxes', null, '0', '', '10');
INSERT INTO `survey_question_type` VALUES ('11', 'Descriptive Text', null, '0', '', '11');
INSERT INTO `survey_question_type` VALUES ('12', 'Date/Time Box', null, '0', '', '12');

-- ----------------------------
-- Table structure for `survey_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `survey_sessions`;
CREATE TABLE `survey_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of survey_sessions
-- ----------------------------
INSERT INTO `survey_sessions` VALUES ('16a3a330325be739507de797ee936f37', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36', '1394389434', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A393038373B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('04287f92ab008018bc21901ca80d8afd', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0', '1394392438', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A393537333B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('04428c787750ab15bc094da89e32817f', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36', '1394392782', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A373034363B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('e043d3238599a0a853f5c33eab45240f', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.46 Safari/537.36', '1394391403', 0x613A333A7B733A31323A22636170746368615F776F7264223B693A333339303B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);

-- ----------------------------
-- Table structure for `survey_survey`
-- ----------------------------
DROP TABLE IF EXISTS `survey_survey`;
CREATE TABLE `survey_survey` (
  `sid` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `language` smallint(6) NOT NULL DEFAULT '1',
  `status` varchar(32) NOT NULL DEFAULT 'ALLOWED',
  `is_deleted` smallint(6) NOT NULL DEFAULT '0',
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `expire_date` date DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `redirect_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_survey
-- ----------------------------
INSERT INTO `survey_survey` VALUES ('1', '38', 'MyFirstSurvey1', '1', 'SUSPENDED', '1', '2014-01-29', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('2', '38', 'MyFirstSurvey2', '1', 'ALLOWED', '0', '2014-03-17', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('3', '38', 'MyFirstSurvey3', '1', 'SUSPENDED', '0', '2014-03-19', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('4', '38', 'MyFirstSurvey4', '1', 'SUSPENDED', '0', '2014-03-04', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('5', '38', 'MyFirstSurvey5', '1', 'SUSPENDED', '0', '2014-03-27', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('6', '38', 'MyFirstSurvey6', '1', 'ALLOWED', '0', '2014-04-05', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('7', '38', 'MyFirstSurvey7', '1', 'SUSPENDED', '0', '2014-03-20', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('8', '38', 'MyFirstSurvey8', '1', 'ALLOWED', '0', '2014-03-16', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('9', '38', 'MyFirstSurvey9', '1', 'SUSPENDED', '0', '2014-03-17', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('10', '38', 'MyFirstSurvey10', '1', 'ALLOWED', '0', '2014-03-12', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('11', '38', 'MyFirstSurvey11', '1', 'ALLOWED', '0', '2014-03-31', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('12', '38', 'MyFirstSurvey12', '1', 'SUSPENDED', '0', '2014-05-01', '0000-00-00', null, null, null);
INSERT INTO `survey_survey` VALUES ('13', '40', 'zzzzzz', '1', 'ALLOWED', '0', '2014-03-09', '2014-03-09', null, null, null);
INSERT INTO `survey_survey` VALUES ('14', '40', 'favicon.ico', '1', 'ALLOWED', '0', '2014-03-09', '2014-03-09', null, null, null);
INSERT INTO `survey_survey` VALUES ('15', '40', 'favicon.ico', '1', 'ALLOWED', '0', '2014-03-09', '2014-03-09', null, null, null);
INSERT INTO `survey_survey` VALUES ('16', '40', 'bbbbb', '1', 'ALLOWED', '0', '2014-03-09', '2014-03-09', null, null, null);
INSERT INTO `survey_survey` VALUES ('17', '40', 'ccccccc', '1', 'ALLOWED', '0', '2014-03-09', '2014-03-09', null, null, null);
INSERT INTO `survey_survey` VALUES ('18', '40', 'zxxxx', '1', 'ALLOWED', '0', '2014-03-09', '2014-03-09', null, null, null);
INSERT INTO `survey_survey` VALUES ('19', '40', 'aaaaaa', '1', 'ALLOWED', '0', '2014-03-09', '2014-03-09', null, null, null);
INSERT INTO `survey_survey` VALUES ('20', '40', 'cc', '3', 'ALLOWED', '0', '2014-03-09', '2014-03-09', null, null, null);
INSERT INTO `survey_survey` VALUES ('21', '40', 'qqqqqqqqqqqqqqqqq', '1', 'ALLOWED', '0', '2014-03-09', '2014-03-09', null, null, null);
INSERT INTO `survey_survey` VALUES ('22', '40', 'bbbbb', '4', 'ALLOWED', '0', '2014-03-10', '2014-03-10', null, null, null);

-- ----------------------------
-- Table structure for `survey_user`
-- ----------------------------
DROP TABLE IF EXISTS `survey_user`;
CREATE TABLE `survey_user` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `passwd` varchar(256) NOT NULL,
  `activated` varchar(16) NOT NULL DEFAULT 'N',
  `authcode` varchar(256) NOT NULL DEFAULT '',
  `is_deleted` smallint(16) NOT NULL DEFAULT '0',
  `admin_priv` smallint(6) NOT NULL DEFAULT '0',
  `create_priv` smallint(6) NOT NULL DEFAULT '0',
  `take_priv` smallint(6) NOT NULL DEFAULT '0',
  `edit_priv` smallint(6) NOT NULL DEFAULT '0',
  `status` varchar(32) NOT NULL DEFAULT 'SUSPENDED',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_user
-- ----------------------------
INSERT INTO `survey_user` VALUES ('39', 'PakJuSong', 'pak@gmail.com', '*F6DD0C0AC75395CB5BFC12C46B8880CD156B4799', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `survey_user` VALUES ('40', 'k99', 'k99@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `survey_user` VALUES ('42', '', 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Y', '', '0', '1', '0', '0', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `survey_user` VALUES ('46', 'test1', 'test1@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '2014-03-08 16:42:57', '2014-03-08 16:42:57');
INSERT INTO `survey_user` VALUES ('49', 'PakJuSong', 'pakjsong1986@gmail.com', '*8CF41EBC1A317AD51286F6ABF52F6A7697E79DCC', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '2014-03-09 18:36:44', '2014-03-09 18:36:44');
