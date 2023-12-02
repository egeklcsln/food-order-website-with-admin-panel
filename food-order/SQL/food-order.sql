-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 02 Ara 2023, 01:40:44
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `food-order`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(12, 'Ege', 'ege', '81dc9bdb52d04dc20036dbd8313ed055'),
(13, 'sdafasdf', '1234', '81dc9bdb52d04dc20036dbd8313ed055'),
(14, 'egeeee', 'egeee', '81dc9bdb52d04dc20036dbd8313ed055'),
(15, 'eafsefsda', 'sdfasdf', 'c956a7cb279a87e87a28c5314cf1e0dc'),
(16, 'egekılıc', '1234', ' 827ccb0eea8a706c4c34a16891f84e7b'),
(18, 'Ege Kılıçaslan Şalk', 'egeeee', ' 81dc9bdb52d04dc20036dbd8313ed055'),
(23, 'ege', 'ege', ' fcea920f7412b5da7be0cf42b8c93759'),
(24, 'ege kılıçaslan', 'egeee', ' 202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(11, 'Pizzaaa', 'Food_category4820.jpg', 'Yes', 'Yes'),
(15, 'Burger', 'Food_category3372.jpg', 'Yes', 'Yes'),
(16, 'Momo', 'Food_category741.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(8, 'food123456', 'ssdfsdaasdfasdfasdsdffdsafds', 10.00, 'Food-Name3137.jpg', 11, 'Yes', 'Yes'),
(9, 'food2', 'kjhghfdsjkjhgffgjhhgfdsdfghjhg', 20.00, 'Food-Name1064.jpg', 15, 'Yes', 'Yes'),
(10, 'fdsfdasfasd', 'gnfdhfgdhsfgd', 70.00, 'Food-Name5669.jpg', 11, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(2, 'food2', 20.00, 12, 20.00, '2023-12-01 12:24:21', 'On Delivery', '', '124142341', '200401021@comu.edu.tr', 'Edirne/ Keşan / Aşağı Zaferiye Mahallesi / Taflan Sokak / Çukurçeşme Karşısı / Doğakent Apartmanı / C Blok / Kat 1 / Daire 17\r\nÇukurçeşme Karşısı / Doğakent Apartmanı / C Blok / Kat 1 / Daire 17'),
(3, 'burgerrrrrr', 80.00, 1, 80.00, '2023-12-01 12:24:57', 'Ordered', '', '123213213', 'ege.klcsln1254@gmail.com', 'çanakkale Merkez , Barbaros Mah. Atatürk cad. Barbaros tksi yanı apt no2 daire 8'),
(4, 'food2', 20.00, 1, 20.00, '2023-12-01 10:28:07', 'Cancelled', '', '5435914681', '200401021@comu.edu.tr', 'fdsafasdfasd'),
(5, 'food2', 20.00, 6, 20.00, '2023-12-01 10:29:08', 'Delivered', 'fdsafasdfsda', '54543534534', 'efasdfdasge@gmail.com', 'fdsafasdfdsafasd'),
(6, 'food2', 20.00, 12, 240.00, '2023-12-02 12:41:13', 'Ordered', 'efeefee21', '5423423432', 'ege@gmail.com', 'sdafasdfasdfafsdfasdsd');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
