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
-- Table structure for table `tb_rao_mooe_ob_totals`
--

CREATE TABLE `tb_rao_mooe_ob_totals` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_mooe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ob_totals`
--

INSERT INTO `tb_rao_mooe_ob_totals` (`rao_mooe_id`, `rao_mooe_ob_total_id`, `total_type`, `rao_mooe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(7, 121, 'ob_total_TO', 0, '', 431400.32, 1),
(7, 122, 'TO', 35, 'Data 1', 2435.4, 1),
(7, 123, 'TO', 36, 'Data 2', 7542.52, 1),
(7, 124, 'TO', 37, 'Data 3', 421422.4, 1),
(7, 125, 'TO', 38, 'Data 4', 0, 1),
(7, 126, 'TO', 39, 'Data 5', 0, 1),
(7, 127, 'TO', 40, 'Data 6', 0, 1),
(7, 128, 'TO', 41, 'Data 7', 0, 1),
(7, 129, 'TO', 42, 'Data 8', 0, 1),
(7, 130, 'ob_total_OB', 0, '', 431400.32, 1),
(7, 131, 'OB', 35, 'Data 1', 2435.4, 1),
(7, 132, 'OB', 36, 'Data 2', 7542.52, 1),
(7, 133, 'OB', 37, 'Data 3', 421422.4, 1),
(7, 134, 'OB', 38, 'Data 4', 0, 1),
(7, 135, 'OB', 39, 'Data 5', 0, 1),
(7, 136, 'OB', 40, 'Data 6', 0, 1),
(7, 137, 'OB', 41, 'Data 7', 0, 1),
(7, 138, 'OB', 42, 'Data 8', 0, 1),
(7, 139, 'ob_total_AB', 0, '', 91427.65, 1),
(7, 140, 'AB', 35, 'Data 1', 1921.05, 1),
(7, 141, 'AB', 36, 'Data 2', 35214.6, 1),
(7, 142, 'AB', 37, 'Data 3', 54292, 1),
(7, 143, 'AB', 38, 'Data 4', 0, 1),
(7, 144, 'AB', 39, 'Data 5', 0, 1),
(7, 145, 'AB', 40, 'Data 6', 0, 1),
(7, 146, 'AB', 41, 'Data 7', 0, 1),
(7, 147, 'AB', 42, 'Data 8', 0, 1),
(9, 148, 'ob_total_TO', 0, '', 0, 1),
(9, 149, 'TO', 51, 'Data 1', 0, 1),
(9, 150, 'TO', 52, 'Data 2', 0, 1),
(9, 151, 'TO', 53, 'Data 3', 0, 1),
(9, 152, 'TO', 54, 'Data 4', 0, 1),
(9, 153, 'TO', 55, 'Data 5', 0, 1),
(9, 154, 'TO', 56, 'Data 6', 0, 1),
(9, 155, 'TO', 57, 'Data 7', 0, 1),
(9, 156, 'TO', 58, 'Data 8', 0, 1),
(9, 157, 'ob_total_OB', 0, '', 0, 1),
(9, 158, 'OB', 51, 'Data 1', 0, 1),
(9, 159, 'OB', 52, 'Data 2', 0, 1),
(9, 160, 'OB', 53, 'Data 3', 0, 1),
(9, 161, 'OB', 54, 'Data 4', 0, 1),
(9, 162, 'OB', 55, 'Data 5', 0, 1),
(9, 163, 'OB', 56, 'Data 6', 0, 1),
(9, 164, 'OB', 57, 'Data 7', 0, 1),
(9, 165, 'OB', 58, 'Data 8', 0, 1),
(9, 166, 'ob_total_AB', 0, '', 12786.25, 1),
(9, 167, 'AB', 51, 'Data 1', 1245.25, 1),
(9, 168, 'AB', 52, 'Data 2', 11541, 1),
(9, 169, 'AB', 53, 'Data 3', 0, 1),
(9, 170, 'AB', 54, 'Data 4', 0, 1),
(9, 171, 'AB', 55, 'Data 5', 0, 1),
(9, 172, 'AB', 56, 'Data 6', 0, 1),
(9, 173, 'AB', 57, 'Data 7', 0, 1),
(9, 174, 'AB', 58, 'Data 8', 0, 1),
(10, 175, 'ob_total_TO', 0, '', 0, 1),
(10, 176, 'TO', 59, 'Data 1', 0, 1),
(10, 177, 'TO', 60, 'Data 2', 0, 1),
(10, 178, 'TO', 61, 'Data 3', 0, 1),
(10, 179, 'TO', 62, 'Data 4', 0, 1),
(10, 180, 'TO', 63, 'Data 5', 0, 1),
(10, 181, 'TO', 64, 'Data 6', 0, 1),
(10, 182, 'TO', 65, 'Data 7', 0, 1),
(10, 183, 'TO', 66, 'Data 8', 0, 1),
(10, 184, 'ob_total_OB', 0, '', 0, 1),
(10, 185, 'OB', 59, 'Data 1', 0, 1),
(10, 186, 'OB', 60, 'Data 2', 0, 1),
(10, 187, 'OB', 61, 'Data 3', 0, 1),
(10, 188, 'OB', 62, 'Data 4', 0, 1),
(10, 189, 'OB', 63, 'Data 5', 0, 1),
(10, 190, 'OB', 64, 'Data 6', 0, 1),
(10, 191, 'OB', 65, 'Data 7', 0, 1),
(10, 192, 'OB', 66, 'Data 8', 0, 1),
(10, 193, 'ob_total_AB', 0, '', 1561, 1),
(10, 194, 'AB', 59, 'Data 1', 1561, 1),
(10, 195, 'AB', 60, 'Data 2', 0, 1),
(10, 196, 'AB', 61, 'Data 3', 0, 1),
(10, 197, 'AB', 62, 'Data 4', 0, 1),
(10, 198, 'AB', 63, 'Data 5', 0, 1),
(10, 199, 'AB', 64, 'Data 6', 0, 1),
(10, 200, 'AB', 65, 'Data 7', 0, 1),
(10, 201, 'AB', 66, 'Data 8', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_mooe_ob_totals`
--
ALTER TABLE `tb_rao_mooe_ob_totals`
  ADD PRIMARY KEY (`rao_mooe_ob_total_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ob_totals`
--
ALTER TABLE `tb_rao_mooe_ob_totals`
  MODIFY `rao_mooe_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_mooe_ob_totals`
--
ALTER TABLE `tb_rao_mooe_ob_totals`
  ADD CONSTRAINT `tb_rao_mooe_ob_totals_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
