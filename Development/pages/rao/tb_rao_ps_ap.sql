-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 04:30 AM
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
-- Table structure for table `tb_rao_ps_ap`
--

CREATE TABLE `tb_rao_ps_ap` (
  `rao_ps_id` int(11) NOT NULL,
  `rao_ps_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_total` double NOT NULL,
  `ap_salary` double NOT NULL,
  `ap_cash_gift` double NOT NULL,
  `ap_year_end` double NOT NULL,
  `ap_mid_year` double NOT NULL,
  `ap_sri` double NOT NULL,
  `ap_others` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_ps_ap`
--

INSERT INTO `tb_rao_ps_ap` (`rao_ps_id`, `rao_ps_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_total`, `ap_salary`, `ap_cash_gift`, `ap_year_end`, `ap_mid_year`, `ap_sri`, `ap_others`, `isDisplayed`) VALUES
(7, 1, '2024-12-01', 'Appropriations', 'Annual Budget', 5134533.86, 4242000, 110000, 178000, 178000, 220000, 206533.86, 1),
(7, 2, '2024-12-01', 'Appropriations', 'Additional', 100000, 100000, 0, 0, 0, 0, 0, 1),
(7, 3, '2024-12-01', 'Appropriations', 'Additional', 100000, 100000, 0, 0, 0, 0, 0, 1),
(8, 4, '2024-11-01', 'Appropriations', 'Annual Budget', 26000, 12000, 14000, 0, 0, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_ps_ap`
--
ALTER TABLE `tb_rao_ps_ap`
  ADD PRIMARY KEY (`rao_ps_ap_id`),
  ADD KEY `rao_ps_id` (`rao_ps_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_ps_ap`
--
ALTER TABLE `tb_rao_ps_ap`
  MODIFY `rao_ps_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_ps_ap`
--
ALTER TABLE `tb_rao_ps_ap`
  ADD CONSTRAINT `tb_rao_ps_ap_ibfk_1` FOREIGN KEY (`rao_ps_id`) REFERENCES `tb_rao_ps` (`rao_ps_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
