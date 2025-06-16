-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 12:51 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kud_karyamandiri`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `surename` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `handphone` varchar(15) DEFAULT NULL,
  `id_kelompok` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `surename`, `username`, `nik`, `handphone`, `id_kelompok`) VALUES
(1, 'Komarudin', 'Komarudin', '3215678987600004', '082281171850', 1),
(2, 'Resa Nurmahmudin', 'resanurmahmudin', '3321132156765432', '082281171850', 7),
(3, 'Sulastro', 'sulastro', '9473753476411671', '021762522119', 1),
(4, 'Minto', 'minto', '8763105458923330', '', 1),
(6, 'Marno', 'marno', '4127928453840916', '', 2),
(7, 'Bejo sutejo', 'bejo_sutejo', '999999', '08211111111111', 7),
(8, 'Budi Siregar', 'Kapal Lawd', '0011233238707342', '081255662024', 7);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_jual` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `barcode`, `nama_barang`, `harga_jual`) VALUES
(2, '12345678', 'Give Rose', 3500.00),
(7, '911877112', 'Kopi Cap', 2000.00),
(8, '11133311', 'Crytalin', 2500.00),
(9, '1111111', 'Pepsodent 120 gram', 12000.00),
(10, '8993092150925', 'Arthes 1.5 L', 10000.00),
(11, '8886057883665', 'Kratingdaeng 150ml', 7000.00),
(12, '9999999', 'Aqua 500 Ml', 3000.00),
(13, '12112333', 'Cotton', 3000.00),
(14, '123645584218', 'Minyak Goreng Rosebrand 500ml', 25000.00),
(15, '5579132545454', 'Beras Sepat 20kg', 215000.00),
(16, '5579132545450', 'Beras Sepat 5kg', 52000.00);

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `id_credits` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`id_credits`, `id_penjualan`, `id_anggota`, `status`) VALUES
(1, 46, 1, 'lunas'),
(2, 47, 1, 'lunas'),
(3, 48, 2, 'lunas'),
(4, 51, 1, 'lunas'),
(5, 55, 2, 'lunas'),
(6, 59, 2, 'lunas'),
(7, 60, 1, 'lunas'),
(8, 63, 1, 'lunas'),
(9, 65, 6, 'lunas'),
(10, 67, 2, 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `durasi_tempo`
--

CREATE TABLE `durasi_tempo` (
  `id_durasi_tempo` int(11) NOT NULL,
  `tempo` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `durasi_tempo`
--

INSERT INTO `durasi_tempo` (`id_durasi_tempo`, `tempo`) VALUES
(1, 6),
(2, 10),
(3, 15),
(4, 20),
(5, 24),
(6, 30),
(7, 36);

-- --------------------------------------------------------

--
-- Table structure for table `gaji_anggota`
--

CREATE TABLE `gaji_anggota` (
  `id_gaji` int(255) NOT NULL,
  `id_anggota` int(12) NOT NULL,
  `id_kelompok` int(12) NOT NULL,
  `tanggal_penyaluran` date NOT NULL,
  `total_hasil_panen` decimal(12,2) NOT NULL,
  `total_potongan` decimal(12,2) NOT NULL,
  `total_credits` decimal(12,2) NOT NULL,
  `total_gaji_bersih` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji_anggota`
--

INSERT INTO `gaji_anggota` (`id_gaji`, `id_anggota`, `id_kelompok`, `tanggal_penyaluran`, `total_hasil_panen`, `total_potongan`, `total_credits`, `total_gaji_bersih`) VALUES
(1, 1, 0, '2024-09-04', 9061000.00, 210500.00, 10500.00, 8850500.00),
(2, 1, 0, '2024-10-29', 6840000.00, 233000.00, 33000.00, 6607000.00),
(3, 1, 0, '2024-11-08', 6670000.00, 216000.00, 16000.00, 6454000.00);

-- --------------------------------------------------------

--
-- Table structure for table `harga_sawit`
--

CREATE TABLE `harga_sawit` (
  `tanggal_berlaku` date NOT NULL,
  `harga` decimal(11,2) NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga_sawit`
--

INSERT INTO `harga_sawit` (`tanggal_berlaku`, `harga`, `tanggal_berakhir`, `id`) VALUES
('2024-05-31', 2100.00, '2024-06-07', 1),
('2024-06-14', 2200.00, '2024-06-20', 2),
('2024-06-21', 2230.00, '2024-06-27', 4),
('2024-06-28', 2210.00, '2024-07-04', 7),
('2024-07-05', 2400.00, '2024-07-11', 9),
('2024-07-12', 2510.00, '2024-07-18', 10),
('2024-07-28', 2300.00, '2024-08-04', 11);

-- --------------------------------------------------------

--
-- Table structure for table `item_terjual`
--

CREATE TABLE `item_terjual` (
  `id_item_terjual` int(255) NOT NULL,
  `id_penjualan` int(255) NOT NULL,
  `id_barang` int(255) NOT NULL,
  `id_stok` int(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_users` int(255) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `harga` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_terjual`
--

INSERT INTO `item_terjual` (`id_item_terjual`, `id_penjualan`, `id_barang`, `id_stok`, `tanggal`, `id_users`, `jumlah`, `harga`) VALUES
(39, 39, 2, 12, '2024-07-28 19:13:41', 21, 24, 3500.00),
(40, 39, 2, 13, '2024-07-28 19:13:41', 21, 1, 3500.00),
(41, 40, 7, 14, '2024-07-28 20:54:20', 21, 1, 2000.00),
(42, 40, 2, 13, '2024-07-28 20:54:20', 21, 1, 3500.00),
(45, 43, 2, 13, '2024-07-29 05:47:10', 21, 10, 3500.00),
(46, 43, 7, 14, '2024-07-29 05:47:10', 21, 2, 2000.00),
(47, 44, 2, 13, '2024-08-10 05:40:39', 21, 1, 3500.00),
(48, 45, 2, 13, '2024-08-12 21:01:13', 21, 1, 3500.00),
(49, 45, 11, 18, '2024-08-12 21:01:13', 21, 1, 7000.00),
(50, 46, 2, 13, '2024-08-13 07:26:09', 21, 1, 3500.00),
(51, 47, 2, 13, '2024-08-13 07:46:21', 21, 1, 3500.00),
(52, 48, 11, 18, '2024-08-13 19:15:37', 21, 1, 7000.00),
(54, 51, 2, 13, '2024-08-16 06:21:52', 21, 1, 3500.00),
(55, 52, 11, 18, '2024-08-21 05:32:31', 27, 1, 7000.00),
(56, 53, 11, 18, '2024-08-24 19:42:16', 21, 1, 7000.00),
(57, 53, 2, 13, '2024-08-24 19:42:16', 21, 1, 3500.00),
(58, 54, 13, 20, '2024-10-26 08:16:54', 26, 2, 3000.00),
(59, 54, 10, 22, '2024-10-26 08:16:54', 26, 1, 10000.00),
(60, 55, 9, 19, '2024-10-26 09:07:26', 26, 1, 12000.00),
(61, 56, 2, 13, '2024-10-28 23:20:57', 21, 6, 3500.00),
(62, 56, 2, 21, '2024-10-28 23:20:57', 21, 4, 3500.00),
(63, 56, 10, 22, '2024-10-28 23:20:57', 21, 10, 10000.00),
(68, 59, 7, 14, '2024-10-28 23:29:25', 21, 9, 2000.00),
(69, 59, 7, 23, '2024-10-28 23:29:25', 21, 1, 2000.00),
(70, 59, 11, 18, '2024-10-28 23:29:25', 21, 10, 7000.00),
(71, 59, 12, 17, '2024-10-28 23:29:25', 21, 10, 3000.00),
(72, 60, 13, 20, '2024-10-29 00:25:58', 21, 2, 3000.00),
(73, 60, 11, 18, '2024-10-29 00:25:58', 21, 3, 7000.00),
(74, 60, 12, 17, '2024-10-29 00:25:58', 21, 2, 3000.00),
(75, 62, 9, 19, '2024-11-02 05:02:14', 21, 1, 12000.00),
(76, 62, 2, 21, '2024-11-02 05:02:14', 21, 1, 3500.00),
(77, 63, 13, 20, '2024-11-02 19:07:06', 21, 2, 3000.00),
(78, 63, 12, 17, '2024-11-02 19:07:06', 21, 1, 3000.00),
(79, 63, 11, 18, '2024-11-02 19:07:06', 21, 1, 7000.00),
(81, 65, 11, 18, '2024-11-08 18:56:39', 26, 3, 7000.00),
(82, 67, 13, 20, '2024-11-08 19:04:51', 26, 1, 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_tani`
--

CREATE TABLE `kelompok_tani` (
  `id_kelompoktani` int(11) NOT NULL,
  `kelompok_tani` varchar(255) NOT NULL,
  `id_ketua` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelompok_tani`
--

INSERT INTO `kelompok_tani` (`id_kelompoktani`, `kelompok_tani`, `id_ketua`) VALUES
(1, 'MM1', 28),
(2, 'MM2', 29),
(3, 'MM3', 33),
(4, 'MM4', 0),
(5, 'MM5', 0),
(6, 'MM6', 0),
(7, 'Umum', 0),
(8, 'Privat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pinjaman`
--

CREATE TABLE `nilai_pinjaman` (
  `id_nilai_pinjaman` int(11) NOT NULL,
  `nilai_pinjaman` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_pinjaman`
--

INSERT INTO `nilai_pinjaman` (`id_nilai_pinjaman`, `nilai_pinjaman`) VALUES
(1, 1000000.00),
(2, 2000000.00),
(3, 3000000.00),
(4, 4000000.00),
(5, 5000000.00),
(6, 6000000.00),
(7, 7000000.00),
(8, 8000000.00),
(9, 9000000.00),
(10, 10000000.00),
(11, 11000000.00),
(12, 12000000.00),
(13, 13000000.00),
(14, 14000000.00),
(15, 15000000.00),
(16, 16000000.00),
(17, 17000000.00),
(18, 18000000.00),
(19, 19000000.00),
(20, 20000000.00),
(21, 21000000.00),
(22, 22000000.00),
(23, 23000000.00),
(24, 24000000.00),
(25, 25000000.00),
(26, 26000000.00),
(27, 27000000.00),
(28, 28000000.00),
(29, 29000000.00),
(30, 30000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `panen`
--

CREATE TABLE `panen` (
  `id_panen` int(255) NOT NULL,
  `id_anggota` int(12) NOT NULL,
  `tanggal_panen` date NOT NULL,
  `berat_panen` int(10) DEFAULT NULL,
  `harga_tbs` decimal(11,2) NOT NULL,
  `id_kelompok` int(12) NOT NULL,
  `is_paid_off` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `panen`
--

INSERT INTO `panen` (`id_panen`, `id_anggota`, `tanggal_panen`, `berat_panen`, `harga_tbs`, `id_kelompok`, `is_paid_off`) VALUES
(1, 1, '2024-08-28', 1300, 2100.00, 1, 1),
(2, 1, '2024-08-18', 1500, 2300.00, 1, 1),
(3, 1, '2024-08-08', 1340, 2150.00, 1, 1),
(4, 3, '2024-09-07', 1200, 2100.00, 1, 0),
(5, 1, '2024-10-03', 1000, 2300.00, 1, 0),
(6, 1, '2024-10-13', 800, 2300.00, 1, 0),
(7, 1, '2024-10-23', 1100, 2300.00, 1, 0),
(8, 1, '2024-09-03', 1200, 2300.00, 1, 0),
(9, 1, '2024-09-13', 700, 2400.00, 1, 0),
(10, 1, '2024-09-23', 1000, 2400.00, 1, 0),
(11, 4, '2024-11-03', 1234, 2500.00, 1, 0),
(12, 4, '2024-10-23', 2100, 2600.00, 1, 0),
(13, 0, '2024-11-03', 1300, 2230.00, 0, 0),
(14, 4, '2024-11-03', 1300, 2230.00, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(128) NOT NULL,
  `id_pinjaman` int(128) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `nominal_pembayaran` decimal(15,2) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pinjaman`, `id_anggota`, `nominal_pembayaran`, `tanggal_bayar`, `deskripsi`) VALUES
(6, 11, 4, 1100000.00, '2024-07-27', 'pembayaran pertama'),
(7, 13, 7, 1060000.00, '2024-08-19', 'Cicilan ke-1'),
(8, 12, 3, 600000.00, '2024-08-25', '1'),
(9, 9, 2, 1060000.00, '2024-10-29', 'Pembayaran Pertama'),
(10, 10, 1, 13440000.00, '2024-10-29', 'Pelunasan Total');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `struk` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_users` int(11) DEFAULT NULL,
  `total_belanja` decimal(11,2) DEFAULT NULL,
  `metode_pembayaran` enum('cash','credits') DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `struk`, `tanggal`, `id_users`, `total_belanja`, `metode_pembayaran`, `id_anggota`) VALUES
(39, 'STRUK_1722219221', '2024-07-28 19:13:41', 21, 87500.00, 'cash', 0),
(40, 'STRUK_1722225259', '2024-07-28 20:54:19', 21, 5500.00, 'cash', 0),
(43, 'STRUK_1722257230', '2024-07-29 05:47:10', 21, 39000.00, 'cash', 0),
(44, 'STRUK_1723293639', '2024-08-10 05:40:39', 21, 3500.00, 'cash', 0),
(45, 'STRUK_1723521673', '2024-08-13 12:34:31', 21, 10500.00, 'cash', 0),
(46, 'STRUK_1723559169', '2024-08-14 02:12:56', 21, 3500.00, 'credits', 1),
(47, 'STRUK_1723560381', '2024-08-13 07:46:21', 21, 3500.00, 'credits', 1),
(48, 'STRUK_1723601737', '2024-08-13 19:15:37', 21, 7000.00, 'credits', 2),
(51, 'STRUK_1723814512', '2024-08-16 06:21:52', 21, 3500.00, 'credits', 1),
(52, 'STRUK_1724243551', '2024-08-21 05:32:31', 27, 7000.00, 'cash', 0),
(53, 'STRUK_1724553736', '2024-08-24 19:42:16', 21, 10500.00, 'cash', 0),
(54, 'STRUK_1729955814', '2024-10-26 08:16:54', 26, 16000.00, 'cash', 0),
(55, 'STRUK_1729958846', '2024-10-26 09:07:26', 26, 12000.00, 'credits', 2),
(56, 'STRUK_1730182856', '2024-10-28 23:20:56', 21, 135000.00, 'cash', 0),
(59, 'STRUK_1730183365', '2024-10-28 23:29:25', 21, 120000.00, 'credits', 2),
(60, 'STRUK_1730186758', '2024-10-29 00:25:58', 21, 33000.00, 'credits', 1),
(62, 'STRUK_1730548934', '2024-11-02 05:02:14', 21, 15500.00, 'cash', 0),
(63, 'STRUK_1730599626', '2024-11-02 19:07:06', 21, 16000.00, 'credits', 1),
(65, 'STRUK_1731117399', '2024-11-08 18:56:39', 26, 21000.00, 'credits', 6),
(67, 'STRUK_1731117891', '2024-11-08 19:04:51', 26, 3000.00, 'credits', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(128) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `nominal_pinjaman` decimal(15,2) NOT NULL,
  `tanggal_pinjaman` date NOT NULL,
  `angsuran` int(5) NOT NULL,
  `bunga` decimal(5,2) NOT NULL,
  `tagihan` decimal(12,2) NOT NULL,
  `status` enum('macet','lunas','belum lunas') NOT NULL,
  `bukti_disetujui` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `id_anggota`, `nominal_pinjaman`, `tanggal_pinjaman`, `angsuran`, `bunga`, `tagihan`, `status`, `bukti_disetujui`) VALUES
(9, 2, 6000000.00, '2024-07-25', 6, 1.00, 1060000.00, 'belum lunas', '1721904166_5435103d1b2a94dbe43e.docx'),
(10, 1, 12000000.00, '2024-07-25', 12, 1.00, 1120000.00, 'lunas', '1721904291_515ad574563952f07bd1.docx'),
(11, 4, 10000000.00, '2024-07-27', 10, 1.00, 1100000.00, 'belum lunas', '1722045434_ff04de68a321e36fd4ca.docx'),
(12, 3, 10000000.00, '2024-08-01', 20, 1.00, 600000.00, 'belum lunas', '1722479443_fdda7ece0bb45b4e8c12.docx'),
(13, 7, 6000000.00, '2024-08-19', 6, 1.00, 1060000.00, 'belum lunas', '1724038678_eb13c9e17d4f111b3b9a.docx'),
(14, 8, 5000000.00, '2024-10-29', 24, 1.00, 258333.33, 'belum lunas', '1730185813_3fb0f278c415cdd71250.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `potongan_kelompok`
--

CREATE TABLE `potongan_kelompok` (
  `id_potongan_kelompok` int(12) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `nominal` decimal(11,2) NOT NULL,
  `id_kelompok` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `potongan_kelompok`
--

INSERT INTO `potongan_kelompok` (`id_potongan_kelompok`, `deskripsi`, `nominal`, `id_kelompok`) VALUES
(1, 'Potongan Jalan', 150000.00, 1),
(3, 'Biaya Transport Buah', 50000.00, 1),
(5, 'Potongan kurban', 100000.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_tabungan`
--

CREATE TABLE `riwayat_tabungan` (
  `id_riwayat_tabungan` int(11) NOT NULL,
  `id_tabungan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `jenis_transaksi` enum('deposit','penarikan','potongan') NOT NULL,
  `jumlah` decimal(11,2) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_tabungan`
--

INSERT INTO `riwayat_tabungan` (`id_riwayat_tabungan`, `id_tabungan`, `id_anggota`, `jenis_transaksi`, `jumlah`, `tanggal`, `deskripsi`) VALUES
(1, 1, 1, 'deposit', 120000.00, '2024-07-18', 'Coba nampil data'),
(2, 1, 1, 'deposit', 100000.00, '2024-07-18', NULL),
(3, 2, 2, 'deposit', 200000.00, '2024-07-18', NULL),
(4, 1, 1, 'deposit', 200000.00, '2024-07-18', NULL),
(5, 2, 2, 'deposit', 200000.00, '2024-07-18', NULL),
(6, 2, 2, 'deposit', 110000.00, '2024-07-18', NULL),
(7, 2, 2, 'deposit', 200000.00, '2024-07-18', NULL),
(8, 1, 1, 'deposit', 2300000.00, '2024-07-18', 'Gajian'),
(9, 1, 1, 'penarikan', 720000.00, '2024-07-19', 'Test Penarikan'),
(10, 3, 6, 'deposit', 500000.00, '2024-07-25', 'Initial deposit'),
(11, 1, 1, 'deposit', 5000000.00, '2024-07-27', 'Gajian'),
(12, 1, 1, 'penarikan', 5000000.00, '2024-07-27', 'penarikan gaji'),
(14, 6, 8, 'deposit', 30000.00, '2024-10-29', 'Initial deposit'),
(15, 6, 8, 'deposit', 100000.00, '2024-10-29', 'Uji Bug'),
(16, 1, 1, 'penarikan', 500000.00, '2024-10-29', 'Uji Bug'),
(17, 1, 1, 'deposit', 1000000.00, '2024-10-29', 'Uji Bug'),
(18, 7, 7, 'deposit', 30000.00, '2024-11-04', 'Initial deposit');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(255) NOT NULL,
  `id_barang` int(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kuantitas` int(11) DEFAULT NULL,
  `harga_beli` decimal(10,2) DEFAULT NULL,
  `terjual` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `tanggal`, `kuantitas`, `harga_beli`, `terjual`) VALUES
(12, 2, '2024-07-29 02:13:41', 24, 3000.00, 24),
(13, 2, '2024-10-29 06:20:57', 24, 3000.00, 24),
(14, 7, '2024-10-29 06:29:25', 12, 1500.00, 12),
(15, 8, '2024-07-29 03:42:35', 30, 2500.00, 0),
(16, 8, '2024-07-29 03:42:49', 30, 2500.00, 0),
(17, 12, '2024-11-03 02:07:06', 24, 3500.00, 13),
(18, 11, '2024-11-09 01:56:39', 24, 5000.00, 21),
(19, 9, '2024-11-02 12:02:14', 12, 6500.00, 2),
(20, 13, '2024-11-09 02:04:51', 12, 2500.00, 7),
(21, 2, '2024-11-02 12:02:14', 24, 3000.00, 5),
(22, 10, '2024-10-29 06:20:57', 12, 4500.00, 11),
(23, 7, '2024-10-29 06:29:25', 24, 1500.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id_tabungan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `saldo` decimal(15,2) DEFAULT NULL,
  `tanggal_buka` date NOT NULL,
  `tanggal_tutup` date DEFAULT NULL,
  `status` enum('aktif','tidak aktif','ditutup','') NOT NULL,
  `jenis_tabungan` enum('tabungan kapling','tabungan umum','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id_tabungan`, `id_anggota`, `saldo`, `tanggal_buka`, `tanggal_tutup`, `status`, `jenis_tabungan`) VALUES
(1, 1, 2500000.00, '2024-07-17', NULL, 'aktif', 'tabungan kapling'),
(2, 2, 710000.00, '2024-07-17', NULL, 'aktif', 'tabungan umum'),
(3, 6, 500000.00, '0000-00-00', NULL, 'aktif', 'tabungan kapling'),
(6, 8, 130000.00, '0000-00-00', NULL, 'aktif', 'tabungan umum'),
(7, 7, 30000.00, '0000-00-00', NULL, 'aktif', 'tabungan umum');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `surename` varchar(50) NOT NULL,
  `roles` enum('admin','kasir','petani','ksp') NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `id_kelompok` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `surename`, `roles`, `created_at`, `id_kelompok`) VALUES
(21, 'reza_nurmahmudin', '$2y$10$jjNNqQaulK9hW9T5OfSD7uk3ARKwwKm0vRfNd.fHTGqqVzx4mft0G', 'Resa Nurmahmudin', 'admin', '2024-05-21', NULL),
(24, 'karyawanbaru1', '$2y$10$TNgDGoMhSDc98L66UROiLeNgx2soDoApNKjV5rrz.MonZEpZFn1WC', 'Muhmmad fatah', 'ksp', '2024-05-31', NULL),
(26, 'karyawanbaru2', '$2y$10$E12NVey71enyDm40VTAy7eXK6kbL.LSrHPhTj5LgCQPkLReBl96uu', 'Susilawati', 'kasir', '2024-08-12', NULL),
(27, 'dewiyuliyati', '$2y$10$HFSX6QdRExQOVvJuz5USWuwqMPw/Kb514Hv2pQvixZj5OcV/BmOKe', 'Dewi Yuliyati', 'kasir', '2024-08-20', NULL),
(28, 'mardigu', '$2y$10$FsfWL0ukjEUjSiU0i7HMfOYMzdfdWb4q7cNE/MYMx30Wlgac70L0a', 'Mardigu', 'petani', '2024-08-30', 1),
(29, 'kuntoro', '$2y$10$B75p5MDRaLQOdEwXhZd1seYNWGMhS8OCpFkBnsP.eKtd.kC.cGfWm', 'Kuntadi Sutoro', 'petani', '2024-09-09', NULL),
(30, 'rufuscaligula', '$2y$10$eJIK6/A3/D4kCjA22Wgs8.EKiPkhIO1dl/XlQAODuyBNbp9bS9lse', 'Rufus Caligula', 'ksp', '2024-10-29', NULL),
(33, 'saranuha', '$2y$10$DOtp8OwLf31T8M2RfQyJBecQ7edajJ27bjTK6NL/lEUqIx5d5pgAS', 'Khusnun Saranuha', 'petani', '2024-11-02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `barcode` (`barcode`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id_credits`);

--
-- Indexes for table `durasi_tempo`
--
ALTER TABLE `durasi_tempo`
  ADD PRIMARY KEY (`id_durasi_tempo`);

--
-- Indexes for table `gaji_anggota`
--
ALTER TABLE `gaji_anggota`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `harga_sawit`
--
ALTER TABLE `harga_sawit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tanggal_berlaku` (`tanggal_berlaku`);

--
-- Indexes for table `item_terjual`
--
ALTER TABLE `item_terjual`
  ADD PRIMARY KEY (`id_item_terjual`);

--
-- Indexes for table `kelompok_tani`
--
ALTER TABLE `kelompok_tani`
  ADD PRIMARY KEY (`id_kelompoktani`);

--
-- Indexes for table `nilai_pinjaman`
--
ALTER TABLE `nilai_pinjaman`
  ADD PRIMARY KEY (`id_nilai_pinjaman`);

--
-- Indexes for table `panen`
--
ALTER TABLE `panen`
  ADD PRIMARY KEY (`id_panen`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `potongan_kelompok`
--
ALTER TABLE `potongan_kelompok`
  ADD PRIMARY KEY (`id_potongan_kelompok`);

--
-- Indexes for table `riwayat_tabungan`
--
ALTER TABLE `riwayat_tabungan`
  ADD PRIMARY KEY (`id_riwayat_tabungan`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id_tabungan`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id_credits` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `durasi_tempo`
--
ALTER TABLE `durasi_tempo`
  MODIFY `id_durasi_tempo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gaji_anggota`
--
ALTER TABLE `gaji_anggota`
  MODIFY `id_gaji` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `harga_sawit`
--
ALTER TABLE `harga_sawit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `item_terjual`
--
ALTER TABLE `item_terjual`
  MODIFY `id_item_terjual` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `kelompok_tani`
--
ALTER TABLE `kelompok_tani`
  MODIFY `id_kelompoktani` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilai_pinjaman`
--
ALTER TABLE `nilai_pinjaman`
  MODIFY `id_nilai_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `panen`
--
ALTER TABLE `panen`
  MODIFY `id_panen` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `potongan_kelompok`
--
ALTER TABLE `potongan_kelompok`
  MODIFY `id_potongan_kelompok` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `riwayat_tabungan`
--
ALTER TABLE `riwayat_tabungan`
  MODIFY `id_riwayat_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Constraints for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD CONSTRAINT `tabungan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
