-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2018 at 12:56 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

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
  `car id` int(11) NOT NULL,
  `option id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `car sold`
--

CREATE TABLE `car sold` (
  `id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `model name` varchar(100) NOT NULL,
  `company name` varchar(100) NOT NULL,
  `sold by` varchar(100) NOT NULL,
  `sold to` int(10) NOT NULL,
  `total price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact number` bigint(100) NOT NULL,
  `email id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `dob`, `address`, `contact number`, `email id`) VALUES
(1, 'Minakshi Upadhyay', '1980-07-24', 'Gitanjali Park, Kalikapur, Kolkata-700099', 9748451203, 'minakshiupadhyay@gmail.com'),
(2, 'Mayukh Mukherji', '1995-06-06', 'Behala, Kolkata', 9745120312, 'mayukh@yahoo.com'),
(3, 'Soumen Roy', '1995-10-20', 'FD 219, Salt Lake City, Kolkata 700106', 9830056167, 'soumen@the.hml');

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
('forddealer', 'fordpassword', 'dealer', 'Ford'),
('gaabroy', 'gilaboo', 'sales', NULL),
('hondadealer', 'hondapassword', 'dealer', 'Honda'),
('hyundaidealer', 'hyundaipassword', 'dealer', 'Hyundai'),
('marutidealer', 'marutipassword', 'dealer', 'Maruti Suzuki'),
('nabhoneelm', '123', 'sales', NULL),
('noobie', 'gilaboo', 'sales', NULL),
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
-- Table structure for table `model has options`
--

CREATE TABLE `model has options` (
  `company name` varchar(100) NOT NULL,
  `model name` varchar(100) NOT NULL,
  `option id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model has options`
--

INSERT INTO `model has options` (`company name`, `model name`, `option id`) VALUES
('Ford', 'Aspire', 1),
('Ford', 'Aspire', 2),
('Ford', 'Aspire', 3),
('Ford', 'Aspire', 4),
('Ford', 'Aspire', 5),
('Ford', 'EcoSport', 1),
('Ford', 'EcoSport', 2),
('Ford', 'EcoSport', 4),
('Ford', 'EcoSport', 5),
('Ford', 'EcoSport', 6),
('Ford', 'Endeavour', 1),
('Ford', 'Endeavour', 2),
('Ford', 'Endeavour', 3),
('Ford', 'Endeavour', 4),
('Ford', 'Endeavour', 5),
('Ford', 'Figo', 1),
('Ford', 'Figo', 2),
('Ford', 'Figo', 5),
('Ford', 'Mustang', 1),
('Ford', 'Mustang', 2),
('Ford', 'Mustang', 3),
('Ford', 'Mustang', 4),
('Ford', 'Mustang', 5),
('Ford', 'Mustang', 6),
('Ford', 'Mustang', 7),
('Honda', 'Accord', 1),
('Honda', 'Accord', 2),
('Honda', 'Accord', 3),
('Honda', 'Accord', 4),
('Honda', 'Accord', 5),
('Honda', 'City', 1),
('Honda', 'City', 2),
('Honda', 'City', 3),
('Honda', 'City', 4),
('Honda', 'City', 5),
('Honda', 'City', 6),
('Honda', 'City', 7),
('Honda', 'CR-V', 1),
('Honda', 'CR-V', 2),
('Honda', 'CR-V', 3),
('Honda', 'CR-V', 5),
('Honda', 'CR-V', 6),
('Honda', 'Jazz', 1),
('Honda', 'Jazz', 2),
('Honda', 'Jazz', 6),
('Honda', 'Mobilio', 1),
('Honda', 'Mobilio', 2),
('Honda', 'Mobilio', 5),
('Honda', 'Mobilio', 6),
('Honda', 'Mobilio', 7),
('Hyundai', 'Creta', 1),
('Hyundai', 'Creta', 2),
('Hyundai', 'Creta', 5),
('Hyundai', 'Creta', 6),
('Hyundai', 'Creta', 7),
('Hyundai', 'Eon', 1),
('Hyundai', 'Eon', 5),
('Hyundai', 'Excent', 1),
('Hyundai', 'Excent', 2),
('Hyundai', 'Excent', 5),
('Hyundai', 'Excent', 6),
('Hyundai', 'Verna', 1),
('Hyundai', 'Verna', 2),
('Hyundai', 'Verna', 5),
('Maruti Suzuki', 'Alto', 1),
('Maruti Suzuki', 'Alto', 2),
('Maruti Suzuki', 'Alto', 5),
('Maruti Suzuki', 'Alto', 7),
('Maruti Suzuki', 'Baleno', 1),
('Maruti Suzuki', 'Baleno', 2),
('Maruti Suzuki', 'Baleno', 3),
('Maruti Suzuki', 'Baleno', 4),
('Maruti Suzuki', 'Baleno', 5),
('Maruti Suzuki', 'Baleno', 7),
('Maruti Suzuki', 'Brezza', 1),
('Maruti Suzuki', 'Brezza', 2),
('Maruti Suzuki', 'Brezza', 3),
('Maruti Suzuki', 'Brezza', 4),
('Maruti Suzuki', 'Brezza', 5),
('Maruti Suzuki', 'Brezza', 6),
('Maruti Suzuki', 'Brezza', 7),
('Maruti Suzuki', 'Ertiga', 1),
('Maruti Suzuki', 'Ertiga', 2),
('Maruti Suzuki', 'Ertiga', 5),
('Maruti Suzuki', 'Ertiga', 6),
('Maruti Suzuki', 'Ertiga', 7),
('Maruti Suzuki', 'WagonR', 1),
('Maruti Suzuki', 'WagonR', 2),
('Maruti Suzuki', 'WagonR', 5);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car has options`
--
ALTER TABLE `car has options`
  ADD KEY `option id` (`option id`),
  ADD KEY `car id` (`car id`);

--
-- Indexes for table `car sold`
--
ALTER TABLE `car sold`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company name` (`company name`,`model name`),
  ADD KEY `sold by` (`sold by`),
  ADD KEY `sold to` (`sold to`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `model has options`
--
ALTER TABLE `model has options`
  ADD UNIQUE KEY `company name_2` (`company name`,`model name`,`option id`),
  ADD KEY `option id` (`option id`),
  ADD KEY `company name` (`company name`,`model name`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car sold`
--
ALTER TABLE `car sold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `car has options`
--
ALTER TABLE `car has options`
  ADD CONSTRAINT `car has options_ibfk_1` FOREIGN KEY (`option id`) REFERENCES `options` (`id`),
  ADD CONSTRAINT `car has options_ibfk_2` FOREIGN KEY (`car id`) REFERENCES `car sold` (`id`);

--
-- Constraints for table `car sold`
--
ALTER TABLE `car sold`
  ADD CONSTRAINT `car sold_ibfk_1` FOREIGN KEY (`company name`,`model name`) REFERENCES `model` (`company name`, `model name`),
  ADD CONSTRAINT `car sold_ibfk_2` FOREIGN KEY (`sold by`) REFERENCES `members` (`username`),
  ADD CONSTRAINT `car sold_ibfk_3` FOREIGN KEY (`sold to`) REFERENCES `customer` (`id`);

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
-- Constraints for table `model has options`
--
ALTER TABLE `model has options`
  ADD CONSTRAINT `model has options_ibfk_1` FOREIGN KEY (`option id`) REFERENCES `options` (`id`),
  ADD CONSTRAINT `model has options_ibfk_2` FOREIGN KEY (`company name`,`model name`) REFERENCES `model` (`company name`, `model name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
