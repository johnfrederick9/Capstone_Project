-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 05:47 PM
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
-- Table structure for table `tb_item_transaction`
--

CREATE TABLE `tb_item_transaction` (
  `transaction_id` int(11) NOT NULL,
  `borrower_name` varchar(255) NOT NULL,
  `borrower_address` varchar(255) NOT NULL,
  `reserved_on` date NOT NULL,
  `date_borrowed` date NOT NULL,
  `return_date` date NOT NULL,
  `approved_by` varchar(255) NOT NULL,
  `released_by` varchar(255) NOT NULL,
  `returned_by` varchar(255) DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `transaction_status` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_item_transaction`
--

INSERT INTO `tb_item_transaction` (`transaction_id`, `borrower_name`, `borrower_address`, `reserved_on`, `date_borrowed`, `return_date`, `approved_by`, `released_by`, `returned_by`, `date_returned`, `transaction_status`, `isDisplayed`) VALUES
(12, 'Joshua Belandres', 'Mantalongon ', '2024-09-23', '2024-09-23', '2024-09-23', 'Zenaida Belandres', 'Angebon Reyes', 'John Frederick Gelay', '2024-09-25', 'Completed', 1),
(13, 'Joshua Belandres', 'Mantalongon ', '2024-09-23', '2024-09-23', '2024-09-23', 'Zenaida Belandres', 'Angebon Reyes', '', '0000-00-00', 'Ongoing', 0),
(14, 'Angebon Reyes', 'Mantalongon ', '2024-09-25', '2024-09-25', '2024-09-25', 'Zenaida Belandres', 'Angebon Reyes', NULL, NULL, 'Ongoing', 0),
(15, 'Joshua Belandres', 'Mantalongon ', '2024-09-25', '2024-09-25', '2024-09-25', 'Zenaida Belandres', 'Angebon Reyes', NULL, NULL, 'Ongoing', 0),
(16, 'Joshua Belandres', 'Mantalongon ', '2024-09-25', '2024-09-25', '2024-09-25', 'Zenaida Belandres', 'Angebon Reyes', NULL, NULL, 'Ongoing', 0),
(17, 'Joshua Belandres', 'Mantalongon ', '2024-09-25', '2024-09-25', '2024-09-25', 'Zenaida Belandres', 'Angebon Reyes', NULL, NULL, 'Ongoing', 0),
(18, 'Joshua Belandres', 'Mantalongon ', '2024-09-25', '2024-09-25', '2024-09-25', 'Zenaida Belandres', 'Angebon Reyes', NULL, NULL, 'Ongoing', 0),
(19, 'Joshua Belandres', 'Mantalongon ', '2024-09-25', '2024-09-25', '2024-09-25', 'Zenaida Belandres', 'Angebon Reyes', NULL, NULL, 'Ongoing', 0),
(20, 'Joshua Belandres', 'Mantalongon ', '2024-09-25', '2024-09-25', '2024-09-25', 'Zenaida Belandres', 'Angebon Reyes', NULL, NULL, 'Ongoing', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_item_transaction`
--
ALTER TABLE `tb_item_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_item_transaction`
--
ALTER TABLE `tb_item_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
