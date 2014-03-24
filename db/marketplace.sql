-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2014 at 06:26 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `acme_roles`
--

CREATE TABLE IF NOT EXISTS `acme_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A7E50F8957698A6A` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `acme_roles`
--

INSERT INTO `acme_roles` (`id`, `name`, `role`) VALUES
(1, 'store owner', 'ROLE_STORE'),
(2, 'admin', 'ROLE_ADMIN'),
(3, 'ROLE_CUSTOMER', 'ROLE_CUSTOMER');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `billing_first_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_last_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address` longtext COLLATE utf8_unicode_ci,
  `billing_city` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_postalcode` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_phone` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_first_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_last_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address` longtext COLLATE utf8_unicode_ci,
  `shipping_city` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_postalcode` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_billing_same` tinyint(1) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `shipping_method_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BA388B7A76ED395` (`user_id`),
  KEY `IDX_BA388B75AA1164F` (`payment_method_id`),
  KEY `IDX_BA388B75F7D6850` (`shipping_method_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=208 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `created`, `updated`, `billing_first_name`, `billing_last_name`, `billing_email`, `billing_address`, `billing_city`, `billing_state`, `billing_postalcode`, `billing_country`, `billing_phone`, `shipping_first_name`, `shipping_last_name`, `shipping_email`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_postalcode`, `shipping_country`, `shipping_phone`, `shipping_billing_same`, `payment_method_id`, `shipping_method_id`) VALUES
(175, NULL, '2013-12-23 15:48:00', '2013-12-23 15:48:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(176, NULL, '2013-12-23 16:00:03', '2013-12-23 16:00:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(177, NULL, '2013-12-23 16:02:23', '2013-12-23 16:02:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, NULL, '2013-12-23 16:06:49', '2013-12-23 16:06:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(179, NULL, '2013-12-23 17:03:53', '2013-12-23 17:03:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180, NULL, '2013-12-23 18:06:47', '2013-12-23 18:06:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(181, NULL, '2013-12-24 11:46:07', '2013-12-24 11:46:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, NULL, '2013-12-24 11:54:06', '2013-12-24 11:54:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(183, NULL, '2013-12-24 12:01:57', '2013-12-24 12:01:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(184, NULL, '2013-12-24 12:19:18', '2013-12-24 12:19:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, NULL, '2013-12-24 13:56:37', '2013-12-24 13:56:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(186, NULL, '2013-12-24 14:07:53', '2013-12-24 14:07:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, NULL, '2013-12-24 15:49:00', '2013-12-24 15:49:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(188, NULL, '2013-12-24 16:44:14', '2013-12-24 16:44:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(189, NULL, '2013-12-24 23:08:21', '2013-12-24 23:08:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(190, NULL, '2013-12-25 13:23:22', '2013-12-25 13:23:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(191, NULL, '2013-12-26 13:54:55', '2013-12-26 13:54:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(192, NULL, '2013-12-26 18:08:34', '2013-12-26 18:08:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(193, NULL, '2013-12-29 14:19:03', '2013-12-29 14:19:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(194, NULL, '2014-01-01 17:02:58', '2014-01-01 17:02:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(195, NULL, '2014-01-04 17:09:46', '2014-01-04 17:09:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(196, NULL, '2014-01-08 19:12:48', '2014-01-08 19:12:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(197, NULL, '2014-01-16 22:33:13', '2014-01-16 22:33:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(198, NULL, '2014-02-17 13:46:26', '2014-02-17 13:46:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(199, NULL, '2014-02-18 09:15:01', '2014-02-18 09:15:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(200, NULL, '2014-02-18 09:15:09', '2014-02-18 09:15:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(201, NULL, '2014-02-19 04:49:57', '2014-02-19 04:49:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(202, NULL, '2014-02-19 07:49:59', '2014-02-19 07:49:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(203, NULL, '2014-02-19 07:55:08', '2014-02-19 07:55:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(204, NULL, '2014-02-19 07:57:50', '2014-02-19 07:57:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(205, NULL, '2014-02-19 07:58:04', '2014-02-19 07:58:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(206, NULL, '2014-02-19 08:10:36', '2014-02-19 08:10:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(207, NULL, '2014-02-19 08:38:02', '2014-02-19 08:38:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE IF NOT EXISTS `cart_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0FE25271AD5CDBF` (`cart_id`),
  KEY `IDX_F0FE25274584665A` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=64 ;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`id`, `cart_id`, `product_id`, `created`, `updated`, `quantity`) VALUES
(61, 180, 45, '2013-12-23 19:37:48', '2013-12-23 19:37:48', 1),
(62, 180, 17, '2013-12-23 20:23:59', '2013-12-23 20:23:59', 1),
(63, 204, 53, '2014-02-19 08:06:14', '2014-02-19 08:06:16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `billing_first_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_last_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address` longtext COLLATE utf8_unicode_ci,
  `billing_city` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_postalcode` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_phone` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_first_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_last_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address` longtext COLLATE utf8_unicode_ci,
  `shipping_city` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_postalcode` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_billing_same` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_81398E09A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `user_id`, `created`, `updated`, `billing_first_name`, `billing_last_name`, `billing_email`, `billing_address`, `billing_city`, `billing_state`, `billing_postalcode`, `billing_country`, `billing_phone`, `shipping_first_name`, `shipping_last_name`, `shipping_email`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_postalcode`, `shipping_country`, `shipping_phone`, `shipping_billing_same`) VALUES
(2, 22, '2013-12-23 16:00:03', '2013-12-23 16:00:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ext_log_entries`
--

CREATE TABLE IF NOT EXISTS `ext_log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_class_lookup_idx` (`object_class`),
  KEY `log_date_lookup_idx` (`logged_at`),
  KEY `log_user_lookup_idx` (`username`),
  KEY `log_version_lookup_idx` (`object_id`,`object_class`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ext_translations`
--

CREATE TABLE IF NOT EXISTS `ext_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20131215155123'),
('20131215164427'),
('20131215165712'),
('20131215175659'),
('20131216215507'),
('20131216215612'),
('20131217122913'),
('20131217130109'),
('20131217145633'),
('20131217164256'),
('20131219204254'),
('20131220173054'),
('20131221040327'),
('20131221215044'),
('20131221223430'),
('20131221223702'),
('20131222160411'),
('20131222161829'),
('20131222214052'),
('20131222220002');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_140AB620989D9B62` (`slug`),
  KEY `IDX_140AB620B092A811` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `store_id`, `name`, `enabled`, `body`, `title`, `slug`) VALUES
(9, NULL, 'about-us', 1, 'about us', 'About Us', 'about-us'),
(10, NULL, 'about-us', 1, 'about us', 'About Us', 'about-us-1');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `description`) VALUES
(1, 'Cash On Delivery', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `name` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `clearance` tinyint(1) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `clearance_price` double DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `out_of_stock` tinyint(1) DEFAULT NULL,
  `meta_description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D34A04AD989D9B62` (`slug`),
  KEY `IDX_D34A04ADB092A811` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `store_id`, `name`, `enabled`, `description`, `image_path`, `image`, `created`, `updated`, `featured`, `clearance`, `price`, `clearance_price`, `slug`, `approved`, `out_of_stock`, `meta_description`, `meta_keywords`) VALUES
(17, 6, 'The World of Noble Angels', 1, 'From the moment an individual is conceived in his mother&#39;s womb, until his death and beyond, angels play a part in human life. Angels bring forth the soul of the dying and they bring comfort or inflict torment in the grave. An angel will sound the Trumpet on the Last Day, and angels will be present on the Day of Judgment until they accompany people to their ultimate destination in Paradise or Hell. Almost all human cultures, ancient and modern, have some kind of belief about angels. The pre-Islamic Arabs believed them to be daughters of the Almighty. Some philosophers thought that angels were the stars in the sky. In modern times, there has been a resurgence of interest in angels, and they feature prominently in movies and other forms of popular western culture.', 'Noble Angels.jpg', NULL, '2013-12-07 23:30:59', '2014-01-04 17:11:27', 1, NULL, 205, NULL, 'the-world-of-noble-angels', 1, NULL, 'Almost all human cultures, ancient and modern, have some kind of belief about angels.', 'islamic, muslim, character,guidance'),
(18, 6, 'Family Leadership', 1, 'In his latest important contribution to literature on family matters in Islam, Dr. Mohamed Rida Beshir addresses the challenging topic of Family Leadership (Qawamah) a concept which is often misunderstood and which is a source of much family strife. Dr. Beshir provides a two-pronged approach in dealing with the issue, first by providing academic explanations relating to it, and then by following with his trademark use of practical examples to illustrate the proper and improper use of this concept. Dr. Beshir starts by providing the meaning of Qawamah as described in various Arabic dictionaries, as well as the way the word is used within a Quranic context. Next, he offers a summary of the various translations of the famous Quranic verse referring to Qawamah, as well as thorough interpretations of the verse by the different Islamic scholars. Finally, he presents several key issues relating to the proper understanding of the concept of Qawamah, including Qawamah as an obligation and responsibility, being aware of Allah SWT in its application, and the difficult issue of domestic violence. The entire second half of the book is devoted to practical examples of both the proper and improper use of Qawamah, including the author s explanations of why a person s behavior in a particular situation is appropriate or inappropriate.', 'FL.jpg', '', '2013-12-07 23:48:26', '2013-12-07 23:48:39', NULL, NULL, 346, NULL, 'family-leadership', 1, NULL, '', ''),
(19, 6, 'Prophet Muhammad (S) - The Best of All Husbands', 1, 'In marriage, it often happens that we come across a situation in which things seem to be going haywire, and we wonder what would have been the ideal stance and the best way to handle this problem. For Muslims, the best stance and the best way is that of the Prophet Muhammed (PBUH). Allah has taught that this is how we should seek to resolve our conflicts:\r\n\r\n{If you differ in anything among yourselves, refer it to Allah and His Messenger if you do believe in Allah and the Last Day: that is best and most suitable for final determination.} (Qur''an 4:59)\r\n\r\nOur prophet was a husband with eleven women, each of whom has revealed to us her personal impressions of some or the other aspect of his exemplary personality.\r\n\r\nThis book is a must-read for all married couples-and for any Muslim man or woman who is contemplating marriage-who wish to achieve satisfaction in their personal wives.', 'BOAH.jpg', '', '2013-12-07 23:54:36', '2013-12-07 23:54:36', NULL, NULL, 212, NULL, 'prophet-muhammad-s-the-best-of-all-husbands', 1, NULL, '', ''),
(20, 6, 'Jesus, Prophet of Islam', 1, 'First published in 1977, Muhammad ''Ata ur-Rahim''s classic text examines Jesus as a prophet teaching the Unity of God, and the historical collapse of Christianity as it abandoned his teaching. Now revised by coauthor Ahmad Thomson, the book sketches the dramatic picture of the original followers of Jesus who affirmed Unity, showing how ''Christianity'' became the fiction that replaced their truth. A wide-ranging study that covers the Gospel of Barnabas, the Gospel of Hermes, the shepherd, early and later Unitarian Christians, and Jesus in the gospels and in the Qur''an and hadith, Jesus: Prophet of Islam argues persuasively that the idea of Jesus as part of a trinity was a Greek pagan concept adopted by early Christian missionaries to gain converts among the Greeks, and did not become a widely accepted Christian doctrine until after the Council of Nicea in 325 A.D', 'POTS.jpg', '', '2013-12-07 23:59:07', '2013-12-07 23:59:07', NULL, NULL, 325, NULL, 'jesus-prophet-of-islam', 1, NULL, '', ''),
(25, 6, 'Head Scarf A', 1, 'A beautiful Head Scarf you can wear with your Abaya', 'sc1.jpg', '', '2013-12-08 01:23:43', '2013-12-08 01:23:43', NULL, NULL, 289, NULL, 'head-scarf-a', 1, NULL, '', ''),
(26, 6, 'Head Scarf B', 1, 'A beautiful Head Scarf you can wear with your Abaya', 'sc2.jpg', '', '2013-12-08 01:24:18', '2013-12-08 01:24:18', NULL, NULL, 323, NULL, 'head-scarf-b', 1, NULL, '', ''),
(27, 6, 'Head Scarf C', 1, 'A beautiful Head Scarf you can wear with your Abaya', 'sc3.jpg', '', '2013-12-08 01:24:54', '2013-12-08 01:24:54', NULL, NULL, 244, NULL, 'head-scarf-c', 1, NULL, '', ''),
(28, 6, 'Head Scarf D', 1, 'A beautiful Head Scarf you can wear with your Abaya', 'sc4.jpg', '', '2013-12-08 01:25:11', '2013-12-08 01:25:11', NULL, NULL, 153, NULL, 'head-scarf-d', 1, NULL, '', ''),
(29, 6, 'Gift Item A', 1, 'Wonderful gifts and souvenirs for your family and friends!', 'gf1.jpg', '', '2013-12-08 01:33:59', '2013-12-08 01:33:59', NULL, NULL, 335, NULL, 'gift-item-a', 1, NULL, '', ''),
(30, 6, 'Gift Item B', 1, 'Wonderful gifts and souvenirs for your family and friends!', 'gf2.jpg', '', '2013-12-08 01:34:31', '2013-12-08 01:34:31', NULL, NULL, 316, NULL, 'gift-item-b', 1, NULL, '', ''),
(31, 6, 'Gift Item C', 1, 'Wonderful gifts and souvenirs for your family and friends!', 'gf3.jpg', '', '2013-12-08 01:34:44', '2013-12-08 01:34:44', NULL, NULL, 474, NULL, 'gift-item-c', 1, NULL, '', ''),
(32, 6, 'Gift Item D', 1, 'Wonderful gifts and souvenirs for your family and friends!', 'gf4.jpg', '', '2013-12-08 01:35:01', '2013-12-08 01:35:01', NULL, NULL, 120, NULL, 'gift-item-d', 1, NULL, '', ''),
(33, 7, 'Mustard Oil', 1, 'Pure Mustard Oil', 'mo1.jpg', NULL, '2013-12-08 03:13:16', '2013-12-13 02:21:07', NULL, 0, 281, NULL, 'mustard-oil', 1, NULL, '', ''),
(34, 7, 'Flour', 1, 'Flour (Brown)', 'brown.jpg', '', '2013-12-08 03:21:06', '2013-12-08 03:21:06', NULL, NULL, 145, NULL, 'flour', 1, NULL, '', ''),
(35, 7, 'Red Chili Powder', 1, 'Red Chili Powder', 'chili.jpg', '', '2013-12-08 03:21:52', '2013-12-08 03:21:52', NULL, NULL, 184, NULL, 'red-chili-powder', 1, NULL, '', ''),
(36, 7, 'Parsley Seeds', 1, 'Parsley Seeds', 'dhania.jpg', '', '2013-12-08 03:22:13', '2013-12-08 03:22:13', NULL, NULL, 384, NULL, 'parsley-seeds', 1, NULL, '', ''),
(37, 7, 'Ghee', 1, 'Pure Ghee', 'ghee.jpg', '', '2013-12-08 03:22:49', '2013-12-08 03:22:49', NULL, NULL, 467, NULL, 'ghee', 1, NULL, '', ''),
(38, 7, 'Honey', 1, 'Pure Honey', 'honey.jpg', '', '2013-12-08 03:23:24', '2013-12-08 03:23:24', NULL, NULL, 283, NULL, 'honey', 1, NULL, '', ''),
(39, 7, 'Black Seed Oil', 1, 'Black Seed Oil', 'kala.jpg', '', '2013-12-08 03:23:46', '2013-12-08 03:23:46', NULL, NULL, 314, NULL, 'black-seed-oil', 1, NULL, '', ''),
(40, 7, 'Masur Pulses', 1, 'Masur Pulses', 'masur.jpg', '', '2013-12-08 03:24:14', '2013-12-08 03:24:14', NULL, NULL, 222, NULL, 'masur-pulses', 1, NULL, '', ''),
(41, 7, 'Dheki Chhata Rice', 1, 'Dheki Chhata Rice', 'rice.jpg', '', '2013-12-08 03:24:27', '2013-12-08 03:26:11', NULL, NULL, 468, NULL, 'dheki-chhata-rice', 1, NULL, '', ''),
(42, 7, 'Brown Sugar', 1, 'Brown Sugar', 'sugar.jpg', '', '2013-12-08 03:27:06', '2013-12-08 03:27:06', NULL, NULL, 373, NULL, 'brown-sugar', 1, NULL, '', ''),
(43, 7, 'Turmeric Powder', 1, 'Turmeric Powder', 'turmeric.jpg', '', '2013-12-08 03:27:56', '2013-12-08 03:27:56', NULL, NULL, 363, NULL, 'turmeric-powder', 1, NULL, '', ''),
(44, 8, 'Face Towel B', 1, 'Face Towel B', 'Set-Of-2-Plain-Hand-Towel-Sky-Blue-CJHT311.jpg', '', '2013-12-10 02:03:15', '2013-12-10 02:03:15', NULL, NULL, 192, NULL, 'face-towel-b', 1, NULL, '', ''),
(45, 8, 'Face Towel W', 1, 'Face Towel W', 'Set-Of-2-Plain-Hand-Towel-White-CJHT308.jpg', '', '2013-12-10 02:04:02', '2013-12-10 02:04:02', NULL, NULL, 173, NULL, 'face-towel-w', 1, NULL, '', ''),
(46, 8, 'Face Towel Br', 1, 'Face Towel Br', 'Set-Of-2-Plain-Hand-Towel-Camel-CJHT309.jpg', '', '2013-12-10 02:04:28', '2013-12-10 02:04:28', NULL, NULL, 192, NULL, 'face-towel-br', 1, NULL, '', ''),
(47, 8, 'Face Towel R', 1, 'Face Towel R', 'Set-Of-2-Plain-Hand-Towel--Burgandy-CJHT307.jpg', '', '2013-12-10 02:04:45', '2013-12-10 02:04:45', NULL, NULL, 338, NULL, 'face-towel-r', 1, NULL, '', ''),
(48, 8, 'Belt A', 1, 'Ihram A', 'ihram.jpg', NULL, '2013-12-10 02:12:26', '2014-02-19 06:43:47', NULL, 0, 216, NULL, 'belt-a', 1, NULL, '', ''),
(49, 8, 'Coat B', 1, 'Ihram B', 'mens-ihram-860x800.jpg', NULL, '2013-12-10 02:12:45', '2014-02-19 06:43:53', NULL, 0, 365, NULL, 'coat-b', 1, NULL, '', ''),
(50, 8, 'Khimar', 1, 'Khimar', 'hajj-ihram-women.jpg', '', '2013-12-10 02:13:22', '2013-12-10 02:13:22', NULL, NULL, 278, NULL, 'khimar', 1, NULL, '', ''),
(51, 8, 'Hand Towels', 1, 'Hand Towels', 'hand towels-500x500.JPG', '', '2013-12-10 02:42:19', '2013-12-10 02:42:19', NULL, NULL, 194, NULL, 'hand-towels', 1, NULL, '', ''),
(52, 8, 'Bath Towels', 1, 'Bath Towels', 'Bathroom-Towel.jpg', '', '2013-12-10 02:42:39', '2013-12-10 02:42:39', NULL, NULL, 438, NULL, 'bath-towels', 1, NULL, '', ''),
(53, 5, 'Marriage – The Making & Living of It', 1, 'Marriage, such a boon, can turn into a tormenting bane if it is not properly made and lived. Marriage, if tailored according to the Quran and Sunnah, showers blessing of Allah not only on the couple but also on the society. This book touches on main issues to render a marriage a source of joy and fulfillment in this life.', 'Marriage-MYB.jpg', '', '2013-12-10 04:58:28', '2013-12-10 04:58:28', NULL, NULL, 304, NULL, 'marriage-the-making-living-of-it', 1, NULL, '', ''),
(54, 5, 'Leadership Lessons From The Life Of Rasoolullah', 1, 'Muslims already have a peerless leader, Messenger of Allah (pbuh), who displays unique leadership qualities. His diverse and artless leadership transformed a messy community into the best generation of the earth. Not only was he himself a leader, but he created leaders by inspiring to connect with Allah (swt) and the example of moulding leaders out of a number of subdued slaves is simply countless in his blessed life.', 'Leadership-MYB.jpg', NULL, '2013-12-10 04:59:04', '2013-12-10 04:59:17', NULL, NULL, 109, NULL, 'leadership-lessons-from-the-life-of-rasoolullah', 1, NULL, '', ''),
(55, 5, 'বিয়ে - স্বপ্ন থেকে অষ্ট প্রহর', 1, 'বাস্তবাদের নিবির চর্চাতে বাস্ত পশ্চিমা দর্শন বর্তমানে পরিবারকে পেছনে ফেলে কর্মক্ষেত্র এগিয়ে গেছে। স্ত্রীর সাথে না বনলে তাকে ছেড়ে দেয়া চলে কিন্তু চাকরি গেলে মানিস খাবে কী? সুতরাং চাকরিতে নিজেকে মানিয়ে নিতে হবে, সবাইকে সমঝে চলতে হবে। পরিনিতি? তাদের সমাজে ভাঙনে খ্যানখ্যান বাজনাটা খুব স্পষ্টই শোনা যায়। বাড়ছে অর্সহীন বিবাহ বিচ্ছেদ। বাবা-মায়ের কোন্দল দেখে ক্লান্ত শিশুরা-শিখছে শুধুই সংঘাত। অবৈধ, অনৈতিক সব সম্পর্ক ভেঙ্গে দিছে বৈধ, পবিত্র পারিবারিক বন্ধনগুলো।', 'Biye-MYB.jpg', '', '2013-12-10 05:11:38', '2013-12-10 05:11:38', NULL, NULL, 334, NULL, 'marriage-bengali', 1, NULL, '', ''),
(56, 5, 'স্রষ্টা ধর্ম জীবন', 1, 'বর্তমান পৃথিবীতে বৈধ, খ্রিষ্টান, হিন্দু বা মুসলিম ন বরং সংখ্যাগরিষ্ঠ ধর্মহীনেরা। ধর্মহীনেরা সঙ্গ সংশয়াতীত নো। সাংস্কৃতিকভাবে নাস্তিকেরাও নিজেকে একটি ধর্ম সংলগ্নতা রক্ষা করেন। এই যুগ্শুত্রতা ভাষা কিংবা অত্তিয়তার বত তা নেহায়েত জন্মসুত্রে পাব। সংখ্যাগরিষ্ঠ মানুষ কোনো নির্দিষ্ট ধর্মের অনুশাসনের প্রতি বিদ্রোহ হয়ত করে না, তবে সুলুকসন্ধানেও করে না।', 'Srosta-AABP.jpg', '', '2013-12-10 05:22:18', '2013-12-10 05:22:18', NULL, NULL, 442, NULL, 'srosta-aabp', 1, NULL, '', ''),
(57, 5, 'তথ্য ছেড়ে জীবনে', 1, 'পৃথিবী কান এলাম? কাকে ভালবাসব? ধর্মপালনের বাহ্যিক প্রকাশের দরকার কি? মানুষ অসত পথে কেন যায়? বিদেশ না বাবা-বা? জীবন পথের বাঁকে বাঁকে নানা ঘটনা ঘটে। ধর্মগ্রন্থে পড়া নীতিকথাগুলো কি সেখানেই থেকে যাবে না জীবনে প্রতিফলিত হবে? কতটুকু হবে? যতটুকুর প্রতিফলনে বিলাসী জীবনযাত্রার কোনো সমস্যা না হয়? নাকি আত্মত্যাগ করতে হবে?', 'Tothho-SAH.jpg', '', '2013-12-10 05:29:34', '2013-12-10 05:29:34', NULL, NULL, 308, NULL, 'ththosah', 1, NULL, '', ''),
(58, 9, 'Shoe A', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS&reg;, and you&#39;ll definitely feel like a winner with this awesome style jogger. Synthetic upper with molded quarter detailing. Rugged and stylish nylon loop lace-up closure. Padded heel collar and tongue for extra comfort. Compression-molded EVA midsole. Textile lining and insole. Lug rubber outsole for excellent traction. Imported. Measurements: Weight: 1 lb Product measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (1).jpg', NULL, '2013-12-16 23:06:46', '2014-02-19 07:04:19', NULL, 0, 100, NULL, 'shoe-a', 1, NULL, '', ''),
(59, 9, 'Shoe B', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS®, and you''ll definitely feel like a winner with this awesome style jogger.\r\nSynthetic upper with molded quarter detailing.\r\nRugged and stylish nylon loop lace-up closure.\r\nPadded heel collar and tongue for extra comfort.\r\nCompression-molded EVA midsole.\r\nTextile lining and insole.\r\nLug rubber outsole for excellent traction.\r\nImported.\r\nMeasurements:\r\nWeight: 1 lb\r\nProduct measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (2).jpg', '', '2013-12-17 00:43:11', '2013-12-17 00:43:11', NULL, NULL, 200, NULL, 'shoe-b', 1, NULL, '', ''),
(60, 9, 'Shoe C', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS®, and you''ll definitely feel like a winner with this awesome style jogger.\r\nSynthetic upper with molded quarter detailing.\r\nRugged and stylish nylon loop lace-up closure.\r\nPadded heel collar and tongue for extra comfort.\r\nCompression-molded EVA midsole.\r\nTextile lining and insole.\r\nLug rubber outsole for excellent traction.\r\nImported.\r\nMeasurements:\r\nWeight: 1 lb\r\nProduct measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (3).jpg', '', '2013-12-17 00:44:00', '2013-12-17 00:44:00', NULL, NULL, 300, NULL, 'shoe-c', 1, NULL, '', ''),
(61, 9, 'Shoe D', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS®, and you''ll definitely feel like a winner with this awesome style jogger.\r\nSynthetic upper with molded quarter detailing.\r\nRugged and stylish nylon loop lace-up closure.\r\nPadded heel collar and tongue for extra comfort.\r\nCompression-molded EVA midsole.\r\nTextile lining and insole.\r\nLug rubber outsole for excellent traction.\r\nImported.\r\nMeasurements:\r\nWeight: 1 lb\r\nProduct measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (4).jpg', '', '2013-12-17 00:44:30', '2013-12-17 00:44:30', NULL, NULL, 400, NULL, 'shoe-d', 1, NULL, '', ''),
(62, 9, 'Shoe E', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS®, and you''ll definitely feel like a winner with this awesome style jogger.\r\nSynthetic upper with molded quarter detailing.\r\nRugged and stylish nylon loop lace-up closure.\r\nPadded heel collar and tongue for extra comfort.\r\nCompression-molded EVA midsole.\r\nTextile lining and insole.\r\nLug rubber outsole for excellent traction.\r\nImported.\r\nMeasurements:\r\nWeight: 1 lb\r\nProduct measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (5).jpg', '', '2013-12-17 00:45:03', '2013-12-17 00:45:03', NULL, NULL, 500, NULL, 'shoe-e', 1, NULL, '', ''),
(63, 9, 'Shoe F', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS®, and you''ll definitely feel like a winner with this awesome style jogger.\r\nSynthetic upper with molded quarter detailing.\r\nRugged and stylish nylon loop lace-up closure.\r\nPadded heel collar and tongue for extra comfort.\r\nCompression-molded EVA midsole.\r\nTextile lining and insole.\r\nLug rubber outsole for excellent traction.\r\nImported.\r\nMeasurements:\r\nWeight: 1 lb\r\nProduct measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (6).jpg', '', '2013-12-17 00:45:36', '2013-12-17 00:45:36', NULL, NULL, 500, NULL, 'shoe-f', 1, NULL, '', ''),
(64, 9, 'Shoe G', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS®, and you''ll definitely feel like a winner with this awesome style jogger.\r\nSynthetic upper with molded quarter detailing.\r\nRugged and stylish nylon loop lace-up closure.\r\nPadded heel collar and tongue for extra comfort.\r\nCompression-molded EVA midsole.\r\nTextile lining and insole.\r\nLug rubber outsole for excellent traction.\r\nImported.\r\nMeasurements:\r\nWeight: 1 lb\r\nProduct measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (7).jpg', '', '2013-12-17 00:45:56', '2013-12-17 00:45:56', NULL, NULL, 500, NULL, 'shoe-g', 1, NULL, '', ''),
(65, 9, 'Shoe H', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS®, and you''ll definitely feel like a winner with this awesome style jogger.\r\nSynthetic upper with molded quarter detailing.\r\nRugged and stylish nylon loop lace-up closure.\r\nPadded heel collar and tongue for extra comfort.\r\nCompression-molded EVA midsole.\r\nTextile lining and insole.\r\nLug rubber outsole for excellent traction.\r\nImported.\r\nMeasurements:\r\nWeight: 1 lb\r\nProduct measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (8).jpg', '', '2013-12-17 00:46:33', '2013-12-17 00:46:33', NULL, NULL, 400, NULL, 'shoe-h', 1, NULL, '', ''),
(66, 9, 'Shoe EYE', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS®, and you''ll definitely feel like a winner with this awesome style jogger.\r\nSynthetic upper with molded quarter detailing.\r\nRugged and stylish nylon loop lace-up closure.\r\nPadded heel collar and tongue for extra comfort.\r\nCompression-molded EVA midsole.\r\nTextile lining and insole.\r\nLug rubber outsole for excellent traction.\r\nImported.\r\nMeasurements:\r\nWeight: 1 lb\r\nProduct measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (9).jpg', '', '2013-12-17 00:47:16', '2013-12-17 00:47:16', NULL, NULL, 300, NULL, 'shoe-eye', 1, NULL, '', ''),
(67, 9, 'Shoe J', 1, 'Get ready for the races with the Afterburn M. Fit by SKECHERS®, and you''ll definitely feel like a winner with this awesome style jogger.\r\nSynthetic upper with molded quarter detailing.\r\nRugged and stylish nylon loop lace-up closure.\r\nPadded heel collar and tongue for extra comfort.\r\nCompression-molded EVA midsole.\r\nTextile lining and insole.\r\nLug rubber outsole for excellent traction.\r\nImported.\r\nMeasurements:\r\nWeight: 1 lb\r\nProduct measurements were taken using size 12, width D - Medium. Please note that measurements may vary by size.', 'Shoe (10).jpg', '', '2013-12-17 00:47:38', '2013-12-17 00:47:38', NULL, NULL, 900, NULL, 'shoe-j', 1, NULL, '', ''),
(68, 10, 'Luxury B', 1, 'Cars, a tribute to this ongoing love affair with automobiles, is a spectacular collection that features various stages of their mechanical lifespans, from the assembly line to the junkyard.', 'lux (2).jpg', '', '2013-12-17 02:51:47', '2013-12-17 02:59:34', NULL, NULL, 1000000, NULL, 'luxury-b', 1, NULL, '', ''),
(69, 10, 'Luxury A', 1, 'Cars, a tribute to this ongoing love affair with automobiles, is a spectacular collection that features various stages of their mechanical lifespans, from the assembly line to the junkyard.', 'lux (1).jpg', '', '2013-12-17 02:53:58', '2013-12-17 02:53:58', NULL, NULL, 2000000, NULL, 'luxury-a', 1, NULL, '', ''),
(70, 10, 'Luxury C', 1, 'Cars, a tribute to this ongoing love affair with automobiles, is a spectacular collection that features various stages of their mechanical lifespans, from the assembly line to the junkyard.', 'lux (3).jpg', '', '2013-12-17 02:54:38', '2013-12-17 02:54:38', NULL, NULL, 1000000, NULL, 'luxury-c', 1, NULL, '', ''),
(71, 10, 'Sports A', 1, 'Cars, a tribute to this ongoing love affair with automobiles, is a spectacular collection that features various stages of their mechanical lifespans, from the assembly line to the junkyard.', 'sport (1).jpg', '', '2013-12-17 02:55:39', '2013-12-17 02:55:39', NULL, NULL, 3000000, NULL, 'sports-a', 1, NULL, '', ''),
(72, 10, 'Sports B', 1, 'Cars, a tribute to this ongoing love affair with automobiles, is a spectacular collection that features various stages of their mechanical lifespans, from the assembly line to the junkyard.', 'sport (2).jpg', '', '2013-12-17 02:57:52', '2013-12-17 02:57:52', NULL, NULL, 5000000, NULL, 'sports-b', 1, NULL, '', ''),
(73, 10, 'Sports C', 1, 'Cars, a tribute to this ongoing love affair with automobiles, is a spectacular collection that features various stages of their mechanical lifespans, from the assembly line to the junkyard.', 'sport (3).jpg', '', '2013-12-17 02:58:54', '2013-12-17 02:58:54', NULL, NULL, 5000000, NULL, 'sports-c', 1, NULL, '', ''),
(74, 10, 'Roadster A', 1, 'Cars, a tribute to this ongoing love affair with automobiles, is a spectacular collection that features various stages of their mechanical lifespans, from the assembly line to the junkyard.', 'road (1).jpg', '', '2013-12-17 03:00:28', '2013-12-17 03:00:28', NULL, NULL, 1000000, NULL, 'roadster-a', 1, NULL, '', ''),
(75, 10, 'Roadster B', 1, 'Cars, a tribute to this ongoing love affair with automobiles, is a spectacular collection that features various stages of their mechanical lifespans, from the assembly line to the junkyard.', 'road (2).jpg', '', '2013-12-17 03:00:47', '2013-12-17 03:00:47', NULL, NULL, 1000000, NULL, 'roadster-b', 1, NULL, '', ''),
(76, 10, 'Roadster C', 1, 'Cars, a tribute to this ongoing love affair with automobiles, is a spectacular collection that features various stages of their mechanical lifespans, from the assembly line to the junkyard.', 'road (3).jpg', '', '2013-12-17 03:01:09', '2013-12-17 03:01:09', NULL, NULL, 1000000, NULL, 'roadster-c', 1, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_section_id` int(11) NOT NULL,
  `name` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CDFC7356989D9B62` (`slug`),
  KEY `IDX_CDFC73564B44BC51` (`product_section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_section_id`, `name`, `enabled`, `description`, `slug`) VALUES
(2, 1, 'Men', 0, 'some description', 'men'),
(3, 1, 'Women', 0, 'some description', 'women'),
(4, 1, 'Children', 0, 'some description', 'children'),
(5, 1, 'Accessories', 0, 'some description', 'accessories'),
(6, 2, 'Television', 0, 'some description', 'tv'),
(7, 2, 'Mobile', 0, 'some description', 'mobile'),
(8, 2, 'Computer', 0, 'some description', 'computer'),
(9, 2, 'Desktop', 0, 'some description', 'desktop'),
(10, 2, 'Laptop', 0, 'some description', 'laptop'),
(11, 2, 'Air Conditioner', 0, 'some description', 'ac'),
(12, 2, 'Oven', 0, 'some description', 'oven'),
(13, 2, 'Toaster', 0, 'some description', 'toaster'),
(14, 3, 'Website Design', 0, 'some description', 'webdesign'),
(15, 3, 'Programming', 0, 'some description', 'programming'),
(16, 3, 'Medical Transcription', 0, 'some description', 'mdeical'),
(17, 3, 'Graphics Design', 0, 'some description', 'graphics'),
(18, 4, 'Cakes', 0, 'some description', 'cakes'),
(19, 4, 'Beverages', 0, 'some description', 'beverages'),
(20, 4, 'Coffee', 0, 'some description', 'coffee'),
(21, 6, 'Reconditioned Car', 0, 'some description', 'conditionedcar'),
(22, 6, 'Motorcycle', 0, 'some description', 'motorcycle'),
(23, 6, 'Commercial', 0, 'some description', 'commercial'),
(24, 6, 'Auto Parts', 0, 'some description', 'autoparts'),
(25, 6, 'CNG', 0, 'some description', 'cng'),
(26, 7, 'Newspaper', 0, 'some description', 'newspaper'),
(27, 7, 'Horror', 0, 'some description', 'horror'),
(28, 7, 'Fiction', 0, 'some description', 'fiction'),
(29, 7, 'History', 0, 'some description', 'history'),
(30, 9, 'Furniture', 0, 'some description', 'furniture'),
(31, 7, 'Religion', 0, 'Religious books, CDs', 'religion'),
(33, 9, 'Gifts', 0, 'Desc', 'gifts'),
(34, 3, 'Groceries', 1, 'Groceries Product Category', 'groceriespc'),
(36, 6, 'Brand New', 1, 'Brand new vehicles', 'brand-new');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE IF NOT EXISTS `product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(130) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `image_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `name`, `description`, `image_path`, `image`) VALUES
(1, 'test', 'dfsdfsdf', '1459735_10200942852839169_1953587393_n.jpg', ''),
(2, 'dfgdfgdfg', NULL, 'wolves-hunt-aurochs.jpg', NULL),
(3, 'fdgdfgdfgdfg', NULL, '1459735_10200942852839169_1953587393_n.jpg', ''),
(4, NULL, NULL, 'book1.jpg', ''),
(5, NULL, NULL, 'book3.jpg', ''),
(6, NULL, NULL, 'book10.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_productcategory`
--

CREATE TABLE IF NOT EXISTS `product_productcategory` (
  `product_id` int(11) NOT NULL,
  `productcategory_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`productcategory_id`),
  KEY `IDX_9156E6914584665A` (`product_id`),
  KEY `IDX_9156E691E26A32B1` (`productcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_productcategory`
--

INSERT INTO `product_productcategory` (`product_id`, `productcategory_id`) VALUES
(17, 29),
(18, 31),
(19, 31),
(20, 31),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 33),
(30, 33),
(31, 33),
(32, 33),
(33, 30),
(33, 31),
(33, 33),
(33, 34),
(34, 34),
(35, 34),
(36, 34),
(37, 34),
(38, 34),
(39, 34),
(40, 34),
(41, 34),
(42, 34),
(43, 34),
(44, 5),
(45, 5),
(46, 5),
(47, 5),
(48, 2),
(49, 2),
(50, 3),
(51, 5),
(52, 5),
(53, 31),
(54, 31),
(55, 31),
(56, 31),
(57, 31),
(58, 2),
(59, 2),
(59, 5),
(60, 2),
(60, 5),
(61, 2),
(61, 5),
(62, 2),
(62, 3),
(62, 5),
(63, 2),
(63, 3),
(63, 5),
(64, 2),
(64, 5),
(65, 2),
(65, 3),
(65, 4),
(65, 5),
(66, 2),
(66, 3),
(66, 4),
(66, 5),
(67, 2),
(67, 3),
(67, 4),
(67, 5),
(68, 21),
(68, 36),
(69, 36),
(70, 36),
(71, 36),
(72, 36),
(73, 36),
(74, 36),
(75, 36),
(76, 36);

-- --------------------------------------------------------

--
-- Table structure for table `product_productimage`
--

CREATE TABLE IF NOT EXISTS `product_productimage` (
  `product_id` int(11) NOT NULL,
  `productimage_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`productimage_id`),
  KEY `IDX_9854748E4584665A` (`product_id`),
  KEY `IDX_9854748E9834DFA0` (`productimage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_productimage`
--

INSERT INTO `product_productimage` (`product_id`, `productimage_id`) VALUES
(17, 4),
(17, 5),
(17, 6),
(61, 2),
(61, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_section`
--

CREATE TABLE IF NOT EXISTS `product_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FCAA615F989D9B62` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `product_section`
--

INSERT INTO `product_section` (`id`, `name`, `enabled`, `description`, `slug`) VALUES
(1, 'Clothing', 1, 'Clothing', NULL),
(2, 'Electronics', 1, 'Electronics', NULL),
(3, 'Services', 1, 'Services', NULL),
(4, 'Food & Drinks', 1, 'Food & Drinks', NULL),
(5, 'Professionals', 1, 'Description', NULL),
(6, 'Auto', 1, 'Description', NULL),
(7, 'Books & Magazines', 1, 'Description', NULL),
(8, 'Educational', 1, 'Description', NULL),
(9, 'Home & Living', 1, 'Description', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_storeproductcategory`
--

CREATE TABLE IF NOT EXISTS `product_storeproductcategory` (
  `product_id` int(11) NOT NULL,
  `storeproductcategory_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`storeproductcategory_id`),
  KEY `IDX_766A10DE4584665A` (`product_id`),
  KEY `IDX_766A10DE4FD8C611` (`storeproductcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_storeproductcategory`
--

INSERT INTO `product_storeproductcategory` (`product_id`, `storeproductcategory_id`) VALUES
(17, 6),
(18, 6),
(19, 6),
(20, 6),
(25, 8),
(26, 8),
(27, 8),
(28, 8),
(29, 9),
(30, 9),
(31, 9),
(32, 9),
(33, 16),
(34, 14),
(35, 10),
(36, 13),
(37, 11),
(38, 14),
(39, 16),
(40, 12),
(41, 17),
(42, 14),
(43, 10),
(44, 18),
(45, 18),
(46, 18),
(47, 18),
(48, 19),
(49, 19),
(50, 19),
(51, 18),
(52, 18),
(53, 5),
(54, 4),
(55, 5),
(56, 4),
(57, 4),
(58, 22),
(59, 20),
(59, 22),
(60, 22),
(61, 20),
(61, 22),
(62, 20),
(62, 21),
(63, 20),
(64, 20),
(65, 20),
(66, 20),
(67, 20),
(68, 24),
(69, 23),
(69, 24),
(69, 25),
(70, 23),
(70, 24),
(71, 23),
(72, 23),
(73, 23),
(74, 23),
(74, 25),
(75, 23),
(75, 25),
(76, 25);

-- --------------------------------------------------------

--
-- Table structure for table `related_prods`
--

CREATE TABLE IF NOT EXISTS `related_prods` (
  `product_id` int(11) NOT NULL,
  `related_product_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`related_product_id`),
  KEY `IDX_5519BD64584665A` (`product_id`),
  KEY `IDX_5519BD6CF496EEA` (`related_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `related_prods`
--

INSERT INTO `related_prods` (`product_id`, `related_product_id`) VALUES
(17, 18),
(34, 39),
(34, 40),
(34, 41),
(38, 39),
(39, 39),
(44, 45),
(45, 44),
(53, 25),
(53, 26);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `billing_first_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_last_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address` longtext COLLATE utf8_unicode_ci,
  `billing_city` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_postalcode` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_phone` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_first_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_last_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address` longtext COLLATE utf8_unicode_ci,
  `shipping_city` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_postalcode` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_billing_same` tinyint(1) DEFAULT NULL,
  `order_number` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_method` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_cost` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_shipped` tinyint(1) DEFAULT NULL,
  `is_viewed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E54BC005A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `user_id`, `created`, `updated`, `billing_first_name`, `billing_last_name`, `billing_email`, `billing_address`, `billing_city`, `billing_state`, `billing_postalcode`, `billing_country`, `billing_phone`, `shipping_first_name`, `shipping_last_name`, `shipping_email`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_postalcode`, `shipping_country`, `shipping_phone`, `shipping_billing_same`, `order_number`, `payment_method`, `shipping_method`, `shipping_cost`, `total`, `is_shipped`, `is_viewed`) VALUES
(1, NULL, '2008-01-01 00:00:00', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, '2008-01-01 00:00:00', '2008-01-01 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, '2013-12-22 02:08:51', '2013-12-22 02:08:51', 'o', 'o', 'ze@ze.com', 'o', 'o', 'o', 'o', NULL, 'o', 'o', 'o', 'ze@ze.com', 'o', 'o', 'o', 'o', NULL, 'o', NULL, '1387656531', 'Cash On Delivery', 'Delivery In Dhaka', '0', '2940', NULL, NULL),
(7, NULL, '2013-12-22 02:09:35', '2013-12-22 02:09:35', 'o', 'o', 'ze@ze.com', 'o', 'o', 'o', 'o', NULL, 'o', 'o', 'o', 'ze@ze.com', 'o', 'o', 'o', 'o', NULL, 'o', NULL, '1387656575', 'Cash On Delivery', 'Delivery In Dhaka', '0', '0', NULL, NULL),
(8, NULL, '2013-12-22 02:10:15', '2013-12-22 02:10:15', 'o', 'o', 'ze@ze.com', 'o', 'o', 'o', 'o', NULL, 'o', 'o', 'o', 'ze@ze.com', 'o', 'o', 'o', 'o', NULL, 'o', NULL, '1387656615', 'Cash On Delivery', 'Delivery In Dhaka', '0', '0', NULL, NULL),
(9, NULL, '2013-12-22 02:10:43', '2013-12-22 02:10:43', 'o', 'o', 'ze@ze.com', 'o', 'o', 'o', 'o', NULL, 'o', 'o', 'o', 'ze@ze.com', 'o', 'o', 'o', 'o', NULL, 'o', NULL, '1387656642', 'Cash On Delivery', 'Delivery In Dhaka', '0', '0', NULL, NULL),
(10, NULL, '2013-12-23 14:32:32', '2013-12-23 14:32:32', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', NULL, '1387787552', 'Cash On Delivery', 'Delivery In Dhaka', '0', '216', NULL, NULL),
(11, NULL, '2013-12-23 14:36:19', '2013-12-23 14:36:19', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', NULL, '1387787779', 'Cash On Delivery', 'Delivery In Dhaka', '0', '876', NULL, NULL),
(12, NULL, '2013-12-23 14:41:02', '2013-12-23 14:41:02', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', NULL, '1387788062', 'Cash On Delivery', 'Delivery In Dhaka', '0', '205', NULL, NULL),
(13, NULL, '2013-12-23 14:49:51', '2013-12-23 14:49:51', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', NULL, '1387788590', 'Cash On Delivery', 'Delivery In Dhaka', '0', '205', NULL, NULL),
(14, NULL, '2013-12-23 14:55:50', '2013-12-23 14:55:50', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', 'zahid', 'eshaque', 'zeshaq@gmail.com', 'house 33 road 22', 'dhaka', 'dhaka', '1212', NULL, '4234234324234', NULL, '1387788950', 'Cash On Delivery', 'Delivery In Dhaka', '0', '876', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_item`
--

CREATE TABLE IF NOT EXISTS `sale_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `product_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A35551FB4A7E4868` (`sale_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sale_item`
--

INSERT INTO `sale_item` (`id`, `sale_id`, `created`, `updated`, `product_name`, `price`, `quantity`) VALUES
(1, 6, '2013-12-22 02:08:51', '2013-12-22 02:08:51', 'Plain Hijab V', '490', 6),
(2, 10, '2013-12-23 14:32:32', '2013-12-23 14:32:32', 'Ihram A', '216', 1),
(3, 11, '2013-12-23 14:36:19', '2013-12-23 14:36:19', 'The World of Noble Angels', '205', 1),
(4, 11, '2013-12-23 14:36:19', '2013-12-23 14:36:19', 'Family Leadership', '346', 1),
(5, 11, '2013-12-23 14:36:19', '2013-12-23 14:36:19', 'Jesus, Prophet of Islam', '325', 1),
(6, 12, '2013-12-23 14:41:02', '2013-12-23 14:41:02', 'The World of Noble Angels', '205', 1),
(7, 13, '2013-12-23 14:49:51', '2013-12-23 14:49:51', 'The World of Noble Angels', '205', 1),
(8, 14, '2013-12-23 14:55:50', '2013-12-23 14:55:50', 'The World of Noble Angels', '205', 1),
(9, 14, '2013-12-23 14:55:50', '2013-12-23 14:55:50', 'Family Leadership', '346', 1),
(10, 14, '2013-12-23 14:55:51', '2013-12-23 14:55:51', 'Jesus, Prophet of Islam', '325', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE IF NOT EXISTS `shipping_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`id`, `name`, `cost`) VALUES
(1, 'Delivery In Dhaka', '0'),
(2, 'Delivery Outside Dhaka', '100'),
(3, 'In store pickup', '0');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8_unicode_ci,
  `store_category_id` int(11) NOT NULL,
  `store_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_page` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `profile_image_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coverphoto_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coverphoto_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `use_store_layout` tinyint(1) DEFAULT NULL,
  `use_site_layout` tinyint(1) DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_plus` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `meta_key_words` longtext COLLATE utf8_unicode_ci,
  `featured` tinyint(1) DEFAULT NULL,
  `viewed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FF575877989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_FF575877BC9AD0C8` (`store_name`),
  KEY `IDX_FF575877CCD3EA7C` (`store_category_id`),
  KEY `IDX_FF575877A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=135 ;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `description`, `store_category_id`, `store_name`, `facebook_page`, `twitter`, `enabled`, `user_id`, `profile_image_path`, `profile_image`, `coverphoto_path`, `coverphoto_image`, `web_address`, `short_description`, `use_store_layout`, `use_site_layout`, `slug`, `email`, `phone`, `address`, `google_plus`, `approved`, `meta_key_words`, `featured`, `viewed`) VALUES
(5, 'SEAN Publication aims to produce world-class knowledge-based books. Since its inception back in January 2013, SEAN Publication set a target to produce books that would compete globally. It is actively working toward publishing knowledge-based books in various fields. Currently, it enlightens upon Islamic Lifestyle, Marriage, Leadership, Entrepreneurship, Management etc.', 30, 'SEAN Publication', NULL, NULL, 1, 15, 'logo.jpg', '', 'Cover-Photo-New.jpg', '/var/tmp/phpbJ7wE1', 'sean-pub', 'Knowledge-based World Class Books', 1, 0, 'sean-pulication', '', '', '', NULL, 1, NULL, 1, NULL),
(6, 'Lights of Life is a non-profit Islamic boutique. Yes! Non-profit, which means you can buy whatever you like at their originial prices! Our products include hijabs, scarves, books, CDs, gift items etc.\r\n\r\nThe main objective of Lights of Life is to please the Almighty and we make no profit from our sales. Our method of pleasing Allah is to spread the knowledge of Islam and promote the beauty of Islam, in shaa Allah!', 28, 'Lights of Life', NULL, NULL, 1, 15, '(JPG)LOL_V3_Updated.jpg', '', 'Lights.jpg', NULL, 'lightoflife', 'Non-Profit Islamic Boutique', 1, 0, 'lights-of-life', '', '', '', NULL, 1, NULL, 1, NULL),
(7, '100% Chemical-Free Products for both Wholesale and Retail', 29, 'Pure Life', NULL, NULL, 1, 15, 'Pure-Life-V2.jpg', '', 'Cover.jpg', '/var/tmp/phpzigjIt', 'purelife', '100% Chemical-Free Products', 1, 0, 'pure-life', '', '', '', NULL, 1, NULL, 1, NULL),
(8, 'Towels and Ihram Clothing Line', 13, 'Nazeef Supplies', NULL, NULL, 1, 15, 'NazeefV2.png', '', 'CF.png', NULL, 'nazeef', 'Towels and Ihram Clothing Line', 1, 0, 'nazeef-supplies', '', '', '', NULL, 1, NULL, 1, NULL),
(9, 'Ahoy, Hyde Parkers', 19, 'Hyde Park', NULL, NULL, 0, 15, 'logo.jpg', NULL, 'cover.jpg', NULL, 'www.123456.com', 'Ahoy, Hyde Parkers', 1, 0, 'hyde-park', 'demo@halalneeds.com', '01913 000 000', '21 Hare Road, Dhaka', NULL, 0, NULL, 1, NULL),
(10, 'Oh no, there we go!', 31, 'SkidmarX', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', '/var/tmp/phpeP6TrI', 'halalneeds.com', 'Oh no, there we go!', 1, 0, 'skidmarx', 'ze@zeteq.com', '01913 000 000', '21 Hare Road, Dhaka', NULL, 1, NULL, 1, NULL),
(11, NULL, 12, 'ghfghf', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, '2343423442343', 0, 0, 'fghfghfgh', 'ze@sdf.com', '4234234', NULL, NULL, 1, NULL, 1, NULL),
(12, NULL, 12, 'ABC Sample Store', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', 0, 0, 'abc-sample-store', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(13, NULL, 12, 'The Awesome Store', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'the-awesome-store', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(15, NULL, 12, 'Demo Store 1', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-1', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(16, NULL, 13, 'Demo Store 2', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-2', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(17, NULL, 14, 'Demo Store 3', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-3', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(18, NULL, 18, 'Demo Store 4', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-4', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(19, NULL, 19, 'Demo Store 5', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-5', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(20, NULL, 20, 'Demo Store 6', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-6', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(21, NULL, 21, 'Demo Store 7', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-7', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(22, NULL, 22, 'Demo Store 8', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-8', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(23, NULL, 28, 'Demo Store 9', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-9', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(24, NULL, 29, 'Demo Store 10', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-10', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(25, NULL, 30, 'Demo Store 11', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-11', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(26, NULL, 31, 'Demo Store 12', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-12', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(27, NULL, 12, 'Demo Store 13', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-13', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(28, NULL, 13, 'Demo Store 14', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-14', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(29, NULL, 14, 'Demo Store 15', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-15', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(30, NULL, 18, 'Demo Store 16', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-16', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(31, NULL, 19, 'Demo Store 17', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-17', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(32, NULL, 20, 'Demo Store 18', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-18', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(33, NULL, 21, 'Demo Store 19', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-19', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(34, NULL, 22, 'Demo Store 20', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-20', 'info@test.com', '23434', NULL, NULL, 1, NULL, 1, NULL),
(44, NULL, 20, 'Demo Store 30', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-30', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(45, NULL, 12, 'Demo Store 31', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-31', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(46, NULL, 13, 'Demo Store 32', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-32', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(47, NULL, 14, 'Demo Store 33', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-33', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(48, NULL, 18, 'Demo Store 34', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-34', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(49, NULL, 19, 'Demo Store 35', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-35', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(50, NULL, 20, 'Demo Store 36', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-36', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(51, NULL, 21, 'Demo Store 37', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-37', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(52, NULL, 22, 'Demo Store 38', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-38', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(53, NULL, 28, 'Demo Store 39', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-39', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(54, NULL, 29, 'Demo Store 40', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-40', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(55, NULL, 30, 'Demo Store 41', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-41', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(56, NULL, 31, 'Demo Store 42', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-42', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(57, NULL, 12, 'Demo Store 43', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-43', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(58, NULL, 13, 'Demo Store 44', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-44', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(59, NULL, 14, 'Demo Store 45', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-45', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(60, NULL, 18, 'Demo Store 46', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-46', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(61, NULL, 19, 'Demo Store 47', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-47', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(62, NULL, 20, 'Demo Store 48', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-48', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(63, NULL, 21, 'Demo Store 49', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-49', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(64, NULL, 22, 'Demo Store 50', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-50', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(65, NULL, 28, 'Demo Store 51', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-51', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(66, NULL, 29, 'Demo Store 52', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-52', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(67, NULL, 30, 'Demo Store 53', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-53', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(68, NULL, 31, 'Demo Store 54', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-54', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(69, NULL, 12, 'Demo Store 55', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-55', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(70, NULL, 13, 'Demo Store 56', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-56', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(71, NULL, 14, 'Demo Store 57', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-57', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(72, NULL, 18, 'Demo Store 58', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-58', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(73, NULL, 19, 'Demo Store 59', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-59', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(74, NULL, 20, 'Demo Store 60', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-60', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(75, NULL, 21, 'Demo Store 61', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-61', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(76, NULL, 22, 'Demo Store 62', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-62', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(77, NULL, 28, 'Demo Store 63', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-63', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(78, NULL, 29, 'Demo Store 64', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-64', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(79, NULL, 30, 'Demo Store 65', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-65', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(80, NULL, 31, 'Demo Store 66', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-66', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(81, NULL, 12, 'Demo Store 67', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-67', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(82, NULL, 13, 'Demo Store 68', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-68', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(83, NULL, 14, 'Demo Store 69', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-69', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(84, NULL, 18, 'Demo Store 70', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-70', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(85, NULL, 19, 'Demo Store 71', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-71', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(86, NULL, 20, 'Demo Store 72', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-72', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(87, NULL, 21, 'Demo Store 73', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-73', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(88, NULL, 22, 'Demo Store 74', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-74', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(89, NULL, 28, 'Demo Store 75', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-75', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(90, NULL, 29, 'Demo Store 76', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-76', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(91, NULL, 30, 'Demo Store 77', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-77', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(92, NULL, 31, 'Demo Store 78', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-78', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(93, NULL, 12, 'Demo Store 79', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-79', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(94, NULL, 13, 'Demo Store 80', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-80', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(95, NULL, 14, 'Demo Store 81', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-81', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(96, NULL, 18, 'Demo Store 82', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-82', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(97, NULL, 19, 'Demo Store 83', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-83', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(98, NULL, 20, 'Demo Store 84', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-84', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(99, NULL, 21, 'Demo Store 85', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-85', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(100, NULL, 22, 'Demo Store 86', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-86', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(101, NULL, 28, 'Demo Store 87', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-87', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(102, NULL, 29, 'Demo Store 88', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-88', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(103, NULL, 30, 'Demo Store 89', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-89', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(104, NULL, 31, 'Demo Store 90', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-90', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(105, NULL, 12, 'Demo Store 91', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-91', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(106, NULL, 13, 'Demo Store 92', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-92', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(107, NULL, 14, 'Demo Store 93', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-93', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(108, NULL, 18, 'Demo Store 94', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-94', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(109, NULL, 19, 'Demo Store 95', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-95', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(110, NULL, 20, 'Demo Store 96', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-96', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(111, NULL, 21, 'Demo Store 97', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-97', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(112, NULL, 22, 'Demo Store 98', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-98', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(113, NULL, 28, 'Demo Store 99', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-99', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(114, NULL, 29, 'Demo Store 100', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-100', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(115, NULL, 30, 'Demo Store 101', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-101', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(116, NULL, 31, 'Demo Store 102', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-102', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(117, NULL, 12, 'Demo Store 103', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-103', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(118, NULL, 13, 'Demo Store 104', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-104', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(119, NULL, 14, 'Demo Store 105', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-105', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(120, NULL, 18, 'Demo Store 106', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-106', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(121, NULL, 19, 'Demo Store 107', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-107', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(122, NULL, 20, 'Demo Store 108', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-108', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(123, NULL, 21, 'Demo Store 109', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-109', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(124, NULL, 22, 'Demo Store 110', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-110', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(125, NULL, 28, 'Demo Store 111', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-111', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(126, NULL, 29, 'Demo Store 112', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-112', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(127, NULL, 30, 'Demo Store 113', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-113', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(128, NULL, 31, 'Demo Store 114', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-114', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(129, NULL, 12, 'Demo Store 115', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-115', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(130, NULL, 13, 'Demo Store 116', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-116', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(131, NULL, 14, 'Demo Store 117', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-117', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(132, NULL, 18, 'Demo Store 118', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-118', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(133, NULL, 19, 'Demo Store 119', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-119', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL),
(134, NULL, 20, 'Demo Store 120', NULL, NULL, 1, 15, 'logo.jpg', '', 'cover.jpg', NULL, NULL, 'A brief description of the store', NULL, NULL, 'demo-store-120', 'info@test.com', '23434', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_category`
--

CREATE TABLE IF NOT EXISTS `store_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_section_id` int(11) NOT NULL,
  `name` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_383B663B989D9B62` (`slug`),
  KEY `IDX_383B663BF6CAB897` (`store_section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `store_category`
--

INSERT INTO `store_category` (`id`, `store_section_id`, `name`, `enabled`, `description`, `slug`) VALUES
(12, 4, 'Textile', 0, 'some description', 'textile'),
(13, 4, 'Garments', 0, 'some description', 'garments'),
(14, 4, 'Carpets', 0, 'some description', 'carpets'),
(18, 5, 'Drug Store', 0, 'some description', 'drug-store'),
(19, 7, 'Clothing', 0, 'some description', 'clothing'),
(20, 7, 'Furniture Store', 0, 'some description', 'furniture'),
(21, 7, 'Electronics Stores', 0, 'some description', 'electronics'),
(22, 7, 'stationeries', 0, 'some description', 'stationaries'),
(28, 7, 'Boutique', 0, 'Stores housing different types of product ranges.', 'boutique'),
(29, 7, 'Groceries', 1, 'Groceries', 'groceries'),
(30, 2, 'Book Store', 1, 'Book Store', 'book-store'),
(31, 7, 'Automotive', 0, 'Automotive', 'automotive');

-- --------------------------------------------------------

--
-- Table structure for table `store_product_category`
--

CREATE TABLE IF NOT EXISTS `store_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `name` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B141E088989D9B62` (`slug`),
  KEY `IDX_B141E088B092A811` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `store_product_category`
--

INSERT INTO `store_product_category` (`id`, `store_id`, `name`, `enabled`, `description`, `slug`) VALUES
(4, 5, 'Religious Books', 1, 'Desc', 'religious-books'),
(5, 5, 'Marriage', 1, 'Desc', 'marriage'),
(6, 6, 'Books and CDs', 1, 'Islamic Books, Mushaf, Lectures', 'books-and-cds'),
(7, 6, 'Hijabs', 1, 'Hijabs and Abayas', 'hijabs'),
(8, 6, 'Scarves', 1, 'Selections of great Scarves', 'scarves'),
(9, 6, 'Gift Items', 1, 'Gifts and Souvenirs', 'gift-items'),
(10, 7, 'Spices', 1, 'Spices', 'spices'),
(11, 7, 'Dairy', 1, 'Dairy', 'dairy'),
(12, 7, 'Pulses', 1, 'Pulses', 'pulses'),
(13, 7, 'Seeds', 1, 'Seeds', 'seeds'),
(14, 7, 'Natural', 1, 'Natural', 'natural'),
(16, 7, 'Oil', 1, 'Oil', 'oil'),
(17, 7, 'Rice', 1, 'Rice', 'rice'),
(18, 8, 'Towels', 1, 'All purpose towels', 'towels'),
(19, 8, 'Ihram Clothing', 1, 'Ihram clothing for men and women', 'ihram'),
(20, 9, 'Casual', 1, 'Casual', 'casual'),
(21, 9, 'Golf', 1, 'Golf', 'golf'),
(22, 9, 'Runners', 1, 'Runners', 'runners'),
(23, 10, 'Sports', 1, 'Sports', 'sports'),
(24, 10, 'Luxury', 1, 'Luxury', 'luxury'),
(25, 10, 'Roadsters', 1, 'Roadsters', 'roadsters');

-- --------------------------------------------------------

--
-- Table structure for table `store_section`
--

CREATE TABLE IF NOT EXISTS `store_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_347B5B08989D9B62` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `store_section`
--

INSERT INTO `store_section` (`id`, `name`, `enabled`, `description`, `slug`) VALUES
(1, 'Educational', 1, 'Educational Institutes such as schools, colleges, training etc.', 'Educational'),
(2, 'Media & Publication', 1, 'Educational Institutes such as school, college, training etc', 'media-and-publication'),
(4, 'Manufacturer', 1, 'Some details here', 'manufacturer'),
(5, 'Health Care', 1, 'Some details here', 'health-care'),
(6, 'Trading', 1, 'Some details here', 'trading'),
(7, 'Retailers', 1, 'Some details here', 'retailers'),
(10, 'Religious Products & Services', 0, 'Description', 'religious-products-and-services'),
(11, 'Clothing & Accessories', 1, NULL, 'clothing-accessories'),
(12, 'Restaurants & Food Related', 0, NULL, 'restaurants-food-related'),
(13, 'Engineering', 1, NULL, 'engineering'),
(14, 'Computer & Electronics', 1, NULL, 'computer-electronics');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `activation_code` varchar(225) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `salt`, `password`, `is_active`, `activation_code`, `email`) VALUES
(15, NULL, '484d9733c2ffcbda0c9ef2f48f38111f', 'ac2570244cc3b4212a20bfd3ba888a549b468883', 1, '77cqgYIVdyhqrlG', 'zeshaq@gmail.com'),
(21, NULL, 'a3670cc6dd054839a1fea5de06c50aa6', '182248bdbcd8752f553e4332beb4ddcf0ea90c1d', 1, NULL, 'linkon666@gmail.com'),
(22, NULL, 'a065779dbfcdb2d375b0d1b24892d14b', 'f54999d939e655393d1bcc20dc62d87f76bd7f47', 1, 't6G5C5uAwe3xpfDi1dMNwLqW2', 'shomokalin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(15, 1),
(15, 2),
(21, 1),
(21, 2),
(22, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B75AA1164F` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `FK_BA388B75F7D6850` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_method` (`id`),
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `FK_F0FE25271AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_F0FE25274584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_81398E09A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_140AB620B092A811` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04ADB092A811` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`);

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `FK_CDFC73564B44BC51` FOREIGN KEY (`product_section_id`) REFERENCES `product_section` (`id`);

--
-- Constraints for table `product_productcategory`
--
ALTER TABLE `product_productcategory`
  ADD CONSTRAINT `FK_9156E6914584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9156E691E26A32B1` FOREIGN KEY (`productcategory_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_productimage`
--
ALTER TABLE `product_productimage`
  ADD CONSTRAINT `FK_9854748E4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9854748E9834DFA0` FOREIGN KEY (`productimage_id`) REFERENCES `product_image` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_storeproductcategory`
--
ALTER TABLE `product_storeproductcategory`
  ADD CONSTRAINT `FK_766A10DE4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_766A10DE4FD8C611` FOREIGN KEY (`storeproductcategory_id`) REFERENCES `store_product_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `related_prods`
--
ALTER TABLE `related_prods`
  ADD CONSTRAINT `FK_5519BD64584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_5519BD6CF496EEA` FOREIGN KEY (`related_product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `FK_E54BC005A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `sale_item`
--
ALTER TABLE `sale_item`
  ADD CONSTRAINT `FK_A35551FB4A7E4868` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `FK_FF575877A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_FF575877CCD3EA7C` FOREIGN KEY (`store_category_id`) REFERENCES `store_category` (`id`);

--
-- Constraints for table `store_category`
--
ALTER TABLE `store_category`
  ADD CONSTRAINT `FK_383B663BF6CAB897` FOREIGN KEY (`store_section_id`) REFERENCES `store_section` (`id`);

--
-- Constraints for table `store_product_category`
--
ALTER TABLE `store_product_category`
  ADD CONSTRAINT `FK_B141E088B092A811` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `acme_roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
