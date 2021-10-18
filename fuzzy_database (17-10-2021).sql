-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 11:24 AM
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
(1, 2, 'Kecil', 10000, 0, 60000, 'true'),
(2, 3, 'Sedang', 50000, 100000, 120000, 'true'),
(3, 1, 'Besar', 110000, 0, 500000, 'true'),
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
(9, 22, 0, 0, 0.167918, 0, 0),
(10, 23, 0, 0, 0.107218, 0, 0),
(11, 24, 0, 0, 0.0359974, 0, 0),
(12, 25, 0, 0, 0.532723, 0, 0),
(13, 26, 0, 0.47765, 0.00114615, 0, 0),
(14, 27, 0, 0.8917, 0, 0, 0),
(15, 28, 0, 0.8324, 0, 0, 0),
(16, 29, 0, 0.50842, 0, 0, 0),
(17, 30, 0.32262, 0, 0, 0, 0),
(18, 31, 0, 0.94446, 0, 0, 0),
(19, 32, 0.72882, 0, 0, 0, 0);

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
(10, 22, 0, 0, 1, 0, 0),
(12, 23, 0, 0, 0.666667, 0, 0),
(13, 24, 0, 0, 0.666667, 0, 0),
(14, 25, 0, 0, 0.433333, 0, 0),
(15, 26, 0, 0, 0.666667, 0, 0),
(16, 27, 0, 0, 0.666667, 0, 0),
(17, 28, 0, 0, 0.666667, 0, 0),
(18, 29, 0, 0.8, 0, 0, 0),
(19, 30, 0, 0.704, 0.04, 0, 0),
(20, 31, 0, 0, 0.616667, 0, 0),
(21, 32, 0, 0.56, 0, 0, 0);

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
(10, 22, 0, 0, 0.1198, 0, 0),
(12, 23, 0, 0, 0.34, 0, 0),
(13, 24, 0, 0, 0.1, 0, 0),
(14, 25, 0, 0, 0.52, 0, 0),
(15, 26, 0.0141681, 0.49875, 0, 0, 0),
(16, 27, 0, 0.644286, 0, 0, 0),
(17, 28, 0, 0.89875, 0, 0, 0),
(18, 29, 0, 0.9, 0, 0, 0),
(19, 30, 0.755, 0, 0, 0, 0),
(20, 31, 0.28125, 0.0625, 0, 0, 0),
(21, 32, 0.933994, 0, 0, 0, 0);

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
(10, 22, 0, 0.483871, 0, 0, 0),
(12, 23, 0, 0.483871, 0, 0, 0),
(13, 24, 0, 0.225806, 0, 0, 0),
(14, 25, 0, 0.483871, 0, 0, 0),
(15, 26, 0, 0.0967742, 0, 0, 0),
(16, 27, 0, 0.225806, 0, 0, 0),
(17, 28, 0, 0.225806, 0, 0, 0),
(18, 29, 0, 0.225806, 0, 0, 0),
(19, 30, 0, 0.0967742, 0, 0, 0),
(20, 31, 0, 0.0967742, 0, 0, 0),
(21, 32, 0.516129, 0, 0, 0, 0);

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
(10, 22, 0, 0.75, 0, 0, 0),
(12, 23, 0, 0.75, 0, 0, 0),
(13, 24, 0, 0.5, 0.2, 0, 0),
(14, 25, 0, 0.25, 0.4, 0, 0),
(15, 26, 0, 0.375, 0.3, 0, 0),
(16, 27, 0, 0.25, 0.4, 0, 0),
(17, 28, 0, 0.75, 0, 0, 0),
(18, 29, 0, 0.75, 0, 0, 0),
(19, 30, 0, 0.5, 0, 0, 0),
(20, 31, 0, 1, 0, 0, 0),
(21, 32, 0, 0.25, 0, 0, 0);

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
(10, 22, 0, 0.714286, 0, 0, 0),
(12, 23, 0, 0.714286, 0, 0, 0),
(13, 24, 0, 0.714286, 0, 0, 0),
(14, 25, 0, 1, 0, 0, 0),
(15, 26, 0, 0.142857, 0, 0, 0),
(16, 27, 0, 0.428571, 0, 0, 0),
(17, 28, 0, 0.428571, 0, 0, 0),
(18, 29, 0, 0.428571, 0, 0, 0),
(19, 30, 0, 0.142857, 0, 0, 0),
(20, 31, 0, 0.285714, 0, 0, 0),
(21, 32, 0.666667, 0, 0, 0, 0);

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
(10, 22, 0, 0.642857, 0, 0, 0),
(12, 23, 0, 0.642857, 0, 0, 0),
(13, 24, 0.258065, 0, 0, 0, 0),
(14, 25, 0, 0.928571, 0, 0, 0),
(15, 26, 0.516129, 0, 0, 0, 0),
(16, 27, 0.193548, 0.0178571, 0, 0, 0),
(17, 28, 0.193548, 0.0178571, 0, 0, 0),
(18, 29, 0.193548, 0.0178571, 0, 0, 0),
(19, 30, 0.193548, 0.0178571, 0, 0, 0),
(20, 31, 0, 0.0714286, 0, 0, 0),
(21, 32, 0.516129, 0, 0, 0, 0);

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
(10, 22, 0, 0.313333, 0.1325, 0, 0),
(12, 23, 0, 0.4, 0.1, 0, 0),
(13, 24, 0, 0.493333, 0.065, 0, 0),
(14, 25, 0, 0.38, 0.1075, 0, 0),
(15, 26, 0, 0.333333, 0.125, 0, 0),
(16, 27, 0, 0.353333, 0.1175, 0, 0),
(17, 28, 0, 0.433333, 0.0875, 0, 0),
(18, 29, 0, 0.866667, 0, 0, 0),
(19, 30, 0, 0.666667, 0, 0, 0),
(20, 31, 0, 0.373333, 0.11, 0, 0),
(21, 32, 0.15, 0.466667, 0, 0, 0);

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
(10, 22, 0, 1, 0, 0, 0),
(12, 23, 0, 1, 0, 0, 0),
(13, 24, 0, 0.5, 0, 0, 0),
(14, 25, 0, 1, 0, 0, 0),
(15, 26, 0, 1, 0, 0, 0),
(16, 27, 0, 1, 0, 0, 0),
(17, 28, 0, 1, 0, 0, 0),
(18, 29, 0, 0.5, 0, 0, 0),
(19, 30, 0.777778, 0, 0, 0, 0),
(20, 31, 0.777778, 0, 0, 0, 0),
(21, 32, 1, 0, 0, 0, 0);

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
  `slug` varchar(100) NOT NULL,
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

INSERT INTO `t_account` (`id`, `slug`, `full_name`, `email`, `username`, `password`, `telp`, `hak_akses`, `address`, `active_account`, `image_profile`) VALUES
(1, 'smartphoneku_telp-08985222402', 'Smartphoneku', 'ludfiniam@gmail.com', 'ludfiniam', 'admin', '08985222402', 1, 'Langon RT 09 RW 04, Tahunan, Jepara, Jawa Tengah, Indonesia', 'active', '1615617322_3668161d1a021ce31e0f.jpg'),
(2, 'sindikat-center-phone_telp-089922110909', 'Sindikat Center Phone', 'user1@gmail.com', 'user1', 'user1', '089922110909', 2, 'Ngentak Sapen no.405, Depok, Sleman, Yogyakarta', 'active', '1632471381_f0d5a775db878c833c4e.jpg'),
(4, 'ludfiniam-phone-cabang-kudus_telp-08908017333', 'Ludfiniam Phone cabang Kudus', 'ludfiniam02@gmail.com', 'ludfiniam02', 'admin123', '08908017333', 2, 'Kudus Menara', 'active', 'default.jpg'),
(5, 'ludfiniam-phone-cabang-semaran_telp-08908017444', 'Ludfiniam Phone cabang Semaran', 'ludfiniam03@gmail.com', 'ludfiniam03', '12345', '08908017444', 2, 'Ungarang Semarang', 'active', 'default.jpg');

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
  `slug` varchar(25) NOT NULL,
  `nama_merek` varchar(20) NOT NULL,
  `logo_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jenis_merek`
--

INSERT INTO `t_jenis_merek` (`id`, `slug`, `nama_merek`, `logo_img`) VALUES
(1, 'samsung_url-by-1', 'SAMSUNG', '1631695952_07bfb98ec6ceb1c7abd2.png'),
(2, 'xiaomi_url-by-2', 'XIAOMI', '1631695961_29ee7ecd0c4367a4814e.png'),
(3, 'oppo_url-by-3', 'OPPO', '1631695997_83a34a45c2f1c2b1ac17.png'),
(4, 'realme_url-by-4', 'Realme', '1631696030_35fe617eb7844e9b1bc6.png'),
(5, 'asus_url-by-5', 'ASUS', '1631696043_8062d0b5fba016d5c15b.png'),
(6, 'vivo_url-by-6', 'VIVO', '1631696120_a4effee88b037428ceba.png'),
(8, 'lenovo_url-by-8', 'Lenovo', '1631696177_0c172fc00eb93e707c1e.jpg');

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
  `nfc` enum('No','Yes') NOT NULL,
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

INSERT INTO `t_smartphone` (`id`, `slug`, `nama_smartphone`, `merek`, `harga`, `tahun`, `network`, `tebal`, `berat`, `bahan_body`, `sim`, `tipe_sim`, `sim_stand`, `jenis_layar`, `jenis_protect_layar`, `resolution_layar`, `tipe_ui_os`, `jenis_chipset`, `nama_chipset`, `clock_speed_cpu`, `jumlah_core`, `jenis_gpu`, `nama_lengkap_gpu`, `internal_storage`, `ram`, `tipe_main_camera`, `resolusi_main_camera`, `selfie_camera`, `resolusi_selfie_camera`, `WLAN`, `bluetooth`, `infrared`, `nfc`, `radio`, `usb_tipe`, `fingerprint`, `face_sensor`, `tipe_batrai`, `kapasitas_batrai`, `tipe_charger`, `test_antutu`, `image1`, `image2`, `image3`, `id_seller`) VALUES
(22, 'xiaomi_redmi_note_9_5g_by_smartphoneku', 'Xiaomi Redmi Note 9 5G', 'XIAOMI', 2599000, 2020, '5G', 9.2, 199, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'IPS', 'Gorilla Glass', 6.53, 'MIUI', 'Snapdragon', 'Qualcomm SM6115 Snapdragon 662', 2, 'Octa core', 'Adreno', 'Adreno 610', '128', '6', 'Tripel', 48, 'Single', 8, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'USB Type-C', 'Yes', 'No', 'Non-removable', 6000, 'Fast carging', 175488, '1634284977_b20d1231db9349bf9efa.jpg', '1634284977_04186fd666ad12cf0258.jpg', 'default.jpg', 1),
(23, 'samsung_galaxy_a31_by_smartphoneku', 'Samsung Galaxy A31', 'SAMSUNG', 3700000, 2020, '4G', 8.6, 185, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'Super AMOLED', 'Concore Glass', 6.4, 'One UI', 'Mediatex', 'Mediatek MT6768 Helio P65', 2, 'Octa core', 'Mali', 'Mali-G52 MC2', '128', '6', 'Quard', 48, 'None', 20, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'USB Type-C', 'Yes', 'No', 'Non-removable', 5000, 'Fast carging', 151815, '1634305855_798ae317dc4ed7b92ec3.jpg', '1634305855_fb3141784f9ae217bc80.jpg', '1634305855_d825a94e7739b3dd13ed.jpg', 1),
(24, 'asus_zenfone_max_pro_m2_by_smartphoneku', 'Asus Zenfone Max Pro (M2)', 'ASUS', 2500000, 2018, '4G', 8.5, 175, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'IPS', 'Gorilla Glass', 6.26, 'Android', 'Snapdragon', 'Qualcomm SDM660 Snapdragon 660', 2.2, 'Octa core', 'Adreno', 'Adreno 512', '64', '6', 'Double', 12, 'None', 13, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Micro USB', 'Yes', 'No', 'Non-removable', 5000, 'Non fast carging', 124039, '1634306357_f9301d2c3679b1393490.jpg', '1634306357_9a65aa2cf35fe0aad02a.jpg', '1634306357_9fbee434dc78ed2f4810.jpg', 1),
(25, 'oppo_reno5_5g_by_smartphoneku', 'Oppo Reno5 5G', 'OPPO', 4600000, 2021, '5G', 7.9, 172, 'Carbon', 'Dual', 'Nano SIM', 'Stand-by all', 'AMOLED', 'Gorilla Glass', 6.43, 'Color OS', 'Snapdragon', 'Qualcomm SM7250 Snapdragon 765G 5G', 2.4, 'Octa core', 'Power VR', 'Adreno 620', '128', '8', 'Quard', 64, 'None', 32, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'USB Type-C', 'Yes', 'No', 'Non-removable', 4300, 'Fast carging', 317762, '1634306888_7a7c1976273d449b0bdd.jpg', '1634306888_8b2b9ab9d66d1a915ae6.jpg', '1634306888_39dab9d3bec79216b70b.jpg', 1),
(26, 'realme_c20_smartphone_2gb32gb_by_sindikat_center_phone', 'realme C20 Smartphone 2GB/32GB', 'Realme', 1299000, 2021, '4G', 8.9, 190, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'IPS', 'Gorilla Glass', 6.5, 'Android', 'Mediatex', 'MediaTek MT6765G Helio G35', 2.3, 'Octa core', 'Power VR', 'PowerVR GE8320', '32', '2', 'Single', 8, 'None', 5, 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Micro USB', 'No', 'No', 'Non-removable', 5000, 'Non fast carging', 110447, '1634309619_6cecd663268c6fb9cc06.jpg', '1634309619_6b975a47adb4ac86dbe1.jpg', 'default.jpg', 2),
(27, 'vivo_y30i_ram_4gb64gb_by_smartphoneku', 'VIVO Y30i Ram 4GB/64GB', 'VIVO', 1949000, 2020, '4G', 9.1, 197, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'IPS', 'Tempered Glass', 6.47, 'Fun Touch OS', 'Mediatex', 'Mediatek MT6765 Helio P35', 2.4, 'Octa core', 'Power VR', 'PowerVR GE8320', '64', '4', 'Quard', 13, 'None', 8, 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'USB Type-C', 'Yes', 'Yes', 'Non-removable', 5000, 'Non fast carging', 102166, '1634373843_dce201fdd4096b966f70.jpg', '1634373843_98cf647ffe843ba47ee9.jpg', 'default.jpg', 1),
(28, 'vivo_y15_ram_464_gb_by_smartphoneku', 'VIVO Y15 RAM 4/64 GB', 'VIVO', 1619000, 2019, '4G', 8.9, 190.5, 'Plastic', 'Dual', 'Nano SIM', 'Stand-by all', 'IPS', 'Tempered Glass', 6.35, 'Fun Touch OS', 'Mediatex', 'Mediatek MT6762 Helio P22', 2, 'Octa core', 'Power VR', 'PowerVR GE8320', '64', '4', 'Tripel', 13, 'None', 16, 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Micro USB', 'Yes', 'No', 'Non-removable', 5000, 'Non fast carging', 91620, '1634374351_1b8ad1aa0d09d97bc04d.jpeg', '1634374351_a2d1d1c9cec8aad6a3c9.png', '1634374351_59df732be6e346219e56.jpg', 1),
(29, 'lenovo_s5_4gb64gb_garansi_distributor_by_smartphoneku', 'Lenovo S5 4Gb/64Gb Garansi Distributor', 'Lenovo', 1620000, 2018, '4G', 7.8, 155, 'Alumunium', 'Dual', 'Nano SIM', 'One-hybrit', 'IPS', 'Tempered Glass', 5.7, 'Zen UI', 'Snapdragon', 'Qualcomm MSM8953 Snapdragon 625', 2, 'Octa core', 'Adreno', 'Adreno 506', '64', '4', 'Double', 13, 'None', 16, 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'USB Type-C', 'Yes', 'No', 'Non-removable', 3000, 'Non fast carging', 75421, '1634374897_475df9eba82a7f0d0d4f.jpg', '1634374897_f1ef2658a166b62401c6.jpg', '1634374897_6cc152477137fcdcf535.jpg', 1),
(30, 'xiaomi_redmi_4a_ram_232gb_by_sindikat_center_phone', 'Xiaomi Redmi 4A Ram 2/32GB ', 'XIAOMI', 620000, 2016, '4G', 8.5, 131.5, 'Plastic', 'Dual', 'Nano SIM', 'One-hybrit', 'IPS', 'Tempered Glass', 5, 'MIUI', 'Snapdragon', 'Qualcomm MSM8917 Snapdragon 425', 1.4, 'Quad core', 'Adreno', 'Adreno 308', '32', '2', 'Single', 13, 'None', 5, 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Micro USB', 'No', 'No', 'Non-removable', 3120, 'Non fast carging', 43869, '1634438192_7a107d30523e056b2640.jpg', '1634438192_b973a5eb9221f38f7c4c.jpg', '1634438192_05bae3c0bca1da7e6e10.jpg', 2),
(31, 'xiaomi_mi_max_1_3gb32gb_by_sindikat_center_phone', 'XIAOMI MI MAX 1 3GB/32GB', 'XIAOMI', 950000, 2016, '4G', 7.5, 203, 'Alumunium', 'Dual', 'Nano SIM', 'One-hybrit', 'IPS', 'Gorilla Glass', 6.44, 'MIUI', 'Snapdragon', 'Qualcomm MSM8956 Snapdragon 650', 1.8, 'Octa core', 'Adreno', 'Adreno 510', '32', '3', 'Single', 16, 'None', 5, 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Micro USB', 'Yes', 'No', 'Non-removable', 4850, 'Non fast carging', 97223, '1634438673_d829bb01574a4b9529a1.jpg', '1634438673_d5b6d4132618c97e6e39.jpg', '1634438673_06b9792ce110f7c5aea7.jpg', 2),
(32, 'xiaomi_redmi_2_by_sindikat_center_phone', 'Xiaomi Redmi 2 ', 'XIAOMI', 418000, 2015, '4G', 9.4, 133, 'Plastic', 'Dual', 'Micro SIM', 'Stand-by all', 'IPS', 'Gorilla Glass', 4.7, 'MIUI', 'Snapdragon', 'Qualcomm MSM8916 Snapdragon 410', 1.2, 'Quad core', 'Adreno', 'Adreno 306', '8', '1', 'Single', 8, 'None', 2, 'Yes', 'Yes', 'Yes', 'No', 'Yes', 'Micro USB', 'No', 'No', 'Removable', 2200, 'Non fast carging', 23559, '1634439381_cbbb2707b32e4da6fe5e.jpg', '1634439381_fe624577834f7c1a1555.jpg', '1634439381_01ff12f4f97bf027158d.jpg', 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nilai_fk_batrai`
--
ALTER TABLE `nilai_fk_batrai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nilai_fk_harga`
--
ALTER TABLE `nilai_fk_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nilai_fk_internal`
--
ALTER TABLE `nilai_fk_internal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nilai_fk_processor`
--
ALTER TABLE `nilai_fk_processor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nilai_fk_ram`
--
ALTER TABLE `nilai_fk_ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nilai_fk_resolusi_kamera`
--
ALTER TABLE `nilai_fk_resolusi_kamera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nilai_fk_resolusi_layar`
--
ALTER TABLE `nilai_fk_resolusi_layar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nilai_fk_tahun`
--
ALTER TABLE `nilai_fk_tahun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
