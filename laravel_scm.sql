-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2019 at 05:37 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_scm`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(10) UNSIGNED NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `nohp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `alamat`, `nohp`, `user_id`, `created_at`, `updated_at`) VALUES
(2, NULL, NULL, 3, '2018-09-26 19:47:52', '2018-09-26 19:47:52'),
(3, 'jl nias', '09349348', 4, '2018-09-27 02:38:55', '2018-09-27 02:38:55'),
(4, 'mangli', '08765567', 5, '2018-10-12 04:40:05', '2018-10-18 16:47:37'),
(5, 'Jl Compek Compekan gang Compek nomer Compek', '02338283829', 6, '2018-10-18 17:09:02', '2018-10-18 17:39:20'),
(7, 'Jl Compek Compekan gang Compek nomer Compek', '02338283829', 8, '2018-10-30 21:07:51', '2018-10-30 21:07:51'),
(8, 'jl nias', '00230239', 9, '2018-10-30 21:15:41', '2018-11-08 06:02:29'),
(10, 'jln supli', '0823832823', 11, '2019-04-27 06:01:53', '2019-04-27 06:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `fishes`
--

CREATE TABLE `fishes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fishes`
--

INSERT INTO `fishes` (`id`, `name`, `stok`, `deskripsi`, `image`, `slug`, `satuan`, `harga`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 'buah naga', 5, '<p>makanan sangat sehatttt</p>', '1556073210-10852139_3f6bea93-7c08-4e3a-844b-2929d19fef69_2048_0.jpg', 'buah-naga', 'Bungkus', 15000, 1, '2019-04-24 02:33:30', '2019-04-24 02:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_17_100536_create_data_table', 1),
(4, '2018_09_17_100918_create_fishes_table', 1),
(5, '2018_09_17_101246_create_orders_table', 1),
(6, '2018_09_17_101338_create_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` enum('proses','sudah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `pekerja_id` int(10) UNSIGNED DEFAULT NULL,
  `produk_id` int(11) UNSIGNED NOT NULL,
  `pemilik_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `fotoPembayaran` text NOT NULL,
  `norekening` varchar(225) NOT NULL,
  `status_pesanan` enum('diproses','proses pengiriman','pengiriman','sampai') NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `fotoPembayaran`, `norekening`, `status_pesanan`, `created_at`, `updated_at`) VALUES
(1, '1542892011-IMG_0882.JPG', '5666-5545-5545-5666', 'sampai', '2018-11-25 22:00:03', '2018-11-25 22:00:03'),
(2, '1543181511-images.jpg', '7653-5677-4556-5445', 'sampai', '2018-11-25 22:00:07', '2018-11-25 22:00:07'),
(3, '1543181549-images.jpg', '8292-3829-9328-3823', 'pengiriman', '2019-04-14 13:06:24', '2019-04-14 13:06:24'),
(4, '1543181730-images.jpg', '5566-6566-6543-3333', 'sampai', '2019-04-21 11:41:40', '2019-04-21 11:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `pencatatan`
--

CREATE TABLE `pencatatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nama_produk` varchar(225) NOT NULL,
  `jumlah_produk_satuan` int(11) DEFAULT NULL,
  `jumlah_produk_grup` int(11) DEFAULT NULL,
  `jenis_penyimpanan` varchar(225) DEFAULT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pencatatan`
--

INSERT INTO `pencatatan` (`id`, `user_id`, `nama_produk`, `jumlah_produk_satuan`, `jumlah_produk_grup`, `jenis_penyimpanan`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'buah naga update', 265, 2, 'Sak', '<p>buah naaga sakan</p>', '2019-04-27 06:40:43', '2019-06-02 04:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` int(11) NOT NULL,
  `pekerja_id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id`, `pekerja_id`, `pembayaran_id`, `created_at`, `updated_at`) VALUES
(5, 4, 1, '2018-11-25 21:58:55', '2018-11-25 21:58:55'),
(6, 4, 2, '2018-11-25 21:59:00', '2018-11-25 21:59:00'),
(7, 8, 4, '2018-11-25 21:59:06', '2018-11-25 21:59:06'),
(8, 4, 3, '2019-04-14 13:06:24', '2019-04-14 13:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `pencatatan_id` int(11) UNSIGNED NOT NULL,
  `jumlah_awal` int(11) NOT NULL,
  `jumlah_akhir` int(11) NOT NULL,
  `jumlah_tetap_awal` int(11) NOT NULL,
  `jumlah_tetap_akhir` int(11) NOT NULL,
  `status_kemasan` varchar(225) NOT NULL,
  `status` enum('invest','cukup') NOT NULL DEFAULT 'invest',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id`, `user_id`, `pencatatan_id`, `jumlah_awal`, `jumlah_akhir`, `jumlah_tetap_awal`, `jumlah_tetap_akhir`, `status_kemasan`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 45, 5, 50, 5, 'Sak', 'invest', '2019-05-11 19:46:37', '2019-05-31 15:17:48'),
(3, 1, 1, 30, 0, 30, 0, 'Bungkus', 'invest', '2019-05-30 02:04:08', '2019-05-30 04:22:17'),
(4, 1, 1, 10, 0, 10, 0, 'Sak', 'invest', '2019-05-30 02:50:50', '2019-06-02 04:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `suplier_history`
--

CREATE TABLE `suplier_history` (
  `id` int(11) NOT NULL,
  `suplier_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `jumlah_invest` int(11) UNSIGNED NOT NULL,
  `status_terima` enum('diproses','diterima','ditolak') NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier_history`
--

INSERT INTO `suplier_history` (`id`, `suplier_id`, `user_id`, `jumlah_invest`, `status_terima`, `created_at`, `updated_at`) VALUES
(7, 2, 11, 5, 'diterima', '2019-05-31 15:17:48', '2019-05-31 16:17:10'),
(8, 4, 11, 10, 'ditolak', '2019-05-31 15:22:20', '2019-06-02 04:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `totalBayar` int(11) NOT NULL,
  `status` enum('diproses','dibayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `role` tinyint(4) NOT NULL DEFAULT '3',
  `token` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `image`, `role`, `token`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ardi', 'ardi', NULL, 1, 'iMgfOJzcMNCAegh4hKgHMQ7gO', 'ardi@test.test', '$2y$10$PNqrJvAI21T2p20OxCPMMO2j.8XXZQg3RrJaOGYEQeMS6Ddgd5tki', 'Wos7lwvPGWrs6w1llomIVKRjzA6K5tbLKhFKhiliVHZY0Hklmk5EIR0EcSd2', '2018-09-25 00:39:59', '2018-09-25 00:39:59'),
(3, 'romi', 'romi', '1539909560-note2.png', 3, 'RRFstAc3rfLfYxeJbHU25lllq', 'romi@test.test', '$2y$10$ohg2Zj./Glt3oP2I1OxZ6.FzuEFY5JSDJF4A5ihaw4o/gw9Cw.R9O', 'u2jwuGIsLfb3309eAweqXj3c2sdNDPw0wtBgBMlMVQ293q7XsWU4W8tGK4q3', '2018-09-26 19:47:51', '2018-09-26 19:47:51'),
(4, 'hoho', 'hoho', '1540959017-100 Manfaat dan Efek Samping Buah Sirsak Lengkap.jpg', 2, 'nA3b72psggMHMxKDtOSjPvAgY', 'hoho@test.test', '$2y$10$viVjr7Zjrn8fZHNrugjMWeRLYY6cPJ4TDQ/C9ZifMKWsxkrUTeege', '52omfZmAUiDQgqMikwccpFdbBVaaeWidKugX6E1T011S4JJWW7o4s8hi2XbU', '2018-09-27 02:38:55', '2018-10-30 21:10:17'),
(5, 'ilham', 'ilham', '1539907699-note.png', 3, 'YHC1QP55L2YeIAEPfy5bSHIdb', 'ilham@test.test', '$2y$10$pxe5rKGfafmfYFPyz7dEC.8ZLYSFLyK0QHe2NhC.Du2SnZKuUlc6a', 'LezbUtEiVnmfzZzEeQG2BRrE55NuWOJrKrhh7iNRTteLBPit9XkBfRRum04d', '2018-10-12 04:40:05', '2018-10-18 17:08:19'),
(6, 'jejen', 'jejen', '1539909560-note2.png', 3, 't0ttUV8WEZP8tV2bkYaJpVDgh', 'jejen@test.test', '$2y$10$ZbnFC5CJkA26UBlUaC/wOuo/i4/VJqOB0fsweuCQKoRKbpra0rsvK', 'tW3yTV8PMekghUBes8jJSsjplg9gMIuM8L1IvWQCsVdHstZYXQ7g21Mu4deQ', '2018-10-18 17:09:01', '2018-10-18 17:39:20'),
(8, 'jony', 'jony', '1540959280-Semangka-1.jpg', 2, 'EdzFJkSeen7dsA5GjmMFzETE3', 'jony@test.test', '$2y$10$lgFNw71fRM8jcRyxrwnZwOJCR3cxrb.YG0OvhAakjG6JAOda7RSyG', '5Pu30VH74DFSm2BtFa4Fft7DfvvvlbjVnjm2HnW66TYVVtZl7jOVTCZFgpS3', '2018-10-30 21:07:51', '2018-10-30 21:14:40'),
(9, 'jojon', 'jojon', '1541682149-ilham.jpg', 3, 'LBLt9WnH2FiryB4NFHY4hHjBi', 'jojon@test.test', '$2y$10$/ntd/WoxYMytX8n1WpSbZOG.R.9A2TlQAnTFzym/9Oefwxxm/vANe', 'ReSTq2gQbjJ1PZwe4kzI8wp9CvFfbAdCNOSIPnkOTjydlfoTArZULsGFjlYM', '2018-10-30 21:15:41', '2018-11-08 06:02:29'),
(11, 'supli', 'supli', '1556344913-4k-wallpaper-close-up-dew-807598.jpg', 4, 'NEMkBV7ciMEk1FpFRoVsLYJBy', 'supli@test.test', '$2y$10$H44WEfIQPqoIkFY.xPaVle9eUjM.xwfu/F.HW4fdrSLMjBMQf6.dO', 'dTuZzIxhC3KIwi9JA96LZ7f10uLzi7qoq7CjPXKPfvRMBAsSEw8a4vuvhR04', '2019-04-27 06:01:53', '2019-04-27 06:01:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_user_id_foreign` (`user_id`);

--
-- Indexes for table `fishes`
--
ALTER TABLE `fishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fishes_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_pekerja_id_foreign` (`pekerja_id`),
  ADD KEY `produk` (`produk_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pencatatan`
--
ALTER TABLE `pencatatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_pencatatan_users` (`user_id`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pekerja_id` (`pekerja_id`),
  ADD KEY `pembayaran_id` (`pembayaran_id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_suplier_users` (`user_id`),
  ADD KEY `FK_suplier_pencatatan` (`pencatatan_id`);

--
-- Indexes for table `suplier_history`
--
ALTER TABLE `suplier_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_suplier_history_suplier` (`suplier_id`),
  ADD KEY `FK_suplier_history_users` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

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
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fishes`
--
ALTER TABLE `fishes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pencatatan`
--
ALTER TABLE `pencatatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suplier_history`
--
ALTER TABLE `suplier_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `data_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fishes`
--
ALTER TABLE `fishes`
  ADD CONSTRAINT `fishes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `fishes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_pekerja_id_foreign` FOREIGN KEY (`pekerja_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pencatatan`
--
ALTER TABLE `pencatatan`
  ADD CONSTRAINT `FK_pencatatan_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suplier`
--
ALTER TABLE `suplier`
  ADD CONSTRAINT `FK_suplier_pencatatan` FOREIGN KEY (`pencatatan_id`) REFERENCES `pencatatan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_suplier_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suplier_history`
--
ALTER TABLE `suplier_history`
  ADD CONSTRAINT `FK_suplier_history_suplier` FOREIGN KEY (`suplier_id`) REFERENCES `suplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_suplier_history_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
