-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 03:41 AM
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
-- Table structure for table `tb_rao_dev`
--

CREATE TABLE `tb_rao_dev` (
  `rao_dev_id` int(11) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `period_covered` date NOT NULL,
  `brgy_captain` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_dev`
--

INSERT INTO `tb_rao_dev` (`rao_dev_id`, `chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) VALUES
(1, 'Joshua Belandres', '2024-12-01', 'Zenaida Belandres', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_dev`
--
ALTER TABLE `tb_rao_dev`
  ADD PRIMARY KEY (`rao_dev_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_dev`
--
ALTER TABLE `tb_rao_dev`
  MODIFY `rao_dev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
