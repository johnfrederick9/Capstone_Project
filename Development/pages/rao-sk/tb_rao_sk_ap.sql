-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 09:20 AM
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
-- Table structure for table `tb_rao_sk_ap`
--

CREATE TABLE `tb_rao_sk_ap` (
  `rao_sk_id` int(11) NOT NULL,
  `rao_sk_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_sk_ap`
--

INSERT INTO `tb_rao_sk_ap` (`rao_sk_id`, `rao_sk_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(1, 1, '2024-12-01', 'Appropriations', 'Particulars', 3232.09),
(2, 2, '2024-11-01', 'Appropriations', 'SK FUNDS', 601.43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_sk_ap`
--
ALTER TABLE `tb_rao_sk_ap`
  ADD PRIMARY KEY (`rao_sk_ap_id`),
  ADD KEY `rao_sk_id` (`rao_sk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_sk_ap`
--
ALTER TABLE `tb_rao_sk_ap`
  MODIFY `rao_sk_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_sk_ap`
--
ALTER TABLE `tb_rao_sk_ap`
  ADD CONSTRAINT `tb_rao_sk_ap_ibfk_1` FOREIGN KEY (`rao_sk_id`) REFERENCES `tb_rao_sk` (`rao_sk_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
