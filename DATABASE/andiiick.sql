-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 04, 2020 at 06:22 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.3.20-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `andiiick`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_cd` char(20) DEFAULT NULL,
  `category_nm` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_cd`, `category_nm`) VALUES
(1, '001', 'Sepatu'),
(2, '002', 'T-Shirt'),
(3, '003', 'Crewneck');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_cd` char(20) DEFAULT NULL,
  `product_nm` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text,
  `created_user` int(11) DEFAULT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) DEFAULT NULL,
  `nullified_dttm` datetime NOT NULL,
  `status_act` enum('normal','nullified') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_cd`, `product_nm`, `category_id`, `description`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`, `status_act`) VALUES
(1, '001', 'Vans Oldskull BW', 1, 'Test 1', 1, '2020-08-04 16:33:33', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 'normal'),
(2, '002', 'Volcom Stone', 2, 'Out of stock', 1, '2020-08-04 16:43:37', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 'normal'),
(3, '003', 'Macbeth Eliot BC', 3, 'Out of stock', 1, '2020-08-04 16:45:15', 1, '2020-08-04 18:21:39', NULL, '0000-00-00 00:00:00', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `gender` enum('L','P') NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) DEFAULT NULL,
  `nullified_dttm` datetime NOT NULL,
  `status_acc` enum('active','deactive') DEFAULT NULL,
  `status_act` enum('normal','nullified') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `name`, `username`, `gender`, `password`, `level`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`, `status_acc`, `status_act`) VALUES
(1, 'Administrator', 'admin', 'L', '10470c3b4b1fed12c3baac014be15fac67c6e815', 2, 1, '2020-08-04 11:41:23', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 'active', 'normal'),
(2, 'Akhmad Affandy S', 'andiiick', 'L', '10470c3b4b1fed12c3baac014be15fac67c6e815', 1, 1, '2020-08-04 11:41:51', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 'active', 'normal'),
(3, 'Asasaa', 'asssa', 'L', '10470c3b4b1fed12c3baac014be15fac67c6e815', 1, 1, '2020-08-04 11:57:29', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 'active', 'normal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
