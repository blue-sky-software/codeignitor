/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.105
Source Server Version : 50527
Source Host           : 192.168.1.105:3306
Source Database       : survey

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-02-27 02:45:47
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
INSERT INTO `ci_sessions` VALUES ('a98a1d4f3092add07fc38c6eba99e531', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', '1393440077', 0x613A333A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A393531373B733A31343A224C4F47494E45445F555345524944223B733A323A223337223B7D);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `passwd` varchar(256) NOT NULL,
  `activated` varchar(16) NOT NULL DEFAULT 'N',
  `authcode` varchar(256) NOT NULL DEFAULT '',
  `is_deleted` varchar(16) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('37', 'pjs', 'pakjsong1986@gmail.com', '*BA72C0F73C9228CCBDB16524A6BE4AFFB0B3A54B', 'Y', '3736894ED5319E8D34F02192491808D8B108B27B', 'N');
