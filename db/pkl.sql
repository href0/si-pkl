-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2022 at 11:28 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

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
-- Table structure for table `agenda`
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
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`agenda_id`, `bengkel_id`, `siswa_id`, `tanggal_kegiatan`, `kegiatan`, `nilai_budaya_industri`, `createdAt`, `updatedAt`) VALUES
(3, 2, 2, '2022-01-07', 'asd', 'ad', '2022-01-07 01:17:14', '2022-01-07 01:17:14'),
(11, 1, 1, '2022-01-07', 'asfas', 'assa12312312', '2022-01-07 04:58:30', '2022-01-07 04:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `bengkel`
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
-- Dumping data for table `bengkel`
--

INSERT INTO `bengkel` (`bengkel_id`, `user_id`, `nama_bengkel`, `alamat_bengkel`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 3, 'Padaidi Bengkel', 'Perumahan Aur Duri Indah Blok D no 23', 1, '2022-01-06 05:01:05', '2022-01-06 05:01:05'),
(2, 5, 'Handil Bengkel', 'Kebun Handil', 1, '2022-01-06 05:03:33', '2022-01-06 05:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`, `url`, `icon`) VALUES
(1, 'Daftar Bengkel', 'bengkel', 'fas fa-cogs'),
(2, 'Siswa PKL', 'siswapkl', 'fas fa-users-cog'),
(3, 'Agenda', 'agenda', 'fas fa-calendar-alt'),
(4, 'PKL', 'pkl', 'fas fa-bell'),
(5, 'User', 'user', 'fas fa-users');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
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
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`pembimbing_id`, `nama_pembimbing`, `nohp_pembimbing`, `email_pembimbing`, `createdAt`, `updatedAt`) VALUES
(1, 'Mr Tabri', '08912301931', 'tabri@gmail.com', '2022-01-06 22:47:58', '2022-01-06 22:47:58'),
(2, 'Daniel ishutin', '0189091831', 'daniel@gmail.com', '2022-01-06 22:47:58', '2022-01-06 22:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
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
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `pembimbing_id`, `nama_siswa`, `kelas_siswa`, `email_siswa`, `nohp_siswa`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'Rinaldi Panca', 'XII', 'rinaldi@gmail.com', '091293912', '2022-01-06 22:49:52', '2022-01-06 16:49:34'),
(2, 2, 'Ilham', 'XII', 'ilham@gmail.com', '09821390128', '2022-01-06 22:50:13', '2022-01-06 22:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_role`, `username`, `password`, `email`, `nohp`, `alamat`, `createdAt`, `updatedAt`) VALUES
(2, 1, 'fendi0', '$2y$10$nrxUU8fCHCMSrviwDrvIie5Ofhg/ySkuBseQcgAeeeyaoVwcn9CH6', '', '', '', '2022-01-06 02:36:45', '2022-01-06 02:36:45'),
(3, 3, 'padaidi', '$2y$10$nrxUU8fCHCMSrviwDrvIie5Ofhg/ySkuBseQcgAeeeyaoVwcn9CH6', 'padaidibengkel@gmail.com', '0329482398402', '', '2022-01-06 04:14:32', '2022-01-06 04:14:32'),
(4, 2, 'guru', '$2y$10$nrxUU8fCHCMSrviwDrvIie5Ofhg/ySkuBseQcgAeeeyaoVwcn9CH6', '', '', '', '2022-01-06 04:14:32', '2022-01-06 04:14:32'),
(5, 3, 'handilbengkel', '$2y$10$nrxUU8fCHCMSrviwDrvIie5Ofhg/ySkuBseQcgAeeeyaoVwcn9CH6', 'handilbengkel@gmail.com', '091239128321', 'Kebun Handil', '2022-01-06 05:02:05', '2022-01-06 05:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
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
(12, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role`) VALUES
(1, 'Admin'),
(2, 'Guru'),
(3, 'Bengkel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agenda_id`);

--
-- Indexes for table `bengkel`
--
ALTER TABLE `bengkel`
  ADD PRIMARY KEY (`bengkel_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`pembimbing_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bengkel`
--
ALTER TABLE `bengkel`
  MODIFY `bengkel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `pembimbing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
