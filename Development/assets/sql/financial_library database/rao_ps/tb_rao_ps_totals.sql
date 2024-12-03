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
-- Table structure for table `tb_rao_ps_totals`
--

CREATE TABLE `tb_rao_ps_totals` (
  `rao_ps_total_id` int(11) NOT NULL,
  `rao_ps_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `salary` double NOT NULL,
  `cash_gift` double NOT NULL,
  `year_end` double NOT NULL,
  `mid_year` double NOT NULL,
  `sri` double NOT NULL,
  `others` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_ps_totals`
--

INSERT INTO `tb_rao_ps_totals` (`rao_ps_total_id`, `rao_ps_id`, `total_type`, `total`, `salary`, `cash_gift`, `year_end`, `mid_year`, `sri`, `others`, `isDisplayed`) VALUES
(1, 7, 'TA', 26000, 12000, 14000, 0, 0, 0, 0, 1),
(2, 7, 'BF', 26000, 12000, 14000, 0, 0, 0, 0, 1),
(3, 7, 'TO', 0, 0, 0, 0, 0, 0, 0, 1),
(4, 7, 'OB', 0, 0, 0, 0, 0, 0, 0, 1),
(5, 7, 'AB', 26000, 12000, 14000, 0, 0, 0, 0, 1),
(6, 8, 'TA', 26000, 12000, 14000, 0, 0, 0, 0, 1),
(7, 8, 'BF', 26000, 12000, 14000, 0, 0, 0, 0, 1),
(8, 8, 'TO', 0, 0, 0, 0, 0, 0, 0, 1),
(9, 8, 'OB', 0, 0, 0, 0, 0, 0, 0, 1),
(10, 8, 'AB', 26000, 12000, 14000, 0, 0, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_ps_totals`
--
ALTER TABLE `tb_rao_ps_totals`
  ADD PRIMARY KEY (`rao_ps_total_id`),
  ADD KEY `rao_ps_id` (`rao_ps_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_ps_totals`
--
ALTER TABLE `tb_rao_ps_totals`
  MODIFY `rao_ps_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
