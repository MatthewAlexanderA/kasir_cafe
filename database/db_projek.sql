-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jun 2021 pada 13.50
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_projek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_makanan`
--

CREATE TABLE `tb_makanan` (
  `id` int(11) NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_makanan`
--

INSERT INTO `tb_makanan` (`id`, `gambar`, `nama`, `harga`) VALUES
(1, 'kentang.jpg', 'Kentang Sosis', 25000),
(2, 'roti.jpg', 'Roti Bakar', 20000),
(3, 'pisang.jpg', 'Pisang Bakar', 20000),
(4, 'hotdog.jpg', 'Hotdog', 30000),
(5, 'burger.jpeg', 'Burger', 30000),
(6, 'air.jpg', 'Air Mineral', 10000),
(7, 'kopi.jpg', 'Kopi', 20000),
(8, 'softdrink.jpg', 'Soft Drink', 15000),
(9, 'teh.jpg', 'Teh', 10000),
(10, 'es.jpg', 'Es Krim', 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `nomor` varchar(10) NOT NULL,
  `total` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bayar` bigint(20) NOT NULL,
  `kembali` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `tanggal_waktu`, `nomor`, `total`, `nama`, `bayar`, `kembali`) VALUES
(4, '2021-05-27 11:27:30', '183749', 75000, 'admin', 100000, 25000),
(11, '2021-06-02 05:27:00', '229953', 35000, 'admin', 50000, 15000),
(15, '2021-06-02 06:45:31', '749439', 185000, 'admin', 200000, 15000),
(17, '2021-06-02 11:55:26', '606756', 135000, 'matthew', 150000, 15000),
(24, '2021-06-06 09:33:36', '548812', 60000, 'kasir', 70000, 10000),
(25, '2021-06-06 09:41:58', '778612', 150000, 'admin', 150000, 0),
(26, '2021-06-08 13:37:01', '824925', 545000, 'kasir', 550000, 5000),
(27, '2021-06-08 13:39:43', '142477', 505000, 'kasir', 600000, 95000),
(28, '2021-06-15 13:45:04', '187113', 135000, 'admin', 150000, 15000),
(30, '2021-06-15 13:46:31', '497674', 30000, 'admin', 50000, 20000),
(31, '2021-06-15 13:47:12', '179490', 85000, 'admin', 100000, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi_detail`
--

CREATE TABLE `tb_transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi_detail`
--

INSERT INTO `tb_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id`, `harga`, `jumlah`, `total`) VALUES
(10, 4, 1, 25000, 1, 25000),
(11, 4, 3, 20000, 1, 20000),
(12, 4, 8, 15000, 2, 30000),
(26, 11, 3, 20000, 1, 20000),
(27, 11, 8, 15000, 1, 15000),
(33, 15, 2, 20000, 3, 60000),
(34, 15, 8, 15000, 4, 60000),
(35, 15, 10, 25000, 1, 25000),
(36, 15, 3, 20000, 2, 40000),
(40, 17, 2, 20000, 1, 20000),
(41, 17, 8, 15000, 2, 30000),
(42, 17, 5, 30000, 2, 60000),
(43, 17, 10, 25000, 1, 25000),
(50, 24, 9, 10000, 1, 10000),
(51, 24, 3, 20000, 2, 40000),
(52, 24, 6, 10000, 1, 10000),
(53, 25, 2, 20000, 1, 20000),
(54, 25, 5, 30000, 2, 60000),
(55, 25, 10, 25000, 1, 25000),
(56, 25, 8, 15000, 3, 45000),
(57, 26, 1, 25000, 3, 75000),
(58, 26, 2, 20000, 2, 40000),
(59, 26, 3, 20000, 3, 60000),
(60, 26, 4, 30000, 2, 60000),
(61, 26, 10, 25000, 4, 100000),
(62, 26, 9, 10000, 4, 40000),
(63, 26, 8, 15000, 2, 30000),
(64, 26, 7, 20000, 2, 40000),
(65, 26, 6, 10000, 1, 10000),
(66, 26, 5, 30000, 3, 90000),
(67, 27, 4, 30000, 3, 90000),
(68, 27, 5, 30000, 3, 90000),
(69, 27, 1, 25000, 6, 150000),
(70, 27, 8, 15000, 4, 60000),
(71, 27, 10, 25000, 3, 75000),
(72, 27, 7, 20000, 2, 40000),
(73, 28, 2, 20000, 1, 20000),
(74, 28, 5, 30000, 2, 60000),
(75, 28, 8, 15000, 2, 30000),
(76, 28, 10, 25000, 1, 25000),
(77, 30, 3, 20000, 1, 20000),
(78, 30, 9, 10000, 1, 10000),
(79, 31, 3, 20000, 2, 40000),
(80, 31, 9, 10000, 2, 20000),
(81, 31, 10, 25000, 1, 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` int(50) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 123, 1),
(2, 'matthew', 321, 2),
(5, 'kasir', 333, 2),
(11, 'budi', 2323, 2),
(12, 'anto', 555, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_makanan`
--
ALTER TABLE `tb_makanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_makanan`
--
ALTER TABLE `tb_makanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
