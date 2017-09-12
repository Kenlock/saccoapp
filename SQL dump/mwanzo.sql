-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2017 at 05:47 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mwanzo`
--

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(50) NOT NULL,
  `groupname` varchar(50) DEFAULT NULL,
  `nid` int(50) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `date_paid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `groupname`, `nid`, `amount`, `date_paid`) VALUES
(1, NULL, 28131989, '2000', '2017-08-23 17:37:14'),
(2, NULL, 22334455, '2000', '2017-08-23 17:37:27'),
(3, 'kisewe', NULL, '5000', '2017-08-23 17:49:18'),
(4, 'kiomo', NULL, '5000', '2017-08-23 17:51:20'),
(5, 'kiomo', NULL, '5000', '2017-08-23 18:06:53'),
(6, 'kiomo', NULL, '5000', '2017-08-23 18:07:18'),
(7, 'kiomo', NULL, '5000', '2017-08-23 18:07:43'),
(8, 'mtihani', NULL, '5000', '2017-08-23 21:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(50) NOT NULL,
  `groupname` varchar(255) NOT NULL,
  `nid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `groupname`, `nid`) VALUES
(1, 'Kisewe', 28131971),
(2, 'Kisewe', 30117367),
(3, 'Kisewe', 11234567),
(4, 'KIOMO', 12345678),
(5, 'KIOMO', 12345578),
(6, 'Mtihani', 222222222),
(7, 'Mtihani', 333333333);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(50) NOT NULL,
  `nid` int(50) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `date_awarded` varchar(255) NOT NULL,
  `principal` varchar(255) NOT NULL,
  `loan_period` int(50) NOT NULL,
  `interest` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `loan_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `nid`, `groupname`, `date_awarded`, `principal`, `loan_period`, `interest`, `amount`, `loan_status`) VALUES
(1, 28131989, NULL, '2017-08-25 19:33:54', '10500', 3, '302.16666666667', 10878, 'active'),
(2, 30117367, NULL, '2017-08-25 19:34:19', '4800', 4, '104', 4992, 'active'),
(3, 28131971, NULL, '2017-08-25 19:43:24', '3520', 4, '76.266666666667', 3661, 'active'),
(4, 22334455, NULL, '2017-08-25 19:45:41', '3600', 3, '103.6', 3730, 'active'),
(5, 333333333, NULL, '2017-08-25 19:59:52', '10240', 4, '221.86666666667', 10650, 'active'),
(10, NULL, 'KIOMO', '2017-08-25 23:39:18', '2400', 5, '41.6', 2496, 'active'),
(11, NULL, 'Kisewe', '2017-08-25 23:57:49', '2640', 5, '45.76', 2746, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayments`
--

CREATE TABLE `loan_repayments` (
  `id` int(50) NOT NULL,
  `loan_id` int(50) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date_paid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_repayments`
--

INSERT INTO `loan_repayments` (`id`, `loan_id`, `amount`, `date_paid`) VALUES
(1, 11, '45.76', '2017-08-29 18:25:50'),
(2, 11, '45.76', '2017-08-29 18:32:06'),
(3, 2, '104', '2017-08-29 18:57:29'),
(4, 1, '302.16666666667', '2017-08-30 22:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `nid` int(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `membership_type` varchar(255) NOT NULL DEFAULT 'individual'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fname`, `nid`, `address`, `phone`, `membership_type`) VALUES
(1, 'Daniel Katumbi', 28131989, '43 Kitui', '0727991247', 'individual'),
(2, 'George Magoha', 22334455, '201 Moyale', '0733676578', 'individual'),
(3, 'Omboko Milemba', 28131971, '98 Kiambere', '0716890098', 'group'),
(4, 'Mike Mmena', 30117367, '111 Ngong', '0716890088', 'group'),
(5, 'Jackson Kavoi', 11234567, '10 Kibera', '0711890098', 'group'),
(6, 'Jane Muoti', 12345678, '11 Homabay', '0736890090', 'group'),
(7, 'Lincoln Njugu', 12345578, '131 Malaba', '0700675990', 'group'),
(8, 'Jackason Myuku', 222222222, '43 Moyale', '075689777', 'group'),
(9, 'Francis Janet', 333333333, '191  Kisumu', '0756890090', 'group');

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` int(50) NOT NULL,
  `nid` int(50) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `date_paid` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `contribution` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`id`, `nid`, `group_name`, `date_paid`, `amount`, `contribution`) VALUES
(1, 28131989, NULL, '2017-08-23 18:50:51', '2200', '2200'),
(2, 11234567, NULL, '2017-08-23 18:51:07', '1440', '1800'),
(3, NULL, 'Kisewe', '2017-08-23 18:51:07', '360', '1800'),
(4, 12345678, NULL, '2017-08-23 18:51:26', '800', '1000'),
(5, NULL, 'KIOMO', '2017-08-23 18:51:26', '200', '1000'),
(6, 22334455, NULL, '2017-08-23 18:51:44', '1200', '1200'),
(7, 12345578, NULL, '2017-08-23 18:51:56', '2400', '3000'),
(8, NULL, 'KIOMO', '2017-08-23 18:51:56', '600', '3000'),
(9, 30117367, NULL, '2017-08-23 18:52:08', '1200', '1500'),
(10, NULL, 'Kisewe', '2017-08-23 18:52:08', '300', '1500'),
(11, 28131971, NULL, '2017-08-23 18:52:19', '880', '1100'),
(12, NULL, 'Kisewe', '2017-08-23 18:52:19', '220', '1100'),
(13, 333333333, NULL, '2017-08-23 21:58:58', '2560', '3200'),
(14, NULL, 'Mtihani', '2017-08-23 21:58:58', '640', '3200'),
(15, 28131989, NULL, '2017-08-25 13:27:28', '1300', '1300');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'calvo', '1234@calvo'),
(2, 'kings', '1234@kings');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
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
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
