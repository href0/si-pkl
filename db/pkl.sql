-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2022 pada 11.50
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `agenda_id` int(11) NOT NULL,
  `bengkel_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `kegiatan` text NOT NULL,
  `nilai_budaya_industri` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`agenda_id`, `bengkel_id`, `siswa_id`, `tanggal_kegiatan`, `kegiatan`, `nilai_budaya_industri`, `createdAt`, `updatedAt`) VALUES
(14, 2, 5, '2022-01-08', 'asdassadazzz', '21312asd', '2022-01-08 06:25:10', '2022-01-08 06:25:10'),
(16, 1, 1, '2022-01-08', 'Wibu', 'askjd2asd', '2022-01-08 06:25:38', '2022-01-08 06:25:38'),
(18, 1, 3, '2022-01-08', 'dasdad21as', 'dasd12asd', '2022-01-08 06:25:53', '2022-01-08 06:25:53'),
(19, 2, 4, '2022-01-19', 'asd', 'asasd', '2022-01-19 15:55:50', '2022-01-19 15:55:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bengkel`
--

CREATE TABLE `bengkel` (
  `bengkel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_bengkel` varchar(255) NOT NULL,
  `alamat_bengkel` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bengkel`
--

INSERT INTO `bengkel` (`bengkel_id`, `user_id`, `nama_bengkel`, `alamat_bengkel`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 3, 'Padaidi Bengkel', 'asdasd', 1, '2022-01-06 05:01:05', '2022-01-06 05:01:05'),
(2, 5, 'Handil Bengkelas', 'Kebun Handils', 1, '2022-01-06 05:03:33', '2022-01-06 05:03:33'),
(6, 12, 'Pepen Bengkel', 'Jl satu maret', 1, '2022-01-20 18:26:22', '2022-01-20 18:26:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_pkl`
--

CREATE TABLE `jadwal_pkl` (
  `jadwal_pkl_id` int(11) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal_pkl`
--

INSERT INTO `jadwal_pkl` (`jadwal_pkl_id`, `mulai`, `selesai`) VALUES
(1, '2022-01-15', '2022-04-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `menu`, `url`, `icon`) VALUES
(1, 'Daftar Bengkel', 'bengkel', 'fas fa-cogs'),
(2, 'Siswa PKL', 'siswapkl', 'fas fa-users-cog'),
(3, 'Agenda', 'agenda', 'fas fa-calendar-alt'),
(4, 'PKL', 'pkl', 'fas fa-bell'),
(5, 'User', 'user', 'fas fa-users'),
(6, 'Jadwal PKL', 'jadwalpkl', 'fas fa-calendar-alt');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembimbing`
--

CREATE TABLE `pembimbing` (
  `pembimbing_id` int(11) NOT NULL,
  `nama_pembimbing` varchar(255) NOT NULL,
  `nohp_pembimbing` varchar(255) NOT NULL,
  `email_pembimbing` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembimbing`
--

INSERT INTO `pembimbing` (`pembimbing_id`, `nama_pembimbing`, `nohp_pembimbing`, `email_pembimbing`, `createdAt`, `updatedAt`) VALUES
(1, 'Mr Tabri', '08912301931', 'tabri@gmail.com', '2022-01-06 22:47:58', '2022-01-06 22:47:58'),
(2, 'Daniel ishutin', '0189091831', 'daniel@gmail.com', '2022-01-06 22:47:58', '2022-01-06 22:47:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_pkl`
--

CREATE TABLE `permintaan_pkl` (
  `permintaan_pkl_id` int(11) NOT NULL,
  `bengkel_id` int(11) NOT NULL,
  `jumlah_siswa` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` enum('proses','aktif','selesai') NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaan_pkl`
--

INSERT INTO `permintaan_pkl` (`permintaan_pkl_id`, `bengkel_id`, `jumlah_siswa`, `tanggal_masuk`, `status`, `createdAt`, `updatedAt`) VALUES
(3, 1, 3, '2022-01-29', 'proses', '2022-01-08 05:51:24', '2022-01-08 05:51:24'),
(4, 2, 2, '2022-01-28', 'proses', '2022-01-08 05:51:31', '2022-01-08 05:51:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pkl`
--

CREATE TABLE `pkl` (
  `pkl_id` int(11) NOT NULL,
  `permintaan_pkl_id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai` varchar(100) DEFAULT NULL,
  `createdAd` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pkl`
--

INSERT INTO `pkl` (`pkl_id`, `permintaan_pkl_id`, `id_siswa`, `nilai`, `createdAd`, `updatedAt`) VALUES
(1, 3, 1, NULL, '2022-01-08 05:38:16', '2022-01-08 05:38:16'),
(2, 3, 2, NULL, '2022-01-08 05:38:16', '2022-01-08 05:38:16'),
(3, 3, 3, NULL, '2022-01-08 05:38:30', '2022-01-08 05:38:30'),
(4, 4, 4, '12', '2022-01-08 05:58:20', '2022-01-08 05:58:20'),
(5, 4, 5, '89', '2022-01-08 05:58:20', '2022-01-08 05:58:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(11) NOT NULL,
  `pembimbing_id` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `kelas_siswa` enum('X','XI','XII') NOT NULL,
  `email_siswa` varchar(255) NOT NULL,
  `nohp_siswa` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `pembimbing_id`, `nama_siswa`, `kelas_siswa`, `email_siswa`, `nohp_siswa`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'Rinaldi Panca', 'XII', 'rinaldi@gmail.com', '091293912', '2022-01-06 22:49:52', '2022-01-06 16:49:34'),
(2, 2, 'Ilham', 'XII', 'ilham@gmail.com', '09821390128', '2022-01-06 22:50:13', '2022-01-06 22:50:13'),
(4, 1, 'Ervan Darmawan', 'XII', 'ervan@gmail.com', '021923402304', '2022-01-08 05:36:30', '2022-01-08 05:36:30'),
(5, 2, 'Adeyadsa', 'XII', 'adeyadsa@gmail.com', '029130219321', '2022-01-08 05:37:17', '2022-01-08 05:37:17'),
(6, 1, 'Fadhel', 'XII', 'fadhel@gmail.com', '0912312412', '2022-01-08 05:37:17', '2022-01-08 05:37:17'),
(7, 2, 'Href', 'XII', 'href.dev@gmail.com', '082371579665', '2022-01-20 14:42:29', '2022-01-20 14:42:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_role` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_role`, `username`, `password`, `email`, `nohp`, `alamat`, `createdAt`, `updatedAt`) VALUES
(2, 1, 'admin', '$2y$10$nrxUU8fCHCMSrviwDrvIie5Ofhg/ySkuBseQcgAeeeyaoVwcn9CH6', '', '', '', '2022-01-06 02:36:45', '2022-01-06 02:36:45'),
(3, 3, 'padaidi', '$2y$10$nrxUU8fCHCMSrviwDrvIie5Ofhg/ySkuBseQcgAeeeyaoVwcn9CH6', 'padaidibengkel@gmail.comaa', '0329482398402', 'asdasd', '2022-01-06 04:14:32', '2022-01-06 04:14:32'),
(4, 2, 'sekolah', '$2y$10$nrxUU8fCHCMSrviwDrvIie5Ofhg/ySkuBseQcgAeeeyaoVwcn9CH6', '', '', '', '2022-01-06 04:14:32', '2022-01-06 04:14:32'),
(5, 3, 'bengkel', '$2y$10$nrxUU8fCHCMSrviwDrvIie5Ofhg/ySkuBseQcgAeeeyaoVwcn9CH6', 'handilbengkel@gmail.comm', '09123912832100', 'Kebun Handils', '2022-01-06 05:02:05', '2022-01-06 05:02:05'),
(6, 0, 'fendi0a', '$2y$10$fZs2bpS7ztVo3Yai87jgu./g4l8fueIrUuWddN2AnwiUQMD6FA3m2', '', '', '', '2022-01-20 15:56:45', '2022-01-20 15:56:45'),
(7, 0, 'fendi0aas', '$2y$10$vk5LEO/7u71vy1.akv0PhO/gcGXiF2PC.RfXrry753xKFV1GrR5pa', '', '', '', '2022-01-20 15:57:13', '2022-01-20 15:57:13'),
(8, 0, 'fendi0asd', '$2y$10$0DRxD8z3LdlK4kn/PAIgnuz5CiIAgv7Z118g9FL6HM17/W2n8gsqq', 'asdkas@gmail.com', 'adsd', 'asd', '2022-01-20 16:02:49', '2022-01-20 16:02:49'),
(9, 3, 'fendi0', '$2y$10$lQMENeMJoBw030E7K.aTU.ZMMYDpknYuww.v3iJXBZcp8Q39C2.Gq', 'href.dev@gmail.com', '082371579665', 'Jl Satu maret', '2022-01-20 16:12:41', '2022-01-20 16:12:41'),
(10, 3, 'fendi0aasad', '$2y$10$Xt.dtcpLkf7agQhJT744ROOqnPzwNd9cuYzZR3ZxN.yQLkNxp0RKi', 'href.dev@gmail.coma', '082371579665', 'Jl Satu maret', '2022-01-20 16:13:15', '2022-01-20 16:13:15'),
(11, 3, 'asd', '$2y$10$mCEYFw92Wf5WgNOFkenNLeKD8Wh2y0QEK.Lc9IV/Zk0w8F9LS3x.y', 'superadmin@padaidicorp.com', 'asd', 'asd', '2022-01-20 16:40:34', '2022-01-20 16:40:34'),
(12, 3, 'pepen', '$2y$10$K48HWqM80/0CPFg0OFJQauJjE6lrNfGM5cGZpF4O1xsP4a3nK27oG', 'pepen@gmail.com', '0219391239', 'Jl satu maret', '2022-01-20 18:26:22', '2022-01-20 18:26:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 1),
(7, 2, 2),
(8, 2, 3),
(9, 2, 4),
(10, 2, 5),
(11, 3, 3),
(12, 3, 4),
(13, 1, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`role_id`, `role`) VALUES
(1, 'Admin'),
(2, 'Guru'),
(3, 'Bengkel');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agenda_id`);

--
-- Indeks untuk tabel `bengkel`
--
ALTER TABLE `bengkel`
  ADD PRIMARY KEY (`bengkel_id`);

--
-- Indeks untuk tabel `jadwal_pkl`
--
ALTER TABLE `jadwal_pkl`
  ADD PRIMARY KEY (`jadwal_pkl_id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`pembimbing_id`);

--
-- Indeks untuk tabel `permintaan_pkl`
--
ALTER TABLE `permintaan_pkl`
  ADD PRIMARY KEY (`permintaan_pkl_id`);

--
-- Indeks untuk tabel `pkl`
--
ALTER TABLE `pkl`
  ADD PRIMARY KEY (`pkl_id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `bengkel`
--
ALTER TABLE `bengkel`
  MODIFY `bengkel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jadwal_pkl`
--
ALTER TABLE `jadwal_pkl`
  MODIFY `jadwal_pkl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `pembimbing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `permintaan_pkl`
--
ALTER TABLE `permintaan_pkl`
  MODIFY `permintaan_pkl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pkl`
--
ALTER TABLE `pkl`
  MODIFY `pkl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
