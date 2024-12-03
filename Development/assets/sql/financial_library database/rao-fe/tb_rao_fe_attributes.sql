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
-- Table structure for table `tb_rao_fe_attributes`
--

CREATE TABLE `tb_rao_fe_attributes` (
  `rao_fe_id` int(11) NOT NULL,
  `rao_fe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_attributes`
--

INSERT INTO `tb_rao_fe_attributes` (`rao_fe_id`, `rao_fe_att_id`, `attribute_name`, `isDisplayed`) VALUES
(1, 1, 'Data 1', 1),
(1, 2, 'Data 2', 1),
(2, 3, 'Data 1', 1),
(2, 4, 'Data 2', 1),
(2, 5, 'Data 3', 1),
(3, 6, 'Data 1', 1),
(3, 7, 'Data 2', 1),
(3, 8, 'Data 3', 1),
(4, 9, 'Data 1', 1),
(4, 10, 'Data 2', 1),
(4, 11, 'Data 3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_fe_attributes`
--
ALTER TABLE `tb_rao_fe_attributes`
  ADD PRIMARY KEY (`rao_fe_att_id`),
  ADD KEY `rao_fe_id` (`rao_fe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_fe_attributes`
--
ALTER TABLE `tb_rao_fe_attributes`
  MODIFY `rao_fe_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_fe_attributes`
--
ALTER TABLE `tb_rao_fe_attributes`
  ADD CONSTRAINT `tb_rao_fe_attributes_ibfk_1` FOREIGN KEY (`rao_fe_id`) REFERENCES `tb_rao_fe` (`rao_fe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
