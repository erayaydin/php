-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2017 at 05:13 PM
-- Server version: 10.1.23-MariaDB
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serife`
--

-- --------------------------------------------------------

--
-- Table structure for table `bolumler`
--

CREATE TABLE `bolumler` (
  `id` int(11) NOT NULL,
  `adi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bolumler`
--

INSERT INTO `bolumler` (`id`, `adi`) VALUES
(1, 'Bilgisayar Mühendisliği');

-- --------------------------------------------------------

--
-- Table structure for table `fakulteler`
--

CREATE TABLE `fakulteler` (
  `id` int(11) NOT NULL,
  `adi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakulteler`
--

INSERT INTO `fakulteler` (`id`, `adi`) VALUES
(1, 'Teknoloji Fakültesi');

-- --------------------------------------------------------

--
-- Table structure for table `iller`
--

CREATE TABLE `iller` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iller`
--

INSERT INTO `iller` (`id`, `isim`) VALUES
(1, 'Konya'),
(2, 'Adıyaman'),
(3, 'Eskişehir'),
(4, 'Niğde');

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `numara` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `tur` varchar(255) NOT NULL DEFAULT 'ogrenci'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `numara`, `sifre`, `tur`) VALUES
(2, '143301018', 'a1f76fdbddccb25269ead58d91324788', 'ogretmen'),
(5, '143301018', '4297f44b13955235245b2497399d7a93', 'ogrenci'),
(6, '151224011', '4297f44b13955235245b2497399d7a93', 'ogrenci');

-- --------------------------------------------------------

--
-- Table structure for table `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `ad` varchar(255) DEFAULT NULL,
  `soyad` varchar(255) DEFAULT NULL,
  `tckimlik` varchar(255) DEFAULT NULL,
  `universite` varchar(255) DEFAULT NULL,
  `fakulte` varchar(255) DEFAULT NULL,
  `bolum` varchar(255) DEFAULT NULL,
  `telefon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ogrenciler`
--

INSERT INTO `ogrenciler` (`id`, `kullanici_id`, `ad`, `soyad`, `tckimlik`, `universite`, `fakulte`, `bolum`, `telefon`) VALUES
(5, 5, 'Ali', 'Fidancı', '11743448080', 'Selçuk Üniversitesi', 'Teknoloji Fakültesi', 'Bilgisayar Mühendisliği', '05438821699'),
(6, 6, 'Eray', 'Aydın', '11417694362', 'Selçuk Üniversitesi', 'Teknoloji Fakültesi', 'Bilgisayar Mühendisliği', '05070426699');

-- --------------------------------------------------------

--
-- Table structure for table `stajlar`
--

CREATE TABLE `stajlar` (
  `id` int(11) NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `tur` varchar(255) DEFAULT NULL,
  `gun` int(11) NOT NULL DEFAULT '30',
  `baslangic` date DEFAULT NULL,
  `bitis` date DEFAULT NULL,
  `kabul` int(11) NOT NULL DEFAULT '0',
  `durum` tinyint(4) NOT NULL DEFAULT '0',
  `il` varchar(255) DEFAULT NULL,
  `firma` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stajlar`
--

INSERT INTO `stajlar` (`id`, `ogrenci_id`, `tur`, `gun`, `baslangic`, `bitis`, `kabul`, `durum`, `il`, `firma`) VALUES
(3, 5, 'staj1', 20, '2017-06-24', '2017-07-24', 4, 0, 'Adıyaman', 'Adıyaman Bilişim'),
(4, 6, 'isyeri', 1, '2017-06-19', '2017-06-20', 1, 1, 'Eskişehir', 'Eski Eski Eski');

-- --------------------------------------------------------

--
-- Table structure for table `universiteler`
--

CREATE TABLE `universiteler` (
  `id` int(11) NOT NULL,
  `adi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `universiteler`
--

INSERT INTO `universiteler` (`id`, `adi`) VALUES
(1, 'Selçuk Üniversitesi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bolumler`
--
ALTER TABLE `bolumler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakulteler`
--
ALTER TABLE `fakulteler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iller`
--
ALTER TABLE `iller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stajlar`
--
ALTER TABLE `stajlar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universiteler`
--
ALTER TABLE `universiteler`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bolumler`
--
ALTER TABLE `bolumler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fakulteler`
--
ALTER TABLE `fakulteler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `iller`
--
ALTER TABLE `iller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `stajlar`
--
ALTER TABLE `stajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `universiteler`
--
ALTER TABLE `universiteler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
