-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 05:36 AM
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
-- Table structure for table `tb_rao_cont_attributes`
--

CREATE TABLE `tb_rao_cont_attributes` (
  `rao_cont_id` int(11) NOT NULL,
  `rao_cont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_attributes`
--

INSERT INTO `tb_rao_cont_attributes` (`rao_cont_id`, `rao_cont_att_id`, `attribute_name`, `isDisplayed`) VALUES
(83, 256, 'Data 1', 0),
(84, 257, 'Electrification', 1),
(84, 258, 'Road Rehabilitation', 1),
(84, 259, 'Daycare Center', 1),
(84, 260, 'Road Concreting', 1),
(84, 261, 'MES', 1),
(84, 262, 'Foodbridge Lower Lahug', 1),
(84, 263, 'MNHS', 1),
(84, 264, 'SAMPIG ELEM. SCHOOL', 1),
(84, 265, 'SUMAFA WOMENS', 1),
(84, 266, 'WATER RESERVOIR', 1),
(85, 267, 'Data 1', 1),
(85, 268, 'Electrification', 1),
(85, 269, 'Road Rehabilitation', 1),
(85, 270, 'Daycare Center', 1),
(85, 271, 'Road Concreting', 1),
(85, 272, 'MES', 1),
(85, 273, 'Foodbridge Lower Lahug', 1),
(85, 274, 'MNHS', 1),
(85, 275, 'SAMPIG ELEM. SCHOOL', 1),
(85, 276, 'SUMAFA WOMENS', 1),
(85, 277, 'WATER RESERVOIR', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_cont_attributes`
--
ALTER TABLE `tb_rao_cont_attributes`
  ADD PRIMARY KEY (`rao_cont_att_id`),
  ADD KEY `rao_cont_id` (`rao_cont_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_cont_attributes`
--
ALTER TABLE `tb_rao_cont_attributes`
  MODIFY `rao_cont_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_cont_attributes`
--
ALTER TABLE `tb_rao_cont_attributes`
  ADD CONSTRAINT `tb_rao_cont_attributes_ibfk_1` FOREIGN KEY (`rao_cont_id`) REFERENCES `tb_rao_cont` (`rao_cont_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
