-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Maj 2016, 16:46
-- Wersja serwera: 5.6.26
-- Wersja PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wojownicy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `building_id` int(11) NOT NULL,
  `building_name` varchar(25) NOT NULL,
  `building_lvl` int(11) NOT NULL,
  `building_production` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `buildings`
--

INSERT INTO `buildings` (`building_id`, `building_name`, `building_lvl`, `building_production`) VALUES
(1, 'Ratusz', 1, NULL),
(2, 'Spichlerz', 1, 1500),
(3, 'Koszary', 1, 6),
(4, 'Tartak', 1, 100),
(5, 'Kamieniolom', 1, 100),
(6, 'Farma', 1, 100),
(1, 'Ratusz', 2, NULL),
(1, 'Ratusz', 3, NULL),
(1, 'Ratusz', 4, NULL),
(1, 'Ratusz', 5, NULL),
(1, 'Ratusz', 6, NULL),
(1, 'Ratusz', 7, NULL),
(1, 'Ratusz', 8, NULL),
(1, 'Ratusz', 9, NULL),
(1, 'Ratusz', 10, NULL),
(2, 'Spichlerz', 3, 3500),
(2, 'Spichlerz', 2, 2500),
(2, 'Spichlerz', 4, 4500),
(2, 'Spichlerz', 5, 5500),
(2, 'Spichlerz', 6, 6500),
(2, 'Spichlerz', 7, 7500),
(2, 'Spichlerz', 8, 8500),
(2, 'Spichlerz', 9, 9500),
(2, 'Spichlerz', 10, 10500),
(3, 'Koszary', 2, 9),
(3, 'Koszary', 3, 12),
(3, 'Koszary', 4, 15),
(3, 'Koszary', 5, 18),
(3, 'Koszary', 6, 21),
(3, 'Koszary', 7, 24),
(3, 'Koszary', 8, 27),
(3, 'Koszary', 9, 30),
(3, 'Koszary', 10, 33),
(4, 'Tartak', 2, 150),
(4, 'Tartak', 3, 200),
(4, 'Tartak', 4, 250),
(4, 'Tartak', 5, 300),
(4, 'Tartak', 6, 350),
(4, 'Tartak', 7, 400),
(4, 'Tartak', 8, 450),
(4, 'Tartak', 9, 500),
(4, 'Tartak', 10, 550),
(5, 'Kamieniolom', 2, 150),
(5, 'Kamieniolom', 3, 200),
(5, 'Kamieniolom', 4, 250),
(5, 'Kamieniolom', 5, 300),
(5, 'Kamieniolom', 6, 350),
(5, 'Kamieniolom', 7, 400),
(5, 'Kamieniolom', 8, 450),
(5, 'Kamieniolom', 9, 500),
(5, 'Kamieniolom', 10, 550),
(6, 'Farma', 2, 150),
(6, 'Farma', 3, 200),
(6, 'Farma', 4, 250),
(6, 'Farma', 5, 300),
(6, 'Farma', 6, 350),
(6, 'Farma', 7, 400),
(6, 'Farma', 8, 450),
(6, 'Farma', 9, 500),
(6, 'Farma', 10, 550);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `zboze` int(11) NOT NULL,
  `dnipremium` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `drewno`, `kamien`, `zboze`, `dnipremium`) VALUES
(1, 'miki121208', '$2y$10$rGNQ.mOGbviu/IqMG/gLceY/NIqR1ihmIskZDlCzKc1lTdVBhE5Fu', 'miki121208@gmail.com', 100, 100, 100, 7),
(2, 'miki121209', '$2y$10$rIQjycEZnaAp6JVAQgBKBetCLXgf5CLzR7D8PR6m6l9wBqOH0KMn6', 'miki121209@gmail.com', 100, 100, 100, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_buildings`
--

CREATE TABLE IF NOT EXISTS `users_buildings` (
  `user_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `building_lvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users_buildings`
--

INSERT INTO `users_buildings` (`user_id`, `building_id`, `building_lvl`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(2, 4, 1),
(2, 5, 1),
(2, 6, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
