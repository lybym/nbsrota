-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-05-01 20:51:43
-- 服务器版本： 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `rota_dayinfo`
--

CREATE TABLE `rota_dayinfo` (
  `timenum` int(10) UNSIGNED NOT NULL,
  `hoilday` int(10) UNSIGNED NOT NULL,
  `others` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `rota_dayinfo`
--

INSERT INTO `rota_dayinfo` (`timenum`, `hoilday`, `others`) VALUES
(15249312, 1, 0),
(15250176, 1, 0),
(15251040, 1, 0),
(15248448, 2, 0),
(15228576, 1, 0),
(15229440, 1, 0),
(15230304, 1, 0),
(15231168, 2, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
