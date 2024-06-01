-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Mar 2024 pada 02.07
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalibrary`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `BukuID` int(11) NOT NULL,
  `Judul` varchar(255) DEFAULT NULL,
  `Penulis` varchar(255) DEFAULT NULL,
  `Penerbit` varchar(255) DEFAULT NULL,
  `TahunTerbit` int(11) DEFAULT NULL,
  `CoverBuku` varchar(255) DEFAULT NULL,
  `NamaKategori` varchar(255) DEFAULT NULL,
  `SubKategori` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`BukuID`, `Judul`, `Penulis`, `Penerbit`, `TahunTerbit`, `CoverBuku`, `NamaKategori`, `SubKategori`, `stok`) VALUES
(2, 'Milea: Suara dari Dilan', 'Pidi Baiq', 'Pastel Books', 2016, '1706023826_40b9b4d5803aee1b44c7.jpg', 'Romance', 'Cinta', 7),
(3, 'Ancika: Dia yang Bersamaku Tahun 1995', 'Pidi Baiq', 'Pastel Books', 2021, '1706023930_06d8eff5df9988b5ebe7.jpg', 'Romance', 'Cinta', 8),
(4, 'Dilan: Dia adalah Dilanku tahun 1990', 'Pidi Baiq', 'Pastel Books', 2014, '1706065334_2cd361bd7aa0d5f2e1d8.jpg', 'Romance', 'Cinta', 9),
(5, 'Bumi ', 'Tere Liye', 'Gramedia Pustaka Utama', 2014, '1706073910_d0e301cb277055c012c0.jpg', 'Romance', 'petualangan, perang', 7),
(6, 'Bulan', 'Tere Liye', 'Gramedia Pustaka Utama', 2015, '1706074010_d2e3227d685a576b6c08.jpg', 'Romance', '', 10),
(7, 'Matahari', 'Tere Liye', 'Gramedia Pustaka Utama', 2016, '1706074230_ba0863f108c9830f384c.jpg', 'Romance', 'cinta, romantis', 9),
(9, 'Dilan', 'Dilan', 'Dilan', 2021, '1708348755_bca0dc1afabee8d72671.jpg', 'Comedy', 'lucu', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpeminjam`
--

CREATE TABLE `detailpeminjam` (
  `PeminjamanID` int(11) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL,
  `Judul` varchar(255) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `NoTransaksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `KategoriID` varchar(255) NOT NULL,
  `NamaKategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategoribuku`
--

INSERT INTO `kategoribuku` (`KategoriID`, `NamaKategori`) VALUES
('KT-001', 'Romance'),
('KT-002', 'Horror'),
('KT-003', 'Drama'),
('KT-004', 'Action'),
('KT-005', 'Triller'),
('KT-006', 'Comedy'),
('KT-007', 'Adventure');

-- --------------------------------------------------------

--
-- Struktur dari tabel `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `KoleksiID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL,
  `Judul` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `koleksipribadi`
--

INSERT INTO `koleksipribadi` (`KoleksiID`, `UserID`, `BukuID`, `Judul`, `Username`) VALUES
(1, 1, 3, 'Ancika: Dia yang Bersamaku Tahun 1995', 'Christiano');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjam`
--

CREATE TABLE `peminjam` (
  `PeminjamanID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL,
  `TanggalPeminjaman` date DEFAULT NULL,
  `TanggalPengembalian` date DEFAULT NULL,
  `StatusPeminjaman` varchar(50) DEFAULT NULL,
  `TotalBuku` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjam`
--

INSERT INTO `peminjam` (`PeminjamanID`, `UserID`, `BukuID`, `TanggalPeminjaman`, `TanggalPengembalian`, `StatusPeminjaman`, `TotalBuku`) VALUES
(1, 1, 7, '2024-02-27', '2024-03-01', 'kembali', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `PengembalianID` int(11) NOT NULL,
  `PeminjamanID` int(11) DEFAULT NULL,
  `TanggalKembali` date DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `hariKeterlambatan` int(3) DEFAULT NULL,
  `Denda` int(11) DEFAULT NULL,
  `UangDibayarkan` int(11) DEFAULT NULL,
  `UangKembalian` int(11) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`PengembalianID`, `PeminjamanID`, `TanggalKembali`, `UserID`, `hariKeterlambatan`, `Denda`, `UangDibayarkan`, `UangKembalian`, `BukuID`) VALUES
(1, 1, '2024-03-01', 1, 0, 0, 5000, 2000, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `PetugasID` int(11) NOT NULL,
  `NamaPetugas` varchar(255) DEFAULT NULL,
  `UsernamePetugas` varchar(255) DEFAULT NULL,
  `PasswordPetugas` varchar(255) DEFAULT NULL,
  `Level` enum('petugas','admin') DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`PetugasID`, `NamaPetugas`, `UsernamePetugas`, `PasswordPetugas`, `Level`, `Email`) VALUES
(2, ' Tian', 'Petugas 1', 'petugas1', 'petugas', 'petugas@petugas.com'),
(3, 'Petugas', 'Petugas 1', '123', 'petugas', 'petugas1@petugas.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkategori`
--

CREATE TABLE `subkategori` (
  `SubKategoriID` varchar(5) NOT NULL,
  `NamaSubKategori` varchar(50) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL,
  `Judul` varchar(255) DEFAULT NULL,
  `KategoriID` varchar(255) DEFAULT NULL,
  `NamaKategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `UlasanID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `BukuID` int(11) DEFAULT NULL,
  `Ulasan` text DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Judul` varchar(255) DEFAULT NULL,
  `TanggalUlasan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ulasanbuku`
--

INSERT INTO `ulasanbuku` (`UlasanID`, `UserID`, `BukuID`, `Ulasan`, `Rating`, `Username`, `Judul`, `TanggalUlasan`) VALUES
(1, 1, 3, 'test', 0, 'Christiano', 'Ancika: Dia yang Bersamaku Tahun 1995', '2024-02-29'),
(2, 1, 4, 'testetes', 0, 'Christiano', 'Dilan: Dia adalah Dilanku tahun 1990', '2024-03-01'),
(3, 1, 2, 'test', 0, 'Christiano', 'Milea: Suara dari Dilan', '2024-03-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `NamaLengkap` varchar(255) DEFAULT NULL,
  `Alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`) VALUES
(1, 'Christiano', '$2y$10$9G5Fj5xPZCFhHUaf/Rm9pebkL89gU.hueOmN1VuiZzEmdNgSMW.V.', 'christianoa3231@gmail.com', 'Christiano Anugerah', 'Bekasi'),
(2, 'user', '$2y$10$b4cH4zcuwMtCu3PcHeZXO.hWBdGkTb805aukOj2qxFqnFZZaa4Sva', 'user@user.com', 'username', 'ada'),
(3, 'user1', '$2y$10$gF2PboUOLYP/cRL.5Zo67OPoUUA8S.3If2ffM49BaKG86yCM0VrnO', 'user1@user.com', 'user1', 'rahasia'),
(4, 'user2', '$2y$10$hMlCFyu3ExErzSCeCpgew.GQlh7DARo46gkiuCgkpRukqiojaYIpG', 'user2@user.com', 'user2', 'rahasia'),
(6, 'test', '$2y$10$alLSG515WGdwrYWd8X3Pq..fTQR5lVKzgAMmLH3a8RTopZM8yZnnq', '1@gmail.com', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`BukuID`);

--
-- Indeks untuk tabel `detailpeminjam`
--
ALTER TABLE `detailpeminjam`
  ADD PRIMARY KEY (`NoTransaksi`);

--
-- Indeks untuk tabel `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indeks untuk tabel `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`KoleksiID`);

--
-- Indeks untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`PeminjamanID`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`PengembalianID`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`PetugasID`);

--
-- Indeks untuk tabel `subkategori`
--
ALTER TABLE `subkategori`
  ADD PRIMARY KEY (`SubKategoriID`);

--
-- Indeks untuk tabel `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`UlasanID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `BukuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `KoleksiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `PeminjamanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `PengembalianID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `PetugasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `UlasanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
