-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 jun 2023 om 23:09
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corcalzpizza`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_id` bigint(20) NOT NULL,
  `description` text DEFAULT NULL,
  `ingredient_name` varchar(50) DEFAULT NULL,
  `ingredient_image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `description`, `ingredient_name`, `ingredient_image`, `price`, `stock`) VALUES
(1, 'yammie yammie,\r\noverheerlijke stukjes \r\nananas voor op jouw \r\npizza', 'ananasstukjes', '../images/ananasStukjes.jpg', '0.50', 100),
(2, 'stukjes salami voor op je pizza, komt in setjes van 5', 'salami', '../images/salami.jpg', '1.00', 250),
(3, '250 gram kaas voor als kaas op je bodem niet genoeg is', 'kaas', '../images/kaas.jpg', '0.75', 300),
(4, 'prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto', 'prosciutto', '../images/prosciutto.jpg', '1.50', 50),
(5, 'yammie yammie,\r\noverheerlijke stukjes \r\nananas voor op jouw \r\npizza', 'ananasstukjes', '../images/ananasStukjes.jpg', '0.50', 100),
(6, 'stukjes salami voor op je pizza, komt in setjes van 5', 'salami', '../images/salami.jpg', '1.00', 250),
(7, '250 gram kaas voor als kaas op je bodem niet genoeg is', 'kaas', '../images/kaas.jpg', '0.75', 300),
(8, 'prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto', 'prosciutto', '../images/prosciutto.jpg', '1.50', 50),
(9, 'yammie yammie,\r\noverheerlijke stukjes \r\nananas voor op jouw \r\npizza', 'ananasstukjes', '../images/ananasStukjes.jpg', '0.50', 100);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` bigint(20) NOT NULL,
  `order_date` date DEFAULT NULL,
  `user_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `invoice_line`
--

CREATE TABLE `invoice_line` (
  `invoice_line_id` bigint(20) NOT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `ingredient_id` bigint(20) DEFAULT NULL,
  `product_amount` mediumint(9) DEFAULT NULL,
  `product_size` varchar(7) DEFAULT NULL,
  `ingredient_amount` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL,
  `description` text DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `size` varchar(7) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`product_id`, `description`, `product_name`, `product_image`, `size`, `price`) VALUES
(1, 'overheerlijke pizza met ananas!! zoals het hoort..', 'hawaii', '../images/pizzaHawaii.jpg', NULL, '5.95'),
(2, 'pizza met salami, voor als je van wieners houdt.', 'salami', '../images/pizzaSalami.jpg', NULL, '3.95'),
(3, 'pizza met extra kaas, voor de echte Hollanders', 'margherita', '../images/pizzaMargherita.jpg', NULL, '7.95'),
(4, 'pizza met prosciutto, echte Italiaanse pizza.', 'prosciutto', '../images/pizzaProsciutto.jpg', NULL, '10.95');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` mediumint(9) NOT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `is_admin`, `created_at`) VALUES
(4, 'max', '$2y$10$oPANab/VEs/yFeNRM017xOB7dUuVFrU2FkPxtFJNuTxJ15A1WevNG', 0, '2023-06-23 11:16:07'),
(5, 'roansmash', '$2y$10$RXgaedZV/5CfS7nQAy5FVePdBbK69JEI9DM..l.rj.au7h3MVjKXq', 0, '2023-06-23 11:25:32');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_order_address`
--

CREATE TABLE `user_order_address` (
  `user_address_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- Indexen voor tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `invoice_line`
--
ALTER TABLE `invoice_line`
  ADD PRIMARY KEY (`invoice_line_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexen voor tabel `user_order_address`
--
ALTER TABLE `user_order_address`
  ADD PRIMARY KEY (`user_address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `invoice_line`
--
ALTER TABLE `invoice_line`
  MODIFY `invoice_line_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `user_order_address`
--
ALTER TABLE `user_order_address`
  MODIFY `user_address_id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Beperkingen voor tabel `invoice_line`
--
ALTER TABLE `invoice_line`
  ADD CONSTRAINT `invoice_line_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `invoice_line_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `invoice_line_ibfk_3` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredient_id`);

--
-- Beperkingen voor tabel `user_order_address`
--
ALTER TABLE `user_order_address`
  ADD CONSTRAINT `user_order_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
