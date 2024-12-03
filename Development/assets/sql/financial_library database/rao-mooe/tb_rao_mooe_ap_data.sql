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
-- Table structure for table `tb_rao_mooe_ap_data`
--

CREATE TABLE `tb_rao_mooe_ap_data` (
  `rao_mooe_ap_data_id` int(11) NOT NULL,
  `rao_mooe_ap_id` int(11) NOT NULL,
  `rao_mooe_att_id` varchar(255) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ap_data`
--

INSERT INTO `tb_rao_mooe_ap_data` (`rao_mooe_ap_data_id`, `rao_mooe_ap_id`, `rao_mooe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(41, 7, '35', 'Data 1', 4356.45, 1),
(42, 7, '36', 'Data 2', 42757.12, 1),
(43, 7, '37', 'Data 3', 475714.4, 1),
(44, 7, '38', 'Data 4', 0, 1),
(45, 7, '39', 'Data 5', 0, 1),
(46, 7, '40', 'Data 6', 0, 1),
(47, 7, '41', 'Data 7', 0, 1),
(48, 7, '42', 'Data 8', 0, 1),
(49, 8, '51', 'Data 1', 1245.25, 1),
(50, 8, '52', 'Data 2', 11541, 1),
(51, 8, '53', 'Data 3', 0, 1),
(52, 8, '54', 'Data 4', 0, 1),
(53, 8, '55', 'Data 5', 0, 1),
(54, 8, '56', 'Data 6', 0, 1),
(55, 8, '57', 'Data 7', 0, 1),
(56, 8, '58', 'Data 8', 0, 1),
(57, 9, '59', 'Data 1', 1561, 1),
(58, 9, '60', 'Data 2', 0, 1),
(59, 9, '61', 'Data 3', 0, 1),
(60, 9, '62', 'Data 4', 0, 1),
(61, 9, '63', 'Data 5', 0, 1),
(62, 9, '64', 'Data 6', 0, 1),
(63, 9, '65', 'Data 7', 0, 1),
(64, 9, '66', 'Data 8', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_mooe_ap_data`
--
ALTER TABLE `tb_rao_mooe_ap_data`
  ADD PRIMARY KEY (`rao_mooe_ap_data_id`),
  ADD KEY `rao_mooe_ap_id` (`rao_mooe_ap_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ap_data`
--
ALTER TABLE `tb_rao_mooe_ap_data`
  MODIFY `rao_mooe_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_mooe_ap_data`
--
ALTER TABLE `tb_rao_mooe_ap_data`
  ADD CONSTRAINT `tb_rao_mooe_ap_data_ibfk_1` FOREIGN KEY (`rao_mooe_ap_id`) REFERENCES `tb_rao_mooe_ap` (`rao_mooe_ap_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
