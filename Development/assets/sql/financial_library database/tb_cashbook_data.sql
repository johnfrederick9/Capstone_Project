-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 03:29 PM
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
-- Database: `db_barangay`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_cashbook_data`
--

CREATE TABLE `tb_cashbook_data` (
  `cashbook_id` int(11) NOT NULL,
  `cashbook_data_id` int(11) NOT NULL,
  `date_data` varchar(255) NOT NULL,
  `particulars_1` varchar(255) NOT NULL,
  `particulars_2` varchar(255) NOT NULL,
  `reference_1` varchar(255) NOT NULL,
  `reference_2` varchar(255) NOT NULL,
  `clt_in` double NOT NULL,
  `clt_out` double NOT NULL,
  `clt_balance` double NOT NULL,
  `cb_in` double NOT NULL,
  `cb_out` double NOT NULL,
  `cb_balance` double NOT NULL,
  `ca_receipt` double NOT NULL,
  `ca_disbursement` double NOT NULL,
  `ca_balance` double NOT NULL,
  `pcf_receipt` double NOT NULL,
  `pcf_payments` double NOT NULL,
  `pcf_balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cashbook_data`
--

INSERT INTO `tb_cashbook_data` (`cashbook_id`, `cashbook_data_id`, `date_data`, `particulars_1`, `particulars_2`, `reference_1`, `reference_2`, `clt_in`, `clt_out`, `clt_balance`, `cb_in`, `cb_out`, `cb_balance`, `ca_receipt`, `ca_disbursement`, `ca_balance`, `pcf_receipt`, `pcf_payments`, `pcf_balance`) VALUES
(5, 2, '2024-09-01', 'VARIOUS PAYORS', '', '', '2024-09-3', 0, 0, 1000, 100, 0, 1100, 0, 0, 0, 0, 0, 0),
(6, 3, '2024-08-01', 'VARIOUS PAYORS', '', 'RDC NO', '', 100, 0, 1100, 100, 1000, 100, 0, 0, 0, 0, 0, 0),
(7, 4, '2024-06-01', 'VARIOUS PAYORS', '', 'RDC NO', '', 100, 0, 1100, 0, 0, 1000, 0, 0, 0, 0, 0, 0),
(8, 5, '2024-05-01', 'VARIOUS PAYORS', '', 'RDC NO', '', 100, 0, 1100, 100, 0, 1100, 0, 0, 0, 0, 0, 0),
(11, 9, '2023-10-02', 'VARIOUS PAYORS', 'COLLECTION AND DEPOSITS', 'RDC NO', '2024-09-3', 100, 200, 900, 100, 200, 900, 200, 100, 100, 100, 50, 50),
(11, 11, '2023-10-03', 'VARIOUS PAYORS', 'COLLECTION AND DEPOSITS', 'RDC NO', '2024-09-3', 123, 123, 900, 123, 132, 891, 123, 123, 100, 123, 123, 50),
(12, 12, '2023-11-01', 'VARIOUS PAYORS', 'COLLECTION AND DEPOSITS', 'RDC NO', '2024-09-3', 123, 123, 12345, 123, 123, 12345, 123, 123, 0, 123, 123, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cashbook_data`
--
ALTER TABLE `tb_cashbook_data`
  ADD PRIMARY KEY (`cashbook_data_id`),
  ADD KEY `cashbook_id` (`cashbook_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cashbook_data`
--
ALTER TABLE `tb_cashbook_data`
  MODIFY `cashbook_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_cashbook_data`
--
ALTER TABLE `tb_cashbook_data`
  ADD CONSTRAINT `tb_cashbook_data_ibfk_1` FOREIGN KEY (`cashbook_id`) REFERENCES `tb_cashbook` (`cashbook_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
