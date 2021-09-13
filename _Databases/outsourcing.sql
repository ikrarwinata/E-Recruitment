-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Sep 2021 pada 20.28
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berkas_pekerjaan`
--

INSERT INTO `berkas_pekerjaan` (`id`, `kode_bahan`, `nama`, `tipe`) VALUES
(86, 'Secu1631218448', 'Sertifikat Gada Pratama', 'Gambar & PDF'),
(87, 'Secu1631218448', 'Foto 4x6 ', 'Dokumen PDF'),
(85, 'Secu1631218448', 'Foto Copy Ijazah (Minimal SMA Sederajat)', 'Gambar'),
(84, 'Secu1631218448', ' Daftar Riwayat Hidup', 'Gambar & PDF'),
(83, 'Secu1631218448', 'Surat Lamaran Kerja', 'Gambar'),
(82, 'Secu1631218448', 'Foto copy KTP', 'Gambar & PDF');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `berkas_pekerjaan_overview`
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
-- Stand-in struktur untuk tampilan `berkas_pelamar_view`
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
  `standar_nilai` int(3) NOT NULL DEFAULT 70,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_ujian`
--

INSERT INTO `jadwal_ujian` (`id`, `kode_ujian`, `kode_soal`, `judul`, `mulai`, `akhir`, `standar_nilai`) VALUES
(43, 'Secu1631218448', 'Psik1613561738', 'Psikotes', '1631538000', '1631545200', 60);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `jadwal_ujian_overview`
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
  `kuota` int(11) NOT NULL DEFAULT 1,
  `kode_ujian` varchar(25) NOT NULL,
  `tersedia` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `posisi_jabatan`, `pendaftaran_mulai`, `pendaftaran_akhir`, `kode_bahan`, `kuota`, `kode_ujian`, `tersedia`) VALUES
(2, 'Staff Administrasi', '1631206800', '1631811600', 'Staf1631218496', 3, 'Staf1631218496', 1),
(3, 'Security', '1631466000', '1631552400', 'Secu1631218448', 5, 'Secu1631218448', 1);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pekerjaan_overview`
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
('1505061612970001', 3, 'Muhammad Baihaki', 'Pria', 'Belum Menikah', 'Belum Bekerja', 170, 60, 'baihaki123@gmail.com', '082258876755', 'Jelutung Kota Jambi', 'Baihaki', 'e10adc3949ba59abbe56e057f20f883e'),
('1507111309890001', 6, 'yaya', 'Pria', 'Sudah Menikah', 'wiraswasta', 155, 20, 'debuger@mail.com', '909090090090', 'l', '1507111309890001', 'e10adc3949ba59abbe56e057f20f883e'),
('1505061612980001', 3, 'Burhanudin', 'Pria', 'Belum Menikah', 'Belum Bekerja', 170, 60, 'burhanudin@gmail.com', '082258876566', 'Telanaipura,Kota Jambi', 'Burhanudin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelamar_bahan`
--

DROP TABLE IF EXISTS `pelamar_bahan`;
CREATE TABLE IF NOT EXISTS `pelamar_bahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(26) NOT NULL,
  `id_berkas` int(11) NOT NULL,
  `file_path` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelamar_bahan`
--

INSERT INTO `pelamar_bahan` (`id`, `nik`, `id_berkas`, `file_path`) VALUES
(45, '1505061612980001', 85, 'files/bahan/163124072085.jpg'),
(44, '1505061612980001', 87, 'files/bahan/163124072087.pdf'),
(43, '1505061612980001', 86, 'files/bahan/163124072086.jpg'),
(46, '1505061612980001', 84, 'files/bahan/163124072084.pdf'),
(47, '1505061612980001', 83, 'files/bahan/163124072083.jpg'),
(48, '1505061612980001', 82, 'files/bahan/163124072082.jpg');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelamar_bahan_overview`
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
-- Stand-in struktur untuk tampilan `pelamar_jadwal_overview`
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
,`standar_nilai` int(3)
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
) ENGINE=MyISAM AUTO_INCREMENT=1102 DEFAULT CHARSET=latin1;

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
(1101, '1505061612980001', '720', 'e', '1631541375'),
(145, '1234567890', '38', 'c', '1613804819'),
(144, '1234567890', '37', 'b', '1613804812'),
(142, '1234567890', '36', 'd', '1613804798'),
(140, '1234567890', '35', 'd', '1613804792'),
(1100, '1505061612980001', '719', 'e', '1631541375'),
(1098, '1505061612980001', '718', 'e', '1631541374'),
(1096, '1505061612980001', '717', 'e', '1631541372'),
(1094, '1505061612980001', '716', 'e', '1631541370'),
(1092, '1505061612980001', '715', 'e', '1631541368'),
(1090, '1505061612980001', '714', 'e', '1631541367'),
(1088, '1505061612980001', '713', 'e', '1631541366'),
(1086, '1505061612980001', '712', 'e', '1631541364'),
(1084, '1505061612980001', '711', 'e', '1631541363'),
(1082, '1505061612980001', '710', 'e', '1631541362'),
(1080, '1505061612980001', '709', 'e', '1631541360'),
(1078, '1505061612980001', '708', 'e', '1631541359'),
(1076, '1505061612980001', '707', 'e', '1631541357'),
(1074, '1505061612980001', '706', 'e', '1631541356'),
(1072, '1505061612980001', '705', 'e', '1631541355'),
(1068, '1505061612980001', '704', 'e', '1631541351'),
(1066, '1505061612980001', '703', 'e', '1631541350'),
(1064, '1505061612980001', '702', 'e', '1631541349'),
(1062, '1505061612980001', '701', 'e', '1631541347'),
(1060, '1505061612980001', '700', 'e', '1631541345'),
(1058, '1505061612980001', '699', 'e', '1631541344'),
(1056, '1505061612980001', '698', 'e', '1631541342'),
(1054, '1505061612980001', '697', 'e', '1631541341'),
(1052, '1505061612980001', '696', 'e', '1631541340'),
(1050, '1505061612980001', '695', 'e', '1631541338'),
(1048, '1505061612980001', '694', 'e', '1631541336'),
(1046, '1505061612980001', '693', 'e', '1631541335'),
(1044, '1505061612980001', '692', 'e', '1631541333'),
(1042, '1505061612980001', '691', 'e', '1631541332'),
(1040, '1505061612980001', '690', 'e', '1631541331'),
(1038, '1505061612980001', '689', 'e', '1631541330'),
(1036, '1505061612980001', '688', 'e', '1631541329'),
(1034, '1505061612980001', '687', 'e', '1631541328'),
(1032, '1505061612980001', '686', 'e', '1631541327'),
(1030, '1505061612980001', '685', 'e', '1631541326'),
(1028, '1505061612980001', '684', 'e', '1631541325'),
(1026, '1505061612980001', '683', 'e', '1631541324'),
(1024, '1505061612980001', '682', 'e', '1631541323'),
(1022, '1505061612980001', '681', 'e', '1631541322'),
(1020, '1505061612980001', '680', 'e', '1631541321'),
(1018, '1505061612980001', '679', 'e', '1631541320'),
(1016, '1505061612980001', '678', 'e', '1631541319'),
(1014, '1505061612980001', '677', 'e', '1631541318'),
(1012, '1505061612980001', '676', 'e', '1631541316'),
(1010, '1505061612980001', '675', 'e', '1631541315'),
(1008, '1505061612980001', '674', 'e', '1631541314'),
(1006, '1505061612980001', '673', 'e', '1631541313'),
(1004, '1505061612980001', '672', 'e', '1631541312'),
(1002, '1505061612980001', '671', 'e', '1631541311');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pelamar_overview`
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
  `banner` text DEFAULT NULL,
  `file_lampiran` text DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `timestamps` varchar(21) NOT NULL,
  `tampilkan` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `banner`, `file_lampiran`, `deskripsi`, `timestamps`, `tampilkan`) VALUES
(6, 'PENGUMUMAN HASIL SELEKSI AKHIR', './files/gambar/banner1631202822.jpg', './files/lampiran/file_lampiran1613995135.pdf', '<p>Peserta yang sudah mengikuti ujian dapat dilihat di dokumen lampiran dibawah</p>', '1631202822', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

DROP TABLE IF EXISTS `perusahaan`;
CREATE TABLE IF NOT EXISTS `perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(100) NOT NULL,
  `judul` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `lokasi`, `judul`, `deskripsi`) VALUES
(1, 'slider 1', 'Latar Belakang', 'PT. Karunia Adi Sentosa mempunyai personal - personal yang ahli dan memiliki latar belakang pendidikan dari berbagai disiplin ilmu, juga ditunjang oleh pengalaman dan profesionalisme yang mendukung pekerjaan tersebut sehingga membuat manajemen yang baik'),
(2, 'slider 2', 'Visi ', 'Menjadi perusahaan jasa yang memuaskan PELANGGAN'),
(3, 'slider 3', 'Misi ', 'Memberikan pelayanan yang terbaik demi kepuasan Para Pemilik, Pengelola Gedung, Dengan menciptakan kondisi gedung yang Bersih, Indah, Nyaman dan Aman serta meringankan tugas untuk mencapai suatu hasil yang maksimal.'),
(4, 'logo', NULL, './assets/logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_ujian`
--

DROP TABLE IF EXISTS `soal_ujian`;
CREATE TABLE IF NOT EXISTS `soal_ujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gambar` text DEFAULT NULL,
  `kode_soal` varchar(25) NOT NULL,
  `soal` text DEFAULT NULL,
  `a` text DEFAULT NULL,
  `b` text DEFAULT NULL,
  `c` text DEFAULT NULL,
  `d` text DEFAULT NULL,
  `e` text DEFAULT NULL,
  `jawaban` char(1) NOT NULL DEFAULT 'a',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=751 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `soal_ujian`
--

INSERT INTO `soal_ujian` (`id`, `gambar`, `kode_soal`, `soal`, `a`, `b`, `c`, `d`, `e`, `jawaban`) VALUES
(744, NULL, 'Kete1613715971', 'Apabila x = 6,5643 x 0,0005 + 100,352 x 0,0004 dan y = 1,2 maka', ' x > y ', 'x < y', ' x = y', ' x » y', 'x dan y tak dapat ditentukan', 'a'),
(745, NULL, 'Kete1613715971', 'Pak rahmat memiliki kebun yang digambarkan pada denah dengan ukuran panjang 9 cm dan lebar 5 cm. Jika luas kebun pak Rahmat yang sebenarnya adalah 405 m2, maka berapakah skala yang digunakan denah tersebut?', '1 : 200 ', '1 : 300', ' 1 : 600', '1 : 900', '1 : 200', 'a'),
(746, NULL, 'Kete1613715971', 'ESOTERIK x', 'Khusus B. Rahasia C. Generalis D. Terbatas E. Eksklusif', 'Rahasia ', 'Generalis ', 'Terbatas ', 'Eksklusif', 'd'),
(747, NULL, 'Kete1613715971', 'DAHINA x', 'Siang ', 'Sore', ' Pagi', 'Hari', ' Lailah', 'd'),
(748, NULL, 'Kete1613715971', 'PRAWACANA x', ' Daftar Pustaka ', 'Introduksi ', 'Halaman ', 'Kata Pengantar', 'Pendahuluan', 'c'),
(749, NULL, 'Kete1613715971', 'DIKTATORIAL x\r\n', 'Absolut ', 'Otoriter ', 'Sewenang-wenang', 'Komunis ', 'Demokrasi', 'c'),
(750, NULL, 'Kete1613715971', 'EJAWANTAH x', 'Nasehat ', 'Wujud ', 'Rangkuman ', 'Nyata ', 'Abstrak', 'e'),
(740, NULL, 'Kete1613715971', 'Apabila 291ab — 32 = 328 maka berapakah nilai 97ab?', ' 120', '130', '140', '150', '160', 'a'),
(741, NULL, 'Kete1613715971', 'Berpakah bilangan berikut yang nilainya paling besar?', '222 ', '(2^2)^2', ' 2^22', '(2x2)^2', '(22)^2', 'd'),
(742, NULL, 'Kete1613715971', 'Apabila x = berat total lima kotak dengan masing kotak punya berat sepuluh pon, dan y = berat lima pulug kotak dengan masing kotak beratnya lima ons maka (kosngosan.com)\r\n', ' x > y ', ' x < y', 'x = y', 'x dan y tidak bisa ditentukan', '2x > 2y', 'c'),
(743, NULL, 'Kete1613715971', 'Diketahui jarak kota A dan B adalah enam puluh kilo meter. apabila X adalah lama waktu tempuh dengan kecepatan enam puluh km/jam, dan Y = lama waktu tempuh dengan kecepatan 15 m/s maka', 'X > Y ', ' X < Y', 'X = Y', 'X dan Y tidak bisa ditentukan ', '2X > 2Y', 'd'),
(737, NULL, 'Kete1613715971', 'Berapakah Nilai 37,596 dari 0,333 ?', '0,008 ', ' 0,015 ', ' 0,1', '0,125', '0,321', 'e'),
(738, NULL, 'Kete1613715971', '(6 x 31)^2 — (201 — 14)^2 =', '373', '186', '36', ' —186', '—373', 'c'),
(739, NULL, 'Kete1613715971', 'Jika x = 5, y=6, dan z = x^2 — 2xy + y^2 maka nilai dari x + yz adalah? (kosngosan.com)', '—1 ', '—1', '0', '1', '11', 'd'),
(736, NULL, 'Kete1613715971', '225,225: 225 =....', '100 ', ' 100,01', '10', '10,1', ' 10,01', 'a'),
(735, NULL, 'Kete1613715971', 'Peserta seleksi Karyawan PT Sawit menempuh tes kemampuan dasar. Sebagian peserta seleksi PT Sawit mengikuti tes kemampuan bidang.', 'Semua peserta PT Sawit yang menempuh tes kemampuan dasar tidak mengikuti tes kemampuan bidang', ' Semua peserta PT Sawit yang mengikuti tes kemampuan bidang tidak menempuh tes kemampuan dasar', ' Semua peserta PT Sawit yang tidak mengikuti tes kemampuan bidang tidak menempuh tes kemampuan dasar', ' Sebagian peserta PT Sawit yang tidak mengikuti tes kemampuan bidang menempuh tes kemampuan dasar', 'Sebagian peserta PT Sawit yang mengikuti tes kemampuan bidang tidak menempuh tes kemampuan dasar', 'b'),
(734, NULL, 'Kete1613715971', 'Semua siswa kelas A berbahasa Inggris. Sebagian siswa kelas A mendapat nilai tinggi', 'Sebagian siswa kelas A mendapat nilai tinggi dan dapat berbahasa Inggris', 'Sebagian siswa kelas A mendapat nilai tinggi dan tidak dapat berbahasa Inggris', 'Sebagian siswa kelas A tidak mendapat nilai tinggi dan tidak dapat berbahasa Inggris', 'Semua siswa kelas A mendapat nilai tinggi dan tidak dapat berbahasa Inggris', 'Semua siswa kelas A tidak mendapat nilai tinggi dan tidak dapat berbahasa Inggris', 'c'),
(731, NULL, 'Kete1613715971', 'Sebagian P merupakan B. B bukan T. Sebagian P bukan M adalah T. Semua B, M, dan T adalah P Kesimpulannya adalah', 'Semua T adalah T bukan M', 'Semua P adalah B bukan T', 'Semua P bukan B bukan M', 'Semua B yang bukan T adalah M', 'Sebagian P bukan T, bukan M, bukan B', 'e'),
(732, NULL, 'Kete1613715971', 'Semua orang yang bermental interpreneur hidup dengan sejahtera. Sebagian orang yang bermental interpreneur melakukan usaha wiraswasta', 'Semua wiraswasta bermental interpreneur', 'Semua wiraswasta hidup sejahtera', 'Semua wiraswasta yang hidupnya sejahtera bermental interpreneur', 'Semua yang bermental interpreneur dan hidupnya sejahtera adalah wiraswastawa', 'Semua orang yang bermental interpreneur hidup dengan sejahtera melakukan usaha wiraswasta', 'd'),
(719, NULL, 'Psik1613561738', 'Berapa jumlah dari 37 orang dan 13 orang?', '30', '40', '50', '60', '70', 'c'),
(720, NULL, 'Psik1613561738', 'Seorang penjual buah-buahan membeli 1.000 buah jeruk seharga Rp. 150.000,00. Penjual tersebut menjual jeruk seharga Rp. 180,00 per buah. Berapa % untungnya?', '20%', '30%', '25%', '35%', '40%', 'd'),
(733, NULL, 'Kete1613715971', 'Model mengenakan gaun pengantin. Semua yang mengenakan gaun pengantin terlihat cantik', 'Semua yang terlihat cantik adalah model', 'Semua model terlihat tidak cantik', ' Semua yang tidak terlihat cantik bukan model', 'Semua yang tidak mengenakan gaun pengantin adalah model yang cantik', 'Semua model terlihat cantik', 'e'),
(718, NULL, 'Psik1613561738', 'Pak Tono menabung uangnya di bank sejumlah Rp. 350.000,00. Sesudah genap 1 tahun Pak Tono menabung dan memperoleh bunga, jumlah uangnya bertambah menjadi Rp. 406.000,00. Bunga yang diterima Pak Tono dalam kurun waktu 1 tahun adalah … %', '10', '12', '17', '16', '20', 'd'),
(717, NULL, 'Psik1613561738', 'Untuk membuat sebuah kios diperlukan waktu selama 48 hari dan dengan mempekerjakan tenaga kerja sebanyak 10 orang. Berapa lama waktu yang perlukan untuk membuat sebuah kios jika menggunakan tenaga kerja sebanyak 20 orang?', '24 hari ', '22 hari', '12 hari ', '10 hari ', '16 hari', 'a'),
(716, NULL, 'Psik1613561738', 'PRESIDEN : … = ….. : PROVINSI : …….', 'Negara : daerah  b. Kabinet : DPRD  c. Pemerintah : Daerah  d. Negara : Gubernur  e. Kepala : Aparat', 'Kabinet : DPRD ', ' Pemerintah : Daerah ', 'Negara : Gubernur  ', 'Kepala : Aparat', 'd'),
(715, NULL, 'Psik1613561738', 'ROKOK : HISAP : BATUK = ….', 'Uang : judi : bangkrut  b. Komik : perpustakaan : guru  c. Motor : pelanggaran : tangkap  d. Atlit : latihan : juara  e. Api : kaki : panas', 'Komik : perpustakaan : guru  ', 'Motor : pelanggaran : tangkap', 'Atlit : latihan : juara ', 'Api : kaki : panas', 'a'),
(714, NULL, 'Psik1613561738', 'PEKERJAAN : MASALAH : FRUSTASI = ….', 'Lemak : kolesterol : hipertensi ', 'Bolos : guru : tidak naik kelas', 'Bolos : guru : tidak naik kelas', 'Ulangan : lulus : bahagia ', 'Bolos : guru : tidak naik kelas', 'c'),
(713, NULL, 'Psik1613561738', 'TEMBAKAU : ROKOK : KANKER = ….', 'Sawit : minyak : goreng  b. Gandum: kue : makan  c. Kayu : bara : memasak  d. Benang : pintal : baju  e. Kambing : sate : darah tinggi', 'Gandum: kue : makan', 'Kayu : bara : memasak ', 'Benang : pintal : baju ', ' Kambing : sate : darah tinggi', 'e'),
(712, NULL, 'Psik1613561738', 'GITAR : KAYU : MUSIK = ….', 'Tari : adat : daerah  b. Motor : cuci : bengkel  c. Saus : cabai : tomat  d. Bola : karet : basket  e. Dokter : resep : pil', ' Motor : cuci : bengkel', 'Saus : cabai : tomat  ', 'Bola : karet : basket  ', 'Dokter : resep : pil', 'd'),
(707, NULL, 'Psik1613561738', 'NARATIF > < ….', 'Puisi  b. Bersifat menguraikan  c. Prosa  d. Sistem  e. Perkembangan', 'Bersifat menguraikan ', 'Prosa  ', 'Sistem', 'Perkembangan', 'a'),
(708, NULL, 'Psik1613561738', 'WAHANA > < ….', 'Kehutanan ', 'Eksistensi  ', 'Wadah  ', 'Ruang angkasa', 'Kendaraan', 'e'),
(709, NULL, 'Psik1613561738', 'HARMONI > < ….', 'Alat musik ', 'Perselisihan  ', 'Serasi  ', 'Merdu  ', 'Percakapan', 'b'),
(710, NULL, 'Psik1613561738', 'SEKULER > < ….', 'Tradisional  b. Ilmiah  c. Lemah  d. Keagamaan  e. Duniawi', 'Ilmiah  ', 'Lemah  ', 'Keagamaan  ', 'Duniawi', 'd'),
(711, NULL, 'Psik1613561738', 'Soal untuk nomor 41-46. Pilihlah jawaban yang kata yang sepadan dan tepat untuk soal berikut.\r\n\r\nTELUR: BERUDU: KATAK = ….', 'Tidur: mengantuk : nyenyak  b. Siang : sore : malam  c. Makan : tidur : kenyang  d. Bayi : anak-anak : remaja  e. Telur : kepompong : kupu-kupu', 'Siang : sore : malam', ' Makan : tidur : kenyang ', 'Bayi : anak-anak : remaja', 'Telur : kepompong : kupu-kupu', 'd'),
(705, NULL, 'Psik1613561738', 'LUGAS > < ….', 'Mengada-ada ', 'Apatis  ', 'Berlebihan  ', 'Keras  ', 'Apa adanya', 'b'),
(706, NULL, 'Psik1613561738', 'MUHIBAH > < ….', 'Kemalangan  ', 'Karya wisata', 'Kenegaraan  ', 'Kunjungan  ', 'Persahabatan', 'a'),
(704, NULL, 'Psik1613561738', 'NETRAL > < ….', 'Terikat  ', 'Berpihak  ', 'Bertentangan  ', 'Terpadu  ', 'Bergabung', 'b'),
(703, NULL, 'Psik1613561738', 'DINAMIS > < ….', 'Pasif ', 'Apatis  ', 'Statis  ', 'Pragmatis  ', 'Kondusif', 'c'),
(702, NULL, 'Psik1613561738', 'ORATOR > < ….', 'Pemirsa ', 'Pembicara  ', 'Pemikir  ', 'Penceramah  ', 'Pendengar', 'e'),
(701, NULL, 'Psik1613561738', 'Soal untuk nomor 31-40. Pilihlah jawaban yang memiliki lawan kata dengan huruf kapital.\r\n\r\nPAKAR > < ….', 'Awam  ', 'Spesialis  ', 'Cendekia  ', 'Acuh  ', 'Mahir', 'a'),
(700, NULL, 'Psik1613561738', 'SAHIH = ….', 'Realita ', 'Lazim  ', 'Valid  ', 'Tepat  ', 'Fakta', 'c'),
(698, NULL, 'Psik1613561738', 'HENING = ….', 'Bening  ', 'Riuh  ', 'Berisik  ', 'Sunyi  ', 'Bersih', 'd'),
(699, NULL, 'Psik1613561738', 'ISLAH = ….', 'Pisah ', 'Cerai  ', 'Perang  ', 'Konflik  ', 'Damai', 'e'),
(696, NULL, 'Psik1613561738', 'EVOKASI = ….', 'Penggugah rasa  ', ' Pengungsian ', 'Perubahan', 'Penyelamatan', 'Penilaian', 'a'),
(697, NULL, 'Psik1613561738', 'FRIKSI = ….', 'Tidak berdaya  b. Perpecahan  c. Putus harapan  d. Sedih  e. Frustasi', 'Perpecahan', 'Putus harapan ', 'Sedih', 'Frustasi', 'b'),
(685, NULL, 'Psik1613561738', 'PSEUDONYM =….', 'Nama Asli  ', 'Bukan Asli', 'Nama Samaran ', 'Padanan Kata ', ' Nama Lengkap', 'c'),
(686, NULL, 'Psik1613561738', 'JASA BOGA =….', 'Seni Merias  ', 'Pelayanan Disain Rumah', 'Penyewaan Pakaian Pengantin ', 'Pakaian Adat', 'Katering', 'e'),
(687, NULL, 'Psik1613561738', 'GAMBARAN = ….', 'Dimensi  ', 'Bentuk  ', 'Citra  ', 'Penampakan  ', 'Imajinasi', 'c'),
(688, NULL, 'Psik1613561738', 'PRESTISE = ….', 'Unggul ', 'Berkah  ', 'Elite  ', 'Pilihan  ', 'Martabat', 'a'),
(689, NULL, 'Psik1613561738', 'KONFRONTASI = ….', 'Perdebatan  ', 'Pertikaian  ', 'Perbedaan  ', 'Persaingan  ', 'Pertandingan', 'd'),
(690, NULL, 'Psik1613561738', 'DEDUKSI = ….', 'Transduksi', 'Konduksi ', 'Intuisi', 'Induksi  ', 'Reduksi', 'c'),
(691, NULL, 'Psik1613561738', 'PROMINEM = ….', 'Setuju  ', 'Biasa  ', 'Pelopor  ', 'Terkemuka  ', 'Pendukung', 'b'),
(692, NULL, 'Psik1613561738', 'EPILOG = ….', 'Menolong ', 'Analog  ', 'Dialog  ', 'Prolog  ', 'Hipolog', 'd'),
(693, NULL, 'Psik1613561738', 'SUMBANG = ….', 'Laras  ', 'Mirip  ', 'Imbang  ', 'Tepat  ', 'Kokoh', 'd'),
(694, NULL, 'Psik1613561738', 'NOMADIK = ….', 'Menetap  ', 'Sesuai norma', 'Anomali  ', 'Mapan', ' Tak teratur', 'a'),
(695, NULL, 'Psik1613561738', 'BONGSOR = ….', 'Susut  ', 'Kerdil  ', 'Macet  ', 'Tertua  ', 'Menumpuk', 'b'),
(682, NULL, 'Psik1613561738', 'RENOVASI = ….', 'Pemagaran  ', 'Peningkatan  ', 'Pemugaran  ', 'Pemekaran  ', 'Pembongkaran', 'c'),
(683, NULL, 'Psik1613561738', 'ANTARIKSAWAN RUSIA = ….', 'Astronomi ', 'Astronesia  ', 'Atronomika  ', 'Astronout  ', 'Kosmonout', 'd'),
(684, NULL, 'Psik1613561738', 'BALAI YASA = ….', 'Rumah Sakit', 'Ruang Pertemuan  ', ' Rumah makan ', 'Bengkel Lokomotif ', 'Aula', 'd'),
(681, NULL, 'Psik1613561738', 'Soal untuk nomor 11-30. Pilihlah satu jawaban yang memiliki arti sama atau yang mendekati dengan arti kata yang dicetak dengan huruf kapital.\r\n\r\nRELATIF = ….', 'Biasa ', 'Ukuran  ', 'Nisbi  ', 'Statis  ', 'Pasti', 'c'),
(674, NULL, 'Psik1613561738', 'Suatu seri: 9-5-1-2-10-6-2-3-11 -7- …. seri selanjutnya dari seri tersebut adalah ', '3', '4', '5', '6', '7', 'a'),
(675, NULL, 'Psik1613561738', 'Suatu seri: 2-1-2-1-3-3-3-4-4- seri selanjutnya dari seri tersebut adalah', '3,4,7 ', '4,5,7  ', '5,4,7  ', '6,5,4  ', '7,4,5', 'c'),
(676, NULL, 'Psik1613561738', 'Suatu seri: 13-14-13-14-11-12-11-12-15-16-15-16-13 seri selanjutnya dari seri tersebut adalah', '11-15-13 ', '12-16-14', '14-13-14 ', '14-15-13', '13-14-13', 'c'),
(680, NULL, 'Psik1613561738', 'Suatu seri: 3-4-4-5-5-5-6-6-6 seri selanjutnya dari seri tersebut adalah', '5', '6', '7', '8', '9', 'b'),
(679, NULL, 'Psik1613561738', 'Suatu seri: 11-19-10-20-9-21-8 seri selanjutnya dari seri tersebut adalah', '22-7  ', '23-22 ', ' 7-24', '7-22', '29-26', 'a'),
(678, NULL, 'Psik1613561738', 'Suatu seri: 5-6-7-5-6-7-8-5-6-7-8-9 seri selanjutnya dari seri tersebut adalah', '5-6 ', '7-6  ', '9-10', '10-9', '12-9', 'a'),
(677, NULL, 'Psik1613561738', 'Suatu seri: 26-5-9-25-6-11-24-7 seri selanjutnya dari seri tersebut adalah', '9', '10', '11', '12', '13', 'e'),
(671, NULL, 'Psik1613561738', 'Selesaikan deret dibawah ini dengan memilih jawaban yang tepat.\r\n\r\nSeri: 100-4-90-7-80, dari seri tersebut adalah', ' 12  ', '11', '10', '9', '8', 'a'),
(673, NULL, 'Psik1613561738', 'Seri: 50-40-31-24-18- … seri selanjutnya dari seri tersebut adalah', '16  ', '15', '14', '16', '12', 'd'),
(672, NULL, 'Psik1613561738', '5-7-10-12-15 seri selanjutnya dari seret tersebut adalah', '13  ', '14', '12', '6', '4', 'e');

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

DROP VIEW IF EXISTS `berkas_pekerjaan_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `berkas_pekerjaan_overview`  AS SELECT `a`.`id` AS `id`, `a`.`kode_bahan` AS `kode_bahan`, `a`.`nama` AS `nama`, `a`.`tipe` AS `tipe`, `b`.`posisi_jabatan` AS `posisi_jabatan`, `b`.`id` AS `id_pekerjaan` FROM (`berkas_pekerjaan` `a` left join `pekerjaan` `b` on(`a`.`kode_bahan` = `b`.`kode_bahan`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `berkas_pelamar_view`
--
DROP TABLE IF EXISTS `berkas_pelamar_view`;

DROP VIEW IF EXISTS `berkas_pelamar_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `berkas_pelamar_view`  AS SELECT `a`.`id` AS `id`, `a`.`kode_bahan` AS `kode_bahan`, `a`.`nama` AS `nama`, `a`.`tipe` AS `tipe`, `b`.`nik` AS `nik`, `b`.`file_path` AS `file_path`, `b`.`id` AS `id_bahan_pelamar` FROM (`berkas_pekerjaan` `a` left join `pelamar_bahan` `b` on(`a`.`id` = `b`.`id_berkas`)) GROUP BY `a`.`id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `jadwal_ujian_overview`
--
DROP TABLE IF EXISTS `jadwal_ujian_overview`;

DROP VIEW IF EXISTS `jadwal_ujian_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jadwal_ujian_overview`  AS SELECT `a`.`id` AS `id`, `a`.`kode_ujian` AS `kode_ujian`, `a`.`kode_soal` AS `kode_soal`, `a`.`judul` AS `judul`, `a`.`mulai` AS `mulai`, `a`.`akhir` AS `akhir`, `b`.`posisi_jabatan` AS `posisi_jabatan`, `b`.`id` AS `id_pekerjaan`, (select count(`soal_ujian`.`id`) from `soal_ujian` where `soal_ujian`.`kode_soal` = `a`.`kode_soal`) AS `total_soal` FROM (`jadwal_ujian` `a` left join `pekerjaan` `b` on(`a`.`kode_ujian` = `b`.`kode_ujian`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pekerjaan_overview`
--
DROP TABLE IF EXISTS `pekerjaan_overview`;

DROP VIEW IF EXISTS `pekerjaan_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pekerjaan_overview`  AS SELECT `a`.`id` AS `id`, `a`.`posisi_jabatan` AS `posisi_jabatan`, `a`.`pendaftaran_mulai` AS `pendaftaran_mulai`, `a`.`pendaftaran_akhir` AS `pendaftaran_akhir`, `a`.`kode_bahan` AS `kode_bahan`, (select count(`berkas_pekerjaan`.`id`) from `berkas_pekerjaan` where `berkas_pekerjaan`.`kode_bahan` = `a`.`kode_bahan`) AS `total_berkas`, `a`.`kuota` AS `kuota`, `a`.`kode_ujian` AS `kode_ujian`, (select count(`jadwal_ujian`.`id`) from `jadwal_ujian` where `jadwal_ujian`.`kode_ujian` = `a`.`kode_ujian`) AS `total_ujian`, `a`.`tersedia` AS `tersedia` FROM `pekerjaan` AS `a` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelamar_bahan_overview`
--
DROP TABLE IF EXISTS `pelamar_bahan_overview`;

DROP VIEW IF EXISTS `pelamar_bahan_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelamar_bahan_overview`  AS SELECT `a`.`id` AS `id`, `a`.`nik` AS `nik`, `a`.`id_berkas` AS `id_berkas`, `a`.`file_path` AS `file_path`, `b`.`nama` AS `nama`, `b`.`tipe` AS `tipe`, `b`.`kode_bahan` AS `kode_bahan` FROM (`pelamar_bahan` `a` join `berkas_pekerjaan` `b` on(`a`.`id_berkas` = `b`.`id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelamar_jadwal_overview`
--
DROP TABLE IF EXISTS `pelamar_jadwal_overview`;

DROP VIEW IF EXISTS `pelamar_jadwal_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelamar_jadwal_overview`  AS SELECT `a`.`nik` AS `nik`, `a`.`id_posisi` AS `id_posisi`, `a`.`nama` AS `nama`, `b`.`posisi_jabatan` AS `posisi_jabatan`, `b`.`kode_ujian` AS `kode_ujian`, `c`.`kode_soal` AS `kode_soal`, `c`.`judul` AS `judul_ujian`, `c`.`standar_nilai` AS `standar_nilai` FROM ((`pelamar` `a` join `pekerjaan` `b` on(`a`.`id_posisi` = `b`.`id`)) left join `jadwal_ujian` `c` on(`b`.`kode_ujian` = `c`.`kode_ujian`)) ORDER BY `a`.`nik` ASC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pelamar_overview`
--
DROP TABLE IF EXISTS `pelamar_overview`;

DROP VIEW IF EXISTS `pelamar_overview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pelamar_overview`  AS SELECT `a`.`nik` AS `nik`, `a`.`id_posisi` AS `id_posisi`, `a`.`nama` AS `nama`, `a`.`jenis_kelamin` AS `jenis_kelamin`, `a`.`status` AS `status`, `a`.`pekerjaan` AS `pekerjaan`, `a`.`tinggi_badan` AS `tinggi_badan`, `a`.`berat_badan` AS `berat_badan`, `a`.`email` AS `email`, `a`.`hp` AS `hp`, `a`.`alamat` AS `alamat`, `a`.`username` AS `username`, `a`.`password` AS `password`, `b`.`posisi_jabatan` AS `posisi_jabatan` FROM (`pelamar` `a` join `pekerjaan` `b` on(`a`.`id_posisi` = `b`.`id`)) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
