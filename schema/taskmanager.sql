-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2014 at 01:43 PM
-- Server version: 5.5.37
-- PHP Version: 5.4.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dev_quickweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `date` int(10) DEFAULT NULL,
  `done` tinyint(1) unsigned DEFAULT '0',
  `added_at` int(10) unsigned DEFAULT NULL COMMENT 'Timestamp when the entry was added',
  `modified_at` int(10) unsigned DEFAULT NULL COMMENT 'Timestamp when the entry was modified',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT 'Entry status',
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Tasks' AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `date`, `done`, `added_at`, `modified_at`, `status`) VALUES
(1, 'Task 1', 'Task 1 description', 1399249212, 0, 1399238212, 1399305208, 1),
(2, 'Task 2', 'Task 2 description', 1399249212, 1, 1399238212, 1399469612, 1),
(3, 'Task 3', 'Task 3 description', NULL, 1, 1399248512, 1399469508, 1),
(4, 'Task 4', 'Task 4 description', 0, 1, 1399248512, 1399469451, 1),
(5, 'Task 5', 'Task 5 description', 1399582800, 1, 1399248546, 1399469538, 1),
(6, 'Task 6', 'Task 6 description', NULL, 1, 1399248546, 1399469539, 1),
(7, 'Task 7', 'Task 7 description', 0, 1, 1399248633, 1399468960, 1),
(8, 'Task 8', 'Task 8 description', 1399323600, 1, 1399248633, 1399469358, 1),
(9, 'Task 9', 'Task 9 description', 0, 1, 1399248642, 1399468920, 1),
(10, 'Task 10', 'Task 10 description', 1399237200, 0, 1399248642, 1399409900, 0),
(20, 'Task 11', 'Task 11 description', 1399410000, 0, 1399261035, 1399409869, 0),
(22, 'Name 1', 'Description number 1', 1399410000, 1, 1399303726, 1399469317, 1),
(23, 'test', 'test', 1399496400, 1, 1399410967, 1399468954, 1);

--
-- Triggers `tasks`
--
DROP TRIGGER IF EXISTS `tasks_before_insert`;
DELIMITER //
CREATE TRIGGER `tasks_before_insert` BEFORE INSERT ON `tasks`
 FOR EACH ROW SET
    NEW.`added_at` = IFNULL(NEW.`added_at`, UNIX_TIMESTAMP())
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tasks_before_update`;
DELIMITER //
CREATE TRIGGER `tasks_before_update` BEFORE UPDATE ON `tasks`
 FOR EACH ROW SET
    NEW.`modified_at` = UNIX_TIMESTAMP()
//
DELIMITER ;
