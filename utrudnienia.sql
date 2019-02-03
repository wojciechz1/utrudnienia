-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 18 Sty 2016, 22:22
-- Wersja serwera: 5.5.10
-- Wersja PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `utrudnienia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `komentarze`
--

CREATE TABLE IF NOT EXISTS `komentarze` (
  `id_komentarza` int(11) NOT NULL AUTO_INCREMENT,
  `id_uzytkownika` int(11) NOT NULL,
  `id_linii` int(11) NOT NULL,
  `tresc_komentarza` text NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id_komentarza`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `komentarze`
--

INSERT INTO `komentarze` (`id_komentarza`, `id_uzytkownika`, `id_linii`, `tresc_komentarza`, `data`) VALUES
(1, 1, 1, 'prowadzimy testy systemu', '2016-01-14 00:34:47'),
(2, 2, 1, 'Pociąg nr 40615 z Gliwic do Częstochowy wjechał na leżący na torach fragment ogrodzenia w okolicach stacji Ruda Chebzie... Ciekawe ile potrwa postój?', '2016-01-14 00:48:25'),
(3, 2, 1, 'Pociąg 40615 został odwołany, przesiadamy się do 40617...', '2016-01-14 00:49:00'),
(4, 1, 7, 'Przepraszamy za utrudnienia na linii S6', '2016-01-14 00:50:18'),
(5, 2, 1, 'W pociągu 44021 nie działa ogrzewanie! Skandal!!!', '2016-01-16 19:51:55');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `komunikaty`
--

CREATE TABLE IF NOT EXISTS `komunikaty` (
  `id_komunikatu` int(11) NOT NULL AUTO_INCREMENT,
  `id_linii` int(11) DEFAULT NULL,
  `nr_pociagu` varchar(50) DEFAULT NULL,
  `rodzaj_utrudnienia` int(11) DEFAULT NULL,
  `tresc_komunikatu` text NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id_komunikatu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `komunikaty`
--

INSERT INTO `komunikaty` (`id_komunikatu`, `id_linii`, `nr_pociagu`, `rodzaj_utrudnienia`, `tresc_komunikatu`, `data`) VALUES
(1, 8, '44168', 1, 'Pociąg nr 44168 relacji Racibórz (4:38) - Katowice (6:28) z przyczyn technicznych jest opóźniony około 15 minut. Opóźnienie pociągu może ulec zmianie.', '2016-01-12 23:18:18'),
(2, 1, '40618', 1, 'Pociąg nr 40618  relacji Gliwice 11:14  - Częstochowa 13:17 opóźniony około 15 minut z powodu oczekiwania na pogotowie. Opóźnienie pociągu może ulec zmianie.', '2016-01-12 23:18:43'),
(3, 1, '44043', 1, 'Pociąg nr 44043 relacji Częstochowa ( 19:41 ) - Katowice ( 21:11) jest opóźniony ok.15 minut z przyczyn technicznych.Opóźnienie tego pociągu może ulec zmianie.', '2016-01-12 23:19:50'),
(4, 5, '49732', 1, 'Pociąg nr 49732 relacji Zwardoń ( 19.56 )  - Katowice ( 22.47 ) z powodu interwencji pogotowia ratunkowego w stacji Pszczyna jedzie z ok.10 minutowym opóźnieniem.', '2016-01-12 23:20:24'),
(5, 1, '', 3, 'Pociągi na linii S1 Gliwice - Częstochowa mogą doznawać 5 - 10 minutowych opóźnień ze względu na telefoniczne zapowiadanie pociągów w stacji Ruda Chebzie.', '2016-01-12 23:20:45'),
(6, 4, '44216', 2, 'Pociąg nr 44216 relacji Tychy Lodowisko (21:36) - Katowice (22:05) z przyczyn technicznych został odwołany na odcinku Tychy Grota Roweckiego - Katowice podróżni przesiądą się do pociągu 44218 relacji Tychy Lodowisko (22:40) - Katowice (23:02).', '2016-01-12 23:21:41'),
(7, 0, '', 3, 'W okresie zimowym pociagi mogą doznawać większych opóźnień niż zwykle', '2016-01-12 23:25:30'),
(8, 1, '40734', 1, 'Pociąg nr 40734 relacji  Gliwice 06:55 - Zawiercie 08:21 odjedzie opóźniony około 12 min ze stacji Dąbrowa Górnicza Ząbkowice z powodu oczekiwania na pociąg innego przewoźnika.', '2016-01-14 00:35:24'),
(9, 11, '94920', 1, 'Pociąg nr 94920 relacji Bohumin (19.00) - Racibórz (19.58) jest opóźniony około 60 minut  z przyczyn technicznych w stacji Chałupki.Opóźnienie tego pociągu może ulec zmianie.', '2016-01-14 00:35:53');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `linie`
--

CREATE TABLE IF NOT EXISTS `linie` (
  `id_linii` int(11) NOT NULL AUTO_INCREMENT,
  `nr_linii` varchar(10) NOT NULL,
  `relacja` varchar(50) NOT NULL,
  PRIMARY KEY (`id_linii`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `linie`
--

INSERT INTO `linie` (`id_linii`, `nr_linii`, `relacja`) VALUES
(1, 'S1', 'Gliwice - Częstochowa'),
(2, 'S13', 'Częstochowa - Lubliniec'),
(3, 'S31', 'Katowice - Oświęcim'),
(4, 'S4', 'Tychy Lodowisko - Sosnowiec Główny'),
(5, 'S5', 'Katowice - Zwardoń'),
(6, 'S58', 'Czechowice-Dziedzice - Cieszyn'),
(7, 'S6', 'Katowice - Wisła Głębce'),
(8, 'S7', 'Katowice - Racibórz'),
(9, 'S71', 'Katowice - Bohumin'),
(10, 'S72', 'Wodzisław Śląski - Pszczyna'),
(11, 'S78', 'Racibórz - Bohumin'),
(12, 'S8', 'Katowice - Lubliniec');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `rodzaje_utrudnien`
--

CREATE TABLE IF NOT EXISTS `rodzaje_utrudnien` (
  `rodzaj_utrudnienia` int(11) NOT NULL,
  `nazwa` varchar(25) NOT NULL,
  PRIMARY KEY (`rodzaj_utrudnienia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `rodzaje_utrudnien`
--

INSERT INTO `rodzaje_utrudnien` (`rodzaj_utrudnienia`, `nazwa`) VALUES
(1, 'Opóźnienie pociągu'),
(2, 'Odwołanie pociągu'),
(3, 'Komunikat');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `ulubione`
--

CREATE TABLE IF NOT EXISTS `ulubione` (
  `id_uzytkownika` int(11) NOT NULL,
  `id_linii` int(11) NOT NULL,
  PRIMARY KEY (`id_uzytkownika`,`id_linii`)
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `ulubione`
--

INSERT INTO `ulubione` (`id_uzytkownika`, `id_linii`) VALUES
(1, 1),
(1, 5),
(2, 1),
(2, 4),
(2, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id_uzytkownika` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL,
  `administrator` bit(1) NOT NULL,
  PRIMARY KEY (`id_uzytkownika`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id_uzytkownika`, `login`, `haslo`, `email`, `administrator`) VALUES
(1, 'admin', 'test', 'test@test.pl', '1'),
(2, 'wojtek', 'test', 'wojtek@test.pl', '0'),
(3, 'testowy_wojtek', 'bumbum', 'test@op.pl', '0');
