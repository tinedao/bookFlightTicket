-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 31, 2024 lúc 11:10 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `flighttickets`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `userAd` varchar(255) NOT NULL,
  `passwordAd` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`userAd`, `passwordAd`, `role`) VALUES
('admin', '$2y$10$tZn/p52N29EGVFgQws6roe666uXIvv8eNYG7FG4.YoRCShXF8xsXy', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `airlines`
--

CREATE TABLE `airlines` (
  `airline_id` int(11) NOT NULL,
  `airline_code` varchar(10) NOT NULL,
  `airline_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `airlines`
--

INSERT INTO `airlines` (`airline_id`, `airline_code`, `airline_name`) VALUES
(3, 'VNA', 'Vietnam Airlines'),
(4, 'BBA', 'Bamboo Airways'),
(5, 'VJA', 'VietJet Air'),
(6, 'JPA', 'Jetstar Pacific Airlines');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `email` varchar(244) NOT NULL,
  `phonenumber` varchar(244) NOT NULL,
  `message` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contactus`
--

INSERT INTO `contactus` (`id`, `email`, `phonenumber`, `message`) VALUES
(1, 'tine.dao19@gmail.com', '0979499802', 'Trang web thật bổ X và thú zật');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `type_ticket` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `locations`
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
-- Cấu trúc bảng cho bảng `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `departure` int(11) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL,
  `airline_code` varchar(10) DEFAULT NULL,
  `departure_time` datetime DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `departure`, `destination`, `airline_code`, `departure_time`, `price`, `discount`) VALUES
(1, 1, 2, 'VNA', '2024-11-01 10:00:00', 150.00, 0.10),
(2, 3, 4, 'BBA', '2024-11-02 12:00:00', 120.00, 0.15),
(3, 2, 5, 'VJA', '2024-11-03 15:00:00', 100.00, 0.05),
(4, 1, 6, 'VJA', '2024-11-15 04:58:32', 5000.00, 0.00);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `ticket_view`
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
,`departure_type_ticket` tinyint(4)
,`destination_type_ticket` tinyint(4)
);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `email`, `phone`, `dob`, `password`, `full_name`) VALUES
('tine19', 'tine.dao19@gmail.com', '0979499802', '2002-11-07', '$2y$10$1kE31x/3tO0zytIDuYP3zu2HTxfZUJ/o4e.TXy273r7WM0rr3WtmO', 'Đào Quang Tiến');

-- --------------------------------------------------------

--
-- Cấu trúc cho view `ticket_view`
--
DROP TABLE IF EXISTS `ticket_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ticket_view`  AS SELECT `t`.`ticket_id` AS `ticket_id`, `l1`.`location_name` AS `departure`, `l2`.`location_name` AS `destination`, `t`.`airline_code` AS `airline_code`, `a`.`airline_name` AS `airline_name`, `t`.`departure_time` AS `departure_time`, `t`.`price` AS `price`, `t`.`discount` AS `discount`, `l1`.`type_ticket` AS `departure_type_ticket`, `l2`.`type_ticket` AS `destination_type_ticket` FROM (((`tickets` `t` join `locations` `l1` on(`t`.`departure` = `l1`.`location_id`)) join `locations` `l2` on(`t`.`destination` = `l2`.`location_id`)) join `airlines` `a` on(`t`.`airline_code` = `a`.`airline_code`)) ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`userAd`),
  ADD UNIQUE KEY `userAd` (`userAd`);

--
-- Chỉ mục cho bảng `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airline_id`),
  ADD UNIQUE KEY `airline_code` (`airline_code`);

--
-- Chỉ mục cho bảng `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `location_name` (`location_name`);

--
-- Chỉ mục cho bảng `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `departure` (`departure`),
  ADD KEY `destination` (`destination`),
  ADD KEY `airline_code` (`airline_code`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`departure`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`destination`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`airline_code`) REFERENCES `airlines` (`airline_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
