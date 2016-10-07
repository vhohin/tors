-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2016 at 06:40 AM
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
(4, 1, '2b', '70.00', 'available', 'economy'),
(5, 1, '3a', '50.00', 'available', 'economy'),
(6, 1, '3b', '50.00', 'available', 'economy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BusID` (`BusID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
