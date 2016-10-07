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
-- Table structure for table `citys`
--

CREATE TABLE `citys` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `citys`
--

INSERT INTO `citys` (`ID`, `name`, `Country`) VALUES
(1, 'Montreal', 'Canada'),
(2, 'Toronto', 'Canada'),
(3, 'Boston', 'USA'),
(4, 'Quebec', 'Canada'),
(5, 'Calgary', 'Canada'),
(6, 'Edmonton', 'Canada'),
(7, 'New York', 'USA'),
(8, 'Platsburg', 'USA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citys`
--
ALTER TABLE `citys`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citys`
--
ALTER TABLE `citys`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
