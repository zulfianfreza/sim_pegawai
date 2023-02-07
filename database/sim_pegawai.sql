-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 07 Feb 2023 pada 10.53
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sim_pegawai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bagian`
--

CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL,
  `nama_bagian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bagian`
--

INSERT INTO `bagian` (`id_bagian`, `nama_bagian`) VALUES
(1, 'Bidang Pelayanan Medik'),
(2, 'Bidang Penunjang Medik'),
(3, 'Bidang Keperawatan'),
(4, 'Bagian Keuangan'),
(5, 'Bagian Umum Dan SDM'),
(6, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` int(11) NOT NULL,
  `skala` int(11) NOT NULL,
  `keterangan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `skala`, `keterangan`) VALUES
(1, 5, 'Sangat Penting'),
(2, 4, 'Penting'),
(3, 3, 'Cukup Penting'),
(4, 2, 'Kurang Penting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_keputusan`
--

CREATE TABLE `detail_keputusan` (
  `id` int(11) NOT NULL,
  `id_keputusan` int(11) NOT NULL,
  `nip` varchar(16) NOT NULL,
  `vektor_v` double NOT NULL,
  `vektor_s` double NOT NULL,
  `keputusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_keputusan`
--

INSERT INTO `detail_keputusan` (`id`, `id_keputusan`, `nip`, `vektor_v`, `vektor_s`, `keputusan`) VALUES
(21, 3, '10118101', 78.609893514361, 0.21427760247872, 'Bonus'),
(22, 3, '10118100', 77.034096032658, 0.20998223848221, '-'),
(23, 3, '10118103', 71.156576140585, 0.19396108879366, '-'),
(24, 3, '10118102', 70.029745784988, 0.1908895351227, '-'),
(25, 3, '10118104', 70.029745784988, 0.1908895351227, '-'),
(30, 4, '10118105', 80.177266568538, 0.52954536186527, 'Perpanjang'),
(31, 4, '10118106', 71.230473622259, 0.47045463813473, 'Stop Kontrak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penilaian`
--

CREATE TABLE `detail_penilaian` (
  `id` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `id_kriteria` varchar(3) NOT NULL,
  `nilai` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_penilaian`
--

INSERT INTO `detail_penilaian` (`id`, `id_penilaian`, `id_kriteria`, `nilai`, `keterangan`) VALUES
(55, 7, 'K1', 75, ''),
(56, 7, 'K2', 70, ''),
(57, 7, 'K3', 81, ''),
(58, 7, 'K4', 74, ''),
(59, 7, 'K5', 77, ''),
(60, 7, 'K6', 74, ''),
(61, 7, 'K7', 80, ''),
(62, 7, 'K8', 85, ''),
(63, 7, 'K9', 85, ''),
(64, 8, 'K1', 87, ''),
(65, 8, 'K2', 73, ''),
(66, 8, 'K3', 82, ''),
(67, 8, 'K4', 79, ''),
(68, 8, 'K5', 79, ''),
(69, 8, 'K6', 81, ''),
(70, 8, 'K7', 77, ''),
(71, 8, 'K8', 70, ''),
(72, 8, 'K9', 78, ''),
(91, 11, 'K1', 61, ''),
(92, 11, 'K2', 64, ''),
(93, 11, 'K3', 68, ''),
(94, 11, 'K4', 81, ''),
(95, 11, 'K5', 74, ''),
(96, 11, 'K6', 82, ''),
(97, 11, 'K7', 69, ''),
(98, 11, 'K8', 69, ''),
(99, 11, 'K9', 85, ''),
(118, 14, 'K1', 70, ''),
(119, 14, 'K2', 70, ''),
(120, 14, 'K3', 70, ''),
(121, 14, 'K4', 70, ''),
(122, 14, 'K5', 70, ''),
(123, 14, 'K6', 70, ''),
(124, 14, 'K7', 70, ''),
(125, 14, 'K8', 70, ''),
(126, 14, 'K9', 70, ''),
(127, 15, 'K1', 70, ''),
(128, 15, 'K2', 70, ''),
(129, 15, 'K3', 71, ''),
(130, 15, 'K4', 72, ''),
(131, 15, 'K5', 70, ''),
(132, 15, 'K6', 71, ''),
(133, 15, 'K7', 75, ''),
(134, 15, 'K8', 70, ''),
(135, 15, 'K9', 72, ''),
(136, 16, 'K1', 80, ''),
(137, 16, 'K2', 81, ''),
(138, 16, 'K3', 80, ''),
(139, 16, 'K4', 80, ''),
(140, 16, 'K5', 80, ''),
(141, 16, 'K6', 80, ''),
(142, 16, 'K7', 80, ''),
(143, 16, 'K8', 80, ''),
(144, 16, 'K9', 80, ''),
(145, 17, 'K1', 70, ''),
(146, 17, 'K2', 70, ''),
(147, 17, 'K3', 70, ''),
(148, 17, 'K4', 70, ''),
(149, 17, 'K5', 70, ''),
(150, 17, 'K6', 70, ''),
(151, 17, 'K7', 70, ''),
(152, 17, 'K8', 70, ''),
(153, 17, 'K9', 70, ''),
(154, 18, 'K1', 70, ''),
(155, 18, 'K2', 70, ''),
(156, 18, 'K3', 70, ''),
(157, 18, 'K4', 70, ''),
(158, 18, 'K5', 70, ''),
(159, 18, 'K6', 70, ''),
(160, 18, 'K7', 70, ''),
(161, 18, 'K8', 70, ''),
(162, 18, 'K9', 70, ''),
(163, 19, 'K1', 90, ''),
(164, 19, 'K2', 90, ''),
(165, 19, 'K3', 90, ''),
(166, 19, 'K4', 90, ''),
(167, 19, 'K5', 90, ''),
(168, 19, 'K6', 90, ''),
(169, 19, 'K7', 90, ''),
(170, 19, 'K8', 90, ''),
(171, 19, 'K9', 90, ''),
(172, 20, 'K1', 99, ''),
(173, 20, 'K2', 99, ''),
(174, 20, 'K3', 99, ''),
(175, 20, 'K4', 99, ''),
(176, 20, 'K5', 99, ''),
(177, 20, 'K6', 99, ''),
(178, 20, 'K7', 99, ''),
(179, 20, 'K8', 99, ''),
(180, 20, 'K9', 99, ''),
(181, 21, 'K1', 77, ''),
(182, 21, 'K2', 77, ''),
(183, 21, 'K3', 77, ''),
(184, 21, 'K4', 77, ''),
(185, 21, 'K5', 77, ''),
(186, 21, 'K6', 77, ''),
(187, 21, 'K7', 77, ''),
(188, 21, 'K8', 77, ''),
(189, 21, 'K9', 77, ''),
(190, 22, 'K1', 88, ''),
(191, 22, 'K2', 88, ''),
(192, 22, 'K3', 88, ''),
(193, 22, 'K4', 88, ''),
(194, 22, 'K5', 88, ''),
(195, 22, 'K6', 88, ''),
(196, 22, 'K7', 88, ''),
(197, 22, 'K8', 88, ''),
(198, 22, 'K9', 88, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keputusan`
--

CREATE TABLE `keputusan` (
  `id` int(11) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `status` varchar(12) NOT NULL,
  `tahun` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keputusan`
--

INSERT INTO `keputusan` (`id`, `id_bagian`, `status`, `tahun`, `tanggal`) VALUES
(3, 3, 'tetap', 2022, '2023-01-31 05:13:41'),
(4, 3, 'kontrak', 2022, '2023-01-31 10:30:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(3) NOT NULL,
  `kriteria` varchar(25) NOT NULL,
  `id_bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `id_bobot`) VALUES
('K1', 'Kesetiaan', 2),
('K2', 'Prestasi Kerja', 1),
('K3', 'Tanggung Jawab', 1),
('K4', 'Ketaatan', 3),
('K5', 'Kejujuran', 2),
('K6', 'Prakarsa', 1),
('K7', 'Kerjasama', 2),
('K8', 'Kepribadian', 3),
('K9', 'Kepemimpinan', 4);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `kriteria_bobot`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `kriteria_bobot` (
`id_kriteria` varchar(3)
,`kriteria` varchar(25)
,`skala` int(11)
,`keterangan` varchar(25)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(16) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `id_bagian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama_pegawai`, `jenis_kelamin`, `alamat`, `status`, `jabatan`, `id_bagian`) VALUES
('10118100', 'Maya Trisnawati', 'Perempuan', '', 'Tetap', 'Kepala Unit Perawatan Kamar Bersih', 3),
('10118101', 'Sudarto', 'Laki-laki', '', 'Tetap', 'Pelaksana', 3),
('10118102', 'Lazuardi', 'Laki-laki', '', 'Tetap', 'Perawat', 3),
('10118103', 'Muhammad Hasan', 'Laki-laki', '', 'Tetap', 'Perawat', 3),
('10118104', 'Lala Nurmala', 'Perempuan', '', 'Tetap', 'Perawat', 3),
('10118105', 'Mulyaningsih', 'Perempuan', '', 'Kontrak', 'Perawat', 3),
('10118106', 'Septiani', 'Perempuan', '', 'Kontrak', 'Perawat', 3),
('10118107', 'Hesti Hendika', 'Perempuan', '', 'Kontrak', 'Perawat', 3),
('10118172', 'Imas Sukimas', 'Laki-laki', 'Jl. Rambutan', 'Tetap', 'Staff', 4),
('1011854', 'David Tendean', 'Laki-laki', 'Jl. Jambu', 'Tetap', 'Staff', 4),
('10199187', 'Udin', 'Laki-laki', 'Jl. Kecubung', 'Kontrak', 'Staff', 4),
('12389899', 'Azura', 'Perempuan', '', 'Kontrak', 'Staff', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `nip` varchar(16) NOT NULL,
  `periode` varchar(25) NOT NULL,
  `tahun` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `tanggal` datetime NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `nip`, `periode`, `tahun`, `username`, `tanggal`, `catatan`) VALUES
(7, '10118100', 'Desember', 2022, 'rosnilawati', '2022-12-18 12:51:40', ''),
(8, '10118101', 'Desember', 2022, 'rosnilawati', '2022-12-18 12:52:51', ''),
(11, '10118106', 'Desember', 2022, 'rosnilawati', '2022-12-18 12:56:28', 'baik hati'),
(14, '10118102', 'Desember', 2022, 'rosnilawati', '2022-12-22 23:55:56', ''),
(15, '10118103', 'Desember', 2022, 'rosnilawati', '2022-12-23 00:01:08', ''),
(16, '10118105', 'Desember', 2022, 'rosnilawati', '2022-12-24 01:34:29', ''),
(17, '10118100', 'Januari', 2023, 'rosnilawati', '2023-01-28 15:26:04', ''),
(18, '10118104', 'Desember', 2022, 'rosnilawati', '2023-01-30 13:49:14', ''),
(19, '10118172', 'Januari', 2023, 'mastuti', '2023-01-31 10:52:00', ''),
(20, '1011854', 'Januari', 2023, 'mastuti', '2023-01-31 10:52:28', ''),
(21, '10199187', 'Januari', 2023, 'mastuti', '2023-01-31 10:53:28', ''),
(22, '12389899', 'Januari', 2023, 'mastuti', '2023-01-31 10:53:47', '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `perbaikan_bobot`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `perbaikan_bobot` (
`id_kriteria` varchar(3)
,`kriteria` varchar(25)
,`skala` int(11)
,`keterangan` varchar(25)
,`perbaikan_bobot` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL,
  `id_bagian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`, `id_bagian`) VALUES
(1, 'Admin', 'admin', '26875f4883b3e7df8060324368567b4a', 'admin', 6),
(3, 'Rosnilawati, A.Md. Kep', 'rosnilawati', '1ffac1ad766f0936332e8d72f286f4a0', 'kabag', 3),
(4, 'Albert Rotinaluhu', 'albert', '6c5bc43b443975b806740d8e41146479', 'kabag', 5),
(5, 'Mastuti, SE. Ak.', 'mastuti', 'bcb026595f9fefd71c9239f8e1c7ae48', 'kabag', 4);

-- --------------------------------------------------------

--
-- Struktur untuk view `kriteria_bobot`
--
DROP TABLE IF EXISTS `kriteria_bobot`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kriteria_bobot`  AS SELECT `kriteria`.`id_kriteria` AS `id_kriteria`, `kriteria`.`kriteria` AS `kriteria`, `bobot`.`skala` AS `skala`, `bobot`.`keterangan` AS `keterangan` FROM (`kriteria` join `bobot` on(`kriteria`.`id_bobot` = `bobot`.`id_bobot`))  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `perbaikan_bobot`
--
DROP TABLE IF EXISTS `perbaikan_bobot`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perbaikan_bobot`  AS SELECT `k1`.`id_kriteria` AS `id_kriteria`, `k1`.`kriteria` AS `kriteria`, `b1`.`skala` AS `skala`, `b1`.`keterangan` AS `keterangan`, `b1`.`skala`/ (select sum(`bobot`.`skala`) from (`kriteria` join `bobot` on(`kriteria`.`id_bobot` = `bobot`.`id_bobot`))) AS `perbaikan_bobot` FROM (`kriteria` `k1` join `bobot` `b1` on(`k1`.`id_bobot` = `b1`.`id_bobot`)) ORDER BY `k1`.`id_kriteria` ASC  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indeks untuk tabel `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indeks untuk tabel `detail_keputusan`
--
ALTER TABLE `detail_keputusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_keputusan` (`id_keputusan`),
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penilaian` (`id_penilaian`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `id_bobot` (`id_bobot`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `username` (`username`),
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `bagian` (`id_bagian`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `detail_keputusan`
--
ALTER TABLE `detail_keputusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_keputusan`
--
ALTER TABLE `detail_keputusan`
  ADD CONSTRAINT `detail_keputusan_ibfk_1` FOREIGN KEY (`id_keputusan`) REFERENCES `keputusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_keputusan_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD CONSTRAINT `detail_penilaian_ibfk_1` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  ADD CONSTRAINT `keputusan_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`id_bobot`) REFERENCES `bobot` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
