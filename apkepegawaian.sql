-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2018 at 11:31 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apkepegawaian`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `yourname` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `yourname`) VALUES
(1, 'admin', 'admin', 'suke');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE IF NOT EXISTS `departemen` (
  `kode` int(15) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`kode`, `departemen`) VALUES
(101, 'Pendidikan'),
(1001, 'Multimedia'),
(10001, 'Keuangan'),
(100001, 'Produksi'),
(1000001, 'Logistik');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `addres` varchar(100) NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `name`, `dateofbirth`, `gender`, `departemen`, `email`, `addres`, `photo`) VALUES
(1011, 'Nandang suhendar', '1998-01-06', 'Laki-laki', 'Pendidikan', 'nandangsuhendar@gmail.com', 'Kp. Bebedahan Rt/Rw 03/01 Wanamekar Wanaraja Garut', '1.jpg'),
(1012, 'Anita Kusdinar', '1983-02-02', 'Perempuan', 'Pendidikan', 'anita_anit@gmail.com', 'Perum Cempaka Asri Rt/Rw 005/007 Blok B-201 Suka Galih Karang Pawitan Garut', '4.jpg'),
(1013, 'Yusril Abdurahman', '1985-07-04', 'Laki-laki', 'Pendidikan', 'abdurahmanYusril@gmail.com', 'Kp. Babakan Rt/Rw 09/01 Wanasari Sukaweng Garut', '2.jpg'),
(1014, 'Komarudin Harahap', '1979-06-12', 'Laki-laki', 'Pendidikan', 'komarudin_h@gmail.com', 'Kp. Baru Rt/Rw 004/005 Batu Jaya Cikuray Garut', '3.jpg'),
(10011, 'Edi Mulyadi', '1981-11-18', 'Laki-laki', 'Multimedia', 'Mulyadi_edi@gmail.com', 'Perumahan Sari Indah Rt/Rw 008/009 Blok c-009 Sari Indah Banten', '5.jpg'),
(10012, 'Yayan Ruhiyan', '1994-06-15', 'Laki-laki', 'Multimedia', 'yanz_ruh@gmail.com', 'Kp. Mekar Sari Rt/Rw 06/04 Babakan Tipar Kamojang Garut', '18.jpg'),
(10013, 'Wahyu Nugraha', '1984-05-10', 'Laki-laki', 'Multimedia', 'Wahyunugraha@gmail.com', 'Kp. Babakan Hantap Rt/Rw 04/14 Babakan Surabaya Kiara Condong Bandung', '7.jpg'),
(10014, 'Entin Kartini', '1989-11-15', 'Perempuan', 'Multimedia', 'KartiniEn@gmail.com', 'Kp. Tipar Rt/Rw 01/03 Wanasari Garut', '13.jpg'),
(100011, 'Ujang Suparman', '1983-12-05', 'Laki-laki', 'Keuangan', 'u_suparman@gmail.com', 'Kp. Ciloa Rt/Rw 03/14 Sindang Ratu Wanaraja Garut', '8.jpg'),
(100012, 'Siti Komala', '1989-04-12', 'Perempuan', 'Keuangan', 'Sitkom@gmail.com', 'Perumahan Mekarsar Indah Rt/Rw 08/16 Mekarsari Bekasi', '14.jpg'),
(100013, 'Fajar Sidiq', '1986-02-05', 'Laki-laki', 'Keuangan', 'Fajar@gmail.com', 'Kp. Limbangan Rt/Rw 8/4 Tarogong Garut', '11.jpg'),
(100014, 'Dedi Kusnandar', '1984-03-07', 'Laki-laki', 'Keuangan', 'dekus@gmail.com', 'Kp. Linggar Rt/Rw 06/03 Bandrek Garut', '9.jpg'),
(1000011, 'Yamin Zapar', '1988-09-13', 'Laki-laki', 'Produksi', 'zaparyamin@gmail.com', 'Perumahan Cempaka Indah Rt/Rw 07/08 Blok R-23 Godog Karang pawitan Garut', '12.jpg'),
(1000012, 'Abdul Jannah', '1984-03-14', 'Laki-laki', 'Produksi', 'addjannah@gmail.com', 'Kp. Haur Rt/Rw 05/007 Cihaur Pameungpeuk Garut', '15.jpg'),
(1000013, 'Roni Bahrudin', '1982-06-09', 'Laki-laki', 'Produksi', 'Bahrudinroni@gmail.com', 'Kp. Riung Rt/Rw 09/04 Pakan Sari bogor', '16.jpg'),
(1000014, 'Raray Rata', '1984-07-18', 'Laki-laki', 'Produksi', 'rrrata@gmail.com', 'Kp. Nyuksruk Rt/Rw 007/009 Gawir Garut', '19.jpg'),
(10000011, 'Herman Hermanto', '1988-07-13', 'Laki-laki', 'Logistik', 'herman_her@gmail.com', 'Kp. Sari Babat Rt/Rw 12/13 Majalaya Kabupaten Bandung', '20.jpg'),
(10000012, 'Kamaludin Alexander', '1974-12-18', 'Laki-laki', 'Logistik', 'alexanderkamal@gmail.com', 'Perumahan Haji Agus Rt/Rw 18/17 Blok y-45 Cikarang Bekasi', '17.jpg'),
(10000013, 'Ahmad Jamaludin', '1989-06-14', 'Laki-laki', 'Logistik', 'ajam@gmail.com', 'Kp. Ancol Rt/Rw 11/07 Karang tengah Garut', '21.jpg'),
(10000014, 'Roy Saputra', '1986-06-11', 'Laki-laki', 'Logistik', 'saputraroy@gmail.com', 'Kp. Bebedahan Rt/Rw 03/01 Wanamekar Wanaraja Garut', '10.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
