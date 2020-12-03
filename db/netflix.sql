-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 10:42 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `movie_description` varchar(255) NOT NULL,
  `movie_category` varchar(255) NOT NULL,
  `movie_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `movie_description`, `movie_category`, `movie_date`) VALUES
(1, 'Extraction', 'A black-market mercenary who has nothing to lose is hired to rescue the kidnapped son of an imprisoned international crime lord. But in the murky underworld of weapons dealers and drug traffickers, an already deadly mission approaches the impossible.', 'Action', '24 april 2020'),
(2, 'Game Night', 'Max and Annie set out to solve the mystery and find Brooks, Max\'s brother, who mysteriously disappeared during their game night.', 'Comedy', '22 feb 2018'),
(3, 'Passengers', 'During a voyage to a distant colony planet, Jims hypersleep pod malfunctions, waking him up. He and fellow passenger Aurora must work together to prevent their spaceship from meeting with a disaster', 'sci-fi romance', '22 dec 2016');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`) VALUES
(1, 'simranudasi23@gmail.com', '$2y$10$ntXvVzmIroLAWDemvb3uhu3nLTE2yuSIlywYlAQ.xn4RTkRAZHfxa'),
(2, 'simranudasi43@gmail.com', '$2y$10$/aUmTEztA8pkVmr.Da1REO0Wj/NpHuMgswaNFRZHE3HsS0WgWQCJm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
