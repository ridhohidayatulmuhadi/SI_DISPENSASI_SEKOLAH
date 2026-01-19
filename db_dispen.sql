-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2026 at 12:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dispen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin TU', 'admin', '$2y$12$FDp/tE7dLdNqmLkS2cQsXOVF5psJ2sP//7eQj9qjQiFx8PrAbi4NG', '2026-01-17 06:05:57', '2026-01-17 06:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'IKUT LOMBA', 'LOMBA TINGKAT NASIOANAL', '2026-01-18 04:06:43', '2026-01-18 04:06:43'),
(2, 'URUSAN KELUARGA', 'MENDADAK DAN HARUS ADA BUKTI KUAT!!', '2026-01-18 04:28:00', '2026-01-18 04:28:00'),
(3, 'KELUAR SEKOLAH', 'KEPERLUAN PENTING', '2026-01-19 00:35:46', '2026-01-19 00:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(3, 'RPL 1', '2026-01-18 03:09:52', '2026-01-18 03:09:52'),
(4, 'RPL 2', '2026-01-18 03:10:02', '2026-01-18 03:10:02'),
(5, 'RPL 3', '2026-01-18 03:10:10', '2026-01-18 03:10:10'),
(7, 'DKV 1', '2026-01-18 04:25:34', '2026-01-18 04:26:09'),
(8, 'DKV 2', '2026-01-18 04:25:42', '2026-01-18 04:25:42'),
(9, 'APHP 1', '2026-01-18 04:26:24', '2026-01-18 12:18:53'),
(10, 'APHP 2', '2026-01-18 04:26:34', '2026-01-18 04:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `lampiran`
--

CREATE TABLE `lampiran` (
  `id` bigint UNSIGNED NOT NULL,
  `surat_dispensasi_id` bigint UNSIGNED NOT NULL,
  `nama_file` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_dispensasi`
--

CREATE TABLE `log_dispensasi` (
  `id` bigint UNSIGNED NOT NULL,
  `surat_dispensasi_id` bigint UNSIGNED NOT NULL,
  `status` enum('dispen','kembali') COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` timestamp NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_dispensasi`
--

INSERT INTO `log_dispensasi` (`id`, `surat_dispensasi_id`, `status`, `waktu`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'dispen', '2026-01-18 04:07:45', 'Siswa mulai dispensasi', '2026-01-18 04:07:45', '2026-01-18 04:07:45'),
(2, 2, 'dispen', '2026-01-18 04:28:40', 'Siswa mulai dispensasi', '2026-01-18 04:28:40', '2026-01-18 04:28:40'),
(4, 3, 'dispen', '2026-01-18 05:01:27', 'Siswa mulai dispensasi', '2026-01-18 05:01:27', '2026-01-18 05:01:27'),
(6, 3, 'kembali', '2026-01-18 05:05:00', 'Siswa kembali ke sekolah', '2026-01-18 05:05:00', '2026-01-18 05:05:00'),
(8, 1, 'kembali', '2026-01-18 05:07:18', 'Siswa kembali ke sekolah (TERLAMBAT)', '2026-01-18 05:07:18', '2026-01-18 05:07:18'),
(9, 2, 'kembali', '2026-01-18 05:11:17', 'Siswa kembali ke sekolah', '2026-01-18 05:11:17', '2026-01-18 05:11:17'),
(10, 4, 'dispen', '2026-01-18 05:38:21', 'Siswa mulai dispensasi', '2026-01-18 05:38:21', '2026-01-18 05:38:21'),
(11, 4, 'kembali', '2026-01-18 05:38:47', 'Siswa kembali ke sekolah', '2026-01-18 05:38:47', '2026-01-18 05:38:47'),
(12, 5, 'dispen', '2026-01-18 06:51:20', 'Siswa mulai dispensasi', '2026-01-18 06:51:20', '2026-01-18 06:51:20'),
(13, 5, 'kembali', '2026-01-18 06:58:55', 'Siswa kembali ke sekolah (TERLAMBAT)', '2026-01-18 06:58:55', '2026-01-18 06:58:55'),
(14, 6, 'dispen', '2026-01-18 12:36:34', 'Siswa mulai dispensasi', '2026-01-18 12:36:34', '2026-01-18 12:36:34'),
(15, 6, 'kembali', '2026-01-18 12:43:11', 'Siswa kembali ke sekolah', '2026-01-18 12:43:11', '2026-01-18 12:43:11'),
(16, 7, 'dispen', '2026-01-18 13:12:00', 'Siswa mulai dispensasi', '2026-01-18 13:12:00', '2026-01-18 13:12:00'),
(17, 7, 'kembali', '2026-01-18 13:12:34', 'Siswa kembali ke sekolah (TERLAMBAT)', '2026-01-18 13:12:34', '2026-01-18 13:12:34'),
(18, 8, 'dispen', '2026-01-19 00:28:26', 'Siswa mulai dispensasi', '2026-01-19 00:28:26', '2026-01-19 00:28:26'),
(19, 8, 'kembali', '2026-01-19 00:30:25', 'Siswa kembali ke sekolah', '2026-01-19 00:30:25', '2026-01-19 00:30:25'),
(20, 9, 'dispen', '2026-01-19 00:38:34', 'Siswa mulai dispensasi', '2026-01-19 00:38:34', '2026-01-19 00:38:34'),
(21, 9, 'kembali', '2026-01-19 00:39:03', 'Siswa kembali ke sekolah (TERLAMBAT)', '2026-01-19 00:39:03', '2026-01-19 00:39:03'),
(22, 10, 'dispen', '2026-01-19 00:53:53', 'Siswa mulai dispensasi', '2026-01-19 00:53:53', '2026-01-19 00:53:53'),
(23, 10, 'kembali', '2026-01-19 00:54:06', 'Siswa kembali ke sekolah (TERLAMBAT)', '2026-01-19 00:54:06', '2026-01-19 00:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_12_29_031000_create_jurusans_table', 1),
(2, '2025_12_29_031158_create_admin_table', 1),
(3, '2025_12_29_031159_create_siswa_table', 1),
(4, '2025_12_29_031200_create_jenis_surat_table', 1),
(5, '2025_12_29_031200_create_surat_dispensasi_table', 1),
(6, '2025_12_29_031201_create_lampiran_table', 1),
(7, '2026_01_10_041326_update_surat_dispensasi_table', 1),
(8, '2026_01_10_042149_create_log_dispensasi_table', 1),
(9, '2026_01_10_045031_add_kembali_pelajaran_ke_to_surat_dispensasi_table', 1),
(10, '2026_01_10_200034_add_deleted_at_to_surat_dispensasi_table', 1),
(11, '2026_01_13_211419_add_waktu_kembali_batas_to_surat_dispensasi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `nis` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` enum('X','XI','XII') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `kelas`, `jurusan_id`, `created_at`, `updated_at`) VALUES
(2, '100707', 'RIDHO HIDAYATUL MUHADI', 'XII', 3, '2026-01-18 03:41:52', '2026-01-18 05:28:26'),
(3, '090909', 'MARVEL ROY SAMUDRA', 'X', 7, '2026-01-18 04:25:24', '2026-01-18 04:27:19'),
(4, '222222', 'RAHMAD NUR WAHID', 'XI', 9, '2026-01-18 06:50:35', '2026-01-18 06:50:35'),
(5, '212121', 'MOHAMMAD SATRIO AL-MALIK', 'XII', 7, '2026-01-18 12:27:01', '2026-01-18 12:27:01'),
(6, '909090', 'MADEVA', 'XII', 3, '2026-01-19 00:46:13', '2026-01-19 00:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `surat_dispensasi`
--

CREATE TABLE `surat_dispensasi` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_surat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siswa_id` bigint UNSIGNED DEFAULT NULL,
  `jenis_surat_id` bigint UNSIGNED DEFAULT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `kembali_pelajaran_ke` tinyint UNSIGNED NOT NULL,
  `waktu_kembali_batas` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat_dispensasi`
--

INSERT INTO `surat_dispensasi` (`id`, `nomor_surat`, `siswa_id`, `jenis_surat_id`, `admin_id`, `alasan`, `tanggal_mulai`, `kembali_pelajaran_ke`, `waktu_kembali_batas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 2, 1, NULL, 'CATUR INPO', '2026-01-18', 4, '12:07:00', '2026-01-18 04:07:45', '2026-01-18 04:10:57', NULL),
(2, NULL, 3, 2, NULL, 'PANGGILAN ALAM', '2026-01-18', 6, '12:28:00', '2026-01-18 04:28:40', '2026-01-18 04:28:40', NULL),
(3, NULL, 2, 2, NULL, 'LALI MATENI KOMPOR', '2026-01-18', 4, '12:06:00', '2026-01-18 05:01:27', '2026-01-18 05:08:24', '2026-01-18 05:08:24'),
(4, NULL, 2, 1, NULL, 'gfdfjd', '2026-01-18', 5, '13:38:00', '2026-01-18 05:38:21', '2026-01-18 05:38:21', NULL),
(5, NULL, 4, 1, NULL, 'DOLAN', '2026-01-18', 7, '13:57:00', '2026-01-18 06:51:20', '2026-01-18 06:51:20', NULL),
(6, NULL, 5, 1, NULL, 'LOMBA WW2', '2026-01-18', 5, '22:36:00', '2026-01-18 12:36:34', '2026-01-18 12:42:29', NULL),
(7, NULL, 4, 2, NULL, 'MATENI LAMPU', '2026-01-18', 5, '20:12:00', '2026-01-18 13:12:00', '2026-01-18 13:12:00', NULL),
(8, NULL, 4, 2, NULL, 'MATENI KOMPOR', '2026-01-19', 6, '09:28:00', '2026-01-19 00:28:26', '2026-01-19 00:28:26', NULL),
(9, NULL, 3, 2, NULL, 'OKE GAS', '2026-01-19', 4, '07:35:00', '2026-01-19 00:38:34', '2026-01-19 00:38:34', NULL),
(10, NULL, 6, 1, NULL, 'LOMBA LKS TINGKAT INTERNASIONAL WEB DEVELOPER', '2026-01-19', 4, '07:52:00', '2026-01-19 00:53:53', '2026-01-19 00:53:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusans_nama_unique` (`nama`);

--
-- Indexes for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lampiran_surat_dispensasi_id_foreign` (`surat_dispensasi_id`);

--
-- Indexes for table `log_dispensasi`
--
ALTER TABLE `log_dispensasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_dispensasi_surat_dispensasi_id_foreign` (`surat_dispensasi_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nis_unique` (`nis`),
  ADD KEY `siswa_jurusan_id_foreign` (`jurusan_id`);

--
-- Indexes for table `surat_dispensasi`
--
ALTER TABLE `surat_dispensasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_dispensasi_siswa_id_foreign` (`siswa_id`),
  ADD KEY `surat_dispensasi_jenis_surat_id_foreign` (`jenis_surat_id`),
  ADD KEY `surat_dispensasi_admin_id_foreign` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_dispensasi`
--
ALTER TABLE `log_dispensasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_dispensasi`
--
ALTER TABLE `surat_dispensasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `lampiran_surat_dispensasi_id_foreign` FOREIGN KEY (`surat_dispensasi_id`) REFERENCES `surat_dispensasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_dispensasi`
--
ALTER TABLE `log_dispensasi`
  ADD CONSTRAINT `log_dispensasi_surat_dispensasi_id_foreign` FOREIGN KEY (`surat_dispensasi_id`) REFERENCES `surat_dispensasi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surat_dispensasi`
--
ALTER TABLE `surat_dispensasi`
  ADD CONSTRAINT `surat_dispensasi_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_dispensasi_jenis_surat_id_foreign` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surat` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_dispensasi_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
