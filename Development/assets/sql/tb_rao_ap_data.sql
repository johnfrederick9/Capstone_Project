-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 05:48 PM
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
-- Table structure for table `tb_rao_ap_data`
--

CREATE TABLE `tb_rao_ap_data` (
  `rao_id` int(11) NOT NULL,
  `rao_ap_data_id` int(11) NOT NULL,
  `ap_ref_date` date DEFAULT NULL,
  `ap_ref_no` varchar(255) DEFAULT NULL,
  `ap_particulars` varchar(255) DEFAULT NULL,
  `ap_total` double DEFAULT NULL,
  `ap_salary` double DEFAULT NULL,
  `ap_cash_gift` double DEFAULT NULL,
  `ap_year_end` double DEFAULT NULL,
  `ap_mid_year` double DEFAULT NULL,
  `ap_sri` double DEFAULT NULL,
  `ap_others` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_ap_data`
--

INSERT INTO `tb_rao_ap_data` (`rao_id`, `rao_ap_data_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_total`, `ap_salary`, `ap_cash_gift`, `ap_year_end`, `ap_mid_year`, `ap_sri`, `ap_others`) VALUES
(76, 66, '2024-09-01', 'Ao No. 02 S2020', 'Annual Budget', 5134533.86, 4242000, 110000, 178000, 178000, 220000, 206533.86);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_ap_data`
--
ALTER TABLE `tb_rao_ap_data`
  ADD PRIMARY KEY (`rao_ap_data_id`),
  ADD KEY `rao_id` (`rao_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_ap_data`
--
ALTER TABLE `tb_rao_ap_data`
  MODIFY `rao_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_ap_data`
--
ALTER TABLE `tb_rao_ap_data`
  ADD CONSTRAINT `tb_rao_ap_data_ibfk_1` FOREIGN KEY (`rao_id`) REFERENCES `tb_rao` (`rao_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
