-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015 m. Spa 26 d. 21:41
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
`authorId` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `authors`
--

INSERT INTO `authors` (`authorId`, `name`) VALUES
(1, 'Chris Smith'),
(2, 'Steven Levithan'),
(3, ' Jan Goyvaerts'),
(4, 'Ryan Benedetti'),
(5, ' Al Anderson'),
(6, 'Clay Breshears'),
(7, 'Kevlin Henney');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `author_books`
--

CREATE TABLE IF NOT EXISTS `author_books` (
`id` int(11) NOT NULL,
  `authorId` int(11) DEFAULT NULL,
  `bookId` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `author_books`
--

INSERT INTO `author_books` (`id`, `authorId`, `bookId`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 4, 3),
(4, 6, 4),
(5, 7, 5),
(6, 7, 7),
(8, 3, 5),
(9, 5, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `books`
--

CREATE TABLE IF NOT EXISTS `books` (
`bookId` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `genreId` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `books`
--

INSERT INTO `books` (`bookId`, `title`, `year`, `genreId`) VALUES
(1, 'Programming F# 3.0, 2nd Edition', 2012, 3),
(2, 'Regular Expressions Cookbook, 2nd Edition', 2012, 3),
(3, 'Head First Networking', 2009, 1),
(4, 'The Art of Concurrency', 2009, 1),
(5, '97 Things Every Programmer Should Know', 2010, 1),
(7, 'Version Control with Git, 2nd Edition', 2012, 3);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Unknown'),
(2, 'Triller'),
(3, ' Sci-fi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
 ADD PRIMARY KEY (`authorId`);

--
-- Indexes for table `author_books`
--
ALTER TABLE `author_books`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
 ADD PRIMARY KEY (`bookId`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
MODIFY `authorId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `author_books`
--
ALTER TABLE `author_books`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
MODIFY `bookId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
