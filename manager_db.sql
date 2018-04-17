-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2018 at 09:12 PM
-- Server version: 5.6.17
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manager_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `match`
--

CREATE TABLE IF NOT EXISTS `match` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_player` int(11) NOT NULL,
  `team_bot` int(11) NOT NULL,
  `goals_player` int(11) NOT NULL,
  `goals_bot` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` enum('goalie','defender','midfielder','striker') COLLATE utf8_unicode_ci DEFAULT NULL,
  `quality` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`name`, `position`, `quality`, `speed`, `id`) VALUES
('Alberto Acevedo', 'goalie', 78, 17, 1),
('Arthur Alexander', 'goalie', 92, 52, 2),
('Ana Abbott', 'goalie', 81, 99, 3),
('Barry Adams', 'goalie', 71, 57, 4),
('Arlene Aguilar', 'goalie', 54, 3, 5),
('Bonnie Albert', 'goalie', 82, 24, 6),
('Arlene Alford', 'goalie', 46, 48, 7),
('Arthur Acosta', 'goalie', 38, 98, 8),
('Alex Adkins', 'goalie', 7, 21, 9),
('bjhlo', 'midfielder', 17, 41, 10),
('Bill Alford', 'striker', 7, 88, 11),
('Ana Alford', 'striker', 51, 90, 12),
('Ana Abbott', 'striker', 27, 32, 13),
('Alberto Acosta', 'striker', 39, 7, 14),
('Allison Acosta', 'striker', 9, 21, 15),
('Allison Albert', 'striker', 24, 86, 16),
('Alberto Aguirre', 'midfielder', 57, 85, 17),
('Bonnie Adams', 'midfielder', 34, 72, 18),
('Alberto Acosta', 'midfielder', 83, 38, 19),
('Arthur Alexander', 'midfielder', 91, 65, 20),
('Bonnie Abbott', 'midfielder', 47, 31, 21),
('Barry Adkins', 'midfielder', 61, 95, 22),
('Arlene Acosta', 'midfielder', 84, 76, 23),
('Bill Adkins', 'defender', 82, 48, 24),
('Alberto Adams', 'defender', 91, 92, 25),
('Alberto Abbott', 'defender', 27, 45, 26),
('Ana Adams', 'defender', 41, 16, 27),
('Alberto Adams', 'defender', 36, 94, 28),
('Barry Aguirre', 'defender', 60, 64, 29),
('Alberto Aguilar', 'defender', 71, 97, 30),
('Barry Aguirre', 'midfielder', 17, 20, 31),
('Allison Alexander', 'goalie', 17, 64, 32),
('Arlene Alford', 'midfielder', 17, 55, 33),
('Alex Abbott', 'striker', 27, 13, 34),
('Arlene Alexander', 'defender', 13, 58, 35),
('Milos Kolovski', 'striker', 86, 60, 36);

-- --------------------------------------------------------

--
-- Table structure for table `player_team`
--

CREATE TABLE IF NOT EXISTS `player_team` (
  `date_of_contract` datetime NOT NULL,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `player_team`
--

INSERT INTO `player_team` (`date_of_contract`, `player_id`, `team_id`, `id`, `is_valid`) VALUES
('2018-04-05 22:16:51', 1, 1, 1, 0),
('2018-04-05 22:32:41', 1, 1, 2, 0),
('2018-04-06 09:53:19', 1, 2, 3, 1),
('2018-04-05 00:00:00', 4, 2, 4, 0),
('2018-04-05 00:00:00', 5, 1, 5, 0),
('2018-04-06 16:08:24', 6, 3, 6, 1),
('2018-04-06 16:08:25', 2, 3, 7, 0),
('2018-04-06 16:08:25', 3, 3, 8, 0),
('2018-04-06 16:27:21', 7, 2, 9, 0),
('2018-04-06 16:27:52', 8, 1, 10, 0),
('2018-04-06 16:27:52', 10, 1, 11, 0),
('2018-04-06 16:27:53', 9, 1, 12, 0),
('2018-04-06 16:28:56', 4, 2, 13, 1),
('2018-04-06 16:46:09', 2, 1, 14, 0),
('2018-04-06 16:46:09', 5, 1, 15, 0),
('2018-04-06 16:46:09', 8, 1, 16, 0),
('2018-04-06 18:19:24', 2, 1, 17, 0),
('2018-04-06 18:20:24', 3, 1, 18, 0),
('2018-04-06 18:20:24', 5, 1, 19, 0),
('2018-04-06 18:25:45', 7, 1, 20, 0),
('2018-04-06 18:27:07', 5, 1, 21, 0),
('2018-04-06 18:30:30', 7, 1, 22, 0),
('2018-04-06 18:30:30', 8, 1, 23, 0),
('2018-04-07 12:45:29', 5, 1, 24, 1),
('2018-04-07 12:45:29', 7, 1, 25, 1),
('2018-04-07 12:45:46', 3, 1, 26, 0),
('2018-04-07 12:46:05', 9, 3, 27, 0),
('2018-04-10 00:17:09', 10, 3, 28, 1),
('2018-04-10 01:18:37', 17, 3, 29, 1),
('2018-04-10 01:18:37', 19, 3, 30, 1),
('2018-04-10 01:18:38', 18, 3, 31, 1),
('2018-04-10 01:18:38', 13, 3, 32, 1),
('2018-04-10 01:18:39', 11, 3, 33, 1),
('2018-04-10 01:18:40', 12, 3, 34, 0),
('2018-04-10 01:18:40', 15, 3, 35, 1),
('2018-04-10 01:18:41', 14, 3, 36, 1),
('2018-04-10 01:18:42', 16, 3, 37, 1),
('2018-04-10 01:18:43', 20, 3, 38, 1),
('2018-04-10 01:18:43', 21, 3, 39, 1),
('2018-04-10 01:18:44', 22, 3, 40, 1),
('2018-04-10 01:18:45', 23, 3, 41, 1),
('2018-04-10 01:18:46', 24, 3, 42, 1),
('2018-04-10 01:18:47', 25, 3, 43, 1),
('2018-04-10 01:18:47', 26, 3, 44, 1),
('2018-04-10 01:18:48', 27, 3, 45, 1),
('2018-04-10 01:20:13', 29, 3, 46, 0),
('2018-04-10 01:20:13', 28, 3, 47, 0),
('2018-04-10 01:26:53', 31, 3, 48, 0),
('2018-04-10 01:27:27', 33, 3, 49, 0),
('2018-04-10 12:39:35', 2, 3, 50, 0),
('2018-04-10 12:39:35', 30, 3, 51, 0),
('2018-04-10 12:39:36', 32, 3, 52, 0),
('2018-04-10 12:39:37', 8, 3, 53, 0),
('2018-04-10 12:39:38', 3, 3, 54, 0),
('2018-04-10 12:39:39', 9, 3, 55, 0),
('2018-04-10 12:39:40', 12, 3, 56, 1),
('2018-04-10 18:59:49', 31, 2, 57, 1),
('2018-04-10 20:44:18', 34, 5, 58, 0);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rank` double NOT NULL,
  `formation` enum('f442o','f442d','f442h','f541o','f541d','f541h','f343o','f343d','f343h') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `rank`, `formation`) VALUES
(1, 'Dummy4826', 50, NULL),
(2, 's', 56, NULL),
(3, 'jjo', 51, NULL),
(4, 'Dummy3380', 1, NULL),
(5, 'Ranks', 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
