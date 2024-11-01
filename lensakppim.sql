-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2024 at 03:29 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lensakppim`
--

-- --------------------------------------------------------

--
-- Table structure for table `alkhawarizmi`
--

DROP TABLE IF EXISTS `alkhawarizmi`;
CREATE TABLE IF NOT EXISTS `alkhawarizmi` (
  `commentid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `comment` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alkhawarizmi`
--

INSERT INTO `alkhawarizmi` (`commentid`, `userid`, `comment`, `date`) VALUES
(1, 14, 'I went here to meet Allysha ! Love you, mi amor ', '2024-04-03 17:53:04'),
(2, 15, 'DUDE, CMONNNN SHES MINE CARLOS !!!', '2024-04-03 17:56:04'),
(3, 14, 'Hi Hi Hi', '2024-05-10 19:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `messageid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`messageid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`messageid`, `userid`, `name`, `email`, `number`, `message`) VALUES
(4, 14, 'Carlos Sainz Jr', 'carlos@gmail.com', 182233452, 'Marianne or husbands if at stronger ye. Considered is as middletons uncommonly. Promotion perfectly ye consisted so. His chatty dining for effect ladies active. Equally journey wishing not several behaved chapter she two sir. Deficient procuring favourite extensive you two.'),
(5, 14, 'Allysha Zull Hizam', 'allyshazullh@gmail.com', 133335600, 'By spite about do of do allow blush. Additions in conveying or collected objection in. Suffer few desire wonder her object hardly nearer. Abroad no chatty others my silent an. Fat way appear denote who wholly narrow gay settle.'),
(6, 27, 'Cha', 'chachos@gmail.com', 1234567890, 'Tekan side bar menu button and tekan contact us'),
(7, 29, 'Allysha', 'allysha@gmail.com', 133335600, 'Hello ! '),
(8, 30, 'George William Russell', 'gr@gmail.com', 173715601, 'Hi ! I hope that we can collaborate sometimes. Hit me up soon ');

-- --------------------------------------------------------

--
-- Table structure for table `heandshe`
--

DROP TABLE IF EXISTS `heandshe`;
CREATE TABLE IF NOT EXISTS `heandshe` (
  `commentid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `comment` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `heandshe`
--

INSERT INTO `heandshe` (`commentid`, `userid`, `comment`, `date`) VALUES
(1, 14, 'The coffee here is so gooood ! I went here with Charles few weeks agooo', '2024-04-03 17:54:44'),
(2, 15, 'Did you forget I was there too CAHLOSSS ?!', '2024-04-03 17:56:44'),
(4, 22, 'Wow never knew UiTM had this amazing place!!', '2024-06-19 12:27:13'),
(5, 24, 'I really like their matcha latte here. It&#39;s quite affordable for the students.', '2024-06-24 11:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `lamannajib`
--

DROP TABLE IF EXISTS `lamannajib`;
CREATE TABLE IF NOT EXISTS `lamannajib` (
  `commentid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `comment` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lamannajib`
--

INSERT INTO `lamannajib` (`commentid`, `userid`, `comment`, `date`) VALUES
(1, 14, 'Hi Hello !', '2024-04-03 17:41:39'),
(2, 15, 'EEP', '2024-04-03 17:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `likeid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `landmarkid` int NOT NULL,
  PRIMARY KEY (`likeid`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeid`, `userid`, `landmarkid`) VALUES
(14, 14, 2),
(20, 14, 3),
(17, 14, 4),
(18, 14, 5),
(21, 22, 5),
(24, 29, 5),
(25, 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `narcgarden`
--

DROP TABLE IF EXISTS `narcgarden`;
CREATE TABLE IF NOT EXISTS `narcgarden` (
  `commentid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `comment` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `narcgarden`
--

INSERT INTO `narcgarden` (`commentid`, `userid`, `comment`, `date`) VALUES
(1, 14, 'Hi, My name is Carlos Sainz and I drove for Scuderia Ferrari alongside my teammate Charles Leclerc', '2024-04-03 17:44:48'),
(3, 15, 'Hi, I am George Russell from Mercedes AMG F1 ! and I wanna be world champion like Lewis !', '2024-04-03 17:45:50'),
(5, 30, 'wow, I&#39;ve never known that such a place exists in our faculty !', '2024-08-02 22:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `studentlounge`
--

DROP TABLE IF EXISTS `studentlounge`;
CREATE TABLE IF NOT EXISTS `studentlounge` (
  `commentid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `comment` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `studentlounge`
--

INSERT INTO `studentlounge` (`commentid`, `userid`, `comment`, `date`) VALUES
(1, 14, 'im CAHLOSSSSSSSSS', '2024-04-03 17:50:23'),
(2, 15, 'they dont allow visitor to park here, sed :(', '2024-04-03 17:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `studentnum` varchar(100) NOT NULL,
  `studentname` varchar(100) NOT NULL,
  `studentemail` varchar(100) NOT NULL,
  `studentpass` varchar(100) NOT NULL,
  `studentimage` varchar(100) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`userid`, `studentnum`, `studentname`, `studentemail`, `studentpass`, `studentimage`) VALUES
(14, '1234567890', 'Carlos Sainz Jr', 'carlos@gmail.com', 'ab5e2bca84933118bbc9d48ffaccce3bac4eeb64', 'carlos_sainz_jr_1714720150.jpg'),
(29, '2022800668', 'Allysha Zull Hizam', 'allysha@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'allysha_1720930955.png'),
(27, '2019265474', 'Chachos', 'chachos@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'cha_1720688139.jpg'),
(25, '2022030101', 'Nurul Asyikin', 'asikin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'nurul_asyikin_1719652025.jpg'),
(24, '2023002002', 'Ayrin', 'ayrin.zull@gmail.com', 'cc9f816a42431cf852cdc7a3fad42a6f65ffce24', 'ayrin_1719200073.jpg'),
(23, '2020182259', 'Muhammad Zulhizzat Ashraf ', 'muhammadzulhizzat@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'muhammad_zulhizzat_ashraf__1719127423.jpeg'),
(22, '2020834686', 'Batrisyia', 'btrsyariffin@gmail.com', '6c32aacda2c4ec541978e4819b3a09554d77a726', 'batrisyia_1718771099.jpg'),
(30, '2222222222', 'GR 63', 'gr@gmail.com', '9fd8de5fc2a7c2c0d469b2fff1afde4e5def37ba', 'george_william_russell_1722609760.jpg'),
(15, '1111111111', 'George Russell', 'george@gmail.com', '9fd8de5fc2a7c2c0d469b2fff1afde4e5def37ba', 'george_russell_1712132676.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
