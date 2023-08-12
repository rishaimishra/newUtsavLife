-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 12:03 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `add__to__carts`
--

CREATE TABLE `add__to__carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category__cruds`
--

CREATE TABLE `category__cruds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT 'categories/demo.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category__cruds`
--

INSERT INTO `category__cruds` (`id`, `category_name`, `category_description`, `category_status`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Birthday', 'this is small decoration', 1, '2022-10-08 02:09:03', '2022-10-08 02:09:03', 'categories/demo.jpg'),
(2, 'Reception', 'this is small decoration with beautiful fake flowers', 1, '2022-10-08 02:09:32', '2022-10-08 02:09:32', 'categories/demo.jpg'),
(3, 'marriage', 'this is small decoration', 1, '2022-10-17 10:06:46', '2022-10-17 10:06:46', 'categories/demo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customized__orders`
--

CREATE TABLE `customized__orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quoted_price` int(11) DEFAULT NULL,
  `order_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{}', 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{}', 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '{}', 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'voyager::seeders.data_rows.roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 0, 1, 1, 1, 1, 1, '{}', 9),
(43, 6, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(44, 6, 'customer_user_id', 'text', 'Customer User Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(45, 6, 'customer_email', 'text', 'Customer Email', 1, 1, 1, 1, 1, 1, '{}', 4),
(46, 6, 'customer_phone', 'text', 'Customer Phone', 1, 1, 1, 1, 1, 1, '{}', 5),
(47, 6, 'vendor_user_id', 'text', 'Vendor User Id', 1, 1, 1, 1, 1, 1, '{}', 6),
(48, 6, 'services', 'text', 'Services', 1, 1, 1, 1, 1, 1, '{}', 8),
(49, 6, 'discount', 'text', 'Discount', 1, 1, 1, 1, 1, 1, '{}', 9),
(50, 6, 'total_price', 'text', 'Total Price', 1, 1, 1, 1, 1, 1, '{}', 10),
(51, 6, 'event_date', 'text', 'Event Date', 1, 1, 1, 1, 1, 1, '{}', 11),
(52, 6, 'event_city', 'text', 'Event City', 1, 1, 1, 1, 1, 1, '{}', 12),
(53, 6, 'event_address', 'text', 'Event Address', 1, 1, 1, 1, 1, 1, '{}', 13),
(54, 6, 'event_pin', 'text', 'Event Pin', 1, 1, 1, 1, 1, 1, '{}', 14),
(55, 6, 'txn_no', 'text', 'Txn No', 1, 1, 1, 1, 1, 1, '{}', 15),
(56, 6, 'is_customized', 'select_dropdown', 'Is Customized', 1, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 16),
(57, 6, 'order_status', 'select_dropdown', 'Order Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"1\",\"options\":{\"1\":\"Upcoming\",\"2\":\"Canceled\",\"3\":\"Completed\"}}', 17),
(58, 6, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 18),
(59, 6, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 19),
(62, 6, 'order_belongsto_users_list_relationship_1', 'relationship', 'Vendoe User Id', 0, 1, 1, 1, 1, 1, '{\"scope\":\"vendor\",\"model\":\"TCG\\\\Voyager\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"vendor_user_id\",\"key\":\"id\",\"label\":\"email\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(63, 6, 'deleted_at', 'text', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 20),
(64, 7, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 0),
(65, 7, 'vendor_user_id', 'text', 'Vendor User Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(66, 7, 'customer_user_id', 'text', 'Customer User Id', 1, 1, 1, 1, 1, 1, '{}', 4),
(67, 7, 'order_id', 'text', 'Order Id', 1, 1, 1, 1, 1, 1, '{}', 6),
(68, 7, 'quoted_price', 'text', 'Quoted Price', 0, 1, 1, 1, 1, 1, '{}', 8),
(69, 7, 'order_description', 'text', 'Order Description', 1, 1, 1, 1, 1, 1, '{}', 9),
(70, 7, 'status', 'text', 'Status', 0, 1, 1, 1, 1, 1, '{}', 10),
(71, 7, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 11),
(72, 7, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 12),
(73, 7, 'customized__order_belongsto_users_list_relationship', 'relationship', 'Vendor User Id', 0, 1, 1, 1, 1, 1, '{\"scope\":\"vendor\",\"model\":\"TCG\\\\Voyager\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"vendor_user_id\",\"key\":\"id\",\"label\":\"email\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(74, 7, 'customized__order_belongsto_users_list_relationship_1', 'relationship', 'Customer User Id', 0, 1, 1, 1, 1, 1, '{\"scope\":\"customer\",\"model\":\"TCG\\\\Voyager\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"customer_user_id\",\"key\":\"id\",\"label\":\"email\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(75, 7, 'customized__order_belongsto_order_relationship', 'relationship', 'Order Id', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Order\",\"table\":\"orders\",\"type\":\"belongsTo\",\"column\":\"order_id\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 7),
(76, 8, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(77, 8, 'category_id', 'text', 'Category Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(78, 8, 'service_id', 'text', 'Service Id', 1, 1, 1, 1, 1, 1, '{}', 4),
(79, 8, 'money', 'text', 'Money', 1, 1, 1, 1, 1, 1, '{}', 6),
(80, 8, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
(81, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(82, 9, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(83, 9, 'category_name', 'text', 'Category Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(84, 9, 'category_description', 'text', 'Category Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(85, 9, 'category_status', 'text', 'Category Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"1\",\"options\":{\"0\":\"Inactive\",\"1\":\"Active\"}}', 5),
(86, 9, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(87, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(102, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(103, 12, 'service', 'text', 'Service', 1, 1, 1, 1, 1, 1, '{}', 2),
(104, 12, 'description', 'text', 'Description', 1, 1, 1, 1, 1, 1, '{}', 3),
(105, 12, 'price_basis', 'text', 'Price Basis', 1, 1, 1, 1, 1, 1, '{}', 5),
(106, 12, 'price', 'text', 'Price', 1, 1, 1, 1, 1, 1, '{}', 6),
(107, 12, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 7),
(108, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(109, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 0),
(110, 13, 'customer_id', 'text', 'Customer Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(111, 13, 'order_id', 'text', 'Order Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(112, 13, 'payment_id', 'text', 'Payment Id', 0, 1, 1, 1, 1, 1, '{}', 4),
(113, 13, 'status', 'select_dropdown', 'Status', 0, 1, 1, 1, 1, 1, '{\"default\":\"1\",\"options\":{\"1\":\"Request Pending\",\"2\":\"Refund Approved\",\"3\":\"Refund Initiated\",\"4\":\"Refund Complete\",\"5\":\"Refund cancel\"}}', 5),
(114, 13, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 6),
(115, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 7),
(116, 14, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(117, 14, 'vendor_user_id', 'text', 'Vendor User Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(118, 14, 'service_id', 'text', 'Service Id', 1, 1, 1, 1, 1, 1, '{}', 4),
(119, 14, 'company_name', 'text', 'Company Name', 1, 1, 1, 1, 1, 1, '{}', 6),
(120, 14, 'company_address', 'text', 'Company Address', 1, 1, 1, 1, 1, 1, '{}', 7),
(121, 14, 'service_status', 'select_dropdown', 'Service Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"1\",\"options\":{\"0\":\"Active\",\"1\":\"Inactive\"}}', 8),
(122, 14, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 9),
(123, 14, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 10),
(126, 14, 'services_taken_by_vendor_belongsto_users_list_relationship', 'relationship', 'Vendor User Id', 0, 1, 1, 1, 1, 1, '{\"scope\":\"vendor\",\"model\":\"TCG\\\\Voyager\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"vendor_user_id\",\"key\":\"id\",\"label\":\"email\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(127, 14, 'services_taken_by_vendor_belongsto_service__crud_relationship', 'relationship', 'service__cruds', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Service_Crud\",\"table\":\"service__cruds\",\"type\":\"belongsTo\",\"column\":\"service_id\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(128, 15, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(129, 15, 'lead_name', 'text', 'Lead Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(130, 15, 'lead_email', 'text', 'Lead Email', 1, 1, 1, 1, 1, 1, '{}', 3),
(131, 15, 'lead_phone', 'text', 'Lead Phone', 0, 1, 1, 1, 1, 1, '{}', 4),
(132, 15, 'category_id', 'text', 'Category Id', 0, 1, 1, 1, 1, 1, '{}', 5),
(133, 15, 'services', 'text', 'Services', 0, 1, 1, 1, 1, 1, '{}', 7),
(134, 15, 'lead_city', 'text', 'Lead City', 0, 1, 1, 1, 1, 1, '{}', 9),
(135, 15, 'lead_address', 'text', 'Lead Address', 0, 1, 1, 1, 1, 1, '{}', 10),
(136, 15, 'lead_pin', 'text', 'Lead Pin', 0, 1, 1, 1, 1, 1, '{}', 11),
(137, 15, 'agent_id', 'text', 'Agent Id', 0, 1, 1, 1, 1, 1, '{}', 12),
(138, 15, 'lead_status', 'text', 'Lead Status', 0, 1, 1, 1, 1, 1, '{}', 14),
(139, 15, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 15),
(140, 15, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 16),
(141, 15, 'lead_management_belongsto_category__crud_relationship', 'relationship', 'Category', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Category_Crud\",\"table\":\"category__cruds\",\"type\":\"belongsTo\",\"column\":\"category_id\",\"key\":\"id\",\"label\":\"category_name\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 6),
(142, 15, 'lead_management_belongstomany_service_relationship', 'relationship', 'Services', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Services\",\"table\":\"services\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"service\",\"pivot_table\":\"lead_map_services\",\"pivot\":\"1\",\"taggable\":\"0\"}', 8),
(143, 8, 'token_money_belongsto_category__crud_relationship', 'relationship', 'Category', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Category_Crud\",\"table\":\"category__cruds\",\"type\":\"belongsTo\",\"column\":\"category_id\",\"key\":\"id\",\"label\":\"category_name\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(144, 8, 'token_money_belongsto_service_relationship', 'relationship', 'Service', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Services\",\"table\":\"services\",\"type\":\"belongsTo\",\"column\":\"service_id\",\"key\":\"id\",\"label\":\"service\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 5),
(145, 1, 'platform_id', 'text', 'Platform Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(146, 1, 'platform_type', 'text', 'Platform Type', 0, 1, 1, 1, 1, 1, '{}', 4),
(147, 1, 'mobile', 'text', 'Mobile', 0, 1, 1, 1, 1, 1, '{}', 7),
(148, 1, 'email_verified_at', 'timestamp', 'Email Verified At', 0, 1, 1, 1, 1, 1, '{}', 9),
(149, 1, 'email_vcode', 'text', 'Email Vcode', 0, 1, 1, 1, 1, 1, '{}', 11),
(150, 1, 'otp', 'text', 'Otp', 0, 1, 1, 1, 1, 1, '{}', 12),
(151, 6, 'order_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"scope\":\"customer\",\"model\":\"TCG\\\\Voyager\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"customer_user_id\",\"key\":\"id\",\"label\":\"email\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(152, 15, 'lead_management_belongsto_user_relationship', 'relationship', 'Agent', 0, 1, 1, 1, 1, 1, '{\"scope\":\"agent\",\"model\":\"TCG\\\\Voyager\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"agent_id\",\"key\":\"id\",\"label\":\"email\",\"pivot_table\":\"add__to__carts\",\"pivot\":\"0\",\"taggable\":\"0\"}', 13),
(153, 9, 'image', 'image', 'Image', 0, 1, 1, 1, 1, 1, '{}', 4),
(154, 12, 'image', 'image', 'Image', 0, 1, 1, 1, 1, 1, '{}', 4);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2022-10-07 01:39:31', '2022-10-17 07:47:06'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(6, 'orders', 'orders', 'Order', 'Orders', 'voyager-double-right', 'App\\Models\\Order', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-10-08 00:41:05', '2022-10-18 02:22:42'),
(7, 'customized__orders', 'customized-orders', 'Customized  Order', 'Customized  Orders', 'voyager-double-right', 'App\\Models\\Customized_Order', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-10-08 01:41:37', '2022-10-18 02:32:38'),
(8, 'token_moneys', 'token-moneys', 'Token Money', 'Token Moneys', 'voyager-double-right', 'App\\Models\\Token_money', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-10-08 01:58:00', '2022-10-11 03:46:42'),
(9, 'category__cruds', 'category-cruds', 'Category  Crud', 'Category  Cruds', 'voyager-double-right', 'App\\Models\\Category_Crud', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-10-08 01:58:56', '2022-10-18 12:55:24'),
(12, 'services', 'services', 'Service', 'Services', 'voyager-double-right', 'App\\Models\\Services', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-10-08 02:02:05', '2022-10-18 12:55:12'),
(13, 'refunds', 'refunds', 'Refund', 'Refunds', 'voyager-double-right', 'App\\Models\\Refund', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-10-08 02:02:38', '2022-10-18 02:41:59'),
(14, 'services_taken_by_vendors', 'services-taken-by-vendors', 'Services Taken By Vendor', 'Services Taken By Vendors', 'voyager-double-right', 'App\\Models\\Services_taken_by_vendor', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-10-08 02:03:26', '2022-10-18 02:39:24'),
(15, 'lead_managements', 'lead-managements', 'Lead Management', 'Lead Managements', 'voyager-double-right', 'App\\Models\\Lead_management', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2022-10-08 02:27:32', '2022-10-18 02:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `last_searches`
--

CREATE TABLE `last_searches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `last_search` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_managements`
--

CREATE TABLE `lead_managements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lead_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_map_services`
--

CREATE TABLE `lead_map_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lead_management_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(3, 'test', '2022-10-08 01:28:43', '2022-10-08 01:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2022-10-07 01:39:31', '2022-10-08 01:23:19', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, 5, 5, '2022-10-07 01:39:31', '2022-10-08 02:19:52', 'voyager.media.index', NULL),
(3, 1, 'All Users', '', '_self', 'voyager-person', '#fa0000', 14, 5, '2022-10-07 01:39:31', '2022-10-18 02:28:15', 'voyager.users.index', 'null'),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, 14, 6, '2022-10-07 01:39:31', '2022-10-08 01:37:48', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 7, '2022-10-07 01:39:31', '2022-10-08 02:49:37', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2022-10-07 01:39:31', '2022-10-08 01:18:06', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 3, '2022-10-07 01:39:31', '2022-10-08 02:19:54', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 2, '2022-10-07 01:39:31', '2022-10-08 02:19:54', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2022-10-07 01:39:31', '2022-10-08 01:18:06', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, 5, 6, '2022-10-07 01:39:31', '2022-10-08 02:25:03', 'voyager.settings.index', NULL),
(12, 1, 'All Orders', '', '_self', 'voyager-double-right', '#f9d801', 18, 5, '2022-10-08 00:41:05', '2022-10-08 01:46:14', 'voyager.orders.index', 'null'),
(14, 1, 'Users', '', '_self', 'voyager-people', '#000000', NULL, 2, '2022-10-08 01:17:54', '2022-10-08 02:26:39', NULL, ''),
(15, 1, 'Agents', '/admin/agent-list', '_self', 'voyager-double-right', '#000000', 14, 1, '2022-10-08 01:19:26', '2022-10-08 01:22:12', NULL, ''),
(16, 1, 'Customers', '/admin/customer-list', '_self', 'voyager-double-right', '#000000', 14, 2, '2022-10-08 01:20:54', '2022-10-08 01:22:12', NULL, ''),
(17, 1, 'Vendors', '/admin/vendor-list', '_self', 'voyager-double-right', '#000000', 14, 3, '2022-10-08 01:21:18', '2022-10-08 01:22:12', NULL, ''),
(18, 1, 'Orders', '', '_self', 'voyager-truck', '#000000', NULL, 3, '2022-10-08 01:23:06', '2022-10-08 02:26:39', NULL, ''),
(19, 1, 'Upcoming', '/admin/upcoming-order', '_self', 'voyager-double-right', '#000000', 18, 1, '2022-10-08 01:33:23', '2022-10-08 01:34:28', NULL, ''),
(20, 1, 'Completed', '/admin/completed-order', '_self', 'voyager-double-right', '#000000', 18, 2, '2022-10-08 01:33:55', '2022-10-08 01:34:33', NULL, ''),
(21, 1, 'Canceled', '/admin/canceled-order', '_self', 'voyager-double-right', '#000000', 18, 3, '2022-10-08 01:34:19', '2022-10-08 01:34:36', NULL, ''),
(22, 1, 'Customized  Orders', '', '_self', 'voyager-double-right', '#3bec18', 18, 4, '2022-10-08 01:41:37', '2022-10-08 01:46:31', 'voyager.customized-orders.index', 'null'),
(23, 1, 'Token Moneys', '', '_self', 'voyager-double-right', NULL, 31, 2, '2022-10-08 01:58:00', '2022-10-08 02:05:30', 'voyager.token-moneys.index', NULL),
(24, 1, 'Categories', '', '_self', 'voyager-double-right', '#000000', 30, 1, '2022-10-08 01:58:56', '2022-10-08 02:19:23', 'voyager.category-cruds.index', 'null'),
(27, 1, 'Services', '', '_self', 'voyager-double-right', NULL, 30, 2, '2022-10-08 02:02:05', '2022-10-08 02:10:11', 'voyager.services.index', NULL),
(28, 1, 'Refunds', '', '_self', 'voyager-double-right', NULL, 31, 1, '2022-10-08 02:02:38', '2022-10-08 02:05:22', 'voyager.refunds.index', NULL),
(29, 1, 'Services Taken By Vendors', '', '_self', 'voyager-double-right', NULL, 30, 4, '2022-10-08 02:03:26', '2022-10-08 02:25:31', 'voyager.services-taken-by-vendors.index', NULL),
(30, 1, 'Categories & Services', '', '_self', 'voyager-categories', '#000000', NULL, 4, '2022-10-08 02:04:43', '2022-10-08 02:26:34', NULL, ''),
(31, 1, 'Money', '', '_self', 'voyager-treasure', '#000000', NULL, 5, '2022-10-08 02:05:17', '2022-10-08 02:49:29', NULL, ''),
(32, 1, 'Lead Managements', '', '_self', 'voyager-double-right', NULL, NULL, 6, '2022-10-08 02:27:32', '2022-10-08 02:49:37', 'voyager.lead-managements.index', NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(25, '2022_06_30_063602_create_vendor_avalibilities_table', 1),
(26, '2022_06_30_063611_create_products_table', 1),
(27, '2022_06_30_063621_create_product_attributes_table', 1),
(28, '2022_06_30_063631_create_services_taken_by_vendors_table', 1),
(29, '2022_06_30_063641_create_service_attributes_table', 1),
(30, '2022_06_30_063651_create_user__perchase__history_transactions_table', 1),
(31, '2022_06_30_063701_create_orders_table', 1),
(32, '2022_06_30_063721_create_payment_types_table', 1),
(33, '2022_06_30_063731_create_add__to__carts_table', 1),
(34, '2022_06_30_063742_create_product__reviews_table', 1),
(35, '2022_06_30_063751_create_customized__orders_table', 1),
(36, '2022_06_30_063801_create_service__cruds_table', 1),
(37, '2022_06_30_063810_create_category__cruds_table', 1),
(38, '2022_06_30_063819_create_token_moneys_table', 1),
(39, '2022_06_30_063840_create_lead_managements_table', 1),
(40, '2022_07_04_091522_create_users_lists_table', 1),
(41, '2022_07_11_075007_create_services_table', 1),
(42, '2022_07_11_102137_create_order_map__services_table', 1),
(43, '2022_07_13_154143_create_vendor_services_table', 1),
(44, '2022_07_13_154656_create_vendor_map_services_table', 1),
(45, '2022_07_15_053911_create_lead_map_services_table', 1),
(46, '2022_07_18_051339_create_refunds_table', 1),
(47, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(48, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(49, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(50, '2016_06_01_000004_create_oauth_clients_table', 2),
(51, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(52, '2022_10_18_115447_create_last_searches_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('74df950bc16e618482fd3e6e39187b2b287a65e80e45914c9d21d92f90f7e8d9c481e201af53a999', 4, 1, 'eventManagement', '[]', 0, '2022-10-12 06:11:35', '2022-10-12 06:11:35', '2023-10-12 11:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'E0CuPFTUPnXXW0XnFhuZBJ5NXKqWAgwpQZ1YfVug', NULL, 'http://localhost', 1, 0, 0, '2022-10-12 05:21:13', '2022-10-12 05:21:13'),
(2, NULL, 'Laravel Password Grant Client', 'UkxQGUFfg0SgXj64Fr3NZhDmbyxhfBnDtZwF68uc', 'users', 'http://localhost', 0, 1, 0, '2022-10-12 05:21:13', '2022-10-12 05:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-10-12 05:21:13', '2022-10-12 05:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `event_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_pin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_customized` tinyint(1) NOT NULL,
  `order_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_user_id`, `customer_email`, `customer_phone`, `vendor_user_id`, `services`, `discount`, `total_price`, `event_date`, `event_city`, `event_address`, `event_pin`, `txn_no`, `is_customized`, `order_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '3', 'swsj@gmail.com', '223332', '4', 'kfpoeajf', 10, 20000, '19/11/2022', 'Kancharapara', 'charapole, Kanchrapara', '745896', '091821092810', 0, 1, '2022-10-18 02:49:30', '2022-10-18 02:49:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_map__services`
--

CREATE TABLE `order_map__services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `services_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(2, 'browse_bread', NULL, '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(3, 'browse_database', NULL, '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(4, 'browse_media', NULL, '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(5, 'browse_compass', NULL, '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(6, 'browse_menus', 'menus', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(7, 'read_menus', 'menus', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(8, 'edit_menus', 'menus', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(9, 'add_menus', 'menus', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(10, 'delete_menus', 'menus', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(11, 'browse_roles', 'roles', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(12, 'read_roles', 'roles', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(13, 'edit_roles', 'roles', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(14, 'add_roles', 'roles', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(15, 'delete_roles', 'roles', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(16, 'browse_users', 'users', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(17, 'read_users', 'users', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(18, 'edit_users', 'users', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(19, 'add_users', 'users', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(20, 'delete_users', 'users', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(21, 'browse_settings', 'settings', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(22, 'read_settings', 'settings', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(23, 'edit_settings', 'settings', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(24, 'add_settings', 'settings', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(25, 'delete_settings', 'settings', '2022-10-07 01:39:31', '2022-10-07 01:39:31'),
(31, 'browse_orders', 'orders', '2022-10-08 00:41:05', '2022-10-08 00:41:05'),
(32, 'read_orders', 'orders', '2022-10-08 00:41:05', '2022-10-08 00:41:05'),
(33, 'edit_orders', 'orders', '2022-10-08 00:41:05', '2022-10-08 00:41:05'),
(34, 'add_orders', 'orders', '2022-10-08 00:41:05', '2022-10-08 00:41:05'),
(35, 'delete_orders', 'orders', '2022-10-08 00:41:05', '2022-10-08 00:41:05'),
(36, 'browse_customized__orders', 'customized__orders', '2022-10-08 01:41:37', '2022-10-08 01:41:37'),
(37, 'read_customized__orders', 'customized__orders', '2022-10-08 01:41:37', '2022-10-08 01:41:37'),
(38, 'edit_customized__orders', 'customized__orders', '2022-10-08 01:41:37', '2022-10-08 01:41:37'),
(39, 'add_customized__orders', 'customized__orders', '2022-10-08 01:41:37', '2022-10-08 01:41:37'),
(40, 'delete_customized__orders', 'customized__orders', '2022-10-08 01:41:37', '2022-10-08 01:41:37'),
(41, 'browse_token_moneys', 'token_moneys', '2022-10-08 01:58:00', '2022-10-08 01:58:00'),
(42, 'read_token_moneys', 'token_moneys', '2022-10-08 01:58:00', '2022-10-08 01:58:00'),
(43, 'edit_token_moneys', 'token_moneys', '2022-10-08 01:58:00', '2022-10-08 01:58:00'),
(44, 'add_token_moneys', 'token_moneys', '2022-10-08 01:58:00', '2022-10-08 01:58:00'),
(45, 'delete_token_moneys', 'token_moneys', '2022-10-08 01:58:00', '2022-10-08 01:58:00'),
(46, 'browse_category__cruds', 'category__cruds', '2022-10-08 01:58:56', '2022-10-08 01:58:56'),
(47, 'read_category__cruds', 'category__cruds', '2022-10-08 01:58:56', '2022-10-08 01:58:56'),
(48, 'edit_category__cruds', 'category__cruds', '2022-10-08 01:58:56', '2022-10-08 01:58:56'),
(49, 'add_category__cruds', 'category__cruds', '2022-10-08 01:58:56', '2022-10-08 01:58:56'),
(50, 'delete_category__cruds', 'category__cruds', '2022-10-08 01:58:56', '2022-10-08 01:58:56'),
(61, 'browse_services', 'services', '2022-10-08 02:02:05', '2022-10-08 02:02:05'),
(62, 'read_services', 'services', '2022-10-08 02:02:05', '2022-10-08 02:02:05'),
(63, 'edit_services', 'services', '2022-10-08 02:02:05', '2022-10-08 02:02:05'),
(64, 'add_services', 'services', '2022-10-08 02:02:05', '2022-10-08 02:02:05'),
(65, 'delete_services', 'services', '2022-10-08 02:02:05', '2022-10-08 02:02:05'),
(66, 'browse_refunds', 'refunds', '2022-10-08 02:02:38', '2022-10-08 02:02:38'),
(67, 'read_refunds', 'refunds', '2022-10-08 02:02:38', '2022-10-08 02:02:38'),
(68, 'edit_refunds', 'refunds', '2022-10-08 02:02:38', '2022-10-08 02:02:38'),
(69, 'add_refunds', 'refunds', '2022-10-08 02:02:38', '2022-10-08 02:02:38'),
(70, 'delete_refunds', 'refunds', '2022-10-08 02:02:38', '2022-10-08 02:02:38'),
(71, 'browse_services_taken_by_vendors', 'services_taken_by_vendors', '2022-10-08 02:03:26', '2022-10-08 02:03:26'),
(72, 'read_services_taken_by_vendors', 'services_taken_by_vendors', '2022-10-08 02:03:26', '2022-10-08 02:03:26'),
(73, 'edit_services_taken_by_vendors', 'services_taken_by_vendors', '2022-10-08 02:03:26', '2022-10-08 02:03:26'),
(74, 'add_services_taken_by_vendors', 'services_taken_by_vendors', '2022-10-08 02:03:26', '2022-10-08 02:03:26'),
(75, 'delete_services_taken_by_vendors', 'services_taken_by_vendors', '2022-10-08 02:03:26', '2022-10-08 02:03:26'),
(76, 'browse_lead_managements', 'lead_managements', '2022-10-08 02:27:32', '2022-10-08 02:27:32'),
(77, 'read_lead_managements', 'lead_managements', '2022-10-08 02:27:32', '2022-10-08 02:27:32'),
(78, 'edit_lead_managements', 'lead_managements', '2022-10-08 02:27:32', '2022-10-08 02:27:32'),
(79, 'add_lead_managements', 'lead_managements', '2022-10-08 02:27:32', '2022-10-08 02:27:32'),
(80, 'delete_lead_managements', 'lead_managements', '2022-10-08 02:27:32', '2022-10-08 02:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
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
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'MyLaravelApp', 'eff6720c497ba450ec449307f53f781caf4a259e6c7d72520da094385bf110e8', '[\"*\"]', NULL, '2022-10-12 05:50:52', '2022-10-12 05:50:52'),
(2, 'App\\Models\\User', 2, 'MyLaravelApp', '2a1a5f9d58187817ac1536728199327af555044133011b3f4cc81adfc25a85ad', '[\"*\"]', NULL, '2022-10-12 05:53:44', '2022-10-12 05:53:44'),
(3, 'App\\Models\\User', 2, 'EventManagement', '4b27373b095a817a738aaf5425948a295ac56b17dddc11980601b98f09a51a09', '[\"*\"]', NULL, '2022-10-12 06:01:16', '2022-10-12 06:01:16'),
(4, 'App\\Models\\User', 2, 'eventManagement', '4c25dc33da8f7c588d300d41e19ba96e7245ba07b4d7bf733fc7e597f6beaf92', '[\"*\"]', NULL, '2022-10-12 06:04:08', '2022-10-12 06:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count_of_product` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avg_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product__reviews`
--

CREATE TABLE `product__reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ratting` int(11) NOT NULL,
  `review` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2022-10-07 00:11:00', '2022-10-07 00:11:00'),
(2, 'customer', 'Customer', '2022-10-08 00:44:59', '2022-10-08 00:44:59'),
(3, 'vendor', 'Vendor', '2022-10-08 00:45:24', '2022-10-08 00:45:24'),
(4, 'agent', 'Agent', '2022-10-08 00:45:38', '2022-10-08 00:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_basis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT 'services/demo.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `description`, `price_basis`, `price`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Catering', 'nonveg plate', '1 plate', 500, '2022-10-08 02:10:34', '2022-10-08 02:10:34', 'services/demo.jpg'),
(2, 'Decoration', 'nice beautiful balloon decoration', '100 sq ft', 800, '2022-10-08 02:10:46', '2022-10-08 02:10:46', 'services/demo.jpg'),
(3, 'Mandap', 'nice beautiful balloon decoration', '100 sq ft', 2000, '2022-10-10 03:19:16', '2022-10-10 03:19:16', 'services/demo.jpg'),
(4, 'dj', 'jbl speaker', '1 hr', 1000, '2022-10-17 10:07:37', '2022-10-17 10:07:37', 'services/demo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services_taken_by_vendors`
--

CREATE TABLE `services_taken_by_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_attributes`
--

CREATE TABLE `service_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_basis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service__cruds`
--

CREATE TABLE `service__cruds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_price` int(11) NOT NULL,
  `service_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service__cruds`
--

INSERT INTO `service__cruds` (`id`, `category_id`, `service_id`, `service_price`, `service_status`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 500, 1, '2022-10-08 02:15:23', '2022-10-08 02:15:23'),
(2, '2', '1', 1000, 1, '2022-10-10 03:18:03', '2022-10-10 03:18:03'),
(3, '3', '4', 1000, 1, '2022-10-17 10:08:21', '2022-10-17 10:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Event Management', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Voyager', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `token_moneys`
--

CREATE TABLE `token_moneys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `money` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_vcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `platform_id`, `platform_type`, `role_id`, `name`, `email`, `mobile`, `temp_email`, `temp_mobile`, `avatar`, `email_verified_at`, `password`, `email_vcode`, `otp`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, 'admin', 'admin@gmail.com', NULL, NULL, NULL, 'users/default.png', NULL, '$2y$10$6r7pVbKvxH575iNKaq2Ey.3YizD5eL7uACkHclObGRyUT8oIq2ygy', NULL, NULL, NULL, NULL, '2022-10-07 00:11:00', '2022-10-07 00:11:00'),
(3, NULL, NULL, 2, 'test customer', 'cust@abc.com', NULL, NULL, NULL, 'users/default.png', NULL, '$2y$10$0Bnc5cVqfPFtoqUNf9YP2.aNsKy1KEDPpy.hd079pWomvCg19Tzna', NULL, NULL, NULL, '{\"locale\":\"en\"}', '2022-10-18 02:47:12', '2022-10-18 02:47:12'),
(4, NULL, NULL, 3, 'test vendor', 'vendor@abc.com', NULL, NULL, NULL, 'users/default.png', NULL, '$2y$10$eGd4eRvgo9WldoJWyWsOw.d9cV5aEqPXed0gBPysFpVIQJqUPedGO', NULL, NULL, NULL, '{\"locale\":\"en\"}', '2022-10-18 02:47:35', '2022-10-18 02:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `users_lists`
--

CREATE TABLE `users_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `platform_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_acc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_holder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ifsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_lists`
--

INSERT INTO `users_lists` (`id`, `name`, `email`, `password`, `mobile`, `login_otp`, `user_type`, `platform_type`, `platform_id`, `country`, `state`, `city`, `address`, `avatar`, `bank_acc`, `bank_holder`, `bank_ifsc`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'admin@gmail.com', '12345678', '7998226459', '122222', 3, 'jhjo', '3guu', 'India', 'West Bengal', 'Kancharapara', 'charapole, Kanchrapara', 'gy8', '7097097097070', 'houwdhwoh', 'oi870j90u', '2022-10-08 06:30:00', NULL, '2022-10-08 01:00:18', '2022-10-08 01:00:18'),
(2, 'test 222', 'new@gmail.com', '12345678', '7894561235', 'fgu8ygf', 4, 'jhjo', 'gf8uy', 'India', 'West Bengal', 'Kancharapara', 'charapole, Kanchrapara', 'gy8', '7097097097070', 'bendo d jdid', 'oi870j90u', '2022-10-08 06:30:00', NULL, '2022-10-08 01:00:54', '2022-10-08 01:00:54'),
(3, 'test agent', 'agent@abc.com', '12345678', '7998226459', '122222', 5, 'f8yugf8ygf8yu', '3guu', 'India', 'West Bengal', 'Kancharapara', 'charapole, Kanchrapara', NULL, '7097097097070', 'houwdhwoh', 'RV870809HIGH', '2022-10-10 08:54:00', NULL, '2022-10-10 03:24:12', '2022-10-10 03:24:12'),
(4, 'test2', 'test2@gmail.com', '$2y$10$qytlDmwn7UOMAFj3Xq6YeOfOauTipEBhg6a1dkRHVFXpw5J5gSXHu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-12 06:11:35', '2022-10-12 06:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user__perchase__history_transactions`
--

CREATE TABLE `user__perchase__history_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_details_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date_time` time NOT NULL,
  `transaction_status_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trsansaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_avalibilities`
--

CREATE TABLE `vendor_avalibilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_map_services`
--

CREATE TABLE `vendor_map_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `services_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_services_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_services`
--

CREATE TABLE `vendor_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add__to__carts`
--
ALTER TABLE `add__to__carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category__cruds`
--
ALTER TABLE `category__cruds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customized__orders`
--
ALTER TABLE `customized__orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `last_searches`
--
ALTER TABLE `last_searches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `last_searches_customer_id_unique` (`customer_id`);

--
-- Indexes for table `lead_managements`
--
ALTER TABLE `lead_managements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_map_services`
--
ALTER TABLE `lead_map_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_map__services`
--
ALTER TABLE `order_map__services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product__reviews`
--
ALTER TABLE `product__reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_taken_by_vendors`
--
ALTER TABLE `services_taken_by_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_attributes`
--
ALTER TABLE `service_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service__cruds`
--
ALTER TABLE `service__cruds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `token_moneys`
--
ALTER TABLE `token_moneys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `users_lists`
--
ALTER TABLE `users_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- Indexes for table `user__perchase__history_transactions`
--
ALTER TABLE `user__perchase__history_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_avalibilities`
--
ALTER TABLE `vendor_avalibilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_map_services`
--
ALTER TABLE `vendor_map_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_services`
--
ALTER TABLE `vendor_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add__to__carts`
--
ALTER TABLE `add__to__carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category__cruds`
--
ALTER TABLE `category__cruds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customized__orders`
--
ALTER TABLE `customized__orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `last_searches`
--
ALTER TABLE `last_searches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_managements`
--
ALTER TABLE `lead_managements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_map_services`
--
ALTER TABLE `lead_map_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_map__services`
--
ALTER TABLE `order_map__services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product__reviews`
--
ALTER TABLE `product__reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services_taken_by_vendors`
--
ALTER TABLE `services_taken_by_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_attributes`
--
ALTER TABLE `service_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service__cruds`
--
ALTER TABLE `service__cruds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `token_moneys`
--
ALTER TABLE `token_moneys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_lists`
--
ALTER TABLE `users_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user__perchase__history_transactions`
--
ALTER TABLE `user__perchase__history_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_avalibilities`
--
ALTER TABLE `vendor_avalibilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_map_services`
--
ALTER TABLE `vendor_map_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor_services`
--
ALTER TABLE `vendor_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
