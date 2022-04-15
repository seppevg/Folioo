-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 15 apr 2022 om 12:59
-- Serverversie: 5.7.24
-- PHP-versie: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `passwordreset`
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
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `image`, `tags`) VALUES
(1, 11, 'Test project', 'profiledefault.jpg', '#testing'),
(2, 3, 'My First Project', 'profiledefault.jpg', '#first'),
(3, 8, 'Marie\'s Project', 'profiledefault.jpg', '#logo'),
(10, 11, 'Test', 'profiledefault.jpg', '#test'),
(11, 11, 'Test', 'profiledefault.jpg', '#test'),
(12, 11, 'Test', 'profiledefault.jpg', '#test'),
(13, 11, 'Test', 'profiledefault.jpg', '#test'),
(14, 11, 'Test', 'profiledefault.jpg', '#test'),
(15, 11, 'Test', 'profiledefault.jpg', '#test'),
(16, 11, 'Test', 'profiledefault.jpg', '#test'),
(17, 11, 'Test', 'profiledefault.jpg', '#test'),
(18, 11, 'Test', 'profiledefault.jpg', '#test'),
(19, 11, 'Test', 'profiledefault.jpg', '#test'),
(20, 11, 'Test', 'profiledefault.jpg', '#test'),
(21, 11, 'Test', 'profiledefault.jpg', '#test'),
(22, 11, 'Test', 'profiledefault.jpg', '#test'),
(23, 11, 'Test', 'profiledefault.jpg', '#test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
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
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `secondary_email`, `image`, `education`, `bio`, `instagramlink`, `behancelink`, `linkedinlink`) VALUES
(3, 'r0748140@student.thomasmore.be', '$2y$15$Agj1ewRUlMYJwL.squ/Xfe7lfUBchj7EJ6YAF12J4QLwsHkvYfT5G', 'Seep', NULL, 'r0748140@student.thomasmore.be.jpg', NULL, NULL, NULL, NULL, NULL),
(8, 'r0831894@student.thomasmore.be', '$2y$15$0dTt7nrSzq9J9DkOyL2mrOV1PfWz6XY2XAfCN7opFCw4Ty0LpS6r6', 'Marie', '', 'r0831894@student.thomasmore.be.jpg', 'Interactive Multimedia Design', '', '', '', ''),
(11, 'test@thomasmore.be', '$2y$15$dN6hTlPj3HQCnNiRk3ZWfu5WsgF4lpKUQxpyckGBc1AO9DuE4u74q', 'Test Test', 'seppe.vg@live.be', 'test@thomasmore.be.png', 'Interactive Multimedia Design Thomas More Mechelen', 'I am a professional who loves to design and post stuff online toFolioo :) Follow me for more content!', '@thetestingmachine', 'www.behance.com/thetestingmachine', 'www.linkedin.com/thetestingmachine');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
