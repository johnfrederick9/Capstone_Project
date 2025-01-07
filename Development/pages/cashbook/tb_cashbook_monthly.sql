-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 06:01 PM
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
-- Table structure for table `tb_cashbook_monthly`
--

CREATE TABLE `tb_cashbook_monthly` (
  `cashbook_id` int(11) NOT NULL,
  `monthly_id` int(11) NOT NULL,
  `date_data` date NOT NULL,
  `clt_init_balance` double NOT NULL,
  `clt_end_balance` double NOT NULL,
  `cb_init_balance` double NOT NULL,
  `cb_end_balance` double NOT NULL,
  `isDefaultCb` tinyint(4) NOT NULL,
  `isDefaultClt` tinyint(4) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cashbook_monthly`
--
ALTER TABLE `tb_cashbook_monthly`
  ADD PRIMARY KEY (`monthly_id`),
  ADD KEY `cashbook_id` (`cashbook_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cashbook_monthly`
--
ALTER TABLE `tb_cashbook_monthly`
  MODIFY `monthly_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_cashbook_monthly`
--
ALTER TABLE `tb_cashbook_monthly`
  ADD CONSTRAINT `tb_cashbook_monthly_ibfk_1` FOREIGN KEY (`cashbook_id`) REFERENCES `tb_cashbook` (`cashbook_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
