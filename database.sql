--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_photo` varchar(255),
  PRIMARY KEY (`admin_id`)
);

--
-- Dumping data for table `admin`
--

INSERT INTO `admin`(`admin_username`, `admin_password`, `admin_photo`) VALUES
('qqdnada', md5('superadmin'), './admin_photo/large.jpeg'),
('admin', md5('admin'), './admin_photo/coba.jpg');

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `mahasiswa_nim` int(11) NOT NULL,
  `mahasiswa_nama` varchar(255) NOT NULL,
  `mahasiswa_program_studi` varchar(255) NOT NULL,
  `mahasiswa_no_hp` varchar(15),
  PRIMARY KEY(`mahasiswa_nim`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` VALUES
(180010001, 'Ramasundar', 'Akuntansi', '075-12458969'),
(180010002, 'Ravi Kumar', 'Akuntansi', '029-12358964'),
(180010003, 'Mukesh', 'Akuntansi', '077-45625874'),
(180010004, 'Benjamin', 'Akuntansi', '045-21447739'),
(180010005, 'Ivan', 'Akuntansi', '008-22544166'),
(180020001, 'Change', 'Bahasa Indonesia', '077-45625874'),
(180020002, 'Khaleed', 'Bahasa Indonesia', '045-21447739'),
(180020003, 'Alice', 'Bahasa Indonesia', '008-22544166'),
(180030001, 'Natalia Kim', 'Bahasa Inggris', '077-45625874'),
(180030002, 'Khaleed', 'Bahasa Inggris', '045-21447739'),
(180040001, 'Alicia Grande', 'Ekonomi', '008-22544166'),
(180040002, 'Ariana Grande', 'Ekonomi', '008-22544166'),
(180040003, 'Danielle Grande', 'Ekonomi', '008-22544166');

--
-- Table structure for table `nilai_mahasiswa`
--

CREATE TABLE `nilai_mahasiswa` (
  `nilaimahasiswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `mahasiswa_nim` int(11) NOT NULL,
  `nilaimahasiswa_mata_kuliah` varchar(255) NOT NULL,
  `nilaimahasiswa_nilai` int(4) NOT NULL,
  PRIMARY KEY (`nilaimahasiswa_id`),
  FOREIGN KEY (`mahasiswa_nim`) REFERENCES mahasiswa(`mahasiswa_nim`)
) ENGINE=InnoDB COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_mahasiswa`
--

INSERT INTO `nilai_mahasiswa`(`mahasiswa_nim`, `nilaimahasiswa_mata_kuliah`, `nilaimahasiswa_nilai`) VALUES
(180020001, 'Filsafat', 85),
(180020002, 'Filsafat', 64),
(180020003, 'Filsafat', 68),
(180040001, 'Ekonomi Syariah', 90),
(180040002, 'Ekonomi Syariah', 70),
(180040003, 'Ekonomi Syariah', 50),
(180030001, 'Sejarah Inggris', 98),
(180030002, 'Sejarah Inggris', 88),
(180030001, 'Filsafat', 75),
(180030002, 'Filsafat', 82),
(180020001, 'Sejarah Indonesia', 78),
(180020002, 'Sejarah Indonesia', 80),
(180020003, 'Sejarah Indonesia', 86);