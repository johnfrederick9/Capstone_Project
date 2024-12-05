-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 03:13 AM
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
(22, 'John Frederick D. Gelay', '+63 968 651 3790', 'dfasdfa', 'Pauline Cielo D. Gelay', '+63 968 651 3790', 'dafasf', 'asdfasdffss', 'Pending', 'asdfasdf', 'asdfasf', '2024-10-06', '2024-10-06', 'asdf', 0),
(23, 'asdfasf a. asdf', '', '65sd4f6 sadfasf', 'Frederick s. John ', '', 'asdfasf', 'asdfasf', 'Settled', 'sdfasf', 'sadfasfd', '2024-12-31', '2024-12-31', 'asdfsaf', 0),
(24, 'John Frederick D. Gelay', '', '65464', 'asdf a. asdf', '', '65', '4654', 'Pending', '46', '464', '1111-11-11', '0011-11-04', '1', 1),
(25, 'John Frederick D. Gelay', '46464', '6546', 'john frederickl a. Gelay', '654', '646', '46', '46', '464', '64', '4645-06-04', '6546-06-06', '4654564', 0),
(26, 'Pauline Cielo D. Gelay', '+63 968 651 3790', '3123123', 'John Frederick D. Gelay', '+63 968 651 3790', '313131', '31313', 'Settled', '31313', '1313', '2023-12-31', '2024-12-31', 'asd', 1),
(27, 'john frederickl a. Gelay', '', 'fasfasf', 'asdf a. fffff', '', 'asdfsafasf', 'safasf', 'Pending', 'safasfasf', 'safasfasf', '2024-11-07', '2024-11-07', 'asfasf', 1),
(28, 'Pauline Cielo D. Gelay', '', 'fasfasf', 'asdf a. fffff', '', 'asdfsafasf', 'safasf', 'Pending', 'safasfasf', 'safasfasf', '2024-11-07', '2024-11-07', 'asfasf', 1),
(29, 'asdf a. asdffd', '+63 968 651 3790', 'asdfasf', 'John Frederick D. Gelay', '+63 968 651 3790', 'sadfasfa', 'asfasf', 'Pending', 'ssadfaf', 'asdfasf', '2024-12-31', '2024-12-31', 'dfsa', 1),
(30, 'John Fredericds a. Gelay', '', 'asdfasdf', 'John Fredericds a. Gelay', '', 'asdfasdfadsfasf', 'asdfasf', 'Pending', 'asdfasdfasd', 'fasdfas', '2024-11-07', '2024-11-07', 'zcZXc', 1),
(31, 'asdf', 'asdfa', 'asdfasdfas', 'asdfasdfff', 'dfasfsa', 'dfsadfsadf', 'sdfsdf', 'Settled', 'asdfasf', 'asdfasf', '2023-01-31', '2023-12-31', 'asdfasf', 1),
(32, 'asdf', 'asdfa', 'asdfasdfas', 'asdfasdfff', 'dfasfsa', 'dfsadfsadf', 'sdfsdf', 'Settled', 'asdfasf', 'asdfasf', '2023-01-31', '2023-12-31', 'asdfasf', 1),
(33, 'asdf', 'asdfa', 'asdfasdfas', 'asdfasdfff', 'dfasfsa', 'dfsadfsadf', 'sdfsdf', 'Settled', 'asdfasf', 'asdfasf', '2023-01-31', '2023-12-31', 'asdfasf', 1),
(34, 'asdfffffffffffffffffff', '', 'asdfasdfas', 'asdfasdfff', '', 'dfsadfsadf', 'sdfsdf', 'Settled', 'asdfasf', 'asdfasf', '2023-01-31', '2023-12-31', 'asdfasf', 1),
(35, 'ojaosdfasdf', '', 'sadfasdfsad', 'asdfasf', '', 'fasdfasdfs', 'fdasfdsa', 'Pending', 'asdfasdf', 'asdfasf', '2024-11-20', '2024-11-20', 'asdfasdf', 1),
(36, 'asdf a. asdf', '', 'asdfasdf', 'asdf a. fffff', '', 'asdfasdf', 'asdfasdf', 'Pending', 'asdfasf', 'asfsaf', '2024-12-31', '2024-12-31', 'asdf', 1),
(37, 'asdfasdfasdf', '', 'sadfsadfsdf', 'asfsadfsadf', '', 'dsafsdfsdfs', 'fsafsaf', 'Pending', '123', '123', '2024-12-31', '2024-12-30', 'asdfasf', 1),
(38, 'asdfasdf a. asdfasdfasdf', '', 'sadfsadfsdf', 'John Frederick D. Gelay', '', 'dsafsdfsdfs', 'fsafsaf', 'Unsettled', '123', '123', '2024-12-31', '2024-12-30', 'asdfasf', 1),
(39, 'John Doe', '+63 968 651 3790', 'asdfasdf', 'Jane Smith', '+63 968 651 3790', 'sadfsadfasdf', 'asdfas', 'Pending', 'asdfsadf', 'asdfsdf', '2024-12-31', '2024-12-31', 'asdfsaf', 1),
(40, 'John Frederick D. Gelay', '', 'asdfasd', 'Pauline Cielo D. Gelay', '', 'fasdfdsafdsaf', 'asdfdasfasdf', 'Pending', 'adfasdf', 'asdfasdf', '2024-12-31', '2024-12-31', 'adfasf', 1),
(41, 'asdfasdfsdf', '', 'asdfsdfasdf', 'sadfsfasd', '', 'fsdfsdfasf', 'safsdfsdf', 'Pending', 'asdf', 'sadfasdfas', '2024-12-31', '2024-12-31', 'asdfasdf', 1),
(42, 'john frederick g  Gelay', '', 'asdfsdfas', 'Pauline Cielo D. Gelay', '', 'sadfsadfasdf', 'asdfasdf', 'Pending', 'asdfasf', 'asdfasf', '2024-12-31', '2024-12-31', 'asdfsaf', 1),
(43, 'John Frederick D. Gelay', '', 'sadfsadfsadf', 'gelay a. john', '', 'sdfsadfasdf', 'sadfsdfasdf', 'Pending', 'asdfasfas', 'fsdfdsf', '2024-12-31', '2024-11-21', 'dsdfasdf', 1),
(44, 'John Frederick D. Gelay', '', 'asdfasdfas', 'asdf a. fffff', '', 'asdfsadfas', 'fasdfasdf', 'Settled', 'asdfasdfads', 'fdasf', '2024-11-21', '0000-00-00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_business_m`
--

CREATE TABLE `tb_business_m` (
  `bemp_id` int(11) NOT NULL,
  `bemp_name` varchar(120) NOT NULL,
  `bemp_employed` varchar(120) NOT NULL,
  `bemp_locate` varchar(120) NOT NULL,
  `bemp_date` date NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL,
  `bemp_paid` int(11) NOT NULL,
  `bemp_dst` int(11) NOT NULL,
  `bemp_address` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_business_m`
--

INSERT INTO `tb_business_m` (`bemp_id`, `bemp_name`, `bemp_employed`, `bemp_locate`, `bemp_date`, `isDisplayed`, `bemp_paid`, `bemp_dst`, `bemp_address`) VALUES
(1, 'asdf', 'asfasdf', 'Sitio Catambisan', '2024-11-23', 0, 123, 123, ''),
(2, 'John Frederick D. Gelay', 'INSTRUCTOR', 'Sitio Sto. Nino', '2024-11-23', 1, 70, 200, 'Sitio Mag-Alambac'),
(3, 'asdfas', 'fdsadfasf', 'Sitio Mag-Alambac', '2024-11-23', 0, 123, 123, ''),
(4, 'asdfas', 'dfadsfasf', 'Sitio Granchina', '2024-12-23', 0, 1123, 123, 'Sitio Alang-Alang');

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
(5, '2024-09-01', 'Joshua Belandres', 33402, 0, 0, 33402, 5980927.7, 0, 0, 5981027.7, 0, 0, 0, 0, 0, 0, 0),
(6, '2024-08-01', 'John Frederick Gelay', 33302, 100, 0, 33402, 5981827.7, 100, 1000, 5980927.7, 0, 0, 0, 0, 0, 0, 0),
(7, '2024-06-02', 'Joshua Belandres', 33202, 100, 0, 33302, 5981827.7, 0, 0, 5981827.7, 0, 0, 0, 0, 0, 0, 1),
(8, '2024-05-01', 'Joshua Belandres', 33102, 100, 0, 33202, 5981727.7, 100, 0, 5981827.7, 0, 0, 0, 0, 0, 0, 1),
(11, '2023-10-01', 'Joshua Belandres', 32125, 1100, 123, 33102, 5981836.7, 223, 332, 5981727.7, 323, 223, 100, 223, 173, 50, 1),
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
(5, 2, '2024-09-01', 'VARIOUS PAYORS', '', '', '2024-09-3', 0, 0, 33402, 100, 0, 5981027.7, 0, 0, 0, 0, 0, 0),
(6, 3, '2024-08-01', 'VARIOUS PAYORS', '', 'RDC NO', '', 100, 0, 33402, 100, 1000, 5980927.7, 0, 0, 0, 0, 0, 0),
(7, 4, '2024-06-01', 'VARIOUS PAYORS', '', 'RDC NO', '', 100, 0, 33302, 0, 0, 5981827.7, 0, 0, 0, 0, 0, 0),
(8, 5, '2024-05-01', 'VARIOUS PAYORS', '', 'RDC NO', '', 100, 0, 33202, 100, 0, 5981827.7, 0, 0, 0, 0, 0, 0),
(11, 9, '2023-10-02', 'VARIOUS PAYORS', 'COLLECTION AND DEPOSITS', 'RDC NO', '2024-09-3', 100, 0, 32225, 100, 200, 5981736.7, 200, 100, 100, 100, 50, 50),
(11, 11, '2023-10-03', 'VARIOUS PAYORS', 'COLLECTION AND DEPOSITS', 'RDC NO', '2024-09-3', 1000, 123, 33102, 123, 132, 5981727.7, 123, 123, 100, 123, 123, 50),
(12, 12, '2023-11-01', 'VARIOUS PAYORS', 'COLLECTION AND DEPOSITS', 'RDC NO', '2024-09-3', 123, 123, 12345, 123, 123, 12345, 123, 123, 0, 123, 123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cashbook_init`
--

CREATE TABLE `tb_cashbook_init` (
  `init_id` int(11) NOT NULL,
  `clt_init_balance` double NOT NULL,
  `cb_init_balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cashbook_init`
--

INSERT INTO `tb_cashbook_init` (`init_id`, `clt_init_balance`, `cb_init_balance`) VALUES
(1, 32125, 5981836.7);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cashbook_monthly`
--

CREATE TABLE `tb_cashbook_monthly` (
  `monthly_id` int(11) NOT NULL,
  `date_data` date NOT NULL,
  `clt_init_balance` double NOT NULL,
  `clt_end_balance` double NOT NULL,
  `cb_init_balance` double NOT NULL,
  `cb_end_balance` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cashbook_monthly`
--

INSERT INTO `tb_cashbook_monthly` (`monthly_id`, `date_data`, `clt_init_balance`, `clt_end_balance`, `cb_init_balance`, `cb_end_balance`, `isDisplayed`) VALUES
(5, '2019-05-01', 42125, 45350, 5981836.7, 6004388.21, 1),
(6, '2019-06-01', 65965, 75965, 6033858.21, 6033858.21, 0),
(7, '2019-07-01', 55350, 64130, 6004388.21, 6004388.21, 1),
(9, '2019-04-01', 52125, 62125, 5981836.7, 5981836.7, 0),
(10, '2019-03-01', 42125, 52125, 5981836.7, 5981836.7, 0),
(14, '2019-06-01', 65965, 75965, 6033858.21, 6033858.21, 0),
(15, '2019-06-01', 45350, 55350, 6004388.21, 6004388.21, 1),
(16, '2019-04-01', 32125, 42125, 5981836.7, 5981836.7, 1);

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
(44, 'asdfa', '0000-00-00', 'asdfasdf', 'dsafsadf', 1),
(45, 'asdfasdf', '2024-11-05', '12313', '123123', 1),
(46, 'Capstone Pictured', '2024-11-05', 'dasdf', 'asdfasf', 1),
(47, 'asdfasdf', '2024-11-05', 'dasdf', 'asdfasf', 0),
(48, 'asdfasdf', '2024-11-05', 'dasdf', 'asdfasf', 1),
(49, 'asdfasdfasdf', '2024-11-05', '123ddd', '123', 0),
(50, 'asdfasdf', '2024-11-05', '123131231', '123123', 0),
(51, 'asdfasd', '2024-11-05', 'asdfa', 'asdfasf', 0),
(52, 'asdfasdf', '2024-11-05', 'asdf', 'asdfasf', 1),
(53, 'dfdf', '2024-11-06', 'ADas', 'asdASD', 1),
(54, 'adfasdf', '2024-11-06', 'ASDasdASDSA', 'asdASD', 1),
(55, 'cAPSTONE PROJECT', '2023-12-31', '123', '123', 1),
(56, 'Dashboard', '2024-11-22', 'asdfasdfas', 'asdfasdf', 1),
(57, 'Sample', '2023-12-31', 'secret', 'tabang', 1),
(58, 'Sample2', '2024-12-31', '123', '123', 1),
(59, 'asdfasdf v', '2024-11-22', 'asdfasf', 'asdfsadfasf', 1),
(60, 'DDDDD', '2024-11-23', 'dAS', 'AdAD', 1);

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
(49, 55, 'file_uploads/DOTA.jpg'),
(50, 56, 'file_uploads/Untitled.png'),
(51, 57, 'file_uploads/438171552_827227515482368_602114975853314839_n.jpg'),
(52, 57, 'file_uploads/442466857_849676080347474_737044034695990163_n.jpg'),
(53, 58, 'file_uploads/438158309_322098347656499_8012096737473386783_n.jpg'),
(54, 59, 'file_uploads/62106d4e-4be7-4cd8-a4bb-0b335941c5b7.jpg'),
(55, 60, '../../file_uploads/DOTA.jpg');

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
(33, 'John', 'Gelay', 'Domecillo', 'Domecillo', 'Male', ' ', 'Sitio Mag-Alambac', 'College, Undergrad', '2001-11-09', 23, 'Single', 'Barangay Treasurer', '+63 968 651 3790', 1),
(34, 'John', 'Domecillo', 'Domecillo', '', 'Male', ' ', 'Sitio Mag-Alambac', 'College, Undergrad', '2001-11-09', 23, 'Single', 'Barangay Treasurer', '', 1);

--
-- Triggers `tb_employee`
--
DELIMITER $$
CREATE TRIGGER `Employee Age Update` BEFORE INSERT ON `tb_employee` FOR EACH ROW BEGIN
    SET NEW.employee_age = TIMESTAMPDIFF(YEAR, NEW.employee_birthdate, CURDATE());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update Employee` BEFORE UPDATE ON `tb_employee` FOR EACH ROW BEGIN
    IF OLD.employee_birthdate <> NEW.employee_birthdate THEN
        SET NEW.employee_age = TIMESTAMPDIFF(YEAR, NEW.employee_birthdate, CURDATE());
    END IF;
END
$$
DELIMITER ;

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
(63, 'liga', 'liga', 'liga', '2024-11-25', '2024-11-26', 0),
(64, 'Ligo', 'asdfa', 'asdf', '2024-11-30', '2024-12-01', 0),
(65, '123', '123', '123', '2024-12-03', '2024-12-05', 0);

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
-- Table structure for table `tb_household`
--

CREATE TABLE `tb_household` (
  `household_name` varchar(255) NOT NULL,
  `household_head` varchar(255) NOT NULL,
  `household_address` varchar(255) NOT NULL,
  `household_contact` varchar(20) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `household_id` int(11) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_household`
--

INSERT INTO `tb_household` (`household_name`, `household_head`, `household_address`, `household_contact`, `id`, `household_id`, `isDisplayed`) VALUES
('asdfasdf', 'asdfffdasfadf', 'sadfasdf', '+63 968 651 3790', 2, 122, 1),
('', '', '', NULL, 6, 110920, 1),
('adf', 'adf', 'asdf', '+63 968 651 3790', 7, 112354, 1),
('', '', '', NULL, 8, 12354, 0);

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
  `isDisplayed` tinyint(4) NOT NULL,
  `indigency_paid` int(11) NOT NULL,
  `indigency_dst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_indigency`
--

INSERT INTO `tb_indigency` (`indigency_id`, `indigency_cname`, `indigency_fname`, `indigency_mname`, `indigency_date`, `isDisplayed`, `indigency_paid`, `indigency_dst`) VALUES
(9, 'John Frederick D. Gelay', 'Fernando A. Gelay', 'Maria D. Gelay', '2024-09-21', 0, 0, 0),
(10, 'John Frederick Gelay', 'Fernando A. Gelay', 'Maria D. Gelay', '2024-11-06', 0, 0, 0),
(11, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 0, 0, 0),
(12, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 0, 0, 0),
(13, 'tabang lord', 'asdfasdf', 'ka', '2024-12-31', 0, 0, 0),
(14, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 0, 0, 0),
(15, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 0, 200, 30),
(16, 'john', 'asdfasdf', 'asdfas', '2024-12-31', 0, 200, 30),
(17, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 0, 0, 0),
(18, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 0, 0, 0),
(19, 'asdf', 'asdfasdf', 'asdfas', '2024-12-31', 0, 0, 0),
(20, 'asdfasd', 'fasdfasdfas', 'fdsfas', '2024-11-06', 0, 0, 0),
(21, 'gelay', 'asdfasf', 'hrlsu', '2024-12-31', 0, 0, 0),
(22, 'John Frederick Gelay', 'Fernando A. Gelay', 'Maria D. Gelay', '2024-12-31', 1, 70, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tb_indigency_bir`
--

CREATE TABLE `tb_indigency_bir` (
  `indigencyBIR_id` int(11) NOT NULL,
  `indigency_cname` varchar(120) NOT NULL,
  `indigency_mname` varchar(120) NOT NULL,
  `indigency_fname` varchar(120) NOT NULL,
  `indigency_date` date NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL,
  `indigency_paid` int(11) NOT NULL,
  `indigency_dst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_indigency_bir`
--

INSERT INTO `tb_indigency_bir` (`indigencyBIR_id`, `indigency_cname`, `indigency_mname`, `indigency_fname`, `indigency_date`, `isDisplayed`, `indigency_paid`, `indigency_dst`) VALUES
(1, 'John Frederick D. Gelay', 'Maria D. Gelay', 'Fernando A. Gelay', '2024-11-23', 1, 200, 30);

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
(105, 'STOOLS', 'Cream Color', 'MonoBlock', 'None', 'Joshua Belandres', 123, 321, 39483, '2019', 'Serviceable', 1, 53, 44, 0),
(106, 'Tableeee', 'Ivory Color', 'MonoBlock', 'None', 'Barangay ', 35, 5260, 184100, '2019', 'Unserviceable', 1, 35, 35, 1),
(107, 'Monoblock Chair', 'with backrest', 'MonoBlock', 'None', 'Barangay ', 410, 650, 266500, '2020', 'Unserviceable', 1, 400, 400, 1),
(108, 'cONCRETE MIXER', 'white orange', 'KOMATSU', 'SN: NVXPV00E202193.347600', 'Barangay ', 2, 75000, 150000, '2023', 'Serviceable', 1, 2, 2, 0),
(114, 'table', 'secret', 'asdfddd', 'asdfa', 'asdf', 112, 12, 1344, '2012', 'Serviceable', 1, 12, 12, 0),
(115, 'Tent ', 'asdf', 'fd', 'd', 'd', 123, 123, 15129, '0000', 'Serviceable', 1, 123, 123, 0),
(116, 'asdfasf', 'asdfasff', 'asdfasf', 'asdfasf', 'asdfasf', 12313, 123123, 1516013499, '0000', 'Serviceable', 1, 12313, 12192, 0),
(117, 'asdfasdf', 'adsfasfas', 'sfasdfasf', 'oiasudfouasf', 'asodifuasouf', 1231, 123, 151413, '2019', 'Serviceable', 1, 123, 123, 0),
(118, 'asdfasf', 'dsfasf', 'asdfasf', 'asdfasf', 'asdfasf', 12313, 12313, 151609969, '0000', 'Serviceable', 1, 123, 123, 0),
(119, 'asdfasdf', 'asdfasf', 'asdfasf', 'asdfasdf', 'adfasf', 123, 123, 15129, '0000', 'Serviceable', 1, 123, 123, 0),
(120, 'asdfa', 'sdfasdf', 'safsafsd', 'fasfas', 'fasfs', 123, 2002, 246246, '2002', 'Serviceable', 1, 22, 22, 0),
(121, 'asdfasdf', 'asdfadsfasd', 'fasdfsadf', 'dsafasdfsadf', 'asdfsafads', 12313, 12313, 151609969, '0000', 'Serviceable', 1, 123, 123, 0),
(122, 'Tableeee', 'saasdfasf', 'asdfasf', 'adsfasf', 'asdfasf', 123123, 12313, 1516013499, '0000', 'Serviceable', 1, 12313, 12313, 0);

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
(12, 'Joshua Belandres', 'Mantalongon ', '2024-09-23', '2024-09-23', '2024-09-23', 'Zenaida Belandres', 'Angebon Reyes', 'John Frederick Gelay', '2024-09-25', 'Partially', 1),
(21, 'fasdfasd', 'fsafsfasda', '2024-09-26', '2024-09-26', '2024-09-27', 'sfasdf', 'asdf', '12', '0000-00-00', 'Ongoing', 1),
(22, 'asdfa', 'sdfasdf', '2024-10-06', '2024-10-06', '2024-10-06', 'dasd', 'ASD', NULL, NULL, 'Ongoing', 0),
(23, 'sdfasf', 'asfasf', '2024-12-30', '2024-12-30', '2024-12-31', 'sdzv', 'safasfas', NULL, NULL, 'Ongoing', 0),
(24, 'asdfasf', 'asdfasf', '2023-12-31', '2024-12-31', '2024-12-31', 'sfasdf', 'asdfasf', NULL, NULL, 'Ongoing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_permit`
--

CREATE TABLE `tb_permit` (
  `permit_id` int(11) NOT NULL,
  `permit_name` varchar(120) NOT NULL,
  `permit_business` varchar(120) NOT NULL,
  `permit_locate` varchar(120) NOT NULL,
  `permit_date` date NOT NULL,
  `permit_paid` int(11) NOT NULL,
  `permit_dst` int(11) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_permit`
--

INSERT INTO `tb_permit` (`permit_id`, `permit_name`, `permit_business`, `permit_locate`, `permit_date`, `permit_paid`, `permit_dst`, `isDisplayed`) VALUES
(1, 'John Frederick D. Gelay', 'school supplies and assorted snacks', 'Sitio Lapa', '2024-11-23', 200, 30, 1),
(2, 'asdfasd', 'fasfasf', 'Sitio Catambisan', '2024-11-23', 123, 123, 0);

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
(9, 'asdfasdfddd', '2024-12-31', '2024-12-31', 123123, '12321', 'Completed', 'dfasdfsadf', '12313', 'asdfas', 'dfasfasfasfas', 1),
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
(27, 'asdfasdf', '0000-00-00', '0000-00-00', 0, '', '', '', '', '', '', 0),
(28, 'asdfasdfd', '2024-11-17', '2024-12-30', 2, 'fasfsf', 'New', 'sfsfsf', 'asdfsadfasfs', 'fsfsf', 'sfsfsf', 0),
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
(77, '0000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(78, '2024', 72, 12, 12, 12, 12, 12, 12, 0, 0, 0, 0, 0, 0, 0, 72, 12, 12, 12, 12, 12, 12, 0);

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
-- Table structure for table `tb_rao_bd`
--

CREATE TABLE `tb_rao_bd` (
  `rao_bd_id` int(11) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `period_covered` date NOT NULL,
  `brgy_captain` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_bd`
--

INSERT INTO `tb_rao_bd` (`rao_bd_id`, `chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) VALUES
(7, 'Zenaida Belandres', '2024-12-01', 'John Frederick Gelay', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_bd_ap`
--

CREATE TABLE `tb_rao_bd_ap` (
  `rao_bd_id` int(11) NOT NULL,
  `rao_bd_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_total` double NOT NULL,
  `ap_pre_disaster` double NOT NULL,
  `ap_quick_response` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_bd_ap`
--

INSERT INTO `tb_rao_bd_ap` (`rao_bd_id`, `rao_bd_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_total`, `ap_pre_disaster`, `ap_quick_response`, `isDisplayed`) VALUES
(7, 15, '2024-12-01', 'Appropriations', 'Annual Budget', 572528.87, 400770.21, 171758.66, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_bd_ob`
--

CREATE TABLE `tb_rao_bd_ob` (
  `rao_bd_id` int(11) NOT NULL,
  `rao_bd_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_total` double NOT NULL,
  `ob_pre_disaster` double NOT NULL,
  `ap_quick_response` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_bd_totals`
--

CREATE TABLE `tb_rao_bd_totals` (
  `rao_bd_total_id` int(11) NOT NULL,
  `rao_bd_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `pre_disaster` double NOT NULL,
  `quick_response` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_bd_totals`
--

INSERT INTO `tb_rao_bd_totals` (`rao_bd_total_id`, `rao_bd_id`, `total_type`, `total`, `pre_disaster`, `quick_response`, `isDisplayed`) VALUES
(21, 7, 'TA', 572528.87, 400770.21, 171758.66, 1),
(22, 7, 'BF', 572528.87, 400770.21, 171758.66, 1),
(23, 7, 'TO', 0, 0, 0, 1),
(24, 7, 'OB', 0, 0, 0, 1),
(25, 7, 'AB', 572528.87, 400770.21, 171758.66, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_co`
--

CREATE TABLE `tb_rao_co` (
  `rao_co_id` int(11) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `period_covered` date NOT NULL,
  `brgy_captain` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_co`
--

INSERT INTO `tb_rao_co` (`rao_co_id`, `chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) VALUES
(1, 'Pending...', '0000-00-00', 'Pending...', 0),
(2, 'John Frederick Gelay', '2024-12-01', 'Joshua Belandres', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cocont`
--

CREATE TABLE `tb_rao_cocont` (
  `rao_cocont_id` int(11) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `period_covered` date NOT NULL,
  `brgy_captain` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cocont`
--

INSERT INTO `tb_rao_cocont` (`rao_cocont_id`, `chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) VALUES
(1, 'Angebon Reyes', '2024-11-01', 'Joshua Belandres', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cocont_ap`
--

CREATE TABLE `tb_rao_cocont_ap` (
  `rao_cocont_id` int(11) NOT NULL,
  `rao_cocont_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cocont_ap`
--

INSERT INTO `tb_rao_cocont_ap` (`rao_cocont_id`, `rao_cocont_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(1, 1, '2024-11-01', 'Appropriations', 'Annual Budget', 4247573.23);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cocont_ap_data`
--

CREATE TABLE `tb_rao_cocont_ap_data` (
  `rao_cocont_ap_data_id` int(11) NOT NULL,
  `rao_cocont_ap_id` int(11) NOT NULL,
  `rao_cocont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cocont_ap_data`
--

INSERT INTO `tb_rao_cocont_ap_data` (`rao_cocont_ap_data_id`, `rao_cocont_ap_id`, `rao_cocont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 1, 'Data 1', 4247573.23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cocont_ap_totals`
--

CREATE TABLE `tb_rao_cocont_ap_totals` (
  `rao_cocont_id` int(11) NOT NULL,
  `rao_cocont_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_cocont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cocont_ap_totals`
--

INSERT INTO `tb_rao_cocont_ap_totals` (`rao_cocont_id`, `rao_cocont_ap_total_id`, `total_type`, `rao_cocont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ap_total_TA', 0, '', 4247573.23, 1),
(1, 2, 'TA', 1, 'Data 1', 4247573.23, 1),
(1, 3, 'ap_total_BF', 0, '', 4247573.23, 1),
(1, 4, 'BF', 1, 'Data 1', 4247573.23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cocont_attributes`
--

CREATE TABLE `tb_rao_cocont_attributes` (
  `rao_cocont_id` int(11) NOT NULL,
  `rao_cocont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cocont_attributes`
--

INSERT INTO `tb_rao_cocont_attributes` (`rao_cocont_id`, `rao_cocont_att_id`, `attribute_name`, `isDisplayed`) VALUES
(1, 1, 'Data 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cocont_ob`
--

CREATE TABLE `tb_rao_cocont_ob` (
  `rao_cocont_id` int(11) NOT NULL,
  `rao_cocont_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cocont_ob_data`
--

CREATE TABLE `tb_rao_cocont_ob_data` (
  `rao_cocont_ob_data_id` int(11) NOT NULL,
  `rao_cocont_ob_id` int(11) NOT NULL,
  `rao_cocont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cocont_ob_totals`
--

CREATE TABLE `tb_rao_cocont_ob_totals` (
  `rao_cocont_id` int(11) NOT NULL,
  `rao_cocont_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_cocont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cocont_ob_totals`
--

INSERT INTO `tb_rao_cocont_ob_totals` (`rao_cocont_id`, `rao_cocont_ob_total_id`, `total_type`, `rao_cocont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ob_total_TO', 0, '', 0, 1),
(1, 2, 'TO', 1, 'Data 1', 0, 1),
(1, 3, 'ob_total_OB', 0, '', 0, 1),
(1, 4, 'OB', 1, 'Data 1', 0, 1),
(1, 5, 'ob_total_AB', 0, '', 4247573.23, 1),
(1, 6, 'AB', 1, 'Data 1', 4247573.23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cont`
--

CREATE TABLE `tb_rao_cont` (
  `rao_cont_id` int(11) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `period_covered` date NOT NULL,
  `brgy_captain` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont`
--

INSERT INTO `tb_rao_cont` (`rao_cont_id`, `chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) VALUES
(83, 'John Frederick Gelay', '2024-11-01', 'Joshua Belandres', 0),
(84, 'John Frederick Gelay', '2024-10-01', 'Joshua Belandres', 0),
(85, 'Zen', '2024-11-01', 'Joshua Belandres', 0),
(86, '1asdad', '2332-12-31', 'asdf', 0),
(87, 'asd', '2001-11-09', 'asdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cont_ap`
--

CREATE TABLE `tb_rao_cont_ap` (
  `rao_cont_id` int(11) NOT NULL,
  `rao_cont_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ap`
--

INSERT INTO `tb_rao_cont_ap` (`rao_cont_id`, `rao_cont_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(83, 63, '2024-11-01', 'Appropriations', 'Annual Budget', 100),
(83, 64, '2024-11-02', 'Appropriations', 'Additional', 100),
(84, 65, '2024-10-01', 'Appropriations', 'Annual Budget', 4500);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cont_ap_data`
--

CREATE TABLE `tb_rao_cont_ap_data` (
  `rao_cont_ap_data_id` int(11) NOT NULL,
  `rao_cont_ap_id` int(11) NOT NULL,
  `rao_cont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ap_data`
--

INSERT INTO `tb_rao_cont_ap_data` (`rao_cont_ap_data_id`, `rao_cont_ap_id`, `rao_cont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(548, 63, 256, 'Data 1', 100, 0),
(549, 64, 256, 'Data 1', 100, 0),
(550, 65, 257, 'Electrification', 100, 0),
(551, 65, 258, 'Road Rehabilitation', 200, 0),
(552, 65, 259, 'Daycare Center', 300, 0),
(553, 65, 260, 'Road Concreting', 400, 0),
(554, 65, 261, 'MES', 500, 0),
(555, 65, 262, 'Foodbridge Lower Lahug', 600, 0),
(556, 65, 263, 'MNHS', 700, 0),
(557, 65, 264, 'SAMPIG ELEM. SCHOOL', 800, 0),
(558, 65, 265, 'SUMAFA WOMENS', 900, 0),
(559, 65, 266, 'WATER RESERVOIR', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cont_ap_totals`
--

CREATE TABLE `tb_rao_cont_ap_totals` (
  `rao_cont_id` int(11) NOT NULL,
  `rao_cont_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_cont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ap_totals`
--

INSERT INTO `tb_rao_cont_ap_totals` (`rao_cont_id`, `rao_cont_ap_total_id`, `total_type`, `rao_cont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(83, 469, 'ap_total_TA', 0, '', 200, 0),
(83, 470, 'TA', 256, 'Data 1', 200, 0),
(83, 471, 'ap_total_BF', 0, '', 200, 0),
(83, 472, 'BF', 256, 'Data 1', 200, 0),
(84, 473, 'ap_total_TA', 0, '', 4500, 0),
(84, 474, 'TA', 257, 'Electrification', 100, 0),
(84, 475, 'TA', 258, 'Road Rehabilitation', 200, 0),
(84, 476, 'TA', 259, 'Daycare Center', 300, 0),
(84, 477, 'TA', 260, 'Road Concreting', 400, 0),
(84, 478, 'TA', 261, 'MES', 500, 0),
(84, 479, 'TA', 262, 'Foodbridge Lower Lahug', 600, 0),
(84, 480, 'TA', 263, 'MNHS', 700, 0),
(84, 481, 'TA', 264, 'SAMPIG ELEM. SCHOOL', 800, 0),
(84, 482, 'TA', 265, 'SUMAFA WOMENS', 900, 0),
(84, 483, 'ap_total_BF', 0, '', 4500, 0),
(84, 484, 'BF', 257, 'Electrification', 100, 0),
(84, 485, 'BF', 258, 'Road Rehabilitation', 200, 0),
(84, 486, 'BF', 259, 'Daycare Center', 300, 0),
(84, 487, 'BF', 260, 'Road Concreting', 400, 0),
(84, 488, 'BF', 261, 'MES', 500, 0),
(84, 489, 'BF', 262, 'Foodbridge Lower Lahug', 600, 0),
(84, 490, 'BF', 263, 'MNHS', 700, 0),
(84, 491, 'BF', 264, 'SAMPIG ELEM. SCHOOL', 800, 0),
(84, 492, 'BF', 265, 'SUMAFA WOMENS', 900, 0),
(84, 493, 'TA', 266, 'WATER RESERVOIR', 0, 0),
(84, 494, 'BF', 266, 'WATER RESERVOIR', 0, 0),
(85, 495, 'ap_total_TA', 0, '', 0, 0),
(85, 496, 'TA', 267, 'Data 1', 0, 0),
(85, 497, 'TA', 268, 'Electrification', 0, 0),
(85, 498, 'TA', 269, 'Road Rehabilitation', 0, 0),
(85, 499, 'TA', 270, 'Daycare Center', 0, 0),
(85, 500, 'TA', 271, 'Road Concreting', 0, 0),
(85, 501, 'TA', 272, 'MES', 0, 0),
(85, 502, 'TA', 273, 'Foodbridge Lower Lahug', 0, 0),
(85, 503, 'TA', 274, 'MNHS', 0, 0),
(85, 504, 'TA', 275, 'SAMPIG ELEM. SCHOOL', 0, 0),
(85, 505, 'TA', 276, 'SUMAFA WOMENS', 0, 0),
(85, 506, 'TA', 277, 'WATER RESERVOIR', 0, 0),
(85, 507, 'ap_total_BF', 0, '', 0, 0),
(85, 508, 'BF', 267, 'Data 1', 0, 0),
(85, 509, 'BF', 268, 'Electrification', 0, 0),
(85, 510, 'BF', 269, 'Road Rehabilitation', 0, 0),
(85, 511, 'BF', 270, 'Daycare Center', 0, 0),
(85, 512, 'BF', 271, 'Road Concreting', 0, 0),
(85, 513, 'BF', 272, 'MES', 0, 0),
(85, 514, 'BF', 273, 'Foodbridge Lower Lahug', 0, 0),
(85, 515, 'BF', 274, 'MNHS', 0, 0),
(85, 516, 'BF', 275, 'SAMPIG ELEM. SCHOOL', 0, 0),
(85, 517, 'BF', 276, 'SUMAFA WOMENS', 0, 0),
(85, 518, 'BF', 277, 'WATER RESERVOIR', 0, 0),
(86, 519, 'ap_total_TA', 0, '', 0, 0),
(86, 520, 'TA', 278, 'Data 1', 0, 0),
(86, 521, 'TA', 279, 'Electrification', 0, 0),
(86, 522, 'TA', 280, 'Road Rehabilitation', 0, 0),
(86, 523, 'TA', 281, 'Daycare Center', 0, 0),
(86, 524, 'TA', 282, 'Foodbridge Lower Lahug', 0, 0),
(86, 525, 'TA', 283, 'MES', 0, 0),
(86, 526, 'TA', 284, 'Road Concreting', 0, 0),
(86, 527, 'TA', 285, 'asdf', 0, 0),
(86, 528, 'ap_total_BF', 0, '', 0, 0),
(86, 529, 'BF', 278, 'Data 1', 0, 0),
(86, 530, 'BF', 279, 'Electrification', 0, 0),
(86, 531, 'BF', 280, 'Road Rehabilitation', 0, 0),
(86, 532, 'BF', 281, 'Daycare Center', 0, 0),
(86, 533, 'BF', 282, 'Foodbridge Lower Lahug', 0, 0),
(86, 534, 'BF', 283, 'MES', 0, 0),
(86, 535, 'BF', 284, 'Road Concreting', 0, 0),
(86, 536, 'BF', 285, 'asdf', 0, 0),
(87, 537, 'ap_total_TA', 0, '', 0, 0),
(87, 538, 'TA', 286, 'Data 1', 0, 0),
(87, 539, 'TA', 287, 'Electrification', 0, 0),
(87, 540, 'ap_total_BF', 0, '', 0, 0),
(87, 541, 'BF', 286, 'Data 1', 0, 0),
(87, 542, 'BF', 287, 'Electrification', 0, 0),
(87, 543, 'ap_total_TA', 0, '', 0, 0),
(87, 544, 'TA', 286, 'Data 1', 0, 0),
(87, 545, 'TA', 287, 'Electrification', 0, 0),
(87, 546, 'ap_total_BF', 0, '', 0, 0),
(87, 547, 'BF', 286, 'Data 1', 0, 0),
(87, 548, 'BF', 287, 'Electrification', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cont_attributes`
--

CREATE TABLE `tb_rao_cont_attributes` (
  `rao_cont_id` int(11) NOT NULL,
  `rao_cont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_attributes`
--

INSERT INTO `tb_rao_cont_attributes` (`rao_cont_id`, `rao_cont_att_id`, `attribute_name`, `isDisplayed`) VALUES
(83, 256, 'Data 1', 0),
(84, 257, 'Electrification', 0),
(84, 258, 'Road Rehabilitation', 0),
(84, 259, 'Daycare Center', 0),
(84, 260, 'Road Concreting', 0),
(84, 261, 'MES', 0),
(84, 262, 'Foodbridge Lower Lahug', 0),
(84, 263, 'MNHS', 0),
(84, 264, 'SAMPIG ELEM. SCHOOL', 0),
(84, 265, 'SUMAFA WOMENS', 0),
(84, 266, 'WATER RESERVOIR', 0),
(85, 267, 'Data 1', 0),
(85, 268, 'Electrification', 0),
(85, 269, 'Road Rehabilitation', 0),
(85, 270, 'Daycare Center', 0),
(85, 271, 'Road Concreting', 0),
(85, 272, 'MES', 0),
(85, 273, 'Foodbridge Lower Lahug', 0),
(85, 274, 'MNHS', 0),
(85, 275, 'SAMPIG ELEM. SCHOOL', 0),
(85, 276, 'SUMAFA WOMENS', 0),
(85, 277, 'WATER RESERVOIR', 0),
(86, 278, 'Data 1', 0),
(86, 279, 'Electrification', 0),
(86, 280, 'Road Rehabilitation', 0),
(86, 281, 'Daycare Center', 0),
(86, 282, 'Foodbridge Lower Lahug', 0),
(86, 283, 'MES', 0),
(86, 284, 'Road Concreting', 0),
(86, 285, 'asdf', 0),
(87, 286, 'Data 1', 0),
(87, 287, 'Electrification', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cont_ob`
--

CREATE TABLE `tb_rao_cont_ob` (
  `rao_cont_id` int(11) NOT NULL,
  `rao_cont_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ob`
--

INSERT INTO `tb_rao_cont_ob` (`rao_cont_id`, `rao_cont_ob_id`, `ob_ref_date`, `ob_ref_no`, `ob_particulars`, `ob_totals`) VALUES
(83, 63, '2024-11-01', 'Obligations', 'Salary and Wages: Tanod', 10),
(87, 64, '2001-11-01', 'aasdf', 'adsf', 0),
(87, 65, '2001-11-01', 'aasdf', 'adsf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cont_ob_data`
--

CREATE TABLE `tb_rao_cont_ob_data` (
  `rao_cont_ob_data_id` int(11) NOT NULL,
  `rao_cont_ob_id` int(11) NOT NULL,
  `rao_cont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ob_data`
--

INSERT INTO `tb_rao_cont_ob_data` (`rao_cont_ob_data_id`, `rao_cont_ob_id`, `rao_cont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(522, 63, 256, 'Data 1', 10, 0),
(523, 64, 286, 'Data 1', 0, 0),
(524, 64, 287, 'Electrification', 0, 0),
(525, 65, 286, 'Data 1', 0, 0),
(526, 65, 287, 'Electrification', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_cont_ob_totals`
--

CREATE TABLE `tb_rao_cont_ob_totals` (
  `rao_cont_id` int(11) NOT NULL,
  `rao_cont_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_cont_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_cont_ob_totals`
--

INSERT INTO `tb_rao_cont_ob_totals` (`rao_cont_id`, `rao_cont_ob_total_id`, `total_type`, `rao_cont_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(83, 703, 'ob_total_TO', 0, '', 10, 0),
(83, 704, 'TO', 256, 'Data 1', 10, 0),
(83, 705, 'ob_total_OB', 0, '', 10, 0),
(83, 706, 'OB', 256, 'Data 1', 10, 0),
(83, 707, 'ob_total_AB', 0, '', 190, 0),
(83, 708, 'AB', 256, 'Data 1', 190, 0),
(84, 709, 'ob_total_TO', 0, '', 0, 0),
(84, 710, 'TO', 257, 'Electrification', 0, 0),
(84, 711, 'TO', 258, 'Road Rehabilitation', 0, 0),
(84, 712, 'TO', 259, 'Daycare Center', 0, 0),
(84, 713, 'TO', 260, 'Road Concreting', 0, 0),
(84, 714, 'TO', 261, 'MES', 0, 0),
(84, 715, 'TO', 262, 'Foodbridge Lower Lahug', 0, 0),
(84, 716, 'TO', 263, 'MNHS', 0, 0),
(84, 717, 'TO', 264, 'SAMPIG ELEM. SCHOOL', 0, 0),
(84, 718, 'TO', 265, 'SUMAFA WOMENS', 0, 0),
(84, 719, 'ob_total_OB', 0, '', 0, 0),
(84, 720, 'OB', 257, 'Electrification', 0, 0),
(84, 721, 'OB', 258, 'Road Rehabilitation', 0, 0),
(84, 722, 'OB', 259, 'Daycare Center', 0, 0),
(84, 723, 'OB', 260, 'Road Concreting', 0, 0),
(84, 724, 'OB', 261, 'MES', 0, 0),
(84, 725, 'OB', 262, 'Foodbridge Lower Lahug', 0, 0),
(84, 726, 'OB', 263, 'MNHS', 0, 0),
(84, 727, 'OB', 264, 'SAMPIG ELEM. SCHOOL', 0, 0),
(84, 728, 'OB', 265, 'SUMAFA WOMENS', 0, 0),
(84, 729, 'ob_total_AB', 0, '', 4500, 0),
(84, 730, 'AB', 257, 'Electrification', 100, 0),
(84, 731, 'AB', 258, 'Road Rehabilitation', 200, 0),
(84, 732, 'AB', 259, 'Daycare Center', 300, 0),
(84, 733, 'AB', 260, 'Road Concreting', 400, 0),
(84, 734, 'AB', 261, 'MES', 500, 0),
(84, 735, 'AB', 262, 'Foodbridge Lower Lahug', 600, 0),
(84, 736, 'AB', 263, 'MNHS', 700, 0),
(84, 737, 'AB', 264, 'SAMPIG ELEM. SCHOOL', 800, 0),
(84, 738, 'AB', 265, 'SUMAFA WOMENS', 900, 0),
(84, 739, 'TO', 266, 'WATER RESERVOIR', 0, 0),
(84, 740, 'OB', 266, 'WATER RESERVOIR', 0, 0),
(84, 741, 'AB', 266, 'WATER RESERVOIR', 0, 0),
(85, 742, 'ob_total_TO', 0, '', 0, 0),
(85, 743, 'TO', 267, 'Data 1', 0, 0),
(85, 744, 'TO', 268, 'Electrification', 0, 0),
(85, 745, 'TO', 269, 'Road Rehabilitation', 0, 0),
(85, 746, 'TO', 270, 'Daycare Center', 0, 0),
(85, 747, 'TO', 271, 'Road Concreting', 0, 0),
(85, 748, 'TO', 272, 'MES', 0, 0),
(85, 749, 'TO', 273, 'Foodbridge Lower Lahug', 0, 0),
(85, 750, 'TO', 274, 'MNHS', 0, 0),
(85, 751, 'TO', 275, 'SAMPIG ELEM. SCHOOL', 0, 0),
(85, 752, 'TO', 276, 'SUMAFA WOMENS', 0, 0),
(85, 753, 'TO', 277, 'WATER RESERVOIR', 0, 0),
(85, 754, 'ob_total_OB', 0, '', 0, 0),
(85, 755, 'OB', 267, 'Data 1', 0, 0),
(85, 756, 'OB', 268, 'Electrification', 0, 0),
(85, 757, 'OB', 269, 'Road Rehabilitation', 0, 0),
(85, 758, 'OB', 270, 'Daycare Center', 0, 0),
(85, 759, 'OB', 271, 'Road Concreting', 0, 0),
(85, 760, 'OB', 272, 'MES', 0, 0),
(85, 761, 'OB', 273, 'Foodbridge Lower Lahug', 0, 0),
(85, 762, 'OB', 274, 'MNHS', 0, 0),
(85, 763, 'OB', 275, 'SAMPIG ELEM. SCHOOL', 0, 0),
(85, 764, 'OB', 276, 'SUMAFA WOMENS', 0, 0),
(85, 765, 'OB', 277, 'WATER RESERVOIR', 0, 0),
(85, 766, 'ob_total_AB', 0, '', 0, 0),
(85, 767, 'AB', 267, 'Data 1', 0, 0),
(85, 768, 'AB', 268, 'Electrification', 0, 0),
(85, 769, 'AB', 269, 'Road Rehabilitation', 0, 0),
(85, 770, 'AB', 270, 'Daycare Center', 0, 0),
(85, 771, 'AB', 271, 'Road Concreting', 0, 0),
(85, 772, 'AB', 272, 'MES', 0, 0),
(85, 773, 'AB', 273, 'Foodbridge Lower Lahug', 0, 0),
(85, 774, 'AB', 274, 'MNHS', 0, 0),
(85, 775, 'AB', 275, 'SAMPIG ELEM. SCHOOL', 0, 0),
(85, 776, 'AB', 276, 'SUMAFA WOMENS', 0, 0),
(85, 777, 'AB', 277, 'WATER RESERVOIR', 0, 0),
(86, 778, 'ob_total_TO', 0, '', 0, 0),
(86, 779, 'TO', 278, 'Data 1', 0, 0),
(86, 780, 'TO', 279, 'Electrification', 0, 0),
(86, 781, 'TO', 280, 'Road Rehabilitation', 0, 0),
(86, 782, 'TO', 281, 'Daycare Center', 0, 0),
(86, 783, 'TO', 282, 'Foodbridge Lower Lahug', 0, 0),
(86, 784, 'TO', 283, 'MES', 0, 0),
(86, 785, 'TO', 284, 'Road Concreting', 0, 0),
(86, 786, 'TO', 285, 'asdf', 0, 0),
(86, 787, 'ob_total_OB', 0, '', 0, 0),
(86, 788, 'OB', 278, 'Data 1', 0, 0),
(86, 789, 'OB', 279, 'Electrification', 0, 0),
(86, 790, 'OB', 280, 'Road Rehabilitation', 0, 0),
(86, 791, 'OB', 281, 'Daycare Center', 0, 0),
(86, 792, 'OB', 282, 'Foodbridge Lower Lahug', 0, 0),
(86, 793, 'OB', 283, 'MES', 0, 0),
(86, 794, 'OB', 284, 'Road Concreting', 0, 0),
(86, 795, 'OB', 285, 'asdf', 0, 0),
(86, 796, 'ob_total_AB', 0, '', 0, 0),
(86, 797, 'AB', 278, 'Data 1', 0, 0),
(86, 798, 'AB', 279, 'Electrification', 0, 0),
(86, 799, 'AB', 280, 'Road Rehabilitation', 0, 0),
(86, 800, 'AB', 281, 'Daycare Center', 0, 0),
(86, 801, 'AB', 282, 'Foodbridge Lower Lahug', 0, 0),
(86, 802, 'AB', 283, 'MES', 0, 0),
(86, 803, 'AB', 284, 'Road Concreting', 0, 0),
(86, 804, 'AB', 285, 'asdf', 0, 0),
(87, 805, 'ob_total_TO', 0, '', 0, 0),
(87, 806, 'TO', 286, 'Data 1', 0, 0),
(87, 807, 'TO', 287, 'Electrification', 0, 0),
(87, 808, 'ob_total_OB', 0, '', 0, 0),
(87, 809, 'OB', 286, 'Data 1', 0, 0),
(87, 810, 'OB', 287, 'Electrification', 0, 0),
(87, 811, 'ob_total_AB', 0, '', 0, 0),
(87, 812, 'AB', 286, 'Data 1', 0, 0),
(87, 813, 'AB', 287, 'Electrification', 0, 0),
(87, 814, 'ob_total_TO', 0, '', 0, 0),
(87, 815, 'TO', 286, 'Data 1', 0, 0),
(87, 816, 'TO', 287, 'Electrification', 0, 0),
(87, 817, 'ob_total_OB', 0, '', 0, 0),
(87, 818, 'OB', 286, 'Data 1', 0, 0),
(87, 819, 'OB', 287, 'Electrification', 0, 0),
(87, 820, 'ob_total_AB', 0, '', 0, 0),
(87, 821, 'AB', 286, 'Data 1', 0, 0),
(87, 822, 'AB', 287, 'Electrification', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_co_ap`
--

CREATE TABLE `tb_rao_co_ap` (
  `rao_co_id` int(11) NOT NULL,
  `rao_co_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_co_ap_data`
--

CREATE TABLE `tb_rao_co_ap_data` (
  `rao_co_ap_data_id` int(11) NOT NULL,
  `rao_co_ap_id` int(11) NOT NULL,
  `rao_co_att_id` varchar(255) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_co_ap_totals`
--

CREATE TABLE `tb_rao_co_ap_totals` (
  `rao_co_id` int(11) NOT NULL,
  `rao_co_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_co_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_co_ap_totals`
--

INSERT INTO `tb_rao_co_ap_totals` (`rao_co_id`, `rao_co_ap_total_id`, `total_type`, `rao_co_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(2, 1, 'ap_total_TA', 0, '', 0, 1),
(2, 2, 'TA', 4, 'Electrification', 0, 1),
(2, 3, 'TA', 5, 'Travel Training Expenses', 0, 1),
(2, 4, 'ap_total_BF', 0, '', 0, 1),
(2, 5, 'BF', 4, 'Electrification', 0, 1),
(2, 6, 'BF', 5, 'Travel Training Expenses', 0, 1),
(1, 7, 'TA', 6, 'Electrification', 0, 0),
(1, 8, 'BF', 6, 'Electrification', 0, 0),
(1, 9, 'TA', 7, 'Travel Training Expenses', 0, 0),
(1, 10, 'BF', 7, 'Travel Training Expenses', 0, 0),
(2, 11, 'TA', 8, 'Data 1', 0, 1),
(2, 12, 'BF', 8, 'Data 1', 0, 1),
(2, 13, 'TA', 9, 'Data 2', 0, 1),
(2, 14, 'BF', 9, 'Data 2', 0, 1),
(2, 15, 'TA', 10, 'Data 3', 0, 1),
(2, 16, 'BF', 10, 'Data 3', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_co_attributes`
--

CREATE TABLE `tb_rao_co_attributes` (
  `rao_co_id` int(11) NOT NULL,
  `rao_co_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_co_attributes`
--

INSERT INTO `tb_rao_co_attributes` (`rao_co_id`, `rao_co_att_id`, `attribute_name`, `isDisplayed`) VALUES
(1, 1, 'Data 1', 0),
(1, 2, 'Data 2', 0),
(1, 3, 'Data 3', 0),
(2, 4, 'Electrification', 1),
(2, 5, 'Travel Training Expenses', 1),
(1, 6, 'Electrification', 0),
(1, 7, 'Travel Training Expenses', 0),
(2, 8, 'Data 1', 1),
(2, 9, 'Data 2', 1),
(2, 10, 'Data 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_co_ob`
--

CREATE TABLE `tb_rao_co_ob` (
  `rao_co_id` int(11) NOT NULL,
  `rao_co_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_co_ob_data`
--

CREATE TABLE `tb_rao_co_ob_data` (
  `rao_co_ob_data_id` int(11) NOT NULL,
  `rao_co_ob_id` int(11) NOT NULL,
  `rao_co_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_co_ob_totals`
--

CREATE TABLE `tb_rao_co_ob_totals` (
  `rao_co_id` int(11) NOT NULL,
  `rao_co_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_co_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_co_ob_totals`
--

INSERT INTO `tb_rao_co_ob_totals` (`rao_co_id`, `rao_co_ob_total_id`, `total_type`, `rao_co_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(2, 1, 'ob_total_TO', 0, '', 0, 1),
(2, 2, 'TO', 4, 'Electrification', 0, 1),
(2, 3, 'TO', 5, 'Travel Training Expenses', 0, 1),
(2, 4, 'ob_total_OB', 0, '', 0, 1),
(2, 5, 'OB', 4, 'Electrification', 0, 1),
(2, 6, 'OB', 5, 'Travel Training Expenses', 0, 1),
(2, 7, 'ob_total_AB', 0, '', 0, 1),
(2, 8, 'AB', 4, 'Electrification', 0, 1),
(2, 9, 'AB', 5, 'Travel Training Expenses', 0, 1),
(1, 10, 'TO', 6, 'Electrification', 0, 0),
(1, 11, 'OB', 6, 'Electrification', 0, 0),
(1, 12, 'AB', 6, 'Electrification', 0, 0),
(1, 13, 'TO', 7, 'Travel Training Expenses', 0, 0),
(1, 14, 'OB', 7, 'Travel Training Expenses', 0, 0),
(1, 15, 'AB', 7, 'Travel Training Expenses', 0, 0),
(2, 16, 'TO', 8, 'Data 1', 0, 1),
(2, 17, 'OB', 8, 'Data 1', 0, 1),
(2, 18, 'AB', 8, 'Data 1', 0, 1),
(2, 19, 'TO', 9, 'Data 2', 0, 1),
(2, 20, 'OB', 9, 'Data 2', 0, 1),
(2, 21, 'AB', 9, 'Data 2', 0, 1),
(2, 22, 'TO', 10, 'Data 3', 0, 1),
(2, 23, 'OB', 10, 'Data 3', 0, 1),
(2, 24, 'AB', 10, 'Data 3', 0, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_dev_ap`
--

CREATE TABLE `tb_rao_dev_ap` (
  `rao_dev_id` int(11) NOT NULL,
  `rao_dev_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_dev_ap`
--

INSERT INTO `tb_rao_dev_ap` (`rao_dev_id`, `rao_dev_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(1, 1, '2024-12-01', 'Appropriations', 'Annual Budget', 1709481);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_dev_ap_data`
--

CREATE TABLE `tb_rao_dev_ap_data` (
  `rao_dev_ap_data_id` int(11) NOT NULL,
  `rao_dev_ap_id` int(11) NOT NULL,
  `rao_dev_att_id` varchar(255) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_dev_ap_data`
--

INSERT INTO `tb_rao_dev_ap_data` (`rao_dev_ap_data_id`, `rao_dev_ap_id`, `rao_dev_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, '1', 'Road Concreting', 749481, 1),
(2, 1, '2', 'Solar Streetlight', 150000, 1),
(3, 1, '3', 'Watershed Kang-ibang', 30000, 1),
(4, 1, '4', 'Dep-ed Counterpart', 100000, 1),
(5, 1, '5', 'Footbridge', 30000, 1),
(6, 1, '6', 'Campacass', 200000, 1),
(7, 1, '7', 'Sampig Spring BOX', 50000, 1),
(8, 1, '8', 'Spillway Alang-alang', 100000, 1),
(9, 1, '9', 'Association', 300000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_dev_ap_totals`
--

CREATE TABLE `tb_rao_dev_ap_totals` (
  `rao_dev_id` int(11) NOT NULL,
  `rao_dev_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_dev_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_dev_ap_totals`
--

INSERT INTO `tb_rao_dev_ap_totals` (`rao_dev_id`, `rao_dev_ap_total_id`, `total_type`, `rao_dev_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ap_total_TA', 0, '', 1709481, 1),
(1, 2, 'TA', 1, 'Road Concreting', 749481, 1),
(1, 3, 'TA', 2, 'Solar Streetlight', 150000, 1),
(1, 4, 'TA', 3, 'Watershed Kang-ibang', 30000, 1),
(1, 5, 'TA', 4, 'Dep-ed Counterpart', 100000, 1),
(1, 6, 'TA', 5, 'Footbridge', 30000, 1),
(1, 7, 'TA', 6, 'Campacass', 200000, 1),
(1, 8, 'TA', 7, 'Sampig Spring BOX', 50000, 1),
(1, 9, 'TA', 8, 'Spillway Alang-alang', 100000, 1),
(1, 10, 'ap_total_BF', 0, '', 1709481, 1),
(1, 11, 'BF', 1, 'Road Concreting', 749481, 1),
(1, 12, 'BF', 2, 'Solar Streetlight', 150000, 1),
(1, 13, 'BF', 3, 'Watershed Kang-ibang', 30000, 1),
(1, 14, 'BF', 4, 'Dep-ed Counterpart', 100000, 1),
(1, 15, 'BF', 5, 'Footbridge', 30000, 1),
(1, 16, 'BF', 6, 'Campacass', 200000, 1),
(1, 17, 'BF', 7, 'Sampig Spring BOX', 50000, 1),
(1, 18, 'BF', 8, 'Spillway Alang-alang', 100000, 1),
(1, 19, 'TA', 9, 'Association', 300000, 1),
(1, 20, 'BF', 9, 'Association', 300000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_dev_attributes`
--

CREATE TABLE `tb_rao_dev_attributes` (
  `rao_dev_id` int(11) NOT NULL,
  `rao_dev_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_dev_attributes`
--

INSERT INTO `tb_rao_dev_attributes` (`rao_dev_id`, `rao_dev_att_id`, `attribute_name`, `isDisplayed`) VALUES
(1, 1, 'Road Concreting', 1),
(1, 2, 'Solar Streetlight', 1),
(1, 3, 'Watershed Kang-ibang', 1),
(1, 4, 'Dep-ed Counterpart', 1),
(1, 5, 'Footbridge', 1),
(1, 6, 'Campacass', 1),
(1, 7, 'Sampig Spring BOX', 1),
(1, 8, 'Spillway Alang-alang', 1),
(1, 9, 'Association', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_dev_ob`
--

CREATE TABLE `tb_rao_dev_ob` (
  `rao_dev_id` int(11) NOT NULL,
  `rao_dev_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_dev_ob_data`
--

CREATE TABLE `tb_rao_dev_ob_data` (
  `rao_dev_ob_data_id` int(11) NOT NULL,
  `rao_dev_ob_id` int(11) NOT NULL,
  `rao_dev_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_dev_ob_totals`
--

CREATE TABLE `tb_rao_dev_ob_totals` (
  `rao_dev_id` int(11) NOT NULL,
  `rao_dev_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_dev_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_dev_ob_totals`
--

INSERT INTO `tb_rao_dev_ob_totals` (`rao_dev_id`, `rao_dev_ob_total_id`, `total_type`, `rao_dev_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ob_total_TO', 0, '', 0, 1),
(1, 2, 'TO', 1, 'Road Concreting', 0, 1),
(1, 3, 'TO', 2, 'Solar Streetlight', 0, 1),
(1, 4, 'TO', 3, 'Watershed Kang-ibang', 0, 1),
(1, 5, 'TO', 4, 'Dep-ed Counterpart', 0, 1),
(1, 6, 'TO', 5, 'Footbridge', 0, 1),
(1, 7, 'TO', 6, 'Campacass', 0, 1),
(1, 8, 'TO', 7, 'Sampig Spring BOX', 0, 1),
(1, 9, 'TO', 8, 'Spillway Alang-alang', 0, 1),
(1, 10, 'ob_total_OB', 0, '', 0, 1),
(1, 11, 'OB', 1, 'Road Concreting', 0, 1),
(1, 12, 'OB', 2, 'Solar Streetlight', 0, 1),
(1, 13, 'OB', 3, 'Watershed Kang-ibang', 0, 1),
(1, 14, 'OB', 4, 'Dep-ed Counterpart', 0, 1),
(1, 15, 'OB', 5, 'Footbridge', 0, 1),
(1, 16, 'OB', 6, 'Campacass', 0, 1),
(1, 17, 'OB', 7, 'Sampig Spring BOX', 0, 1),
(1, 18, 'OB', 8, 'Spillway Alang-alang', 0, 1),
(1, 19, 'ob_total_AB', 0, '', 1709481, 1),
(1, 20, 'AB', 1, 'Road Concreting', 749481, 1),
(1, 21, 'AB', 2, 'Solar Streetlight', 150000, 1),
(1, 22, 'AB', 3, 'Watershed Kang-ibang', 30000, 1),
(1, 23, 'AB', 4, 'Dep-ed Counterpart', 100000, 1),
(1, 24, 'AB', 5, 'Footbridge', 30000, 1),
(1, 25, 'AB', 6, 'Campacass', 200000, 1),
(1, 26, 'AB', 7, 'Sampig Spring BOX', 50000, 1),
(1, 27, 'AB', 8, 'Spillway Alang-alang', 100000, 1),
(1, 28, 'TO', 9, 'Association', 0, 1),
(1, 29, 'OB', 9, 'Association', 0, 1),
(1, 30, 'AB', 9, 'Association', 300000, 1);

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
(1, 'Angebon Reyes', '2024-12-01', 'Joshua Belandres', 0),
(2, 'Pending...', '0000-00-00', 'Pending...', 1),
(3, 'Pending...', '0000-00-00', 'Pending...', 1),
(4, 'Zenaida Belandres', '2024-09-01', 'John Frederick Gelay', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_fe_ap`
--

CREATE TABLE `tb_rao_fe_ap` (
  `rao_fe_id` int(11) NOT NULL,
  `rao_fe_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_ap`
--

INSERT INTO `tb_rao_fe_ap` (`rao_fe_id`, `rao_fe_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(1, 1, '2024-12-01', 'Appropriations', 'Annual Budget', 453.58),
(4, 2, '2024-09-01', 'Appropriations', 'Annual Budget', 601.65),
(4, 3, '2024-09-01', 'Appropriations', 'Additional', 60);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_fe_ap_data`
--

CREATE TABLE `tb_rao_fe_ap_data` (
  `rao_fe_ap_data_id` int(11) NOT NULL,
  `rao_fe_ap_id` int(11) NOT NULL,
  `rao_fe_att_id` varchar(255) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_ap_data`
--

INSERT INTO `tb_rao_fe_ap_data` (`rao_fe_ap_data_id`, `rao_fe_ap_id`, `rao_fe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, '1', 'Data 1', 453.58, 0),
(2, 1, '2', 'Data 2', 0, 0),
(3, 2, '9', 'Data 1', 100.45, 1),
(4, 2, '10', 'Data 2', 200.55, 1),
(5, 2, '11', 'Data 3', 300.65, 1),
(6, 3, '9', 'Data 1', 10, 1),
(7, 3, '10', 'Data 2', 20, 1),
(8, 3, '11', 'Data 3', 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_fe_ap_totals`
--

CREATE TABLE `tb_rao_fe_ap_totals` (
  `rao_fe_id` int(11) NOT NULL,
  `rao_fe_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_fe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_ap_totals`
--

INSERT INTO `tb_rao_fe_ap_totals` (`rao_fe_id`, `rao_fe_ap_total_id`, `total_type`, `rao_fe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ap_total_TA', 0, '', 453.58, 0),
(1, 2, 'TA', 1, 'Data 1', 453.58, 0),
(1, 3, 'TA', 2, 'Data 2', 0, 0),
(1, 4, 'ap_total_BF', 0, '', 453.58, 0),
(1, 5, 'BF', 1, 'Data 1', 453.58, 0),
(1, 6, 'BF', 2, 'Data 2', 0, 0),
(4, 7, 'ap_total_TA', 0, '', 661.65, 1),
(4, 8, 'TA', 9, 'Data 1', 110.45, 1),
(4, 9, 'TA', 10, 'Data 2', 220.55, 1),
(4, 10, 'TA', 11, 'Data 3', 330.65, 1),
(4, 11, 'ap_total_BF', 0, '', 661.65, 1),
(4, 12, 'BF', 9, 'Data 1', 110.45, 1),
(4, 13, 'BF', 10, 'Data 2', 220.55, 1),
(4, 14, 'BF', 11, 'Data 3', 330.65, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_fe_attributes`
--

CREATE TABLE `tb_rao_fe_attributes` (
  `rao_fe_id` int(11) NOT NULL,
  `rao_fe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_attributes`
--

INSERT INTO `tb_rao_fe_attributes` (`rao_fe_id`, `rao_fe_att_id`, `attribute_name`, `isDisplayed`) VALUES
(1, 1, 'Data 1', 0),
(1, 2, 'Data 2', 0),
(2, 3, 'Data 1', 1),
(2, 4, 'Data 2', 1),
(2, 5, 'Data 3', 1),
(3, 6, 'Data 1', 1),
(3, 7, 'Data 2', 1),
(3, 8, 'Data 3', 1),
(4, 9, 'Data 1', 1),
(4, 10, 'Data 2', 1),
(4, 11, 'Data 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_fe_ob`
--

CREATE TABLE `tb_rao_fe_ob` (
  `rao_fe_id` int(11) NOT NULL,
  `rao_fe_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_ob`
--

INSERT INTO `tb_rao_fe_ob` (`rao_fe_id`, `rao_fe_ob_id`, `ob_ref_date`, `ob_ref_no`, `ob_particulars`, `ob_totals`) VALUES
(4, 1, '2024-09-01', 'Obligations', 'Salary and Wages: Tanod', 62.55);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_fe_ob_data`
--

CREATE TABLE `tb_rao_fe_ob_data` (
  `rao_fe_ob_data_id` int(11) NOT NULL,
  `rao_fe_ob_id` int(11) NOT NULL,
  `rao_fe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_ob_data`
--

INSERT INTO `tb_rao_fe_ob_data` (`rao_fe_ob_data_id`, `rao_fe_ob_id`, `rao_fe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 9, 'Data 1', 10.75, 1),
(2, 1, 10, 'Data 2', 20.85, 1),
(3, 1, 11, 'Data 3', 30.95, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_fe_ob_totals`
--

CREATE TABLE `tb_rao_fe_ob_totals` (
  `rao_fe_id` int(11) NOT NULL,
  `rao_fe_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_fe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_fe_ob_totals`
--

INSERT INTO `tb_rao_fe_ob_totals` (`rao_fe_id`, `rao_fe_ob_total_id`, `total_type`, `rao_fe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ob_total_TO', 0, '', 0, 0),
(1, 2, 'TO', 1, 'Data 1', 0, 0),
(1, 3, 'TO', 2, 'Data 2', 0, 0),
(1, 4, 'ob_total_OB', 0, '', 0, 0),
(1, 5, 'OB', 1, 'Data 1', 0, 0),
(1, 6, 'OB', 2, 'Data 2', 0, 0),
(1, 7, 'ob_total_AB', 0, '', 453.58, 0),
(1, 8, 'AB', 1, 'Data 1', 453.58, 0),
(1, 9, 'AB', 2, 'Data 2', 0, 0),
(4, 10, 'ob_total_TO', 0, '', 62.55, 1),
(4, 11, 'TO', 9, 'Data 1', 10.75, 1),
(4, 12, 'TO', 10, 'Data 2', 20.85, 1),
(4, 13, 'TO', 11, 'Data 3', 30.95, 1),
(4, 14, 'ob_total_OB', 0, '', 62.55, 1),
(4, 15, 'OB', 9, 'Data 1', 10.75, 1),
(4, 16, 'OB', 10, 'Data 2', 20.85, 1),
(4, 17, 'OB', 11, 'Data 3', 30.95, 1),
(4, 18, 'ob_total_AB', 0, '', 599.1, 1),
(4, 19, 'AB', 9, 'Data 1', 99.7, 1),
(4, 20, 'AB', 10, 'Data 2', 199.7, 1),
(4, 21, 'AB', 11, 'Data 3', 299.7, 1);

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
(7, 'Angebon Reyes', '2024-12-01', 'Joshua Belandres', 0),
(8, 'Pending...', '0000-00-00', 'Pending...', 0),
(9, 'Angebon Reyes', '2024-10-01', 'Joshua Belandres', 1),
(10, 'John Frederick Gelay', '2024-11-01', 'Joshua Belandres', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_mooe_ap`
--

CREATE TABLE `tb_rao_mooe_ap` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ap`
--

INSERT INTO `tb_rao_mooe_ap` (`rao_mooe_id`, `rao_mooe_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(7, 7, '2024-12-01', 'Appropriations', 'Annual Budget', 522827.97),
(9, 8, '2024-10-01', 'Appropriations', 'Annual Budget', 12786.25),
(10, 9, '2024-11-01', 'Appropriations', 'Annual Budget', 1561);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_mooe_ap_data`
--

CREATE TABLE `tb_rao_mooe_ap_data` (
  `rao_mooe_ap_data_id` int(11) NOT NULL,
  `rao_mooe_ap_id` int(11) NOT NULL,
  `rao_mooe_att_id` varchar(255) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ap_data`
--

INSERT INTO `tb_rao_mooe_ap_data` (`rao_mooe_ap_data_id`, `rao_mooe_ap_id`, `rao_mooe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(41, 7, '35', 'Data 1', 4356.45, 0),
(42, 7, '36', 'Data 2', 42757.12, 0),
(43, 7, '37', 'Data 3', 475714.4, 0),
(44, 7, '38', 'Data 4', 0, 0),
(45, 7, '39', 'Data 5', 0, 0),
(46, 7, '40', 'Data 6', 0, 0),
(47, 7, '41', 'Data 7', 0, 0),
(48, 7, '42', 'Data 8', 0, 0),
(49, 8, '51', 'Data 1', 1245.25, 1),
(50, 8, '52', 'Data 2', 11541, 1),
(51, 8, '53', 'Data 3', 0, 1),
(52, 8, '54', 'Data 4', 0, 1),
(53, 8, '55', 'Data 5', 0, 1),
(54, 8, '56', 'Data 6', 0, 1),
(55, 8, '57', 'Data 7', 0, 1),
(56, 8, '58', 'Data 8', 0, 1),
(57, 9, '59', 'Data 1', 1561, 1),
(58, 9, '60', 'Data 2', 0, 1),
(59, 9, '61', 'Data 3', 0, 1),
(60, 9, '62', 'Data 4', 0, 1),
(61, 9, '63', 'Data 5', 0, 1),
(62, 9, '64', 'Data 6', 0, 1),
(63, 9, '65', 'Data 7', 0, 1),
(64, 9, '66', 'Data 8', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_mooe_ap_totals`
--

CREATE TABLE `tb_rao_mooe_ap_totals` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_mooe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ap_totals`
--

INSERT INTO `tb_rao_mooe_ap_totals` (`rao_mooe_id`, `rao_mooe_ap_total_id`, `total_type`, `rao_mooe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(7, 81, 'ap_total_TA', 0, '', 522827.97, 0),
(7, 82, 'TA', 35, 'Data 1', 4356.45, 0),
(7, 83, 'TA', 36, 'Data 2', 42757.12, 0),
(7, 84, 'TA', 37, 'Data 3', 475714.4, 0),
(7, 85, 'TA', 38, 'Data 4', 0, 0),
(7, 86, 'TA', 39, 'Data 5', 0, 0),
(7, 87, 'TA', 40, 'Data 6', 0, 0),
(7, 88, 'TA', 41, 'Data 7', 0, 0),
(7, 89, 'TA', 42, 'Data 8', 0, 0),
(7, 90, 'ap_total_BF', 0, '', 522827.97, 0),
(7, 91, 'BF', 35, 'Data 1', 4356.45, 0),
(7, 92, 'BF', 36, 'Data 2', 42757.12, 0),
(7, 93, 'BF', 37, 'Data 3', 475714.4, 0),
(7, 94, 'BF', 38, 'Data 4', 0, 0),
(7, 95, 'BF', 39, 'Data 5', 0, 0),
(7, 96, 'BF', 40, 'Data 6', 0, 0),
(7, 97, 'BF', 41, 'Data 7', 0, 0),
(7, 98, 'BF', 42, 'Data 8', 0, 0),
(9, 99, 'ap_total_TA', 0, '', 12786.25, 1),
(9, 100, 'TA', 51, 'Data 1', 1245.25, 1),
(9, 101, 'TA', 52, 'Data 2', 11541, 1),
(9, 102, 'TA', 53, 'Data 3', 0, 1),
(9, 103, 'TA', 54, 'Data 4', 0, 1),
(9, 104, 'TA', 55, 'Data 5', 0, 1),
(9, 105, 'TA', 56, 'Data 6', 0, 1),
(9, 106, 'TA', 57, 'Data 7', 0, 1),
(9, 107, 'TA', 58, 'Data 8', 0, 1),
(9, 108, 'ap_total_BF', 0, '', 12786.25, 1),
(9, 109, 'BF', 51, 'Data 1', 1245.25, 1),
(9, 110, 'BF', 52, 'Data 2', 11541, 1),
(9, 111, 'BF', 53, 'Data 3', 0, 1),
(9, 112, 'BF', 54, 'Data 4', 0, 1),
(9, 113, 'BF', 55, 'Data 5', 0, 1),
(9, 114, 'BF', 56, 'Data 6', 0, 1),
(9, 115, 'BF', 57, 'Data 7', 0, 1),
(9, 116, 'BF', 58, 'Data 8', 0, 1),
(10, 117, 'ap_total_TA', 0, '', 1561, 1),
(10, 118, 'TA', 59, 'Data 1', 1561, 1),
(10, 119, 'TA', 60, 'Data 2', 0, 1),
(10, 120, 'TA', 61, 'Data 3', 0, 1),
(10, 121, 'TA', 62, 'Data 4', 0, 1),
(10, 122, 'TA', 63, 'Data 5', 0, 1),
(10, 123, 'TA', 64, 'Data 6', 0, 1),
(10, 124, 'TA', 65, 'Data 7', 0, 1),
(10, 125, 'TA', 66, 'Data 8', 0, 1),
(10, 126, 'ap_total_BF', 0, '', 1561, 1),
(10, 127, 'BF', 59, 'Data 1', 1561, 1),
(10, 128, 'BF', 60, 'Data 2', 0, 1),
(10, 129, 'BF', 61, 'Data 3', 0, 1),
(10, 130, 'BF', 62, 'Data 4', 0, 1),
(10, 131, 'BF', 63, 'Data 5', 0, 1),
(10, 132, 'BF', 64, 'Data 6', 0, 1),
(10, 133, 'BF', 65, 'Data 7', 0, 1),
(10, 134, 'BF', 66, 'Data 8', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_mooe_attributes`
--

CREATE TABLE `tb_rao_mooe_attributes` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_attributes`
--

INSERT INTO `tb_rao_mooe_attributes` (`rao_mooe_id`, `rao_mooe_att_id`, `attribute_name`, `isDisplayed`) VALUES
(7, 35, 'Data 1', 0),
(7, 36, 'Data 2', 0),
(7, 37, 'Data 3', 0),
(7, 38, 'Data 4', 0),
(7, 39, 'Data 5', 0),
(7, 40, 'Data 6', 0),
(7, 41, 'Data 7', 0),
(7, 42, 'Data 8', 0),
(8, 43, 'Data 1', 0),
(8, 44, 'Data 2', 0),
(8, 45, 'Data 3', 0),
(8, 46, 'Data 4', 0),
(8, 47, 'Data 5', 0),
(8, 48, 'Data 6', 0),
(8, 49, 'Data 7', 0),
(8, 50, 'Data 8', 0),
(9, 51, 'Data 1', 1),
(9, 52, 'Data 2', 1),
(9, 53, 'Data 3', 1),
(9, 54, 'Data 4', 1),
(9, 55, 'Data 5', 1),
(9, 56, 'Data 6', 1),
(9, 57, 'Data 7', 1),
(9, 58, 'Data 8', 1),
(10, 59, 'Data 1', 1),
(10, 60, 'Data 2', 1),
(10, 61, 'Data 3', 1),
(10, 62, 'Data 4', 1),
(10, 63, 'Data 5', 1),
(10, 64, 'Data 6', 1),
(10, 65, 'Data 7', 1),
(10, 66, 'Data 8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_mooe_ob`
--

CREATE TABLE `tb_rao_mooe_ob` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ob`
--

INSERT INTO `tb_rao_mooe_ob` (`rao_mooe_id`, `rao_mooe_ob_id`, `ob_ref_date`, `ob_ref_no`, `ob_particulars`, `ob_totals`) VALUES
(7, 3, '2024-12-01', 'Obligations', 'Salary and Wages: Tanod', 431400.32);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_mooe_ob_data`
--

CREATE TABLE `tb_rao_mooe_ob_data` (
  `rao_mooe_ob_data_id` int(11) NOT NULL,
  `rao_mooe_ob_id` int(11) NOT NULL,
  `rao_mooe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ob_data`
--

INSERT INTO `tb_rao_mooe_ob_data` (`rao_mooe_ob_data_id`, `rao_mooe_ob_id`, `rao_mooe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(13, 3, 35, 'Data 1', 2435.4, 0),
(14, 3, 36, 'Data 2', 7542.52, 0),
(15, 3, 37, 'Data 3', 421422.4, 0),
(16, 3, 38, 'Data 4', 0, 0),
(17, 3, 39, 'Data 5', 0, 0),
(18, 3, 40, 'Data 6', 0, 0),
(19, 3, 41, 'Data 7', 0, 0),
(20, 3, 42, 'Data 8', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_mooe_ob_totals`
--

CREATE TABLE `tb_rao_mooe_ob_totals` (
  `rao_mooe_id` int(11) NOT NULL,
  `rao_mooe_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_mooe_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_mooe_ob_totals`
--

INSERT INTO `tb_rao_mooe_ob_totals` (`rao_mooe_id`, `rao_mooe_ob_total_id`, `total_type`, `rao_mooe_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(7, 121, 'ob_total_TO', 0, '', 431400.32, 0),
(7, 122, 'TO', 35, 'Data 1', 2435.4, 0),
(7, 123, 'TO', 36, 'Data 2', 7542.52, 0),
(7, 124, 'TO', 37, 'Data 3', 421422.4, 0),
(7, 125, 'TO', 38, 'Data 4', 0, 0),
(7, 126, 'TO', 39, 'Data 5', 0, 0),
(7, 127, 'TO', 40, 'Data 6', 0, 0),
(7, 128, 'TO', 41, 'Data 7', 0, 0),
(7, 129, 'TO', 42, 'Data 8', 0, 0),
(7, 130, 'ob_total_OB', 0, '', 431400.32, 0),
(7, 131, 'OB', 35, 'Data 1', 2435.4, 0),
(7, 132, 'OB', 36, 'Data 2', 7542.52, 0),
(7, 133, 'OB', 37, 'Data 3', 421422.4, 0),
(7, 134, 'OB', 38, 'Data 4', 0, 0),
(7, 135, 'OB', 39, 'Data 5', 0, 0),
(7, 136, 'OB', 40, 'Data 6', 0, 0),
(7, 137, 'OB', 41, 'Data 7', 0, 0),
(7, 138, 'OB', 42, 'Data 8', 0, 0),
(7, 139, 'ob_total_AB', 0, '', 91427.65, 0),
(7, 140, 'AB', 35, 'Data 1', 1921.05, 0),
(7, 141, 'AB', 36, 'Data 2', 35214.6, 0),
(7, 142, 'AB', 37, 'Data 3', 54292, 0),
(7, 143, 'AB', 38, 'Data 4', 0, 0),
(7, 144, 'AB', 39, 'Data 5', 0, 0),
(7, 145, 'AB', 40, 'Data 6', 0, 0),
(7, 146, 'AB', 41, 'Data 7', 0, 0),
(7, 147, 'AB', 42, 'Data 8', 0, 0),
(9, 148, 'ob_total_TO', 0, '', 0, 1),
(9, 149, 'TO', 51, 'Data 1', 0, 1),
(9, 150, 'TO', 52, 'Data 2', 0, 1),
(9, 151, 'TO', 53, 'Data 3', 0, 1),
(9, 152, 'TO', 54, 'Data 4', 0, 1),
(9, 153, 'TO', 55, 'Data 5', 0, 1),
(9, 154, 'TO', 56, 'Data 6', 0, 1),
(9, 155, 'TO', 57, 'Data 7', 0, 1),
(9, 156, 'TO', 58, 'Data 8', 0, 1),
(9, 157, 'ob_total_OB', 0, '', 0, 1),
(9, 158, 'OB', 51, 'Data 1', 0, 1),
(9, 159, 'OB', 52, 'Data 2', 0, 1),
(9, 160, 'OB', 53, 'Data 3', 0, 1),
(9, 161, 'OB', 54, 'Data 4', 0, 1),
(9, 162, 'OB', 55, 'Data 5', 0, 1),
(9, 163, 'OB', 56, 'Data 6', 0, 1),
(9, 164, 'OB', 57, 'Data 7', 0, 1),
(9, 165, 'OB', 58, 'Data 8', 0, 1),
(9, 166, 'ob_total_AB', 0, '', 12786.25, 1),
(9, 167, 'AB', 51, 'Data 1', 1245.25, 1),
(9, 168, 'AB', 52, 'Data 2', 11541, 1),
(9, 169, 'AB', 53, 'Data 3', 0, 1),
(9, 170, 'AB', 54, 'Data 4', 0, 1),
(9, 171, 'AB', 55, 'Data 5', 0, 1),
(9, 172, 'AB', 56, 'Data 6', 0, 1),
(9, 173, 'AB', 57, 'Data 7', 0, 1),
(9, 174, 'AB', 58, 'Data 8', 0, 1),
(10, 175, 'ob_total_TO', 0, '', 0, 1),
(10, 176, 'TO', 59, 'Data 1', 0, 1),
(10, 177, 'TO', 60, 'Data 2', 0, 1),
(10, 178, 'TO', 61, 'Data 3', 0, 1),
(10, 179, 'TO', 62, 'Data 4', 0, 1),
(10, 180, 'TO', 63, 'Data 5', 0, 1),
(10, 181, 'TO', 64, 'Data 6', 0, 1),
(10, 182, 'TO', 65, 'Data 7', 0, 1),
(10, 183, 'TO', 66, 'Data 8', 0, 1),
(10, 184, 'ob_total_OB', 0, '', 0, 1),
(10, 185, 'OB', 59, 'Data 1', 0, 1),
(10, 186, 'OB', 60, 'Data 2', 0, 1),
(10, 187, 'OB', 61, 'Data 3', 0, 1),
(10, 188, 'OB', 62, 'Data 4', 0, 1),
(10, 189, 'OB', 63, 'Data 5', 0, 1),
(10, 190, 'OB', 64, 'Data 6', 0, 1),
(10, 191, 'OB', 65, 'Data 7', 0, 1),
(10, 192, 'OB', 66, 'Data 8', 0, 1),
(10, 193, 'ob_total_AB', 0, '', 1561, 1),
(10, 194, 'AB', 59, 'Data 1', 1561, 1),
(10, 195, 'AB', 60, 'Data 2', 0, 1),
(10, 196, 'AB', 61, 'Data 3', 0, 1),
(10, 197, 'AB', 62, 'Data 4', 0, 1),
(10, 198, 'AB', 63, 'Data 5', 0, 1),
(10, 199, 'AB', 64, 'Data 6', 0, 1),
(10, 200, 'AB', 65, 'Data 7', 0, 1),
(10, 201, 'AB', 66, 'Data 8', 0, 1);

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
-- Table structure for table `tb_rao_ps`
--

CREATE TABLE `tb_rao_ps` (
  `rao_ps_id` int(11) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `period_covered` date NOT NULL,
  `brgy_captain` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_ps`
--

INSERT INTO `tb_rao_ps` (`rao_ps_id`, `chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) VALUES
(7, 'John Frederick ', '2024-12-02', 'Joshua ', 0),
(8, 'Zenaida Belandres', '2024-11-01', 'Joshua Belandres', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_ps_ap`
--

CREATE TABLE `tb_rao_ps_ap` (
  `rao_ps_id` int(11) NOT NULL,
  `rao_ps_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_total` double NOT NULL,
  `ap_salary` double NOT NULL,
  `ap_cash_gift` double NOT NULL,
  `ap_year_end` double NOT NULL,
  `ap_mid_year` double NOT NULL,
  `ap_sri` double NOT NULL,
  `ap_others` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_ps_ap`
--

INSERT INTO `tb_rao_ps_ap` (`rao_ps_id`, `rao_ps_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_total`, `ap_salary`, `ap_cash_gift`, `ap_year_end`, `ap_mid_year`, `ap_sri`, `ap_others`, `isDisplayed`) VALUES
(7, 1, '2024-12-01', 'Appropriations', 'Annual Budget', 5134533.86, 4242000, 110000, 178000, 178000, 220000, 206533.86, 0),
(7, 2, '2024-12-01', 'Appropriations', 'Additional', 100000, 100000, 0, 0, 0, 0, 0, 0),
(7, 3, '2024-12-01', 'Appropriations', 'Additional', 100000, 100000, 0, 0, 0, 0, 0, 0),
(8, 4, '2024-11-01', 'Appropriations', 'Annual Budget', 26000, 12000, 14000, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_ps_ob`
--

CREATE TABLE `tb_rao_ps_ob` (
  `rao_ps_id` int(11) NOT NULL,
  `rao_ps_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_total` double NOT NULL,
  `ob_salary` double NOT NULL,
  `ob_cash_gift` double NOT NULL,
  `ob_year_end` double NOT NULL,
  `ob_mid_year` double NOT NULL,
  `ob_sri` double NOT NULL,
  `ob_others` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_ps_ob`
--

INSERT INTO `tb_rao_ps_ob` (`rao_ps_id`, `rao_ps_ob_id`, `ob_ref_date`, `ob_ref_no`, `ob_particulars`, `ob_total`, `ob_salary`, `ob_cash_gift`, `ob_year_end`, `ob_mid_year`, `ob_sri`, `ob_others`, `isDisplayed`) VALUES
(7, 1, '2024-12-02', 'Obligations', 'Salary and Wages: Tanod', 98000, 48000, 48000, 1000, 1000, 0, 0, 0),
(7, 2, '2024-12-01', 'Obligations', 'Salary and Wages: Tanod', 100000, 50000, 50000, 0, 0, 0, 0, 0),
(7, 3, '2024-12-02', 'Obligations', 'Salary and Wages: Additional', 23500, 15000, 0, 0, 8500, 0, 0, 0),
(7, 4, '2024-12-02', 'Obligations', 'Salary and Wages: Additional', 23500, 15000, 0, 0, 8500, 0, 0, 0);

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
(1, 7, 'TA', 26000, 12000, 14000, 0, 0, 0, 0, 0),
(2, 7, 'BF', 26000, 12000, 14000, 0, 0, 0, 0, 0),
(3, 7, 'TO', 0, 0, 0, 0, 0, 0, 0, 0),
(4, 7, 'OB', 0, 0, 0, 0, 0, 0, 0, 0),
(5, 7, 'AB', 26000, 12000, 14000, 0, 0, 0, 0, 0),
(6, 8, 'TA', 26000, 12000, 14000, 0, 0, 0, 0, 1),
(7, 8, 'BF', 26000, 12000, 14000, 0, 0, 0, 0, 1),
(8, 8, 'TO', 0, 0, 0, 0, 0, 0, 0, 1),
(9, 8, 'OB', 0, 0, 0, 0, 0, 0, 0, 1),
(10, 8, 'AB', 26000, 12000, 14000, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_sk`
--

CREATE TABLE `tb_rao_sk` (
  `rao_sk_id` int(11) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `period_covered` date NOT NULL,
  `brgy_captain` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_sk`
--

INSERT INTO `tb_rao_sk` (`rao_sk_id`, `chairman`, `period_covered`, `brgy_captain`, `isDisplayed`) VALUES
(1, 'Angebon Reyes', '2024-12-01', 'Joshua Belandres', 1),
(2, 'Angebon Reyes', '2024-11-01', 'Zenaida Belandres', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_sk_ap`
--

CREATE TABLE `tb_rao_sk_ap` (
  `rao_sk_id` int(11) NOT NULL,
  `rao_sk_ap_id` int(11) NOT NULL,
  `ap_ref_date` date NOT NULL,
  `ap_ref_no` varchar(255) NOT NULL,
  `ap_particulars` varchar(255) NOT NULL,
  `ap_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_sk_ap`
--

INSERT INTO `tb_rao_sk_ap` (`rao_sk_id`, `rao_sk_ap_id`, `ap_ref_date`, `ap_ref_no`, `ap_particulars`, `ap_totals`) VALUES
(1, 1, '2024-12-01', 'Appropriations', 'Particulars', 3232.09),
(2, 2, '2024-11-01', 'Appropriations', 'SK FUNDS', 601.43);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_sk_ap_data`
--

CREATE TABLE `tb_rao_sk_ap_data` (
  `rao_sk_ap_data_id` int(11) NOT NULL,
  `rao_sk_ap_id` int(11) NOT NULL,
  `rao_sk_att_id` varchar(255) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_sk_ap_data`
--

INSERT INTO `tb_rao_sk_ap_data` (`rao_sk_ap_data_id`, `rao_sk_ap_id`, `rao_sk_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, '1', 'Data 1', 1758.56, 1),
(2, 1, '2', 'Data 2', 1473.53, 1),
(3, 1, '3', 'Data 3', 0, 1),
(4, 2, '4', 'Data 1', 100.42, 0),
(5, 2, '5', 'Data 2', 200.54, 0),
(6, 2, '6', 'Data 3', 300.47, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_sk_ap_totals`
--

CREATE TABLE `tb_rao_sk_ap_totals` (
  `rao_sk_id` int(11) NOT NULL,
  `rao_sk_ap_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_sk_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_sk_ap_totals`
--

INSERT INTO `tb_rao_sk_ap_totals` (`rao_sk_id`, `rao_sk_ap_total_id`, `total_type`, `rao_sk_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ap_total_TA', 0, '', 3232.09, 1),
(1, 2, 'TA', 1, 'Data 1', 1758.56, 1),
(1, 3, 'TA', 2, 'Data 2', 1473.53, 1),
(1, 4, 'ap_total_BF', 0, '', 3232.09, 1),
(1, 5, 'BF', 1, 'Data 1', 1758.56, 1),
(1, 6, 'BF', 2, 'Data 2', 1473.53, 1),
(1, 7, 'TA', 3, 'Data 3', 0, 1),
(1, 8, 'BF', 3, 'Data 3', 0, 1),
(2, 9, 'ap_total_TA', 0, '', 601.43, 0),
(2, 10, 'TA', 4, 'Data 1', 100.42, 0),
(2, 11, 'TA', 5, 'Data 2', 200.54, 0),
(2, 12, 'TA', 6, 'Data 3', 300.47, 0),
(2, 13, 'ap_total_BF', 0, '', 601.43, 0),
(2, 14, 'BF', 4, 'Data 1', 100.42, 0),
(2, 15, 'BF', 5, 'Data 2', 200.54, 0),
(2, 16, 'BF', 6, 'Data 3', 300.47, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_sk_attributes`
--

CREATE TABLE `tb_rao_sk_attributes` (
  `rao_sk_id` int(11) NOT NULL,
  `rao_sk_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_sk_attributes`
--

INSERT INTO `tb_rao_sk_attributes` (`rao_sk_id`, `rao_sk_att_id`, `attribute_name`, `isDisplayed`) VALUES
(1, 1, 'Data 1', 1),
(1, 2, 'Data 2', 1),
(1, 3, 'Data 3', 1),
(2, 4, 'Data 1', 0),
(2, 5, 'Data 2', 0),
(2, 6, 'Data 3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_sk_ob`
--

CREATE TABLE `tb_rao_sk_ob` (
  `rao_sk_id` int(11) NOT NULL,
  `rao_sk_ob_id` int(11) NOT NULL,
  `ob_ref_date` date NOT NULL,
  `ob_ref_no` varchar(255) NOT NULL,
  `ob_particulars` varchar(255) NOT NULL,
  `ob_totals` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_rao_sk_ob_totals`
--

CREATE TABLE `tb_rao_sk_ob_totals` (
  `rao_sk_id` int(11) NOT NULL,
  `rao_sk_ob_total_id` int(11) NOT NULL,
  `total_type` varchar(255) NOT NULL,
  `rao_sk_att_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_value` double NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rao_sk_ob_totals`
--

INSERT INTO `tb_rao_sk_ob_totals` (`rao_sk_id`, `rao_sk_ob_total_id`, `total_type`, `rao_sk_att_id`, `attribute_name`, `attribute_value`, `isDisplayed`) VALUES
(1, 1, 'ob_total_TO', 0, '', 0, 1),
(1, 2, 'TO', 1, 'Data 1', 0, 1),
(1, 3, 'TO', 2, 'Data 2', 0, 1),
(1, 4, 'ob_total_OB', 0, '', 0, 1),
(1, 5, 'OB', 1, 'Data 1', 0, 1),
(1, 6, 'OB', 2, 'Data 2', 0, 1),
(1, 7, 'ob_total_AB', 0, '', 3232.09, 1),
(1, 8, 'AB', 1, 'Data 1', 1758.56, 1),
(1, 9, 'AB', 2, 'Data 2', 1473.53, 1),
(1, 10, 'TO', 3, 'Data 3', 0, 1),
(1, 11, 'OB', 3, 'Data 3', 0, 1),
(1, 12, 'AB', 3, 'Data 3', 0, 1),
(2, 13, 'ob_total_TO', 0, '', 0, 0),
(2, 14, 'TO', 4, 'Data 1', 0, 0),
(2, 15, 'TO', 5, 'Data 2', 0, 0),
(2, 16, 'TO', 6, 'Data 3', 0, 0),
(2, 17, 'ob_total_OB', 0, '', 0, 0),
(2, 18, 'OB', 4, 'Data 1', 0, 0),
(2, 19, 'OB', 5, 'Data 2', 0, 0),
(2, 20, 'OB', 6, 'Data 3', 0, 0),
(2, 21, 'ob_total_AB', 0, '', 601.43, 0),
(2, 22, 'AB', 4, 'Data 1', 100.42, 0),
(2, 23, 'AB', 5, 'Data 2', 200.54, 0),
(2, 24, 'AB', 6, 'Data 3', 300.47, 0);

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
(12, 'asd', 'asdfaddddd', 'asdf', '2024-10-06 21:57:00', 'Completed', 1),
(13, 'asdff', 'asdfsdf', 'asdfasdfasf', '2024-11-06 23:45:00', 'dfasdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_residency`
--

CREATE TABLE `tb_residency` (
  `residency_id` int(11) NOT NULL,
  `residency_name` varchar(220) NOT NULL,
  `residency_issued` varchar(220) NOT NULL,
  `residency_date` date NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL,
  `residency_paid` int(11) NOT NULL,
  `residency_dst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_residency`
--

INSERT INTO `tb_residency` (`residency_id`, `residency_name`, `residency_issued`, `residency_date`, `isDisplayed`, `residency_paid`, `residency_dst`) VALUES
(15, 'John Frederick D. Gelay', 'nbi requirements', '2024-11-23', 1, 70, 30),
(16, 'asdfasd', 'fasdfasf', '2024-11-23', 0, 11, 11);

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
  `resident_age` int(11) DEFAULT NULL,
  `resident_status` varchar(30) NOT NULL,
  `resident_householdrole` varchar(50) NOT NULL,
  `resident_maidenname` varchar(50) NOT NULL,
  `resident_contact` varchar(100) DEFAULT NULL,
  `resident_occupation` varchar(255) NOT NULL,
  `resident_religion` varchar(225) NOT NULL,
  `resident_indigenous` varchar(225) NOT NULL,
  `isDisplayed` tinyint(4) NOT NULL,
  `resident_pension` varchar(225) NOT NULL,
  `resident_beneficiaries` varchar(225) NOT NULL,
  `resident_lactating` varchar(225) NOT NULL,
  `resident_pregnant` varchar(225) NOT NULL,
  `resident_PWD` varchar(225) NOT NULL,
  `resident_SY` varchar(225) NOT NULL,
  `resident_height` double DEFAULT NULL,
  `resident_weight` double DEFAULT NULL,
  `resident_heightstat` varchar(225) NOT NULL,
  `resident_weightstat` varchar(225) NOT NULL,
  `resident_BMIstat` varchar(225) NOT NULL,
  `resident_medical` varchar(225) NOT NULL,
  `household_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_resident`
--

INSERT INTO `tb_resident` (`resident_id`, `resident_firstname`, `resident_middlename`, `resident_lastname`, `resident_sex`, `resident_suffixes`, `resident_address`, `resident_educationalattainment`, `resident_birthdate`, `resident_age`, `resident_status`, `resident_householdrole`, `resident_maidenname`, `resident_contact`, `resident_occupation`, `resident_religion`, `resident_indigenous`, `isDisplayed`, `resident_pension`, `resident_beneficiaries`, `resident_lactating`, `resident_pregnant`, `resident_PWD`, `resident_SY`, `resident_height`, `resident_weight`, `resident_heightstat`, `resident_weightstat`, `resident_BMIstat`, `resident_medical`, `household_id`) VALUES
(217, 'gsdfgdfg', 'fdsgsfdgd', 'sdfgsdf', 'Male', ' ', 'Sitio Sto. Nino', 'Elementary', '2001-11-09', 23, 'Single', 'daughter', 'gsdfgds', '', 'asdfasdf', 'asdfasdf', '0', 1, 'asdfasfd', 'asdfasdf', 'fasfa', 'sdfasdfasd', 'fdsafads', 'fasdfasf', 0, 0, 'sdfasdf', 'asdfas', 'Under Weight', 'asdfas', 122),
(218, 'asfasdf', 'dasfdsafas', 'asdfasdf', 'Male', 'Jr', 'Sitio Sto. Nino', 'High School, Undergrad', '1984-11-09', 40, 'Single', '12', 'sadfasdf', '', 'asdfasd', 'asdfasdf', '0', 1, 'asdfasfd', 'asdfasdf', '', '', '', '', NULL, NULL, '', '', '', '', 122),
(222, 'asdfasdf', 'dsafsaf', 'asdfasdf', 'Male', ' ', 'Sitio Suwa', 'Vocational', '2001-11-09', 23, 'Single', 'asdfasf', 'sdfasfadsf', '', 'asdfasdf', 'asdfasdf', 'asdfasf', 1, 'sdfasfa', 'sdfasf', '', '', '', '', NULL, NULL, '', '', '', '', 110920),
(223, 'asdfadsf', 'asdfsafsaf', 'asdfasfasdfsaffd', 'Male', ' ', 'Sitio Sto. Nino', 'Bachelor Degree', '1960-11-09', 64, 'Single', 'son', 'asdfasf', '', 'asdfasd', 'asdfasdf', 'asdfasdfffasd', 1, 'asdfasfd', 'asdfas', '', '', '', '', NULL, NULL, '', '', '', '', 112354),
(224, 'asdfadsf', 'asdfsafsaf', 'xxxxxc', 'Male', ' ', 'Sitio Sto. Nino', 'High School, Graduate', '2001-11-09', 23, 'Single', 'son', 'asdfasf', '', 'asdfasd', 'asdfasdf', 'asdfasdfffasd', 1, 'asdfasfd', 'asdfas', '', '', '', '', NULL, NULL, '', '', '', '', 112354),
(293, 'dfasfas', 'fasfasf', 'asdfas', 'Male', ' ', 'Sitio Suwa', 'Elementary', '2001-11-09', 23, 'Single', 'asfsaf', 'adsfasdf', '', 'asdfa', 'asdfa', 'asfasf', 0, 'asdfasf', 'asfasf', '', '', '', '', NULL, NULL, '', '', '', '', 12354);

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
(14, 105, 'STOOLS', 1, 0, 'Borrowed'),
(15, 105, 'STOOLS', 1, 1, 'Borrowed'),
(16, 105, 'STOOLS', 1, 1, 'Borrowed'),
(17, 105, 'STOOLS', 1, 1, 'Returned'),
(18, 105, 'STOOLS', 1, 1, 'Returned'),
(19, 105, 'STOOLS', 1, 1, 'Returned'),
(20, 105, 'STOOLS', 1, 1, 'Returned'),
(22, 106, 'Table', 1, 1, 'Returned'),
(23, 106, 'Tableeee', 1, 1, 'Returned'),
(23, 106, 'Tableeee', 1, 1, 'Returned'),
(24, 106, 'Tableeee', 12, 12, 'Returned'),
(21, 105, 'STOOLS', 1, 0, 'Borrowed'),
(12, 116, 'asdfasf', 123, 2, 'Borrowed'),
(12, 106, 'Tableeee', 1, 0, 'Borrowed');

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
  `verification_code` varchar(6) DEFAULT NULL,
  `theme` varchar(10) NOT NULL DEFAULT '''light''',
  `suffix` varchar(10) NOT NULL,
  `profile_picture` varchar(255) DEFAULT 'profile_default.png',
  `user_age` int(11) DEFAULT NULL,
  `isApproved` tinyint(4) NOT NULL DEFAULT 0,
  `disapprovalReason` text DEFAULT NULL,
  `approval_status` enum('Pending','Approved','Disapproved') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `lastname`, `firstname`, `middlename`, `sex`, `birthdate`, `barangayposition`, `username`, `password`, `verification_code`, `theme`, `suffix`, `profile_picture`, `user_age`, `isApproved`, `disapprovalReason`, `approval_status`) VALUES
(93, 'Nepomuceno', 'Josephine', 'Belarma', 'Female', '2001-11-09', 'Barangay Captain', 'john-bc', '$2y$10$xqitP33W6cx7wpxiiXaN1OBxGqgIfAX2L1StRbss1xcuuzbqYnXMq', '110921', 'dark', ' ', 'profile_default.png', NULL, 1, NULL, 'Approved'),
(101, 'gelay', 'john', 'domecillo', 'Male', '2001-11-09', 'Barangay Secretary', 'john-bs', '$2y$10$OYxztQxQTDVNnkW3Y1hFsu1/0eu.wt.jfuVbeWrSB5Ytxgv.nxL2.', '111111', '\'light\'', ' ', 'profile_default.png', NULL, 1, NULL, 'Pending'),
(102, 'gelay', 'john', 'frederick', 'Male', '2004-11-09', 'Barangay Treasurer', 'john-br', '$2y$10$fLtu3SJp/X2gewBpVTf7c.53BoqKWEueBXe..4BZD15k5FxLoNceq', NULL, '\'light\'', 'Jr.', 'profile_default.png', NULL, 1, NULL, 'Pending'),
(103, 'gelay', 'john clarence', 'herbias', 'Male', '2001-11-11', 'Barangay Personnel', 'john-bp', '$2y$10$9xRYA192PNJk9xvtDFZbzuaULLNos.bRFxojGCI1tVsXs7.baQ7vG', '110901', '\'light\'', ' ', 'profile_default.png', NULL, 1, NULL, 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_blotter`
--
ALTER TABLE `tb_blotter`
  ADD PRIMARY KEY (`blotter_id`);

--
-- Indexes for table `tb_business_m`
--
ALTER TABLE `tb_business_m`
  ADD PRIMARY KEY (`bemp_id`);

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
-- Indexes for table `tb_cashbook_init`
--
ALTER TABLE `tb_cashbook_init`
  ADD PRIMARY KEY (`init_id`);

--
-- Indexes for table `tb_cashbook_monthly`
--
ALTER TABLE `tb_cashbook_monthly`
  ADD PRIMARY KEY (`monthly_id`);

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
-- Indexes for table `tb_household`
--
ALTER TABLE `tb_household`
  ADD PRIMARY KEY (`id`),
  ADD KEY `household_id` (`household_id`);

--
-- Indexes for table `tb_indigency`
--
ALTER TABLE `tb_indigency`
  ADD PRIMARY KEY (`indigency_id`);

--
-- Indexes for table `tb_indigency_bir`
--
ALTER TABLE `tb_indigency_bir`
  ADD PRIMARY KEY (`indigencyBIR_id`);

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
-- Indexes for table `tb_permit`
--
ALTER TABLE `tb_permit`
  ADD PRIMARY KEY (`permit_id`);

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
-- Indexes for table `tb_rao_bd`
--
ALTER TABLE `tb_rao_bd`
  ADD PRIMARY KEY (`rao_bd_id`);

--
-- Indexes for table `tb_rao_bd_ap`
--
ALTER TABLE `tb_rao_bd_ap`
  ADD PRIMARY KEY (`rao_bd_ap_id`),
  ADD KEY `rao_bd_id` (`rao_bd_id`);

--
-- Indexes for table `tb_rao_bd_ob`
--
ALTER TABLE `tb_rao_bd_ob`
  ADD PRIMARY KEY (`rao_bd_ob_id`),
  ADD KEY `rao_bd_id` (`rao_bd_id`);

--
-- Indexes for table `tb_rao_bd_totals`
--
ALTER TABLE `tb_rao_bd_totals`
  ADD PRIMARY KEY (`rao_bd_total_id`),
  ADD KEY `rao_bd_id` (`rao_bd_id`);

--
-- Indexes for table `tb_rao_co`
--
ALTER TABLE `tb_rao_co`
  ADD PRIMARY KEY (`rao_co_id`);

--
-- Indexes for table `tb_rao_cocont`
--
ALTER TABLE `tb_rao_cocont`
  ADD PRIMARY KEY (`rao_cocont_id`);

--
-- Indexes for table `tb_rao_cocont_ap`
--
ALTER TABLE `tb_rao_cocont_ap`
  ADD PRIMARY KEY (`rao_cocont_ap_id`);

--
-- Indexes for table `tb_rao_cocont_ap_data`
--
ALTER TABLE `tb_rao_cocont_ap_data`
  ADD PRIMARY KEY (`rao_cocont_ap_data_id`),
  ADD KEY `rao_cocont_ap_id` (`rao_cocont_ap_id`);

--
-- Indexes for table `tb_rao_cocont_ap_totals`
--
ALTER TABLE `tb_rao_cocont_ap_totals`
  ADD PRIMARY KEY (`rao_cocont_ap_total_id`),
  ADD KEY `rao_cocont_id` (`rao_cocont_id`);

--
-- Indexes for table `tb_rao_cocont_attributes`
--
ALTER TABLE `tb_rao_cocont_attributes`
  ADD PRIMARY KEY (`rao_cocont_att_id`),
  ADD KEY `rao_cocont_id` (`rao_cocont_id`);

--
-- Indexes for table `tb_rao_cocont_ob`
--
ALTER TABLE `tb_rao_cocont_ob`
  ADD PRIMARY KEY (`rao_cocont_ob_id`),
  ADD KEY `rao_cocont_id` (`rao_cocont_id`);

--
-- Indexes for table `tb_rao_cocont_ob_data`
--
ALTER TABLE `tb_rao_cocont_ob_data`
  ADD PRIMARY KEY (`rao_cocont_ob_data_id`),
  ADD KEY `rao_cocont_ob_id` (`rao_cocont_ob_id`);

--
-- Indexes for table `tb_rao_cocont_ob_totals`
--
ALTER TABLE `tb_rao_cocont_ob_totals`
  ADD PRIMARY KEY (`rao_cocont_ob_total_id`),
  ADD KEY `rao_cocont_id` (`rao_cocont_id`);

--
-- Indexes for table `tb_rao_cont`
--
ALTER TABLE `tb_rao_cont`
  ADD PRIMARY KEY (`rao_cont_id`);

--
-- Indexes for table `tb_rao_cont_ap`
--
ALTER TABLE `tb_rao_cont_ap`
  ADD PRIMARY KEY (`rao_cont_ap_id`),
  ADD KEY `rao_cont_id` (`rao_cont_id`);

--
-- Indexes for table `tb_rao_cont_ap_data`
--
ALTER TABLE `tb_rao_cont_ap_data`
  ADD PRIMARY KEY (`rao_cont_ap_data_id`),
  ADD KEY `rao_cont_ap_id` (`rao_cont_ap_id`);

--
-- Indexes for table `tb_rao_cont_ap_totals`
--
ALTER TABLE `tb_rao_cont_ap_totals`
  ADD PRIMARY KEY (`rao_cont_ap_total_id`),
  ADD KEY `tb_rao_cont_ap_totals_ibfk_1` (`rao_cont_id`);

--
-- Indexes for table `tb_rao_cont_attributes`
--
ALTER TABLE `tb_rao_cont_attributes`
  ADD PRIMARY KEY (`rao_cont_att_id`),
  ADD KEY `rao_cont_id` (`rao_cont_id`);

--
-- Indexes for table `tb_rao_cont_ob`
--
ALTER TABLE `tb_rao_cont_ob`
  ADD PRIMARY KEY (`rao_cont_ob_id`);

--
-- Indexes for table `tb_rao_cont_ob_data`
--
ALTER TABLE `tb_rao_cont_ob_data`
  ADD PRIMARY KEY (`rao_cont_ob_data_id`);

--
-- Indexes for table `tb_rao_cont_ob_totals`
--
ALTER TABLE `tb_rao_cont_ob_totals`
  ADD PRIMARY KEY (`rao_cont_ob_total_id`),
  ADD KEY `rao_cont_id` (`rao_cont_id`);

--
-- Indexes for table `tb_rao_co_ap`
--
ALTER TABLE `tb_rao_co_ap`
  ADD PRIMARY KEY (`rao_co_ap_id`),
  ADD KEY `rao_co_id` (`rao_co_id`);

--
-- Indexes for table `tb_rao_co_ap_data`
--
ALTER TABLE `tb_rao_co_ap_data`
  ADD PRIMARY KEY (`rao_co_ap_data_id`),
  ADD KEY `rao_co_ap_id` (`rao_co_ap_id`);

--
-- Indexes for table `tb_rao_co_ap_totals`
--
ALTER TABLE `tb_rao_co_ap_totals`
  ADD PRIMARY KEY (`rao_co_ap_total_id`),
  ADD KEY `rao_co_id` (`rao_co_id`);

--
-- Indexes for table `tb_rao_co_attributes`
--
ALTER TABLE `tb_rao_co_attributes`
  ADD PRIMARY KEY (`rao_co_att_id`),
  ADD KEY `rao_co_id` (`rao_co_id`);

--
-- Indexes for table `tb_rao_co_ob`
--
ALTER TABLE `tb_rao_co_ob`
  ADD PRIMARY KEY (`rao_co_ob_id`),
  ADD KEY `rao_co_id` (`rao_co_id`);

--
-- Indexes for table `tb_rao_co_ob_data`
--
ALTER TABLE `tb_rao_co_ob_data`
  ADD PRIMARY KEY (`rao_co_ob_data_id`),
  ADD KEY `rao_co_ob_id` (`rao_co_ob_id`);

--
-- Indexes for table `tb_rao_co_ob_totals`
--
ALTER TABLE `tb_rao_co_ob_totals`
  ADD PRIMARY KEY (`rao_co_ob_total_id`),
  ADD KEY `rao_co_id` (`rao_co_id`);

--
-- Indexes for table `tb_rao_dev`
--
ALTER TABLE `tb_rao_dev`
  ADD PRIMARY KEY (`rao_dev_id`);

--
-- Indexes for table `tb_rao_dev_ap`
--
ALTER TABLE `tb_rao_dev_ap`
  ADD PRIMARY KEY (`rao_dev_ap_id`),
  ADD KEY `rao_dev_id` (`rao_dev_id`);

--
-- Indexes for table `tb_rao_dev_ap_data`
--
ALTER TABLE `tb_rao_dev_ap_data`
  ADD PRIMARY KEY (`rao_dev_ap_data_id`),
  ADD KEY `rao_dev_ap_id` (`rao_dev_ap_id`);

--
-- Indexes for table `tb_rao_dev_ap_totals`
--
ALTER TABLE `tb_rao_dev_ap_totals`
  ADD PRIMARY KEY (`rao_dev_ap_total_id`),
  ADD KEY `rao_dev_id` (`rao_dev_id`);

--
-- Indexes for table `tb_rao_dev_attributes`
--
ALTER TABLE `tb_rao_dev_attributes`
  ADD PRIMARY KEY (`rao_dev_att_id`),
  ADD KEY `rao_dev_id` (`rao_dev_id`);

--
-- Indexes for table `tb_rao_dev_ob`
--
ALTER TABLE `tb_rao_dev_ob`
  ADD PRIMARY KEY (`rao_dev_ob_id`),
  ADD KEY `rao_dev_id` (`rao_dev_id`);

--
-- Indexes for table `tb_rao_dev_ob_data`
--
ALTER TABLE `tb_rao_dev_ob_data`
  ADD PRIMARY KEY (`rao_dev_ob_data_id`),
  ADD KEY `rao_dev_ob_id` (`rao_dev_ob_id`);

--
-- Indexes for table `tb_rao_dev_ob_totals`
--
ALTER TABLE `tb_rao_dev_ob_totals`
  ADD PRIMARY KEY (`rao_dev_ob_total_id`),
  ADD KEY `rao_dev_id` (`rao_dev_id`);

--
-- Indexes for table `tb_rao_fe`
--
ALTER TABLE `tb_rao_fe`
  ADD PRIMARY KEY (`rao_fe_id`);

--
-- Indexes for table `tb_rao_fe_ap`
--
ALTER TABLE `tb_rao_fe_ap`
  ADD PRIMARY KEY (`rao_fe_ap_id`),
  ADD KEY `rao_fe_id` (`rao_fe_id`);

--
-- Indexes for table `tb_rao_fe_ap_data`
--
ALTER TABLE `tb_rao_fe_ap_data`
  ADD PRIMARY KEY (`rao_fe_ap_data_id`),
  ADD KEY `rao_fe_ap_id` (`rao_fe_ap_id`);

--
-- Indexes for table `tb_rao_fe_ap_totals`
--
ALTER TABLE `tb_rao_fe_ap_totals`
  ADD PRIMARY KEY (`rao_fe_ap_total_id`),
  ADD KEY `rao_fe_id` (`rao_fe_id`);

--
-- Indexes for table `tb_rao_fe_attributes`
--
ALTER TABLE `tb_rao_fe_attributes`
  ADD PRIMARY KEY (`rao_fe_att_id`),
  ADD KEY `rao_fe_id` (`rao_fe_id`);

--
-- Indexes for table `tb_rao_fe_ob`
--
ALTER TABLE `tb_rao_fe_ob`
  ADD PRIMARY KEY (`rao_fe_ob_id`),
  ADD KEY `rao_fe_id` (`rao_fe_id`);

--
-- Indexes for table `tb_rao_fe_ob_data`
--
ALTER TABLE `tb_rao_fe_ob_data`
  ADD PRIMARY KEY (`rao_fe_ob_data_id`),
  ADD KEY `rao_fe_ob_id` (`rao_fe_ob_id`);

--
-- Indexes for table `tb_rao_fe_ob_totals`
--
ALTER TABLE `tb_rao_fe_ob_totals`
  ADD PRIMARY KEY (`rao_fe_ob_total_id`),
  ADD KEY `rao_fe_id` (`rao_fe_id`);

--
-- Indexes for table `tb_rao_mooe`
--
ALTER TABLE `tb_rao_mooe`
  ADD PRIMARY KEY (`rao_mooe_id`);

--
-- Indexes for table `tb_rao_mooe_ap`
--
ALTER TABLE `tb_rao_mooe_ap`
  ADD PRIMARY KEY (`rao_mooe_ap_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- Indexes for table `tb_rao_mooe_ap_data`
--
ALTER TABLE `tb_rao_mooe_ap_data`
  ADD PRIMARY KEY (`rao_mooe_ap_data_id`),
  ADD KEY `rao_mooe_ap_id` (`rao_mooe_ap_id`);

--
-- Indexes for table `tb_rao_mooe_ap_totals`
--
ALTER TABLE `tb_rao_mooe_ap_totals`
  ADD PRIMARY KEY (`rao_mooe_ap_total_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- Indexes for table `tb_rao_mooe_attributes`
--
ALTER TABLE `tb_rao_mooe_attributes`
  ADD PRIMARY KEY (`rao_mooe_att_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- Indexes for table `tb_rao_mooe_ob`
--
ALTER TABLE `tb_rao_mooe_ob`
  ADD PRIMARY KEY (`rao_mooe_ob_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- Indexes for table `tb_rao_mooe_ob_data`
--
ALTER TABLE `tb_rao_mooe_ob_data`
  ADD PRIMARY KEY (`rao_mooe_ob_data_id`),
  ADD KEY `rao_mooe_ob_id` (`rao_mooe_ob_id`);

--
-- Indexes for table `tb_rao_mooe_ob_totals`
--
ALTER TABLE `tb_rao_mooe_ob_totals`
  ADD PRIMARY KEY (`rao_mooe_ob_total_id`),
  ADD KEY `rao_mooe_id` (`rao_mooe_id`);

--
-- Indexes for table `tb_rao_ob_data`
--
ALTER TABLE `tb_rao_ob_data`
  ADD PRIMARY KEY (`rao_ob_data_id`),
  ADD KEY `rao_id` (`rao_id`);

--
-- Indexes for table `tb_rao_ps`
--
ALTER TABLE `tb_rao_ps`
  ADD PRIMARY KEY (`rao_ps_id`);

--
-- Indexes for table `tb_rao_ps_ap`
--
ALTER TABLE `tb_rao_ps_ap`
  ADD PRIMARY KEY (`rao_ps_ap_id`),
  ADD KEY `rao_ps_id` (`rao_ps_id`);

--
-- Indexes for table `tb_rao_ps_ob`
--
ALTER TABLE `tb_rao_ps_ob`
  ADD PRIMARY KEY (`rao_ps_ob_id`),
  ADD KEY `rao_ps_id` (`rao_ps_id`);

--
-- Indexes for table `tb_rao_ps_totals`
--
ALTER TABLE `tb_rao_ps_totals`
  ADD PRIMARY KEY (`rao_ps_total_id`),
  ADD KEY `rao_ps_id` (`rao_ps_id`);

--
-- Indexes for table `tb_rao_sk`
--
ALTER TABLE `tb_rao_sk`
  ADD PRIMARY KEY (`rao_sk_id`);

--
-- Indexes for table `tb_rao_sk_ap`
--
ALTER TABLE `tb_rao_sk_ap`
  ADD PRIMARY KEY (`rao_sk_ap_id`),
  ADD KEY `rao_sk_id` (`rao_sk_id`);

--
-- Indexes for table `tb_rao_sk_ap_data`
--
ALTER TABLE `tb_rao_sk_ap_data`
  ADD PRIMARY KEY (`rao_sk_ap_data_id`),
  ADD KEY `rao_sk_ap_id` (`rao_sk_ap_id`);

--
-- Indexes for table `tb_rao_sk_ap_totals`
--
ALTER TABLE `tb_rao_sk_ap_totals`
  ADD PRIMARY KEY (`rao_sk_ap_total_id`),
  ADD KEY `rao_sk_id` (`rao_sk_id`);

--
-- Indexes for table `tb_rao_sk_attributes`
--
ALTER TABLE `tb_rao_sk_attributes`
  ADD PRIMARY KEY (`rao_sk_att_id`),
  ADD KEY `rao_sk_id` (`rao_sk_id`);

--
-- Indexes for table `tb_rao_sk_ob`
--
ALTER TABLE `tb_rao_sk_ob`
  ADD PRIMARY KEY (`rao_sk_ob_id`),
  ADD KEY `rao_sk_id` (`rao_sk_id`);

--
-- Indexes for table `tb_rao_sk_ob_data`
--
ALTER TABLE `tb_rao_sk_ob_data`
  ADD PRIMARY KEY (`rao_sk_ob_data_id`),
  ADD KEY `rao_sk_ob_id` (`rao_sk_ob_id`);

--
-- Indexes for table `tb_rao_sk_ob_totals`
--
ALTER TABLE `tb_rao_sk_ob_totals`
  ADD PRIMARY KEY (`rao_sk_ob_total_id`),
  ADD KEY `rao_sk_id` (`rao_sk_id`);

--
-- Indexes for table `tb_request`
--
ALTER TABLE `tb_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tb_residency`
--
ALTER TABLE `tb_residency`
  ADD PRIMARY KEY (`residency_id`);

--
-- Indexes for table `tb_resident`
--
ALTER TABLE `tb_resident`
  ADD PRIMARY KEY (`resident_id`),
  ADD KEY `fk_household_resident` (`household_id`);

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
  MODIFY `blotter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tb_business_m`
--
ALTER TABLE `tb_business_m`
  MODIFY `bemp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `tb_cashbook_init`
--
ALTER TABLE `tb_cashbook_init`
  MODIFY `init_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_cashbook_monthly`
--
ALTER TABLE `tb_cashbook_monthly`
  MODIFY `monthly_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_certificate`
--
ALTER TABLE `tb_certificate`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_document`
--
ALTER TABLE `tb_document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tb_document_files`
--
ALTER TABLE `tb_document_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_employee`
--
ALTER TABLE `tb_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tb_financial`
--
ALTER TABLE `tb_financial`
  MODIFY `financial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_household`
--
ALTER TABLE `tb_household`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_indigency`
--
ALTER TABLE `tb_indigency`
  MODIFY `indigency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_indigency_bir`
--
ALTER TABLE `tb_indigency_bir`
  MODIFY `indigencyBIR_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_inventory`
--
ALTER TABLE `tb_inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tb_item_transaction`
--
ALTER TABLE `tb_item_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_permit`
--
ALTER TABLE `tb_permit`
  MODIFY `permit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `tb_rao_bd`
--
ALTER TABLE `tb_rao_bd`
  MODIFY `rao_bd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_rao_bd_ap`
--
ALTER TABLE `tb_rao_bd_ap`
  MODIFY `rao_bd_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_rao_bd_ob`
--
ALTER TABLE `tb_rao_bd_ob`
  MODIFY `rao_bd_ob_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_bd_totals`
--
ALTER TABLE `tb_rao_bd_totals`
  MODIFY `rao_bd_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_rao_co`
--
ALTER TABLE `tb_rao_co`
  MODIFY `rao_co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_rao_cocont`
--
ALTER TABLE `tb_rao_cocont`
  MODIFY `rao_cocont_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rao_cocont_ap`
--
ALTER TABLE `tb_rao_cocont_ap`
  MODIFY `rao_cocont_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rao_cocont_ap_data`
--
ALTER TABLE `tb_rao_cocont_ap_data`
  MODIFY `rao_cocont_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rao_cocont_ap_totals`
--
ALTER TABLE `tb_rao_cocont_ap_totals`
  MODIFY `rao_cocont_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_rao_cocont_attributes`
--
ALTER TABLE `tb_rao_cocont_attributes`
  MODIFY `rao_cocont_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rao_cocont_ob`
--
ALTER TABLE `tb_rao_cocont_ob`
  MODIFY `rao_cocont_ob_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_cocont_ob_data`
--
ALTER TABLE `tb_rao_cocont_ob_data`
  MODIFY `rao_cocont_ob_data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_cocont_ob_totals`
--
ALTER TABLE `tb_rao_cocont_ob_totals`
  MODIFY `rao_cocont_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_rao_cont`
--
ALTER TABLE `tb_rao_cont`
  MODIFY `rao_cont_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tb_rao_cont_ap`
--
ALTER TABLE `tb_rao_cont_ap`
  MODIFY `rao_cont_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tb_rao_cont_ap_data`
--
ALTER TABLE `tb_rao_cont_ap_data`
  MODIFY `rao_cont_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=560;

--
-- AUTO_INCREMENT for table `tb_rao_cont_ap_totals`
--
ALTER TABLE `tb_rao_cont_ap_totals`
  MODIFY `rao_cont_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=549;

--
-- AUTO_INCREMENT for table `tb_rao_cont_attributes`
--
ALTER TABLE `tb_rao_cont_attributes`
  MODIFY `rao_cont_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `tb_rao_cont_ob`
--
ALTER TABLE `tb_rao_cont_ob`
  MODIFY `rao_cont_ob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tb_rao_cont_ob_data`
--
ALTER TABLE `tb_rao_cont_ob_data`
  MODIFY `rao_cont_ob_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=527;

--
-- AUTO_INCREMENT for table `tb_rao_cont_ob_totals`
--
ALTER TABLE `tb_rao_cont_ob_totals`
  MODIFY `rao_cont_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=823;

--
-- AUTO_INCREMENT for table `tb_rao_co_ap`
--
ALTER TABLE `tb_rao_co_ap`
  MODIFY `rao_co_ap_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_co_ap_data`
--
ALTER TABLE `tb_rao_co_ap_data`
  MODIFY `rao_co_ap_data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_co_ap_totals`
--
ALTER TABLE `tb_rao_co_ap_totals`
  MODIFY `rao_co_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_rao_co_attributes`
--
ALTER TABLE `tb_rao_co_attributes`
  MODIFY `rao_co_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_rao_co_ob`
--
ALTER TABLE `tb_rao_co_ob`
  MODIFY `rao_co_ob_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_co_ob_data`
--
ALTER TABLE `tb_rao_co_ob_data`
  MODIFY `rao_co_ob_data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_co_ob_totals`
--
ALTER TABLE `tb_rao_co_ob_totals`
  MODIFY `rao_co_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_rao_dev`
--
ALTER TABLE `tb_rao_dev`
  MODIFY `rao_dev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rao_dev_ap`
--
ALTER TABLE `tb_rao_dev_ap`
  MODIFY `rao_dev_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rao_dev_ap_data`
--
ALTER TABLE `tb_rao_dev_ap_data`
  MODIFY `rao_dev_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_rao_dev_ap_totals`
--
ALTER TABLE `tb_rao_dev_ap_totals`
  MODIFY `rao_dev_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_rao_dev_attributes`
--
ALTER TABLE `tb_rao_dev_attributes`
  MODIFY `rao_dev_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_rao_dev_ob`
--
ALTER TABLE `tb_rao_dev_ob`
  MODIFY `rao_dev_ob_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_dev_ob_data`
--
ALTER TABLE `tb_rao_dev_ob_data`
  MODIFY `rao_dev_ob_data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_dev_ob_totals`
--
ALTER TABLE `tb_rao_dev_ob_totals`
  MODIFY `rao_dev_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_rao_fe`
--
ALTER TABLE `tb_rao_fe`
  MODIFY `rao_fe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_rao_fe_ap`
--
ALTER TABLE `tb_rao_fe_ap`
  MODIFY `rao_fe_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_rao_fe_ap_data`
--
ALTER TABLE `tb_rao_fe_ap_data`
  MODIFY `rao_fe_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_rao_fe_ap_totals`
--
ALTER TABLE `tb_rao_fe_ap_totals`
  MODIFY `rao_fe_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_rao_fe_attributes`
--
ALTER TABLE `tb_rao_fe_attributes`
  MODIFY `rao_fe_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_rao_fe_ob`
--
ALTER TABLE `tb_rao_fe_ob`
  MODIFY `rao_fe_ob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rao_fe_ob_data`
--
ALTER TABLE `tb_rao_fe_ob_data`
  MODIFY `rao_fe_ob_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_rao_fe_ob_totals`
--
ALTER TABLE `tb_rao_fe_ob_totals`
  MODIFY `rao_fe_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_rao_mooe`
--
ALTER TABLE `tb_rao_mooe`
  MODIFY `rao_mooe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ap`
--
ALTER TABLE `tb_rao_mooe_ap`
  MODIFY `rao_mooe_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ap_data`
--
ALTER TABLE `tb_rao_mooe_ap_data`
  MODIFY `rao_mooe_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ap_totals`
--
ALTER TABLE `tb_rao_mooe_ap_totals`
  MODIFY `rao_mooe_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `tb_rao_mooe_attributes`
--
ALTER TABLE `tb_rao_mooe_attributes`
  MODIFY `rao_mooe_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ob`
--
ALTER TABLE `tb_rao_mooe_ob`
  MODIFY `rao_mooe_ob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ob_data`
--
ALTER TABLE `tb_rao_mooe_ob_data`
  MODIFY `rao_mooe_ob_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_rao_mooe_ob_totals`
--
ALTER TABLE `tb_rao_mooe_ob_totals`
  MODIFY `rao_mooe_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `tb_rao_ob_data`
--
ALTER TABLE `tb_rao_ob_data`
  MODIFY `rao_ob_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_rao_ps`
--
ALTER TABLE `tb_rao_ps`
  MODIFY `rao_ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_rao_ps_ap`
--
ALTER TABLE `tb_rao_ps_ap`
  MODIFY `rao_ps_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_rao_ps_ob`
--
ALTER TABLE `tb_rao_ps_ob`
  MODIFY `rao_ps_ob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_rao_ps_totals`
--
ALTER TABLE `tb_rao_ps_totals`
  MODIFY `rao_ps_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_rao_sk`
--
ALTER TABLE `tb_rao_sk`
  MODIFY `rao_sk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_rao_sk_ap`
--
ALTER TABLE `tb_rao_sk_ap`
  MODIFY `rao_sk_ap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_rao_sk_ap_data`
--
ALTER TABLE `tb_rao_sk_ap_data`
  MODIFY `rao_sk_ap_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_rao_sk_ap_totals`
--
ALTER TABLE `tb_rao_sk_ap_totals`
  MODIFY `rao_sk_ap_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_rao_sk_attributes`
--
ALTER TABLE `tb_rao_sk_attributes`
  MODIFY `rao_sk_att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_rao_sk_ob`
--
ALTER TABLE `tb_rao_sk_ob`
  MODIFY `rao_sk_ob_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_sk_ob_data`
--
ALTER TABLE `tb_rao_sk_ob_data`
  MODIFY `rao_sk_ob_data_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rao_sk_ob_totals`
--
ALTER TABLE `tb_rao_sk_ob_totals`
  MODIFY `rao_sk_ob_total_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_request`
--
ALTER TABLE `tb_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_residency`
--
ALTER TABLE `tb_residency`
  MODIFY `residency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_resident`
--
ALTER TABLE `tb_resident`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

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
-- Constraints for table `tb_rao_bd_ap`
--
ALTER TABLE `tb_rao_bd_ap`
  ADD CONSTRAINT `tb_rao_bd_ap_ibfk_1` FOREIGN KEY (`rao_bd_id`) REFERENCES `tb_rao_bd` (`rao_bd_id`);

--
-- Constraints for table `tb_rao_bd_ob`
--
ALTER TABLE `tb_rao_bd_ob`
  ADD CONSTRAINT `tb_rao_bd_ob_ibfk_1` FOREIGN KEY (`rao_bd_id`) REFERENCES `tb_rao_bd` (`rao_bd_id`);

--
-- Constraints for table `tb_rao_bd_totals`
--
ALTER TABLE `tb_rao_bd_totals`
  ADD CONSTRAINT `tb_rao_bd_totals_ibfk_1` FOREIGN KEY (`rao_bd_id`) REFERENCES `tb_rao_bd` (`rao_bd_id`);

--
-- Constraints for table `tb_rao_cocont_ap_data`
--
ALTER TABLE `tb_rao_cocont_ap_data`
  ADD CONSTRAINT `tb_rao_cocont_ap_data_ibfk_1` FOREIGN KEY (`rao_cocont_ap_id`) REFERENCES `tb_rao_cocont_ap` (`rao_cocont_ap_id`);

--
-- Constraints for table `tb_rao_cocont_ap_totals`
--
ALTER TABLE `tb_rao_cocont_ap_totals`
  ADD CONSTRAINT `tb_rao_cocont_ap_totals_ibfk_1` FOREIGN KEY (`rao_cocont_id`) REFERENCES `tb_rao_cocont` (`rao_cocont_id`);

--
-- Constraints for table `tb_rao_cocont_attributes`
--
ALTER TABLE `tb_rao_cocont_attributes`
  ADD CONSTRAINT `tb_rao_cocont_attributes_ibfk_1` FOREIGN KEY (`rao_cocont_id`) REFERENCES `tb_rao_cocont` (`rao_cocont_id`);

--
-- Constraints for table `tb_rao_cocont_ob`
--
ALTER TABLE `tb_rao_cocont_ob`
  ADD CONSTRAINT `tb_rao_cocont_ob_ibfk_1` FOREIGN KEY (`rao_cocont_id`) REFERENCES `tb_rao_cocont` (`rao_cocont_id`);

--
-- Constraints for table `tb_rao_cocont_ob_data`
--
ALTER TABLE `tb_rao_cocont_ob_data`
  ADD CONSTRAINT `tb_rao_cocont_ob_data_ibfk_1` FOREIGN KEY (`rao_cocont_ob_id`) REFERENCES `tb_rao_cocont_ob` (`rao_cocont_ob_id`);

--
-- Constraints for table `tb_rao_cocont_ob_totals`
--
ALTER TABLE `tb_rao_cocont_ob_totals`
  ADD CONSTRAINT `tb_rao_cocont_ob_totals_ibfk_1` FOREIGN KEY (`rao_cocont_id`) REFERENCES `tb_rao_cocont` (`rao_cocont_id`);

--
-- Constraints for table `tb_rao_cont_ap`
--
ALTER TABLE `tb_rao_cont_ap`
  ADD CONSTRAINT `tb_rao_cont_ap_ibfk_1` FOREIGN KEY (`rao_cont_id`) REFERENCES `tb_rao_cont` (`rao_cont_id`);

--
-- Constraints for table `tb_rao_cont_ap_totals`
--
ALTER TABLE `tb_rao_cont_ap_totals`
  ADD CONSTRAINT `tb_rao_cont_ap_totals_ibfk_1` FOREIGN KEY (`rao_cont_id`) REFERENCES `tb_rao_cont` (`rao_cont_id`);

--
-- Constraints for table `tb_rao_cont_attributes`
--
ALTER TABLE `tb_rao_cont_attributes`
  ADD CONSTRAINT `tb_rao_cont_attributes_ibfk_1` FOREIGN KEY (`rao_cont_id`) REFERENCES `tb_rao_cont` (`rao_cont_id`);

--
-- Constraints for table `tb_rao_cont_ob_totals`
--
ALTER TABLE `tb_rao_cont_ob_totals`
  ADD CONSTRAINT `tb_rao_cont_ob_totals_ibfk_1` FOREIGN KEY (`rao_cont_id`) REFERENCES `tb_rao_cont` (`rao_cont_id`);

--
-- Constraints for table `tb_rao_co_ap`
--
ALTER TABLE `tb_rao_co_ap`
  ADD CONSTRAINT `tb_rao_co_ap_ibfk_1` FOREIGN KEY (`rao_co_id`) REFERENCES `tb_rao_co` (`rao_co_id`);

--
-- Constraints for table `tb_rao_co_ap_data`
--
ALTER TABLE `tb_rao_co_ap_data`
  ADD CONSTRAINT `tb_rao_co_ap_data_ibfk_1` FOREIGN KEY (`rao_co_ap_id`) REFERENCES `tb_rao_co_ap` (`rao_co_ap_id`);

--
-- Constraints for table `tb_rao_co_ap_totals`
--
ALTER TABLE `tb_rao_co_ap_totals`
  ADD CONSTRAINT `tb_rao_co_ap_totals_ibfk_1` FOREIGN KEY (`rao_co_id`) REFERENCES `tb_rao_co` (`rao_co_id`);

--
-- Constraints for table `tb_rao_co_attributes`
--
ALTER TABLE `tb_rao_co_attributes`
  ADD CONSTRAINT `tb_rao_co_attributes_ibfk_1` FOREIGN KEY (`rao_co_id`) REFERENCES `tb_rao_co` (`rao_co_id`);

--
-- Constraints for table `tb_rao_co_ob`
--
ALTER TABLE `tb_rao_co_ob`
  ADD CONSTRAINT `tb_rao_co_ob_ibfk_1` FOREIGN KEY (`rao_co_id`) REFERENCES `tb_rao_co` (`rao_co_id`);

--
-- Constraints for table `tb_rao_co_ob_data`
--
ALTER TABLE `tb_rao_co_ob_data`
  ADD CONSTRAINT `tb_rao_co_ob_data_ibfk_1` FOREIGN KEY (`rao_co_ob_id`) REFERENCES `tb_rao_cont_ob` (`rao_cont_ob_id`);

--
-- Constraints for table `tb_rao_co_ob_totals`
--
ALTER TABLE `tb_rao_co_ob_totals`
  ADD CONSTRAINT `tb_rao_co_ob_totals_ibfk_1` FOREIGN KEY (`rao_co_id`) REFERENCES `tb_rao_co` (`rao_co_id`);

--
-- Constraints for table `tb_rao_dev_ap`
--
ALTER TABLE `tb_rao_dev_ap`
  ADD CONSTRAINT `tb_rao_dev_ap_ibfk_1` FOREIGN KEY (`rao_dev_id`) REFERENCES `tb_rao_dev` (`rao_dev_id`);

--
-- Constraints for table `tb_rao_dev_ap_data`
--
ALTER TABLE `tb_rao_dev_ap_data`
  ADD CONSTRAINT `tb_rao_dev_ap_data_ibfk_1` FOREIGN KEY (`rao_dev_ap_id`) REFERENCES `tb_rao_dev_ap` (`rao_dev_ap_id`);

--
-- Constraints for table `tb_rao_dev_ap_totals`
--
ALTER TABLE `tb_rao_dev_ap_totals`
  ADD CONSTRAINT `tb_rao_dev_ap_totals_ibfk_1` FOREIGN KEY (`rao_dev_id`) REFERENCES `tb_rao_dev` (`rao_dev_id`);

--
-- Constraints for table `tb_rao_dev_attributes`
--
ALTER TABLE `tb_rao_dev_attributes`
  ADD CONSTRAINT `tb_rao_dev_attributes_ibfk_1` FOREIGN KEY (`rao_dev_id`) REFERENCES `tb_rao_dev` (`rao_dev_id`);

--
-- Constraints for table `tb_rao_dev_ob`
--
ALTER TABLE `tb_rao_dev_ob`
  ADD CONSTRAINT `tb_rao_dev_ob_ibfk_1` FOREIGN KEY (`rao_dev_id`) REFERENCES `tb_rao_dev` (`rao_dev_id`);

--
-- Constraints for table `tb_rao_dev_ob_data`
--
ALTER TABLE `tb_rao_dev_ob_data`
  ADD CONSTRAINT `tb_rao_dev_ob_data_ibfk_1` FOREIGN KEY (`rao_dev_ob_id`) REFERENCES `tb_rao_dev_ob` (`rao_dev_ob_id`);

--
-- Constraints for table `tb_rao_dev_ob_totals`
--
ALTER TABLE `tb_rao_dev_ob_totals`
  ADD CONSTRAINT `tb_rao_dev_ob_totals_ibfk_1` FOREIGN KEY (`rao_dev_id`) REFERENCES `tb_rao_dev` (`rao_dev_id`);

--
-- Constraints for table `tb_rao_fe_ap`
--
ALTER TABLE `tb_rao_fe_ap`
  ADD CONSTRAINT `tb_rao_fe_ap_ibfk_1` FOREIGN KEY (`rao_fe_id`) REFERENCES `tb_rao_fe` (`rao_fe_id`);

--
-- Constraints for table `tb_rao_fe_ap_data`
--
ALTER TABLE `tb_rao_fe_ap_data`
  ADD CONSTRAINT `tb_rao_fe_ap_data_ibfk_1` FOREIGN KEY (`rao_fe_ap_id`) REFERENCES `tb_rao_fe_ap` (`rao_fe_ap_id`);

--
-- Constraints for table `tb_rao_fe_ap_totals`
--
ALTER TABLE `tb_rao_fe_ap_totals`
  ADD CONSTRAINT `tb_rao_fe_ap_totals_ibfk_1` FOREIGN KEY (`rao_fe_id`) REFERENCES `tb_rao_fe` (`rao_fe_id`);

--
-- Constraints for table `tb_rao_fe_attributes`
--
ALTER TABLE `tb_rao_fe_attributes`
  ADD CONSTRAINT `tb_rao_fe_attributes_ibfk_1` FOREIGN KEY (`rao_fe_id`) REFERENCES `tb_rao_fe` (`rao_fe_id`);

--
-- Constraints for table `tb_rao_fe_ob`
--
ALTER TABLE `tb_rao_fe_ob`
  ADD CONSTRAINT `tb_rao_fe_ob_ibfk_1` FOREIGN KEY (`rao_fe_id`) REFERENCES `tb_rao_fe` (`rao_fe_id`);

--
-- Constraints for table `tb_rao_fe_ob_data`
--
ALTER TABLE `tb_rao_fe_ob_data`
  ADD CONSTRAINT `tb_rao_fe_ob_data_ibfk_1` FOREIGN KEY (`rao_fe_ob_id`) REFERENCES `tb_rao_fe_ob` (`rao_fe_ob_id`);

--
-- Constraints for table `tb_rao_fe_ob_totals`
--
ALTER TABLE `tb_rao_fe_ob_totals`
  ADD CONSTRAINT `tb_rao_fe_ob_totals_ibfk_1` FOREIGN KEY (`rao_fe_id`) REFERENCES `tb_rao_fe` (`rao_fe_id`);

--
-- Constraints for table `tb_rao_mooe_ap`
--
ALTER TABLE `tb_rao_mooe_ap`
  ADD CONSTRAINT `tb_rao_mooe_ap_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);

--
-- Constraints for table `tb_rao_mooe_ap_data`
--
ALTER TABLE `tb_rao_mooe_ap_data`
  ADD CONSTRAINT `tb_rao_mooe_ap_data_ibfk_1` FOREIGN KEY (`rao_mooe_ap_id`) REFERENCES `tb_rao_mooe_ap` (`rao_mooe_ap_id`);

--
-- Constraints for table `tb_rao_mooe_ap_totals`
--
ALTER TABLE `tb_rao_mooe_ap_totals`
  ADD CONSTRAINT `tb_rao_mooe_ap_totals_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);

--
-- Constraints for table `tb_rao_mooe_attributes`
--
ALTER TABLE `tb_rao_mooe_attributes`
  ADD CONSTRAINT `tb_rao_mooe_attributes_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);

--
-- Constraints for table `tb_rao_mooe_ob`
--
ALTER TABLE `tb_rao_mooe_ob`
  ADD CONSTRAINT `tb_rao_mooe_ob_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);

--
-- Constraints for table `tb_rao_mooe_ob_data`
--
ALTER TABLE `tb_rao_mooe_ob_data`
  ADD CONSTRAINT `tb_rao_mooe_ob_data_ibfk_1` FOREIGN KEY (`rao_mooe_ob_id`) REFERENCES `tb_rao_mooe_ob` (`rao_mooe_ob_id`);

--
-- Constraints for table `tb_rao_mooe_ob_totals`
--
ALTER TABLE `tb_rao_mooe_ob_totals`
  ADD CONSTRAINT `tb_rao_mooe_ob_totals_ibfk_1` FOREIGN KEY (`rao_mooe_id`) REFERENCES `tb_rao_mooe` (`rao_mooe_id`);

--
-- Constraints for table `tb_rao_ob_data`
--
ALTER TABLE `tb_rao_ob_data`
  ADD CONSTRAINT `tb_rao_ob_data_ibfk_1` FOREIGN KEY (`rao_id`) REFERENCES `tb_rao` (`rao_id`);

--
-- Constraints for table `tb_rao_ps_ap`
--
ALTER TABLE `tb_rao_ps_ap`
  ADD CONSTRAINT `tb_rao_ps_ap_ibfk_1` FOREIGN KEY (`rao_ps_id`) REFERENCES `tb_rao_ps` (`rao_ps_id`);

--
-- Constraints for table `tb_rao_ps_ob`
--
ALTER TABLE `tb_rao_ps_ob`
  ADD CONSTRAINT `tb_rao_ps_ob_ibfk_1` FOREIGN KEY (`rao_ps_id`) REFERENCES `tb_rao_ps` (`rao_ps_id`);

--
-- Constraints for table `tb_rao_sk_ap`
--
ALTER TABLE `tb_rao_sk_ap`
  ADD CONSTRAINT `tb_rao_sk_ap_ibfk_1` FOREIGN KEY (`rao_sk_id`) REFERENCES `tb_rao_sk` (`rao_sk_id`);

--
-- Constraints for table `tb_rao_sk_ap_data`
--
ALTER TABLE `tb_rao_sk_ap_data`
  ADD CONSTRAINT `tb_rao_sk_ap_data_ibfk_1` FOREIGN KEY (`rao_sk_ap_id`) REFERENCES `tb_rao_sk_ap` (`rao_sk_ap_id`);

--
-- Constraints for table `tb_rao_sk_ap_totals`
--
ALTER TABLE `tb_rao_sk_ap_totals`
  ADD CONSTRAINT `tb_rao_sk_ap_totals_ibfk_1` FOREIGN KEY (`rao_sk_id`) REFERENCES `tb_rao_sk` (`rao_sk_id`);

--
-- Constraints for table `tb_rao_sk_attributes`
--
ALTER TABLE `tb_rao_sk_attributes`
  ADD CONSTRAINT `tb_rao_sk_attributes_ibfk_1` FOREIGN KEY (`rao_sk_id`) REFERENCES `tb_rao_sk` (`rao_sk_id`);

--
-- Constraints for table `tb_rao_sk_ob`
--
ALTER TABLE `tb_rao_sk_ob`
  ADD CONSTRAINT `tb_rao_sk_ob_ibfk_1` FOREIGN KEY (`rao_sk_id`) REFERENCES `tb_rao_sk` (`rao_sk_id`);

--
-- Constraints for table `tb_rao_sk_ob_data`
--
ALTER TABLE `tb_rao_sk_ob_data`
  ADD CONSTRAINT `tb_rao_sk_ob_data_ibfk_1` FOREIGN KEY (`rao_sk_ob_id`) REFERENCES `tb_rao_sk_ob` (`rao_sk_ob_id`);

--
-- Constraints for table `tb_rao_sk_ob_totals`
--
ALTER TABLE `tb_rao_sk_ob_totals`
  ADD CONSTRAINT `tb_rao_sk_ob_totals_ibfk_1` FOREIGN KEY (`rao_sk_id`) REFERENCES `tb_rao_sk` (`rao_sk_id`);

--
-- Constraints for table `tb_resident`
--
ALTER TABLE `tb_resident`
  ADD CONSTRAINT `fk_household_resident` FOREIGN KEY (`household_id`) REFERENCES `tb_household` (`household_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
