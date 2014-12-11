-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2014 at 03:54 PM
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
(301, 'SHF Kamen Rider Zangetsu Melon Energy', 601, 1000000, 20, 'image/SHF Kamen Rider Zangetsu Melon Energy.jpg', ''),
(302, 'SIC Kamen Rider OOO Tatoba', 602, 900000, 2, 'image/SIC Kamen Rider OOO Tatoba.jpg', ''),
(303, 'SCM Aquarius Camus', 603, 1200000, 5, 'image/SCM Aquarius Camus.jpg', ''),
(304, 'NENDOROID Miku Racing', 604, 780000, 7, 'image/NENDOROID Miku Racing.jpg', ''),
(305, 'SHF Kamen Rider Wizard Flame Style', 601, 500000, 1, 'image/SHF Kamen Rider Wizard Flame Style.jpg', ''),
(306, 'SHF Kamen Rider Gaim Orange Arms', 601, 650000, 2, 'image/SHF Kamen Rider Gaim Orange Arms.jpg', ''),
(307, 'SHF Kamen Rider Baron Banana Arms', 601, 350000, 10, 'image/SHF Kamen Rider Baron Banana Arms.jpg', ''),
(308, 'SIC Kamen Rider Wizard Flame Style', 602, 900000, 8, 'image/SIC Kamen Rider Wizard Flame Style.jpg', ''),
(309, 'SHF Kamen Rider Black Renewal', 601, 700000, 7, 'image/SHF Kamen Rider Black Renewal.jpg', ''),
(310, 'SIC Kamen Rider OOO Sagozo', 602, 950000, 8, 'image/SIC Kamen Rider OOO Sagozo.jpg', ''),
(311, 'SIC Kamen Rider Kabuto', 602, 990000, 8, 'image/SIC Kamen Rider Kabuto.jpg', ''),
(312, 'SIC Kamen Rider Ryuki', 602, 880000, 1, 'image/SIC Kamen Rider Ryuki.jpg', ''),
(313, 'SCM Pegasus Kouga', 603, 900000, 8, 'image/SCM Pegasus Kouga.jpg', ''),
(314, 'SCM Pegasus Seiya', 603, 1000000, 10, 'image/SCM Pegasus Seiya.jpg', ''),
(315, 'SCM Gemini Saga', 603, 1200000, 8, 'image/SCM Gemini Saga.jpg', ''),
(316, 'NENDOROID Sinon', 604, 450000, 8, 'image/NENDOROID Sinon.jpg', ''),
(317, 'NENDOROID Azusa', 604, 400000, 4, 'image/NENDOROID Azusa.jpg', ''),
(318, 'NENDOROID Elsa', 604, 500000, 3, 'image/NENDOROID Elsa.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `h_transaksi`
--

CREATE TABLE IF NOT EXISTS `h_transaksi` (
  `h_kode` int(11) NOT NULL,
  `id_trans` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `h_transaksi`
--

INSERT INTO `h_transaksi` (`h_kode`, `id_trans`, `id_barang`, `jumlah`) VALUES
(501, 401, 318, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id_jenis` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `gambar` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis`, `nama`, `gambar`) VALUES
(601, 'SHF', 'button/shf.jpg'),
(602, 'SIC', 'button/sic.jpg'),
(603, 'SCM', 'button/scm.jpg'),
(604, 'Nendoroid', 'button/nendoroid.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `krisan`
--

INSERT INTO `krisan` (`id_krisan`, `email`, `isi`, `tanggal`) VALUES
(1, 'asdasd', 'asd', '0000-00-00'),
(2, 'asd', 'asd', '2014-12-08');

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
(801, '2014-12-11', 'Berita pertama saya'),
(802, '2014-12-11', 'Yeahhhh');

-- --------------------------------------------------------

--
-- Table structure for table `reg_user`
--

CREATE TABLE IF NOT EXISTS `reg_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `enc_pass` varchar(60) NOT NULL,
  `alamat` char(201) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telepon` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg_user`
--

INSERT INTO `reg_user` (`id`, `nama`, `enc_pass`, `alamat`, `email`, `telepon`) VALUES
(1, 'andrew', '$2y$10$JaxJaxJaxJaxJaxJax222uqc0EPI/bXp5ez8u2blQ8IPvXITffTdC', 'qwer', 'qwer', 'qwer');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`) VALUES
(901, 'Home'),
(902, 'Products'),
(903, 'About Us'),
(904, 'Contact Us');

-- --------------------------------------------------------

--
-- Table structure for table `text_window`
--

CREATE TABLE IF NOT EXISTS `text_window` (
  `id` int(11) NOT NULL,
  `judul` varchar(60) NOT NULL,
  `isi` varchar(500) NOT NULL,
  `subject` int(11) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `text_window`
--

INSERT INTO `text_window` (`id`, `judul`, `isi`, `subject`, `visible`) VALUES
(2, 'Hubungi Kami!', 'Silahkan berikan kritik dan saran Anda melalui contact form dibawah.', 904, 1),
(3, 'Halo Pengunjung!', 'Kliktoys.com adalah portal milik perusahaan Kliktoys Inc. yang menawarkan produk hobby dengan harga yang terjangkau. Salah satu prinsip kami adalah "Hobby is for Everyone", yang berarti bahwa siapa saja berhak untuk memiliki dan menjalani hobby mereka.\r\nSemoga kalian menikmati kunjungan ke website kami ini!', 903, 1);

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
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode`, `subtotal`, `user`) VALUES
(401, 1500000, 1);

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
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `text_window`
--
ALTER TABLE `text_window`
 ADD PRIMARY KEY (`id`), ADD KEY `subject` (`subject`);

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
MODIFY `id_krisan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
-- Constraints for table `text_window`
--
ALTER TABLE `text_window`
ADD CONSTRAINT `text_window_ibfk_1` FOREIGN KEY (`subject`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user`) REFERENCES `reg_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
