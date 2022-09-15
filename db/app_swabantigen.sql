-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2022 at 07:14 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_swabantigen`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `Id_Berita` int(11) NOT NULL,
  `Judul_Berita` varchar(99) NOT NULL,
  `Gambar_Berita` varchar(99) NOT NULL,
  `Deskripsi_Berita` text NOT NULL,
  `Tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`Id_Berita`, `Judul_Berita`, `Gambar_Berita`, `Deskripsi_Berita`, `Tanggal`) VALUES
(1, 'Kenaikan Covid 19 di Indonesia', 'cases1.png', 'Situasi pandemi virus corona di Indonesia mengalami eskalasi hampir satu bulan terakhir. Angka kasus harian Covid-19 yang sebelumnya berhasil ditekan menjadi 200 kasus per hari kini melonjak melewati 1.000, bahkan tembus 2.000 kasus. Situasi ini menjadi kekhawatiran banyak pihak, termasuk Presiden Joko Widodo. Jokowi memprediksi, lonjakan kasus Covid-19 akan mencapai puncaknya pada bulan Juli ini. ', '2022-08-27'),
(2, 'Gelombang Subvarian BA.4 dan BA.5', 'cases2.png', 'Epidemiolog dari Griffith University Australia Dicky Budiman memprediksi, gelombang Covid-19 subvarian BA.4 dan BA.5 akan berlangsung sedikit lebih lama dibandingkan gelombang virus corona sebelum-sebelumnya. Namun demikian, gelombang ini diperkirakan tidak lebih parah dari varian Delta yang berlangsung di 2021.', '2022-07-18'),
(4, 'PPKM di Jakarta Naik ke Level 2', 'cases3.png', 'Pemerintah pusat mengungkapkan alasan penerapan pemberlakuan pembatasan kegiatan masyarakat (PPKM) di DKI Jakarta dinaikkan ke level 2 dari sebelumnya level 1. Direktur Jenderal Bina Administrasi Wilayah (Kemendagri) Syafrizal mengatakan, hal itu disebabkan adanya kenaikan kasus Covid-19 yang cukup signifikan', '2022-07-18');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_pemeriksaan`
--

CREATE TABLE `hasil_pemeriksaan` (
  `Id_Pemeriksaan` int(11) NOT NULL,
  `Id_Pasien` int(11) NOT NULL,
  `Nama_Lengkap` varchar(99) NOT NULL,
  `No_Lab` int(6) NOT NULL,
  `Status` enum('SK','BK') NOT NULL,
  `Hasil_Tes` varchar(10) DEFAULT NULL,
  `Tgl_Pemeriksaan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_pemeriksaan`
--

INSERT INTO `hasil_pemeriksaan` (`Id_Pemeriksaan`, `Id_Pasien`, `Nama_Lengkap`, `No_Lab`, `Status`, `Hasil_Tes`, `Tgl_Pemeriksaan`) VALUES
(1, 2, 'Citra Aulia', 13233, 'BK', 'Positif', '2022-08-04'),
(2, 2, 'Citra Aulia ', 123, 'SK', 'Negatif', '2022-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `Id_Pasien` int(11) NOT NULL,
  `Nama_Pasien` varchar(99) NOT NULL,
  `NIK` char(16) NOT NULL,
  `Tgl_Lahir` date NOT NULL,
  `Umur` varchar(8) NOT NULL,
  `Alamat` varchar(99) NOT NULL,
  `No_Hp` char(13) NOT NULL,
  `Email_Pasien` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`Id_Pasien`, `Nama_Pasien`, `NIK`, `Tgl_Lahir`, `Umur`, `Alamat`, `No_Hp`, `Email_Pasien`) VALUES
(1, 'Rika Amalia', '3275037859012007', '2000-04-16', '22 Tahun', 'Jl Melati No 9 Bekasi', '087890563245', 'rika@gmail.com'),
(2, 'Citra Aulia', '3274383590167537', '1992-02-09', '30 Tahun', 'Jl Mawar No 67 Bekasi ', '0123848', 'citra@gmail.com'),
(3, 'Nabila Ayu', '3276583601892591', '2002-08-15', '19 Tahun', 'Jl Anggur No 89 Bekasi', '081278502645', 'nabila@gmail.com'),
(4, 'Siska Amalia', '3767812997000287', '2001-10-24', '20 Tahun', 'Jl Semangka No 12 Bekasi', '089745009871', 'siska@gmail.com'),
(5, 'Achmad Julio', '3278912760092781', '1999-06-24', '22 Tahun', 'Jl Melon No 45 Bekasi', '082375009127', 'achmad@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id_user` int(11) NOT NULL,
  `nama_user` varchar(99) NOT NULL,
  `email` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_user`, `nama_user`, `email`, `password`, `level`) VALUES
(1, 'devi', 'admin@gmail.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'admin'),
(4, 'Citra Aulia', 'citra@gmail.com', '06189734b31164cd8830d91068a40b7186dd05f4', 'user'),
(6, 'Rendy', 'rendy@gmail.com', '0b478297f9962aef193a6a0140f925436119e439', 'user'),
(7, 'Rika Amalia', 'rika@gmail.com', '645110ba4fcb867bfdfc4053dc0a28cc732e16db', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`Id_Berita`);

--
-- Indexes for table `hasil_pemeriksaan`
--
ALTER TABLE `hasil_pemeriksaan`
  ADD PRIMARY KEY (`Id_Pemeriksaan`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`Id_Pasien`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `Id_Berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hasil_pemeriksaan`
--
ALTER TABLE `hasil_pemeriksaan`
  MODIFY `Id_Pemeriksaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `Id_Pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
