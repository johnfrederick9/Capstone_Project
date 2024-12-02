-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 05:07 PM
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
-- Table structure for table `tb_rao_mooe_ap_totals`
--

CREATE TABLE `tb_rao_mooe_ap_totals` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_mooe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ap_totals`
--

INSERT INTO `tb_rao_mooe_ap_totals` (`rao_mooe_id`, `rao_mooe_ap_total_id`, `total_type`, `rao_mooe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(7, 81, 'ap_total_TA', 0, '', 522827.97, 1),
(7, 82, 'TA', 35, 'Data 1', 4356.45, 1),
(7, 83, 'TA', 36, 'Data 2', 42757.12, 1),
(7, 84, 'TA', 37, 'Data 3', 475714.4, 1),
(7, 85, 'TA', 38, 'Data 4', 0, 1),
(7, 86, 'TA', 39, 'Data 5', 0, 1),
(7, 87, 'TA', 40, 'Data 6', 0, 1),
(7, 88, 'TA', 41, 'Data 7', 0, 1),
(7, 89, 'TA', 42, 'Data 8', 0, 1),
(7, 90, 'ap_total_BF', 0, '', 522827.97, 1),
(7, 91, 'BF', 35, 'Data 1', 4356.45, 1),
(7, 92, 'BF', 36, 'Data 2', 42757.12, 1),
(7, 93, 'BF', 37, 'Data 3', 475714.4, 1),
(7, 94, 'BF', 38, 'Data 4', 0, 1),
(7, 95, 'BF', 39, 'Data 5', 0, 1),
(7, 96, 'BF', 40, 'Data 6', 0, 1),
(7, 97, 'BF', 41, 'Data 7', 0, 1),
(7, 98, 'BF', 42, 'Data 8', 0, 1),
(9, 99, 'ap_total_TA', 0, '', 12786.25, 1),
(9, 100, 'TA', 51, 'Data 1', 1245.25, 1),
(9, 101, 'TA', 52, 'Data 2', 11541, 1),
(9, 102, 'TA', 53, 'Data 3', 0, 1),
(9, 103, 'TA', 54, 'Data 4', 0, 1),
(9, 104, 'TA', 55, 'Data 5', 0, 1),
(9, 105, 'TA', 56, 'Data 6', 0, 1),
(9, 106, 'TA', 57, 'Data 7', 0, 1),
(9, 107, 'TA', 58, 'Data 8', 0, 1),
(9, 108, 'ap_total_BF', 0, '', 12786.25, 1),
(9, 109, 'BF', 51, 'Data 1', 1245.25, 1),
(9, 110, 'BF', 52, 'Data 2', 11541, 1),
(9, 111, 'BF', 53, 'Data 3', 0, 1),
(9, 112, 'BF', 54, 'Data 4', 0, 1),
(9, 113, 'BF', 55, 'Data 5', 0, 1),
(9, 114, 'BF', 56, 'Data 6', 0, 1),
(9, 115, 'BF', 57, 'Data 7', 0, 1),
(9, 116, 'BF', 58, 'Data 8', 0, 1),
(10, 117, 'ap_total_TA', 0, '', 1561, 1),
(10, 118, 'TA', 59, 'Data 1', 1561, 1),
(10, 119, 'TA', 60, 'Data 2', 0, 1),
(10, 120, 'TA', 61, 'Data 3', 0, 1),
(10, 121, 'TA', 62, 'Data 4', 0, 1),
(10, 122, 'TA', 63, 'Data 5', 0, 1),
(10, 123, 'TA', 64, 'Data 6', 0, 1),
(10, 124, 'TA', 65, 'Data 7', 0, 1),
(10, 125, 'TA', 66, 'Data 8', 0, 1),
(10, 126, 'ap_total_BF', 0, '', 1561, 1),
(10, 127, 'BF', 59, 'Data 1', 1561, 1),
(10, 128, 'BF', 60, 'Data 2', 0, 1),
(10, 129, 'BF', 61, 'Data 3', 0, 1),
(10, 130, 'BF', 62, 'Data 4', 0, 1),
(10, 131, 'BF', 63, 'Data 5', 0, 1),
(10, 132, 'BF', 64, 'Data 6', 0, 1),
(10, 133, 'BF', 65, 'Data 7', 0, 1),
(10, 134, 'BF', 66, 'Data 8', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_mooe_ap_totals`
--
ALTER TABLE `tb_rao_mooe_ap_totals`
  ADD PRIMARY KEY (`rao_mooe_ap_total_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ap_totals`
--
ALTER TABLE `tb_rao_mooe_ap_totals`
  MODIFY `rao_mooe_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_mooe_ap_totals`
--
ALTER TABLE `tb_rao_mooe_ap_totals`
  ADD CONSTRAINT `tb_rao_mooe_ap_totals_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
