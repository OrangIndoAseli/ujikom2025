-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Apr 2025 pada 12.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sortiran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kategori` enum('makanan','minuman') NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `supplier_id` int(11) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `kategori`, `stok`, `supplier_id`, `harga`, `create_at`) VALUES
(1, 'Roti', 'makanan', 31, 1, 10000.00, '2025-04-10 10:03:22'),
(2, 'Susu', 'minuman', 300, 2, NULL, '2025-04-10 10:03:22'),
(4, 'Teh Botol', 'minuman', 180, 1, NULL, '2025-04-10 10:03:22'),
(9, 'Bakpau', 'makanan', 50, 1, 7500.00, '2025-04-10 18:45:53'),
(10, 'Chitato', 'makanan', 180, 3, 8000.00, '2025-04-10 18:47:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_distribusi`
--

CREATE TABLE `detail_distribusi` (
  `id_detail_distribusi` int(11) NOT NULL,
  `distribusi_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` decimal(12,2) DEFAULT NULL,
  `tujuan` varchar(60) DEFAULT NULL,
  `tanggal_distribusi` date DEFAULT NULL,
  `keterangan` varchar(30) DEFAULT NULL,
  `alamat` varchar(80) DEFAULT NULL,
  `nomortlp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_distribusi`
--

INSERT INTO `detail_distribusi` (`id_detail_distribusi`, `distribusi_id`, `barang_id`, `jumlah`, `harga`, `tujuan`, `tanggal_distribusi`, `keterangan`, `alamat`, `nomortlp`) VALUES
(5, 7, 1, 30, 10000.00, 'ptak', '2025-04-10', 'Berhasil Terkirim', NULL, NULL),
(6, 8, 1, 30, 300000.00, 'Rapli', '2025-04-11', 'Berhasil Terkirim', NULL, NULL),
(7, 9, 10, 400, 3200000.00, 'Rapli', '2025-04-10', 'Berhasil Terkirim', NULL, NULL),
(8, 10, 1, 5, 50000.00, 'Agus', '2025-04-10', 'Berhasil Terkirim', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `distribusi`
--

CREATE TABLE `distribusi` (
  `id_distribusi` int(11) NOT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `tanggal_distribusi` date NOT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `alamat` varchar(255) DEFAULT NULL,
  `nomortlp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `distribusi`
--

INSERT INTO `distribusi` (`id_distribusi`, `barang_id`, `jumlah`, `tujuan`, `tanggal_distribusi`, `harga`, `created_at`, `alamat`, `nomortlp`) VALUES
(11, 1, 4, 'Patak', '2025-04-11', 40000.00, '2025-04-11 09:57:15', NULL, NULL),
(12, 10, 50, 'Agus', '0000-00-00', 400000.00, '2025-04-11 10:17:50', 'Jalan Taman Bunga no 48 ', '81384993026'),
(13, 10, 70, 'Patak', '0000-00-00', 560000.00, '2025-04-11 10:22:20', 'bukit permata cimahi blok b no 35', '082223443677');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `kontak`, `alamat`, `created_at`) VALUES
(1, 'Supplier A', '081234567890', 'Jl. Raya No.1', '2025-04-02 03:00:51'),
(2, 'Supplier B', '082345678901', 'Jl. Merdeka No.2', '2025-04-02 03:00:51'),
(3, 'Supplier C', '083456789012', 'Jl. Sudirman No.3', '2025-04-02 03:00:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'c93ccd78b2076528346216b3b2f701e6', '2025-04-11 09:29:52', '2025-04-11 09:56:21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `detail_distribusi`
--
ALTER TABLE `detail_distribusi`
  ADD PRIMARY KEY (`id_detail_distribusi`),
  ADD KEY `distribusi_id` (`distribusi_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  ADD PRIMARY KEY (`id_distribusi`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `detail_distribusi`
--
ALTER TABLE `detail_distribusi`
  MODIFY `id_detail_distribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  MODIFY `id_distribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `detail_distribusi`
--
ALTER TABLE `detail_distribusi`
  ADD CONSTRAINT `detail_distribusi_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `distribusi`
--
ALTER TABLE `distribusi`
  ADD CONSTRAINT `distribusi_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
