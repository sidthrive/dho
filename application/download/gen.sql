-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2017 at 09:43 AM
-- Server version: 5.5.54-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gen_analytics`
--
CREATE DATABASE IF NOT EXISTS `gen_analytics` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

--
-- Database: `gen_dho`
--
CREATE DATABASE IF NOT EXISTS `gen_dho` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gen_dho`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('super','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `level`) VALUES
(1, 'super', 'd683390a10ac3179f3ac86d04da5ae3c', 'super'),
(2, 'admin', 'f3f1e21edfd5c4f0882b2ee7360d32d7', 'super');

-- --------------------------------------------------------

--
-- Table structure for table `dho_post`
--

CREATE TABLE IF NOT EXISTS `dho_post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` varchar(50) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_type` set('berita','artikel') NOT NULL DEFAULT 'berita',
  `guid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dho_post`
--

INSERT INTO `dho_post` (`id`, `post_author`, `post_date`, `post_content`, `post_title`, `post_type`, `guid`) VALUES
(1, '2', '2016-04-29 10:43:00', '<p>Selamat datang, ini adalah web reporting dashboard</p>', 'Selamat datang di website baru DHO', 'berita', 'berita/show?p=1'),
(2, '2', '2016-04-29 10:45:23', '<p>Reporting dashboard telah bisa digunakan</p>', 'Perkembangan Terbaru', 'berita', 'berita/show?p=2'),
(3, '2', '2016-04-29 12:18:11', 'Sebuah adaptasi lokal dan pilot ‘Open Smart Register Platform, sistem informasi kesehatan elektronikterintegrasi untuk meningkatkan kesehatan ibu dan bayi. Sebuah uji coba penelitian multi-site yang dilakukan di Indonesia, Pakistan, dan Bangladesh.\r\n\r\nPetugas kesehatan garis depan (FLHWs) adalah yang pertama dan sering kali merupakan satu-satunya titik kontak untuk dapat mengakses perawatan kesehatan bagi jutaan orang. Terutama di lingkungan terbatas sumber daya yang mengalami kekurangan dokter dan perawat terlatih, FLHWs merupakan tulang punggung dari sistem kesehatan. Namun, FLHWs sering tidak cukup terlatih, dan memiliki keterbatasan akses terhadap informasi kesehatan, alat dan bimbingan. Isolasi dan pelatihan dasar kader pekerja ini sering membatasi kemampuan mereka untuk memberikan lebih dari sekedar perawatan yang paling dasar, dengan kurangnya perawatan berkesinambungan untuk klien yang dilayani. Oleh karena hal ini, strategi mHealth telah dikembangkan untuk pengumpulan data, menyediakan terus pengembangan keterampilan dan pelatihan FLHWs, meningkatkan berbagai kegiatan kesehatan task-shifted, dan meningkatkan komunikasi antara berbagai tingkat sistem perawatan kesehatan, meningkatkan rujukan kesehatan darurat, dan motivasi keseluruhan FLHW. Sistem perawatan kesehatan Indonesia mempekerjakan ribuan petugas kesehatan perempuan garis depan, mengandalkan pendaftaran kesehatan berbasis kertas yang memberikan tantangan strategis untuk komunikasi, koordinasi, dan berbagi sumber daya di semua tingkat sistem kesehatan yang terdesentralisasi ini. Ada kebutuhan yang jelas dan mendesak untuk sistem informasi kesehatan terintegrasi untuk menghasilkan data yang berkualitas, mengurangi beban kerja petugas kesehatan garis depan, dan memberikan data secara real time untuk manajer program dan pembuat kebijakan untuk memandu strategi dan meningkatkan kesehatan.\r\n\r\nProyek ini bertujuan untuk beradaptasi dan mengikuti jejak sistem informasi elektronik, Open Smart Register Platform (OpenSRP), menyediakan platform kesehatan terpadu untuk meningkatkan efisiensi tenaga kerja garis depan, kualitas data, dan ketepatan waktu intervensi RMNCH untuk meningkatkan kesehatan ibu dan bayi. OpenSRP adalah sebuah platform mHealth – pendaftaran berbasis elektronik yang mencakup seluruh RMNCH kesinambungan perawatan dan intervensi inti terkait, seperti perawatan antenatal, perencanaan kelahiran, dan vaksinasi. Ini menggabungkan pengumpulan data, manajemen klien, dan alur kerja pelaporan ke dalam satu antarmuka ponsel terhubung. OpenSRP saat ini sedang dilaksanakan di India antara satu kader petugas kesehatan di garis depan dalam bentuk yang terlokalisir ke Karnataka State ANMs: dengan konten khusus untuk peran, tanggung jawab, jenis intervensi dan jadwal. OpenSRP belum dibuat menjadi alat generik untuk digunakan dan disesuaikan antara kader yang berbeda dari tenaga kesehatan di seluruh negara.\r\n\r\nHipotesis penelitian ini menyatakan bahwa OpenSRP meningkatkan efisiensi tenaga kerja garis depan, kualitas data, dan ketepatan waktu intervensi RMNCH, dibandingkan dengan penggunaan pendekatan informasi-sistem berbasis kertas. ‘THRIVE Tahap 1’ adalah penelitian multi-site yang akan dilakukan di Bangladesh, Indonesia, dan Pakistan. Ini terdiri dari penelitian formatif kualitatif untuk mengadaptasi OpenSRP, diikuti dengan uji coba lapangan kuasi-eksperimental untuk menilai penyebaran dan akan dilakukan selama periode 24 bulan. Penelitian ini terdiri dari tiga tahap dan empat tujuan yang saling terkait dengan keseluruhan tujuan untuk menentukan persyaratan adaptasi, komponen pelaksanaan, dan pengaruh sistem informasi elektronik sebagai intervensi terhadap kinerja petugas kesehatan dalam memberikan intervensi RMNCH. Temuan penelitian ini akan digunakan untuk menginformasikan tahap kedua penelitian, berjudul “THRIVE Tahap 2”, yang akan mencakup kemampuan uji coba multi-site terkontrol secara acak yang akan bertujuan untuk mengukur cakupan, kualitas pelaksanaan, peningkatan efektivitas biaya sistem kesehatan, dan dampak yang dihasilkan pada klien menggunakan Open Smart Register platform (OpenSRP) pada seluruh kader yang berfokus pada pemberian intervensi RMNCH.', 'THRIVE Indonesia', 'berita', 'berita/show?p=3');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE IF NOT EXISTS `hasil` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `id_tes` int(8) NOT NULL,
  `jawaban_benar` varchar(255) NOT NULL,
  `jawaban_salah` varchar(255) NOT NULL,
  `jml_jawaban_benar` int(4) NOT NULL,
  `jml_jawaban_salah` int(4) NOT NULL,
  `score` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE IF NOT EXISTS `jawaban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tes` int(8) NOT NULL,
  `tes_ke` int(4) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` enum('a','b','c','d','e','') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tes` (`id_tes`),
  KEY `id_soal` (`id_soal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1441 ;


-- --------------------------------------------------------

--
-- Table structure for table `jenis_tes`
--

CREATE TABLE IF NOT EXISTS `jenis_tes` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nama_tes` varchar(50) NOT NULL,
  `jumlah_soal` int(4) NOT NULL,
  `jumlah_tes` int(4) NOT NULL,
  `waktu` int(4) NOT NULL,
  `metode_tes` varchar(50) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jenis_tes`
--

INSERT INTO `jenis_tes` (`id`, `nama_tes`, `jumlah_soal`, `jumlah_tes`, `waktu`, `metode_tes`, `keterangan`) VALUES
(0, 'pre test', 5, 1, 10, 'random', 'untuk pre test'),
(3, 'Standarisasi Bidan', 30, 3, 30, 'random_categorized', 'Ini ujain untuk sertifikasi bidan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `id_jenis_tes` int(8) NOT NULL DEFAULT '3',
  `kategori` varchar(32) NOT NULL,
  `round` int(3) NOT NULL,
  `level` enum('mudah','sedang','sulit') NOT NULL,
  `alloc` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `id_jenis_tes`, `kategori`, `round`, `level`, `alloc`) VALUES
(1, 3, 'kehamilan/anc', 1, 'mudah', 4),
(2, 3, 'kehamilan/anc', 1, 'sedang', 3),
(3, 3, 'kehamilan/anc', 1, 'sulit', 2),
(4, 3, 'kehamilan/anc', 2, 'mudah', 2),
(5, 3, 'kehamilan/anc', 2, 'sedang', 3),
(6, 3, 'kehamilan/anc', 2, 'sulit', 4),
(7, 3, 'kehamilan/anc', 3, 'mudah', 3),
(8, 3, 'kehamilan/anc', 3, 'sedang', 3),
(9, 3, 'kehamilan/anc', 3, 'sulit', 4),
(10, 3, 'persalinan/nifas', 1, 'mudah', 3),
(11, 3, 'persalinan/nifas', 1, 'sedang', 4),
(12, 3, 'persalinan/nifas', 1, 'sulit', 4),
(13, 3, 'persalinan/nifas', 2, 'mudah', 2),
(14, 3, 'persalinan/nifas', 2, 'sedang', 5),
(15, 3, 'persalinan/nifas', 2, 'sulit', 4),
(16, 3, 'persalinan/nifas', 3, 'mudah', 3),
(17, 3, 'persalinan/nifas', 3, 'sedang', 3),
(18, 3, 'persalinan/nifas', 3, 'sulit', 4),
(19, 3, 'neonatus', 1, 'mudah', 1),
(20, 3, 'neonatus', 1, 'sedang', 1),
(21, 3, 'neonatus', 1, 'sulit', 0),
(22, 3, 'neonatus', 2, 'mudah', 0),
(23, 3, 'neonatus', 2, 'sedang', 2),
(24, 3, 'neonatus', 2, 'sulit', 0),
(25, 3, 'neonatus', 3, 'mudah', 0),
(26, 3, 'neonatus', 3, 'sedang', 0),
(27, 3, 'neonatus', 3, 'sulit', 1),
(28, 3, 'bayi', 1, 'mudah', 1),
(29, 3, 'bayi', 1, 'sedang', 0),
(30, 3, 'bayi', 1, 'sulit', 0),
(31, 3, 'bayi', 2, 'mudah', 0),
(32, 3, 'bayi', 2, 'sedang', 1),
(33, 3, 'bayi', 2, 'sulit', 0),
(34, 3, 'bayi', 3, 'mudah', 0),
(35, 3, 'bayi', 3, 'sedang', 2),
(36, 3, 'bayi', 3, 'sulit', 0),
(37, 3, 'pencegahan infeksi', 1, 'mudah', 1),
(38, 3, 'pencegahan infeksi', 1, 'sedang', 0),
(39, 3, 'pencegahan infeksi', 1, 'sulit', 0),
(40, 3, 'pencegahan infeksi', 2, 'mudah', 0),
(41, 3, 'pencegahan infeksi', 2, 'sedang', 1),
(42, 3, 'pencegahan infeksi', 2, 'sulit', 0),
(43, 3, 'pencegahan infeksi', 3, 'mudah', 0),
(44, 3, 'pencegahan infeksi', 3, 'sedang', 1),
(45, 3, 'pencegahan infeksi', 3, 'sulit', 0),
(46, 3, 'kegawat daruratan', 1, 'mudah', 0),
(47, 3, 'kegawat daruratan', 1, 'sedang', 1),
(48, 3, 'kegawat daruratan', 1, 'sulit', 0),
(49, 3, 'kegawat daruratan', 2, 'mudah', 0),
(50, 3, 'kegawat daruratan', 2, 'sedang', 1),
(51, 3, 'kegawat daruratan', 2, 'sulit', 0),
(52, 3, 'kegawat daruratan', 3, 'mudah', 0),
(53, 3, 'kegawat daruratan', 3, 'sedang', 1),
(54, 3, 'kegawat daruratan', 3, 'sulit', 0),
(55, 3, 'kb', 1, 'mudah', 1),
(56, 3, 'kb', 1, 'sedang', 0),
(57, 3, 'kb', 1, 'sulit', 0),
(58, 3, 'kb', 2, 'mudah', 0),
(59, 3, 'kb', 2, 'sedang', 1),
(60, 3, 'kb', 2, 'sulit', 0),
(61, 3, 'kb', 3, 'mudah', 0),
(62, 3, 'kb', 3, 'sedang', 1),
(63, 3, 'kb', 3, 'sulit', 0),
(64, 3, 'asuhan kebidanan', 1, 'mudah', 2),
(65, 3, 'asuhan kebidanan', 1, 'sedang', 0),
(66, 3, 'asuhan kebidanan', 1, 'sulit', 0),
(67, 3, 'asuhan kebidanan', 2, 'mudah', 0),
(68, 3, 'asuhan kebidanan', 2, 'sedang', 1),
(69, 3, 'asuhan kebidanan', 2, 'sulit', 2),
(70, 3, 'asuhan kebidanan', 3, 'mudah', 0),
(71, 3, 'asuhan kebidanan', 3, 'sedang', 0),
(72, 3, 'asuhan kebidanan', 3, 'sulit', 2),
(73, 3, 'pencatatan/pelaporan', 1, 'mudah', 1),
(74, 3, 'pencatatan/pelaporan', 1, 'sedang', 1),
(75, 3, 'pencatatan/pelaporan', 1, 'sulit', 0),
(76, 3, 'pencatatan/pelaporan', 2, 'mudah', 0),
(77, 3, 'pencatatan/pelaporan', 2, 'sedang', 0),
(78, 3, 'pencatatan/pelaporan', 2, 'sulit', 1),
(79, 3, 'pencatatan/pelaporan', 3, 'mudah', 0),
(80, 3, 'pencatatan/pelaporan', 3, 'sedang', 0),
(81, 3, 'pencatatan/pelaporan', 3, 'sulit', 2);

-- --------------------------------------------------------

--
-- Table structure for table `on_going`
--

CREATE TABLE IF NOT EXISTS `on_going` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `id_tes` int(8) NOT NULL,
  `tes_ke` int(8) NOT NULL,
  `waktu_start` datetime NOT NULL,
  `aktif` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `id_tes` (`id_tes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;


-- --------------------------------------------------------

--
-- Table structure for table `page_views`
--

CREATE TABLE IF NOT EXISTS `page_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `tab` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6290 ;


-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE IF NOT EXISTS `soal` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `id_jenis_tes` int(8) NOT NULL,
  `kategori` varchar(32) NOT NULL DEFAULT 'none',
  `pertanyaan` text NOT NULL,
  `pilihan_a` text NOT NULL,
  `pilihan_b` text NOT NULL,
  `pilihan_c` text NOT NULL,
  `pilihan_d` text NOT NULL,
  `pilihan_e` text NOT NULL,
  `jawaban` enum('a','b','c','d','e') NOT NULL,
  `level_of_importance` enum('1','2','3','4','5') NOT NULL DEFAULT '3',
  `level` enum('mudah','sedang','sulit') NOT NULL DEFAULT 'sedang',
  `publish` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `id_jenis_tes` (`id_jenis_tes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=454 ;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `id_jenis_tes`, `kategori`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `pilihan_e`, `jawaban`, `level_of_importance`, `level`, `publish`) VALUES
(1, 1, 'none', '<p><img src="http://localhost/dho/assets/source/summit-institute-of-development.jpg?1463298097038" alt="summit-institute-of-development" /></p>\r\n<p>Gambar di atas adalah logo organisasi mana?</p>', '<p>Jawaban A</p>', '<p>Jawaban B</p>', '<p>Jawaban C</p>', '<p>Jawaban D</p>', '<p>Jawaban E</p>', 'a', '3', 'sedang', 'yes'),
(2, 1, 'none', 'Pertanyaan 2', 'Jawaban A', 'Jawaban B', 'Jawaban C', 'Jawaban D', 'Jawaban E', 'b', '3', 'sedang', 'yes'),
(3, 1, 'none', 'Pertanyaan 3', 'Jawaban A', 'Jawaban B', 'Jawaban C', 'Jawaban D', 'Jawaban E', 'a', '3', 'sedang', 'yes'),
(4, 1, 'none', 'Pertanyaan 4', 'Jawaban A', 'Jawaban B', 'Jawaban C', 'Jawaban D', 'Jawaban E', 'd', '3', 'sedang', 'yes'),
(5, 1, 'none', 'Pertanyaan 5', 'Jawaban A', 'Jawaban B', 'Jawaban C', 'Jawaban D', 'Jawaban E', 'd', '3', 'sedang', 'yes'),
(6, 1, 'none', 'Pertanyaan 6', 'Jawaban A', 'Jawaban B', 'Jawaban C', 'Jawaban D', 'Jawaban E', 'c', '3', 'sedang', 'yes'),
(7, 1, 'none', 'Pertanyaan 7', 'Jawaban A', 'Jawaban B', 'Jawaban C', 'Jawaban D', 'Jawaban E', 'a', '3', 'sedang', 'yes'),
(8, 1, 'none', 'Pertanyaan 8', 'Jawaban A', 'Jawaban B', 'Jawaban C', 'Jawaban D', 'Jawaban E', 'e', '3', 'sedang', 'yes'),
(9, 1, 'none', 'Pertanyaan 9', 'Jawaban A', 'Jawaban B', 'Jawaban C', 'Jawaban D', 'Jawaban E', 'c', '3', 'sedang', 'yes'),
(10, 1, 'none', '<p>Pertanyaan 10</p>', '<p>Jawaban A</p>', '<p>Jawaban B</p>', '<p>Jawaban C</p>', '<p>Jawaban D</p>', '', 'a', '3', 'sedang', 'yes'),
(11, 2, 'none', '<p>Pertanyaan 1</p>', '<p><img src="/assets/source/167px-Flag_of_Bahrain.svg.png?1463448937941" alt="167px-Flag_of_Bahrain.svg" /></p>', '<p>&nbsp;<img src="/assets/source/Flag_of_Poland.svg.png?1463448931491" alt="Flag_of_Poland.svg" /></p>', '<p>`1/2+2/3`</p>', '<p>`(b+-sqrt(d^2-4ac))/(2a)`</p>', '<p>Jawaban E lah</p>', 'c', '3', 'sedang', 'yes'),
(12, 0, 'none', '<p>Apa fungsi mata pada manusia?</p>', '<p>Alat penglihatan</p>', '<p>Alat penciuman</p>', '<p>Alat perasa</p>', '<p>Alag bernafas</p>', '', 'a', '3', 'sedang', 'yes'),
(13, 0, 'none', '<p>Berapa jumlah telinga yang dimiliki kucing?</p>', '<p>Satu</p>', '<p>Dua</p>', '<p>Tiga</p>', '<p>Empat</p>', '<p>Lima</p>', 'b', '3', 'sedang', 'yes'),
(14, 0, 'none', '<p>Apakah warna langit di siang hari?</p>', '<p>Hitam</p>', '<p>Ungu</p>', '<p>Biru</p>', '<p>Coklat</p>', '<p>Kuning</p>', 'c', '3', 'sedang', 'yes'),
(15, 0, 'none', '<p>Berapa hasil dari 1+1</p>', '<p>2</p>', '<p>3</p>', '<p>4</p>', '<p>5</p>', '<p>6</p>', 'a', '3', 'sedang', 'yes'),
(16, 0, 'none', '<p>Binatang manakah dibawah ini yang dapat terbang?</p>', '<p>Kucing</p>', '<p>Burung</p>', '<p>Kodok</p>', '<p>Ikan</p>', '<p>Laba-laba</p>', 'b', '3', 'sedang', 'yes'),
(17, 3, 'kehamilan/anc', 'Ibu Ani, 26 tahun, datang ke polindes untuk memeriksakan kehamilannya. Usia kehamilan 30 minggu. Pada pemeriksaan DJJ terdengar diatas pusar, dan ibu mengeluh mengeluarkan darah segar dari jalan lahir saat bangun tidur dan tidak nyeri. Berdasarkan data di atas, kesimpulan sementara untuk Ny. Ani adalah..', 'Vasa previa', 'Plasenta previa', 'Solusio plasenta', 'Persalinan prematur', '', 'b', '3', 'mudah', 'yes'),
(18, 3, 'kehamilan/anc', 'Ibu Ani, 26 tahun, datang ke polindes untuk memeriksakan kehamilannya. Usia kehamilan 30 minggu. Pada pemeriksaan, DJJ terdengar diatas pusar dan ibu mengeluh mengeluarkan darah segar dari jalan lahir saat bangun tidur dan tidak nyeri. Pengaruh kasus Ny. Ani terhadap kehamilan adalah..', 'Cacat bawaan', 'BBLR', 'Kelainan letak', 'Ketuban pecah dini', '', 'c', '3', 'mudah', 'yes'),
(19, 3, 'kehamilan/anc', 'Temu wicara (konseling) dilakukan pada setiap kunjungan ANC yang meliputi', 'Konseling kesehatan ibu, perilaku hidup bersih dan sehat, peran suami/keluarga dalam kehamilan dan perencanaan persalinan', 'Konseling tanda bahaya pada kehamilan, persalinan dan nifas serta kesiapan menghadapi komplikasi, asupan gizi seimbang', 'Konseling gejala penyakit menular dan tidak menular, penawaran untuk melakukan tes HIV dan konseling di daerah epidemi meluas dan terkonsentrasi atau ibu hamil dengan IMS dan TB di daerah epidemi rendah, insiasi menyusu dini, pemberian ASI eksklusif', 'KB paska persalinan, imunisasi, peningkatan kesehatan intelegensia pada kehamilan (Brain Booster), pendidikan anak', '', 'd', '4', 'mudah', 'yes'),
(20, 3, 'kehamilan/anc', 'Pencatatan pelayanan ANC terpadu harus dilakukan pada formulir berikut, kecuali..', 'Kartu Ibu', 'Kohort Ibu', 'Buku KIA', 'Kohort Bayi', '', 'd', '2', 'mudah', 'yes'),
(21, 3, 'kehamilan/anc', 'Pelaporan pelayanan ANC terpadu menggunakan formulir pelaporan berikut, kecuali..', 'LB3 KIA', 'PWS KIA', 'PWS Imunisasi', 'Buku KIA', '', 'd', '2', 'mudah', 'yes'),
(22, 3, 'kehamilan/anc', 'Pelayanan ANC terpadu adalah pelayanan ANC komprehensif dan berkualitas yang diberikan kepada semua ibu hamil dan bayi', 'Benar', 'Salah', '', '', '', 'b', '2', 'mudah', 'yes'),
(23, 3, 'kehamilan/anc', 'Pelayanan ANC terpadu adalah pelayanan ANC komprehensif dan berkualitas yang diberikan kepada semua ibu hamil', 'Benar', 'Salah', '', '', '', 'a', '2', 'mudah', 'yes'),
(24, 3, 'kehamilan/anc', 'Penambahan berat badan yang kurang dari 9 kilogram selama kehamilan atau kurang dari 1 kilogram setiap bulannya menunjukkan adanya gangguan pertumbuhan janin', 'Benar', 'Salah', '', '', '', 'a', '3', 'mudah', 'yes'),
(25, 3, 'kehamilan/anc', 'Pada tanggal 15 Juni 2016, Ny. Dewi G2P1A0 umur 28 tahun datang ke bidan polindes untuk memeriksakan kehamilannya. HPHT 15 Oktober 2015. Umur kehamilan Ny. Dewi adalah..', '34 minggu', '35 minggu', '36 minggu', '37 minggu', '', 'a', '3', 'sedang', 'yes'),
(26, 3, 'kehamilan/anc', 'Pada tanggal 15 Juni 2016, Ny. Dewi G2P1A0 umur 28 tahun datang ke bidan polindes untuk memeriksakan kehamilannya. HPHT 15 Oktober 2015. Taksiran persalianan Ny. Dewi adalah..', '22 Juni 2016', '24 Juni 2016', '22 Juli 2016', '24 Juli 2016', '', 'c', '3', 'sedang', 'yes'),
(27, 3, 'kehamilan/anc', 'Pemeriksaan laboratorium dilakukan pada saat ANC meliputi', 'Pemeriksaan golongan darah, kadar hemoglobin darah, protein dalam urin', 'Pemeriksaan kadar gula darah, darah malaria, sifilis', 'Pemeriksaan BTA, HIV, sifilis', 'Pemeriksaan kadar insulin, kadar hemoglobin, kadar gula darah', '', 'd', '4', 'sedang', 'yes'),
(28, 3, 'kehamilan/anc', 'Pemeriksaan kadar hemoglobin darah (Hb) pada ibu hamil dilakukan minimal 2 kali pada', 'Sekali pada trimester pertama dan sekali pada trimester ke-tiga', 'Sekali pada trimester pertama dan sekali pada trimester ke-dua', 'Sekali pada trimester ke-dua dan sekali pada trimester ke-tiga', '', '', 'a', '4', 'sedang', 'yes'),
(29, 3, 'kehamilan/anc', 'Kapan seharusnya dilakukan pemeriksaan protein dalam urin?', 'Pada trimester ke-dua dan ke-tiga atas indikasi', 'Pada trimester ke-dua dan ke-tiga tanpa indikasi', 'Pada trimester pertama dan ke-tiga atas indikasi', 'Pada trimester pertama dan ke-tiga tanpa indikasi', '', 'a', '4', 'sedang', 'yes'),
(30, 3, 'kehamilan/anc', 'Salah satu tujuan khusus pelayanan ANC terpadu adalah untuk menghilangkan "missed opportunity" pada ibu hamil dalam mendapatkan pelayanan postnatal terpadu, komprehensif, dan berkualitas', 'Benar', 'Salah', '', '', '', 'b', '2', 'sedang', 'yes'),
(31, 3, 'kehamilan/anc', 'K1 adalah kontak pertama yang harus dilakukan sedini mungkin pada trimester pertama, sebaiknya sebelum minggu ke- 6 sampai 8', 'Benar', 'Salah', '', '', '', 'a', '4', 'sedang', 'yes'),
(32, 3, 'kehamilan/anc', 'Kunjungan ANC bisa kurang dari 4 kali sesuai kebutuhan dan jika ada keluhan, penyakit, atau gangguan kehamilan', 'Benar', 'Salah', '', '', '', 'b', '5', 'sedang', 'yes'),
(33, 3, 'kehamilan/anc', 'Kunjungan ANC bisa lebih dari 4 kali sesuai kebutuhan dan jika ada keluhan, penyakit, atau gangguan kehamilan', 'Benar', 'Salah', '', '', '', 'a', '4', 'sedang', 'yes'),
(34, 3, 'kehamilan/anc', 'Ny. "A" datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke Poskesdes untuk pertama kalinya. Menurut Ny. "A", ia hamil 3 bulan. HPHT=12 Marert 2015. Keluhan yang muncul ialah mual dan muntah pada pagi hari. Pemeriksaan penunjang yang dilakukan bidan untuk menegakkan diagnosis adalah?', 'Pemeriksaan darah', 'Pemeriksaan plano test', 'Pemeriksaan protein urine', 'Pemeriksaan USG', '', 'b', '3', 'mudah', 'yes'),
(35, 3, 'kehamilan/anc', 'Ny. "A" datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke Poskesdes untuk pertama kalinya. Menurut Ny. "A", ia hamil 3 bulan. HPHT=12 Marert 2015. Hari perkiraan lahir bayi Ny. "A" adalah..', '19 September 2015', '10 Desember 2015', '12 Desember 2015', '19 Desember 2015', '', 'd', '5', 'mudah', 'yes'),
(36, 3, 'kehamilan/anc', 'Ny. "A" datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke Poskesdes untuk pertama kalinya. Menurut Ny. "A", ia hamil 3 bulan. HPHT=12 Marert 2015. Keluhan yang muncul ialah mual dan muntah pada pagi hari. Anjuran apa yang tepat diberikan kepada Ny. "A" berdasarkan keluhan yang dirasakan?', 'Minum tablet sulfa ferosus (SF)', 'Minum kalsium dosis tinggi', 'Mengkonsumsi tablet vitamin E', 'Makan porsi kecil, frekuensi lebih sering', '', 'd', '5', 'mudah', 'yes'),
(37, 3, 'kehamilan/anc', 'Ny. "A" datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke Poskesdes untuk pertama kalinya. Menurut Ny. "A", ia hamil 3 bulan. HPHT=12 Marert 2015. Waktu kunjungan ulang yang tepat pada Ny. "A" adalah..', 'Satu minggu lagi', 'Dua minggu lagi', 'Satu bulan lagi', 'Dua bulan lagi', '', 'c', '3', 'mudah', 'yes'),
(38, 3, 'kehamilan/anc', 'Apa saja tanda-tanda bahaya kehamilan pada hamil muda?', 'Muntah terus dan tidak mau makan', 'Bengkak pada kaki dan wajah', 'sakit kepala disertai kejang', 'Keluar air ketuban', '', 'a', '3', 'mudah', 'yes'),
(39, 3, 'kehamilan/anc', 'Hal-hal yang harus dihindari selama kehamilan?', 'Istirahat yang cukup', 'Makan-makanan yang bergizi', 'Menjaga kebersihan diri', 'Merokok dan terpapar asap rokok', '', 'd', '3', 'mudah', 'yes'),
(40, 3, 'kehamilan/anc', 'Apa saja yang tidak boleh dikonsumsi ibu hamil?', 'Makanan bergizi seimbang dan bervariasi, lebih banyak dari sebelum hamil', 'Tidak ada pantangan makanan selama hamil', 'Cukupi kebutuhan air minum ibu hamil 10 gelas/hari', 'Minum-minuman keras dan merokok', '', 'd', '3', 'mudah', 'yes'),
(41, 3, 'kehamilan/anc', 'Ny. Ani datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke polindes untuk pertama kalinya. HPHT 12 Maret 2015. Keluhan yang muncul adalah mual dan muntah pada pagi hari. Umur kehamilan Ny. Ani adalah..', '9 minggu', '10 minggu', '11 minggu', '12 minggu', '', 'd', '2', 'mudah', 'yes'),
(42, 3, 'kehamilan/anc', 'Ny. Ani datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke polindes untuk pertama kalinya. HPHT 12 Maret 2015. Keluhan yang muncul adalah mual dan muntah pada pagi hari. Hari perkiraan lahir bayi Ny. Ani adalah..', '19 November 2015', '10 Desember 2015', '12 Desember 2015', '19 Desember 2015', '', 'd', '3', 'mudah', 'yes'),
(43, 3, 'kehamilan/anc', 'Ny. Ani datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke polindes untuk pertama kalinya. HPHT 12 Maret 2015. Keluhan yang muncul adalah mual dan muntah pada pagi hari. Anjuran apa yang tepat diberikan kepada Ny. Ani berdasarkan keluhan yang dirasakan..', 'Minum tablet sulfat ferosus', 'Minum kalsium dosis tinggi', 'Mengkonsumsi tablet vitamin E', 'Makan porsi kecil, frekuensi lebih sering', '', 'd', '2', 'mudah', 'yes'),
(44, 3, 'kehamilan/anc', 'Ny. Ani datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke polindes untuk pertama kalinya. HPHT 12 Maret 2015. Keluhan yang muncul adalah mual dan muntah pada pagi hari. Waktu kunjungan ulang yang tepat bagi Ny. Ani adalah..', 'Satu minggu lagi', 'Dua minggu lagi', 'Satu bulan lagi', 'Dua bulan lagi', '', 'c', '2', 'mudah', 'yes'),
(45, 3, 'kehamilan/anc', 'Ny. Dian dengan G2P0A0, umur 22 tahun, hamil 36 minggu, menyatakan ingin memeriksakan ulang kehamilan ke bidan. Hasil pemeriksaan TFU 27 cm, kepala belum masuk panggul. TBJ pada bayi Ny. Dian adalah..', '2635 gram', '2790 gram', '2735 gram', '2325 gram', '', 'd', '2', 'mudah', 'yes'),
(46, 3, 'kehamilan/anc', 'Pemberian minimal tablet Fe pada ibu hamil selama kehamilan yaitu?', '30 tablet', '60 tablet', '90 tablet', '10 tablet', '100 tablet', 'c', '3', 'mudah', 'yes'),
(47, 3, 'kehamilan/anc', 'Tanda bahaya kehamilan meliputi?', 'Perdarahan', 'Bengkak pada wajah dan ekstremitas', 'Gerakan janin berkurang', 'Semua jawaban benar', 'Semua jawaban salah', 'd', '3', 'mudah', 'yes'),
(48, 3, 'kehamilan/anc', 'Tenaga kesehatan yang boleh menolong persalinan yaitu?', 'Dokter', 'Dokter spesialis kebidanan', 'Bidan', 'Perawat', 'Jawaban A, B, dan C benar', 'e', '3', 'mudah', 'yes'),
(49, 3, 'kehamilan/anc', 'Tenaga kesehatan yang berkompeten memberika pelayanan ANC pada ibu hamil yaitu?', 'Dokter', 'Dokter spesialis kebidanan', 'Bidan', 'Perawat', 'Jawaban A, B,C, dan D benar', 'e', '3', 'mudah', 'yes'),
(50, 3, 'kehamilan/anc', 'Penambahan berat badan ibu hamil yang normal selama masa kehamilan yaitu?', '10 kg', '7 kg', '7 - 10 kg', '9 - 12 kg', '20 kg', 'd', '3', 'mudah', 'yes'),
(51, 3, 'kehamilan/anc', 'Hipertensi dalam kehamilan ditandai dengan?', 'Tekanan darah >140/>90 mmHg', 'Dengan atau tanpa edema pre-tibial', 'Tekanan darah 120/100 mmHg', 'Jawaban A dan B benar', 'Semua jawaban salah', 'd', '3', 'mudah', 'yes'),
(52, 3, 'kehamilan/anc', 'Leopold 1 bertujuan untuk?', 'Menentukan TFU', 'Mengetahui presentasi janin', 'Menentukan usia kehamilan', 'Mengetahui sudah masuk PAP atau belum', 'A dan C benar', 'e', '3', 'mudah', 'yes'),
(53, 3, 'kehamilan/anc', 'Akibat KEK pada ibu hamil yaitu?', 'BBLR', 'Perdarahan', 'Kelainan kongenital', 'Tidak ada yang benar', 'Benar semua', 'b', '3', 'mudah', 'yes'),
(54, 3, 'kehamilan/anc', 'Tujuan leopold III yaitu', 'Menentukan TFU', 'Mengetahui presentasi janin', 'Menentukan usia kehamilan', 'Mengetahui sudah masuk PAP atau belum', 'A dan C benar', 'b', '3', 'mudah', 'yes'),
(55, 3, 'kehamilan/anc', 'Sebutkan 3 tahap penting tumbang kehamilan!', 'Ovum – Embrio – Janin', 'Janin – ovum – embrio', 'Embrio – janin – ovum', 'Janin – embrio - ovum', '', 'a', '3', 'mudah', 'yes'),
(56, 3, 'kehamilan/anc', 'Berapa kenaikan berat badan ibu hamil?', '6,5 kg – 16,5 kg', '2 kg – 4 kg', '4 kg – 10 kg', '3,5 kg – 8,5 kg', '7 kg – 18 kg', 'a', '3', 'mudah', 'yes'),
(57, 3, 'kehamilan/anc', 'Dibawah ini pengelompokan tanda kehamilan kecuali..', 'Tanda tidak pasti', 'Tanda pasti', 'Tanda tidak mungkin', 'A dan B benar', '', 'c', '3', 'mudah', 'yes'),
(58, 3, 'kehamilan/anc', 'Suatu kehamilan dinyatakan bermasalah jika menunjukkan tanda gejala berikut kecuali..', 'Janin bergerak aktif', 'Perdarahan pervaginam', 'Bengkak pada muka dan tangan', 'Pandangan mata kabur', 'Mual dan muntah berlebihan', 'a', '4', 'mudah', 'yes'),
(59, 3, 'kehamilan/anc', 'Dibawah ini yang merupakan tanda pasti kehamilan adalah..', 'Mual', 'Payudara membesar', 'Terdengar denyut jantung janin', 'Perut membesar', 'Tidak Haid', 'c', '3', 'mudah', 'yes'),
(60, 3, 'kehamilan/anc', 'Selama kehamilan trimester awal, ibu hamil wajib melakukan pemeriksaan yang lebih dikenal dengan K1, sebanyak..', 'I Kali', '2 Kali', '3 Kali', '4 Kali', '5 Kali', 'a', '3', 'mudah', 'yes'),
(61, 3, 'kehamilan/anc', 'Jika diketahui HPHT 29 November 2011, berapa UK saat 3 Mei 2012..', '22 minggu + 1 Hari', '22 minggu + 2 Hari', '26 minggu + 1 hari', '26 minggu + 2 hari', '27 minggu', 'b', '4', 'mudah', 'yes'),
(62, 3, 'kehamilan/anc', 'Perubahan yang terjadi pada ibu hamil adalah, kecuali..', 'Uterus', 'Berat badan', 'Ovarium', 'Mammae', 'Suhu tubuh', 'e', '2', 'mudah', 'yes'),
(63, 3, 'kehamilan/anc', 'Palpasi untuk menentukan letak punggung janin menggunakan tehnik pemeriksaan yang disebut dengan..', 'Leopold I', 'Leopold II', 'Leopold III', 'Leopold IV', 'Leopold V', 'b', '2', 'mudah', 'yes'),
(64, 3, 'kehamilan/anc', 'Seorang perempuan usia 30 tahun datang ke BPM dengan keluhan terlambat haid selama 3 minggu, saat ini merasa mual muntah dipagi hari. Hasil pemeriksaan pemeriksaan KU ibu baik TD 110/70 mmHg, N 84 x/menit, R 24 x/menit, S 36 ◦C. Apakah pemeriksaan penunjang yang dilakukan untuk menegakkan diagnosa?', 'Urin HCG', 'Urin aceton', 'Urin reduksi', 'Urin protein', 'Urin glukosa', 'a', '2', 'mudah', 'yes'),
(65, 3, 'kehamilan/anc', 'Seorang perempuan berusia 27 tahun G1P0A0 usia kehamilan 10 minggu datang ke BPM mengeluh mual muntah setiap makan, hasil pemeriksaan KU ibu baik TD: 110/80 mmHg, N: 88 x/menit, R: 20 x/menit, S: 36.5 ◦C. Bagaimanakah cara mengatasi keluhan pada kasus di atas?', 'Makan makanan asam', 'Makan makanan yang pedas', 'Makan coklat sedikit demi sedikit', 'Makan sedikit - sedikit tapi sering', 'Makan makanan yang bersantan', 'd', '2', 'mudah', 'yes'),
(66, 3, 'kehamilan/anc', 'Seorang perempuan berusia 25 tahun datang ke RSU dengan keluhan tidak haid kurang lebih 3 bulan. Ia mengeluh mual pada pagi hari. Ia mengatakan anak pertama baru berusia 1 tahun, menggunakan KB Pil tapi tidak rutin diminum setiap hari karena lupa. Hasil pemeriksaan Bidan: TD 110/80 mmHg, Nadi 80 x/menit, teraba ballotement, dan pemeriksaan Hb 12 gr%. Apakah tindakan yang akan anda berikan untuk kasus diatas?', 'Pemeriksaan USG', 'Pemeriksaan HSG', 'Pemeriksaan Urine', 'Pemeriksaan Darah', 'Pemeriksaan Radiologi', 'c', '3', 'mudah', 'yes'),
(67, 3, 'kehamilan/anc', 'Seorang perempuan usia 27 tahun datang ke BPM mengaku hamil anak ke-3 belum pernah keguguran. Hasil anamnesa didapatkan ibu tidak ingat HPHT, pergerakan janin pertama kali dirasakan ibu kemarin. Berdasarkan data di atas, berapa usia kehamilan ibu?', '16 minggu', '17 minggu', '18 minggu', '19 minggu', '20 minggu', 'e', '3', 'mudah', 'yes'),
(68, 3, 'kehamilan/anc', 'Seorang perempuan 25 tahun datang ke RS mau periksa hamil mengaku hamil anak ke dua. Hasil pengkajian diketahui klien tidak mendapat haid sejak 2 bulan yang lalu. Hasil pemeriksaan TTV dalam batas normal kapankah kilen dianjurkan ANC ulang?', 'Satu minggu lagi', 'Dua minggu lagi', 'Tiga minggu lagi', 'Empat minggu lagi', 'Lima minggu lagi', 'd', '3', 'mudah', 'yes'),
(69, 3, 'kehamilan/anc', 'Seorang perempuan G1P0A0 hamil 20 minggu datang ke BPM untuk pertama kali ANC. Hasil pemeriksaan dalam keadaan normal. Asuhan Kebidanan yang diberikan oleh bidan adalah memberikan imunisasi tetanus toksoid. Apakah tujuan tindakan yang dilakukan?', 'Mencegah Tetanus pada ibu', 'Mencegah Tetanus pada bayi', 'Mencegah Tetanus pada petugas', 'Mencegah Tetanus pada ibu dan bayi', 'Mencegah Tetanus pada petugas dan ibu', 'd', '3', 'mudah', 'yes'),
(70, 3, 'kehamilan/anc', 'Berikut adalah elemen dari EMPAT TERLALU (faktor - faktor yang memperberat keadaan ibu hamil), kecuali..', 'Terlalu muda', 'Terlalu tua', 'Terlalu sering melahirkan', 'Terlalu banyak abortus', 'Terlalu dekat jarak kelahiran', 'd', '4', 'mudah', 'yes'),
(71, 3, 'kehamilan/anc', 'Berikut penyebab anemia pada ibu hamil, kecuali..', 'Kurang yodium', 'Kurang asupan zat besi', 'Kecacingan', 'Malaria', '', 'a', '4', 'mudah', 'yes'),
(72, 3, 'kehamilan/anc', 'Siapakah sasaran pelayanan ANC terpadu?', 'Semua ibu hamil', 'Ibu hamil ganda', 'Ibu hamil yang memiliki resiko tinggi', 'Ibu hamil tunggal', '', 'a', '4', 'mudah', 'yes'),
(73, 3, 'kehamilan/anc', 'Berikut indikator pada pelayanan ANC terpadu, kecuali..', 'K1', 'K2', 'K4', 'Penanganan Komplikasi (PK)', '', 'b', '4', 'mudah', 'yes'),
(74, 3, 'kehamilan/anc', 'Komplikasi kebidanan, penyakit, dan masalah gizi yang sering terjadi, kecuali..', 'Pendarahan, preeklampsia, persalinan macet', 'Infeksi, abortus, malaria', 'HIV/AIDS, sifilis, TB', 'Hipertensi, KEK, kelainan jantung', 'Diabetes melitus, anemia gizi besi, abortus', 'd', '4', 'mudah', 'yes'),
(75, 3, 'kehamilan/anc', 'Ibu hamil dengan status imunisasi TT manakah yang tidak perlu diberikan imunisasi TT lagi?', 'Imunisasi T2', 'Imunisasi T3', 'Imunisasi T5', 'Imunisasi T4', '', 'c', '2', 'mudah', 'yes'),
(76, 3, 'kehamilan/anc', 'sampai imunisasi TT ke-berapakah yang harus dimiliki oleh ibu hamil?', 'Imunisasi T2', 'Imunisasi T3', 'Imunisasi T5', 'Imunisasi T4', '', 'a', '2', 'mudah', 'yes'),
(77, 3, 'kehamilan/anc', 'Berikut tindak lanjut kasus dimana ibu hamil memiliki hipertensi ringan (tekanan darah >= 140/90 mmHg) tanpa proteinuria, kecuali..', 'Tangani hipertensi sesuai standar', 'Periksa ulang dalam 2 hari, jika tekanan darah meningkat, segera rujuk', 'Jika ada gangguan janin, segera rujuk', 'Konseling gizi, diet makanan untuk hipertensi dalam kehamilan', 'Rujuk untuk mendapatkan suntikan vaksin sesuai status imunisasinya', 'e', '2', 'mudah', 'yes'),
(78, 3, 'kehamilan/anc', 'Berikut tanda - tanda ibu hamil dengan pre-eklampsia, kecuali..', 'Hipertensi', 'Edema wajah', 'Edema tungkai bawah', 'Proteinuria', 'Edema tungkai atas', 'e', '2', 'mudah', 'yes'),
(79, 3, 'kehamilan/anc', 'Berikut tindak lanjut kasus dimana ibu hamil memiliki terinfeksi tuberkolosis, kecuali..', 'Rujuk untuk penanganan TB sesuai standar', 'Konseling gizi dan diet makanan untuk penurunan berat badan', 'Pemantauan minum obat TB', 'Tawarkan tes HIV', '', 'b', '4', 'mudah', 'yes'),
(80, 3, 'kehamilan/anc', 'Berikut tindak lanjut kasus dimana ibu hamil memiliki terinfeksi HIV, kecuali..', 'Konseling rencana persalinan', 'Rujuk untuk penanganan HIV sesuai standar', 'Konseling pemberian makan bayi yang lahir dari ibu dengan HIV', 'Penyaranan pengguguran bayi', '', 'd', '2', 'mudah', 'yes'),
(81, 3, 'kehamilan/anc', 'Preeklampsia adalah hipertensi disertai edema wajah dan/atau tungkai bawah dan/atau proteinurea', 'Benar', 'Salah', '', '', '', 'a', '3', 'mudah', 'yes'),
(82, 3, 'kehamilan/anc', 'Ibu hamil LiLA 24,5 memiliki resiko besar untuk melahirkan Bayi Berat Lahir Rendah (BBLR)', 'Benar', 'Salah', '', '', '', 'b', '3', 'mudah', 'yes'),
(83, 3, 'kehamilan/anc', 'Jika pada trisemester II bagian bawah janin bukan kepala atau kepala janin belum masuk ke panggul, berarti ada kelainan letak, panggul sempit, atau ada masalaha lain', 'Benar', 'Salah', '', '', '', 'b', '2', 'mudah', 'yes'),
(84, 3, 'kehamilan/anc', 'Untuk mencegah anemia gizi besi, setiap ibu hamil harus mendapat tablet tambah darah (tablet zat besi dan asam folat) minimal 90 tablet selama kehamilan yang diberikan sejak kontak pertama', 'Benar', 'Salah', '', '', '', 'a', '3', 'mudah', 'yes'),
(85, 3, 'kehamilan/anc', 'Ibu hamil LiLA 24,5 memiliki resiko besar untuk melahirkan Bayi Berat Lahir Rendah (BBLR)', 'Benar', 'Salah', '', '', '', 'b', '2', 'mudah', 'yes'),
(86, 3, 'kehamilan/anc', 'Pelayanan ANC selama kehamilan minimal 4 kali dan minimal 1 kali kunjungan diantar oleh suami', 'Benar', 'Salah', '', '', '', 'a', '2', 'mudah', 'yes'),
(87, 3, 'kehamilan/anc', 'Ny. "A" datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke Poskesdes untuk pertama kalinya. Menurut Ny. "A", ia hamil 3 bulan. HPHT=12 Marert 2015. Umur kehamilan Ny. "A" yang tepat adalah..', '9 minggu', '10 minggu', '11 minggu', '12 minggu', '', 'b', '5', 'sedang', 'yes'),
(88, 3, 'kehamilan/anc', 'Ny. Dian dengan G2P0A0, umur 22 tahun, hamil 36 minggu, menyatakan ingin memeriksakan ulang kehamilan ke bidan. Hasil pemeriksaan TFU 27 cm, kepala belum masuk panggul. Tindakan yang tepat untuk Ny. Dian adalah..', 'Pelvic rocking', 'KIE tentang tanda bahaya kehamilan', 'KIE tentang tanda persalinan', 'KIE tentang nutrisi ibu hamil', '', 'c', '3', 'sedang', 'yes'),
(89, 3, 'kehamilan/anc', 'Ny. Dian dengan G2P0A0, umur 22 tahun, hamil 36 minggu, menyatakan ingin memeriksakan ulang kehamilan ke bidan. Hasil pemeriksaan TFU 27 cm, kepala belum masuk panggul. Kunjungan selanjutnya untuk Ny. Dian adalah..', '1 minggu', '2 minggu', '3 minggu', '4 minggu', '', 'a', '3', 'sedang', 'yes'),
(90, 3, 'kehamilan/anc', 'Ny. Dian dengan G2P0A0, umur 22 tahun, hamil 36 minggu, menyatakan ingin memeriksakan ulang kehamilan ke bidan. Hasil pemeriksaan TFU 27 cm, kepala belum masuk panggul. Menurut Leopold, TFU kehamilan Ny. Dian adalah..', '1 jari bawah Px', '2 jari bawah Px', '3 jari bawah Px', 'Pertengahan Px dan pusat', '', 'c', '3', 'sedang', 'yes'),
(91, 3, 'kehamilan/anc', 'Ny. Dian dengan G2P0A0, umur 22 tahun, hamil 36 minggu, menyatakan ingin memeriksakan ulang kehamilan ke bidan. Hasil pemeriksaan TFU 27 cm, kepala belum masuk panggul. Kapan perhitungan masuknya kepala bayi dalam panggul pada Ny. Dian?', '4 minggu sebelum inpartu', '3 minggu sebelum inpartu', '2 minggu sebelum inpartu', 'Menjelang inpartu', '', 'd', '3', 'sedang', 'yes'),
(92, 3, 'kehamilan/anc', 'Ny. Sari, 25 tahun, datang ke polindes dengan keluhan tidak haid kurang lebih 3 bulan. Mengeluh selalu mual pada pagi hari dan mengatakan anak pertama baru berumur 1 tahun. Menggunakan KB pil tapi tidak rutin karena lupa. Kemudian bidan memeriksa Ny. Sari dan didapatkan hasil pemeriksaan TD: 110/80 mmHg, nadi 8x/menit, ballotemen (+), Hb 10, 5gr%. Kapan sebaiknya Ny. Sari melakukan kunjungan ulang..', '1 minggu lagi', '2 minggu lagi', '3 minggu lagi', '4 minggu lagi', '', 'd', '4', 'sedang', 'yes'),
(93, 3, 'kehamilan/anc', 'Kehamilan dimulai sejak..', 'Sejak jantung janin berdetak', 'Sejak selesai menstruasi', 'Sejak suami pertama kali berhubungan dengan istri', 'Sejak ovum dibuahi oleh sperma', 'Sejak zigot melakukan implantasi ke dinding rahim', 'd', '3', 'sedang', 'yes'),
(94, 3, 'kehamilan/anc', 'Suatu saat kehamilan dinyatakan bermasalah jika menunjukkan tanda gejala berikut kecuali..', 'Bengkak pada muka dan tangan', 'Janin bergerak aktif', 'Mual dan muntah berlebihan', 'Pandangan mata kabur', 'Perdarahan pervaginam', 'b', '3', 'sedang', 'yes'),
(95, 3, 'kehamilan/anc', 'Di bawah ini yang merupakan tanda pasti kehamilan adalah..', 'Terdengar denyut jantung janin', 'Perut membesar', 'Mual', 'Tidak haid', 'Payudara membesar', 'a', '3', 'sedang', 'yes'),
(96, 3, 'kehamilan/anc', 'Sebutkan 3 (tiga) tahap penting tumbuh kembang kehamilan!', 'Ovum - Embrio - Janin', 'Janin - Ovum - Embrio', 'Embrio - Janin - Ovum', 'Janin - Embrio - Ovum', '', 'a', '3', 'sedang', 'yes'),
(97, 3, 'kehamilan/anc', 'Ny "Yuli" G1P0A0 datang kebidan pada kunjungan yang ke-3 tanggal 16 Juni 2015 untuk memeriksakan kehamilannya, ia merasa cemas akan kehamilannya karena perut kadang - kadang kencang, dari anamnesa dan pemeriksaan didapatkan HPHT: 14 Oktober 2014, TD 140/70 mmhg DJJ 140x/menit TFU 28 cm Hb 11,3 gr %. Berdasarkan HPHT Ny "Yuli" berapa usia kehamilan pada tanggal 16 Juni 2015?', '30 minggu', '31 minggu', '33 minggu', '35 minggu', '', 'd', '4', 'sedang', 'yes'),
(98, 3, 'kehamilan/anc', 'Ny "Yuli" G1P0A0 datang kebidan pada kunjungan yang ke-3 tanggal 16 Juni 2015 untuk memeriksakan kehamilannya, ia merasa cemas akan kehamilannya karena perut kadang - kadang kencang, dari anamnesa dan pemeriksaan didapatkan HPHT: 14 Oktober 2014, TD 140/70 mmhg DJJ 140x/menit TFU 28 cm Hb 11,3 gr %.\n Berdasarkan data di atas, yang harus dilakukan bidan sehubungan dengan keluhan Ny "Yuli" adalah..', 'Memberikan ibu obat - obatan', 'Menganjurkan ibu untuk memeriksa ke dokter obgyn', 'Member penjelasan bahwa hal tersebut adalah normal', 'Member penjelasan bahwa hal tersebut merupakan tanda - tanda persalinan mulai', '', 'c', '4', 'sedang', 'yes'),
(99, 3, 'kehamilan/anc', 'Yang termasuk ante partum bleeding yaitu?', 'Abortus', 'Plasenta previa', 'Solusio plasenta', 'Atonia uteri', 'A, B, dan C benar', 'e', '3', 'sedang', 'yes'),
(100, 3, 'kehamilan/anc', 'Tujuan ANC yaitu?', 'Meningkatkan dan mempertahankan kesehatan fisik, maternal dan sosial ibu dan bayi', 'Menurunkan angka kesakitan dan kematian ibu dan perinatal', 'Mempesiapkan ibu agar masa nifas berjalan normal dan pemberian ASI Eksklusif', 'Memantau kemajuan kehamilan untuk memastikan kesehatan ibu dan tumbuh kembang janin', 'Semua jawaba benar', 'e', '3', 'sedang', 'yes'),
(101, 3, 'kehamilan/anc', 'Perubahan yang terjadi pada ibu hamil adalah, kecuali..', 'Uterus', 'Berat badan', 'Ovarium', 'Mammae', 'Suhu Tubuh', 'e', '3', 'sedang', 'yes'),
(102, 3, 'kehamilan/anc', 'Yang bukan merupakan faktor psikologis yang mempengaruhi kehamilan adalah', 'Stressor Internal dan Ekternal', 'Support Keluarga', 'Wanita karier', 'Substansi Abuse', 'Partner Abuse (Kekerasan selama kehamilan oleh pasangan)', 'c', '3', 'sedang', 'yes'),
(103, 3, 'kehamilan/anc', 'Untuk wanita yang masih dalam usia reproduksi, sebaiknya dipikirkan suatu abortus inkomplit apabila salah satu hal dibawah ini terjadi', 'Terlambat haid, terjadi perdarahan pervaginam, spasme atau nyeri perut bagian bawah, keluarnya massa kehamilan', 'Terlambat haid, terjadi perdarahan pervaginam, tidak ada pengeluaran massa kehamilan', 'Terlambat haid, perdarahan pervaginam, tidak ada nyeri perut', 'Terlambat haid dan tidak terjadi perdarahan', 'Terjadi perdarahan disertai pengeluaran semua massa kehamilan', 'a', '3', 'sedang', 'yes'),
(104, 3, 'kehamilan/anc', 'Bila uterus lebih besar dari dugaan usia kehamilan, kemungkinan terjadi hal dibawah ini, kecuali..', 'Hamil ganda', 'Uterus dipenuhi bekuan darah', 'Hamil mola', 'Mioma uteri dengan kehamilan', 'Kehamilan dengan kelainan kromosom', 'b', '3', 'sedang', 'yes'),
(105, 3, 'kehamilan/anc', 'Pada abortus insipiens seorang ibu akan mengalami tanda dan gejala', 'Perdarahan sedang sampai banyak dan serviks terbuka', 'Perdarahan sedang sampai banyak dan serviks tertutup', 'Perdarahan sedikit sampai tidak ada dan serviks terbuka', 'Perdarahan sedikit sampai tidak ada dan serviks terbuka', 'Perdarahan banyak sampai tidak ada dan serviks terbuka', 'a', '3', 'sedang', 'yes'),
(106, 3, 'kehamilan/anc', 'Hipertensi gestasional terjadi pada ibu hamil dengan usia kehamilan', '<20 minggu', '>20 minggu', '<28 minggu', '>28 minggu', '>12 minggu', 'b', '4', 'sedang', 'yes'),
(107, 3, 'kehamilan/anc', 'Seorang ibu hamil mengalami kenaikan tekanan darah disertai proteinuria 2+, maka ibu itu telah mengalami', 'Pre-eklamsia ringan', 'Eklampsia', 'Pre-eklamsia berat', 'Hipertensi kronik', 'Hipertensi gestasional', 'c', '4', 'sedang', 'yes'),
(108, 3, 'kehamilan/anc', 'Kehamilan dimulai sejak..', 'Sejak suami pertama kali berhubungan dengan istri', 'Sejak ovum dibuahi oleh sperma', 'Sejak jantung janin berdetak', 'Sejak zigot melakukan implantasi ke dinding rahim', 'Sejak Selesai menstruasi.', 'b', '3', 'sedang', 'yes'),
(109, 3, 'kehamilan/anc', 'Seorang perempuan berusia 24 tahun G1P0A0 umur kehamilan 13 minggu datang ke BPM mengeluh mual muntah. Data yang diperoleh dari pemeriksaan KU ibu baik dan TD: 110/80 mmHg, N: 80 x/m, R: 20 x/m, S: 37 ◦C. Apakah pendidikan kesehatan yang diperlukan pada kasus di atas?', 'Senam hamil', 'Perawatan payudara', 'Nutrisi (gizi)', 'Mobilisasi', 'Kebutuhan istirahat', 'c', '3', 'sedang', 'yes'),
(110, 3, 'kehamilan/anc', 'Bidan merujuk pasien berusia 28 tahun G1P0A0 umur kehamilan 36 minggu ke RSU dengan kondisi pasien tidak sadar, mengalami kejang - kejang. Hasil pemeriksaan TD 160/110 mmHg, N 100 x/mnt, R 16 x/ mnt, DJJ irreguler, terdapat oedema pada wajah, tangan dan kaki. Apakah diagnosa yang sesuai dengan kasus di atas?', 'Eklampsia', 'Pre-eklampsia berat', 'Pre-eklampsia ringan', 'Pre-eklampsia sedang', 'Superimpos Pre-eklamsia', 'b', '4', 'sedang', 'yes'),
(111, 3, 'kehamilan/anc', 'Seorang perempuan usia 28 tahun hamil 36 minggu datang ke BPM diantar dengan suaminya. kondisi klien tidak sadar dan mengalami kejang - kejang. Hasil pemeriksaan dilakukan oleh bidan didapatkan TD 180/110 mmHg, N 100 x/mnt, R 15 x/ mnt, DJJ irreguler, terdapat oedema pada wajah, tangan dan kaki. Apakah pemeriksaan penunjang yang harus dilakukan pada kasus di atas ?', 'Aceton Urine', 'HCG Urine', 'Protein Urine', 'Reduksi Urine', 'Glukosa Urine', 'c', '4', 'sedang', 'yes'),
(112, 3, 'kehamilan/anc', 'Seorang perempuan usia 19 tahun hamil 34 minggu datang ke BPM diantar keluarga dalam kondisi tidak sadar dan mengalami kejang - kejang. Hasil pemeriksaan TD 180/110 mmHg, N 100 x/mnt, R 16 x/ mnt, DJJ irreguler, terdapat oedema pada wajah, tangan dan kaki. Bagaimana penatalaksanaan yang tepat pada kasus di atas ?', 'Rujuk ke RS', 'Memberikan MgSO4 dan kemudian rujuk ke RS', 'Memberikan diazepam dan kemudian rujuk ke RS', 'Memasang infus dan dirawat di BPM sampai sembuh', 'Memberikan MgSO4 dan diazepam kemudian rujuk ke RS', 'b', '4', 'sedang', 'yes'),
(113, 3, 'kehamilan/anc', 'Seorang perempuan usia 35 tahun usia kehamilan 19 minggu, datang ke BPM dengan keluhan kram perut bagian bawah, perdarahan bercak dari kemaluannya, hasil pemeriksaan TD: 120/80 mmHg, N: 97 x/m, R: 24 x/m, S: 37.5 ᵒC, PD: servik tertutup. Apakah diagnosa pada kasus di atas?', 'Abortus komplit', 'Abortus insipiens', 'Abortus Imminens', 'Abortus Inkomplit', 'Abortus Mola', 'c', '3', 'sedang', 'yes'),
(114, 3, 'kehamilan/anc', 'Seorang perempuan usia 35 tahun usia kehamilan 19 minggu, datang ke BPM dengan keluhan kram perut bagian bawah, perdarahan dari kemaluannya, hasil pemeriksaan TD: 120/80 mmHg, N: 88 x/m, R: 24 x/m, S: 37.5 ᵒC, belum terjadi ekspulsi hasil konsepsi, PD: servik terbuka. Apakah diagnosa pada kasus di atas?', 'Abortus komplit', 'Abortus insipiens', 'Abortus Imminens', 'Abortus Inkomplit', 'Abortus Mola', 'b', '4', 'sedang', 'yes'),
(115, 3, 'kehamilan/anc', 'Seorang perempuan usia 35 tahun usia kehamilan 19 minggu, datang ke BPM dengan keluhan kram perut bagian bawah, perdarahan dari kemaluannya, hasil pemeriksaan TD: 120/80 mmHg, N: 88 x/m, R: 24 x/m, S: 37.5 ᵒC, ekspulsi sebagian hasil konsepsi, PD: servik terbuka. Apakah diagnosa pada kasus di atas?', 'Abortus komplit', 'Abortus insipiens', 'Abortus Imminens', 'Abortus Inkomplit', 'Abortus Mola', 'd', '4', 'sedang', 'yes'),
(116, 3, 'kehamilan/anc', 'Seorang perempuan usia 35 tahun usia kehamilan 19 minggu, datang ke BPM dengan keluhan kram perut bagian bawah, perdarahan dari kemaluannya, hasil pemeriksaan TD: 120/80 mmHg, N: 88 x/m, R: 24 x/m, S: 37.5 ᵒC, riwayat ekspulsi hasil konsepsi, PD: servik terbuka. Apakah diagnosa pada kasus di atas?', 'Abortus komplit', 'Abortus insipiens', 'Abortus Imminens', 'Abortus Inkomplit', 'Abortus Mola', 'a', '4', 'sedang', 'yes'),
(117, 3, 'kehamilan/anc', 'Seorang perempuan usia 40 tahun usia kehamilan 18 minggu, datang ke BPM dengan keluhan kram perut bagian bawah, perdarahan dari kemaluannya, hasil pemeriksaan TD: 120/80 mmHg, N: 88 x/m, R: 24 x/m, S: 37.5 ᵒC, TFU lebih besar dari usia gestasinya, terdapat sindroma mirip pre-eklamsia, tidak terdengar DJJ, dan keluar jaringan seperti anggur, PD: servik terbuka. Apakah diagnosa pada kasus di atas?', 'Abortus komplit', 'Abortus insipiens', 'Abortus Imminens', 'Abortus Inkomplit', 'Abortus Mola', 'e', '4', 'sedang', 'yes'),
(118, 3, 'kehamilan/anc', 'Dalam pelayanan ANC terpadu tenaga kesehatan haru memiliki kemampuan berikut, kecuali..', 'Memastikan bahwa kehamilan berlangsung normal', 'Mampu mendeteksi dini masalah dan penyakit yang dialami ibu hamil', 'Melakukan intervensi secara adekuat', 'Aktif mengunjungi kediaman ibu hamil', '', 'd', '3', 'sedang', 'yes'),
(119, 3, 'kehamilan/anc', 'Tinggi badan ibu hamil kurang dari 145 cm meningkatkan resiko untuk terjadinya', 'Cephalopelvic Disproportion', 'Fetal distress', 'Dystocia', 'Preterm birth', '', 'a', '3', 'sedang', 'yes'),
(120, 3, 'kehamilan/anc', 'Kapan pengukuran tinggi fundus uteri harus dilakukan menggunakan pita pengukur?', 'Setelah kehamilan 23 minggu', 'Setelah kehamilan 22 minggu', 'Setelah kehamilan 20 minggu', 'Setelah kehamilan 24 minggu', 'Setelah kehamilan 25 minggu', 'c', '4', 'sedang', 'yes'),
(121, 3, 'kehamilan/anc', 'Kapan penentuan presentase janin dilakukan?', 'Pada akhir trisemester I dan selanjutnya setiap kali kunjungan ANC', 'Pada akhir trisemester II dan selanjutnya setiap kali kunjungan ANC', 'Pada akhir trisemester III dan selanjutnya setiap kali kunjungan ANC', 'Pada setiap kali kunjungan pemerikasaan kehamilan', '', 'b', '4', 'sedang', 'yes'),
(122, 3, 'kehamilan/anc', 'Kapan pengukuran Denyut Jantung Janin (DJJ) mulai dilakukan?', 'Pada akhir trisemester I dan selanjutnya setiap kali kunjungan ANC', 'Pada akhir trisemester II dan selanjutnya setiap kali kunjungan ANC', 'Pada akhir trisemester III dan selanjutnya setiap kali kunjungan ANC', 'Pada trimester II & selanjutnya setiap kunjungan ANC', '', 'd', '4', 'sedang', 'yes'),
(123, 3, 'kehamilan/anc', 'Mengapa ibu hamil harus diberikan imunisasi Tetanus Toksoid (TT)?', 'Untuk mencegah terjadinya tetanus lokal', 'Untuk mencegah terjadinya tetanus generalisata', 'Untuk mencegah terjadinya tetanus sefalik', 'Untuk mencegah terjadinya tetanus neonatorum', 'Untuk mencegah terjadinya tetanus', 'e', '2', 'sedang', 'yes'),
(124, 3, 'kehamilan/anc', 'DJJ lambat adalah kurang dari 120 kali per menit dan DJJ cepat adalah 160 kali per menit', 'Benar', 'Salah', '', '', '', 'a', '3', 'sedang', 'yes'),
(125, 3, 'kehamilan/anc', 'Pemeriksaan laboratorium khusus adalah pemeriksaan laboratorium yang harus dilakukan pada setiap ibu hamil yaitu golongan darah, hemoglobin darah, dan pemeriksaan spesifik daerah endemis/epidemi (malaria, HIV, dan lainnya)', 'Benar', 'Salah', '', '', '', 'b', '3', 'sedang', 'yes'),
(126, 3, 'kehamilan/anc', 'Pemeriksaan laboratorium rutin adalah pemeriksaan laboratorium lain yang dilakukan atas indikasi pada ibu hamil yang melakukan kunjungan ANC', 'Benar', 'Salah', '', '', '', 'b', '2', 'sedang', 'yes'),
(127, 3, 'kehamilan/anc', 'Ibu hamil yang dicurigai menderita diabetes melitus harus dilakukan pemeriksaan gula darah selama kehamilannya minimal sekali pada trimester pertama, sekali pada trimester kedua, dan sekali pada trimester ketiga', 'Benar', 'Salah', '', '', '', 'a', '2', 'sedang', 'yes'),
(128, 3, 'kehamilan/anc', 'Gerakan bayi mulai dirasakna ibu pada kehamilan akhir bulan ke lima, apabila pada bulan ke empat gerakan janin belum muncul pada usia kehamilan ini, gerakan yang semakin berkurang atau tidak ada gerakan maka ibu hamil tidak perlu waspada', 'Benar', 'Salah', '', '', '', 'b', '2', 'sedang', 'yes'),
(129, 3, 'kehamilan/anc', 'Kehamilan dimulai sejak', 'Sejak suami pertama kali berhubungan dengan istri', 'Sejak ovum dibuahi oleh sperma', 'Sejak jantung janin berdetak', 'Sejak zigot melakukan implantasi ke dinding rahim', 'Sejak Selesai menstruasi.', 'b', '3', 'sulit', 'yes'),
(130, 3, 'kehamilan/anc', 'Dibawah ini pengelompokan tanda kehamilan kecuali', 'Tanda pasti', 'Tanda tidak pasti', 'Tanda mungkin', 'Tanda tidak mungkin', 'BSSD', 'd', '3', 'sulit', 'yes'),
(131, 3, 'kehamilan/anc', 'Suatu kehamilan dinyatakan bermasalah jika menunjukkan tanda gejala berikut kecuali', 'Janin bergerak aktif', 'Perdarahan pervaginam', 'Bengkak pada muka dan tangan', 'Pandangan mata kabur', 'Mual dan Muntah berlebihan', 'a', '3', 'sulit', 'yes'),
(132, 3, 'kehamilan/anc', 'Dibawah ini yang merupakan tanda pasti kehamilan adalah', 'Mual', 'Payudara membesar', 'Terdengar denyut jantung janin', 'Perut membesar', 'Tidak Haid', 'c', '3', 'sulit', 'yes'),
(133, 3, 'kehamilan/anc', 'Selama kehamilan trimester awal, ibu hamil wajib melakukan pemeriksaan yang lebih dikenal dengan K1, sebanyak', '1 kali', '2 kali', '3 kali', '4 kali', '5 kali', 'a', '3', 'sulit', 'yes'),
(134, 3, 'kehamilan/anc', 'Imunisasi apa yang diberikan pada ibu hamil?', 'TT4', 'TT3', 'TT2', 'TT1', 'TT awal', 'd', '3', 'sulit', 'yes'),
(135, 3, 'kehamilan/anc', 'Sebutkan 3 tahap penting tumbang kehamilan', 'Ovum – Embrio – Janin', 'Janin – ovum – embrio', 'Embrio – janin – ovum', 'Janin – embrio - ovum', 'Tidak ada yang benar', 'a', '3', 'sulit', 'yes'),
(136, 3, 'kehamilan/anc', 'Kebutuhan fisik Ibu Hamil adalah sebagai berikut, kecuali..', 'Seksual', 'Olah raga', 'Tidur', 'Vitamin', 'Berita', 'e', '3', 'sulit', 'yes'),
(137, 3, 'kehamilan/anc', 'Jika ada wanita hamil pertama kali maka dalam dunia kesehatan kehamilanya disebut', 'Multi gravidarum', 'Primi gravidarum', 'Hiperemesis gravidarum', 'Grande multi gravidarum', 'Awal kehamilan', 'b', '3', 'sulit', 'yes'),
(138, 3, 'kehamilan/anc', 'Salah satu penanganan pada ibu dengan eklampsia adalah', 'Tidak perlu pemberian obat', 'Aspirasi mulut dan tenggorokan', 'Lebih banyak istirahat', 'Baringkan pasien pada sisi kiri', 'B dan D benar', 'c', '4', 'sulit', 'yes'),
(139, 3, 'kehamilan/anc', 'Seorang perempuan usia 23 tahun, hamil anak pertama usia kehamilan 3 bulan, datang ke puskesmas dengan keluhan perut terasa mules, keluar darah sedikit dari jalan lahir, hasil palpasi tinggi fundus uteri sesuai dengan usia kehamilan, pemeriksaan dalam terdapat perdarahan dari kanalis servikalis, kanalis servikalis masih tertutup. Apakah nasehat yang diberikan pada kasus diatas?', 'Banyak makan', 'Istirahat baring', 'Pemeriksaan USG', 'Pemeriksaan CTG', 'Pemeriksaan Rhongen', 'b', '4', 'sedang', 'yes'),
(140, 3, 'kehamilan/anc', 'Ny. Ani datang tanggal 28 Mei 2015 untuk memeriksakan kehamilannya ke polindes untuk pertama kalinya. HPHT 12 Maret 2015. Keluhan yang muncul adalah mual dan muntah pada pagi hari. Pemeriksaan penunjang yang dilakukan bidan untuk menegakkan diagnosis adalah..', 'Pemeriksaan darah', 'Pemeriksaan planot test', 'Pemeriksaan protein urine', 'Pemeriksaan USG', '', 'b', '4', 'sedang', 'yes'),
(141, 3, 'kehamilan/anc', 'Ny. Sari, 25 tahun, datang ke polindes dengan keluhan tidak haid kurang lebih 3 bulan. Mengeluh selalu mual pada pagi hari dan mengatakan anak pertama baru berumur 1 tahun. Menggunakan KB pil tapi tidak rutin karena lupa. Kemudian bidan memeriksa Ny. Sari dan didapatkan hasil pemeriksaan TD: 110/80 mmHg, nadi 8x/menit, ballotemen (+), Hb 10, 5gr%. TFU ideal Ny. Sari adalah..', '1 - 2 jari di atas simfisis', '3 jari di atas simfisis', 'Pertengahan simfisis pusat', '3 jari di bawah pusat', '', 'b', '2', 'mudah', 'yes'),
(142, 3, 'kehamilan/anc', 'Berapa lamakah perlindungan imunisasi TT2?', '3 tahun', '2 tahun', '1 tahun', '4 tahun', '', 'a', '4', 'mudah', 'yes'),
(143, 3, 'kehamilan/anc', 'Berapa lamakah perlindungan imunisasi TT3?', '2 tahun', '5 tahun', '8 tahun', '6 tahun', '', 'b', '4', 'mudah', 'yes'),
(144, 3, 'kehamilan/anc', 'Berapa lamakah perlindungan imunisasi TT4?', '11 tahun', '13 tahun', '10 tahun', '12 tahun', '', 'c', '4', 'mudah', 'yes'),
(145, 3, 'kehamilan/anc', 'Berapa lamakah perlindungan imunisasi TT5?', '>= 15 tahun', '>= 22 tahun', '>= 23 tahun', '>= 25 tahun', '', 'd', '4', 'mudah', 'yes'),
(146, 3, 'kehamilan/anc', 'Berapa lamakah selang waktu pemberian imunisasi TT2?', '1 bulan setelah TT1', '2 bulan setelah TT1', '3 bulan setelah TT1', '4 bulan setelah TT1', '', 'a', '2', 'mudah', 'yes'),
(147, 3, 'kehamilan/anc', 'Berapa lamakah selang waktu pemberian imunisasi TT3?', '5 bulan setelah TT2', '6 bulan setelah TT2', '7 bulan setelah TT2', '8 bulan setelah TT2', '', 'b', '2', 'mudah', 'yes'),
(148, 3, 'kehamilan/anc', 'Berapa lamakah selang waktu pemberian imunisasi TT4?', '10 bulan setelah TT3', '11 bulan setelah TT3', '12 bulan setelah TT3', '13 bulan setelah TT3', '', 'c', '2', 'mudah', 'yes'),
(149, 3, 'kehamilan/anc', 'Berapa lamakah selang waktu pemberian imunisasi TT5?', '13 bulan setelah TT4', '10 bulan setelah TT4', '24 bulan setelah TT4', '12 bulan setelah TT4', '', 'd', '4', 'mudah', 'yes'),
(150, 3, 'persalinan/nifas', 'Ny. Eni umur 30 tahun P1A0 telah melahirkan 3 hari yang lalu, mengeluh nyeri jahitan perenium dan payudara mulai tegang. Yang harus dilakukan Ny. Eni untuk mencegah infeksi adalah..', 'Tindakan menyentuh luka', 'Ganti pembalut setiap 4 jam sekali', 'Mencuci luka dengan larutan', 'Memakai celana yang dapat menekan luka', '', 'b', '3', 'mudah', 'yes'),
(151, 3, 'persalinan/nifas', 'Ny. Eni umur 30 tahun P1A0 telah melahirkan 3 hari yang lalu, mengeluh nyeri jahitan perenium dan payudara mulai tegang. Jenis lochea yang dikeluarkan Ny.Eni adalah..', 'Alba', 'Serosa', 'Sangguenolenta', 'Rubra', '', 'b', '3', 'mudah', 'yes'),
(152, 3, 'persalinan/nifas', 'Seorang primigravida datang ke BPM pada usia kehamilan 39 minggu dengan keluhan sakir perut sejak tadi malam dari hasil pemeriksaan didapatkan pemeriksaan 8 cm his 3 - 4 x dalam 10 menit, ket (+) kepala turun II.\n Untuk memantau kemajuan persalinan di pakai lembar', 'Catatan medic', 'Patograf', 'Foto polio', 'Ultrasonografi', '', 'b', '4', 'mudah', 'yes'),
(153, 3, 'persalinan/nifas', 'Robekan perineum terdiri dari', '3 tingkat', '4 tingkat', '6 tingkat', '5 tingkat', '2 tingkat', 'b', '3', 'mudah', 'yes'),
(154, 3, 'persalinan/nifas', 'Jika robekan hanya pada selaput lendir vagina dengan atau tanpa mengenai kulit perineum adalah', 'Tingkat I', 'Tingkat II', 'Tingkat III', 'Tingkat IV', 'Tingkat V', 'a', '3', 'mudah', 'yes'),
(155, 3, 'persalinan/nifas', 'Jika robekan mengenai seluruh perineum dan otot sfingter ani adalah', 'Tingkat I', 'Tingkat II', 'Tingkat III', 'Tingkat IV', 'Tingkat V', 'c', '3', 'mudah', 'yes'),
(156, 3, 'persalinan/nifas', 'Ny. U, 36 tahun, G VII PV AI. Segera setelah plasenta lahir lengkap terjadi perdarahan, kontraksi uterus lembek serta TFU sulit ditentukan. Hasil pemeriksaan tidak ada robekan jalan lahir, kandung kemih kosong. Ny. U kemungkinan mengalami..', 'Atonia Uteri', 'Ruptur Uteri', 'Inversio Uteri', 'Laserasi Portio', 'Laserasi Perineum', 'a', '4', 'mudah', 'yes'),
(157, 3, 'persalinan/nifas', 'Ny. S usia 38 tahun G2 P0 A1, datang ke bidan inpartu sisa dukun, kenceng - kenceng sering dan teratur sejak 2 hari yang lalu. Telah di pimpin mengejan oleh dukun 3 jam yang lalu. KU Lemah, kelelahan. Tekanan darah 90/60 mmHg, nadi 100 x/menit, suhu 39 ◦C, VT pembukaan 8 cm, kepala turun di hodge III, DJJ 182x/menit. Dari data DJJ, janin mengalami..', 'Infeksi genital', 'Sepsis intra partum', 'Infeksi intra uterin', 'Infeksi ekstra uterin', 'Fetal distress', 'e', '4', 'mudah', 'yes'),
(158, 3, 'persalinan/nifas', 'Ny. Sarah, 25 tahun, G1P0A0, hamil 38 minggu, datang ke BPM pukul 08.00 WIB, mengeluh perut kenceng-kenceng, hasil pemeriksaan: KU baik, TD 110/70 mmHg, nadi 80 x/menit, respirasi 24 x/menit, TFU 30 cm, kepala sudah masuk 2/5, hasil VT pembukaan serviks 8 cm, selaput ketuban masih utuh, ibu mengatakan cemas menghadapi persalinan. Sesuai dengan kasus Ny. Sarah penurunan kepala berada pada..', 'Hodge I', 'Hodge II', 'Hodge III', 'Hodge IV', 'Hodge V', 'c', '4', 'mudah', 'yes'),
(159, 3, 'persalinan/nifas', 'Ny. Sarah, 25 tahun, G1P0A0, hamil 38 minggu, datang ke BPM pukul 08.00 WIB, mengeluh perut kenceng - kenceng, hasil pemeriksaan: KU baik, TD 110/70 mmHg, nadi 80 x/menit, respirasi 24 x/menit, TFU 30 cm, kepala sudah masuk 2/5, hasil VT pembukaan serviks 8 cm, selaput ketuban masih utuh, ibu mengatakan cemas menghadapi persalinan. Asuhan sayang ibu yang diberikan pada Ny. Sarah..', 'Memberikan dukungan emosional', 'Memberikan nutrisi', 'Menganjurkan ibu untuk berbaring', 'Melakukan periksa dalam kembali untuk menentukan pembukaan', 'Meminta ibu untuk tidur', 'a', '3', 'mudah', 'yes'),
(160, 3, 'persalinan/nifas', 'Ny. Mira umur 25 tahun PI A0 AHI baru saja melahirkan bayinya secara spontan, keadaan bayinya menangis kuat, kemerahan pada kulit, dan tonus ototnya baik. Sedangkan plasenta belum lahir, tinggi fundus uteri masih setinggi pusat, sudah terdapat tanda - tanda pelepasan plasenta. Sesuai kasus diatas diperkirakan plasenta akan lahir dalam waktu..', '5 – 10 menit', '10 – 15 menit', '15 – 20 menit', '15 – 30 menit', '30 - 35 menit', 'd', '4', 'mudah', 'yes'),
(161, 3, 'persalinan/nifas', 'Tali pusat memanjang, semburan darah mendadak, dan uterus globuler merupakan..', 'Inpartu III', 'Tanda - tanda bayi sudah lahir', 'Tanda - tanda pelepasan tali pusat', 'Tanda - tanda pelepasan plasenta', 'Tanda - tanda perdarahan tali pusat', 'd', '4', 'mudah', 'yes'),
(162, 3, 'persalinan/nifas', 'Saat penegangan tali pusat terkendali, plasenta keluar disertai dengan keluarnya darah yang banyak bercampur air ketuban. Ini disebut pengeluaran plasenta secara', 'Klein', 'Duncan', 'Schultzel', 'Strasman', 'Normal', 'c', '3', 'mudah', 'yes'),
(163, 3, 'persalinan/nifas', 'Cara penjahitan pada laserasi perineum derajat I sampai II atau pada luka episiotomi, jahitan selalu dimulai pada', 'Sekitar hymen', 'Ujung perineum', '1 cm di atas puncak luka', 'Di puncak luka', 'Dimana saja yang paling enak buat bidan', 'c', '3', 'mudah', 'yes'),
(164, 3, 'persalinan/nifas', 'Ny. Umi, G1P0A0 hamil 38 minggu saat ini mengeluh perut mulas, sakit pinggang, hasil pemeriksaan didapatkan status TD 120/80 mmHg, nadi 84x/menit, respirasi 20x/menit, palpasi TFU 20 cm punggung kanan, kepala sudah masuk 3/5 bagian, DJJ 145x/menit, kontraksi 3x dalam 10 menit, lamanya 30 detik, pembukaan 5 cm, ket (+), persentasi kepala. Dignosa yang tepat untuk Ny. Umi adalah..', 'Inpartu kala II fase laten', 'Inpartu kala I fase aktif', 'Inpartu kala II fase aktif', 'Post-partum', '', 'b', '4', 'sedang', 'yes'),
(165, 3, 'persalinan/nifas', 'Seorang primigravida datang ke BPM pada usia kehamilan 39 minggu dengan keluhan sakir perut sejak tadi malam dari hasil pemeriksaan didapatkan pemeriksaan 8 cm his 3 - 4 x dalam 10 menit, ket (+) kepala turun II.\n Setelah pembukaan lengkap langkah bidan selanjutnya adalah..', 'Memecah ketuban', 'Menyuntik oxytosin', 'Memimpin persalinan', 'Menyiapkan alat persalinan', '', 'c', '4', 'sedang', 'yes'),
(166, 3, 'persalinan/nifas', 'Ny "Ani" melahirkan 1 jam yang lalu BB bayi 3500 gram placenta dan selaput ketuban lahir dengan lengkap, Ny "Ani" telah menyusui bayinya dan sekarang sedang istirahat.\n Kontraksi uterus Ny "Ani" harus dipantau setiap?', '10 menit', '15 menit', '20 menit', '30 menit', '', 'b', '4', 'sedang', 'yes'),
(167, 3, 'persalinan/nifas', 'Ny "Ani" melahirkan 1 jam yang lalu BB bayi 3500 gram placenta dan selaput ketuban lahir dengan lengkap, Ny "Ani" telah menyusui bayinya dan sekarang sedang istirahat.\n Tujuan asuhan yang diberikan pada Ny "Ani" setelah 6 jam adalah..', 'Menilai adanya tanda - tanda infeksi', 'Mencegah perdarahan karena atonia uteri', 'Memastikan envolusi uterus berjalan normal', 'Memastikan ibu mendapatkan nutrisi yang cukup', '', 'c', '4', 'sedang', 'yes');
INSERT INTO `soal` (`id`, `id_jenis_tes`, `kategori`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `pilihan_e`, `jawaban`, `level_of_importance`, `level`, `publish`) VALUES
(168, 3, 'persalinan/nifas', 'Ibu Sinta hamil anak pertama mengeluh mengeluarkan lendir bercampur darah cukup banyak dari kemaluannya, sejak 2 jam yang lalu. Saat dilakukan Anamnesa, UK ibu 37-38 minggu; pemeriksaan fisik oleh bidan, didapatkan hasil pemeriksaan antara lain: His 3 x 35” 10’; VT: v/ v dbn, let kep, ket (+), Φ 8 cm, eff. 75%, H III, UUK Ki dpn, tidak terraba bagian kecil janin. Berdasarkan teori, peristiwa tersebut termasuk', 'Persalinan palsu', 'Inpartu', 'Hamil', 'Semua jawaban salah', 'Semua jawaban benar', 'b', '4', 'sedang', 'yes'),
(169, 3, 'persalinan/nifas', 'Ibu Sinta hamil anak pertama mengeluh mengeluarkan lendir bercampur darah cukup banyak dari kemaluannya, sejak 2 jam yang lalu. Saat dilakukan Anamnesa, UK ibu 37-38 minggu; pemeriksaan fisik oleh bidan, didapatkan hasil pemeriksaan antara lain: His 3 x 35” 10’; VT: v/ v dbn, let kep, ket (+), Φ 8 cm, eff. 75%, H III, UUK Ki dpn, tidak terraba bagian kecil janin. Maka diagnosa yang tepat adalah', 'G1 Po-o UK (37-38) mg, A/T/H, Letkep, U, intra uterine dengan inpartu kala 1 fase laten', 'G1 Po-o UK (37-38) mg, A/T/H, Letkep, U, dengan kontraksi Braxton hicks', 'G1 Po-o UK (37-38) mg, P/T/H, Letkep, U, intra uterine dengan inpartu kala 1 fase laten', 'G1 Po-o UK (37-38) mg, A/T/H, Letkep, U, intra uterine dengan inpartu kala 1 fase aktif', 'Tidak ada yang benar', 'd', '4', 'sedang', 'yes'),
(170, 3, 'persalinan/nifas', 'Hal yang dilakukan bidan jika diketahui ibu bersalin mengalami kesempitan panggul adalah', 'Melakukan rujukan', 'Memberikan pertolongan persalinan mandiri', 'Melakukan pertolongan persalinan di rumah pasien', 'Semua jawaban salah', 'Tidak ada yang benar', 'a', '3', 'sedang', 'yes'),
(171, 3, 'persalinan/nifas', 'Seorang ibu dalam masa inpartu. Bidan Sinta menganjurkan ibu bersalin untuk merubah posisi miring kanan atau kiri, agar ibu merasa lebih nyaman. Berdasarkan kasus di atas, tindakan yang dilakukan bidan adalah wujud dari', 'Membuat keputusan klinik', 'Tindakan pencegahan infeksi', 'Asuhan sayang ibu', 'Tindakan pendokumentasian', 'Tidak ada yang benar', 'c', '4', 'sedang', 'yes'),
(172, 3, 'persalinan/nifas', 'Jika digunakan dengan tepat dan konsisten, partograf akan membantu penolong persalinan untuk..', 'Mencatat kemajuan bayi', 'Mencatat kondisi ibu nifas', 'Mencatat kemajuan persalinan, kondisi ibu dan janinnya', 'Menggunakan informasi yang tersedia untuk membuat keputusan klinik yang sesuai dan tepat waktu', 'C dan D benar', 'e', '4', 'sedang', 'yes'),
(173, 3, 'persalinan/nifas', 'Partograf harus digunakan untuk', 'Semua ibu hamil', 'Semua ibu dalam fase aktif kala I persalinan dan merupakan elemen penting dari asuhan persalinan', 'Semua kondisi ibu dalam fase Laten', 'Semua persalinan dari pembukaan 1 sampai pembukaan lengkap', 'Semua persalinan ibu yang butuh penanganan gawat darurat', 'b', '4', 'sedang', 'yes'),
(174, 3, 'persalinan/nifas', 'Maksud dari lambang angka 2 pada penyusupan (Molase) tulang kepala bayi adalah', 'Tulang - tulang kepala janin terpisah, sutura dengan mudah dapat dipisahkan', 'Tulang - tulang kepala janin hanya saling bersentuhan', 'Tulang - tulang kepala janin hanya sejajar', 'Tulang - tulang kepala janin saling tumpah tindih tetapi masih dapat dipisahkan', 'Tulang - tulang kepala janin saling tumpah tindih dan tidak dapat dipisahkan', 'd', '4', 'sedang', 'yes'),
(175, 3, 'persalinan/nifas', 'Komplikasi ibu yang terjadi pada ibu jika seorang ibu bersalin mengalami persalinan macet adalah', 'Perdarahan', 'Trauma/cedera jalan lahir', 'Infeksi', 'Semua benar', 'Semua salah', 'd', '4', 'sedang', 'yes'),
(176, 3, 'persalinan/nifas', 'Komplikasi janin yang terjadi pada persalinan macet adalah', 'Asfiksia berat', 'Perdarahan subgaleal', 'Trauma/cedera jalan lahir', 'A dan B benar', 'B dan C benar', 'd', '4', 'sedang', 'yes'),
(177, 3, 'persalinan/nifas', 'Komplikasi yang disebabkan oleh distosia bahu adalah', 'Kerusakan pleksus brachialis oleh rudapaksa persalinan', 'Patah tulang', 'Asfiksia atau kematian bayi', 'Semua salah', 'Semua benar', 'e', '4', 'sedang', 'yes'),
(178, 3, 'persalinan/nifas', 'Faktor Ibu yang menyebabkan terjadinya asfiksia adalah', 'Infark plasenta', 'Pre-eklampsi dan eklampsi', 'Hematom plasenta', 'Lilitan tali pusat', 'Simpul tali pusat', 'b', '3', 'sedang', 'yes'),
(179, 3, 'persalinan/nifas', 'Faktor resiko terjadinya distosia bahu adalah', 'Makrosomia (>4000gram)', 'Diabetes Gestasional', 'Multiparitas', 'Semua salah', 'Semua benar', 'e', '3', 'sedang', 'yes'),
(180, 3, 'persalinan/nifas', 'Ny. S, usia 23 tahun, GII PI A0, umur kehamilan 37 minggu, bersalin ditolong bidan B. Setelah kepala bayi lahir, terjadi kesulitan dalam melahirkan bahu. Taksiran berat janin Ny. S 4000 gr. Posisi yang tepat dipakai bidan B untuk melahirkan bahu bayi Ny. S..', 'Klasik', 'Lovset', 'Muller', 'Mc. Robert', 'Maurisceau', 'd', '4', 'sedang', 'yes'),
(181, 3, 'persalinan/nifas', 'Ny. S, usia 23 tahun, GII PI A0, umur kehamilan 37 minggu, bersalin ditolong bidan B. Setelah kepala bayi lahir, terjadi kesulitan dalam melahirkan bahu. Taksiran berat janin Ny. S 4000 gr. Komplikasi yang dapat terjadi pada bayi Ny. S apabila terjadi kesalahan dalam melahirkan bahu..', 'Torsi Servical', 'Fraktur Skapula', 'Fraktur Servical', 'Fraktur Klavikula', 'Fraktur Mandibula', 'd', '3', 'sedang', 'yes'),
(182, 3, 'persalinan/nifas', 'Ny. S, usia 23 tahun, GII PI A0, umur kehamilan 37 minggu, bersalin ditolong bidan B. Setelah kepala bayi lahir, terjadi kesulitan dalam melahirkan bahu. Taksiran berat janin Ny. S 4000 gr. Faktor predisposisi pada kasus Ny. S adalah..', 'CPD', 'Makrosomia', 'Mal posisi bayi', 'Lilitan talipusat', 'Talipusat menumbung', 'b', '3', 'sedang', 'yes'),
(183, 3, 'persalinan/nifas', 'Ny. U, 36 tahun, G VII PV AI. Segera setelah plasenta lahir lengkap terjadi perdarahan, kontraksi uterus lembek serta TFU sulit ditentukan. Hasil pemeriksaan tidak ada robekan jalan lahir, kandung kemih kosong. Tindakan yang harus dilakukan pada Ny. U adalah..', 'Mengosongkan kandung kemih', 'Memberikan obat anti coagulan', 'Memberikan injeksi utero tonika', 'Memeriksa kelengkapan plasenta', 'Melakukan kompresi bimanual interna', 'e', '4', 'sedang', 'yes'),
(184, 3, 'persalinan/nifas', 'Ny. U, 36 tahun, G VII PV AI . Segera setelah plasenta lahir lengkap terjadi perdarahan, kontraksi uterus lembek serta TFU sulit ditentukan. Hasil pemeriksaan tidak ada robekan jalan lahir, kandung kemih kosong. Faktor predisposisi pada kasus Ny. U adalah..', 'Gemelli', 'Usia ibu', 'Primipara', 'Multipara', 'Grande multipara', 'e', '3', 'sedang', 'yes'),
(185, 3, 'persalinan/nifas', 'Ny. U, 36 tahun, G VII PV AI. Segera setelah plasenta lahir lengkap terjadi perdarahan, kontraksi uterus lembek serta TFU sulit ditentukan. Hasil pemeriksaan tidak ada robekan jalan lahir, kandung kemih kosong. Apabila tidak segera ditangani, kemungkinan yang terjadi..', 'Syok septic', 'Syok anafilaktic', 'Syok neurogenic', 'Syok kardiogenic', 'Syok hipovolemik', 'e', '4', 'sedang', 'yes'),
(186, 3, 'persalinan/nifas', 'Ny. U, 36 tahun, G VII PV AI. Segera setelah plasenta lahir lengkap terjadi perdarahan, kontraksi uterus lembek serta TFU sulit ditentukan. Hasil pemeriksaan tidak ada robekan jalan lahir, kandung kemih kosong. Penanganan awal agar tidak terjadi syok pada kasus Ny. U, dilakukan tindakan..', 'Pemberian antibiotik', 'Pemberian analgetik', 'Pemberian diuretika', 'Pemberian injeksi vitamin K', 'Pemberian cairan infus RL', 'e', '4', 'sedang', 'yes'),
(187, 3, 'persalinan/nifas', 'Ny. S usia 38 tahun G2 P0 A1, datang ke bidan inpartu sisa dukun, kenceng - kenceng sering, dan teratur sejak 2 hari yang lalu. Telah di pimpin mengejan oleh dukun 3 jam yang lalu. KU Lemah, kelelahan. Tekanan darah 90/60 mmHg, nadi 100 x/menit, suhu 39 ◦C, VT pembukaan 8 cm, kepala turun di hodge III, DJJ 182 x/menit. Sesuai kasus diagnose Ny. S adalah..', 'Partus lama', 'Partus kasep', 'Partus macet', 'Partus lambat', 'Partus tak maju', 'a', '4', 'sedang', 'yes'),
(188, 3, 'persalinan/nifas', 'Ny. S usia 38 tahun G2 P0 A1, datang ke bidan inpartu sisa dukun, kenceng - kenceng sering dan teratur sejak 2 hari yang lalu. Telah di pimpin mengejan oleh dukun 3 jam yang lalu. KU Lemah, kelelahan. Tekanan darah 90/60 mmHg, nadi 100 x/menit, suhu 39 ◦C, VT pembukaan 8 cm, kepala turun di hodge III, DJJ 182x/menit. Tindakan yang seharusnya dilakukan oleh bidan pada Ny. S adalah..', 'Suntik vitamin B12', 'Rujuk dengan infus', 'Anjurkan makan dan minum', 'Pasang infuse RL', 'induksi persalinan', 'b', '4', 'sedang', 'yes'),
(189, 3, 'persalinan/nifas', 'Ny. S usia 38 tahun G2 P0 A1, datang ke bidan inpartu sisa dukun, kenceng - kenceng sering dan teratur sejak 2 hari yang lalu. Telah di pimpin mengejan oleh dukun 3 jam yang lalu. KU Lemah, kelelahan. Tekanan darah 90/60 mmHg, nadi 100 x/menit, suhu 39 ◦C, VT pembukaan 8 cm, kepala turun di hodge III, DJJ 182x/menit. Sesuai data persalinan Ny. S segera di akhiri dengan..', 'Sectio caesarea', 'Versi ekstraksi', 'Forcep ekstraksi', 'Vaccum ekstraksi', 'Induksi persalinan', 'a', '4', 'sedang', 'yes'),
(190, 3, 'persalinan/nifas', 'Ny. T umur 27 tahun G4 P3 A0 hamil aterm datang ke polindes Mawar. Ia datang di antar suaminya dengan keluhan kejang - kejang. Setelah dilakukan pemeriksaan di temukan TD 190/140 mmHg, muka, tangan dan kaki oedema, VT pembukaan serviks 5 cm. Berdasarkan pengkajian yang dilakukan Ny. T, maka diagnosa yang tepat untuk kasus diatas adalah..', 'Eklamsia', 'Pre-eklamsi berat', 'Pre-eklamsi sedang', 'Pre-eklamsi ringan', 'Superimposed pre-eklamsi', 'a', '4', 'sedang', 'yes'),
(191, 3, 'persalinan/nifas', 'Ny. T umur 27 tahun G4 P3 A0 hamil aterm datang ke polindes Mawar. Ia datang di antar suaminya dengan keluhan kejang - kejang. Setelah dilakukan pemeriksaan di temukan TD 190/140 mmHg, muka, tangan dan kaki oedema, VT pembukaan serviks 5 cm. Tindakan yang harus dilakukan pada Ny, T sebelum di rujuk adalah..', 'Berikan O2', 'Berikan MgSO4.', 'Berikan infuse RL', 'Tidurkan miring ke kiri', 'Berikan glukonas kalsium', 'b', '4', 'sedang', 'yes'),
(192, 3, 'persalinan/nifas', 'Ny. Sarah, 25 tahun, G1P0A0, hamil 38 minggu, datang ke BPM pukul 08.00 WIB, mengeluh perut kenceng - kenceng, hasil pemeriksaan: KU baik, TD: 110/70 mmHg, nadi 80 x/menit, respirasi 24 x/menit, TFU 30 cm, kepala sudah masuk 2/5, hasil VT pembukaan serviks 8 cm, selaput ketuban masih utuh, ibu mengatakan cemas menghadapi persalinan. Diagnosa kebidanan Ny. Sarah adalah..', 'Inpartu kala I fase laten', 'Inpartu kala I fase aktif akselerasi', 'Inpartu kala I fase aktif deselerasi', 'Inpartu kala I fase aktif dilatasi maksimal', 'Kala II', 'd', '4', 'sedang', 'yes'),
(193, 3, 'persalinan/nifas', 'Ny. Sarah, 25 tahun, G1P0A0, hamil 38 minggu, datang ke BPM pukul 08.00 WIB, mengeluh perut kenceng - kenceng, hasil pemeriksaan: KU baik, TD: 110/70 mmHg, nadi 80 x/menit, respirasi 24 x/menit, TFU 30 cm, kepala sudah masuk 2/5, hasil VT pembukaan serviks 8 cm, selaput ketuban masih utuh, ibu mengatakan cemas menghadapi persalinan. Data fokus yang menunjukkan Ny. Sarah dalam proses persalinan..', 'Kepala masuk 2/5', 'TFU 30 cm', 'Kenceng-kenceng', 'Pembukaan serviks 8 cm', 'Umur ibu 25 tahun', 'd', '4', 'sedang', 'yes'),
(194, 3, 'persalinan/nifas', 'Ny. Sarah, 25 tahun, G1P0A0, hamil 38 minggu, datang ke BPM pukul 08.00 WIB, mengeluh perut kenceng - kenceng, hasil pemeriksaan: KU baik, TD 110/70 mmHg, nadi 80 x/menit, respirasi 24x/menit, TFU 30 cm, kepala sudah masuk 2/5, hasil VT pembukaan serviks 8 cm, selaput ketuban masih utuh, ibu mengatakan cemas menghadapi persalinan. Setelah dievaluasi, ibu menyatakan ingin meneran, tindakan bidan adalah..', 'Memecah ketuban', 'Memimpin persalinan', 'Memastikan pembukaan lengkap', 'Menganjurkan ibu untuk mengatur pernafasan', 'Meminta ibu untuk tidak melakukan apa-apa', 'c', '4', 'sedang', 'yes'),
(195, 3, 'persalinan/nifas', 'Ny. Mira umur 25 tahun PI A0 AHI baru saja melahirkan bayinya secara spontan, keadaan bayinya menangis kuat, kemerahan pada kulit, dan tonus ototnya baik. Sedangkan plasenta belum lahir, tinggi fundus uteri masih setinggi pusat, sudah terdapat tanda - tanda pelepasan plasenta. Ny. Mira saat ini dalam kondisi..', 'Inpartu fase aktif', 'Post partum', 'Inpartu kala II', 'Inpartu Kala III', 'Inpartu kala IV', 'd', '4', 'sedang', 'yes'),
(196, 3, 'persalinan/nifas', 'Ny. Mira umur 25 tahun PI A0 AHI baru saja melahirkan bayinya secara spontan, keadaan bayinya menangis kuat, kemerahan pada kulit dan tonus ototnya baik. Sedangkan plasenta belum lahir, tinggi fundus uteri masih setinggi pusat, sudah terdapat tanda - tanda pelepasan plasenta. Tindakan yang dilakukan bidan berdasarkan kasus Ny. Mira adalah..', 'Pastikan janin tunggal', 'Injeksi oksitosin', 'Penegangan tali pusat terkendali', 'Melahirkan plasenta', 'Memimpin meneran', 'a', '4', 'sedang', 'yes'),
(197, 3, 'persalinan/nifas', 'Kesejahteraan janin pada saat proses persalinan pada kala I dapat dimonitor dari..', 'Vital Sign ibu', 'Kekuatan dan frekuensi his', 'DJJ dan warna air ketuban saat pecah', 'Kontraksi uterus', 'Penurunan kepala janin melalui bidang Hodge', 'c', '4', 'sedang', 'yes'),
(198, 3, 'persalinan/nifas', 'Untuk memperlancar penurunan kepala janin pada kala I yang dimonitor adalah..', 'Selaput ketuban', 'Kandung kencing', 'Pembukaan serviks tiap 4 jam', 'Suhu tubuh (Vital Sign) tiap 1 jam', 'Pemeriksaan DJJ', 'b', '3', 'sedang', 'yes'),
(199, 3, 'persalinan/nifas', 'Perubahan yang terjadi pada serviks saat proses persalinan adalah..', 'Pembukaan serviks', 'Penutupan serviks', 'Effasemen dan dilatasi serviks', 'Pendataran dan penutupan serviks', 'Penebalan serviks', 'c', '4', 'sedang', 'yes'),
(200, 3, 'persalinan/nifas', 'Organ yang berperan pasif dan akan menipis dengan majunya persalinan karena diregangkan adalah..', 'Segmen bawah rahim', 'Segmen atas rahim', 'Vagina', 'Serviks uteri', 'Vulva', 'a', '4', 'sedang', 'yes'),
(201, 3, 'persalinan/nifas', 'Bila dalam penatalaksanaan menejemen aktif Kala III dan ternyata oxytosin tidak tersedia maka tindakan yang dapat dilakukan adalah', 'Segera melakukan massase uterus', 'Segera melakukan massese talipusat', 'Minta ibu atau keluarga untuk menstimulasi puting susu', 'Memberikan suntikan metergin 0,2 mg secara IM sebelum plasenta lahir', 'Letakkan anak di atas perut ibu', 'a', '3', 'sedang', 'yes'),
(202, 3, 'persalinan/nifas', 'Berikut penyebab langsung kematian ibu, kecuali..', 'Abortus', 'Terlalu muda', 'Persalinan macet', 'Eklampsia', 'Infeksi', 'b', '4', 'sedang', 'yes'),
(203, 3, 'persalinan/nifas', 'Tindakan kelahiran dengan sectio caesarea dengan membutuhkan tim operasi melaksanakan tindakan tersebut merupakan upaya contoh', 'Kolaborasi', 'Primer', 'Kerjasama', 'Rujukan', 'Mandiri', 'a', '3', 'sulit', 'yes'),
(204, 3, 'persalinan/nifas', 'Jika seorang ibu mengalami tanda dan gejala seperti uterus tidak berkontraksi dan lembek serta perdarahan segera setelah anak lahir, kemudian terjadi syok dan terdapat bekuan darah pada serviks, maka diagnosa yang bisa ditegakkan adalah', 'Atonia uteri', 'Robekan jalan lahir', 'Retensio plasenta', 'Tertinggalnya sebagian plasenta atau ketuban', 'Inversi uteri', 'a', '5', 'sulit', 'yes'),
(205, 3, 'persalinan/nifas', 'Jika terjadi darah segar yang mengalir segera setelah bayi lahir, uterus kontraksi dan keras, plasenta lengkap kemudian ibu lemah dan pucat, diagnosa yang bisa ditegakkan adalah', 'Atonia uteri', 'Robekan jalan lahir', 'Retensio plasenta', 'Tertinggalnya sebagian plasenta atau ketuban', 'Inversi uteri', 'b', '4', 'sulit', 'yes'),
(206, 3, 'persalinan/nifas', 'Jika seorang ibu dengan uterus tidak teraba, lumen vagina terisi masa, tampak tali pusat (bila plasenta belum lahir)', 'Atonia uteri', 'Robekan jalan lahir', 'Retensio plasenta', 'Tertinggalnya sebagian plasenta atau ketuban', 'Inversi uteri', 'e', '4', 'sulit', 'yes'),
(207, 3, 'persalinan/nifas', 'Jika seorang ibu bersalin dengan plasenta atau sebagian selaput (mengandung pembuluh darah) tidak lengkap, perdarahan segera dengan uterus berkontraksi tetapi tinggi fundus tidak berkurang, diagnosa yang bisa ditegakkan adalah', 'Atonia uteri', 'Robekan jalan lahir', 'Retensio plasenta', 'Tertinggalnya sebagian plasenta atau ketuban', 'Inversi uteri', 'd', '4', 'sulit', 'yes'),
(208, 3, 'persalinan/nifas', 'Ny. S usia 38 tahun G2 P0 A1, datang ke bidan inpartu sisa dukun, kenceng - kenceng sering dan teratur sejak 2 hari yang lalu. Telah di pimpin mengejan oleh dukun 3 jam yang lalu. KU Lemah, kelelahan. Tekanan darah 90/60 mmHg, nadi 100 x/menit, suhu 39 ◦C, VT pembukaan 8 cm, kepala turun di hodge III, DJJ 182 x/menit. Komplikasi yang dialami Ny. S adalah..', 'sepsis', 'Febris', 'foetal distress', 'Infeksi intra partum', 'Ruptur Uteri Incompletus', 'd', '4', 'sulit', 'yes'),
(209, 3, 'persalinan/nifas', 'Ny. T umur 27 tahun G4 P3 A0 hamil aterm datang ke polindes Mawar. Ia datang di antar suaminya dengan keluhan kejang - kejang. Setelah dilakukan pemeriksaan di temukan TD 190/140 mmHg, muka, tangan dan kaki oedema, VT pembukaan serviks 5 cm. Yang harus di perhatikan bidan sebagai syarat sebelum memberikan obat anti kejang adalah..', 'Reflek patella negative', 'TD < 200/160 mmHg', 'Pernafasan >16 x/menit', 'Produksi urine <30 cc selama 6 jam terakhir', 'Produksi urine <30 cc selama 4 jam terakhir', 'e', '4', 'sulit', 'yes'),
(210, 3, 'persalinan/nifas', 'Ny. T umur 27 tahun G4 P3 A0 hamil aterm datang ke polindes Mawar. Ia datang di antar suaminya dengan keluhan kejang - kejang. Setelah dilakukan pemeriksaan di temukan TD 190/140 mmHg, muka, tangan dan kaki oedema, VT pembukaan serviks 5 cm. Diagnosa potensial yang dapat terjadi pada kasus tersebut di atas adalah..', 'IUFD', 'Infeksi', 'Partus lama', 'Partus macet', 'Partus prematurus', 'a', '4', 'sulit', 'yes'),
(211, 3, 'persalinan/nifas', 'Ny. T umur 27 tahun G4 P3 A0 hamil aterm datang ke polindes Mawar. Ia datang di antar suaminya dengan keluhan kejang - kejang. Setelah dilakukan pemeriksaan di temukan TD 190/140 mmHg, muka, tangan dan kaki oedema, VT pembukaan serviks 5 cm. Untuk mengantisipasi kondisi yang lebih buruk, tindakan yang harus dilakukan bidan adalah..', 'Segera rujuk', 'Siapkan oksigen', 'Siapkan tong spatel', 'Tidurkan miring ke kiri', 'Segera akhiri persalinan', 'a', '4', 'sulit', 'yes'),
(212, 3, 'persalinan/nifas', 'Seorang perempuan usia 30 tahun, inpartu kala I fase aktif datang ke BPM dari hasil pemeriksaan diperoleh pada pemeriksaan abdomen teraba kepala janin 3/5 diatas sympisis pubis, PD: portio tipis lunak, pembukaan 8 cm, selaput ketuban utuh, teraba fontanel anterior dan orbita. Apakah Presentasi janin pada kasus di atas?', 'Presentasi Muka', 'Prentasi Dahi', 'Presentasi Dagu', 'Presentasi Kepala', 'Presntasi Bokong', 'a', '4', 'sulit', 'yes'),
(213, 3, 'persalinan/nifas', 'Ny. "M" melahirkan anak pertamanya 1 hari yang lalu, bayi dan ibu dalam keadaan normal. Jenis lochea Ny. "M" adalah..', 'Alba', 'Rubra', 'Serosa', 'Sanguinolenta', '', 'b', '5', 'mudah', 'yes'),
(214, 3, 'persalinan/nifas', 'Ny. "M" melahirkan anak pertamanya 1 hari yang lalu, bayi dan ibu dalam keadaan normal. Ny. "M" disarankan menyusui bayinya karena banyak manfaatnya bagi ibu maupun bayi. Adapaun jenis ASI Ny. "M" adalah..', 'Kolostrum', 'ASI akhir', 'ASI biasa', 'ASI Perah', '', 'a', '5', 'mudah', 'yes'),
(215, 3, 'persalinan/nifas', 'Tanda-tanda bahaya pada ibu nifas..', 'Perdarahan lewat jalan lahir', 'Bengkak di wajah, tangan dan kaki, atau sakit kepala dan kejang-kejang', 'Payudara bengkak, merah disertai rasa sakit', 'Semua benar', '', 'd', '3', 'mudah', 'yes'),
(216, 3, 'persalinan/nifas', 'Seorang perempuan usia 28 tahun, melahirkan 8 jam yang lalu di RB, mengeluh mules dan mengeluarkan darah pervaginam sedikit, ASI belum keluar, merasa cemas dengan keadaannya. Hasil pemeriksaan: TTV dalam batas normal, tidak ditemukan kelainan pada payudara', 'Ibu post partum normal', 'Ibu post partum dengan depresi', 'Ibu post partum dengan sub involusio', 'Ibu post partum dengan bendungan ASI', 'Ibu post partum dengan psikosis', 'a', '3', 'mudah', 'yes'),
(217, 3, 'persalinan/nifas', 'Seorang perempuan usia 24 tahun melahirkan anak yang ke dua 6 hari yang lalu, datang ke BPM mengeluh pusing sudah 2 hari yang lalu, jahitan perineum yang terasa nyeri. Hasil pemeriksaan TTV dalam batas normal, terlihat bekas jahitan perineum merah. Apakah asuhan yang tepat pada kasus tersebut?', 'Menilai perdarahan', 'Memberikan nutrisi', 'Penkes tentang KB', 'Berikan kompres air hangat', 'Berikan parasetamol 3 x 500 mg', 'e', '3', 'mudah', 'yes'),
(218, 3, 'persalinan/nifas', 'Seorang perempuan usia 25 tahun melahirkan 2 hari yang lalu di BPM, mengeluh perut mulas, sulit tidur. Hasil pemeriksaan TTV dalam batas normal, lochea warna merah. Berapakah tinggi fundus uteri yang normal sesuai kasus tersebut?', 'Tidak teraba', 'Setinggi pusat', '2 jari di bawah pusat', '2 jari di atas pusat', 'Pertengahan pusat dan simfisis', 'c', '3', 'mudah', 'yes'),
(219, 3, 'persalinan/nifas', 'Seorang perempuan usia 27 tahun, melahirkan anak pertama di rumah 2 jam yang lalu, mengeluh mules - mules. Hasil pemeriksaan tanda-tanda vital normal, ASI keluar sedikit berwarna kekuningan, lochea berwarna merah, jahitan perineum baik. Apakah diagnosis ibu pada kasus tersebut?', 'Post-partum puerpureum dini', 'Post-partum laten puerperium', 'Post-partum puerpurium lanjut', 'Post-partum puerperium tengah', 'Post-partum puerperium intermitten', 'a', '3', 'mudah', 'yes'),
(220, 3, 'persalinan/nifas', 'Seorang ibu, usia 27 tahun melahirkan 6 jam yang lalu di BPM mengeluh takut duduk dan bangkit dari tempat tidur. Hasil pemeriksaan: TTV dalam batas normal, TFU 2 jari di bawah pusat, pengeluaran darah vagina berwarna merah segar, tampak bekas jahitan luka perineum. Lochea apakah yang ditemukan pada kasus tersebut?', 'Lochea alba', 'Lochea serosa', 'Lochea rubra', 'Lochea purulenta', 'Lochea sanguilenta', 'c', '4', 'mudah', 'yes'),
(221, 3, 'persalinan/nifas', 'Ny. Linda 28 tahun, post-partum 8 jam yang lalu, anak pertama partus di RB harapan bunda, mengeluh: mules, mengeluarkan darah pervaginam sedikit, ASI belum keluar, ibu merasa cemas dengan keadaannya. Dari hasil pemeriksaan tidak ditemukan adanya kelainan pada payudara ibu. Dari kasus tersebut apa yang dapat anda rumuskan..', 'Ibu post-partum normal*', 'Ibu post-partum dengan sub involusi', 'Ibu post-partum dengan bendungan ASI', 'Ibu post-partum dengan gangguan psikosis', 'Ibu post-partum dengan depresi', 'a', '4', 'mudah', 'yes'),
(222, 3, 'persalinan/nifas', 'Ny. Linda 28 tahun, post-partum 8 jam yang lalu, anak pertama partus di RB harapan bunda, mengeluh: mules, mengeluarkan darah pervaginam sedikit, ASI belum keluar, ibu merasa cemas dengan keadaannya. Dari hasil pemeriksaan tidak ditemukan adanya kelainan pada payudara ibu. Intervensi apa yang akan anda lakukan..', 'Rujuk ke puskesmas', 'Rujuk ke puskesmas rawat inap', 'Konseling tentang perubahan masa nifas*', 'Beri therapy sesuai keluhan', 'Anjurkan minum banyak', 'c', '3', 'mudah', 'yes'),
(223, 3, 'persalinan/nifas', 'Ny. Linda 28 tahun, post-partum 8 jam yang lalu, anak pertama partus di RB harapan bunda, mengeluh: mules, mengeluarkan darah pervaginam sedikit, ASI belum keluar, ibu merasa cemas dengan keadaannya. Dari hasil pemeriksaan tidak ditemukan adanya kelainan pada payudara ibu. Penatalaksanaan yang saudara berikan untuk mengatur keluhan mules pada Ny. Linda adalah..', 'Berikan analgetik', 'Berikan kompres hangat pada daerah perut', 'Berikan konseling bahwa keluhan mules adalah keadaan normal*', 'Rujuk untuk penanganan lebih lanjut', 'Susukan bayi sesering mungkin', 'c', '3', 'mudah', 'yes'),
(224, 3, 'persalinan/nifas', 'Jika ibu post partum mengalami laserasi pada saat persalinan, maka nasehat yang diberikan adalah, kecuali..', 'Membersihkan daerah kelamin dengan sabun dan air', 'Membersihkan vulva sehabis BAK dengan larutan desinfektan', 'Mengompres luka dengan alkohol dan air panas', 'Membersihkan daerah kelamin secara rutin', 'Ganti pembalut setidaknya 1 kali sehari', 'c', '2', 'mudah', 'yes'),
(225, 3, 'persalinan/nifas', 'Perasaan mulas pada ibu post partum menunjukkan..', 'Adanya gangguan sistem gastrointestinal', 'Berlangsungnya proses evolusi', 'Kontraksi yang normal', 'Potensial perdarahan abnormal', 'Ibu tidak menyusui dengan baik', 'c', '2', 'mudah', 'yes'),
(226, 3, 'persalinan/nifas', 'Masa nifas dikatakan abnormal apabila..', 'Tidak BAB selama 12 jam PP', 'Frekuensi BAK meningkat', 'ASI belum lancar setelah 2 jam PP', 'Kelelahan yang berlebih', 'Pengeluaran pervaginam berbau', 'e', '2', 'mudah', 'yes'),
(227, 3, 'persalinan/nifas', 'Pengeluaran lochea berupa darah merah merupakan..', 'Lochea rubra', 'Lochea sanguinolenta', 'Lochea alba', 'Lochea Albican', 'Lochea abnormal', 'a', '2', 'mudah', 'yes'),
(228, 3, 'persalinan/nifas', 'Ny. Linda 28 tahun, post-partum 8 jam yang lalu, anak pertama partus di RB Harapan Keluarga, mengeluh: mules dan mengeluarkan darah pervaginam sedikit, ASI belum keluar, ibu merasa cemas dengan keadaannya. Dari hasil pemeriksaan tidak ditemukan adanya kelainan pada payudara ibu. Penatalaksanaan yang saudara berikan untuk mengatur keluhan mules pada Ny. Linda adalah..', 'Berikan Antibiotic', 'Berikan kompres hangat pada daerah perut', 'Berikan konseling bahwa keluhan mules adalah keadaan normal', 'Rujuk untuk penanganan lebih lanjut', 'Susukan bayi sesering mungkin', 'c', '2', 'mudah', 'yes'),
(229, 3, 'persalinan/nifas', 'Dibawah ini merupakan manfaat rawat gabung adalah..', 'Ibu dapat istirahat dengan cukup', 'Bayi sedini mungkin mendapat ASI', 'Bayi ditempatkan pada perawatan khusus', 'Ibu dapat memperoleh perawatan sempurna', 'Bayi tidak takut', 'b', '2', 'mudah', 'yes'),
(230, 3, 'persalinan/nifas', 'Rasa nyeri pada post partum kemungkinan disebabkan oleh..', 'Adanya sisa plasenta', 'Adanya proses involusi', 'Adanya infeksi traktus genitatalis', 'Akibat kelelahan pada waktu bersalin', 'Relaksasi uterus', 'b', '2', 'mudah', 'yes'),
(231, 3, 'persalinan/nifas', 'Untuk mempercepat penyembuhan luka episiotomi, perlu dilakukan tindakan kecuali..', 'Mobilisasi dini', 'Kolaborasi pemberian antibiotik', 'Istirahat panjang', 'Vulva hygiene dengan air bersih', 'Makan makanan gizi seimbang', 'c', '3', 'mudah', 'yes'),
(232, 3, 'persalinan/nifas', 'Seorang perempuan usia 25 tahun melahirkan 1 hari yang lalu di BPM, mengeluh perut mules, sulit tidur. Hasil pemeriksaan TTV dalam batas normal, lochea warna merah. Berapakah tinggi fundus uteri yang normal sesuai kasus tersebut..', 'Tidak teraba', 'Setinggi pusat', '2 jari diawah pusat', '2 jari diatas pusat', 'pertengahan pusat dan symfisis', 'c', '4', 'mudah', 'yes'),
(233, 3, 'persalinan/nifas', 'Seorang ibu, usia 27 tahun melahirkan 6 jam yang lalu di BPM mengeluh takut duduk dan bangkit dari tempat tidur. Hasil pemeriksaan: TTV dalam batas normal, TFU 2 jari di bawah pusat, pengeluaran darah vagina berwarna merah segar, tampak bekas jahitan luka perineum. Lochea apakah yang ditemukan pada kasus tersebut..', 'Lochea alba', 'Lochea serosa', 'Lochea rubra', 'Lochea purulenta', 'Lochea sanguilenta', 'c', '3', 'mudah', 'yes'),
(234, 3, 'persalinan/nifas', 'Suatu keadaan setelah plasenta lahir sampai kembalinya alat kandungan seperti semula disebut', 'Konsepsi', 'Nidasi', 'Persalinan', 'Kontrasepsi', 'Puerperium', 'e', '3', 'mudah', 'yes'),
(235, 3, 'persalinan/nifas', 'Involusio uteri berlangsung kira - kira selama', '2 Jam', '6 - 8 Jam', '6 Hari', '2 Minggu', '6 minggu', 'e', '3', 'mudah', 'yes'),
(236, 3, 'persalinan/nifas', 'Pendidikan kesehatan yang dapat diberikan pada masa nifas adalah', 'Pelayanan keluarga berencana', 'Cara konsumsi dan manfaat tablet Fe', 'Deteksi dini komplikasi kehamilan', 'Perawatan payudara prenatal', 'Skrining PMS', 'a', '3', 'mudah', 'yes'),
(237, 3, 'persalinan/nifas', 'Bidan mempunyai peranan yang sangat penting dalam pemberian asuhan post partum. Adapun peran dan tanggung jawab tersebut antara lain', 'Pemberian dukungan yang tidak berkesinambungan selama masa nifas', 'Sebagai promotor hubungan ibu dan bayi serta keluarga', 'Menghambat ibu untuk untuk menyusui bayinya', 'Berperan pasif dalam membuat kebijakan dan rencana program yang berkaitan dengan kesehatan ibu dan anak', 'Melakukan rujukan bila sudah terjadi kegawatdaruratan', 'b', '3', 'mudah', 'yes'),
(238, 3, 'persalinan/nifas', 'Peran bidan dalam memberikan konseling bagi ibu dan keluarga pada masa nifas mengenai', 'Cara melakukan senam hamil', 'Tanda bahaya masa nifas', 'Skrining bayi baru lahir', 'Personal higiene persalinan', 'Gizi kurang seimbang masa nifas', 'b', '3', 'mudah', 'yes'),
(239, 3, 'persalinan/nifas', 'Tahapan masa nifas terbagi dalam', '2 Tahap', '3 Tahap', '4 Tahap', '5 Tahap', '6 Tahap', 'b', '3', 'mudah', 'yes'),
(240, 3, 'persalinan/nifas', 'Suatu masa kepulihan dimana ibu diperbolehkan berdiri dan berjalan-jalan disebut', 'Remote puerperium', 'Puerperium intermedial', 'Puerperium dini', 'Puerperium', 'Late puerperium', 'c', '3', 'mudah', 'yes'),
(241, 3, 'persalinan/nifas', 'Asuhan yang tepat diberikan pada 6-8 jam post partum adalah', 'Mencegah perdarahan oleh karena atonia uteri', 'Pemberian ASI lanjut', 'Pemberian konseling perawatan bayi baru lahir', 'Menilai tanda-tanda infeksi nifas', 'KB secara dini', 'a', '4', 'mudah', 'yes'),
(242, 3, 'persalinan/nifas', 'Pemberian ASI awal diberikan pada kunjungan', 'Kunjungan awal', 'Kunjungan I', 'Kunjungan II', 'Kunjungan III', 'Kunjungan IV', 'b', '4', 'mudah', 'yes'),
(243, 3, 'persalinan/nifas', 'Ny. "M" melahirkan anak pertamanya 1 hari yang lalu, bayi dan ibu dalam keadaan normal. Bila dilakukan pemeriksaan maka akan ditemukan TFU Ny. "M" ...', 'Setinggi pusat', '1 jari di bawah pusat', '3 jari di atas pusat', '1 jari di atas simpisis', '', 'b', '5', 'sedang', 'yes'),
(244, 3, 'persalinan/nifas', 'Infeksi yang terkait dengan persalinan dan menyebabkan kenaikan temperatur tubuh mulai hari ke 2 nifas disebut dengan', 'Infeksi nifas', 'Infeksi persalinan', 'Infeksi bayi', 'Infeksi kehamilan', 'Infeksi jalan lahir', 'a', '3', 'sedang', 'yes'),
(245, 3, 'persalinan/nifas', 'Jika seorang ibu postpartum mengalami payudara yang tegang dan padat kemerahan, pembengkakan dengan adanya fluktusi, mengalir nanah, diagnosa yang ditegakkan adalah', 'Metritis (Endometritis/Endomiometritis)', 'Abses Pelvik', 'Bendungan pada payudara', 'Mastitis', 'Abses Payudara', 'e', '3', 'sedang', 'yes'),
(246, 3, 'persalinan/nifas', 'Jika seorang ibu postpartum mengalami nyeri perut bagian bawah, lockia purulen dan berbau, uterus tegang dan subinvolusi, diagnosa yang ditegakkan adalah', 'Metritis (Endometritis/Endomiometritis)', 'Abses Pelvik', 'Bendungan pada payudara', 'Mastitis', 'Abses Payudara', 'a', '3', 'sedang', 'yes'),
(247, 3, 'persalinan/nifas', 'Faktor predisposisi terjadinya infeksi nifas pada ibu postpartum adalah', 'Anemia', 'Kurang gizi atau malnutrisi', 'Higiene', 'Semua benar', 'Semua salah', 'd', '3', 'sedang', 'yes'),
(248, 3, 'persalinan/nifas', 'Jika terjadi luka yang mengeras disertai pengeluaran cairan serous atau kemerahan dari luka, tidak ada/ sedikit erithema dekat luka insisi, diagnosa yang ditegakkan adalah', 'Abses payudara', 'Selulitis pada luka', 'Abses atau hematoma pada luka', 'Infeksi pada traktus urinaris', 'Thrombosis vena dalam', 'c', '3', 'sedang', 'yes'),
(249, 3, 'persalinan/nifas', 'Seorang ibu, usia 23 tahun, melahirkan 2 jam yang lalu di klinik bidan, mengeluh merasa ada pengeluaran darah dari kemaluan, lemah dan pandangan berkunang-kunang. Hasil pemeriksaan menunjukkan wajah pucat, TD 90/60 mmhg, HR 76 x/I, TFU 1 jari di bawah pusat uterus teraba lembek dan volume perdarahan lebih kurang 200 cc', 'Atonia uteri', 'Rupture uteri', 'Inversion uteri', 'Retensio plasenta', 'Kelainan pembekuan darah', 'a', '4', 'sedang', 'yes'),
(250, 3, 'persalinan/nifas', 'Seorang perempuan usia 28 tahun, melahirkan 8 jam yang lalu di RB, mengeluh mules dan mengeluarkan darah pervaginam sedikit, ASI belum keluar, merasa cemas dengan keadaannya. Hasil pemeriksaan: TTV dalam batas normal, tidak ditemukan kelainan pada payudara.apakah penatalaksanaan mengatasi keluhan mules pada kasus tersebut?', 'Berikan analgetik', 'Susukan bayi sesering mungkin', 'Rujuk untuk penanganan lebih lanjut', 'Berikan kompres hangat pada daerah perut', 'Jelaskan keluhan mules adalah keadaan normal', 'e', '3', 'sedang', 'yes'),
(251, 3, 'persalinan/nifas', 'Seorang perempuan usia 23 tahun melahirkan anak pertama BB 2800 gr 2 hari yang lalu di BPM, mengeluh lelah, sering mengantuk, dan bersifat passif. Hasil pemeriksaan TTV dalam batas normal. Lochea berwarna merah. Apakah adaptasi psikososial yang dialami ibu pada kasus tersebut?', 'Taking in', 'Taking on', 'Letting go', 'Taking hold', 'Letting hold', 'a', '3', 'sedang', 'yes'),
(252, 3, 'persalinan/nifas', 'Seorang perempuan usia 37 tahun melahirkan anak ke-6, 4 jam yang lalu di BPM, mengeluh pusing lemas, 30 menit setelah plasenta lahir lengkap kontraksi uterus lemah. Hasil pemeriksaan TD 90/60 mmhg, Nadi 110 x/I, perdarahan 500 cc. Apakah diagnosis yang tepat pada kasus di atas?', 'Atonia uteri', 'Robekan pada perineum', 'Rupture uteri', 'Sub involution plasenta', 'His lemah', 'a', '5', 'sedang', 'yes'),
(253, 3, 'persalinan/nifas', 'Seorang ibu, usia 37 tahun melahirkan anak ke-6, 4 jam yang lalu di BPM, mengeluh pusing lemas, 30 menit setelah plasenta lahir lengkap, kontraksi uterus lemah. Hasil pemeriksaan TD 90/60 mmhg, nadi 110 x/I, perdarahan 500 cc. Apakah antisipasi masalah potensial untuk kasus tersebut?', 'Syok haemoragik', 'Infeksi puerperalis', 'Syock neurogenik', 'Infeksi perineum', 'Anemia berat', 'a', '5', 'sedang', 'yes'),
(254, 3, 'persalinan/nifas', 'Ny. Ayu umur 24 tahun datang ke bidan dengan keluhan: panas dan pusing sudah 2 hari yang lalu. Ny. Ayu habis melahirkan anak yang ke dua 6 hari yang lalu di Bidan dengan jahitan perineum yang terasa nyeri. Keadaan bayi Ny. Ayu sehat. Dari hasil pemeriksaan fisik didapatkan: tensi 110/70 mmhg, suhu 39 °C, Respirasi 28 x/menit, nadi 88 x/menit. HB 11 gr%. Tindakan yang dilakukan oleh bidan saat menjumpai kasus tersebut adalah..', 'Berikan kompres air hangat', 'Berikan parasetamol 3 x 500 mg', 'Observasi kontraksi', 'Jawaban A dan B benar', 'Jawaban A dan B benar', 'd', '4', 'sedang', 'yes'),
(255, 3, 'persalinan/nifas', 'Ny. Ayu umur 24 tahun datang ke bidan dengan keluhan: panas dan pusing sudah 2 hari yang lalu. Ny. Ayu habis melahirkan anak yang ke dua 6 hari yang lalu di Bidan dengan jahitan perineum yang terasa nyeri. Keadaan bayi Ny. Ayu sehat. Dari hasil pemeriksaan fisik didapatkan: tensi 110/70 mmhg, suhu 39 °C, Respirasi 28 x/menit, nadi 88 x/menit. HB 11 gr%. Keadaan yang di alami Ny. Ayu disebut..', 'Stress puerperium', 'Infeksi puerperium', 'Gejala puerperium', 'Proses puerperium', 'Adaptasi puerperium', 'b', '4', 'sedang', 'yes'),
(256, 3, 'persalinan/nifas', 'Tinggi Fundus Uteri pada 7 jam post partum berada pada..', 'Pertengahan pusat – sympisis', 'Setinggi pusat', '1 - 2 jari bawah pusat', '1 - 3 jari atas pusat', '1 - 2 jari atas sympisis', 'c', '4', 'sedang', 'yes'),
(257, 3, 'persalinan/nifas', 'Ny. Linda 28 tahun, post-partum 8 jam yang lalu, anak pertama partus di RB Harapan Keluarga, mengeluh: mules dan mengeluarkan darah pervaginam sedikit, ASI belum keluar, ibu merasa cemas dengan keadaannya. Dari hasil pemeriksaan tidak ditemukan adanya kelainan pada payudara ibu. Dari kasus tersebut apa yang dapat anda rumuskan..', 'Ibu post partum normal', 'Ibu post partum dengan sub involusi', 'Ibu post partum dengan depresi', 'Ibu post partum dengan bendungan ASI', 'Ibu post partum dengan gangguan psikosis', 'a', '3', 'sedang', 'yes'),
(258, 3, 'persalinan/nifas', 'Ny. Linda 28 tahun, post-partum 8 jam yang lalu, anak pertama partus di RB Harapan Keluarga, mengeluh: mules dan mengeluarkan darah pervaginam sedikit, ASI belum keluar, ibu merasa cemas dengan keadaannya. Dari hasil pemeriksaan tidak ditemukan adanya kelainan pada payudara ibu. Intervensi apa yang akan anda lakukan..', 'Rujuk ke puskesmas', 'Rujuk ke puskesmas rawat inap', 'Konseling tentang perubahan masa nifas', 'Beri therapy sesuai keluhan', 'Anjurkan minum banyak', 'c', '3', 'sedang', 'yes'),
(259, 3, 'persalinan/nifas', 'Senam kegel selama nifas perlu diberikan pada ibu nifas dengan tujuan..', 'Memperlancar sirkulasi darah', 'Mempercepat proses involusi uteri', 'Memperlancar produksi ASI', 'Mengencangkan otot-otot panggul', 'A, B, C, dan D benar', 'e', '3', 'sedang', 'yes'),
(260, 3, 'persalinan/nifas', 'Seorang ibu, usia 23 tahun, melahirkan 2 jam yang lalu di klinik bidan, mengeluh merasa ada pengeluaran darah dari kemaluan, lemah dan pandangan berkunang - kunang. Hasil pemeriksaan menunjukkan wajah pucat, TD 90/60 mmhg, HR 76 x/I, TFU 1 jari di bawah pusat uterus teraba lembek dan volume perdarahan lebih kurang 500 cc. Apakah diagnosa pada kasus tersebut..', 'Atonia uteri', 'Rupture uteri', 'Inversio uteri', 'Retensio plasenta', 'Kelainan pembekuan darah', 'a', '4', 'sedang', 'yes'),
(261, 3, 'persalinan/nifas', 'Seorang perempuan berusia 18 tahun, melahirkan bayi yang sehat minggu lalu di RS Bersalin dan pulang ke rumahnya setelah 2 hari melahirkan. Ibu baik - baik saja selama beberapa hari pertama, tetapi kemudian menjadi mudah menangis, tidak sabar bila bayinya agak sulit menyusu, khawatir ia bukan seorang ibu yang baik, ia merasa suaminya tidak lagi mencintainya. Apa yang sedang dialami oleh ibu ini?', 'Postpartum blues', 'Perubahan emosi', 'Psikosa postpartum', 'Depresi postpartum', 'Reaksi neurotis-obsesif', 'a', '3', 'sedang', 'yes'),
(262, 3, 'persalinan/nifas', 'Pada masa nifas, berlangsung tiga proses penting yaitu', 'Involusio uteri, hemokonsentrasi dan proses laktasi', 'Konsepsi, nidasi dan proses laktasi', 'Hemokonsentrasi, hemodilusi dan involusio uteri', 'Kala I, kala II dan kala III', 'Kontrasepsi, laktasi dan menyusui', 'a', '3', 'sedang', 'yes'),
(263, 3, 'persalinan/nifas', 'Tujuan pemberian asuhan pada masa nifas antara lain', 'Memberikan pendidikan kesehatan tentang perawatan ANC', 'Melaksanakan skrining pada waktu persalinan', 'Memberikan pelayanan kesehatan pra konsepsi', 'Menjaga kesehatan ibu dan bayi, baik fisik maupun psikologis', 'Mengacuhkan kesehatan emosi ibu', 'd', '3', 'sedang', 'yes'),
(264, 3, 'persalinan/nifas', 'Suatu masa dimana kepulihan dari organ-organ reproduksi selama kurang lebih enam minggu disebut', 'Remote puerperium', 'Puerperium intermedial', 'Puerperium dini', 'Puerperium', 'Late puerperium', 'b', '3', 'sedang', 'yes'),
(265, 3, 'persalinan/nifas', 'Waktu yang diperlukan untuk pulih dan sehat sempurna terutama bila selama hamil atau waktu saat persalinan mempunyai komplikasi, disebut', 'Remote puerperium', 'Puerperium intermedial', 'Puerperium dini', 'Puerperium', 'Late puerperium', 'a', '3', 'sedang', 'yes'),
(266, 3, 'persalinan/nifas', 'Berdasarkan kebijakan program nasional, kunjungan pada masa nifas dilakukan minimal', '1 Kali', '2 Kali', '3 Kali', '4 Kali', '5 Kali', 'd', '3', 'sedang', 'yes'),
(267, 3, 'persalinan/nifas', 'Tujuan dari kebijakan program nasional adalah', 'Menilai kondisi kesehatan ibu dan bayi', 'Melakukan pencegahan terhadap kemungkinan adanya gangguan kesehatan ibu dan bayi', 'Mendeteksi adanya komplikasi/ masalah yang terjadi pada masa nifas', 'Menangani komplikasi atau masalah yang timbul dan mengganggu kesehatan ibu dan bayi', 'Semua jawaban benar', 'e', '4', 'sedang', 'yes'),
(268, 3, 'persalinan/nifas', 'Memastikan ibu menyusui dengan baik dan benar serta tidak ada tanda-tanda kesulitan menyusui diberikan pada', '6 - 8 jam post partum', '6 hari post partum', '2 minggu post partum', '6 minggu post partum', '10 minggu post partum', 'b', '4', 'sedang', 'yes'),
(269, 3, 'persalinan/nifas', 'Asuhan pada 6 hari post partum dapat diberikan juga pada saat kunjungan nifas', '2 jam post partum', '6 - 8 jam post partum', '2 minggu post partum', '6 minggu post partum', '3 bulan pasca melahirkan', 'c', '4', 'sedang', 'yes'),
(270, 3, 'persalinan/nifas', 'Tanda-tanda persalinan?', 'Perut mulas-mulas yang teratur, timbulnya semakin sering dan semakin lama', 'Keluar lendir bercampur darah', 'Keluar air ketuban', 'Semua benar', '', 'd', '3', 'mudah', 'yes'),
(271, 3, 'persalinan/nifas', 'Tanda-tanda bahaya persalinan adalah..', 'Ibu mengalami kejang', 'Sakit pinggang menjalar ke perut bagian bawah', 'Ibu ingin meneran', 'Keluar lendir bercampur darah', '', 'a', '3', 'mudah', 'yes'),
(272, 3, 'persalinan/nifas', 'Seorang perempuan usia 35 tahun melahirkan di BPM. Pada saat 2 jam postpartum bidan melakukan pemeriksaan didapatkan uterus tidak berkontraksi dan terdapat perdarahan dari jalan lahir, vital sign: TD 90/70 mmHg, suhu 36.5 ᵒC R 18 x/m, dan nadi 80 x/mnt. Apakah diagnosis pada kasus di atas?', 'Atonia Uteri', 'Retensio Plasenta', 'Solusio Plasenta', 'Inversio Uteri', 'Prolaps Uteri', 'a', '4', 'mudah', 'yes'),
(273, 3, 'persalinan/nifas', 'Ny. K P5A0, 15 menit yang lalu telah melahirkan bayi laki-laki dan sudah mendapatkan 10 IU oksitosin, plasenta belum lahir PPV: darah ± 600 cc. Tindakan bidan selanjutnya adalah..', 'Melakukan PTT ulang', 'Kompresi bimanual interna', 'Melakukan manual plasenta', 'Menyuntik 10 UI oksitosin yang ke 2', 'Menunggu lepasnya plasenta sampai 30 menit', 'd', '4', 'sedang', 'yes'),
(274, 3, 'persalinan/nifas', 'Ny. K P5A0, 15 menit yang lalu telah melahirkan bayi laki-laki dan sudah mendapatkan 10 IU oksitosin, plasenta belum lahir PPV: darah ± 600 cc. Setelah tindakan yang harus dilakukan telah dilakukan, tetapi setelah 30 menit plasenta belum lahir maka diagnosa Ny. K adalah..', 'H.P.P', 'Atonia uteri', 'Inversio uteri', 'Plasenta restan', 'Retensio plasenta', 'e', '4', 'sedang', 'yes'),
(275, 3, 'persalinan/nifas', 'Ny. K P5A0, 15 menit yang lalu telah melahirkan bayi laki-laki dan sudah mendapatkan 10 IU oksitosin, plasenta belum lahir PPV : darah ± 600 cc. Tindakan\n  bidan selanjutnya apabila 30 menit plasenta belum lahir adalah..', 'KBI', 'Kuretase', 'Digital plasenta', 'Manual plasenta', 'Penegangan tali pusat terkendali', 'd', '3', 'sedang', 'yes'),
(276, 3, 'persalinan/nifas', 'Ny. N umur 35 tahun, hamil kedua melahirkan hidup 1 kali, datang ke BPM pada jam 10.00 WIB untuk bersalin. Ibu mengatakan kenceng - kenceng sejak jam 07.00 WIB, mengeluarkan cairan warna jernih jam 09.00 WIB. Hasil pemeriksaan KU baik, TD 120/80 mmHg, N 88 x/menit, S 36 ᵒC, RR 20 x/menit, his 3x dalam 10 menit, lama 45 detik, DJJ 144x/menit. Hasil VT pembukaan 8 cm, KK (-), teraba tali pusat di samping kepala. Diagnosa yang tepat untuk kasus diatas adalah..', 'Inpartu kala I KPD', 'Inpartu kala I fisiologis', 'Inpartu kala I tali pusat terkemuka', 'Inpartu kala I fase aktif memanjang', 'Inpartu kala I tali pusat menumbung', 'e', '4', 'sedang', 'yes'),
(277, 3, 'persalinan/nifas', 'Ny. N umur 35 tahun, hamil kedua melahirkan hidup 1 kali, datang ke BPM pada jam 10.00 WIB untuk bersalin. Ibu mengatakan kenceng - kenceng sejak jam 07.00 WIB, mengeluarkan cairan warna jernih jam 09.00 WIB. Hasil pemeriksaan KU baik, TD 120/80 mmHg, N 88 x/menit, S 36 ᵒC, RR 20x/menit, his 3x dalam 10 menit, lama 45 detik, DJJ 144x/menit. Hasil VT pembukaan 8 cm, KK (-), teraba tali pusat di samping kepala. Langkah awal yang dilakukan untuk menangani kasus diatas adalah..', 'Ibu ditidurkan dengan posisi fowler', 'Ibu ditidurkan dengan posisi litotomi', 'Ibu ditidurkan dengan posisi knee chest', 'Ibu ditidurkan dengan posisi semi fowler', 'Ibu ditidurkan dengan posisi trendelenberg', 'e', '4', 'sedang', 'yes'),
(278, 3, 'persalinan/nifas', 'Ny. N umur 35 tahun, hamil kedua melahirkan hidup 1 kali, datang ke BPM pada jam 10.00 WIB untuk bersalin. Ibu mengatakan kenceng - kenceng sejak jam 07.00 WIB, mengeluarkan cairan warna jernih jam 09.00 WIB. Hasil pemeriksaan KU baik, TD 120/80 mmHg, N 88 x/menit, S 36 ᵒC, RR 20 x/menit, his 3x dalam 10 menit, lama 45 detik, DJJ 144 x/menit. Hasil VT pembukaan 8 cm, KK (-), teraba tali pusat di samping kepala. Bila tidak ditangani dengan tepat, kemungkinan yang akan terjadi pada bayi adalah..', 'Fetal distres', 'Facial paralise', 'Fraktur klafikula', 'Terjadi perdarahan otak', 'Terjadi kesulitan pengeluaran bahu', 'a', '2', 'sedang', 'yes'),
(279, 3, 'persalinan/nifas', 'Ny. N umur 35 tahun, hamil kedua melahirkan hidup 1 kali, datang ke BPM pada jam 10.00 WIB untuk bersalin. Ibu mengatakan kenceng - kenceng sejak jam 07.00 WIB, mengeluarkan cairan warna jernih jam 09.00 WIB. Hasil pemeriksaan KU baik, TD 120/80 mmHg, N 88 x/menit, S 36 ᵒC, RR 20 x/menit, his 3x dalam 10 menit, lama 45 detik, DJJ 144 x/menit. Hasil VT pembukaan 8 cm, KK (-), teraba tali pusat di samping kepala. Tindakan bidan selanjutnya adalah..', 'Vakum ekstraksi', 'Tunggu dengan sabar', 'Pantau dengan partograf', 'Forcep dengan episiotomi', 'Informed consent untuk rujuk', 'e', '4', 'sedang', 'yes'),
(280, 3, 'persalinan/nifas', 'Ny. A G2 P1 A0 usia 32 tahun, hamil 40 minggu, datang ke klinik jam 08.00 WIB dengan keluhan kenceng - kenceng teratur sejak 4 jam yang lalu, perasaan berat, sesak nafas, dan bengkak pada kedua ekstremitas. TFU 41 cm, teraba 2 bagian besar janin berdampingan, DJJ terdengar jelas di dua tempat dengan frekuensi 120 x/menit dan 140 x/menit. Kemungkinan Ny. A saat ini mengalami..', 'Hidramnion', 'Mola hidatidosa', 'Kehamilan ganda', 'Presentasi bokong', 'Kehamilan dengan mioma', 'c', '3', 'sedang', 'yes'),
(281, 3, 'persalinan/nifas', 'Ny. A G2 P1 A0 usia 32 tahun, hamil 40 minggu, datang ke klinik jam 08.00 WIB dengan keluhan kenceng - kenceng teratur sejak 4 jam yang lalu, perasaan berat, sesak nafas, dan bengkak pada kedua ekstremitas. TFU 41 cm, teraba 2 bagian besar janin berdampingan, DJJ terdengar jelas di dua tempat dengan frekuensi 120 x/menit dan 140 x/menit. Jika dalam pemeriksaan diketahui presentasi janin bokong dan kepala, maka Ny. A harus melahirkan secara..', 'VE', 'SC', 'Forcep', 'Induksi persalinan', 'Partus pervaginam', 'b', '3', 'sedang', 'yes'),
(282, 3, 'persalinan/nifas', 'Ny. A G2 P1 A0 usia 32 tahun, hamil 40 minggu, datang ke klinik jam 08.00 WIB dengan keluhan kenceng - kenceng teratur sejak 4 jam yang lalu, perasaan berat, sesak nafas, dan bengkak pada kedua ekstremitas. TFU 41 cm, teraba 2 bagian besar janin berdampingan, DJJ terdengar jelas di dua tempat dengan frekuensi 120 x/menit dan 140 x/menit. Risiko yang mungkin dialami bayi Ny. A adalah..', 'BBLR', 'Mikrosomia', 'Fetal distress', 'Distocia bahu', 'Hidrocephalus', 'a', '3', 'sedang', 'yes'),
(283, 3, 'persalinan/nifas', 'Ny. A G2 P1 A0 usia 32 tahun, hamil 40 minggu, datang ke klinik jam 08.00 WIB dengan keluhan kenceng - kenceng teratur sejak 4 jam yang lalu, perasaan berat, sesak nafas, dan bengkak pada kedua ekstremitas. TFU 41 cm, teraba 2 bagian besar janin berdampingan, DJJ terdengar jelas di dua tempat dengan frekuensi 120 x/menit dan 140 x/menit. Pada saat bayi Ny. A lahir ternyata pendingin ruang persalinan lupa dimatikan, maka bayi Ny. A dapat mengalami kehilangan panas melalui proses..', 'Infeksi', 'Radiasi', 'Konveksi', 'Konduksi', 'Evaporasi', 'e', '3', 'sedang', 'yes'),
(284, 3, 'persalinan/nifas', 'Ny. N usia 35 tahun, G2P1Ao, hamil 39 minggu datang ke BPM pukul 10.00 WIB untuk bersalin. Ibu mengatakan kenceng - kenceng sejak jam 07.00 WIB & mengeluarkan cairan jernih jam 09.00 WIB. Hasil pemeriksaan TTV normal, his 3x dalam 10 menit lama 45 detik, DJJ 144 x/menit. VT vulva tidak ada kelainan, pembukaan 8 cm, KK (-) teraba tali pusat di samping kepala. Diagnosa yang tepat untuk kasus diatas adalah..', 'Inpartu kala I fisiologi', 'Inpartu kala I dengan KPD', 'Inpartu kala I dengan emboli air ketuban', 'Inpartu kala I dengan tali pusat terkemuka', 'Inpartu kala I dengan tali pusat menumbung', 'e', '3', 'sedang', 'yes'),
(285, 3, 'persalinan/nifas', 'Ny. N usia 35 tahun, G2P1Ao, hamil 39 minggu datang ke BPM pukul 10.00 WIB untuk bersalin. Ibu mengatakan kenceng - kenceng sejak jam 07.00 WIB & mengeluarkan cairan jernih jam 09.00 WIB. Hasil pemeriksaan TTV normal, his 3x dalam 10 menit lama 45 detik, DJJ 144 x/menit. VT vulva tidak ada kelainan, pembukaan 8 cm, KK (-) teraba tali pusat di samping kepala. Tujuan tindakan diatas terhadap janin adalah..', 'Memperlancar peredaran darah', 'Mempermudah reposisi tali pusat', 'Mempertahankan presentasi janin', 'Mengobservasi kemajuan persalinan', 'Mempertahankan kesejahteraan janin', 'e', '4', 'sedang', 'yes'),
(286, 3, 'persalinan/nifas', 'Ny. N usia 35 tahun, G2P1Ao, hamil 39 minggu datang ke BPM pukul 10.00 WIB untuk bersalin. Ibu mengatakan kenceng-kenceng sejak jam 07.00 WIB & mengeluarkan cairan jernih jam 09.00 WIB. Hasil pemeriksaan TTV normal, his 3x dalam 10 menit lama 45 detik, DJJ 144 x/menit. VT vulva tidak ada kelainan, pembukaan 8 cm, KK (-) teraba tali pusat di samping kepala. Bila tidak ditangani dengan tepat, kemungkinan yang akan terjadi pada bayi adalah..', 'Fetal distress', 'Facial paralise', 'Perdarahan otak', 'Infeksi post natal', 'Kesulitan pengeluaran bahu', 'a', '4', 'sedang', 'yes'),
(287, 3, 'persalinan/nifas', 'Ny. N usia 35 tahun, G2P1Ao, hamil 39 minggu datang ke BPM pukul 10.00 WIB untuk bersalin. Ibu mengatakan kenceng - kenceng sejak jam 07.00 WIB & mengeluarkan cairan jernih jam 09.00 WIB. Hasil pemeriksaan TTV normal, his 3x dalam 10 menit lama 45 detik, DJJ 144x/menit. VT vulva tidak ada kelainan, pembukaan 8 cm, KK (-) teraba tali pusat di samping kepala. Tindakan bidan selanjutnya adalah..', 'VE', 'Reposisi tali pusat', 'Tunggu dengan sabar', 'Pantau dengan partograf', 'Informed concent untuk rujuk', 'b', '4', 'sedang', 'yes'),
(288, 3, 'persalinan/nifas', 'Ny. F umur 22 tahun G1P0A0, hamil 40 minggu, datang di RS dengan riwayat DM. Saat ini sedang dalam proses persalinan kala II. Setelah kepala janin lahir, tidak terjadi putaran paksi luar. Diagnosa untuk Ny. F adalah..', 'Partus lama', 'Distosia bahu', 'Partus tak maju', 'Partus serotinus', 'Partus presipitatus', 'b', '4', 'sedang', 'yes');
INSERT INTO `soal` (`id`, `id_jenis_tes`, `kategori`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `pilihan_e`, `jawaban`, `level_of_importance`, `level`, `publish`) VALUES
(289, 3, 'persalinan/nifas', 'Ny. F umur 22 tahun G1P0A0, hamil 40 minggu, datang di RS dengan riwayat DM. saat ini sedang dalam proses persalinan kala II. Setelah kepala janin lahir, tidak terjadi putaran paksi luar. Faktor predisposisi dari janin yang dapat menyebabkan kasus diatas adalah..', 'Mikrosomia', 'Makrosomia', 'Anensephalus', 'Hidrosepalus', 'Panggul sempit', 'b', '4', 'sedang', 'yes'),
(290, 3, 'persalinan/nifas', 'Ny. F umur 22 tahun G1P0A0, hamil 40 minggu,datang di RS dengan riwayat DM. Saat ini sedang dalam proses persalinan kala II. Setelah kepala janin lahir, tidak terjadi putaran paksi luar. Posisi yang paling tepat untuk melahirkan bayi dari kasus diatas adalah..', 'Litotomi', 'Mc. Robert', 'Semi fowler', 'Mc. Donald', 'Dorsal recumbent', 'b', '4', 'sedang', 'yes'),
(291, 3, 'persalinan/nifas', 'Ny. F umur 22 tahun G1P0A0, hamil 40 minggu, datang di RS dengan riwayat DM. Saat ini sedang dalam proses persalinan kala II. Setelah kepala janin lahir, tidak terjadi putaran paksi luar. Sebelum tindakan pertolongan persalinan, yang perlu dilakukan adalah..', 'Periksa USG', 'Perbaikan KU', 'Episiotomi luas', 'Berikan antibiotika', 'Kosongkan kandung kemih', 'c', '3', 'sedang', 'yes'),
(292, 3, 'persalinan/nifas', 'Ny. F umur 22 tahun G1P0A0, hamil 40 minggu, datang di RS dengan riwayat DM. Saat ini sedang dalam proses persalinan kala II. Setelah kepala janin lahir, tidak terjadi putaran paksi luar. Apabila penarikan kepala terlalu curam ke bawah, risiko yang dapat terjadi pada janin Ny. F adalah..', 'Brachial palsy', 'Cerebral Palsy', 'Fraktur Klavikula', 'Fraktur toraks', 'Fraktur servika', 'a', '4', 'sedang', 'yes'),
(293, 3, 'persalinan/nifas', 'Seorang perempuan usia 25 tahun usia kehamilan 38 minggu, datang ke BPM, mengeluh perutnya mulas - mulas yang semakin sering, hasil pemeriksaan: KU baik, TD: 110/70 mmHg, nadi 80 x/menit, respirasi 24 x/menit, TFU 30 cm, kepala sudah masuk 2/5, hasil VT: portio tipis lunak, pembukaan serviks 8 cm, selaput ketuban masih utuh, presentasi kepala, penurunan di H-III. Apakah diagnosis untuk kasus di atas?', 'Inpartu kala I fase laten', 'Inpartu kala I fase aktif', 'Inpartu kala I fase aktif akselerasi', 'Inpartu kala I fase aktif deselerasi', 'Inpartu kala I fase laten memanjang', 'b', '4', 'sedang', 'yes'),
(294, 3, 'persalinan/nifas', 'Seorang perempuan usia 20 tahun, hamil 39 minggu, datang ke BPM, klien mengeluh mulas - mulas yang semakin sering, hasil pemeriksaan: KU baik, TD: 100/70 mmHg, nadi 80 x/menit, R 24 x/menit, TFU 30 cm, kepala sudah masuk 2/5, hasil VT: pembukaan serviks 8 cm, selaput ketuban masih utuh. Dimanakah perkiraan penurunan kepala janin sesuai dengan kasus di atas?', 'Hodge I', 'Hodge II', 'Hodge III', 'Hodge IV', 'Hodge V', 'c', '3', 'sedang', 'yes'),
(295, 3, 'persalinan/nifas', 'Seorang perempuan usia 25 tahun baru saja melahirkan bayinya secara spontan di BPM, sedangkan plasenta belum lahir, tinggi fundus uteri masih setinggi pusat, sudah terdapat tanda - tanda pelepasan plasenta. Apakah diagnosis pada kasus di atas?', 'Inpartu kala V', 'Inpartu kala IV', 'Inpartu kala III', 'Inpartu kala II', 'Inpartu kala I', 'c', '3', 'sedang', 'yes'),
(296, 3, 'persalinan/nifas', 'Bidan melakukan asuhan kala III pada seorang perempuan P1A0 di BPM, setelah bayi lahir telah diberikan suntikan oksitosin 10 IU/IM, kemudian dicoba melakukan PTT tetapi plasenta belum lepas, 15 menit kemudian diberikan oksitosin kedua. Setelah 15 menit kemudian plasenta masih belum lepas dan tampak adanya perdarahan pervaginam. Apakah diagnosis pada kasus di atas?', 'Atonia Uteri', 'Inversio Uteri', 'Retensio Plasenta', 'Robekan Jalan Lahir', 'Solusio Plasenta', 'c', '4', 'sedang', 'yes'),
(297, 3, 'persalinan/nifas', 'Bidan melakukan asuhan kala III pada seorang perempuan P1A0 di BPM, setelah bayi lahir telah diberikan suntikan oksitosin 10 IU/IM, kemudian dicoba melakukan PTT selama 15 menit tetapi plasenta belum lepas. Apa tindakan bidan dalam kasus di atas?', 'Melakukan manual plasenta', 'Melakukan Kompresi Bimanual Interna', 'Menunggu dan mengobservasi 15 menit lagi', 'Memberikan oksitosin ke 2 sebanyak 10 IU/IM', 'Melakukan penegangan tali pusat terkendali', 'd', '4', 'sedang', 'yes'),
(298, 3, 'persalinan/nifas', 'Seorang perempuan usia 30 tahun telah melahirkan anak ke-3 secara spontan di RB. Bidan telah memberikan suntikan oksitosin 10 IU/IM pada jam 03.32 WIB, kemudian dicoba melakukan PTT tetapi plasenta belum lepas. Pada pukul 04.00 WIB plasenta masih belum lepas dan tampak adanya perdarahan pervaginam. Apakah tindakan yang harus dilakukan pada kasus di atas?', 'Reposisi Uteri', 'Manual Plasenta', 'Kompresi bimanual interna', 'Kompresi bimanual eksterna', 'Melakukan masase fundus uteri', 'b', '4', 'sedang', 'yes'),
(299, 3, 'persalinan/nifas', 'Seorang perempuan postpartum usia 25 di rujuk oleh bidan ke RS karena mengalami perdarahan akibat adanya perlukaan jalan lahir yang mengenai seluruh perineum sampai mengenai mukosa rektum. Berapakah derajat robekan perineum kasus tersebut?', 'Grade I', 'Grade II', 'Grade III', 'Grade IV', 'Grade V', 'd', '3', 'sedang', 'yes'),
(300, 3, 'persalinan/nifas', 'Ny. K P5A0, 15 menit yang lalu telah melahirkan bayi laki-laki dan sudah mendapatkan 10 IU oksitosin, plasenta belum lahir PPV: darah ± 600 cc. Berdasarkan data perdarahan yang dialami Ny. K termasuk perdarahan..', 'Perdarahan pasca persalinan late', 'Perdarahan pasca persalinan dini', 'Perdarahan pasca persalinan tersier', 'Perdarahan pasca persalinan primer', 'Perdarahan pasca persalinan sekunder', 'd', '4', 'sulit', 'yes'),
(301, 3, 'persalinan/nifas', 'Ny. N umur 35 tahun, hamil kedua melahirkan hidup 1 kali, datang ke BPM pada jam 10.00 WIB untuk bersalin. Ibu mengatakan kenceng - kenceng sejak jam 07.00 WIB, mengeluarkan cairan warna jernih jam 09.00 WIB. Hasil pemeriksaan KU baik, TD 120/80 mmHg, N 88x/menit, S 36 ᵒC, RR 20 x/menit, his 3x dalam 10 menit, lama 45 detik, DJJ 144 x/menit. Hasil VT pembukaan 8 cm, KK (-), teraba tali pusat di samping kepala. Tujuan tindakan di atas untuk..', 'Membebaskan tali pusat', 'Mempertahankan kesejahteraan', 'Mempertahankan presentasi bayi', 'Memperlancar peredaran darah', 'Mengobservasi kemajuan persalinan', 'a', '4', 'sulit', 'yes'),
(302, 3, 'persalinan/nifas', 'Ny. N usia 35 tahun, G2P1Ao, hamil 39 minggu datang ke BPM pukul 10.00 WIB untuk bersalin. Ibu mengatakan kenceng - kenceng sejak jam 07.00 WIB & mengeluarkan cairan jernih jam 09.00 WIB. Hasil pemeriksaan TTV normal, his 3x dalam 10 menit lama 45 detik, DJJ 144x/menit. VT vulva tidak ada kelainan, pembukaan 8 cm, KK (-) teraba tali pusat di samping kepala. Langkah awal yang dilakukan untuk menangani kasus diatas adalah..', 'Ibu ditidurkan dengan posisi fowler', 'Ibu ditidurkan dengan posisi litotomi', 'Ibu ditidurkan dengan posisi semi fowler', 'Ibu ditidurkan dengan posisi trendelenburg', 'Ibu ditidurkan dengan posisi kaki lebih tinggi', 'd', '4', 'sulit', 'yes'),
(303, 3, 'persalinan/nifas', 'Ny. Umi, G1P0A0 hamil 38 minggu saat ini mengeluh perut mulas, sakit pinggang, hasil pemeriksaan didapatkan status TD 120/80 mmHg, nadi 84x/menit, respirasi 20x/menit, palpasi TFU 20 cm punggung kanan, kepala sudah masuk 3/5 bagian, DJJ 145x/menit, kontraksi 3x dalam 10 menit, lamanya 30 detik, pembukaan 5 cm, ket (+), persentasi kepala. Sesuai dengan kasus di atas, perkiraan penurunan kepala janin berada di ..', 'H I - H II', 'H II - H III', 'H III+', 'H III - H IV', '', 'b', '4', 'sedang', 'yes'),
(304, 3, 'persalinan/nifas', 'Ny. A berumur 24 tahun, G1P0A0, hamil 39 minggu datang ke bidan mengeluh kenceng - kenceng, perut terasa nyeri yang sangat hebat, keluar keringat dingin, dan gelisah. Setelah dilakukan pemeriksaan oleh bidan didapatkan hasil: perut teraba keras, denyut nadi, dan pernafasan meningkat, serta teraba lekukan melintang pada segmen bawah rahim setinggi pusat. Kontraksi uterus terus menerus dan sangat kuat. Apabila kondisi Ny. A tidak segera ditangani akan menyebabkan terjadinya..', 'Partus lama', 'Ruptura uteri', 'Perdarahan', 'Partus tak maju', 'Partus presipitatus', 'b', '4', 'sedang', 'yes'),
(305, 3, 'persalinan/nifas', 'Ny. A berumur 24 tahun, G1P0A0, hamil 39 minggu datang ke bidan mengeluh kenceng - kenceng, perut terasa nyeri yang sangat hebat, keluar keringat dingin, dan gelisah. Setelah dilakukan pemeriksaan oleh bidan didapatkan hasil: perut teraba keras, denyut nadi, dan pernafasan meningkat, serta teraba lekukan melintang pada segmen bawah rahim setinggi pusat. Kontraksi uterus terus menerus dan sangat kuat. Tindakan yang harus dilakukan oleh bidan sesuai dengan kewenangannya untuk kasus diatas adalah..', 'Pemeriksaan USG', 'Pemeriksaan dalam', 'memimpin persalinan', 'Perbaikan KU dan rujuk', 'Pasang infus', 'd', '3', 'sedang', 'yes'),
(306, 3, 'persalinan/nifas', 'Ny. A berumur 24 tahun, G1P0A0, hamil 39 minggu datang ke bidan mengeluh kenceng - kenceng, perut terasa nyeri yang sangat hebat, keluar keringat dingin, dan gelisah. Setelah dilakukan pemeriksaan oleh bidan didapatkan hasil: perut teraba keras, denyut nadi, dan pernafasan meningkat, serta teraba lekukan melintang pada segmen bawah rahim setinggi pusat. Kontraksi uterus terus menerus dan sangat kuat. Kemungkinan syok yang terjadi pada Ny. A adalah..', 'Syok septik', 'Syok anafilaktik', 'Syok neurogenik', 'Syok kardiogenik', 'Syok hipovolemih', 'c', '4', 'sedang', 'yes'),
(307, 3, 'persalinan/nifas', 'Jika plasenta belum lahir setelah 30 menit dan perdarahan segera pada ibu bersalin, diagnosa yang bisa ditegakkan adalah', 'Atonia uteri', 'Robekan jalan lahir', 'Retensio plasenta', 'Tertinggalnya sebagian plasenta atau ketuban', 'Inversi uteri', 'c', '4', 'sulit', 'yes'),
(308, 3, 'persalinan/nifas', 'Ny. A berumur 24 tahun, G1P0A0, hamil 39 minggu datang ke bidan mengeluh kenceng - kenceng, perut terasa nyeri yang sangat hebat, keluar keringat dingin, dan gelisah. Setelah dilakukan pemeriksaan oleh bidan didapatkan hasil: perut teraba keras, denyut nadi, dan pernafasan meningkat, serta teraba lekukan melintang pada segmen bawah rahim setinggi pusat. Kontraksi uterus terus menerus dan sangat kuat. Diagnosa sesuai kasus diatas adalah..', 'Ruptura Uteri', 'Plasenta Previa', 'Inersia Uteri primer', 'Solusio plasenta', 'Ruptura Uteri Iminent', 'd', '4', 'sulit', 'yes'),
(309, 3, 'persalinan/nifas', 'Ny. A berumur 24 tahun, G1P0A0, hamil 39 minggu datang ke bidan mengeluh kenceng - kenceng, perut terasa nyeri yang sangat hebat, keluar keringat dingin, dan gelisah. Setelah dilakukan pemeriksaan oleh bidan didapatkan hasil: perut teraba keras, denyut nadi, dan pernafasan meningkat, serta teraba lekukan melintang pada segmen bawah rahim setinggi pusat. Kontraksi uterus terus menerus dan sangat kuat. Keadaan diatas dapat terjadi karena..', 'Atonia Uteri', 'Partus presipitatus', 'Inersia uteri primer', 'Inersia Uteri skunder', 'Tetania Uteri', 'd', '4', 'sulit', 'yes'),
(310, 3, 'persalinan/nifas', 'Seorang perempuan usia 32 tahun G2P1A0 umur kehamilan 28 minggu, datang ke RSUD dengan keluhan mengeluarkan darah banyak dari jalan lahir, warna merah segar, tidak disertai nyeri perut. Hasil pemeriksaan KU lemah, pucat, Djj 155 x/mnt reguler pemeriksaan USG plasenta terletak di segmen bawah rahim. Apakah diagnosis yang tepat untuk kasus di atas?', 'Plasenta akreta', 'Plasenta Previa', 'Solutio Placenta', 'Plasenta Inkreta', 'Retensio Plasenta', 'b', '4', 'sulit', 'yes'),
(311, 3, 'persalinan/nifas', 'Ny. Rina, 27 tahun, G2P1A0, hamil 39 minggu, datang ke polindes pada pkl. 12.00 WITA dengan keluhan perut kencang-kencang sejak 7 jam yang lalu. Ibu mengatakan keluar cairan dari jalan lahir berupa lendir campur darah, serta mengeluh nyeri pada saat kontraksi. Pada pemeriksaan didapatkan pembukaan 5 cm, ketuban masih utuh, persentasi kepala, penurunan kepala H II, his 3x/10 menit, lama 40 detik, DJJ 140x/menit. Asuhan sayang ibu yang diberikan pada Ny. Rina..', 'Menganjurkan banyak makan', 'Berbaring terlentang di tempat tidur', 'Menganjurkan ibu tetap jalan-jalan', 'Menganjurkan posisi duduk', '', 'c', '2', 'mudah', 'yes'),
(312, 3, 'persalinan/nifas', 'Ny. Rina, 27 tahun, G2P1A0, hamil 39 minggu, datang ke polindes pada pkl. 12.00 WITA dengan keluhan perut kencang-kencang sejak 7 jam yang lalu. Ibu mengatakan keluar cairan dari jalan lahir berupa lendir campur darah, serta mengeluh nyeri pada saat kontraksi. Pada pemeriksaan didapatkan pembukaan 5 cm, ketuban masih utuh, persentasi kepala, penurunan kepala H II, his 3x/10 menit, lama 40 detik, DJJ 140x/menit. Pada jam 16.00 WITA, pembukaan serviks Ny. Rina diharapkan mencapai..', '6 cm', '7 cm', '8 cm', '9 cm', '', 'd', '2', 'mudah', 'yes'),
(313, 3, 'persalinan/nifas', 'Ny. Ida G1P0A0, hamil 39 minggu, datang ke polindes pkl. 10.00 WITA, mengeluh sakit perut menjalar ke pinggang. Hasil pemeriksaan: K/U baik, TD 110/70 mmHg, nadi 80x/menit, respirasi 24x/menit, TFU 30 cm, hasil VT permukaan serviks 8 cm, ketuban masih utuh, kepala turun pada Hodge III. Diagnosis kebidanan Ny. Ida adalah..', 'Inpartu kala 1 fase laten', 'Inpartu kala 1 fase aktif', 'Inpartu kala II', 'Post-partum', '', 'b', '3', 'sedang', 'yes'),
(314, 3, 'persalinan/nifas', 'Ny. Ida G1P0A0, hamil 39 minggu, datang ke polindes pkl. 10.00 WITA, mengeluh sakit perut menjalar ke pinggang. Hasil pemeriksaan: K/U baik, TD 110/70 mmHg, nadi 80x/menit, respirasi 24x/menit, TFU 30 cm, hasil VT permukaan serviks 8 cm, ketuban masih utuh, kepala turun pada Hodge III. Satu jam kemudian ketuban pecah spontan, warna jernih, ibu ingin mengedan. Asuhan yang tepat adalah..', 'Periksa tanda - tanda vital', 'Menyiapkan alat persalinan', 'Segera memimpin persalinan', 'Lakukan VT untuk memastikan pembukaan lengkap', '', 'd', '3', 'sedang', 'yes'),
(315, 3, 'persalinan/nifas', 'Pemeriksaan yang perlu dilakukan untuk menilai proses involusio adalah..', 'Pemeriksaan TFU dan kontraksi uterus', 'Inspeksi adanya luka bekas operasi', 'Pemeriksaan kandung kemih', 'Pemeriksaan pengeluaran per vaginam', '', 'a', '2', 'mudah', 'yes'),
(316, 3, 'persalinan/nifas', 'Ny. Ika telah melahirkan anak pertama 6 jam yang lalu. Ia mengatakan perutnya terasa nyeri. Nyeri perut yang dirasakan Ny. Ika disebabkan oleh..', 'Proses involusi uterus', 'Proses melahirkan', 'Pengeluaran plasenta', 'Luka bekas plasenta', '', 'a', '2', 'mudah', 'yes'),
(317, 3, 'persalinan/nifas', 'Ny. Linda 28 tahun, post-partum 8 jam yang lalu, anak pertama partus di RB Harapan Keluarga, mengeluh: mules dan mengeluarkan darah pervaginam sedikit, ASI belum keluar, ibu merasa cemas dengan keadaannya. Dari hasil pemeriksaan tidak ditemukan adanya kelainan pada payudara ibu. Usaha yang dapat dilakukan untuk memacu proses pengeluaran ASI pada kasus diatas adalah..', 'Tetap menyusui bayinya', 'Menghentikan pemberian ASI', 'Memompa payudara dengan breast pump', 'Mengompres payudara dengan air hangat', 'Menggunakan Bra penyangga', 'a', '2', 'mudah', 'yes'),
(318, 3, 'neonatus', 'Tanda-tanda bahaya pada neonatus?', 'Bayi menghisap ASI dengan kuat', 'Nafas bayi 50 x/menit', 'Seluruh badan bayi kuning', 'Tali pusat bayi kering', '', 'c', '3', 'mudah', 'yes'),
(319, 3, 'neonatus', 'Ny. Endang 23 tahun P1A0 post-partum hari kedua mengeluh belum dapat merawat bayinya dan khawatir tentang kesehatan bayinya. Agar Ny. Endang yakin bayinya sehat maka perlu diberi motivasi untuk..', 'diimunisasi', 'disusui sesering mungkin', 'diberikan susu formula karena ASI sedikit', 'Diberikan MP ASI', '', 'b', '2', 'mudah', 'yes'),
(320, 3, 'neonatus', 'Bayi Ny. Ana lahir spontan 1 jam yang lalu, ditolong bidan dengan berat lahri 2400 gram, panjang 48 cm dengan usia kehamilan 36 minggu, dari hasil pemeriksaan tidak ditemukan kelainan. Dilihat dari usia kehamilan dan berat badan waktu lahir, bayi Ny. Ana termasuk kategori..', 'Bayi matur', 'Bayi dismatur', 'Bayi prematur', 'Bayi post-matur', '', 'c', '3', 'mudah', 'yes'),
(321, 3, 'neonatus', 'Bayi Ny. Ana lahir spontan 1 jam yang lalu, ditolong bidan dengan berat lahri 2400 gram, panjang 48 cm dengan usia kehamilan 36 minggu, dari hasil pemeriksaan tidak ditemukan kelainan. Asuhan yang diberikan pda bayi Ny. Ana adalah..', 'Memberikan oksigen', 'Memberikan antibiotik', 'Dirawat dalam inkubator', 'Rawat gabung dengan ibunya', '', 'd', '3', 'mudah', 'yes'),
(322, 3, 'neonatus', 'Seorang perempuan usia 28 tahun baru saja melahirkan 6 jam yang lalu. Bayi menangis kuat, warna kulit merah, gerak aktif, BBL 2900 gram. Apakah penatalaksanaan yang harus dilakukan terhadap bayi?', 'Memandikan', 'Mengeringkan', 'Menghisap lendir', 'Memotong tali pusat', 'Inisiasi menyusu dini', 'e', '3', 'mudah', 'yes'),
(323, 3, 'neonatus', 'Bayi Ny. Wati lahir spontan-aterm, berat badan lahir 3000 gram, APGAR skor menit 1: frekuensi denyut jantung 110x/menit, nafas lambat tak teratur, tonus otot fleksi pada ekstremitas, reflek gerak sedikit, tubuh dan ekstremitas kemerah-merahan. Nilai APGAR 1 menit pertama bayi Ny. Wati adalah..', '5', '6', '7', '8', '', 'c', '4', 'sedang', 'yes'),
(324, 3, 'neonatus', 'Bayi Ny. Wati lahir spontan-aterm, berat badan lahir 3000 gram, APGAR skor menit 1: frekuensi denyut jantung 110x/menit, nafas lambat tak teratur, tonus otot fleksi pada ekstremitas, reflek gerak sedikit, tubuh dan ekstremitas kemerah-merahan. Diagnosis bayi Ny. Wati adalah..', 'Hipoglikemia', 'Asfiksia ringan', 'Asfiksia sedang', 'Asfiksia berat', '', 'b', '4', 'sedang', 'yes'),
(325, 3, 'neonatus', 'Bayi Ny. Budi usia 3 hari BBL 3100 gram, BB sekarang 3000 gram, tali pusat tidak ada tanda-tanda infeksi. Melihat penurunan berat badan bayi akan pulih dalam waktu..', '5 hari', '6 hari', '10 hari', '14 hari', '', 'c', '4', 'sedang', 'yes'),
(326, 3, 'neonatus', 'Bayi Ny. Budi usia 3 hari BBL 3100 gram, BB sekarang 3000 gram, tali pusat tidak ada tanda-tanda infeksi. Sebelum dibawa pulang, informasi yang harus diberikan pada Ny. Budi adalah..', 'Pemberian antibiotik secara rutin', 'Mempertahankan kehangatan tubuh bayi', 'Pemberian makanan tambahan bayi', 'Pemberian ASI setiap 2-3 jam sekali', '', 'd', '3', 'sedang', 'yes'),
(327, 3, 'neonatus', 'Penyebab bayi kurang bulan adalah', 'Kelahiran Prematur', 'Solusio atau plasenta previa', 'Gangguan nutrisi bayi selama kehamilan', 'A dan C benar', 'A, B, dan C benar', 'e', '3', 'sedang', 'yes'),
(328, 3, 'neonatus', 'Faktor predisposisi pada penyebab terjadinya bayi dengan BBLR adalah', 'Gizi kurang atau malnutrisi', 'Jumlah paritas', 'Kehamilan ganda', 'A dan B benar', 'B dan C benar', 'c', '3', 'sedang', 'yes'),
(329, 3, 'neonatus', 'Tanda prematuritas pada BBLR dengan kurang bulan adalah', 'Tulang rawan telinga belum terbentuk', 'Masih Terdapat Lanugo', 'Refleks-Refleks masih lemah', 'A dan C benar', 'A,B, dan C benar', 'e', '3', 'sedang', 'yes'),
(330, 3, 'neonatus', 'Seorang bayi dengan hasil pemeriksaan mengalami kejang, teremor, letargi, atau tidak sadar dengan hasil anamnesis kejang timbul saat lahir sampai dengan hari ke 3 dengan riwayat ibu diabetes, diagnosa yang bisa ditegakkan adalah', 'Hipotermi', 'Hipoglikemia', 'Ikterus/Hiperbilirubin', 'Infeksi atau Curiga Sepsis', 'Sindroma Aspirasi Mekonium', 'b', '3', 'sedang', 'yes'),
(331, 3, 'neonatus', 'Jika hasil anamnesis bahwa seorang bayi terpapar dengan suhu lingkungan yang rendah, waktu timbulnya kurang dari 2 hari, dan hasil pemeriksaan menunjukkan denyut jantung <100 x/menit, napas pelan dan dalam, diagnosa yang bida ditegakkan adalah', 'Hipotermi', 'Hipoglikemia', 'Ikterus/Hiperbilirubin', 'Infeksi atau Curiga Sepsis', 'Sindroma Aspirasi Mekonium', 'a', '3', 'sedang', 'yes'),
(332, 3, 'neonatus', 'Derajat ikterus pada anak terdiri dari', 'I', 'II', 'III', 'IV', 'V', 'e', '3', 'sedang', 'yes'),
(333, 3, 'neonatus', 'Derajat ikterus dengan daerah ikterus sampai badan bawah hingga tungkai adalah', 'I', 'II', 'III', 'IV', 'V', 'c', '3', 'sedang', 'yes'),
(334, 3, 'neonatus', 'Derajat ikterus dengan daerah ikterus sampai daerah lengan, kaki bawah, lutut adalah', 'I', 'II', 'III', 'IV', 'V', 'd', '3', 'sedang', 'yes'),
(335, 3, 'neonatus', 'Seorang bayi telah lahir spontan 2 hari yang lalu di RS, gerakan aktif, TTV: normal, BB 3000 gram PB 49 cm. Dari hasil pemeriksaan tidak ditemukan kelainan, TTV normal, dilakukan pemeriksaan refleks dengan cara menyentuh bagian pipi bayi, dan bayi memberikan respon dengan cara mengikuti arah jari. Apakah nama refleks yang dilakukan bidan?', 'Refleks rooting', 'Refleks babinski', 'Refleks sucking', 'Refleks grasping', 'Refleks moro', 'a', '3', 'sedang', 'yes'),
(336, 3, 'neonatus', 'Waktu optimal untuk merujuk seorang bayi yang asfiksia adalah', 'Segera setelah bayi lahir dengan rintihan', 'Segera setelah bayi dengan tangisan', 'Bila setelah upaya pertolongan pertama dan VTP tidak memberi respons adekuat setelah 3-5x 30 detik evaluasi (2-3 menit VTP)', 'Setelah ibu melahirkan', 'Setelah dilakukan VTP dan resusitasi berhasil', 'c', '3', 'sulit', 'yes'),
(337, 3, 'neonatus', 'Resusitasi inisiasi pernafasan dinilai tidak berhasil jika', 'Bayi kurang bulan/prematur (kurang dari 37 minggu)', 'Bayi tidak bernafas sebelum resusitasi', 'Bayi bernafas setelah VTP', 'VTP berhasil setelah 30 detik', 'Bayi merintih setelah dilakukan resusitasi', 'a', '3', 'sulit', 'yes'),
(338, 3, 'neonatus', 'Jika seorang dengan hasil anamnesis Ikterik timbul saat lahir sampai dengan hari ke 3, berlangsung lebih dari 3 minggu, dengan hasil pemeriksaan kulit, konjungtiva berwarna kuning pucat, diagnosa yang bisa ditegakkan pada bayi adalah', 'Hipotermi', 'Hipoglikemia', 'Ikterus/Hiperbilirubin', 'Infeksi atau Curiga Sepsis', 'Sindroma Aspirasi Mekonium', 'c', '3', 'sulit', 'yes'),
(339, 3, 'neonatus', 'Ny. S, usia 23 tahun, GII PI A0, umur kehamilan 37 minggu, bersalin ditolong bidan B. Setelah kepala bayi lahir, terjadi kesulitan dalam melahirkan bahu. Taksiran berat janin Ny S 4000 gr. Satu jam setelah bayi Ny S lahir, kemudian diberikan..', 'BCG 0,05 cc', 'Polio oral 2 tetes', 'Vitamin K 0,1 cc', 'Hepatitis B 0,5 cc', 'Vitamin A 100.000 IU', 'c', '3', 'mudah', 'yes'),
(340, 3, 'neonatus', 'Ny. S, usia 23 tahun, GII PI A0, umur kehamilan 37 minggu, bersalin ditolong bidan B. Setelah kepala bayi lahir, terjadi kesulitan dalam melahirkan bahu. Taksiran berat janin Ny. S 4000 gr. Setelah bayi Ny. S lahir, observasi yang harus dilakukan adalah..', 'Reflek moro', 'Reflek rotting', 'Reflek menelan', 'Reflek babinski', 'Reflek menghisap', 'a', '3', 'sedang', 'yes'),
(341, 3, 'neonatus', 'Faktor bayi yang menyebabkan terjadinya bayi asfiksia adalah', 'Bayi kurang bulan/prematur (kurang dari 37 minggu)', 'Partus lama atau partus macet', 'Demam sebelum dan selama persalinan', 'Kehamilan lebih bulan', 'Prolapsus talipusat', 'a', '3', 'sedang', 'yes'),
(342, 3, 'neonatus', 'Faktor tali pusat yang menyebabkan terjadinya asfiksia adalah', 'Bayi kurang bulan/prematur (kurang dari 37 minggu)', 'partus lama atau partus macet', 'Demam sebelum dan selama persalinan', 'Kehamilan lebih bulan', 'Prolapsus talipusat', 'e', '4', 'sulit', 'yes'),
(343, 3, 'neonatus', 'Tindakan yang dilakukan setelah tindakan resusitasi adalah', 'Pemantauan Pascaresusitasi', 'Dekontaminasi, mencuci dan mensterilkan alat', 'Membuat Catatan Tindakan Resusitasi', 'Semua benar', 'Semua salah', 'd', '3', 'sulit', 'yes'),
(344, 3, 'bayi', 'Pada umur 8 bulan, berapakah normal kenaikan berat badan bayi?', '200 gram', '400 gram', '300 gram', '800 gram', '', 'd', '4', 'mudah', 'yes'),
(345, 3, 'bayi', 'Ny. Lina datang ke posyandu tanggal 7 Mei 2015 untuk memeriksakan Lisa, bayinya. Lisa lahir tanggal 1 Desember 2014 di BPM dengan berat badan lahir 3125 gram, panjang badan 51 cm. Berat badan normal Lisa saat ini adalah..', '5,625 kg', '6,25 kg', '6,75 kg', '9,375 kg', '', 'b', '3', 'mudah', 'yes'),
(346, 3, 'bayi', 'Ny. Lina datang ke posyandu tanggal 7 Mei 2015 untuk memeriksakan Lisa, bayinya. Lisa lahir tanggal 1 Desember 2014 di BPM dengan berat badan lahir 3125 gram, panjang badan 51 cm. Alat permainan yang sebenarnya dianjurkan untuk Lisa yaitu..', 'Pensil', 'Balon susun', 'Lampu senter', 'Kicik - kicik', '', 'd', '2', 'mudah', 'yes'),
(347, 3, 'bayi', 'Ibu Diyah datang ke Polindes dengan membawa anaknya yang baru berusia 2 bulan. Ia mengatakan kalau anaknya sudah 2 hari mengalami diare. BB lahir 2900 gram, BB sekarang 3500 gram. Selain ASI, anaknya sudah diberikan makanan pisang lumat dan nasi ulek sejak 1 minggu yang lalu. Imunisasi yang seharusnya didapat anak ibu Diyah adalah..', 'BCG, polio 1, DPT 1, hepatitis B2', 'Hepatitis B1, polio 1, DPT 1, BCG', 'BCG, hepatitis B1, Polio 1, DPT 2', 'BCG, Hepatitis B1, Polio 2, DPT 2', '', 'a', '2', 'mudah', 'yes'),
(348, 3, 'bayi', 'Berapa kali imunisasi polio diberikan?', '4 kali', '2 kali', '3 kali', '6 kali', '5 kali', 'a', '2', 'mudah', 'yes'),
(349, 3, 'bayi', 'Ny. Lina datang ke posyandu tanggal 7 Mei 2015 untuk memeriksakan Lisa, bayinya. Lisa lahir tanggal 1 Desember 2014 di BPM dengan berat badan lahir 3125 gram, panjang badan 51 cm. Berdasarkan umurnya, perkembangan yang harus dicapai adalah..', 'Mengoceh', 'Berdisi satu kaki', 'Duduk tanpa bantuan', 'Mengikuti sumber suara', '', 'd', '4', 'sedang', 'yes'),
(350, 3, 'bayi', 'Ny. Lina datang ke posyandu tanggal 7 Mei 2015 untuk memeriksakan Lisa, bayinya. Lisa lahir tanggal 1 Desember 2014 di BPM dengan berat badan lahir 3125 gram, panjang badan 51 cm. Asupan nutrisi yang diberikan untuk Lisa adalah..', 'ASI ekslusif', 'Bubur nasi + ASI', 'Bubur susu + ASI', 'Nasi lembek + ASI', '', 'a', '4', 'sedang', 'yes'),
(351, 3, 'bayi', 'Gangguan nafas pada bayi ditandai dengan', 'Frekuensi nafas <30 x/menit', 'Frekuensi nafas >60 x/menit disertai satu atau lebih tanda gangguan nafas lainnya', 'Bayi apnea (napas berhenti >20 detik)', 'Semua benar', 'Semua salah', 'c', '3', 'sedang', 'yes'),
(352, 3, 'bayi', 'Salah satu penyebab gangguan nafas pada bayi cukup bulan adalah', 'Penyakit Membran Hialin', 'Asfiksia', 'Asidosis', 'A dan B benar', 'B dan C benar', 'c', '3', 'sedang', 'yes'),
(353, 3, 'bayi', 'Salah satu penyebab gangguan nafas pada bayi kurang bulan adalah', 'Asfiksia', 'Sindrom Aspirasi Mekonium', 'Asidosis', 'A dan B benar', 'B dan C benar', 'a', '3', 'sedang', 'yes'),
(354, 3, 'bayi', 'Faktor tidak langsung yang mempengaruhi status gizi buruk pada bayi dan balita adalah..', 'Asuhan makanan yang salah', 'Penyakit infeksi', 'Penyakit bawaan', 'Pola asuh', 'Umur', 'd', '3', 'mudah', 'yes'),
(355, 3, 'bayi', 'Ny. Lina datang ke posyandu tanggal 7 Mei 2015 untuk memeriksakan Lisa, bayinya. Lisa lahir tanggal 1 Desember 2014 di BPM dengan berat badan lahir 3125 gram, panjang badan 51 cm. Usia Lisa saat ini adalah..', '4 bulan', '5 bulan', '6 bulan', '7 bulan', '', 'b', '3', 'sedang', 'yes'),
(356, 3, 'bayi', 'Ibu Diyah datang ke Polindes dengan membawa anaknya yang baru berusia 2 bulan. Ia mengatakan kalau anaknya sudah 2 hari mengalami diare. BB lahir 2900 gram, BB sekarang 3500 gram. Selain ASI, anaknya sudah diberikan makanan pisang lumat dan nasi ulek sejak 1 minggu yang lalu. Tindakan Anda sebagai bidan terhadap anak ibu Diyah adalah..', 'Memberikan oralit', 'Memberikan obat diare', 'Menganjurkan ibu untuk banyak minum air putih', 'Berikan obat diare dan anjurkan untuk diberikan ASI saja', '', 'd', '2', 'mudah', 'yes'),
(357, 3, 'bayi', 'Ibu Diyah datang ke Polindes dengan membawa anaknya yang baru berusia 2 bulan. Ia mengatakan kalau anaknya sudah 2 hari mengalami diare. BB lahir 2900 gram, BB sekarang 3500 gram. Selain ASI, anaknya sudah diberikan makanan pisang lumat dan nasi ulek sejak 1 minggu yang lalu. Konseling yang Anda berikan sebagai bidan kepada ibu Diyah adalah..', 'KIE tentang imunisasi', 'KIE tentang penyakit anak', 'KIE tentang ASI eksklusif', 'KIE tentang tumbuh kembang', '', 'c', '3', 'mudah', 'yes'),
(358, 3, 'bayi', 'Ibu Diyah datang ke Polindes dengan membawa anaknya yang baru berusia 2 bulan. Ia mengatakan kalau anaknya sudah 2 hari mengalami diare. BB lahir 2900 gram, BB sekarang 3500 gram. Selain ASI, anaknya sudah diberikan makanan pisang lumat dan nasi ulek sejak 1 minggu yang lalu. Masalah yang terjadi pada bayi Ny. Diyah berhubungan dengan..', 'Gangguan kardiovaskuler', 'Gangguan gastrointestinal', 'Gangguan sistem urinarius', 'Gangguan sistem respiratori', '', 'b', '2', 'mudah', 'yes'),
(359, 3, 'bayi', 'Apakah pada bayi yang dalam keadaan demam tinggi ( >= 38 derajat celcius) boleh diberikan imunisasi DPT1, 2, dan 3?', 'Boleh diberikan', 'Tidak boleh', 'Tidak tahu', 'Boleh jika panas tidak terlalu tinggi', '', 'b', '5', 'mudah', 'yes'),
(360, 3, 'bayi', 'Seorang perempuan datang ke puskesmas ingin mengimunisasikan bayinya yang berusia 2 bulan. Hasil pemeriksaan bidan: KU bayi baik, vital sign dalam batas normal, dan bidan akan melakukan imunisasi BCG kepada bayinya. Bagaimana cara penyuntikan imunisasi dalam kasus di atas?', 'Intramuskular', 'Intravena', 'Intracutan', 'Sublingual', 'Subcutan', 'c', '3', 'mudah', 'yes'),
(361, 3, 'bayi', 'Ibu Diyah datang ke Polindes dengan membawa anaknya yang baru berusia 2 bulan. Ia mengatakan kalau anaknya sudah 2 hari mengalami diare. BB lahir 2900 gram, BB sekarang 3500 gram. Perkembangan yang harus dicapai bayi ibu Diyah adalah..', 'Mengikuti arah sinar', 'Melihat benda dengan jelas', 'Membedakan warna', 'Mulai berceloteh', '', 'a', '3', 'sedang', 'yes'),
(362, 3, 'bayi', 'Seorang bayi berusia 2 bulan dibawa ibunya ke Puskesmas untuk diimunisasi, Hasil pemeriksaan berat badan 4500 gram. Dilihat pada kartu KMS, bayi baru mendapat imunisasi HB0 dan Polio1. Apa jenis imunisasi yang harus diberikan pada bayi dalam kasus di atas?', 'DPT 1', 'BCG', 'Campak', 'DPT 2', 'HB 2', 'b', '3', 'sedang', 'yes'),
(363, 3, 'bayi', 'Seorang bayi berusia 9 bulan dibawa ibunya ke Puskesmas untuk diimunisasi campak, Hasil pemeriksaan berat badan 7500 gram, kondisi bayi sehat dan belum pernah menderita campak sebelumnya. Bagaimanakah cara penyuntikan imunisasi tersebut?', 'Sub Cutan', 'Intra Vena', 'Intra Cutan', 'Intra Muskular', 'Peroral', 'd', '4', 'sedang', 'yes'),
(364, 3, 'pencegahan infeksi', 'Berapa lama waktu yang dibutuhkan pada proses dekontaminasi alat dalam larutan klorin..', '10 menit', '15 menit', '20 menit', '25 menit', '30 menit', 'a', '4', 'mudah', 'yes'),
(365, 3, 'pencegahan infeksi', 'Upaya-Upaya pencegahan infeksi (PI) berupa hal sebagai berikut:', 'Cuci tangan', 'menggunakan teknik asepsis dan aseptik', 'menjaga kebersihan dan sanitasi', 'a+b benar', 'semua benar', 'e', '4', 'sedang', 'yes'),
(366, 3, 'pencegahan infeksi', 'Untuk membuat larutan klorin 0,5% dari larutan klorin 5,25 % (misalkan Bayclin). Maka perbandingannya adalah', '1 : 9', '1 :10', '1 : 7', '1 : 8', 'semua di atas alah', 'a', '4', 'sedang', 'yes'),
(367, 3, 'pencegahan infeksi', 'Yang termasuk di dalam pemrosesan alat di bawah ini', 'Dekontaminasi, cucci bilas, DTT, steril', 'Dekontaminasi, cuci bilas, kimiawi', 'cuci bilas, dekontaminasi, DTT', 'Dekontaminasi, cuci bilas, DTT', 'B +D Benar', 'e', '4', 'sedang', 'yes'),
(368, 3, 'pencegahan infeksi', 'Dekontaminasi alat-alat di rendam di dalam larutan klorin selama', '5 menit', '15 menit', '10 menit', '20 menit', 'semua jawaban di atas benar', 'c', '4', 'sedang', 'yes'),
(369, 3, 'pencegahan infeksi', 'Pencucian dan pebilasan cara paling efektif untuk menghilangkan sebagian besar microorganisme', '70 %', '80 %', '90 %', '60 %', 'bukan salah satu jawaban di atas', 'b', '4', 'sedang', 'yes'),
(370, 3, 'pencegahan infeksi', 'menghilangkan sebagian mikroorganisme dan membunuh kuman HIV AIDS + hepatitis B dengan cara', 'dekontaminasi dan cuci bilas', 'Cuci bilas dan DTT', 'DTT', 'A, B dan C benar', 'A, B dan C salah', 'a', '4', 'sedang', 'yes'),
(371, 3, 'pencegahan infeksi', 'DTT (Deinfektan Tingkat Tinggi) dengan cara merebus dilakukan dengan', 'dimulai saat air mulai mendidih', 'rebus selama 10 menit', 'pada saat peralatan kering gunakan segera atau simpan dalam wadah DTT dan tertutup', 'A dan B benar', 'A, B dan C benar', 'e', '4', 'sedang', 'yes'),
(372, 3, 'pencegahan infeksi', 'Semua usaha yang dilakukan dalam mencegah masuknya mikroorganisme ke dalam tubuh dan berpotensi untuk menimbulkan infeksi disebut', 'Antiseptik', 'asepsis / teknik aseptik', 'dekontaminasi', 'DTT', 'Sterilisasi', 'a', '4', 'sedang', 'yes'),
(373, 3, 'pencegahan infeksi', 'Mengacu pada pencegahan infeksi dengan cara membunuh atau menghambat pertumbuhan mikroorganisme pada kulit atau jaringan tubuh lainnya disebut dengan', 'asepsis / teknik aseptik', 'anti sepsis', 'dekontaminasi', 'DTT', 'sterilisasi', 'b', '4', 'sedang', 'yes'),
(374, 3, 'pencegahan infeksi', 'Prosedur untuk melakukan cuci tangan dilakukan selama', '5-10 detik', '5-12 detik', '10-15 detik', '10-20 detik', 'suka-suka', 'c', '4', 'sedang', 'yes'),
(375, 3, 'kegawat daruratan', 'Elemen-elemen penting dalam stabilisasi pasien adalah, kecuali..', 'Menjamin kelancaran jalan nafas', 'Menghentikan sumber perdarahan atau infeksi', 'Mengganti pakaian pasien jika terkena darah dan cairan tubuh', 'Mengganti cairan tubuh yang hilang', 'Mengatasi rasa nyeri atau gelisah', 'c', '4', 'sedang', 'yes'),
(376, 3, 'kegawat daruratan', 'Hal yang tidak perlu diperhatikan dalam pemberian cairan infus adalah', 'Jumlah cairan yang akan diberikan', 'Waktu pemberian', 'Lamanya pemberian per unit cairan', 'Ukuran atau diameter jarum yang dipakai', 'Kecepatan tetesan', 'b', '4', 'sedang', 'yes'),
(377, 3, 'kegawat daruratan', 'Kondisi yang memerlukan transfusi darah adalah', 'Anemia ringan', 'Perdarahan pascapersalinan yang disertai dengan syok', 'Kehilangan banyak darah selama prosedur operasi', 'Perdarahan pascapersalinan <500 cc', 'D dan C benar', 'e', '4', 'sedang', 'yes'),
(378, 3, 'kegawat daruratan', 'Jika pasien mengalami kejang (eklampsia), hal yang perlu dilakukan adalah', 'Baringkan pada satu sisi, kepala ditinggikan untuk mencegah aspirasi', 'Bebaskan jalan nafas', 'Pasang spatel untuk menghindari tergigitnya lidah', 'Semua benar', 'Semua salah', 'd', '3', 'sedang', 'yes'),
(379, 3, 'kegawat daruratan', 'Alternatif dosis awal MgSO4 yang diberikan kepada ibu hamil dengan preeklampsia dan eklampsia adalah', 'MgSO4 4 gram selama 5 menit', 'MgSO4 3 gram selama 5 menit', 'MgSO4 4 gram selama 10 menit', 'MgSO4 3 gram selama 5 menit', 'MgSO4 6 gram selama 10 menit', 'a', '3', 'sedang', 'yes'),
(380, 3, 'kb', 'Apakah ibu yang mengalami hipertensi boleh diberikan KB suntik?', 'Boleh', 'Tidak boleh', 'Tidak tahu', 'Boleh jika bukan hipertensi parah', '', 'd', '3', 'mudah', 'yes'),
(381, 3, 'kb', 'Ny. Yeti umur 26 tahun post-partum 40 hari anak ke-2 belum pernah ikut KB. Ny. Yeti ingin memakai alat kontrasepsi yang efektif dan tidak menimbulkan gemuk. Ny. Yeti mempunyai varises dan riwayat hipertensi. Menurut Anda, alat kontrasepsi yang cocok dengan Ny. Yeti adalah..', 'Pil', 'IUD', 'Suntik', 'Implant', '', 'b', '2', 'mudah', 'yes'),
(382, 3, 'kb', 'Ny. Yeti umur 26 tahun post-partum 40 hari anak ke-2 belum pernah ikut KB. Ny. Yeti ingin memakai alat kontrasepsi yang efektif dan tidak menimbulkan gemuk. Ny. Yeti mempunyai varises dan riwayat hipertensi. Alkon yang dipilih adalah IUD. Konseling yang diberikan pada Ny. Yeti sebelum pemakaian alkon tersebut adalah..', 'Follow-up', 'Kontra-indikasi', 'Cara pelepasannya', 'Cara kerja alat kontrasepsi', '', 'd', '2', 'mudah', 'yes'),
(383, 3, 'kb', 'Ny. "A", 21 tahun, 1 bulan yang lalu baru saja melahirkan anak pertamanya datang ke bidan untuk memakai alkon tapi dia ingin tetap menyusui bayinya dan menstruasi tiap bulan lancar, sekarang sedang haid hari kedua. Berdasarkan data di atas, tindakan awal yang dilakukan oleh bidan terhadap Ny. "A" dalam menentukan alkon adalah..', 'Menentukan Alkon yang akan diberikan kepada Ibu tersebut', 'Melakukan konseling', 'Anamnesa', 'Melakukan inform consent', '', 'b', '4', 'sedang', 'yes'),
(384, 3, 'kb', 'Ny. "A", 21 tahun, 1 bulan yang lalu baru saja melahirkan anak pertamanya datang ke bidan untuk memakai alkon tapi dia ingin tetap menyusui bayinya dan setelah itu menstruasi tiap bulan lancar, sekarang sedang haid hari kedua. Waktu dan Alkon yang tepat bagi Ny. "A" adalah..', 'Saat ini dengan Suntikan', 'Hari kelima menstruasi menggunakan IUD', 'Hari keenam dengan Pil', 'Setelah haid selesai dengan Alkon apapun', '', 'b', '4', 'sedang', 'yes'),
(385, 3, 'kb', 'Ny. Andin umur 24 tahun, mempunyai satu anak yang berumur 2 tahun, datang ke BPM mau ikut KB tetapi tidak mau jenis hormonal dan AKDR, menginginkan metode sederhana dengan alat/obat. Bidan memberikan alternatif pilihan jenis alat kontrasepsi yang dipakai adalah kondom. Cara kerja alat kontrasepsi yang digunakan Ny. Andini ini adalah..', 'Mengurangi sensitivitas penis', 'Ejakulasi dini', 'Memperlambat sperma masuk tuba palofi', 'Mencegah pertemuan ovum dan sperma', '', 'd', '5', 'sedang', 'yes'),
(386, 3, 'kb', '2 hari yang lalu, Ny. Tias umur 19 tahun datang ke bidan bersama suaminya yang baru menikah lalu bermaksud menunda kehamilan dengan ikut program KB. Menurut Anda, kontrasepsi yang cocok untuk Ny. Tias adalah..', 'Implant, Pil, IUD', 'Suntik, Implant, MOW', 'IUD, Implant, Suntik', 'Kondom', '', 'd', '3', 'sedang', 'yes'),
(387, 3, 'kb', '2 hari yang lalu, Ny. Tias umur 19 tahun datang ke bidan bersama suaminya yang baru menikah lalu bermaksud menunda kehamilan dengan ikut program KB. Sebaiknya Ny. Tias memprogramkan untuk mempunyai anak pada umur..', 'Kurang dari 20 tahun', '35 tahun', '20 - 30 tahun', '25 - 35 tahun', '', 'c', '2', 'sedang', 'yes'),
(388, 3, 'kb', 'Seorang perempuan usia 26 tahun datang ke RB. Klien mengatakan melahirkan anak pertamanya 40 hari yang lalu, belum pernah menggunakan kontrasepsi, hasil pemeriksaan terdapat varises dan hipertensi. Apakah alat kontrasepsi yang cocok untuk perempuan dalam kasus di atas?', 'Pil', 'IUD', 'Suntik', 'Implant', 'MOW', 'b', '3', 'sedang', 'yes'),
(389, 3, 'kb', 'Pelayanan KB bertujuan untuk', 'Menunda (merencanakan) kehamilan', 'Menjarangkan kehamilan', 'Menghentikan kehamilan', 'Semua jawaban benar', 'Semua salah', 'd', '2', 'mudah', 'yes'),
(390, 3, 'kb', 'Ny. Andin umur 24 tahun, mempunyai satu anak yang berumur 2 tahun, datang ke BPM mau ikut KB tetapi tidak mau jenis hormonal dan AKDR, menginginkan metode sederhana dengan alat/obat. Bidan memberikan alternatif pilihan jenis alat kontrasepsi yang dipakai adalah..', 'Kondom', 'Kalender', 'Suhu Basal', 'Pantang Berkala', '', 'a', '5', 'sedang', 'yes'),
(391, 3, 'asuhan kebidanan', 'His atau tenaga mengejan merupakan faktor', 'Passage', 'Power', 'Passanger', 'Ukuran panggul', 'Semua jawaban benar', 'b', '3', 'mudah', 'yes'),
(392, 3, 'asuhan kebidanan', 'Anamnesa yang perlu ditanyakan pada ibu yang dapat mempengaruhi power ibu saat bersalin, kecuali..', 'UPL', 'His', 'Keadaan umum', 'Paritas', 'Semua jawaban benar', 'a', '3', 'mudah', 'yes'),
(393, 3, 'asuhan kebidanan', 'Agar ibu mempunyai power saat bersalin, maka tindakan yang dapat diberikan bidan adalah', 'Menyiapkan ruangan yang bersih', 'Memberikan obat-obatan tanpa indikasi', 'Memberikan posisi terlentang', 'Memberikan cairan dan nutrisi', 'Semua jawaban benar', 'd', '3', 'mudah', 'yes'),
(394, 3, 'asuhan kebidanan', 'Yang benar tentang kontraksi braxton hicks adalah', 'Saat dilakukan pemeriksaan oleh bidan, his yang timbul, biasanya disertai dengan keinginan ibu untuk mengejan', 'Saat dilakukan pemeriksaan oleh bidan, diketahui his bersifat tidak teratur ,tidak menyebabkan nyeri yang memancar dari pinggang keperut bagian bawah', 'Hasil pemeriksaan bidan, diketahui bahwa his`semakin sering dengan frekuensi 3 x 35”/ 10’, disertai keinginan ibu untuk meneran', 'Dari pemantauan bidan, diketahui his yang timbul, mendorong anak keluar dari rahim ibu', 'Tidak ada yang benar', 'b', '3', 'mudah', 'yes'),
(395, 3, 'asuhan kebidanan', 'Diketahui, ibu terlihat dehidrasi, his semakin berkurang. Berdasarkan peristiwa tersebut, faktor apakah yang mempengaruhi keadaan ibu', 'Passage', 'Passenger', 'Power', 'Psikologis', 'Ukuran panggul', 'c', '3', 'mudah', 'yes'),
(396, 3, 'asuhan kebidanan', 'Plasenta termasuk faktor', 'His', 'Kekuatan mengejan/Power Ibu', 'Passage dan passenger', 'Peningkatan prostaglandin', 'Tidak ada yang benar', 'c', '3', 'mudah', 'yes'),
(397, 3, 'asuhan kebidanan', 'Hal yang harus dilakukan oleh ibu, apabila terdapat tanda – tanda kontraksi uterus semakin sering, menjalar ke pinggang terdapat pengeluaran cairan lendir bercampur darah, yaitu..', 'Datang ke dukun', 'Datang ke bidan', 'Dilakukan perawatan sendiri di rumah', 'Semua jawaban salah', 'Semua jawaban benar', 'b', '3', 'mudah', 'yes'),
(398, 3, 'asuhan kebidanan', 'Penerapan Fungsi bidan serta pelayanan kesehatan masyarakat merupakan pengertian dari', 'Pelayanan Kebidanan', 'Praktik Kebidanan', 'Asuhan Kebidanan', 'Manajemen Kebidanan', 'Diagnosa Kebidanan', 'a', '3', 'sedang', 'yes'),
(399, 3, 'asuhan kebidanan', 'Berikut ini merupakan standar Asuhan Kehamilan adalah kecuali', 'Idetifikasi Ibu hamil', 'Palpasi Abdominal', 'Pengelolaan Anemia pada kehamilan', 'Persiapan persalinan', 'Pemberian imunisasi bayi', 'e', '3', 'sedang', 'yes'),
(400, 3, 'asuhan kebidanan', 'Sinklitismus, asinklitismus, fleksi, putar paksi dalam, ekstensi, putar paksi luar, ibu dalam masa persalinan', 'Tahapan persalinan saat dipimpin meneran oleh bidan', 'Tahapan kala I persalinan', 'Tahapan kala I atau kala uri persalinan', 'Tahapan 2 jam pasca persalinan', 'Tahapan kala 4 persalinan', 'c', '3', 'sedang', 'yes'),
(401, 3, 'asuhan kebidanan', 'Tujuan memberikan asuhan persalinan salah satunya untuk mengetahui kemajuan persalinan. Keadaan manakah yang menunjukkan bidan sedang mengetahui kemajuan persalinan', 'Bidan melakukan observasi persalinan dengan lembar partograf', 'Bidan menganjurkan ibu untuk makan dan minum', 'Bidan melakukan pemeriksaan TTV', 'Semua jawaban benar', 'Tidak ada yang benar', 'a', '3', 'sedang', 'yes'),
(402, 3, 'asuhan kebidanan', 'Dasar panggul gynecoid adalah bentuk panggul yang khas bagi wanita dannormal untuk dilalui bayi dengan mempunyai ciri', 'Bila diukur diameter sagitalis posterior hanya sedikit lebih pendek dari diameter sagitalis anterior dan pubis luas', 'Bila diukur diameter sagitalis posterior jauh lebih pendek dari diameter sagitalis anterior', 'Bila diukur diameter antero posterior dari PAP lebih besar dari diameter tranversa hingga bentuk PAP lonjong ke depan', 'Bila diukur teraba segmen anterior lebar, sacrum melengkung, incisura ischiadica lebar', 'Tidak ada yang benar', 'a', '3', 'sedang', 'yes'),
(403, 3, 'asuhan kebidanan', 'Diketahui seorang bidan melakukan pemeriksaan UPL saat pasien tersebut datang melakukan ANC pada bidan Seli. Hasil pemeriksaan UPL sebagai berikut, antara lain Distansia Spinarum = 20 cm; Distansia Cristarum = 24 cm; Bodeloque = 18 cm; Lingkar panggul 78 cm. Bagaimana keadaan pasien jika ditinjau berdasarkan teori?', 'Dapat bersalin secara normal', 'Ada kemungkinan mengalami kesulitan bersalin normal', 'Merupakan keadaan yang fisiologis', 'Semua jawaban benar', 'Tidak ada yang benar', 'b', '4', 'sedang', 'yes'),
(404, 3, 'asuhan kebidanan', 'Diketahui seorang bidan melakukan pemeriksaan UPL saat pasien tersebut datang melakukan ANC pada bidan Seli. Hasil pemeriksaan UPL sebagai berikut, antara lain Distansia Spinarum = 20 cm; Distansia Cristarum = 24 cm; Bodeloque = 18 cm; Lingkar panggul 78 cm. Maka diagnosa nomenklatur untuk pasien tersebut adalah?', 'CPD', 'Panggul sempit', 'Dapat bersalin secara normal', 'Semua jawaban benar', 'Semua jawaban salah', 'b', '4', 'sedang', 'yes'),
(405, 3, 'asuhan kebidanan', 'Yang bukan merupakan kebutuhan dasar selama persalinan yaitu', 'Tempat persalinan', 'Penolong', 'Persiapan fisisk dan mental ibu', 'Tidak membawa peralatan bayi', 'Tidak ada yang benar', 'd', '3', 'sedang', 'yes'),
(406, 3, 'asuhan kebidanan', 'Agar ibu dalam melewati proses persalinannya merasa nyaman, maka hal yang dapat dilakukan bidan dan keluarga sebagai wujud asuhan sayang ibu adalah', 'Memarahi ibu saat mersakan kesakitan', 'Tidak menunggui ibu saat proses persalinan', 'Tidak memberikan makan ato minum pada ibu', 'Memberikan dukungan emosional', 'A dan D benar', 'd', '3', 'sedang', 'yes'),
(407, 3, 'asuhan kebidanan', 'Peristiwa di bawah ini yang merupakan bentuk asuhan sayang ibu yaitu', 'Saat ibu inpartu, bidan menganjurkan pada keluarga untuk memberikan cairan dan nutrisi pada ibu bersalin', 'Bidan melakukan tindakan kateterisasi secara rutin agar ibu bisa BAK', 'Bidan melakukan enema pada setiap ibu inpartu', 'Bidan melakukan pencukuran rambut pubis pada setiap ibu bersalin', 'Tidak ada yang benar', 'a', '3', 'sedang', 'yes'),
(408, 3, 'asuhan kebidanan', 'Diketahui seorang ibu inpartu hamil anak pertama, mengeluh mengeluarkan lendir bercampur darah dari kemaluannya. Saat dilakukan pemeriksaan VT oleh bidan, mulai saat pasien datang mengalami pembukaan satu dipantau sampai ibu mengalami pembukaan lengkap. Berdasarkan teori, hal tersebut merupakan', 'Tahapan persalinan pada kala 1', 'Tahapan persalinan pada kala 2', 'Tahapan persalinan pada kala 3', 'Tahapan persalinan pada kala 4', 'Tidak ada yang benar', 'a', '3', 'sedang', 'yes'),
(409, 3, 'asuhan kebidanan', 'Dari manakah bidan memperoleh data subjektif dalam pengumpulan data pasien?', 'Bertanya kepada keluarga pasien', 'Bertanya kepada suami pasien', 'Anamnesis dan Observasi langsung', 'Pemeriksaan fisik', 'Semua jawaban benar', 'c', '4', 'sedang', 'yes'),
(410, 3, 'asuhan kebidanan', 'Dari manakah bidan memperoleh data objektif dalam pengumpulan data pasien?', 'Pemeriksaan fisik', 'Bertanya kepada suami pasien', 'Anamnesis dan Observasi langsung', 'Bertanya kepada keluarga pasien', 'Semua jawaban benar', 'a', '4', 'sedang', 'yes'),
(411, 3, 'asuhan kebidanan', 'Yang termasuk dalam pemeriksaan fisik antara lain..', 'Inspeksi, Palpasi, Auskultasi, dan Rontgen', 'Inspeksi, Palpasi, Auskultasi, dan Pemeriksaan Lab', 'Inspeksi, Palpasi, Auskultasi, dan Perkusi', 'Pemeriksaan Lab, Rontgen, dan USG', 'Inspeksi, Palpasi, Pemesiksaan Lab, dan Perkusi', 'c', '4', 'sedang', 'yes'),
(412, 3, 'asuhan kebidanan', 'Yang termasuk dalam pemeriksaan penunjang antara lain..', 'Pemeriksaan Lab, Rontgen, dan USG', 'Inspeksi, Palpasi, Auskultasi, dan Rontgen', 'Inspeksi, Palpasi, Auskultasi, dan Pemeriksaan Lab', 'Inspeksi, Palpasi, Pemesiksaan Lab, dan Perkusi', 'Inspeksi, Palpasi, Auskultasi, dan Perkusi', 'a', '4', 'sedang', 'yes'),
(413, 3, 'asuhan kebidanan', 'Bidan memberikan Asuhan Kebidanan dengan menerapkan manajemen kebidanan secara langsung kepada klien berdasarkan standar dan protokol', 'Peran pelaksana', 'Peran kerjasama', 'Peran pengelola', 'Peran peneliti', 'Peran pendidik', 'a', '3', 'sulit', 'yes'),
(414, 3, 'asuhan kebidanan', 'Konsep dasar Asuhan Kebidanan pada ibu dalam masa persalinan disebut juga dengan', 'Proses pengeluaran plasenta sampai 2 jam persalinan', 'Proses pembukaan 1-10 cm', 'Proses pengeluaran bayi, plasenta dan selaput ketuban keluar dari uterus ibu', 'Proses yang terjadi setelah 2 jam persalinan', 'Tidak ada yang benar', 'c', '3', 'sulit', 'yes'),
(415, 3, 'asuhan kebidanan', 'Apa sajakah yang mempengaruhi mulainya persalinan?', 'Masuknya nutrisi ibu pada saat bersalin', 'Persalinan dibantu dengan kekuatan dari luar', 'Penurunan kadar progesterone, teori oxytosin, keregangan otot-otot, pengaruh janin, teori prostaglandin', 'Adanya nyeri hebat yang dirasakan oleh ibu', 'Tidak ada yang benar', 'c', '3', 'sulit', 'yes'),
(416, 3, 'asuhan kebidanan', 'Dalam melakukan pertolongan persalinan, bidan harus mengetahui tahapan persalinan. Turun dan masuknya kepala janin ke bidang PAP secara berurutan meliputi', 'Sinklitismus, asinklitismus posterior, asinklitismus anterior', 'Sinklitismus, asinklitismus anterior, asinklitismus posterior', 'Asinklitismus anterior, sinklitismus, asinklitismus posterior', 'Asinklitismus posterior, Sinklitismus, asinklitismus anterior', 'Tidak ada yang benar', 'b', '4', 'sulit', 'yes'),
(417, 3, 'asuhan kebidanan', 'Diketahui, ibu dalam masa persalinan, saat dipimpin meneran oleh bidan, maka tahapan persalinan yang benar, sesuai dengan teori adalah', 'Sinklitismus, asinklitismus, putar paksi dalam, fleksi, ekstensi, putar paksi luar', 'Sinklitismus, asinklitismus, fleksi, putar paksi dalam, ekstensi, putar paksi luar', 'Ainklitismus, sinklitismus, putar paksi dalam, fleksi, ekstensi, putar paksi luar', 'Asinklitismus, sinklitismus, fleksi, putar paksi dalam, ekstensi, putar paksi luar', 'Tidak ada yang benar', 'b', '3', 'sulit', 'yes'),
(418, 3, 'asuhan kebidanan', 'Tujuan memberikan Asuhan Kebidanan pada ibu bersalin adalah', 'Memantau kemajuan persalinan', 'Mengetahui keadaan ibu dan janin', 'Mendeteksi secara dini adanya komplikasi', 'Semua jawaban benar', 'Tidak ada yang benar', 'd', '3', 'sulit', 'yes'),
(419, 3, 'asuhan kebidanan', 'Hal yang dapat dilakukan oleh bidan pada ibu dengan inpartu adalah', 'Memberikan asuhan persalinan, seperti melakukan pemantauan dengan lembar observasi dan partograf.', 'Melakukan pemeriksaan fisik pada ibu inpartu.', 'Semua jawaban salah', 'Semua jawaban benar', 'Jawaban A saja yang benar', 'd', '3', 'sulit', 'yes'),
(420, 3, 'asuhan kebidanan', 'Peristiwa manakah yang sesuai, untuk menunjukkann keadaan kesejahteraan janin mengalami gangguan?', 'Ibu hamil, saat diperiksa oleh bidan diperoleh hasil EFW KMK', 'Ibu hami, saat diperiksa oleh bidan, hisnya kurang adekuat', 'Ibu hamil, saat dilakukan pemeriksaan oleh bidan diketahui UPL abnormal', 'Ibu hamil mengatakan pada bidan bahwa ia sangat takut menghadapi persalinannya', 'Tidak ada yang benar', 'a', '3', 'sulit', 'yes'),
(421, 3, 'asuhan kebidanan', 'Yang termasuk dalam lima aspek dasar atau Lima Benang Merah dalam Asuhan Persalinan dan Kelahiran Bayi antara lain, kecuali..', 'Membuat Keputusan Klinik', 'Asuhan Sayang ibu dan Suami', 'Pencegahan Infeksi', 'Rujukan', 'Pencatatan Asuhan Persalinan', 'b', '3', 'sedang', 'yes');
INSERT INTO `soal` (`id`, `id_jenis_tes`, `kategori`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `pilihan_e`, `jawaban`, `level_of_importance`, `level`, `publish`) VALUES
(422, 3, 'asuhan kebidanan', 'Profesi adalah aktivitas yang besifat intelektual berdasarkan ilmu pengetahuan, digunakan untuk tujuan pelayanan dapat dipelajari, terorganisir secara internal, dan aktristik mendahulukan kepentingan orang lain. Ini merupakan definisi Bidan menurut..', 'Mavis Kirkham', 'Abraham Flexman', 'Suessman', 'Scum E.H', 'Louis Pasteur', 'b', '3', 'sulit', 'yes'),
(423, 3, 'asuhan kebidanan', 'Penerapan fungsi bidan serta pelayanan kesehatan masyarakat merupakan pengertian dari..', 'Pelayanan kebidanan', 'Praktik kebidanan', 'Asuhan Kebidanan', 'Manajemen kebidanan', 'Diagnosa kebidanan', 'a', '3', 'sedang', 'yes'),
(424, 3, 'asuhan kebidanan', 'Berapa umur kehamilan normal?', '30 - 40 minggu', '27 - 40 minggu', '30 minggu - 10 bulan', '40 - 50 minggu', '40 minggu - 41 Minggu', 'b', '3', 'sedang', 'yes'),
(425, 3, 'asuhan kebidanan', 'Bidan memberikan Asuhan Kebidanan dengan menerapkan manajemen kebidanan secara langsung kepada klien berdasarkan standar dan protokol..', 'Peran pelaksana', 'Peran kerjasama', 'Peran pengelola', 'Peran peneliti', 'Peran pendidik', 'a', '3', 'sedang', 'yes'),
(426, 3, 'pencatatan/pelaporan', 'Pada saat ini pencatatan hasil pemeriksaan ANC masih sangat lemah, sehingga data - datanya tidak dapat dianalisa untuk peningkatan kualitas pelayanan ANC', 'Benar', 'Salah', '', '', '', 'a', '4', 'sedang', 'yes'),
(427, 3, 'pencatatan/pelaporan', 'Hasil pengolahan data PWS dapat disajikan dalam bentuk?', 'Narasi', 'Tabulasi', 'Grafik', 'Peta', 'Semua jawaban benar', 'e', '3', 'mudah', 'yes'),
(428, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan persalinan yaitu', 'Jumlah persalinan yang ditolong oleh tenaga kesehatan kompeten disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu bersalin disuatu wilayah kerja dalam 1 tahun dikalikan 200', 'Jumlah persalinan yang ditolong oleh tenaga kesehatan kompeten disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu bersalin disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah persalinan yang ditolong oleh tenaga kesehatan kompeten disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu bersalin disuatu wilayah kerja dalam 2 tahun dikalikan 100', 'Jumlah persalinan yang ditolong oleh tenaga kesehatan dan dukun disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu bersalin disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah persalinan yang ditolong oleh dukun disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu bersalin disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'b', '3', 'sedang', 'yes'),
(429, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan pelayanan nifas KF3 yaitu', 'Jumlah ibu nifas yang telah memperoleh 4 kali pelayanan nifas sesuai standar oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu nifas disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah ibu nifas yang telah memperoleh 3 kali pelayanan nifas sesuai standar oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu nifas disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah ibu nifas yang telah memperoleh 6 kali pelayanan nifas sesuai standar oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu nifas disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah ibu nifas yang telah memperoleh 4 kali pelayanan nifas tidak sesuai standar oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu nifas disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Tidak ada yang benar', 'c', '3', 'sedang', 'yes'),
(430, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan pelayanan KN1 yaitu', 'Jumlah nenonatus yang mendapatkan pelayanan sesuai standar pada 3 hari setelah lahir disuatu wilayah kerja pada kurun wkatu tertentu dibagi dengan jumlah seluruh sasaran bayi disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah nenonatus yang mendapatkan pelayanan sesuai standar pada 6-48 jam setelah lahir disuatu wilayah kerja pada kurun wkatu tertentu dibagi dengan jumlah seluruh sasaran bayi disuatu wilayah kerja dalam 2 tahun dikalikan 100', 'Jumlah nenonatus yang mendapatkan pelayanan sesuai standar pada 6-48 jam setelah lahir disuatu wilayah kerja pada kurun wkatu tertentu dibagi dengan jumlah seluruh sasaran bayi disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah nenonatus yang mendapatkan pelayanan sesuai standar pada 6-48 jam setelah lahir disuatu wilayah kerja pada kurun wkatu tertentu dibagi dengan jumlah seluruh sasaran bayi disuatu wilayah kerja dalam 1 tahun dikalikan 200', 'Tidak ada yang benar', 'c', '4', 'sedang', 'yes'),
(431, 3, 'pencatatan/pelaporan', 'Cara menentukan jumlah sasaran bayi yaitu?', 'Crude Birth rate x jumlah penduduk', 'Crude Birth rate x jumlah ibu hamil', 'Crude Birth rate x jumlah ibu nifas', 'Crude Birth rate x jumlah persalinan', 'Tidak ada yang benar', 'a', '2', 'sedang', 'yes'),
(432, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan pelayanan KN lengkap yaitu', 'Jumlah neonatus yang telah memperoleh 3 kali pelayanan kunjungan neonatus sesuai standar di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 100', 'Jumlah neonatus yang telah memperoleh 4 kali pelayanan kunjungan neonatus sesuai standar di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 100', 'Jumlah neonatus yang telah memperoleh 3 kali pelayanan kunjungan neonatus sesuai standar di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 200', 'Jumlah neonatus yang telah memperoleh 3 kali pelayanan kunjungan neonatus sesuai standar di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh sasaran bayi di suatu wilayah kerja dalam 2 tahun dikali 100', 'Tidak ada yang benar', 'a', '4', 'sedang', 'yes'),
(433, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan deteksi faktor resiko dan komplikasi oleh masyarakat yaitu', 'Jumlah ibu hamil yang beresiko yang ditemukan kades atau dukun bayi atau masyarakat disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan 25% kali jumlah sasaran ibu hamil di suatu wilayah dalam 1 tahun dikalikan 100', 'Jumlah ibu hamil yang beresiko yang ditemukan kades atau dukun bayi atau masyarakat disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan 20% kali jumlah sasaran ibu hamil di suatu wilayah dalam 1 tahun dikalikan 100', 'Jumlah ibu hamil yang beresiko yang ditemukan kades atau dukun bayi atau masyarakat disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan 15% kali jumlah sasaran ibu hamil di suatu wilayah dalam 1 tahun dikalikan 100', 'Jumlah ibu hamil yang beresiko yang ditemukan kades atau dukun bayi atau masyarakat disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan 30% kali jumlah sasaran ibu hamil di suatu wilayah dalam 1 tahun dikalikan 100', 'Jumlah ibu hamil yang beresiko yang ditemukan kades atau dukun bayi atau masyarakat disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan 25% kali jumlah sasaran ibu hamil di suatu wilayah dalam 1 tahun dikalikan 100', 'b', '3', 'sedang', 'yes'),
(434, 3, 'pencatatan/pelaporan', 'Rumus cakupan penangan komplikasi obstetri yaitu', 'Jumlah komplikasi kebidanan yang mendapatkan penanganan definitif di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan 20% kali jumlah sasaran ibu hamil di suatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah komplikasi kebidanan yang mendapatkan penanganan definitif di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan 30% kali jumlah sasaran ibu hamil di suatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah komplikasi kebidanan yang mendapatkan penanganan definitif di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan 2% kali jumlah sasaran ibu hamil di suatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah komplikasi kebidanan yang mendapatkan penanganan definitif di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan 10% kali jumlah sasaran ibu hamil di suatu wilayah kerja dalam 1 tahun dikalikan 100', 'Tidak ada yang benar', 'a', '3', 'sedang', 'yes'),
(435, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan penanganan komplikasi neonatus yaitu', 'Jumlah neonatus dengan komplikasi yang mendapat penanganan definitif disuatu wilayah kerja pada kurun waktu tertentu dibagi degan 15% dikalikan jumlah sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 100', 'Jumlah neonatus dengan komplikasi yang mendapat penanganan definitif disuatu wilayah kerja pada kurun waktu tertentu dibagi degan 5% dikalikan jumlah sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 100', 'Jumlah neonatus dengan komplikasi yang mendapat penanganan definitif disuatu wilayah kerja pada kurun waktu tertentu dibagi degan 25% dikalikan jumlah sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 100', 'Jumlah neonatus dengan komplikasi yang mendapat penanganan definitif disuatu wilayah kerja pada kurun waktu tertentu dibagi degan 10% dikalikan jumlah sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 100', 'Jumlah neonatus dengan komplikasi yang mendapat penanganan definitif disuatu wilayah kerja pada kurun waktu tertentu dibagi degan 1,5% dikalikan jumlah sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 100', 'a', '3', 'sedang', 'yes'),
(436, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan pelayanan kesehatan bayi 29 hari - 12 bulan (kunjungan bayi) yaitu', 'Jumlah bayi yang telah memperoleh 4 kali pelayanan kesehatan sesuai standar di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh sasaran bayi di suatu wilayah kerja dalam 2 tahun dikali 100', 'Jumlah bayi yang telah memperoleh 4 kali pelayanan kesehatan sesuai standar di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 10', 'Jumlah bayi yang telah memperoleh 4 kali pelayanan kesehatan sesuai standar di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 200', 'Jumlah bayi yang telah memperoleh 4 kali pelayanan kesehatan tidak sesuai standar di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 100', 'Jumlah bayi yang telah memperoleh 4 kali pelayanan kesehatan sesuai standar di suatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh sasaran bayi di suatu wilayah kerja dalam 1 tahun dikali 100', 'e', '3', 'sedang', 'yes'),
(437, 3, 'pencatatan/pelaporan', 'Rumus yag dipakai untuk menentukan cakupan K1 yaitu?', 'Jumlah ibu hamil yang pertama kali mendapat pelayanan ANC oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah ibu hamil yang pertama kali mendapat pelayanan ANC oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil disuatu wilayah kerja dalam 2 tahun dikalikan 100', 'Jumlah ibu hamil yang pertama kali mendapat pelayanan ANC oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil disuatu wilayah kerja dalam 1,5 tahun dikalikan 100', 'Jumlah ibu hamil yang pertama kali mendapat pelayanan ANC oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil disuatu wilayah kerja dalam 1 tahun dikalikan 200', 'Jumlah ibu hamil yang pertama kali mendapat pelayanan ANC oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil disuatu wilayah kerja dalam 2 tahun dikalikan 200', 'a', '4', 'sulit', 'yes'),
(438, 3, 'pencatatan/pelaporan', 'Jumlah sasaran ibu hamil dalam 1 tahun dapat diperoleh melalui proyeksi?', '1 x angka kelahiran kasar (CBR) x jumlah penduduk', '0,20 x angka kelahiran kasar (CBR) x jumlah penduduk', '2,10 x angka kelahiran kasar (CBR) x jumlah penduduk', '1,10 x angka kelahiran kasar (CBR) x jumlah penduduk', '0,10 x angka kelahiran kasar (CBR) x jumlah penduduk', 'd', '4', 'sulit', 'yes'),
(439, 3, 'pencatatan/pelaporan', 'Rumus yag dipakai untuk menentukan cakupan K4 yaitu?', 'Jumlah ibu hamil yang mendapatkan pelayanan ANC minimal 4 kali sesuai standar oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil di suatu wilayah dalam 2 tahun dikalikan 100', 'Jumlah ibu hamil yang mendapatkan pelayanan ANC minimal 4 kali sesuai standar oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil di suatu wilayah dalam 1 tahun dikalikan 100', 'Jumlah ibu hamil yang mendapatkan pelayanan ANC minimal 4 kali tidak sesuai standar oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil di suatu wilayah dalam 1 tahun dikalikan 100', 'Jumlah ibu hamil yang mendapatkan pelayanan ANC minimal 4 kali sesuai standar oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil di suatu wilayah dalam 1 tahun dikalikan 200', 'Jumlah ibu hamil yang mendapatkan pelayanan ANC minimal >4 kali sesuai standar oleh tenaga kesehatan disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah sasaran ibu hamil di suatu wilayah dalam 1 tahun dikalikan 100', 'b', '4', 'sulit', 'yes'),
(440, 3, 'pencatatan/pelaporan', 'Jumlah sasaran ibu bersalin dalam 1 tahun dihitung dengan rumus?', '1,05 x CBR x jumlah penduduk', '0,05 x CBR x jumlah penduduk', '5 x CBR x jumlah penduduk', '1,25 x CBR x jumlah penduduk', '0,25 x CBR x jumlah penduduk', 'a', '4', 'sulit', 'yes'),
(441, 3, 'pencatatan/pelaporan', 'Pada kabupaten Y yang mempunyai penduduk sebanyak 2.000 jiwa dan angka CBR terakhir kabupaten Y yaitu 27,0/1.000, berapa perkiraan jumlah ibu hamil di desa/kelurahan X?', '59', '59.1', '59.3', '59.4', '59.2', 'd', '3', 'sulit', 'yes'),
(442, 3, 'pencatatan/pelaporan', 'Pada kabupaten Y yang mempunyai penduduk sebanyak 2.000 jiwa dan angka CBR terakhir kabupaten Y yaitu 27,0/1.000, berapa perkiraan jumlah ibu bersalin di desa/kelurahan X?', '56.7', '56.5', '56.8', '56.1', '57', 'a', '3', 'sulit', 'yes'),
(443, 3, 'pencatatan/pelaporan', 'Dikota Y provinsi X yang mempunyai penduduk sebanyak 1.500 jiwa dan angka CBR terakhir kota Y 24,8/1.000 penduduk, maka jumlah perkiraan bayi di desa Z adalah?', '37.1', '37', '37.2', '37.3', '38', 'c', '3', 'sulit', 'yes'),
(444, 3, 'pencatatan/pelaporan', 'Berikut ini bukan area garapan pelayanan kebidanan yang merupakan titik tolak dari konferensi kependudukan dunia dikairo', 'Family Planning', 'Kesehatan Reproduksi Remaja', 'PMS', 'HIV', 'Making pregnancy safer', 'e', '3', 'sedang', 'yes'),
(445, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan peserta KB aktif yaitu', 'Jumlah perserta KB aktif disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh PUS disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah perserta KB aktif disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh PUS disuatu wilayah kerja dalam 2 tahun dikalikan 100', 'Jumlah perserta KB aktif disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh ibu bersalin disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah perserta KB aktif disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh WUS disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah perserta KB aktif disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh PUS disuatu wilayah kerja dalam 1 tahun dikalikan 10', 'a', '3', 'sulit', 'yes'),
(446, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan pelayanan anak balita (12-59 bulan) yaitu', 'Jumlah anak balita yang memperoleh pelayanan sesuai standar disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh anak balita disuatu wilayahkerja dalam 1 tahun', 'Jumlah anak balita yang memperoleh pelayanan sesuai standar disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh anak balita disuatu wilayahkerja dalam 2 tahun', 'Jumlah anak balita yang memperoleh pelayanan tidak sesuai standar disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh anak balita disuatu wilayahkerja dalam 1 tahun', 'Jumlah anak balita yang memperoleh pelayanan sesuai standar disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh neonatus disuatu wilayahkerja dalam 1 tahun', 'Jumlah anak balita yang memperoleh pelayanan sesuai standar disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh ibu bersalin disuatu wilayahkerja dalam 1 tahun', 'a', '4', 'sedang', 'yes'),
(447, 3, 'pencatatan/pelaporan', 'Rumus yang digunakan untuk menghitung cakupan pelayanan anak balita sakit yang dilayanin dengan MTBS yaitu', 'Jumlah anak balita sakit yang memperoleh pelayanan sesuai tatalaksana MTBS di Puskesmas disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh anak balita sakit yang berkunjung ke Puskesmas disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah anak balita sakit yang memperoleh pelayanan sesuai tatalaksana MTBS di Puskesmas disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh anak balita sakit yang berkunjung ke Puskesmas disuatu wilayah kerja dalam 2 tahun dikalikan 100', 'Jumlah anak balita sakit yang memperoleh pelayanan sesuai tatalaksana MTBS di Puskesmas disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh anak balita sakit yang berkunjung ke Puskesmas disuatu wilayah kerja dalam 1 tahun dikalikan 10', 'Jumlah anak balita sakit yang memperoleh pelayanan tidak sesuai tatalaksana MTBS di Puskesmas disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh anak balita sakit yang berkunjung ke Puskesmas disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'Jumlah anak balita sakit yang memperoleh pelayanan sesuai tatalaksana MTBS di Puskesmas disuatu wilayah kerja pada kurun waktu tertentu dibagi dengan jumlah seluruh anak balita sehat yang berkunjung ke Puskesmas disuatu wilayah kerja dalam 1 tahun dikalikan 100', 'a', '3', 'sedang', 'yes'),
(448, 3, 'pencatatan/pelaporan', 'Pada awalnya puskesmas merupakan integrasi pelayanan kesehatan kepada masyarakat yang dimulai dengan kegiatan', 'BKAI', 'PKMD', 'KIA', 'Posyandu', 'PKMD', 'd', '3', 'sedang', 'yes'),
(449, 0, '0', '<p>Binatang manakah dibawah ini yang tinggal di bawah air?</p>', '<p>Ikan</p>', '<p>Laba-laba</p>', '<p>Tupai</p>', '<p>Burung</p>', '<p>Anjing</p>', 'a', '', '', 'yes'),
(450, 0, '0', '<p>Kapankah bintang terlihat di langit?</p>', '<p>Ketika sore hari dan berawan</p>', '<p>Ketika siang hari</p>', '<p>Ketika hujan di pagi hari</p>', '<p>Ketika malam hari</p>', '', 'd', '', '', 'yes'),
(451, 0, '0', '<p>Menggunakan apakah kita mencuci rambut?</p>', '<p>Sabun mandi</p>', '<p>Sampo</p>', '<p>Pasta gigi</p>', '<p>Tanah</p>', '', 'b', '', '', 'yes'),
(452, 0, '0', '<p>Berikut adalah kendaraan beroda dua</p>', '<p>Sepeda Motor</p>', '<p>Mobil</p>', '<p>Truk</p>', '<p>Bis</p>', '<p>Kereta</p>', 'a', '', '', 'yes'),
(453, 0, '0', '<p>Manakah angka di bawah ini yang paling besar?</p>', '<p>3</p>', '<p>2</p>', '<p>4</p>', '<p>1</p>', '<p>5</p>', 'e', '', '', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE IF NOT EXISTS `tes` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `tanggal_tes` date NOT NULL,
  `token` varchar(32) NOT NULL,
  `aktif` enum('yes','no') NOT NULL DEFAULT 'yes',
  `waktu_selesai` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_jenis` (`id_jenis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;



-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `kontak` varchar(30) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `opensrp_username` varchar(50) NOT NULL,
  `opensrp_password` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `level` enum('super','master','chief','supervisor','fhw') NOT NULL,
  `level_num` int(4) NOT NULL,
  `tipe` enum('all','bidan','gizi','vaksinator') NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `opensrp_username`, `opensrp_password`, `location`, `level`, `level_num`, `tipe`, `last_login`) VALUES
(1, 'Admin', 'ae52341f5e4867b6db4db5d4102bd2a7', '', '', '', 'super', 5, 'all', '2017-04-04 02:27:41'),
(2, 'adminberita', '22b65133ce5ec630f4749aa7c8d2ebb0', '', '', '', 'master', 4, 'all', '2017-02-23 13:46:22'),
(3, 'admindemo', '85587e3aa839ec03b0967408ca2192f9', '', '', '', 'chief', 3, 'all', '2017-04-04 02:40:08');




--
-- Database: `gen_dho_pws`
--
CREATE DATABASE IF NOT EXISTS `gen_dho_pws` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gen_dho_pws`;

-- --------------------------------------------------------

--
-- Table structure for table `anak`
--

CREATE TABLE IF NOT EXISTS `anak` (
  `id` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `balita`
--

CREATE TABLE IF NOT EXISTS `balita` (
  `id` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bayi`
--

CREATE TABLE IF NOT EXISTS `bayi` (
  `id` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kb`
--

CREATE TABLE IF NOT EXISTS `kb` (
  `id` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kia`
--

CREATE TABLE IF NOT EXISTS `kia` (
  `id` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maternal`
--

CREATE TABLE IF NOT EXISTS `maternal` (
  `id` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `neonatal`
--

CREATE TABLE IF NOT EXISTS `neonatal` (
  `id` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE IF NOT EXISTS `target` (
  `loc_parent` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `bumil` varchar(255) NOT NULL,
  `bulin` varchar(255) NOT NULL,
  `bufas` varchar(255) NOT NULL,
  `bayi` varchar(255) NOT NULL DEFAULT '0',
  `balita` varchar(255) NOT NULL DEFAULT '0',
  `pus` varchar(255) NOT NULL DEFAULT '0',
  `pus4t` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

