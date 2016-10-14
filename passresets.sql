-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2016 at 07:45 AM
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
-- Table structure for table `passresets`
--

CREATE TABLE `passresets` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `secretToken` varchar(50) NOT NULL,
  `expiryDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passresets`
--

INSERT INTO `passresets` (`ID`, `userID`, `secretToken`, `expiryDateTime`) VALUES
(1, 3, 'Dgah6Wz7WzvDl0Ws3AlEgaGOI4q2C9xWGLuA8JgBHqi2BEAwxM', '2016-10-14 11:22:52'),
(2, 3, 'CGGXhLLQtxqw9AnmN2QbosxlnWGFJ50xWZIKXexGfVFaNFRy3w', '2016-10-14 12:08:52'),
(3, 3, 'o0UqysPaNmUhHqwflTu0lsa3NlplhhxmTtp3eFmTn3fSXlor1N', '2016-10-14 12:13:17'),
(4, 3, 'JEitUB9Diu7cBEGh2UOslDXOIF7YTlJ04wNwZwKBRcAQoTKkPs', '2016-10-14 12:13:32'),
(5, 3, 'Fyc5oIztqRID6uLPgxgKgvlBWkA9Ev5zdZqBZfItOgyS2u02vU', '2016-10-14 12:14:14'),
(6, 3, 'GHyYG21FBOhrwe8i2ZXFflAxKYmnC879twdkomuSZmhgkLrt1g', '2016-10-14 12:14:23'),
(7, 3, 'jX95JGjX28C66gEdfyuxjXKMEXva7wnp17qIfHgP6LZWsfbNEE', '2016-10-14 12:14:58'),
(8, 3, 'eGRevYI4wN7iKfiK9WWNeWihUQ4wHLtoxhfdUuAPMZeBCSnmoJ', '2016-10-14 12:15:07'),
(9, 3, 'LszEBJ7eCwwz0GIgvycolYWzdinSllwTtuNJNzdZ2UdLpmMCEh', '2016-10-14 12:17:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `passresets`
--
ALTER TABLE `passresets`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `passresets`
--
ALTER TABLE `passresets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `passresets`
--
ALTER TABLE `passresets`
  ADD CONSTRAINT `passresets_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
