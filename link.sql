-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2021 年 04 月 01 日 15:29
-- 伺服器版本： 5.7.33
-- PHP 版本： 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `chunmu_exportadv`
--

-- --------------------------------------------------------

--
-- 資料表結構 `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT '',
  `description` varchar(100) DEFAULT NULL,
  `type` int(11) DEFAULT '1',
  `display` int(11) NOT NULL DEFAULT '1',
  `sort` int(11) DEFAULT '999' COMMENT '排序',
  `url` varchar(500) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `content` text,
  `MetaTitle` varchar(4000) DEFAULT NULL,
  `MetaDesc` varchar(4000) DEFAULT NULL,
  `MetaKeywords` varchar(4000) DEFAULT NULL,
  `Last_UserId` varchar(20) DEFAULT NULL,
  `init_time` date NOT NULL,
  `Last_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `link`
--

INSERT INTO `link` (`id`, `title`, `description`, `type`, `display`, `sort`, `url`, `pic`, `content`, `MetaTitle`, `MetaDesc`, `MetaKeywords`, `Last_UserId`, `init_time`, `Last_time`) VALUES
(3, '貿協全球資訊網', NULL, 2, 1, 41, 'https://www.taitraesource.com/default.asp', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:27:33'),
(2, '政府輔導外銷資源', NULL, 1, 1, 11, 'https://docs.google.com/spreadsheets/d/1XGr22ow9As7gy0yO5_1EDwelrQq1dUBas4gblXrA6jE/edit?usp=sharing', NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-01', '2021-04-01 07:04:44'),
(4, '海外參展決策輔助平台', NULL, 2, 1, 21, 'http://www.tsp.org.tw/', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:27:31'),
(5, 'iTrade全球貿易大數據', NULL, 2, 1, 31, 'http://itrade.taitra.org.tw/?_ga=2.68217233.1083193909.1609090490-1411834324.1605109940', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:27:38'),
(6, '視訊會議軟體操作分享', NULL, 3, 1, 51, 'https://www.exportadv.com.tw/zh-tw/menu/8CEB14A6DCF4E70CD0636733C6861689/info.html', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:27:35'),
(7, 'AIoT商情', NULL, 3, 1, 61, 'https://info.taiwantrade.com/biznews/%E7%89%A9%E8%81%AF%E7%B6%B2%20IoT%20AIoT%20AI-search.html?match=2&_ga=2.117056134.1083193909.1609090490-1411834324.1605109940#menu=11607', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:27:40'),
(8, '台灣經貿網SEO小學堂', NULL, 3, 1, 71, 'https://taiwantradeseo.blogspot.com/', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:27:43'),
(9, '電商行銷課程', NULL, 3, 1, 81, 'https://info.taiwantrade.com/promotion/eclass?_ga=2.117056134.1083193909.1609090490-1411834324.1605109940#menu=11608', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:17:07'),
(10, '電商研討會', NULL, 3, 1, 91, 'https://info.taiwantrade.com/promotion/event?_ga=2.117056134.1083193909.1609090490-1411834324.1605109940#menu=11608', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:17:24'),
(11, '數位基地', NULL, 3, 1, 101, 'https://gd.taiwantrade.com/?_ga=2.117056134.1083193909.1609090490-1411834324.1605109940', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:18:03'),
(12, '清真推廣中心', NULL, 4, 1, 111, 'https://thpc.taiwantrade.com/?_ga=2.135399089.1083193909.1609090490-1411834324.1605109940', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:21:26'),
(13, '台灣精品', NULL, 4, 1, 121, 'http://www.taiwanexcellence.org/', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:21:41'),
(14, '臺灣經貿網', NULL, 4, 1, 131, 'http://info.taiwantrade.com/CH/?_ga=2.135399089.1083193909.1609090490-1411834324.1605109940', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:21:55'),
(15, '推廣服務貿易', NULL, 4, 1, 141, 'http://www.taiwanservices.com.tw/', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:22:11'),
(16, '臺灣國際專業展', NULL, 4, 1, 151, 'http://www.taiwantradeshows.com.tw/zh_TW/index.html', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:22:26'),
(17, '國際市場開發專案Plus', NULL, 4, 1, 161, 'https://events.taiwantrade.com.tw/imdplus?_ga=2.135399089.1083193909.1609090490-1411834324.1605109940', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:22:43'),
(18, '海外商務中心', NULL, 4, 1, 171, 'https://info.taiwantrade.com/subject/obc?_ga=2.117056134.1083193909.1609090490-1411834324.1605109940', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:22:59'),
(19, '活動匯', NULL, 4, 1, 181, 'https://events.taiwantrade.com/', NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '2021-04-01 07:23:28');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
