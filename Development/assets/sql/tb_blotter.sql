-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 04:11 AM
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
-- Table structure for table `tb_blotter`
--

CREATE TABLE `tb_blotter` (
  `blotter_id` int(11) NOT NULL,
  `blotter_complainant` varchar(255) DEFAULT NULL,
  `blotter_complainant_no` bigint(20) DEFAULT NULL,
  `blotter_complainant_add` varchar(255) DEFAULT NULL,
  `blotter_complainee` varchar(255) DEFAULT NULL,
  `blotter_complainee_no` bigint(20) DEFAULT NULL,
  `blotter_complainee_add` varchar(255) DEFAULT NULL,
  `blotter_complaint` varchar(255) DEFAULT NULL,
  `blotter_status` varchar(255) DEFAULT NULL,
  `blotter_action` varchar(255) DEFAULT NULL,
  `blotter_incidence` varchar(255) DEFAULT NULL,
  `blotter_date_recorded` date DEFAULT NULL,
  `blotter_date_settled` date DEFAULT NULL,
  `blotter_recorded_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_blotter`
--

INSERT INTO `tb_blotter` (`blotter_id`, `blotter_complainant`, `blotter_complainant_no`, `blotter_complainant_add`, `blotter_complainee`, `blotter_complainee_no`, `blotter_complainee_add`, `blotter_complaint`, `blotter_status`, `blotter_action`, `blotter_incidence`, `blotter_date_recorded`, `blotter_date_settled`, `blotter_recorded_by`) VALUES
(16, 'Pauline Cielo D. Gelay', 9686513790, 'vzxcvzx', 'John Frederick D. Gelay', 9661748034, 'zcxvxv', 'John Frederick', 'Ongoing', '2nd Option', 'Bully', '2024-10-05', '2024-10-28', 'asd'),
(17, 'John Frederick Domecillo Gelay None', 0, 'dfasdf', 'Pauline Cielo Domecillo Gelay None', 0, 'dfasdf', 'asdfasd', 'fasdf', 'asdfasd', 'fasdf', '2024-10-05', '2024-10-05', ''),
(18, 'John Frederick D. Gelay', 0, 'dasdas', 'Pauline Cielo D. Gelay', 0, 'asdasd', 'asdasd', 'asdas', 'dasda', 'sdasd', '2024-10-05', '2024-10-05', 'asd'),
(19, 'John Frederick D. Gelay', 0, 'asdf', 'Pauline Cielo D. Gelay', 0, 'asdf', 'John', 'asdf', 'asdf', 'asdf', '2024-10-05', '2024-10-05', 'asdf'),
(20, 'Pauline Cielo D. Gelay', 9686513790, 'asdf', 'John Frederick D. Gelay', 9661748034, 'asdf', 'John', 'asdf', 'asdf', 'asdf', '2024-10-05', '2024-10-05', 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_blotter`
--
ALTER TABLE `tb_blotter`
  ADD PRIMARY KEY (`blotter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_blotter`
--
ALTER TABLE `tb_blotter`
  MODIFY `blotter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
