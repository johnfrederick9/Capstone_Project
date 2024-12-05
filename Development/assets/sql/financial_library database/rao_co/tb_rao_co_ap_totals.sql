-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 10:41 AM
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
-- Table structure for table `tb_rao_co_ap_totals`
--

CREATE TABLE `tb_rao_co_ap_totals` (
  `rao_co_id` int(11) NOT NULL,
  `rao_co_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_co_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_co_ap_totals`
--

INSERT INTO `tb_rao_co_ap_totals` (`rao_co_id`, `rao_co_ap_total_id`, `total_type`, `rao_co_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(2, 1, 'ap_total_TA', 0, '', 0, 1),
(2, 2, 'TA', 4, 'Electrification', 0, 1),
(2, 3, 'TA', 5, 'Travel Training Expenses', 0, 1),
(2, 4, 'ap_total_BF', 0, '', 0, 1),
(2, 5, 'BF', 4, 'Electrification', 0, 1),
(2, 6, 'BF', 5, 'Travel Training Expenses', 0, 1),
(1, 7, 'TA', 6, 'Electrification', 0, 0),
(1, 8, 'BF', 6, 'Electrification', 0, 0),
(1, 9, 'TA', 7, 'Travel Training Expenses', 0, 0),
(1, 10, 'BF', 7, 'Travel Training Expenses', 0, 0),
(2, 11, 'TA', 8, 'Data 1', 0, 1),
(2, 12, 'BF', 8, 'Data 1', 0, 1),
(2, 13, 'TA', 9, 'Data 2', 0, 1),
(2, 14, 'BF', 9, 'Data 2', 0, 1),
(2, 15, 'TA', 10, 'Data 3', 0, 1),
(2, 16, 'BF', 10, 'Data 3', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_co_ap_totals`
--
ALTER TABLE `tb_rao_co_ap_totals`
  ADD PRIMARY KEY (`rao_co_ap_total_id`),
  ADD KEY `rao_co_id` (`rao_co_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_co_ap_totals`
--
ALTER TABLE `tb_rao_co_ap_totals`
  MODIFY `rao_co_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_co_ap_totals`
--
ALTER TABLE `tb_rao_co_ap_totals`
  ADD CONSTRAINT `tb_rao_co_ap_totals_ibfk_1` FOREIGN KEY (`rao_co_id`) REFERENCES `tb_rao_co` (`rao_co_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
