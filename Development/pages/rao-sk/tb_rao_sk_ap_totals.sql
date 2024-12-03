-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 09:21 AM
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
-- Table structure for table `tb_rao_sk_ap_totals`
--

CREATE TABLE `tb_rao_sk_ap_totals` (
  `rao_sk_id` int(11) NOT NULL,
  `rao_sk_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_sk_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_sk_ap_totals`
--

INSERT INTO `tb_rao_sk_ap_totals` (`rao_sk_id`, `rao_sk_ap_total_id`, `total_type`, `rao_sk_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ap_total_TA', 0, '', 3232.09, 1),
(1, 2, 'TA', 1, 'Data 1', 1758.56, 1),
(1, 3, 'TA', 2, 'Data 2', 1473.53, 1),
(1, 4, 'ap_total_BF', 0, '', 3232.09, 1),
(1, 5, 'BF', 1, 'Data 1', 1758.56, 1),
(1, 6, 'BF', 2, 'Data 2', 1473.53, 1),
(1, 7, 'TA', 3, 'Data 3', 0, 1),
(1, 8, 'BF', 3, 'Data 3', 0, 1),
(2, 9, 'ap_total_TA', 0, '', 601.43, 0),
(2, 10, 'TA', 4, 'Data 1', 100.42, 0),
(2, 11, 'TA', 5, 'Data 2', 200.54, 0),
(2, 12, 'TA', 6, 'Data 3', 300.47, 0),
(2, 13, 'ap_total_BF', 0, '', 601.43, 0),
(2, 14, 'BF', 4, 'Data 1', 100.42, 0),
(2, 15, 'BF', 5, 'Data 2', 200.54, 0),
(2, 16, 'BF', 6, 'Data 3', 300.47, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_sk_ap_totals`
--
ALTER TABLE `tb_rao_sk_ap_totals`
  ADD PRIMARY KEY (`rao_sk_ap_total_id`),
  ADD KEY `rao_sk_id` (`rao_sk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_sk_ap_totals`
--
ALTER TABLE `tb_rao_sk_ap_totals`
  MODIFY `rao_sk_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_sk_ap_totals`
--
ALTER TABLE `tb_rao_sk_ap_totals`
  ADD CONSTRAINT `tb_rao_sk_ap_totals_ibfk_1` FOREIGN KEY (`rao_sk_id`) REFERENCES `tb_rao_sk` (`rao_sk_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
