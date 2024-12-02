-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 04:31 AM
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
-- Table structure for table `tb_rao_ps_ob`
--

CREATE TABLE `tb_rao_ps_ob` (
  `rao_ps_id` int(11) NOT NULL,
  `rao_ps_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_total` double NOT NULL,
  `ob_salary` double NOT NULL,
  `ob_cash_gift` double NOT NULL,
  `ob_year_end` double NOT NULL,
  `ob_mid_year` double NOT NULL,
  `ob_sri` double NOT NULL,
  `ob_others` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_ps_ob`
--

INSERT INTO `tb_rao_ps_ob` (`rao_ps_id`, `rao_ps_ob_id`, `ob_ref_date`, `ob_ref_no`, `ob_particulars`, `ob_total`, `ob_salary`, `ob_cash_gift`, `ob_year_end`, `ob_mid_year`, `ob_sri`, `ob_others`, `isDisplayed`) VALUES
(7, 1, '2024-12-02', 'Obligations', 'Salary and Wages: Tanod', 98000, 48000, 48000, 1000, 1000, 0, 0, 1),
(7, 2, '2024-12-01', 'Obligations', 'Salary and Wages: Tanod', 100000, 50000, 50000, 0, 0, 0, 0, 1),
(7, 3, '2024-12-02', 'Obligations', 'Salary and Wages: Additional', 23500, 15000, 0, 0, 8500, 0, 0, 1),
(7, 4, '2024-12-02', 'Obligations', 'Salary and Wages: Additional', 23500, 15000, 0, 0, 8500, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_ps_ob`
--
ALTER TABLE `tb_rao_ps_ob`
  ADD PRIMARY KEY (`rao_ps_ob_id`),
  ADD KEY `rao_ps_id` (`rao_ps_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_ps_ob`
--
ALTER TABLE `tb_rao_ps_ob`
  MODIFY `rao_ps_ob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_ps_ob`
--
ALTER TABLE `tb_rao_ps_ob`
  ADD CONSTRAINT `tb_rao_ps_ob_ibfk_1` FOREIGN KEY (`rao_ps_id`) REFERENCES `tb_rao_ps` (`rao_ps_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
