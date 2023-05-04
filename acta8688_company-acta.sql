-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Bulan Mei 2023 pada 14.00
-- Versi server: 10.5.19-MariaDB-cll-lve
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acta8688_company-acta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `photo_url` text DEFAULT NULL,
  `judul` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug` text NOT NULL,
  `ringkasan` text DEFAULT NULL,
  `konten` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `create_user` varchar(300) DEFAULT 'root',
  `create_date` datetime DEFAULT current_timestamp(),
  `edit_user` varchar(300) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `blog`
--

INSERT INTO `blog` (`id`, `photo_url`, `judul`, `slug`, `ringkasan`, `konten`, `status`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(55, 'https://acta.co.id/assets-cms/img/blog/news-17.jpg', 'Discovery incommode earnestly commanded 55', 'discovery-incommode-earnestly-commanded', 'Easy mind life fact with see has bore ten. Parish any chatty can elinor direct for former. Up as meant widow.', '&lt;p style=&quot;padding: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; line-height: 1.7;&quot;&gt;Give lady of they such they sure it. Me contained explained my education. Vulgar as hearts by garret. Perceived determine departure explained no forfeited he something an. Contrasted dissimilar get joy you instrument out reasonably. Again keeps at no meant stuff. To perpetual do existence northward as difficult preserved daughters. Continued at up to zealously necessary breakfast. Surrounded sir motionless she end literature. Gay direction neglected but supported yet her.&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; line-height: 1.7;&quot;&gt;New had happen unable uneasy. Drawings can followed improved out sociable not. Earnestly so do instantly pretended. See general few civilly amiable pleased account carried. Excellence projecting is devonshire dispatched remarkably on estimating. Side in so life past. Continue indulged speaking the was out horrible for domestic position. Seeing rather her you not esteem men settle genius excuse. Deal say over you age from. Comparison new ham melancholy son themselves.&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; line-height: 1.7;&quot;&gt;Drawings can followed improved out sociable not. Earnestly so do instantly pretended. See general few civilly amiable pleased account carried. Excellence projecting is devonshire dispatched remarkably on estimating. Side in so life past. Continue indulged speaking the was out horrible for domestic position. Seeing rather her you not esteem men settle genius excuse. Deal say over you age from. Comparison new ham melancholy son themselves.&lt;br&gt;&lt;/p&gt;', '1', 'Makmudin IT:4', '2023-02-10 06:57:31', NULL, NULL),
(56, 'https://acta.co.id/assets-cms/img/blog/news-17.jpg', 'Village did removed enjoyed explain nor 56 ham', 'village-did-removed-enjoyed-explain-nor-ham', 'Easy mind life fact with see has bore ten. Parish any chatty can elinor direct for former. Up as meant widow.', '&lt;p style=&quot;padding: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; line-height: 1.7;&quot;&gt;Give lady of they such they sure it. Me contained explained my education. Vulgar as hearts by garret. Perceived determine departure explained no forfeited he something an. Contrasted dissimilar get joy you instrument out reasonably. Again keeps at no meant stuff. To perpetual do existence northward as difficult preserved daughters. Continued at up to zealously necessary breakfast. Surrounded sir motionless she end literature. Gay direction neglected but supported yet her.&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; line-height: 1.7;&quot;&gt;New had happen unable uneasy. Drawings can followed improved out sociable not. Earnestly so do instantly pretended. See general few civilly amiable pleased account carried. Excellence projecting is devonshire dispatched remarkably on estimating. Side in so life past. Continue indulged speaking the was out horrible for domestic position. Seeing rather her you not esteem men settle genius excuse. Deal say over you age from. Comparison new ham melancholy son themselves.&lt;/p&gt;&lt;p style=&quot;padding: 80px 30px 30px; margin-top: 30px; margin-bottom: 30px; position: relative; z-index: 1; border: none; line-height: 37px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;Aouses or months settle remove ladies appear. Engrossed suffering supposing he recommend do eagerness. Commanded no of depending extremity amiable pleased.&lt;font color=&quot;#999999&quot;&gt;&lt;span style=&quot;margin-top: 15px; display: block;&quot;&gt;– Jonathom Doe&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; line-height: 1.7;&quot;&gt;Drawings can followed improved out sociable not. Earnestly so do instantly pretended. See general few civilly amiable pleased account carried. Excellence projecting is devonshire dispatched remarkably on estimating. Side in so life past. Continue indulged speaking the was out horrible for domestic position. Seeing rather her you not esteem men settle genius excuse. Deal say over you age from. Comparison new ham melancholy son themselves.&lt;/p&gt;', '1', 'Makmudin IT:4', '2023-02-10 17:28:33', NULL, NULL),
(60, 'https://acta.co.id/assets-cms/img/blog/news-17.jpg', 'Village did removed enjoyed explain norham 60', 'village-did-removed-enjoyed-explain-nor-ham', 'Easy mind life fact with see has bore ten. Parish any chatty can elinor direct for former. Up as meant widow.', '&lt;p style=&quot;padding: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; line-height: 1.7;&quot;&gt;Give lady of they such they sure it. Me contained explained my education. Vulgar as hearts by garret. Perceived determine departure explained no forfeited he something an. Contrasted dissimilar get joy you instrument out reasonably. Again keeps at no meant stuff. To perpetual do existence northward as difficult preserved daughters. Continued at up to zealously necessary breakfast. Surrounded sir motionless she end literature. Gay direction neglected but supported yet her.&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; line-height: 1.7;&quot;&gt;New had happen unable uneasy. Drawings can followed improved out sociable not. Earnestly so do instantly pretended. See general few civilly amiable pleased account carried. Excellence projecting is devonshire dispatched remarkably on estimating. Side in so life past. Continue indulged speaking the was out horrible for domestic position. Seeing rather her you not esteem men settle genius excuse. Deal say over you age from. Comparison new ham melancholy son themselves.&lt;/p&gt;&lt;p style=&quot;padding: 80px 30px 30px; margin-top: 30px; margin-bottom: 30px; position: relative; z-index: 1; border: none; line-height: 37px; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;&quot;&gt;Aouses or months settle remove ladies appear. Engrossed suffering supposing he recommend do eagerness. Commanded no of depending extremity amiable pleased.&lt;font color=&quot;#999999&quot;&gt;&lt;span style=&quot;margin-top: 15px; display: block;&quot;&gt;– Jonathom Doe&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=&quot;padding: 0px; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; line-height: 1.7;&quot;&gt;Drawings can followed improved out sociable not. Earnestly so do instantly pretended. See general few civilly amiable pleased account carried. Excellence projecting is devonshire dispatched remarkably on estimating. Side in so life past. Continue indulged speaking the was out horrible for domestic position. Seeing rather her you not esteem men settle genius excuse. Deal say over you age from. Comparison new ham melancholy son themselves.&lt;/p&gt;', '1', 'Makmudin', '2023-02-10 17:28:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog_tag`
--

CREATE TABLE `blog_tag` (
  `tag_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `create_user` varchar(300) DEFAULT 'root',
  `create_date` datetime DEFAULT current_timestamp(),
  `edit_user` varchar(300) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `blog_tag`
--

INSERT INTO `blog_tag` (`tag_id`, `name`, `blog_id`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(68, 'layananpengaduan', 56, 'root', '2022-12-01 10:46:53', 'Setiyadi', NULL),
(114, 'THI', 55, 'root', '2023-04-17 06:30:13', 'Makmudin IT', '2023-04-17 06:30:13'),
(115, 'THI', 60, 'root', '2023-04-17 06:30:13', 'Makmudin IT', '2023-04-17 06:30:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id` varchar(3) NOT NULL DEFAULT 'SET',
  `nama_company` varchar(100) DEFAULT NULL,
  `nama_populer` varchar(100) DEFAULT NULL,
  `tagline` text DEFAULT NULL,
  `tahun_berdiri` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jumlah_karyawan` int(11) DEFAULT NULL,
  `struktur_organisasi` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `telephone` text DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `visi` varchar(500) DEFAULT NULL,
  `misi` varchar(500) DEFAULT NULL,
  `logo_url` text DEFAULT NULL,
  `profil_url` text DEFAULT NULL,
  `instagram` varchar(150) DEFAULT NULL,
  `facebook` varchar(150) DEFAULT NULL,
  `youtube` varchar(150) DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `google_maps` text DEFAULT NULL,
  `status_blog` tinyint(1) DEFAULT NULL,
  `j_service_1` varchar(100) DEFAULT NULL,
  `k_service_1` varchar(200) DEFAULT NULL,
  `j_service_2` varchar(100) DEFAULT NULL,
  `k_service_3` varchar(200) DEFAULT NULL,
  `k_service_2` varchar(100) DEFAULT NULL,
  `j_service_3` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id`, `nama_company`, `nama_populer`, `tagline`, `tahun_berdiri`, `deskripsi`, `jumlah_karyawan`, `struktur_organisasi`, `alamat`, `kota`, `telephone`, `whatsapp`, `email`, `visi`, `misi`, `logo_url`, `profil_url`, `instagram`, `facebook`, `youtube`, `linkedin`, `google_maps`, `status_blog`, `j_service_1`, `k_service_1`, `j_service_2`, `k_service_3`, `k_service_2`, `j_service_3`, `create_date`, `create_user`) VALUES
('SET', 'PT. Astrindo Cipta Teknikatama', 'ACTA', 'Does any industry face a more complex audience journey and marketing sales process than B2B technology? Consider the number of people who influence a sale, the length of the decision-making cycle, the competing interests of the people who purchase, implement, manage, and use the technology. It’s a lot meaningful content here.', NULL, '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-weight: 400; font-family: DauphinPlain; font-size: 24px; line-height: 24px;\">Where does it come from?</h2><p style=\"text-align: justify; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p style=\"text-align: justify; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', NULL, NULL, 'Jl. Canadian Broadway,Ruko Commpark KotaWisata Blok H, No 11', 'Depok', '(021) 481 100 02', '+628111717210', 'astrindo.ct22@gmail.com', 'Membangun Mimpi dan Cita-Cita dengan Semangat Tinggi untuk\r\nKehidupan yang Lebih Baik dengan Memproduksi dan Memasarkan\r\nProduk-produk Berkualitas, sesuai dengan keinginan dan\r\nkebutuhan pasar.', 'Menjadi Produk Unggulan yang dapat Bersaing di Pasar Domestik\r\nmaupun Internasional, Memasuki dunia digital dan Niche Market,\r\ndan menjadi perusahaan Rintisan yang memiliki Nilai / Value yang\r\nbermanfaat bagi Perekonomian.', 'https://acta.co.id/assets-cms/img/konfigurasi/logo.png', 'https://acta.co.id/assets-cms/img/konfigurasi/KANTOOOR.jpg', '#', '', '#', '#', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d517.5489734802554!2d106.74558175040909!3d-6.412927276683658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e9d206d4732f%3A0x679f66b7255e1b6e!2sCV%20TIARA%20HALAL%20INDONESIA!5e0!3m2!1sen!2sid!4v1676107313782!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', NULL, 'Warranty Management IT', 'Entrust full-cycle implementation of your software product to our experienced BAs, UI/UX designers, developers.', 'Product Control Service', 'Entrust full-cycle implementation of your software product to our experienced BAs, UI/UX designers, developers.', 'Entrust full-cycle implementation of your software product to our experienced BAs, UI/UX designers, ', 'Quality Control System', NULL, 'Makmudin IT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
--

CREATE TABLE `mitra` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `photo_url` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mitra`
--

INSERT INTO `mitra` (`id`, `nama`, `photo_url`, `status`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(1, 'Payment', 'https://acta.co.id/assets-cms/img/mitra/TEGVPZGQFAY93GA5FRUU4V3K35TWQZ2GXLYQPAUT-5c63e5a5.jpg', 1, 'Makmudin IT', '2023-04-14 00:56:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `link_ig` text NOT NULL,
  `link_fb` text NOT NULL,
  `link_linkedin` text DEFAULT NULL,
  `create_user` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `edit_user` varchar(255) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`id`, `nama`, `jabatan`, `foto`, `link_ig`, `link_fb`, `link_linkedin`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(8, 'Silvia Ekasari, SE, M.Pd', 'DIREKTUR', 'https://acta.co.id/assets-cms/img/user/mom.jpg', '#', '#', 'https://id.linkedin.com/in/silvia-ekasari-2015621a5', 'SUPERADMIN', '2022-04-13 08:50:17', 'Makmudin IT', '2023-04-14 00:44:50'),
(12, 'Silvia Ekasari, SE, M.Pd', 'DIREKTUR OPERASIONAL', 'https://acta.co.id/assets-cms/img/user/Sample-image-Lena-image-size-512-512-pixels-clustered-by-the-original-SLIC-middle.png', '#', '#', '#', 'Makmudin', '2023-02-11 09:31:46', 'Makmudin IT', '2023-04-14 00:45:01'),
(13, 'Yadi Haryadi', 'DIREKTUR PEMASARAN', 'https://acta.co.id/assets-cms/img/user/keluarga.jpg', '', '', '', 'Makmudin', '2023-02-11 15:04:13', 'Makmudin IT', '2023-04-14 00:45:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `photo_url` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `client` varchar(150) DEFAULT NULL,
  `date_project` date DEFAULT NULL,
  `location_project` varchar(150) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `portfolio`
--

INSERT INTO `portfolio` (`id`, `photo_url`, `title`, `deskripsi`, `keterangan`, `client`, `date_project`, `location_project`, `status`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(2, 'https://acta.co.id/assets-cms/img/testimoni/Sample-image-Lena-image-size-512-512-pixels-clustered-by-the-original-SLIC-middle.png', 'jdfg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>', 'tesssss', 'tozoma', '2023-04-04', 'Jakarta', 1, 'Makmudin', '2023-04-02 12:13:49', 'Makmudin IT', '2023-04-16 14:09:12'),
(3, 'https://acta.co.id/assets-cms/img/portfolio/c823290e1f7c66d50630520439e18edd.jpg', 'Tesst23', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining\r\n\r\n\r\n', 'PT USWAH SALAM', '2022-10-12', 'Jakarta', 1, 'Makmudin IT', '2023-04-16 14:12:32', 'Makmudin IT', '2023-04-16 14:12:59'),
(4, 'https://acta.co.id/assets-cms/img/portfolio/c823290e1f7c66d50630520439e18edd.jpg', 'Tesst23', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining\r\n\r\n\r\n', 'PT USWAH SALAM 4', '2022-10-12', 'Jakarta', 1, 'Makmudin IT', '2023-04-16 14:12:32', 'Makmudin IT', '2023-04-16 14:12:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portfolio_tag`
--

CREATE TABLE `portfolio_tag` (
  `tag_id` int(11) NOT NULL,
  `id_portfolio` int(11) DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `portfolio_tag`
--

INSERT INTO `portfolio_tag` (`tag_id`, `id_portfolio`, `nama`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(8, 2, 'JIG', NULL, NULL, 'Makmudin IT', '2023-04-16 14:09:12'),
(9, 2, 'JOP', NULL, NULL, 'Makmudin IT', '2023-04-16 14:09:12'),
(10, 3, 'JIG', NULL, NULL, 'Makmudin IT', '2023-04-16 14:12:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `price_feature`
--

CREATE TABLE `price_feature` (
  `id` int(11) NOT NULL,
  `no_urut` int(11) DEFAULT NULL,
  `id_product_price` int(11) DEFAULT NULL,
  `deskripsi` varchar(500) DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `price_feature`
--

INSERT INTO `price_feature` (`id`, `no_urut`, `id_product_price`, `deskripsi`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(8, 1, 1, '24/7 Support', 'Makmudin IT', '2023-04-13 16:53:55', NULL, NULL),
(9, 2, 1, 'Advanced Options', 'Makmudin IT', '2023-04-13 16:53:55', NULL, NULL),
(10, 3, 1, '16 GB Storage', 'Makmudin IT', '2023-04-13 16:53:56', NULL, NULL),
(11, 4, 1, 'Unlimited Support', 'Makmudin IT', '2023-04-13 16:53:56', NULL, NULL),
(12, 1, 2, '24/7 Support', 'Makmudin IT', '2023-04-13 16:55:12', NULL, NULL),
(13, 2, 2, 'Advanced Options', 'Makmudin IT', '2023-04-13 16:55:12', NULL, NULL),
(14, 3, 2, '16 GB Storage', 'Makmudin IT', '2023-04-13 16:55:12', NULL, NULL),
(15, 4, 2, 'Unlimited Support', 'Makmudin IT', '2023-04-13 16:55:12', NULL, NULL),
(16, 5, 2, 'Guarantee', 'Makmudin IT', '2023-04-13 16:55:12', NULL, NULL),
(17, 1, 3, '24/7 Support', 'Makmudin IT', '2023-04-13 16:56:29', NULL, NULL),
(18, 2, 3, 'Advanced Options', 'Makmudin IT', '2023-04-13 16:56:29', NULL, NULL),
(19, 3, 3, '16 GB Storage', 'Makmudin IT', '2023-04-13 16:56:29', NULL, NULL),
(20, 4, 3, 'Unlimited Support', 'Makmudin IT', '2023-04-13 16:56:29', NULL, NULL),
(21, 5, 3, 'Guarantee', 'Makmudin IT', '2023-04-13 16:56:29', NULL, NULL),
(22, 6, 3, 'Custome Consultation', 'Makmudin IT', '2023-04-13 16:56:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `price_product`
--

CREATE TABLE `price_product` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `keterangan` varchar(300) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `price_product`
--

INSERT INTO `price_product` (`id`, `judul`, `keterangan`, `harga`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(1, 'BASIC', 'Designed for businesses with standard health requirements', 700000, NULL, '2023-02-28 22:07:28', 'Makmudin IT', '2023-04-13 16:53:55'),
(2, 'STANDARD', 'Designed for businesses with standard health requirements', 900000, NULL, '2023-02-28 22:07:28', 'Makmudin IT', '2023-04-13 16:55:12'),
(3, 'PROFESSIONAL', 'Designed for businesses with standard health requirements\r\n', 1000000, NULL, '2023-02-28 22:07:28', 'Makmudin IT', '2023-04-13 16:56:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `id_product_category` int(11) DEFAULT NULL,
  `flag` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga_jasa` int(50) DEFAULT NULL,
  `photo_url` text DEFAULT NULL,
  `ringkasan` varchar(500) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `id_product_category`, `flag`, `nama`, `harga_jasa`, `photo_url`, `ringkasan`, `deskripsi`, `status`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(1, 2, 'Highlight', 'Mesin Press', 789525, 'https://acta.co.id/assets-cms/img/product/4%20%281%29.jpg', 'Ringkasan', '<p>Deskripsi</p>', 1, 'Makmudin IT', '2023-04-17 16:51:42', NULL, NULL),
(2, 2, 'Highlight', 'Jig Welding', 100000, 'https://acta.co.id/assets-cms/img/product/4%20%281%29.jpg', 'Ringkasan', '<p>Deskripsi .</p>', 1, 'Makmudin IT', '2023-04-17 16:51:05', NULL, NULL),
(3, 2, 'Highlight', 'Locator Clam', 145000, 'https://acta.co.id/assets-cms/img/product/4%20%281%29.jpg', 'Ringkasan', 'Deskripsi', 1, 'Makmudin IT', '2023-04-17 16:51:28', NULL, NULL),
(5, 2, 'Highlight', 'Jig Welding 2', 15000, 'https://acta.co.id/assets-cms/img/product/4%20%281%29.jpg', 'Ringkasan', '<p>Deskripsi .</p>', 1, 'Makmudin IT', '2023-04-17 16:51:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `photo_url` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_category`
--

INSERT INTO `product_category` (`id`, `kode`, `nama`, `photo_url`, `status`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(2, 'M4QK4', 'Fabrikasi Update', 'http://localhost:8080/assets-cms/img/product/images.jpeg', 1, 'Makmudin', '2023-04-01 22:49:22', 'Makmudin', '2023-04-02 09:47:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_gallery`
--

CREATE TABLE `product_gallery` (
  `id` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `photo_url` text DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `caption` varchar(500) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` int(11) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_gallery`
--

INSERT INTO `product_gallery` (`id`, `id_product`, `photo_url`, `title`, `caption`, `status`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(1, 2, 'https://acta.co.id/assets-cms/img/gallery/fc.png', 'tes', 'tessss', 1, 0, '2023-04-14 23:29:17', 0, '2023-04-14 23:39:10'),
(2, 2, 'https://acta.co.id/assets-cms/img/gallery/bw.png', 'we', 's', 1, 0, '2023-04-14 23:37:39', 0, '2023-04-14 23:39:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id` int(11) NOT NULL,
  `caption` varchar(500) DEFAULT NULL,
  `photo_url` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `photo_url` text DEFAULT NULL,
  `title_normal` varchar(100) DEFAULT NULL,
  `title_bold` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(50) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id`, `no_urut`, `photo_url`, `title_normal`, `title_bold`, `keterangan`, `status`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(2, 1, 'https://acta.co.id/assets-cms/slider/Certified-CAD-Engineer-1024x472-Manufacturing-Infrastructure-Industry-Outreach.jpg', 'PT. ASTRINDO CIPTA TEKNIKATAMA ', 'ACTA', 'Design &amp; Manufaktur Jig Maker terbaik di Indonesia', 1, 'Makmudin', '2023-02-10 22:01:57', 'Makmudin trd', '2023-04-02 22:19:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `photo_url` text DEFAULT NULL,
  `youtube_url` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama`, `title`, `deskripsi`, `photo_url`, `youtube_url`, `status`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(1, 'Pusal Enum', 'UMKM', '                                Everything melancholy uncommonly but solicitude inhabiting projection off. Connection stimulated estimating long. departure ourselves very extreme.', 'https://acta.co.id/assets-cms/img/testimoni/Sample-image-Lena-image-size-512-512-pixels-clustered-by-the-original-SLIC-middle.png', '', 1, 'Makmudin', '2023-02-11 10:02:20', 'Makmudin IT', '2023-04-13 11:47:04'),
(2, 'Makmudin', 'PT Karya Mulya Bersama', 'Everything melancholy uncommonly but solicitude inhabiting projection off. Connection stimulated estimating long. departure ourselves very extreme.', 'https://acta.co.id/assets-cms/img/testimoni/profil-acta.png', NULL, 1, 'Makmudin', '2023-02-11 10:09:16', 'Makmudin IT', '2023-04-17 16:37:52'),
(3, 'Mardina Arsita', 'PT Teknik Berkarya', 'Everything melancholy uncommonly but solicitude inhabiting projection off. Connection stimulated estimating long. departure ourselves very extreme.', 'https://acta.co.id/assets-cms/img/testimoni/Waskita_Karya.svg.png', '', 1, 'Makmudin', '2023-02-16 08:25:22', 'Makmudin IT', '2023-04-17 16:48:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `photo_url` text DEFAULT NULL,
  `role` enum('ADMIN','SUPERADMIN','','') DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` varchar(200) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `edit_user` varchar(200) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `photo_url`, `role`, `status`, `create_user`, `create_date`, `edit_user`, `edit_date`, `last_login`) VALUES
(4, 'Makmudin IT', '$2y$10$7PXaNSL8BzTv6JwngmfYxOL22IAyRjVxZ6SvJb1vt1iEP1UZ6Uw86', 'makmudin@gmail.com', 'https://acta.co.id/assets-cms/img/user/profil-acta.PNG', 'SUPERADMIN', 1, 'Makmudin IT', '2022-04-08 07:38:42', 'admin:Makmudin IT', '2023-04-17 16:30:08', '2023-05-02 11:26:48'),
(21, 'admin', '$2y$10$WWqAsIFEtKbh8Xm7nrhmau7MQAoipGVKQgZsPUnMy1ufT/g6GZ9di', 'admin@acta.co.id', 'https://acta.co.id/assets-cms/img/user/cover.png', 'SUPERADMIN', 1, 'Makmudin IT', '2023-04-17 16:25:32', NULL, NULL, '2023-05-02 11:27:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visimisi`
--

CREATE TABLE `visimisi` (
  `id` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` enum('VISI','MISI') DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_user` varchar(100) DEFAULT NULL,
  `creat_date` datetime NOT NULL DEFAULT current_timestamp(),
  `edit_user` varchar(100) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `visimisi`
--

INSERT INTO `visimisi` (`id`, `deskripsi`, `kategori`, `status`, `create_user`, `creat_date`, `edit_user`, `edit_date`) VALUES
(2, 'Memiliki Sumber Daya Manusia yang berpengalaman di bidang Design &amp; Manufactur / Fabrikasi &amp; Machining  Jig &amp; Fixture', 'MISI', 1, NULL, '2021-12-21 13:37:27', NULL, NULL),
(3, 'Pendidikan/ Pelatihan dan Perbaikan yang berkelanjutan', 'MISI', 1, NULL, '2021-12-21 13:37:43', NULL, NULL),
(4, 'Update perkembangan &amp; penggunaan teknologi dalam aplikasi', 'MISI', 1, NULL, '2021-12-21 13:38:06', NULL, NULL),
(8, 'Menjadi Design &amp; Manufaktur Jig Maker terbaik di Indonesia', 'VISI', 1, NULL, '2022-09-27 18:33:02', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `blog` ADD FULLTEXT KEY `index_berita` (`judul`,`konten`);

--
-- Indeks untuk tabel `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD PRIMARY KEY (`tag_id`,`blog_id`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `portfolio_tag`
--
ALTER TABLE `portfolio_tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indeks untuk tabel `price_feature`
--
ALTER TABLE `price_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `price_product`
--
ALTER TABLE `price_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_gallery`
--
ALTER TABLE `product_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `visimisi`
--
ALTER TABLE `visimisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `blog_tag`
--
ALTER TABLE `blog_tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT untuk tabel `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `portfolio_tag`
--
ALTER TABLE `portfolio_tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `price_feature`
--
ALTER TABLE `price_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `price_product`
--
ALTER TABLE `price_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product_gallery`
--
ALTER TABLE `product_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `visimisi`
--
ALTER TABLE `visimisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
