-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2015 at 03:12 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`cost_id`, `source_id`, `destination_id`, `cost`) VALUES
(21, 6, 7, 3),
(22, 7, 9, 2),
(23, 8, 7, 4),
(24, 6, 10, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cost_of_plan`
--

INSERT INTO `cost_of_plan` (`id`, `transportation_id`, `source_id`, `destination_id`, `cost`) VALUES
(207, 4, 6, 7, 3),
(208, 4, 7, 7, 1),
(209, 4, 8, 7, 4),
(210, 4, 6, 8, 1),
(211, 4, 7, 8, 1),
(212, 4, 8, 8, 1),
(213, 4, 6, 9, 1),
(214, 4, 7, 9, 2),
(215, 4, 8, 9, 1),
(216, 4, 6, 10, 2),
(217, 4, 7, 10, 1),
(218, 4, 8, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
`id` int(11) NOT NULL,
  `destination_name` varchar(255) NOT NULL,
  `destination_status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `destination_name`, `destination_status`) VALUES
(7, 'คลังสินค้า x', 'ใช้งานอยู่'),
(8, 'คลังสินค้า y', 'ใช้งานอยู่'),
(9, 'คลังสินค้า z', 'ใช้งานอยู่'),
(10, 'คลังสินค้า m', 'ยกเลิกการใช้งาน');

-- --------------------------------------------------------

--
-- Table structure for table `list_plan`
--

CREATE TABLE IF NOT EXISTS `list_plan` (
`id` int(11) NOT NULL,
  `transportation_id` int(11) unsigned NOT NULL,
  `target_id` int(11) unsigned NOT NULL,
  `target_name` varchar(255) NOT NULL,
  `target_type` int(11) unsigned NOT NULL,
  `capacity` int(11) unsigned NOT NULL,
  `sequence` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list_plan`
--

INSERT INTO `list_plan` (`id`, `transportation_id`, `target_id`, `target_name`, `target_type`, `capacity`, `sequence`) VALUES
(123, 4, 6, 'โรงงาน ก', 1, 150, 1),
(124, 4, 7, 'โรงงาน ข', 1, 200, 2),
(125, 4, 8, 'โรงงาน ค', 1, 250, 3),
(126, 4, 7, 'คลังสินค้า x', 2, 180, 1),
(127, 4, 8, 'คลังสินค้า y', 2, 220, 2),
(128, 4, 9, 'คลังสินค้า z', 2, 100, 3),
(129, 4, 10, 'คลังสินค้า m', 2, 100, 4);

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
`id` int(11) NOT NULL,
  `source_name` varchar(255) NOT NULL,
  `source_status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `source_name`, `source_status`) VALUES
(6, 'โรงงาน ก', 'ใช้งานอยู่'),
(7, 'โรงงาน ข', 'ใช้งานอยู่'),
(8, 'โรงงาน ค', 'ยกเลิกการใช้งาน');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`id`, `plan_name`, `number_of_source`, `number_of_destination`, `create_date`, `plan_status`, `id_of_owner`) VALUES
(4, 'กกกกกก', 4, 4, '2015-08-16 15:24:04', 'ยังไม่อนุมัติ', 57);

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `firstname`, `lastname`, `user_status`) VALUES
(2, 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin', 'สุธี', 'กลิ่นคง', ''),
(57, 'user01', '25d55ad283aa400af464c76d713c07ad', 'user', 'หล้อหล่อ', 'มาก', 'ใช้งานอยู่'),
(58, '55555555', '974ebe39a1af75a9be4097abced3e3f8', 'user', '555', '444', 'ยกเลิกการใช้งาน'),
(59, '46464646464', 'fabdc22a1e12850c1b11a8280b271c5b', 'user', '4446464646', '46464646464', 'ใช้งานอยู่');

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
MODIFY `cost_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `cost_of_plan`
--
ALTER TABLE `cost_of_plan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=219;
--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `list_plan`
--
ALTER TABLE `list_plan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
