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
-- Table structure for table `tb_transaction_items`
--

CREATE TABLE `tb_transaction_items` (
  `transaction_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `borrow_quantity` int(11) NOT NULL,
  `return_quantity` int(11) NOT NULL,
  `item_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaction_items`
--

INSERT INTO `tb_transaction_items` (`transaction_id`, `item_id`, `item_name`, `borrow_quantity`, `return_quantity`, `item_status`) VALUES
(12, 105, 'STOOLS', 1, 1, 'Returned'),
(12, 106, 'Table', 1, 1, 'Returned'),
(14, 105, 'STOOLS', 1, 0, 'Borrowed'),
(15, 105, 'STOOLS', 1, 1, 'Borrowed'),
(16, 105, 'STOOLS', 1, 1, 'Borrowed'),
(17, 105, 'STOOLS', 1, 1, 'Returned'),
(18, 105, 'STOOLS', 1, 1, 'Returned'),
(19, 105, 'STOOLS', 1, 1, 'Returned'),
(20, 105, 'STOOLS', 1, 1, 'Returned');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_transaction_items`
--
ALTER TABLE `tb_transaction_items`
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_transaction_items`
--
ALTER TABLE `tb_transaction_items`
  ADD CONSTRAINT `tb_transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `tb_item_transaction` (`transaction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
