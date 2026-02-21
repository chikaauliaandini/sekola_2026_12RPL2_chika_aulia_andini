-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2026 at 08:33 AM
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
  `status` enum('Menunggu','proses','selesai') CHARACTER SET macce COLLATE macce_bin NOT NULL,
  `feedback` text,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `input_aspirasi`
--

INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `status`, `feedback`, `tanggal`) VALUES
(1, '04', 1, 'taman ', 'pohon tumbang', 'Menunggu', NULL, '2026-02-21 00:27:46'),
(2, '04', 2, 'masjid', 'atap bocor', 'Menunggu', NULL, '2026-02-21 00:27:46'),
(3, '03', 2, 'kelas', 'ac mati', 'Menunggu', NULL, '2026-02-21 00:27:46'),
(4, '03', 2, 'kelas', 'ac mati', 'Menunggu', NULL, '2026-02-21 00:27:46'),
(5, '03', 2, 'kelas', 'ac mati', 'Menunggu', NULL, '2026-02-21 00:27:46'),
(6, '03', 2, 'kelas', 'ac mati', 'Menunggu', NULL, '2026-02-21 00:27:46'),
(7, '03', 2, 'kelas', 'ac mati', 'Menunggu', NULL, '2026-02-21 00:27:46'),
(8, '02', 1, 'lapangan', 'lapangan nya retak', 'Menunggu', NULL, '2026-02-21 00:27:46'),
(9, '02', 1, 'lapangan', 'lapangan nya retak', 'Menunggu', NULL, '2026-02-21 00:27:46');

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
  `kelas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `nis`, `kelas`) VALUES
(1, 'cila', 'cilaimupp26', 'siswa', '123', '12 rpl 2'),
(2, 'sila', '$2y$10$vKMPugnm8.NZxNBsSYRS6egKsy7VKCNpIE3WbM.aCDCyVG38TcufO', 'siswa', '2233', '10 plg 2'),
(3, 'shiela', '$2y$10$dZL6kosLSY2zvesMQrkb5.fXnT8gbXi.L9p7dx3qklmOswXF3M6mW', 'siswa', '3344', '11 tkj 2'),
(4, 'cicakk', '$2y$10$pVqwp8oej/Cqz.Wi80KScu1pdSPZ0PYnaek/ibmhGPafbbaax0Vhu', 'siswa', '04', '12tkj3');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
