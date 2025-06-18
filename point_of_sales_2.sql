-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 04:18 AM
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
-- Database: `point_of_sales_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `c_name`, `created_at`, `updated_at`) VALUES
(1, 'Minuman', '2025-06-16 02:57:21', '2025-06-16 04:42:30'),
(2, 'Makanan Ringan', '2025-06-16 02:57:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `menu_name` varchar(50) NOT NULL,
  `menu_icon` varchar(50) NOT NULL,
  `menu_url` varchar(100) DEFAULT NULL,
  `menu_order` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `parent_id`, `menu_name`, `menu_icon`, `menu_url`, `menu_order`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', 'bi bi-grid', 'home.php', 1, '2025-06-11 05:12:51', '2025-06-12 00:24:06'),
(2, 0, 'Master Data', 'bi bi-menu-button-wide', '', 2, '2025-06-11 04:41:34', '2025-06-12 00:24:04'),
(7, 2, 'Instructor', 'bi bi-circle', 'instruct/instructor', 1, '2025-06-11 06:49:48', '2025-06-12 00:24:32'),
(8, 2, 'Major', 'bi bi-circle', 'maj/major', 2, '2025-06-11 07:17:52', '2025-06-12 00:24:35'),
(9, 2, 'Menu', 'bi bi-circle', 'mnu/menu', 3, '2025-06-11 07:32:51', '2025-06-12 00:24:38'),
(10, 2, 'Role', 'bi bi-circle', 'rol/role', 4, '2025-06-11 07:33:24', '2025-06-12 00:24:40'),
(11, 2, 'User', 'bi bi-circle', 'usr/user', 5, '2025-06-11 07:34:25', '2025-06-12 00:24:43'),
(12, 0, 'Moduls', 'bi bi-book', '?page=/mod/moduls', 3, '2025-06-12 02:33:42', '2025-06-12 05:13:23'),
(13, 12, 'POS', 'bi bi-circle', 'pos', 1, '2025-06-18 02:13:44', '2025-06-18 02:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `menu_roles`
--

CREATE TABLE `menu_roles` (
  `mr_id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_roles`
--

INSERT INTO `menu_roles` (`mr_id`, `id_role`, `id_menu`, `created_at`, `updated_at`) VALUES
(25, 1, 1, '2025-06-18 02:14:30', NULL),
(26, 1, 2, '2025-06-18 02:14:30', NULL),
(27, 1, 7, '2025-06-18 02:14:30', NULL),
(28, 1, 8, '2025-06-18 02:14:30', NULL),
(29, 1, 9, '2025-06-18 02:14:30', NULL),
(30, 1, 10, '2025-06-18 02:14:30', NULL),
(31, 1, 11, '2025-06-18 02:14:30', NULL),
(32, 1, 12, '2025-06-18 02:14:30', NULL),
(33, 1, 13, '2025-06-18 02:14:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_price` double(10,2) NOT NULL,
  `p_qty` int(5) NOT NULL,
  `p_desc` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `id_category`, `p_name`, `p_price`, `p_qty`, `p_desc`, `created_at`, `updated_at`) VALUES
(2, 2, 'French Fries', 8000.00, 5, 'French fries with sauce', '2025-06-16 04:59:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-06-16 01:47:12', NULL),
(2, 'Cashier', '2025-06-16 02:52:10', '2025-06-16 02:52:34'),
(3, 'Leader', '2025-06-16 06:22:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `id_role`, `user_name`, `user_email`, `user_password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'W', 'w@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-06-16 01:46:54', NULL, 0),
(2, NULL, 'Ted', 'ted@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-06-16 07:44:39', NULL, 0),
(3, NULL, '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2025-06-16 07:44:46', '2025-06-16 07:44:54', 1),
(4, NULL, '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2025-06-16 07:46:29', '2025-06-16 07:46:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `uR_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`uR_id`, `id_user`, `id_role`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-06-16 01:47:42', NULL),
(5, 2, 2, '2025-06-16 07:50:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_roles`
--
ALTER TABLE `menu_roles`
  ADD PRIMARY KEY (`mr_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`uR_id`),
  ADD KEY `user_roles_ibfk_2` (`id_user`),
  ADD KEY `user_roles_ibfk_1` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menu_roles`
--
ALTER TABLE `menu_roles`
  MODIFY `mr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `uR_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
