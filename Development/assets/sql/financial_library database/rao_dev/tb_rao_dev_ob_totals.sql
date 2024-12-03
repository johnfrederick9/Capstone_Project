-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 03:44 AM
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
-- Table structure for table `tb_rao_dev_ob_totals`
--

CREATE TABLE `tb_rao_dev_ob_totals` (
  `rao_dev_id` int(11) NOT NULL,
  `rao_dev_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_dev_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_dev_ob_totals`
--

INSERT INTO `tb_rao_dev_ob_totals` (`rao_dev_id`, `rao_dev_ob_total_id`, `total_type`, `rao_dev_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ob_total_TO', 0, '', 0, 1),
(1, 2, 'TO', 1, 'Road Concreting', 0, 1),
(1, 3, 'TO', 2, 'Solar Streetlight', 0, 1),
(1, 4, 'TO', 3, 'Watershed Kang-ibang', 0, 1),
(1, 5, 'TO', 4, 'Dep-ed Counterpart', 0, 1),
(1, 6, 'TO', 5, 'Footbridge', 0, 1),
(1, 7, 'TO', 6, 'Campacass', 0, 1),
(1, 8, 'TO', 7, 'Sampig Spring BOX', 0, 1),
(1, 9, 'TO', 8, 'Spillway Alang-alang', 0, 1),
(1, 10, 'ob_total_OB', 0, '', 0, 1),
(1, 11, 'OB', 1, 'Road Concreting', 0, 1),
(1, 12, 'OB', 2, 'Solar Streetlight', 0, 1),
(1, 13, 'OB', 3, 'Watershed Kang-ibang', 0, 1),
(1, 14, 'OB', 4, 'Dep-ed Counterpart', 0, 1),
(1, 15, 'OB', 5, 'Footbridge', 0, 1),
(1, 16, 'OB', 6, 'Campacass', 0, 1),
(1, 17, 'OB', 7, 'Sampig Spring BOX', 0, 1),
(1, 18, 'OB', 8, 'Spillway Alang-alang', 0, 1),
(1, 19, 'ob_total_AB', 0, '', 1709481, 1),
(1, 20, 'AB', 1, 'Road Concreting', 749481, 1),
(1, 21, 'AB', 2, 'Solar Streetlight', 150000, 1),
(1, 22, 'AB', 3, 'Watershed Kang-ibang', 30000, 1),
(1, 23, 'AB', 4, 'Dep-ed Counterpart', 100000, 1),
(1, 24, 'AB', 5, 'Footbridge', 30000, 1),
(1, 25, 'AB', 6, 'Campacass', 200000, 1),
(1, 26, 'AB', 7, 'Sampig Spring BOX', 50000, 1),
(1, 27, 'AB', 8, 'Spillway Alang-alang', 100000, 1),
(1, 28, 'TO', 9, 'Association', 0, 1),
(1, 29, 'OB', 9, 'Association', 0, 1),
(1, 30, 'AB', 9, 'Association', 300000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_dev_ob_totals`
--
ALTER TABLE `tb_rao_dev_ob_totals`
  ADD PRIMARY KEY (`rao_dev_ob_total_id`),
  ADD KEY `rao_dev_id` (`rao_dev_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_dev_ob_totals`
--
ALTER TABLE `tb_rao_dev_ob_totals`
  MODIFY `rao_dev_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_dev_ob_totals`
--
ALTER TABLE `tb_rao_dev_ob_totals`
  ADD CONSTRAINT `tb_rao_dev_ob_totals_ibfk_1` FOREIGN KEY (`rao_dev_id`) REFERENCES `tb_rao_dev` (`rao_dev_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
