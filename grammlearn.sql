-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 08:21 PM
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
(1, 'Animals', 'animals', NULL, 0, '2024-06-13 00:27:29', '2024-06-13 00:27:29'),
(2, 'Food', 'food', NULL, 100, '2024-06-13 00:27:29', '2024-06-13 00:27:29'),
(3, 'Clothes', 'clothes', NULL, 200, '2024-06-13 00:27:29', '2024-06-13 00:27:29'),
(4, 'Nature', 'nature', NULL, 300, '2024-06-13 00:27:29', '2024-06-13 00:27:29'),
(5, 'Verbs', 'verbs', NULL, 400, '2024-06-13 00:27:29', '2024-06-13 00:27:29'),
(6, 'Plurals', 'plurals', NULL, 500, '2024-06-13 00:27:29', '2024-06-13 00:27:29'),
(7, 'Verb Plurals', 'verb-plurals', NULL, 600, '2024-06-13 00:27:29', '2024-06-13 00:27:29'),
(8, 'Professions', 'professions', NULL, 700, '2024-06-13 00:27:29', '2024-06-13 00:27:29');

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
(8, '2024_06_13_074355_create_questions_table', 5);

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
  `answer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(33, 1, 'What is the plural form of \"cat\"?', 'cats', '2024-06-13 04:13:59', '2024-06-13 04:13:59'),
(34, 1, 'What is the plural form of \"dog\"?', 'dogs', '2024-06-13 04:13:59', '2024-06-13 04:13:59'),
(35, 1, 'What is the plural form of \"car\"?', 'cars', '2024-06-13 04:13:59', '2024-06-13 04:13:59'),
(36, 1, 'What is the plural form of \"tree\"?', 'trees', '2024-06-13 04:13:59', '2024-06-13 04:13:59'),
(37, 1, 'What is the plural form of \"house\"?', 'houses', '2024-06-13 04:13:59', '2024-06-13 04:13:59'),
(38, 1, 'What is the plural form of \"child\"?', 'children', '2024-06-13 04:13:59', '2024-06-13 04:13:59'),
(273, 1, 'What is the plural form of \"cat\"?', 'cats', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(274, 1, 'What is the plural form of \"dog\"?', 'dogs', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(275, 1, 'What is the plural form of \"car\"?', 'cars', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(276, 1, 'What is the plural form of \"tree\"?', 'trees', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(277, 1, 'What is the plural form of \"house\"?', 'houses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(303, 2, 'What is the plural form of \"cat\"?', 'cats', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(304, 2, 'What is the plural form of \"dog\"?', 'dogs', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(305, 2, 'What is the plural form of \"car\"?', 'cars', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(306, 2, 'What is the plural form of \"tree\"?', 'trees', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(307, 2, 'What is the plural form of \"house\"?', 'houses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(308, 2, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(309, 2, 'What is the plural form of \"mouse\"?', 'mice', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(310, 2, 'What is the plural form of \"foot\"?', 'feet', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(365, 4, 'What is the plural form of \"car\"?', 'cars', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(366, 4, 'What is the plural form of \"tree\"?', 'trees', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(367, 4, 'What is the plural form of \"house\"?', 'houses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(368, 4, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(369, 4, 'What is the plural form of \"mouse\"?', 'mice', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(370, 4, 'What is the plural form of \"foot\"?', 'feet', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(371, 4, 'What is the plural form of \"goose\"?', 'geese', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(372, 4, 'What is the plural form of \"tooth\"?', 'teeth', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(373, 4, 'What is the plural form of \"man\"?', 'men', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(374, 4, 'What is the plural form of \"woman\"?', 'women', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(375, 4, 'What is the plural form of \"person\"?', 'people', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(376, 4, 'What is the plural form of \"fish\"?', 'fish', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(377, 4, 'What is the plural form of \"sheep\"?', 'sheep', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(378, 4, 'What is the plural form of \"deer\"?', 'deer', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(379, 4, 'What is the plural form of \"moose\"?', 'moose', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(380, 4, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(381, 4, 'What is the plural form of \"ox\"?', 'oxen', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(382, 4, 'What is the plural form of \"cactus\"?', 'cacti', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(383, 4, 'What is the plural form of \"fungus\"?', 'fungi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(384, 4, 'What is the plural form of \"nucleus\"?', 'nuclei', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(385, 4, 'What is the plural form of \"syllabus\"?', 'syllabi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(386, 4, 'What is the plural form of \"crisis\"?', 'crises', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(387, 4, 'What is the plural form of \"thesis\"?', 'theses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(388, 4, 'What is the plural form of \"analysis\"?', 'analyses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(389, 4, 'What is the plural form of \"diagnosis\"?', 'diagnoses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(390, 4, 'What is the plural form of \"hypothesis\"?', 'hypotheses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(391, 4, 'What is the plural form of \"oasis\"?', 'oases', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(392, 4, 'What is the plural form of \"phenomenon\"?', 'phenomena', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(393, 5, 'What is the plural form of \"cat\"?', 'cats', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(394, 5, 'What is the plural form of \"dog\"?', 'dogs', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(395, 5, 'What is the plural form of \"car\"?', 'cars', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(396, 5, 'What is the plural form of \"tree\"?', 'trees', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(397, 5, 'What is the plural form of \"house\"?', 'houses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(398, 5, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(399, 5, 'What is the plural form of \"mouse\"?', 'mice', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(400, 5, 'What is the plural form of \"foot\"?', 'feet', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(401, 5, 'What is the plural form of \"goose\"?', 'geese', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(402, 5, 'What is the plural form of \"tooth\"?', 'teeth', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(403, 5, 'What is the plural form of \"man\"?', 'men', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(404, 5, 'What is the plural form of \"woman\"?', 'women', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(405, 5, 'What is the plural form of \"person\"?', 'people', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(406, 5, 'What is the plural form of \"fish\"?', 'fish', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(407, 5, 'What is the plural form of \"sheep\"?', 'sheep', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(408, 5, 'What is the plural form of \"deer\"?', 'deer', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(409, 5, 'What is the plural form of \"moose\"?', 'moose', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(410, 5, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(411, 5, 'What is the plural form of \"ox\"?', 'oxen', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(412, 5, 'What is the plural form of \"cactus\"?', 'cacti', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(413, 5, 'What is the plural form of \"fungus\"?', 'fungi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(414, 5, 'What is the plural form of \"nucleus\"?', 'nuclei', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(415, 5, 'What is the plural form of \"syllabus\"?', 'syllabi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(416, 5, 'What is the plural form of \"crisis\"?', 'crises', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(417, 5, 'What is the plural form of \"thesis\"?', 'theses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(418, 5, 'What is the plural form of \"analysis\"?', 'analyses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(419, 5, 'What is the plural form of \"diagnosis\"?', 'diagnoses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(420, 5, 'What is the plural form of \"hypothesis\"?', 'hypotheses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(421, 5, 'What is the plural form of \"oasis\"?', 'oases', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(422, 5, 'What is the plural form of \"phenomenon\"?', 'phenomena', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(423, 6, 'What is the plural form of \"cat\"?', 'cats', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(424, 6, 'What is the plural form of \"dog\"?', 'dogs', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(425, 6, 'What is the plural form of \"car\"?', 'cars', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(426, 6, 'What is the plural form of \"tree\"?', 'trees', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(427, 6, 'What is the plural form of \"house\"?', 'houses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(428, 6, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(429, 6, 'What is the plural form of \"mouse\"?', 'mice', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(430, 6, 'What is the plural form of \"foot\"?', 'feet', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(431, 6, 'What is the plural form of \"goose\"?', 'geese', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(432, 6, 'What is the plural form of \"tooth\"?', 'teeth', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(433, 6, 'What is the plural form of \"man\"?', 'men', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(434, 6, 'What is the plural form of \"woman\"?', 'women', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(435, 6, 'What is the plural form of \"person\"?', 'people', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(436, 6, 'What is the plural form of \"fish\"?', 'fish', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(437, 6, 'What is the plural form of \"sheep\"?', 'sheep', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(438, 6, 'What is the plural form of \"deer\"?', 'deer', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(439, 6, 'What is the plural form of \"moose\"?', 'moose', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(440, 6, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(441, 6, 'What is the plural form of \"ox\"?', 'oxen', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(442, 6, 'What is the plural form of \"cactus\"?', 'cacti', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(443, 6, 'What is the plural form of \"fungus\"?', 'fungi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(444, 6, 'What is the plural form of \"nucleus\"?', 'nuclei', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(445, 6, 'What is the plural form of \"syllabus\"?', 'syllabi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(446, 6, 'What is the plural form of \"crisis\"?', 'crises', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(447, 6, 'What is the plural form of \"thesis\"?', 'theses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(448, 6, 'What is the plural form of \"analysis\"?', 'analyses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(449, 6, 'What is the plural form of \"diagnosis\"?', 'diagnoses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(450, 6, 'What is the plural form of \"hypothesis\"?', 'hypotheses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(451, 6, 'What is the plural form of \"oasis\"?', 'oases', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(452, 6, 'What is the plural form of \"phenomenon\"?', 'phenomena', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(453, 7, 'What is the plural form of \"cat\"?', 'cats', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(454, 7, 'What is the plural form of \"dog\"?', 'dogs', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(455, 7, 'What is the plural form of \"car\"?', 'cars', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(456, 7, 'What is the plural form of \"tree\"?', 'trees', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(457, 7, 'What is the plural form of \"house\"?', 'houses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(458, 7, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(459, 7, 'What is the plural form of \"mouse\"?', 'mice', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(460, 7, 'What is the plural form of \"foot\"?', 'feet', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(461, 7, 'What is the plural form of \"goose\"?', 'geese', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(462, 7, 'What is the plural form of \"tooth\"?', 'teeth', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(463, 7, 'What is the plural form of \"man\"?', 'men', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(464, 7, 'What is the plural form of \"woman\"?', 'women', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(465, 7, 'What is the plural form of \"person\"?', 'people', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(466, 7, 'What is the plural form of \"fish\"?', 'fish', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(467, 7, 'What is the plural form of \"sheep\"?', 'sheep', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(468, 7, 'What is the plural form of \"deer\"?', 'deer', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(469, 7, 'What is the plural form of \"moose\"?', 'moose', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(470, 7, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(471, 7, 'What is the plural form of \"ox\"?', 'oxen', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(472, 7, 'What is the plural form of \"cactus\"?', 'cacti', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(473, 7, 'What is the plural form of \"fungus\"?', 'fungi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(474, 7, 'What is the plural form of \"nucleus\"?', 'nuclei', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(475, 7, 'What is the plural form of \"syllabus\"?', 'syllabi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(476, 7, 'What is the plural form of \"crisis\"?', 'crises', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(477, 7, 'What is the plural form of \"thesis\"?', 'theses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(478, 7, 'What is the plural form of \"analysis\"?', 'analyses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(479, 7, 'What is the plural form of \"diagnosis\"?', 'diagnoses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(480, 7, 'What is the plural form of \"hypothesis\"?', 'hypotheses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(481, 7, 'What is the plural form of \"oasis\"?', 'oases', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(482, 7, 'What is the plural form of \"phenomenon\"?', 'phenomena', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(483, 8, 'What is the plural form of \"cat\"?', 'cats', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(484, 8, 'What is the plural form of \"dog\"?', 'dogs', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(485, 8, 'What is the plural form of \"car\"?', 'cars', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(486, 8, 'What is the plural form of \"tree\"?', 'trees', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(487, 8, 'What is the plural form of \"house\"?', 'houses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(488, 8, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(489, 8, 'What is the plural form of \"mouse\"?', 'mice', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(490, 8, 'What is the plural form of \"foot\"?', 'feet', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(491, 8, 'What is the plural form of \"goose\"?', 'geese', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(492, 8, 'What is the plural form of \"tooth\"?', 'teeth', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(493, 8, 'What is the plural form of \"man\"?', 'men', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(494, 8, 'What is the plural form of \"woman\"?', 'women', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(495, 8, 'What is the plural form of \"person\"?', 'people', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(496, 8, 'What is the plural form of \"fish\"?', 'fish', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(497, 8, 'What is the plural form of \"sheep\"?', 'sheep', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(498, 8, 'What is the plural form of \"deer\"?', 'deer', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(499, 8, 'What is the plural form of \"moose\"?', 'moose', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(500, 8, 'What is the plural form of \"child\"?', 'children', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(501, 8, 'What is the plural form of \"ox\"?', 'oxen', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(502, 8, 'What is the plural form of \"cactus\"?', 'cacti', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(503, 8, 'What is the plural form of \"fungus\"?', 'fungi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(504, 8, 'What is the plural form of \"nucleus\"?', 'nuclei', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(505, 8, 'What is the plural form of \"syllabus\"?', 'syllabi', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(506, 8, 'What is the plural form of \"crisis\"?', 'crises', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(507, 8, 'What is the plural form of \"thesis\"?', 'theses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(508, 8, 'What is the plural form of \"analysis\"?', 'analyses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(509, 8, 'What is the plural form of \"diagnosis\"?', 'diagnoses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(510, 8, 'What is the plural form of \"hypothesis\"?', 'hypotheses', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(511, 8, 'What is the plural form of \"oasis\"?', 'oases', '2024-06-13 09:55:27', '2024-06-13 09:55:27'),
(512, 8, 'What is the plural form of \"phenomenon\"?', 'phenomena', '2024-06-13 09:55:27', '2024-06-13 09:55:27');

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
('xm1QAKNJUEJnkG5zLSz9pMzwbOwcY99DH6aror09', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSWl0RGd5aExwYlJMeUlIUGVJR3pYZ0d1bFRxY3U2ZWJkNkExb2VtUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czo3OiJhbnN3ZXJzIjthOjExOntpOjA7czoxOiJhIjtpOjE7czoxOiJzIjtpOjI7czoxOiJkIjtpOjM7czoxOiJjIjtpOjQ7czoxOiJ6IjtpOjU7czoxOiJ2IjtpOjY7czoxOiJnIjtpOjc7czoxOiJlIjtpOjg7czoxOiJ3IjtpOjk7czoxOiJxIjtpOjEwO3M6MToiZyI7fX0=', 1718301848);

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
(3, 'admin', 'admin@gmail.com', NULL, '$2y$12$lZOMX3QEPlZEGyT5jNpx9ebGHx.cL7aFw.Z/JflgV0iCR5n9Uqcby', NULL, '2024-06-12 19:28:11', '2024-06-13 09:40:59', 100),
(4, 'bagas', 'bagas@gmail.com', NULL, '$2y$12$VHIRFB3de7rFYcG5AX2kh.fFiYdrwxPq5ciRZg7hxcFxiuSwvAn/e', NULL, '2024-06-13 00:28:45', '2024-06-13 10:15:28', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_categories`
--

CREATE TABLE `user_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_categories`
--

INSERT INTO `user_categories` (`id`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, NULL),
(2, 4, 2, NULL, NULL),
(3, 3, 1, NULL, NULL);

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
-- Indexes for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_categories_user_id_foreign` (`user_id`),
  ADD KEY `user_categories_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD CONSTRAINT `user_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
