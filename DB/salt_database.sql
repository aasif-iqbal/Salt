-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 11, 2023 at 06:59 AM
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
  `localstorage_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(30) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_size_id` int(5) NOT NULL,
  `product_color_id` int(5) NOT NULL,
  `product_mrp` decimal(20,0) NOT NULL,
  `product_selling_price` decimal(20,0) NOT NULL,
  `product_discount` int(5) NOT NULL,
  `total_quantity_inStock` int(255) NOT NULL,
  `item_count` varchar(40) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `product_mrp` float(20,2) NOT NULL,
  `product_selling_price` float(20,2) NOT NULL,
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
(1, '616eedc2-be77-11ed-b750-98460a99789a', 'Black Shirt Round Coller', 'black-shirt-round-coller', 'ZARA', '', 1, 5, 'shirt', 'p2.jpg', 'Black Shirt Round Coller', '<ul>\r\n	<li>Care Instructions: Machine Wash</li>\r\n	<li>Fit Type: Regular Fit</li>\r\n	<li>Soft and Breathable 100% Cotton Fabric</li>\r\n	<li>Mandarin collar solid color shirt</li>\r\n	<li>Single pocket at chest</li>\r\n	<li>Regular fit long sleeve shirt</li>\r\n	<l', '2', 'M', '2', 'Black', 10, 2.00, 1.00, 50, '2023-03-09 12:39:06.337638', '0000-00-00 00:00:00.000000', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_parent_cat_id` int(11) NOT NULL,
  `product_child_cat_id` int(11) NOT NULL,
  `product_brand_id` int(11) NOT NULL,
  `product_color_id` int(2) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_short_description` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_mrp` float NOT NULL,
  `product_discount` int(11) NOT NULL,
  `product_actual_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_model_no` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_parent_cat_id`, `product_child_cat_id`, `product_brand_id`, `product_color_id`, `product_name`, `product_short_description`, `product_description`, `product_mrp`, `product_discount`, `product_actual_price`, `product_quantity`, `product_model_no`, `product_color`, `product_size`, `product_image`, `status`) VALUES
(1, 1, 4, 2, 6, 'Solid Round Neck T-shirt', 'Men Pink Solid Round Neck T-shirt', '<p>Solid Round Neck T-shirt</p>\r\n<p>Solid Round Neck T-shirt</p>\r\n', 499, 40, 299.4, 3, 'NMAGCQJ', 'Pink', 'S,M,L,XL', 'image/casual-wear-mens-t-shirt-351.jpg', 1),
(2, 1, 4, 4, 9, 'Printed Slim Fit T-shirt', 'White Printed Slim Fit T-shirt', '<p>Printed Slim Fit T-shirt</p>\r\n<p>Printed Slim Fit T-shirt</p>\r\n', 699, 30, 489.3, 2, 'HD6GZ5R', 'White', 'S,M,L,XXL', 'image/p2.jpeg', 1),
(3, 1, 4, 5, 4, 'Striped Round Neck T-shirt', 'Men Black-Olive Green Striped Round Neck T-shirt', '<p>Men Black &amp; Olive Green Striped Round Neck T-shirt</p>\r\n', 650, 20, 520, 2, 'IPAXRWG', 'Green', 'M,L,XL', 'image/w2.jpeg', 1),
(4, 1, 4, 8, 4, 'Colour blocked T-shirt', 'Men Green-Black Colour blocked T-shirt', '<p>Colour blocked T-shirt</p>\r\n<p>Colour blocked T-shirt</p>\r\n', 800, 25, 600, 2, 'ZB3CMXF', 'Green', 'M,L,XXL', 'image/p1.jpg', 1),
(5, 1, 4, 6, 6, 'Solid Round Neck T-shirt', 'Men Pink Solid Round Neck T-shirt', '<p>Men Pink Solid Round Neck T-shirt</p>\r\n', 599, 30, 419.3, 2, '3PBN0WA', 'Pink', 'S,M,L,XL', 'image/POLO-T-SHIRT.jpg', 1),
(6, 1, 4, 1, 2, 'Printed Longline T-shirt', 'Men Black Printed Longline T-shirt', '<p>Men Black Tshirt</p>\r\n', 499, 25, 374.25, 2, '25YJ6XK', 'Black', 'S,M,L,XL', 'image/tshirt-unisex-200x300.jpg', 1),
(7, 1, 5, 3, 2, 'Slim Fit Solid Formal Shirt', 'Men Black Slim Fit Solid Formal Shirt', '<p>formal</p>\r\n', 1399, 50, 699.5, 7, '5894KO6', 'Black', 'S,M,L,XL', 'image/SHRT12BLK-A_300x300.jpg', 1),
(8, 1, 5, 2, 9, 'Slim Fit Solid Formal Shirt', 'Men White Slim Fit Solid Formal Shirt', '<p>Formal</p>\r\n', 1000, 20, 800, 2, 'WLC3Q09', 'White', 'S,M,L,XL', 'image/a.jpg', 1),
(9, 1, 5, 1, 3, 'Slim Fit Solid Formal Shirt', 'Men Blue Smart Slim Fit Solid Formal Shirt', '<p>Slim Fit Solid Formal Shirt</p>\r\n', 1400, 20, 1120, 2, '1S3TNW7', 'Blue', 'S,M,L,XL', 'image/blue.jpeg', 1),
(10, 1, 16, 1, 3, 'Slim Tapered Stretchable Jeans', 'Men Blue Slim Tapered Mid-Rise Clean Look Stretchable Jeans', '<p>Slim Tapered Mid-Rise Clean Look Stretchable Jeans</p>\r\n', 1999, 20, 1599.2, 7, '6TAW8H5', 'Blue', 'M,L,XL', 'image/men-s-jeans-930.jpg', 1),
(11, 1, 16, 5, 4, 'Slim Fit Stretchable Jeans', 'Men Green Slim Fit Mid-Rise Clean Look Stretchable Jeans', '<p>Men Green Slim Fit Mid-Rise Clean Look Stretchable Jeans</p>\r\n', 2500, 30, 1750, 1, 'FL4HGBA', 'Green', 'S,M,L,XL', 'image/item_L_22459991_30601857.jpg', 1),
(12, 1, 16, 4, 7, 'Khaki Slim Fit Stretchable Jeans', 'Men Khaki Slim Fit Mid-Rise Clean Look Stretchable Jeans', '<p>Men Khaki Slim Fit Mid-Rise Clean Look Stretchable Jeans</p>\r\n', 2800, 30, 1960, 12, '3PK492H', 'Brown', 'S,M,L,XL', 'image/imagesoio.jpeg', 1),
(13, 1, 12, 3, 9, 'H&M T-shirt', 'H&M T-shirt', 'H&M T-shirt', 1200, 50, 600, 1, 'NMAGCQK', 'White', 'M,L,XL', 'image/1.jpg', 1),
(14, 1, 13, 4, 2, 'WRONG Black T-Shirt', 'WRONG Black T-Shirt', 'WRONG Black T-Shirt', 1400, 40, 840, 9, 'NMAGCQF', 'Black', 'S,M,L,XL', 'image/2.jpg', 1),
(15, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/3.jpg', 1),
(16, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/4.jpg', 1),
(17, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/5.jpg', 1),
(18, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/6.jpg', 1),
(19, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/7.jpg', 1),
(20, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/8.jpg', 1),
(21, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/9.jpg', 1),
(22, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/10.jpg', 1),
(23, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/11.jpg', 1),
(24, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/12.jpg', 1),
(25, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/13.jpg', 1),
(26, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/14.jpg', 1),
(27, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/15.jpg', 1),
(28, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/16.jpg', 1),
(29, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/17.jpg', 1),
(30, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/18.jpg', 1),
(31, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/19.jpg', 1),
(32, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/20.jpg', 1),
(33, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/21.jpg', 1),
(34, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/22.jpg', 1),
(35, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/23.jpg', 1),
(36, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/24.jpg', 1),
(37, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/25.jpg', 1),
(38, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/26.jpg', 1),
(39, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/27.jpg', 1),
(40, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/28.jpg', 1),
(41, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/29.jpg', 1),
(42, 1, 12, 3, 9, 'T-Shirt', 'T-Shirt', 'T-Shirt', 1200, 50, 600, 15, 'NMAGCQK', 'White', 'M,L,XL', 'image/30.jpg', 1);

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
(1, '616eedc2-be77-11ed-b750-98460a99789a', 0, 3, 'Blue', '5_27.jpg', '6_20.jpg', '6_28.jpg', '7_29.jpg', '8_30.jpg', '2023-03-09 18:20:59.548262', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 0, 1, 1);

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
  `product_uuid` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_size_name` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_color_name` varchar(255) NOT NULL,
  `product_mrp` float(20,2) NOT NULL,
  `product_selling_price` float(20,2) NOT NULL,
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

INSERT INTO `tbl_product_variation` (`variant_id`, `product_id`, `product_uuid`, `product_size`, `product_size_name`, `product_color`, `product_color_name`, `product_mrp`, `product_selling_price`, `discount_percentage`, `product_quantity`, `created_at`, `isDeleted`, `isActive`, `status`) VALUES
(1, 1, '616eedc2-be77-11ed-b750-98460a99789a', '4', 'XL', '3', 'Blue', 4.00, 2.00, 50, 12, '2023-03-09 18:17:32.928995', 0, 1, 1);

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

INSERT INTO `tbl_registration` (`user_id`, `user_uuid`, `user_name`, `email`, `phone_no`, `password`, `addr_house_no`, `addr_locality`, `addr_city`, `addr_pin_code`, `addr_state`, `addr_country`, `addr_type`) VALUES
(1, '0e973860-b3b5-11ed-86da-98460a99789a', 'Asif Iqbal', 'aasif.iqbal9000@gmail.com', '1111', '1111', 'Jack & Jill school,', 'Hazaribagh', 'Hazaribagh', 825301, 'Delhi', 'India', 1),
(2, 'baa40c4c-b404-11ed-b371-98460a99789a', 'Testing', 'test123@gmail.com', '2222', '2222', 'testing house 29/2', 'Testing', 'Testing', 221122, 'Delhi', 'India', 1),
(3, '988f64b4-bc4a-11ed-bb06-98460a99789a', 'Jack', 'jack@gmail.com', '8888', '1111', 'house no 99', 'hzb', 'hzb ', 110023, 'Delhi', 'India', 1);

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
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

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
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `product_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_product_colors`
--
ALTER TABLE `tbl_product_colors`
  MODIFY `product_color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_product_variation`
--
ALTER TABLE `tbl_product_variation`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_sizes`
--
ALTER TABLE `tbl_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
