-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 02:55 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudbooka4hj`
--

-- --------------------------------------------------------

--
-- Table structure for table `hj_reading`
--

CREATE TABLE `hj_reading` (
  `readingID` int(11) NOT NULL,
  `bookName` varchar(30) NOT NULL,
  `usernameR` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hj_reading`
--

INSERT INTO `hj_reading` (`readingID`, `bookName`, `usernameR`) VALUES
(3, 'The shadow on the spark	', 'Hasan Karam');

-- --------------------------------------------------------

--
-- Table structure for table `hj_signup`
--

CREATE TABLE `hj_signup` (
  `signupID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hj_signup`
--

INSERT INTO `hj_signup` (`signupID`, `username`, `email`, `password`) VALUES
(3, 'Saeed Kotob', 'skot@gmail.com', '$2y$10$XRcP8b66w7/CJdViTRn48./'),
(4, 'Hamdi Morad', 'hamdimrd@gmail.com', '$2y$10$qJb5RqYNY8ONrwznH40bcOL'),
(6, 'Salem Mazen', 'mlop+-@gmail.com', '$2y$10$edfKrymlwEkBWS9KOTT1Ceg'),
(7, 'Martin Ricardo', 'mart234@gmail.com', '$2y$10$VvapASYByYwNCXH2VXdtUOx'),
(8, 'Saeed Kotob', 'skot@gmail.com', '$2y$10$YeuJdcxZJA9XGVso0jRfzeM'),
(9, 'Saeed Kotob', 'skot@gmail.com', '$2y$10$X9nuVG2PMho6TYb7TZoFzOn'),
(10, 'Hasan Karam', 'hkm@gmail.com', '$2y$10$3ASLjvR75SGwg507oWtxXuX'),
(11, 'Albert Brainwell', 'albert@gmail.com', '$2y$10$W/3JG6q07XvAkQELZs8LG.1'),
(12, 'Saeed Kotob', 'skot@gmail.com', '$2y$10$F0mQ85Q6vR50RHNgNOhA3eA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hj_reading`
--
ALTER TABLE `hj_reading`
  ADD PRIMARY KEY (`readingID`);

--
-- Indexes for table `hj_signup`
--
ALTER TABLE `hj_signup`
  ADD PRIMARY KEY (`signupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hj_reading`
--
ALTER TABLE `hj_reading`
  MODIFY `readingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hj_signup`
--
ALTER TABLE `hj_signup`
  MODIFY `signupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
