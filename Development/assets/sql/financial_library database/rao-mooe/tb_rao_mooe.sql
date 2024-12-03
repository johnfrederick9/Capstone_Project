-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 05:07 PM
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
-- Table structure for table `tb_rao_mooe`
--

CREATE TABLE `tb_rao_mooe` (
  `rao_mooe_id` int(11) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `period_covered` date NOT NULL,
  `brgy_captain` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe`
--

INSERT INTO `tb_rao_mooe` (`rao_mooe_id`, `chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) VALUES
(7, 'Angebon Reyes', '2024-12-01', 'Joshua Belandres', 1),
(8, 'Pending...', '0000-00-00', 'Pending...', 1),
(9, 'Angebon Reyes', '2024-10-01', 'Joshua Belandres', 1),
(10, 'John Frederick Gelay', '2024-11-01', 'Joshua Belandres', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_mooe`
--
ALTER TABLE `tb_rao_mooe`
  ADD PRIMARY KEY (`rao_mooe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_mooe`
--
ALTER TABLE `tb_rao_mooe`
  MODIFY `rao_mooe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
