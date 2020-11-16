-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 16, 2020 at 05:26 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `420505ri_gr06`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `author` varchar(202) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `available` tinyint(1) NOT NULL,
  `price` double NOT NULL,
  `owner` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `category`, `description`, `available`, `price`, `owner`) VALUES
('FabBMull120', 'FableHaven Tome 1 Le Sanctuaire Secret', 'Brandon Mull', 'Fantastique, aventure', 'Depuis des siècles, le créatures fantastiques les plus extraordinaires se cachent dans un refuge secret, à l\'abri du monde monderne.\r\nCe sanctuaire s\'appelle Fablehaven.\r\nKendra et Seth ignorent tout de ce lieu magique, dont leur grand-père est pourtant le gardien.\r\nUn jour, ils découvrent l\'incroyable vérité : la forêt qui les entoure est peuplée d\'êtres fabuleux - fées, géants, sorcières, montres, ogres, satyres, naïades...\r\nAujourd\'hui, l\'avenir de Fablehaven est menacé par l\'avènement de puissances maléfiques. Ainsi commence le combat des deux enfants contre le mal, pour protéger Fablehaven de la destruction, sauver leur famille... et rester en vie.', 1, 23.99, 1),
('FabBMull553', 'FableHaven Tome 2 Rise of the Evening Star', 'Brandon Mull', 'Fantastique, aventure', 'patato', 1, 26.99, 1),
('FabBMull664', 'FableHaven Tome 3', 'Brandon Mull', 'Fantaisie, Fiction', 'des créatures fantastiques partout', 1, 24.99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

DROP TABLE IF EXISTS `rentals`;
CREATE TABLE IF NOT EXISTS `rentals` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `bookID` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userID` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `phone`, `password`) VALUES
(1, 'Daniel', 'Navarro', 'theendercraftgaming@gmail.com', '(819) 944-9576', 'Secret1234');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
