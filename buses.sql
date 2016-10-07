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
(2, '123GRN', 'SMALLBUSS', 2014, 0, 1, 0, 1),
(3, 'TSR123', 'BIGBIGBUS', 2015, 1, 1, 1, 1),
(4, 'ADG1234', 'BIGBUS', 2013, 1, 1, 1, 0),
(5, 'SD123D', 'SMALLBUSS', 2010, 0, 1, 1, 0),
(6, 'MNB12D', 'BIGBIGBUS', 2011, 1, 1, 1, 0),
(7, 'KUH12DR', 'BIGBIGBUS', 2007, 0, 1, 1, 0),
(8, 'B1234GF', 'SMALLBUSS', 2012, 0, 1, 0, 0),
(9, 'D321HG', 'BIGBUS', 2010, 0, 1, 0, 0),
(10, 'DD12KH', 'BIGBIGBUS', 2010, 1, 1, 1, 1),
(11, 'M321GT', 'BIGBUS', 2010, 1, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
