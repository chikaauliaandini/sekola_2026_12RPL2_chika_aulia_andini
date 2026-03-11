-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2026 at 06:54 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom_12rpl2_chika.sql`
--

-- --------------------------------------------------------

--
-- Table structure for table `input_aspirasi`
--

CREATE TABLE `input_aspirasi` (
  `id_pelaporan` int NOT NULL,
  `nis` varchar(10) NOT NULL,
  `id_kategori` int NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `status` enum('menunggu','proses','selesai') CHARACTER SET macce COLLATE macce_bin NOT NULL,
  `feedback` text,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `input_aspirasi`
--

INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `status`, `feedback`, `tanggal`, `kategori`) VALUES
(1, '04', 1, 'taman ', 'pohon tumbang', 'menunggu', 'sudah selesai bro 6', '2026-02-21 00:27:46', NULL),
(2, '04', 2, 'masjid', 'atap bocor', 'proses', 'okkk', '2026-02-21 00:27:46', NULL),
(3, '03', 2, 'kelas', 'ac mati', 'proses', 'okkk', '2026-02-21 00:27:46', NULL),
(4, '03', 2, 'kelas', 'ac mati', 'proses', 'ooooo', '2026-02-21 00:27:46', NULL),
(5, '03', 2, 'kelas', 'ac mati', 'proses', 'ok', '2026-02-21 00:27:46', NULL),
(22, '04', 2, 'kamu', 'kamuuuu', 'menunggu', 'kwmjuhjrwjkhruh', '2026-03-04 20:03:53', NULL),
(23, '06', 1, 'sekolah', 'bunga rusak', 'menunggu', NULL, '2026-03-07 13:40:28', NULL),
(24, '06', 1, 'sekolah', 'bunga rusak', 'menunggu', NULL, '2026-03-07 13:43:03', NULL),
(25, '06', 1, 'sekolah', 'bunga rusak', 'menunggu', NULL, '2026-03-07 13:43:19', NULL),
(26, '06', 1, 'sekolah', 'ac rusak', 'menunggu', NULL, '2026-03-08 19:43:30', NULL),
(27, '06', 1, 'sekolah', 'ac rusak', 'menunggu', NULL, '2026-03-08 19:45:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
(1, 'Lingkungan'),
(2, 'Fasilitas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('siswa','admin') NOT NULL DEFAULT 'siswa',
  `nis` varchar(10) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `feedback` text,
  `status` varchar(20) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `nis`, `kelas`, `feedback`, `status`, `lokasi`, `kategori`) VALUES
(1, 'cila', 'cilaimupp26', 'siswa', '123', '12 rpl 2', '', 'Menunggu', '', ''),
(2, 'sila', '$2y$10$vKMPugnm8.NZxNBsSYRS6egKsy7VKCNpIE3WbM.aCDCyVG38TcufO', 'siswa', '2233', '10 plg 2', NULL, NULL, NULL, NULL),
(3, 'shiela', '$2y$10$dZL6kosLSY2zvesMQrkb5.fXnT8gbXi.L9p7dx3qklmOswXF3M6mW', 'siswa', '3344', '11 tkj 2', NULL, NULL, NULL, NULL),
(4, 'cicakk', '$2y$10$XdiS93cJEpaULEyvxkpHIeKRVSV6VEBLvs.lv5IY45ljVeJ82Pkby', 'siswa', '04', '12tkj3', NULL, NULL, NULL, NULL),
(5, 'ikalll', '$2y$10$//gVud..OXTXg.hej7F37uidFvSMqoKgyWBM9abdvYE6gQskQP7n6', 'admin', '05', '12mp2', 'kurhrwi', 'menunggu', 'ooo', ''),
(6, 'caca', '$2y$10$kPMqZBg6cnxcHvSVYwM9Yu8KyoTshqIDFAiCYkUajFqoCVxATWZw.', 'siswa', '06', '12 tkj', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  MODIFY `id_pelaporan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
