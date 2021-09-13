-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2021 at 06:40 AM
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
-- Table structure for table `fk_antutu`
--

CREATE TABLE `fk_antutu` (
  `id` int(11) NOT NULL,
  `kd_rules` int(11) NOT NULL,
  `ket_status` varchar(20) NOT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) NOT NULL,
  `batas_atas` int(11) NOT NULL,
  `ket_aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fk_antutu`
--

INSERT INTO `fk_antutu` (`id`, `kd_rules`, `ket_status`, `batas_bawah`, `batas_tengah`, `batas_atas`, `ket_aktif`) VALUES
(1, 2, 'Kecil', 10000, 0, 90000, 'true'),
(2, 3, 'Sedang', 80000, 200000, 320000, 'true'),
(3, 1, 'Besar', 300000, 0, 500000, 'true'),
(4, 1, '', 0, 0, 0, 'false'),
(5, 1, '', 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `fk_batrai`
--

CREATE TABLE `fk_batrai` (
  `id` int(11) NOT NULL,
  `kd_rules` int(11) NOT NULL,
  `ket_status` varchar(20) NOT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) NOT NULL,
  `batas_atas` int(11) NOT NULL,
  `ket_aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fk_batrai`
--

INSERT INTO `fk_batrai` (`id`, `kd_rules`, `ket_status`, `batas_bawah`, `batas_tengah`, `batas_atas`, `ket_aktif`) VALUES
(1, 2, 'Kecil', 1000, 0, 2000, 'true'),
(2, 3, 'Sedang', 1500, 2750, 4000, 'true'),
(3, 1, 'Besar', 3000, 0, 6000, 'true'),
(4, 1, '', 0, 0, 0, 'false'),
(5, 1, '', 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `fk_harga`
--

CREATE TABLE `fk_harga` (
  `id` int(11) NOT NULL,
  `kd_rules` int(11) NOT NULL,
  `ket_status` varchar(20) NOT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) NOT NULL,
  `batas_atas` int(11) NOT NULL,
  `ket_aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fk_harga`
--

INSERT INTO `fk_harga` (`id`, `kd_rules`, `ket_status`, `batas_bawah`, `batas_tengah`, `batas_atas`, `ket_aktif`) VALUES
(1, 5, 'Murah', 200000, 0, 1400000, 'true'),
(2, 3, 'Sedang', 900000, 1700000, 2400000, 'true'),
(3, 1, 'Mahal', 2000000, 0, 7000000, 'true'),
(4, 1, '', 100000, 0, 100000, 'false'),
(5, 1, '', 100000, 0, 100000, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `fk_internal`
--

CREATE TABLE `fk_internal` (
  `id` int(11) NOT NULL,
  `kd_rules` int(11) NOT NULL,
  `ket_status` varchar(20) NOT NULL,
  `batas_bawah` float NOT NULL,
  `batas_tengah` float NOT NULL,
  `batas_atas` float NOT NULL,
  `ket_aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fk_internal`
--

INSERT INTO `fk_internal` (`id`, `kd_rules`, `ket_status`, `batas_bawah`, `batas_tengah`, `batas_atas`, `ket_aktif`) VALUES
(1, 2, 'Kecil', 0.5, 0.5, 16, 'true'),
(2, 1, 'Sedang', 8, 0.5, 256, 'true'),
(3, 1, '', 0.5, 0.5, 0.5, 'false'),
(4, 1, '', 0.5, 0.5, 0.5, 'false'),
(5, 1, '', 0.5, 0.5, 0.5, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `fk_processor`
--

CREATE TABLE `fk_processor` (
  `id` int(11) NOT NULL,
  `kd_rules` int(11) NOT NULL,
  `ket_status` varchar(20) NOT NULL,
  `batas_bawah` float NOT NULL,
  `batas_tengah` float NOT NULL,
  `batas_atas` float NOT NULL,
  `ket_aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fk_processor`
--

INSERT INTO `fk_processor` (`id`, `kd_rules`, `ket_status`, `batas_bawah`, `batas_tengah`, `batas_atas`, `ket_aktif`) VALUES
(1, 2, 'Lambat', 0.5, 0, 1.2, 'true'),
(2, 3, 'Sedang', 1, 1.8, 2.6, 'true'),
(3, 1, 'Cepat', 2, 0, 3, 'true'),
(4, 1, '', 0, 0, 0, 'false'),
(5, 1, '', 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `fk_ram`
--

CREATE TABLE `fk_ram` (
  `id` int(11) NOT NULL,
  `kd_rules` int(11) NOT NULL,
  `ket_status` varchar(20) NOT NULL,
  `batas_bawah` float NOT NULL,
  `batas_tengah` float NOT NULL,
  `batas_atas` float NOT NULL,
  `ket_aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fk_ram`
--

INSERT INTO `fk_ram` (`id`, `kd_rules`, `ket_status`, `batas_bawah`, `batas_tengah`, `batas_atas`, `ket_aktif`) VALUES
(1, 2, 'Kecil', 0.5, 0, 2, 'true'),
(2, 1, 'Besar', 1, 0, 8, 'true'),
(3, 1, '', 0, 0, 0, 'false'),
(4, 1, '', 0, 0, 0, 'false'),
(5, 1, '', 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `fk_resolusi_kamera`
--

CREATE TABLE `fk_resolusi_kamera` (
  `id` int(11) NOT NULL,
  `kd_rules` int(11) NOT NULL,
  `ket_status` varchar(20) NOT NULL,
  `batas_bawah` float NOT NULL,
  `batas_tengah` float NOT NULL,
  `batas_atas` float NOT NULL,
  `ket_aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fk_resolusi_kamera`
--

INSERT INTO `fk_resolusi_kamera` (`id`, `kd_rules`, `ket_status`, `batas_bawah`, `batas_tengah`, `batas_atas`, `ket_aktif`) VALUES
(1, 2, 'Kecil', 0.5, 0, 16, 'true'),
(2, 1, 'Besar', 12, 0, 68, 'true'),
(3, 1, '', 0, 0, 0, 'false'),
(4, 1, '', 0, 0, 0, 'false'),
(5, 1, '', 0, 0, 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `fk_resolusi_layar`
--

CREATE TABLE `fk_resolusi_layar` (
  `id` int(11) NOT NULL,
  `kd_rules` int(11) NOT NULL,
  `ket_status` varchar(20) NOT NULL,
  `batas_bawah` float NOT NULL,
  `batas_tengah` float NOT NULL,
  `batas_atas` float NOT NULL,
  `ket_aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fk_resolusi_layar`
--

INSERT INTO `fk_resolusi_layar` (`id`, `kd_rules`, `ket_status`, `batas_bawah`, `batas_tengah`, `batas_atas`, `ket_aktif`) VALUES
(1, 2, 'Kecil', 3, 0, 5, 'true'),
(2, 3, 'Sedang', 4, 5.5, 7, 'true'),
(3, 1, 'Lebar', 6, 0, 10, 'true'),
(4, 1, '', 0.1, 0, 0.1, 'false'),
(5, 1, '', 0.1, 0, 0.1, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `fk_tahun`
--

CREATE TABLE `fk_tahun` (
  `id` int(11) NOT NULL,
  `kd_rules` int(11) NOT NULL,
  `ket_status` varchar(20) NOT NULL,
  `batas_bawah` int(11) NOT NULL,
  `batas_tengah` int(11) NOT NULL,
  `batas_atas` int(11) NOT NULL,
  `ket_aktif` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fk_tahun`
--

INSERT INTO `fk_tahun` (`id`, `kd_rules`, `ket_status`, `batas_bawah`, `batas_tengah`, `batas_atas`, `ket_aktif`) VALUES
(1, 5, 'Kuno', 2015, 0, 2018, 'true'),
(2, 4, 'Terbaru', 2017, 0, 2019, 'true'),
(3, 1, '', 2015, 2015, 2015, 'false'),
(4, 1, '', 2015, 2015, 2015, 'false'),
(5, 1, '', 2015, 2015, 2015, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fk_antutu`
--

CREATE TABLE `nilai_fk_antutu` (
  `id` int(11) NOT NULL,
  `id_smartphone` int(11) NOT NULL,
  `keanggotaan1` float NOT NULL,
  `keanggotaan2` float NOT NULL,
  `keanggotaan3` float NOT NULL,
  `keanggotaan4` float NOT NULL,
  `keanggotaan5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_fk_antutu`
--

INSERT INTO `nilai_fk_antutu` (`id`, `id_smartphone`, `keanggotaan1`, `keanggotaan2`, `keanggotaan3`, `keanggotaan4`, `keanggotaan5`) VALUES
(2, 3, 0, 0.815867, 0, 0, 0),
(3, 9, 0.973463, 0, 0, 0, 0),
(4, 13, 0.163875, 0, 0, 0, 0),
(5, 16, 0, 0, 0.13267, 0, 0),
(7, 18, 0, 0.369375, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fk_batrai`
--

CREATE TABLE `nilai_fk_batrai` (
  `id` int(11) NOT NULL,
  `id_smartphone` int(11) NOT NULL,
  `keanggotaan1` float NOT NULL,
  `keanggotaan2` float NOT NULL,
  `keanggotaan3` float NOT NULL,
  `keanggotaan4` float NOT NULL,
  `keanggotaan5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_fk_batrai`
--

INSERT INTO `nilai_fk_batrai` (`id`, `id_smartphone`, `keanggotaan1`, `keanggotaan2`, `keanggotaan3`, `keanggotaan4`, `keanggotaan5`) VALUES
(2, 3, 0, 0, 1, 0, 0),
(3, 9, 0, 0.456, 0, 0, 0),
(4, 13, 0, 0.4, 0, 0, 0),
(5, 16, 0, 0, 1, 0, 0),
(7, 18, 0, 0, 0.833333, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fk_harga`
--

CREATE TABLE `nilai_fk_harga` (
  `id` int(11) NOT NULL,
  `id_smartphone` int(11) NOT NULL,
  `keanggotaan1` float NOT NULL,
  `keanggotaan2` float NOT NULL,
  `keanggotaan3` float NOT NULL,
  `keanggotaan4` float NOT NULL,
  `keanggotaan5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_fk_harga`
--

INSERT INTO `nilai_fk_harga` (`id`, `id_smartphone`, `keanggotaan1`, `keanggotaan2`, `keanggotaan3`, `keanggotaan4`, `keanggotaan5`) VALUES
(2, 3, 0, 0.571429, 0, 0, 0),
(3, 9, 0.222222, 0.125, 0, 0, 0),
(4, 13, 0.829861, 0, 0, 0, 0),
(5, 16, 0, 0, 0.6, 0, 0),
(7, 18, 0, 0, 0.28, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fk_internal`
--

CREATE TABLE `nilai_fk_internal` (
  `id` int(11) NOT NULL,
  `id_smartphone` int(11) NOT NULL,
  `keanggotaan1` float NOT NULL,
  `keanggotaan2` float NOT NULL,
  `keanggotaan3` float NOT NULL,
  `keanggotaan4` float NOT NULL,
  `keanggotaan5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_fk_internal`
--

INSERT INTO `nilai_fk_internal` (`id`, `id_smartphone`, `keanggotaan1`, `keanggotaan2`, `keanggotaan3`, `keanggotaan4`, `keanggotaan5`) VALUES
(2, 3, 0, 0.225806, 0, 0, 0),
(3, 9, 0, 0.0322581, 0, 0, 0),
(4, 13, 0.516129, 0, 0, 0, 0),
(5, 16, 0, 1, 0, 0, 0),
(7, 18, 0, 0.225806, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fk_processor`
--

CREATE TABLE `nilai_fk_processor` (
  `id` int(11) NOT NULL,
  `id_smartphone` int(11) NOT NULL,
  `keanggotaan1` float NOT NULL,
  `keanggotaan2` float NOT NULL,
  `keanggotaan3` float NOT NULL,
  `keanggotaan4` float NOT NULL,
  `keanggotaan5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_fk_processor`
--

INSERT INTO `nilai_fk_processor` (`id`, `id_smartphone`, `keanggotaan1`, `keanggotaan2`, `keanggotaan3`, `keanggotaan4`, `keanggotaan5`) VALUES
(2, 3, 0, 0.75, 0, 0, 0),
(3, 9, 0, 0.375, 0, 0, 0),
(4, 13, 0, 0.25, 0, 0, 0),
(5, 16, 0, 0, 0.7, 0, 0),
(7, 18, 0, 0.25, 0.4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fk_ram`
--

CREATE TABLE `nilai_fk_ram` (
  `id` int(11) NOT NULL,
  `id_smartphone` int(11) NOT NULL,
  `keanggotaan1` float NOT NULL,
  `keanggotaan2` float NOT NULL,
  `keanggotaan3` float NOT NULL,
  `keanggotaan4` float NOT NULL,
  `keanggotaan5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_fk_ram`
--

INSERT INTO `nilai_fk_ram` (`id`, `id_smartphone`, `keanggotaan1`, `keanggotaan2`, `keanggotaan3`, `keanggotaan4`, `keanggotaan5`) VALUES
(2, 3, 0, 0.428571, 0, 0, 0),
(3, 9, 0, 0.142857, 0, 0, 0),
(4, 13, 0.666667, 0, 0, 0, 0),
(5, 16, 0, 0.714286, 0, 0, 0),
(7, 18, 0, 0.428571, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fk_resolusi_kamera`
--

CREATE TABLE `nilai_fk_resolusi_kamera` (
  `id` int(11) NOT NULL,
  `id_smartphone` int(11) NOT NULL,
  `keanggotaan1` float NOT NULL,
  `keanggotaan2` float NOT NULL,
  `keanggotaan3` float NOT NULL,
  `keanggotaan4` float NOT NULL,
  `keanggotaan5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_fk_resolusi_kamera`
--

INSERT INTO `nilai_fk_resolusi_kamera` (`id`, `id_smartphone`, `keanggotaan1`, `keanggotaan2`, `keanggotaan3`, `keanggotaan4`, `keanggotaan5`) VALUES
(2, 3, 0, 0.642857, 0, 0, 0),
(3, 9, 0.516129, 0, 0, 0, 0),
(4, 13, 0.516129, 0, 0, 0, 0),
(5, 16, 0, 0.642857, 0, 0, 0),
(7, 18, 0, 0.642857, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fk_resolusi_layar`
--

CREATE TABLE `nilai_fk_resolusi_layar` (
  `id` int(11) NOT NULL,
  `id_smartphone` int(11) NOT NULL,
  `keanggotaan1` float NOT NULL,
  `keanggotaan2` float NOT NULL,
  `keanggotaan3` float NOT NULL,
  `keanggotaan4` float NOT NULL,
  `keanggotaan5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_fk_resolusi_layar`
--

INSERT INTO `nilai_fk_resolusi_layar` (`id`, `id_smartphone`, `keanggotaan1`, `keanggotaan2`, `keanggotaan3`, `keanggotaan4`, `keanggotaan5`) VALUES
(2, 3, 0, 0.313333, 0.1325, 0, 0),
(3, 9, 0, 0.8, 0, 0, 0),
(4, 13, 0.25, 0.333333, 0, 0, 0),
(5, 16, 0, 0, 0.55, 0, 0),
(7, 18, 0, 0, 0.425, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fk_tahun`
--

CREATE TABLE `nilai_fk_tahun` (
  `id` int(11) NOT NULL,
  `id_smartphone` int(11) NOT NULL,
  `keanggotaan1` float NOT NULL,
  `keanggotaan2` float NOT NULL,
  `keanggotaan3` float NOT NULL,
  `keanggotaan4` float NOT NULL,
  `keanggotaan5` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_fk_tahun`
--

INSERT INTO `nilai_fk_tahun` (`id`, `id_smartphone`, `keanggotaan1`, `keanggotaan2`, `keanggotaan3`, `keanggotaan4`, `keanggotaan5`) VALUES
(2, 3, 0, 1, 0, 0, 0),
(3, 9, 0.777778, 0, 0, 0, 0),
(4, 13, 1, 0, 0, 0, 0),
(5, 16, 0, 1, 0, 0, 0),
(7, 18, 0, 0.5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `nama_rules` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `nama_rules`) VALUES
(1, 'Linier Naik'),
(2, 'Linier Turun'),
(3, 'Segitiga'),
(4, 'Sigmoid Pertumbuhan'),
(5, 'Sigmoid Penyusutan'),
(6, 'Kurva S');

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
  `active_account` enum('active','non-active') NOT NULL,
  `image_profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_account`
--

INSERT INTO `t_account` (`id`, `full_name`, `email`, `username`, `password`, `telp`, `hak_akses`, `address`, `active_account`, `image_profile`) VALUES
(1, 'Smartphoneku', 'ludfiniam@gmail.com', 'ludfiniam', 'admin', '08985222402', 1, 'Langon RT 09 RW 04, Tahunan, Jepara, Jawa Tengah, Indonesia', 'active', '1615617322_3668161d1a021ce31e0f.jpg'),
(2, 'Sindikat Center Phone', 'user1@gmail.com', 'user1', 'user1', '089922110909', 2, 'Ngentak Sapen no.405, Depok, Sleman, Yogyakarta', 'active', '1615443596_3b223196d1c2c75c7a01.jpeg'),
(4, 'Ludfiniam Phone cabang Kudus', 'ludfiniam02@gmail.com', 'ludfiniam02', 'admin123', '08908017333', 2, 'Kudus Menara', 'active', 'default.jpg'),
(5, 'Ludfiniam Phone cabang Semaran', 'ludfiniam03@gmail.com', 'ludfiniam03', '12345', '08908017444', 2, 'Ungarang Semarang', 'active', 'default.jpg');

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
  `jumlah_core` enum('Single core','Dual core','Quad core','Octa core') NOT NULL,
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
(3, 'xiaomi_poco_m3_462_by_smartphoneku', 'Xiaomi Poco M3 4/62', 'XIAOMI', 2000000, 2020, '4G', 9.6, 198, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'IPS', 'Gorilla Glass', 6.53, 'MIUI', 'Snapdragon', 'Qualcomm SM6115 Snapdragon 662 ', 2, 'Octa core', 'Adreno', 'Adreno 610', '64', '4', 'Tripel', 48, 'Single', 8, 'Yes', 'Yes', 'Yes', 'Yes', 'USB Type-C', 'Yes', 'No', 'Non-removable', 6000, 'Fast carging', 177904, '1616820443_7e03f6fb3f8faca3d952.jpg', '1616820443_bccdfacd930564e9c736.jpg', '1616820352_f146bae86bf9565f534d.jpeg', 1),
(9, 'asus_live_g500tg_216_by_smartphoneku', 'Asus Live G500TG 2/16', 'ASUS', 1000000, 2016, '3G', 10, 140, 'Plastic', 'Dual', 'Micro SIM', 'Stand-by all', 'IPS', 'Anti Spy', 5.2, 'Zen UI', 'Mediatex', 'Mediatek MT6580 ', 1.3, 'Quad core', 'Mali', 'Mali-400MP2', '16', '2', 'Single', 8, 'Single', 2, 'Yes', 'Yes', 'Yes', 'Yes', 'Micro USB', 'No', 'No', 'Removable', 2070, 'Non fast carging', 12123, 'default.jpg', 'default.jpg', 'default.jpg', 1),
(13, 'oppo_a31_2015_by_smartphoneku', 'Oppo A31 (2015) ', 'OPPO', 550000, 2015, '4G', 8, 135, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'IPS', 'Oleophobic coating', 4.5, 'Android', 'Snapdragon', 'MSM8916 Snapdragon 410 ', 1.2, 'Quad core', 'Adreno', 'Adreno 306', '8', '1', 'Single', 8, 'None', 5, 'Yes', 'Yes', 'Yes', 'No', 'Micro USB', 'No', 'No', 'Non-removable', 2000, 'Non fast carging', 76890, '1614908457_d6311df8ac64c559e1d1.png', 'default.jpg', 'default.jpg', 1),
(16, 'asus_rog_6256_by_smartphoneku', 'Asus ROG 6/256', 'ASUS', 5000000, 2019, '4G', 12.5, 120, 'Carbon', 'Dual', 'Nano SIM', 'Stand-by all', 'Super AMOLED', 'Gorilla Glass', 8.2, 'ROG UI', 'Snapdragon', 'Snapdragon 880', 2.7, 'Octa core', 'Adreno', 'Adreno 770', '256', '6', 'Double', 48, 'Single', 16, 'Yes', 'Yes', 'Yes', 'Yes', 'USB Type-C', 'Yes', 'Yes', 'Non-removable', 8000, 'Fast carging', 326534, 'default.jpg', 'default.jpg', 'default.jpg', 1),
(18, 'oppo_reno_4_by_smartphoneku', 'Oppo Reno 4', 'OPPO', 3400000, 2018, '4G', 9.51, 179.6, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'IPS', 'Concore Glass', 7.7, 'Android', 'Snapdragon', 'Snapdragon 855', 2.4, 'Octa core', 'Adreno', 'Adreno 670', '64', '4', 'Quard', 48, 'None', 24, 'Yes', 'Yes', 'Yes', 'Yes', 'USB Type-C', 'Yes', 'Yes', 'Non-removable', 5500, 'Fast carging', 275675, 'default.jpg', 'default.jpg', 'default.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fk_antutu`
--
ALTER TABLE `fk_antutu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fk_batrai`
--
ALTER TABLE `fk_batrai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fk_harga`
--
ALTER TABLE `fk_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fk_internal`
--
ALTER TABLE `fk_internal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fk_processor`
--
ALTER TABLE `fk_processor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fk_ram`
--
ALTER TABLE `fk_ram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fk_resolusi_kamera`
--
ALTER TABLE `fk_resolusi_kamera`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fk_resolusi_layar`
--
ALTER TABLE `fk_resolusi_layar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fk_tahun`
--
ALTER TABLE `fk_tahun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_fk_antutu`
--
ALTER TABLE `nilai_fk_antutu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_fk_batrai`
--
ALTER TABLE `nilai_fk_batrai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_fk_harga`
--
ALTER TABLE `nilai_fk_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_fk_internal`
--
ALTER TABLE `nilai_fk_internal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_fk_processor`
--
ALTER TABLE `nilai_fk_processor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_fk_ram`
--
ALTER TABLE `nilai_fk_ram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_fk_resolusi_kamera`
--
ALTER TABLE `nilai_fk_resolusi_kamera`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_fk_resolusi_layar`
--
ALTER TABLE `nilai_fk_resolusi_layar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_fk_tahun`
--
ALTER TABLE `nilai_fk_tahun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `fk_antutu`
--
ALTER TABLE `fk_antutu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fk_batrai`
--
ALTER TABLE `fk_batrai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fk_harga`
--
ALTER TABLE `fk_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fk_internal`
--
ALTER TABLE `fk_internal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fk_processor`
--
ALTER TABLE `fk_processor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fk_ram`
--
ALTER TABLE `fk_ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fk_resolusi_kamera`
--
ALTER TABLE `fk_resolusi_kamera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fk_resolusi_layar`
--
ALTER TABLE `fk_resolusi_layar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fk_tahun`
--
ALTER TABLE `fk_tahun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai_fk_antutu`
--
ALTER TABLE `nilai_fk_antutu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_fk_batrai`
--
ALTER TABLE `nilai_fk_batrai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_fk_harga`
--
ALTER TABLE `nilai_fk_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_fk_internal`
--
ALTER TABLE `nilai_fk_internal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_fk_processor`
--
ALTER TABLE `nilai_fk_processor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_fk_ram`
--
ALTER TABLE `nilai_fk_ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_fk_resolusi_kamera`
--
ALTER TABLE `nilai_fk_resolusi_kamera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_fk_resolusi_layar`
--
ALTER TABLE `nilai_fk_resolusi_layar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai_fk_tahun`
--
ALTER TABLE `nilai_fk_tahun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_account`
--
ALTER TABLE `t_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
