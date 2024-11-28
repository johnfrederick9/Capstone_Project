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
-- Table structure for table `tb_rao_cont_ap_totals`
--

CREATE TABLE `tb_rao_cont_ap_totals` (
  `rao_cont_id` int(11) NOT NULL,
  `rao_cont_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_cont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ap_totals`
--

INSERT INTO `tb_rao_cont_ap_totals` (`rao_cont_id`, `rao_cont_ap_total_id`, `total_type`, `rao_cont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(83, 469, 'ap_total_TA', 0, '', 200, 0),
(83, 470, 'TA', 256, 'Data 1', 200, 0),
(83, 471, 'ap_total_BF', 0, '', 200, 0),
(83, 472, 'BF', 256, 'Data 1', 200, 0),
(84, 473, 'ap_total_TA', 0, '', 4500, 1),
(84, 474, 'TA', 257, 'Electrification', 100, 1),
(84, 475, 'TA', 258, 'Road Rehabilitation', 200, 1),
(84, 476, 'TA', 259, 'Daycare Center', 300, 1),
(84, 477, 'TA', 260, 'Road Concreting', 400, 1),
(84, 478, 'TA', 261, 'MES', 500, 1),
(84, 479, 'TA', 262, 'Foodbridge Lower Lahug', 600, 1),
(84, 480, 'TA', 263, 'MNHS', 700, 1),
(84, 481, 'TA', 264, 'SAMPIG ELEM. SCHOOL', 800, 1),
(84, 482, 'TA', 265, 'SUMAFA WOMENS', 900, 1),
(84, 483, 'ap_total_BF', 0, '', 4500, 1),
(84, 484, 'BF', 257, 'Electrification', 100, 1),
(84, 485, 'BF', 258, 'Road Rehabilitation', 200, 1),
(84, 486, 'BF', 259, 'Daycare Center', 300, 1),
(84, 487, 'BF', 260, 'Road Concreting', 400, 1),
(84, 488, 'BF', 261, 'MES', 500, 1),
(84, 489, 'BF', 262, 'Foodbridge Lower Lahug', 600, 1),
(84, 490, 'BF', 263, 'MNHS', 700, 1),
(84, 491, 'BF', 264, 'SAMPIG ELEM. SCHOOL', 800, 1),
(84, 492, 'BF', 265, 'SUMAFA WOMENS', 900, 1),
(84, 493, 'TA', 266, 'WATER RESERVOIR', 0, 1),
(84, 494, 'BF', 266, 'WATER RESERVOIR', 0, 1),
(85, 495, 'ap_total_TA', 0, '', 0, 1),
(85, 496, 'TA', 267, 'Data 1', 0, 1),
(85, 497, 'TA', 268, 'Electrification', 0, 1),
(85, 498, 'TA', 269, 'Road Rehabilitation', 0, 1),
(85, 499, 'TA', 270, 'Daycare Center', 0, 1),
(85, 500, 'TA', 271, 'Road Concreting', 0, 1),
(85, 501, 'TA', 272, 'MES', 0, 1),
(85, 502, 'TA', 273, 'Foodbridge Lower Lahug', 0, 1),
(85, 503, 'TA', 274, 'MNHS', 0, 1),
(85, 504, 'TA', 275, 'SAMPIG ELEM. SCHOOL', 0, 1),
(85, 505, 'TA', 276, 'SUMAFA WOMENS', 0, 1),
(85, 506, 'TA', 277, 'WATER RESERVOIR', 0, 1),
(85, 507, 'ap_total_BF', 0, '', 0, 1),
(85, 508, 'BF', 267, 'Data 1', 0, 1),
(85, 509, 'BF', 268, 'Electrification', 0, 1),
(85, 510, 'BF', 269, 'Road Rehabilitation', 0, 1),
(85, 511, 'BF', 270, 'Daycare Center', 0, 1),
(85, 512, 'BF', 271, 'Road Concreting', 0, 1),
(85, 513, 'BF', 272, 'MES', 0, 1),
(85, 514, 'BF', 273, 'Foodbridge Lower Lahug', 0, 1),
(85, 515, 'BF', 274, 'MNHS', 0, 1),
(85, 516, 'BF', 275, 'SAMPIG ELEM. SCHOOL', 0, 1),
(85, 517, 'BF', 276, 'SUMAFA WOMENS', 0, 1),
(85, 518, 'BF', 277, 'WATER RESERVOIR', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_cont_ap_totals`
--
ALTER TABLE `tb_rao_cont_ap_totals`
  ADD PRIMARY KEY (`rao_cont_ap_total_id`),
  ADD KEY `tb_rao_cont_ap_totals_ibfk_1` (`rao_cont_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_cont_ap_totals`
--
ALTER TABLE `tb_rao_cont_ap_totals`
  MODIFY `rao_cont_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=519;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_cont_ap_totals`
--
ALTER TABLE `tb_rao_cont_ap_totals`
  ADD CONSTRAINT `tb_rao_cont_ap_totals_ibfk_1` FOREIGN KEY (`rao_cont_id`) REFERENCES `tb_rao_cont` (`rao_cont_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
