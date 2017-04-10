-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2017 at 09:31 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solex`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_district` int(10) UNSIGNED NOT NULL,
  `id_regency` int(10) UNSIGNED NOT NULL,
  `id_province` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `Adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asks`
--

CREATE TABLE `asks` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_address` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `id_photo` int(10) UNSIGNED NOT NULL,
  `id_product_detail` int(10) UNSIGNED NOT NULL,
  `ask_amount` decimal(19,4) UNSIGNED NOT NULL,
  `ask_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `size` float UNSIGNED NOT NULL,
  `weight` decimal(10,4) UNSIGNED NOT NULL,
  `number_view` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance_ins`
--

CREATE TABLE `balance_ins` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `amount` decimal(19,4) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance_in_transactions`
--

CREATE TABLE `balance_in_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_balance_in` int(10) UNSIGNED NOT NULL,
  `id_invoice_detail` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance_outs`
--

CREATE TABLE `balance_outs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `amount` decimal(19,4) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balance_out_transactions`
--

CREATE TABLE `balance_out_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_balance_out` int(10) UNSIGNED NOT NULL,
  `id_invoice_detail` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_bank` int(10) UNSIGNED NOT NULL,
  `number` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_branch` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `id_address` int(10) UNSIGNED NOT NULL,
  `amount` decimal(19,4) UNSIGNED NOT NULL,
  `bid_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `size` float NOT NULL,
  `status` int(1) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE `branchs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_bank` int(10) UNSIGNED NOT NULL,
  `id_address` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Nike', '2017-04-08 00:38:31', '2017-04-08 00:38:31', NULL),
(3, 'Adidas', '2017-04-08 00:39:24', '2017-04-08 00:39:24', NULL),
(4, 'Jordan', '2017-04-08 01:14:51', '2017-04-08 01:35:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `amount` decimal(19,4) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_products`
--

CREATE TABLE `cart_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ask` int(10) UNSIGNED NOT NULL,
  `id_cart` int(10) UNSIGNED NOT NULL,
  `date_added` date NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_problem` int(10) UNSIGNED NOT NULL,
  `id_solution` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complain_comments`
--

CREATE TABLE `complain_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_complain` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `no` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complain_invoicedetails`
--

CREATE TABLE `complain_invoicedetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_complain` int(10) UNSIGNED NOT NULL,
  `id_invoice_detail` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complain_tickets`
--

CREATE TABLE `complain_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_complain` int(10) UNSIGNED NOT NULL,
  `id_ticket` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debts`
--

CREATE TABLE `debts` (
  `id_cart` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_balance_out` int(10) UNSIGNED NOT NULL,
  `amount` decimal(19,4) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_regency` int(10) UNSIGNED NOT NULL,
  `distric_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `division_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sepatu', '2017-04-08 07:03:39', '2017-04-08 07:07:38', NULL),
(2, 'Tas', '2017-04-08 07:03:57', '2017-04-08 07:08:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_address` int(10) UNSIGNED NOT NULL,
  `amount` decimal(19,4) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_ask` int(10) UNSIGNED NOT NULL,
  `id_bid` int(10) UNSIGNED NOT NULL,
  `id_address` int(10) UNSIGNED NOT NULL,
  `id_shipping` int(10) UNSIGNED NOT NULL,
  `id_invoice` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt_in_date` date NOT NULL,
  `payment_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `status` int(1) NOT NULL,
  `type` int(1) NOT NULL,
  `shipping_cost` decimal(19,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id_cart` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_balance_in` int(10) UNSIGNED NOT NULL,
  `amount` decimal(19,4) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `updated_at`, `deleted_at`, `created_at`) VALUES
(1, 'create-users', 'Create Users', 'Create Users', '2017-04-09 12:21:18', NULL, '2017-04-09 12:21:18'),
(2, 'read-users', 'Read Users', 'Read Users', '2017-04-09 12:21:18', NULL, '2017-04-09 12:21:18'),
(3, 'update-users', 'Update Users', 'Update Users', '2017-04-09 12:21:18', NULL, '2017-04-09 12:21:18'),
(4, 'delete-users', 'Delete Users', 'Delete Users', '2017-04-09 12:21:19', NULL, '2017-04-09 12:21:19'),
(5, 'create-acl', 'Create Acl', 'Create Acl', '2017-04-10 00:31:24', NULL, '2017-04-09 12:21:19'),
(6, 'read-acl', 'Read Acl', 'Read Acl', '2017-04-09 12:21:19', NULL, '2017-04-09 12:21:19'),
(7, 'update-acl', 'Update Acl', 'Update Acl', '2017-04-09 12:21:19', NULL, '2017-04-09 12:21:19'),
(8, 'delete-acl', 'Delete Acl', 'Delete Acl', '2017-04-09 12:21:19', NULL, '2017-04-09 12:21:19'),
(9, 'read-profile', 'Read Profile', 'Read Profile', '2017-04-09 12:21:19', NULL, '2017-04-09 12:21:19'),
(10, 'update-profile', 'Update Profile', 'Update Profile User', '2017-04-10 00:29:42', NULL, '2017-04-09 12:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id_permission` int(10) UNSIGNED NOT NULL,
  `id_role` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id_permission`, `id_role`) VALUES
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
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(9, 2),
(10, 2),
(9, 3),
(10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id_permission` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `photo_1`, `photo_2`, `photo_3`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'a1.jpg', 'a2.jgp', 'a3.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(13, '42nePOIYoaGjxNGXUvdlKI04OKd40SlzA2qI7CiC.png', 'xu4y6JQKGrX0EsECkyrQegVnNwcBeU4JtlE0Jpd1.jpeg', 'IY7EySSpyoSiUmgxxeCt6YcDENBQwNYCgBZV9s0P.png', '2017-04-09 03:50:37', '2017-04-09 05:04:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portofolios`
--

CREATE TABLE `portofolios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_brand` int(10) UNSIGNED NOT NULL,
  `id_division` int(10) UNSIGNED NOT NULL,
  `id_photo` int(10) UNSIGNED NOT NULL,
  `gender` int(11) NOT NULL,
  `article` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `retail_price` decimal(19,4) UNSIGNED NOT NULL,
  `number_sold` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `avg_price_new` decimal(19,4) UNSIGNED DEFAULT NULL,
  `avg_price_used` decimal(19,4) UNSIGNED DEFAULT NULL,
  `number_of_view` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `release_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `id_brand`, `id_division`, `id_photo`, `gender`, `article`, `alias`, `color`, `retail_price`, `number_sold`, `avg_price_new`, `avg_price_used`, `number_of_view`, `release_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'abc', 2, 1, 1, 1, 'A432', 'red', '0', '542534.0000', 12, '432423.0000', '432432.0000', 5, '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 'def', 2, 2, 1, 1, 'B76452', 'red', '0', '542534.0000', 12, '432423.0000', '432432.0000', 5, '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 'jhg', 3, 1, 1, 0, 'C6u589', 'red', '0', '542534.0000', 12, '432423.0000', '432432.0000', 5, '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(7, '645', 2, 1, 13, 0, '76576576', 'gdf', 'gdf', '423432432.0000', 0, NULL, NULL, 0, NULL, '2017-04-09 03:50:37', '2017-04-10 00:11:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `production_date` date NOT NULL,
  `id_country` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_country` int(10) UNSIGNED NOT NULL,
  `province_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regencies`
--

CREATE TABLE `regencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_province` int(10) UNSIGNED NOT NULL,
  `regency_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'superadmin', 'Super Administrator', 'Super Administrator', '2017-04-09 12:21:18', '2017-04-09 12:21:18', NULL),
(2, 'admin', 'Administrator', 'Administrator', '2017-04-09 12:21:19', '2017-04-09 12:21:19', NULL),
(3, 'user', 'User', 'User', '2017-04-09 12:21:20', '2017-04-09 12:21:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_role` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id_user`, `id_role`, `user_type`) VALUES
(1, 1, 'App\\User'),
(2, 2, 'App\\User'),
(3, 3, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(10) UNSIGNED NOT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_users`
--

CREATE TABLE `shipping_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_shipping` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE `solutions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_tickets`
--

CREATE TABLE `staff_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_staff` int(10) UNSIGNED NOT NULL,
  `id_ticket` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ticket_detail` int(10) UNSIGNED NOT NULL,
  `id_ticket_solution` int(10) UNSIGNED NOT NULL,
  `status` int(1) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

CREATE TABLE `ticket_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_solutions`
--

CREATE TABLE `ticket_solutions` (
  `id` int(10) UNSIGNED NOT NULL,
  `solution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(19,4) UNSIGNED NOT NULL DEFAULT '0.0000',
  `reputation` int(11) NOT NULL DEFAULT '100',
  `level` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `date_of_birth`, `gender`, `password`, `balance`, `reputation`, `level`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'superadmin', '1111111', 'admin@admin.com', '2016-01-01', 0, '$2y$10$IC/WJMCVbYDcJTKoGJesSuYR1E4VaBYYwF6p8YTlKeDJiHZGL47Se', '0.0000', 100, 1, 'CBqatRsWFd0ivCnB6bcWk0Q0tWVSUzuqiuuEDPZZpjsT4Qn4WFHHLvVVbcP0', '2017-04-09 03:15:38', '2017-04-09 03:15:38', NULL),
(2, 'staff', '222222', 'staff@staff.com', '2012-06-05', 1, '$2y$10$4.t63MTySq/BjCoKyBNfmemtGivl2Mfba7gmkmvDvv7mKq1RX9jNq', '0.0000', 100, 1, 'fB9LBixQiL3FBD7jyjxUy92GIerPG9Sf93UKi47pJh68ZE3sahdirBV1df1w', '2017-04-09 03:15:38', '2017-04-09 03:15:38', NULL),
(3, 'user', '333333', 'user@user.com', '1996-10-14', 0, '$2y$10$gCYyfPPfDYm4XkTBMEQ2TOX5ZRiCF0J7TngyBw9b/CRXviIj/m/n.', '0.0000', 100, 1, 'qpK7uneaxv9oarO7QKKW7KURVjWpURdrRD29IYmMVRAvsdeMFJbX9i5upuoW', '2017-04-09 03:15:39', '2017-04-09 03:15:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_district` (`id_district`),
  ADD KEY `id_regency` (`id_regency`),
  ADD KEY `id_province` (`id_province`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `asks`
--
ALTER TABLE `asks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_address` (`id_address`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_photo` (`id_photo`),
  ADD KEY `id_product_detail` (`id_product_detail`);

--
-- Indexes for table `balance_ins`
--
ALTER TABLE `balance_ins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `balance_in_transactions`
--
ALTER TABLE `balance_in_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_balance_in` (`id_balance_in`),
  ADD KEY `id_invoice_detail` (`id_invoice_detail`);

--
-- Indexes for table `balance_outs`
--
ALTER TABLE `balance_outs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `balance_out_transactions`
--
ALTER TABLE `balance_out_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_balance_iut` (`id_balance_out`),
  ADD KEY `id_invoice_detail` (`id_invoice_detail`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_branch` (`id_branch`),
  ADD KEY `id_bank` (`id_bank`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_branch_2` (`id_branch`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_address` (`id_address`);

--
-- Indexes for table `branchs`
--
ALTER TABLE `branchs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bank` (`id_bank`),
  ADD KEY `id_address` (`id_address`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ask` (`id_ask`),
  ADD KEY `id_cart` (`id_cart`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_problem` (`id_problem`),
  ADD KEY `id_solution` (`id_solution`);

--
-- Indexes for table `complain_comments`
--
ALTER TABLE `complain_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_complain` (`id_complain`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `complain_invoicedetails`
--
ALTER TABLE `complain_invoicedetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_complain` (`id_complain`),
  ADD KEY `id_invoice_detail` (`id_invoice_detail`);

--
-- Indexes for table `complain_tickets`
--
ALTER TABLE `complain_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_complain` (`id_complain`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debts`
--
ALTER TABLE `debts`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_balance_out` (`id_balance_out`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_regency` (`id_regency`),
  ADD KEY `id_regency_2` (`id_regency`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_address` (`id_address`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_invoice` (`id_invoice`),
  ADD KEY `id_shipping` (`id_shipping`),
  ADD KEY `id_address` (`id_address`),
  ADD KEY `id_bid` (`id_bid`),
  ADD KEY `id_ask` (`id_ask`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id_role`,`id_permission`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `Id_permission` (`id_permission`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id_permission`,`id_user`,`user_type`),
  ADD KEY `permission_id` (`id_permission`),
  ADD KEY `user_id` (`id_user`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolios`
--
ALTER TABLE `portofolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_division` (`id_division`),
  ADD KEY `id_photo` (`id_photo`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_country` (`id_country`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_country` (`id_country`);

--
-- Indexes for table `regencies`
--
ALTER TABLE `regencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_province` (`id_province`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id_user`,`id_role`,`user_type`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `is_role` (`id_role`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_users`
--
ALTER TABLE `shipping_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_shipping` (`id_shipping`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `solutions`
--
ALTER TABLE `solutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_tickets`
--
ALTER TABLE `staff_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_staff` (`id_staff`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DetailTicket` (`id_ticket_detail`),
  ADD KEY `SolutionTicket` (`id_ticket_solution`);

--
-- Indexes for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_solutions`
--
ALTER TABLE `ticket_solutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asks`
--
ALTER TABLE `asks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `balance_ins`
--
ALTER TABLE `balance_ins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `balance_in_transactions`
--
ALTER TABLE `balance_in_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `balance_outs`
--
ALTER TABLE `balance_outs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `balance_out_transactions`
--
ALTER TABLE `balance_out_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `branchs`
--
ALTER TABLE `branchs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complain_comments`
--
ALTER TABLE `complain_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complain_invoicedetails`
--
ALTER TABLE `complain_invoicedetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complain_tickets`
--
ALTER TABLE `complain_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `debts`
--
ALTER TABLE `debts`
  MODIFY `id_cart` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id_cart` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `portofolios`
--
ALTER TABLE `portofolios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `regencies`
--
ALTER TABLE `regencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipping_users`
--
ALTER TABLE `shipping_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `solutions`
--
ALTER TABLE `solutions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff_tickets`
--
ALTER TABLE `staff_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_details`
--
ALTER TABLE `ticket_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_solutions`
--
ALTER TABLE `ticket_solutions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `DistrictAddress` FOREIGN KEY (`id_district`) REFERENCES `districts` (`id`),
  ADD CONSTRAINT `ProvinceAddress` FOREIGN KEY (`id_province`) REFERENCES `provinces` (`id`),
  ADD CONSTRAINT `RegencyAddress` FOREIGN KEY (`id_regency`) REFERENCES `regencies` (`id`),
  ADD CONSTRAINT `UserAdress` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `asks`
--
ALTER TABLE `asks`
  ADD CONSTRAINT `AddressAsk` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `PhotoAsk` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`id`),
  ADD CONSTRAINT `ProductAsk` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `ProductdetailAsk` FOREIGN KEY (`id_product_detail`) REFERENCES `product_details` (`id`),
  ADD CONSTRAINT `UserAsk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `balance_ins`
--
ALTER TABLE `balance_ins`
  ADD CONSTRAINT `UserBalancein` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `balance_in_transactions`
--
ALTER TABLE `balance_in_transactions`
  ADD CONSTRAINT `BalanceinBalanceintransaction` FOREIGN KEY (`id_balance_in`) REFERENCES `balance_ins` (`id`),
  ADD CONSTRAINT `InvoicedetailBalanceintransaction` FOREIGN KEY (`id_invoice_detail`) REFERENCES `invoice_details` (`id`);

--
-- Constraints for table `balance_outs`
--
ALTER TABLE `balance_outs`
  ADD CONSTRAINT `UserBalanceout` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `balance_out_transactions`
--
ALTER TABLE `balance_out_transactions`
  ADD CONSTRAINT `BalanceoutBalanceouttransaction` FOREIGN KEY (`id_balance_out`) REFERENCES `balance_outs` (`id`),
  ADD CONSTRAINT `InvoicedetailBalanceouttransaction` FOREIGN KEY (`id_invoice_detail`) REFERENCES `invoice_details` (`id`);

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `BankBankaccount` FOREIGN KEY (`id_bank`) REFERENCES `banks` (`id`),
  ADD CONSTRAINT `BranchBankaccount` FOREIGN KEY (`id_branch`) REFERENCES `branchs` (`id`),
  ADD CONSTRAINT `UserBankaccount` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `AddressBid` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `ProductBid` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `UserBids` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `branchs`
--
ALTER TABLE `branchs`
  ADD CONSTRAINT `AddressBranch` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `BankBranch` FOREIGN KEY (`id_bank`) REFERENCES `banks` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `UserCart` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD CONSTRAINT `AskCartproduct` FOREIGN KEY (`id_ask`) REFERENCES `asks` (`id`),
  ADD CONSTRAINT `CartCartproduct` FOREIGN KEY (`id_cart`) REFERENCES `carts` (`id`);

--
-- Constraints for table `complains`
--
ALTER TABLE `complains`
  ADD CONSTRAINT `ProblemComplain` FOREIGN KEY (`id_problem`) REFERENCES `problems` (`id`),
  ADD CONSTRAINT `SolutionComplain` FOREIGN KEY (`id_solution`) REFERENCES `solutions` (`id`);

--
-- Constraints for table `complain_comments`
--
ALTER TABLE `complain_comments`
  ADD CONSTRAINT `ComplainComplaincomment` FOREIGN KEY (`id_complain`) REFERENCES `complains` (`id`),
  ADD CONSTRAINT `UserComplaincomment` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `complain_invoicedetails`
--
ALTER TABLE `complain_invoicedetails`
  ADD CONSTRAINT `ComplainComplaininvoicedetail` FOREIGN KEY (`id_complain`) REFERENCES `complains` (`id`),
  ADD CONSTRAINT `InvoicedetailComplaininvoicedetail` FOREIGN KEY (`id_invoice_detail`) REFERENCES `invoice_details` (`id`);

--
-- Constraints for table `complain_tickets`
--
ALTER TABLE `complain_tickets`
  ADD CONSTRAINT `ComplainComplainticket` FOREIGN KEY (`id_complain`) REFERENCES `complains` (`id`),
  ADD CONSTRAINT `TicketComplainticket` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id`);

--
-- Constraints for table `debts`
--
ALTER TABLE `debts`
  ADD CONSTRAINT `BalanceoutDebt` FOREIGN KEY (`id_balance_out`) REFERENCES `balance_outs` (`id`);

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `DistrictRegency` FOREIGN KEY (`id_regency`) REFERENCES `regencies` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `AddressInvoice` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `UserInvoice` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT ` BidInvoicedetail` FOREIGN KEY (`id_bid`) REFERENCES `bids` (`id`),
  ADD CONSTRAINT `AddressInvoicedetail` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `AskInvoicedetail` FOREIGN KEY (`id_ask`) REFERENCES `asks` (`id`),
  ADD CONSTRAINT `InvoiceInvoicedetail` FOREIGN KEY (`id_invoice`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `ShippingInvoicedetail` FOREIGN KEY (`id_shipping`) REFERENCES `shippings` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `PermissionRolepermission` FOREIGN KEY (`id_permission`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `RoleRolepermission` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`);

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `PermissionPermissionuser` FOREIGN KEY (`id_permission`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `UserPermissionuser` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `portofolios`
--
ALTER TABLE `portofolios`
  ADD CONSTRAINT `PortofolioProduct` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `PortofolioUser` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `BrandProduct` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `DivisionProduct` FOREIGN KEY (`id_division`) REFERENCES `divisions` (`id`),
  ADD CONSTRAINT `PhotoProduct` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`id`);

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `CountryProductdetails` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id`);

--
-- Constraints for table `provinces`
--
ALTER TABLE `provinces`
  ADD CONSTRAINT `CountryProvince` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id`);

--
-- Constraints for table `regencies`
--
ALTER TABLE `regencies`
  ADD CONSTRAINT `ProvinceRegency` FOREIGN KEY (`id_province`) REFERENCES `provinces` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `RoleUserrole` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `UserUserrole` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `shipping_users`
--
ALTER TABLE `shipping_users`
  ADD CONSTRAINT `ShippingShippinguser` FOREIGN KEY (`id_shipping`) REFERENCES `shippings` (`id`),
  ADD CONSTRAINT `UserShippinguser` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `staff_tickets`
--
ALTER TABLE `staff_tickets`
  ADD CONSTRAINT `StaffStaffticket` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `TicketStaffticket` FOREIGN KEY (`id_staff`) REFERENCES `users` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `DetailTicket` FOREIGN KEY (`id_ticket_detail`) REFERENCES `ticket_details` (`id`),
  ADD CONSTRAINT `SolutionTicket` FOREIGN KEY (`id_ticket_solution`) REFERENCES `ticket_solutions` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `ProductWishlist` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `UserWishlist` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
