-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2015 at 12:59 PM
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
  `cost` int(11) NOT NULL DEFAULT '0',
  `cost_status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`cost_id`, `source_id`, `destination_id`, `cost`, `cost_status`) VALUES
(25, 13, 13, 3, 'ยกเลิกการใช้งาน'),
(26, 13, 13, 20, 'ยกเลิกการใช้งาน'),
(27, 13, 13, 30, 'ใช้งานอยู่');

-- --------------------------------------------------------

--
-- Table structure for table `cost_of_plan`
--

CREATE TABLE IF NOT EXISTS `cost_of_plan` (
`id` int(11) NOT NULL,
  `transportation_id` int(11) unsigned NOT NULL,
  `source_id` int(11) unsigned NOT NULL,
  `destination_id` int(11) unsigned NOT NULL,
  `cost` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=331 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
`id` int(11) NOT NULL,
  `destination_name` varchar(255) NOT NULL,
  `destination_status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `destination_name`, `destination_status`) VALUES
(13, 'a', 'ใช้งานอยู่');

-- --------------------------------------------------------

--
-- Table structure for table `list_plan`
--

CREATE TABLE IF NOT EXISTS `list_plan` (
`id` int(11) NOT NULL,
  `transportation_id` int(11) unsigned NOT NULL,
  `target_id` int(11) unsigned NOT NULL,
  `target_type` int(11) unsigned NOT NULL,
  `capacity` int(11) unsigned NOT NULL,
  `sequence` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
`id` int(11) NOT NULL,
  `source_name` varchar(255) NOT NULL,
  `source_status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `source_name`, `source_status`) VALUES
(13, 'ก', 'ยกเลิกการใช้งาน');

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE IF NOT EXISTS `transportation` (
`id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `number_of_source` int(11) unsigned NOT NULL,
  `number_of_destination` int(11) unsigned NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plan_status` varchar(100) NOT NULL DEFAULT 'ยังไม่อนุมัติ',
  `id_of_owner` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` tinyint(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('admin','user','','') NOT NULL DEFAULT 'user',
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `user_status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `firstname`, `lastname`, `user_status`) VALUES
(2, 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin', 'สุธี', 'กลิ่นคง', ''),
(57, 'user01', '25d55ad283aa400af464c76d713c07ad', 'user', 'หล้อหล่อ', 'มาก', 'ใช้งานอยู่'),
(58, '55555555', '974ebe39a1af75a9be4097abced3e3f8', 'user', '555', '444', 'ยกเลิกการใช้งาน'),
(59, '46464646464', 'fabdc22a1e12850c1b11a8280b271c5b', 'user', '4446464646', '46464646464', 'ใช้งานอยู่'),
(60, 'errbuggy', 'a3b02e07c21a0c60b8d70952d3ee4459', 'user', 'กาก', 'เกรียน', 'ใช้งานอยู่');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
 ADD PRIMARY KEY (`cost_id`), ADD KEY `target_id1` (`source_id`,`destination_id`);

--
-- Indexes for table `cost_of_plan`
--
ALTER TABLE `cost_of_plan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_plan`
--
ALTER TABLE `list_plan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
 ADD PRIMARY KEY (`id`), ADD KEY `id_of_owner` (`id_of_owner`), ADD KEY `id_of_owner_2` (`id_of_owner`), ADD KEY `id_of_owner_3` (`id_of_owner`), ADD KEY `id_of_owner_4` (`id_of_owner`);

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
MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `cost_of_plan`
--
ALTER TABLE `cost_of_plan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=331;
--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `list_plan`
--
ALTER TABLE `list_plan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
