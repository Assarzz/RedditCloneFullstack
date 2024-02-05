-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Feb 05, 2024 at 03:59 PM
-- Server version: 11.1.2-MariaDB-1:11.1.2+maria~ubu2204
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--
CREATE DATABASE IF NOT EXISTS `db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db`;
--
-- Database: `egytalk`
--
CREATE DATABASE IF NOT EXISTS `egytalk` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `egytalk`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `cid` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `comment_txt` text NOT NULL,
  `date` datetime NOT NULL,
  `uid` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `pid` int(10) UNSIGNED NOT NULL,
  `uid` char(36) NOT NULL,
  `post_txt` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`pid`, `uid`, `post_txt`, `date`) VALUES
(1, '956eef04-c402-11ee-b2a4-0242ac150003', 'Hello I am Bert Berticus. Praise my name here!', '2024-02-05 08:56:05'),
(2, '956eef04-c402-11ee-b2a4-0242ac150003', 'Just a reminder! Make sure to praise my name!!!  \\_(^ >^)_/', '2024-02-05 08:58:39'),
(3, '8be58e91-c02c-11ee-bc34-0242ac150002', 'How do you say \"vederlägga\" in english?', '2024-02-05 09:00:39'),
(4, '3a1337ac-c41e-11ee-8934-0242ac150002', 'Woof woof woof...', '2024-02-05 12:01:48'),
(5, '1b5395a6-c41e-11ee-8934-0242ac150002', 'I can fix your toilet. Send requests in the comments', '2024-02-05 12:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` char(36) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `firstname`, `surname`, `username`, `password`) VALUES
('1b5395a6-c41e-11ee-8934-0242ac150002', 'Mario', 'Plumber', 'MarioP', '$2y$10$6uSB54XBjj6GP0jZLmOl7.miXKbi4o1rSy6p6sO2iUC5TlMKj1Pby'),
('3a1337ac-c41e-11ee-8934-0242ac150002', 'Albus', 'D', 'Popsi', '$2y$10$6uSB54XBjj6GP0jZLmOl7.miXKbi4o1rSy6p6sO2iUC5TlMKj1Pby'),
('8be58e91-c02c-11ee-bc34-0242ac150002', 'assar', 'lannerborn', 'assar2', '$2y$10$L3He3Z0Seaw08Y60JsDXDuoMOIju3AeePfZu2094H1I9bP4ebWGou'),
('956eef04-c402-11ee-b2a4-0242ac150003', 'Bert', 'Berticus', 'NotBert', '$2y$10$6uSB54XBjj6GP0jZLmOl7.miXKbi4o1rSy6p6sO2iUC5TlMKj1Pby');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `link_uid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
