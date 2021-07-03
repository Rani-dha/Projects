-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2021 at 12:16 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(100) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `email_id` varchar(1000) NOT NULL,
  `balance` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `email_id`, `balance`) VALUES
(1, 'Dennis Ritchie', 'dennis.c@gmail.com', 35000),
(2, 'Linus Torvalds', 'linus.os@gmail.com', 60000),
(3, 'Bjarne Stroustrup', 'bjarne.cplusplus@gmail.com', 45000),
(4, 'Tim Berners-Lee', 'Tim.www@gmail.com', 50000),
(5, 'Donald Knuth', 'donald.algo@gmail.com', 50000),
(6, 'Ken Thompson', 'ken.unixos@gmail.com', 45000),
(7, 'Guido van Rossum', 'guido.py@gmail.com', 47000),
(8, 'James Gosling', 'james.java@gmail.com', 200000),
(9, ' Bill Gates', 'billgates.programmer@gmail.com', 45000),
(10, 'Ada Lovelace', 'adalove.maths@gmail.com', 70000),
(11, 'Mark Zuckerberg ', 'mark.facebook@gmail.com', 54000),
(12, 'Daphne Koller', 'daphne.coursera@gmail.com', 53000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
