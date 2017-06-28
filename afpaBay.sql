-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2017 at 09:47 AM
-- Server version: 5.7.18-0ubuntu0.17.04.1
-- PHP Version: 7.0.18-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afpaBay`
--

-- --------------------------------------------------------

--
-- Table structure for table `Films`
--

CREATE TABLE `Films` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf16_bin NOT NULL,
  `description` varchar(2046) COLLATE utf16_bin NOT NULL,
  `image` varchar(256) COLLATE utf16_bin NOT NULL,
  `releaseDate` int(4) NOT NULL,
  `author` varchar(256) COLLATE utf16_bin NOT NULL,
  `actors` varchar(256) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `Films`
--

INSERT INTO `Films` (`id`, `title`, `description`, `image`, `releaseDate`, `author`, `actors`) VALUES
(1, 'Inception', ' A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO. ', 'uploads/inception.jpg', 2010, 'Christopher Nolan', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page'),
(2, 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival. ', 'uploads/Interstellar.jpg', 2014, 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain');

-- --------------------------------------------------------

--
-- Table structure for table `Films_Users`
--

CREATE TABLE `Films_Users` (
  `UserID` int(11) NOT NULL,
  `FilmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `Films_Users`
--

INSERT INTO `Films_Users` (`UserID`, `FilmID`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) COLLATE utf16_bin NOT NULL,
  `password` varchar(100) COLLATE utf16_bin NOT NULL,
  `email` varchar(64) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `login`, `password`, `email`) VALUES
(1, 'Benji', '$2y$10$wYAHRKLmBbohWzBFaAmCrOI3iRznKV3QA8J49FcNnFm53c9U0W1qa', 'benjamingiraud29@hotmail.fr'),
(2, 'root', '$2y$10$v69KjL7zT/umbS2ILxP6KuN4e1nBp95NeZk3oVyznrD295lb/TEV2', 'popo@hotmail.fr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Films`
--
ALTER TABLE `Films`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Films`
--
ALTER TABLE `Films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
