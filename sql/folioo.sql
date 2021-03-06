-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 mei 2022 om 08:45
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
(1, 1, 2);

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
(2, 22, 2),
(3, 23, 2),
(4, 24, 2),
(5, 24, 1),
(6, 6, 1),
(7, 26, 1),
(16, 31, 1),
(17, 33, 1),
(34, 35, 3);

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
  `tags` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `colors` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `showcase` int(1) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `text`, `image`, `tags`, `colors`, `showcase`, `archived`) VALUES
(33, 1, 'L\'oie', 'stickers ', '1_post-b67a100389310.jpg', 'nice, interface dev, stickers', '000000, FFFFCC, FF3333, FFCC99, CC9933', 0, 0),
(34, 1, 'firoun', 'bookcover', '1_post-c1b74c9cc2f2c.jpg', 'design, book, wow', 'CC6666, 993333, CCCCCC, CC9999, CC9966', 0, 0),
(35, 1, 'Moscow', 'INN', '1_post-988d86f47a109.jpg', 'moscow, book, wow, nice, design', 'FFFFFF, CCCCCC, CC6666, 339999, FFCC33', 0, 0),
(36, 1, 'Uber Red User', 'design for cover', '1_post-5b964992e3132.jpg', 'cover, red, bold, design', 'FFCCCC, CC3333, CCCCCC, CC3300, 000000', 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reportpost`
--

CREATE TABLE `reportpost` (
  `id` int(10) UNSIGNED NOT NULL,
  `reported_at` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `reportpost`
--

INSERT INTO `reportpost` (`id`, `reported_at`, `post_id`, `user_id`) VALUES
(25, '2022-05-22 15:38:24', 36, 20),
(40, '2022-05-22 15:40:24', 34, 20),
(41, '2022-05-22 15:58:48', 33, 20);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reportuser`
--

CREATE TABLE `reportuser` (
  `id` int(10) UNSIGNED NOT NULL,
  `reported_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reported_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `reportuser`
--

INSERT INTO `reportuser` (`id`, `reported_at`, `reported_user_id`, `from_user_id`) VALUES
(1, '2022-05-22 13:31:10', 1, 20);

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
  `admin` int(11) NOT NULL,
  `moderator` int(11) NOT NULL,
  `warning` int(11) NOT NULL,
  `banned` datetime DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `secondary_email`, `image`, `education`, `bio`, `instagramlink`, `behancelink`, `linkedinlink`, `admin`, `moderator`, `warning`, `banned`, `archived`) VALUES
(1, 'seppe.vangeel@student.thomasmore.be', '$2y$15$U1mq7UBC70E0VKwzyNhq3ee8vUNNiWnXx7IurCNhW6wxYuJ4JsgXK', 'Seep', 'seppe.vg@live.be', '1.jpg', 'Interactive Multimedia Design', 'I like php', '#instagram', '#behance', '#linkedin', 1, 0, 0, NULL, 0),
(2, 'tester@thomasmore.be', '$2y$15$72YN1rxRIov0bmitz.5TR.8Oxop8IjRvLsfrNzY//SQHnRSl7lMmq', 'tester', NULL, 'profiledefault.svg', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 0),
(3, 'r0831894@student.thomasmore.be', '$2y$15$36maiwWOyyx84gOvg8VIluAOwjexKxe3LMzWQgstLNMufds06eFB2', 'Marie', '', '3.jpg', '', '', '', '', '', 1, 1, 0, NULL, 0),
(20, 'r0831678@student.thomasmore.be', '$2y$15$ne78I9dQgPHuMndoWFniEueUH.1QvmFMvXSOvbmEzi6DIbuiQzXKq', 'gbeyens', NULL, 'profiledefault.svg', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Gegevens worden geëxporteerd voor tabel `views`
--

INSERT INTO `views` (`id`, `post_id`, `user_id`) VALUES
(45, 36, 8),
(46, 36, 20),
(47, 35, 20),
(48, 34, 20),
(49, 39, 20),
(50, 33, 20),
(51, 36, 3),
(54, 35, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `warnuser`
--

CREATE TABLE `warnuser` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

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
-- Indexen voor tabel `reportpost`
--
ALTER TABLE `reportpost`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reportuser`
--
ALTER TABLE `reportuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `warnuser`
--
ALTER TABLE `warnuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT voor een tabel `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT voor een tabel `reportpost`
--
ALTER TABLE `reportpost`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT voor een tabel `reportuser`
--
ALTER TABLE `reportuser`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT voor een tabel `warnuser`
--
ALTER TABLE `warnuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
