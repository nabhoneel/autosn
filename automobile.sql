-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2018 at 11:09 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `car has options`
--

CREATE TABLE `car has options` (
  `vehicle index` int(11) NOT NULL,
  `option id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car has options`
--

INSERT INTO `car has options` (`vehicle index`, `option id`) VALUES
(1, 7),
(1, 3),
(1, 5),
(2, 7),
(2, 4),
(2, 6),
(3, 3),
(3, 5),
(4, 4),
(4, 5),
(4, 6),
(4, 1),
(4, 3),
(4, 2),
(4, 7),
(7, 3),
(7, 1),
(7, 7),
(7, 6),
(7, 4),
(7, 2),
(7, 5),
(8, 2),
(8, 3),
(8, 6),
(8, 1),
(9, 4),
(9, 3),
(9, 7),
(9, 2),
(9, 1),
(10, 3),
(10, 4),
(12, 6),
(12, 5),
(12, 3),
(13, 1),
(13, 5),
(13, 3),
(13, 2),
(13, 7),
(14, 1),
(14, 5),
(14, 2),
(14, 6),
(14, 4),
(14, 7),
(14, 3),
(16, 2),
(16, 1),
(16, 6),
(16, 5),
(17, 3),
(17, 7),
(17, 4),
(17, 2),
(17, 5),
(19, 6),
(19, 5),
(21, 7),
(21, 6),
(21, 3),
(22, 1),
(22, 5),
(23, 2),
(23, 4),
(24, 2),
(24, 5),
(25, 3),
(25, 4),
(25, 6),
(25, 5),
(25, 2),
(25, 7),
(25, 1),
(26, 1),
(26, 2),
(26, 4),
(26, 5),
(27, 2),
(27, 3),
(27, 6),
(27, 4),
(28, 7),
(28, 4),
(28, 1),
(28, 2),
(28, 6),
(29, 4),
(29, 7),
(29, 2),
(30, 5),
(30, 6),
(30, 4),
(30, 2),
(30, 7),
(31, 7),
(31, 6),
(31, 5),
(31, 2),
(31, 4),
(31, 3),
(31, 1),
(32, 5),
(32, 2),
(32, 3),
(33, 6),
(33, 1),
(34, 2),
(34, 4),
(35, 1),
(35, 5),
(37, 3),
(37, 6),
(37, 4),
(38, 6),
(38, 4),
(38, 1),
(38, 3),
(38, 2),
(40, 2),
(40, 5),
(40, 4),
(41, 5),
(41, 6),
(41, 7),
(41, 1),
(41, 3),
(41, 4),
(41, 2),
(42, 5),
(42, 3),
(42, 6),
(43, 6),
(43, 5),
(43, 4),
(44, 4),
(44, 3),
(44, 6),
(44, 1),
(44, 7),
(44, 5),
(44, 2),
(45, 1),
(45, 7),
(45, 2),
(45, 5),
(45, 6),
(46, 1),
(46, 3),
(46, 5),
(46, 7),
(46, 2),
(46, 6),
(46, 4),
(47, 4),
(47, 3),
(47, 5),
(47, 6),
(47, 7),
(47, 2),
(47, 1),
(48, 3),
(48, 1),
(49, 5),
(49, 3),
(49, 2),
(49, 4),
(49, 6),
(49, 7),
(49, 1),
(50, 4),
(50, 6),
(50, 5),
(51, 6),
(51, 3),
(54, 3),
(54, 7),
(54, 5),
(54, 1),
(54, 4),
(54, 2),
(54, 6),
(55, 4),
(55, 5),
(55, 1),
(55, 2),
(56, 3),
(56, 1),
(57, 1),
(57, 6),
(58, 2),
(58, 4),
(58, 1),
(58, 6),
(58, 7),
(59, 1),
(59, 3),
(60, 2),
(60, 1),
(60, 3),
(60, 5),
(60, 6),
(60, 4),
(60, 7),
(61, 4),
(61, 2),
(61, 5),
(61, 1),
(61, 7),
(61, 6),
(61, 3),
(62, 4),
(62, 2),
(62, 7),
(62, 5),
(62, 1),
(64, 1),
(64, 2),
(64, 6),
(65, 3),
(65, 6),
(65, 1),
(65, 7),
(65, 4),
(65, 2),
(65, 5),
(66, 5),
(66, 2),
(66, 6),
(67, 3),
(67, 6),
(67, 2),
(68, 5),
(68, 6),
(68, 7),
(68, 2),
(68, 3),
(69, 4),
(69, 6),
(70, 2),
(70, 6),
(70, 1),
(70, 7),
(70, 5),
(71, 6),
(71, 7),
(71, 3),
(72, 1),
(72, 3),
(72, 5),
(72, 2),
(72, 7),
(73, 5),
(73, 4),
(73, 6),
(73, 7),
(73, 1),
(73, 2),
(73, 3),
(74, 5),
(74, 4),
(74, 1),
(75, 1),
(75, 5),
(75, 4),
(75, 6),
(75, 7),
(75, 3),
(76, 5),
(76, 2),
(77, 2),
(77, 1),
(77, 5),
(78, 6),
(78, 5),
(79, 1),
(79, 7),
(79, 5),
(79, 3),
(79, 4),
(80, 7),
(80, 5),
(80, 1),
(80, 3),
(80, 6),
(80, 2),
(80, 4),
(81, 4),
(81, 5),
(81, 6),
(81, 7),
(81, 1),
(81, 2),
(82, 7),
(82, 6),
(82, 5),
(82, 2),
(82, 1),
(82, 4),
(82, 3),
(83, 2),
(83, 5),
(83, 7),
(83, 1),
(84, 1),
(84, 7),
(84, 5),
(84, 6),
(84, 3),
(84, 4),
(84, 2),
(85, 3),
(85, 4),
(85, 6),
(85, 1),
(85, 7),
(85, 2),
(87, 7),
(87, 2),
(87, 4),
(87, 3),
(87, 6),
(87, 5),
(87, 1),
(88, 4),
(88, 6),
(88, 7),
(88, 1),
(88, 2),
(88, 5),
(89, 6),
(89, 4),
(89, 3),
(89, 5),
(89, 2),
(89, 7),
(90, 7),
(90, 2),
(90, 1),
(91, 3),
(91, 2),
(91, 6),
(91, 1),
(91, 4),
(91, 5),
(91, 7),
(92, 7),
(92, 5),
(92, 3),
(92, 6),
(92, 2),
(92, 1),
(92, 4),
(93, 7),
(93, 1),
(93, 2),
(94, 1),
(94, 2),
(94, 5),
(94, 4),
(94, 7),
(95, 4),
(95, 1),
(95, 3),
(95, 7),
(95, 5),
(95, 2),
(96, 6),
(96, 3),
(96, 7),
(97, 3),
(97, 6),
(97, 5),
(97, 4),
(97, 1),
(97, 7),
(97, 2),
(98, 5),
(98, 4),
(99, 7),
(99, 1),
(99, 5),
(99, 4),
(100, 2),
(100, 1),
(101, 5),
(101, 4),
(101, 7),
(102, 4),
(102, 7),
(102, 3),
(102, 1),
(102, 2),
(102, 6),
(102, 5),
(103, 7),
(103, 3),
(103, 5),
(103, 1),
(103, 4),
(103, 6),
(104, 7),
(104, 3),
(104, 2),
(104, 6),
(104, 5),
(105, 7),
(105, 5),
(105, 2),
(105, 4),
(105, 6),
(105, 1),
(106, 4),
(106, 7),
(106, 2),
(106, 3),
(106, 5),
(107, 1),
(107, 5),
(107, 7),
(107, 2),
(107, 6),
(107, 4),
(107, 3),
(108, 3),
(108, 7),
(108, 2),
(108, 6),
(108, 5),
(108, 1),
(108, 4),
(109, 4),
(109, 6),
(109, 5),
(109, 1),
(110, 6),
(110, 4),
(110, 5),
(111, 4),
(111, 6),
(111, 5),
(111, 1),
(111, 2),
(111, 3),
(111, 7),
(112, 5),
(112, 1),
(112, 4),
(112, 3),
(112, 6),
(112, 7),
(114, 6),
(114, 2),
(114, 7),
(114, 4),
(114, 1),
(115, 5),
(115, 6),
(115, 1),
(115, 2),
(115, 4),
(115, 7),
(115, 3),
(116, 7),
(116, 6),
(116, 2),
(116, 3),
(117, 6),
(117, 5),
(117, 3),
(117, 4),
(117, 2),
(117, 1),
(117, 7),
(118, 4),
(118, 5),
(118, 6),
(118, 1),
(118, 3),
(118, 7),
(118, 2),
(119, 2),
(119, 6),
(119, 7),
(120, 1),
(120, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `index number` int(10) NOT NULL,
  `company name` varchar(100) NOT NULL,
  `model name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`index number`, `company name`, `model name`) VALUES
(1, 'Ford', 'Aspire'),
(2, 'Ford', 'Aspire'),
(3, 'Ford', 'Aspire'),
(4, 'Ford', 'Aspire'),
(7, 'Ford', 'EcoSport'),
(8, 'Ford', 'EcoSport'),
(9, 'Ford', 'EcoSport'),
(10, 'Ford', 'EcoSport'),
(12, 'Ford', 'EcoSport'),
(13, 'Ford', 'Endeavour'),
(14, 'Ford', 'Endeavour'),
(16, 'Ford', 'Endeavour'),
(17, 'Ford', 'Endeavour'),
(19, 'Ford', 'Figo'),
(21, 'Ford', 'Figo'),
(22, 'Ford', 'Figo'),
(23, 'Ford', 'Figo'),
(24, 'Ford', 'Figo'),
(25, 'Ford', 'Mustang'),
(26, 'Ford', 'Mustang'),
(27, 'Ford', 'Mustang'),
(28, 'Ford', 'Mustang'),
(29, 'Ford', 'Mustang'),
(30, 'Ford', 'Mustang'),
(31, 'Honda', 'Accord'),
(32, 'Honda', 'Accord'),
(33, 'Honda', 'Accord'),
(34, 'Honda', 'Accord'),
(35, 'Honda', 'Accord'),
(37, 'Honda', 'City'),
(38, 'Honda', 'City'),
(40, 'Honda', 'City'),
(41, 'Honda', 'City'),
(42, 'Honda', 'City'),
(43, 'Honda', 'CR-V'),
(44, 'Honda', 'CR-V'),
(45, 'Honda', 'CR-V'),
(46, 'Honda', 'CR-V'),
(47, 'Honda', 'CR-V'),
(48, 'Honda', 'CR-V'),
(49, 'Honda', 'Jazz'),
(50, 'Honda', 'Jazz'),
(51, 'Honda', 'Jazz'),
(54, 'Honda', 'Jazz'),
(55, 'Honda', 'Mobilio'),
(56, 'Honda', 'Mobilio'),
(57, 'Honda', 'Mobilio'),
(58, 'Honda', 'Mobilio'),
(59, 'Honda', 'Mobilio'),
(60, 'Honda', 'Mobilio'),
(61, 'Hyundai', 'Creta'),
(62, 'Hyundai', 'Creta'),
(64, 'Hyundai', 'Creta'),
(65, 'Hyundai', 'Creta'),
(66, 'Hyundai', 'Creta'),
(67, 'Hyundai', 'Eon'),
(68, 'Hyundai', 'Eon'),
(69, 'Hyundai', 'Eon'),
(70, 'Hyundai', 'Eon'),
(71, 'Hyundai', 'Eon'),
(72, 'Hyundai', 'Eon'),
(73, 'Hyundai', 'Excent'),
(74, 'Hyundai', 'Excent'),
(75, 'Hyundai', 'Excent'),
(76, 'Hyundai', 'Excent'),
(77, 'Hyundai', 'Excent'),
(78, 'Hyundai', 'Excent'),
(79, 'Hyundai', 'i10'),
(80, 'Hyundai', 'i10'),
(81, 'Hyundai', 'i10'),
(82, 'Hyundai', 'i10'),
(83, 'Hyundai', 'i10'),
(84, 'Hyundai', 'i10'),
(85, 'Hyundai', 'Verna'),
(87, 'Hyundai', 'Verna'),
(88, 'Hyundai', 'Verna'),
(89, 'Hyundai', 'Verna'),
(90, 'Hyundai', 'Verna'),
(91, 'Maruti Suzuki', 'Alto'),
(92, 'Maruti Suzuki', 'Alto'),
(93, 'Maruti Suzuki', 'Alto'),
(94, 'Maruti Suzuki', 'Alto'),
(95, 'Maruti Suzuki', 'Alto'),
(96, 'Maruti Suzuki', 'Alto'),
(97, 'Maruti Suzuki', 'Baleno'),
(98, 'Maruti Suzuki', 'Baleno'),
(99, 'Maruti Suzuki', 'Baleno'),
(100, 'Maruti Suzuki', 'Baleno'),
(101, 'Maruti Suzuki', 'Baleno'),
(102, 'Maruti Suzuki', 'Baleno'),
(103, 'Maruti Suzuki', 'Brezza'),
(104, 'Maruti Suzuki', 'Brezza'),
(105, 'Maruti Suzuki', 'Brezza'),
(106, 'Maruti Suzuki', 'Brezza'),
(107, 'Maruti Suzuki', 'Brezza'),
(108, 'Maruti Suzuki', 'Brezza'),
(109, 'Maruti Suzuki', 'Ertiga'),
(110, 'Maruti Suzuki', 'Ertiga'),
(111, 'Maruti Suzuki', 'Ertiga'),
(112, 'Maruti Suzuki', 'Ertiga'),
(114, 'Maruti Suzuki', 'Ertiga'),
(115, 'Maruti Suzuki', 'WagonR'),
(116, 'Maruti Suzuki', 'WagonR'),
(117, 'Maruti Suzuki', 'WagonR'),
(118, 'Maruti Suzuki', 'WagonR'),
(119, 'Maruti Suzuki', 'WagonR'),
(120, 'Maruti Suzuki', 'WagonR');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`name`) VALUES
('Ford'),
('Honda'),
('Hyundai'),
('Maruti Suzuki');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact number` bigint(100) NOT NULL,
  `email id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`name`, `dob`, `address`, `contact number`, `email id`) VALUES
('Suchandra Jha', '1995-06-13', 'Kalikapur', 8930519843, 'jhasuchandra@gmail.com'),
('Jhinku Roy Ghosh', '1994-05-11', '219 Gauri Bari', 9840567821, 'jhinku@gmail.com'),
('Jhinku Ray', '1995-12-12', 'RKM Narendrapur', 9803345912, 'jhinku@rkm.com'),
('Minakshi Mukherjee', '1997-02-04', 'JD-2, Salt Lake City, Kolkata 700013', 9850067829, 'minakshiupadhyay@yahoo.com'),
('Nabhoneel Majumdar', '1995-10-20', 'FD 219/8, Sector 3, Salt Lake City', 9830056192, 'nabhoneel.95@gmail.com'),
('Nandini Majumdar', '1968-08-02', 'FD 219/8, Sector 3, Salt Lake City', 9830563493, 'nandini.majumdar@gmail.com'),
('Rishov Nag', '1995-08-14', 'Kankurgachi', 9823443851, 'rishov.nag@gmail.com'),
('Soumen Roy', '1995-02-20', 'FD 219, Salt Lake City, Kolkata 700106', 9830056167, 'soumen@the.hml'),
('Mayukh Mukherjee', '1995-07-07', 'Behala, Kolkata 700010', 9745120311, 'yomayukh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `employer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`username`, `password`, `role`, `employer`) VALUES
('admin', 'nm+sj@autosn.project', 'admin', NULL),
('forddealer', 'fordpassword', 'dealer', 'Ford'),
('gaabroy', 'gilaboo', 'sales', NULL),
('hondadealer', 'hondapassword', 'dealer', 'Honda'),
('hyundaidealer', 'hyundaipassword', 'dealer', 'Hyundai'),
('jhinku', 'castraboo', 'sales', NULL),
('marutidealer', 'marutipassword', 'dealer', 'Maruti Suzuki'),
('nabhoneelm', '123', 'sales', NULL),
('noobie', 'gilaboo', 'sales', NULL),
('pokitee', 'abcd', 'sales', NULL),
('prakriti', 'gilaboo', 'sales', NULL),
('suchandraj', 'abc', 'sales', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `company name` varchar(100) NOT NULL,
  `model name` varchar(100) NOT NULL,
  `number of seats` int(10) NOT NULL,
  `cost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`company name`, `model name`, `number of seats`, `cost`) VALUES
('Ford', 'Aspire', 5, 561000),
('Ford', 'EcoSport', 5, 827000),
('Ford', 'Endeavour', 7, 2614000),
('Ford', 'Figo', 5, 596000),
('Ford', 'Mustang', 4, 7162000),
('Honda', 'Accord', 5, 3700000),
('Honda', 'City', 5, 1000000),
('Honda', 'CR-V', 5, 2610000),
('Honda', 'Jazz', 5, 882000),
('Honda', 'Mobilio', 7, 649000),
('Hyundai', 'Creta', 5, 1200000),
('Hyundai', 'Eon', 4, 440000),
('Hyundai', 'Excent', 5, 670000),
('Hyundai', 'i10', 4, 450000),
('Hyundai', 'Verna', 5, 1300000),
('Maruti Suzuki', 'Alto', 4, 350000),
('Maruti Suzuki', 'Baleno', 5, 665000),
('Maruti Suzuki', 'Brezza', 5, 724000),
('Maruti Suzuki', 'Ertiga', 7, 810000),
('Maruti Suzuki', 'WagonR', 4, 450000);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `option name` varchar(100) NOT NULL,
  `cost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option name`, `cost`) VALUES
(1, 'AC', 8000),
(2, 'Sound System', 2000),
(3, 'Floor Mat', 1100),
(4, 'Leather Seat Cover', 14000),
(5, 'Power Steering', 10000),
(6, 'Alloy wheels', 10000),
(7, '5 years\' servicing', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `sold car`
--

CREATE TABLE `sold car` (
  `id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vehicle index` int(10) NOT NULL,
  `company name` varchar(100) NOT NULL,
  `model name` varchar(100) NOT NULL,
  `sold by` varchar(100) NOT NULL,
  `sold to` varchar(100) NOT NULL,
  `total price` int(10) NOT NULL,
  `credit card number` varchar(100) NOT NULL,
  `expiry month` varchar(100) NOT NULL,
  `expiry year` int(10) NOT NULL,
  `cvv` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sold car`
--

INSERT INTO `sold car` (`id`, `datetime`, `vehicle index`, `company name`, `model name`, `sold by`, `sold to`, `total price`, `credit card number`, `expiry month`, `expiry year`, `cvv`) VALUES
(5, '2017-10-09 21:36:52', 5, 'Ford', 'Aspire', 'nabhoneelm', 'jhasuchandra@gmail.com', 601000, '5423 7589 4992 3484', '2', 2018, 222),
(6, '2017-11-15 21:36:49', 6, 'Ford', 'Aspire', 'nabhoneelm', 'yomayukh@gmail.com', 592100, '2452 3465 4236 4735', '1', 2018, 435),
(7, '2018-01-01 21:36:44', 11, 'Ford', 'EcoSport', 'nabhoneelm', 'minakshiupadhyay@yahoo.com', 892100, '3464 3677 3567 5368', '1', 2018, 324),
(8, '2018-01-09 21:36:40', 18, 'Ford', 'Endeavour', 'nabhoneelm', 'jhinku@gmail.com', 2679100, '4389 5709 8435 9023', '3', 2018, 676),
(9, '2018-03-07 20:43:10', 113, 'Maruti Suzuki', 'Ertiga', 'nabhoneelm', 'nabhoneel.95@gmail.com', 875100, '5943 5934 9859 0238', '1', 2018, 234),
(10, '2018-04-10 21:33:22', 20, 'Ford', 'Figo', 'nabhoneelm', 'nandini.majumdar@gmail.com', 649100, '2323 8473 8789 3275', '6', 2018, 283),
(11, '2018-02-09 21:42:58', 36, 'Honda', 'Accord', 'nabhoneelm', 'nandini.majumdar@gmail.com', 3744000, '2837 4892 3797 9579', '4', 2018, 534),
(12, '2018-02-11 06:27:36', 63, 'Hyundai', 'Creta', 'nabhoneelm', 'nabhoneel.95@gmail.com', 1265100, '2394 8792 3532 4853', '4', 2018, 345),
(13, '2018-01-08 07:13:31', 52, 'Honda', 'Jazz', 'noobie', 'jhasuchandra@gmail.com', 947100, '2443 2532 4534 2534', '5', 2018, 234),
(14, '2018-02-11 07:15:15', 53, 'Honda', 'Jazz', 'noobie', 'rishov.nag@gmail.com', 947100, '2903 7493 2490 2349', '5', 2018, 452),
(15, '2018-02-11 07:36:27', 39, 'Honda', 'City', 'noobie', 'rishov.nag@gmail.com', 1045100, '3985 9347 5983 4589', '4', 2018, 546),
(16, '2018-03-20 08:08:09', 15, 'Ford', 'Endeavour', 'noobie', 'rishov.nag@gmail.com', 2649100, '3453 4624 3623 6234', '4', 2018, 345),
(17, '2018-03-27 08:57:23', 86, 'Hyundai', 'Verna', 'nabhoneelm', 'jhinku@gmail.com', 1332000, '2394 8239 0490 2349', '5', 2018, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sold car has options`
--

CREATE TABLE `sold car has options` (
  `vehicle index` int(10) NOT NULL,
  `option id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sold car has options`
--

INSERT INTO `sold car has options` (`vehicle index`, `option id`) VALUES
(5, 5),
(5, 1),
(5, 2),
(5, 7),
(6, 6),
(6, 5),
(6, 2),
(6, 3),
(6, 1),
(11, 1),
(11, 3),
(11, 7),
(11, 2),
(11, 4),
(11, 5),
(11, 6),
(18, 6),
(18, 7),
(18, 2),
(18, 5),
(18, 4),
(18, 3),
(18, 1),
(113, 1),
(113, 6),
(113, 3),
(113, 7),
(113, 2),
(113, 4),
(113, 5),
(20, 3),
(20, 5),
(20, 4),
(20, 1),
(20, 7),
(36, 4),
(36, 7),
(36, 2),
(36, 1),
(63, 3),
(63, 6),
(63, 5),
(63, 1),
(63, 2),
(63, 4),
(63, 7),
(52, 5),
(52, 7),
(52, 3),
(52, 4),
(52, 6),
(52, 1),
(52, 2),
(53, 6),
(53, 2),
(53, 5),
(53, 1),
(53, 4),
(53, 3),
(53, 7),
(39, 6),
(39, 5),
(39, 4),
(39, 2),
(39, 1),
(39, 3),
(15, 6),
(15, 1),
(15, 2),
(15, 4),
(15, 3),
(86, 2),
(86, 7),
(86, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car has options`
--
ALTER TABLE `car has options`
  ADD KEY `option id` (`option id`),
  ADD KEY `car id` (`vehicle index`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`index number`),
  ADD KEY `company name` (`company name`,`model name`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`email id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `employer` (`employer`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`company name`,`model name`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sold car`
--
ALTER TABLE `sold car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sold by` (`sold by`),
  ADD KEY `sold to` (`sold to`),
  ADD KEY `company name` (`company name`,`model name`),
  ADD KEY `vehicle index` (`vehicle index`);

--
-- Indexes for table `sold car has options`
--
ALTER TABLE `sold car has options`
  ADD KEY `sold car has options_ibfk_1` (`vehicle index`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `index number` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sold car`
--
ALTER TABLE `sold car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car has options`
--
ALTER TABLE `car has options`
  ADD CONSTRAINT `car has options_ibfk_1` FOREIGN KEY (`option id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `car has options_ibfk_2` FOREIGN KEY (`vehicle index`) REFERENCES `cars` (`index number`) ON DELETE CASCADE;

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`company name`,`model name`) REFERENCES `model` (`company name`, `model name`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`employer`) REFERENCES `company` (`name`);

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`company name`) REFERENCES `company` (`name`);

--
-- Constraints for table `sold car`
--
ALTER TABLE `sold car`
  ADD CONSTRAINT `sold car_ibfk_2` FOREIGN KEY (`sold by`) REFERENCES `members` (`username`),
  ADD CONSTRAINT `sold car_ibfk_4` FOREIGN KEY (`company name`,`model name`) REFERENCES `model` (`company name`, `model name`),
  ADD CONSTRAINT `sold car_ibfk_5` FOREIGN KEY (`sold to`) REFERENCES `customer` (`email id`);

--
-- Constraints for table `sold car has options`
--
ALTER TABLE `sold car has options`
  ADD CONSTRAINT `sold car has options_ibfk_1` FOREIGN KEY (`vehicle index`) REFERENCES `sold car` (`vehicle index`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
