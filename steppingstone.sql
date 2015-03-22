-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2015 at 06:34 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `steppingstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE IF NOT EXISTS `cost` (
`cost_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`cost_id`, `source_id`, `destination_id`, `cost`) VALUES
(3, 1, 3, 0),
(4, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
`id` int(11) NOT NULL,
  `destination_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `destination_name`) VALUES
(1, 'โรงงาน A'),
(2, 'โรงงาน B'),
(3, 'โรงงาน C'),
(4, 'โรงงาน D');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
`id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_source` text,
  `plan_destination` text,
  `plan_status` int(11) NOT NULL DEFAULT '0',
  `plan_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `plan_name`, `plan_source`, `plan_destination`, `plan_status`, `plan_date`) VALUES
(16, 'แผน A', '[{"id":"1","name":"โรงงาน A","capacity":5},{"id":"2","name":"โรงงาน B","capacity":10}]', '[{"id":"3","name":"โรงงาน C","capacity":7},{"id":"4","name":"โรงงาน D","capacity":12}]', 0, '2015-03-11 21:20:43'),
(17, 'sssss', '[{"id":"1","name":"โรงงาน A","capacity":5},{"id":"2","name":"โรงงาน B","capacity":10}]', '[{"id":"3","name":"โรงงาน C","capacity":10},{"id":"4","name":"โรงงาน D","capacity":5}]', 0, '2015-03-12 13:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
`id` int(11) NOT NULL,
  `source_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `source_name`) VALUES
(1, 'โรงงาน A'),
(2, 'โรงงาน B'),
(3, 'โรงงาน C'),
(4, 'โรงงาน D');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` tinyint(4) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` enum('admin','user','','') CHARACTER SET utf8 NOT NULL DEFAULT 'user',
  `firstname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `firstname`, `lastname`) VALUES
(2, 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin', '', ''),
(24, 'userid', '25d55ad283aa400af464c76d713c07ad', 'user', 'สุธี', 'กลิ่นคง');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
 ADD PRIMARY KEY (`cost_id`), ADD KEY `target_id1` (`source_id`,`destination_id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
