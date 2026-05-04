-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2026 at 09:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srsibd_dcdhaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Current Account', 'চলিত', NULL, 1, 1, NULL, NULL, NULL),
(2, 'Saving Account', 'সেভিংস', NULL, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `address_infos`
--

CREATE TABLE `address_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permanent_division_id` bigint(20) DEFAULT NULL,
  `permanent_district_id` bigint(20) DEFAULT NULL,
  `permanent_thana_id` bigint(20) DEFAULT NULL,
  `permanent_union_id` bigint(20) DEFAULT NULL,
  `permanent_ward_id` bigint(20) DEFAULT NULL,
  `permanent_village_id` bigint(20) DEFAULT NULL,
  `permanent_village_area_id` bigint(20) DEFAULT NULL,
  `permanent_road` varchar(191) DEFAULT NULL,
  `permanent_house` varchar(191) DEFAULT NULL,
  `permanent_flat` varchar(191) DEFAULT NULL,
  `permanent_area` varchar(191) DEFAULT NULL,
  `permanent_area_bn` varchar(191) DEFAULT NULL,
  `present_division_id` bigint(20) DEFAULT NULL,
  `present_district_id` bigint(20) DEFAULT NULL,
  `present_thana_id` bigint(20) DEFAULT NULL,
  `present_union_id` bigint(20) DEFAULT NULL,
  `present_ward_id` bigint(20) DEFAULT NULL,
  `present_village_id` bigint(20) DEFAULT NULL,
  `present_village_area_id` bigint(20) DEFAULT NULL,
  `present_road` varchar(191) DEFAULT NULL,
  `present_house` varchar(191) DEFAULT NULL,
  `present_flat` varchar(191) DEFAULT NULL,
  `present_area` varchar(191) DEFAULT NULL,
  `present_area_bn` varchar(191) DEFAULT NULL,
  `present_start_date` varchar(191) DEFAULT NULL,
  `union_name` varchar(190) DEFAULT NULL,
  `village` varchar(190) DEFAULT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_post_office_id` int(11) DEFAULT NULL,
  `present_post_office_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address_infos`
--

INSERT INTO `address_infos` (`id`, `user_id`, `permanent_division_id`, `permanent_district_id`, `permanent_thana_id`, `permanent_union_id`, `permanent_ward_id`, `permanent_village_id`, `permanent_village_area_id`, `permanent_road`, `permanent_house`, `permanent_flat`, `permanent_area`, `permanent_area_bn`, `present_division_id`, `present_district_id`, `present_thana_id`, `present_union_id`, `present_ward_id`, `present_village_id`, `present_village_area_id`, `present_road`, `present_house`, `present_flat`, `present_area`, `present_area_bn`, `present_start_date`, `union_name`, `village`, `present_address`, `permanent_post_office_id`, `present_post_office_id`, `created_at`, `updated_at`) VALUES
(19, 53, NULL, NULL, NULL, NULL, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, 6, 51, 385, 3503, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No.3 Shuktail Union Parishad', 'শুকতাইল', NULL, 569, 569, '2025-08-27 02:58:17', '2026-04-16 09:20:57'),
(22, 56, NULL, NULL, NULL, NULL, 9, 2, NULL, '2', '5', NULL, NULL, NULL, 6, 51, 385, 3503, 9, NULL, NULL, 'শুকতাইল মেইন রোড', 'Borobari', NULL, NULL, NULL, NULL, 'No.3 Shuktail Union Parishad', 'Suktail', NULL, 569, 569, '2025-08-31 01:53:18', '2026-04-14 23:36:41'),
(42, 66, NULL, NULL, NULL, NULL, 9, 12, NULL, 'শুকতাইল মেইন রোড', 'Sarder Bari', NULL, NULL, NULL, 6, 51, 385, 3503, 9, 12, NULL, 'শুকতাইল মেইন রোড', 'Sarder Bari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 569, 569, '2026-03-02 12:40:29', '2026-04-20 22:16:34'),
(49, 8, NULL, NULL, NULL, NULL, 9, 9, NULL, 'উত্তর শুকতাইল মেইন রোড', 'Puberobari', NULL, NULL, NULL, 6, 51, 385, 3503, 9, 9, NULL, 'উত্তর শুকতাইল মেইন রোড', 'Puberobari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 569, 569, '2026-03-04 23:31:54', '2026-03-04 23:31:54'),
(50, 39, NULL, NULL, NULL, NULL, 9, 8, NULL, 'উত্তর শুকতাইল মেইন রোড', 'মোল্লাবাড়ি', NULL, NULL, NULL, 6, 51, 385, 3503, 9, 8, NULL, 'উত্তর শুকতাইল মেইন রোড', 'মোল্লাবাড়ি', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 569, 569, '2026-03-15 12:01:19', '2026-03-15 12:01:19'),
(58, 98, 6, 51, 385, 3503, 1, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-15 08:09:09', '2026-04-15 08:09:09'),
(59, 106, 1, 1, 1, 3, 3, NULL, NULL, '23', '23', NULL, NULL, 'House (Bangla)', 1, 3, 26, 257, 3, NULL, NULL, '1', '1', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 09:00:02', '2026-04-17 09:00:02'),
(60, 107, 6, 51, 385, 3503, 9, 8, NULL, 'উত্তর শুকতাইল মেইন রোড', '343', NULL, NULL, '৩৪৩', 6, 51, 385, 3503, 9, 8, NULL, 'উত্তর শুকতাইল মেইন রোড', '343', NULL, NULL, '৩৪৩', NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 19:36:37', '2026-04-17 19:36:37'),
(61, 108, 6, 51, 385, 3503, 9, 8, NULL, 'উত্তর শুকতাইল মেইন রোড', '123', NULL, NULL, NULL, 6, 51, 385, 3503, 9, 8, NULL, 'উত্তর শুকতাইল মেইন রোড', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 569, NULL, '2026-04-17 21:29:55', '2026-04-17 21:29:55'),
(62, 109, NULL, NULL, NULL, NULL, 7, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 571, NULL, '2026-04-18 00:53:55', '2026-04-18 01:25:47'),
(63, 111, NULL, NULL, NULL, NULL, 4, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 577, NULL, '2026-04-21 23:08:20', '2026-04-21 23:10:44'),
(64, 112, NULL, NULL, NULL, NULL, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 571, NULL, '2026-04-21 23:58:39', '2026-04-21 23:59:27'),
(65, 113, NULL, NULL, NULL, NULL, 8, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 571, NULL, '2026-04-22 00:02:57', '2026-04-22 00:03:41'),
(66, 114, NULL, NULL, NULL, NULL, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 571, NULL, '2026-04-22 00:20:49', '2026-04-22 00:54:39'),
(67, 116, NULL, NULL, NULL, NULL, 8, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 571, NULL, '2026-04-22 05:50:11', '2026-04-22 05:51:39'),
(68, 117, NULL, NULL, NULL, NULL, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 577, NULL, '2026-04-22 07:00:59', '2026-04-22 07:02:13'),
(69, 118, NULL, NULL, NULL, NULL, 9, 9, NULL, 'উত্তর শুকতাইল মেইন রোড', '234', NULL, NULL, NULL, 6, 51, 385, 3503, 9, 9, NULL, 'উত্তর শুকতাইল মেইন রোড', '234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 569, 569, '2026-04-22 17:50:11', '2026-04-22 18:10:11'),
(70, 119, 6, 51, 385, NULL, 9, 9, NULL, 'উত্তর শুকতাইল মেইন রোড', '123', NULL, NULL, NULL, 6, 51, 385, 3503, 9, 9, NULL, 'উত্তর শুকতাইল মেইন রোড', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 569, 569, '2026-04-22 19:11:16', '2026-04-22 19:12:49'),
(71, 120, 6, 51, 385, 3503, 9, 9, NULL, 'উত্তর শুকতাইল মেইন রোড', '122', NULL, NULL, NULL, 6, 51, 385, 3503, 9, 9, NULL, 'উত্তর শুকতাইল মেইন রোড', '122', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 569, 569, '2026-04-24 02:44:35', '2026-04-24 02:44:35'),
(72, 121, 6, 51, 385, 3503, 8, 24, NULL, NULL, NULL, NULL, NULL, NULL, 6, 51, 385, 3503, 8, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 571, 571, '2026-04-24 21:26:42', '2026-04-24 23:55:21'),
(73, 124, 6, 51, 385, 3503, 8, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 571, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(74, 122, 6, 51, 385, 3503, 8, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 571, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(75, 123, 6, 51, 385, 3503, 8, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 571, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(76, 125, 6, 51, 385, 3503, 9, 7, NULL, 'উত্তর শুকতাইল মেইন রোড', '134', NULL, NULL, NULL, 6, 51, 385, 3503, 9, 7, NULL, 'উত্তর শুকতাইল মেইন রোড', '134', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 569, 569, '2026-04-25 00:09:11', '2026-04-25 00:09:11'),
(77, 126, 7, 59, 442, 4057, 6, 21, NULL, 'Sarkarpara', '7', NULL, NULL, NULL, 7, 59, 442, 4057, 6, 21, NULL, 'Sarkarpara', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 565, 565, '2026-04-25 23:32:04', '2026-04-25 23:32:04'),
(78, 129, 4, 30, 230, 2087, 5, 24, NULL, 'Sarkarpara', '7', NULL, NULL, NULL, 4, 30, 230, 2087, 5, 24, NULL, 'Sarkarpara', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 548, 548, '2026-04-26 00:32:46', '2026-04-26 00:32:46'),
(79, 130, NULL, NULL, NULL, NULL, 1, 24, NULL, 'Sarkarpara', '7', NULL, NULL, NULL, 6, 42, 323, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 548, NULL, '2026-04-26 01:11:34', '2026-04-26 01:15:14'),
(80, 131, 4, 30, 230, 2087, 3, 23, NULL, 'Sarkarpara', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 561, NULL, '2026-04-26 04:25:04', '2026-04-26 04:25:04'),
(81, 132, 7, 59, 442, NULL, 4, 24, NULL, 'Sarkarpara', '7', NULL, NULL, '7', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-27 02:04:31', '2026-04-27 02:04:31'),
(82, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-27 02:05:33', '2026-04-27 02:05:33'),
(83, 134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sarkarpara', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-27 02:11:55', '2026-05-01 23:04:16'),
(84, 135, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-28 04:26:34', '2026-04-28 04:26:34'),
(85, 136, 2, 13, 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 23:27:41', '2026-05-01 23:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `age_certificates`
--

CREATE TABLE `age_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `age_certificates`
--

INSERT INTO `age_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 8, 0.00, 1, 0.00, 7, '2022-10-21 12:14:06', '2022-10-21 12:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `area_infos`
--

CREATE TABLE `area_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `chairman_type_id` tinyint(4) DEFAULT NULL,
  `division_id` bigint(20) DEFAULT NULL,
  `district_id` bigint(20) DEFAULT NULL,
  `thana_id` bigint(20) DEFAULT NULL,
  `union_id` bigint(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `area_infos`
--

INSERT INTO `area_infos` (`id`, `user_id`, `chairman_type_id`, `division_id`, `district_id`, `thana_id`, `union_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(6, 8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-27 04:30:45', '2023-01-01 02:42:44'),
(10, 39, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-08 01:33:49', '2023-06-08 01:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `en_name`, `bn_name`, `slug`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Agrani Bank Limited', 'অগ্রণী ব্যাংক', NULL, NULL, 1, 1, NULL, NULL, NULL),
(2, 'Bangladesh Development Bank', 'বাংলাদেশ ডেভেলপমেন্ট ব্যাংক লিমিটেড', NULL, NULL, 1, 1, NULL, NULL, NULL),
(3, 'BASIC Bank Limited', 'বেসিক ব্যাংক লিমিটেড', NULL, NULL, 1, 1, NULL, NULL, NULL),
(4, 'Janata Bank Limited', 'জনতা ব্যাংক লিমিটেড', NULL, NULL, 1, 1, NULL, NULL, NULL),
(5, 'Rupali Bank Limited', ' রূপালী ব্যাংক', NULL, NULL, 1, 1, NULL, NULL, NULL),
(6, 'Sonali Bank Limited', 'সোনালী ব্যাংক লিমিটেড', NULL, NULL, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `birth_certificates`
--

CREATE TABLE `birth_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bridges`
--

CREATE TABLE `bridges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_types`
--

CREATE TABLE `certificate_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(2) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `certificate_types`
--

INSERT INTO `certificate_types` (`id`, `name`, `code`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'Citizen Certificate', '01', 'citizen_certificates', '2026-04-18 16:36:20', '2026-04-18 16:36:20'),
(2, 'Character Certificate', '02', 'character_certificates', '2026-04-18 16:36:20', '2026-04-18 16:36:20'),
(4, 'Succession Certificate', '04', 'successions', NULL, NULL),
(3, 'Death Certificate', '03', 'death_certificates', '2026-04-18 16:36:20', '2026-04-18 16:36:20'),
(5, 'Unmarried Certificate', '05', 'unmarried_certificates', NULL, NULL),
(6, 'Married Certificate', '06', 'married_certificates', NULL, NULL),
(7, 'Remarried Certificate', '07', 'remarried_certificates', NULL, NULL),
(8, 'Landless Certificate', '08', 'landless_certificates', NULL, NULL),
(9, 'Name Certificate', '09', 'name_certificates', NULL, NULL),
(10, 'Income Certificate', '10', 'yearly_income_certificates', NULL, NULL),
(11, 'Disability Certificate', '11', 'disability_certificates', NULL, NULL),
(12, 'Voter Area Certificate', '12', 'voter_area_certificates', NULL, NULL),
(13, 'Voter List Certificate', '13', 'voter_list_certificates', NULL, NULL),
(14, 'NID Correction Certificate', '14', 'nid_correction_certificates', NULL, NULL),
(15, 'Childless  Certificate', '15', 'childless_certificates', NULL, NULL),
(16, 'Orphan  Certificate', '16', 'orphan_certificates', NULL, NULL),
(17, 'Financial Instability Certificate', '17', 'financial_instability_certificates', NULL, NULL),
(18, 'Age Certificate', '18', 'age_certificates', NULL, NULL),
(19, 'Permanent Citizen Certificate', '19', 'permanent_citizen_certificates', NULL, NULL),
(20, 'Residential Certificate', '20', 'residential_certificates', NULL, NULL),
(21, 'Guardian Certificate', '21', 'guardian_certificates', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chairman_area_details`
--

CREATE TABLE `chairman_area_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chairman_area_info_id` bigint(20) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city_corporation_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `union_id` int(11) DEFAULT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `chairman_area_infos`
--

CREATE TABLE `chairman_area_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `area_info_id` bigint(20) DEFAULT NULL,
  `chairman_type_id` tinyint(4) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `chairman_area_infos`
--

INSERT INTO `chairman_area_infos` (`id`, `user_id`, `area_info_id`, `chairman_type_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(6, 8, NULL, 9, NULL, NULL, NULL, '2022-12-27 04:30:45', '2023-01-01 02:42:44'),
(10, 39, NULL, 9, NULL, NULL, NULL, '2023-06-08 01:33:49', '2023-06-08 01:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `chairman_mayors`
--

CREATE TABLE `chairman_mayors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `date_of_birth` varchar(191) DEFAULT NULL,
  `birth_place` bigint(20) DEFAULT NULL,
  `district_id` bigint(20) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `gender` bigint(20) DEFAULT NULL,
  `religion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `blood_group` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `chairman_mayors_old`
--

CREATE TABLE `chairman_mayors_old` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `union_id` bigint(20) DEFAULT NULL,
  `city_corporation_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_end` date DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>Chairman 2=>Mayor',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `character_certificates`
--

CREATE TABLE `character_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `character_certificates`
--

INSERT INTO `character_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(15, '20260219011', 53, 0.00, 1, 0.00, 7, '2026-02-19 04:16:19', '2026-02-19 04:16:19'),
(18, '2026041802001', 108, 0.00, 1, 0.00, 7, '2026-04-18 11:04:59', '2026-04-18 11:04:59'),
(19, '2026042202001', 8, 0.00, 1, 0.00, 7, '2026-04-21 20:00:25', '2026-04-21 20:00:25'),
(20, '26042202001', 113, 0.00, 1, 0.00, 7, '2026-04-22 00:05:38', '2026-04-22 00:05:38'),
(21, '26042202002', 114, 0.00, 1, 0.00, 7, '2026-04-22 00:50:56', '2026-04-22 00:50:56'),
(22, '26042202003', 114, 0.00, 1, 0.00, 7, '2026-04-22 00:52:27', '2026-04-22 00:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `childless_certificates`
--

CREATE TABLE `childless_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `childless_certificates`
--

INSERT INTO `childless_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '20260214001', 8, 0.00, 1, 0.00, 7, '2026-02-14 11:25:34', '2026-02-14 11:25:34'),
(2, '20260317002', 35, 0.00, 1, 0.00, 7, '2026-03-16 23:22:37', '2026-03-16 23:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_certificates`
--

CREATE TABLE `citizen_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `citizen_certificates`
--

INSERT INTO `citizen_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(36, '20260215020', 67, 0.00, 1, 0.00, 7, '2026-02-15 05:23:37', '2026-02-15 05:23:37'),
(37, '20260216021', 69, 0.00, 1, 0.00, 7, '2026-02-16 06:40:34', '2026-02-16 06:40:34'),
(38, '20260216022', 69, 0.00, 1, 0.00, 7, '2026-02-16 06:45:16', '2026-02-16 06:45:16'),
(39, '20260219023', 69, 0.00, 1, 0.00, 7, '2026-02-19 16:10:37', '2026-02-19 16:10:37'),
(40, '20260228024', 74, 0.00, 1, 0.00, 7, '2026-02-28 19:54:55', '2026-02-28 19:54:55'),
(42, '20260414025', 81, 0.00, 1, 0.00, 7, '2026-04-13 22:50:57', '2026-04-13 22:50:57'),
(43, '20260415026', 56, 0.00, 1, 0.00, 7, '2026-04-15 13:17:01', '2026-04-15 13:17:01'),
(44, '20260418027', 109, 0.00, 1, 0.00, 7, '2026-04-18 00:54:30', '2026-04-18 00:54:30'),
(45, '2026042101001', 66, 0.00, 1, 0.00, 7, '2026-04-20 22:37:02', '2026-04-20 22:37:02'),
(46, '26042201001', 111, 0.00, 1, 0.00, 7, '2026-04-21 23:09:01', '2026-04-21 23:09:01'),
(47, '26042201002', 113, 0.00, 1, 0.00, 7, '2026-04-22 00:03:55', '2026-04-22 00:03:55'),
(48, '26042201003', 114, 0.00, 1, 0.00, 7, '2026-04-22 01:27:14', '2026-04-22 01:27:14'),
(49, '26042201004', 116, 0.00, 1, 0.00, 7, '2026-04-22 05:50:48', '2026-04-22 05:50:48'),
(50, '26042201005', 117, 0.00, 1, 0.00, 7, '2026-04-22 07:02:30', '2026-04-22 07:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `city_corporations`
--

CREATE TABLE `city_corporations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `category` enum('A','B','C','CC') NOT NULL DEFAULT 'CC',
  `slug` varchar(191) NOT NULL,
  `lat` varchar(191) DEFAULT NULL,
  `lon` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_corporations`
--

INSERT INTO `city_corporations` (`id`, `district_id`, `name`, `bn_name`, `category`, `slug`, `lat`, `lon`, `url`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 65, 'Dhaka North', 'ঢাকা উত্তর', 'CC', 'dhaka-north', '', '', '', 1, NULL, NULL, NULL),
(2, 65, 'Dhaka South', 'ঢাকা দক্ষিণ', 'CC', 'dhaka-south', '', '', '', 1, NULL, NULL, NULL),
(3, 8, 'Chattogram', 'চট্টগ্রাম', 'CC', 'chattogram', '', '', '', 1, NULL, NULL, NULL),
(4, 36, 'Sylhet', 'সিলেট', 'CC', 'sylhet', '', '', '', 1, NULL, NULL, NULL),
(5, 69, 'Barishal', 'বরিশাল', 'CC', 'barishal', '', '', '', 1, NULL, NULL, NULL),
(6, 27, 'Khulna', 'খুলনা', 'CC', 'khulna', '', '', '', 1, NULL, NULL, NULL),
(7, 67, 'Rajshahi', 'রাজশাহী', 'CC', 'rajshahi', '', '', '', 1, NULL, NULL, NULL),
(8, 72, 'Gazipur', 'গাজীপুর', 'CC', 'gazipur', '', '', '', 1, NULL, NULL, NULL),
(9, 43, 'Narayanganj', 'নারায়ণগঞ্জ', 'CC', 'narayanganj', '', '', '', 1, NULL, NULL, NULL),
(10, 59, 'Rangpur ', 'রংপুর', 'CC', 'rangpur', '', '', '', 1, NULL, NULL, NULL),
(11, 1, 'Cumilla', 'কুমিল্লা', 'CC', 'cumilla', '', '', '', 1, NULL, NULL, NULL),
(12, 62, 'Mymensingh', 'ময়মনসিংহ', 'CC', 'mymensingh', '', '', '', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city_corporation_wards`
--

CREATE TABLE `city_corporation_wards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_ward_no` bigint(20) NOT NULL,
  `bn_ward_no` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `councils`
--

CREATE TABLE `councils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `union_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `council_members`
--

CREATE TABLE `council_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `council_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `word_no_text` text DEFAULT NULL,
  `concilor_designation_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `council_member_histories`
--

CREATE TABLE `council_member_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `council_id` bigint(20) UNSIGNED NOT NULL,
  `council_member_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `concilor_designation_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `word_no_text` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'US', 'United States', NULL, NULL),
(2, 'CA', 'Canada', NULL, NULL),
(3, 'AF', 'Afghanistan', NULL, NULL),
(4, 'AL', 'Albania', NULL, NULL),
(5, 'DZ', 'Algeria', NULL, NULL),
(6, 'AS', 'American Samoa', NULL, NULL),
(7, 'AD', 'Andorra', NULL, NULL),
(8, 'AO', 'Angola', NULL, NULL),
(9, 'AI', 'Anguilla', NULL, NULL),
(10, 'AQ', 'Antarctica', NULL, NULL),
(11, 'AG', 'Antigua and/or Barbuda', NULL, NULL),
(12, 'AR', 'Argentina', NULL, NULL),
(13, 'AM', 'Armenia', NULL, NULL),
(14, 'AW', 'Aruba', NULL, NULL),
(15, 'AU', 'Australia', NULL, NULL),
(16, 'AT', 'Austria', NULL, NULL),
(17, 'AZ', 'Azerbaijan', NULL, NULL),
(18, 'BS', 'Bahamas', NULL, NULL),
(19, 'BH', 'Bahrain', NULL, NULL),
(20, 'BD', 'Bangladesh', NULL, NULL),
(21, 'BB', 'Barbados', NULL, NULL),
(22, 'BY', 'Belarus', NULL, NULL),
(23, 'BE', 'Belgium', NULL, NULL),
(24, 'BZ', 'Belize', NULL, NULL),
(25, 'BJ', 'Benin', NULL, NULL),
(26, 'BM', 'Bermuda', NULL, NULL),
(27, 'BT', 'Bhutan', NULL, NULL),
(28, 'BO', 'Bolivia', NULL, NULL),
(29, 'BA', 'Bosnia and Herzegovina', NULL, NULL),
(30, 'BW', 'Botswana', NULL, NULL),
(31, 'BV', 'Bouvet Island', NULL, NULL),
(32, 'BR', 'Brazil', NULL, NULL),
(33, 'IO', 'British lndian Ocean Territory', NULL, NULL),
(34, 'BN', 'Brunei Darussalam', NULL, NULL),
(35, 'BG', 'Bulgaria', NULL, NULL),
(36, 'BF', 'Burkina Faso', NULL, NULL),
(37, 'BI', 'Burundi', NULL, NULL),
(38, 'KH', 'Cambodia', NULL, NULL),
(39, 'CM', 'Cameroon', NULL, NULL),
(40, 'CV', 'Cape Verde', NULL, NULL),
(41, 'KY', 'Cayman Islands', NULL, NULL),
(42, 'CF', 'Central African Republic', NULL, NULL),
(43, 'TD', 'Chad', NULL, NULL),
(44, 'CL', 'Chile', NULL, NULL),
(45, 'CN', 'China', NULL, NULL),
(46, 'CX', 'Christmas Island', NULL, NULL),
(47, 'CC', 'Cocos (Keeling) Islands', NULL, NULL),
(48, 'CO', 'Colombia', NULL, NULL),
(49, 'KM', 'Comoros', NULL, NULL),
(50, 'CG', 'Congo', NULL, NULL),
(51, 'CK', 'Cook Islands', NULL, NULL),
(52, 'CR', 'Costa Rica', NULL, NULL),
(53, 'HR', 'Croatia (Hrvatska)', NULL, NULL),
(54, 'CU', 'Cuba', NULL, NULL),
(55, 'CY', 'Cyprus', NULL, NULL),
(56, 'CZ', 'Czech Republic', NULL, NULL),
(57, 'CD', 'Democratic Republic of Congo', NULL, NULL),
(58, 'DK', 'Denmark', NULL, NULL),
(59, 'DJ', 'Djibouti', NULL, NULL),
(60, 'DM', 'Dominica', NULL, NULL),
(61, 'DO', 'Dominican Republic', NULL, NULL),
(62, 'TP', 'East Timor', NULL, NULL),
(63, 'EC', 'Ecudaor', NULL, NULL),
(64, 'EG', 'Egypt', NULL, NULL),
(65, 'SV', 'El Salvador', NULL, NULL),
(66, 'GQ', 'Equatorial Guinea', NULL, NULL),
(67, 'ER', 'Eritrea', NULL, NULL),
(68, 'EE', 'Estonia', NULL, NULL),
(69, 'ET', 'Ethiopia', NULL, NULL),
(70, 'FK', 'Falkland Islands (Malvinas)', NULL, NULL),
(71, 'FO', 'Faroe Islands', NULL, NULL),
(72, 'FJ', 'Fiji', NULL, NULL),
(73, 'FI', 'Finland', NULL, NULL),
(74, 'FR', 'France', NULL, NULL),
(75, 'FX', 'France, Metropolitan', NULL, NULL),
(76, 'GF', 'French Guiana', NULL, NULL),
(77, 'PF', 'French Polynesia', NULL, NULL),
(78, 'TF', 'French Southern Territories', NULL, NULL),
(79, 'GA', 'Gabon', NULL, NULL),
(80, 'GM', 'Gambia', NULL, NULL),
(81, 'GE', 'Georgia', NULL, NULL),
(82, 'DE', 'Germany', NULL, NULL),
(83, 'GH', 'Ghana', NULL, NULL),
(84, 'GI', 'Gibraltar', NULL, NULL),
(85, 'GR', 'Greece', NULL, NULL),
(86, 'GL', 'Greenland', NULL, NULL),
(87, 'GD', 'Grenada', NULL, NULL),
(88, 'GP', 'Guadeloupe', NULL, NULL),
(89, 'GU', 'Guam', NULL, NULL),
(90, 'GT', 'Guatemala', NULL, NULL),
(91, 'GN', 'Guinea', NULL, NULL),
(92, 'GW', 'Guinea-Bissau', NULL, NULL),
(93, 'GY', 'Guyana', NULL, NULL),
(94, 'HT', 'Haiti', NULL, NULL),
(95, 'HM', 'Heard and Mc Donald Islands', NULL, NULL),
(96, 'HN', 'Honduras', NULL, NULL),
(97, 'HK', 'Hong Kong', NULL, NULL),
(98, 'HU', 'Hungary', NULL, NULL),
(99, 'IS', 'Iceland', NULL, NULL),
(100, 'IN', 'India', NULL, NULL),
(101, 'ID', 'Indonesia', NULL, NULL),
(102, 'IR', 'Iran (Islamic Republic of)', NULL, NULL),
(103, 'IQ', 'Iraq', NULL, NULL),
(104, 'IE', 'Ireland', NULL, NULL),
(105, 'IL', 'Israel', NULL, NULL),
(106, 'IT', 'Italy', NULL, NULL),
(107, 'CI', 'Ivory Coast', NULL, NULL),
(108, 'JM', 'Jamaica', NULL, NULL),
(109, 'JP', 'Japan', NULL, NULL),
(110, 'JO', 'Jordan', NULL, NULL),
(111, 'KZ', 'Kazakhstan', NULL, NULL),
(112, 'KE', 'Kenya', NULL, NULL),
(113, 'KI', 'Kiribati', NULL, NULL),
(114, 'KP', 'Korea, Democratic People\'s Republic of', NULL, NULL),
(115, 'KR', 'Korea, Republic of', NULL, NULL),
(116, 'KW', 'Kuwait', NULL, NULL),
(117, 'KG', 'Kyrgyzstan', NULL, NULL),
(118, 'LA', 'Lao People\'s Democratic Republic', NULL, NULL),
(119, 'LV', 'Latvia', NULL, NULL),
(120, 'LB', 'Lebanon', NULL, NULL),
(121, 'LS', 'Lesotho', NULL, NULL),
(122, 'LR', 'Liberia', NULL, NULL),
(123, 'LY', 'Libyan Arab Jamahiriya', NULL, NULL),
(124, 'LI', 'Liechtenstein', NULL, NULL),
(125, 'LT', 'Lithuania', NULL, NULL),
(126, 'LU', 'Luxembourg', NULL, NULL),
(127, 'MO', 'Macau', NULL, NULL),
(128, 'MK', 'Macedonia', NULL, NULL),
(129, 'MG', 'Madagascar', NULL, NULL),
(130, 'MW', 'Malawi', NULL, NULL),
(131, 'MY', 'Malaysia', NULL, NULL),
(132, 'MV', 'Maldives', NULL, NULL),
(133, 'ML', 'Mali', NULL, NULL),
(134, 'MT', 'Malta', NULL, NULL),
(135, 'MH', 'Marshall Islands', NULL, NULL),
(136, 'MQ', 'Martinique', NULL, NULL),
(137, 'MR', 'Mauritania', NULL, NULL),
(138, 'MU', 'Mauritius', NULL, NULL),
(139, 'TY', 'Mayotte', NULL, NULL),
(140, 'MX', 'Mexico', NULL, NULL),
(141, 'FM', 'Micronesia, Federated States of', NULL, NULL),
(142, 'MD', 'Moldova, Republic of', NULL, NULL),
(143, 'MC', 'Monaco', NULL, NULL),
(144, 'MN', 'Mongolia', NULL, NULL),
(145, 'MS', 'Montserrat', NULL, NULL),
(146, 'MA', 'Morocco', NULL, NULL),
(147, 'MZ', 'Mozambique', NULL, NULL),
(148, 'MM', 'Myanmar', NULL, NULL),
(149, 'NA', 'Namibia', NULL, NULL),
(150, 'NR', 'Nauru', NULL, NULL),
(151, 'NP', 'Nepal', NULL, NULL),
(152, 'NL', 'Netherlands', NULL, NULL),
(153, 'AN', 'Netherlands Antilles', NULL, NULL),
(154, 'NC', 'New Caledonia', NULL, NULL),
(155, 'NZ', 'New Zealand', NULL, NULL),
(156, 'NI', 'Nicaragua', NULL, NULL),
(157, 'NE', 'Niger', NULL, NULL),
(158, 'NG', 'Nigeria', NULL, NULL),
(159, 'NU', 'Niue', NULL, NULL),
(160, 'NF', 'Norfork Island', NULL, NULL),
(161, 'MP', 'Northern Mariana Islands', NULL, NULL),
(162, 'NO', 'Norway', NULL, NULL),
(163, 'OM', 'Oman', NULL, NULL),
(164, 'PK', 'Pakistan', NULL, NULL),
(165, 'PW', 'Palau', NULL, NULL),
(166, 'PA', 'Panama', NULL, NULL),
(167, 'PG', 'Papua New Guinea', NULL, NULL),
(168, 'PY', 'Paraguay', NULL, NULL),
(169, 'PE', 'Peru', NULL, NULL),
(170, 'PH', 'Philippines', NULL, NULL),
(171, 'PN', 'Pitcairn', NULL, NULL),
(172, 'PL', 'Poland', NULL, NULL),
(173, 'PT', 'Portugal', NULL, NULL),
(174, 'PR', 'Puerto Rico', NULL, NULL),
(175, 'QA', 'Qatar', NULL, NULL),
(176, 'SS', 'Republic of South Sudan', NULL, NULL),
(177, 'RE', 'Reunion', NULL, NULL),
(178, 'RO', 'Romania', NULL, NULL),
(179, 'RU', 'Russian Federation', NULL, NULL),
(180, 'RW', 'Rwanda', NULL, NULL),
(181, 'KN', 'Saint Kitts and Nevis', NULL, NULL),
(182, 'LC', 'Saint Lucia', NULL, NULL),
(183, 'VC', 'Saint Vincent and the Grenadines', NULL, NULL),
(184, 'WS', 'Samoa', NULL, NULL),
(185, 'SM', 'San Marino', NULL, NULL),
(186, 'ST', 'Sao Tome and Principe', NULL, NULL),
(187, 'SA', 'Saudi Arabia', NULL, NULL),
(188, 'SN', 'Senegal', NULL, NULL),
(189, 'RS', 'Serbia', NULL, NULL),
(190, 'SC', 'Seychelles', NULL, NULL),
(191, 'SL', 'Sierra Leone', NULL, NULL),
(192, 'SG', 'Singapore', NULL, NULL),
(193, 'SK', 'Slovakia', NULL, NULL),
(194, 'SI', 'Slovenia', NULL, NULL),
(195, 'SB', 'Solomon Islands', NULL, NULL),
(196, 'SO', 'Somalia', NULL, NULL),
(197, 'ZA', 'South Africa', NULL, NULL),
(198, 'GS', 'South Georgia South Sandwich Islands', NULL, NULL),
(199, 'ES', 'Spain', NULL, NULL),
(200, 'LK', 'Sri Lanka', NULL, NULL),
(201, 'SH', 'St. Helena', NULL, NULL),
(202, 'PM', 'St. Pierre and Miquelon', NULL, NULL),
(203, 'SD', 'Sudan', NULL, NULL),
(204, 'SR', 'Suriname', NULL, NULL),
(205, 'SJ', 'Svalbarn and Jan Mayen Islands', NULL, NULL),
(206, 'SZ', 'Swaziland', NULL, NULL),
(207, 'SE', 'Sweden', NULL, NULL),
(208, 'CH', 'Switzerland', NULL, NULL),
(209, 'SY', 'Syrian Arab Republic', NULL, NULL),
(210, 'TW', 'Taiwan', NULL, NULL),
(211, 'TJ', 'Tajikistan', NULL, NULL),
(212, 'TZ', 'Tanzania, United Republic of', NULL, NULL),
(213, 'TH', 'Thailand', NULL, NULL),
(214, 'TG', 'Togo', NULL, NULL),
(215, 'TK', 'Tokelau', NULL, NULL),
(216, 'TO', 'Tonga', NULL, NULL),
(217, 'TT', 'Trinidad and Tobago', NULL, NULL),
(218, 'TN', 'Tunisia', NULL, NULL),
(219, 'TR', 'Turkey', NULL, NULL),
(220, 'TM', 'Turkmenistan', NULL, NULL),
(221, 'TC', 'Turks and Caicos Islands', NULL, NULL),
(222, 'TV', 'Tuvalu', NULL, NULL),
(223, 'UG', 'Uganda', NULL, NULL),
(224, 'UA', 'Ukraine', NULL, NULL),
(225, 'AE', 'United Arab Emirates', NULL, NULL),
(226, 'GB', 'United Kingdom', NULL, NULL),
(227, 'UM', 'United States minor outlying islands', NULL, NULL),
(228, 'UY', 'Uruguay', NULL, NULL),
(229, 'UZ', 'Uzbekistan', NULL, NULL),
(230, 'VU', 'Vanuatu', NULL, NULL),
(231, 'VA', 'Vatican City State', NULL, NULL),
(232, 'VE', 'Venezuela', NULL, NULL),
(233, 'VN', 'Vietnam', NULL, NULL),
(234, 'VG', 'Virgin Islands (British)', NULL, NULL),
(235, 'VI', 'Virgin Islands (U.S.)', NULL, NULL),
(236, 'WF', 'Wallis and Futuna Islands', NULL, NULL),
(237, 'EH', 'Western Sahara', NULL, NULL),
(238, 'YE', 'Yemen', NULL, NULL),
(239, 'YU', 'Yugoslavia', NULL, NULL),
(240, 'ZR', 'Zaire', NULL, NULL),
(241, 'ZM', 'Zambia', NULL, NULL),
(242, 'ZW', 'Zimbabwe', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `death_certificates`
--

CREATE TABLE `death_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(16,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `total_amount` double(16,2) NOT NULL DEFAULT 0.00,
  `taken_by` bigint(20) NOT NULL DEFAULT 1,
  `date_of_death` varchar(191) DEFAULT NULL,
  `cause_of_death` varchar(191) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `death_certificates`
--

INSERT INTO `death_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `taken_by`, `date_of_death`, `cause_of_death`, `comments`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2026041802001', 108, 0.00, 0, 0.00, 1, '2026-04-06', 'natural', NULL, 7, '2026-04-18 11:26:06', '2026-04-18 11:26:06'),
(2, '26042203001', 8, 0.00, 0, 0.00, 1, '2026-04-21T11:13', 'natural', NULL, 7, '2026-04-21 23:13:34', '2026-04-21 23:13:34'),
(3, '26042503001', 125, 0.00, 0, 0.00, 1, '2021-10-24T00:00', 'natural', NULL, 7, '2026-04-25 00:23:35', '2026-04-25 00:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `disability_certificates`
--

CREATE TABLE `disability_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disability_certificates`
--

INSERT INTO `disability_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:58:27', '2022-10-21 00:58:27'),
(2, '2022102', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:59:06', '2022-10-21 00:59:06'),
(3, '20260315001', 56, 0.00, 1, 0.00, 7, '2026-03-15 11:38:44', '2026-03-15 11:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `disability_infos`
--

CREATE TABLE `disability_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_disability` tinyint(1) NOT NULL DEFAULT 0,
  `disability_name_id` bigint(20) DEFAULT NULL,
  `disability_category_id` bigint(20) DEFAULT NULL,
  `disability_type_id` bigint(20) DEFAULT NULL,
  `start_date` varchar(191) DEFAULT NULL,
  `treatment_status_id` bigint(20) DEFAULT NULL,
  `disability_doctor` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disability_infos`
--

INSERT INTO `disability_infos` (`id`, `user_id`, `is_disability`, `disability_name_id`, `disability_category_id`, `disability_type_id`, `start_date`, `treatment_status_id`, `disability_doctor`, `created_at`, `updated_at`) VALUES
(2, 6, 1, 2, 1, 2, '2022-09-29', 2, 'test', '2022-09-09 13:14:02', '2022-09-09 15:38:50'),
(3, 78, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-02 14:40:35', '2026-03-02 14:40:35'),
(4, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-03 15:27:49', '2026-03-03 15:27:49'),
(5, 85, 1, 2, 1, 2, '2026-03-01', 2, 'Dr. Ahsan', '2026-03-31 00:14:18', '2026-03-31 00:14:18'),
(6, 86, 1, 1, 1, 2, '2026-04-16', 3, '2345678', '2026-04-02 01:30:49', '2026-04-02 01:31:14'),
(7, 134, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 23:05:38', '2026-05-01 23:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `lat` varchar(191) DEFAULT NULL,
  `lon` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `bn_name`, `lat`, `lon`, `url`, `status`, `division_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Comilla', 'কুমিল্লা', '23.4682747', '91.1788135', 'www.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(2, 'Feni', 'ফেনী', '23.023231', '91.3840844', 'www.feni.gov.bd', 1, 1, NULL, NULL, NULL),
(3, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', '23.9570904', '91.1119286', 'www.brahmanbaria.gov.bd', 1, 1, NULL, NULL, NULL),
(4, 'Rangamati', 'রাঙ্গামাটি', NULL, NULL, 'www.rangamati.gov.bd', 1, 1, NULL, NULL, NULL),
(5, 'Noakhali', 'নোয়াখালী', '22.869563', '91.099398', 'www.noakhali.gov.bd', 1, 1, NULL, NULL, NULL),
(6, 'Chandpur', 'চাঁদপুর', '23.2332585', '90.6712912', 'www.chandpur.gov.bd', 1, 1, NULL, NULL, NULL),
(7, 'Lakshmipur', 'লক্ষ্মীপুর', '22.942477', '90.841184', 'www.lakshmipur.gov.bd', 1, 1, NULL, NULL, NULL),
(8, 'Chattogram', 'চট্টগ্রাম', '22.335109', '91.834073', 'www.chittagong.gov.bd', 1, 1, NULL, NULL, NULL),
(9, 'Coxsbazar', 'কক্সবাজার', NULL, NULL, 'www.coxsbazar.gov.bd', 1, 1, NULL, NULL, NULL),
(10, 'Khagrachhari', 'খাগড়াছড়ি', '23.119285', '91.984663', 'www.khagrachhari.gov.bd', 1, 1, NULL, NULL, NULL),
(11, 'Bandarban', 'বান্দরবান', '22.1953275', '92.2183773', 'www.bandarban.gov.bd', 1, 1, NULL, NULL, NULL),
(12, 'Sirajganj', 'সিরাজগঞ্জ', '24.4533978', '89.7006815', 'www.sirajganj.gov.bd', 1, 2, NULL, NULL, NULL),
(13, 'Pabna', 'পাবনা', '23.998524', '89.233645', 'www.pabna.gov.bd', 1, 2, NULL, NULL, NULL),
(14, 'Bogura', 'বগুড়া', '24.8465228', '89.377755', 'www.bogra.gov.bd', 1, 2, NULL, NULL, NULL),
(15, 'Rajshahi', 'রাজশাহী', NULL, NULL, 'www.rajshahi.gov.bd', 1, 2, NULL, NULL, NULL),
(16, 'Natore', 'নাটোর', '24.420556', '89.000282', 'www.natore.gov.bd', 1, 2, NULL, NULL, NULL),
(17, 'Joypurhat', 'জয়পুরহাট', NULL, NULL, 'www.joypurhat.gov.bd', 1, 2, NULL, NULL, NULL),
(18, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', '24.5965034', '88.2775122', 'www.chapainawabganj.gov.bd', 1, 2, NULL, NULL, NULL),
(19, 'Naogaon', 'নওগাঁ', NULL, NULL, 'www.naogaon.gov.bd', 1, 2, NULL, NULL, NULL),
(20, 'Jashore', 'যশোর', '23.16643', '89.2081126', 'www.jessore.gov.bd', 1, 3, NULL, NULL, NULL),
(21, 'Satkhira', 'সাতক্ষীরা', NULL, NULL, 'www.satkhira.gov.bd', 1, 3, NULL, NULL, NULL),
(22, 'Meherpur', 'মেহেরপুর', '23.762213', '88.631821', 'www.meherpur.gov.bd', 1, 3, NULL, NULL, NULL),
(23, 'Narail', 'নড়াইল', '23.172534', '89.512672', 'www.narail.gov.bd', 1, 3, NULL, NULL, NULL),
(24, 'Chuadanga', 'চুয়াডাঙ্গা', '23.6401961', '88.841841', 'www.chuadanga.gov.bd', 1, 3, NULL, NULL, NULL),
(25, 'Kushtia', 'কুষ্টিয়া', '23.901258', '89.120482', 'www.kushtia.gov.bd', 1, 3, NULL, NULL, NULL),
(26, 'Magura', 'মাগুরা', '23.487337', '89.419956', 'www.magura.gov.bd', 1, 3, NULL, NULL, NULL),
(27, 'Khulna', 'খুলনা', '22.815774', '89.568679', 'www.khulna.gov.bd', 1, 3, NULL, NULL, NULL),
(28, 'Bagerhat', 'বাগেরহাট', '22.651568', '89.785938', 'www.bagerhat.gov.bd', 1, 3, NULL, NULL, NULL),
(29, 'Jhenaidah', 'ঝিনাইদহ', '23.5448176', '89.1539213', 'www.jhenaidah.gov.bd', 1, 3, NULL, NULL, NULL),
(30, 'Jhalakathi', 'ঝালকাঠি', NULL, NULL, 'www.jhalakathi.gov.bd', 1, 4, NULL, NULL, NULL),
(31, 'Patuakhali', 'পটুয়াখালী', '22.3596316', '90.3298712', 'www.patuakhali.gov.bd', 1, 4, NULL, NULL, NULL),
(32, 'Pirojpur', 'পিরোজপুর', NULL, NULL, 'www.pirojpur.gov.bd', 1, 4, NULL, NULL, NULL),
(33, 'Barisal', 'বরিশাল', NULL, NULL, 'www.barisal.gov.bd', 1, 4, NULL, NULL, NULL),
(34, 'Bhola', 'ভোলা', '22.685923', '90.648179', 'www.bhola.gov.bd', 1, 4, NULL, NULL, NULL),
(35, 'Barguna', 'বরগুনা', NULL, NULL, 'www.barguna.gov.bd', 1, 4, NULL, NULL, NULL),
(36, 'Sylhet', 'সিলেট', '24.8897956', '91.8697894', 'www.sylhet.gov.bd', 1, 5, NULL, NULL, NULL),
(37, 'Moulvibazar', 'মৌলভীবাজার', '24.482934', '91.777417', 'www.moulvibazar.gov.bd', 1, 5, NULL, NULL, NULL),
(38, 'Habiganj', 'হবিগঞ্জ', '24.374945', '91.41553', 'www.habiganj.gov.bd', 1, 5, NULL, NULL, NULL),
(39, 'Sunamganj', 'সুনামগঞ্জ', '25.0658042', '91.3950115', 'www.sunamganj.gov.bd', 1, 5, NULL, NULL, NULL),
(40, 'Narsingdi', 'নরসিংদী', '23.932233', '90.71541', 'www.narsingdi.gov.bd', 1, 6, NULL, NULL, NULL),
(41, 'Gazipur', 'গাজীপুর', '24.0022858', '90.4264283', 'www.gazipur.gov.bd', 1, 6, NULL, NULL, NULL),
(42, 'Shariatpur', 'শরীয়তপুর', NULL, NULL, 'www.shariatpur.gov.bd', 1, 6, NULL, NULL, NULL),
(43, 'Narayanganj', 'নারায়ণগঞ্জ', '23.63366', '90.496482', 'www.narayanganj.gov.bd', 1, 6, NULL, NULL, NULL),
(44, 'Tangail', 'টাঙ্গাইল', NULL, NULL, 'www.tangail.gov.bd', 1, 6, NULL, NULL, NULL),
(45, 'Kishoreganj', 'কিশোরগঞ্জ', '24.444937', '90.776575', 'www.kishoreganj.gov.bd', 1, 6, NULL, NULL, NULL),
(46, 'Manikganj', 'মানিকগঞ্জ', NULL, NULL, 'www.manikganj.gov.bd', 1, 6, NULL, NULL, NULL),
(47, 'Dhaka', 'ঢাকা', '23.7115253', '90.4111451', 'www.dhaka.gov.bd', 1, 6, NULL, NULL, NULL),
(48, 'Munshiganj', 'মুন্সিগঞ্জ', NULL, NULL, 'www.munshiganj.gov.bd', 1, 6, NULL, NULL, NULL),
(49, 'Rajbari', 'রাজবাড়ী', '23.7574305', '89.6444665', 'www.rajbari.gov.bd', 1, 6, NULL, NULL, NULL),
(50, 'Madaripur', 'মাদারীপুর', '23.164102', '90.1896805', 'www.madaripur.gov.bd', 1, 6, NULL, NULL, NULL),
(51, 'Gopalganj', 'গোপালগঞ্জ', '23.0050857', '89.8266059', 'www.gopalganj.gov.bd', 1, 6, NULL, NULL, NULL),
(52, 'Faridpur', 'ফরিদপুর', '23.6070822', '89.8429406', 'www.faridpur.gov.bd', 1, 6, NULL, NULL, NULL),
(53, 'Panchagarh', 'পঞ্চগড়', '26.3411', '88.5541606', 'www.panchagarh.gov.bd', 1, 7, NULL, NULL, NULL),
(54, 'Dinajpur', 'দিনাজপুর', '25.6217061', '88.6354504', 'www.dinajpur.gov.bd', 1, 7, NULL, NULL, NULL),
(55, 'Lalmonirhat', 'লালমনিরহাট', NULL, NULL, 'www.lalmonirhat.gov.bd', 1, 7, NULL, NULL, NULL),
(56, 'Nilphamari', 'নীলফামারী', '25.931794', '88.856006', 'www.nilphamari.gov.bd', 1, 7, NULL, NULL, NULL),
(57, 'Gaibandha', 'গাইবান্ধা', '25.328751', '89.528088', 'www.gaibandha.gov.bd', 1, 7, NULL, NULL, NULL),
(58, 'Thakurgaon', 'ঠাকুরগাঁও', '26.0336945', '88.4616834', 'www.thakurgaon.gov.bd', 1, 7, NULL, NULL, NULL),
(59, 'Rangpur', 'রংপুর', '25.7558096', '89.244462', 'www.rangpur.gov.bd', 1, 7, NULL, NULL, NULL),
(60, 'Kurigram', 'কুড়িগ্রাম', '25.805445', '89.636174', 'www.kurigram.gov.bd', 1, 7, NULL, NULL, NULL),
(61, 'Sherpur', 'শেরপুর', '25.0204933', '90.0152966', 'www.sherpur.gov.bd', 1, 8, NULL, NULL, NULL),
(62, 'Mymensingh', 'ময়মনসিংহ', NULL, NULL, 'www.mymensingh.gov.bd', 1, 8, NULL, NULL, NULL),
(63, 'Jamalpur', 'জামালপুর', '24.937533', '89.937775', 'www.jamalpur.gov.bd', 1, 8, NULL, NULL, NULL),
(64, 'Netrokona', 'নেত্রকোণা', '24.870955', '90.727887', 'www.netrokona.gov.bd', 1, 8, NULL, NULL, NULL),
(65, 'Dhaka Metro', 'ঢাকা মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', 1, 6, NULL, NULL, NULL),
(66, 'Chittagang Metro', 'চট্রগ্রাম মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', 1, 1, NULL, NULL, NULL),
(67, 'Rajshahi Metro', 'রাজশাহী মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', 1, 2, NULL, NULL, NULL),
(68, 'Khulna Metro', 'খুলনা মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', 1, 3, NULL, NULL, NULL),
(69, 'Barishal Metro', 'বরিশাল মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', 1, 4, NULL, NULL, NULL),
(70, 'Sylhet Metro', 'সিলেট মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', 1, 5, NULL, NULL, NULL),
(71, 'Rangpur Metro', 'রংপুর মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', 1, 7, NULL, NULL, NULL),
(72, 'Gazipur Metro', 'গাজীপুর মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', 1, 6, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `country_id`, `name`, `bn_name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chattogram', 'চট্টগ্রাম', 1, NULL, NULL, NULL),
(2, 1, 'Rajshahi', 'রাজশাহী', 1, NULL, NULL, NULL),
(3, 1, 'Khulna', 'খুলনা', 1, NULL, NULL, NULL),
(4, 1, 'Barishal', 'বরিশাল', 1, NULL, NULL, NULL),
(5, 1, 'Sylhet', 'সিলেট', 1, NULL, NULL, NULL),
(6, 1, 'Dhaka', 'ঢাকা', 1, NULL, NULL, NULL),
(7, 1, 'Rangpur', 'রংপুর', 1, NULL, NULL, NULL),
(8, 1, 'Mymensingh', 'ময়মনসিংহ', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divorces`
--

CREATE TABLE `divorces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `educational_infos`
--

CREATE TABLE `educational_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `degree_id` bigint(20) DEFAULT NULL,
  `group_id` bigint(20) DEFAULT NULL,
  `grade_id` bigint(20) DEFAULT NULL,
  `board_id` bigint(20) DEFAULT NULL,
  `passing_year` varchar(191) DEFAULT NULL,
  `institute` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educational_infos`
--

INSERT INTO `educational_infos` (`id`, `user_id`, `degree_id`, `group_id`, `grade_id`, `board_id`, `passing_year`, `institute`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 1, 1, 1, NULL, 'Uttara High School', '2022-12-05 08:22:03', '2022-12-05 08:22:03'),
(2, 11, 1, 1, 1, 1, NULL, 'Suktail Union High School', '2022-12-05 23:16:27', '2022-12-05 23:16:27'),
(3, 18, 1, 1, 1, 1, NULL, NULL, '2022-12-07 14:27:38', '2022-12-07 14:27:38'),
(4, 24, 2, 3, 1, 1, NULL, 'Suktail Union High School', '2023-02-26 21:57:51', '2023-02-26 21:57:51'),
(5, 24, 1, 3, 1, 1, NULL, 'Govt. Bangabandhu College, Gopalganj', '2023-02-26 21:57:51', '2023-02-26 21:57:51'),
(6, 43, 3, 3, 7, 5, NULL, 'Quia esse reiciendis', '2024-06-24 04:49:29', '2024-06-24 04:49:29'),
(7, 31, 3, 1, 1, 1, NULL, NULL, '2025-08-27 14:07:06', '2025-08-27 14:07:06'),
(8, 31, 2, 1, 1, 1, NULL, NULL, '2025-08-27 14:07:06', '2025-08-27 14:07:06'),
(9, 31, 1, 1, 1, 1, NULL, NULL, '2025-08-27 14:07:06', '2025-08-27 14:07:06'),
(10, 53, 1, 1, 1, 1, NULL, NULL, '2026-01-27 12:30:57', '2026-01-27 12:30:57'),
(11, 66, 1, 1, 3, 1, NULL, NULL, '2026-02-13 00:19:30', '2026-02-13 00:19:30'),
(12, 78, 2, 3, 8, 3, NULL, 'Ut ipsa obcaecati m', '2026-03-02 14:35:09', '2026-03-02 14:35:09'),
(13, 80, 1, 2, 5, 5, NULL, 'Recusandae Quia est', '2026-03-03 15:24:29', '2026-03-03 15:24:29'),
(14, 85, 1, 1, 1, 1, NULL, NULL, '2026-03-28 09:32:01', '2026-03-28 09:32:01'),
(15, 84, 1, 1, 1, 1, NULL, 'Uttara High School', '2026-03-30 11:30:48', '2026-03-30 11:30:48'),
(16, 86, 1, 1, 1, 1, NULL, 'fsdfda', '2026-04-02 01:28:22', '2026-04-02 01:28:22'),
(17, 134, 1, 1, 1, 1, NULL, NULL, '2026-05-01 23:04:20', '2026-05-01 23:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_categories`
--

CREATE TABLE `family_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_categories`
--

INSERT INTO `family_categories` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Joint Family', 'যৌথ পরিবার', 'joint-family', 1, 7, NULL, '2022-10-14 22:06:35', '2022-10-15 00:08:07'),
(2, 'Single Family', 'একক পরিবার', 'single-family', 1, 7, NULL, '2022-10-15 00:09:12', '2022-10-15 00:09:12');

-- --------------------------------------------------------

--
-- Table structure for table `family_infos`
--

CREATE TABLE `family_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `family_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `family_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `father_name` varchar(191) DEFAULT NULL,
  `father_name_bn` varchar(191) DEFAULT NULL,
  `father_live_status` bigint(20) DEFAULT NULL,
  `father_nid` varchar(191) DEFAULT NULL,
  `mother_name` varchar(191) DEFAULT NULL,
  `mother_name_bn` varchar(191) DEFAULT NULL,
  `mother_live_status` bigint(20) DEFAULT NULL,
  `mother_nid` varchar(191) DEFAULT NULL,
  `marital_status` bigint(20) DEFAULT NULL,
  `spouse_name` varchar(191) DEFAULT NULL,
  `spouse_nid` varchar(191) DEFAULT NULL,
  `married_date` varchar(191) DEFAULT NULL,
  `have_children` tinyint(1) DEFAULT NULL,
  `boys` int(11) DEFAULT NULL,
  `girls` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_infos`
--

INSERT INTO `family_infos` (`id`, `user_id`, `family_type_id`, `family_category_id`, `father_name`, `father_name_bn`, `father_live_status`, `father_nid`, `mother_name`, `mother_name_bn`, `mother_live_status`, `mother_nid`, `marital_status`, `spouse_name`, `spouse_nid`, `married_date`, `have_children`, `boys`, `girls`, `created_at`, `updated_at`) VALUES
(32, 1, NULL, NULL, 'Hall Alvarez', 'Nolan Kent', NULL, NULL, 'Jolie Lancaster', 'Wing Lee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-27 00:46:40', '2025-08-27 00:46:40'),
(33, 2, NULL, NULL, NULL, 'ফরিদ আহমেদ', NULL, NULL, NULL, 'আবেদা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-27 02:58:16', '2025-08-27 02:58:16'),
(34, 3, 2, 1, 'Md Farid Ahmed', 'মোঃ ফরিদ আহমেদ', 1, '234566', 'Mst. Abeja Sultana', 'মোসাঃ আবেজা সুলতানা', 1, '8776655544', 2, 'Mst. Sahara Khatun', '2345666', '2022-06-07', 1, 0, 1, '2025-08-27 14:04:23', '2025-08-27 14:04:23'),
(35, 4, NULL, NULL, NULL, 'সুজ্জল মিনশি', NULL, NULL, NULL, 'মরজিনা', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-30 01:50:58', '2025-08-30 01:50:58'),
(36, 7, 2, 1, 'Imran Molla', 'ইমরান মোল্লা', 1, '1919914836', 'Fatima Zannat Popy', 'ফাতিমা জান্নাত পপি', 1, '3719916680', 1, NULL, NULL, NULL, 0, NULL, NULL, '2025-08-31 01:53:18', '2026-02-10 12:39:17'),
(41, 8, 2, 1, 'Atiar Rahman Molla', 'আতিয়ার রহমান মোল্লা', 2, NULL, 'Hosne Ara', 'হোসনে আরা', 2, NULL, 2, 'Arifa Sultana', '11111', NULL, 1, 2, 3, '2025-09-01 02:17:55', '2026-04-15 12:55:31'),
(43, 39, 2, 2, 'Md Farid Ahmad Molla', 'মোঃ ফরিদ আহমেদ মোল্যা', 1, NULL, 'Abeda Begum', 'আবেদা বেগম', 1, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, '2026-02-13 00:18:42', '2026-03-28 09:51:56'),
(53, 53, 2, 2, 'Md. Farid Ahmed Molla', 'মোঃ ফরিদ আহমেদ মোল্লা', 1, NULL, 'Mst. Abeja Sultana', 'মোসাঃ আবেজা সুলতানা', 1, NULL, 2, 'Mst. Sahara Khatun', NULL, '2020-04-15', 1, NULL, 1, '2026-03-01 11:17:18', '2026-04-16 09:20:41'),
(54, 56, 2, 2, 'Imran Molla', 'ইমরান মোল্লা', 1, '1919914836', 'Fatima Zannat Popy', 'ফাতিমা জান্নাত পপি', 1, '5647654543', 1, NULL, NULL, NULL, 0, NULL, NULL, '2026-03-02 12:40:29', '2026-04-14 23:35:22'),
(55, 66, 2, 1, 'Md. Farid Ahmed Molla', 'মোঃ ফরিদ আহমেদ মোল্লা', 1, '6789890900', 'Mst. Abeja Sultana', 'মোসাঃ আবেজা সুলতানা', 1, '123444556', 2, 'Mst. Sahara Khatun', '12345566', '2026-04-06', 1, NULL, 1, '2026-03-02 14:26:35', '2026-04-20 22:16:04'),
(65, 98, NULL, NULL, NULL, 'মোঃ ফরিদ আহমেদ মোল্যা', NULL, NULL, NULL, 'আবেদা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-15 08:09:09', '2026-04-15 08:09:09'),
(66, 108, NULL, NULL, 'Md. Farid Ahmed Molla', 'মোঃ ফরিদ আহমেদ মোল্লা', NULL, NULL, 'Mst. Abeja Sultana', 'মোসাঃ আবেজা সুলতানা', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 21:29:55', '2026-04-17 21:29:55'),
(67, 109, NULL, NULL, NULL, 'হাসমত আলী মুন্সী', NULL, NULL, NULL, 'মোছাঃ ফাতেমা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-18 00:53:55', '2026-04-18 00:53:55'),
(68, 111, NULL, NULL, NULL, 'মোঃ লিয়াকত আলী মীর', NULL, NULL, NULL, 'মোছাঃ হেলেনা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-21 23:08:20', '2026-04-21 23:08:20'),
(69, 112, NULL, NULL, NULL, 'কেরামত আলী বিশ্বাস', NULL, NULL, NULL, 'সম্পা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-21 23:58:39', '2026-04-21 23:58:39'),
(70, 113, 2, 1, 'Keramot Ali Biswash', 'কেরামত আলী বিশ্বাস', 1, NULL, 'Shompa Begum', 'সম্পা বেগম', 1, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, '2026-04-22 00:02:57', '2026-04-22 00:10:34'),
(71, 114, 2, 1, NULL, 'কেরামত আলী বিশ্বাস', 1, NULL, NULL, 'সম্পা বেগম', 1, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, '2026-04-22 00:20:49', '2026-04-22 00:57:27'),
(72, 115, 1, 1, 'NAZIR', 'নাজির', 1, NULL, 'RAHIMA KHANOM BOBITA', 'রহিমা খানম ববিতা', 1, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, '2026-04-22 05:47:14', '2026-04-22 05:47:43'),
(73, 116, NULL, NULL, 'NAZIR', 'নাজির', NULL, NULL, 'RAHIMA KAHNOM BOBITA', 'রহিমা খানম ববিতা', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 05:50:10', '2026-04-22 05:50:10'),
(74, 117, NULL, NULL, NULL, 'মোঃ আরজ আলী শিকদার', NULL, NULL, NULL, 'মোসাঃ মহরন বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-22 07:00:59', '2026-04-22 07:00:59'),
(75, 118, 1, 2, 'Md. Atiar Rahman Molla', 'মোঃ আতিয়ার রহমান মোল্লা', 2, NULL, 'Hosne Ara', 'হোসনে আরা', 2, NULL, 2, 'Mrs. Kazali Akter', '34568', '1999-03-31', 1, 1, 1, '2026-04-22 17:50:11', '2026-04-22 18:09:31'),
(76, 119, 1, 2, 'Md. Monowar Hossain Molla', 'মোঃ মনোয়ার হোসাইন মোল্লা', 1, NULL, 'Mrs. Rezina Akter', 'মিসেস রেজিনা আক্তার', 1, NULL, 2, NULL, NULL, NULL, 0, NULL, NULL, '2026-04-22 19:11:16', '2026-04-22 19:12:30'),
(77, 120, 2, 1, 'Md. Rostum Ali Molla', 'মোঃ রস্তুম আলী মোল্লা', 2, NULL, 'Rahela Banu', 'রাহেলা বানু', 2, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, '2026-04-24 02:44:34', '2026-04-24 02:46:37'),
(78, 123, NULL, NULL, NULL, 'মৃত রসুল শেখ', NULL, NULL, NULL, 'রাবেয়া বছরী', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(79, 124, NULL, NULL, NULL, 'মৃত রসুল শেখ', NULL, NULL, NULL, 'রাবেয়া বছরী', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(80, 122, NULL, NULL, NULL, 'মৃত রসুল শেখ', NULL, NULL, NULL, 'রাবেয়া বছরী', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(81, 121, 1, 2, NULL, 'মৃত রসুল শেখ', 2, NULL, NULL, 'রাবেয়া বছরী', 1, NULL, 2, NULL, NULL, NULL, 0, NULL, NULL, '2026-04-24 21:26:42', '2026-04-24 23:54:13'),
(82, 125, 1, 2, 'Late Mollah Yusuf Ali', 'মৃত মোল্লাহ ইউছুফ আলী', 2, NULL, 'Late Fuljahan Begum', 'মৃত ফুলজাহান বেগম', 2, NULL, 2, 'চেমন আরা মিনু', '7305670462', '1996-04-22', 1, 1, 1, '2026-04-25 00:09:11', '2026-04-25 00:20:25'),
(83, 126, NULL, NULL, 'Md Abdul Quddus Sarkar', 'মোঃ আব্দুল কুদ্দুস সরকার', NULL, NULL, 'Mst Khaleda Begum', 'মোছাঃ খালেদা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-25 23:32:04', '2026-04-25 23:32:04'),
(84, 129, NULL, NULL, 'Abdul Quddus Sarkar', 'আব্দুল কুদ্দুস সরকার', NULL, NULL, 'Khaleda Begum', 'খালেদা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 00:32:46', '2026-04-26 00:32:46'),
(85, 130, NULL, NULL, 'Md Abdul Quddus Sarkar', 'মোঃ আব্দুল কুদ্দুস সরকার', NULL, NULL, 'Mst Khaleda Begum', 'মোছাঃ খালেদা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 01:11:34', '2026-04-26 01:11:34'),
(86, 131, NULL, NULL, 'Md Abdul Quddus Sarkar', 'মোঃ আব্দুল কুদ্দুস সরকার', NULL, NULL, 'Mst Khaleda Begum', 'মোছাঃ খালেদা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 04:25:04', '2026-04-26 04:25:04'),
(87, 134, 1, 1, 'Md Abdul Quddus Sarkar', 'মোঃ আব্দুল কুদ্দুস সরকার', 1, NULL, 'Mst Khaleda Begum', 'মোছাঃ খালেদা বেগম', 1, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, '2026-04-27 02:11:55', '2026-05-01 23:00:29'),
(88, 135, 1, NULL, 'Md Abdul Quddus Sarkar', 'মোঃ আব্দুল কুদ্দুস সরকার', NULL, NULL, 'Mst Khaleda Begum', 'মোছাঃ খালেদা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-28 04:26:34', '2026-04-28 04:26:34'),
(89, 136, 1, NULL, 'Md Abdul Quddus Sarkar', 'মোঃ আব্দুল কুদ্দুস সরকার', NULL, NULL, 'Mst Khaleda Begum', 'মোছাঃ খালেদা বেগম', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-01 23:27:41', '2026-05-01 23:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `family_sub_categories`
--

CREATE TABLE `family_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `family_category_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_sub_categories`
--

INSERT INTO `family_sub_categories` (`id`, `family_category_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Multi Kitchen', 'রান্না আলাদা', 'multi-kitchen', 1, 1, NULL, '2022-12-04 21:26:00', '2022-12-04 21:26:00'),
(2, 1, 'One Kitchen', 'রান্না এক সাথে', 'one-kitchen', 1, 1, NULL, '2022-12-04 21:27:06', '2022-12-04 21:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `family_types`
--

CREATE TABLE `family_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_types`
--

INSERT INTO `family_types` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Family Head', 'পরিবারের  প্রধান', 'family-head', 1, 7, NULL, '2022-09-16 03:55:05', '2022-09-16 03:55:05'),
(2, 'Family Member', 'পরিবারের  সদস্য', 'family-member', 1, 7, NULL, '2022-09-16 03:56:48', '2022-09-16 03:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `financial_infos`
--

CREATE TABLE `financial_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `account_no` varchar(191) DEFAULT NULL,
  `account_type_id` bigint(20) DEFAULT NULL,
  `bank_id` bigint(20) DEFAULT NULL,
  `account_balance` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_infos`
--

INSERT INTO `financial_infos` (`id`, `user_id`, `account_no`, `account_type_id`, `bank_id`, `account_balance`, `created_at`, `updated_at`) VALUES
(1, 1, '101-199-8542', 1, 1, 20.00, '2022-09-09 23:08:45', '2022-09-09 23:08:45'),
(2, 2, '009-101-5895871', 1, 4, 500.00, '2022-09-09 23:08:45', '2022-09-09 23:08:45'),
(3, 3, 'Iste est beatae ame', 1, 6, 11200.00, '2024-06-24 05:14:48', '2024-06-24 05:14:48'),
(4, 4, 'Iste est beatae ame', 1, 6, 11200.00, '2024-06-24 05:15:24', '2024-06-24 05:15:24'),
(5, 7, '154751411', 2, 2, 12.00, '2026-03-02 14:36:25', '2026-03-02 14:36:25'),
(6, 8, '154751411', 2, 2, 12.00, '2026-03-02 14:40:14', '2026-03-02 14:40:14'),
(7, 39, '234', 2, 1, 12.00, '2026-03-03 15:24:58', '2026-03-03 15:24:58'),
(8, 53, '234', 2, 1, 12.00, '2026-03-03 15:26:06', '2026-03-03 15:26:06'),
(9, 56, '234', 2, 1, 12.00, '2026-03-03 15:27:20', '2026-03-03 15:27:20'),
(10, 66, '234', 2, 1, 12.00, '2026-03-03 15:27:41', '2026-03-03 15:27:41'),
(11, 86, '123987345678743', 2, 1, 10000.00, '2026-03-30 11:32:25', '2026-03-30 11:32:25'),
(14, 134, '2863867979279', 2, 2, 23434.00, '2026-05-01 23:05:10', '2026-05-01 23:05:10'),
(15, 134, '2863867979279', 2, 2, 23434.00, '2026-05-01 23:05:17', '2026-05-01 23:05:17'),
(16, 134, '2863867979279', 2, 2, 23434.00, '2026-05-01 23:05:22', '2026-05-01 23:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `financial_instability_certificates`
--

CREATE TABLE `financial_instability_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `financial_instability_certificates`
--

INSERT INTO `financial_instability_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:24:23', '2022-10-21 00:24:23'),
(2, '20260304002', 9, 0.00, 1, 0.00, 7, '2026-03-03 23:13:10', '2026-03-03 23:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `freedom_fighter_infos`
--

CREATE TABLE `freedom_fighter_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_freedom_fighter` tinyint(1) NOT NULL DEFAULT 0,
  `type_id` bigint(20) DEFAULT NULL,
  `area_id` bigint(20) DEFAULT NULL,
  `designation_id` bigint(20) DEFAULT NULL,
  `freedom_fighter_id` varchar(191) DEFAULT NULL,
  `commander_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `freedom_fighter_infos`
--

INSERT INTO `freedom_fighter_infos` (`id`, `user_id`, `is_freedom_fighter`, `type_id`, `area_id`, `designation_id`, `freedom_fighter_id`, `commander_name`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 2, 2, 1, 'ffsdfsd', 'test', '2022-09-09 15:14:10', '2022-09-09 15:39:01'),
(2, 35, 1, 1, 9, 5, '0214', 'hhhh', '2023-05-21 04:32:01', '2023-05-21 04:32:01'),
(3, 78, 1, 1, 1, 1, '1541', 'tres', '2026-03-02 14:41:05', '2026-03-02 14:41:05'),
(4, 85, 1, 1, 10, 5, '234555', 'Gen. Abu Ahmed', '2026-03-31 00:15:17', '2026-03-31 00:15:17'),
(5, 86, 1, 2, 2, 2, 'ersdg', 'fhdhfhf', '2026-04-02 01:31:30', '2026-04-02 01:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `guardian_certificates`
--

CREATE TABLE `guardian_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guardian_certificates`
--

INSERT INTO `guardian_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:06:32', '2022-10-21 00:06:32'),
(2, '2022102', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:08:01', '2022-10-21 00:08:01'),
(3, '20260210001', 11, 0.00, 1, 0.00, 7, '2026-02-10 01:35:43', '2026-02-10 01:35:43'),
(4, '20260315002', 81, 0.00, 1, 0.00, 7, '2026-03-15 11:52:45', '2026-03-15 11:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `health_infos`
--

CREATE TABLE `health_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bp` varchar(191) DEFAULT NULL,
  `bp_up` varchar(191) DEFAULT NULL,
  `bp_down` varchar(191) DEFAULT NULL,
  `diabetes` varchar(191) DEFAULT NULL,
  `diabetes_start_date` varchar(191) DEFAULT NULL,
  `diabetes_status` varchar(191) DEFAULT NULL,
  `diabetes_treatment_status` varchar(191) DEFAULT NULL,
  `diabetes_doctor` varchar(191) DEFAULT NULL,
  `azma` varchar(191) DEFAULT NULL,
  `azma_start_date` varchar(191) DEFAULT NULL,
  `azma_status` varchar(191) DEFAULT NULL,
  `azma_treatment_status` varchar(191) DEFAULT NULL,
  `azma_doctor` varchar(191) DEFAULT NULL,
  `kidney` varchar(191) DEFAULT NULL,
  `kidney_start_date` varchar(191) DEFAULT NULL,
  `kidney_status` varchar(191) DEFAULT NULL,
  `kidney_treatment_status` varchar(191) DEFAULT NULL,
  `kidney_doctor` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `house` varchar(191) NOT NULL,
  `house_bn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `institute_id` bigint(20) UNSIGNED NOT NULL,
  `union_ward_id` bigint(20) DEFAULT NULL,
  `village_id` bigint(20) DEFAULT NULL,
  `village_area_id` bigint(20) DEFAULT NULL,
  `house_type_id` bigint(20) DEFAULT NULL,
  `house_category_id` bigint(20) DEFAULT NULL,
  `house_owner_type_id` bigint(20) DEFAULT NULL,
  `mouza_id` bigint(20) DEFAULT NULL,
  `brs_khatian` varchar(191) DEFAULT NULL,
  `brs_dag` varchar(191) DEFAULT NULL,
  `land_quantity` double(8,2) DEFAULT 0.00,
  `house_price` double(16,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `house`, `house_bn`, `institute_id`, `union_ward_id`, `village_id`, `village_area_id`, `house_type_id`, `house_category_id`, `house_owner_type_id`, `mouza_id`, `brs_khatian`, `brs_dag`, `land_quantity`, `house_price`, `created_at`, `updated_at`) VALUES
(1, 'Cupiditate ut possim', 'Id quia voluptates', 1, 3, 1, 1, 1, NULL, 2, 9, 'Vel sint aut dolore', 'Ex aut expedita a di', 144.00, 119.00, '2022-12-31 07:52:56', '2022-12-31 07:52:56'),
(2, 'Velit distinctio I', 'Enim ratione optio', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, 'Tempora et dicta rep', 'Exercitationem repud', 928.00, 212.00, '2023-01-09 11:50:44', '2023-01-09 11:50:44'),
(3, 'Deserunt exercitatio', 'Atque corrupti sed', 1, 5, NULL, NULL, 2, NULL, 2, 30, 'Nisi ea eos odit in', 'Quo ad amet ut nesc', 592.00, 358.00, '2023-01-09 11:54:06', '2023-01-09 11:54:06'),
(4, '1', '১', 1, 9, 1, 1, 1, 1, 2, 3, '152', '12', 5.02, 5000000.00, '2023-01-11 15:38:37', '2023-01-11 15:38:37'),
(5, '1', '1', 2, 9, 2, 5, 1, 1, 2, 44, '1254', '1244', 5.20, 5.20, '2023-01-15 04:49:25', '2023-01-15 04:49:25'),
(6, '2', '২', 2, 9, 2, NULL, 1, 1, 2, 44, '45', '115', 0.45, 100000.00, '2023-01-17 21:39:05', '2023-01-17 21:39:05'),
(7, '03', '03', 2, 9, 2, 5, 1, 1, 1, 44, '584', '1002', 5.03, 500000.00, '2023-05-21 04:36:37', '2023-05-21 04:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `house_categories`
--

CREATE TABLE `house_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `house_type_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `house_categories`
--

INSERT INTO `house_categories` (`id`, `house_type_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Single Roof', 'এক চালা ঘর', 'single-roof', 1, 4, NULL, '2022-11-06 11:25:51', '2022-11-06 11:25:51'),
(2, 1, 'Multiple Roof', 'দোচালা ঘর', 'multiple-roof', 1, 4, NULL, '2022-11-06 11:26:26', '2022-11-06 11:26:26'),
(3, 2, 'Duplex', 'ডুপ্লেক্স বাড়ি', 'duplex', 1, 4, NULL, '2022-11-06 11:27:36', '2022-11-06 11:27:36'),
(4, 2, 'Flat', 'ফ্লাট বাড়ি', 'flat', 1, 3, NULL, '2022-11-06 11:28:42', '2022-11-08 14:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `house_classes`
--

CREATE TABLE `house_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `house_category_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `house_ownerships`
--

CREATE TABLE `house_ownerships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `house_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `house_ownerships`
--

INSERT INTO `house_ownerships` (`id`, `house_id`, `name`, `nid`, `mobile`, `address`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gary English', NULL, NULL, NULL, NULL, '2022-12-05 12:55:11', '2022-12-05 12:55:11'),
(4, 5, 'Imran Molla', '12548', '1487', '14879', '100', '2023-01-15 04:50:29', '2023-01-15 04:50:29'),
(5, 6, 'Ali Azam Molla', '1254', '01254789', NULL, '100', '2023-01-17 21:40:03', '2023-01-17 21:40:03'),
(3, 8, 'Md. Atiar Rahman Molla', '12548', '02154', NULL, '3', '2022-12-27 04:52:32', '2022-12-27 04:52:32'),
(6, 7, 'Kawser Ahmed', '20230520007', '01254', '2544', '100', '2023-05-21 04:37:37', '2023-05-21 04:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `house_owner_types`
--

CREATE TABLE `house_owner_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `house_owner_types`
--

INSERT INTO `house_owner_types` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Single Ownership', 'একক মালিকানাধীন', 'single-ownership', 1, 1, NULL, '2022-11-06 12:27:11', '2022-11-08 18:50:23'),
(2, 'Multiple Ownersip', 'বহু মালিকানাধীন', 'multiple-ownersip', 1, 1, NULL, '2022-11-06 12:28:30', '2022-11-08 18:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `house_types`
--

CREATE TABLE `house_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `house_types`
--

INSERT INTO `house_types` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Village House', 'গ্রাম্য বাড়ি', 'village-house', 1, 4, NULL, '2022-11-06 11:20:24', '2022-11-06 11:20:24'),
(2, 'City House', 'শহুরে বাড়ি', 'city-house', 1, 4, NULL, '2022-11-06 11:21:05', '2022-11-06 11:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institute_category_id` bigint(20) NOT NULL,
  `institute_subcategory_id` int(20) NOT NULL,
  `institute_type_id` bigint(20) NOT NULL,
  `union_id` bigint(20) DEFAULT NULL,
  `pourashava_id` bigint(20) DEFAULT NULL,
  `city_corporation_id` bigint(20) DEFAULT NULL,
  `activation_time` date DEFAULT NULL,
  `top_image` varchar(191) DEFAULT NULL,
  `left_image` varchar(191) DEFAULT NULL,
  `right_image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `institute_category_id`, `institute_subcategory_id`, `institute_type_id`, `union_id`, `pourashava_id`, `city_corporation_id`, `activation_time`, `top_image`, `left_image`, `right_image`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 1840, NULL, NULL, '2018-07-04', 'uploads/institute/bahadurpur-top-image-nrW.png', 'uploads/institute/bahadurpur-left-image-Wxq.png', 'uploads/institute/bahadurpur-right-image-R87.png', '2022-08-28 15:43:03', '2023-03-20 23:50:15'),
(2, 1, 1, 1, 3503, NULL, NULL, '2022-09-10', 'uploads/institute/shuktail-top-3503.png', 'uploads/institute/shuktail-left-3503.jpg', 'uploads/institute/shuktail-right-3503.png', '2022-09-09 22:06:48', '2026-04-10 05:33:25'),
(3, 1, 0, 1, 3505, NULL, NULL, '2022-01-12', 'uploads/institute/gopinathpur-top-3505.png', 'uploads/institute/gopinathpur-left-3505.png', 'uploads/institute/gopinathpur-right-3505.png', '2022-12-10 01:01:01', '2022-12-10 01:03:57'),
(4, 1, 0, 1, 4219, NULL, NULL, '2022-12-27', NULL, NULL, NULL, '2022-12-27 04:55:32', '2022-12-27 04:55:32'),
(5, 1, 0, 1, 2194, NULL, NULL, '2023-01-25', NULL, NULL, NULL, '2023-01-25 04:58:34', '2023-01-25 04:58:34'),
(6, 1, 0, 1, 2247, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-13 06:18:22', '2023-03-13 06:18:22'),
(7, 1, 0, 1, 3650, NULL, NULL, '2023-01-01', NULL, NULL, NULL, '2023-03-16 12:21:52', '2023-03-16 12:21:52'),
(8, 1, 2, 1, 1835, NULL, NULL, '2023-03-29', NULL, NULL, NULL, '2023-03-28 22:30:39', '2023-03-28 22:31:05'),
(9, 1, 2, 1, 1838, NULL, NULL, '2023-03-29', NULL, NULL, NULL, '2023-03-28 22:33:05', '2023-03-28 22:33:05'),
(10, 1, 1, 1, 4189, NULL, NULL, '2023-03-29', 'uploads/institute/kamararchor-top-4189.png', 'uploads/institute/kamararchor-left-4189.png', 'uploads/institute/kamararchor-right-4189.png', '2023-03-29 03:40:06', '2023-03-29 03:44:52'),
(11, 1, 1, 2, NULL, 95, NULL, '2026-03-23', NULL, NULL, NULL, '2026-03-23 04:29:53', '2026-03-23 04:29:53'),
(12, 1, 1, 1, 4193, NULL, NULL, '2026-01-01', NULL, NULL, NULL, '2026-04-19 09:39:13', '2026-04-19 09:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `institute_categories`
--

CREATE TABLE `institute_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institute_categories`
--

INSERT INTO `institute_categories` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Working', NULL, 1, NULL, NULL),
(2, 'Monitoring', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `institute_types`
--

CREATE TABLE `institute_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institute_types`
--

INSERT INTO `institute_types` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Union', NULL, 1, NULL, NULL),
(2, 'Pourashava', NULL, 1, NULL, NULL),
(3, 'City Corporation', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `landless_certificates`
--

CREATE TABLE `landless_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landless_certificates`
--

INSERT INTO `landless_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-20 12:41:45', '2022-10-20 12:41:45'),
(2, '2022102', 6, 0.00, 1, 0.00, 5, '2022-10-20 12:47:14', '2022-10-20 12:47:14'),
(3, '20260214001', 8, 0.00, 1, 0.00, 7, '2026-02-14 04:31:39', '2026-02-14 04:31:39'),
(4, '20260214002', 8, 0.00, 1, 0.00, 7, '2026-02-14 04:31:41', '2026-02-14 04:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `lands`
--

CREATE TABLE `lands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `land_classes`
--

CREATE TABLE `land_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `land_type_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_classes`
--

INSERT INTO `land_classes` (`id`, `land_type_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 4, 'Home', 'ভিটি', 'home', 1, 7, NULL, '2022-10-15 00:03:02', '2022-10-15 00:03:02'),
(2, 4, 'Drain', 'নালা', 'drain', 1, 7, NULL, '2022-10-15 00:04:01', '2022-10-15 00:05:59'),
(3, 4, 'Crop Field', 'ফসলী জমি', 'crop-field', 1, 7, NULL, '2022-10-15 00:05:34', '2022-10-15 00:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `land_ownership_types`
--

CREATE TABLE `land_ownership_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_ownership_types`
--

INSERT INTO `land_ownership_types` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Owner by Purchase', 'ক্রয় সূত্রে মালিক', 'owner-by-purchase', 1, 7, NULL, '2022-10-14 23:51:02', '2022-10-14 23:51:02'),
(2, 'Owner by Family', 'পারিবারিক সূত্রে মালিক', 'owner-by-family', 1, 7, NULL, '2022-10-14 23:54:13', '2022-10-14 23:54:13'),
(3, 'Owner by Father\'s Of Law', 'শ্বশুরের দানের সূত্রে মালিক', 'owner-by-fathers-of-law', 1, 7, NULL, '2022-10-14 23:55:45', '2022-10-14 23:55:45'),
(4, 'Owner by Heba', 'অন্যের দান সূত্রে মালিক', 'owner-by-heba', 1, 7, NULL, '2022-10-14 23:56:34', '2022-10-14 23:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `land_types`
--

CREATE TABLE `land_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `land_types`
--

INSERT INTO `land_types` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'City Corporation', 'সিটি কর্পোরেশন', 'city-corporation', 1, 7, NULL, '2022-10-14 23:59:40', '2022-10-14 23:59:40'),
(2, 'Govt. Development Org', 'সরকারী উন্নয়ন সংস্থার', 'govt-development-org', 1, 7, NULL, '2022-10-15 00:00:49', '2022-10-15 00:00:49'),
(3, 'Municipality', 'পৌরসভার', 'municipality', 1, 7, NULL, '2022-10-15 00:01:32', '2022-10-15 00:01:32'),
(4, 'Union Parishad', 'ইউনিয়ন পরিষদ', 'union-parishad', 1, 7, NULL, '2022-10-15 00:02:08', '2022-10-15 00:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `login_activities`
--

CREATE TABLE `login_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(191) NOT NULL,
  `event_type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `market_categories`
--

CREATE TABLE `market_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `market_ownership_types`
--

CREATE TABLE `market_ownership_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `market_types`
--

CREATE TABLE `market_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marriages`
--

CREATE TABLE `marriages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `married_certificates`
--

CREATE TABLE `married_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `married_certificates`
--

INSERT INTO `married_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-19 23:45:25', '2022-10-19 23:45:25'),
(2, '2022102', 6, 0.00, 1, 0.00, 5, '2022-10-19 23:47:55', '2022-10-19 23:47:55'),
(3, '20230612001', 39, 0.00, 1, 0.00, 7, '2023-06-12 05:04:19', '2023-06-12 05:04:19'),
(4, '20260127002', 9, 0.00, 1, 0.00, 7, '2026-01-27 07:33:09', '2026-01-27 07:33:09'),
(5, '2026042206001', 8, 0.00, 1, 0.00, 7, '2026-04-21 20:21:26', '2026-04-21 20:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_17_195418_create_roles_table', 1),
(6, '2022_05_17_195739_create_divisions_table', 1),
(7, '2022_05_17_195800_create_districts_table', 1),
(8, '2022_05_17_195906_create_thanas_table', 1),
(9, '2022_05_17_200016_create_religions_table', 1),
(10, '2022_05_17_200106_create_unions_table', 1),
(11, '2022_05_17_200502_create_city_corporations_table', 1),
(12, '2022_05_17_200612_create_wards_table', 1),
(13, '2022_05_17_200652_create_city_corporation_wards_table', 1),
(14, '2022_05_17_200716_create_union_wards_table', 1),
(15, '2022_05_17_200902_create_login_activities_table', 1),
(16, '2022_05_17_203537_create_user_activities_table', 1),
(17, '2022_05_18_183501_create_people_table', 1),
(18, '2022_05_22_175330_create_parent_infos_table', 1),
(19, '2022_05_22_180038_create_family_infos_table', 1),
(20, '2022_05_22_180117_create_address_infos_table', 1),
(21, '2022_05_22_180252_create_educational_infos_table', 1),
(23, '2022_05_22_180401_create_health_infos_table', 1),
(25, '2022_05_22_180504_create_property_infos_table', 1),
(28, '2022_06_05_175344_create_citizen_certificates_table', 1),
(29, '2022_06_05_175444_create_character_certificates_table', 1),
(30, '2022_06_05_175529_create_death_certificates_table', 1),
(31, '2022_06_05_175548_create_birth_certificates_table', 1),
(32, '2022_06_10_024954_create_successions_table', 1),
(33, '2022_06_10_162344_create_villages_table', 1),
(34, '2022_06_10_162417_create_road_categories_table', 1),
(35, '2022_06_10_162436_create_road_types_table', 1),
(36, '2022_06_10_162511_create_roads_table', 1),
(40, '2022_06_10_162634_create_land_types_table', 1),
(41, '2022_06_10_162653_create_land_classes_table', 1),
(42, '2022_06_10_162714_create_land_ownership_types_table', 1),
(43, '2022_06_10_162736_create_house_types_table', 1),
(44, '2022_06_10_162753_create_house_categories_table', 1),
(45, '2022_06_10_162809_create_house_classes_table', 1),
(46, '2022_06_10_162841_create_organization_categories_table', 1),
(47, '2022_06_10_162856_create_organization_sub_categories_table', 1),
(48, '2022_06_10_163006_create_organization_types_table', 1),
(49, '2022_06_10_163021_create_organization_classes_table', 1),
(50, '2022_06_10_163050_create_organization_owenership_types_table', 1),
(51, '2022_06_10_163112_create_family_categories_table', 1),
(52, '2022_06_10_163143_create_family_sub_categories_table', 1),
(53, '2022_06_10_163205_create_family_types_table', 1),
(54, '2022_06_10_163240_create_vehicle_categories_table', 1),
(55, '2022_06_10_163256_create_vehicle_sub_categories_table', 1),
(56, '2022_06_10_163354_create_vehicle_types_table', 1),
(57, '2022_06_10_163422_create_market_types_table', 1),
(58, '2022_06_10_163441_create_market_categories_table', 1),
(59, '2022_06_10_163505_create_market_ownership_types_table', 1),
(60, '2022_06_11_184020_create_organization_ownership_types_table', 1),
(61, '2022_06_14_184231_create_organizations_table', 1),
(62, '2022_06_14_184319_create_organization_fees_table', 1),
(63, '2022_06_14_184455_create_trade_licenses_table', 1),
(64, '2022_06_15_164320_create_institutes_table', 1),
(65, '2022_06_15_171323_create_houses_table', 1),
(66, '2022_06_15_173432_create_lands_table', 1),
(67, '2022_06_16_175516_create_taxes_table', 1),
(68, '2022_06_16_181236_create_vehicles_table', 1),
(69, '2022_06_16_183242_create_bridges_table', 1),
(70, '2022_06_16_183303_create_markets_table', 1),
(71, '2022_06_17_192536_create_road_owners_table', 1),
(72, '2022_06_18_134751_create_tax_years_table', 1),
(73, '2022_06_18_134917_create_tax_rates_table', 1),
(74, '2022_06_19_192622_create_marriages_table', 1),
(75, '2022_06_19_192841_create_divorces_table', 1),
(76, '2022_06_19_200645_create_institute_types_table', 1),
(77, '2022_06_19_200718_create_institute_categories_table', 1),
(78, '2022_08_08_191013_create_project_types_table', 1),
(79, '2022_08_08_191552_create_pourashavas_table', 1),
(80, '2022_08_12_202816_create_projects_table', 1),
(81, '2022_09_03_184841_create_professions_table', 2),
(82, '2022_06_10_162529_create_professions_table', 3),
(83, '2022_06_10_162530_create_profession_types_table', 3),
(86, '2022_06_10_162531_create_profession_categories_table', 4),
(87, '2022_06_10_162545_create_profession_sub_categories_table', 4),
(88, '2022_05_22_180321_create_professional_infos_table', 5),
(94, '2022_05_22_180439_create_financial_infos_table', 6),
(95, '2022_05_22_180557_create_disability_infos_table', 6),
(96, '2022_09_07_165148_create_account_types_table', 6),
(97, '2022_09_07_172108_create_banks_table', 6),
(98, '2022_05_22_180629_create_freedom_fighter_infos_table', 7),
(99, '2022_06_10_162609_create_profession_types_table', 8),
(100, '2022_06_14_184225_create_organization_types_table', 9),
(101, '2022_06_14_184226_create_organization_subtypes_table', 9),
(102, '2022_06_14_184227_create_mouzas_table', 10),
(103, '2026_04_30_104500_add_columns_to_vehicles_table', 11),
(104, '2026_04_28_120000_add_office_address_to_organizations_table', 12),
(105, '2026_04_28_122000_add_premises_ownership_to_organizations_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(34, 'App\\Models\\User', 3),
(34, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `mouzas`
--

CREATE TABLE `mouzas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `thana_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mouzas`
--

INSERT INTO `mouzas` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `created_at`, `updated_at`) VALUES
(1, 'Rayta', 'রায়টা', '', 1, 201, NULL, NULL),
(2, 'Fayjullapur', 'ফয়জুল্যাপুর', '', 1, 201, NULL, NULL),
(3, 'Horipur', 'হরিপুর', '', 1, 201, NULL, NULL),
(4, 'Meghnapara', 'মেঘনাপাড়া', '', 1, 201, NULL, NULL),
(5, 'Arkandi', 'আড়কান্দি', '', 1, 201, NULL, NULL),
(6, 'Madhobpur', 'মাধবপুর', '', 1, 201, NULL, NULL),
(7, 'Bashudebpur', 'বাসুদেবপুর', '', 1, 201, NULL, NULL),
(8, 'Bahadurpur', 'বাহাদুরপুর', '', 1, 201, NULL, NULL),
(9, 'Golapnogor', 'গোলাপনগর', '', 1, 201, NULL, NULL),
(10, 'Chor Golapnogor', 'চর গোলাপনগর', '', 1, 201, NULL, NULL),
(11, 'Arjisara', 'আরজিসারা', '', 1, 201, NULL, NULL),
(12, 'Chor Ruppur', 'চর রূপপুর', '', 1, 201, NULL, NULL),
(13, 'Chor Mokarimpur', 'চর মোকারিমপুর', '', 1, 201, NULL, NULL),
(14, 'Mokarimpur', 'মোকারিমপুর', '', 1, 201, NULL, NULL),
(15, 'Fakirabad', 'ফকিরাবাদ', '', 1, 201, NULL, NULL),
(16, 'Jhikri Porankhali', 'ঝিকড়ী পরান খালী', '', 1, 201, NULL, NULL),
(17, 'Dawlatpur', 'দৌলতপুর', '', 1, 201, NULL, NULL),
(18, 'Thakur Dawlatpur', 'ঠাকুর দৌলতপুর', '', 1, 201, NULL, NULL),
(19, 'Juniadaha', 'জুনিয়াদহ', '', 1, 201, NULL, NULL),
(20, 'Mirzapur', 'মির্জ্জাপুর', '', 1, 201, NULL, NULL),
(21, 'Dolua', 'দলুয়া', '', 1, 201, NULL, NULL),
(22, 'Gobindopur', 'গোবিন্দপুর', '', 1, 201, NULL, NULL),
(23, 'Nolua', 'নলুয়া', '', 1, 201, NULL, NULL),
(24, 'Patuakandi', 'পাটুয়াকান্দি', '', 1, 201, NULL, NULL),
(25, 'Jogossor', 'যগশ্বর', '', 1, 201, NULL, NULL),
(26, 'Poschima', 'পশ্চিমা', '', 1, 201, NULL, NULL),
(27, 'Nobogonga', 'নবগঙ্গা', '', 1, 201, NULL, NULL),
(28, 'Kazihata', 'কাজীহাটি', '', 1, 201, NULL, NULL),
(29, 'Dharampur', 'ধরমপুর', '', 1, 201, NULL, NULL),
(30, 'Satbaria', 'সাতবাড়িয়া', '', 1, 201, NULL, NULL),
(31, 'Nitarpol', 'নিতারপোল', '', 1, 201, NULL, NULL),
(32, 'Kodalipara', 'কোদালীয়াপাড়া', '', 1, 201, NULL, NULL),
(33, 'Himir Dia', 'হিড়িম দিয়া', '', 1, 201, NULL, NULL),
(34, 'Chandipur', 'চন্ডীপুর', '', 1, 201, NULL, NULL),
(35, 'Baradi', 'বাড়াদী', '', 1, 201, NULL, NULL),
(36, 'Chadgram', 'চাঁদ গ্রাম', '', 1, 201, NULL, NULL),
(37, 'Bamanpara', 'বামনপাড়া', '', 1, 201, NULL, NULL),
(38, 'Bheramara', 'ভেড়ামারা', '', 1, 201, NULL, NULL),
(39, 'Nawdapara', 'নওদাপাড়া', '', 1, 201, NULL, NULL),
(40, 'Chak Bheramara', 'চক ভেড়ামারা', '', 1, 201, NULL, NULL),
(41, 'Damukdua', 'দামুকদিয়া', '', 1, 201, NULL, NULL),
(42, 'Bahirchor Poschima', 'বাহিরচর পশ্চিম', '', 1, 201, NULL, NULL),
(43, 'West Chor Dadapur', 'ওয়েষ্ট চর দাদাপুর', '', 1, 201, NULL, NULL),
(44, 'Suktail', 'শুকতাইল', '', 1, 385, NULL, NULL),
(45, 'Paikerdanga', 'পাইকেরডাঙ্গা', '', 1, 385, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `name_certificates`
--

CREATE TABLE `name_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name_english` varchar(255) DEFAULT NULL,
  `name_bangla` varchar(255) DEFAULT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `name_certificates`
--

INSERT INTO `name_certificates` (`id`, `system_id`, `user_id`, `name_english`, `name_bangla`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-20 14:11:25', '2022-10-20 14:11:25'),
(2, '202210002', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-20 14:12:08', '2022-10-20 14:12:08'),
(3, '202210003', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-21 01:06:58', '2022-10-21 01:06:58'),
(4, '202210004', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-21 01:09:40', '2022-10-21 01:09:40'),
(6, '2022105', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-21 01:14:43', '2022-10-21 01:14:43'),
(8, '2022101', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-21 01:16:47', '2022-10-21 01:16:47'),
(10, '202210009', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-21 01:19:49', '2022-10-21 01:19:49'),
(11, '2022100011', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-21 01:20:09', '2022-10-21 01:20:09'),
(12, '20260214001', 8, NULL, NULL, 0.00, 1, 0.00, 7, '2026-02-14 04:31:54', '2026-02-14 04:31:54'),
(13, '20260214002', 8, NULL, NULL, 0.00, 1, 0.00, 7, '2026-02-14 04:31:55', '2026-02-14 04:31:55'),
(14, '20260310003', 10, 'Afnad Ahmed Alif', 'আফনাদ আহমেদ', 0.00, 1, 0.00, 7, '2026-03-10 12:29:57', '2026-03-10 12:29:57'),
(15, '20260328004', 81, 'Abdullah Al Azad Mazed', 'আব্দুল্লাহ আল আজাদ মাজেদ', 0.00, 1, 0.00, 7, '2026-03-28 01:10:59', '2026-03-28 01:10:59'),
(16, '20260415005', 86, 'Rafiul Islam Rafi', 'রাফিউল ইসলাম রাফি', 0.00, 1, 0.00, 7, '2026-04-14 20:59:03', '2026-04-14 20:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `nid_correction_certificates`
--

CREATE TABLE `nid_correction_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nid_correction_certificates`
--

INSERT INTO `nid_correction_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:47:09', '2022-10-21 00:47:09'),
(2, '20250831002', 8, 0.00, 1, 0.00, 7, '2025-08-31 03:54:56', '2025-08-31 03:54:56'),
(3, '20260315003', 28, 0.00, 1, 0.00, 7, '2026-03-15 12:52:53', '2026-03-15 12:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `application_id` varchar(20) DEFAULT NULL,
  `institute_id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `organization_category_id` bigint(20) DEFAULT NULL,
  `organization_subcategory_id` bigint(20) DEFAULT NULL,
  `organization_work_area_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`organization_work_area_id`)),
  `organization_type_id` bigint(20) DEFAULT NULL,
  `rjsc_reg_no` varchar(191) DEFAULT NULL,
  `organization_ownership_type_id` bigint(20) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `thana_id` int(11) DEFAULT NULL,
  `post_office_id` int(11) DEFAULT NULL,
  `union_id` int(11) DEFAULT NULL,
  `no_of_owner` int(11) DEFAULT 1,
  `village_id` bigint(20) DEFAULT NULL,
  `union_ward_id` bigint(20) DEFAULT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `village_area_id` bigint(20) DEFAULT NULL,
  `road_id` bigint(20) DEFAULT NULL,
  `house_id` bigint(20) DEFAULT NULL,
  `road` varchar(191) DEFAULT NULL,
  `house` varchar(191) DEFAULT NULL,
  `house_bn` varchar(191) DEFAULT NULL,
  `capital` double(16,2) DEFAULT 0.00,
  `establish_year` int(11) DEFAULT NULL,
  `application_type` enum('new','old') DEFAULT 'new',
  `remarks` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `office_division_id` bigint(20) DEFAULT NULL,
  `office_district_id` bigint(20) DEFAULT NULL,
  `office_thana_id` bigint(20) DEFAULT NULL,
  `office_post_office_id` bigint(20) DEFAULT NULL,
  `office_village_id` bigint(20) DEFAULT NULL,
  `office_ward_id` bigint(20) DEFAULT NULL,
  `office_road` varchar(191) DEFAULT NULL,
  `office_house` varchar(191) DEFAULT NULL,
  `office_house_bn` varchar(191) DEFAULT NULL,
  `premises_ownership` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `application_id`, `institute_id`, `system_id`, `name`, `bn_name`, `organization_category_id`, `organization_subcategory_id`, `organization_work_area_id`, `organization_type_id`, `rjsc_reg_no`, `organization_ownership_type_id`, `division_id`, `district_id`, `thana_id`, `post_office_id`, `union_id`, `no_of_owner`, `village_id`, `union_ward_id`, `ward_id`, `village_area_id`, `road_id`, `house_id`, `road`, `house`, `house_bn`, `capital`, `establish_year`, `application_type`, `remarks`, `status`, `created_at`, `updated_at`, `office_division_id`, `office_district_id`, `office_thana_id`, `office_post_office_id`, `office_village_id`, `office_ward_id`, `office_road`, `office_house`, `office_house_bn`, `premises_ownership`) VALUES
(10, '26040700004', 2, '20260331010', 'lima bd', 'LIma', 3, 12, '[\"4\",\"2\",\"1\"]', 8, '1233', 1, 6, 51, 385, 569, 3503, NULL, 3, NULL, 3, NULL, NULL, NULL, 'Road', 'Hose', 'Bnalg', 1500.00, 2020, 'old', NULL, 0, '2026-03-31 10:54:55', '2026-04-17 19:31:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '26040700001', 2, '20260407013', 'ABC School & College', 'এবিসি স্কুল এন্ড করেজ', 9, 19, NULL, NULL, '686879797', NULL, 6, 51, 385, 569, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 'সুকতাইল মেইন রোড', '234', '234', 123478.00, 1999, 'new', NULL, 0, '2026-04-07 11:03:35', '2026-04-30 02:01:01', 6, NULL, NULL, 569, NULL, 2, 'chfhj', '6', '6', NULL),
(14, '26041700001', 2, '20260417014', 'Modhumoti International', 'মধুমতি ইন্টারন্যাশনাল', 3, 12, NULL, 8, NULL, NULL, 6, 51, 385, 569, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, 'চন্দ্রদিঘলিয়া বড়ফা মেইন রোড', '234', '২৩৪', 500000.00, 2026, 'new', NULL, 1, '2026-04-17 05:20:45', '2026-05-01 22:45:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'owned');

-- --------------------------------------------------------

--
-- Table structure for table `organization_categories`
--

CREATE TABLE `organization_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_categories`
--

INSERT INTO `organization_categories` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Education', 'শিক্ষা', 'education', 1, 3, NULL, '2022-11-12 00:48:21', '2022-11-13 05:55:17'),
(2, 'Charity', 'দাতব্য', 'charity', 1, 3, NULL, '2022-11-12 00:48:30', '2022-11-13 05:56:35'),
(3, 'Business', 'ব্যবসা', 'business', 1, 3, NULL, '2022-11-12 00:48:40', '2022-11-13 05:57:02'),
(4, 'Historical', 'ঐতিহাসিক', 'historical', 1, 3, NULL, '2022-11-12 00:48:49', '2022-11-13 05:57:20'),
(5, 'Health Service', 'স্বাস্থ্য সেবা', 'health-service', 1, 1, NULL, '2022-11-28 11:45:21', '2022-11-28 22:28:07'),
(6, 'Social Service', 'সমাজ সেবা', 'social-service', 1, 1, NULL, '2022-11-28 22:30:25', '2022-11-28 22:30:25'),
(7, 'Sports', 'খেলাধুলা', 'sports', 1, 1, NULL, '2022-11-28 22:31:36', '2022-11-28 22:31:36'),
(8, 'Others', 'অন্যান্য', 'others', 1, 1, NULL, '2022-11-28 22:33:12', '2022-11-28 22:33:12'),
(9, 'Religious', 'ধর্মীয়', 'religious', 1, 1, NULL, '2023-01-13 16:52:20', '2026-04-10 05:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `organization_fees`
--

CREATE TABLE `organization_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_year_id` bigint(20) DEFAULT NULL,
  `institute_type_id` bigint(20) DEFAULT NULL,
  `organization_category_id` bigint(20) DEFAULT NULL,
  `organization_subcategory_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `category_a_fees` double(8,2) NOT NULL DEFAULT 0.00,
  `category_b_fees` double(8,2) NOT NULL DEFAULT 0.00,
  `category_c_fees` double(8,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_fees`
--

INSERT INTO `organization_fees` (`id`, `tax_year_id`, `institute_type_id`, `organization_category_id`, `organization_subcategory_id`, `name`, `category_a_fees`, `category_b_fees`, `category_c_fees`, `status`, `created_at`, `updated_at`) VALUES
(29, 1, 1, 3, 12, 'New Registration Charge', 100.00, 50.00, 30.00, 1, '2023-03-29 15:56:10', '2023-03-29 15:56:10'),
(30, 1, 1, 3, 12, 'Yearly Charge', 100.00, 50.00, 30.00, 1, '2023-03-29 15:56:10', '2023-03-29 15:56:10'),
(31, 1, 1, 3, 12, 'Renew Charge', 50.00, 20.00, 10.00, 1, '2023-03-29 15:56:10', '2023-03-29 15:56:10'),
(32, 1, 1, 3, 12, 'Signboard Fees', 10.00, 10.00, 10.00, 1, '2023-03-29 15:56:10', '2023-03-29 15:56:10'),
(33, 1, 1, 3, 12, 'Surcharge', 10.00, 10.00, 10.00, 1, '2023-03-29 15:56:10', '2023-03-29 15:56:10'),
(34, 1, 1, 3, 12, 'Others', 10.00, 10.00, 10.00, 1, '2023-03-29 15:56:10', '2023-03-29 15:56:10'),
(35, 1, 1, 3, 12, 'VAT', 10.00, 10.00, 10.00, 1, '2023-03-29 15:56:10', '2023-03-29 15:56:10'),
(36, 1, 1, 3, 12, 'TAX', 10.00, 10.00, 10.00, 1, '2023-03-29 15:56:10', '2023-03-29 15:56:10'),
(37, 1, 1, 3, 12, 'Fine', 10.00, 10.00, 10.00, 1, '2023-03-29 15:56:10', '2023-03-29 15:56:10'),
(38, 5, 1, 3, 12, 'New Registration Charge', 1000.00, 800.00, 500.00, 1, '2026-03-08 11:44:45', '2026-03-08 11:44:45'),
(39, 5, 1, 3, 12, 'Yearly Charge', 500.00, 300.00, 200.00, 1, '2026-03-08 11:44:45', '2026-03-08 11:44:45'),
(40, 5, 1, 3, 12, 'Renew Charge', 2000.00, 1500.00, 1000.00, 1, '2026-03-08 11:44:45', '2026-03-08 11:44:45'),
(41, 5, 1, 3, 12, 'Signboard Fees', 500.00, 300.00, 200.00, 1, '2026-03-08 11:44:45', '2026-03-08 11:44:45'),
(42, 5, 1, 3, 12, 'Surcharge', 1000.00, 800.00, 500.00, 1, '2026-03-08 11:44:45', '2026-03-08 11:44:45'),
(43, 5, 1, 3, 12, 'Others', 0.00, 0.00, 0.00, 1, '2026-03-08 11:44:45', '2026-03-08 11:44:45'),
(44, 5, 1, 3, 12, 'VAT', 750.00, 555.00, 360.00, 1, '2026-03-08 11:44:45', '2026-03-08 11:44:45'),
(45, 5, 1, 3, 12, 'TAX', 250.00, 185.00, 120.00, 1, '2026-03-08 11:44:45', '2026-03-08 11:44:45'),
(46, 5, 1, 3, 12, 'Fine', 0.00, 0.00, 0.00, 1, '2026-03-08 11:44:45', '2026-03-08 11:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `organization_ownerships`
--

CREATE TABLE `organization_ownerships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `same_union` tinyint(4) DEFAULT NULL,
  `system_id` varchar(191) DEFAULT NULL,
  `user_name` varchar(191) DEFAULT NULL,
  `quantity` varchar(191) DEFAULT NULL,
  `is_trade_license` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=>NO, 1=>YES',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_ownerships`
--

INSERT INTO `organization_ownerships` (`id`, `organization_id`, `user_id`, `same_union`, `system_id`, `user_name`, `quantity`, `is_trade_license`, `created_at`, `updated_at`) VALUES
(1, 1, 30, NULL, '20230311002', 'মোল্লা', '60', 1, '2023-04-08 17:23:05', '2023-04-11 01:08:52'),
(2, 1, 3, NULL, '20230311002', 'কাওসার আহমেদ', '50', 1, '2023-04-08 17:34:06', '2023-04-08 18:14:17'),
(4, 3, 29, NULL, '20230311001', 'কাওসার আহমেদ', '100', 1, '2023-04-11 01:16:20', '2023-04-11 01:16:20'),
(5, 2, 31, NULL, '20230312003', 'মাহফুজুর রহমান', '100', 1, '2023-05-13 07:50:56', '2023-05-13 07:50:56'),
(6, 2, 30, NULL, '20230311002', 'আলমগীর হোসাইন', '100', 0, '2023-05-13 07:50:57', '2023-05-13 07:50:57'),
(7, 2, 30, NULL, '20230311002', 'আলমগীর হোসাইন', '100', 0, '2023-05-13 07:50:57', '2023-05-13 07:50:57'),
(8, 2, 30, NULL, '20230311002', 'আলমগীর হোসাইন', '100', 0, '2023-05-13 07:50:57', '2023-05-13 07:50:57'),
(9, 2, 30, NULL, '20230311002', 'আলমগীর হোসাইন', '100', 0, '2023-05-13 07:50:57', '2023-05-13 07:50:57'),
(10, 4, 59, NULL, '20250831022', 'আহমেদ আলিফ', '100', 1, '2026-03-08 11:27:34', '2026-03-08 11:27:34'),
(11, 9, 81, NULL, '20260304044', 'আবদুল্লাহ আল আজাদ', '100', 1, '2026-03-29 11:36:10', '2026-03-29 11:36:10'),
(12, 9, 81, NULL, '20260304044', 'আবদুল্লাহ আল আজাদ', '100', 1, '2026-03-29 11:36:27', '2026-03-29 11:36:27'),
(13, 10, 85, NULL, '20260328048', 'Md. Shafiul Islam Sohan', '100', 0, '2026-03-31 12:31:34', '2026-03-31 12:31:34'),
(14, 11, 81, NULL, '20260304044', 'আবদুল্লাহ আল আজাদ', '100', 1, '2026-03-31 14:31:03', '2026-03-31 14:31:03'),
(15, 12, 80, NULL, '20260303043', 'সেলিনা আক্তার', '100', 1, '2026-04-01 12:25:47', '2026-04-01 12:25:47'),
(16, 10, 85, NULL, '20260328048', 'মোঃ সাফিউল ইসলাম সোহান', '100', 0, '2026-04-11 12:42:53', '2026-04-11 13:10:55'),
(17, 10, 66, NULL, '20260328048', NULL, '100', 0, '2026-04-11 12:45:55', '2026-04-11 13:10:55'),
(18, 10, 76, NULL, '20260328048', NULL, '100', 0, '2026-04-11 12:46:45', '2026-04-11 13:10:55'),
(19, 10, 77, NULL, '20260328048', NULL, '100', 0, '2026-04-11 12:50:13', '2026-04-11 13:10:55'),
(20, 10, 78, NULL, '20260328048', NULL, '100', 0, '2026-04-11 12:50:31', '2026-04-11 13:10:55'),
(21, 10, 79, NULL, '20260328048', NULL, '100', 0, '2026-04-11 12:55:21', '2026-04-11 13:10:55'),
(23, 14, NULL, NULL, '51-040819-0001', NULL, '100', 1, '2026-04-17 19:29:25', '2026-04-17 19:29:25'),
(24, 10, 89, 1, NULL, NULL, NULL, 0, '2026-04-17 19:36:37', '2026-04-17 19:36:37'),
(25, 13, 132, 1, NULL, NULL, NULL, 0, '2026-04-27 02:04:31', '2026-04-27 02:04:31'),
(26, 13, 133, 1, NULL, NULL, NULL, 0, '2026-04-27 02:05:33', '2026-04-27 02:05:33'),
(27, 13, 134, 1, '20260427054', 'Tareq Jamil Sarkar', NULL, 0, '2026-04-27 02:11:55', '2026-04-27 02:11:55'),
(28, 14, 135, 1, '20260428055', 'Tareq Jamil Sarkar', NULL, 0, '2026-04-28 04:26:34', '2026-04-28 04:26:34'),
(29, 14, 136, 1, '20260502056', 'Tareq Jamil Sarkar', NULL, 0, '2026-05-01 23:27:41', '2026-05-01 23:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `organization_ownership_types`
--

CREATE TABLE `organization_ownership_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_ownership_types`
--

INSERT INTO `organization_ownership_types` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Single Ownership', 'একক মালিকাধীন', 'single-ownership', 1, 18, 3, '2022-11-12 00:50:29', '2022-11-13 06:15:08'),
(2, 'Multiple Ownersip', 'বহু মালিকানাধীন', 'multiple-ownersip', 1, 18, 3, '2022-11-12 00:50:53', '2022-11-13 06:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `organization_subtypes`
--

CREATE TABLE `organization_subtypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_type_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_sub_categories`
--

CREATE TABLE `organization_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_category_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_sub_categories`
--

INSERT INTO `organization_sub_categories` (`id`, `organization_category_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Local', 'স্থানীয়', 'local', 1, 1, NULL, '2022-11-12 00:49:02', '2022-11-28 23:14:54'),
(2, 1, 'International (English Medium)', 'আন্তর্জাতিক (ইংলিশ মিডিয়াম)', 'international-english-medium', 1, 1, NULL, '2022-11-12 00:49:11', '2022-11-28 23:02:29'),
(3, 1, 'General', 'সাধারণ', 'general', 1, 1, NULL, '2022-11-12 00:49:18', '2022-11-28 22:59:28'),
(4, 1, 'Madrasa', 'মাদ্রাসা', 'madrasa', 1, 3, NULL, '2022-11-12 00:49:27', '2022-11-13 05:59:40'),
(5, 1, 'Technical', 'কারিগরি', 'technical', 1, 3, NULL, '2022-11-12 00:49:35', '2022-11-13 06:00:22'),
(6, 3, 'Real-Estate & Land', 'রিয়েল এস্টেট এবং জমি', 'real-estate-land', 1, 1, NULL, '2022-11-13 06:01:14', '2022-11-28 22:55:58'),
(7, 3, 'Import & Export', 'আমদানী ও রপ্তানী', 'import-export', 1, 1, NULL, '2022-11-13 06:01:40', '2022-11-28 22:53:24'),
(8, 3, 'Consultancy', 'পরামর্শক', 'consultancy', 1, 1, NULL, '2022-11-13 06:02:22', '2022-11-28 22:51:27'),
(9, 3, 'Contractor', 'ঠিকাদার', 'contractor', 1, 1, NULL, '2022-11-13 06:03:00', '2022-11-28 22:49:44'),
(10, 3, 'Printing & Packaging', 'মুদ্রণ এবং প্যাকেজিং', 'printing-packaging', 1, 1, NULL, '2022-11-13 06:11:50', '2022-11-28 22:48:42'),
(11, 3, 'RMG', 'তৈরী পোষাক', 'rmg', 1, 1, NULL, '2022-11-13 06:12:59', '2022-11-28 22:43:59'),
(12, 3, 'ICT', 'তথ্য ও যোগাযোগ প্রযুক্তি', 'ict', 1, 1, NULL, '2022-11-13 06:13:36', '2022-11-28 22:42:33'),
(13, 3, 'Food & Beverage', 'খাদ্য ও পানীয়', 'food-beverage', 1, 1, NULL, '2022-11-13 06:14:09', '2022-11-28 22:41:04'),
(14, 3, 'Agro, Poultry & Livestock', 'কৃষি, পোল্ট্রি ও লাইভস্টক', 'agro-poultry-livestock', 1, 1, NULL, '2022-11-28 11:46:16', '2022-11-28 22:39:57'),
(15, 2, 'International', 'আন্তর্জাতিক', 'international', 1, 1, NULL, '2022-11-28 23:16:34', '2022-11-28 23:16:34'),
(16, 3, 'Health Care & Medicine', 'স্বাস্থ্য ও ঔষধ', 'health-care-medicine', 1, 1, NULL, '2022-11-28 23:18:42', '2022-11-28 23:18:42'),
(17, 3, 'Supplier', 'সরবরাহকারী', 'supplier', 1, 1, NULL, '2022-12-04 21:35:42', '2022-12-04 21:35:42'),
(18, 3, 'SME Traders & Supplier', 'ক্ষুদ্র ব্যবসায়ী ও সরবরাহকারী', 'sme-traders-supplier', 1, 1, NULL, '2022-12-04 22:03:34', '2022-12-04 22:03:34'),
(19, 9, 'Islami', 'ইসলামী', 'islami', 1, 1, NULL, '2026-04-10 05:42:43', '2026-04-10 05:42:43'),
(20, 9, 'Sanatan', 'সনাতন', 'sanatan', 1, 1, NULL, '2026-04-10 05:43:19', '2026-04-10 05:43:19'),
(21, 9, 'Cristian', 'খ্রিষ্টান', 'cristian', 1, 1, NULL, '2026-04-10 05:44:14', '2026-04-10 05:44:14'),
(22, 9, 'Budhist', 'বুদ্ধিষ্ট', 'budhist', 1, 1, NULL, '2026-04-10 05:45:01', '2026-04-10 05:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `organization_types`
--

CREATE TABLE `organization_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_category_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_types`
--

INSERT INTO `organization_types` (`id`, `organization_category_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3, 'Limited', 'লিমিটেড', 'public-limited', 1, 1, NULL, '2022-11-26 12:43:31', '2022-11-28 23:43:58'),
(7, 3, 'Partnership', 'পার্টনারশীপ', 'partnership', 1, 1, NULL, '2022-11-28 11:47:37', '2022-11-28 23:46:12'),
(8, 3, 'Proprietorship', 'ব্যক্তিগত', 'proprietorship', 1, 1, NULL, '2022-12-04 09:09:00', '2022-12-04 09:09:00'),
(9, 1, 'Government', 'সরকারী', 'government', 1, 1, NULL, '2026-04-10 05:57:37', '2026-04-10 05:57:37'),
(10, 1, 'Non-Government', 'বে-সরকারী', 'non-government', 1, 1, NULL, '2026-04-10 05:58:38', '2026-04-10 05:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `organization_work_areas`
--

CREATE TABLE `organization_work_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_category_id` bigint(20) UNSIGNED NOT NULL,
  `organization_subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_work_areas`
--

INSERT INTO `organization_work_areas` (`id`, `organization_category_id`, `organization_subcategory_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3, 12, 'ICT Training', 'তথ্য ও যোগাযোগ প্রযুক্তি প্রশিক্ষণ', 'ict-training', 1, 1, NULL, '2022-11-26 12:48:17', '2022-11-28 23:23:23'),
(2, 3, 12, 'Digital Commerce', 'ডিজিটাল কমার্স', 'digital-commerce', 1, 1, NULL, '2022-11-27 12:53:33', '2022-11-28 23:22:08'),
(3, 3, 12, 'Software Development', 'সফটওয়্যার তৈরী', 'software-development', 1, 1, NULL, '2022-11-28 11:46:47', '2022-11-28 23:20:51'),
(4, 3, 12, 'Call Center', 'কল সেন্টার', 'call-center', 1, 1, NULL, '2022-11-28 23:24:53', '2022-11-28 23:24:53'),
(5, 3, 12, 'Internet Service Provider', 'ইন্টারনেট সেবা দানকারী', 'internet-service-provider', 1, 1, NULL, '2022-11-28 23:26:43', '2022-11-28 23:26:43'),
(6, 3, 12, 'Mobile Operator', 'মোবাইল সেবাদানকারী', 'mobile-operator', 1, 1, NULL, '2022-11-28 23:27:59', '2022-11-28 23:27:59'),
(7, 3, 17, 'Books & Stationary', 'বই ও স্টেশনারী', 'books-stationary', 1, 1, NULL, '2022-12-04 21:38:22', '2022-12-04 21:38:22'),
(8, 3, 17, 'Printing & Packaging', 'মূদ্রণ ও প্যাকেজিং', 'printing-packaging', 1, 1, NULL, '2022-12-04 21:40:44', '2022-12-04 21:40:44'),
(9, 3, 11, 'Knit Composite', 'নিট কম্পোজিট', 'knit-composite', 1, 1, NULL, '2022-12-04 21:49:51', '2022-12-04 21:49:51'),
(10, 3, 11, 'Sweater', 'সোয়েটার', 'sweater', 1, 1, NULL, '2022-12-04 21:51:20', '2022-12-04 21:51:20'),
(11, 3, 11, 'Knitwear', 'নিটওয়্যার', 'knitwear', 1, 1, NULL, '2022-12-04 21:52:40', '2022-12-04 21:52:40'),
(12, 3, 11, 'Embroidery', 'এমব্রয়ডারি', 'embroidery', 1, 1, NULL, '2022-12-04 21:53:49', '2022-12-04 21:53:49'),
(13, 3, 11, 'Textile', 'টেক্সটাইল', 'textile', 1, 1, NULL, '2022-12-04 21:55:18', '2022-12-04 21:55:18'),
(14, 3, 11, 'Buying House', 'বায়িং হাউস', 'buying-house', 1, 1, NULL, '2022-12-04 21:58:14', '2022-12-04 21:58:14'),
(15, 3, 18, 'Grocery and Manohari', 'মুদি ও মনোহরী', 'grocery-and-manohari', 1, 1, NULL, '2022-12-04 22:05:14', '2022-12-04 22:05:14'),
(16, 3, 6, 'Developers', 'ফ্ল্যাট নির্মাণকারী', 'developers', 1, 1, NULL, '2022-12-04 22:09:34', '2022-12-04 22:09:34'),
(17, 3, 6, 'Housing Estate', 'হাউজিং এস্টেট', 'housing-estate', 1, 1, NULL, '2022-12-04 22:12:38', '2022-12-04 22:12:38'),
(18, 9, 19, 'Mosque', 'মসজিদ', 'mosque', 1, 1, NULL, '2026-04-10 05:46:29', '2026-04-10 05:46:29'),
(19, 9, 20, 'Mondir', 'মন্দির', 'mondir', 1, 1, NULL, '2026-04-10 05:47:09', '2026-04-10 05:47:09'),
(20, 9, 21, 'Charch', 'গির্জা', 'charch', 1, 1, NULL, '2026-04-10 05:47:53', '2026-04-10 05:47:53'),
(21, 9, 22, 'Pagoda', 'প্যাগোডা', 'pagoda', 1, 1, NULL, '2026-04-10 05:48:37', '2026-04-10 05:48:37'),
(22, 2, 1, 'Education', 'শিক্ষা', 'education', 1, 1, NULL, '2026-04-10 05:49:33', '2026-04-10 05:49:33'),
(23, 2, 1, 'Health', 'স্বাস্থ্য', 'health', 1, 1, NULL, '2026-04-10 05:50:04', '2026-04-10 05:50:04'),
(24, 2, 15, 'Education', 'শিক্ষা', 'education', 1, 1, NULL, '2026-04-10 05:50:29', '2026-04-10 05:50:29'),
(25, 2, 15, 'Health', 'স্বাস্থ্য', 'health', 1, 1, NULL, '2026-04-10 05:50:57', '2026-04-10 05:50:57'),
(26, 1, 3, 'Govt. Primary', 'সরকারী প্রাথমিক বিদ্যালয়', 'govt-primary', 1, 1, NULL, '2026-04-10 05:51:52', '2026-04-10 05:51:52'),
(27, 1, 3, 'Govt. Secondary School', 'সরকারী মাধ্যমিক বিদ্যালয়', 'govt-secondary-school', 1, 1, NULL, '2026-04-10 05:53:11', '2026-04-10 05:53:11'),
(28, 1, 3, 'Govt. College', 'সরকারী মহাবিদ্যালয়', 'govt-college', 1, 1, NULL, '2026-04-10 05:54:15', '2026-04-10 05:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `orphan_certificates`
--

CREATE TABLE `orphan_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orphan_certificates`
--

INSERT INTO `orphan_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:38:13', '2022-10-21 00:38:13'),
(2, '20260113002', 8, 0.00, 1, 0.00, 7, '2026-01-13 09:08:15', '2026-01-13 09:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `parent_infos`
--

CREATE TABLE `parent_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `approved_id` varchar(30) DEFAULT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `date_of_birth` varchar(191) DEFAULT NULL,
  `birth_place` bigint(20) DEFAULT NULL,
  `district_id` bigint(20) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `gender` bigint(20) DEFAULT NULL,
  `religion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `blood_group` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `user_id`, `approved_id`, `bn_name`, `date_of_birth`, `birth_place`, `district_id`, `country_id`, `gender`, `religion_id`, `blood_group`, `created_at`, `updated_at`) VALUES
(2, 8, '51-830228-0002', 'ইমরান মোল্লা', '1983-02-28', 1, 51, 3, 1, 1, 3, '2022-09-09 22:11:24', '2026-04-15 13:14:37'),
(25, 39, NULL, 'সুলতান মাহমুদ হাসান মোল্লা', '1991-05-03', NULL, NULL, NULL, 1, NULL, NULL, '2023-06-08 01:33:49', '2023-06-08 01:33:49'),
(35, 53, '28-911026-0001', 'মাহফুজুর রহমান', '1991-10-26', NULL, 28, 3, 1, 1, 3, '2025-08-27 02:58:16', '2026-04-16 09:19:47'),
(37, 56, '51-040819-0001', 'কানিজ ফাহমিদা মিম', '2004-08-19', 1, 51, 3, 2, 1, 5, '2025-08-31 01:53:17', '2026-04-14 23:31:08'),
(47, 66, '51-911026-0002', 'মাহফুজুর রহমান', '1991-10-26', 1, 51, 3, 1, 1, 5, '2026-02-13 00:17:52', '2026-04-20 22:28:38'),
(69, 86, '28-980302-0001', 'রাফিউল ইসলাম', '1998-03-02', 1, 14, 3, 1, 1, 6, '2026-04-02 01:27:00', '2026-04-14 20:56:21'),
(80, 98, NULL, 'মাহফুজুর রহমান', '1991-10-26', NULL, NULL, NULL, 1, NULL, NULL, '2026-04-15 08:09:09', '2026-04-15 08:09:09'),
(88, 106, NULL, 'asdfaf', '2000-02-27', 1, 28, 3, 1, 1, 7, '2026-04-17 09:00:02', '2026-04-17 09:00:02'),
(89, 107, NULL, 'আব্দুল্লাহ আল মামুন', '2000-03-30', NULL, NULL, NULL, 1, 1, 5, '2026-04-17 19:36:37', '2026-04-17 19:36:37'),
(90, 108, '51-960415-0001', 'মোঃ কুতুব উদ্দিন', '1996-04-15', NULL, NULL, NULL, 1, NULL, NULL, '2026-04-17 21:29:55', '2026-04-17 23:30:11'),
(91, 109, '51-850617-0002', 'মোঃ মাহমুদ হাসান মুন্সী', '1985-06-17', NULL, NULL, NULL, 1, NULL, NULL, '2026-04-18 00:53:55', '2026-04-18 00:54:10'),
(92, 111, '51-950610-0003', 'মোঃ সোহাগ মীর', '1995-06-10', NULL, NULL, NULL, 1, NULL, NULL, '2026-04-21 23:08:20', '2026-04-21 23:08:43'),
(93, 112, NULL, 'মোঃ নাসিম বিশ্বাস', '2008-06-06', 1, 51, 20, 1, NULL, NULL, '2026-04-21 23:58:39', '2026-04-22 00:18:33'),
(94, 113, '51-080606-0004', 'মোঃ নাসিম বিশ্বাস', '2008-06-06', 1, 51, 3, 1, 1, NULL, '2026-04-22 00:02:57', '2026-04-22 00:09:27'),
(95, 114, '51-090614-0004', 'মোঃ ফাহিম বিশ্বাস বাঁধন', '0009-06-14', 1, 51, 20, 1, 1, NULL, '2026-04-22 00:20:49', '2026-04-22 00:55:17'),
(96, 115, NULL, 'রাকিবুল ইসলাম ফারজিদ', '2001-04-24', 1, 51, 3, 1, 1, NULL, '2026-04-22 05:46:38', '2026-04-22 05:46:38'),
(97, 116, '00-010424-0004', 'রাকিবুল ইসলাম ফারজিদ', '2001-04-24', NULL, NULL, NULL, 1, NULL, NULL, '2026-04-22 05:50:10', '2026-04-22 05:50:31'),
(98, 117, '00-860101-0005', 'মিজানুর শিকদার', '1986-01-01', NULL, NULL, NULL, 1, NULL, NULL, '2026-04-22 07:00:59', '2026-04-22 07:01:56'),
(99, 118, NULL, 'আলী আজম মোল্লা', '1979-04-05', 1, 51, 3, 1, 1, 3, '2026-04-22 17:50:11', '2026-04-22 18:07:39'),
(100, 119, '51-840330-0005', 'মোঃ শামীম মোল্লা', '1984-03-30', 1, 51, 3, 1, 1, 3, '2026-04-22 19:11:15', '2026-04-22 21:59:22'),
(101, 120, '51-260415-0006', 'মোঃ আলিনুর ইসলাম টুটুল', '2026-04-15', 1, 51, 3, 1, 1, 3, '2026-04-24 02:44:34', '2026-04-24 02:48:46'),
(102, 121, '00-550502-0006', 'মোঃ সোবহান শেখ', '1955-05-02', 1, 51, 3, 1, 1, NULL, '2026-04-24 21:26:42', '2026-04-24 23:53:42'),
(103, 122, NULL, 'মোঃ সোবহান শেখ', '1955-05-02', 1, NULL, NULL, 1, 1, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(104, 123, NULL, 'মোঃ সোবহান শেখ', '1955-05-02', 1, NULL, NULL, 1, 1, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(105, 124, NULL, 'মোঃ সোবহান শেখ', '1955-05-02', 1, NULL, NULL, 1, 1, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(106, 125, '51-510701-0007', 'বীর মুক্তিযোদ্ধা মোল্লা তৈয়বুর রহমান', '1951-07-01', 1, 51, 3, 1, 1, 5, '2026-04-25 00:09:11', '2026-04-25 00:20:50'),
(107, 126, NULL, 'তারেক জামিল সরকার', '2002-07-04', NULL, NULL, NULL, 1, NULL, NULL, '2026-04-25 23:32:04', '2026-04-25 23:32:04'),
(108, 129, NULL, 'তারেক জামিল', '2002-02-08', 1, 59, 3, 1, NULL, NULL, '2026-04-26 00:32:46', '2026-04-26 01:02:16'),
(109, 130, NULL, 'তারেক জামিল সরকার', '2002-02-04', 33, NULL, NULL, 1, 1, 1, '2026-04-26 01:11:34', '2026-04-26 04:10:11'),
(110, 131, NULL, 'তারেক জামিল সরকার', '2002-02-04', 28, NULL, NULL, 1, 1, 3, '2026-04-26 04:25:04', '2026-04-26 04:25:52'),
(111, 132, NULL, 'তারেক জামিল সরকার', '2026-04-02', NULL, NULL, NULL, 1, 1, 3, '2026-04-27 02:04:31', '2026-04-27 02:04:31'),
(112, 133, NULL, 'তারেক জামিল সরকার', '2026-04-01', NULL, NULL, NULL, 1, 1, 3, '2026-04-27 02:05:33', '2026-04-27 02:05:33'),
(113, 134, NULL, 'তারেক জামিল সরকার', '2026-03-31', NULL, NULL, NULL, 1, 1, 3, '2026-04-27 02:11:55', '2026-04-27 02:11:55'),
(114, 135, NULL, 'তারেক জামিল সরকার', '2026-04-01', NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-28 04:26:34', '2026-04-28 04:26:34'),
(115, 136, NULL, 'তারেক জামিল সরকার', '2026-04-30', NULL, NULL, NULL, 1, 1, 3, '2026-05-01 23:27:41', '2026-05-01 23:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `permanent_citizen_certificates`
--

CREATE TABLE `permanent_citizen_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permanent_citizen_certificates`
--

INSERT INTO `permanent_citizen_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:20:07', '2022-10-21 00:20:07'),
(2, '20260315002', 30, 0.00, 1, 0.00, 7, '2026-03-15 12:07:49', '2026-03-15 12:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(34, 'Sccess -2', 'web', '2024-08-24 19:40:49', '2024-09-04 23:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_offices`
--

CREATE TABLE `post_offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `postal_code` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `thana_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_offices`
--

INSERT INTO `post_offices` (`id`, `name`, `bn_name`, `postal_code`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(548, 'Gopalganj HO', 'গোপালগঞ্জ', '8100', NULL, 1, 385, NULL, NULL, NULL),
(549, 'Bolakair', 'বলাকৈর', '8100', NULL, 1, 385, NULL, NULL, NULL),
(550, 'Bedgram', 'বেদগ্রাম', '8100', NULL, 1, 385, NULL, NULL, NULL),
(551, 'Borni', 'বরমি', '8100', NULL, 1, 385, NULL, NULL, NULL),
(552, 'Charpukuria', 'চর পুকুরিয়া', '8100', NULL, 1, 385, NULL, NULL, NULL),
(553, 'Darul Quran', 'দারুল কুরআন', '8100', NULL, 1, 385, NULL, NULL, NULL),
(554, 'Degharkul', 'দিঘারকুল', '8100', NULL, 1, 385, NULL, NULL, NULL),
(555, 'Durgapur', 'দূর্গাপুর', '8100', NULL, 1, 385, NULL, NULL, NULL),
(556, 'Gopalpur Pukuria', 'গোপালপুর পুকুরিয়া', '8100', NULL, 1, 385, NULL, NULL, NULL),
(557, 'Gopalpur', 'গোপালপুর', '8100', NULL, 1, 385, NULL, NULL, NULL),
(558, 'Kajulia', 'কাজুলিয়া', '8100', NULL, 1, 385, NULL, NULL, NULL),
(559, 'Korpara', 'করপাড়া', '8100', NULL, 1, 385, NULL, NULL, NULL),
(560, 'Kathi', 'কাঠি', '8100', NULL, 1, 385, NULL, NULL, NULL),
(561, 'Moddha Bonogram', 'মধ্য বনগ্রাম', '8100', NULL, 1, 385, NULL, NULL, NULL),
(562, 'Majhigati High School', 'মাঝিগাতি', '8100', NULL, 1, 385, NULL, NULL, NULL),
(563, 'Manikdah', 'মানিকদি', '8100', NULL, 1, 385, NULL, NULL, NULL),
(564, 'Manikhar', 'মানিকহার', '8100', NULL, 1, 385, NULL, NULL, NULL),
(565, 'Raghunathpur', 'রঘুনাথপুর', '8100', NULL, 1, 385, NULL, NULL, NULL),
(566, 'Silna', 'সিলনা', '8100', NULL, 1, 385, NULL, NULL, NULL),
(567, 'Verarhat', 'ভেরারহাট', '8100', NULL, 1, 385, NULL, NULL, NULL),
(568, 'Vojergati', 'ভোজেরগাতি', '8100', NULL, 1, 385, NULL, NULL, NULL),
(569, 'Borfa', 'বরফা', '8102', NULL, 1, 385, NULL, NULL, NULL),
(570, 'Molla Tetulia ', 'মোল্লা তেতুলিয়া', '8102', NULL, 1, 385, NULL, NULL, NULL),
(571, 'Suktail', 'শুকতাইল', '8102', NULL, 1, 385, NULL, NULL, NULL),
(572, 'United Accademi Khalia', 'খালিয়া', '8102', NULL, 1, 385, NULL, NULL, NULL),
(573, 'Chandradigolia', 'চন্দ্র দিঘলিয়া', '8103', NULL, 1, 385, NULL, NULL, NULL),
(574, 'Gopinathpur Kazi Para', 'গোপিনাথপুর কাজীপাড়া', '8103', NULL, 1, 385, NULL, NULL, NULL),
(575, 'Kutibari', 'কুঠিবাড়ি', '8103', NULL, 1, 385, NULL, NULL, NULL),
(576, 'Mari Gopinathpur', 'মেরী গোপিনাথপুর', '8103', NULL, 1, 385, NULL, NULL, NULL),
(577, 'Sultanshahi', 'সুলতানশাহী', '8103', NULL, 1, 385, NULL, NULL, NULL),
(578, 'Boiltoli', 'বৈলতৈলী', '8104', NULL, 1, 385, NULL, NULL, NULL),
(579, 'Satpar', 'সাতপাড়', '8104', NULL, 1, 385, NULL, NULL, NULL),
(580, 'Tuthamandra', 'টুটামান্দ্রা', '8104', NULL, 1, 385, NULL, NULL, NULL),
(581, 'Uttar Vennabari ', 'উত্তর ভেন্নাবাড়ি', '8104', NULL, 1, 385, NULL, NULL, NULL),
(582, 'BSMRSTU', 'বিএসএমআরএসটিইউ', '8105', NULL, 1, 385, NULL, NULL, NULL),
(583, 'Mulashre', 'মুলাসেরি', '8105', NULL, 1, 385, NULL, NULL, NULL),
(584, 'Pahardanga', 'পওহরডাঙ্গা', '8105', NULL, 1, 385, NULL, NULL, NULL),
(585, 'Nilfaboira', 'নিলফাবরিয়া', '8105', NULL, 1, 385, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pourashavas`
--

CREATE TABLE `pourashavas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `category` enum('A','B','C','CC') NOT NULL DEFAULT 'CC',
  `slug` varchar(191) NOT NULL,
  `lat` varchar(191) DEFAULT NULL,
  `lon` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pourashavas`
--

INSERT INTO `pourashavas` (`id`, `district_id`, `name`, `bn_name`, `category`, `slug`, `lat`, `lon`, `url`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 32, 'Pirojpur', NULL, 'A', '6697265', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(2, 32, 'Mathbaria', NULL, 'A', '7149432', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(3, 32, 'Swarupkathi', NULL, 'A', '5192768', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(4, 30, 'Jhalokathi', NULL, 'A', '5270424', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5, 35, 'Barguna', NULL, 'A', '8318137', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(6, 35, 'Amtali', NULL, 'A', '2881911', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7, 31, 'Patuakhali', NULL, 'A', '1541388', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(8, 31, 'Galachipa', NULL, 'A', '8774473', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(9, 31, 'Kalapara', NULL, 'A', '7736821', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(10, 34, 'Bhola', NULL, 'A', '6794260', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(11, 34, 'Lalmohan', NULL, 'A', '1592521', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(12, 34, 'Charfassion', NULL, 'A', '1847845', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(13, 34, 'Burhanuddin', NULL, 'A', '8765765', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(14, 33, 'Gouranadi', NULL, 'A', '3525130', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(15, 33, 'Muladi', NULL, 'A', '2970799', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(16, 33, 'Mehendiganj', NULL, 'B', '938815', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(17, 33, 'Bakerganj', NULL, 'A', '1904091', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(18, 33, 'Banaripara', NULL, 'B', '3460641', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(19, 30, 'Nalchhity', NULL, 'B', '6858552', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(20, 35, 'Patharghata', NULL, 'B', '302492', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(21, 31, 'Bauphal', NULL, 'A', '6234349', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(22, 34, 'Daulatkhan', NULL, 'B', '128462', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(23, 31, 'Kuakata', NULL, 'B', '5885789', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(24, 35, 'Betagi', NULL, 'B', '3480662', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(25, 33, 'Uzirpur', NULL, 'C', '147707', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(26, 32, 'Bhandaria', NULL, 'C', '5328911', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(27, 8, 'Patiya', NULL, 'A', '5915087', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(28, 8, 'Bariarhat', NULL, 'A', '1128133', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(29, 8, 'Sitakunda', NULL, 'A', '7930599', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(30, 8, 'Satkania', NULL, 'A', '6369122', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(31, 8, 'Bashkhali', NULL, 'A', '5462847', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(32, 9, 'Cox’s Bazar', NULL, 'A', '538955', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(33, 9, 'Chakoria', NULL, 'A', '2904525', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(34, 4, 'Rangamati', NULL, 'A', '8466058', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(35, 11, 'Bandarban', NULL, 'A', '8191693', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(36, 10, 'Khagrachhari', NULL, 'A', '4817617', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(37, 8, 'Chandanaish', NULL, 'A', '5552134', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(38, 8, 'Raojan', NULL, 'A', '5213664', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(39, 8, 'Mirsharai', NULL, 'B', '990411', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(40, 8, 'Rangunia', NULL, 'B', '3307070', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(41, 8, 'Sandwip', NULL, 'B', '2365373', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(42, 9, 'Teknaf', NULL, 'B', '822427', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(43, 9, 'Moheskhali', NULL, 'B', '1004853', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(44, 10, 'Ramgarh', NULL, 'B', '6666008', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(45, 11, 'Lama', NULL, 'B', '5693067', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(46, 8, 'Fatikchhari', NULL, 'B', '6837826', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(47, 8, 'Hathazari', NULL, 'A', '1268271', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(48, 8, 'Boalkhali', NULL, 'B', '4939433', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(49, 8, 'Nazirhat', NULL, 'C', '3719371', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(50, 10, 'Matiranga', NULL, 'B', '3323417', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(51, 4, 'Baghaichhari', NULL, 'C', '2553869', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(52, 1, 'Laksham', NULL, 'A', '8127424', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(53, 1, 'Chouddagram', NULL, 'A', '1132867', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(54, 6, 'Chandpur', NULL, 'A', '8701184', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(55, 6, 'Haziganj', NULL, 'A', '867228', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(56, 6, 'Shahrasti', NULL, 'A', '2741324', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(57, 6, 'Kachua', NULL, 'A', '7726840', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(58, 5, 'Noakhali', NULL, 'A', '993382', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(59, 5, 'Choumuhani', NULL, 'A', '8128763', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(60, 5, 'Chatkhil', NULL, 'A', '3602932', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(61, 5, 'Basurhat', NULL, 'A', '8289515', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(62, 5, 'Sonaimuri', NULL, 'A', '4550881', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(63, 7, 'Laxmipur', NULL, 'A', '4688270', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(64, 7, 'Ramganj', NULL, 'A', '7590354', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(65, 7, 'Raipur', NULL, 'A', '7053345', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(66, 2, 'Feni', NULL, 'A', '8746195', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(67, 2, 'Daganbhuiyan', NULL, 'A', '8163135', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(68, 3, 'Brahmanbaria', NULL, 'A', '91261', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(69, 3, 'Nabinagar', NULL, 'A', '5270650', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(70, 3, 'Akhaura', NULL, 'A', '2912342', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(71, 3, 'Kasba', NULL, 'B', '1919672', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(72, 5, 'Kabirhat', NULL, 'B', '8386336', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(73, 5, 'Senbag', NULL, 'B', '4313743', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(74, 2, 'Chhagalnaiya', NULL, 'B', '5505655', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(75, 2, 'Sonagazi', NULL, 'A', '6102851', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(76, 2, 'Parshuram', NULL, 'B', '4596273', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(77, 1, 'Daudkandi', NULL, 'B', '4738882', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(78, 1, 'Chandina', NULL, 'B', '952791', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(79, 1, 'Debidwar', NULL, 'B', '609805', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(80, 1, 'Homna', NULL, 'B', '234859', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(81, 1, 'Barura', NULL, 'B', '8153711', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(82, 1, 'Nangalkot', NULL, 'A', '7398142', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(83, 6, 'Matlab', NULL, 'A', '6014077', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(84, 6, 'Chengarchar', NULL, 'A', '5885729', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(85, 3, 'Banchharampur', NULL, 'C', '6259250', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(86, 7, 'Ramgati', NULL, 'B', '2973568', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(87, 6, 'Faridganj', NULL, 'B', '3393378', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(88, 6, 'Narayanpur', NULL, 'C', '1354260', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(89, 5, 'Hatiya', NULL, 'C', '7144813', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(90, 8, 'Dohazari', NULL, 'C', '2255178', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(91, 43, 'Tarabo', NULL, 'A', '241773', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(92, 40, 'Narsingdi', NULL, 'A', '288836', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(93, 40, 'Madhabdi', NULL, 'A', '6622334', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(94, 40, 'Ghorashal', NULL, 'A', '8157753', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(95, 47, 'Savar', NULL, 'A', '508629', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(96, 47, 'Dohar', NULL, 'A', '4036048', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(97, 44, 'Tangail', NULL, 'A', '8784220', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(98, 41, 'Kaliakoir', NULL, 'A', '4697261', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(99, 48, 'Munshiganj', NULL, 'A', '3570658', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(100, 48, 'Mirkadim', NULL, 'A', '2486725', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(101, 46, 'Manikganj', NULL, 'A', '2204156', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(102, 44, 'Gopalpur', NULL, 'A', '8823293', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(103, 44, 'Bhuapur', NULL, 'B', '5134621', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(104, 44, 'Ghatail', NULL, 'A', '8017717', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(105, 44, 'Madhupur', NULL, 'A', '8159233', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(106, 44, 'Mirzapur', NULL, 'B', '3120922', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(107, 44, 'Dhanbari', NULL, 'B', '4331279', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(108, 44, 'Kalihati', NULL, 'B', '6551156', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(109, 44, 'Sakhipur', NULL, 'A', '1461035', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(110, 43, 'Sonargaon', NULL, 'B', '1779006', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(111, 47, 'Dhamrai', NULL, 'A', '7848279', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(112, 41, 'Sreepur', NULL, 'A', '2110821', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(113, 41, 'Kaliganj', NULL, 'B', '8473619', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(114, 46, 'Singair', NULL, 'B', '6343895', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(115, 44, 'Elenga', NULL, 'C', '173009', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(116, 44, 'Basail', NULL, 'B', '7127145', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(117, 40, 'Monohardi', NULL, 'B', '4139755', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(118, 40, 'Shibpur', NULL, 'C', '3179369', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(119, 40, 'Raipura', NULL, 'B', '4563390', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(120, 43, 'Kanchan', NULL, 'B', '6543446', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(121, 43, 'Araihazar', NULL, 'B', '5149334', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(122, 43, 'Gopaldi', NULL, 'B', '1131213', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(123, 52, 'Faridpur', NULL, 'A', '5838916', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(124, 52, 'Bhanga', NULL, 'A', '1469694', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(125, 52, 'Boalmari', NULL, 'A', '3350986', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(126, 49, 'Rajbari', NULL, 'A', '3527124', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(127, 50, 'Madaripur', NULL, 'A', '5817943', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(128, 50, 'Shibchar', NULL, 'A', '5296919', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(129, 42, 'Shariatpur', NULL, 'A', '4671179', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(130, 51, 'Gopalganj', NULL, 'A', '8096005', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(131, 51, 'Muksudpur', NULL, 'B', '8609076', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(132, 51, 'Tungipara', NULL, 'A', '8427692', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(133, 42, 'Damuddya', NULL, 'A', '6643955', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(134, 42, 'Naria', NULL, 'B', '2303592', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(135, 49, 'Pangsha', NULL, 'A', '3698298', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(136, 49, 'Goalanda', NULL, 'A', '4286082', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(137, 50, 'Kalkini', NULL, 'A', '2293165', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(138, 52, 'Nagarkanda', NULL, 'C', '1454268', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(139, 52, 'Madhukhali', NULL, 'B', '8047092', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(140, 50, 'Rajoir', NULL, 'C', '1120255', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(141, 42, 'Zanjira', NULL, 'B', '5654345', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(142, 42, 'Bhedarganj', NULL, 'B', '7768346', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(143, 42, 'Goshairhat', NULL, 'C', '6650789', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(144, 45, 'Kishoreganj', NULL, 'A', '1710344', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(145, 45, 'Bhairab', NULL, 'A', '1542200', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(146, 45, 'Bajitpur', NULL, 'B', '3002715', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(147, 45, 'Karimganj', NULL, 'B', '8397863', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(148, 45, 'Kuliarchar', NULL, 'B', '5058899', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(149, 45, 'Pakundia', NULL, 'C', '6571246', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(150, 45, 'Hossainpur', NULL, 'B', '5829129', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(151, 51, 'Kotalipara', NULL, 'A', '3457484', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(152, 52, 'Alfadanga', NULL, 'C', '8385736', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(153, 45, 'Katiadi', NULL, 'B', '2693760', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(154, 23, 'Lohagara', NULL, 'C', '2189689', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(155, 23, 'Kalia', NULL, 'B', '5088984', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(156, 26, 'Magura', NULL, 'A', '6882478', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(157, 23, 'Narail', NULL, 'A', '6305243', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(158, 20, 'Jashore', NULL, 'A', '7532909', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(159, 20, 'Noapara', NULL, 'A', '1719105', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(160, 20, 'Keshabpur', NULL, 'A', '3561126', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(161, 20, 'Benapole', NULL, 'A', '929518', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(162, 29, 'Jhenaidaha', NULL, 'A', '454588', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(163, 29, 'Kotchandpur', NULL, 'A', '7887617', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(164, 29, 'Maheshpur', NULL, 'A', '5871527', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(165, 29, 'Kaliganj', NULL, 'A', '1237374', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(166, 29, 'Shailkupa', NULL, 'A', '4686429', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(167, 24, 'Chuadanga', NULL, 'A', '4414199', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(168, 24, 'Alamdanga', NULL, 'A', '8686859', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(169, 21, 'Satkhira', NULL, 'A', '5339242', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(170, 25, 'Kushtia', NULL, 'A', '8233294', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(171, 25, 'Kumarkhali', NULL, 'A', '239402', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(172, 28, 'Bagerhat', NULL, 'A', '3811121', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(173, 28, 'Mongla', NULL, 'A', '5820983', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(174, 22, 'Meherpur', NULL, 'A', '5403715', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(175, 27, 'Paikgachha', NULL, 'A', '4723733', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(176, 27, 'Chalna', NULL, 'B', '2801572', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(177, 20, 'Jhikargacha', NULL, 'B', '5460610', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(178, 20, 'Monirampur', NULL, 'B', '7560322', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(179, 20, 'Chowgachha', NULL, 'B', '2992397', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(180, 25, 'Bheramara', NULL, 'B', '1663431', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(181, 25, 'Mirpur', NULL, 'B', '5502205', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(182, 22, 'Gangni', NULL, 'B', '1243172', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(183, 21, 'Kalaroa', NULL, 'B', '4480418', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(184, 24, 'Jiban Nagar', NULL, 'B', '6685571', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(185, 24, 'Darshana', NULL, 'B', '1558569', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(186, 28, 'Morrelganj', NULL, 'A', '958003', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(187, 25, 'Khoksha', NULL, 'C', '1219342', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(188, 20, 'Bagher Para', NULL, 'C', '5833914', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(189, 29, 'Harinakunda', NULL, 'C', '4647083', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(190, 62, 'Gafargaon', NULL, 'A', '7713973', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(191, 62, 'Trishal', NULL, 'A', '3208150', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(192, 62, 'Muktagacha', NULL, 'A', '5227755', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(193, 62, 'Ishwarganj', NULL, 'A', '1795856', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(194, 62, 'Bhaluka', NULL, 'A', '3905797', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(195, 62, 'Gauripur', NULL, 'A', '4812715', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(196, 62, 'Phulpur', NULL, 'A', '1467192', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(197, 63, 'Jamalpur', NULL, 'A', '4819409', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(198, 61, 'Sherpur', NULL, 'A', '5732844', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(199, 64, 'Netrokona', NULL, 'A', '7839198', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(200, 63, 'Sharishabari', NULL, 'B', '6515721', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(201, 63, 'Islampur', NULL, 'B', '4066367', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(202, 63, 'Melandaha', NULL, 'A', '6956269', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(203, 63, 'Dewanganj', NULL, 'B', '330092', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(204, 63, 'Madarganj', NULL, 'B', '4310136', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(205, 62, 'Fulbaria', NULL, 'B', '8815881', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(206, 64, 'Mohanganj', NULL, 'A', '2624180', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(207, 61, 'Nalitabari', NULL, 'B', '2211509', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(208, 64, 'Durgapur', NULL, 'B', '4869640', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(209, 64, 'Kendua', NULL, 'C', '6648238', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(210, 64, 'Madan', NULL, 'B', '8869470', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(211, 61, 'Nakla', NULL, 'B', '7576506', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(212, 61, 'Sreebardi', NULL, 'C', '3648755', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(213, 62, 'Nandail', NULL, 'B', '5492749', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(214, 62, 'Haluaghat', NULL, 'C', '4548154', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(215, 63, 'Bakshiganj', NULL, 'C', '2707852', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(216, 63, 'Hazrabari', NULL, 'C', '8526111', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(217, 14, 'Bogura', NULL, 'A', '4528548', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(218, 14, 'Sherpur', NULL, 'A', '4406008', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(219, 14, 'Nandigram', NULL, 'A', '1130285', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(220, 13, 'Pabna', NULL, 'A', '7158908', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(221, 13, 'Ishwardi', NULL, 'A', '2721135', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(222, 13, 'Bera', NULL, 'A', '533341', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(223, 13, 'Suzanagar', NULL, 'A', '3503782', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(224, 13, 'Santhia', NULL, 'A', '4839114', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(225, 18, 'Chapai Nawabganj', NULL, 'A', '7062640', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(226, 18, 'Shibganj', NULL, 'A', '8656150', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(227, 18, 'Rohanpur', NULL, 'A', '3418299', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(228, 12, 'Sirajganj', NULL, 'A', '437398', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(229, 12, 'Shahjadpur', NULL, 'A', '5943088', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(230, 12, 'Ullapara', NULL, 'A', '402878', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(231, 17, 'Joypurhat', NULL, 'A', '784883', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(232, 17, 'Panchbibi', NULL, 'A', '2002256', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(233, 16, 'Natore', NULL, 'A', '4134273', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(234, 16, 'Gurudaspur', NULL, 'A', '17075', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(235, 16, 'Singra', NULL, 'A', '8611690', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(236, 16, 'Banpara', NULL, 'A', '5256960', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(237, 19, 'Naogaon', NULL, 'A', '2952499', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(238, 15, 'Godagari', NULL, 'A', '3945743', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(239, 15, 'Taherpur', NULL, 'A', '58944', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(240, 15, 'Naohata', NULL, 'A', '4575237', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(241, 15, 'Charghat', NULL, 'A', '3657894', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(242, 18, 'Nachol', NULL, 'B', '8317929', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(243, 16, 'Baraigram', NULL, 'B', '1788136', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(244, 19, 'Dhamoirhat', NULL, 'B', '7104835', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(245, 19, 'Nazipur', NULL, 'A', '6943418', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(246, 14, 'Dhupchanchia', NULL, 'A', '2201482', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(247, 14, 'Dhunat', NULL, 'B', '8477387', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(248, 17, 'Kalai', NULL, 'A', '7354848', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(249, 17, 'Akkelpur', NULL, 'A', '2947348', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(250, 17, 'Khetlal', NULL, 'B', '8076326', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(251, 15, 'Mondumala', NULL, 'B', '2769074', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(252, 15, 'Bagha', NULL, 'A', '606123', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(253, 15, 'Keshorehat', NULL, 'B', '4563755', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(254, 15, 'Kakonhat', NULL, 'A', '2088723', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(255, 15, 'Arani', NULL, 'B', '728768', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(256, 13, 'Chatmohar', NULL, 'A', '2341855', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(257, 13, 'Bhangura', NULL, 'A', '709491', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(258, 13, 'Faridpur', NULL, 'A', '7095522', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(259, 12, 'Belkuchi', NULL, 'A', '6707599', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(260, 14, 'Santahar', NULL, 'A', '5748130', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(261, 16, 'Gopalpur', NULL, 'C', '4802493', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(262, 16, 'Bagatipara', NULL, 'C', '2175931', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(263, 16, 'Naldanga', NULL, 'B', '3844735', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(264, 13, 'Atgharia', NULL, 'B', '657331', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(265, 14, 'Sariakandi', NULL, 'C', '6410219', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(266, 14, 'Sonatola', NULL, 'B', '7162922', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(267, 14, 'Shibganj', NULL, 'C', '4797619', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(268, 14, 'Kahaloo', NULL, 'C', '1446852', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(269, 14, 'Gabtali', NULL, 'B', '3284205', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(270, 14, 'Talora', NULL, 'C', '4584224', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(271, 15, 'Bhabaniganj', NULL, 'B', '3736300', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(272, 15, 'Tanore', NULL, 'C', '5096152', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(273, 15, 'Puthia', NULL, 'B', '8762507', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(274, 15, 'Katakhali', NULL, 'B', '5312570', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(275, 15, 'Durgapur', NULL, 'B', '8468818', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(276, 12, 'Kazipur', NULL, 'B', '5734449', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(277, 12, 'Raiganj', NULL, 'B', '6774319', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(278, 12, 'Tarash', NULL, 'C', '2848435', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(279, 57, 'Gaibandha', NULL, 'A', '4914504', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(280, 57, 'Gobindaganj', NULL, 'A', '4686813', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(281, 54, 'Dinajpur', NULL, 'A', '1672033', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(282, 54, 'Setabganj', NULL, 'A', '8227049', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(283, 54, 'Birampur', NULL, 'A', '2687253', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(284, 54, 'Parbatipur', NULL, 'A', '6844339', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(285, 54, 'Fulbari', NULL, 'A', '2808876', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(286, 58, 'Thakurgaon', NULL, 'A', '143698', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(287, 56, 'Nilphamari', NULL, 'A', '3878238', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(288, 56, 'Saidpur', NULL, 'A', '1517159', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(289, 60, 'Kurigram', NULL, 'A', '1509667', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(290, 60, 'Nageswari', NULL, 'A', '1877499', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(291, 53, 'Panchagarh', NULL, 'A', '5680047', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(292, 55, 'Lalmonirhat', NULL, 'A', '3087173', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(293, 55, 'Patgram', NULL, 'A', '7609090', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(294, 54, 'Birganj', NULL, 'B', '6860146', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(295, 57, 'Sundarganj', NULL, 'B', '6558776', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(296, 60, 'Ulipur', NULL, 'B', '8439064', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(297, 56, 'Jaldhaka', NULL, 'B', '448938', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(298, 59, 'Badarganj', NULL, 'B', '1234991', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(299, 58, 'Pirganj', NULL, 'A', '3169657', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(300, 53, 'Boda', NULL, 'B', '6842352', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(301, 56, 'Domar', NULL, 'C', '2220697', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(302, 59, 'Haragachh', NULL, 'C', '2223068', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(303, 59, 'Pirganj', NULL, 'C', '8761219', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(304, 54, 'Hakimpur', NULL, 'B', '3560965', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(305, 54, 'Ghoraghat', NULL, 'C', '2683319', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(306, 54, 'Biral', NULL, 'C', '4978310', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(307, 57, 'Palashbari', NULL, 'C', '2708468', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(308, 58, 'Ranisankail', NULL, 'B', '4681136', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(309, 53, 'Debiganj', NULL, 'C', '5143908', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(310, 38, 'Habiganj', NULL, 'A', '642525', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(311, 38, 'Madhabpur', NULL, 'A', '815398', NULL, NULL, NULL, 1, NULL, NULL, NULL),
(312, 38, 'Shayestaganj', NULL, 'A', '3401479', NULL, NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `professional_infos`
--

CREATE TABLE `professional_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `profession_subcategory_id` varchar(191) NOT NULL,
  `profession_start` varchar(191) DEFAULT NULL,
  `profession_end` varchar(191) DEFAULT NULL,
  `organization` varchar(191) DEFAULT NULL,
  `designation` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professional_infos`
--

INSERT INTO `professional_infos` (`id`, `user_id`, `profession_subcategory_id`, `profession_start`, `profession_end`, `organization`, `designation`, `address`, `created_at`, `updated_at`) VALUES
(2, 6, '1', '2022-09-06', '2022-09-06', 'Test Organization', 'Test Designation', 'Test Address', '2022-09-05 13:40:32', '2022-09-05 13:40:32'),
(3, 6, '6', '2022-09-06', '2022-09-06', 'test Organiztion', 'test Designation', 'test u', '2022-09-05 13:40:32', '2022-09-05 13:40:49'),
(4, 8, '9', '2014-01-01', NULL, 'Adventure Soft Ltd.', 'Managing Director', 'Ho-58', '2022-09-09 23:06:42', '2022-09-09 23:06:42'),
(5, 24, '9', '2000-02-01', NULL, 'Self', 'no', NULL, '2023-02-26 21:59:22', '2023-02-26 21:59:22'),
(6, 35, '9', '2023-05-21', '2023-05-22', NULL, NULL, NULL, '2023-05-21 04:26:54', '2023-05-21 04:26:54'),
(7, 43, '1', '2005-04-13', '1981-04-10', 'Dunn Vincent Plc', 'Ea enim aspernatur d', 'Aut ratione quae iru', '2024-06-24 05:05:11', '2024-06-24 05:05:11'),
(8, 61, '1', NULL, NULL, NULL, NULL, NULL, '2025-11-06 06:00:37', '2025-11-06 06:00:37'),
(9, 78, '1', '2026-03-01', '2026-03-03', NULL, NULL, NULL, '2026-03-02 14:35:51', '2026-03-02 14:35:51'),
(10, 80, '9', '1983-02-17', '1996-04-06', 'Ingram and Leach Trading', 'Quas aut excepturi h', 'Ipsa dolor est ut', '2026-03-03 15:24:45', '2026-03-03 15:24:45'),
(11, 81, '1', NULL, NULL, 'Education Ministry', 'Deputy Secretary', NULL, '2026-03-12 19:50:25', '2026-04-14 06:13:15'),
(12, 84, '3', '2026-03-01', '2026-03-30', 'Bangladesh Police', 'ASP', 'DMP', '2026-03-30 11:31:50', '2026-03-30 11:31:50'),
(13, 85, '6', '2026-03-01', '2026-03-31', 'Uttara High School', 'Asst. Teacher', 'Sector-7,  Uttara, Dhaka-1230', '2026-03-31 00:07:24', '2026-03-31 00:07:24'),
(14, 86, '2', '2026-04-13', '2026-04-22', 'Dhaka College', 'Proffesor', 'dgsd', '2026-04-02 01:28:53', '2026-04-14 20:54:23'),
(15, 59, '11', NULL, NULL, 'Uttara High School & College', 'Student', NULL, '2026-04-14 08:45:38', '2026-04-14 08:48:16'),
(16, 56, '13', NULL, NULL, NULL, 'Student', NULL, '2026-04-14 23:37:26', '2026-04-14 23:37:26'),
(17, 66, '14', NULL, NULL, NULL, 'Business', NULL, '2026-04-20 22:27:56', '2026-04-20 22:27:56'),
(18, 120, '14', NULL, NULL, NULL, 'Business', NULL, '2026-04-24 02:47:38', '2026-04-24 02:47:38'),
(19, 134, '1', '2026-05-05', '2026-05-09', 'vgdsgc', 'ednbj', 'ejfh', '2026-05-01 23:04:48', '2026-05-01 23:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professions`
--

INSERT INTO `professions` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Job', 'চাকুরী', 'job', 1, 5, 5, '2022-09-03 13:46:51', '2022-09-03 13:46:59'),
(2, 'Business', 'ব্যবসা', 'business', 1, 5, NULL, '2022-09-03 13:47:47', '2022-09-03 13:47:47'),
(3, 'Professional', 'পেশাজীবি', 'professional', 1, 5, NULL, '2022-09-03 13:48:05', '2022-09-03 13:48:05'),
(4, 'Student', 'শিক্ষার্থী', 'student', 1, 5, NULL, '2022-09-03 13:48:39', '2022-09-03 13:48:39'),
(5, 'Freelancing', 'ফ্রিল্যান্সিং', 'freelancing', 1, 5, NULL, '2022-09-03 13:49:01', '2022-09-03 13:49:01'),
(6, 'Others', 'Others', 'others', 1, 1, NULL, '2022-12-05 08:26:57', '2022-12-05 08:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `profession_categories`
--

CREATE TABLE `profession_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profession_type_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profession_categories`
--

INSERT INTO `profession_categories` (`id`, `profession_type_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'BCS Cadre', 'বিসিএস ক্যাডার', 'bcs-cadre', 1, 1, NULL, '2022-09-03 08:37:57', '2022-12-04 22:17:23'),
(2, 1, 'Non Cadre', 'নন ক্যাডার', 'non-cadre', 1, 5, NULL, '2022-09-03 08:39:30', '2022-09-03 08:39:30'),
(3, 1, 'Defense Forces', 'প্রতিরক্ষা বাহিনী', 'defense-forces', 1, 5, NULL, '2022-09-03 08:40:14', '2022-09-03 08:40:14'),
(4, 2, 'Domestic', 'দেশী', 'domestic', 1, 5, NULL, '2022-09-03 08:41:46', '2022-09-03 08:41:46'),
(5, 2, 'Foreign', 'বিদেশী', 'foreign', 1, 5, NULL, '2022-09-03 08:42:19', '2022-09-03 08:42:19'),
(6, 3, 'Manufacturer', 'প্রস্তুতকারক', 'manufacturer', 1, 5, NULL, '2022-09-03 08:43:14', '2022-09-03 08:43:14'),
(7, 3, 'Seller', 'বিক্রেতা', 'seller', 1, 5, NULL, '2022-09-03 08:43:39', '2022-09-03 08:45:02'),
(8, 3, 'Agent', 'কমিশন এজেন্ট', 'agent', 1, 5, NULL, '2022-09-03 08:44:03', '2022-09-03 08:45:13'),
(9, 3, 'Export & Import', 'আমদানী ও রপ্তানী কারক', 'export-import', 1, 5, NULL, '2022-09-03 08:46:14', '2022-09-03 08:46:32'),
(11, 4, 'Manufacturer', 'প্রস্তুতকারক', 'manufacturer', 1, 5, NULL, '2022-09-03 08:49:42', '2022-09-03 15:10:51'),
(12, 4, 'Seller', 'বিক্রেতা', 'seller', 1, 5, NULL, '2022-09-03 15:11:38', '2022-09-03 15:11:38'),
(13, 4, 'Agent', 'কমিশন এজেন্ট', 'agent', 1, 5, NULL, '2022-09-03 15:14:18', '2022-09-03 15:14:18'),
(14, 4, 'Export & Import', 'আমদানী ও রপ্তানী কারক', 'export-import', 1, 5, NULL, '2022-09-03 15:14:57', '2022-09-03 15:14:57'),
(15, 5, 'Manufacturer', 'প্রস্তুতকারক', 'manufacturer', 1, 5, NULL, '2022-09-03 15:17:47', '2022-09-03 15:17:47'),
(16, 5, 'Seller', 'বিক্রেতা', 'seller', 1, 5, NULL, '2022-09-03 15:18:00', '2022-09-03 15:18:00'),
(17, 5, 'Agent', 'কমিশন এজেন্ট', 'agent', 1, 5, NULL, '2022-09-03 15:18:17', '2022-09-03 15:18:17'),
(18, 5, 'Export & Import', 'আমদানী ও রপ্তানী কারক', 'export-import', 1, 5, NULL, '2022-09-03 15:18:35', '2022-09-03 15:18:35'),
(19, 6, 'Advocate', 'এ্যাডভোকেট', 'advocate', 1, 5, NULL, '2022-09-03 15:18:59', '2022-09-03 15:18:59'),
(20, 6, 'Barrister', 'ব্যারিষ্টার', 'barrister', 1, 5, NULL, '2022-09-03 15:19:32', '2022-09-03 15:19:32'),
(21, 7, 'Wedgeboard', 'ওয়েজবোর্ড ভূক্ত', 'wedgeboard', 1, 5, NULL, '2022-09-03 15:20:56', '2022-09-03 15:20:56'),
(22, 7, 'None Wedgeboard', 'ওয়েজবোর্ড ভূক্ত  নয়', 'none-wedgeboard', 1, 5, NULL, '2022-09-03 15:21:22', '2022-09-03 15:21:22'),
(23, 8, 'Bangla', 'বাংলা', 'bangla', 1, 5, NULL, '2022-09-03 15:22:09', '2022-09-03 15:22:09'),
(24, 8, 'English', 'ইংরেজি', 'english', 1, 5, NULL, '2022-09-03 15:22:29', '2022-09-03 15:22:29'),
(25, 9, 'Bangla', 'বাংলা', 'bangla', 1, 5, NULL, '2022-09-03 15:22:57', '2022-09-03 15:22:57'),
(26, 10, 'Aaliyah', 'আলিয়া', 'aaliyah', 1, 5, NULL, '2022-09-03 15:23:32', '2022-09-03 15:23:32'),
(27, 10, 'Kawmia', 'কওমিয়া', 'kawmia', 1, 5, NULL, '2022-09-03 15:23:59', '2022-09-03 15:23:59'),
(28, 11, 'Trained', 'প্রশিক্ষন প্রাপ্ত', 'trained', 1, 5, NULL, '2022-09-03 15:25:13', '2022-09-03 15:25:13'),
(29, 11, 'None Trained', 'প্রশিক্ষন প্রাপ্ত নয়', 'none-trained', 1, 5, NULL, '2022-09-03 15:25:39', '2022-09-03 15:25:39'),
(30, 12, 'Farmer', 'কৃষক', 'farmer', 1, 5, NULL, '2022-09-03 15:26:08', '2022-09-03 15:26:08'),
(31, 12, 'Driver', 'ড্রাইভার', 'driver', 1, 5, NULL, '2022-09-03 15:26:31', '2022-09-03 15:26:31'),
(32, 12, 'Tailor', 'দর্জি', 'tailor', 1, 5, NULL, '2022-09-03 15:27:58', '2022-09-03 15:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `profession_sub_categories`
--

CREATE TABLE `profession_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profession_category_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profession_sub_categories`
--

INSERT INTO `profession_sub_categories` (`id`, `profession_category_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administration', 'প্রশাসন', 'administration', 1, 5, NULL, '2022-09-04 12:32:33', '2022-09-04 13:08:30'),
(2, 1, 'Education', 'শিক্ষা', 'education', 1, 5, NULL, '2022-09-04 12:52:38', '2022-09-04 12:52:38'),
(3, 1, 'Police', 'পুলিশ', 'police', 1, 5, NULL, '2022-09-04 12:53:19', '2022-09-04 12:53:19'),
(4, 1, 'Medical', 'চিকিৎসা', 'medical', 1, 5, NULL, '2022-09-04 12:54:48', '2022-09-04 12:54:48'),
(5, 2, 'Administration', 'প্রশাসন', 'administration', 1, 5, NULL, '2022-09-04 13:15:08', '2022-09-04 13:15:08'),
(6, 2, 'Education', 'শিক্ষা', 'education', 1, 5, NULL, '2022-09-04 13:16:39', '2022-09-04 13:16:39'),
(7, 2, 'Medical', 'চিকিৎসা', 'medical', 1, 5, NULL, '2022-09-04 13:17:34', '2022-09-04 13:17:34'),
(9, 6, 'Software Development', 'সফটওয়্যার তৈরী', 'software-development', 1, 1, NULL, '2022-09-09 23:04:47', '2022-09-09 23:04:47'),
(10, 19, 'Criminal', 'ক্রিমিনাল', 'criminal', 1, 1, NULL, '2026-04-10 06:04:56', '2026-04-10 06:04:56'),
(11, 23, 'School', 'স্কুল', 'school', 1, 1, NULL, '2026-04-10 06:06:09', '2026-04-10 06:06:09'),
(12, 23, 'College', 'কলেজ', 'college', 1, 1, NULL, '2026-04-10 06:06:36', '2026-04-10 06:06:36'),
(13, 23, 'University', 'বিশ্ববিদ্যালয়', 'university', 1, 1, NULL, '2026-04-10 06:07:37', '2026-04-10 06:07:37'),
(14, 8, 'Agent', 'এজেন্ট', 'agent', 1, 1, NULL, '2026-04-20 22:27:38', '2026-04-20 22:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `profession_types`
--

CREATE TABLE `profession_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profession_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profession_types`
--

INSERT INTO `profession_types` (`id`, `profession_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Government', 'সরকারী', 'government', 1, 5, NULL, '2022-09-03 14:17:29', '2022-09-03 14:17:29'),
(2, 1, 'Private', 'বেসরকারী', 'private', 1, 5, 5, '2022-09-03 14:17:48', '2022-09-03 14:21:26'),
(3, 2, 'Small', 'ক্ষুদ্র', 'small', 1, 5, NULL, '2022-09-03 14:22:19', '2022-09-03 14:22:19'),
(4, 2, 'Medium', 'মাঝারী', 'medium', 1, 5, NULL, '2022-09-03 14:27:15', '2022-09-03 14:27:15'),
(5, 2, 'Large', 'বৃহৎ', 'large', 1, 5, NULL, '2022-09-03 14:27:48', '2022-09-03 14:27:48'),
(6, 3, 'Lawyer', 'আইনজীবি', 'lawyer', 1, 5, NULL, '2022-09-03 14:28:20', '2022-09-03 14:28:20'),
(7, 3, 'Journalist', 'সাংবাদিক', 'journalist', 1, 5, NULL, '2022-09-03 14:28:49', '2022-09-03 14:28:49'),
(8, 4, 'General', 'সাধারণ', 'general', 1, 5, NULL, '2022-09-03 14:29:30', '2022-09-03 14:29:30'),
(9, 4, 'Technical', 'কারিগরি', 'technical', 1, 5, NULL, '2022-09-03 14:29:49', '2022-09-03 14:29:49'),
(10, 4, 'Islamic Studies', 'মাদ্রসা', 'islamic-studies', 1, 5, NULL, '2022-09-03 14:35:12', '2022-09-03 14:35:12'),
(11, 5, 'IT', 'আইটি', 'it', 1, 5, NULL, '2022-09-03 14:35:49', '2022-09-03 14:35:49'),
(12, 5, 'Others', 'অন্যান্য', 'others', 1, 5, NULL, '2022-09-03 14:36:10', '2022-09-03 14:36:10'),
(13, 6, 'House Wife', 'Housewife', 'house-wife', 1, 1, NULL, '2022-12-05 08:28:11', '2022-12-05 08:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_type_id` bigint(20) DEFAULT NULL,
  `union_id` bigint(20) DEFAULT NULL,
  `pourashava_id` bigint(20) DEFAULT NULL,
  `city_corporation_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_type_id`, `union_id`, `pourashava_id`, `city_corporation_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2299, NULL, NULL, '2024-08-01 03:19:40', '2024-08-01 03:19:40'),
(2, 2, NULL, 277, NULL, '2026-01-16 06:33:47', '2026-01-16 06:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `project_types`
--

CREATE TABLE `project_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_infos`
--

CREATE TABLE `property_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_property` tinyint(1) DEFAULT 0,
  `cash_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `tin_number` varchar(191) DEFAULT NULL,
  `house` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>Yes, 0=>No',
  `house_type` varchar(191) DEFAULT NULL,
  `house_area` varchar(191) DEFAULT NULL,
  `house_land_quantity` varchar(191) DEFAULT NULL,
  `house_price` double(8,2) NOT NULL DEFAULT 0.00,
  `house_ownership_status` varchar(191) DEFAULT NULL,
  `house_address` varchar(191) DEFAULT NULL,
  `land` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>Yes, 0=>No',
  `land_district_id` bigint(20) DEFAULT NULL,
  `land_thana_id` bigint(20) DEFAULT NULL,
  `land_mouza_id` bigint(20) DEFAULT NULL,
  `land_khatian_id` bigint(20) DEFAULT NULL,
  `land_dag_no` varchar(191) DEFAULT NULL,
  `land_bs` varchar(191) DEFAULT NULL,
  `land_rs` varchar(191) DEFAULT NULL,
  `land_sa` varchar(191) DEFAULT NULL,
  `land_cs` varchar(191) DEFAULT NULL,
  `land_quantity` varchar(191) DEFAULT NULL,
  `land_type` varchar(191) DEFAULT NULL,
  `land_ownership_status` varchar(191) DEFAULT NULL,
  `flat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>Yes, 0=>No',
  `flat_district_id` bigint(20) DEFAULT NULL,
  `flat_thana_id` bigint(20) DEFAULT NULL,
  `flat_mouza_id` bigint(20) DEFAULT NULL,
  `flat_area` varchar(191) DEFAULT NULL,
  `flat_road` varchar(191) DEFAULT NULL,
  `flat_house_no` varchar(191) DEFAULT NULL,
  `flat_quantity` varchar(191) DEFAULT NULL,
  `flat_price` double(8,2) NOT NULL DEFAULT 0.00,
  `flat_ownership_status` varchar(191) DEFAULT NULL,
  `diamond` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>Yes, 0=>No',
  `diamond_type` varchar(191) DEFAULT NULL,
  `diamond_quantity` varchar(191) DEFAULT NULL,
  `diamond_price` double(8,2) NOT NULL DEFAULT 0.00,
  `diamond_ownership_status` varchar(191) DEFAULT NULL,
  `gold` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>Yes, 0=>No',
  `gold_type` varchar(191) DEFAULT NULL,
  `gold_quantity` varchar(191) DEFAULT NULL,
  `gold_price` double(8,2) NOT NULL DEFAULT 0.00,
  `gold_ownership_status` varchar(191) DEFAULT NULL,
  `silver` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>Yes, 0=>No',
  `silver_type` varchar(191) DEFAULT NULL,
  `silver_quantity` varchar(191) DEFAULT NULL,
  `silver_price` double(8,2) NOT NULL DEFAULT 0.00,
  `silver_ownership_status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_infos`
--

INSERT INTO `property_infos` (`id`, `user_id`, `is_property`, `cash_amount`, `tin_number`, `house`, `house_type`, `house_area`, `house_land_quantity`, `house_price`, `house_ownership_status`, `house_address`, `land`, `land_district_id`, `land_thana_id`, `land_mouza_id`, `land_khatian_id`, `land_dag_no`, `land_bs`, `land_rs`, `land_sa`, `land_cs`, `land_quantity`, `land_type`, `land_ownership_status`, `flat`, `flat_district_id`, `flat_thana_id`, `flat_mouza_id`, `flat_area`, `flat_road`, `flat_house_no`, `flat_quantity`, `flat_price`, `flat_ownership_status`, `diamond`, `diamond_type`, `diamond_quantity`, `diamond_price`, `diamond_ownership_status`, `gold`, `gold_type`, `gold_quantity`, `gold_price`, `gold_ownership_status`, `silver`, `silver_type`, `silver_quantity`, `silver_price`, `silver_ownership_status`, `created_at`, `updated_at`) VALUES
(1, 6, 0, 0.00, NULL, 0, NULL, NULL, NULL, 0.00, NULL, NULL, 0, 25, 201, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, '2022-10-15 15:12:58', '2022-10-15 21:21:29'),
(2, 24, 0, 0.00, NULL, 0, NULL, NULL, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, '2023-02-26 21:59:52', '2023-02-26 21:59:52'),
(3, 78, 0, 0.00, NULL, 0, NULL, NULL, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, '2026-03-02 14:40:26', '2026-03-02 14:40:26'),
(4, 80, 0, 0.00, NULL, 0, NULL, NULL, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, '2026-03-03 15:27:46', '2026-03-03 15:27:46'),
(5, 84, 1, 10000.00, '123426574332', 0, NULL, NULL, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, '2026-03-30 11:33:55', '2026-03-30 11:33:55'),
(6, 134, 0, 0.00, NULL, 0, NULL, NULL, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, 0, '1', NULL, 0.00, NULL, '2026-05-01 23:05:36', '2026-05-01 23:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Islam', 'islam', 1, 1, NULL, NULL, NULL),
(2, 'Hinduism ', 'hinduism', 1, 1, NULL, NULL, NULL),
(3, 'Buddhism', 'buddhism ', 1, 1, NULL, NULL, NULL),
(4, 'Christianity', 'christianity', 1, 1, NULL, NULL, NULL),
(5, 'Others', 'others', 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `remarried_certificates`
--

CREATE TABLE `remarried_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `remarried_certificates`
--

INSERT INTO `remarried_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-20 00:01:25', '2022-10-20 00:01:25'),
(2, '2022102', 6, 0.00, 1, 0.00, 5, '2022-10-20 00:05:02', '2022-10-20 00:05:02'),
(3, '20260214001', 8, 0.00, 1, 0.00, 7, '2026-02-14 04:31:25', '2026-02-14 04:31:25'),
(4, '20260305002', 8, 0.00, 1, 0.00, 7, '2026-03-04 23:28:29', '2026-03-04 23:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `residential_certificates`
--

CREATE TABLE `residential_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `residential_certificates`
--

INSERT INTO `residential_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:19:46', '2022-10-21 00:19:46'),
(2, '20230612002', 11, 0.00, 1, 0.00, 7, '2023-06-12 05:24:36', '2023-06-12 05:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `roads`
--

CREATE TABLE `roads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `distance` double(8,2) NOT NULL DEFAULT 0.00,
  `institute_id` bigint(20) DEFAULT NULL,
  `road_type_id` bigint(20) DEFAULT NULL,
  `road_category_id` bigint(20) DEFAULT NULL,
  `road_owner_id` bigint(20) DEFAULT NULL,
  `start_point` varchar(191) DEFAULT NULL,
  `end_point` varchar(191) DEFAULT NULL,
  `make_year` varchar(191) DEFAULT NULL,
  `make_contactor` varchar(191) DEFAULT NULL,
  `make_value` double(8,2) NOT NULL DEFAULT 0.00,
  `current_condition` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roads`
--

INSERT INTO `roads` (`id`, `name`, `bn_name`, `distance`, `institute_id`, `road_type_id`, `road_category_id`, `road_owner_id`, `start_point`, `end_point`, `make_year`, `make_contactor`, `make_value`, `current_condition`, `created_at`, `updated_at`) VALUES
(1, 'Dante Burt', 'ঈদগাহ রোড', 93.00, 1, 3, 1, 1, 'Dolores dolor ut iur', 'Nulla sed sit vero', '1974', 'Qui iure sequi qui q', 45.00, 'Ex atque et odio dol', '2022-10-15 21:20:00', '2022-12-26 13:14:16'),
(2, 'North Shuktail Main Road', 'উত্তর শুকতাইল মেইন রোড', 5.00, 2, 3, 3, 2, 'a', 'a', '1961', 'NA', 1.00, 'New', '2022-10-25 11:14:39', '2022-10-25 11:14:39'),
(4, 'Paikerdanga Road', 'পাইকেরডাঙ্গা রোড', 3.00, 2, 3, 3, 2, 'Gurolpara', 'Bashabari', '2002', 'Facilis quia nemo en', 72.00, 'Omnis dolorem commod', '2022-12-26 12:57:53', '2026-02-26 17:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `road_categories`
--

CREATE TABLE `road_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `road_categories`
--

INSERT INTO `road_categories` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Soiling', 'কাঁচা', 'soiling', 1, 1, NULL, '2022-08-28 15:45:23', '2022-09-09 22:29:00'),
(2, 'Brick Soling', 'ইটের সলিং', 'brick-soling', 1, 1, NULL, '2022-08-28 15:45:30', '2022-09-09 22:28:15'),
(3, 'Carpeting', 'পাকা', 'carpeting', 1, 1, NULL, '2022-08-28 15:45:38', '2022-09-09 22:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `road_owners`
--

CREATE TABLE `road_owners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `road_owners`
--

INSERT INTO `road_owners` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Private', 'ব্যক্তিগত', 'private', 1, 1, NULL, '2022-08-28 15:45:52', '2022-09-09 22:32:37'),
(2, 'LGED', 'স্থানীয় সরকার', 'lged', 1, 1, NULL, '2022-08-28 15:45:59', '2022-09-09 22:31:51'),
(3, 'Roads & Hiway Department', 'সড়ক ও মহাসড়ক অধিদপ্তর', 'roads-hiway-department', 1, 1, NULL, '2022-08-28 15:46:18', '2022-09-09 22:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `road_types`
--

CREATE TABLE `road_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `road_types`
--

INSERT INTO `road_types` (`id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Local Hiway', 'স্থানীয় মহাসড়ক', 'local-hiway', 1, 1, NULL, '2022-08-28 15:45:09', '2022-09-09 22:24:17'),
(2, 'National Hiway', 'জাতীয় মহাসড়ক', 'national-hiway', 1, 1, NULL, '2022-08-28 15:45:17', '2022-09-09 22:23:19'),
(3, 'Local Road', 'স্থানীয় সড়ক', 'local-road', 1, 1, NULL, '2022-09-09 22:24:53', '2022-09-09 22:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `guard_name` varchar(50) DEFAULT 'web',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `guard_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'Admin', 'web', 1, 1, NULL, NULL, NULL),
(2, 'DC', 'dc', 'DC', 'web', 1, 1, NULL, NULL, NULL),
(3, 'UNO', 'eno', 'ENO', 'web', 1, 1, NULL, NULL, '2024-09-02 12:01:01'),
(4, 'Developer', 'developer', 'Developer', 'web', 1, 1, NULL, NULL, NULL),
(5, 'User', 'user', 'User', 'web', 1, 1, NULL, NULL, NULL),
(6, 'Union Admin', 'union-admin', 'Union Admin', 'web', 1, 1, NULL, NULL, NULL),
(7, 'Union User', 'union-user', 'Union User', 'web', 1, 1, NULL, NULL, NULL),
(8, 'Pourashava Admin', 'pourashava-admin', 'Pourashava Admin', 'web', 1, 1, NULL, NULL, NULL),
(9, 'Pourashava User', 'pourashava-user', 'Pourashava User', 'web', 1, 1, NULL, NULL, NULL),
(10, 'City Corporation Admin', 'city-corporation-admin', 'City Corporation Admin', 'web', 1, 1, NULL, NULL, NULL),
(11, 'City Corporation User', 'city-corporation-user', 'City Corporation User', 'web', 1, 1, NULL, NULL, '2024-08-24 19:38:01'),
(12, 'test 4', NULL, NULL, 'web', 1, NULL, NULL, '2024-08-25 23:04:04', '2024-09-05 11:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(34, 1),
(34, 2);

-- --------------------------------------------------------

--
-- Table structure for table `successions`
--

CREATE TABLE `successions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(190) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `death_certificate_id` bigint(20) UNSIGNED NOT NULL,
  `members` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`members`)),
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `taken_by` bigint(20) NOT NULL DEFAULT 1,
  `date_of_death` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `successions`
--

INSERT INTO `successions` (`id`, `system_id`, `user_id`, `death_certificate_id`, `members`, `fees`, `quantity`, `total_amount`, `created_by`, `taken_by`, `date_of_death`, `created_at`, `updated_at`) VALUES
(3, '20260219003', 69, 9, '{\"699768e5a0dda\":{\"name\":\"Md. Shafiul Islam Sohan\",\"age\":\"52\",\"nid\":\"1234567890\",\"relation\":\"Son\"}}', 0.00, 0, 0.00, 7, 1, NULL, '2026-02-19 15:49:00', '2026-02-19 15:49:00'),
(5, '20260219005', 68, 14, '{\"69976d560bd35\":{\"name\":\"McKenzie Webb\",\"age\":\"21\",\"nid\":\"20260215031\",\"relation\":\"Son\"}}', 0.00, 0, 0.00, 7, 1, NULL, '2026-02-19 16:06:52', '2026-02-19 16:06:52'),
(6, '20260220006', 68, 14, '{\"6997f773c3548\":{\"name\":\"McKenzie Webb\",\"age\":\"21\",\"nid\":\"20260215031\",\"relation\":\"Son\"}}', 0.00, 0, 0.00, 7, 1, NULL, '2026-02-20 01:56:07', '2026-02-20 01:56:07'),
(7, '20260221007', 69, 16, '{\"69996d36428f8\":{\"name\":\"Test 1\",\"age\":\"345\",\"nid\":\"1234567890\",\"relation\":\"son\"}}', 0.00, 0, 0.00, 7, 1, NULL, '2026-02-21 04:31:39', '2026-02-21 04:31:39'),
(8, '20260328008', 77, 17, '{\"69c75f85aa4dd\":{\"name\":\"\\u0986\\u09b2\\u09ae \\u09ae\\u09be\\u09b9\\u09ae\\u09c1\\u09a6\",\"age\":\"\\u09e9\\u09ed\",\"nid\":\"\\u09e7\\u09ee\\u09ef\\u09e8\\u09e9\\u09ea\\u09e8\\u09e7\\u09ee\",\"relation\":\"\\u09aa\\u09c1\\u09a4\\u09cd\\u09b0\"},\"19d32cfe405284f800\":{\"name\":\"\\u09a8\\u09be\\u09ab\\u09bf\\u099c\\u09be \\u09ae\\u09be\\u09b9\\u09ae\\u09c1\\u09a6\",\"age\":\"\\u09e9\\u09e6\",\"nid\":\"\\u09e8\\u09e7\\u09ec\\u09ea\\u09ee\\u09e9\\u09ef\\u09e6\\u09e9\",\"relation\":\"\\u0995\\u09a8\\u09cd\\u09af\\u09be\"},\"19d32d0530d300af3f\":{\"name\":\"\\u0986\\u09a8\\u099c\\u09c1\\u09ae \\u09ae\\u09be\\u09b9\\u09ae\\u09c1\\u09a6\",\"age\":\"\\u09e8\\u09eb\",\"nid\":\"\\u09e8\\u09e9\\u09ea\\u09ec\\u09eb\\u09ea\\u09e8\\u09e7\\u09ed\",\"relation\":\"\\u0995\\u09a8\\u09cd\\u09af\\u09be\"}}', 0.00, 0, 0.00, 7, 1, NULL, '2026-03-28 01:00:50', '2026-03-28 01:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `institute_id` bigint(20) NOT NULL,
  `tax_year_id` bigint(20) DEFAULT NULL,
  `village_id` bigint(20) DEFAULT NULL,
  `ward_id` bigint(20) DEFAULT NULL,
  `area_id` bigint(20) DEFAULT NULL,
  `house_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_system_id` bigint(20) NOT NULL,
  `previous_residence_tax` double(16,2) DEFAULT 0.00,
  `previous_income_tax` double(16,2) DEFAULT 0.00,
  `previous_entertainment_institute_tax` double(16,2) DEFAULT 0.00,
  `previous_license_tax` double(16,2) DEFAULT 0.00,
  `previous_bazar_tax` double(16,2) DEFAULT 0.00,
  `previous_land_tax` double(16,2) DEFAULT 0.00,
  `previous_auction_tax` double(16,2) DEFAULT 0.00,
  `previous_fine` double(16,2) DEFAULT 0.00,
  `previous_others` double(16,2) DEFAULT 0.00,
  `previous_extra` double(16,2) DEFAULT 0.00,
  `residence_tax` double(16,2) DEFAULT 0.00,
  `income_tax` double(16,2) DEFAULT 0.00,
  `entertainment_institute_tax` double(16,2) DEFAULT 0.00,
  `license_tax` double(16,2) DEFAULT 0.00,
  `bazar_tax` double(16,2) DEFAULT 0.00,
  `land_tax` double(16,2) DEFAULT 0.00,
  `auction_tax` double(16,2) DEFAULT 0.00,
  `fine` double(16,2) DEFAULT 0.00,
  `others` double(16,2) DEFAULT 0.00,
  `extra` double(16,2) DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `system_id`, `institute_id`, `tax_year_id`, `village_id`, `ward_id`, `area_id`, `house_id`, `user_id`, `user_system_id`, `previous_residence_tax`, `previous_income_tax`, `previous_entertainment_institute_tax`, `previous_license_tax`, `previous_bazar_tax`, `previous_land_tax`, `previous_auction_tax`, `previous_fine`, `previous_others`, `previous_extra`, `residence_tax`, `income_tax`, `entertainment_institute_tax`, `license_tax`, `bazar_tax`, `land_tax`, `auction_tax`, `fine`, `others`, `extra`, `status`, `created_at`, `updated_at`) VALUES
(1, '20230214001', 1, 1, 1, 8, 1, 1, 5, 20221226009, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 500.00, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-02-13 23:47:25', '2023-02-14 00:05:29'),
(2, '20230214002', 2, 2, 2, 9, 5, 5, 8, 20220910002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 600.00, 200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-02-14 03:32:37', '2026-03-06 02:26:03'),
(3, '20230227003', 2, 2, 2, 9, 5, 5, 24, 20230227011, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 200.00, 100.00, NULL, NULL, NULL, 50.00, NULL, NULL, NULL, NULL, 1, '2023-02-26 22:06:57', '2026-04-08 02:07:53'),
(4, '20230227004', 1, 1, 1, 5, 1, 1, 5, 20221226009, 65.00, 478.00, 72.00, 40.00, 94.00, 24.00, 12.00, 28.00, 78.00, 89.00, 11.00, 317.00, 6.00, 81.00, 79.00, 62.00, 67.00, 32.00, 19.00, 83.00, 0, '2023-02-26 23:24:35', '2023-02-26 23:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_years`
--

CREATE TABLE `tax_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_years`
--

INSERT INTO `tax_years` (`id`, `name`, `bn_name`, `status`, `created_at`, `updated_at`) VALUES
(1, '2021-2022', '২০২১-২০২২', 1, NULL, NULL),
(2, '2022-2023', '২০২২-২০২৩', 1, NULL, NULL),
(3, '2023-2024', '২০২৩-২০২৪', 1, NULL, NULL),
(4, '2024-2025', '২০২৪-২০২৫', 1, NULL, NULL),
(5, '2025-2026', '২০২৫-২০২৬', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `name`, `bn_name`, `url`, `status`, `district_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Debidwar', 'দেবিদ্বার', 'debidwar.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(2, 'Barura', 'বরুড়া', 'barura.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(3, 'Brahmanpara', 'ব্রাহ্মণপাড়া', 'brahmanpara.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(4, 'Chandina', 'চান্দিনা', 'chandina.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(5, 'Chauddagram', 'চৌদ্দগ্রাম', 'chauddagram.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(6, 'Daudkandi', 'দাউদকান্দি', 'daudkandi.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(7, 'Homna', 'হোমনা', 'homna.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(8, 'Laksam', 'লাকসাম', 'laksam.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(9, 'Muradnagar', 'মুরাদনগর', 'muradnagar.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(10, 'Nangalkot', 'নাঙ্গলকোট', 'nangalkot.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(11, 'Comilla Sadar', 'কুমিল্লা সদর', 'comillasadar.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(12, 'Meghna', 'মেঘনা', 'meghna.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(13, 'Monohargonj', 'মনোহরগঞ্জ', 'monohargonj.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(14, 'Sadarsouth', 'সদর দক্ষিণ', 'sadarsouth.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(15, 'Titas', 'তিতাস', 'titas.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(16, 'Burichang', 'বুড়িচং', 'burichang.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(17, 'Lalmai', 'লালমাই', 'lalmai.comilla.gov.bd', 1, 1, NULL, NULL, NULL),
(18, 'Chhagalnaiya', 'ছাগলনাইয়া', 'chhagalnaiya.feni.gov.bd', 1, 2, NULL, NULL, NULL),
(19, 'Feni Sadar', 'ফেনী সদর', 'sadar.feni.gov.bd', 1, 2, NULL, NULL, NULL),
(20, 'Sonagazi', 'সোনাগাজী', 'sonagazi.feni.gov.bd', 1, 2, NULL, NULL, NULL),
(21, 'Fulgazi', 'ফুলগাজী', 'fulgazi.feni.gov.bd', 1, 2, NULL, NULL, NULL),
(22, 'Parshuram', 'পরশুরাম', 'parshuram.feni.gov.bd', 1, 2, NULL, NULL, NULL),
(23, 'Daganbhuiyan', 'দাগনভূঞা', 'daganbhuiyan.feni.gov.bd', 1, 2, NULL, NULL, NULL),
(24, 'Brahmanbaria Sadar', 'ব্রাহ্মণবাড়িয়া সদর', 'sadar.brahmanbaria.gov.bd', 1, 3, NULL, NULL, NULL),
(25, 'Kasba', 'কসবা', 'kasba.brahmanbaria.gov.bd', 1, 3, NULL, NULL, NULL),
(26, 'Nasirnagar', 'নাসিরনগর', 'nasirnagar.brahmanbaria.gov.bd', 1, 3, NULL, NULL, NULL),
(27, 'Sarail', 'সরাইল', 'sarail.brahmanbaria.gov.bd', 1, 3, NULL, NULL, NULL),
(28, 'Ashuganj', 'আশুগঞ্জ', 'ashuganj.brahmanbaria.gov.bd', 1, 3, NULL, NULL, NULL),
(29, 'Akhaura', 'আখাউড়া', 'akhaura.brahmanbaria.gov.bd', 1, 3, NULL, NULL, NULL),
(30, 'Nabinagar', 'নবীনগর', 'nabinagar.brahmanbaria.gov.bd', 1, 3, NULL, NULL, NULL),
(31, 'Bancharampur', 'বাঞ্ছারামপুর', 'bancharampur.brahmanbaria.gov.bd', 1, 3, NULL, NULL, NULL),
(32, 'Bijoynagar', 'বিজয়নগর', 'bijoynagar.brahmanbaria.gov.bd    ', 1, 3, NULL, NULL, NULL),
(33, 'Rangamati Sadar', 'রাঙ্গামাটি সদর', 'sadar.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(34, 'Kaptai', 'কাপ্তাই', 'kaptai.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(35, 'Kawkhali', 'কাউখালী', 'kawkhali.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(36, 'Baghaichari', 'বাঘাইছড়ি', 'baghaichari.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(37, 'Barkal', 'বরকল', 'barkal.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(38, 'Langadu', 'লংগদু', 'langadu.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(39, 'Rajasthali', 'রাজস্থলী', 'rajasthali.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(40, 'Belaichari', 'বিলাইছড়ি', 'belaichari.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(41, 'Juraichari', 'জুরাছড়ি', 'juraichari.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(42, 'Naniarchar', 'নানিয়ারচর', 'naniarchar.rangamati.gov.bd', 1, 4, NULL, NULL, NULL),
(43, 'Noakhali Sadar', 'নোয়াখালী সদর', 'sadar.noakhali.gov.bd', 1, 5, NULL, NULL, NULL),
(44, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.noakhali.gov.bd', 1, 5, NULL, NULL, NULL),
(45, 'Begumganj', 'বেগমগঞ্জ', 'begumganj.noakhali.gov.bd', 1, 5, NULL, NULL, NULL),
(46, 'Hatia', 'হাতিয়া', 'hatia.noakhali.gov.bd', 1, 5, NULL, NULL, NULL),
(47, 'Subarnachar', 'সুবর্ণচর', 'subarnachar.noakhali.gov.bd', 1, 5, NULL, NULL, NULL),
(48, 'Kabirhat', 'কবিরহাট', 'kabirhat.noakhali.gov.bd', 1, 5, NULL, NULL, NULL),
(49, 'Senbug', 'সেনবাগ', 'senbug.noakhali.gov.bd', 1, 5, NULL, NULL, NULL),
(50, 'Chatkhil', 'চাটখিল', 'chatkhil.noakhali.gov.bd', 1, 5, NULL, NULL, NULL),
(51, 'Sonaimori', 'সোনাইমুড়ী', 'sonaimori.noakhali.gov.bd', 1, 5, NULL, NULL, NULL),
(52, 'Haimchar', 'হাইমচর', 'haimchar.chandpur.gov.bd', 1, 6, NULL, NULL, NULL),
(53, 'Kachua', 'কচুয়া', 'kachua.chandpur.gov.bd', 1, 6, NULL, NULL, NULL),
(54, 'Shahrasti', 'শাহরাস্তি     ', 'shahrasti.chandpur.gov.bd', 1, 6, NULL, NULL, NULL),
(55, 'Chandpur Sadar', 'চাঁদপুর সদর', 'sadar.chandpur.gov.bd', 1, 6, NULL, NULL, NULL),
(56, 'Matlab South', 'মতলব দক্ষিণ', 'matlabsouth.chandpur.gov.bd', 1, 6, NULL, NULL, NULL),
(57, 'Hajiganj', 'হাজীগঞ্জ', 'hajiganj.chandpur.gov.bd', 1, 6, NULL, NULL, NULL),
(58, 'Matlab North', 'মতলব উত্তর', 'matlabnorth.chandpur.gov.bd', 1, 6, NULL, NULL, NULL),
(59, 'Faridgonj', 'ফরিদগঞ্জ', 'faridgonj.chandpur.gov.bd', 1, 6, NULL, NULL, NULL),
(60, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর', 'sadar.lakshmipur.gov.bd', 1, 7, NULL, NULL, NULL),
(61, 'Kamalnagar', 'কমলনগর', 'kamalnagar.lakshmipur.gov.bd', 1, 7, NULL, NULL, NULL),
(62, 'Raipur', 'রায়পুর', 'raipur.lakshmipur.gov.bd', 1, 7, NULL, NULL, NULL),
(63, 'Ramgati', 'রামগতি', 'ramgati.lakshmipur.gov.bd', 1, 7, NULL, NULL, NULL),
(64, 'Ramganj', 'রামগঞ্জ', 'ramganj.lakshmipur.gov.bd', 1, 7, NULL, NULL, NULL),
(65, 'Rangunia', 'রাঙ্গুনিয়া', 'rangunia.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(66, 'Sitakunda', 'সীতাকুন্ড', 'sitakunda.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(67, 'Mirsharai', 'মীরসরাই', 'mirsharai.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(68, 'Patiya', 'পটিয়া', 'patiya.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(69, 'Sandwip', 'সন্দ্বীপ', 'sandwip.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(70, 'Banshkhali', 'বাঁশখালী', 'banshkhali.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(71, 'Boalkhali', 'বোয়ালখালী', 'boalkhali.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(72, 'Anwara', 'আনোয়ারা', 'anwara.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(73, 'Chandanaish', 'চন্দনাইশ', 'chandanaish.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(74, 'Satkania', 'সাতকানিয়া', 'satkania.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(75, 'Lohagara', 'লোহাগাড়া', 'lohagara.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(76, 'Hathazari', 'হাটহাজারী', 'hathazari.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(77, 'Fatikchhari', 'ফটিকছড়ি', 'fatikchhari.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(78, 'Raozan', 'রাউজান', 'raozan.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(79, 'Karnafuli', 'কর্ণফুলী', 'karnafuli.chittagong.gov.bd', 1, 8, NULL, NULL, NULL),
(80, 'Coxsbazar Sadar', 'কক্সবাজার সদর', 'sadar.coxsbazar.gov.bd', 1, 9, NULL, NULL, NULL),
(81, 'Chakaria', 'চকরিয়া', 'chakaria.coxsbazar.gov.bd', 1, 9, NULL, NULL, NULL),
(82, 'Kutubdia', 'কুতুবদিয়া', 'kutubdia.coxsbazar.gov.bd', 1, 9, NULL, NULL, NULL),
(83, 'Ukhiya', 'উখিয়া', 'ukhiya.coxsbazar.gov.bd', 1, 9, NULL, NULL, NULL),
(84, 'Moheshkhali', 'মহেশখালী', 'moheshkhali.coxsbazar.gov.bd', 1, 9, NULL, NULL, NULL),
(85, 'Pekua', 'পেকুয়া', 'pekua.coxsbazar.gov.bd', 1, 9, NULL, NULL, NULL),
(86, 'Ramu', 'রামু', 'ramu.coxsbazar.gov.bd', 1, 9, NULL, NULL, NULL),
(87, 'Teknaf', 'টেকনাফ', 'teknaf.coxsbazar.gov.bd', 1, 9, NULL, NULL, NULL),
(88, 'Khagrachhari Sadar', 'খাগড়াছড়ি সদর', 'sadar.khagrachhari.gov.bd', 1, 10, NULL, NULL, NULL),
(89, 'Dighinala', 'দিঘীনালা', 'dighinala.khagrachhari.gov.bd', 1, 10, NULL, NULL, NULL),
(90, 'Panchari', 'পানছড়ি', 'panchari.khagrachhari.gov.bd', 1, 10, NULL, NULL, NULL),
(91, 'Laxmichhari', 'লক্ষীছড়ি', 'laxmichhari.khagrachhari.gov.bd', 1, 10, NULL, NULL, NULL),
(92, 'Mohalchari', 'মহালছড়ি', 'mohalchari.khagrachhari.gov.bd', 1, 10, NULL, NULL, NULL),
(93, 'Manikchari', 'মানিকছড়ি', 'manikchari.khagrachhari.gov.bd', 1, 10, NULL, NULL, NULL),
(94, 'Ramgarh', 'রামগড়', 'ramgarh.khagrachhari.gov.bd', 1, 10, NULL, NULL, NULL),
(95, 'Matiranga', 'মাটিরাঙ্গা', 'matiranga.khagrachhari.gov.bd', 1, 10, NULL, NULL, NULL),
(96, 'Guimara', 'গুইমারা', 'guimara.khagrachhari.gov.bd', 1, 10, NULL, NULL, NULL),
(97, 'Bandarban Sadar', 'বান্দরবান সদর', 'sadar.bandarban.gov.bd', 1, 11, NULL, NULL, NULL),
(98, 'Alikadam', 'আলীকদম', 'alikadam.bandarban.gov.bd', 1, 11, NULL, NULL, NULL),
(99, 'Naikhongchhari', 'নাইক্ষ্যংছড়ি', 'naikhongchhari.bandarban.gov.bd', 1, 11, NULL, NULL, NULL),
(100, 'Rowangchhari', 'রোয়াংছড়ি', 'rowangchhari.bandarban.gov.bd', 1, 11, NULL, NULL, NULL),
(101, 'Lama', 'লামা', 'lama.bandarban.gov.bd', 1, 11, NULL, NULL, NULL),
(102, 'Ruma', 'রুমা', 'ruma.bandarban.gov.bd', 1, 11, NULL, NULL, NULL),
(103, 'Thanchi', 'থানচি', 'thanchi.bandarban.gov.bd', 1, 11, NULL, NULL, NULL),
(104, 'Belkuchi', 'বেলকুচি', 'belkuchi.sirajganj.gov.bd', 1, 12, NULL, NULL, NULL),
(105, 'Chauhali', 'চৌহালি', 'chauhali.sirajganj.gov.bd', 1, 12, NULL, NULL, NULL),
(106, 'Kamarkhand', 'কামারখন্দ', 'kamarkhand.sirajganj.gov.bd', 1, 12, NULL, NULL, NULL),
(107, 'Kazipur', 'কাজীপুর', 'kazipur.sirajganj.gov.bd', 1, 12, NULL, NULL, NULL),
(108, 'Raigonj', 'রায়গঞ্জ', 'raigonj.sirajganj.gov.bd', 1, 12, NULL, NULL, NULL),
(109, 'Shahjadpur', 'শাহজাদপুর', 'shahjadpur.sirajganj.gov.bd', 1, 12, NULL, NULL, NULL),
(110, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর', 'sirajganjsadar.sirajganj.gov.bd', 1, 12, NULL, NULL, NULL),
(111, 'Tarash', 'তাড়াশ', 'tarash.sirajganj.gov.bd', 1, 12, NULL, NULL, NULL),
(112, 'Ullapara', 'উল্লাপাড়া', 'ullapara.sirajganj.gov.bd', 1, 12, NULL, NULL, NULL),
(113, 'Sujanagar', 'সুজানগর', 'sujanagar.pabna.gov.bd', 1, 13, NULL, NULL, NULL),
(114, 'Ishurdi', 'ঈশ্বরদী', 'ishurdi.pabna.gov.bd', 1, 13, NULL, NULL, NULL),
(115, 'Bhangura', 'ভাঙ্গুড়া', 'bhangura.pabna.gov.bd', 1, 13, NULL, NULL, NULL),
(116, 'Pabna Sadar', 'পাবনা সদর', 'pabnasadar.pabna.gov.bd', 1, 13, NULL, NULL, NULL),
(117, 'Bera', 'বেড়া', 'bera.pabna.gov.bd', 1, 13, NULL, NULL, NULL),
(118, 'Atghoria', 'আটঘরিয়া', 'atghoria.pabna.gov.bd', 1, 13, NULL, NULL, NULL),
(119, 'Chatmohar', 'চাটমোহর', 'chatmohar.pabna.gov.bd', 1, 13, NULL, NULL, NULL),
(120, 'Santhia', 'সাঁথিয়া', 'santhia.pabna.gov.bd', 1, 13, NULL, NULL, NULL),
(121, 'Faridpur', 'ফরিদপুর', 'faridpur.pabna.gov.bd', 1, 13, NULL, NULL, NULL),
(122, 'Kahaloo', 'কাহালু', 'kahaloo.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(123, 'Bogra Sadar', 'বগুড়া সদর', 'sadar.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(124, 'Shariakandi', 'সারিয়াকান্দি', 'shariakandi.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(125, 'Shajahanpur', 'শাজাহানপুর', 'shajahanpur.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(126, 'Dupchanchia', 'দুপচাচিঁয়া', 'dupchanchia.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(127, 'Adamdighi', 'আদমদিঘি', 'adamdighi.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(128, 'Nondigram', 'নন্দিগ্রাম', 'nondigram.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(129, 'Sonatala', 'সোনাতলা', 'sonatala.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(130, 'Dhunot', 'ধুনট', 'dhunot.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(131, 'Gabtali', 'গাবতলী', 'gabtali.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(132, 'Sherpur', 'শেরপুর', 'sherpur.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(133, 'Shibganj', 'শিবগঞ্জ', 'shibganj.bogra.gov.bd', 1, 14, NULL, NULL, NULL),
(134, 'Paba', 'পবা', 'paba.rajshahi.gov.bd', 1, 15, NULL, NULL, NULL),
(135, 'Durgapur', 'দুর্গাপুর', 'durgapur.rajshahi.gov.bd', 1, 15, NULL, NULL, NULL),
(136, 'Mohonpur', 'মোহনপুর', 'mohonpur.rajshahi.gov.bd', 1, 15, NULL, NULL, NULL),
(137, 'Charghat', 'চারঘাট', 'charghat.rajshahi.gov.bd', 1, 15, NULL, NULL, NULL),
(138, 'Puthia', 'পুঠিয়া', 'puthia.rajshahi.gov.bd', 1, 15, NULL, NULL, NULL),
(139, 'Bagha', 'বাঘা', 'bagha.rajshahi.gov.bd', 1, 15, NULL, NULL, NULL),
(140, 'Godagari', 'গোদাগাড়ী', 'godagari.rajshahi.gov.bd', 1, 15, NULL, NULL, NULL),
(141, 'Tanore', 'তানোর', 'tanore.rajshahi.gov.bd', 1, 15, NULL, NULL, NULL),
(142, 'Bagmara', 'বাগমারা', 'bagmara.rajshahi.gov.bd', 1, 15, NULL, NULL, NULL),
(143, 'Natore Sadar', 'নাটোর সদর', 'natoresadar.natore.gov.bd', 1, 16, NULL, NULL, NULL),
(144, 'Singra', 'সিংড়া', 'singra.natore.gov.bd', 1, 16, NULL, NULL, NULL),
(145, 'Baraigram', 'বড়াইগ্রাম', 'baraigram.natore.gov.bd', 1, 16, NULL, NULL, NULL),
(146, 'Bagatipara', 'বাগাতিপাড়া', 'bagatipara.natore.gov.bd', 1, 16, NULL, NULL, NULL),
(147, 'Lalpur', 'লালপুর', 'lalpur.natore.gov.bd', 1, 16, NULL, NULL, NULL),
(148, 'Gurudaspur', 'গুরুদাসপুর', 'gurudaspur.natore.gov.bd', 1, 16, NULL, NULL, NULL),
(149, 'Naldanga', 'নলডাঙ্গা', 'naldanga.natore.gov.bd', 1, 16, NULL, NULL, NULL),
(150, 'Akkelpur', 'আক্কেলপুর', 'akkelpur.joypurhat.gov.bd', 1, 17, NULL, NULL, NULL),
(151, 'Kalai', 'কালাই', 'kalai.joypurhat.gov.bd', 1, 17, NULL, NULL, NULL),
(152, 'Khetlal', 'ক্ষেতলাল', 'khetlal.joypurhat.gov.bd', 1, 17, NULL, NULL, NULL),
(153, 'Panchbibi', 'পাঁচবিবি', 'panchbibi.joypurhat.gov.bd', 1, 17, NULL, NULL, NULL),
(154, 'Joypurhat Sadar', 'জয়পুরহাট সদর', 'joypurhatsadar.joypurhat.gov.bd', 1, 17, NULL, NULL, NULL),
(155, 'Chapainawabganj Sadar', 'চাঁপাইনবাবগঞ্জ সদর', 'chapainawabganjsadar.chapainawabganj.gov.bd', 1, 18, NULL, NULL, NULL),
(156, 'Gomostapur', 'গোমস্তাপুর', 'gomostapur.chapainawabganj.gov.bd', 1, 18, NULL, NULL, NULL),
(157, 'Nachol', 'নাচোল', 'nachol.chapainawabganj.gov.bd', 1, 18, NULL, NULL, NULL),
(158, 'Bholahat', 'ভোলাহাট', 'bholahat.chapainawabganj.gov.bd', 1, 18, NULL, NULL, NULL),
(159, 'Shibganj', 'শিবগঞ্জ', 'shibganj.chapainawabganj.gov.bd', 1, 18, NULL, NULL, NULL),
(160, 'Mohadevpur', 'মহাদেবপুর', 'mohadevpur.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(161, 'Badalgachi', 'বদলগাছী', 'badalgachi.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(162, 'Patnitala', 'পত্নিতলা', 'patnitala.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(163, 'Dhamoirhat', 'ধামইরহাট', 'dhamoirhat.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(164, 'Niamatpur', 'নিয়ামতপুর', 'niamatpur.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(165, 'Manda', 'মান্দা', 'manda.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(166, 'Atrai', 'আত্রাই', 'atrai.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(167, 'Raninagar', 'রাণীনগর', 'raninagar.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(168, 'Naogaon Sadar', 'নওগাঁ সদর', 'naogaonsadar.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(169, 'Porsha', 'পোরশা', 'porsha.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(170, 'Sapahar', 'সাপাহার', 'sapahar.naogaon.gov.bd', 1, 19, NULL, NULL, NULL),
(171, 'Manirampur', 'মণিরামপুর', 'manirampur.jessore.gov.bd', 1, 20, NULL, NULL, NULL),
(172, 'Abhaynagar', 'অভয়নগর', 'abhaynagar.jessore.gov.bd', 1, 20, NULL, NULL, NULL),
(173, 'Bagherpara', 'বাঘারপাড়া', 'bagherpara.jessore.gov.bd', 1, 20, NULL, NULL, NULL),
(174, 'Chougachha', 'চৌগাছা', 'chougachha.jessore.gov.bd', 1, 20, NULL, NULL, NULL),
(175, 'Jhikargacha', 'ঝিকরগাছা', 'jhikargacha.jessore.gov.bd', 1, 20, NULL, NULL, NULL),
(176, 'Keshabpur', 'কেশবপুর', 'keshabpur.jessore.gov.bd', 1, 20, NULL, NULL, NULL),
(177, 'Jessore Sadar', 'যশোর সদর', 'sadar.jessore.gov.bd', 1, 20, NULL, NULL, NULL),
(178, 'Sharsha', 'শার্শা', 'sharsha.jessore.gov.bd', 1, 20, NULL, NULL, NULL),
(179, 'Assasuni', 'আশাশুনি', 'assasuni.satkhira.gov.bd', 1, 21, NULL, NULL, NULL),
(180, 'Debhata', 'দেবহাটা', 'debhata.satkhira.gov.bd', 1, 21, NULL, NULL, NULL),
(181, 'Kalaroa', 'কলারোয়া', 'kalaroa.satkhira.gov.bd', 1, 21, NULL, NULL, NULL),
(182, 'Satkhira Sadar', 'সাতক্ষীরা সদর', 'satkhirasadar.satkhira.gov.bd', 1, 21, NULL, NULL, NULL),
(183, 'Shyamnagar', 'শ্যামনগর', 'shyamnagar.satkhira.gov.bd', 1, 21, NULL, NULL, NULL),
(184, 'Tala', 'তালা', 'tala.satkhira.gov.bd', 1, 21, NULL, NULL, NULL),
(185, 'Kaliganj', 'কালিগঞ্জ', 'kaliganj.satkhira.gov.bd', 1, 21, NULL, NULL, NULL),
(186, 'Mujibnagar', 'মুজিবনগর', 'mujibnagar.meherpur.gov.bd', 1, 22, NULL, NULL, NULL),
(187, 'Meherpur Sadar', 'মেহেরপুর সদর', 'meherpursadar.meherpur.gov.bd', 1, 22, NULL, NULL, NULL),
(188, 'Gangni', 'গাংনী', 'gangni.meherpur.gov.bd', 1, 22, NULL, NULL, NULL),
(189, 'Narail Sadar', 'নড়াইল সদর', 'narailsadar.narail.gov.bd', 1, 23, NULL, NULL, NULL),
(190, 'Lohagara', 'লোহাগড়া', 'lohagara.narail.gov.bd', 1, 23, NULL, NULL, NULL),
(191, 'Kalia', 'কালিয়া', 'kalia.narail.gov.bd', 1, 23, NULL, NULL, NULL),
(192, 'Chuadanga Sadar', 'চুয়াডাঙ্গা সদর', 'chuadangasadar.chuadanga.gov.bd', 1, 24, NULL, NULL, NULL),
(193, 'Alamdanga', 'আলমডাঙ্গা', 'alamdanga.chuadanga.gov.bd', 1, 24, NULL, NULL, NULL),
(194, 'Damurhuda', 'দামুড়হুদা', 'damurhuda.chuadanga.gov.bd', 1, 24, NULL, NULL, NULL),
(195, 'Jibannagar', 'জীবননগর', 'jibannagar.chuadanga.gov.bd', 1, 24, NULL, NULL, NULL),
(196, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 'kushtiasadar.kushtia.gov.bd', 1, 25, NULL, NULL, NULL),
(197, 'Kumarkhali', 'কুমারখালী', 'kumarkhali.kushtia.gov.bd', 1, 25, NULL, NULL, NULL),
(198, 'Khoksa', 'খোকসা', 'khoksa.kushtia.gov.bd', 1, 25, NULL, NULL, NULL),
(199, 'Mirpur', 'মিরপুর', 'mirpurkushtia.kushtia.gov.bd', 1, 25, NULL, NULL, NULL),
(200, 'Daulatpur', 'দৌলতপুর', 'daulatpur.kushtia.gov.bd', 1, 25, NULL, NULL, NULL),
(201, 'Bheramara', 'ভেড়ামারা', 'bheramara.kushtia.gov.bd', 1, 25, NULL, NULL, NULL),
(202, 'Shalikha', 'শালিখা', 'shalikha.magura.gov.bd', 1, 26, NULL, NULL, NULL),
(203, 'Sreepur', 'শ্রীপুর', 'sreepur.magura.gov.bd', 1, 26, NULL, NULL, NULL),
(204, 'Magura Sadar', 'মাগুরা সদর', 'magurasadar.magura.gov.bd', 1, 26, NULL, NULL, NULL),
(205, 'Mohammadpur', 'মহম্মদপুর', 'mohammadpur.magura.gov.bd', 1, 26, NULL, NULL, NULL),
(206, 'Paikgasa', 'পাইকগাছা', 'paikgasa.khulna.gov.bd', 1, 27, NULL, NULL, NULL),
(207, 'Fultola', 'ফুলতলা', 'fultola.khulna.gov.bd', 1, 27, NULL, NULL, NULL),
(208, 'Digholia', 'দিঘলিয়া', 'digholia.khulna.gov.bd', 1, 27, NULL, NULL, NULL),
(209, 'Rupsha', 'রূপসা', 'rupsha.khulna.gov.bd', 1, 27, NULL, NULL, NULL),
(210, 'Terokhada', 'তেরখাদা', 'terokhada.khulna.gov.bd', 1, 27, NULL, NULL, NULL),
(211, 'Dumuria', 'ডুমুরিয়া', 'dumuria.khulna.gov.bd', 1, 27, NULL, NULL, NULL),
(212, 'Botiaghata', 'বটিয়াঘাটা', 'botiaghata.khulna.gov.bd', 1, 27, NULL, NULL, NULL),
(213, 'Dakop', 'দাকোপ', 'dakop.khulna.gov.bd', 1, 27, NULL, NULL, NULL),
(214, 'Koyra', 'কয়রা', 'koyra.khulna.gov.bd', 1, 27, NULL, NULL, NULL),
(215, 'Fakirhat', 'ফকিরহাট', 'fakirhat.bagerhat.gov.bd', 1, 28, NULL, NULL, NULL),
(216, 'Bagerhat Sadar', 'বাগেরহাট সদর', 'sadar.bagerhat.gov.bd', 1, 28, NULL, NULL, NULL),
(217, 'Mollahat', 'মোল্লাহাট', 'mollahat.bagerhat.gov.bd', 1, 28, NULL, NULL, NULL),
(218, 'Sarankhola', 'শরণখোলা', 'sarankhola.bagerhat.gov.bd', 1, 28, NULL, NULL, NULL),
(219, 'Rampal', 'রামপাল', 'rampal.bagerhat.gov.bd', 1, 28, NULL, NULL, NULL),
(220, 'Morrelganj', 'মোড়েলগঞ্জ', 'morrelganj.bagerhat.gov.bd', 1, 28, NULL, NULL, NULL),
(221, 'Kachua', 'কচুয়া', 'kachua.bagerhat.gov.bd', 1, 28, NULL, NULL, NULL),
(222, 'Mongla', 'মোংলা', 'mongla.bagerhat.gov.bd', 1, 28, NULL, NULL, NULL),
(223, 'Chitalmari', 'চিতলমারী', 'chitalmari.bagerhat.gov.bd', 1, 28, NULL, NULL, NULL),
(224, 'Jhenaidah Sadar', 'ঝিনাইদহ সদর', 'sadar.jhenaidah.gov.bd', 1, 29, NULL, NULL, NULL),
(225, 'Shailkupa', 'শৈলকুপা', 'shailkupa.jhenaidah.gov.bd', 1, 29, NULL, NULL, NULL),
(226, 'Harinakundu', 'হরিণাকুন্ডু', 'harinakundu.jhenaidah.gov.bd', 1, 29, NULL, NULL, NULL),
(227, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.jhenaidah.gov.bd', 1, 29, NULL, NULL, NULL),
(228, 'Kotchandpur', 'কোটচাঁদপুর', 'kotchandpur.jhenaidah.gov.bd', 1, 29, NULL, NULL, NULL),
(229, 'Moheshpur', 'মহেশপুর', 'moheshpur.jhenaidah.gov.bd', 1, 29, NULL, NULL, NULL),
(230, 'Jhalakathi Sadar', 'ঝালকাঠি সদর', 'sadar.jhalakathi.gov.bd', 1, 30, NULL, NULL, NULL),
(231, 'Kathalia', 'কাঠালিয়া', 'kathalia.jhalakathi.gov.bd', 1, 30, NULL, NULL, NULL),
(232, 'Nalchity', 'নলছিটি', 'nalchity.jhalakathi.gov.bd', 1, 30, NULL, NULL, NULL),
(233, 'Rajapur', 'রাজাপুর', 'rajapur.jhalakathi.gov.bd', 1, 30, NULL, NULL, NULL),
(234, 'Bauphal', 'বাউফল', 'bauphal.patuakhali.gov.bd', 1, 31, NULL, NULL, NULL),
(235, 'Patuakhali Sadar', 'পটুয়াখালী সদর', 'sadar.patuakhali.gov.bd', 1, 31, NULL, NULL, NULL),
(236, 'Dumki', 'দুমকি', 'dumki.patuakhali.gov.bd', 1, 31, NULL, NULL, NULL),
(237, 'Dashmina', 'দশমিনা', 'dashmina.patuakhali.gov.bd', 1, 31, NULL, NULL, NULL),
(238, 'Kalapara', 'কলাপাড়া', 'kalapara.patuakhali.gov.bd', 1, 31, NULL, NULL, NULL),
(239, 'Mirzaganj', 'মির্জাগঞ্জ', 'mirzaganj.patuakhali.gov.bd', 1, 31, NULL, NULL, NULL),
(240, 'Galachipa', 'গলাচিপা', 'galachipa.patuakhali.gov.bd', 1, 31, NULL, NULL, NULL),
(241, 'Rangabali', 'রাঙ্গাবালী', 'rangabali.patuakhali.gov.bd', 1, 31, NULL, NULL, NULL),
(242, 'Pirojpur Sadar', 'পিরোজপুর সদর', 'sadar.pirojpur.gov.bd', 1, 32, NULL, NULL, NULL),
(243, 'Nazirpur', 'নাজিরপুর', 'nazirpur.pirojpur.gov.bd', 1, 32, NULL, NULL, NULL),
(244, 'Kawkhali', 'কাউখালী', 'kawkhali.pirojpur.gov.bd', 1, 32, NULL, NULL, NULL),
(245, 'Zianagar', 'জিয়ানগর', 'zianagar.pirojpur.gov.bd', 1, 32, NULL, NULL, NULL),
(246, 'Bhandaria', 'ভান্ডারিয়া', 'bhandaria.pirojpur.gov.bd', 1, 32, NULL, NULL, NULL),
(247, 'Mathbaria', 'মঠবাড়ীয়া', 'mathbaria.pirojpur.gov.bd', 1, 32, NULL, NULL, NULL),
(248, 'Nesarabad', 'নেছারাবাদ', 'nesarabad.pirojpur.gov.bd', 1, 32, NULL, NULL, NULL),
(249, 'Barisal Sadar', 'বরিশাল সদর', 'barisalsadar.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(250, 'Bakerganj', 'বাকেরগঞ্জ', 'bakerganj.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(251, 'Babuganj', 'বাবুগঞ্জ', 'babuganj.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(252, 'Wazirpur', 'উজিরপুর', 'wazirpur.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(253, 'Banaripara', 'বানারীপাড়া', 'banaripara.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(254, 'Gournadi', 'গৌরনদী', 'gournadi.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(255, 'Agailjhara', 'আগৈলঝাড়া', 'agailjhara.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(256, 'Mehendiganj', 'মেহেন্দিগঞ্জ', 'mehendiganj.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(257, 'Muladi', 'মুলাদী', 'muladi.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(258, 'Hizla', 'হিজলা', 'hizla.barisal.gov.bd', 1, 33, NULL, NULL, NULL),
(259, 'Bhola Sadar', 'ভোলা সদর', 'sadar.bhola.gov.bd', 1, 34, NULL, NULL, NULL),
(260, 'Borhan Sddin', 'বোরহান উদ্দিন', 'borhanuddin.bhola.gov.bd', 1, 34, NULL, NULL, NULL),
(261, 'Charfesson', 'চরফ্যাশন', 'charfesson.bhola.gov.bd', 1, 34, NULL, NULL, NULL),
(262, 'Doulatkhan', 'দৌলতখান', 'doulatkhan.bhola.gov.bd', 1, 34, NULL, NULL, NULL),
(263, 'Monpura', 'মনপুরা', 'monpura.bhola.gov.bd', 1, 34, NULL, NULL, NULL),
(264, 'Tazumuddin', 'তজুমদ্দিন', 'tazumuddin.bhola.gov.bd', 1, 34, NULL, NULL, NULL),
(265, 'Lalmohan', 'লালমোহন', 'lalmohan.bhola.gov.bd', 1, 34, NULL, NULL, NULL),
(266, 'Amtali', 'আমতলী', 'amtali.barguna.gov.bd', 1, 35, NULL, NULL, NULL),
(267, 'Barguna Sadar', 'বরগুনা সদর', 'sadar.barguna.gov.bd', 1, 35, NULL, NULL, NULL),
(268, 'Betagi', 'বেতাগী', 'betagi.barguna.gov.bd', 1, 35, NULL, NULL, NULL),
(269, 'Bamna', 'বামনা', 'bamna.barguna.gov.bd', 1, 35, NULL, NULL, NULL),
(270, 'Pathorghata', 'পাথরঘাটা', 'pathorghata.barguna.gov.bd', 1, 35, NULL, NULL, NULL),
(271, 'Taltali', 'তালতলি', 'taltali.barguna.gov.bd', 1, 35, NULL, NULL, NULL),
(272, 'Balaganj', 'বালাগঞ্জ', 'balaganj.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(273, 'Beanibazar', 'বিয়ানীবাজার', 'beanibazar.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(274, 'Bishwanath', 'বিশ্বনাথ', 'bishwanath.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(275, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(276, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 'fenchuganj.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(277, 'Golapganj', 'গোলাপগঞ্জ', 'golapganj.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(278, 'Gowainghat', 'গোয়াইনঘাট', 'gowainghat.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(279, 'Jaintiapur', 'জৈন্তাপুর', 'jaintiapur.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(280, 'Kanaighat', 'কানাইঘাট', 'kanaighat.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(281, 'Sylhet Sadar', 'সিলেট সদর', 'sylhetsadar.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(282, 'Zakiganj', 'জকিগঞ্জ', 'zakiganj.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(283, 'Dakshinsurma', 'দক্ষিণ সুরমা', 'dakshinsurma.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(284, 'Osmaninagar', 'ওসমানী নগর', 'osmaninagar.sylhet.gov.bd', 1, 36, NULL, NULL, NULL),
(285, 'Barlekha', 'বড়লেখা', 'barlekha.moulvibazar.gov.bd', 1, 37, NULL, NULL, NULL),
(286, 'Kamolganj', 'কমলগঞ্জ', 'kamolganj.moulvibazar.gov.bd', 1, 37, NULL, NULL, NULL),
(287, 'Kulaura', 'কুলাউড়া', 'kulaura.moulvibazar.gov.bd', 1, 37, NULL, NULL, NULL),
(288, 'Moulvibazar Sadar', 'মৌলভীবাজার সদর', 'moulvibazarsadar.moulvibazar.gov.bd', 1, 37, NULL, NULL, NULL),
(289, 'Rajnagar', 'রাজনগর', 'rajnagar.moulvibazar.gov.bd', 1, 37, NULL, NULL, NULL),
(290, 'Sreemangal', 'শ্রীমঙ্গল', 'sreemangal.moulvibazar.gov.bd', 1, 37, NULL, NULL, NULL),
(291, 'Juri', 'জুড়ী', 'juri.moulvibazar.gov.bd', 1, 37, NULL, NULL, NULL),
(292, 'Nabiganj', 'নবীগঞ্জ', 'nabiganj.habiganj.gov.bd', 1, 38, NULL, NULL, NULL),
(293, 'Bahubal', 'বাহুবল', 'bahubal.habiganj.gov.bd', 1, 38, NULL, NULL, NULL),
(294, 'Ajmiriganj', 'আজমিরীগঞ্জ', 'ajmiriganj.habiganj.gov.bd', 1, 38, NULL, NULL, NULL),
(295, 'Baniachong', 'বানিয়াচং', 'baniachong.habiganj.gov.bd', 1, 38, NULL, NULL, NULL),
(296, 'Lakhai', 'লাখাই', 'lakhai.habiganj.gov.bd', 1, 38, NULL, NULL, NULL),
(297, 'Chunarughat', 'চুনারুঘাট', 'chunarughat.habiganj.gov.bd', 1, 38, NULL, NULL, NULL),
(298, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 'habiganjsadar.habiganj.gov.bd', 1, 38, NULL, NULL, NULL),
(299, 'Madhabpur', 'মাধবপুর', 'madhabpur.habiganj.gov.bd', 1, 38, NULL, NULL, NULL),
(300, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 'sadar.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(301, 'South Sunamganj', 'দক্ষিণ সুনামগঞ্জ', 'southsunamganj.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(302, 'Bishwambarpur', 'বিশ্বম্ভরপুর', 'bishwambarpur.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(303, 'Chhatak', 'ছাতক', 'chhatak.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(304, 'Jagannathpur', 'জগন্নাথপুর', 'jagannathpur.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(305, 'Dowarabazar', 'দোয়ারাবাজার', 'dowarabazar.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(306, 'Tahirpur', 'তাহিরপুর', 'tahirpur.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(307, 'Dharmapasha', 'ধর্মপাশা', 'dharmapasha.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(308, 'Jamalganj', 'জামালগঞ্জ', 'jamalganj.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(309, 'Shalla', 'শাল্লা', 'shalla.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(310, 'Derai', 'দিরাই', 'derai.sunamganj.gov.bd', 1, 39, NULL, NULL, NULL),
(311, 'Belabo', 'বেলাবো', 'belabo.narsingdi.gov.bd', 1, 40, NULL, NULL, NULL),
(312, 'Monohardi', 'মনোহরদী', 'monohardi.narsingdi.gov.bd', 1, 40, NULL, NULL, NULL),
(313, 'Narsingdi Sadar', 'নরসিংদী সদর', 'narsingdisadar.narsingdi.gov.bd', 1, 40, NULL, NULL, NULL),
(314, 'Palash', 'পলাশ', 'palash.narsingdi.gov.bd', 1, 40, NULL, NULL, NULL),
(315, 'Raipura', 'রায়পুরা', 'raipura.narsingdi.gov.bd', 1, 40, NULL, NULL, NULL),
(316, 'Shibpur', 'শিবপুর', 'shibpur.narsingdi.gov.bd', 1, 40, NULL, NULL, NULL),
(317, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.gazipur.gov.bd', 1, 41, NULL, NULL, NULL),
(318, 'Kaliakair', 'কালিয়াকৈর', 'kaliakair.gazipur.gov.bd', 1, 41, NULL, NULL, NULL),
(319, 'Kapasia', 'কাপাসিয়া', 'kapasia.gazipur.gov.bd', 1, 41, NULL, NULL, NULL),
(320, 'Gazipur Sadar', 'গাজীপুর সদর', 'sadar.gazipur.gov.bd', 1, 41, NULL, NULL, NULL),
(321, 'Sreepur', 'শ্রীপুর', 'sreepur.gazipur.gov.bd', 1, 41, NULL, NULL, NULL),
(322, 'Shariatpur Sadar', 'শরিয়তপুর সদর', 'sadar.shariatpur.gov.bd', 1, 42, NULL, NULL, NULL),
(323, 'Naria', 'নড়িয়া', 'naria.shariatpur.gov.bd', 1, 42, NULL, NULL, NULL),
(324, 'Zajira', 'জাজিরা', 'zajira.shariatpur.gov.bd', 1, 42, NULL, NULL, NULL),
(325, 'Gosairhat', 'গোসাইরহাট', 'gosairhat.shariatpur.gov.bd', 1, 42, NULL, NULL, NULL),
(326, 'Bhedarganj', 'ভেদরগঞ্জ', 'bhedarganj.shariatpur.gov.bd', 1, 42, NULL, NULL, NULL),
(327, 'Damudya', 'ডামুড্যা', 'damudya.shariatpur.gov.bd', 1, 42, NULL, NULL, NULL),
(328, 'Araihazar', 'আড়াইহাজার', 'araihazar.narayanganj.gov.bd', 1, 43, NULL, NULL, NULL),
(329, 'Bandar', 'বন্দর', 'bandar.narayanganj.gov.bd', 1, 43, NULL, NULL, NULL),
(330, 'Narayanganj Sadar', 'নারায়নগঞ্জ সদর', 'narayanganjsadar.narayanganj.gov.bd', 1, 43, NULL, NULL, NULL),
(331, 'Rupganj', 'রূপগঞ্জ', 'rupganj.narayanganj.gov.bd', 1, 43, NULL, NULL, NULL),
(332, 'Sonargaon', 'সোনারগাঁ', 'sonargaon.narayanganj.gov.bd', 1, 43, NULL, NULL, NULL),
(333, 'Basail', 'বাসাইল', 'basail.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(334, 'Bhuapur', 'ভুয়াপুর', 'bhuapur.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(335, 'Delduar', 'দেলদুয়ার', 'delduar.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(336, 'Ghatail', 'ঘাটাইল', 'ghatail.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(337, 'Gopalpur', 'গোপালপুর', 'gopalpur.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(338, 'Madhupur', 'মধুপুর', 'madhupur.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(339, 'Mirzapur', 'মির্জাপুর', 'mirzapur.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(340, 'Nagarpur', 'নাগরপুর', 'nagarpur.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(341, 'Sakhipur', 'সখিপুর', 'sakhipur.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(342, 'Tangail Sadar', 'টাঙ্গাইল সদর', 'tangailsadar.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(343, 'Kalihati', 'কালিহাতী', 'kalihati.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(344, 'Dhanbari', 'ধনবাড়ী', 'dhanbari.tangail.gov.bd', 1, 44, NULL, NULL, NULL),
(345, 'Itna', 'ইটনা', 'itna.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(346, 'Katiadi', 'কটিয়াদী', 'katiadi.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(347, 'Bhairab', 'ভৈরব', 'bhairab.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(348, 'Tarail', 'তাড়াইল', 'tarail.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(349, 'Hossainpur', 'হোসেনপুর', 'hossainpur.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(350, 'Pakundia', 'পাকুন্দিয়া', 'pakundia.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(351, 'Kuliarchar', 'কুলিয়ারচর', 'kuliarchar.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(352, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর', 'kishoreganjsadar.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(353, 'Karimgonj', 'করিমগঞ্জ', 'karimgonj.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(354, 'Bajitpur', 'বাজিতপুর', 'bajitpur.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(355, 'Austagram', 'অষ্টগ্রাম', 'austagram.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(356, 'Mithamoin', 'মিঠামইন', 'mithamoin.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(357, 'Nikli', 'নিকলী', 'nikli.kishoreganj.gov.bd', 1, 45, NULL, NULL, NULL),
(358, 'Harirampur', 'হরিরামপুর', 'harirampur.manikganj.gov.bd', 1, 46, NULL, NULL, NULL),
(359, 'Saturia', 'সাটুরিয়া', 'saturia.manikganj.gov.bd', 1, 46, NULL, NULL, NULL),
(360, 'Manikganj Sadar', 'মানিকগঞ্জ সদর', 'sadar.manikganj.gov.bd', 1, 46, NULL, NULL, NULL),
(361, 'Gior', 'ঘিওর', 'gior.manikganj.gov.bd', 1, 46, NULL, NULL, NULL),
(362, 'Shibaloy', 'শিবালয়', 'shibaloy.manikganj.gov.bd', 1, 46, NULL, NULL, NULL),
(363, 'Doulatpur', 'দৌলতপুর', 'doulatpur.manikganj.gov.bd', 1, 46, NULL, NULL, NULL),
(364, 'Singiar', 'সিংগাইর', 'singiar.manikganj.gov.bd', 1, 46, NULL, NULL, NULL),
(365, 'Savar', 'সাভার', 'savar.dhaka.gov.bd', 1, 47, NULL, NULL, NULL),
(366, 'Dhamrai', 'ধামরাই', 'dhamrai.dhaka.gov.bd', 1, 47, NULL, NULL, NULL),
(367, 'Keraniganj', 'কেরাণীগঞ্জ', 'keraniganj.dhaka.gov.bd', 1, 47, NULL, NULL, NULL),
(368, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dhaka.gov.bd', 1, 47, NULL, NULL, NULL),
(369, 'Dohar', 'দোহার', 'dohar.dhaka.gov.bd', 1, 47, NULL, NULL, NULL),
(370, 'Munshiganj Sadar', 'মুন্সিগঞ্জ সদর', 'sadar.munshiganj.gov.bd', 1, 48, NULL, NULL, NULL),
(371, 'Sreenagar', 'শ্রীনগর', 'sreenagar.munshiganj.gov.bd', 1, 48, NULL, NULL, NULL),
(372, 'Sirajdikhan', 'সিরাজদিখান', 'sirajdikhan.munshiganj.gov.bd', 1, 48, NULL, NULL, NULL),
(373, 'Louhajanj', 'লৌহজং', 'louhajanj.munshiganj.gov.bd', 1, 48, NULL, NULL, NULL),
(374, 'Gajaria', 'গজারিয়া', 'gajaria.munshiganj.gov.bd', 1, 48, NULL, NULL, NULL),
(375, 'Tongibari', 'টংগীবাড়ি', 'tongibari.munshiganj.gov.bd', 1, 48, NULL, NULL, NULL),
(376, 'Rajbari Sadar', 'রাজবাড়ী সদর', 'sadar.rajbari.gov.bd', 1, 49, NULL, NULL, NULL),
(377, 'Goalanda', 'গোয়ালন্দ', 'goalanda.rajbari.gov.bd', 1, 49, NULL, NULL, NULL),
(378, 'Pangsa', 'পাংশা', 'pangsa.rajbari.gov.bd', 1, 49, NULL, NULL, NULL),
(379, 'Baliakandi', 'বালিয়াকান্দি', 'baliakandi.rajbari.gov.bd', 1, 49, NULL, NULL, NULL),
(380, 'Kalukhali', 'কালুখালী', 'kalukhali.rajbari.gov.bd', 1, 49, NULL, NULL, NULL),
(381, 'Madaripur Sadar', 'মাদারীপুর সদর', 'sadar.madaripur.gov.bd', 1, 50, NULL, NULL, NULL),
(382, 'Shibchar', 'শিবচর', 'shibchar.madaripur.gov.bd', 1, 50, NULL, NULL, NULL),
(383, 'Kalkini', 'কালকিনি', 'kalkini.madaripur.gov.bd', 1, 50, NULL, NULL, NULL),
(384, 'Rajoir', 'রাজৈর', 'rajoir.madaripur.gov.bd', 1, 50, NULL, NULL, NULL),
(385, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর', 'sadar.gopalganj.gov.bd', 1, 51, NULL, NULL, NULL),
(386, 'Kashiani', 'কাশিয়ানী', 'kashiani.gopalganj.gov.bd', 1, 51, NULL, NULL, NULL),
(387, 'Tungipara', 'টুংগীপাড়া', 'tungipara.gopalganj.gov.bd', 1, 51, NULL, NULL, NULL),
(388, 'Kotalipara', 'কোটালীপাড়া', 'kotalipara.gopalganj.gov.bd', 1, 51, NULL, NULL, NULL),
(389, 'Muksudpur', 'মুকসুদপুর', 'muksudpur.gopalganj.gov.bd', 1, 51, NULL, NULL, NULL),
(390, 'Faridpur Sadar', 'ফরিদপুর সদর', 'sadar.faridpur.gov.bd', 1, 52, NULL, NULL, NULL),
(391, 'Alfadanga', 'আলফাডাঙ্গা', 'alfadanga.faridpur.gov.bd', 1, 52, NULL, NULL, NULL),
(392, 'Boalmari', 'বোয়ালমারী', 'boalmari.faridpur.gov.bd', 1, 52, NULL, NULL, NULL),
(393, 'Sadarpur', 'সদরপুর', 'sadarpur.faridpur.gov.bd', 1, 52, NULL, NULL, NULL),
(394, 'Nagarkanda', 'নগরকান্দা', 'nagarkanda.faridpur.gov.bd', 1, 52, NULL, NULL, NULL),
(395, 'Bhanga', 'ভাঙ্গা', 'bhanga.faridpur.gov.bd', 1, 52, NULL, NULL, NULL),
(396, 'Charbhadrasan', 'চরভদ্রাসন', 'charbhadrasan.faridpur.gov.bd', 1, 52, NULL, NULL, NULL),
(397, 'Madhukhali', 'মধুখালী', 'madhukhali.faridpur.gov.bd', 1, 52, NULL, NULL, NULL),
(398, 'Saltha', 'সালথা', 'saltha.faridpur.gov.bd', 1, 52, NULL, NULL, NULL),
(399, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 'panchagarhsadar.panchagarh.gov.bd', 1, 53, NULL, NULL, NULL),
(400, 'Debiganj', 'দেবীগঞ্জ', 'debiganj.panchagarh.gov.bd', 1, 53, NULL, NULL, NULL),
(401, 'Boda', 'বোদা', 'boda.panchagarh.gov.bd', 1, 53, NULL, NULL, NULL),
(402, 'Atwari', 'আটোয়ারী', 'atwari.panchagarh.gov.bd', 1, 53, NULL, NULL, NULL),
(403, 'Tetulia', 'তেতুলিয়া', 'tetulia.panchagarh.gov.bd', 1, 53, NULL, NULL, NULL),
(404, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(405, 'Birganj', 'বীরগঞ্জ', 'birganj.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(406, 'Ghoraghat', 'ঘোড়াঘাট', 'ghoraghat.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(407, 'Birampur', 'বিরামপুর', 'birampur.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(408, 'Parbatipur', 'পার্বতীপুর', 'parbatipur.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(409, 'Bochaganj', 'বোচাগঞ্জ', 'bochaganj.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(410, 'Kaharol', 'কাহারোল', 'kaharol.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(411, 'Fulbari', 'ফুলবাড়ী', 'fulbari.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(412, 'Dinajpur Sadar', 'দিনাজপুর সদর', 'dinajpursadar.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(413, 'Hakimpur', 'হাকিমপুর', 'hakimpur.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(414, 'Khansama', 'খানসামা', 'khansama.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(415, 'Birol', 'বিরল', 'birol.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(416, 'Chirirbandar', 'চিরিরবন্দর', 'chirirbandar.dinajpur.gov.bd', 1, 54, NULL, NULL, NULL),
(417, 'Lalmonirhat Sadar', 'লালমনিরহাট সদর', 'sadar.lalmonirhat.gov.bd', 1, 55, NULL, NULL, NULL),
(418, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.lalmonirhat.gov.bd', 1, 55, NULL, NULL, NULL),
(419, 'Hatibandha', 'হাতীবান্ধা', 'hatibandha.lalmonirhat.gov.bd', 1, 55, NULL, NULL, NULL),
(420, 'Patgram', 'পাটগ্রাম', 'patgram.lalmonirhat.gov.bd', 1, 55, NULL, NULL, NULL),
(421, 'Aditmari', 'আদিতমারী', 'aditmari.lalmonirhat.gov.bd', 1, 55, NULL, NULL, NULL),
(422, 'Syedpur', 'সৈয়দপুর', 'syedpur.nilphamari.gov.bd', 1, 56, NULL, NULL, NULL),
(423, 'Domar', 'ডোমার', 'domar.nilphamari.gov.bd', 1, 56, NULL, NULL, NULL),
(424, 'Dimla', 'ডিমলা', 'dimla.nilphamari.gov.bd', 1, 56, NULL, NULL, NULL),
(425, 'Jaldhaka', 'জলঢাকা', 'jaldhaka.nilphamari.gov.bd', 1, 56, NULL, NULL, NULL),
(426, 'Kishorganj', 'কিশোরগঞ্জ', 'kishorganj.nilphamari.gov.bd', 1, 56, NULL, NULL, NULL),
(427, 'Nilphamari Sadar', 'নীলফামারী সদর', 'nilphamarisadar.nilphamari.gov.bd', 1, 56, NULL, NULL, NULL),
(428, 'Sadullapur', 'সাদুল্লাপুর', 'sadullapur.gaibandha.gov.bd', 1, 57, NULL, NULL, NULL),
(429, 'Gaibandha Sadar', 'গাইবান্ধা সদর', 'gaibandhasadar.gaibandha.gov.bd', 1, 57, NULL, NULL, NULL),
(430, 'Palashbari', 'পলাশবাড়ী', 'palashbari.gaibandha.gov.bd', 1, 57, NULL, NULL, NULL),
(431, 'Saghata', 'সাঘাটা', 'saghata.gaibandha.gov.bd', 1, 57, NULL, NULL, NULL),
(432, 'Gobindaganj', 'গোবিন্দগঞ্জ', 'gobindaganj.gaibandha.gov.bd', 1, 57, NULL, NULL, NULL),
(433, 'Sundarganj', 'সুন্দরগঞ্জ', 'sundarganj.gaibandha.gov.bd', 1, 57, NULL, NULL, NULL),
(434, 'Phulchari', 'ফুলছড়ি', 'phulchari.gaibandha.gov.bd', 1, 57, NULL, NULL, NULL),
(435, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর', 'thakurgaonsadar.thakurgaon.gov.bd', 1, 58, NULL, NULL, NULL),
(436, 'Pirganj', 'পীরগঞ্জ', 'pirganj.thakurgaon.gov.bd', 1, 58, NULL, NULL, NULL),
(437, 'Ranisankail', 'রাণীশংকৈল', 'ranisankail.thakurgaon.gov.bd', 1, 58, NULL, NULL, NULL),
(438, 'Haripur', 'হরিপুর', 'haripur.thakurgaon.gov.bd', 1, 58, NULL, NULL, NULL),
(439, 'Baliadangi', 'বালিয়াডাঙ্গী', 'baliadangi.thakurgaon.gov.bd', 1, 58, NULL, NULL, NULL),
(440, 'Rangpur Sadar', 'রংপুর সদর', 'rangpursadar.rangpur.gov.bd', 1, 59, NULL, NULL, NULL),
(441, 'Gangachara', 'গংগাচড়া', 'gangachara.rangpur.gov.bd', 1, 59, NULL, NULL, NULL),
(442, 'Taragonj', 'তারাগঞ্জ', 'taragonj.rangpur.gov.bd', 1, 59, NULL, NULL, NULL),
(443, 'Badargonj', 'বদরগঞ্জ', 'badargonj.rangpur.gov.bd', 1, 59, NULL, NULL, NULL),
(444, 'Mithapukur', 'মিঠাপুকুর', 'mithapukur.rangpur.gov.bd', 1, 59, NULL, NULL, NULL),
(445, 'Pirgonj', 'পীরগঞ্জ', 'pirgonj.rangpur.gov.bd', 1, 59, NULL, NULL, NULL),
(446, 'Kaunia', 'কাউনিয়া', 'kaunia.rangpur.gov.bd', 1, 59, NULL, NULL, NULL),
(447, 'Pirgacha', 'পীরগাছা', 'pirgacha.rangpur.gov.bd', 1, 59, NULL, NULL, NULL),
(448, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 'kurigramsadar.kurigram.gov.bd', 1, 60, NULL, NULL, NULL),
(449, 'Nageshwari', 'নাগেশ্বরী', 'nageshwari.kurigram.gov.bd', 1, 60, NULL, NULL, NULL),
(450, 'Bhurungamari', 'ভুরুঙ্গামারী', 'bhurungamari.kurigram.gov.bd', 1, 60, NULL, NULL, NULL),
(451, 'Phulbari', 'ফুলবাড়ী', 'phulbari.kurigram.gov.bd', 1, 60, NULL, NULL, NULL),
(452, 'Rajarhat', 'রাজারহাট', 'rajarhat.kurigram.gov.bd', 1, 60, NULL, NULL, NULL),
(453, 'Ulipur', 'উলিপুর', 'ulipur.kurigram.gov.bd', 1, 60, NULL, NULL, NULL),
(454, 'Chilmari', 'চিলমারী', 'chilmari.kurigram.gov.bd', 1, 60, NULL, NULL, NULL),
(455, 'Rowmari', 'রৌমারী', 'rowmari.kurigram.gov.bd', 1, 60, NULL, NULL, NULL),
(456, 'Charrajibpur', 'চর রাজিবপুর', 'charrajibpur.kurigram.gov.bd', 1, 60, NULL, NULL, NULL),
(457, 'Sherpur Sadar', 'শেরপুর সদর', 'sherpursadar.sherpur.gov.bd', 1, 61, NULL, NULL, NULL),
(458, 'Nalitabari', 'নালিতাবাড়ী', 'nalitabari.sherpur.gov.bd', 1, 61, NULL, NULL, NULL),
(459, 'Sreebordi', 'শ্রীবরদী', 'sreebordi.sherpur.gov.bd', 1, 61, NULL, NULL, NULL),
(460, 'Nokla', 'নকলা', 'nokla.sherpur.gov.bd', 1, 61, NULL, NULL, NULL),
(461, 'Jhenaigati', 'ঝিনাইগাতী', 'jhenaigati.sherpur.gov.bd', 1, 61, NULL, NULL, NULL),
(462, 'Fulbaria', 'ফুলবাড়ীয়া', 'fulbaria.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(463, 'Trishal', 'ত্রিশাল', 'trishal.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(464, 'Bhaluka', 'ভালুকা', 'bhaluka.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(465, 'Muktagacha', 'মুক্তাগাছা', 'muktagacha.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(466, 'Mymensingh Sadar', 'ময়মনসিংহ সদর', 'mymensinghsadar.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(467, 'Dhobaura', 'ধোবাউড়া', 'dhobaura.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(468, 'Phulpur', 'ফুলপুর', 'phulpur.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(469, 'Haluaghat', 'হালুয়াঘাট', 'haluaghat.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(470, 'Gouripur', 'গৌরীপুর', 'gouripur.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(471, 'Gafargaon', 'গফরগাঁও', 'gafargaon.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(472, 'Iswarganj', 'ঈশ্বরগঞ্জ', 'iswarganj.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(473, 'Nandail', 'নান্দাইল', 'nandail.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(474, 'Tarakanda', 'তারাকান্দা', 'tarakanda.mymensingh.gov.bd', 1, 62, NULL, NULL, NULL),
(475, 'Jamalpur Sadar', 'জামালপুর সদর', 'jamalpursadar.jamalpur.gov.bd', 1, 63, NULL, NULL, NULL),
(476, 'Melandah', 'মেলান্দহ', 'melandah.jamalpur.gov.bd', 1, 63, NULL, NULL, NULL),
(477, 'Islampur', 'ইসলামপুর', 'islampur.jamalpur.gov.bd', 1, 63, NULL, NULL, NULL),
(478, 'Dewangonj', 'দেওয়ানগঞ্জ', 'dewangonj.jamalpur.gov.bd', 1, 63, NULL, NULL, NULL),
(479, 'Sarishabari', 'সরিষাবাড়ী', 'sarishabari.jamalpur.gov.bd', 1, 63, NULL, NULL, NULL),
(480, 'Madarganj', 'মাদারগঞ্জ', 'madarganj.jamalpur.gov.bd', 1, 63, NULL, NULL, NULL),
(481, 'Bokshiganj', 'বকশীগঞ্জ', 'bokshiganj.jamalpur.gov.bd', 1, 63, NULL, NULL, NULL),
(482, 'Barhatta', 'বারহাট্টা', 'barhatta.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(483, 'Durgapur', 'দুর্গাপুর', 'durgapur.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(484, 'Kendua', 'কেন্দুয়া', 'kendua.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(485, 'Atpara', 'আটপাড়া', 'atpara.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(486, 'Madan', 'মদন', 'madan.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(487, 'Khaliajuri', 'খালিয়াজুরী', 'khaliajuri.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(488, 'Kalmakanda', 'কলমাকান্দা', 'kalmakanda.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(489, 'Mohongonj', 'মোহনগঞ্জ', 'mohongonj.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(490, 'Purbadhala', 'পূর্বধলা', 'purbadhala.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(491, 'Netrokona Sadar', 'নেত্রকোণা সদর', 'netrokonasadar.netrokona.gov.bd', 1, 64, NULL, NULL, NULL),
(492, 'Adabar Thana', 'আদাবর থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(493, 'Azampur Thana', 'আজমপুর থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(494, 'Badda Thana', 'বাড্ডা থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(495, 'Bangsal Thana', 'বংশাল থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(496, 'Bimanbandar Thana (Dhaka]', 'বিমানবন্দর থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(497, 'Cantonment Thana', 'ক্যান্টনমেন্ট থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(498, 'Chowkbazar Thana', 'চকবাজার থানা ', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(499, 'Darus Salam Thana', 'দারুস সালাম থানা ', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(500, 'Demra Thana', 'ডেমরা থানা ', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(501, 'Dhanmondi Thana', 'ধানমন্ডি থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(502, 'Gendaria Thana', 'গেন্ডারিয়া থানা ', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(503, 'Hazaribagh Thana', 'হাজারিবাঘ থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(504, 'Kadamtali Thana', 'কদমতলি থানা ', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(505, 'Kafrul Thana', 'কাফরুল থানা ', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(506, 'Kalabagan Thana', 'কলাবাগান থানা ', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(507, 'Kamrangirchar Thana', 'কামরাংগিচর থানা ', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(508, 'Khilgaon Thana', 'খিলগাঁ থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(509, 'Khilkhet Thana', 'খিলখেত থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(510, 'Kotwali Thana (Dhaka]', 'কতোয়াখালি থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(511, 'Lalbagh Thana', 'লালবাঘ থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(512, 'Mirpur Model Thana', 'মিরপুর থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(513, 'Mohammadpur Thana', 'মুহাম্মাদপুর থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(514, 'Motijheel Thana', 'মতিঝিল থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(515, 'New Market Thana', 'নিউ মার্কেট থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(516, 'Pallabi Thana', 'পল্লবি থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(517, 'Paltan Thana', 'পল্টন থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(518, 'Panthapath Thana', 'পান্থপথ থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(519, 'Ramna Thana', 'রমনা থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(520, 'Rampura Thana', 'রামপুরা থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(521, 'Sabujbagh Thana', 'সবুজবাঘ থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(522, 'Shah Ali Thana', 'সাহ্‌ আলী থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(523, 'Shahbag Thana', 'শাহ্‌বাগ থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(524, 'Sher-e-Bangla Nagar', 'শেরে-ই-বাংলা নগর থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(525, 'Shyampur Thana', 'শ্যামপুর থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(526, 'Sutrapur Thana', 'সুত্রাপুর থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(527, 'Tejgaon Industrial Area Thana', 'তেজগাঁও ইন্ডাস্ট্রিয়াল থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(528, 'Tejgaon Thana', 'তেজগাঁও থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(529, 'Turag Thana', 'তুরাগ থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(530, 'Uttar Khan Thana', 'উত্তর খান থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(531, 'Uttara West Thana', 'উত্তরা পশ্চিম থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(532, 'Vatara Thana', 'ভাটারা থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(533, 'Wari Thana', 'ওয়ারি থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(534, 'Uttara East Thana', 'উত্তরা পূর্ব থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(535, 'Dakshinkhan Thana', 'দক্ষিনখান থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(536, 'Akbarshah Thana', 'আকবরশাহ থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(537, 'Bakoliya Thana', 'বাকোলিয়া থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(538, 'Bandar Thana', 'বন্দর থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(539, 'Bayazid Thana', 'বায়জিদ থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(540, 'Bhujpur Thana', 'ভুজপুর থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(541, 'Chandgaon Thana', 'চন্দগন থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(542, 'Chaowkbazar Thana', 'চকবাজার থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(543, 'Chittagong Kotwali Thana', 'চিটাগাং থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(544, 'Double Mooring Thana', 'ডাবল মর্নিং থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(545, 'EPZ Thana Thana', 'ইপিজেড থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(546, 'Halishahar Thana', 'হালিশাহার থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(547, 'Karnaphuli Thana', 'কর্ণফুলি থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(548, 'Khulshi Thana', 'খুলসি থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(549, 'Kotwali Thana (Chittagong]', 'কতোয়াখালি থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(550, 'Pahartali Thana', 'পাহারতলি থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(551, 'Panchlaish Thana', 'পাঞ্চলাইস থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(552, 'Patenga Thana', 'পতেংগা থানা', 'debidwar.comilla.gov.bd', 1, 66, NULL, NULL, NULL),
(553, 'Gulshan Thana', 'গুলশান থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(554, 'Banani Thana', 'বনানী থানা', 'debidwar.comilla.gov.bd', 1, 65, NULL, NULL, NULL),
(555, 'Sadar Thana', 'সদর/জয়দেবপুর থানা', 'debidwar.comilla.gov.bd', 1, 72, NULL, NULL, NULL),
(556, 'Bason Thana', 'বাসন থানা', 'debidwar.comilla.gov.bd', 1, 72, NULL, NULL, NULL),
(557, 'Konabari Thana', 'কোনাবাড়ী থানা', 'debidwar.comilla.gov.bd', 1, 72, NULL, NULL, NULL),
(558, 'Kashimpur Thana', 'কাশিমপুর থানা', 'debidwar.comilla.gov.bd', 1, 72, NULL, NULL, NULL),
(559, 'Gacha Thana', 'গাছা থানা', 'debidwar.comilla.gov.bd', 1, 72, NULL, NULL, NULL),
(560, 'Pubail Thana', 'পূবাইল থানা', 'debidwar.comilla.gov.bd', 1, 72, NULL, NULL, NULL),
(561, 'Tongi West Thana', 'টঙ্গী পশ্চিম থানা', 'debidwar.comilla.gov.bd', 1, 72, NULL, NULL, NULL),
(562, 'Tongi East Thana', 'টঙ্গী পূর্ব থানা', 'debidwar.comilla.gov.bd', 1, 72, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trade_licenses`
--

CREATE TABLE `trade_licenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `invoice_no` varchar(191) DEFAULT NULL,
  `payment_status` enum('unpaid','paid','pending','failed') NOT NULL DEFAULT 'unpaid',
  `payment_type` enum('manual','online') DEFAULT NULL,
  `payment_details` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_note` text DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `institute_id` bigint(20) DEFAULT NULL,
  `tax_year_id` bigint(20) NOT NULL,
  `organization_id` bigint(20) NOT NULL,
  `fees` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fees`)),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trade_licenses`
--

INSERT INTO `trade_licenses` (`id`, `system_id`, `invoice_no`, `payment_status`, `payment_type`, `payment_details`, `transaction_id`, `payment_note`, `paid_at`, `institute_id`, `tax_year_id`, `organization_id`, `fees`, `status`, `created_at`, `updated_at`) VALUES
(1, '20230402001', NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '{\"New Registration Charge\":\"10\",\"Yearly Charge\":\"10\",\"Renew Charge\":\"1\",\"Signboard Fees\":\"10\",\"Surcharge\":\"10\",\"Others\":\"10\",\"VAT\":\"10\",\"TAX\":\"10\",\"Fine\":\"10\"}', 2, '2023-04-02 14:09:19', '2023-04-02 14:30:03'),
(2, '20230404002', NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 'null', 1, '2023-04-03 18:03:40', '2023-04-03 18:03:40'),
(3, '20230404003', NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '{\"New Registration Charge\":\"30\",\"Yearly Charge\":\"30\",\"Renew Charge\":\"10\",\"Signboard Fees\":\"10\",\"Surcharge\":\"10\",\"Others\":\"10\",\"VAT\":\"10\",\"TAX\":\"10\",\"Fine\":\"10\"}', 1, '2023-04-03 18:24:21', '2023-04-03 18:24:21'),
(4, '20230406004', NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, 2, 2, 1, 'null', 2, '2023-04-06 01:06:06', '2023-04-07 00:24:10'),
(5, '20230411005', NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, 2, 2, 3, 'null', 2, '2023-04-11 01:17:09', '2023-04-11 01:20:50'),
(6, '20230513006', NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, 2, 2, 2, 'null', 2, '2023-05-13 07:52:19', '2026-03-03 19:05:49'),
(8, '20260410007', NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, 2, 5, 13, 'null', 2, '2026-04-10 04:28:48', '2026-04-10 04:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `trade_licenses_backup`
--

CREATE TABLE `trade_licenses_backup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `institute_id` bigint(20) DEFAULT NULL,
  `tax_year_id` bigint(20) NOT NULL,
  `organization_id` bigint(20) NOT NULL,
  `fees` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`fees`)),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trade_licenses_backup`
--

INSERT INTO `trade_licenses_backup` (`id`, `system_id`, `institute_id`, `tax_year_id`, `organization_id`, `fees`, `status`, `created_at`, `updated_at`) VALUES
(1, '20230402001', 1, 1, 1, '{\"New Registration Charge\":\"10\",\"Yearly Charge\":\"10\",\"Renew Charge\":\"1\",\"Signboard Fees\":\"10\",\"Surcharge\":\"10\",\"Others\":\"10\",\"VAT\":\"10\",\"TAX\":\"10\",\"Fine\":\"10\"}', 2, '2023-04-02 14:09:19', '2023-04-02 14:30:03'),
(2, '20230404002', 1, 1, 1, 'null', 1, '2023-04-03 18:03:40', '2023-04-03 18:03:40'),
(3, '20230404003', 1, 1, 1, '{\"New Registration Charge\":\"30\",\"Yearly Charge\":\"30\",\"Renew Charge\":\"10\",\"Signboard Fees\":\"10\",\"Surcharge\":\"10\",\"Others\":\"10\",\"VAT\":\"10\",\"TAX\":\"10\",\"Fine\":\"10\"}', 1, '2023-04-03 18:24:21', '2023-04-03 18:24:21'),
(4, '20230406004', 2, 2, 1, 'null', 2, '2023-04-06 01:06:06', '2023-04-07 00:24:10'),
(5, '20230411005', 2, 2, 3, 'null', 2, '2023-04-11 01:17:09', '2023-04-11 01:20:50'),
(6, '20230513006', 2, 2, 2, 'null', 2, '2023-05-13 07:52:19', '2026-03-03 19:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `trade_license_manual_payments`
--

CREATE TABLE `trade_license_manual_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trade_license_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `payment_details` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unions`
--

CREATE TABLE `unions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `thana_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unions`
--

INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(1, 'Subil', 'সুবিল', 'subilup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(2, 'North Gunaighor', 'উত্তর গুনাইঘর', 'gunaighornorthup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(3, 'South Gunaighor', 'দক্ষিণ গুনাইঘর', 'gunaighorsouth.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(4, 'Boroshalghor', 'বড়শালঘর', 'boroshalghorup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(5, 'Rajameher', 'রাজামেহার', 'rajameherup.comila.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(6, 'Yousufpur', 'ইউসুফপুর', 'yousufpurup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(7, 'Rasulpur', 'রসুলপুর', 'rasulpurup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(8, 'Fatehabad', 'ফতেহাবাদ', 'fatehabadup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(9, 'Elahabad', 'এলাহাবাদ', 'elahabadup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(10, 'Jafargonj', 'জাফরগঞ্জ', 'jafargonjup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(11, 'Dhampti', 'ধামতী', 'dhamptiup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(12, 'Mohanpur', 'মোহনপুর', 'mohanpurup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(13, 'Vani', 'ভানী', 'vaniup.comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(14, 'Barkamta', 'বরকামতা', 'barkamtaup . comilla.gov.bd', 1, 1, NULL, NULL, NULL, NULL),
(15, 'Sultanpur', 'সুলতানপুর', 'sultanpurup . comilla.gov . bd', 1, 1, NULL, NULL, NULL, NULL),
(16, 'Aganagar', 'আগানগর', 'aganagarup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(17, 'Bhabanipur', 'ভবানীপুর', 'bhabanipurup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(18, 'North Khoshbas', 'উত্তর খোশবাস', 'khoshbasnorthup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(19, 'South Khoshbas', 'দক্ষিন খোশবাস', 'khoshbassouthup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(20, 'Jhalam', 'ঝলম', 'jhalamup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(21, 'Chitodda', 'চিতড্ডা', 'chitoddaup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(22, 'North Shilmuri', 'উত্তর শিলমুড়ি', 'shilmurinorthup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(23, 'South Shilmuri', 'দক্ষিন শিলমুড়ি', 'shilmurisouthup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(24, 'Galimpur', 'গালিমপুর', 'galimpurup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(25, 'Shakpur', 'শাকপুর', 'shakpurup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(26, 'Bhaukshar', 'ভাউকসার', 'bhauksharup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(27, 'Adda', 'আড্ডা', 'addaup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(28, 'Adra', 'আদ্রা', 'adraup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(29, 'Payalgacha', 'পয়ালগাছা', 'payalgachaup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(30, 'Laxmipur', 'লক্ষীপুর', 'laxmipurup . comilla . gov . bd', 1, 2, NULL, NULL, NULL, NULL),
(31, 'Shidli', 'শিদলাই', 'shidliup . comilla . gov . bd', 1, 3, NULL, NULL, NULL, NULL),
(32, 'Chandla', 'চান্দলা', 'chandlaup . comilla . gov . bd', 1, 3, NULL, NULL, NULL, NULL),
(33, 'Shashidal', 'শশীদল', 'shashidalup . comilla . gov . bd', 1, 3, NULL, NULL, NULL, NULL),
(34, 'Dulalpur', 'দুলালপুর', 'dulalpurup2 . comilla . gov . bd', 1, 3, NULL, NULL, NULL, NULL),
(35, 'Brahmanpara Sadar', 'ব্রাহ্মনপাড়া সদর', 'brahmanparasadarup . comilla . gov . bd', 1, 3, NULL, NULL, NULL, NULL),
(36, 'Shahebabad', 'সাহেবাবাদ', 'shahebabadup . comilla . gov . bd', 1, 3, NULL, NULL, NULL, NULL),
(37, 'Malapara', 'মালাপাড়া', 'malaparaup . comilla . gov . bd', 1, 3, NULL, NULL, NULL, NULL),
(38, 'Madhabpur', 'মাধবপুর', 'madhabpurup . comilla . gov . bd', 1, 3, NULL, NULL, NULL, NULL),
(39, 'Shuhilpur', 'সুহিলপুর', 'shuhilpurup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(40, 'Bataghashi', 'বাতাঘাসি', 'bataghashiup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(41, 'Joag', 'জোয়াগ', 'joagup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(42, 'Borcarai', 'বরকরই', 'borcaraiup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(43, 'Madhaiya', 'মাধাইয়া', 'madhaiyaup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(44, 'Dollai Nowabpur', 'দোল্লাই নবাবপুর', 'dollainowabpurup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(45, 'Mohichial', 'মহিচাইল', 'mohichialup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(46, 'Gollai', 'গল্লাই', 'gollaiup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(47, 'Keronkhal', 'কেরণখাল', 'keronkhalup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(48, 'Maijkhar', 'মাইজখার', 'maijkharup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(49, 'Etberpur', 'এতবারপুর', 'etberpurup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(50, 'Barera', 'বাড়েরা', 'bareraup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(51, 'Borcoit', 'বরকইট', 'borcoitup . comilla . gov . bd', 1, 4, NULL, NULL, NULL, NULL),
(52, 'Sreepur', 'শ্রীপুর', 'sreepurup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(53, 'Kashinagar', 'কাশিনগর', 'kashinagarup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(54, 'Kalikapur', 'কালিকাপুর', 'kalikapurup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(55, 'Shuvapur', 'শুভপুর', 'shuvapurup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(56, 'Ghulpasha', 'ঘোলপাশা', 'ghulpashaup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(57, 'Moonshirhat', 'মুন্সীরহাট', 'moonshirhatup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(58, 'Batisha', 'বাতিসা', 'batishaup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(59, 'Kankapait', 'কনকাপৈত', 'kankapaitup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(60, 'Cheora', 'চিওড়া', 'cheoraup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(61, 'Jagannatdighi', 'জগন্নাথদিঘী', 'jagannatdighiup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(62, 'Goonabati', 'গুনবতী', 'goonabatiup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(63, 'Alkara', 'আলকরা', 'alkaraup . comilla . gov . bd', 1, 5, NULL, NULL, NULL, NULL),
(64, 'Doulotpur', 'দৌলতপুর', 'doulotpurup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(65, 'Daudkandi', 'দাউদকান্দি', 'daudkandinorthup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(66, 'North Eliotgonj', 'উত্তর ইলিয়টগঞ্জ', 'eliotgonjnorthup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(67, 'South Eliotgonj', 'দক্ষিন ইলিয়টগঞ্জ', 'eliotgonjsouthup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(68, 'Zinglatoli', 'জিংলাতলী', 'zinglatoliup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(69, 'Sundolpur', 'সুন্দলপুর', 'sundolpurup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(70, 'Gouripur', 'গৌরীপুর', 'gouripurup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(71, 'East Mohammadpur', 'পুর্ব মোহাম্মদপুর', 'mohammadpureastup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(72, 'West Mohammadpur', 'পশ্চিম মোহাম্মদপুর', 'mohammadpurwestup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(73, 'Goalmari', 'গোয়ালমারী', 'goalmariup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(74, 'Maruka', 'মারুকা', 'marukaup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(75, 'Betessor', 'বিটেশ্বর', 'betessorup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(76, 'Podua', 'পদুয়া', 'poduaup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(77, 'West Passgacia', 'পশ্চিম পাচঁগাছিয়া', 'passgaciawestup . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(78, 'Baropara', 'বারপাড়া', 'baroparaup2 . comilla . gov . bd', 1, 6, NULL, NULL, NULL, NULL),
(79, 'Mathabanga', 'মাথাভাঙ্গা', 'mathabangaup . comilla . gov . bd', 1, 7, NULL, NULL, NULL, NULL),
(80, 'Gagutiea', 'ঘাগুটিয়া', 'gagutieaup . comilla . gov . bd', 1, 7, NULL, NULL, NULL, NULL),
(81, 'Asadpur', 'আছাদপুর', 'asadpurup . comilla . gov . bd', 1, 7, NULL, NULL, NULL, NULL),
(82, 'Chanderchor', 'চান্দেরচর', 'chanderchorup . comilla . gov . bd', 1, 7, NULL, NULL, NULL, NULL),
(83, 'Vashania', 'ভাষানিয়া', 'vashaniaup . comilla . gov . bd', 1, 7, NULL, NULL, NULL, NULL),
(84, 'Nilokhi', 'নিলখী', 'nilokhiup . comilla . gov . bd', 1, 7, NULL, NULL, NULL, NULL),
(85, 'Garmora', 'ঘারমোড়া', 'garmoraup . comilla . gov . bd', 1, 7, NULL, NULL, NULL, NULL),
(86, 'Joypur', 'জয়পুর', 'joypurup . comilla . gov . bd', 1, 7, NULL, NULL, NULL, NULL),
(87, 'Dulalpur', 'দুলালপুর', 'dulalpurup1 . comilla . gov . bd', 1, 7, NULL, NULL, NULL, NULL),
(88, 'Bakoi', 'বাকই', 'bakoiup . comilla . gov . bd', 1, 8, NULL, NULL, NULL, NULL),
(89, 'Mudafargonj', 'মুদাফফর গঞ্জ', 'mudafargonjup . comilla . gov . bd', 1, 8, NULL, NULL, NULL, NULL),
(90, 'Kandirpar', 'কান্দিরপাড়', 'kandirparup . comilla . gov . bd', 1, 8, NULL, NULL, NULL, NULL),
(91, 'Gobindapur', 'গোবিন্দপুর', 'gobindapurup . comilla . gov . bd', 1, 8, NULL, NULL, NULL, NULL),
(92, 'Uttarda', 'উত্তরদা', 'uttardaup . comilla . gov . bd', 1, 8, NULL, NULL, NULL, NULL),
(93, 'Laksam Purba', 'লাকসাম পুর্ব', 'laksampurbaup . comilla . gov . bd', 1, 8, NULL, NULL, NULL, NULL),
(94, 'Azgora', 'আজগরা', 'azgoraup . comilla . gov . bd', 1, 8, NULL, NULL, NULL, NULL),
(95, 'Sreekil', 'শ্রীকাইল', 'sreekilup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(96, 'Akubpur', 'আকুবপুর', 'akubpurup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(97, 'Andicot', 'আন্দিকোট', 'andicotup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(98, 'Purbadair(East]', 'পুর্বধৈইর(পুর্ব]', 'purbadaireastup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(99, 'Purbadair(West]', 'পুর্বধৈইর(পশ্চিম]', 'purbadairwestup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(100, 'Bangara(East]', 'বাঙ্গরা(পূর্ব]', 'bangaraeastup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(101, 'Bangara(West]', 'বাঙ্গরা(পশ্চিম]', 'bangarawestup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(102, 'Chapitala', 'চাপিতলা', 'chapitalaup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(103, 'Camalla', 'কামাল্লা', 'camallaup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(104, 'Jatrapur', 'যাত্রাপুর', 'jatrapurup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(105, 'Ramachandrapur(North]', 'রামচন্দ্রপুর(উত্তর]', 'ramachandrapurnorthup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(106, 'Ramachandrapur(South]', 'রামচন্দ্রপুর(দক্ষিন]', 'ramachandrapursouthup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(107, 'Muradnagar Sadar', 'মুরাদনগর সদর', 'muradnagarsadarup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(108, 'Nobipur(East]', 'নবীপুর(পুর্ব]', 'nobipureastup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(109, 'Nobipur(West]', 'নবীপুর(পশ্চিম]', 'nobipurwestup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(110, 'Damgar', 'ধামঘর', 'damgarup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(111, 'Jahapur', 'জাহাপুর', 'jahapurup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(112, 'Salikandi', 'ছালিয়াকান্দি', 'salikandiup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(113, 'Darura', 'দারোরা', 'daruraup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(114, 'Paharpur', 'পাহাড়পুর', 'paharpurup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(115, 'Babutipara', 'বাবুটিপাড়া', 'babutiparaup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(116, 'Tanki', 'টনকী', 'tankiup . comilla . gov . bd', 1, 9, NULL, NULL, NULL, NULL),
(117, 'Bangadda', 'বাঙ্গড্ডা', 'bangadda . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(118, 'Paria', 'পেরিয়া', 'pariaup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(119, 'Raykot', 'রায়কোট', 'raykotup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(120, 'Mokara', 'মোকরা', 'mokaraup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(121, 'Makrabpur', 'মক্রবপুর', 'makrabpurup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(122, 'Heshakhal', 'হেসাখাল', 'heshakhalup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(123, 'Adra', 'আদ্রা', 'adraup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(124, 'Judda', 'জোড্ডা', 'juddaup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(125, 'Dhalua', 'ঢালুয়া', 'dhaluaup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(126, 'Doulkha', 'দৌলখাঁড়', 'doulkhaup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(127, 'Boxgonj', 'বক্সগঞ্জ', 'boxgonjup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(128, 'Satbaria', 'সাতবাড়ীয়া', 'satbariaup . comilla . gov . bd', 1, 10, NULL, NULL, NULL, NULL),
(129, 'Kalirbazer', 'কালীর বাজার', 'kalirbazerup . comilla . gov . bd', 1, 11, NULL, NULL, NULL, NULL),
(130, 'North Durgapur', 'উত্তর দুর্গাপুর', 'durgapurnorthup . comilla . gov . bd', 1, 11, NULL, NULL, NULL, NULL),
(131, 'South Durgapur', 'দক্ষিন দুর্গাপুর', 'durgapursouthup . comilla . gov . bd', 1, 11, NULL, NULL, NULL, NULL),
(132, 'Amratoli', 'আমড়াতলী', 'amratoliup . comilla . gov . bd', 1, 11, NULL, NULL, NULL, NULL),
(133, 'Panchthubi', 'পাঁচথুবী', 'panchthubiup . comilla . gov . bd', 1, 11, NULL, NULL, NULL, NULL),
(134, 'Jagannatpur', 'জগন্নাথপুর', 'jagannatpurup . comilla . gov . bd', 1, 11, NULL, NULL, NULL, NULL),
(135, 'Chandanpur', 'চন্দনপুর', 'chandanpurup . comilla . gov . bd', 1, 12, NULL, NULL, NULL, NULL),
(136, 'Chalibanga', 'চালিভাঙ্গা', 'chalibangaup . comilla . gov . bd', 1, 12, NULL, NULL, NULL, NULL),
(137, 'Radanagar', 'রাধানগর', 'radanagarup . comilla . gov . bd', 1, 12, NULL, NULL, NULL, NULL),
(138, 'Manikarchar', 'মানিকারচর', 'manikarcharup . comilla . gov . bd', 1, 12, NULL, NULL, NULL, NULL),
(139, 'Barakanda', 'বড়কান্দা', 'barakandaup . comilla . gov . bd', 1, 12, NULL, NULL, NULL, NULL),
(140, 'Govindapur', 'গোবিন্দপুর', 'govindapurup1 . comilla . gov . bd', 1, 12, NULL, NULL, NULL, NULL),
(141, 'Luterchar', 'লুটেরচর', 'lutercharup . comilla . gov . bd', 1, 12, NULL, NULL, NULL, NULL),
(142, 'Vaorkhola', 'ভাওরখোলা', 'vaorkholaup . comilla . gov . bd', 1, 12, NULL, NULL, NULL, NULL),
(143, 'Baishgaon', 'বাইশগাঁও', 'baishgaonup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(144, 'Shoroshpur', 'সরসপুর', 'shoroshpurup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(145, 'Hasnabad', 'হাসনাবাদ', 'hasnabadup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(146, 'Jholam(North]', 'ঝলম(উত্তর]', 'jholamnorthup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(147, 'Jholam(South]', 'ঝলম(দক্ষিন]', 'jholamsouthup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(148, 'Moishatua', 'মৈশাতুয়া', 'moishatuaup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(149, 'Lokkhanpur', 'লক্ষনপুর', 'lokkhanpurup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(150, 'Khela', 'খিলা', 'khelaup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(151, 'Uttarhowla', 'উত্তর হাওলা', 'uttarhowlaup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(152, 'Natherpetua', 'নাথেরপেটুয়া', 'natherpetuaup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(153, 'Bipulashar', 'বিপুলাসার', 'bipulasharup . comilla . gov . bd', 1, 13, NULL, NULL, NULL, NULL),
(154, 'Chuwara', 'চৌয়ারা', 'chuwaraup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(155, 'Baropara', 'বারপাড়া', 'baroparaup1 . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(156, 'Jorkanoneast', 'জোড়কানন(পুর্ব]', 'jorkanoneastup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(157, 'Goliara', 'গলিয়ারা', 'goliaraup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(158, 'Jorkanonwest', 'জোড়কানন(পশ্চিম]', 'jorkanonwestup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(159, 'Bagmara(North]', 'বাগমারা(উত্তর]', 'bagmaranorthup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(160, 'Bagmara(South]', 'বাগমারা(দক্ষিন]', 'bagmarasouthup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(161, 'Bhuloin(North]', 'ভূলইন(উত্তর]', 'bhuloinnorthup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(162, 'Bhuloin(South]', 'ভূলইন(দক্ষিন]', 'bhuloinsouthup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(163, 'Belgor(North]', 'বেলঘর(উত্তর]', 'belgornorthup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(164, 'Belgor(South]', 'বেলঘর(দক্ষিন]', 'belgorsouthup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(165, 'Perul(North]', 'পেরুল(উত্তর]', 'perulnorthup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(166, 'Perul(South]', 'পেরুল(দক্ষিন]', 'perulsouthup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(167, 'Bijoypur', 'বিজয়পুর', 'bijoypurup . comilla . gov . bd', 1, 14, NULL, NULL, NULL, NULL),
(168, 'Satani', 'সাতানী', 'sataniup . comilla . gov . bd', 1, 15, NULL, NULL, NULL, NULL),
(169, 'Jagatpur', 'জগতপুর', 'jagatpurup . comilla . gov . bd', 1, 15, NULL, NULL, NULL, NULL),
(170, 'Balorampur', 'বলরামপুর', 'balorampurup . comilla . gov . bd', 1, 15, NULL, NULL, NULL, NULL),
(171, 'Karikandi', 'কড়িকান্দি', 'karikandiup . comilla . gov . bd', 1, 15, NULL, NULL, NULL, NULL),
(172, 'Kalakandi', 'কলাকান্দি', 'kalakandiup . comilla . gov . bd', 1, 15, NULL, NULL, NULL, NULL),
(173, 'Vitikandi', 'ভিটিকান্দি', 'vitikandiup . comilla . gov . bd', 1, 15, NULL, NULL, NULL, NULL),
(174, 'Narayandia', 'নারান্দিয়া', 'narayandiaup . comilla . gov . bd', 1, 15, NULL, NULL, NULL, NULL),
(175, 'Zearkandi', 'জিয়ারকান্দি', 'zearkandiup . comilla . gov . bd', 1, 15, NULL, NULL, NULL, NULL),
(176, 'Majidpur', 'মজিদপুর', 'majidpurup . comilla . gov . bd', 1, 15, NULL, NULL, NULL, NULL),
(177, 'Moynamoti', 'ময়নামতি', 'moynamotiup . comilla . gov . bd', 1, 16, NULL, NULL, NULL, NULL),
(178, 'Varella', 'ভারেল্লা', 'varellaup . comilla . gov . bd', 1, 16, NULL, NULL, NULL, NULL),
(179, 'Mokam', 'মোকাম', 'mokamup . comilla . gov . bd', 1, 16, NULL, NULL, NULL, NULL),
(180, 'Burichang Sadar', 'বুড়িচং সদর', 'burichangsadarup . comilla . gov . bd', 1, 16, NULL, NULL, NULL, NULL),
(181, 'Bakshimul', 'বাকশীমূল', 'bakshimulup . comilla . gov . bd', 1, 16, NULL, NULL, NULL, NULL),
(182, 'Pirjatrapur', 'পীরযাত্রাপুর', 'pirjatrapurup . comilla . gov . bd', 1, 16, NULL, NULL, NULL, NULL),
(183, 'Sholonal', 'ষোলনল', 'sholonalup . comilla . gov . bd', 1, 16, NULL, NULL, NULL, NULL),
(184, 'Rajapur', 'রাজাপুর', 'rajapurup . comilla . gov . bd', 1, 16, NULL, NULL, NULL, NULL),
(185, 'Bagmara(North]', 'বাগমারা(উত্তর]', 'bagmaranorthup . comilla . gov . bd', 1, 17, NULL, NULL, NULL, NULL),
(186, 'Bagmara(South]', 'বাগমারা(দক্ষিন]', 'bagmarasouthup . comilla . gov . bd', 1, 17, NULL, NULL, NULL, NULL),
(187, 'Bhuloin(North]', 'ভূলইন(উত্তর]', 'bhuloinnorthup . comilla . gov . bd', 1, 17, NULL, NULL, NULL, NULL),
(188, 'Bhuloin(South]', 'ভূলইন(দক্ষিন]', 'bhuloinsouthup . comilla . gov . bd', 1, 17, NULL, NULL, NULL, NULL),
(189, 'Belgor(North]', 'বেলঘর(উত্তর]', 'belgornorthup . comilla . gov . bd', 1, 17, NULL, NULL, NULL, NULL),
(190, 'Belgor(South]', 'বেলঘর(দক্ষিন]', 'belgorsouthup . comilla . gov . bd', 1, 17, NULL, NULL, NULL, NULL),
(191, 'Perul(North]', 'পেরুল(উত্তর]', 'perulnorthup . comilla . gov . bd', 1, 17, NULL, NULL, NULL, NULL),
(192, 'Perul(South]', 'পেরুল(দক্ষিন]', 'perulsouthup . comilla . gov . bd', 1, 17, NULL, NULL, NULL, NULL),
(193, 'Mohamaya', 'মহামায়া', 'mohamayaup . feni . gov . bd', 1, 18, NULL, NULL, NULL, NULL),
(194, 'Pathannagar', 'পাঠাননগর', 'pathannagarup . feni . gov . bd', 1, 18, NULL, NULL, NULL, NULL),
(195, 'Subhapur', 'শুভপুর', 'subhapurup . feni . gov . bd', 1, 18, NULL, NULL, NULL, NULL),
(196, 'Radhanagar', 'রাধানগর', 'radhanagarup . feni . gov . bd', 1, 18, NULL, NULL, NULL, NULL),
(197, 'Gopal', 'ঘোপাল', 'gopalup . feni . gov . bd', 1, 18, NULL, NULL, NULL, NULL),
(198, 'Sarishadi', 'শর্শদি', 'sarishadiup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(199, 'Panchgachia', 'পাঁচগাছিয়া', 'panchgachiaup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(200, 'Dhormapur', 'ধর্মপুর', 'dhormapurup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(201, 'Kazirbag', 'কাজিরবাগ', 'kazirbagup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(202, 'Kalidah', 'কালিদহ', 'kalidahup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(203, 'Baligaon', 'বালিগাঁও', 'baligaonup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(204, 'Dholia', 'ধলিয়া', 'dholiaup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(205, 'Lemua', 'লেমুয়া', 'lemuaup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(206, 'Chonua', 'ছনুয়া', 'chonuaup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(207, 'Motobi', 'মোটবী', 'motobiup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(208, 'Fazilpur', 'ফাজিলপুর', 'fazilpurup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(209, 'Forhadnogor', 'ফরহাদনগর', 'forhadnogorup . feni . gov . bd', 1, 19, NULL, NULL, NULL, NULL),
(210, 'Charmozlishpur', 'চরমজলিশপুর', 'charmozlishpurup . feni . gov . bd', 1, 20, NULL, NULL, NULL, NULL),
(211, 'Bogadana', 'বগাদানা', 'bogadanaup . feni . gov . bd', 1, 20, NULL, NULL, NULL, NULL),
(212, 'Motigonj', 'মতিগঞ্জ', 'motigonjup . feni . gov . bd', 1, 20, NULL, NULL, NULL, NULL),
(213, 'Mongolkandi', 'মঙ্গলকান্দি', 'mongolkandiup . feni . gov . bd', 1, 20, NULL, NULL, NULL, NULL),
(214, 'Chardorbesh', 'চরদরবেশ', 'chardorbeshup . feni . gov . bd', 1, 20, NULL, NULL, NULL, NULL),
(215, 'Chorchandia', 'চরচান্দিয়া', 'chorchandiaup . feni . gov . bd', 1, 20, NULL, NULL, NULL, NULL),
(216, 'Sonagazi', 'সোনাগাজী', 'sonagaziup . feni . gov . bd', 1, 20, NULL, NULL, NULL, NULL),
(217, 'Amirabad', 'আমিরাবাদ', 'amirabadup . feni . gov . bd', 1, 20, NULL, NULL, NULL, NULL),
(218, 'Nababpur', 'নবাবপুর', 'nababpurup . feni . gov . bd', 1, 20, NULL, NULL, NULL, NULL),
(219, 'Fulgazi', 'ফুলগাজী', 'fulgaziup . feni . gov . bd', 1, 21, NULL, NULL, NULL, NULL),
(220, 'Munshirhat', 'মুন্সিরহাট', 'munshirhatup . feni . gov . bd', 1, 21, NULL, NULL, NULL, NULL),
(221, 'Dorbarpur', 'দরবারপুর', 'dorbarpurup . feni . gov . bd', 1, 21, NULL, NULL, NULL, NULL),
(222, 'Anandopur', 'আনন্দপুর', 'anandopurup . feni . gov . bd', 1, 21, NULL, NULL, NULL, NULL),
(223, 'Amzadhat', 'আমজাদহাট', 'amzadhatup . feni . gov . bd', 1, 21, NULL, NULL, NULL, NULL),
(224, 'Gmhat', 'জি,এম, হাট', 'gmhatup . feni . gov . bd', 1, 21, NULL, NULL, NULL, NULL),
(225, 'Mizanagar', 'মির্জানগর', 'mizanagarup . feni . gov . bd', 1, 22, NULL, NULL, NULL, NULL),
(226, 'Ctholia', 'চিথলিয়া', 'ctholiaup . feni . gov . bd', 1, 22, NULL, NULL, NULL, NULL),
(227, 'Boxmahmmud', 'বক্সমাহমুদ', 'boxmahmmudup . feni . gov . bd', 1, 22, NULL, NULL, NULL, NULL),
(228, 'Sindurpur', 'সিন্দুরপুর', 'sindurpurup . feni . gov . bd', 1, 23, NULL, NULL, NULL, NULL),
(229, 'Rajapur', 'রাজাপুর', 'rajapurup . feni . gov . bd', 1, 23, NULL, NULL, NULL, NULL),
(230, 'Purbachandrapur', 'পূর্বচন্দ্রপুর', 'purbachandrapurup . feni . gov . bd', 1, 23, NULL, NULL, NULL, NULL),
(231, 'Ramnagar', 'রামনগর', 'ramnagarup . feni . gov . bd', 1, 23, NULL, NULL, NULL, NULL),
(232, 'Yeakubpur', 'ইয়াকুবপুর', 'yeakubpur . feni . gov . bd', 1, 23, NULL, NULL, NULL, NULL),
(233, 'Daganbhuiyan', 'দাগনভূঞা', 'daganbhuiyanup . feni . gov . bd', 1, 23, NULL, NULL, NULL, NULL),
(234, 'Matubhuiyan', 'মাতুভূঞা', 'matubhuiyanup . feni . gov . bd', 1, 23, NULL, NULL, NULL, NULL),
(235, 'Jayloskor', 'জায়লস্কর', 'jayloskorup . feni . gov . bd', 1, 23, NULL, NULL, NULL, NULL),
(236, 'Basudeb', 'বাসুদেব', 'basudeb . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(237, 'Machihata', 'মাছিহাতা', 'machihata . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(238, 'Sultanpur', 'সুলতানপুর', 'sultanpur . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(239, 'Ramrail', 'রামরাইল', 'ramrail . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(240, 'Sadekpur', 'সাদেকপুর', 'sadekpur . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(241, 'Talsahar', 'তালশহর', 'talsahar . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(242, 'Natai', 'নাটাই(দক্ষিন]', 'natais . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(243, 'Natai', 'নাটাই(উত্তর]', 'natain . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(244, 'Shuhilpur', 'সুহিলপুর', 'shuhilpur . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(245, 'Bodhal', 'বুধল', 'bodhal . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(246, 'Majlishpur', 'মজলিশপুর', 'majlishpur . brahmanbaria . gov . bd', 1, 24, NULL, NULL, NULL, NULL),
(247, 'Mulagram', 'মূলগ্রাম', 'mulagramup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(248, 'Mehari', 'মেহারী', 'mehariup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(249, 'Badair', 'বাদৈর', 'badairup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(250, 'Kharera', 'খাড়েরা', 'khareraup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(251, 'Benauty', 'বিনাউটি', 'benautyup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(252, 'Gopinathpur', 'গোপীনাথপুর', 'gopinathpurup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(253, 'Kasbaw', 'কসবা', 'kasbawup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(254, 'Kuti', 'কুটি', 'kutiup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(255, 'Kayempur', 'কাইমপুর', 'kayempurup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(256, 'Bayek', 'বায়েক', 'bayekup . brahmanbaria . gov . bd', 1, 25, NULL, NULL, NULL, NULL),
(257, 'Chatalpar', 'চাতলপাড়', 'chatalparup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(258, 'Bhalakut', 'ভলাকুট', 'bhalakutup . brahmanbaria . gov . bd ', 1, 26, NULL, NULL, NULL, NULL),
(259, 'Kunda', 'কুন্ডা', 'kundaup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(260, 'Goalnagar', 'গোয়ালনগর', 'goalnagarup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(261, 'Nasirnagar', 'নাসিরনগর', 'nasirnagarup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(262, 'Burishwar', 'বুড়িশ্বর', 'burishwarup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(263, 'Fandauk', 'ফান্দাউক', 'fandaukup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(264, 'Goniauk', 'গুনিয়াউক', 'goniaukup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(265, 'Chapartala', 'চাপৈরতলা', 'chapartalaup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(266, 'Dharnondol', 'ধরমন্ডল', 'dharnondolup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(267, 'Haripur', 'হরিপুর', 'haripurup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(268, 'Purbabhag', 'পূর্বভাগ', 'purbabhagup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(269, 'Gokarna', 'গোকর্ণ', 'gokarnaup . brahmanbaria . gov . bd', 1, 26, NULL, NULL, NULL, NULL),
(270, 'Auraol', 'অরুয়াইল', 'auraolup . brahmanbaria . gov . bd', 1, 27, NULL, NULL, NULL, NULL),
(271, 'Pakshimuul', 'পাকশিমুল', 'pakshimuulup . brahmanbaria . gov . bd', 1, 27, NULL, NULL, NULL, NULL),
(272, 'Chunta', 'চুন্টা', 'chuntaup . brahmanbaria . gov . bd', 1, 27, NULL, NULL, NULL, NULL),
(273, 'Kalikaccha', 'কালীকচ্ছ', 'kalikacchaup . brahmanbaria . gov . bd', 1, 27, NULL, NULL, NULL, NULL),
(274, 'Panishor', 'পানিশ্বর', 'panishorup . brahmanbaria . gov . bd', 1, 27, NULL, NULL, NULL, NULL),
(275, 'Sarail', 'সরাইল সদর', 'sarailup . brahmanbaria . gov . bd', 1, 27, NULL, NULL, NULL, NULL),
(276, 'Noagoun', 'নোয়াগাঁও', 'noagounup . brahmanbaria . gov . bd', 1, 27, NULL, NULL, NULL, NULL),
(277, 'Shahajadapur', 'শাহজাদাপুর', 'shahajadapurup . brahmanbaria . gov . bd', 1, 27, NULL, NULL, NULL, NULL),
(278, 'Shahbazpur', 'শাহবাজপুর', 'shahbazpurup . brahmanbaria . gov . bd', 1, 27, NULL, NULL, NULL, NULL),
(279, 'Ashuganj', 'আশুগঞ্জ সদর', 'ashuganjup . brahmanbaria . gov . bd', 1, 28, NULL, NULL, NULL, NULL),
(280, 'Charchartala', 'চরচারতলা', 'charchartalaup . brahmanbaria . gov . bd', 1, 28, NULL, NULL, NULL, NULL),
(281, 'Durgapur', 'দুর্গাপুর', 'durgapurup . brahmanbaria . gov . bd', 1, 28, NULL, NULL, NULL, NULL),
(282, 'Araishidha', 'আড়াইসিধা', 'araishidhaup . brahmanbaria . gov . bd', 1, 28, NULL, NULL, NULL, NULL),
(283, 'Talshaharw', 'তালশহর(পঃ]', 'talshaharwup . brahmanbaria . gov . bd', 1, 28, NULL, NULL, NULL, NULL),
(284, 'Sarifpur', 'শরীফপুর', 'sarifpurup . brahmanbaria . gov . bd', 1, 28, NULL, NULL, NULL, NULL),
(285, 'Lalpur', 'লালপুর', 'lalpurup . brahmanbaria . gov . bd', 1, 28, NULL, NULL, NULL, NULL),
(286, 'Tarua', 'তারুয়া', 'taruaup . brahmanbaria . gov . bd', 1, 28, NULL, NULL, NULL, NULL),
(287, 'Monionda', 'মনিয়ন্দ', 'moniondaup . brahmanbaria . gov . bd', 1, 29, NULL, NULL, NULL, NULL),
(288, 'Dharkhar', 'ধরখার', 'dharkharup . brahmanbaria . gov . bd', 1, 29, NULL, NULL, NULL, NULL),
(289, 'Mogra', 'মোগড়া', 'mograup . brahmanbaria . gov . bd', 1, 29, NULL, NULL, NULL, NULL),
(290, 'Akhauran', 'আখাউড়া(উঃ]', 'akhauranup . brahmanbaria . gov . bd', 1, 29, NULL, NULL, NULL, NULL),
(291, 'Akhauras', 'আখাউড়া(দঃ]', 'akhaurasup . brahmanbaria . gov . bd', 1, 29, NULL, NULL, NULL, NULL),
(292, 'Barail', 'বড়াইল', 'barailup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(293, 'Birgaon', 'বীরগাঁও', 'birgaonup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(294, 'Krishnanagar', 'কৃষ্ণনগর', 'krishnanagarup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(295, 'Nathghar', 'নাটঘর', 'nathgharup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(296, 'Biddayakut', 'বিদ্যাকুট', 'biddayakutup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(297, 'Nabinagare', 'নবীনগর(পূর্ব]', 'nabinagareup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(298, 'Nabinagarw', 'নবীনগর(পশ্চিম]', 'nabinagarwup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(299, 'Bitghar', 'বিটঘর', 'bitgharup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(300, 'Shibpur', 'শিবপুর', 'shibpurup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(301, 'Sreerampur', 'শ্রীরামপুর', 'sreerampurup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(302, 'Jinudpur', 'জিনোদপুর', 'jinudpurup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(303, 'Laurfatehpur', 'লাউরফতেপুর', 'laurfatehpurup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(304, 'Ibrahimpur', 'ইব্রাহিমপুর', 'ibrahimpurup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(305, 'Satmura', 'সাতমোড়া', 'satmuraup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(306, 'Shamogram', 'শ্যামগ্রাম', 'shamogramup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(307, 'Rasullabad', 'রসুল্লাবাদ', 'rasullabadup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(308, 'Barikandi', 'বড়িকান্দি', 'barikandiup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(309, 'Salimganj', 'ছলিমগঞ্জ', 'salimganjup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(310, 'Ratanpur', 'রতনপুর', 'ratanpurup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(311, 'Kaitala(North]', 'কাইতলা(উত্তর]', 'kaitalanup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(312, 'Kaitala(South]', 'কাইতলা(দক্ষিন]', 'kaitalasup . brahmanbaria . gov . bd', 1, 30, NULL, NULL, NULL, NULL),
(313, 'Tazkhali', 'তেজখালী', 'tazkhaliup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(314, 'Pahariya Kandi', 'পাহাড়িয়া কান্দি', 'pahariyakandiup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(315, 'Dariadulat', 'দরিয়াদৌলত', 'dariadulatup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(316, 'Sonarampur', 'সোনারামপুর', 'sonarampurup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(317, 'Darikandi', 'দড়িকান্দি', 'darikandiup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(318, 'Saifullyakandi', 'ছয়ফুল্লাকান্দি', 'saifullyakandiup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(319, 'Bancharampur', 'বাঞ্ছারামপুর', 'bancharampurup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(320, 'Ayabpur', 'আইয়ুবপুর', 'ayabpurup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(321, 'Fardabad', 'ফরদাবাদ', 'fardabadup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(322, 'Rupushdi', 'রুপসদী পশ্চিম', 'rupushdiup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(323, 'Salimabad', 'ছলিমাবাদ', 'salimabadup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(324, 'Ujanchar', 'উজানচর পূর্ব', 'ujancharup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(325, 'Manikpur', 'মানিকপুর', 'manikpurup . brahmanbaria . gov . bd', 1, 31, NULL, NULL, NULL, NULL),
(326, 'Bhudanty', 'বুধন্তি', 'bhudantyup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(327, 'Chandura', 'চান্দুরা', 'chanduraup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(328, 'Ichapura', 'ইছাপুরা', 'ichapuraup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(329, 'Champaknagar', 'চম্পকনগর', 'champaknagarup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(330, 'Harashpur', 'হরষপুর', 'harashpurup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(331, 'Pattan', 'পত্তন', 'pattanup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(332, 'Singerbil', 'সিংগারবিল', 'singerbilup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(333, 'Bishupor', 'বিষ্ণুপুর', 'bishuporup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(334, 'Charislampur', 'চর - ইসলামপুর', 'charislampurup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(335, 'Paharpur', 'পাহাড়পুর', 'paharpurup . brahmanbaria . gov . bd', 1, 32, NULL, NULL, NULL, NULL),
(336, 'Jibtali', 'জীবতলি', 'jibtaliup . rangamati . gov . bd', 1, 33, NULL, NULL, NULL, NULL),
(337, 'Sapchari', 'সাপছড়ি', 'sapchariup . rangamati . gov . bd', 1, 33, NULL, NULL, NULL, NULL),
(338, 'Kutukchari', 'কুতুকছড়ি', 'kutukchariup . rangamati . gov . bd', 1, 33, NULL, NULL, NULL, NULL),
(339, 'Bandukbhanga', 'বন্দুকভাঙ্গা', 'bandukbhangaup . rangamati . gov . bd', 1, 33, NULL, NULL, NULL, NULL),
(340, 'Balukhali', 'বালুখালী', 'balukhaliup . rangamati . gov . bd', 1, 33, NULL, NULL, NULL, NULL),
(341, 'Mogban', 'মগবান', 'mogbanup . rangamati . gov . bd', 1, 33, NULL, NULL, NULL, NULL),
(342, 'Raikhali', 'রাইখালী', 'raikhaliup . rangamati . gov . bd', 1, 34, NULL, NULL, NULL, NULL),
(343, 'Kaptai', 'কাপ্তাই', 'kaptaiup . rangamati . gov . bd', 1, 34, NULL, NULL, NULL, NULL),
(344, 'Wagga', 'ওয়াজ্ঞা', 'waggaup . rangamati . gov . bd', 1, 34, NULL, NULL, NULL, NULL),
(345, 'Chandraghona', 'চন্দ্রঘোনা', 'chandraghonaup . rangamati . gov . bd', 1, 34, NULL, NULL, NULL, NULL),
(346, 'Chitmorom', 'চিৎমরম', 'chitmoromup . rangamati . gov . bd', 1, 34, NULL, NULL, NULL, NULL),
(347, 'Ghagra', 'ঘাগড়া', 'ghagraup . rangamati . gov . bd', 1, 35, NULL, NULL, NULL, NULL),
(348, 'Fatikchari', 'ফটিকছড়ি', 'fatikchariup . rangamati . gov . bd', 1, 35, NULL, NULL, NULL, NULL),
(349, 'Betbunia', 'বেতবুনিয়া', 'betbuniaup . rangamati . gov . bd', 1, 35, NULL, NULL, NULL, NULL),
(350, 'Kalampati', 'কলমপতি', 'kalampatiup . rangamati . gov . bd', 1, 35, NULL, NULL, NULL, NULL),
(351, 'Sajek', 'সাজেক', 'sajekup . rangamati . gov . bd', 1, 36, NULL, NULL, NULL, NULL),
(352, 'Amtali', 'আমতলী', 'amtaliup . rangamati . gov . bd', 1, 36, NULL, NULL, NULL, NULL),
(353, 'Bongoltali', 'বঙ্গলতলী', 'bongoltaliup . rangamati . gov . bd', 1, 36, NULL, NULL, NULL, NULL),
(354, 'Rupokari', 'রুপকারী', 'rupokariup . rangamati . gov . bd', 1, 36, NULL, NULL, NULL, NULL),
(355, 'Marisha', 'মারিশ্যা', 'marishaup . rangamati . gov . bd', 1, 36, NULL, NULL, NULL, NULL),
(356, 'Khedarmara', 'খেদারমারা', 'khedarmaraup . rangamati . gov . bd', 1, 36, NULL, NULL, NULL, NULL),
(357, 'Sharoyatali', 'সারোয়াতলী', 'sharoyataliup . rangamati . gov . bd', 1, 36, NULL, NULL, NULL, NULL),
(358, 'Baghaichari', 'বাঘাইছড়ি', 'baghaichariup . rangamati . gov . bd', 1, 36, NULL, NULL, NULL, NULL),
(359, 'Subalong', 'সুবলং', 'subalongup . rangamati . gov . bd', 1, 37, NULL, NULL, NULL, NULL),
(360, 'Barkal', 'বরকল', 'barkalup . rangamati . gov . bd', 1, 37, NULL, NULL, NULL, NULL),
(361, 'Bushanchara', 'ভূষনছড়া', 'bushancharaup . rangamati . gov . bd', 1, 37, NULL, NULL, NULL, NULL),
(362, 'Aimachara', 'আইমাছড়া', 'aimacharaup . rangamati . gov . bd', 1, 37, NULL, NULL, NULL, NULL),
(363, 'Borohorina', 'বড় হরিণা', 'borohorinaup . rangamati . gov . bd', 1, 37, NULL, NULL, NULL, NULL),
(364, 'Langad', 'লংগদু', 'langaduup . rangamati . gov . bd', 1, 38, NULL, NULL, NULL, NULL),
(365, 'Maeinimukh', 'মাইনীমুখ', 'maeinimukhup . rangamati . gov . bd', 1, 38, NULL, NULL, NULL, NULL),
(366, 'Vasannadam', 'ভাসান্যাদম', 'vasannadamup . rangamati . gov . bd', 1, 38, NULL, NULL, NULL, NULL),
(367, 'Bogachattar', 'বগাচতর', 'bogachattarup . rangamati . gov . bd', 1, 38, NULL, NULL, NULL, NULL),
(368, 'Gulshakhali', 'গুলশাখালী', 'gulshakhaliup . rangamati . gov . bd', 1, 38, NULL, NULL, NULL, NULL),
(369, 'Kalapakujja', 'কালাপাকুজ্যা', 'kalapakujjaup . rangamati . gov . bd', 1, 38, NULL, NULL, NULL, NULL),
(370, 'Atarakchara', 'আটারকছড়া', 'atarakcharaup . rangamati . gov . bd', 1, 38, NULL, NULL, NULL, NULL),
(371, 'Ghilachari', 'ঘিলাছড়ি', 'ghilachariup . rangamati . gov . bd', 1, 39, NULL, NULL, NULL, NULL),
(372, 'Gaindya', 'গাইন্দ্যা', 'gaindyaup . rangamati . gov . bd', 1, 39, NULL, NULL, NULL, NULL),
(373, 'Bangalhalia', 'বাঙ্গালহালিয়া', 'bangalhaliaup . rangamati . gov . bd', 1, 39, NULL, NULL, NULL, NULL),
(374, 'Kengrachari', 'কেংড়াছড়ি', 'kengrachariup . rangamati . gov . bd', 1, 40, NULL, NULL, NULL, NULL),
(375, 'Belaichari', 'বিলাইছড়ি', 'belaichariup . rangamati . gov . bd', 1, 40, NULL, NULL, NULL, NULL),
(376, 'Farua', 'ফারুয়া', 'faruaup . rangamati . gov . bd', 1, 40, NULL, NULL, NULL, NULL),
(377, 'Juraichari', 'জুরাছড়ি', 'juraichariup . rangamati . gov . bd', 1, 41, NULL, NULL, NULL, NULL),
(378, 'Banajogichara', 'বনযোগীছড়া', 'banajogicharaup . rangamati . gov . bd', 1, 41, NULL, NULL, NULL, NULL),
(379, 'Moidong', 'মৈদং', 'moidongup . rangamati . gov . bd', 1, 41, NULL, NULL, NULL, NULL),
(380, 'Dumdumya', 'দুমদুম্যা', 'dumdumyaup . rangamati . gov . bd', 1, 41, NULL, NULL, NULL, NULL),
(381, 'Sabekkhong', 'সাবেক্ষ্যং', 'sabekkhongup . rangamati . gov . bd', 1, 42, NULL, NULL, NULL, NULL),
(382, 'Naniarchar', 'নানিয়ারচর', 'naniarcharup . rangamati . gov . bd', 1, 42, NULL, NULL, NULL, NULL),
(383, 'Burighat', 'বুড়িঘাট', 'burighatup . rangamati . gov . bd', 1, 42, NULL, NULL, NULL, NULL),
(384, 'Ghilachhari', 'ঘিলাছড়ি', 'ghilachhariup . rangamati . gov . bd', 1, 42, NULL, NULL, NULL, NULL),
(385, 'Charmatua', 'চরমটুয়া', 'charmatuaup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(386, 'Dadpur', 'দাদপুর', 'dadpurup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(387, 'Noannoi', 'নোয়ান্নই', 'noannoiup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(388, 'Kadirhanif', 'কাদির হানিফ', 'kadirhanifup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(389, 'Binodpur', 'বিনোদপুর', 'binodpurup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(390, 'Dharmapur', 'ধর্মপুর', 'dharmapurup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(391, 'Aujbalia', 'এওজবালিয়া', 'aujbaliaup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(392, 'Kaladara', 'কালাদরপ', 'kaladarapup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(393, 'Ashwadia', 'অশ্বদিয়া', 'ashwadiaup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(394, 'Newajpur', 'নিয়াজপুর', 'newajpurup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(395, 'East Charmatua', 'পূর্ব চরমটুয়া', 'eastcharmatuap . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(396, 'Andarchar', 'আন্ডারচর', 'andarcharup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(397, 'Noakhali', 'নোয়াখালী', 'noakhaliup . noakhali . gov . bd', 1, 43, NULL, NULL, NULL, NULL),
(398, 'Sirajpur', 'সিরাজপুর', 'sirajpurup . noakhali . gov . bd', 1, 44, NULL, NULL, NULL, NULL),
(399, 'Charparboti', 'চরপার্বতী', 'charparbotiup . noakhali . gov . bd', 1, 44, NULL, NULL, NULL, NULL),
(400, 'Charhazari', 'চরহাজারী', 'charhazariup . noakhali . gov . bd', 1, 44, NULL, NULL, NULL, NULL),
(401, 'Charkakra', 'চরকাঁকড়া', 'charkakraup . noakhali . gov . bd', 1, 44, NULL, NULL, NULL, NULL),
(402, 'Charfakira', 'চরফকিরা', 'charfakiraup . noakhali . gov . bd', 1, 44, NULL, NULL, NULL, NULL),
(403, 'Musapur', 'মুসাপুর', 'musapurup . noakhali . gov . bd', 1, 44, NULL, NULL, NULL, NULL),
(404, 'Charelahi', 'চরএলাহী', 'charelahiup . noakhali . gov . bd', 1, 44, NULL, NULL, NULL, NULL),
(405, 'Rampur', 'রামপুর', 'rampurup . noakhali . gov . bd', 1, 44, NULL, NULL, NULL, NULL),
(406, 'Amanullapur', 'আমানউল্ল্যাপুর', 'amanullapurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(407, 'Gopalpur', 'গোপালপুর', 'gopalpurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(408, 'Jirtali', 'জিরতলী', 'jirtaliup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(409, 'Kutubpur', 'কুতবপুর', 'kutubpurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(410, 'Alyearpur', 'আলাইয়ারপুর', 'alyearpurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(411, 'Chayani', 'ছয়ানী', 'chayaniup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(412, 'Rajganj', 'রাজগঞ্জ', 'rajganjup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(413, 'Eklashpur', 'একলাশপুর', 'eklashpurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(414, 'Begumganj', 'বেগমগঞ্জ', 'begumganjup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(415, 'Mirwarishpur', 'মিরওয়ারিশপুর', 'mirwarishpurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(416, 'Narottampur', 'নরোত্তমপুর', 'narottampurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(417, 'Durgapur', 'দূর্গাপুর', 'durgapurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(418, 'Rasulpur', 'রসুলপুর', 'rasulpurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(419, 'Hajipur', 'হাজীপুর', 'hajipurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(420, 'Sharifpur', 'শরীফপুর', 'sharifpurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(421, 'Kadirpur', 'কাদিরপুর', 'kadirpurup . noakhali . gov . bd', 1, 45, NULL, NULL, NULL, NULL),
(422, 'Sukhchar', 'সুখচর', 'sukhcharup . noakhali . gov . bd', 1, 46, NULL, NULL, NULL, NULL),
(423, 'Nolchira', 'নলচিরা', 'nolchiraup . noakhali . gov . bd', 1, 46, NULL, NULL, NULL, NULL),
(424, 'Charishwar', 'চরঈশ্বর', 'charishwarup . noakhali . gov . bd', 1, 46, NULL, NULL, NULL, NULL),
(425, 'Charking', 'চরকিং', 'charkingup . noakhali . gov . bd', 1, 46, NULL, NULL, NULL, NULL),
(426, 'Tomoroddi', 'তমরদ্দি', 'tomoroddiup . noakhali . gov . bd', 1, 46, NULL, NULL, NULL, NULL),
(427, 'Sonadiya', 'সোনাদিয়া', 'sonadiyaup . noakhali . gov . bd', 1, 46, NULL, NULL, NULL, NULL),
(428, 'Burirchar', 'বুড়িরচর', 'burircharup . noakhali . gov . bd', 1, 46, NULL, NULL, NULL, NULL),
(429, 'Jahajmara', 'জাহাজমারা', 'jahajmaraup . noakhali . gov . bd', 1, 46, NULL, NULL, NULL, NULL),
(430, 'Nijhumdwi', 'নিঝুমদ্বীপ', 'nijhumdwipup . noakhali . gov . bd', 1, 46, NULL, NULL, NULL, NULL),
(431, 'Charjabbar', 'চরজাব্বার', 'charjabbarup . noakhali . gov . bd', 1, 47, NULL, NULL, NULL, NULL),
(432, 'Charbata', 'চরবাটা', 'charbataup . noakhali . gov . bd', 1, 47, NULL, NULL, NULL, NULL),
(433, 'Charclerk', 'চরক্লার্ক', 'charclerkup . noakhali . gov . bd', 1, 47, NULL, NULL, NULL, NULL),
(434, 'Charwapda', 'চরওয়াপদা', 'charwapdaup . noakhali . gov . bd', 1, 47, NULL, NULL, NULL, NULL),
(435, 'Charjubilee', 'চরজুবলী', 'charjubileeup . noakhali . gov . bd', 1, 47, NULL, NULL, NULL, NULL),
(436, 'Charaman Ullah', 'চরআমান উল্যা', 'charamanullahup . noakhali . gov . bd', 1, 47, NULL, NULL, NULL, NULL),
(437, 'East Charbata', 'পূর্ব চরবাটা', 'eastcharbataup . noakhali . gov . bd', 1, 47, NULL, NULL, NULL, NULL),
(438, 'Mohammadpur', 'মোহাম্মদপুর', 'mohammadpurup . noakhali . gov . bd', 1, 47, NULL, NULL, NULL, NULL),
(439, 'Narottampur', 'নরোত্তমপুর', 'narottampurup1 . noakhali . gov . bd', 1, 48, NULL, NULL, NULL, NULL),
(440, 'Dhanshiri', 'ধানসিঁড়ি', 'dhanshiriup . noakhali . gov . bd', 1, 48, NULL, NULL, NULL, NULL),
(441, 'Sundalpur', 'সুন্দলপুর', 'sundalpurup . noakhali . gov . bd', 1, 48, NULL, NULL, NULL, NULL),
(442, 'Ghoshbag', 'ঘোষবাগ', 'ghoshbagup . noakhali . gov . bd', 1, 48, NULL, NULL, NULL, NULL),
(443, 'Chaprashirhat', 'চাপরাশিরহাট', 'chaprashirhatup . noakhali . gov . bd', 1, 48, NULL, NULL, NULL, NULL),
(444, 'Dhanshalik', 'ধানশালিক', 'dhanshalikup . noakhali . gov . bd', 1, 48, NULL, NULL, NULL, NULL),
(445, 'Batoiya', 'বাটইয়া', 'batoiyaup . noakhali . gov . bd', 1, 48, NULL, NULL, NULL, NULL),
(446, 'Chhatarpaia', 'ছাতারপাইয়া', 'chhatarpaiaup . noakhali . gov . bd', 1, 49, NULL, NULL, NULL, NULL),
(447, 'Kesharpar', 'কেশরপাড়া', 'kesharparup . noakhali . gov . bd', 1, 49, NULL, NULL, NULL, NULL),
(448, 'Dumurua', 'ডুমুরুয়া', 'dumuruaup . noakhali . gov . bd', 1, 49, NULL, NULL, NULL, NULL),
(449, 'Kadra', 'কাদরা', 'kadraup . noakhali . gov . bd', 1, 49, NULL, NULL, NULL, NULL),
(450, 'Arjuntala', 'অর্জুনতলা', 'arjuntalaup . noakhali . gov . bd', 1, 49, NULL, NULL, NULL, NULL),
(451, 'Kabilpur', 'কাবিলপুর', 'kabilpurup . noakhali . gov . bd', 1, 49, NULL, NULL, NULL, NULL),
(452, 'Mohammadpur', 'মোহাম্মদপুর', 'mohammadpurup7 . noakhali . gov . bd', 1, 49, NULL, NULL, NULL, NULL),
(453, 'Nabipur', 'নবীপুর', 'nabipurup . noakhali . gov . bd', 1, 49, NULL, NULL, NULL, NULL),
(454, 'Bejbagh', 'বিজবাগ', 'bejbaghup . noakhali . gov . bd', 1, 49, NULL, NULL, NULL, NULL),
(455, 'Sahapur', 'সাহাপুর', 'sahapurup . noakhali . gov . bd', 1, 50, NULL, NULL, NULL, NULL),
(456, 'Ramnarayanpur', 'রামনারায়নপুর', 'ramnarayanpurup . noakhali . gov . bd', 1, 50, NULL, NULL, NULL, NULL),
(457, 'Porokote', 'পরকোট', 'porokoteup . noakhali . gov . bd', 1, 50, NULL, NULL, NULL, NULL),
(458, 'Badalkot', 'বাদলকোট', 'badalkotup . noakhali . gov . bd', 1, 50, NULL, NULL, NULL, NULL),
(459, 'Panchgaon', 'পাঁচগাঁও', 'panchgaonup . noakhali . gov . bd', 1, 50, NULL, NULL, NULL, NULL),
(460, 'Hat - Pukuria Ghatlabag', 'হাট - পুকুরিয়া ঘাটলাবাগ', 'hatpukuriaghatlabagup . noakhali . gov . bd', 1, 50, NULL, NULL, NULL, NULL),
(461, 'Noakhala', 'নোয়াখলা', 'noakhalaup . noakhali . gov . bd', 1, 50, NULL, NULL, NULL, NULL),
(462, 'Khilpara', 'খিলপাড়া', 'khilparaup . noakhali . gov . bd', 1, 50, NULL, NULL, NULL, NULL),
(463, 'Mohammadpur', 'মোহাম্মদপুর', 'mohammadpuru5p . noakhali . gov . bd', 1, 50, NULL, NULL, NULL, NULL),
(464, 'Joyag', 'জয়াগ', 'joyagup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(465, 'Nodona', 'নদনা', 'nodonaup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(466, 'Chashirhat', 'চাষীরহাট', 'chashirhatup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(467, 'Barogaon', 'বারগাঁও', 'barogaonup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(468, 'Ambarnagor', 'অম্বরনগর', 'ambarnagorup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(469, 'Nateshwar', 'নাটেশ্বর', 'nateshwarup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(470, 'Bajra', 'বজরা', 'bajraup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(471, 'Sonapur', 'সোনাপুর', 'sonapurup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(472, 'Deoti', 'দেওটি', 'deotiup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(473, 'Amishapara', 'আমিশাপাড়া', 'amishaparaup . noakhali . gov . bd', 1, 51, NULL, NULL, NULL, NULL),
(474, 'Gazipur', 'গাজীপুর', 'gazipurup . chandpur . gov . bd', 1, 52, NULL, NULL, NULL, NULL),
(475, 'Algidurgapur(North]', 'আলগী দুর্গাপুর(উত্তর]', 'algidurgapurnorthup . chandpur . gov . bd', 1, 52, NULL, NULL, NULL, NULL),
(476, 'Algidurgapur(South]', 'আলগী দুর্গাপুর(দক্ষিণ]', 'algidurgapursouth . chandpur . gov . bd', 1, 52, NULL, NULL, NULL, NULL),
(477, 'Nilkamal', 'নীলকমল', 'nilkamalup . chandpur . gov . bd', 1, 52, NULL, NULL, NULL, NULL),
(478, 'Haimchar', 'হাইমচর', 'haimcharup . chandpur . gov . bd', 1, 52, NULL, NULL, NULL, NULL),
(479, 'Charbhairabi', 'চরভৈরবী', 'charbhairabiup . chandpur . gov . bd', 1, 52, NULL, NULL, NULL, NULL),
(480, 'Pathair', 'পাথৈর', 'pathairup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(481, 'Bitara', 'বিতারা', 'bitaraup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(482, 'Shohodebpur(East]', 'সহদেবপুর(পূর্ব]', 'shohodebpureastup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(483, 'Shohodebpur(West]', 'সহদেবপুর(পশ্চিম]', 'shohodebpurwestup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(484, 'Kachua(North]', 'কচুয়া(উত্তর]', 'kachuanorthup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(485, 'Kachua(South]', 'কচুয়া(দক্ষিণ]', 'kachuasouthup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(486, 'Gohat(North]', 'গোহাট(উত্তর]', 'gohatnorthup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(487, 'Kadla', 'কাদলা', 'kadlaup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(488, 'Ashrafpur', 'আসরাফপুর', 'ashrafpurup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(489, 'Gohat(South]', 'গোহাট(দক্ষিণ]', 'gohatsouthup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(490, 'Sachar', 'সাচার', 'sacharup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(491, 'Koroia', 'কড়ইয়া', 'koroiaup . chandpur . gov . bd', 1, 53, NULL, NULL, NULL, NULL),
(492, 'Tamta(South]', 'টামটা(দক্ষিণ]', 'tamtasouthup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(493, 'Tamta(North]', 'টামটা(উত্তর]', 'tamtanorthup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(494, 'Meher(North]', 'মেহের(উত্তর]', 'mehernorthup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(495, 'Meher(South]', 'মেহের(দক্ষিণ]', 'mehersouthup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(496, 'Suchipara(North]', 'সুচিপাড়া(উত্তর]', 'suchiparanorthup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(497, 'Suchipara(South]', 'সুচিপাড়া(দক্ষিণ]', 'suchiparasouthup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(498, 'Chitoshi(East]', 'চিতষী(পূর্ব]', 'chitoshieastup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(499, 'Raysree(South]', 'রায়শ্রী(দক্ষিন]', 'raysreesouthup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(500, 'Raysree(North]', 'রায়শ্রী(উত্তর]', 'raysreenorthup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(501, 'Chitoshiwest', 'চিতষী(পশ্চিম]', 'chitoshiwestup . chandpur . gov . bd', 1, 54, NULL, NULL, NULL, NULL),
(502, 'Bishnapur', 'বিষ্ণপুর', 'bishnapurup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(503, 'Ashikati', 'আশিকাটি', 'ashikatiup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(504, 'Shahmahmudpur', 'শাহ্‌ মাহমুদপুর', 'shahmahmudpurup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(505, 'Kalyanpur', 'কল্যাণপুর', 'kalyanpurup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(506, 'Rampur', 'রামপুর', 'rampurup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL);
INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(507, 'Maishadi', 'মৈশাদী', 'maishadiup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(508, 'Tarpurchandi', 'তরপুচন্ডী', 'tarpurchandiup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(509, 'Baghadi', 'বাগাদী', 'baghadiup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(510, 'Laxmipur Model', 'লক্ষীপুর মডেল', 'laxmipurmodelup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(511, 'Hanarchar', 'হানারচর', 'hanarcharup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(512, 'Chandra', 'চান্দ্রা', 'chandraup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(513, 'Rajrajeshwar', 'রাজরাজেশ্বর', 'rajrajeshwarup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(514, 'Ibrahimpur', 'ইব্রাহীমপুর', 'ibrahimpurup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(515, 'Balia', 'বালিয়া', 'baliaup . chandpur . gov . bd', 1, 55, NULL, NULL, NULL, NULL),
(516, 'Nayergaon(North]', 'নায়েরগাঁও(উত্তর]', 'nayergaonnorthup . chandpur . gov . bd', 1, 56, NULL, NULL, NULL, NULL),
(517, 'Nayergaon(South]', 'নায়েরগাঁও(দক্ষিন]', 'nayergaonsouthup . chandpur . gov . bd', 1, 56, NULL, NULL, NULL, NULL),
(518, 'Khadergaon', 'খাদেরগাঁও', 'khadergaonup . chandpur . gov . bd', 1, 56, NULL, NULL, NULL, NULL),
(519, 'Narayanpur', 'নারায়নপুর', 'narayanpurup . chandpur . gov . bd', 1, 56, NULL, NULL, NULL, NULL),
(520, 'Upadi(South]', 'উপাদী(দক্ষিণ]', 'upadisouthup . chandpur . gov . bd', 1, 56, NULL, NULL, NULL, NULL),
(521, 'Upadi(North]', 'উপাদী(উত্তর]', 'upadinorthup . chandpur . gov . bd', 1, 56, NULL, NULL, NULL, NULL),
(522, 'Rajargaon(North]', 'রাজারগাঁও(উত্তর]', 'rajargaonnorthup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(523, 'Bakila', 'বাকিলা', 'bakilaup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(524, 'Kalocho(North]', 'কালচোঁ(উত্তর]', 'kalochonorthup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(525, 'Hajiganj Sadar', 'হাজীগঞ্জ সদর', 'hajiganjsadarup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(526, 'Kalocho(South]', 'কালচোঁ(দক্ষিণ]', 'kalochosouthup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(527, 'Barkul(East]', 'বড়কুল(পূর্ব]', 'barkuleastup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(528, 'Barkul(West]', 'বড়কুল(পশ্চিম]', 'barkulwestup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(529, 'Hatila(East]', 'হাটিলা(পূর্ব]', 'hatilaeastup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(530, 'Hatila(West]', 'হাটিলা(পশ্চিম]', 'hatilawestup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(531, 'Gandharbapur(North]', 'গন্ধর্ব্যপুর(উত্তর]', 'gandharbapurnorthup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(532, 'Gandharbapur(South]', 'গন্ধর্ব্যপুর(দক্ষিণ]', 'gandharbapursouthup . chandpur . gov . bd', 1, 57, NULL, NULL, NULL, NULL),
(533, 'Satnal', 'ষাটনল', 'satnalup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(534, 'Banganbari', 'বাগানবাড়ী', 'banganbariup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(535, 'Sadullapur', 'সাদুল্ল্যাপুর', 'sadullapurup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(536, 'Durgapur', 'দূর্গাপুর', 'durgapurup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(537, 'Kalakanda', 'কালাকান্দা', 'kalakandaup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(538, 'Mohanpur', 'মোহনপুর', 'mohanpurup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(539, 'Eklaspur', 'এখলাছপুর', 'eklaspurup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(540, 'Jahirabad', 'জহিরাবাদ', 'jahirabadup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(541, 'Fatehpur(East]', 'ফতেহপুর(পূর্ব]', 'eastfatehpur . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(542, 'Fatehpur(West]', 'ফতেহপুর(পশ্চিম]', 'westfatehpurup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(543, 'Farajikandi', 'ফরাজীকান্দি', 'farajikandiup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(544, 'Islamabad', 'ইসলামাবাদ', 'islamabadup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(545, 'Sultanabad', 'সুলতানাবাদ', 'sultanabadup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(546, 'Gazra', 'গজরা', 'gazraup . chandpur . gov . bd', 1, 58, NULL, NULL, NULL, NULL),
(547, 'Balithuba(West]', 'বালিথুবা(পশ্চিম]', 'balithubawestup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(548, 'Balithuba(East]', 'বালিথুবা(পূর্ব]', 'balithubaeastup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(549, 'Subidpur(East]', 'সুবিদপুর(পূর্ব]', 'subidpureastup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(550, 'Subidpur(West]', 'সুবিদপুর(পশ্চিম]', 'subidpurwestup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(551, 'Gupti(West]', 'গুপ্তি(পশ্চিম]', 'guptiwestup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(552, 'Gupti(East]', 'গুপ্তি(পূর্ব]', 'guptieastup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(553, 'Paikpara(North]', 'পাইকপাড়া(উত্তর]', 'paikparanorthup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(554, 'Paikpara(South]', 'পাইকপাড়া(দক্ষিণ]', 'paikparasouthup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(555, 'Gobindapur(North]', 'গবিন্দপুর(উত্তর]', 'gobindapurnorthup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(556, 'Gobindapur(South]', 'গবিন্দপুর(দক্ষিণ]', 'gobindapursouthup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(557, 'Chardukhia(East]', 'চরদুখিয়া(পূর্ব]', 'chardukhiaeastup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(558, 'Chardukhia(West]', 'চরদুঃখিয়া(পশ্চিম]', 'chardukhiawestup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(559, 'Faridgonj(South]', 'ফরিদ্গঞ্জ(দক্ষিণ]', 'faridgonjsouthup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(560, 'Rupsha(South]', 'রুপসা(দক্ষিণ]', 'rupshasouthup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(561, 'Rupsha(North]', 'রুপসা(উত্তর]', 'rupshanorthup . chandpur . gov . bd', 1, 59, NULL, NULL, NULL, NULL),
(562, 'Hamsadi(North]', 'হামছাদী(উত্তর]', 'northhamsadiup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(563, 'Hamsadi(South]', 'হামছাদী(দক্ষিন]', 'southhamsadiup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(564, 'Dalalbazar', 'দালাল বাজার', 'dalalbazarup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(565, 'Charruhita', 'চররুহিতা', 'charruhitaup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(566, 'Parbotinagar', 'পার্বতীনগর', 'parbotinagarup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(567, 'Bangakha', 'বাঙ্গাখাঁ', 'bangakhaup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(568, 'Dattapara', 'দত্তপাড়া', 'dattaparaup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(569, 'Basikpur', 'বশিকপুর', 'basikpurup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(570, 'Chandrogonj', 'চন্দ্রগঞ্জ', 'chandrogonjup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(571, 'Nourthjoypur', 'উত্তর জয়পুর', 'nourthjoypurup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(572, 'Hazirpara', 'হাজিরপাড়া', 'hazirparaup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(573, 'Charshahi', 'চরশাহী', 'charshahiup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(574, 'Digli', 'দিঘলী', 'digliup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(575, 'Laharkandi', 'লাহারকান্দি', 'laharkandiup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(576, 'Vobanigonj', 'ভবানীগঞ্জ', 'vobanigonjup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(577, 'Kusakhali', 'কুশাখালী', 'kusakhaliup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(578, 'Sakchor', 'শাকচর', 'sakchorup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(579, 'Tearigonj', 'তেয়ারীগঞ্জ', 'tearigonjup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(580, 'Tumchor', 'টুমচর', 'tumchorup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(581, 'Charramoni Mohon', 'চররমনী মোহন', 'charramonimohonup . lakshmipur . gov . bd', 1, 60, NULL, NULL, NULL, NULL),
(582, 'Charkalkini', 'চর কালকিনি', 'charkalkiniup . lakshmipur . gov . bd', 1, 61, NULL, NULL, NULL, NULL),
(583, 'Shaheberhat', 'সাহেবেরহাট', 'shaheberhatup . lakshmipur . gov . bd', 1, 61, NULL, NULL, NULL, NULL),
(584, 'Char Martin', 'চর মার্টিন', 'charmartinup . lakshmipur . gov . bd', 1, 61, NULL, NULL, NULL, NULL),
(585, 'Char Folcon', 'চর ফলকন', 'charfolconup . lakshmipur . gov . bd', 1, 61, NULL, NULL, NULL, NULL),
(586, 'Patarirhat', 'পাটারীরহাট', 'patarirhatup . lakshmipur . gov . bd', 1, 61, NULL, NULL, NULL, NULL),
(587, 'Hajirhat', 'হাজিরহাট', 'hajirhatup . lakshmipur . gov . bd', 1, 61, NULL, NULL, NULL, NULL),
(588, 'Char Kadira', 'চর কাদিরা', 'charkadiraup . lakshmipur . gov . bd', 1, 61, NULL, NULL, NULL, NULL),
(589, 'Torabgonj', 'তোরাবগঞ্জ', 'torabgonjup . lakshmipur . gov . bd', 1, 61, NULL, NULL, NULL, NULL),
(590, 'Charlorench', 'চর লরেঞ্চ', 'charlorenchup . lakshmipur . gov . bd', 1, 61, NULL, NULL, NULL, NULL),
(591, 'North Char Ababil', 'উত্তর চর আবাবিল', 'northcharababilup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(592, 'North Char Bangshi', 'উত্তর চর বংশী', 'northcharbangshiup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(593, 'Char Mohana', 'চর মোহনা', 'charmohanaup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(594, 'Sonapur', 'সোনাপুর', 'sonapurup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(595, 'Charpata', 'চর পাতা', 'charpataup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(596, 'Bamni', 'বামনী', 'bamniup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(597, 'South Char Bangshi', 'দক্ষিন চর বংশী', 'southcharbangshiup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(598, 'South Char Ababil', 'দক্ষিন চর আবাবিল', 'southcharababilup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(599, 'Raipur', 'রায়পুর', 'raipurup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(600, 'Keora', 'কেরোয়া', 'keoraup . lakshmipur . gov . bd', 1, 62, NULL, NULL, NULL, NULL),
(601, 'Char Poragacha', 'চর পোড়াগাছা', 'charporagachaup . lakshmipur . gov . bd', 1, 63, NULL, NULL, NULL, NULL),
(602, 'Charbadam', 'চর বাদাম', 'charbadamup . lakshmipur . gov . bd', 1, 63, NULL, NULL, NULL, NULL),
(603, 'Char Abdullah', 'চর আবদুল্যাহ', 'charabdullahup . lakshmipur . gov . bd', 1, 63, NULL, NULL, NULL, NULL),
(604, 'Alxendar', 'আলেকজান্ডার', 'alxendarup . lakshmipur . gov . bd', 1, 63, NULL, NULL, NULL, NULL),
(605, 'Char Algi', 'চর আলগী', 'charalgiup . lakshmipur . gov . bd', 1, 63, NULL, NULL, NULL, NULL),
(606, 'Char Ramiz', 'চর রমিজ', 'charramizup . lakshmipur . gov . bd', 1, 63, NULL, NULL, NULL, NULL),
(607, 'Borokheri', 'বড়খেড়ী', 'borokheriup . lakshmipur . gov . bd', 1, 63, NULL, NULL, NULL, NULL),
(608, 'Chargazi', 'চরগাজী', 'chargaziup . lakshmipur . gov . bd', 1, 63, NULL, NULL, NULL, NULL),
(609, 'Kanchanpur', 'কাঞ্চনপুর', 'kanchanpurup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(610, 'Noagaon', 'নোয়াগাঁও', 'noagaonup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(611, 'Bhadur', 'ভাদুর', 'bhadurup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(612, 'Ichhapur', 'ইছাপুর', 'ichhapurup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(613, 'Chandipur', 'চন্ডিপুর', 'chandipurup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(614, 'Lamchar', 'লামচর', 'lamcharup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(615, 'Darbeshpur', 'দরবেশপুর', 'darbeshpurup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(616, 'Karpara', 'করপাড়া', 'karparaup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(617, 'Bholakot', 'ভোলাকোট', 'bholakotup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(618, 'Bhatra', 'ভাটরা', 'bhatraup . lakshmipur . gov . bd', 1, 64, NULL, NULL, NULL, NULL),
(619, 'Rajanagar', 'রাজানগর', 'rajanagarup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(620, 'Hosnabad', 'হোছনাবাদ', 'hosnabadup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(621, 'Swanirbor Rangunia', 'স্বনির্ভর রাঙ্গুনিয়া', 'swanirborranguniaup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(622, 'Mariumnagar', 'মরিয়মনগর', 'mariumnagarup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(623, 'Parua', 'পারুয়া', 'paruaup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(624, 'Pomra', 'পোমরা', 'pomraup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(625, 'Betagi', 'বেতাগী', 'betagiup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(626, 'Sharafbhata', 'সরফভাটা', 'sharafbhataup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(627, 'Shilok', 'শিলক', 'shilokup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(628, 'Chandraghona', 'চন্দ্রঘোনা', 'chandraghonaup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(629, 'Kodala', 'কোদালা', 'kodalaup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(630, 'Islampur', 'ইসলামপুর', 'islampurup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(631, 'South Rajanagar', 'দক্ষিণ রাজানগর', 'southrajanagarup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(632, 'Lalanagar', 'লালানগর', 'lalanagarup . chittagong . gov . bd', 1, 65, NULL, NULL, NULL, NULL),
(633, 'Kumira', 'কুমিরা', 'kumiraup . chittagong . gov . bd', 1, 66, NULL, NULL, NULL, NULL),
(634, 'Banshbaria', 'বাঁশবারীয়া', 'banshbariaup . chittagong . gov . bd', 1, 66, NULL, NULL, NULL, NULL),
(635, 'Barabkunda', 'বারবকুন্ড', 'barabkundaup . chittagong . gov . bd', 1, 66, NULL, NULL, NULL, NULL),
(636, 'Bariadyala', 'বাড়িয়াডিয়ালা', 'bariadyalaup . chittagong . gov . bd', 1, 66, NULL, NULL, NULL, NULL),
(637, 'Muradpur', 'মুরাদপুর', 'muradpurup . chittagong . gov . bd', 1, 66, NULL, NULL, NULL, NULL),
(638, 'Saidpur', 'সাঈদপুর', 'saidpurup . chittagong . gov . bd', 1, 66, NULL, NULL, NULL, NULL),
(639, 'Salimpur', 'সালিমপুর', 'salimpurup . chittagong . gov . bd', 1, 66, NULL, NULL, NULL, NULL),
(640, 'Sonaichhari', 'সোনাইছড়ি', 'sonaichhariup . chittagong . gov . bd', 1, 66, NULL, NULL, NULL, NULL),
(641, 'Bhatiari', 'ভাটিয়ারী', 'bhatiariup . chittagong . gov . bd', 1, 66, NULL, NULL, NULL, NULL),
(642, 'Korerhat', 'করেরহাট', 'korerhatup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(643, 'Hinguli', 'হিংগুলি', 'hinguliup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(644, 'Jorarganj', 'জোরারগঞ্জ', 'jorarganjup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(645, 'Dhoom', 'ধুম', 'dhoomup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(646, 'Osmanpur', 'ওসমানপুর', 'osmanpurup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(647, 'Ichakhali', 'ইছাখালী', 'ichakhaliup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(648, 'Katachhara', 'কাটাছরা', 'katachharaup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(649, 'Durgapur', 'দূর্গাপুর', 'durgapurup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(650, 'Mirsharai', 'মীরসরাই', 'mirsharaiup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(651, 'Mithanala', 'মিঠানালা', 'mithanalaup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(652, 'Maghadia', 'মঘাদিয়া', 'maghadiaup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(653, 'Khaiyachhara', 'খৈয়াছরা', 'khaiyachharaup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(654, 'Mayani', 'মায়ানী', 'mayaniup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(655, 'Haitkandi', 'হাইতকান্দি', 'haitkandiup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(656, 'Wahedpur', 'ওয়াহেদপুর', 'wahedpurup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(657, 'Saherkhali', 'সাহেরখালী', 'saherkhaliup . chittagong . gov . bd', 1, 67, NULL, NULL, NULL, NULL),
(658, 'Asia', 'আশিয়া', 'asiaup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(659, 'Kachuai', 'কাচুয়াই', 'kachuaiup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(660, 'Kasiais', 'কাশিয়াইশ', 'kasiaisup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(661, 'Kusumpura', 'কুসুমপুরা', 'kusumpuraup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(662, 'Kelishahar', 'কেলিশহর', 'kelishaharup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(663, 'Kolagaon', 'কোলাগাঁও', 'kolagaonup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(664, 'Kharana', 'খরনা', 'kharanaup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(665, 'Char Patharghata', 'চর পাথরঘাটা', 'charpatharghataup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(666, 'Char Lakshya', 'চর লক্ষ্যা', 'charlakshyaup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(667, 'Chanhara', 'ছনহরা', 'chanharaup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(668, 'Janglukhain', 'জঙ্গলখাইন', 'janglukhainup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(669, 'Jiri', 'জিরি', 'jiriup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(670, 'Juldha', 'জুলধা', 'juldhaup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(671, 'Dakkhin Bhurshi', 'দক্ষিণ ভূর্ষি', 'dakhinbhurshiup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(672, 'Dhalghat', 'ধলঘাট', 'dhalghatup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(673, 'Bara Uthan', 'বড় উঠান', 'barauthanup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(674, 'Baralia', 'বরলিয়া', 'baraliaup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(675, 'Bhatikhain', 'ভাটিখাইন', 'bhatikhainup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(676, 'Sikalbaha', 'শিকলবাহা', 'sikalbahaup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(677, 'Sobhandandi', 'শোভনদন্ডী', 'sobhandandiup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(678, 'Habilasdwi', 'হাবিলাসদ্বীপ', 'habilasdwipup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(679, 'Haidgaon', 'হাইদগাঁও', 'haidgaonup . chittagong . gov . bd', 1, 68, NULL, NULL, NULL, NULL),
(680, 'Rahmatpur', 'রহমতপুর', 'rahmatpurup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(681, 'Harispur', 'হরিশপুর', 'harispurup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(682, 'Kalapania', 'কালাপানিয়া', 'kalapaniaup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(683, 'Amanullah', 'আমানউল্যা', 'amanullahup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(684, 'Santoshpur', 'সন্তোষপুর', 'santoshpurup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(685, 'Gachhua', 'গাছুয়া', 'gachhuaup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(686, 'Bauria', 'বাউরিয়া', 'bauriaup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(687, 'Haramia', 'হারামিয়া', 'haramiaup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(688, 'Magdhara', 'মগধরা', 'magdharaup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(689, 'Maitbhanga', 'মাইটভাঙ্গা', 'maitbhangaup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(690, 'Sarikait', 'সারিকাইত', 'sarikaitup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(691, 'Musapur', 'মুছাপুর', 'musapurup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(692, 'Azimpur', 'আজিমপুর', 'azimpurup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(693, 'Urirchar', 'উড়িরচর', 'urircharup . chittagong . gov . bd', 1, 69, NULL, NULL, NULL, NULL),
(694, 'Pukuria', 'পুকুরিয়া', 'pukuriaup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(695, 'Sadhanpur', 'সাধনপুর', 'sadhanpurup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(696, 'Khankhanabad', 'খানখানাবাদ', 'khankhanabadup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(697, 'Baharchhara', 'বাহারছড়া', 'baharchharaup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(698, 'Kalipur', 'কালীপুর', 'kalipurup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(699, 'Bailchhari', 'বৈলছড়ি', 'bailchhariup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(700, 'Katharia', 'কাথরিয়া', 'kathariaup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(701, 'Saral', 'সরল', 'saralup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(702, 'Silk', 'শীলকুপ', 'silkupup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(703, 'Chambal', 'চাম্বল', 'chambalup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(704, 'Gandamara', 'গন্ডামারা', 'gandamaraup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(705, 'Sekherkhil', 'শেখেরখীল', 'sekherkhilup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(706, 'Puichhari', 'পুঁইছড়ি', 'puichhariup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(707, 'Chhanua', 'ছনুয়া', 'chhanuaup . chittagong . gov . bd', 1, 70, NULL, NULL, NULL, NULL),
(708, 'Kandhurkhil', 'কধুরখীল', 'kandhurkhilup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(709, 'Pashchim Gamdandi', 'পশ্চিম গোমদন্ডী', 'pashchimgamdandiup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(710, 'Purba Gomdandi', 'পুর্ব গোমদন্ডী', 'purbagomdandiup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(711, 'Sakpura', 'শাকপুরা', 'sakpuraup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(712, 'Saroatali', 'সারোয়াতলী', 'saroataliup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(713, 'Popadia', 'পোপাদিয়া', 'popadiaup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(714, 'Charandwi', 'চরনদ্বীপ', 'charandwipup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(715, 'Sreepur - Kharandwi', 'শ্রীপুর - খরন্দীপ', 'sreepurkharandwipup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(716, 'Amuchia', 'আমুচিয়া', 'amuchiaup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(717, 'Ahla Karaldenga', 'আহল্লা করলডেঙ্গা', 'ahlakaraldengaup . chittagong . gov . bd', 1, 71, NULL, NULL, NULL, NULL),
(718, 'Boirag', 'বৈরাগ', 'boiragup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(719, 'Barasat', 'বারশত', 'barasatup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(720, 'Raipur', 'রায়পুর', 'raipurup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(721, 'Battali', 'বটতলী', 'battaliup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(722, 'Barumchara', 'বরম্নমচড়া', 'barumcharaup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(723, 'Baroakhan', 'বারখাইন', 'baroakhanup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(724, 'Anwara', 'আনোয়ারা', 'anwaraup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(725, 'Chatari', 'চাতরী', 'chatariup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(726, 'Paraikora', 'পরৈকোড়া', 'paraikoraup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(727, 'Haildhar', 'হাইলধর', 'haildharup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(728, 'Juidandi', 'জুঁইদন্ডী', 'juidandiup . chittagong . gov . bd', 1, 72, NULL, NULL, NULL, NULL),
(729, 'Kanchanabad', 'কাঞ্চনাবাদ', 'kanchanabadup . chittagong . gov . bd', 1, 73, NULL, NULL, NULL, NULL),
(730, 'Joara', 'জোয়ারা', 'joaraup . chittagong . gov . bd', 1, 73, NULL, NULL, NULL, NULL),
(731, 'Barkal', 'বরকল', 'barkalup . chittagong . gov . bd', 1, 73, NULL, NULL, NULL, NULL),
(732, 'Barama', 'বরমা', 'baramaup . chittagong . gov . bd', 1, 73, NULL, NULL, NULL, NULL),
(733, 'Bailtali', 'বৈলতলী', 'bailtaliup . chittagong . gov . bd', 1, 73, NULL, NULL, NULL, NULL),
(734, 'Satbaria', 'সাতবাড়িয়া', 'satbariaup . chittagong . gov . bd', 1, 73, NULL, NULL, NULL, NULL),
(735, 'Hashimpur', 'হাশিমপুর', 'hashimpurup . chittagong . gov . bd', 1, 73, NULL, NULL, NULL, NULL),
(736, 'Dohazari', 'দোহাজারী', 'dohazariup . chittagong . gov . bd', 1, 73, NULL, NULL, NULL, NULL),
(737, 'Dhopachhari', 'ধোপাছড়ী', 'dhopachhariup . chittagong . gov . bd', 1, 73, NULL, NULL, NULL, NULL),
(738, 'Charati', 'চরতী', 'charatiup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(739, 'Khagaria', 'খাগরিয়া', 'khagariaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(740, 'Nalua', 'নলুয়া', 'naluaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(741, 'Kanchana', 'কাঞ্চনা', 'kanchanaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(742, 'Amilaisi', 'আমিলাইশ', 'amilaisiup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(743, 'Eochiai', 'এওচিয়া', 'eochiaiup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(744, 'Madarsa', 'মাদার্শা', 'madarsaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(745, 'Dhemsa', 'ঢেমশা', 'dhemsaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(746, 'Paschim Dhemsa', 'পশ্চিম ঢেমশা', 'paschimdhemsaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(747, 'Keochia', 'কেঁওচিয়া', 'keochiaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(748, 'Kaliais', 'কালিয়াইশ', 'kaliaisup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(749, 'Bazalia', 'বাজালিয়া', 'bazaliaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(750, 'Puranagar', 'পুরানগড়', 'puranagarup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(751, 'Sadaha', 'ছদাহা', 'sadahaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(752, 'Satkania', 'সাতকানিয়া', 'satkaniaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(753, 'Sonakania', 'সোনাকানিয়া', 'sonakaniaup . chittagong . gov . bd', 1, 74, NULL, NULL, NULL, NULL),
(754, 'Padua', 'পদুয়া', 'paduaup . chittagong . gov . bd', 1, 75, NULL, NULL, NULL, NULL),
(755, 'Barahatia', 'বড়হাতিয়া', 'barahatiaup . chittagong . gov . bd', 1, 75, NULL, NULL, NULL, NULL),
(756, 'Amirabad', 'আমিরাবাদ', 'amirabadup . chittagong . gov . bd', 1, 75, NULL, NULL, NULL, NULL),
(757, 'Charamba', 'চরম্বা', 'charambaup . chittagong . gov . bd', 1, 75, NULL, NULL, NULL, NULL),
(758, 'Kalauzan', 'কলাউজান', 'kalauzanup . chittagong . gov . bd', 1, 75, NULL, NULL, NULL, NULL),
(759, 'Lohagara', 'লোহাগাড়া', 'lohagaraup . chittagong . gov . bd', 1, 75, NULL, NULL, NULL, NULL),
(760, 'Putibila', 'পুটিবিলা', 'putibilaup . chittagong . gov . bd', 1, 75, NULL, NULL, NULL, NULL),
(761, 'Chunati', 'চুনতি', 'chunatiup . chittagong . gov . bd', 1, 75, NULL, NULL, NULL, NULL),
(762, 'Adhunagar', 'আধুনগর', 'adhunagarup . chittagong . gov . bd', 1, 75, NULL, NULL, NULL, NULL),
(763, 'Farhadabad', 'ফরহাদাবাদ', 'farhadabadup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(764, 'Dhalai', 'ধলই', 'dhalaiup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(765, 'Mirjapur', 'মির্জাপুর', 'mirjapurup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(766, 'Nangolmora', 'নাঙ্গলমোরা', 'nangolmoraup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(767, 'Gomanmordan', 'গুমানমর্দ্দন', 'gomanmordanup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(768, 'Chipatali', 'ছিপাতলী', 'chipataliup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(769, 'Mekhal', 'মেখল', 'mekhalup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(770, 'Garduara', 'গড়দুয়ারা', 'garduaraup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(771, 'Fathepur', 'ফতেপুর', 'fathepurup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(772, 'Chikondandi', 'চিকনদন্ডী', 'chikondandiup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(773, 'Uttar Madrasha', 'উত্তর মাদার্শা', 'uttarmadrashaup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(774, 'Dakkin Madrasha', 'দক্ষিন মাদার্শা', 'dakkinmadrashaup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(775, 'Sikarpur', 'শিকারপুর', 'sikarpurup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(776, 'Budirchar', 'বুডিরশ্চর', 'budircharup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(777, 'Hathazari', 'হাটহাজারী', 'hathazariup . chittagong . gov . bd', 1, 76, NULL, NULL, NULL, NULL),
(778, 'Dharmapur', 'ধর্মপুর', 'dharmapurup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(779, 'Baganbazar', 'বাগান বাজার', 'baganbazarup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(780, 'Dantmara', 'দাঁতমারা', 'dantmaraup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(781, 'Narayanhat', 'নারায়নহাট', 'narayanhatup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(782, 'Bhujpur', 'ভূজপুর', 'bhujpurup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(783, 'Harualchari', 'হারুয়ালছড়ি', 'harualchariup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(784, 'Paindong', 'পাইনদং', 'paindongup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(785, 'Kanchannagor', 'কাঞ্চনগর', 'kanchannagorup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(786, 'Sunderpur', 'সুনদরপুর', 'sunderpurup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(787, 'Suabil', 'সুয়াবিল', 'Suabilup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(788, 'Abdullapur', 'আবদুল্লাপুর', 'abdullapurup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(789, 'Samitirhat', 'সমিতির হাট', 'samitirhatup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(790, 'Jafathagar', 'জাফতনগর', 'jafathagarup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(791, 'Bokhtapur', 'বক্তপুর', 'bokhtapurup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(792, 'Roshangiri', 'রোসাংগিরী', 'roshangiriup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(793, 'Nanupur', 'নানুপুর', 'nanupurup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(794, 'Lelang', 'লেলাং', 'lelangup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(795, 'Daulatpur', 'দৌলতপুর', 'daulatpurup . chittagong . gov . bd', 1, 77, NULL, NULL, NULL, NULL),
(796, 'Raozan', 'রাউজান', 'raozanup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(797, 'Bagoan', 'বাগোয়ান', 'bagoanup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(798, 'Binajuri', 'বিনাজুরী', 'binajuriup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(799, 'Chikdair', 'চিকদাইর', 'chikdairup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(800, 'Dabua', 'ডাবুয়া', 'dabuaup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(801, 'Purbagujra', 'পূর্ব গুজরা', 'purbagujraup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(802, 'Paschim Gujra', 'পশ্চিম গুজরা', 'paschimgujraup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(803, 'Gohira', 'গহিরা', 'gohiraup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(804, 'Holdia', 'হলদিয়া', 'holdiaup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(805, 'Kodolpur', 'কদলপূর', 'kodolpurup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(806, 'Noapara', 'নোয়াপাড়া', 'noaparaup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(807, 'Pahartali', 'পাহাড়তলী', 'pahartaliup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(808, 'Urkirchar', 'উড়কিরচর', 'urkircharup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(809, 'Nowajushpur', 'নওয়াজিশপুর', 'nowajushpurup . chittagong . gov . bd', 1, 78, NULL, NULL, NULL, NULL),
(810, 'Char Patharghata', 'চর পাথরঘাটা', 'charpatharghataup . chittagong . gov . bd', 1, 79, NULL, NULL, NULL, NULL),
(811, 'Char Lakshya', 'চর লক্ষ্যা', 'charlakshyaup . chittagong . gov . bd', 1, 79, NULL, NULL, NULL, NULL),
(812, 'Juldha', 'জুলধা', 'juldhaup . chittagong . gov . bd', 1, 79, NULL, NULL, NULL, NULL),
(813, 'Barauthan', 'বড় উঠান', 'barauthanup . chittagong . gov . bd', 1, 79, NULL, NULL, NULL, NULL),
(814, 'Sikalbaha', 'শিকলবাহা', 'sikalbahaup . chittagong . gov . bd', 1, 79, NULL, NULL, NULL, NULL),
(815, 'Islamabad', 'ইসলামাবাদ', 'islamabadup . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(816, 'Islampur', 'ইসলামপুর', 'islampurup . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(817, 'Pokkhali', 'পোকখালী', 'pokkhaliup . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(818, 'Eidgaon', 'ঈদগাঁও', 'eidgaonup . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(819, 'Jalalabad', 'জালালাবাদ', 'jalalabadup . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(820, 'Chowfaldandi', 'চৌফলদন্ডী', 'chowfaldandi . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(821, 'Varuakhali', 'ভারুয়াখালী', 'varuakhaliup . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(822, 'Pmkhali', 'পিএমখালী', 'pmkhaliup . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(823, 'Khurushkhul', 'খুরুশকুল', 'khurushkhulup . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(824, 'Jhilongjha', 'ঝিলংঝা', 'jhilongjhaup . coxsbazar . gov . bd', 1, 80, NULL, NULL, NULL, NULL),
(825, 'Kakhara', 'কাকারা', 'Kakharaup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(826, 'Kaiar Bil', 'কাইয়ার বিল', 'kaiarbilup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(827, 'Konakhali', 'কোনাখালী', 'konakhaliup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(828, 'Khuntakhali', 'খুটাখালী', 'khuntakhaliup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(829, 'Chiringa', 'চিরিঙ্গা', 'chiringaup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(830, 'Demusia', 'ঢেমুশিয়া', 'demusiaup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(831, 'Dulahazara', 'ডুলাহাজারা', 'dulahazaraup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(832, 'Paschim Bara Bheola', 'পশ্চিম বড় ভেওলা', 'paschimbarabheolaup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(833, 'Badarkhali', 'বদরখালী', 'badarkhaliup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(834, 'Bamobil Chari', 'বামু বিলছড়ি', 'bamobilchariup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(835, 'Baraitali', 'বড়ইতলী', 'baraitaliup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(836, 'Bheola Manik Char', 'ভেওলা মানিক চর', 'bheolamanikcharup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(837, 'Saharbil', 'শাহারবিল', 'saharbilup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(838, 'Surajpur Manikpur', 'সুরজপুর মানিকপুর', 'surajpurmanikpurup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(839, 'Harbang', 'হারবাঙ্গ', 'harbangup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(840, 'Fashiakhali', 'ফাঁসিয়াখালী', 'fashiakhaliup . coxsbazar . gov . bd', 1, 81, NULL, NULL, NULL, NULL),
(841, 'Ali Akbar Deil', 'আলি আকবর ডেইল', 'aliakbardeilup . coxsbazar . gov . bd', 1, 82, NULL, NULL, NULL, NULL),
(842, 'Uttar Dhurung', 'উত্তর ধুরুং', 'uttardhurungup . coxsbazar . gov . bd', 1, 82, NULL, NULL, NULL, NULL),
(843, 'Kaiyarbil', 'কৈয়ারবিল', 'kaiyarbilup . coxsbazar . gov . bd', 1, 82, NULL, NULL, NULL, NULL),
(844, 'Dakshi Dhurung', 'দক্ষিণ ধুরুং', 'dakshidhurungup . coxsbazar . gov . bd', 1, 82, NULL, NULL, NULL, NULL),
(845, 'Baragho', 'বড়ঘোপ', 'baraghopup . coxsbazar . gov . bd', 1, 82, NULL, NULL, NULL, NULL),
(846, 'Lemsikhali', 'লেমসিখালী', 'lemsikhaliup . coxsbazar . gov . bd', 1, 82, NULL, NULL, NULL, NULL),
(847, 'Rajapalong', 'রাজাপালং', 'rajapalongup . coxsbazar . gov . bd', 1, 83, NULL, NULL, NULL, NULL),
(848, 'Jaliapalong', 'জালিয়াপালং', 'jaliapalongup . coxsbazar . gov . bd', 1, 83, NULL, NULL, NULL, NULL),
(849, 'Holdiapalong', 'হলদিয়াপালং', 'holdiapalongup . coxsbazar . gov . bd', 1, 83, NULL, NULL, NULL, NULL),
(850, 'Ratnapalong', 'রত্নাপালং', 'ratnapalongup . coxsbazar . gov . bd', 1, 83, NULL, NULL, NULL, NULL),
(851, 'Palongkhali', 'পালংখালী', 'palongkhali . coxsbazar . gov . bd', 1, 83, NULL, NULL, NULL, NULL),
(852, 'Boro Moheshkhali', 'বড় মহেশখালী', 'boramoheshkhaliup . coxsbazar . gov . bd', 1, 84, NULL, NULL, NULL, NULL),
(853, 'Choto Moheshkhali', 'ছোট মহেশখালী', 'chotamoheshkhaliup . coxsbazar . gov . bd', 1, 84, NULL, NULL, NULL, NULL),
(854, 'Shaplapur', 'শাপলাপুর', 'shaplapurup . coxsbazar . gov . bd', 1, 84, NULL, NULL, NULL, NULL),
(855, 'Kutubjum', 'কুতুবজোম', 'kutubjumup . coxsbazar . gov . bd', 1, 84, NULL, NULL, NULL, NULL),
(856, 'Hoanak', 'হোয়ানক', 'hoanakup . coxsbazar . gov . bd', 1, 84, NULL, NULL, NULL, NULL),
(857, 'Kalarmarchhara', 'কালারমারছড়া', 'kalarmarchharaup . coxsbazar . gov . bd', 1, 84, NULL, NULL, NULL, NULL),
(858, 'Matarbari', 'মাতারবাড়ী', 'matarbariup . coxsbazar . gov . bd', 1, 84, NULL, NULL, NULL, NULL),
(859, 'Dhalghata', 'ধলঘাটা', 'dhalghataup . coxsbazar . gov . bd', 1, 84, NULL, NULL, NULL, NULL),
(860, 'Ujantia', 'উজানটিয়া', 'ujantiaup . coxsbazar . gov . bd', 1, 85, NULL, NULL, NULL, NULL),
(861, 'Taitong', 'টাইটং', 'taitongup . coxsbazar . gov . bd', 1, 85, NULL, NULL, NULL, NULL),
(862, 'Pekua', 'পেকুয়া', 'pekuaup . coxsbazar . gov . bd', 1, 85, NULL, NULL, NULL, NULL),
(863, 'Barabakia', 'বড় বাকিয়া', 'barabakiaup . coxsbazar . gov . bd', 1, 85, NULL, NULL, NULL, NULL),
(864, 'Magnama', 'মগনামা', 'magnamaup . coxsbazar . gov . bd', 1, 85, NULL, NULL, NULL, NULL),
(865, 'Rajakhali', 'রাজাখালী', 'rajakhaliup . coxsbazar . gov . bd', 1, 85, NULL, NULL, NULL, NULL),
(866, 'Shilkhali', 'শীলখালী', 'shilkhaliup . coxsbazar . gov . bd', 1, 85, NULL, NULL, NULL, NULL),
(867, 'Fotekharkul', 'ফতেখাঁরকুল', 'fotekharkulup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(868, 'Rajarkul', 'রাজারকুল', 'rajarkulup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(869, 'Rashidnagar', 'রশীদনগর', 'rashidnagarup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(870, 'Khuniapalong', 'খুনিয়াপালং', 'khuniapalongup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(871, 'Eidghar', 'ঈদগড়', 'eidgharup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(872, 'Chakmarkul', 'চাকমারকুল', 'chakmarkulup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(873, 'Kacchapia', 'কচ্ছপিয়া', 'kacchapiaup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(874, 'Kauwarkho', 'কাউয়ারখোপ', 'kauwarkhopup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(875, 'Dakkhin Mithachhari', 'দক্ষিণ মিঠাছড়ি', 'dakkhinmithachhariup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(876, 'Jouarianala', 'জোয়ারিয়া নালা', 'jouarianalaup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(877, 'Garjoniya', 'গর্জনিয়া', 'garjoniyaup . coxsbazar . gov . bd', 1, 86, NULL, NULL, NULL, NULL),
(878, 'Subrang', 'সাবরাং', 'subrangup . coxsbazar . gov . bd', 1, 87, NULL, NULL, NULL, NULL),
(879, 'Baharchara', 'বাহারছড়া', 'baharcharaup . coxsbazar . gov . bd', 1, 87, NULL, NULL, NULL, NULL),
(880, 'Hnila', 'হ্নীলা', 'hnilaup . coxsbazar . gov . bd', 1, 87, NULL, NULL, NULL, NULL),
(881, 'Whykong', 'হোয়াইক্যং', 'whykongup . coxsbazar . gov . bd', 1, 87, NULL, NULL, NULL, NULL),
(882, 'Saintmartin', 'সেন্ট মার্টিন', 'saintmartinup . coxsbazar . gov . bd', 1, 87, NULL, NULL, NULL, NULL),
(883, 'Teknaf Sadar', 'টেকনাফ সদর', 'teknafsadarup . coxsbazar . gov . bd', 1, 87, NULL, NULL, NULL, NULL),
(884, 'Khagrachhari Sadar', 'খাগরাছড়ি সদর', 'sadarup . khagrachhari . gov . bd', 1, 88, NULL, NULL, NULL, NULL),
(885, 'Golabari', 'গোলাবাড়ী', 'golabariup . khagrachhari . gov . bd', 1, 88, NULL, NULL, NULL, NULL),
(886, 'Parachara', 'পেরাছড়া', 'paracharaup . khagrachhari . gov . bd', 1, 88, NULL, NULL, NULL, NULL),
(887, 'Kamalchari', 'কমলছড়ি', 'kamalchariup . khagrachhari . gov . bd', 1, 88, NULL, NULL, NULL, NULL),
(888, 'Merung', 'মেরুং', 'merungup . khagrachhari . gov . bd', 1, 89, NULL, NULL, NULL, NULL),
(889, 'Boalkhali', 'বোয়ালখালী', 'boalkhaliup . khagrachhari . gov . bd', 1, 89, NULL, NULL, NULL, NULL),
(890, 'Kabakhali', 'কবাখালী', 'kabakhaliup . khagrachhari . gov . bd', 1, 89, NULL, NULL, NULL, NULL),
(891, 'Dighinala', 'দিঘীনালা', 'dighinalaup . khagrachhari . gov . bd', 1, 89, NULL, NULL, NULL, NULL),
(892, 'Babuchara', 'বাবুছড়া', 'babucharaup . khagrachhari . gov . bd', 1, 89, NULL, NULL, NULL, NULL),
(893, 'Logang', 'লোগাং', 'logangup . khagrachhari . gov . bd', 1, 90, NULL, NULL, NULL, NULL),
(894, 'Changi', 'চেংগী', 'changiup . khagrachhari . gov . bd', 1, 90, NULL, NULL, NULL, NULL),
(895, 'Panchari', 'পানছড়ি', 'panchariup . khagrachhari . gov . bd', 1, 90, NULL, NULL, NULL, NULL),
(896, 'Latiban', 'লতিবান', 'latibanup . khagrachhari . gov . bd', 1, 90, NULL, NULL, NULL, NULL),
(897, 'Dullyatali', 'দুল্যাতলী', 'dullyataliup . khagrachhari . gov . bd', 1, 91, NULL, NULL, NULL, NULL),
(898, 'Barmachari', 'বর্মাছড়ি', 'barmachariup . khagrachhari . gov . bd', 1, 91, NULL, NULL, NULL, NULL),
(899, 'Laxmichhari', 'লক্ষীছড়ি', 'laxmichhariup . khagrachhari . gov . bd', 1, 91, NULL, NULL, NULL, NULL),
(900, 'Bhaibonchara', 'ভাইবোনছড়া', 'bhaiboncharaup . khagrachhari . gov . bd', 1, 92, NULL, NULL, NULL, NULL),
(901, 'Mahalchari', 'মহালছড়ি', 'mahalchariup . khagrachhari . gov . bd', 1, 92, NULL, NULL, NULL, NULL),
(902, 'Mobachari', 'মুবাছড়ি', 'mobachariup . khagrachhari . gov . bd', 1, 92, NULL, NULL, NULL, NULL),
(903, 'Kayanghat', 'ক্যায়াংঘাট', 'kayanghatup . khagrachhari . gov . bd', 1, 92, NULL, NULL, NULL, NULL),
(904, 'Maischari', 'মাইসছড়ি', 'maischariup . khagrachhari . gov . bd', 1, 92, NULL, NULL, NULL, NULL),
(905, 'Manikchari', 'মানিকছড়ি', 'manikchariup . khagrachhari . gov . bd', 1, 93, NULL, NULL, NULL, NULL),
(906, 'Batnatali', 'বাটনাতলী', 'batnataliup . khagrachhari . gov . bd', 1, 93, NULL, NULL, NULL, NULL),
(907, 'Jogyachola', 'যোগ্যছোলা', 'jogyacholaup . khagrachhari . gov . bd', 1, 93, NULL, NULL, NULL, NULL),
(908, 'Tintahari', 'তিনটহরী', 'tintahariup . khagrachhari . gov . bd', 1, 93, NULL, NULL, NULL, NULL),
(909, 'Ramgarh', 'রামগড়', 'ramgarhup . khagrachhari . gov . bd', 1, 94, NULL, NULL, NULL, NULL),
(910, 'Patachara', 'পাতাছড়া', 'patacharaup . khagrachhari . gov . bd', 1, 94, NULL, NULL, NULL, NULL),
(911, 'Hafchari', 'হাফছড়ি', 'hafchariup . khagrachhari . gov . bd', 1, 94, NULL, NULL, NULL, NULL),
(912, 'Taindong', 'তাইন্দং', 'taindongup . khagrachhari . gov . bd', 1, 95, NULL, NULL, NULL, NULL),
(913, 'Tabalchari', 'তবলছড়ি', 'tabalchariup . khagrachhari . gov . bd', 1, 95, NULL, NULL, NULL, NULL),
(914, 'Barnal', 'বর্ণাল', 'barnalup . khagrachhari . gov . bd', 1, 95, NULL, NULL, NULL, NULL),
(915, 'Gomti', 'গোমতি', 'gomtiup . khagrachhari . gov . bd', 1, 95, NULL, NULL, NULL, NULL),
(916, 'Balchari', 'বেলছড়ি', 'balchariup . khagrachhari . gov . bd', 1, 95, NULL, NULL, NULL, NULL),
(917, 'Matiranga', 'মাটিরাঙ্গা', 'matirangaup . khagrachhari . gov . bd', 1, 95, NULL, NULL, NULL, NULL),
(918, 'Guimara', 'গুইমারা', 'guimaraup . khagrachhari . gov . bd', 1, 95, NULL, NULL, NULL, NULL),
(919, 'Amtali', 'আমতলি', 'amtaliup . khagrachhari . gov . bd', 1, 95, NULL, NULL, NULL, NULL),
(920, 'Rajbila', 'রাজবিলা', 'rajbilaup . bandarban . gov . bd', 1, 97, NULL, NULL, NULL, NULL),
(921, 'Tongkaboty', 'টংকাবতী', 'tongkabotyup . bandarban . gov . bd', 1, 97, NULL, NULL, NULL, NULL),
(922, 'Suwalok', 'সুয়ালক', 'suwalokup . bandarban . gov . bd', 1, 97, NULL, NULL, NULL, NULL),
(923, 'Bandarban Sadar', 'বান্দরবান সদর', 'bandarbansadarup . bandarban . gov . bd', 1, 97, NULL, NULL, NULL, NULL),
(924, 'Kuhalong', 'কুহালং', 'kuhalongup . bandarban . gov . bd', 1, 97, NULL, NULL, NULL, NULL),
(925, 'Alikadam Sadar', 'আলীকদম সদর', 'alikadamsadarup . bandarban . gov . bd', 1, 98, NULL, NULL, NULL, NULL),
(926, 'Chwekhyong', 'চৈক্ষ্যং', 'chwekhyongup . bandarban . gov . bd', 1, 98, NULL, NULL, NULL, NULL),
(927, 'Naikhyongchari Sadar', 'নাইক্ষ্যংছড়ি সদর', 'naikhyongcharisadarup . bandarban . gov . bd', 1, 99, NULL, NULL, NULL, NULL),
(928, 'Gumdhum', 'ঘুমধুম', 'gumdhumup . bandarban . gov . bd', 1, 99, NULL, NULL, NULL, NULL),
(929, 'Baishari', 'বাইশারী', 'baishariup . bandarban . gov . bd', 1, 99, NULL, NULL, NULL, NULL),
(930, 'Sonaychari', 'সোনাইছড়ি', 'sonaychariup . bandarban . gov . bd', 1, 99, NULL, NULL, NULL, NULL),
(931, 'Duwchari', 'দোছড়ি', 'duwchariup . bandarban . gov . bd', 1, 99, NULL, NULL, NULL, NULL),
(932, 'Rowangchari Sadar', 'রোয়াংছড়ি সদর', 'rowangcharisadarup . bandarban . gov . bd', 1, 100, NULL, NULL, NULL, NULL),
(933, 'Taracha', 'তারাছা', 'tarachaup . bandarban . gov . bd', 1, 100, NULL, NULL, NULL, NULL),
(934, 'Alekyong', 'আলেক্ষ্যং', 'alekyongup . bandarban . gov . bd', 1, 100, NULL, NULL, NULL, NULL),
(935, 'Nawapotong', 'নোয়াপতং', 'nawapotongup . bandarban . gov . bd', 1, 100, NULL, NULL, NULL, NULL),
(936, 'Gajalia', 'গজালিয়া', 'gajaliaup . bandarban . gov . bd', 1, 101, NULL, NULL, NULL, NULL),
(937, 'Lama Sadar', 'লামা সদর', 'lamasadarup . bandarban . gov . bd', 1, 101, NULL, NULL, NULL, NULL),
(938, 'Fasiakhali', 'ফাসিয়াখালী', 'fasiakhaliup . bandarban . gov . bd', 1, 101, NULL, NULL, NULL, NULL),
(939, 'Fythong', 'ফাইতং', 'fythongup . bandarban . gov . bd', 1, 101, NULL, NULL, NULL, NULL),
(940, 'Rupushipara', 'রূপসীপাড়া', 'rupushiparaup . bandarban . gov . bd', 1, 101, NULL, NULL, NULL, NULL),
(941, 'Sarai', 'সরই', 'saraiup . bandarban . gov . bd', 1, 101, NULL, NULL, NULL, NULL),
(942, 'Aziznagar', 'আজিজনগর', 'aziznagarup . bandarban . gov . bd', 1, 101, NULL, NULL, NULL, NULL),
(943, 'Paind', 'পাইন্দু', 'painduup . bandarban . gov . bd', 1, 102, NULL, NULL, NULL, NULL),
(944, 'Ruma Sadar', 'রুমা সদর', 'rumasadarup . bandarban . gov . bd', 1, 102, NULL, NULL, NULL, NULL),
(945, 'Ramakreprangsa', 'রেমাক্রীপ্রাংসা', 'ramakreprangsaup . bandarban . gov . bd', 1, 102, NULL, NULL, NULL, NULL),
(946, 'Galanggya', 'গ্যালেংগ্যা', 'galanggyaup . bandarban . gov . bd', 1, 102, NULL, NULL, NULL, NULL),
(947, 'Remakre', 'রেমাক্রী', 'remakreup . bandarban . gov . bd', 1, 103, NULL, NULL, NULL, NULL),
(948, 'Tind', 'তিন্দু', 'tinduup . bandarban . gov . bd', 1, 103, NULL, NULL, NULL, NULL),
(949, 'Thanchi Sadar', 'থানচি সদর', 'thanchisadarup . bandarban . gov . bd', 1, 103, NULL, NULL, NULL, NULL),
(950, 'Balipara', 'বলিপাড়া', 'baliparaup . bandarban . gov . bd', 1, 103, NULL, NULL, NULL, NULL),
(951, 'Rajapur', 'রাজাপুর', 'rajapurup . sirajganj . gov . bd', 1, 104, NULL, NULL, NULL, NULL),
(952, 'Baradhul', 'বড়ধুল', 'baradhulup . sirajganj . gov . bd', 1, 104, NULL, NULL, NULL, NULL),
(953, 'Belkuchi Sadar', 'বেলকুচি সদর', 'belkuchisadarup . sirajganj . gov . bd', 1, 104, NULL, NULL, NULL, NULL),
(954, 'Dhukuriabera', 'ধুকুরিয়া বেড়া', 'dhukuriaberaup . sirajganj . gov . bd', 1, 104, NULL, NULL, NULL, NULL),
(955, 'Doulatpur', 'দৌলতপুর', 'doulatpurup . sirajganj . gov . bd', 1, 104, NULL, NULL, NULL, NULL),
(956, 'Bhangabari', 'ভাঙ্গাবাড়ী', 'bhangabariup . sirajganj . gov . bd', 1, 104, NULL, NULL, NULL, NULL),
(957, 'Baghutia', 'বাঘুটিয়া', 'baghutiaup . sirajganj . gov . bd', 1, 105, NULL, NULL, NULL, NULL),
(958, 'Gharjan', 'ঘোরজান', 'gharjanup . sirajganj . gov . bd', 1, 105, NULL, NULL, NULL, NULL),
(959, 'Khaskaulia', 'খাসকাউলিয়া', 'khaskauliaup . sirajganj . gov . bd', 1, 105, NULL, NULL, NULL, NULL),
(960, 'Khaspukuria', 'খাসপুকুরিয়া', 'khaspukuriaup . sirajganj . gov . bd', 1, 105, NULL, NULL, NULL, NULL),
(961, 'Omarpur', 'উমারপুর', 'omarpurup . sirajganj . gov . bd', 1, 105, NULL, NULL, NULL, NULL),
(962, 'Sadia Chandpur', 'সদিয়া চাঁদপুর', 'sadiachandpurup . sirajganj . gov . bd', 1, 105, NULL, NULL, NULL, NULL),
(963, 'Sthal', 'স্থল', 'sthalup . sirajganj . gov . bd', 1, 105, NULL, NULL, NULL, NULL),
(964, 'Bhadraghat', 'ভদ্রঘাট', 'bhadraghatup . sirajganj . gov . bd', 1, 106, NULL, NULL, NULL, NULL),
(965, 'Jamtail', 'জামতৈল', 'jamtailup . sirajganj . gov . bd', 1, 106, NULL, NULL, NULL, NULL),
(966, 'Jhawail', 'ঝাঐল', 'jhawailup . sirajganj . gov . bd', 1, 106, NULL, NULL, NULL, NULL),
(967, 'Roydaulatpur', 'রায়দৌলতপুর', 'roydaulatpurup . sirajganj . gov . bd', 1, 106, NULL, NULL, NULL, NULL),
(968, 'Chalitadangha', 'চালিতাডাঙ্গা', 'chalitadanghaup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(969, 'Chargirish', 'চরগিরিশ', 'chargirishup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(970, 'Gandail', 'গান্ধাইল', 'gandailup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(971, 'Kazipur Sadar', 'কাজিপুর সদর', 'kazipursadarup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(972, 'Khasrajbari', 'খাসরাজবাড়ী', 'khasrajbariup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(973, 'Maijbari', 'মাইজবাড়ী', 'maijbariup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(974, 'Monsur Nagar', 'মনসুর নগর', 'monsurnagarup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(975, 'Natuarpara', 'নাটুয়ারপাড়া', 'natuarparaup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(976, 'Nishchintapur', 'নিশ্চিন্তপুর', 'nishchintapurup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(977, 'Sonamukhi', 'সোনামুখী', 'sonamukhiup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(978, 'Subhagacha', 'শুভগাছা', 'subhagachaup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(979, 'Tekani', 'তেকানী', 'tekaniup . sirajganj . gov . bd', 1, 107, NULL, NULL, NULL, NULL),
(980, 'Brommogacha', 'ব্রহ্মগাছা', 'brommogachaup . sirajganj . gov . bd', 1, 108, NULL, NULL, NULL, NULL),
(981, 'Chandaikona', 'চান্দাইকোনা', 'chandaikonaup . sirajganj . gov . bd', 1, 108, NULL, NULL, NULL, NULL),
(982, 'Dhamainagar', 'ধামাইনগর', 'dhamainagarup . sirajganj . gov . bd', 1, 108, NULL, NULL, NULL, NULL),
(983, 'Dhangora', 'ধানগড়া', 'dhangoraup . sirajganj . gov . bd', 1, 108, NULL, NULL, NULL, NULL),
(984, 'Dhubil', 'ধুবিল', 'dhubilup . sirajganj . gov . bd', 1, 108, NULL, NULL, NULL, NULL),
(985, 'Ghurka', 'ঘুড়কা', 'ghurkaup . sirajganj . gov . bd', 1, 108, NULL, NULL, NULL, NULL),
(986, 'Nalka', 'নলকা', 'nalkaup . sirajganj . gov . bd', 1, 108, NULL, NULL, NULL, NULL),
(987, 'Pangashi', 'পাঙ্গাসী', 'pangashiup . sirajganj . gov . bd', 1, 108, NULL, NULL, NULL, NULL),
(988, 'Sonakhara', 'সোনাখাড়া', 'sonakharaup . sirajganj . gov . bd', 1, 108, NULL, NULL, NULL, NULL),
(989, 'Beltail', 'বেলতৈল', 'beltailup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(990, 'Jalalpur', 'জালালপুর', 'jalalpurup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(991, 'Kayempure', 'কায়েমপুর', 'kayempureup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(992, 'Garadah', 'গাড়াদহ', 'garadahup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(993, 'Potazia', 'পোতাজিয়া', 'potaziaup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(994, 'Rupbati', 'রূপবাটি', 'rupbatiup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(995, 'Gala', 'গালা', 'galaup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(996, 'Porzona', 'পোরজনা', 'porzonaup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(997, 'Habibullah Nagar', 'হাবিবুল্লাহ নগর', 'habibullahnagarup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(998, 'Khukni', 'খুকনী', 'khukniup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(999, 'Koizuri', 'কৈজুরী', 'koizuriup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL);
INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(1000, 'Sonatoni', 'সোনাতনী', 'sonatoniup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(1001, 'Narina', 'নরিনা', 'narinaup . sirajganj . gov . bd', 1, 109, NULL, NULL, NULL, NULL),
(1002, 'Bagbati', 'বাগবাটি', 'bagbatiup . sirajganj . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1003, 'Ratankandi', 'রতনকান্দি', 'ratankandiup . sirajganj . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1004, 'Bohuli', 'বহুলী', 'bohuliup . sirajganj . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1005, 'Sheyalkol', 'শিয়ালকোল', 'sheyalkolup . sirajganj . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1006, 'Khokshabari', 'খোকশাবাড়ী', 'khokshabariup . nilphamari . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1007, 'Songacha', 'ছোনগাছা', 'songachaup . sirajganj . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1008, 'Mesra', 'মেছড়া', 'mesraup . sirajganj . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1009, 'Kowakhola', 'কাওয়াখোলা', 'kowakholaup . sirajganj . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1010, 'Kaliahoripur', 'কালিয়াহরিপুর', 'kaliahoripurup . sirajganj . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1011, 'Soydabad', 'সয়দাবাদ', 'soydabadup . sirajganj . gov . bd', 1, 110, NULL, NULL, NULL, NULL),
(1012, 'Baruhas', 'বারুহাস', 'baruhasup . sirajganj . gov . bd', 1, 111, NULL, NULL, NULL, NULL),
(1013, 'Talam', 'তালম', 'talamup . sirajganj . gov . bd', 1, 111, NULL, NULL, NULL, NULL),
(1014, 'Soguna', 'সগুনা', 'sogunaup . sirajganj . gov . bd', 1, 111, NULL, NULL, NULL, NULL),
(1015, 'Magura Binod', 'মাগুড়া বিনোদ', 'magurabinodup . sirajganj . gov . bd', 1, 111, NULL, NULL, NULL, NULL),
(1016, 'Naogaon', 'নওগাঁ', 'naogaonup . sirajganj . gov . bd', 1, 111, NULL, NULL, NULL, NULL),
(1017, 'Tarash Sadar', 'তাড়াশ সদর', 'tarashsadarup . sirajganj . gov . bd', 1, 111, NULL, NULL, NULL, NULL),
(1018, 'Madhainagar', 'মাধাইনগর', 'madhainagarup . sirajganj . gov . bd', 1, 111, NULL, NULL, NULL, NULL),
(1019, 'Deshigram', 'দেশীগ্রাম', 'deshigramup . sirajganj . gov . bd', 1, 111, NULL, NULL, NULL, NULL),
(1020, 'Ullapara Sadar', 'উল্লাপাড়া সদর', 'ullaparasadarup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1021, 'Ramkrisnopur', 'রামকৃষ্ণপুর', 'ramkrisnopurup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1022, 'Bangala', 'বাঙ্গালা', 'bangalaup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1023, 'Udhunia', 'উধুনিয়া', 'udhuniaup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1024, 'Boropangashi', 'বড়পাঙ্গাসী', 'boropangashiup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1025, 'Durga Nagar', 'দুর্গা নগর', 'durganagarup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1026, 'Purnimagati', 'পূর্ণিমাগাতী', 'purnimagatiup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1027, 'Salanga', 'সলঙ্গা', 'salangaup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1028, 'Hatikumrul', 'হটিকুমরুল', 'hatikumrulup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1029, 'Borohor', 'বড়হর', 'borohorup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1030, 'Ponchocroshi', 'পঞ্চক্রোশী', 'ponchocroshiup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1031, 'Salo', 'সলপ', 'salopup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1032, 'Mohonpur', 'মোহনপুর', 'mohonpurup . sirajganj . gov . bd', 1, 112, NULL, NULL, NULL, NULL),
(1033, 'Vaina', 'ভায়না', 'vainaup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1034, 'Tantibonda', 'তাঁতিবন্দ', 'tantibondaup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1035, 'Manikhat', 'মানিকহাট', 'manikhatup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1036, 'Dulai', 'দুলাই', 'dulaiup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1037, 'Ahammadpur', 'আহম্মদপুর', 'ahammadpurup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1038, 'Raninagar', 'রাণীনগর', 'raninagarup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1039, 'Satbaria', 'সাতবাড়ীয়া', 'satbariaup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1040, 'Hatkhali', 'হাটখালী', 'hatkhaliup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1041, 'Nazirganj', 'নাজিরগঞ্জ', 'nazirganjup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1042, 'Sagorkandi', 'সাগরকান্দি', 'sagorkandiup . pabna . gov . bd', 1, 113, NULL, NULL, NULL, NULL),
(1043, 'Sara', 'সাঁড়া', 'saraup . pabna . gov . bd', 1, 114, NULL, NULL, NULL, NULL),
(1044, 'Pakshi', 'পাকশী', 'pakshiup . pabna . gov . bd', 1, 114, NULL, NULL, NULL, NULL),
(1045, 'Muladuli', 'মুলাডুলি', 'muladuliup . pabna . gov . bd', 1, 114, NULL, NULL, NULL, NULL),
(1046, 'Dashuria', 'দাশুরিয়া', 'dashuriaup . pabna . gov . bd', 1, 114, NULL, NULL, NULL, NULL),
(1047, 'Silimpur', 'ছলিমপুর', 'silimpurup . pabna . gov . bd', 1, 114, NULL, NULL, NULL, NULL),
(1048, 'Sahapur', 'সাহাপুর', 'sahapurup . pabna . gov . bd', 1, 114, NULL, NULL, NULL, NULL),
(1049, 'Luxmikunda', 'লক্ষীকুন্ডা', 'luxmikundaup . pabna . gov . bd', 1, 114, NULL, NULL, NULL, NULL),
(1050, 'Bhangura', 'ভাঙ্গুড়া', 'bhanguraup . pabna . gov . bd', 1, 115, NULL, NULL, NULL, NULL),
(1051, 'Khanmarich', 'খানমরিচ', 'khanmarichup . pabna . gov . bd', 1, 115, NULL, NULL, NULL, NULL),
(1052, 'Ashtamanisha', 'অষ্টমণিষা', 'ashtamanishaup . pabna . gov . bd', 1, 115, NULL, NULL, NULL, NULL),
(1053, 'Dilpasar', 'দিলপাশার', 'dilpasarup . pabna . gov . bd', 1, 115, NULL, NULL, NULL, NULL),
(1054, 'Parbhangura', 'পারভাঙ্গুড়া', 'parbhanguraup . pabna . gov . bd', 1, 115, NULL, NULL, NULL, NULL),
(1055, 'Maligachha', 'মালিগাছা', 'maligachhaup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1056, 'Malanchi', 'মালঞ্চি', 'malanchiup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1057, 'Gayeshpur', 'গয়েশপুর', 'gayeshpurup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1058, 'Ataikula', 'আতাইকুলা', 'ataikulaup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1059, 'Chartarapur', 'চরতারাপুর', 'chartarapurup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1060, 'Sadullahpur', 'সাদুল্লাপুর', 'sadullahpurup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1061, 'Bharara', 'ভাঁড়ারা', 'bhararaup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1062, 'Dogachi', 'দোগাছী', 'dogachiup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1063, 'Hemayetpur', 'হেমায়েতপুর', 'hemayetpurup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1064, 'Dapunia', 'দাপুনিয়া', 'dapuniaup . pabna . gov . bd', 1, 116, NULL, NULL, NULL, NULL),
(1065, 'Haturia Nakalia', 'হাটুরিয়া নাকালিয়া', 'haturianakaliaup . pabna . gov . bd', 1, 117, NULL, NULL, NULL, NULL),
(1066, 'Notun Varenga', 'নতুন ভারেঙ্গা', 'notunvarengaup . pabna . gov . bd', 1, 117, NULL, NULL, NULL, NULL),
(1067, 'Koitola', 'কৈটোলা', 'koitolaup . pabna . gov . bd', 1, 117, NULL, NULL, NULL, NULL),
(1068, 'Chakla', 'চাকলা', 'chaklaup . pabna . gov . bd', 1, 117, NULL, NULL, NULL, NULL),
(1069, 'Jatsakhini', 'জাতসাখিনি', 'jatsakhiniup . pabna . gov . bd', 1, 117, NULL, NULL, NULL, NULL),
(1070, 'Puran Varenga', 'পুরান ভারেঙ্গা', 'puranvarengaup . pabna . gov . bd', 1, 117, NULL, NULL, NULL, NULL),
(1071, 'Ruppur', 'রূপপুর', 'ruppurup . pabna . gov . bd', 1, 117, NULL, NULL, NULL, NULL),
(1072, 'Masumdia', 'মাসুমদিয়া', 'masumdiaup . pabna . gov . bd', 1, 117, NULL, NULL, NULL, NULL),
(1073, 'Dhalar Char', 'ঢালার চর', 'dhalarcharup . pabna . gov . bd', 1, 117, NULL, NULL, NULL, NULL),
(1074, 'Majhpara', 'মাজপাড়া', 'majhparaup . pabna . gov . bd', 1, 118, NULL, NULL, NULL, NULL),
(1075, 'Chandba', 'চাঁদভা', 'chandbaup . pabna . gov . bd', 1, 118, NULL, NULL, NULL, NULL),
(1076, 'Debottar', 'দেবোত্তর', 'debottarup . pabna . gov . bd', 1, 118, NULL, NULL, NULL, NULL),
(1077, 'Ekdanta', 'একদন্ত', 'ekdantaup . pabna . gov . bd', 1, 118, NULL, NULL, NULL, NULL),
(1078, 'Laxshmipur', 'লক্ষীপুর', 'laxshmipurup . pabna . gov . bd', 1, 118, NULL, NULL, NULL, NULL),
(1079, 'Handial', 'হান্ডিয়াল', 'handialup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1080, 'Chhaikola', 'ছাইকোলা', 'chhaikolaup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1081, 'Nimaichara', 'নিমাইচড়া', 'nimaicharaup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1082, 'Gunaigachha', 'গুনাইগাছা', 'gunaigachhaup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1083, 'Parshadanga', 'পার্শ্বডাঙ্গা', 'parshadangaup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1084, 'Failjana', 'ফৈলজানা', 'failjanaup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1085, 'Mulgram', 'মুলগ্রাম', 'mulgramup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1086, 'Haripur', 'হরিপুর', 'haripurup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1087, 'Mothurapur', 'মথুরাপুর', 'mothurapurup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1088, 'Bilchalan', 'বিলচলন', 'bilchalanup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1089, 'Danthia Bamangram', 'দাতিয়া বামনগ্রাম', 'danthiabamangramup . pabna . gov . bd', 1, 119, NULL, NULL, NULL, NULL),
(1090, 'Nagdemra', 'নাগডেমড়া', 'nagdemraup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1091, 'Dhulauri', 'ধুলাউড়ি', 'dhulauriup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1092, 'Bhulbaria', 'ভুলবাড়ীয়া', 'bhulbariaup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1093, 'Dhopadaha', 'ধোপাদহ', 'dhopadahaup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1094, 'Karamja', 'করমজা', 'karamjaup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1095, 'Kashinathpur', 'কাশিনাথপুর', 'kashinathpurup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1096, 'Gaurigram', 'গৌরীগ্রাম', 'gaurigramup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1097, 'Nandanpur', 'নন্দনপুর', 'nandanpurup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1098, 'Khetupara', 'ক্ষেতুপাড়া', 'khetuparaup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1099, 'Ar - Ataikula', 'আর - আতাইকুলা', 'rataiqulaup . pabna . gov . bd', 1, 120, NULL, NULL, NULL, NULL),
(1100, 'Brilahiribari', 'বৃলাহিড়ীবাড়ী', 'brilahiribariup . pabna . gov . bd', 1, 121, NULL, NULL, NULL, NULL),
(1101, 'Pungali', 'পুঙ্গুলি', 'pungaliup . pabna . gov . bd', 1, 121, NULL, NULL, NULL, NULL),
(1102, 'Faridpur', 'ফরিদপুর', 'faridpurup . pabna . gov . bd', 1, 121, NULL, NULL, NULL, NULL),
(1103, 'Hadal', 'হাদল', 'hadalup . pabna . gov . bd', 1, 121, NULL, NULL, NULL, NULL),
(1104, 'Banwarinagar', 'বনওয়ারীনগর', 'banwarinagarup . pabna . gov . bd', 1, 121, NULL, NULL, NULL, NULL),
(1105, 'Demra', 'ডেমড়া', 'demraup . pabna . gov . bd', 1, 121, NULL, NULL, NULL, NULL),
(1106, 'Birkedar', 'বীরকেদার', 'birkedarup . bogra . gov . bd', 1, 122, NULL, NULL, NULL, NULL),
(1107, 'Kalai', 'কালাই', 'kalaiup . bogra . gov . bd', 1, 122, NULL, NULL, NULL, NULL),
(1108, 'Paikar', 'পাইকড়', 'paikarup . bogra . gov . bd', 1, 122, NULL, NULL, NULL, NULL),
(1109, 'Narhatta', 'নারহট্ট', 'narhattaup . bogra . gov . bd', 1, 122, NULL, NULL, NULL, NULL),
(1110, 'Murail', 'মুরইল', 'murailup . bogra . gov . bd', 1, 122, NULL, NULL, NULL, NULL),
(1111, 'Kahaloo', 'কাহালু', 'kahalooup . bogra . gov . bd', 1, 122, NULL, NULL, NULL, NULL),
(1112, 'Durgapur', 'দূর্গাপুর', 'durgapurup . bogra . gov . bd', 1, 122, NULL, NULL, NULL, NULL),
(1113, 'Jamgaon', 'জামগ্রাম', 'jamgaonup . bogra . gov . bd', 1, 122, NULL, NULL, NULL, NULL),
(1114, 'Malancha', 'মালঞ্চা', 'malanchaup . bogra . gov . bd', 1, 122, NULL, NULL, NULL, NULL),
(1115, 'Fapore', 'ফাঁপোর', 'faporeup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1116, 'Shabgram', 'সাবগ্রাম', 'shabgramup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1117, 'Nishindara', 'নিশিন্দারা', 'nishindaraup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1118, 'Erulia', 'এরুলিয়া', 'eruliaup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1119, 'Rajapur', 'রাজাপুর', 'rajapurup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1120, 'Shakharia', 'শাখারিয়া', 'shakhariaup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1121, 'Sekherkola', 'শেখেরকোলা', 'sekherkolaup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1122, 'Gokul', 'গোকুল', 'gokulup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1123, 'Noongola', 'নুনগোলা', 'noongolaup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1124, 'Lahiripara', 'লাহিড়ীপাড়া', 'lahiriparaup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1125, 'Namuja', 'নামুজা', 'namujaup . bogra . gov . bd', 1, 123, NULL, NULL, NULL, NULL),
(1126, 'Sariakandi Sadar', 'সারিয়াকান্দি সদর', 'sariakandisadarup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1127, 'Narchi', 'নারচী', 'narchiup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1128, 'Bohail', 'বোহাইল', 'bohailup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1129, 'Chaluabari', 'চালুয়াবাড়ী', 'chaluabariup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1130, 'Chandanbaisha', 'চন্দনবাইশা', 'chandanbaishaup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1131, 'Hatfulbari', 'হাটফুলবাড়ী', 'hatfulbariup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1132, 'Hatsherpur', 'হাটশেরপুর', 'hatsherpurup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1133, 'Karnibari', 'কর্ণিবাড়ী', 'karnibariup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1134, 'Kazla', 'কাজলা', 'kazlaup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1135, 'Kutubpur', 'কুতুবপুর', 'kutubpurup . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1136, 'Kamalpur', 'কামালপুর', 'kamalpur . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1137, 'Bhelabari', 'ভেলাবাড়ী', 'bhelabari . bogra . gov . bd', 1, 124, NULL, NULL, NULL, NULL),
(1138, 'Asekpur', 'আশেকপুর', 'asekpurup . bogra . gov . bd', 1, 125, NULL, NULL, NULL, NULL),
(1139, 'Madla', 'মাদলা', 'madlaup . bogra . gov . bd', 1, 125, NULL, NULL, NULL, NULL),
(1140, 'Majhira', 'মাঝিড়া', 'majhiraup . bogra . gov . bd', 1, 125, NULL, NULL, NULL, NULL),
(1141, 'Aria', 'আড়িয়া', 'ariaup . bogra . gov . bd', 1, 125, NULL, NULL, NULL, NULL),
(1142, 'Kharna', 'খরনা', 'kharnaup . bogra . gov . bd', 1, 125, NULL, NULL, NULL, NULL),
(1143, 'Khottapara', 'খোট্টাপাড়া', 'Khottaparaup . bogra . gov . bd', 1, 125, NULL, NULL, NULL, NULL),
(1144, 'Chopinagar', 'চোপিনগর', 'chopinagarup . bogra . gov . bd', 1, 125, NULL, NULL, NULL, NULL),
(1145, 'Amrul', 'আমরুল', 'amrulup . bogra . gov . bd', 1, 125, NULL, NULL, NULL, NULL),
(1146, 'Gohail', 'গোহাইল', 'gohailup . bogra . gov . bd', 1, 125, NULL, NULL, NULL, NULL),
(1147, 'Zianagar', 'জিয়ানগর', 'zianagarup . bogra . gov . bd', 1, 126, NULL, NULL, NULL, NULL),
(1148, 'Chamrul', 'চামরুল', 'chamrulup . bogra . gov . bd', 1, 126, NULL, NULL, NULL, NULL),
(1149, 'Dupchanchia', 'দুপচাঁচিয়া', 'dupchanchiaup . bogra . gov . bd', 1, 126, NULL, NULL, NULL, NULL),
(1150, 'Gunahar', 'গুনাহার', 'gunaharup . bogra . gov . bd', 1, 126, NULL, NULL, NULL, NULL),
(1151, 'Gobindapur', 'গোবিন্দপুর', 'gobindapurup . bogra . gov . bd', 1, 126, NULL, NULL, NULL, NULL),
(1152, 'Talora', 'তালোড়া', 'taloraup . bogra . gov . bd', 1, 126, NULL, NULL, NULL, NULL),
(1153, 'Chhatiangram', 'ছাতিয়ানগ্রাম', 'chhatiangramup . bogra . gov . bd', 1, 127, NULL, NULL, NULL, NULL),
(1154, 'Nasaratpur', 'নশরতপুর', 'nasaratpurup . bogra . gov . bd', 1, 127, NULL, NULL, NULL, NULL),
(1155, 'Adamdighi', 'আদমদিঘি', 'adamdighiup . bogra . gov . bd', 1, 127, NULL, NULL, NULL, NULL),
(1156, 'Kundagram', 'কুন্দগ্রাম', 'kundagramup . bogra . gov . bd', 1, 127, NULL, NULL, NULL, NULL),
(1157, 'Chapapur', 'চাঁপাপুর', 'chapapurup . bogra . gov . bd', 1, 127, NULL, NULL, NULL, NULL),
(1158, 'Shantahar', 'সান্তাহার', 'shantaharup . bogra . gov . bd', 1, 127, NULL, NULL, NULL, NULL),
(1159, 'Burail', 'বুড়ইল', 'burailup . bogra . gov . bd', 1, 128, NULL, NULL, NULL, NULL),
(1160, 'Nandigram', 'নন্দিগ্রাম', 'nandigramup . bogra . gov . bd', 1, 128, NULL, NULL, NULL, NULL),
(1161, 'Bhatra', 'ভাটরা', 'bhatraup . bogra . gov . bd', 1, 128, NULL, NULL, NULL, NULL),
(1162, 'Thalta Majhgram', 'থালতা মাঝগ্রাম', 'thaltamajhgramup . bogra . gov . bd', 1, 128, NULL, NULL, NULL, NULL),
(1163, 'Bhatgram', 'ভাটগ্রাম', 'bhatgramup . bogra . gov . bd', 1, 128, NULL, NULL, NULL, NULL),
(1164, 'Sonatala', 'সোনাতলা', 'sonatalaup . bogra . gov . bd', 1, 129, NULL, NULL, NULL, NULL),
(1165, 'Balua', 'বালুয়া', 'baluaup . bogra . gov . bd', 1, 129, NULL, NULL, NULL, NULL),
(1166, 'Zorgacha', 'জোড়গাছা', 'zorgachaup . bogra . gov . bd', 1, 129, NULL, NULL, NULL, NULL),
(1167, 'Digdair', 'দিগদাইড়', 'digdairup . bogra . gov . bd', 1, 129, NULL, NULL, NULL, NULL),
(1168, 'Madhupur', 'মধুপুর', 'madhupurup . bogra . gov . bd', 1, 129, NULL, NULL, NULL, NULL),
(1169, 'Pakulla', 'পাকুল্ল্যা', 'pakullaup . bogra . gov . bd', 1, 129, NULL, NULL, NULL, NULL),
(1170, 'Tekani Chukinagar', 'তেকানী চুকাইনগর', 'tekanichukinagarup . bogra . gov . bd', 1, 129, NULL, NULL, NULL, NULL),
(1171, 'Nimgachi', 'নিমগাছি', 'nimgachiup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1172, 'Kalerpara', 'কালেরপাড়া', 'kalerparaup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1173, 'Chikashi', 'চিকাশী', 'chikashiup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1174, 'Gossainbari', 'গোসাইবাড়ী', 'gossainbariup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1175, 'Bhandarbari', 'ভান্ডারবাড়ী', 'bhandarbariup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1176, 'Gopalnagar', '১গোপালনগর', 'gopalnagarup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1177, 'Mothurapur', 'মথুরাপুর', 'mothurapurup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1178, 'Chowkibari', 'চৌকিবাড়ী', 'chowkibariup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1179, 'Elangi', 'এলাঙ্গী', 'elangiup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1180, 'Dhunat Sadar', 'ধুনট সদর', 'dhunatsadarup . bogra . gov . bd', 1, 130, NULL, NULL, NULL, NULL),
(1181, 'Baliadighi', 'বালিয়া দিঘী', 'baliadighiup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1182, 'Dakshinpara', 'দক্ষিণপাড়া', 'dakshinparaup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1183, 'Durgahata', 'দুর্গাহাটা', 'durgahataup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1184, 'Kagail', 'কাগইল', 'kagailup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1185, 'Sonarai', 'সোনারায়', 'sonaraiup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1186, 'Rameshwarpur', 'রামেশ্বরপুর', 'rameshwarpurup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1187, 'Naruamala', 'নাড়ুয়ামালা', 'naruamalaup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1188, 'Nepaltali', 'নেপালতলী', 'nepaltaliup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1189, 'Gabtali', 'গাবতলি', 'gabtaliup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1190, 'Mahishaban', 'মহিষাবান', 'mahishabanup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1191, 'Nasipur', 'নশিপুর', 'nasipurup . bogra . gov . bd', 1, 131, NULL, NULL, NULL, NULL),
(1192, 'Mirzapur', 'মির্জাপুর', 'mirzapurup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1193, 'Khamarkandi', 'খামারকান্দি', 'khamarkandiup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1194, 'Garidaha', 'গাড়িদহ', 'garidahaup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1195, 'Kusumbi', 'কুসুম্বী', 'kusumbiup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1196, 'Bishalpur', 'বিশালপুর', 'bishalpurup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1197, 'Shimabari', 'সীমাবাড়ি', 'shimabariup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1198, 'Shahbondegi', 'শাহবন্দেগী', 'shahbondegiup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1199, 'Sughat', 'সুঘাট', 'sughatup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1200, 'Khanpur', 'খানপুর', 'khanpurup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1201, 'Bhabanipur', 'ভবানীপুর', 'bhabanipurup . bogra . gov . bd', 1, 132, NULL, NULL, NULL, NULL),
(1202, 'Moidanhatta', 'ময়দানহাট্টা', 'moidanhattaup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1203, 'Kichok', 'কিচক', 'kichokup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1204, 'Atmul', 'আটমূল', 'atmulup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1205, 'Pirob', 'পিরব', 'pirobup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1206, 'Majhihatta', 'মাঝিহট্ট', 'majhihattaup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1207, 'Buriganj', 'বুড়িগঞ্জ', 'buriganjup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1208, 'Bihar', 'বিহার', 'biharup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1209, 'Shibganj', 'শিবগঞ্জ', 'shibganjup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1210, 'Deuly', 'দেউলি', 'deulyup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1211, 'Sayedpur', 'সৈয়দপুর', 'sayedpurup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1212, 'Mokamtala', 'মোকামতলা', 'mokamtalaup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1213, 'Raynagar', 'রায়নগর', 'raynagarup . bogra . gov . bd', 1, 133, NULL, NULL, NULL, NULL),
(1214, 'Darsanpara', 'দর্শনপাড়া', 'darsanparaup . rajshahi . gov . bd', 1, 134, NULL, NULL, NULL, NULL),
(1215, 'Hujuripara', 'হুজুরী পাড়া', 'hujuriparaup . rajshahi . gov . bd', 1, 134, NULL, NULL, NULL, NULL),
(1216, 'Damkura', 'দামকুড়া', 'damkuraup . rajshahi . gov . bd', 1, 134, NULL, NULL, NULL, NULL),
(1217, 'Horipur', 'হরিপুর', 'horipurup . rajshahi . gov . bd', 1, 134, NULL, NULL, NULL, NULL),
(1218, 'Horogram', 'হড়গ্রাম', 'horogramup . rajshahi . gov . bd', 1, 134, NULL, NULL, NULL, NULL),
(1219, 'Harian', 'হরিয়ান', 'harianup . rajshahi . gov . bd', 1, 134, NULL, NULL, NULL, NULL),
(1220, 'Borgachi', 'বড়্গাছি', 'borgachiup . rajshahi . gov . bd', 1, 134, NULL, NULL, NULL, NULL),
(1221, 'Parila', 'পারিলা', 'parilaup . rajshahi . gov . bd', 1, 134, NULL, NULL, NULL, NULL),
(1222, 'Naopara', 'নওপাড়া', 'naoparaup . rajshahi . gov . bd', 1, 135, NULL, NULL, NULL, NULL),
(1223, 'Kismatgankoir', 'কিসমতগণকৈড়', 'kismatgankoirup . rajshahi . gov . bd', 1, 135, NULL, NULL, NULL, NULL),
(1224, 'Pananagar', 'পানানগর', 'pananagarup . rajshahi . gov . bd', 1, 135, NULL, NULL, NULL, NULL),
(1225, 'Deluabari', 'দেলুয়াবাড়ী', 'deluabariup . rajshahi . gov . bd', 1, 135, NULL, NULL, NULL, NULL),
(1226, 'Jhaluka', 'ঝালুকা', 'jhalukaup . rajshahi . gov . bd', 1, 135, NULL, NULL, NULL, NULL),
(1227, 'Maria', 'মাড়িয়া', 'mariaup . rajshahi . gov . bd', 1, 135, NULL, NULL, NULL, NULL),
(1228, 'Joynogor', 'জয়নগর', 'joynogorup . rajshahi . gov . bd', 1, 135, NULL, NULL, NULL, NULL),
(1229, 'Dhuroil', 'ধুরইল', 'dhuroilup . rajshahi . gov . bd', 1, 136, NULL, NULL, NULL, NULL),
(1230, 'Ghasigram', 'ঘষিগ্রাম', 'ghasigramup . rajshahi . gov . bd', 1, 136, NULL, NULL, NULL, NULL),
(1231, 'Raighati', 'রায়ঘাটি', 'raighatiup . rajshahi . gov . bd', 1, 136, NULL, NULL, NULL, NULL),
(1232, 'Mougachi', 'মৌগাছি', 'mougachiup . rajshahi . gov . bd', 1, 136, NULL, NULL, NULL, NULL),
(1233, 'Baksimoil', 'বাকশিমইল', 'baksimoilup . rajshahi . gov . bd', 1, 136, NULL, NULL, NULL, NULL),
(1234, 'Jahanabad', 'জাহানাবাদ', 'jahanabadup . rajshahi . gov . bd', 1, 136, NULL, NULL, NULL, NULL),
(1235, 'Yousufpur', 'ইউসুফপুর', 'yousufpurup . rajshahi . gov . bd', 1, 137, NULL, NULL, NULL, NULL),
(1236, 'Solua', 'শলুয়া', 'soluaup . rajshahi . gov . bd', 1, 137, NULL, NULL, NULL, NULL),
(1237, 'Sardah', 'সরদহ', 'sardahup . rajshahi . gov . bd', 1, 137, NULL, NULL, NULL, NULL),
(1238, 'Nimpara', 'নিমপাড়া', 'nimparaup . rajshahi . gov . bd', 1, 137, NULL, NULL, NULL, NULL),
(1239, 'Charghat', 'চারঘাট', 'charghatup . rajshahi . gov . bd', 1, 137, NULL, NULL, NULL, NULL),
(1240, 'Vialuxmipur', 'ভায়ালক্ষ্মীপুর', 'vialuxmipurup . rajshahi . gov . bd', 1, 137, NULL, NULL, NULL, NULL),
(1241, 'Puthia', 'পুঠিয়া', 'puthiaup . rajshahi . gov . bd', 1, 138, NULL, NULL, NULL, NULL),
(1242, 'Belpukuria', 'বেলপুকুরিয়া', 'belpukuriaup . rajshahi . gov . bd', 1, 138, NULL, NULL, NULL, NULL),
(1243, 'Baneswar', 'বানেশ্বর', 'baneswarup . rajshahi . gov . bd', 1, 138, NULL, NULL, NULL, NULL),
(1244, 'Valukgachi', 'ভালুক গাছি', 'valukgachiup . rajshahi . gov . bd', 1, 138, NULL, NULL, NULL, NULL),
(1245, 'Shilmaria', 'শিলমাড়িয়া', 'shilmariaup . rajshahi . gov . bd', 1, 138, NULL, NULL, NULL, NULL),
(1246, 'Jewpara', 'জিউপাড়া', 'jewparaup . rajshahi . gov . bd', 1, 138, NULL, NULL, NULL, NULL),
(1247, 'Bajubagha', 'বাজুবাঘা', 'bajubaghaup . rajshahi . gov . bd', 1, 139, NULL, NULL, NULL, NULL),
(1248, 'Gorgori', 'গড়গড়ি', 'gorgoriup . rajshahi . gov . bd', 1, 139, NULL, NULL, NULL, NULL),
(1249, 'Pakuria', 'পাকুড়িয়া', 'pakuriaup . rajshahi . gov . bd', 1, 139, NULL, NULL, NULL, NULL),
(1250, 'Monigram', 'মনিগ্রাম', 'monigramup . rajshahi . gov . bd', 1, 139, NULL, NULL, NULL, NULL),
(1251, 'Bausa', 'বাউসা', 'bausaup . rajshahi . gov . bd', 1, 139, NULL, NULL, NULL, NULL),
(1252, 'Arani', 'আড়ানী', 'araniup . rajshahi . gov . bd', 1, 139, NULL, NULL, NULL, NULL),
(1253, 'Godagari', 'গোদাগাড়ী', 'godagariup . rajshahi . gov . bd', 1, 140, NULL, NULL, NULL, NULL),
(1254, 'Mohonpur', 'মোহনপুর', 'mohonpurup . rajshahi . gov . bd', 1, 140, NULL, NULL, NULL, NULL),
(1255, 'Pakri', 'পাকড়ী', 'pakriup . rajshahi . gov . bd', 1, 140, NULL, NULL, NULL, NULL),
(1256, 'Risikul', 'রিশিকুল', 'risikulup . rajshahi . gov . bd', 1, 140, NULL, NULL, NULL, NULL),
(1257, 'Gogram', 'গোগ্রাম', 'gogramup . rajshahi . gov . bd', 1, 140, NULL, NULL, NULL, NULL),
(1258, 'Matikata', 'মাটিকাটা', 'matikataup . rajshahi . gov . bd', 1, 140, NULL, NULL, NULL, NULL),
(1259, 'Dewpara', 'দেওপাড়া', 'dewparaup . rajshahi . gov . bd', 1, 140, NULL, NULL, NULL, NULL),
(1260, 'Basudebpur', 'বাসুদেবপুর', 'basudebpurup . rajshahi . gov . bd', 1, 140, NULL, NULL, NULL, NULL),
(1261, 'Asariadaha', 'আষাড়িয়াদহ', 'asariadahaup . rajshahi . gov . bd', 1, 140, NULL, NULL, NULL, NULL),
(1262, 'Kalma', 'কলমা', 'kalmaup . rajshahi . gov . bd', 1, 141, NULL, NULL, NULL, NULL),
(1263, 'Badhair', 'বাধাইড়', 'badhairup . rajshahi . gov . bd', 1, 141, NULL, NULL, NULL, NULL),
(1264, 'Panchandar', 'পাঁচন্দর', 'panchandarup . rajshahi . gov . bd', 1, 141, NULL, NULL, NULL, NULL),
(1265, 'Saranjai', 'সরঞ্জাই', 'saranjaiup . rajshahi . gov . bd', 1, 141, NULL, NULL, NULL, NULL),
(1266, 'Talondo', 'তালন্দ', 'talondoup . rajshahi . gov . bd', 1, 141, NULL, NULL, NULL, NULL),
(1267, 'Kamargaon', 'কামারগাঁ', 'kamargaonup . rajshahi . gov . bd', 1, 141, NULL, NULL, NULL, NULL),
(1268, 'Chanduria', 'চান্দুড়িয়া', 'chanduriaup . rajshahi . gov . bd', 1, 141, NULL, NULL, NULL, NULL),
(1269, 'Gobindopara', 'গোবিন্দপাড়া', 'gobindoparaup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1270, 'Nordas', 'নরদাস', 'nordasup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1271, 'Dippur', 'দ্বীপপুর', 'dippurup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1272, 'Borobihanoli', 'বড়বিহানলী', 'borobihanoliup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1273, 'Auchpara', 'আউচপাড়া', 'auchparaup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1274, 'Sreepur', 'শ্রীপুর', 'sreepurup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1275, 'Basupara', 'বাসুপাড়া', 'basuparaup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1276, 'Kacharikoalipara', 'কাচাড়ী কোয়লিপাড়া', 'kacharikoaliparaup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1277, 'Suvodanga', 'শুভডাঙ্গা', 'suvodangaup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1278, 'Mariaup', 'মাড়িয়া', 'mariaup10 . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1279, 'Ganipur', 'গণিপুর', 'ganipurup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1280, 'Zhikara', 'ঝিকড়া', 'zhikaraup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1281, 'Gualkandi', 'গোয়ালকান্দি', 'gualkandiup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1282, 'Hamirkutsa', 'হামিরকুৎসা', 'hamirkutsaup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1283, 'Jogipara', 'যোগিপাড়া', 'jogiparaup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1284, 'Sonadanga', 'সোনাডাঙ্গা', 'sonadangaup . rajshahi . gov . bd', 1, 142, NULL, NULL, NULL, NULL),
(1285, 'Brahmapur', 'ব্রহ্মপুর', 'brahmapurup . natore . gov . bd', 1, 143, NULL, NULL, NULL, NULL),
(1286, 'Madhnagar', 'মাধনগর', 'madhnagar . natore . gov . bd', 1, 143, NULL, NULL, NULL, NULL),
(1287, 'Khajura', 'খাজুরা', 'khajura . bdgovportal . com', 1, 143, NULL, NULL, NULL, NULL),
(1288, 'Piprul', 'পিপরুল', 'piprulup . natore . gov . bd', 1, 143, NULL, NULL, NULL, NULL),
(1289, 'Biprobelghoria', 'বিপ্রবেলঘড়িয়া', 'biprobelghoria . bdgovportal . com', 1, 143, NULL, NULL, NULL, NULL),
(1290, 'Chhatni', 'ছাতনী', 'chhatni . bdgovportal . com', 1, 143, NULL, NULL, NULL, NULL),
(1291, 'Tebaria', 'তেবাড়িয়া', 'tebariaup . natore . gov . bd', 1, 143, NULL, NULL, NULL, NULL),
(1292, 'Dighapatia', 'দিঘাপতিয়া', 'dighapatiaup . natore . gov . bd', 1, 143, NULL, NULL, NULL, NULL),
(1293, 'Luxmipurkholabaria', 'লক্ষীপুর খোলাবাড়িয়া', 'luxmipurkholabariaup . natore . gov . bd', 1, 143, NULL, NULL, NULL, NULL),
(1294, 'Barahorispur', 'বড়হরিশপুর', 'barahorispur . bdgovportal . com', 1, 143, NULL, NULL, NULL, NULL),
(1295, 'Kaphuria', 'কাফুরিয়া', 'kaphuria . bdgovportal . com', 1, 143, NULL, NULL, NULL, NULL),
(1296, 'Halsa', 'হালসা', 'halsa . natore . gov . bd', 1, 143, NULL, NULL, NULL, NULL),
(1297, 'Sukash', 'শুকাশ', 'sukashup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1298, 'Dahia', 'ডাহিয়া', 'dahiaup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1299, 'Italy', 'ইটালী', 'italyup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1300, 'Kalam', 'কলম', 'kalamup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1301, 'Chamari', 'চামারী', 'chamariup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1302, 'Hatiandaha', 'হাতিয়ানদহ', 'hatiandahaup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1303, 'Lalore', 'লালোর', 'laloreup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1304, 'Sherkole', 'শেরকোল', 'sherkoleup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1305, 'Tajpur', 'তাজপুর', 'tajpurup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1306, 'Chaugram', 'চৌগ্রাম', 'chaugramup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1307, 'Chhatardighi', 'ছাতারদিঘী', 'chhatardighiup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1308, 'Ramanandakhajura', 'রামান্দখাজুরা', 'ramanandakhajuraup . natore . gov . bd', 1, 144, NULL, NULL, NULL, NULL),
(1309, 'Joari', 'জোয়াড়ী', 'joariup . natore . gov . bd', 1, 145, NULL, NULL, NULL, NULL),
(1310, 'Baraigram', 'বড়াইগ্রাম', 'baraigramup . natore . gov . bd', 1, 145, NULL, NULL, NULL, NULL),
(1311, 'Zonail', 'জোনাইল', 'zonailup . natore . gov . bd', 1, 145, NULL, NULL, NULL, NULL),
(1312, 'Nagor', 'নগর', 'nagorup . natore . gov . bd', 1, 145, NULL, NULL, NULL, NULL),
(1313, 'Majgoan', 'মাঝগাও', 'majgoanup . natore . gov . bd', 1, 145, NULL, NULL, NULL, NULL),
(1314, 'Gopalpur', 'গোপালপুর', 'gopalpurup . natore . gov . bd', 1, 145, NULL, NULL, NULL, NULL),
(1315, 'Chandai', 'চান্দাই', 'chandai . bdgovportal . com', 1, 145, NULL, NULL, NULL, NULL),
(1316, 'Panka', 'পাঁকা', 'pankaup . natore . gov . bd', 1, 146, NULL, NULL, NULL, NULL),
(1317, 'Jamnagor', 'জামনগর', 'jamnagorup . natore . gov . bd', 1, 146, NULL, NULL, NULL, NULL),
(1318, 'Bagatipara', 'বাগাতিপাড়া', 'bagatiparaup . natore . gov . bd', 1, 146, NULL, NULL, NULL, NULL),
(1319, 'Dayarampur', 'দয়ারামপুর', 'dayarampurup . natore . gov . bd', 1, 146, NULL, NULL, NULL, NULL),
(1320, 'Faguardiar', 'ফাগুয়ারদিয়াড়', 'faguardiarup . natore . gov . bd', 1, 146, NULL, NULL, NULL, NULL),
(1321, 'Lalpur', 'লালপুর', 'lalpurup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1322, 'Iswardi', 'ঈশ্বরদী', 'iswardiup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1323, 'Chongdhupoil', 'চংধুপইল', 'chongdhupoilup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1324, 'Arbab', 'আড়বাব', 'arbabup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1325, 'Bilmaria', 'বিলমাড়িয়া', 'bilmariaup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1326, 'Duaria', 'দুয়ারিয়া', 'duariaup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1327, 'Oalia', 'ওয়ালিয়া', 'oaliaup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1328, 'Durduria', 'দুড়দুরিয়া', 'durduriaup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1329, 'Arjunpur', 'অর্জুনপুর বরমহাটী', 'arjunpurup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1330, 'Kadimchilan', 'কদিমচিলান', 'kadimchilanup . natore . gov . bd', 1, 147, NULL, NULL, NULL, NULL),
(1331, 'Nazirpur', 'নাজিরপুর', 'nazirpurup . natore . gov . bd', 1, 148, NULL, NULL, NULL, NULL),
(1332, 'Biaghat', 'বিয়াঘাট', 'biaghatup . natore . gov . bd', 1, 148, NULL, NULL, NULL, NULL),
(1333, 'Khubjipur', 'খুবজীপুর', 'khubjipurup . natore . gov . bd', 1, 148, NULL, NULL, NULL, NULL),
(1334, 'Dharabarisha', 'ধারাবারিষা', 'dharabarishaup . natore . gov . bd', 1, 148, NULL, NULL, NULL, NULL),
(1335, 'Moshindha', 'মসিন্দা', 'moshindhaup . natore . gov . bd', 1, 148, NULL, NULL, NULL, NULL),
(1336, 'Chapila', 'চাপিলা', 'chapilaup . natore . gov . bd', 1, 148, NULL, NULL, NULL, NULL),
(1337, 'Rukindipur', 'রুকিন্দীপুর', 'rukindipurup . joypurhat . gov . bd', 1, 150, NULL, NULL, NULL, NULL),
(1338, 'Sonamukhi', 'সোনামূখী', 'sonamukhiup . joypurhat . gov . bd', 1, 150, NULL, NULL, NULL, NULL),
(1339, 'Tilakpur', 'তিলকপুর', 'tilakpurup . joypurhat . gov . bd', 1, 150, NULL, NULL, NULL, NULL),
(1340, 'Raikali', 'রায়কালী', 'raikaliup . joypurhat . gov . bd', 1, 150, NULL, NULL, NULL, NULL),
(1341, 'Gopinathpur', 'গোপীনাথপুর', 'gopinathpurup . joypurhat . gov . bd', 1, 150, NULL, NULL, NULL, NULL),
(1342, 'Matrai', 'মাত্রাই', 'matraiup . joypurhat . gov . bd', 1, 151, NULL, NULL, NULL, NULL),
(1343, 'Ahammedabad', 'আহম্মেদাবাদ', 'ahammedabadup . joypurhat . gov . bd', 1, 151, NULL, NULL, NULL, NULL),
(1344, 'Punot', 'পুনট', 'punotup . joypurhat . gov . bd', 1, 151, NULL, NULL, NULL, NULL),
(1345, 'Zindarpur', 'জিন্দারপুর', 'zindarpurup . joypurhat . gov . bd', 1, 151, NULL, NULL, NULL, NULL),
(1346, 'Udaipur', 'উদয়পুর', 'udaipurup . joypurhat . gov . bd', 1, 151, NULL, NULL, NULL, NULL),
(1347, 'Alampur', 'আলমপুর', 'alampurup . joypurhat . gov . bd', 1, 152, NULL, NULL, NULL, NULL),
(1348, 'Borail', 'বড়াইল', 'borailup . joypurhat . gov . bd', 1, 152, NULL, NULL, NULL, NULL),
(1349, 'Tulshiganga', ' তুলশীগংগা', 'tulshigangaup . joypurhat . gov . bd', 1, 152, NULL, NULL, NULL, NULL),
(1350, 'Mamudpur', 'মামুদপুর', 'mamudpurup . joypurhat . gov . bd', 1, 152, NULL, NULL, NULL, NULL),
(1351, 'Boratara', 'বড়তারা', 'borataraup . joypurhat . gov . bd', 1, 152, NULL, NULL, NULL, NULL),
(1352, 'Bagjana', 'বাগজানা', 'bagjanaup . joypurhat . gov . bd', 1, 153, NULL, NULL, NULL, NULL),
(1353, 'Dharanji', 'ধরঞ্জি', 'dharanjiup . joypurhat . gov . bd', 1, 153, NULL, NULL, NULL, NULL),
(1354, 'Aymarasulpur', 'আয়মারসুলপুর', 'aymarasulpurup . joypurhat . gov . bd', 1, 153, NULL, NULL, NULL, NULL),
(1355, 'Balighata', 'বালিঘাটা', 'balighataup . joypurhat . gov . bd', 1, 153, NULL, NULL, NULL, NULL),
(1356, 'Atapur', 'আটাপুর', 'atapurup . joypurhat . gov . bd', 1, 153, NULL, NULL, NULL, NULL),
(1357, 'Mohammadpur', 'মোহাম্মদপুর', 'mohammadpurup . joypurhat . gov . bd', 1, 153, NULL, NULL, NULL, NULL),
(1358, 'Aolai', 'আওলাই', 'aolaiup . joypurhat . gov . bd', 1, 153, NULL, NULL, NULL, NULL),
(1359, 'Kusumba', 'কুসুম্বা', 'kusumbaup . joypurhat . gov . bd', 1, 153, NULL, NULL, NULL, NULL),
(1360, 'Amdai', 'আমদই', 'amdaiup . joypurhat . gov . bd', 1, 154, NULL, NULL, NULL, NULL),
(1361, 'Bamb', 'বম্বু', 'bambuup . joypurhat . gov . bd', 1, 154, NULL, NULL, NULL, NULL),
(1362, 'Dogachi', 'দোগাছি', 'dogachiup . joypurhat . gov . bd', 1, 154, NULL, NULL, NULL, NULL),
(1363, 'Puranapail', 'পুরানাপৈল', 'puranapailup . joypurhat . gov . bd', 1, 154, NULL, NULL, NULL, NULL),
(1364, 'Jamalpur', 'জামালপুর', 'jamalpurup . joypurhat . gov . bd', 1, 154, NULL, NULL, NULL, NULL),
(1365, 'Chakborkat', 'চকবরকত', 'chakborkatup . joypurhat . gov . bd', 1, 154, NULL, NULL, NULL, NULL),
(1366, 'Mohammadabad', 'মোহাম্মদাবাদ', 'mohammadabadup . joypurhat . gov . bd', 1, 154, NULL, NULL, NULL, NULL),
(1367, 'Dhalahar', 'ধলাহার', 'dhalaharup . joypurhat . gov . bd', 1, 154, NULL, NULL, NULL, NULL),
(1368, 'Bhadsha', 'ভাদসা', 'bhadshaup . joypurhat . gov . bd', 1, 154, NULL, NULL, NULL, NULL),
(1369, 'Alatuli', 'আলাতুলী', 'alatuliup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1370, 'Baroghoria', 'বারঘরিয়া', 'baroghoriaup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1371, 'Moharajpur', 'মহারাজপুর', 'moharajpurup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1372, 'Ranihati', 'রানীহাটি', 'ranihatiup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1373, 'Baliadanga', 'বালিয়াডাঙ্গা', 'baliadangaup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1374, 'Gobratola', 'গোবরাতলা', 'gobratolaup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1375, 'Jhilim', 'ঝিলিম', 'jhilimup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1376, 'Char Anupnagar', 'চর অনুপনগর', 'charaunupnagarup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1377, 'Debinagar', 'দেবীনগর', 'debinagarup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1378, 'Shahjahanpur', 'শাহজাহানপুর', 'shahjahanpurup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1379, 'Islampur', 'ইসলামপুর', 'islampurup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1380, 'Charbagdanga', 'চরবাগডাঙ্গা', 'charbagdangaup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1381, 'Narayanpur', 'নারায়নপুর', 'narayanpurup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1382, 'Sundarpur', 'সুন্দরপুর', 'sundarpurup . chapainawabganj . gov . bd', 1, 155, NULL, NULL, NULL, NULL),
(1383, 'Radhanagar', 'রাধানগর', 'radhanagarup . chapainawabganj . gov . bd', 1, 156, NULL, NULL, NULL, NULL),
(1384, 'Rahanpur', 'রহনপুর', 'rahanpurup . chapainawabganj . gov . bd', 1, 156, NULL, NULL, NULL, NULL),
(1385, 'Boalia', 'বোয়ালিয়া', 'boaliaup . chapainawabganj . gov . bd', 1, 156, NULL, NULL, NULL, NULL),
(1386, 'Bangabari', 'বাঙ্গাবাড়ী', 'bangabariup . chapainawabganj . gov . bd', 1, 156, NULL, NULL, NULL, NULL),
(1387, 'Parbotipur', 'পার্বতীপুর', 'parbotipurup . chapainawabganj . gov . bd', 1, 156, NULL, NULL, NULL, NULL),
(1388, 'Chowdala', 'চৌডালা', 'chowdalaup . chapainawabganj . gov . bd', 1, 156, NULL, NULL, NULL, NULL),
(1389, 'Gomostapur', 'গোমস্তাপুর', 'gomostapurup . chapainawabganj . gov . bd', 1, 156, NULL, NULL, NULL, NULL),
(1390, 'Alinagar', 'আলীনগর', 'alinagarup . chapainawabganj . gov . bd', 1, 156, NULL, NULL, NULL, NULL),
(1391, 'Fhotepur', 'ফতেপুর', 'fhotepurup . chapainawabganj . gov . bd', 1, 157, NULL, NULL, NULL, NULL),
(1392, 'Kosba', 'কসবা', 'kosbaup . chapainawabganj . gov . bd', 1, 157, NULL, NULL, NULL, NULL),
(1393, 'Nezampur', 'নেজামপুর', 'nezampurup . chapainawabganj . gov . bd', 1, 157, NULL, NULL, NULL, NULL),
(1394, 'Nachol', 'নাচোল', 'nacholup . chapainawabganj . gov . bd', 1, 157, NULL, NULL, NULL, NULL),
(1395, 'Bholahat', 'ভোলাহাট', 'bholahatup . chapainawabganj . gov . bd', 1, 158, NULL, NULL, NULL, NULL),
(1396, 'Jambaria', 'জামবাড়িয়া', 'jambariaup . chapainawabganj . gov . bd', 1, 158, NULL, NULL, NULL, NULL),
(1397, 'Gohalbari', 'গোহালবাড়ী', 'gohalbariup . chapainawabganj . gov . bd', 1, 158, NULL, NULL, NULL, NULL),
(1398, 'Daldoli', 'দলদলী', 'daldoliup . chapainawabganj . gov . bd', 1, 158, NULL, NULL, NULL, NULL),
(1399, 'Binodpur', 'বিনোদপুর', 'binodpurup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1400, 'Chakkirti', 'চককির্তী', 'chakkirtiup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1401, 'Daipukuria', 'দাইপুকুরিয়া', 'daipukuriaup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1402, 'Dhainagar', 'ধাইনগর', 'dhainagarup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1403, 'Durlovpur', 'দুর্লভপুর', 'durlovpurup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1404, 'Ghorapakhia', 'ঘোড়াপাখিয়া', 'ghorapakhiaup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1405, 'Mobarakpur', 'মোবারকপুর', 'mobarakpurup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1406, 'Monakasha', 'মনাকষা', 'monakashaup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1407, 'Noyalavanga', 'নয়ালাভাঙ্গা', 'noyalavangaup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1408, 'Panka', 'পাঁকা', 'pankaup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1409, 'Chatrajitpur', 'ছত্রাজিতপুর', 'chhatrajitpurup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1410, 'Shahabajpur', 'শাহাবাজপুর', 'shahabajpurup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1411, 'Shyampur', 'শ্যামপুর', 'shyampurup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1412, 'Kansat', 'কানসাট', 'kansatup . bdgovportal . com', 1, 159, NULL, NULL, NULL, NULL),
(1413, 'Ujirpur', 'উজিরপুর', 'ujirpurup . chapainawabganj . gov . bd', 1, 159, NULL, NULL, NULL, NULL),
(1414, '1nomohadevpur', 'মহাদেবপুর', '1nomohadevpurup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1415, 'Hatur', 'হাতুড়', '2nohaturup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1416, 'Khajur', 'খাজুর', '3nokhajurup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1417, 'Chandas', 'চাঁন্দাশ', '4nochandasup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1418, 'Enayetpur', 'এনায়েতপুর', '6noenayetpurup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1419, 'Sofapur', 'সফাপুর', '7nosofapurup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1420, 'Uttargram', 'উত্তরগ্রাম', '8nouttargramup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1421, 'Cheragpur', 'চেরাগপুর', '9nocheragpurup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1422, 'Vimpur', 'ভীমপুর', '10novimpurup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1423, 'Roygon', 'রাইগাঁ', 'roygonup . naogaon . gov . bd', 1, 160, NULL, NULL, NULL, NULL),
(1424, 'Badalgachi', 'বদলগাছী', '1nobadalgachiup . naogaon . gov . bd', 1, 161, NULL, NULL, NULL, NULL),
(1425, 'Mothurapur', 'মথুরাপুর', '2nomothurapurup . naogaon . gov . bd', 1, 161, NULL, NULL, NULL, NULL),
(1426, 'Paharpur', 'পাহারপুর', '3nopaharpurup . naogaon . gov . bd', 1, 161, NULL, NULL, NULL, NULL),
(1427, 'Mithapur', 'মিঠাপুর', '4nomithapurup . naogaon . gov . bd', 1, 161, NULL, NULL, NULL, NULL),
(1428, 'Kola', 'কোলা', '5nokolaup . naogaon . gov . bd', 1, 161, NULL, NULL, NULL, NULL),
(1429, 'Bilashbari', 'বিলাশবাড়ী', '6nobilashbariup . naogaon . gov . bd', 1, 161, NULL, NULL, NULL, NULL),
(1430, 'Adhaipur', 'আধাইপুর', '7noadhaipurup . naogaon . gov . bd', 1, 161, NULL, NULL, NULL, NULL),
(1431, 'Balubhara', 'বালুভরা', '8nobalubharaup . naogaon . gov . bd', 1, 161, NULL, NULL, NULL, NULL),
(1432, 'Patnitala', 'পত্নীতলা', '1nopatnitalaup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1433, 'Nirmail', 'নিমইল', '2nonirmailup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1434, 'Dibar', 'দিবর', '3nodibarup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1435, 'Akbarpur', 'আকবরপুর', '4noakbarpurup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1436, 'Matindar', 'মাটিন্দর', '5nomatindarup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1437, 'Krishnapur', 'কৃষ্ণপুর', '6nokrishnapurup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1438, 'Patichrara', 'পাটিচড়া', '7nopatichraraup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1439, 'Nazipur', 'নজিপুর', '8nonazipurup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1440, 'Ghasnagar', 'ঘষনগর', '9noghasnagarup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1441, 'Amair', 'আমাইড়', '10noamairup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1442, 'Shihara', 'শিহারা', '11noahiharaup . naogaon . gov . bd', 1, 162, NULL, NULL, NULL, NULL),
(1443, 'Dhamoirhat', 'ধামইরহাট', '1nodhamoirhatup . naogaon . gov . bd', 1, 163, NULL, NULL, NULL, NULL),
(1444, 'Alampur', 'আলমপুর', '3noalampurup . naogaon . gov . bd', 1, 163, NULL, NULL, NULL, NULL),
(1445, 'Umar', 'উমার', '4noumarup . naogaon . gov . bd', 1, 163, NULL, NULL, NULL, NULL),
(1446, 'Aranagar', 'আড়ানগর', '5noaranagarup . naogaon . gov . bd', 1, 163, NULL, NULL, NULL, NULL),
(1447, 'Jahanpur', 'জাহানপুর', '6nojahanpurup . naogaon . gov . bd', 1, 163, NULL, NULL, NULL, NULL),
(1448, 'Isabpur', 'ইসবপুর', '7noisabpurup . naogaon . gov . bd', 1, 163, NULL, NULL, NULL, NULL),
(1449, 'Khelna', 'খেলনা', '8nokhelnaup . naogaon . gov . bd', 1, 163, NULL, NULL, NULL, NULL),
(1450, 'Agradigun', 'আগ্রাদ্বিগুন', '2noagradigunup . naogaon . gov . bd', 1, 163, NULL, NULL, NULL, NULL),
(1451, 'Hajinagar', 'হাজীনগর', '1nohajinagarup . naogaon . gov . bd', 1, 164, NULL, NULL, NULL, NULL),
(1452, 'Chandannagar', 'চন্দননগর', '2nochandannagarup . naogaon . gov . bd', 1, 164, NULL, NULL, NULL, NULL),
(1453, 'Bhabicha', 'ভাবিচা', '3nobhabichaup . naogaon . gov . bd', 1, 164, NULL, NULL, NULL, NULL),
(1454, 'Niamatpur', 'নিয়ামতপুর', '4noniamatpurup . naogaon . gov . bd', 1, 164, NULL, NULL, NULL, NULL),
(1455, 'Rasulpur', 'রসুলপুর', '5norasulpurup . naogaon . gov . bd', 1, 164, NULL, NULL, NULL, NULL),
(1456, 'Paroil', 'পাড়ইল', '6noparoilup . naogaon . gov . bd', 1, 164, NULL, NULL, NULL, NULL),
(1457, 'Sremantapur', 'শ্রীমন্তপুর', '7nosremantapurup . naogaon . gov . bd', 1, 164, NULL, NULL, NULL, NULL),
(1458, 'Bahadurpur', 'বাহাদুরপুর', '8nobahadurpurup . naogaon . gov . bd', 1, 164, NULL, NULL, NULL, NULL),
(1459, 'Varsho', 'ভারশো', '1novarshoup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1460, 'Valain', 'ভালাইন', '2novalainup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1461, 'Paranpur', 'পরানপুর', '3noparanpurup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1462, 'Manda', 'মান্দা', '4nomandaup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1463, 'Goneshpur', 'গনেশপুর', '5nogoneshpurup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1464, 'Moinom', 'মৈনম', '6nomoinomup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1465, 'Proshadpur', 'প্রসাদপুর', '7noproshadpurup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1466, 'Kosomba', 'কুসুম্বা', '8nokosombaup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1467, 'Tetulia', 'তেঁতুলিয়া', '9notetuliaup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1468, 'Nurullabad', 'নূরুল্যাবাদ', '10nonurullabadup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1469, 'Kalikapur', 'কালিকাপুর', '11nokalikapurup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1470, 'Kashopara', 'কাঁশোকাপুর', '12nokashoparaup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1471, 'Koshob', 'কশব', '13nokoshobup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1472, 'Bisnopur', 'বিষ্ণপুর', '14nobisnopurup . naogaon . gov . bd', 1, 165, NULL, NULL, NULL, NULL),
(1473, 'Shahagola', 'শাহাগোলা', '1noshahagolaup . naogaon . gov . bd', 1, 166, NULL, NULL, NULL, NULL),
(1474, 'Bhonpara', 'ভোঁপড়া', '2nobhonparaup . naogaon . gov . bd', 1, 166, NULL, NULL, NULL, NULL),
(1475, 'Ahsanganj', 'আহসানগঞ্জ', '3noahsanganjup . naogaon . gov . bd', 1, 166, NULL, NULL, NULL, NULL),
(1476, 'Panchupur', 'পাঁচুপুর', '4nopanchupurup . naogaon . gov . bd', 1, 166, NULL, NULL, NULL, NULL),
(1477, 'Bisha', 'বিশা', '5nobishaup . naogaon . gov . bd', 1, 166, NULL, NULL, NULL, NULL),
(1478, 'Maniary', 'মনিয়ারী', '6nomaniaryup . naogaon . gov . bd', 1, 166, NULL, NULL, NULL, NULL),
(1479, 'Kalikapur', 'কালিকাপুর', '7nokalikapurup . naogaon . gov . bd', 1, 166, NULL, NULL, NULL, NULL),
(1480, 'Hatkalupara', 'হাটকালুপাড়া', '8nohatkaluparaup . naogaon . gov . bd', 1, 166, NULL, NULL, NULL, NULL),
(1481, 'Khatteshawr', 'খট্টেশ্বর রাণীনগর', '1nokhatteshawrup . naogaon . gov . bd', 1, 167, NULL, NULL, NULL, NULL),
(1482, 'Kashimpur', 'কাশিমপুর', '2nokashimpurup . naogaon . gov . bd', 1, 167, NULL, NULL, NULL, NULL),
(1483, 'Gona', 'গোনা', '3nogonaup . naogaon . gov . bd', 1, 167, NULL, NULL, NULL, NULL),
(1484, 'Paroil', 'পারইল', '4noparoilup . naogaon . gov . bd', 1, 167, NULL, NULL, NULL, NULL),
(1485, 'Borgoca', 'বরগাছা', '5noborgocaup . naogaon . gov . bd', 1, 167, NULL, NULL, NULL, NULL),
(1486, 'Kaligram', 'কালিগ্রাম', '6nokaligramup . naogaon . gov . bd', 1, 167, NULL, NULL, NULL, NULL),
(1487, 'Ekdala', 'একডালা', '7noekdalaup . naogaon . gov . bd', 1, 167, NULL, NULL, NULL, NULL),
(1488, 'Mirat', 'মিরাট', '8nomiratup . naogaon . gov . bd', 1, 167, NULL, NULL, NULL, NULL),
(1489, 'Barshail', 'বর্ষাইল', '1nobarshailup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1490, 'Kritipur', 'কির্ত্তিপুর', '2nokritipurup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1491, 'Baktiarpur', 'বক্তারপুর', '3nobaktiarpurup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1492, 'Tilakpur', 'তিলোকপুর', '4notilakpurup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1493, 'Hapaniya', 'হাপানিয়া', '5nohapaniyaup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1494, 'Dubalhati', 'দুবলহাটী', '6nodubalhatiup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1495, 'Boalia', 'বোয়ালিয়া', '7noboaliaup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1496, 'Hashaigari', 'হাঁসাইগাড়ী', '8nohashaigariup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1497, 'Chandipur', 'চন্ডিপুর', '9nochandipurup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1498, 'Bolihar', 'বলিহার', '10noboliharup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1499, 'Shekerpur', 'শিকারপুর', '11noshekerpurup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1500, 'Shailgachhi', 'শৈলগাছী', '12noshailgachhiup . naogaon . gov . bd', 1, 168, NULL, NULL, NULL, NULL),
(1501, 'Nitpur', 'নিতপুর', 'nitpurup . naogaon . gov . bd', 1, 169, NULL, NULL, NULL, NULL),
(1502, 'Tetulia', 'তেঁতুলিয়া', '2notetuliaup . naogaon . gov . bd', 1, 169, NULL, NULL, NULL, NULL),
(1503, 'Chhaor', 'ছাওড়', '3nochhaorup . naogaon . gov . bd', 1, 169, NULL, NULL, NULL, NULL),
(1504, 'Ganguria', 'গাঙ্গুরিয়া', '4noganguriaup . naogaon . gov . bd', 1, 169, NULL, NULL, NULL, NULL),
(1505, 'Ghatnagar', 'ঘাটনগর', '5noghatnagarup . naogaon . gov . bd', 1, 169, NULL, NULL, NULL, NULL),
(1506, 'Moshidpur', 'মশিদপুর', '6nomoshidpurup . naogaon . gov . bd', 1, 169, NULL, NULL, NULL, NULL);
INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(1507, 'Sapahar', 'সাপাহার', '1nosapaharup . naogaon . gov . bd', 1, 170, NULL, NULL, NULL, NULL),
(1508, 'Tilna', 'তিলনা', '3notilnaup . naogaon . gov . bd', 1, 170, NULL, NULL, NULL, NULL),
(1509, 'Aihai', 'আইহাই', '4noaihaiup . naogaon . gov . bd', 1, 170, NULL, NULL, NULL, NULL),
(1510, 'Shironti', 'শিরন্টী', '6noshirontiup . naogaon . gov . bd', 1, 170, NULL, NULL, NULL, NULL),
(1511, 'Goala', 'গোয়ালা', 'goalaup . naogaon . gov . bd', 1, 170, NULL, NULL, NULL, NULL),
(1512, 'Patari', 'পাতাড়ী', 'patariup . naogaon . gov . bd', 1, 170, NULL, NULL, NULL, NULL),
(1513, 'Nehalpur', 'নেহালপুর', 'nehalpurup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1514, 'Hariharnagar', 'হরিহরনগর', 'hariharnagarup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1515, 'Haridaskati', 'হরিদাসকাটি', 'haridaskatiup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1516, 'Shyamkur', 'শ্যামকুড়', 'shyamkurup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1517, 'Rohita', 'রোহিতা', 'rohitaup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1518, 'Maswimnagar', 'মশ্মিমনগর', 'maswimnagarup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1519, 'Manoharpur', 'মনোহরপুর', 'manoharpurup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1520, 'Manirampur', 'মনিরামপুর', 'manirampurup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1521, 'Bhojgati', 'ভোজগাতি', 'bhojgatiup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1522, 'Durbadanga', 'দুর্বাডাংগা', 'durbadangaup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1523, 'Dhakuria', 'ঢাকুরিয়া', 'dhakuriaup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1524, 'Jhanpa', 'ঝাঁপা', 'jhanpaup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1525, 'Chaluahati', 'চালুয়াহাটি', 'chaluahatiup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1526, 'Khedapara', 'খেদাপাড়া', 'khedaparaup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1527, 'Khanpur', 'খানপুর', 'khanpurup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1528, 'Kultia', 'কুলটিয়া', 'kultiaup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1529, 'Kashimnagar', 'কাশিমনগর', 'kashimnagarup . jessore . gov . bd', 1, 171, NULL, NULL, NULL, NULL),
(1530, 'Baghutia', 'বাঘুটিয়া', 'baghutia . jessore . gov . bd', 1, 172, NULL, NULL, NULL, NULL),
(1531, 'Chalishia', 'চলিশিয়া', 'chalishiaup . jessore . gov . bd', 1, 172, NULL, NULL, NULL, NULL),
(1532, 'Sundoli', 'সুন্দলী', 'sundoliup . jessore . gov . bd', 1, 172, NULL, NULL, NULL, NULL),
(1533, 'Siddhipasha', 'সিদ্দিপাশা', 'siddhipashaup . jessore . gov . bd', 1, 172, NULL, NULL, NULL, NULL),
(1534, 'Sreedharpur', 'শ্রীধরপুর', 'sreedharpurup . jessore . gov . bd', 1, 172, NULL, NULL, NULL, NULL),
(1535, 'Subharara', 'শুভরাড়া', 'subhararaup . jessore . gov . bd', 1, 172, NULL, NULL, NULL, NULL),
(1536, 'Prambag', 'প্রেমবাগ', 'prambagup . jessore . gov . bd', 1, 172, NULL, NULL, NULL, NULL),
(1537, 'Payra', 'পায়রা', 'payraup . jessore . gov . bd', 1, 172, NULL, NULL, NULL, NULL),
(1538, 'Jaharpur', 'জহুরপুর', 'jaharpurup . jessore . gov . bd', 1, 173, NULL, NULL, NULL, NULL),
(1539, 'Jamdia', 'জামদিয়া', 'jamdiaup . jessore . gov . bd', 1, 173, NULL, NULL, NULL, NULL),
(1540, 'Darajhat', 'দরাজহাট', 'darajhatup . jessore . gov . bd', 1, 173, NULL, NULL, NULL, NULL),
(1541, 'Dhalgram', 'ধলগ্রাম', 'dhalgramup . jessore . gov . bd', 1, 173, NULL, NULL, NULL, NULL),
(1542, 'Narikelbaria', 'নারিকেলবাড়ীয়া', 'narikelbariaup . jessore . gov . bd', 1, 173, NULL, NULL, NULL, NULL),
(1543, 'Bandabilla', 'বন্দবিলা', 'bandabillaup . jessore . gov . bd', 1, 173, NULL, NULL, NULL, NULL),
(1544, 'Basuari', 'বাসুয়াড়ী', 'basuariup . jessore . gov . bd', 1, 173, NULL, NULL, NULL, NULL),
(1545, 'Roypur', 'রায়পুর', 'roypurup . jessore . gov . bd', 1, 173, NULL, NULL, NULL, NULL),
(1546, 'Dohakula', 'দোহাকুলা', 'dohakulaup . jessore . gov . bd', 1, 173, NULL, NULL, NULL, NULL),
(1547, 'Chougachha', 'চৌগাছা', 'chougachhaup5 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1548, 'Jagadishpur', 'জগদীশপুর', 'jagadishpurup6 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1549, 'Dhuliani', 'ধুলিয়ানী', 'dhulianiup4 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1550, 'Narayanpur', 'নারায়নপুর', 'narayanpurup10 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1551, 'Patibila', 'পাতিবিলা', 'patibilaup7 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1552, 'Pashapole', 'পাশাপোল', 'pashapoleup2 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1553, 'Fulsara', 'ফুলসারা', 'fulsaraup1 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1554, 'Singhajhuli', 'সিংহঝুলি', 'singhajhuliup3 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1555, 'Sukpukhuria', 'সুখপুকুরিয়া', 'sukpukhuriaup11 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1556, 'Swarupdaha', 'সরুপদাহ', 'swarupdahaup9 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1557, 'Hakimpur', 'হাকিমপুর', 'hakimpurup8 . jessore . gov . bd', 1, 174, NULL, NULL, NULL, NULL),
(1558, 'Gangananda', 'গংগানন্দপুর', 'ganganandapurup . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1559, 'Gadkhali', 'গদখালী', 'gadkhaliup . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1560, 'Jhikargachha', 'ঝিকরগাছা', 'jhikargachhaup . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1561, 'Nabharan', 'নাভারন', 'nabharanup . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1562, 'Nibaskhola', 'নির্বাসখোলা', 'nibaskholaup . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1563, 'Panisara', 'পানিসারা', 'panisaraup . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1564, 'Bankra', 'বাঁকড়া', 'bankraup . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1565, 'Shankarpur', 'শংকরপুর', 'shankarpurup10 . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1566, 'Shimulia', 'শিমুলিয়া', 'shimuliaup3 . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1567, 'Hajirbagh', 'হাজিরবাগ', 'hajirbaghup9 . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1568, 'Magura', 'মাগুরা', 'maguraup . jessore . gov . bd', 1, 175, NULL, NULL, NULL, NULL),
(1569, 'Sufalakati', 'সুফলাকাটি', 'sufalakatiup8 . jessore . gov . bd', 1, 176, NULL, NULL, NULL, NULL),
(1570, 'Sagardari', 'সাগরদাড়ী', 'sagardariup2 . jessore . gov . bd', 1, 176, NULL, NULL, NULL, NULL),
(1571, 'Majidpur', 'মজিদপুর', 'majidpurup3 . jessore . gov . bd', 1, 176, NULL, NULL, NULL, NULL),
(1572, 'Mongolkot', 'মঙ্গলকোর্ট', 'mongolkotup5 . jessore . gov . bd', 1, 176, NULL, NULL, NULL, NULL),
(1573, 'Bidyanandakati', 'বিদ্যানন্দকাটি', 'bidyanandakatiup4 . jessore . gov . bd', 1, 176, NULL, NULL, NULL, NULL),
(1574, 'Panjia', 'পাজিয়া', 'panjiaup7 . jessore . gov . bd', 1, 176, NULL, NULL, NULL, NULL),
(1575, 'Trimohini', 'ত্রিমোহিনী', 'trimohiniup1 . jessore . gov . bd', 1, 176, NULL, NULL, NULL, NULL),
(1576, 'Gaurighona', 'গৌরিঘোনা', 'gaurighonaup9 . jessore . gov . bd', 1, 176, NULL, NULL, NULL, NULL),
(1577, 'Keshabpur', 'কেশবপুর', 'keshabpurup6 . jessore . gov . bd', 1, 176, NULL, NULL, NULL, NULL),
(1578, 'Lebutala', 'লেবুতলা', 'lebutalaup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1579, 'Ichhali', 'ইছালী', 'ichhaliup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1580, 'Arabpur', 'আরবপুর', 'arabpurup9 . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1581, 'Upasahar', 'উপশহর', 'upasaharup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1582, 'Kachua', 'কচুয়া', 'kachuaup13 . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1583, 'Kashimpur', 'কাশিমপুর', 'kashimpurup6 . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1584, 'Chanchra', 'চাঁচড়া', 'chanchraup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1585, 'Churamankati', 'চূড়ামনকাটি', 'churamankatiup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1586, 'Narendrapur', 'নরেন্দ্রপুর', 'narendrapurup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1587, 'Noapara', 'নওয়াপাড়া', 'noaparaup4 . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1588, 'Fathehpur', 'ফতেপুর', 'fathehpurup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1589, 'Basundia', 'বসুন্দিয়া', 'basundiaup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1590, 'Ramnagar', 'রামনগর', 'ramnagarup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1591, 'Haibatpur', 'হৈবতপুর', 'haibatpurup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1592, 'Dearamodel', 'দেয়ারা মডেল', 'dearamodelup . jessore . gov . bd', 1, 177, NULL, NULL, NULL, NULL),
(1593, 'Ulshi', 'উলশী', 'ulshiup9 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1594, 'Sharsha', 'শার্শা', 'sharshaup10 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1595, 'Lakshmanpur', 'লক্ষণপুর', 'lakshmanpurup2 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1596, 'Benapole', 'বেনাপোল', 'benapoleup4 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1597, 'Bahadurpur', 'বাহাদুরপুর', 'bahadurpurup3 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1598, 'Bagachra', 'বাগআচড়া', 'bagachraup8 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1599, 'Putkhali', 'পুটখালী', 'putkhaliup5 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1600, 'Nizampur', 'নিজামপুর', 'nizampurup11 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1601, 'Dihi', 'ডিহি', 'dihiup1 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1602, 'Goga', 'গোগা', 'gogaup6 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1603, 'Kayba', 'কায়বা', 'kaybaup7 . jessore . gov . bd', 1, 178, NULL, NULL, NULL, NULL),
(1604, 'Anulia', 'আনুলিয়া', 'anuliaup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1605, 'Assasuni', 'আশাশুনি', 'assasuniup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1606, 'Kadakati', 'কাদাকাটি', 'kadakatiup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1607, 'Kulla', 'কুল্যা', 'kullaup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1608, 'Khajra', 'খাজরা', 'khajraup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1609, 'Durgapur', 'দরগাহপুর', 'durgapurup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1610, 'Pratapnagar', 'প্রতাপনগর', 'pratapnagarup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1611, 'Budhhata', 'বুধহাটা', 'budhhataup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1612, 'Baradal', 'বড়দল', 'baradalup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1613, 'Sreeula', 'শ্রীউলা', 'sreeulaup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1614, 'Sobhnali', 'শোভনালী', 'sobhnaliup . satkhira . gov . bd', 1, 179, NULL, NULL, NULL, NULL),
(1615, 'Kulia', 'কুলিয়া', 'kuliaup . satkhira . gov . bd', 1, 180, NULL, NULL, NULL, NULL),
(1616, 'Debhata', 'দেবহাটা', 'debhataup . satkhira . gov . bd', 1, 180, NULL, NULL, NULL, NULL),
(1617, 'Noapara', 'নওয়াপাড়া', 'noaparaup . satkhira . gov . bd', 1, 180, NULL, NULL, NULL, NULL),
(1618, 'Parulia', 'পারুলিয়া', 'paruliaup . satkhira . gov . bd', 1, 180, NULL, NULL, NULL, NULL),
(1619, 'Sakhipur', 'সখিপুর', 'sakhipurup . satkhira . gov . bd', 1, 180, NULL, NULL, NULL, NULL),
(1620, 'Kushadanga', 'কুশোডাংগা', 'kushadangaup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1621, 'Keralkata', 'কেরালকাতা', 'keralkataup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1622, 'Keragachhi', 'কেঁড়াগাছি', 'keragachhiup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1623, 'Kaila', 'কয়লা', 'kailaup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1624, 'Jallabad', 'জালালাবাদ', 'jallabadup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1625, 'Jogikhali', 'যুগিখালী', 'jogikhaliup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1626, 'Langaljhara', 'লাঙ্গলঝাড়া', 'langaljharaup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1627, 'Sonabaria', 'সোনাবাড়িয়া', 'sonabariaup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1628, 'Helatala', 'হেলাতলা', 'helatalaup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1629, 'Chandanpur', 'চন্দনপুর', 'chandanpurup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1630, 'Deara', 'দেয়ারা', 'dearaup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1631, 'Joynagar', 'জয়নগর', 'joynagarup . satkhira . gov . bd', 1, 181, NULL, NULL, NULL, NULL),
(1632, 'Shibpur', 'শিবপুর', 'shibpurup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1633, 'Labsa', 'লাবসা', 'labsaup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1634, 'Bhomra', 'ভোমরা', 'bhomraup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1635, 'Brahmarajpur', 'ব্রক্ষ্মরাজপুর', 'brahmarajpurup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1636, 'Balli', 'বল্লী', 'balliup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1637, 'Banshdaha', 'বাঁশদহ', 'banshdahaup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1638, 'Baikari', 'বৈকারী', 'baikariup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1639, 'Fingri', 'ফিংড়ি', 'fingriup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1640, 'Dhulihar', 'ধুলিহর', 'dhuliharup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1641, 'Jhaudanga', 'ঝাউডাঙ্গা', 'jhaudangaup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1642, 'Ghona', 'ঘোনা', 'ghonaup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1643, 'Kuskhali', 'কুশখালী', 'kuskhaliup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1644, 'Alipur', 'আলিপুর', 'alipurup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1645, 'Agardari', 'আগরদাড়ী', 'agardariup . satkhira . gov . bd', 1, 182, NULL, NULL, NULL, NULL),
(1646, 'Atulia', 'আটুলিয়া', 'atuliaup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1647, 'Ishwaripur', 'ঈশ্বরীপুর', 'ishwaripurup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1648, 'Kaikhali', 'কৈখালী', 'kaikhaliup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1649, 'Kashimari', 'কাশিমাড়ী', 'kashimariup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1650, 'Nurnagar', 'নুরনগর', 'nurnagarup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1651, 'Padmapukur', 'পদ্মপুকুর', 'padmapukurup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1652, 'Burigoalini', 'বুড়িগোয়ালিনী', 'burigoaliniup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1653, 'Bhurulia', 'ভুরুলিয়া', 'bhuruliaup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1654, 'Munshiganj', 'মুন্সীগজ্ঞ', 'munshiganjup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1655, 'Ramjannagar', 'রমজাননগর', 'ramjannagarup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1656, 'Shyamnagar', 'শ্যামনগর', 'shyamnagarup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1657, 'Gabura', 'গাবুরা', 'gaburaup . satkhira . gov . bd', 1, 183, NULL, NULL, NULL, NULL),
(1658, 'Sarulia', 'সরুলিয়া', 'saruliaup3 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1659, 'Magura', 'মাগুরা', 'maguraup8 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1660, 'Nagarghata', 'নগরঘাটা', 'nagarghataup1 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1661, 'Dhandia', 'ধানদিয়া', 'dhandiaup1 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1662, 'Tentulia', 'তেতুলিয়া', 'tentuliaup5 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1663, 'Tala', 'তালা', 'talaup6 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1664, 'Jalalpur', 'জালালপুর', 'jalalpurup11 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1665, 'Khesra', 'খেশরা', 'khesraup10 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1666, 'Khalishkhali', 'খলিশখালী', 'khalishkhaliup9 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1667, 'Khalilnagar', 'খলিলনগর', 'khalilnagarup12 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1668, 'Kumira', 'কুমিরা', 'kumiraup4 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1669, 'Islamkati', 'ইসলামকাটি', 'islamkatiup7 . satkhira . gov . bd', 1, 184, NULL, NULL, NULL, NULL),
(1670, 'Kushlia', 'কুশুলিয়া', 'kushliaup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1671, 'Champaphul', 'চাম্পাফুল', 'champaphulup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1672, 'Tarali', 'তারালী', 'taraliup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1673, 'Dakshin Sreepur', 'দক্ষিণ শ্রীপুর', 'dakshinsreepurup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1674, 'Dhalbaria', 'ধলবাড়িয়া', 'dhalbariaup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1675, 'Nalta', 'নলতা', 'naltaup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1676, 'Bishnupur', 'বিষ্ণুপুর', 'bishnupurup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1677, 'Bharasimla', 'ভাড়াশিমলা', 'bharasimlaup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1678, 'Mathureshpur', 'মথুরেশপুর', 'mathureshpurup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1679, 'Ratanpur', 'রতনপুর', 'ratanpurup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1680, 'Mautala', 'মৌতলা', 'mautalaup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1681, 'Krishnanagar', 'কৃষ্ণনগর', 'krishnanagarup . satkhira . gov . bd', 1, 185, NULL, NULL, NULL, NULL),
(1682, 'Dariapur', 'দারিয়াপুর', 'dariapurup . meherpur . gov . bd', 1, 186, NULL, NULL, NULL, NULL),
(1683, 'Monakhali', 'মোনাখালী', 'monakhali . meherpur . gov . bd', 1, 186, NULL, NULL, NULL, NULL),
(1684, 'Bagowan', 'বাগোয়ান', 'bagowanup . meherpur . gov . bd', 1, 186, NULL, NULL, NULL, NULL),
(1685, 'Mohajanpur', 'মহাজনপুর', 'mohajanpurup . meherpur . gov . bd', 1, 186, NULL, NULL, NULL, NULL),
(1686, 'Amjhupi', 'আমঝুপি', 'amjhupi . meherpur . gov . bd', 1, 187, NULL, NULL, NULL, NULL),
(1687, 'Pirojpur', 'পিরোজপুর', 'pirojpurup . meherpur . gov . bd', 1, 187, NULL, NULL, NULL, NULL),
(1688, 'Kutubpur', 'কতুবপুর', 'kutubpurup . meherpur . gov . bd', 1, 187, NULL, NULL, NULL, NULL),
(1689, 'Amdah', 'আমদহ', 'amdahup . meherpur . gov . bd', 1, 187, NULL, NULL, NULL, NULL),
(1690, 'Buripota', 'বুড়িপোতা', 'buripotaup . meherpur . gov . bd', 1, 187, NULL, NULL, NULL, NULL),
(1691, 'Tentulbaria', 'তেঁতুলবাড়ীয়া', 'tentulbaria . meherpur . gov . bd', 1, 188, NULL, NULL, NULL, NULL),
(1692, 'Kazipur', 'কাজিপুর', 'kazipurup . meherpur . gov . bd', 1, 188, NULL, NULL, NULL, NULL),
(1693, 'Bamondi', 'বামন্দী', 'bamondiup . meherpur . gov . bd', 1, 188, NULL, NULL, NULL, NULL),
(1694, 'Motmura', 'মটমুড়া', 'motmuraup . meherpur . gov . bd', 1, 188, NULL, NULL, NULL, NULL),
(1695, 'Sholotaka', 'ষোলটাকা', 'sholotakaup . meherpur . gov . bd', 1, 188, NULL, NULL, NULL, NULL),
(1696, 'Shaharbati', 'সাহারবাটী', 'shaharbatiup . meherpur . gov . bd', 1, 188, NULL, NULL, NULL, NULL),
(1697, 'Dhankolla', 'ধানখোলা', 'dhankollaup . meherpur . gov . bd', 1, 188, NULL, NULL, NULL, NULL),
(1698, 'Raipur', 'রায়পুর', 'raipurup . meherpur . gov . bd', 1, 188, NULL, NULL, NULL, NULL),
(1699, 'Kathuli', 'কাথুলী', 'kathuli . meherpur . gov . bd', 1, 188, NULL, NULL, NULL, NULL),
(1700, 'Sheikhati', 'সেখহাটী', 'sheikhatiup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1701, 'Tularampur', 'তুলারামপুর', 'tularampurup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1702, 'Kalora', 'কলোড়া', 'kaloraup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1703, 'Shahabad', 'শাহাবাদ', 'shahabadup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1704, 'Bashgram', 'বাশগ্রাম', 'bashgramup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1705, 'Habokhali', 'হবখালী', 'habokhaliup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1706, 'Maijpara', 'মাইজপাড়া', 'maijparaup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1707, 'Bisali', 'বিছালী', 'bisaliup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1708, 'Chandiborpur', 'চন্ডিবরপুর', 'chandiborpurup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1709, 'Bhadrabila', 'ভদ্রবিলা', 'bhadrabilaup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1710, 'Auria', 'আউড়িয়া', 'auriaup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1711, 'Singasholpur', 'সিঙ্গাশোলপুর', 'singasholpurup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1712, 'Mulia', 'মুলিয়া', 'muliaup . narail . gov . bd', 1, 189, NULL, NULL, NULL, NULL),
(1713, 'Lohagora', 'লোহাগড়া', 'lohagoraup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1714, 'Kashipur', 'কাশিপুর', 'kashipurup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1715, 'Naldi', 'নলদী', 'naldiup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1716, 'Noagram', 'নোয়াগ্রাম', 'noagramup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1717, 'Lahuria', 'লাহুড়িয়া', 'lahuriaup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1718, 'Mallikpur', 'মল্লিকপুর', 'mallikpurup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1719, 'Salnagar', 'শালনগর', 'salnagarup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1720, 'Lakshmipasha', 'লক্ষীপাশা', 'lakshmipashaup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1721, 'Joypur', 'জয়পুর', 'joypurup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1722, 'Kotakol', 'কোটাকোল', 'kotakolup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1723, 'Digholia', 'দিঘলিয়া', 'digholiaup1 . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1724, 'Itna', 'ইতনা', 'itnaup . narail . gov . bd', 1, 190, NULL, NULL, NULL, NULL),
(1725, 'Jaynagor', 'জয়নগর', 'jaynagorup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1726, 'Pahordanga', 'পহরডাঙ্গা', 'pahordangaup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1727, 'Babrahasla', 'বাবরা - হাচলা', 'babrahaslaup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1728, 'Salamabad', 'সালামাবাদ', 'salamabadup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1729, 'Baioshona', 'বাঐসোনা', 'baioshonaup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1730, 'Chacuri', 'চাচুড়ী', 'chacuriup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1731, 'Hamidpur', 'হামিদপুর', 'hamidpurup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1732, 'Peroli', 'পেড়লী', 'peroliup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1733, 'Khashial', 'খাসিয়াল', 'khashialup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1734, 'Purulia', 'পুরুলিয়া', 'puruliaup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1735, 'Kalabaria', 'কলাবাড়ীয়া', 'kalabariaup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1736, 'Mauli', 'মাউলী', 'mauliup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1737, 'Boronaleliasabad', 'বড়নাল - ইলিয়াছাবাদ', 'boronaleliasabadup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1738, 'Panchgram', 'পাঁচগ্রাম', 'panchgramup . narail . gov . bd', 1, 191, NULL, NULL, NULL, NULL),
(1739, 'Alukdia', 'আলুকদিয়া', 'alukdia . chuadanga . gov . bd', 1, 192, NULL, NULL, NULL, NULL),
(1740, 'Mominpur', 'মোমিনপুর', 'mominpur . chuadanga . gov . bd', 1, 192, NULL, NULL, NULL, NULL),
(1741, 'Titudah', 'তিতুদাহ', 'titudah . chuadanga . gov . bd', 1, 192, NULL, NULL, NULL, NULL),
(1742, 'Shankarchandra', 'শংকরচন্দ্র', 'shankarchandra . chuadanga . gov . bd', 1, 192, NULL, NULL, NULL, NULL),
(1743, 'Begumpur', 'বেগমপুর', 'begumpur . chuadanga . gov . bd', 1, 192, NULL, NULL, NULL, NULL),
(1744, 'Kutubpur', 'কুতুবপুর', 'kutubpur . chuadanga . gov . bd', 1, 192, NULL, NULL, NULL, NULL),
(1745, 'Padmabila', 'পদ্মবিলা', 'padmabila . chuadanga . gov . bd', 1, 192, NULL, NULL, NULL, NULL),
(1746, 'Bhangbaria', 'ভাংবাড়ীয়া', 'bhangbaria . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1747, 'Baradi', 'বাড়াদী', 'baradiup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1748, 'Gangni', 'গাংনী', 'gangniup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1749, 'Khadimpur', 'খাদিমপুর', 'khadimpurup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1750, 'Jehala', 'জেহালা', 'jehalaup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1751, 'Belgachi', 'বেলগাছি', 'belgachiup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1752, 'Dauki', 'ডাউকী', 'daukiup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1753, 'Jamjami', 'জামজামি', 'jamjamiup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1754, 'Nagdah', 'নাগদাহ', 'nagdahup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1755, 'Kashkorara', 'খাসকররা', 'kashkoraraup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1756, 'Chitla', 'চিৎলা', 'chitlaup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1757, 'Kalidashpur', 'কালিদাসপুর', 'kalidashpurup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1758, 'Kumari', 'কুমারী', 'kumariup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1759, 'Hardi', 'হারদী', 'hardiup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1760, 'Ailhash', 'আইলহাঁস', 'ailhashup . chuadanga . gov . bd', 1, 193, NULL, NULL, NULL, NULL),
(1761, 'Damurhuda', 'দামুড়হুদা', 'damurhudaup . chuadanga . gov . bd', 1, 194, NULL, NULL, NULL, NULL),
(1762, 'Karpashdanga', 'কার্পাসডাঙ্গা', 'karpashdanga . chuadanga . gov . bd', 1, 194, NULL, NULL, NULL, NULL),
(1763, 'Natipota', 'নতিপোতা', 'natipota . chuadanga . gov . bd', 1, 194, NULL, NULL, NULL, NULL),
(1764, 'Hawli', 'হাওলী', 'hawli . chuadanga . gov . bd', 1, 194, NULL, NULL, NULL, NULL),
(1765, 'Kurulgachhi', 'কুড়ালগাছী', 'kurulgachhi . chuadanga . gov . bd', 1, 194, NULL, NULL, NULL, NULL),
(1766, 'Perkrishnopur Madna', 'পারকৃষ্ণপুর মদনা', 'perkrishnopurmadna . chuadanga . gov . bd', 1, 194, NULL, NULL, NULL, NULL),
(1767, 'Juranpur', 'জুড়ানপুর', 'juranpurup . chuadanga . gov . bd', 1, 194, NULL, NULL, NULL, NULL),
(1768, 'Uthali', 'উথলী', 'uthaliup . chuadanga . gov . bd', 1, 195, NULL, NULL, NULL, NULL),
(1769, 'Andulbaria', 'আন্দুলবাড়ীয়া', 'andulbaria . chuadanga . gov . bd', 1, 195, NULL, NULL, NULL, NULL),
(1770, 'Banka', 'বাঁকা', 'bankaup . chuadanga . gov . bd', 1, 195, NULL, NULL, NULL, NULL),
(1771, 'Shimanto', 'সীমান্ত', 'shimanto . chuadanga . gov . bd', 1, 195, NULL, NULL, NULL, NULL),
(1772, 'Raypur', 'রায়পুর', 'raypurup . chuadanga . gov . bd', 1, 195, NULL, NULL, NULL, NULL),
(1773, 'Hasadah', 'হাসাদাহ', 'hasadahup . chuadanga . gov . bd', 1, 195, NULL, NULL, NULL, NULL),
(1774, 'Hatash Haripur', 'হাটশ হরিপুর', '1nohatashharipurup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1775, 'Barkhada', 'বারখাদা', '2nobarkhadaup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1776, 'Mazampur', 'মজমপুর', '3nomazampurup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1777, 'Bottail', 'বটতৈল', '4nobottailup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1778, 'Alampur', 'আলামপুর', '5noalampurup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1779, 'Ziaraakhi', 'জিয়ারাখী', '6noziaraakhiup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1780, 'Ailchara', 'আইলচারা', '7noailcharaup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1781, 'Patikabari', 'পাটিকাবাড়ী', '8nopatikabariup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1782, 'Jhaudia', 'ঝাউদিয়া', '9nojhaudiaup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1783, 'Ujangram', 'উজানগ্রাম', '10noujangramup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1784, 'Abdulpur', 'আব্দালপুর', '11noabdulpurup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1785, 'Harinarayanpur', 'হরিনারায়নপুর', '12noharinarayanpurup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1786, 'Monohardia', 'মনোহরদিয়া', '13nomonohardiaup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1787, 'Goswami Durgapur', 'গোস্বামী দুর্গাপুর', '14nogoswamidurgapurup . kushtia . gov . bd', 1, 196, NULL, NULL, NULL, NULL),
(1788, 'Kaya', 'কয়া', '1nokayaup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1789, 'Jagonnathpur', 'জগন্নাথপুর', '3nojagonnathpurup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1790, 'Sadki', 'সদকী', '4nosadkiup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1791, 'Shelaidah', 'শিলাইদহ', '2noshelaidahup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1792, 'Nandolalpur', 'নন্দলালপুর', '5nonandolalpurup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1793, 'Chapra', 'চাপড়া', '6nochapraup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1794, 'Bagulat', 'বাগুলাট', '7nobagulatup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1795, 'Jaduboyra', 'যদুবয়রা', '8nojaduboyraup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1796, 'Chadpur', 'চাঁদপুর', '9nochadpurup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1797, 'Panti', 'পান্টি', '10nopantiup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1798, 'Charsadipur', 'চরসাদীপুর', '11nocharsadipurup . kushtia . gov . bd', 1, 197, NULL, NULL, NULL, NULL),
(1799, 'Khoksa', 'খোকসা', '1nokhoksaup . kushtia . gov . bd', 1, 198, NULL, NULL, NULL, NULL),
(1800, 'Osmanpur', 'ওসমানপুর', '2noosmanpurup . kushtia . gov . bd', 1, 198, NULL, NULL, NULL, NULL),
(1801, 'Janipur', 'জানিপুর', '4nojanipurup . kushtia . gov . bd', 1, 198, NULL, NULL, NULL, NULL),
(1802, 'Shimulia', 'শিমুলিয়া', '5noshimuliaup . kushtia . gov . bd', 1, 198, NULL, NULL, NULL, NULL),
(1803, 'Joyntihazra', 'জয়ন্তীহাজরা', '8nojoyntihazraup . kushtia . gov . bd', 1, 198, NULL, NULL, NULL, NULL),
(1804, 'Ambaria', 'আমবাড়ীয়া', '9noambariaup . kushtia . gov . bd', 1, 198, NULL, NULL, NULL, NULL),
(1805, 'Bethbaria', 'বেতবাড়ীয়া', '3nobethbariaup . kushtia . gov . bd', 1, 198, NULL, NULL, NULL, NULL),
(1806, 'Shomospur', 'শোমসপুর', '6noshomospurup . kushtia . gov . bd', 1, 198, NULL, NULL, NULL, NULL),
(1807, 'Gopgram', 'গোপগ্রাম', 'gopgram7up . kushtia . gov . bd', 1, 198, NULL, NULL, NULL, NULL),
(1808, 'Chithalia', 'চিথলিয়া', 'chithaliaup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1809, 'Bahalbaria', 'বহলবাড়ীয়া', 'bahalbariaup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1810, 'Talbaria', 'তালবাড়ীয়া', 'talbariaup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1811, 'Baruipara', 'বারুইপাড়া', 'baruiparaup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1812, 'Fulbaria', 'ফুলবাড়ীয়া', 'fulbariaup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1813, 'Amla', 'আমলা', 'amlaup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1814, 'Sadarpur', 'সদরপুর', 'sadarpurup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1815, 'Chhatian', 'ছাতিয়ান', 'chhatianup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1816, 'Poradaha', 'পোড়াদহ', 'poradahaup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1817, 'Kursha', 'কুর্শা', 'kurshaup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1818, 'Ambaria', 'আমবাড়ীয়া', 'ambariaup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1819, 'Dhubail', 'ধূবইল', 'dhubailup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1820, 'Malihad', 'মালিহাদ', '11nomalihadup . kushtia . gov . bd', 1, 199, NULL, NULL, NULL, NULL),
(1821, 'Daulatpur', 'দৌলতপুর', 'daulatpurup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1822, 'Adabaria', 'ড়ীয়া', 'adabariaup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1823, 'Hogolbaria', 'হোগলবাড়ীয়া', 'hogolbariaup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1824, 'Boalia', 'বোয়ালি', 'boaliaup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1825, 'Philipnagor', 'ফিলিপনগর', 'philipnagorup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1826, 'Aria', 'আড়িয়া', 'ariaup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1827, 'Khalishakundi', 'খলিশাকুন্ডি', 'khalishakundiup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1828, 'Chilmary', 'চিলমারী', 'chilmaryup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1829, 'Mothurapur', 'মথুরাপুর', 'mothurapurup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1830, 'Pragpur', 'প্রাগপুর', 'pragpurup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1831, 'Piarpur', 'পিয়ারপুর', 'piarpurup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1832, 'Moricha', 'মরিচা', 'morichaup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1833, 'Refaitpur', 'রিফাইতপুর', '9norefaitpurup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1834, 'Ramkrishnopur', 'রামকৃষ্ণপুর', '5noramkrishnopurup . kushtia . gov . bd', 1, 200, NULL, NULL, NULL, NULL),
(1835, 'Dharampur', 'ধরমপুর', '5nodharampurup . kushtia . gov . bd', 1, 201, NULL, NULL, NULL, NULL),
(1836, 'Bahirchar', 'বাহিরচর', '3nobahircharup . kushtia . gov . bd', 1, 201, NULL, NULL, NULL, NULL),
(1837, 'Mukarimpur', 'মোকারিমপুর', '2nomukarimpurup . kushtia . gov . bd', 1, 201, NULL, NULL, NULL, NULL),
(1838, 'Juniadah', 'জুনিয়াদহ', '6nojuniadahup . kushtia . gov . bd', 1, 201, NULL, NULL, NULL, NULL),
(1839, 'Chandgram', 'চাঁদগ্রাম', '4nochandgramup . kushtia . gov . bd', 1, 201, NULL, NULL, NULL, NULL),
(1840, 'Bahadurpur', 'বাহাদুরপুর', '1nobahadurpurup . kushtia . gov . bd', 1, 201, NULL, NULL, NULL, NULL),
(1841, 'Dhaneshwargati', 'ধনেশ্বরগাতী', 'dhaneshwargatiup . magura . gov . bd', 1, 202, NULL, NULL, NULL, NULL),
(1842, 'Talkhari', 'তালখড়ি', 'talkhariup . magura . gov . bd', 1, 202, NULL, NULL, NULL, NULL),
(1843, 'Arpara', 'আড়পাড়া', 'arparaup . magura . gov . bd', 1, 202, NULL, NULL, NULL, NULL),
(1844, 'Shatakhali', 'শতখালী', 'shatakhaliup . magura . gov . bd', 1, 202, NULL, NULL, NULL, NULL),
(1845, 'Shalikha', 'শালিখা', 'shalikhaup . magura . gov . bd', 1, 202, NULL, NULL, NULL, NULL),
(1846, 'Bunagati', 'বুনাগাতী', 'bunagatiup . magura . gov . bd', 1, 202, NULL, NULL, NULL, NULL),
(1847, 'Gongarampur', 'গঙ্গারামপুর', 'gongarampurup . magura . gov . bd', 1, 202, NULL, NULL, NULL, NULL),
(1848, 'Goyespur', 'গয়েশপুর', 'goyespurup . magura . gov . bd', 1, 203, NULL, NULL, NULL, NULL),
(1849, 'Sreekol', 'শ্রীকোল', 'sreekolup . magura . gov . bd', 1, 203, NULL, NULL, NULL, NULL),
(1850, 'Dariapur', 'দ্বারিয়াপুর', 'dariapurup . magura . gov . bd', 1, 203, NULL, NULL, NULL, NULL),
(1851, 'Kadirpara', 'কাদিরপাড়া', 'kadirparaup . magura . gov . bd', 1, 203, NULL, NULL, NULL, NULL),
(1852, 'Shobdalpur', 'সব্দালপুর', 'shobdalpurup . magura . gov . bd', 1, 203, NULL, NULL, NULL, NULL),
(1853, 'Sreepur', 'শ্রীপুর', 'sreepurup . magura . gov . bd', 1, 203, NULL, NULL, NULL, NULL),
(1854, 'Nakol', 'নাকোল', 'nakolup . magura . gov . bd', 1, 203, NULL, NULL, NULL, NULL),
(1855, 'Amalshar', 'আমলসার', 'amalsharup . magura . gov . bd', 1, 203, NULL, NULL, NULL, NULL),
(1856, 'Hazipur', 'হাজীপুর', 'hazipurup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1857, 'Atharokhada', 'আঠারখাদা', 'atharokhadaup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1858, 'Kosundi', 'কছুন্দী', 'kosundiup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1859, 'Bogia', 'বগিয়া', 'bogiaup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1860, 'Hazrapur', 'হাজরাপুর', 'hazrapurup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1861, 'Raghobdair', 'রাঘবদাইড়', 'raghobdairup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1862, 'Jagdal', 'জগদল', 'jagdalup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1863, 'Chawlia', 'চাউলিয়া', 'chawliaup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1864, 'Satrijitpur', 'শত্রুজিৎপুর', 'satrijitpurup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1865, 'Baroilpolita', 'বেরইল পলিতা', 'baroilpolitaup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1866, 'Kuchiamora', 'কুচিয়ামো', 'kuchiamoraup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1867, 'Gopalgram', 'গোপালগ্রাম', 'gopalgramup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1868, 'Moghi', 'মঘী', 'moghiup . magura . gov . bd', 1, 204, NULL, NULL, NULL, NULL),
(1869, 'Digha', 'দীঘা', 'dighaup . magura . gov . bd', 1, 205, NULL, NULL, NULL, NULL),
(1870, 'Nohata', 'নহাটা', 'nohataup . magura . gov . bd', 1, 205, NULL, NULL, NULL, NULL),
(1871, 'Palashbaria', 'পলাশবাড়ীয়া', 'palashbariaup . magura . gov . bd', 1, 205, NULL, NULL, NULL, NULL),
(1872, 'Babukhali', 'বাবুখালী', 'babukhaliup . magura . gov . bd', 1, 205, NULL, NULL, NULL, NULL),
(1873, 'Balidia', 'বালিদিয়া', 'balidiaup . magura . gov . bd', 1, 205, NULL, NULL, NULL, NULL),
(1874, 'Binodpur', 'বিনোদপুর', 'binodpurup . magura . gov . bd', 1, 205, NULL, NULL, NULL, NULL),
(1875, 'Mohammadpur', 'মহম্মদপুর', 'mohammadpurup . magura . gov . bd', 1, 205, NULL, NULL, NULL, NULL),
(1876, 'Rajapur', 'রাজাপুর', 'rajapurup . magura . gov . bd', 1, 205, NULL, NULL, NULL, NULL),
(1877, 'Horidhali', 'হরিঢালী', 'horidhaliup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1878, 'Goroikhali', 'গড়ইখালী', 'goroikhaliup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1879, 'Kopilmuni', 'কপিলমুনি', 'kopilmuniup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1880, 'Lota', 'লতা', 'lotaup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1881, 'Deluti', 'দেলুটি', 'delutiup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1882, 'Loskor', 'লস্কর', 'loskorup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1883, 'Godaipur', 'গদাইপুর', 'godaipurup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1884, 'Raruli', 'রাড়ুলী', 'www . raruliup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1885, 'Chandkhali', 'চাঁদখালী', 'chandkhaliup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1886, 'Soladana', 'সোলাদানা', 'soladanaup . khulna . gov . bd', 1, 206, NULL, NULL, NULL, NULL),
(1887, 'Fultola', 'ফুলতলা', 'www . fultolaup . khulna . gov . bd', 1, 207, NULL, NULL, NULL, NULL),
(1888, 'Damodar', 'দামোদর', 'www . damodarup . khulna . gov . bd', 1, 207, NULL, NULL, NULL, NULL),
(1889, 'Atra Gilatola', 'আটরা গিলাতলা', 'www . atragilatolaup . khulna . gov . bd', 1, 207, NULL, NULL, NULL, NULL),
(1890, 'Jamira', 'জামিরা', 'www . jamiraup . khulna . gov . bd', 1, 207, NULL, NULL, NULL, NULL),
(1891, 'Senhati', 'সেনহাটি', 'www . senhatiup . khulna . gov . bd', 1, 208, NULL, NULL, NULL, NULL),
(1892, 'Gajirhat', 'গাজীরহাট', 'www . gajirhatup . khulna . gov . bd', 1, 208, NULL, NULL, NULL, NULL),
(1893, 'Barakpur', 'বারাকপুর', 'www . barakpurup . khulna . gov . bd', 1, 208, NULL, NULL, NULL, NULL),
(1894, 'Aronghata', 'আড়ংঘাটা', 'www . aronghataup . khulna . gov . bd', 1, 208, NULL, NULL, NULL, NULL),
(1895, 'Jogipol', 'যোগীপোল', 'www . jogipolup . khulna . gov . bd', 1, 208, NULL, NULL, NULL, NULL),
(1896, 'Digholia', 'দিঘলিয়া', 'www . digholiaup . khulna . gov . bd', 1, 208, NULL, NULL, NULL, NULL),
(1897, 'Aichgati', 'আইচগাতী', 'aichgatiup . khulna . gov . bd', 1, 209, NULL, NULL, NULL, NULL),
(1898, 'Srifoltola', 'শ্রীফলতলা', 'srifoltolaup . khulna . gov . bd', 1, 209, NULL, NULL, NULL, NULL),
(1899, 'Noihati', 'নৈহাটি', 'noihatiup . khulna . gov . bd', 1, 209, NULL, NULL, NULL, NULL),
(1900, 'Tsb', 'টিএসবি', 'tsbup . khulna . gov . bd', 1, 209, NULL, NULL, NULL, NULL),
(1901, 'Ghatvog', 'ঘাটভোগ', 'ghatvogup . khulna . gov . bd', 1, 209, NULL, NULL, NULL, NULL),
(1902, 'Terokhada', 'তেরখাদা', 'terokhadaup . khulna . gov . bd', 1, 210, NULL, NULL, NULL, NULL),
(1903, 'Chagladoho', 'ছাগলাদহ', 'chagladohoup . khulna . gov . bd', 1, 210, NULL, NULL, NULL, NULL),
(1904, 'Barasat', 'বারাসাত', 'www . barasatup . khulna . gov . bd', 1, 210, NULL, NULL, NULL, NULL),
(1905, 'Sochiadaho', 'সাচিয়াদাহ', 'www . sochiadahoup . khulna . gov . bd', 1, 210, NULL, NULL, NULL, NULL),
(1906, 'Modhupur', 'মধুপুর', 'www . modhupurup . khulna . gov . bd', 1, 210, NULL, NULL, NULL, NULL),
(1907, 'Ajgora', 'আজগড়া', 'www . ajgoraup . khulna . gov . bd', 1, 210, NULL, NULL, NULL, NULL),
(1908, 'Dumuria', 'ডুমুরিয়া', 'dumuriaup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1909, 'Magurghona', 'মাগুরাঘোনা', 'magurghonaup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1910, 'Vandarpara', 'ভান্ডারপাড়া', 'vandarparaup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1911, 'Sahos', 'সাহস', 'sahosup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1912, 'Rudaghora', 'রুদাঘরা', 'rudaghoraup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1913, 'Ghutudia', 'গুটুদিয়া', 'ghutudiaup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1914, 'Shovna', 'শোভনা', 'shovnaup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1915, 'Khornia', 'খর্ণিয়া', 'khorniaup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1916, 'Atlia', 'আটলিয়া', 'atliaup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1917, 'Dhamalia', 'ধামালিয়া', 'dhamaliaup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1918, 'Raghunathpur', 'রঘুনাথপুর', 'raghunathpurup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1919, 'Rongpur', 'রংপুর', 'rongpurup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1920, 'Shorafpur', 'শরাফপুর', 'shorafpurup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1921, 'Magurkhali', 'মাগুরখালি', 'magurkhaliup . khulna . gov . bd', 1, 211, NULL, NULL, NULL, NULL),
(1922, 'Botiaghata', 'বটিয়াঘাটা', 'www . botiaghataup . khulna . gov . bd', 1, 212, NULL, NULL, NULL, NULL),
(1923, 'Amirpur', 'আমিরপুর', 'www . amirpurup . khulna . gov . bd', 1, 212, NULL, NULL, NULL, NULL),
(1924, 'Gongarampur', 'গঙ্গারামপুর', 'www . gongarampurup . khulna . gov . bd', 1, 212, NULL, NULL, NULL, NULL),
(1925, 'Surkhali', 'সুরখালী', 'www . surkhaliup . khulna . gov . bd', 1, 212, NULL, NULL, NULL, NULL),
(1926, 'Vandarkot', 'ভান্ডারকোট', 'www . vandarkotup . khulna . gov . bd', 1, 212, NULL, NULL, NULL, NULL),
(1927, 'Baliadanga', 'বালিয়াডাঙ্গা', 'www . baliadangaup . khulna . gov . bd', 1, 212, NULL, NULL, NULL, NULL),
(1928, 'Jolma', 'জলমা', 'www . jolmaup . khulna . gov . bd', 1, 212, NULL, NULL, NULL, NULL),
(1929, 'Dakop', 'দাকোপ', 'www . dakopup . khulna . gov . bd', 1, 213, NULL, NULL, NULL, NULL),
(1930, 'Bajua', 'বাজুয়া', 'bajuaup . khulna . gov . bd', 1, 213, NULL, NULL, NULL, NULL),
(1931, 'Kamarkhola', 'কামারখোলা', 'www . kamarkholaup . khulna . gov . bd', 1, 213, NULL, NULL, NULL, NULL),
(1932, 'Tildanga', 'তিলডাঙ্গা', 'www . tildangaup . khulna . gov . bd', 1, 213, NULL, NULL, NULL, NULL),
(1933, 'Sutarkhali', 'সুতারখালী', 'www . sutarkhaliup . khulna . gov . bd', 1, 213, NULL, NULL, NULL, NULL),
(1934, 'Laudoba', 'লাউডোব', 'laudobaup . khulna . gov . bd', 1, 213, NULL, NULL, NULL, NULL),
(1935, 'Pankhali', 'পানখালী', 'pankhaliup . khulna . gov . bd', 1, 213, NULL, NULL, NULL, NULL),
(1936, 'Banishanta', 'বানিশান্তা', 'banishantaup . khulna . gov . bd', 1, 213, NULL, NULL, NULL, NULL),
(1937, 'Koilashgonj', 'কৈলাশগঞ্জ', 'koilashgonjup . khulna . gov . bd', 1, 213, NULL, NULL, NULL, NULL),
(1938, 'Koyra', 'কয়রা', 'koyraup . khulna . gov . bd', 1, 214, NULL, NULL, NULL, NULL),
(1939, 'Moharajpur', 'মহারাজপুর', 'moharajpurup . khulna . gov . bd', 1, 214, NULL, NULL, NULL, NULL),
(1940, 'Moheswaripur', 'মহেশ্বরীপুর', 'moheswaripurup . khulna . gov . bd', 1, 214, NULL, NULL, NULL, NULL),
(1941, 'North Bedkashi', 'উত্তর বেদকাশী', 'northbedkashiup . khulna . gov . bd', 1, 214, NULL, NULL, NULL, NULL),
(1942, 'South Bedkashi', 'দক্ষিণ বেদকাশী', 'southbedkashiup . khulna . gov . bd', 1, 214, NULL, NULL, NULL, NULL),
(1943, 'Amadi', 'আমাদি', 'amadiup . khulna . gov . bd', 1, 214, NULL, NULL, NULL, NULL),
(1944, 'Bagali', 'বাগালী', 'bagaliup . khulna . gov . bd', 1, 214, NULL, NULL, NULL, NULL),
(1945, 'Betaga', 'বেতাগা', 'betagaup . bagerhat . gov . bd', 1, 215, NULL, NULL, NULL, NULL),
(1946, 'Lakhpur', 'লখপুর', 'lakhpurup . bagerhat . gov . bd', 1, 215, NULL, NULL, NULL, NULL),
(1947, 'Fakirhat', 'ফকিরহাট', 'fakirhatup . bagerhat . gov . bd', 1, 215, NULL, NULL, NULL, NULL),
(1948, 'Bahirdia - Mansa', 'বাহিরদিয়া - মানসা', 'bahirdiamansaup . bagerhat . gov . bd', 1, 215, NULL, NULL, NULL, NULL),
(1949, 'Piljanga', 'পিলজংগ', 'piljangaup . bagerhat . gov . bd', 1, 215, NULL, NULL, NULL, NULL),
(1950, 'Naldha - Mouvhog', 'নলধা - মৌভোগ', 'naldhamauvhogup . bagerhat . gov . bd', 1, 215, NULL, NULL, NULL, NULL),
(1951, 'Mulghar', 'মূলঘর', 'mulgharup . bagerhat . gov . bd', 1, 215, NULL, NULL, NULL, NULL),
(1952, 'Suvhadia', 'শুভদিয়া', 'suvhadiaup . bagerhat . gov . bd', 1, 215, NULL, NULL, NULL, NULL),
(1953, 'Karapara', 'কাড়াপাড়া', 'karaparaup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1954, 'Bamorta', 'বেমরতা', 'bamortaup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1955, 'Gotapara', 'গোটাপাড়া', 'gotaparaup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1956, 'Bishnapur', 'বিষ্ণুপুর', 'bishnapurup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1957, 'Baruipara', 'বারুইপাড়া', 'baruiparaup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1958, 'Jatharapur', 'যাত্রাপুর', 'jatharapurup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1959, 'Shaitgomboj', 'ষাটগুম্বজ', 'shaitgombojup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1960, 'Khanpur', 'খানপুর', 'khanpurup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1961, 'Rakhalgachi', 'রাখালগাছি', 'rakhalgachiup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1962, 'Dema', 'ডেমা', 'demaup . bagerhat . gov . bd', 1, 216, NULL, NULL, NULL, NULL),
(1963, 'Udoypur', 'উদয়পুর', 'udoypurup . bagerhat . gov . bd', 1, 217, NULL, NULL, NULL, NULL),
(1964, 'Chunkhola', 'চুনখোলা', 'chunkholaup . bagerhat . gov . bd', 1, 217, NULL, NULL, NULL, NULL),
(1965, 'Gangni', 'গাংনী', 'gangniup . bagerhat . gov . bd', 1, 217, NULL, NULL, NULL, NULL),
(1966, 'Kulia', 'কুলিয়া', 'kuliaup . bagerhat . gov . bd', 1, 217, NULL, NULL, NULL, NULL),
(1967, 'Gaola', 'গাওলা', 'gaolaup . bagerhat . gov . bd', 1, 217, NULL, NULL, NULL, NULL),
(1968, 'Kodalia', 'কোদালিয়া', 'kodaliaup . bagerhat . gov . bd', 1, 217, NULL, NULL, NULL, NULL),
(1969, 'Atjuri', 'আটজুড়ী', 'atjuriup . bagerhat . gov . bd', 1, 217, NULL, NULL, NULL, NULL),
(1970, 'Dhanshagor', 'ধানসাগর', 'dhanshagorup . bagerhat . gov . bd', 1, 218, NULL, NULL, NULL, NULL),
(1971, 'Khontakata', 'খোন্তাকাটা', 'khontakataup . bagerhat . gov . bd', 1, 218, NULL, NULL, NULL, NULL),
(1972, 'Rayenda', 'রায়েন্দা', 'rayendaup . bagerhat . gov . bd', 1, 218, NULL, NULL, NULL, NULL),
(1973, 'Southkhali', 'সাউথখালী', 'southkhaliup . bagerhat . gov . bd', 1, 218, NULL, NULL, NULL, NULL),
(1974, 'Gouramva', 'গৌরম্ভা', 'gouramvaup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1975, 'Uzzalkur', 'উজলকুড়', 'uzzalkurup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1976, 'Baintala', 'বাইনতলা', 'baintalaup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1977, 'Rampal', 'রামপাল', 'rampalup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1978, 'Rajnagar', 'রাজনগর', 'rajnagarup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1979, 'Hurka', 'হুড়কা', 'hurkaup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1980, 'Perikhali', 'পেড়িখালী', 'perikhaliup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1981, 'Vospatia', 'ভোজপাতিয়া', 'vospatiaup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1982, 'Mollikerbar', 'মল্লিকেরবেড়', 'mollikerbarup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1983, 'Bastoli', 'বাঁশতলী', 'bastoliup . bagerhat . gov . bd', 1, 219, NULL, NULL, NULL, NULL),
(1984, 'Teligati', 'তেলিগাতী', 'teligatiup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1985, 'Panchakaran', 'পঞ্চকরণ', 'panchakaranup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1986, 'Putikhali', 'পুটিখালী', 'putikhaliup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1987, 'Daibagnyahati', 'দৈবজ্ঞহাটি', 'daibagnyahatiup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1988, 'Ramchandrapur', 'রামচন্দ্রপুর', 'ramchandrapurup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1989, 'Chingrakhali', 'চিংড়াখালী', 'chingrakhaliup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1990, 'Jiudhara', 'জিউধরা', 'jiudharaup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1991, 'Hoglapasha', 'হোগলাপাশা', 'hoglapashaup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1992, 'Banagram', 'বনগ্রাম', 'banagramup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1993, 'Balaibunia', 'বলইবুনিয়া', 'balaibuniaup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1994, 'Hoglabunia', 'হোগলাবুনিয়া', 'hoglabuniaup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1995, 'Baharbunia', 'বহরবুনিয়া', 'baharbuniaup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1996, 'Morrelganj', 'মোড়েলগঞ্জ', 'morrelganjup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1997, 'Khaulia', 'খাউলিয়া', 'khauliaup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1998, 'Nishanbaria', 'নিশানবাড়িয়া', 'nishanbariaup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(1999, 'Baraikhali', 'বারইখালী', 'baraikhaliup . bagerhat . gov . bd', 1, 220, NULL, NULL, NULL, NULL),
(2000, 'Gojalia', 'গজালিয়া', 'gojaliaup . bagerhat . gov . bd', 1, 221, NULL, NULL, NULL, NULL),
(2001, 'Dhopakhali', 'ধোপাখালী', 'dhopakhaliup . bagerhat . gov . bd', 1, 221, NULL, NULL, NULL, NULL),
(2002, 'Moghia', 'মঘিয়া', 'moghiaup . bagerhat . gov . bd', 1, 221, NULL, NULL, NULL, NULL),
(2003, 'Kachua', 'কচুয়া', 'kachuaup . bagerhat . gov . bd', 1, 221, NULL, NULL, NULL, NULL),
(2004, 'Gopalpur', 'গোপালপুর', 'gopalpurup . bagerhat . gov . bd', 1, 221, NULL, NULL, NULL, NULL),
(2005, 'Raripara', 'রাড়ীপাড়া', 'rariparaup . bagerhat . gov . bd', 1, 221, NULL, NULL, NULL, NULL),
(2006, 'Badhal', 'বাধাল', 'badhalup . bagerhat . gov . bd', 1, 221, NULL, NULL, NULL, NULL),
(2007, 'Burrirdangga', 'বুড়িরডাঙ্গা', 'burrirdanggaup . bagerhat . gov . bd', 1, 222, NULL, NULL, NULL, NULL),
(2008, 'Mithakhali', 'মিঠাখালী', 'mithakhaliup . bagerhat . gov . bd', 1, 222, NULL, NULL, NULL, NULL),
(2009, 'Sonailtala', 'সোনাইলতলা', 'sonailtalaup . bagerhat . gov . bd', 1, 222, NULL, NULL, NULL, NULL),
(2010, 'Chadpai', 'চাঁদপাই', 'chadpaiup . bagerhat . gov . bd', 1, 222, NULL, NULL, NULL, NULL),
(2011, 'Chila', 'চিলা', 'chilaup . bagerhat . gov . bd', 1, 222, NULL, NULL, NULL, NULL),
(2012, 'Sundarban', 'সুন্দরবন', 'sundarbanup . bagerhat . gov . bd', 1, 222, NULL, NULL, NULL, NULL),
(2013, 'Barobaria', 'বড়বাড়িয়া', 'barobariaup . bagerhat . gov . bd', 1, 223, NULL, NULL, NULL, NULL),
(2014, 'Kalatala', 'কলাতলা', 'kalatalaup . bagerhat . gov . bd', 1, 223, NULL, NULL, NULL, NULL);
INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(2015, 'Hizla', 'হিজলা', 'hizlaup . bagerhat . gov . bd', 1, 223, NULL, NULL, NULL, NULL),
(2016, 'Shibpur', 'শিবপুর', 'shibpurup . bagerhat . gov . bd', 1, 223, NULL, NULL, NULL, NULL),
(2017, 'Chitalmari', 'চিতলমারী', 'chitalmariup . bagerhat . gov . bd', 1, 223, NULL, NULL, NULL, NULL),
(2018, 'Charbaniri', 'চরবানিয়ারী', 'charbaniriup . bagerhat . gov . bd', 1, 223, NULL, NULL, NULL, NULL),
(2019, 'Shantoshpur', 'সন্তোষপুর', 'shantoshpurup . bagerhat . gov . bd', 1, 223, NULL, NULL, NULL, NULL),
(2020, 'Sadhuhati', 'সাধুহাটী', 'sadhuhatiup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2021, 'Modhuhati', 'মধুহাটী', 'modhuhatiup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2022, 'Saganna', 'সাগান্না', 'sagannaup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2023, 'Halidhani', 'হলিধানী', 'halidhaniup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2024, 'Kumrabaria', 'কুমড়াবাড়ীয়া', 'kumrabariaup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2025, 'Ganna', 'গান্না', 'gannaup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2026, 'Maharazpur', 'মহারাজপুর', 'maharazpurup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2027, 'Paglakanai', 'পাগলাকানাই', 'paglakanaiup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2028, 'Porahati', 'পোড়াহাটী', 'porahatiup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2029, 'Harishongkorpur', 'হরিশংকরপুর', 'harishongkorpurup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2030, 'Padmakar', 'পদ্মাকর', 'padmakarup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2031, 'Dogachhi', 'দোগাছি', 'dogachhiup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2032, 'Furshondi', 'ফুরসন্দি', 'furshondiup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2033, 'Ghorshal', 'ঘোড়শাল', 'ghorshalup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2034, 'Kalicharanpur', 'কালীচরণপুর', 'kalicharanpurup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2035, 'Surat', 'সুরাট', 'suratup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2036, 'Naldanga', 'নলডাঙ্গা', 'naldangaup . jhenaidah . gov . bd', 1, 224, NULL, NULL, NULL, NULL),
(2037, 'Tribeni', 'ত্রিবেনী', 'tribeniup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2038, 'Mirzapur', 'মির্জাপুর', 'mirzapurup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2039, 'Dignagore', 'দিগনগর', 'dignagoreup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2040, 'Kancherkol', 'কাঁচেরকোল', 'kancherkolup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2041, 'Sarutia', 'সারুটিয়া', 'sarutiaup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2042, 'Hakimpur', 'হাকিমপুর', 'hakimpurup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2043, 'Dhaloharachandra', 'ধলহরাচন্দ্র', 'dhaloharachandraup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2044, 'Manoharpur', 'মনোহরপুর', 'manoharpurup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2045, 'Bogura', 'বগুড়া', 'boguraup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2046, 'Abaipur', 'আবাইপুর', 'abaipurup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2047, 'Nityanandapur', 'নিত্যানন্দপুর', 'nityanandapurup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2048, 'Umedpur', 'উমেদপুর', 'umedpurup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2049, 'Dudshar', 'দুধসর', 'dudsharup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2050, 'Fulhari', 'ফুলহরি', 'fulhariup . jhenaidah . gov . bd', 1, 225, NULL, NULL, NULL, NULL),
(2051, 'Bhayna', 'ভায়না', 'bhaynaup . jhenaidah . gov . bd', 1, 226, NULL, NULL, NULL, NULL),
(2052, 'Joradah', 'জোড়াদহ', 'joradahup . jhenaidah . gov . bd', 1, 226, NULL, NULL, NULL, NULL),
(2053, 'Taherhuda', 'তাহেরহুদা', 'taherhudaup . jhenaidah . gov . bd', 1, 226, NULL, NULL, NULL, NULL),
(2054, 'Daulatpur', 'দৌলতপুর', 'daulatpurup . jhenaidah . gov . bd', 1, 226, NULL, NULL, NULL, NULL),
(2055, 'Kapashatia', 'কাপাশহাটিয়া', 'kapashatiaup . jhenaidah . gov . bd', 1, 226, NULL, NULL, NULL, NULL),
(2056, 'Falsi', 'ফলসী', 'falsiup . jhenaidah . gov . bd', 1, 226, NULL, NULL, NULL, NULL),
(2057, 'Raghunathpur', 'রঘুনাথপুর', 'raghunathpurup . jhenaidah . gov . bd', 1, 226, NULL, NULL, NULL, NULL),
(2058, 'Chandpur', 'চাঁদপুর', 'chandpurup . jhenaidah . gov . bd', 1, 226, NULL, NULL, NULL, NULL),
(2059, 'Sundarpurdurgapur', 'সুন্দরপুর - দূর্গাপুর', 'sundarpurdurgapurup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2060, 'Jamal', 'জামাল', 'jamalup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2061, 'Kola', 'কোলা', 'kolaup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2062, 'Niamatpur', 'নিয়ামতপুর', 'niamatpurup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2063, 'Simla - Rokonpur', 'শিমলা - রোকনপুর', 'simlarokonpurup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2064, 'Trilochanpur', 'ত্রিলোচনপুর', 'trilochanpurup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2065, 'Raygram', 'রায়গ্রাম', 'raygramup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2066, 'Maliat', 'মালিয়াট', 'maliatup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2067, 'Barabazar', 'বারবাজার', 'barabazarup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2068, 'Kashtabhanga', 'কাষ্টভাঙ্গা', 'kashtabhangaup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2069, 'Rakhalgachhi', 'রাখালগাছি', 'rakhalgachhiup . jhenaidah . gov . bd', 1, 227, NULL, NULL, NULL, NULL),
(2070, 'Sabdalpur', 'সাবদালপুর', 'sabdalpurup . jhenaidah . gov . bd', 1, 228, NULL, NULL, NULL, NULL),
(2071, 'Dora', 'দোড়া', 'doraup . jhenaidah . gov . bd', 1, 228, NULL, NULL, NULL, NULL),
(2072, 'Kushna', 'কুশনা', 'kushnaup . jhenaidah . gov . bd', 1, 228, NULL, NULL, NULL, NULL),
(2073, 'Baluhar', 'বলুহর', 'baluharup . jhenaidah . gov . bd', 1, 228, NULL, NULL, NULL, NULL),
(2074, 'Elangi', 'এলাঙ্গী', 'elangiup . jhenaidah . gov . bd', 1, 228, NULL, NULL, NULL, NULL),
(2075, 'Sbk', 'এস, বি, কে', 'sbkup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2076, 'Fatepur', 'ফতেপুর', 'fatepurup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2077, 'Panthapara', 'পান্থপাড়া', 'panthaparaup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2078, 'Swaruppur', 'স্বরুপপুর', 'swaruppurup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2079, 'Shyamkur', 'শ্যামকুড়', 'shyamkurup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2080, 'Nepa', 'নেপা', 'nepaup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2081, 'Kazirber', 'কাজীরবেড়', 'kazirberup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2082, 'Banshbaria', 'বাঁশবাড়ীয়া', 'banshbariaup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2083, 'Jadabpur', 'যাদবপুর', 'jadabpurup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2084, 'Natima', 'নাটিমা', 'natimaup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2085, 'Manderbaria', 'মান্দারবাড়ীয়া', 'manderbariaup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2086, 'Azampur', 'আজমপুর', 'azampurup . jhenaidah . gov . bd', 1, 229, NULL, NULL, NULL, NULL),
(2087, 'Basanda', 'বাসন্ডা', 'basandaup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2088, 'Binoykati', 'বিনয়কাঠী', 'binoykatiup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2089, 'Gabharamchandrapur', 'গাভারামচন্দ্রপুর', 'gabharamchandrapurup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2090, 'Keora', 'কেওড়া', 'keoraup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2091, 'Kirtipasha', 'কীর্তিপাশা', 'kirtipashaup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2092, 'Nabagram', 'নবগ্রাম', 'nabagramup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2093, 'Nathullabad', 'নথুলল্লাবাদ', 'nathullabadup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2094, 'Ponabalia', 'পোনাবালিয়া', 'ponabaliaup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2095, 'Sekherhat', 'শেখেরহাট', 'sekherhatup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2096, 'Gabkhandhansiri', 'গাবখান ধানসিঁড়ি', 'gabkhandhansiriup . jhalakathi . gov . bd', 1, 230, NULL, NULL, NULL, NULL),
(2097, 'Amua', 'আমুয়া', 'amuaup . jhalakathi . gov . bd', 1, 231, NULL, NULL, NULL, NULL),
(2098, 'Awrabunia', 'আওরাবুনিয়া', 'awrabuniaup . jhalakathi . gov . bd', 1, 231, NULL, NULL, NULL, NULL),
(2099, 'Chenchrirampur', 'চেঁচরীরামপুর', 'chenchrirampurup . jhalakathi . gov . bd', 1, 231, NULL, NULL, NULL, NULL),
(2100, 'Kanthalia', 'কাঠালিয়া', 'kanthaliaup . jhalakathi . gov . bd', 1, 231, NULL, NULL, NULL, NULL),
(2101, 'Patikhalghata', 'পাটিখালঘাটা', 'patikhalghataup . jhalakathi . gov . bd', 1, 231, NULL, NULL, NULL, NULL),
(2102, 'Shaulajalia', 'শৌলজালিয়া', 'shaulajaliaup . jhalakathi . gov . bd', 1, 231, NULL, NULL, NULL, NULL),
(2103, 'Subidpur', 'সুবিদপুর', 'subidpurup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2104, 'Siddhakati', 'সিদ্ধকাঠী', 'siddhakatiup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2105, 'Ranapasha', 'রানাপাশা', 'ranapashaup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2106, 'Nachanmohal', 'নাচনমহল', 'nachanmohalup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2107, 'Mollahat', 'মোল্লারহাট', 'mollahatup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2108, 'Magar', 'মগর', 'magarup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2109, 'Kusanghal', 'কুশঙ্গল', 'kusanghalup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2110, 'Kulkathi', 'কুলকাঠী', 'kulkathiup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2111, 'Dapdapia', 'দপদপিয়া', 'dapdapiaup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2112, 'Bharabpasha', 'ভৈরবপাশা', 'bharabpashaup . jhalakathi . gov . bd', 1, 232, NULL, NULL, NULL, NULL),
(2113, 'Suktagarh', 'শুক্তাগড়', 'suktagarhup . jhalakathi . gov . bd', 1, 233, NULL, NULL, NULL, NULL),
(2114, 'Saturia', 'সাতুরিয়া', 'saturiaup . jhalakathi . gov . bd', 1, 233, NULL, NULL, NULL, NULL),
(2115, 'Mathbari', 'মঠবাড়ী', 'mathbariup . jhalakathi . gov . bd', 1, 233, NULL, NULL, NULL, NULL),
(2116, 'Galua', 'গালুয়া', 'galuaup . jhalakathi . gov . bd', 1, 233, NULL, NULL, NULL, NULL),
(2117, 'Baraia', 'বড়ইয়া', 'baraiaup . jhalakathi . gov . bd', 1, 233, NULL, NULL, NULL, NULL),
(2118, 'Rajapur', 'রাজাপুর', 'rajapurup . jhalakathi . gov . bd', 1, 233, NULL, NULL, NULL, NULL),
(2119, 'Adabaria', 'আদাবারিয়া', 'adabariaup . gazipur . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2120, 'Bauphal', 'বাউফল', 'bauphalup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2121, 'Daspara', 'দাস পাড়া', 'dasparaup . gazipur . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2122, 'Kalaiya', 'কালাইয়া', 'kalaiyaup . gazipur . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2123, 'Nawmala', 'নওমালা', 'nawmalaup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2124, 'Najirpur', 'নাজিরপুর', 'najirpurup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2125, 'Madanpura', 'মদনপুরা', 'madanpuraup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2126, 'Boga', 'বগা', 'bogaup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2127, 'Kanakdia', 'কনকদিয়া', 'kanakdiaup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2128, 'Shurjamoni', 'সূর্য্যমনি', 'shurjamoniup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2129, 'Keshabpur', 'কেশবপুর', 'keshabpurup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2130, 'Dhulia', 'ধুলিয়া', 'dhuliaup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2131, 'Kalisuri', 'কালিশুরী', 'kalisuriup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2132, 'Kachipara', 'কাছিপাড়া', 'kachiparaup . patuakhali . gov . bd', 1, 234, NULL, NULL, NULL, NULL),
(2133, 'Laukathi', 'লাউকাঠী', 'laukathiup . patuakhali . gov . bd', 1, 235, NULL, NULL, NULL, NULL),
(2134, 'Lohalia', 'লোহালিয়া', 'lohaliaup . patuakhali . gov . bd', 1, 235, NULL, NULL, NULL, NULL),
(2135, 'Kamalapur', 'কমলাপুর', 'kamalapurup . patuakhali . gov . bd', 1, 235, NULL, NULL, NULL, NULL),
(2136, 'Jainkathi', 'জৈনকাঠী', 'jainkathiup . patuakhali . gov . bd', 1, 235, NULL, NULL, NULL, NULL),
(2137, 'Kalikapur', 'কালিকাপুর', 'kalikapurup . patuakhali . gov . bd', 1, 235, NULL, NULL, NULL, NULL),
(2138, 'Badarpur', 'বদরপুর', 'badarpurup . patuakhali . gov . bd ', 1, 235, NULL, NULL, NULL, NULL),
(2139, 'Itbaria', 'ইটবাড়ীয়া', 'itbariaup . patuakhali . gov . bd ', 1, 235, NULL, NULL, NULL, NULL),
(2140, 'Marichbunia', 'মরিচবুনিয়া', 'marichbuniaup . patuakhali . gov . bd ', 1, 235, NULL, NULL, NULL, NULL),
(2141, 'Auliapur', 'আউলিয়াপুর', 'auliapurup . patuakhali . gov . bd', 1, 235, NULL, NULL, NULL, NULL),
(2142, 'Chotobighai', 'ছোট বিঘাই', 'chotobighaiup . patuakhali . gov . bd', 1, 235, NULL, NULL, NULL, NULL),
(2143, 'Borobighai', 'বড় বিঘাই', 'borobighaiup . patuakhali . gov . bd', 1, 235, NULL, NULL, NULL, NULL),
(2144, 'Madarbunia', 'মাদারবুনিয়া', 'madarbuniaup . patuakhali . gov . bd', 1, 235, NULL, NULL, NULL, NULL),
(2145, 'Pangasia', 'পাংগাশিয়া', 'pangasiaup . patuakhali . gov . bd', 1, 236, NULL, NULL, NULL, NULL),
(2146, 'Muradia', 'মুরাদিয়া', 'muradiaup . patuakhali . gov . bd', 1, 236, NULL, NULL, NULL, NULL),
(2147, 'Labukhali', 'লেবুখালী', 'labukhaliup . patuakhali . gov . bd', 1, 236, NULL, NULL, NULL, NULL),
(2148, 'Angaria', 'আংগারিয়া', 'angariaup . patuakhali . gov . bd', 1, 236, NULL, NULL, NULL, NULL),
(2149, 'Sreerampur', 'শ্রীরামপুর', 'sreerampurup . patuakhali . gov . bd', 1, 236, NULL, NULL, NULL, NULL),
(2150, 'Bashbaria', 'বাঁশবাড়ীয়া', 'bashbariaup . patuakhali . gov . bd', 1, 237, NULL, NULL, NULL, NULL),
(2151, 'Rangopaldi', 'রণগোপালদী', 'rangopaldiup . patuakhali . gov . bd', 1, 237, NULL, NULL, NULL, NULL),
(2152, 'Alipur', 'আলীপুর', 'alipurup . patuakhali . gov . bd', 1, 237, NULL, NULL, NULL, NULL),
(2153, 'Betagi Shankipur', 'বেতাগী সানকিপুর', 'betagishankipurup . patuakhali . gov . bd', 1, 237, NULL, NULL, NULL, NULL),
(2154, 'Dashmina', 'দশমিনা', 'dashminaup . patuakhali . gov . bd', 1, 237, NULL, NULL, NULL, NULL),
(2155, 'Baharampur', 'বহরমপুর', 'baharampurup . patuakhali . gov . bd', 1, 237, NULL, NULL, NULL, NULL),
(2156, 'Chakamaia', 'চাকামইয়া', 'chakamaiaup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2157, 'Tiakhali', 'টিয়াখালী', 'tiakhaliup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2158, 'Lalua', 'লালুয়া', 'laluaup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2159, 'Dhankhali', 'ধানখালী', 'dhankhaliup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2160, 'Mithagonj', 'মিঠাগঞ্জ', 'mithagonjup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2161, 'Nilgonj', 'নীলগঞ্জ', 'nilgonjup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2162, 'Dulaser', 'ধুলাসার', 'dulaserup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2163, 'Latachapli', 'লতাচাপলী', 'latachapliup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2164, 'Mahipur', 'মহিপুর', 'mahipurup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2165, 'Dalbugonj', 'ডালবুগঞ্জ', 'dalbugonjup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2166, 'Baliatali', 'বালিয়াতলী', 'baliataliup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2167, 'Champapur', 'চম্পাপুর', 'champapurup . patuakhali . gov . bd', 1, 238, NULL, NULL, NULL, NULL),
(2168, 'Madhabkhali', 'মাধবখালী', 'madhabkhaliup . patuakhali . gov . bd', 1, 239, NULL, NULL, NULL, NULL),
(2169, 'Mirzaganj', 'মির্জাগঞ্জ', 'mirzaganjup . patuakhali . gov . bd', 1, 239, NULL, NULL, NULL, NULL),
(2170, 'Amragachia', 'আমড়াগাছিয়া', 'amragachiaup . patuakhali . gov . bd', 1, 239, NULL, NULL, NULL, NULL),
(2171, 'Deuli Subidkhali', 'দেউলী সুবিদখালী', 'deulisubidkhaliup . patuakhali . gov . bd', 1, 239, NULL, NULL, NULL, NULL),
(2172, 'Kakrabunia', 'কাকড়াবুনিয়া', 'kakrabuniaup . patuakhali . gov . bd', 1, 239, NULL, NULL, NULL, NULL),
(2173, 'Majidbaria', 'মজিদবাড়িয়া', 'majidbariaup . patuakhali . gov . bd', 1, 239, NULL, NULL, NULL, NULL),
(2174, 'Amkhola', 'আমখোলা', 'amkholaup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2175, 'Golkhali', 'গোলখালী', 'golkhaliup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2176, 'Galachipa', 'গলাচিপা', 'galachipaup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2177, 'Panpatty', 'পানপট্টি', 'panpattyup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2178, 'Ratandi Taltali', 'রতনদী তালতলী', 'ratanditaltaliup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2179, 'Dakua', 'ডাকুয়া', 'dakuaup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2180, 'Chiknikandi', 'চিকনিকান্দী', 'chiknikandiup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2181, 'Gazalia', 'গজালিয়া', 'gazaliaup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2182, 'Charkajol', 'চরকাজল', 'charkajolup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2183, 'Charbiswas', 'চরবিশ্বাস', 'charbiswasup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2184, 'Bakulbaria', 'বকুলবাড়ীয়া', 'bakulbariaup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2185, 'Kalagachhia', 'কলাগাছিয়া', 'kalagachhiaup . patuakhali . gov . bd', 1, 240, NULL, NULL, NULL, NULL),
(2186, 'Rangabali', 'রাঙ্গাবালী', 'rangabaliup . patuakhali . gov . bd', 1, 241, NULL, NULL, NULL, NULL),
(2187, 'Barobaisdia', 'বড়বাইশদিয়া', 'barobaisdiaup . patuakhali . gov . bd', 1, 241, NULL, NULL, NULL, NULL),
(2188, 'Chattobaisdia', 'ছোটবাইশদিয়া', 'chattobaisdiaup . patuakhali . gov . bd', 1, 241, NULL, NULL, NULL, NULL),
(2189, 'Charmontaz', 'চরমোন্তাজ', 'charmontaz . patuakhali . gov . bd', 1, 241, NULL, NULL, NULL, NULL),
(2190, 'Chalitabunia', 'চালিতাবুনিয়া', 'chalitabuniaup . patuakhali . gov . bd', 1, 241, NULL, NULL, NULL, NULL),
(2191, 'Shikder Mallik', 'শিকদার মল্লিক', 'shikdermallikup . pirojpur . gov . bd', 1, 242, NULL, NULL, NULL, NULL),
(2192, 'Kodomtala', 'কদমতলা', 'kodomtalaup . pirojpur . gov . bd', 1, 242, NULL, NULL, NULL, NULL),
(2193, 'Durgapur', 'দূর্গাপুর', 'durgapurup . pirojpur . gov . bd', 1, 242, NULL, NULL, NULL, NULL),
(2194, 'Kolakhali', 'কলাখালী', 'kolakhaliup . pirojpur . gov . bd', 1, 242, NULL, NULL, NULL, NULL),
(2195, 'Tona', 'টোনা', 'tonaup . pirojpur . gov . bd', 1, 242, NULL, NULL, NULL, NULL),
(2196, 'Shariktola', 'শরিকতলা', 'shariktolaup . pirojpur . gov . bd', 1, 242, NULL, NULL, NULL, NULL),
(2197, 'Shankorpasa', 'শংকরপাশা', 'shankorpasaup . pirojpur . gov . bd', 1, 242, NULL, NULL, NULL, NULL),
(2198, 'Mativangga', 'মাটিভাংগা', 'mativanggaup . pirojpur . gov . bd', 1, 243, NULL, NULL, NULL, NULL),
(2199, 'Malikhali', 'মালিখালী', 'malikhaliup . pirojpur . gov . bd', 1, 243, NULL, NULL, NULL, NULL),
(2200, 'Daulbari Dobra', 'দেউলবাড়ী দোবড়া', 'daulbaridobraup . pirojpur . gov . bd', 1, 243, NULL, NULL, NULL, NULL),
(2201, 'Dirgha', 'দীর্ঘা', 'dirghaup . pirojpur . gov . bd', 1, 243, NULL, NULL, NULL, NULL),
(2202, 'Kolardoania', 'কলারদোয়ানিয়া', 'kolardoaniaup . pirojpur . gov . bd', 1, 243, NULL, NULL, NULL, NULL),
(2203, 'Sriramkathi', 'শ্রীরামকাঠী', 'sriramkathiup . pirojpur . gov . bd', 1, 243, NULL, NULL, NULL, NULL),
(2204, 'Shakhmatia', 'সেখমাটিয়া', 'shakhmatiaup . pirojpur . gov . bd', 1, 243, NULL, NULL, NULL, NULL),
(2205, 'Nazirpur Sadar', 'নাজিরপুর সদর', 'nazirpursadarup . pirojpur . gov . bd', 1, 243, NULL, NULL, NULL, NULL),
(2206, 'Shakharikathi', 'শাখারীকাঠী', 'shakharikathiup . pirojpur . gov . bd', 1, 243, NULL, NULL, NULL, NULL),
(2207, 'Sayna Rogunathpur', 'সয়না রঘুনাথপুর', 'saynarogunathpurup . pirojpur . gov . bd', 1, 244, NULL, NULL, NULL, NULL),
(2208, 'Amrazuri', 'আমড়াজুড়ি', 'amrazuriup . pirojpur . gov . bd', 1, 244, NULL, NULL, NULL, NULL),
(2209, 'Kawkhali Sadar', 'কাউখালি সদর', 'kawkhalisadarup . pirojpur . gov . bd', 1, 244, NULL, NULL, NULL, NULL),
(2210, 'Chirapara', 'চিরাপাড়া', 'chiraparaup . pirojpur . gov . bd', 1, 244, NULL, NULL, NULL, NULL),
(2211, 'Shialkhathi', 'শিয়ালকাঠী', 'shialkhathiup . pirojpur . gov . bd', 1, 244, NULL, NULL, NULL, NULL),
(2212, 'Balipara', 'বালিপাড়া', 'baliparaup . pirojpur . gov . bd', 1, 245, NULL, NULL, NULL, NULL),
(2213, 'Pattashi', 'পত্তাশি', 'pattashiup . pirojpur . gov . bd', 1, 245, NULL, NULL, NULL, NULL),
(2214, 'Parerhat', 'পাড়েরহাট', 'parerhatup . pirojpur . gov . bd', 1, 245, NULL, NULL, NULL, NULL),
(2215, 'Vitabaria', 'ভিটাবাড়িয়া', 'vitabariaup . pirojpur . gov . bd', 1, 246, NULL, NULL, NULL, NULL),
(2216, 'Nodmulla', 'নদমূলা শিয়ালকাঠী', 'nodmullaup . pirojpur . gov . bd', 1, 246, NULL, NULL, NULL, NULL),
(2217, 'Telikhali', 'তেলিখালী', 'telikhaliup . pirojpur . gov . bd', 1, 246, NULL, NULL, NULL, NULL),
(2218, 'Ekree', 'ইকড়ী', 'ekreeup . pirojpur . gov . bd', 1, 246, NULL, NULL, NULL, NULL),
(2219, 'Dhaoa', 'ধাওয়া', 'dhaoaup . pirojpur . gov . bd', 1, 246, NULL, NULL, NULL, NULL),
(2220, 'Vandaria Sadar', 'ভান্ডারিয়া সদর', 'vandariasadarup . pirojpur . gov . bd', 1, 246, NULL, NULL, NULL, NULL),
(2221, 'Gouripur', 'গৌরীপুর', 'gouripurup . pirojpur . gov . bd', 1, 246, NULL, NULL, NULL, NULL),
(2222, 'Tuskhali', 'তুষখালী', 'tuskhaliup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2223, 'Dhanisafa', 'ধানীসাফা', 'dhanisafaup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2224, 'Mirukhali', 'মিরুখালী', 'mirukhaliup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2225, 'Tikikata', 'টিকিকাটা', 'tikikataup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2226, 'Betmor Rajpara', 'বেতমোর রাজপাড়া', 'betmorrajparaup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2227, 'Amragachia', 'আমড়াগাছিয়া', 'amragachiaup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2228, 'Shapleza', 'শাপলেজা', 'shaplezaup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2229, 'Daudkhali', 'দাউদখালী', 'daudkhaliup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2230, 'Mathbaria', 'মঠবাড়িয়া', 'mathbariaup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2231, 'Baramasua', 'বড়মাছুয়া', 'baramasuaup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2232, 'Haltagulishakhali', 'হলতাগুলিশাখালী', 'haltagulishakhaliup . pirojpur . gov . bd', 1, 247, NULL, NULL, NULL, NULL),
(2233, 'Boldia', 'বলদিয়া', 'boldiaup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2234, 'Sohagdal', 'সোহাগদল', 'sohagdalup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2235, 'Atghorkuriana', 'আটঘর কুড়িয়ানা', 'atghorkurianaup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2236, 'Jolabari', 'জলাবাড়ী', 'jolabariup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2237, 'Doyhary', 'দৈহারী', 'doyharyup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2238, 'Guarekha', 'গুয়ারেখা', 'guarekhaup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2239, 'Somudoykathi', 'সমুদয়কাঠী', 'somudoykathiup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2240, 'Sutiakathi', 'সুটিয়াকাঠী', 'sutiakathiup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2241, 'Sarengkathi', 'সারেংকাঠী', 'sarengkathiup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2242, 'Shorupkathi', 'স্বরুপকাঠী', 'shorupkathiup . pirojpur . gov . bd', 1, 248, NULL, NULL, NULL, NULL),
(2243, 'Raipasha Karapur', 'রায়পাশা কড়াপুর', 'raipashakarapurup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2244, 'Kashipur', 'কাশীপুর', 'kashipurup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2245, 'Charbaria', 'চরবাড়িয়া', 'charbariaup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2246, 'Shyastabad', 'সায়েস্তাবাদ', 'shyastabadup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2247, 'Charmonai', 'চরমোনাই', 'charmonaiup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2248, 'Zagua', 'জাগুয়া', 'zaguaup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2249, 'Charcowa', 'চরকাউয়া', 'charcowaup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2250, 'Chandpura', 'চাঁদপুরা', 'chandpuraup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2251, 'Tungibaria', 'টুঙ্গীবাড়িয়া', 'tungibariaup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2252, 'Chandramohan', 'চন্দ্রমোহন', 'chandramohanup . barisal . gov . bd', 1, 249, NULL, NULL, NULL, NULL),
(2253, 'Charamaddi', 'চরামদ্দি', 'charamaddiup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2254, 'Charade', 'চরাদি', 'charadeup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2255, 'Darial', 'দাড়িয়াল', 'darialup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2256, 'Dudhal', 'দুধল', 'dudhalup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2257, 'Durgapasha', 'দুর্গাপাশা', 'durgapashaup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2258, 'Faridpur', 'ফরিদপুর', 'faridpurup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2259, 'Kabai', 'কবাই', 'kabaiup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2260, 'Nalua', 'নলুয়া', 'naluaup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2261, 'Kalashkathi', 'কলসকাঠী', 'kalashkathiup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2262, 'Garuria', 'গারুরিয়া', 'garuriaup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2263, 'Bharpasha', 'ভরপাশা', 'bharpashaup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2264, 'Rangasree', 'রঙ্গশ্রী', 'rangasreeup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2265, 'Padreeshibpur', 'পাদ্রিশিবপুর', 'padreeshibpurup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2266, 'Niamoti', 'নিয়ামতি', 'niamotiup . barisal . gov . bd', 1, 250, NULL, NULL, NULL, NULL),
(2267, 'Jahangir Nagar', 'জাহাঙ্গীর নগর', 'jahangirnagorup . barisal . gov . bd', 1, 251, NULL, NULL, NULL, NULL),
(2268, 'Kaderpur', 'কেদারপুর', 'kaderpurup . barisal . gov . bd', 1, 251, NULL, NULL, NULL, NULL),
(2269, 'Deherhoti', 'দেহেরগতি', 'deherhotiup . barisal . gov . bd', 1, 251, NULL, NULL, NULL, NULL),
(2270, 'Chandpasha', 'চাঁদপাশা', 'chandpashaup . barisal . gov . bd', 1, 251, NULL, NULL, NULL, NULL),
(2271, 'Rahamtpur', 'রহমতপুর', 'rahamtpurup . barisal . gov . bd', 1, 251, NULL, NULL, NULL, NULL),
(2272, 'Madhbpasha', 'মাধবপাশা', 'madhbpashaup . barisal . gov . bd', 1, 251, NULL, NULL, NULL, NULL),
(2273, 'Shatla', 'সাতলা', 'shatlaup . barisal . gov . bd', 1, 252, NULL, NULL, NULL, NULL),
(2274, 'Harta', 'হারতা', 'hartaup . barisal . gov . bd', 1, 252, NULL, NULL, NULL, NULL),
(2275, 'Jalla', 'জল্লা', 'jallaup . barisal . gov . bd', 1, 252, NULL, NULL, NULL, NULL),
(2276, 'Otra', 'ওটরা', 'otraup . barisal . gov . bd', 1, 252, NULL, NULL, NULL, NULL),
(2277, 'Sholok', 'শোলক', 'sholokup . barisal . gov . bd', 1, 252, NULL, NULL, NULL, NULL),
(2278, 'Barakhota', 'বরাকোঠা', 'barakhotaup . barisal . gov . bd', 1, 252, NULL, NULL, NULL, NULL),
(2279, 'Bamrail', 'বামরাইল', 'bamrailup . barisal . gov . bd', 1, 252, NULL, NULL, NULL, NULL),
(2280, 'Shikerpur Wazirpur', 'শিকারপুর উজিরপুর', 'shikerpurwazirpurup . barisal . gov . bd', 1, 252, NULL, NULL, NULL, NULL),
(2281, 'Gouthia', 'গুঠিয়া', 'gouthiaup . barisal . gov . bd', 1, 252, NULL, NULL, NULL, NULL),
(2282, 'Bisharkandi', 'বিশারকান্দি', 'bisharkandiup . barisal . gov . bd', 1, 253, NULL, NULL, NULL, NULL),
(2283, 'Illuhar', 'ইলুহার', 'illuharup . barisal . gov . bd', 1, 253, NULL, NULL, NULL, NULL),
(2284, 'Sayedkathi', 'সৈয়দকাঠী', 'sayedkathiup . barisal . gov . bd', 1, 253, NULL, NULL, NULL, NULL),
(2285, 'Chakhar', 'চাখার', 'chakharup . barisal . gov . bd', 1, 253, NULL, NULL, NULL, NULL),
(2286, 'Saliabakpur', 'সলিয়াবাকপুর', 'saliabakpurup . barisal . gov . bd', 1, 253, NULL, NULL, NULL, NULL),
(2287, 'Baishari', 'বাইশারী', 'baishariup . barisal . gov . bd', 1, 253, NULL, NULL, NULL, NULL),
(2288, 'Banaripara', 'বানারিপাড়া', 'banariparaup . barisal . gov . bd', 1, 253, NULL, NULL, NULL, NULL),
(2289, 'Udykhati', 'উদয়কাঠী', 'udykhatiup . barisal . gov . bd', 1, 253, NULL, NULL, NULL, NULL),
(2290, 'Khanjapur', 'খাঞ্জাপুর', 'khanjapurup . barisal . gov . bd', 1, 254, NULL, NULL, NULL, NULL),
(2291, 'Barthi', 'বার্থী', 'barthiup . barisal . gov . bd', 1, 254, NULL, NULL, NULL, NULL),
(2292, 'Chandshi', 'চাঁদশী', 'chandshiup . barisal . gov . bd', 1, 254, NULL, NULL, NULL, NULL),
(2293, 'Mahilara', 'মাহিলারা', 'mahilaraup . barisal . gov . bd', 1, 254, NULL, NULL, NULL, NULL),
(2294, 'Nalchira', 'নলচিড়া', 'nalchiraup . barisal . gov . bd', 1, 254, NULL, NULL, NULL, NULL),
(2295, 'Batajore', 'বাটাজোর', 'batajoreup . barisal . gov . bd', 1, 254, NULL, NULL, NULL, NULL),
(2296, 'Sarikal', 'সরিকল', 'sarikalup . barisal . gov . bd', 1, 254, NULL, NULL, NULL, NULL),
(2297, 'Rajihar', 'রাজিহার', 'rajiharup . barisal . gov . bd', 1, 255, NULL, NULL, NULL, NULL),
(2298, 'Bakal', 'বাকাল', 'bakalup . barisal . gov . bd', 1, 255, NULL, NULL, NULL, NULL),
(2299, 'Bagdha', 'বাগধা', 'bagdhaup . barisal . gov . bd', 1, 255, NULL, NULL, NULL, NULL),
(2300, 'Goila', 'গৈলা', 'goilaup . barisal . gov . bd', 1, 255, NULL, NULL, NULL, NULL),
(2301, 'Ratnapur', 'রত্নপুর', 'ratnapurup . barisal . gov . bd', 1, 255, NULL, NULL, NULL, NULL),
(2302, 'Andarmanik', 'আন্দারমানিক', 'andarmanikup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2303, 'Lata', 'লতা', 'lataup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2304, 'Charakkorea', 'চরএককরিয়া', 'charakkoreaup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2305, 'Ulania', 'উলানিয়া', 'ulaniaup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2306, 'Mehendigong', 'মেহেন্দিগঞ্জ', 'mehendigongup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2307, 'Biddanandapur', 'বিদ্যানন্দনপুর', 'biddanandapurup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2308, 'Bhashanchar', 'ভাষানচর', 'bhashancharup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2309, 'Jangalia', 'জাঙ্গালিয়া', 'jangaliaup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2310, 'Alimabad', 'আলিমাবাদ', 'alimabadup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2311, 'Chandpur', 'চানপুর', 'chandpurup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2312, 'Darirchar Khajuria', 'দড়িরচর খাজুরিয়া', 'darircharkhajuriaup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2313, 'Gobindapur', 'গোবিন্দপুর', 'gobindapurup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2314, 'Chargopalpur', 'চরগোপালপুর', 'chargopalpurup . barisal . gov . bd', 1, 256, NULL, NULL, NULL, NULL),
(2315, 'Batamara', 'বাটামারা', 'batamaraup . barisal . gov . bd', 1, 257, NULL, NULL, NULL, NULL),
(2316, 'Nazirpur', 'নাজিরপুর', 'nazirpurup . barisal . gov . bd', 1, 257, NULL, NULL, NULL, NULL),
(2317, 'Safipur', 'সফিপুর', 'safipurup . barisal . gov . bd', 1, 257, NULL, NULL, NULL, NULL),
(2318, 'Gaschua', 'গাছুয়া', 'gaschuaup . barisal . gov . bd', 1, 257, NULL, NULL, NULL, NULL),
(2319, 'Charkalekha', 'চরকালেখা', 'charkalekhaup . barisal . gov . bd', 1, 257, NULL, NULL, NULL, NULL),
(2320, 'Muladi', 'মুলাদী', 'muladiup . barisal . gov . bd', 1, 257, NULL, NULL, NULL, NULL),
(2321, 'Kazirchar', 'কাজিরচর', 'kazircharup . barisal . gov . bd', 1, 257, NULL, NULL, NULL, NULL),
(2322, 'Harinathpur', 'হরিনাথপুর', 'harinathpurup . barisal . gov . bd', 1, 258, NULL, NULL, NULL, NULL),
(2323, 'Memania', 'মেমানিয়া', 'memaniaup . barisal . gov . bd', 1, 258, NULL, NULL, NULL, NULL),
(2324, 'Guabaria', 'গুয়াবাড়িয়া', 'guabariaup . barisal . gov . bd', 1, 258, NULL, NULL, NULL, NULL),
(2325, 'Barjalia', 'বড়জালিয়া', 'barjaliaup . barisal . gov . bd', 1, 258, NULL, NULL, NULL, NULL),
(2326, 'Hizla Gourabdi', 'হিজলা গৌরাব্দি', 'hizlagourabdiup . barisal . gov . bd', 1, 258, NULL, NULL, NULL, NULL),
(2327, 'Dhulkhola', 'ধুলখোলা', 'dhulkholaup . barisal . gov . bd', 1, 258, NULL, NULL, NULL, NULL),
(2328, 'Razapur', 'রাজাপুর', 'razapurup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2329, 'Ilisha', 'ইলিশা', 'ilishaup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2330, 'Westilisa', 'পশ্চিম ইলিশা', 'westilisaup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2331, 'Kachia', 'কাচিয়া', 'kachiaup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2332, 'Bapta', 'বাপ্তা', 'baptaup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2333, 'Dhania', 'ধনিয়া', 'dhaniaup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2334, 'Shibpur', 'শিবপুর', 'shibpurup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2335, 'Alinagor', 'আলীনগর', 'alinagorup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2336, 'Charshamya', 'চরসামাইয়া', 'charshamyaup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2337, 'Vhelumia', ' ভেলুমিয়া', 'vhelumiaup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2338, 'Vheduria', 'ভেদুরিয়া', 'vheduriaup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2339, 'North Digholdi', 'উত্তর দিঘলদী', 'northdigholdiup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2340, 'South Digholdi', 'দক্ষিণ দিঘলদী', 'southdigholdiup . bhola . gov . bd', 1, 259, NULL, NULL, NULL, NULL),
(2341, 'Boromanika', 'বড় মানিকা', 'boromanikaup . bhola . gov . bd', 1, 260, NULL, NULL, NULL, NULL),
(2342, 'Deula', 'দেউলা', 'deulaup . bhola . gov . bd', 1, 260, NULL, NULL, NULL, NULL),
(2343, 'Kutuba', 'কুতুবা', 'kutubaup . bhola . gov . bd', 1, 260, NULL, NULL, NULL, NULL),
(2344, 'Pakshia', 'পক্ষিয়া', 'pakshiaup . bhola . gov . bd', 1, 260, NULL, NULL, NULL, NULL),
(2345, 'Kachia', 'কাচিয়া', 'kachiaup4 . bhola . gov . bd', 1, 260, NULL, NULL, NULL, NULL),
(2346, 'Osmangonj', 'ওসমানগঞ্জ', 'osmangonjup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2347, 'Aslampur', 'আছলামপুর', 'aslampurup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2348, 'Zinnagor', 'জিন্নাগড়', 'zinnagorup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2349, 'Aminabad', 'আমিনাবাদ', 'aminabadup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2350, 'Nilkomol', 'নীলকমল', 'nilkomolup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2351, 'Charmadraj', 'চরমাদ্রাজ', 'charmadrajup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2352, 'Awajpur', 'আওয়াজপুর', 'awajpurup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2353, 'Awajpur', 'আওয়াজপুর', 'awajpurup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2354, 'Charkolmi', 'চরকলমী', 'charkolmiup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2355, 'Charmanika', 'চরমানিকা', 'charmanikaup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2356, 'Hazarigonj', 'হাজারীগঞ্জ', 'hazarigonjup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2357, 'Jahanpur', 'জাহানপুর', 'jahanpurup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2358, 'Nurabad', 'নুরাবাদ', 'nurabadup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2359, 'Rasulpur', 'রসুলপুর', 'rasulpurup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2360, 'Kukrimukri', 'কুকরীমূকরী', 'kukrimukriup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2361, 'Abubakarpur', 'আবুবকরপুর', 'abubakarpurup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2362, 'Abdullahpur', 'আবদুল্লাহ', 'abdullahpurup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2363, 'Nazrulnagar', 'নজরুল নগর', 'nazrulnagarup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2364, 'Mujibnagar', 'মুজিব নগর', 'mujibnagarup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2365, 'Dalchar', 'ঢালচর', 'dalcharup . bhola . gov . bd', 1, 261, NULL, NULL, NULL, NULL),
(2366, 'Madanpur', 'মদনপুর', 'madanpurup . bhola . gov . bd', 1, 262, NULL, NULL, NULL, NULL),
(2367, 'Madua', 'মেদুয়া', 'maduaup . bhola . gov . bd', 1, 262, NULL, NULL, NULL, NULL),
(2368, 'Charpata', 'চরপাতা', 'charpataup . bhola . gov . bd', 1, 262, NULL, NULL, NULL, NULL),
(2369, 'North Joy Nagar', 'উত্তর জয়নগর', 'northjoynagarup . bhola . gov . bd', 1, 262, NULL, NULL, NULL, NULL),
(2370, 'South Joy Nagar', 'দক্ষিন জয়নগর', 'southjoynagarup . bhola . gov . bd', 1, 262, NULL, NULL, NULL, NULL),
(2371, 'Char Khalipa', 'চর খলিফা', 'charkhalipaup . bhola . gov . bd', 1, 262, NULL, NULL, NULL, NULL),
(2372, 'Sayedpur', 'সৈয়দপুর', 'sayedpurup . bhola . gov . bd', 1, 262, NULL, NULL, NULL, NULL),
(2373, 'Hazipur', 'হাজীপুর', 'hazipurup . bhola . gov . bd', 1, 262, NULL, NULL, NULL, NULL),
(2374, 'Vhovanipur', 'ভবানীপুর', 'vhovanipurup . bhola . gov . bd', 1, 262, NULL, NULL, NULL, NULL),
(2375, 'Hazirhat', 'হাজীর হাট', 'hazirhatup . bhola . gov . bd', 1, 263, NULL, NULL, NULL, NULL),
(2376, 'Monpura', 'মনপুরা', 'monpuraup . bhola . gov . bd', 1, 263, NULL, NULL, NULL, NULL),
(2377, 'North Sakuchia', 'উত্তর সাকুচিয়া', 'sakuchianorthup . bhola . gov . bd', 1, 263, NULL, NULL, NULL, NULL),
(2378, 'South Sakuchia', 'দক্ষিন সাকুচিয়া', 'sakuchiasouthup . bhola . gov . bd', 1, 263, NULL, NULL, NULL, NULL),
(2379, 'Chanchra', 'চাচঁড়া', 'chanchraup . bhola . gov . bd', 1, 264, NULL, NULL, NULL, NULL),
(2380, 'Shambupur', 'শম্ভুপুর', 'shambupurup . bhola . gov . bd', 1, 264, NULL, NULL, NULL, NULL),
(2381, 'Sonapur', 'সোনাপুর', 'sonapurup . bhola . gov . bd', 1, 264, NULL, NULL, NULL, NULL),
(2382, 'Chadpur', 'চাঁদপুর', 'chadpurup . bhola . gov . bd', 1, 264, NULL, NULL, NULL, NULL),
(2383, 'Baro Molongchora', 'বড় মলংচড়া', 'baromolongchoraup . bhola . gov . bd', 1, 264, NULL, NULL, NULL, NULL),
(2384, 'Badarpur', 'বদরপুর', 'badarpurup . bhola . gov . bd', 1, 265, NULL, NULL, NULL, NULL),
(2385, 'Charbhuta', 'চরভূতা', 'charbhutaup . bhola . gov . bd', 1, 265, NULL, NULL, NULL, NULL),
(2386, 'Kalma', ' কালমা', 'kalmaup . bhola . gov . bd', 1, 265, NULL, NULL, NULL, NULL),
(2387, 'Dholigour Nagar', 'ধলীগৌর নগর', 'dholigournagarup . bhola . gov . bd', 1, 265, NULL, NULL, NULL, NULL),
(2388, 'Lalmohan', 'লালমোহন', 'lalmohanup . bhola . gov . bd', 1, 265, NULL, NULL, NULL, NULL),
(2389, 'Lord Hardinge', 'লর্ড হার্ডিঞ্জ', 'lordhardingeup . bhola . gov . bd', 1, 265, NULL, NULL, NULL, NULL),
(2390, 'Ramagonj', 'রমাগঞ্জ', 'ramagonjup . bhola . gov . bd', 1, 265, NULL, NULL, NULL, NULL),
(2391, 'Paschim Char Umed', 'পশ্চিম চর উমেদ', 'paschimcharumedup . bhola . gov . bd', 1, 265, NULL, NULL, NULL, NULL),
(2392, 'Farajgonj', 'ফরাজগঞ্জ', 'farajgonjup . bhola . gov . bd', 1, 265, NULL, NULL, NULL, NULL),
(2393, 'Amtali', 'আমতলী', 'amtaliup . barguna . gov . bd', 1, 266, NULL, NULL, NULL, NULL),
(2394, 'Gulishakhali', 'গুলিশাখালী', 'gulishakhaliup . barguna . gov . bd', 1, 266, NULL, NULL, NULL, NULL),
(2395, 'Athrogasia', 'আঠারগাছিয়া', 'athrogasiaup . barguna . gov . bd', 1, 266, NULL, NULL, NULL, NULL),
(2396, 'Kukua', 'কুকুয়া', 'kukuaup . barguna . gov . bd', 1, 266, NULL, NULL, NULL, NULL),
(2397, 'Haldia', 'হলদিয়া', 'haldiaup . barguna . gov . bd', 1, 266, NULL, NULL, NULL, NULL),
(2398, 'Chotobogi', 'ছোটবগী', 'chotobogiup . barguna . gov . bd', 1, 266, NULL, NULL, NULL, NULL),
(2399, 'Arpangasia', 'আড়পাঙ্গাশিয়া', 'arpangasiaup . barguna . gov . bd', 1, 266, NULL, NULL, NULL, NULL),
(2400, 'Chowra', 'চাওড়া', 'chowraup . barguna . gov . bd', 1, 266, NULL, NULL, NULL, NULL),
(2401, 'M . Baliatali', 'এম . বালিয়াতলী', 'm . baliataliup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2402, 'Noltona', 'নলটোনা', 'noltonaup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2403, 'Bodorkhali', 'বদরখালী', 'bodorkhaliup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2404, 'Gowrichanna', 'গৌরিচন্না', 'gowrichannaup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2405, 'Fuljhuri', 'ফুলঝুড়ি', 'fuljhuriup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2406, 'Keorabunia', 'কেওড়াবুনিয়া', 'keorabuniaup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2407, 'Ayla Patakata', 'আয়লা পাতাকাটা', 'aylaPatakataup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2408, 'Burirchor', 'বুড়িরচর', 'burirchorup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2409, 'Dhalua', 'ঢলুয়া', 'dhaluaup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2410, 'Barguna', 'বরগুনা', 'bargunaup . barguna . gov . bd', 1, 267, NULL, NULL, NULL, NULL),
(2411, 'Bibichini', 'বিবিচিন', 'bibichiniup . barguna . gov . bd', 1, 268, NULL, NULL, NULL, NULL),
(2412, 'Betagi', 'বেতাগী', 'betagiup . barguna . gov . bd', 1, 268, NULL, NULL, NULL, NULL),
(2413, 'Hosnabad', 'হোসনাবাদ', 'hosnabadup . barguna . gov . bd', 1, 268, NULL, NULL, NULL, NULL),
(2414, 'Mokamia', 'মোকামিয়া', 'mokamiaup . barguna . gov . bd', 1, 268, NULL, NULL, NULL, NULL),
(2415, 'Buramajumder', 'বুড়ামজুমদার', 'buramajumderup . barguna . gov . bd', 1, 268, NULL, NULL, NULL, NULL),
(2416, 'Kazirabad', 'কাজীরাবাদ', 'kazirabadup . barguna . gov . bd', 1, 268, NULL, NULL, NULL, NULL),
(2417, 'Sarisamuri', 'সরিষামুড়ী', 'sarisamuriup . barguna . gov . bd', 1, 268, NULL, NULL, NULL, NULL),
(2418, 'Bukabunia', 'বুকাবুনিয়া', 'bukabuniaup . barguna . gov . bd', 1, 269, NULL, NULL, NULL, NULL),
(2419, 'Bamna', 'বামনা', 'bamnaup . barguna . gov . bd', 1, 269, NULL, NULL, NULL, NULL),
(2420, 'Ramna', 'রামনা', 'ramnaup . barguna . gov . bd', 1, 269, NULL, NULL, NULL, NULL),
(2421, 'Doutola', 'ডৌয়াতলা', 'doutolaup . barguna . gov . bd', 1, 269, NULL, NULL, NULL, NULL),
(2422, 'Raihanpur', 'রায়হানপুর', 'raihanpurup . barguna . gov . bd', 1, 270, NULL, NULL, NULL, NULL),
(2423, 'Nachnapara', 'নাচনাপাড়া', 'nachnaparaup . barguna . gov . bd', 1, 270, NULL, NULL, NULL, NULL),
(2424, 'Charduany', 'চরদুয়ানী', 'charduanyup . barguna . gov . bd', 1, 270, NULL, NULL, NULL, NULL),
(2425, 'Patharghata', 'পাথরঘাটা', 'patharghataup . barguna . gov . bd', 1, 270, NULL, NULL, NULL, NULL),
(2426, 'Kalmegha', 'কালমেঘা', 'kalmeghaup . barguna . gov . bd', 1, 270, NULL, NULL, NULL, NULL),
(2427, 'Kakchira', 'কাকচিঢ়া', 'kakchiraup . barguna . gov . bd', 1, 270, NULL, NULL, NULL, NULL),
(2428, 'Kathaltali', 'কাঠালতলী', 'kathaltaliup . barguna . gov . bd', 1, 270, NULL, NULL, NULL, NULL),
(2429, 'Karibaria', 'কড়ইবাড়ীয়া', 'karibariaup . barguna . gov . bd', 1, 271, NULL, NULL, NULL, NULL),
(2430, 'Panchakoralia', 'পচাকোড়ালিয়া', 'panchakoraliaup . barguna . gov . bd', 1, 271, NULL, NULL, NULL, NULL),
(2431, 'Barabagi', 'বড়বগি', 'barabagiup . barguna . gov . bd', 1, 271, NULL, NULL, NULL, NULL),
(2432, 'Chhotabagi', 'ছোটবগি', 'chhotabagiup . barguna . gov . bd', 1, 271, NULL, NULL, NULL, NULL),
(2433, 'Nishanbaria', 'নিশানবাড়ীয়া', 'nishanbariaup . barguna . gov . bd', 1, 271, NULL, NULL, NULL, NULL),
(2434, 'Sarikkhali', 'শারিকখালি', 'sarikkhaliup . barguna . gov . bd', 1, 271, NULL, NULL, NULL, NULL),
(2435, 'Sonakata', 'সোনাকাটা', 'sonakataup . barguna . gov . bd', 1, 271, NULL, NULL, NULL, NULL),
(2436, 'Tazpur', 'তাজপুর', 'tazpurup . sylhet . gov . bd', 1, 284, NULL, NULL, NULL, NULL),
(2437, 'Umorpur', 'উমরপুর', 'umorpurup . sylhet . gov . bd', 1, 284, NULL, NULL, NULL, NULL),
(2438, 'West Poilanpur', 'পশ্চিম পৈলনপুর', 'westpoilanpurup . sylhet . gov . bd', 1, 284, NULL, NULL, NULL, NULL),
(2439, 'East Poilanpur', 'পূর্ব পৈলনপুর', 'eastpoilanpurup . sylhet . gov . bd', 1, 272, NULL, NULL, NULL, NULL),
(2440, 'Boaljur', 'বোয়ালজুর', 'boaljurup . sylhet . gov . bd', 1, 272, NULL, NULL, NULL, NULL),
(2441, 'Burungabazar', 'বুরুঙ্গাবাজার', 'burungabazarup . sylhet . gov . bd', 1, 284, NULL, NULL, NULL, NULL),
(2442, 'Goalabazar', 'গোয়ালাবাজার', 'goalabazarup . sylhet . gov . bd', 1, 284, NULL, NULL, NULL, NULL),
(2443, 'Doyamir', 'দয়ামীর', 'doyamirup . sylhet . gov . bd', 1, 284, NULL, NULL, NULL, NULL),
(2444, 'Usmanpur', 'উসমানপুর', 'usmanpurup . sylhet . gov . bd', 1, 284, NULL, NULL, NULL, NULL),
(2445, 'Dewanbazar', 'দেওয়ান বাজার', 'dewanbazarup . sylhet . gov . bd', 1, 272, NULL, NULL, NULL, NULL),
(2446, 'West Gouripur', 'পশ্চিম গৌরীপুর', 'westgouripurup . sylhet . gov . bd', 1, 272, NULL, NULL, NULL, NULL),
(2447, 'East Gouripur', 'পূর্ব গৌরীপুর', 'eastgouripurup . sylhet . gov . bd', 1, 272, NULL, NULL, NULL, NULL),
(2448, 'Balaganj', 'বালাগঞ্জ', 'balaganjup . sylhet . gov . bd', 1, 272, NULL, NULL, NULL, NULL),
(2449, 'Sadipur', 'সাদিরপুর', 'sadipurup . sylhet . gov . bd', 1, 284, NULL, NULL, NULL, NULL),
(2450, 'Tilpara', 'তিলপাড়া', 'tilparaup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2451, 'Alinagar', 'আলীনগর', 'alinagarup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2452, 'Charkhai', 'চরখাই', 'charkhaiup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2453, 'Dubag', 'দুবাগ', 'dubagup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2454, 'Sheola', 'শেওলা', 'sheolaup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2455, 'Kurarbazar', 'কুড়ারবাজার', 'kurarbazarup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2456, 'Mathiura', 'মাথিউরা', 'mathiuraup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2457, 'Mullapur', 'মোল্লাপুর', 'mullapurup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2458, 'Muria', 'মুড়িয়া', 'muriaup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2459, 'Lauta', 'লাউতা', 'lautaup . sylhet . gov . bd', 1, 273, NULL, NULL, NULL, NULL),
(2460, 'Rampasha', 'রামপাশা', 'rampashaup . sylhet . gov . bd', 1, 274, NULL, NULL, NULL, NULL),
(2461, 'Lamakazi', 'লামাকাজী', 'lamakaziup . sylhet . gov . bd', 1, 274, NULL, NULL, NULL, NULL),
(2462, 'Khajanchi', 'খাজাঞ্চী', 'khajanchiup . sylhet . gov . bd', 1, 274, NULL, NULL, NULL, NULL),
(2463, 'Alankari', 'অলংকারী', 'alankariup . sylhet . gov . bd', 1, 274, NULL, NULL, NULL, NULL),
(2464, 'Dewkalash', 'দেওকলস', 'dewkalashup . sylhet . gov . bd', 1, 274, NULL, NULL, NULL, NULL),
(2465, 'Bishwanath', 'বিশ্বনাথ', 'bishwanathup . sylhet . gov . bd', 1, 274, NULL, NULL, NULL, NULL),
(2466, 'Doshghar', 'দশঘর', 'doshgharup . sylhet . gov . bd', 1, 274, NULL, NULL, NULL, NULL),
(2467, 'Daulatpur', 'দৌলতপুর', 'daulatpurup . sylhet . gov . bd', 1, 274, NULL, NULL, NULL, NULL),
(2468, 'Telikhal', 'তেলিখাল', 'telikhalup . sylhet . gov . bd', 1, 275, NULL, NULL, NULL, NULL),
(2469, 'Islampur Paschim', 'ইসলামপুর পশ্চিম', 'islampurpaschimup . sylhet . gov . bd', 1, 275, NULL, NULL, NULL, NULL),
(2470, 'Islampur Purba', 'ইসলামপুর পূর্ব', 'islampurpurbaup . sylhet . gov . bd', 1, 275, NULL, NULL, NULL, NULL),
(2471, 'Isakalas', 'ইসাকলস', 'isakalasup . sylhet . gov . bd', 1, 275, NULL, NULL, NULL, NULL),
(2472, 'Uttor Ronikhai', 'উত্তর রনিখাই', 'uttorronikhaiup . sylhet . gov . bd', 1, 275, NULL, NULL, NULL, NULL),
(2473, 'Dakkin Ronikhai', 'দক্ষিন রনিখাই', 'dakkinronikhaiup . sylhet . gov . bd', 1, 275, NULL, NULL, NULL, NULL),
(2474, 'Ghilachora', 'ঘিলাছড়া', 'ghilachoraup . sylhet . gov . bd', 1, 276, NULL, NULL, NULL, NULL),
(2475, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', '1nofenchuganjup . sylhet . gov . bd', 1, 276, NULL, NULL, NULL, NULL),
(2476, 'Uttar Kushiara', 'উত্তর কুশিয়ারা', 'uttarkushiaraup . sylhet . gov . bd', 1, 276, NULL, NULL, NULL, NULL),
(2477, 'Uttar Fenchuganj', 'উত্তর ফেঞ্চুগঞ্জ', 'uttarfenchuganjup . sylhet . gov . bd', 1, 276, NULL, NULL, NULL, NULL),
(2478, 'Maijgaon', 'মাইজগাঁও', 'maijgaonup . sylhet . gov . bd', 1, 276, NULL, NULL, NULL, NULL),
(2479, 'Golapganj', 'গোলাপগঞ্জ', 'golapganjup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2480, 'Fulbari', 'ফুলবাড়ী', 'fulbariup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2481, 'Lakshmipasha', 'লক্ষ্মীপাশা', 'lakshmipashaup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2482, 'Budhbaribazar', 'বুধবারীবাজার', 'budhbaribazarup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2483, 'Dhakadakshin', 'ঢাকাদক্ষিন', 'dhakadakshinup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2484, 'Sharifganj', 'শরিফগঞ্জ', 'sharifganjup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2485, 'Uttar Badepasha', 'উত্তর বাদেপাশা', 'uttarbadepashaup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2486, 'Lakshanaband', 'লক্ষনাবন্দ', 'lakshanabandup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2487, 'Bhadeshwar', 'ভাদেশ্বর', 'bhadeshwarup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2488, 'West Amura', 'পশ্চিম আমুরা', 'westamuraup . sylhet . gov . bd', 1, 277, NULL, NULL, NULL, NULL),
(2489, 'Fothepur', 'ফতেপুর', 'fothepurup . sylhet . gov . bd', 1, 278, NULL, NULL, NULL, NULL),
(2490, 'Rustampur', 'রুস্তমপুর', 'rustampurup . sylhet . gov . bd', 1, 278, NULL, NULL, NULL, NULL),
(2491, 'Paschim Jaflong', 'পশ্চিম জাফলং', 'paschimjaflongup . sylhet . gov . bd', 1, 278, NULL, NULL, NULL, NULL),
(2492, 'Purba Jaflong', 'পূর্ব জাফলং', 'purbajaflongup . sylhet . gov . bd', 1, 278, NULL, NULL, NULL, NULL),
(2493, 'Lengura', 'লেঙ্গুড়া', 'lenguraup . sylhet . gov . bd', 1, 278, NULL, NULL, NULL, NULL),
(2494, 'Alirgaon', 'আলীরগাঁও', 'alirgaonup . sylhet . gov . bd', 1, 278, NULL, NULL, NULL, NULL),
(2495, 'Nandirgaon', 'নন্দিরগাঁও', 'nandirgaonup . sylhet . gov . bd', 1, 278, NULL, NULL, NULL, NULL),
(2496, 'Towakul', 'তোয়াকুল', 'towakulup . sylhet . gov . bd', 1, 278, NULL, NULL, NULL, NULL),
(2497, 'Daubari', 'ডৌবাড়ী', 'daubariup . sylhet . gov . bd', 1, 278, NULL, NULL, NULL, NULL),
(2498, 'Nijpat', 'নিজপাট', 'nijpatup . sylhet . gov . bd', 1, 279, NULL, NULL, NULL, NULL),
(2499, 'Jaintapur', 'জৈন্তাপুর', 'jaintapurup . sylhet . gov . bd', 1, 279, NULL, NULL, NULL, NULL),
(2500, 'Charikatha', 'চারিকাটা', 'charikathaup . sylhet . gov . bd', 1, 279, NULL, NULL, NULL, NULL),
(2501, 'Darbast', 'দরবস্ত', 'darbastup . sylhet . gov . bd', 1, 279, NULL, NULL, NULL, NULL),
(2502, 'Fatehpur', 'ফতেপুর', 'fatehpurup . sylhet . gov . bd', 1, 279, NULL, NULL, NULL, NULL),
(2503, 'Chiknagul', 'চিকনাগুল', 'chiknagulup . sylhet . gov . bd', 1, 279, NULL, NULL, NULL, NULL),
(2504, 'Rajagonj', 'রাজাগঞ্জ', 'rajagonjup . sylhet . gov . bd', 1, 280, NULL, NULL, NULL, NULL),
(2505, 'Lakshiprashad Purbo', 'লক্ষীপ্রাসাদ পূর্ব', 'lakshiprashadpurboup . sylhet . gov . bd', 1, 280, NULL, NULL, NULL, NULL),
(2506, 'Lakshiprashad Pashim', 'লক্ষীপ্রাসাদ পশ্চিম', 'lakshiprashadpashimup . sylhet . gov . bd', 1, 280, NULL, NULL, NULL, NULL),
(2507, 'Digirpar Purbo', 'দিঘিরপার পূর্ব', 'digirparpurboup . sylhet . gov . bd', 1, 280, NULL, NULL, NULL, NULL),
(2508, 'Satbakh', 'সাতবাক', 'satbakhup . sylhet . gov . bd', 1, 280, NULL, NULL, NULL, NULL),
(2509, 'Barachotul', 'বড়চতুল', 'barachotulup . sylhet . gov . bd', 1, 280, NULL, NULL, NULL, NULL),
(2510, 'Kanaighat', 'কানাইঘাট', 'kanaighatup . sylhet . gov . bd', 1, 280, NULL, NULL, NULL, NULL),
(2511, 'Dakhin Banigram', 'দক্ষিন বানিগ্রাম', 'dakhinbanigramup . sylhet . gov . bd', 1, 280, NULL, NULL, NULL, NULL);
INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(2512, 'Jinghabari', 'ঝিঙ্গাবাড়ী', 'jinghabariup . sylhet . gov . bd', 1, 280, NULL, NULL, NULL, NULL),
(2513, 'Jalalabad', 'জালালাবাদ', 'jalalabadup . sylhet . gov . bd', 1, 281, NULL, NULL, NULL, NULL),
(2514, 'Hatkhula', 'হাটখোলা', 'hatkhulaup . sylhet . gov . bd', 1, 281, NULL, NULL, NULL, NULL),
(2515, 'Khadimnagar', 'খাদিমনগর', 'khadimnagarup . sylhet . gov . bd', 1, 281, NULL, NULL, NULL, NULL),
(2516, 'Khadimpara', 'খাদিমপাড়া', 'khadimparaup . sylhet . gov . bd', 1, 281, NULL, NULL, NULL, NULL),
(2517, 'Tultikor', 'টুলটিকর', 'tultikorup . sylhet . gov . bd', 1, 281, NULL, NULL, NULL, NULL),
(2518, 'Tukerbazar', 'টুকেরবাজার', 'tukerbazarup . sylhet . gov . bd', 1, 281, NULL, NULL, NULL, NULL),
(2519, 'Mugolgaon', 'মোগলগাও', 'mugolgaonup . sylhet . gov . bd', 1, 281, NULL, NULL, NULL, NULL),
(2520, 'Kandigaon', 'কান্দিগাও', 'kandigaonup . sylhet . gov . bd', 1, 281, NULL, NULL, NULL, NULL),
(2521, 'Manikpur', 'মানিকপুর', 'manikpurup . sylhet . gov . bd', 1, 282, NULL, NULL, NULL, NULL),
(2522, 'Sultanpur', 'সুলতানপুর', 'sultanpurup . sylhet . gov . bd', 1, 282, NULL, NULL, NULL, NULL),
(2523, 'Barohal', 'বারহাল', 'barohalup . sylhet . gov . bd', 1, 282, NULL, NULL, NULL, NULL),
(2524, 'Birorsri', 'বিরশ্রী', 'birorsriup . sylhet . gov . bd', 1, 282, NULL, NULL, NULL, NULL),
(2525, 'Kajalshah', 'কাজলশার', 'kajalshahup . sylhet . gov . bd', 1, 282, NULL, NULL, NULL, NULL),
(2526, 'Kolachora', 'কলাছড়া', 'kolachora . sylhet . gov . bd', 1, 282, NULL, NULL, NULL, NULL),
(2527, 'Zakiganj', 'জকিগঞ্জ', 'zakiganjup . sylhet . gov . bd', 1, 282, NULL, NULL, NULL, NULL),
(2528, 'Barothakuri', 'বারঠাকুরী', 'barothakuriup . sylhet . gov . bd', 1, 282, NULL, NULL, NULL, NULL),
(2529, 'Kaskanakpur', 'কসকনকপুর', 'kaskanakpurup . sylhet . gov . bd', 1, 282, NULL, NULL, NULL, NULL),
(2530, 'Lalabazar', 'লালাবাজার', 'lalabazarup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2531, 'Moglabazar', 'মোগলাবাজার', 'moglabazarup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2532, 'Boroikandi', 'বড়ইকান্দি', 'boroikandiup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2533, 'Silam', 'সিলাম', 'silamup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2534, 'Daudpur', 'দাউদপুর', 'daudpurup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2535, 'Mollargaon', 'মোল্লারগাঁও', 'mollargaonup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2536, 'Kuchai', 'কুচাই', 'kuchaiup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2537, 'Kamalbazar', 'কামালবাজার', 'kamalbazarup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2538, 'Jalalpur', 'জালালপুর', 'jalalpurup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2539, 'Tetli', 'তেতলী', 'tetliup . sylhet . gov . bd', 1, 283, NULL, NULL, NULL, NULL),
(2540, 'Talimpur', 'তালিমপুর', 'talimpurup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2541, 'Borni', 'বর্ণি', 'borniup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2542, 'Dasherbazar', 'দাসেরবাজার', 'dasherbazarup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2543, 'Nizbahadurpur', 'নিজবাহাদুরপুর', 'nizbahadurpurup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2544, 'Uttar Shahbajpur', 'উত্তর শাহবাজপুর', 'shahbajpuruttarup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2545, 'Dakkhin Shahbajpur', 'দক্ষিণ শাহবাজপুর', 'shahbajpurdakshinup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2546, 'Talimpur', 'তালিমপুর', 'talimpurup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2547, 'Baralekha', 'বড়লেখা', 'baralekhaup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2548, 'Dakshinbhag Uttar', 'দক্ষিণভাগ(উত্তর]', 'dakshinbhaguttarup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2549, 'Dakshinbhag Dakkhin', 'দক্ষিণভাগ(দক্ষিণ]', 'dakshinbhagdakshinup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2550, 'Sujanagar', 'সুজানগর', 'sujanagarup . moulvibazar . gov . bd', 1, 285, NULL, NULL, NULL, NULL),
(2551, 'Adampur', 'আদমপুর', 'adampurup . moulvibazar . gov . bd', 1, 286, NULL, NULL, NULL, NULL),
(2552, 'Patanushar', 'পতনঊষার', 'patanusharup . moulvibazar . gov . bd', 1, 286, NULL, NULL, NULL, NULL),
(2553, 'Madhabpur', 'মাধবপুর', 'madhabpurup . moulvibazar . gov . bd', 1, 286, NULL, NULL, NULL, NULL),
(2554, 'Rahimpur', 'রহিমপুর', 'rahimpurup . moulvibazar . gov . bd', 1, 286, NULL, NULL, NULL, NULL),
(2555, 'Shamshernagar', 'শমশেরনগর', 'shamshernagarup . moulvibazar . gov . bd', 1, 286, NULL, NULL, NULL, NULL),
(2556, 'Kamalgonj', 'কমলগঞ্জ', 'kamalgonjup . moulvibazar . gov . bd', 1, 286, NULL, NULL, NULL, NULL),
(2557, 'Islampur', 'ইসলামপুর', 'islampurup . moulvibazar . gov . bd', 1, 286, NULL, NULL, NULL, NULL),
(2558, 'Munshibazar', 'মুন্সিবাজার', 'munshibazarup3 . moulvibazar . gov . bd', 1, 286, NULL, NULL, NULL, NULL),
(2559, 'Alinagar', 'আলী নগর', 'alinagarup . moulvibazar . gov . bd', 1, 286, NULL, NULL, NULL, NULL),
(2560, 'Baramchal', 'বরমচাল', 'baramchalup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2561, 'Bhukshimail', 'ভূকশিমইল', 'bhukshimailup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2562, 'Joychandi', 'জয়চন্ডি', 'joychandiup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2563, 'Brammanbazar', 'ব্রাহ্মণবাজার', 'brammanbazarup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2564, 'Kadipur', 'কাদিপুর', 'kadipurup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2565, 'Kulaura', 'কুলাউড়া', 'kulauraup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2566, 'Rauthgaon', 'রাউৎগাঁও', 'rauthgaonup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2567, 'Tilagaon', 'টিলাগাঁও', 'tilagaonup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2568, 'Sharifpur', 'শরীফপুর', 'sharifpurup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2569, 'Prithimpassa', 'পৃথিমপাশা', 'prithimpassaup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2570, 'Kormodha', 'কর্মধা', 'kormodhaup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2571, 'Bhatera', 'ভাটেরা', 'bhateraup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2572, 'Hazipur', 'হাজীপুর', 'hazipurup . moulvibazar . gov . bd', 1, 287, NULL, NULL, NULL, NULL),
(2573, 'Amtail', 'আমতৈল', 'amtailup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2574, 'Khalilpur', 'খলিলপুর', 'khalilpurup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2575, 'Monumukh', 'মনুমুখ', 'monumukhup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2576, 'Kamalpur', 'কামালপুর', 'kamalpurup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2577, 'Apar Kagabala', 'আপার কাগাবলা', 'uparkagabalaup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2578, 'Akhailkura', 'আখাইলকুড়া', 'akhailkuraup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2579, 'Ekatuna', 'একাটুনা', 'ekatunaup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2580, 'Chadnighat', 'চাঁদনীঘাট', 'chadnighatup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2581, 'Konokpur', 'কনকপুর', 'konokpurup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2582, 'Nazirabad', 'নাজিরাবাদ', 'nazirabadup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2583, 'Mostafapur', 'মোস্তফাপুর', 'mostafapurup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2584, 'Giasnagar', 'গিয়াসনগর', 'giasnagarup . moulvibazar . gov . bd', 1, 288, NULL, NULL, NULL, NULL),
(2585, 'Fotepur', 'ফতেপুর', 'fotepurup . moulvibazar . gov . bd', 1, 289, NULL, NULL, NULL, NULL),
(2586, 'Uttorbhag', 'উত্তরভাগ', 'uttorbhagup . moulvibazar . gov . bd', 1, 289, NULL, NULL, NULL, NULL),
(2587, 'Munsibazar', 'মুন্সিবাজার', 'munsibazarup . moulvibazar . gov . bd', 1, 289, NULL, NULL, NULL, NULL),
(2588, 'Panchgaon', 'পাঁচগাঁও', 'panchgaonup . moulvibazar . gov . bd', 1, 289, NULL, NULL, NULL, NULL),
(2589, 'Rajnagar', 'রাজনগর', 'rajnagarup . moulvibazar . gov . bd', 1, 289, NULL, NULL, NULL, NULL),
(2590, 'Tengra', 'টেংরা', 'tengraup . moulvibazar . gov . bd', 1, 289, NULL, NULL, NULL, NULL),
(2591, 'Kamarchak', 'কামারচাক', 'kamarchakup . moulvibazar . gov . bd', 1, 289, NULL, NULL, NULL, NULL),
(2592, 'Munsurnagar', 'মনসুরনগর', 'munsurnagarup . moulvibazar . gov . bd', 1, 289, NULL, NULL, NULL, NULL),
(2593, 'Mirzapur', 'মির্জাপুর', 'mirzapurup . moulvibazar . gov . bd', 1, 290, NULL, NULL, NULL, NULL),
(2594, 'Bhunabir', 'ভূনবীর', 'bhunabirup . moulvibazar . gov . bd', 1, 290, NULL, NULL, NULL, NULL),
(2595, 'Sreemangal', 'শ্রীমঙ্গল', 'sreemangalup . moulvibazar . gov . bd', 1, 290, NULL, NULL, NULL, NULL),
(2596, 'Sindurkhan', 'সিন্দুরখান', 'sindurkhanup . moulvibazar . gov . bd', 1, 290, NULL, NULL, NULL, NULL),
(2597, 'Kalapur', 'কালাপুর', 'kalapurup . moulvibazar . gov . bd', 1, 290, NULL, NULL, NULL, NULL),
(2598, 'Ashidron', 'আশিদ্রোন', 'ashidronup . moulvibazar . gov . bd', 1, 290, NULL, NULL, NULL, NULL),
(2599, 'Rajghat', 'রাজঘাট', 'rajghatup . moulvibazar . gov . bd', 1, 290, NULL, NULL, NULL, NULL),
(2600, 'Kalighat', 'কালীঘাট', 'kalighatup . moulvibazar . gov . bd', 1, 290, NULL, NULL, NULL, NULL),
(2601, 'Satgaon', 'সাতগাঁও', 'satgaonup . moulvibazar . gov . bd', 1, 290, NULL, NULL, NULL, NULL),
(2602, 'Jafornagar', 'জায়ফরনগর', 'jafornagarup . moulvibazar . gov . bd', 1, 291, NULL, NULL, NULL, NULL),
(2603, 'West Juri', 'পশ্চিম জুড়ী', 'westjuriup . moulvibazar . gov . bd', 1, 291, NULL, NULL, NULL, NULL),
(2604, 'Gualbari', 'গোয়ালবাড়ী', 'gualbariup . moulvibazar . gov . bd', 1, 291, NULL, NULL, NULL, NULL),
(2605, 'Sagornal', 'সাগরনাল', 'sagornalup . moulvibazar . gov . bd', 1, 291, NULL, NULL, NULL, NULL),
(2606, 'Fultola', 'ফুলতলা', 'fultolaup . moulvibazar . gov . bd', 1, 291, NULL, NULL, NULL, NULL),
(2607, 'Eastjuri', 'পুর্ব জুড়ী', 'eastjuriup . moulvibazar . gov . bd', 1, 291, NULL, NULL, NULL, NULL),
(2608, 'Barabhakoir Paschim', 'বড় ভাকৈর(পশ্চিম]', 'barabhakoirpaschimup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2609, 'Barabhakoir Purba', 'বড় ভাকৈর(পূর্ব]', 'barabhakoirpurbaup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2610, 'Inatganj', 'ইনাতগঞ্জ', 'inatganjup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2611, 'Digholbak', 'দীঘলবাক', 'digholbakup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2612, 'Aushkandi', 'আউশকান্দি', 'aushkandiup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2613, 'Kurshi', 'কুর্শি', 'kurshiup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2614, 'Kargoan', 'করগাঁও', 'kargoanup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2615, 'Nabiganj Sadar', 'নবীগঞ্জ সদর', 'nabiganjsadarup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2616, 'Bausha', 'বাউসা', 'baushaup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2617, 'Debparra', 'দেবপাড়া', 'debparraup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2618, 'Gaznaipur', 'গজনাইপুর', 'gaznaipurup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2619, 'Kaliarbhanga', 'কালিয়ারভাংগা', 'kaliarbhangaup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2620, 'Paniumda', 'পানিউমদা', 'paniumdaup . habiganj . gov . bd', 1, 292, NULL, NULL, NULL, NULL),
(2621, 'Snanghat', 'স্নানঘাট', 'snanghatup . habiganj . gov . bd', 1, 293, NULL, NULL, NULL, NULL),
(2622, 'Putijuri', 'পুটিজুরী', 'putijuriup . habiganj . gov . bd', 1, 293, NULL, NULL, NULL, NULL),
(2623, 'Satkapon', 'সাতকাপন', 'satkaponup . habiganj . gov . bd', 1, 293, NULL, NULL, NULL, NULL),
(2624, 'Bahubal Sadar', 'বাহুবল সদর', 'bahubalsadarup . habiganj . gov . bd', 1, 293, NULL, NULL, NULL, NULL),
(2625, 'Lamatashi', 'লামাতাশী', 'lamatashiup . habiganj . gov . bd', 1, 293, NULL, NULL, NULL, NULL),
(2626, 'Mirpur', 'মিরপুর', 'mirpurup . habiganj . gov . bd', 1, 293, NULL, NULL, NULL, NULL),
(2627, 'Bhadeshwar', 'ভাদেশ্বর', 'bhadeshwarup . habiganj . gov . bd', 1, 293, NULL, NULL, NULL, NULL),
(2628, 'Shibpasha', 'শিবপাশা', 'shibpashaup . habiganj . gov . bd', 1, 294, NULL, NULL, NULL, NULL),
(2629, 'Kakailsao', 'কাকাইলছেও', 'kakailsaoup . habiganj . gov . bd', 1, 294, NULL, NULL, NULL, NULL),
(2630, 'Ajmiriganj Sadar', 'আজমিরীগঞ্জ সদর', 'ajmiriganjsadarup . habiganj . gov . bd', 1, 294, NULL, NULL, NULL, NULL),
(2631, 'Badolpur', 'বদলপুর', 'badolpurup . habiganj . gov . bd', 1, 294, NULL, NULL, NULL, NULL),
(2632, 'Jolsuka', 'জলসুখা', 'jolsukaup . habiganj . gov . bd', 1, 294, NULL, NULL, NULL, NULL),
(2633, 'Baniachong North East', 'বানিয়াচং উত্তর পূর্ব', 'baniachongnortheastup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2634, 'Baniachong North West', 'বানিয়াচং উত্তর পশ্চিম', 'baniachongnorthwestup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2635, 'Baniachong South East', 'বানিয়াচং দক্ষিণ পূর্ব', 'baniachongsoutheastup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2636, 'Baniachong South West', 'বানিয়াচং দক্ষিণ পশ্চিম', 'baniachongsouthwestup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2637, 'Daulatpur', 'দৌলতপুর', 'daulatpur . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2638, 'Khagaura', 'খাগাউড়া', 'khagauraup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2639, 'Baraiuri', 'বড়ইউড়ি', 'baraiuriup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2640, 'Kagapasha', 'কাগাপাশা', 'kagapashaup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2641, 'Pukra', 'পুকড়া', 'pukraup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2642, 'Subidpur', 'সুবিদপুর', 'subidpurup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2643, 'Makrampur', 'মক্রমপুর', 'makrampurup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2644, 'Sujatpur', 'সুজাতপুর', 'sujatpurup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2645, 'Mandari', 'মন্দরী', 'mandariup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2646, 'Muradpur', 'মুরাদপুর', 'muradpurup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2647, 'Pailarkandi', 'পৈলারকান্দি', 'pailarkandiup . habiganj . gov . bd', 1, 295, NULL, NULL, NULL, NULL),
(2648, 'Lakhai', 'লাখাই', 'lakhaiup . habiganj . gov . bd', 1, 296, NULL, NULL, NULL, NULL),
(2649, 'Murakari', 'মোড়াকরি', 'murakariup . habiganj . gov . bd', 1, 296, NULL, NULL, NULL, NULL),
(2650, 'Muriauk', 'মুড়িয়াউক', 'muriaukup . habiganj . gov . bd', 1, 296, NULL, NULL, NULL, NULL),
(2651, 'Bamoi', 'বামৈ', 'bamoiup . habiganj . gov . bd', 1, 296, NULL, NULL, NULL, NULL),
(2652, 'Karab', 'করাব', 'karabup . habiganj . gov . bd', 1, 296, NULL, NULL, NULL, NULL),
(2653, 'Bulla', 'বুল্লা', 'bullaup6 . habiganj . gov . bd', 1, 296, NULL, NULL, NULL, NULL),
(2654, 'Gazipur', 'গাজীপুর', 'gazipurup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2655, 'Ahammadabad', 'আহম্মদাবাদ', 'ahammadabadup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2656, 'Deorgach', 'দেওরগাছ', 'deorgachup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2657, 'Paikpara', 'পাইকপাড়া', 'paikparaup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2658, 'Shankhala', 'শানখলা', 'shankhalaup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2659, 'Chunarughat', 'চুনারুঘাট', 'chunarughatup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2660, 'Ubahata', 'উবাহাটা', 'ubahataup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2661, 'Shatiajuri', 'সাটিয়াজুরী', 'shatiajuriup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2662, 'Ranigaon', 'রাণীগাঁও', 'ranigaonup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2663, 'Mirashi', 'মিরাশী', 'mirashiup . habiganj . gov . bd', 1, 297, NULL, NULL, NULL, NULL),
(2664, 'Lukra', 'লুকড়া', 'lukraup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2665, 'Richi', 'রিচি', 'richiup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2666, 'Teghoria', 'তেঘরিয়া', 'teghoriaup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2667, 'Poil', 'পইল', 'poilup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2668, 'Gopaya', 'গোপায়া', 'gopayaup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2669, 'Rajiura', 'রাজিউড়া', 'rajiuraup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2670, 'Nurpur', 'নুরপুর', 'nurpurup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2671, 'Shayestaganj', 'শায়েস্তাগঞ্জ', 'shayestaganjup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2672, 'Nijampur', 'নিজামপুর', 'nijampurup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2673, 'Laskerpur', 'লস্করপুর', 'laskerpurup . habiganj . gov . bd', 1, 298, NULL, NULL, NULL, NULL),
(2674, 'Dharmaghar', 'ধর্মঘর', 'dharmagharup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2675, 'Choumohani', 'চৌমুহনী', 'choumohaniup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2676, 'Bahara', 'বহরা', 'baharaup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2677, 'Adaoir', 'আদাঐর', 'adaoirup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2678, 'Andiura', 'আন্দিউড়া', 'andiuraup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2679, 'Shahjahanpur', 'শাহজাহানপুর', 'shahjahanpurup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2680, 'Jagadishpur', 'জগদীশপুর', 'jagadishpurup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2681, 'Bulla', 'বুল্লা', 'bullaup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2682, 'Noapara', 'নোয়াপাড়া', 'noaparaup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2683, 'Chhatiain', 'ছাতিয়াইন', 'chhatiainup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2684, 'Bagashura', 'বাঘাসুরা', 'bagashuraup . habiganj . gov . bd', 1, 299, NULL, NULL, NULL, NULL),
(2685, 'Jahangirnagar', 'জাহাঙ্গীরনগর', 'jahangirnagarup . sunamganj . gov . bd', 1, 300, NULL, NULL, NULL, NULL),
(2686, 'Rangarchar', 'রংগারচর', 'rangarcharup . sunamganj . gov . bd', 1, 300, NULL, NULL, NULL, NULL),
(2687, 'Aptabnagar', 'আপ্তাবনগর', 'aptabnagarup . sunamganj . gov . bd', 1, 300, NULL, NULL, NULL, NULL),
(2688, 'Gourarang', 'গৌরারং', 'gourarang . sunamganj . gov . bd', 1, 300, NULL, NULL, NULL, NULL),
(2689, 'Mollapara', 'মোল্লাপাড়া', 'mollaparaup . sunamganj . gov . bd', 1, 300, NULL, NULL, NULL, NULL),
(2690, 'Laxmansree', 'লক্ষণশ্রী', 'laxmansreeup . sunamganj . gov . bd', 1, 300, NULL, NULL, NULL, NULL),
(2691, 'Kathair', 'কাঠইর', 'kathairup . sunamganj . gov . bd', 1, 300, NULL, NULL, NULL, NULL),
(2692, 'Surma', 'সুরমা', 'surmaup . sunamganj . gov . bd', 1, 300, NULL, NULL, NULL, NULL),
(2693, 'Mohonpur', 'মোহনপুর', 'mohonpurup . sunamganj . gov . bd', 1, 300, NULL, NULL, NULL, NULL),
(2694, 'Shimulbak', 'শিমুলবাক', 'shimulbak . sunamganj . gov . bd', 1, 301, NULL, NULL, NULL, NULL),
(2695, 'Paschim Pagla', 'পশ্চিম পাগলা', 'paschimpagla . sunamganj . gov . bd', 1, 301, NULL, NULL, NULL, NULL),
(2696, 'Joykalash', 'জয়কলস', 'joykalashup . sunamganj . gov . bd', 1, 301, NULL, NULL, NULL, NULL),
(2697, 'Purba Pagla', 'পূর্ব পাগলা', 'purbapaglaup . sunamganj . gov . bd', 1, 301, NULL, NULL, NULL, NULL),
(2698, 'Patharia', 'পাথারিয়া', 'pathariaup . sunamganj . gov . bd', 1, 301, NULL, NULL, NULL, NULL),
(2699, 'Purba Birgaon', 'পূর্ব বীরগাঁও', 'purbabirgaonup . sunamganj . gov . bd', 1, 301, NULL, NULL, NULL, NULL),
(2700, 'Dargapasha', 'দরগাপাশা', 'dargapashaup . sunamganj . gov . bd', 1, 301, NULL, NULL, NULL, NULL),
(2701, 'Paschim Birgaon', 'পশ্চিম বীরগাঁও', 'paschimbirgaonup . sunamganj . gov . bd', 1, 301, NULL, NULL, NULL, NULL),
(2702, 'Palash', 'পলাশ', 'palashup . sunamganj . gov . bd', 1, 302, NULL, NULL, NULL, NULL),
(2703, 'Solukabad', 'সলুকাবাদ', 'solukabadup . sunamganj . gov . bd', 1, 302, NULL, NULL, NULL, NULL),
(2704, 'Dhanpur', 'ধনপুর', 'dhanpurup . sunamganj . gov . bd', 1, 302, NULL, NULL, NULL, NULL),
(2705, 'Badaghat South', 'বাদাঘাট দক্ষিণ', 'badaghatsouthup . sunamganj . gov . bd', 1, 302, NULL, NULL, NULL, NULL),
(2706, 'Fatepur', 'ফতেপুর', 'fatepurup . sunamganj . gov . bd', 1, 302, NULL, NULL, NULL, NULL),
(2707, 'Islampur', 'ইসলামপুর', 'islampurup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2708, 'Noarai', 'নোয়ারাই', 'noaraiup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2709, 'Chhatak Sadar', 'ছাতক সদর', 'chhataksadarup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2710, 'Kalaruka', 'কালারুকা', 'kalarukaup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2711, 'Gobindganj - Syedergaon', 'গোবিন্দগঞ্জ - সৈদেরগাঁও', 'gobindganjsyedergaonup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2712, 'Chhaila Afjalabad', 'ছৈলা আফজলাবাদ', 'chhailaafjalabadup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2713, 'Khurma North', 'খুরমা উত্তর', 'khurmanorthup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2714, 'Khurma South', 'খুরমা দক্ষিণ', 'khurmasouthup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2715, 'Chormohalla', 'চরমহল্লা', 'chormohallaup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2716, 'Jauwabazar', 'জাউয়া বাজার', 'jauwabazarup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2717, 'Singchapair', 'সিংচাপইড়', 'singchapairup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2718, 'Dolarbazar', 'দোলারবাজার', 'dolarbazarup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2719, 'Bhatgaon', 'ভাতগাঁও', 'bhatgaonup . sunamganj . gov . bd', 1, 303, NULL, NULL, NULL, NULL),
(2720, 'Kolkolia', 'কলকলিয়া', 'kolkoliaup . sunamganj . gov . bd', 1, 304, NULL, NULL, NULL, NULL),
(2721, 'Patli', 'পাটলী', 'patliup . sunamganj . gov . bd', 1, 304, NULL, NULL, NULL, NULL),
(2722, 'Mirpur', 'মীরপুর', 'mirpurup . sunamganj . gov . bd', 1, 304, NULL, NULL, NULL, NULL),
(2723, 'Chilaura Holdipur', 'চিলাউড়া হলদিপুর', 'chilauraholdipurup . sunamganj . gov . bd', 1, 304, NULL, NULL, NULL, NULL),
(2724, 'Raniganj', 'রানীগঞ্জ', 'raniganjup . sunamganj . gov . bd', 1, 304, NULL, NULL, NULL, NULL),
(2725, 'Syedpur Shaharpara', 'সৈয়দপুর শাহাড়পাড়া', 'syedpurshaharparaup . sunamganj . gov . bd', 1, 304, NULL, NULL, NULL, NULL),
(2726, 'Asharkandi', 'আশারকান্দি', 'asharkandiup . sunamganj . gov . bd', 1, 304, NULL, NULL, NULL, NULL),
(2727, 'Pailgaon', 'পাইলগাঁও', 'pailgaonup . sunamganj . gov . bd', 1, 304, NULL, NULL, NULL, NULL),
(2728, 'Banglabazar', 'বাংলাবাজার', 'banglabazarup . sunamganj . gov . bd', 1, 305, NULL, NULL, NULL, NULL),
(2729, 'Norsingpur', 'নরসিংহপুর', 'norsingpurup . sunamganj . gov . bd', 1, 305, NULL, NULL, NULL, NULL),
(2730, 'Dowarabazar', 'দোয়ারাবাজার', 'dowarabazarup . sunamganj . gov . bd', 1, 305, NULL, NULL, NULL, NULL),
(2731, 'Mannargaon', 'মান্নারগাঁও', 'mannargaonup . sunamganj . gov . bd', 1, 305, NULL, NULL, NULL, NULL),
(2732, 'Pandargaon', 'পান্ডারগাঁও', 'pandargaonup . sunamganj . gov . bd', 1, 305, NULL, NULL, NULL, NULL),
(2733, 'Dohalia', 'দোহালিয়া', 'dohaliaup . sunamganj . gov . bd', 1, 305, NULL, NULL, NULL, NULL),
(2734, 'Laxmipur', 'লক্ষীপুর', 'laxmipurup . sunamganj . gov . bd', 1, 305, NULL, NULL, NULL, NULL),
(2735, 'Boglabazar', 'বোগলাবাজার', 'boglabazarup . sunamganj . gov . bd', 1, 305, NULL, NULL, NULL, NULL),
(2736, 'Surma', 'সুরমা', 'surma2up . sunamganj . gov . bd', 1, 305, NULL, NULL, NULL, NULL),
(2737, 'Sreepur North', 'শ্রীপুর উত্তর', 'sreepurnorthup . sunamganj . gov . bd', 1, 306, NULL, NULL, NULL, NULL),
(2738, 'Sreepur South', 'শ্রীপুর দক্ষিণ', 'sreepursouthup . sunamganj . gov . bd', 1, 306, NULL, NULL, NULL, NULL),
(2739, 'Bordal South', 'বড়দল দক্ষিণ', 'bordalsouthup . sunamganj . gov . bd', 1, 306, NULL, NULL, NULL, NULL),
(2740, 'Bordal North', 'বড়দল উত্তর', 'bordalnorthup . sunamganj . gov . bd', 1, 306, NULL, NULL, NULL, NULL),
(2741, 'Badaghat', 'বাদাঘাট', 'badaghatup . sunamganj . gov . bd', 1, 306, NULL, NULL, NULL, NULL),
(2742, 'Tahirpur Sadar', 'তাহিরপুর সদর', 'tahirpursadarup . sunamganj . gov . bd', 1, 306, NULL, NULL, NULL, NULL),
(2743, 'Balijuri', 'বালিজুরী', 'balijuriup . sunamganj . gov . bd', 1, 306, NULL, NULL, NULL, NULL),
(2744, 'Bongshikunda North', 'বংশীকুন্ডা উত্তর', 'bongshikundanorthup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2745, 'Bongshikunda South', 'বংশীকুন্ডা দক্ষিণ', 'bongshikundasouthup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2746, 'Chamordani', 'চামরদানী', 'chamordaniup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2747, 'Madhyanagar', 'মধ্যনগর', 'madhyanagarup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2748, 'Paikurati', 'পাইকুরাটী', 'paikuratiup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2749, 'Selbarash', 'সেলবরষ', 'selbarashup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2750, 'Dharmapasha Sadar', 'ধর্মপাশা সদর', 'dharmapashasadarup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2751, 'Joyasree', 'জয়শ্রী', 'joyasreeup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2752, 'Sukhair Rajapur North', 'সুখাইড় রাজাপুর উত্তর', 'sukhairrajapurnorthup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2753, 'Sukhair Rajapur South', 'সুখাইড় রাজাপুর দক্ষিণ', 'sukhairrajapursouthup . sunamganj . gov . bd', 1, 307, NULL, NULL, NULL, NULL),
(2754, 'Beheli', 'বেহেলী', 'beheliup . sunamganj . gov . bd', 1, 308, NULL, NULL, NULL, NULL),
(2755, 'Sachnabazar', 'সাচনাবাজার', 'sachnabazarup . sunamganj . gov . bd', 1, 308, NULL, NULL, NULL, NULL),
(2756, 'Bhimkhali', 'ভীমখালী', 'bhimkhaliup . sunamganj . gov . bd', 1, 308, NULL, NULL, NULL, NULL),
(2757, 'Fenerbak', 'ফেনারবাক', 'fenerbakup . sunamganj . gov . bd', 1, 308, NULL, NULL, NULL, NULL),
(2758, 'Jamalganj Sadar', 'জামালগঞ্জ সদর', 'jamalganjsadarup . sunamganj . gov . bd', 1, 308, NULL, NULL, NULL, NULL),
(2759, 'Atgaon', 'আটগাঁও', 'atgaonup . sunamganj . gov . bd', 1, 309, NULL, NULL, NULL, NULL),
(2760, 'Habibpur', 'হবিবপুর', 'habibpurup . sunamganj . gov . bd', 1, 309, NULL, NULL, NULL, NULL),
(2761, 'Bahara', 'বাহারা', 'baharaup . sunamganj . gov . bd', 1, 309, NULL, NULL, NULL, NULL),
(2762, 'Shalla Sadar', 'শাল্লা সদর', 'shallasadarup . sunamganj . gov . bd', 1, 309, NULL, NULL, NULL, NULL),
(2763, 'Rafinagar', 'রফিনগর', 'rafinagarup . sunamganj . gov . bd', 1, 310, NULL, NULL, NULL, NULL),
(2764, 'Bhatipara', 'ভাটিপাড়া', 'bhatiparaup . sunamganj . gov . bd', 1, 310, NULL, NULL, NULL, NULL),
(2765, 'Rajanagar', 'রাজানগর', 'rajanagarup . sunamganj . gov . bd', 1, 310, NULL, NULL, NULL, NULL),
(2766, 'Charnarchar', 'চরনারচর', 'charnarcharup . sunamganj . gov . bd', 1, 310, NULL, NULL, NULL, NULL),
(2767, 'Derai Sarmangal', 'দিরাই সরমঙ্গল', 'deraisarmangalup . sunamganj . gov . bd', 1, 310, NULL, NULL, NULL, NULL),
(2768, 'Karimpur', 'করিমপুর', 'karimpurup . sunamganj . gov . bd', 1, 310, NULL, NULL, NULL, NULL),
(2769, 'Jagddol', 'জগদল', 'jagddolup . sunamganj . gov . bd', 1, 310, NULL, NULL, NULL, NULL),
(2770, 'Taral', 'তাড়ল', 'taralup . sunamganj . gov . bd', 1, 310, NULL, NULL, NULL, NULL),
(2771, 'Kulanj', 'কুলঞ্জ', 'kulanjup . sunamganj . gov . bd', 1, 310, NULL, NULL, NULL, NULL),
(2772, 'Amlaba', 'আমলাব', 'amlabaup . narsingdi . gov . bd', 1, 311, NULL, NULL, NULL, NULL),
(2773, 'Bajnaba', 'বাজনাব', 'bajnabaup . narsingdi . gov . bd', 1, 311, NULL, NULL, NULL, NULL),
(2774, 'Belabo', 'বেলাব', 'belaboup . narsingdi . gov . bd', 1, 311, NULL, NULL, NULL, NULL),
(2775, 'Binnabayd', 'বিন্নাবাইদ', 'binnabaydup . narsingdi . gov . bd', 1, 311, NULL, NULL, NULL, NULL),
(2776, 'Charuzilab', 'চরউজিলাব', 'charuzilabup . narsingdi . gov . bd', 1, 311, NULL, NULL, NULL, NULL),
(2777, 'Naraynpur', 'নারায়নপুর', 'naraynpurup . narsingdi . gov . bd', 1, 311, NULL, NULL, NULL, NULL),
(2778, 'Sallabad', 'সল্লাবাদ', 'sallabadup . narsingdi . gov . bd', 1, 311, NULL, NULL, NULL, NULL),
(2779, 'Patuli', 'পাটুলী', 'patuliup . narsingdi . gov . bd', 1, 311, NULL, NULL, NULL, NULL),
(2780, 'Diara', 'দেয়ারা মডেল', 'diaraup . narsingdi . gov . bd', 1, 311, NULL, NULL, NULL, NULL),
(2781, 'Barachapa', 'বড়চাপা', 'barachapaup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2782, 'Chalakchar', 'চালাকচর', 'chalakcharup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2783, 'Charmandalia', 'চরমান্দালিয়া', 'charmandaliaup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2784, 'Ekduaria', 'একদুয়ারিয়া', 'ekduariaup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2785, 'Gotashia', 'গোতাশিয়া', 'gotashiaup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2786, 'Kanchikata', 'কাচিকাটা', 'kanchikataup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2787, 'Khidirpur', 'খিদিরপুর', 'khidirpurup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2788, 'Shukundi', 'শুকুন্দি', 'shukundiup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2789, 'Dawlatpur', 'দৌলতপুর', 'dawlatpurup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2790, 'Krisnopur', 'কৃষ্ণপুর', 'krisnopurup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2791, 'Labutala', 'লেবুতলা', 'labutalaup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2792, 'Chandanbari', 'চন্দনবাড়ী', 'chandanbariup . narsingdi . gov . bd', 1, 312, NULL, NULL, NULL, NULL),
(2793, 'Alokbali', 'আলোকবালী', 'alokbaliup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2794, 'Chardighaldi', 'চরদিঘলদী', 'chardighaldiup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2795, 'Chinishpur', 'চিনিশপুর', 'chinishpurup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2796, 'Hajipur', 'হাজীপুর', 'hajipurup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2797, 'Karimpur', 'করিমপুর', 'karimpurup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2798, 'Khathalia', 'কাঠালিয়া', 'khathaliaup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2799, 'Nuralapur', 'নূরালাপুর', 'nuralapurup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2800, 'Mahishasura', 'মহিষাশুড়া', 'mahishasuraup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2801, 'Meherpara', 'মেহেড়পাড়া', 'meherparaup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2802, 'Nazarpur', 'নজরপুর', 'nazarpurup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2803, 'Paikarchar', 'পাইকারচর', 'paikarcharup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2804, 'Panchdona', 'পাঁচদোনা', 'panchdonaup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2805, 'Silmandi', 'শিলমান্দী', 'silmandiup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2806, 'Amdia', 'আমদিয়া ২', 'amdiaup . narsingdi . gov . bd', 1, 313, NULL, NULL, NULL, NULL),
(2807, 'Danga', 'ডাংঙ্গা', 'dangaup . narsingdi . gov . bd', 1, 314, NULL, NULL, NULL, NULL),
(2808, 'Charsindur', 'চরসিন্দুর', 'charsindurup . narsingdi . gov . bd', 1, 314, NULL, NULL, NULL, NULL),
(2809, 'Jinardi', 'জিনারদী', 'jinardiup . narsingdi . gov . bd', 1, 314, NULL, NULL, NULL, NULL),
(2810, 'Gazaria', 'গজারিয়া', 'gazariaup . narsingdi . gov . bd', 1, 314, NULL, NULL, NULL, NULL),
(2811, 'Chanpur', 'চানপুর', 'chanpurup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2812, 'Alipura', 'অলিপুরা', 'alipuraup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2813, 'Amirganj', 'আমিরগঞ্জ', 'amirganjup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2814, 'Adiabad', 'আদিয়াবাদ', 'adiabadup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2815, 'Banshgari', 'বাঁশগাড়ী', 'banshgariup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2816, 'Chanderkandi', 'চান্দেরকান্দি', 'chanderkandiup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2817, 'Chararalia', 'চরআড়ালিয়া', 'chararaliaup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2818, 'Charmadhua', 'চরমধুয়া', 'charmadhuaup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2819, 'Charsubuddi', 'চরসুবুদ্দি', 'charsubuddiup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2820, 'Daukarchar', 'ডৌকারচর', 'daukarcharup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2821, 'Hairmara', 'হাইরমারা', 'hairmaraup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2822, 'Maheshpur', 'মহেষপুর', 'maheshpurup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2823, 'Mirzanagar', 'মির্জানগর', 'mirzanagarup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2824, 'Mirzarchar', 'মির্জারচর', 'mirzarcharup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2825, 'Nilakhya', 'নিলক্ষ্যা', 'nilakhyaup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2826, 'Palashtali', 'পলাশতলী', 'palashtaliup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2827, 'Paratali', 'পাড়াতলী', 'parataliup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2828, 'Sreenagar', 'শ্রীনগর', 'sreenagarup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2829, 'Roypura', 'রায়পুরা', 'roypuraup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2830, 'Musapur', 'মুছাপুর', 'musapurup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2831, 'Uttar Bakharnagar', 'উত্তর বাখরনগর', 'uttarbakharnagarup . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2832, 'Marjal', 'মরজাল', 'marjal2up . narsingdi . gov . bd', 1, 315, NULL, NULL, NULL, NULL),
(2833, 'Dulalpur', 'দুলালপুর', 'dulalpurup . narsingdi . gov . bd', 1, 316, NULL, NULL, NULL, NULL),
(2834, 'Joynagar', 'জয়নগর', 'joynagarup . narsingdi . gov . bd', 1, 316, NULL, NULL, NULL, NULL),
(2835, 'Sadharchar', 'সাধারচর', 'sadharcharup . narsingdi . gov . bd', 1, 316, NULL, NULL, NULL, NULL),
(2836, 'Masimpur', 'মাছিমপুর', 'masimpurup . narsingdi . gov . bd', 1, 316, NULL, NULL, NULL, NULL),
(2837, 'Chakradha', 'চক্রধা', 'chakradhaup . narsingdi . gov . bd', 1, 316, NULL, NULL, NULL, NULL),
(2838, 'Joshar', 'যোশর', 'josharup . narsingdi . gov . bd', 1, 316, NULL, NULL, NULL, NULL),
(2839, 'Baghabo', 'বাঘাব', 'baghaboup . narsingdi . gov . bd', 1, 316, NULL, NULL, NULL, NULL),
(2840, 'Ayubpur', 'আয়ুবপুর', 'ayubpurup . narsingdi . gov . bd', 1, 316, NULL, NULL, NULL, NULL),
(2841, 'Putia', 'পুটিয়া', 'putiaup . narsingdi . gov . bd', 1, 316, NULL, NULL, NULL, NULL),
(2842, 'Bahadursadi', 'বাহাদুরশাদী', 'bahadursadi . gazipur . gov . bd', 1, 317, NULL, NULL, NULL, NULL),
(2843, 'Baktarpur', 'বক্তারপুর', 'baktarpur . gazipur . gov . bd', 1, 317, NULL, NULL, NULL, NULL),
(2844, 'Jamalpurnew', 'জামালপুর', 'jamalpurnew . gazipur . gov . bd', 1, 317, NULL, NULL, NULL, NULL),
(2845, 'Jangalia', 'জাঙ্গালিয়া', 'jangalia . gazipur . gov . bd', 1, 317, NULL, NULL, NULL, NULL),
(2846, 'Moktarpur', 'মোক্তারপুর', 'moktarpur . gazipur . gov . bd', 1, 317, NULL, NULL, NULL, NULL),
(2847, 'Nagari', 'নাগরী', 'nagari . gazipur . gov . bd', 1, 317, NULL, NULL, NULL, NULL),
(2848, 'Tumulia', 'তুমুলিয়া', 'tumulia . gazipur . gov . bd', 1, 317, NULL, NULL, NULL, NULL),
(2849, 'Atabaha', 'আটাবহ', 'atabahaup . gazipur . gov . bd', 1, 318, NULL, NULL, NULL, NULL),
(2850, 'Boali', 'বোয়ালী', 'boaliup . gazipur . gov . bd', 1, 318, NULL, NULL, NULL, NULL),
(2851, 'Chapair', 'চাপাইর', 'chapairup . gazipur . gov . bd', 1, 318, NULL, NULL, NULL, NULL),
(2852, 'Dhaliora', 'ঢালজোড়া', 'dhalioraup . gazipur . gov . bd', 1, 318, NULL, NULL, NULL, NULL),
(2853, 'Fulbaria', 'ফুলবাড়ীয়া', 'fulbariaup . gazipur . gov . bd', 1, 318, NULL, NULL, NULL, NULL),
(2854, 'Madhyapara', 'মধ্যপাড়া', 'madhyapara . gazipur . gov . bd', 1, 318, NULL, NULL, NULL, NULL),
(2855, 'Mouchak', 'মৌচাক', 'mouchakup . gazipur . gov . bd', 1, 318, NULL, NULL, NULL, NULL),
(2856, 'Sutrapur', 'সূত্রাপুর', 'sutrapurup . gazipur . gov . bd', 1, 318, NULL, NULL, NULL, NULL),
(2857, 'Srifaltali', 'শ্রীফলতলী', 'srifaltaliup . gazipur . gov . bd', 1, 318, NULL, NULL, NULL, NULL),
(2858, 'Barishaba', 'বারিষাব', 'barishabaup . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2859, 'Ghagotia', 'ঘাগটিয়া', 'ghagotiaup . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2860, 'Kapasia', 'কাপাসিয়া', 'kapasiaup . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2861, 'Chandpur', 'চাঁদপুর', 'chandpur . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2862, 'Targoan', 'তরগাঁও', 'targoan . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2863, 'Karihata', 'কড়িহাতা', 'karihata . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2864, 'Tokh', 'টোক', 'tokh . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2865, 'Sinhasree', 'সিংহশ্রী', 'sinhasree . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2866, 'Durgapur', 'দূর্গাপুর', 'durgapurup . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2867, 'Sonmania', 'সনমানিয়া', 'sonmaniaup . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2868, 'Rayed', 'রায়েদ', 'rayedup . gazipur . gov . bd', 1, 319, NULL, NULL, NULL, NULL),
(2869, 'Baria', 'বাড়ীয়া', 'bariaup . gazipur . gov . bd', 1, 320, NULL, NULL, NULL, NULL),
(2870, 'Basan', 'বাসন', 'basanup . gazipur . gov . bd', 1, 320, NULL, NULL, NULL, NULL),
(2871, 'Gachha', 'গাছা', 'gachhaup . gazipur . gov . bd', 1, 320, NULL, NULL, NULL, NULL),
(2872, 'Kashimpur', 'কাশিমপুর', 'kashimpurup . gazipur . gov . bd', 1, 320, NULL, NULL, NULL, NULL),
(2873, 'Kayaltia', 'কাউলতিয়া', 'kayaltiaup . gazipur . gov . bd', 1, 320, NULL, NULL, NULL, NULL),
(2874, 'Konabari', 'কোনাবাড়ী', 'konabariup . gazipur . gov . bd', 1, 320, NULL, NULL, NULL, NULL),
(2875, 'Mirzapur', 'মির্জাপুর', 'mirzapurup . gazipur . gov . bd', 1, 320, NULL, NULL, NULL, NULL),
(2876, 'Pubail', 'পূবাইল', 'pubailup . gazipur . gov . bd', 1, 320, NULL, NULL, NULL, NULL),
(2877, 'Barmi', 'বরমী', 'barmiup . gazipur . gov . bd', 1, 321, NULL, NULL, NULL, NULL),
(2878, 'Gazipur', 'গাজীপুর', 'gazipurup . gazipur . gov . bd', 1, 321, NULL, NULL, NULL, NULL),
(2879, 'Gosinga', 'গোসিংগা', 'gosingaup . gazipur . gov . bd', 1, 321, NULL, NULL, NULL, NULL),
(2880, 'Maona', 'মাওনা', 'maonaup . gazipur . gov . bd', 1, 321, NULL, NULL, NULL, NULL),
(2881, 'Kaoraid', 'কাওরাইদ', 'kaoraidup . gazipur . gov . bd', 1, 321, NULL, NULL, NULL, NULL),
(2882, 'Prahladpur', 'প্রহলাদপুর', 'prahladpurup . gazipur . gov . bd', 1, 321, NULL, NULL, NULL, NULL),
(2883, 'Rajabari', 'রাজাবাড়ী', 'rajabariup . gazipur . gov . bd', 1, 321, NULL, NULL, NULL, NULL),
(2884, 'Telihati', 'তেলিহাটী', 'telihatiup . gazipur . gov . bd', 1, 321, NULL, NULL, NULL, NULL),
(2885, 'Binodpur', 'বিনোদপুর', 'binodpurup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2886, 'Tulasar', 'তুলাসার', 'tulasarup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2887, 'Palong', 'পালং', 'palongup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2888, 'Domshar', 'ডোমসার', 'domsharup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2889, 'Rudrakar', 'রুদ্রকর', 'rudrakarup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2890, 'Angaria', 'আংগারিয়া', 'angariaup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2891, 'Chitolia', 'চিতলয়া', 'chitoliaup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2892, 'Mahmudpur', 'মাহমুদপুর', 'mahmudpurup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2893, 'Chikondi', 'চিকন্দি', 'chikondiup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2894, 'Chandrapur', 'চন্দ্রপুর', 'chandrapurup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2895, 'Shulpara', 'শৌলপাড়া', 'shulparaup . shariatpur . gov . bd', 1, 322, NULL, NULL, NULL, NULL),
(2896, 'Kedarpur', 'কেদারপুর', 'kedarpurup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2897, 'Dingamanik', 'ডিংগামানিক', 'dingamanikup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2898, 'Garishar', 'ঘড়িষার', 'garisharup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2899, 'Nowpara', 'নওপাড়া', 'nowparaup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2900, 'Moktererchar', 'মোত্তারেরচর', 'mokterercharup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2901, 'Charatra', 'চরআত্রা', 'charatraup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2902, 'Rajnagar', 'রাজনগর', 'rajnagarup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2903, 'Japsa', 'জপসা', 'japsaup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2904, 'Vojeshwar', 'ভোজেশ্বর', 'vojeshwarup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2905, 'Fategongpur', 'ফতেজংপুর', 'fategongpurup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2906, 'Bijari', 'বিঝারি', 'bijariup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2907, 'Vumkhara', 'ভূমখাড়া', 'vumkharaup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2908, 'Nashason', 'নশাসন', 'nashasonup . shariatpur . gov . bd', 1, 323, NULL, NULL, NULL, NULL),
(2909, 'Zajira Sadar', 'জাজিরা সদর', 'zajirasadarup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2910, 'Mulna', 'মূলনা', 'mulnaup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2911, 'Barokandi', 'বড়কান্দি', 'barokandiup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2912, 'Bilaspur', 'বিলাসপুর', 'bilaspurup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2913, 'Kundarchar', 'কুন্ডেরচর', 'kundarcharup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2914, 'Palerchar', 'পালেরচর', 'palercharup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2915, 'Purba Nawdoba', 'পুর্ব নাওডোবা', 'purbanawdobaup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2916, 'Nawdoba', 'নাওডোবা', 'nawdobaup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2917, 'Shenerchar', 'সেনেরচর', 'shenercharup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2918, 'Bknagar', 'বি . কে . নগর', 'bknagarup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2919, 'Barogopalpur', 'বড়গোপালপুর', 'barogopalpurup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2920, 'Jaynagor', 'জয়নগর', 'jaynagorup . shariatpur . gov . bd', 1, 324, NULL, NULL, NULL, NULL),
(2921, 'Nager Para', 'নাগের পাড়া', 'nagerparaup . shariatpur . gov . bd', 1, 325, NULL, NULL, NULL, NULL),
(2922, 'Alaolpur', 'আলাওলপুর', 'alaolpurup . shariatpur . gov . bd', 1, 325, NULL, NULL, NULL, NULL),
(2923, 'Kodalpur', 'কোদালপুর', 'kodalpurup . shariatpur . gov . bd', 1, 325, NULL, NULL, NULL, NULL),
(2924, 'Goshairhat', 'গোসাইরহাট', 'goshairhatup . shariatpur . gov . bd', 1, 325, NULL, NULL, NULL, NULL),
(2925, 'Edilpur', 'ইদিলপুর', 'edilpurup . shariatpur . gov . bd', 1, 325, NULL, NULL, NULL, NULL),
(2926, 'Nalmuri', 'নলমুড়ি', 'nalmuriup . shariatpur . gov . bd', 1, 325, NULL, NULL, NULL, NULL),
(2927, 'Samontasar', 'সামন্তসার', 'samontasarup . shariatpur . gov . bd', 1, 325, NULL, NULL, NULL, NULL),
(2928, 'Kuchipatti', 'কুচাইপট্টি', 'kuchipattiup . shariatpur . gov . bd', 1, 325, NULL, NULL, NULL, NULL),
(2929, 'Ramvadrapur', 'রামভদ্রপুর', 'ramvadrapurup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2930, 'Mahisar', 'মহিষার', 'mahisarup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2931, 'Saygaon', 'ছয়গাঁও', 'saygaonup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2932, 'Narayanpur', 'নারায়নপুর', 'narayanpurup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2933, 'D . M Khali', 'ডি . এম খালি', 'dmkhaliup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2934, 'Charkumaria', 'চরকুমারিয়া', 'charkumariaup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2935, 'Sakhipur', 'সখিপুর', 'sakhipurup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2936, 'Kachikata', 'কাচিকাঁটা', 'kachikataup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2937, 'North Tarabunia', 'উত্তর তারাবুনিয়া', 'northtarabuniaup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2938, 'Charvaga', 'চরভাগা', 'charvagaup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2939, 'Arsinagar', 'আরশিনগর', 'arsinagarup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2940, 'South Tarabunia', 'দক্ষিন তারাবুনিয়া', 'southtarabuniaup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2941, 'Charsensas', 'চরসেনসাস', 'charsensasup . shariatpur . gov . bd', 1, 326, NULL, NULL, NULL, NULL),
(2942, 'Shidulkura', 'শিধলকুড়া', 'shidulkuraup . shariatpur . gov . bd', 1, 327, NULL, NULL, NULL, NULL),
(2943, 'Kaneshar', 'কনেস্বর', 'kanesharup . shariatpur . gov . bd', 1, 327, NULL, NULL, NULL, NULL),
(2944, 'Purba Damudya', 'পুর্ব ডামুড্যা', 'purbadamudyaup . shariatpur . gov . bd', 1, 327, NULL, NULL, NULL, NULL),
(2945, 'Islampur', 'ইসলামপুর', 'islampurup . shariatpur . gov . bd', 1, 327, NULL, NULL, NULL, NULL),
(2946, 'Dankati', 'ধানকাটি', 'dankatiup . shariatpur . gov . bd', 1, 327, NULL, NULL, NULL, NULL),
(2947, 'Sidya', 'সিড্যা', 'sidyaup . shariatpur . gov . bd', 1, 327, NULL, NULL, NULL, NULL),
(2948, 'Darulaman', 'দারুল আমান', 'darulamanup . shariatpur . gov . bd', 1, 327, NULL, NULL, NULL, NULL),
(2949, 'Satgram', 'সাতগ্রাম', 'satgramup . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2950, 'Duptara', 'দুপ্তারা', 'duptaraup . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2951, 'Brahammandi', 'ব্রা‏হ্মন্দী', 'brahammandiup . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2952, 'Fatepur', 'ফতেপুর', 'fatepurup . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2953, 'Bishnandi', 'বিশনন্দী', 'bishnandiup . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2954, 'Mahmudpur', 'মাহমুদপুর', 'mahmudpurup . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2955, 'Highjadi', 'হাইজাদী', 'highjadiup . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2956, 'Uchitpura', 'উচিৎপুরা', 'uchitpuraup . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2957, 'Kalapaharia', 'কালাপাহাড়িয়া', 'kalapahariaup . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2958, 'Kagkanda', 'খাগকান্দা', 'kagkandaUP . narayanganj . gov . bd', 1, 328, NULL, NULL, NULL, NULL),
(2959, 'Musapur', 'মুছাপুর', 'musapurup . narayanganj . gov . bd', 1, 329, NULL, NULL, NULL, NULL),
(2960, 'Modonpur', 'মদনপুর', 'modonpurup . narayanganj . gov . bd', 1, 329, NULL, NULL, NULL, NULL),
(2961, 'Bandar', 'বন্দর', 'bandarup . narayanganj . gov . bd', 1, 329, NULL, NULL, NULL, NULL),
(2962, 'Dhamgar', 'ধামগর', 'dhamgar . narayanganj . gov . bd', 1, 329, NULL, NULL, NULL, NULL),
(2963, 'Kolagathia', ' কলাগাছিয়া', 'kolagathiaup . narayanganj . gov . bd', 1, 329, NULL, NULL, NULL, NULL),
(2964, 'Alirtek', 'আলিরটেক', 'alirtekup . narayanganj . gov . bd', 1, 330, NULL, NULL, NULL, NULL),
(2965, 'Kashipur', 'কাশীপুর', 'kashipurup . narayanganj . gov . bd', 1, 330, NULL, NULL, NULL, NULL),
(2966, 'Kutubpur', 'কুতুবপুর', 'kutubpurup . narayanganj . gov . bd', 1, 330, NULL, NULL, NULL, NULL),
(2967, 'Gognagar', 'গোগনগর', 'gognagarup . narayanganj . gov . bd', 1, 330, NULL, NULL, NULL, NULL),
(2968, 'Baktaboli', 'বক্তাবলী', 'baktaboliup . narayanganj . gov . bd', 1, 330, NULL, NULL, NULL, NULL),
(2969, 'Enayetnagor', 'এনায়েত নগর', 'enayetnagorup . narayanganj . gov . bd', 1, 330, NULL, NULL, NULL, NULL),
(2970, 'Murapara', 'মুড়াপাড়া', 'muraparaup . narayanganj . gov . bd', 1, 331, NULL, NULL, NULL, NULL),
(2971, 'Bhulta', 'ভূলতা', 'bhultaup . narayanganj . gov . bd', 1, 331, NULL, NULL, NULL, NULL),
(2972, 'Golakandail', 'গোলাকান্দাইল', 'golakandailup . narayanganj . gov . bd', 1, 331, NULL, NULL, NULL, NULL),
(2973, 'Daudpur', 'দাউদপুর', 'daudpurup . narayanganj . gov . bd', 1, 331, NULL, NULL, NULL, NULL),
(2974, 'Rupganj', 'রূপগঞ্জ', 'rupganjup . narayanganj . gov . bd', 1, 331, NULL, NULL, NULL, NULL),
(2975, 'Kayetpara', 'কায়েতপাড়া', 'kayetparaup . narayanganj . gov . bd', 1, 331, NULL, NULL, NULL, NULL),
(2976, 'Bholobo', 'ভোলাব', 'bholoboup . narayanganj . gov . bd', 1, 331, NULL, NULL, NULL, NULL),
(2977, 'Pirojpur', 'পিরোজপুর', 'pirojpurup . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2978, 'Shambhupura', 'শম্ভুপুরা', 'shambhupura . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2979, 'Mograpara', 'মোগরাপাড়া', 'mograpara . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2980, 'Baidyerbazar', 'বৈদ্যেরবাজার', 'baidyerbazar . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2981, 'Baradi', 'বারদী', 'baradiup . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2982, 'Noagaon', 'নোয়াগাঁও', 'noagaonup . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2983, 'Jampur', 'জামপুর', 'jampurup . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2984, 'Sadipur', 'সাদীপুর', 'sadipurup . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2985, 'Sonmandi', 'সনমান্দি', 'sonmandiup . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2986, 'Kanchpur', 'কাচপুর', 'kanchpurup . narayanganj . gov . bd', 1, 332, NULL, NULL, NULL, NULL),
(2987, 'Basail', 'বাসাইল', 'basailup . tangail . gov . bd', 1, 333, NULL, NULL, NULL, NULL),
(2988, 'Kanchanpur', 'কাঞ্চনপুর', 'kanchanpurup . tangail . gov . bd', 1, 333, NULL, NULL, NULL, NULL),
(2989, 'Habla', 'হাবলা', 'hablaup . tangail . gov . bd', 1, 333, NULL, NULL, NULL, NULL),
(2990, 'Kashil', 'কাশিল', 'kashilup . tangail . gov . bd', 1, 333, NULL, NULL, NULL, NULL),
(2991, 'Fulki', 'ফুলকি', 'fulkiup . tangail . gov . bd', 1, 333, NULL, NULL, NULL, NULL),
(2992, 'Kauljani', 'কাউলজানী', 'kauljaniup . tangail . gov . bd', 1, 333, NULL, NULL, NULL, NULL),
(2993, 'Arjuna', 'অর্জুনা', 'arjunaup . tangail . gov . bd', 1, 334, NULL, NULL, NULL, NULL),
(2994, 'Gabshara', 'গাবসারা', 'gabsharaup . tangail . gov . bd', 1, 334, NULL, NULL, NULL, NULL),
(2995, 'Falda', 'ফলদা', 'faldaup . tangail . gov . bd', 1, 334, NULL, NULL, NULL, NULL),
(2996, 'Gobindashi', 'গোবিন্দাসী', 'gobindashiup . tangail . gov . bd', 1, 334, NULL, NULL, NULL, NULL),
(2997, 'Aloa', 'আলোয়া', 'aloaup . tangail . gov . bd', 1, 334, NULL, NULL, NULL, NULL),
(2998, 'Nikrail', 'নিকরাইল', 'nikrailup . tangail . gov . bd', 1, 334, NULL, NULL, NULL, NULL),
(2999, 'Deuli', 'দেউলী', 'deuliup . tangail . gov . bd', 1, 335, NULL, NULL, NULL, NULL),
(3000, 'Lauhati', 'লাউহাটি', 'lauhatiup . tangail . gov . bd', 1, 335, NULL, NULL, NULL, NULL),
(3001, 'Patharail', 'পাথরাইল', 'patharailup . tangail . gov . bd', 1, 335, NULL, NULL, NULL, NULL),
(3002, 'Delduar', 'দেলদুয়ার', 'delduarup . tangail . gov . bd', 1, 335, NULL, NULL, NULL, NULL),
(3003, 'Fazilhati', 'ফাজিলহাটি', 'fazilhatiup . tangail . gov . bd', 1, 335, NULL, NULL, NULL, NULL),
(3004, 'Elasin', 'এলাসিন', 'elasinup . tangail . gov . bd', 1, 335, NULL, NULL, NULL, NULL),
(3005, 'Atia', 'আটিয়া', 'atiaup . tangail . gov . bd', 1, 335, NULL, NULL, NULL, NULL);
INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(3006, 'Dubail', 'ডুবাইল', 'dubailup . tangail . gov . bd', 1, 335, NULL, NULL, NULL, NULL),
(3007, 'Deulabari', 'দেউলাবাড়ী', 'deulabariup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3008, 'Ghatail', 'ঘাটাইল', 'ghatailup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3009, 'Jamuria', 'জামুরিয়া', 'jamuriaup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3010, 'Lokerpara', 'লোকেরপাড়া', 'lokerparaup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3011, 'Anehola', 'আনেহলা', 'aneholaup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3012, 'Dighalkandia', 'দিঘলকান্দি', 'dighalkandiaup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3013, 'Digar', 'দিগড়', 'digarup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3014, 'Deopara', 'দেওপাড়া', 'deoparaup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3015, 'Sandhanpur', 'সন্ধানপুর', 'sandhanpurup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3016, 'Rasulpur', 'রসুলপুর', 'rasulpurup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3017, 'Dhalapara', 'ধলাপাড়া', 'dhalaparaup . tangail . gov . bd', 1, 336, NULL, NULL, NULL, NULL),
(3018, 'Hadera', 'হাদিরা', 'haderaup . tangail . gov . bd', 1, 337, NULL, NULL, NULL, NULL),
(3019, 'Jhawail', 'ঝাওয়াইল', 'jhawailup . tangail . gov . bd', 1, 337, NULL, NULL, NULL, NULL),
(3020, 'Nagdashimla', 'নগদাশিমলা', 'nagdashimlaup . tangail . gov . bd', 1, 337, NULL, NULL, NULL, NULL),
(3021, 'Dhopakandi', 'ধোপাকান্দি', 'dhopakandiup . tangail . gov . bd', 1, 337, NULL, NULL, NULL, NULL),
(3022, 'Alamnagor', 'আলমনগর', 'alamnagorup . tangail . gov . bd', 1, 337, NULL, NULL, NULL, NULL),
(3023, 'Hemnagor', 'হেমনগর', 'hemnagorup . tangail . gov . bd', 1, 337, NULL, NULL, NULL, NULL),
(3024, 'Mirzapur', 'মির্জাপুর', 'mirzapurup . tangail . gov . bd', 1, 337, NULL, NULL, NULL, NULL),
(3025, 'Alokdia', 'আলোকদিয়া', 'alokdiaup . tangail . gov . bd', 1, 338, NULL, NULL, NULL, NULL),
(3026, 'Aushnara', 'আউশনারা', 'aushnaraup . tangail . gov . bd', 1, 338, NULL, NULL, NULL, NULL),
(3027, 'Aronkhola', 'অরণখোলা', 'aronkholaup . tangail . gov . bd', 1, 338, NULL, NULL, NULL, NULL),
(3028, 'Sholakuri', 'শোলাকুড়ি', 'sholakuriup . tangail . gov . bd', 1, 338, NULL, NULL, NULL, NULL),
(3029, 'Golabari', 'গোলাবাড়ী', 'golabariup . tangail . gov . bd', 1, 338, NULL, NULL, NULL, NULL),
(3030, 'Mirjabari', 'মির্জাবাড়ী', 'mirjabariup . tangail . gov . bd', 1, 338, NULL, NULL, NULL, NULL),
(3031, 'Mahera', 'মহেড়া', 'maheraup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3032, 'Jamurki', 'জামুর্কী', 'jamurkiup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3033, 'Fatepur', 'ফতেপুর', 'fatepurup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3034, 'Banail', 'বানাইল', 'banailup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3035, 'Anaitara', 'আনাইতারা', 'anaitaraup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3036, 'Warshi', 'ওয়ার্শী', 'warshiup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3037, 'Bhatram', 'ভাতগ্রাম', 'bhatramup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3038, 'Bahuria', 'বহুরিয়া', 'bahuriaup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3039, 'Gorai', 'গোড়াই', 'goraiup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3040, 'Ajgana', 'আজগানা', 'ajganaup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3041, 'Tarafpur', 'তরফপুর', 'tarafpurup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3042, 'Bastail', 'বাঁশতৈল', 'bastailup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3043, 'Baora', 'ভাওড়া', 'baoraup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3044, 'Latifpur', 'লতিফপুর', 'latifpurup . tangail . gov . bd', 1, 339, NULL, NULL, NULL, NULL),
(3045, 'Bharra', 'ভারড়া', 'bharraup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3046, 'Sahabathpur', 'সহবতপুর', 'sahabathpurup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3047, 'Goyhata', 'গয়হাটা', 'goyhataup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3048, 'Solimabad', 'সলিমাবাদ', 'solimabadup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3049, 'Nagorpur', 'নাগরপুর', 'nagorpurup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3050, 'Mamudnagor', 'মামুদনগর', 'mamudnagorup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3051, 'Mokna', 'মোকনা', 'moknaup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3052, 'Pakutia', 'পাকুটিয়া', 'pakutiaup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3053, 'Bekrah Atgram', 'বেকরা আটগ্রাম', 'bekrahatgramup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3054, 'Dhuburia', 'ধুবড়িয়া', 'dhuburiaup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3055, 'Bhadra', 'ভাদ্রা', 'bhadraup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3056, 'Doptior', 'দপ্তিয়র', 'doptiorup . tangail . gov . bd', 1, 340, NULL, NULL, NULL, NULL),
(3057, 'Kakrajan', 'কাকড়াজান', 'kakrajanup . tangail . gov . bd', 1, 341, NULL, NULL, NULL, NULL),
(3058, 'Gajaria', 'গজারিয়া', 'gajariaup . tangail . gov . bd', 1, 341, NULL, NULL, NULL, NULL),
(3059, 'Jaduppur', 'যাদবপুর', 'jaduppurup . tangail . gov . bd', 1, 341, NULL, NULL, NULL, NULL),
(3060, 'Hatibandha', 'হাতীবান্ধা', 'hatibandhaup . tangail . gov . bd', 1, 341, NULL, NULL, NULL, NULL),
(3061, 'Kalia', 'কালিয়া', 'kaliaup . tangail . gov . bd', 1, 341, NULL, NULL, NULL, NULL),
(3062, 'Dariapur', 'দরিয়াপুর', 'dariapurup . tangail . gov . bd', 1, 341, NULL, NULL, NULL, NULL),
(3063, 'Kalmegha', 'কালমেঘা', 'kalmeghaup . tangail . gov . bd', 1, 341, NULL, NULL, NULL, NULL),
(3064, 'Baharatoil', 'বহেড়াতৈল', 'baharatoilup . tangail . gov . bd', 1, 341, NULL, NULL, NULL, NULL),
(3065, 'Mogra', 'মগড়া', 'mograup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3066, 'Gala', 'গালা', 'galaup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3067, 'Gharinda', 'ঘারিন্দা', 'gharindaup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3068, 'Karatia', 'করটিয়া', 'karatiaup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3069, 'Silimpur', 'ছিলিমপুর', 'silimpurup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3070, 'Porabari', 'পোড়াবাড়ী', 'porabariup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3071, 'Dyenna', 'দাইন্যা', 'dyennaup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3072, 'Baghil', 'বাঘিল', 'baghilup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3073, 'Kakua', 'কাকুয়া', 'kakuaup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3074, 'Hugra', 'হুগড়া', 'hugraup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3075, 'Katuli', 'কাতুলী', 'katuliup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3076, 'Mahamudnagar', 'মাহমুদনগর', 'mahamudnagarup . tangail . gov . bd', 1, 342, NULL, NULL, NULL, NULL),
(3077, 'Durgapur', 'দুর্গাপুর', 'durgapurup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3078, 'Birbashinda', 'বীরবাসিন্দা', 'birbashindaup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3079, 'Narandia', 'নারান্দিয়া', 'narandiaup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3080, 'Shahadebpur', 'সহদেবপুর', 'shahadebpurup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3081, 'Kokdahara', 'কোকডহরা', 'kokdaharaup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3082, 'Balla', 'বল্লা', 'ballaup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3083, 'Salla', 'সল্লা', 'sallaup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3084, 'Nagbari', 'নাগবাড়ী', 'nagbariup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3085, 'Bangra', 'বাংড়া', 'bangraup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3086, 'Paikora', 'পাইকড়া', 'paikoraup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3087, 'Dashokia', 'দশকিয়া', 'dashokiaup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3088, 'Parkhi', 'পারখী', 'parkhiup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3089, 'Gohaliabari', 'গোহালিয়াবাড়ী', 'gohaliabariup . tangail . gov . bd', 1, 343, NULL, NULL, NULL, NULL),
(3090, 'Dhopakhali', 'ধোপাখালী', 'dhopakhaliup . tangail . gov . bd', 1, 344, NULL, NULL, NULL, NULL),
(3091, 'Paiska', 'পাইস্কা', 'paiskaup . tangail . gov . bd', 1, 344, NULL, NULL, NULL, NULL),
(3092, 'Mushuddi', 'মুশুদ্দি', 'mushuddiup . tangail . gov . bd', 1, 344, NULL, NULL, NULL, NULL),
(3093, 'Bolibodrow', 'বলিভদ্র', 'bolibodrowup . tangail . gov . bd', 1, 344, NULL, NULL, NULL, NULL),
(3094, 'Birtara', 'বীরতারা', 'birtaraup . tangail . gov . bd', 1, 344, NULL, NULL, NULL, NULL),
(3095, 'Baniajan', 'বানিয়াজান', 'baniajanup . tangail . gov . bd', 1, 344, NULL, NULL, NULL, NULL),
(3096, 'Jadunathpur', 'যদুনাথপুর', 'jadunathpurup . tangail . gov . bd', 1, 344, NULL, NULL, NULL, NULL),
(3097, 'Chawganga', 'চৌগাংগা', 'chawgangaup . kishoreganj . gov . bd      ', 1, 345, NULL, NULL, NULL, NULL),
(3098, 'Joysiddi', 'জয়সিদ্ধি', 'joysiddiup . kishoreganj . gov . bd', 1, 345, NULL, NULL, NULL, NULL),
(3099, 'Alonjori', 'এলংজুরী', 'alonjoriup . kishoreganj . gov . bd', 1, 345, NULL, NULL, NULL, NULL),
(3100, 'Badla', 'বাদলা', 'badlaup . kishoreganj . gov . bd', 1, 345, NULL, NULL, NULL, NULL),
(3101, 'Boribari', 'বড়িবাড়ি', 'boribariup . kishoreganj . gov . bd', 1, 345, NULL, NULL, NULL, NULL),
(3102, 'Itna', 'ইটনা', 'itnaup . kishoreganj . gov . bd', 1, 345, NULL, NULL, NULL, NULL),
(3103, 'Mriga', 'মৃগা', 'mrigaup . kishoreganj . gov . bd', 1, 345, NULL, NULL, NULL, NULL),
(3104, 'Dhonpur', 'ধনপুর', 'dhonpurup . kishoreganj . gov . bd', 1, 345, NULL, NULL, NULL, NULL),
(3105, 'Raytoti', 'রায়টুটি', 'raytotiup . kishoreganj . gov . bd', 1, 345, NULL, NULL, NULL, NULL),
(3106, 'Banagram', 'বনগ্রাম', 'banagramup . kishoreganj . gov . bd', 1, 346, NULL, NULL, NULL, NULL),
(3107, 'Shahasram Dhuldia', 'সহশ্রাম ধুলদিয়া', 'shahasramdhuldiaup . kishoreganj . gov . bd', 1, 346, NULL, NULL, NULL, NULL),
(3108, 'Kargaon', 'কারগাঁও', 'kargaonup . kishoreganj . gov . bd', 1, 346, NULL, NULL, NULL, NULL),
(3109, 'Chandpur', 'চান্দপুর', 'chandpurup . kishoreganj . gov . bd', 1, 346, NULL, NULL, NULL, NULL),
(3110, 'Mumurdia', 'মুমুরদিয়া', 'mumurdiaup . kishoreganj . gov . bd', 1, 346, NULL, NULL, NULL, NULL),
(3111, 'Acmita', 'আচমিতা', 'acmitaup . kishoreganj . gov . bd', 1, 346, NULL, NULL, NULL, NULL),
(3112, 'Mosua', 'মসূয়া', 'mosuaup . kishoreganj . gov . bd', 1, 346, NULL, NULL, NULL, NULL),
(3113, 'Lohajuree', 'লোহাজুরী', 'lohajureeup . kishoreganj . gov . bd', 1, 346, NULL, NULL, NULL, NULL),
(3114, 'Jalalpur', 'জালালপুর', 'jalalpurup . kishoreganj . gov . bd', 1, 346, NULL, NULL, NULL, NULL),
(3115, 'Sadekpur', 'সাদেকপুর', 'sadekpurup . kishoreganj . gov . bd', 1, 347, NULL, NULL, NULL, NULL),
(3116, 'Aganagar', 'আগানগর', 'aganagarup . kishoreganj . gov . bd', 1, 347, NULL, NULL, NULL, NULL),
(3117, 'Shimulkandi', 'শিমুলকান্দি', 'shimulkandiup . kishoreganj . gov . bd', 1, 347, NULL, NULL, NULL, NULL),
(3118, 'Gajaria', 'গজারিয়া', 'gajariaup . kishoreganj . gov . bd', 1, 347, NULL, NULL, NULL, NULL),
(3119, 'Kalika Prashad', 'কালিকা প্রসাদ', 'kalikaprashadup . kishoreganj . gov . bd', 1, 347, NULL, NULL, NULL, NULL),
(3120, 'Sreenagar', 'শ্রীনগর', 'sreenagarup . kishoreganj . gov . bd', 1, 347, NULL, NULL, NULL, NULL),
(3121, 'Shibpur', 'শিবপুর', 'shibpurup . kishoreganj . gov . bd', 1, 347, NULL, NULL, NULL, NULL),
(3122, 'Taljanga', 'তালজাঙ্গা', 'taljangaup . kishoreganj . gov . bd', 1, 348, NULL, NULL, NULL, NULL),
(3123, 'Rauti', 'রাউতি', 'rautiup . kishoreganj . gov . bd', 1, 348, NULL, NULL, NULL, NULL),
(3124, 'Dhola', 'ধলা', 'dholaup . kishoreganj . gov . bd', 1, 348, NULL, NULL, NULL, NULL),
(3125, 'Jawar', 'জাওয়ার', 'jawarup . kishoreganj . gov . bd', 1, 348, NULL, NULL, NULL, NULL),
(3126, 'Damiha', 'দামিহা', 'damihaup . kishoreganj . gov . bd', 1, 348, NULL, NULL, NULL, NULL),
(3127, 'Digdair', 'দিগদাইর', 'digdairup . kishoreganj . gov . bd', 1, 348, NULL, NULL, NULL, NULL),
(3128, 'Tarail - Sachail', 'তাড়াইল - সাচাইল', 'tarailsachailup . kishoreganj . gov . bd', 1, 348, NULL, NULL, NULL, NULL),
(3129, 'Jinari', 'জিনারী', 'jinariup . kishoreganj . gov . bd', 1, 349, NULL, NULL, NULL, NULL),
(3130, 'Gobindapur', 'গোবিন্দপুর', 'gobindapurup . kishoreganj . gov . bd', 1, 349, NULL, NULL, NULL, NULL),
(3131, 'Sidhla', 'সিদলা', 'sidhlaup . kishoreganj . gov . bd', 1, 349, NULL, NULL, NULL, NULL),
(3132, 'Araibaria', 'আড়াইবাড়িয়া', 'araibariaup . kishoreganj . gov . bd', 1, 349, NULL, NULL, NULL, NULL),
(3133, 'Sahedal', 'সাহেদল', 'sahedalup . kishoreganj . gov . bd', 1, 349, NULL, NULL, NULL, NULL),
(3134, 'Pumdi', 'পুমদি', 'pumdiup . kishoreganj . gov . bd', 1, 349, NULL, NULL, NULL, NULL),
(3135, 'Jangalia', 'জাঙ্গালিয়া', 'jangaliaup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3136, 'Hosendi', 'হোসেনদি', 'hosendiup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3137, 'Narandi', 'নারান্দি', 'narandiup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3138, 'Shukhia', 'সুখিয়া', 'shukhiaup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3139, 'Patuavabga', 'পটুয়াভাঙ্গা', 'patuavabgaup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3140, 'Chandipasha', 'চান্দিপাশা', 'chandipashaup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3141, 'Charfaradi', 'চারফারাদি', 'charfaradiup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3142, 'Burudia', 'বুড়ুদিয়া', 'burudiaup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3143, 'Egarasindur', 'ইজারাসিন্দুর', 'egarasindurup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3144, 'Pakundia', 'পাকন্দিয়া', 'pakundiaup . kishoreganj . gov . bd', 1, 350, NULL, NULL, NULL, NULL),
(3145, 'Ramdi', 'রামদী', 'ramdiup . kishoreganj . gov . bd', 1, 351, NULL, NULL, NULL, NULL),
(3146, 'Osmanpur', 'উছমানপুর', 'osmanpurup . kishoreganj . gov . bd', 1, 351, NULL, NULL, NULL, NULL),
(3147, 'Chhaysuti', 'ছয়সূতী', 'chhaysutiup . kishoreganj . gov . bd', 1, 351, NULL, NULL, NULL, NULL),
(3148, 'Salua', 'সালুয়া', 'saluaup . kishoreganj . gov . bd', 1, 351, NULL, NULL, NULL, NULL),
(3149, 'Gobaria Abdullahpur', 'গোবরিয়া আব্দুল্লাহপুর', 'gobariaabdullahpurup . kishoreganj . gov . bd', 1, 351, NULL, NULL, NULL, NULL),
(3150, 'Faridpur', 'ফরিদপুর', 'faridpurup . kishoreganj . gov . bd', 1, 351, NULL, NULL, NULL, NULL),
(3151, 'Rashidabad', 'রশিদাবাদ', 'rashidabadup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3152, 'Latibabad', 'লতিবাবাদ', 'latibabadup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3153, 'Maizkhapan', 'মাইজখাপন', 'maizkhapanup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3154, 'Mohinanda', 'মহিনন্দ', 'mohinandaup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3155, 'Joshodal', 'যশোদল', 'joshodalup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3156, 'Bowlai', 'বৌলাই', 'bowlaiup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3157, 'Binnati', 'বিন্নাটি', 'binnatiup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3158, 'Maria', 'মারিয়া', 'mariaup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3159, 'Chowddoshata', 'চৌদ্দশত', 'chowddoshataup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3160, 'Karshakarial', 'কর্শাকড়িয়াইল', 'karshakarialup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3161, 'Danapatuli', 'দানাপাটুলী', 'danapatuliup . kishoreganj . gov . bd', 1, 352, NULL, NULL, NULL, NULL),
(3162, 'Kadirjangal', 'কাদিরজঙ্গল', 'kadirjangalup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3163, 'Gujadia', 'গুজাদিয়া', 'gujadiaup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3164, 'Kiraton', 'কিরাটন', 'kiratonup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3165, 'Barogharia', 'বারঘড়িয়া', 'baroghariaup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3166, 'Niamatpur', 'নিয়ামতপুর', 'niamatpurup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3167, 'Dehunda', 'দেহুন্দা', 'dehundaup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3168, 'Sutarpara', 'সুতারপাড়া', 'sutarparaup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3169, 'Gunodhar', 'গুনধর', 'gunodharup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3170, 'Joyka', 'জয়কা', 'joykaup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3171, 'Zafrabad', 'জাফরাবাদ', 'zafrabadup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3172, 'Noabad', 'নোয়াবাদ', 'noabadup . kishoreganj . gov . bd', 1, 353, NULL, NULL, NULL, NULL),
(3173, 'Kailag', 'কৈলাগ', 'kailagup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3174, 'Pirijpur', 'পিরিজপুর', 'pirijpurup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3175, 'Gazirchar', 'গাজীরচর', 'gazircharup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3176, 'Hilochia', 'হিলচিয়া', 'hilochiaup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3177, 'Maijchar9', 'মাইজচর', 'maijchar9up . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3178, 'Homypur', 'হুমাইপর', 'homypurup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3179, 'Halimpur', 'হালিমপুর', 'halimpurup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3180, 'Sararchar', 'সরারচর', 'sararcharup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3181, 'Dilalpur', 'দিলালপুর', 'dilalpurup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3182, 'Dighirpar', 'দিঘীরপাড়', 'dighirparup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3183, 'Boliardi', 'বলিয়ার্দী', 'boliardiup . kishoreganj . gov . bd', 1, 354, NULL, NULL, NULL, NULL),
(3184, 'Dewghar', 'দেওঘর', 'dewgharup . kishoreganj . gov . bd', 1, 355, NULL, NULL, NULL, NULL),
(3185, 'Kastul', 'কাস্তুল', 'kastulup . kishoreganj . gov . bd', 1, 355, NULL, NULL, NULL, NULL),
(3186, 'Austagram Sadar', 'অষ্টগ্রাম সদর', 'austagramsadarup . kishoreganj . gov . bd', 1, 355, NULL, NULL, NULL, NULL),
(3187, 'Bangalpara', 'বাঙ্গালপাড়া', 'bangalparaup . kishoreganj . gov . bd', 1, 355, NULL, NULL, NULL, NULL),
(3188, 'Kalma', 'কলমা', 'kalmaup . kishoreganj . gov . bd', 1, 355, NULL, NULL, NULL, NULL),
(3189, 'Adampur', 'আদমপুর', 'adampurup . kishoreganj . gov . bd', 1, 355, NULL, NULL, NULL, NULL),
(3190, 'Khyerpur - Abdullahpur', 'খয়েরপুর - আব্দুল্লাপুর', 'khyerpurabdullahpurup . kishoreganj . gov . bd', 1, 355, NULL, NULL, NULL, NULL),
(3191, 'Purba Austagram', 'পূর্ব অষ্টগ্রাম', 'purbaaustagramup . kishoreganj . gov . bd', 1, 355, NULL, NULL, NULL, NULL),
(3192, 'Gopdighi', 'গোপদিঘী', 'gopdighiup . kishoreganj . gov . bd', 1, 356, NULL, NULL, NULL, NULL),
(3193, 'Mithamoin', 'মিঠামইন', 'mithamoinup . kishoreganj . gov . bd', 1, 356, NULL, NULL, NULL, NULL),
(3194, 'Dhaki', 'ঢাকী', 'dhakiup . kishoreganj . gov . bd', 1, 356, NULL, NULL, NULL, NULL),
(3195, 'Ghagra', 'ঘাগড়া', 'ghagraup . kishoreganj . gov . bd', 1, 356, NULL, NULL, NULL, NULL),
(3196, 'Keoarjore', 'কেওয়ারজোর', 'keoarjoreup . kishoreganj . gov . bd', 1, 356, NULL, NULL, NULL, NULL),
(3197, 'Katkhal', 'কাটখাল', 'katkhalup . kishoreganj . gov . bd', 1, 356, NULL, NULL, NULL, NULL),
(3198, 'Bairati', 'বৈরাটি', 'bairatiup . kishoreganj . gov . bd', 1, 356, NULL, NULL, NULL, NULL),
(3199, 'Chatirchar', 'ছাতিরচর', 'chatircharup . kishoreganj . gov . bd', 1, 357, NULL, NULL, NULL, NULL),
(3200, 'Guroi', 'গুরই', 'guroiup . kishoreganj . gov . bd', 1, 357, NULL, NULL, NULL, NULL),
(3201, 'Jaraitala', 'জারইতলা', 'jaraitalaup . kishoreganj . gov . bd', 1, 357, NULL, NULL, NULL, NULL),
(3202, 'Nikli Sadar', 'নিকলী সদর', 'niklisadarup . kishoreganj . gov . bd', 1, 357, NULL, NULL, NULL, NULL),
(3203, 'Karpasa', 'কারপাশা', 'karpasaup . kishoreganj . gov . bd', 1, 357, NULL, NULL, NULL, NULL),
(3204, 'Dampara', 'দামপাড়া', 'damparaup . kishoreganj . gov . bd', 1, 357, NULL, NULL, NULL, NULL),
(3205, 'Singpur', 'সিংপুর', 'singpurup . kishoreganj . gov . bd', 1, 357, NULL, NULL, NULL, NULL),
(3206, 'Balla', 'বাল্লা', 'ballaup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3207, 'Gala', 'গালা', 'galaup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3208, 'Chala', 'চালা', 'chalaup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3209, 'Blara', 'বলড়া', 'blaraup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3210, 'Harukandi', 'হারুকান্দি', 'harukandiup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3211, 'Baira', 'বয়রা', 'bairaup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3212, 'Ramkrishnapur', 'রামকৃঞ্চপুর', 'ramkrishnapurup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3213, 'Gopinathpur', 'গোপীনাথপুর', 'gopinathpurup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3214, 'Kanchanpur', 'কাঞ্চনপুর', 'kanchanpurup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3215, 'Lacharagonj', 'লেছড়াগঞ্জ', 'lacharagonjup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3216, 'Sutalorie', 'সুতালড়ী', 'sutalorieup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3217, 'Dhulsura', 'ধূলশুড়া', 'dhulsuraup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3218, 'Azimnagar', 'আজিমনগর', 'azimnagarup . manikganj . gov . bd', 1, 358, NULL, NULL, NULL, NULL),
(3219, 'Baried', 'বরাইদ', 'bariedup . manikganj . gov . bd', 1, 359, NULL, NULL, NULL, NULL),
(3220, 'Dighulia', 'দিঘুলিয়া', 'dighuliaup . manikganj . gov . bd', 1, 359, NULL, NULL, NULL, NULL),
(3221, 'Baliyati', 'বালিয়াটি', 'baliyatiup . manikganj . gov . bd', 1, 359, NULL, NULL, NULL, NULL),
(3222, 'Dargram', 'দড়গ্রাম', 'dargramup . manikganj . gov . bd', 1, 359, NULL, NULL, NULL, NULL),
(3223, 'Tilli', 'তিল্লী', 'tilliup . manikganj . gov . bd', 1, 359, NULL, NULL, NULL, NULL),
(3224, 'Hargaj', 'হরগজ', 'hargajup . manikganj . gov . bd', 1, 359, NULL, NULL, NULL, NULL),
(3225, 'Saturia', 'সাটুরিয়া', 'saturiaup . manikganj . gov . bd', 1, 359, NULL, NULL, NULL, NULL),
(3226, 'Dhankora', 'ধানকোড়া', 'dhankoraup . manikganj . gov . bd', 1, 359, NULL, NULL, NULL, NULL),
(3227, 'Fukurhati', 'ফুকুরহাটি', 'fukurhatiup . manikganj . gov . bd', 1, 359, NULL, NULL, NULL, NULL),
(3228, 'Betila - Mitara', 'বেতিলা - মিতরা', 'betilamitaraup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3229, 'Jagir', 'জাগীর', 'jagirup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3230, 'Atigram', 'আটিগ্রাম', 'atigramup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3231, 'Dighi', 'দিঘী', 'dighiup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3232, 'Putile', 'পুটাইল', 'putileup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3233, 'Hatipara', 'হাটিপাড়া', 'hatiparaup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3234, 'Vararia', 'ভাড়ারিয়া', 'varariaup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3235, 'Nbogram', 'নবগ্রাম', 'nbogramup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3236, 'Garpara', 'গড়পাড়া', 'garparaup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3237, 'Krishnapur', 'কৃঞ্চপুর', 'krishnapurup . manikganj . gov . bd', 1, 360, NULL, NULL, NULL, NULL),
(3238, 'Paila', 'পয়লা', 'pailaup . manikganj . gov . bd', 1, 361, NULL, NULL, NULL, NULL),
(3239, 'Shingzuri', 'সিংজুড়ী', 'shingzuriup . manikganj . gov . bd', 1, 361, NULL, NULL, NULL, NULL),
(3240, 'Baliyakhora', 'বালিয়াখোড়া', 'baliyakhoraup . manikganj . gov . bd', 1, 361, NULL, NULL, NULL, NULL),
(3241, 'Gior', 'ঘিওর', 'giorup . manikganj . gov . bd', 1, 361, NULL, NULL, NULL, NULL),
(3242, 'Bartia', 'বড়টিয়া', 'bartiaup . manikganj . gov . bd', 1, 361, NULL, NULL, NULL, NULL),
(3243, 'Baniazuri', 'বানিয়াজুড়ী', 'baniazuriup . manikganj . gov . bd', 1, 361, NULL, NULL, NULL, NULL),
(3244, 'Nalee', 'নালী', 'naleeup . manikganj . gov . bd', 1, 361, NULL, NULL, NULL, NULL),
(3245, 'Teota', 'তেওতা', 'teotaup . manikganj . gov . bd', 1, 362, NULL, NULL, NULL, NULL),
(3246, 'Utholi', 'উথলী', 'utholiup . manikganj . gov . bd', 1, 362, NULL, NULL, NULL, NULL),
(3247, 'Shibaloy', 'শিবালয়', 'shibaloyup . manikganj . gov . bd', 1, 362, NULL, NULL, NULL, NULL),
(3248, 'Ulayel', 'উলাইল', 'ulayelup . manikganj . gov . bd', 1, 362, NULL, NULL, NULL, NULL),
(3249, 'Aruoa', 'আরুয়া', 'aruoaup . manikganj . gov . bd', 1, 362, NULL, NULL, NULL, NULL),
(3250, 'Mohadebpur', 'মহাদেবপুর', 'mohadebpurup . manikganj . gov . bd', 1, 362, NULL, NULL, NULL, NULL),
(3251, 'Shimulia', 'শিমুলিয়া', 'shimuliaup . manikganj . gov . bd', 1, 362, NULL, NULL, NULL, NULL),
(3252, 'Charkataree', 'চরকাটারী', 'charkatareeup . manikganj . gov . bd', 1, 363, NULL, NULL, NULL, NULL),
(3253, 'Bachamara', 'বাচামারা', 'bachamaraup . manikganj . gov . bd', 1, 363, NULL, NULL, NULL, NULL),
(3254, 'Baghutia', 'বাঘুটিয়া', 'baghutiaup . manikganj . gov . bd', 1, 363, NULL, NULL, NULL, NULL),
(3255, 'Zionpur', 'জিয়নপুর', 'zionpurup . manikganj . gov . bd', 1, 363, NULL, NULL, NULL, NULL),
(3256, 'Khalshi', 'খলশী', 'khalshiup . manikganj . gov . bd', 1, 363, NULL, NULL, NULL, NULL),
(3257, 'Chakmirpur', 'চকমিরপুর', 'chakmirpurup . manikganj . gov . bd', 1, 363, NULL, NULL, NULL, NULL),
(3258, 'Klia', 'কলিয়া', 'kliaup . manikganj . gov . bd', 1, 363, NULL, NULL, NULL, NULL),
(3259, 'Dhamswar', 'ধামশ্বর', 'dhamswarup . manikganj . gov . bd', 1, 363, NULL, NULL, NULL, NULL),
(3260, 'Buyra', 'বায়রা', 'buyraup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3261, 'Talebpur', 'তালেবপুর', 'talebpurup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3262, 'Singiar', 'সিংগাইর', 'singiarup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3263, 'Baldhara', 'বলধারা', 'baldharaup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3264, 'Zamsha', 'জামশা', 'zamshaup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3265, 'Charigram', 'চারিগ্রাম', 'charigramup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3266, 'Shayesta', 'শায়েস্তা', 'shayestaup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3267, 'Joymonto', 'জয়মন্টপ', 'joymontopup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3268, 'Dhalla', 'ধল্লা', 'dhallaup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3269, 'Jamirta', 'জার্মিতা', 'jamirtaup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3270, 'Chandhar', 'চান্দহর', 'chandharup . manikganj . gov . bd', 1, 364, NULL, NULL, NULL, NULL),
(3271, 'Savar', 'সাভার', 'savarup . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3272, 'Birulia', 'বিরুলিয়া', 'birulia . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3273, 'Dhamsona', 'ধামসোনা', 'dhamsonaup . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3274, 'Shimulia', 'শিমুলিয়া', 'shimuliaup . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3275, 'Ashulia', 'আশুলিয়া', 'ashuliaup . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3276, 'Yearpur', 'ইয়ারপুর', 'yearpurup . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3277, 'Vakurta', 'ভাকুর্তা', 'vakurtaup . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3278, 'Pathalia', 'পাথালিয়া', 'pathaliaup . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3279, 'Bongaon', 'বনগাঁও', 'bongaonup . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3280, 'Kaundia', 'কাউন্দিয়া', 'kaundiaup . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3281, 'Tetuljhora', 'তেঁতুলঝোড়া', 'tetuljhora . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3282, 'Aminbazar', 'আমিনবাজার', 'aminbazar . dhaka . gov . bd', 1, 365, NULL, NULL, NULL, NULL),
(3283, 'Chauhat', 'চৌহাট', 'chauhatup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3284, 'Amta', 'আমতা', 'amtaup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3285, 'Balia', 'বালিয়া', 'baliaup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3286, 'Jadabpur', 'যাদবপুর', 'jadabpurup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3287, 'Baisakanda', 'বাইশাকান্দা', 'baisakandaup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3288, 'Kushura', 'কুশুরা', 'kushuraup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3289, 'Gangutia', 'গাংগুটিয়া', 'gangutiaup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3290, 'Sanora', 'সানোড়া', 'sanoraup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3291, 'Sutipara', 'সূতিপাড়া', 'sutiparaup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3292, 'Sombhag', 'সোমভাগ', 'sombhagup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3293, 'Vararia', 'ভাড়ারিয়া', 'varariaup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3294, 'Dhamrai', 'ধামরাই', 'dhamraiup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3295, 'Kulla', 'কুল্লা', 'kullaup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3296, 'Rowail', 'রোয়াইল', 'rowailup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3297, 'Suapur', 'সুয়াপুর', 'suapurup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3298, 'Nannar', 'নান্নার', 'nannarup . dhaka . gov . bd', 1, 366, NULL, NULL, NULL, NULL),
(3299, 'Hazratpur', 'হযরতপুর', 'hazratpurup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3300, 'Kalatia', 'কলাতিয়া', 'kalatiaup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3301, 'Taranagar', 'তারানগর', 'taranagarup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3302, 'Sakta', 'শাক্তা', 'saktaup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3303, 'Ruhitpur', 'রোহিতপুর', 'ruhitpurup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3304, 'Basta', 'বাস্তা', 'bastaup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3305, 'Kalindi', 'কালিন্দি', 'kalindiup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3306, 'Zinzira', 'জিনজিরা', 'zinziraup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3307, 'Suvadda', 'শুভাঢ্যা', 'suvaddaup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3308, 'Taghoria', 'তেঘরিয়া', 'taghoriaup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3309, 'Konda', 'কোন্ডা', 'kondaup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3310, 'Aganagar', 'আগানগর', 'aganagarup . dhaka . gov . bd', 1, 367, NULL, NULL, NULL, NULL),
(3311, 'Shikaripara', 'শিকারীপাড়া', 'shikariparaup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3312, 'Joykrishnapur', 'জয়কৃষ্ণপুর', 'joykrishnapurup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3313, 'Baruakhali', 'বারুয়াখালী', 'baruakhaliup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3314, 'Nayansree', 'নয়নশ্রী', 'nayansreeup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3315, 'Sholla', 'শোল্লা', 'shollaup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3316, 'Jantrail', 'যন্ত্রাইল', 'jantrailup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3317, 'Bandura', 'বান্দুরা', 'banduraup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3318, 'Kalakopa', 'কলাকোপা', 'kalakopaup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3319, 'Bakshanagar', 'বক্সনগর', 'bakshanagarup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3320, 'Barrah', 'বাহ্রা', 'barrahup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3321, 'Kailail', 'কৈলাইল', 'kailailup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3322, 'Agla', 'আগলা', 'aglaup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3323, 'Galimpur', 'গালিমপুর', 'galimpurup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3324, 'Churain', 'চুড়াইন', 'churainup . dhaka . gov . bd', 1, 368, NULL, NULL, NULL, NULL),
(3325, 'Nayabari', 'নয়াবাড়ী', 'nayabariup . dhaka . gov . bd', 1, 369, NULL, NULL, NULL, NULL),
(3326, 'Kusumhathi', 'কুসুমহাটি', 'kusumhathiup . dhaka . gov . bd', 1, 369, NULL, NULL, NULL, NULL),
(3327, 'Raipara', 'রাইপাড়া', 'raiparaup . dhaka . gov . bd', 1, 369, NULL, NULL, NULL, NULL),
(3328, 'Sutarpara', 'সুতারপাড়া', 'sutarparaup . dhaka . gov . bd', 1, 369, NULL, NULL, NULL, NULL),
(3329, 'Narisha', 'নারিশা', 'narishaup . dhaka . gov . bd', 1, 369, NULL, NULL, NULL, NULL),
(3330, 'Muksudpur', 'মুকসুদপুর', 'muksudpurup . dhaka . gov . bd', 1, 369, NULL, NULL, NULL, NULL),
(3331, 'Mahmudpur', 'মাহমুদপুর', 'mahmudpurup . dhaka . gov . bd', 1, 369, NULL, NULL, NULL, NULL),
(3332, 'Bilaspur', 'বিলাসপুর', 'bilaspurup . dhaka . gov . bd', 1, 369, NULL, NULL, NULL, NULL),
(3333, 'Rampal', 'রামপাল', 'rampalup . munshiganj . gov . bd', 1, 370, NULL, NULL, NULL, NULL),
(3334, 'Panchashar', 'পঞ্চসার', 'panchasharup . munshiganj . gov . bd', 1, 370, NULL, NULL, NULL, NULL),
(3335, 'Bajrajogini', 'বজ্রযোগিনী', 'bajrajoginiup . munshiganj . gov . bd', 1, 370, NULL, NULL, NULL, NULL),
(3336, 'Mohakali', 'মহাকালী', 'mohakaliup . munshiganj . gov . bd', 1, 370, NULL, NULL, NULL, NULL),
(3337, 'Charkewar', 'চরকেওয়ার', 'charkewarup . munshiganj . gov . bd', 1, 370, NULL, NULL, NULL, NULL),
(3338, 'Mollakandi', 'মোল্লাকান্দি', 'mollakandiup . munshiganj . gov . bd', 1, 370, NULL, NULL, NULL, NULL),
(3339, 'Adhara', 'আধারা', 'adharaup . munshiganj . gov . bd', 1, 370, NULL, NULL, NULL, NULL),
(3340, 'Shiloy', 'শিলই', 'shiloyup . munshiganj . gov . bd', 1, 370, NULL, NULL, NULL, NULL),
(3341, 'Banglabazar', 'বাংলাবাজার', 'banglabazarup . munshiganj . gov . bd', 1, 370, NULL, NULL, NULL, NULL),
(3342, 'Baraikhali', 'বাড়েখাল', 'baraikhaliup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3343, 'Hashara', 'হাসাড়া', 'hasharaup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3344, 'Birtara', 'বাড়তারা', 'birtaraup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3345, 'Shologhor', 'ষোলঘর', 'shologhorup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3346, 'Sreenagar', 'শ্রীনগর', 'sreenagarup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3347, 'Patabhog', 'পাঢাভোগ', 'patabhogup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3348, 'Shamshiddi', 'শ্যামসিদ্দি', 'shamshiddiup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3349, 'Kolapara', 'কুলাপাড়া', 'kolaparaup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3350, 'Vaggakol', 'ভাগ্যকুল', 'vaggakolup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3351, 'Bagra', 'বাঘড়া', 'bagraup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3352, 'Rarikhal', 'রাঢ়ীখাল', 'rarikhalup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3353, 'Kukutia', 'কুকুটিয়া', 'kukutiaup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3354, 'Atpara', 'আটপাড়া', 'atparaup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3355, 'Tantor', 'তন্তর', 'tantorup . munshiganj . gov . bd', 1, 371, NULL, NULL, NULL, NULL),
(3356, 'Chitracoat', 'চিত্রকোট', 'chitracoatup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3357, 'Sekhornagar', 'শেখরনগার', 'sekhornagarup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3358, 'Rajanagar', 'রাজানগর', 'rajanagarup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3359, 'Keyain', 'কেয়াইন', 'keyainup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3360, 'Basail', 'বাসাইল', 'basailup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3361, 'Baluchar', 'বালুচর', 'balucharup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3362, 'Latabdi', 'লতাব্দী', 'latabdiup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3363, 'Rasunia', 'রশুনিয়া', 'rasuniaup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3364, 'Ichhapura', 'ইছাপুরা', 'ichhapuraup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3365, 'Bairagadi', 'বয়রাগাদি', 'bairagadiup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3366, 'Malkhanagar', 'মালখানগর', 'malkhanagarup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3367, 'Madhypara', 'মধ্যপাড়া', 'madhyparaup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3368, 'Kola', 'কোলা', 'kolaup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3369, 'Joyinshar', 'জৈনসার', 'joyinsharup . munshiganj . gov . bd', 1, 372, NULL, NULL, NULL, NULL),
(3370, 'Medinimandal', 'মেদিনীমন্ডল', 'medinimandalup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3371, 'Kumarbhog', 'কুমারভোগ', 'kumarbhogup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3372, 'Haldia', 'হলদিয়া', 'haldiaup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3373, 'Kanaksar', 'কনকসার', 'kanaksarup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3374, 'Lohajang - Teotia', 'লৌহজং - তেওটিয়া', 'lohajangteotiaup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3375, 'Bejgaon', 'বেজগাঁও', 'bejgaonup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3376, 'Baultoli', 'বৌলতলী', 'baultoliup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3377, 'Khidirpara', 'খিদিরপাড়া', 'khidirparaup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3378, 'Gaodia', 'গাওদিয়া', 'gaodiaup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3379, 'Kalma', 'কলমা', 'kalmaup . munshiganj . gov . bd', 1, 373, NULL, NULL, NULL, NULL),
(3380, 'Gajaria', 'গজারিয়া', 'gajariaup . munshiganj . gov . bd', 1, 374, NULL, NULL, NULL, NULL),
(3381, 'Baushia', 'বাউশিয়া', 'baushiaup . munshiganj . gov . bd', 1, 374, NULL, NULL, NULL, NULL),
(3382, 'Vaberchar', 'ভবেরচর', 'vabercharup . munshiganj . gov . bd', 1, 374, NULL, NULL, NULL, NULL),
(3383, 'Baluakandi', 'বালুয়াকান্দী', 'baluakandiup . munshiganj . gov . bd', 1, 374, NULL, NULL, NULL, NULL),
(3384, 'Tengarchar', 'টেংগারচর', 'tengarcharup . munshiganj . gov . bd', 1, 374, NULL, NULL, NULL, NULL),
(3385, 'Hosendee', 'হোসেন্দী', 'hosendeeup . munshiganj . gov . bd', 1, 374, NULL, NULL, NULL, NULL),
(3386, 'Guagachia', 'গুয়াগাছিয়া', 'guagachiaup . munshiganj . gov . bd', 1, 374, NULL, NULL, NULL, NULL),
(3387, 'Imampur', 'ইমামপুর', 'imampurup . munshiganj . gov . bd', 1, 374, NULL, NULL, NULL, NULL),
(3388, 'Betka', 'বেতকা', 'betkaup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3389, 'Abdullapur', 'আব্দুল্লাপুর', 'abdullapurup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3390, 'Sonarong Tongibari', 'সোনারং টংগীবাড়ী', 'sonarongtongibariup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3391, 'Autshahi', 'আউটশাহী', 'autshahiup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3392, 'Arial Baligaon', 'আড়িয়ল বালিগাঁও', 'arialbaligaonup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3393, 'Dhipur', 'ধীপুর', 'dhipurup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3394, 'Kathadia Shimolia', 'কাঠাদিয়া শিমুলিয়া', 'kathadiashimoliaup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3395, 'Joslong', 'যশলং', 'joslongup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3396, 'Panchgaon', 'পাঁচগাও', 'panchgaonup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3397, 'Kamarkhara', 'কামারখাড়া', 'kamarkharaup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3398, 'Hasailbanari', 'হাসাইল বানারী', 'hasailbanariup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3399, 'Dighirpar', 'দিঘীরপাড়', 'dighirparup . munshiganj . gov . bd', 1, 375, NULL, NULL, NULL, NULL),
(3400, 'Mijanpur', 'মিজানপুর', 'mijanpurup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3401, 'Borat', 'বরাট', 'boratup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3402, 'Chandoni', 'চন্দনী', 'chandoniup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3403, 'Khangonj', 'খানগঞ্জ', 'khangonjup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3404, 'Banibaha', 'বানীবহ', 'banibahaup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3405, 'Dadshee', 'দাদশী', 'dadsheeup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3406, 'Mulghar', 'মুলঘর', 'mulgharup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3407, 'Basantapur', 'বসন্তপুর', 'basantapurup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3408, 'Khankhanapur', 'খানখানাপুর', 'khankhanapurup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3409, 'Alipur', 'আলীপুর', 'alipurup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3410, 'Ramkantapur', 'রামকান্তপুর', 'ramkantapurup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3411, 'Shahidwahabpur', 'শহীদওহাবপুর', 'shahidwahabpurup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3412, 'Panchuria', 'পাঁচুরিয়া', 'panchuriaup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3413, 'Sultanpur', 'সুলতানপুর', 'sultanpurup . rajbari . gov . bd', 1, 376, NULL, NULL, NULL, NULL),
(3414, 'Doulatdia', 'দৌলতদিয়া', 'doulatdiaup . rajbari . gov . bd', 1, 377, NULL, NULL, NULL, NULL),
(3415, 'Debugram', 'দেবগ্রাম', 'debugramup . rajbari . gov . bd', 1, 377, NULL, NULL, NULL, NULL),
(3416, 'Uzancar', 'উজানচর', 'uzancarup . rajbari . gov . bd', 1, 377, NULL, NULL, NULL, NULL),
(3417, 'Chotovakla', 'ছোটভাকলা', 'chotovaklaup . rajbari . gov . bd', 1, 377, NULL, NULL, NULL, NULL),
(3418, 'Bahadurpur', 'বাহাদুরপুর', 'bahadurpurup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3419, 'Habashpur', 'হাবাসপুর', 'habashpurup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3420, 'Jashai', 'যশাই', 'jashaiup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3421, 'Babupara', 'বাবুপাড়া', 'babuparaup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3422, 'Mourat', 'মৌরাট', 'mouratup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3423, 'Patta', 'পাট্টা', 'pattaup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3424, 'Sarisha', 'সরিষা', 'sarishaup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3425, 'Kalimahar', 'কলিমহর', 'kalimaharup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3426, 'Kasbamajhail', 'কসবামাজাইল', 'kasbamajhailup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3427, 'Machhpara', 'মাছপাড়া', 'machhparaup . rajbari . gov . bd', 1, 378, NULL, NULL, NULL, NULL),
(3428, 'Islampur', 'ইসলামপুর', 'islampurup . rajbari . gov . bd', 1, 379, NULL, NULL, NULL, NULL),
(3429, 'Baharpur', 'বহরপুর', 'baharpurup . rajbari . gov . bd', 1, 379, NULL, NULL, NULL, NULL),
(3430, 'Nawabpur', 'নবাবপুর', 'nawabpurup . rajbari . gov . bd', 1, 379, NULL, NULL, NULL, NULL),
(3431, 'Narua', 'নারুয়া', 'naruaup . rajbari . gov . bd', 1, 379, NULL, NULL, NULL, NULL),
(3432, 'Baliakandi', 'বালিয়াকান্দি', 'baliakandiup . rajbari . gov . bd', 1, 379, NULL, NULL, NULL, NULL),
(3433, 'Janjal', 'জঙ্গল', 'janjalup . rajbari . gov . bd', 1, 379, NULL, NULL, NULL, NULL),
(3434, 'Jamalpur', 'জামালপুর', 'jamalpurup . rajbari . gov . bd', 1, 379, NULL, NULL, NULL, NULL),
(3435, 'Kalukhali', 'কালুখালী', 'kalukhaliup . rajbari . gov . bd', 1, 380, NULL, NULL, NULL, NULL),
(3436, 'Ratandia', 'রতনদিয়া', 'ratandiaup . rajbari . gov . bd', 1, 380, NULL, NULL, NULL, NULL),
(3437, 'Kalikapur', 'কালিকাপুর', 'kalikapurup . rajbari . gov . bd', 1, 380, NULL, NULL, NULL, NULL),
(3438, 'Boalia', 'বোয়ালিয়া', 'boaliaup . rajbari . gov . bd', 1, 380, NULL, NULL, NULL, NULL),
(3439, 'Majbari', 'মাজবাড়ী', 'majbariup . rajbari . gov . bd', 1, 380, NULL, NULL, NULL, NULL),
(3440, 'Madapur', 'মদাপুর', 'madapurup . rajbari . gov . bd', 1, 380, NULL, NULL, NULL, NULL),
(3441, 'Shawrail', 'সাওরাইল', 'shawrailup . rajbari . gov . bd', 1, 380, NULL, NULL, NULL, NULL),
(3442, 'Mrigi', 'মৃগী', 'mrigiup . rajbari . gov . bd', 1, 380, NULL, NULL, NULL, NULL),
(3443, 'Sirkhara', 'শিড়খাড়া', 'sirkharaup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3444, 'Bahadurpur', 'বাহাদুরপুর', 'bahadurpurup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3445, 'Kunia', 'কুনিয়া', 'kuniaup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3446, 'Peyarpur', 'পেয়ারপুর', 'peyarpurup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3447, 'Kandua', 'কেন্দুয়া', 'kanduaup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3448, 'Mastofapur', 'মস্তফাপুর', 'mastofapurup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3449, 'Dudkhali', 'দুধখালী', 'dudkhaliup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3450, 'Kalikapur', 'কালিকাপুর', 'kalikapurup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3451, 'Chilarchar', 'ছিলারচর', 'chilarcharup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3452, 'Panchkhola', 'পাঁচখোলা', 'panchkholaup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3453, 'Ghatmajhi', 'ঘটমাঝি', 'ghatmajhiup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3454, 'Jhaoudi', 'ঝাউদী', 'jhaoudiup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3455, 'Khoajpur', 'খোয়াজপুর', 'khoajpurup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3456, 'Rasti', 'রাস্তি', 'rastiup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3457, 'Dhurail', 'ধুরাইল', 'dhurailup . madaripur . gov . bd', 1, 381, NULL, NULL, NULL, NULL),
(3458, 'Shibchar', 'শিবচর', 'shibcharup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3459, 'Ditiyakhando', 'দ্বিতীয়খন্ড', 'ditiyakhandoup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3460, 'Nilokhe', 'নিলখি', 'nilokheup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3461, 'Bandarkhola', 'বন্দরখোলা', 'bandarkholaup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3462, 'Charjanazat', 'চরজানাজাত', 'charjanazatup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3463, 'Madbarerchar', 'মাদবরেরচর', 'madbarercharup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3464, 'Panchar', 'পাঁচচর', 'pancharup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3465, 'Sannasirchar', 'সন্যাসিরচর', 'sannasircharup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3466, 'Kathalbari', 'কাঁঠালবাড়ী', 'kathalbariup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3467, 'Kutubpur', 'কুতুবপুর', 'kutubpurup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3468, 'Kadirpur', 'কাদিরপুর', 'kadirpurup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3469, 'Vhandarikandi', 'ভান্ডারীকান্দি', 'vhandarikandiup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3470, 'Bahertala South', 'বহেরাতলা দক্ষিণ', 'bahertalasouthup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3471, 'Baheratala North', 'বহেরাতলা উত্তর', 'baheratalanorthup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3472, 'Baskandi', 'বাঁশকান্দি', 'baskandiup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3473, 'Umedpur', 'উমেদপুর', 'umedpurup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3474, 'Vhadrasion', 'ভদ্রাসন', 'vhadrasionup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3475, 'Shiruail', 'শিরুয়াইল', 'shiruailup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3476, 'Dattapara', 'দত্তপাড়া', 'dattaparaup . madaripur . gov . bd', 1, 382, NULL, NULL, NULL, NULL),
(3477, 'Alinagar', 'আলীনগর', 'alinagarup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3478, 'Baligram', 'বালীগ্রাম', 'baligramup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3479, 'Basgari', 'বাঁশগাড়ী', 'basgariup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3480, 'Chardoulatkhan', 'চরদৌলতখান', 'chardoulatkhanup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3481, 'Dashar', 'ডাসার', 'dasharup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3482, 'Enayetnagor', 'এনায়েতনগর', 'enayetnagorup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3483, 'Gopalpur', 'গোপালপুর', 'gopalpurup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3484, 'Koyaria', 'কয়ারিয়া', 'koyariaup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3485, 'Kazibakai', 'কাজীবাকাই', 'kazibakaiup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3486, 'Laxmipur', 'লক্ষীপুর', 'laxmipurup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3487, 'Nabogram', 'নবগ্রাম', 'nabogramup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3488, 'Ramjanpur', 'রমজানপুর', 'ramjanpurup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3489, 'Shahebrampur', 'সাহেবরামপুর', 'shahebrampurup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3490, 'Shikarmongol', 'শিকারমঙ্গল', 'shikarmongolup . madaripur . gov . bd', 1, 383, NULL, NULL, NULL, NULL),
(3491, 'Haridasdi - Mahendrodi', 'হরিদাসদী - মহেন্দ্রদী', 'haridasdi - mahendrodiup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3492, 'Kadambari', 'কদমবাড়ী', 'kadambariup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3493, 'Bajitpur', 'বাজিতপুর', 'bajitpurup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3494, 'Amgram', 'আমগ্রাম', 'amgramup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3495, 'Rajoir', 'রাজৈর', 'rajoirup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3496, 'Khaliya', 'খালিয়া', 'khaliyaup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3497, 'Ishibpur', 'ইশিবপুর', 'ishibpurup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3498, 'Badarpasa', 'বদরপাশা', 'badarpasaup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3499, 'Kabirajpur', 'কবিরাজপুর', 'kabirajpurup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3500, 'Hosenpur', 'হোসেনপুর', 'hosenpurup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3501, 'Paikpara', 'পাইকপাড়া', 'paikparaup . madaripur . gov . bd', 1, 384, NULL, NULL, NULL, NULL),
(3502, 'Jalalabad', 'জালালাবাদ', 'jalalabadup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3503, 'No.3 Suktail Union Parishad', '৩নং শুকতাইল ইউনিয়ন পরিষদ', 'shuktailup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3504, 'Chandradighalia', 'চন্দ্রদিঘলিয়া', 'chandradighaliaup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3505, 'Gopinathpur', 'গোপীনাথপুর', 'gopinathpurup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3506, 'Paikkandi', 'পাইককান্দি', 'paikkandiup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3507, 'Urfi', 'উরফি', 'urfiup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3508, 'Lotifpur', 'লতিফপুর', 'lotifpurup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3509, 'Satpar', 'সাতপাড়', 'satparup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3510, 'Sahapur', 'সাহাপুর', 'sahapurup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3511, 'Horidaspur', 'হরিদাসপুর', 'horidaspurup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL);
INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(3512, 'Ulpur', 'উলপুর', 'ulpurup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3513, 'Nizra', 'নিজড়া', 'nizraup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3514, 'Karpara', 'করপাড়া', 'karparaup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3515, 'Durgapur', 'দুর্গাপুর', 'durgapurup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3516, 'Kajulia', 'কাজুলিয়া', 'kajuliaup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3517, 'Majhigati', 'মাঝিগাতী', 'majhigatiup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3518, 'Roghunathpur', 'রঘুনাথপুর', 'roghunathpurup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3519, 'Gobra', 'গোবরা', 'gobraup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3520, 'Borashi', 'বোড়াশী', 'borashiup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3521, 'Kati', 'কাঠি', 'katiup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3522, 'Boultali', 'বৌলতলী', 'boultaliup . gopalganj . gov . bd', 1, 385, NULL, NULL, NULL, NULL),
(3523, 'Kashiani', 'কাশিয়ানী', 'kashianiup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3524, 'Hatiara', 'হাতিয়াড়া', 'hatiaraup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3525, 'Fukura', 'ফুকরা', 'fukuraup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3526, 'Rajpat', 'রাজপাট', 'rajpatup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3527, 'Bethuri', 'বেথুড়ী', 'bethuriup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3528, 'Nijamkandi', 'নিজামকান্দি', 'nijamkandiup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3529, 'Sajail', 'সাজাইল', 'sajailup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3530, 'Mamudpur', 'মাহমুদপুর', 'mamudpurup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3531, 'Maheshpur', 'মহেশপুর', 'maheshpurup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3532, 'Orakandia', 'ওড়াকান্দি', 'orakandiaup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3533, 'Parulia', 'পারুলিয়া', 'paruliaup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3534, 'Ratail', 'রাতইল', 'ratailup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3535, 'Puisur', 'পুইশুর', 'puisurup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3536, 'Singa', 'সিংগা', 'singaup . gopalganj . gov . bd', 1, 386, NULL, NULL, NULL, NULL),
(3537, 'Kushli', 'কুশলী', 'kushliup . gopalganj . gov . bd', 1, 387, NULL, NULL, NULL, NULL),
(3538, 'Gopalpur', 'গোপালপুর', 'gopalpurup . gopalganj . gov . bd', 1, 387, NULL, NULL, NULL, NULL),
(3539, 'Patgati', 'পাটগাতী', 'patgatiup . gopalganj . gov . bd', 1, 387, NULL, NULL, NULL, NULL),
(3540, 'Borni', 'বর্ণি', 'borniup . gopalganj . gov . bd', 1, 387, NULL, NULL, NULL, NULL),
(3541, 'Dumaria', 'ডুমরিয়া', 'dumariaup . gopalganj . gov . bd', 1, 387, NULL, NULL, NULL, NULL),
(3542, 'Sadullapur', 'সাদুল্লাপুর', 'sadullapurup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3543, 'Ramshil', 'রামশীল', 'ramshilup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3544, 'Bandhabari', 'বান্ধাবাড়ী', 'bandhabariup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3545, 'Kolabari', 'কলাবাড়ী', 'kolabariup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3546, 'Kushla', 'কুশলা', 'kushlaup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3547, 'Amtoli', 'আমতলী', 'amtoliup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3548, 'Pinjuri', 'পিঞ্জুরী', 'pinjuriup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3549, 'Ghaghor', 'ঘাঘর', 'ghaghorup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3550, 'Radhaganj', 'রাধাগঞ্জ', 'radhaganjup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3551, 'Hiron', 'হিরণ', 'hironup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3552, 'Kandi', 'কান্দি', 'kandiup . gopalganj . gov . bd', 1, 388, NULL, NULL, NULL, NULL),
(3553, 'Ujani', 'উজানী', 'ujaniup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3554, 'Nanikhir', 'ননীক্ষীর', 'nanikhirup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3555, 'Dignagar', 'দিগনগর', 'dignagarup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3556, 'Poshargati', 'পশারগাতি', 'poshargatiup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3557, 'Gobindopur', 'গোবিন্দপুর', 'gobindopurup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3558, 'Khandarpara', 'খান্দারপাড়া', 'khandarparaup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3559, 'Bohugram', 'বহুগ্রাম', 'bohugramup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3560, 'Banshbaria', 'বাশঁবাড়িয়া', 'banshbariaup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3561, 'Vabrashur', 'ভাবড়াশুর', 'vabrashurup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3562, 'Moharajpur', 'মহারাজপুর', 'moharajpurup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3563, 'Batikamari', 'বাটিকামারী', 'batikamariup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3564, 'Jalirpar', 'জলিরপাড়', 'jalirparup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3565, 'Raghdi', 'রাঘদী', 'raghdiup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3566, 'Gohala', 'গোহালা', 'gohalaup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3567, 'Mochna', 'মোচনা', 'mochnaup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3568, 'Kashalia', 'কাশালিয়া', 'kashaliaup . gopalganj . gov . bd', 1, 389, NULL, NULL, NULL, NULL),
(3569, 'Ishangopalpur', 'ঈশানগোপালপুর', 'ishangopalpurup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3570, 'Charmadbdia', 'চরমাধবদিয়া', 'charmadbdiaup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3571, 'Aliabad', 'আলিয়াবাদ', 'aliabadup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3572, 'Uttarchannel', 'নর্থচ্যানেল', 'uttarchannelup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3573, 'Decreerchar', 'ডিক্রিরচর', 'decreercharup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3574, 'Majchar', 'মাচ্চর', 'majcharup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3575, 'Krishnanagar', 'কৃষ্ণনগর', 'krishnanagarup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3576, 'Ambikapur', 'অম্বিকাপুর', 'ambikapurup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3577, 'Kanaipur', 'কানাইপুর', 'kanaipurup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3578, 'Kaijuri', 'কৈজুরী', 'kaijuriup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3579, 'Greda', 'গেরদা', 'gredaup . faridpur . gov . bd', 1, 390, NULL, NULL, NULL, NULL),
(3580, 'Buraich', 'বুড়াইচ', 'buraichup . faridpur . gov . bd', 1, 391, NULL, NULL, NULL, NULL),
(3581, 'Alfadanga', 'আলফাডাঙ্গা', 'alfadangaup . faridpur . gov . bd', 1, 391, NULL, NULL, NULL, NULL),
(3582, 'Tagarbanda', 'টগরবন্দ', 'tagarbandaup . faridpur . gov . bd', 1, 391, NULL, NULL, NULL, NULL),
(3583, 'Bana', 'বানা', 'banaup . faridpur . gov . bd', 1, 391, NULL, NULL, NULL, NULL),
(3584, 'Panchuria', 'পাঁচুড়িয়া', 'panchuriaup . faridpur . gov . bd', 1, 391, NULL, NULL, NULL, NULL),
(3585, 'Gopalpur', 'গোপালপুর', 'gopalpurup . faridpur . gov . bd', 1, 391, NULL, NULL, NULL, NULL),
(3586, 'Boalmari', 'বোয়ালমারী', 'boalmariup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3587, 'Dadpur', 'দাদপুর', 'dadpurup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3588, 'Chatul', 'চতুল', 'chatulup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3589, 'Ghoshpur', 'ঘোষপুর', 'ghoshpurup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3590, 'Gunbaha', 'গুনবহা', 'gunbahaup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3591, 'Chandpur', 'চাঁদপুর', 'chandpurup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3592, 'Parameshwardi', 'পরমেশ্বরদী', 'parameshwardiup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3593, 'Satair', 'সাতৈর', 'satairup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3594, 'Rupapat', 'রূপাপাত', 'rupapatup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3595, 'Shekhar', 'শেখর', 'shekharup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3596, 'Moyna', 'ময়না', 'moynaup . faridpur . gov . bd', 1, 392, NULL, NULL, NULL, NULL),
(3597, 'Char Bisnopur', 'চর বিষ্ণুপুর', 'charbisnopurup . faridpur . gov . bd', 1, 393, NULL, NULL, NULL, NULL),
(3598, 'Akoter Char', 'আকোটের চর', 'akotercharup . faridpur . gov . bd', 1, 393, NULL, NULL, NULL, NULL),
(3599, 'Char Nasirpur', 'চর নাসিরপুর', 'charnasirpurup . faridpur . gov . bd', 1, 393, NULL, NULL, NULL, NULL),
(3600, 'Narikel Bariya', 'নারিকেল বাড়িয়া', 'narikelbariyaup . faridpur . gov . bd', 1, 393, NULL, NULL, NULL, NULL),
(3601, 'Bhashanchar', 'ভাষানচর', 'bhashancharup . faridpur . gov . bd', 1, 393, NULL, NULL, NULL, NULL),
(3602, 'Krishnapur', 'কৃষ্ণপুর', 'krishnapurup . faridpur . gov . bd', 1, 393, NULL, NULL, NULL, NULL),
(3603, 'Sadarpur', 'সদরপুর', 'sadarpurup . faridpur . gov . bd', 1, 393, NULL, NULL, NULL, NULL),
(3604, 'Char Manair', 'চর মানাইর', 'charmanairup . faridpur . gov . bd', 1, 393, NULL, NULL, NULL, NULL),
(3605, 'Dhaukhali', 'ঢেউখালী', 'dhaukhaliup . faridpur . gov . bd', 1, 393, NULL, NULL, NULL, NULL),
(3606, 'Charjashordi', 'চরযশোরদী', 'charjashordiup . faridpur . gov . bd', 1, 394, NULL, NULL, NULL, NULL),
(3607, 'Purapara', 'পুরাপাড়া', 'puraparaup . faridpur . gov . bd', 1, 394, NULL, NULL, NULL, NULL),
(3608, 'Laskardia', 'লস্করদিয়া', 'laskardiaup . faridpur . gov . bd', 1, 394, NULL, NULL, NULL, NULL),
(3609, 'Ramnagar', 'রামনগর', 'ramnagarup . faridpur . gov . bd', 1, 394, NULL, NULL, NULL, NULL),
(3610, 'Kaichail', 'কাইচাইল', 'kaichailup . faridpur . gov . bd', 1, 394, NULL, NULL, NULL, NULL),
(3611, 'Talma', 'তালমা', 'talmaup . faridpur . gov . bd', 1, 394, NULL, NULL, NULL, NULL),
(3612, 'Fulsuti', 'ফুলসুতি', 'fulsutiup . faridpur . gov . bd', 1, 394, NULL, NULL, NULL, NULL),
(3613, 'Dangi', 'ডাঙ্গী', 'dangiup . faridpur . gov . bd', 1, 394, NULL, NULL, NULL, NULL),
(3614, 'Kodalia Shohidnagar', 'কোদালিয়া শহিদনগর', 'kodaliashohidnagarup . faridpur . gov . bd', 1, 394, NULL, NULL, NULL, NULL),
(3615, 'Gharua', 'ঘারুয়া', 'gharuaup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3616, 'Nurullagonj', 'নুরুল্যাগঞ্জ', 'nurullagonjup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3617, 'Manikdha', 'মানিকদহ', 'manikdhaup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3618, 'Kawlibera', 'কাউলিবেড়া', 'kawliberaup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3619, 'Nasirabad', 'নাছিরাবাদ', 'nasirabadup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3620, 'Tujerpur', 'তুজারপুর', 'tujerpurup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3621, 'Algi', 'আলগী', 'algiup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3622, 'Chumurdi', 'চুমুরদী', 'chumurdiup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3623, 'Kalamridha', 'কালামৃধা', 'kalamridhaup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3624, 'Azimnagor', 'আজিমনগর', 'azimnagorup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3625, 'Chandra', 'চান্দ্রা', 'chandraup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3626, 'Hamirdi', 'হামিরদী', 'hamirdiup . faridpur . gov . bd', 1, 395, NULL, NULL, NULL, NULL),
(3627, 'Gazirtek', 'গাজীরটেক', 'gazirtekup . faridpur . gov . bd', 1, 396, NULL, NULL, NULL, NULL),
(3628, 'Char Bhadrasan', 'চর ভদ্রাসন', 'charbhadrasanup . faridpur . gov . bd', 1, 396, NULL, NULL, NULL, NULL),
(3629, 'Char Harirampur', 'চর হরিরামপুর', 'charharirampurup . faridpur . gov . bd', 1, 396, NULL, NULL, NULL, NULL),
(3630, 'Char Jahukanda', 'চর ঝাউকান্দা', 'charjahukandaup . faridpur . gov . bd', 1, 396, NULL, NULL, NULL, NULL),
(3631, 'Madhukhali', 'মধুখালী', 'madhukhaliup . faridpur . gov . bd', 1, 397, NULL, NULL, NULL, NULL),
(3632, 'Jahapur', 'জাহাপুর', 'jahapurup . faridpur . gov . bd', 1, 397, NULL, NULL, NULL, NULL),
(3633, 'Gazna', 'গাজনা', 'gaznaup . faridpur . gov . bd', 1, 397, NULL, NULL, NULL, NULL),
(3634, 'Megchami', 'মেগচামী', 'megchamiup . faridpur . gov . bd', 1, 397, NULL, NULL, NULL, NULL),
(3635, 'Raipur', 'রায়পুর', 'raipurup . faridpur . gov . bd', 1, 397, NULL, NULL, NULL, NULL),
(3636, 'Bagat', 'বাগাট', 'bagatup . faridpur . gov . bd', 1, 397, NULL, NULL, NULL, NULL),
(3637, 'Dumain', 'ডুমাইন', 'dumainup . faridpur . gov . bd', 1, 397, NULL, NULL, NULL, NULL),
(3638, 'Nowpara', 'নওপাড়া', 'nowparaup . faridpur . gov . bd', 1, 397, NULL, NULL, NULL, NULL),
(3639, 'Kamarkhali', 'কামারখালী', 'kamarkhaliup . faridpur . gov . bd', 1, 397, NULL, NULL, NULL, NULL),
(3640, 'Bhawal', 'ভাওয়াল', 'bhawalup . faridpur . gov . bd', 1, 398, NULL, NULL, NULL, NULL),
(3641, 'Atghar', 'আটঘর', 'atgharup . faridpur . gov . bd', 1, 398, NULL, NULL, NULL, NULL),
(3642, 'Mazadia', 'মাঝারদিয়া', 'mazadiaup . faridpur . gov . bd', 1, 398, NULL, NULL, NULL, NULL),
(3643, 'Ballabhdi', 'বল্লভদী', 'ballabhdiup . faridpur . gov . bd', 1, 398, NULL, NULL, NULL, NULL),
(3644, 'Gatti', 'গট্টি', 'gattiup . faridpur . gov . bd', 1, 398, NULL, NULL, NULL, NULL),
(3645, 'Jadunandi', 'যদুনন্দী', 'jadunandiup . faridpur . gov . bd', 1, 398, NULL, NULL, NULL, NULL),
(3646, 'Ramkantapur', 'রামকান্তপুর', 'ramkantapurup . faridpur . gov . bd', 1, 398, NULL, NULL, NULL, NULL),
(3647, 'Sonapur', 'সোনাপুর', 'sonapurup . faridpur . gov . bd', 1, 398, NULL, NULL, NULL, NULL),
(3648, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 'panchagarhsadarup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3649, 'Satmara', 'সাতমেরা', 'satmaraup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3650, 'Amarkhana', 'অমরখানা', 'amarkhanaup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3651, 'Haribhasa', 'হাড়িভাসা', 'haribhasaup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3652, 'Chaklahat', 'চাকলাহাট', 'chaklahatup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3653, 'Hafizabad', 'হাফিজাবাদ', 'hafizabadup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3654, 'Kamat Kajol Dighi', 'কামাত কাজল দীঘি', 'kamatkajoldighiup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3655, 'Dhakkamara', 'ধাক্কামারা', 'dhakkamaraup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3656, 'Magura', 'মাগুরা', 'maguraup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3657, 'Garinabari', 'গরিনাবাড়ী', 'garinabariup . panchagarh . gov . bd', 1, 399, NULL, NULL, NULL, NULL),
(3658, 'Chilahati', 'চিলাহাটি', 'chilahatiup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3659, 'Shaldanga', 'শালডাঙ্গা', 'shaldangaup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3660, 'Debiganj Sadar', 'দেবীগঞ্জ সদর', 'debiganjsadarup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3661, 'Pamuli', 'পামুলী', 'pamuliup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3662, 'Sundardighi', 'সুন্দরদিঘী', 'sundardighiup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3663, 'Sonahar Mollikadaha', 'সোনাহার মল্লিকাদহ', 'sonaharmollikadahaup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3664, 'Tepriganj', 'টেপ্রীগঞ্জ', 'tepriganjup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3665, 'Dandopal', 'দন্ডপাল', 'dandopalup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3666, 'Debiduba', 'দেবীডুবা', 'debidubaup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3667, 'Chengthi Hazra Danga', 'চেংঠী হাজরা ডাঙ্গা', 'chengthihazradangaup . panchagarh . gov . bd', 1, 400, NULL, NULL, NULL, NULL),
(3668, 'Jholaishal Shiri', 'ঝলইশাল শিরি', 'jholaishalshiriup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3669, 'Moidandighi', 'ময়দান দীঘি', 'moidandighiup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3670, 'Banghari', 'বেংহারী', 'banghariup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3671, 'Kajoldighi Kaligonj', 'কাজলদীঘি কালিগঞ্জ', 'kajoldighikaligonjup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3672, 'Boroshoshi', 'বড়শশী', 'boroshoshiup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3673, 'Chandanbari', 'চন্দনবাড়ী', 'chandanbariup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3674, 'Marea Bamonhat', 'মাড়েয়া বামনহাট', 'mareabamonhatup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3675, 'Boda', 'বোদা', 'bodaup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3676, 'Sakoa', 'সাকোয়া', 'sakoaup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3677, 'Pachpir', 'পাচপীর', 'pachpirup . panchagarh . gov . bd', 1, 401, NULL, NULL, NULL, NULL),
(3678, 'Mirgapur', 'মির্জাপুর', 'mirgapurup . panchagarh . gov . bd', 1, 402, NULL, NULL, NULL, NULL),
(3679, 'Radhanagar', 'রাধানগর', 'radhanagarup . panchagarh . gov . bd', 1, 402, NULL, NULL, NULL, NULL),
(3680, 'Toria', 'তোড়িয়া', 'toriaup . panchagarh . gov . bd', 1, 402, NULL, NULL, NULL, NULL),
(3681, 'Balarampur', 'বলরামপুর', 'balarampurup . panchagarh . gov . bd', 1, 402, NULL, NULL, NULL, NULL),
(3682, 'Alowakhowa', 'আলোয়াখোয়া', 'alowakhowaup . panchagarh . gov . bd', 1, 402, NULL, NULL, NULL, NULL),
(3683, 'Dhamor', 'ধামোর', 'dhamorup . panchagarh . gov . bd', 1, 402, NULL, NULL, NULL, NULL),
(3684, 'Banglabandha', 'বাংলাবান্ধা', 'banglabandhaup . panchagarh . gov . bd', 1, 403, NULL, NULL, NULL, NULL),
(3685, 'Bhojoanpur', 'ভজনপুর', 'bhojoanpurup . panchagarh . gov . bd', 1, 403, NULL, NULL, NULL, NULL),
(3686, 'Bhojoanpur', 'ভজনপুর', 'bhojoanpur . gazipur . gov . bd', 1, 403, NULL, NULL, NULL, NULL),
(3687, 'Buraburi', 'বুড়াবুড়ী', 'buraburi . panchagarh . gov . bd', 1, 403, NULL, NULL, NULL, NULL),
(3688, 'Debnagar', 'দেবনগর', 'debnagarup . panchagarh . gov . bd', 1, 403, NULL, NULL, NULL, NULL),
(3689, 'Salbahan', 'শালবাহান', 'salbahanup . panchagarh . gov . bd', 1, 403, NULL, NULL, NULL, NULL),
(3690, 'Tentulia', 'তেতুলিয়া', 'tentuliaup . panchagarh . gov . bd', 1, 403, NULL, NULL, NULL, NULL),
(3691, 'Timaihat', 'তিমাইহাট', 'timaihat . panchagarh . gov . bd', 1, 403, NULL, NULL, NULL, NULL),
(3692, 'Joypur', 'জয়পুর', 'joypurup . dinajpur . gov . bd', 1, 404, NULL, NULL, NULL, NULL),
(3693, 'Binodnagar', 'বিনোদনগর', 'binodnagarup . dinajpur . gov . bd', 1, 404, NULL, NULL, NULL, NULL),
(3694, 'Golapgonj', 'গোলাপগঞ্জ', 'golapgonjup . dinajpur . gov . bd', 1, 404, NULL, NULL, NULL, NULL),
(3695, 'Shalkhuria', 'শালখুরিয়া', 'shalkhuriaup . dinajpur . gov . bd', 1, 404, NULL, NULL, NULL, NULL),
(3696, 'Putimara', 'পুটিমারা', 'putimaraup . dinajpur . gov . bd', 1, 404, NULL, NULL, NULL, NULL),
(3697, 'Bhaduria', 'ভাদুরিয়া', 'bhaduriaup . dinajpur . gov . bd', 1, 404, NULL, NULL, NULL, NULL),
(3698, 'Daudpur', 'দাউদপুর', 'daudpurup . dinajpur . gov . bd', 1, 404, NULL, NULL, NULL, NULL),
(3699, 'Mahmudpur', 'মাহামুদপুর', 'mahmudpurup . dinajpur . gov . bd', 1, 404, NULL, NULL, NULL, NULL),
(3700, 'Kushdaha', 'কুশদহ', 'kushdahaup . dinajpur . gov . bd', 1, 404, NULL, NULL, NULL, NULL),
(3701, 'Shibrampur', 'শিবরামপুর', 'shibrampurup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3702, 'Polashbari', 'পলাশবাড়ী', 'polashbariup2 . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3703, 'Shatagram', 'শতগ্রাম', 'shatagramup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3704, 'Paltapur', 'পাল্টাপুর', 'paltapurup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3705, 'Sujalpur', 'সুজালপুর', 'sujalpurup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3706, 'Nijpara', 'নিজপাড়া', 'nijparaup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3707, 'Mohammadpur', 'মোহাম্মদপুর', 'mohammadpurup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3708, 'Bhognagar', 'ভোগনগর', 'bhognagarup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3709, 'Sator', 'সাতোর', 'satorup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3710, 'Mohonpur', 'মোহনপুর', 'mohonpurup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3711, 'Moricha', 'মরিচা', 'morichaup . dinajpur . gov . bd', 1, 405, NULL, NULL, NULL, NULL),
(3712, 'Bulakipur', 'বুলাকীপুর', 'bulakipurup . dinajpur . gov . bd', 1, 406, NULL, NULL, NULL, NULL),
(3713, 'Palsha', 'পালশা', 'palshaup . dinajpur . gov . bd', 1, 406, NULL, NULL, NULL, NULL),
(3714, 'Singra', 'সিংড়া', 'singraup . dinajpur . gov . bd', 1, 406, NULL, NULL, NULL, NULL),
(3715, 'Ghoraghat', 'ঘোড়াঘাট', 'ghoraghatup . dinajpur . gov . bd', 1, 406, NULL, NULL, NULL, NULL),
(3716, 'Mukundopur', 'মুকুন্দপুর', 'mukundopurup . dinajpur . gov . bd', 1, 407, NULL, NULL, NULL, NULL),
(3717, 'Katla', 'কাটলা', 'katlaup . dinajpur . gov . bd', 1, 407, NULL, NULL, NULL, NULL),
(3718, 'Khanpur', 'খানপুর', 'khanpurup . dinajpur . gov . bd', 1, 407, NULL, NULL, NULL, NULL),
(3719, 'Dior', 'দিওড়', 'diorup . dinajpur . gov . bd', 1, 407, NULL, NULL, NULL, NULL),
(3720, 'Binail', 'বিনাইল', 'binailup . dinajpur . gov . bd', 1, 407, NULL, NULL, NULL, NULL),
(3721, 'Jatbani', 'জোতবানী', 'jatbaniup . dinajpur . gov . bd', 1, 407, NULL, NULL, NULL, NULL),
(3722, 'Poliproyagpur', 'পলিপ্রয়াগপুর', 'poliproyagpurup . dinajpur . gov . bd', 1, 407, NULL, NULL, NULL, NULL),
(3723, 'Belaichandi', 'বেলাইচন্ডি', 'belaichandiup . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3724, 'Monmothopur', 'মন্মথপুর', 'monmothopurup . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3725, 'Rampur', 'রামপুর', 'rampurup . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3726, 'Polashbari', 'পলাশবাড়ী', 'polashbariup4 . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3727, 'Chandipur', 'চন্ডীপুর', 'chandipurup . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3728, 'Mominpur', 'মোমিনপুর', 'mominpurup . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3729, 'Mostofapur', 'মোস্তফাপুর', 'mostofapurup . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3730, 'Habra', 'হাবড়া', 'habraup . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3731, 'Hamidpur', 'হামিদপুর', 'hamidpurup . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3732, 'Harirampur', 'হরিরামপুর', 'harirampurup . dinajpur . gov . bd', 1, 408, NULL, NULL, NULL, NULL),
(3733, 'Nafanagar', 'নাফানগর', 'nafanagarup . dinajpur . gov . bd', 1, 409, NULL, NULL, NULL, NULL),
(3734, 'Eshania', 'ঈশানিয়া', 'eshaniaup . dinajpur . gov . bd', 1, 409, NULL, NULL, NULL, NULL),
(3735, 'Atgaon', 'আটগাঁও', 'atgaonup . dinajpur . gov . bd', 1, 409, NULL, NULL, NULL, NULL),
(3736, 'Shatail', 'ছাতইল', 'shatailup . dinajpur . gov . bd', 1, 409, NULL, NULL, NULL, NULL),
(3737, 'Rongaon', 'রনগাঁও', 'rongaonup . dinajpur . gov . bd', 1, 409, NULL, NULL, NULL, NULL),
(3738, 'Murshidhat', 'মুর্শিদহাট', 'murshidhatup . dinajpur . gov . bd', 1, 409, NULL, NULL, NULL, NULL),
(3739, 'Dabor', 'ডাবোর', 'daborup . dinajpur . gov . bd', 1, 410, NULL, NULL, NULL, NULL),
(3740, 'Rasulpur', 'রসুলপুর', 'rasulpurup . dinajpur . gov . bd', 1, 410, NULL, NULL, NULL, NULL),
(3741, 'Mukundapur', 'মুকুন্দপুর', 'mukundapurup . dinajpur . gov . bd', 1, 410, NULL, NULL, NULL, NULL),
(3742, 'Targao', 'তারগাঁও', 'targaoup . dinajpur . gov . bd', 1, 410, NULL, NULL, NULL, NULL),
(3743, 'Ramchandrapur', 'রামচন্দ্রপুর', 'ramchandrapurup . dinajpur . gov . bd', 1, 410, NULL, NULL, NULL, NULL),
(3744, 'Sundarpur', 'সুন্দরপুর', 'sundarpurup . dinajpur . gov . bd', 1, 410, NULL, NULL, NULL, NULL),
(3745, 'Aloary', 'এলুয়াড়ী', 'aloaryup . dinajpur . gov . bd', 1, 411, NULL, NULL, NULL, NULL),
(3746, 'Aladipur', 'আলাদিপুর', 'aladipurup . dinajpur . gov . bd', 1, 411, NULL, NULL, NULL, NULL),
(3747, 'Kagihal', 'কাজীহাল', 'kagihalup . dinajpur . gov . bd', 1, 411, NULL, NULL, NULL, NULL),
(3748, 'Bethdighi', 'বেতদিঘী', 'bethdighiup . dinajpur . gov . bd', 1, 411, NULL, NULL, NULL, NULL),
(3749, 'Khairbari', 'খয়েরবাড়ী', 'khairbariup . dinajpur . gov . bd', 1, 411, NULL, NULL, NULL, NULL),
(3750, 'Daulatpur', 'দৌলতপুর', 'daulatpurup . dinajpur . gov . bd', 1, 411, NULL, NULL, NULL, NULL),
(3751, 'Shibnagor', 'শিবনগর', 'shibnagorup . dinajpur . gov . bd', 1, 411, NULL, NULL, NULL, NULL),
(3752, 'Chealgazi', 'চেহেলগাজী', 'chealgaziup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3753, 'Sundorbon', 'সুন্দরবন', 'sundorbonup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3754, 'Fazilpur', 'ফাজিলপুর', 'fazilpurup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3755, 'Shekpura', 'শেখপুরা', 'shekpuraup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3756, 'Shashora', 'শশরা', 'shashoraup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3757, 'Auliapur', 'আউলিয়াপুর', 'auliapurup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3758, 'Uthrail', 'উথরাইল', 'uthrailup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3759, 'Sankarpur', 'শংকরপুর', 'sankarpurup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3760, 'Askorpur', 'আস্করপুর', 'askorpurup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3761, 'Kamalpur', 'কমলপুর', 'kamalpurup . dinajpur . gov . bd', 1, 412, NULL, NULL, NULL, NULL),
(3762, 'Alihat', 'আলীহাট', 'alihatup . dinajpur . gov . bd', 1, 413, NULL, NULL, NULL, NULL),
(3763, 'Khattamadobpara', 'খট্টামাধবপাড়া', 'khattamadobparaup . dinajpur . gov . bd', 1, 413, NULL, NULL, NULL, NULL),
(3764, 'Boalder', 'বোয়ালদার', 'boalderup . dinajpur . gov . bd', 1, 413, NULL, NULL, NULL, NULL),
(3765, 'Alokjhari', 'আলোকঝাড়ী', 'alokjhariup . dinajpur . gov . bd', 1, 414, NULL, NULL, NULL, NULL),
(3766, 'Bherbheri', 'ভেড়ভেড়ী', 'bherbheriup . dinajpur . gov . bd', 1, 414, NULL, NULL, NULL, NULL),
(3767, 'Angarpara', 'আঙ্গারপাড়া', 'angarparaup . dinajpur . gov . bd', 1, 414, NULL, NULL, NULL, NULL),
(3768, 'Goaldihi', 'গোয়ালডিহি', 'goaldihiup . dinajpur . gov . bd', 1, 414, NULL, NULL, NULL, NULL),
(3769, 'Bhabki', 'ভাবকী', 'bhabkiup . dinajpur . gov . bd', 1, 414, NULL, NULL, NULL, NULL),
(3770, 'Khamarpara', 'খামারপাড়া', 'khamarparaup . dinajpur . gov . bd', 1, 414, NULL, NULL, NULL, NULL),
(3771, 'Azimpur', 'আজিমপুর', 'azimpurup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3772, 'Farakkabad', 'ফরাক্কাবাদ', 'farakkabadup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3773, 'Dhamoir', 'ধামইর', 'dhamoirup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3774, 'Shohorgram', 'শহরগ্রাম', 'shohorgramup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3775, 'Birol', 'বিরল', 'birolup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3776, 'Bhandra', 'ভান্ডারা', 'bhandraup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3777, 'Bijora', 'বিজোড়া', 'bijoraup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3778, 'Dharmapur', 'ধর্মপুর', 'dharmapurup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3779, 'Mongalpur', 'মঙ্গলপুর', 'mongalpurup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3780, 'Ranipukur', 'রাণীপুকুর', 'ranipukurup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3781, 'Rajarampur', 'রাজারামপুর', 'rajarampurup . dinajpur . gov . bd', 1, 415, NULL, NULL, NULL, NULL),
(3782, 'Nashratpur', 'নশরতপুর', 'nashratpurup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3783, 'Satnala', 'সাতনালা', 'satnalaup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3784, 'Fatejangpur', 'ফতেজংপুর', 'fatejangpurup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3785, 'Isobpur', 'ইসবপুর', 'isobpurup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3786, 'Abdulpur', 'আব্দুলপুর', 'abdulpurup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3787, 'Amarpur', 'অমরপুর', 'amarpurup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3788, 'Auliapukur', 'আউলিয়াপুকুর', 'auliapukurup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3789, 'Saitara', 'সাইতারা', 'saitaraup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3790, 'Viail', 'ভিয়াইল', 'viailup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3791, 'Punotti', 'পুনট্টি', 'punottiup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3792, 'Tetulia', 'তেতুলিয়া', 'tetuliaup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3793, 'Alokdihi', 'আলোকডিহি', 'alokdihiup . dinajpur . gov . bd', 1, 416, NULL, NULL, NULL, NULL),
(3794, 'Rajpur', 'রাজপুর', 'rajpurup . lalmonirhat . gov . bd', 1, 417, NULL, NULL, NULL, NULL),
(3795, 'Harati', 'হারাটি', 'haratiup . lalmonirhat . gov . bd', 1, 417, NULL, NULL, NULL, NULL),
(3796, 'Mogolhat', 'মোগলহাট', 'mogolhatup . lalmonirhat . gov . bd', 1, 417, NULL, NULL, NULL, NULL),
(3797, 'Gokunda', 'গোকুন্ডা', 'gokundaup . lalmonirhat . gov . bd', 1, 417, NULL, NULL, NULL, NULL),
(3798, 'Barobari', 'বড়বাড়ী', 'barobariup . lalmonirhat . gov . bd', 1, 417, NULL, NULL, NULL, NULL),
(3799, 'Kulaghat', 'কুলাঘাট', 'kulaghatup . lalmonirhat . gov . bd', 1, 417, NULL, NULL, NULL, NULL),
(3800, 'Mohendranagar', 'মহেন্দ্রনগর', 'mohendranagarup . lalmonirhat . gov . bd', 1, 417, NULL, NULL, NULL, NULL),
(3801, 'Khuniagachh', 'খুনিয়াগাছ', 'khuniagachhup . lalmonirhat . gov . bd', 1, 417, NULL, NULL, NULL, NULL),
(3802, 'Panchagram', 'পঞ্চগ্রাম', 'panchagramup . lalmonirhat . gov . bd', 1, 417, NULL, NULL, NULL, NULL),
(3803, 'Bhotmari', 'ভোটমারী', 'bhotmariup . lalmonirhat . gov . bd', 1, 418, NULL, NULL, NULL, NULL),
(3804, 'Modati', 'মদাতী', 'modatiup . lalmonirhat . gov . bd', 1, 418, NULL, NULL, NULL, NULL),
(3805, 'Dologram', 'দলগ্রাম', 'dologramup . lalmonirhat . gov . bd', 1, 418, NULL, NULL, NULL, NULL),
(3806, 'Tushbhandar', 'তুষভান্ডার', 'tushbhandarup . lalmonirhat . gov . bd', 1, 418, NULL, NULL, NULL, NULL),
(3807, 'Goral', 'গোড়ল', 'goralup . lalmonirhat . gov . bd', 1, 418, NULL, NULL, NULL, NULL),
(3808, 'Chondropur', 'চন্দ্রপুর', 'chondropurup . lalmonirhat . gov . bd', 1, 418, NULL, NULL, NULL, NULL),
(3809, 'Cholbola', 'চলবলা', 'cholbolaup . lalmonirhat . gov . bd', 1, 418, NULL, NULL, NULL, NULL),
(3810, 'Kakina', 'কাকিনা', 'kakinaup . lalmonirhat . gov . bd', 1, 418, NULL, NULL, NULL, NULL),
(3811, 'Barokhata', 'বড়খাতা', 'barokhataup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3812, 'Goddimari', 'গড্ডিমারী', 'goddimariup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3813, 'Singimari', 'সিংগীমারী', 'singimariup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3814, 'Tongvhanga', 'টংভাঙ্গা', 'tongvhangaup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3815, 'Sindurna', 'সিন্দুর্ণা', 'sindurnaup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3816, 'Paticapara', 'পাটিকাপাড়া', 'paticaparaup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3817, 'Nowdabas', 'নওদাবাস', 'nowdabasup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3818, 'Gotamari', 'গোতামারী', 'gotamariup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3819, 'Vhelaguri', 'ভেলাগুড়ি', 'vhelaguriup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3820, 'Shaniajan', 'সানিয়াজান', 'shaniajanup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3821, 'Fakirpara', 'ফকিরপাড়া', 'fakirparaup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3822, 'Dawabari', 'ডাউয়াবাড়ী', 'dawabariup . lalmonirhat . gov . bd', 1, 419, NULL, NULL, NULL, NULL),
(3823, 'Sreerampur', 'শ্রীরামপুর', 'sreerampurup . lalmonirhat . gov . bd', 1, 420, NULL, NULL, NULL, NULL),
(3824, 'Patgram', 'পাটগ্রাম', 'patgramup . lalmonirhat . gov . bd', 1, 420, NULL, NULL, NULL, NULL),
(3825, 'Jagatber', 'জগতবেড়', 'jagatberup . lalmonirhat . gov . bd', 1, 420, NULL, NULL, NULL, NULL),
(3826, 'Kuchlibari', 'কুচলিবাড়ী', 'kuchlibariup . lalmonirhat . gov . bd', 1, 420, NULL, NULL, NULL, NULL),
(3827, 'Jongra', 'জোংড়া', 'jongraup . lalmonirhat . gov . bd', 1, 420, NULL, NULL, NULL, NULL),
(3828, 'Baura', 'বাউড়া', 'bauraup . lalmonirhat . gov . bd', 1, 420, NULL, NULL, NULL, NULL),
(3829, 'Dahagram', 'দহগ্রাম', 'dahagramup . lalmonirhat . gov . bd', 1, 420, NULL, NULL, NULL, NULL),
(3830, 'Burimari', 'বুড়িমারী', 'burimariup . lalmonirhat . gov . bd', 1, 420, NULL, NULL, NULL, NULL),
(3831, 'Bhelabari', 'ভেলাবাড়ী', 'bhelabariup . lalmonirhat . gov . bd', 1, 421, NULL, NULL, NULL, NULL),
(3832, 'Bhadai', 'ভাদাই', 'bhadaiup . lalmonirhat . gov . bd', 1, 421, NULL, NULL, NULL, NULL),
(3833, 'Kamlabari', 'কমলাবাড়ী', 'kamlabariup . lalmonirhat . gov . bd', 1, 421, NULL, NULL, NULL, NULL),
(3834, 'Durgapur', 'দূর্গাপুর', 'durgapurup . lalmonirhat . gov . bd', 1, 421, NULL, NULL, NULL, NULL),
(3835, 'Sarpukur', 'সারপুকুর', 'sarpukurup . lalmonirhat . gov . bd', 1, 421, NULL, NULL, NULL, NULL),
(3836, 'Saptibari', 'সাপ্টিবাড়ী', 'saptibariup . lalmonirhat . gov . bd', 1, 421, NULL, NULL, NULL, NULL),
(3837, 'Palashi', 'পলাশী', 'palashiup . lalmonirhat . gov . bd', 1, 421, NULL, NULL, NULL, NULL),
(3838, 'Mohishkhocha', 'মহিষখোচা', 'mohishkhochaup . lalmonirhat . gov . bd', 1, 421, NULL, NULL, NULL, NULL),
(3839, 'Kamarpukur', 'কামারপুকুর', 'kamarpukurup . nilphamari . gov . bd', 1, 422, NULL, NULL, NULL, NULL),
(3840, 'Kasiram Belpukur', 'কাশিরাম বেলপুকুর', 'kasirambelpukurup . nilphamari . gov . bd', 1, 422, NULL, NULL, NULL, NULL),
(3841, 'Bangalipur', 'বাঙ্গালীপুর', 'bangalipur . nilphamari . gov . bd', 1, 422, NULL, NULL, NULL, NULL),
(3842, 'Botlagari', 'বোতলাগাড়ী', 'botlagariup . nilphamari . gov . bd', 1, 422, NULL, NULL, NULL, NULL),
(3843, 'Khata Madhupur', 'খাতা মধুপুর', 'khatamadhupurup . nilphamari . gov . bd', 1, 422, NULL, NULL, NULL, NULL),
(3844, 'Gomnati', 'গোমনাতি', 'gomnati . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3845, 'Bhogdaburi', 'ভোগডাবুড়ী', 'bhogdaburiup . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3846, 'Ketkibari', 'কেতকীবাড়ী', 'ketkibariup . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3847, 'Jorabari', 'জোড়াবাড়ী', 'jorabariup . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3848, 'Bamunia', 'বামুনীয়া', 'bamuniaup . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3849, 'Panga Motukpur', 'পাংগা মটকপুর', 'pangamotukpurup . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3850, 'Boragari', 'বোড়াগাড়ী', 'boragariup . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3851, 'Domar', 'ডোমার', 'domarup . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3852, 'Sonaray', 'সোনারায়', 'sonarayup2 . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3853, 'Harinchara', 'হরিণচরা', 'harincharaup . nilphamari . gov . bd', 1, 423, NULL, NULL, NULL, NULL),
(3854, 'Paschim Chhatnay', 'পশ্চিম ছাতনাই', 'paschimchhatnayup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3855, 'Balapara', 'বালাপাড়া', 'balaparaup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3856, 'Dimla Sadar', 'ডিমলা সদর', 'dimlasadarup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3857, 'Khogakharibari', 'খগা খড়িবাড়ী', 'khogakharibariup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3858, 'Gayabari', 'গয়াবাড়ী', 'gayabariup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3859, 'Noutara', 'নাউতারা', 'noutaraup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3860, 'Khalisha Chapani', 'খালিশা চাপানী', 'khalishachapaniup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3861, 'Jhunagach Chapani', 'ঝুনাগাছ চাপানী', 'jhunagachhchapaniup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3862, 'Tepa Khribari', 'টেপা খরীবাড়ী', 'tepakhribariup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3863, 'Purba Chhatnay', 'পুর্ব ছাতনাই', 'purbachhatnayup . nilphamari . gov . bd', 1, 424, NULL, NULL, NULL, NULL),
(3864, 'Douabari', 'ডাউয়াবাড়ী', 'douabariup . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3865, 'Golmunda', 'গোলমুন্ডা', 'golmunda . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3866, 'Balagram', 'বালাগ্রাম', 'balagram . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3867, 'Golna', 'গোলনা', 'golna . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3868, 'Dharmapal', 'ধর্মপাল', 'dharmapal . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3869, 'Simulbari', 'শিমুলবাড়ী', 'simulbari . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3870, 'Mirganj', 'মীরগঞ্জ', 'mirganj . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3871, 'Kathali', 'কাঠালী', 'kathaliup . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3872, 'Khutamara', 'খুটামারা', 'khutamaraup . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3873, 'Shaulmari', 'শৌলমারী', 'shaulmariup . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3874, 'Kaimari', 'কৈমারী', 'kaimariup . nilphamari . gov . bd', 1, 425, NULL, NULL, NULL, NULL),
(3875, 'Barabhita', 'বড়ভিটা', 'barabhitaup . nilphamari . gov . bd', 1, 426, NULL, NULL, NULL, NULL),
(3876, 'Putimari', 'পুটিমারী', 'putimariup . nilphamari . gov . bd', 1, 426, NULL, NULL, NULL, NULL),
(3877, 'Nitai', 'নিতাই', 'nitaiup . nilphamari . gov . bd', 1, 426, NULL, NULL, NULL, NULL),
(3878, 'Bahagili', 'বাহাগিলি', 'bahagiliup . nilphamari . gov . bd', 1, 426, NULL, NULL, NULL, NULL),
(3879, 'Chandkhana', 'চাঁদখানা', 'chandkhanaup . nilphamari . gov . bd', 1, 426, NULL, NULL, NULL, NULL),
(3880, 'Kishoreganj', 'কিশোরগঞ্জ', 'kishoreganjup . nilphamari . gov . bd', 1, 426, NULL, NULL, NULL, NULL),
(3881, 'Ranachandi', 'রনচন্ডি', 'ranachandiup . nilphamari . gov . bd', 1, 426, NULL, NULL, NULL, NULL),
(3882, 'Garagram', 'গাড়াগ্রাম', 'garagramup . nilphamari . gov . bd', 1, 426, NULL, NULL, NULL, NULL),
(3883, 'Magura', 'মাগুরা', 'maguraup . nilphamari . gov . bd', 1, 426, NULL, NULL, NULL, NULL),
(3884, 'Chaora Bargacha', 'চওড়া বড়গাছা', 'chaorabargachaup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3885, 'Gorgram', 'গোড়গ্রাম', 'gorgramup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3886, 'Khoksabari', 'খোকসাবাড়ী', 'khoksabariup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3887, 'Palasbari', 'পলাশবাড়ী', 'palasbariup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3888, 'Ramnagar', 'রামনগর', 'ramnagarup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3889, 'Kachukata', 'কচুকাটা', 'kachukataup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3890, 'Panchapukur', 'পঞ্চপুকুর', 'panchapukurup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3891, 'Itakhola', 'ইটাখোলা', 'itakholaup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3892, 'Kundapukur', 'কুন্দপুকুর', 'kundapukur . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3893, 'Sonaray', 'সোনারায়', 'sonaray . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3894, 'Songalsi', 'সংগলশী', 'songalsiup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3895, 'Charaikhola', 'চড়াইখোলা', 'charaikhola . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3896, 'Chapra Sarnjami', 'চাপড়া সরঞ্জানী', 'chaprasarnjami . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3897, 'Lakshmicha', 'লক্ষ্মীচাপ', 'lakshmichapup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3898, 'Tupamari', 'টুপামারী', 'tupamariup . nilphamari . gov . bd', 1, 427, NULL, NULL, NULL, NULL),
(3899, 'Rasulpur', 'রসুলপুর', 'rasulpurup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3900, 'Noldanga', 'নলডাঙ্গা', 'noldangaup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3901, 'Damodorpur', 'দামোদরপুর', 'damodorpurup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3902, 'Jamalpur', 'জামালপুর', 'jamalpurup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3903, 'Faridpur', 'ফরিদপুর', 'faridpurup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3904, 'Dhaperhat', 'ধাপেরহাট', 'dhaperhatup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3905, 'Idilpur', 'ইদিলপুর', 'idilpurup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3906, 'Vatgram', 'ভাতগ্রাম', 'vatgramup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3907, 'Bongram', 'বনগ্রাম', 'bongramup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3908, 'Kamarpara', 'কামারপাড়া', 'kamarparaup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3909, 'Khodkomor', 'খোদকোমরপুর', 'khodkomorup . gaibandha . gov . bd', 1, 428, NULL, NULL, NULL, NULL),
(3910, 'Laxmipur', 'লক্ষ্মীপুর', 'laxmipurup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3911, 'Malibari', 'মালীবাড়ী', 'malibariup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3912, 'Kuptola', 'কুপতলা', 'kuptolaup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3913, 'Shahapara', 'সাহাপাড়া', 'shahaparaup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3914, 'Ballamjhar', 'বল্লমঝাড়', 'ballamjharup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3915, 'Ramchandrapur', 'রামচন্দ্রপুর', 'ramchandrapurup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3916, 'Badiakhali', 'বাদিয়াখালী', 'badiakhaliup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3917, 'Boali', 'বোয়ালী', 'boaliup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3918, 'Ghagoa', 'ঘাগোয়া', 'ghagoaup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3919, 'Gidari', 'গিদারী', 'gidariup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3920, 'Kholahati', 'খোলাহাটী', 'kholahatiup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3921, 'Mollarchar', 'মোল্লারচর', 'mollarcharup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3922, 'Kamarjani', 'কামারজানি', 'kamarjaniup . gaibandha . gov . bd', 1, 429, NULL, NULL, NULL, NULL),
(3923, 'Kishoregari', 'কিশোরগাড়ী', 'kishoregariup . gaibandha . gov . bd', 1, 430, NULL, NULL, NULL, NULL),
(3924, 'Hosenpur', 'হোসেনপুর', 'hosenpurup . gaibandha . gov . bd', 1, 430, NULL, NULL, NULL, NULL),
(3925, 'Palashbari', 'পলাশবাড়ী', 'palashbariup . gaibandha . gov . bd', 1, 430, NULL, NULL, NULL, NULL),
(3926, 'Barisal', 'বরিশাল', 'barisalup . gaibandha . gov . bd', 1, 430, NULL, NULL, NULL, NULL),
(3927, 'Mohdipur', 'মহদীপুর', 'mohdipurup . gaibandha . gov . bd', 1, 430, NULL, NULL, NULL, NULL),
(3928, 'Betkapa', 'বেতকাপা', 'betkapaup . gaibandha . gov . bd', 1, 430, NULL, NULL, NULL, NULL),
(3929, 'Pobnapur', 'পবনাপুর', 'pobnapurup . gaibandha . gov . bd', 1, 430, NULL, NULL, NULL, NULL),
(3930, 'Monohorpur', 'মনোহরপুর', 'monohorpurup . gaibandha . gov . bd', 1, 430, NULL, NULL, NULL, NULL),
(3931, 'Harinathpur', 'হরিণাথপুর', 'harinathpurup . gaibandha . gov . bd', 1, 430, NULL, NULL, NULL, NULL),
(3932, 'Padumsahar', 'পদুমশহর', 'padumsaharup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3933, 'Varotkhali', 'ভরতখালী', 'varotkhaliup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3934, 'Saghata', 'সাঘাটা', 'saghataup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3935, 'Muktinagar', 'মুক্তিনগর', 'muktinagarup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3936, 'Kachua', 'কচুয়া', 'kachuaup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3937, 'Ghuridah', 'ঘুরিদহ', 'ghuridahup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3938, 'Holdia', 'হলদিয়া', 'holdiaup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3939, 'Jumarbari', 'জুমারবাড়ী', 'jumarbariup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3940, 'Kamalerpara', 'কামালেরপাড়া', 'kamalerparaup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3941, 'Bonarpara', 'বোনারপাড়া', 'bonarparaup . gaibandha . gov . bd', 1, 431, NULL, NULL, NULL, NULL),
(3942, 'Kamdia', 'কামদিয়া', 'kamdiaup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3943, 'Katabari', 'কাটাবাড়ী', 'katabariup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3944, 'Shakhahar', 'শাখাহার', 'shakhaharup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3945, 'Rajahar', 'রাজাহার', 'rajaharup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3946, 'Sapmara', 'সাপমারা', 'sapmaraup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3947, 'Dorbosto', 'দরবস্ত ইয়নিয়ন', 'dorbostoup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3948, 'Talukkanupur', 'তালুককানুপুর', 'talukkanupurup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3949, 'Nakai', 'নাকাই', 'nakaiup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3950, 'Harirampur', 'হরিরামপুর', 'harirampurup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3951, 'Rakhalburuj', 'রাখালবুরুজ', 'rakhalburujup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3952, 'Phulbari', 'ফুলবাড়ী', 'phulbariup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3953, 'Gumaniganj', 'গুমানীগঞ্জ', 'gumaniganjup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3954, 'Kamardoho', 'কামারদহ', 'kamardohoup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3955, 'Kochasahar', 'কোচাশহর', 'kochasaharup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3956, 'Shibpur', 'শিবপুর', 'shibpurup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3957, 'Mahimaganj', 'মহিমাগঞ্জ', 'mahimaganjup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3958, 'Shalmara', 'শালমারা', 'shalmaraup . gaibandha . gov . bd', 1, 432, NULL, NULL, NULL, NULL),
(3959, 'Bamondanga', 'বামনডাঙ্গা', 'bamondangaup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3960, 'Sonaroy', 'সোনারায়', 'sonaroyup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3961, 'Tarapur', 'তারাপুর', 'tarapurup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3962, 'Belka', 'বেলকা', 'belkaup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3963, 'Dohbond', 'দহবন্দ', 'dohbondup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3964, 'Sorbanondo', 'সর্বানন্দ', 'sorbanondoup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3965, 'Ramjibon', 'রামজীবন', 'ramjibonup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3966, 'Dhopadanga', 'ধোপাডাঙ্গা', 'dhopadangaup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3967, 'Chaporhati', 'ছাপরহাটী', 'chaporhatiup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3968, 'Shantiram', 'শান্তিরাম', 'shantiramup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3969, 'Konchibari', 'কঞ্চিবাড়ী', 'konchibariup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3970, 'Sreepur', 'শ্রীপুর', 'sreepurup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3971, 'Chandipur', 'চন্ডিপুর', 'chandipurup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3972, 'Kapasia', 'কাপাসিয়া', 'kapasiaup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3973, 'Haripur', 'হরিপুর', 'haripurup . gaibandha . gov . bd', 1, 433, NULL, NULL, NULL, NULL),
(3974, 'Kanchipara', 'কঞ্চিপাড়া', 'kanchiparaup . gaibandha . gov . bd', 1, 434, NULL, NULL, NULL, NULL),
(3975, 'Uria', 'উড়িয়া', 'uriaup . gaibandha . gov . bd', 1, 434, NULL, NULL, NULL, NULL),
(3976, 'Udakhali', 'উদাখালী', 'udakhaliup . gaibandha . gov . bd', 1, 434, NULL, NULL, NULL, NULL),
(3977, 'Gazaria', 'গজারিয়া', 'gazariaup . gaibandha . gov . bd', 1, 434, NULL, NULL, NULL, NULL),
(3978, 'Phulchari', 'ফুলছড়ি', 'phulchariup . gaibandha . gov . bd', 1, 434, NULL, NULL, NULL, NULL),
(3979, 'Erendabari', 'এরেন্ডাবাড়ী', 'erendabariup . gaibandha . gov . bd', 1, 434, NULL, NULL, NULL, NULL),
(3980, 'Fazlupur', 'ফজলুপুর', 'fazlupurup . gaibandha . gov . bd', 1, 434, NULL, NULL, NULL, NULL),
(3981, 'Ruhea', 'রুহিয়া', 'ruheaup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3982, 'Akhanagar', 'আখানগর', 'akhanagarup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3983, 'Ahcha', 'আকচা', 'ahchaup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3984, 'Baragaon', 'বড়গাঁও', 'baragaonup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3985, 'Balia', 'বালিয়া', 'baliaup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3986, 'Auliapur', 'আউলিয়াপুর', 'auliapurup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3987, 'Chilarang', 'চিলারং', 'chilarangup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3988, 'Rahimanpur', 'রহিমানপুর', 'rahimanpurup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3989, 'Roypur', 'রায়পুর', 'roypurup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3990, 'Jamalpur', 'জামালপুর', 'jamalpurup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3991, 'Mohammadpur', 'মোহাম্মদপুর', 'mohammadpurup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3992, 'Salandar', 'সালন্দর', 'salandarup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3993, 'Gareya', 'গড়েয়া', 'gareyaup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3994, 'Rajagaon', 'রাজাগাঁও', 'rajagaonup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3995, 'Debipur', 'দেবীপুর', 'debipurup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3996, 'Nargun', 'নারগুন', 'nargunup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3997, 'Jagannathpur', 'জগন্নাথপুর', 'jagannathpurup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3998, 'Sukhanpukhari', 'শুখানপুকুরী', 'sukhanpukhariup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(3999, 'Begunbari', 'বেগুনবাড়ী', 'begunbariup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(4000, 'Ruhia Pashchim', 'রুহিয়া পশ্চিম', 'ruhiapashchimup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(4001, 'Dholarhat', 'ঢোলারহাট', 'dholarhatup . thakurgaon . gov . bd', 1, 435, NULL, NULL, NULL, NULL),
(4002, 'Bhomradaha', 'ভোমরাদহ', 'bhomradahaup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL),
(4003, 'Kosharaniganj', 'কোষারাণীগঞ্জ', 'kosharaniganjup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL),
(4004, 'Khangaon', 'খনগাঁও', 'khangaonup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL),
(4005, 'Saidpur', 'সৈয়দপুর', 'saidpurup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL),
(4006, 'Pirganj', 'পীরগঞ্জ', 'pirganjup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL),
(4007, 'Hajipur', 'হাজীপুর', 'hajipurup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL),
(4008, 'Daulatpur', 'দৌলতপুর', 'daulatpurup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL),
(4009, 'Sengaon', 'সেনগাঁও', 'sengaonup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL);
INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(4010, 'Jabarhat', 'জাবরহাট', 'jabarhatup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL),
(4011, 'Bairchuna', 'বৈরচুনা', 'bairchunaup . thakurgaon . gov . bd', 1, 436, NULL, NULL, NULL, NULL),
(4012, 'Dhormogarh', 'ধর্মগড়', 'dhormogarhup . thakurgaon . gov . bd', 1, 437, NULL, NULL, NULL, NULL),
(4013, 'Nekmorod', 'নেকমরদ', 'nekmorodup . thakurgaon . gov . bd', 1, 437, NULL, NULL, NULL, NULL),
(4014, 'Hosengaon', 'হোসেনগাঁও', 'hosengaonup . thakurgaon . gov . bd', 1, 437, NULL, NULL, NULL, NULL),
(4015, 'Lehemba', 'লেহেম্বা', 'lehembaup . thakurgaon . gov . bd', 1, 437, NULL, NULL, NULL, NULL),
(4016, 'Bachor', 'বাচোর', 'bachorup . thakurgaon . gov . bd', 1, 437, NULL, NULL, NULL, NULL),
(4017, 'Kashipur', 'কাশিপুর', 'kashipurup . thakurgaon . gov . bd', 1, 437, NULL, NULL, NULL, NULL),
(4018, 'Ratore', 'রাতোর', 'ratoreup . thakurgaon . gov . bd', 1, 437, NULL, NULL, NULL, NULL),
(4019, 'Nonduar', 'নন্দুয়ার', 'nonduarup . thakurgaon . gov . bd', 1, 437, NULL, NULL, NULL, NULL),
(4020, 'Gedura', 'গেদুড়া', 'geduraup . thakurgaon . gov . bd', 1, 438, NULL, NULL, NULL, NULL),
(4021, 'Amgaon', 'আমগাঁও', 'amgaonup . thakurgaon . gov . bd', 1, 438, NULL, NULL, NULL, NULL),
(4022, 'Bakua', 'বকুয়া', 'bakuaup . thakurgaon . gov . bd', 1, 438, NULL, NULL, NULL, NULL),
(4023, 'Dangipara', 'ডাঙ্গীপাড়া', 'dangiparaup . thakurgaon . gov . bd', 1, 438, NULL, NULL, NULL, NULL),
(4024, 'Haripur', 'হরিপুর', 'haripurup . thakurgaon . gov . bd', 1, 438, NULL, NULL, NULL, NULL),
(4025, 'Bhaturia', 'ভাতুরিয়া', 'bhaturiaup . thakurgaon . gov . bd', 1, 438, NULL, NULL, NULL, NULL),
(4026, 'Paria', 'পাড়িয়া', 'pariaup . thakurgaon . gov . bd', 1, 439, NULL, NULL, NULL, NULL),
(4027, 'Charol', 'চারোল', 'charolup . thakurgaon . gov . bd', 1, 439, NULL, NULL, NULL, NULL),
(4028, 'Dhontola', 'ধনতলা', 'dhontolaup . thakurgaon . gov . bd', 1, 439, NULL, NULL, NULL, NULL),
(4029, 'Boropalashbari', 'বড়পলাশবাড়ী', 'boropalashbariup . thakurgaon . gov . bd', 1, 439, NULL, NULL, NULL, NULL),
(4030, 'Duosuo', 'দুওসুও', 'duosuoup . thakurgaon . gov . bd', 1, 439, NULL, NULL, NULL, NULL),
(4031, 'Vanor', 'ভানোর', 'vanorup . thakurgaon . gov . bd', 1, 439, NULL, NULL, NULL, NULL),
(4032, 'Amjankhore', 'আমজানখোর', 'amjankhoreup . thakurgaon . gov . bd', 1, 439, NULL, NULL, NULL, NULL),
(4033, 'Borobari', 'বড়বাড়ী', 'borobariup . thakurgaon . gov . bd', 1, 439, NULL, NULL, NULL, NULL),
(4034, 'Mominpur', 'মমিনপুর', 'mominpurup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4035, 'Horidebpur', 'হরিদেবপুর', 'horidebpurup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4036, 'Uttam', 'উত্তম', 'uttamup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4037, 'Porshuram', 'পরশুরাম', 'porshuramup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4038, 'Topodhan', 'তপোধন', 'topodhanup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4039, 'Satgara', 'সাতগারা', 'satgaraup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4040, 'Rajendrapur', 'রাজেন্দ্রপুর', 'rajendrapurup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4041, 'Sadwapuskoroni', 'সদ্যপুস্করনী', 'sadwapuskoroniup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4042, 'Chandanpat', 'চন্দনপাট', 'chandanpatup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4043, 'Dorshona', 'দর্শানা', 'dorshonaup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4044, 'Tampat', 'তামপাট', 'tampatup . rangpur . gov . bd', 1, 440, NULL, NULL, NULL, NULL),
(4045, 'Betgari', 'বেতগাড়ী', 'betgariup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4046, 'Kholeya', 'খলেয়া', 'kholeyaup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4047, 'Borobil', 'বড়বিল', 'borobilup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4048, 'Kolcondo', 'কোলকোন্দ', 'kolcondoup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4049, 'Gongachora', 'গংগাচড়া', 'gongachoraup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4050, 'Gojoghonta', 'গজঘন্টা', 'gojoghontaup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4051, 'Morneya', 'মর্ণেয়া', 'morneyaup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4052, 'Alambiditor', 'আলমবিদিতর', 'alambiditorup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4053, 'Lakkhitari', 'লক্ষীটারী', 'lakkhitariup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4054, 'Nohali', 'নোহালী', 'nohaliup . rangpur . gov . bd', 1, 441, NULL, NULL, NULL, NULL),
(4055, 'Kurshatara', 'কুর্শা', 'kurshataraup . rangpur . gov . bd', 1, 442, NULL, NULL, NULL, NULL),
(4056, 'Alampur', 'আলমপুর', 'alampurup . rangpur . gov . bd', 1, 442, NULL, NULL, NULL, NULL),
(4057, 'Soyar', 'সয়ার', 'soyarup . rangpur . gov . bd', 1, 442, NULL, NULL, NULL, NULL),
(4058, 'Ikorchali', 'ইকরচালী', 'ikorchaliup . rangpur . gov . bd', 1, 442, NULL, NULL, NULL, NULL),
(4059, 'Hariarkuthi', 'হাড়িয়ারকুঠি', 'hariarkuthiup . rangpur . gov . bd', 1, 442, NULL, NULL, NULL, NULL),
(4060, 'Radhanagar', 'রাধানগর', 'radhanagarup . rangpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4061, 'Gopinathpur', 'গোপীনাথপুর', 'gopinathpurup . rangpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4062, 'Modhupur', 'মধুপুর', 'modhupurup . rangpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4063, 'Kutubpur', 'কুতুবপুর', 'kutubpurup . ranpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4064, 'Bishnapur', 'বিষ্ণপুর', 'bishnapurup . rangpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4065, 'Kalupara', 'কালুপাড়া', 'kaluparaup . rangpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4066, 'Lohanipara', 'লোহানীপাড়া', 'lohaniparaup . rangpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4067, 'Gopalpur', 'গোপালপুর', 'gopalpurup . rangpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4068, 'Damodorpur', 'দামোদরপুর', 'damodorpurup . rangpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4069, 'Ramnathpurupb', 'রামনাথপুর', 'ramnathpurupb . rangpur . gov . bd', 1, 443, NULL, NULL, NULL, NULL),
(4070, 'Khoragach', 'খোরাগাছ', 'khoragachup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4071, 'Ranipukur', 'রাণীপুকুর', 'ranipukurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4072, 'Payrabond', 'পায়রাবন্দ', 'payrabondup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4073, 'Vangni', 'ভাংনী', 'vangniup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4074, 'Balarhat', 'বালারহাট', 'balarhatup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4075, 'Kafrikhal', 'কাফ্রিখাল', 'kafrikhalup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4076, 'Latibpur', 'লতিবপুর', 'latibpurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4077, 'Chengmari', 'চেংমারী', 'chengmariup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4078, 'Moyenpur', 'ময়েনপুর', 'moyenpurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4079, 'Baluya Masimpur', 'বালুয়া মাসিমপুর', 'baluyamasimpurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4080, 'Borobala', 'বড়বালা', 'borobalaup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4081, 'Mirzapur', 'মির্জাপুর', 'mirzapurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4082, 'Imadpur', 'ইমাদপুর', 'imadpurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4083, 'Milonpur', 'মিলনপুর', 'milonpurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4084, 'Mgopalpur', 'গোপালপুর', 'mgopalpurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4085, 'Durgapur', 'দূর্গাপুর', 'durgapurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4086, 'Boro Hazratpur', 'বড় হযরতপুর', 'borohazratpurup . rangpur . gov . bd', 1, 444, NULL, NULL, NULL, NULL),
(4087, 'Chattracol', 'চৈত্রকোল', 'chattracolup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4088, 'Vendabari', 'ভেন্ডাবাড়ী', 'vendabariup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4089, 'Borodargah', 'বড়দরগাহ', 'borodargahup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4090, 'Kumedpur', 'কুমেদপুর', 'kumedpurup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4091, 'Modankhali', 'মদনখালী', 'modankhaliup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4092, 'Tukuria', 'টুকুরিয়া', 'tukuriaup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4093, 'Boro Alampur', 'বড় আলমপুর', 'boroalampurup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4094, 'Raypur', 'রায়পুর', 'raypurup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4095, 'Pirgonj', 'পীরগঞ্জ', 'pirgonjup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4096, 'Shanerhat', 'শানেরহাট', 'shanerhatup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4097, 'Mithipur', 'মিঠিপুর', 'mithipurup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4098, 'Ramnathpur', 'রামনাথপুর', 'ramnathpurup1 . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4099, 'Chattra', 'চতরা', 'chattraup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4100, 'Kabilpur', 'কাবিলপুর', 'kabilpurup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4101, 'Pachgachi', 'পাঁচগাছী', 'pachgachiup . rangpur . gov . bd', 1, 445, NULL, NULL, NULL, NULL),
(4102, 'Sarai', 'সারাই', 'saraiup . rangpur . gov . bd', 1, 446, NULL, NULL, NULL, NULL),
(4103, 'Balapara', 'বালাপাড়া', 'balaparaup . rangpur . gov . bd', 1, 446, NULL, NULL, NULL, NULL),
(4104, 'Shahidbag', 'শহীদবাগ', 'shahidbagup . rangpur . gov . bd', 1, 446, NULL, NULL, NULL, NULL),
(4105, 'Haragach', 'হারাগাছ', 'haragachup . rangpur . gov . bd', 1, 446, NULL, NULL, NULL, NULL),
(4106, 'Tepamodhupur', 'টেপামধুপুর', 'tepamodhupurup . rangpur . gov . bd', 1, 446, NULL, NULL, NULL, NULL),
(4107, 'Kurshaupk', 'কুর্শা', 'kurshaupk . rangpur . gov . bd', 1, 446, NULL, NULL, NULL, NULL),
(4108, 'Kollyani', 'কল্যাণী', 'kollyaniup . rangpur . gov . bd', 1, 447, NULL, NULL, NULL, NULL),
(4109, 'Parul', 'পারুল', 'parulup . rangpur . gov . bd', 1, 447, NULL, NULL, NULL, NULL),
(4110, 'Itakumari', 'ইটাকুমারী', 'itakumariup . rangpur . gov . bd', 1, 447, NULL, NULL, NULL, NULL),
(4111, 'Saula', 'ছাওলা', 'saulaup . rangpur . gov . bd', 1, 447, NULL, NULL, NULL, NULL),
(4112, 'Kandi', 'কান্দি', 'kandiup . rangpur . gov . bd', 1, 447, NULL, NULL, NULL, NULL),
(4113, 'Pirgacha', 'পীরগাছা', 'pirgachaup . rangpur . gov . bd', 1, 447, NULL, NULL, NULL, NULL),
(4114, 'Annodanagar', 'অন্নদানগর', 'annodanagarup . rangpur . gov . bd', 1, 447, NULL, NULL, NULL, NULL),
(4115, 'Tambulpur', 'তাম্বুলপুর', 'tambulpurup . rangpur . gov . bd', 1, 447, NULL, NULL, NULL, NULL),
(4116, 'Koikuri', 'কৈকুড়ী', 'koikuriup . rangpur . gov . bd', 1, 447, NULL, NULL, NULL, NULL),
(4117, 'Holokhana', 'হলোখানা', 'holokhanaup . kurigram . gov . bd', 1, 448, NULL, NULL, NULL, NULL),
(4118, 'Ghogadhoh', 'ঘোগাদহ', 'ghogadhohup . kurigram . gov . bd', 1, 448, NULL, NULL, NULL, NULL),
(4119, 'Belgacha', 'বেলগাছা', 'belgachaup . kurigram . gov . bd', 1, 448, NULL, NULL, NULL, NULL),
(4120, 'Mogolbasa', 'মোগলবাসা', 'mogolbasaup . kurigram . gov . bd', 1, 448, NULL, NULL, NULL, NULL),
(4121, 'Panchgachi', 'পাঁচগাছি', 'panchgachiup . kurigram . gov . bd', 1, 448, NULL, NULL, NULL, NULL),
(4122, 'Jatrapur', 'যাত্রাপুর', 'jatrapurup . kurigram . gov . bd', 1, 448, NULL, NULL, NULL, NULL),
(4123, 'Kanthalbari', 'কাঁঠালবাড়ী', 'kanthalbariup . kurigram . gov . bd', 1, 448, NULL, NULL, NULL, NULL),
(4124, 'Bhogdanga', 'ভোগডাঙ্গা', 'bhogdangaup . kurigram . gov . bd', 1, 448, NULL, NULL, NULL, NULL),
(4125, 'Ramkhana', 'রামখানা', 'ramkhanaup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4126, 'Raigonj', 'রায়গঞ্জ', 'raigonjup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4127, 'Bamondanga', 'বামনডাঙ্গা', 'bamondangaup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4128, 'Berubari', 'বেরুবাড়ী', 'berubariup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4129, 'Sontaspur', 'সন্তোষপুর', 'sontaspurup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4130, 'Hasnabad', 'হাসনাবাদ', 'hasnabadup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4131, 'Newyashi', 'নেওয়াশী', 'newyashiup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4132, 'Bhitorbond', 'ভিতরবন্দ', 'bhitorbondup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4133, 'Kaligonj', 'কালীগঞ্জ', 'kaligonjup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4134, 'Noonkhawa', 'নুনখাওয়া', 'noonkhawaup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4135, 'Narayanpur', 'নারায়নপুর', 'narayanpurup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4136, 'Kedar', 'কেদার', 'kedarup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4137, 'Kachakata', 'কঁচাকাঁটা', 'kachakataup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4138, 'Bollobherkhas', 'বল্লভেরখাস', 'bollobherkhasup . kurigram . gov . bd', 1, 449, NULL, NULL, NULL, NULL),
(4139, 'Pathordubi', 'পাথরডুবি', 'pathordubiup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4140, 'Shilkhuri', 'শিলখুড়ি', 'shilkhuriup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4141, 'Tilai', 'তিলাই', 'tilaiup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4142, 'Paikarchara', 'পাইকেরছড়া', 'paikarcharaup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4143, 'Bhurungamari', 'ভূরুঙ্গামারী', 'bhurungamariup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4144, 'Joymonirhat', 'জয়মনিরহাট', 'joymonirhatup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4145, 'Andharirjhar', 'আন্ধারীরঝাড়', 'andharirjharup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4146, 'Char - Bhurungamari', 'চর - ভূরুঙ্গামারী', 'charbhurungamariup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4147, 'Bangasonahat', 'বঙ্গসোনাহাট', 'bangasonahatup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4148, 'Boldia', 'বলদিয়া', 'boldiaup . kurigram . gov . bd', 1, 450, NULL, NULL, NULL, NULL),
(4149, 'Nawdanga', 'নাওডাঙ্গা', 'nawdangaup . kurigram . gov . bd', 1, 451, NULL, NULL, NULL, NULL),
(4150, 'Shimulbari', 'শিমুলবাড়ী', 'shimulbariup . kurigram . gov . bd', 1, 451, NULL, NULL, NULL, NULL),
(4151, 'Phulbari', 'ফুলবাড়ী', 'phulbariup . kurigram . gov . bd', 1, 451, NULL, NULL, NULL, NULL),
(4152, 'Baravita', 'বড়ভিটা', 'baravitaup . kurigram . gov . bd', 1, 451, NULL, NULL, NULL, NULL),
(4153, 'Bhangamor', 'ভাঙ্গামোড়', 'bhangamorup . kurigram . gov . bd', 1, 451, NULL, NULL, NULL, NULL),
(4154, 'Kashipur', 'কাশিপুর', 'kashipurup . kurigram . gov . bd', 1, 451, NULL, NULL, NULL, NULL),
(4155, 'Chinai', 'ছিনাই', 'chinaiup . kurigram . gov . bd', 1, 452, NULL, NULL, NULL, NULL),
(4156, 'Rajarhat', 'রাজারহাট', 'rajarhatup . kurigram . gov . bd', 1, 452, NULL, NULL, NULL, NULL),
(4157, 'Nazimkhan', 'নাজিমখাঁন', 'nazimkhanup . kurigram . gov . bd', 1, 452, NULL, NULL, NULL, NULL),
(4158, 'Gharialdanga', 'ঘড়িয়ালডাঙ্গা', 'gharialdangaup . kurigram . gov . bd', 1, 452, NULL, NULL, NULL, NULL),
(4159, 'Chakirpashar', 'চাকিরপশার', 'chakirpasharup . kurigram . gov . bd', 1, 452, NULL, NULL, NULL, NULL),
(4160, 'Biddanondo', 'বিদ্যানন্দ', 'biddanondoup . kurigram . gov . bd', 1, 452, NULL, NULL, NULL, NULL),
(4161, 'Umarmajid', 'উমর মজিদ', 'umarmajidup . kurigram . gov . bd', 1, 452, NULL, NULL, NULL, NULL),
(4162, 'Daldalia', 'দলদলিয়া', 'daldaliaup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4163, 'Durgapur', 'দুর্গাপুর', 'durgapurup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4164, 'Pandul', 'পান্ডুল', 'pandulup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4165, 'Buraburi', 'বুড়াবুড়ী', 'buraburiup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4166, 'Dharanibari', 'ধরণীবাড়ী', 'dharanibariup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4167, 'Dhamsreni', 'ধামশ্রেণী', 'dhamsreniup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4168, 'Gunaigas', 'গুনাইগাছ', 'gunaigasup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4169, 'Bazra', 'বজরা', 'bazraup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4170, 'Tobockpur', 'তবকপুর', 'tobockpurup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4171, 'Hatia', 'হাতিয়া', 'hatiaup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4172, 'Begumgonj', 'বেগমগঞ্জ', 'begumgonjup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4173, 'Shahabiar Alga', 'সাহেবের আলগা', 'shahabiaralgaup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4174, 'Thetrai', 'থেতরাই', 'thetraiup . kurigram . gov . bd', 1, 453, NULL, NULL, NULL, NULL),
(4175, 'Ranigonj', 'রাণীগঞ্জ', 'ranigonjup . kurigram . gov . bd', 1, 454, NULL, NULL, NULL, NULL),
(4176, 'Nayarhat', 'নয়ারহাট', 'nayarhatup . kurigram . gov . bd', 1, 454, NULL, NULL, NULL, NULL),
(4177, 'Thanahat', 'থানাহাট', 'thanahatup . kurigram . gov . bd', 1, 454, NULL, NULL, NULL, NULL),
(4178, 'Ramna', 'রমনা', 'ramnaup . kurigram . gov . bd', 1, 454, NULL, NULL, NULL, NULL),
(4179, 'Chilmari', 'চিলমারী', 'chilmariup . kurigram . gov . bd', 1, 454, NULL, NULL, NULL, NULL),
(4180, 'Austomirchar', 'অষ্টমীর চর', 'austomircharup . kurigram . gov . bd', 1, 454, NULL, NULL, NULL, NULL),
(4181, 'Dadevanga', 'দাঁতভাঙ্গা', 'dadevangaup . kurigram . gov . bd', 1, 455, NULL, NULL, NULL, NULL),
(4182, 'Shoulemari', 'শৌলমারী', 'shoulemariup . kurigram . gov . bd', 1, 455, NULL, NULL, NULL, NULL),
(4183, 'Bondober', 'বন্দবেড়', 'bondoberup . kurigram . gov . bd', 1, 455, NULL, NULL, NULL, NULL),
(4184, 'Rowmari', 'রৌমারী', 'rowmariup . kurigram . gov . bd', 1, 455, NULL, NULL, NULL, NULL),
(4185, 'Jadurchar', 'যাদুরচর', 'jadurcharup . kurigram . gov . bd', 1, 455, NULL, NULL, NULL, NULL),
(4186, 'Rajibpur', 'রাজিবপুর', 'rajibpurup . kurigram . gov . bd', 1, 456, NULL, NULL, NULL, NULL),
(4187, 'Kodalkati', 'কোদালকাটি', 'kodalkatiup . kurigram . gov . bd', 1, 456, NULL, NULL, NULL, NULL),
(4188, 'Mohongonj', 'মোহনগঞ্জ', 'mohongonjup . kurigram . gov . bd', 1, 456, NULL, NULL, NULL, NULL),
(4189, 'Kamararchor', 'কামারের চর', 'kamararchorup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4190, 'Chorsherpur', 'চরশেরপুর', 'chorsherpurup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4191, 'Bajitkhila', 'বাজিতখিলা', 'bajitkhilaup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4192, 'Gajir Khamar', 'গাজির খামার', 'gajirkhamarup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4193, 'Dhola', 'ধলা', 'dholaup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4194, 'Pakuriya', 'পাকুরিয়া', 'pakuriyaup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4195, 'Vatshala', 'ভাতশালা', 'vatshalaup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4196, 'Losmonpur', 'লছমনপুর', 'losmonpurup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4197, 'Rouha', 'রৌহা', 'rouhaup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4198, 'Kamariya', 'কামারিয়া', 'kamariyaup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4199, 'Chor Mochoriya', 'চর মোচারিয়া', 'chormochoriyaup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4200, 'Chorpokhimari', 'চর পক্ষীমারি', 'chorpokhimariup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4201, 'Betmari Ghughurakandi', 'বেতমারি ঘুঘুরাকান্দি', 'betmarighughurakandiup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4202, 'Balairchar', 'বলাইরচর', 'balaircharup . sherpur . gov . bd', 1, 457, NULL, NULL, NULL, NULL),
(4203, 'Puraga', 'পোড়াগাও', 'puragauup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4204, 'Nonni', 'নন্নী', 'nonniup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4205, 'Morichpuran', 'মরিচপুরাণ', 'morichpuranup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4206, 'Rajnogor', 'রাজনগর', 'rajnogorup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4207, 'Nayabil', 'নয়াবীল', 'nayabilup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4208, 'Ramchondrokura', 'রামচন্দ্রকুড়া', 'ramchondrokuraup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4209, 'Kakorkandhi', 'কাকরকান্দি', 'kakorkandhiup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4210, 'Nalitabari', 'নালিতাবাড়ী', 'nalitabariup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4211, 'Juganiya', 'যোগনীয়া', 'juganiyaup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4212, 'Bagber', 'বাঘবেড়', 'bagberup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4213, 'Koloshpar', 'কলসপাড়', 'koloshparup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4214, 'Rupnarayankura', 'রূপনারায়নকুড়া', 'rupnarayankuraup . sherpur . gov . bd', 1, 458, NULL, NULL, NULL, NULL),
(4215, 'Ranishimul', 'রানীশিমুল', 'ranishimulup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4216, 'Singabaruna', 'সিংগাবরুনা', 'singabarunaup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4217, 'Kakilakura', 'কাকিলাকুড়া', 'kakilakuraup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4218, 'Tatihati', 'তাতীহাটি', 'tatihatiup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4219, 'Gosaipur', 'গোশাইপুর', 'gosaipurup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4220, 'Sreebordi', 'শ্রীবরদী', 'sreebordiup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4221, 'Bhelua', 'ভেলুয়া', 'bheluaup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4222, 'Kharia Kazirchar', 'খড়িয়া কাজিরচর', 'khariakazircharup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4223, 'Kurikahonia', 'কুড়িকাহনিয়া', 'kurikahoniaup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4224, 'Garjaripa', 'গড়জরিপা', 'garjaripaup . sherpur . gov . bd', 1, 459, NULL, NULL, NULL, NULL),
(4225, 'Gonopoddi', 'গণপদ্দী', 'gonopoddiup . sherpur . gov . bd', 1, 460, NULL, NULL, NULL, NULL),
(4226, 'Nokla', 'নকলা', 'noklaup . sherpur . gov . bd', 1, 460, NULL, NULL, NULL, NULL),
(4227, 'Urpha', 'উরফা', 'urphaup . sherpur . gov . bd', 1, 460, NULL, NULL, NULL, NULL),
(4228, 'Gourdwar', 'গৌড়দ্বার', 'gourdwarup . sherpur . gov . bd', 1, 460, NULL, NULL, NULL, NULL),
(4229, 'Baneshwardi', 'বানেশ্বর্দী', 'baneshwardiup . sherpur . gov . bd', 1, 460, NULL, NULL, NULL, NULL),
(4230, 'Pathakata', 'পাঠাকাটা', 'pathakataup . sherpur . gov . bd', 1, 460, NULL, NULL, NULL, NULL),
(4231, 'Talki', 'টালকী', 'talkiup . sherpur . gov . bd', 1, 460, NULL, NULL, NULL, NULL),
(4232, 'Choraustadhar', 'চরঅষ্টধর', 'choraustadharup . sherpur . gov . bd', 1, 460, NULL, NULL, NULL, NULL),
(4233, 'Chandrakona', 'চন্দ্রকোনা', 'chandrakonaup . sherpur . gov . bd', 1, 460, NULL, NULL, NULL, NULL),
(4234, 'Kansa', 'কাংশা', 'kansaup . sherpur . gov . bd', 1, 461, NULL, NULL, NULL, NULL),
(4235, 'Dansail', 'ধানশাইল', 'dansailup . sherpur . gov . bd', 1, 461, NULL, NULL, NULL, NULL),
(4236, 'Nolkura', 'নলকুড়া', 'nolkuraup . sherpur . gov . bd', 1, 461, NULL, NULL, NULL, NULL),
(4237, 'Gouripur', 'গৌরিপুর', 'gouripurup . sherpur . gov . bd', 1, 461, NULL, NULL, NULL, NULL),
(4238, 'Jhenaigati', 'ঝিনাইগাতী', 'jhenaigatiup . sherpur . gov . bd', 1, 461, NULL, NULL, NULL, NULL),
(4239, 'Hatibandha', 'হাতিবান্দা', 'hatibandhaup . sherpur . gov . bd', 1, 461, NULL, NULL, NULL, NULL),
(4240, 'Malijhikanda', 'মালিঝিকান্দা', 'malijhikandaup . sherpur . gov . bd', 1, 461, NULL, NULL, NULL, NULL),
(4241, 'Deukhola', 'দেওখোলা', 'deukholaup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4242, 'Naogaon', 'নাওগাঁও', 'naogaonup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4243, 'Putijana', 'পুটিজানা', 'putijanaup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4244, 'Kushmail', 'কুশমাইল', 'kushmailup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4245, 'Fulbaria', 'ফুলবাড়ীয়া', 'fulbariaup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4246, 'Bakta', 'বাক্তা', 'baktaup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4247, 'Rangamatia', 'রাঙ্গামাটিয়া', 'rangamatiaup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4248, 'Enayetpur', 'এনায়েতপুর', 'enayetpurup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4249, 'Kaladaha', 'কালাদহ', 'kaladahaup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4250, 'Radhakanai', 'রাধাকানাই', 'radhakanaiup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4251, 'Asimpatuli', 'আছিমপাটুলী', 'asimpatuliup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4252, 'Vobanipur', 'ভবানীপুর', 'vobanipurup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4253, 'Balian', 'বালিয়ান', 'balianup . mymensingh . gov . bd', 1, 462, NULL, NULL, NULL, NULL),
(4254, 'Dhanikhola', 'ধানীখোলা', 'dhanikholaup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4255, 'Bailor', 'বৈলর', 'bailorup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4256, 'Kanthal', 'কাঁঠাল', 'kanthalup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4257, 'Kanihari', 'কানিহারী', 'kanihariup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4258, 'Trishal', 'ত্রিশাল', 'trishalup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4259, 'Harirampur', 'হরিরামপুর', 'harirampurup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4260, 'Sakhua', 'সাখুয়া', 'www . sakhuaup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4261, 'Balipara', 'বালিপাড়া', 'baliparaup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4262, 'Mokshapur', 'মোক্ষপুর', 'mokshapurup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4263, 'Mathbari', 'মঠবাড়ী', 'mathbariup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4264, 'Amirabari', 'আমিরাবাড়ী', 'amirabariup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4265, 'Rampur', 'রামপুর', 'rampurup . mymensingh . gov . bd', 1, 463, NULL, NULL, NULL, NULL),
(4266, 'Uthura', 'উথুরা', 'uthuraup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4267, 'Meduari', 'মেদুয়ারী', 'meduariup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4268, 'Varadoba', 'ভরাডোবা', 'varadobaup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4269, 'Dhitpur', 'ধীতপুর', 'dhitpurup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4270, 'Dakatia', 'ডাকাতিয়া', 'dakatiaup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4271, 'Birunia', 'বিরুনিয়া', 'biruniaup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4272, 'Bhaluka', 'ভালুকা', 'bhalukaup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4273, 'Mallikbari', 'মল্লিকবাড়ী', 'mallikbariup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4274, 'Kachina', 'কাচিনা', 'kachinaup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4275, 'Habirbari', 'হবিরবাড়ী', 'habirbariup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4276, 'Rajoi', 'রাজৈ', 'rajoiup . mymensingh . gov . bd', 1, 464, NULL, NULL, NULL, NULL),
(4277, 'Dulla', 'দুল্লা', 'dullaup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4278, 'Borogram', 'বড়গ্রাম', 'borogramup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4279, 'Tarati', 'তারাটি', 'taratiup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4280, 'Kumargata', 'কুমারগাতা', 'kumargataup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4281, 'Basati', 'বাশাটি', 'basatiup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4282, 'Mankon', 'মানকোন', 'mankonup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4283, 'Ghoga', 'ঘোগা', 'ghogaup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4284, 'Daogaon', 'দাওগাঁও', 'daogaonup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4285, 'Kashimpur', 'কাশিমপুর', 'kashimpurup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4286, 'Kheruajani', 'খেরুয়াজানী', 'kheruajaniup . mymensingh . gov . bd', 1, 465, NULL, NULL, NULL, NULL),
(4287, 'Austadhar', 'অষ্টধার', 'austadharup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4288, 'Bororchar', 'বোররচর', 'bororcharup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4289, 'Dapunia', 'দাপুনিয়া', 'dapuniaup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4290, 'Aqua', 'আকুয়া', 'aquaup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4291, 'Khagdohor', 'খাগডহর', 'khagdohorup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4292, 'Charnilaxmia', 'চরনিলক্ষিয়া', 'charnilaxmiaup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4293, 'Kushtia', 'কুষ্টিয়া', 'kushtiaup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4294, 'Paranganj', 'পরানগঞ্জ', 'paranganjup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4295, 'Sirta', 'সিরতা', 'sirtaup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4296, 'Char Ishwardia', 'চর ঈশ্বরদিয়া', 'charishwardiaup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4297, 'Ghagra', 'ঘাগড়া', 'ghagraup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4298, 'Vabokhali', 'ভাবখালী', 'vabokhaliup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4299, 'Boyra', 'বয়ড়া', 'boyraup . mymensingh . gov . bd', 1, 466, NULL, NULL, NULL, NULL),
(4300, 'Dakshin Maijpara', 'দক্ষিণ মাইজপাড়া', 'dakshinmaijparaup . mymensingh . gov . bd', 1, 467, NULL, NULL, NULL, NULL),
(4301, 'Gamaritola', 'গামারীতলা', 'gamaritolaup . mymensingh . gov . bd', 1, 467, NULL, NULL, NULL, NULL),
(4302, 'Dhobaura', 'ধোবাউড়া', 'dhobauraup . mymensingh . gov . bd', 1, 467, NULL, NULL, NULL, NULL),
(4303, 'Porakandulia', 'পোড়াকান্দুলিয়া', 'porakanduliaup . mymensingh . gov . bd', 1, 467, NULL, NULL, NULL, NULL),
(4304, 'Goatala', 'গোয়াতলা', 'goatalaup . mymensingh . gov . bd', 1, 467, NULL, NULL, NULL, NULL),
(4305, 'Ghoshgaon', 'ঘোষগাঁও', 'ghoshgaonup . mymensingh . gov . bd', 1, 467, NULL, NULL, NULL, NULL),
(4306, 'Baghber', 'বাঘবেড়', 'baghberup . mymensingh . gov . bd', 1, 467, NULL, NULL, NULL, NULL),
(4307, 'Rambhadrapur', 'রামভদ্রপুর', 'rambhadrapurup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4308, 'Sondhara', 'ছনধরা', 'sondharaup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4309, 'Vaitkandi', 'ভাইটকান্দি', 'vaitkandiup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4310, 'Singheshwar', 'সিংহেশ্বর', 'singheshwarup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4311, 'Phulpur', 'ফুলপুর', 'phulpurup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4312, 'Banihala', 'বানিহালা', 'banihalaup . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4313, 'Biska', 'বিস্কা', 'biskaup . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4314, 'Baola', 'বওলা', 'baolaup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4315, 'Payari', 'পয়ারী', 'payariup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4316, 'Balia', 'বালিয়া', 'baliaup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4317, 'Rahimganj', 'রহিমগঞ্জ', 'rahimganjup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4318, 'Balikha', 'বালিখা', 'balikhaup . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4319, 'Kakni', 'কাকনী', 'kakniup . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4320, 'Dhakua', 'ঢাকুয়া', 'dhakuaup . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4321, 'Rupasi', 'রূপসী', 'rupasiup . mymensingh . gov . bd', 1, 468, NULL, NULL, NULL, NULL),
(4322, 'Tarakanda', 'তারাকান্দা', 'tarakandaup . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4323, 'Galagaon', 'গালাগাঁও', 'galagaonup . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4324, 'Kamargaon', 'কামারগাঁও', 'kamargaonup . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4325, 'Kamaria', 'কামারিয়া', 'kamariaup . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4326, 'Rampur', 'রামপুর', 'rampurup2 . mymensingh . gov . bd', 1, 474, NULL, NULL, NULL, NULL),
(4327, 'Bhubankura', 'ভূবনকুড়া', 'bhubankuraup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4328, 'Jugli', 'জুগলী', 'jugliup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4329, 'Kaichapur', 'কৈচাপুর', 'kaichapurup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4330, 'Haluaghat', 'হালুয়াঘাট', 'haluaghatup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4331, 'Gazirbhita', 'গাজিরভিটা', 'gazirbhitaup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4332, 'Bildora', 'বিলডোরা', 'bildoraup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4333, 'Sakuai', 'শাকুয়াই', 'sakuaiup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4334, 'Narail', 'নড়াইল', 'narailup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4335, 'Dhara', 'ধারা', 'dharaup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4336, 'Dhurail', 'ধুরাইল', 'dhurailup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4337, 'Amtoil', 'আমতৈল', 'amtoilup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4338, 'Swadeshi', 'স্বদেশী', 'swadeshiup . mymensingh . gov . bd', 1, 469, NULL, NULL, NULL, NULL),
(4339, 'Sahanati', 'সহনাটি', 'sahanatiup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4340, 'Achintapur', 'অচিন্তপুর', 'achintapurup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4341, 'Mailakanda', 'মইলাকান্দা', 'mailakandaup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4342, 'Bokainagar', 'বোকাইনগর', 'bokainagarup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4343, 'Gouripur', 'গৌরীপুর', 'gouripurup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4344, 'Maoha', 'মাওহা', 'maohaup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4345, 'Ramgopalpur', 'রামগোপালপুর', 'ramgopalpurup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4346, 'Douhakhola', 'ডৌহাখলা', 'douhakholaup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4347, 'Bhangnamari', 'ভাংনামারী', 'bhangnamariup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4348, 'Sidhla', 'সিধলা', 'sidhlaup . mymensingh . gov . bd', 1, 470, NULL, NULL, NULL, NULL),
(4349, 'Rasulpur', 'রসুলপুর', 'rasulpurup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4350, 'Barobaria', 'বারবারিয়া', 'barobariaup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4351, 'Charalgi', 'চরআলগী', 'charalgiup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4352, 'Saltia', 'সালটিয়া', 'saltiaup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4353, 'Raona', 'রাওনা', 'raonaup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4354, 'Longair', 'লংগাইর', 'longairup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4355, 'Paithol', 'পাইথল', 'paitholup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4356, 'Gafargaon', 'গফরগাঁও', 'gafargaonup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4357, 'Josora', 'যশরা', 'josoraup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4358, 'Moshakhali', 'মশাখালী', 'moshakhaliup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4359, 'Panchbagh', 'পাঁচবাগ', 'panchbaghup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4360, 'Usthi', 'উস্থি', 'usthiup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4361, 'Dotterbazar', 'দত্তেরবাজার', 'dotterbazarup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4362, 'Niguari', 'নিগুয়ারী', 'niguariup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4363, 'Tangabo', 'টাংগাব', 'tangaboup . mymensingh . gov . bd', 1, 471, NULL, NULL, NULL, NULL),
(4364, 'Iswarganj', 'ঈশ্বরগঞ্জ', 'iswarganjup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4365, 'Sarisha', 'সরিষা', 'sarishaup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4366, 'Sohagi', 'সোহাগী', 'sohagiup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4367, 'Atharabari', 'আঠারবাড়ী', 'atharabariup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4368, 'Rajibpur', 'রাজিবপুর', 'rajibpurup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4369, 'Maijbagh', 'মাইজবাগ', 'maijbaghup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4370, 'Magtula', 'মগটুলা', 'magtulaup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4371, 'Jatia', 'জাটিয়া', 'jatiaup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4372, 'Uchakhila', 'উচাখিলা', 'uchakhilaup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4373, 'Tarundia', 'তারুন্দিয়া', 'tarundiaup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4374, 'Barahit', 'বড়হিত', 'barahitup . mymensingh . gov . bd', 1, 472, NULL, NULL, NULL, NULL),
(4375, 'Batagoir', 'বেতাগৈর', 'batagoirup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4376, 'Nandail', 'নান্দাইল', 'nandailup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4377, 'Chandipasha', 'চন্ডীপাশা', 'chandipashaup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4378, 'Gangail', 'গাংগাইল', 'gangailup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4379, 'Rajgati', 'রাজগাতী', 'rajgatiup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4380, 'Muajjempur', 'মোয়াজ্জেমপুর', 'muajjempurup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4381, 'Sherpur', 'শেরপুর', 'sherpurup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4382, 'Singroil', 'সিংরইল', 'singroilup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4383, 'Achargaon', 'আচারগাঁও', 'achargaonup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4384, 'Mushulli', 'মুশুল্লী', 'mushulliup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4385, 'Kharua', 'খারুয়া', 'kharuaup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4386, 'Jahangirpur', 'জাহাঙ্গীরপুর', 'jahangirpurup . mymensingh . gov . bd', 1, 473, NULL, NULL, NULL, NULL),
(4387, 'Kendua', 'কেন্দুয়া', 'kenduaup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4388, 'Sharifpur', 'শরিফপুর', 'sharifpurup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4389, 'Laxirchar', 'লক্ষীরচর', 'laxircharup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4390, 'Tolshirchar', 'তুলশীরচর', 'tolshircharup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4391, 'Itail', 'ইটাইল', 'itailup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4392, 'Narundi', 'নরুন্দী', 'narundiup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4393, 'Ghorada', 'ঘোড়াধাপ', 'ghoradapup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4394, 'Bashchara', 'বাশঁচড়া', 'bashcharaup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4395, 'Ranagacha', 'রানাগাছা', 'ranagachaup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4396, 'Sheepur', 'শ্রীপুর', 'sheepurup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4397, 'Shahbajpur', 'শাহবাজপুর', 'shahbajpurup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4398, 'Titpalla', 'তিতপল্লা', 'titpallaup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4399, 'Mesta', 'মেষ্টা', 'mestaup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4400, 'Digpait', 'দিগপাইত', 'digpaitup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4401, 'Rashidpur', 'রশিদপুর', 'rashidpurup . jamalpur . gov . bd', 1, 475, NULL, NULL, NULL, NULL),
(4402, 'Durmot', 'দুরমুট', 'durmotup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4403, 'Kulia', 'কুলিয়া', 'kuliaup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4404, 'Mahmudpur', 'মাহমুদপুর', 'mahmudpurup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4405, 'Nangla', 'নাংলা', 'nanglaup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4406, 'Nayanagar', 'নয়ানগর', 'nayanagarup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4407, 'Adra', 'আদ্রা', 'adraup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4408, 'Charbani Pakuria', 'চরবানী পাকুরিয়া', 'charbanipakuriaup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4409, 'Fulkucha', 'ফুলকোচা', 'fulkuchaup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4410, 'Ghuserpara', 'ঘোষেরপাড়া', 'ghuserparaup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4411, 'Jhaugara', 'ঝাউগড়া', 'jhaugaraup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4412, 'Shuampur', 'শ্যামপুর', 'shuampurup . jamalpur . gov . bd', 1, 476, NULL, NULL, NULL, NULL),
(4413, 'Kulkandi', 'কুলকান্দি', 'kulkandiup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4414, 'Belghacha', 'বেলগাছা', 'belghachaup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4415, 'Chinaduli', 'চিনাডুলী', 'chinaduliup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4416, 'Shapdari', 'সাপধরী', 'shapdariup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4417, 'Noarpara', 'নোয়ারপাড়া', 'noarparaup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4418, 'Islampur', 'ইসলামপুর', 'islampurup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4419, 'Partharshi', 'পাথশী', 'partharshiup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4420, 'Palabandha', 'পলবান্ধা', 'palabandhaup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4421, 'Gualerchar', 'গোয়ালেরচর', 'gualercharup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4422, 'Gaibandha', 'গাইবান্ধা', 'gaibandhaup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4423, 'Charputimari', 'চরপুটিমারী', 'charputimariup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4424, 'Chargualini', 'চরগোয়ালীনি', 'chargualiniup . jamalpur . gov . bd', 1, 477, NULL, NULL, NULL, NULL),
(4425, 'Dungdhara', 'ডাংধরা', 'dungdharaup . jamalpur . gov . bd', 1, 478, NULL, NULL, NULL, NULL),
(4426, 'Char Amkhawa', 'চর আমখাওয়া', 'charamkhawaup . jamalpur . gov . bd', 1, 478, NULL, NULL, NULL, NULL),
(4427, 'Parram Rampur', 'পাররাম রামপুর', 'parramrampurup . jamalpur . gov . bd', 1, 478, NULL, NULL, NULL, NULL),
(4428, 'Hatibanga', 'হাতীভাঙ্গা', 'hatibangaup . jamalpur . gov . bd', 1, 478, NULL, NULL, NULL, NULL),
(4429, 'Bahadurabad', 'বাহাদুরাবাদ', 'bahadurabadup . jamalpur . gov . bd', 1, 478, NULL, NULL, NULL, NULL),
(4430, 'Chikajani', 'চিকাজানী', 'chikajaniup . jamalpur . gov . bd', 1, 478, NULL, NULL, NULL, NULL),
(4431, 'Chukaibari', 'চুকাইবাড়ী', 'chukaibariup . jamalpur . gov . bd', 1, 478, NULL, NULL, NULL, NULL),
(4432, 'Dewangonj', 'দেওয়ানগঞ্জ', 'dewangonjup . jamalpur . gov . bd', 1, 478, NULL, NULL, NULL, NULL),
(4433, 'Satpoa', 'সাতপোয়া', 'satpoaup . jamalpur . gov . bd', 1, 479, NULL, NULL, NULL, NULL),
(4434, 'Pogaldigha', 'পোগলদিঘা', 'pogaldighaup . jamalpur . gov . bd', 1, 479, NULL, NULL, NULL, NULL),
(4435, 'Doail', 'ডোয়াইল', 'doailup . jamalpur . gov . bd', 1, 479, NULL, NULL, NULL, NULL),
(4436, 'Aona', 'আওনা', 'aonaup . jamalpur . gov . bd', 1, 479, NULL, NULL, NULL, NULL),
(4437, 'Pingna', 'পিংনা', 'pingnaup . jamalpur . gov . bd', 1, 479, NULL, NULL, NULL, NULL),
(4438, 'Bhatara', 'ভাটারা', 'bhataraup . jamalpur . gov . bd', 1, 479, NULL, NULL, NULL, NULL),
(4439, 'Kamrabad', 'কামরাবাদ', 'kamrabadup . jamalpur . gov . bd', 1, 479, NULL, NULL, NULL, NULL),
(4440, 'Mahadan', 'মহাদান', 'mahadanup . jamalpur . gov . bd', 1, 479, NULL, NULL, NULL, NULL),
(4441, 'Char Pakerdah', 'চর পাকেরদহ', 'charpakerdahup . jamalpur . gov . bd', 1, 480, NULL, NULL, NULL, NULL),
(4442, 'Karaichara', 'কড়ইচড়া', 'karaicharaup . jamalpur . gov . bd', 1, 480, NULL, NULL, NULL, NULL),
(4443, 'Gunaritala', 'গুনারীতলা', 'gunaritalaup . jamalpur . gov . bd', 1, 480, NULL, NULL, NULL, NULL),
(4444, 'Balijuri', 'বালিজুড়ী', 'balijuriup . jamalpur . gov . bd', 1, 480, NULL, NULL, NULL, NULL),
(4445, 'Jorekhali', 'জোড়খালী', 'jorekhaliup . jamalpur . gov . bd', 1, 480, NULL, NULL, NULL, NULL),
(4446, 'Adarvita', 'আদারভিটা', 'adarvitaup . jamalpur . gov . bd', 1, 480, NULL, NULL, NULL, NULL),
(4447, 'Sidhuli', 'সিধুলী', 'sidhuliup . jamalpur . gov . bd', 1, 480, NULL, NULL, NULL, NULL),
(4448, 'Danua', 'ধানুয়া', 'danuaup . jamalpur . gov . bd', 1, 481, NULL, NULL, NULL, NULL),
(4449, 'Bagarchar', 'বগারচর', 'bagarcharup . jamalpur . gov . bd', 1, 481, NULL, NULL, NULL, NULL),
(4450, 'Battajore', 'বাট্রাজোড়', 'battajoreup . jamalpur . gov . bd', 1, 481, NULL, NULL, NULL, NULL),
(4451, 'Shadurpara', 'সাধুরপাড়া', 'shadurparaup . jamalpur . gov . bd', 1, 481, NULL, NULL, NULL, NULL),
(4452, 'Bakshigonj', 'বকসীগঞ্জ', 'bakshigonjup . jamalpur . gov . bd', 1, 481, NULL, NULL, NULL, NULL),
(4453, 'Nilakhia', 'নিলক্ষিয়া', 'nilakhiaup . jamalpur . gov . bd', 1, 481, NULL, NULL, NULL, NULL),
(4454, 'Merurchar', 'মেরুরচর', 'merurcharup . jamalpur . gov . bd', 1, 481, NULL, NULL, NULL, NULL),
(4455, 'Asma', 'আসমা', 'asma . netrokona . gov . bd', 1, 482, NULL, NULL, NULL, NULL),
(4456, 'Chhiram', 'চিরাম', 'chhiram . netrokona . gov . bd', 1, 482, NULL, NULL, NULL, NULL),
(4457, 'Baushi', 'বাউশী', 'baushiup . netrokona . gov . bd', 1, 482, NULL, NULL, NULL, NULL),
(4458, 'Barhatta', 'বারহাট্টা', 'barhattaup . netrokona . gov . bd', 1, 482, NULL, NULL, NULL, NULL),
(4459, 'Raypur', 'রায়পুর', 'raypurup . netrokona . gov . bd', 1, 482, NULL, NULL, NULL, NULL),
(4460, 'Sahata', 'সাহতা', 'sahataup . netrokona . gov . bd', 1, 482, NULL, NULL, NULL, NULL),
(4461, 'Singdha', 'সিংধা', 'singdhaup . netrokona . gov . bd', 1, 482, NULL, NULL, NULL, NULL),
(4462, 'Durgapur', 'দূর্গাপুর', 'durgapurup . netrokona . gov . bd', 1, 483, NULL, NULL, NULL, NULL),
(4463, 'Kakoirgora', 'কাকৈরগড়া', 'kakoirgoraup . netrokona . gov . bd', 1, 483, NULL, NULL, NULL, NULL),
(4464, 'Kullagora', 'কুল্লাগড়া', 'kullagoraup . netrokona . gov . bd', 1, 483, NULL, NULL, NULL, NULL),
(4465, 'Chandigarh', 'চণ্ডিগড়', 'chandigarhup . netrokona . gov . bd', 1, 483, NULL, NULL, NULL, NULL),
(4466, 'Birisiri', 'বিরিশিরি', 'birisiriup . netrokona . gov . bd', 1, 483, NULL, NULL, NULL, NULL),
(4467, 'Bakaljora', 'বাকলজোড়া', 'bakaljoraup . netrokona . gov . bd', 1, 483, NULL, NULL, NULL, NULL),
(4468, 'Gawkandia', 'গাঁওকান্দিয়া', 'gawkandiaup . netrokona . gov . bd', 1, 483, NULL, NULL, NULL, NULL),
(4469, 'Asujia', 'আশুজিয়া', 'asujiaup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4470, 'Dalpa', 'দলপা', 'dalpaup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4471, 'Goraduba', 'গড়াডোবা', 'goradubaup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4472, 'Gonda', 'গণ্ডা', 'gondaup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4473, 'Sandikona', 'সান্দিকোনা', 'sandikonaup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4474, 'Maska', 'মাসকা', 'maskaup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4475, 'Bolaishimul', 'বলাইশিমুল', 'bolaishimulup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4476, 'Noapara', 'নওপাড়া', 'noaparaup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4477, 'Kandiura', 'কান্দিউড়া', 'kandiuraup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4478, 'Chirang', 'চিরাং', 'chirangup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4479, 'Roailbari Amtala', 'রোয়াইলবাড়ী আমতলা', 'roailbariamtalaup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4480, 'Paikura', 'পাইকুড়া', 'paikuraup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4481, 'Muzafarpur', 'মোজাফরপুর', 'muzafarpurup . netrokona . gov . bd', 1, 484, NULL, NULL, NULL, NULL),
(4482, 'Shormushia', 'স্বরমুশিয়া', 'shormushiaup . netrokona . gov . bd', 1, 485, NULL, NULL, NULL, NULL),
(4483, 'Shunoi', 'শুনই', 'shunoiup . netrokona . gov . bd', 1, 485, NULL, NULL, NULL, NULL),
(4484, 'Lunesshor', 'লুনেশ্বর', 'lunesshorup . netrokona . gov . bd', 1, 485, NULL, NULL, NULL, NULL),
(4485, 'Baniyajan', 'বানিয়াজান', 'baniyajanup . netrokona . gov . bd', 1, 485, NULL, NULL, NULL, NULL),
(4486, 'Teligati', 'তেলিগাতী', 'teligatiup . netrokona . gov . bd', 1, 485, NULL, NULL, NULL, NULL),
(4487, 'Duoj', 'দুওজ', 'duojup . netrokona . gov . bd', 1, 485, NULL, NULL, NULL, NULL),
(4488, 'Sukhari', 'সুখারী', 'sukhariup . netrokona . gov . bd', 1, 485, NULL, NULL, NULL, NULL),
(4489, 'Fathepur', 'ফতেপুর', 'fathepurup . netrokona . gov . bd', 1, 486, NULL, NULL, NULL, NULL),
(4490, 'Nayekpur', 'নায়েকপুর', 'nayekpurup . netrokona . gov . bd', 1, 486, NULL, NULL, NULL, NULL),
(4491, 'Teosree', 'তিয়শ্রী', 'teosreeup . netrokona . gov . bd', 1, 486, NULL, NULL, NULL, NULL),
(4492, 'Magan', 'মাঘান', 'maganup . netrokona . gov . bd', 1, 486, NULL, NULL, NULL, NULL),
(4493, 'Gobindasree', 'গেবিন্দশ্রী', 'gobindasreeup . netrokona . gov . bd', 1, 486, NULL, NULL, NULL, NULL),
(4494, 'Madan', 'মদন', 'madanup . netrokona . gov . bd', 1, 486, NULL, NULL, NULL, NULL),
(4495, 'Chandgaw', 'চানগাঁও', 'chandgawup . netrokona . gov . bd', 1, 486, NULL, NULL, NULL, NULL),
(4496, 'Kytail', 'কাইটাল', 'kytailup . netrokona . gov . bd', 1, 486, NULL, NULL, NULL, NULL),
(4497, 'Krishnapur', 'কৃষ্ণপুর', 'krishnapurup . netrokona . gov . bd', 1, 487, NULL, NULL, NULL, NULL),
(4498, 'Nogor', 'নগর', 'nogorup . netrokona . gov . bd', 1, 487, NULL, NULL, NULL, NULL),
(4499, 'Chakua', 'চাকুয়া', 'chakuaup . netrokona . gov . bd', 1, 487, NULL, NULL, NULL, NULL),
(4500, 'Khaliajuri', 'খালিয়াজুরী', 'khaliajuriup . netrokona . gov . bd', 1, 487, NULL, NULL, NULL, NULL),
(4501, 'Mendipur', 'মেন্দিপুর', 'mendipurup . netrokona . gov . bd', 1, 487, NULL, NULL, NULL, NULL),
(4502, 'Gazipur', 'গাজীপুর', 'gazipurup . netrokona . gov . bd', 1, 487, NULL, NULL, NULL, NULL),
(4503, 'Koilati', 'কৈলাটী', 'koilatiup . netrokona . gov . bd', 1, 488, NULL, NULL, NULL, NULL),
(4504, 'Najirpur', 'নাজিরপুর', 'najirpurup . netrokona . gov . bd', 1, 488, NULL, NULL, NULL, NULL),
(4505, 'Pogla', 'পোগলা', 'poglaup . netrokona . gov . bd', 1, 488, NULL, NULL, NULL, NULL),
(4506, 'Kolmakanda', 'কলমাকান্দা', 'kolmakandaup . netrokona . gov . bd', 1, 488, NULL, NULL, NULL, NULL),
(4507, 'Rongchati', 'রংছাতি', 'rongchatiup . netrokona . gov . bd', 1, 488, NULL, NULL, NULL, NULL),
(4508, 'Lengura', 'লেংগুরা', 'lenguraup . netrokona . gov . bd', 1, 488, NULL, NULL, NULL, NULL),
(4509, 'Borokhapon', 'বড়খাপন', 'borokhaponup . netrokona . gov . bd', 1, 488, NULL, NULL, NULL, NULL),
(4510, 'Kharnoi', 'খারনৈ', 'kharnoiup . netrokona . gov . bd', 1, 488, NULL, NULL, NULL, NULL),
(4511, 'Borokashia Birampur', 'বড়কাশিয়া বিরামপুর', 'borokashiabirampurup . netrokona . gov . bd', 1, 489, NULL, NULL, NULL, NULL),
(4512, 'Borotoli Banihari', 'বড়তলী বানিহারী', 'borotolibanihariup . netrokona . gov . bd', 1, 489, NULL, NULL, NULL, NULL);
INSERT INTO `unions` (`id`, `name`, `bn_name`, `url`, `status`, `thana_id`, `deleted_at`, `created_at`, `created_by`, `updated_at`) VALUES
(4513, 'Tetulia', 'তেতুলিয়া', 'tetuliaup . netrokona . gov . bd', 1, 489, NULL, NULL, NULL, NULL),
(4514, 'Maghan Siadar', 'মাঘান সিয়াদার', 'maghansiadarup . netrokona . gov . bd', 1, 489, NULL, NULL, NULL, NULL),
(4515, 'Somaj Sohildeo', 'সমাজ সহিলদেও', 'somajsohildeoup . netrokona . gov . bd', 1, 489, NULL, NULL, NULL, NULL),
(4516, 'Suair', 'সুয়াইর', 'suairup . netrokona . gov . bd', 1, 489, NULL, NULL, NULL, NULL),
(4517, 'Gaglajur', 'গাগলাজুর', 'gaglajurup . netrokona . gov . bd', 1, 489, NULL, NULL, NULL, NULL),
(4518, 'Khalishaur', 'খলিশাউড়', 'khalishaurup . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4519, 'Ghagra', 'ঘাগড়া', 'ghagraup . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4520, 'Jaria', 'জারিয়া', 'jariaup . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4521, 'Narandia', 'নারান্দিয়া', 'narandiaup . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4522, 'Bishkakuni', 'বিশকাকুনী', 'bishkakuniup . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4523, 'Bairaty', 'বৈরাটী', 'bairaty . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4524, 'Hogla', 'হোগলা', 'hoglaup . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4525, 'Gohalakanda', 'গোহালাকান্দা', 'gohalakandaup . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4526, 'Dhalamulgaon', 'ধলামুলগাঁও', 'dhalamulgaonup . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4527, 'Agia', 'আগিয়া', 'agia . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4528, 'Purbadhala', 'পূর্বধলা', 'purbadhalaup . netrokona . gov . bd', 1, 490, NULL, NULL, NULL, NULL),
(4529, 'Chollisha', 'চল্লিশা', 'chollishaup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4530, 'Kailati', 'কাইলাটি', 'kailatiup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4531, 'Dokkhin Bishiura', 'দক্ষিণ বিশিউড়া', 'dokkhinbishiuraup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4532, 'Modonpur', 'মদনপুর', 'modonpurup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4533, 'Amtola', 'আমতলা', 'amtolaup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4534, 'Lokkhiganj', 'লক্ষীগঞ্জ', 'lokkhiganj . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4535, 'Singher Bangla', 'সিংহের বাংলা', 'singherbanglaup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4536, 'Thakurakona', 'ঠাকুরাকোণা', 'thakurakonaup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4537, 'Mougati', 'মৌগাতি', 'mougatiup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4538, 'Rouha', 'রৌহা', 'rouhaup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4539, 'Medni', 'মেদনী', 'medniup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL),
(4540, 'Kaliara Babragati', 'কালিয়ারা গাবরাগাতি', 'kaliaragabragatiup . netrokona . gov . bd', 1, 491, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `union_wards`
--

CREATE TABLE `union_wards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `union_id` bigint(20) NOT NULL,
  `en_ward_no` bigint(20) NOT NULL,
  `bn_ward_no` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `union_wards`
--

INSERT INTO `union_wards` (`id`, `union_id`, `en_ward_no`, `bn_ward_no`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3503, 1, '১', 1, 5, NULL, '2022-08-28 15:47:15', '2022-08-28 15:47:15'),
(2, 3503, 2, '২', 1, 5, 1, '2022-08-28 15:47:26', '2022-09-09 22:16:04'),
(3, 3503, 3, '৩', 1, 5, 1, '2022-08-28 15:47:41', '2022-09-09 22:15:53'),
(4, 3503, 4, '৪', 1, 1, NULL, '2022-09-09 22:15:37', '2022-09-09 22:15:37'),
(5, 3503, 5, '৫', 1, 1, NULL, '2022-09-09 22:16:19', '2022-09-09 22:16:19'),
(6, 3503, 6, '৬', 1, 1, NULL, '2022-09-09 22:16:30', '2022-09-09 22:16:30'),
(7, 3503, 7, '৭', 1, 1, NULL, '2022-09-09 22:16:45', '2022-09-09 22:16:45'),
(8, 3503, 8, '৮', 1, 1, NULL, '2022-09-09 22:17:02', '2022-09-09 22:17:02'),
(9, 3503, 9, '৯', 1, 1, NULL, '2022-09-09 22:17:18', '2022-09-09 22:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `unmarried_certificates`
--

CREATE TABLE `unmarried_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unmarried_certificates`
--

INSERT INTO `unmarried_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-19 23:14:31', '2022-10-19 23:14:31'),
(2, '2022102', 6, 0.00, 1, 0.00, 5, '2022-10-19 23:23:35', '2022-10-19 23:23:35'),
(3, '20260210001', 10, 0.00, 1, 0.00, 7, '2026-02-10 01:35:10', '2026-02-10 01:35:10'),
(4, '20260308002', 10, 0.00, 1, 0.00, 7, '2026-03-08 04:03:48', '2026-03-08 04:03:48'),
(5, '20260415003', 56, 0.00, 1, 0.00, 7, '2026-04-15 13:18:48', '2026-04-15 13:18:48'),
(6, '26042205001', 113, 0.00, 1, 0.00, 7, '2026-04-22 00:06:46', '2026-04-22 00:06:46'),
(7, '26042205002', 114, 0.00, 1, 0.00, 7, '2026-04-22 00:53:19', '2026-04-22 00:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(190) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `institute_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `birth_certificate` varchar(191) DEFAULT NULL,
  `nid` varchar(191) DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=>Inactive, 1=> Active, 2=> Banned, 3=>Suspended',
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `system_id`, `role_id`, `institute_id`, `name`, `email`, `mobile`, `birth_certificate`, `nid`, `password`, `image`, `status`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '', 1, NULL, 'Admin', 'imran.molla@gmail.com', NULL, NULL, NULL, '$2y$10$.tN7f6vWzMLFxG2t/j4ZOuWLSRkD/3PCD7epUrRrrtkR22sCB2bgu', NULL, 1, 1, NULL, 'UcwXZx3Vi9VA9I7OmSBbkliEpdLTfBDQ3TskKXiQQIBoFf48emFssAd3tptC', NULL, NULL),
(2, '', 2, NULL, 'User', 'user@gmail.com', NULL, NULL, NULL, '$2y$12$gDug6EvfGc.8dFY03ATE1uOLTJm8NHMgvMNAhdkPJFCTiRjbZvZuq', NULL, 1, 1, NULL, NULL, NULL, NULL),
(3, '', 1, NULL, 'ENO', 'admin1@gmail.com', NULL, NULL, NULL, '$2y$10$ZeSYlUeZSpYkmAImipC3Q.KGGWz5CrKxwPh0Dih1MRp3LPhPmEJ5a', NULL, 1, 1, NULL, NULL, NULL, NULL),
(4, '', 1, NULL, 'Imran Molla', 'imran.molla@yahoo.com', NULL, NULL, NULL, '$2y$10$bFtnBGA8iL7GOy36ElvqbeDKzR6oimThb0adgaElAD3asbcnyaor.', NULL, 1, 1, NULL, NULL, NULL, NULL),
(7, '', 6, 2, 'Mahfuzur Rahman', 'mahfuzur.rahman@gmail.com', '01199002212', NULL, NULL, '$2y$10$mMLop97bzCHmXNRkpYNyI.GX0y/R7ZhFrXWkFoYhh4wU42fHGQ4e2', NULL, 1, 1, NULL, '3cDSw2TrxjTt0o2bNa5D6e1ttNAm0rcLmR9McvJHHoJWwdZly24bd5UyzqPZ', '2022-09-09 22:06:48', '2026-04-10 05:33:55'),
(8, '20230504001', 5, 2, 'Imran Molla', 'imran.molla2@yahoo.com', '01612302125', '12548963', '1919914836', '$2y$10$Pm5JaG0AnR.f0sE8JfpaHOznWDcx5TMqxGQjqKRd.l0R4H0V39MEa', 'uploads/users/20260415185311_8.jpg', 1, 7, 7, NULL, '2022-09-09 22:11:24', '2026-04-15 12:53:11'),
(39, '20230608009', 5, 2, 'Sultan Mahmud Hasan Molla', 'mahmud.hasan@gmail.com', '01947302124', NULL, NULL, '$2y$10$JcsSrRtFRJmMKENbcN811eNC2EDCqK5SVr1s2jxeFIBfD1CUK87gC', NULL, 1, 1, NULL, NULL, '2023-06-08 01:33:49', '2023-06-08 01:33:49'),
(53, '20250827017', 5, 2, 'MAFUZUR RAHMAN', 'ekusheys@gmail.com', '01984550056', '45332144444', '191991483', '$2y$10$SNBXiF1j5LnkTX5Q8UnCVeRRjAacFAY9BzqEyHt54ul75HUOq1DXO', 'uploads/users/20260415185745_53.jpeg', 1, 1, 7, NULL, '2025-08-27 02:58:16', '2026-04-16 09:19:47'),
(56, '20250831019', 5, 2, 'Kaniz Fahmida Mim', 'fahmida@gmail.com', '01553202124', '20043513286027073', '1050054061', '$2y$10$wbgaDg6B6Iz5.YsiWE.ZQeAkmYV86Wdr1Obl1EPRGClRR7pwxawIO', 'uploads/users/20260415185206_56.jpg', 1, 1, 7, NULL, '2025-08-31 01:53:17', '2026-04-15 12:52:06'),
(66, '20260213029', 5, 2, 'MAFUZUR RAHMAN', 'suktailudc@gmail.com', '01984550056', '65987569', '25698745', '$2y$10$0FttzOFY0vJnxlTAHjOvee5Ss6AebwWlegzBiZSwA1G92JHWH9DMu', 'uploads/users/20260421041111_66.jpeg', 1, 7, 7, NULL, '2026-02-13 00:17:52', '2026-04-20 22:11:11'),
(98, '20260415030', 5, 2, 'MAFUZUR RAHMAN', NULL, '01984550056', NULL, '9577668925', '$2y$10$CrotzBsEGpWy0tWGEYyE9.q5YQAk88PlTlY0r9s/IhzZa77i2Ycr2', NULL, 1, 1, NULL, NULL, '2026-04-15 08:09:09', '2026-04-15 08:09:09'),
(106, '20260417031', 5, NULL, 'department 2', 'user@gmai.com', '232', '2323', '23', '$2y$10$p0fnGvFZBb0NoQfPcYv31Oz/LKhDlV1rGQsnHrLb3wO5aLCJ7Rj2u', NULL, 1, 7, NULL, NULL, '2026-04-17 09:00:02', '2026-04-17 09:00:02'),
(107, '20260418032', 5, NULL, 'Abdullah Al Mamun', 'aamamun@gmail.com', '012312345567', '564433255667', '324566688', '$2y$10$i6YZ34.LYIsw24dyyO7qz.nuM6J.D/0mF2djg1q3NPAwfctrAdEda', 'uploads/users/1776476197.png', 1, 7, NULL, NULL, '2026-04-17 19:36:37', '2026-04-17 19:36:37'),
(108, '20260418033', 5, 2, 'Md. Kutub Uddin Molla', 'md.kutubuddin@gmail.com', '01912302124', '123567899098877', '12321321345', '$2y$10$.lNB48rI7rrn1zB1n0uaMeUZfvNN.SE4qvppnKAUw6120blSVyS5y', 'uploads/users/Md. Kutub Uddin Molla-1317.jpg', 1, 1, NULL, NULL, '2026-04-17 21:29:55', '2026-04-17 21:29:55'),
(109, '20260418034', 5, 2, 'MD. MAHAMUD HASAN MUNSHI', NULL, '01720173076', NULL, '1010287801', '$2y$10$XzXdNfN72gMrVNINn1JZDuT.DXsNMj6XUim0xxDGKFoXKtdklDi06', NULL, 1, 1, NULL, NULL, '2026-04-18 00:53:55', '2026-04-18 00:53:55'),
(110, '20260419035', 6, 12, 'Akbor Ali', 'akbor.ali@gmail.com', '0123432132', NULL, NULL, '$2y$10$vGnBw12jfER1s/5sCWUYKOZj1xTnRnAJD.7D2yQBUK2VLDf4gJoLS', NULL, 1, NULL, NULL, NULL, '2026-04-19 09:40:14', '2026-04-19 09:42:14'),
(111, '20260422036', 5, 2, 'MD. SOHAG MIR', NULL, '01712055225', NULL, '1918253434', '$2y$10$HIxB1kRZSw8Nx2amKZb21OfkzmFHXhrOxtuAdkqh5VNd389e5k.o.', NULL, 1, 1, NULL, NULL, '2026-04-21 23:08:20', '2026-04-21 23:08:20'),
(112, '20260422037', 5, 2, 'MD NASIM BISWAS', 'roypijushkumar@gmail.com', '01400038143', '20083513230020649', NULL, '$2y$10$JWMSH3zLMOruRteAEpwJ5.cvcHvLT0.4PMX691otQ2PVtI5hHtMjG', NULL, 1, 1, 7, NULL, '2026-04-21 23:58:39', '2026-04-22 00:18:33'),
(113, '20260422038', 5, 2, 'MD NASIM BISWAS', 'mdnasimbiswas@gmail.com', '01400038143', '20083513230020649', NULL, '$2y$10$WVul0GSXD.X8ihwxVIzvleHnelf6fXR2BRjCo/ih8UTPEsaiK6/7e', NULL, 1, 1, 7, NULL, '2026-04-22 00:02:57', '2026-04-22 00:09:27'),
(114, '20260422039', 5, 2, 'MD FAHIM BISWAS BADON', 'roypijushkumar@gmail.com', '01779811040', '20093513230021267', NULL, '$2y$10$cSs5sP2Yx6z7Z2y4/Qfypeo3Nzh31eqmOO15hyYTKp2vl/KoUK5p.', NULL, 1, 1, 7, NULL, '2026-04-22 00:20:49', '2026-04-22 00:55:17'),
(115, '20260422040', 5, 2, 'RAKIBUL ISLAM FARJID', 'suktailudc@gmail.com', '0171000000000', '20013513286034935', NULL, '$2y$10$q33QWCtCQHH6jY937Nbufe/G3T3spswklAXu0WJVAJGaOPLes7gLm', NULL, 1, 7, NULL, NULL, '2026-04-22 05:46:38', '2026-04-22 05:46:38'),
(116, '20260422041', 5, 2, 'RAKIBUL ISLAM FARJID', NULL, '01710000000', '20013513286034935', NULL, '$2y$10$gmFI2OwhyAtHyRBg0GsO..zfOYTXO/8jPalqHWqpYqzhmy.2MBlEq', NULL, 1, 1, NULL, NULL, '2026-04-22 05:50:10', '2026-04-22 05:50:10'),
(117, '20260422042', 5, 2, 'MIZANUR SIKDER', NULL, '01348983049', NULL, '4196194163', '$2y$10$Ny36OYNeBBXMoKHiVyY9ieCb3rhCzmRKgOkgu286y69okeBOuU.OO', NULL, 1, 1, NULL, NULL, '2026-04-22 07:00:59', '2026-04-22 07:00:59'),
(118, '20260422043', 5, 2, 'Ali Azam Molla', 'aliazammolla@gmail.com', '01712302124', '4567', '123345', '$2y$10$cLAs1VemveYkX60GPQ91TeRN7tZDwaQYnYRimQNDV3Meyc2Gk.j1a', 'uploads/users/Ali Azam Molla-2340.jpg', 1, 1, 7, NULL, '2026-04-22 17:50:11', '2026-04-22 18:07:39'),
(119, '20260423044', 5, 2, 'Md. Shamim Hossain Molla', 'shamim@gmail.com', '01612302126', '23445556666', '2322345656', '$2y$10$ZzQVQXVkYPZAqlyKzgn4Lub8uVmx/MbxFxYCstDKSzqKketZc0Aii', 'uploads/users/Md. Shamim Hossain Molla-2774.jpg', 1, 1, 7, NULL, '2026-04-22 19:11:15', '2026-04-22 21:47:43'),
(120, '20260424045', 5, 2, 'Md. Alinur Islam Tutul', 'alinurtutul@gmail.com', '01712302124', '78976543216777', '76854321', '$2y$10$bQlG8xx0fLkt7o5UkVHEXuFy0noNMD85pIiSTsauCtFoIxQBRLAEG', 'uploads/users/Md. Alinur Islam Tutul-7270.jpg', 1, 1, 7, NULL, '2026-04-24 02:44:34', '2026-04-24 02:46:12'),
(121, '20260425046', 5, 2, 'Md. Sobhan Sheikh', 'md.sobhansheikh@gmail.com', '01859158014', '19553513286035235', NULL, '$2y$10$ZIs1rXbgGliS.V74y/tkO.rBCwb1Y8huC4g0YrnAyBoODKWaLz6Ca', 'uploads/users/20260425055342_121.jpg', 1, 1, 7, NULL, '2026-04-24 21:26:42', '2026-04-24 23:53:42'),
(122, '20260425046', 5, 2, 'md sobhan sheikh', NULL, '01859158014', '19553513286035235', NULL, '$2y$10$kN18.phDRQn/WVVJgJa5W.DQfJ/hdDJVXi4HXffrWMSoaUqLsrgQi', NULL, 1, 1, NULL, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(123, '20260425046', 5, 2, 'md sobhan sheikh', NULL, '01859158014', '19553513286035235', NULL, '$2y$10$j7b8FWnSFLll2jfboPGmqu4q3yzNMueoXg9BaUNXkRowL5TaXByfS', NULL, 1, 1, NULL, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(124, '20260425046', 5, 2, 'md sobhan sheikh', NULL, '01859158014', '19553513286035235', NULL, '$2y$10$NjzkSmzDJDUfW7/Nx3oN/.rbZ4h6PMD3H3cH8SOwFugWLJ6Hw3AXC', NULL, 1, 1, NULL, NULL, '2026-04-24 21:26:42', '2026-04-24 21:26:42'),
(125, '20260425047', 5, 2, 'Molla Toyabur Rahman', 'mollah.toyaburrahman@gmail.com', '01712322321', NULL, '6855670462', '$2y$10$dHvqUC5bC.4nmqlHfbBq0Opy6A06dIVsZBpRynIpBG8L2bA/xmkb.', 'uploads/users/Molla Toyabur Rahman-8581.jpg', 1, 1, 7, NULL, '2026-04-25 00:09:11', '2026-04-25 00:17:49'),
(126, '20260426048', 5, 2, 'Tareq Jamil Sarkar', 'tareqjamilsarkar@gmail.com', '01567952565', '28397348628', '3783687729', '$2y$10$uN/67vhqkWs8LpLgz.l6UODLjTj8D6pANv8b7vBJB7QEnJLYBTDs2', 'uploads/users/Tareq Jamil Sarkar-9788.jpg', 1, 1, NULL, NULL, '2026-04-25 23:32:04', '2026-04-25 23:32:04'),
(129, '20260426049', 5, 2, 'Tareq Jamil', 'tareqjamil@gmail.com', '01923897327', '237636476973', '23769827407', '$2y$10$tGQRLdyfHCxIuBrBLbSp1OVmPFToTg5gayzWvM6NeCz8Et.jFY33C', 'uploads/users/Tareq Jamil-3710.jpg', 1, 1, 7, NULL, '2026-04-26 00:32:46', '2026-04-26 01:02:16'),
(130, '20260426050', 5, 2, 'Tareq Jamil Sarkar', 'tareqjamilsarkar@gmail.com', '01567952565', NULL, '3783687729', '$2y$10$uTHovQkwEqo8YC28Sb0Cj.mVH2m3sCBFIChlmVNwKqbqAT9mCx3Aa', 'uploads/users/Tareq Jamil Sarkar-4334.jpg', 1, 1, 7, NULL, '2026-04-26 01:11:34', '2026-04-26 04:23:19'),
(131, '20260426051', 5, 2, 'Tareq Jamil Sarkar', 'tareqjamilsarkar@gmail.com', '01567952565', '28397348628', '3783687721', '$2y$10$NQLYh17NRtGJNdclwb7nse9a/nkAogJqvbpbijOg6nxlifDev74mu', 'uploads/users/Tareq Jamil Sarkar-1506.jpg', 1, 1, 7, NULL, '2026-04-26 04:25:04', '2026-04-26 04:29:31'),
(132, '20260427052', 5, NULL, 'Tareq Jamil Sarkar', 'tareqjamilsarkar@gmail.com', '01567952565', '237636476973', '3783687729', '$2y$10$Gq1Q1MYOMt39/LdKSeWPI.pZWLO6g4uOZGu3aWaGrh1pXm0uy2JPq', 'uploads/users/1777277071.jpg', 1, 7, NULL, NULL, '2026-04-27 02:04:31', '2026-04-27 02:04:31'),
(133, '20260427053', 5, NULL, 'Tareq Jamil Sarkar', 'tareqjamilsarkar@gmail.com', NULL, '237636476973', '3783687729', '$2y$10$gwbRAQGn4U2EKYD5zZDz1uotaky5y9y0Cs4Hr/I1tTQ2RfXE6t9j2', NULL, 1, 7, NULL, NULL, '2026-04-27 02:05:33', '2026-04-27 02:05:33'),
(134, '20260427054', 5, NULL, 'Tareq Jamil Sarkar', 'tareqjamilsarkar@gmail.com', '01567952565', '237636476973', '3783687729', '$2y$10$wSfLiZVUfZiPvLZMx67bcO8f1ICL4UqQX6LpD8oFbxPhsziploD3C', 'uploads/users/1777277515.jpg', 1, 7, 1, NULL, '2026-04-27 02:11:55', '2026-05-01 23:00:13'),
(135, '20260428055', 5, NULL, 'Tareq Jamil Sarkar', 'tareqjamilsarkar@gmail.com', NULL, NULL, NULL, '$2y$10$bJbKPkUAlj9SGaX.hKC14OIVUivWsHaM8Jl4MY7M5gCWtJfGB7fkm', 'uploads/users/1777371994.webp', 1, 7, NULL, NULL, '2026-04-28 04:26:34', '2026-04-28 04:26:34'),
(136, '20260502056', 5, NULL, 'Tareq Jamil Sarkar', 'tareqjamilsarkar@gmail.com', '01567952565', '237636476973', '3783687729', '$2y$10$Vhr2Q0IBYzFDCDFCaBeeK.GiOkQPW.0rit5/M5wAipWCaplKowWIi', NULL, 1, 1, NULL, NULL, '2026-05-01 23:27:41', '2026-05-01 23:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `new_activity` text NOT NULL,
  `old_activity` text DEFAULT NULL,
  `model` varchar(191) NOT NULL,
  `action` enum('store','update','delete') NOT NULL DEFAULT 'store',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_type` varchar(191) DEFAULT NULL,
  `vehicle_category` varchar(191) DEFAULT NULL,
  `vehicle_model` varchar(191) DEFAULT NULL,
  `make_year` varchar(191) DEFAULT NULL,
  `make_company` varchar(191) DEFAULT NULL,
  `ownership_type` varchar(191) DEFAULT NULL,
  `owner_id` varchar(191) DEFAULT NULL,
  `owner_name` varchar(191) DEFAULT NULL,
  `price` double(16,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_type`, `vehicle_category`, `vehicle_model`, `make_year`, `make_company`, `ownership_type`, `owner_id`, `owner_name`, `price`, `created_at`, `updated_at`) VALUES
(2, 'Auto', 'Rickshaw - রিকশা', '20020', '2026', 'XYZ', 'personal', '23876868279', 'Tareq', 238979.00, '2026-04-29 23:23:05', '2026-04-29 23:23:05'),
(5, 'Auto', 'Rickshaw - রিকশা', '20020', '2026', 'XYZ', 'personal', '23876868279', 'Tareq', 726376.00, '2026-04-29 23:30:13', '2026-04-29 23:30:13'),
(6, 'Auto', 'Rickshaw - রিকশা', '20020', '2026', 'XYZ', 'personal', '20260427054', 'Tareq Jamil Sarkar', 238979.00, '2026-04-30 04:57:08', '2026-05-01 20:20:22'),
(7, 'Auto', 'Rickshaw - রিকশা', '2002', '2025', 'XYZA', 'personal', '20260427052', 'Tareq Jamil Sarkar', 25000.00, '2026-05-01 20:12:46', '2026-05-01 20:12:46'),
(8, 'Auto', 'Rickshaw - রিকশা', '6789', '2025', 'ABC', 'personal', '51-510701-0007', 'Molla Toyabur Rahman', 29872.00, '2026-05-01 23:02:11', '2026-05-01 23:02:11'),
(9, 'Auto', 'Rickshaw - রিকশা', '2376', '2089', 'dhjhd', 'personal', '00-550502-0006', 'Md. Sobhan Sheikh', 27847.00, '2026-05-01 23:08:16', '2026-05-01 23:08:16'),
(10, 'Auto', 'Rickshaw - রিকশা', '2002', '2026', 'ABCDE', 'personal', '20260427052', 'Tareq Jamil Sarkar', 26732.00, '2026-05-02 00:17:03', '2026-05-02 00:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_categories`
--

CREATE TABLE `vehicle_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_sub_categories`
--

CREATE TABLE `vehicle_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_category_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `thana_id` bigint(20) UNSIGNED NOT NULL,
  `union_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `division_id`, `district_id`, `thana_id`, `union_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 6, 51, 385, 3503, 'Suktail Golapara', 'শুকতাইল গোলাপাড়া', NULL, 1, 1, 1, '2022-09-09 22:19:09', '2026-02-26 19:31:43'),
(3, 6, 51, 385, 3503, 'Paikerdanga', 'পাইকেরডাঙ্গা', NULL, 1, 1, NULL, '2022-12-04 22:19:54', '2022-12-04 22:19:54'),
(4, 6, 51, 385, 3503, 'Cor Suktail', 'চর শুকতাইল', NULL, 1, 1, NULL, '2022-12-04 22:21:43', '2022-12-04 22:21:43'),
(5, 6, 51, 385, 3503, 'Tala', 'তালা', NULL, 1, 1, NULL, '2022-12-04 22:22:28', '2022-12-04 22:22:28'),
(6, 6, 51, 385, 3503, 'Kekania', 'কেকানিয়া', NULL, 1, 1, NULL, '2022-12-04 22:23:46', '2022-12-04 22:23:46'),
(7, 6, 51, 385, 3503, 'Suktail Uttarpara', 'শুক্তাইল উত্তরপাড়া', NULL, 1, 1, NULL, '2026-02-26 19:28:57', '2026-02-26 19:28:57'),
(8, 6, 51, 385, 3503, 'Suktail Mollapara', 'শুকতাইল মোল্লাপাড়া', NULL, 1, 1, NULL, '2026-02-26 19:29:54', '2026-02-26 19:29:54'),
(9, 6, 51, 385, 3503, 'Suktail Borobari', 'শুকতাইল বড়বাড়ি', NULL, 1, 1, NULL, '2026-02-26 19:30:57', '2026-02-26 19:30:57'),
(10, 6, 51, 385, 3503, 'Suktail Sarderpara', 'শুকতাইল সর্দারপাড়া', NULL, 1, 1, NULL, '2026-02-26 19:32:54', '2026-02-26 19:32:54'),
(11, 6, 51, 385, 3503, 'Suktail Ghenasur', 'শুকতাইল ঘেনাসুর', NULL, 1, 1, NULL, '2026-02-26 19:33:52', '2026-02-26 19:33:52'),
(12, 6, 51, 385, 3503, 'Suktail Dakshinpara', 'শুকতাইল দক্ষিণপাড়া', NULL, 1, 1, NULL, '2026-02-26 19:35:40', '2026-02-26 19:35:40'),
(13, 6, 51, 385, 3503, 'Suktail Bonbari', 'শুকতাইল বনবাড়ি', NULL, 1, 1, NULL, '2026-02-26 19:36:46', '2026-02-26 19:36:46'),
(14, 6, 51, 385, 3503, 'Shucidanga', 'শুচিডাঙ্গা', NULL, 1, 1, NULL, '2026-04-15 10:09:48', '2026-04-15 10:09:48'),
(15, 6, 51, 385, 3503, 'Kuthibari', 'কুঠিবাড়ী', NULL, 1, 1, NULL, '2026-04-15 10:10:35', '2026-04-15 10:10:35'),
(16, 6, 51, 385, 3503, 'Par Chandradigholia', 'পার চন্দ্রদিঘলিয়া', NULL, 1, 1, NULL, '2026-04-15 10:11:40', '2026-04-15 10:11:40'),
(17, 6, 51, 385, 3503, 'Jogarchar', 'জগারচর', NULL, 1, 1, NULL, '2026-04-15 10:12:35', '2026-04-15 10:12:35'),
(20, 6, 51, 385, 3503, 'Char Tala', 'চর তালা', NULL, 1, 1, NULL, '2026-04-15 10:13:50', '2026-04-15 10:13:50'),
(21, 6, 51, 385, 3503, 'Moynapara', 'ময়নাপাড়া', NULL, 1, 1, NULL, '2026-04-15 10:14:42', '2026-04-15 10:14:42'),
(22, 6, 51, 385, 3503, 'Bonbari', 'বনবাড়ি', NULL, 1, 1, NULL, '2026-04-15 10:15:35', '2026-04-15 10:15:35'),
(23, 6, 51, 385, 3503, 'Par Joynagar', 'পার জয়নগর', NULL, 1, 1, NULL, '2026-04-15 10:16:26', '2026-04-15 10:16:26'),
(24, 6, 51, 385, 3503, 'Suktail', 'শুকতাইল', NULL, 1, 1, NULL, '2026-04-18 12:48:06', '2026-04-18 12:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `village_areas`
--

CREATE TABLE `village_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `thana_id` bigint(20) UNSIGNED NOT NULL,
  `union_id` bigint(20) UNSIGNED NOT NULL,
  `village_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=>Inactive, 1=>Active',
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `village_areas`
--

INSERT INTO `village_areas` (`id`, `division_id`, `district_id`, `thana_id`, `union_id`, `village_id`, `en_name`, `bn_name`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3, 25, 201, 1840, 1, 'West Side', 'পশ্চিম পাড়া', NULL, 1, 4, 4, '2022-12-28 13:47:19', '2022-12-28 14:17:24'),
(4, 3, 25, 201, 1840, 1, 'Ethan Gaines', 'Morgan Mack', NULL, 1, 3, 3, '2022-12-28 14:28:19', '2022-12-28 14:29:09'),
(5, 6, 51, 385, 3503, 2, 'Boro Bari', 'বড়বাড়ি', NULL, 1, 1, NULL, '2023-01-01 01:19:46', '2023-01-01 01:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `voter_area_certificates`
--

CREATE TABLE `voter_area_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voter_area_certificates`
--

INSERT INTO `voter_area_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:52:55', '2022-10-21 00:52:55'),
(2, '20260315002', 56, 0.00, 1, 0.00, 7, '2026-03-15 11:56:11', '2026-03-15 11:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `voter_list_certificates`
--

CREATE TABLE `voter_list_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voter_list_certificates`
--

INSERT INTO `voter_list_certificates` (`id`, `system_id`, `user_id`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, 0.00, 1, 0.00, 5, '2022-10-21 00:52:13', '2022-10-21 00:52:13'),
(2, '20260315002', 39, 0.00, 1, 0.00, 7, '2026-03-15 11:57:13', '2026-03-15 11:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yearly_income_certificates`
--

CREATE TABLE `yearly_income_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `monthly_income` decimal(10,2) DEFAULT NULL,
  `yearly_income` decimal(12,2) DEFAULT NULL,
  `fees` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yearly_income_certificates`
--

INSERT INTO `yearly_income_certificates` (`id`, `system_id`, `user_id`, `monthly_income`, `yearly_income`, `fees`, `quantity`, `total_amount`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '202210001', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-21 01:01:07', '2022-10-21 01:01:07'),
(2, '2022102', 6, NULL, NULL, 0.00, 1, 0.00, 5, '2022-10-21 01:01:45', '2022-10-21 01:01:45'),
(3, '20221218001', 8, NULL, NULL, 0.00, 1, 0.00, 7, '2022-12-18 03:28:42', '2022-12-18 03:28:42'),
(4, '20260312002', 9, 12.00, 144.00, 0.00, 1, 0.00, 7, '2026-03-11 23:54:41', '2026-03-11 23:54:41'),
(5, '20260415003', 86, 12000.00, 144000.00, 0.00, 1, 0.00, 7, '2026-04-14 21:11:59', '2026-04-14 21:11:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_types_en_name_unique` (`en_name`);

--
-- Indexes for table `address_infos`
--
ALTER TABLE `address_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `age_certificates`
--
ALTER TABLE `age_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `age_certificates_system_id_unique` (`system_id`),
  ADD KEY `age_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `area_infos`
--
ALTER TABLE `area_infos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `address_infos_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banks_en_name_unique` (`en_name`);

--
-- Indexes for table `birth_certificates`
--
ALTER TABLE `birth_certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `birth_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `bridges`
--
ALTER TABLE `bridges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_types`
--
ALTER TABLE `certificate_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `table_name` (`table_name`);

--
-- Indexes for table `chairman_area_details`
--
ALTER TABLE `chairman_area_details`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `chairman_area_infos`
--
ALTER TABLE `chairman_area_infos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `address_infos_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `chairman_mayors`
--
ALTER TABLE `chairman_mayors`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `people_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `people_religion_id_foreign` (`religion_id`) USING BTREE;

--
-- Indexes for table `chairman_mayors_old`
--
ALTER TABLE `chairman_mayors_old`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `character_certificates`
--
ALTER TABLE `character_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `character_certificates_system_id_unique` (`system_id`),
  ADD KEY `character_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `childless_certificates`
--
ALTER TABLE `childless_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `childless_certificates_system_id_unique` (`system_id`),
  ADD KEY `childless_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `citizen_certificates`
--
ALTER TABLE `citizen_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `citizen_certificates_system_id_unique` (`system_id`),
  ADD KEY `citizen_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `city_corporations`
--
ALTER TABLE `city_corporations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_corporations_slug_unique` (`slug`),
  ADD KEY `city_corporations_district_id_foreign` (`district_id`);

--
-- Indexes for table `city_corporation_wards`
--
ALTER TABLE `city_corporation_wards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `councils`
--
ALTER TABLE `councils`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `people_user_id_foreign` (`union_id`) USING BTREE;

--
-- Indexes for table `council_members`
--
ALTER TABLE `council_members`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `people_user_id_foreign` (`council_id`) USING BTREE;

--
-- Indexes for table `council_member_histories`
--
ALTER TABLE `council_member_histories`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `people_user_id_foreign` (`council_id`) USING BTREE;

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `death_certificates`
--
ALTER TABLE `death_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `death_certificates_system_id_unique` (`system_id`),
  ADD KEY `death_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `disability_certificates`
--
ALTER TABLE `disability_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `disability_certificates_system_id_unique` (`system_id`),
  ADD KEY `disability_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `disability_infos`
--
ALTER TABLE `disability_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disability_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_division_id_foreign` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `divisions_name_unique` (`name`),
  ADD UNIQUE KEY `divisions_bn_name_unique` (`bn_name`);

--
-- Indexes for table `divorces`
--
ALTER TABLE `divorces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educational_infos`
--
ALTER TABLE `educational_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `educational_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `family_categories`
--
ALTER TABLE `family_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `family_categories_en_name_unique` (`en_name`);

--
-- Indexes for table `family_infos`
--
ALTER TABLE `family_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family_infos_family_category_id_foreign` (`family_category_id`),
  ADD KEY `family_infos_family_type_id_foreign` (`family_type_id`),
  ADD KEY `family_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `family_sub_categories`
--
ALTER TABLE `family_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `family_sub_categories_en_name_unique` (`en_name`),
  ADD KEY `family_sub_categories_family_category_id_foreign` (`family_category_id`);

--
-- Indexes for table `family_types`
--
ALTER TABLE `family_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `family_types_en_name_unique` (`en_name`);

--
-- Indexes for table `financial_infos`
--
ALTER TABLE `financial_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `financial_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `financial_instability_certificates`
--
ALTER TABLE `financial_instability_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `financial_instability_certificates_system_id_unique` (`system_id`),
  ADD KEY `financial_instability_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `freedom_fighter_infos`
--
ALTER TABLE `freedom_fighter_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `freedom_fighter_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `guardian_certificates`
--
ALTER TABLE `guardian_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guardian_certificates_system_id_unique` (`system_id`),
  ADD KEY `guardian_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `health_infos`
--
ALTER TABLE `health_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `health_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house_categories`
--
ALTER TABLE `house_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `house_categories_en_name_unique` (`en_name`),
  ADD KEY `house_categories_house_type_id_foreign` (`house_type_id`);

--
-- Indexes for table `house_classes`
--
ALTER TABLE `house_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `house_classes_en_name_unique` (`en_name`),
  ADD KEY `house_classes_house_category_id_foreign` (`house_category_id`);

--
-- Indexes for table `house_ownerships`
--
ALTER TABLE `house_ownerships`
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `house_owner_types`
--
ALTER TABLE `house_owner_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `house_owner_types_en_name_unique` (`en_name`);

--
-- Indexes for table `house_types`
--
ALTER TABLE `house_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `house_types_en_name_unique` (`en_name`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute_categories`
--
ALTER TABLE `institute_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute_types`
--
ALTER TABLE `institute_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landless_certificates`
--
ALTER TABLE `landless_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `landless_certificates_system_id_unique` (`system_id`),
  ADD KEY `landless_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `lands`
--
ALTER TABLE `lands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_classes`
--
ALTER TABLE `land_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `land_classes_en_name_unique` (`en_name`),
  ADD KEY `land_classes_land_type_id_foreign` (`land_type_id`);

--
-- Indexes for table `land_ownership_types`
--
ALTER TABLE `land_ownership_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `land_ownership_types_en_name_unique` (`en_name`);

--
-- Indexes for table `land_types`
--
ALTER TABLE `land_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `land_types_en_name_unique` (`en_name`);

--
-- Indexes for table `login_activities`
--
ALTER TABLE `login_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_activities_user_id_index` (`user_id`);

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_categories`
--
ALTER TABLE `market_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `market_categories_en_name_unique` (`en_name`);

--
-- Indexes for table `market_ownership_types`
--
ALTER TABLE `market_ownership_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `market_ownership_types_en_name_unique` (`en_name`);

--
-- Indexes for table `market_types`
--
ALTER TABLE `market_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `market_types_en_name_unique` (`en_name`);

--
-- Indexes for table `marriages`
--
ALTER TABLE `marriages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `married_certificates`
--
ALTER TABLE `married_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `married_certificates_system_id_unique` (`system_id`),
  ADD KEY `married_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mouzas`
--
ALTER TABLE `mouzas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mouzas_thana_id_foreign` (`thana_id`);

--
-- Indexes for table `name_certificates`
--
ALTER TABLE `name_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_certificates_system_id_unique` (`system_id`),
  ADD KEY `name_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `nid_correction_certificates`
--
ALTER TABLE `nid_correction_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nid_correction_certificates_system_id_unique` (`system_id`),
  ADD KEY `nid_correction_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organizations_system_id_unique` (`system_id`),
  ADD UNIQUE KEY `application_id` (`application_id`),
  ADD KEY `organizations_institute_id_foreign` (`institute_id`);

--
-- Indexes for table `organization_categories`
--
ALTER TABLE `organization_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organization_categories_en_name_unique` (`en_name`);

--
-- Indexes for table `organization_fees`
--
ALTER TABLE `organization_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_ownerships`
--
ALTER TABLE `organization_ownerships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_ownerships_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `organization_ownership_types`
--
ALTER TABLE `organization_ownership_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organization_ownership_types_en_name_unique` (`en_name`);

--
-- Indexes for table `organization_subtypes`
--
ALTER TABLE `organization_subtypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_subtypes_organization_type_id_foreign` (`organization_type_id`);

--
-- Indexes for table `organization_sub_categories`
--
ALTER TABLE `organization_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_sub_categories_organization_category_id_foreign` (`organization_category_id`);

--
-- Indexes for table `organization_types`
--
ALTER TABLE `organization_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organization_types_en_name_unique` (`en_name`),
  ADD KEY `organization_types_organization_category_id_foreign` (`organization_category_id`);

--
-- Indexes for table `organization_work_areas`
--
ALTER TABLE `organization_work_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_work_areas_organization_category_id_foreign` (`organization_category_id`),
  ADD KEY `organization_work_areas_organization_subcategory_id_foreign` (`organization_subcategory_id`);

--
-- Indexes for table `orphan_certificates`
--
ALTER TABLE `orphan_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orphan_certificates_system_id_unique` (`system_id`),
  ADD KEY `orphan_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `parent_infos`
--
ALTER TABLE `parent_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `approved_id` (`approved_id`),
  ADD KEY `people_user_id_foreign` (`user_id`),
  ADD KEY `people_religion_id_foreign` (`religion_id`);

--
-- Indexes for table `permanent_citizen_certificates`
--
ALTER TABLE `permanent_citizen_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permanent_citizen_certificates_system_id_unique` (`system_id`),
  ADD KEY `permanent_citizen_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post_offices`
--
ALTER TABLE `post_offices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_offices_thana_id_foreign` (`thana_id`);

--
-- Indexes for table `pourashavas`
--
ALTER TABLE `pourashavas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pourashavas_slug_unique` (`slug`),
  ADD KEY `pourashavas_district_id_foreign` (`district_id`);

--
-- Indexes for table `professional_infos`
--
ALTER TABLE `professional_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professional_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `professions_en_name_unique` (`en_name`);

--
-- Indexes for table `profession_categories`
--
ALTER TABLE `profession_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profession_categories_profession_type_id_foreign` (`profession_type_id`);

--
-- Indexes for table `profession_sub_categories`
--
ALTER TABLE `profession_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profession_sub_categories_profession_category_id_foreign` (`profession_category_id`);

--
-- Indexes for table `profession_types`
--
ALTER TABLE `profession_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profession_types_en_name_unique` (`en_name`),
  ADD KEY `profession_types_profession_id_foreign` (`profession_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_types`
--
ALTER TABLE `project_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_infos`
--
ALTER TABLE `property_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `religions_slug_unique` (`slug`);

--
-- Indexes for table `remarried_certificates`
--
ALTER TABLE `remarried_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `remarried_certificates_system_id_unique` (`system_id`),
  ADD KEY `remarried_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `residential_certificates`
--
ALTER TABLE `residential_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `residential_certificates_system_id_unique` (`system_id`),
  ADD KEY `residential_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `roads`
--
ALTER TABLE `roads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `road_categories`
--
ALTER TABLE `road_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `road_categories_en_name_unique` (`en_name`);

--
-- Indexes for table `road_owners`
--
ALTER TABLE `road_owners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `road_owners_en_name_unique` (`en_name`);

--
-- Indexes for table `road_types`
--
ALTER TABLE `road_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `road_types_en_name_unique` (`en_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`) USING BTREE,
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`) USING BTREE;

--
-- Indexes for table `successions`
--
ALTER TABLE `successions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `successions_user_id_foreign` (`user_id`),
  ADD KEY `successions_death_certificate_id_foreign` (`death_certificate_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_years`
--
ALTER TABLE `tax_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thanas_district_id_foreign` (`district_id`);

--
-- Indexes for table `trade_licenses`
--
ALTER TABLE `trade_licenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_licenses_backup`
--
ALTER TABLE `trade_licenses_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_license_manual_payments`
--
ALTER TABLE `trade_license_manual_payments`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `trade_license_manual_payments_transaction_id_unique` (`transaction_id`),
  ADD KEY `trade_license_manual_payments_trade_license_id_index` (`trade_license_id`);

--
-- Indexes for table `unions`
--
ALTER TABLE `unions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unions_thana_id_foreign` (`thana_id`);

--
-- Indexes for table `union_wards`
--
ALTER TABLE `union_wards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unmarried_certificates`
--
ALTER TABLE `unmarried_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unmarried_certificates_system_id_unique` (`system_id`),
  ADD KEY `unmarried_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activities_user_id_index` (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_categories`
--
ALTER TABLE `vehicle_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_categories_en_name_unique` (`en_name`);

--
-- Indexes for table `vehicle_sub_categories`
--
ALTER TABLE `vehicle_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_sub_categories_en_name_unique` (`en_name`),
  ADD KEY `vehicle_sub_categories_vehicle_category_id_foreign` (`vehicle_category_id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_types_en_name_unique` (`en_name`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `villages_en_name_unique` (`en_name`),
  ADD KEY `villages_division_id_foreign` (`division_id`),
  ADD KEY `villages_district_id_foreign` (`district_id`),
  ADD KEY `villages_thana_id_foreign` (`thana_id`),
  ADD KEY `villages_union_id_foreign` (`union_id`);

--
-- Indexes for table `village_areas`
--
ALTER TABLE `village_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `village_areas_division_id_foreign` (`division_id`),
  ADD KEY `village_areas_district_id_foreign` (`district_id`),
  ADD KEY `village_areas_thana_id_foreign` (`thana_id`),
  ADD KEY `village_areas_union_id_foreign` (`union_id`),
  ADD KEY `village_areas_village_id_foreign` (`village_id`);

--
-- Indexes for table `voter_area_certificates`
--
ALTER TABLE `voter_area_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voter_area_certificates_system_id_unique` (`system_id`),
  ADD KEY `voter_area_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `voter_list_certificates`
--
ALTER TABLE `voter_list_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voter_list_certificates_system_id_unique` (`system_id`),
  ADD KEY `voter_list_certificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yearly_income_certificates`
--
ALTER TABLE `yearly_income_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `yearly_income_certificates_system_id_unique` (`system_id`),
  ADD KEY `yearly_income_certificates_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `address_infos`
--
ALTER TABLE `address_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `age_certificates`
--
ALTER TABLE `age_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `area_infos`
--
ALTER TABLE `area_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `birth_certificates`
--
ALTER TABLE `birth_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bridges`
--
ALTER TABLE `bridges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_types`
--
ALTER TABLE `certificate_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `chairman_area_details`
--
ALTER TABLE `chairman_area_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chairman_area_infos`
--
ALTER TABLE `chairman_area_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chairman_mayors`
--
ALTER TABLE `chairman_mayors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `chairman_mayors_old`
--
ALTER TABLE `chairman_mayors_old`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `character_certificates`
--
ALTER TABLE `character_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `childless_certificates`
--
ALTER TABLE `childless_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `citizen_certificates`
--
ALTER TABLE `citizen_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `city_corporations`
--
ALTER TABLE `city_corporations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `city_corporation_wards`
--
ALTER TABLE `city_corporation_wards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `councils`
--
ALTER TABLE `councils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `council_members`
--
ALTER TABLE `council_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `council_member_histories`
--
ALTER TABLE `council_member_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `death_certificates`
--
ALTER TABLE `death_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disability_certificates`
--
ALTER TABLE `disability_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disability_infos`
--
ALTER TABLE `disability_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `divorces`
--
ALTER TABLE `divorces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `educational_infos`
--
ALTER TABLE `educational_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_categories`
--
ALTER TABLE `family_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `family_infos`
--
ALTER TABLE `family_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `family_sub_categories`
--
ALTER TABLE `family_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `family_types`
--
ALTER TABLE `family_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `financial_infos`
--
ALTER TABLE `financial_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `financial_instability_certificates`
--
ALTER TABLE `financial_instability_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `freedom_fighter_infos`
--
ALTER TABLE `freedom_fighter_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guardian_certificates`
--
ALTER TABLE `guardian_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `health_infos`
--
ALTER TABLE `health_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `house_categories`
--
ALTER TABLE `house_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `house_classes`
--
ALTER TABLE `house_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house_ownerships`
--
ALTER TABLE `house_ownerships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `house_owner_types`
--
ALTER TABLE `house_owner_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `house_types`
--
ALTER TABLE `house_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `institute_categories`
--
ALTER TABLE `institute_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institute_types`
--
ALTER TABLE `institute_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `landless_certificates`
--
ALTER TABLE `landless_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lands`
--
ALTER TABLE `lands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `land_classes`
--
ALTER TABLE `land_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `land_ownership_types`
--
ALTER TABLE `land_ownership_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `land_types`
--
ALTER TABLE `land_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_activities`
--
ALTER TABLE `login_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `market_categories`
--
ALTER TABLE `market_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `market_ownership_types`
--
ALTER TABLE `market_ownership_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `market_types`
--
ALTER TABLE `market_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marriages`
--
ALTER TABLE `marriages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `married_certificates`
--
ALTER TABLE `married_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `mouzas`
--
ALTER TABLE `mouzas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `name_certificates`
--
ALTER TABLE `name_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `nid_correction_certificates`
--
ALTER TABLE `nid_correction_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `organization_categories`
--
ALTER TABLE `organization_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `organization_fees`
--
ALTER TABLE `organization_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `organization_ownerships`
--
ALTER TABLE `organization_ownerships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `organization_ownership_types`
--
ALTER TABLE `organization_ownership_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organization_subtypes`
--
ALTER TABLE `organization_subtypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization_sub_categories`
--
ALTER TABLE `organization_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `organization_types`
--
ALTER TABLE `organization_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `organization_work_areas`
--
ALTER TABLE `organization_work_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orphan_certificates`
--
ALTER TABLE `orphan_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parent_infos`
--
ALTER TABLE `parent_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `permanent_citizen_certificates`
--
ALTER TABLE `permanent_citizen_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_offices`
--
ALTER TABLE `post_offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=586;

--
-- AUTO_INCREMENT for table `pourashavas`
--
ALTER TABLE `pourashavas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `professional_infos`
--
ALTER TABLE `professional_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profession_categories`
--
ALTER TABLE `profession_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `profession_sub_categories`
--
ALTER TABLE `profession_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `profession_types`
--
ALTER TABLE `profession_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_types`
--
ALTER TABLE `project_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_infos`
--
ALTER TABLE `property_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `remarried_certificates`
--
ALTER TABLE `remarried_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `residential_certificates`
--
ALTER TABLE `residential_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roads`
--
ALTER TABLE `roads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `road_categories`
--
ALTER TABLE `road_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `road_owners`
--
ALTER TABLE `road_owners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `road_types`
--
ALTER TABLE `road_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `successions`
--
ALTER TABLE `successions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_years`
--
ALTER TABLE `tax_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=563;

--
-- AUTO_INCREMENT for table `trade_licenses`
--
ALTER TABLE `trade_licenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trade_licenses_backup`
--
ALTER TABLE `trade_licenses_backup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trade_license_manual_payments`
--
ALTER TABLE `trade_license_manual_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unions`
--
ALTER TABLE `unions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4541;

--
-- AUTO_INCREMENT for table `union_wards`
--
ALTER TABLE `union_wards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `unmarried_certificates`
--
ALTER TABLE `unmarried_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicle_categories`
--
ALTER TABLE `vehicle_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_sub_categories`
--
ALTER TABLE `vehicle_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `village_areas`
--
ALTER TABLE `village_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voter_area_certificates`
--
ALTER TABLE `voter_area_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `voter_list_certificates`
--
ALTER TABLE `voter_list_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yearly_income_certificates`
--
ALTER TABLE `yearly_income_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address_infos`
--
ALTER TABLE `address_infos`
  ADD CONSTRAINT `address_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `age_certificates`
--
ALTER TABLE `age_certificates`
  ADD CONSTRAINT `age_certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `area_infos`
--
ALTER TABLE `area_infos`
  ADD CONSTRAINT `area_infos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `birth_certificates`
--
ALTER TABLE `birth_certificates`
  ADD CONSTRAINT `birth_certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chairman_area_infos`
--
ALTER TABLE `chairman_area_infos`
  ADD CONSTRAINT `chairman_area_infos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chairman_mayors`
--
ALTER TABLE `chairman_mayors`
  ADD CONSTRAINT `chairman_mayors_ibfk_1` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`),
  ADD CONSTRAINT `chairman_mayors_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `character_certificates`
--
ALTER TABLE `character_certificates`
  ADD CONSTRAINT `character_certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organization_subtypes`
--
ALTER TABLE `organization_subtypes`
  ADD CONSTRAINT `organization_subtypes_organization_type_id_foreign` FOREIGN KEY (`organization_type_id`) REFERENCES `organization_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
