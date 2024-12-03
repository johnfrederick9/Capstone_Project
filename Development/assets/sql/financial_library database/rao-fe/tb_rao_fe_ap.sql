-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 01:34 AM
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
-- Table structure for table `tb_rao_fe_ap`
--

CREATE TABLE `tb_rao_fe_ap` (
  `rao_fe_id` int(11) NOT NULL,
  `rao_fe_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_ap`
--

INSERT INTO `tb_rao_fe_ap` (`rao_fe_id`, `rao_fe_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(1, 1, '2024-12-01', 'Appropriations', 'Annual Budget', 453.58),
(4, 2, '2024-09-01', 'Appropriations', 'Annual Budget', 601.65),
(4, 3, '2024-09-01', 'Appropriations', 'Additional', 60);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_fe_ap`
--
ALTER TABLE `tb_rao_fe_ap`
  ADD PRIMARY KEY (`rao_fe_ap_id`),
  ADD KEY `rao_fe_id` (`rao_fe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_fe_ap`
--
ALTER TABLE `tb_rao_fe_ap`
  MODIFY `rao_fe_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_fe_ap`
--
ALTER TABLE `tb_rao_fe_ap`
  ADD CONSTRAINT `tb_rao_fe_ap_ibfk_1` FOREIGN KEY (`rao_fe_id`) REFERENCES `tb_rao_fe` (`rao_fe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
