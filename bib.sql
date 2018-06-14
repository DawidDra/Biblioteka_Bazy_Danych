-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Cze 2018, 01:04
-- Wersja serwera: 10.1.31-MariaDB
-- Wersja PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bib`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Ile_czasu` (IN `IDW` INT)  NO SQL
SELECT DATEDIFF( `wypożyczenia`.`przewidywana data zwrotu`, `wypożyczenia`.`data wypozyczenia`) FROM `wypożyczenia` WHERE `wypożyczenia`.`id wypozyczenia`=IDW$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Moje_wypozyczenia` (IN `wLogin` VARCHAR(32))  NO SQL
SELECT * FROM `wyp_dla_user` WHERE `wyp_dla_user`.`login_usr`=wLogin$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `oddaj` (IN `idW` INT)  NO SQL
BEGIN
UPDATE `wypozyczenia`
SET `rzeczywista data zwrotu` = CURRENT_DATE 
WHERE `id wypozyczenia` = idW;

UPDATE `ksiazka`, `wypozyczenia`
SET `czy_dostepna` = "tak"
WHERE `id wypozyczenia` = idW AND `wypozyczenia`.`id ksiazki`= `ksiazka`.`id ksiazki`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `wypozycz` (IN `idK` INT, IN `idU` INT)  NO SQL
BEGIN
INSERT INTO `wypozyczenia` VALUES (NULL,CURRENT_DATE,DATE_ADD(CURRENT_DATE,INTERVAL 30 DAY),NULL,idU,idK);

UPDATE `ksiazka` SET `czy_dostepna`= "nie" WHERE `id ksiazki` = idK;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Znajdz_autor` (IN `IA` VARCHAR(20) CHARSET utf8, IN `NA` VARCHAR(32) CHARSET utf8)  NO SQL
SELECT `ksiazka`.`tytul`, `autor`.`autor_imie`, `autor`.`autor_nazwisko`, `kategoria`.`Nazwa kategorii`, `wydawnictwo`.`nazwa wydawnictwa`,`ksiazka`.`czy_dostepna`, `ksiazka`.`id ksiazki`  FROM `autor`, `ksiazka`, `kategoria`, `wydawnictwo`  WHERE `autor`.`autor_imie`=IA AND `ksiazka`.`id autora`=`autor`.`id autora` AND `autor`.`autor_nazwisko`=NA AND `ksiazka`.`id kategorii`=`kategoria`.`id Kategorii` AND `ksiazka`.`id wydawnictwa`=`wydawnictwo`.`id wydawnictwa` AND `ksiazka`.`czy_dostepna`=`czy_dostepna`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Znajdz_kategoria` (IN `NK` VARCHAR(32))  NO SQL
SELECT `ksiazka`.`tytul`, `autor`.`autor_imie`, `autor`.`autor_nazwisko`, `kategoria`.`Nazwa kategorii`, `wydawnictwo`.`nazwa wydawnictwa`,`ksiazka`.`czy_dostepna`, `ksiazka`.`id ksiazki`  FROM `autor`, `ksiazka`, `kategoria`, `wydawnictwo` WHERE `ksiazka`.`id autora`=`autor`.`id autora` AND `ksiazka`.`id kategorii`=`kategoria`.`id Kategorii` AND `ksiazka`.`id wydawnictwa`=`wydawnictwo`.`id wydawnictwa` AND `kategoria`.`Nazwa kategorii`=NK AND `ksiazka`.`czy_dostepna`=`czy_dostepna`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Znajdz_tytul` (IN `NT` VARCHAR(255))  NO SQL
SELECT `ksiazka`.`numer egzemplarza`, `ksiazka`.`tytul`, `autor`.`autor_imie`, `autor`.`autor_nazwisko`, `kategoria`.`Nazwa kategorii`, `wydawnictwo`.`nazwa wydawnictwa`,`ksiazka`.`czy_dostepna`, `ksiazka`.`id ksiazki`  FROM `autor`, `ksiazka`, `kategoria`, `wydawnictwo`  WHERE `ksiazka`.`id autora`=`autor`.`id autora` AND `ksiazka`.`id kategorii`=`kategoria`.`id Kategorii` AND `ksiazka`.`id wydawnictwa`=`wydawnictwo`.`id wydawnictwa` AND `ksiazka`.`tytul`=NT AND `ksiazka`.`czy_dostepna`=`czy_dostepna`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Znajdz_wydawnictwo` (IN `NW` VARCHAR(255))  NO SQL
SELECT `ksiazka`.`tytul`, `autor`.`autor_imie`, `autor`.`autor_nazwisko`, `kategoria`.`Nazwa kategorii`, `wydawnictwo`.`nazwa wydawnictwa`,`ksiazka`.`czy_dostepna`,`ksiazka`.`id ksiazki`  FROM `autor`, `ksiazka`, `kategoria`, `wydawnictwo` WHERE  `ksiazka`.`id autora`=`autor`.`id autora` AND `ksiazka`.`id kategorii`=`kategoria`.`id Kategorii` AND `ksiazka`.`id wydawnictwa`=`wydawnictwo`.`id wydawnictwa` AND `wydawnictwo`.`nazwa wydawnictwa`=NW AND `ksiazka`.`czy_dostepna`=`czy_dostepna`$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `id adres` int(11) NOT NULL,
  `miejscowosc` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `kod pocztowy` varchar(6) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `ulica` varchar(32) COLLATE utf8_polish_ci DEFAULT NULL,
  `nr domu` varchar(5) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `adres`
--

INSERT INTO `adres` (`id adres`, `miejscowosc`, `kod pocztowy`, `ulica`, `nr domu`) VALUES
(1, 'Poznan', '60-230', 'Piwna', '25A'),
(2, 'Wroclaw', '50-012', 'Damrota', '64'),
(3, 'Wroclaw', '50-016', 'Wyszynskiego', '52'),
(4, 'Szczecin', '50-120', 'Grunwaldzka', '12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `autor`
--

CREATE TABLE `autor` (
  `id autora` int(11) NOT NULL,
  `autor_imie` varchar(20) CHARACTER SET utf8 NOT NULL,
  `autor_nazwisko` varchar(32) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `autor`
--

INSERT INTO `autor` (`id autora`, `autor_imie`, `autor_nazwisko`) VALUES
(5, 'Adam', 'Mickiewicz'),
(6, 'Juliusz', 'Slowacki'),
(7, 'Andrzej', 'Sapkowski'),
(8, 'Rafal', 'Czemplik'),
(9, 'Mario', 'Puzo');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dane`
--

CREATE TABLE `dane` (
  `login_d` varchar(32) CHARACTER SET utf8 NOT NULL,
  `imie_d` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko_d` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `nr_telefonu` int(9) NOT NULL,
  `id adres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `dane`
--

INSERT INTO `dane` (`login_d`, `imie_d`, `nazwisko_d`, `nr_telefonu`, `id adres`) VALUES
('Bgy', 'Robert', 'Jezewski', 464737799, 3),
('Lokret', 'Adam', 'Miałczyński', 743745233, 1),
('Najt', 'Dawid', 'Drapiewski', 753854464, 2),
('Payne', 'Krzysztof', 'Jarzyna', 777123987, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `id Kategorii` int(11) NOT NULL,
  `Nazwa kategorii` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategoria`
--

INSERT INTO `kategoria` (`id Kategorii`, `Nazwa kategorii`) VALUES
(1, 'Komedia'),
(2, 'Dramat'),
(3, 'Fantastyka'),
(4, 'Przygodowe'),
(5, 'Kryminal');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazka`
--

CREATE TABLE `ksiazka` (
  `id ksiazki` int(11) NOT NULL,
  `tytul` varchar(255) CHARACTER SET utf8 NOT NULL,
  `isbn` varchar(17) CHARACTER SET utf8 DEFAULT NULL,
  `Rok wydania` int(11) DEFAULT NULL,
  `numer egzemplarza` int(11) NOT NULL,
  `czy_dostepna` varchar(3) CHARACTER SET utf8 NOT NULL,
  `id autora` int(11) NOT NULL,
  `id kategorii` int(11) NOT NULL,
  `id wydawnictwa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `ksiazka`
--

INSERT INTO `ksiazka` (`id ksiazki`, `tytul`, `isbn`, `Rok wydania`, `numer egzemplarza`, `czy_dostepna`, `id autora`, `id kategorii`, `id wydawnictwa`) VALUES
(1, 'Pan Tadeusz', '534-3-15-235268-1', 1990, 1, 'tak', 5, 1, 1),
(2, 'Balladyna', '788-9-06-068838-0', 1890, 2, 'tak', 6, 2, 2),
(3, 'Wieza Jaskolki', '352-6-52-354965-0', 2000, 15, 'nie', 7, 3, 3),
(4, 'Ostatnie Zyczenie', '295-5-18-395839-1', 2003, 12, 'tak', 7, 3, 3),
(5, 'Sezon Burz', '548-4-24-253663-0', 2007, 1, 'tak', 7, 3, 3),
(6, 'Sezon Burz', '548-4-24-253663-0', 2007, 2, 'nie', 7, 3, 3),
(7, 'Przygody Kota Rafala', '235-3-53-643745-0', 2017, 1, 'tak', 8, 4, 4),
(8, 'Ojciec Chrzestny', '463-6-64-215236-5', 1974, 1, 'tak', 9, 5, 5),
(9, 'Sycylijczyk', '636-2-64-646436-0', 1976, 1, 'tak', 9, 5, 4),
(10, 'Sycylijczyk', '636-2-64-646436-0', 1976, 2, 'tak', 9, 5, 4),
(11, 'Sycylijczyk', '636-2-64-646436-0', 1976, 3, 'tak', 9, 5, 4),
(12, 'Balladyna', '788-9-06-068838-0', 1890, 1, 'tak', 6, 2, 2);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `ksiazka_widok`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `ksiazka_widok` (
`id ksiazki` int(11)
,`tytul` varchar(255)
,`isbn` varchar(17)
,`Rok wydania` int(11)
,`numer egzemplarza` int(11)
,`autor_imie` varchar(20)
,`autor_nazwisko` varchar(32)
,`Nazwa kategorii` varchar(32)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id uzytkownika` int(11) NOT NULL,
  `login_usr` varchar(32) CHARACTER SET utf8 NOT NULL,
  `haslo_usr` varchar(32) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`id uzytkownika`, `login_usr`, `haslo_usr`) VALUES
(1, 'Najt', '6413'),
(2, 'Bgy', '1234'),
(3, 'Lokret', 'okon123'),
(4, 'Payne', 'trigger007');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wydawnictwo`
--

CREATE TABLE `wydawnictwo` (
  `id wydawnictwa` int(11) NOT NULL,
  `nazwa wydawnictwa` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wydawnictwo`
--

INSERT INTO `wydawnictwo` (`id wydawnictwa`, `nazwa wydawnictwa`) VALUES
(1, 'Greg'),
(2, 'Nowa era'),
(3, 'SUPERNOVA'),
(4, 'Baria'),
(5, 'Albatros');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `id wypozyczenia` int(11) NOT NULL,
  `data wypozyczenia` date DEFAULT NULL,
  `przewidywana data zwrotu` date DEFAULT NULL,
  `rzeczywista data zwrotu` date DEFAULT NULL,
  `id uzytkownika` int(11) NOT NULL,
  `id ksiazki` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`id wypozyczenia`, `data wypozyczenia`, `przewidywana data zwrotu`, `rzeczywista data zwrotu`, `id uzytkownika`, `id ksiazki`) VALUES
(49, '2018-06-08', '2018-07-08', NULL, 1, 6),
(50, '2018-06-08', '2018-07-08', '2018-06-08', 1, 1);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `wypozyczenia_usr`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `wypozyczenia_usr` (
`id ksiazki` int(11)
,`tytul` varchar(255)
,`isbn` varchar(17)
,`Rok wydania` int(11)
,`numer egzemplarza` int(11)
,`autor_imie` varchar(20)
,`autor_nazwisko` varchar(32)
,`Nazwa kategorii` varchar(32)
,`id wypozyczenia` int(11)
,`login_usr` varchar(32)
,`imie_d` varchar(32)
,`nazwisko_d` varchar(32)
);

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `wyp_dla_user`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `wyp_dla_user` (
`autor_imie` varchar(20)
,`autor_nazwisko` varchar(32)
,`tytul` varchar(255)
,`data wypozyczenia` date
,`przewidywana data zwrotu` date
,`rzeczywista data zwrotu` date
,`id wypozyczenia` int(11)
,`login_usr` varchar(32)
);

-- --------------------------------------------------------

--
-- Struktura widoku `ksiazka_widok`
--
DROP TABLE IF EXISTS `ksiazka_widok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ksiazka_widok`  AS  select `ksiazka`.`id ksiazki` AS `id ksiazki`,`ksiazka`.`tytul` AS `tytul`,`ksiazka`.`isbn` AS `isbn`,`ksiazka`.`Rok wydania` AS `Rok wydania`,`ksiazka`.`numer egzemplarza` AS `numer egzemplarza`,`autor`.`autor_imie` AS `autor_imie`,`autor`.`autor_nazwisko` AS `autor_nazwisko`,`kategoria`.`Nazwa kategorii` AS `Nazwa kategorii` from (((`ksiazka` join `autor`) join `kategoria`) join `wydawnictwo`) where ((`ksiazka`.`id autora` = `autor`.`id autora`) and (`ksiazka`.`id kategorii` = `kategoria`.`id Kategorii`) and (`ksiazka`.`id wydawnictwa` = `wydawnictwo`.`id wydawnictwa`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `wypozyczenia_usr`
--
DROP TABLE IF EXISTS `wypozyczenia_usr`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wypozyczenia_usr`  AS  select `ksiazka`.`id ksiazki` AS `id ksiazki`,`ksiazka`.`tytul` AS `tytul`,`ksiazka`.`isbn` AS `isbn`,`ksiazka`.`Rok wydania` AS `Rok wydania`,`ksiazka`.`numer egzemplarza` AS `numer egzemplarza`,`autor`.`autor_imie` AS `autor_imie`,`autor`.`autor_nazwisko` AS `autor_nazwisko`,`kategoria`.`Nazwa kategorii` AS `Nazwa kategorii`,`wypozyczenia`.`id wypozyczenia` AS `id wypozyczenia`,`uzytkownik`.`login_usr` AS `login_usr`,`dane`.`imie_d` AS `imie_d`,`dane`.`nazwisko_d` AS `nazwisko_d` from ((((((`ksiazka` join `autor`) join `kategoria`) join `wypozyczenia`) join `uzytkownik`) join `dane`) join `wydawnictwo`) where ((`wypozyczenia`.`id ksiazki` = `ksiazka`.`id ksiazki`) and (`wypozyczenia`.`id uzytkownika` = `uzytkownik`.`id uzytkownika`) and (`ksiazka`.`id autora` = `autor`.`id autora`) and (`ksiazka`.`id kategorii` = `kategoria`.`id Kategorii`) and (`ksiazka`.`id wydawnictwa` = `wydawnictwo`.`id wydawnictwa`) and (`uzytkownik`.`login_usr` = `dane`.`login_d`)) ;

-- --------------------------------------------------------

--
-- Struktura widoku `wyp_dla_user`
--
DROP TABLE IF EXISTS `wyp_dla_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wyp_dla_user`  AS  select `autor`.`autor_imie` AS `autor_imie`,`autor`.`autor_nazwisko` AS `autor_nazwisko`,`ksiazka`.`tytul` AS `tytul`,`wypozyczenia`.`data wypozyczenia` AS `data wypozyczenia`,`wypozyczenia`.`przewidywana data zwrotu` AS `przewidywana data zwrotu`,`wypozyczenia`.`rzeczywista data zwrotu` AS `rzeczywista data zwrotu`,`wypozyczenia`.`id wypozyczenia` AS `id wypozyczenia`,`uzytkownik`.`login_usr` AS `login_usr` from (((`autor` join `ksiazka`) join `wypozyczenia`) join `uzytkownik`) where ((`wypozyczenia`.`id ksiazki` = `ksiazka`.`id ksiazki`) and (`wypozyczenia`.`id uzytkownika` = `uzytkownik`.`id uzytkownika`) and (`ksiazka`.`id autora` = `autor`.`id autora`)) ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`id adres`);

--
-- Indeksy dla tabeli `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id autora`);

--
-- Indeksy dla tabeli `dane`
--
ALTER TABLE `dane`
  ADD PRIMARY KEY (`login_d`) USING BTREE,
  ADD KEY `id adres` (`id adres`);

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id Kategorii`);

--
-- Indeksy dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  ADD PRIMARY KEY (`id ksiazki`),
  ADD KEY `id autora` (`id autora`) USING BTREE,
  ADD KEY `id kategorii` (`id kategorii`),
  ADD KEY `id wydawnictwa` (`id wydawnictwa`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id uzytkownika`),
  ADD KEY `login` (`login_usr`);

--
-- Indeksy dla tabeli `wydawnictwo`
--
ALTER TABLE `wydawnictwo`
  ADD PRIMARY KEY (`id wydawnictwa`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`id wypozyczenia`),
  ADD KEY `id użytkownika` (`id uzytkownika`),
  ADD KEY `id książki` (`id ksiazki`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `autor`
--
ALTER TABLE `autor`
  MODIFY `id autora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id Kategorii` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  MODIFY `id ksiazki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id uzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `wydawnictwo`
--
ALTER TABLE `wydawnictwo`
  MODIFY `id wydawnictwa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `id wypozyczenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `dane`
--
ALTER TABLE `dane`
  ADD CONSTRAINT `dane_ibfk_1` FOREIGN KEY (`login_d`) REFERENCES `uzytkownik` (`login_usr`),
  ADD CONSTRAINT `dane_ibfk_2` FOREIGN KEY (`id adres`) REFERENCES `adres` (`id adres`);

--
-- Ograniczenia dla tabeli `ksiazka`
--
ALTER TABLE `ksiazka`
  ADD CONSTRAINT `ksiazka_ibfk_1` FOREIGN KEY (`id autora`) REFERENCES `autor` (`id autora`),
  ADD CONSTRAINT `ksiazka_ibfk_2` FOREIGN KEY (`id kategorii`) REFERENCES `kategoria` (`id Kategorii`),
  ADD CONSTRAINT `ksiazka_ibfk_3` FOREIGN KEY (`id wydawnictwa`) REFERENCES `wydawnictwo` (`id wydawnictwa`);

--
-- Ograniczenia dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_2` FOREIGN KEY (`id uzytkownika`) REFERENCES `uzytkownik` (`id uzytkownika`),
  ADD CONSTRAINT `wypozyczenia_ibfk_3` FOREIGN KEY (`id ksiazki`) REFERENCES `ksiazka` (`id ksiazki`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
