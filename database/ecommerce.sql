-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jan 2025 pada 16.42
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rolex', 'Rolex', '0', '2024-12-06 06:17:29', '2024-12-07 00:14:46'),
(2, 'Louis Vuitton', 'Louis Vuitton', '1', '2024-12-06 06:35:31', '2024-12-06 06:35:31'),
(3, 'Gucci', 'Gucci', '1', '2024-12-06 06:37:40', '2024-12-06 06:37:40'),
(4, 'Dior', 'Dior', '1', '2024-12-06 06:37:51', '2024-12-06 06:37:51'),
(5, 'Chanel', 'Chanel', '1', '2024-12-06 06:38:02', '2024-12-06 06:38:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 6, 11, 1, '2024-12-28 08:45:37', '2024-12-28 08:45:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `showHome` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(97, 'Men\'s Fashion', 'Men\'s-Fashion', '1733226426.jpg', '1', '1', '2024-12-03 04:47:06', '2024-12-04 21:15:43'),
(98, 'Women\'s Fashion', 'Womens-Fashion', '1733226589.jpg', '1', '1', '2024-12-03 04:49:49', '2024-12-03 04:49:49'),
(99, 'Kids Fashion', 'Kids-Fashion', '1733226729.jpg', '1', '1', '2024-12-03 04:52:09', '2024-12-03 04:52:09'),
(100, 'Accessories', 'Accessories', '1733226832.jpg', '1', '1', '2024-12-03 04:53:52', '2024-12-04 06:05:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_26_141705_alter_users_table', 2),
(6, '2024_11_28_024728_create_categories_table', 3),
(7, '2024_11_30_002158_create_temp_images_table', 4),
(8, '2024_12_01_062410_create_sub_categories_table', 5),
(9, '2024_12_02_041321_alter_categories_table', 6),
(10, '2024_12_06_122328_create_brands_table', 7),
(11, '2024_12_06_134054_create_products_table', 8),
(12, '2024_12_06_134144_create_product_images_table', 8),
(13, '2024_12_17_115952_create_orders_table', 9),
(14, '2024_12_19_043440_create_order_items_table', 10),
(15, '2024_12_20_144214_add_status_to_orders_table', 11),
(16, '2024_12_24_151008_add_user_id_to_orders_table', 12),
(17, '2024_12_24_151012_add_user_id_to_orders_table', 12),
(18, '2024_12_24_151013_add_user_id_to_orders_table', 12),
(19, '2024_12_28_154224_create_carts_table', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_address` text NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `grand_total`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Hol', 'asfa@gmail.com', '123123', 'asdfs', 500000.00, 'Pending', '2024-12-18 21:50:43', '2024-12-18 21:50:43', 6),
(2, 'a', 'b@gm', '123', 'asd', 180000.00, 'Pending', '2024-12-18 21:53:37', '2024-12-18 21:53:37', 6),
(3, 'g', 'g@gmail.com', '1231233', 'gasd', 180000.00, 'Pending', '2024-12-18 22:27:00', '2024-12-18 22:27:00', 6),
(4, 'Hol1', 'asfa@gmail.com', '9887', 'awe', 180000.00, 'process', '2024-12-18 22:47:08', '2024-12-27 22:17:06', 6),
(5, 'dad', 'achcholili109@gmail.com', '1231233', 'jaksjda', 90000.00, 'complete', '2024-12-19 02:16:09', '2024-12-27 22:16:49', 6),
(6, 'ugg', 'uhyuh@huhg.com', '133', 'ygygy', 90000.00, 'complete', '2024-12-19 02:37:07', '2024-12-24 09:08:35', 6),
(7, 'sadf', 'asdf@gmail.com', '1231231', 'afdsaf', 400000.00, 'complete', '2024-12-19 06:05:20', '2024-12-24 09:08:31', 7),
(8, 'Hol', 'achcholili109@gmail.com', '9887', 'sfdfbyy', 80000.00, 'cancel', '2024-12-20 07:26:54', '2024-12-27 08:14:34', 6),
(26, 'Tes', 'user1@user.com', '321212', 'hsjdahjs', 90000.00, 'Pending', '2025-01-10 06:39:29', '2025-01-10 06:39:29', 6),
(27, 'Tes (1)', 'user2@user.com', '1827368712', 'adjfhasjdfh', 80000.00, 'Pending', '2025-01-10 07:33:29', '2025-01-10 07:33:29', 7),
(28, 'Tes (1)', 'user2@user.com', '12389123', 'qwerywqieru', 180000.00, 'Pending', '2025-01-10 07:35:50', '2025-01-10 07:35:50', 7),
(29, 'Tes', 'user1@user.com', '12893489132', 'asdhfsakdfh', 240000.00, 'Pending', '2025-01-11 08:18:17', '2025-01-11 08:18:17', 6),
(30, 'Tes', 'user1@user.com', '317283', 'hadsfkasdfh', 320000.00, 'Pending', '2025-01-11 08:25:48', '2025-01-11 08:25:48', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 2, 90000.00, '2024-12-18 21:50:43', '2024-12-18 21:50:43'),
(2, 1, 12, 4, 80000.00, '2024-12-18 21:50:43', '2024-12-18 21:50:43'),
(3, 2, 11, 2, 90000.00, '2024-12-18 21:53:37', '2024-12-18 21:53:37'),
(4, 3, 10, 3, 60000.00, '2024-12-18 22:27:00', '2024-12-18 22:27:00'),
(5, 4, 11, 2, 90000.00, '2024-12-18 22:47:08', '2024-12-18 22:47:08'),
(6, 5, 11, 1, 90000.00, '2024-12-19 02:16:09', '2024-12-19 02:16:09'),
(7, 6, 11, 1, 90000.00, '2024-12-19 02:37:07', '2024-12-19 02:37:07'),
(8, 7, 12, 4, 80000.00, '2024-12-19 06:05:20', '2024-12-19 06:05:20'),
(9, 7, 16, 1, 80000.00, '2024-12-19 06:05:20', '2024-12-19 06:05:20'),
(10, 8, 18, 1, 80000.00, '2024-12-20 07:26:55', '2024-12-20 07:26:55'),
(37, 26, 11, 1, 90000.00, '2025-01-10 06:39:31', '2025-01-10 06:39:31'),
(38, 27, 12, 1, 80000.00, '2025-01-10 07:33:32', '2025-01-10 07:33:32'),
(39, 28, 10, 3, 60000.00, '2025-01-10 07:35:50', '2025-01-10 07:35:50'),
(40, 29, 12, 3, 80000.00, '2025-01-11 08:18:23', '2025-01-11 08:18:23'),
(41, 30, 12, 3, 80000.00, '2025-01-11 08:25:48', '2025-01-11 08:25:48'),
(42, 30, 18, 1, 80000.00, '2025-01-11 08:25:48', '2025-01-11 08:25:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('Yes','No') NOT NULL DEFAULT 'No',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Men Shirt', 'men-shirt', 'desc', 60000.00, 90000.00, 97, 1, 1, 'No', '100', '100', 'Yes', 7, 1, '2024-12-15 20:50:28', '2025-01-11 08:24:13'),
(11, 'Kemeja Lengan Pendek Pria Hem Casual Barry Katun', 'kemeja-lengan-pendek-pria-hem-casual-barry-katun', 'desc', 90000.00, 100000.00, 97, 1, 1, 'No', '101', '101', 'Yes', 10, 1, '2024-12-15 20:53:47', '2024-12-22 00:36:14'),
(12, 'Baju Pria Lengan Panjang Atasan Kaos Cowok Distro Kekinian', 'baju-pria-lengan-panjang-atasan-kaos-cowok-distro-kekinian', 'kjkjkj', 80000.00, 90000.00, 97, 1, 1, 'No', '90', '1412', 'No', 16, 1, '2024-12-15 21:00:30', '2025-01-11 08:25:48'),
(13, '\" FONT COLORE \" PREMIUM T-SHIRT PENNAY |', '-font-colore--premium-t-shirt-pennay-', 'jksdj', 80000.00, 90000.00, 97, 1, 1, 'No', '56', '123', 'No', 32, 1, '2024-12-15 21:01:37', '2024-12-22 00:40:56'),
(14, 'Ropo Design Mini Dress', 'ropo-design-mini-dress', 'ljflsd', 90000.00, 100000.00, 98, 6, 1, 'No', '23', '123', 'No', 12, 1, '2024-12-15 21:04:28', '2024-12-23 02:01:09'),
(15, 'Ultimate Crop Bandeau Tops', 'ultimate-crop-bandeau-tops', 'kjkfjd', 80000.00, 90000.00, 98, 6, 1, 'No', '65', '12', 'No', 12, 1, '2024-12-15 21:05:40', '2024-12-23 02:00:27'),
(16, 'Classic Shell Top', 'classic-shell-top', 'kdjska', 80000.00, 90000.00, 98, 6, 1, 'No', '132', '21', 'No', 12, 1, '2024-12-15 21:09:22', '2024-12-23 02:01:26'),
(17, 'BAJU ATASAN KOREAN', 'baju-atasan-korean', 'kjskadj', 80000.00, 90000.00, 98, 6, 1, 'No', '1212', '10', 'No', 18, 1, '2024-12-15 21:12:55', '2024-12-23 02:01:36'),
(18, 'Two Mix Dress Anak Perempuan / Baju Anak Perempuan 4310', 'two-mix-dress-anak-perempuan--baju-anak-perempuan-4310', 'desc', 80000.00, 100000.00, 99, 13, 1, 'No', '103', '234', 'No', 9, 1, '2024-12-15 21:16:29', '2025-01-11 08:25:48'),
(19, 'Celana Formal', 'celana-formal', 'Celana Formal yang digunakan oleh para manusia berkelas', 150000.00, 200000.00, 97, 2, 1, 'No', '202', '232', 'Yes', 20, 0, '2025-01-10 07:57:51', '2025-01-10 07:58:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(21, 10, '1734852438_2.png', 1, '2024-12-22 00:27:18', '2024-12-22 00:27:18'),
(22, 11, '1734852974_download.jpeg', 1, '2024-12-22 00:36:14', '2024-12-22 00:36:14'),
(23, 12, '1734853027_2a8e984a-9d8f-4655-8ada-9af1e247b40b.jpg', 1, '2024-12-22 00:37:07', '2024-12-22 00:37:07'),
(24, 13, '1734853256_download.jpeg', 1, '2024-12-22 00:40:56', '2024-12-22 00:40:56'),
(25, 14, '1734853426_1.png', 1, '2024-12-22 00:43:46', '2024-12-22 00:43:46'),
(26, 15, '1734853488_6.png', 1, '2024-12-22 00:44:48', '2024-12-22 00:44:48'),
(27, 16, '1734853565_8.png', 1, '2024-12-22 00:46:05', '2024-12-22 00:46:05'),
(28, 17, '1734853653_2611fcf4f8fc56e205d3a1325fe6a677.jpg', 1, '2024-12-22 00:47:33', '2024-12-22 00:47:33'),
(29, 18, '1734854111_kid.jpeg', 1, '2024-12-22 00:55:11', '2024-12-22 00:55:11'),
(30, 19, '1736521071_download (2).jpg', 1, '2025-01-10 07:57:51', '2025-01-10 07:57:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Baju Pria', 'Baju Pria', 1, 97, '2024-12-04 04:34:34', '2024-12-06 09:36:28'),
(2, 'Celana Pria', 'Celana Pria', 1, 97, '2024-12-04 04:39:28', '2024-12-06 09:36:35'),
(3, 'Sepatu Pria', 'Sepatu Pria', 1, 97, '2024-12-04 04:39:57', '2024-12-06 09:36:43'),
(4, 'Jam Tangan', 'Jam Tangan', 1, 100, '2024-12-04 04:40:13', '2024-12-04 04:52:16'),
(5, 'Parfum', 'Parfum', 1, 100, '2024-12-04 04:40:27', '2024-12-04 04:53:15'),
(6, 'Baju Wanita', 'Baju Wanita', 1, 98, '2024-12-04 04:40:53', '2024-12-13 23:20:11'),
(7, 'Celana Wanita', 'Celana Wanita', 1, 98, '2024-12-04 04:51:00', '2024-12-06 09:36:52'),
(8, 'Sepatu Wanita', 'Sepatu Wanita', 1, 98, '2024-12-04 04:51:35', '2024-12-06 09:36:59'),
(9, 'Topi Pria', 'Topi Pria', 1, 97, '2024-12-04 04:52:30', '2024-12-06 09:37:24'),
(10, 'Topi Wanita', 'Topi Wanita', 1, 98, '2024-12-04 04:52:40', '2024-12-13 23:20:29'),
(11, 'Kalung', 'Kalung', 0, 100, '2024-12-04 04:53:30', '2024-12-04 20:31:18'),
(12, 'Gelang', 'Gelang', 1, 100, '2024-12-04 04:53:37', '2024-12-04 04:53:37'),
(13, 'Baju Anak', 'Baju Anak', 1, 99, '2024-12-04 04:54:08', '2024-12-06 09:37:39'),
(14, 'Celana Anak', 'Celana Anak', 1, 99, '2024-12-04 04:54:18', '2024-12-06 09:37:50'),
(15, 'Sepatu Anak', 'Sepatu Anak', 1, 99, '2024-12-04 04:54:32', '2024-12-06 09:37:58'),
(17, 'Topi Anak', 'Topi Anak', 1, 99, '2024-12-04 04:56:19', '2024-12-06 09:38:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `temp_images`
--

INSERT INTO `temp_images` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '1732926557.PNG', '2024-11-29 17:29:17', '2024-11-29 17:29:17'),
(2, '1732926904.png', '2024-11-29 17:35:04', '2024-11-29 17:35:04'),
(3, '1732927824.PNG', '2024-11-29 17:50:24', '2024-11-29 17:50:24'),
(4, '1732928280.PNG', '2024-11-29 17:58:00', '2024-11-29 17:58:00'),
(5, '1732928639.PNG', '2024-11-29 18:03:59', '2024-11-29 18:03:59'),
(6, '1732929565.PNG', '2024-11-29 18:19:25', '2024-11-29 18:19:25'),
(7, '1732930874.PNG', '2024-11-29 18:41:14', '2024-11-29 18:41:14'),
(8, '1732950960.PNG', '2024-11-30 00:16:00', '2024-11-30 00:16:00'),
(9, '1732952540.PNG', '2024-11-30 00:42:20', '2024-11-30 00:42:20'),
(10, '1732953013.PNG', '2024-11-30 00:50:13', '2024-11-30 00:50:13'),
(11, '1732953018.PNG', '2024-11-30 00:50:18', '2024-11-30 00:50:18'),
(12, '1732955065.PNG', '2024-11-30 01:24:26', '2024-11-30 01:24:26'),
(13, '1732955377.PNG', '2024-11-30 01:29:37', '2024-11-30 01:29:37'),
(14, '1732955553.PNG', '2024-11-30 01:32:33', '2024-11-30 01:32:33'),
(15, '1732955785.PNG', '2024-11-30 01:36:26', '2024-11-30 01:36:26'),
(16, '1732956120.PNG', '2024-11-30 01:42:00', '2024-11-30 01:42:00'),
(17, '1732956189.PNG', '2024-11-30 01:43:09', '2024-11-30 01:43:09'),
(18, '1732956246.PNG', '2024-11-30 01:44:06', '2024-11-30 01:44:06'),
(19, '1732957026.PNG', '2024-11-30 01:57:06', '2024-11-30 01:57:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', 'admin', NULL, '$2y$10$TqmJwdsLvcDiJrNyLY9RUuijQhYWKajUlzGeBIGB8I/FA4CGCDeGu', NULL, '2024-11-26 07:24:10', '2024-11-26 07:24:10'),
(2, 'Ahmad Cholilillah', 'achcholili109@gmail.com', 'admin', NULL, '$2y$10$2PU7wnrDYWPr90L3uXgm.uruHsuJbbaAg7p6YilvNrHi.QpLzdsFW', NULL, '2024-11-26 07:26:15', '2024-11-26 07:26:15'),
(4, 'Hol', 'admin@admin.com', 'admin', NULL, '$2y$10$tTmrKvwYq3RxAv00aSJem.Bso.RFhBKACUmR9IjX4s2DVZufsOuGC', NULL, '2024-12-22 14:18:30', '2024-12-22 14:18:30'),
(5, 'tes', 'user@user.com', 'user', NULL, '$2y$10$K0vXulKIcgferzvxcr46XeA.Erk0Ie2cUwLclc/cBmkYKxcXttO/W', NULL, '2024-12-22 16:06:34', '2024-12-22 16:06:34'),
(6, 'Tes', 'user1@user', 'user', NULL, '$2y$10$TREcItfvsd/quoSULa2tgOakwCNt.YJbEiVYGgEdduhbJesGH7ImW', NULL, '2024-12-22 16:53:56', '2024-12-22 16:53:56'),
(7, 'Tes (1)', 'user2@user', 'user', NULL, '$2y$10$TcJ5QUeacoOSyX/ChUBbve7jzZhLtWedyw8zzOzSZ7jueo2DOL2WC', NULL, '2024-12-23 21:31:00', '2024-12-23 21:31:00'),
(8, 'Tes (2)', 'user3@user', 'user', NULL, '$2y$10$7BWwyeQUxAezyg0Rbuimju9TjRsK1RBeLtNgPWTyxNXJSqK0OTe.G', NULL, '2024-12-23 21:33:32', '2024-12-23 21:33:32');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indeks untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
