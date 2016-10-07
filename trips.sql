-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2016 at 06:41 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp4724_tors`
--

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `ID` int(11) NOT NULL,
  `BusID` int(11) NOT NULL,
  `DepartID` int(11) NOT NULL,
  `ArriveID` int(11) NOT NULL,
  `DateTimeDepart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DateTimeArrive` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Price` decimal(10,2) NOT NULL,
  `Description` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`ID`, `BusID`, `DepartID`, `ArriveID`, `DateTimeDepart`, `DateTimeArrive`, `Price`, `Description`) VALUES
(1, 1, 1, 2, '2016-10-06 23:01:35', '2016-10-06 16:25:00', '50.00', 'Long trip'),
(2, 2, 1, 3, '2016-10-06 23:01:46', '2016-10-11 14:40:00', '25.00', 'Short trip'),
(3, 3, 1, 7, '2016-10-06 23:01:58', '2016-10-06 19:00:00', '100.00', 'Turistic trip'),
(4, 3, 1, 7, '2016-10-20 16:01:58', '2016-10-20 23:00:00', '100.00', 'Turistic trip'),
(5, 3, 1, 7, '2016-10-24 11:01:58', '2016-10-24 17:00:00', '100.00', 'Turistic trip'),
(6, 1, 1, 7, '2016-10-15 23:01:35', '2016-10-16 08:25:00', '50.00', 'Long trip'),
(7, 4, 1, 8, '2016-10-24 11:01:58', '2016-10-24 17:00:00', '100.00', 'Turistic trip'),
(8, 6, 1, 8, '2016-10-15 23:01:35', '2016-10-16 08:25:00', '50.00', 'Long trip'),
(9, 11, 1, 2, '2016-10-24 11:01:58', '2016-10-24 17:00:00', '100.00', 'Turistic trip'),
(10, 10, 1, 3, '2016-10-15 23:01:35', '2016-10-16 08:25:00', '50.00', 'Long trip'),
(11, 9, 1, 6, '2016-10-15 23:01:35', '2016-10-16 08:25:00', '50.00', 'Long trip'),
(12, 8, 1, 5, '2016-10-24 11:01:58', '2016-10-24 17:00:00', '100.00', 'Turistic trip'),
(13, 5, 1, 4, '2016-10-15 23:01:35', '2016-10-16 08:25:00', '50.00', 'Long trip'),
(14, 5, 1, 3, '2016-10-06 23:01:46', '2016-10-11 14:40:00', '25.00', 'Short trip'),
(15, 9, 1, 3, '2016-10-18 23:01:46', '2016-10-19 14:40:00', '25.00', 'Short trip'),
(16, 8, 1, 4, '2016-10-20 23:01:35', '2016-10-21 08:25:00', '50.00', 'Long trip'),
(17, 4, 1, 2, '2016-10-26 11:01:58', '2016-10-26 17:00:00', '100.00', 'Turistic trip'),
(18, 3, 1, 6, '2016-10-28 23:01:35', '2016-10-29 08:25:00', '50.00', 'Long trip'),
(19, 2, 1, 5, '2016-10-26 11:01:58', '2016-10-26 17:00:00', '100.00', 'Turistic trip'),
(20, 11, 1, 5, '2016-10-21 11:01:58', '2016-10-21 17:00:00', '100.00', 'Turistic trip');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BusID` (`BusID`),
  ADD KEY `DepartID` (`DepartID`),
  ADD KEY `ArriveID` (`ArriveID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
