-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 12 Des 2022 pada 08.55
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
(19, 3, 'K1', 70, ''),
(20, 3, 'K2', 70, ''),
(21, 3, 'K3', 70, ''),
(22, 3, 'K4', 70, ''),
(23, 3, 'K5', 70, ''),
(24, 3, 'K6', 70, ''),
(25, 3, 'K7', 70, ''),
(26, 3, 'K8', 70, ''),
(27, 3, 'K9', 70, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(3) NOT NULL,
  `kriteria` varchar(25) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `bobot`) VALUES
('K1', 'Kesetiaan', 4),
('K2', 'Prestasi Kerja', 5),
('K3', 'Tanggung Jawab', 5),
('K4', 'Ketaatan', 3),
('K5', 'Kejujuran', 4),
('K6', 'Prakarsa', 5),
('K7', 'Kerjasama', 4),
('K8', 'Kepribadian', 3),
('K9', 'Kepemimpinan', 3);

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
  `jabatan` varchar(25) NOT NULL,
  `bagian` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama_pegawai`, `jenis_kelamin`, `alamat`, `status`, `jabatan`, `bagian`) VALUES
('10118100', 'Adam Berriz', 'Laki-laki', 'Kp. Cjj', 'Tetap', 'Operator', 'Monitoring'),
('10118101', 'Max Lucas', 'Laki-laki', 'ada', 'Tetap', 'Operator', 'Monitoring'),
('101892091', 'Fisca Yulia Putri', 'Perempuan', 'Kp. Sodong', 'Kontrak', 'Perawat', 'Keperawatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `nip` varchar(16) NOT NULL,
  `username` varchar(25) NOT NULL,
  `tanggal` datetime NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `nip`, `username`, `tanggal`, `catatan`) VALUES
(3, '10118100', 'rosnilawati', '2022-12-12 08:13:16', 'Stop');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin', '26875f4883b3e7df8060324368567b4a', 1),
(3, 'Rosnilawati, A.Md. Kep', 'rosnilawati', '1ffac1ad766f0936332e8d72f286f4a0', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penilaian` (`id_penilaian`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

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
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD CONSTRAINT `detail_penilaian_ibfk_1` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
