-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2016 at 01:23 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `articles_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `content` text COLLATE utf8_czech_ci,
  `url` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articles_id`, `title`, `content`, `url`, `description`, `keywords`) VALUES
(1, 'Úvod', '<p>Vítejte na mém webu!</p>\r\n<p style="text-align: left;">Tento web slouží jako prezentace mé tvorby a zároveň jako deník.<img style="float: right;" src="../pictures/IMG_1124_nahled.jpg" alt="" width="300" height="223" /></p>\r\n<p style="text-align: justify;">Pokud máte nějaké otázky, neváhejte mě kontaktovat.</p>', 'introduction', 'Úvodní článek na webu v MVC v PHP', 'úvod, mvc, web'),
(2, 'pokus', '<p>pokus</p>\r\n<ul style="list-style-type: undefined;">\r\n<li>jede</li>\r\n<li>nejede</li>\r\n</ul>\r\n<p> </p>', 'pokus', 'pokus', 'poku'),
(3, 'Obrázek', '<p><img src="obr.png" alt="" width="794" height="753" /><img src="http://blog.idnes.cz/blog/5634/203954/Krab_ricni.jpg" alt="" width="450" height="262" /></p>', 'picture', 'obrazek', 'obrazky'),
(4, 'Můj nový výtvor', '<p><img src="iu.jpeg" alt="" width="500" height="500" /></p>\r\n<p>Tohohle jsem vytvořila po zhlédnutí filmu.</p>', 'novy-vytvor', 'novinka', 'pes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `name`, `password`, `admin`) VALUES
(1, 'Matěj', '2f120ae9861ff0c3bdf0b4b8caee7c9d44974cf21cd0919b804205d5840f09e4', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articles_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
