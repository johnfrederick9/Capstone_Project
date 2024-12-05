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
-- Table structure for table `tb_rao_co_ob_totals`
--

CREATE TABLE `tb_rao_co_ob_totals` (
  `rao_co_id` int(11) NOT NULL,
  `rao_co_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_co_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_co_ob_totals`
--

INSERT INTO `tb_rao_co_ob_totals` (`rao_co_id`, `rao_co_ob_total_id`, `total_type`, `rao_co_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(2, 1, 'ob_total_TO', 0, '', 0, 1),
(2, 2, 'TO', 4, 'Electrification', 0, 1),
(2, 3, 'TO', 5, 'Travel Training Expenses', 0, 1),
(2, 4, 'ob_total_OB', 0, '', 0, 1),
(2, 5, 'OB', 4, 'Electrification', 0, 1),
(2, 6, 'OB', 5, 'Travel Training Expenses', 0, 1),
(2, 7, 'ob_total_AB', 0, '', 0, 1),
(2, 8, 'AB', 4, 'Electrification', 0, 1),
(2, 9, 'AB', 5, 'Travel Training Expenses', 0, 1),
(1, 10, 'TO', 6, 'Electrification', 0, 0),
(1, 11, 'OB', 6, 'Electrification', 0, 0),
(1, 12, 'AB', 6, 'Electrification', 0, 0),
(1, 13, 'TO', 7, 'Travel Training Expenses', 0, 0),
(1, 14, 'OB', 7, 'Travel Training Expenses', 0, 0),
(1, 15, 'AB', 7, 'Travel Training Expenses', 0, 0),
(2, 16, 'TO', 8, 'Data 1', 0, 1),
(2, 17, 'OB', 8, 'Data 1', 0, 1),
(2, 18, 'AB', 8, 'Data 1', 0, 1),
(2, 19, 'TO', 9, 'Data 2', 0, 1),
(2, 20, 'OB', 9, 'Data 2', 0, 1),
(2, 21, 'AB', 9, 'Data 2', 0, 1),
(2, 22, 'TO', 10, 'Data 3', 0, 1),
(2, 23, 'OB', 10, 'Data 3', 0, 1),
(2, 24, 'AB', 10, 'Data 3', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_co_ob_totals`
--
ALTER TABLE `tb_rao_co_ob_totals`
  ADD PRIMARY KEY (`rao_co_ob_total_id`),
  ADD KEY `rao_co_id` (`rao_co_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_co_ob_totals`
--
ALTER TABLE `tb_rao_co_ob_totals`
  MODIFY `rao_co_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_co_ob_totals`
--
ALTER TABLE `tb_rao_co_ob_totals`
  ADD CONSTRAINT `tb_rao_co_ob_totals_ibfk_1` FOREIGN KEY (`rao_co_id`) REFERENCES `tb_rao_co` (`rao_co_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
