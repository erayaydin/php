-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2017 at 09:50 PM
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
-- Database: `cartoon`
--

-- --------------------------------------------------------

--
-- Table structure for table `cizerler`
--

CREATE TABLE `cizerler` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cizerler`
--

INSERT INTO `cizerler` (`id`, `name`) VALUES
(1, 'Erdil Yaşaroğlu'),
(2, 'Galip Tekin'),
(3, 'Selçuk Erdem');

-- --------------------------------------------------------

--
-- Table structure for table `karikaturler`
--

CREATE TABLE `karikaturler` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `cizer_id` int(11) NOT NULL,
  `baslik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `begenme` bigint(20) NOT NULL DEFAULT '0',
  `goruntulenme` bigint(20) NOT NULL DEFAULT '0',
  `durum` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karikaturler`
--

INSERT INTO `karikaturler` (`id`, `kullanici_id`, `cizer_id`, `baslik`, `begenme`, `goruntulenme`, `durum`) VALUES
(3, 3, 1, 'Git La Bu Mahalleden', 0, 0, 1),
(4, 3, 1, 'Millet Aç Aç!', 0, 0, 1),
(5, 3, 1, 'Tişikkirlir Sipirmin', 1, 0, 0),
(6, 3, 3, 'Boynuz', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sifre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullaniciadi`, `sifre`, `admin`) VALUES
(1, 'kullanici', '4297f44b13955235245b2497399d7a93', 0),
(3, 'azra', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kullanici_begenme`
--

CREATE TABLE `kullanici_begenme` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `karikatur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kullanici_begenme`
--

INSERT INTO `kullanici_begenme` (`id`, `kullanici_id`, `karikatur_id`) VALUES
(18, 3, 7),
(21, 3, 5),
(25, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `mesajlar`
--

CREATE TABLE `mesajlar` (
  `id` int(11) NOT NULL,
  `adsoyad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eposta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mesaj` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mesajlar`
--

INSERT INTO `mesajlar` (`id`, `adsoyad`, `eposta`, `telefon`, `mesaj`) VALUES
(2, 'Ad Soyad', 'deneme@eposta.com', '123123123', 'Merhaba, Karikatür sitesi gerçekten güzel olmuş; sitenize reklam vermek istiyorum. Konu ile ilgili lütfen e-posta adresime dönüş yapın.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cizerler`
--
ALTER TABLE `cizerler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karikaturler`
--
ALTER TABLE `karikaturler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kullanici_begenme`
--
ALTER TABLE `kullanici_begenme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cizerler`
--
ALTER TABLE `cizerler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `karikaturler`
--
ALTER TABLE `karikaturler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kullanici_begenme`
--
ALTER TABLE `kullanici_begenme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
