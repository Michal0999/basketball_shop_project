-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 18 Sty 2019, 17:43
-- Wersja serwera: 5.7.23
-- Wersja PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `inz`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `id_koszyka` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id_produktu` int(11) NOT NULL,
  `nazwa_produktu` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `ulica` text COLLATE utf8_polish_ci NOT NULL,
  `mieszkanie` text COLLATE utf8_polish_ci NOT NULL,
  `kod` text COLLATE utf8_polish_ci NOT NULL,
  `kraj` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `email`, `haslo`, `imie`, `nazwisko`, `ulica`, `mieszkanie`, `kod`, `kraj`) VALUES
(2, 'michal@gmail.com', '$2y$10$3ta6f5bXdZ44WPJB6H8SH.xwc7UJHPfAJmnCOSUrU8m0vPiN1Ll2C', 'Michał', 'Konatkowski', 'Polna 5a', '14', '26-200 Końskie', 'Polska'),
(3, 'asd@gmail.com', '$2y$10$/t0cbsuCVtksM0GM2DZwi.5a8iH5IKtPA/TTsUAWrB/S93l8u8wLG', 'Jan', 'Kowalski', 'Słoneczka', '120', '23-123 NiuJork', 'Afgan'),
(4, '1@gmail.com', '$2y$10$rYzrGCdew7mg69KmI3vwXeqRtVUKe/fR2WomysfUPaQWfGpS4sZba', 'Adam', 'Nowak', 'Główna 20', '12a', '26-200 Końskie', 'Polska'),
(5, 'qwerty@gmail.com', '$2y$10$4me1h9DevbdNH1OHMUbgcuSs0UqMNRlaOLl5KXpcZKLpxaBi6dbJe', 'qwerty', 'qwerty', 'qwerty', 'qwerty 54', '102', 'Polska'),
(6, 'jan.kowalski@gmail.com', '$2y$10$9zb7.s6go8T0sznY1d8j/Oh1z29j9bU72jZ1XdAnSRFxavOw3vxju', 'Jan', 'Kowalski', 'Słoneczna 5b', '156', '12-123 Warszawa', 'Polska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienie`
--

CREATE TABLE `zamowienie` (
  `id_zamowienia` int(11) NOT NULL,
  `id_koszyka` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`id_koszyka`),
  ADD KEY `id_produktu` (`id_produktu`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id_produktu`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`id_zamowienia`),
  ADD KEY `id_koszyka` (`id_koszyka`),
  ADD KEY `zamowienie_ibfk_2` (`id_uzytkownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `id_koszyka` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id_produktu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `koszyk_ibfk_1` FOREIGN KEY (`id_produktu`) REFERENCES `produkty` (`id_produktu`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD CONSTRAINT `zamowienie_ibfk_1` FOREIGN KEY (`id_koszyka`) REFERENCES `koszyk` (`id_koszyka`) ON DELETE CASCADE,
  ADD CONSTRAINT `zamowienie_ibfk_2` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
