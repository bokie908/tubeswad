-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 09, 2021 at 07:04 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `careerhuntersql`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `updated_at`, `created_at`) VALUES
(1, 'admin', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lokers`
--

CREATE TABLE `lokers` (
  `id` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL DEFAULT 0,
  `posisi` varchar(255) NOT NULL DEFAULT '0',
  `job_desc` text NOT NULL DEFAULT '0',
  `persyaratan` text NOT NULL DEFAULT '0',
  `jenis_pekerjaan` varchar(255) NOT NULL DEFAULT '0',
  `usia_min` int(11) NOT NULL,
  `usia_max` int(11) NOT NULL,
  `gaji_min` int(11) DEFAULT NULL,
  `gaji_max` int(11) DEFAULT NULL,
  `kualifikasi` text NOT NULL,
  `pengalaman_min` int(11) NOT NULL DEFAULT 0,
  `status_loker` varchar(255) NOT NULL,
  `info_tahap1` text DEFAULT NULL,
  `tanggal_tahap1` date DEFAULT NULL,
  `info_tahap2` text DEFAULT NULL,
  `tanggal_tahap2` date DEFAULT NULL,
  `info_tahap3` text DEFAULT NULL,
  `tanggal_tahap3` date DEFAULT NULL,
  `info_tahap4` text DEFAULT NULL,
  `tanggal_tahap4` date DEFAULT NULL,
  `wawancara` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokers`
--

INSERT INTO `lokers` (`id`, `perusahaan_id`, `posisi`, `job_desc`, `persyaratan`, `jenis_pekerjaan`, `usia_min`, `usia_max`, `gaji_min`, `gaji_max`, `kualifikasi`, `pengalaman_min`, `status_loker`, `info_tahap1`, `tanggal_tahap1`, `info_tahap2`, `tanggal_tahap2`, `info_tahap3`, `tanggal_tahap3`, `info_tahap4`, `tanggal_tahap4`, `wawancara`, `updated_at`, `created_at`) VALUES
(7, 5, 'Developer', 'Web developer', 'S1 Sistem Informasi ipk 3.0', 'fulltime', 18, 20, 1, 200000, 'tidak ada', 2, 'diterima', 'lulus administrasi', '2021-06-10', 'siapkan alat tulis', '2021-06-10', 'persiapkan diri anda', '2021-06-10', 'wawancara di gedung a telkom university', '2021-06-10', 'offline', '2021-06-09 17:02:52', '2021-06-09 16:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan_users`
--

CREATE TABLE `perusahaan_users` (
  `id` int(11) NOT NULL,
  `nama_pj` varchar(255) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `no_hp_pj` varchar(255) DEFAULT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `email_perusahaan` varchar(255) DEFAULT NULL,
  `no_perusahaan` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto_akta` varchar(255) DEFAULT NULL,
  `status_verifikasi` varchar(255) NOT NULL DEFAULT 'belum',
  `website` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT 'belum',
  `tujuan` text DEFAULT 'belum',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perusahaan_users`
--

INSERT INTO `perusahaan_users` (`id`, `nama_pj`, `foto_profil`, `no_hp_pj`, `nama_perusahaan`, `email_perusahaan`, `no_perusahaan`, `username`, `password`, `kota`, `alamat`, `foto_akta`, `status_verifikasi`, `website`, `deskripsi`, `tujuan`, `updated_at`, `created_at`) VALUES
(5, 'Adiwijaya', '369486_download (1).jpg', '12345678', 'Telkom Indonesia', 'telkom@telkomindonesia.ac.id', '12345678', 'telkomindonesia', '12345678', 'Bandung', 'Jl. Telekomunikasi No 2, Bandung, Jawa Barat, 4025', '532567download (8).jfif', 'sudah', NULL, 'belum', 'belum', '2021-06-09 16:57:25', '2021-06-09 16:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `request_posisi`
--

CREATE TABLE `request_posisi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `loker_id` int(11) NOT NULL DEFAULT 0,
  `status_request` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_posisi`
--

INSERT INTO `request_posisi` (`id`, `user_id`, `loker_id`, `status_request`, `updated_at`, `created_at`) VALUES
(14, 4, 7, 'diterima', '2021-06-09 17:02:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kelamin` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto_ktp` varchar(255) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `education` text DEFAULT '',
  `tentang` text DEFAULT '',
  `experience` text DEFAULT '',
  `cv` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `portfolio` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `no_hp`, `password`, `kelamin`, `tanggal_lahir`, `foto_ktp`, `foto_profil`, `education`, `tentang`, `experience`, `cv`, `website`, `portfolio`, `updated_at`, `created_at`) VALUES
(4, 'hafiz', 'hafizhawarizmi06@gmail.com', '12345678', '12345678', 'pria', '2021-06-09', '85551411458135931_PAS_FOTO_1.jpg', NULL, '', '', '', '11554_1202184147 Registrasi _ Telkom University.pdf', 'google.com', NULL, '2021-06-09 16:59:37', '2021-06-09 16:46:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokers`
--
ALTER TABLE `lokers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perusahaan_users`
--
ALTER TABLE `perusahaan_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_posisi`
--
ALTER TABLE `request_posisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lokers`
--
ALTER TABLE `lokers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `perusahaan_users`
--
ALTER TABLE `perusahaan_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request_posisi`
--
ALTER TABLE `request_posisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
