-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2020 at 10:09 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simproker`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dana_cair`
--

CREATE TABLE `tb_dana_cair` (
  `id_dana_cair` int(11) NOT NULL,
  `id_proker` int(11) NOT NULL,
  `dana_cair` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `no_kwitansi` varchar(50) NOT NULL,
  `nota_dinas` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dana_cair`
--

INSERT INTO `tb_dana_cair` (`id_dana_cair`, `id_proker`, `dana_cair`, `tanggal`, `no_kwitansi`, `nota_dinas`, `keterangan`) VALUES
(1, 286, '25000000', '2019-10-22', '116519', 'K/15/X/2019/YKS', 'Pembayaran di Gabung'),
(3, 286, '15000000', '2019-10-20', '123456', '123456', 'Lunas'),
(4, 289, '30000000', '2019-10-20', '1234567', '1234567', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosendalam`
--

CREATE TABLE `tb_dosendalam` (
  `id_dosendalam` int(11) NOT NULL,
  `nama_dosendalam` varchar(30) NOT NULL,
  `honor_dosendalam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dosendalam`
--

INSERT INTO `tb_dosendalam` (`id_dosendalam`, `nama_dosendalam`, `honor_dosendalam`) VALUES
(2, 'Elshidqi, S.Kom', 45000),
(3, 'Ayu Ting Ting', 45000),
(4, 'Deny Cagur', 45000),
(5, 'Sultan Batu Kerikil', 45000),
(6, 'Dadang Panci', 45000),
(7, 'Asep Ketombe', 45000),
(8, 'Kirun Kelabu', 45000),
(9, 'Kucay Marela', 45000),
(10, 'Nanang Kemana', 45000),
(11, 'Sakti Mandra Guna', 45000),
(12, 'Syerli Kusuma', 45000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosenluar`
--

CREATE TABLE `tb_dosenluar` (
  `id_dosenluar` int(11) NOT NULL,
  `nama_dosenluar` varchar(30) NOT NULL,
  `honor_dosenluar` int(11) NOT NULL,
  `transport` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dosenluar`
--

INSERT INTO `tb_dosenluar` (`id_dosenluar`, `nama_dosenluar`, `honor_dosenluar`, `transport`) VALUES
(1, 'Indra Brugman', 75000, 55000),
(2, 'Iis Dahlia', 65000, 55000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_honor_dosendalam`
--

CREATE TABLE `tb_honor_dosendalam` (
  `id_honor_dosendalam` int(11) NOT NULL,
  `id_mk` int(11) NOT NULL,
  `id_dosendalam` int(11) NOT NULL,
  `pertemuan` int(11) NOT NULL,
  `jam` varchar(11) NOT NULL,
  `bulanpertama` varchar(25) NOT NULL,
  `bulankedua` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_honor_dosendalam`
--

INSERT INTO `tb_honor_dosendalam` (`id_honor_dosendalam`, `id_mk`, `id_dosendalam`, `pertemuan`, `jam`, `bulanpertama`, `bulankedua`) VALUES
(1, 6, 1, 5, '11.2', 'October 2019', 'November 2019'),
(2, 1, 2, 4, '10', 'October 2019', 'November 2019'),
(3, 8, 4, 6, '12', 'October 2019', 'November 2019'),
(4, 9, 5, 5, '15', 'October 2019', 'November 2019'),
(5, 10, 5, 3, '7', 'October 2019', 'November 2019'),
(6, 3, 11, 5, '13', 'October 2019', 'November 2019'),
(7, 4, 9, 6, '9.7', 'October 2019', 'November 2019'),
(8, 5, 7, 3, '4.6', 'October 2019', 'November 2019'),
(9, 10, 5, 5, '8.2', 'October 2019', 'November 2019');

-- --------------------------------------------------------

--
-- Table structure for table `tb_honor_dosenluar`
--

CREATE TABLE `tb_honor_dosenluar` (
  `id_honor_dosenluar` int(11) NOT NULL,
  `id_mk` int(11) NOT NULL,
  `id_dosenluar` int(11) NOT NULL,
  `pertemuan` int(11) NOT NULL,
  `jam` varchar(15) NOT NULL,
  `bulanpertama` varchar(25) NOT NULL,
  `bulankedua` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_honor_dosenluar`
--

INSERT INTO `tb_honor_dosenluar` (`id_honor_dosenluar`, `id_mk`, `id_dosenluar`, `pertemuan`, `jam`, `bulanpertama`, `bulankedua`) VALUES
(1, 6, 1, 5, '11.2', 'October 2019', 'November 2019'),
(2, 1, 2, 4, '10.2', 'October 2019', 'November 2019'),
(3, 8, 2, 3, '3.7', 'October 2019', 'November 2019'),
(4, 5, 1, 3, '6.2', 'October 2019', 'November 2019'),
(5, 2, 2, 8, '15.3', 'October 2019', 'November 2019');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'TINGKAT 1'),
(2, 'TINGKAT 2'),
(4, 'TINGKAT 3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_koord`
--

CREATE TABLE `tb_koord` (
  `id_koord` int(11) NOT NULL,
  `id_mk` int(11) NOT NULL,
  `id_dosendalam` int(11) NOT NULL,
  `bulanpertama` varchar(25) NOT NULL,
  `bulankedua` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_koord`
--

INSERT INTO `tb_koord` (`id_koord`, `id_mk`, `id_dosendalam`, `bulanpertama`, `bulankedua`) VALUES
(1, 1, 2, 'October 2019', 'November 2019'),
(2, 5, 3, 'October 2019', 'November 2019'),
(3, 8, 4, 'October 2019', 'November 2019'),
(4, 9, 5, 'October 2019', 'November 2019'),
(5, 10, 6, 'October 2019', 'November 2019'),
(6, 11, 7, 'October 2019', 'November 2019'),
(7, 3, 8, 'October 2019', 'November 2019'),
(8, 2, 9, 'October 2019', 'November 2019'),
(9, 4, 10, 'October 2019', 'November 2019'),
(10, 6, 11, 'October 2019', 'November 2019');

-- --------------------------------------------------------

--
-- Table structure for table `tb_matakuliah`
--

CREATE TABLE `tb_matakuliah` (
  `id_mk` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_mk` varchar(50) NOT NULL,
  `sks` int(3) NOT NULL,
  `honor_mk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_matakuliah`
--

INSERT INTO `tb_matakuliah` (`id_mk`, `id_kelas`, `nama_mk`, `sks`, `honor_mk`) VALUES
(1, 1, 'Agama', 2, 10000),
(2, 1, 'Bahasa Indonesia', 2, 10000),
(3, 4, 'Praktik Klinik Semester 1', 3, 10000),
(4, 4, 'Praktik Klinik Semester 2', 3, 10000),
(5, 4, 'Praktik Klinik Semester 3', 7, 10000),
(6, 4, 'Praktik Klinik Semester 4', 5, 10000),
(7, 4, 'Praktik Klinik Semester 5', 3, 10000),
(8, 2, 'PPKN', 2, 10000),
(9, 2, 'IPA', 4, 10000),
(10, 2, 'IPS', 4, 10000),
(11, 2, 'Matematika', 4, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_proker`
--

CREATE TABLE `tb_proker` (
  `id_proker` int(11) NOT NULL,
  `id_ta` int(11) NOT NULL,
  `nama_proker` varchar(50) NOT NULL,
  `dana_proker` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_proker`
--

INSERT INTO `tb_proker` (`id_proker`, `id_ta`, `nama_proker`, `dana_proker`) VALUES
(285, 1, 'Kemahasiswaan', '30000000'),
(286, 1, 'Kemahasiswaan2', '40000000'),
(287, 1, 'Kemahasiswaan3', '50000000'),
(288, 1, 'Kemahasiswaan4', '60000000'),
(289, 1, 'Praktik Klinik Semester III', '35000000'),
(291, 1, 'Praktik Klinik Semester 1', '45000000'),
(292, 1, 'Praktik Klinik Semester 2', '45000000'),
(293, 1, 'Praktik Klinik Semester 3', '45000000'),
(294, 1, 'Praktik Klinik Semester 4', '45000000'),
(295, 1, 'Praktik Klinik Semester 5', '45000000'),
(296, 3, 'Kemahasiswaan', '30000000'),
(297, 3, 'Kemahasiswaan2', '40000000'),
(298, 3, 'Kemahasiswaan3', '50000000'),
(299, 3, 'Kemahasiswaan4', '60000000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_proposal`
--

CREATE TABLE `tb_proposal` (
  `id_proposal` int(11) NOT NULL,
  `id_proker` int(11) NOT NULL,
  `no_surat_proposal` varchar(25) NOT NULL,
  `tanggal_proposal` date NOT NULL,
  `perihal` text NOT NULL,
  `dana_proposal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_proposal`
--

INSERT INTO `tb_proposal` (`id_proposal`, `id_proker`, `no_surat_proposal`, `tanggal_proposal`, `perihal`, `dana_proposal`) VALUES
(1, 296, 'B/123/X/2019/AKBID', '2019-10-01', 'pengadaan barang habis pakai\r\n', '30000000'),
(2, 289, 'B/567/X/2019/AKBID', '2019-10-08', 'perihal 2', '45000000'),
(3, 288, 'B/345/X/2019/AKBID', '2019-10-08', 'perihal 3', '10000000'),
(4, 287, 'B/222/X/2019/AKBID', '2019-10-13', 'perihal 4', '35000000'),
(5, 286, 'B/555/X/2019/AKBID', '2019-10-19', 'perihal 5', '15000000'),
(9, 286, 'B/556/X/2019/AKBID', '2019-10-20', 'Permohonan Dana Lomba Lari', '7000000'),
(11, 286, 'B/559/X/2019/AKBID', '2019-10-20', 'Permohonan Dana Agustusan 2019', '12000000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ta`
--

CREATE TABLE `tb_ta` (
  `id_ta` int(11) NOT NULL,
  `tahun_ajaran` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ta`
--

INSERT INTO `tb_ta` (`id_ta`, `tahun_ajaran`) VALUES
(1, '2019/2020'),
(3, '2021/2022');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `email`, `password`) VALUES
(1, 'admin', 'miatun80@yahoo.co.id', '$2y$10$QdK2e1FsyfcFB.dHfZbkTurDx0lAPG0tbQbfOZPHM3NWkPkNmOdje');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dana_cair`
--
ALTER TABLE `tb_dana_cair`
  ADD PRIMARY KEY (`id_dana_cair`);

--
-- Indexes for table `tb_dosendalam`
--
ALTER TABLE `tb_dosendalam`
  ADD PRIMARY KEY (`id_dosendalam`);

--
-- Indexes for table `tb_dosenluar`
--
ALTER TABLE `tb_dosenluar`
  ADD PRIMARY KEY (`id_dosenluar`);

--
-- Indexes for table `tb_honor_dosendalam`
--
ALTER TABLE `tb_honor_dosendalam`
  ADD PRIMARY KEY (`id_honor_dosendalam`),
  ADD KEY `id_mk` (`id_mk`),
  ADD KEY `id_dosendalam` (`id_dosendalam`);

--
-- Indexes for table `tb_honor_dosenluar`
--
ALTER TABLE `tb_honor_dosenluar`
  ADD PRIMARY KEY (`id_honor_dosenluar`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_koord`
--
ALTER TABLE `tb_koord`
  ADD PRIMARY KEY (`id_koord`),
  ADD KEY `id_dosendalam` (`id_dosendalam`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `tb_matakuliah`
--
ALTER TABLE `tb_matakuliah`
  ADD PRIMARY KEY (`id_mk`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_proker`
--
ALTER TABLE `tb_proker`
  ADD PRIMARY KEY (`id_proker`);

--
-- Indexes for table `tb_proposal`
--
ALTER TABLE `tb_proposal`
  ADD PRIMARY KEY (`id_proposal`),
  ADD KEY `id_proker_2` (`id_proker`),
  ADD KEY `id_proker` (`id_proker`) USING BTREE;

--
-- Indexes for table `tb_ta`
--
ALTER TABLE `tb_ta`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dana_cair`
--
ALTER TABLE `tb_dana_cair`
  MODIFY `id_dana_cair` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_dosendalam`
--
ALTER TABLE `tb_dosendalam`
  MODIFY `id_dosendalam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_dosenluar`
--
ALTER TABLE `tb_dosenluar`
  MODIFY `id_dosenluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_honor_dosendalam`
--
ALTER TABLE `tb_honor_dosendalam`
  MODIFY `id_honor_dosendalam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_honor_dosenluar`
--
ALTER TABLE `tb_honor_dosenluar`
  MODIFY `id_honor_dosenluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_koord`
--
ALTER TABLE `tb_koord`
  MODIFY `id_koord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_matakuliah`
--
ALTER TABLE `tb_matakuliah`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_proker`
--
ALTER TABLE `tb_proker`
  MODIFY `id_proker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `tb_proposal`
--
ALTER TABLE `tb_proposal`
  MODIFY `id_proposal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_ta`
--
ALTER TABLE `tb_ta`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_proposal`
--
ALTER TABLE `tb_proposal`
  ADD CONSTRAINT `tb_proposal_ibfk_1` FOREIGN KEY (`id_proker`) REFERENCES `tb_proker` (`id_proker`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
