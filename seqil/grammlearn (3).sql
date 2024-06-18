-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 09:05 PM
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
('bagas@gmaill.com|127.0.0.1', 'i:3;', 1718363327),
('bagas@gmaill.com|127.0.0.1:timer', 'i:1718363327;', 1718363327);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `required_points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `required_points`, `created_at`, `updated_at`) VALUES
(18, 'Adjectives', 'adjectives', NULL, 0, '2024-06-18 08:00:28', '2024-06-18 08:00:28'),
(19, 'Adverbs', 'adverbs', NULL, 100, '2024-06-18 08:00:28', '2024-06-18 08:00:28'),
(20, 'Comparative Adjective Phrases', 'comparative-adjective-phrases', NULL, 200, '2024-06-18 08:00:28', '2024-06-18 08:00:28'),
(21, 'Comparatives and Superlatives', 'comparatives-and-superlatives', NULL, 300, '2024-06-18 08:00:28', '2024-06-18 08:00:28'),
(22, 'Comparing Quality', 'comparing-quality', NULL, 400, '2024-06-18 08:00:28', '2024-06-18 08:00:28'),
(23, 'Comparing Quantity', 'comparing-quantity', NULL, 500, '2024-06-18 08:00:28', '2024-06-18 08:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(11, '2024_06_14_105139_add_points_required_to_categories', 8);

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
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category_id`, `question`, `created_at`, `updated_at`) VALUES
(733, 18, 'She sings very beautiful.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(738, 19, 'She sings very beautiful.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(739, 19, 'He runs quick to catch the bus.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(740, 19, 'They work hard every day, but they work more hard on Fridays.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(741, 19, 'She speaks English very good.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(742, 19, 'He did the task very careful.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(743, 20, 'My car is more faster than yours.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(744, 20, 'This cake is more deliciouser than the one you made last week.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(745, 20, 'Her dress is more prettier than mine.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(746, 20, 'He is more taller than his brother.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(747, 20, 'This puzzle is more easier than the last one.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(748, 21, 'She is the most happiest person I know.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(749, 21, 'Of the three brothers, Jack is the taller.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(750, 21, 'This restaurant is the most best in town.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(751, 21, 'She is the goodest student in her class.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(752, 21, 'This is the more important issue we need to discuss.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(753, 22, 'This phone is gooder than that one.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(754, 22, 'Her performance was more better than mine.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(755, 22, 'The new model is more efficienter than the old one.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(756, 22, 'This fabric feels more softer than the other one.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(757, 22, 'Of all the paintings, I like this one the bestest.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(758, 23, 'She has more books than me.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(759, 23, 'There are less people here than expected.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(760, 23, 'He spent fewer money than his friend.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(761, 23, 'I have much homework to do tonight.', '2024-06-18 08:57:27', '2024-06-18 08:57:27'),
(762, 23, 'She ate less cookies than her brother.', '2024-06-18 08:57:27', '2024-06-18 08:57:27');

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
('D0cVLqiPExniaOVtykP0n7EWoSsNB4N9D6HRYu7q', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWURDZjNIZ2xJSzZqTXJnUXBvQThyWERQbXR0SzFuOFBBckpoZVR5VSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1718736914);

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
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `points`) VALUES
(3, 'admin', 'admin@gmail.com', NULL, '$2y$12$lZOMX3QEPlZEGyT5jNpx9ebGHx.cL7aFw.Z/JflgV0iCR5n9Uqcby', NULL, '2024-06-12 19:28:11', '2024-06-18 10:34:18', 58),
(4, 'bagas', 'bagas@gmail.com', NULL, '$2y$12$VHIRFB3de7rFYcG5AX2kh.fFiYdrwxPq5ciRZg7hxcFxiuSwvAn/e', NULL, '2024-06-13 00:28:45', '2024-06-14 03:44:56', 500),
(5, 'ujang', 'ujang@gmail.com', NULL, '$2y$12$TQmRGImWEHsYX6LsTHZtEuXTtSK8bsqYTjQH9xmvTVCASqWveqfgu', NULL, '2024-06-14 04:08:35', '2024-06-14 04:19:22', 156),
(6, 'agus', 'agus@gmail.com', NULL, '$2y$12$5rxgLsPNz70JSyERhv0/HeLKN8r6HBICPwUtUp8j624Mc4gT7noT6', NULL, '2024-06-14 04:24:43', '2024-06-14 08:04:50', 205),
(7, 'bunga', 'bunga@gmail.com', NULL, '$2y$12$LrjErxYG5jst62GbQFKtN.GTI.NeKqHujhGenkMqG4DprawJPB2Zy', NULL, '2024-06-14 08:28:57', '2024-06-18 06:15:49', 101);

-- --------------------------------------------------------

--
-- Table structure for table `user_unlocked_categories`
--

CREATE TABLE `user_unlocked_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_unlocked_categories`
--

INSERT INTO `user_unlocked_categories` (`id`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(17, 3, 18, NULL, NULL),
(18, 7, 18, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
  ADD KEY `questions_category_id_foreign` (`category_id`);

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
-- Indexes for table `user_unlocked_categories`
--
ALTER TABLE `user_unlocked_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_unlocked_categories_user_id_foreign` (`user_id`),
  ADD KEY `user_unlocked_categories_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=763;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_unlocked_categories`
--
ALTER TABLE `user_unlocked_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_unlocked_categories`
--
ALTER TABLE `user_unlocked_categories`
  ADD CONSTRAINT `user_unlocked_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_unlocked_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
