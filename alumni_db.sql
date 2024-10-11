-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 03:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `tanggal_diubah` datetime DEFAULT NULL,
  `editor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`, `tanggal_diubah`, `editor`) VALUES
(7, 'Admin BKK', '2023-12-06 22:03:35', '1'),
(8, 'Rekayasa Perangkat Lunak', '2023-12-06 22:03:41', '1'),
(9, 'Teknik Komputer Jaringan', '2023-12-06 22:03:45', '1'),
(10, 'Akuntansi dan Keuangan Lembaga', '2023-12-06 22:04:01', '1'),
(11, 'Otomatisasi dan Tata Kelola Perkantoran', '2023-12-06 22:04:20', '1'),
(12, 'Bisnis Daring dan Pemasaran', '2023-12-06 22:04:44', '1'),
(13, 'Tata Busana', '2023-12-06 22:04:48', '1');

-- --------------------------------------------------------

--
-- Table structure for table `loker`
--

CREATE TABLE `loker` (
  `id_loker` int(11) NOT NULL,
  `judul_loker` varchar(35) NOT NULL,
  `isi_loker` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `mitra` varchar(50) NOT NULL,
  `tanggal_penutupan_loker` date NOT NULL,
  `tanggal_diubah` datetime DEFAULT NULL,
  `editor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loker`
--

INSERT INTO `loker` (`id_loker`, `judul_loker`, `isi_loker`, `photo`, `mitra`, `tanggal_penutupan_loker`, `tanggal_diubah`, `editor`) VALUES
(1, 'Campaign Management - PT JKL', 'syarat dan ketentuan :\r\n1. Memahami Social Media Planning\r\n2. Mempunyai skill public speaking yang bagus\r\n3. Cepat dalam belajar \r\n4. Minimal semester 5, maksimal semester akhir\r\n5. Teliti\r\n6. Semangat belajar\r\n7. Mudah berbaur dengan para crew', 'http://localhost/web-alumni/uploads/files/6zbd1cjmeaqv5ru.png', '3', '2023-12-27', '2023-12-07 20:45:07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(11) NOT NULL,
  `mitra` varchar(255) NOT NULL,
  `tanggal_diubah` datetime DEFAULT NULL,
  `editor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `mitra`, `tanggal_diubah`, `editor`) VALUES
(1, 'XYZ', '2023-12-06 22:19:32', '1'),
(2, 'GHI', '2023-12-06 22:19:39', '1'),
(3, 'JKL', '2023-12-06 22:19:36', '1'),
(4, 'MNO', '2023-12-06 22:19:17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `judul_pengumuman` varchar(255) NOT NULL,
  `isi_pengumuman` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `tanggal_diubah` datetime DEFAULT NULL,
  `editor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul_pengumuman`, `isi_pengumuman`, `photo`, `tanggal_diubah`, `editor`) VALUES
(1, 'Perayaan Tahun Baru Alumni 2021', 'Lokasi di sekolah pada 31 Desember 2023', 'http://localhost/web-alumni/uploads/files/4nmcwvkhr_6287p.png', '2023-12-06 22:21:06', '1');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `tanggal_diubah` datetime DEFAULT NULL,
  `editor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `tanggal_diubah`, `editor`) VALUES
(1, 'Administrator', '2023-12-06 22:22:09', '1'),
(2, 'User', '2023-12-06 22:22:06', '1');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`permission_id`, `role_id`, `page_name`, `action_name`) VALUES
(2282, 1, 'jurusan', 'list'),
(2283, 1, 'jurusan', 'view'),
(2284, 1, 'jurusan', 'add'),
(2285, 1, 'jurusan', 'edit'),
(2286, 1, 'jurusan', 'editfield'),
(2287, 1, 'jurusan', 'delete'),
(2288, 1, 'jurusan', 'import_data'),
(2289, 1, 'loker', 'list'),
(2290, 1, 'loker', 'view'),
(2291, 1, 'loker', 'add'),
(2292, 1, 'loker', 'edit'),
(2293, 1, 'loker', 'editfield'),
(2294, 1, 'loker', 'delete'),
(2295, 1, 'loker', 'import_data'),
(2296, 1, 'mitra', 'list'),
(2297, 1, 'mitra', 'view'),
(2298, 1, 'mitra', 'add'),
(2299, 1, 'mitra', 'edit'),
(2300, 1, 'mitra', 'editfield'),
(2301, 1, 'mitra', 'delete'),
(2302, 1, 'mitra', 'import_data'),
(2303, 1, 'pengumuman', 'list'),
(2304, 1, 'pengumuman', 'view'),
(2305, 1, 'pengumuman', 'add'),
(2306, 1, 'pengumuman', 'edit'),
(2307, 1, 'pengumuman', 'editfield'),
(2308, 1, 'pengumuman', 'delete'),
(2309, 1, 'pengumuman', 'import_data'),
(2310, 1, 'user', 'list'),
(2311, 1, 'user', 'view'),
(2312, 1, 'user', 'add'),
(2313, 1, 'user', 'edit'),
(2314, 1, 'user', 'editfield'),
(2315, 1, 'user', 'delete'),
(2316, 1, 'user', 'import_data'),
(2317, 1, 'user', 'userregister'),
(2318, 1, 'user', 'accountedit'),
(2319, 1, 'user', 'accountview'),
(2320, 1, 'role_permissions', 'list'),
(2321, 1, 'role_permissions', 'view'),
(2322, 1, 'role_permissions', 'add'),
(2323, 1, 'role_permissions', 'edit'),
(2324, 1, 'role_permissions', 'editfield'),
(2325, 1, 'role_permissions', 'delete'),
(2326, 1, 'roles', 'list'),
(2327, 1, 'roles', 'view'),
(2328, 1, 'roles', 'add'),
(2329, 1, 'roles', 'edit'),
(2330, 1, 'roles', 'editfield'),
(2331, 1, 'roles', 'delete'),
(2332, 1, 'user', 'list'),
(2333, 1, 'user', 'view'),
(2334, 1, 'user', 'add'),
(2335, 1, 'user', 'edit'),
(2336, 1, 'user', 'editfield'),
(2337, 1, 'user', 'delete'),
(2338, 1, 'user', 'alumni'),
(2339, 1, 'user', 'admin'),
(2340, 1, 'tahun_lulus', 'list'),
(2341, 1, 'tahun_lulus', 'view'),
(2342, 1, 'tahun_lulus', 'add'),
(2343, 1, 'tahun_lulus', 'edit'),
(2344, 1, 'tahun_lulus', 'editfield'),
(2345, 1, 'tahun_lulus', 'delete'),
(2346, 1, 'tahun_lulus', 'list'),
(2347, 1, 'tahun_lulus', 'view'),
(2348, 1, 'tahun_lulus', 'add'),
(2349, 1, 'tahun_lulus', 'edit'),
(2350, 1, 'tahun_lulus', 'editfield'),
(2351, 1, 'tahun_lulus', 'delete'),
(2352, 2, 'loker', 'list'),
(2353, 2, 'loker', 'view'),
(2354, 2, 'pengumuman', 'list'),
(2355, 2, 'pengumuman', 'view'),
(2356, 2, 'user', 'userregister'),
(2357, 2, 'user', 'accountedit'),
(2358, 2, 'user', 'accountview'),
(2359, 2, 'user', 'alumni'),
(2360, 2, 'user', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_lulus`
--

CREATE TABLE `tahun_lulus` (
  `id_tahun_lulus` int(11) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `id_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(2) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pekerjaan_saat_ini` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2024-03-05 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL,
  `account_status` varchar(255) DEFAULT 'Pending',
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `jenis_kelamin`, `tahun_lulus`, `jurusan`, `email`, `password`, `no_telepon`, `alamat`, `pekerjaan_saat_ini`, `photo`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`, `account_status`, `user_role_id`) VALUES
(1, 'Shelya', 'P', '2021', '8', 'shelya@gmail.com', '$2y$10$xxiRct/tHr7qfj.ywFyc9uWoIPjyJsoVOFELTvAEuqN.KsLPqZHDu', '01234567890', 'Purwakarta', 'Pelajar/ Mahasiswa', 'http://localhost/web-alumni/uploads/files/9v5hywbmt68ujis.JPG', NULL, NULL, '2024-03-05 22:34:06', NULL, 'Active', 1),
(2, 'Alvin', 'L', '2021', '9', 'alvin@gmail.com', '$2y$10$gQaQgTyii/qKaSfWSLhX0OSudYPJBdxtAEi/aV0aSkr5JZTeuLLN2', '0123456789', 'Purwakarta', 'Dosen', 'http://localhost/web-alumni/uploads/files/qkox7fen_zlda4y.png', NULL, NULL, '2024-03-05 00:00:00', NULL, 'Active', 2),
(3, 'Suci', 'P', '2021', '13', 'suci@gmail.com', '$2y$10$/hFa8qDOpkEAbTm/WSd07.hZ1D6Pobx6J6jTV.qPeYBT13A3iHc0G', '123456789', 'Purwakarta', 'Pelajar/ Mahasiswa', 'http://localhost/web-alumni/uploads/files/pa13w2cly7n6tks.png', NULL, NULL, '2024-03-05 00:00:00', NULL, 'Active', 2),
(5, 'Uus', 'P', '2021', '13', 'uus@gmail.com', '$2y$10$kfZZ3NLOpcuTU197bTjEuOFGo6HnUgog87RRO6j/.OVju7li8ETIm', '0855588555', 'Bandung', 'Belum/ Tidak Bekerja', 'http://localhost/web-alumni/uploads/files/dq_0junk53mih4f.png', NULL, NULL, '2024-03-05 00:00:00', NULL, 'Active', 2),
(6, 'Pingkrun', 'P', '2020', '13', 'pingkrun@gmail.com', '$2y$10$FaDicCsX4hDBrD/uXlD8JO7cIPof84GRiC2xCdEmsBOy3oDiebPr.', '08123456789', 'Purwakarta', 'Mengurus Rumah Tangga', 'http://localhost/web-alumni/uploads/files/ymstuniadp7k03c.jpg', NULL, NULL, '2024-03-05 00:00:00', NULL, 'Active', 2),
(7, 'Citra', 'P', '2020', '11', 'citra@gmail.com', '$2y$10$zWz/Td0tNfaENXAtiGBUHucdovln29zSBnU5562A0wZN17bW4eF3W', '0858588888', 'Purwakarta', 'Mengurus Rumah Tangga', 'http://localhost/web-alumni/uploads/files/6ylfq0ius3x8rnz.jpg', NULL, NULL, '2024-03-05 00:00:00', NULL, 'Pending', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `loker`
--
ALTER TABLE `loker`
  ADD PRIMARY KEY (`id_loker`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `tahun_lulus`
--
ALTER TABLE `tahun_lulus`
  ADD PRIMARY KEY (`id_tahun_lulus`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_jurusan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `loker`
--
ALTER TABLE `loker`
  MODIFY `id_loker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2361;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
