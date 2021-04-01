-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2021 年 04 月 01 日 15:28
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
-- 資料表結構 `link_cate`
--

CREATE TABLE `link_cate` (
  `id` int(11) NOT NULL,
  `catename` varchar(50) NOT NULL,
  `display` smallint(6) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `init_time` datetime NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `link_cate`
--

INSERT INTO `link_cate` (`id`, `catename`, `display`, `sort`, `init_time`, `update_time`) VALUES
(1, '政府輔導外銷資源', 1, 41, '0000-00-00 00:00:00', '2021-04-01 07:13:58'),
(2, '海外市場資訊', 1, 31, '0000-00-00 00:00:00', '2021-04-01 07:14:02'),
(3, '數位轉型專區', 1, 21, '0000-00-00 00:00:00', '2021-04-01 07:14:06'),
(4, '海外拓銷工具', 1, 11, '0000-00-00 00:00:00', '2021-04-01 07:14:09');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `link_cate`
--
ALTER TABLE `link_cate`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `link_cate`
--
ALTER TABLE `link_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
