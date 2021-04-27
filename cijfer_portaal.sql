-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2021 at 08:13 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cijfer_portaal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cijfer`
--

CREATE TABLE `cijfer` (
  `CijferID` int(11) NOT NULL,
  `Vak_ID` int(11) NOT NULL,
  `Naam_Toets` varchar(255) NOT NULL,
  `Cijfer` float NOT NULL,
  `Periode_ID` int(11) NOT NULL,
  `Student_ID` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cijfer`
--

INSERT INTO `cijfer` (`CijferID`, `Vak_ID`, `Naam_Toets`, `Cijfer`, `Periode_ID`, `Student_ID`) VALUES
(1, 1, 'H1 Rekenen', 7.5, 1, '1'),
(2, 2, 'Praktikum Natuurkunde', 6.2, 1, '1'),
(3, 1, 'H1 Rekenen', 5.6, 1, '2'),
(4, 2, 'Praktikum Natuurkunde', 8.9, 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `klassen`
--

CREATE TABLE `klassen` (
  `KlasID` int(11) NOT NULL,
  `KlasNaam` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klassen`
--

INSERT INTO `klassen` (`KlasID`, `KlasNaam`) VALUES
(1, 'I2B2'),
(2, 'I2B1');

-- --------------------------------------------------------

--
-- Table structure for table `leraren`
--

CREATE TABLE `leraren` (
  `LeraarID` int(11) NOT NULL,
  `Voornaam` varchar(64) NOT NULL,
  `Achternaam` varchar(128) NOT NULL,
  `GebruikersID` int(5) NOT NULL,
  `Wachtwoord` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leraren`
--

INSERT INTO `leraren` (`LeraarID`, `Voornaam`, `Achternaam`, `GebruikersID`, `Wachtwoord`) VALUES
(1, 'Michiel', 'Heij', 86743, 'test1234'),
(2, 'Leslie', 'Window', 67543, 'test1234');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `PeriodeID` int(11) NOT NULL,
  `PeriodeNaam` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studenten`
--

CREATE TABLE `studenten` (
  `StudentID` char(36) NOT NULL,
  `StudentUUID` char(36) NOT NULL,
  `Voornaam` varchar(64) NOT NULL,
  `Achternaam` varchar(128) NOT NULL,
  `Gebruikersnaam` varchar(256) NOT NULL,
  `Wachtwoord` varchar(256) NOT NULL,
  `Klas_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studenten`
--

INSERT INTO `studenten` (`StudentID`, `StudentUUID`, `Voornaam`, `Achternaam`, `Gebruikersnaam`, `Wachtwoord`, `Klas_ID`) VALUES
('1', '57400b07-74d4-4c1f-bd35-960551fbb24c', 'Wouter', 'Oogjen', 'WOogjen', '2bbe0c48b91a7d1b8a6753a8b9cbe1db16b84379f3f91fe115621284df7a48f1cd71e9beb90ea614c7bd924250aa9e446a866725e685a65df5d139a5cd180dc9', 1),
('2', '03ccb0ef-6eeb-4c63-939b-25b2aa77e734', 'Jhon', 'Jhonson', 'JJhonson', 'e6e8ba72bf2bab68c923599a08489c6f3a35018e870d490fa25b4c2a2d82361093b9a8f1d0cdd02e5a7dd5e714dc090263e2e90af3d3d861c056f28a4adb2d95', 1),
('3', '19cd0e3a-1a0d-4022-b93a-eac2e3ccaa3b', 'Thom', 'Veldhuis', 'TVeldhuis', '437c5c5659d9d879df43747f4e100a1cca58152f31cbed7220d4308c5666beef0e636191b325878a38caabb4b9c8f696b1426d143fce12f099fd78141dcabc35', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vakken`
--

CREATE TABLE `vakken` (
  `VakID` int(11) NOT NULL,
  `VakNaam` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vakken`
--

INSERT INTO `vakken` (`VakID`, `VakNaam`) VALUES
(1, 'Nederlands'),
(2, 'Rekenen');

-- --------------------------------------------------------

--
-- Table structure for table `vak_klas`
--

CREATE TABLE `vak_klas` (
  `VakID` int(11) NOT NULL,
  `KlasID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vak_klas`
--

INSERT INTO `vak_klas` (`VakID`, `KlasID`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vak_leraar`
--

CREATE TABLE `vak_leraar` (
  `vak_ID` int(11) NOT NULL,
  `Leraar_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vak_leraar`
--

INSERT INTO `vak_leraar` (`vak_ID`, `Leraar_ID`) VALUES
(1, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cijfer`
--
ALTER TABLE `cijfer`
  ADD PRIMARY KEY (`CijferID`),
  ADD KEY `Vak_ID` (`Vak_ID`),
  ADD KEY `Periode_ID` (`Periode_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `klassen`
--
ALTER TABLE `klassen`
  ADD PRIMARY KEY (`KlasID`);

--
-- Indexes for table `leraren`
--
ALTER TABLE `leraren`
  ADD PRIMARY KEY (`LeraarID`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`PeriodeID`);

--
-- Indexes for table `studenten`
--
ALTER TABLE `studenten`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `Klas_ID` (`Klas_ID`);

--
-- Indexes for table `vakken`
--
ALTER TABLE `vakken`
  ADD PRIMARY KEY (`VakID`);

--
-- Indexes for table `vak_klas`
--
ALTER TABLE `vak_klas`
  ADD KEY `VakID` (`VakID`),
  ADD KEY `KlasID` (`KlasID`);

--
-- Indexes for table `vak_leraar`
--
ALTER TABLE `vak_leraar`
  ADD KEY `vak_ID` (`vak_ID`),
  ADD KEY `Leraar_ID` (`Leraar_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cijfer`
--
ALTER TABLE `cijfer`
  MODIFY `CijferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `klassen`
--
ALTER TABLE `klassen`
  MODIFY `KlasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leraren`
--
ALTER TABLE `leraren`
  MODIFY `LeraarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `PeriodeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vakken`
--
ALTER TABLE `vakken`
  MODIFY `VakID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cijfer`
--
ALTER TABLE `cijfer`
  ADD CONSTRAINT `cijfer_ibfk_1` FOREIGN KEY (`Vak_ID`) REFERENCES `vakken` (`VakID`),
  ADD CONSTRAINT `cijfer_ibfk_2` FOREIGN KEY (`Student_ID`) REFERENCES `studenten` (`StudentID`);

--
-- Constraints for table `studenten`
--
ALTER TABLE `studenten`
  ADD CONSTRAINT `studenten_ibfk_1` FOREIGN KEY (`Klas_ID`) REFERENCES `klassen` (`KlasID`);

--
-- Constraints for table `vak_klas`
--
ALTER TABLE `vak_klas`
  ADD CONSTRAINT `vak_klas_ibfk_1` FOREIGN KEY (`VakID`) REFERENCES `vakken` (`VakID`),
  ADD CONSTRAINT `vak_klas_ibfk_2` FOREIGN KEY (`KlasID`) REFERENCES `klassen` (`KlasID`);

--
-- Constraints for table `vak_leraar`
--
ALTER TABLE `vak_leraar`
  ADD CONSTRAINT `vak_leraar_ibfk_1` FOREIGN KEY (`Leraar_ID`) REFERENCES `leraren` (`LeraarID`),
  ADD CONSTRAINT `vak_leraar_ibfk_2` FOREIGN KEY (`vak_ID`) REFERENCES `vakken` (`VakID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
