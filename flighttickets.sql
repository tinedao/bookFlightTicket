-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 04:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flighttickets`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `userAd` varchar(255) NOT NULL,
  `passwordAd` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userAd`, `passwordAd`, `role`) VALUES
('admin', '$2y$10$tZn/p52N29EGVFgQws6roe666uXIvv8eNYG7FG4.YoRCShXF8xsXy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `airline_id` int(11) NOT NULL,
  `airline_code` varchar(10) NOT NULL,
  `airline_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`airline_id`, `airline_code`, `airline_name`) VALUES
(3, 'VNA', 'Vietnam Airlines'),
(4, 'BBA', 'Bamboo Airways'),
(5, 'VJA', 'VietJet Air'),
(6, 'JPA', 'Jetstar Pacific Airlines');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `paid` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `email` varchar(244) NOT NULL,
  `phonenumber` varchar(244) NOT NULL,
  `message` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `email`, `phonenumber`, `message`) VALUES
(1, 'tine.dao19@gmail.com', '0979499802', 'Trang web thật bổ X và thú zật');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `type_ticket` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `type_ticket`) VALUES
(1, 'Ha Noi', 1),
(2, 'Ho Chi Minh City', 1),
(3, 'Da Nang', 1),
(4, 'Phu Quoc', 1),
(5, 'Nha Trang', 1),
(6, 'Seoul (Korean)', 2),
(7, 'Tokyo (Japan)', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `departure` int(11) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL,
  `airline_code` varchar(10) DEFAULT NULL,
  `departure_time` datetime DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `remaining` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `departure`, `destination`, `airline_code`, `departure_time`, `price`, `discount`, `remaining`) VALUES
(1, 1, 2, 'VNA', '2024-11-01 10:00:00', 150.00, 0.10, 100),
(2, 3, 4, 'BBA', '2024-11-02 12:00:00', 120.00, 0.15, 50),
(3, 2, 5, 'VJA', '2024-11-03 15:00:00', 100.00, 0.05, 200),
(4, 1, 6, 'VJA', '2024-11-15 04:58:32', 5000.00, 0.00, 10);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ticket_cart_view`
-- (See below for the actual view)
--
CREATE TABLE `ticket_cart_view` (
`ticket_id` int(11)
,`departure` varchar(255)
,`destination` varchar(255)
,`airline_code` varchar(10)
,`airline_name` varchar(255)
,`departure_time` datetime
,`price` decimal(10,2)
,`discount` decimal(5,2)
,`quantity` int(11)
,`paid` tinyint(1)
,`username` varchar(255)
,`total_price` decimal(26,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ticket_view`
-- (See below for the actual view)
--
CREATE TABLE `ticket_view` (
`ticket_id` int(11)
,`departure` varchar(255)
,`destination` varchar(255)
,`airline_code` varchar(10)
,`airline_name` varchar(255)
,`departure_time` datetime
,`price` decimal(10,2)
,`discount` decimal(5,2)
,`remaining` int(11)
,`departure_type_ticket` tinyint(4)
,`destination_type_ticket` tinyint(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `wallet` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `phone`, `dob`, `password`, `full_name`, `wallet`) VALUES
('tine19', 'tine.dao19@gmail.com', '0979499802', '2002-11-07', '$2y$10$/Njcwr.7t7ect6xq.292iuSUKzr6FE.ey6Zeo/LvTRlrnS1Q/kogu', 'Đào Quang Tiến', 10000.00);

-- --------------------------------------------------------

--
-- Structure for view `ticket_cart_view`
--
DROP TABLE IF EXISTS `ticket_cart_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ticket_cart_view`  AS SELECT `t`.`ticket_id` AS `ticket_id`, `l1`.`location_name` AS `departure`, `l2`.`location_name` AS `destination`, `t`.`airline_code` AS `airline_code`, `a`.`airline_name` AS `airline_name`, `t`.`departure_time` AS `departure_time`, `t`.`price` AS `price`, `t`.`discount` AS `discount`, `c`.`quantity` AS `quantity`, `c`.`paid` AS `paid`, `c`.`username` AS `username`, `t`.`price`* `c`.`quantity` * (1 - `t`.`discount`) AS `total_price` FROM ((((`tickets` `t` join `locations` `l1` on(`t`.`departure` = `l1`.`location_id`)) join `locations` `l2` on(`t`.`destination` = `l2`.`location_id`)) join `airlines` `a` on(`t`.`airline_code` = `a`.`airline_code`)) left join `cart` `c` on(`t`.`ticket_id` = `c`.`ticket_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `ticket_view`
--
DROP TABLE IF EXISTS `ticket_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ticket_view`  AS SELECT `t`.`ticket_id` AS `ticket_id`, `l1`.`location_name` AS `departure`, `l2`.`location_name` AS `destination`, `t`.`airline_code` AS `airline_code`, `a`.`airline_name` AS `airline_name`, `t`.`departure_time` AS `departure_time`, `t`.`price` AS `price`, `t`.`discount` AS `discount`, `t`.`remaining` AS `remaining`, `l1`.`type_ticket` AS `departure_type_ticket`, `l2`.`type_ticket` AS `destination_type_ticket` FROM (((`tickets` `t` join `locations` `l1` on(`t`.`departure` = `l1`.`location_id`)) join `locations` `l2` on(`t`.`destination` = `l2`.`location_id`)) join `airlines` `a` on(`t`.`airline_code` = `a`.`airline_code`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`userAd`),
  ADD UNIQUE KEY `userAd` (`userAd`);

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airline_id`),
  ADD UNIQUE KEY `airline_code` (`airline_code`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `username` (`username`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `quantity` (`quantity`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `location_name` (`location_name`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `departure` (`departure`),
  ADD KEY `destination` (`destination`),
  ADD KEY `airline_code` (`airline_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`departure`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`destination`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`airline_code`) REFERENCES `airlines` (`airline_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
