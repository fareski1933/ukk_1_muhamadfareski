-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2026 at 07:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_1_muhamadfareski`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL,
  `nama_alat` varchar(100) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `kondisi` enum('baik','rusak') DEFAULT NULL,
  `status` enum('tersedia','dipinjam','tidak tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id_alat`, `nama_alat`, `id_kategori`, `stok`, `kondisi`, `status`) VALUES
(34, 'Sepatu Futsal', 6, 8, 'baik', 'tersedia'),
(35, 'Bola Futsal', 6, 2, 'baik', 'tersedia'),
(36, 'Pelindung Kaki', 6, 4, 'baik', 'tersedia'),
(37, 'Bola Basket', 7, 0, 'baik', 'tersedia'),
(38, 'Sepatu Basket', 7, 0, 'baik', 'tersedia'),
(39, 'Jersey Basket', 7, 7, 'baik', 'tersedia'),
(40, 'Raket', 8, 3, 'baik', 'tersedia'),
(41, 'Kok', 8, 8, 'baik', 'tersedia'),
(42, 'Sepatu Badminton', 8, 9, 'baik', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(6, 'Futsal'),
(7, 'Basket'),
(8, 'Badminton');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `tanggal`) VALUES
(11, 58, 'Mengajukan peminjaman alat (ID Alat: 34)', '2026-03-31 23:26:43'),
(12, 56, 'Menyetujui peminjaman (ID: 48)', '2026-03-31 23:26:59'),
(13, 58, 'Mengajukan peminjaman alat (ID Alat: 34)', '2026-04-01 00:00:59'),
(14, 56, 'Menyetujui peminjaman (ID: 49)', '2026-04-01 00:01:45'),
(15, 58, 'Mengajukan peminjaman alat (ID Alat: 34)', '2026-04-03 23:29:50'),
(16, 60, 'Mengajukan peminjaman alat (ID Alat: 39)', '2026-04-03 23:31:39'),
(17, 56, 'Menyetujui peminjaman (ID: 53)', '2026-04-03 23:31:55'),
(18, 58, 'Mengajukan peminjaman alat (ID Alat: 34)', '2026-04-04 07:22:34'),
(19, 56, 'Menyetujui peminjaman (ID: 54)', '2026-04-04 07:22:58'),
(0, 58, 'Mengajukan peminjaman alat (ID Alat: 42)', '2026-04-08 04:16:59'),
(0, NULL, 'Mengarsipkan (menghapus) peminjaman (ID: 9)', '2026-04-08 04:19:26'),
(0, NULL, 'Mengarsipkan (menghapus) peminjaman (ID: 2)', '2026-04-08 04:19:31'),
(0, NULL, 'Mengarsipkan (menghapus) peminjaman (ID: 4)', '2026-04-08 04:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notif` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status_baca` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('baru','dibaca') DEFAULT 'baru'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notif`, `id_user`, `pesan`, `status_baca`, `created_at`, `status`) VALUES
(1, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-03-29 13:19:43', 'dibaca'),
(2, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-03-29 13:19:46', 'dibaca'),
(3, 58, 'Peminjaman kamu DITOLAK', 0, '2026-03-29 13:19:47', 'dibaca'),
(4, 58, 'Peminjaman kamu DITOLAK', 0, '2026-03-29 13:19:49', 'dibaca'),
(5, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-03-30 09:54:51', 'dibaca'),
(6, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-03-30 09:59:23', 'dibaca'),
(7, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-03-30 10:02:32', 'dibaca'),
(8, 58, 'Peminjaman kamu DITOLAK', 0, '2026-03-30 10:11:19', 'dibaca'),
(9, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-03-31 00:58:35', 'dibaca'),
(10, 58, 'Peminjaman kamu DITOLAK', 0, '2026-03-31 00:58:40', 'dibaca'),
(11, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-03-31 01:38:20', 'dibaca'),
(12, 58, 'Peminjaman kamu DITOLAK', 0, '2026-03-31 01:38:21', 'dibaca'),
(13, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-03-31 01:51:42', 'dibaca'),
(14, 58, 'Peminjaman kamu DITOLAK', 0, '2026-03-31 07:23:58', 'dibaca'),
(15, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-03-31 07:26:48', 'dibaca'),
(16, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-04-01 00:30:23', 'dibaca'),
(17, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-04-01 00:31:19', 'dibaca'),
(18, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-04-01 00:31:21', 'dibaca'),
(19, 58, 'Peminjaman kamu DITOLAK', 0, '2026-04-01 00:31:22', 'dibaca'),
(20, 58, 'Peminjaman kamu DITOLAK', 0, '2026-04-01 00:31:23', 'dibaca'),
(21, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-04-01 03:16:49', 'dibaca'),
(22, 58, 'Peminjaman kamu DITOLAK', 0, '2026-04-01 03:16:50', 'dibaca'),
(23, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-04-01 03:43:15', 'dibaca'),
(24, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-04-01 03:55:28', 'dibaca'),
(25, 58, 'Peminjaman kamu telah DISETUJUI', 0, '2026-04-01 05:43:46', 'dibaca'),
(26, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-01 05:48:24', 'dibaca'),
(27, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-01 06:06:55', 'dibaca'),
(28, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-01 06:26:59', 'dibaca'),
(29, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-01 07:01:45', 'dibaca'),
(30, 60, 'Peminjaman kamu DISETUJUI', 0, '2026-04-04 06:31:55', 'dibaca'),
(31, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-04 14:22:58', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 01:51:36', 'dibaca'),
(0, 58, 'Peminjaman kamu DITOLAK', 0, '2026-04-08 02:15:49', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 02:15:53', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 02:18:41', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 02:24:35', 'dibaca'),
(0, 58, 'Peminjaman kamu DITOLAK', 0, '2026-04-08 02:49:35', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 02:50:18', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 03:41:50', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 03:41:51', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 03:57:15', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 03:57:16', 'dibaca'),
(0, 58, 'Peminjaman kamu DISETUJUI', 0, '2026-04-08 04:03:42', 'dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_alat` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `tgl_persetujuan` date DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak','dipinjam','dikembalikan','arsip') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_alat`, `tgl_pinjam`, `tgl_kembali`, `tgl_persetujuan`, `status`) VALUES
(3, 58, 35, '2026-04-08', '2026-04-09', '2026-04-08', 'dikembalikan'),
(7, 58, 34, '2026-04-08', '2026-04-08', '2026-04-08', 'dikembalikan'),
(8, 58, 34, '2026-04-08', '2026-04-08', '2026-04-08', 'dipinjam'),
(10, 58, 34, '2026-04-08', '2026-04-08', '2026-04-08', 'dikembalikan'),
(11, 58, 39, '2026-04-08', '2026-04-08', '2026-04-08', 'dikembalikan'),
(12, 58, 35, '2026-04-08', '2026-04-08', '2026-04-08', 'dikembalikan'),
(13, 58, 36, '2026-04-08', '2026-04-08', '2026-04-08', 'dikembalikan'),
(14, 58, 34, '2026-04-08', '2026-04-08', NULL, 'ditolak'),
(15, 58, 34, '2026-04-08', '2026-04-29', '2026-04-08', 'dikembalikan'),
(16, 58, 42, '2026-04-08', '2026-04-08', '2026-04-08', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `tgl_dikembalikan` date DEFAULT NULL,
  `kondisi_kembali` enum('baik','rusak','hilang') DEFAULT NULL,
  `denda` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_peminjaman`, `tgl_dikembalikan`, `kondisi_kembali`, `denda`) VALUES
(1, 3, '2026-04-08', 'rusak', 120000),
(2, 7, '2026-04-08', 'baik', 1111111),
(4, 11, '2026-04-08', 'rusak', 50000),
(5, 10, '2026-04-08', 'baik', 0),
(7, 13, '2026-04-08', 'rusak', 50000),
(8, 15, '2026-04-08', 'baik', 122);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas','peminjam','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `no_tlp`, `password`, `role`) VALUES
(50, 'admin0', 'admin0@gmail.com', '829398282', '$2y$10$SXT9nki3OTxoptrSjj7gZOj698EiKyeiChGTQ9NeyjnNOcuwHnRzm', 'admin'),
(52, 'gipiri', 'gipiri@gmail.com', '089726736726', '$2y$10$fFG5/9idtkvNn4xGw5Sq/.JPa4m/qgoZF6cLPJdET7k5dAdscLSNS', 'peminjam'),
(53, 'epang', 'pan@gmail.com', '18181818', '$2y$10$OKKpHPwroOAOtbLw/1laLOeVhVMl0OS/iQTwxltaW71e2eyAzW/2m', 'petugas'),
(54, 'bonkop', 'bongkop@gmail.com', '0891028372828', '$2y$10$7y6K15TfhpGoSc5qyPdGtue2kA3fbyiPtagXQSozjjxMGknefOF6.', 'peminjam'),
(56, 'p', 'petugas0@gmail.com', '000000000', '$2y$10$DHJHszocTg/3BzNN8lafM.jcZkTHqmrIrMbi1yRyUVLTpR2BnqYYy', 'petugas'),
(58, 'fk', 'peminjam0@gmail.com', '111111', '$2y$10$cR2gR56T6cQHte5JMwGRN.6kwdNjBovQP.R10ApyZzBsSKbdmmyP6', 'peminjam'),
(60, 'KIRANNNNN', 'kir@gmail.com', '00', '$2y$10$pZCs/lS1hFY./Lw.JGFf7e11hOrDws879v9eBhNasJY7TDws800Sm', 'peminjam'),
(62, 'fareski', 'res@gmail.com', '1111', '$2y$10$llFBvPiRbSfkGjreVz.sqeWZHncAZR9B.1kRtyUJ1AOX/0vYh12NO', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
