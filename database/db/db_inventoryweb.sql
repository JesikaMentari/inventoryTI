-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 29, 2024 at 09:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventoryweb`
--

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
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_10_31_061811_create_menu_table', 1),
(4, '2022_11_01_041110_create_table_role', 1),
(5, '2022_11_01_083314_create_table_user', 1),
(6, '2022_11_03_023905_create_table_submenu', 1),
(7, '2022_11_03_064417_create_tbl_akses', 1),
(8, '2022_11_08_024215_create_tbl_web', 1),
(9, '2022_11_15_131148_create_tbl_jenisbarang', 2),
(10, '2022_11_15_173700_create_tbl_satuan', 3),
(11, '2022_11_15_180434_create_tbl_lokasi', 4),
(12, '2022_11_16_120018_create_tbl_appreance', 5),
(13, '2022_11_25_141731_create_tbl_barang', 6),
(14, '2022_11_26_011349_create_tbl_unit', 7),
(16, '2022_11_28_151108_create_tbl_barangmasuk', 8),
(17, '2022_11_30_115904_create_tbl_barangkeluar', 9);

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
-- Table structure for table `tbl_akses`
--

CREATE TABLE `tbl_akses` (
  `akses_id` int(10) UNSIGNED NOT NULL,
  `menu_id` varchar(255) DEFAULT NULL,
  `submenu_id` varchar(255) DEFAULT NULL,
  `othermenu_id` varchar(255) DEFAULT NULL,
  `role_id` varchar(255) NOT NULL,
  `akses_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_akses`
--

INSERT INTO `tbl_akses` (`akses_id`, `menu_id`, `submenu_id`, `othermenu_id`, `role_id`, `akses_type`, `created_at`, `updated_at`) VALUES
(568, '1668510568', NULL, NULL, '3', 'view', '2024-07-17 05:40:12', '2024-07-17 05:40:12'),
(652, '1667444041', NULL, NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(653, '1667444041', NULL, NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(654, '1667444041', NULL, NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(655, '1667444041', NULL, NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(656, '1668509889', NULL, NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(657, '1668509889', NULL, NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(658, '1668509889', NULL, NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(659, '1668509889', NULL, NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(660, '1668510437', NULL, NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(661, '1668510437', NULL, NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(662, '1668510437', NULL, NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(663, '1668510437', NULL, NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(664, '1669390641', NULL, NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(665, '1669390641', NULL, NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(666, '1669390641', NULL, NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(667, '1669390641', NULL, NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(668, '1668510568', NULL, NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(669, '1668510568', NULL, NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(670, '1668510568', NULL, NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(671, '1668510568', NULL, NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(676, NULL, '9', NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(677, NULL, '9', NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(678, NULL, '9', NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(679, NULL, '9', NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(680, NULL, '17', NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(681, NULL, '17', NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(682, NULL, '17', NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(683, NULL, '17', NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(684, NULL, '21', NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(685, NULL, '21', NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(686, NULL, '21', NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(687, NULL, '21', NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(688, NULL, '10', NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(689, NULL, '10', NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(690, NULL, '10', NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(691, NULL, '10', NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(692, NULL, '18', NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(693, NULL, '18', NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(694, NULL, '18', NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(695, NULL, '18', NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(696, NULL, '22', NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(697, NULL, '22', NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(698, NULL, '22', NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(699, NULL, '22', NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(700, NULL, '19', NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(701, NULL, '19', NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(702, NULL, '19', NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(703, NULL, '19', NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(704, NULL, '23', NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(705, NULL, '23', NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(706, NULL, '23', NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(707, NULL, '23', NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(708, NULL, '20', NULL, '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(709, NULL, '20', NULL, '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(710, NULL, '20', NULL, '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(711, NULL, '20', NULL, '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(712, NULL, NULL, '1', '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(713, NULL, NULL, '2', '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(714, NULL, NULL, '3', '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(715, NULL, NULL, '4', '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(716, NULL, NULL, '5', '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(717, NULL, NULL, '6', '1', 'view', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(718, NULL, NULL, '1', '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(719, NULL, NULL, '2', '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(720, NULL, NULL, '3', '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(721, NULL, NULL, '4', '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(722, NULL, NULL, '5', '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(723, NULL, NULL, '6', '1', 'create', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(724, NULL, NULL, '1', '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(725, NULL, NULL, '2', '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(726, NULL, NULL, '3', '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(727, NULL, NULL, '4', '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(728, NULL, NULL, '5', '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(729, NULL, NULL, '6', '1', 'update', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(730, NULL, NULL, '1', '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(731, NULL, NULL, '2', '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(732, NULL, NULL, '3', '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(733, NULL, NULL, '4', '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(734, NULL, NULL, '5', '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52'),
(735, NULL, NULL, '6', '1', 'delete', '2024-07-22 18:50:52', '2024-07-22 18:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appreance`
--

CREATE TABLE `tbl_appreance` (
  `appreance_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `appreance_layout` varchar(255) DEFAULT NULL,
  `appreance_theme` varchar(255) DEFAULT NULL,
  `appreance_menu` varchar(255) DEFAULT NULL,
  `appreance_header` varchar(255) DEFAULT NULL,
  `appreance_sidestyle` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_appreance`
--

INSERT INTO `tbl_appreance` (`appreance_id`, `user_id`, `appreance_layout`, `appreance_theme`, `appreance_menu`, `appreance_header`, `appreance_sidestyle`, `created_at`, `updated_at`) VALUES
(2, '1', 'sidebar-mini', 'light-mode', 'light-menu', 'header-light', 'default-menu', '2024-06-13 02:39:02', '2024-06-13 02:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `barang_id` int(255) NOT NULL,
  `jenisbarang_id` varchar(255) DEFAULT NULL,
  `satuan_id` varchar(255) DEFAULT NULL,
  `lokasi_id` varchar(255) DEFAULT NULL,
  `barang_kode` varchar(255) NOT NULL,
  `barang_nama` varchar(255) NOT NULL,
  `barang_slug` varchar(255) DEFAULT NULL,
  `barang_jumlah` varchar(255) NOT NULL,
  `barang_stok` varchar(255) NOT NULL,
  `barang_gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`barang_id`, `jenisbarang_id`, `satuan_id`, `lokasi_id`, `barang_kode`, `barang_nama`, `barang_slug`, `barang_jumlah`, `barang_stok`, `barang_gambar`, `created_at`, `updated_at`) VALUES
(7, '12', '5', '2', 'BRG-1721217257018', 'Printer', 'printer', '33', '0', 'hE5SiWE4hFGk8wzjv1aEVOxxDf0LUpgf75KkLYTA.jpg', '2024-07-17 04:54:40', '2024-07-17 04:54:40'),
(8, '11', '7', '7', 'BRG-1721273721761', 'Hp Samsung', 'hp-samsung', '6', '23', 'icoNiwTHktrxzZal15OAofeYtJV4PJ4eYPYyuzwW.jpg', '2024-07-17 20:35:43', '2024-07-17 20:37:21'),
(9, '11', '7', '2', 'BRG-1721288827193', 'Printer Mini', 'printer-mini', '30', '30', 'image.png', '2024-07-18 00:47:45', '2024-07-18 00:49:23'),
(10, '12', '5', '1', 'BRG-1721288884873', 'Laptop Asus', 'laptop-asus', '1', '0', 'image.png', '2024-07-18 00:48:31', '2024-07-18 00:48:31'),
(11, '12', '5', '1', 'BRG-1721291560972', 'Laptop HP', 'laptop-hp', '1', '0', 'image.png', '2024-07-18 01:32:54', '2024-07-18 01:32:54'),
(13, '11', '7', '2', 'BRG-1721792031094', 'Hp', 'hp', '2', '0', 'image.png', '2024-07-23 20:34:03', '2024-07-23 20:34:03'),
(14, '13', '5', '7', 'BRG-1721805262779', 'Hp', 'hp', '344', '0', 'RZGrBv9CyBjyQyzP51McYhAs9q9bcnkFJ2rPDb3L.jpg', '2024-07-24 00:14:51', '2024-07-25 18:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barangkeluar`
--

CREATE TABLE `tbl_barangkeluar` (
  `bk_id` int(10) UNSIGNED NOT NULL,
  `bk_kode` varchar(255) NOT NULL,
  `barang_kode` varchar(255) NOT NULL,
  `bk_tanggal` varchar(255) NOT NULL,
  `bk_tujuan` varchar(255) DEFAULT NULL,
  `bk_jumlah` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_barangkeluar`
--

INSERT INTO `tbl_barangkeluar` (`bk_id`, `bk_kode`, `barang_kode`, `bk_tanggal`, `bk_tujuan`, `bk_jumlah`, `created_at`, `updated_at`) VALUES
(2, 'BK-1669811950758', 'BRG-1669390220236', '2024-06-30', 'Gudang Rapat', '20', '2024-06-18 01:39:22', '2024-06-18 01:39:22'),
(3, 'BK-1669812439198', 'BRG-1721217257018', '2024-06-28', 'Gudang Venue', '5', '2024-06-18 02:39:02', '2024-06-18 02:39:02'),
(4, 'BK-1721289016909', 'BRG-1721288827193', '2024-07-18', 'Kerani kebun', '25', '2024-07-18 00:50:41', '2024-07-18 00:50:41'),
(5, 'BK-1721359291044', 'BRG-1721359204719', '2024-07-19', 'SDM', '1', '2024-07-18 20:21:48', '2024-07-18 20:21:48'),
(6, 'BK-1722238980168', 'BRG-1722238904383', '2024-07-26', 'trdst', '3', '2024-07-29 00:43:14', '2024-07-29 00:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barangmasuk`
--

CREATE TABLE `tbl_barangmasuk` (
  `bm_id` int(10) UNSIGNED NOT NULL,
  `bm_kode` varchar(255) NOT NULL,
  `barang_kode` varchar(255) NOT NULL,
  `unit_id` varchar(255) NOT NULL,
  `bm_tanggal` varchar(255) NOT NULL,
  `bm_jumlah` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_barangmasuk`
--

INSERT INTO `tbl_barangmasuk` (`bm_id`, `bm_kode`, `barang_kode`, `unit_id`, `bm_tanggal`, `bm_jumlah`, `created_at`, `updated_at`) VALUES
(1, 'BM-1669730554623', 'BRG-1669390220236', '2', '2024-06-26', '50', '2024-06-18 02:39:02', '2024-06-18 02:39:02'),
(2, 'BM-1669731639801', 'BRG-1721217257018', '2', '2024-06-20', '10', '2024-06-18 02:39:02', '2024-07-18 01:33:15'),
(3, 'BM-1721217289601', 'BRG-1721217257018', '2', '2024-07-11', '46', '2024-07-17 04:55:18', '2024-07-17 04:55:18'),
(4, 'BM-1721267832524', 'BRG-1721217257018', '2', '2024-07-17', '20', '2024-07-17 18:57:31', '2024-07-17 18:57:31'),
(5, 'BM-1721288982176', 'BRG-1721288827193', '2', '2024-07-18', '30', '2024-07-18 00:50:03', '2024-07-18 00:50:03'),
(6, 'BM-1721291599121', 'BRG-1721273721761', '2', '2024-07-15', '1', '2024-07-18 01:33:33', '2024-07-18 01:33:33'),
(7, 'BM-1721359267187', 'BRG-1721359204719', '2', '2024-07-19', '1', '2024-07-18 20:21:21', '2024-07-18 20:21:21'),
(8, 'BM-1721879111479', 'BRG-1721805262779', '2', '2024-07-24', '3', '2024-07-24 20:45:30', '2024-07-24 20:45:30'),
(9, 'BM-1721880049811', 'BRG-1721792031094', '4', '2024-07-18', '2', '2024-07-24 21:01:05', '2024-07-24 21:01:05'),
(10, 'BM-1721958698333', 'BRG-1721958641990', '2', '2024-07-10', '12', '2024-07-25 18:52:06', '2024-07-25 18:52:06'),
(13, 'BM-1722238939629', 'BRG-1722238904383', '2', '2024-07-24', '6', '2024-07-29 00:42:38', '2024-07-29 00:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenisbarang`
--

CREATE TABLE `tbl_jenisbarang` (
  `jenisbarang_id` int(255) UNSIGNED NOT NULL,
  `jenisbarang_nama` varchar(255) NOT NULL,
  `jenisbarang_slug` varchar(255) NOT NULL,
  `jenisbarang_ket` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_jenisbarang`
--

INSERT INTO `tbl_jenisbarang` (`jenisbarang_id`, `jenisbarang_nama`, `jenisbarang_slug`, `jenisbarang_ket`, `created_at`, `updated_at`) VALUES
(11, 'Elektronik', 'elektronik', NULL, '2024-06-24 08:24:18', '2024-06-24 08:24:18'),
(12, 'Perangkat Komputer', 'perangkat-komputer', NULL, '2024-06-24 08:24:18', '2024-06-24 08:24:18'),
(13, 'Hardware', 'hardware', NULL, '2024-06-24 08:24:18', '2024-06-24 08:24:18'),
(14, 'lain-lainnya', 'lain-lainnya', NULL, '2024-07-22 03:18:43', '2024-07-25 00:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lokasi`
--

CREATE TABLE `tbl_lokasi` (
  `lokasi_id` int(10) UNSIGNED NOT NULL,
  `lokasi_nama` varchar(255) NOT NULL,
  `lokasi_slug` varchar(255) NOT NULL,
  `lokasi_keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`lokasi_id`, `lokasi_nama`, `lokasi_slug`, `lokasi_keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Gudang Rapat', 'gudang rapat', NULL, '2024-06-18 02:39:02', '2024-06-18 02:39:02'),
(2, 'Gudang Melati', 'gudang melati', NULL, '2024-06-18 02:39:02', '2024-06-18 02:39:02'),
(7, 'Gudang Venue', 'gudang venue', NULL, '2024-06-18 02:39:02', '2024-06-18 02:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `menu_judul` varchar(255) NOT NULL,
  `menu_slug` varchar(255) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `menu_redirect` varchar(255) NOT NULL,
  `menu_sort` varchar(255) NOT NULL,
  `menu_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `menu_judul`, `menu_slug`, `menu_icon`, `menu_redirect`, `menu_sort`, `menu_type`, `created_at`, `updated_at`) VALUES
(1667444041, 'Dashboard', 'dashboard', 'home', '/dashboard', '1', '1', '2024-06-17 03:51:04', '2024-07-22 20:49:54'),
(1668509889, 'Request Barang', 'request-barang', 'package', '-', '2', '2', '2024-06-17 03:58:09', '2024-07-22 20:49:54'),
(1668510437, 'Transaksi', 'transaksi', 'repeat', '-', '3', '2', '2024-06-17 04:07:17', '2024-07-22 20:49:54'),
(1668510568, 'Berita Acara', 'berita acara', 'printer', '-', '5', '2', '2024-06-17 06:09:28', '2024-07-22 20:49:54'),
(1669390641, 'Karyawan TI', 'unit-ti', 'user', '/unit', '4', '1', '2024-06-17 08:37:21', '2024-07-22 20:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requestberitaacara`
--

CREATE TABLE `tbl_requestberitaacara` (
  `Tanggal` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_title` varchar(255) NOT NULL,
  `role_slug` varchar(255) NOT NULL,
  `role_desc` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_title`, `role_slug`, `role_desc`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', '-', '2024-06-13 02:39:02', '2024-06-13 02:39:02'),
(3, 'Operator', 'operator', '-', '2024-06-13 02:39:02', '2024-06-13 02:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `satuan_id` int(10) UNSIGNED NOT NULL,
  `satuan_nama` varchar(255) NOT NULL,
  `satuan_slug` varchar(255) NOT NULL,
  `satuan_keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`satuan_id`, `satuan_nama`, `satuan_slug`, `satuan_keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Kg', 'kg', NULL, '2024-06-17 02:50:38', '2024-06-17 02:50:38'),
(5, 'Pcs', 'pcs', NULL, '2024-06-17 02:39:15', '2024-06-17 02:39:15'),
(7, 'Box', 'box', NULL, '2024-06-17 05:39:59', '2024-06-17 05:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submenu`
--

CREATE TABLE `tbl_submenu` (
  `submenu_id` int(10) UNSIGNED NOT NULL,
  `menu_id` varchar(255) NOT NULL,
  `submenu_judul` varchar(255) NOT NULL,
  `submenu_slug` varchar(255) NOT NULL,
  `submenu_redirect` varchar(255) NOT NULL,
  `submenu_sort` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_submenu`
--

INSERT INTO `tbl_submenu` (`submenu_id`, `menu_id`, `submenu_judul`, `submenu_slug`, `submenu_redirect`, `submenu_sort`, `created_at`, `updated_at`) VALUES
(9, '1668510437', 'Barang Masuk', 'barang-masuk', '/barang-masuk', '1', '2024-06-13 04:08:19', '2024-06-13 04:08:19'),
(10, '1668510437', 'Barang Keluar', 'barang-keluar', '/barang-keluar', '2', '2024-06-13 04:08:19', '2024-06-13 04:08:19'),
(17, '1668509889', 'Jenis', 'jenis', '/jenisbarang', '1', '2024-06-13 05:06:48', '2024-06-13 05:06:48'),
(18, '1668509889', 'Satuan', 'satuan', '/satuan', '2', '2024-06-14 05:06:48', '2024-06-14 05:06:48'),
(19, '1668509889', 'Lokasi', 'lokasi', '/lokasi', '3', '2024-06-14 05:06:48', '2024-06-14 05:06:48'),
(20, '1668509889', 'Barang', 'barang', '/barang', '4', '2024-06-14 07:12:03', '2024-06-14 07:12:03'),
(21, '1668510568', 'Lap Barang Masuk', 'lap-barang-masuk', '/lap-barang-masuk', '1', '2024-06-14 07:12:54', '2024-06-14 07:13:05'),
(22, '1668510568', 'Request Berita Acara', 'request-berita-acara', '/request-berita-acara', '2', '2024-06-14 08:12:03', '2024-06-14 08:12:03'),
(23, '1668510568', 'Lap Stok Barang', 'lap-stok-barang', '/lap-stok-barang', '3', '2024-06-14 08:12:03', '2024-06-14 08:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `unit_id` int(10) UNSIGNED NOT NULL,
  `unit_nama` varchar(255) NOT NULL,
  `unit_slug` varchar(255) NOT NULL,
  `unit_alamat` text DEFAULT NULL,
  `unit_notelp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`unit_id`, `unit_nama`, `unit_slug`, `unit_alamat`, `unit_notelp`, `created_at`, `updated_at`) VALUES
(2, 'Satria', 'satria', 'Riau', '0812345678', '2024-06-18 08:39:02', '2024-06-18 08:39:02'),
(4, 'Elni', 'elni', 'Riau', '0821345678', '2024-07-22 03:15:35', '2024-07-22 03:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `user_nmlengkap` varchar(255) NOT NULL,
  `user_nama` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_foto` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `role_id`, `user_nmlengkap`, `user_nama`, `user_email`, `user_foto`, `user_password`, `created_at`, `updated_at`) VALUES
(1, '1', 'Administrator', 'administrator', 'superadmin@gmail.com', '4Xj3kCeoZnZk2Gwsk2r3qPO3uWMzN1da5C2BnU8s.png', '25d55ad283aa400af464c76d713c07ad', '2024-06-13 02:39:02', '2024-07-25 18:21:34'),
(3, '3', 'Operator', 'operator', 'operator@gmail.com', 'undraw_profile.svg', '25d55ad283aa400af464c76d713c07ad', '2024-06-13 02:39:02', '2024-06-13 02:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_web`
--

CREATE TABLE `tbl_web` (
  `web_id` int(10) UNSIGNED NOT NULL,
  `web_nama` varchar(255) NOT NULL,
  `web_logo` varchar(255) NOT NULL,
  `web_deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_web`
--

INSERT INTO `tbl_web` (`web_id`, `web_nama`, `web_logo`, `web_deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Inventory-TI', 'default.png', 'Mengelola Data Barang Masuk & Barang Keluar Serta Request Berita Acara', '2024-06-13 02:39:02', '2024-07-22 18:50:15');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_akses`
--
ALTER TABLE `tbl_akses`
  ADD PRIMARY KEY (`akses_id`);

--
-- Indexes for table `tbl_appreance`
--
ALTER TABLE `tbl_appreance`
  ADD PRIMARY KEY (`appreance_id`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`barang_id`,`barang_kode`,`barang_nama`,`barang_jumlah`,`barang_stok`);

--
-- Indexes for table `tbl_barangkeluar`
--
ALTER TABLE `tbl_barangkeluar`
  ADD PRIMARY KEY (`bk_id`);

--
-- Indexes for table `tbl_barangmasuk`
--
ALTER TABLE `tbl_barangmasuk`
  ADD PRIMARY KEY (`bm_id`);

--
-- Indexes for table `tbl_jenisbarang`
--
ALTER TABLE `tbl_jenisbarang`
  ADD PRIMARY KEY (`jenisbarang_id`);

--
-- Indexes for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  ADD PRIMARY KEY (`lokasi_id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  ADD PRIMARY KEY (`submenu_id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_web`
--
ALTER TABLE `tbl_web`
  ADD PRIMARY KEY (`web_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_akses`
--
ALTER TABLE `tbl_akses`
  MODIFY `akses_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=736;

--
-- AUTO_INCREMENT for table `tbl_appreance`
--
ALTER TABLE `tbl_appreance`
  MODIFY `appreance_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `barang_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_barangkeluar`
--
ALTER TABLE `tbl_barangkeluar`
  MODIFY `bk_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_barangmasuk`
--
ALTER TABLE `tbl_barangmasuk`
  MODIFY `bm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_jenisbarang`
--
ALTER TABLE `tbl_jenisbarang`
  MODIFY `jenisbarang_id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `lokasi_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1721699344;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `satuan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  MODIFY `submenu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_web`
--
ALTER TABLE `tbl_web`
  MODIFY `web_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
