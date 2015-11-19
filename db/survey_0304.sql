/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : survey

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-03-04 13:02:12
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
INSERT INTO `ci_sessions` VALUES ('c61a61b50daee7d7e3952a50ddca44a6', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393811677', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A343434353B7D);
INSERT INTO `ci_sessions` VALUES ('96fbc3e81c4e934443cfbfa90879cef1', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393812084', 0x613A333A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A363539353B733A31343A224C4F47494E45445F555345524944223B733A323A223339223B7D);
INSERT INTO `ci_sessions` VALUES ('a31e285b241db7f2bf7d102f4a8b2383', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393812328', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A353937373B7D);
INSERT INTO `ci_sessions` VALUES ('f65a035966c2f83b8bdd71ebb21782bd', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0', '1393810764', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A333432393B7D);
INSERT INTO `ci_sessions` VALUES ('1d94a6e975c202aceab23b82f14fe86e', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0', '1393810765', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A343933323B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `ci_sessions` VALUES ('450afe78f17ecdc241ebd7185aa8b32c', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0', '1393810763', '');
INSERT INTO `ci_sessions` VALUES ('69ecf05ebd528b813f55d916c75bc452', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0', '1393810763', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A393231323B7D);
INSERT INTO `ci_sessions` VALUES ('cdfd7425b4c506bb0bdba6b9c1e287d6', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0', '1393810759', '');
INSERT INTO `ci_sessions` VALUES ('a18594474ef2d0da03fd322238d4cfe9', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0', '1393810759', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A333139383B7D);
INSERT INTO `ci_sessions` VALUES ('b0eaa2c82f1d0c5d54bbb61c6a09051f', '127.0.0.1', 'Jakarta Commons-HttpClient/3.1', '1393809711', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A333030333B7D);
INSERT INTO `ci_sessions` VALUES ('23902703274d87a5fee4af43f780f9d4', '127.0.0.1', 'Jakarta-Commons-VFS', '1393809712', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A333030333B7D);
INSERT INTO `ci_sessions` VALUES ('aa6951a1506b6c5af7ea5903aa36390f', '127.0.0.1', 'Jakarta Commons-HttpClient/3.1', '1393809729', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A363730313B7D);
INSERT INTO `ci_sessions` VALUES ('61c69041c6cc7ddb9ca67e51e38154e7', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393811415', 0x613A333A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A393434333B733A31343A224C4F47494E45445F555345524944223B733A323A223339223B7D);
INSERT INTO `ci_sessions` VALUES ('4301f55f891e516819a6a1c702fc180d', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393812441', 0x613A323A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A333533333B7D);
INSERT INTO `ci_sessions` VALUES ('bf4559a471a939b92fa8f7e2d5865035', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393816860', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A353534353B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223431223B7D);
INSERT INTO `ci_sessions` VALUES ('a4e4112b3f1a045916833d689bb711c4', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393816252', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A353034323B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `ci_sessions` VALUES ('c77c349215ee0a877aaa9ec32ddb6dda', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393816746', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A363834323B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `ci_sessions` VALUES ('49d6152f10eedf2396aed80c2b8932f8', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393902448', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A383839363B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);

-- ----------------------------
-- Table structure for `ps_answer`
-- ----------------------------
DROP TABLE IF EXISTS `ps_answer`;
CREATE TABLE `ps_answer` (
  `aid` bigint(20) NOT NULL AUTO_INCREMENT,
  `qid` bigint(20) NOT NULL,
  `ipaddr` text NOT NULL,
  `answerdate` datetime NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ps_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `ps_answer_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ps_answer_detail`;
CREATE TABLE `ps_answer_detail` (
  `adid` bigint(20) NOT NULL AUTO_INCREMENT,
  `aid` bigint(20) NOT NULL,
  `qdid` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ps_answer_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `ps_answer_option`
-- ----------------------------
DROP TABLE IF EXISTS `ps_answer_option`;
CREATE TABLE `ps_answer_option` (
  `aoid` bigint(20) NOT NULL AUTO_INCREMENT,
  `qtid` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `key` text NOT NULL,
  `status` smallint(11) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL,
  PRIMARY KEY (`aoid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ps_answer_option
-- ----------------------------
INSERT INTO `ps_answer_option` VALUES ('1', '1', 'Radio Buttons (1 column)', '1', '', null, '0', '1');
INSERT INTO `ps_answer_option` VALUES ('2', '1', 'Radio Buttons (2 columns)', '0', '', null, '0', '2');
INSERT INTO `ps_answer_option` VALUES ('3', '1', 'Radio Buttons (3 columns)', '0', '', null, '0', '3');
INSERT INTO `ps_answer_option` VALUES ('4', '1', 'Radio Buttons (4 columns)', '0', '', null, '0', '4');
INSERT INTO `ps_answer_option` VALUES ('5', '1', 'Radio Buttons (Horizontal)', '0', '', null, '0', '5');
INSERT INTO `ps_answer_option` VALUES ('6', '1', 'Drop-down Menu', '0', '', null, '0', '6');

-- ----------------------------
-- Table structure for `ps_page`
-- ----------------------------
DROP TABLE IF EXISTS `ps_page`;
CREATE TABLE `ps_page` (
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
-- Records of ps_page
-- ----------------------------

-- ----------------------------
-- Table structure for `ps_question`
-- ----------------------------
DROP TABLE IF EXISTS `ps_question`;
CREATE TABLE `ps_question` (
  `qid` bigint(20) NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) NOT NULL,
  `question` text NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `is_required` int(11) NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ps_question
-- ----------------------------

-- ----------------------------
-- Table structure for `ps_question_detail`
-- ----------------------------
DROP TABLE IF EXISTS `ps_question_detail`;
CREATE TABLE `ps_question_detail` (
  `qdid` bigint(20) NOT NULL AUTO_INCREMENT,
  `qid` bigint(20) NOT NULL,
  `aoid` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qdid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ps_question_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `ps_question_type`
-- ----------------------------
DROP TABLE IF EXISTS `ps_question_type`;
CREATE TABLE `ps_question_type` (
  `qtid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` smallint(11) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `image_url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qtid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ps_question_type
-- ----------------------------
INSERT INTO `ps_question_type` VALUES ('1', 'Multiple Choice (Only One Answer)', null, '0', '', '1');
INSERT INTO `ps_question_type` VALUES ('2', 'Multiple Choice (Multiple Answers)', null, '0', '', '2');
INSERT INTO `ps_question_type` VALUES ('3', 'Comment/Essay Box', null, '0', '', '3');
INSERT INTO `ps_question_type` VALUES ('4', 'Ranking', null, '0', '', '4');
INSERT INTO `ps_question_type` VALUES ('5', 'Matrix of Choices (Only One Answer per Row)', null, '0', '', '5');
INSERT INTO `ps_question_type` VALUES ('6', 'Matrix of Choices (Multiple Answers per Row)', null, '0', '', '6');
INSERT INTO `ps_question_type` VALUES ('7', 'Matrix of Textboxes', null, '0', '', '7');
INSERT INTO `ps_question_type` VALUES ('8', 'Matrix of Drop-down Menus', null, '0', '', '8');
INSERT INTO `ps_question_type` VALUES ('9', 'Single Textbox', null, '0', '', '9');
INSERT INTO `ps_question_type` VALUES ('10', 'Multiple Textboxes', null, '0', '', '10');
INSERT INTO `ps_question_type` VALUES ('11', 'Descriptive Text', null, '0', '', '11');
INSERT INTO `ps_question_type` VALUES ('12', 'Date/Time Box', null, '0', '', '12');

-- ----------------------------
-- Table structure for `ps_survey`
-- ----------------------------
DROP TABLE IF EXISTS `ps_survey`;
CREATE TABLE `ps_survey` (
  `sid` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(6) NOT NULL DEFAULT '0',
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `expire_date` date DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `redirect_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ps_survey
-- ----------------------------
INSERT INTO `ps_survey` VALUES ('1', '38', 'MyFirstSurvey1', '0', '0', '2014-01-29', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('2', '38', 'MyFirstSurvey2', '1', '0', '2014-03-17', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('3', '38', 'MyFirstSurvey3', '1', '0', '2014-03-19', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('4', '38', 'MyFirstSurvey4', '0', '0', '2014-03-04', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('5', '38', 'MyFirstSurvey5', '0', '0', '2014-03-27', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('6', '38', 'MyFirstSurvey6', '1', '0', '2014-04-05', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('7', '38', 'MyFirstSurvey7', '0', '0', '2014-03-20', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('8', '38', 'MyFirstSurvey8', '1', '0', '2014-03-16', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('9', '38', 'MyFirstSurvey9', '0', '0', '2014-03-17', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('10', '38', 'MyFirstSurvey10', '1', '0', '2014-03-12', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('11', '38', 'MyFirstSurvey11', '1', '0', '2014-03-31', '0000-00-00', null, null, null);
INSERT INTO `ps_survey` VALUES ('12', '38', 'MyFirstSurvey12', '0', '0', '2014-05-01', '0000-00-00', null, null, null);

-- ----------------------------
-- Table structure for `ps_user`
-- ----------------------------
DROP TABLE IF EXISTS `ps_user`;
CREATE TABLE `ps_user` (
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
  `status` smallint(6) DEFAULT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ps_user
-- ----------------------------
INSERT INTO `ps_user` VALUES ('39', 'PakJuSong', 'pakjsong1986@gmail.com', '*F6DD0C0AC75395CB5BFC12C46B8880CD156B4799', 'Y', '', '0', '0', '0', '0', '0', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `ps_user` VALUES ('40', 'k99', 'k99@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Y', '', '0', '0', '0', '0', '0', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `ps_user` VALUES ('41', 'test001', 'test001@gmail.com', '*F6DD0C0AC75395CB5BFC12C46B8880CD156B4799', 'Y', '', '0', '0', '0', '0', '0', null, '2014-03-03 10:15:41', '2014-03-03 10:15:41');
