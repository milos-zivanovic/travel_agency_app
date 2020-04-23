-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2020 at 09:42 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rezervacija_putovanja`
--

-- --------------------------------------------------------

--
-- Table structure for table `arrangements`
--

CREATE TABLE `arrangements` (
  `arrangement_id` int(10) NOT NULL,
  `type` enum('Letovanje','Zimovanje','Ture u Evropi','Evropski gradovi','Vikend u Evropi','Daleka putovanja po svetu') NOT NULL,
  `country` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arrangements`
--

INSERT INTO `arrangements` (`arrangement_id`, `type`, `country`, `destination`) VALUES
(1, 'Letovanje', 'Spanija', 'Barselona'),
(2, 'Zimovanje', 'Norve&scaron;ka', 'Oslo'),
(3, 'Daleka putovanja po svetu', 'USA', 'Chicago'),
(4, 'Letovanje', 'Crna Gora', 'Budva');

-- --------------------------------------------------------

--
-- Table structure for table `coefficients`
--

CREATE TABLE `coefficients` (
  `K` int(10) NOT NULL,
  `P` int(10) NOT NULL,
  `S` int(10) NOT NULL,
  `M` int(10) NOT NULL,
  `N` int(10) NOT NULL,
  `H` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` int(10) NOT NULL,
  `person_num` int(10) NOT NULL,
  `remark` varchar(150) NOT NULL,
  `web_site` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `name`, `category`, `person_num`, `remark`, `web_site`) VALUES
(1, 'Hotel u Spaniji', 4, 5, '', ''),
(2, 'asd', 1, 2, 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `travel_id` int(10) NOT NULL,
  `author_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_infos`
--

CREATE TABLE `reservation_infos` (
  `reservation_id` int(10) NOT NULL,
  `passenger_num` int(10) NOT NULL,
  `full_price` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `travels`
--

CREATE TABLE `travels` (
  `travel_id` int(10) NOT NULL,
  `arrangement_id` int(10) NOT NULL,
  `days/nights` int(10) NOT NULL,
  `transport_type` varchar(50) NOT NULL,
  `food_type` enum('Doručak','Polupansion','Pun pansion') NOT NULL,
  `price` int(10) NOT NULL,
  `days_num` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `travels`
--

INSERT INTO `travels` (`travel_id`, `arrangement_id`, `days/nights`, `transport_type`, `food_type`, `price`, `days_num`, `status`) VALUES
(1, 2, 10, 'Autobus', 'Polupansion', 395, 30, 1),
(2, 2, 2, 'asd', '', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `travel_infos`
--

CREATE TABLE `travel_infos` (
  `travel_id` int(10) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL,
  `Author` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `travel_infos`
--

INSERT INTO `travel_infos` (`travel_id`, `begin`, `end`, `Author`, `status`) VALUES
(1, '2015-06-15', '2015-06-25', 'korisnik', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('Registrovani korisnik','Radnik agencije','Sef agencije') NOT NULL DEFAULT 'Registrovani korisnik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'milos', '8b764977a676f7c4b750fc3af0e753f9', 'Sef agencije');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `name`, `surname`, `address`, `phone`, `email`) VALUES
(1, 'Milos', 'Zivanovic', '', 123321, 'z.milos93@yahoo.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arrangements`
--
ALTER TABLE `arrangements`
  ADD PRIMARY KEY (`arrangement_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `reservation_infos`
--
ALTER TABLE `reservation_infos`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `travels`
--
ALTER TABLE `travels`
  ADD PRIMARY KEY (`travel_id`);

--
-- Indexes for table `travel_infos`
--
ALTER TABLE `travel_infos`
  ADD PRIMARY KEY (`travel_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arrangements`
--
ALTER TABLE `arrangements`
  MODIFY `arrangement_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_infos`
--
ALTER TABLE `reservation_infos`
  MODIFY `reservation_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travels`
--
ALTER TABLE `travels`
  MODIFY `travel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `travel_infos`
--
ALTER TABLE `travel_infos`
  MODIFY `travel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
