-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 13, 2019 at 10:07 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelbuddydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `agentID` int(5) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `emailAddress` varchar(128) NOT NULL,
  PRIMARY KEY (`agentID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agentID`, `firstName`, `lastName`, `phoneNumber`, `emailAddress`) VALUES
(1, 'Phillip', 'Fry', '021 576 5787', 'pfry@gmail.com'),
(2, 'Morgan', 'Freeman', '021 343 6975', 'mfreeman@gmail.com'),
(3, 'Jack', 'Nicholson', '021 730 8439', 'jnicholson@gmail.com'),
(4, 'Jim', 'Jefferies', '021 353 4296', 'jjefferies@gmail.com'),
(5, 'Bill', 'Burr', '021 043 9528', 'bburr@gmail.com'),
(6, 'Ricky', 'Gervais', '021 945 0125', 'rgervais@gmail.com'),
(7, 'Trevor', 'Noah', '021 853 1204', 'tnoah@gmail.com'),
(8, 'Mila', 'Kunis', '021 792 2543', 'mkunis@gmail.com'),
(9, 'Stacy', 'Chetty', '021 782 9042', 'schetty@gmail.com'),
(10, 'Dean', 'Bowerman', '021 894 4782', 'dbowerman@gmail.com'),
(11, 'Paul', 'Roux', '021 943 7829', 'proux@gmail.com'),
(12, 'Danny', 'DeVito', '021 467 2294', 'ddevito@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `saleID` int(5) NOT NULL AUTO_INCREMENT,
  `bookingDate` date NOT NULL,
  `saleAmount` double NOT NULL,
  `propertyID` int(5) NOT NULL,
  `buyerID` int(5) NOT NULL,
  `sellerID` int(5) NOT NULL,
  `agentID` int(5) NOT NULL,
  PRIMARY KEY (`saleID`),
  KEY `propertyID` (`propertyID`),
  KEY `agentID` (`agentID`),
  KEY `buyerID` (`buyerID`),
  KEY `sellerID` (`sellerID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`saleID`, `bookingDate`, `saleAmount`, `propertyID`, `buyerID`, `sellerID`, `agentID`) VALUES
(13, '2018-06-14', 1000000, 3, 3, 3, 3),
(14, '2018-08-29', 1700000, 16, 12, 4, 3),
(15, '2018-09-21', 2500000, 13, 13, 4, 4),
(16, '2018-07-21', 2000000, 8, 14, 6, 6),
(17, '2018-08-11', 2600000, 15, 15, 3, 8),
(18, '2018-07-17', 1900000, 17, 16, 6, 3),
(20, '2018-10-04', 1300000, 11, 17, 6, 8),
(21, '2019-08-13', 1800000, 4, 18, 2, 2),
(22, '2019-08-14', 1800000, 4, 19, 2, 2),
(23, '2019-08-15', 1800000, 4, 19, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

DROP TABLE IF EXISTS `buyer`;
CREATE TABLE IF NOT EXISTS `buyer` (
  `buyerID` int(5) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `emailAddress` varchar(128) NOT NULL,
  PRIMARY KEY (`buyerID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`buyerID`, `firstName`, `lastName`, `phoneNumber`, `emailAddress`) VALUES
(3, 'Martin', 'Sheen', '021 394 4783', 'msheen@gmail.com'),
(4, 'Bruce', 'Banner', '021 782 9982', 'bbanner@gmail.com'),
(5, 'Enrico', 'Rizzo', '021 406 2063', 'erizzo@gmail.com'),
(6, 'Marlin', 'Brando', '021 184 0032', 'mbrando@gmail.com'),
(7, 'Kurt', 'Cobain', '021 935 0248', 'kcobain@gmail.com'),
(8, 'Jimmy', 'Hendrix', '021 539 9245', 'jhendrix@gmail.com'),
(9, 'Layne', 'Staley', '021 935 225', 'lstaley@gmail.com'),
(10, 'Mike', 'Myers', '021 332 742', 'mmyers@gmail.com'),
(11, 'Elton', 'John', '021 305 0235', 'ejohn@gmail.com'),
(12, 'Tim', 'Allen', '021 483 0256', 'tallen@gmail.com'),
(13, 'George', 'Bush', '021 942 4782', 'gbush@gmail.com'),
(14, 'Michael', 'Corleone', '021 394 4783', 'mcorleone@gmail.com'),
(15, 'Ben', 'Affleck', '021 937 6742', 'baffleck@gmail.com'),
(16, 'Jerry', 'Seinfeld', '021 383 0566', 'jseinfeld@gmail.com'),
(17, 'John', 'Voigt', '021 294 4486', 'jvoigt@gmail.com'),
(18, 'Jim', 'Morrison', '021 394 4781', 'jmorrison@gmail.com'),
(19, 'John', 'Longman', '021 394 4711', 'jlongman@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `officeuser`
--

DROP TABLE IF EXISTS `officeuser`;
CREATE TABLE IF NOT EXISTS `officeuser` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `emailAddress` varchar(128) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `emailAddress` (`emailAddress`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officeuser`
--

INSERT INTO `officeuser` (`userID`, `firstName`, `lastName`, `emailAddress`, `password`) VALUES
(4, 'Jack', 'Forde', 'jackforde@gmail.com', '1a1dc91c907325c69271ddf0c944bc72');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `propertyID` int(5) NOT NULL AUTO_INCREMENT,
  `city` varchar(50) NOT NULL,
  `suburb` varchar(50) NOT NULL,
  `streetAddress` varchar(128) NOT NULL,
  `pool` varchar(3) NOT NULL DEFAULT 'No',
  `bedrooms` int(11) NOT NULL,
  `askingPrice` double NOT NULL,
  `dateOnMarket` date NOT NULL,
  `sellerID` int(5) NOT NULL,
  `sellerAgentID` int(5) NOT NULL,
  `buyerAgentID` int(5) DEFAULT NULL,
  PRIMARY KEY (`propertyID`),
  KEY `sellerAgentID` (`sellerAgentID`),
  KEY `sellerID` (`sellerID`),
  KEY `buyerAgentID` (`buyerAgentID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`propertyID`, `city`, `suburb`, `streetAddress`, `pool`, `bedrooms`, `askingPrice`, `dateOnMarket`, `sellerID`, `sellerAgentID`, `buyerAgentID`) VALUES
(1, 'Cape Town', 'Retreat', '13 2nd Avenue', 'No', 3, 1300000, '2018-05-12', 1, 1, NULL),
(2, 'Port Elizabeth', 'Algoa Bay', '67 Bayside Road', 'Yes', 5, 2000000, '2018-05-13', 2, 2, NULL),
(3, 'Cape Town', 'Observatory', '43 Main Road', 'No', 2, 1000000, '2018-05-13', 3, 3, NULL),
(4, 'Cape Town', 'Parklands', '87 Blaire Street', 'No', 5, 1800000, '2018-05-21', 2, 2, NULL),
(5, 'Durban', 'Westville', '49 West Street', 'Yes', 2, 2500000, '2018-05-21', 7, 4, NULL),
(6, 'Johannesburg', 'Randburg', '50 Fort Street', 'No', 1, 1300000, '2018-05-21', 8, 9, NULL),
(7, 'Pretoria', 'Lynnwood', '69 Castle Lane', 'No', 3, 1800000, '2018-05-21', 9, 10, NULL),
(8, 'Bloemfontein', 'Bayswater', '89 Perlman Road', 'Yes', 4, 2000000, '2018-05-21', 6, 6, 11),
(9, 'Bloemfontein', 'Westdene', '22 Parton Street', 'Yes', 6, 3000000, '2018-05-21', 2, 11, NULL),
(10, 'Johannesburg', 'Melville', '84 Kirsten Road', 'Yes', 2, 1500000, '2018-05-21', 10, 7, NULL),
(11, 'Johannesburg', 'Rosebank', '35 London Street', 'No', 2, 1300000, '2018-05-21', 6, 8, 5),
(12, 'Durban', 'Glenwood', '63 Poole Street', 'No', 2, 1600000, '2018-05-21', 11, 4, NULL),
(13, 'Durban', 'Kloof', '43 Searle Road', 'Yes', 3, 2500000, '2018-05-21', 4, 4, 7),
(14, 'Pretoria', 'Menlo Park', '45 Kent Street', 'No', 2, 1300000, '2018-05-21', 7, 8, NULL),
(15, 'Pretoria', 'Faerie Glen', '84 Orwell Road', 'Yes', 6, 2600000, '2018-05-21', 3, 8, 12),
(16, 'Bloemfontein', 'Heuwelsig', '66 Kruger Street', 'No', 3, 1700000, '2018-05-21', 4, 3, 11),
(17, 'Bloemfontein', 'Fleurdal', '63 Soprano Lane', 'No', 4, 1900000, '2018-05-21', 6, 3, 12),
(18, 'Pretoria', 'Hatfield', '55 Gale Street', 'No', 3, 1600000, '2018-05-21', 10, 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `sellerID` int(5) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(128) NOT NULL,
  `lastName` varchar(128) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `emailAddress` varchar(128) NOT NULL,
  PRIMARY KEY (`sellerID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sellerID`, `firstName`, `lastName`, `phoneNumber`, `emailAddress`) VALUES
(1, 'Robert', 'Durst', '021 711 6553', 'rdurst@gmail.com'),
(2, 'Darren', 'Stone', '021 43 4695', 'dstone@gmail.com'),
(3, 'Roberto', 'Mancini', '021 947 3438', 'rmancini@gmail.com'),
(4, 'David', 'Spade', '021 938 4374', 'dspade@gmail.com'),
(5, 'Robert', 'DeNiro', '021 483 4845', 'rdeniro@gmail.com'),
(6, 'Joe', 'Pesci', '021 803 0242', 'jpesci@gmail.com'),
(7, 'Jurgen', 'Klopp', '021 545 270', 'jklopp@gmail.com'),
(8, 'Al', 'Pacino', '021 945 8224', 'apacino@gmail.com'),
(9, 'Peter', 'Parker', '021 354 557', 'pparker@gmail.com'),
(10, 'Bruce', 'Wayne', '021 539 2073', 'bwayne@gmail.com'),
(11, 'Trent', 'Reznor', '021 820 5623', 'treznor@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`propertyID`) REFERENCES `property` (`propertyID`),
  ADD CONSTRAINT `booking_ibfk_6` FOREIGN KEY (`agentID`) REFERENCES `agent` (`agentID`),
  ADD CONSTRAINT `booking_ibfk_7` FOREIGN KEY (`buyerID`) REFERENCES `buyer` (`buyerID`),
  ADD CONSTRAINT `booking_ibfk_8` FOREIGN KEY (`sellerID`) REFERENCES `seller` (`sellerID`);

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`buyerAgentID`) REFERENCES `agent` (`agentID`),
  ADD CONSTRAINT `property_ibfk_2` FOREIGN KEY (`sellerAgentID`) REFERENCES `agent` (`agentID`),
  ADD CONSTRAINT `property_ibfk_3` FOREIGN KEY (`sellerID`) REFERENCES `seller` (`sellerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
