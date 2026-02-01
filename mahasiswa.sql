-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2026 at 05:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mahasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_mahasiswa` int(10) UNSIGNED NOT NULL,
  `id_matakuliah` int(10) UNSIGNED NOT NULL,
  `id_dosen` int(10) UNSIGNED NOT NULL,
  `tahun_akademik` varchar(20) DEFAULT '2025/2026',
  `semester` varchar(5) DEFAULT '7',
  `tgl_absen` date NOT NULL,
  `pertemuan_ke` tinyint(4) NOT NULL,
  `status` enum('H','I','S','A') NOT NULL COMMENT 'H=Hadir, I=Izin, S=Sakit, A=Alpa',
  `keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `id_mahasiswa`, `id_matakuliah`, `id_dosen`, `tahun_akademik`, `semester`, `tgl_absen`, `pertemuan_ke`, `status`, `keterangan`, `created_at`) VALUES
(1, 1, 1, 4, '2025/2026', '7', '2026-02-01', 1, 'H', 'hadir', '2026-02-01 21:18:33'),
(2, 1, 1, 1, '2025/2026', '7', '2025-01-15', 1, 'H', NULL, '2026-02-01 21:24:49'),
(3, 1, 1, 1, '2025/2026', '7', '2025-01-22', 2, 'H', NULL, '2026-02-01 21:24:49'),
(4, 1, 1, 1, '2025/2026', '7', '2025-01-29', 3, 'I', 'Izin keluarga', '2026-02-01 21:24:49'),
(5, 1, 1, 1, '2025/2026', '7', '2025-02-05', 4, 'H', NULL, '2026-02-01 21:24:49'),
(6, 1, 1, 1, '2025/2026', '7', '2025-02-12', 5, 'S', 'Sakit demam', '2026-02-01 21:24:49'),
(7, 1, 1, 1, '2025/2026', '7', '2025-02-19', 6, 'H', NULL, '2026-02-01 21:24:49'),
(8, 1, 1, 1, '2025/2026', '7', '2025-02-26', 7, 'H', NULL, '2026-02-01 21:24:49'),
(9, 1, 1, 1, '2025/2026', '7', '2025-03-05', 8, 'A', NULL, '2026-02-01 21:24:49'),
(10, 1, 1, 1, '2025/2026', '7', '2025-03-12', 9, 'H', NULL, '2026-02-01 21:24:49'),
(11, 1, 1, 1, '2025/2026', '7', '2025-03-19', 10, 'H', NULL, '2026-02-01 21:24:49'),
(12, 2, 1, 1, '2025/2026', '7', '2025-01-15', 1, 'H', NULL, '2026-02-01 21:24:49'),
(13, 2, 1, 1, '2025/2026', '7', '2025-01-22', 2, 'H', NULL, '2026-02-01 21:24:49'),
(14, 2, 1, 1, '2025/2026', '7', '2025-01-29', 3, 'H', NULL, '2026-02-01 21:24:49'),
(15, 2, 1, 1, '2025/2026', '7', '2025-02-05', 4, 'H', NULL, '2026-02-01 21:24:49'),
(16, 2, 1, 1, '2025/2026', '7', '2025-02-12', 5, 'H', NULL, '2026-02-01 21:24:49'),
(17, 2, 1, 1, '2025/2026', '7', '2025-02-19', 6, 'I', 'Izin keperluan', '2026-02-01 21:24:49'),
(18, 2, 1, 1, '2025/2026', '7', '2025-02-26', 7, 'H', NULL, '2026-02-01 21:24:49'),
(19, 2, 1, 1, '2025/2026', '7', '2025-03-05', 8, 'H', NULL, '2026-02-01 21:24:49'),
(20, 2, 1, 1, '2025/2026', '7', '2025-03-12', 9, 'S', 'Sakit flu', '2026-02-01 21:24:49'),
(21, 2, 1, 1, '2025/2026', '7', '2025-03-19', 10, 'H', NULL, '2026-02-01 21:24:49'),
(22, 3, 2, 2, '2025/2026', '7', '2025-01-16', 1, 'H', NULL, '2026-02-01 21:24:49'),
(23, 3, 2, 2, '2025/2026', '7', '2025-01-23', 2, 'H', NULL, '2026-02-01 21:24:49'),
(24, 3, 2, 2, '2025/2026', '7', '2025-01-30', 3, 'A', NULL, '2026-02-01 21:24:49'),
(25, 3, 2, 2, '2025/2026', '7', '2025-02-06', 4, 'H', NULL, '2026-02-01 21:24:49'),
(26, 3, 2, 2, '2025/2026', '7', '2025-02-13', 5, 'H', NULL, '2026-02-01 21:24:49'),
(27, 3, 2, 2, '2025/2026', '7', '2025-02-20', 6, 'H', NULL, '2026-02-01 21:24:49'),
(28, 3, 2, 2, '2025/2026', '7', '2025-02-27', 7, 'I', 'Izin acara', '2026-02-01 21:24:49'),
(29, 3, 2, 2, '2025/2026', '7', '2025-03-06', 8, 'H', NULL, '2026-02-01 21:24:49'),
(30, 3, 2, 2, '2025/2026', '7', '2025-03-13', 9, 'H', NULL, '2026-02-01 21:24:49'),
(31, 3, 2, 2, '2025/2026', '7', '2025-03-20', 10, 'A', NULL, '2026-02-01 21:24:49'),
(32, 4, 2, 2, '2025/2026', '7', '2025-01-16', 1, 'H', NULL, '2026-02-01 21:24:49'),
(33, 4, 2, 2, '2025/2026', '7', '2025-01-23', 2, 'S', 'Sakit kepala', '2026-02-01 21:24:49'),
(34, 4, 2, 2, '2025/2026', '7', '2025-01-30', 3, 'H', NULL, '2026-02-01 21:24:49'),
(35, 4, 2, 2, '2025/2026', '7', '2025-02-06', 4, 'H', NULL, '2026-02-01 21:24:49'),
(36, 4, 2, 2, '2025/2026', '7', '2025-02-13', 5, 'H', NULL, '2026-02-01 21:24:49'),
(37, 4, 2, 2, '2025/2026', '7', '2025-02-20', 6, 'I', 'Izin keluarga', '2026-02-01 21:24:49'),
(38, 4, 2, 2, '2025/2026', '7', '2025-02-27', 7, 'H', NULL, '2026-02-01 21:24:49'),
(39, 4, 2, 2, '2025/2026', '7', '2025-03-06', 8, 'H', NULL, '2026-02-01 21:24:49'),
(40, 4, 2, 2, '2025/2026', '7', '2025-03-13', 9, 'H', NULL, '2026-02-01 21:24:49'),
(41, 4, 2, 2, '2025/2026', '7', '2025-03-20', 10, 'H', NULL, '2026-02-01 21:24:49'),
(42, 5, 3, 3, '2025/2026', '7', '2025-01-17', 1, 'H', NULL, '2026-02-01 21:24:49'),
(43, 5, 3, 3, '2025/2026', '7', '2025-01-24', 2, 'H', NULL, '2026-02-01 21:24:49'),
(44, 5, 3, 3, '2025/2026', '7', '2025-01-31', 3, 'H', NULL, '2026-02-01 21:24:49'),
(45, 5, 3, 3, '2025/2026', '7', '2025-02-07', 4, 'A', NULL, '2026-02-01 21:24:49'),
(46, 5, 3, 3, '2025/2026', '7', '2025-02-14', 5, 'H', NULL, '2026-02-01 21:24:49'),
(47, 5, 3, 3, '2025/2026', '7', '2025-02-21', 6, 'H', NULL, '2026-02-01 21:24:49'),
(48, 5, 3, 3, '2025/2026', '7', '2025-02-28', 7, 'S', 'Sakit perut', '2026-02-01 21:24:49'),
(49, 5, 3, 3, '2025/2026', '7', '2025-03-07', 8, 'H', NULL, '2026-02-01 21:24:49'),
(50, 5, 3, 3, '2025/2026', '7', '2025-03-14', 9, 'I', 'Izin urusan', '2026-02-01 21:24:49'),
(51, 5, 3, 3, '2025/2026', '7', '2025-03-21', 10, 'H', NULL, '2026-02-01 21:24:49'),
(52, 6, 3, 3, '2025/2026', '7', '2025-01-17', 1, 'H', NULL, '2026-02-01 21:24:49'),
(53, 6, 3, 3, '2025/2026', '7', '2025-01-24', 2, 'H', NULL, '2026-02-01 21:24:49'),
(54, 6, 3, 3, '2025/2026', '7', '2025-01-31', 3, 'H', NULL, '2026-02-01 21:24:49'),
(55, 6, 3, 3, '2025/2026', '7', '2025-02-07', 4, 'H', NULL, '2026-02-01 21:24:49'),
(56, 6, 3, 3, '2025/2026', '7', '2025-02-14', 5, 'H', NULL, '2026-02-01 21:24:49'),
(57, 6, 3, 3, '2025/2026', '7', '2025-02-21', 6, 'H', NULL, '2026-02-01 21:24:49'),
(58, 6, 3, 3, '2025/2026', '7', '2025-02-28', 7, 'H', NULL, '2026-02-01 21:24:49'),
(59, 6, 3, 3, '2025/2026', '7', '2025-03-07', 8, 'A', NULL, '2026-02-01 21:24:49'),
(60, 6, 3, 3, '2025/2026', '7', '2025-03-14', 9, 'H', NULL, '2026-02-01 21:24:49'),
(61, 6, 3, 3, '2025/2026', '7', '2025-03-21', 10, 'H', NULL, '2026-02-01 21:24:49'),
(62, 7, 4, 4, '2025/2026', '7', '2025-01-18', 1, 'H', NULL, '2026-02-01 21:24:49'),
(63, 7, 4, 4, '2025/2026', '7', '2025-01-25', 2, 'I', 'Izin acara', '2026-02-01 21:24:49'),
(64, 7, 4, 4, '2025/2026', '7', '2025-02-01', 3, 'H', NULL, '2026-02-01 21:24:49'),
(65, 7, 4, 4, '2025/2026', '7', '2025-02-08', 4, 'H', NULL, '2026-02-01 21:24:49'),
(66, 7, 4, 4, '2025/2026', '7', '2025-02-15', 5, 'S', 'Sakit demam', '2026-02-01 21:24:49'),
(67, 7, 4, 4, '2025/2026', '7', '2025-02-22', 6, 'H', NULL, '2026-02-01 21:24:49'),
(68, 7, 4, 4, '2025/2026', '7', '2025-03-01', 7, 'H', NULL, '2026-02-01 21:24:49'),
(69, 7, 4, 4, '2025/2026', '7', '2025-03-08', 8, 'H', NULL, '2026-02-01 21:24:49'),
(70, 7, 4, 4, '2025/2026', '7', '2025-03-15', 9, 'H', NULL, '2026-02-01 21:24:49'),
(71, 7, 4, 4, '2025/2026', '7', '2025-03-22', 10, 'A', NULL, '2026-02-01 21:24:49'),
(72, 8, 4, 4, '2025/2026', '7', '2025-01-18', 1, 'H', NULL, '2026-02-01 21:24:49'),
(73, 8, 4, 4, '2025/2026', '7', '2025-01-25', 2, 'H', NULL, '2026-02-01 21:24:49'),
(74, 8, 4, 4, '2025/2026', '7', '2025-02-01', 3, 'H', NULL, '2026-02-01 21:24:49'),
(75, 8, 4, 4, '2025/2026', '7', '2025-02-08', 4, 'I', 'Izin keluarga', '2026-02-01 21:24:49'),
(76, 8, 4, 4, '2025/2026', '7', '2025-02-15', 5, 'H', NULL, '2026-02-01 21:24:49'),
(77, 8, 4, 4, '2025/2026', '7', '2025-02-22', 6, 'H', NULL, '2026-02-01 21:24:49'),
(78, 8, 4, 4, '2025/2026', '7', '2025-03-01', 7, 'H', NULL, '2026-02-01 21:24:49'),
(79, 8, 4, 4, '2025/2026', '7', '2025-03-08', 8, 'S', 'Sakit batuk', '2026-02-01 21:24:49'),
(80, 8, 4, 4, '2025/2026', '7', '2025-03-15', 9, 'H', NULL, '2026-02-01 21:24:49'),
(81, 8, 4, 4, '2025/2026', '7', '2025-03-22', 10, 'H', NULL, '2026-02-01 21:24:49'),
(82, 9, 5, 5, '2025/2026', '7', '2025-01-19', 1, 'H', NULL, '2026-02-01 21:24:49'),
(83, 9, 5, 5, '2025/2026', '7', '2025-01-26', 2, 'H', NULL, '2026-02-01 21:24:49'),
(84, 9, 5, 5, '2025/2026', '7', '2025-02-02', 3, 'A', NULL, '2026-02-01 21:24:49'),
(85, 9, 5, 5, '2025/2026', '7', '2025-02-09', 4, 'H', NULL, '2026-02-01 21:24:49'),
(86, 9, 5, 5, '2025/2026', '7', '2025-02-16', 5, 'H', NULL, '2026-02-01 21:24:49'),
(87, 9, 5, 5, '2025/2026', '7', '2025-02-23', 6, 'H', NULL, '2026-02-01 21:24:49'),
(88, 9, 5, 5, '2025/2026', '7', '2025-03-02', 7, 'I', 'Izin keperluan', '2026-02-01 21:24:49'),
(89, 9, 5, 5, '2025/2026', '7', '2025-03-09', 8, 'H', NULL, '2026-02-01 21:24:49'),
(90, 9, 5, 5, '2025/2026', '7', '2025-03-16', 9, 'H', NULL, '2026-02-01 21:24:49'),
(91, 9, 5, 5, '2025/2026', '7', '2025-03-23', 10, 'S', 'Sakit kepala', '2026-02-01 21:24:49'),
(92, 10, 5, 5, '2025/2026', '7', '2025-01-19', 1, 'H', NULL, '2026-02-01 21:24:49'),
(93, 10, 5, 5, '2025/2026', '7', '2025-01-26', 2, 'H', NULL, '2026-02-01 21:24:49'),
(94, 10, 5, 5, '2025/2026', '7', '2025-02-02', 3, 'H', NULL, '2026-02-01 21:24:49'),
(95, 10, 5, 5, '2025/2026', '7', '2025-02-09', 4, 'H', NULL, '2026-02-01 21:24:49'),
(96, 10, 5, 5, '2025/2026', '7', '2025-02-16', 5, 'H', NULL, '2026-02-01 21:24:49'),
(97, 10, 5, 5, '2025/2026', '7', '2025-02-23', 6, 'A', NULL, '2026-02-01 21:24:49'),
(98, 10, 5, 5, '2025/2026', '7', '2025-03-02', 7, 'H', NULL, '2026-02-01 21:24:49'),
(99, 10, 5, 5, '2025/2026', '7', '2025-03-09', 8, 'H', NULL, '2026-02-01 21:24:49'),
(100, 10, 5, 5, '2025/2026', '7', '2025-03-16', 9, 'I', 'Izin acara', '2026-02-01 21:24:49'),
(101, 10, 5, 5, '2025/2026', '7', '2025-03-23', 10, 'H', NULL, '2026-02-01 21:24:49');

-- --------------------------------------------------------

--
-- Table structure for table `data_dosen`
--

CREATE TABLE `data_dosen` (
  `id` int(11) UNSIGNED NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `spesialisasi` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_dosen`
--

INSERT INTO `data_dosen` (`id`, `nidn`, `nama_dosen`, `email`, `spesialisasi`, `created_at`, `updated_at`) VALUES
(1, '0011028501', 'Dr. Aris Sudarman, M.Kom', 'aris.sudarman@univ.ac.id', 'Kecerdasan Buatan', '2026-01-24 20:52:09', '2026-01-24 20:52:09'),
(2, '0022038802', 'Siti Aminah, M.T', 'siti.aminah@univ.ac.id', 'Jaringan Komputer', '2026-01-24 20:52:09', '2026-01-24 20:52:09'),
(3, '0015058203', 'Budi Hermawan, Ph.D', 'budi.hermawan@univ.ac.id', 'Data Science', '2026-01-24 20:52:09', '2026-01-24 20:52:09'),
(4, '0010099004', 'Lestari Putri, M.Cs', 'lestari.putri@univ.ac.id', 'Sistem Informasi', '2026-01-24 20:52:09', '2026-01-24 20:52:09'),
(5, '0005018705', 'Hendra Wijaya, M.Kom', 'hendra.wijaya@univ.ac.id', 'Cyber Security', '2026-01-24 20:52:09', '2026-01-24 20:52:09'),
(6, '0028128406', 'Rina Permata, M.T', 'rina.permata@univ.ac.id', 'Rekayasa Perangkat Lunak', '2026-01-24 20:52:09', '2026-01-24 20:52:09'),
(7, '0019078907', 'Andi Pratama, M.Kom', 'andi.pratama@univ.ac.id', 'Cloud Computing', '2026-01-24 20:52:09', '2026-01-24 20:52:09'),
(8, '0003048308', 'Dewi Sartika, M.Sc', 'dewi.sartika@univ.ac.id', 'Mobile Development', '2026-01-24 20:52:09', '2026-01-24 20:52:09'),
(9, '0021068609', 'Taufik Hidayat, M.T', 'taufik.hidayat@univ.ac.id', 'Internet of Things', '2026-01-24 20:52:09', '2026-01-24 20:52:09'),
(10, '0014088510', 'Eka Rahmawati, M.Kom', 'eka.rahmawati@univ.ac.id', 'Human Computer Interaction', '2026-01-24 20:52:09', '2026-01-24 20:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `data_mahasiswa`
--

CREATE TABLE `data_mahasiswa` (
  `id` int(11) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_mahasiswa`
--

INSERT INTO `data_mahasiswa` (`id`, `nim`, `nama`, `jurusan`, `email`, `created_at`, `updated_at`) VALUES
(1, '12345678', 'Meylinda ', 'Teknik Informatika', 'VARskin9@gmail.com', '2026-01-24 13:38:54', '2026-01-24 13:38:54'),
(2, '202501001', 'Ahmad Fauzi', 'Teknik Informatika', 'ahmad.fauzi@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46'),
(3, '202501002', 'Bunga Citra Lestari', 'Sistem Informasi', 'bunga.citra@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46'),
(4, '202501003', 'Chandra Wijaya', 'Teknik Informatika', 'chandra.w@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46'),
(5, '202502001', 'Dian Sastro', 'Manajemen Informatika', 'dian.sastro@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46'),
(6, '202501004', 'Eko Prasetyo', 'Teknik Informatika', 'eko.p@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46'),
(7, '202503001', 'Fanya Maharani', 'Sains Data', 'fanya.m@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46'),
(8, '202501005', 'Gilang Dirga', 'Teknik Informatika', 'gilang.d@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46'),
(9, '202502002', 'Hani Syahputri', 'Sistem Informasi', 'hani.s@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46'),
(10, '202501006', 'Indra Bruggman', 'Teknik Informatika', 'indra.b@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46'),
(11, '202503002', 'Joko Anwar', 'Sains Data', 'joko.anwar@student.univ.ac.id', '2026-01-24 20:52:46', '2026-01-24 20:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `data_matakuliah`
--

CREATE TABLE `data_matakuliah` (
  `id` int(11) UNSIGNED NOT NULL,
  `kode_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `sks` int(2) NOT NULL,
  `id_dosen` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_matakuliah`
--

INSERT INTO `data_matakuliah` (`id`, `kode_mk`, `nama_mk`, `sks`, `id_dosen`, `created_at`, `updated_at`) VALUES
(1, 'MK001', 'Algoritma dan Pemrograman', 3, 1, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(2, 'MK002', 'Struktur Data', 3, 1, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(3, 'MK003', 'Basis Data Terdistribusi', 3, 2, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(4, 'MK004', 'Pemrograman Web 1', 2, 2, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(5, 'MK005', 'Pemrograman Web 2', 3, 2, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(6, 'MK006', 'Jaringan Komputer', 3, 3, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(7, 'MK007', 'Keamanan Informasi', 2, 3, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(8, 'MK008', 'Sistem Operasi', 3, 1, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(9, 'MK009', 'Arsitektur Komputer', 2, 1, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(10, 'MK010', 'Kecerdasan Buatan', 3, 4, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(11, 'MK011', 'Machine Learning', 3, 4, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(12, 'MK012', 'Pemrograman Mobile', 3, 2, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(13, 'MK013', 'Interaksi Manusia dan Komputer', 2, 5, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(14, 'MK014', 'Rekayasa Perangkat Lunak', 3, 5, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(15, 'MK015', 'Analisis dan Desain Sistem', 3, 5, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(16, 'MK016', 'Etika Profesi IT', 2, 3, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(17, 'MK017', 'Bahasa Inggris Teknik', 2, 4, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(18, 'MK018', 'Matematika Diskrit', 3, 1, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(19, 'MK019', 'Statistika dan Probabilitas', 3, 1, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(20, 'MK020', 'Kalkulus Informatika', 3, 1, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(21, 'MK021', 'Grafika Komputer', 3, 4, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(22, 'MK022', 'Pengolahan Citra Digital', 3, 4, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(23, 'MK023', 'Cloud Computing', 3, 2, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(24, 'MK024', 'Internet of Things (IoT)', 3, 3, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(25, 'MK025', 'Sistem Pendukung Keputusan', 3, 5, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(26, 'MK026', 'Manajemen Proyek TI', 2, 5, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(27, 'MK027', 'E-Commerce', 2, 2, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(28, 'MK028', 'Data Mining', 3, 4, '2026-01-27 21:44:24', '2026-01-27 21:44:24'),
(29, 'MK029', 'Teori Bahasa dan Automata', 3, 1, '2026-01-27 21:44:24', '2026-01-27 21:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_mahasiswa` int(11) UNSIGNED NOT NULL,
  `id_matakuliah` int(11) UNSIGNED NOT NULL,
  `tahun_akademik` varchar(20) DEFAULT '2025/2026',
  `semester` varchar(5) DEFAULT '7',
  `created_at` datetime DEFAULT current_timestamp(),
  `nilai_angka` int(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id`, `id_mahasiswa`, `id_matakuliah`, `tahun_akademik`, `semester`, `created_at`, `nilai_angka`) VALUES
(24, 10, 14, '2025/2027', '5', '2026-01-28 22:14:36', 0),
(28, 10, 11, '2025/2027', '5', '2026-01-28 22:33:10', 0),
(29, 10, 9, '2025/2027', '5', '2026-01-28 22:33:15', 0),
(30, 10, 11, '2025/2027', '5', '2026-01-28 22:33:19', 0),
(31, 5, 11, '2025/2027', '4', '2026-01-28 22:36:32', 0),
(32, 5, 18, '2025/2027', '4', '2026-01-28 22:36:32', 0),
(33, 5, 22, '2025/2027', '4', '2026-01-28 22:36:32', 0),
(34, 5, 1, '2025/2026', '1', '2026-01-28 22:37:02', 0),
(35, 5, 2, '2025/2026', '1', '2026-01-28 22:37:02', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_matakuliah` (`id_matakuliah`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `data_dosen`
--
ALTER TABLE `data_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_mahasiswa`
--
ALTER TABLE `data_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_matakuliah`
--
ALTER TABLE `data_matakuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `data_dosen`
--
ALTER TABLE `data_dosen`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_mahasiswa`
--
ALTER TABLE `data_mahasiswa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_matakuliah`
--
ALTER TABLE `data_matakuliah`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `data_mahasiswa` (`id`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`id_matakuliah`) REFERENCES `data_matakuliah` (`id`),
  ADD CONSTRAINT `absensi_ibfk_3` FOREIGN KEY (`id_dosen`) REFERENCES `data_dosen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
