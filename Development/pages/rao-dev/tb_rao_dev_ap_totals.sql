-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 03:43 AM
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
-- Table structure for table `tb_rao_dev_ap_totals`
--

CREATE TABLE `tb_rao_dev_ap_totals` (
  `rao_dev_id` int(11) NOT NULL,
  `rao_dev_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_dev_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_dev_ap_totals`
--

INSERT INTO `tb_rao_dev_ap_totals` (`rao_dev_id`, `rao_dev_ap_total_id`, `total_type`, `rao_dev_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ap_total_TA', 0, '', 1709481, 1),
(1, 2, 'TA', 1, 'Road Concreting', 749481, 1),
(1, 3, 'TA', 2, 'Solar Streetlight', 150000, 1),
(1, 4, 'TA', 3, 'Watershed Kang-ibang', 30000, 1),
(1, 5, 'TA', 4, 'Dep-ed Counterpart', 100000, 1),
(1, 6, 'TA', 5, 'Footbridge', 30000, 1),
(1, 7, 'TA', 6, 'Campacass', 200000, 1),
(1, 8, 'TA', 7, 'Sampig Spring BOX', 50000, 1),
(1, 9, 'TA', 8, 'Spillway Alang-alang', 100000, 1),
(1, 10, 'ap_total_BF', 0, '', 1709481, 1),
(1, 11, 'BF', 1, 'Road Concreting', 749481, 1),
(1, 12, 'BF', 2, 'Solar Streetlight', 150000, 1),
(1, 13, 'BF', 3, 'Watershed Kang-ibang', 30000, 1),
(1, 14, 'BF', 4, 'Dep-ed Counterpart', 100000, 1),
(1, 15, 'BF', 5, 'Footbridge', 30000, 1),
(1, 16, 'BF', 6, 'Campacass', 200000, 1),
(1, 17, 'BF', 7, 'Sampig Spring BOX', 50000, 1),
(1, 18, 'BF', 8, 'Spillway Alang-alang', 100000, 1),
(1, 19, 'TA', 9, 'Association', 300000, 1),
(1, 20, 'BF', 9, 'Association', 300000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_dev_ap_totals`
--
ALTER TABLE `tb_rao_dev_ap_totals`
  ADD PRIMARY KEY (`rao_dev_ap_total_id`),
  ADD KEY `rao_dev_id` (`rao_dev_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_dev_ap_totals`
--
ALTER TABLE `tb_rao_dev_ap_totals`
  MODIFY `rao_dev_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_dev_ap_totals`
--
ALTER TABLE `tb_rao_dev_ap_totals`
  ADD CONSTRAINT `tb_rao_dev_ap_totals_ibfk_1` FOREIGN KEY (`rao_dev_id`) REFERENCES `tb_rao_dev` (`rao_dev_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
