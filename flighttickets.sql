-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 25, 2024 lúc 10:56 PM
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
  `airline_name` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `airlines`
--

INSERT INTO `airlines` (`airline_id`, `airline_code`, `airline_name`, `img`) VALUES
(3, 'VNA', 'Vietnam Airlines', 'logoVNA.png'),
(4, 'BBA', 'Bamboo Airways', 'bamboo.jpg'),
(5, 'VJA', 'VietJet Air', 'logoVJ.png'),
(6, 'JPA', 'Jetstar Pacific Airlines', 'logoStar.png'),
(8, 'TXX', 'Texas', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `paid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `username`, `comment`, `created_at`) VALUES
(2, 37, 'tine19', 'tuyệt vậy ?', '2024-11-25 18:33:14'),
(3, 37, 'tine19', 'eo ôi', '2024-11-25 18:40:16'),
(4, 37, 'tine19', 'eo ôi chả mấy khi', '2024-11-25 18:42:57'),
(7, 37, 'tine19', 'sdfádfdsá', '2024-11-25 18:43:07'),
(8, 37, 'tine19', 'ádfdàhgádfsdf', '2024-11-25 18:43:10'),
(9, 37, 'tine19', 'ádfádhdfấd', '2024-11-25 18:43:12'),
(10, 37, 'tine19', 'àdfádfád', '2024-11-25 18:43:14'),
(11, 37, 'tine19', 'đasad', '2024-11-25 18:56:17');

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
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `thought` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `username`, `img`, `thought`, `created_at`) VALUES
(1, 'tine19', 'pexels-gabriela-palai-129458-395196.jpg', 'Câu chuyện thật tuyệt', '2024-11-24 01:55:50'),
(23, 'ocbe', 'IMG_7337.JPG', 'Choán', '2024-11-25 11:50:08'),
(37, 'tine19', '6744672c8289a.JPG', 'Ai đẹp trai thế', '2024-11-25 12:01:48');

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
  `discount` decimal(5,2) DEFAULT 0.00,
  `remaining` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `departure`, `destination`, `airline_code`, `departure_time`, `price`, `discount`, `remaining`) VALUES
(1, 1, 2, 'VNA', '2024-11-01 10:00:00', 150.00, 0.10, 100),
(3, 2, 5, 'VJA', '2024-11-03 15:00:00', 100.00, 0.05, 300),
(4, 1, 6, 'VJA', '2024-11-15 04:58:32', 5000.00, 0.00, 10),
(5, 1, 2, 'VNA', '2024-11-25 08:00:00', 100.00, 0.10, 50),
(6, 2, 3, 'BBA', '2024-11-26 10:00:00', 80.00, 0.20, 40),
(7, 3, 4, 'VJA', '2024-11-27 12:00:00', 120.00, 0.15, 30),
(8, 4, 5, 'JPA', '2024-11-28 14:00:00', 110.00, 0.05, 60),
(9, 5, 6, 'VNA', '2024-11-29 16:00:00', 90.00, 0.10, 70),
(10, 6, 7, 'BBA', '2024-11-30 18:00:00', 130.00, 0.25, 80),
(11, 7, 1, 'VJA', '2024-12-01 07:00:00', 85.00, 0.30, 90),
(12, 1, 3, 'JPA', '2024-12-02 09:00:00', 75.00, 0.05, 100),
(13, 2, 4, 'VNA', '2024-12-03 11:00:00', 95.00, 0.10, 20),
(14, 3, 5, 'BBA', '2024-12-04 13:00:00', 115.00, 0.20, 25),
(15, 4, 6, 'VJA', '2024-12-05 15:00:00', 105.00, 0.15, 35),
(16, 5, 7, 'JPA', '2024-12-06 17:00:00', 125.00, 0.10, 45),
(17, 6, 1, 'VNA', '2024-12-07 08:30:00', 70.00, 0.05, 55),
(18, 7, 2, 'BBA', '2024-12-08 10:30:00', 85.00, 0.20, 65),
(19, 1, 4, 'VJA', '2024-12-09 12:30:00', 65.00, 0.15, 75),
(20, 2, 5, 'JPA', '2024-12-10 14:30:00', 95.00, 0.30, 85),
(21, 3, 6, 'VNA', '2024-12-11 16:30:00', 100.00, 0.10, 95),
(22, 4, 7, 'BBA', '2024-12-12 18:30:00', 120.00, 0.05, 30),
(23, 5, 1, 'VJA', '2024-12-13 07:30:00', 110.00, 0.25, 40),
(24, 6, 3, 'JPA', '2024-12-14 09:30:00', 130.00, 0.20, 50),
(25, 2, 5, 'JPA', '2024-11-16 07:44:00', 200.00, 0.00, 200),
(26, 2, 5, 'JPA', '2024-11-16 07:44:00', 200.00, 0.00, 200),
(27, 4, 5, 'JPA', '2024-11-27 07:44:00', 200.00, 0.00, 200);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `ticket_cart_view`
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
,`remaining` int(11)
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
  `full_name` varchar(255) DEFAULT NULL,
  `wallet` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `email`, `phone`, `dob`, `password`, `full_name`, `wallet`) VALUES
('ocbe', 'dinhthingoc12@gmail.com', '0979499803', '2024-11-19', '$2y$10$EpE075T6iysILHxNk5FTteS3aQ9GOTpwk7tgXJ6jzCpd46dWp9IXS', 'Đinh Thị Ngọc', 0.00),
('tine19', 'tine.dao19@gmail.com', '0979499802', '2002-11-07', '$2y$10$/Njcwr.7t7ect6xq.292iuSUKzr6FE.ey6Zeo/LvTRlrnS1Q/kogu', 'Đào Quang Tiến', 10000.00);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_comments`
-- (See below for the actual view)
--
CREATE TABLE `view_comments` (
`comment_id` int(11)
,`post_id` int(11)
,`username` varchar(255)
,`full_name` varchar(255)
,`comment` text
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_comment_replies`
-- (See below for the actual view)
--
CREATE TABLE `view_comment_replies` (
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_posts`
-- (See below for the actual view)
--
CREATE TABLE `view_posts` (
`post_id` int(11)
,`username` varchar(255)
,`full_name` varchar(255)
,`img` varchar(255)
,`thought` text
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Cấu trúc cho view `ticket_cart_view`
--
DROP TABLE IF EXISTS `ticket_cart_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ticket_cart_view`  AS SELECT `t`.`ticket_id` AS `ticket_id`, `l1`.`location_name` AS `departure`, `l2`.`location_name` AS `destination`, `t`.`airline_code` AS `airline_code`, `a`.`airline_name` AS `airline_name`, `t`.`departure_time` AS `departure_time`, `t`.`price` AS `price`, `t`.`discount` AS `discount`, `c`.`quantity` AS `quantity`, `c`.`paid` AS `paid`, `c`.`username` AS `username`, `t`.`price`* `c`.`quantity` * (1 - `t`.`discount`) AS `total_price` FROM ((((`tickets` `t` join `locations` `l1` on(`t`.`departure` = `l1`.`location_id`)) join `locations` `l2` on(`t`.`destination` = `l2`.`location_id`)) join `airlines` `a` on(`t`.`airline_code` = `a`.`airline_code`)) left join `cart` `c` on(`t`.`ticket_id` = `c`.`ticket_id`)) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `ticket_view`
--
DROP TABLE IF EXISTS `ticket_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ticket_view`  AS SELECT `t`.`ticket_id` AS `ticket_id`, `l1`.`location_name` AS `departure`, `l2`.`location_name` AS `destination`, `t`.`airline_code` AS `airline_code`, `a`.`airline_name` AS `airline_name`, `t`.`departure_time` AS `departure_time`, `t`.`price` AS `price`, `t`.`discount` AS `discount`, `t`.`remaining` AS `remaining`, `l1`.`type_ticket` AS `departure_type_ticket`, `l2`.`type_ticket` AS `destination_type_ticket` FROM (((`tickets` `t` join `locations` `l1` on(`t`.`departure` = `l1`.`location_id`)) join `locations` `l2` on(`t`.`destination` = `l2`.`location_id`)) join `airlines` `a` on(`t`.`airline_code` = `a`.`airline_code`)) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_comments`
--
DROP TABLE IF EXISTS `view_comments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_comments`  AS SELECT `comments`.`id` AS `comment_id`, `comments`.`post_id` AS `post_id`, `users`.`username` AS `username`, `users`.`full_name` AS `full_name`, `comments`.`comment` AS `comment`, `comments`.`created_at` AS `created_at` FROM (`comments` join `users` on(`comments`.`username` = `users`.`username`)) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_comment_replies`
--
DROP TABLE IF EXISTS `view_comment_replies`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_comment_replies`  AS SELECT `cr`.`id` AS `reply_id`, `cr`.`comment_id` AS `comment_id`, `cr`.`username` AS `username`, `u`.`full_name` AS `full_name`, `cr`.`reply` AS `reply`, `cr`.`created_at` AS `created_at` FROM (`comment_replies` `cr` join `users` `u` on(`cr`.`username` = `u`.`username` collate utf8mb4_unicode_ci)) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_posts`
--
DROP TABLE IF EXISTS `view_posts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_posts`  AS SELECT `posts`.`id` AS `post_id`, `posts`.`username` AS `username`, `users`.`full_name` AS `full_name`, `posts`.`img` AS `img`, `posts`.`thought` AS `thought`, `posts`.`created_at` AS `created_at` FROM (`posts` join `users` on(`posts`.`username` = `users`.`username`)) ;

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
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `username` (`username`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `quantity` (`quantity`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

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
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `airline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

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
