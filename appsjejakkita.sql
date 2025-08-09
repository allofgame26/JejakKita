-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2025 at 12:19 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appsjejakkita`
--

-- --------------------------------------------------------

--
-- Table structure for table `donasi_kebutuhans`
--

CREATE TABLE `donasi_kebutuhans` (
  `id` bigint UNSIGNED NOT NULL,
  `kebutuhan_id` bigint UNSIGNED NOT NULL,
  `donasi_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donasi_kebutuhans`
--

INSERT INTO `donasi_kebutuhans` (`id`, `kebutuhan_id`, `donasi_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\m_data_diri', 1, '6f130fc7-bcf8-474b-9247-43c9e9b01a9f', 'default', 'didi ngokop', '01K1V1VNH6F0E3P5B7G8YJYKVV.jpg', 'image/jpeg', 'public', 'public', 234282, '[]', '[]', '[]', '[]', 1, '2025-08-04 10:25:23', '2025-08-04 10:25:23'),
(2, 'App\\Models\\m_mandor', 1, '2082f2c1-633f-4db6-bc60-4eb5ff4f86ca', 'default', 'tania', '01K1WSDKKQYHYQWBP9EJKX2775.jpg', 'image/jpeg', 'public', 'public', 1403598, '[]', '[]', '[]', '[]', 1, '2025-08-05 02:36:27', '2025-08-05 02:36:27'),
(3, 'App\\Models\\m_program_pembangunan', 1, 'b38619d5-1d7b-4828-839b-6b2e6d70b1f1', 'default', 'mas dino', '01K1Z0TVSHZTZ8AQBC5TEP43S3.jpg', 'image/jpeg', 'public', 'public', 107385, '[]', '[]', '[]', '[]', 1, '2025-08-05 23:24:33', '2025-08-05 23:24:33'),
(4, 'App\\Models\\m_program_pembangunan', 1, '05371ab5-f162-47ff-810e-1bcb47a54626', 'default', 'a Mimir', '01K1Z0V46PV88PV09D8B1FFBMM.jpg', 'image/jpeg', 'public', 'public', 253856, '[]', '[]', '[]', '[]', 2, '2025-08-05 23:24:35', '2025-08-05 23:24:35'),
(5, 'App\\Models\\m_program_pembangunan', 1, '2cd3e1b7-e9ab-48fc-8267-771a00766cc7', 'default', 'pudidi face', '01K1Z0V49FF8TZ9F7SJXJK99XT.jpg', 'image/jpeg', 'public', 'public', 94729, '[]', '[]', '[]', '[]', 3, '2025-08-05 23:24:35', '2025-08-05 23:24:35'),
(6, 'App\\Models\\t_transaksi_donasi_program', 1, 'c5cb291f-8e52-4fc5-921d-14f51accb33f', 'bukti_pembayaran', 'nadia-v1', '01K21KY5WZBBRWG9NKDS5S5SW1.jpg', 'image/jpeg', 'public', 'public', 87996, '[]', '[]', '[]', '[]', 1, '2025-08-06 23:36:49', '2025-08-06 23:36:49');

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
(1, '2025_07_30_081710_create_m_data_diris_table', 1),
(2, '2025_07_30_154100_create_m_mandors_table', 2),
(3, '2025_08_01_114826_create_m_kategori_barangs_table', 3),
(4, '2025_08_01_120236_create_m_metode_pembayarans_table', 4),
(5, '2025_08_01_132751_create_m_kategori_posts_table', 5),
(6, '2014_10_12_000000_create_users_table', 6),
(7, '2014_10_12_100000_create_password_reset_tokens_table', 6),
(8, '2014_10_12_200000_add_two_factor_columns_to_users_table', 6),
(9, '2019_08_19_000000_create_failed_jobs_table', 6),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 6),
(11, '2025_07_30_061838_create_sessions_table', 6),
(12, '2025_07_30_151930_create_m_program_pembangunans_table', 6),
(13, '2025_08_01_114742_create_m_barangs_table', 6),
(15, '2025_08_01_120123_create_t_transaksi_donasi_programs_table', 7),
(17, '2025_08_04_123342_create_media_table', 9),
(18, '2025_08_01_115943_create_t_kebutuhan_barang_programs_table', 10),
(19, '2025_08_01_120154_create_t_transaksi_donasi_spesifiks_table', 11),
(20, '2025_08_09_083854_donasi_kebutuhan', 12),
(21, '2025_08_09_090632_create_donasi_kebutuhans_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `m_barangs`
--

CREATE TABLE `m_barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kategoribarang_id` bigint UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_barangs`
--

INSERT INTO `m_barangs` (`id`, `kategoribarang_id`, `kode_barang`, `nama_barang`, `nama_satuan`, `harga_satuan`, `deskripsi_barang`, `created_at`, `updated_at`) VALUES
(1, 1, 'MNM-1', 'Sprite', 'unit', '15000', 'minuman', '2025-08-05 09:04:41', '2025-08-05 09:04:41'),
(2, 1, 'P10', 'Coca Cola', 'unit', '20000', 'minuman', '2025-08-07 11:16:48', '2025-08-07 11:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `m_data_diris`
--

CREATE TABLE `m_data_diris` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_data_diris`
--

INSERT INTO `m_data_diris` (`id`, `nama_lengkap`, `nip`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'Yusak Akhnuk', '2141762051', 'Malang', '2003-03-31', 'Jl. Candi Telaga Wangi no.30', 'laki', '081515430129', '2025-08-04 10:25:23', '2025-08-04 10:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `m_kategoris`
--

CREATE TABLE `m_kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori_barangs`
--

CREATE TABLE `m_kategori_barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kategori_barangs`
--

INSERT INTO `m_kategori_barangs` (`id`, `nama_kategori`, `deskripsi_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Bangunan', 'Untuk barang pembangunan', '2025-08-05 03:03:25', '2025-08-05 03:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori_posts`
--

CREATE TABLE `m_kategori_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_mandors`
--

CREATE TABLE `m_mandors` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_mandors`
--

INSERT INTO `m_mandors` (`id`, `nama_lengkap`, `nik`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'Gadis Mustikasari', '1234567890123456', 'Malang', '2003-09-25', 'Jl. Lembang 1A/1B', 'perempuan', '081515430129', '2025-08-05 02:36:22', '2025-08-05 02:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `m_metode_pembayarans`
--

CREATE TABLE `m_metode_pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_open` tinyint(1) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_metode_pembayarans`
--

INSERT INTO `m_metode_pembayarans` (`id`, `nama_pembayaran`, `no_rekening`, `is_open`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'BCA', '0113360132', 0, 'Well', '2025-08-06 07:16:22', '2025-08-09 05:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `m_posts`
--

CREATE TABLE `m_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_program_pembangunans`
--

CREATE TABLE `m_program_pembangunans` (
  `id` bigint UNSIGNED NOT NULL,
  `mandor_id` bigint UNSIGNED NOT NULL,
  `kode_program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pembangunan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estimasi_tanggal_selesai` date NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai_aktual` date DEFAULT NULL,
  `estimasi_biaya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('diajukan','direncanakan','berjalan','selesai','ditunda') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_program_pembangunans`
--

INSERT INTO `m_program_pembangunans` (`id`, `mandor_id`, `kode_program`, `nama_pembangunan`, `estimasi_tanggal_selesai`, `tanggal_mulai`, `tanggal_selesai_aktual`, `estimasi_biaya`, `status`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'P09', 'Pembangunan Masjid', '2025-08-10', '2025-08-07', '2025-08-09', '15000000', 'diajukan', 'Well', '2025-08-05 23:24:25', '2025-08-05 23:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('QsLhzNPVYNziH70awwqzLc99xHHPJdrlpG3BAZXB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiakpSd2RCSzJJd0N5bm00bEZNYjBMU1VNb1RzN1Z1WjhEamJXWjBxSyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjYxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vdHJhbnNha3NpLWRvbmFzaS1zcGVzaWZpa3MvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJHY5MVA0RnNIYzZCaEJBbDh3b0pDWE9ibVlMNlhBQ29zZ3BnUzRFU3NkVnNKRi9adTM5STNhIjtzOjg6ImZpbGFtZW50IjthOjA6e319', 1754741435),
('tRDNfKM61H3UYqpcCFOUUGGeItTPTCbPaUnnYlEY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiNGwzZ1ZUQzFtOElSQzdTSFNIeDJlVDNoM3dWZTZkTHUyeWpUWlB4NSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjYxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vdHJhbnNha3NpLWRvbmFzaS1zcGVzaWZpa3MvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJHY5MVA0RnNIYzZCaEJBbDh3b0pDWE9ibVlMNlhBQ29zZ3BnUzRFU3NkVnNKRi9adTM5STNhIjtzOjg6ImZpbGFtZW50IjthOjA6e319', 1754669992);

-- --------------------------------------------------------

--
-- Table structure for table `t_kebutuhan_barang_programs`
--

CREATE TABLE `t_kebutuhan_barang_programs` (
  `id` bigint UNSIGNED NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('diambil','tersedia') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_kebutuhan_barang_programs`
--

INSERT INTO `t_kebutuhan_barang_programs` (`id`, `program_id`, `barang_id`, `jumlah_barang`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2', 'tersedia', 'Minuman', NULL, NULL),
(2, 1, 2, '5', 'tersedia', 'Minuman', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_transaksi_donasi_programs`
--

CREATE TABLE `t_transaksi_donasi_programs` (
  `id` bigint UNSIGNED NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pembayaran_id` bigint UNSIGNED NOT NULL,
  `jumlah_donasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` enum('gagal','pending','sukses') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesan_donatur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_transaksi_donasi_programs`
--

INSERT INTO `t_transaksi_donasi_programs` (`id`, `program_id`, `user_id`, `pembayaran_id`, `jumlah_donasi`, `status_pembayaran`, `pesan_donatur`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '90000000', 'sukses', 'Bismillah', '2025-08-06 23:19:12', '2025-08-07 00:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `t_transaksi_donasi_spesifiks`
--

CREATE TABLE `t_transaksi_donasi_spesifiks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pembayaran_id` bigint UNSIGNED NOT NULL,
  `jumlah_donasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` enum('gagal','pending','sukses') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan_donatur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_transaksi_donasi_spesifiks`
--

INSERT INTO `t_transaksi_donasi_spesifiks` (`id`, `user_id`, `pembayaran_id`, `jumlah_donasi`, `status_pembayaran`, `pesan_donatur`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '130000', 'pending', 'Bismillah', '2025-08-09 02:58:17', '2025-08-09 02:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datadiri_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `datadiri_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@yahoo.com', NULL, '$2y$12$v91P4FsHc6BhBAl8woJCXObmYL6XACosgpgS4ESsdVsJF/Zu39I3a', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-08-03 09:50:41', '2025-08-04 10:45:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donasi_kebutuhans`
--
ALTER TABLE `donasi_kebutuhans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donasi_kebutuhans_kebutuhan_id_foreign` (`kebutuhan_id`),
  ADD KEY `donasi_kebutuhans_donasi_id_foreign` (`donasi_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_barangs`
--
ALTER TABLE `m_barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_barangs_kode_barang_unique` (`kode_barang`),
  ADD KEY `m_barangs_id_kategori_foreign` (`kategoribarang_id`);

--
-- Indexes for table `m_data_diris`
--
ALTER TABLE `m_data_diris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_data_diris_nip_unique` (`nip`),
  ADD UNIQUE KEY `m_data_diris_no_telp_unique` (`no_telp`);

--
-- Indexes for table `m_kategoris`
--
ALTER TABLE `m_kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kategori_barangs`
--
ALTER TABLE `m_kategori_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kategori_posts`
--
ALTER TABLE `m_kategori_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_kategori_posts_post_id_foreign` (`post_id`),
  ADD KEY `m_kategori_posts_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `m_mandors`
--
ALTER TABLE `m_mandors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_mandors_nik_unique` (`nik`),
  ADD UNIQUE KEY `m_mandors_no_telp_unique` (`no_telp`);

--
-- Indexes for table `m_metode_pembayarans`
--
ALTER TABLE `m_metode_pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_metode_pembayarans_nno_rekenening_unique` (`no_rekening`);

--
-- Indexes for table `m_posts`
--
ALTER TABLE `m_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_program_pembangunans`
--
ALTER TABLE `m_program_pembangunans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_program_pembangunans_kode_program_unique` (`kode_program`),
  ADD KEY `m_program_pembangunans_id_mandor_foreign` (`mandor_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `t_kebutuhan_barang_programs`
--
ALTER TABLE `t_kebutuhan_barang_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_kebutuhan_barang_programs_program_id_foreign` (`program_id`),
  ADD KEY `t_kebutuhan_barang_programs_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `t_transaksi_donasi_programs`
--
ALTER TABLE `t_transaksi_donasi_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_transaksi_donasi_programs_id_program_foreign` (`program_id`),
  ADD KEY `t_transaksi_donasi_programs_id_user_foreign` (`user_id`),
  ADD KEY `t_transaksi_donasi_programs_id_metode_pembayaran_foreign` (`pembayaran_id`);

--
-- Indexes for table `t_transaksi_donasi_spesifiks`
--
ALTER TABLE `t_transaksi_donasi_spesifiks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_transaksi_donasi_spesifiks_user_id_foreign` (`user_id`),
  ADD KEY `t_transaksi_donasi_spesifiks_pembayaran_id_foreign` (`pembayaran_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_identitas_foreign` (`datadiri_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donasi_kebutuhans`
--
ALTER TABLE `donasi_kebutuhans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `m_barangs`
--
ALTER TABLE `m_barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_data_diris`
--
ALTER TABLE `m_data_diris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_kategoris`
--
ALTER TABLE `m_kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_kategori_barangs`
--
ALTER TABLE `m_kategori_barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_kategori_posts`
--
ALTER TABLE `m_kategori_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_mandors`
--
ALTER TABLE `m_mandors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_metode_pembayarans`
--
ALTER TABLE `m_metode_pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_posts`
--
ALTER TABLE `m_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_program_pembangunans`
--
ALTER TABLE `m_program_pembangunans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_kebutuhan_barang_programs`
--
ALTER TABLE `t_kebutuhan_barang_programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_transaksi_donasi_programs`
--
ALTER TABLE `t_transaksi_donasi_programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_transaksi_donasi_spesifiks`
--
ALTER TABLE `t_transaksi_donasi_spesifiks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donasi_kebutuhans`
--
ALTER TABLE `donasi_kebutuhans`
  ADD CONSTRAINT `donasi_kebutuhans_donasi_id_foreign` FOREIGN KEY (`donasi_id`) REFERENCES `t_transaksi_donasi_spesifiks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donasi_kebutuhans_kebutuhan_id_foreign` FOREIGN KEY (`kebutuhan_id`) REFERENCES `t_kebutuhan_barang_programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_barangs`
--
ALTER TABLE `m_barangs`
  ADD CONSTRAINT `m_barangs_id_kategori_foreign` FOREIGN KEY (`kategoribarang_id`) REFERENCES `m_kategori_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_kategori_posts`
--
ALTER TABLE `m_kategori_posts`
  ADD CONSTRAINT `m_kategori_posts_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `m_kategoris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `m_kategori_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `m_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `m_program_pembangunans`
--
ALTER TABLE `m_program_pembangunans`
  ADD CONSTRAINT `m_program_pembangunans_id_mandor_foreign` FOREIGN KEY (`mandor_id`) REFERENCES `m_mandors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_kebutuhan_barang_programs`
--
ALTER TABLE `t_kebutuhan_barang_programs`
  ADD CONSTRAINT `t_kebutuhan_barang_programs_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_kebutuhan_barang_programs_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `m_program_pembangunans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_transaksi_donasi_programs`
--
ALTER TABLE `t_transaksi_donasi_programs`
  ADD CONSTRAINT `t_transaksi_donasi_programs_id_metode_pembayaran_foreign` FOREIGN KEY (`pembayaran_id`) REFERENCES `m_metode_pembayarans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_transaksi_donasi_programs_id_program_foreign` FOREIGN KEY (`program_id`) REFERENCES `m_program_pembangunans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_transaksi_donasi_programs_id_user_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_transaksi_donasi_spesifiks`
--
ALTER TABLE `t_transaksi_donasi_spesifiks`
  ADD CONSTRAINT `t_transaksi_donasi_spesifiks_pembayaran_id_foreign` FOREIGN KEY (`pembayaran_id`) REFERENCES `m_metode_pembayarans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_transaksi_donasi_spesifiks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_identitas_foreign` FOREIGN KEY (`datadiri_id`) REFERENCES `m_data_diris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
