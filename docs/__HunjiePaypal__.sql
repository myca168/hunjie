-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2014 at 09:10 PM
-- Server version: 5.5.19
-- PHP Version: 5.4.21

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hunjie`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE IF NOT EXISTS `animal` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(5) NOT NULL,
  `sqn` tinyint(4) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `sqn`) VALUES
(1, '鼠', 9),
(2, '牛', 99),
(3, '虎', 99),
(4, '兔', 99),
(5, '龙', 99),
(6, '蛇', 99),
(7, '马', 99),
(8, '羊', 99),
(9, '猴', 99),
(10, '鸡', 99),
(11, '狗', 99),
(12, '猪', 99),
(13, '不知道', 99);

-- --------------------------------------------------------

--
-- Table structure for table `chinese`
--

CREATE TABLE IF NOT EXISTS `chinese` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `desc` varchar(30) NOT NULL,
  `sqn` tinyint(4) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `chinese`
--

INSERT INTO `chinese` (`id`, `desc`, `sqn`) VALUES
(1, '非常好', 99),
(2, '母语', 99),
(3, '还好', 99),
(4, '好', 99),
(5, '不会说', 99);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` smallint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sqn` smallint(8) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `sqn`) VALUES
(1, '加拿大', 5),
(2, '美国', 10),
(3, '澳大利亚', 15),
(4, '新西兰', 15),
(5, '英国', 15),
(6, '法国', 15),
(7, '德国', 15),
(8, '日本', 15),
(9, '韩国', 15),
(10, '中国', 12),
(11, '台湾', 12),
(12, '香港', 12),
(13, '澳门', 12),
(14, '新加坡', 12),
(15, '其他国家', 99);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `desc` varchar(50) NOT NULL,
  `sqn` tinyint(4) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `desc`, `sqn`) VALUES
(1, '大学', 99),
(2, '硕士', 99),
(3, '博士', 99),
(4, '大专', 99),
(5, '高中/中专', 99),
(6, '初中', 99),
(7, '小学', 99);

-- --------------------------------------------------------

--
-- Table structure for table `english`
--

CREATE TABLE IF NOT EXISTS `english` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `desc` varchar(30) NOT NULL,
  `sqn` tinyint(4) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `english`
--

INSERT INTO `english` (`id`, `desc`, `sqn`) VALUES
(1, '还好', 99),
(2, '不会说', 99),
(3, '好', 99),
(4, '非常好', 99),
(5, '母语', 99);

-- --------------------------------------------------------

--
-- Table structure for table `ethics`
--

CREATE TABLE IF NOT EXISTS `ethics` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `sqn` tinyint(4) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `ethics`
--

INSERT INTO `ethics` (`id`, `name`, `sqn`) VALUES
(1, '北京', 9),
(2, '上海', 10),
(3, '天津', 10),
(4, '重庆', 10),
(5, '安徽', 90),
(6, '福建', 16),
(7, '甘肃', 90),
(8, '广东', 15),
(9, '广西', 15),
(10, '贵州', 90),
(11, '海南', 15),
(12, '河北', 30),
(13, '黑龙江', 18),
(14, '河南', 30),
(15, '湖北', 30),
(16, '湖南', 30),
(17, '内蒙古', 30),
(18, '江苏', 16),
(19, '江西', 30),
(20, '吉林', 18),
(21, '辽宁', 18),
(22, '宁夏', 30),
(23, '青海', 30),
(24, '陕西', 20),
(25, '山东', 20),
(26, '山西', 30),
(27, '四川', 30),
(28, '台湾', 99),
(29, '西藏', 91),
(30, '新疆', 91),
(31, '云南', 30),
(32, '浙江', 16),
(33, '香港', 99),
(34, '澳门', 99),
(35, '其他', 99);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `uid` int(12) NOT NULL,
  `aid` int(8) DEFAULT '0',
  `inv_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `unit` tinyint(4) NOT NULL,
  `amt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amt` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'amt + tax',
  `paid_flag` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'paid if not 0',
  `trx_id` varchar(250) NOT NULL DEFAULT '0',
  `comments` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `uid`, `aid`, `inv_date`, `start_date`, `end_date`, `unit`, `amt`, `paid_amt`, `paid_flag`, `trx_id`, `comments`) VALUES
(1, 17, 0, '2014-03-17', '2015-03-17', '2015-03-17', 1, 120.00, 0.00, 0, '0', NULL),
(2, 18, 0, '2014-03-18', '2014-03-18', '2015-03-18', 1, 120.00, 0.00, 0, '0', NULL),
(7, 23, 8, '2014-03-18', '2014-03-18', '2015-03-18', 1, 120.00, 0.00, 0, '0', NULL),
(8, 24, 0, '2014-03-18', '2014-03-18', '2015-03-18', 1, 120.00, 0.00, 0, '0', NULL),
(9, 25, 0, '2014-03-18', '2014-03-18', '2015-03-18', 1, 120.00, 0.00, 0, '0', NULL),
(15, 12, 8, '2014-03-19', '2014-03-19', '2015-03-19', 1, 120.00, 0.00, 0, '0', NULL),
(18, 22, 8, '2014-03-19', '2014-03-19', '2015-03-19', 1, 120.00, 0.00, 0, '0', NULL),
(21, 5, 0, '2014-03-19', '2014-03-19', '2014-09-19', 2, 80.00, 0.00, 0, '0', NULL),
(22, 26, 0, '2014-03-23', '2014-03-23', '2015-03-23', 1, 120.00, 0.00, 0, '0', NULL),
(23, 27, 0, '2014-03-23', '2014-03-23', '2015-03-23', 1, 120.00, 0.00, 0, '0', NULL),
(24, 28, 8, '2014-03-23', '2014-03-23', '2015-03-23', 1, 120.00, 0.00, 0, '0', NULL),
(25, 29, 0, '2014-03-27', '2014-03-27', '2015-03-27', 1, 100.00, 0.00, 0, '0', NULL),
(26, 30, 0, '2014-03-27', '2014-03-27', '2015-03-27', 1, 100.00, 0.00, 0, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` varchar(20) NOT NULL DEFAULT 'User',
  `agent_id` smallint(8) NOT NULL DEFAULT '0',
  `sqn1` tinyint(4) NOT NULL DEFAULT '99',
  `sqn2` tinyint(4) NOT NULL DEFAULT '99',
  `name` varchar(250) DEFAULT 'N/A',
  `lname` varchar(50) DEFAULT NULL,
  `birth` date NOT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Inactive',
  `created_date` date DEFAULT NULL,
  `tel` varchar(250) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `height` smallint(8) NOT NULL,
  `weight` smallint(4) NOT NULL DEFAULT '0',
  `ethics` tinyint(4) NOT NULL,
  `religion` tinyint(4) NOT NULL,
  `drink` tinyint(4) NOT NULL,
  `smoke` tinyint(4) NOT NULL,
  `marriage` tinyint(4) NOT NULL,
  `child` tinyint(4) NOT NULL,
  `job` varchar(200) DEFAULT NULL,
  `pay` int(8) DEFAULT '0',
  `nationality` tinyint(4) NOT NULL,
  `edu` tinyint(4) NOT NULL,
  `english` tinyint(4) NOT NULL,
  `chinese` tinyint(4) NOT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `animal` tinyint(4) NOT NULL,
  `star` tinyint(4) NOT NULL,
  `title` varchar(80) NOT NULL,
  `me` text NOT NULL,
  `love` text NOT NULL,
  `money` int(8) DEFAULT NULL,
  `score` int(8) DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL,
  `type` varchar(10) DEFAULT 'Member',
  `img` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `email`, `password`, `role_id`, `agent_id`, `sqn1`, `sqn2`, `name`, `lname`, `birth`, `sex`, `status`, `created_date`, `tel`, `city`, `country`, `height`, `weight`, `ethics`, `religion`, `drink`, `smoke`, `marriage`, `child`, `job`, `pay`, `nationality`, `edu`, `english`, `chinese`, `hobby`, `animal`, `star`, `title`, `me`, `love`, `money`, `score`, `last_visit`, `ip`, `type`, `img`) VALUES
(1, 'webfirm.ca@gmail.com', '0c0dc9ebebb4b35a44911df0940c9d13', 'Admin', 0, 99, 99, 'Admin', 'Zheng', '1981-08-08', '1', 'Active', '2012-05-22', '647-891-2966', '多伦多', '1', 168, 72, 0, 0, 0, 0, 0, 0, '电脑', 0, 1, 0, 0, 0, '', 0, 0, 'Admin', 'Admin demo', 'Admin', NULL, NULL, '2014-03-07 23:19:58', NULL, 'Member', 0),
(2, 'williamzheng.ca@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'Agent', 0, 99, 99, 'Bill', 'Zheng', '1981-09-09', '1', 'Active', '2012-05-24', '', '多伦多', '1', 169, 72, 0, 0, 0, 0, 0, 0, '电脑', 0, 1, 0, 0, 0, '', 0, 0, 'Agent Demo', 'Demo', 'Demo', NULL, NULL, '2014-03-07 23:22:29', NULL, 'Member', 0),
(3, 'aiqidian.ca@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'Agent', 0, 99, 99, '爱起点', '婚介', '0000-00-00', '1', 'Active', '2012-05-26', NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, NULL, 0, 0, '', '', '', NULL, NULL, '2014-03-07 22:59:33', NULL, 'Member', 0),
(5, 'info@myca168.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, '建业', '郑', '1961-04-02', '0', 'Active', '2014-03-02', '', '多伦多', '1', 168, 65, 0, 0, 0, 0, 0, 0, '电脑', NULL, 1, 0, 0, 0, NULL, 0, 0, '单身男找女孩', '单身男找女孩', '单身男找女孩', NULL, NULL, '2014-03-19 11:01:08', NULL, 'Member', 1),
(8, 'agent@hunjie.ca', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'Agent', 0, 99, 99, 'Agent', 'Zheng', '1981-08-08', '1', 'Active', '2014-03-07', '', '多伦多', '1', 168, 75, 1, 1, 1, 1, 1, 1, '电脑', 0, 1, 1, 1, 1, '1', 1, 1, 'Demo', 'Agent', 'Agent', NULL, NULL, '2014-03-25 17:08:51', NULL, 'Member', 1),
(12, 'demo1@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 8, 99, 99, '倡导', '郑', '1961-04-02', '1', 'Active', '2014-03-13', '', '多伦多', '1', 168, 65, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', '单身男找女孩', '单身男找女孩', NULL, NULL, '2014-03-23 13:08:04', NULL, 'Member', 1),
(13, 'demo3@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, 'demo3', '郑', '1981-03-02', '2', 'Active', '2014-03-17', '', '多伦多', '1', 160, 65, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, 'Testing only', 'testing', 'testing', NULL, NULL, NULL, NULL, 'Member', 1),
(14, 'demo5@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, 'demo3', '郑', '1981-03-02', '2', 'Active', '2014-03-17', '', '多伦多', '1', 160, 65, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, 'Testing only', 'testing', 'testing', NULL, NULL, NULL, NULL, 'Member', 1),
(15, 'test@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, 'test', 'Zheng', '1981-03-02', '2', 'Active', '2014-03-17', '', '多伦多', '1', 168, 65, 1, 1, 0, 0, 1, 0, '电脑', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', 'test', 'test', NULL, NULL, NULL, NULL, 'Member', 1),
(17, 'inv@hunjie.ca', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, 'inv', '郑', '1961-04-02', '2', 'Active', '2014-03-17', '', '多伦多', '1', 160, 65, 1, 1, 0, 0, 1, 0, '电脑', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', 'testing', 'testing', NULL, NULL, NULL, NULL, 'Member', 0),
(18, 'doudou@hotmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, 'Dou', '郑', '1981-09-09', '2', 'Active', '2014-03-18', '', '多伦多', '1', 160, 56, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', 'testing', 'testing', NULL, NULL, NULL, NULL, 'Member', 0),
(22, 'newdou@hotmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 8, 99, 99, 'newdou', '郑', '1981-09-09', '2', 'Active', '2014-03-18', '', '多伦多', '1', 169, 65, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', 'testing', 'testing', NULL, NULL, NULL, NULL, 'Member', 0),
(24, 'test24@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, 'test24', '郑', '1981-03-02', '2', 'Active', '2014-03-18', '', '多伦多', '1', 168, 60, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', 'Testing', 'Testing', NULL, NULL, NULL, NULL, 'Member', 1),
(25, 'thank@hotmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, '建业', 'Zheng', '1961-04-02', '2', 'Active', '2014-03-18', '', '多伦多', '1', 168, 72, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, '大多倫多中華文化中心首辦『薪火相傳徵文比賽』', 'test', 'test', NULL, NULL, NULL, NULL, 'Member', 1),
(26, 'zhou@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, 'zhou', 'zhou', '1965-08-09', '1', 'Active', '2014-03-23', '', '多伦多', '1', 168, 0, 1, 1, 0, 0, 1, 0, 'IT', 0, 1, 1, 1, 1, '', 4, 1, 'Test', 'Testing TestingTestingTesting', 'Testing TestingTestingTesting', NULL, NULL, '2014-03-23 15:37:47', NULL, 'Member', 0),
(27, 'zhou1@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, 'zhou1', 'Zheng', '1961-02-03', '1', 'Active', '2014-03-23', '', 'Toronto', '1', 150, 20, 1, 1, 0, 0, 1, 0, '电脑', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', '单身男找女孩', '单身男找女孩', NULL, NULL, '2014-03-23 15:48:12', NULL, 'Member', 0),
(28, 'mymem@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 8, 99, 99, 'mymem', '郑', '1965-09-10', '1', 'Active', '2014-03-23', '', '多伦多', '1', 180, 0, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', '单身男找女孩', '单身男找女孩', NULL, NULL, NULL, NULL, 'Member', 0),
(29, '123@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, '建业', '郑', '1981-09-09', '2', 'Active', '2014-03-27', '', '多伦多', '1', 168, 0, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', '单身男找女孩', '单身男找女孩', NULL, NULL, NULL, NULL, 'Member', 0),
(30, '12345@gmail.com', '3321adcad74c8284ef4d6c6a0b2b6c2a', 'User', 0, 99, 99, '常达', 'Zheng', '1961-04-02', '1', 'Active', '2014-03-27', '', '多伦多', '1', 168, 0, 1, 1, 0, 0, 1, 0, '电脑工程师', 0, 1, 1, 1, 1, '', 1, 1, '单身男找女孩', '单身男找女孩', '单身男找女孩', NULL, NULL, NULL, NULL, 'Member', 0);

-- --------------------------------------------------------

--
-- Table structure for table `msg_stats`
--

CREATE TABLE IF NOT EXISTS `msg_stats` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `msgin` int(8) NOT NULL DEFAULT '0',
  `msgout` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `msg_stats`
--

INSERT INTO `msg_stats` (`id`, `uid`, `msgin`, `msgout`) VALUES
(1, 24, 4, 0),
(2, 8, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `paid_invoice`
--

CREATE TABLE IF NOT EXISTS `paid_invoice` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `uid` int(12) NOT NULL,
  `aid` int(8) DEFAULT '0',
  `inv_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `unit` tinyint(4) NOT NULL,
  `amt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amt` decimal(10,0) NOT NULL DEFAULT '0',
  `paid_flag` tinyint(2) NOT NULL DEFAULT '0',
  `trx_id` varchar(200) DEFAULT '',
  `trx_type` varchar(200) DEFAULT NULL,
  `comments` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `paid_invoice`
--


-- --------------------------------------------------------

--
-- Table structure for table `payers`
--

CREATE TABLE IF NOT EXISTS `payers` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cardtype` varchar(100) DEFAULT NULL,
  `cardnumber` varchar(100) DEFAULT NULL,
  `month_exp` varchar(10) DEFAULT NULL,
  `year_exp` varchar(10) DEFAULT NULL,
  `cvd` varchar(10) DEFAULT NULL,
  `addr1` varchar(255) DEFAULT NULL,
  `addr2` varchar(255) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `paid_amt` decimal(10,2) DEFAULT NULL,
  `inv_id` int(8) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `agent_id` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `payers`
--


-- --------------------------------------------------------

--
-- Table structure for table `paypal_errors`
--

CREATE TABLE IF NOT EXISTS `paypal_errors` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `error_location` varchar(100) DEFAULT NULL COMMENT 'own error msg to indicate where the error came from',
  `error1` varchar(255) DEFAULT NULL COMMENT 'For paypal msg:L_SHORTMESSAGE0',
  `error2` varchar(255) DEFAULT NULL COMMENT 'For paypal msg: L_LONGMESSAGE0',
  `inv_id` int(8) NOT NULL,
  `event_date` datetime NOT NULL,
  `agent_id` smallint(4) NOT NULL DEFAULT '0',
  `amt` decimal(10,2) NOT NULL COMMENT 'total amt',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `paypal_errors`
--


-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE IF NOT EXISTS `rate` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `desc` varchar(20) NOT NULL,
  `month` int(4) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `pkey` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pkey` (`pkey`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `desc`, `month`, `price`, `pkey`) VALUES
(1, '1年', 12, 100, 'r1'),
(2, '6个月', 6, 80, 'r2'),
(3, '3个月', 3, 50, 'r3');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE IF NOT EXISTS `religion` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sqn` tinyint(99) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`id`, `name`, `sqn`) VALUES
(1, '没什么信仰', 9),
(2, '佛教', 99),
(3, '天主教', 99),
(4, '基督教', 99),
(5, '新教徒', 99),
(6, '印度教', 99),
(7, '伊斯兰教', 99),
(8, '犹太教', 99),
(9, '东正教', 99),
(10, '其他', 99);

-- --------------------------------------------------------

--
-- Table structure for table `sex`
--

CREATE TABLE IF NOT EXISTS `sex` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `desc` varchar(30) NOT NULL,
  `sqn` tinyint(4) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sex`
--

INSERT INTO `sex` (`id`, `desc`, `sqn`) VALUES
(1, ' 男', 99),
(2, '女', 99);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `name` varchar(30) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`name`, `detail`, `remark`) VALUES
('address', '71 Ennerdale Road, Toronto, Ontario, Canada M6E 4C5', NULL),
('ads', 'sales@hunjie.ca', NULL),
('billings', 'sales@hunjie.ca', NULL),
('company', 'Caclass Global Inc.', NULL),
('description', '天涯信息是一家面向加拿大华人的生活信息网站，旨在为华人提供一个自由交流的平台。全站突出了互动、实用和免费的特性，设有黄页、分类广告、特价、优惠券、地产、汽车、新闻、论坛、工作、美食等，站点的内容和服务涵盖旅加华人生活的各个方面 !', NULL),
('domain', 'hunjie.ca', NULL),
('fax', '1-647-891-2966', NULL),
('keywords', '天涯信息，天涯信息网，多伦多天涯信息网，加拿大,多伦多,海外中文网,加拿大中文网,多伦多中文网,黄页,二手,分类广告,地产,汽车,招聘,美食,餐厅,特价,优惠券,移民,海外华人,加拿大留学,移民,多伦多移民,新闻,加拿大中文新闻, canada, toronto, chinese,  yellowpages,classifieds,real estate,job,cars,flyers,coupon,food,restaurant, abroad, news, bbs.', NULL),
('online', 'Yes', NULL),
('sales', 'sales@hunjie.ca', NULL),
('tel', '1-647-891-2966', NULL),
('webmaster', 'webmaster@hunjie.ca', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `star`
--

CREATE TABLE IF NOT EXISTS `star` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `sqn` int(11) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `star`
--

INSERT INTO `star` (`id`, `name`, `sqn`) VALUES
(1, '双子座', 99),
(2, '双鱼座', 99),
(3, '处女座', 99),
(4, '天秤座', 99),
(5, '天蝎座', 99),
(6, '射手座', 99),
(7, '巨蟹座', 99),
(8, '水瓶座', 99),
(9, '牡羊座', 99),
(10, '狮子座', 99),
(11, '金牛座', 99),
(12, '魔羯座', 99),
(13, '不知道', 99);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `desc` varchar(50) NOT NULL,
  `sqn` tinyint(4) NOT NULL DEFAULT '99',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `desc`, `sqn`) VALUES
(1, '单身', 99),
(2, '分居', 99),
(3, '丧偶', 99),
(4, '离婚', 99),
(5, '已婚', 99);

-- --------------------------------------------------------

--
-- Table structure for table `unpaid_invoice`
--

CREATE TABLE IF NOT EXISTS `unpaid_invoice` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `uid` int(12) NOT NULL,
  `aid` int(8) DEFAULT '0',
  `inv_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `unit` tinyint(4) NOT NULL,
  `amt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paid_amt` decimal(10,0) NOT NULL DEFAULT '0',
  `paid_flag` tinyint(2) NOT NULL DEFAULT '0',
  `comments` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `unpaid_invoice`
--

INSERT INTO `unpaid_invoice` (`id`, `uid`, `aid`, `inv_date`, `start_date`, `end_date`, `unit`, `amt`, `paid_amt`, `paid_flag`, `comments`) VALUES
(1, 22, 8, '2014-03-18', '2014-03-18', '2015-03-18', 1, 120.00, 0, 0, NULL),
(2, 12, 8, '2014-03-19', '2014-03-19', '2014-09-19', 2, 80.00, 0, 0, NULL),
(3, 22, 8, '2014-03-18', '2014-03-18', '2014-09-18', 2, 80.00, 0, 0, NULL),
(4, 22, 8, '2014-03-18', '2014-03-18', '2015-03-18', 1, 120.00, 0, 0, NULL),
(5, 5, 0, '2014-03-19', '2014-03-19', '2014-06-19', 3, 50.00, 0, 0, NULL),
(6, 5, 0, '2014-03-19', '2014-03-19', '2015-03-19', 1, 120.00, 0, 0, NULL);
