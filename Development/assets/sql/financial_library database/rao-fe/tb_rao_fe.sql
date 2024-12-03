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
-- Table structure for table `tb_rao_fe`
--

CREATE TABLE `tb_rao_fe` (
  `rao_fe_id` int(11) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `period_covered` date NOT NULL,
  `brgy_captain` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe`
--

INSERT INTO `tb_rao_fe` (`rao_fe_id`, `chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) VALUES
(1, 'Angebon Reyes', '2024-12-01', 'Joshua Belandres', 1),
(2, 'Pending...', '0000-00-00', 'Pending...', 1),
(3, 'Pending...', '0000-00-00', 'Pending...', 1),
(4, 'Zenaida Belandres', '2024-09-01', 'John Frederick Gelay', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_fe`
--
ALTER TABLE `tb_rao_fe`
  ADD PRIMARY KEY (`rao_fe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_fe`
--
ALTER TABLE `tb_rao_fe`
  MODIFY `rao_fe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
