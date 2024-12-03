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
-- Table structure for table `tb_rao_fe_ap_data`
--

CREATE TABLE `tb_rao_fe_ap_data` (
  `rao_fe_ap_data_id` int(11) NOT NULL,
  `rao_fe_ap_id` int(11) NOT NULL,
  `rao_fe_att_id` varchar(255) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_ap_data`
--

INSERT INTO `tb_rao_fe_ap_data` (`rao_fe_ap_data_id`, `rao_fe_ap_id`, `rao_fe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, '1', 'Data 1', 453.58, 1),
(2, 1, '2', 'Data 2', 0, 1),
(3, 2, '9', 'Data 1', 100.45, 1),
(4, 2, '10', 'Data 2', 200.55, 1),
(5, 2, '11', 'Data 3', 300.65, 1),
(6, 3, '9', 'Data 1', 10, 1),
(7, 3, '10', 'Data 2', 20, 1),
(8, 3, '11', 'Data 3', 30, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_fe_ap_data`
--
ALTER TABLE `tb_rao_fe_ap_data`
  ADD PRIMARY KEY (`rao_fe_ap_data_id`),
  ADD KEY `rao_fe_ap_id` (`rao_fe_ap_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_fe_ap_data`
--
ALTER TABLE `tb_rao_fe_ap_data`
  MODIFY `rao_fe_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_fe_ap_data`
--
ALTER TABLE `tb_rao_fe_ap_data`
  ADD CONSTRAINT `tb_rao_fe_ap_data_ibfk_1` FOREIGN KEY (`rao_fe_ap_id`) REFERENCES `tb_rao_fe_ap` (`rao_fe_ap_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
