-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 03:46 PM
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
-- Database: `cell-seeding-calculator`
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
-- Table structure for table `culture_vessels`
--

CREATE TABLE `culture_vessels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plate_format` varchar(255) NOT NULL,
  `surface_area_cm2` double DEFAULT NULL,
  `media_volume_per_well_ml` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `culture_vessels`
--

INSERT INTO `culture_vessels` (`id`, `plate_format`, `surface_area_cm2`, `media_volume_per_well_ml`, `created_at`, `updated_at`) VALUES
(1, '6-well plate', 9.6, 2.5, NULL, NULL),
(2, '12-well plate', 3.5, 1, NULL, NULL),
(3, '24-well plate', 1.9, 0.5, NULL, NULL),
(4, '48-well plate', 1.1, 0.25, NULL, NULL),
(5, '96-well plate', 0.32, 0.1, NULL, NULL),
(6, '384-well plate', 0.056, 0.03, NULL, NULL),
(7, 'Other', NULL, NULL, NULL, NULL),
(8, 'imaging ibidi 96-well plate', NULL, NULL, NULL, NULL),
(9, '6-well plate', 9.6, 2.5, NULL, NULL),
(10, '12-well plate', 3.5, 1, NULL, NULL),
(11, '24-well plate', 1.9, 0.5, NULL, NULL),
(12, '48-well plate', 1.1, 0.25, NULL, NULL),
(13, '96-well plate', 0.32, 0.1, NULL, NULL),
(14, '384-well plate', 0.056, 0.03, NULL, NULL),
(15, 'Other', NULL, NULL, NULL, NULL),
(16, 'imaging ibidi 96-well plate', NULL, NULL, NULL, NULL);

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
(5, '2025_04_21_080346_create_cell_types_table', 2),
(6, '2025_04_21_101418_create_culture_vessels_table', 3),
(7, '2025_04_22_090859_add_username_to_users_table', 4),
(8, '2025_04_22_091335_create_personal_access_tokens_table', 5),
(9, '2025_04_22_111534_rename_cell_types_to_products_and_modify_columns', 6),
(10, '2025_04_22_113421_make_sku_nullable_in_products_table', 7);

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

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `seeding_density` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `sku`, `seeding_density`, `created_at`, `updated_at`) VALUES
(101, 'not ioCells', NULL, NULL, NULL, '2025-04-22 07:56:03'),
(102, 'CRISPRa-Ready ioGlutamatergic Neurons', 'io1099S', 30000, NULL, NULL),
(103, 'CRISPRi-Ready ioGlutamatergic Neurons', 'io1098S', 30000, NULL, NULL),
(104, 'CRISPRko-Ready ioGlutamatergic Neurons', 'io1090S', 30000, NULL, NULL),
(105, 'CRISPRko-Ready ioMicroglia | Male', 'io1094S', 30000, NULL, NULL),
(106, 'GFP ioMicroglia | Male', 'io1096S', 30000, NULL, NULL),
(107, 'ioAstrocytes', 'ioEA1093', 30000, NULL, NULL),
(108, 'ioGABAergic Neurons', 'io1003S', 30000, NULL, NULL),
(109, 'ioGABAergic Neurons APP V717I/V717I', 'io1081S', 30000, NULL, NULL),
(110, 'ioGABAergic Neurons APP V717I/WT', 'io1085S', 30000, NULL, NULL),
(111, 'ioGlutamatergic Neurons', 'io1001S', 30000, NULL, NULL),
(112, 'ioGlutamatergic Neurons APP KM670/671NL / KM670/671NL', 'io1059S', 30000, NULL, NULL),
(113, 'ioGlutamatergic Neurons APP KM670/671NL/WT', 'io1061S', 30000, NULL, NULL),
(114, 'ioGlutamatergic Neurons APP V717I/V717I', 'io1063S', 30000, NULL, NULL),
(115, 'ioGlutamatergic Neurons APP V717I/WT', 'io1067S', 30000, NULL, NULL),
(116, 'ioGlutamatergic Neurons GBA null/R159W', 'io1007S', 30000, NULL, NULL),
(117, 'ioGlutamatergic Neurons GBA null/WT', 'io1007S', 30000, NULL, NULL),
(118, 'ioGlutamatergic Neurons HTT 50CAG/WT', 'ioEA1004S', 30000, NULL, NULL),
(119, 'ioGlutamatergic Neurons MAPT N279K/N279K', 'io1014S', 30000, NULL, NULL),
(120, 'ioGlutamatergic Neurons MAPT N279K/WT', 'io1009S', 30000, NULL, NULL),
(121, 'ioGlutamatergic Neurons MAPT P301S/P301S', 'io1008S', 30000, NULL, NULL),
(122, 'ioGlutamatergic Neurons MAPT P301S/WT', 'io1015S', 30000, NULL, NULL),
(123, 'ioGlutamatergic Neurons PINK1 Q456X/Q456X', 'io1076S', 30000, NULL, NULL),
(124, 'ioGlutamatergic Neurons PINK1 Q456X/WT', 'io1079S', 30000, NULL, NULL),
(125, 'ioGlutamatergic Neurons PRKN R275W/R275W', 'io1020S', 30000, NULL, NULL),
(126, 'ioGlutamatergic Neurons PRKN R275W/WT', 'io1013S', 30000, NULL, NULL),
(127, 'ioGlutamatergic Neurons PSEN1 M146L/M146L', 'io1069S', 30000, NULL, NULL),
(128, 'ioGlutamatergic Neurons PSEN1 M146L/WT', 'io1072S', 30000, NULL, NULL),
(129, 'ioGlutamatergic Neurons SNCA A53T/A53T', 'io1088S', 30000, NULL, NULL),
(130, 'ioGlutamatergic Neurons SNCA A53T/WT', 'io6005S', 30000, NULL, NULL),
(131, 'ioGlutamatergic Neurons TDP-43 M337V/M337V', 'ioEA1005S', 30000, NULL, NULL),
(132, 'ioGlutamatergic Neurons TDP-43 M337V/WT', 'ioEA1006S', 30000, NULL, NULL),
(133, 'ioMicroglia | Female', 'io1029S', 30000, NULL, NULL),
(134, 'ioMicroglia | Male', 'io1021S', 30000, NULL, NULL),
(135, 'ioMicroglia APOE 4/3 C112R/WT', 'io1033S', 30000, NULL, NULL),
(136, 'ioMicroglia APOE 4/4 C112R/C112R', 'io1032S', 30000, NULL, NULL),
(137, 'ioMicroglia TREM2 R47H/R47H', 'io1035S', 30000, NULL, NULL),
(138, 'ioMicroglia TREM2 R47H/WT', 'io1038S', 30000, NULL, NULL),
(139, 'ioMotor Neurons', 'io1027S', 30000, NULL, NULL),
(140, 'ioMotor Neurons FUS P525L/P525L', 'io1052S', 30000, NULL, NULL),
(141, 'ioMotor Neurons FUS P525L/WT', 'io1055S', 30000, NULL, NULL),
(142, 'ioMotor Neurons SOD-1 G93A/G93A', 'io1041S', 30000, NULL, NULL),
(143, 'ioMotor Neurons SOD-1 G93A/WT', 'io1042S', 30000, NULL, NULL),
(144, 'ioMotor Neurons TDP-43 M337V/M337V', 'io1046S', 30000, NULL, NULL),
(145, 'ioMotor Neurons TDP-43 M337V/WT', 'io1050S', 30000, NULL, NULL),
(146, 'ioOligodendrocyte-like cells', 'io1028S', 27000, NULL, NULL),
(147, 'ioSensory Neurons', 'io1024S', 30000, NULL, NULL),
(148, 'ioSkeletal Myocytes', 'io1002S', 30000, NULL, NULL),
(149, 'ioSkeletal Myocytes DMD Exon 44 Deletion', 'io1018S', 30000, NULL, NULL),
(150, 'ioSkeletal Myocytes DMD Exon 52 Deletion', 'io1019S', 30000, NULL, NULL);

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
('15TUfcbbiNDzonXtjMYNl4QugueeD7qQDdw1mLmH', NULL, '127.0.0.1', 'Thunder Client (https://www.thunderclient.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1BvTkxseDJ5VHM2RVhYV2ZWSTZrNEJkZG12NDFWT1ZzTmNzR1R2UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9kdWN0cy8xMDEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1745322544),
('GTpQ4TXIk7Arbchbnx05s31c1vFY1XvsL7htMaj0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ3JqaDY4bmZBbU84ZjFZWGZqUzdZWmFJQU1mWmVXWmc0ZXoxUmp0NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvZGFzaGJvYXJkIjt9fQ==', 1745329250),
('Pi6uBiRjhUr2xqkHvdxNc7oxjnnrIqYKMH0Wgxx7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOERSa2pIM216cjNMMjFKNDRkcnBTandyQVZpOGJEVmZGaVNYellOVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jdWx0dXJlLXZlc3NlbHMiO319', 1745329321);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Calculator Admin', 'admin', 'admin@admin.com', '2025-04-21 13:52:20', '$2y$12$Gs.9Y7VZe7EWwlCJGtdP1egoUjmLTlPbMW5vEpyQugX44pYhnXda.', 'VXHPLqQ19pEhotSYrxZyiy9a0mwgT04wnSKCnBost6KtjYNgmLMvmGK3YDAo', '2025-04-21 13:52:20', '2025-04-22 04:49:39');

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
-- Indexes for table `culture_vessels`
--
ALTER TABLE `culture_vessels`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `culture_vessels`
--
ALTER TABLE `culture_vessels`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
