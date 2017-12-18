-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Gru 2017, 09:15
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `szkolnaligastrzelecka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `druzyny`
--

CREATE TABLE `druzyny` (
  `ID_druzyny` int(11) NOT NULL,
  `NazwaSzkoly` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `AdresSzkoly` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `WWW` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `NazwaDruzyny` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `SumaPkt` int(11) NOT NULL,
  `konkurs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `druzyny`
--

INSERT INTO `druzyny` (`ID_druzyny`, `NazwaSzkoly`, `AdresSzkoly`, `WWW`, `NazwaDruzyny`, `SumaPkt`, `konkurs`) VALUES
(1, 'Zsp Kłodawa', 'Kłodawa ul.Mickiewicza 5', 'www.zspklodawa.org', 'ZSP1', 100, 1),
(2, 'Zsp Kłodawa', 'Kłodawa Ul.mickiewicza 5', 'www.zspklodawa.org', 'ZSP2', 100, 0),
(3, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka', 0, 1),
(4, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka 2', 0, 0),
(5, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka 3', 0, 0),
(6, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka 4', 0, 0),
(7, 'Zsp Kłodawa', 'Bohaterów Września 9/14', '', 'ZSP3', 0, 0),
(8, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka 5', 0, 0),
(9, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka 5214', 0, 0),
(10, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka 526', 0, 0),
(11, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka21', 0, 0),
(12, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynkaw32', 0, 0),
(13, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka 2878970', 0, 0),
(14, 'Szkoła Podstawowa Nr. 1', 'Kłodawa Ul. Wyszyńskiego 25', '', 'Jedynka213', 0, 0),
(15, 'Zsp Kłodawa', 'Bohaterów Września, 9/14', '', 'ZSP3ad', 0, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `druzyny`
--
ALTER TABLE `druzyny`
  ADD PRIMARY KEY (`ID_druzyny`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `druzyny`
--
ALTER TABLE `druzyny`
  MODIFY `ID_druzyny` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
