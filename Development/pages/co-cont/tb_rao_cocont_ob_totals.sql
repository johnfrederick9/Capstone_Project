-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 04:58 PM
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
-- Table structure for table `tb_rao_cocont_ob_totals`
--

CREATE TABLE `tb_rao_cocont_ob_totals` (
  `rao_cocont_id` int(11) NOT NULL,
  `rao_cocont_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_cocont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cocont_ob_totals`
--

INSERT INTO `tb_rao_cocont_ob_totals` (`rao_cocont_id`, `rao_cocont_ob_total_id`, `total_type`, `rao_cocont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ob_total_TO', 0, '', 0, 1),
(1, 2, 'TO', 1, 'Data 1', 0, 1),
(1, 3, 'ob_total_OB', 0, '', 0, 1),
(1, 4, 'OB', 1, 'Data 1', 0, 1),
(1, 5, 'ob_total_AB', 0, '', 4247573.23, 1),
(1, 6, 'AB', 1, 'Data 1', 4247573.23, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_cocont_ob_totals`
--
ALTER TABLE `tb_rao_cocont_ob_totals`
  ADD PRIMARY KEY (`rao_cocont_ob_total_id`),
  ADD KEY `rao_cocont_id` (`rao_cocont_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_cocont_ob_totals`
--
ALTER TABLE `tb_rao_cocont_ob_totals`
  MODIFY `rao_cocont_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_cocont_ob_totals`
--
ALTER TABLE `tb_rao_cocont_ob_totals`
  ADD CONSTRAINT `tb_rao_cocont_ob_totals_ibfk_1` FOREIGN KEY (`rao_cocont_id`) REFERENCES `tb_rao_cocont` (`rao_cocont_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
