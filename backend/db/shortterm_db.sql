-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 03, 2024 alle 09:57
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shortterm_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `flat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `bookings`
--

INSERT INTO `bookings` (`id`, `start_date`, `end_date`, `flat_id`, `user_id`) VALUES
(48, '2024-01-01', '2024-01-03', 2, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `flats`
--

CREATE TABLE `flats` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `flats`
--

INSERT INTO `flats` (`id`, `name`, `price`, `photo`, `owner_id`, `location`) VALUES
(2, 'cozy flat', 30, 'cozy.jpg', 1, 'Berlin'),
(3, 'sunny space', 20, 'sunny.jpg', 1, 'Vienna'),
(4, 'lucky place', 90, 'nice.jpg', 1, 'Salzburg');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email_address` varchar(50) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `password` varchar(300) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `email_address`, `password`, `role`) VALUES
(4, 'laktaouimohammed@outlook.com', '$2y$10$cn3EAASus153prdXC2Z/lObETAS06RWbDTjt93AQ55ah.jHSWGwqK', 'USER'),
(5, 'wi21b073@technikum-wien.at', '$2y$10$E0xrKjnpnu8NQzVwTsOiZuhuJcmjVgwUSyZJBeHEOLA2/9dDH8/0a', 'USER'),
(6, 'admin@admin.com', '$2y$10$K4YKLzQPo8tsLrurSGPsHuoxVzd9wr9i5H62W2SxkxoGOg1cDHmUO', 'ADMIN'),
(7, 'user@user.com', '$2y$10$zpXMZy6BMi4/.DezB2yKsu9BtNr.yMrk.mCi.P2jPvNh95BqPev/G', 'USER'),
(11, 'user4@user.com', '$2y$10$UwpKF0huQuYaf9sOZYqcFu21Cd84oFbFxZwr/uxcjw5d7a6GLPesK', 'USER'),
(12, 'user2@user.com', '$2y$10$R3v52mJgRftGCAjVns0QOuEMaK1H7r7XyB9tjUeWtbZs9sLttBuP6', 'USER');




--
-- Indici per le tabelle `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user` (`user_id`),
  ADD KEY `bookings_flat` (`flat_id`);

--
-- Indici per le tabelle `flats`
--
ALTER TABLE `flats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flats_owner` (`owner_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT per la tabella `flats`
--
ALTER TABLE `flats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_flat` FOREIGN KEY (`flat_id`) REFERENCES `flats` (`id`),
  ADD CONSTRAINT `bookings_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limiti per la tabella `flats`
--
ALTER TABLE `flats`
  ADD CONSTRAINT `flats_owner` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




--
-- Create Table `availabilities`erst erstellen nachdem alles andere erstellt wurde
--


CREATE TABLE `availabilities` (
  `id` int(11) NOT NULL,
  `flat_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `flat_id` (`flat_id`),
  CONSTRAINT `availabilities_flats` FOREIGN KEY (`flat_id`) REFERENCES `flats` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

