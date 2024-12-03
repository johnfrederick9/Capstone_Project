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
-- Table structure for table `tb_rao_mooe_ob_data`
--

CREATE TABLE `tb_rao_mooe_ob_data` (
  `rao_mooe_ob_data_id` int(11) NOT NULL,
  `rao_mooe_ob_id` int(11) NOT NULL,
  `rao_mooe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ob_data`
--

INSERT INTO `tb_rao_mooe_ob_data` (`rao_mooe_ob_data_id`, `rao_mooe_ob_id`, `rao_mooe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(13, 3, 35, 'Data 1', 2435.4, 1),
(14, 3, 36, 'Data 2', 7542.52, 1),
(15, 3, 37, 'Data 3', 421422.4, 1),
(16, 3, 38, 'Data 4', 0, 1),
(17, 3, 39, 'Data 5', 0, 1),
(18, 3, 40, 'Data 6', 0, 1),
(19, 3, 41, 'Data 7', 0, 1),
(20, 3, 42, 'Data 8', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_mooe_ob_data`
--
ALTER TABLE `tb_rao_mooe_ob_data`
  ADD PRIMARY KEY (`rao_mooe_ob_data_id`),
  ADD KEY `rao_mooe_ob_id` (`rao_mooe_ob_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ob_data`
--
ALTER TABLE `tb_rao_mooe_ob_data`
  MODIFY `rao_mooe_ob_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_mooe_ob_data`
--
ALTER TABLE `tb_rao_mooe_ob_data`
  ADD CONSTRAINT `tb_rao_mooe_ob_data_ibfk_1` FOREIGN KEY (`rao_mooe_ob_id`) REFERENCES `tb_rao_mooe_ob` (`rao_mooe_ob_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
