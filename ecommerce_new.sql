-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2024 at 09:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_new`
--

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_03_25_181053_create_tbkategoris_table', 1),
(3, '2024_03_25_181246_create_tbsatuans_table', 1),
(4, '2024_03_25_181350_create_tbpelanggans_table', 1),
(5, '2024_03_25_181714_create_tbpemasoks_table', 1),
(6, '2024_03_25_183107_create_tbstoks_table', 1),
(7, '2024_05_04_140019_create_tbsliders_table', 1),
(8, '2024_05_16_072902_create_tbrole_table', 1),
(9, '2024_05_16_074532_create_users_table', 1),
(10, '2024_05_16_074555_create_tbpesanans_table', 1),
(11, '2024_05_16_082132_create_users_table', 2),
(12, '2024_05_16_082325_create_tbpesanans_table', 3),
(13, '2024_05_23_162622_create_tbpesanans_table', 4),
(14, '2024_05_23_162726_create_tbpesanans_table', 5),
(15, '2024_05_26_164046_create_tbpesanans_table', 6),
(16, '2024_05_26_164422_create_tbpesanans_table', 7),
(17, '2024_05_26_164821_create_tbpesanans_table', 8),
(18, '2024_05_27_022519_create_tbcheckout_table', 9),
(19, '2024_05_27_140650_create_tbpesanandetail_table', 10),
(20, '2024_05_27_141154_create_tbcheckout_table', 11),
(21, '2024_05_31_011045_create_tbcheckouts_table', 12),
(22, '2024_05_31_011050_create_tbcheckoutdetails_table', 12),
(23, '2024_05_31_011323_create_tbcheckout_table', 13),
(24, '2024_05_31_012245_create_tbcheckout_table', 14),
(25, '2024_05_31_012257_create_tbcheckoutdetail_table', 14),
(26, '2024_05_31_040854_create_tbcheckoutdetail_table', 15),
(27, '2024_05_31_085454_add_status_to_tbpesanans_table', 16),
(28, '2024_06_02_071511_create_tbcheckoutreturn_table', 17),
(29, '2024_06_14_111356_add_bukti_transaksi_to_tbcheckoutdetail_table', 18),
(30, '2024_06_17_101404_add_id_user_foreign_to_tbpesanandetail_table', 19),
(31, '2024_06_17_114939_add_id_user_foreign_to_tbpesanandetail_table', 20),
(32, '2024_06_17_115247_add_id_user_foreign_to_tbpesanandetail_table', 21),
(33, '2024_06_17_135230_add_id_user_foreign_to_tbcheckoutdetail_table', 22),
(34, '2024_06_19_164021_create_tbmutasi_table', 23),
(35, '2024_06_20_204417_create_tb_stok_rekap_table', 24),
(36, '2024_06_24_155102_update_foreign_keys_on_tbpesanans_and_tbstok_tables', 25),
(37, '2024_06_29_144914_add_id_vendor_to_tbstok_table', 26),
(38, '2024_06_30_132936_create_tbkeluars_table', 27),
(39, '2024_06_30_152415_create_tbreturnjuals_table', 28),
(40, '2024_06_30_164147_create_tbmasuks_table', 29),
(41, '2024_06_30_172756_create_tbreturnbelis_table', 29),
(42, '2024_06_30_195651_add_stok_rekap_to_tbreturnbeli_table', 30),
(43, '2024_06_30_200704_remove_foreign_key_tbreturnbeli', 31),
(44, '2024_06_30_201011_add_foreign_key_tbreturnbeli_tbmasuk', 32),
(45, '2024_06_30_211257_add_user_id_to_tb_stok_rekap_table', 33),
(46, '2024_07_04_042141_create_tbcheckouts_table', 34),
(47, '2024_07_05_113629_add_vendor_id_to_tbstokrekaps_table', 34),
(48, '2024_07_09_082039_create_tbmutasis_table', 35),
(49, '2024_07_09_101122_drop_foreign_key_from_tbstok_table', 36);

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

-- --------------------------------------------------------

--
-- Table structure for table `tbcheckoutdetail`
--

CREATE TABLE `tbcheckoutdetail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `kode_status` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `bukti_transaksi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbcheckoutdetail`
--

INSERT INTO `tbcheckoutdetail` (`id`, `id_user`, `kode`, `status`, `kode_status`, `quantity`, `price`, `bukti_transaksi`, `created_at`, `updated_at`) VALUES
(135, 12, 'TYSX20240715085132_1266A6', 'completed', 'k', 4, 11058000.00, 'bukti pembayaran.jpg', '2024-07-15 01:51:32', '2024-07-15 01:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbcheckoutreturn`
--

CREATE TABLE `tbcheckoutreturn` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_checkout` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'return',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbcheckouts`
--

CREATE TABLE `tbcheckouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbkategori`
--

CREATE TABLE `tbkategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbkategori`
--

INSERT INTO `tbkategori` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'HP', NULL, NULL),
(2, 'Laptop', NULL, NULL),
(3, 'Tablet', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbmutasi`
--

CREATE TABLE `tbmutasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_bukti` varchar(255) NOT NULL,
  `mk` varchar(255) NOT NULL,
  `barang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `ket` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbmutasi`
--

INSERT INTO `tbmutasi` (`id`, `no_bukti`, `mk`, `barang`, `qty`, `harga`, `tanggal`, `status`, `bukti_pembayaran`, `user_id`, `ket`, `created_at`, `updated_at`) VALUES
(50, 'TYSX20240715085132_1266A6', 'k', 'SAMSUNG GALAXY A15 5G 8/256 & A15 4G 8/128 & 8/256 NEW GARANSI RESMI', 2, '6658000', '2024-07-15 08:53:24', 'keluar', 'Null', '11', 'Barang Keluar', '2024-07-15 01:53:24', '2024-07-15 01:53:24'),
(51, 'TYSX20240715085132_1266A6', 'k', 'MILS Floating Magic Keyboard', 2, '4400000', '2024-07-15 08:53:24', 'keluar', 'Null', '11', 'Barang Keluar', '2024-07-15 01:53:24', '2024-07-15 01:53:24'),
(52, 'TYSFI20240715085600', 'm', 'Samsung Galaxy M15 5G', 2, '4400000', '2024-07-15 15:56:00', 'masuk', 'Null', '11', 'Barang Masuk', '2024-07-15 01:57:46', '2024-07-15 01:57:46'),
(53, 'TYSFI20240715085600', 'm', 'MILS Floating Magic Keyboard', 1, '2000000', '2024-07-15 15:56:00', 'masuk', 'Null', '11', 'Barang Masuk', '2024-07-15 01:57:46', '2024-07-15 01:57:46'),
(54, 'TYSFI20240715085600', 'm', 'SAMSUNG GALAXY A15 5G 8/256 & A15 4G 8/128 & 8/256 NEW GARANSI RESMI', 2, '6000000', '2024-07-15 15:56:00', 'masuk', 'Null', '11', 'Barang Masuk', '2024-07-15 01:57:46', '2024-07-15 01:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbpelanggan`
--

CREATE TABLE `tbpelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `top` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbpemasok`
--

CREATE TABLE `tbpemasok` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `top` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbpemasok`
--

INSERT INTO `tbpemasok` (`id`, `kode`, `nama`, `alamat`, `nohp`, `top`, `created_at`, `updated_at`) VALUES
(1, 'VNDTS20240629144959528', 'PT. DGI', 'Pekanbaru', '08xxxxx', '2024-07-09', '2024-06-29 07:49:59', '2024-07-09 06:34:56'),
(2, 'VNDTS20240708121248180', 'PT. PStore', 'Pekanbaru', '08xxxxx', '2024-07-09', '2024-07-08 05:12:48', '2024-07-09 06:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbpesanandetail`
--

CREATE TABLE `tbpesanandetail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbpesanandetail`
--

INSERT INTO `tbpesanandetail` (`id`, `kode`, `id_user`, `quantity`, `price`, `status`, `created_at`, `updated_at`) VALUES
(175, 'TYSX20240715085132_1266A6', 12, 4, 11058000.00, 'completed', '2024-07-15 01:50:13', '2024-07-15 01:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbpesanans`
--

CREATE TABLE `tbpesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah_harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `kode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbpesanans`
--

INSERT INTO `tbpesanans` (`id`, `id_user`, `id_barang`, `jumlah_pesan`, `tanggal`, `jumlah_harga`, `created_at`, `updated_at`, `status`, `kode`) VALUES
(277, 12, 12, 2, '2024-07-15 08:50:13', 6658000.00, '2024-07-15 01:50:13', '2024-07-15 01:53:24', 'completed', 'TYSX20240715085132_1266A6'),
(278, 12, 10, 2, '2024-07-15 08:50:22', 4400000.00, '2024-07-15 01:50:22', '2024-07-15 01:53:24', 'completed', 'TYSX20240715085132_1266A6');

-- --------------------------------------------------------

--
-- Table structure for table `tbrole`
--

CREATE TABLE `tbrole` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbrole`
--

INSERT INTO `tbrole` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'client', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbsatuan`
--

CREATE TABLE `tbsatuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbsatuan`
--

INSERT INTO `tbsatuan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Pcs', NULL, NULL),
(2, 'Pasang', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbsliders`
--

CREATE TABLE `tbsliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `pajang` varchar(255) NOT NULL,
  `tglmasuk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbsliders`
--

INSERT INTO `tbsliders` (`id`, `foto`, `pajang`, `tglmasuk`, `created_at`, `updated_at`) VALUES
(5, '1714847751_slider-3.jpg', 'ya', '2024-07-08', NULL, NULL),
(6, '1717485078_slider-1.jpg', 'ya', '2024-07-08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbstok`
--

CREATE TABLE `tbstok` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `saldoawal` varchar(255) NOT NULL,
  `hargabeliakhir` varchar(255) NOT NULL,
  `hargajual` varchar(255) NOT NULL,
  `tglmasuk` varchar(255) NOT NULL,
  `hargamodal` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `pajang` varchar(255) NOT NULL,
  `saldoakhir` varchar(255) NOT NULL,
  `id_satuan` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbstok`
--

INSERT INTO `tbstok` (`id`, `kode`, `nama_barang`, `saldoawal`, `hargabeliakhir`, `hargajual`, `tglmasuk`, `hargamodal`, `foto`, `cover`, `desc`, `pajang`, `saldoakhir`, `id_satuan`, `id_kategori`, `created_at`, `updated_at`) VALUES
(9, 'TYP20240629145143198', 'Samsung Galaxy M15 5G', '135', '2200000', '2499999', '2024-06-29', '297000000', '[\"sandro2_1719672703.jpg\",\"sandro3_1719672703.jpg\",\"sandro4_1719672703.jpg\",\"sandro5_1719672703.jpg\",\"sandro6_1719672703.jpg\"]', 'sandro2.jpg', 'samsung xxxxxx', 'ya', '135', 1, 1, '2024-06-29 07:51:43', '2024-07-15 01:57:46'),
(10, 'TYP20240702070543908', 'MILS Floating Magic Keyboard', '79', '2000000', '2200000', '2024-07-02', '158000000', '[\"m1_1719903943.jpg\",\"m2_1719903943.jpg\",\"m3_1719903943.jpg\",\"m4_1719903943.jpg\"]', 'm1.jpg', 'Brand : Mils Technologies\r\nProduct Number : FKB01s, SS', 'ya', '77', 1, 2, '2024-07-02 00:05:43', '2024-07-15 01:57:46'),
(12, 'TYP20240709065144800', 'SAMSUNG GALAXY A15 5G 8/256 & A15 4G 8/128 & 8/256 NEW GARANSI RESMI', '44', '3000000', '3329000', '2024-07-09', '132000000', '[\"a1_1720507904.jpg\",\"a2_1720507904.jpg\",\"a3_1720507904.jpg\"]', 'a1.jpg', 'Speck a15 5g\r\n\r\nBody\r\n\r\nDimensions 160.1 x 76.8 x 8.4 mm (6.30 x 3.02 x 0.33 in)\r\n\r\nWeight 200 g (7.05 oz)\r\n\r\nBuild Glass front, plastic back, plastic frame\r\n\r\nSIM Single SIM (Nano-SIM) or Hybrid Dual SIM (Nano-SIM, dual stand-by)', 'ya', '42', 1, 1, '2024-07-08 23:51:44', '2024-07-15 01:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbstokrekap`
--

CREATE TABLE `tbstokrekap` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `kode_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `id_vendor` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `desc` varchar(255) NOT NULL,
  `saldo_sebelum` int(20) NOT NULL,
  `saldo_setelah` int(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbstokrekap`
--

INSERT INTO `tbstokrekap` (`id`, `kode`, `kode_status`, `status`, `id_barang`, `id_vendor`, `jumlah`, `harga`, `tanggal`, `desc`, `saldo_sebelum`, `saldo_setelah`, `created_at`, `updated_at`, `id_user`) VALUES
(94, 'TYSFI20240715085600', 'm', 'masuk', 9, 2, 2, 4400000, '2024-07-15 08:56:00', 'resrock', 133, 135, '2024-07-15 01:57:46', '2024-07-15 01:57:46', 11),
(95, 'TYSFI20240715085600', 'm', 'masuk', 10, 2, 1, 2000000, '2024-07-15 08:56:00', 'resrock', 78, 79, '2024-07-15 01:57:46', '2024-07-15 01:57:46', 11),
(96, 'TYSFI20240715085600', 'm', 'masuk', 12, 2, 2, 6000000, '2024-07-15 08:56:00', 'resrock', 42, 44, '2024-07-15 01:57:46', '2024-07-15 01:57:46', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `phone`, `address`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'adminjati', 'adminjati@gmail.com', NULL, '$2y$10$/7NHKcYyxEBtGsKIhHRLledVzXmCe3WcCilP9n5WLItpm6QQ0X8Di', '083854647297', 'Pekanbaru', 1, NULL, NULL, NULL),
(12, 'jati', 'jati@gmail.com', NULL, '$2y$10$8GLdMHMR22.ZQ26If715guz.W24q70R49qM23MXkgpYajtBklp2I.', '083854647297', 'Pekanbaru', 2, NULL, NULL, NULL),
(13, 'nabila', 'nabila@gmail.com', NULL, '$2y$10$ZXtc56DBgusu/wUFwA.2vuzVZaF4BWHQ0xMwxGiDRWWfmqtIqL4e6', '083854647297', 'Pekanbaru', 2, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tbcheckoutdetail`
--
ALTER TABLE `tbcheckoutdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbcheckoutdetail_id_user_foreign` (`id_user`);

--
-- Indexes for table `tbcheckoutreturn`
--
ALTER TABLE `tbcheckoutreturn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbcheckoutreturn_id_checkout_foreign` (`id_checkout`);

--
-- Indexes for table `tbcheckouts`
--
ALTER TABLE `tbcheckouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbkategori`
--
ALTER TABLE `tbkategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbmutasi`
--
ALTER TABLE `tbmutasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpelanggan`
--
ALTER TABLE `tbpelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpemasok`
--
ALTER TABLE `tbpemasok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpesanandetail`
--
ALTER TABLE `tbpesanandetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbpesanandetail_id_user_foreign` (`id_user`);

--
-- Indexes for table `tbpesanans`
--
ALTER TABLE `tbpesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbpesanans_id_user_foreign` (`id_user`),
  ADD KEY `tbpesanans_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `tbrole`
--
ALTER TABLE `tbrole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbsatuan`
--
ALTER TABLE `tbsatuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbsliders`
--
ALTER TABLE `tbsliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbstok`
--
ALTER TABLE `tbstok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbstok_id_satuan_index` (`id_satuan`),
  ADD KEY `tbstok_id_kategori_index` (`id_kategori`);

--
-- Indexes for table `tbstokrekap`
--
ALTER TABLE `tbstokrekap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbstokrekap_id_barang_foreign` (`id_barang`),
  ADD KEY `tbstokrekap_id_user_foreign` (`id_user`),
  ADD KEY `tbstokrekap_id_vendor_foreign` (`id_vendor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbcheckoutdetail`
--
ALTER TABLE `tbcheckoutdetail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tbcheckoutreturn`
--
ALTER TABLE `tbcheckoutreturn`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbcheckouts`
--
ALTER TABLE `tbcheckouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbkategori`
--
ALTER TABLE `tbkategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbmutasi`
--
ALTER TABLE `tbmutasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbpelanggan`
--
ALTER TABLE `tbpelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbpemasok`
--
ALTER TABLE `tbpemasok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbpesanandetail`
--
ALTER TABLE `tbpesanandetail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `tbpesanans`
--
ALTER TABLE `tbpesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `tbrole`
--
ALTER TABLE `tbrole`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbsatuan`
--
ALTER TABLE `tbsatuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbsliders`
--
ALTER TABLE `tbsliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbstok`
--
ALTER TABLE `tbstok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbstokrekap`
--
ALTER TABLE `tbstokrekap`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbcheckoutdetail`
--
ALTER TABLE `tbcheckoutdetail`
  ADD CONSTRAINT `tbcheckoutdetail_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `tbpesanandetail` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tbcheckoutreturn`
--
ALTER TABLE `tbcheckoutreturn`
  ADD CONSTRAINT `tbcheckoutreturn_id_checkout_foreign` FOREIGN KEY (`id_checkout`) REFERENCES `tbcheckoutdetail` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbpesanandetail`
--
ALTER TABLE `tbpesanandetail`
  ADD CONSTRAINT `tbpesanandetail_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `tbpesanans` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tbpesanans`
--
ALTER TABLE `tbpesanans`
  ADD CONSTRAINT `tbpesanans_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `tbstok` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbpesanans_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbstok`
--
ALTER TABLE `tbstok`
  ADD CONSTRAINT `tbstok_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `tbkategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbstok_id_satuan_foreign` FOREIGN KEY (`id_satuan`) REFERENCES `tbsatuan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbstokrekap`
--
ALTER TABLE `tbstokrekap`
  ADD CONSTRAINT `tbstokrekap_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `tbstok` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbstokrekap_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbstokrekap_id_vendor_foreign` FOREIGN KEY (`id_vendor`) REFERENCES `tbpemasok` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `tbrole` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
