-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Apr 2025 pada 16.00
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpusdigital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `bukuId` int(11) NOT NULL,
  `judul_buku` varchar(25) NOT NULL,
  `penulis` varchar(25) NOT NULL,
  `penerbit` varchar(25) NOT NULL,
  `gambar_buku` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `ebook` int(11) NOT NULL,
  `tahun_terbit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`bukuId`, `judul_buku`, `penulis`, `penerbit`, `gambar_buku`, `kategori_id`, `ebook`, `tahun_terbit`) VALUES
(11, 'Tunnel Links', 'Prestu', 'Nulice', 'White Orange Yellow Modern Geometric Project Proposal Cover_20250306_191245_0000.png', 16, 14, '2009-03-12'),
(12, 'Junji Into', 'Lorek', 'Poligami', 'logo mm_page-0001 (1).jpg', 17, 11, '2025-04-17'),
(13, 'Forest Gump', 'Apares', 'Nurih', 'Dark Blue and Grey Geometric Business Proposal Cover Page Document_20250305_171138_0000.png', 15, 12, '2004-12-23'),
(14, 'Pergi', 'Rions', 'Kolega', 'Cheaps Store.png', 8, 13, '1942-03-12'),
(15, 'yets', 'teyg', 'ygd', '57a1449c-7187-4b0a-a0b5-5db57af27ca8-removebg-preview.png', 15, 14, '2003-12-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ebooks`
--

CREATE TABLE `ebooks` (
  `id` int(11) NOT NULL,
  `nama_buku` varchar(100) NOT NULL,
  `file_path` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ebooks`
--

INSERT INTO `ebooks` (`id`, `nama_buku`, `file_path`) VALUES
(10, 'Pergi Ke Tanah Baghad', 'assets/ebook/Elegant Minimalist A4 Stationery Paper Document.pdf'),
(11, 'Junjo Ito', 'assets/ebook/Achmad Rifandiyansyah - CV.pdf'),
(12, 'Forest Gump', 'assets/ebook/Notes_250205_202912.pdf'),
(13, 'Pergi', 'assets/ebook/CV - Achmad Rifandiyansyah.pdf'),
(14, 'Pulang Yang ada', 'assets/ebook/Latihan soal US 2425.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategoriId` int(11) NOT NULL,
  `nama_kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategoriId`, `nama_kategori`) VALUES
(8, 'Romance'),
(13, 'Action'),
(15, 'Slice of Life'),
(16, 'Mystery'),
(17, 'Supranatural');

-- --------------------------------------------------------

--
-- Struktur dari tabel `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `koleksiId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bukuId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `koleksipribadi`
--

INSERT INTO `koleksipribadi` (`koleksiId`, `userId`, `bukuId`) VALUES
(12, 2, 11),
(13, 2, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `peminjamanId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bukuId` int(11) NOT NULL,
  `tanggal_peminjaman` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_pengembalian` date NOT NULL,
  `tanggal_kembali` timestamp NULL DEFAULT NULL,
  `status_peminjaman` varchar(20) NOT NULL,
  `total_denda` int(11) NOT NULL,
  `status_pembayaran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`peminjamanId`, `userId`, `bukuId`, `tanggal_peminjaman`, `tanggal_pengembalian`, `tanggal_kembali`, `status_peminjaman`, `total_denda`, `status_pembayaran`) VALUES
(44, 2, 10, '2025-04-11 09:33:34', '2025-04-18', '2025-04-11 09:33:34', 'Dikembalikan', 0, NULL),
(45, 2, 12, '2025-04-11 11:35:26', '2025-04-18', '2025-04-11 11:35:26', 'Dikembalikan', 0, NULL),
(46, 2, 10, '2025-04-11 11:35:27', '2025-04-18', '2025-04-11 11:35:27', 'Dikembalikan', 0, NULL),
(47, 5, 10, '2025-04-15 00:11:04', '2025-04-22', NULL, 'Dipinjam', 0, NULL),
(48, 5, 11, '2025-04-15 00:22:09', '2025-04-22', NULL, 'Dipinjam', 0, NULL),
(49, 7, 12, '2025-04-16 02:10:26', '2025-04-23', NULL, 'Dipinjam', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `roleId` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`roleId`, `role`) VALUES
(1, 'admin'),
(2, 'petugas'),
(3, 'peminjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `ulasanId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bukuId` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int(11) NOT NULL,
  `status` enum('disetujui','ditolak','menunggu') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasanbuku`
--

INSERT INTO `ulasanbuku` (`ulasanId`, `userId`, `bukuId`, `ulasan`, `rating`, `status`) VALUES
(13, 6, 15, 'dsd', 4, 'menunggu'),
(14, 7, 12, 'sadas', 5, 'disetujui'),
(15, 7, 12, 'sdads', 4, 'menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` text DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `email`, `alamat`, `role_id`) VALUES
(1, 'cek', '$2y$10$rn.qq7DmmLsNg/s0uZIkjeLgJLHNeUnZy5p0hJxtgit8e3flF3AW2', 'admin@gmail.com', 'eck', 1),
(2, 'james', '$2y$10$TuUSAoZeInXrxF18YQKxsOWL6qIARSkKPyzBBXsNqbsMrmx1R8tdi', 'cek1@gmail.com', 'asd', 3),
(3, 'petugas1', '$2y$10$PzHIfB1n9J33ZEdt5L8WdeF6Rcq7PgPmdrm4uQVvM/c39WLC3ZSMS', 'cek2@gmail.com', 'cek', 2),
(4, 'kuir', '$2y$10$q2eECIpULz7U5oCpuJ/MWeXy5lEzqS.bPKymVuMZmc6rahWV79ojm', 'kri@gmail.com', 'apa', 3),
(5, 'Achmad Rifan Diyansyah', '$2y$10$ZNtPtuF5gcyr9r1g4zPvTuURwZGupoQ6pbJPkpi/.832OfVscXQzy', 'rifan@gmail.com', 'jl pabuaran', 3),
(6, 'reza', '$2y$10$Z1OqGbjQZFjFzji5tVYypehANUaUy.xRT1kFM1MuwqOn/ls92HO5a', 'reza@gmail.com', 'cilodong', 3),
(7, 'cek', '$2y$10$fFIhF5UPPHBOoBhdoUVq9eCgBmVvMhpYRxQChuyeqnJ1XJ45BYM9W', 'l@gmail.com', 'sah', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`bukuId`);

--
-- Indeks untuk tabel `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriId`);

--
-- Indeks untuk tabel `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`koleksiId`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`peminjamanId`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleId`);

--
-- Indeks untuk tabel `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`ulasanId`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `bukuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategoriId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `koleksiId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `peminjamanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `ulasanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
