-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2026 at 09:31 AM
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
-- Database: `ujikom_12rpl2_chika`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lnput aspirasi`
--

CREATE TABLE `lnput aspirasi` (
  `id_pelaporan` int NOT NULL,
  `nis` varchar(20) NOT NULL,
  `id_kategori` int NOT NULL,
  `lokasi` int NOT NULL,
  `ket` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, 'chika', 'iuh7ytity', 'siswa', '001', 'rpl2'),
(2, 'cila', 'bhjg87ghhyuf7y6', 'siswa', '002', 'rpl1'),
(3, 'itaaaa', '$2y$10$aZU8xvCKv482aMc/ddJDuugdRHqMcZPi3uSwcnnGxUIucm7yiC6pS', 'admin', '003', 'tkr 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `lnput aspirasi`
--
ALTER TABLE `lnput aspirasi`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD UNIQUE KEY `nis_2` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `lnput aspirasi` (`id_kategori`);

--
-- Constraints for table `lnput aspirasi`
--
ALTER TABLE `lnput aspirasi`
  ADD CONSTRAINT `lnput aspirasi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `user` (`nis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
