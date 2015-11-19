/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : survey

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-03-19 00:18:10
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_answer
-- ----------------------------

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
  `ao_order` int(11) NOT NULL,
  PRIMARY KEY (`aoid`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_answer_option
-- ----------------------------
INSERT INTO `survey_answer_option` VALUES ('1', '1', 'Display Options1', '1', '', null, '1');
INSERT INTO `survey_answer_option` VALUES ('2', '1', 'Answer Choices', '3', '', null, '2');
INSERT INTO `survey_answer_option` VALUES ('3', '1', 'Add \"Other\" choice field ', '4', '', null, '3');
INSERT INTO `survey_answer_option` VALUES ('4', '1', 'Add \"Comment\" field ', '5', '', null, '4');
INSERT INTO `survey_answer_option` VALUES ('5', '1', 'Require an answer to this question', '15', '', null, '5');
INSERT INTO `survey_answer_option` VALUES ('6', '1', 'Randomise the order of answer choices', '16', '', null, '6');
INSERT INTO `survey_answer_option` VALUES ('7', '2', 'Display Options2', '2', '', null, '7');
INSERT INTO `survey_answer_option` VALUES ('8', '2', 'Answer Choices', '3', '', null, '8');
INSERT INTO `survey_answer_option` VALUES ('9', '2', 'Add \"Other\" choice field ', '4', '', null, '9');
INSERT INTO `survey_answer_option` VALUES ('10', '2', 'Add \"Comment\" field ', '5', '', null, '10');
INSERT INTO `survey_answer_option` VALUES ('11', '2', 'Validate answer format1', '12', '', null, '11');
INSERT INTO `survey_answer_option` VALUES ('12', '2', 'Require an answer to this question', '15', '', null, '12');
INSERT INTO `survey_answer_option` VALUES ('13', '2', 'Randomise the order of answer choices', '16', '', null, '13');
INSERT INTO `survey_answer_option` VALUES ('14', '3', 'Box Size1', '6', '', null, '14');
INSERT INTO `survey_answer_option` VALUES ('15', '3', 'Require an answer to this question', '15', '', null, '15');
INSERT INTO `survey_answer_option` VALUES ('16', '3', 'Validate answer format2', '13', '', null, '16');
INSERT INTO `survey_answer_option` VALUES ('17', '4', 'Answer Choices', '3', '', null, '17');
INSERT INTO `survey_answer_option` VALUES ('18', '4', 'Add \"Comment\" field ', '5', '', null, '18');
INSERT INTO `survey_answer_option` VALUES ('19', '4', 'Require an answer to this question', '15', '', null, '19');
INSERT INTO `survey_answer_option` VALUES ('20', '5', 'Row Choices', '8', '', null, '20');
INSERT INTO `survey_answer_option` VALUES ('21', '5', 'Column Choices', '9', '', null, '21');
INSERT INTO `survey_answer_option` VALUES ('22', '5', 'Add \"Comment\" field ', '5', '', null, '22');
INSERT INTO `survey_answer_option` VALUES ('23', '5', 'Require an answer to this question', '15', '', null, '23');
INSERT INTO `survey_answer_option` VALUES ('24', '5', 'Randomise the order of answer choices', '16', '', null, '24');
INSERT INTO `survey_answer_option` VALUES ('25', '5', 'Allow only one response per column', '14', '', null, '25');
INSERT INTO `survey_answer_option` VALUES ('26', '6', 'Row Choices', '8', '', null, '26');
INSERT INTO `survey_answer_option` VALUES ('27', '6', 'Column Choices', '9', '', null, '27');
INSERT INTO `survey_answer_option` VALUES ('28', '6', 'Add \"Comment\" field ', '5', '', null, '28');
INSERT INTO `survey_answer_option` VALUES ('29', '6', 'Require an answer to this question', '15', '', null, '29');
INSERT INTO `survey_answer_option` VALUES ('30', '6', 'Randomise the order of answer choices', '16', '', null, '30');
INSERT INTO `survey_answer_option` VALUES ('31', '7', 'Row Choices', '8', '', null, '31');
INSERT INTO `survey_answer_option` VALUES ('32', '7', 'Column Choices', '9', '', null, '32');
INSERT INTO `survey_answer_option` VALUES ('33', '7', 'Box Size2', '7', '', null, '33');
INSERT INTO `survey_answer_option` VALUES ('34', '7', 'Add \"Comment\" field ', '5', '', null, '34');
INSERT INTO `survey_answer_option` VALUES ('35', '7', 'Require an answer to this question', '15', '', null, '35');
INSERT INTO `survey_answer_option` VALUES ('36', '7', 'Randomise the order of answer choices', '16', '', null, '36');
INSERT INTO `survey_answer_option` VALUES ('37', '8', 'Row Choices', '8', '', null, '37');
INSERT INTO `survey_answer_option` VALUES ('38', '8', 'Column Choices', '9', '', null, '38');
INSERT INTO `survey_answer_option` VALUES ('39', '8', 'Drop Down Choices', '10', '', null, '39');
INSERT INTO `survey_answer_option` VALUES ('40', '8', 'Add \"Comment\" field ', '5', '', null, '40');
INSERT INTO `survey_answer_option` VALUES ('41', '8', 'Require an answer to this question', '15', '', null, '41');
INSERT INTO `survey_answer_option` VALUES ('42', '8', 'Randomise the order of answer choices', '16', '', null, '42');
INSERT INTO `survey_answer_option` VALUES ('43', '9', 'Box Size2', '7', '', null, '43');
INSERT INTO `survey_answer_option` VALUES ('44', '9', 'Require an answer to this question', '15', '', null, '44');
INSERT INTO `survey_answer_option` VALUES ('45', '9', 'Validate answer format2', '13', '', null, '45');
INSERT INTO `survey_answer_option` VALUES ('46', '10', 'Answer Choices', '3', '', null, '46');
INSERT INTO `survey_answer_option` VALUES ('47', '10', 'Box Size2', '7', '', null, '47');
INSERT INTO `survey_answer_option` VALUES ('48', '10', 'Add \"Comment\" field ', '5', '', null, '48');
INSERT INTO `survey_answer_option` VALUES ('49', '10', 'Require an answer to this question', '15', '', null, '49');
INSERT INTO `survey_answer_option` VALUES ('50', '10', 'Validate answer format2', '13', '', null, '50');
INSERT INTO `survey_answer_option` VALUES ('51', '10', 'Randomise the order of answer choices', '16', '', null, '51');
INSERT INTO `survey_answer_option` VALUES ('52', '12', 'Date Options', '11', '', null, '52');
INSERT INTO `survey_answer_option` VALUES ('53', '12', 'Answer Choices', '3', '', null, '53');
INSERT INTO `survey_answer_option` VALUES ('54', '12', 'Add \"Comment\" field ', '5', '', null, '54');
INSERT INTO `survey_answer_option` VALUES ('55', '12', 'Require an answer to this question', '15', '', null, '55');

-- ----------------------------
-- Table structure for `survey_page`
-- ----------------------------
DROP TABLE IF EXISTS `survey_page`;
CREATE TABLE `survey_page` (
  `pid` bigint(20) NOT NULL AUTO_INCREMENT,
  `sid` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `status` smallint(6) DEFAULT NULL,
  `is_deleted` smallint(11) NOT NULL DEFAULT '0',
  `createdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `p_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_page
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_pre_made`
-- ----------------------------
DROP TABLE IF EXISTS `survey_pre_made`;
CREATE TABLE `survey_pre_made` (
  `pmid` bigint(20) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` smallint(11) NOT NULL,
  PRIMARY KEY (`pmid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_pre_made
-- ----------------------------
INSERT INTO `survey_pre_made` VALUES ('1', '1', 'Yes / No', 'Yes\r\nNo', '0');
INSERT INTO `survey_pre_made` VALUES ('2', '2', 'Numbers (1-10)', '1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10', '0');
INSERT INTO `survey_pre_made` VALUES ('3', '3', 'Numbers (1-100)', '1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25\r\n26\r\n27\r\n28\r\n29\r\n30\r\n31\r\n32\r\n33\r\n34\r\n35\r\n36\r\n37\r\n38\r\n39\r\n40\r\n41\r\n42\r\n43\r\n44\r\n45\r\n46\r\n47\r\n48\r\n49\r\n50\r\n51\r\n52\r\n53\r\n54\r\n55\r\n56\r\n57\r\n58\r\n59\r\n60\r\n61\r\n62\r\n63\r\n64\r\n65\r\n66\r\n67\r\n68\r\n69\r\n70\r\n71\r\n72\r\n73\r\n74\r\n75\r\n76\r\n77\r\n78\r\n79\r\n80\r\n81\r\n82\r\n83\r\n84\r\n85\r\n86\r\n87\r\n88\r\n89\r\n90\r\n91\r\n92\r\n93\r\n94\r\n95\r\n96\r\n97\r\n98\r\n99\r\n100', '0');
INSERT INTO `survey_pre_made` VALUES ('4', '4', 'Days (7)', 'Monday\r\nTuesday\r\nWednesday\r\nThursday\r\nFriday\r\nSaturday\r\nSunday', '0');
INSERT INTO `survey_pre_made` VALUES ('5', '5', 'Months (12)', 'January\r\nFebruary\r\nMarch\r\nApril\r\nMay\r\nJune\r\nJuly\r\nAugust\r\nSeptember\r\nOctober\r\nNovember\r\nDecember', '0');
INSERT INTO `survey_pre_made` VALUES ('6', '6', 'Years (1940-%CURYEAR%)', '', '0');
INSERT INTO `survey_pre_made` VALUES ('7', '7', 'Age', 'under 18\r\n18-24\r\n25-34\r\n35-54\r\n55+', '0');
INSERT INTO `survey_pre_made` VALUES ('8', '8', 'Gender', 'Male\r\nFemale', '0');
INSERT INTO `survey_pre_made` VALUES ('9', '9', 'Race', '[$H]White\r\nBritish\r\nIrish\r\nOther\r\n[$H]Asian or Asian British\r\nIndian\r\nPakistani\r\nBangladeshi\r\nAny other Asian background\r\n[$H]Mixed\r\nWhite and Black Caribbean\r\nWhite and black African\r\nWhite and Asian\r\nAny other mixed background\r\n[$H]Black or Black British\r\nCaribbean\r\nAfrican\r\nAny other black background\r\n[$H]Other Ethnic Group\r\nChinese\r\nAny other Ethnic Group\r\nI do not wish to disclose my ethnic origin', '0');
INSERT INTO `survey_pre_made` VALUES ('10', '10', 'Marital Status', 'Single, Never Married\r\nMarried\r\nSeparated\r\nDivorced\r\nWidowed', '0');
INSERT INTO `survey_pre_made` VALUES ('11', '11', 'Household Income (HHI)', 'Less than £10,000\r\n£10,000 to £19,999\r\n£20,000 to £29,999\r\n£30,000 to £39,999\r\n£40,000 to £49,999\r\n£50,000 to £59,999\r\n£60,000 to £69,999\r\n£70,000 to £79,999\r\n£80,000 to £89,999\r\n£90,000 to £99,999\r\n£100,000 to £149,999\r\n£150,000 or more', '0');
INSERT INTO `survey_pre_made` VALUES ('12', '12', 'UK Cities', 'Aberdeen\r\nArmagh\r\nBangor\r\nBath\r\nBelfast\r\nBirmingham\r\nBradford\r\nBrighton and Hove\r\nBristol\r\nCambridge\r\nCanterbury\r\nCardiff\r\nCarlisle\r\nChester\r\nChichester\r\nCity of London\r\nCoventry\r\nDerby\r\nDundee\r\nDurham\r\nEdinburgh\r\nEly\r\nExeter\r\nGlasgow\r\nGloucester\r\nHereford\r\nInverness\r\nKingston upon Hull\r\nLancaster\r\nLeeds\r\nLeicester\r\nLichfield\r\nLincoln\r\nLisburn\r\nLiverpool\r\nLondonderry\r\nManchester\r\nNewcastle upon Tyne\r\nNewport\r\nNewry\r\nNorwich\r\nNottingham\r\nOxford\r\nPeterborough\r\nPlymouth\r\nPortsmouth\r\nPreston\r\nRipon\r\nSalford\r\nSalisbury\r\nSheffield\r\nSouthampton\r\nSt Albans\r\nSt Davids\r\nStirling\r\nStoke-on-Trent\r\nSunderland\r\nSwansea\r\nTruro\r\nWakefield\r\nWells\r\nWestminster\r\nWinchester\r\nWolverhampton\r\nWorcester\r\nYork', '0');
INSERT INTO `survey_pre_made` VALUES ('13', '13', 'Countries', 'Afghanistan\r\nAlbania\r\nAlgeria\r\nAndorra\r\nAngola\r\nAntigua and Barbuda\r\nArgentina\r\nArmenia\r\nAustralia\r\nAustria\r\nAzerbaijan\r\nBahamas, The\r\nBahrain\r\nBangladesh\r\nBarbados\r\nBelarus\r\nBelgium\r\nBelize\r\nBenin\r\nBhutan\r\nBolivia\r\nBosnia and Herzegovina\r\nBotswana\r\nBrazil\r\nBrunei\r\nBulgaria\r\nBurkina Faso\r\nBurma\r\nBurundi\r\nCambodia\r\nCameroon\r\nCanada\r\nCape Verde\r\nCentral African Republic\r\nChad\r\nChile\r\nChina\r\nColombia\r\nComoros\r\nCongo, Democratic Republic of the\r\nCongo, Republic of the\r\nCosta Rica\r\nCote d\'Ivoire\r\nCroatia\r\nCuba\r\nCyprus\r\nCzech Republic\r\nDenmark\r\nDjibouti\r\nDominica\r\nDominican Republic\r\nEast Timor (see Timor-Leste)\r\nEcuador\r\nEgypt\r\nEl Salvador\r\nEquatorial Guinea\r\nEritrea\r\nEstonia\r\nEthiopia\r\nFiji\r\nFinland\r\nFrance\r\nGabon\r\nGambia, The\r\nGeorgia\r\nGermany\r\nGhana\r\nGreece\r\nGrenada\r\nGuatemala\r\nGuinea\r\nGuinea-Bissau\r\nGuyana\r\nHaiti\r\nHoly See\r\nHonduras\r\nHong Kong\r\nHungary\r\nIceland\r\nIndia\r\nIndonesia\r\nIran\r\nIraq\r\nIreland\r\nIsrael\r\nItaly\r\nJamaica\r\nJapan\r\nJordan\r\nKazakhstan\r\nKenya\r\nKiribati\r\nKosovo\r\nKuwait\r\nKyrgyzstan\r\nLaos\r\nLatvia\r\nLebanon\r\nLesotho\r\nLiberia\r\nLibya\r\nLiechtenstein\r\nLithuania\r\nLuxembourg\r\nMacau\r\nMacedonia\r\nMadagascar\r\nMalawi\r\nMalaysia\r\nMaldives\r\nMali\r\nMalta\r\nMarshall Islands\r\nMauritania\r\nMauritius\r\nMexico\r\nMicronesia\r\nMoldova\r\nMonaco\r\nMongolia\r\nMontenegro\r\nMorocco\r\nMozambique\r\nNamibia\r\nNauru\r\nNepal\r\nNetherlands\r\nNetherlands Antilles\r\nNew Zealand\r\nNicaragua\r\nNiger\r\nNigeria\r\nNorth Korea\r\nNorway\r\nOman\r\nPakistan\r\nPalau\r\nPalestinian Territories\r\nPanama\r\nPapua New Guinea\r\nParaguay\r\nPeru\r\nPhilippines\r\nPoland\r\nPortugal\r\nQatar\r\nRomania\r\nRussia\r\nRwanda\r\nSaint Kitts and Nevis\r\nSaint Lucia\r\nSaint Vincent and the Grenadines\r\nSamoa\r\nSan Marino\r\nSao Tome and Principe\r\nSaudi Arabia\r\nSenegal\r\nSerbia\r\nSeychelles\r\nSierra Leone\r\nSingapore\r\nSlovakia\r\nSlovenia\r\nSolomon Islands\r\nSomalia\r\nSouth Africa\r\nSouth Korea\r\nSouth Sudan\r\nSpain\r\nSri Lanka\r\nSudan\r\nSuriname\r\nSwaziland\r\nSweden\r\nSwitzerland\r\nSyria\r\nTaiwan\r\nTajikistan\r\nTanzania\r\nThailand\r\nTimor-Leste\r\nTogo\r\nTonga\r\nTrinidad and Tobago\r\nTunisia\r\nTurkey\r\nTurkmenistan\r\nTuvalu\r\nUganda\r\nUkraine\r\nUnited Arab Emirates\r\nUnited Kingdom\r\nUnited States\r\nUruguay\r\nUzbekistan\r\nVanuatu\r\nVenezuela\r\nVietnam\r\nYemen\r\nZambia\r\nZimbabwe', '0');
INSERT INTO `survey_pre_made` VALUES ('14', '14', 'Rating Satisfied', 'Very Dissatisfied\r\nDissatisfied\r\nNeutral\r\nSatisfied\r\nVery Satisfied', '0');
INSERT INTO `survey_pre_made` VALUES ('15', '15', 'Rating Agree', 'Strongly Disagree\r\nDisagree\r\nNeutral\r\nAgree\r\nStrongly Agree', '0');
INSERT INTO `survey_pre_made` VALUES ('16', '16', 'Rating Smilies', '[IMG_S5] Very Dissatisfied\r\n[IMG_S4] Dissatisfied\r\n[IMG_S3] Neutral\r\n[IMG_S2] Satisfied\r\n[IMG_S1] Very Satisfied', '0');

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
  `q_order` int(11) NOT NULL,
  `is_required` int(11) NOT NULL DEFAULT '0',
  `require_message` text,
  `is_random_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_question
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_question_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_question_type`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question_type`;
CREATE TABLE `survey_question_type` (
  `qtid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` smallint(11) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qtid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_question_type
-- ----------------------------
INSERT INTO `survey_question_type` VALUES ('1', 'Multiple Choice (Only One Answer)', null, '', '1');
INSERT INTO `survey_question_type` VALUES ('2', 'Multiple Choice (Multiple Answers)', null, '', '2');
INSERT INTO `survey_question_type` VALUES ('3', 'Comment/Essay Box', null, '', '3');
INSERT INTO `survey_question_type` VALUES ('4', 'Ranking', null, '', '4');
INSERT INTO `survey_question_type` VALUES ('5', 'Matrix of Choices (Only One Answer per Row)', null, '', '5');
INSERT INTO `survey_question_type` VALUES ('6', 'Matrix of Choices (Multiple Answers per Row)', null, '', '6');
INSERT INTO `survey_question_type` VALUES ('7', 'Matrix of Textboxes', null, '', '7');
INSERT INTO `survey_question_type` VALUES ('8', 'Matrix of Drop-down Menus', null, '', '8');
INSERT INTO `survey_question_type` VALUES ('9', 'Single Textbox', null, '', '9');
INSERT INTO `survey_question_type` VALUES ('10', 'Multiple Textboxes', null, '', '10');
INSERT INTO `survey_question_type` VALUES ('11', 'Descriptive Text', null, '', '11');
INSERT INTO `survey_question_type` VALUES ('12', 'Date/Time Box', null, '', '12');

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
INSERT INTO `survey_sessions` VALUES ('ba28d05cc60f3628c213db97ed74753c', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '1395149891', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A363337333B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('238996d729612a5c7de7d00e5a40baba', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '1395151954', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A363237353B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('61d71242f0491f69690b18a425a46a47', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '1395149461', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A363839383B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('faf2148eed1c9b959cd2caa80f2c9a19', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '1395149279', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A363637363B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('7946986bb00dba38407998cd9fdd47a6', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '1395146841', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A323838313B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('f41b82c6b9790112bb7ff3c64d27b85f', '192.168.1.102', 'Mozilla/5.0 (iPad; CPU OS 7_0_4 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11B554a Safar', '1395152836', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A383333323B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('c35bc5b56813ce13eb4bdaa51278bf3e', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36', '1395154576', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A373436373B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);
INSERT INTO `survey_sessions` VALUES ('319b8fb85034075c69f83798d69b7185', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0', '1395159316', 0x613A343A7B733A393A22757365725F64617461223B733A303A22223B733A31323A22636170746368615F776F7264223B693A343737353B733A31303A2249535F4C4F47494E4544223B733A313A2259223B733A31343A224C4F47494E45445F555345524944223B733A323A223430223B7D);

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
  `is_response_one_computer` varchar(6) NOT NULL DEFAULT '',
  `is_enable_progressbar` varchar(6) NOT NULL DEFAULT '',
  `is_save_continue` varchar(6) NOT NULL DEFAULT '',
  `cut_off_date` date NOT NULL,
  `max_response` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_survey
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_user
-- ----------------------------
INSERT INTO `survey_user` VALUES ('39', 'PakJuSong', 'pak@gmail.com', '*F6DD0C0AC75395CB5BFC12C46B8880CD156B4799', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `survey_user` VALUES ('40', 'k99', 'k99@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `survey_user` VALUES ('42', '', 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Y', '', '0', '1', '0', '0', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `survey_user` VALUES ('46', 'test1', 'test1@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '2014-03-08 16:42:57', '2014-03-08 16:42:57');
INSERT INTO `survey_user` VALUES ('49', 'PakJuSong', 'pakjsong1986@gmail.com', '*8CF41EBC1A317AD51286F6ABF52F6A7697E79DCC', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '2014-03-09 18:36:44', '2014-03-09 18:36:44');
INSERT INTO `survey_user` VALUES ('50', 'k9', 'k9@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '2014-03-16 12:20:20', '2014-03-16 12:20:20');
INSERT INTO `survey_user` VALUES ('51', 'kkk', 'k999@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Y', '', '0', '0', '0', '0', '0', 'ALLOWED', '2014-03-16 12:25:17', '2014-03-16 12:25:17');
