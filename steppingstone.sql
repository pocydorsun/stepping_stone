-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2015 at 07:20 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`cost_id`, `source_id`, `destination_id`, `cost`) VALUES
(13, 1, 1, 1),
(14, 1, 2, 2),
(15, 1, 3, 3),
(16, 2, 1, 3),
(20, 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
`id` int(11) NOT NULL,
  `destination_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `destination_name`) VALUES
(1, 'โกดัง A'),
(2, 'โกดัง B'),
(3, 'โกดัง C'),
(4, 'บ้าน'),
(5, '555'),
(6, 'โกดัง D');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
`id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_source` text,
  `plan_destination` text,
  `plan_cost` text,
  `plan_status` int(11) NOT NULL DEFAULT '0',
  `plan_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `plan_name`, `plan_source`, `plan_destination`, `plan_cost`, `plan_status`, `plan_date`) VALUES
(1, 'แผนแรก', '[{"id":"1","source_name":"โรงงาน A","capacity":30},{"id":"2","source_name":"โรงงาน B","capacity":60},{"id":"3","source_name":"โรงงาน C","capacity":30}]', '[{"id":"1","destination_name":"โกดัง A","capacity":20},{"id":"2","destination_name":"โกดัง B","capacity":25},{"id":"3","destination_name":"โกดัง C","capacity":55},{"id":"6","destination_name":"โกดัง D","capacity":20}]', '[{"source_id":"1","destination_id":"1","cost":8},{"source_id":"1","destination_id":"2","cost":8},{"source_id":"1","destination_id":"3","cost":4},{"source_id":"1","destination_id":"6","cost":7},{"source_id":"2","destination_id":"1","cost":9},{"source_id":"2","destination_id":"2","cost":2},{"source_id":"2","destination_id":"3","cost":6},{"source_id":"2","destination_id":"6","cost":9},{"source_id":"3","destination_id":"1","cost":7},{"source_id":"3","destination_id":"2","cost":9},{"source_id":"3","destination_id":"3","cost":5},{"source_id":"3","destination_id":"6","cost":3}]', 0, '2015-04-27 13:45:25'),
(2, '555', '[{"id":"4","source_name":"บ้าน","capacity":1}]', '[{"id":"5","destination_name":"555","capacity":2}]', '[{"source_id":"4","destination_id":"5","cost":"5"}]', 0, '2015-04-27 13:51:14'),
(3, 'umm', '[{"id":"1","source_name":"โรงงาน A","capacity":3}]', '[{"id":"1","destination_name":"โกดัง A","capacity":3}]', '[{"source_id":"1","destination_id":"1","cost":"1"}]', 0, '2015-04-27 16:48:13'),
(4, 'test', '[{"id":"4","source_name":"บ้าน","capacity":1},{"id":"1","source_name":"โรงงาน A","capacity":2}]', '[{"id":"5","destination_name":"555","capacity":1},{"id":"2","destination_name":"โกดัง B","capacity":2}]', '[{"source_id":"4","destination_id":"5","cost":0},{"source_id":"1","destination_id":"5","cost":0},{"source_id":"1","destination_id":"2","cost":"2"},{"source_id":"4","destination_id":"2","cost":33}]', 0, '2015-04-27 17:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
`id` int(11) NOT NULL,
  `source_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `source_name`) VALUES
(1, 'โรงงาน A'),
(2, 'โรงงาน B'),
(3, 'โรงงาน C'),
(4, 'บ้าน'),
(5, '555');

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
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `firstname`, `lastname`) VALUES
(2, 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin', 'สุธี', 'กลิ่นคง'),
(24, 'userid', '1bbd886460827015e5d605ed44252251', 'user', 'สุธี', 'กลิ่นคง'),
(54, 'pocydorsun', '25d55ad283aa400af464c76d713c07ad', 'user', 'คนเหงา', 'กินเหล้าเพียว');

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
MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
