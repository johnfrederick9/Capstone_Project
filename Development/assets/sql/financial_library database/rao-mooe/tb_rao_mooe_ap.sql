-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 05:07 PM
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
-- Table structure for table `tb_rao_mooe_ap`
--

CREATE TABLE `tb_rao_mooe_ap` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ap`
--

INSERT INTO `tb_rao_mooe_ap` (`rao_mooe_id`, `rao_mooe_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(7, 7, '2024-12-01', 'Appropriations', 'Annual Budget', 522827.97),
(9, 8, '2024-10-01', 'Appropriations', 'Annual Budget', 12786.25),
(10, 9, '2024-11-01', 'Appropriations', 'Annual Budget', 1561);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_mooe_ap`
--
ALTER TABLE `tb_rao_mooe_ap`
  ADD PRIMARY KEY (`rao_mooe_ap_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ap`
--
ALTER TABLE `tb_rao_mooe_ap`
  MODIFY `rao_mooe_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_mooe_ap`
--
ALTER TABLE `tb_rao_mooe_ap`
  ADD CONSTRAINT `tb_rao_mooe_ap_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
