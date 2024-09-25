-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 05:49 PM
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
-- Table structure for table `tb_inventory`
--

CREATE TABLE `tb_inventory` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(120) NOT NULL,
  `item_description` varchar(120) NOT NULL,
  `item_brand` varchar(255) NOT NULL,
  `item_serialNo` varchar(255) NOT NULL,
  `item_custodian` varchar(255) NOT NULL,
  `item_count` int(11) NOT NULL,
  `item_price` double NOT NULL,
  `item_amount` double NOT NULL,
  `item_year` year(4) NOT NULL,
  `item_status` varchar(50) NOT NULL,
  `lendability` tinyint(4) NOT NULL,
  `lendable_count` int(11) NOT NULL,
  `available_count` int(11) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_inventory`
--

INSERT INTO `tb_inventory` (`item_id`, `item_name`, `item_description`, `item_brand`, `item_serialNo`, `item_custodian`, `item_count`, `item_price`, `item_amount`, `item_year`, `item_status`, `lendability`, `lendable_count`, `available_count`, `isDisplayed`) VALUES
(105, 'STOOLS', 'Cream Color', 'MonoBlock', 'None', 'Joshua Belandres', 123, 321, 39483, '2019', 'Serviceable', 1, 53, 44, 1),
(106, 'Table', 'Ivory Color', 'MonoBlock', 'None', 'Barangay ', 35, 520, 18200, '2019', 'Serviceable', 1, 35, 36, 1),
(107, 'Monoblock Chair', 'with backrest', 'MonoBlock', 'None', 'Barangay ', 410, 650, 266500, '2020', 'Serviceable', 1, 400, 400, 1),
(108, 'cONCRETE MIXER', 'white orange', 'KOMATSU', 'SN: NVXPV00E202193.347600', 'Barangay ', 2, 75000, 150000, '2023', 'Serviceable', 1, 2, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_inventory`
--
ALTER TABLE `tb_inventory`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_inventory`
--
ALTER TABLE `tb_inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
