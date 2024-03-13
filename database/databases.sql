/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.32-MariaDB : Database - duluin_backend_landingpage
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `activity_log` */

CREATE DATABASE duluin_backend_landingpage;

USE duluin_backend_landingpage;
DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) NOT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` char(36) NOT NULL,
  `causer_type` varchar(255) NOT NULL,
  `causer_id` char(36) NOT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activity_log` */

/*Table structure for table `applicants` */

DROP TABLE IF EXISTS `applicants`;

CREATE TABLE `applicants` (
  `id` char(36) NOT NULL,
  `career_id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `birthday_date` date DEFAULT NULL,
  `graduated` enum('S2','S1','D4','D3','SMA') DEFAULT NULL,
  `gender` enum('pria','wanita') DEFAULT NULL,
  `status` enum('waiting','replied') NOT NULL,
  `document` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applicant_career` (`career_id`),
  CONSTRAINT `applicant_career` FOREIGN KEY (`career_id`) REFERENCES `careers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `applicants` */

insert  into `applicants`(`id`,`career_id`,`name`,`email`,`phone`,`address`,`birthday_date`,`graduated`,`gender`,`status`,`document`,`created_at`,`updated_at`) values 
('a5b4b766-b16d-11ee-8119-985fd348d6f9','464de444-4c42-40de-ba36-2c71588d5111','Ardi mahendra','ardiandra45@gmail.com','085769306099','Bandar lampung','1995-01-01','S1','pria','replied','test.pdf','2024-01-16 02:44:44','2024-01-16 02:44:44'),
('bfe988e0-d822-4f98-a213-326f75836309','464de444-4c42-40de-ba36-2c71588d5111','Andra','ardiandra45@gmail.com','085769306099','asd','2024-01-23','D3','pria','waiting','QusrF4eBIRl3iO8JH9jrfvECekm9zndyZrzCMFD1.pdf','2024-01-22 19:08:09','2024-01-22 19:08:09'),
('ea828765-92b8-49e7-876f-f6743af4a7cd','464de444-4c42-40de-ba36-2c71588d5111','Andra','ardiandra45@gmail.com','085769306099','asd','2024-01-22','SMA','pria','waiting','CkyltIb8SPJktj4ZxBvxHtQ1KhW8qReogORAwOGG.pdf','2024-01-22 15:34:04','2024-01-22 15:34:04');

/*Table structure for table `articles` */

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` char(36) NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `headline` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `embed` varchar(500) DEFAULT NULL,
  `caption` varchar(225) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `viewer` int(10) NOT NULL DEFAULT 0,
  `status` enum('draft','waiting','publish','unpublish') DEFAULT NULL,
  `push_notif` tinyint(1) NOT NULL DEFAULT 0,
  `parent` varchar(36) DEFAULT NULL,
  `publish_by` varchar(36) DEFAULT NULL,
  `created_by` varchar(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_category` (`category_id`),
  KEY `article_creator` (`created_by`),
  KEY `article_publisher` (`publish_by`),
  CONSTRAINT `article_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `article_creator` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `article_publisher` FOREIGN KEY (`publish_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `articles` */

insert  into `articles`(`id`,`category_id`,`title`,`headline`,`slug`,`tags`,`content`,`keyword`,`description`,`img`,`embed`,`caption`,`date`,`viewer`,`status`,`push_notif`,`parent`,`publish_by`,`created_by`,`created_at`,`updated_at`) values 
('34e74afa-e729-4a4f-a896-25931dd99159',1,'Ekonomi Indonesia Mulai Perlahan Pulih Tahun 2024',0,'ekonomi-indonesia-mulai-perlahan-pulih-tahun-2024','Ekonomi','<p><br></p><p><span style=\"color: rgb(12, 13, 14); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI Adjusted&quot;, &quot;Segoe UI&quot;, &quot;Liberation Sans&quot;, sans-serif; font-size: 15px;\">After much searching, I realized that such a function does not exist (at least until the time of writing this message). I defined a function in the helper that returns the address of the thumbnail from the URL of the original image. The reader should note that these definitions may differ based on the setting of parameters for another person.</span></p><p><span style=\"color: rgb(12, 13, 14); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI Adjusted&quot;, &quot;Segoe UI&quot;, &quot;Liberation Sans&quot;, sans-serif; font-size: 15px;\"><br></span><br></p>','testing, test','testing artikel','http://localhost/bloglh/public/storage/photos/a00e00fd-a657-11ee-9c11-985fd348d6f9/65ae69831e4f8.jpg',NULL,NULL,'2024-01-22',2,'publish',0,NULL,'a00e00fd-a657-11ee-9c11-985fd348d6f9','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-22 13:01:41','2024-02-13 03:36:43'),
('3a4d6886-a8a3-4d0e-8b17-54878d2c9c62',1,'Testing Artikel Lahan Sikam Ke Satu',0,'testing-artikel-lahan-sikam-ke-satu','Bisnis,Ekonomi','<p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br>How can i change the width of the CKEditor 5?</p><p>I found how to change the height (see below) but unfortunately this trick doesn\'t work for the width because it only changes the width of the textarea (the toolbox stays at the original width).</p>',NULL,NULL,'http://localhost/bloglh/public/storage/photos/a00e00fd-a657-11ee-9c11-985fd348d6f9/65ae69831e4f8.jpg',NULL,NULL,'2024-01-09',1,'publish',0,NULL,'a00e00fd-a657-11ee-9c11-985fd348d6f9','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-09 14:28:16','2024-02-13 03:18:53'),
('3a4d6886-a8a3-4d0e-8b17-54878d2c9c65',1,'Testing Artikel Lahan Sikam Dua',0,'testing-artikel-lahan-sikam-dua','Bisnis','<p><br></p><p><br></p><p><br></p><p><br>How can i change the width of the CKEditor 5?</p><p>I found how to change the height (see below) but unfortunately this trick doesn\'t work for the width because it only changes the width of the textarea (the toolbox stays at the original width).</p>',NULL,NULL,'http://localhost/bloglh/public/storage/photos/a00e00fd-a657-11ee-9c11-985fd348d6f9/65ae69831e4f8.jpg',NULL,NULL,'2024-01-09',0,'publish',0,NULL,'a00e00fd-a657-11ee-9c11-985fd348d6f9','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-18 14:28:16','2024-01-22 13:13:46'),
('abd10960-89ab-4086-b5b6-ce81f0c90a2f',4,'Cara UMKM Bersaing dengan Produk Impor',0,'cara-umkm-bersaing-dengan-produk-impor','Bisnis,Ekonomi','<p><span style=\"text-align: justify; background-color: var(--card-bg); font-size: var(--body-font-size); font-weight: var(--body-font-weight);\">Usaha Mikro, Kecil, dan Menengah\r\n(UMKM) merupakan tulang punggung perekonomian Indonesia. UMKM berkontribusi\r\nsebesar 61,07% terhadap Produk Domestik Bruto (PDB) Indonesia. Namun, UMKM juga\r\nmenghadapi tantangan yang cukup berat, salah satunya adalah persaingan dengan\r\nproduk impor. Produk impor seringkali memiliki keunggulan dari segi kualitas,\r\nharga, dan ketersediaan. Hal ini membuat UMKM kesulitan untuk bersaing dan\r\nakhirnya terdesak dari pasar.</span><br></p><p class=\"MsoNormal\" style=\"text-align:justify\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\">Oleh karena itu, UMKM perlu\r\nmelakukan berbagai upaya untuk dapat bersaing dengan produk impor. Berikut ini\r\nadalah beberapa cara yang dapat dilakukan oleh UMKM:<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\"><b>Menaikkan kualitas produk<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"text-align:justify\">Salah satu cara terbaik untuk\r\nbersaing dengan produk impor adalah dengan meningkatkan kualitas produk. UMKM\r\nperlu memperhatikan kualitas bahan baku, proses produksi, dan kemasan produk.\r\nUMKM juga perlu melakukan inovasi dan pengembangan produk secara berkelanjutan.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\">Dalam meningkatkan kualitas\r\nproduk, UMKM perlu memperhatikan hal-hal berikut:<o:p></o:p></p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l2 level1 lfo1;\r\n     tab-stops:list .5in\"><b>Kualitas bahan\r\n     baku</b></li></ul><p class=\"MsoNormal\" style=\"text-align:justify\">Bahan baku merupakan salah satu\r\nfaktor yang menentukan kualitas produk. UMKM perlu menggunakan bahan baku yang\r\nberkualitas dan aman untuk dikonsumsi.<o:p></o:p></p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l4 level1 lfo2;\r\n     tab-stops:list .5in\"><b>Proses\r\n     produksi</b></li></ul><p class=\"MsoNormal\" style=\"text-align:justify\">Proses produksi yang baik akan\r\nmenghasilkan produk yang berkualitas. UMKM perlu menerapkan proses produksi\r\nyang higienis dan mengikuti standar yang berlaku.</p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l1 level1 lfo3;\r\n     tab-stops:list .5in\"><b>Kemasan produk</b></li></ul><p class=\"MsoNormal\" style=\"text-align:justify\">Kemasan produk juga dapat\r\nmempengaruhi kualitas produk. Kemasan yang baik akan melindungi produk dari\r\nkerusakan dan membuat produk terlihat lebih menarik.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\"><b>Menawarkan harga yang kompetitif<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"text-align:justify\">Harga merupakan salah satu faktor\r\nyang penting dalam persaingan pasar. UMKM perlu menawarkan harga yang\r\nkompetitif dengan produk impor. UMKM dapat melakukan berbagai cara untuk\r\nmenekan biaya produksi, seperti dengan memanfaatkan bahan baku lokal dan sumber\r\ndaya alam yang tersedia.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\">Ada beberapa cara yang dapat\r\ndilakukan oleh UMKM untuk menekan biaya produksi, antara lain:<o:p></o:p></p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo4;\r\n     tab-stops:list .5in\"><b>Memanfaatkan bahan baku lokal</b></li></ul><p class=\"MsoNormal\" style=\"text-align:justify\">Bahan baku lokal biasanya\r\nmemiliki harga yang lebih terjangkau dibandingkan dengan bahan baku impor.<o:p></o:p></p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l5 level1 lfo5;\r\n     tab-stops:list .5in\"><b>Meningkatkan\r\n     efisiensi produksi</b></li></ul><p class=\"MsoNormal\" style=\"text-align:justify\">UMKM perlu melakukan efisiensi\r\nproduksi untuk menekan biaya produksi. Hal ini dapat dilakukan dengan\r\nmenggunakan mesin dan peralatan yang lebih modern.<o:p></o:p></p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l3 level1 lfo6;\r\n     tab-stops:list .5in\"><b>Memanfaatkan\r\n     sumber daya alam yang tersedia</b></li></ul><p class=\"MsoNormal\" style=\"text-align:justify\">UMKM dapat memanfaatkan sumber\r\ndaya alam yang tersedia di daerahnya untuk menekan biaya produksi.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\"><b>Membuat keunikan produk<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"text-align:justify\">UMKM juga perlu membuat keunikan\r\nproduk untuk dapat bersaing dengan produk impor. Keunikan produk dapat berupa\r\ndesain, bahan baku, fungsi, atau manfaat yang ditawarkan. UMKM dapat melakukan\r\nriset pasar untuk mengetahui kebutuhan dan keinginan konsumen.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\">UMKM dapat melakukan riset pasar\r\nuntuk mengetahui kebutuhan dan keinginan konsumen. Hal ini dapat membantu UMKM\r\nuntuk menciptakan produk yang unik dan sesuai dengan kebutuhan konsumen.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\"><b>Mempromosikan produk<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"text-align:justify\">Promosi merupakan salah satu cara\r\nuntuk memperkenalkan produk UMKM kepada konsumen. UMKM perlu memanfaatkan\r\nberbagai media promosi, baik offline maupun online. UMKM juga perlu membuat\r\nkonten promosi yang menarik dan informatif.<o:p></o:p></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"text-align:justify\">Dalam promosi produk, UMKM perlu\r\nmembuat konten promosi yang menarik dan informatif. Konten promosi yang menarik\r\nakan dapat menarik perhatian konsumen dan membuat mereka tertarik untuk membeli\r\nproduk. Dengan menerapkan keempat cara di atas, UMKM dapat meningkatkan daya\r\nsaingnya dan bersaing dengan produk impor.<o:p></o:p></p>','UMKM, perekonomian, Indonesia, usaha','UMKM sebagai tulang punggung perekonomian Indonesia','http://localhost/bloglh/public/storage/photos/a00e00fd-a657-11ee-9c11-985fd348d6f9/65b87dc9ed867.png',NULL,'ilustrasi','2024-01-30',8,'publish',0,NULL,'a00e00fd-a657-11ee-9c11-985fd348d6f9','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-30 04:40:52','2024-02-23 07:52:26'),
('f0ae881a-e324-4155-83bb-9293327a6125',4,'4 Cara Tetap Semangat Berbisnis untuk Pelaku UMKM',0,'4-cara-tetap-semangat-berbisnis-untuk-pelaku-umkm','Bisnis,Ekonomi','<p><span style=\"text-align: justify; background-color: var(--card-bg); font-size: var(--body-font-size); font-weight: var(--body-font-weight);\">Berbisnis tidaklah mudah. Ada\r\nbanyak tantangan yang harus dihadapi, seperti persaingan yang ketat, hambatan\r\nyang tak terduga, dan berbagai macam rintangan lainnya. Namun, jika kamu\r\nmemiliki semangat yang tinggi, semua tantangan itu bisa diatasi.</span><br></p><p class=\"MsoNormal\" style=\"text-align:justify\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\">Berikut ini adalah 4 cara yang\r\nbisa kamu lakukan untuk tetap semangat berbisnis:<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\"><b>1. Menemukan inspirasi baru<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"text-align:justify\">Inspirasi bisa datang dari mana\r\nsaja, bisa dari orang lain, pengalaman, atau bahkan dari diri sendiri. Saat\r\nkamu merasa bosan atau lelah, cobalah untuk mencari inspirasi baru. Hal ini\r\nakan membantu kamu untuk tetap termotivasi dan semangat berbisnis.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\">Berikut ini adalah beberapa cara\r\nuntuk menemukan inspirasi baru:<o:p></o:p></p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l1 level1 lfo1;\r\n     tab-stops:list .5in\">Baca buku atau artikel tentang bisnis<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l1 level1 lfo1;\r\n     tab-stops:list .5in\">Ikuti seminar atau pelatihan bisnis<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l1 level1 lfo1;\r\n     tab-stops:list .5in\">Berkunjung ke pameran bisnis<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l1 level1 lfo1;\r\n     tab-stops:list .5in\">Berbicara dengan pengusaha sukses<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l1 level1 lfo1;\r\n     tab-stops:list .5in\">Luangkan waktu untuk merenung<o:p></o:p></li>\r\n</ul><p><br></p><p class=\"MsoNormal\" style=\"text-align:justify\">Saat kamu menemukan inspirasi\r\nbaru, jangan lupa untuk mencatatnya. Hal ini akan membantu kamu untuk\r\nmengingatnya dan menerapkannya dalam bisnismu.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\"><b>2. Berpikir positif saat menghadapi hambatan<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"text-align:justify\">Hambatan adalah hal yang wajar\r\ndalam berbisnis. Jika kamu menghadapi hambatan, jangan langsung menyerah.\r\nCobalah untuk berpikir positif dan mencari solusi untuk mengatasinya. Dengan\r\nberpikir positif, kamu akan lebih mudah untuk menemukan solusi dan mengatasi hambatan\r\ntersebut.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\">Berikut ini adalah beberapa tips\r\nuntuk berpikir positif saat menghadapi hambatan:<o:p></o:p></p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l3 level1 lfo2;\r\n     tab-stops:list .5in\">Fokus pada solusi, bukan pada masalah<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l3 level1 lfo2;\r\n     tab-stops:list .5in\">Percaya diri bahwa kamu bisa mengatasi hambatan\r\n     tersebut<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l3 level1 lfo2;\r\n     tab-stops:list .5in\">Belajar dari kesalahan<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l3 level1 lfo2;\r\n     tab-stops:list .5in\">Dukung diri sendiri<o:p></o:p></li>\r\n</ul><p><br></p><p class=\"MsoNormal\" style=\"text-align:justify\">Saat kamu berhasil mengatasi\r\nhambatan, jangan lupa untuk merayakannya. Hal ini akan membantu kamu untuk\r\ntetap termotivasi dan semangat untuk terus maju.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\"><b>3. Luangkan waktu untuk diri sendiri<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"text-align:justify\">Berbisnis bisa menjadi sangat\r\nmelelahkan. Untuk menjaga semangat, penting untuk meluangkan waktu untuk diri\r\nsendiri. Luangkan waktu untuk melakukan hal-hal yang kamu sukai, seperti\r\nberkumpul dengan keluarga dan teman, berlibur, atau sekadar bersantai. Hal ini\r\nakan membantu kamu untuk melepas penat dan kembali bersemangat untuk berbisnis.\r\n<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\">Berikut ini adalah beberapa tips\r\nuntuk meluangkan waktu untuk diri sendiri:<o:p></o:p></p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo3;\r\n     tab-stops:list .5in\">Buat jadwal khusus untuk diri sendiri<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo3;\r\n     tab-stops:list .5in\">Katakan tidak pada komitmen yang tidak penting<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo3;\r\n     tab-stops:list .5in\">Bersikaplah tegas dengan diri sendiri<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo3;\r\n     tab-stops:list .5in\">Nikmati waktumu sendiri<o:p></o:p></li>\r\n</ul><p><br></p><p class=\"MsoNormal\" style=\"text-align:justify\">Saat kamu meluangkan waktu untuk\r\ndiri sendiri, kamu akan merasa lebih segar dan bersemangat untuk berbisnis.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\"><b>4. Memberi reward pada diri sendiri<o:p></o:p></b></p><p class=\"MsoNormal\" style=\"text-align:justify\">Saat kamu berhasil mencapai\r\ntujuan, jangan lupa untuk memberikan reward pada diri sendiri. Hal ini akan\r\nmembantu kamu untuk merasa puas dan termotivasi untuk mencapai tujuan\r\nselanjutnya.<o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align:justify\">Berikut ini adalah beberapa tips\r\nuntuk memberikan reward pada diri sendiri:<o:p></o:p></p><ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l2 level1 lfo4;\r\n     tab-stops:list .5in\">Reward yang diberikan harus sesuai dengan pencapaian<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l2 level1 lfo4;\r\n     tab-stops:list .5in\">Reward yang diberikan harus bermanfaat<o:p></o:p></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l2 level1 lfo4;\r\n     tab-stops:list .5in\">Reward yang diberikan harus menyenangkan<o:p></o:p></li>\r\n</ul><p><br></p><p class=\"MsoNormal\" style=\"text-align:justify\">Saat kamu memberikan reward pada\r\ndiri sendiri, kamu akan merasa lebih termotivasi untuk mencapai tujuan yang\r\nlebih besar.<o:p></o:p></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"text-align:justify\">Dengan menerapkan 4 cara di atas,\r\nkamu bisa tetap semangat berbisnis dan mencapai kesuksesan. Tetap semangat dan\r\njangan pernah menyerah!<o:p></o:p></p>',NULL,NULL,'http://localhost/bloglh/public/storage/photos/a00e00fd-a657-11ee-9c11-985fd348d6f9/65bb4b07c1a8d.jpg',NULL,NULL,'2024-01-22',5,'publish',0,NULL,'a00e00fd-a657-11ee-9c11-985fd348d6f9','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-22 13:19:58','2024-02-07 08:26:29');

/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` char(36) NOT NULL,
  `position` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('publish','unpublish') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `banners` */

insert  into `banners`(`id`,`position`,`link`,`img`,`description`,`status`,`created_at`,`updated_at`) values 
('5e03b7e6-797a-4b0f-b273-8cf55a7781d7','slider',NULL,'slider-1706689738.png',NULL,'publish','2024-01-10 07:12:57','2024-01-31 08:28:58'),
('afbc1e13-e821-4b38-a53b-cc28b9419262','slider',NULL,'slider-1706689105.png',NULL,'publish','2024-01-10 14:29:43','2024-01-31 08:18:25'),
('d6982425-809f-4185-aac9-d58f33420b87','slider',NULL,'slider-1706689707.png',NULL,'publish','2024-01-10 14:29:32','2024-01-31 08:28:28');

/*Table structure for table `careers` */

DROP TABLE IF EXISTS `careers`;

CREATE TABLE `careers` (
  `id` char(36) NOT NULL,
  `position` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('penuh_waktu','purna_waktu','magang') DEFAULT NULL,
  `experience` enum('magang','tingkat_pemula','senior','eksekutif') DEFAULT NULL,
  `img` varchar(225) DEFAULT NULL,
  `status` enum('publish','unpublish') DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `careers` */

insert  into `careers`(`id`,`position`,`slug`,`description`,`type`,`experience`,`img`,`status`,`expired_at`,`created_at`,`updated_at`) values 
('464de444-4c42-40de-ba36-2c71588d5111','Marketing Analyst','marketing-analyst','<p><br></p><div itemprop=\"description\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\"><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px;\">Saat ini kami sedang membutuhkan Staff Marketing &amp; Sales dengan deskripsi pekerjaan sbb:<br>â€“ Dapat bekerja dalam memasarkan produk baik secara offline ataupun online<br>â€“ Membantu dalam pengembangan social media perusahaan<br>â€“ Mampu berkomunikasi aktif dengan customer</p></div><h2 class=\"h4\" style=\"font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 1.1; color: rgb(102, 102, 102); margin-top: 12px; margin-bottom: 12px; font-size: 18px; letter-spacing: 0.1px;\">Tanggung Jawab Pekerjaan :</h2><div itemprop=\"responsibilities\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\"><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px;\">â€“ Menangani Customer dari penawaran harga, negosiasi harga sampai dengan Proses PO Customer.<br>â€“ Menjawab setiap pesan atau comment di wa ataupun di medsos<br>â€“ Membuat Laporan penjualan harian<br>â€“ Membuat konten-konten yang bermanfaat dalam memasarkan produk</p></div><h2 class=\"h4\" style=\"font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 1.1; color: rgb(102, 102, 102); margin-top: 12px; margin-bottom: 12px; font-size: 18px; letter-spacing: 0.1px;\">Keahlian :</h2><div itemprop=\"skills\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\"><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px;\">â€“ Menguasai Microsoft Office<br>â€“ Menguasai Social Media<br>â€“ Mampu berkomunikasi dengan baik</p></div><h2 class=\"h4\" style=\"font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 1.1; color: rgb(102, 102, 102); margin-top: 12px; margin-bottom: 12px; font-size: 18px; letter-spacing: 0.1px;\">Kualifikasi :</h2><div itemprop=\"qualifications\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\"><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px;\">Wanita<br>Pendidikan minimal SMA<br>Pengalaman minimal 1 tahun<br>Domisili Tangerang</p></div><h2 class=\"h4\" style=\"font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 1.1; color: rgb(102, 102, 102); margin-top: 12px; margin-bottom: 12px; font-size: 18px; letter-spacing: 0.1px;\">Waktu Bekerja :</h2><div itemprop=\"workHours\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\">Jam 09.00 s/d 17.00 (Senin-Jumat)</div>','penuh_waktu','magang','http://localhost/bloglh/public/storage/photos/a00e00fd-a657-11ee-9c11-985fd348d6f9/65b0094661b3d.jpg','publish','2024-01-15 00:00:00','2024-01-15 15:34:12','2024-01-23 18:45:35'),
('464de444-4c42-40de-ba36-2c71588d5112','Junior Programmer','junior-programmer','<p><br></p><p><br></p><div itemprop=\"description\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\"><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px;\">Saat ini kami sedang membutuhkan Staff Marketing &amp; Sales dengan deskripsi pekerjaan sbb:<br>â€“ Dapat bekerja dalam memasarkan produk baik secara offline ataupun online<br>â€“ Membantu dalam pengembangan social media perusahaan<br>â€“ Mampu berkomunikasi aktif dengan customer</p></div><h2 class=\"h4\" style=\"font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 1.1; color: rgb(102, 102, 102); margin-top: 12px; margin-bottom: 12px; font-size: 18px; letter-spacing: 0.1px;\">Tanggung Jawab Pekerjaan :</h2><div itemprop=\"responsibilities\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\"><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px;\">â€“ Menangani Customer dari penawaran harga, negosiasi harga sampai dengan Proses PO Customer.<br>â€“ Menjawab setiap pesan atau comment di wa ataupun di medsos<br>â€“ Membuat Laporan penjualan harian<br>â€“ Membuat konten-konten yang bermanfaat dalam memasarkan produk</p></div><h2 class=\"h4\" style=\"font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 1.1; color: rgb(102, 102, 102); margin-top: 12px; margin-bottom: 12px; font-size: 18px; letter-spacing: 0.1px;\">Keahlian :</h2><div itemprop=\"skills\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\"><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px;\">â€“ Menguasai Microsoft Office<br>â€“ Menguasai Social Media<br>â€“ Mampu berkomunikasi dengan baik</p></div><h2 class=\"h4\" style=\"font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 1.1; color: rgb(102, 102, 102); margin-top: 12px; margin-bottom: 12px; font-size: 18px; letter-spacing: 0.1px;\">Kualifikasi :</h2><div itemprop=\"qualifications\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\"><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px;\">Wanita<br>Pendidikan minimal SMA<br>Pengalaman minimal 1 tahun<br>Domisili Tangerang</p></div><h2 class=\"h4\" style=\"font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; line-height: 1.1; color: rgb(102, 102, 102); margin-top: 12px; margin-bottom: 12px; font-size: 18px; letter-spacing: 0.1px;\">Waktu Bekerja :</h2><div itemprop=\"workHours\" style=\"color: rgb(102, 102, 102); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px; letter-spacing: 0.1px;\">Jam 09.00 s/d 17.00 (Senin-Jumat)</div>','penuh_waktu','magang','http://localhost/bloglh/public/storage/photos/a00e00fd-a657-11ee-9c11-985fd348d6f9/65b00aa1d265f.png','publish','2024-01-15 00:00:00','2024-01-15 15:34:12','2024-01-23 18:51:27');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(225) DEFAULT NULL,
  `status` enum('publish','unpublish') DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`slug`,`status`,`created_by`,`created_at`,`updated_at`) values 
(1,'Ekonomi','ekonomi','publish','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-09 14:25:41','2024-01-09 14:25:41'),
(3,'Keuangan','keuangan','publish','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-10 14:26:40','2024-01-10 14:26:40'),
(4,'Tips Usaha',NULL,'publish','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-30 04:20:57','2024-01-30 04:21:46');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(6,'2014_10_12_000000_create_users_table',2),
(7,'2019_12_14_000001_create_personal_access_tokens_table',2),
(8,'2023_10_31_040444_create_permission_tables',2),
(9,'2024_01_08_021235_create_activity_log_table',3),
(10,'2024_01_08_021236_add_event_column_to_activity_log_table',3),
(11,'2024_01_08_021237_add_batch_uuid_column_to_activity_log_table',3),
(12,'2024_01_08_030411_create_tags_table',4),
(13,'2024_01_08_031028_create_categories_table',4),
(15,'2024_01_08_070854_create_articles_table',5),
(16,'2024_01_10_020022_create_pages_table',6),
(17,'2024_01_10_040055_create_banners_table',7),
(18,'2024_01_11_015658_create_careers_table',8),
(19,'2024_01_15_163804_create_applicants_table',9);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` char(36) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_uuid` char(36) NOT NULL,
  PRIMARY KEY (`permission_id`,`model_uuid`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_uuid`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` char(36) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_uuid` char(36) NOT NULL,
  PRIMARY KEY (`role_id`,`model_uuid`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_uuid`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_uuid`) values 
('d3782c30-46c3-4a0e-81a6-d10513642db9','App\\Models\\User','a00e00fd-a657-11ee-9c11-985fd348d6f9');

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` char(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('publish','unpublish') DEFAULT NULL,
  `created_by` varchar(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pages` */

insert  into `pages`(`id`,`title`,`slug`,`content`,`keyword`,`description`,`status`,`created_by`,`created_at`,`updated_at`) values 
('0ca27cbc-5bb6-4ca3-ba6a-ef3aaabf6c0a','testing','testing','<p>testing</p>','testing','testing','publish','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-10 02:44:39','2024-01-10 03:07:09'),
('82939238-7ed4-41df-9464-941d74ca3e29','Kebijakan Privasi','kebijakan-privasi','<div class=\"container\" style=\"margin-top: 29px;\">\r\n        <div class=\"row\">\r\n            <div class=\"col-md-4\" style=\"padding-right:0px;padding-left:20px;\">\r\n                <h1 style=\"font-size: 20px;font-family: Barlow, sans-serif;font-weight: bold;color: rgb(125,130,133);\">A. DEFINISI</h1>\r\n                <ul class=\"text-left\" style=\"font-size: 14px;margin-right: 12px;font-family: Barlow, sans-serif;color: rgb(125,130,133);\">\r\n                    <li><b>\"Pemberi Dana\" </b> atau <b> \"Lender\" </b> merupakan perorangan/badan usaha yang bertindak selaku pemilik modal atau pemberi modal dalam setiap project di website LAHAN SIKAM;</li>\r\n                    <li><b>\"Penerima Danaâ€ </b> atau <b> â€œBorrower\" </b> merupakan perorangan/badan usaha yang bertindak selaku penerima dana untuk digunakan dalam projectnya yang diajukan melalui platform website LAHAN SIKAM;</li>\r\n                    <li><b>\"Data pribadi\" </b> merupakan informasi milik user yang mengidentifikasi keterangan terkait user yang bersangkutan;</li>\r\n                    <li><b>\"Akun\"</b> merupakan identitas unik untuk menyimpan data, profil, dan aktivitas user dalam menggunakan layanan LAHAN SIKAM yang pembuatannya dilakukan dengan mendaftar pada website Lahan Sikam;</li>\r\n                    <li><b>\"Password\"</b> adalah kode rahasia untuk mengakses akun.</li>\r\n                    <li><b>\"Konten\"</b> berarti segala hal yang ada pada layanan Lahan Sikam, termasuk namun tidak terbatas pada rancangan, desain, teks, gambar, foto, gambar, video, perangkat lunak, musik, suara dan file lain, kredit, tarif, biaya, kuotasi, data historis, grafik, statistik, artikel, informasi kontak, setiap informasi lain, beserta pemilihan dan pengaturannya;</li>\r\n                    <li><b>\"User\"</b> merujuk pada pengguna terdaftar di website LAHAN SIKAM;</li>\r\n                    <li><b>\"LAHAN SIKAM\"</b> merujuk pada PT Lampung Berkah Finansial beserta perwakilan dan/atau kuasanya yang sah.</li>\r\n                </ul>\r\n                <h1 style=\"font-size: 20px;font-family: Barlow, sans-serif;font-weight: bold;color: rgb(125,130,133);\">B. PENGUMPULAN INFORMASI</h1>\r\n                <p class=\"text-left\" style=\"font-size: 14px;margin-right: 12px;font-family: Barlow, sans-serif;color: rgb(125,130,133);\">\r\n                    Bagian pengumpulan informasi ini menjelaskan cara LAHAN SIKAM mengumpulkan data dan informasi yang diberikan user kepada LAHAN SIKAM secara sukarela dalam rangka berpartisipasi pada kegiatan yang diselenggarakan oleh LAHAN SIKAM.\r\n                </p>\r\n                <ul class=\"text-left\" style=\"font-size: 14px;margin-right: 12px;font-family: Barlow, sans-serif;color: rgb(125,130,133);\">\r\n                    <li>User LAHAN SIKAM dianggap telah menyetujui bahwa LAHAN SIKAM berhak untuk mengumpulkan, menyimpan, dan menggunakan data pribadi user LAHAN SIKAM.</li>\r\n                    <li>LAHAN SIKAM mengumpulkan data melalui pendaftaran user baik sebagai Lender maupun Borrower berupa informasi di antaranya adalah Nama Lengkap, Kartu Tanda Penduduk Elektronik, Nomor Pokok Wajib Pajak, Alamat Email, Jenis Kelamin, Alamat Tempat Tinggal, Alamat Usaha dan beberapa informasi pendukung lainnya seperti Nomor Rekening atas nama pribadi yang mengajukan dan Kartu Keluarga.</li>\r\n                    <li>User LAHAN SIKAM dianggap telah menyetujui bahwa LAHAN SIKAM dapat menggunakan data user untuk kebutuhan Digital Signature.</li>\r\n                    <li>Secara berkala, LAHAN SIKAM akan meminta konfirmasi data pribadi user</li>\r\n                </ul>\r\n            </div>\r\n\r\n            <div class=\"col-md-4\" style=\"padding-right:0px;padding-left:20px;\">\r\n                <h1 style=\"font-size: 20px;font-family: Barlow, sans-serif;font-weight: bold;color: rgb(125,130,133);\">C. COOKIES</h1>\r\n                <ul class=\"text-left\" style=\"font-size: 14px;margin-right: 12px;font-family: Barlow, sans-serif;color: rgb(125,130,133);\">\r\n                    <li>LAHAN SIKAM menggunakan cookies dalam operasional website yang akan mengenali preferensi penggunaan user pada website secara otomatis. Cookies adalah file berukuran kecil yang secara otomatis mengambil tempat di dalam perangkat komputer user dan berfungsi mengidentifikasi dan memantau koneksi jaringan sehingga user dapat mengakses layanan LAHAN SIKAM secara lebih optimal. Cookies membantu LAHAN SIKAM menelusuri fitur yang paling menarik untuk user dan jenis konten yang pernah dikunjungi sebelumnya sehingga mampu menyesuaikan konten sesuai preferensi user saat user kembali mengunjungi website LAHAN SIKAM. Cookies tidak melakukan pelacakan terhadap informasi user secara individual dan disimpan dalam data terenkripsi sehingga tidak dapat dibaca oleh situs web lain.</li>\r\n                    <li>Walaupun secara setelan semula (default) perangkat komputer user menerima cookies, user bebas untuk melakukan perubahan terhadap setelan tersebut melalui pengaturan browser dengan memilih untuk menolak mengaktifkan cookies dengan konsekuensi berkurangnya fungsi optimal website.</li>\r\n                </ul>\r\n                <h1 style=\"font-size: 20px;font-family: Barlow, sans-serif;font-weight: bold;color: rgb(125,130,133);\">D. KERAHASIAAN DATA</h1>\r\n                <ul class=\"text-left\" style=\"font-size: 14px;margin-right: 12px;font-family: Barlow, sans-serif;color: rgb(125,130,133);\">\r\n                    <li>Setiap data pribadi yang didaftarkan user kepada LAHAN SIKAM sesuai dengan ketentuan Kebijakan Privasi ini akan dilindungi dengan upaya terbaik LAHAN SIKAM melalui perangkat keamanan teruji. Meski demikian, LAHAN SIKAM tidak menjamin kerahasiaan informasi yang diberikan oleh user jika terdapat pihak-pihak lain yang mengambil dan memanfaatkan data pribadi tersebut dari LAHAN SIKAM secara melawan hukum. LAHAN SIKAM terus berupaya sebaik mungkin untuk menghalangi akses ke dalam data pribadi oleh pihak yang tidak berwenang.</li>\r\n                    <li>Setiap user LAHAN SIKAM dianggap telah menyetujui bahwa LAHAN SIKAM berhak untuk menyimpan data pribadi user LAHAN SIKAM.</li>\r\n                    <li>LAHAN SIKAM bertanggung jawab untuk merahasiakan semua data pribadi user dan tidak akan menyalahgunakannya untuk kepentingan pihak tertentu.</li>\r\n                    <li>LAHAN SIKAM akan menyimpan informasi selama akun user aktif.</li>\r\n                    <li>LAHAN SIKAM tidak akan membuka data user kepada siapapun, terkecuali kepada pihak ketiga yang berwenang jika terjadi perbuatan melawan hukum. LAHAN SIKAM dapat diwajibkan oleh peraturan-perundang-undangan yang berlaku untuk membuka data pribadi dan informasi lainnya terkait user kepada pihak ketiga yang berwenang seperti lembaga pemerintah, lembaga kepolisian, dan lembaga pengadilan hanya jika ada surat perintah yang sah dari lembaga-lembaga tersebut.</li>\r\n                    <li>Dalam proses membuka data pribadi user sebagaimana tersebut pada butir sebelumnya, LAHAN SIKAM akan mengkonfirmasi kepada user terlebih dahulu. Apabila dalam 3 hari user tidak dapat mengkonfirmasi, maka user dianggap menyetujui tindakan tersebut.</li>\r\n                    <li>Kata sandi atau password termasuk kata sandi user merupakan tanggung jawab masing-masing user. LAHAN SIKAM tidak bertanggung jawab atas kerugian yang ditimbulkan akibat kelalaian user dalam menjaga kerahasiaan kata sandi.</li>\r\n                    <li>Jika user mengikuti salah satu tautan web yang terdapat pada situs web ini, LAHAN SIKAM tidak mengemban tanggung jawab dalam bentuk apapun atas ketentuan-ketentuan maupun jaminan-jaminan yang terdapat dalam kebijakan privasi pada situs web tersebut yang berbeda dengan kebijakan privasi LAHAN SIKAM.</li>\r\n                </ul>\r\n            </div>\r\n            <div class=\"col-md-4\" style=\"padding-right:0px;padding-left:20px;\">\r\n                <h1 style=\"font-size: 20px;font-family: Barlow, sans-serif;font-weight: bold;color: rgb(125,130,133);\">E. PENGGUNAAN DATA</h1>\r\n                <p class=\"text-left\" style=\"font-size: 14px;margin-right: 12px;font-family: Barlow, sans-serif;color: rgb(125,130,133);\">Dengan mendaftar, user dianggap setuju bahwa data pribadi yang terdaftar akan diolah LAHAN SIKAM dalam berbagai penggunaan, termasuk tapi tidak terbatas pada:</p>\r\n                <ul class=\"text-left\" style=\"font-size: 14px;margin-right: 12px;font-family: Barlow, sans-serif;color: rgb(125,130,133);\">\r\n                    <li>Mengirimkan notifikasi atas informasi kegiatan, perubahan pada website, atau konfirmasi data user secara berkala;</li>\r\n                    <li>Memberikan akses bagi user ke layanan LAHAN SIKAM dan memastikan bahwa konten dan layanan ditampilkan dengan cara yang paling efektif untuk user;</li>\r\n                    <li>Memberikan informasi terkait konten situs, produk, layanan dan layanan Interaktif sesuai permintaan user untuk memproses setiap transaksi pembiayaan;</li>\r\n                    <li>Melaksanakan kewajiban LAHAN SIKAM yang timbul dari setiap perjanjian yang diadakan antara LAHAN SIKAM dan user;</li>\r\n                    <li>Pengembangan layanan LAHAN SIKAM, termasuk tetapi tidak terbatas pada pemecahan masalah, analisis data, pengujian, penelitian, tujuan statistik serta survei;</li>\r\n                    <li>Membuat analisis statistik dalam rangka pengembangan produk LAHAN SIKAM dan perkiraan terhadap risiko pinjaman;</li>\r\n                    <li>Membuat keputusan terkait dengan pembukaan atau kelanjutan terhadap aktifnya akun user serta pembuatan, penyediaan atau kelanjutan dari layanan dan juga untuk menjaga akurasi data pribadi;</li>\r\n                    <li>Melakukan pemeriksaan dalam rangka mencegah pencucian uang dan pendanaan terorisme;</li>\r\n                    <li>Menyediakan informasi dan data pribadi yang relevan tentang user kepada lembaga referensi kredit untuk tujuan memperbarui catatan kredit user dalam basis data kredit pelanggan dari lembaga tersebut;</li>\r\n                    <li>Memenuhi persyaratan-persyaratan hukum yang berlaku pada LAHAN SIKAM berdasarkan peraturan perundang-undangan yang berlaku;</li>\r\n                    <li>Memeriksa identitas dan/atau kewenangan dari para wakil atau kuasa user yang menghubungi LAHAN SIKAM dan untuk menanggapi permintaan, pertanyaan atau instruksi dari para kuasa yang telah diperiksa tersebut atau para pihak lain;</li>\r\n                    <li>Memberikan otorisasi kepada bank, badan keuangan atau pihak ketiga yang berwenang untuk mengadakan pengecekan terbatas pada status user dalam database atau layanan LAHAN SIKAM;</li>\r\n                    <li>Mencegah dan mendeteksi aktivitas kejahatan dan penipuan termasuk membantu dalam setiap penyidikan kejahatan oleh otoritas yang terkait dengan user;</li>\r\n                    <li>Melakukan manajemen internal untuk mengoperasikan kontrol terhadap sistem informasi dan manajemen serta melaksanakan audit internal atau mengizinkan pelaksanaan audit eksternal;</li>\r\n                    <li>Bertindak sebagai pihak yang memberikan atau mengajukan untuk memberikan jaminan atau jaminan pihak ketiga kepada penerima jaminan atau pihak yang menjamin kewajiban-kewajiban user sesuai dengan ketentuan dan perundang-undangan yang berlaku.</li>\r\n                </ul>\r\n            </div>\r\n        </div>\r\n    </div>','Kebijakan, Privasi, Lahan Sikam','Kebijakan Privasi Lahan Sikam','publish','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-02-01 04:13:20','2024-02-01 04:13:30');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
('02a9a094-c518-4dc2-a976-a1d16c46bfcf','career-delete','web','2024-02-07 02:22:19','2024-02-07 02:22:19'),
('14aff113-c963-472f-a8a9-4b784a225bf1','setting-detail','web','2024-01-04 08:10:09','2024-01-04 08:10:09'),
('183cd0b8-2bfc-46df-b7e1-ccb064ac7652','role-list','web','2024-02-07 02:32:51','2024-02-07 02:32:51'),
('1b12cc6e-1d00-4e97-a4a7-3e3bc3c7b7e4','article-update','web','2024-02-07 02:23:19','2024-02-07 02:23:19'),
('30416100-1bec-443a-8f82-135504d6638f','article-create','web','2024-02-07 02:22:58','2024-02-07 02:22:58'),
('4319f8d2-52c0-4025-bce6-3a1a48ae8e27','career-publish','web','2024-02-07 02:23:52','2024-02-07 02:23:52'),
('43ef2f68-9e1e-4b9b-9b60-7967f6259a67','user-create','web','2024-02-07 02:31:02','2024-02-07 02:31:02'),
('630f87a3-3c81-4bd7-a126-1a07f5c6345c','role-delete','web','2024-02-07 02:33:27','2024-02-07 02:33:27'),
('638fa583-d18e-4e5c-b00c-ea97a211c558','role-delete-permission','web','2024-02-07 02:36:04','2024-02-07 02:36:04'),
('7413e7dd-faf1-4286-be36-220757b2e290','user-direct-permission','web','2024-02-07 02:31:49','2024-02-07 02:31:49'),
('75384bad-9779-4b7c-abf4-e88abf582ef4','career-update','web','2024-02-07 02:22:37','2024-02-07 02:22:37'),
('84337042-30a0-4705-bbde-64740c9245ad','user-delete','web','2024-02-07 02:31:14','2024-02-07 02:31:14'),
('89cce6f2-026a-43b2-981c-cfb15af5f2da','role-create','web','2024-02-07 02:33:01','2024-02-07 02:33:01'),
('8b619b20-a61f-468f-9bb9-fa9ff7735c07','career-create','web','2024-02-07 02:21:59','2024-02-07 02:21:59'),
('8daa4a69-71af-4655-89ce-6e9357998d08','permission-create','web','2024-02-07 02:41:43','2024-02-07 02:41:43'),
('90465275-bc60-48b1-bbc8-d96231edd292','user-list','web','2024-02-07 02:30:45','2024-02-07 02:30:45'),
('bac0c81c-695f-4a7c-9a8e-ff2e5f562408','article-delete','web','2024-02-07 02:29:13','2024-02-07 02:29:13'),
('bd9ce690-7ee1-4307-ae69-f02d85471ada','article-publish','web','2024-02-07 02:23:36','2024-02-07 02:23:36'),
('d1b6603e-4b66-445b-8b9d-28a0a7978b39','role-update','web','2024-02-07 02:33:15','2024-02-07 02:33:15'),
('d9051505-1727-4412-9700-0c5f290bb5a9','setting-update','web','2024-01-04 08:10:35','2024-01-04 08:10:35'),
('ecb11a1e-b906-4acd-8011-268b272408b0','role-add-permission','web','2024-02-07 02:35:51','2024-02-07 02:35:51');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(70) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

insert  into `personal_access_tokens`(`id`,`tokenable_type`,`tokenable_id`,`name`,`token`,`abilities`,`last_used_at`,`expires_at`,`created_at`,`updated_at`) values 
(1,'App\\Models\\User','a00e00fd-a657-11ee-9c11-985fd348d6f9','access_token','b2f91b3cfce934cae929bf52fa0a91b0e5b1c5a423f24578a970f2ab677686cc','[\"*\"]',NULL,NULL,'2024-03-06 12:17:40','2024-03-06 12:17:40'),
(2,'App\\Models\\User','a00e00fd-a657-11ee-9c11-985fd348d6f9','access_token','511d26239cf4f1a74db968bc2077a2fbefaeff57fd6c373cc6fd26b1f00a190a','[\"*\"]',NULL,NULL,'2024-03-06 12:37:53','2024-03-06 12:37:53');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` char(36) NOT NULL,
  `role_id` char(36) NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values 
('14aff113-c963-472f-a8a9-4b784a225bf1','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('43ef2f68-9e1e-4b9b-9b60-7967f6259a67','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('638fa583-d18e-4e5c-b00c-ea97a211c558','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('7413e7dd-faf1-4286-be36-220757b2e290','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('84337042-30a0-4705-bbde-64740c9245ad','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('89cce6f2-026a-43b2-981c-cfb15af5f2da','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('8daa4a69-71af-4655-89ce-6e9357998d08','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('90465275-bc60-48b1-bbc8-d96231edd292','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('d1b6603e-4b66-445b-8b9d-28a0a7978b39','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('d9051505-1727-4412-9700-0c5f290bb5a9','d3782c30-46c3-4a0e-81a6-d10513642db9'),
('ecb11a1e-b906-4acd-8011-268b272408b0','d3782c30-46c3-4a0e-81a6-d10513642db9');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
('0803f600-1c68-4e13-9077-22068ba2a7d3','Publisher','web','2024-01-10 03:52:25','2024-01-10 03:52:25'),
('8d389588-b422-4915-b620-0999e162757c','Content Creator','web','2024-01-10 03:52:12','2024-01-10 03:52:12'),
('d3782c30-46c3-4a0e-81a6-d10513642db9','Super User','web','2024-01-04 03:02:44','2024-01-04 03:02:44');

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `phone_2` varchar(18) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `footer` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywoard` varchar(255) DEFAULT NULL,
  `google_maps` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `setting` */

insert  into `setting`(`id`,`title`,`description`,`logo`,`address`,`phone`,`phone_2`,`email`,`footer`,`facebook`,`instagram`,`youtube`,`linkedin`,`meta_description`,`meta_keywoard`,`google_maps`,`created_at`,`updated_at`) values 
(1,'Duluin.com',NULL,'1709727572Logo-Duluin.png','Jakarta','08xxxxxxxx','08xxxxxxxx','hello@duluin.com','Copyright Â© 2024 Duluin.com. All Rights Reserved.','4','3','https://www.youtube.com/@LahanSikam','2',NULL,NULL,'1','2023-11-23 13:26:35','2024-03-06 12:19:32');

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(225) DEFAULT NULL,
  `status` enum('publish','unpublish') DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_user` (`created_by`),
  CONSTRAINT `tag_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tags` */

insert  into `tags`(`id`,`name`,`slug`,`status`,`created_by`,`created_at`,`updated_at`) values 
(2,'Bisnis','bisnis','publish','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-08 04:37:01','2024-01-08 04:55:10'),
(4,'Ekonomi','ekonomi','publish','a00e00fd-a657-11ee-9c11-985fd348d6f9','2024-01-08 04:55:24','2024-01-08 04:55:24');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `phone_2` varchar(13) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_banned` varchar(255) NOT NULL DEFAULT '0',
  `banned_reason` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`state`,`address`,`email`,`phone`,`phone_2`,`avatar`,`email_verified_at`,`password`,`is_banned`,`banned_reason`,`remember_token`,`created_at`,`updated_at`) values 
('a00e00fd-a657-11ee-9c11-985fd348d6f9','Admin',NULL,NULL,'admin@gmail.com','085769306099',NULL,'andra-1704896750.png','2024-01-02 10:35:52','$2y$10$D5BfUjbHXuHygITdRnUkYu6AtNVYZW.Oe6zk8ljZHdKESJ3jRVMKu','0',NULL,NULL,'2024-01-02 10:35:52','2024-01-10 14:25:50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
