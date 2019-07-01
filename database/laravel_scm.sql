-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table laravel_scm.data
CREATE TABLE IF NOT EXISTS `data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `nohp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_user_id_foreign` (`user_id`),
  CONSTRAINT `data_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_scm.data: ~6 rows (approximately)
/*!40000 ALTER TABLE `data` DISABLE KEYS */;
INSERT INTO `data` (`id`, `alamat`, `nohp`, `user_id`, `created_at`, `updated_at`) VALUES
	(2, NULL, NULL, 3, '2018-09-27 02:47:52', '2018-09-27 02:47:52'),
	(3, 'jl nias', '09349348', 4, '2018-09-27 09:38:55', '2018-09-27 09:38:55'),
	(4, 'mangli', '08765567', 5, '2018-10-12 11:40:05', '2018-10-18 23:47:37'),
	(5, 'Jl Compek Compekan gang Compek nomer Compek', '02338283829', 6, '2018-10-19 00:09:02', '2018-10-19 00:39:20'),
	(7, 'Jl Compek Compekan gang Compek nomer Compek', '02338283829', 8, '2018-10-31 04:07:51', '2018-10-31 04:07:51'),
	(8, 'jl nias', '00230239', 9, '2018-10-31 04:15:41', '2018-11-08 13:02:29'),
	(10, 'jln supli', '0823832823', 11, '2019-04-27 13:01:53', '2019-04-27 13:01:53');
/*!40000 ALTER TABLE `data` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.fishes
CREATE TABLE IF NOT EXISTS `fishes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fishes_user_id_foreign` (`user_id`),
  CONSTRAINT `fishes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_scm.fishes: ~2 rows (approximately)
/*!40000 ALTER TABLE `fishes` DISABLE KEYS */;
INSERT INTO `fishes` (`id`, `name`, `stok`, `deskripsi`, `image`, `slug`, `satuan`, `harga`, `user_id`, `created_at`, `updated_at`) VALUES
	(6, 'buah naga', 5, '<p>makanan sangat sehatttt</p>', '1556073210-10852139_3f6bea93-7c08-4e3a-844b-2929d19fef69_2048_0.jpg', 'buah-naga', 'Bungkus', 15000, 1, '2019-04-24 09:33:30', '2019-04-24 09:37:28');
/*!40000 ALTER TABLE `fishes` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_scm.migrations: ~6 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_09_17_100536_create_data_table', 1),
	(4, '2018_09_17_100918_create_fishes_table', 1),
	(5, '2018_09_17_101246_create_orders_table', 1),
	(6, '2018_09_17_101338_create_transactions_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` enum('proses','sudah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `pekerja_id` int(10) unsigned DEFAULT NULL,
  `produk_id` int(11) unsigned NOT NULL,
  `pemilik_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_pekerja_id_foreign` (`pekerja_id`),
  KEY `produk` (`produk_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `fishes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_pekerja_id_foreign` FOREIGN KEY (`pekerja_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_scm.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_scm.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fotoPembayaran` text NOT NULL,
  `norekening` varchar(225) NOT NULL,
  `status_pesanan` enum('diproses','proses pengiriman','pengiriman','sampai') NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table laravel_scm.pembayaran: ~4 rows (approximately)
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` (`id`, `fotoPembayaran`, `norekening`, `status_pesanan`, `created_at`, `updated_at`) VALUES
	(1, '1542892011-IMG_0882.JPG', '5666-5545-5545-5666', 'sampai', '2018-11-26 05:00:03', '2018-11-26 05:00:03'),
	(2, '1543181511-images.jpg', '7653-5677-4556-5445', 'sampai', '2018-11-26 05:00:07', '2018-11-26 05:00:07'),
	(3, '1543181549-images.jpg', '8292-3829-9328-3823', 'pengiriman', '2019-04-14 20:06:24', '2019-04-14 20:06:24'),
	(4, '1543181730-images.jpg', '5566-6566-6543-3333', 'sampai', '2019-04-21 18:41:40', '2019-04-21 18:41:40');
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.pencatatan
CREATE TABLE IF NOT EXISTS `pencatatan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `nama_produk` varchar(225) NOT NULL,
  `jumlah_produk_satuan` int(11) DEFAULT NULL,
  `jumlah_produk_grup` int(11) DEFAULT NULL,
  `jenis_penyimpanan` varchar(225) DEFAULT NULL,
  `catatan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pencatatan_users` (`user_id`),
  CONSTRAINT `FK_pencatatan_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table laravel_scm.pencatatan: ~1 rows (approximately)
/*!40000 ALTER TABLE `pencatatan` DISABLE KEYS */;
INSERT INTO `pencatatan` (`id`, `user_id`, `nama_produk`, `jumlah_produk_satuan`, `jumlah_produk_grup`, `jenis_penyimpanan`, `catatan`, `created_at`, `updated_at`) VALUES
	(1, 1, 'buah naga', 178, 2, 'Sak', '<p>buah naaga sakan</p>', '2019-04-27 13:40:43', '2019-06-27 15:32:45');
/*!40000 ALTER TABLE `pencatatan` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.penggunaan_bahanbaku
CREATE TABLE IF NOT EXISTS `penggunaan_bahanbaku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pencatatan_id` int(11) DEFAULT NULL,
  `jumlah_awal` int(11) DEFAULT NULL,
  `jumlah_akhir` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table laravel_scm.penggunaan_bahanbaku: ~12 rows (approximately)
/*!40000 ALTER TABLE `penggunaan_bahanbaku` DISABLE KEYS */;
INSERT INTO `penggunaan_bahanbaku` (`id`, `pencatatan_id`, `jumlah_awal`, `jumlah_akhir`, `created_at`, `updated_at`) VALUES
	(1, 1, 260, 5, '2019-06-25 21:09:42', '2019-06-25 21:09:42'),
	(2, 1, 250, 10, '2019-06-25 21:26:09', '2019-06-25 21:26:09'),
	(4, 2, 495, 5, '2019-06-25 22:05:14', '2019-06-25 22:05:14'),
	(5, 1, 247, 3, '2019-07-25 22:05:22', '2019-06-25 22:05:22'),
	(6, 1, 232, 15, '2019-07-25 22:05:28', '2019-06-25 22:05:28'),
	(7, 1, 226, 6, '2019-07-25 22:05:58', '2019-06-25 22:05:58'),
	(8, 1, 216, 10, '2019-08-25 22:06:06', '2019-06-25 22:06:06'),
	(9, 1, 208, 8, '2019-08-25 22:06:14', '2019-06-25 22:06:14'),
	(10, 1, 198, 10, '2019-08-26 20:55:05', '2019-06-26 20:55:05'),
	(12, 1, 198, 10, '2019-09-26 20:55:05', '2019-06-26 20:55:05'),
	(13, 1, 198, 20, '2019-09-26 20:55:05', '2019-06-26 20:55:05'),
	(14, 1, 173, 8, '2019-10-06 23:00:45', '2019-06-26 23:00:45');
/*!40000 ALTER TABLE `penggunaan_bahanbaku` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.pengiriman
CREATE TABLE IF NOT EXISTS `pengiriman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pekerja_id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pekerja_id` (`pekerja_id`),
  KEY `pembayaran_id` (`pembayaran_id`),
  CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table laravel_scm.pengiriman: ~4 rows (approximately)
/*!40000 ALTER TABLE `pengiriman` DISABLE KEYS */;
INSERT INTO `pengiriman` (`id`, `pekerja_id`, `pembayaran_id`, `created_at`, `updated_at`) VALUES
	(5, 4, 1, '2018-11-26 04:58:55', '2018-11-26 04:58:55'),
	(6, 4, 2, '2018-11-26 04:59:00', '2018-11-26 04:59:00'),
	(7, 8, 4, '2018-11-26 04:59:06', '2018-11-26 04:59:06'),
	(8, 4, 3, '2019-04-14 20:06:24', '2019-04-14 20:06:24');
/*!40000 ALTER TABLE `pengiriman` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.penjadwalan
CREATE TABLE IF NOT EXISTS `penjadwalan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job` varchar(225) DEFAULT NULL,
  `mesin_satu` int(11) DEFAULT NULL,
  `mesin_dua` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table laravel_scm.penjadwalan: ~3 rows (approximately)
/*!40000 ALTER TABLE `penjadwalan` DISABLE KEYS */;
INSERT INTO `penjadwalan` (`id`, `job`, `mesin_satu`, `mesin_dua`, `created_at`, `updated_at`) VALUES
	(6, 'dodol naga + melon', 5, 3, '2019-06-27 10:24:50', '2019-06-27 10:24:50'),
	(7, 'dodol naga + nagka', 7, 7, '2019-06-27 10:25:13', '2019-06-27 10:25:13'),
	(8, 'dodol naga + nanas', 16, 8, '2019-06-27 10:29:27', '2019-06-27 10:29:27'),
	(9, 'job 4', 4, 5, '2019-06-27 15:59:20', '2019-06-27 15:59:20'),
	(10, 'job 5', 1, 3, '2019-06-27 16:00:09', '2019-06-27 16:00:09');
/*!40000 ALTER TABLE `penjadwalan` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.suplier
CREATE TABLE IF NOT EXISTS `suplier` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `pencatatan_id` int(11) unsigned NOT NULL,
  `jumlah_awal` int(11) NOT NULL,
  `jumlah_akhir` int(11) NOT NULL,
  `jumlah_tetap_awal` int(11) NOT NULL,
  `jumlah_tetap_akhir` int(11) NOT NULL,
  `status_kemasan` varchar(225) NOT NULL,
  `status` enum('invest','cukup') NOT NULL DEFAULT 'invest',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_suplier_users` (`user_id`),
  KEY `FK_suplier_pencatatan` (`pencatatan_id`),
  CONSTRAINT `FK_suplier_pencatatan` FOREIGN KEY (`pencatatan_id`) REFERENCES `pencatatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_suplier_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table laravel_scm.suplier: ~3 rows (approximately)
/*!40000 ALTER TABLE `suplier` DISABLE KEYS */;
INSERT INTO `suplier` (`id`, `user_id`, `pencatatan_id`, `jumlah_awal`, `jumlah_akhir`, `jumlah_tetap_awal`, `jumlah_tetap_akhir`, `status_kemasan`, `status`, `created_at`, `updated_at`) VALUES
	(2, 1, 1, 45, 5, 50, 5, 'Sak', 'invest', '2019-05-12 02:46:37', '2019-05-31 22:17:48'),
	(3, 1, 1, 30, 0, 30, 0, 'Bungkus', 'invest', '2019-05-30 09:04:08', '2019-05-30 11:22:17'),
	(4, 1, 1, 10, 0, 10, 0, 'Sak', 'invest', '2019-05-30 09:50:50', '2019-06-02 11:15:39'),
	(5, 1, 1, 5, 5, 10, 5, 'Kg', 'invest', '2019-06-27 15:31:17', '2019-06-27 15:32:02');
/*!40000 ALTER TABLE `suplier` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.suplier_history
CREATE TABLE IF NOT EXISTS `suplier_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suplier_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `jumlah_invest` int(11) unsigned NOT NULL,
  `status_terima` enum('diproses','diterima','ditolak') NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_suplier_history_suplier` (`suplier_id`),
  KEY `FK_suplier_history_users` (`user_id`),
  CONSTRAINT `FK_suplier_history_suplier` FOREIGN KEY (`suplier_id`) REFERENCES `suplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_suplier_history_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table laravel_scm.suplier_history: ~1 rows (approximately)
/*!40000 ALTER TABLE `suplier_history` DISABLE KEYS */;
INSERT INTO `suplier_history` (`id`, `suplier_id`, `user_id`, `jumlah_invest`, `status_terima`, `created_at`, `updated_at`) VALUES
	(7, 2, 11, 5, 'diterima', '2019-05-31 22:17:48', '2019-05-31 23:17:10'),
	(8, 4, 11, 10, 'ditolak', '2019-05-31 22:22:20', '2019-06-02 11:15:39'),
	(9, 5, 11, 5, 'diterima', '2019-06-27 15:32:03', '2019-06-27 15:32:45');
/*!40000 ALTER TABLE `suplier_history` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `totalBayar` int(11) NOT NULL,
  `status` enum('diproses','dibayar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_order_id_foreign` (`order_id`),
  KEY `id_pembayaran` (`id_pembayaran`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_scm.transactions: ~0 rows (approximately)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Dumping structure for table laravel_scm.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `role` tinyint(4) NOT NULL DEFAULT '3',
  `token` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_scm.users: ~7 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `image`, `role`, `token`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'ardi', 'ardi', NULL, 1, 'iMgfOJzcMNCAegh4hKgHMQ7gO', 'ardi@test.test', '$2y$10$PNqrJvAI21T2p20OxCPMMO2j.8XXZQg3RrJaOGYEQeMS6Ddgd5tki', 'XSSNgh6SlRFtHdEuCRiqiX9OMUs2CQ9g6jG3TjGhZ0Kqab1H4hhjqxQu6fs6', '2018-09-25 07:39:59', '2018-09-25 07:39:59'),
	(3, 'romi', 'romi', '1539909560-note2.png', 3, 'RRFstAc3rfLfYxeJbHU25lllq', 'romi@test.test', '$2y$10$ohg2Zj./Glt3oP2I1OxZ6.FzuEFY5JSDJF4A5ihaw4o/gw9Cw.R9O', 'u2jwuGIsLfb3309eAweqXj3c2sdNDPw0wtBgBMlMVQ293q7XsWU4W8tGK4q3', '2018-09-27 02:47:51', '2018-09-27 02:47:51'),
	(4, 'hoho', 'hoho', '1540959017-100 Manfaat dan Efek Samping Buah Sirsak Lengkap.jpg', 2, 'nA3b72psggMHMxKDtOSjPvAgY', 'hoho@test.test', '$2y$10$viVjr7Zjrn8fZHNrugjMWeRLYY6cPJ4TDQ/C9ZifMKWsxkrUTeege', '52omfZmAUiDQgqMikwccpFdbBVaaeWidKugX6E1T011S4JJWW7o4s8hi2XbU', '2018-09-27 09:38:55', '2018-10-31 04:10:17'),
	(5, 'ilham', 'ilham', '1539907699-note.png', 3, 'YHC1QP55L2YeIAEPfy5bSHIdb', 'ilham@test.test', '$2y$10$pxe5rKGfafmfYFPyz7dEC.8ZLYSFLyK0QHe2NhC.Du2SnZKuUlc6a', 'LezbUtEiVnmfzZzEeQG2BRrE55NuWOJrKrhh7iNRTteLBPit9XkBfRRum04d', '2018-10-12 11:40:05', '2018-10-19 00:08:19'),
	(6, 'jejen', 'jejen', '1539909560-note2.png', 3, 't0ttUV8WEZP8tV2bkYaJpVDgh', 'jejen@test.test', '$2y$10$ZbnFC5CJkA26UBlUaC/wOuo/i4/VJqOB0fsweuCQKoRKbpra0rsvK', 'tW3yTV8PMekghUBes8jJSsjplg9gMIuM8L1IvWQCsVdHstZYXQ7g21Mu4deQ', '2018-10-19 00:09:01', '2018-10-19 00:39:20'),
	(8, 'jony', 'jony', '1540959280-Semangka-1.jpg', 2, 'EdzFJkSeen7dsA5GjmMFzETE3', 'jony@test.test', '$2y$10$lgFNw71fRM8jcRyxrwnZwOJCR3cxrb.YG0OvhAakjG6JAOda7RSyG', '5Pu30VH74DFSm2BtFa4Fft7DfvvvlbjVnjm2HnW66TYVVtZl7jOVTCZFgpS3', '2018-10-31 04:07:51', '2018-10-31 04:14:40'),
	(9, 'jojon', 'jojon', '1541682149-ilham.jpg', 3, 'LBLt9WnH2FiryB4NFHY4hHjBi', 'jojon@test.test', '$2y$10$/ntd/WoxYMytX8n1WpSbZOG.R.9A2TlQAnTFzym/9Oefwxxm/vANe', 'ReSTq2gQbjJ1PZwe4kzI8wp9CvFfbAdCNOSIPnkOTjydlfoTArZULsGFjlYM', '2018-10-31 04:15:41', '2018-11-08 13:02:29'),
	(11, 'supli', 'supli', '1556344913-4k-wallpaper-close-up-dew-807598.jpg', 4, 'NEMkBV7ciMEk1FpFRoVsLYJBy', 'supli@test.test', '$2y$10$H44WEfIQPqoIkFY.xPaVle9eUjM.xwfu/F.HW4fdrSLMjBMQf6.dO', 'CsqtummrBKfR0vBupWKEa1VLPYv4DO56u9m8giwV82ynfHNUzJdthEIPfBR4', '2019-04-27 13:01:53', '2019-04-27 13:01:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
