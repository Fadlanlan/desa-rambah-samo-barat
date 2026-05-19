-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2026 at 12:12 AM
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
-- Database: `desa_rambah_samo_barat`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'created User', 'App\\Models\\User', 'created', 2, NULL, NULL, '{\"attributes\":{\"id\":2,\"name\":\"Admin Desa\",\"email\":\"operator@desarambahsamobarat.id\",\"email_verified_at\":null,\"password\":\"$2y$12$K4BLRgUXH5UPYrUduYcCyes14ZzmFBEbrXtkR8qTGJUIIBSX0TnzO\",\"phone\":null,\"avatar\":null,\"nik\":null,\"alamat\":null,\"login_attempts\":0,\"locked_until\":null,\"last_login_at\":null,\"last_login_ip\":null,\"is_active\":true,\"remember_token\":null,\"created_at\":\"2026-05-19T18:52:40.000000Z\",\"updated_at\":\"2026-05-19T18:52:40.000000Z\",\"deleted_at\":null}}', NULL, '2026-05-19 11:52:40', '2026-05-19 11:52:40'),
(2, 'default', 'updated Berita', 'App\\Models\\Berita', 'updated', 10, 'App\\Models\\User', 2, '{\"attributes\":{\"views_count\":266,\"updated_at\":\"2026-05-19T19:33:39.000000Z\"},\"old\":{\"views_count\":265,\"updated_at\":\"2026-05-19T18:42:48.000000Z\"}}', NULL, '2026-05-19 12:33:39', '2026-05-19 12:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `penyelenggara` varchar(255) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nomor_antrian` varchar(20) NOT NULL,
  `nama_pengunjung` varchar(255) NOT NULL,
  `nik_pengunjung` varchar(16) DEFAULT NULL,
  `penduduk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kontak_pengunjung` varchar(20) DEFAULT NULL,
  `keperluan` varchar(255) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `jam_kunjungan` varchar(10) NOT NULL,
  `status` enum('menunggu','dipanggil','selesai','batal') NOT NULL DEFAULT 'menunggu',
  `token_akses` varchar(40) NOT NULL,
  `catatan` text DEFAULT NULL,
  `called_by` bigint(20) UNSIGNED DEFAULT NULL,
  `called_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `uuid`, `nomor_antrian`, `nama_pengunjung`, `nik_pengunjung`, `penduduk_id`, `kontak_pengunjung`, `keperluan`, `tanggal_kunjungan`, `jam_kunjungan`, `status`, `token_akses`, `catatan`, `called_by`, `called_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '6126f8ec-f6ac-4a4d-a868-1d7e77cb56e4', 'A-001', 'Rubye Thompson DVM', '264605578262233', 24, NULL, 'Pengurusan Surat Keterangan Tidak Mampu', '2026-05-19', '08:00', 'menunggu', 'naDyJFIToHl9RAslLpYUisT4nwummONw4pmuOa1B', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49'),
(2, '1df1b267-89d1-4cc3-8f3a-7c29a8d6d417', 'A-002', 'Koby Kohler', '671583394494108', 41, NULL, 'Pengurusan Surat Keterangan Usaha', '2026-05-19', '11:00', 'menunggu', 'NPSRQJNmW2zSBsUgrtwaFXd7HkYGEb4fadkDUBqc', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49'),
(3, '005b88d1-1811-4ceb-9c2b-9d5b5d36fe89', 'A-003', 'Prof. Buck Strosin MD', '553409499902451', 19, NULL, 'Pengurusan Surat Keterangan Domisili', '2026-05-19', '08:00', 'menunggu', 'aAEtGRoJS5W08wawTKNypvy9KpTvZiwe2P7ZVCBT', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49'),
(4, '2f067b7f-6e90-40de-aee7-126b52d66d20', 'A-004', 'Norbert Pagac', '639236048293092', 26, NULL, 'Pengurusan Surat Keterangan Usaha', '2026-05-19', '08:00', 'menunggu', 'IaovvAQBhczNjWnFt1e4qmfiU6HVcvC9XhVgMZMX', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49'),
(5, 'ffb47ac6-dbb6-4ecc-9968-c223286bb88e', 'A-005', 'Prof. Cara Dickens PhD', '599289829410488', 48, NULL, 'Pengurusan Surat Keterangan Domisili', '2026-05-19', '10:00', 'menunggu', 'J9sQESssHQrQ4tnMZkVB1Tl710ofyXYxxs1UBAVK', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49'),
(6, '6779e751-0e08-4d86-b1b5-a77493c05c7f', 'A-006', 'Dominique Jast', '858721912253741', 20, NULL, 'Pengurusan Surat Keterangan Tidak Mampu', '2026-05-19', '09:00', 'menunggu', 'LWsbC7KupfKTBLMhTy3Y8CA2XfNrVew1wwqjyqOh', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49'),
(7, '9d83878b-5846-437b-b5e4-1724895dd243', 'A-007', 'Heaven Schuster', '465216672373082', 36, NULL, 'Pengurusan Surat Keterangan Tidak Mampu', '2026-05-19', '10:00', 'menunggu', 'Ux3VblXyDLjpyiJSBQdDKX28VWV6Op3wbgsdS1rA', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49'),
(8, '7bb0989f-d56d-4cad-9d53-cc278b035928', 'A-008', 'Koby Kohler', '671583394494108', 41, NULL, 'Pengurusan Surat Keterangan Usaha', '2026-05-19', '08:00', 'menunggu', 'J9jl4iC7mrBo5Ohfp545BjjGHZK9AaS3c8d5jPui', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49'),
(9, '3b01c63f-cde4-4e8c-b893-a571f8d9f6b2', 'A-009', 'Nicholas Beatty', '767822226355895', 43, NULL, 'Pengurusan Surat Keterangan Tidak Mampu', '2026-05-19', '11:00', 'menunggu', 'ONmDMhI2WLJDUQuTAw8qOvQIgU1MfD5AWr17dfE6', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49'),
(10, '75c0b12a-f4f8-4c7b-862a-76e559bc553a', 'A-010', 'Noelia Christiansen', '833275339093330', 18, NULL, 'Pengurusan Surat Keterangan Domisili', '2026-05-19', '10:00', 'menunggu', 'UQtdfsWFgjAVx7QCNW9BchMLhy761nckq0jzrQah', NULL, NULL, NULL, NULL, '2026-05-19 11:42:49', '2026-05-19 11:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `apbdes`
--

CREATE TABLE `apbdes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tahun_anggaran` year(4) NOT NULL,
  `jenis` enum('pendapatan','belanja','pembiayaan') NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `sub_kategori` varchar(255) DEFAULT NULL,
  `uraian` varchar(255) NOT NULL,
  `anggaran` decimal(15,2) NOT NULL DEFAULT 0.00,
  `realisasi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sumber_dana` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ringkasan` text DEFAULT NULL,
  `konten` longtext NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `views_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `user_id`, `category_id`, `judul`, `slug`, `ringkasan`, `konten`, `gambar`, `is_published`, `is_featured`, `published_at`, `views_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Labore quos voluptatem nam omnis cumque ducimus culpa culpa.', 'labore-quos-voluptatem-nam-omnis-cumque-ducimus-culpa-culpa', 'Qui id deserunt quia. Voluptatem quam magnam voluptatem dicta.', 'Reiciendis cupiditate at id voluptate rerum qui fugiat. Expedita quod animi et consequuntur. Suscipit consequatur minima et voluptatem. Sit odio reprehenderit qui voluptatibus autem.', NULL, 1, 1, '2026-01-22 04:35:20', 140, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(2, 1, 2, 'Temporibus voluptas tempore atque.', 'temporibus-voluptas-tempore-atque', 'Qui possimus corporis ea natus. Distinctio fuga at sit aut quidem.', 'Numquam distinctio ipsam quod dolor. Et et nesciunt ipsa. Delectus quisquam excepturi dolorem accusantium deserunt. Eius eveniet sed qui eligendi unde aperiam.', NULL, 1, 0, '2025-06-30 07:54:41', 534, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(3, 1, 3, 'Aliquid molestiae commodi itaque ea.', 'aliquid-molestiae-commodi-itaque-ea', 'Minus voluptatem quo nesciunt beatae.', 'Cumque quo quis vel molestiae. Laborum accusamus molestiae quidem odit. Quia error similique aut consequatur dolor. Autem dolor sint odit occaecati id ut magnam. Rerum quis mollitia et.', NULL, 1, 0, '2025-07-08 15:42:13', 416, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(4, 1, 4, 'Delectus illum molestiae sed voluptate et omnis nobis.', 'delectus-illum-molestiae-sed-voluptate-et-omnis-nobis', 'Enim voluptas voluptas et ex voluptate.', 'Et dignissimos laudantium fugit et. Nisi fugit enim aut inventore molestiae ipsa est temporibus. Qui corporis non est facere assumenda. Architecto ipsum enim qui aliquid quia aliquam. Sed sint omnis exercitationem iste. Quod facilis nulla ipsum laborum quibusdam perferendis dignissimos repudiandae. Et aut veniam ut quo.', NULL, 1, 0, '2025-09-09 15:28:11', 251, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(5, 1, 5, 'Qui non eligendi cupiditate veritatis suscipit.', 'qui-non-eligendi-cupiditate-veritatis-suscipit', 'Voluptas quisquam aut sit laudantium voluptatem velit.', 'Quos nam similique aliquam alias odio. Et animi explicabo odit fuga qui iste. Ut fuga consequatur nostrum. Quia iusto iste odio quaerat nihil illo. Quo labore id at omnis accusantium. Velit omnis dolore distinctio facere eum.', NULL, 1, 1, '2025-06-11 05:18:38', 739, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(6, 1, 6, 'Magnam voluptate rerum quo.', 'magnam-voluptate-rerum-quo', 'Sit non molestiae error et ipsa est est.', 'Praesentium provident voluptates aut adipisci facere in. Officiis mollitia ea nulla optio. Fugit dicta blanditiis excepturi vero. Ullam autem impedit aut ut et quos quam. Et et aut beatae. Esse qui distinctio ipsam sunt corporis perferendis natus.', NULL, 1, 1, '2026-04-21 11:26:40', 382, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(7, 1, 7, 'Nobis aut voluptatem sint maxime alias.', 'nobis-aut-voluptatem-sint-maxime-alias', 'Ducimus illum nesciunt sit rerum.', 'Praesentium eius sed quod officiis voluptas accusantium. Ut corrupti illum libero nulla placeat quia omnis. Neque ipsa et quia. Earum ut perspiciatis voluptatem exercitationem corporis eaque voluptatem sint. Repellat facilis ea quo eaque magnam enim culpa. Eos repellat quo nemo ut.', NULL, 1, 1, '2025-09-19 11:20:47', 134, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(8, 1, 8, 'Quidem ipsum atque vero sed omnis.', 'quidem-ipsum-atque-vero-sed-omnis', 'Qui enim perspiciatis omnis ratione odio tempora aliquid.', 'Animi expedita ut dolor cum. Id et cupiditate architecto perspiciatis officiis doloremque qui. Molestias omnis repellendus ut sunt perspiciatis sequi dolore debitis. Nihil rerum sint nobis eos architecto vel. Quia autem debitis omnis voluptatem eveniet ut at.', NULL, 1, 0, '2025-10-01 07:14:57', 642, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(9, 1, 9, 'Aut facere odio iste qui quia impedit.', 'aut-facere-odio-iste-qui-quia-impedit', 'Soluta fuga est quia nemo molestiae.', 'Nam quibusdam sed recusandae neque ipsum sint odio consequuntur. Laborum quidem optio cupiditate temporibus quisquam amet quia. Velit et aut in magni praesentium et qui. Consequatur aut odit facere eaque quia.', NULL, 1, 0, '2025-08-18 20:48:14', 417, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(10, 1, 10, 'Eos culpa quas ex quibusdam non sunt officia.', 'eos-culpa-quas-ex-quibusdam-non-sunt-officia', 'Eum magnam ut molestiae dolorum et dolorem asperiores. Cupiditate facilis alias est consequatur nostrum sed nulla doloremque.', 'Voluptatem et omnis est laborum dolorem minima. Labore quaerat sit magni esse. Officia enim beatae velit id voluptas voluptatem dignissimos. Saepe veritatis nam vel deserunt.', NULL, 1, 0, '2025-11-24 06:03:59', 266, '2026-05-19 11:42:48', '2026-05-19 12:33:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-captcha_17a39ab4b1064ad7377423396ae42d8d', 'a:9:{i:0;s:1:\"y\";i:1;s:1:\"t\";i:2;s:1:\"y\";i:3;s:1:\"h\";i:4;s:1:\"p\";i:5;s:1:\"w\";i:6;s:1:\"l\";i:7;s:1:\"c\";i:8;s:1:\"u\";}', 1779216729),
('laravel-cache-captcha_1dd24c9cea38ad6c45677b672507cf0f', 'a:9:{i:0;s:1:\"b\";i:1;s:1:\"y\";i:2;s:1:\"e\";i:3;s:1:\"0\";i:4;s:1:\"w\";i:5;s:1:\"l\";i:6;s:1:\"j\";i:7;s:1:\"t\";i:8;s:1:\"b\";}', 1779221122),
('laravel-cache-captcha_687ce14a92c7c3dd24db806ed5fb2c41', 'a:9:{i:0;s:1:\"h\";i:1;s:1:\"l\";i:2;s:1:\"z\";i:3;s:1:\"x\";i:4;s:1:\"1\";i:5;s:1:\"r\";i:6;s:1:\"y\";i:7;s:1:\"3\";i:8;s:1:\"g\";}', 1779221810),
('laravel-cache-captcha_a923af1cb1c66d83b0b773a896dcbebb', 'a:6:{i:0;s:1:\"m\";i:1;s:1:\"m\";i:2;s:1:\"t\";i:3;s:1:\"5\";i:4;s:1:\"i\";i:5;s:1:\"w\";}', 1779216654),
('laravel-cache-captcha_aced51e6701c652014db15a5abf99981', 'a:6:{i:0;s:1:\"o\";i:1;s:1:\"j\";i:2;s:1:\"z\";i:3;s:1:\"x\";i:4;s:1:\"z\";i:5;s:1:\"d\";}', 1779217955),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:80:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"user.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"user.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"user.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"user.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:9:\"role.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:11:\"role.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:9:\"role.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:11:\"role.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"village.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"village.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"penduduk.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"penduduk.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:13:\"penduduk.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:15:\"penduduk.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"penduduk.import\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"penduduk.export\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"keluarga.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:15:\"keluarga.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:13:\"keluarga.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:15:\"keluarga.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:11:\"berita.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:13:\"berita.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"berita.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:13:\"berita.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:14:\"berita.publish\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:11:\"agenda.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:13:\"agenda.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:11:\"agenda.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:13:\"agenda.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:15:\"pengumuman.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:17:\"pengumuman.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"pengumuman.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:17:\"pengumuman.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:11:\"galeri.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:13:\"galeri.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:11:\"galeri.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:13:\"galeri.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:12:\"dokumen.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:14:\"dokumen.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:12:\"dokumen.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:14:\"dokumen.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:11:\"wisata.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:13:\"wisata.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:11:\"wisata.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:13:\"wisata.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:11:\"kontak.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:11:\"kontak.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:12:\"content.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:14:\"content.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:12:\"content.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:14:\"content.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:15:\"content.publish\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:10:\"surat.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:12:\"surat.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:10:\"surat.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:12:\"surat.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:13:\"surat.approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:10:\"surat.sign\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:16:\"jenis-surat.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:18:\"jenis-surat.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:16:\"jenis-surat.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:18:\"jenis-surat.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:14:\"pengaduan.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:16:\"pengaduan.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:17:\"pengaduan.process\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:16:\"pengaduan.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:12:\"antrian.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:14:\"antrian.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:11:\"apbdes.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:13:\"apbdes.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:11:\"apbdes.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:13:\"apbdes.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:9:\"umkm.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:5;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:11:\"umkm.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:9:\"umkm.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:11:\"umkm.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:11:\"umkm.verify\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:12:\"setting.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:12:\"setting.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:8:\"log.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}}s:5:\"roles\";a:5:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super-admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"kades\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:8:\"operator\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:5:\"warga\";s:1:\"c\";s:3:\"web\";}}}', 1779303235);

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
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `color`, `icon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vero', 'vero', 'Quia voluptatem ab et rerum quisquam non.', '#75f5c7', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(2, 'Cum', 'cum', 'Sed fugiat perspiciatis molestiae doloribus commodi quia quasi et.', '#1ccefc', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(3, 'Provident', 'provident', 'Incidunt ut sunt voluptatem praesentium rerum.', '#5a075a', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(4, 'Error', 'error', 'Magni qui pariatur nesciunt sint non sed.', '#c4e9f7', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(5, 'Rerum', 'rerum', 'Est cupiditate dolor dolorem.', '#dbb192', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(6, 'Aut', 'aut', 'Quibusdam quod provident magni magni qui autem et.', '#b4296b', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(7, 'Praesentium', 'praesentium', 'Repellendus cumque eveniet culpa illo.', '#1c11c6', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(8, 'Sit', 'sit', 'Officia quia perspiciatis repellat earum cupiditate nostrum.', '#795d93', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(9, 'Porro', 'porro', 'Quisquam aut ut aperiam velit.', '#9407df', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(10, 'Adipisci', 'adipisci', 'Qui quia nihil amet.', '#498f0b', 'fa-folder', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(20) DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `kategori` varchar(50) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `download_count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `tipe` enum('foto','video') NOT NULL DEFAULT 'foto',
  `kategori` varchar(50) DEFAULT NULL,
  `urutan` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `template` longtext DEFAULT NULL,
  `persyaratan` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `urutan` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `nama`, `kode`, `template`, `persyaratan`, `keterangan`, `is_active`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Surat Keterangan Tidak Mampu', 'SKTM', NULL, NULL, NULL, 1, 0, '2026-05-19 11:42:48', '2026-05-19 11:42:48'),
(2, 'Surat Keterangan Domisili', 'SKD', NULL, NULL, NULL, 1, 0, '2026-05-19 11:42:48', '2026-05-19 11:42:48'),
(3, 'Surat Keterangan Usaha', 'SKU', NULL, NULL, NULL, 1, 0, '2026-05-19 11:42:48', '2026-05-19 11:42:48'),
(4, 'Surat Pengantar Nikah', 'SPN', NULL, NULL, NULL, 1, 0, '2026-05-19 11:42:48', '2026-05-19 11:42:48');

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
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_kk` text NOT NULL,
  `no_kk_hash` varchar(64) DEFAULT NULL,
  `kepala_keluarga` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `dusun` varchar(255) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `subjek` varchar(255) NOT NULL,
  `pesan` longtext NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `replied_by` bigint(20) UNSIGNED DEFAULT NULL,
  `balasan` text DEFAULT NULL,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `status` enum('success','failed','locked') NOT NULL DEFAULT 'success',
  `login_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_surat`
--

CREATE TABLE `log_surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `surat_id` bigint(20) UNSIGNED NOT NULL,
  `aksi` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2026_02_12_100001_create_villages_table', 1),
(5, '2026_02_12_100002_create_keluarga_table', 1),
(6, '2026_02_12_100003_create_categories_table', 1),
(7, '2026_02_12_100003_create_penduduk_table', 1),
(8, '2026_02_12_100004_create_berita_table', 1),
(9, '2026_02_12_100005_create_pengumuman_table', 1),
(10, '2026_02_12_100006_create_agenda_table', 1),
(11, '2026_02_12_100007_create_galeri_table', 1),
(12, '2026_02_12_100008_create_dokumen_table', 1),
(13, '2026_02_12_100009_create_jenis_surat_table', 1),
(14, '2026_02_12_100010_create_surat_table', 1),
(15, '2026_02_12_100011_create_pengaduan_table', 1),
(16, '2026_02_12_100012_create_antrian_table', 1),
(17, '2026_02_12_100013_create_apbdes_table', 1),
(18, '2026_02_12_100014_create_umkm_table', 1),
(19, '2026_02_12_100015_create_kontak_table', 1),
(20, '2026_02_12_100016_create_login_logs_table', 1),
(21, '2026_02_12_100017_create_privacy_consents_table', 1),
(22, '2026_02_12_183621_create_permission_tables', 1),
(23, '2026_02_12_183634_create_activity_log_table', 1),
(24, '2026_02_12_183635_add_event_column_to_activity_log_table', 1),
(25, '2026_02_12_183636_add_batch_uuid_column_to_activity_log_table', 1),
(26, '2026_02_12_225500_add_uuid_to_surat_table', 1),
(27, '2026_02_14_100018_create_wisata_table', 1),
(28, '2026_02_15_100000_upgrade_surat_system', 1),
(29, '2026_02_15_100001_create_log_surat_table', 1),
(30, '2026_02_15_120000_make_jenis_kelamin_nullable_in_penduduk_table', 1),
(31, '2026_02_15_134500_create_settings_table', 1),
(32, '2026_02_15_200000_add_blind_indices_to_warga_tables', 1),
(33, '2026_02_15_300000_add_identity_verification_to_surat_table', 1),
(34, '2026_02_15_400000_remove_selfie_from_surat_table', 1),
(35, '2026_02_15_500000_remove_ktp_from_surat_table', 1),
(36, '2026_05_20_100000_create_pembangunans_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

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
-- Table structure for table `pembangunans`
--

CREATE TABLE `pembangunans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `anggaran` decimal(15,2) NOT NULL DEFAULT 0.00,
  `realisasi` decimal(15,2) NOT NULL DEFAULT 0.00,
  `pj` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Perencanaan',
  `progress` int(11) NOT NULL DEFAULT 0,
  `sumber_dana` varchar(255) DEFAULT NULL,
  `lat_long` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto_sebelum` varchar(255) DEFAULT NULL,
  `foto_sesudah` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keluarga_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nik` text NOT NULL,
  `nik_hash` varchar(64) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `status_perkawinan` varchar(30) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) DEFAULT NULL,
  `kewarganegaraan` varchar(5) NOT NULL DEFAULT 'WNI',
  `alamat` text DEFAULT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `dusun` varchar(255) DEFAULT NULL,
  `golongan_darah` varchar(5) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status_hubungan` enum('Kepala Keluarga','Istri','Anak','Menantu','Cucu','Orang Tua','Mertua','Famili Lain','Pembantu','Lainnya') DEFAULT NULL,
  `status` enum('aktif','meninggal','pindah','hilang') NOT NULL DEFAULT 'aktif',
  `catatan` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `keluarga_id`, `nik`, `nik_hash`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_perkawinan`, `pekerjaan`, `pendidikan_terakhir`, `kewarganegaraan`, `alamat`, `rt`, `rw`, `dusun`, `golongan_darah`, `no_hp`, `foto`, `status_hubungan`, `status`, `catatan`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, '661686353683454', NULL, 'Donna Ondricka', 'New Brettborough', '2023-08-26', 'P', 'Kristen', 'Kawin', 'Payroll Clerk', 'SD', 'WNI', '47489 Nikolaus Forks\nLake Bryceton, MO 34995', '09', '05', 'Dusun C', 'AB', '1-539-305-9988', NULL, 'Anak', 'aktif', 'Quia blanditiis ea praesentium nihil consequatur.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(2, NULL, '584973017941212', NULL, 'Mr. Paul Wiza', 'Kunzeburgh', '1973-04-23', 'P', 'Konghucu', 'Belum Kawin', 'Manicurists', 'S2', 'WNI', '63594 Kiehn Station Suite 724\nNorth Estel, AR 84599', '08', '01', 'Dusun C', 'B', '1-734-948-1518', NULL, 'Kepala Keluarga', 'aktif', 'Ut quibusdam qui enim laboriosam sed rem.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(3, NULL, '057881165239964', NULL, 'Sammy Botsford', 'South Izabellatown', '2006-04-20', 'P', 'Kristen', 'Cerai Hidup', 'Rolling Machine Setter', 'S2', 'WNI', '8686 Heidi Cliff Suite 046\nWeissnattown, UT 33042-2865', '04', '02', 'Dusun B', 'B', '1-534-745-5367', NULL, 'Anak', 'aktif', 'Beatae temporibus aliquam expedita cupiditate quisquam sit et.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(4, NULL, '317103435291855', NULL, 'Miss Bridgette Gislason V', 'Kleinhaven', '2018-10-30', 'P', 'Buddha', 'Belum Kawin', 'Valve Repairer OR Regulator Repairer', 'SMP', 'WNI', '509 Elinore Parkway\nNorth Retha, RI 48038', '07', '04', 'Dusun B', 'O', '+1-425-683-1843', NULL, 'Istri', 'aktif', 'Debitis nam vel error iste.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(5, NULL, '716033564751959', NULL, 'Mrs. Gladyce Kautzer', 'Lindaton', '2020-06-19', 'P', 'Hindu', 'Cerai Hidup', 'Tax Examiner', 'S3', 'WNI', '562 Dare Green Apt. 663\nLabadiebury, NC 30228', '02', '00', 'Dusun A', 'B', '+14304028021', NULL, 'Kepala Keluarga', 'aktif', 'Aut rem molestiae neque quasi laboriosam sit.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(6, NULL, '881311180153601', NULL, 'Ian Hahn', 'West Aliyahfurt', '2000-11-12', 'L', 'Buddha', 'Kawin', 'Aircraft Rigging Assembler', 'SMA', 'WNI', '471 Bergstrom Rapids Apt. 217\nNew Eugenia, MT 38864', '06', '04', 'Dusun B', 'A', '(281) 829-5718', NULL, 'Anak', 'aktif', 'Possimus consequatur in perferendis modi nostrum unde aut.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(7, NULL, '432940716230645', NULL, 'Sherman Wuckert', 'New Darian', '2015-12-26', 'L', 'Katolik', 'Belum Kawin', 'Infantry', 'SMA', 'WNI', '6030 Emanuel Causeway\nSouth Reva, NJ 23666-3562', '05', '06', 'Dusun B', 'B', '1-564-918-2111', NULL, 'Anak', 'aktif', 'Est reiciendis animi molestias qui porro consectetur.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(8, NULL, '858762445111807', NULL, 'Serenity Cruickshank', 'Lake Chadd', '1987-05-07', 'L', 'Hindu', 'Belum Kawin', 'Title Searcher', 'SMP', 'WNI', '2234 Chelsie Wall Apt. 014\nNew Dariana, MA 86612', '00', '08', 'Dusun A', 'O', '1-770-410-0117', NULL, 'Istri', 'aktif', 'Qui et perferendis totam ut magnam esse cumque.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(9, NULL, '291102196984906', NULL, 'Dr. Gunner Wolf', 'Hesseltown', '1982-09-16', 'L', 'Buddha', 'Kawin', 'Roofer', 'S3', 'WNI', '33975 Schmitt Village Apt. 541\nEast Cadentown, DE 27992', '09', '05', 'Dusun C', 'A', '781.812.6408', NULL, 'Anak', 'aktif', 'Consectetur placeat reiciendis error ex quo omnis doloremque.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(10, NULL, '115985961886436', NULL, 'Rodger Weimann', 'New Erickaside', '2002-12-16', 'L', 'Hindu', 'Cerai Mati', 'Logging Supervisor', 'SMA', 'WNI', '728 Anjali Fields Suite 375\nNyasiaborough, WY 62812', '07', '08', 'Dusun B', 'AB', '808-549-9420', NULL, 'Famili Lain', 'aktif', 'Enim aut voluptatibus ullam fugiat consequuntur tenetur iusto.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(11, NULL, '923041827978650', NULL, 'Elinore Crona', 'Riceland', '2012-11-08', 'P', 'Hindu', 'Belum Kawin', 'Forming Machine Operator', 'S1', 'WNI', '8844 Boehm Manor\nWalkerstad, TX 79318-0189', '05', '04', 'Dusun B', 'A', '+1-317-817-4157', NULL, 'Famili Lain', 'aktif', 'Consequatur atque aperiam sunt magnam omnis nemo laborum.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(12, NULL, '778425778964205', NULL, 'Ernie Nienow', 'Lake Caden', '2014-09-22', 'P', 'Konghucu', 'Cerai Mati', 'Administrative Law Judge', 'SMP', 'WNI', '864 Zelda Walks\nSouth Tremaynebury, WV 80222-7255', '08', '02', 'Dusun B', 'O', '207-969-4571', NULL, 'Famili Lain', 'aktif', 'Ea quisquam iste vel dolorum in.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(13, NULL, '198375053962892', NULL, 'Mrs. Laurie Daugherty III', 'Lake Berniceton', '2004-11-03', 'L', 'Kristen', 'Cerai Hidup', 'Bookbinder', 'S1', 'WNI', '2169 Maureen Fort\nAustynside, NJ 81857', '06', '02', 'Dusun A', 'O', '(551) 342-6519', NULL, 'Famili Lain', 'aktif', 'Quam est dolorem dolores totam ipsam rerum neque.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(14, NULL, '887367367998520', NULL, 'Quincy Hane Jr.', 'South Roselyn', '2012-09-09', 'L', 'Hindu', 'Kawin', 'Fabric Mender', 'SD', 'WNI', '793 Lind Court\nLake Cheyenneberg, MT 36433', '00', '01', 'Dusun C', 'B', '+1.774.302.3081', NULL, 'Kepala Keluarga', 'aktif', 'Nihil consequuntur autem sed.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(15, NULL, '720520218035814', NULL, 'Reece Casper', 'East Maryjane', '2006-07-09', 'P', 'Kristen', 'Kawin', 'Calibration Technician OR Instrumentation Technician', 'S2', 'WNI', '17705 Bruen Burgs Apt. 465\nPort Geovanyfort, OR 43691', '07', '02', 'Dusun A', 'A', '336.588.5578', NULL, 'Famili Lain', 'aktif', 'Pariatur esse eum delectus placeat.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(16, NULL, '825587720398851', NULL, 'Ms. Bernadette Pouros Sr.', 'East Kyleeview', '1981-02-14', 'P', 'Buddha', 'Belum Kawin', 'Engine Assembler', 'S1', 'WNI', '13106 Calista Parkways\nHuelsmouth, MT 30964-8756', '09', '03', 'Dusun B', 'O', '1-301-951-2938', NULL, 'Famili Lain', 'aktif', 'Cum qui dolor magnam quo quod.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(17, NULL, '893471023981193', NULL, 'Alysa Moore Sr.', 'Lake Chase', '2014-06-21', 'L', 'Konghucu', 'Cerai Mati', 'Manufactured Building Installer', 'S1', 'WNI', '3553 Hills Land\nEbertmouth, CT 36425-8059', '08', '09', 'Dusun C', 'B', '+1-740-987-9937', NULL, 'Famili Lain', 'aktif', 'Dolorum delectus impedit quas saepe nihil nobis.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(18, NULL, '833275339093330', NULL, 'Noelia Christiansen', 'West Rosamondfurt', '1977-09-05', 'L', 'Buddha', 'Belum Kawin', 'Human Resources Manager', 'SMA', 'WNI', '242 Gonzalo Lights Suite 938\nNew Moniqueview, NY 73460', '08', '01', 'Dusun A', 'A', '517-586-1339', NULL, 'Istri', 'aktif', 'Aliquid facilis ipsa maiores placeat ut ut.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(19, NULL, '553409499902451', NULL, 'Prof. Buck Strosin MD', 'South Altheaton', '1985-09-24', 'L', 'Kristen', 'Cerai Hidup', 'Account Manager', 'S3', 'WNI', '28348 Carter Street Suite 672\nLake Maria, OH 26267-5806', '06', '08', 'Dusun A', 'AB', '+1-737-806-3827', NULL, 'Istri', 'aktif', 'Voluptatem repudiandae quidem atque architecto delectus.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(20, NULL, '858721912253741', NULL, 'Dominique Jast', 'Nataliaville', '2025-03-05', 'L', 'Hindu', 'Belum Kawin', 'Maintenance Supervisor', 'SMP', 'WNI', '37008 Tomas Ville Apt. 494\nJeraldton, SD 31996', '04', '04', 'Dusun C', 'B', '309.800.8536', NULL, 'Kepala Keluarga', 'aktif', 'Qui hic aut explicabo consequuntur quia dolores nemo.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(21, NULL, '067306301399965', NULL, 'Dr. Elmore Welch', 'Camilashire', '1992-08-07', 'P', 'Kristen', 'Cerai Mati', 'Locker Room Attendant', 'SMP', 'WNI', '98782 Macejkovic Islands Apt. 658\nMyrnatown, CA 97834', '02', '05', 'Dusun A', 'AB', '+14066840846', NULL, 'Famili Lain', 'aktif', 'Placeat doloribus excepturi ipsam.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(22, NULL, '733557186730309', NULL, 'Lori Kertzmann', 'South Jolie', '1975-01-12', 'P', 'Hindu', 'Belum Kawin', 'Waiter', 'SMP', 'WNI', '923 Grant Drive Suite 342\nCletusshire, AK 90512-9338', '08', '02', 'Dusun A', 'A', '828-743-3727', NULL, 'Istri', 'aktif', 'Voluptatibus tempora et similique tempora eius eveniet occaecati rem.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(23, NULL, '918951107870045', NULL, 'Dejon Aufderhar', 'Port Kariane', '1990-06-10', 'P', 'Kristen', 'Kawin', 'Outdoor Power Equipment Mechanic', 'SMP', 'WNI', '72968 Justen Roads\nEast Mikaylaton, WV 39662', '00', '06', 'Dusun C', 'O', '+12516501745', NULL, 'Kepala Keluarga', 'aktif', 'Saepe est sit et sint.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(24, NULL, '264605578262233', NULL, 'Rubye Thompson DVM', 'Harberhaven', '2013-07-05', 'L', 'Kristen', 'Belum Kawin', 'Organizational Development Manager', 'S1', 'WNI', '5992 Milford Hollow Suite 638\nNorth Nestorhaven, ND 13849-8951', '05', '02', 'Dusun B', 'AB', '231-721-7461', NULL, 'Istri', 'aktif', 'Similique non rerum autem natus et.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(25, NULL, '243009838133480', NULL, 'Keegan Torphy', 'North Ibrahimberg', '2012-10-08', 'L', 'Konghucu', 'Belum Kawin', 'Cement Mason and Concrete Finisher', 'SD', 'WNI', '23821 Franecki Harbor Apt. 374\nClareton, AR 33939-2723', '06', '00', 'Dusun B', 'O', '+1.949.222.0640', NULL, 'Kepala Keluarga', 'aktif', 'Et tempore aut sequi unde tenetur necessitatibus itaque.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(26, NULL, '639236048293092', NULL, 'Norbert Pagac', 'North Bernadetteborough', '1971-01-10', 'L', 'Konghucu', 'Kawin', 'Separating Machine Operators', 'SMA', 'WNI', '464 Adonis Hill Apt. 959\nLake Rylan, IN 17375', '03', '00', 'Dusun B', 'O', '(629) 991-1560', NULL, 'Famili Lain', 'aktif', 'Sit ut eaque aspernatur cum.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(27, NULL, '449865652241538', NULL, 'Milo Botsford', 'Lake Ola', '1991-09-17', 'L', 'Kristen', 'Cerai Hidup', 'Carpenter', 'S3', 'WNI', '5801 Louie Views Apt. 832\nLangworthborough, PA 73584-6647', '07', '09', 'Dusun C', 'O', '+1-912-913-9538', NULL, 'Famili Lain', 'aktif', 'Magni et qui explicabo harum ut.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(28, NULL, '140271783596195', NULL, 'Johnny O\'Reilly', 'Armandport', '1971-10-27', 'P', 'Konghucu', 'Cerai Hidup', 'Real Estate Appraiser', 'S3', 'WNI', '231 Phoebe Hollow Suite 744\nNorth Thelmashire, UT 56522', '03', '00', 'Dusun C', 'AB', '+1-409-951-5223', NULL, 'Famili Lain', 'aktif', 'Quia eius itaque tempora non aperiam ut eum labore.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(29, NULL, '291911420066384', NULL, 'Miss Lynn Shanahan DVM', 'Lake Monserrate', '1993-09-07', 'L', 'Konghucu', 'Kawin', 'Painter', 'S3', 'WNI', '991 Larissa Parkways\nEast Alexandreaville, CO 06148', '05', '04', 'Dusun B', 'AB', '+1.570.865.8219', NULL, 'Anak', 'aktif', 'Qui et cum molestiae dolore sunt.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(30, NULL, '186299164633234', NULL, 'Whitney Yost', 'Audrabury', '1995-05-21', 'L', 'Katolik', 'Cerai Mati', 'Health Specialties Teacher', 'S3', 'WNI', '482 Raynor Well\nSouth Raul, ME 96590', '01', '05', 'Dusun C', 'A', '817-744-2748', NULL, 'Istri', 'aktif', 'Autem harum quis quia omnis quia.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(31, NULL, '273995502568972', NULL, 'Jules Hamill', 'West Norris', '2007-11-25', 'P', 'Hindu', 'Cerai Hidup', 'Nuclear Technician', 'SD', 'WNI', '512 Zulauf Inlet\nKirlinstad, CA 05818-6206', '09', '03', 'Dusun C', 'O', '+1.276.848.5897', NULL, 'Kepala Keluarga', 'aktif', 'Quae delectus expedita in consequatur.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(32, NULL, '965403718572750', NULL, 'Dorcas Will Jr.', 'South Nikolas', '1970-11-20', 'P', 'Buddha', 'Cerai Mati', 'Captain', 'SMP', 'WNI', '55422 Callie Circles\nHomenickland, KY 94936-5670', '02', '08', 'Dusun B', 'AB', '901-282-3025', NULL, 'Famili Lain', 'aktif', 'Iure amet vitae quia doloremque facilis facere.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(33, NULL, '761975773254919', NULL, 'Alfredo Brekke I', 'West Timmothybury', '1992-07-08', 'P', 'Islam', 'Cerai Hidup', 'Team Assembler', 'S2', 'WNI', '789 Runte Valleys\nWest Shakiraborough, WV 23247', '07', '03', 'Dusun A', 'B', '731-931-7510', NULL, 'Istri', 'aktif', 'Enim aut delectus quos facere minima assumenda officia.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(34, NULL, '613915763229006', NULL, 'Freda Kuhlman', 'North Lew', '1998-09-29', 'P', 'Katolik', 'Cerai Hidup', 'Woodworking Machine Operator', 'SD', 'WNI', '328 Joy Mountains Suite 406\nPort Neva, NE 21073', '09', '01', 'Dusun B', 'AB', '765-527-9871', NULL, 'Anak', 'aktif', 'Odio iusto facere iusto et sit illum.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(35, NULL, '004734466805710', NULL, 'Prof. Jeromy Schowalter', 'New Willowville', '2014-02-04', 'L', 'Islam', 'Cerai Hidup', 'Mixing and Blending Machine Operator', 'SMA', 'WNI', '7686 Davis Shore\nLake Alvina, TX 24232-9248', '03', '06', 'Dusun B', 'A', '+1 (919) 765-3389', NULL, 'Famili Lain', 'aktif', 'Perspiciatis praesentium sint iure.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(36, NULL, '465216672373082', NULL, 'Heaven Schuster', 'Keeblerland', '2008-08-08', 'L', 'Konghucu', 'Kawin', 'Computer-Controlled Machine Tool Operator', 'S2', 'WNI', '8344 Destini River\nSouth Sedrickland, CA 58700-1041', '05', '01', 'Dusun C', 'O', '+16783490965', NULL, 'Anak', 'aktif', 'Quia veniam voluptate quis accusamus.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(37, NULL, '371787430143861', NULL, 'Eugenia Beer II', 'North Madgehaven', '1999-10-14', 'P', 'Katolik', 'Belum Kawin', 'Refinery Operator', 'SMA', 'WNI', '80200 Hickle Wall Suite 003\nHyattburgh, MI 28517', '06', '00', 'Dusun A', 'AB', '+14096086480', NULL, 'Kepala Keluarga', 'aktif', 'Voluptatum similique dolorum molestias blanditiis et ad perferendis repudiandae.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(38, NULL, '976190576661604', NULL, 'Mr. Dino Ernser', 'Bashirianside', '1992-07-10', 'P', 'Kristen', 'Kawin', 'Tool Sharpener', 'S1', 'WNI', '27823 Hilda Highway\nLake Alishaland, UT 73486-1658', '03', '05', 'Dusun A', 'O', '+1-920-963-6621', NULL, 'Istri', 'aktif', 'Rerum eos praesentium vel.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(39, NULL, '178605381995873', NULL, 'Gerhard D\'Amore', 'Lake Marcellemouth', '2005-10-12', 'L', 'Kristen', 'Cerai Hidup', 'Plant Scientist', 'S2', 'WNI', '826 Lind Manor\nErdmanbury, NJ 24108-9965', '08', '00', 'Dusun C', 'O', '+1-608-927-3013', NULL, 'Istri', 'aktif', 'Ullam quidem et laudantium dolores.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(40, NULL, '665240848022729', NULL, 'Ella Towne', 'Bayerland', '2010-05-18', 'L', 'Kristen', 'Cerai Mati', 'Architecture Teacher', 'SD', 'WNI', '424 Silas Mountains Suite 798\nErwinbury, MO 33574-3729', '05', '06', 'Dusun C', 'O', '1-802-802-7648', NULL, 'Kepala Keluarga', 'aktif', 'Itaque minus et sed.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(41, NULL, '671583394494108', NULL, 'Koby Kohler', 'Parisianberg', '2014-11-02', 'L', 'Katolik', 'Kawin', 'Clinical School Psychologist', 'S2', 'WNI', '1816 Modesto Brook\nFabiolafort, MS 60942', '09', '05', 'Dusun C', 'O', '754.439.4896', NULL, 'Istri', 'aktif', 'Iure dolorem reprehenderit quae dolores doloribus sunt.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(42, NULL, '256798591143216', NULL, 'Stella Gislason', 'Nicolasview', '2005-02-27', 'L', 'Konghucu', 'Cerai Mati', 'Conveyor Operator', 'SMA', 'WNI', '11707 Baumbach Parkway Apt. 656\nNorth Elodyborough, DE 62115', '06', '02', 'Dusun A', 'AB', '+1 (667) 473-5676', NULL, 'Famili Lain', 'aktif', 'Aut ut corporis eum laudantium dolorem incidunt aut.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(43, NULL, '767822226355895', NULL, 'Nicholas Beatty', 'North Reva', '2008-07-24', 'L', 'Konghucu', 'Kawin', 'Home Appliance Installer', 'S3', 'WNI', '2071 Liliane Crescent\nGrahamport, NC 14791-4009', '03', '06', 'Dusun B', 'A', '848-970-4976', NULL, 'Kepala Keluarga', 'aktif', 'Sit quia cum ea atque.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(44, NULL, '618992775706455', NULL, 'Vena Lind', 'Loisstad', '1975-05-17', 'L', 'Buddha', 'Kawin', 'Gas Pumping Station Operator', 'S3', 'WNI', '7413 Adams Hill Suite 406\nSchmidtville, IA 02007', '07', '09', 'Dusun C', 'AB', '(571) 777-7960', NULL, 'Famili Lain', 'aktif', 'Velit qui et voluptas in.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(45, NULL, '487724444271478', NULL, 'Cloyd Turcotte', 'Smithamburgh', '2001-08-16', 'L', 'Katolik', 'Cerai Mati', 'Marriage and Family Therapist', 'S1', 'WNI', '2584 Friesen Drive\nSouth Kayfurt, ID 85889', '06', '07', 'Dusun B', 'A', '1-832-207-1851', NULL, 'Anak', 'aktif', 'Ipsum est cum ad minima dicta esse.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(46, NULL, '359980533127084', NULL, 'Amiya Fritsch Sr.', 'Traviston', '2025-06-22', 'P', 'Katolik', 'Kawin', 'Optometrist', 'SMA', 'WNI', '398 Perry Heights Suite 985\nSouth Susie, HI 07313-9966', '01', '09', 'Dusun B', 'O', '+1.361.986.1921', NULL, 'Famili Lain', 'aktif', 'Atque blanditiis delectus excepturi aut quam nesciunt.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(47, NULL, '735834292784556', NULL, 'Ray Adams', 'Kuvalistown', '1986-12-19', 'P', 'Konghucu', 'Belum Kawin', 'Maintenance Supervisor', 'SMP', 'WNI', '2529 Goyette Stravenue\nLaneview, MS 94630-1493', '00', '04', 'Dusun B', 'O', '1-551-384-2485', NULL, 'Kepala Keluarga', 'aktif', 'Et facere officia dolorem eos non vitae eligendi.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(48, NULL, '599289829410488', NULL, 'Prof. Cara Dickens PhD', 'New Kyla', '1981-12-17', 'L', 'Buddha', 'Belum Kawin', 'Reservation Agent OR Transportation Ticket Agent', 'SD', 'WNI', '69001 Reva Streets Apt. 751\nMercedesport, RI 52753-9677', '05', '06', 'Dusun A', 'O', '(862) 600-7381', NULL, 'Istri', 'aktif', 'Accusamus velit eveniet voluptas eligendi est quos cum.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(49, NULL, '334537503782576', NULL, 'Bailee Baumbach', 'Lysanneborough', '1973-05-27', 'L', 'Hindu', 'Kawin', 'Landscaping', 'S1', 'WNI', '72789 Dustin Falls\nTannertown, KY 20857-3527', '06', '00', 'Dusun A', 'B', '+1-217-556-8247', NULL, 'Istri', 'aktif', 'Dolorem maiores totam occaecati natus quo vel facilis quis.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(50, NULL, '847173889615710', NULL, 'Mr. Sammie Beier Jr.', 'Dessiefurt', '1986-01-01', 'P', 'Kristen', 'Cerai Mati', 'Transit Police OR Railroad Police', 'SD', 'WNI', '254 Halvorson Mall\nPort Kayden, SC 08660', '09', '09', 'Dusun C', 'AB', '+1-480-465-1963', NULL, 'Anak', 'aktif', 'Dolore ex totam aliquid dolore non.', NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_tiket` varchar(20) NOT NULL,
  `penduduk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_pelapor` varchar(255) NOT NULL,
  `kontak_pelapor` varchar(255) DEFAULT NULL,
  `kategori` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` longtext NOT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `prioritas` enum('rendah','sedang','tinggi','urgent') NOT NULL DEFAULT 'sedang',
  `status` enum('baru','diterima','diproses','selesai','ditolak') NOT NULL DEFAULT 'baru',
  `balasan` longtext DEFAULT NULL,
  `handled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `responded_at` timestamp NULL DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `nomor_tiket`, `penduduk_id`, `nama_pelapor`, `kontak_pelapor`, `kategori`, `judul`, `isi`, `bukti`, `prioritas`, `status`, `balasan`, `handled_by`, `responded_at`, `resolved_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ADU-20260519-001', 40, 'Ella Towne', '1-802-802-7648', 'layanan', 'Contoh Keluhan 1', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'sedang', 'diproses', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(2, 'ADU-20260519-002', 42, 'Stella Gislason', '+1 (667) 473-5676', 'layanan', 'Contoh Keluhan 2', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'rendah', 'diproses', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(3, 'ADU-20260519-003', 36, 'Heaven Schuster', '+16783490965', 'infrastruktur', 'Contoh Keluhan 3', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'rendah', 'baru', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(4, 'ADU-20260519-004', 21, 'Dr. Elmore Welch', '+14066840846', 'infrastruktur', 'Contoh Keluhan 4', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'tinggi', 'diproses', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(5, 'ADU-20260519-005', 49, 'Bailee Baumbach', '+1-217-556-8247', 'infrastruktur', 'Contoh Keluhan 5', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'sedang', 'selesai', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(6, 'ADU-20260519-006', 34, 'Freda Kuhlman', '765-527-9871', 'Lainnya', 'Contoh Keluhan 6', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'tinggi', 'diproses', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(7, 'ADU-20260519-007', 26, 'Norbert Pagac', '(629) 991-1560', 'keamanan', 'Contoh Keluhan 7', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'rendah', 'baru', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(8, 'ADU-20260519-008', 24, 'Rubye Thompson DVM', '231-721-7461', 'Lainnya', 'Contoh Keluhan 8', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'tinggi', 'selesai', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(9, 'ADU-20260519-009', 34, 'Freda Kuhlman', '765-527-9871', 'layanan', 'Contoh Keluhan 9', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'sedang', 'selesai', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(10, 'ADU-20260519-010', 39, 'Gerhard D\'Amore', '+1-608-927-3013', 'Lainnya', 'Contoh Keluhan 10', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'sedang', 'selesai', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(11, 'ADU-20260519-011', 44, 'Vena Lind', '(571) 777-7960', 'Lainnya', 'Contoh Keluhan 11', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'rendah', 'diproses', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(12, 'ADU-20260519-012', 44, 'Vena Lind', '(571) 777-7960', 'layanan', 'Contoh Keluhan 12', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'sedang', 'selesai', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(13, 'ADU-20260519-013', 24, 'Rubye Thompson DVM', '231-721-7461', 'Lainnya', 'Contoh Keluhan 13', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'tinggi', 'diproses', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(14, 'ADU-20260519-014', 50, 'Mr. Sammie Beier Jr.', '+1-480-465-1963', 'Lainnya', 'Contoh Keluhan 14', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'tinggi', 'baru', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(15, 'ADU-20260519-015', 34, 'Freda Kuhlman', '765-527-9871', 'Lainnya', 'Contoh Keluhan 15', 'Ini adalah simulasi isi aduan kependudukan yang membutuhkan perhatian admin.', NULL, 'sedang', 'selesai', NULL, NULL, NULL, NULL, '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` longtext NOT NULL,
  `prioritas` enum('rendah','sedang','tinggi') NOT NULL DEFAULT 'sedang',
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(2, 'user.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(3, 'user.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(4, 'user.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(5, 'role.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(6, 'role.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(7, 'role.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(8, 'role.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(9, 'village.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(10, 'village.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(11, 'penduduk.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(12, 'penduduk.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(13, 'penduduk.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(14, 'penduduk.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(15, 'penduduk.import', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(16, 'penduduk.export', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(17, 'keluarga.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(18, 'keluarga.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(19, 'keluarga.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(20, 'keluarga.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(21, 'berita.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(22, 'berita.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(23, 'berita.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(24, 'berita.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(25, 'berita.publish', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(26, 'agenda.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(27, 'agenda.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(28, 'agenda.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(29, 'agenda.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(30, 'pengumuman.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(31, 'pengumuman.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(32, 'pengumuman.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(33, 'pengumuman.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(34, 'galeri.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(35, 'galeri.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(36, 'galeri.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(37, 'galeri.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(38, 'dokumen.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(39, 'dokumen.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(40, 'dokumen.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(41, 'dokumen.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(42, 'wisata.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(43, 'wisata.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(44, 'wisata.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(45, 'wisata.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(46, 'kontak.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(47, 'kontak.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(48, 'content.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(49, 'content.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(50, 'content.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(51, 'content.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(52, 'content.publish', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(53, 'surat.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(54, 'surat.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(55, 'surat.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(56, 'surat.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(57, 'surat.approve', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(58, 'surat.sign', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(59, 'jenis-surat.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(60, 'jenis-surat.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(61, 'jenis-surat.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(62, 'jenis-surat.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(63, 'pengaduan.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(64, 'pengaduan.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(65, 'pengaduan.process', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(66, 'pengaduan.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(67, 'antrian.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(68, 'antrian.manage', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(69, 'apbdes.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(70, 'apbdes.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(71, 'apbdes.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(72, 'apbdes.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(73, 'umkm.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(74, 'umkm.create', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(75, 'umkm.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(76, 'umkm.delete', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(77, 'umkm.verify', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(78, 'setting.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(79, 'setting.edit', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(80, 'log.view', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_consents`
--

CREATE TABLE `privacy_consents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `consent_type` varchar(50) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT 0,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2026-05-19 11:42:45', '2026-05-19 11:42:45'),
(2, 'admin', 'web', '2026-05-19 11:42:46', '2026-05-19 11:42:46'),
(3, 'kades', 'web', '2026-05-19 11:42:46', '2026-05-19 11:42:46'),
(4, 'operator', 'web', '2026-05-19 11:42:46', '2026-05-19 11:42:46'),
(5, 'warga', 'web', '2026-05-19 11:42:46', '2026-05-19 11:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(9, 3),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(12, 1),
(12, 2),
(12, 4),
(13, 1),
(13, 2),
(13, 4),
(14, 1),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(18, 1),
(18, 2),
(18, 4),
(19, 1),
(19, 2),
(19, 4),
(20, 1),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(48, 3),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(53, 3),
(53, 4),
(53, 5),
(54, 1),
(54, 2),
(54, 4),
(54, 5),
(55, 1),
(55, 2),
(55, 4),
(56, 1),
(57, 1),
(57, 2),
(57, 3),
(58, 1),
(58, 3),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(63, 3),
(63, 4),
(63, 5),
(64, 1),
(64, 5),
(65, 1),
(65, 2),
(65, 4),
(66, 1),
(67, 1),
(67, 2),
(67, 4),
(68, 1),
(68, 2),
(68, 4),
(69, 1),
(69, 2),
(69, 3),
(70, 1),
(70, 2),
(71, 1),
(71, 2),
(72, 1),
(73, 1),
(73, 2),
(73, 3),
(73, 5),
(74, 1),
(74, 5),
(75, 1),
(75, 5),
(76, 1),
(77, 1),
(77, 2),
(78, 1),
(78, 2),
(79, 1),
(80, 1),
(80, 2),
(80, 3);

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
('cCsdrfIvxk3KT0mKArL86Vi6QTI7kaECouGU4zcF', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZmo4TnFDSXZ0TTN1c0o3b3FnNGVPUTdYbmUxYXlhTHN4Q3FMeGxVOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjc6ImNhcHRjaGEiO2E6Mzp7czo5OiJzZW5zaXRpdmUiO2I6MDtzOjM6ImtleSI7czozMTI6ImV5SnBkaUk2SWtwTVZWbEVRMVJMTjBwcGFIWXhkbk5DWkhNeFZtYzlQU0lzSW5aaGJIVmxJam9pZFhGbWJrcG9ORWg2TTFCdk5sTnljRW94UlhKRE1VUnRWWFYzUlhoTlVHUXZhbWcxVmpjME9IcHBiM00xTDB4dVRXVjVXVWxpVTNaTFFrOUtUVTV2WTNGa01UaHZaMlk1VTJ4WVkyeE9RV1UxTlRWaWQxVnNTemszTVN0UE1GRjVPRlZGYjJWa1lsRjVSbmM5SWl3aWJXRmpJam9pWVRObVpUaGtPRE5oTURjMVlqSmhOVFl4T0RVMVpHUmxZalUzWlRBd1kySXpNV1EzTkRVeFltVTVZelppWVRVM01qYzVaVGN6WWpFME9EQTBZV1UwTUNJc0luUmhaeUk2SWlKOSI7czo3OiJlbmNyeXB0IjtiOjE7fX0=', 1779228712);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Desa Rambah Samo Barat', 'text', 'general', '2026-05-19 12:17:03', '2026-05-19 13:03:36'),
(2, 'site_description', 'Website Resmi Pemerintah Desa Rambah Samo Barat, Kabupaten Rokan Hulu.', 'textarea', 'general', '2026-05-19 12:17:03', '2026-05-19 13:03:36'),
(3, 'welcome_text', 'Selamat Datang di Portal Informasi Desa Rambah Samo Barat', 'text', 'general', '2026-05-19 12:17:03', '2026-05-19 13:03:36'),
(4, 'contact_address', 'Jl. Utama Desa Rambah Samo Barat, Kec. Rambah Samo, Kab. Rokan Hulu, Riau', 'textarea', 'contact', '2026-05-19 12:17:03', '2026-05-19 14:29:10'),
(5, 'contact_phone', '0812-3456-7890', 'text', 'contact', '2026-05-19 12:17:03', '2026-05-19 14:29:10'),
(6, 'contact_email', 'admin@rambahsamobarat.desa.id', 'text', 'contact', '2026-05-19 12:17:03', '2026-05-19 14:29:10'),
(7, 'social_facebook', 'https://facebook.com/desarambahsamobarat', 'text', 'social', '2026-05-19 12:17:03', '2026-05-19 14:29:10'),
(8, 'social_instagram', 'https://instagram.com/desarambahsamobarat', 'text', 'social', '2026-05-19 12:17:03', '2026-05-19 14:29:10'),
(9, 'social_twitter', 'https://twitter.com/desarambahsamobarat', 'text', 'social', '2026-05-19 12:17:03', '2026-05-19 14:29:10'),
(10, 'social_youtube', 'https://youtube.com/desarambahsamobarat', 'text', 'social', '2026-05-19 12:17:03', '2026-05-19 14:29:10'),
(11, 'theme_primary_color', '#1c68b0', 'color', 'theme', '2026-05-19 12:17:03', '2026-05-19 14:29:10'),
(12, 'theme_secondary_color', '#36b735', 'color', 'theme', '2026-05-19 12:17:03', '2026-05-19 14:28:30'),
(13, 'menu_public_profil', '1', 'boolean', 'menu', '2026-05-19 12:29:46', '2026-05-19 14:28:30'),
(14, 'menu_public_berita', '1', 'boolean', 'menu', '2026-05-19 12:29:46', '2026-05-19 14:28:30'),
(15, 'menu_public_surat', '0', 'boolean', 'menu', '2026-05-19 12:29:46', '2026-05-19 14:29:10'),
(16, 'menu_public_antrian', '0', 'boolean', 'menu', '2026-05-19 12:29:46', '2026-05-19 14:29:10'),
(17, 'menu_public_galeri', '1', 'boolean', 'menu', '2026-05-19 12:29:46', '2026-05-19 14:28:30'),
(18, 'menu_public_pengaduan', '1', 'boolean', 'menu', '2026-05-19 12:29:46', '2026-05-19 14:28:30'),
(19, 'sambutan_judul', 'Kata Sambutan Kepala Desa', 'text', 'general', '2026-05-19 14:16:49', '2026-05-19 14:28:30'),
(20, 'sambutan_isi', NULL, 'text', 'general', '2026-05-19 14:16:49', '2026-05-19 14:29:10'),
(21, 'sambutan_kutipan', NULL, 'text', 'general', '2026-05-19 14:16:49', '2026-05-19 14:29:10'),
(22, 'tentang_judul', 'Mengenal Desa Kami', 'text', 'general', '2026-05-19 14:16:49', '2026-05-19 14:28:30'),
(23, 'tentang_deskripsi', NULL, 'text', 'general', '2026-05-19 14:16:49', '2026-05-19 14:29:10'),
(24, 'tentang_keunggulan', 'Transparan, Mandiri, Inovatif', 'text', 'general', '2026-05-19 14:16:49', '2026-05-19 14:28:30'),
(25, 'copyright_text', '© 2026 Desa Rambah Samo Barat. All Rights Reserved.', 'text', 'general', '2026-05-19 14:16:49', '2026-05-19 14:28:30'),
(26, 'menu_public_anggaran', '0', 'text', 'general', '2026-05-19 14:16:49', '2026-05-19 14:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `jenis_surat_id` bigint(20) UNSIGNED NOT NULL,
  `penduduk_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `data_surat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data_surat`)),
  `keterangan` text DEFAULT NULL,
  `keperluan` text DEFAULT NULL,
  `status` enum('draft','diajukan','diproses','ditandatangani','selesai','ditolak','dibatalkan') NOT NULL DEFAULT 'draft',
  `alasan_penolakan` text DEFAULT NULL,
  `qr_token` varchar(64) DEFAULT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `hash_verifikasi` varchar(64) DEFAULT NULL,
  `ditandatangani_oleh` varchar(255) DEFAULT NULL,
  `ditandatangani_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `rejected_by` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_pengajuan` timestamp NULL DEFAULT NULL,
  `tanggal_disetujui` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `pemilik` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `nik` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `login_attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `locked_until` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `avatar`, `nik`, `alamat`, `login_attempts`, `locked_until`, `last_login_at`, `last_login_ip`, `is_active`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'admin@desarambahsamobarat.id', '2026-05-19 11:42:48', '$2y$12$DwsaOj2uwdBiRFeLV/zNcOuVJO3E5xBrpIp5JNW2rXphvcihUu.DC', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, '43yuAwLt7O', '2026-05-19 11:42:48', '2026-05-19 11:42:48', NULL),
(2, 'Admin Desa', 'operator@desarambahsamobarat.id', NULL, '$2y$12$K4BLRgUXH5UPYrUduYcCyes14ZzmFBEbrXtkR8qTGJUIIBSX0TnzO', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, '2026-05-19 11:52:40', '2026-05-19 11:52:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_desa` varchar(255) NOT NULL,
  `kode_desa` varchar(20) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `alamat_kantor` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `sejarah` text DEFAULT NULL,
  `struktur_organisasi` longtext DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `nama_kepala_desa` varchar(255) DEFAULT NULL,
  `nip_kepala_desa` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `nama_desa`, `kode_desa`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `alamat_kantor`, `telepon`, `email`, `website`, `visi`, `misi`, `sejarah`, `struktur_organisasi`, `logo`, `latitude`, `longitude`, `nama_kepala_desa`, `nip_kepala_desa`, `created_at`, `updated_at`) VALUES
(1, 'rambah samo barat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"nama\":null,\"jabatan\":\"Kepala Desa\",\"foto\":null},{\"nama\":null,\"jabatan\":\"Sekretaris Desa\",\"foto\":null},{\"nama\":null,\"jabatan\":\"Bendahara Desa\",\"foto\":null}]', 'storage/desa/logo_1779219460.png', NULL, NULL, NULL, NULL, '2026-05-19 12:14:00', '2026-05-19 14:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `harga_tiket` varchar(255) DEFAULT NULL,
  `jam_operasional` varchar(255) DEFAULT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_user_id_foreign` (`user_id`),
  ADD KEY `agenda_tanggal_mulai_index` (`tanggal_mulai`),
  ADD KEY `agenda_is_active_index` (`is_active`);

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `antrian_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `antrian_token_akses_unique` (`token_akses`),
  ADD KEY `antrian_penduduk_id_foreign` (`penduduk_id`),
  ADD KEY `antrian_called_by_foreign` (`called_by`),
  ADD KEY `antrian_tanggal_kunjungan_status_index` (`tanggal_kunjungan`,`status`),
  ADD KEY `antrian_nomor_antrian_index` (`nomor_antrian`);

--
-- Indexes for table `apbdes`
--
ALTER TABLE `apbdes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apbdes_user_id_foreign` (`user_id`),
  ADD KEY `apbdes_tahun_anggaran_index` (`tahun_anggaran`),
  ADD KEY `apbdes_jenis_index` (`jenis`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `berita_slug_unique` (`slug`),
  ADD KEY `berita_user_id_foreign` (`user_id`),
  ADD KEY `berita_category_id_foreign` (`category_id`),
  ADD KEY `berita_is_published_index` (`is_published`),
  ADD KEY `berita_is_featured_index` (`is_featured`),
  ADD KEY `berita_published_at_index` (`published_at`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_user_id_foreign` (`user_id`),
  ADD KEY `dokumen_kategori_index` (`kategori`),
  ADD KEY `dokumen_is_public_index` (`is_public`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galeri_user_id_foreign` (`user_id`),
  ADD KEY `galeri_tipe_index` (`tipe`),
  ADD KEY `galeri_kategori_index` (`kategori`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis_surat_kode_unique` (`kode`);

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
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keluarga_created_by_foreign` (`created_by`),
  ADD KEY `keluarga_updated_by_foreign` (`updated_by`),
  ADD KEY `keluarga_no_kk_hash_index` (`no_kk_hash`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kontak_replied_by_foreign` (`replied_by`),
  ADD KEY `kontak_is_read_index` (`is_read`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_logs_user_id_login_at_index` (`user_id`,`login_at`),
  ADD KEY `login_logs_ip_address_index` (`ip_address`);

--
-- Indexes for table `log_surat`
--
ALTER TABLE `log_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_surat_user_id_foreign` (`user_id`),
  ADD KEY `log_surat_surat_id_index` (`surat_id`),
  ADD KEY `log_surat_aksi_index` (`aksi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembangunans`
--
ALTER TABLE `pembangunans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penduduk_keluarga_id_foreign` (`keluarga_id`),
  ADD KEY `penduduk_created_by_foreign` (`created_by`),
  ADD KEY `penduduk_updated_by_foreign` (`updated_by`),
  ADD KEY `penduduk_nama_index` (`nama`),
  ADD KEY `penduduk_jenis_kelamin_index` (`jenis_kelamin`),
  ADD KEY `penduduk_status_index` (`status`),
  ADD KEY `penduduk_nik_hash_index` (`nik_hash`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengaduan_nomor_tiket_unique` (`nomor_tiket`),
  ADD KEY `pengaduan_penduduk_id_foreign` (`penduduk_id`),
  ADD KEY `pengaduan_handled_by_foreign` (`handled_by`),
  ADD KEY `pengaduan_status_index` (`status`),
  ADD KEY `pengaduan_prioritas_index` (`prioritas`),
  ADD KEY `pengaduan_kategori_index` (`kategori`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengumuman_user_id_foreign` (`user_id`),
  ADD KEY `pengumuman_prioritas_index` (`prioritas`),
  ADD KEY `pengumuman_is_active_index` (`is_active`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `privacy_consents`
--
ALTER TABLE `privacy_consents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `privacy_consents_user_id_consent_type_index` (`user_id`,`consent_type`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surat_nomor_surat_unique` (`nomor_surat`),
  ADD UNIQUE KEY `surat_qr_token_unique` (`qr_token`),
  ADD UNIQUE KEY `surat_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `surat_hash_verifikasi_unique` (`hash_verifikasi`),
  ADD KEY `surat_jenis_surat_id_foreign` (`jenis_surat_id`),
  ADD KEY `surat_penduduk_id_foreign` (`penduduk_id`),
  ADD KEY `surat_user_id_foreign` (`user_id`),
  ADD KEY `surat_status_index` (`status`),
  ADD KEY `surat_created_at_index` (`created_at`),
  ADD KEY `surat_approved_by_foreign` (`approved_by`),
  ADD KEY `surat_rejected_by_foreign` (`rejected_by`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `umkm_user_id_foreign` (`user_id`),
  ADD KEY `umkm_kategori_index` (`kategori`),
  ADD KEY `umkm_is_active_index` (`is_active`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wisata_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `wisata_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `apbdes`
--
ALTER TABLE `apbdes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_surat`
--
ALTER TABLE `log_surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pembangunans`
--
ALTER TABLE `pembangunans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `privacy_consents`
--
ALTER TABLE `privacy_consents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_called_by_foreign` FOREIGN KEY (`called_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `antrian_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `apbdes`
--
ALTER TABLE `apbdes`
  ADD CONSTRAINT `apbdes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `berita_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `galeri_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD CONSTRAINT `keluarga_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `keluarga_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `kontak`
--
ALTER TABLE `kontak`
  ADD CONSTRAINT `kontak_replied_by_foreign` FOREIGN KEY (`replied_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_surat`
--
ALTER TABLE `log_surat`
  ADD CONSTRAINT `log_surat_surat_id_foreign` FOREIGN KEY (`surat_id`) REFERENCES `surat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_surat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `penduduk_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluarga` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `penduduk_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_handled_by_foreign` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengaduan_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `privacy_consents`
--
ALTER TABLE `privacy_consents`
  ADD CONSTRAINT `privacy_consents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_jenis_surat_id_foreign` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_rejected_by_foreign` FOREIGN KEY (`rejected_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `surat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `umkm`
--
ALTER TABLE `umkm`
  ADD CONSTRAINT `umkm_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
