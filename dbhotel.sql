-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 04:50 PM
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
-- Database: `dbhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` varchar(25) NOT NULL,
  `tipe_kamar` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `no_kamar`, `tipe_kamar`, `harga`, `image`, `status`) VALUES
(15, 'STD001', 'Standard', 138000, 'st1.jpg', 'Tersedia'),
(19, 'LXR001', 'Luxury', 424000, 'lx1.jpg', 'Tersedia'),
(21, 'DLX001', 'Deluxe', 256000, 'dl1.jpg', 'Tersedia'),
(23, 'LXR002', 'Luxury', 473000, 'lx2.jpg', 'Tersedia'),
(25, 'DLX002', 'Deluxe', 374000, 'dl2.jpg', 'Terpesan'),
(31, 'STD002', 'Standard', 165000, 'st2.jpg', 'Tersedia'),
(32, 'LXR003', 'Luxury', 437500, 'lx3.jpg', 'Tersedia'),
(33, 'DLX003', 'Deluxe', 268000, 'dl3.jpg', 'Tersedia'),
(34, 'STD003', 'Standard', 140000, 'st3.jpg', 'Terpesan');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `nik`, `alamat`, `email`, `no_hp`) VALUES
(38, 'Angga', '327702080107002', 'Cangkorah', 'angga@gmail.com', '08965423121'),
(40, 'Ghazwan', '3277010203050010', 'Batujajar', 'ghazwan@gmail.com', '089713712'),
(41, 'Iksal', '3277010203050871', 'Batujajar', 'iksal@gmail.com', '085579865132'),
(45, 'Flick Udin', '3277010203050003', 'Batujajar City', 'xavi@gmail.com', '0896543671'),
(46, 'Flick', '3277010203050003', 'Batujajar', 'xavi@gmail.com', '0896543671'),
(47, 'Flick', '4444444444444444', 'Batujajar', 'hflick@gmail.com', '0855798651'),
(48, 'Ghazwan', '4444444444444444', 'Batujajar', 'hflick@gmail.com', '087612315351'),
(49, 'Ghazwan', '4444444444444444', 'Batujajar', 'hflick@gmail.com', '087612315351'),
(50, 'Flick', '3277010203050003', 'Batujajar', 'flick@gmail.com', '0855798651');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(255) NOT NULL,
  `id_pemesanan` varchar(255) NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `status_pembayaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pemesanan`, `metode_pembayaran`, `total_pembayaran`, `tanggal_pembayaran`, `status_pembayaran`) VALUES
('OXO-PAY-0001', 'OXO-050624-0001', 'QRIS', 156800, '2024-06-05', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` varchar(255) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `tanggal_checkin` date NOT NULL,
  `tanggal_checkout` date NOT NULL,
  `jumlah_dewasa` int(11) NOT NULL,
  `jumlah_anak` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_pelanggan`, `id_kamar`, `tanggal_pesan`, `tanggal_checkin`, `tanggal_checkout`, `jumlah_dewasa`, `jumlah_anak`, `total_biaya`) VALUES
('OXO-050624-0001', 50, 34, '2024-06-05', '2024-06-05', '2024-06-06', 1, 0, 156800);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hak_akses` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `email`, `password`, `hak_akses`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'admin'),
(3, 'user', 'user@gmail', 'user', 'pengguna'),
(11, 'angga', 'angga@gmail.com', 'angga123', 'pengguna'),
(13, 'ghazwan', 'ghazwan@gmail.com', 'ghazwan', 'pengguna');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
