-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 05:37 AM
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
-- Table structure for table `tb_rao_cont_ob_totals`
--

CREATE TABLE `tb_rao_cont_ob_totals` (
  `rao_cont_id` int(11) NOT NULL,
  `rao_cont_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_cont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ob_totals`
--

INSERT INTO `tb_rao_cont_ob_totals` (`rao_cont_id`, `rao_cont_ob_total_id`, `total_type`, `rao_cont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(83, 703, 'ob_total_TO', 0, '', 10, 0),
(83, 704, 'TO', 256, 'Data 1', 10, 0),
(83, 705, 'ob_total_OB', 0, '', 10, 0),
(83, 706, 'OB', 256, 'Data 1', 10, 0),
(83, 707, 'ob_total_AB', 0, '', 190, 0),
(83, 708, 'AB', 256, 'Data 1', 190, 0),
(84, 709, 'ob_total_TO', 0, '', 0, 1),
(84, 710, 'TO', 257, 'Electrification', 0, 1),
(84, 711, 'TO', 258, 'Road Rehabilitation', 0, 1),
(84, 712, 'TO', 259, 'Daycare Center', 0, 1),
(84, 713, 'TO', 260, 'Road Concreting', 0, 1),
(84, 714, 'TO', 261, 'MES', 0, 1),
(84, 715, 'TO', 262, 'Foodbridge Lower Lahug', 0, 1),
(84, 716, 'TO', 263, 'MNHS', 0, 1),
(84, 717, 'TO', 264, 'SAMPIG ELEM. SCHOOL', 0, 1),
(84, 718, 'TO', 265, 'SUMAFA WOMENS', 0, 1),
(84, 719, 'ob_total_OB', 0, '', 0, 1),
(84, 720, 'OB', 257, 'Electrification', 0, 1),
(84, 721, 'OB', 258, 'Road Rehabilitation', 0, 1),
(84, 722, 'OB', 259, 'Daycare Center', 0, 1),
(84, 723, 'OB', 260, 'Road Concreting', 0, 1),
(84, 724, 'OB', 261, 'MES', 0, 1),
(84, 725, 'OB', 262, 'Foodbridge Lower Lahug', 0, 1),
(84, 726, 'OB', 263, 'MNHS', 0, 1),
(84, 727, 'OB', 264, 'SAMPIG ELEM. SCHOOL', 0, 1),
(84, 728, 'OB', 265, 'SUMAFA WOMENS', 0, 1),
(84, 729, 'ob_total_AB', 0, '', 4500, 1),
(84, 730, 'AB', 257, 'Electrification', 100, 1),
(84, 731, 'AB', 258, 'Road Rehabilitation', 200, 1),
(84, 732, 'AB', 259, 'Daycare Center', 300, 1),
(84, 733, 'AB', 260, 'Road Concreting', 400, 1),
(84, 734, 'AB', 261, 'MES', 500, 1),
(84, 735, 'AB', 262, 'Foodbridge Lower Lahug', 600, 1),
(84, 736, 'AB', 263, 'MNHS', 700, 1),
(84, 737, 'AB', 264, 'SAMPIG ELEM. SCHOOL', 800, 1),
(84, 738, 'AB', 265, 'SUMAFA WOMENS', 900, 1),
(84, 739, 'TO', 266, 'WATER RESERVOIR', 0, 1),
(84, 740, 'OB', 266, 'WATER RESERVOIR', 0, 1),
(84, 741, 'AB', 266, 'WATER RESERVOIR', 0, 1),
(85, 742, 'ob_total_TO', 0, '', 0, 1),
(85, 743, 'TO', 267, 'Data 1', 0, 1),
(85, 744, 'TO', 268, 'Electrification', 0, 1),
(85, 745, 'TO', 269, 'Road Rehabilitation', 0, 1),
(85, 746, 'TO', 270, 'Daycare Center', 0, 1),
(85, 747, 'TO', 271, 'Road Concreting', 0, 1),
(85, 748, 'TO', 272, 'MES', 0, 1),
(85, 749, 'TO', 273, 'Foodbridge Lower Lahug', 0, 1),
(85, 750, 'TO', 274, 'MNHS', 0, 1),
(85, 751, 'TO', 275, 'SAMPIG ELEM. SCHOOL', 0, 1),
(85, 752, 'TO', 276, 'SUMAFA WOMENS', 0, 1),
(85, 753, 'TO', 277, 'WATER RESERVOIR', 0, 1),
(85, 754, 'ob_total_OB', 0, '', 0, 1),
(85, 755, 'OB', 267, 'Data 1', 0, 1),
(85, 756, 'OB', 268, 'Electrification', 0, 1),
(85, 757, 'OB', 269, 'Road Rehabilitation', 0, 1),
(85, 758, 'OB', 270, 'Daycare Center', 0, 1),
(85, 759, 'OB', 271, 'Road Concreting', 0, 1),
(85, 760, 'OB', 272, 'MES', 0, 1),
(85, 761, 'OB', 273, 'Foodbridge Lower Lahug', 0, 1),
(85, 762, 'OB', 274, 'MNHS', 0, 1),
(85, 763, 'OB', 275, 'SAMPIG ELEM. SCHOOL', 0, 1),
(85, 764, 'OB', 276, 'SUMAFA WOMENS', 0, 1),
(85, 765, 'OB', 277, 'WATER RESERVOIR', 0, 1),
(85, 766, 'ob_total_AB', 0, '', 0, 1),
(85, 767, 'AB', 267, 'Data 1', 0, 1),
(85, 768, 'AB', 268, 'Electrification', 0, 1),
(85, 769, 'AB', 269, 'Road Rehabilitation', 0, 1),
(85, 770, 'AB', 270, 'Daycare Center', 0, 1),
(85, 771, 'AB', 271, 'Road Concreting', 0, 1),
(85, 772, 'AB', 272, 'MES', 0, 1),
(85, 773, 'AB', 273, 'Foodbridge Lower Lahug', 0, 1),
(85, 774, 'AB', 274, 'MNHS', 0, 1),
(85, 775, 'AB', 275, 'SAMPIG ELEM. SCHOOL', 0, 1),
(85, 776, 'AB', 276, 'SUMAFA WOMENS', 0, 1),
(85, 777, 'AB', 277, 'WATER RESERVOIR', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_cont_ob_totals`
--
ALTER TABLE `tb_rao_cont_ob_totals`
  ADD PRIMARY KEY (`rao_cont_ob_total_id`),
  ADD KEY `rao_cont_id` (`rao_cont_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_cont_ob_totals`
--
ALTER TABLE `tb_rao_cont_ob_totals`
  MODIFY `rao_cont_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=778;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_cont_ob_totals`
--
ALTER TABLE `tb_rao_cont_ob_totals`
  ADD CONSTRAINT `tb_rao_cont_ob_totals_ibfk_1` FOREIGN KEY (`rao_cont_id`) REFERENCES `tb_rao_cont` (`rao_cont_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
