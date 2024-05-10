-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Okt 2023 pada 21.23
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simretribusi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_npwrd`
--

CREATE TABLE `tb_npwrd` (
  `id_npwrd` int(11) NOT NULL,
  `jenis_objek` varchar(50) NOT NULL,
  `nama_objek` varchar(100) NOT NULL,
  `nama_wilayah` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `npwrd` varchar(20) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_npwrd`
--

INSERT INTO `tb_npwrd` (`id_npwrd`, `jenis_objek`, `nama_objek`, `nama_wilayah`, `alamat`, `npwrd`, `keterangan`) VALUES
(29, 'Rumah Makan', 'RM Pinang', 'Sukarame', 'J. T. Sukarame 2', '02001', ''),
(31, 'Rumah Sakit', 'Adven', 'Sukarame', 'Jl. Sukarame', '03001', ''),
(32, 'Sekolah', 'Smk BLK Bandar Lampung', 'Sukarame', 'Jl. Sukarame', '04001', 'STM'),
(33, 'Rumah Makan', 'RM Pinang', 'Labuhan Ratu', 'Jl. T. Umar', '02002', ''),
(34, 'Hotel', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01002', ''),
(35, 'Kantor', 'Hotel Horison', 'Sukabumi', 'Jl. T. Umar', '01003', ''),
(36, 'Hotel', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01004', ''),
(37, 'Kantor', 'Angga Tenyom', 'Kemiling', 'Karang Anyar', '01005', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_objek`
--

CREATE TABLE `tb_objek` (
  `id_objek` int(11) NOT NULL,
  `nama_objek` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_objek`
--

INSERT INTO `tb_objek` (`id_objek`, `nama_objek`) VALUES
(1, 'Hotel'),
(2, 'Kantor'),
(3, 'Toko/Ruko'),
(5, 'Rumah Makan'),
(6, 'Bengkel'),
(7, 'Rumah Sakit'),
(8, 'Sekolah'),
(9, 'Alfamart & Indomart'),
(10, 'Gedung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(25) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `nama_petugas`, `no_telp`, `alamat`) VALUES
(1, 'SAHIDIN', '0839936474', 'Lupa Juga'),
(2, 'YUDI S', '08387462874', 'Lupa'),
(13, 'Mely Noviani', '083115520678', 'Gd Wani'),
(14, 'ALFIAN ANGGA NUGROHO', '081272581081', 'Jalan Ledok Sari'),
(16, 'TENYOM', '0888371933', 'Tenyom\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_potensi`
--

CREATE TABLE `tb_potensi` (
  `id_potensi` int(11) NOT NULL,
  `nama_petugas` varchar(25) NOT NULL,
  `nama_objek` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `retribusi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_potensi`
--

INSERT INTO `tb_potensi` (`id_potensi`, `nama_petugas`, `nama_objek`, `alamat`, `retribusi`, `tanggal`, `keterangan`) VALUES
(3, 'YUDI S', 'MALL  BOEMI KEDATON', 'Jl. T. Umar', 500000, '2023-08-26', 'tidak ada'),
(4, 'SAHIDIN', 'PT REKSO NASIONAL FOOD', 'Jl. Antasari', 1000000, '2023-08-26', 'tidak ada'),
(7, 'YUDI S', 'MALL  BOEMI KEDATON', 'Jl. T. Umar', 2500000, '2023-08-28', 'tidak ada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_retribusi`
--

CREATE TABLE `tb_retribusi` (
  `id_retribusi` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `nama_objek` varchar(100) NOT NULL,
  `nama_wilayah` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `npwrd` varchar(20) NOT NULL,
  `nilai_retribusi` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_retribusi`
--

INSERT INTO `tb_retribusi` (`id_retribusi`, `nama_petugas`, `nama_objek`, `nama_wilayah`, `alamat`, `npwrd`, `nilai_retribusi`, `status`, `keterangan`, `tanggal`) VALUES
(49, 'YUDI S', 'Hotel Horison', 'Sukabumi', 'Gedung Wani', '08.004', 500000, 'Sudah Bayar', 'Cicil', '2023-10-04'),
(55, 'SAHIDIN', 'Hotel Horison', 'Sukabumi', 'J. T. Umar', '08.003', 200000, 'Sudah Bayar', '', '2023-10-04'),
(64, 'SAHIDIN', 'Angga Tenyom', 'Kemiling', 'Karang Anyar', '08.005', 500000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(66, 'YUDI S', 'TEST2', 'Labuhan Ratu', 'Jl. Antasari', '08.008', 1000000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(67, 'YUDI S', 'TEST2', 'Labuhan Ratu', 'Jl. Antasari', '08.008', 500000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(68, 'Tenyom', 'Sekolah TEST', 'Sukabumi', 'Jl. Antasari', '08.007', 500000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(69, 'SAHIDIN', 'Hotel Horison', 'Sukabumi', 'J. T. Umar', '08.003', 1000000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(70, 'Tenyom', 'Angga Tenyom', 'Kemiling', 'Karang Anyar', '08.005', 200000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(71, 'ALFIAN ANGGA NUGROHO', 'PT REKSO NASIONAL FOOD', 'Sukarame', 'Jl. T. Umar', '08.001', 200000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(72, 'SAHIDIN', 'Hotel Horison', 'Sukabumi', 'Gedung Wani', '08.004', 60000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(73, 'Tenyom', 'Sekolah TEST', 'Sukabumi', 'Jl. Antasari', '08.007', 80000000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(74, 'Tenyom', 'Hotel Horison', 'Sukabumi', 'J. T. Umar', '08.003', 200000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(75, 'YUDI S', 'Dinas', 'Kemiling', 'Jl. Sukarame', '08.006', 500000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(76, 'YUDI S', 'Dinas', 'Kemiling', 'Jl. Sukarame', '08.006', 200000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(77, 'SAHIDIN', 'Dinas', 'Kemiling', 'Jl. Sukarame', '08.006', 500000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(78, 'Mely Noviani', 'Hotel Horison', 'Sukabumi', 'Gedung Wani', '08.004', 500000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(79, 'SAHIDIN', 'RM Pinang', 'Labuhan Ratu', 'Karang Anyar', '08.002', 500000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(80, 'SAHIDIN', 'PT REKSO NASIONAL FOOD', 'Sukarame', 'Jl. T. Umar', '08.001', 500000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(81, 'YUDI S', 'Hotel Horison', 'Sukabumi', 'Gedung Wani', '08.004', 1000000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(82, 'SAHIDIN', 'Dinas', 'Kemiling', 'Jl. Sukarame', '08.006', 500000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(83, 'SAHIDIN', 'Sekolah TEST', 'Sukabumi', 'Jl. Antasari', '08.007', 80000000, 'Sudah Bayar', 'SKRD', '2023-10-04'),
(84, 'Mely Noviani', 'Hotel Horison', 'Sukabumi', 'J. T. Umar', '08.003', 80000000, 'Sudah Bayar', 'Lunas', '2023-10-04'),
(85, 'YUDI S', 'RM Pinang', 'Labuhan Ratu', 'Karang Anyar', '08.002', 60000, 'Sudah Bayar', 'Cicil', '2023-10-04'),
(86, 'SAHIDIN', 'Hotel Horison', 'Sukabumi', 'Gedung Wani', '08.004', 200000, 'Sudah Bayar', 'Cicil', '2023-10-04'),
(87, 'Mely Noviani', 'PT REKSO NASIONAL FOOD', 'Sukarame', 'Jl. T. Umar', '08.001', 1000000, 'Sudah Bayar', 'Lunas', '2023-10-03'),
(88, 'Tenyom', 'Angga Tenyom', 'Kemiling', 'Karang Anyar', '08.005', 60000, 'Sudah Bayar', 'Cicil', '2023-10-04'),
(89, 'Tenyom', 'Dinas', 'Kemiling', 'Jl. Sukarame', '08.006', 60000, 'Sudah Bayar', 'Cicil', '2023-10-05'),
(90, 'Mely Noviani', 'Dinas', 'Kemiling', 'Jl. Sukarame', '08.006', 1000000, 'Sudah Bayar', 'Lunas', '2023-10-05'),
(91, 'ALFIAN ANGGA NUGROHO', 'RM Pinang', 'Labuhan Ratu', 'Karang Anyar', '08.002', 500000, 'Sudah Bayar', 'Lunas', '2023-10-06'),
(93, 'Mely Noviani', 'Hotel Horison', 'Sukabumi', 'J. T. Umar', '08.003', 200000, 'Sudah Bayar', 'Lunas', '2023-10-06'),
(95, 'YUDI S', 'Dinas', 'Kemiling', 'Jl. Sukarame', '08.006', 500000, 'Sudah Bayar', 'Cicil', '2023-10-06'),
(96, 'YUDI S', 'Hotel Horison', 'Sukabumi', 'Gedung Wani', '08.004', 5000000, 'Sudah Bayar', 'Lunas', '2023-10-06'),
(104, 'YUDI S', 'RM Pinang', 'Labuhan Ratu', 'Karang Anyar', '08.002', 500000, 'Sudah Bayar', 'Cicil', '2023-10-06'),
(105, 'ALFIAN ANGGA NUGROHO', 'RM Pinang', 'Labuhan Ratu', 'Karang Anyar', '08.002', 1000000, 'Sudah Bayar', '', '2023-10-07'),
(106, 'Mely Noviani', 'Hotel Horison', 'Sukabumi', 'J. T. Umar', '08.003', 200000, 'Sudah Bayar', 'Lunas', '2023-10-07'),
(107, 'YUDI S', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 5000000, 'Sudah Bayar', 'tidak ada', '2023-10-10'),
(108, 'SAHIDIN', 'Hotel Horison', 'Sukabumi', 'Gedung Wani', '08.004', 200000, 'Sudah Bayar', '', '2023-10-10'),
(109, 'YUDI S', 'PT REKSO NASIONAL FOOD', 'Sukarame', 'Jl. T. Umar', '08.001', 90000, 'Sudah Bayar', 'tidak ada', '2023-10-10'),
(111, 'SAHIDIN', 'Hotel Horison', 'Sukabumi', 'J. T. Umar', '01.001', 40000, 'Sudah Bayar', '', '2023-10-12'),
(121, 'YUDI S', 'Smk BLK Bandar Lampung', 'Sukarame', 'Jl. Sukarame', '04.001', 2000, 'Sudah Bayar', '', '2023-10-13'),
(122, 'SAHIDIN', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01.004', 9000, 'Sudah Bayar', '', '2023-10-13'),
(123, 'SAHIDIN', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01.004', 9000, 'Sudah Bayar', '', '2023-10-13'),
(124, 'SAHIDIN', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01.004', 90000, 'Sudah Bayar', '', '2023-10-13'),
(125, 'YUDI S', 'RM Pinang', 'Labuhan Ratu', 'Jl. T. Umar', '02.002', 80000, 'Sudah Bayar', '', '2023-10-13'),
(126, 'SAHIDIN', 'RM Pinang', 'Labuhan Ratu', 'Jl. T. Umar', '02.002', 9900, 'Sudah Bayar', '', '2023-10-13'),
(127, 'YUDI S', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 90000, 'Sudah Bayar', '', '2023-10-13'),
(128, 'SAHIDIN', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01.004', 120000, 'Sudah Bayar', '', '2023-10-13'),
(129, 'Mely Noviani', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 25000, 'Sudah Bayar', '', '2023-10-13'),
(130, 'ALFIAN ANGGA NUGROHO', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 35000, 'Sudah Bayar', '', '2023-10-13'),
(131, 'Mely Noviani', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01.004', 75000, 'Sudah Bayar', '', '2023-10-13'),
(132, 'Mely Noviani', 'Smk BLK Bandar Lampung', 'Sukarame', 'Jl. Sukarame', '04.001', 10000, 'Sudah Bayar', '', '2023-10-13'),
(133, 'SAHIDIN', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 12000, 'Sudah Bayar', '', '2023-10-13'),
(134, 'YUDI S', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 20000, 'Sudah Bayar', '', '2023-10-13'),
(135, 'SAHIDIN', 'Smk BLK Bandar Lampung', 'Sukarame', 'Jl. Sukarame', '04.001', 30000, 'Sudah Bayar', '', '2023-10-13'),
(136, 'Mely Noviani', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 2500000, 'Sudah Bayar', 'Lunas', '2023-10-14'),
(137, 'ALFIAN ANGGA NUGROHO', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 230000, 'Sudah Bayar', '', '2023-10-14'),
(138, 'TENYOM', 'Angga Tenyom', 'Kemiling', 'Karang Anyar', '01.005', 50000, 'Sudah Bayar', '', '2023-10-13'),
(139, 'SAHIDIN', 'Hotel Horison', 'Sukabumi', 'Jl. T. Umar', '01.003', 200000, 'Sudah Bayar', '', '2023-10-13'),
(140, 'SAHIDIN', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 200000, 'Sudah Bayar', '', '2023-10-13'),
(141, 'SAHIDIN', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 200000, 'Sudah Bayar', '', '2023-10-13'),
(142, 'SAHIDIN', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 200000, 'Sudah Bayar', '', '2023-10-13'),
(143, 'SAHIDIN', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 200000, 'Sudah Bayar', '', '2023-10-13'),
(144, 'TENYOM', 'Angga Tenyom', 'Kemiling', 'Karang Anyar', '01.005', 1000000, 'Sudah Bayar', '', '2023-10-13'),
(145, 'ALFIAN ANGGA NUGROHO', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 500000, 'Sudah Bayar', '', '2023-10-13'),
(146, 'Mely Noviani', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01.004', 5000000, 'Sudah Bayar', '', '2023-10-13'),
(147, 'YUDI S', 'RM Pinang', 'Sukarame', 'J. T. Sukarame 2', '02.001', 200000, 'Sudah Bayar', '', '2023-10-13'),
(148, 'YUDI S', 'RM Pinang', 'Sukarame', 'J. T. Sukarame 2', '02.001', 200000, 'Sudah Bayar', '', '2023-10-13'),
(149, 'YUDI S', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01.004', 200000, 'Sudah Bayar', '', '2023-10-13'),
(150, 'YUDI S', 'RM Pinang', 'Labuhan Ratu', 'Jl. T. Umar', '02.002', 9000, 'Sudah Bayar', '', '2023-10-13'),
(151, 'Mely Noviani', 'RM Pinang', 'Sukarame', 'J. T. Sukarame 2', '02.001', 200000, 'Sudah Bayar', '', '2023-10-12'),
(152, 'Mely Noviani', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01.004', 500000, 'Sudah Bayar', '', '2023-10-13'),
(153, 'Mely Noviani', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 80000000, 'Sudah Bayar', '', '2023-10-13'),
(154, 'Mely Noviani', 'Angga Tenyom', 'Kemiling', 'Karang Anyar', '01.005', 1000000, 'Sudah Bayar', '', '2023-10-13'),
(155, 'YUDI S', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 5000000, 'Sudah Bayar', '', '2023-10-13'),
(156, 'ALFIAN ANGGA NUGROHO', 'Smk BLK Bandar Lampung', 'Sukarame', 'Jl. Sukarame', '04.001', 1000000, 'Sudah Bayar', '', '2023-10-13'),
(157, 'Mely Noviani', 'RM Pinang', 'Labuhan Ratu', 'Jl. T. Umar', '02.002', 500000, 'Sudah Bayar', '', '2023-10-13'),
(158, 'YUDI S', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 500000, 'Sudah Bayar', '', '2023-10-13'),
(159, 'YUDI S', 'Smk BLK Bandar Lampung', 'Sukarame', 'Jl. Sukarame', '04.001', 200000, 'Sudah Bayar', '', '2023-10-13'),
(160, 'ALFIAN ANGGA NUGROHO', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 80000000, 'Sudah Bayar', 'Lunas', '2023-10-13'),
(161, 'Mely Noviani', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 5000000, 'Sudah Bayar', 'Lunas', '2023-10-13'),
(162, 'ALFIAN ANGGA NUGROHO', 'RM Pinang', 'Sukarame', 'J. T. Sukarame 2', '02.001', 5000000, 'Sudah Bayar', '', '2023-10-13'),
(163, 'Mely Noviani', 'Angga Tenyom', 'Kemiling', 'Karang Anyar', '01.005', 1000000, 'Sudah Bayar', '', '2023-10-12'),
(164, 'Mely Noviani', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 1000000, 'Sudah Bayar', 'Lunas', '2023-10-13'),
(165, 'SAHIDIN', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 500000, 'Sudah Bayar', 'SKRD', '2023-10-13'),
(166, 'ALFIAN ANGGA NUGROHO', 'Smk BLK Bandar Lampung', 'Sukarame', 'Jl. Sukarame', '04.001', 1250000, 'Sudah Bayar', 'tidak ada', '2023-10-12'),
(167, 'SAHIDIN', 'RM Pinang', 'Sukarame', 'J. T. Sukarame 2', '02.001', 250000, 'Sudah Bayar', 'Lunas', '2023-10-15'),
(168, 'YUDI S', 'Hotel Horison', 'Sukabumi', 'Jl. T. Umar', '01.003', 75000, 'Sudah Bayar', '', '2023-10-15'),
(169, 'YUDI S', 'RM Pinang', 'Labuhan Ratu', 'Jl. T. Umar', '02.002', 1000000, 'Sudah Bayar', '', '2023-10-15'),
(170, 'YUDI S', 'MALL  BOEMI KEDATON', 'Labuhan Ratu', 'Jl. T. Umar', '01.004', 500000, 'Sudah Bayar', '', '2023-10-15'),
(171, 'ALFIAN ANGGA NUGROHO', 'Hotel Horison', 'Sukabumi', 'Jl. T. Umar', '01.003', 160000000, 'Sudah Bayar', '', '2023-08-02'),
(172, 'SAHIDIN', 'Adven', 'Sukarame', 'Jl. Sukarame', '03.001', 5000000, 'Sudah Bayar', '', '2023-09-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_retribusi_b_byr`
--

CREATE TABLE `tb_retribusi_b_byr` (
  `id_retribusi` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `nama_objek` varchar(100) NOT NULL,
  `nama_wilayah` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `npwrd` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_retribusi_b_byr`
--

INSERT INTO `tb_retribusi_b_byr` (`id_retribusi`, `nama_petugas`, `nama_objek`, `nama_wilayah`, `alamat`, `npwrd`, `status`, `tanggal`) VALUES
(54, 'Mely Noviani', 'Hotel Oyoo', 'Sukabumi', 'Jl. Antasari', '01.002', 'Belum Bayar', '2023-10-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `us_level` varchar(20) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `us_level`, `last_login`) VALUES
(3, 'Mely Noviani', '$2y$10$gkaGjPEUaaU0QsP4Cfh8jeF66zQDqY3uBq2OwJHBOsH4qbWJoKN6u', 'Petugas', '2023-10-14 20:56:26'),
(4, 'Admin', '$2y$10$NLq7w3fXItA/EfgFY5Yor.Xa3dBzmala7ZLwX9tFTbR7BlTZTORnO', 'Admin', '2023-10-17 02:21:48'),
(26, 'Alfian Angga', '$2y$10$BzKCIHJqlZXIR5AI0FrFneqvWSiwdbBA0P39eeeU1h957oEMo66Ta', 'Petugas', '2023-10-16 08:02:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wilayah`
--

CREATE TABLE `tb_wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `nama_wilayah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_wilayah`
--

INSERT INTO `tb_wilayah` (`id_wilayah`, `nama_wilayah`) VALUES
(1, 'Labuhan Ratu'),
(2, 'Sukabumi'),
(3, 'Kemiling'),
(5, 'Sukarame'),
(25, 'Gedong Air'),
(26, 'Natar');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_npwrd`
--
ALTER TABLE `tb_npwrd`
  ADD PRIMARY KEY (`id_npwrd`);

--
-- Indeks untuk tabel `tb_objek`
--
ALTER TABLE `tb_objek`
  ADD PRIMARY KEY (`id_objek`);

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `tb_potensi`
--
ALTER TABLE `tb_potensi`
  ADD PRIMARY KEY (`id_potensi`);

--
-- Indeks untuk tabel `tb_retribusi`
--
ALTER TABLE `tb_retribusi`
  ADD PRIMARY KEY (`id_retribusi`);

--
-- Indeks untuk tabel `tb_retribusi_b_byr`
--
ALTER TABLE `tb_retribusi_b_byr`
  ADD PRIMARY KEY (`id_retribusi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_wilayah`
--
ALTER TABLE `tb_wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_npwrd`
--
ALTER TABLE `tb_npwrd`
  MODIFY `id_npwrd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tb_objek`
--
ALTER TABLE `tb_objek`
  MODIFY `id_objek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_potensi`
--
ALTER TABLE `tb_potensi`
  MODIFY `id_potensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_retribusi`
--
ALTER TABLE `tb_retribusi`
  MODIFY `id_retribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT untuk tabel `tb_retribusi_b_byr`
--
ALTER TABLE `tb_retribusi_b_byr`
  MODIFY `id_retribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_wilayah`
--
ALTER TABLE `tb_wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
