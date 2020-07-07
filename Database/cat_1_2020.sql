-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 06, 2020 at 04:03 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staff`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_1_2020`
--

DROP TABLE IF EXISTS `cat_1_2020`;
CREATE TABLE IF NOT EXISTS `cat_1_2020` (
  `rollno` varchar(9) NOT NULL,
  `Q1` float DEFAULT NULL,
  `Q2` float DEFAULT NULL,
  `Q3` float DEFAULT NULL,
  `Q4` float DEFAULT NULL,
  `Q5` float DEFAULT NULL,
  `Q6` float DEFAULT NULL,
  `Q7` float DEFAULT NULL,
  `Q8` float DEFAULT NULL,
  `Q9` float DEFAULT NULL,
  `Q10` float DEFAULT NULL,
  `Q11` float DEFAULT NULL,
  `Q12` float DEFAULT NULL,
  `Q13` float DEFAULT NULL,
  `Q14` float DEFAULT NULL,
  `Total` float DEFAULT NULL,
  PRIMARY KEY (`rollno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_1_2020`
--

INSERT INTO `cat_1_2020` (`rollno`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `Q8`, `Q9`, `Q10`, `Q11`, `Q12`, `Q13`, `Q14`, `Total`) VALUES
('Max Mark', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 10, 10, 10, 10, NULL),
('18CSR001', 0, 2, 2, 2, 2, 2, 2, 2, 2, 0, 9, 1.5, 3, 10, 39.5),
('18CSR002', 1, 0, 2, 2, 2, 2, 2, 2, 2, 0, 2, 4, 1, 10, 32),
('18CSR003', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 8, 10, 10, 10, 58),
('18CSR004', 2, 2, 1, 2, 0, 2, 1, 2, 1, 2, 5, 7, 8, NULL, 35),
('18CSR005', 2, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 2, 1, 14),
('18CSR006', 2, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 13),
('18CSR007', 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 12),
('18CSR008', 0, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, NULL, 24),
('Exp Mark', 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 8, 9, 8, 7, NULL),
('Co', 1, 1, 1, 1, 2, 2, 2, 3, 3, 3, 1, 2, 2, 3, NULL),
('Up2ExpLvl', 6, 4, 5, 5, 4, 5, 8, 5, 8, 3, 2, 1, 2, 4, NULL),
('Up2ExLvl%', 75, 50, 62.5, 62.5, 50, 62.5, 100, 62.5, 100, 37.5, 25, 12.5, 25, 57.1429, NULL),
('ExpAtt', 50, 100, 50, 100, 50, 100, 50, 100, 50, 100, 80, 90, 80, 70, NULL),
('SatAtt', 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 5, 5, 5, 4, NULL),
('AttLvlCo', 4, 1, 3, 3, 1, 3, 5, 3, 5, 1, 1, 1, 1, 2, NULL),
('range', 50, 60, 69, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Attco', 2.4, 2.2, 2.75, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
