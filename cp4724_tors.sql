-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2016 at 12:54 AM
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
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `ID` int(11) NOT NULL,
  `PlateNo` varchar(10) CHARACTER SET latin1 NOT NULL,
  `MakeModel` varchar(30) CHARACTER SET latin1 NOT NULL,
  `YOP` year(4) NOT NULL,
  `WiFi` tinyint(1) NOT NULL,
  `AirConditioning` tinyint(1) NOT NULL,
  `Toilet` tinyint(1) NOT NULL,
  `PowerOutlets` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`ID`, `PlateNo`, `MakeModel`, `YOP`, `WiFi`, `AirConditioning`, `Toilet`, `PowerOutlets`) VALUES
(1, 'TR123G', 'BIGBUS', 2012, 1, 1, 0, 0),
(2, '123GRN', 'SMALLBUSS', 2014, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `ID` int(11) NOT NULL,
  `BusID` int(11) NOT NULL,
  `FirstName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `LastName` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`ID`, `BusID`, `FirstName`, `LastName`) VALUES
(1, 1, 'John', 'Travolta'),
(2, 2, 'Don', 'Pedro'),
(3, 1, 'Pierre', 'Richar');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `ID` int(11) NOT NULL,
  `BusID` int(11) NOT NULL,
  `Name` varchar(5) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `State` enum('available','booked','reserved','selected') NOT NULL,
  `Class` enum('first','second','third','business','premium','economy') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`ID`, `BusID`, `Name`, `Price`, `State`, `Class`) VALUES
(1, 1, '1a', '50.00', 'available', 'economy'),
(2, 1, '1b', '75.00', 'available', 'economy'),
(3, 1, '2a', '50.00', 'available', 'economy'),
(4, 1, '2b', '70.00', 'available', 'economy');

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `ID` int(11) NOT NULL,
  `BusID` int(11) NOT NULL,
  `Depart` varchar(50) NOT NULL,
  `Arrive` varchar(50) NOT NULL,
  `DateTimeDepart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DateTimeArrive` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Description` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`ID`, `BusID`, `Depart`, `Arrive`, `DateTimeDepart`, `DateTimeArrive`, `Description`) VALUES
(1, 1, 'Montreal', 'Boston', '2016-10-05 12:15:00', '2016-10-06 16:25:00', 'Long trip'),
(2, 2, 'Montreal', 'Quebec city', '2016-10-11 10:30:00', '2016-10-11 14:40:00', 'Short trip');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BusID` (`BusID`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BusID` (`BusID`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BusID` (`BusID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
