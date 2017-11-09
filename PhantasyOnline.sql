-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2017 at 03:06 PM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `PhantasyOnline`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `accountUN` varchar(15) NOT NULL,
  `accountPW` varchar(100) NOT NULL,
  `accountEM` varchar(30) NOT NULL,
  `accountTY` int(11) NOT NULL DEFAULT '1',
  `accountSE` varchar(30) NOT NULL,
  `accountRD` date NOT NULL,
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `accountUN`, `accountPW`, `accountEM`, `accountTY`, `accountSE`, `accountRD`) VALUES
(15, 'Kahnaii', '$2y$10$q6Z1PlZgYR414L3TJtC7YuOyQ03D0ixqc11fQurGnLUESdMpXriNK', 'jenndaniel94@gmail.com', 1, 'itme', '2017-10-23'),
(16, 'KahnaiiAdmin', '$2y$10$hZbfiz66kqoGZkjawyQ5UeqOT7NCjLw8bToXv7c2OqrzVec332KuW', 'moonhawk94@gmail.com', 69, 'yes', '2017-10-23'),
(17, 'McNett', '$2y$10$L5pL4fe7YzYC3tf74z87deRRbU2b0jVMuB5qpopZzN.OhKRwZiO1y', 'sample@email.com', 1, 'sample', '2017-11-01'),
(18, 'McNettAdmin', '$2y$10$Vq18FXRr2Bj5O7EVBcH04urMqHwwYFzj1ye1opRFu0KZJYHOx97/W', 'sampleadmin@email.com', 69, 'sampleAdmin', '2017-11-01'),
(19, 'billytest', '$2y$10$gFFuAv8sIQt3iiWDxLvo9OMrm6IEECMVjQvDbEDKqbu.vVlXUg.t2', 'billytest@test.com', 1, 'test', '2017-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `clientOrders`
--

CREATE TABLE IF NOT EXISTS `clientOrders` (
  `clientID` int(11) NOT NULL AUTO_INCREMENT,
  `clientNM` varchar(35) NOT NULL,
  `clientEX` int(11) NOT NULL,
  `clientMS` int(11) NOT NULL,
  `npcID` int(11) NOT NULL,
  `clientDS` varchar(60) NOT NULL,
  PRIMARY KEY (`clientID`),
  KEY `npcID` (`npcID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `clientOrders`
--

INSERT INTO `clientOrders` (`clientID`, `clientNM`, `clientEX`, `clientMS`, `npcID`, `clientDS`) VALUES
(1, 'Thunderstorm Survey', 500, 200, 2, 'Experience a thunderstorm.'),
(2, 'Thick Fog Survey', 2000, 300, 2, ''),
(3, 'Heat Wave Survey', 2000, 300, 2, ''),
(4, 'Fireflies Survey', 3000, 300, 2, ''),
(5, 'Magnetic Storm Survey', 3000, 400, 2, ''),
(6, 'Meteor Shower Survey', 6000, 500, 2, ''),
(7, 'Supplying Oodan Meat', 1900, 200, 3, ''),
(8, 'Supplying Aginis Meat', 1900, 200, 3, ''),
(9, 'Danger Zone Study', 15000, 1300, 1, ''),
(10, 'Training Exam', 30000, 1500, 1, ''),
(11, 'Extreme Training Follow-Up', 15000, 1700, 1, ''),
(12, 'Supplying Mystery Fruits', 2000, 200, 3, ''),
(13, 'Supplying Aginis Breast Meat', 2000, 200, 3, ''),
(14, 'Supplying Hard Nuts', 2200, 200, 3, ''),
(15, 'Supplying Rockbear Meat', 5000, 500, 3, ''),
(16, 'Supplying RB Arm Meat & Fruits', 10000, 1000, 3, ''),
(17, 'Rare Rock Species', 20000, 5000, 4, ''),
(18, 'The Blood-Red Dagan Nero', 20000, 5000, 4, ''),
(19, 'Rare Rappy Species', 10000, 1000, 4, ''),
(20, 'Rare Gigantic Darker', 20000, 5000, 4, ''),
(21, 'Pair Running Through the Forest', 20000, 5000, 4, ''),
(22, 'Nyau That''s a Rare Species!', 15000, 1000, 4, '');

--
-- Triggers `clientOrders`
--
DROP TRIGGER IF EXISTS `delete_prevent_clientorders`;
DELIMITER //
CREATE TRIGGER `delete_prevent_clientorders` BEFORE DELETE ON `clientOrders`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `npcs`
--

CREATE TABLE IF NOT EXISTS `npcs` (
  `npcID` int(11) NOT NULL AUTO_INCREMENT,
  `npcNM` varchar(15) NOT NULL,
  PRIMARY KEY (`npcID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `npcs`
--

INSERT INTO `npcs` (`npcID`, `npcNM`) VALUES
(1, 'Alis'),
(2, 'Amelin'),
(3, 'Franka'),
(4, 'Girard'),
(5, 'Hans'),
(6, 'Io'),
(7, 'Klotho'),
(8, 'Kressida'),
(9, 'Kuro'),
(10, 'Lottie'),
(11, 'Lubert'),
(12, 'Nagisa'),
(13, 'Revelle'),
(14, 'Seraphy'),
(15, 'Toro'),
(16, 'Xie'),
(17, 'Zieg');

--
-- Triggers `npcs`
--
DROP TRIGGER IF EXISTS `delete_prevent_npcs`;
DELIMITER //
CREATE TRIGGER `delete_prevent_npcs` BEFORE DELETE ON `npcs`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `questRuns`
--

CREATE TABLE IF NOT EXISTS `questRuns` (
  `runID` int(11) NOT NULL AUTO_INCREMENT,
  `runEX` int(11) NOT NULL,
  `runMS` int(11) NOT NULL,
  `runDF` varchar(15) NOT NULL,
  `runTM` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `questID` int(11) NOT NULL,
  PRIMARY KEY (`runID`),
  KEY `accountID` (`accountID`,`questID`),
  KEY `questID` (`questID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `questRuns`
--

INSERT INTO `questRuns` (`runID`, `runEX`, `runMS`, `runDF`, `runTM`, `accountID`, `questID`) VALUES
(5, 98, 836, 'Normal', 186, 15, 2),
(6, 168, 1713, 'Normal', 316, 15, 3),
(7, 762, 3663, 'Normal', 583, 15, 4),
(8, 16566, 11233, 'Hard', 1146, 15, 56),
(9, 9587, 7001, 'Hard', 380, 15, 39),
(13, 9870, 9379, 'Super Hard', 583, 15, 4),
(14, 19893, 10453, 'Super Hard', 875, 15, 8),
(15, 13084, 18935, 'Hard', 550, 15, 55),
(16, 20952, 5646, 'Very Hard', 1136, 15, 54),
(17, 1179, 4961, 'Normal', 538, 15, 1),
(18, 619, 1859, 'Normal', 424, 15, 5),
(19, 732, 2212, 'Normal', 403, 15, 7),
(21, 1221, 3607, 'Normal', 485, 15, 8),
(22, 1226, 2600, 'Normal', 521, 15, 8),
(24, 3944, 10334, 'Normal', 597, 15, 6),
(25, 3361, 7172, 'Normal', 458, 15, 11),
(26, 23523, 23515, 'Very Hard', 292, 19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `quests`
--

CREATE TABLE IF NOT EXISTS `quests` (
  `questID` int(11) NOT NULL AUTO_INCREMENT,
  `questNM` varchar(40) NOT NULL,
  `zoneID` int(11) NOT NULL,
  `questDS` varchar(60) NOT NULL,
  PRIMARY KEY (`questID`),
  KEY `zoneID` (`zoneID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `quests`
--

INSERT INTO `quests` (`questID`, `questNM`, `zoneID`, `questDS`) VALUES
(1, 'Forest Exploration', 1, 'Defeat Rockbear.'),
(2, 'Subdue Za Oodan', 1, ''),
(3, 'Subdue Fangulf', 1, ''),
(4, 'Dagan Extermination: Forest', 1, ''),
(5, 'Nab Rappy Capture', 1, ''),
(6, 'Volcanic Cave Exploration', 2, ''),
(7, 'Dragonkin Ecological Survey', 2, ''),
(8, 'Kartargot Extermination', 2, ''),
(9, 'Subdue Caterdra''n', 2, ''),
(10, 'Desert Exploration', 3, ''),
(11, 'Mech Power Survey: Desert', 3, ''),
(12, 'Cargo Recovery: Desert', 3, ''),
(13, 'Rare Ore Mining', 3, ''),
(14, 'Tundra Exploration', 4, ''),
(15, 'Tundra Regional Survey', 4, ''),
(16, 'ARKS Search: Tundra', 4, ''),
(17, 'Subdue De Malmoth', 4, ''),
(18, 'Subterranean Tunnels Exploration', 5, ''),
(19, 'Mech Power Survey: Tunnels', 5, ''),
(20, 'Distress Signal Investigation', 5, ''),
(21, 'Transformer Takedown', 5, ''),
(22, 'Skyscape Exploration', 6, ''),
(23, 'Berserk Dragon Supression', 6, ''),
(24, 'Specimen Collection: Skyscape', 6, ''),
(25, 'Subdue Caterdra''nsa', 6, ''),
(26, 'Ruins Exploration', 7, ''),
(27, 'Ruins Infestation: Survey', 7, ''),
(28, 'Polluter Destruction', 7, ''),
(29, 'Wolgahda Extermination', 7, ''),
(30, 'Sanctum Exploration', 8, ''),
(31, 'Sanctum Supression', 8, ''),
(32, 'Subdue Sol Dirandal', 8, ''),
(33, 'Subdue Goronzoran', 8, ''),
(34, 'Coast Exploration', 9, ''),
(35, 'Coastal Ecological Survey', 9, ''),
(36, 'Coastal Conservation', 9, ''),
(37, 'Subdue Org Blan', 9, ''),
(38, 'Quarry Exploration', 10, ''),
(39, 'Mech Power Survey: Quarry', 10, ''),
(40, 'Lilipan Colony Defense', 10, ''),
(41, 'Mobile Fortress Destruction', 10, ''),
(42, 'Seabed Exploration', 11, ''),
(43, 'Seabed Ecological Survey', 11, ''),
(44, 'Vopar Rescue Team', 11, ''),
(45, 'Subdue Decol Malluda', 11, ''),
(46, 'Shironia Exploration', 12, ''),
(47, 'Kuronite Suppression', 12, ''),
(48, 'Anjhadu-lili Demolution', 12, ''),
(49, 'Facility Exploration', 13, ''),
(50, 'Facility Ecological Survey', 13, ''),
(51, 'Subdue Rheo Madullard', 13, ''),
(52, 'Kuron Exploration', 14, ''),
(53, 'Kuronite Investigation', 14, ''),
(54, 'Codotta Idetta Subjugation', 14, ''),
(55, 'Tokyo Exploration', 15, ''),
(56, 'Las Vegas Exploration', 16, '');

--
-- Triggers `quests`
--
DROP TRIGGER IF EXISTS `delete_prevent_quests`;
DELIMITER //
CREATE TRIGGER `delete_prevent_quests` BEFORE DELETE ON `quests`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `zoneClientOrders`
--

CREATE TABLE IF NOT EXISTS `zoneClientOrders` (
  `zcoID` int(11) NOT NULL AUTO_INCREMENT,
  `zoneID` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  PRIMARY KEY (`zcoID`),
  KEY `zoneID` (`zoneID`,`clientID`),
  KEY `clientID` (`clientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `zoneClientOrders`
--

INSERT INTO `zoneClientOrders` (`zcoID`, `zoneID`, `clientID`) VALUES
(1, 1, 1),
(2, 1, 2),
(7, 1, 7),
(8, 1, 8),
(9, 1, 12),
(10, 1, 13),
(11, 1, 14),
(12, 1, 15),
(13, 1, 16),
(14, 1, 17),
(15, 1, 18),
(16, 1, 19),
(17, 1, 20),
(18, 1, 21),
(19, 1, 22),
(3, 2, 3),
(4, 2, 4),
(20, 2, 18),
(23, 2, 19),
(38, 2, 20),
(53, 2, 22),
(5, 3, 5),
(6, 3, 6),
(21, 3, 18),
(24, 3, 19),
(39, 3, 20),
(54, 3, 22),
(25, 4, 19),
(40, 4, 20),
(55, 4, 22),
(22, 5, 18),
(26, 5, 19),
(41, 5, 20),
(56, 5, 22),
(27, 6, 19),
(42, 6, 20),
(57, 6, 22),
(28, 7, 19),
(43, 7, 20),
(58, 7, 22),
(29, 8, 19),
(44, 8, 20),
(59, 8, 22),
(30, 9, 19),
(45, 9, 20),
(60, 9, 22),
(31, 10, 19),
(46, 10, 20),
(61, 10, 22),
(32, 11, 19),
(47, 11, 20),
(62, 11, 22),
(33, 12, 19),
(48, 12, 20),
(63, 12, 22),
(34, 13, 19),
(49, 13, 20),
(64, 13, 22),
(35, 14, 19),
(50, 14, 20),
(65, 14, 22),
(36, 15, 19),
(51, 15, 20),
(66, 15, 22),
(37, 16, 19),
(52, 16, 20),
(67, 16, 22);

--
-- Triggers `zoneClientOrders`
--
DROP TRIGGER IF EXISTS `delete_prevent_zoneclientorders`;
DELIMITER //
CREATE TRIGGER `delete_prevent_zoneclientorders` BEFORE DELETE ON `zoneClientOrders`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE IF NOT EXISTS `zones` (
  `zoneID` int(11) NOT NULL AUTO_INCREMENT,
  `zoneNM` varchar(15) NOT NULL,
  PRIMARY KEY (`zoneID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`zoneID`, `zoneNM`) VALUES
(1, 'Forest'),
(2, 'Volcanic Cave'),
(3, 'Desert'),
(4, 'Tundra'),
(5, 'Tunnels'),
(6, 'Skyscape'),
(7, 'Ruins'),
(8, 'Sanctum'),
(9, 'Coast'),
(10, 'Quarry'),
(11, 'Seabed'),
(12, 'Shironia'),
(13, 'Facility'),
(14, 'Kuron'),
(15, 'Tokyo'),
(16, 'Las Vegas');

--
-- Triggers `zones`
--
DROP TRIGGER IF EXISTS `delete_prevent_zones`;
DELIMITER //
CREATE TRIGGER `delete_prevent_zones` BEFORE DELETE ON `zones`
 FOR EACH ROW call do_not_delete()
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clientOrders`
--
ALTER TABLE `clientOrders`
  ADD CONSTRAINT `clientOrders_ibfk_1` FOREIGN KEY (`npcID`) REFERENCES `npcs` (`npcID`);

--
-- Constraints for table `questRuns`
--
ALTER TABLE `questRuns`
  ADD CONSTRAINT `questRuns_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`),
  ADD CONSTRAINT `questRuns_ibfk_2` FOREIGN KEY (`questID`) REFERENCES `quests` (`questID`);

--
-- Constraints for table `quests`
--
ALTER TABLE `quests`
  ADD CONSTRAINT `quests_ibfk_1` FOREIGN KEY (`zoneID`) REFERENCES `zones` (`zoneID`);

--
-- Constraints for table `zoneClientOrders`
--
ALTER TABLE `zoneClientOrders`
  ADD CONSTRAINT `zoneClientOrders_ibfk_1` FOREIGN KEY (`zoneID`) REFERENCES `zones` (`zoneID`),
  ADD CONSTRAINT `zoneClientOrders_ibfk_2` FOREIGN KEY (`clientID`) REFERENCES `clientOrders` (`clientID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
