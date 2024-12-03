-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 05:08 PM
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
-- Table structure for table `tb_rao_mooe_attributes`
--

CREATE TABLE `tb_rao_mooe_attributes` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_attributes`
--

INSERT INTO `tb_rao_mooe_attributes` (`rao_mooe_id`, `rao_mooe_att_id`, `attribute_name`, `isDisplayed`) VALUES
(7, 35, 'Data 1', 1),
(7, 36, 'Data 2', 1),
(7, 37, 'Data 3', 1),
(7, 38, 'Data 4', 1),
(7, 39, 'Data 5', 1),
(7, 40, 'Data 6', 1),
(7, 41, 'Data 7', 1),
(7, 42, 'Data 8', 1),
(8, 43, 'Data 1', 1),
(8, 44, 'Data 2', 1),
(8, 45, 'Data 3', 1),
(8, 46, 'Data 4', 1),
(8, 47, 'Data 5', 1),
(8, 48, 'Data 6', 1),
(8, 49, 'Data 7', 1),
(8, 50, 'Data 8', 1),
(9, 51, 'Data 1', 1),
(9, 52, 'Data 2', 1),
(9, 53, 'Data 3', 1),
(9, 54, 'Data 4', 1),
(9, 55, 'Data 5', 1),
(9, 56, 'Data 6', 1),
(9, 57, 'Data 7', 1),
(9, 58, 'Data 8', 1),
(10, 59, 'Data 1', 1),
(10, 60, 'Data 2', 1),
(10, 61, 'Data 3', 1),
(10, 62, 'Data 4', 1),
(10, 63, 'Data 5', 1),
(10, 64, 'Data 6', 1),
(10, 65, 'Data 7', 1),
(10, 66, 'Data 8', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_mooe_attributes`
--
ALTER TABLE `tb_rao_mooe_attributes`
  ADD PRIMARY KEY (`rao_mooe_att_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_mooe_attributes`
--
ALTER TABLE `tb_rao_mooe_attributes`
  MODIFY `rao_mooe_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_mooe_attributes`
--
ALTER TABLE `tb_rao_mooe_attributes`
  ADD CONSTRAINT `tb_rao_mooe_attributes_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
