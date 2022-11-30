-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 30, 2022 alle 16:27
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nethoc_main_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `FK_userID` int(11) NOT NULL,
  `FK_serviceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL,
  `FK_userID` int(11) NOT NULL,
  `FK_serviceID` int(11) NOT NULL,
  `transaction_code` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `services_internet`
--

CREATE TABLE `services_internet` (
  `serviceID` int(11) NOT NULL,
  `service_name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `advantage_1` text NOT NULL,
  `advantage_2` text DEFAULT NULL,
  `advantage_3` text DEFAULT NULL,
  `price` float NOT NULL,
  `img_path` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `services_internet`
--

INSERT INTO `services_internet` (`serviceID`, `service_name`, `description`, `advantage_1`, `advantage_2`, `advantage_3`, `price`, `img_path`) VALUES
(0, 'netHOC Live Pro', 'Ti permette di avere una connessione fino a 1 Gbit/s mediante rete GPON (FTTH)', 'Portata illimitata grazie alla fibra ottica multimodale fino a casa', 'Assistenza gratuita 24/7', NULL, 52.99, 'img/services/internet/live_pro.jpg'),
(1, 'netHOC Live Gold', 'Ti permette di avere una connessione fino a 50 Mbit/s mediante VDSL2 (FTTC)', 'Capacità fino a 50Mbit/s in downstream', 'Capacità fino a 20Mbit/s in upstream', 'Assistenza gratuita 24/7', 36.99, 'img/services/internet/live_gold.jpg'),
(2, 'netHOC Livemobile 5G', 'Naviga al massimo con la velocità dell\'5GNR, sfrutta a pieno la nuova tecnologia', 'Banda oltre il Gbit/s', 'Assistenza gratuita 24/7', NULL, 15, 'img/services/internet/livemobile_5g.jpg'),
(3, 'netHOC Livemobile 4G+', 'Usa la consolidata rete LTE+ al massimo delle prestazioni con noi', 'Banda a 100Mbit/s sulle zone con massima copertura', 'Assistenza gratuita 24/7', NULL, 7, 'img/services/internet/livemobile_4g.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstname` varchar(10) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `residence` varchar(30) NOT NULL,
  `city` varchar(20) NOT NULL,
  `cap` varchar(5) NOT NULL,
  `cf` varchar(16) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`userID`, `firstname`, `lastname`, `email`, `password`, `salt`, `residence`, `city`, `cap`, `cf`, `type`) VALUES
(8, 'Admin', 'Admin_', 'admin@nethoc.hyper', '7cdf12b80fedd7f1aee8e7b9065b1cb7', '884301820', '---', '---', '00000', 'RSSMRA70A41F205Z', 0),
(12, 'Gianni', 'Moreno', 'test@testino.com', '28df2e51a85b4d0efc9cb2737cae2ef0', '188704862', 'Via del test 15', 'Testina', '12345', 'RSSMRA70A41F205Z', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `users.FK_userID` (`FK_userID`),
  ADD KEY `services_internet.FK_serviceID` (`FK_serviceID`);

--
-- Indici per le tabelle `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `fk_user_id` (`FK_userID`),
  ADD KEY `fk_service_id` (`FK_serviceID`);

--
-- Indici per le tabelle `services_internet`
--
ALTER TABLE `services_internet`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT per la tabella `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT per la tabella `services_internet`
--
ALTER TABLE `services_internet`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_service_id` FOREIGN KEY (`FK_serviceID`) REFERENCES `services_internet` (`serviceID`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`FK_userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
