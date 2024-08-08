-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 11:52 PM
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
-- Database: `grammlearn`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_text` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`, `created_at`, `updated_at`) VALUES
(65, 791, 'Kata benda adalah kata yang merujuk pada orang, tempat, benda, atau ide.', 1, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(66, 791, 'Kata benda adalah kata yang menggambarkan tindakan.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(67, 791, 'Kata benda adalah kata yang mengubah kata kerja.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(68, 791, 'Kata benda adalah kata yang menggambarkan tempat.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(69, 792, 'Kata kerja adalah kata yang menggambarkan tindakan atau keadaan.', 1, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(70, 792, 'Kata kerja adalah kata yang menggambarkan kata benda.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(71, 792, 'Kata kerja adalah kata yang menggambarkan tempat.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(72, 792, 'Kata kerja adalah kata yang menggambarkan ide.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(73, 793, 'Kata sifat adalah kata yang menggambarkan kata benda.', 1, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(74, 793, 'Kata sifat adalah kata yang menggambarkan kata kerja.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(75, 793, 'Kata sifat adalah kata yang menggambarkan tindakan.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(76, 793, 'Kata sifat adalah kata yang mengubah kata sifat lain.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(77, 794, 'Kata keterangan adalah kata yang mengubah kata kerja, kata sifat, atau kata keterangan lainnya.', 1, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(78, 794, 'Kata keterangan adalah kata yang merujuk pada orang, tempat, atau benda.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(79, 794, 'Kata keterangan adalah kata yang menggambarkan kata benda.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(80, 794, 'Kata keterangan adalah kata yang menggambarkan tindakan.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(81, 795, 'Kata ganti adalah kata yang menggantikan kata benda.', 1, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(82, 795, 'Kata ganti adalah kata yang menggambarkan kata kerja.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(83, 795, 'Kata ganti adalah kata yang menggambarkan tempat.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30'),
(84, 795, 'Kata ganti adalah kata yang mengubah kata benda.', 0, '2024-07-25 10:12:30', '2024-07-25 10:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('asdasd@golasjhd.asodkj|127.0.0.1', 'i:1;', 1722533033),
('asdasd@golasjhd.asodkj|127.0.0.1:timer', 'i:1722533033;', 1722533033),
('bagas@gmaill.com|127.0.0.1', 'i:1;', 1721928574),
('bagas@gmaill.com|127.0.0.1:timer', 'i:1721928574;', 1721928574),
('dera@gmail.com|127.0.0.1', 'i:1;', 1723125003),
('dera@gmail.com|127.0.0.1:timer', 'i:1723125002;', 1723125002);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `slug`, `title`, `description`, `created_at`, `updated_at`) VALUES
(5, 'parts-of-speech', 'Parts of Speech', 'Adjectives adalah kata yang menggambarkan kata benda', '2024-07-23 03:28:45', '2024-07-23 03:28:45'),
(6, 'simple-present-tense', 'Simple Present Tense', 'Adverbs adalah kata yang memodifikasi atau menjelaskan kata kerja', '2024-07-23 03:28:45', '2024-07-23 03:28:45'),
(7, 'present-continuous-tense', 'Present Continuous Tense', 'Description for Conditionals with \"Unless\"', '2024-07-23 03:28:45', '2024-07-23 03:28:45'),
(8, 'simple-past-tense', 'Simple Past Tense', 'Past Tense digunakan ketika Anda ingin membicarakan sesuatu yang telah terjadi di masa lalu', '2024-07-23 03:28:45', '2024-07-23 03:28:45'),
(11, 'edan-kt', 'edan kt', 'aksdkasd', '2024-08-07 08:52:01', '2024-08-07 08:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `history_redeems`
--

CREATE TABLE `history_redeems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `redeemed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_redeems`
--

INSERT INTO `history_redeems` (`id`, `user_id`, `item_id`, `redeemed_at`, `created_at`, `updated_at`) VALUES
(1, 4, 1, '2024-08-08 13:27:01', '2024-08-08 06:27:01', '2024-08-08 06:27:01'),
(2, 4, 1, '2024-08-08 13:29:45', '2024-08-08 06:29:45', '2024-08-08 06:29:45'),
(3, 7, 2, '2024-08-08 13:49:34', '2024-08-08 06:49:34', '2024-08-08 06:49:34'),
(4, 4, 1, '2024-08-08 13:53:06', '2024-08-08 06:53:06', '2024-08-08 06:53:06'),
(7, 3, 1, '2024-08-08 17:53:04', '2024-08-08 10:53:04', '2024-08-08 10:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `redeemed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `item_id`, `redeemed`, `created_at`, `updated_at`) VALUES
(5, 7, 1, 0, '2024-08-08 06:49:27', '2024-08-08 06:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Dana 1k', 'Dana 1000 Rp', 100, 'url_gambar_1', '2024-07-22 10:47:19', '2024-08-08 14:50:54', NULL),
(2, 'Dana 2k', 'Dana 2000 Rp', 200, 'url_gambar_2', '2024-07-22 10:47:19', '2024-08-08 14:50:59', NULL),
(3, 'Dana 3k', 'Dana 3000 rp', 300, 'url_gambar_3', '2024-07-22 10:47:19', '2024-08-08 14:51:09', NULL),
(4, 'Dana 4k', 'Dana 4000 Rp', 400, 'url_gambar_1', '2024-07-22 11:21:04', '2024-08-08 14:51:23', NULL),
(5, 'Dana 5k', 'Dana 5000 RP', 750, 'url_gambar_2', '2024-07-22 11:21:04', '2024-08-08 14:51:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_13_070326_create_categories_table', 2),
(5, '2024_06_13_070335_create_user_categories_table', 2),
(6, '2024_06_13_070433_add_points_to_users_table', 3),
(7, '2024_06_13_072658_add_slug_to_categories_table', 4),
(8, '2024_06_13_074355_create_questions_table', 5),
(9, '2024_06_14_102020_create_user_unlocked_categories_table', 6),
(10, '2024_06_14_104157_create_user_category_unlocks_table', 7),
(11, '2024_06_14_105139_add_points_required_to_categories', 8),
(15, '2024_07_09_142642_create_courses_table', 9),
(16, '2024_07_12_183923_create_items_table', 9),
(17, '2024_07_20_082012_create_user_answers_table', 9),
(18, '2024_07_22_170152_add_course_id_to_questions_table', 10),
(19, '2024_07_22_173129_add_slug_to_courses_table', 10),
(20, '2024_07_23_095547_remove_category_id_foreign_key_from_questions_table', 11),
(21, '2024_07_23_113458_create_options_table', 11),
(22, '2024_08_01_145420_add_role_to_users_table', 11),
(23, '2024_08_08_123054_create_inventories_table', 12),
(24, '2024_08_08_130501_create_history_redeems_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `course_id`, `question`, `created_at`, `updated_at`) VALUES
(791, 5, 'Apa itu kata benda (noun)?', '2024-07-25 10:10:43', '2024-07-25 10:10:43'),
(792, 5, 'Apa itu kata kerja (verb)?', '2024-07-25 10:10:43', '2024-07-25 10:10:43'),
(793, 5, 'Apa itu kata sifat (adjective)?', '2024-07-25 10:10:43', '2024-07-25 10:10:43'),
(794, 5, 'Apa itu kata keterangan (adverb)?', '2024-07-25 10:10:43', '2024-07-25 10:10:43'),
(795, 5, 'Apa itu kata ganti (pronoun)?', '2024-07-25 10:10:43', '2024-07-25 10:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5iiLrBhx6lPmP9brUUpGsoCnwPXqmHOSrgcPG2v3', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMzRneEJpd2RSM0hucVpxQWdQSEF1T3JBR3RwRFJJVzNOcEdESExITSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1723153910);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `points`, `role`) VALUES
(3, 'admin', 'admin@gmail.com', NULL, '$2y$12$lZOMX3QEPlZEGyT5jNpx9ebGHx.cL7aFw.Z/JflgV0iCR5n9Uqcby', NULL, '2024-06-12 19:28:11', '2024-08-08 10:52:55', 113, 'admin'),
(4, 'bagas', 'bagas@gmail.com', NULL, '$2y$12$VHIRFB3de7rFYcG5AX2kh.fFiYdrwxPq5ciRZg7hxcFxiuSwvAn/e', NULL, '2024-06-13 00:28:45', '2024-08-08 06:53:58', 58454, 'user'),
(5, 'ujang', 'ujang@gmail.com', NULL, '$2y$12$TQmRGImWEHsYX6LsTHZtEuXTtSK8bsqYTjQH9xmvTVCASqWveqfgu', NULL, '2024-06-14 04:08:35', '2024-06-14 04:19:22', 156, 'user'),
(6, 'agus', 'agus@gmail.com', NULL, '$2y$12$5rxgLsPNz70JSyERhv0/HeLKN8r6HBICPwUtUp8j624Mc4gT7noT6', NULL, '2024-06-14 04:24:43', '2024-06-14 08:04:50', 205, 'user'),
(7, 'bunga', 'bunga@gmail.com', NULL, '$2y$12$LrjErxYG5jst62GbQFKtN.GTI.NeKqHujhGenkMqG4DprawJPB2Zy', NULL, '2024-06-14 08:28:57', '2024-08-08 06:49:29', 699, 'user'),
(8, 'dera', 'dera@gmail.com', NULL, '$2y$12$6j/b8L3PzQKuZbNakIipMuhcWP06WShcyks4EOYG7RxEeQoennTrW', NULL, '2024-07-21 02:53:07', '2024-07-21 02:53:07', 900, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `answers` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`);

--
-- Indexes for table `history_redeems`
--
ALTER TABLE `history_redeems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_redeems_user_id_foreign` (`user_id`),
  ADD KEY `history_redeems_item_id_foreign` (`item_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_user_id_foreign` (`user_id`),
  ADD KEY `inventories_item_id_foreign` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course` (`course_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_user_id_foreign` (`user_id`),
  ADD KEY `user_answers_course_id_foreign` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `history_redeems`
--
ALTER TABLE `history_redeems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=796;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `history_redeems`
--
ALTER TABLE `history_redeems`
  ADD CONSTRAINT `history_redeems_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_redeems_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
