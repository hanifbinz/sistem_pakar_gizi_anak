-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2026 at 04:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistempakargiziburuk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `id_admin`, `id_penyakit`, `nama_gejala`) VALUES
(1, 1, 1, 'bengkak seluruh tubu'),
(2, 1, 1, 'rambut terlihat tipis'),
(3, 1, 1, 'wajah membulat dan sembab'),
(4, 1, 1, 'pembesaran hati'),
(5, 1, 1, 'susah makan'),
(6, 1, 1, 'otot mengecil'),
(7, 1, 1, 'kelainan kulit'),
(8, 1, 1, 'anemia'),
(9, 1, 1, 'mata sayu'),
(10, 1, 1, 'cengeng dan mudah bawel'),
(11, 1, 2, 'usus tampak membulat'),
(12, 1, 2, 'sangat kurus dan wajah membulat'),
(13, 1, 2, 'perut mencekung dan otot mengecil'),
(14, 1, 2, 'kulit keriput terjadi kelainan kulit'),
(15, 1, 2, 'pengurangan lemak bawah kulit seperti marasmus'),
(16, 1, 3, 'rambut terlihat tipis dan mudah dicabut'),
(17, 1, 3, 'susah buang air besar'),
(18, 1, 3, 'mudah terjangkit penyakit'),
(19, 1, 3, 'bentuk fisik beruah'),
(20, 1, 3, 'sangat kurus'),
(21, 1, 3, 'wajah seperti orang tua'),
(22, 1, 3, 'perut cekung'),
(23, 1, 3, 'kulit kering'),
(24, 1, 3, 'cengeng dan mudah bawel'),
(25, 1, 3, 'bagian daerah pantat tampak seperti memakai celana longgar'),
(26, 1, 3, 'berat badan hanya sekitar 60% dari seharusnya'),
(27, 1, 3, 'otot mengecil'),
(28, 1, 2, 'nnnnnn');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `namapasien` varchar(100) NOT NULL,
  `jeniskelamin` varchar(50) NOT NULL,
  `hasildiagnosa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_penyakit`, `namapasien`, `jeniskelamin`, `hasildiagnosa`) VALUES
(20, 1, 'JOY ', 'Laki-Laki', 'Kwarshiorkor'),
(22, 1, 'JOY', 'Laki-Laki', 'Kwarshiorkor');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_penyakit`, `nilai`) VALUES
(3563, 1, 0.36),
(3564, 1, 0.36),
(3565, 1, 0.36),
(3566, 1, 0.36),
(3567, 1, 0.36),
(3568, 1, 0.36),
(3569, 1, 0.32),
(3570, 1, 0.32),
(3571, 1, 0.32),
(3572, 1, 0.32),
(3573, 1, 0.32),
(3574, 1, 0.32),
(3575, 2, 0.32),
(3576, 2, 0.32),
(3577, 2, 0.32),
(3578, 2, 0.32),
(3579, 2, 0.32),
(3580, 2, 0.32),
(3581, 2, 0.36),
(3582, 2, 0.32),
(3583, 2, 0.32),
(3584, 2, 0.32),
(3585, 2, 0.32),
(3586, 2, 0.32),
(3587, 3, 0.32),
(3588, 3, 0.32),
(3589, 3, 0.32),
(3590, 3, 0.32),
(3591, 3, 0.32),
(3592, 3, 0.32),
(3593, 3, 0.32),
(3594, 3, 0.36),
(3595, 3, 0.36),
(3596, 3, 0.36),
(3597, 3, 0.36),
(3598, 3, 0.36);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_akhir`
--

CREATE TABLE `nilai_akhir` (
  `id_nilaiakhir` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `nilai_akhir` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_akhir`
--

INSERT INTO `nilai_akhir` (`id_nilaiakhir`, `id_penyakit`, `nilai_akhir`) VALUES
(343, 1, 0.0000007791),
(344, 2, 0.000000432345),
(345, 3, 0.000000692533);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `usernameuser` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `usia` varchar(10) NOT NULL,
  `password_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `id_admin`, `nama_pasien`, `usernameuser`, `jk`, `usia`, `password_user`) VALUES
(1, 1, 'budi', 'budi', 'Laki-Laki', '5 Tahun', '123');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `nama_penyakit` varchar(30) NOT NULL,
  `solusi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `id_pasien`, `nama_penyakit`, `solusi`) VALUES
(1, 1, 'Kwarshiorkor', 'tesing'),
(2, 1, 'Marasmik-Kwarshiorkor', 'testing2'),
(3, 1, 'Marasmus', 'Testing 3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD PRIMARY KEY (`id_nilaiakhir`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3599;

--
-- AUTO_INCREMENT for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  MODIFY `id_nilaiakhir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gejala`
--
ALTER TABLE `gejala`
  ADD CONSTRAINT `gejala_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`),
  ADD CONSTRAINT `gejala_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD CONSTRAINT `nilai_akhir_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
