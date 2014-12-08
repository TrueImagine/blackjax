-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2014 at 08:26 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `klik_toys`
--
CREATE DATABASE IF NOT EXISTS `klik_toys` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `klik_toys`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `enc_pass` varchar(60) NOT NULL,
  `kode_kewenangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `enc_pass`, `kode_kewenangan`) VALUES
(1, 'andrewnugraha', '$2y$10$JaxJaxJaxJaxJaxJax222u6fzErL7LdK3tISWH709lVCnjFFqN88y', 201),
(2, 'trueimagine', '$2y$10$JaxJaxJaxJaxJaxJax222uZfj7fzIPSuEqw4y4NpLlOOO670GRY0S', 201),
(203, 'nobita', '$2y$10$JaxJaxJaxJaxJaxJax222uPYq9uoXavjoMwQSg1UjAjblJuzADAle', 202);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `sml_logo` varchar(60) NOT NULL,
  `big_logo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `id_jenis`, `harga`, `stok`, `sml_logo`, `big_logo`) VALUES
(301, 'SHF Zangetsu Melon Energy', 601, 1000000, 20, '', ''),
(302, 'SIC Kamen Rider OOO Tatoba', 602, 900000, 2, '', ''),
(303, 'SCM Aquarius Camus', 603, 1200000, 5, '', ''),
(304, 'NENDOROID Miku Racing', 604, 780000, 7, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `h_transaksi`
--

CREATE TABLE IF NOT EXISTS `h_transaksi` (
  `h_kode` int(11) NOT NULL,
  `id_trans` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id_jenis` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis`, `nama`) VALUES
(601, 'SHF'),
(602, 'SIC'),
(603, 'SCM'),
(604, 'Nendoroid');

-- --------------------------------------------------------

--
-- Table structure for table `kewenangan`
--

CREATE TABLE IF NOT EXISTS `kewenangan` (
  `kode` int(11) NOT NULL,
  `kewenangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kewenangan`
--

INSERT INTO `kewenangan` (`kode`, `kewenangan`) VALUES
(201, 'moderator'),
(202, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `krisan`
--

CREATE TABLE IF NOT EXISTS `krisan` (
`id_krisan` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `isi` char(201) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` char(201) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_news`, `tanggal`, `isi`) VALUES
(801, '2014-12-06', 'Tertanggal hari ini, web kliktoys resmi dibuka');

-- --------------------------------------------------------

--
-- Table structure for table `reg_user`
--

CREATE TABLE IF NOT EXISTS `reg_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `enc_pass` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `kode` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`), ADD KEY `kode_kewenangan` (`kode_kewenangan`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id_barang`), ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `h_transaksi`
--
ALTER TABLE `h_transaksi`
 ADD PRIMARY KEY (`h_kode`), ADD KEY `id_trans` (`id_trans`), ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
 ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kewenangan`
--
ALTER TABLE `kewenangan`
 ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `krisan`
--
ALTER TABLE `krisan`
 ADD PRIMARY KEY (`id_krisan`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `reg_user`
--
ALTER TABLE `reg_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`kode`), ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `krisan`
--
ALTER TABLE `krisan`
MODIFY `id_krisan` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`kode_kewenangan`) REFERENCES `kewenangan` (`kode`);

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_barang` (`id_jenis`);

--
-- Constraints for table `h_transaksi`
--
ALTER TABLE `h_transaksi`
ADD CONSTRAINT `h_transaksi_ibfk_1` FOREIGN KEY (`id_trans`) REFERENCES `transaksi` (`kode`),
ADD CONSTRAINT `h_transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user`) REFERENCES `reg_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
