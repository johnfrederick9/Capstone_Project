-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 09:22 AM
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
-- Table structure for table `tb_rao_sk_ob_data`
--

CREATE TABLE `tb_rao_sk_ob_data` (
  `rao_sk_ob_data_id` int(11) NOT NULL,
  `rao_sk_ob_id` int(11) NOT NULL,
  `rao_sk_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_rao_sk_ob_data`
--
ALTER TABLE `tb_rao_sk_ob_data`
  ADD PRIMARY KEY (`rao_sk_ob_data_id`),
  ADD KEY `rao_sk_ob_id` (`rao_sk_ob_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_rao_sk_ob_data`
--
ALTER TABLE `tb_rao_sk_ob_data`
  MODIFY `rao_sk_ob_data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rao_sk_ob_data`
--
ALTER TABLE `tb_rao_sk_ob_data`
  ADD CONSTRAINT `tb_rao_sk_ob_data_ibfk_1` FOREIGN KEY (`rao_sk_ob_id`) REFERENCES `tb_rao_sk_ob` (`rao_sk_ob_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
