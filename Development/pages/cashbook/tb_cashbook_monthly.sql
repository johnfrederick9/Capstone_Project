-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 06:56 AM
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
  `monthly_id` int(11) NOT NULL,
  `date_data` date NOT NULL,
  `clt_init_balance` double NOT NULL,
  `clt_end_balance` double NOT NULL,
  `cb_init_balance` double NOT NULL,
  `cb_end_balance` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cashbook_monthly`
--

INSERT INTO `tb_cashbook_monthly` (`monthly_id`, `date_data`, `clt_init_balance`, `clt_end_balance`, `cb_init_balance`, `cb_end_balance`, `isDisplayed`) VALUES
(5, '2019-05-01', 42125, 45350, 5981836.7, 6004388.21, 1),
(6, '2019-06-01', 65965, 75965, 6033858.21, 6033858.21, 0),
(7, '2019-07-01', 55350, 64130, 6004388.21, 6004388.21, 1),
(9, '2019-04-01', 52125, 62125, 5981836.7, 5981836.7, 0),
(10, '2019-03-01', 42125, 52125, 5981836.7, 5981836.7, 0),
(14, '2019-06-01', 65965, 75965, 6033858.21, 6033858.21, 0),
(15, '2019-06-01', 45350, 55350, 6004388.21, 6004388.21, 1),
(16, '2019-04-01', 32125, 42125, 5981836.7, 5981836.7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cashbook_monthly`
--
ALTER TABLE `tb_cashbook_monthly`
  ADD PRIMARY KEY (`monthly_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cashbook_monthly`
--
ALTER TABLE `tb_cashbook_monthly`
  MODIFY `monthly_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
