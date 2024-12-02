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
-- Table structure for table `tb_rao_mooe_ob`
--

CREATE TABLE `tb_rao_mooe_ob` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ob`
--

INSERT INTO `tb_rao_mooe_ob` (`rao_mooe_id`, `rao_mooe_ob_id`, `ob_ref_date`, `ob_ref_no`, `ob_particulars`, `ob_totals`) VALUES
(7, 3, '2024-12-01', 'Obligations', 'Salary and Wages: Tanod', 431400.32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_mooe_ob`
--
ALTER TABLE `tb_rao_mooe_ob`
  ADD PRIMARY KEY (`rao_mooe_ob_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ob`
--
ALTER TABLE `tb_rao_mooe_ob`
  MODIFY `rao_mooe_ob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_mooe_ob`
--
ALTER TABLE `tb_rao_mooe_ob`
  ADD CONSTRAINT `tb_rao_mooe_ob_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
