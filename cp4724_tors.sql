-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Окт 16 2016 г., 20:18
-- Версия сервера: 5.6.33
-- Версия PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cp4724_tors`
--

-- --------------------------------------------------------

--
-- Структура таблицы `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PassengerID` int(11) NOT NULL,
  `TripID` int(11) NOT NULL,
  `PaymentInfo` varchar(30) NOT NULL DEFAULT 'paypal',
  `txn_id` varchar(255) NOT NULL DEFAULT '0',
  `payer_id` varchar(255) NOT NULL DEFAULT '0',
  `receiver_id` varchar(255) NOT NULL DEFAULT '0',
  `PaymentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UnitPrice` decimal(10,2) NOT NULL,
  `PaymentTotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `BookedSeats` int(11) NOT NULL,
  `Status` enum('placed','paid','cancelled','shipped','delivered') NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `TripID` (`TripID`),
  KEY `PassengerID` (`PassengerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Дамп данных таблицы `booking`
--

INSERT INTO `booking` (`ID`, `PassengerID`, `TripID`, `PaymentInfo`, `txn_id`, `payer_id`, `receiver_id`, `PaymentDate`, `UnitPrice`, `PaymentTotal`, `BookedSeats`, `Status`) VALUES
(34, 53, 3, 'VISA', '', '', '', '2016-10-06 00:00:00', '0.00', '0.00', 14, 'placed'),
(35, 53, 3, 'VISA', '', '', '', '2016-10-06 00:00:00', '0.00', '0.00', 16, 'placed'),
(36, 55, 2, 'VISA', '', '', '', '2016-10-06 00:00:00', '0.00', '0.00', 58, 'placed'),
(37, 60, 2, 'VISA', '', '', '', '2016-10-06 00:00:00', '0.00', '0.00', 66, 'placed'),
(38, 60, 2, 'VISA', '', '', '', '2016-10-06 00:00:00', '0.00', '0.00', 33, 'placed'),
(39, 60, 2, 'VISA', '', '', '', '2016-10-06 00:00:00', '0.00', '0.00', 37, 'placed'),
(40, 61, 3, 'American express', '', '', '', '0000-00-00 00:00:00', '0.00', '0.00', 99, 'placed'),
(43, 51, 3, 'paypal', '88T19514008521916', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '200.00', 78, 'paid'),
(44, 51, 3, 'paypal', '88T19514008521916', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '200.00', 79, 'paid'),
(45, 51, 3, 'paypal', '6TL84010BF178702J', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '200.00', 76, 'paid'),
(46, 51, 3, 'paypal', '6TL84010BF178702J', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '200.00', 80, 'paid'),
(47, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 77, 'paid'),
(48, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 78, 'paid'),
(49, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 79, 'paid'),
(50, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 80, 'paid'),
(51, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 77, 'paid'),
(52, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 78, 'paid'),
(53, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 79, 'paid'),
(54, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 80, 'paid'),
(55, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 77, 'paid'),
(56, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 78, 'paid'),
(57, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 79, 'paid'),
(58, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 80, 'paid'),
(59, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 77, 'paid'),
(60, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 78, 'paid'),
(61, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 79, 'paid'),
(62, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 80, 'paid'),
(63, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 77, 'paid'),
(64, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 78, 'paid'),
(65, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 79, 'paid'),
(66, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 80, 'paid'),
(67, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 77, 'paid'),
(68, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 78, 'paid'),
(69, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 79, 'paid'),
(70, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 80, 'paid'),
(71, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 77, 'paid'),
(72, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 78, 'paid'),
(73, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 79, 'paid'),
(74, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 80, 'paid'),
(75, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 77, 'paid'),
(76, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 78, 'paid'),
(77, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 79, 'paid'),
(78, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 80, 'paid'),
(79, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 77, 'paid'),
(80, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 78, 'paid'),
(81, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 79, 'paid'),
(82, 51, 1, 'paypal', '0728484031715702K', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '50.00', '200.00', 80, 'paid'),
(117, 51, 17, 'paypal', '10X30896D9448032P', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '300.00', 1, 'paid'),
(118, 51, 17, 'paypal', '10X30896D9448032P', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '300.00', 2, 'paid'),
(119, 51, 17, 'paypal', '10X30896D9448032P', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '300.00', 3, 'paid'),
(120, 51, 17, 'paypal', '2KL35577B2508283H', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '300.00', 1, 'paid'),
(121, 51, 17, 'paypal', '2KL35577B2508283H', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '300.00', 2, 'paid'),
(122, 51, 17, 'paypal', '2KL35577B2508283H', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '300.00', 3, 'paid'),
(123, 51, 17, 'paypal', '7F045607YP976821L', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '400.00', 77, 'paid'),
(124, 51, 17, 'paypal', '7F045607YP976821L', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '400.00', 78, 'paid'),
(125, 51, 17, 'paypal', '7F045607YP976821L', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '400.00', 79, 'paid'),
(126, 51, 17, 'paypal', '7F045607YP976821L', 'WKT9U9HVB3HFG', '5T93XPQ94Y7UU', '0000-00-00 00:00:00', '100.00', '400.00', 80, 'paid');

-- --------------------------------------------------------

--
-- Структура таблицы `bookingtemp`
--

CREATE TABLE IF NOT EXISTS `bookingtemp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PassengerID` int(11) NOT NULL,
  `TripID` int(11) NOT NULL,
  `BookedSeats` varchar(255) NOT NULL,
  `UnitPrice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `bookingtemp`
--

INSERT INTO `bookingtemp` (`ID`, `PassengerID`, `TripID`, `BookedSeats`, `UnitPrice`) VALUES
(21, 51, 17, '77,78,79,80', '100.00'),
(22, 51, 17, '1,2,3', '100.00'),
(23, 51, 17, '1,2,3', '100.00');

-- --------------------------------------------------------

--
-- Структура таблицы `buses`
--

CREATE TABLE IF NOT EXISTS `buses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PlateNo` varchar(10) CHARACTER SET latin1 NOT NULL,
  `MakeModel` varchar(30) CHARACTER SET latin1 NOT NULL,
  `YOP` year(4) NOT NULL,
  `WiFi` tinyint(1) NOT NULL,
  `AirConditioning` tinyint(1) NOT NULL,
  `Toilet` tinyint(1) NOT NULL,
  `PowerOutlets` tinyint(1) NOT NULL,
  `NumberOfSeats` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `buses`
--

INSERT INTO `buses` (`ID`, `PlateNo`, `MakeModel`, `YOP`, `WiFi`, `AirConditioning`, `Toilet`, `PowerOutlets`, `NumberOfSeats`) VALUES
(1, 'TR123G', 'BIGBUS', 2012, 1, 1, 0, 0, 60),
(2, '123GRN', 'SMALLBUSS', 2014, 0, 1, 0, 1, 40),
(3, 'TSR123', 'BIGBIGBUS', 2015, 1, 1, 1, 1, 80),
(4, 'ADG1234', 'BIGBUS', 2013, 1, 1, 1, 0, 60),
(5, 'SD123D', 'SMALLBUSS', 2010, 0, 1, 1, 0, 40),
(6, 'MNB12D', 'BIGBIGBUS', 2011, 1, 1, 1, 0, 80),
(7, 'KUH12DR', 'BIGBIGBUS', 2007, 0, 1, 1, 0, 80),
(8, 'B1234GF', 'SMALLBUSS', 2012, 0, 1, 0, 0, 40),
(9, 'D321HG', 'BIGBUS', 2010, 0, 1, 0, 0, 60),
(10, 'DD12KH', 'BIGBIGBUS', 2010, 1, 1, 1, 1, 80),
(11, 'M321GT', 'BIGBUS', 2010, 1, 1, 1, 0, 60);

-- --------------------------------------------------------

--
-- Структура таблицы `cartitems`
--

CREATE TABLE IF NOT EXISTS `cartitems` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `createdTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userID` int(11) NOT NULL,
  `tripID` int(11) NOT NULL,
  `pricePerSeat` decimal(10,2) NOT NULL,
  `bookedSeats` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `numberOfSeats` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Дамп данных таблицы `cartitems`
--

INSERT INTO `cartitems` (`ID`, `createdTS`, `userID`, `tripID`, `pricePerSeat`, `bookedSeats`, `item_name`, `totalPrice`, `numberOfSeats`, `first_name`, `email`) VALUES
(59, '2016-10-17 00:53:49', 59, 2, '25.00', '54', 'Montreal (Canada) - Boston (USA) trip. Depart at 2016-10-06 16:01:46. Seats: 54', '25.00', 1, 'nholyanskyy', 'golyanskiy@gmail.com'),
(60, '2016-10-17 00:55:52', 59, 14, '25.00', '45,46', 'Montreal (Canada) - Boston (USA) trip. Depart at 2016-10-06 16:01:46. Seats: 45,46', '50.00', 2, 'nholyanskyy', 'golyanskiy@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `citys`
--

CREATE TABLE IF NOT EXISTS `citys` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Country` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `citys`
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

-- --------------------------------------------------------

--
-- Структура таблицы `drivers`
--

CREATE TABLE IF NOT EXISTS `drivers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BusID` int(11) NOT NULL,
  `FirstName` varchar(50) CHARACTER SET latin1 NOT NULL,
  `LastName` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `BusID` (`BusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `drivers`
--

INSERT INTO `drivers` (`ID`, `BusID`, `FirstName`, `LastName`) VALUES
(1, 1, 'John', 'Travolta'),
(2, 2, 'Don', 'Pedro'),
(3, 1, 'Pierre', 'Richar'),
(5, 1, 'Bill', 'Klinton');

-- --------------------------------------------------------

--
-- Структура таблицы `passresets`
--

CREATE TABLE IF NOT EXISTS `passresets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `secretToken` varchar(50) NOT NULL,
  `expiryDateTime` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `userID_3` (`userID`),
  KEY `userID` (`userID`),
  KEY `userID_2` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `txnid` varchar(20) NOT NULL,
  `payment_amount` decimal(7,2) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `itemid` varchar(25) NOT NULL,
  `createdtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `seats`
--

CREATE TABLE IF NOT EXISTS `seats` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BusID` int(11) NOT NULL,
  `Name` varchar(5) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `State` enum('available','booked','reserved','selected') NOT NULL,
  `Class` enum('first','second','third','business','premium','economy') NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `BusID` (`BusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `seats`
--

INSERT INTO `seats` (`ID`, `BusID`, `Name`, `Price`, `State`, `Class`) VALUES
(1, 1, '1a', '50.00', 'available', 'economy'),
(2, 1, '1b', '75.00', 'available', 'economy'),
(3, 1, '2a', '50.00', 'available', 'economy'),
(4, 1, '2b', '70.00', 'available', 'economy');

-- --------------------------------------------------------

--
-- Структура таблицы `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BusID` int(11) NOT NULL,
  `DepartID` int(11) NOT NULL,
  `ArriveID` int(11) NOT NULL,
  `DateTimeDepart` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DateTimeArrive` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Price` decimal(10,2) NOT NULL,
  `Description` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `BusID` (`BusID`),
  KEY `DepartID` (`DepartID`),
  KEY `ArriveID` (`ArriveID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `trips`
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

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fbID` varchar(100) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `address` varchar(50) NOT NULL DEFAULT '""',
  `city` varchar(50) NOT NULL DEFAULT '""',
  `country` varchar(50) NOT NULL DEFAULT '""',
  `postalCode` varchar(10) NOT NULL DEFAULT '""',
  `phone` varchar(20) DEFAULT '""',
  `securityRole` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `FBID` (`fbID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `fbID`, `firstName`, `lastName`, `userName`, `email`, `password`, `address`, `city`, `country`, `postalCode`, `phone`, `securityRole`) VALUES
(51, NULL, '', '', 'valeriy', 'vhohin@gmail.com', '$2y$10$bmNiX735lK7iN263zcr7heF3PWO/lOgOPkWXtB9Ju5qo31FJc8tvm', '""', '""', '""', '""', '', 'user'),
(59, NULL, 'Nazar', 'Holyanskyy', 'nholyanskyy', 'golyanskiy@gmail.com', '$2y$10$/PjsxusKjNfXVwR5CGy3juEiMPD1n8s6ZsatJZwmqLtUYv8Dx1q86', '""', '""', '""', '""', '514-430-0000', 'user'),
(61, '981981151948591', '', '', 'Valeriy Hohin', 'vhohin@gmail.com', '', '""', '""', '""', '""', '""', 'user'),
(62, '1590732577900669', '', '', 'Nazar Holyanskyy', 'golyanskiy@gmail.com', '', '""', '""', '""', '""', '""', 'user');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `passresets`
--
ALTER TABLE `passresets`
  ADD CONSTRAINT `passresets_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Ограничения внешнего ключа таблицы `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_1` FOREIGN KEY (`DepartID`) REFERENCES `citys` (`ID`),
  ADD CONSTRAINT `trips_ibfk_2` FOREIGN KEY (`ArriveID`) REFERENCES `citys` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
