-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 jul 2023 om 11:04
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `description`, `ingredient_name`, `ingredient_image`, `price`, `stock`) VALUES
(1, 'oh ma gawd', 'ananasstukj', 'ananasStukjes.jpg', 0.50, 100),
(2, 'stukjes salami voor op je pizza, komt in setjes van 5', 'salami', '../images/salami.jpg', 1.00, 250),
(4, 'prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto prosciutto', 'prosciutto', '../images/prosciutto.jpg', 1.50, 50),
(7, '250 gram kaas voor als kaas op je bodem niet genoeg is', 'kaas', '../images/kaas.jpg', 0.75, 300);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` bigint(20) NOT NULL,
  `order_date` date DEFAULT current_timestamp(),
  `user_id` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `order_date`, `user_id`) VALUES
(1, '2023-06-26', 5),
(2, '2023-06-26', 5),
(3, '2023-06-26', 5),
(4, '2023-06-26', 5),
(5, '2023-06-29', 5),
(6, '2023-06-30', 6),
(7, '2023-07-06', 6),
(8, '2023-07-06', 6),
(9, '2023-07-06', 6),
(10, '2023-07-06', 6),
(11, '2023-07-06', 6),
(12, '2023-07-06', 6),
(13, '2023-07-06', 6),
(14, '2023-07-06', 6);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `invoice_line`
--

INSERT INTO `invoice_line` (`invoice_line_id`, `user_id`, `product_id`, `ingredient_id`, `product_amount`, `product_size`, `ingredient_amount`) VALUES
(1, 5, 1, NULL, 4, 'calzone', NULL),
(2, 5, 2, NULL, 20, 'large', NULL),
(3, 5, 1, NULL, 2, 'large', NULL),
(4, 5, 2, NULL, 0, 'medium', NULL),
(5, 5, 1, NULL, 4, 'calzone', NULL),
(6, 5, 2, NULL, 20, 'large', NULL),
(7, 5, 1, NULL, 2, 'large', NULL),
(8, 5, 2, NULL, 0, 'medium', NULL),
(9, 5, 1, NULL, 2, 'medium', NULL),
(10, 5, 3, NULL, 4, 'large', NULL),
(11, 5, 3, NULL, 1, 'calzone', NULL),
(12, 5, 1, NULL, 10, 'large', NULL),
(13, 5, 2, NULL, 10, 'large', NULL),
(14, 6, 1, NULL, 10, 'calzone', NULL),
(15, 6, 2, NULL, 5, 'large', NULL),
(16, 6, 1, NULL, 10, 'large', NULL),
(17, 6, NULL, NULL, 10, NULL, NULL),
(18, 6, 1, NULL, 10, 'large', NULL),
(19, 6, NULL, NULL, 50, NULL, NULL),
(20, 6, 1, NULL, 10, 'large', NULL),
(21, 6, NULL, 2, NULL, NULL, 5),
(22, 6, 1, NULL, 15, 'large', NULL),
(23, 6, NULL, 2, NULL, NULL, 50),
(24, 6, 1, NULL, 20, 'large', NULL),
(25, 6, NULL, 4, NULL, NULL, 5),
(26, 6, 1, NULL, 25, 'large', NULL),
(27, 6, NULL, 7, NULL, NULL, 1),
(28, 6, 1, NULL, 30, 'large', NULL),
(29, 6, NULL, 1, NULL, NULL, 1),
(30, 6, 1, NULL, 40, 'large', NULL),
(31, 6, NULL, 1, NULL, NULL, 5);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`product_id`, `description`, `product_name`, `product_image`, `size`, `price`) VALUES
(1, 'overheerlijke pizza met ananas!! zoals het hoort..', 'hawaii', '../images/pizzaHawaii.jpg', NULL, 5.95),
(2, 'pizza met salami, voor als je van wieners houdt.', 'salami', '../images/pizzaSalami.jpg', NULL, 3.95),
(3, 'pizza met extra kaas, voor de echte Hollanders', 'margherita', '../images/pizzaMargherita.jpg', NULL, 7.95),
(4, 'pizza met prosciutto, echte Italiaanse pizza.', 'prosciutto', '../images/pizzaProsciutto.jpg', NULL, 10.95);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `is_admin`, `created_at`) VALUES
(4, 'max', '$2y$10$HayVs60NY8sPTnK/TKywZ.E.tyASeRzS62EEfII7MChpSQ0gk.2fe', 0, '2023-06-23 11:16:07'),
(5, NULL, '$2y$10$RXgaedZV/5CfS7nQAy5FVePdBbK69JEI9DM..l.rj.au7h3MVjKXq', 0, '2023-06-23 11:25:32'),
(6, 'qwerty', '$2y$10$RN4hrnV6JubGoFRQSqkoc.rBnU64ozxKVaumvDr1EKcT0AVuctyrS', 0, '2023-06-30 11:35:55'),
(7, 'admin', '$2y$10$8/jQyq517.JOBlrvUaShre3BiMLk3TDtV955ksV07a9IFCrU6rfs.', 1, '2023-07-06 09:09:01');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_order_address`
--

CREATE TABLE `user_order_address` (
  `user_address_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `ingredient_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `invoice_line`
--
ALTER TABLE `invoice_line`
  MODIFY `invoice_line_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
