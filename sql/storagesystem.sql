-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-12-08 06:59:23
-- 伺服器版本: 10.1.28-MariaDB
-- PHP 版本： 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `storagesystem`
--

-- --------------------------------------------------------

--
-- 資料表結構 `logindata`
--

CREATE TABLE `logindata` (
  `l_id` int(10) NOT NULL,
  `l_username` varchar(30) NOT NULL,
  `l_password` varchar(100) NOT NULL,
  `l_checkUser` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `logindata`
--

INSERT INTO `logindata` (`l_id`, `l_username`, `l_password`, `l_checkUser`) VALUES
(1, 'kpvs', 'b8f88a0014527495f6eb3af9431be45b', 'b8f88a0014527495f6eb3af9431be45b');

-- --------------------------------------------------------

--
-- 資料表結構 `storage_classlist`
--

CREATE TABLE `storage_classlist` (
  `sc_id` int(10) NOT NULL,
  `sc_className` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `storage_itemlist`
--

CREATE TABLE `storage_itemlist` (
  `si_id` int(10) NOT NULL,
  `si_item` varchar(20) NOT NULL,
  `si_unit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `storage_record`
--

CREATE TABLE `storage_record` (
  `sr_id` int(10) NOT NULL,
  `sr_item` varchar(30) NOT NULL,
  `sr_amount` int(10) NOT NULL,
  `sr_location` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `logindata`
--
ALTER TABLE `logindata`
  ADD PRIMARY KEY (`l_id`);

--
-- 資料表索引 `storage_classlist`
--
ALTER TABLE `storage_classlist`
  ADD PRIMARY KEY (`sc_id`);

--
-- 資料表索引 `storage_itemlist`
--
ALTER TABLE `storage_itemlist`
  ADD PRIMARY KEY (`si_id`);

--
-- 資料表索引 `storage_record`
--
ALTER TABLE `storage_record`
  ADD PRIMARY KEY (`sr_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `logindata`
--
ALTER TABLE `logindata`
  MODIFY `l_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `storage_classlist`
--
ALTER TABLE `storage_classlist`
  MODIFY `sc_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `storage_itemlist`
--
ALTER TABLE `storage_itemlist`
  MODIFY `si_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `storage_record`
--
ALTER TABLE `storage_record`
  MODIFY `sr_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
