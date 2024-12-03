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
-- Table structure for table `tb_cashbook`
--

CREATE TABLE `tb_cashbook` (
  `cashbook_id` int(11) NOT NULL,
  `period_covered` date NOT NULL,
  `treasurer_name` varchar(255) NOT NULL,
  `clt_init_balance` double NOT NULL,
  `clt_end_in` double NOT NULL,
  `clt_end_out` double NOT NULL,
  `clt_end_balance` double NOT NULL,
  `cb_init_balance` double NOT NULL,
  `cb_end_in` double NOT NULL,
  `cb_end_out` double NOT NULL,
  `cb_end_balance` double NOT NULL,
  `ca_end_receipt` double NOT NULL,
  `ca_end_disbursement` double NOT NULL,
  `ca_end_balance` double NOT NULL,
  `pcf_end_receipt` double NOT NULL,
  `pcf_end_payments` double NOT NULL,
  `pcf_end_balance` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cashbook`
--

INSERT INTO `tb_cashbook` (`cashbook_id`, `period_covered`, `treasurer_name`, `clt_init_balance`, `clt_end_in`, `clt_end_out`, `clt_end_balance`, `cb_init_balance`, `cb_end_in`, `cb_end_out`, `cb_end_balance`, `ca_end_receipt`, `ca_end_disbursement`, `ca_end_balance`, `pcf_end_receipt`, `pcf_end_payments`, `pcf_end_balance`, `isDisplayed`) VALUES
(5, '2024-09-01', 'Joshua Belandres', 1000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(6, '2024-08-01', 'John Frederick Gelay', 1000, 100, 0, 1100, 1000, 100, 1000, 100, 0, 0, 0, 0, 0, 0, 1),
(7, '2024-06-02', 'Joshua Belandres', 1000, 100, 0, 1100, 1000, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 1),
(8, '2024-05-01', 'Joshua Belandres', 1000, 100, 0, 1100, 1000, 100, 0, 1100, 0, 0, 0, 0, 0, 0, 1),
(11, '2023-10-01', 'Joshua Belandres', 1000, 223, 323, 900, 1000, 223, 332, 891, 323, 223, 100, 223, 173, 50, 1),
(12, '2023-11-01', 'Joshua Belandres', 12345, 123, 123, 12345, 12345, 123, 123, 12345, 123, 123, 0, 123, 123, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cashbook`
--
ALTER TABLE `tb_cashbook`
  ADD PRIMARY KEY (`cashbook_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cashbook`
--
ALTER TABLE `tb_cashbook`
  MODIFY `cashbook_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
