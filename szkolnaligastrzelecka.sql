-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2017 at 08:08 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `szkolnaligastrzelecka`
--

-- --------------------------------------------------------

--
-- Table structure for table `druzyny`
--

CREATE TABLE `druzyny` (
  `ID_druzyny` int(11) NOT NULL,
  `NazwaSzkoly` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `AdresSzkoly` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `WWW` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `NazwaDruzyny` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `druzyny`
--

INSERT INTO `druzyny` (`ID_druzyny`, `NazwaSzkoly`, `AdresSzkoly`, `WWW`, `NazwaDruzyny`) VALUES
(1, 'ZSP Kłodawa', 'Kłodawa ul.Mickiewicza 5', 'www.zspklodawa.org', 'ZSP1'),
(2, 'Zsp Kłodawa', 'Kłodawa Ul.mickiewicza 5', 'www.zspklodawa.org', 'ZSP2');

-- --------------------------------------------------------

--
-- Table structure for table `logi`
--

CREATE TABLE `logi` (
  `ID` int(11) NOT NULL,
  `IP` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ID_uzytkownika` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Czynnosc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logi`
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
(12, '192.168.0.104', 1, '2017-12-12', 'Logowanie');

-- --------------------------------------------------------

--
-- Table structure for table `punkty`
--

CREATE TABLE `punkty` (
  `ID` int(11) NOT NULL,
  `ID_zaw` int(11) NOT NULL,
  `Suma` int(11) NOT NULL,
  `Ilosc_10` int(11) NOT NULL,
  `ID_Rundy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `punkty`
--

INSERT INTO `punkty` (`ID`, `ID_zaw`, `Suma`, `Ilosc_10`, `ID_Rundy`) VALUES
(1, 1, 999, 2, 1),
(31, 4, 98, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rundy`
--

CREATE TABLE `rundy` (
  `ID` int(11) NOT NULL,
  `IdSezonu` int(11) NOT NULL,
  `NazwaShl` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rundy`
--

INSERT INTO `rundy` (`ID`, `IdSezonu`, `NazwaShl`) VALUES
(1, 2, 'ZSP');

-- --------------------------------------------------------

--
-- Table structure for table `sezony`
--

CREATE TABLE `sezony` (
  `ID` int(11) NOT NULL,
  `Data` text NOT NULL,
  `Zakonczony` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sezony`
--

INSERT INTO `sezony` (`ID`, `Data`, `Zakonczony`) VALUES
(1, '2016/2017', 1),
(2, '2017/2018', 0);

-- --------------------------------------------------------

--
-- Table structure for table `uzytkownicy`
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
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID`, `Imie`, `Nazwisko`, `Admin`, `Email`, `Haslo`, `Login`) VALUES
(1, 'Kamil', 'Langer', 1, 'kamillanger4@gmail.com', 'e9d5e3af2161e6b2866936cf3626e8e3223faa10a120a53fada9d2fd4bbc1d7d', 'camzu1998'),
(2, 'Kamil', 'Langer', 0, 'kamillanger4@wp.pl', 'e9d5e3af2161e6b2866936cf3626e8e3223faa10a120a53fada9d2fd4bbc1d7d', 'camzu98');

-- --------------------------------------------------------

--
-- Table structure for table `zawodnicy`
--

CREATE TABLE `zawodnicy` (
  `ID_zawodnika` int(11) NOT NULL,
  `Imie Nazwisko` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ID_druzyny` int(11) NOT NULL,
  `Plec` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `zawodnicy`
--

INSERT INTO `zawodnicy` (`ID_zawodnika`, `Imie Nazwisko`, `ID_druzyny`, `Plec`) VALUES
(1, 'Kamil Langer', 1, 'M'),
(2, 'Mateusz Kos', 1, 'M'),
(3, 'Michał Koligot', 2, 'M'),
(4, 'Jacek Malicki', 2, 'M');

--
-- Indexes for dumped tables
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
-- AUTO_INCREMENT for table `druzyny`
--
ALTER TABLE `druzyny`
  MODIFY `ID_druzyny` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `logi`
--
ALTER TABLE `logi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `punkty`
--
ALTER TABLE `punkty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `rundy`
--
ALTER TABLE `rundy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sezony`
--
ALTER TABLE `sezony`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `zawodnicy`
--
ALTER TABLE `zawodnicy`
  MODIFY `ID_zawodnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
