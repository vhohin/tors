-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2016 at 08:58 PM
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
  `Description` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`ID`, `BusID`, `DepartID`, `ArriveID`, `DateTimeDepart`, `DateTimeArrive`, `Description`) VALUES
(1, 1, 1, 2, '2016-10-06 13:48:18', '2016-10-06 16:25:00', 'Long trip'),
(2, 2, 1, 3, '2016-10-06 13:48:33', '2016-10-11 14:40:00', 'Short trip');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
