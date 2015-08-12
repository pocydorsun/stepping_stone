-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 12, 2015 at 09:07 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

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
-- Table structure for table `cost_of_plan`
--

CREATE TABLE IF NOT EXISTS `cost_of_plan` (
  `id` int(11) NOT NULL,
  `transportation_id` int(11) unsigned NOT NULL,
  `source_id` int(11) unsigned NOT NULL,
  `destination_id` int(11) unsigned NOT NULL,
  `cost` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cost_of_plan`
--

INSERT INTO `cost_of_plan` (`id`, `transportation_id`, `source_id`, `destination_id`, `cost`) VALUES
(10, 2, 1, 1, 1),
(11, 2, 2, 1, 3),
(12, 2, 3, 1, 0),
(13, 2, 1, 2, 2),
(14, 2, 2, 2, 0),
(15, 2, 3, 2, 0),
(16, 2, 1, 3, 3),
(17, 2, 2, 3, 0),
(18, 2, 3, 3, 0),
(136, 3, 1, 3, 13),
(137, 3, 1, 4, 13),
(138, 3, 1, 5, 13),
(139, 3, 2, 3, 13),
(140, 3, 2, 4, 13),
(141, 3, 2, 5, 13),
(142, 3, 3, 3, 13),
(143, 3, 3, 4, 13),
(144, 3, 3, 5, 13),
(145, 3, 1, 1, 1),
(146, 3, 2, 1, 3),
(147, 3, 3, 1, 0),
(148, 3, 4, 3, 0),
(149, 3, 4, 4, 0),
(150, 3, 4, 5, 0),
(151, 3, 4, 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list_plan`
--

INSERT INTO `list_plan` (`id`, `transportation_id`, `target_id`, `target_name`, `target_type`, `capacity`, `sequence`) VALUES
(7, 2, 1, 'โรงงาน A', 1, 0, 1),
(8, 2, 2, 'โรงงาน B', 1, 0, 2),
(9, 2, 3, 'โรงงาน C', 1, 0, 3),
(10, 2, 1, 'โกดัง A', 2, 0, 1),
(11, 2, 2, 'โกดัง B', 2, 0, 2),
(12, 2, 3, 'โกดัง C', 2, 0, 3),
(82, 3, 1, 'โรงงาน A', 1, 2, 1),
(83, 3, 2, 'โรงงาน B', 1, 4, 2),
(84, 3, 3, 'โรงงาน C', 1, 8, 3),
(85, 3, 4, 'บ้าน', 1, 0, 4),
(86, 3, 3, 'โกดัง C', 2, 2, 1),
(87, 3, 4, 'บ้าน', 2, 1, 2),
(88, 3, 5, '555', 2, 0, 3),
(89, 3, 1, 'โกดัง A', 2, 0, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`id`, `plan_name`, `number_of_source`, `number_of_destination`, `create_date`, `plan_status`, `id_of_owner`) VALUES
(2, 'ไร้สาระ', 3, 3, '2015-08-12 11:52:37', 'ยังไม่อนุมัติ', 56),
(3, 'okletsgo23', 3, 3, '2015-08-12 13:25:37', 'ยังไม่อนุมัติ', 56);

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
  `lastname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `firstname`, `lastname`) VALUES
(2, 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin', 'สุธี', 'กลิ่นคง'),
(24, 'userid', '1bbd886460827015e5d605ed44252251', 'user', 'สุธี', 'กลิ่นคง'),
(54, 'pocydorsun', '25d55ad283aa400af464c76d713c07ad', 'user', 'คนเหงา', 'กินเหล้าเพียว'),
(56, 'errbuggy', 'a3b02e07c21a0c60b8d70952d3ee4459', 'user', 'แว่น', 'คุง');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`cost_id`),
  ADD KEY `target_id1` (`source_id`,`destination_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_of_owner` (`id_of_owner`),
  ADD KEY `id_of_owner_2` (`id_of_owner`),
  ADD KEY `id_of_owner_3` (`id_of_owner`),
  ADD KEY `id_of_owner_4` (`id_of_owner`);

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
-- AUTO_INCREMENT for table `cost_of_plan`
--
ALTER TABLE `cost_of_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `list_plan`
--
ALTER TABLE `list_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
