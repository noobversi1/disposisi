-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table disposisi.keluar
CREATE TABLE IF NOT EXISTS `keluar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berkas` varchar(255) DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `hal_surat` varchar(255) DEFAULT NULL,
  `nmr_surat` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table disposisi.keputusan
CREATE TABLE IF NOT EXISTS `keputusan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tgl_sk` date DEFAULT NULL,
  `tentang` varchar(255) DEFAULT NULL,
  `nmr_sk` varchar(255) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table disposisi.masuk
CREATE TABLE IF NOT EXISTS `masuk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berkas` varchar(255) DEFAULT NULL,
  `pengirim` varchar(255) DEFAULT NULL,
  `tgl_diterima` date DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `hal_surat` varchar(255) DEFAULT NULL,
  `nmr_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table disposisi.mutasiklr
CREATE TABLE IF NOT EXISTS `mutasiklr` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berkas` varchar(255) DEFAULT NULL,
  `kls_mutasi` varchar(10) DEFAULT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  `tujuan` varchar(255) DEFAULT NULL,
  `nm_siswa` varchar(255) DEFAULT NULL,
  `nisn` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nmr_surat` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table disposisi.mutasimsk
CREATE TABLE IF NOT EXISTS `mutasimsk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nsm` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nisn` char(10) DEFAULT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  `kls_mutasi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `asal` varchar(255) DEFAULT NULL,
  `nm_siswa` varchar(255) DEFAULT NULL,
  `berkas` varchar(255) DEFAULT NULL,
  `nmr_surat` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pengeluaran data tidak dipilih.

-- membuang struktur untuk table disposisi.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Pengeluaran data tidak dipilih.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
