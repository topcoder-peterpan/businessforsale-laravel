# ************************************************************
# Sequel Ace SQL dump
# Version 3038
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.23)
# Database: adlisting_master
# Generation Time: 2021-12-21 09:08:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ad_features
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ad_features`;

CREATE TABLE `ad_features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ad_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_features_ad_id_foreign` (`ad_id`),
  CONSTRAINT `ad_features_ad_id_foreign` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table ad_galleries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ad_galleries`;

CREATE TABLE `ad_galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ad_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table ad_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ad_tags`;

CREATE TABLE `ad_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ad_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_tags_ad_id_foreign` (`ad_id`),
  KEY `ad_tags_tag_id_foreign` (`tag_id`),
  CONSTRAINT `ad_tags_ad_id_foreign` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ad_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table ads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ads`;

CREATE TABLE `ads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `brand_id` bigint unsigned NOT NULL,
  `city_id` bigint unsigned NOT NULL,
  `town_id` bigint unsigned NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condition` enum('used','new') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authenticity` enum('original','refurbished') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negotiable` tinyint(1) NOT NULL DEFAULT '0',
  `price` double(8,2) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `total_reports` int NOT NULL DEFAULT '0',
  `total_views` int NOT NULL DEFAULT '0',
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ads_customer_id_foreign` (`customer_id`),
  KEY `ads_category_id_foreign` (`category_id`),
  KEY `ads_brand_id_foreign` (`brand_id`),
  KEY `ads_city_id_foreign` (`city_id`),
  KEY `ads_town_id_foreign` (`town_id`),
  CONSTRAINT `ads_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ads_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ads_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ads_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ads_town_id_foreign` FOREIGN KEY (`town_id`) REFERENCES `towns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table blog_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_comments`;

CREATE TABLE `blog_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_comments_post_id_foreign` (`post_id`),
  CONSTRAINT `blog_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table brands
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` longtext COLLATE utf8mb4_unicode_ci,
  `order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cities_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms`;

CREATE TABLE `cms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `index1_main_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index1_counter_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index1_mobile_app_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index2_search_filter_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index2_get_membership_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index3_search_filter_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_body` text COLLATE utf8mb4_unicode_ci,
  `about_video_thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_body` text COLLATE utf8mb4_unicode_ci,
  `privacy_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_body` text COLLATE utf8mb4_unicode_ci,
  `contact_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `get_membership_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `get_membership_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pricing_plan_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ads_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_messenger_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_favorite_ads_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_overview_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_post_ads_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_my_ads_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_plan_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_account_setting_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posting_rules_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posting_rules_body` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `cms` WRITE;
/*!40000 ALTER TABLE `cms` DISABLE KEYS */;

INSERT INTO `cms` (`id`, `index1_main_banner`, `index1_counter_background`, `index1_mobile_app_banner`, `index2_search_filter_background`, `index2_get_membership_background`, `index3_search_filter_background`, `terms_background`, `terms_body`, `about_video_thumb`, `about_background`, `about_body`, `privacy_background`, `privacy_body`, `contact_background`, `get_membership_background`, `get_membership_image`, `pricing_plan_background`, `faq_background`, `ads_background`, `blog_background`, `dashboard_messenger_background`, `dashboard_favorite_ads_background`, `dashboard_overview_background`, `dashboard_post_ads_background`, `dashboard_my_ads_background`, `dashboard_plan_background`, `dashboard_account_setting_background`, `posting_rules_background`, `posting_rules_body`, `created_at`, `updated_at`)
VALUES
	(1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,'',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','2021-12-21 15:07:17','2021-12-21 15:07:17');

/*!40000 ALTER TABLE `cms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend/image/default.png',
  `last_seen` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_username_unique` (`username`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_phone_unique` (`phone`),
  UNIQUE KEY `customers_web_unique` (`web`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table emails
# ------------------------------------------------------------

DROP TABLE IF EXISTS `emails`;

CREATE TABLE `emails` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emails_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table faq_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faq_categories`;

CREATE TABLE `faq_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faq_categories_name_unique` (`name`),
  UNIQUE KEY `faq_categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `faq_categories` WRITE;
/*!40000 ALTER TABLE `faq_categories` DISABLE KEYS */;

INSERT INTO `faq_categories` (`id`, `name`, `slug`, `icon`, `order`, `created_at`, `updated_at`)
VALUES
	(1,'Test','test','fas fa-italic',0,'2021-12-21 15:07:17','2021-12-21 15:07:17');

/*!40000 ALTER TABLE `faq_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table faqs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `faq_category_id` bigint unsigned NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faqs_faq_category_id_foreign` (`faq_category_id`),
  CONSTRAINT `faqs_faq_category_id_foreign` FOREIGN KEY (`faq_category_id`) REFERENCES `faq_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_name_unique` (`name`),
  UNIQUE KEY `languages_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table messengers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `messengers`;

CREATE TABLE `messengers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from_id` bigint unsigned NOT NULL,
  `to_id` bigint unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_super_admins_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1),
	(4,'2020_11_12_184107_create_permission_tables',1),
	(5,'2020_12_20_161856_create_tags_table',1),
	(6,'2020_12_20_161857_create_brands_table',1),
	(7,'2020_12_23_122556_create_contacts_table',1),
	(8,'2021_02_17_110211_create_testimonials_table',1),
	(9,'2021_07_07_125145_create_themes_table',1),
	(10,'2021_07_13_121453_create_cities_table',1),
	(11,'2021_07_13_121502_create_towns_table',1),
	(12,'2021_07_14_151623_create_wishlists_table',1),
	(13,'2021_08_21_174451_create_customers_table',1),
	(14,'2021_08_22_051131_create_categories_table',1),
	(15,'2021_08_22_051134_create_sub_categories_table',1),
	(16,'2021_08_22_051135_create_ads_table',1),
	(17,'2021_08_22_051199_create_posts_table',1),
	(18,'2021_08_22_051299_create_post_tag_table',1),
	(19,'2021_08_23_115402_create_settings_table',1),
	(20,'2021_08_25_061331_create_languages_table',1),
	(21,'2021_09_04_105120_create_blog_comments_table',1),
	(22,'2021_09_05_120235_create_ad_features_table',1),
	(23,'2021_09_05_120248_create_ad_galleries_table',1),
	(24,'2021_09_12_151348_create_ad_tags_table',1),
	(25,'2021_09_19_141812_create_plans_table',1),
	(26,'2021_09_19_152529_create_faq_categories_table',1),
	(27,'2021_11_13_114825_create_messengers_table',1),
	(28,'2021_11_14_093821_create_notifications_table',1),
	(29,'2021_11_14_095846_create_jobs_table',1),
	(30,'2021_11_15_112417_create_user_plans_table',1),
	(31,'2021_11_15_112949_create_transactions_table',1),
	(32,'2021_11_18_102445_add_fields_to_settings_table',1),
	(33,'2021_11_23_112531_add_fields_to_customers_table',1),
	(34,'2021_12_14_142236_create_emails_table',1),
	(35,'2021_12_14_142427_create_orders_table',1),
	(36,'2021_12_15_161624_create_module_settings_table',1),
	(37,'2021_12_18_134032_add_seo_fields_to_settings_table',1),
	(38,'2021_12_18_141044_add_socialite_column_to_customers_table',1),
	(39,'2021_12_18_153602_create_social_settings_table',1),
	(40,'2021_12_19_101413_create_cms_table',1),
	(41,'2021_12_19_113555_remove_fields_from_settings_table',1),
	(42,'2021_12_19_115130_create_payment_settings_table',1),
	(43,'2021_12_20_104309_add_fields_to_cms_table',1),
	(44,'2021_12_21_105713_create_faqs_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table model_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table model_has_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`)
VALUES
	(1,'App\\Models\\SuperAdmin',1);

/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table module_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module_settings`;

CREATE TABLE `module_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog` tinyint(1) NOT NULL DEFAULT '1',
  `newsletter` tinyint(1) NOT NULL DEFAULT '1',
  `language` tinyint(1) NOT NULL DEFAULT '1',
  `contact` tinyint(1) NOT NULL DEFAULT '1',
  `faq` tinyint(1) NOT NULL DEFAULT '1',
  `testimonial` tinyint(1) NOT NULL DEFAULT '1',
  `price_plan` tinyint(1) NOT NULL DEFAULT '1',
  `appearance` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `module_settings` WRITE;
/*!40000 ALTER TABLE `module_settings` DISABLE KEYS */;

INSERT INTO `module_settings` (`id`, `blog`, `newsletter`, `language`, `contact`, `faq`, `testimonial`, `price_plan`, `appearance`)
VALUES
	(1,1,1,1,1,1,1,1,1);

/*!40000 ALTER TABLE `module_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` int NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table payment_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payment_settings`;

CREATE TABLE `payment_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `paypal` tinyint(1) NOT NULL DEFAULT '1',
  `paypal_live_mode` tinyint(1) NOT NULL DEFAULT '0',
  `stripe` tinyint(1) NOT NULL DEFAULT '1',
  `razorpay` tinyint(1) NOT NULL DEFAULT '1',
  `paystack` tinyint(1) NOT NULL DEFAULT '1',
  `ssl_commerz` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `payment_settings` WRITE;
/*!40000 ALTER TABLE `payment_settings` DISABLE KEYS */;

INSERT INTO `payment_settings` (`id`, `paypal`, `paypal_live_mode`, `stripe`, `razorpay`, `paystack`, `ssl_commerz`, `created_at`, `updated_at`)
VALUES
	(1,0,0,0,0,0,0,NULL,NULL);

/*!40000 ALTER TABLE `payment_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`)
VALUES
	(1,'admin.create','super_admin','admin','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(2,'admin.view','super_admin','admin','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(3,'admin.update','super_admin','admin','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(4,'admin.delete','super_admin','admin','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(5,'role.create','super_admin','role','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(6,'role.view','super_admin','role','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(7,'role.update','super_admin','role','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(8,'role.delete','super_admin','role','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(9,'ad.create','super_admin','ad','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(10,'ad.view','super_admin','ad','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(11,'ad.update','super_admin','ad','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(12,'ad.delete','super_admin','ad','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(13,'category.create','super_admin','category','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(14,'category.view','super_admin','category','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(15,'category.update','super_admin','category','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(16,'category.delete','super_admin','category','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(17,'subcategory.create','super_admin','category','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(18,'subcategory.view','super_admin','category','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(19,'subcategory.update','super_admin','category','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(20,'subcategory.delete','super_admin','category','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(21,'newsletter.view','super_admin','newsletter','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(22,'newsletter.mailsend','super_admin','newsletter','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(23,'newsletter.delete','super_admin','newsletter','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(24,'brand.create','super_admin','brand','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(25,'brand.view','super_admin','brand','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(26,'brand.update','super_admin','brand','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(27,'brand.delete','super_admin','brand','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(28,'city.create','super_admin','Location','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(29,'city.view','super_admin','Location','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(30,'city.update','super_admin','Location','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(31,'city.delete','super_admin','Location','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(32,'town.create','super_admin','Location','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(33,'town.view','super_admin','Location','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(34,'town.update','super_admin','Location','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(35,'town.delete','super_admin','Location','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(36,'plan.create','super_admin','plan','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(37,'plan.view','super_admin','plan','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(38,'plan.update','super_admin','plan','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(39,'plan.delete','super_admin','plan','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(40,'post.create','super_admin','Blog','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(41,'post.view','super_admin','Blog','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(42,'post.update','super_admin','Blog','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(43,'post.delete','super_admin','Blog','2021-12-21 15:07:16','2021-12-21 15:07:16'),
	(44,'tag.create','super_admin','Blog','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(45,'tag.view','super_admin','Blog','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(46,'tag.update','super_admin','Blog','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(47,'tag.delete','super_admin','Blog','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(48,'testimonial.create','super_admin','testimonial','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(49,'testimonial.view','super_admin','testimonial','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(50,'testimonial.update','super_admin','testimonial','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(51,'testimonial.delete','super_admin','testimonial','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(52,'faqcategory.create','super_admin','faq','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(53,'faqcategory.view','super_admin','faq','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(54,'faqcategory.update','super_admin','faq','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(55,'faqcategory.delete','super_admin','faq','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(56,'faq.create','super_admin','faq','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(57,'faq.view','super_admin','faq','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(58,'faq.update','super_admin','faq','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(59,'faq.delete','super_admin','faq','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(60,'customer.view','super_admin','others','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(61,'setting.view','super_admin','others','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(62,'setting.update','super_admin','others','2021-12-21 15:07:17','2021-12-21 15:07:17'),
	(63,'contact.view','super_admin','others','2021-12-21 15:07:17','2021-12-21 15:07:17');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table plans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `plans`;

CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `ad_limit` int NOT NULL,
  `featured_limit` int NOT NULL,
  `customer_support` tinyint(1) NOT NULL,
  `multiple_image` tinyint(1) NOT NULL DEFAULT '1',
  `badge` tinyint(1) NOT NULL,
  `recommended` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plans_label_unique` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;

INSERT INTO `plans` (`id`, `label`, `price`, `ad_limit`, `featured_limit`, `customer_support`, `multiple_image`, `badge`, `recommended`, `created_at`, `updated_at`)
VALUES
	(1,'Basic',10.00,5,2,0,1,0,0,NULL,NULL),
	(2,'Standard',20.00,15,5,1,1,1,1,NULL,NULL),
	(3,'Premium',50.00,60,20,1,1,1,0,NULL,NULL);

/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_tag`;

CREATE TABLE `post_tag` (
  `post_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  KEY `post_tag_post_id_foreign` (`post_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `author_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `posts_author_id_foreign` (`author_id`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `super_admins` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table role_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
VALUES
	(1,1),
	(2,1),
	(3,1),
	(4,1),
	(5,1),
	(6,1),
	(7,1),
	(8,1),
	(9,1),
	(10,1),
	(11,1),
	(12,1),
	(13,1),
	(14,1),
	(15,1),
	(16,1),
	(17,1),
	(18,1),
	(19,1),
	(20,1),
	(21,1),
	(22,1),
	(23,1),
	(24,1),
	(25,1),
	(26,1),
	(27,1),
	(28,1),
	(29,1),
	(30,1),
	(31,1),
	(32,1),
	(33,1),
	(34,1),
	(35,1),
	(36,1),
	(37,1),
	(38,1),
	(39,1),
	(40,1),
	(41,1),
	(42,1),
	(43,1),
	(44,1),
	(45,1),
	(46,1),
	(47,1),
	(48,1),
	(49,1),
	(50,1),
	(51,1),
	(52,1),
	(53,1),
	(54,1),
	(55,1),
	(56,1),
	(57,1),
	(58,1),
	(59,1),
	(60,1),
	(61,1),
	(62,1),
	(63,1);

/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES
	(1,'superadmin','super_admin','2021-12-21 15:07:16','2021-12-21 15:07:16');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_address` longtext COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkdin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `android` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ios` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_css` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_script` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_script` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_featured_ad_limit` int NOT NULL DEFAULT '3',
  `free_ad_limit` int NOT NULL DEFAULT '5',
  `sidebar_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nav_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `default_layout` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seo_meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_meta_description` text COLLATE utf8mb4_unicode_ci,
  `seo_meta_keywords` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `name`, `email`, `support_email`, `phone`, `address`, `map_address`, `facebook`, `twitter`, `instagram`, `youtube`, `linkdin`, `android`, `ios`, `whatsapp`, `logo_image`, `logo_image2`, `favicon_image`, `header_css`, `header_script`, `body_script`, `free_featured_ad_limit`, `free_ad_limit`, `sidebar_color`, `nav_color`, `dark_mode`, `default_layout`, `created_at`, `updated_at`, `seo_meta_title`, `seo_meta_description`, `seo_meta_keywords`)
VALUES
	(1,'Site Name','example@mail.com',NULL,'634-564-564','U.S.A addresses by house number, Florida','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14607.607282694651!2d90.39911678036226!3d23.75088025342449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b888ad339cb5%3A0x20c70986185ad2ba!2sMogbazar%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1630902791750!5m2!1sen!2sbd\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>','https://facebook.com/zakirsoft','https://twitter.com/zakirsoft','https://instagram.com/zakirsoft','https://www.youtube.com/channel/UCMSp_qPtYbaUMjEICDLhDCQ','https://www.linkedin.com/in/zakirsoft','https://play.google.com/store/apps/details?id=com.zakirsoft','https://play.google.com/store/apps/details?id=com.zakirsoft','https://web.whatsapp.com/','frontend/images/logo.png','frontend/images/logo-white.png','frontend/images/icon/notepad.png',NULL,NULL,NULL,1,3,NULL,NULL,0,1,'2021-12-21 15:07:17','2021-12-21 15:07:17',NULL,NULL,NULL);

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table social_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `social_settings`;

CREATE TABLE `social_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `google` tinyint(1) NOT NULL DEFAULT '1',
  `facebook` tinyint(1) NOT NULL DEFAULT '1',
  `twitter` tinyint(1) NOT NULL DEFAULT '1',
  `linkedin` tinyint(1) NOT NULL DEFAULT '1',
  `github` tinyint(1) NOT NULL DEFAULT '1',
  `gitlab` tinyint(1) NOT NULL DEFAULT '1',
  `bitbucket` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `social_settings` WRITE;
/*!40000 ALTER TABLE `social_settings` DISABLE KEYS */;

INSERT INTO `social_settings` (`id`, `google`, `facebook`, `twitter`, `linkedin`, `github`, `gitlab`, `bitbucket`, `created_at`, `updated_at`)
VALUES
	(1,0,0,0,0,0,0,0,'2021-12-21 15:07:17','2021-12-21 15:07:17');

/*!40000 ALTER TABLE `social_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sub_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sub_categories`;

CREATE TABLE `sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table super_admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `super_admins`;

CREATE TABLE `super_admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend/image/default.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `super_admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `super_admins` WRITE;
/*!40000 ALTER TABLE `super_admins` DISABLE KEYS */;

INSERT INTO `super_admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Admin','admin@mail.com','2021-12-21 15:07:17','$2y$10$afs0Hv7RyggBX840mOl55uYrZIEl122WWug7AyJrTQshCfzuK48ZW','backend/image/default.png','aPIzETF1cP','2021-12-21 15:07:17','2021-12-21 15:07:17');

/*!40000 ALTER TABLE `super_admins` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table testimonials
# ------------------------------------------------------------

DROP TABLE IF EXISTS `testimonials`;

CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stars` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table themes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `themes`;

CREATE TABLE `themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `home_page` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;

INSERT INTO `themes` (`id`, `home_page`, `created_at`, `updated_at`)
VALUES
	(1,1,'2021-12-21 15:07:17','2021-12-21 15:07:17');

/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table towns
# ------------------------------------------------------------

DROP TABLE IF EXISTS `towns`;

CREATE TABLE `towns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `city_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `towns_name_unique` (`name`),
  KEY `towns_city_id_foreign` (`city_id`),
  CONSTRAINT `towns_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_plan_id_foreign` (`plan_id`),
  KEY `transactions_customer_id_foreign` (`customer_id`),
  CONSTRAINT `transactions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table user_plans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_plans`;

CREATE TABLE `user_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `ad_limit` bigint unsigned NOT NULL DEFAULT '3',
  `featured_limit` bigint unsigned NOT NULL DEFAULT '0',
  `customer_support` tinyint(1) NOT NULL DEFAULT '0',
  `multiple_image` tinyint(1) NOT NULL DEFAULT '1',
  `badge` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_plans_customer_id_foreign` (`customer_id`),
  CONSTRAINT `user_plans_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table wishlists
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wishlists`;

CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ad_id` bigint unsigned NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
