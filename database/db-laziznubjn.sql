-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2026 at 06:54 AM
-- Server version: 8.0.45-0ubuntu0.24.04.1
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-laziznubjn`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-boost:mcp:database-schema:mysql::0:0:0', 'a:2:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:31:{s:5:\"cache\";a:5:{s:7:\"columns\";a:3:{s:3:\"key\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"value\";a:1:{s:4:\"type\";s:10:\"mediumtext\";}s:10:\"expiration\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:2:{s:22:\"cache_expiration_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"expiration\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"cache_locks\";a:5:{s:7:\"columns\";a:3:{s:3:\"key\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"owner\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"expiration\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:2:{s:28:\"cache_locks_expiration_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"expiration\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"categories\";a:5:{s:7:\"columns\";a:5:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"name\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:4:\"slug\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:22:\"categories_slug_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"desas\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:12:\"kecamatan_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"deleted_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:30:\"desas_kecamatan_id_nama_unique\";a:4:{s:7:\"columns\";a:2:{i:0;s:12:\"kecamatan_id\";i:1;s:4:\"nama\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:26:\"desas_kecamatan_id_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:10:\"kecamatans\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"dokumens\";a:5:{s:7:\"columns\";a:8:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:12:\"nama_dokumen\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:9:\"deskripsi\";a:1:{s:4:\"type\";s:4:\"text\";}s:4:\"file\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:11:\"ukuran_file\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:15:\"jumlah_download\";a:1:{s:4:\"type\";s:12:\"int unsigned\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"failed_jobs\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"uuid\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"connection\";a:1:{s:4:\"type\";s:4:\"text\";}s:5:\"queue\";a:1:{s:4:\"type\";s:4:\"text\";}s:7:\"payload\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:9:\"exception\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:9:\"failed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:23:\"failed_jobs_uuid_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"uuid\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"job_batches\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:4:\"name\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"total_jobs\";a:1:{s:4:\"type\";s:3:\"int\";}s:12:\"pending_jobs\";a:1:{s:4:\"type\";s:3:\"int\";}s:11:\"failed_jobs\";a:1:{s:4:\"type\";s:3:\"int\";}s:14:\"failed_job_ids\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:7:\"options\";a:1:{s:4:\"type\";s:10:\"mediumtext\";}s:12:\"cancelled_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:3:\"int\";}s:11:\"finished_at\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:4:\"jobs\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:5:\"queue\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:7:\"payload\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:8:\"attempts\";a:1:{s:4:\"type\";s:16:\"tinyint unsigned\";}s:11:\"reserved_at\";a:1:{s:4:\"type\";s:12:\"int unsigned\";}s:12:\"available_at\";a:1:{s:4:\"type\";s:12:\"int unsigned\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:12:\"int unsigned\";}}s:7:\"indexes\";a:2:{s:16:\"jobs_queue_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"queue\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"kecamatans\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:8:\"latitude\";a:1:{s:4:\"type\";s:13:\"decimal(10,8)\";}s:9:\"longitude\";a:1:{s:4:\"type\";s:13:\"decimal(11,8)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"deleted_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:22:\"kecamatans_nama_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"nama\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:16:\"laporan_bulanans\";a:5:{s:7:\"columns\";a:5:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:12:\"nama_laporan\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:12:\"file_laporan\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:12:\"laporan_mwcs\";a:5:{s:7:\"columns\";a:5:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:12:\"file_laporan\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:16:\"laporan_tahunans\";a:5:{s:7:\"columns\";a:5:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:9:\"link_from\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"migrations\";a:5:{s:7:\"columns\";a:3:{s:2:\"id\";a:1:{s:4:\"type\";s:12:\"int unsigned\";}s:9:\"migration\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"batch\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"missions\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:10:\"profile_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"text\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:6:\"urutan\";a:1:{s:4:\"type\";s:3:\"int\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:27:\"missions_profile_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"profile_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:27:\"missions_profile_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"profile_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:8:\"profiles\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:9:\"mustahiks\";a:5:{s:7:\"columns\";a:11:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:3:\"nik\";a:1:{s:4:\"type\";s:11:\"varchar(20)\";}s:13:\"jenis_kelamin\";a:1:{s:4:\"type\";s:29:\"enum(\'laki-laki\',\'perempuan\')\";}s:12:\"kecamatan_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:7:\"desa_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:5:\"no_hp\";a:1:{s:4:\"type\";s:11:\"varchar(15)\";}s:14:\"kategori_asnaf\";a:1:{s:4:\"type\";s:84:\"enum(\'fakir\',\'miskin\',\'amil\',\'muallaf\',\'riqab\',\'gharim\',\'fisabilillah\',\'ibnu_sabil\')\";}s:6:\"status\";a:1:{s:4:\"type\";s:24:\"enum(\'aktif\',\'nonaktif\')\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:4:{s:25:\"mustahiks_desa_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"desa_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:30:\"mustahiks_kecamatan_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:20:\"mustahiks_nik_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"nik\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:2:{i:0;a:7:{s:4:\"name\";s:25:\"mustahiks_desa_id_foreign\";s:7:\"columns\";a:1:{i:0;s:7:\"desa_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:5:\"desas\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}i:1;a:7:{s:4:\"name\";s:30:\"mustahiks_kecamatan_id_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:10:\"kecamatans\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:4:\"news\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:5:\"title\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:4:\"slug\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:11:\"category_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:14:\"featured_image\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:7:\"content\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:7:\"excerpt\";a:1:{s:4:\"type\";s:4:\"text\";}s:12:\"published_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:3:{s:24:\"news_category_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:11:\"category_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:16:\"news_slug_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:24:\"news_category_id_foreign\";s:7:\"columns\";a:1:{i:0;s:11:\"category_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:10:\"categories\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"password_reset_tokens\";a:5:{s:7:\"columns\";a:3:{s:5:\"email\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"token\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"payment_confirmations\";a:5:{s:7:\"columns\";a:11:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:14:\"transaction_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:13:\"nama_pengirim\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:13:\"bank_pengirim\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:23:\"nomor_rekening_pengirim\";a:1:{s:4:\"type\";s:11:\"varchar(30)\";}s:15:\"jumlah_transfer\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:16:\"tanggal_transfer\";a:1:{s:4:\"type\";s:4:\"date\";}s:14:\"bukti_transfer\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:7:\"catatan\";a:1:{s:4:\"type\";s:4:\"text\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:42:\"payment_confirmations_transaction_id_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"transaction_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:44:\"payment_confirmations_transaction_id_foreign\";s:7:\"columns\";a:1:{i:0;s:14:\"transaction_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:12:\"transactions\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"pengurus\";a:5:{s:7:\"columns\";a:17:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(100)\";}s:11:\"gelar_depan\";a:1:{s:4:\"type\";s:11:\"varchar(50)\";}s:14:\"gelar_belakang\";a:1:{s:4:\"type\";s:12:\"varchar(100)\";}s:7:\"jabatan\";a:1:{s:4:\"type\";s:69:\"enum(\'Ketua\',\'Wakil Ketua\',\'Sekretaris\',\'Wakil Sekretaris\',\'Anggota\')\";}s:6:\"bidang\";a:1:{s:4:\"type\";s:12:\"varchar(100)\";}s:6:\"urutan\";a:1:{s:4:\"type\";s:16:\"tinyint unsigned\";}s:4:\"foto\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"no_hp\";a:1:{s:4:\"type\";s:11:\"varchar(20)\";}s:5:\"email\";a:1:{s:4:\"type\";s:12:\"varchar(100)\";}s:18:\"masa_khidmat_mulai\";a:1:{s:4:\"type\";s:4:\"year\";}s:20:\"masa_khidmat_selesai\";a:1:{s:4:\"type\";s:4:\"year\";}s:5:\"no_sk\";a:1:{s:4:\"type\";s:12:\"varchar(100)\";}s:9:\"is_active\";a:1:{s:4:\"type\";s:10:\"tinyint(1)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"deleted_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:4:{s:32:\"pengurus_jabatan_is_active_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:7:\"jabatan\";i:1;s:9:\"is_active\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:54:\"pengurus_masa_khidmat_mulai_masa_khidmat_selesai_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:18:\"masa_khidmat_mulai\";i:1;s:20:\"masa_khidmat_selesai\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:21:\"pengurus_urutan_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:6:\"urutan\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:7:\"pillars\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:10:\"profile_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:5:\"title\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:9:\"deskripsi\";a:1:{s:4:\"type\";s:4:\"text\";}s:6:\"urutan\";a:1:{s:4:\"type\";s:3:\"int\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:26:\"pillars_profile_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"profile_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:26:\"pillars_profile_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"profile_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:8:\"profiles\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"profiles\";a:5:{s:7:\"columns\";a:9:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:5:\"title\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:9:\"deskripsi\";a:1:{s:4:\"type\";s:4:\"text\";}s:13:\"tahun_berdiri\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:16:\"penerima_manfaat\";a:1:{s:4:\"type\";s:6:\"bigint\";}s:19:\"program_tersalurkan\";a:1:{s:4:\"type\";s:3:\"int\";}s:4:\"visi\";a:1:{s:4:\"type\";s:4:\"text\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"programs\";a:5:{s:7:\"columns\";a:15:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"type\";a:1:{s:4:\"type\";s:22:\"enum(\'infaq\',\'donasi\')\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:4:\"slug\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:9:\"deskripsi\";a:1:{s:4:\"type\";s:4:\"text\";}s:6:\"konten\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:9:\"thumbnail\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:11:\"target_dana\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:9:\"is_active\";a:1:{s:4:\"type\";s:10:\"tinyint(1)\";}s:11:\"is_featured\";a:1:{s:4:\"type\";s:10:\"tinyint(1)\";}s:10:\"start_date\";a:1:{s:4:\"type\";s:4:\"date\";}s:8:\"end_date\";a:1:{s:4:\"type\";s:4:\"date\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"deleted_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:4:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:19:\"programs_slug_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:20:\"programs_slug_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:29:\"programs_type_is_active_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:4:\"type\";i:1;s:9:\"is_active\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"qurban_hewans\";a:5:{s:7:\"columns\";a:14:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:9:\"period_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:5:\"jenis\";a:1:{s:4:\"type\";s:37:\"enum(\'sapi\',\'unta\',\'kambing\',\'domba\')\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:9:\"deskripsi\";a:1:{s:4:\"type\";s:4:\"text\";}s:14:\"berat_estimasi\";a:1:{s:4:\"type\";s:11:\"varchar(50)\";}s:6:\"gambar\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:11:\"harga_total\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:14:\"harga_per_slot\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:11:\"max_peserta\";a:1:{s:4:\"type\";s:16:\"tinyint unsigned\";}s:9:\"is_active\";a:1:{s:4:\"type\";s:10:\"tinyint(1)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"deleted_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:45:\"qurban_hewans_period_id_jenis_is_active_index\";a:4:{s:7:\"columns\";a:3:{i:0;s:9:\"period_id\";i:1;s:5:\"jenis\";i:2;s:9:\"is_active\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:31:\"qurban_hewans_period_id_foreign\";s:7:\"columns\";a:1:{i:0;s:9:\"period_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:14:\"qurban_periods\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:28:\"qurban_payment_confirmations\";a:5:{s:7:\"columns\";a:11:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:15:\"registration_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:13:\"nama_pengirim\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:13:\"bank_pengirim\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:23:\"nomor_rekening_pengirim\";a:1:{s:4:\"type\";s:11:\"varchar(30)\";}s:15:\"jumlah_transfer\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:16:\"tanggal_transfer\";a:1:{s:4:\"type\";s:4:\"date\";}s:14:\"bukti_transfer\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:7:\"catatan\";a:1:{s:4:\"type\";s:4:\"text\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:50:\"qurban_payment_confirmations_registration_id_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:15:\"registration_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:52:\"qurban_payment_confirmations_registration_id_foreign\";s:7:\"columns\";a:1:{i:0;s:15:\"registration_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:20:\"qurban_registrations\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:14:\"qurban_periods\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"tahun\";a:1:{s:4:\"type\";s:8:\"smallint\";}s:9:\"deskripsi\";a:1:{s:4:\"type\";s:4:\"text\";}s:9:\"is_active\";a:1:{s:4:\"type\";s:10:\"tinyint(1)\";}s:12:\"tanggal_buka\";a:1:{s:4:\"type\";s:4:\"date\";}s:13:\"tanggal_tutup\";a:1:{s:4:\"type\";s:4:\"date\";}s:19:\"tanggal_pelaksanaan\";a:1:{s:4:\"type\";s:4:\"date\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:3:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:30:\"qurban_periods_is_active_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:9:\"is_active\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:26:\"qurban_periods_tahun_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"tahun\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:20:\"qurban_registrations\";a:5:{s:7:\"columns\";a:23:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:15:\"kode_registrasi\";a:1:{s:4:\"type\";s:11:\"varchar(20)\";}s:8:\"hewan_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:9:\"period_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:12:\"nama_peserta\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:9:\"atas_nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"email\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:7:\"telepon\";a:1:{s:4:\"type\";s:11:\"varchar(20)\";}s:6:\"alamat\";a:1:{s:4:\"type\";s:4:\"text\";}s:7:\"catatan\";a:1:{s:4:\"type\";s:4:\"text\";}s:11:\"jumlah_slot\";a:1:{s:4:\"type\";s:16:\"tinyint unsigned\";}s:14:\"harga_per_slot\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:11:\"total_bayar\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:6:\"status\";a:1:{s:4:\"type\";s:39:\"enum(\'pending\',\'confirmed\',\'cancelled\')\";}s:13:\"catatan_admin\";a:1:{s:4:\"type\";s:4:\"text\";}s:12:\"confirmed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:12:\"confirmed_by\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:15:\"payment_gateway\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:22:\"gateway_transaction_id\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:14:\"gateway_status\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"deleted_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:7:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:41:\"qurban_registrations_confirmed_by_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:12:\"confirmed_by\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:32:\"qurban_registrations_email_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:42:\"qurban_registrations_hewan_id_status_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:8:\"hewan_id\";i:1;s:6:\"status\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:42:\"qurban_registrations_kode_registrasi_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:15:\"kode_registrasi\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:43:\"qurban_registrations_kode_registrasi_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:15:\"kode_registrasi\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:43:\"qurban_registrations_period_id_status_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:9:\"period_id\";i:1;s:6:\"status\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:3:{i:0;a:7:{s:4:\"name\";s:41:\"qurban_registrations_confirmed_by_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"confirmed_by\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:5:\"users\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}i:1;a:7:{s:4:\"name\";s:37:\"qurban_registrations_hewan_id_foreign\";s:7:\"columns\";a:1:{i:0;s:8:\"hewan_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:13:\"qurban_hewans\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}i:2;a:7:{s:4:\"name\";s:38:\"qurban_registrations_period_id_foreign\";s:7:\"columns\";a:1:{i:0;s:9:\"period_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:14:\"qurban_periods\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:9:\"rekenings\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:14:\"bank_atas_nama\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:14:\"nomor_rekening\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:4:\"icon\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:3:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:21:\"rekenings_nama_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"nama\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:31:\"rekenings_nomor_rekening_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"nomor_rekening\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"sessions\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:7:\"user_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:10:\"ip_address\";a:1:{s:4:\"type\";s:11:\"varchar(45)\";}s:10:\"user_agent\";a:1:{s:4:\"type\";s:4:\"text\";}s:7:\"payload\";a:1:{s:4:\"type\";s:8:\"longtext\";}s:13:\"last_activity\";a:1:{s:4:\"type\";s:3:\"int\";}}s:7:\"indexes\";a:3:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:28:\"sessions_last_activity_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:13:\"last_activity\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:22:\"sessions_user_id_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"settings\";a:5:{s:7:\"columns\";a:8:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:3:\"key\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"value\";a:1:{s:4:\"type\";s:4:\"text\";}s:5:\"group\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"label\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:9:\"deskripsi\";a:1:{s:4:\"type\";s:4:\"text\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:19:\"settings_key_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:12:\"transactions\";a:5:{s:7:\"columns\";a:23:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:14:\"kode_transaksi\";a:1:{s:4:\"type\";s:11:\"varchar(20)\";}s:4:\"type\";a:1:{s:4:\"type\";s:39:\"enum(\'zakat\',\'infaq\',\'donasi\',\'fidyah\')\";}s:10:\"program_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:12:\"nama_donatur\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"email\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:7:\"telepon\";a:1:{s:4:\"type\";s:11:\"varchar(20)\";}s:9:\"is_anonim\";a:1:{s:4:\"type\";s:10:\"tinyint(1)\";}s:6:\"jumlah\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:8:\"metadata\";a:1:{s:4:\"type\";s:4:\"json\";}s:7:\"catatan\";a:1:{s:4:\"type\";s:4:\"text\";}s:6:\"status\";a:1:{s:4:\"type\";s:38:\"enum(\'pending\',\'confirmed\',\'rejected\')\";}s:12:\"confirmed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:12:\"confirmed_by\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:13:\"catatan_admin\";a:1:{s:4:\"type\";s:4:\"text\";}s:15:\"payment_gateway\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:22:\"gateway_transaction_id\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:14:\"gateway_status\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"deleted_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:12:\"kecamatan_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:7:\"desa_id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}}s:7:\"indexes\";a:10:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:33:\"transactions_confirmed_by_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:12:\"confirmed_by\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:29:\"transactions_created_at_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"created_at\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:28:\"transactions_desa_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"desa_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:24:\"transactions_email_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:33:\"transactions_kecamatan_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:33:\"transactions_kode_transaksi_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"kode_transaksi\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:34:\"transactions_kode_transaksi_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"kode_transaksi\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:31:\"transactions_program_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"program_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:30:\"transactions_type_status_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:4:\"type\";i:1;s:6:\"status\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:4:{i:0;a:7:{s:4:\"name\";s:33:\"transactions_confirmed_by_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"confirmed_by\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:5:\"users\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}i:1;a:7:{s:4:\"name\";s:28:\"transactions_desa_id_foreign\";s:7:\"columns\";a:1:{i:0;s:7:\"desa_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:5:\"desas\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}i:2;a:7:{s:4:\"name\";s:33:\"transactions_kecamatan_id_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:10:\"kecamatans\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}i:3;a:7:{s:4:\"name\";s:31:\"transactions_program_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"program_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:8:\"programs\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"users\";a:5:{s:7:\"columns\";a:11:{s:2:\"id\";a:1:{s:4:\"type\";s:15:\"bigint unsigned\";}s:4:\"name\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:5:\"email\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:17:\"email_verified_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:8:\"password\";a:1:{s:4:\"type\";s:12:\"varchar(255)\";}s:17:\"two_factor_secret\";a:1:{s:4:\"type\";s:4:\"text\";}s:25:\"two_factor_recovery_codes\";a:1:{s:4:\"type\";s:4:\"text\";}s:23:\"two_factor_confirmed_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:14:\"remember_token\";a:1:{s:4:\"type\";s:12:\"varchar(100)\";}s:10:\"created_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}s:10:\"updated_at\";a:1:{s:4:\"type\";s:9:\"timestamp\";}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:18:\"users_email_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}}', 1772728546);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-boost:mcp:database-schema:mysql::0:0:1', 'a:2:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:31:{s:5:\"cache\";a:5:{s:7:\"columns\";a:3:{s:3:\"key\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"value\";a:4:{s:4:\"type\";s:10:\"mediumtext\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"expiration\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:22:\"cache_expiration_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"expiration\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"cache_locks\";a:5:{s:7:\"columns\";a:3:{s:3:\"key\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"owner\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"expiration\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:28:\"cache_locks_expiration_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"expiration\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"categories\";a:5:{s:7:\"columns\";a:5:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"name\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"slug\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:22:\"categories_slug_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"desas\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:12:\"kecamatan_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:30:\"desas_kecamatan_id_nama_unique\";a:4:{s:7:\"columns\";a:2:{i:0;s:12:\"kecamatan_id\";i:1;s:4:\"nama\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:26:\"desas_kecamatan_id_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:10:\"kecamatans\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"dokumens\";a:5:{s:7:\"columns\";a:8:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:12:\"nama_dokumen\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"deskripsi\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"file\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"ukuran_file\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:15:\"jumlah_download\";a:4:{s:4:\"type\";s:12:\"int unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"failed_jobs\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"uuid\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"connection\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"queue\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"payload\";a:4:{s:4:\"type\";s:8:\"longtext\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"exception\";a:4:{s:4:\"type\";s:8:\"longtext\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"failed_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:0;s:7:\"default\";s:17:\"CURRENT_TIMESTAMP\";s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:23:\"failed_jobs_uuid_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"uuid\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:11:\"job_batches\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"name\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"total_jobs\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"pending_jobs\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"failed_jobs\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"failed_job_ids\";a:4:{s:4:\"type\";s:8:\"longtext\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"options\";a:4:{s:4:\"type\";s:10:\"mediumtext\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"cancelled_at\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"finished_at\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:4:\"jobs\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:5:\"queue\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"payload\";a:4:{s:4:\"type\";s:8:\"longtext\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:8:\"attempts\";a:4:{s:4:\"type\";s:16:\"tinyint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"reserved_at\";a:4:{s:4:\"type\";s:12:\"int unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"available_at\";a:4:{s:4:\"type\";s:12:\"int unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:12:\"int unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:16:\"jobs_queue_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"queue\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"kecamatans\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:8:\"latitude\";a:4:{s:4:\"type\";s:13:\"decimal(10,8)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"longitude\";a:4:{s:4:\"type\";s:13:\"decimal(11,8)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:22:\"kecamatans_nama_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"nama\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:16:\"laporan_bulanans\";a:5:{s:7:\"columns\";a:5:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:12:\"nama_laporan\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"file_laporan\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:12:\"laporan_mwcs\";a:5:{s:7:\"columns\";a:5:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"file_laporan\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:16:\"laporan_tahunans\";a:5:{s:7:\"columns\";a:5:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"link_from\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:10:\"migrations\";a:5:{s:7:\"columns\";a:3:{s:2:\"id\";a:4:{s:4:\"type\";s:12:\"int unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:9:\"migration\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"batch\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"missions\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:10:\"profile_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"text\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"urutan\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:27:\"missions_profile_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"profile_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:27:\"missions_profile_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"profile_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:8:\"profiles\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:9:\"mustahiks\";a:5:{s:7:\"columns\";a:11:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:3:\"nik\";a:4:{s:4:\"type\";s:11:\"varchar(20)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:13:\"jenis_kelamin\";a:4:{s:4:\"type\";s:29:\"enum(\'laki-laki\',\'perempuan\')\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"kecamatan_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"desa_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"no_hp\";a:4:{s:4:\"type\";s:11:\"varchar(15)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"kategori_asnaf\";a:4:{s:4:\"type\";s:84:\"enum(\'fakir\',\'miskin\',\'amil\',\'muallaf\',\'riqab\',\'gharim\',\'fisabilillah\',\'ibnu_sabil\')\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"status\";a:4:{s:4:\"type\";s:24:\"enum(\'aktif\',\'nonaktif\')\";s:8:\"nullable\";b:0;s:7:\"default\";s:5:\"aktif\";s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:4:{s:25:\"mustahiks_desa_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"desa_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:30:\"mustahiks_kecamatan_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:20:\"mustahiks_nik_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"nik\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:2:{i:0;a:7:{s:4:\"name\";s:25:\"mustahiks_desa_id_foreign\";s:7:\"columns\";a:1:{i:0;s:7:\"desa_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:5:\"desas\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}i:1;a:7:{s:4:\"name\";s:30:\"mustahiks_kecamatan_id_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:10:\"kecamatans\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:4:\"news\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:5:\"title\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"slug\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"category_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"featured_image\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"content\";a:4:{s:4:\"type\";s:8:\"longtext\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"excerpt\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"published_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:3:{s:24:\"news_category_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:11:\"category_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:16:\"news_slug_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:24:\"news_category_id_foreign\";s:7:\"columns\";a:1:{i:0;s:11:\"category_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:10:\"categories\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"password_reset_tokens\";a:5:{s:7:\"columns\";a:3:{s:5:\"email\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"token\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:21:\"payment_confirmations\";a:5:{s:7:\"columns\";a:11:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:14:\"transaction_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:13:\"nama_pengirim\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:13:\"bank_pengirim\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:23:\"nomor_rekening_pengirim\";a:4:{s:4:\"type\";s:11:\"varchar(30)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:15:\"jumlah_transfer\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:16:\"tanggal_transfer\";a:4:{s:4:\"type\";s:4:\"date\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"bukti_transfer\";a:5:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;s:7:\"comment\";s:26:\"path file bukti pembayaran\";}s:7:\"catatan\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:3:{s:40:\"idx_payment_confirmations_transaction_id\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"transaction_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:42:\"payment_confirmations_transaction_id_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"transaction_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:44:\"payment_confirmations_transaction_id_foreign\";s:7:\"columns\";a:1:{i:0;s:14:\"transaction_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:12:\"transactions\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"pengurus\";a:5:{s:7:\"columns\";a:17:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(100)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"gelar_depan\";a:4:{s:4:\"type\";s:11:\"varchar(50)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"gelar_belakang\";a:4:{s:4:\"type\";s:12:\"varchar(100)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"jabatan\";a:4:{s:4:\"type\";s:69:\"enum(\'Ketua\',\'Wakil Ketua\',\'Sekretaris\',\'Wakil Sekretaris\',\'Anggota\')\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"bidang\";a:5:{s:4:\"type\";s:12:\"varchar(100)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;s:7:\"comment\";s:28:\"Diisi jika jabatan = Anggota\";}s:6:\"urutan\";a:5:{s:4:\"type\";s:16:\"tinyint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;s:7:\"comment\";s:13:\"Urutan tampil\";}s:4:\"foto\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"no_hp\";a:4:{s:4:\"type\";s:11:\"varchar(20)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"email\";a:4:{s:4:\"type\";s:12:\"varchar(100)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:18:\"masa_khidmat_mulai\";a:4:{s:4:\"type\";s:4:\"year\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:20:\"masa_khidmat_selesai\";a:4:{s:4:\"type\";s:4:\"year\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"no_sk\";a:5:{s:4:\"type\";s:12:\"varchar(100)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;s:7:\"comment\";s:21:\"Nomor SK pengangkatan\";}s:9:\"is_active\";a:4:{s:4:\"type\";s:10:\"tinyint(1)\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"1\";s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:4:{s:32:\"pengurus_jabatan_is_active_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:7:\"jabatan\";i:1;s:9:\"is_active\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:54:\"pengurus_masa_khidmat_mulai_masa_khidmat_selesai_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:18:\"masa_khidmat_mulai\";i:1;s:20:\"masa_khidmat_selesai\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:21:\"pengurus_urutan_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:6:\"urutan\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:7:\"pillars\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:10:\"profile_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"title\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"deskripsi\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"urutan\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:26:\"pillars_profile_id_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"profile_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:26:\"pillars_profile_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"profile_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:8:\"profiles\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"profiles\";a:5:{s:7:\"columns\";a:9:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:5:\"title\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"deskripsi\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:13:\"tahun_berdiri\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:16:\"penerima_manfaat\";a:4:{s:4:\"type\";s:6:\"bigint\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;}s:19:\"program_tersalurkan\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;}s:4:\"visi\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:1:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"programs\";a:5:{s:7:\"columns\";a:15:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"type\";a:4:{s:4:\"type\";s:22:\"enum(\'infaq\',\'donasi\')\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"slug\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"deskripsi\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"konten\";a:4:{s:4:\"type\";s:8:\"longtext\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"thumbnail\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"target_dana\";a:5:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;s:7:\"comment\";s:23:\"null = tidak ada target\";}s:9:\"is_active\";a:4:{s:4:\"type\";s:10:\"tinyint(1)\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"1\";s:14:\"auto_increment\";b:0;}s:11:\"is_featured\";a:4:{s:4:\"type\";s:10:\"tinyint(1)\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;}s:10:\"start_date\";a:4:{s:4:\"type\";s:4:\"date\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:8:\"end_date\";a:5:{s:4:\"type\";s:4:\"date\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;s:7:\"comment\";s:28:\"null = program berkelanjutan\";}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:4:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:19:\"programs_slug_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:20:\"programs_slug_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:29:\"programs_type_is_active_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:4:\"type\";i:1;s:9:\"is_active\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:13:\"qurban_hewans\";a:5:{s:7:\"columns\";a:14:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:9:\"period_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"jenis\";a:4:{s:4:\"type\";s:37:\"enum(\'sapi\',\'unta\',\'kambing\',\'domba\')\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"deskripsi\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"berat_estimasi\";a:4:{s:4:\"type\";s:11:\"varchar(50)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"gambar\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"harga_total\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"harga_per_slot\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"max_peserta\";a:4:{s:4:\"type\";s:16:\"tinyint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"is_active\";a:4:{s:4:\"type\";s:10:\"tinyint(1)\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"1\";s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:45:\"qurban_hewans_period_id_jenis_is_active_index\";a:4:{s:7:\"columns\";a:3:{i:0;s:9:\"period_id\";i:1;s:5:\"jenis\";i:2;s:9:\"is_active\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:31:\"qurban_hewans_period_id_foreign\";s:7:\"columns\";a:1:{i:0;s:9:\"period_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:14:\"qurban_periods\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:28:\"qurban_payment_confirmations\";a:5:{s:7:\"columns\";a:11:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:15:\"registration_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:13:\"nama_pengirim\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:13:\"bank_pengirim\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:23:\"nomor_rekening_pengirim\";a:4:{s:4:\"type\";s:11:\"varchar(30)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:15:\"jumlah_transfer\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:16:\"tanggal_transfer\";a:4:{s:4:\"type\";s:4:\"date\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"bukti_transfer\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"catatan\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:50:\"qurban_payment_confirmations_registration_id_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:15:\"registration_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:1:{i:0;a:7:{s:4:\"name\";s:52:\"qurban_payment_confirmations_registration_id_foreign\";s:7:\"columns\";a:1:{i:0;s:15:\"registration_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:20:\"qurban_registrations\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:14:\"qurban_periods\";a:5:{s:7:\"columns\";a:10:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"tahun\";a:4:{s:4:\"type\";s:8:\"smallint\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"deskripsi\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"is_active\";a:4:{s:4:\"type\";s:10:\"tinyint(1)\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;}s:12:\"tanggal_buka\";a:4:{s:4:\"type\";s:4:\"date\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:13:\"tanggal_tutup\";a:4:{s:4:\"type\";s:4:\"date\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:19:\"tanggal_pelaksanaan\";a:4:{s:4:\"type\";s:4:\"date\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:3:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:30:\"qurban_periods_is_active_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:9:\"is_active\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:26:\"qurban_periods_tahun_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"tahun\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:20:\"qurban_registrations\";a:5:{s:7:\"columns\";a:23:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:15:\"kode_registrasi\";a:4:{s:4:\"type\";s:11:\"varchar(20)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:8:\"hewan_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"period_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"nama_peserta\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"atas_nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"email\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"telepon\";a:4:{s:4:\"type\";s:11:\"varchar(20)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"alamat\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"catatan\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"jumlah_slot\";a:4:{s:4:\"type\";s:16:\"tinyint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"1\";s:14:\"auto_increment\";b:0;}s:14:\"harga_per_slot\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"total_bayar\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"status\";a:4:{s:4:\"type\";s:39:\"enum(\'pending\',\'confirmed\',\'cancelled\')\";s:8:\"nullable\";b:0;s:7:\"default\";s:7:\"pending\";s:14:\"auto_increment\";b:0;}s:13:\"catatan_admin\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"confirmed_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"confirmed_by\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:15:\"payment_gateway\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:22:\"gateway_transaction_id\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"gateway_status\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:7:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:41:\"qurban_registrations_confirmed_by_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:12:\"confirmed_by\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:32:\"qurban_registrations_email_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:42:\"qurban_registrations_hewan_id_status_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:8:\"hewan_id\";i:1;s:6:\"status\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:42:\"qurban_registrations_kode_registrasi_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:15:\"kode_registrasi\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:43:\"qurban_registrations_kode_registrasi_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:15:\"kode_registrasi\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:43:\"qurban_registrations_period_id_status_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:9:\"period_id\";i:1;s:6:\"status\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:3:{i:0;a:7:{s:4:\"name\";s:41:\"qurban_registrations_confirmed_by_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"confirmed_by\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:5:\"users\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}i:1;a:7:{s:4:\"name\";s:37:\"qurban_registrations_hewan_id_foreign\";s:7:\"columns\";a:1:{i:0;s:8:\"hewan_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:13:\"qurban_hewans\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}i:2;a:7:{s:4:\"name\";s:38:\"qurban_registrations_period_id_foreign\";s:7:\"columns\";a:1:{i:0;s:9:\"period_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:14:\"qurban_periods\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:7:\"cascade\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:9:\"rekenings\";a:5:{s:7:\"columns\";a:7:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"bank_atas_nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"nomor_rekening\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"icon\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:3:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:21:\"rekenings_nama_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"nama\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:31:\"rekenings_nomor_rekening_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"nomor_rekening\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"sessions\";a:5:{s:7:\"columns\";a:6:{s:2:\"id\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"user_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"ip_address\";a:4:{s:4:\"type\";s:11:\"varchar(45)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"user_agent\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"payload\";a:4:{s:4:\"type\";s:8:\"longtext\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:13:\"last_activity\";a:4:{s:4:\"type\";s:3:\"int\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:3:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:28:\"sessions_last_activity_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:13:\"last_activity\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:22:\"sessions_user_id_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"user_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:8:\"settings\";a:5:{s:7:\"columns\";a:8:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:3:\"key\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"value\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"group\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";s:7:\"general\";s:14:\"auto_increment\";b:0;}s:5:\"label\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"deskripsi\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:19:\"settings_key_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:3:\"key\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:12:\"transactions\";a:5:{s:7:\"columns\";a:23:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:14:\"kode_transaksi\";a:4:{s:4:\"type\";s:11:\"varchar(20)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"type\";a:4:{s:4:\"type\";s:39:\"enum(\'zakat\',\'infaq\',\'donasi\',\'fidyah\')\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"program_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"nama_donatur\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"email\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"telepon\";a:4:{s:4:\"type\";s:11:\"varchar(20)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"is_anonim\";a:4:{s:4:\"type\";s:10:\"tinyint(1)\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;}s:6:\"jumlah\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:8:\"metadata\";a:4:{s:4:\"type\";s:4:\"json\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"catatan\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"status\";a:4:{s:4:\"type\";s:38:\"enum(\'pending\',\'confirmed\',\'rejected\')\";s:8:\"nullable\";b:0;s:7:\"default\";s:7:\"pending\";s:14:\"auto_increment\";b:0;}s:12:\"confirmed_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"confirmed_by\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:13:\"catatan_admin\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:15:\"payment_gateway\";a:5:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;s:7:\"comment\";s:19:\"midtrans|xendit|dll\";}s:22:\"gateway_transaction_id\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"gateway_status\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:12:\"kecamatan_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:7:\"desa_id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:14:{s:27:\"idx_transactions_created_at\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"created_at\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:24:\"idx_transactions_desa_id\";a:4:{s:7:\"columns\";a:1:{i:0;s:7:\"desa_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:29:\"idx_transactions_kecamatan_id\";a:4:{s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:31:\"idx_transactions_kode_transaksi\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"kode_transaksi\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:27:\"idx_transactions_program_id\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"program_id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:23:\"idx_transactions_status\";a:4:{s:7:\"columns\";a:1:{i:0;s:6:\"status\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:21:\"idx_transactions_type\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"type\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:33:\"transactions_confirmed_by_foreign\";a:4:{s:7:\"columns\";a:1:{i:0;s:12:\"confirmed_by\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:29:\"transactions_created_at_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:10:\"created_at\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:24:\"transactions_email_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:33:\"transactions_kode_transaksi_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"kode_transaksi\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:34:\"transactions_kode_transaksi_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:14:\"kode_transaksi\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:30:\"transactions_type_status_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:4:\"type\";i:1;s:6:\"status\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:4:{i:0;a:7:{s:4:\"name\";s:33:\"transactions_confirmed_by_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"confirmed_by\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:5:\"users\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}i:1;a:7:{s:4:\"name\";s:28:\"transactions_desa_id_foreign\";s:7:\"columns\";a:1:{i:0;s:7:\"desa_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:5:\"desas\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}i:2;a:7:{s:4:\"name\";s:33:\"transactions_kecamatan_id_foreign\";s:7:\"columns\";a:1:{i:0;s:12:\"kecamatan_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:10:\"kecamatans\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}i:3;a:7:{s:4:\"name\";s:31:\"transactions_program_id_foreign\";s:7:\"columns\";a:1:{i:0;s:10:\"program_id\";}s:14:\"foreign_schema\";s:13:\"db-laziznubjn\";s:13:\"foreign_table\";s:8:\"programs\";s:15:\"foreign_columns\";a:1:{i:0;s:2:\"id\";}s:9:\"on_update\";s:9:\"no action\";s:9:\"on_delete\";s:8:\"set null\";}}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}s:5:\"users\";a:5:{s:7:\"columns\";a:11:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"name\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:5:\"email\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:17:\"email_verified_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:8:\"password\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:17:\"two_factor_secret\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:25:\"two_factor_recovery_codes\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:23:\"two_factor_confirmed_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:14:\"remember_token\";a:4:{s:4:\"type\";s:12:\"varchar(100)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:18:\"users_email_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:5:\"email\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}}', 1772776492);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-boost:mcp:database-schema:mysql:kecamatans:0:0:1', 'a:2:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:1:{s:10:\"kecamatans\";a:5:{s:7:\"columns\";a:5:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:2:{s:22:\"kecamatans_nama_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"nama\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}}', 1772727469),
('laravel-cache-boost:mcp:database-schema:mysql:mustahik|transaction|user:0:0:1', 'a:2:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:0:{}}', 1772727892),
('laravel-cache-boost:mcp:database-schema:mysql:program:0:0:1', 'a:2:{s:6:\"engine\";s:5:\"mysql\";s:6:\"tables\";a:1:{s:8:\"programs\";a:5:{s:7:\"columns\";a:15:{s:2:\"id\";a:4:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:1;}s:4:\"type\";a:4:{s:4:\"type\";s:22:\"enum(\'infaq\',\'donasi\')\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"nama\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:4:\"slug\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"deskripsi\";a:4:{s:4:\"type\";s:4:\"text\";s:8:\"nullable\";b:0;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:6:\"konten\";a:4:{s:4:\"type\";s:8:\"longtext\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:9:\"thumbnail\";a:4:{s:4:\"type\";s:12:\"varchar(255)\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:11:\"target_dana\";a:5:{s:4:\"type\";s:15:\"bigint unsigned\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;s:7:\"comment\";s:23:\"null = tidak ada target\";}s:9:\"is_active\";a:4:{s:4:\"type\";s:10:\"tinyint(1)\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"1\";s:14:\"auto_increment\";b:0;}s:11:\"is_featured\";a:4:{s:4:\"type\";s:10:\"tinyint(1)\";s:8:\"nullable\";b:0;s:7:\"default\";s:1:\"0\";s:14:\"auto_increment\";b:0;}s:10:\"start_date\";a:4:{s:4:\"type\";s:4:\"date\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:8:\"end_date\";a:5:{s:4:\"type\";s:4:\"date\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;s:7:\"comment\";s:28:\"null = program berkelanjutan\";}s:10:\"created_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"updated_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}s:10:\"deleted_at\";a:4:{s:4:\"type\";s:9:\"timestamp\";s:8:\"nullable\";b:1;s:7:\"default\";N;s:14:\"auto_increment\";b:0;}}s:7:\"indexes\";a:4:{s:7:\"primary\";a:4:{s:7:\"columns\";a:1:{i:0;s:2:\"id\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:1;}s:19:\"programs_slug_index\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}s:20:\"programs_slug_unique\";a:4:{s:7:\"columns\";a:1:{i:0;s:4:\"slug\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:1;s:10:\"is_primary\";b:0;}s:29:\"programs_type_is_active_index\";a:4:{s:7:\"columns\";a:2:{i:0;s:4:\"type\";i:1;s:9:\"is_active\";}s:4:\"type\";s:5:\"btree\";s:9:\"is_unique\";b:0;s:10:\"is_primary\";b:0;}}s:12:\"foreign_keys\";a:0:{}s:8:\"triggers\";a:0:{}s:17:\"check_constraints\";a:0:{}}}}', 1772896859),
('laravel-cache-boost.roster.scan', 'a:2:{s:6:\"roster\";O:21:\"Laravel\\Roster\\Roster\":3:{s:13:\"\0*\0approaches\";O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:1:{i:0;O:23:\"Laravel\\Roster\\Approach\":1:{s:11:\"\0*\0approach\";E:38:\"Laravel\\Roster\\Enums\\Approaches:ACTION\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:11:\"\0*\0packages\";O:32:\"Laravel\\Roster\\PackageCollection\":2:{s:8:\"\0*\0items\";a:14:{i:0;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.30\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:FORTIFY\";s:14:\"\0*\0packageName\";s:15:\"laravel/fortify\";s:10:\"\0*\0version\";s:6:\"1.34.1\";s:6:\"\0*\0dev\";b:0;}i:1;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^12.0\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:LARAVEL\";s:14:\"\0*\0packageName\";s:17:\"laravel/framework\";s:10:\"\0*\0version\";s:7:\"12.51.0\";s:6:\"\0*\0dev\";b:0;}i:2;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"v0.3.13\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PROMPTS\";s:14:\"\0*\0packageName\";s:15:\"laravel/prompts\";s:10:\"\0*\0version\";s:6:\"0.3.13\";s:6:\"\0*\0dev\";b:0;}i:3;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^2.9.0\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:FLUXUI_FREE\";s:14:\"\0*\0packageName\";s:13:\"livewire/flux\";s:10:\"\0*\0version\";s:6:\"2.12.0\";s:6:\"\0*\0dev\";b:0;}i:4;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^4.0\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:LIVEWIRE\";s:14:\"\0*\0packageName\";s:17:\"livewire/livewire\";s:10:\"\0*\0version\";s:5:\"4.1.4\";s:6:\"\0*\0dev\";b:0;}i:5;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^2.1\";s:10:\"\0*\0package\";E:35:\"Laravel\\Roster\\Enums\\Packages:BOOST\";s:14:\"\0*\0packageName\";s:13:\"laravel/boost\";s:10:\"\0*\0version\";s:5:\"2.1.8\";s:6:\"\0*\0dev\";b:1;}i:6;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:6:\"v0.5.6\";s:10:\"\0*\0package\";E:33:\"Laravel\\Roster\\Enums\\Packages:MCP\";s:14:\"\0*\0packageName\";s:11:\"laravel/mcp\";s:10:\"\0*\0version\";s:5:\"0.5.6\";s:6:\"\0*\0dev\";b:1;}i:7;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:6:\"^1.2.2\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/pail\";s:10:\"\0*\0version\";s:5:\"1.2.6\";s:6:\"\0*\0dev\";b:1;}i:8;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.24\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PINT\";s:14:\"\0*\0packageName\";s:12:\"laravel/pint\";s:10:\"\0*\0version\";s:6:\"1.27.1\";s:6:\"\0*\0dev\";b:1;}i:9;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:5:\"^1.41\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:SAIL\";s:14:\"\0*\0packageName\";s:12:\"laravel/sail\";s:10:\"\0*\0version\";s:6:\"1.53.0\";s:6:\"\0*\0dev\";b:1;}i:10;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:1;s:13:\"\0*\0constraint\";s:4:\"^3.8\";s:10:\"\0*\0package\";E:34:\"Laravel\\Roster\\Enums\\Packages:PEST\";s:14:\"\0*\0packageName\";s:12:\"pestphp/pest\";s:10:\"\0*\0version\";s:5:\"3.8.5\";s:6:\"\0*\0dev\";b:1;}i:11;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:7:\"11.5.50\";s:10:\"\0*\0package\";E:37:\"Laravel\\Roster\\Enums\\Packages:PHPUNIT\";s:14:\"\0*\0packageName\";s:15:\"phpunit/phpunit\";s:10:\"\0*\0version\";s:7:\"11.5.50\";s:6:\"\0*\0dev\";b:1;}i:12;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:38:\"Laravel\\Roster\\Enums\\Packages:ALPINEJS\";s:14:\"\0*\0packageName\";s:8:\"alpinejs\";s:10:\"\0*\0version\";s:6:\"3.15.8\";s:6:\"\0*\0dev\";b:0;}i:13;O:22:\"Laravel\\Roster\\Package\":6:{s:9:\"\0*\0direct\";b:0;s:13:\"\0*\0constraint\";s:0:\"\";s:10:\"\0*\0package\";E:41:\"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS\";s:14:\"\0*\0packageName\";s:11:\"tailwindcss\";s:10:\"\0*\0version\";s:6:\"4.1.18\";s:6:\"\0*\0dev\";b:0;}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:21:\"\0*\0nodePackageManager\";E:43:\"Laravel\\Roster\\Enums\\NodePackageManager:NPM\";}s:9:\"timestamp\";i:1772952158;}', 1773038558),
('laravel-cache-dc44958e29ffba8b810d21377ae366b5', 'i:1;', 1772889792),
('laravel-cache-dc44958e29ffba8b810d21377ae366b5:timer', 'i:1772889792;', 1772889792),
('laravel-cache-setting_fidyah_price_per_day', 's:5:\"25000\";', 1772892980),
('laravel-cache-setting_harga_emas_per_gram', 's:9:\"2,912,000\";', 1772893081),
('laravel-cache-setting_nisab_emas_gram', 's:2:\"85\";', 1772893081),
('laravel-cache-setting_zakat_fitrah_uang_per_jiwa', 's:5:\"25000\";', 1772893081),
('laravel-cache-setting_zakat_mal_persen', 's:3:\"2.5\";', 1772893081);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Berita Kegiatan', 'berita-kegiatan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `desas`
--

CREATE TABLE `desas` (
  `id` bigint UNSIGNED NOT NULL,
  `kecamatan_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desas`
--

INSERT INTO `desas` (`id`, `kecamatan_id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(70, 16, 'Balenrejo', '2026-03-04 21:15:54', '2026-03-04 21:15:54', NULL),
(71, 16, 'Bulaklo', '2026-03-04 21:15:54', '2026-03-04 21:15:54', NULL),
(72, 16, 'Bulu', '2026-03-04 21:15:54', '2026-03-04 21:15:54', NULL),
(73, 16, 'Kabunan', '2026-03-04 21:15:54', '2026-03-04 21:15:54', NULL),
(74, 16, 'Kedungbondo', '2026-03-04 21:15:54', '2026-03-04 21:15:54', NULL),
(75, 16, 'Kedungdowo', '2026-03-04 21:15:54', '2026-03-04 21:15:54', NULL),
(76, 16, 'Kemamang', '2026-03-04 21:15:54', '2026-03-04 21:15:54', NULL),
(77, 16, 'Kenep', '2026-03-04 21:15:54', '2026-03-04 21:15:54', NULL),
(78, 16, 'Lengkong', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(79, 16, 'Margomulyo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(80, 16, 'Mayangkawis', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(81, 16, 'Mulyoagung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(82, 16, 'Mulyorejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(83, 16, 'Ngadiluhur', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(84, 16, 'Penganten', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(85, 16, 'Pilanggede', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(86, 16, 'Pohbogo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(87, 16, 'Prambatan', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(88, 16, 'Sarisejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(89, 16, 'Sekaran', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(90, 16, 'Sidobandung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(91, 16, 'Sobontoro', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(92, 16, 'Swaloh', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(93, 17, 'Banjaran', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(94, 17, 'Banjaranyar', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(95, 17, 'Baureno', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(96, 17, 'Blongsong', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(97, 17, 'Bumiayu', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(98, 17, 'Drajat', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(99, 17, 'Gajah', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(100, 17, 'Gunungsari', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(101, 17, 'Kalisari', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(102, 17, 'Karangdayu', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(103, 17, 'Kauman', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(104, 17, 'Kedungrejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(105, 17, 'Lebaksari', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(106, 17, 'Ngemplak', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(107, 17, 'Pasinan', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(108, 17, 'Pomahan', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(109, 17, 'Pucangarum', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(110, 17, 'Selorejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(111, 17, 'Sembunglor', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(112, 17, 'Sraturejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(113, 17, 'Sumberagung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(114, 17, 'Sumuragung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(115, 17, 'Tanggungan', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(116, 17, 'Tlogoagung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(117, 17, 'Trojalu', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(118, 18, 'Campurejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(119, 18, 'Kalirejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(120, 18, 'Kauman', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(121, 18, 'Mulyoagung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(122, 18, 'Pacul', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(123, 18, 'Semanding', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(124, 18, 'Sukorejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(125, 18, 'Banjarejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(126, 18, 'Jetak', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(127, 18, 'Kadipaten', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(128, 18, 'Karang Pacar', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(129, 18, 'Kepatihan', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(130, 18, 'Klangon', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(131, 18, 'Ledok Kulon', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(132, 18, 'Ledok Wetan', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(133, 18, 'Mojokampung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(134, 18, 'Ngrowo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(135, 18, 'Sumbang', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(136, 19, 'Bubulan', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(137, 19, 'Cancung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(138, 19, 'Clebung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(139, 19, 'Ngorogunung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(140, 19, 'Sumberbendo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(141, 20, 'Dander', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(142, 20, 'Growok', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(143, 20, 'Jatiblimbing', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(144, 20, 'Karangsono', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(145, 20, 'Kunci', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(146, 20, 'Mojoranu', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(147, 20, 'Ngablak', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(148, 20, 'Ngraseh', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(149, 20, 'Ngulanan', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(150, 20, 'Ngumpakdalem', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(151, 20, 'Ngunut', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(152, 20, 'Sendangrejo', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(153, 20, 'Sumberagung', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(154, 20, 'Sumberarum', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(155, 20, 'Sumbertlaseh', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(156, 20, 'Sumodikaran', '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(157, 21, 'Begadon', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(158, 21, 'Beged', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(159, 21, 'Bonorejo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(160, 21, 'Brabowan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(161, 21, 'Cengungklung', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(162, 21, 'Gayam', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(163, 21, 'Katur', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(164, 21, 'Manukan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(165, 21, 'Mojodelik', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(166, 21, 'Ngraho', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(167, 21, 'Ringintunggal', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(168, 21, 'Sudu', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(169, 22, 'Gondang', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(170, 22, 'Jari', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(171, 22, 'Krondonan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(172, 22, 'Pajeng', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(173, 22, 'Pragelan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(174, 22, 'Sambongrejo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(175, 22, 'Senganten', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(176, 23, 'Brenggolo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(177, 23, 'Grebegan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(178, 23, 'Kalitidu', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(179, 23, 'Leran', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(180, 23, 'Mayanggeneng', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(181, 23, 'Mayangrejo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(182, 23, 'Mlaten', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(183, 23, 'Mojo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(184, 23, 'Mojosari', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(185, 23, 'Ngringinrejo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(186, 23, 'Ngujo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(187, 23, 'Panjunan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(188, 23, 'Pilangsari', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(189, 23, 'Pungpungan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(190, 23, 'Sukoharjo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(191, 23, 'Sumengko', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(192, 23, 'Talok', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(193, 23, 'Wotanngare', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(194, 24, 'Bakung', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(195, 24, 'Bungur', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(196, 24, 'Cangakan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(197, 24, 'Caruban', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(198, 24, 'Gedongarum', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(199, 24, 'Kabalan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(200, 24, 'Kanor', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(201, 24, 'Kedungprimpen', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(202, 24, 'Nglarangan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(203, 24, 'Palembon', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(204, 24, 'Pesen', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(205, 24, 'Pilang', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(206, 24, 'Piyak', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(207, 24, 'Prigi', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(208, 24, 'Samberan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(209, 24, 'Sarangan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(210, 24, 'Sedeng', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(211, 24, 'Semambung', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(212, 24, 'Simbatan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(213, 24, 'Simorejo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(214, 24, 'Sroyo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(215, 24, 'Sumberwangi', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(216, 24, 'Tambahrejo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(217, 24, 'Tejo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(218, 24, 'Temu', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(219, 25, 'Bakalan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(220, 25, 'Bangilan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(221, 25, 'Bendo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(222, 25, 'Bogo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(223, 25, 'Kalianyar', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(224, 25, 'Kapas', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(225, 25, 'Kedaton', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(226, 25, 'Klampok', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(227, 25, 'Kumpulrejo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(228, 25, 'Mojodeso', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(229, 25, 'Ngampel', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(230, 25, 'Padang Mentoyo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(231, 25, 'Plesungan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(232, 25, 'Sambiroto', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(233, 25, 'Sembung', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(234, 25, 'Semenpinggir', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(235, 25, 'Sukowati', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(236, 25, 'Tanjungharjo', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(237, 25, 'Tapelan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(238, 25, 'Tikusan', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(239, 25, 'Wedi', '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(240, 26, 'Batokan', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(241, 26, 'Besah', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(242, 26, 'Betet', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(243, 26, 'Kasiman', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(244, 26, 'Ngaglik', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(245, 26, 'Sambeng', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(246, 26, 'Sekaran', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(247, 26, 'Sidomukti', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(248, 26, 'Tambakmerak', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(249, 26, 'Tembeling', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(250, 27, 'Beji', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(251, 27, 'Hargomulyo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(252, 27, 'Kedewan', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(253, 27, 'Kawengan', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(254, 27, 'Wonocolo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(255, 28, 'Babad', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(256, 28, 'Balongcabe', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(257, 28, 'Dayukidul', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(258, 28, 'Drokilo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(259, 28, 'Duwel', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(260, 28, 'Geger', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(261, 28, 'Jamberejo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(262, 28, 'Kedungadem', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(263, 28, 'Kedungrejo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(264, 28, 'Kepohkidul', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(265, 28, 'Kendung', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(266, 28, 'Kesongo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(267, 28, 'Megale', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(268, 28, 'Mlideg', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(269, 28, 'Mojorejo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(270, 28, 'Ngrandu', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(271, 28, 'Panjang', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(272, 28, 'Pejok', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(273, 28, 'Sidorejo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(274, 28, 'Sidomulyo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(275, 28, 'Tlogoagung', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(276, 28, 'Tondomulo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(277, 28, 'Tumbrasanom', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(278, 29, 'Balongdowo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(279, 29, 'Bayemgede', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(280, 29, 'Betet', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(281, 29, 'Brangkal', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(282, 29, 'Bumirejo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(283, 29, 'Cengkir', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(284, 29, 'Jipo', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(285, 29, 'Karangan', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(286, 29, 'Kepoh', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(287, 29, 'Krangkong', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(288, 29, 'Mojosari', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(289, 29, 'Mudung', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(290, 29, 'Nglumber', '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(291, 29, 'Ngranggonanyar', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(292, 29, 'Pejok', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(293, 29, 'Pohwates', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(294, 29, 'Sidomukti', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(295, 29, 'Sidonganti', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(296, 29, 'Simorejo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(297, 29, 'Sugihwaras', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(298, 29, 'Sumberagung', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(299, 29, 'Sumbergede', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(300, 29, 'Sumberoto', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(301, 29, 'Turigede', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(302, 29, 'Woro', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(303, 30, 'Geneng', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(304, 30, 'Kalangan', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(305, 30, 'Margomulyo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(306, 30, 'Meduri', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(307, 30, 'Ngelo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(308, 30, 'Sumberejo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(309, 31, 'Banaran', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(310, 31, 'Dukohlor', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(311, 31, 'Kacangan', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(312, 31, 'Kedungrejo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(313, 31, 'Kemiri', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(314, 31, 'Ketileng', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(315, 31, 'Kliteh', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(316, 31, 'Petak', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(317, 31, 'Malo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(318, 31, 'Ngujung', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(319, 31, 'Rendeng', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(320, 31, 'Semlaran', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(321, 31, 'Sudah', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(322, 31, 'Sukorejo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(323, 31, 'Sumberejo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(324, 31, 'Tambakromo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(325, 31, 'Tanggir', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(326, 31, 'Tinawun', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(327, 31, 'Trembes', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(328, 31, 'Tulungagung', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(329, 32, 'Bondol', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(330, 32, 'Karangmangu', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(331, 32, 'Ngambon', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(332, 32, 'Nglamping', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(333, 32, 'Sengon', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(334, 33, 'Bandungrejo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(335, 33, 'Bareng', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(336, 33, 'Butoh', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(337, 33, 'Dukoh Kidul', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(338, 33, 'Jampet', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(339, 33, 'Jelu', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(340, 33, 'Kolong', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(341, 33, 'Mediyunan', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(342, 33, 'Ngadiluwih', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(343, 33, 'Ngantru', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(344, 33, 'Ngasem', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(345, 33, 'Sambong', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(346, 33, 'Sendangharjo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(347, 33, 'Setren', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(348, 33, 'Tengger', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(349, 33, 'Trenggulunan', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(350, 33, 'Wadang', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(351, 34, 'Bancer', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(352, 34, 'Blimbinggede', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(353, 34, 'Jumok', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(354, 34, 'Kalirejo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(355, 34, 'Klempun', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(356, 34, 'Luwihaji', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(357, 34, 'Mojorejo', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(358, 34, 'Nganti', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(359, 34, 'Ngraho', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(360, 34, 'Pandan', '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(361, 34, 'Payaman', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(362, 34, 'Sugihwaras', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(363, 34, 'Sumberagung', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(364, 34, 'Sumberarum', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(365, 34, 'Tanggungan', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(366, 34, 'Tapelan', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(367, 35, 'Banjarejo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(368, 35, 'Cendono', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(369, 35, 'Dengok', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(370, 35, 'Kebonagung', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(371, 35, 'Kendung', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(372, 35, 'Kuncan', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(373, 35, 'Ngasiman', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(374, 35, 'Ngeper', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(375, 35, 'Ngradin', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(376, 35, 'Nguken', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(377, 35, 'Padangan', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(378, 35, 'Prangi', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(379, 35, 'Purworejo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(380, 35, 'Sidorejo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(381, 35, 'Sonorejo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(382, 35, 'Tebon', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(383, 36, 'Donan', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(384, 36, 'Gapluk', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(385, 36, 'Kaliombo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(386, 36, 'Kuniran', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(387, 36, 'Ngrejeng', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(388, 36, 'Pelem', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(389, 36, 'Pojok', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(390, 36, 'Punggur', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(391, 36, 'Purwosari', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(392, 36, 'Sedahkidul', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(393, 36, 'Tinumpuk', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(394, 36, 'Tlatah', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(395, 37, 'Bareng', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(396, 37, 'Bobol', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(397, 37, 'Deling', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(398, 37, 'Klino', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(399, 37, 'Miyono', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(400, 37, 'Sekar', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(401, 38, 'Alasgung', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(402, 38, 'Balongrejo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(403, 38, 'Bareng', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(404, 38, 'Bulu', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(405, 38, 'Drenges', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(406, 38, 'Genjor', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(407, 38, 'Glagahan', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(408, 38, 'Glagahwangi', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(409, 38, 'Jatitengah', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(410, 38, 'Kedungdowo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(411, 38, 'Nglajang', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(412, 38, 'Panemon', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(413, 38, 'Panunggalan', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(414, 38, 'Siwalan', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(415, 38, 'Sugihwaras', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(416, 38, 'Trate', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(417, 38, 'Wedoro', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(418, 39, 'Duyungan', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(419, 39, 'Jumput', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(420, 39, 'Kalicilik', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(421, 39, 'Klepek', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(422, 39, 'Pacing', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(423, 39, 'Purwoasri', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(424, 39, 'Semawot', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(425, 39, 'Semen Kidul', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(426, 39, 'Sidodadi', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(427, 39, 'Sidorejo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(428, 39, 'Sitiaji', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(429, 39, 'Sukosewu', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(430, 39, 'Sumberjo Kidul', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(431, 39, 'Tegalkodo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(432, 40, 'Banjarjo', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(433, 40, 'Bogangin', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(434, 40, 'Butoh', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(435, 40, 'Deru', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(436, 40, 'Jatigede', '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(437, 40, 'Karangdinoyo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(438, 40, 'Karangdowo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(439, 40, 'Kayulemah', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(440, 40, 'Kedungrejo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(441, 40, 'Margoagung', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(442, 40, 'Mejuwet', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(443, 40, 'Mlinjeng', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(444, 40, 'Ngampal', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(445, 40, 'Pejambon', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(446, 40, 'Pekuwon', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(447, 40, 'Prayungan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(448, 40, 'Sambongrejo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(449, 40, 'Sendangagung', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(450, 40, 'Sumberharjo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(451, 40, 'Sumberejo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(452, 40, 'Sumuragung', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(453, 40, 'Talun', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(454, 40, 'Teleng', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(455, 40, 'Tlogohaji', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(456, 40, 'Tulungrejo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(457, 40, 'Wotan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(458, 41, 'Bakalan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(459, 41, 'Dolokgede', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(460, 41, 'Gading', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(461, 41, 'Gamongan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(462, 41, 'Jatimulyo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(463, 41, 'Jawik', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(464, 41, 'Kacangan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(465, 41, 'Kalisumber', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(466, 41, 'Malingmati', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(467, 41, 'Mulyorejo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(468, 41, 'Napis', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(469, 41, 'Ngrancang', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(470, 41, 'Pengkol', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(471, 41, 'Sendangrejo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(472, 41, 'Sukorejo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(473, 41, 'Tambakrejo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(474, 41, 'Tanjung', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(475, 41, 'Turi', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(476, 42, 'Bakulan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(477, 42, 'Belun', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(478, 42, 'Buntalan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(479, 42, 'Jono', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(480, 42, 'Kedungsari', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(481, 42, 'Kedungsumber', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(482, 42, 'Ngujung', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(483, 42, 'Pancur', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(484, 42, 'Pandantoyo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(485, 42, 'Papringan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(486, 42, 'Soko', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(487, 42, 'Temayang', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(488, 43, 'Banjarsari', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(489, 43, 'Guyangan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(490, 43, 'Kandangan', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(491, 43, 'Kanten', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(492, 43, 'Mori', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(493, 43, 'Padang', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(494, 43, 'Pagerwesi', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(495, 43, 'Sranak', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(496, 43, 'Sumbangtimun', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(497, 43, 'Sumberejo', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(498, 43, 'Trucuk', '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL),
(499, 43, 'Tulungrejo', '2026-03-04 21:16:01', '2026-03-04 21:16:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dokumens`
--

CREATE TABLE `dokumens` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran_file` bigint UNSIGNED NOT NULL,
  `jumlah_download` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumens`
--

INSERT INTO `dokumens` (`id`, `nama_dokumen`, `deskripsi`, `file`, `ukuran_file`, `jumlah_download`, `created_at`, `updated_at`) VALUES
(1, 'Laporan Keuangan 2026', 'Tess', 'dokumens/0237b871-7f44-4ed4-a412-3af6ab398b16.pdf', 1081701, 1, '2026-03-05 23:26:13', '2026-03-05 23:26:22');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `nama`, `latitude`, `longitude`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 'Balen', NULL, NULL, '2026-03-04 21:15:54', '2026-03-04 21:15:54', NULL),
(17, 'Baureno', NULL, NULL, '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(18, 'Bojonegoro', -7.18000000, 111.88000000, '2026-03-04 21:15:55', '2026-03-05 09:19:04', NULL),
(19, 'Bubulan', -7.23000000, 111.85000000, '2026-03-04 21:15:55', '2026-03-05 09:19:04', NULL),
(20, 'Dander', NULL, NULL, '2026-03-04 21:15:55', '2026-03-04 21:15:55', NULL),
(21, 'Gayam', -7.35000000, 111.95000000, '2026-03-04 21:15:56', '2026-03-05 09:19:04', NULL),
(22, 'Gondang', -7.26000000, 111.78000000, '2026-03-04 21:15:56', '2026-03-05 09:19:04', NULL),
(23, 'Kalitidu', -7.12000000, 111.93000000, '2026-03-04 21:15:56', '2026-03-05 09:19:04', NULL),
(24, 'Kanor', -7.30000000, 111.90000000, '2026-03-04 21:15:56', '2026-03-05 09:19:04', NULL),
(25, 'Kapas', NULL, NULL, '2026-03-04 21:15:56', '2026-03-04 21:15:56', NULL),
(26, 'Kasiman', NULL, NULL, '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(27, 'Kedewan', NULL, NULL, '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(28, 'Kedungadem', NULL, NULL, '2026-03-04 21:15:57', '2026-03-04 21:15:57', NULL),
(29, 'Kepohbaru', -7.30000000, 111.82000000, '2026-03-04 21:15:57', '2026-03-05 09:19:04', NULL),
(30, 'Margomulyo', -7.29000000, 112.01000000, '2026-03-04 21:15:58', '2026-03-05 09:19:04', NULL),
(31, 'Malo', NULL, NULL, '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(32, 'Ngambon', -7.18000000, 111.75000000, '2026-03-04 21:15:58', '2026-03-05 09:19:04', NULL),
(33, 'Ngasem', NULL, NULL, '2026-03-04 21:15:58', '2026-03-04 21:15:58', NULL),
(34, 'Ngraho', -7.40000000, 111.85000000, '2026-03-04 21:15:58', '2026-03-05 09:19:04', NULL),
(35, 'Padangan', NULL, NULL, '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(36, 'Purwosari', NULL, NULL, '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(37, 'Sekar', NULL, NULL, '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(38, 'Sugihwaras', NULL, NULL, '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(39, 'Sukosewu', NULL, NULL, '2026-03-04 21:15:59', '2026-03-04 21:15:59', NULL),
(40, 'Sumberejo', -7.25000000, 111.72000000, '2026-03-04 21:15:59', '2026-03-05 09:19:04', NULL),
(41, 'Tambakrejo', -7.22000000, 111.97000000, '2026-03-04 21:16:00', '2026-03-05 09:19:04', NULL),
(42, 'Temayang', -7.08000000, 111.90000000, '2026-03-04 21:16:00', '2026-03-05 09:19:04', NULL),
(43, 'Trucuk', NULL, NULL, '2026-03-04 21:16:00', '2026-03-04 21:16:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanans`
--

CREATE TABLE `laporan_bulanans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_bulanans`
--

INSERT INTO `laporan_bulanans` (`id`, `nama_laporan`, `file_laporan`, `created_at`, `updated_at`) VALUES
(1, 'Laporan Maret 2026', '1772682675_laporan-sarpras-2026-02-07-204758.pdf', '2026-03-04 20:51:15', '2026-03-04 20:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_mwcs`
--

CREATE TABLE `laporan_mwcs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_mwcs`
--

INSERT INTO `laporan_mwcs` (`id`, `nama`, `file_laporan`, `created_at`, `updated_at`) VALUES
(1, 'Laporan MWC dan Ranting Se Bojonegoro', '1772682738_laporan-sarpras-2026-02-07-204816.pdf', '2026-03-04 20:52:18', '2026-03-04 20:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_tahunans`
--

CREATE TABLE `laporan_tahunans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_tahunans`
--

INSERT INTO `laporan_tahunans` (`id`, `nama`, `link_from`, `created_at`, `updated_at`) VALUES
(1, 'Balen', 'https://share.google/k1Qu2zqrpgFVlPhUf', '2026-03-04 20:55:16', '2026-03-05 23:32:52');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_14_170933_add_two_factor_columns_to_users_table', 1),
(5, '2026_02_14_142812_create_profiles_table', 1),
(6, '2026_02_14_150749_create_missions_table', 1),
(7, '2026_02_14_150827_create_pillars_table', 1),
(8, '2026_02_15_150400_create_categories_table', 1),
(9, '2026_02_15_150414_create_news_table', 1),
(10, '2026_02_16_112443_create_rekenings_table', 1),
(11, '2026_02_16_122200_add_icon_to_rekenings_table', 1),
(12, '2026_02_16_133529_create_dokuemens_table', 1),
(13, '2026_02_18_064620_create_programs_table', 1),
(14, '2026_02_18_064642_create_transactions_table', 1),
(15, '2026_02_18_064704_create_payment_confirmations_table', 1),
(16, '2026_02_18_065021_create_settings_table', 1),
(17, '2026_02_19_073443_create_penguruses_table', 1),
(18, '2026_02_24_175305_create_qurban_periods_table', 1),
(19, '2026_02_24_175325_create_qurban_hewans_table', 1),
(20, '2026_02_24_175344_create_qurban_registrations_table', 1),
(21, '2026_02_24_175403_create_qurban_payment_confirmations_table', 1),
(22, '2026_03_01_050222_create_laporan_bulanans_table', 1),
(23, '2026_03_01_054146_create_laporan_mwcs_table', 1),
(24, '2026_03_01_144501_create_laporan_tahunans_table', 1),
(25, '2026_03_04_032817_create_kecamatans_table', 1),
(26, '2026_03_04_032926_create_desas_table', 1),
(27, '2026_03_04_033401_update_transactions_table', 1),
(28, '2026_03_05_045606_create_mustahiks_table', 2),
(29, '2026_03_05_161739_add_coordinates_to_kecamatans', 3),
(30, '2026_03_06_002135_add_production_indexes_to_tables', 4);

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `id` bigint UNSIGNED NOT NULL,
  `profile_id` bigint UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`id`, `profile_id`, `text`, `urutan`, `created_at`, `updated_at`) VALUES
(23, 1, 'Menghimpun dana zakat, infaq dan shadaqah secara optimal', 0, '2026-03-05 23:17:44', '2026-03-05 23:17:44'),
(24, 1, 'Mengelola dana secara transparan dan akuntabel', 1, '2026-03-05 23:17:44', '2026-03-05 23:17:44'),
(25, 1, 'Mendorong pemberdayaan ekonomi umat', 2, '2026-03-05 23:17:44', '2026-03-05 23:17:44'),
(26, 1, 'Menguatkan layanan sosial dan kemanusiaan', 3, '2026-03-05 23:17:44', '2026-03-05 23:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `mustahiks`
--

CREATE TABLE `mustahiks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` bigint UNSIGNED NOT NULL,
  `desa_id` bigint UNSIGNED NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_asnaf` enum('fakir','miskin','amil','muallaf','riqab','gharim','fisabilillah','ibnu_sabil') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mustahiks`
--

INSERT INTO `mustahiks` (`id`, `nama`, `nik`, `jenis_kelamin`, `kecamatan_id`, `desa_id`, `no_hp`, `kategori_asnaf`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dicky', '3235523532443552', 'laki-laki', 32, 330, '085747988212', 'amil', 'aktif', '2026-03-04 22:34:01', '2026-03-05 00:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payment_confirmations`
--

CREATE TABLE `payment_confirmations` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rekening_pengirim` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_transfer` bigint UNSIGNED NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'path file bukti pembayaran',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_confirmations`
--

INSERT INTO `payment_confirmations` (`id`, `transaction_id`, `nama_pengirim`, `bank_pengirim`, `nomor_rekening_pengirim`, `jumlah_transfer`, `tanggal_transfer`, `bukti_transfer`, `catatan`, `created_at`, `updated_at`) VALUES
(2, 1, 'Dicky Adi Saputra Anjay', 'Mandiri', '8234732947289', 3750000, '2026-03-04', 'payment-confirmations/2026/03/Fozo5ZKbb3tffkl8HsIVlchszayAGfUKpDUvct5f.jpg', NULL, '2026-03-04 09:03:59', '2026-03-04 09:03:59'),
(3, 3, 'Dicky Adi Saputra', 'Mandiri', '8234732947289', 25000, '2026-03-05', 'payment-confirmations/2026/03/sDFmKDjO4WWjvWFMzcD8muzwn5qHd8SAbo5ApJ93.jpg', NULL, '2026-03-04 23:32:02', '2026-03-04 23:32:02'),
(4, 4, 'Dicky Adi Saputra', 'Mandiri', '8234732947289', 25000, '2026-03-06', 'payment-confirmations/2026/03/4xsCp6qe8bjhgCJDKRPmaFWf0LBMdJUcUQDkQmWW.jpg', NULL, '2026-03-05 23:39:52', '2026-03-05 23:39:52'),
(5, 5, 'Dicky Adi Saputra', 'Mandiri', '8234732947289', 100000, '2026-03-06', 'payment-confirmations/2026/03/csnZNJkKdsiXKkJn875iDqJSMXbq8Gy6DvkWZBzq.png', NULL, '2026-03-05 23:57:30', '2026-03-05 23:57:30'),
(6, 6, 'Dicky Adi Saputra', 'Mandiri', '8234732947289', 200000, '2026-03-06', 'payment-confirmations/2026/03/BU3kYHH4EH44SRdYVEj9ZMcBmxIzTEKrUac6yFXA.png', 'YTDGDYYCGJ', '2026-03-05 23:58:59', '2026-03-05 23:58:59'),
(7, 7, 'Dicky Adi Saputra', 'Mandiri', '8234732947289', 100000, '2026-03-06', 'payment-confirmations/2026/03/3BZtOKBi3VppR8oYm6WHFBRU3A5ZnVPzpQGoPrSI.png', NULL, '2026-03-06 00:02:09', '2026-03-06 00:02:09'),
(8, 8, 'Dicky Adi Saputra Anjay', 'Mandiri', '8234732947289', 25000, '2026-03-06', 'payment-confirmations/2026/03/MTFczwMMoVarU8kKS9fBbtwJtFe1pzf7YOkhYzcH.png', NULL, '2026-03-06 00:03:57', '2026-03-06 00:03:57'),
(9, 9, 'Dicky Adi Saputra', 'Mandiri', '8234732947289', 3750000, '2026-03-06', 'payment-confirmations/2026/03/h7CcQXx67Jddn5BBwurhIIS76dYbYpNcQ80UpPGr.png', NULL, '2026-03-06 00:12:42', '2026-03-06 00:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gelar_depan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gelar_belakang` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` enum('Ketua','Wakil Ketua','Sekretaris','Wakil Sekretaris','Anggota') COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Diisi jika jabatan = Anggota',
  `urutan` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Urutan tampil',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `masa_khidmat_mulai` year NOT NULL,
  `masa_khidmat_selesai` year NOT NULL,
  `no_sk` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nomor SK pengangkatan',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id`, `nama`, `gelar_depan`, `gelar_belakang`, `jabatan`, `bidang`, `urutan`, `foto`, `no_hp`, `email`, `masa_khidmat_mulai`, `masa_khidmat_selesai`, `no_sk`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Eko Arief Cahyono, M. Ek', NULL, NULL, 'Ketua', NULL, 0, NULL, NULL, NULL, '2025', '2030', 'SK PCNU Kabupaten Bojonegoro Nomor :  265/PC.01/A.II.01.07/1614/01/2026', 1, '2026-03-04 20:24:19', '2026-03-04 20:24:19', NULL),
(2, 'Arya Sabila, S.Sy., M. Pd', NULL, NULL, 'Wakil Ketua', NULL, 0, NULL, NULL, NULL, '2025', '2030', NULL, 1, '2026-03-04 20:24:36', '2026-03-04 20:24:36', NULL),
(3, 'Ahmad Toha Hasan, S.Pd.', NULL, NULL, 'Wakil Ketua', NULL, 0, NULL, NULL, NULL, '2025', '2030', NULL, 1, '2026-03-04 20:24:58', '2026-03-04 20:24:58', NULL),
(4, 'Miftahul Mufid, M. Pd.I', NULL, NULL, 'Sekretaris', NULL, 0, NULL, NULL, NULL, '2025', '2030', NULL, 1, '2026-03-04 20:25:18', '2026-03-04 20:25:18', NULL),
(5, 'Bagus Novianto, M.Pd.', NULL, NULL, 'Wakil Sekretaris', NULL, 0, NULL, NULL, NULL, '2025', '2030', NULL, 1, '2026-03-04 20:25:33', '2026-03-04 20:25:33', NULL),
(6, 'Imam Ja’far Shodiq, M.Pd', NULL, NULL, 'Anggota', 'Pengumpulan dan Kerjasama', 0, NULL, NULL, NULL, '2025', '2030', NULL, 1, '2026-03-04 20:26:08', '2026-03-04 20:26:08', NULL),
(7, 'Nur Rodhi’in, S.E., M.M', NULL, NULL, 'Anggota', 'Penyaluran dan Pemberdayaan', 0, NULL, NULL, NULL, '2025', '2030', NULL, 1, '2026-03-04 20:26:40', '2026-03-04 20:26:40', NULL),
(8, 'Aniyatus Shofiyah, SE, M.Ak', NULL, NULL, 'Anggota', 'IT dan Marcom', 0, NULL, NULL, NULL, '2025', '2030', NULL, 1, '2026-03-04 20:26:59', '2026-03-04 20:26:59', NULL),
(9, 'Nanin Verina Widya Putri, M.Pd .', NULL, NULL, 'Anggota', 'SDM dan Kelembagaan', 0, NULL, NULL, NULL, '2025', '2030', NULL, 1, '2026-03-04 20:27:20', '2026-03-04 20:27:20', NULL),
(10, 'Dicky Adi', NULL, NULL, 'Wakil Ketua', NULL, 0, NULL, NULL, NULL, '2025', '2030', NULL, 1, '2026-03-05 23:18:26', '2026-03-05 23:18:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pillars`
--

CREATE TABLE `pillars` (
  `id` bigint UNSIGNED NOT NULL,
  `profile_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pillars`
--

INSERT INTO `pillars` (`id`, `profile_id`, `title`, `deskripsi`, `urutan`, `created_at`, `updated_at`) VALUES
(27, 1, 'NUCARE CERDAS', '(1) Beasiswa tingkat MI,MTS, MA (2)\r\nBeasiswa Sarjana NU (3) Beasiswa Guru NU\r\n(4) Beasiswa Santri. (5) Pelatihan /\r\nWorkshop Guru NU (6) Madrasah Amil', 0, '2026-03-05 23:17:44', '2026-03-05 23:17:44'),
(28, 1, 'NUCARE BERDAYA', '(1) Bantuan modal usaha (2) Bantuan alat\r\nkerja atau usaha seperti gerobak, rengkek\r\n(3) Bantuan Ternak', 1, '2026-03-05 23:17:44', '2026-03-05 23:17:44'),
(29, 1, 'NUCARE SEHAT', '(1) bantuan pengobatan bagi fakir miskin\r\ndan dhuafa (2) Bantuan alat bantu medis\r\nseperti kursi roda, Kacamata, Tabung\r\noksigen ambulance, Kursi tandu ambulance\r\n(3) Gerakan Sehat Pesantren & Masjid NU', 2, '2026-03-05 23:17:44', '2026-03-05 23:17:44'),
(30, 1, 'NUCARE DAMAI', '(1) Santunan Yatim, Piatu dan Dhuafa (2)\r\nBantuan Sosial Kemanusian dan Tanggap\r\nBencana (3) Bedah Rumah Dhuafa (4)\r\nProgram Dakwah dan Keagamaan', 3, '2026-03-05 23:17:44', '2026-03-05 23:17:44'),
(31, 1, 'NUCARE HIJAU', '(1) Sedekah pohon dan Reboisasi (2)\r\nPesantren dan Masjid Hijau', 4, '2026-03-05 23:17:44', '2026-03-05 23:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `tahun_berdiri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerima_manfaat` bigint NOT NULL DEFAULT '0',
  `program_tersalurkan` int NOT NULL DEFAULT '0',
  `visi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `title`, `deskripsi`, `tahun_berdiri`, `penerima_manfaat`, `program_tersalurkan`, `visi`, `created_at`, `updated_at`) VALUES
(1, 'PCNU Lazisnu Bojonegoro', 'Potensi zakat Lembaga Amil Zakat Infak dan Sedekah Nahdlatul Ulama Kabupaten Bojonegoro yang besar dapat dioptimalkan melalui penguatan tata kelola digital yang transparan dan akuntabel guna meningkatkan kepercayaan Muzakki serta dampak bagi Mustahik. Potensi zakat (Dukungan warga Nahdliyin yang luas mulai dari ranting dan MWCNU), beragamnya segmen\r\nMuzakki seperti Aparatur Sipil Negara (ASN) NU, Guru NU, Pengusaha, Corporate serta masjid maupun lembaga pendidikan Ma’arif di tingkat kecamatan dan Desa)', '2014', 1000, 1000, 'Menjadi lembaga filantropi Islam terpercaya, modern, profesional dan berdampak luas bagi kemaslahatan umat.', '2026-02-18 02:47:36', '2026-03-05 23:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('infaq','donasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` longtext COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_dana` bigint UNSIGNED DEFAULT NULL COMMENT 'null = tidak ada target',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL COMMENT 'null = program berkelanjutan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `type`, `nama`, `slug`, `deskripsi`, `konten`, `thumbnail`, `target_dana`, `is_active`, `is_featured`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'donasi', 'Tess', 'tess', 'tesss', 'Tess', 'programs/thumbnails/389z9pRnzvuqEKcAai76reR9LNsV3SsfCWM87Ckn.webp', NULL, 1, 0, '2026-02-18', '2026-02-26', '2026-02-18 02:58:06', '2026-02-18 02:59:01', '2026-02-18 02:59:01'),
(2, 'donasi', 'Tess', 'tess-2', 'tesss', 'Tess', 'programs/thumbnails/SyUIaplTTzpHnjKzZ2mtTn2VvXpUBIAT1HCc8UZr.webp', NULL, 1, 0, '2026-02-18', '2026-02-26', '2026-02-18 02:58:25', '2026-02-18 03:15:26', '2026-02-18 03:15:26'),
(3, 'infaq', 'Donasi Bencana Alam', 'donasi-bencana-alam', 'Bencana alam merupakan peristiwa yang terjadi akibat faktor alam yang dapat menimbulkan kerusakan lingkungan, kerugian harta benda, serta korban jiwa. Sebagai bentuk kepedulian terhadap masyarakat yang terdampak bencana, LAZISNU Bojonegoro turut hadir memberikan bantuan kemanusiaan melalui penyaluran zakat, infak, dan sedekah berupa bantuan logistik, kebutuhan pokok, serta dukungan bagi para korban agar dapat meringankan beban dan membantu proses pemulihan pascabencana.', 'Bencana alam merupakan peristiwa yang terjadi akibat faktor alam maupun aktivitas manusia yang dapat menimbulkan kerusakan lingkungan, kerugian harta benda, serta korban jiwa. Di wilayah Indonesia, berbagai jenis bencana seperti banjir, tanah longsor, angin puting beliung, dan kekeringan sering terjadi dan berdampak langsung pada kehidupan masyarakat.\r\n\r\nSebagai lembaga sosial dan kemanusiaan, LAZISNU Bojonegoro memiliki peran penting dalam membantu masyarakat yang terdampak bencana. Melalui program kemanusiaan dan penyaluran dana zakat, infak, dan sedekah, LAZISNU Bojonegoro berupaya memberikan bantuan secara cepat dan tepat kepada para korban.\r\n\r\nBantuan yang diberikan dapat berupa distribusi sembako, bantuan logistik, layanan kesehatan, perbaikan tempat tinggal, serta dukungan psikososial bagi masyarakat terdampak. Selain itu, LAZISNU Bojonegoro juga berupaya meningkatkan kesadaran masyarakat tentang pentingnya solidaritas sosial dan kepedulian terhadap sesama.\r\n\r\nDengan semangat gotong royong dan nilai-nilai kemanusiaan, LAZISNU Bojonegoro berkomitmen untuk terus hadir di tengah masyarakat, membantu meringankan beban para korban bencana, serta mendukung proses pemulihan agar masyarakat dapat kembali menjalani kehidupan dengan lebih baik.', 'programs/thumbnails/TyqaFPEIVUtb4plPS2H3NHS8Qn2DgApjfcZv8cry.jpg', 50000000, 1, 1, '2026-02-18', '2026-02-26', '2026-02-18 03:20:58', '2026-03-05 23:56:23', '2026-03-05 23:56:23'),
(4, 'infaq', 'Infaq Guru', 'infaq-guru', 'tess', 'tess', 'programs/thumbnails/s0QXjWYQ5JaMrdsWG0OMSHOq9B2oQKW1vU9So2RS.jpg', 20000000, 1, 0, '2026-02-19', '2026-02-23', '2026-02-18 03:21:27', '2026-03-04 20:33:38', '2026-03-04 20:33:38'),
(5, 'infaq', 'Bank Jago', 'bank-jago', 'fa', 'sacac', 'programs/thumbnails/OeIAQOz8ToCTmzsNYUNVXIpvbGuLtbCJ88pdr0gH.png', NULL, 1, 0, '2026-03-04', NULL, '2026-03-04 09:12:22', '2026-03-04 20:33:42', '2026-03-04 20:33:42'),
(6, 'donasi', 'Donasi Bencana Sumatra', 'donasi-bencana-sumatra', 'Bencana alam yang terjadi di wilayah Sumatra telah menyebabkan kerusakan lingkungan serta berdampak pada kehidupan masyarakat setempat. Sebagai bentuk kepedulian dan solidaritas kemanusiaan, LAZISNU Bojonegoro menyalurkan bantuan melalui program kemanusiaan berupa dukungan logistik, kebutuhan pokok, dan bantuan lainnya bagi para korban terdampak bencana.', 'Bencana alam yang terjadi di wilayah Sumatra telah menyebabkan kerusakan lingkungan serta berdampak pada kehidupan masyarakat setempat. Sebagai bentuk kepedulian dan solidaritas kemanusiaan, LAZISNU Bojonegoro menyalurkan bantuan melalui program kemanusiaan berupa dukungan logistik, kebutuhan pokok, dan bantuan lainnya bagi para korban terdampak bencana.', 'programs/thumbnails/NK9XxmDiUUDj2w4gP4GFHgHIsAF7yl3tmx5ALZCT.jpg', 50000000, 1, 1, '2026-03-05', '2026-04-05', '2026-03-04 20:36:17', '2026-03-06 00:01:07', NULL),
(7, 'infaq', 'Infaq Guru Madin', 'infaq-guru-madin', 'Program Guru Madin merupakan bentuk kepedulian terhadap para guru Madrasah Diniyah yang telah berperan dalam mendidik dan menanamkan nilai-nilai keislaman kepada generasi muda. Melalui program ini, LAZISNU Bojonegoro menyalurkan bantuan sebagai bentuk apresiasi dan dukungan kepada para guru Madin agar tetap semangat dalam mengabdikan diri dalam dunia pendidikan keagamaan', 'Program Guru Madin merupakan bentuk kepedulian terhadap para guru Madrasah Diniyah yang telah berperan dalam mendidik dan menanamkan nilai-nilai keislaman kepada generasi muda. Melalui program ini, LAZISNU Bojonegoro menyalurkan bantuan sebagai bentuk apresiasi dan dukungan kepada para guru Madin agar tetap semangat dalam mengabdikan diri dalam dunia pendidikan keagamaan', 'programs/thumbnails/4jlV1nDhpSQiAQSH5unFcZfrjLwx2kGGVE2cckTf.jpg', NULL, 1, 0, '2026-03-05', NULL, '2026-03-04 20:39:05', '2026-03-06 00:01:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qurban_hewans`
--

CREATE TABLE `qurban_hewans` (
  `id` bigint UNSIGNED NOT NULL,
  `period_id` bigint UNSIGNED NOT NULL,
  `jenis` enum('sapi','unta','kambing','domba') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `berat_estimasi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_total` bigint UNSIGNED NOT NULL,
  `harga_per_slot` bigint UNSIGNED NOT NULL,
  `max_peserta` tinyint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qurban_hewans`
--

INSERT INTO `qurban_hewans` (`id`, `period_id`, `jenis`, `nama`, `deskripsi`, `berat_estimasi`, `gambar`, `harga_total`, `harga_per_slot`, `max_peserta`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'sapi', 'Sapi Gemuk', 'Sapi qurban jenis limosin dengan kondisi sehat, cukup umur, dan memenuhi syarat syariat untuk ibadah qurban. Estimasi berat 350–400 kg dan dapat diikuti maksimal 7 peserta qurban.', '350–400 kg', 'qurban/hewan/4wVgGQwCSG3xxnKmzhUQOC6djasvfvRd4dQVxYLP.jpg', 21000000, 3000000, 7, 1, '2026-03-04 20:43:14', '2026-03-04 20:49:01', NULL),
(2, 1, 'kambing', 'Kambing', 'Kambing qurban jenis Etawa dengan kondisi sehat, cukup umur, dan memenuhi syarat untuk ibadah qurban. Perawatan baik dan siap disembelih pada Hari Raya Idul Adha. Program qurban ini disalurkan oleh LAZISNU Bojonegoro kepada masyarakat yang membutuhkan.', '35–40 kg', 'qurban/hewan/4hnPmRRQwiy3T9GyysoB4bqtdc7kMox7TdUCJ6Yb.jpg', 3200000, 3200000, 1, 1, '2026-03-04 20:46:27', '2026-03-04 20:46:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qurban_payment_confirmations`
--

CREATE TABLE `qurban_payment_confirmations` (
  `id` bigint UNSIGNED NOT NULL,
  `registration_id` bigint UNSIGNED NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rekening_pengirim` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_transfer` bigint UNSIGNED NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qurban_payment_confirmations`
--

INSERT INTO `qurban_payment_confirmations` (`id`, `registration_id`, `nama_pengirim`, `bank_pengirim`, `nomor_rekening_pengirim`, `jumlah_transfer`, `tanggal_transfer`, `bukti_transfer`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dicky', 'Mandiri', '8234732947289', 3200000, '2026-03-06', 'qurban-confirmations/2026/03/RNfeTilyLEngDlynDe0vCF3UX8hYTnKrbLN0o1aA.jpg', NULL, '2026-03-06 00:22:00', '2026-03-06 00:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `qurban_periods`
--

CREATE TABLE `qurban_periods` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` smallint NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal_buka` date DEFAULT NULL,
  `tanggal_tutup` date DEFAULT NULL,
  `tanggal_pelaksanaan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qurban_periods`
--

INSERT INTO `qurban_periods` (`id`, `nama`, `tahun`, `deskripsi`, `is_active`, `tanggal_buka`, `tanggal_tutup`, `tanggal_pelaksanaan`, `created_at`, `updated_at`) VALUES
(1, 'Idul Adha 2026 M / 14447 H', 2026, 'Program Qurban 2026 / 1447 H merupakan kegiatan penyaluran hewan qurban kepada masyarakat yang membutuhkan sebagai bentuk kepedulian dan ibadah kepada Allah SWT. Melalui program ini, LAZISNU Bojonegoro menghimpun dan menyalurkan hewan qurban agar dapat memberikan manfaat yang lebih luas bagi masyarakat, khususnya bagi mereka yang membutuhkan.', 1, '2026-03-05', '2026-05-01', '2026-05-26', '2026-03-04 20:41:32', '2026-03-06 00:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `qurban_registrations`
--

CREATE TABLE `qurban_registrations` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_registrasi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hewan_id` bigint UNSIGNED NOT NULL,
  `period_id` bigint UNSIGNED NOT NULL,
  `nama_peserta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `jumlah_slot` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `harga_per_slot` bigint UNSIGNED NOT NULL,
  `total_bayar` bigint UNSIGNED NOT NULL,
  `status` enum('pending','confirmed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `confirmed_by` bigint UNSIGNED DEFAULT NULL,
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qurban_registrations`
--

INSERT INTO `qurban_registrations` (`id`, `kode_registrasi`, `hewan_id`, `period_id`, `nama_peserta`, `atas_nama`, `email`, `telepon`, `alamat`, `catatan`, `jumlah_slot`, `harga_per_slot`, `total_bayar`, `status`, `catatan_admin`, `confirmed_at`, `confirmed_by`, `payment_gateway`, `gateway_transaction_id`, `gateway_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'QRB-20260306-C3DA64', 2, 1, 'Dicky', 'Dicky A', 'diki@gmail.com', '085182529291', 'Balen', NULL, 1, 3200000, 3200000, 'confirmed', NULL, '2026-03-06 00:22:35', 2, NULL, NULL, NULL, '2026-03-06 00:16:01', '2026-03-06 00:22:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekenings`
--

CREATE TABLE `rekenings` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekenings`
--

INSERT INTO `rekenings` (`id`, `nama`, `bank_atas_nama`, `nomor_rekening`, `icon`, `created_at`, `updated_at`) VALUES
(6, 'BSI (Bank Syariah Indonesia) ZAKAT', 'ZAKAT LAZIZNU PCNU BOJONEGORO', '7342703016', 'rekenings/d597c4f7-f614-40c8-a8a3-951810763167.jpg', '2026-02-18 03:59:45', '2026-02-18 08:01:43'),
(7, 'BSI (Bank Syariah Indonesia) INFAQ', 'INFAQ LAZIZNU PCNU BOJONEGORO', '7342699566', 'rekenings/b55e98e6-ad6d-4d32-bb51-bd8dda290203.jpg', '2026-02-18 04:01:07', '2026-02-18 08:01:51'),
(8, 'BRI (Bank Rakyat Indonesia)', 'LAZIZNU PCNU BOJONEGORO', '001101004793569', 'rekenings/G23T58tWaKTS7i5mNH1b808Hb4z4JQ877Ca7rM2H.png', '2026-02-18 04:03:03', '2026-02-18 04:03:03');

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
('F1VbX9KspLRoGhMKpep03xqBxYcxP2viU30ov73z', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTHRwSGt2Qk1TblprOHFjemFhSDRSVzhscmJYSUE1UGc5cG0zUzdOaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kb25hc2kiO3M6NToicm91dGUiO3M6MTI6ImRvbmFzaS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1772899853),
('Kbq9EQUW7Fdjk2uONok7SnEjf4Rv28tY8bqVMb1L', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2EzZHpISm96WFpkVHBWYkI0eDR1VDZCRzNTbEZsNldqMjZIR28wdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1772952807),
('uxBl1lKb3yjOagZHyHQzkpj7MXwwWsBYYfBsCYPU', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiamN3dk14QVZUYlBoVUYzZ1MwajNSUkcyR0VqYWdTYVNoc3lVaUF0VCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYXBvcmFuL2V4cG9ydC1kc2tsIjtzOjU6InJvdXRlIjtzOjE5OiJsYXBvcmFuLmV4cG9ydC1kc2tsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjQxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc2V0dGluZ3MvdHdvLWZhY3RvciI7fX0=', 1772899857);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `label`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'fidyah_price_per_day', '25000', 'fidyah', 'Harga Fidyah Per Hari', 'Nilai fidyah per hari dalam rupiah (setara 1 mud makanan pokok)', '2026-02-18 08:18:00', '2026-03-06 00:03:23'),
(2, 'zakat_fitrah_uang_per_jiwa', '25000', 'zakat', 'Zakat Fitrah Per Jiwa (Uang)', 'Nilai zakat fitrah dalam bentuk uang per jiwa (setara 2.5kg beras)', '2026-02-18 08:18:00', '2026-02-18 08:27:18'),
(3, 'zakat_fitrah_beras_kg', '2.5', 'zakat', 'Zakat Fitrah Beras (kg)', 'Ukuran beras untuk zakat fitrah per jiwa dalam kg', '2026-02-18 08:18:00', '2026-02-18 08:18:00'),
(4, 'nisab_emas_gram', '85', 'zakat', 'Nisab Emas (gram)', 'Batas nisab zakat mal setara gram emas', '2026-02-18 08:18:00', '2026-02-18 08:18:00'),
(5, 'harga_emas_per_gram', '2,912,000', 'zakat', 'Harga Emas Per Gram (Rp)', 'Harga emas terkini per gram untuk perhitungan nisab. Update berkala.', '2026-02-18 08:18:00', '2026-02-18 08:28:47'),
(6, 'zakat_mal_persen', '2.5', 'zakat', 'Persentase Zakat Mal (%)', 'Persentase zakat mal dari total harta yang sudah mencapai nisab', '2026-02-18 08:18:00', '2026-02-18 08:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('zakat','infaq','donasi','fidyah') COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` bigint UNSIGNED DEFAULT NULL,
  `nama_donatur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_anonim` tinyint(1) NOT NULL DEFAULT '0',
  `jumlah` bigint UNSIGNED NOT NULL,
  `metadata` json DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','confirmed','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `confirmed_by` bigint UNSIGNED DEFAULT NULL,
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'midtrans|xendit|dll',
  `gateway_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `kecamatan_id` bigint UNSIGNED DEFAULT NULL,
  `desa_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `kode_transaksi`, `type`, `program_id`, `nama_donatur`, `email`, `telepon`, `is_anonim`, `jumlah`, `metadata`, `catatan`, `status`, `confirmed_at`, `confirmed_by`, `catatan_admin`, `payment_gateway`, `gateway_transaction_id`, `gateway_status`, `created_at`, `updated_at`, `deleted_at`, `kecamatan_id`, `desa_id`) VALUES
(1, 'ZKT-20260304-76A867', 'zakat', NULL, 'Hamba Allah', 'dickycoding@gmail.com', '085182529291', 1, 3750000, '{\"jenis\": \"mal\", \"persen\": 2.5, \"nisab_rp\": 170, \"nilai_harta\": 150000000}', NULL, 'confirmed', '2026-03-04 09:07:23', 2, NULL, NULL, NULL, NULL, '2026-03-04 09:02:25', '2026-03-04 09:07:23', NULL, NULL, NULL),
(2, 'IFQ-20260304-619E1C', 'infaq', 5, 'Hamba Allah', 'dickycoding@gmail.com', '085182529291', 1, 100000, '{\"program_nama\": \"Bank Jago\"}', NULL, 'confirmed', '2026-03-04 23:32:15', 2, NULL, NULL, NULL, NULL, '2026-03-04 09:12:46', '2026-03-04 23:32:15', NULL, NULL, NULL),
(3, 'ZKT-20260305-473CEB', 'zakat', NULL, 'Dicky Adi Saputra', 'dickycoding@gmail.com', '085182529291', 0, 25000, '{\"jenis\": \"fitrah\", \"jumlah_jiwa\": 1, \"harga_per_jiwa\": 25000}', NULL, 'confirmed', '2026-03-04 23:32:22', 2, NULL, NULL, NULL, NULL, '2026-03-04 23:31:48', '2026-03-04 23:32:22', NULL, 32, 330),
(4, 'ZKT-20260306-CD0669', 'zakat', NULL, 'Hamba Allah', 'admin@gmail.com', '085182529291', 1, 25000, '{\"jenis\": \"fitrah\", \"jumlah_jiwa\": 1, \"harga_per_jiwa\": 25000}', NULL, 'confirmed', '2026-03-05 23:41:06', NULL, NULL, NULL, NULL, NULL, '2026-03-05 23:39:29', '2026-03-05 23:41:06', NULL, 22, 169),
(5, 'IFQ-20260306-E15DBD', 'infaq', 7, 'Dicky Adi Saputra', 'diki@gmail.com', '085182529291', 0, 100000, '{\"program_nama\": \"Infaq Guru Madin\"}', NULL, 'confirmed', '2026-03-05 23:58:17', 2, NULL, NULL, NULL, NULL, '2026-03-05 23:57:03', '2026-03-05 23:58:17', NULL, NULL, NULL),
(6, 'IFQ-20260306-E258FB', 'infaq', 7, 'Hamba Allah', 'diki@gmail.com', '085182529291', 1, 200000, '{\"program_nama\": \"Infaq Guru Madin\"}', 'SNSQIGQ', 'rejected', NULL, 2, 'JYVJH', NULL, NULL, NULL, '2026-03-05 23:58:39', '2026-03-05 23:59:33', NULL, NULL, NULL),
(7, 'DNS-20260306-12F778', 'donasi', 6, 'Hamba Allah', 'dickycoding@gmail.com', '085182529291', 1, 100000, '{\"program_nama\": \"Donasi Bencana Sumatra\"}', 'ewsggg', 'confirmed', '2026-03-06 00:02:49', 2, NULL, NULL, NULL, NULL, '2026-03-06 00:01:53', '2026-03-06 00:02:49', NULL, NULL, NULL),
(8, 'FDY-20260306-9CBA46', 'fidyah', NULL, 'Hamba Allah', 'dickycoding@gmail.com', '085182529291', 1, 25000, '{\"jumlah_hari\": 1, \"harga_per_hari\": 25000}', 'weca', 'confirmed', '2026-03-06 00:04:09', 2, NULL, NULL, NULL, NULL, '2026-03-06 00:03:41', '2026-03-06 00:04:09', NULL, NULL, NULL),
(9, 'ZKT-20260306-BC0A7B', 'zakat', NULL, 'Hamba Allah', 'dickycoding@gmail.com', '085182529291', 1, 3750000, '{\"jenis\": \"mal\", \"persen\": 2.5, \"nisab_rp\": 170, \"nilai_harta\": 150000000}', NULL, 'confirmed', '2026-03-06 00:13:16', 2, 'Terimakasih', NULL, NULL, NULL, '2026-03-06 00:12:20', '2026-03-06 00:13:16', NULL, 37, 399);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-02-18 02:47:36', '$2y$12$t93E0iFCUdVBIS5RJ/AJQeFJfPwelo62mGGjJr7GBPcYB73ukRKw6', NULL, NULL, NULL, 'QGJecmkpBj', '2026-02-18 02:47:36', '2026-02-18 02:47:36'),
(2, 'LAZIZNU BJN', 'admin@example.com', NULL, '$2y$12$Pc2x9sJVITm.EwBYVXH8vujxeVHPF/a8Zf1dYsYQmiqljLEi3XM0S', NULL, NULL, NULL, 'Kd8kcmDh2zFPK068risoS2o5F2DKsjQ0oktDpAUmoifly0i1JJ2bWT9SWrj2', '2026-02-18 02:48:14', '2026-02-18 02:48:14');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `desas`
--
ALTER TABLE `desas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `desas_kecamatan_id_nama_unique` (`kecamatan_id`,`nama`);

--
-- Indexes for table `dokumens`
--
ALTER TABLE `dokumens`
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
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kecamatans_nama_unique` (`nama`);

--
-- Indexes for table `laporan_bulanans`
--
ALTER TABLE `laporan_bulanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_mwcs`
--
ALTER TABLE `laporan_mwcs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_tahunans`
--
ALTER TABLE `laporan_tahunans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `missions_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `mustahiks`
--
ALTER TABLE `mustahiks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mustahiks_nik_unique` (`nik`),
  ADD KEY `mustahiks_kecamatan_id_foreign` (`kecamatan_id`),
  ADD KEY `mustahiks_desa_id_foreign` (`desa_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug_unique` (`slug`),
  ADD KEY `news_category_id_foreign` (`category_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_confirmations`
--
ALTER TABLE `payment_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_confirmations_transaction_id_index` (`transaction_id`),
  ADD KEY `idx_payment_confirmations_transaction_id` (`transaction_id`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengurus_masa_khidmat_mulai_masa_khidmat_selesai_index` (`masa_khidmat_mulai`,`masa_khidmat_selesai`),
  ADD KEY `pengurus_jabatan_is_active_index` (`jabatan`,`is_active`),
  ADD KEY `pengurus_urutan_index` (`urutan`);

--
-- Indexes for table `pillars`
--
ALTER TABLE `pillars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pillars_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programs_slug_unique` (`slug`),
  ADD KEY `programs_type_is_active_index` (`type`,`is_active`),
  ADD KEY `programs_slug_index` (`slug`);

--
-- Indexes for table `qurban_hewans`
--
ALTER TABLE `qurban_hewans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qurban_hewans_period_id_jenis_is_active_index` (`period_id`,`jenis`,`is_active`);

--
-- Indexes for table `qurban_payment_confirmations`
--
ALTER TABLE `qurban_payment_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qurban_payment_confirmations_registration_id_index` (`registration_id`);

--
-- Indexes for table `qurban_periods`
--
ALTER TABLE `qurban_periods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qurban_periods_is_active_index` (`is_active`),
  ADD KEY `qurban_periods_tahun_index` (`tahun`);

--
-- Indexes for table `qurban_registrations`
--
ALTER TABLE `qurban_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `qurban_registrations_kode_registrasi_unique` (`kode_registrasi`),
  ADD KEY `qurban_registrations_confirmed_by_foreign` (`confirmed_by`),
  ADD KEY `qurban_registrations_hewan_id_status_index` (`hewan_id`,`status`),
  ADD KEY `qurban_registrations_period_id_status_index` (`period_id`,`status`),
  ADD KEY `qurban_registrations_kode_registrasi_index` (`kode_registrasi`),
  ADD KEY `qurban_registrations_email_index` (`email`);

--
-- Indexes for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rekenings_nama_unique` (`nama`),
  ADD UNIQUE KEY `rekenings_nomor_rekening_unique` (`nomor_rekening`);

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
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `transactions_confirmed_by_foreign` (`confirmed_by`),
  ADD KEY `transactions_type_status_index` (`type`,`status`),
  ADD KEY `transactions_kode_transaksi_index` (`kode_transaksi`),
  ADD KEY `transactions_email_index` (`email`),
  ADD KEY `transactions_created_at_index` (`created_at`),
  ADD KEY `idx_transactions_status` (`status`),
  ADD KEY `idx_transactions_type` (`type`),
  ADD KEY `idx_transactions_kode_transaksi` (`kode_transaksi`),
  ADD KEY `idx_transactions_program_id` (`program_id`),
  ADD KEY `idx_transactions_kecamatan_id` (`kecamatan_id`),
  ADD KEY `idx_transactions_desa_id` (`desa_id`),
  ADD KEY `idx_transactions_created_at` (`created_at`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `desas`
--
ALTER TABLE `desas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500;

--
-- AUTO_INCREMENT for table `dokumens`
--
ALTER TABLE `dokumens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `laporan_bulanans`
--
ALTER TABLE `laporan_bulanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporan_mwcs`
--
ALTER TABLE `laporan_mwcs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporan_tahunans`
--
ALTER TABLE `laporan_tahunans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `mustahiks`
--
ALTER TABLE `mustahiks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_confirmations`
--
ALTER TABLE `payment_confirmations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pillars`
--
ALTER TABLE `pillars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `qurban_hewans`
--
ALTER TABLE `qurban_hewans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `qurban_payment_confirmations`
--
ALTER TABLE `qurban_payment_confirmations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qurban_periods`
--
ALTER TABLE `qurban_periods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qurban_registrations`
--
ALTER TABLE `qurban_registrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekenings`
--
ALTER TABLE `rekenings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `desas`
--
ALTER TABLE `desas`
  ADD CONSTRAINT `desas_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `missions_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mustahiks`
--
ALTER TABLE `mustahiks`
  ADD CONSTRAINT `mustahiks_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `desas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mustahiks_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payment_confirmations`
--
ALTER TABLE `payment_confirmations`
  ADD CONSTRAINT `payment_confirmations_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pillars`
--
ALTER TABLE `pillars`
  ADD CONSTRAINT `pillars_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qurban_hewans`
--
ALTER TABLE `qurban_hewans`
  ADD CONSTRAINT `qurban_hewans_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `qurban_periods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qurban_payment_confirmations`
--
ALTER TABLE `qurban_payment_confirmations`
  ADD CONSTRAINT `qurban_payment_confirmations_registration_id_foreign` FOREIGN KEY (`registration_id`) REFERENCES `qurban_registrations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qurban_registrations`
--
ALTER TABLE `qurban_registrations`
  ADD CONSTRAINT `qurban_registrations_confirmed_by_foreign` FOREIGN KEY (`confirmed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `qurban_registrations_hewan_id_foreign` FOREIGN KEY (`hewan_id`) REFERENCES `qurban_hewans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `qurban_registrations_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `qurban_periods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_confirmed_by_foreign` FOREIGN KEY (`confirmed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `desas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_kecamatan_id_foreign` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
