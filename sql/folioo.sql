-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 mei 2022 om 16:00
-- Serverversie: 10.4.22-MariaDB
-- PHP-versie: 8.1.2

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
  `comment` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `date_created`) VALUES
(121, 25, 7, 'Test comment!!!!!!!!!!!!!!!', '2022-05-05 15:59:57');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `follow`
--

INSERT INTO `follow` (`id`, `follower_id`, `following_id`) VALUES
(2, 4, 1),
(10, 1, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(1, 23, 1),
(2, 23, 1);

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
  `text` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `reported` int(11) NOT NULL DEFAULT 0,
  `showcase` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `text`, `image`, `tags`, `reported`, `showcase`) VALUES
(21, 1, 'Bright Logo Design', 'Wow this is nice!', '1_post-4243ed4beb469.jpg', 'logo,design', 0, 1),
(22, 1, 'Beyond log', 'Wow cool logo', '1_post-a70cfc6b0670d.jpg', 'beyond,logo', 0, 0),
(23, 1, 'bedrock', 'typo', '1_post-d9d3139b94a78.jpg', 'test', 0, 1),
(24, 7, 'Fine', 'I\'m fine... Really...', '7_post-9bd4d01133f9c.jpg', 'helpme', 0, 1),
(25, 7, 'Cute', 'Me when studying ', '7_post-38df4c586ac8b.jpg', 'cute', 0, 0);

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
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagramlink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `behancelink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedinlink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `followers` int(11) NOT NULL,
  `reported` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `secondary_email`, `image`, `education`, `bio`, `instagramlink`, `behancelink`, `linkedinlink`, `followers`, `reported`) VALUES
(1, 'test@thomasmore.be', '$2y$15$B1BPtZQGH5IodurXFAkZyuREXP9yWQ5gAbrKX0lTBnnTufttQjitm', 'Seppe', 'seppe.vg@live.be', '1.jpg', 'IMD', 'I like beer', '#insta', '', '', 0, 0),
(4, 'beatrijs@thomasmore.be', '$2y$15$n2H44jet8BJpa1gACaJ/9ebJfI9w.ZGh7E4MGk4CR194zZF4JDb4u', 'Béatrijs', 'bea@gmail.com', 'profiledefault.svg', 'Much wow', 'Ik ben gewoon nen test eh', '#lifesucks', '', '', 0, 0),
(7, 'r0831894@student.thomasmore.be', '$2y$15$y2PO5xUbhY/Giz/526xAVuWUPExzdOLkPWRJmUHASdY3aLzNdvvl2', 'Marie Serroyen', '', '7.jpg', '', '', '', '', '', 0, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `follow`
--
ALTER TABLE `follow`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT voor een tabel `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
