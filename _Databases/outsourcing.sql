-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 11 Jul 2021 pada 12.21
-- Versi Server: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `outsourcing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berkas_pekerjaan`
--

DROP TABLE IF EXISTS `berkas_pekerjaan`;
CREATE TABLE IF NOT EXISTS `berkas_pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bahan` varchar(25) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tipe` enum('Gambar','Dokumen PDF','Gambar & PDF','Lainnya') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berkas_pekerjaan`
--

INSERT INTO `berkas_pekerjaan` (`id`, `kode_bahan`, `nama`, `tipe`) VALUES
(8, 'Offi1613378888', 'Ijazah Terakhir', 'Dokumen PDF'),
(7, 'Offi1613378888', 'KTP', 'Gambar & PDF'),
(6, 'Offi1613378888', 'CV', 'Dokumen PDF'),
(5, 'Offi1613378888', 'Foto 4x6', 'Gambar'),
(49, 'Assi1613807235', 'Ijazah s1', 'Dokumen PDF'),
(48, 'Assi1613807235', 'CV', 'Dokumen PDF'),
(47, 'Assi1613807235', 'Foto 4x6', 'Gambar'),
(15, 'CS1613561738', 'Foto 4x6', 'Gambar'),
(16, 'CS1613561738', 'CV', 'Dokumen PDF'),
(51, 'asd1614161910', 'asddsa', 'Gambar'),
(50, 'Offi1614161899', 'ads', 'Gambar'),
(52, 'HRD1625743360', 'CV', 'Gambar & PDF');

-- --------------------------------------------------------

--
-- Stand-in structure for view `berkas_pekerjaan_overview`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `berkas_pekerjaan_overview`;
CREATE TABLE IF NOT EXISTS `berkas_pekerjaan_overview` (
`id` int(11)
,`kode_bahan` varchar(25)
,`nama` varchar(200)
,`tipe` enum('Gambar','Dokumen PDF','Gambar & PDF','Lainnya')
,`posisi_jabatan` varchar(200)
,`id_pekerjaan` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `berkas_pelamar_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `berkas_pelamar_view`;
CREATE TABLE IF NOT EXISTS `berkas_pelamar_view` (
`id` int(11)
,`kode_bahan` varchar(25)
,`nama` varchar(200)
,`tipe` enum('Gambar','Dokumen PDF','Gambar & PDF','Lainnya')
,`nik` varchar(26)
,`file_path` text
,`id_bahan_pelamar` int(11)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_ujian`
--

DROP TABLE IF EXISTS `jadwal_ujian`;
CREATE TABLE IF NOT EXISTS `jadwal_ujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ujian` varchar(25) NOT NULL,
  `kode_soal` varchar(25) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `mulai` varchar(25) NOT NULL,
  `akhir` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_ujian`
--

INSERT INTO `jadwal_ujian` (`id`, `kode_ujian`, `kode_soal`, `judul`, `mulai`, `akhir`) VALUES
(4, 'Offi1613378888', 'MTK1613378889', 'MTK', '1614600000', '1614618000'),
(3, 'Offi1613378888', 'Psik1613378889', 'Psikotes', '1614582000', '1614596400'),
(5, 'Offi1613378888', 'Kete1613378889', 'Ketelitian', '1614582000', '1614596400'),
(32, 'Assi1613807235', 'Kete1613715971', 'Ketelitian', '1613977200', '1613980800'),
(31, 'Assi1613807235', 'Psik1613715971', 'Psikotes', '1613804400', '1613808000'),
(10, 'CS1613561738', 'Psik1613561738', 'Psikotes', '1617174000', '1617188400'),
(34, 'asd1614161910', 'asd1614161910', 'asd', '1614099600', '1614185940'),
(33, 'Offi1614161899', 'asd1614161899', 'asd', '1614099600', '1614185940'),
(35, 'HRD1625743360', 'Psik1625743360', 'Psikotes', '1625677200', '1625763540');

-- --------------------------------------------------------

--
-- Stand-in structure for view `jadwal_ujian_overview`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `jadwal_ujian_overview`;
CREATE TABLE IF NOT EXISTS `jadwal_ujian_overview` (
`id` int(11)
,`kode_ujian` varchar(25)
,`kode_soal` varchar(25)
,`judul` varchar(200)
,`mulai` varchar(25)
,`akhir` varchar(25)
,`posisi_jabatan` varchar(200)
,`id_pekerjaan` int(11)
,`total_soal` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

DROP TABLE IF EXISTS `pekerjaan`;
CREATE TABLE IF NOT EXISTS `pekerjaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posisi_jabatan` varchar(200) NOT NULL,
  `pendaftaran_mulai` varchar(25) NOT NULL,
  `pendaftaran_akhir` varchar(25) NOT NULL,
  `kode_bahan` varchar(25) NOT NULL,
  `kuota` int(11) NOT NULL DEFAULT '1',
  `kode_ujian` varchar(25) NOT NULL,
  `tersedia` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `posisi_jabatan`, `pendaftaran_mulai`, `pendaftaran_akhir`, `kode_bahan`, `kuota`, `kode_ujian`, `tersedia`) VALUES
(1, 'Office Boy', '1613433600', '1614470400', 'Offi1613378888', 2, 'Offi1613378888', 1),
(2, 'Assisten', '1613494800', '1614445200', 'Assi1613807235', 1, 'Assi1613807235', 1),
(3, 'CS', '1614470400', '1617148800', 'CS1613561738', 1, 'CS1613561738', 1),
(4, 'Office Boy2', '1614099600', '1614099600', 'Offi1614161899', 2, 'Offi1614161899', 1),
(5, 'asd', '1614099600', '1614099600', 'asd1614161910', 21, 'asd1614161910', 1),
(6, 'HRD', '1625677200', '1627059600', 'HRD1625743360', 15, 'HRD1625743360', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pekerjaan_overview`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `pekerjaan_overview`;
CREATE TABLE IF NOT EXISTS `pekerjaan_overview` (
`id` int(11)
,`posisi_jabatan` varchar(200)
,`pendaftaran_mulai` varchar(25)
,`pendaftaran_akhir` varchar(25)
,`kode_bahan` varchar(25)
,`total_berkas` bigint(21)
,`kuota` int(11)
,`kode_ujian` varchar(25)
,`total_ujian` bigint(21)
,`tersedia` tinyint(1)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelamar`
--

DROP TABLE IF EXISTS `pelamar`;
CREATE TABLE IF NOT EXISTS `pelamar` (
  `nik` varchar(26) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `status` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `tinggi_badan` int(3) NOT NULL,
  `berat_badan` int(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hp` varchar(21) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`nik`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelamar`
--

INSERT INTO `pelamar` (`nik`, `id_posisi`, `nama`, `jenis_kelamin`, `status`, `pekerjaan`, `tinggi_badan`, `berat_badan`, `email`, `hp`, `alamat`, `username`, `password`) VALUES
('1234567890', 2, 'user', 'Pria', 'Sudah Menikah', 'wiraswasta', 121, 22, 'khori@mail.com', '123123', 'jambi', 'user', 'ee11cbb19052e40b07aac0ca060c23ee'),
('12345678901', 1, 'user2', 'Pria', 'Belum Menikah', 'wiraswasta', 120, 23, 'debuger@mail.com', '909090090090', 'jambi', 'user2', '7e58d63b60197ceb55a1c487989a3720'),
('user3', 2, 'user3', 'Pria', 'Belum Menikah', 'wiraswasta', 122, 23, 'ikrarwinata04@gmail.com', '909090090090', 'jambi', 'user3', '92877af70a45fd6a2ed7fe81e1236b78'),
('1507111309890001', 6, 'yaya', 'Pria', 'Sudah Menikah', 'wiraswasta', 155, 20, 'debuger@mail.com', '909090090090', 'l', '1507111309890001', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelamar_bahan`
--

DROP TABLE IF EXISTS `pelamar_bahan`;
CREATE TABLE IF NOT EXISTS `pelamar_bahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(26) NOT NULL,
  `id_berkas` int(11) NOT NULL,
  `file_path` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelamar_bahan`
--

INSERT INTO `pelamar_bahan` (`id`, `nik`, `id_berkas`, `file_path`) VALUES
(42, 'user3', 47, 'files/bahan/161382039847.jpg'),
(41, 'user3', 48, 'files/bahan/161382039848.pdf'),
(37, '1234567890', 49, 'files/bahan/161380727849.pdf'),
(38, '1234567890', 48, 'files/bahan/161380727848.pdf'),
(39, '1234567890', 47, 'files/bahan/161380727847.jpg'),
(40, 'user3', 49, 'files/bahan/161382039849.pdf');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pelamar_bahan_overview`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `pelamar_bahan_overview`;
CREATE TABLE IF NOT EXISTS `pelamar_bahan_overview` (
`id` int(11)
,`nik` varchar(26)
,`id_berkas` int(11)
,`file_path` text
,`nama` varchar(200)
,`tipe` enum('Gambar','Dokumen PDF','Gambar & PDF','Lainnya')
,`kode_bahan` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pelamar_jadwal_overview`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `pelamar_jadwal_overview`;
CREATE TABLE IF NOT EXISTS `pelamar_jadwal_overview` (
`nik` varchar(26)
,`id_posisi` int(11)
,`nama` varchar(100)
,`posisi_jabatan` varchar(200)
,`kode_ujian` varchar(25)
,`kode_soal` varchar(25)
,`judul_ujian` varchar(200)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelamar_jawaban`
--

DROP TABLE IF EXISTS `pelamar_jawaban`;
CREATE TABLE IF NOT EXISTS `pelamar_jawaban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(25) NOT NULL,
  `id_soal` varchar(25) NOT NULL,
  `jawaban` char(1) DEFAULT NULL,
  `timestamps` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelamar_jawaban`
--

INSERT INTO `pelamar_jawaban` (`id`, `nik`, `id_soal`, `jawaban`, `timestamps`) VALUES
(111, '1234567890', '4', 'e', '1613804584'),
(112, '1234567890', '3', 'c', '1613804588'),
(106, '1234567890', '1', 'd', '1613804574'),
(108, '1234567890', '2', 'b', '1613804578'),
(116, '1234567890', '5', 'a', '1613977232'),
(117, '1234567890', '6', 'd', '1613977234'),
(121, 'user3', '5', 'a', '1613978314'),
(122, 'user3', '6', 'b', '1613978322'),
(145, '1234567890', '38', 'c', '1613804819'),
(144, '1234567890', '37', 'b', '1613804812'),
(142, '1234567890', '36', 'd', '1613804798'),
(140, '1234567890', '35', 'd', '1613804792');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pelamar_overview`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `pelamar_overview`;
CREATE TABLE IF NOT EXISTS `pelamar_overview` (
`nik` varchar(26)
,`id_posisi` int(11)
,`nama` varchar(100)
,`jenis_kelamin` enum('Pria','Wanita')
,`status` varchar(100)
,`pekerjaan` varchar(100)
,`tinggi_badan` int(3)
,`berat_badan` int(3)
,`email` varchar(100)
,`hp` varchar(21)
,`alamat` text
,`username` varchar(35)
,`password` varchar(100)
,`posisi_jabatan` varchar(200)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) NOT NULL,
  `banner` text,
  `file_lampiran` text,
  `deskripsi` text NOT NULL,
  `timestamps` varchar(21) NOT NULL,
  `tampilkan` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `banner`, `file_lampiran`, `deskripsi`, `timestamps`, `tampilkan`) VALUES
(4, 'PENGUMUMAN HASIL SELEKSI AKHIR PENGADAAN PEGAWAI BLU LPMUKP TAHUN 2020', './files/gambar/1613299667.jpg', NULL, '<p>PENGUMUMAN</p>\r\n\r\n<p>NOMOR: 004/LPMUKP/XII/2020</p>\r\n\r\n<p>TENTANG</p>\r\n\r\n<p>HASIL SELEKSI PENGADAAN PEGAWAI</p>\r\n\r\n<p>PADA</p>\r\n\r\n<p>BADAN LAYANAN UMUM</p>\r\n\r\n<p>LEMBAGA PENGELOLA MODAL USAHA KELAUTAN DAN PERIKANAN<br>\r\nTAHUN 2020</p>\r\n\r\n<p>Sehubungan dengan telah dilaksanakannya rangkaian proses seleksi pengadaan pegawai Badan Layanan Umum Lembaga Pengelola Modal Usaha Kelautan dan Perikanan (BLU LPMUKP) serta berdasarkan pelaksanaan seleksi pengadaan pegawai BLU LPMUKP yang dimulai dari tanggal 8 hingga 22 Desember 2020 sesuai mekanisme dan ketentuan yang sudah ditetapkan.</p>', '1613809520', 1),
(6, 'PENGUMUMAN HASIL SELEKSI AKHIR', './files/gambar/banner1613995135.jpg', './files/lampiran/file_lampiran1613995135.pdf', '<p>Peserta yang dinyatakan lulus dapat dilihat di dokumen lampiran dibawah</p>', '1613995135', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

DROP TABLE IF EXISTS `perusahaan`;
CREATE TABLE IF NOT EXISTS `perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(100) NOT NULL,
  `judul` text,
  `deskripsi` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `lokasi`, `judul`, `deskripsi`) VALUES
(1, 'slider 1', 'Tentang Kami', 'Resources Services Procedure Reference Office Career'),
(2, 'slider 2', 'Visi Kami', 'Menjadi perusahaan jasa yang memuaskan PELANGGAN'),
(3, 'slider 3', 'Misi Kami', 'Memberikan pelayanan yang terbaik demi kepuasan Para Pemilik, Pengelola Gedung, Dengan menciptakan kondisi gedung yang Bersih, Indah, Nyaman dan Aman serta meringankan tugas untuk mencapai suatu hasil yang maksimal.'),
(4, 'logo', NULL, './assets/logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_ujian`
--

DROP TABLE IF EXISTS `soal_ujian`;
CREATE TABLE IF NOT EXISTS `soal_ujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gambar` text,
  `kode_soal` varchar(25) NOT NULL,
  `soal` text,
  `a` text,
  `b` text,
  `c` text,
  `d` text,
  `e` text,
  `jawaban` char(1) NOT NULL DEFAULT 'a',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal_ujian`
--

INSERT INTO `soal_ujian` (`id`, `gambar`, `kode_soal`, `soal`, `a`, `b`, `c`, `d`, `e`, `jawaban`) VALUES
(38, './files/soal/img1614078034.jpg', 'Psik1613715971', 'soal 3 asd sad as s', 'aaaaaaaa', 'bbbbbbbbbbb', 'ccccccccc', 'ddddddddd', 'eeeeeeeeeee', 'c'),
(5, NULL, 'Kete1613715971', 'soal 1', 'a', 'bbbbbbbb', 'c', 'ddddddddd', 'eeeeeeee', 'a'),
(37, NULL, 'Psik1613715971', 'soal 2 asd sad as s', 'aaaaa', 'bbbbbbbb', 'cccccccccc', 'ddddddddd', 'eeeeeeee', 'b'),
(36, NULL, 'Psik1613715971', 'soal 4 asd sad as s', 'aaaaaaaaaaaaaa', 'bbbbbbbbbb', 'ccccccccccccccc', 'ddddddd', 'eeeeee', 'd'),
(6, NULL, 'Kete1613715971', 'soal 2', 'aaaaaaaaaaaaaaa', 'bbbbbbbb', 'ccccccccc', 'ddddddddd', 'eeeeeeee', 'a'),
(35, './files/soal/img1614078019.jpg', 'Psik1613715971', 'Siapaka presiden Indonesia pertama ?', 'Soeharto', 'Susilo Bambang Yudhoyono', 'B. J. Habibie', 'Soekarno', 'Joko Widodo', 'd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `nik` varchar(25) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  PRIMARY KEY (`nik`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`nik`, `username`, `password`, `nama`, `jenis_kelamin`, `jabatan`) VALUES
('12321312312', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Pria', 'HRD');

-- --------------------------------------------------------

--
-- Struktur untuk view `berkas_pekerjaan_overview`
--
DROP TABLE IF EXISTS `berkas_pekerjaan_overview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `berkas_pekerjaan_overview`  AS  select `a`.`id` AS `id`,`a`.`kode_bahan` AS `kode_bahan`,`a`.`nama` AS `nama`,`a`.`tipe` AS `tipe`,`b`.`posisi_jabatan` AS `posisi_jabatan`,`b`.`id` AS `id_pekerjaan` from (`berkas_pekerjaan` `a` left join `pekerjaan` `b` on((`a`.`kode_bahan` = `b`.`kode_bahan`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `berkas_pelamar_view`
--
DROP TABLE IF EXISTS `berkas_pelamar_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `berkas_pelamar_view`  AS  select `a`.`id` AS `id`,`a`.`kode_bahan` AS `kode_bahan`,`a`.`nama` AS `nama`,`a`.`tipe` AS `tipe`,`b`.`nik` AS `nik`,`b`.`file_path` AS `file_path`,`b`.`id` AS `id_bahan_pelamar` from (`berkas_pekerjaan` `a` left join `pelamar_bahan` `b` on((`a`.`id` = `b`.`id_berkas`))) group by `a`.`id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `jadwal_ujian_overview`
--
DROP TABLE IF EXISTS `jadwal_ujian_overview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jadwal_ujian_overview`  AS  select `a`.`id` AS `id`,`a`.`kode_ujian` AS `kode_ujian`,`a`.`kode_soal` AS `kode_soal`,`a`.`judul` AS `judul`,`a`.`mulai` AS `mulai`,`a`.`akhir` AS `akhir`,`b`.`posisi_jabatan` AS `posisi_jabatan`,`b`.`id` AS `id_pekerjaan`,(select count(`soal_ujian`.`id`) from `soal_ujian` where (`soal_ujian`.`kode_soal` = `a`.`kode_soal`)) AS `total_soal` from (`jadwal_ujian` `a` left join `pekerjaan` `b` on((`a`.`kode_ujian` = `b`.`kode_ujian`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pekerjaan_overview`
--
DROP TABLE IF EXISTS `pekerjaan_overview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pekerjaan_overview`  AS  select `a`.`id` AS `id`,`a`.`posisi_jabatan` AS `posisi_jabatan`,`a`.`pendaftaran_mulai` AS `pendaftaran_mulai`,`a`.`pendaftaran_akhir` AS `pendaftaran_akhir`,`a`.`kode_bahan` AS `kode_bahan`,(select count(`berkas_pekerjaan`.`id`) from `berkas_pekerjaan` where (`berkas_pekerjaan`.`kode_bahan` = `a`.`kode_bahan`)) AS `total_berkas`,`a`.`kuota` AS `kuota`,`a`.`kode_ujian` AS `kode_ujian`,(select count(`jadwal_ujian`.`id`) from `jadwal_ujian` where (`jadwal_ujian`.`kode_ujian` = `a`.`kode_ujian`)) AS `total_ujian`,`a`.`tersedia` AS `tersedia` from `pekerjaan` `a` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelamar_bahan_overview`
--
DROP TABLE IF EXISTS `pelamar_bahan_overview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelamar_bahan_overview`  AS  select `a`.`id` AS `id`,`a`.`nik` AS `nik`,`a`.`id_berkas` AS `id_berkas`,`a`.`file_path` AS `file_path`,`b`.`nama` AS `nama`,`b`.`tipe` AS `tipe`,`b`.`kode_bahan` AS `kode_bahan` from (`pelamar_bahan` `a` join `berkas_pekerjaan` `b` on((`a`.`id_berkas` = `b`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelamar_jadwal_overview`
--
DROP TABLE IF EXISTS `pelamar_jadwal_overview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelamar_jadwal_overview`  AS  select `a`.`nik` AS `nik`,`a`.`id_posisi` AS `id_posisi`,`a`.`nama` AS `nama`,`b`.`posisi_jabatan` AS `posisi_jabatan`,`b`.`kode_ujian` AS `kode_ujian`,`c`.`kode_soal` AS `kode_soal`,`c`.`judul` AS `judul_ujian` from ((`pelamar` `a` join `pekerjaan` `b` on((`a`.`id_posisi` = `b`.`id`))) left join `jadwal_ujian` `c` on((`b`.`kode_ujian` = `c`.`kode_ujian`))) order by `a`.`nik` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelamar_overview`
--
DROP TABLE IF EXISTS `pelamar_overview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelamar_overview`  AS  select `a`.`nik` AS `nik`,`a`.`id_posisi` AS `id_posisi`,`a`.`nama` AS `nama`,`a`.`jenis_kelamin` AS `jenis_kelamin`,`a`.`status` AS `status`,`a`.`pekerjaan` AS `pekerjaan`,`a`.`tinggi_badan` AS `tinggi_badan`,`a`.`berat_badan` AS `berat_badan`,`a`.`email` AS `email`,`a`.`hp` AS `hp`,`a`.`alamat` AS `alamat`,`a`.`username` AS `username`,`a`.`password` AS `password`,`b`.`posisi_jabatan` AS `posisi_jabatan` from (`pelamar` `a` join `pekerjaan` `b` on((`a`.`id_posisi` = `b`.`id`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
