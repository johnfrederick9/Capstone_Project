-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 07:20 AM
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
-- Table structure for table `tb_rao_bd_totals`
--

CREATE TABLE `tb_rao_bd_totals` (
  `rao_bd_total_id` int(11) NOT NULL,
  `rao_bd_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `pre_disaster` double NOT NULL,
  `quick_response` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_bd_totals`
--

INSERT INTO `tb_rao_bd_totals` (`rao_bd_total_id`, `rao_bd_id`, `total_type`, `total`, `pre_disaster`, `quick_response`, `isDisplayed`) VALUES
(21, 7, 'TA', 572528.87, 400770.21, 171758.66, 1),
(22, 7, 'BF', 572528.87, 400770.21, 171758.66, 1),
(23, 7, 'TO', 0, 0, 0, 1),
(24, 7, 'OB', 0, 0, 0, 1),
(25, 7, 'AB', 572528.87, 400770.21, 171758.66, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_bd_totals`
--
ALTER TABLE `tb_rao_bd_totals`
  ADD PRIMARY KEY (`rao_bd_total_id`),
  ADD KEY `rao_bd_id` (`rao_bd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_bd_totals`
--
ALTER TABLE `tb_rao_bd_totals`
  MODIFY `rao_bd_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_bd_totals`
--
ALTER TABLE `tb_rao_bd_totals`
  ADD CONSTRAINT `tb_rao_bd_totals_ibfk_1` FOREIGN KEY (`rao_bd_id`) REFERENCES `tb_rao_bd` (`rao_bd_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
