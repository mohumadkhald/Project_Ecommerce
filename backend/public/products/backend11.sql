-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 10:40 AM
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
-- Database: `backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `added_to_cart_products`
--

CREATE TABLE `added_to_cart_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'smart phones', 'assets/uploads/categories/1709903724.png', '2024-03-08 11:15:24', '2024-03-08 11:15:24'),
(2, 'laptops', 'assets/uploads/categories/1709903974.png', '2024-03-08 11:19:34', '2024-03-08 11:19:34'),
(3, 'cat1', 'assets/uploads/categories/1709903724.png', '2024-03-08 11:15:24', '2024-03-08 11:15:24'),
(4, 'cat2', 'assets/uploads/categories/1709903974.png', '2024-03-08 11:19:34', '2024-03-08 11:19:34'),
(5, 'cat3', 'assets/uploads/categories/1709903724.png', '2024-03-08 11:15:24', '2024-03-08 11:15:24'),
(6, 'cat4', 'assets/uploads/categories/1709903974.png', '2024-03-08 11:19:34', '2024-03-08 11:19:34'),
(7, 'cat5', 'assets/uploads/categories/1709903724.png', '2024-03-08 11:15:24', '2024-03-08 11:15:24'),
(8, 'cat6', 'assets/uploads/categories/1709903974.png', '2024-03-08 11:19:34', '2024-03-08 11:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `erequests`
--

CREATE TABLE `erequests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_user_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_user_id` bigint(20) UNSIGNED NOT NULL,
  `sender_post_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_post_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_02_011944_test', 1),
(6, '2024_03_02_134013_add_additional_fields_to_users_table', 2),
(7, '2024_03_02_135454_create_posts', 3),
(8, '2024_03_02_141532_create_request', 4),
(9, '2024_03_02_154813_rename_exchange_requests_table', 5),
(10, '2024_03_02_155815_rename_exchange_requests_table2', 6),
(11, '2024_03_02_222758_change_image_column_type_in_posts_table', 7),
(12, '2024_03_03_043636_add_title_to_posts_table', 8),
(13, '2024_03_04_212700_add_role_to_users_table', 9),
(14, '2024_03_04_213448_rename_posts_table_and_add_columns', 10),
(16, '2024_03_04_221240_create_added_to_cart_products_table', 11),
(17, '2024_03_05_014719_add_cart_to_users_table', 12),
(18, '2024_03_05_041213_create_purchases_table', 13),
(19, '2024_03_05_041649_create_purchased_products_table', 14),
(20, '2024_03_04_230711_create_brands_table', 15),
(21, '2024_03_05_001011_create_category_table', 15),
(22, '2024_03_05_013453_category_to_categories', 15),
(24, '2024_03_06_073734_add_hidden_column_to_products_table', 16),
(25, '2024_03_06_084607_add_columns_to_purchased_products_table', 17),
(26, '2024_03_06_101136_add_rate_to_products', 18),
(27, '2024_03_06_190708_modify_refrences_in_purchased_products', 19),
(28, '2024_03_06_191759_modify_product_id_in_added_to_cart_products', 20),
(29, '2024_03_08_125838_add_category_id_to_table_name', 21);

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'samsung', '7ad982e560612daf79e6fe2658888db3f4883de0c99b53f41f6c72593d56cb7e', '[\"*\"]', '2024-03-06 23:09:33', NULL, '2024-03-02 14:12:42', '2024-03-06 23:09:33'),
(2, 'App\\Models\\User', 2, 'iphone', '0f25f62993897f6e68771c633571b053a4c04dcb758b8c7360fd92c906014802', '[\"*\"]', '2024-03-09 15:06:40', NULL, '2024-03-02 23:32:16', '2024-03-09 15:06:40'),
(3, 'App\\Models\\User', 1, 'samsung', '8f00d8e4fa41e83342b7e88a96a1fbf90aa9c78139f0246ef6ac0c263c422462', '[\"*\"]', NULL, NULL, '2024-03-04 15:12:00', '2024-03-04 15:12:00'),
(4, 'App\\Models\\User', 2, 'samsung', '24a662836fdd035731bd08becabef8feb6494e07050362214ea264cb9c58b21c', '[\"*\"]', '2024-03-08 11:15:58', NULL, '2024-03-06 22:59:59', '2024-03-08 11:15:58'),
(5, 'App\\Models\\User', 1, 'samsung', 'c63e102649a7107e4a1be491f9be806e888c508f7e79e8ead1b9d69d0735dd92', '[\"*\"]', '2024-03-08 11:34:46', NULL, '2024-03-07 10:00:42', '2024-03-08 11:34:46'),
(6, 'App\\Models\\User', 1, 'Windows PC', '4637f27281987522b9c0623523815b84f1caef686e13169c55de9f5b61eab8b1', '[\"*\"]', '2024-03-07 19:55:08', NULL, '2024-03-07 19:54:52', '2024-03-07 19:55:08'),
(7, 'App\\Models\\User', 1, 'Windows PC', '1e5a4056d9fd720d5c94b008ed5f9b04fae444421af41656efff3ebd628956f7', '[\"*\"]', '2024-03-07 19:56:08', NULL, '2024-03-07 19:56:08', '2024-03-07 19:56:08'),
(8, 'App\\Models\\User', 1, 'Windows PC', '9125713c423643df48e44beea28182980b6eb785ff0757d8342fecb325379c63', '[\"*\"]', '2024-03-09 15:04:18', NULL, '2024-03-07 20:30:39', '2024-03-09 15:04:18'),
(9, 'App\\Models\\User', 1, 'Windows PC', '87594a928ea09ef2edfb1ff680b145122a8fc8fb4116aeec5b35bce4a4510a29', '[\"*\"]', '2024-03-09 17:04:40', NULL, '2024-03-09 16:46:14', '2024-03-09 17:04:40'),
(10, 'App\\Models\\User', 1, 'sdasdsdfsdf', '320a8581e7a86043291c1d483e18613f3c543824dcdcaeccf07540d8f6b07d61', '[\"*\"]', '2024-03-09 16:54:44', NULL, '2024-03-09 16:53:03', '2024-03-09 16:54:44'),
(11, 'App\\Models\\User', 12, 'Windows PC', 'e6281534f248b72eb5681edea3db356ec7bba42f2e213eec95fc124095394049', '[\"*\"]', '2024-03-09 18:25:21', NULL, '2024-03-09 17:16:13', '2024-03-09 18:25:21'),
(12, 'App\\Models\\User', 1, 'Windows PC', '16f07738238809fe7a7556d5c4387a096f213b8ffbfbe38728521f53badfa2b3', '[\"*\"]', '2024-03-10 03:38:08', NULL, '2024-03-09 18:32:16', '2024-03-10 03:38:08'),
(13, 'App\\Models\\User', 1, 'Windows PC', 'bec656db3cd59e6ed7f93c85e32adfdf831b53c45e73890469d8dfa40eec873d', '[\"*\"]', '2024-03-10 04:41:36', NULL, '2024-03-10 03:39:07', '2024-03-10 04:41:36'),
(14, 'App\\Models\\User', 13, 'Windows PC', '5a869e8f1ce2a60184041599a4bca6c5425e4a117c546725fb81c55bd2b113ac', '[\"*\"]', '2024-03-10 05:50:14', NULL, '2024-03-10 04:50:06', '2024-03-10 05:50:14'),
(15, 'App\\Models\\User', 13, 'Windows PC', '247250eef8aad8e1cc866b86d2893a5bd7b360aebbb81722c4aad3fa4a6614cc', '[\"*\"]', '2024-03-10 06:50:54', NULL, '2024-03-10 05:53:07', '2024-03-10 06:50:54'),
(16, 'App\\Models\\User', 13, 'Windows PC', '59403950f908fc52c31dfb67aa5a8c9e8116cc9d7c510277333e44cda285fe11', '[\"*\"]', '2024-03-10 06:59:57', NULL, '2024-03-10 06:51:44', '2024-03-10 06:59:57'),
(17, 'App\\Models\\User', 13, 'Windows PC', '0f4fc276566a40a3f6cd783dd02823624da52ba017b945ec0352eaf0a5e59bf8', '[\"*\"]', '2024-03-10 07:02:32', NULL, '2024-03-10 07:01:11', '2024-03-10 07:02:32'),
(18, 'App\\Models\\User', 2, 'Windows PC', 'd0fe06b00ecf494671322f0d77ca23c73979c5c0032b84d872cf2186c132b9d6', '[\"*\"]', '2024-03-10 07:04:20', NULL, '2024-03-10 07:04:04', '2024-03-10 07:04:20'),
(19, 'App\\Models\\User', 1, 'Windows PC', '9aed490b6888c0527921ae8c39a2270f220870d26ab76721693203762ba36a40', '[\"*\"]', '2024-03-10 07:13:35', NULL, '2024-03-10 07:04:45', '2024-03-10 07:13:35'),
(20, 'App\\Models\\User', 13, 'Windows PC', 'd3dcff764c970f916007fe893a7e8acfc8730c9d3b6fcaa93dabc8273f1fabde', '[\"*\"]', '2024-03-10 07:35:57', NULL, '2024-03-10 07:14:11', '2024-03-10 07:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `deleted` enum('','admin','user') DEFAULT NULL,
  `rating` float UNSIGNED DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `description`, `title`, `image`, `created_at`, `updated_at`, `price`, `quantity`, `deleted`, `rating`, `category_id`) VALUES
(67, 13, 'hello', 'watch', '/products/1710062124.webp', '2024-03-10 07:15:24', '2024-03-10 07:15:24', 1588.00, 5, NULL, 0, 1),
(68, 13, 'hello', 'apple vision', '/products/1710062258.webp', '2024-03-10 07:17:38', '2024-03-10 07:17:38', 54888.00, 5, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchased_products`
--

CREATE TABLE `purchased_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int(10) UNSIGNED DEFAULT NULL,
  `references` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchased_products`
--

INSERT INTO `purchased_products` (`id`, `buyer_id`, `quantity`, `purchase_id`, `created_at`, `updated_at`, `rating`, `references`) VALUES
(70, 2, 1, 67, '2024-03-08 20:43:10', '2024-03-08 20:43:10', NULL, NULL),
(71, 2, 1, 68, '2024-03-08 22:29:51', '2024-03-08 22:29:51', NULL, NULL),
(72, 2, 1, 69, '2024-03-09 12:32:26', '2024-03-09 12:32:26', NULL, NULL),
(73, 2, 1, 69, '2024-03-09 12:32:26', '2024-03-09 12:32:26', NULL, NULL),
(74, 2, 1, 70, '2024-03-09 14:31:35', '2024-03-09 14:31:35', NULL, NULL),
(75, 2, 1, 70, '2024-03-09 14:31:35', '2024-03-09 14:31:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `state` enum('not delivered','delivered') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `buyer_id`, `state`, `created_at`, `updated_at`) VALUES
(67, 2, 'delivered', '2024-03-08 20:43:10', '2024-03-08 22:23:53'),
(68, 2, 'not delivered', '2024-03-08 22:29:51', '2024-03-08 22:29:51'),
(69, 2, 'delivered', '2024-03-09 12:32:25', '2024-03-09 12:42:07'),
(70, 2, 'not delivered', '2024-03-09 14:31:35', '2024-03-09 14:31:35');

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
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `role` enum('admin','buyer','seller') NOT NULL,
  `cart` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone_number`, `address`, `gender`, `role`, `cart`) VALUES
(1, 'prinder', 'm@m.com', NULL, '$2y$12$sCjo8aRmO0parTW7VwIVWuw3B58vGoQvAVg69651EHMHYvwTAelNu', NULL, '2024-03-01 23:23:45', '2024-03-07 20:19:46', NULL, 'qalyub', NULL, 'admin', 8),
(2, 'zain el zain', 'omar1@gmail.com', NULL, '$2y$12$E1rNBGnjL0jahpzryxoz/es5vqBrm9PkK5PjomwnEdpB5SdETg0UW', NULL, '2024-03-02 23:29:26', '2024-03-09 14:31:35', '01022416098', 'alex', NULL, 'seller', 0),
(12, 'medo', 'm@mm.com', NULL, '$2y$12$zfn.k2HZMcnlY0t0qL068eips4bNAdNaMeeaEB./iKAnGJXZWMAOO', NULL, '2024-03-09 17:15:59', '2024-03-09 17:15:59', '01124534534', 'fghdfghdfghdfghfgh', NULL, 'seller', NULL),
(13, 'medo', 'medo@gmail.com', NULL, '$2y$12$83jG4YJXDT9G1yueL9HRwem7sSISTwLW8Uef93nHMNyX611.0NppW', NULL, '2024-03-10 04:48:20', '2024-03-10 04:48:20', '01124534534', 'sdfsddsfsddsfsdfsd', NULL, 'seller', NULL),
(14, 'admin', 'admin@a.com', NULL, '$2y$12$48MBdkn28V8Mk6hyFl/52.7r7vld623AkrMeZBc3kNqNxh3ZWzKke', NULL, '2024-03-10 07:27:38', '2024-03-10 07:27:38', NULL, NULL, NULL, 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `added_to_cart_products`
--
ALTER TABLE `added_to_cart_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_to_cart_products_buyer_id_foreign` (`buyer_id`),
  ADD KEY `added_to_cart_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erequests`
--
ALTER TABLE `erequests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exchange_requests_sender_user_id_foreign` (`sender_user_id`),
  ADD KEY `exchange_requests_receiver_user_id_foreign` (`receiver_user_id`),
  ADD KEY `exchange_requests_sender_post_id_foreign` (`sender_post_id`),
  ADD KEY `exchange_requests_receiver_post_id_foreign` (`receiver_post_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `purchased_products`
--
ALTER TABLE `purchased_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchased_products_buyer_id_foreign` (`buyer_id`),
  ADD KEY `purchased_products_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchased_products_references_foreign` (`references`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_buyer_id_foreign` (`buyer_id`);

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
-- AUTO_INCREMENT for table `added_to_cart_products`
--
ALTER TABLE `added_to_cart_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `erequests`
--
ALTER TABLE `erequests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `purchased_products`
--
ALTER TABLE `purchased_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `added_to_cart_products`
--
ALTER TABLE `added_to_cart_products`
  ADD CONSTRAINT `added_to_cart_products_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `added_to_cart_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `erequests`
--
ALTER TABLE `erequests`
  ADD CONSTRAINT `exchange_requests_receiver_post_id_foreign` FOREIGN KEY (`receiver_post_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `exchange_requests_receiver_user_id_foreign` FOREIGN KEY (`receiver_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `exchange_requests_sender_post_id_foreign` FOREIGN KEY (`sender_post_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `exchange_requests_sender_user_id_foreign` FOREIGN KEY (`sender_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `purchased_products`
--
ALTER TABLE `purchased_products`
  ADD CONSTRAINT `purchased_products_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchased_products_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`),
  ADD CONSTRAINT `purchased_products_references_foreign` FOREIGN KEY (`references`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
