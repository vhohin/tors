-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2016 at 06:23 PM
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
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `ID` int(11) NOT NULL,
  `createdTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` int(11) NOT NULL,
  `tripID` int(11) NOT NULL,
  `pricePerSeat` decimal(10,2) NOT NULL,
  `bookedSeats` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `numberOfSeats` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`ID`, `createdTS`, `userID`, `tripID`, `pricePerSeat`, `bookedSeats`, `item_name`, `totalPrice`, `numberOfSeats`, `first_name`, `email`) VALUES
(57, '2016-10-16 16:21:24', 3, 16, '50.00', '77,78,79', 'Montreal (Canada) - Quebec (Canada) trip. Depart at 2016-10-20 19:01:35. Seats: 77,78,79', '150.00', 3, 'vhohin', 'vhohin@hotmail.com'),
(58, '2016-10-16 16:22:53', 3, 14, '25.00', '69,70,71,72', 'Montreal (Canada) - Boston (USA) trip. Depart at 2016-10-06 19:01:46. Seats: 69,70,71,72', '100.00', 4, 'vhohin', 'vhohin@hotmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
