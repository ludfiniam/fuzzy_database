-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2021 at 04:41 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzy_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_account`
--

CREATE TABLE `t_account` (
  `id` int(11) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `hak_akses` int(1) NOT NULL,
  `address` text NOT NULL,
  `active_account` varchar(20) NOT NULL,
  `image_profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_account`
--

INSERT INTO `t_account` (`id`, `full_name`, `email`, `username`, `password`, `telp`, `hak_akses`, `address`, `active_account`, `image_profile`) VALUES
(1, 'Smartphoneku', 'ludfiniam@gmail.com', 'ludfiniam', 'admin123', '08985222402', 1, 'Langon RT 09 RW 04, Tahunan, Jepara, Jawa Tengah, Indonesia', 'active', ''),
(2, 'Sindikat Center Phone', 'user1@gmail.com', 'user1', 'user1', '089922110909', 2, '', 'active', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_bahan_body`
--

CREATE TABLE `t_jenis_bahan_body` (
  `id` int(11) NOT NULL,
  `nama_bahan_body` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis_bahan_body`
--

INSERT INTO `t_jenis_bahan_body` (`id`, `nama_bahan_body`) VALUES
(1, 'Metal'),
(2, 'Carbon'),
(3, 'Plastic'),
(4, 'Alumunium'),
(5, 'Glass');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_chipset`
--

CREATE TABLE `t_jenis_chipset` (
  `id` int(11) NOT NULL,
  `nama_chipset` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis_chipset`
--

INSERT INTO `t_jenis_chipset` (`id`, `nama_chipset`) VALUES
(1, 'Snapdragon'),
(2, 'Mediatex'),
(3, 'Exynos'),
(4, 'Intel');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_gpu`
--

CREATE TABLE `t_jenis_gpu` (
  `id` int(11) NOT NULL,
  `nama_gpu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis_gpu`
--

INSERT INTO `t_jenis_gpu` (`id`, `nama_gpu`) VALUES
(1, 'Power VR'),
(2, 'Tegra'),
(3, 'Adreno'),
(4, 'Mali'),
(5, 'Videocore Broadcom');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_layar`
--

CREATE TABLE `t_jenis_layar` (
  `id` int(11) NOT NULL,
  `nama_jenis_layar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis_layar`
--

INSERT INTO `t_jenis_layar` (`id`, `nama_jenis_layar`) VALUES
(1, 'AMOLED'),
(2, 'IPS'),
(3, 'TFT'),
(4, 'OLED'),
(5, 'Capasitive Touch'),
(6, 'Super AMOLED');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_merek`
--

CREATE TABLE `t_jenis_merek` (
  `id` int(11) NOT NULL,
  `nama_merek` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis_merek`
--

INSERT INTO `t_jenis_merek` (`id`, `nama_merek`) VALUES
(1, 'SAMSUNG'),
(2, 'XIAOMI'),
(3, 'OPPO'),
(4, 'Realme'),
(5, 'ASUS'),
(6, 'VIVO');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_protect_layar`
--

CREATE TABLE `t_jenis_protect_layar` (
  `id` int(11) NOT NULL,
  `nama_protect_layar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis_protect_layar`
--

INSERT INTO `t_jenis_protect_layar` (`id`, `nama_protect_layar`) VALUES
(1, 'Tempered Glass'),
(2, 'Gorilla Glass'),
(3, 'Anti Spy'),
(4, 'Concore Glass'),
(5, 'Anti Glare'),
(6, 'Oleophobic coating');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_ui_os`
--

CREATE TABLE `t_jenis_ui_os` (
  `id` int(11) NOT NULL,
  `nama_ui_os` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis_ui_os`
--

INSERT INTO `t_jenis_ui_os` (`id`, `nama_ui_os`) VALUES
(1, 'Android'),
(2, 'MIUI'),
(3, 'One UI'),
(4, 'Zen UI'),
(5, 'EMUI'),
(6, 'Fun Touch OS'),
(7, 'Oxygen OS'),
(8, 'Color OS'),
(9, 'ROG UI');

-- --------------------------------------------------------

--
-- Table structure for table `t_jenis_usb`
--

CREATE TABLE `t_jenis_usb` (
  `id` int(11) NOT NULL,
  `nama_usb` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis_usb`
--

INSERT INTO `t_jenis_usb` (`id`, `nama_usb`) VALUES
(1, 'USB Type-C'),
(2, 'Micro USB');

-- --------------------------------------------------------

--
-- Table structure for table `t_smartphone`
--

CREATE TABLE `t_smartphone` (
  `id` int(11) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `nama_smartphone` varchar(50) NOT NULL,
  `merek` varchar(20) NOT NULL,
  `harga` int(9) NOT NULL,
  `tahun` int(4) NOT NULL,
  `network` enum('5G','4G','3G','2G') NOT NULL,
  `tebal` float NOT NULL,
  `berat` float NOT NULL,
  `bahan_body` varchar(20) NOT NULL,
  `sim` enum('Single','Dual') NOT NULL,
  `tipe_sim` enum('Mini SIM','Micro SIM','Nano SIM') NOT NULL,
  `sim_stand` enum('Stand-by all','One-hybrit') NOT NULL,
  `jenis_layar` varchar(20) NOT NULL,
  `jenis_protect_layar` varchar(20) NOT NULL,
  `resolution_layar` float NOT NULL,
  `tipe_ui_os` varchar(25) NOT NULL,
  `jenis_chipset` varchar(20) NOT NULL,
  `nama_chipset` varchar(35) NOT NULL,
  `clock_speed_cpu` float NOT NULL,
  `jumlah_core` enum('Single core','Dual core','Quard core','Octa core') NOT NULL,
  `jenis_gpu` varchar(20) NOT NULL,
  `nama_lengkap_gpu` varchar(30) NOT NULL,
  `internal_storage` enum('1','2','4','8','16','32','64','128','256','512') NOT NULL,
  `ram` enum('0.5','1','2','3','4','6','8','12','16') NOT NULL,
  `tipe_main_camera` enum('None','Single','Double','Tripel','Quard') NOT NULL,
  `resolusi_main_camera` float NOT NULL,
  `selfie_camera` enum('None','Single','Double','Triple') NOT NULL,
  `resolusi_selfie_camera` float NOT NULL,
  `WLAN` enum('Yes','No') NOT NULL,
  `bluetooth` enum('Yes','No') NOT NULL,
  `infrared` enum('Yes','No') NOT NULL,
  `radio` enum('Yes','No') NOT NULL,
  `usb_tipe` varchar(20) NOT NULL,
  `fingerprint` enum('Yes','No') NOT NULL,
  `face_sensor` enum('Yes','No') NOT NULL,
  `tipe_batrai` enum('Non-removable','Removable') NOT NULL,
  `kapasitas_batrai` int(5) NOT NULL,
  `tipe_charger` enum('Non fast carging','Fast carging') NOT NULL,
  `test_antutu` int(11) NOT NULL,
  `image1` varchar(50) NOT NULL,
  `image2` varchar(50) NOT NULL,
  `image3` varchar(50) NOT NULL,
  `id_seller` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_smartphone`
--

INSERT INTO `t_smartphone` (`id`, `slug`, `nama_smartphone`, `merek`, `harga`, `tahun`, `network`, `tebal`, `berat`, `bahan_body`, `sim`, `tipe_sim`, `sim_stand`, `jenis_layar`, `jenis_protect_layar`, `resolution_layar`, `tipe_ui_os`, `jenis_chipset`, `nama_chipset`, `clock_speed_cpu`, `jumlah_core`, `jenis_gpu`, `nama_lengkap_gpu`, `internal_storage`, `ram`, `tipe_main_camera`, `resolusi_main_camera`, `selfie_camera`, `resolusi_selfie_camera`, `WLAN`, `bluetooth`, `infrared`, `radio`, `usb_tipe`, `fingerprint`, `face_sensor`, `tipe_batrai`, `kapasitas_batrai`, `tipe_charger`, `test_antutu`, `image1`, `image2`, `image3`, `id_seller`) VALUES
(1, 'asus_rog_phone_ii_zs660kl_8128_by_smartphoneku', 'Asus ROG Phone II ZS660KL 8/128', 'ASUS', 12000000, 2019, '5G', 9.5, 240, 'Glass', 'Dual', 'Nano SIM', 'Stand-by all', 'AMOLED', 'Gorilla Glass', 6.56, 'ROG UI', 'Snapdragon', 'Qualcomm SM8150 Snapdragon 855', 2.9, 'Octa core', 'Adreno', 'Adreno 640 (700 MHz)', '128', '8', 'Double', 48, 'Single', 24, 'Yes', 'Yes', 'Yes', 'Yes', 'USB Type-C', 'Yes', 'No', 'Non-removable', 6000, 'Fast carging', 483239, 'default.jpg', 'default.jpg', 'default.jpg', 1),
(2, 'asus_zenfone_c_zc451cg_18_by_smartphoneku', 'Asus Zenfone C ZC451CG 1/8', 'ASUS', 425000, 2015, '3G', 10, 150, 'Plastic', 'Dual', 'Micro SIM', 'Stand-by all', 'AMOLED', 'Oleophobic coating', 4.5, 'Android', 'Intel', 'Intel Atom Z2520', 1.2, 'Dual core', 'Power VR', 'PowerVR SGX544MP2', '4', '1', 'Single', 5, 'Single', 0.5, 'Yes', 'Yes', 'No', 'Yes', 'Micro USB', 'No', 'No', 'Removable', 2100, 'Non fast carging', 15325, 'default.jpg', 'default.jpg', 'default.jpg', 1),
(3, 'xiaomi_poco_m3_462_by_smartphoneku', 'Xiaomi Poco M3 4/62', 'XIAOMI', 2000000, 2020, '4G', 9.6, 198, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'IPS', 'Gorilla Glass', 6.53, 'MIUI', 'Snapdragon', 'Qualcomm SM6115 Snapdragon 662 ', 2, 'Octa core', 'Adreno', 'Adreno 610', '64', '4', 'Tripel', 48, 'Single', 8, 'Yes', 'Yes', 'Yes', 'Yes', 'USB Type-C', 'Yes', 'No', 'Non-removable', 6000, 'Fast carging', 177904, 'default.jpg', 'default.jpg', 'default.jpg', 1),
(9, 'asus_live_g500tg_216_by_smartphoneku', 'Asus Live G500TG 2/16', 'ASUS', 1000000, 2016, '3G', 10, 140, 'Plastic', 'Dual', 'Micro SIM', 'Stand-by all', 'IPS', 'Anti Spy', 5.2, 'Zen UI', 'Mediatex', 'Mediatek MT6580 ', 1.3, 'Quard core', 'Mali', 'Mali-400MP2', '16', '2', 'Single', 8, 'None', 2, 'Yes', 'Yes', 'Yes', 'Yes', 'Micro USB', 'No', 'No', 'Removable', 2070, 'Non fast carging', 12123, 'default.jpg', 'default.jpg', 'default.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_account`
--
ALTER TABLE `t_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `t_jenis_bahan_body`
--
ALTER TABLE `t_jenis_bahan_body`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_jenis_chipset`
--
ALTER TABLE `t_jenis_chipset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_jenis_gpu`
--
ALTER TABLE `t_jenis_gpu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_jenis_layar`
--
ALTER TABLE `t_jenis_layar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_jenis_merek`
--
ALTER TABLE `t_jenis_merek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_jenis_protect_layar`
--
ALTER TABLE `t_jenis_protect_layar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_jenis_ui_os`
--
ALTER TABLE `t_jenis_ui_os`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_jenis_usb`
--
ALTER TABLE `t_jenis_usb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_smartphone`
--
ALTER TABLE `t_smartphone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_account`
--
ALTER TABLE `t_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_jenis_bahan_body`
--
ALTER TABLE `t_jenis_bahan_body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_jenis_chipset`
--
ALTER TABLE `t_jenis_chipset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_jenis_gpu`
--
ALTER TABLE `t_jenis_gpu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_jenis_layar`
--
ALTER TABLE `t_jenis_layar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_jenis_merek`
--
ALTER TABLE `t_jenis_merek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_jenis_protect_layar`
--
ALTER TABLE `t_jenis_protect_layar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_jenis_ui_os`
--
ALTER TABLE `t_jenis_ui_os`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_jenis_usb`
--
ALTER TABLE `t_jenis_usb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_smartphone`
--
ALTER TABLE `t_smartphone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
