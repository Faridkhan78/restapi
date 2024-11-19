-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 12:24 PM
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
-- Database: `restapi`
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
(3, '2024_11_08_092837_create_posts_table', 1),
(4, '2024_11_08_093125_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(15, 'App\\Models\\User', 1, 'API Token', 'daca8dea20b24a828c1a4008b2386c9e9da8b4e4440e3c987c8b793adcab395c', '[\"*\"]', NULL, NULL, '2024-11-09 00:16:49', '2024-11-09 00:16:49'),
(19, 'App\\Models\\User', 5, 'API Token', 'cf34bb46cc5ee00ba5d033f5a33f08567fdee92613dc98873803911e2c40f326', '[\"*\"]', NULL, NULL, '2024-11-09 07:02:08', '2024-11-09 07:02:08'),
(20, 'App\\Models\\User', 6, 'API Token', '531a9832aadb69d035ea2fbfd3b406eda4b39b9b17e6dcaeb4e32918f4e3ee11', '[\"*\"]', '2024-11-09 07:43:57', NULL, '2024-11-09 07:31:39', '2024-11-09 07:43:57'),
(21, 'App\\Models\\User', 7, 'API Token', 'c89cb500a069f4df8e3aa32e7c669c1bcd740718f613ec72e22e18bd4640933c', '[\"*\"]', '2024-11-09 07:45:56', NULL, '2024-11-09 07:42:50', '2024-11-09 07:45:56'),
(22, 'App\\Models\\User', 7, 'API Token', 'a4e6c62596bdd5d7ef70db855fea1905dba9e1c9c70eb4e89bd388a1793c963d', '[\"*\"]', '2024-11-11 00:40:21', NULL, '2024-11-09 07:46:09', '2024-11-11 00:40:21'),
(23, 'App\\Models\\User', 8, 'API Token', 'e0b9bfecc94b31eee8fa5037cc144fc1af4980bf696426c97d84fec5cf7a8279', '[\"*\"]', NULL, NULL, '2024-11-09 07:50:35', '2024-11-09 07:50:35'),
(25, 'App\\Models\\User', 10, 'API Token', '2bb0264e2c739f25ed2993cefce40389fb474df4d4030711e6ad0398edf7bb02', '[\"*\"]', NULL, NULL, '2024-11-11 00:35:24', '2024-11-11 00:35:24'),
(26, 'App\\Models\\User', 10, 'API Token', '08c4c69c257477cc8026849941c339b9afeacbccad6549c02c757ff58aa6d91e', '[\"*\"]', NULL, NULL, '2024-11-11 00:43:16', '2024-11-11 00:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'xyz', 'xyz@gmail.com', '$2y$12$ByQS03DQY5JBohMOpE1IoeMvw49bIvMlBmgmfNSCJQadM4hy7yKT.', '2024-11-09 00:17:38', '2024-11-09 00:17:38'),
(3, 'Farid', 'farid@gmail.com', '$2y$12$TfzqMY0Mtro9pZE3VotB6OnWrURtMJ5mvkxgZq9Bbpjbqz2Y6tu4S', '2024-11-09 00:19:50', '2024-11-09 00:19:50'),
(6, 'ahmed', 'ahmed@gmail.com', '$2y$12$ltIk2JpPM8ZvUKRp6YutI.ZxKOaHNWi3idI/qv3n2hpUalLLBwuVG', '2024-11-09 07:31:06', '2024-11-09 07:31:06'),
(7, 'akbar', 'akbar@gmail.com', '$2y$12$5e205EtzGw1s3TY6sTHPCuZAta1J9ReHuhvf1MM3fyYIglu/8jr56', '2024-11-09 07:42:06', '2024-11-09 07:42:06'),
(9, 'abc', 'abc@gmail.com', '$2y$12$Cg70TCbHNB0hwnpTWDyMIOoJ124EA3QeJk6T36U6izimEQY1cByIO', '2024-11-09 07:56:11', '2024-11-09 07:56:11'),
(10, 'rehman', 'rehman@gmail.com', '$2y$12$wF2uJy4BXGiYpZczPpeqA./2RnNOdVF6vfnt.WCj0h2d4wb23nHQ2', '2024-11-11 00:34:34', '2024-11-11 00:34:34');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
