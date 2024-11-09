-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 04:45 AM
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
  `blotter_complainant_no` varchar(100) DEFAULT NULL,
  `blotter_complainant_add` varchar(255) DEFAULT NULL,
  `blotter_complainee` varchar(255) DEFAULT NULL,
  `blotter_complainee_no` varchar(100) DEFAULT NULL,
  `blotter_complainee_add` varchar(255) DEFAULT NULL,
  `blotter_complaint` varchar(255) DEFAULT NULL,
  `blotter_status` varchar(255) DEFAULT NULL,
  `blotter_action` varchar(255) DEFAULT NULL,
  `blotter_incidence` varchar(255) DEFAULT NULL,
  `blotter_date_recorded` date DEFAULT NULL,
  `blotter_date_settled` date DEFAULT NULL,
  `blotter_recorded_by` varchar(255) DEFAULT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_blotter`
--

INSERT INTO `tb_blotter` (`blotter_id`, `blotter_complainant`, `blotter_complainant_no`, `blotter_complainant_add`, `blotter_complainee`, `blotter_complainee_no`, `blotter_complainee_add`, `blotter_complaint`, `blotter_status`, `blotter_action`, `blotter_incidence`, `blotter_date_recorded`, `blotter_date_settled`, `blotter_recorded_by`, `isDisplayed`) VALUES
(22, 'John Frederick D. Gelay', '+63 968 651 3790', 'dfasdfa', 'Pauline Cielo D. Gelay', '+63 968 651 3790', 'dafasf', 'asdfasdffss', 'asdfasdf', 'asdfasdf', 'asdfasf', '2024-10-06', '2024-10-06', 'asdf', 1),
(23, 'asdfasf a. asdf', '41646ddd', '65sd4f6 sadfasf', 'Frederick s. John ', '564644', 'asdfasf', 'asdfasf', 'sdfasf', 'sdfasf', 'sadfasfd', '2024-12-31', '2024-12-31', 'asdfsaf', 1),
(24, 'John Frederick D. Gelay', '45464', '65464', 'asdf a. asdf', '64aa', '65', '4654', '6546', '46', '464', '1111-11-11', '0011-11-04', '1', 1),
(25, 'John Frederick D. Gelay', '46464', '6546', 'john frederickl a. Gelay', '654', '646', '46', '46', '464', '64', '4645-06-04', '6546-06-06', '4654564', 0),
(26, 'Pauline Cielo D. Gelay', '+63 968 651 3790', '3123123', 'John Frederick D. Gelay', '+63 968 651 3790', '313131', '31313', '131', '31313', '1313', '2023-12-31', '2024-12-31', 'asd', 1),
(27, 'john frederickl a. Gelay', '', 'fasfasf', 'asdf a. fffff', '', 'asdfsafasf', 'safasf', 'asfsaf', 'safasfasf', 'safasfasf', '2024-11-07', '2024-11-07', 'asfasf', 1),
(28, 'Pauline Cielo D. Gelay', '63', 'fasfasf', 'asdf a. fffff', '63', 'asdfsafasf', 'safasf', 'asfsaf', 'safasfasf', 'safasfasf', '2024-11-07', '2024-11-07', 'asfasf', 1),
(29, 'asdf a. asdffd', '+63 968 651 3790', 'asdfasf', 'John Frederick D. Gelay', '+63 968 651 3790', 'sadfasfa', 'asfasf', 'asdfaf', 'ssadfaf', 'asdfasf', '2024-12-31', '2024-12-31', 'dfsa', 1),
(30, 'John Fredericds a. Gelay', '', 'asdfasdf', 'John Fredericds a. Gelay', '', 'asdfasdfadsfasf', 'asdfasf', 'afasdfs', 'asdfasdfasd', 'fasdfas', '2024-11-07', '2024-11-07', 'zcZXc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cashbook`
--

CREATE TABLE `tb_cashbook` (
  `cashbook_id` int(11) NOT NULL,
  `period_covered` date NOT NULL,
  `treasurer_name` varchar(255) NOT NULL,
  `clt_init_balance` double NOT NULL,
  `clt_end_in` double NOT NULL,
  `clt_end_out` double NOT NULL,
  `clt_end_balance` double NOT NULL,
  `cb_init_balance` double NOT NULL,
  `cb_end_in` double NOT NULL,
  `cb_end_out` double NOT NULL,
  `cb_end_balance` double NOT NULL,
  `ca_end_receipt` double NOT NULL,
  `ca_end_disbursement` double NOT NULL,
  `ca_end_balance` double NOT NULL,
  `pcf_end_receipt` double NOT NULL,
  `pcf_end_payments` double NOT NULL,
  `pcf_end_balance` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cashbook`
--

INSERT INTO `tb_cashbook` (`cashbook_id`, `period_covered`, `treasurer_name`, `clt_init_balance`, `clt_end_in`, `clt_end_out`, `clt_end_balance`, `cb_init_balance`, `cb_end_in`, `cb_end_out`, `cb_end_balance`, `ca_end_receipt`, `ca_end_disbursement`, `ca_end_balance`, `pcf_end_receipt`, `pcf_end_payments`, `pcf_end_balance`, `isDisplayed`) VALUES
(5, '2024-09-01', 'Joshua Belandres', 1000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(6, '2024-08-01', 'John Frederick Gelay', 1000, 100, 0, 1100, 1000, 100, 1000, 100, 0, 0, 0, 0, 0, 0, 1),
(7, '2024-06-02', 'Joshua Belandres', 1000, 100, 0, 1100, 1000, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 1),
(8, '2024-05-01', 'Joshua Belandres', 1000, 100, 0, 1100, 1000, 100, 0, 1100, 0, 0, 0, 0, 0, 0, 1),
(11, '2023-10-01', 'Joshua Belandres', 1000, 1100, 123, 1977, 10001, 223, 332, 9892, 323, 223, 100, 223, 173, 50, 1),
(12, '2023-11-01', 'Joshua Belandres', 12345, 123, 123, 12345, 12345, 123, 123, 12345, 123, 123, 0, 123, 123, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cashbook_data`
--

CREATE TABLE `tb_cashbook_data` (
  `cashbook_id` int(11) NOT NULL,
  `cashbook_data_id` int(11) NOT NULL,
  `date_data` varchar(255) NOT NULL,
  `particulars_1` varchar(255) NOT NULL,
  `particulars_2` varchar(255) NOT NULL,
  `reference_1` varchar(255) NOT NULL,
  `reference_2` varchar(255) NOT NULL,
  `clt_in` double NOT NULL,
  `clt_out` double NOT NULL,
  `clt_balance` double NOT NULL,
  `cb_in` double NOT NULL,
  `cb_out` double NOT NULL,
  `cb_balance` double NOT NULL,
  `ca_receipt` double NOT NULL,
  `ca_disbursement` double NOT NULL,
  `ca_balance` double NOT NULL,
  `pcf_receipt` double NOT NULL,
  `pcf_payments` double NOT NULL,
  `pcf_balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cashbook_data`
--

INSERT INTO `tb_cashbook_data` (`cashbook_id`, `cashbook_data_id`, `date_data`, `particulars_1`, `particulars_2`, `reference_1`, `reference_2`, `clt_in`, `clt_out`, `clt_balance`, `cb_in`, `cb_out`, `cb_balance`, `ca_receipt`, `ca_disbursement`, `ca_balance`, `pcf_receipt`, `pcf_payments`, `pcf_balance`) VALUES
(5, 2, '2024-09-01', 'VARIOUS PAYORS', '', '', '2024-09-3', 0, 0, 1000, 100, 0, 1100, 0, 0, 0, 0, 0, 0),
(6, 3, '2024-08-01', 'VARIOUS PAYORS', '', 'RDC NO', '', 100, 0, 1100, 100, 1000, 100, 0, 0, 0, 0, 0, 0),
(7, 4, '2024-06-01', 'VARIOUS PAYORS', '', 'RDC NO', '', 100, 0, 1100, 0, 0, 1000, 0, 0, 0, 0, 0, 0),
(8, 5, '2024-05-01', 'VARIOUS PAYORS', '', 'RDC NO', '', 100, 0, 1100, 100, 0, 1100, 0, 0, 0, 0, 0, 0),
(11, 9, '2023-10-02', 'VARIOUS PAYORS', 'COLLECTION AND DEPOSITS', 'RDC NO', '2024-09-3', 100, 0, 1100, 100, 200, 9901, 200, 100, 100, 100, 50, 50),
(11, 11, '2023-10-03', 'VARIOUS PAYORS', 'COLLECTION AND DEPOSITS', 'RDC NO', '2024-09-3', 1000, 123, 1977, 123, 132, 9892, 123, 123, 100, 123, 123, 50),
(12, 12, '2023-11-01', 'VARIOUS PAYORS', 'COLLECTION AND DEPOSITS', 'RDC NO', '2024-09-3', 123, 123, 12345, 123, 123, 12345, 123, 123, 0, 123, 123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_certificate`
--

CREATE TABLE `tb_certificate` (
  `certificate_id` int(11) NOT NULL,
  `certificate_name` varchar(120) NOT NULL,
  `certificate_filepath` varchar(255) NOT NULL,
  `certificate_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_certificate`
--

INSERT INTO `tb_certificate` (`certificate_id`, `certificate_name`, `certificate_filepath`, `certificate_date`) VALUES
(1, 'Indigency', 'assets/uploads/certificateFile/Form.txt', '2024-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_document`
--

CREATE TABLE `tb_document` (
  `document_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_date` date NOT NULL,
  `document_info` text NOT NULL,
  `document_type` varchar(50) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_document`
--

INSERT INTO `tb_document` (`document_id`, `document_name`, `document_date`, `document_info`, `document_type`, `isDisplayed`) VALUES
(42, 'Capstone Picture', '2024-09-28', 'image for documentationssss', 'images', 1),
(44, 'asdfa', '0000-00-00', 'asdfasdf', 'dsafsadf', 0),
(45, 'asdfasdf', '2024-11-05', '12313', '123123', 0),
(46, 'Capstone Pictured', '2024-11-05', 'dasdf', 'asdfasf', 1),
(47, 'asdfasdf', '2024-11-05', 'dasdf', 'asdfasf', 0),
(48, 'asdfasdf', '2024-11-05', 'dasdf', 'asdfasf', 1),
(49, 'asdfasdfasdf', '2024-11-05', '123ddd', '123', 0),
(50, 'asdfasdf', '2024-11-05', '123131231', '123123', 0),
(51, 'asdfasd', '2024-11-05', 'asdfa', 'asdfasf', 0),
(52, 'asdfasdf', '2024-11-05', 'asdf', 'asdfasf', 1),
(53, 'dfdf', '2024-11-06', 'ADas', 'asdASD', 1),
(54, 'adfasdf', '2024-11-06', 'ASDasdASDSA', 'asdASD', 1),
(55, 'cAPSTONE PROJECT', '2023-12-31', '123', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_document_files`
--

CREATE TABLE `tb_document_files` (
  `id` int(11) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_document_files`
--

INSERT INTO `tb_document_files` (`id`, `document_id`, `filepath`) VALUES
(27, 42, 'file_uploads/438171552_827227515482368_602114975853314839_n.jpg'),
(28, 42, 'file_uploads/442466857_849676080347474_737044034695990163_n.jpg'),
(31, 44, 'file_uploads/Git.png'),
(32, 45, 'file_uploads/business capstone project.png'),
(33, 45, 'file_uploads/business capstone project.png'),
(34, 46, 'file_uploads/business capstone project.png'),
(35, 46, 'file_uploads/business capstone project.png'),
(36, 47, 'file_uploads/business capstone project.png'),
(37, 47, 'file_uploads/business capstone project.png'),
(38, 48, 'file_uploads/DOTA.jpg'),
(39, 48, 'file_uploads/DOTA.jpg'),
(40, 49, 'file_uploads/metal-windows-10-on-grainy-gray-46597-1920x1080.jpg'),
(41, 49, 'file_uploads/metal-windows-10-on-grainy-gray-46597-1920x1080.jpg'),
(42, 50, 'file_uploads/Untitled.png'),
(43, 50, 'file_uploads/Untitled.png'),
(44, 51, 'file_uploads/White_Wallpaper.jpg'),
(45, 51, 'file_uploads/White_Wallpaper.jpg'),
(46, 52, 'file_uploads/metal-windows-10-on-grainy-gray-46597-1920x1080.jpg'),
(47, 53, 'file_uploads/business capstone project.png'),
(48, 54, 'file_uploads/download.jpg'),
(49, 55, 'file_uploads/DOTA.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `employee_id` int(11) NOT NULL,
  `employee_firstname` varchar(50) NOT NULL,
  `employee_lastname` varchar(50) NOT NULL,
  `employee_middlename` varchar(50) NOT NULL,
  `employee_maidenname` varchar(50) NOT NULL,
  `employee_sex` varchar(30) NOT NULL,
  `employee_suffixes` varchar(30) NOT NULL,
  `employee_address` varchar(100) NOT NULL,
  `employee_educationalattainment` varchar(100) NOT NULL,
  `employee_birthdate` date NOT NULL,
  `employee_age` int(11) NOT NULL,
  `employee_status` varchar(50) NOT NULL,
  `employee_position` varchar(100) NOT NULL,
  `employee_contact` varchar(100) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`employee_id`, `employee_firstname`, `employee_lastname`, `employee_middlename`, `employee_maidenname`, `employee_sex`, `employee_suffixes`, `employee_address`, `employee_educationalattainment`, `employee_birthdate`, `employee_age`, `employee_status`, `employee_position`, `employee_contact`, `isDisplayed`) VALUES
(3, 'John Frederick', 'Gelay', 'Domecillo', 'Domecillo', 'Male', '', '', 'College, Undergrad', '2001-11-09', 0, 'Single', '', '', 0),
(4, 'John', 'Herbias', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2023-11-03', 0, 'Single', 'Barangay Captain', '+63 968 651 3790', 1),
(5, 'asdf', 'werqwer', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2023-11-03', 0, 'Single', 'Barangay Captain', '+63 968 651 3790', 1),
(6, 'John', 'Fredercick', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2022-11-09', 0, 'Single', 'Barangay Captain', '+63 968 651 3790', 1),
(7, 'John', 'Gelay', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2022-11-03', 0, 'Single', 'Barangay Secretary', '', 1),
(8, 'qwerwr', 'werqwr', 'wrwqrqwr', 'wrwr', 'Male', 'Jr', 'Sitio Sto. Nino', 'High School, Undergrad', '2001-11-09', 0, 'Single', 'Barangay Captain', '', 1),
(9, 'qwerwr', 'werqwr dddd', 'wrwqrqwr', 'wrwr', 'Male', ' ', 'Sitio Sto. Nino', 'Elementary', '2023-11-04', 0, 'Single', 'Barangay Captain', '', 1),
(10, 'fsfsfsfsafsfsf', 'asdfasdfas', 'sfsdfsf', 'asdfsafs', 'Male', ' ', 'Sitio Sto. Nino', 'High School, Undergrad', '2001-11-09', 0, 'Single', 'Barangay Captain', '', 1),
(11, 'fsfsfsfsafsfsf', 'dddddddddddddddddd', 'sfsdfsf', 'asdfsafs', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2222-11-09', 0, 'Single', '', '+63 968 651 3790', 0),
(12, 'sadfsafasfasfsfsafasd', 'asdfsadf', 'asdfsadf', 'fsfsadf', 'Male', 'None', 'Sitio Sto. Nino', 'High School, Undergraduate', '2004-11-09', 0, 'Single', 'Barangay Captain', '109686513790', 0),
(13, 'gelay', 'john', 'asdfasdf', 'asdfasdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2001-11-05', 0, 'Single', 'Barangay Captain', '', 0),
(14, 'asdfasfd', 'asdfasfd', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Single', 'Barangay Captain', '', 1),
(15, 'asdfasf', 'asdfas', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Single', 'Barangay Captain', '', 0),
(16, 'asdfasf', 'sdfas', 'asdfasf', '', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Single', 'Barangay Secretary', '', 0),
(17, 'asdfasf', 'asdfasf', 'asdfasf', 'asfsafsaf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Single', 'Barangay Captain', '', 1),
(18, 'fasdfasf', 'asdfas', 'sadfasf', 'asfasdf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Single', 'Barangay Captain', '', 1),
(19, 'asdfasf', 'ddd', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-30', 0, 'Married', 'Barangay Captain', '', 1),
(20, '', 'asdfasf', '', '', '', 'None', '', '', '0000-00-00', 0, '', '', '', 1),
(21, 'asdfasdf', 'asdfasf', '', '', '', 'None', '', '', '0000-00-00', 0, '', '', '', 1),
(22, 'dsfasf', 'asdfasf', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Single', 'Barangay Captain', '', 1),
(23, 'asdfasf', 'sdafasf', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-30', 0, 'Single', 'Barangay Captain', '', 1),
(24, 'fasdfasf', 'asdfasf', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Single', 'Barangay Captain', '', 1),
(25, 'asdfasf', 'asdfasfffff', 'sadfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-30', 0, 'Single', 'Barangay Captain', '', 1),
(26, 'asdfasf', 'asdfasfffffaaa', 'sadfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-30', 0, 'Single', 'Barangay Captain', '', 1),
(27, 'asdfasf', 'Gejoh', '', '', 'Male', 'Jr', '', '', '2024-12-30', 0, 'Single', 'Barangay Secretary', '', 1),
(28, 'asdfasf', 'asdfasfdddd', 'asdfasf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-30', 0, 'Single', 'Barangay Secretary', '', 1),
(29, 'asdf', 'asdasf', 'asdf', 'asdfsf', 'Female', 'Jr', '', '', '2023-01-31', 0, 'Married', '', '+63 968 651 3790', 1),
(30, 'k', 'asdfasf', 'jhk', 'hkh', 'Male', 'Jr', 'Sitio Sto. Nino', 'High School, Undergrad', '2024-12-31', 0, 'Single', 'Barangay Captain', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_event`
--

CREATE TABLE `tb_event` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(120) NOT NULL,
  `event_location` varchar(120) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event_start` date NOT NULL,
  `event_end` date NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_event`
--

INSERT INTO `tb_event` (`event_id`, `event_name`, `event_location`, `event_type`, `event_start`, `event_end`, `isDisplayed`) VALUES
(22, 'asdfasdf', 'asdfasdf', 'asdfasdf', '2024-10-16', '2024-10-16', 0),
(23, 'Secretddd', 'Mantalongon Complex', 'Zumbaddd', '2024-10-31', '2024-10-29', 0),
(24, 'ZXCZX', 'ASDasd', 'ASDasd', '2024-09-18', '2024-09-10', 1),
(25, 'asdf', 'asdfasdf', 'asdfasf', '2024-10-19', '2024-10-19', 1),
(26, 'Simbaddd', 'Mantalongon Complex', 'Sports', '2024-10-18', '2024-10-18', 1),
(27, 'Simbad', 'Mantalongon Parish Church', 'Mass', '2024-11-01', '2024-11-01', 0),
(28, 'Secret', 'secret', 'secret', '2024-10-27', '2024-10-27', 1),
(29, 'asdf', 'asdf', 'asdfsdf', '2024-11-02', '2024-11-04', 1),
(30, 'asdfdsa', 'fsafsfsa', 'fsafsfdsaf', '2024-11-08', '2024-11-09', 1),
(31, 'asdfasdf', 'asdfsadf', 'sadfsadf', '2024-11-08', '2024-11-09', 1),
(32, 'Loveee', 'fsadfsfs', 'asdfasdf', '2024-11-23', '2024-11-16', 1),
(33, 'asdfasd', 'fasdfasdfas', 'dfasf', '2024-11-08', '2024-11-09', 1),
(34, 'a', 'fasdfasdfasd', 'fasdfasdf', '2024-11-17', '2024-11-15', 1),
(35, 'Birthday', 'Mantalongon Complex', 'Kalingawan', '2024-11-08', '2024-11-10', 1),
(36, 'Birthdayzz', 'mantalongon', 'lingaw', '2024-11-08', '2024-11-10', 1),
(37, 'asdfasf', 'asdfasf', 'asdfa', '2024-11-08', '2024-11-10', 1),
(38, '123', '123', '123', '2024-11-08', '2024-11-09', 1),
(39, 'Birthdayss', '123', '123', '2024-11-08', '2024-11-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_financial`
--

CREATE TABLE `tb_financial` (
  `financial_id` int(11) NOT NULL,
  `financial_type` varchar(120) NOT NULL,
  `financial_date` date NOT NULL DEFAULT current_timestamp(),
  `financial_filepath` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_financial`
--

INSERT INTO `tb_financial` (`financial_id`, `financial_type`, `financial_date`, `financial_filepath`) VALUES
(19, 'Expense', '2024-07-30', 'assets/uploads/financialFile/438171552_827227515482368_602114975853314839_n.jpg'),
(20, 'Budget', '2024-08-27', 'file_uploads/.emulator_console_auth_token'),
(21, 'Expense', '2024-08-27', 'file_uploads/.emulator_console_auth_token'),
(22, 'Expense', '2024-08-27', '.emulator_console_auth_token'),
(23, 'Expense', '2024-08-28', 'barangay_db.sql');

-- --------------------------------------------------------

--
-- Table structure for table `tb_indigency`
--

CREATE TABLE `tb_indigency` (
  `indigency_id` int(11) NOT NULL,
  `indigency_cname` varchar(120) NOT NULL,
  `indigency_fname` varchar(120) NOT NULL,
  `indigency_mname` varchar(120) NOT NULL,
  `indigency_date` date NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_indigency`
--

INSERT INTO `tb_indigency` (`indigency_id`, `indigency_cname`, `indigency_fname`, `indigency_mname`, `indigency_date`, `isDisplayed`) VALUES
(9, 'John Frederick D. Gelay', 'Fernando A. Gelay', 'Maria D. Gelay', '2024-09-21', 0),
(10, 'John Frederick Gelay', 'Fernando A. Gelay', 'Maria D. Gelay', '2024-11-06', 1),
(11, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 0),
(12, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 0),
(13, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 1),
(14, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 1),
(15, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 1),
(16, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 1),
(17, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 1),
(18, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 1),
(19, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 1),
(20, 'asdfasd', 'fasdfasdfas', 'fdsfas', '2024-11-06', 0),
(21, 'gelay', 'asdfasf', 'hrlsu', '2024-12-31', 0);

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
(105, 'STOOLS', 'Cream Color', 'MonoBlock', 'None', 'Joshua Belandres', 123, 321, 39483, '2019', 'Serviceable', 1, 53, 43, 0),
(106, 'Tableeee', 'Ivory Color', 'MonoBlock', 'None', 'Barangay ', 35, 5260, 184100, '2019', 'Unserviceable', 1, 35, 24, 1),
(107, 'Monoblock Chair', 'with backrest', 'MonoBlock', 'None', 'Barangay ', 410, 650, 266500, '2020', 'Unserviceable', 1, 400, 400, 1),
(108, 'cONCRETE MIXER', 'white orange', 'KOMATSU', 'SN: NVXPV00E202193.347600', 'Barangay ', 2, 75000, 150000, '2023', 'Serviceable', 1, 2, 2, 0),
(114, 'table', 'secret', 'asdfddd', 'asdfa', 'asdf', 112, 12, 1344, '2012', 'Serviceable', 1, 12, 12, 0),
(115, 'Tent ', 'asdf', 'fd', 'd', 'd', 123, 123, 15129, '0000', 'Serviceable', 1, 123, 123, 0),
(116, 'asdfasf', 'asdfasff', 'asdfasf', 'asdfasf', 'asdfasf', 12313, 123123, 1516013499, '0000', 'Serviceable', 1, 12313, 12313, 0),
(117, 'asdfasdf', 'adsfasfas', 'sfasdfasf', 'oiasudfouasf', 'asodifuasouf', 1231, 123, 151413, '2019', 'Serviceable', 1, 123, 123, 0),
(118, 'asdfasf', 'dsfasf', 'asdfasf', 'asdfasf', 'asdfasf', 12313, 12313, 151609969, '0000', 'Serviceable', 1, 123, 123, 0),
(119, 'asdfasdf', 'asdfasf', 'asdfasf', 'asdfasdf', 'adfasf', 123, 123, 15129, '0000', 'Serviceable', 1, 123, 123, 0);

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
(21, 'fasdfasd', 'fsafsfasda', '2024-09-26', '2024-09-26', '2024-09-27', 'sfasdf', 'asdf', '12', '0000-00-00', 'Ongoing', 1),
(22, 'asdfa', 'sdfasdf', '2024-10-06', '2024-10-06', '2024-10-06', 'dasd', 'ASD', NULL, NULL, 'Ongoing', 0),
(23, 'sdfasf', 'asfasf', '2024-12-30', '2024-12-30', '2024-12-31', 'sdzv', 'safasfas', NULL, NULL, 'Ongoing', 0),
(24, 'asdfasf', 'asdfasf', '2023-12-31', '2024-12-31', '2024-12-31', 'sfasdf', 'asdfasf', NULL, NULL, 'Ongoing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_project`
--

CREATE TABLE `tb_project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_start` date NOT NULL,
  `project_end` date NOT NULL,
  `project_budget` double NOT NULL,
  `project_source` varchar(100) NOT NULL,
  `project_status` varchar(100) NOT NULL,
  `project_description` varchar(100) NOT NULL,
  `project_location` varchar(100) NOT NULL,
  `project_managers` varchar(100) NOT NULL,
  `project_stakeholders` varchar(100) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_project`
--

INSERT INTO `tb_project` (`project_id`, `project_name`, `project_start`, `project_end`, `project_budget`, `project_source`, `project_status`, `project_description`, `project_location`, `project_managers`, `project_stakeholders`, `isDisplayed`) VALUES
(3, 'asdfaf', '2024-04-01', '2024-01-01', 112313, '12313', 'Ongoing', '12313', '1231313', '12313', '12313', 0),
(4, 'asdfasdf', '2024-12-31', '2024-12-31', 123123, '12321', 'New', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 0),
(5, 'asdfasdf', '2024-12-31', '2024-12-31', 123123, '12321', 'Ongoing', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 0),
(6, 'asdfasdf', '2024-12-31', '2024-12-31', 123123, '12321', 'New', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 0),
(7, 'asdfasdff', '2024-12-31', '2024-12-31', 123123, '12321', 'Ongoing', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 0),
(8, 'asdfasdf', '2024-12-31', '2024-12-31', 123123, '12321', 'New', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 0),
(9, 'asdfasdf', '2024-12-31', '2024-12-31', 123123, '12321', 'New', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 1),
(10, 'asdfasdf', '2024-12-31', '2024-12-31', 123123, '12321', 'New', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 1),
(11, 'asdfasdf', '2024-12-31', '2024-12-31', 123123, '12321', 'New', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 1),
(12, 'asdfasdf', '2024-12-31', '2024-12-31', 123123, '12321', 'New', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 1),
(13, 'asdfasdf', '2024-12-31', '2024-12-31', 123123, '12321', 'New', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 1),
(14, '', '2024-11-20', '2023-12-31', 123123, 'asdfasdf', 'Ongoing', 'asdfasdf', 'asdfasdf', 'asdfasdf', 'asdfasdf', 0),
(15, '', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(16, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(17, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(18, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(19, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(20, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(21, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(22, 'asdfasdf saasdfsf', '2024-12-31', '2024-12-04', -2, 'asdfasd', 'New', 'asdfasf', 'asdfasdf', 'asdfas', 'fasdfasdf', 1),
(23, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(24, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(25, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(26, 'secret', '0011-01-01', '0112-01-01', 0, 'asdfasdfasdf', 'New', 'eeeeeeeeeee', 'feeeeeeeeeeeeeee', 'asdfasdfsa', 'eeeeeeeeeeeeee', 0),
(27, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 1),
(28, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 1),
(29, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 1),
(30, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 1),
(31, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 1),
(32, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 1),
(33, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao`
--

CREATE TABLE `tb_rao` (
  `rao_id` int(11) NOT NULL,
  `period_covered` year(4) NOT NULL,
  `ap_total` double NOT NULL,
  `ap_salary` double NOT NULL,
  `ap_cash_gift` double NOT NULL,
  `ap_year_end` double NOT NULL,
  `ap_mid_year` double NOT NULL,
  `ap_sri` double NOT NULL,
  `ap_others` double NOT NULL,
  `ob_total` double NOT NULL,
  `ob_salary` double NOT NULL,
  `ob_cash_gift` double NOT NULL,
  `ob_year_end` double NOT NULL,
  `ob_mid_year` double NOT NULL,
  `ob_sri` double NOT NULL,
  `ob_others` double NOT NULL,
  `apbd_total` double NOT NULL,
  `apbd_salary` double NOT NULL,
  `apbd_cash_gift` double NOT NULL,
  `apbd_year_end` double NOT NULL,
  `apbd_mid_year` double NOT NULL,
  `apbd_sri` double NOT NULL,
  `apbd_others` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao`
--

INSERT INTO `tb_rao` (`rao_id`, `period_covered`, `ap_total`, `ap_salary`, `ap_cash_gift`, `ap_year_end`, `ap_mid_year`, `ap_sri`, `ap_others`, `ob_total`, `ob_salary`, `ob_cash_gift`, `ob_year_end`, `ob_mid_year`, `ob_sri`, `ob_others`, `apbd_total`, `apbd_salary`, `apbd_cash_gift`, `apbd_year_end`, `apbd_mid_year`, `apbd_sri`, `apbd_others`, `isDisplayed`) VALUES
(76, '2024', 5134533.86, 4242000, 110000, 178000, 178000, 220000, 206533.86, 1927, 312, 123, 1123, 123, 123, 123, 5132606.86, 4241688, 109877, 176877, 177877, 219877, 206410.86, 1),
(77, '0000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(78, '2024', 72, 12, 12, 12, 12, 12, 12, 0, 0, 0, 0, 0, 0, 0, 72, 12, 12, 12, 12, 12, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_ap_data`
--

CREATE TABLE `tb_rao_ap_data` (
  `rao_id` int(11) NOT NULL,
  `rao_ap_data_id` int(11) NOT NULL,
  `ap_ref_date` date DEFAULT NULL,
  `ap_ref_no` varchar(255) DEFAULT NULL,
  `ap_particulars` varchar(255) DEFAULT NULL,
  `ap_total` double DEFAULT NULL,
  `ap_salary` double DEFAULT NULL,
  `ap_cash_gift` double DEFAULT NULL,
  `ap_year_end` double DEFAULT NULL,
  `ap_mid_year` double DEFAULT NULL,
  `ap_sri` double DEFAULT NULL,
  `ap_others` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_ap_data`
--

INSERT INTO `tb_rao_ap_data` (`rao_id`, `rao_ap_data_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_total`, `ap_salary`, `ap_cash_gift`, `ap_year_end`, `ap_mid_year`, `ap_sri`, `ap_others`) VALUES
(78, 79, '2024-10-03', '12', '12', 72, 12, 12, 12, 12, 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_ob_data`
--

CREATE TABLE `tb_rao_ob_data` (
  `rao_id` int(11) NOT NULL,
  `rao_ob_data_id` int(11) NOT NULL,
  `ob_ref_date` date DEFAULT NULL,
  `ob_ref_no` varchar(255) DEFAULT NULL,
  `ob_particulars` varchar(255) DEFAULT NULL,
  `ob_total` double DEFAULT NULL,
  `ob_salary` double DEFAULT NULL,
  `ob_cash_gift` double DEFAULT NULL,
  `ob_year_end` double DEFAULT NULL,
  `ob_mid_year` double DEFAULT NULL,
  `ob_sri` double DEFAULT NULL,
  `ob_others` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_ob_data`
--

INSERT INTO `tb_rao_ob_data` (`rao_id`, `rao_ob_data_id`, `ob_ref_date`, `ob_ref_no`, `ob_particulars`, `ob_total`, `ob_salary`, `ob_cash_gift`, `ob_year_end`, `ob_mid_year`, `ob_sri`, `ob_others`) VALUES
(77, 42, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_request`
--

CREATE TABLE `tb_request` (
  `request_id` int(11) NOT NULL,
  `requester_name` varchar(255) NOT NULL,
  `request_type` varchar(255) NOT NULL,
  `request_description` varchar(255) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `request_status` varchar(50) DEFAULT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_request`
--

INSERT INTO `tb_request` (`request_id`, `requester_name`, `request_type`, `request_description`, `request_date`, `request_status`, `isDisplayed`) VALUES
(12, 'asd', 'asdfaddddd', 'asdf', '2024-10-06 21:57:00', 'asdf', 1),
(13, 'asdff', 'asdfsdf', 'asdfasdfasf', '2024-11-06 23:45:00', 'dfasdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_resident`
--

CREATE TABLE `tb_resident` (
  `resident_id` int(11) NOT NULL,
  `resident_firstname` varchar(50) NOT NULL,
  `resident_middlename` varchar(50) NOT NULL,
  `resident_lastname` varchar(50) NOT NULL,
  `resident_sex` varchar(30) NOT NULL,
  `resident_suffixes` varchar(30) NOT NULL,
  `resident_address` varchar(100) NOT NULL,
  `resident_educationalattainment` varchar(100) NOT NULL,
  `resident_birthdate` date NOT NULL,
  `resident_age` int(11) NOT NULL,
  `resident_status` varchar(30) NOT NULL,
  `resident_householdrole` varchar(50) NOT NULL,
  `household_id` int(11) NOT NULL,
  `resident_maidenname` varchar(50) NOT NULL,
  `resident_contact` varchar(100) DEFAULT NULL,
  `resident_occupation` varchar(255) NOT NULL,
  `resident_religion` varchar(225) NOT NULL,
  `resident_indigenous` varchar(225) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL,
  `resident_pension` varchar(225) NOT NULL,
  `resident_beneficiaries` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_resident`
--

INSERT INTO `tb_resident` (`resident_id`, `resident_firstname`, `resident_middlename`, `resident_lastname`, `resident_sex`, `resident_suffixes`, `resident_address`, `resident_educationalattainment`, `resident_birthdate`, `resident_age`, `resident_status`, `resident_householdrole`, `household_id`, `resident_maidenname`, `resident_contact`, `resident_occupation`, `resident_religion`, `resident_indigenous`, `isDisplayed`, `resident_pension`, `resident_beneficiaries`) VALUES
(8, 'John Frederick', 'Domecillo', 'Gelay', 'Male', 'None', 'Sitio Suwa', 'High School, Graduate', '2005-11-02', 20, 'Single', 'Son', 0, 'Domecillo', '123123', 'asdfasd', 'fasdfasf', 'asdfasdfffasd', 0, '', ''),
(11, 'Pauline Cielo', 'Domecillo', 'Gelay', 'Female', 'None', 'Sitio Sto. Nino', 'High School, Undergrad', '2002-11-02', 22, 'Married', '12', 12, 'Domecillo', '0', 'asdf', 'asdfasdf', '0', 0, '', ''),
(15, 'asdf', 'asdf', 'asdf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2002-11-02', 12, 'Single', 'asdf', 12, 'sadf', '', 'asdfasdf', 'asdfasdf', '0', 0, '', ''),
(16, 'asdf', 'asdf', 'asdf', 'Male', 'None', 'Sitio Catambisan', 'Elementary', '2001-11-02', 12, 'Single', '12', 12, 'sasdf', '0', 'asdf', 'asdfasf', '0', 0, '', ''),
(17, 'asdf', 'asdf', 'fffff', 'Male', 'None', 'Sitio Alang-Alang', 'Elementary', '2024-10-30', 12, 'Single', '12', 12, 'sasdf', '0', 'asdfasd', 'fsaf', '0asdfsafasf', 0, '', ''),
(18, '', '', '', '', '', '', '', '0000-00-00', 0, '', '', 0, '', '0', '', '', '', 0, '', ''),
(19, 'john frederick g', '', 'Gelay', 'Male', 'None', 'Sitio Suwa', 'Master Degree', '2023-11-01', 1, 'Single', '12', 12, '', '+63 966 666 6666', 'lkkjlj', 'khkhjk', '0', 0, 'asdfasfd', 'asdfasdf'),
(20, 'asdf', 'asdf', 'asdfkjlj', 'Male', 'None', 'Sitio Private', 'Elementary', '2023-11-05', 1, 'Single', 'adfasdf', 12, 'sasdf', '+63 968 651 3790', 'sdf', 'dfa', '0', 0, '', ''),
(21, 'asdf', 'asdf', 'asdfdd', 'Male', 'None', 'Sitio Suwa', 'Elementary', '2023-11-03', 0, 'Married', '12', 12, 'sasdf', '', 'asdfasd', 'asdf', 'asdf', 0, '', ''),
(22, 'asdf', 'asdf', 'asdffd', 'Male', 'None', 'Sitio Lahug', 'Elementary', '2023-11-05', 0, 'Single', '12', 12, 'sasdf', '', 'asdf', 'asdf', '0', 0, 'asdfasdf', 'f'),
(23, 'gelay', 'asdfasdf', 'john', 'Male', 'None', 'Sitio Granchina', 'High School, Undergrad', '2023-11-03', 1, 'Single', '12', 12, 'asdfasfas dfasdf', '+63 966 584 8215', 'asdf', 'asdf', '0', 0, 'dfdfsdaf', 'asdfas'),
(24, 'John Frederick', 'asdf', 'Gelay', 'Male', 'None', 'Sitio Sto. Nino', 'Elementary', '2024-10-30', 123, 'Single', '123', 123, 'asdf', '+63 654 111 1111', 'asdf', 'asdfasdf', '0', 0, '', ''),
(25, 'John Fredericds', 'asdf', 'Gelay', 'Female', 'None', 'Sitio Lahug', 'Elementary', '2024-10-30', 123, 'Married', '123', 123, 'asdf', '+63 965 681 3790', 'asdfasf', 'asdfasdf', '0', 0, '', ''),
(26, 'John Frederick', 'asdf', 'Gelay', 'Male', 'None', 'Sitio Sto. Nino', 'High School, Undergrad', '2024-10-30', 123, 'Single', '123', 123, 'asdf', '+63 968 651 3790', 'asdf', 'asdf', '0', 0, 'asdfsaf', 'asdfasdf'),
(27, 'dfasdfa,', 'sdfsadfas', 'ddddd', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2022-11-09', 1, 'Single', '123', 123, 'fdsaf', '+63 923 413 4567', 'asdfasf', 'asdfaf', '0', 1, 'asdfasf', 'sdaf'),
(28, 'zxcv', 'zxcv', 'ZXc', 'Male', 'None', 'Sitio Suwa', 'Elementary', '2024-10-31', 12, 'Single', '3', 4, 'xcv', '0', '', '', '0', 0, '', ''),
(29, 'asdf', 'asdf', 'asdfrrrer', 'Male', 'None', 'Sitio Sto. Nino', 'Elementary', '2024-10-31', 123, 'Single', '123', 123, '1222', '0', '', '', '0', 0, '', ''),
(30, 'John', 'dgdfg', 'Gelay', 'Male', 'None', 'Sitio Sto. Nino', 'High School, Undergrad', '2024-10-31', 21, 'Single', '12', 22, '', '+63 968 651 3790', 'asda', 'asdasd', '0', 0, '', ''),
(38, 'sdfasfasfd', 'asdfasf', 'asdfasf', 'Male', 'None', 'Sitio Sto. Nino', 'Elementary', '2023-11-02', 1, 'Single', '165', 164, 'asdfasf', '+63 968 651 3790', '16541', '1654', '1654', 1, 'asdfa', 'asdfasdf'),
(39, 'asdfasf', 'afasf', 'asdf', 'Male', 'None', 'Sitio Sto. Nino', 'Elementary', '2001-11-09', 22, 'Single', '3131', 3131, 'asdfasf', '+63 912 312 3123', '23133123', '131', '3131', 1, '', ''),
(40, 'asdfasfa', 'asdfasf', 'Clarissa', 'Male', 'Jr', 'Sitio Sto. Nino', 'College, Undergrad', '2001-11-01', 23, 'Single', 'hoeadf', 1233, 'asdfasf', '12312131123', 'student', 'catholic', 'yes', 1, '', ''),
(41, 'df', '', 'asdfas dfasfsdf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-11-22', 0, 'Single', '12313', 12313123, '', '1231313', '12312313', '123131', '123131', 0, '', ''),
(42, 'asdfasf', 'asdfasf', 'asdfasdf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2025-11-02', -1, 'Single', 'Son', 12313, 'asdfasf', '-123131', 'asdfasd', 'asdf', '0', 1, '', ''),
(43, 'Johnny', '', 'gelay', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Married', 'Son', -1, '', '-1', '12312313', '123131', 'asdfasdfffasd', 0, '', ''),
(44, 'asdfas', 'asdfas', 'asdf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-11-02', 0, 'Single', 'Son', -1, 'asdfasf', '', 'asdfasd', 'fasdfasf', 'asdfasdfffasd', 1, '', ''),
(45, 'asdfa', 'asdfas', 'asdf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2001-11-09', 22, 'Single', 'Son', 1, 'asdfasf', '+63 968 651 3790', 'asdfasd', 'fasdfasf', 'asdfasdfffasd', 1, '', ''),
(46, 'asdfasfd', 'asdfasf', 'asdfasdf', 'Male', 'None', 'Sitio Sto. Nino', 'Elementary', '2023-11-03', 0, 'Single', 'Son', 1, 'asdfasf', '2147483647', 'asdf', 'fasdfasf', 'asdfasf', 1, '', ''),
(47, 'joshua', '', 'Belandres', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2023-11-09', 0, 'Single', 'Son', 1, 'asdfasf', '68651390', 'asdfasd', 'fasdfasf', 'asdfasdfffasd', 1, '', ''),
(48, 'Z', 'asf', 'Gelay', 'Female', 'None', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Single', '123', 123, 'asdfa', '68651390', '123', 'fasdfasf', '123', 0, '', ''),
(49, 'John Dereks', 'Domecillo', 'Gelay', 'Male', 'None', 'Sitio Mag-Alambac', 'College, Undergrad', '2001-11-09', 22, 'Single', 'Son', 114257, 'Domecillo', '661748034', 'Student', 'Roman Catholic', 'yes', 1, '', ''),
(50, 'adfsafsfs', 'sadfsfsaf', 'asdfa sdfasdf', 'Female', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-11-20', 0, 'Single', 'Son', -1, 'sadfasfasf', '+63 996 865 1379', 'asdfasd', 'fasdfasf', 'asdfasdfffasd', 1, '', ''),
(51, 'adfsafsfs', 'sadfsfsaf', 'asdfasd fasdfdfdf', 'Female', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-11-20', 0, 'Single', 'Son', -1, 'sadfasfasf', '+63 968 651 3790', 'asdfasd', 'fasdfasf', 'asdfasdfffasd', 1, '', ''),
(52, 'clarissa', 'herbias', 'gelay', 'Female', 'None', 'Sitio Mag-Alambac', 'Doctorate Degree', '2002-11-10', 21, 'Married', 'Mother', 110901, 'amar', '+63 954 587 9521', 'Teacher', 'Roman Catholic', 'yes', 1, '', ''),
(53, 'Zenaida', 'Celino', 'Belandres', 'Female', 'None', 'Sitio Mag-Alambac', 'High School, Graduate', '2000-12-29', 23, 'Single', 'daughter', 2, 'Celino', '+63 965 458 7921', 'sdf', 'fasdfasf', 'asdfasdfffasd', 0, '', ''),
(54, 'asfasf', 'sdfsaf', 'asdfasdf', 'Male', 'None', 'Sitio Sto. Nino', 'Elementary', '2023-12-31', 0, 'Single', '12313', 3, 'adfsf', '+63 123 131 2313', '12313', '12313', '12313', 1, '', ''),
(55, '12313', '12313', '12313', 'Female', 'Jr', 'Sitio Sto. Nino', 'High School, Undergrad', '2023-12-31', 0, 'Single', '123', 123, '12313', '+63 968 651 3790', '123', '13', '123', 1, '', ''),
(56, 'asdf', 'asdf', 'gelay', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2023-11-02', 1, 'Single', '12313', 123123, 'sadf', '+63 968 651 3790', '1231', '12313', '1313', 1, '', ''),
(57, 'Zenaida', 'asdfasf', 'asdf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-11-30', 0, 'Single', 'asdf', 1, 'asdfasdf', '+63 547 896 54879', 'asdfasf', 'asdfasdf', 'yes', 0, '', ''),
(58, 'asdfasdf', 'asdfasdf', 'asdfasdfasdf', 'Female', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Single', 'asdad', 12, 'asdfasdfa', '', 'asdfasdf', 'asd', 'asdad', 1, '', ''),
(59, 'asfasf', 'safsf', 'asdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'High School, Undergrad', '2024-12-31', 0, 'Single', 'asdf', 1, 'asfasf', '+63 968 651 3790', 'asdfasdf', 'asdfasdf', 'asdfasdfffasd', 1, '', ''),
(60, 'gsdfgsd', 'hidhdsfkg', 'GELAY', 'Male', 'Jr', 'Sitio Sto. Nino', 'High School, Undergrad', '2024-12-31', 0, 'Single', 'gjg', 11, 'sdfkghsdg', '', 'asfdasfa', 'kg', 'gj', 1, 'sdfsf', 'asdfasdf'),
(61, 'asdfas', 'asdfasf', 'sdfasf', 'Male', 'Jr', 'Sitio Sto. Nino', 'Vocational', '2024-12-30', 0, 'Married', 'asdfasf', 12, 'asdfasf', '', 'asdfasfd', 'asdfasdf', 'asfasf', 1, 'resident_pension', 'resident_beneficiaries'),
(62, 'Frederick', 'sadfasf', 'John ', 'Male', 'Jr', 'Sitio Sto. Nino', 'Elementary', '2024-12-31', 0, 'Married', 'asdfasf', 12, 'sadfasf', '', 'asdfasdf', 'asdfasdf', 'asdfasf', 1, 'resident_pension', 'resident_beneficiaries');

--
-- Triggers `tb_resident`
--
DELIMITER $$
CREATE TRIGGER `update_resident_age` BEFORE INSERT ON `tb_resident` FOR EACH ROW BEGIN
    SET NEW.resident_age = TIMESTAMPDIFF(YEAR, NEW.resident_birthdate, CURDATE());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_resident_age_on_update` BEFORE UPDATE ON `tb_resident` FOR EACH ROW BEGIN
    IF OLD.resident_birthdate <> NEW.resident_birthdate THEN
        SET NEW.resident_age = TIMESTAMPDIFF(YEAR, NEW.resident_birthdate, CURDATE());
    END IF;
END
$$
DELIMITER ;

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
(20, 105, 'STOOLS', 1, 1, 'Returned'),
(21, 105, 'STOOLS', 1, 0, 'Borrowed'),
(22, 106, 'Table', 1, 1, 'Returned'),
(23, 106, 'Tableeee', 1, 1, 'Returned'),
(23, 106, 'Tableeee', 1, 1, 'Returned'),
(24, 106, 'Tableeee', 12, 0, 'Borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `barangayposition` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `theme` varchar(10) NOT NULL DEFAULT '''light''',
  `suffix` varchar(10) NOT NULL,
  `profile_picture` varchar(255) DEFAULT 'assets/image/profile_default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `lastname`, `firstname`, `middlename`, `sex`, `birthdate`, `barangayposition`, `username`, `password`, `theme`, `suffix`, `profile_picture`) VALUES
(61, 'Develo4', '', '', 'Male', '2024-01-01', 'Barangay Captain', 'Develo4', '$2y$10$vIYe3ucbPMKyCD26j2pS2e9SXXeloy3aArnI7xrZZtVwz6lHjggBy', 'dark', 'None', 'profile_default.png'),
(63, 'gelay', 'john', 'domecillo', 'Male', '2024-10-12', 'Barangay Treasurer', 'john1', '$2y$10$SCozWgUkn0D1W2PL1Xgh0uvqsNuPuLckQBq333YSucIsp1UzVTpyi', 'dark', 'None', 'profile_default.png'),
(64, 'Gelay', 'John Fred', 'domecillo', 'Male', '2001-11-09', 'Barangay Personnel', 'john', '$2y$10$T5R8vaeuPvbtWiZIo2HE2.x4YFq2AlXcTnDZJ3rEiFApSpgTgUX7q', 'dark', 'None', 'profile_default.png'),
(65, 'gelay', 'john derek', 'domecillo', 'Male', '2001-11-09', 'Barangay Health Worker', 'john2', '$2y$10$/SQVPCVDNi9qF.WP6/r5CexZ2WbBPsTcWJQ2w..I/WrZ5vswcCz0q', 'light', 'None', 'profile_default.png'),
(66, 'Gelay', 'john', '', 'Male', '2001-11-09', 'Barangay Personnel', 'john9', '$2y$10$0DLSRxCWz/xR/m2lmEMvVuqzWhUAe9tws/m4C8OV83jXG2FXPktSS', 'dark', 'None', 'profile_default.png'),
(67, 'Gelay', 'John', 'Domecillo', 'Male', '2024-10-21', 'Barangay Health Worker', 'john12', '$2y$10$BBLpNKhWi/mv5pThk7VwheMvAwvd6qCaLQlgiIiLKArU01CqazvKS', 'dark', 'None', 'profile_default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_blotter`
--
ALTER TABLE `tb_blotter`
  ADD PRIMARY KEY (`blotter_id`);

--
-- Indexes for table `tb_cashbook`
--
ALTER TABLE `tb_cashbook`
  ADD PRIMARY KEY (`cashbook_id`);

--
-- Indexes for table `tb_cashbook_data`
--
ALTER TABLE `tb_cashbook_data`
  ADD PRIMARY KEY (`cashbook_data_id`),
  ADD KEY `cashbook_id` (`cashbook_id`);

--
-- Indexes for table `tb_certificate`
--
ALTER TABLE `tb_certificate`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Indexes for table `tb_document`
--
ALTER TABLE `tb_document`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `tb_document_files`
--
ALTER TABLE `tb_document_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_id` (`document_id`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tb_financial`
--
ALTER TABLE `tb_financial`
  ADD PRIMARY KEY (`financial_id`);

--
-- Indexes for table `tb_indigency`
--
ALTER TABLE `tb_indigency`
  ADD PRIMARY KEY (`indigency_id`);

--
-- Indexes for table `tb_inventory`
--
ALTER TABLE `tb_inventory`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tb_item_transaction`
--
ALTER TABLE `tb_item_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `tb_rao`
--
ALTER TABLE `tb_rao`
  ADD PRIMARY KEY (`rao_id`);

--
-- Indexes for table `tb_rao_ap_data`
--
ALTER TABLE `tb_rao_ap_data`
  ADD PRIMARY KEY (`rao_ap_data_id`),
  ADD KEY `rao_id` (`rao_id`);

--
-- Indexes for table `tb_rao_ob_data`
--
ALTER TABLE `tb_rao_ob_data`
  ADD PRIMARY KEY (`rao_ob_data_id`),
  ADD KEY `rao_id` (`rao_id`);

--
-- Indexes for table `tb_request`
--
ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tb_resident`
--
ALTER TABLE `tb_resident`
  ADD PRIMARY KEY (`resident_id`);

--
-- Indexes for table `tb_transaction_items`
--
ALTER TABLE `tb_transaction_items`
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_blotter`
--
ALTER TABLE `tb_blotter`
  MODIFY `blotter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_cashbook`
--
ALTER TABLE `tb_cashbook`
  MODIFY `cashbook_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_cashbook_data`
--
ALTER TABLE `tb_cashbook_data`
  MODIFY `cashbook_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_certificate`
--
ALTER TABLE `tb_certificate`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_document`
--
ALTER TABLE `tb_document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_document_files`
--
ALTER TABLE `tb_document_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_financial`
--
ALTER TABLE `tb_financial`
  MODIFY `financial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_indigency`
--
ALTER TABLE `tb_indigency`
  MODIFY `indigency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_inventory`
--
ALTER TABLE `tb_inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `tb_item_transaction`
--
ALTER TABLE `tb_item_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_rao`
--
ALTER TABLE `tb_rao`
  MODIFY `rao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tb_rao_ap_data`
--
ALTER TABLE `tb_rao_ap_data`
  MODIFY `rao_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tb_rao_ob_data`
--
ALTER TABLE `tb_rao_ob_data`
  MODIFY `rao_ob_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_request`
--
ALTER TABLE `tb_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_resident`
--
ALTER TABLE `tb_resident`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_cashbook_data`
--
ALTER TABLE `tb_cashbook_data`
  ADD CONSTRAINT `tb_cashbook_data_ibfk_1` FOREIGN KEY (`cashbook_id`) REFERENCES `tb_cashbook` (`cashbook_id`);

--
-- Constraints for table `tb_document_files`
--
ALTER TABLE `tb_document_files`
  ADD CONSTRAINT `tb_document_files_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `tb_document` (`document_id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_rao_ap_data`
--
ALTER TABLE `tb_rao_ap_data`
  ADD CONSTRAINT `tb_rao_ap_data_ibfk_1` FOREIGN KEY (`rao_id`) REFERENCES `tb_rao` (`rao_id`);

--
-- Constraints for table `tb_rao_ob_data`
--
ALTER TABLE `tb_rao_ob_data`
  ADD CONSTRAINT `tb_rao_ob_data_ibfk_1` FOREIGN KEY (`rao_id`) REFERENCES `tb_rao` (`rao_id`);

--
-- Constraints for table `tb_transaction_items`
--
ALTER TABLE `tb_transaction_items`
  ADD CONSTRAINT `tb_transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `tb_item_transaction` (`transaction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
