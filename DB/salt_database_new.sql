-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2023 at 07:03 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salt_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE `tbl_brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brands`
--

INSERT INTO `tbl_brands` (`brand_id`, `brand_name`, `status`) VALUES
(1, 'Flying Machine', 1),
(2, 'Jack & Jones', 1),
(3, 'H&M', 1),
(4, 'WRONG', 1),
(5, 'Roadster', 1),
(6, 'Tommy Hilfiger', 1),
(7, 'Puma', 1),
(8, 'United Colors of Benetton', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `user_uuid` varchar(255) NOT NULL,
  `product_uuid` varchar(255) NOT NULL,
  `variation_uuid` varchar(255) NOT NULL,
  `localstorage_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(30) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_size_id` int(5) NOT NULL,
  `product_size_name` varchar(15) NOT NULL,
  `product_color_id` int(5) NOT NULL,
  `product_color_name` varchar(25) NOT NULL,
  `product_mrp` decimal(20,0) NOT NULL,
  `product_selling_price` decimal(20,0) NOT NULL,
  `product_discount` int(5) NOT NULL,
  `total_quantity_inStock` int(255) NOT NULL,
  `item_count` varchar(40) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `user_uuid`, `product_uuid`, `variation_uuid`, `localstorage_id`, `product_name`, `product_image`, `product_quantity`, `product_size_id`, `product_size_name`, `product_color_id`, `product_color_name`, `product_mrp`, `product_selling_price`, `product_discount`, `total_quantity_inStock`, `item_count`, `created_at`, `updated_at`, `status`) VALUES
(8, '0e973860-b3b5-11ed-86da-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '', NULL, 'White T-Shirt ', '0_4.jpg', 1, 4, 'XL', 2, 'Black', '999', '1', 10, 0, '30', '2023-03-25 07:32:38.523658', '0000-00-00 00:00:00.000000', 0),
(9, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '', NULL, 'White T-Shirt ', '0_4.jpg', 1, 4, 'XL', 2, 'Black', '999', '1', 10, 0, '31', '2023-03-28 04:54:42.950367', '0000-00-00 00:00:00.000000', 0),
(10, '988f64b4-bc4a-11ed-bb06-98460a99789a', '616eedc2-be77-11ed-b750-98460a99789a', '', NULL, 'Black Shirt Round ', 'p2.jpg', 1, 4, 'XL', 3, 'Blue', '999', '100', 10, 0, '32', '2023-03-28 05:52:22.414456', '0000-00-00 00:00:00.000000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `parent_category_id`, `status`) VALUES
(1, 'Men', 0, 1),
(2, 'Women', 0, 1),
(3, 'Baby & Kids', 0, 1),
(4, 'T-shirts', 1, 1),
(5, 'Formal Shirts', 1, 1),
(6, 'Casual Shirts', 1, 1),
(7, 'Jackets & Sweatshirts', 1, 1),
(8, 'Kurtas & suits', 2, 1),
(9, 'Ethnic Dresses', 2, 1),
(10, 'Dupattas & Shawls', 2, 1),
(11, 'Kurtis, Tunics & Tops', 2, 1),
(12, 'Track Pants & Pyjamas', 3, 1),
(13, 'T-Shirts', 3, 1),
(14, 'Clothing Sets', 3, 1),
(15, 'Dungarees & Jumpsuits', 3, 1),
(16, 'Jeans', 1, 1),
(17, 'Gowns', 2, 1),
(19, 'Jeans', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_children`
--

CREATE TABLE `tbl_category_children` (
  `child_id` int(11) NOT NULL,
  `child_category_name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `fk_parent_id` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `links` varchar(255) DEFAULT NULL,
  `create_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `deleted_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category_children`
--

INSERT INTO `tbl_category_children` (`child_id`, `child_category_name`, `slug`, `fk_parent_id`, `status`, `links`, `create_at`, `updated_at`, `deleted_at`) VALUES
(1, 'T-Shirts', 't-shirts', 1, 1, NULL, '2023-02-20 17:59:59.552719', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 'Jeans', 'jeans', 1, 1, NULL, '2023-02-21 09:16:39.820349', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, 'Women T-Shirts', 'women-t-shirts', 2, 1, NULL, '2023-02-21 09:52:15.586196', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(5, 'Shirt', 'shirt', 1, 1, NULL, '2023-03-09 12:37:08.097805', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_patents`
--

CREATE TABLE `tbl_category_patents` (
  `parent_id` int(11) NOT NULL,
  `parent_category_name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `links` int(255) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `deleted_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category_patents`
--

INSERT INTO `tbl_category_patents` (`parent_id`, `parent_category_name`, `slug`, `links`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Men', 'men', NULL, 1, '2023-02-20 17:58:36.456298', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, 'Women', 'women', NULL, 1, '2023-02-21 09:50:13.902560', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_colors`
--

CREATE TABLE `tbl_colors` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(255) NOT NULL,
  `hex_code` varchar(12) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_colors`
--

INSERT INTO `tbl_colors` (`color_id`, `color_name`, `hex_code`, `status`) VALUES
(1, 'Red', '#FF0000', 1),
(2, 'Black', '', 1),
(3, 'Blue', '#0000FF', 1),
(4, 'Green', '#00FF00', 1),
(5, 'Yellow', '', 1),
(6, 'Pink', '', 1),
(7, 'Brown', '', 1),
(8, 'Gray', '', 1),
(9, 'White', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(11) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `phone_no`, `password`, `status`) VALUES
(1, '1111', '1111', 1),
(2, '2222', '2222', 1),
(3, '8888', '1111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_main_product`
--

CREATE TABLE `tbl_main_product` (
  `product_id` int(12) NOT NULL,
  `product_uuid` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `slug_product` varchar(255) NOT NULL,
  `brand_name` varchar(25) NOT NULL,
  `article_no` varchar(100) NOT NULL,
  `parent_cat_id` int(2) NOT NULL,
  `child_cat_id` int(2) NOT NULL,
  `slug_cat_child` varchar(255) DEFAULT NULL,
  `product_main_image` varchar(255) NOT NULL,
  `product_short_description` varchar(255) NOT NULL,
  `product_long_description` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_size_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_color_name` varchar(255) NOT NULL,
  `product_quantity` int(100) NOT NULL,
  `product_mrp` int(6) NOT NULL,
  `product_selling_price` int(6) NOT NULL,
  `discount_percentage` int(2) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `status` int(2) NOT NULL DEFAULT 1,
  `isActive` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_main_product`
--

INSERT INTO `tbl_main_product` (`product_id`, `product_uuid`, `product_name`, `slug_product`, `brand_name`, `article_no`, `parent_cat_id`, `child_cat_id`, `slug_cat_child`, `product_main_image`, `product_short_description`, `product_long_description`, `product_size`, `product_size_name`, `product_color`, `product_color_name`, `product_quantity`, `product_mrp`, `product_selling_price`, `discount_percentage`, `created_at`, `updated_at`, `status`, `isActive`) VALUES
(1, '616eedc2-be77-11ed-b750-98460a99789a', 'Black Shirt Round ', 'black-shirt-round-coller', 'ZARA', '', 1, 5, 'shirt', 'p2.jpg', 'Black Shirt Round Coller', '<ul>\r\n	<li>Care Instructions: Machine Wash</li>\r\n	<li>Fit Type: Regular Fit</li>\r\n	<li>Soft and Breathable 100% Cotton Fabric</li>\r\n	<li>Mandarin collar solid color shirt</li>\r\n	<li>Single pocket at chest</li>\r\n	<li>Regular fit long sleeve shirt</li>\r\n	<l', '2', 'M', '2', 'Black', 10, 2, 100, 50, '2023-03-23 11:25:32.443816', '0000-00-00 00:00:00.000000', 1, 1),
(2, 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt ', 'white-t-shirt', 'ZARA', 'A989YUTE', 1, 1, 't-shirts', '0_4.jpg', 'White T-Shirt Round neck', '<ul>\r\n	<li>White T-Shirt Round neck</li>\r\n	<li>White T-Shirt Round neck</li>\r\n	<li>White T-Shirt Round neck</li>\r\n	<li>White T-Shirt Round neck</li>\r\n	<li>White T-Shirt Round neck</li>\r\n</ul>\r\n', '5', 'XXL', '9', 'White', 15, 2, 1, 50, '2023-03-23 11:34:33.821606', '0000-00-00 00:00:00.000000', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mapping_orderedProducts_user`
--

CREATE TABLE `tbl_mapping_orderedProducts_user` (
  `mapping_id` int(11) NOT NULL,
  `user_uuid` varchar(255) NOT NULL,
  `product_uuid` varchar(255) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `shipping_status` int(2) NOT NULL COMMENT '0 => Pending\r\n1 => delivered',
  `delivery_confirm_code` int(8) NOT NULL,
  `isActive` int(2) NOT NULL DEFAULT 1,
  `createdAt` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mapping_orderedProducts_user`
--

INSERT INTO `tbl_mapping_orderedProducts_user` (`mapping_id`, `user_uuid`, `product_uuid`, `product_name`, `shipping_status`, `delivery_confirm_code`, `isActive`, `createdAt`) VALUES
(1, '988f64b4-bc4a-11ed-bb06-98460a99789a', '616eedc2-be77-11ed-b750-98460a99789a', 'Black Shirt Round Coller', 1, 320274, 1, '0000-00-00 00:00:00.000000'),
(2, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt', 1, 320274, 1, '0000-00-00 00:00:00.000000'),
(3, '988f64b4-bc4a-11ed-bb06-98460a99789a', '616eedc2-be77-11ed-b750-98460a99789a', 'Black Shirt Round Coller', 0, 361772, 1, '0000-00-00 00:00:00.000000'),
(4, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt', 0, 361772, 1, '0000-00-00 00:00:00.000000'),
(5, '988f64b4-bc4a-11ed-bb06-98460a99789a', '616eedc2-be77-11ed-b750-98460a99789a', 'Black Shirt Round Coller', 0, 533092, 1, '0000-00-00 00:00:00.000000'),
(6, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt', 0, 533092, 1, '0000-00-00 00:00:00.000000'),
(7, '988f64b4-bc4a-11ed-bb06-98460a99789a', '616eedc2-be77-11ed-b750-98460a99789a', 'Black Shirt Round Coller', 0, 935515, 1, '0000-00-00 00:00:00.000000'),
(8, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt', 0, 935515, 1, '0000-00-00 00:00:00.000000'),
(9, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt', 0, 253896, 1, '0000-00-00 00:00:00.000000'),
(10, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt', 0, 285870, 1, '0000-00-00 00:00:00.000000'),
(11, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt', 0, 379892, 1, '0000-00-00 00:00:00.000000'),
(12, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt ', 0, 379892, 1, '0000-00-00 00:00:00.000000'),
(13, '0e973860-b3b5-11ed-86da-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt ', 0, 747302, 1, '0000-00-00 00:00:00.000000'),
(14, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'White T-Shirt ', 0, 601590, 1, '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(12) NOT NULL,
  `order_uuid` varchar(255) NOT NULL,
  `user_uuid` varchar(255) NOT NULL,
  `product_uuid` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_size_id` int(2) NOT NULL,
  `product_size_name` varchar(25) NOT NULL,
  `product_color_id` int(2) NOT NULL,
  `product_color_name` varchar(25) NOT NULL,
  `product_mrp` int(6) NOT NULL,
  `product_selling_price` int(6) NOT NULL,
  `product_discount` int(3) NOT NULL,
  `article_no` varchar(15) NOT NULL,
  `product_quantity` int(6) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(25) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `receivers_phone_no` varchar(15) NOT NULL,
  `addr_house_no` varchar(50) NOT NULL,
  `addr_locality` varchar(100) NOT NULL,
  `addr_city` varchar(50) NOT NULL,
  `addr_pin_code` int(10) NOT NULL,
  `addr_state` varchar(20) NOT NULL,
  `addr_country` varchar(10) NOT NULL,
  `addr_type` int(2) NOT NULL,
  `total_product_quantity` int(10) NOT NULL,
  `total_amount` int(6) NOT NULL,
  `transaction_id` varchar(25) NOT NULL,
  `transaction_status` int(2) NOT NULL COMMENT '0=> Online\r\n1=> COD',
  `conformation_code` int(8) NOT NULL,
  `payment_method` varchar(25) NOT NULL,
  `productInfo_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `transaction_datetime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `createdAt` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `updatedAt` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `status` int(2) NOT NULL,
  `order_return_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `order_uuid`, `user_uuid`, `product_uuid`, `product_name`, `product_image`, `product_size_id`, `product_size_name`, `product_color_id`, `product_color_name`, `product_mrp`, `product_selling_price`, `product_discount`, `article_no`, `product_quantity`, `user_name`, `user_email`, `phone_no`, `receivers_phone_no`, `addr_house_no`, `addr_locality`, `addr_city`, `addr_pin_code`, `addr_state`, `addr_country`, `addr_type`, `total_product_quantity`, `total_amount`, `transaction_id`, `transaction_status`, `conformation_code`, `payment_method`, `productInfo_json`, `transaction_datetime`, `createdAt`, `updatedAt`, `status`, `order_return_status`) VALUES
(1, '201f5f02-ca2d-11ed-9bfa-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 281928, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', '2023-03-24 05:47:47.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(2, '201fad9a-ca2d-11ed-9bfa-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 533092, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', '2023-03-24 05:47:47.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(3, '7e5e8e80-ca2d-11ed-9bfa-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 103334, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', '2023-03-24 05:50:26.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(4, '7e5eb8a6-ca2d-11ed-9bfa-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 935515, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', '2023-03-24 05:50:26.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(5, '90155794-ca2d-11ed-9bfa-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 253896, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', '2023-03-24 05:50:55.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(6, '9a0bb66e-ca30-11ed-9bfa-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 285870, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', '2023-03-24 06:12:41.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(7, 'cdb64044-cad3-11ed-ab58-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 789582, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt \",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Black\",\"product_selling_price\":\"1\"}]', '2023-03-25 01:40:55.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(8, 'cdb68cca-cad3-11ed-ab58-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 379892, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt \",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Black\",\"product_selling_price\":\"1\"}]', '2023-03-25 01:40:55.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(9, '40f389d0-cadf-11ed-ab58-98460a99789a', '0e973860-b3b5-11ed-86da-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 747302, '', '[{\"user_uuid\":\"0e973860-b3b5-11ed-86da-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt \",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Black\",\"product_selling_price\":\"1\"}]', '2023-03-25 03:02:53.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(10, '36e79650-cd2a-11ed-84c1-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, '', 1, 601590, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt \",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Black\",\"product_selling_price\":\"1\"}]', '2023-03-28 05:35:40.666246', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0),
(11, 'bc1d086c-cd31-11ed-84c1-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '', '', 0, '', 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', 0, '', '', 0, 0, 2, 'pay_LWqTL7OwUWLGKT', 0, 0, '', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt \",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Black\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round \",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"100\"}]', '2023-03-28 02:58:21.000000', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_colors`
--

CREATE TABLE `tbl_product_colors` (
  `product_color_id` int(11) NOT NULL,
  `product_uuid` varchar(255) NOT NULL,
  `variation_id` int(2) NOT NULL,
  `variation_color_id` int(2) NOT NULL COMMENT 'variation_color_id is color_id(tbl_color)',
  `variation_color_name` varchar(255) NOT NULL,
  `prod_color_img1` varchar(255) NOT NULL,
  `prod_color_img2` varchar(255) NOT NULL,
  `prod_color_img3` varchar(255) NOT NULL,
  `prod_color_img4` varchar(255) NOT NULL,
  `prod_color_img5` varchar(255) NOT NULL,
  `createdAt` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updatedAt` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `deletedAt` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `isDeleted` int(2) NOT NULL DEFAULT 0,
  `isActive` int(2) NOT NULL DEFAULT 1,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_colors`
--

INSERT INTO `tbl_product_colors` (`product_color_id`, `product_uuid`, `variation_id`, `variation_color_id`, `variation_color_name`, `prod_color_img1`, `prod_color_img2`, `prod_color_img3`, `prod_color_img4`, `prod_color_img5`, `createdAt`, `updatedAt`, `deletedAt`, `isDeleted`, `isActive`, `status`) VALUES
(1, '616eedc2-be77-11ed-b750-98460a99789a', 0, 3, 'Blue', '5_27.jpg', '6_20.jpg', '6_28.jpg', '7_29.jpg', '8_30.jpg', '2023-03-09 18:20:59.548262', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 1, 1),
(2, 'c6b04c52-c256-11ed-bf9a-98460a99789a', 0, 5, 'Yellow', '4_8.jpg', '4_17.jpg', '5_18.jpg', '5_271.jpg', '6_201.jpg', '2023-03-15 07:39:25.550698', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_images`
--

CREATE TABLE `tbl_product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_uuid` varchar(255) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `prd_img_1` varchar(255) NOT NULL,
  `prd_img_2` varchar(255) NOT NULL,
  `prd_img_3` varchar(255) NOT NULL,
  `prd_img_4` varchar(255) NOT NULL,
  `prd_img_5` varchar(255) NOT NULL,
  `prd_img_6` varchar(255) NOT NULL,
  `create_datetime` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `isActive` int(2) NOT NULL DEFAULT 1,
  `isDeleted` int(2) NOT NULL DEFAULT 0,
  `status` int(2) NOT NULL DEFAULT 1,
  `updated_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_images`
--

INSERT INTO `tbl_product_images` (`image_id`, `product_id`, `product_uuid`, `variation_id`, `prd_img_1`, `prd_img_2`, `prd_img_3`, `prd_img_4`, `prd_img_5`, `prd_img_6`, `create_datetime`, `isActive`, `isDeleted`, `status`, `updated_at`) VALUES
(1, 1, '616eedc2-be77-11ed-b750-98460a99789a', 0, '0_1.jpg', '0_4.jpg', '0_8.jpg', '0_13.jpg', '0_22.jpg', '0_22.jpg', '2023-03-09 18:18:37.557932', 1, 0, 1, '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_variation`
--

CREATE TABLE `tbl_product_variation` (
  `variant_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_uuid` varchar(255) NOT NULL,
  `product_uuid` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_size_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_color_name` varchar(255) NOT NULL,
  `product_mrp` int(6) NOT NULL,
  `product_selling_price` int(6) NOT NULL,
  `discount_percentage` int(2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `isDeleted` int(2) NOT NULL,
  `isActive` int(2) NOT NULL DEFAULT 1,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_variation`
--

INSERT INTO `tbl_product_variation` (`variant_id`, `product_id`, `variation_uuid`, `product_uuid`, `product_size`, `product_size_name`, `product_color`, `product_color_name`, `product_mrp`, `product_selling_price`, `discount_percentage`, `product_quantity`, `created_at`, `isDeleted`, `isActive`, `status`) VALUES
(1, 1, '', '616eedc2-be77-11ed-b750-98460a99789a', '4', 'XL', '3', 'Blue', 4, 2, 50, 12, '2023-03-09 18:17:32.928995', 0, 1, 1),
(2, 2, '', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '4', 'XL', '5', 'Yellow', 2, 2, 78, 12, '2023-03-23 09:47:04.117884', 0, 1, 1),
(3, 2, '', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '4', 'XL', '5', 'Yellow', 4, 2, 78, 12, '2023-03-23 09:47:04.117884', 0, 1, 1),
(4, 2, '55f8da98-c95d-11ed-8f69-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '4', 'XL', '2', 'Black', 22, 266, 78, 12, '2023-03-23 11:34:33.823740', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating_reviews`
--

CREATE TABLE `tbl_rating_reviews` (
  `rating_id` int(11) NOT NULL,
  `rating_uuid` varchar(255) NOT NULL,
  `product_uuid` varchar(255) NOT NULL,
  `user_uuid` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `rating_number` int(6) NOT NULL,
  `rating_title` varchar(255) NOT NULL,
  `rating_comment` varchar(255) NOT NULL,
  `isVerifiedBuyer` int(2) NOT NULL DEFAULT 0,
  `admin_reply` varchar(255) NOT NULL,
  `showAdminReply` int(2) NOT NULL DEFAULT 1,
  `isActive` int(2) NOT NULL DEFAULT 1,
  `status` int(2) NOT NULL DEFAULT 1,
  `createdAt` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `modifiedAt` datetime(6) NOT NULL,
  `deletedAt` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rating_reviews`
--

INSERT INTO `tbl_rating_reviews` (`rating_id`, `rating_uuid`, `product_uuid`, `user_uuid`, `user_name`, `rating_number`, `rating_title`, `rating_comment`, `isVerifiedBuyer`, `admin_reply`, `showAdminReply`, `isActive`, `status`, `createdAt`, `modifiedAt`, `deletedAt`) VALUES
(1, '8c3b60ee-c719-11ed-9957-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '', '', 4, 'Wow awsm Product', 'good fitting', 0, '', 1, 1, 1, '2023-03-21 06:22:20.593286', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(2, '15d6acfc-c7b8-11ed-b168-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', 3, 'Nice Product', 'Big enough for a weekend trip.', 0, '', 1, 1, 1, '2023-03-21 07:14:57.265228', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(3, '6bd2330c-c7bc-11ed-b168-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', 'Jack', 1, 'Poor Product', 'not buy', 1, '', 1, 1, 1, '2023-03-21 09:04:14.567260', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(4, '917b79bc-c7c9-11ed-b1fa-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', 'Jack', 5, 'Amazing color', 'Testing delivery status', 1, '', 1, 1, 1, '2023-03-21 09:20:06.147541', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
(5, '949f5a9c-c7cd-11ed-b1fa-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', 'None', 'User', 5, 'unknown user', 'sdajsdadas', 0, '', 1, 1, 1, '2023-03-21 09:48:49.404628', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE `tbl_registration` (
  `user_id` int(11) NOT NULL,
  `user_uuid` varchar(255) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `receivers_phone_no` varchar(15) NOT NULL,
  `addr_house_no` varchar(50) NOT NULL,
  `addr_locality` varchar(100) NOT NULL,
  `addr_city` varchar(100) NOT NULL,
  `addr_pin_code` int(10) NOT NULL,
  `addr_state` varchar(20) NOT NULL,
  `addr_country` varchar(10) NOT NULL,
  `addr_type` int(2) NOT NULL COMMENT '1 => home,\r\n2 => work'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`user_id`, `user_uuid`, `user_name`, `email`, `phone_no`, `password`, `receivers_phone_no`, `addr_house_no`, `addr_locality`, `addr_city`, `addr_pin_code`, `addr_state`, `addr_country`, `addr_type`) VALUES
(1, '0e973860-b3b5-11ed-86da-98460a99789a', 'Asif Iqbal', 'aasif.iqbal9000@gmail.com', '1111', '1111', '0', 'Jack & Jill school,', 'Hazaribagh', 'Hazaribagh', 825301, 'Delhi', 'India', 1),
(2, 'baa40c4c-b404-11ed-b371-98460a99789a', 'Testing', 'test123@gmail.com', '2222', '2222', '0', 'testing house 29/2', 'Testing', 'Testing', 221122, 'Delhi', 'India', 1),
(3, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'Jack', 'jack@gmail.com', '8888', '1111', '9090221122', 'H-98/2, Near Dep Talab', 'Dr. Zakkir Hussain Road', 'Hazaribagh', 110023, 'Delhi', 'India', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping_orders`
--

CREATE TABLE `tbl_shipping_orders` (
  `shipping_id` int(11) NOT NULL,
  `shipping_uuid` varchar(255) NOT NULL,
  `order_uuid` varchar(255) NOT NULL,
  `product_uuid` varchar(255) NOT NULL,
  `user_uuid` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_mode` varchar(10) NOT NULL,
  `payment_status` int(5) NOT NULL,
  `shipping_status` int(2) NOT NULL COMMENT '0=> Pending\r\n1=> Shipped\r\n2=> Cancelled',
  `transpoter_name` varchar(25) NOT NULL,
  `conformation_code` int(8) NOT NULL,
  `ordered_datetime` datetime(6) NOT NULL,
  `product_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`product_json`)),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shipping_orders`
--

INSERT INTO `tbl_shipping_orders` (`shipping_id`, `shipping_uuid`, `order_uuid`, `product_uuid`, `user_uuid`, `payment_id`, `payment_mode`, `payment_status`, `shipping_status`, `transpoter_name`, `conformation_code`, `ordered_datetime`, `product_json`, `status`) VALUES
(1, '93675302-c5c3-11ed-978f-98460a99789a', 'fbc59392-c586-11ed-978f-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 0, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"2\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(2, 'fe1e2c3e-c627-11ed-95a8-98460a99789a', 'fe1d9044-c627-11ed-95a8-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 1, '', 94522, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"2\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(3, '6e4dfa56-c62e-11ed-95a8-98460a99789a', 'fe1d9044-c627-11ed-95a8-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 94522, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"2\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(4, 'f3421d64-c679-11ed-b1e2-98460a99789a', 'fe1d9044-c627-11ed-95a8-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 94522, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"2\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(5, '47edbb5c-c67a-11ed-b1e2-98460a99789a', 'fe1d9044-c627-11ed-95a8-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 1, '', 444126, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"2\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(6, '9c17a6c6-c74b-11ed-85e9-98460a99789a', 'fe1d9044-c627-11ed-95a8-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 134575, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"2\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(7, '3bb4c22a-c75d-11ed-85e9-98460a99789a', 'fe1d9044-c627-11ed-95a8-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 738162, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"2\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(8, '29de9f24-c75f-11ed-85e9-98460a99789a', '29de1dba-c75f-11ed-85e9-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 163512, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"2\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(9, 'd7dabf4e-c7ab-11ed-b168-98460a99789a', 'd7da6012-c7ab-11ed-b168-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 1, '', 320274, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"2\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(10, '8086e2b4-ca2a-11ed-9bfa-98460a99789a', '8086018c-ca2a-11ed-9bfa-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 164018, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(11, 'c934cc1e-ca2b-11ed-9bfa-98460a99789a', 'c934548c-ca2b-11ed-9bfa-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 518429, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(12, 'e5fa7bd6-ca2c-11ed-9bfa-98460a99789a', 'e5fa05de-ca2c-11ed-9bfa-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 361772, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(13, '20209a2a-ca2d-11ed-9bfa-98460a99789a', '201fad9a-ca2d-11ed-9bfa-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 533092, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(14, '7e5f606c-ca2d-11ed-9bfa-98460a99789a', '7e5eb8a6-ca2d-11ed-9bfa-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 935515, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"616eedc2-be77-11ed-b750-98460a99789a\",\"product_name\":\"Black Shirt Round Coller\",\"product_image\":\"p2.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Blue\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(15, '9015e8ee-ca2d-11ed-9bfa-98460a99789a', '90155794-ca2d-11ed-9bfa-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 253896, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(16, '9a0c6aaa-ca30-11ed-9bfa-98460a99789a', '9a0bb66e-ca30-11ed-9bfa-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 285870, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"}]', 1),
(17, 'cdb738d2-cad3-11ed-ab58-98460a99789a', 'cdb68cca-cad3-11ed-ab58-98460a99789a', '', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 379892, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt\",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"M\",\"product_color_name\":\"Yellow\",\"product_selling_price\":\"1\"},{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt \",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Black\",\"product_selling_price\":\"1\"}]', 1),
(18, '40f41b48-cadf-11ed-ab58-98460a99789a', '40f389d0-cadf-11ed-ab58-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '0e973860-b3b5-11ed-86da-98460a99789a', '', '1', 0, 0, '', 747302, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"0e973860-b3b5-11ed-86da-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt \",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Black\",\"product_selling_price\":\"1\"}]', 1),
(19, '36e82dea-cd2a-11ed-84c1-98460a99789a', '36e79650-cd2a-11ed-84c1-98460a99789a', 'c6b04c52-c256-11ed-bf9a-98460a99789a', '988f64b4-bc4a-11ed-bb06-98460a99789a', '', '1', 0, 0, '', 601590, '0000-00-00 00:00:00.000000', '[{\"user_uuid\":\"988f64b4-bc4a-11ed-bb06-98460a99789a\",\"product_uuid\":\"c6b04c52-c256-11ed-bf9a-98460a99789a\",\"product_name\":\"White T-Shirt \",\"product_image\":\"0_4.jpg\",\"product_quantity\":\"1\",\"product_size_name\":\"XL\",\"product_color_name\":\"Black\",\"product_selling_price\":\"1\"}]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sizes`
--

CREATE TABLE `tbl_sizes` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sizes`
--

INSERT INTO `tbl_sizes` (`size_id`, `size_name`, `status`) VALUES
(1, 'S', 1),
(2, 'M', 1),
(3, 'L', 1),
(4, 'XL', 1),
(5, 'XXL', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_category_children`
--
ALTER TABLE `tbl_category_children`
  ADD PRIMARY KEY (`child_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `tbl_category_patents`
--
ALTER TABLE `tbl_category_patents`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `tbl_colors`
--
ALTER TABLE `tbl_colors`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`);

--
-- Indexes for table `tbl_main_product`
--
ALTER TABLE `tbl_main_product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `slug_product` (`slug_product`);

--
-- Indexes for table `tbl_mapping_orderedProducts_user`
--
ALTER TABLE `tbl_mapping_orderedProducts_user`
  ADD PRIMARY KEY (`mapping_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_product_colors`
--
ALTER TABLE `tbl_product_colors`
  ADD PRIMARY KEY (`product_color_id`);

--
-- Indexes for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `tbl_product_variation`
--
ALTER TABLE `tbl_product_variation`
  ADD PRIMARY KEY (`variant_id`);

--
-- Indexes for table `tbl_rating_reviews`
--
ALTER TABLE `tbl_rating_reviews`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_shipping_orders`
--
ALTER TABLE `tbl_shipping_orders`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `tbl_sizes`
--
ALTER TABLE `tbl_sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_category_children`
--
ALTER TABLE `tbl_category_children`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category_patents`
--
ALTER TABLE `tbl_category_patents`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_colors`
--
ALTER TABLE `tbl_colors`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_main_product`
--
ALTER TABLE `tbl_main_product`
  MODIFY `product_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_mapping_orderedProducts_user`
--
ALTER TABLE `tbl_mapping_orderedProducts_user`
  MODIFY `mapping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_product_colors`
--
ALTER TABLE `tbl_product_colors`
  MODIFY `product_color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_product_variation`
--
ALTER TABLE `tbl_product_variation`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_rating_reviews`
--
ALTER TABLE `tbl_rating_reviews`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_shipping_orders`
--
ALTER TABLE `tbl_shipping_orders`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_sizes`
--
ALTER TABLE `tbl_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
