-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Oct 26, 2020 at 08:11 PM
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
-- Database: `booksales`
--

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `initcap`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `initcap` (`x` VARCHAR(100)) RETURNS VARCHAR(100) CHARSET utf8 BEGIN
SET @str='';
SET @l_str='';
WHILE x REGEXP ' ' DO
SELECT SUBSTRING_INDEX(x, ' ', 1) INTO @l_str;
SELECT SUBSTRING(x, LOCATE(' ', x)+1) INTO x;
SELECT CONCAT(@str, ' ', CONCAT(UPPER(SUBSTRING(@l_str,1,1)),LOWER(SUBSTRING(@l_str,2)))) INTO @str;
END WHILE;
RETURN LTRIM(CONCAT(@str, ' ', CONCAT(UPPER(SUBSTRING(x,1,1)),LOWER(SUBSTRING(x,2)))));
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` varchar(200) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(202) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `available` tinyint(1) NOT NULL,
  `price` double NOT NULL,
  `owner` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`)
)DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `category`, `description`, `available`, `price`, `owner`) VALUES
('FabBMull120', 'FableHaven Tome 1 Le Sanctuaire Secret', 'Brandon Mull', 'Fantastique, aventure', 'Depuis des siècles, le créatures fantastiques les plus extraordinaires se cachent dans un refuge secret, à l\'abri du monde monderne.\r\nCe sanctuaire s\'appelle Fablehaven.\r\nKendra et Seth ignorent tout de ce lieu magique, dont leur grand-père est pourtant le gardien.\r\nUn jour, ils découvrent l\'incroyable vérité : la forêt qui les entoure est peuplée d\'êtres fabuleux - fées, géants, sorcières, montres, ogres, satyres, naïades...\r\nAujourd\'hui, l\'avenir de Fablehaven est menacé par l\'avènement de puissances maléfiques. Ainsi commence le combat des deux enfants contre le mal, pour protéger Fablehaven de la destruction, sauver leur famille... et rester en vie.', 1, 23.99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `phone`, `password`) VALUES
(1, 'Daniel', 'Navarro', 'theendercraftgaming@gmail.com', '(819) 944-9576', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
