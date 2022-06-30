-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2022 at 08:31 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_saw_rekrutmen`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

DROP TABLE IF EXISTS `bobot_kriteria`;
CREATE TABLE IF NOT EXISTS `bobot_kriteria` (
  `id_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` text,
  `bobot` int(1) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  PRIMARY KEY (`id_bobot`),
  KEY `id_kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `keterangan`, `bobot`, `id_kriteria`) VALUES
(5, 'SMA', 3, 1),
(6, 'S1 ', 5, 1),
(7, 'IPA & IPS', 3, 2),
(8, 'S1 Psikologi', 4, 2),
(9, 'S1 PAUD ', 5, 2),
(10, '21 - 24', 5, 3),
(11, '25 - 27', 4, 3),
(12, 'Kawin', 4, 4),
(13, 'Belum Kawin', 5, 4),
(14, 'Sangat Rendah ', 1, 5),
(15, 'Rendah', 2, 5),
(16, 'Cukup', 3, 5),
(17, 'Tinggi', 4, 5),
(18, 'Sangat Tinggi', 5, 5),
(19, '28 - 30', 3, 3),
(20, '> 30', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `calon_guru`
--

DROP TABLE IF EXISTS `calon_guru`;
CREATE TABLE IF NOT EXISTS `calon_guru` (
  `email` varchar(50) NOT NULL,
  `id_calonguru` int(11) NOT NULL AUTO_INCREMENT,
  `kd_rekrutmen` varchar(20) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `tgl_wawancara` datetime DEFAULT NULL,
  `ktp` text NOT NULL,
  `ijazah_terakhir` text NOT NULL,
  `cv` text NOT NULL,
  `surat_lamaran` text NOT NULL,
  `berkas_lainnya` text NOT NULL,
  `nama_suratlamaran` text,
  `nama_cv` text,
  `nama_ijazah` text,
  `nama_ktp` text,
  `nama_berkas_lainnya` text,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_calonguru`),
  KEY `email` (`email`),
  KEY `kd_rekrutmen` (`kd_rekrutmen`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calon_guru`
--

INSERT INTO `calon_guru` (`email`, `id_calonguru`, `kd_rekrutmen`, `tgl_daftar`, `tgl_wawancara`, `ktp`, `ijazah_terakhir`, `cv`, `surat_lamaran`, `berkas_lainnya`, `nama_suratlamaran`, `nama_cv`, `nama_ijazah`, `nama_ktp`, `nama_berkas_lainnya`, `status`) VALUES
('a1@gmail.com', 1, '17032022-40457', '0000-00-00 00:00:00', NULL, 'berkas/1_17032022-40457/ktp.jpg', 'berkas/1_17032022-40457/ijazah_terakhir.pdf', 'berkas/1_17032022-40457/cv.pdf', 'berkas/1_17032022-40457/surat_lamaran.pdf', '', 'surat_lamaran.pdf', 'cv.pdf', 'ijazah_terakhir.pdf', 'ktp.jpg', NULL, 1),
('a2@gmail.com', 2, '17032022-40457', '0000-00-00 00:00:00', NULL, 'berkas/2_17032022-40457/ktp.jpg', 'berkas/2_17032022-40457/ijazah_terakhir.pdf', 'berkas/2_17032022-40457/cv.pdf', 'berkas/2_17032022-40457/surat_lamaran.pdf', 'berkas/2_17032022-40457/lainnya.pdf', 'surat_lamaran.pdf', 'cv.pdf', 'ijazah_terakhir.pdf', 'ktp.jpg', 'lainnya.pdf', 1),
('a3@gmail.com', 3, '17032022-40457', '0000-00-00 00:00:00', NULL, 'berkas/3_17032022-40457/ktp.jpg', 'berkas/3_17032022-40457/ijazah_terakhir.pdf', 'berkas/3_17032022-40457/cv.pdf', 'berkas/3_17032022-40457/surat_lamaran.pdf', '', 'surat_lamaran.pdf', 'cv.pdf', 'ijazah_terakhir.pdf', 'ktp.jpg', NULL, 1),
('a4@gmail.com', 4, '17032022-40457', '0000-00-00 00:00:00', NULL, 'berkas/4_17032022-40457/ktp.jpg', 'berkas/4_17032022-40457/ijazah_terakhir.pdf', 'berkas/4_17032022-40457/cv.pdf', 'berkas/4_17032022-40457/surat_lamaran.pdf', '', 'surat_lamaran.pdf', 'cv.pdf', 'ijazah_terakhir.pdf', 'ktp.jpg', NULL, 1),
('a5@gmail.com', 5, '17032022-40457', '0000-00-00 00:00:00', NULL, 'berkas/5_17032022-40457/ktp.jpg', 'berkas/5_17032022-40457/ijazah_terakhir.pdf', 'berkas/5_17032022-40457/cv.pdf', 'berkas/5_17032022-40457/surat_lamaran.pdf', '', 'surat_lamaran.pdf', 'cv.pdf', 'ijazah_terakhir.pdf', 'ktp.jpg', NULL, 1),
('a6@gmail.com', 6, '17032022-40457', '0000-00-00 00:00:00', NULL, 'berkas/6_17032022-40457/ktp.jpg', 'berkas/6_17032022-40457/ijazah_terakhir.pdf', 'berkas/6_17032022-40457/cv.pdf', 'berkas/6_17032022-40457/surat_lamaran.pdf', '', 'surat_lamaran.pdf', 'cv.pdf', 'ijazah_terakhir.pdf', 'ktp.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_laporan`
--

DROP TABLE IF EXISTS `detail_laporan`;
CREATE TABLE IF NOT EXISTS `detail_laporan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_laporan` int(11) NOT NULL,
  `kriteria` text NOT NULL,
  `presentase` decimal(13,2) NOT NULL,
  `nilai` date NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_detail`),
  KEY `id_laporan` (`id_laporan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(100) NOT NULL,
  `tipe` varchar(40) NOT NULL,
  `bobot_vektor` decimal(5,2) NOT NULL,
  `penilai` enum('Operator','Kepala Sekolah') NOT NULL DEFAULT 'Operator',
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `tipe`, `bobot_vektor`, `penilai`) VALUES
(1, 'Jenjang Pendidikan', 'Benefit', '35.00', 'Operator'),
(2, 'Jurusan', 'Benefit', '15.00', 'Operator'),
(3, 'Usia', 'Benefit', '10.00', 'Operator'),
(4, 'Status', 'Benefit', '10.00', 'Operator'),
(5, 'Wawancara', 'Benefit', '30.00', 'Kepala Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

DROP TABLE IF EXISTS `laporan`;
CREATE TABLE IF NOT EXISTS `laporan` (
  `id_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `id_calonguru` int(11) NOT NULL,
  `kd_rekrutmen` varchar(20) NOT NULL,
  `nilai_akhir` decimal(13,2) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_laporan`),
  KEY `kd_rekrutmen` (`kd_rekrutmen`),
  KEY `id_calonguru` (`id_calonguru`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` int(1) NOT NULL,
  `nama_lengkap` varchar(20) DEFAULT NULL,
  `no_telp` varchar(25) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `foto` text,
  `jk` varchar(30) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_pengguna`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `email`, `password`, `role`, `nama_lengkap`, `no_telp`, `tanggal_lahir`, `foto`, `jk`, `alamat`) VALUES
(1, 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 1, 'Bagas Admin', '082180880990', '1999-10-07', 'foto/default-l.png', 'Perempuan', NULL),
(4, 'kepalasekolah@gmail.com', 'ca155005dca052e357b35cbd609906e5', 2, 'Kepala Sekolah Tes', '082289505466', '1970-02-07', 'foto/4881419.jpg', 'Perempuan', NULL),
(14, 'a1@gmail.com', 'f8b51ea3dab97270c3d1df3cebd452a1', 3, 'Septi dwijayanti', '-', '2000-01-01', NULL, 'Perempuan', '-'),
(15, 'a2@gmail.com', '0be2e2181e44147226f01f97c939891b', 3, 'RA. Hasanah  dewi', '-', '2000-01-01', NULL, 'Perempuan', '-'),
(16, 'a3@gmail.com', 'ccc0bf40a4ce6f31e511ddf16a32661b', 3, 'Farida', '-', '2000-01-01', NULL, 'Perempuan', '-'),
(17, 'a4@gmail.com', 'ce46c294226006ca45dcc40fc07db941', 3, 'Novi Asminar', '-', '2000-01-01', NULL, 'Perempuan', '-'),
(18, 'a5@gmail.com', '51500b906caa1422b9aeb7204aed2096', 3, 'Yuli', '-', '2000-01-01', NULL, 'Perempuan', '-'),
(19, 'a6@gmail.com', '0b4c67d0db11a7d4abbacaaf0f601ab0', 3, 'Eka', '-', '2000-01-01', NULL, 'Perempuan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id_penilaian` int(11) NOT NULL AUTO_INCREMENT,
  `id_calonguru` int(11) NOT NULL,
  `kd_rekrutmen` varchar(20) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_bobot` int(11) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_penilaian`),
  KEY `kd_rekrutmen` (`kd_rekrutmen`),
  KEY `id_calonguru` (`id_calonguru`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_bobot` (`id_bobot`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_calonguru`, `kd_rekrutmen`, `id_kriteria`, `id_bobot`, `keterangan`) VALUES
(6, 1, '17032022-40457', 1, 6, NULL),
(7, 1, '17032022-40457', 2, 9, NULL),
(8, 1, '17032022-40457', 3, 19, NULL),
(9, 1, '17032022-40457', 4, 13, NULL),
(10, 2, '17032022-40457', 1, 6, NULL),
(11, 2, '17032022-40457', 2, 8, NULL),
(12, 2, '17032022-40457', 3, 19, NULL),
(13, 2, '17032022-40457', 4, 12, NULL),
(14, 3, '17032022-40457', 1, 5, NULL),
(15, 3, '17032022-40457', 2, 7, NULL),
(16, 3, '17032022-40457', 3, 11, NULL),
(17, 3, '17032022-40457', 4, 13, NULL),
(18, 4, '17032022-40457', 1, 6, NULL),
(19, 4, '17032022-40457', 2, 8, NULL),
(20, 4, '17032022-40457', 3, 19, NULL),
(21, 4, '17032022-40457', 4, 13, NULL),
(22, 5, '17032022-40457', 1, 5, NULL),
(23, 5, '17032022-40457', 2, 7, NULL),
(24, 5, '17032022-40457', 3, 10, NULL),
(25, 5, '17032022-40457', 4, 12, NULL),
(26, 6, '17032022-40457', 1, 6, NULL),
(27, 6, '17032022-40457', 2, 9, NULL),
(28, 6, '17032022-40457', 3, 19, NULL),
(29, 6, '17032022-40457', 4, 12, NULL),
(30, 1, '17032022-40457', 5, 17, NULL),
(31, 2, '17032022-40457', 5, 18, NULL),
(32, 3, '17032022-40457', 5, 16, NULL),
(33, 4, '17032022-40457', 5, 17, NULL),
(34, 5, '17032022-40457', 5, 18, NULL),
(35, 6, '17032022-40457', 5, 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekrutmen`
--

DROP TABLE IF EXISTS `rekrutmen`;
CREATE TABLE IF NOT EXISTS `rekrutmen` (
  `email` varchar(50) NOT NULL,
  `kd_rekrutmen` varchar(20) NOT NULL,
  `judul` text NOT NULL,
  `buka` date NOT NULL,
  `tutup` date NOT NULL,
  `jumlah_guru` int(3) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `persyaratan` text,
  `keterangan` text,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`kd_rekrutmen`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekrutmen`
--

INSERT INTO `rekrutmen` (`email`, `kd_rekrutmen`, `judul`, `buka`, `tutup`, `jumlah_guru`, `tgl_buat`, `persyaratan`, `keterangan`, `status`) VALUES
('admin@gmail.com', '17032022-40457', 'Rekrutmen A', '2022-03-17', '2022-03-19', 1, '2022-03-17 11:39:39', '<ul>\r\n	<li>Pendidikan S1 PGSD*</li>\r\n	<li>Pengalaman mengajar min. 1 tahun</li>\r\n	<li>Usia Maks. 30 Tahun</li>\r\n	<li>Diutamakan Laki - Laki</li>\r\n	<li>Memiliki kepribadian Islami dan tidak merokok</li>\r\n	<li>Domisili diutamakan di daerah Jakarta Selatan</li>\r\n	<li>Memiliki semangat kreatif dan inovatif</li>\r\n	<li>Mampu mengoperasikan komputer</li>\r\n</ul>\r\n', '<ul>\r\n	<li>Mengajar Siswa-Siswi SD Islam Al Ikhlas</li>\r\n	<li>Mempersiapkan Bahan Ajar SD Islam Al Ikhlas&nbsp;</li>\r\n	<li>Memiliki keterampilan organisasi (lebih disukai) dan berdedikasi dalam mengajar&nbsp;</li>\r\n	<li>Melakukan koordinasi dengan Guru dan Pimpinan untuk memaksimalkan hasil kerja</li>\r\n	<li>Mengikuti program dan peraturan yang ada di Yayasan Masjid Al Ikhlas</li>\r\n</ul>\r\n', 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `calon_guru`
--
ALTER TABLE `calon_guru`
  ADD CONSTRAINT `calon_guru_ibfk_1` FOREIGN KEY (`email`) REFERENCES `pengguna` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_laporan`
--
ALTER TABLE `detail_laporan`
  ADD CONSTRAINT `detail_laporan_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id_laporan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`kd_rekrutmen`) REFERENCES `rekrutmen` (`kd_rekrutmen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_ibfk_2` FOREIGN KEY (`id_calonguru`) REFERENCES `calon_guru` (`id_calonguru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_calonguru`) REFERENCES `calon_guru` (`id_calonguru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`kd_rekrutmen`) REFERENCES `rekrutmen` (`kd_rekrutmen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_4` FOREIGN KEY (`id_bobot`) REFERENCES `bobot_kriteria` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekrutmen`
--
ALTER TABLE `rekrutmen`
  ADD CONSTRAINT `rekrutmen_ibfk_1` FOREIGN KEY (`email`) REFERENCES `pengguna` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
