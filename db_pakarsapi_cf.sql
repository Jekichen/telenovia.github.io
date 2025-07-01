-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2025 at 09:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pakarsapi_cf`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `id_akun` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_akun`
--

INSERT INTO `tbl_akun` (`id_akun`, `nama_lengkap`, `username`, `password`, `role`, `dibuat`) VALUES
(1, 'Administrator', 'Admin', '$2y$10$tEElQE8Sq/A6B.fsZb/Gxe5GH98WN8u28sXkwdWXC1ZAWYSSY4uOC', 'admin', '2025-06-17 16:59:56'),
(2, 'Zakaria', 'Jack', '$2y$10$DDH6XPpPnbj0NH1dAoB9WOnUWWIXcYobmKhM/2LnryU.umlx1V5OK', 'user', '2025-06-17 12:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_basis_pengetahuan`
--

CREATE TABLE `tbl_basis_pengetahuan` (
  `id_basis_pengetahuan` int(11) NOT NULL,
  `id_penyakit` int(11) DEFAULT NULL,
  `id_gejala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_basis_pengetahuan`
--

INSERT INTO `tbl_basis_pengetahuan` (`id_basis_pengetahuan`, `id_penyakit`, `id_gejala`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 1, 5),
(5, 2, 1),
(6, 2, 3),
(7, 2, 7),
(8, 2, 6),
(9, 2, 11),
(10, 3, 2),
(11, 3, 12),
(12, 3, 9),
(13, 3, 14),
(14, 3, 10),
(15, 4, 1),
(16, 4, 2),
(17, 4, 19),
(18, 4, 17),
(19, 4, 5),
(20, 4, 20),
(21, 5, 1),
(22, 5, 2),
(23, 5, 17),
(24, 5, 11),
(25, 5, 18),
(26, 5, 19),
(27, 6, 1),
(28, 6, 3),
(29, 6, 2),
(30, 6, 4),
(31, 6, 8),
(32, 7, 15),
(33, 7, 6),
(34, 7, 7),
(35, 7, 13),
(36, 7, 21),
(37, 7, 16),
(38, 8, 1),
(39, 8, 2),
(40, 8, 13),
(41, 8, 6),
(42, 8, 22);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_diagnosa`
--

CREATE TABLE `tbl_detail_diagnosa` (
  `id_detail` int(11) NOT NULL,
  `id_diagnosa` int(11) DEFAULT NULL,
  `id_gejala` int(11) DEFAULT NULL,
  `nilai_user` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_detail_diagnosa`
--

INSERT INTO `tbl_detail_diagnosa` (`id_detail`, `id_diagnosa`, `id_gejala`, `nilai_user`) VALUES
(1, 1, 1, 0.8),
(2, 1, 2, 0.4),
(3, 1, 3, 0.6),
(4, 1, 4, 0.8),
(5, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diagnosa`
--

CREATE TABLE `tbl_diagnosa` (
  `id_diagnosa` int(11) NOT NULL,
  `no_regdiagnosa` char(10) NOT NULL,
  `tgl_diagnosa` date NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_diagnosa`
--

INSERT INTO `tbl_diagnosa` (`id_diagnosa`, `no_regdiagnosa`, `tgl_diagnosa`, `id_akun`) VALUES
(1, 'E51T43AD19', '2025-06-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gejala`
--

CREATE TABLE `tbl_gejala` (
  `id_gejala` int(11) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL,
  `nilai_gejala` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gejala`
--

INSERT INTO `tbl_gejala` (`id_gejala`, `nama_gejala`, `nilai_gejala`) VALUES
(1, 'Demam Tinggi', 0.2),
(2, 'Nafsu Makan Menurun', 0.2),
(3, 'Badan Lemah (Lemas & Lesu)', 0.4),
(4, 'Gemetar', 0.4),
(5, 'Gangguan Pernafasan', 0.2),
(6, 'Sempoyongan', 0.2),
(7, 'Kejang-kejang', 0.4),
(8, 'Tidak Kuat Berdiri', 0.6),
(9, 'Diare', 0.6),
(10, 'Penurunan Berat Badan Secara Drastis', 0.6),
(11, 'Air Liur Berlebihan', 0.4),
(12, 'Bulu Kusam', 0.4),
(13, 'Bulu Rontok', 0.4),
(14, 'Mata Berair', 0.4),
(15, 'Keluar Getah Radang Pada Mata & Hidung', 0.6),
(16, 'Selaput Lendir Mata Berlebihan', 0.4),
(17, 'Rongga Mulut, Hidung, Lidah & Telapak Kaki Sapi Luka', 0.6),
(18, 'Sapi Berjalan Pincang', 0.4),
(19, 'Timbul Benjolan Pada Kulit', 0.4),
(20, 'Benjolan Pada Kulit Melebihi Batas Tertentu', 0.6),
(21, 'Berputar-putar Tanpa Arah', 0.8),
(22, 'Sapi Sering Menggosokan Tubuh Ke Kandang & Menggigit Bagian Tubuhnya Sendiri', 0.8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_penyakit` int(11) DEFAULT NULL,
  `no_regdiagnosa` char(10) NOT NULL,
  `tgl_diagnosa` date NOT NULL,
  `nilai_cf` double NOT NULL,
  `status_simpan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hasil`
--

INSERT INTO `tbl_hasil` (`id_hasil`, `id_akun`, `id_penyakit`, `no_regdiagnosa`, `tgl_diagnosa`, `nilai_cf`, `status_simpan`) VALUES
(1, 2, 1, 'E51T43AD19', '2025-06-17', 65.27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penyakit`
--

CREATE TABLE `tbl_penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `solusi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penyakit`
--

INSERT INTO `tbl_penyakit` (`id_penyakit`, `nama_penyakit`, `keterangan`, `solusi`, `gambar`) VALUES
(1, 'Bovine Respiratory Disease (BRD)', 'Bovine Respiratory Disease (BRD) adalah kompleks penyakit saluran pernapasan yang merupakan penyebab utama kematian dan kerugian ekonomi di industri peternakan sapi, terutama pada sapi pedaging dan pedet (anak sapi). BRD bukan satu penyakit tunggal, tetapi kombinasi dari infeksi virus, bakteri, dan stres lingkungan.', 'a. Vaksinasi dengan produk biologis yang menargetkan patogen virus dan bakteri,\r\nb. Mengasingkan (mengisolasi) ternak yang sakit agar tidak menularkan ke ternak lainnya,\r\nc. Menjaga kebersihan kandang, peralatan dan tubuh sapi secara rutin,\r\nd. Pemberian vitamin,\r\ne. Pemberian antibiotik.', 'sapi-p-kontrak.jpg'),
(2, 'Anthrax', ' Anthrax adalah penyakit infeksi akut yang sangat berbahaya dan menular, disebabkan oleh bakteri Bacillus anthracis. Penyakit ini dapat menyerang berbagai jenis hewan, termasuk sapi, dan juga bersifat zoonosis (dapat menular ke manusia). Penularan terjadi melalui kontak langsung dengan spora bakteri dari tanah, pakan, atau air yang terkontaminasi. Gejala klinis pada sapi dapat berupa demam tinggi, nafas cepat, lemas, pendarahan dari lubang tubuh (hidung, mulut, anus), dan kematian mendadak. Karena spora B. anthracis sangat tahan terhadap kondisi lingkungan, penanganan dan pencegahan yang tepat sangat penting untuk menghindari penyebaran penyakit ini.', 'a. Melaporkan kasus Anthrax ke dinas peternakan setempat,\r\nb. Jangan membedah atau membuka bangkai sapi yang diduga mati karena Anthrax,\r\nc. Pengobatan menggunakan kombinasi antiserum dan antibiotika, seperti: Procain Penisilin G, Streptomisin, & Kombinasi Penisilin + Streptomisin diberikan melalui injeksi intramuskuler sesuai dosis anjuran pakar hewan,\r\nd. Pemberian vaksinasi Anthrax untuk mencegah penyebaran,\r\ne. Mengasingkan (mengisolasi) ternak yang sakit agar tidak menularkan ke ternak lainnya,\r\nf. Pemberian antibiotik tambahan sesuai petunjuk dokter hewan untuk mengendalikan infeksi awal atau kasus ringan.', 'sapi-anthrax.jpg'),
(3, 'Cacingan', 'Cacingan (Helminthiasis) pada sapi adalah penyakit yang disebabkan oleh infestasi parasit cacing, seperti cacing gelang (Ascaris), cacing pita (Taenia), atau cacing hati (Fasciola). Cacing-cacing ini menyerang sistem pencernaan dan organ dalam sapi, mengakibatkan gangguan penyerapan nutrisi, penurunan berat badan, nafsu makan buruk, pertumbuhan terhambat, bahkan kematian pada kasus parah. Penularan umumnya terjadi melalui pakan atau air yang terkontaminasi telur atau larva cacing, terutama di lingkungan yang lembap dan tidak higienis.', 'a. Pemberian obat cacing secara berkala, minimal setiap 6 bulan sekali, untuk mencegah dan mengendalikan infestasi cacing,\r\nb. Obat cacing diberikan mulai usia 3 minggu, kemudian diberikan rutin setiap 6 bulan sekali sebagai tindakan deworming,\r\nc. Induk sapi bunting tidak disarankan diberi obat cacing, karena berisiko menyebabkan keguguran,\r\nd. Pemilihan lokasi rumput penting, hindari mengambil rumput di pinggir sungai atau mencabut sampai ke akar karena bisa membawa telur/larva cacing dari tanah,\r\ne. Obat cacing yang dianjurkan adalah yang mengandung Albendazole, karena efektif terhadap berbagai jenis cacing,\r\nf. Obat tradisional alternatif: larutan dari buah pinang dicampur air dengan perbandingan 1:10 (1 bagian buah pinang, 10 bagian air),\r\ng. Menjaga kebersihan kandang, peralatan dan tubuh sapi secara rutin, serta lakukan sanitasi pada kandang,\r\nh. Hindari mengeluarkan sapi terlalu pagi.', 'sapi-cacingan.png'),
(4, 'Lumpy Skin Disease (Lato-Lato)', 'Lumpy Skin Disease (LSD) adalah penyakit menular yang disebabkan oleh virus dari keluarga Poxviridae. Penyakit ini ditandai dengan munculnya benjolan atau nodul pada kulit sapi yang terinfeksi. LSD dapat menyebabkan penurunan produksi susu, penurunan berat badan, demam, dan gejala lainnya yang dapat merugikan peternak. Meskipun hingga saat ini belum ada pengobatan khusus untuk LSD, pengobatan dilakukan secara simptomatik untuk mengatasi gejala yang muncul dan mendukung pemulihan sapi. Pencegahan utama terhadap penyakit ini adalah dengan vaksinasi. Namun, vaksinasi hanya dilakukan di daerah yang rawan terjangkit LSD, sementara Indonesia yang bebas LSD tidak melakukan vaksinasi secara rutin. Oleh karena itu, kewaspadaan dan sistem surveilans perlu ditingkatkan untuk mencegah penyebaran penyakit ini.', 'a. Pemberian vaksinasi LSD, dilakukan secara terjadwal untuk mencegah penyebaran,\r\nb. Mengasingkan (mengisolasi) ternak yang sakit agar tidak menularkan ke ternak lainnya,\r\nc. Menjaga kebersihan kandang, peralatan dan tubuh sapi secara rutin, serta lakukan sanitasi pada kandang, Lakukan penyemprotan dengan larutan disinfektan seperti ether, kloroform, formalin, fenol, natrium hipoklorit, atau senyawa amonium kuaterner,\r\nd. Untuk sapi yang terinfeksi, berikan obat-obatan untuk mengurangi gejala seperti demam dan nyeri pada kulit.', 'sapi-lsd.png'),
(5, 'Penyakit Mulut & Kuku (PMK)', 'Penyakit Mulut dan Kuku (PMK) adalah penyakit hewan menular yang sangat menular dan disebabkan oleh virus dari genus Aphthovirus, keluarga Picornaviridae. Penyakit ini menyerang hewan berkuku belah seperti sapi, kerbau, kambing, dan domba. Gejala umum pada sapi meliputi demam tinggi, lepuh atau luka pada mulut, lidah, gusi, dan celah kuku, air liur berlebih, serta pincang. PMK memiliki dampak ekonomi yang besar karena menyebabkan penurunan produktivitas ternak, hambatan perdagangan, serta kematian pada anak sapi.', 'a. Menjaga kebersihan kandang, peralatan, dan tubuh sapi secara rutin, serta lakukan sanitasi pada kandang,\r\nb. Pemberian vaksinasi PMK, dilakukan secara terjadwal untuk mencegah penyebaran,\r\nc. Mengasingkan (mengisolasi) ternak yang sakit agar tidak menularkan ke ternak lainnya,\r\nd. Pemberian suplemen vitamin A, obat sulfa, dan antibiotik dapat membantu mempercepat pemulihan, mencegah infeksi sekunder, dan meningkatkan daya tahan tubuh sapi.', 'sapi-pmk.jpg'),
(6, 'Bovine Ephemeral Fever (BEF)', 'Bovine Ephemeral Fever (BEF) adalah penyakit akut pada sapi yang disebabkan oleh virus dari keluarga Rhabdoviridae. Penyakit ini dikenal juga sebagai demam tiga hari karena gejala utamanya berlangsung singkat, umumnya 3 hari. Sapi yang terinfeksi akan mengalami demam tinggi secara mendadak, lemas, nafsu makan menurun, dan nyeri otot atau sendi. Meskipun tingkat kematiannya rendah, penyakit ini dapat menyebabkan kerugian ekonomi yang signifikan akibat penurunan produksi susu, bobot badan, serta biaya pengobatan.', 'a. Pemberian Antipiretik (obat penurun demam) dan Analgesik (obat pereda nyeri) seperti dypirone dan lidocaine,\r\nb. Pemberian antibiotik,\r\nc. Lakukan pengobatan SIMTOMA untuk meredakan gejala dan mempercepat pemulihan tubuh sapi,\r\nd. Pemberian vitamin AD3E, B, dan C,\r\ne. Mengasingkan (mengisolasi) ternak yang sakit agar tidak menularkan ke ternak lainnya.', 'sapi-bef.jpg'),
(7, 'Surra', 'Surra adalah penyakit hewan menular yang disebabkan oleh protozoa Trypanosoma evansi dan ditularkan melalui gigitan serangga penghisap darah seperti lalat Tabanus (lalat kuda). Penyakit ini menyerang berbagai jenis hewan termasuk sapi, dan dapat menyebabkan kerugian ekonomi yang besar karena menurunkan produktivitas, berat badan, serta bahkan menyebabkan kematian jika tidak ditangani. Gejala yang umum muncul meliputi demam, lemah, nafsu makan menurun, anemia, bengkak pada beberapa bagian tubuh, serta kehilangan koordinasi gerak.', 'a. Sangat di rekomendasikan untuk memberikan obat suramin diberikan secara intravena (melalui pembuluh darah) dengan dosis 10 mg/kg bobot tubuh dalam larutan 10%,\r\nb. Sebagai alternatif, Isometamidium chlorida diberikan secara intramuskuler (suntikan ke otot) dengan dosis 1–2 mg/kg bobot tubuh.', 'sapi-surra.jpg'),
(8, 'Scabies', 'Scabies atau kudis pada sapi adalah penyakit kulit yang disebabkan oleh infestasi tungau Sarcoptes scabiei. Parasit ini menggali liang di kulit dan menyebabkan rasa gatal hebat, iritasi, penebalan kulit, kerontokan rambut, serta luka akibat garukan. Penyakit ini sangat menular antar hewan melalui kontak langsung atau peralatan yang terkontaminasi, dan dapat menurunkan kesehatan serta produktivitas ternak secara signifikan.', 'a. Penyuntikan obat Ivermectin,\r\nb. Obat tradisional (Belerang, Kunyit, dan Minyak Kelapa), Campuran belerang yang dihaluskan, kunyit, dan minyak kelapa yang telah dipanaskan dioleskan pada area kulit yang terserang,\r\nc. Cukur bulu di sekitar area yang terkena scabies, kemudian sapi dimandikan menggunakan sabun hingga bersih, Setelah dikeringkan, dapat dilakukan pengobatan menggunakan campuran belerang dan minyak kelapa seperti di atas,\r\nd. Obat tradisional alternatif, Kapur barus digerus dicampur dengan minyak kelapa, lalu dioleskan secara merata pada kulit yang terinfeksi,\r\ne. Mengasingkan (mengisolasi) ternak yang sakit agar tidak menularkan ke ternak lainnya,\r\nf. Menjaga kebersihan kandang, peralatan dan tubuh sapi secara rutin.', 'sapi-scabies.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_akun`, `nama_lengkap`, `nomor_telepon`, `dibuat`) VALUES
(1, 2, 'Zakaria', '085856577172', '2025-06-17 12:01:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tbl_basis_pengetahuan`
--
ALTER TABLE `tbl_basis_pengetahuan`
  ADD PRIMARY KEY (`id_basis_pengetahuan`),
  ADD KEY `fk_penyakit` (`id_penyakit`),
  ADD KEY `fk_gejala` (`id_gejala`);

--
-- Indexes for table `tbl_detail_diagnosa`
--
ALTER TABLE `tbl_detail_diagnosa`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_diagnosa` (`id_diagnosa`),
  ADD KEY `fk_detial_gejala` (`id_gejala`);

--
-- Indexes for table `tbl_diagnosa`
--
ALTER TABLE `tbl_diagnosa`
  ADD PRIMARY KEY (`id_diagnosa`),
  ADD KEY `dk_diagnosa_akun` (`id_akun`);

--
-- Indexes for table `tbl_gejala`
--
ALTER TABLE `tbl_gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `fk_hasil_akun` (`id_akun`),
  ADD KEY `fk_hasil_penyakit` (`id_penyakit`);

--
-- Indexes for table `tbl_penyakit`
--
ALTER TABLE `tbl_penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_akun` (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_basis_pengetahuan`
--
ALTER TABLE `tbl_basis_pengetahuan`
  MODIFY `id_basis_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_detail_diagnosa`
--
ALTER TABLE `tbl_detail_diagnosa`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_diagnosa`
--
ALTER TABLE `tbl_diagnosa`
  MODIFY `id_diagnosa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_gejala`
--
ALTER TABLE `tbl_gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_penyakit`
--
ALTER TABLE `tbl_penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_basis_pengetahuan`
--
ALTER TABLE `tbl_basis_pengetahuan`
  ADD CONSTRAINT `fk_gejala` FOREIGN KEY (`id_gejala`) REFERENCES `tbl_gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penyakit` FOREIGN KEY (`id_penyakit`) REFERENCES `tbl_penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_detail_diagnosa`
--
ALTER TABLE `tbl_detail_diagnosa`
  ADD CONSTRAINT `fk_detail_diagnosa` FOREIGN KEY (`id_diagnosa`) REFERENCES `tbl_diagnosa` (`id_diagnosa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detial_gejala` FOREIGN KEY (`id_gejala`) REFERENCES `tbl_gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_diagnosa_ibfk_1` FOREIGN KEY (`id_diagnosa`) REFERENCES `tbl_diagnosa` (`id_diagnosa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_diagnosa_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `tbl_gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_diagnosa`
--
ALTER TABLE `tbl_diagnosa`
  ADD CONSTRAINT `dk_diagnosa_akun` FOREIGN KEY (`id_akun`) REFERENCES `tbl_akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_diagnosa_akun` FOREIGN KEY (`id_akun`) REFERENCES `tbl_akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD CONSTRAINT `fk_hasil_akun` FOREIGN KEY (`id_akun`) REFERENCES `tbl_akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hasil_penyakit` FOREIGN KEY (`id_penyakit`) REFERENCES `tbl_penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `tbl_akun` (`id_akun`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
