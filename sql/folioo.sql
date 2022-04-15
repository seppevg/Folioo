-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2022 at 03:32 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `folioo`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `Id` int(11) NOT NULL,
  `Email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Selector` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Token` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Expires` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_520_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `text`, `image`, `tags`) VALUES
(1, 12, 'niew', 'afsdjlk;s', 'post_18.svg', '#lolol'),
(2, 3, 'My First Project', '', 'profiledefault.jpg', '#first'),
(3, 8, 'Marie\'s Project', '', 'profiledefault.jpg', '#logo'),
(10, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(11, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(12, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(13, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(14, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(15, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(16, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(17, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(18, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(19, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(20, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(21, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(22, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(23, 11, 'Test', '', 'profiledefault.jpg', '#test'),
(27, 12, 'Poster', 'I made this one time', 'post_18.png', '#rickandmorty');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `instagramlink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `behancelink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedinlink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `secondary_email`, `image`, `education`, `bio`, `instagramlink`, `behancelink`, `linkedinlink`) VALUES
(3, 'r0748140@student.thomasmore.be', '$2y$15$Agj1ewRUlMYJwL.squ/Xfe7lfUBchj7EJ6YAF12J4QLwsHkvYfT5G', 'Seep', NULL, 'r0748140@student.thomasmore.be.jpg', NULL, NULL, NULL, NULL, NULL),
(8, 'r0831894@student.thomasmore.be', '$2y$15$0dTt7nrSzq9J9DkOyL2mrOV1PfWz6XY2XAfCN7opFCw4Ty0LpS6r6', 'Marie', '', 'r0831894@student.thomasmore.be.jpg', 'Interactive Multimedia Design', '', '', '', ''),
(11, 'test@thomasmore.be', '$2y$15$dN6hTlPj3HQCnNiRk3ZWfu5WsgF4lpKUQxpyckGBc1AO9DuE4u74q', 'Test Test', 'seppe.vg@live.be', 'test@thomasmore.be.png', 'Interactive Multimedia Design Thomas More Mechelen', 'I am a professional who loves to design and post stuff online toFolioo :) Follow me for more content!', '@thetestingmachine', 'www.behance.com/thetestingmachine', 'www.linkedin.com/thetestingmachine'),
(12, 'r0831678@student.thomasmore.be', '$2y$15$agsNuWBVbiPac/ldE2ivVeT6ez80RzKwKNHLfSeIBgYy0HsvAbd86', 'gebeyens', NULL, 'profiledefault.jpg', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
