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
-- Table structure for table `tb_rao_cont_ap_data`
--

CREATE TABLE `tb_rao_cont_ap_data` (
  `rao_cont_ap_data_id` int(11) NOT NULL,
  `rao_cont_ap_id` int(11) NOT NULL,
  `rao_cont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ap_data`
--

INSERT INTO `tb_rao_cont_ap_data` (`rao_cont_ap_data_id`, `rao_cont_ap_id`, `rao_cont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(548, 63, 256, 'Data 1', 100, 0),
(549, 64, 256, 'Data 1', 100, 0),
(550, 65, 257, 'Electrification', 100, 1),
(551, 65, 258, 'Road Rehabilitation', 200, 1),
(552, 65, 259, 'Daycare Center', 300, 1),
(553, 65, 260, 'Road Concreting', 400, 1),
(554, 65, 261, 'MES', 500, 1),
(555, 65, 262, 'Foodbridge Lower Lahug', 600, 1),
(556, 65, 263, 'MNHS', 700, 1),
(557, 65, 264, 'SAMPIG ELEM. SCHOOL', 800, 1),
(558, 65, 265, 'SUMAFA WOMENS', 900, 1),
(559, 65, 266, 'WATER RESERVOIR', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_cont_ap_data`
--
ALTER TABLE `tb_rao_cont_ap_data`
  ADD PRIMARY KEY (`rao_cont_ap_data_id`),
  ADD KEY `rao_cont_ap_id` (`rao_cont_ap_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_cont_ap_data`
--
ALTER TABLE `tb_rao_cont_ap_data`
  MODIFY `rao_cont_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=560;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
