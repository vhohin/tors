-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2016 at 08:28 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FBID` varchar(100) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `address` varchar(50) NOT NULL DEFAULT '""',
  `city` varchar(50) NOT NULL DEFAULT '""',
  `country` varchar(50) NOT NULL DEFAULT '""',
  `postalCode` varchar(10) NOT NULL DEFAULT '""',
  `phone` varchar(20) DEFAULT '""'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FBID`, `firstName`, `lastName`, `userName`, `email`, `password`, `address`, `city`, `country`, `postalCode`, `phone`) VALUES
(1, NULL, 'Valeriy', 'Hohin', 'vhohin', 'vhohin@gmail.com', '123', '3635 rue de Verdun', 'Verdun', 'Canada', 'H4G1K5', '5147320726'),
(2, NULL, 'Bin', 'Bon', 'binbon', 'binbon@hotmail.com', 'Bb123456', '555 Fish street', 'Montreal', 'Canada', 'H5T1D7', '5143222233'),
(3, NULL, 'Nazar', 'Holyanskyy', 'nholyanskyy', 'golyanskiy@gmail.com', '$2y$10$yxUKMT8QptL7UK/PyWKVw.jF7f2xxel0W1OTka4J54z2uIVyoNU9W', '', '', '', '', ''),
(4, NULL, 'fghfghgh', 'fdjdfjj', 'fdjjjj', 'aaa@gmail.com', '$2y$10$ZxjJ9PSrYgsk2kYQp1KMCe1GxQ0QbivsvUBYbqwusaQxFCOKCHFpy', '""', '""', '""', '""', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `FBID` (`FBID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
