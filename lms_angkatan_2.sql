-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 09:52 AM
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
-- Database: `lms_angkatan_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `instructor_name` varchar(50) NOT NULL,
  `instructor_gender` tinyint(1) NOT NULL,
  `instructor_education` varchar(30) NOT NULL,
  `instructor_phone` int(15) NOT NULL,
  `instructor_email` varchar(50) NOT NULL,
  `instructor_password` varchar(100) NOT NULL,
  `instructor_address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `id_role`, `instructor_name`, `instructor_gender`, `instructor_education`, `instructor_phone`, `instructor_email`, `instructor_password`, `instructor_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 1, 'Ted', 1, 'S1', 2147483647, 'ted@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Jalan 5A RT013 RW008', '2025-06-04 08:15:44', '2025-06-11 01:57:39', 0),
(8, 1, 'afa', 0, 'S1', 2147483647, 'afa@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Jalan 6A RT013 RW008', '2025-06-04 08:15:57', '2025-06-11 01:34:26', 0),
(9, 1, 'Afi', 0, 'S1', 2147483647, 'afi@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Jalan 7A RT013 RW008', '2025-06-05 03:47:47', '2025-06-11 01:34:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `instructor_major`
--

CREATE TABLE `instructor_major` (
  `iM_id` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_major`
--

INSERT INTO `instructor_major` (`iM_id`, `id_major`, `id_instructor`, `created_at`, `updated_at`) VALUES
(31, 4, 7, '2025-06-05 01:18:04', NULL),
(32, 4, 8, '2025-06-05 01:25:50', NULL),
(36, 4, 9, '2025-06-05 07:00:42', NULL),
(37, 5, 7, '2025-06-05 07:29:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`, `major_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Mobile Programming', '2025-06-03 13:48:18', NULL, 0),
(4, 'Web Programming', '2025-06-04 07:03:10', NULL, 0),
(5, 'English', '2025-06-05 07:03:56', NULL, 0);

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
(12, 0, 'Moduls', 'bi bi-book', '?page=/mod/moduls', 3, '2025-06-12 02:33:42', '2025-06-12 05:13:23');

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
(79, 2, 1, '2025-06-12 07:38:16', NULL),
(80, 2, 12, '2025-06-12 07:38:16', NULL),
(96, 1, 1, '2025-06-12 07:51:47', NULL),
(97, 1, 12, '2025-06-12 07:51:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moduls`
--

CREATE TABLE `moduls` (
  `modul_id` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `id_instructor` int(11) NOT NULL,
  `modul_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moduls`
--

INSERT INTO `moduls` (`modul_id`, `id_major`, `id_instructor`, `modul_name`, `created_at`, `updated_at`) VALUES
(24, 4, 7, 'CSS', '2025-06-10 04:06:44', NULL),
(25, 5, 7, 'Basic', '2025-06-11 02:34:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modul_details`
--

CREATE TABLE `modul_details` (
  `md_id` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `md_file` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modul_details`
--

INSERT INTO `modul_details` (`md_id`, `id_modul`, `md_file`, `created_at`, `updated_at`) VALUES
(8, 24, '6847af546caf2-Manual BOOK POS.pdf', '2025-06-10 04:06:44', NULL),
(9, 25, '6848eb1f2281d-Manual BOOK POS.pdf', '2025-06-11 02:34:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Instructor', '2025-06-04 02:25:42', '2025-06-10 07:41:49'),
(2, 'Student', '2025-06-04 02:25:42', '2025-06-10 07:41:53'),
(3, 'User', '2025-06-10 07:42:24', NULL),
(4, 'PIC', '2025-06-11 01:21:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `id_major` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_gender` tinyint(1) NOT NULL,
  `student_education` varchar(30) NOT NULL,
  `student_phone` int(15) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `student_password` varchar(100) NOT NULL,
  `student_address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `id_major`, `student_name`, `student_gender`, `student_education`, `student_phone`, `student_email`, `student_password`, `student_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 4, 'W', 1, 'S1', 2147483647, 'w@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Jalan 5A RT013 RW008', '2025-06-04 08:15:44', '2025-06-11 01:15:05', 0),
(8, 4, 'S', 0, 'S1', 2147483647, 's@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Jalan 6A RT013 RW008', '2025-06-04 08:15:57', '2025-06-10 07:40:49', 0),
(9, 4, 'A', 0, 'S1', 2147483647, 'a@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Jalan 7A RT013 RW008', '2025-06-05 03:47:47', '2025-06-10 07:40:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
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
(1, NULL, 'Will', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2025-06-03 02:51:29', '2025-06-12 04:22:34', 0),
(2, NULL, 'S', 's@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2025-06-03 06:46:11', '2025-06-12 01:06:04', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `instructor_major`
--
ALTER TABLE `instructor_major`
  ADD PRIMARY KEY (`iM_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`);

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
-- Indexes for table `moduls`
--
ALTER TABLE `moduls`
  ADD PRIMARY KEY (`modul_id`);

--
-- Indexes for table `modul_details`
--
ALTER TABLE `modul_details`
  ADD PRIMARY KEY (`md_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `id_role_to_role_id` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `instructor_major`
--
ALTER TABLE `instructor_major`
  MODIFY `iM_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu_roles`
--
ALTER TABLE `menu_roles`
  MODIFY `mr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `moduls`
--
ALTER TABLE `moduls`
  MODIFY `modul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `modul_details`
--
ALTER TABLE `modul_details`
  MODIFY `md_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `id_role_to_role_id` FOREIGN KEY (`id_role`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
