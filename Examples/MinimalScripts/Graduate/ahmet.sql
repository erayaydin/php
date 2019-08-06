-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2017 at 03:48 AM
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
-- Database: `ahmet`
--

-- --------------------------------------------------------

--
-- Table structure for table `bolumler`
--

CREATE TABLE `bolumler` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bolumler`
--

INSERT INTO `bolumler` (`id`, `isim`) VALUES
(1, 'Bilgisayar Mühendisliği'),
(3, 'Tıp'),
(4, 'Elektrik-Elektronik Mühendisliği'),
(5, 'Makina Mühendisliği');

-- --------------------------------------------------------

--
-- Table structure for table `konular`
--

CREATE TABLE `konular` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `baslik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mesaj` longtext COLLATE utf8mb4_unicode_ci,
  `durum` tinyint(1) NOT NULL DEFAULT '0',
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `meslek_id` int(11) NOT NULL,
  `yer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konular`
--

INSERT INTO `konular` (`id`, `kullanici_id`, `baslik`, `mesaj`, `durum`, `tarih`, `meslek_id`, `yer_id`) VALUES
(4, 3, 'İş Yeri Eğitimi Stajını Burada Yapabilirsiniz', 'İş yeri eğitim stajınız için çalıştığım firmayı önerebilirim.\r\n\r\nÇok yeni teknolojileri öğreniyor ve uyguluyoruz.', 1, '2017-05-31 23:08:49', 1, 1),
(5, 4, 'Staj Arıyorum', 'İş yeri stajı yapmak için bir yer arıyorum, bildiğiniz veya çalıştığınız bir yer varsa orada yapabilirim. Web ve Android üzerine kendimi geliştireceğim.', 1, '2017-05-31 23:10:37', 4, 1),
(6, 4, 'Merhaba', 'öasdsadsad', 1, '2017-06-08 12:16:13', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sifre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eposta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1',
  `adsoyad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `okul_id` int(11) NOT NULL,
  `bolum_id` int(11) NOT NULL,
  `meslek_id` int(11) NOT NULL,
  `yer_id` int(11) NOT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullaniciadi`, `sifre`, `eposta`, `durum`, `adsoyad`, `avatar`, `okul_id`, `bolum_id`, `meslek_id`, `yer_id`, `telefon`, `yil`, `admin`) VALUES
(3, 'ahmet', '4297f44b13955235245b2497399d7a93', 'ahmet@ahmet.com', 1, 'Ahmetcan Doğar', 'upload/kullanici/ahmet.png', 1, 1, 1, 1, '05061066863', '2019', 1),
(4, 'AliFii', '4297f44b13955235245b2497399d7a93', 'alifi@alifi.com', 1, 'Ali Fidancı', 'upload/kullanici/AliFii.png', 1, 1, 4, 1, '0501234567890', '2019', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mesajlar`
--

CREATE TABLE `mesajlar` (
  `id` int(11) NOT NULL,
  `gonderen_id` int(11) NOT NULL,
  `alan_id` int(11) NOT NULL,
  `mesaj` text COLLATE utf8mb4_unicode_ci,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mesajlar`
--

INSERT INTO `mesajlar` (`id`, `gonderen_id`, `alan_id`, `mesaj`, `tarih`) VALUES
(5, 4, 3, 'Merhaba Ahmet,\r\n\r\nİş yeri stajı ile ilgili iş yeri iletişim bilgilerini alabilir miyim?\r\n\r\nTeşekkürler.', '2017-05-31 23:11:02'),
(8, 4, 3, 'Haber bekliyorum', '2017-05-31 23:13:23'),
(10, 3, 4, 'Merhaba Ali,\r\n\r\nİş yeri bilgilerini e-posta ile size ilettim.\r\n\r\nTeşekkürler.', '2017-05-31 23:16:41'),
(11, 4, 3, 'Merhaba Ahmet,\r\n\r\nİş yerine ulaştım, staj başvurumu kabul ettiler.\r\n\r\nÇok teşekkür ederim.', '2017-05-31 23:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `meslekler`
--

CREATE TABLE `meslekler` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meslekler`
--

INSERT INTO `meslekler` (`id`, `isim`) VALUES
(1, 'Web Geliştirici'),
(3, 'Elektronik Mühendisi'),
(4, 'Stajyer');

-- --------------------------------------------------------

--
-- Table structure for table `okullar`
--

CREATE TABLE `okullar` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `okullar`
--

INSERT INTO `okullar` (`id`, `isim`) VALUES
(1, 'Selçuk Üniversitesi'),
(3, 'Necmettin Erbakan Üniversitesi'),
(4, 'Karatay Üniversitesi');

-- --------------------------------------------------------

--
-- Table structure for table `yerler`
--

CREATE TABLE `yerler` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yerler`
--

INSERT INTO `yerler` (`id`, `isim`) VALUES
(1, 'Konya'),
(2, 'İstanbul'),
(4, 'Antalya'),
(5, 'Ankara');

-- --------------------------------------------------------

--
-- Table structure for table `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `konu_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `mesaj` text COLLATE utf8mb4_unicode_ci,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `konu_id`, `kullanici_id`, `mesaj`, `tarih`) VALUES
(1, 2, 2, 'Deneme Yorum', '2017-05-31 13:27:08'),
(2, 2, 2, 'Bir deneme yorum\r\nburada\r\nyer alıyor', '2017-05-31 14:11:07'),
(3, 2, 2, 'Bir deneme yorum\r\nburada\r\nyer alıyor', '2017-05-31 14:11:20'),
(5, 4, 4, 'Özel mesaj gönderdim, lütfen inceleyin.', '2017-05-31 23:19:09'),
(7, 5, 3, 'Açtığım konuyu incelemeni tavsiye ederim', '2017-05-31 23:22:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bolumler`
--
ALTER TABLE `bolumler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konular`
--
ALTER TABLE `konular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meslekler`
--
ALTER TABLE `meslekler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `okullar`
--
ALTER TABLE `okullar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yerler`
--
ALTER TABLE `yerler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bolumler`
--
ALTER TABLE `bolumler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `konular`
--
ALTER TABLE `konular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `meslekler`
--
ALTER TABLE `meslekler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `okullar`
--
ALTER TABLE `okullar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `yerler`
--
ALTER TABLE `yerler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
