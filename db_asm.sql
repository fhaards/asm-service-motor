-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Agu 2022 pada 15.08
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_asm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_montir`
--

CREATE TABLE `data_montir` (
  `montir_id` char(20) NOT NULL,
  `montir_nm` varchar(100) NOT NULL,
  `montir_tgl_lahir` date NOT NULL,
  `montir_jk` varchar(10) NOT NULL,
  `montir_alamat` text NOT NULL,
  `montir_tlp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_montir`
--

INSERT INTO `data_montir` (`montir_id`, `montir_nm`, `montir_tgl_lahir`, `montir_jk`, `montir_alamat`, `montir_tlp`) VALUES
('MRT-23423', 'Suwarsono', '1990-07-13', 'Laki Laki', 'Bukit Dago A-9 32', '081317352815'),
('MRT47269', 'Valentino', '1996-07-06', 'Laki Laki', 'Rawakalong', '081317352815');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_motor`
--

CREATE TABLE `data_motor` (
  `motor_id` char(20) NOT NULL,
  `motor_nm` varchar(100) NOT NULL,
  `motor_merek` varchar(20) NOT NULL,
  `motor_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_motor`
--

INSERT INTO `data_motor` (`motor_id`, `motor_nm`, `motor_merek`, `motor_harga`) VALUES
('HONSCOUCR', 'Scoopy 125', 'Honda', 0),
('HONTESKEQ', 'TEST5', 'Honda', 0),
('HONTESQLU', 'TEST', 'Honda', 0),
('HONTESZSG', 'TEST3', 'Honda', 0),
('HONVARUWX', 'Vario 145 C', 'Honda', 0),
('SUZSPIVEP', 'Spin', 'Suzuki', 0),
('YAMNMAOGB', 'NMAX 150', 'Yamaha', 0),
('YAMXMAYMG', 'XMax ', 'Yamaha', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `trans_id` char(36) NOT NULL,
  `cust_nm` varchar(100) DEFAULT NULL,
  `cust_tlp` varchar(20) DEFAULT NULL,
  `trans_tgl` date NOT NULL,
  `total_harga` int(20) NOT NULL,
  `uang_bayar` int(20) DEFAULT NULL,
  `uang_kembali` int(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_service`
--

CREATE TABLE `data_service` (
  `service_id` char(20) NOT NULL,
  `service_nm` varchar(50) NOT NULL,
  `service_hrg` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_service`
--

INSERT INTO `data_service` (`service_id`, `service_nm`, `service_hrg`) VALUES
('SRV3UMPQ', 'Ganti Oli Plus', 70000),
('SRV92OWP', 'Super PGM FI', 60000),
('SRVFAUZX', 'Super Matik', 85000),
('SRVLENBB', 'Servis Lengkap', 50000),
('SRVW53HH', 'Body Repair', 45000),
('SRVYJEJ8', 'Servis Ringan', 35000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_spart_category`
--

CREATE TABLE `data_spart_category` (
  `sparepart_cat_id` int(10) NOT NULL,
  `sparepart_cat_code` char(3) NOT NULL,
  `sparepart_cat_nm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_spart_category`
--

INSERT INTO `data_spart_category` (`sparepart_cat_id`, `sparepart_cat_code`, `sparepart_cat_nm`) VALUES
(2, 'DVB', 'Drive Chain Kit'),
(3, 'SPB', 'Spark Plug-Busi'),
(4, 'TL2', 'Tire - Ban Luar'),
(5, 'GS9', 'Gasket'),
(19, 'BN4', 'Body Repair Kit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_spart_product`
--

CREATE TABLE `data_spart_product` (
  `sparepart_prod_id` char(20) NOT NULL,
  `sparepart_prod_nm` varchar(50) NOT NULL,
  `category` int(10) NOT NULL,
  `sparepart_prod_hrg` int(20) NOT NULL,
  `sparepart_prod_desc` text DEFAULT NULL,
  `sparepart_prod_stock` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_spart_product`
--

INSERT INTO `data_spart_product` (`sparepart_prod_id`, `sparepart_prod_nm`, `category`, `sparepart_prod_hrg`, `sparepart_prod_desc`, `sparepart_prod_stock`, `created_at`, `updated_at`) VALUES
('DVB3Q618', 'Honda (AHM) Drive Chain Kit H0640GBG910', 2, 379000, 'Good Look', 0, '2022-08-02 12:36:41', NULL),
('DVB8Q873', 'Suzuki Drive Chain Kit S06', 2, 25000, 'Good Look', 30, '2022-08-02 12:37:53', '2022-08-02 13:07:57'),
('SPB6T983', 'WURTH Hose Clamp 539812', 3, 23000, 'Good Look', 30, '2022-08-02 12:37:00', '2022-08-02 15:05:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_trans`
--

CREATE TABLE `data_trans` (
  `trans_id` char(36) NOT NULL,
  `trans_tipe` int(1) NOT NULL,
  `cust_nm` varchar(100) DEFAULT NULL,
  `cust_tlp` varchar(20) NOT NULL,
  `cust_motor` char(20) DEFAULT NULL,
  `trans_tgl` date NOT NULL,
  `montir` char(20) DEFAULT NULL,
  `total_harga` int(20) NOT NULL,
  `uang_bayar` int(20) DEFAULT NULL,
  `uang_kembali` int(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_trans_service`
--

CREATE TABLE `data_trans_service` (
  `trans_service_id` int(10) NOT NULL,
  `id_trans` char(36) NOT NULL,
  `service_nm` varchar(50) NOT NULL,
  `service_hrg` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_trans_spart`
--

CREATE TABLE `data_trans_spart` (
  `id_trans_spart` int(10) NOT NULL,
  `id_trans` char(36) NOT NULL,
  `sparepart_id` char(20) NOT NULL,
  `sparepart_nm` varchar(50) NOT NULL,
  `sparepart_hrg` int(20) NOT NULL,
  `sparepart_qty` int(10) NOT NULL,
  `sparepart_total_hrg` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(20) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `username`, `password`, `level`, `telp`, `alamat`) VALUES
(2, 'Superadmin', 'super@asm.com', 'superadmin', '$2y$10$L71BI4GEOEK9/QFmQDA6lun4uPQPoLI/TpvlOn5CamnGUzozCAwHW', 'superadmin', NULL, NULL),
(3, 'Mawar Puspita', 'fron1@asm.com', 'frondesk_1', '$2y$10$wgDnmV6nbJXHAxXY6lBhQeJBm3LH8AU0rznscjHh0eGlqTrrDegIG', 'frontdesk', '+628 12345698', 'Desa Rawakalong no. 44 RT/RW 04/05, Gn. Sindur, Bogor'),
(6, 'Muklis Sukron', 'part1@asm.com', 'partman_1', '$2y$10$Nd5eFphvOrRA1JAoSBXDeeeKgmzHIPeJxCElUZchcCPho9xis7bVO', 'partman', '+628 123456789', 'Cibarengkok RT/RW 02/12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_montir`
--
ALTER TABLE `data_montir`
  ADD PRIMARY KEY (`montir_id`);

--
-- Indeks untuk tabel `data_motor`
--
ALTER TABLE `data_motor`
  ADD PRIMARY KEY (`motor_id`);

--
-- Indeks untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indeks untuk tabel `data_service`
--
ALTER TABLE `data_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indeks untuk tabel `data_spart_category`
--
ALTER TABLE `data_spart_category`
  ADD PRIMARY KEY (`sparepart_cat_id`);

--
-- Indeks untuk tabel `data_spart_product`
--
ALTER TABLE `data_spart_product`
  ADD PRIMARY KEY (`sparepart_prod_id`),
  ADD KEY `category` (`category`);

--
-- Indeks untuk tabel `data_trans`
--
ALTER TABLE `data_trans`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indeks untuk tabel `data_trans_service`
--
ALTER TABLE `data_trans_service`
  ADD PRIMARY KEY (`trans_service_id`);

--
-- Indeks untuk tabel `data_trans_spart`
--
ALTER TABLE `data_trans_spart`
  ADD PRIMARY KEY (`id_trans_spart`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_spart_category`
--
ALTER TABLE `data_spart_category`
  MODIFY `sparepart_cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `data_trans_service`
--
ALTER TABLE `data_trans_service`
  MODIFY `trans_service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `data_trans_spart`
--
ALTER TABLE `data_trans_spart`
  MODIFY `id_trans_spart` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
