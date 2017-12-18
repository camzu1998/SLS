-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Gru 2017, 09:17
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logi`
--

CREATE TABLE `logi` (
  `ID` int(11) NOT NULL,
  `IP` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ID_uzytkownika` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Czynnosc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `logi`
--

INSERT INTO `logi` (`ID`, `IP`, `ID_uzytkownika`, `Data`, `Czynnosc`) VALUES
(1, '::1', 1, '2017-12-07', 'Logowanie'),
(2, '192.168.0.107', 1, '2017-12-07', 'Logowanie'),
(3, '192.168.0.107', 1, '2017-12-07', 'Logowanie'),
(4, '::1', 1, '2017-12-07', 'Logowanie'),
(5, '::1', 1, '2017-12-08', 'Logowanie'),
(6, '::1', 1, '2017-12-08', 'Logowanie'),
(7, '::1', 1, '2017-12-08', 'Logowanie'),
(8, '::1', 1, '2017-12-08', 'Logowanie'),
(9, '192.168.0.104', 1, '2017-12-11', 'Logowanie'),
(10, '192.168.0.104', 1, '2017-12-11', 'Logowanie'),
(11, '192.168.0.104', 1, '2017-12-11', 'Logowanie'),
(12, '192.168.0.104', 1, '2017-12-12', 'Logowanie'),
(13, '::1', 1, '2017-12-17', 'Logowanie'),
(14, '::1', 1, '2017-12-17', 'Logowanie'),
(15, '::1', 1, '2017-12-17', 'Logowanie'),
(16, '::1', 1, '2017-12-17', 'Logowanie'),
(17, '::1', 1, '2017-12-18', 'Logowanie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `punkty`
--

CREATE TABLE `punkty` (
  `ID` int(11) NOT NULL,
  `ID_zaw` int(11) NOT NULL,
  `Suma` int(11) NOT NULL,
  `Ilosc_10` int(11) NOT NULL,
  `ID_Rundy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `punkty`
--

INSERT INTO `punkty` (`ID`, `ID_zaw`, `Suma`, `Ilosc_10`, `ID_Rundy`) VALUES
(1, 1, 999, 2, 1),
(31, 4, 98, 8, 1),
(32, 5, 100, 10, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rundy`
--

CREATE TABLE `rundy` (
  `ID` int(11) NOT NULL,
  `IdSezonu` int(11) NOT NULL,
  `NazwaShl` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `rundy`
--

INSERT INTO `rundy` (`ID`, `IdSezonu`, `NazwaShl`) VALUES
(1, 2, 'ZSP'),
(3, 2, 'ZSP Kłodawa'),
(4, 2, 'B , M');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sezony`
--

CREATE TABLE `sezony` (
  `ID` int(11) NOT NULL,
  `Data` text NOT NULL,
  `Zakonczony` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `sezony`
--

INSERT INTO `sezony` (`ID`, `Data`, `Zakonczony`) VALUES
(1, '2016/2017', 1),
(2, '2017/2018', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID` int(11) NOT NULL,
  `Imie` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Admin` int(11) NOT NULL,
  `Email` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Haslo` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `Login` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID`, `Imie`, `Nazwisko`, `Admin`, `Email`, `Haslo`, `Login`) VALUES
(1, 'Kamil', 'Langer', 1, 'kamillanger4@gmail.com', 'e9d5e3af2161e6b2866936cf3626e8e3223faa10a120a53fada9d2fd4bbc1d7d', 'camzu1998'),
(2, 'Kamil', 'Langer', 0, 'kamillanger4@wp.pl', 'e9d5e3af2161e6b2866936cf3626e8e3223faa10a120a53fada9d2fd4bbc1d7d', 'camzu98');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zawodnicy`
--

CREATE TABLE `zawodnicy` (
  `ID_zawodnika` int(11) NOT NULL,
  `Imie Nazwisko` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ID_druzyny` int(11) NOT NULL,
  `Plec` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `zawodnicy`
--

INSERT INTO `zawodnicy` (`ID_zawodnika`, `Imie Nazwisko`, `ID_druzyny`, `Plec`) VALUES
(1, 'Kamil Langer', 0, 'M'),
(2, 'Mateusz Kos', 0, 'M'),
(3, 'Michał Koligot', 0, 'M'),
(4, 'Konrad Chyżewski', 0, 'M'),
(5, 'Błażej Wielgopolan', 0, 'M'),
(6, 'Magdalena Malicka', 0, 'K'),
(7, 'Marta Nitecka', 0, 'K'),
(8, 'Magdalena Bednarowicz', 0, 'K');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `druzyny`
--
ALTER TABLE `druzyny`
  ADD PRIMARY KEY (`ID_druzyny`);

--
-- Indexes for table `logi`
--
ALTER TABLE `logi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `punkty`
--
ALTER TABLE `punkty`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rundy`
--
ALTER TABLE `rundy`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sezony`
--
ALTER TABLE `sezony`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `zawodnicy`
--
ALTER TABLE `zawodnicy`
  ADD PRIMARY KEY (`ID_zawodnika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `druzyny`
--
ALTER TABLE `druzyny`
  MODIFY `ID_druzyny` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `logi`
--
ALTER TABLE `logi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT dla tabeli `punkty`
--
ALTER TABLE `punkty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT dla tabeli `rundy`
--
ALTER TABLE `rundy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `sezony`
--
ALTER TABLE `sezony`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `zawodnicy`
--
ALTER TABLE `zawodnicy`
  MODIFY `ID_zawodnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
