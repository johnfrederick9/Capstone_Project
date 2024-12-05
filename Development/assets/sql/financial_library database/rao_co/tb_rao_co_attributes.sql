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
-- Table structure for table `tb_rao_co_attributes`
--

CREATE TABLE `tb_rao_co_attributes` (
  `rao_co_id` int(11) NOT NULL,
  `rao_co_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_co_attributes`
--

INSERT INTO `tb_rao_co_attributes` (`rao_co_id`, `rao_co_att_id`, `attribute_name`, `isDisplayed`) VALUES
(1, 1, 'Data 1', 0),
(1, 2, 'Data 2', 0),
(1, 3, 'Data 3', 0),
(2, 4, 'Electrification', 1),
(2, 5, 'Travel Training Expenses', 1),
(1, 6, 'Electrification', 0),
(1, 7, 'Travel Training Expenses', 0),
(2, 8, 'Data 1', 1),
(2, 9, 'Data 2', 1),
(2, 10, 'Data 3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_co_attributes`
--
ALTER TABLE `tb_rao_co_attributes`
  ADD PRIMARY KEY (`rao_co_att_id`),
  ADD KEY `rao_co_id` (`rao_co_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_co_attributes`
--
ALTER TABLE `tb_rao_co_attributes`
  MODIFY `rao_co_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_co_attributes`
--
ALTER TABLE `tb_rao_co_attributes`
  ADD CONSTRAINT `tb_rao_co_attributes_ibfk_1` FOREIGN KEY (`rao_co_id`) REFERENCES `tb_rao_co` (`rao_co_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
