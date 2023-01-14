-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2023 at 02:31 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id`, `foto`, `nama`, `jumlah`) VALUES
(15, 'Mouse Logitech Trackball vintage.jpg', 'Mouse Logitech Trackball', 6),
(17, 'qwer.jpg', 'qwer', 23),
(18, 'keybord.jpg', 'keybord', 6),
(19, 'hp.jpg', 'hp', 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_pinjam`
--

CREATE TABLE `tbl_detail_pinjam` (
  `id` int(11) NOT NULL,
  `pinjam_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kondisi` enum('baik','rusak') NOT NULL,
  `guna_keperluan` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_detail_pinjam`
--

INSERT INTO `tbl_detail_pinjam` (`id`, `pinjam_id`, `barang_id`, `jumlah`, `kondisi`, `guna_keperluan`, `keterangan`) VALUES
(30, 11, 15, 4, 'baik', '2121', 'dsfdsdf');

--
-- Triggers `tbl_detail_pinjam`
--
DELIMITER $$
CREATE TRIGGER `hapus_barang` AFTER DELETE ON `tbl_detail_pinjam` FOR EACH ROW BEGIN
	UPDATE tbl_barang SET jumlah = jumlah + OLD.jumlah
    WHERE id = OLD.barang_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangi_barang` AFTER INSERT ON `tbl_detail_pinjam` FOR EACH ROW BEGIN
	UPDATE tbl_barang SET jumlah = jumlah - NEW.jumlah
    WHERE id = NEW.barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `wali_kelas` varchar(255) NOT NULL,
  `nip` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id`, `nama`, `wali_kelas`, `nip`) VALUES
(4, 'XI TKJ', 'Agit', 9876),
(11, 'X TKJ', 'Juan', 12345678),
(12, 'XII TKJ', 'awan', 19795172006042029),
(13, 'thdfhdf', 'dfghdfg', 4342345),
(14, 'X PH', 'Pa Apri', 234567890),
(15, 'LAB', 'jua ', 3456789);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `status` enum('pinjam','kembali') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id`, `tgl_pinjam`, `tgl_kembali`, `kelas_id`, `siswa_id`, `status`) VALUES
(10, '2022-09-21', '2022-09-22', 11, 22, 'pinjam'),
(11, '2022-09-22', '2022-09-23', 13, 24, 'pinjam'),
(12, '2022-09-22', '2022-09-23', 11, 22, 'kembali');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nis` int(11) NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id`, `nama`, `nis`, `no_telpon`, `kelas_id`, `alamat`) VALUES
(22, 'Juan Agit Kurniawan', 98765432, '234567890', 11, 'wertyuiop['),
(25, 'agit awan', 2345, '123456', 14, 'wertyuiojgfjhg'),
(26, 'juan', 456789, '4567890', 15, 'wertyuio');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`) VALUES
(1, 'juan', '1a1dc91c907325c69271ddf0c944bc72'),
(2, 'agit', '1a1dc91c907325c69271ddf0c944bc72'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_detail_pinjam`
--
ALTER TABLE `tbl_detail_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_detail_pinjam`
--
ALTER TABLE `tbl_detail_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
