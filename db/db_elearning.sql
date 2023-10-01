-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2023 at 03:14 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`) VALUES
(5, 'R01-XXI'),
(6, 'R02-XXI');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `judul_materi` varchar(50) NOT NULL,
  `file_materi` varchar(191) NOT NULL,
  `tgl_dibuat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `id_guru`, `judul_materi`, `file_materi`, `tgl_dibuat`) VALUES
(14, 12, 'Sastra Matematika', '64ef5510f1893.png', '2023-08-30'),
(15, 21, 'Biologi Ekonomi', '64f0b17b5959d.png', '2023-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_tugas`, `id_siswa`, `nilai`) VALUES
(9, 5, 17, 100),
(10, 5, 18, 0),
(11, 5, 19, 0),
(12, 6, 20, 100);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `soal` text NOT NULL,
  `gambar` varchar(191) NOT NULL,
  `pil_a` text NOT NULL,
  `pil_b` text NOT NULL,
  `pil_c` text NOT NULL,
  `pil_d` text NOT NULL,
  `jawaban` varchar(1) NOT NULL,
  `tgl_dibuat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `id_tugas`, `soal`, `gambar`, `pil_a`, `pil_b`, `pil_c`, `pil_d`, `jawaban`, `tgl_dibuat`) VALUES
(12, 5, 'Barang siapa ?', '', 'barang gue', 'XIXIXI', 'gak tau', 'yahahaha', 'A', '2023-08-30'),
(13, 6, 'Karena apa ?', '', 'karena gue', 'karena aku adalah Yin', 'gak tau', 'yahahaha', 'B', '2023-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `judul` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `id_guru`, `id_materi`, `judul`) VALUES
(5, 12, 14, 'Merangkum bab 1 - selesai'),
(6, 21, 15, 'Merangkum bab 1 - selesai');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nip` varchar(191) DEFAULT NULL,
  `nis` varchar(191) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `role` varchar(10) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `wa` varchar(13) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nip`, `nis`, `id_kelas`, `username`, `password`, `nama`, `role`, `jk`, `wa`, `alamat`) VALUES
(4, NULL, NULL, NULL, 'admin1', 'e10adc3949ba59abbe56e057f20f883e', 'Administrator1', 'Admin', 'L', '000000000', 'Jakarta'),
(12, '0928319283', NULL, 5, 'sri', 'e10adc3949ba59abbe56e057f20f883e', 'Sri Sejatie', 'Guru', 'P', '000000000', 'Jakarta'),
(17, NULL, '02139123', 5, 'pardimin', 'e10adc3949ba59abbe56e057f20f883e', 'Pardimin', 'Siswa', 'L', '0812839138', 'Gilingan'),
(18, NULL, '011313123', 5, 'marjuki', 'e10adc3949ba59abbe56e057f20f883e', 'Marjuki', 'Siswa', 'L', '0812839138', 'Solo Utara'),
(19, NULL, '123010992', 5, 'angel', 'e10adc3949ba59abbe56e057f20f883e', 'Angel Karaomoy', 'Siswa', 'P', '0812839138', 'Solo Selatan'),
(20, NULL, '12093019', 6, 'joko', 'e10adc3949ba59abbe56e057f20f883e', 'Joko', 'Siswa', 'L', '0812839138', 'Solo Timur'),
(21, '1293819', NULL, 6, 'basuki', 'e10adc3949ba59abbe56e057f20f883e', 'Basuki', 'Guru', 'L', '089128391', 'Jakarta Utara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tugas` (`id_tugas`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
