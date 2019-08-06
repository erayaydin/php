-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2017 at 07:26 AM
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
-- Database: `baz`
--

-- --------------------------------------------------------

--
-- Table structure for table `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `siteadi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eposta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `siteadi`, `telefon`, `eposta`, `fax`, `facebook`, `twitter`, `google`, `pinterest`, `youtube`) VALUES
(1, 'Site Adı', '0 (332) 123 45 67', 'bilgi@siteadresi.com', '0 (332) 123 45 67', 'https://facebook.com', 'https://twitter.com', 'https://plus.google.com', 'https://pinterest.com', 'https://youtube.com');

-- --------------------------------------------------------

--
-- Table structure for table `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aciklama` text COLLATE utf8mb4_unicode_ci,
  `durum` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `baslik`, `aciklama`, `durum`) VALUES
(4, 'Bilgisayar', 'Bilgisayar aksesuar ve yedek parçaları. bilgisayar bileşenleri, modem ve ağ ürünleri.', 1),
(5, 'Telefon & Aksesuar', 'Cep telefonu aksesuarları, cep telefonları ve yedek parçaları', 1),
(6, 'Fotoğraf & Kamera', 'Fotoğraf makineleri, lensler', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullaniciadi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eposta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sifre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adsoyad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1',
  `adres` text COLLATE utf8mb4_unicode_ci,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yonetici` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullaniciadi`, `eposta`, `sifre`, `adsoyad`, `durum`, `adres`, `telefon`, `yonetici`) VALUES
(3, 'mehmet', 'mehmet.baz@selcuk.edu.tr', '5232523ab4dce3a8cb6191ead18068f3', 'Mehmet Baz', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sayfalar`
--

CREATE TABLE `sayfalar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icerik` longtext COLLATE utf8mb4_unicode_ci,
  `durum` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sayfalar`
--

INSERT INTO `sayfalar` (`id`, `baslik`, `icerik`, `durum`) VALUES
(1, 'Hakkımızda', 'Hakkımızda içeriği!', 1),
(4, 'Gizlilik Sözleşmesi', 'Gizlilik Sözleşmemiz hazırlanmaktadır.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slaytlar`
--

CREATE TABLE `slaytlar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slaytlar`
--

INSERT INTO `slaytlar` (`id`, `baslik`, `link`, `durum`) VALUES
(8, 'Slayt 1', '#slayt1', 1),
(9, 'Slayt 2', '#slayt2', 1),
(10, 'Slayt 3', '#slayt3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `siparisler`
--

CREATE TABLE `siparisler` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) DEFAULT NULL,
  `adsoyad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eposta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adres` text COLLATE utf8mb4_unicode_ci,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `durum` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siparisler`
--

INSERT INTO `siparisler` (`id`, `kullanici_id`, `adsoyad`, `eposta`, `telefon`, `adres`, `tarih`, `durum`) VALUES
(7, 3, 'Mehmet Baz', 'mehmet.baz@selcuk.edu.tr', '0512 345 67 89', 'Adres 1\r\nAdres 2', '2017-05-25 04:22:57', 2),
(8, 3, 'Mehmet Baz', 'mehmet.baz@selcuk.edu.tr', '0512 345 67 89', 'Adres 1\r\nAdres 2', '2017-05-25 04:24:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `siparis_urunler`
--

CREATE TABLE `siparis_urunler` (
  `id` int(11) NOT NULL,
  `siparis_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `adet` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siparis_urunler`
--

INSERT INTO `siparis_urunler` (`id`, `siparis_id`, `urun_id`, `adet`) VALUES
(4, 6, 1, 1),
(5, 7, 4, 2),
(6, 7, 5, 1),
(7, 7, 6, 1),
(8, 8, 5, 1),
(9, 8, 4, 1),
(10, 8, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aciklama` text COLLATE utf8mb4_unicode_ci,
  `icerik` longtext COLLATE utf8mb4_unicode_ci,
  `durum` tinyint(1) NOT NULL DEFAULT '1',
  `fiyat` double NOT NULL,
  `goruntulenme` bigint(20) NOT NULL DEFAULT '0',
  `kategori_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `urunler`
--

INSERT INTO `urunler` (`id`, `baslik`, `aciklama`, `icerik`, `durum`, `fiyat`, `goruntulenme`, `kategori_id`) VALUES
(3, 'Fujifilm İnstax Mini 8 + Film (20 Adet)', 'Fujifilm, Instax ile fotoğraf çekmeyi daha eğlenceli hale getiriyor.\r\nFujifilm Instax Mini 8 fotoğraf makineleri ile bulunduğunuz ortama heyecan katın! Aile veya arkadaş ortamlarında, özel ve eğlenceli anlarınızı anında fotoğraflayarak sevdiklerinizle paylaşabileceksiniz.', 'Fujifilm, Instax ile fotoğraf çekmeyi daha eğlenceli hale getiriyor.\r\nFujifilm Instax Mini 8 fotoğraf makineleri ile bulunduğunuz ortama heyecan katın! Aile veya arkadaş ortamlarında, özel ve eğlenceli anlarınızı anında fotoğraflayarak sevdiklerinizle paylaşabileceksiniz.\r\nInstax Mini 8 ile kredi kartı boyutunda, saniyeler içinde hazır olan fotoğraflarınızı anında hediye edebilirsiniz. Sabit flaşı sayesinde kapalı ortamda da renk yoğunluğu ayarlamanıza imkan veren Instax Mini 8, şık görünümünün yanında farklı renk seçenekleri de sunuyor. Beyaz, pembe, mavi, sarı, mor, ahududu ve siyah fotoğraf makineleri, özel tasarımları sayesinde fotoğraf çekiminde kolaylık sağlıyor.', 1, 249, 0, 6),
(4, 'Ahtapot Cep Telefonu', 'Fonksiyonel tasarımıyla her türlü zeminde fotoğraf çekmenize yardımcı olacak Ahtapot Tripod fotoğrafçılığa farklı bir bakış açısı getiriyor!', 'Esnek ayakları sayesinde makinenizi istediğiniz yere sabitleyebilirsiniz.\r\nAkrobat ayakları sayesinde istediğiniz şekle kolayca girerek dilediğiniz açıyı yakalayabilirsiniz.\r\nHer ayakta 10 adet kaydırmaz eklem bulunmaktadır.\r\nEklemlerinde yer alan özel kaydırmaz yapısı sayesinde her türlü ortamda pratik kullanım imkanı sunar.\r\nKatlanabilir olması özelliği ile istediğiniz yere giderken yanınızda kolayca götürebilirsiniz.\r\nTutucu başlık kendi ekseni çevresinde 360 derece dönebilir.\r\n90 derece yatay dönebilen başlığıyla dikey çekim yapılabilir.\r\nPlastik materyalden imal edilmiştir. mavi cadde \r\nStabil fotoğraf ve video çekimi yapabilmenizi sağlar.\r\nHer ortamda kullanım için tasarlanmıştır.\r\nHafif ve dayanıklı yapıya sahiptir. mavi cadde \r\nAçılır kapanır bacak yapısıyla yer kaplamaz.\r\nKüçük boyutlarıyla taşınması kolaydır.\r\nAyırma mandalıyla hızlıca vida başlığı ve gövde ayrılabilir.\r\nTaşıma Kapasitesi: 300 Gr mavi cadde \r\nCep telefonu, Kompakt ve hibrit fotoğraf makineleriyle kullanılabilir, SLR ve benzeri makineler için uygun değildir.\r\nEvrensel 1/4 inch başlığıyla tüm marka makinelere uyum sağlar.\r\nEni 5,5 cm - 8,5 cm arası genişlikteki tüm cep telefonlarına uyumludur.', 1, 12.5, 0, 5),
(5, 'SEAGATE 1TB 2.5\'\' Expansion STEA1000400', 'Yanınızda taşıyabileceğiniz basit eklenti depolaması', 'Seagate Expansion Taşınabilir sabit diski, bilgisayarınıza anında depolama alanı eklemeniz ve dosyalarınızı yanınızda götürmeniz gerektiğinde kullanımı kolay bir çözüm sunar.\r\n', 1, 224.99, 0, 4),
(6, 'Philips BT50 Ses Bombası', 'Hoparlör Sürücüsü 4 cm tam kapsamlı\r\nHassaslık 82 dB/m/W ±3 dB/m/W', 'Hoparlör Sürücüsü 4 cm tam kapsamlı\r\nHassaslık 82 dB/m/W ±3 dB/m/W\r\n\r\nBluetooth Aralığı 10 m (Boş alan)\r\nGüç Kaynağı (mikro USB soketi üzerinden)  5 V, 0,5 A\r\nDahili Li-polimer Pil 3,7 V, 365 mAh\r\n\r\nBoyutlar - Ana Ünite\r\n(G x Y x D)\r\n61 x 76 x 61 mm\r\nAğırlık - Ana Ünite 0,1 kg\r\nNominal Çıkış Gücü 2 W RMS\r\nFrekans Tepkisi 100 - 16000 Hz, ±3 dB\r\nSinyal Gürültü Oranı 70 dBA\r\nAudio-in Girişi 300 mV (tipik) –\r\n1600 mV (MAKS.) RMS', 1, 74.9, 0, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sayfalar`
--
ALTER TABLE `sayfalar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slaytlar`
--
ALTER TABLE `slaytlar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siparis_urunler`
--
ALTER TABLE `siparis_urunler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sayfalar`
--
ALTER TABLE `sayfalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `slaytlar`
--
ALTER TABLE `slaytlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `siparis_urunler`
--
ALTER TABLE `siparis_urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
