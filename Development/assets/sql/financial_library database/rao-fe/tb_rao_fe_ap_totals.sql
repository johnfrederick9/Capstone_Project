-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 01:35 AM
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
-- Database: `barangay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_fe_ap_totals`
--

CREATE TABLE `tb_rao_fe_ap_totals` (
  `rao_fe_id` int(11) NOT NULL,
  `rao_fe_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_fe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_ap_totals`
--

INSERT INTO `tb_rao_fe_ap_totals` (`rao_fe_id`, `rao_fe_ap_total_id`, `total_type`, `rao_fe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ap_total_TA', 0, '', 453.58, 1),
(1, 2, 'TA', 1, 'Data 1', 453.58, 1),
(1, 3, 'TA', 2, 'Data 2', 0, 1),
(1, 4, 'ap_total_BF', 0, '', 453.58, 1),
(1, 5, 'BF', 1, 'Data 1', 453.58, 1),
(1, 6, 'BF', 2, 'Data 2', 0, 1),
(4, 7, 'ap_total_TA', 0, '', 661.65, 1),
(4, 8, 'TA', 9, 'Data 1', 110.45, 1),
(4, 9, 'TA', 10, 'Data 2', 220.55, 1),
(4, 10, 'TA', 11, 'Data 3', 330.65, 1),
(4, 11, 'ap_total_BF', 0, '', 661.65, 1),
(4, 12, 'BF', 9, 'Data 1', 110.45, 1),
(4, 13, 'BF', 10, 'Data 2', 220.55, 1),
(4, 14, 'BF', 11, 'Data 3', 330.65, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_fe_ap_totals`
--
ALTER TABLE `tb_rao_fe_ap_totals`
  ADD PRIMARY KEY (`rao_fe_ap_total_id`),
  ADD KEY `rao_fe_id` (`rao_fe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_fe_ap_totals`
--
ALTER TABLE `tb_rao_fe_ap_totals`
  MODIFY `rao_fe_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_fe_ap_totals`
--
ALTER TABLE `tb_rao_fe_ap_totals`
  ADD CONSTRAINT `tb_rao_fe_ap_totals_ibfk_1` FOREIGN KEY (`rao_fe_id`) REFERENCES `tb_rao_fe` (`rao_fe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
