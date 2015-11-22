-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015 m. Lap 22 d. 20:25
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_patterns`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned DEFAULT NULL,
  `comment_text` varchar(144) DEFAULT NULL,
  `comment_author` varchar(50) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `comments`
--

INSERT INTO `comments` (`id`, `topic_id`, `comment_text`, `comment_author`, `created_date`) VALUES
(14, 1, 'labas', 'User1', '2015-11-22 06:11:39'),
(15, 1, 'labas', 'User1', '2015-11-22 06:11:42'),
(16, 2, 'Labas', 'User2', '2015-11-22 06:11:10');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
`id` int(10) unsigned NOT NULL,
  `topic_name` varchar(50) DEFAULT NULL,
  `comment_count` int(10) unsigned DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `topics`
--

INSERT INTO `topics` (`id`, `topic_name`, `comment_count`, `created_date`) VALUES
(1, 'Tema nr. 1', 2, '2015-11-22 19:19:12'),
(2, 'Tema nr. 2', 1, '2015-11-22 19:21:10'),
(3, 'Tema nr. 3', 0, '2015-11-22 19:19:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
