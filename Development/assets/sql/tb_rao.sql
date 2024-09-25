-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 05:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_barangay`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao`
--

CREATE TABLE `tb_rao` (
  `rao_id` int(11) NOT NULL,
  `period_covered` year(4) NOT NULL,
  `ap_total` double NOT NULL,
  `ap_salary` double NOT NULL,
  `ap_cash_gift` double NOT NULL,
  `ap_year_end` double NOT NULL,
  `ap_mid_year` double NOT NULL,
  `ap_sri` double NOT NULL,
  `ap_others` double NOT NULL,
  `ob_total` double NOT NULL,
  `ob_salary` double NOT NULL,
  `ob_cash_gift` double NOT NULL,
  `ob_year_end` double NOT NULL,
  `ob_mid_year` double NOT NULL,
  `ob_sri` double NOT NULL,
  `ob_others` double NOT NULL,
  `apbd_total` double NOT NULL,
  `apbd_salary` double NOT NULL,
  `apbd_cash_gift` double NOT NULL,
  `apbd_year_end` double NOT NULL,
  `apbd_mid_year` double NOT NULL,
  `apbd_sri` double NOT NULL,
  `apbd_others` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao`
--

INSERT INTO `tb_rao` (`rao_id`, `period_covered`, `ap_total`, `ap_salary`, `ap_cash_gift`, `ap_year_end`, `ap_mid_year`, `ap_sri`, `ap_others`, `ob_total`, `ob_salary`, `ob_cash_gift`, `ob_year_end`, `ob_mid_year`, `ob_sri`, `ob_others`, `apbd_total`, `apbd_salary`, `apbd_cash_gift`, `apbd_year_end`, `apbd_mid_year`, `apbd_sri`, `apbd_others`) VALUES
(76, '2024', 5134533.86, 4242000, 110000, 178000, 178000, 220000, 206533.86, 312, 312, 0, 0, 0, 0, 0, 5134221.86, 4241688, 110000, 178000, 178000, 220000, 206533.86),
(77, '0000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao`
--
ALTER TABLE `tb_rao`
  ADD PRIMARY KEY (`rao_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao`
--
ALTER TABLE `tb_rao`
  MODIFY `rao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
