-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2026 at 11:40 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint UNSIGNED NOT NULL,
  `log_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-08 04:09:25', '2026-10-08 04:09:25'),
(2, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-08 05:00:24', '2026-10-08 05:00:24'),
(3, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 22, NULL, NULL, '{\"old\": {\"value\": null, \"updated_at\": \"2026-10-08T08:03:33.000000Z\"}, \"attributes\": {\"value\": \"\", \"updated_at\": \"2026-10-08T10:34:12.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(4, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 27, NULL, NULL, '{\"old\": {\"value\": null, \"updated_at\": \"2026-10-08T08:03:33.000000Z\"}, \"attributes\": {\"value\": \"\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(5, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 36, NULL, NULL, '{\"attributes\": {\"id\": 36, \"key\": \"default_meta_description\", \"group\": \"general\", \"value\": \"Buy premium digital products and subscriptions online with instant delivery.\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(6, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 37, NULL, NULL, '{\"attributes\": {\"id\": 37, \"key\": \"default_meta_keywords\", \"group\": \"general\", \"value\": \"digital products, subscriptions, online store\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(7, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 38, NULL, NULL, '{\"attributes\": {\"id\": 38, \"key\": \"meta_home_title\", \"group\": \"general\", \"value\": \"\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(8, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 39, NULL, NULL, '{\"attributes\": {\"id\": 39, \"key\": \"meta_home_description\", \"group\": \"general\", \"value\": \"\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(9, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 40, NULL, NULL, '{\"attributes\": {\"id\": 40, \"key\": \"meta_products_title\", \"group\": \"general\", \"value\": \"Products\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(10, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 41, NULL, NULL, '{\"attributes\": {\"id\": 41, \"key\": \"meta_products_description\", \"group\": \"general\", \"value\": \"Browse our full catalogue of premium digital products.\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(11, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 42, NULL, NULL, '{\"attributes\": {\"id\": 42, \"key\": \"meta_about_title\", \"group\": \"general\", \"value\": \"About Us\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(12, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 43, NULL, NULL, '{\"attributes\": {\"id\": 43, \"key\": \"meta_about_description\", \"group\": \"general\", \"value\": \"\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(13, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 44, NULL, NULL, '{\"attributes\": {\"id\": 44, \"key\": \"meta_contact_title\", \"group\": \"general\", \"value\": \"Contact Us\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(14, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 45, NULL, NULL, '{\"attributes\": {\"id\": 45, \"key\": \"meta_contact_description\", \"group\": \"general\", \"value\": \"\", \"created_at\": \"2026-10-08T10:34:13.000000Z\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}}', NULL, '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(15, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-08 05:08:41', '2026-10-08 05:08:41'),
(16, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 46, NULL, NULL, '{\"attributes\": {\"id\": 46, \"key\": \"recaptcha_enabled\", \"group\": \"general\", \"value\": \"1\", \"created_at\": \"2026-10-08T10:46:49.000000Z\", \"updated_at\": \"2026-10-08T10:46:49.000000Z\"}}', NULL, '2026-10-08 05:16:49', '2026-10-08 05:16:49'),
(17, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 47, NULL, NULL, '{\"attributes\": {\"id\": 47, \"key\": \"recaptcha_site_key\", \"group\": \"general\", \"value\": \"6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI\", \"created_at\": \"2026-10-08T10:46:49.000000Z\", \"updated_at\": \"2026-10-08T10:46:49.000000Z\"}}', NULL, '2026-10-08 05:16:49', '2026-10-08 05:16:49'),
(18, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 48, NULL, NULL, '{\"attributes\": {\"id\": 48, \"key\": \"recaptcha_secret_key\", \"group\": \"general\", \"value\": \"6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe\", \"created_at\": \"2026-10-08T10:46:49.000000Z\", \"updated_at\": \"2026-10-08T10:46:49.000000Z\"}}', NULL, '2026-10-08 05:16:49', '2026-10-08 05:16:49'),
(19, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 27, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}, \"attributes\": {\"value\": null, \"updated_at\": \"2026-10-08T10:48:30.000000Z\"}}', NULL, '2026-10-08 05:18:30', '2026-10-08 05:18:30'),
(20, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 22, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"\", \"updated_at\": \"2026-10-08T10:34:12.000000Z\"}, \"attributes\": {\"value\": null, \"updated_at\": \"2026-10-08T10:48:30.000000Z\"}}', NULL, '2026-10-08 05:18:30', '2026-10-08 05:18:30'),
(21, 'settings', 'Setting created', 'App\\Models\\Setting', 'created', 49, 'App\\Models\\User', 1, '{\"attributes\": {\"id\": 49, \"key\": \"default_og_image\", \"group\": \"general\", \"value\": null, \"created_at\": \"2026-10-08T10:48:30.000000Z\", \"updated_at\": \"2026-10-08T10:48:30.000000Z\"}}', NULL, '2026-10-08 05:18:30', '2026-10-08 05:18:30'),
(22, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 38, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}, \"attributes\": {\"value\": null, \"updated_at\": \"2026-10-08T10:48:30.000000Z\"}}', NULL, '2026-10-08 05:18:30', '2026-10-08 05:18:30'),
(23, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 39, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}, \"attributes\": {\"value\": null, \"updated_at\": \"2026-10-08T10:48:30.000000Z\"}}', NULL, '2026-10-08 05:18:30', '2026-10-08 05:18:30'),
(24, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 43, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}, \"attributes\": {\"value\": null, \"updated_at\": \"2026-10-08T10:48:30.000000Z\"}}', NULL, '2026-10-08 05:18:30', '2026-10-08 05:18:30'),
(25, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 45, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"\", \"updated_at\": \"2026-10-08T10:34:13.000000Z\"}, \"attributes\": {\"value\": null, \"updated_at\": \"2026-10-08T10:48:30.000000Z\"}}', NULL, '2026-10-08 05:18:30', '2026-10-08 05:18:30'),
(26, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 46, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"1\", \"updated_at\": \"2026-10-08T10:46:49.000000Z\"}, \"attributes\": {\"value\": \"0\", \"updated_at\": \"2026-10-08T10:48:30.000000Z\"}}', NULL, '2026-10-08 05:18:30', '2026-10-08 05:18:30'),
(27, 'settings', 'Site settings updated', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"changed\": [\"site_name\", \"tagline\", \"currency_symbol\", \"site_description\", \"contact_email\", \"contact_phone\", \"whatsapp_number\", \"contact_address\", \"logo\", \"favicon\", \"featured_title\", \"featured_subtitle\", \"hero_cta_text\", \"bank_name\", \"bank_branch\", \"bank_account_name\", \"bank_account_number\", \"bank_swift\", \"bank_instructions\", \"marx_enabled\", \"marx_mode\", \"marx_merchant_id\", \"marx_currency\", \"marx_endpoint\", \"marx_valid_time_limit\", \"mail_mailer\", \"mail_encryption\", \"mail_host\", \"mail_port\", \"mail_username\", \"mail_from_address\", \"mail_from_name\", \"invoice_prefix\", \"default_og_image\", \"default_meta_description\", \"default_meta_keywords\", \"meta_home_title\", \"meta_products_title\", \"meta_home_description\", \"meta_products_description\", \"meta_about_title\", \"meta_contact_title\", \"meta_about_description\", \"meta_contact_description\", \"recaptcha_enabled\", \"recaptcha_site_key\"]}', NULL, '2026-10-08 05:18:30', '2026-10-08 05:18:30'),
(28, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-08 05:22:26', '2026-10-08 05:22:26'),
(29, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-08 05:50:57', '2026-10-08 05:50:57'),
(30, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-08 05:51:18', '2026-10-08 05:51:18'),
(31, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 46, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"0\", \"updated_at\": \"2026-10-08T10:48:30.000000Z\"}, \"attributes\": {\"value\": \"1\", \"updated_at\": \"2026-10-08T11:22:23.000000Z\"}}', NULL, '2026-10-08 05:52:23', '2026-10-08 05:52:23'),
(32, 'settings', 'Site settings updated', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"changed\": [\"site_name\", \"tagline\", \"currency_symbol\", \"site_description\", \"contact_email\", \"contact_phone\", \"whatsapp_number\", \"contact_address\", \"logo\", \"favicon\", \"featured_title\", \"featured_subtitle\", \"hero_cta_text\", \"bank_name\", \"bank_branch\", \"bank_account_name\", \"bank_account_number\", \"bank_swift\", \"bank_instructions\", \"marx_enabled\", \"marx_mode\", \"marx_merchant_id\", \"marx_currency\", \"marx_endpoint\", \"marx_valid_time_limit\", \"mail_mailer\", \"mail_encryption\", \"mail_host\", \"mail_port\", \"mail_username\", \"mail_from_address\", \"mail_from_name\", \"invoice_prefix\", \"default_og_image\", \"default_meta_description\", \"default_meta_keywords\", \"meta_home_title\", \"meta_products_title\", \"meta_home_description\", \"meta_products_description\", \"meta_about_title\", \"meta_contact_title\", \"meta_about_description\", \"meta_contact_description\", \"recaptcha_enabled\", \"recaptcha_site_key\"]}', NULL, '2026-10-08 05:52:23', '2026-10-08 05:52:23'),
(33, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 46, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"1\", \"updated_at\": \"2026-10-08T11:22:23.000000Z\"}, \"attributes\": {\"value\": \"0\", \"updated_at\": \"2026-10-08T11:23:38.000000Z\"}}', NULL, '2026-10-08 05:53:38', '2026-10-08 05:53:38'),
(34, 'settings', 'Site settings updated', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"changed\": [\"site_name\", \"tagline\", \"currency_symbol\", \"site_description\", \"contact_email\", \"contact_phone\", \"whatsapp_number\", \"contact_address\", \"logo\", \"favicon\", \"featured_title\", \"featured_subtitle\", \"hero_cta_text\", \"bank_name\", \"bank_branch\", \"bank_account_name\", \"bank_account_number\", \"bank_swift\", \"bank_instructions\", \"marx_enabled\", \"marx_mode\", \"marx_merchant_id\", \"marx_currency\", \"marx_endpoint\", \"marx_valid_time_limit\", \"mail_mailer\", \"mail_encryption\", \"mail_host\", \"mail_port\", \"mail_username\", \"mail_from_address\", \"mail_from_name\", \"invoice_prefix\", \"default_og_image\", \"default_meta_description\", \"default_meta_keywords\", \"meta_home_title\", \"meta_products_title\", \"meta_home_description\", \"meta_products_description\", \"meta_about_title\", \"meta_contact_title\", \"meta_about_description\", \"meta_contact_description\", \"recaptcha_enabled\", \"recaptcha_site_key\"]}', NULL, '2026-10-08 05:53:38', '2026-10-08 05:53:38'),
(35, 'banner', 'Banner created', 'App\\Models\\Banner', 'created', 1, NULL, NULL, '{\"attributes\": {\"id\": 1, \"link\": \"/products\", \"image\": \"https://picsum.photos/seed/digitalstore-banner-1/1920/600\", \"title\": \"Get 20% Off Your First Order\", \"position\": \"home_after_featured\", \"subtitle\": \"Start with any digital product and enjoy instant delivery plus a professional invoice.\", \"alignment\": \"center\", \"is_active\": true, \"created_at\": \"2026-10-08T11:26:24.000000Z\", \"sort_order\": 0, \"updated_at\": \"2026-10-08T11:26:24.000000Z\", \"button_text\": \"Claim Offer\"}}', NULL, '2026-10-08 05:56:24', '2026-10-08 05:56:24'),
(36, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 26, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"sandbox\", \"updated_at\": \"2026-10-08T07:27:36.000000Z\"}, \"attributes\": {\"value\": \"production\", \"updated_at\": \"2026-10-08T11:34:39.000000Z\"}}', NULL, '2026-10-08 06:04:39', '2026-10-08 06:04:39'),
(37, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 28, 'App\\Models\\User', 1, '{\"old\": {\"value\": \"\", \"updated_at\": \"2026-10-08T07:27:36.000000Z\"}, \"attributes\": {\"value\": \"NmFhNjM4OTEtYjBlYy00MjMxLWJhNTEtN2M3ODg1YmNjM2YyXzM1NTI=\", \"updated_at\": \"2026-10-08T11:34:39.000000Z\"}}', NULL, '2026-10-08 06:04:39', '2026-10-08 06:04:39'),
(38, 'settings', 'Site settings updated', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"changed\": [\"site_name\", \"tagline\", \"currency_symbol\", \"site_description\", \"contact_email\", \"contact_phone\", \"whatsapp_number\", \"contact_address\", \"logo\", \"favicon\", \"featured_title\", \"featured_subtitle\", \"hero_cta_text\", \"bank_name\", \"bank_branch\", \"bank_account_name\", \"bank_account_number\", \"bank_swift\", \"bank_instructions\", \"marx_enabled\", \"marx_mode\", \"marx_merchant_id\", \"marx_api_key\", \"marx_currency\", \"marx_endpoint\", \"marx_valid_time_limit\", \"mail_mailer\", \"mail_encryption\", \"mail_host\", \"mail_port\", \"mail_username\", \"mail_from_address\", \"mail_from_name\", \"invoice_prefix\", \"default_og_image\", \"default_meta_description\", \"default_meta_keywords\", \"meta_home_title\", \"meta_products_title\", \"meta_home_description\", \"meta_products_description\", \"meta_about_title\", \"meta_contact_title\", \"meta_about_description\", \"meta_contact_description\", \"recaptcha_enabled\", \"recaptcha_site_key\"]}', NULL, '2026-10-08 06:04:39', '2026-10-08 06:04:39'),
(39, 'settings', 'Setting updated', 'App\\Models\\Setting', 'updated', 34, 'App\\Models\\User', 1, '{\"old\": {\"value\": null, \"updated_at\": \"2026-10-08T08:03:33.000000Z\"}, \"attributes\": {\"value\": \"settings/nbo6FcZElYkWpDmNGc2fta2zPc3XkQ8YtvWGDtsx.png\", \"updated_at\": \"2026-10-09T22:42:29.000000Z\"}}', NULL, '2026-10-09 17:12:29', '2026-10-09 17:12:29'),
(40, 'settings', 'Site settings updated', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"changed\": [\"site_name\", \"tagline\", \"currency_symbol\", \"site_description\", \"contact_email\", \"contact_phone\", \"whatsapp_number\", \"contact_address\", \"logo\", \"favicon\", \"featured_title\", \"featured_subtitle\", \"hero_cta_text\", \"bank_name\", \"bank_branch\", \"bank_account_name\", \"bank_account_number\", \"bank_swift\", \"bank_instructions\", \"marx_enabled\", \"marx_mode\", \"marx_merchant_id\", \"marx_currency\", \"marx_endpoint\", \"marx_valid_time_limit\", \"mail_mailer\", \"mail_encryption\", \"mail_host\", \"mail_port\", \"mail_username\", \"mail_from_address\", \"mail_from_name\", \"invoice_prefix\", \"default_og_image\", \"default_meta_description\", \"default_meta_keywords\", \"meta_home_title\", \"meta_products_title\", \"meta_home_description\", \"meta_products_description\", \"meta_about_title\", \"meta_contact_title\", \"meta_about_description\", \"meta_contact_description\", \"recaptcha_enabled\", \"recaptcha_site_key\"]}', NULL, '2026-10-09 17:12:29', '2026-10-09 17:12:29'),
(41, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 17:26:07', '2026-10-09 17:26:07'),
(42, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 17:26:41', '2026-10-09 17:26:41'),
(43, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 17:28:26', '2026-10-09 17:28:26'),
(44, 'user', 'User registered', 'App\\Models\\User', 'created', 4, NULL, NULL, '{\"attributes\": {\"name\": \"Manager User\", \"role\": \"customer\", \"email\": \"manager@digitalstore.test\", \"phone\": null}}', NULL, '2026-10-09 17:29:04', '2026-10-09 17:29:04'),
(45, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 4, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 17:29:15', '2026-10-09 17:29:15'),
(46, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 4, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 17:32:01', '2026-10-09 17:32:01'),
(47, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 17:32:23', '2026-10-09 17:32:23'),
(48, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 17:35:54', '2026-10-09 17:35:54'),
(49, 'product', 'Product updated', 'App\\Models\\Product', 'updated', 14, 'App\\Models\\User', 1, '{\"old\": {\"image\": \"https://picsum.photos/seed/ultimate-stock-assets-bundle/800/600\", \"updated_at\": \"2026-10-08T07:27:37.000000Z\", \"description\": \"<p>Thousands of photos, icons and illustrations with full licence.</p>\\n<p><strong>Ultimate Stock Assets Bundle</strong> is a fully digital product. As soon as your payment is confirmed you will receive\\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\\n<ul>\\n    <li>Instant digital delivery</li>\\n    <li>Monthly and yearly plans available</li>\\n    <li>Secure online payment or bank transfer</li>\\n    <li>Dedicated customer support</li>\\n</ul>\"}, \"attributes\": {\"image\": null, \"updated_at\": \"2026-10-09T23:09:38.000000Z\", \"description\": \"<p>Thousands of photos, icons and illustrations with full licence.</p><p><strong>Ultimate Stock Assets Bundle</strong> is a fully digital product. As soon as your payment is confirmed you will receive\\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p><ul><li><p>Instant digital delivery<img src=\\\"http://localhost:8000/storage/jI5RYc4JOwgjviE1x5FqfjJ0auVIb2WE9Lt7Wyz4.png\\\" alt=\\\"LOGO\\\" /></p></li><li><p>Monthly and yearly plans available</p></li><li><p>Secure online payment or bank transfer</p></li><li><p>Dedicated customer support</p></li></ul>\"}}', NULL, '2026-10-09 17:39:38', '2026-10-09 17:39:38'),
(50, 'product', 'Product updated', 'App\\Models\\Product', 'updated', 14, 'App\\Models\\User', 1, '{\"old\": {\"image\": null, \"updated_at\": \"2026-10-09T23:09:38.000000Z\"}, \"attributes\": {\"image\": \"products/88F0fkxSR9mgZI0tQAbRMEbJQx3q6KZxBIJC87Ho.png\", \"updated_at\": \"2026-10-09T23:10:42.000000Z\"}}', NULL, '2026-10-09 17:40:42', '2026-10-09 17:40:42'),
(51, 'product_variation', 'Price variation updated', 'App\\Models\\ProductVariation', 'updated', 2, NULL, NULL, '{\"old\": {\"updated_at\": \"2026-10-08T07:27:36.000000Z\", \"original_price\": null}, \"attributes\": {\"updated_at\": \"2026-10-09T23:18:23.000000Z\", \"original_price\": \"150.00\"}}', NULL, '2026-10-09 17:48:23', '2026-10-09 17:48:23'),
(52, 'product', 'Product updated', 'App\\Models\\Product', 'updated', 1, NULL, NULL, '{\"old\": {\"images\": null, \"updated_at\": \"2026-10-08T07:27:36.000000Z\"}, \"attributes\": {\"images\": [\"https://picsum.photos/seed/ds-g1/800/800\", \"https://picsum.photos/seed/ds-g2/800/800\"], \"updated_at\": \"2026-10-09T23:18:23.000000Z\"}}', NULL, '2026-10-09 17:48:23', '2026-10-09 17:48:23'),
(53, 'product', 'Product updated', 'App\\Models\\Product', 'updated', 14, 'App\\Models\\User', 1, '{\"old\": {\"images\": null, \"updated_at\": \"2026-10-09T23:10:42.000000Z\"}, \"attributes\": {\"images\": [\"products/aVrTZy1bUFqgdqj1Geq1tmqW2EdPSTwXhay48r9K.webp\", \"products/af2JhhkAqb0u1Nz9hfseg20EIDJArEsTBqyQ57cp.webp\"], \"updated_at\": \"2026-10-09T23:21:26.000000Z\"}}', NULL, '2026-10-09 17:51:26', '2026-10-09 17:51:26'),
(54, 'product_variation', 'Price variation updated', 'App\\Models\\ProductVariation', 'updated', 27, 'App\\Models\\User', 1, '{\"old\": {\"updated_at\": \"2026-10-08T07:27:37.000000Z\", \"original_price\": null}, \"attributes\": {\"updated_at\": \"2026-10-09T23:22:09.000000Z\", \"original_price\": \"30.00\"}}', NULL, '2026-10-09 17:52:09', '2026-10-09 17:52:09'),
(55, 'product_variation', 'Price variation updated', 'App\\Models\\ProductVariation', 'updated', 28, 'App\\Models\\User', 1, '{\"old\": {\"updated_at\": \"2026-10-08T07:27:37.000000Z\", \"original_price\": null}, \"attributes\": {\"updated_at\": \"2026-10-09T23:22:09.000000Z\", \"original_price\": \"270.00\"}}', NULL, '2026-10-09 17:52:09', '2026-10-09 17:52:09'),
(56, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 17:56:39', '2026-10-09 17:56:39'),
(57, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 18:02:43', '2026-10-09 18:02:43'),
(58, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 18:04:55', '2026-10-09 18:04:55'),
(59, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 18:06:08', '2026-10-09 18:06:08'),
(60, 'auth', 'Logged in', NULL, NULL, NULL, 'App\\Models\\User', 1, '{\"ip\": \"127.0.0.1\", \"guard\": \"web\"}', NULL, '2026-10-09 18:06:56', '2026-10-09 18:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home_after_featured',
  `alignment` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'center',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `image`, `link`, `button_text`, `position`, `alignment`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Get 20% Off Your First Order', 'Start with any digital product and enjoy instant delivery plus a professional invoice.', 'https://picsum.photos/seed/digitalstore-banner-1/1920/600', '/products', 'Claim Offer', 'home_after_featured', 'center', 1, 0, '2026-10-08 05:56:24', '2026-10-08 05:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('digital-store-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1791589042),
('digital-store-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1791589042;', 1791589042),
('digital-store-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1791588459),
('digital-store-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1791588459;', 1791588459),
('digital-store-cache-app.settings', 'a:49:{s:9:\"site_name\";s:13:\"Digital Store\";s:7:\"tagline\";s:45:\"Premium digital products, delivered instantly\";s:15:\"currency_symbol\";s:3:\"Rs.\";s:16:\"site_description\";s:76:\"Buy premium digital products and subscriptions online with instant delivery.\";s:13:\"contact_email\";s:25:\"support@digitalstore.test\";s:13:\"contact_phone\";s:11:\"94712345678\";s:15:\"whatsapp_number\";s:11:\"94712345678\";s:15:\"contact_address\";s:37:\"123 Galle Road, Colombo 03, Sri Lanka\";s:14:\"featured_title\";s:17:\"Featured Products\";s:17:\"featured_subtitle\";s:54:\"Our most popular digital products, handpicked for you.\";s:13:\"hero_cta_text\";s:15:\"Browse Products\";s:9:\"bank_name\";s:25:\"Commercial Bank of Ceylon\";s:11:\"bank_branch\";s:10:\"Colombo 03\";s:17:\"bank_account_name\";s:23:\"Digital Store (Pvt) Ltd\";s:19:\"bank_account_number\";s:10:\"8001234567\";s:10:\"bank_swift\";s:8:\"CCEYLKLX\";s:17:\"bank_instructions\";s:224:\"1. Transfer the exact order total to the account above.\n2. Use your Order Number as the payment reference.\n3. Upload your receipt or send it to us on WhatsApp.\n4. We will verify and activate your products within a few hours.\";s:11:\"mail_mailer\";s:3:\"log\";s:15:\"mail_encryption\";s:3:\"tls\";s:9:\"mail_host\";s:14:\"smtp.gmail.com\";s:9:\"mail_port\";s:3:\"587\";s:13:\"mail_username\";N;s:17:\"mail_from_address\";s:26:\"no-reply@digitalstore.test\";s:14:\"mail_from_name\";s:13:\"Digital Store\";s:12:\"marx_enabled\";s:1:\"1\";s:9:\"marx_mode\";s:10:\"production\";s:16:\"marx_merchant_id\";N;s:12:\"marx_api_key\";s:56:\"NmFhNjM4OTEtYjBlYy00MjMxLWJhNTEtN2M3ODg1YmNjM2YyXzM1NTI=\";s:11:\"marx_secret\";s:0:\"\";s:13:\"marx_currency\";s:3:\"LKR\";s:13:\"marx_endpoint\";s:41:\"https://dev.app.marx.lk/api/v2/ipg/orders\";s:21:\"marx_valid_time_limit\";s:1:\"5\";s:14:\"invoice_prefix\";s:3:\"INV\";s:4:\"logo\";s:53:\"settings/nbo6FcZElYkWpDmNGc2fta2zPc3XkQ8YtvWGDtsx.png\";s:7:\"favicon\";N;s:24:\"default_meta_description\";s:76:\"Buy premium digital products and subscriptions online with instant delivery.\";s:21:\"default_meta_keywords\";s:45:\"digital products, subscriptions, online store\";s:15:\"meta_home_title\";N;s:21:\"meta_home_description\";N;s:19:\"meta_products_title\";s:8:\"Products\";s:25:\"meta_products_description\";s:54:\"Browse our full catalogue of premium digital products.\";s:16:\"meta_about_title\";s:8:\"About Us\";s:22:\"meta_about_description\";N;s:18:\"meta_contact_title\";s:10:\"Contact Us\";s:24:\"meta_contact_description\";N;s:17:\"recaptcha_enabled\";s:1:\"0\";s:18:\"recaptcha_site_key\";s:40:\"6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI\";s:20:\"recaptcha_secret_key\";s:40:\"6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe\";s:16:\"default_og_image\";N;}', 2106946920),
('digital-store-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:2;', 1791589027),
('digital-store-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1791589027;', 1791589027),
('digital-store-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:32:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:19:\"categories.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"categories.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"categories.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:17:\"categories.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:17:\"products.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"products.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"products.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"products.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"orders.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"orders.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"invoices.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:14:\"users.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"users.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:12:\"users.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:12:\"users.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:16:\"banners.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:14:\"banners.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:14:\"banners.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:14:\"banners.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:16:\"sliders.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:14:\"sliders.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:14:\"sliders.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:14:\"sliders.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:25:\"contact_messages.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:23:\"contact_messages.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:19:\"activities.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:14:\"roles.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:12:\"roles.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:12:\"roles.update\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:12:\"roles.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:20:\"permissions.view_any\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"settings.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super-admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"manager\";s:1:\"c\";s:3:\"web\";}}}', 1791673322);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `is_active`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Software & Tools', 'software-tools', 'Productivity, business and developer software licences.', 'https://picsum.photos/seed/software-tools/600/400', 1, NULL, NULL, NULL, NULL, 0, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(2, 'Streaming & Entertainment', 'streaming-entertainment', 'Movies, music and TV subscriptions for every screen.', 'https://picsum.photos/seed/streaming-entertainment/600/400', 1, NULL, NULL, NULL, NULL, 1, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(3, 'Web Hosting & Domains', 'web-hosting-domains', 'Fast, reliable hosting and domain registration.', 'https://picsum.photos/seed/web-hosting-domains/600/400', 1, NULL, NULL, NULL, NULL, 2, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(4, 'Learning & Courses', 'learning-courses', 'Learn new skills with expert-led online courses.', 'https://picsum.photos/seed/learning-courses/600/400', 1, NULL, NULL, NULL, NULL, 3, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(5, 'Design & Graphics', 'design-graphics', 'Creative software, templates and asset libraries.', 'https://picsum.photos/seed/design-graphics/600/400', 1, NULL, NULL, NULL, NULL, 4, '2026-10-08 01:57:37', '2026-10-08 01:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `invoice_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `order_id`, `invoice_number`, `pdf_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'INV-2026-00001', 'invoices/INV-2026-00001.pdf', '2026-10-08 01:59:56', '2026-10-08 01:59:56'),
(2, 2, 'INV-2026-00002', 'invoices/INV-2026-00002.pdf', '2026-10-08 02:42:04', '2026-10-08 02:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_08_000001_create_categories_table', 1),
(5, '2026_10_08_000002_create_products_table', 1),
(6, '2026_10_08_000003_create_product_variations_table', 1),
(7, '2026_10_08_000004_create_orders_table', 1),
(8, '2026_10_08_000005_create_order_items_table', 1),
(9, '2026_10_08_000006_create_invoices_table', 1),
(10, '2026_10_08_000007_create_settings_table', 1),
(11, '2026_10_08_000008_create_sliders_table', 1),
(12, '2026_10_08_000009_create_contact_messages_table', 1),
(13, '2026_10_08_093638_create_activity_log_table', 2),
(14, '2026_10_08_093639_add_event_column_to_activity_log_table', 2),
(15, '2026_10_08_093640_add_batch_uuid_column_to_activity_log_table', 2),
(16, '2026_10_08_100000_add_multi_factor_authentication_columns_to_users_table', 3),
(17, '2026_10_08_110000_add_seo_columns_to_products_and_categories', 4),
(18, '2026_10_08_120000_create_banners_table', 5),
(19, '2026_10_09_224112_create_permission_tables', 6),
(20, '2026_10_10_000001_add_images_to_products_table', 7),
(21, '2026_10_10_000002_add_original_price_to_product_variations_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_method` enum('online_gateway','offline') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('pending','paid','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_status` enum('pending','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `gateway_reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_response` json DEFAULT NULL,
  `offline_receipt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offline_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `total_amount`, `payment_method`, `payment_status`, `order_status`, `gateway_reference`, `gateway_response`, `offline_receipt`, `offline_note`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 'ORD-20261008-2RTQX', 2, 8.00, 'online_gateway', 'paid', 'completed', 'SANDBOX-ORD-20261008-2RTQX', '{\"result\": \"success\", \"sandbox\": true}', NULL, NULL, '2026-10-08 01:59:55', '2026-10-08 01:59:51', '2026-10-08 01:59:55'),
(2, 'ORD-20261008-2ZWV4', 3, 150.00, 'offline', 'paid', 'completed', 'manual-admin', NULL, 'receipts/HgkC0WxKxQ7xvGsln1qlzh3cgknjuOCLzPDDYUEf.png', 'Order ORD-20261008-2ZWV4', '2026-10-08 02:42:03', '2026-10-08 02:36:55', '2026-10-08 02:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `variation_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_cycle` enum('monthly','yearly') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variation_id`, `product_name`, `billing_cycle`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 13, 'Business Cloud Hosting', 'monthly', 8.00, '2026-10-08 01:59:51', '2026-10-08 01:59:51'),
(2, 2, 6, 12, 'Live Sports Pass', 'yearly', 150.00, '2026-10-08 02:36:55', '2026-10-08 02:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'categories.view_any', 'web', '2026-10-09 17:22:02', '2026-10-09 17:22:02'),
(2, 'categories.create', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(3, 'categories.update', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(4, 'categories.delete', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(5, 'products.view_any', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(6, 'products.create', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(7, 'products.update', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(8, 'products.delete', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(9, 'orders.view_any', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(10, 'orders.update', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(11, 'invoices.view_any', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(12, 'users.view_any', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(13, 'users.create', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(14, 'users.update', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(15, 'users.delete', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(16, 'banners.view_any', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(17, 'banners.create', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(18, 'banners.update', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(19, 'banners.delete', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(20, 'sliders.view_any', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(21, 'sliders.create', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(22, 'sliders.update', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(23, 'sliders.delete', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(24, 'contact_messages.view_any', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(25, 'contact_messages.delete', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(26, 'activities.view_any', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(27, 'roles.view_any', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(28, 'roles.create', 'web', '2026-10-09 17:22:03', '2026-10-09 17:22:03'),
(29, 'roles.update', 'web', '2026-10-09 17:22:04', '2026-10-09 17:22:04'),
(30, 'roles.delete', 'web', '2026-10-09 17:22:04', '2026-10-09 17:22:04'),
(31, 'permissions.view_any', 'web', '2026-10-09 17:22:04', '2026-10-09 17:22:04'),
(32, 'settings.manage', 'web', '2026-10-09 17:22:04', '2026-10-09 17:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` json DEFAULT NULL,
  `is_digital` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `access_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `og_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `short_description`, `description`, `image`, `images`, `is_digital`, `is_active`, `is_featured`, `access_details`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cloud Office Suite', 'cloud-office-suite', 'Documents, spreadsheets and slides with real-time collaboration.', '<p>Documents, spreadsheets and slides with real-time collaboration.</p>\n<p><strong>Cloud Office Suite</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/cloud-office-suite/800/600', '[\"https://picsum.photos/seed/ds-g1/800/800\", \"https://picsum.photos/seed/ds-g2/800/800\"]', 1, 1, 1, 'Thank you for your purchase!\n\nYour licence key: DS-7ILR-TVAU-J57Y\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:36', '2026-10-09 17:48:23'),
(2, 1, 'Antivirus Total Security', 'antivirus-total-security', 'Multi-device protection with VPN and password manager.', '<p>Multi-device protection with VPN and password manager.</p>\n<p><strong>Antivirus Total Security</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/antivirus-total-security/800/600', NULL, 1, 1, 0, 'Thank you for your purchase!\n\nYour licence key: DS-AFBZ-BEKZ-61QD\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(3, 1, 'Project Management Pro', 'project-management-pro', 'Plan, track and deliver projects with your whole team.', '<p>Plan, track and deliver projects with your whole team.</p>\n<p><strong>Project Management Pro</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/project-management-pro/800/600', NULL, 1, 1, 1, 'Thank you for your purchase!\n\nYour licence key: DS-JJOT-JNMP-3TE5\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(4, 2, 'Movies+ Premium', 'movies-premium', 'Unlimited movies and series in 4K across all devices.', '<p>Unlimited movies and series in 4K across all devices.</p>\n<p><strong>Movies+ Premium</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/movies-premium/800/600', NULL, 1, 1, 1, 'Thank you for your purchase!\n\nYour licence key: DS-ZVB2-PCGW-L5CI\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(5, 2, 'Music Unlimited', 'music-unlimited', 'Ad-free music streaming with offline downloads.', '<p>Ad-free music streaming with offline downloads.</p>\n<p><strong>Music Unlimited</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/music-unlimited/800/600', NULL, 1, 1, 0, 'Thank you for your purchase!\n\nYour licence key: DS-JXQX-G6GD-AXJE\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(6, 2, 'Live Sports Pass', 'live-sports-pass', 'Stream live sports and highlights all season long.', '<p>Stream live sports and highlights all season long.</p>\n<p><strong>Live Sports Pass</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/live-sports-pass/800/600', NULL, 1, 1, 0, 'Thank you for your purchase!\n\nYour licence key: DS-TVOX-PLQN-SIUD\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(7, 3, 'Business Cloud Hosting', 'business-cloud-hosting', 'SSD-powered hosting with free SSL and daily backups.', '<p>SSD-powered hosting with free SSL and daily backups.</p>\n<p><strong>Business Cloud Hosting</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/business-cloud-hosting/800/600', NULL, 1, 1, 1, 'Thank you for your purchase!\n\nYour licence key: DS-GNP0-UBBZ-IHDA\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(8, 3, 'Premium Domain Name', 'premium-domain-name', 'Secure your brand with a premium domain registration.', '<p>Secure your brand with a premium domain registration.</p>\n<p><strong>Premium Domain Name</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/premium-domain-name/800/600', NULL, 1, 1, 0, 'Thank you for your purchase!\n\nYour licence key: DS-H6BQ-G25C-YHAO\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(9, 3, 'Managed WordPress Hosting', 'managed-wordpress-hosting', 'Optimised, auto-updating WordPress hosting with staging.', '<p>Optimised, auto-updating WordPress hosting with staging.</p>\n<p><strong>Managed WordPress Hosting</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/managed-wordpress-hosting/800/600', NULL, 1, 1, 0, 'Thank you for your purchase!\n\nYour licence key: DS-CI5A-YRTU-A8G1\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(10, 4, 'Full-Stack Web Development', 'full-stack-web-development', 'Master HTML, CSS, JavaScript, PHP and modern frameworks.', '<p>Master HTML, CSS, JavaScript, PHP and modern frameworks.</p>\n<p><strong>Full-Stack Web Development</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/full-stack-web-development/800/600', NULL, 1, 1, 1, 'Thank you for your purchase!\n\nYour licence key: DS-MNIO-IGIE-D3DG\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(11, 4, 'Digital Marketing Masterclass', 'digital-marketing-masterclass', 'SEO, social media and paid ads that actually convert.', '<p>SEO, social media and paid ads that actually convert.</p>\n<p><strong>Digital Marketing Masterclass</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/digital-marketing-masterclass/800/600', NULL, 1, 1, 0, 'Thank you for your purchase!\n\nYour licence key: DS-H2D1-Y36R-R1I8\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(12, 4, 'Graphic Design Fundamentals', 'graphic-design-fundamentals', 'Design beautiful branding and graphics from scratch.', '<p>Design beautiful branding and graphics from scratch.</p>\n<p><strong>Graphic Design Fundamentals</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/graphic-design-fundamentals/800/600', NULL, 1, 1, 0, 'Thank you for your purchase!\n\nYour licence key: DS-ZPJ7-M04K-ZYS6\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(13, 5, 'Design Suite Pro', 'design-suite-pro', 'Professional design tools for print, web and social media.', '<p>Professional design tools for print, web and social media.</p>\n<p><strong>Design Suite Pro</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p>\n<ul>\n    <li>Instant digital delivery</li>\n    <li>Monthly and yearly plans available</li>\n    <li>Secure online payment or bank transfer</li>\n    <li>Dedicated customer support</li>\n</ul>', 'https://picsum.photos/seed/design-suite-pro/800/600', NULL, 1, 1, 1, 'Thank you for your purchase!\n\nYour licence key: DS-DVJP-OMK4-MMFW\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(14, 5, 'Ultimate Stock Assets Bundle', 'ultimate-stock-assets-bundle', 'Thousands of photos, icons and illustrations with full licence.', '<p>Thousands of photos, icons and illustrations with full licence.</p><p><strong>Ultimate Stock Assets Bundle</strong> is a fully digital product. As soon as your payment is confirmed you will receive\ninstant access details and a professional invoice by email — no waiting and no shipping required.</p><ul><li><p>Instant digital delivery<img src=\"http://localhost:8000/storage/jI5RYc4JOwgjviE1x5FqfjJ0auVIb2WE9Lt7Wyz4.png\" alt=\"LOGO\" /></p></li><li><p>Monthly and yearly plans available</p></li><li><p>Secure online payment or bank transfer</p></li><li><p>Dedicated customer support</p></li></ul>', 'products/88F0fkxSR9mgZI0tQAbRMEbJQx3q6KZxBIJC87Ho.png', '[\"products/aVrTZy1bUFqgdqj1Geq1tmqW2EdPSTwXhay48r9K.webp\", \"products/af2JhhkAqb0u1Nz9hfseg20EIDJArEsTBqyQ57cp.webp\"]', 1, 1, 0, 'Thank you for your purchase!\n\nYour licence key: DS-BQ7O-W0NQ-U0OI\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.', NULL, NULL, NULL, NULL, NULL, '2026-10-08 01:57:37', '2026-10-09 17:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `billing_cycle` enum('monthly','yearly') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `billing_cycle`, `price`, `original_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'monthly', 9.99, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(2, 1, 'yearly', 99.00, 150.00, '2026-10-08 01:57:36', '2026-10-09 17:48:23'),
(3, 2, 'monthly', 6.50, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(4, 2, 'yearly', 65.00, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(5, 3, 'monthly', 12.00, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(6, 3, 'yearly', 120.00, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(7, 4, 'monthly', 7.99, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(8, 4, 'yearly', 79.00, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(9, 5, 'monthly', 4.99, NULL, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(10, 5, 'yearly', 49.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(11, 6, 'monthly', 15.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(12, 6, 'yearly', 150.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(13, 7, 'monthly', 8.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(14, 7, 'yearly', 80.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(15, 8, 'monthly', 12.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(16, 8, 'yearly', 120.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(17, 9, 'monthly', 14.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(18, 9, 'yearly', 140.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(19, 10, 'monthly', 19.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(20, 10, 'yearly', 190.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(21, 11, 'monthly', 15.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(22, 11, 'yearly', 150.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(23, 12, 'monthly', 13.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(24, 12, 'yearly', 130.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(25, 13, 'monthly', 10.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(26, 13, 'yearly', 100.00, NULL, '2026-10-08 01:57:37', '2026-10-08 01:57:37'),
(27, 14, 'monthly', 25.00, 30.00, '2026-10-08 01:57:37', '2026-10-09 17:52:09'),
(28, 14, 'yearly', 250.00, 270.00, '2026-10-08 01:57:37', '2026-10-09 17:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2026-10-09 17:22:04', '2026-10-09 17:22:04'),
(2, 'admin', 'web', '2026-10-09 17:22:04', '2026-10-09 17:22:04'),
(3, 'manager', 'web', '2026-10-09 17:22:04', '2026-10-09 17:22:04'),
(4, 'customer', 'web', '2026-10-09 17:22:04', '2026-10-09 17:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0QRlJNBpyOqlSam463T8NnZmgYIP5W13MY5CJVJ7', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJtdjZIN0FRNHlpZlhSbjVFc1BhTlhFVmNCVk1yT29nVjJKM2ZLT2pwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI0XC9kaWdpdGFsc3VwXC9yb2xlcyIsInJvdXRlIjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLnJvbGVzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTM4YTAxZTI2OGQxYzViZjAzNzE5YzI4M2U2ZGE3MGQ1NWQ3NWY2NzQ3NDE4NDczNjRhOGQxZmUxNmE2YmNkZCIsInRhYmxlcyI6eyJiMDkyNDQ2NGIyNzk4YTBjNjNkZTU1MDBkYmViZjA5OF9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWUiLCJsYWJlbCI6Ik5hbWUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZ3VhcmRfbmFtZSIsImxhYmVsIjoiR3VhcmQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicm9sZXNfY291bnQiLCJsYWJlbCI6IlJvbGVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCIzNTMzNmE4MDg3Nzg4MzRmODk0MTc0NzExMmMyNjQzZV9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWUiLCJsYWJlbCI6Ik5hbWUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZ3VhcmRfbmFtZSIsImxhYmVsIjoiR3VhcmQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGVybWlzc2lvbnNfY291bnQiLCJsYWJlbCI6IlBlcm1pc3Npb25zIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InVzZXJzX2NvdW50IiwibGFiZWwiOiJBc3NpZ25lZCBVc2VycyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XX19', 1791586711),
('15irOtxqpSiQN8xoAMMVePH43PjEosvO9KOOC4zZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJtQmgyZmM5WjZFV3U5MFh4bVBubmRSZ1VhN3llQjRtOEVaejQ0SWo5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM4Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458932),
('1vMRuS8iDJEQVhkLUCRFzTTzxJLiWJKPLvkpWgDV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJKVFlBcU1oRlg1dlhZOUIwclpJVjd0ZmIwWlFXd0x0N3NRZXhDVmtsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDIwXC9wcm9kdWN0c1wvY2xvdWQtb2ZmaWNlLXN1aXRlIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791444846),
('21OwnT7iHHma2APlPWxtr99w6MqEqeq0M9jtdf2k', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJ0NXBGa2VPYTFSbkdtcUZsVFcxd05EYVdzM1BrQ1RiUGxUcEoxS3lHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM0XC9jb250YWN0Iiwicm91dGUiOiJjb250YWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458590),
('2hxy6nnj9ogr7jDMpF6uZuwyM2o2yTWHYrMGlHuU', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI4RlczUnR6STJjRDJkQ285R2JSRW15YWVEWXN6ZXhEbjNvT25kdUZkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI3XC9kaWdpdGFsc3VwXC9wcm9kdWN0c1wvY3JlYXRlIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMucHJvZHVjdHMuY3JlYXRlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTM4YTAxZTI2OGQxYzViZjAzNzE5YzI4M2U2ZGE3MGQ1NWQ3NWY2NzQ3NDE4NDczNjRhOGQxZmUxNmE2YmNkZCJ9', 1791588910),
('3xdcHu4kvQp7UWXPgpMNx3XurscloC9EHAweRvXr', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiIxeWkyZXc0NUpPUFdQZ2tkcHNKVDNEdDVEaFZudjVuTml2aEI5dk1iIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI0XC9kaWdpdGFsc3VwXC9vcmRlcnMiLCJyb3V0ZSI6ImZpbGFtZW50LmFkbWluLnJlc291cmNlcy5vcmRlcnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6NCwicGFzc3dvcmRfaGFzaF93ZWIiOiI3ZjAwODk3NGRmOGNlMjgxZjUzZTkzNDkyZmJlYWE1M2RhMWZhYTBjZWM2MjRhMDQxM2UyMDMwNDAzODhjN2E5IiwidGFibGVzIjp7IjhmYWM2ZWIxY2VjMjY4MDNiM2Y3ZmI0NDBhMjcxMTFiX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaW1hZ2UiLCJsYWJlbCI6IkltYWdlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWUiLCJsYWJlbCI6Ik5hbWUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY2F0ZWdvcnkubmFtZSIsImxhYmVsIjoiQ2F0ZWdvcnkiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidmFyaWF0aW9ucyIsImxhYmVsIjoiUHJpY2UiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfZmVhdHVyZWQiLCJsYWJlbCI6IkZlYXR1cmVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2FjdGl2ZSIsImxhYmVsIjoiSXMgYWN0aXZlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2RpZ2l0YWwiLCJsYWJlbCI6IkRpZ2l0YWwiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfV0sIjM1MzM2YTgwODc3ODgzNGY4OTQxNzQ3MTEyYzI2NDNlX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJndWFyZF9uYW1lIiwibGFiZWwiOiJHdWFyZCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwZXJtaXNzaW9uc19jb3VudCIsImxhYmVsIjoiUGVybWlzc2lvbnMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidXNlcnNfY291bnQiLCJsYWJlbCI6IkFzc2lnbmVkIFVzZXJzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCJlNzkzYTI3OWQ1NmU0NTA2MDk3NTQwMjBkNjI3YmVlY19jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im9yZGVyX251bWJlciIsImxhYmVsIjoiT3JkZXIgbnVtYmVyIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InVzZXIubmFtZSIsImxhYmVsIjoiQ3VzdG9tZXIiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidG90YWxfYW1vdW50IiwibGFiZWwiOiJUb3RhbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwYXltZW50X21ldGhvZCIsImxhYmVsIjoiTWV0aG9kIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InJlY2VpcHRfc3RhdHVzIiwibGFiZWwiOiJSZWNlaXB0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InBheW1lbnRfc3RhdHVzIiwibGFiZWwiOiJQYXltZW50IHN0YXR1cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJvcmRlcl9zdGF0dXMiLCJsYWJlbCI6Ik9yZGVyIHN0YXR1cyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJQbGFjZWQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfV19fQ==', 1791586769),
('4YUgt8f3B2YFdfwHh44wR0QJzdybFoVUXDczkX14', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiI3M3NEWWtPaWE5NWFkZ3pRbG8xN2xWQzJkVkdabE9rRzNrTlRCR056IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTIzXC9wcm9kdWN0c1wvY2xvdWQtb2ZmaWNlLXN1aXRlIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791585221),
('5ICNWKbqNEuCubWRFptStEksAB9VdlgTQCkXEWcQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJHajMzMWJHSmNhQ0liN2pVTndBelUxazVqWGVhNmtkeWlQTVFOWm9VIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMzdcL2NhcnQifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM3XC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458905),
('6rBJrskTM2JTqeEqnZWxLnAmREMQgDbpMw9D48Hf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJtdVNvY0ZNbkxZNnJEbWFpcUFWVUpWaG10S1ZNN0RxdWVJZzdZcFQ3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM3Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458895),
('7BQCykmSuhnzK9d2CnpDmR00SKmzXbpevpG3C4Jq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJjbE1VdnlkYmxYanJPcnRuTVdBSldjd2czMTlYUWlUSGtIaEFyTEdiIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI3XC9kaWdpdGFsc3VwXC9wcm9kdWN0c1wvY3JlYXRlIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMucHJvZHVjdHMuY3JlYXRlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTM4YTAxZTI2OGQxYzViZjAzNzE5YzI4M2U2ZGE3MGQ1NWQ3NWY2NzQ3NDE4NDczNjRhOGQxZmUxNmE2YmNkZCJ9', 1791588777),
('8ARDChlUuyjpXeTmYlI3848bG7lKP1gXbFrTw0x6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiIzNlBYTFlRQkRtYUI5NW1kbWI3blI3QWR3Ykxla3ZUM3F4eFdJNmNpIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgxMjNcL2NhcnQifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTIzXC9jYXJ0Iiwicm91dGUiOiJjYXJ0LmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791585211),
('8PYELXqdtsDWeRTBoJ6hT3CApRZygIXQqU7J0Dx3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJNYnFjcmVHcko4eTQ5cEV0eFJmSGUwcFB0Ykx3QzY3aEVSQWJGUXNEIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM5Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791459195),
('9MO3Byp4CCC5bijei7nhB4bzTXe6KzC6TvM1PObC', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJwOHJ6UjNXUTRSUTBVTEZHYWg5TDd3blpFVXlCaGlPSzZGWVFtWmpJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDIxXC9wcm9maWxlIiwicm91dGUiOiJwcm9maWxlLmVkaXQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MiwicGFzc3dvcmRfaGFzaF93ZWIiOiJkY2E1M2I2NmI4OWZjZTE0ZTBmZDY5YWJiZDQwMzIxOWJmOTE5MzkyMjdlODljZjM3M2NlMGQ3YTFiOTMwOTRlIn0=', 1791446415),
('a9WdlQlEf9taKyb2aFqz71apRwdiUlb8wkfhFrki', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'eyJ1cmwiOltdLCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2RpZ2l0YWxzdXBcL21hbmFnZS1zZXR0aW5ncyIsInJvdXRlIjoiZmlsYW1lbnQuYWRtaW4ucGFnZXMubWFuYWdlLXNldHRpbmdzIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwiX3Rva2VuIjoiajBCN2V5dnNPUWpTQ1VMQXhYNTlpYkx4Q1duWDhIcHNZN2o1eUNNcCIsImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6IjEzOGEwMWUyNjhkMWM1YmYwMzcxOWMyODNlNmRhNzBkNTVkNzVmNjc0NzQxODQ3MzY0YThkMWZlMTZhNmJjZGQiLCJ0YWJsZXMiOnsiYjA5MjQ0NjRiMjc5OGEwYzYzZGU1NTAwZGJlYmYwOThfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJOYW1lIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Imd1YXJkX25hbWUiLCJsYWJlbCI6Ikd1YXJkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InJvbGVzX2NvdW50IiwibGFiZWwiOiJSb2xlcyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiMzUzMzZhODA4Nzc4ODM0Zjg5NDE3NDcxMTJjMjY0M2VfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJOYW1lIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Imd1YXJkX25hbWUiLCJsYWJlbCI6Ikd1YXJkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InBlcm1pc3Npb25zX2NvdW50IiwibGFiZWwiOiJQZXJtaXNzaW9ucyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ1c2Vyc19jb3VudCIsImxhYmVsIjoiQXNzaWduZWQgVXNlcnMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfV0sImU2NDQ4MzNmNGU0ZTA4NzEyMzE1ZGE3MWIzM2ZhY2QyX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJlbWFpbCIsImxhYmVsIjoiRW1haWwiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGhvbmUiLCJsYWJlbCI6IlBob25lIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InJvbGUiLCJsYWJlbCI6IlJvbGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoib3JkZXJzX2NvdW50IiwibGFiZWwiOiJPcmRlcnMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY3JlYXRlZF9hdCIsImxhYmVsIjoiQ3JlYXRlZCBhdCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9XSwiOGZhYzZlYjFjZWMyNjgwM2IzZjdmYjQ0MGEyNzExMWJfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpbWFnZSIsImxhYmVsIjoiSW1hZ2UiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjYXRlZ29yeS5uYW1lIiwibGFiZWwiOiJDYXRlZ29yeSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ2YXJpYXRpb25zIiwibGFiZWwiOiJQcmljZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpc19mZWF0dXJlZCIsImxhYmVsIjoiRmVhdHVyZWQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfYWN0aXZlIiwibGFiZWwiOiJJcyBhY3RpdmUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfZGlnaXRhbCIsImxhYmVsIjoiRGlnaXRhbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiOWY2ZTcyMzIxMzY3ZTVjYjMzZTg5NDM0ZDVmZDhmMGNfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpbWFnZSIsImxhYmVsIjoiSW1hZ2UiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidGl0bGUiLCJsYWJlbCI6IlRpdGxlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InN1YnRpdGxlIiwibGFiZWwiOiJTdWJ0aXRsZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6ZmFsc2V9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwb3NpdGlvbiIsImxhYmVsIjoiUG9zaXRpb24iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfYWN0aXZlIiwibGFiZWwiOiJJcyBhY3RpdmUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic29ydF9vcmRlciIsImxhYmVsIjoiU29ydCBvcmRlciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XX0sImZpbGFtZW50IjpbXX0=', 1791589172),
('amYrcGZgltbHnSXcb5m8t4axYdyTeOgu21mi6apV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiI2ZFJrZm9PQTF6Nm02U2RQRkE2UFhucG5hcXFpYWhiZ3k2NE5kSEZYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI5XC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791456271),
('CIIXsEX2KWMNFQbMYl3qjauSBl6u1BJeq01AAisw', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJGQ1gwb3FaY3k4YXp2aUVYd3dlNnFWR09EVklta0ZXMk5RdEl0eTE4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjN9', 1791447050),
('CphYKQSFQvRiWB8u3B5foVa9YnMFfr8LoOnnoous', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJtdER6OTB6aGxzcVVrMTQxTnBNeXMzamdaOXVCeEhNeGJRN252eXRiIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM2Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458858),
('DLAy7A6gsvPCxmQzfAVt7vd0ZFbn6hP7JmDhNLbV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJ5NGdZbGV5S0Rab2FublhXZERCRnI0a0VVdFpXWWVEUUpuV0hSclZHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI2Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791455704),
('dP6kSSAZEaKN73Wuo9gNbZTA7U9wgW64h8VFuOFF', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJIeEFqMHZWQmlTc0hEUG92SmVJZE1ENFA5R0pxTEI1NmJwRVRLck1wIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI0XC9kaWdpdGFsc3VwXC9yb2xlcyIsInJvdXRlIjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLnJvbGVzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTM4YTAxZTI2OGQxYzViZjAzNzE5YzI4M2U2ZGE3MGQ1NWQ3NWY2NzQ3NDE4NDczNjRhOGQxZmUxNmE2YmNkZCIsInRhYmxlcyI6eyIzNTMzNmE4MDg3Nzg4MzRmODk0MTc0NzExMmMyNjQzZV9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWUiLCJsYWJlbCI6Ik5hbWUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZ3VhcmRfbmFtZSIsImxhYmVsIjoiR3VhcmQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGVybWlzc2lvbnNfY291bnQiLCJsYWJlbCI6IlBlcm1pc3Npb25zIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InVzZXJzX2NvdW50IiwibGFiZWwiOiJBc3NpZ25lZCBVc2VycyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiYjA5MjQ0NjRiMjc5OGEwYzYzZGU1NTAwZGJlYmYwOThfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJOYW1lIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Imd1YXJkX25hbWUiLCJsYWJlbCI6Ikd1YXJkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InJvbGVzX2NvdW50IiwibGFiZWwiOiJSb2xlcyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XX19', 1791586613),
('e2g2UppatOJbXKjFxKqVPY3TgiwmqgIcPjDRTm3w', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJtWjU3blNtdFM0UjlYUmxyc09wRmFGc2ppR1dqMUZFbFJzTmNqRzFPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI1XC9wcm9kdWN0c1wvY2xvdWQtb2ZmaWNlLXN1aXRlIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791587922),
('fniVihUaQ9hzEnAY8vHVu1ObCARoBuofamuaeTpT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJZTWJ6QjgzY21Sb1Z2WDA3UEczUHV1TUFDMlg3aWdGTXRwM0oyaEJ2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTIzXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791585210),
('fqPOtlsLlZAvnZiAayEMGOZWdAupPeLHRMR80tqh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJrQUUzRFVSbDRjZFI3M1JUTnJZejIwd1RHMzY5Sjd2REI3QTBHT0NkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI0XC9kaWdpdGFsc3VwIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5wYWdlcy5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiI3M2U0YzFhNWUzMDZiOTM0NTUwYzk2ZDc0YzllZGIyMTdjYmUzZjk3ZTAzYjA1MWUxMWVhYjE0ZjMwMTFjOTQ5In0=', 1791455425),
('g978tHdIcjxL3BkTVAh2cRl2YjadKhg5Ty6nmxD4', NULL, '127.0.0.1', 'curl/8.21.0', 'eyJfdG9rZW4iOiIyNFdBZG1DdndBMHp2ZkVSbVVuNVppMFUxUm55Wjc2ZVdVdkI5RHVYIiwic3RhdGUiOiJFcnVwYUh6SExacE9BWkNYR2lvM0o0bUVOaDBQVVFWT2pTSVJvUmwwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hdXRoXC9nb29nbGVcL3JlZGlyZWN0Iiwicm91dGUiOiJhdXRoLmdvb2dsZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1791446220),
('GHuKzU22KuzZFGbm7hVjkW5ixUbIIHcGxIzquRKR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJnSWs2dVV3TXRaaUtmeFJtNmE3UE84dk9UM1dyVEVHeFNpR1RIR3NjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDMwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791456442),
('gIqX5RGvXyTLzcvwIFU8VAjzJp4pE99LNh5Wk2LO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiI1Z082clJwVTNwTXZtV3NscHVPYjhyOWhYQXhOdzJIcmZRczJqelNmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDMwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791456441),
('gxjeTjzfDeUOBTlSvRuCGjUHvkY0s2JiNmKKb30M', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJKRFhTZ1l2RkNVcFU5T0dTSXBPeEw5TE1BbUtuU2N1S3VDTTRnWll1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI0XC9kaWdpdGFsc3VwXC9jb250YWN0LW1lc3NhZ2VzIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMuY29udGFjdC1tZXNzYWdlcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo0LCJwYXNzd29yZF9oYXNoX3dlYiI6IjdmMDA4OTc0ZGY4Y2UyODFmNTNlOTM0OTJmYmVhYTUzZGExZmFhMGNlYzYyNGEwNDEzZTIwMzA0MDM4OGM3YTkiLCJ0YWJsZXMiOnsiOGZhYzZlYjFjZWMyNjgwM2IzZjdmYjQ0MGEyNzExMWJfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpbWFnZSIsImxhYmVsIjoiSW1hZ2UiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjYXRlZ29yeS5uYW1lIiwibGFiZWwiOiJDYXRlZ29yeSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ2YXJpYXRpb25zIiwibGFiZWwiOiJQcmljZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpc19mZWF0dXJlZCIsImxhYmVsIjoiRmVhdHVyZWQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfYWN0aXZlIiwibGFiZWwiOiJJcyBhY3RpdmUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfZGlnaXRhbCIsImxhYmVsIjoiRGlnaXRhbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiZTc5M2EyNzlkNTZlNDUwNjA5NzU0MDIwZDYyN2JlZWNfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJvcmRlcl9udW1iZXIiLCJsYWJlbCI6Ik9yZGVyIG51bWJlciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ1c2VyLm5hbWUiLCJsYWJlbCI6IkN1c3RvbWVyIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRvdGFsX2Ftb3VudCIsImxhYmVsIjoiVG90YWwiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGF5bWVudF9tZXRob2QiLCJsYWJlbCI6Ik1ldGhvZCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJyZWNlaXB0X3N0YXR1cyIsImxhYmVsIjoiUmVjZWlwdCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwYXltZW50X3N0YXR1cyIsImxhYmVsIjoiUGF5bWVudCBzdGF0dXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoib3JkZXJfc3RhdHVzIiwibGFiZWwiOiJPcmRlciBzdGF0dXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY3JlYXRlZF9hdCIsImxhYmVsIjoiUGxhY2VkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCI0NzNhZGJjOTZmYmI1NjNjMTllNDEzZDA1YmMwNTA2MV9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWUiLCJsYWJlbCI6Ik5hbWUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZW1haWwiLCJsYWJlbCI6IkVtYWlsIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InBob25lIiwibGFiZWwiOiJQaG9uZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdWJqZWN0IiwibGFiZWwiOiJTdWJqZWN0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IlJlY2VpdmVkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dfX0=', 1791586931),
('hCDFuqHE2HJkvWgNkKhSl0qWcNNHWRDjA6DMN9lH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJZaXVRWVpRNFdiSU9iS245V25lSnpweE5RWWhDZlJOczEyNjcwdUxqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI0XC9kaWdpdGFsc3VwXC9hY3Rpdml0aWVzIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMuYWN0aXZpdGllcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6IjEzOGEwMWUyNjhkMWM1YmYwMzcxOWMyODNlNmRhNzBkNTVkNzVmNjc0NzQxODQ3MzY0YThkMWZlMTZhNmJjZGQiLCJ0YWJsZXMiOnsiZTY0NDgzM2Y0ZTRlMDg3MTIzMTVkYTcxYjMzZmFjZDJfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJOYW1lIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImVtYWlsIiwibGFiZWwiOiJFbWFpbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwaG9uZSIsImxhYmVsIjoiUGhvbmUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicm9sZSIsImxhYmVsIjoiUm9sZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJvcmRlcnNfY291bnQiLCJsYWJlbCI6Ik9yZGVycyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJDcmVhdGVkIGF0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOmZhbHNlLCJpc1RvZ2dsZWFibGUiOnRydWUsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6dHJ1ZX1dLCIzMjcwMTM1NjlhZmQ2OTcwODJlNGZmOTRjNzIyZjY3Y19jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IldoZW4iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibG9nX25hbWUiLCJsYWJlbCI6IlR5cGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZGVzY3JpcHRpb24iLCJsYWJlbCI6IkRlc2NyaXB0aW9uIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImV2ZW50IiwibGFiZWwiOiJFdmVudCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdWJqZWN0X3R5cGUiLCJsYWJlbCI6IlN1YmplY3QiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY2F1c2VyLm5hbWUiLCJsYWJlbCI6IkJ5IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dfX0=', 1791586573),
('I86qpBSrvERWI3wYFUVQdtjm2GbdNeQIgwKc7Gol', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJVcllEbmxnYXJzb1k5M3J6aU50cWpXRzNXcXJqdHhYWm5KdTlOVmxNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDIzXC9kaWdpdGFsc3VwXC9hY3Rpdml0aWVzIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMuYWN0aXZpdGllcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6IjczZTRjMWE1ZTMwNmI5MzQ1NTBjOTZkNzRjOWVkYjIxN2NiZTNmOTdlMDNiMDUxZTExZWFiMTRmMzAxMWM5NDkiLCJ0YWJsZXMiOnsiMzI3MDEzNTY5YWZkNjk3MDgyZTRmZjk0YzcyMmY2N2NfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJXaGVuIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImxvZ19uYW1lIiwibGFiZWwiOiJUeXBlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImRlc2NyaXB0aW9uIiwibGFiZWwiOiJEZXNjcmlwdGlvbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJldmVudCIsImxhYmVsIjoiRXZlbnQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic3ViamVjdF90eXBlIiwibGFiZWwiOiJTdWJqZWN0IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNhdXNlci5uYW1lIiwibGFiZWwiOiJCeSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XX19', 1791452368),
('IDnsBquMngvc7eh46MdfSobuM3kfv1ye6g8D4r5k', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiI2UzhacE5yZ000bGVwZFJPSGlhd0ZmZFdUdVVmSE1DZHF1enIybVBTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI3XC9kaWdpdGFsc3VwXC9wcm9maWxlIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5hdXRoLnByb2ZpbGUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiI3M2U0YzFhNWUzMDZiOTM0NTUwYzk2ZDc0YzllZGIyMTdjYmUzZjk3ZTAzYjA1MWUxMWVhYjE0ZjMwMTFjOTQ5In0=', 1791455924),
('iJSPD7A0X4cyHyLBJSL8hxXCG7HsptjjLnW2hUV2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJSdlRBUG9hMW56U2I1cU1NVDcxT3J0MzltekxscGs3T3VMcHZ4WUF6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI1Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791587941),
('IrG3HnTcebdIFabZQ7TWAQdxlC4Oz65zG3uiNsiz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiI1QTdnQ0Z4anViSXdZR0VYU3RBYTdVSTE4M3BmQWpLYlNEUUVIZmR0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI1Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791587920),
('ixaTEkqjsbsIFESgaU4b1hVqUZT9GrDz2GVUePxw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJuMHdlemhoRDlrbEFWalZORlVHRm9JSzVWMHFUd2o5cWtLNDg4VlJDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM3XC9jb250YWN0Iiwicm91dGUiOiJjb250YWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458903),
('jNvhM8IYJDgFbEH5SlXWEN77MkpY6Izd3f5IVPEQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiI4alhJNHgzMnBWeGh5VUhEZXpVUGJRdm01enJ2TWFYT05TOExnamYxIiwidXJsIjp7ImludGVuZGVkIjoiXC9wcm9kdWN0c1wvY2xvdWQtb2ZmaWNlLXN1aXRlIn0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAyMFwvbG9naW4/cmVkaXJlY3Q9JTJGcHJvZHVjdHMlMkZjbG91ZC1vZmZpY2Utc3VpdGUiLCJyb3V0ZSI6ImxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791444845),
('KcG3iQQ8bEDOb7Z43MgKHLZIVMPOE7MsPCNGDuow', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJoRVZjaEhIWFlDVGR0SHJJSmpzMUVGOFNERzU3bnRyZnJlN01adGJ5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDMyXC9kaWdpdGFsc3VwIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5wYWdlcy5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiI3M2U0YzFhNWUzMDZiOTM0NTUwYzk2ZDc0YzllZGIyMTdjYmUzZjk3ZTAzYjA1MWUxMWVhYjE0ZjMwMTFjOTQ5In0=', 1791458459),
('KfCJr937JZLHxy02funzRI3BfXMQeU9dMyENFQVN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJqUzdRRVJGREdzVUtnOTdtR1c5V2VuRFdBeG41ekJ5QjViZmlCMXZzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDIwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791444846),
('Knh0ZZ7vX8JyQYHsXI4ZPuzK4YI2l31bXzzc3lMR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJadkxWcUhXYnQ2ZEdwSFl3MWk0d0sxcG53aEFRWkFEZGhNTFo3a2JwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI3XC9kaWdpdGFsc3VwXC9wcm9kdWN0c1wvY3JlYXRlIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMucHJvZHVjdHMuY3JlYXRlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTM4YTAxZTI2OGQxYzViZjAzNzE5YzI4M2U2ZGE3MGQ1NWQ3NWY2NzQ3NDE4NDczNjRhOGQxZmUxNmE2YmNkZCJ9', 1791588983),
('LlaxRrNVHQBAzbWsskP0rO530oD6j1fXGyYHXCRa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJjT1lnR2hQeFdHaTI1aUduNkhHdWd5SlEwWjdGVmdoMDEwNWFkOWV5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTIzXC9jb250YWN0Iiwicm91dGUiOiJjb250YWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791585210),
('mkv6K1BC2KpoepUzUG8JlkoY76oo2arGYNUOP0kt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJVQzZSNlcxcG14VkdmOThxU1VGUkxpa1EwMkJVaGUydHNURjZ4aVdLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTIzXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791585208),
('MuumCclSazf1OrpYL2CGgx6F8H2EcuFQzVtCZlLz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJsQTQ0ZTZsR0x5SGMwRHFoTFNUS0dhTVJwWEc4a240WUpWekNNMkU3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI5XC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791456270),
('NgTGcm6kExJKW5lJ7AD48ga6G8wc5draFuq4QHGc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJRcWdCenZOOVJVRkJqQ2dLc2luR1p1U2RYNnVVVU1ZRDdjRWxWcFRDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI2XC9kaWdpdGFsc3VwXC9wcm9kdWN0c1wvY3JlYXRlIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMucHJvZHVjdHMuY3JlYXRlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTM4YTAxZTI2OGQxYzViZjAzNzE5YzI4M2U2ZGE3MGQ1NWQ3NWY2NzQ3NDE4NDczNjRhOGQxZmUxNmE2YmNkZCJ9', 1791588401),
('nOxX6cG9fB6TrjZwJU9GbHfe97iCXEPsToChnHHp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJSZUpROElUMDhmWklseVF2ZXU5eGdiakl6cU1tc2tVdDI4ODR4WksxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM0Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458592),
('o2b1WdTtBL23glKr1lR0nurTVvyYSUKvHabhkV3s', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJjWGszMjljM05aOFcyVVgzN1hqSXZhb1o1TlB6SkVBdWNKTDFrQWV1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI1XC9wcm9kdWN0c1wvY2xvdWQtb2ZmaWNlLXN1aXRlIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791587942),
('oaNyTQX1Ib1FbNChF0avMprvAiTRwD78ouZsVGQh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJBTVoyVEx1YVhQUFoyTXpEbVcxdWJLbFZvZlE5aHFzR1FUN1o2bEZiIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTIzIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791585196),
('pSAdmnVPh2S4KhQRhBbfBsOrt05rXYVHeantdglI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI0eFlTcDQxODUzSjlEWDlaQ09zTU9jTnhuVFkyeG9vdmFqbXRjWVEyIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3Byb2R1Y3RzXC91bHRpbWF0ZS1zdG9jay1hc3NldHMtYnVuZGxlIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sInN0YXRlIjoia2l5QXhpUzNHaTlOcERTVzgyTzlWWnZvbXJZSUprSnBoOTdyTVJoOSIsInVybCI6eyJpbnRlbmRlZCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jYXJ0In19', 1791588210),
('Qcn3aXeTlu5j4GXW1wYpuqHDCtWfoFKwJmZWiOzC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/154.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI4NzFFakVhUUd0bWNRWGExMlRpRWR0Y2VMQmdmWEpEZ3lDcDBZTnkxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI3XC9kaWdpdGFsc3VwXC9wcm9kdWN0c1wvY3JlYXRlIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMucHJvZHVjdHMuY3JlYXRlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTM4YTAxZTI2OGQxYzViZjAzNzE5YzI4M2U2ZGE3MGQ1NWQ3NWY2NzQ3NDE4NDczNjRhOGQxZmUxNmE2YmNkZCJ9', 1791589029),
('QHyVrch8KgJsBtBLIlR591UHqccWUEKZJuMSQceq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiI4YU02TVJYMWJ4c3NWOU9qRmtJZFpmaWllUGxEckZpY0h4SFAxTEZ3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI4Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791456011),
('qMEjLPaUNeTIM8rhCpWCGgMAwAD4k3IqrUfRuQlX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJMVU11cGFwd0FsUVVTV1dUUmR2YXV0RW5XRzBmdDBMR3hVWlc5dmZOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM3XC9wcm9kdWN0c1wvY2xvdWQtb2ZmaWNlLXN1aXRlIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458901),
('S2IcD34jr3S7SlXXsW9TTBOeipYqsWwwWKcqW23R', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJwaXdUaG5BRjBHZjVyYzl0SnZaRUpaS2h3RVgzUzg4aGdLbzRhbGlHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDMxXC9kaWdpdGFsc3VwXC9vcmRlcnMiLCJyb3V0ZSI6ImZpbGFtZW50LmFkbWluLnJlc291cmNlcy5vcmRlcnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiI3M2U0YzFhNWUzMDZiOTM0NTUwYzk2ZDc0YzllZGIyMTdjYmUzZjk3ZTAzYjA1MWUxMWVhYjE0ZjMwMTFjOTQ5IiwidGFibGVzIjp7ImU3OTNhMjc5ZDU2ZTQ1MDYwOTc1NDAyMGQ2MjdiZWVjX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoib3JkZXJfbnVtYmVyIiwibGFiZWwiOiJPcmRlciBudW1iZXIiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidXNlci5uYW1lIiwibGFiZWwiOiJDdXN0b21lciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ0b3RhbF9hbW91bnQiLCJsYWJlbCI6IlRvdGFsIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InBheW1lbnRfbWV0aG9kIiwibGFiZWwiOiJNZXRob2QiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicmVjZWlwdF9zdGF0dXMiLCJsYWJlbCI6IlJlY2VpcHQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGF5bWVudF9zdGF0dXMiLCJsYWJlbCI6IlBheW1lbnQgc3RhdHVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im9yZGVyX3N0YXR1cyIsImxhYmVsIjoiT3JkZXIgc3RhdHVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IlBsYWNlZCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XX19', 1791456750),
('sI4uMop2XM7qombYkHxGGnEyaesDPkX7UnZ5VqCb', NULL, '127.0.0.1', 'curl/8.21.0', 'eyJfdG9rZW4iOiJBSzRKWklIOWtBNlVMSmU1a0NNd09vR09BZkxOTFJUTUtrYkE3RHpOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI0Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791455422),
('swLRvPPbj8QC8KnpNf5jkCZWB6sTGVFIyiQu03BX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJpYXROOEo4SmVRRktJZjQ4YU5GN3JCOEVqVXFqVVBYckZnOFo3VHIxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM3XC9hYm91dCIsInJvdXRlIjoiYWJvdXQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791458902),
('tJcWWjO5qD25O0BAcI0guBlcwxePOUyRLxyHavWb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiIxaWl0OHBLdVRWNEdMNFlURTJyQ0FNdU9OZWpVUnlscGRUMnUxeXRHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM3XC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791458906),
('TUQG3t6UwV21atzMbxVP7hTbLY0xz3QlLuicVkBf', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJ3bEZROUgzV04zdFhDZ3UweWIzVUVpVGRjSFZhOTg1VFIwMHpISGJyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDIyXC9jdXN0b21lclwvaW52b2ljZXMiLCJyb3V0ZSI6ImN1c3RvbWVyLmludm9pY2VzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsInBhc3N3b3JkX2hhc2hfd2ViIjoiZGNhNTNiNjZiODlmY2UxNGUwZmQ2OWFiYmQ0MDMyMTliZjkxOTM5MjI3ZTg5Y2YzNzNjZTBkN2ExYjkzMDk0ZSIsImNhcnQiOnsiMToxIjp7InByb2R1Y3RfaWQiOjEsInZhcmlhdGlvbl9pZCI6MSwibmFtZSI6IkNsb3VkIE9mZmljZSBTdWl0ZSIsImJpbGxpbmdfY3ljbGUiOiJtb250aGx5IiwicHJpY2UiOjkuOTksImltYWdlIjoiaHR0cHM6XC9cL3BpY3N1bS5waG90b3NcL3NlZWRcL2Nsb3VkLW9mZmljZS1zdWl0ZVwvODAwXC82MDAifX19', 1791446771);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('uIBW8cEScIu1sZZEr5kBv9v2wOwoXYiCtE1FSgVl', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiI4eklmYXU5OUNyb1ZINHhmOHFIcE14T201TTM1T2F3cWd1QXFsTENjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTI0XC9kaWdpdGFsc3VwXC9hY3Rpdml0aWVzIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMuYWN0aXZpdGllcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6IjEzOGEwMWUyNjhkMWM1YmYwMzcxOWMyODNlNmRhNzBkNTVkNzVmNjc0NzQxODQ3MzY0YThkMWZlMTZhNmJjZGQiLCJ0YWJsZXMiOnsiOGZhYzZlYjFjZWMyNjgwM2IzZjdmYjQ0MGEyNzExMWJfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpbWFnZSIsImxhYmVsIjoiSW1hZ2UiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjYXRlZ29yeS5uYW1lIiwibGFiZWwiOiJDYXRlZ29yeSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ2YXJpYXRpb25zIiwibGFiZWwiOiJQcmljZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpc19mZWF0dXJlZCIsImxhYmVsIjoiRmVhdHVyZWQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfYWN0aXZlIiwibGFiZWwiOiJJcyBhY3RpdmUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfZGlnaXRhbCIsImxhYmVsIjoiRGlnaXRhbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiZTc5M2EyNzlkNTZlNDUwNjA5NzU0MDIwZDYyN2JlZWNfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJvcmRlcl9udW1iZXIiLCJsYWJlbCI6Ik9yZGVyIG51bWJlciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ1c2VyLm5hbWUiLCJsYWJlbCI6IkN1c3RvbWVyIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRvdGFsX2Ftb3VudCIsImxhYmVsIjoiVG90YWwiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicGF5bWVudF9tZXRob2QiLCJsYWJlbCI6Ik1ldGhvZCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJyZWNlaXB0X3N0YXR1cyIsImxhYmVsIjoiUmVjZWlwdCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwYXltZW50X3N0YXR1cyIsImxhYmVsIjoiUGF5bWVudCBzdGF0dXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoib3JkZXJfc3RhdHVzIiwibGFiZWwiOiJPcmRlciBzdGF0dXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY3JlYXRlZF9hdCIsImxhYmVsIjoiUGxhY2VkIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCJlNjQ0ODMzZjRlNGUwODcxMjMxNWRhNzFiMzNmYWNkMl9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWUiLCJsYWJlbCI6Ik5hbWUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZW1haWwiLCJsYWJlbCI6IkVtYWlsIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InBob25lIiwibGFiZWwiOiJQaG9uZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJyb2xlIiwibGFiZWwiOiJSb2xlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im9yZGVyc19jb3VudCIsImxhYmVsIjoiT3JkZXJzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IkNyZWF0ZWQgYXQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfV0sIjM1MzM2YTgwODc3ODgzNGY4OTQxNzQ3MTEyYzI2NDNlX2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJndWFyZF9uYW1lIiwibGFiZWwiOiJHdWFyZCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwZXJtaXNzaW9uc19jb3VudCIsImxhYmVsIjoiUGVybWlzc2lvbnMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidXNlcnNfY291bnQiLCJsYWJlbCI6IkFzc2lnbmVkIFVzZXJzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCJiMDkyNDQ2NGIyNzk4YTBjNjNkZTU1MDBkYmViZjA5OF9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWUiLCJsYWJlbCI6Ik5hbWUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZ3VhcmRfbmFtZSIsImxhYmVsIjoiR3VhcmQiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicm9sZXNfY291bnQiLCJsYWJlbCI6IlJvbGVzIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dLCIzMjcwMTM1NjlhZmQ2OTcwODJlNGZmOTRjNzIyZjY3Y19jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNyZWF0ZWRfYXQiLCJsYWJlbCI6IldoZW4iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibG9nX25hbWUiLCJsYWJlbCI6IlR5cGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiZGVzY3JpcHRpb24iLCJsYWJlbCI6IkRlc2NyaXB0aW9uIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImV2ZW50IiwibGFiZWwiOiJFdmVudCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzdWJqZWN0X3R5cGUiLCJsYWJlbCI6IlN1YmplY3QiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY2F1c2VyLm5hbWUiLCJsYWJlbCI6IkJ5IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH1dfX0=', 1791586957),
('vC2C8GRA1fPfHohCtfRULxqxAYZ00QQg3XnpCegT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJjcXluMEhsWGZSczF5elQ2cHY4N2VkcWhFZlNUdzJkUnVrRHo2ZGVKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI2XC9wcm9kdWN0c1wvY2xvdWQtb2ZmaWNlLXN1aXRlIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791455705),
('vPiTvzFu20tQym9SsZlBaYcJL87kPjRTKeON1JHW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJGdVhQQW9EM3ZFenVOaXlUdjdIanlGeTBXRjBVMnJRM284cDFoeUx4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI1Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791455689),
('w54pU7ntA5NqZVshm9u0NrCX9AucIUrJIXn1BicB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJRbmVNcTk3U1YwTzRTWG9qVzNJZzNnMElwSE1NRjdyUWJ0S3NSbUs2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTIzXC9wcm9kdWN0c1wvY2xvdWQtb2ZmaWNlLXN1aXRlIiwicm91dGUiOiJwcm9kdWN0cy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791585208),
('W9z1TXLIb61kggFgBEiX0gZetqwtroRajlQJDlMU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJZUWVkZlozdXlZaGdGS2tGcFl3OGI0ZjRCVk9oRlc4NUx2VzZkMnpUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM3XC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791458907),
('WgIq7n1qMhTH7nZEKEbCu01LjE3L2EwsNTi6SyM1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJlTjZBdUdFZndXaVBkUkhKNTRkUVR5OXhqZkxxTHp5ajVFV3loeFJKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTIzXC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791585220),
('xtkxaBBFaUu8tBlTiZO6CdDaOGTkQQQr6fBco8pw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJycjRITFdUdjc5NFJmMXpXdU8zekl1Z1l3WDVKVGFpaWdnYnh4d0prIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM1Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458840),
('XuqzYxTpRzh6cbE8WbGcaLQSd5J83oX5IgtBVMWc', NULL, '127.0.0.1', 'curl/8.21.0', 'eyJfdG9rZW4iOiJzRkdIZ2ltemI4MUxyNk42aDgxYUNReEZPQ2hmZThHRjhiS1lVU0pjIiwic3RhdGUiOiJYRFZET1hJb2k0RGh6YmZ4amlKSGNKdllXbTZFdFRsa21YTDRjZTZ1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hdXRoXC9nb29nbGVcL3JlZGlyZWN0Iiwicm91dGUiOiJhdXRoLmdvb2dsZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1791446221),
('XY6Py5J8AuRuWrGRTGqQ55raU3ZE8PO039ymSfJ2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJYakxYc0FkMDloZFlKRGdpWUdwYlN1dEppU3NkNjdnZW5oVjJla2thIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MTIzXC9hYm91dCIsInJvdXRlIjoiYWJvdXQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791585209),
('YNTwXM7ymHXe2y9Pauv9MYoX3HoYw8fw7hdUyBrP', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJBdVFldXVOcng1bHE1dG5sNm9pSmFNQUhBNDlDaWN6Mmd0YW1pOUNFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDMzXC9kaWdpdGFsc3VwIiwicm91dGUiOiJmaWxhbWVudC5hZG1pbi5wYWdlcy5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiI3M2U0YzFhNWUzMDZiOTM0NTUwYzk2ZDc0YzllZGIyMTdjYmUzZjk3ZTAzYjA1MWUxMWVhYjE0ZjMwMTFjOTQ5In0=', 1791458481),
('ZE8Z64lOD2O2Tk6T6Kv0cCeBRWFeiEI8UqphagSH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJpM0J0VjBjM3pZSlA2THM5MnlOTkRzTUNoeXVRRTJHYWZQQ3BnMU9WIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM3XC9wcm9kdWN0cyIsInJvdXRlIjoicHJvZHVjdHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791458899),
('zLPTtW9BLeBJBXpBlKRU2CgBmC49nGPDHgD838Jo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJ5WHgxSTlIU1FCbGFZdXFLOXFHeFlBVXI3Z0h1ZDZ4MlNzR1VRRTFYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDM3Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791458908),
('ZnSHsUU6snIrREADXzA51LzF1OGNqMRFUaPlOsVs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJBS2ZPaHNFR2RPSHE5N2x1UnRzTGVWQ3NDd29FdjZYem9iWnpTbXNWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDI4XC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791456012);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Digital Store', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(2, 'tagline', 'Premium digital products, delivered instantly', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(3, 'currency_symbol', 'Rs.', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(4, 'site_description', 'Buy premium digital products and subscriptions online with instant delivery.', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(5, 'contact_email', 'support@digitalstore.test', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(6, 'contact_phone', '94712345678', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(7, 'whatsapp_number', '94712345678', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(8, 'contact_address', '123 Galle Road, Colombo 03, Sri Lanka', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(9, 'featured_title', 'Featured Products', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(10, 'featured_subtitle', 'Our most popular digital products, handpicked for you.', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(11, 'hero_cta_text', 'Browse Products', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(12, 'bank_name', 'Commercial Bank of Ceylon', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(13, 'bank_branch', 'Colombo 03', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(14, 'bank_account_name', 'Digital Store (Pvt) Ltd', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(15, 'bank_account_number', '8001234567', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(16, 'bank_swift', 'CCEYLKLX', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(17, 'bank_instructions', '1. Transfer the exact order total to the account above.\n2. Use your Order Number as the payment reference.\n3. Upload your receipt or send it to us on WhatsApp.\n4. We will verify and activate your products within a few hours.', 'general', '2026-10-08 01:57:36', '2026-10-08 02:36:43'),
(18, 'mail_mailer', 'log', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(19, 'mail_encryption', 'tls', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(20, 'mail_host', 'smtp.gmail.com', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(21, 'mail_port', '587', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(22, 'mail_username', NULL, 'general', '2026-10-08 01:57:36', '2026-10-08 05:18:30'),
(23, 'mail_from_address', 'no-reply@digitalstore.test', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(24, 'mail_from_name', 'Digital Store', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(25, 'marx_enabled', '1', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(26, 'marx_mode', 'production', 'general', '2026-10-08 01:57:36', '2026-10-08 06:04:39'),
(27, 'marx_merchant_id', NULL, 'general', '2026-10-08 01:57:36', '2026-10-08 05:18:30'),
(28, 'marx_api_key', 'NmFhNjM4OTEtYjBlYy00MjMxLWJhNTEtN2M3ODg1YmNjM2YyXzM1NTI=', 'general', '2026-10-08 01:57:36', '2026-10-08 06:04:39'),
(29, 'marx_secret', '', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(30, 'marx_currency', 'LKR', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(31, 'marx_endpoint', 'https://dev.app.marx.lk/api/v2/ipg/orders', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(32, 'marx_valid_time_limit', '5', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(33, 'invoice_prefix', 'INV', 'general', '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(34, 'logo', 'settings/nbo6FcZElYkWpDmNGc2fta2zPc3XkQ8YtvWGDtsx.png', 'general', '2026-10-08 02:33:33', '2026-10-09 17:12:29'),
(35, 'favicon', NULL, 'general', '2026-10-08 02:33:33', '2026-10-08 02:33:33'),
(36, 'default_meta_description', 'Buy premium digital products and subscriptions online with instant delivery.', 'general', '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(37, 'default_meta_keywords', 'digital products, subscriptions, online store', 'general', '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(38, 'meta_home_title', NULL, 'general', '2026-10-08 05:04:13', '2026-10-08 05:18:30'),
(39, 'meta_home_description', NULL, 'general', '2026-10-08 05:04:13', '2026-10-08 05:18:30'),
(40, 'meta_products_title', 'Products', 'general', '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(41, 'meta_products_description', 'Browse our full catalogue of premium digital products.', 'general', '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(42, 'meta_about_title', 'About Us', 'general', '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(43, 'meta_about_description', NULL, 'general', '2026-10-08 05:04:13', '2026-10-08 05:18:30'),
(44, 'meta_contact_title', 'Contact Us', 'general', '2026-10-08 05:04:13', '2026-10-08 05:04:13'),
(45, 'meta_contact_description', NULL, 'general', '2026-10-08 05:04:13', '2026-10-08 05:18:30'),
(46, 'recaptcha_enabled', '0', 'general', '2026-10-08 05:16:49', '2026-10-08 05:53:38'),
(47, 'recaptcha_site_key', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI', 'general', '2026-10-08 05:16:49', '2026-10-08 05:16:49'),
(48, 'recaptcha_secret_key', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe', 'general', '2026-10-08 05:16:49', '2026-10-08 05:16:49'),
(49, 'default_og_image', NULL, 'general', '2026-10-08 05:18:30', '2026-10-08 05:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `image`, `link`, `button_text`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Unlock Premium Digital Tools', 'Get instant access to the software, subscriptions and services you need — no waiting, no shipping.', 'https://picsum.photos/seed/digitalstore-hero-1/1600/700', NULL, 'Shop Now', 0, 1, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(2, 'Save More With Annual Plans', 'Switch to yearly billing and enjoy the best value on all your favourite digital products.', 'https://picsum.photos/seed/digitalstore-hero-2/1600/700', NULL, 'Explore Plans', 1, 1, '2026-10-08 01:57:36', '2026-10-08 01:57:36'),
(3, 'Delivered Instantly To Your Inbox', 'Automatic delivery, professional invoices and dedicated support — every single time.', 'https://picsum.photos/seed/digitalstore-hero-3/1600/700', NULL, 'Get Started', 2, 1, '2026-10-08 01:57:36', '2026-10-08 01:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_authentication_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `app_authentication_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `has_email_authentication` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `google_id`, `avatar`, `role`, `remember_token`, `app_authentication_secret`, `app_authentication_recovery_codes`, `has_email_authentication`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@digitalstore.test', '2026-10-09 17:22:12', '$2y$12$DmckrYA1esl0WDVK.rOMdeMX6q0obf1ISJptjuuCchXDJGzzDUYg2', '94712345678', NULL, NULL, 'admin', NULL, NULL, NULL, 0, '2026-10-08 01:57:36', '2026-10-09 17:22:13'),
(2, 'Demo Customer', 'customer@digitalstore.test', '2026-10-09 17:22:13', '$2y$12$jhK8vddg1a2SreGXD75iquNfcWKxXXUUysHs.P.uzH4JebgaMxUlu', '94771234567', NULL, NULL, 'customer', NULL, NULL, NULL, 0, '2026-10-08 01:57:36', '2026-10-09 17:22:13'),
(3, 'buddhika chathuranga', 'cpgeminiai@gmail.com', NULL, NULL, '94778631663', '115885939359438849626', 'https://lh3.googleusercontent.com/a/ACg8ocJzDEhjBOKw3ZWAUQ73L_uGGuWXnwmc4ZAV6zJDJOpqN4M1=s96-c', 'customer', 'YpMVJ6zeGi8LL2oAi2ha4sUF1ohI9ajgWasLM1TNlKXHCLcOowFBWmP3pMGD', NULL, NULL, 0, '2026-10-08 02:25:17', '2026-10-08 02:36:55'),
(4, 'Manager User', 'manager@digitalstore.test', NULL, '$2y$12$azcEzSetUeW1E7KX.OgcxeKghCF8H6e0Xktq2bhttkFteNqE3eRju', NULL, NULL, NULL, 'customer', NULL, NULL, NULL, 0, '2026-10-09 17:29:04', '2026-10-09 17:29:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_order_id_foreign` (`order_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_variation_id_foreign` (`variation_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variations_product_id_billing_cycle_unique` (`product_id`,`billing_cycle`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_google_id_index` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `product_variations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
