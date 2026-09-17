-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2026 at 03:14 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `middev5a_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('active','suspended','trial','inactive') DEFAULT 'trial',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_name` varchar(255) DEFAULT NULL,
  `plan_start_date` date DEFAULT NULL,
  `plan_end_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `lead_creator_limit` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `telecaller_limit` int(10) UNSIGNED NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`id`, `name`, `email`, `status`, `created_at`, `updated_at`, `plan_name`, `plan_start_date`, `plan_end_date`, `price`, `lead_creator_limit`, `telecaller_limit`) VALUES
(4, 'dsfds', 'df@gmail.com', 'inactive', '2025-08-11 01:29:03', '2025-08-29 18:30:05', 'Trial Plan 2', '2025-08-14', '2025-08-29', 10000.00, 2, 5),
(5, 'Midbrains Technologies', 'info@midbrains.in', 'inactive', '2025-08-11 22:53:21', '2025-09-13 18:30:04', '1 month', '2025-08-13', '2025-09-13', 15000.00, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `name` varchar(1111) NOT NULL,
  `created_by` int(111) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`id`, `created_at`, `updated_at`, `status`, `is_delete`, `name`, `created_by`) VALUES
(1, '2024-05-31 05:59:43', '2024-05-31 05:59:43', '1', '0', 'Tejas', 1),
(2, '2025-08-07 08:00:49', '2025-08-07 08:00:49', '1', '0', 'John', 10),
(3, '2025-08-26 12:52:38', '2025-08-26 12:52:38', '1', '0', 'Trial Master', 37);

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(1111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_one` varchar(1111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_two` varchar(1111) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(255) NOT NULL,
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_by` int(255) NOT NULL DEFAULT '0',
  `masterid` int(255) NOT NULL DEFAULT '0',
  `plateform` enum('facebook','creator','other') NOT NULL DEFAULT 'creator',
  `name` varchar(1111) NOT NULL,
  `mobile` varchar(1111) NOT NULL,
  `email` varchar(1111) DEFAULT NULL,
  `company` varchar(1111) DEFAULT NULL,
  `source` varchar(1111) DEFAULT NULL,
  `title` varchar(1111) DEFAULT NULL,
  `description` text,
  `age` varchar(255) DEFAULT NULL,
  `is_married` enum('0','1') DEFAULT NULL,
  `occupation` varchar(1111) DEFAULT NULL,
  `is_xerox` enum('0','1') DEFAULT NULL,
  `come_from` varchar(1111) DEFAULT NULL,
  `problem` text,
  `problem_detail` text,
  `addr` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `business_id`, `created_at`, `updated_at`, `status`, `is_delete`, `created_by`, `masterid`, `plateform`, `name`, `mobile`, `email`, `company`, `source`, `title`, `description`, `age`, `is_married`, `occupation`, `is_xerox`, `come_from`, `problem`, `problem_detail`, `addr`) VALUES
(20, 4, '2025-08-11 09:03:59', '2025-08-11 09:04:33', '1', '0', 15, 2, 'creator', 'try', '1231231231', 'try@gmail.com', 'Midbrains Technologies', 'Linkedin', 'try d', 'tryfg sdgdsf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 4, '2025-08-13 08:05:22', '2025-08-13 08:05:22', '1', '0', 24, 0, 'creator', 'ig', 'Triual', '55566677789', NULL, 'Excelsheet', 'triual@gmail.com', 'bscd enquiry Pune blah blah sda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 4, '2025-08-19 05:39:12', '2025-08-19 05:39:12', '1', '0', 24, 0, 'creator', 'ig', 'Triual', '55566677789', NULL, 'Excelsheet', 'triual@gmail.com', 'bscd enquiry Pune blah blah sda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, NULL, '2025-08-26 12:52:38', '2025-08-26 12:52:38', '1', '0', 37, 3, 'creator', 'Trial Lead 1', '3423532523', 'tlead1@gmail.com', 'try', 'fsd', 'sdasad', 'sadsad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 4, '2025-08-26 12:55:42', '2025-08-26 12:55:42', '1', '0', 37, 3, 'creator', 'dsf', '789798789789', 'dfsfsdf@gmail.com', 'sadsad', 'sadsadsad', 'sdsadasd', 'sadasdasa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, NULL, '2026-05-09 13:20:50', '2026-05-09 13:20:50', '1', '0', 2, 3, 'creator', 'Hello Dummy', '9869869866', 'hellodummy@gmail.com', 'Hi Dummy', 'Google', 'New Trial', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lead_management`
--

CREATE TABLE `lead_management` (
  `id` int(255) NOT NULL,
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `lead_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `is_forward` enum('0','1') NOT NULL DEFAULT '0',
  `forword_id` int(255) DEFAULT NULL,
  `lead_type` enum('callback','ringing','switchoff','new','t_approve','t_delete','t_process','t_hot','t_complete','a_approve','a_process','a_complete') NOT NULL DEFAULT 'new',
  `is_captured` enum('0','1') NOT NULL DEFAULT '0',
  `capture_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lead_management`
--

INSERT INTO `lead_management` (`id`, `business_id`, `created_at`, `updated_at`, `is_delete`, `status`, `lead_id`, `user_id`, `is_forward`, `forword_id`, `lead_type`, `is_captured`, `capture_time`) VALUES
(8, NULL, '2024-05-31 06:00:22', '2024-06-01 05:09:15', '0', '1', 11, 5, '0', NULL, 't_hot', '1', '2024-05-31 06:01:19'),
(9, NULL, '2024-05-31 06:00:22', '2024-05-31 09:18:13', '0', '1', 10, 5, '0', NULL, 't_process', '1', '2024-05-31 06:01:19'),
(10, NULL, '2024-05-31 06:00:22', '2024-05-31 09:19:36', '0', '1', 9, 5, '0', NULL, 't_process', '1', '2024-05-31 06:01:19'),
(11, NULL, '2024-05-31 06:00:22', '2024-05-31 09:20:28', '0', '1', 8, 5, '0', NULL, 't_process', '1', '2024-05-31 06:01:19'),
(12, NULL, '2024-05-31 06:00:22', '2024-05-31 09:23:18', '0', '1', 7, 5, '0', NULL, 't_process', '1', '2024-05-31 06:01:19'),
(13, NULL, '2024-06-01 04:48:44', '2024-06-01 12:58:35', '0', '1', 18, 5, '0', NULL, 'switchoff', '1', '2024-06-01 04:51:51'),
(14, NULL, '2024-06-01 04:48:44', '2024-06-01 04:51:51', '0', '1', 17, 5, '0', NULL, 'new', '1', '2024-06-01 04:51:51'),
(15, NULL, '2024-06-01 04:48:44', '2024-06-01 04:51:51', '0', '1', 16, 5, '0', NULL, 'new', '1', '2024-06-01 04:51:51'),
(16, NULL, '2024-06-01 04:48:44', '2024-06-01 04:51:51', '0', '1', 15, 5, '0', NULL, 'new', '1', '2024-06-01 04:51:51'),
(17, NULL, '2024-06-01 04:48:44', '2024-06-01 04:51:51', '0', '1', 14, 5, '0', NULL, 'new', '1', '2024-06-01 04:51:51'),
(18, NULL, '2024-06-01 04:48:44', '2024-06-01 04:51:51', '0', '1', 13, 5, '0', NULL, 'new', '1', '2024-06-01 04:51:51'),
(19, NULL, '2025-08-19 05:01:46', '2025-08-19 05:01:46', '0', '1', 21, 3, '0', NULL, 'new', '0', NULL),
(20, NULL, '2025-08-19 05:08:24', '2025-08-19 05:11:05', '0', '1', 20, 33, '0', NULL, 'new', '1', '2025-08-19 05:11:05'),
(21, NULL, '2025-08-26 12:56:28', '2025-08-26 12:57:58', '0', '1', 24, 33, '0', NULL, 'new', '1', '2025-08-26 12:57:58'),
(22, NULL, '2026-05-09 13:21:01', '2026-05-09 13:22:14', '0', '1', 25, 3, '0', NULL, 't_approve', '1', '2026-05-09 13:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `lead_reminder`
--

CREATE TABLE `lead_reminder` (
  `id` int(255) NOT NULL,
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `lead_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `next_date` date NOT NULL,
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lead_reminder`
--

INSERT INTO `lead_reminder` (`id`, `business_id`, `created_at`, `updated_at`, `is_delete`, `status`, `lead_id`, `user_id`, `next_date`, `remarks`) VALUES
(1, NULL, '2024-05-31 06:02:38', '2024-05-31 09:16:30', '1', '0', 12, 5, '2024-05-31', 'Callback evening'),
(2, NULL, '2024-05-31 09:33:54', '2024-06-01 05:09:15', '1', '0', 11, 5, '2024-06-05', 'Age 50 package 50k HT'),
(3, NULL, '2024-06-01 04:55:44', '2024-06-01 12:58:35', '1', '0', 18, 5, '2024-06-02', 'Ghtnthggnng'),
(4, NULL, '2024-06-01 05:07:27', '2024-06-01 12:58:35', '1', '0', 18, 5, '2024-06-05', 'GFC SUggest');

-- --------------------------------------------------------

--
-- Table structure for table `lead_status`
--

CREATE TABLE `lead_status` (
  `id` int(255) NOT NULL,
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `lead_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `icon` varchar(1111) NOT NULL DEFAULT 'fa-envelope',
  `bgcolor` varchar(111) NOT NULL DEFAULT 'yellow',
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lead_status`
--

INSERT INTO `lead_status` (`id`, `business_id`, `created_at`, `updated_at`, `date`, `is_delete`, `status`, `lead_id`, `user_id`, `icon`, `bgcolor`, `remarks`) VALUES
(1, NULL, '2024-05-31 05:52:44', '2024-05-31 05:52:44', '2024-05-31', '0', '1', 6, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(2, NULL, '2024-05-31 05:52:44', '2024-05-31 05:52:44', '2024-05-31', '0', '1', 5, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(3, NULL, '2024-05-31 05:52:44', '2024-05-31 05:52:44', '2024-05-31', '0', '1', 4, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(4, NULL, '2024-05-31 05:52:44', '2024-05-31 05:52:44', '2024-05-31', '0', '1', 3, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(5, NULL, '2024-05-31 05:52:44', '2024-05-31 05:52:44', '2024-05-31', '0', '1', 2, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(6, NULL, '2024-05-31 05:52:44', '2024-05-31 05:52:44', '2024-05-31', '0', '1', 1, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(7, NULL, '2024-05-31 05:54:53', '2024-05-31 05:54:53', '2024-05-31', '0', '1', 6, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(8, NULL, '2024-05-31 05:54:53', '2024-05-31 05:54:53', '2024-05-31', '0', '1', 5, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(9, NULL, '2024-05-31 05:54:53', '2024-05-31 05:54:53', '2024-05-31', '0', '1', 4, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(10, NULL, '2024-05-31 05:54:53', '2024-05-31 05:54:53', '2024-05-31', '0', '1', 3, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(11, NULL, '2024-05-31 05:54:53', '2024-05-31 05:54:53', '2024-05-31', '0', '1', 2, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(12, NULL, '2024-05-31 05:54:53', '2024-05-31 05:54:53', '2024-05-31', '0', '1', 1, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(13, NULL, '2024-05-31 05:59:43', '2024-05-31 05:59:43', '2024-05-31', '0', '1', 12, 1, 'fa-check', 'blue', 'Lead Information Updated'),
(14, NULL, '2024-05-31 06:00:09', '2024-05-31 06:00:09', '2024-05-31', '0', '1', 12, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(15, NULL, '2024-05-31 06:00:22', '2024-05-31 06:00:22', '2024-05-31', '0', '1', 11, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(16, NULL, '2024-05-31 06:00:22', '2024-05-31 06:00:22', '2024-05-31', '0', '1', 10, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(17, NULL, '2024-05-31 06:00:22', '2024-05-31 06:00:22', '2024-05-31', '0', '1', 9, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(18, NULL, '2024-05-31 06:00:22', '2024-05-31 06:00:22', '2024-05-31', '0', '1', 8, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(19, NULL, '2024-05-31 06:00:22', '2024-05-31 06:00:22', '2024-05-31', '0', '1', 7, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(20, NULL, '2024-05-31 06:01:19', '2024-05-31 06:01:19', '2024-05-31', '0', '1', 12, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(21, NULL, '2024-05-31 06:01:19', '2024-05-31 06:01:19', '2024-05-31', '0', '1', 11, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(22, NULL, '2024-05-31 06:01:19', '2024-05-31 06:01:19', '2024-05-31', '0', '1', 10, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(23, NULL, '2024-05-31 06:01:19', '2024-05-31 06:01:19', '2024-05-31', '0', '1', 9, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(24, NULL, '2024-05-31 06:01:19', '2024-05-31 06:01:19', '2024-05-31', '0', '1', 8, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(25, NULL, '2024-05-31 06:01:19', '2024-05-31 06:01:19', '2024-05-31', '0', '1', 7, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(26, NULL, '2024-05-31 06:02:38', '2024-05-31 06:02:38', '2024-05-31', '0', '1', 12, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Process </b> by remarks:- Callback evening'),
(27, NULL, '2024-05-31 06:02:38', '2024-05-31 06:02:38', '2024-05-31', '0', '1', 12, 5, 'fa-envelope', 'yellow', 'Lead Marked for next review on May 31, 2024'),
(28, NULL, '2024-05-31 09:16:30', '2024-05-31 09:16:30', '2024-05-31', '0', '1', 12, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Process </b> by remarks:- Ringing callback'),
(29, NULL, '2024-05-31 09:18:13', '2024-05-31 09:18:13', '2024-05-31', '0', '1', 10, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Process </b> by remarks:- Out of service'),
(30, NULL, '2024-05-31 09:19:36', '2024-05-31 09:19:36', '2024-05-31', '0', '1', 9, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Process </b> by remarks:- Callback after 5'),
(31, NULL, '2024-05-31 09:20:28', '2024-05-31 09:20:28', '2024-05-31', '0', '1', 8, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Process </b> by remarks:- Ringing callback'),
(32, NULL, '2024-05-31 09:23:18', '2024-05-31 09:23:18', '2024-05-31', '0', '1', 7, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Process </b> by remarks:- Age 33 can\'t come too long'),
(33, NULL, '2024-05-31 09:33:54', '2024-05-31 09:33:54', '2024-05-31', '0', '1', 11, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Hot </b> by remarks:- Age 50 package 50k HT'),
(34, NULL, '2024-05-31 09:33:54', '2024-05-31 09:33:54', '2024-05-31', '0', '1', 11, 5, 'fa-envelope', 'yellow', 'Lead Marked for next review on Jun 05, 2024'),
(35, NULL, '2024-06-01 04:48:44', '2024-06-01 04:48:44', '2024-06-01', '0', '1', 18, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(36, NULL, '2024-06-01 04:48:44', '2024-06-01 04:48:44', '2024-06-01', '0', '1', 17, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(37, NULL, '2024-06-01 04:48:44', '2024-06-01 04:48:44', '2024-06-01', '0', '1', 16, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(38, NULL, '2024-06-01 04:48:44', '2024-06-01 04:48:44', '2024-06-01', '0', '1', 15, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(39, NULL, '2024-06-01 04:48:44', '2024-06-01 04:48:44', '2024-06-01', '0', '1', 14, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(40, NULL, '2024-06-01 04:48:44', '2024-06-01 04:48:44', '2024-06-01', '0', '1', 13, 1, 'fa-envelope', 'yellow', 'Lead Transferred'),
(41, NULL, '2024-06-01 04:51:51', '2024-06-01 04:51:51', '2024-06-01', '0', '1', 18, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(42, NULL, '2024-06-01 04:51:51', '2024-06-01 04:51:51', '2024-06-01', '0', '1', 17, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(43, NULL, '2024-06-01 04:51:51', '2024-06-01 04:51:51', '2024-06-01', '0', '1', 16, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(44, NULL, '2024-06-01 04:51:51', '2024-06-01 04:51:51', '2024-06-01', '0', '1', 15, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(45, NULL, '2024-06-01 04:51:51', '2024-06-01 04:51:51', '2024-06-01', '0', '1', 14, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(46, NULL, '2024-06-01 04:51:51', '2024-06-01 04:51:51', '2024-06-01', '0', '1', 13, 5, 'fa-thumbs-up', 'green', 'Lead Captured'),
(47, NULL, '2024-06-01 04:55:44', '2024-06-01 04:55:44', '2024-06-01', '0', '1', 18, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Process </b> by remarks:- Ghtnthggnng'),
(48, NULL, '2024-06-01 04:55:44', '2024-06-01 04:55:44', '2024-06-01', '0', '1', 18, 5, 'fa-envelope', 'yellow', 'Lead Marked for next review on Jun 02, 2024'),
(49, NULL, '2024-06-01 05:07:27', '2024-06-01 05:07:27', '2024-06-01', '0', '1', 18, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Process </b> by remarks:- GFC SUggest'),
(50, NULL, '2024-06-01 05:07:27', '2024-06-01 05:07:27', '2024-06-01', '0', '1', 18, 5, 'fa-envelope', 'yellow', 'Lead Marked for next review on Jun 05, 2024'),
(51, NULL, '2024-06-01 05:09:15', '2024-06-01 05:09:15', '2024-06-01', '0', '1', 11, 5, 'fa-envelope', 'yellow', 'Lead Marked <b>Hot </b> by remarks:- appointment for 5 june 1st GFC'),
(52, NULL, '2024-06-01 12:57:29', '2024-06-01 12:57:29', '2024-06-01', '0', '1', 18, 5, 'fa-envelope', 'yellow', 'Lead Marked <b></b> by remarks:- Age 33 can\'t come too long'),
(53, NULL, '2024-06-01 12:58:35', '2024-06-01 12:58:35', '2024-06-01', '0', '1', 18, 5, 'fa-envelope', 'yellow', 'Lead Marked <b></b> by remarks:- Out of service'),
(54, NULL, '2025-08-19 05:01:46', '2025-08-19 05:01:46', '2025-08-19', '0', '1', 21, 24, 'fa-envelope', 'yellow', 'Lead Transferred'),
(55, NULL, '2025-08-19 05:08:24', '2025-08-19 05:08:24', '2025-08-19', '0', '1', 20, 24, 'fa-envelope', 'yellow', 'Lead Transferred'),
(56, NULL, '2025-08-19 05:11:05', '2025-08-19 05:11:05', '2025-08-19', '0', '1', 20, 33, 'fa-thumbs-up', 'green', 'Lead Captured'),
(57, NULL, '2025-08-26 12:56:28', '2025-08-26 12:56:28', '2025-08-26', '0', '1', 24, 24, 'fa-envelope', 'yellow', 'Lead Transferred'),
(58, NULL, '2025-08-26 12:57:58', '2025-08-26 12:57:58', '2025-08-26', '0', '1', 24, 33, 'fa-thumbs-up', 'green', 'Lead Captured'),
(59, NULL, '2026-05-09 13:21:01', '2026-05-09 13:21:01', '2026-05-09', '0', '1', 25, 2, 'fa-envelope', 'yellow', 'Lead Transferred'),
(60, NULL, '2026-05-09 13:21:07', '2026-05-09 13:21:07', '2026-05-09', '0', '1', 25, 3, 'fa-thumbs-up', 'green', 'Lead Captured'),
(61, NULL, '2026-05-09 13:22:14', '2026-05-09 13:22:14', '2026-05-09', '0', '1', 25, 1, 'fa-envelope', 'yellow', 'Lead Marked <b></b> by remarks:- Take update');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, 'business_table', 1),
(2, '2025_08_25_064849_add_role_limits_to_businesses_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(255) NOT NULL,
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_line` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `is_read` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymenttaken`
--

CREATE TABLE `paymenttaken` (
  `id` int(255) NOT NULL,
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `leadid` int(255) NOT NULL,
  `payment` int(255) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `duration_days` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `max_users` int(11) DEFAULT NULL,
  `max_leads` int(11) DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(255) NOT NULL,
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `name` varchar(1111) NOT NULL,
  `short` text,
  `photo` varchar(1111) DEFAULT NULL,
  `seq` int(255) DEFAULT NULL,
  `is_home` enum('0','1') NOT NULL DEFAULT '1',
  `is_menu` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `business_id`, `created_at`, `updated_at`, `is_delete`, `status`, `name`, `short`, `photo`, `seq`, `is_home`, `is_menu`) VALUES
(1, NULL, '2024-05-31 00:06:00', '2024-05-31 00:06:00', '0', '1', 'HT HAIR TRANSPLANT', NULL, NULL, 65000, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `servicetaken`
--

CREATE TABLE `servicetaken` (
  `id` int(255) NOT NULL,
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `leadid` int(255) NOT NULL,
  `serviceid` int(255) NOT NULL,
  `payment` int(255) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `starts_at` datetime NOT NULL,
  `ends_at` datetime NOT NULL,
  `status` enum('active','past_due','cancelled','expired') DEFAULT 'active',
  `provider` varchar(255) DEFAULT NULL,
  `provider_subscription_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'lead_creator',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '$2y$10$nYDTcf.MX3b.uMRpPnafNO1rIY8kxjjS0D55nBcLIewqVqmloPIAW',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `is_delete` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `verify` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `block` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_role` enum('lead-creater','tele-caller','admin','super-admin') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_billing` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_online` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(1111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet` int(255) NOT NULL DEFAULT '0',
  `refercode` varchar(1111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referused` varchar(1111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `business_id`, `role`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `address1`, `address2`, `status`, `is_delete`, `verify`, `block`, `user_role`, `is_billing`, `is_online`, `remember_token`, `photo`, `wallet`, `refercode`, `referused`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'CITCAdmin', 'info@gmail.com', NULL, '$2y$10$nYDTcf.MX3b.uMRpPnafNO1rIY8kxjjS0D55nBcLIewqVqmloPIAW', '9999999999', 'xyz', 'xyz', '1', '0', '1', '0', 'admin', '0', '0', NULL, 'photo/User_Photo_1702475075_23386734352_1702475075.png', 0, NULL, NULL, NULL, '2025-08-08 00:26:18'),
(2, NULL, 'lead_creator', 'Midbrains Lead', 'info.lc@gmail.com', NULL, '$2y$10$cH9TWu438ZaBItd5SY0NWu14z8blRMr92Y4bjaXFS4OISiI4ihOPy', '9999999999', 'xyz', 'xyz', '1', '0', '1', '0', 'lead-creater', '1', '1', NULL, NULL, 0, NULL, NULL, NULL, '2025-08-08 00:26:18'),
(3, NULL, 'lead_creator', 'Midbrains Tele', 'info.tc@gmail.com', NULL, '$2y$10$nYDTcf.MX3b.uMRpPnafNO1rIY8kxjjS0D55nBcLIewqVqmloPIAW', '9999999999', 'xyz', 'xyz', '1', '0', '1', '0', 'tele-caller', '0', '0', NULL, NULL, 0, NULL, NULL, NULL, '2025-08-08 00:26:18'),
(4, NULL, 'lead_creator', 'reena', 'metronomemusicalstore@gmail.com', NULL, '$2y$10$kvEVGs8nVI7E.zCC8cU98ucbXRgLfLs8NziylVj9OxYoyVmF6lRqK', '09090909090', 'test', 'test', '1', '0', '1', '0', 'tele-caller', '0', '0', NULL, NULL, 0, NULL, NULL, '2023-12-06 01:19:00', '2025-08-08 00:26:18'),
(5, NULL, 'lead_creator', 'Tejas sawant', 'trippygonzaliz@gmail.com', NULL, '$2y$10$UpTtEuu5O7JFUORmQwX/AOgoNBLmNm/ELkLakdhwtzxU9Kd.Rk9E2', '9373736425', 'Flat no. 3/4 pornima heights Manaji Nagar nahre pune 411041', NULL, '1', '0', '1', '0', 'tele-caller', '1', '1', NULL, 'photo/User_Photo_1714385955_44772846802_1714385955.mp4', 0, NULL, NULL, '2024-04-28 12:37:24', '2025-08-08 00:26:18'),
(6, NULL, 'lead_creator', 'mohsin', 'citcstaffbusiness@gmail.com', NULL, '$2y$10$V5x.U5mueua03VlEE2FcrO1xnYU/RYLd.2wIxXFwP9KBMNGY90C.e', '9175550071', 'pune', 'pune', '1', '0', '1', '0', 'tele-caller', '0', '1', NULL, NULL, 0, NULL, NULL, '2024-04-29 06:45:12', '2025-08-08 00:26:18'),
(7, NULL, 'lead_creator', 'Kareena Kamble', 'kareena.k2607@gmail.com', NULL, '$2y$10$wXy7OOBuVpCeE3hIgpPuwerb5IHnQ3/mOcVl432B9vdh794XROn6m', '8698552072', 'Pune', 'Pune', '1', '0', '1', '0', 'tele-caller', '0', '1', NULL, NULL, 0, NULL, NULL, '2024-04-29 07:14:58', '2025-08-08 00:26:18'),
(8, NULL, 'lead_creator', 'Dinesh Mali', 'dm9276489@gmail.com', NULL, NULL, '9175550042', 'Pune', NULL, '1', '0', '1', '0', 'tele-caller', '0', '1', NULL, NULL, 0, NULL, NULL, '2024-04-29 07:19:28', '2025-08-08 00:26:18'),
(9, NULL, 'lead_creator', 'Rashmi jadhav', 'rashmi@gmail.com', NULL, NULL, '9172416470', 'Pune', NULL, '1', '0', '1', '0', 'tele-caller', '0', '1', NULL, NULL, 0, NULL, NULL, '2024-04-29 07:40:06', '2025-08-08 00:26:18'),
(10, NULL, 'lead_creator', 'John', 'john@gmail.com', NULL, '$2y$10$nYDTcf.MX3b.uMRpPnafNO1rIY8kxjjS0D55nBcLIewqVqmloPIAW', '1231211231', 'xyz', 'xyz', '1', '1', '1', '0', 'lead-creater', '0', '0', NULL, NULL, 0, NULL, NULL, NULL, '2025-08-08 00:26:18'),
(12, NULL, 'super_admin', 'SuperAdmin', 'superadmin@gmail.com', NULL, '$2y$10$nYDTcf.MX3b.uMRpPnafNO1rIY8kxjjS0D55nBcLIewqVqmloPIAW', '7897894561', 'xyz', 'xyz', '1', '0', '1', '0', 'super-admin', '0', '0', NULL, NULL, 0, NULL, NULL, NULL, '2025-08-18 02:51:52'),
(14, 4, 'lead_creator', 'dsfds Admin', 'dsfdsadmin@gmail.com', NULL, '$2y$10$LsGmmdW7VD7JaYBIq0bzae4q4Kmbf6hJV1y154cwrOI78bD4W25eC', '1231231265', 'Kaku Nana Hospital, Jalna Road Beed.', 'Ambajogai Road Kaij,', '1', '0', '1', '0', 'admin', '0', '0', NULL, 'photo/User_Photo_1754902753_44286988978_1754902753.JPG', 0, NULL, NULL, '2025-08-11 03:13:21', '2025-08-11 03:29:13'),
(24, 4, 'lead_creator', 'Mahesh', 'mahesh@gmail.com', NULL, '$2y$10$2q1RnvWna5zTydFKyWxxf.20Bs1ExNrazmJ/12EdhIFRiCwdzLZDi', '56445651174', 'sdasdsadasd', NULL, '1', '0', '1', '0', 'admin', '0', '0', NULL, NULL, 0, NULL, NULL, '2025-08-13 01:02:19', '2025-08-13 01:02:19'),
(32, NULL, 'lead_creator', 'citcnewld', 'citcnewld@gmail.com', NULL, NULL, '455454121', 'sdad', 'dsd', '1', '0', '1', '0', 'lead-creater', '0', '0', NULL, NULL, 0, NULL, NULL, '2025-08-18 02:17:50', '2025-08-18 02:17:50'),
(33, 4, 'lead_creator', 'Tele testing', 'tt@gmail.com', NULL, '$2y$10$2q1RnvWna5zTydFKyWxxf.20Bs1ExNrazmJ/12EdhIFRiCwdzLZDi', '8989787845', 'kj', 'jhj', '1', '0', '1', '0', 'tele-caller', '0', '1', NULL, NULL, 0, NULL, NULL, '2025-08-18 06:38:15', '2025-08-18 23:35:08'),
(34, 4, 'lead_creator', 'try', 'try@gmail.com', NULL, NULL, 'sad', 'sad', 'sad', '1', '1', '0', '0', 'lead-creater', '0', '1', NULL, NULL, 0, NULL, NULL, '2025-08-25 01:25:52', '2025-08-26 12:38:27'),
(37, 4, 'lead_creator', 'ld2', 'ld2@gmail.com', NULL, '$2y$10$nYDTcf.MX3b.uMRpPnafNO1rIY8kxjjS0D55nBcLIewqVqmloPIAW', '6544569877', 'sda', 'asds', '1', '0', '1', '0', 'lead-creater', '0', '1', NULL, NULL, 0, NULL, NULL, '2025-08-26 12:51:32', '2025-08-26 12:51:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `lead_management`
--
ALTER TABLE `lead_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `lead_reminder`
--
ALTER TABLE `lead_reminder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `lead_status`
--
ALTER TABLE `lead_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `paymenttaken`
--
ALTER TABLE `paymenttaken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `servicetaken`
--
ALTER TABLE `servicetaken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `business_id` (`business_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `lead_management`
--
ALTER TABLE `lead_management`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lead_reminder`
--
ALTER TABLE `lead_reminder`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lead_status`
--
ALTER TABLE `lead_status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymenttaken`
--
ALTER TABLE `paymenttaken`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `servicetaken`
--
ALTER TABLE `servicetaken`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_management`
--
ALTER TABLE `lead_management`
  ADD CONSTRAINT `lead_management_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_reminder`
--
ALTER TABLE `lead_reminder`
  ADD CONSTRAINT `lead_reminder_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_status`
--
ALTER TABLE `lead_status`
  ADD CONSTRAINT `lead_status_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paymenttaken`
--
ALTER TABLE `paymenttaken`
  ADD CONSTRAINT `paymenttaken_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `servicetaken`
--
ALTER TABLE `servicetaken`
  ADD CONSTRAINT `servicetaken_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
