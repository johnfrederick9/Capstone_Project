-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 05:35 AM
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
-- Table structure for table `tb_rao_cont_ap`
--

CREATE TABLE `tb_rao_cont_ap` (
  `rao_cont_id` int(11) NOT NULL,
  `rao_cont_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ap`
--

INSERT INTO `tb_rao_cont_ap` (`rao_cont_id`, `rao_cont_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(83, 63, '2024-11-01', 'Appropriations', 'Annual Budget', 100),
(83, 64, '2024-11-02', 'Appropriations', 'Additional', 100),
(84, 65, '2024-10-01', 'Appropriations', 'Annual Budget', 4500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_cont_ap`
--
ALTER TABLE `tb_rao_cont_ap`
  ADD PRIMARY KEY (`rao_cont_ap_id`),
  ADD KEY `rao_cont_id` (`rao_cont_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_cont_ap`
--
ALTER TABLE `tb_rao_cont_ap`
  MODIFY `rao_cont_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_cont_ap`
--
ALTER TABLE `tb_rao_cont_ap`
  ADD CONSTRAINT `tb_rao_cont_ap_ibfk_1` FOREIGN KEY (`rao_cont_id`) REFERENCES `tb_rao_cont` (`rao_cont_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
