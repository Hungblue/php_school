-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 16, 2022 lúc 08:23 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `63it_php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_has_product`
--

CREATE TABLE `categories_has_product` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_product`
--

CREATE TABLE `categories_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories_product`
--

INSERT INTO `categories_product` (`id`, `name`, `slug`, `description`, `thumbnail`, `is_active`, `created_at`, `update_at`) VALUES
(4, 'Quang Thanh', 'gray', 'a', '', 0, NULL, NULL),
(14, 'Quang Thanh', 'quang-thanh', '', 'import-img.png', 1, NULL, NULL),
(15, 'Quang Thanh', 'quang-thanh', '', 'import-img.png', 1, NULL, NULL),
(16, 'Admin', 'admin', '', '6791.eps', 1, NULL, NULL),
(17, 'Quang Thanh 2', 'quang-thanh-2', '', '6791.eps', 1, NULL, NULL),
(18, 'a', 'a', '', 'adv1.png', 1, NULL, NULL),
(19, 'Tạ Minh Quang 171263 63IT1a', 'ta-minh-quang-171263-63it1', '', 'avatar.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `total` decimal(18,0) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` decimal(18,0) NOT NULL,
  `quantity` int(10) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(18,0) NOT NULL,
  `sale_price` decimal(18,0) NOT NULL,
  `quantity` int(10) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `trending` tinyint(1) NOT NULL,
  `rate` float NOT NULL,
  `sku` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `slug`, `price`, `sale_price`, `quantity`, `short_description`, `description`, `featured`, `trending`, `rate`, `sku`, `thumbnail`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '11111', 'Samsung galaxy', 'samsung', '10000000', '9500000', 10, 'ajhjfafahf', 'aasfffffffffffffffaaaaaaaaaaaaaaaa', 1, 1, 1.2, 'ddddddddddddddddssssss', '1640704893.jpg', 12, 1, '2022-06-20 14:03:50', '2022-06-21 14:03:50'),
(2, '333333333333', 'ip 15', 'ip', '15200000', '15000000', 4, 'aaaaa', 'ssssssssssssssssssssssssss', 1, 1, 2.4, 'aaaaaaaaaaa', '', 12, 1, '2022-06-01 14:13:18', '2022-06-13 14:13:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `remembered_logins`
--

CREATE TABLE `remembered_logins` (
  `token_hash` varchar(64) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review_product`
--

CREATE TABLE `review_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `rate` double NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `review_product`
--

INSERT INTO `review_product` (`id`, `user_id`, `comment`, `rate`, `product_id`, `is_active`, `update_at`, `created_at`) VALUES
(1, 11, 'ngu', 3, 1, 1, NULL, NULL),
(2, 12, 'khon', 5, 2, 1, NULL, NULL),
(3, 12, 'ngu2', 4, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_hash` varchar(255) NOT NULL,
  `password_reset_expires_at` datetime NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `level` int(10) NOT NULL,
  `activation_hash` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `password_reset_hash`, `password_reset_expires_at`, `phone`, `address`, `thumbnail`, `description`, `level`, `activation_hash`, `is_active`, `created_at`, `update_at`) VALUES
(10, 'Admin', 'admin@gmail.com', '$2y$10$QffXr1JhC5xPTKAWNuDdQOH41UdVMaWPwEic3QUhh4pXc0ACobS8m', '', '0000-00-00 00:00:00', '', '', '', '', 0, 'b9b1edb4595662a6b258a2fe2d05d56796d6fc4c9a63ced5890c6f5ef66977cc', 1, NULL, NULL),
(11, 'admin2', 'admin2@gmail.com', '$2y$10$irnRK3Nm5w7FQ3XtByVZIOhqJlzDsSxJ3m9gzTp4cinuXD1hbHkeG', '', '0000-00-00 00:00:00', '', '', '', '', 0, '6ac5710b7595316ee335d9709371826dca438758147f6a6128f01a59552727d2', 1, NULL, NULL),
(12, 'admin3', 'admin3@gmail.com', '$2y$10$gxy1rq6UOO9TI5Oni18QD.JPa3ka4uGNHncMG2UzHdLY.inT0RwQW', '', '0000-00-00 00:00:00', '', '', '', '', 0, '00d158d124ae84d189c0720a661b6477d48a8cbfcdc1ff1a78e0fc0a79d7b5ae', 1, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories_has_product`
--
ALTER TABLE `categories_has_product`
  ADD KEY `category_id` (`category_id`),
  ADD KEY `post_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories_product`
--
ALTER TABLE `categories_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `remembered_logins`
--
ALTER TABLE `remembered_logins`
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `review_product`
--
ALTER TABLE `review_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories_product`
--
ALTER TABLE `categories_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `review_product`
--
ALTER TABLE `review_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `categories_has_product`
--
ALTER TABLE `categories_has_product`
  ADD CONSTRAINT `categories_has_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories_product` (`id`),
  ADD CONSTRAINT `categories_has_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `remembered_logins`
--
ALTER TABLE `remembered_logins`
  ADD CONSTRAINT `remembered_logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `review_product`
--
ALTER TABLE `review_product`
  ADD CONSTRAINT `review_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `review_product_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
