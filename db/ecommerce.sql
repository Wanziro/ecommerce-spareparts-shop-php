-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2021 at 11:27 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `item_number` int(11) NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `ip_address` varchar(100) NOT NULL DEFAULT '0',
  `modified` varchar(5) NOT NULL DEFAULT 'NO',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `item_number`, `username`, `ip_address`, `modified`, `date`) VALUES
(3, 38, 4, 'raban', '0', 'NO', '2021-09-26 16:56:57'),
(6, 26, 5, 'theo2020', '0', 'NO', '2021-09-30 11:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `engine_type`
--

DROP TABLE IF EXISTS `engine_type`;
CREATE TABLE IF NOT EXISTS `engine_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `fuel` varchar(100) NOT NULL,
  `vehicle_model` varchar(111) NOT NULL,
  `vehicle_mark` varchar(111) NOT NULL,
  `vehicle_category` varchar(111) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `engine_type`
--

INSERT INTO `engine_type` (`id`, `name`, `fuel`, `vehicle_model`, `vehicle_mark`, `vehicle_category`) VALUES
(6, 'corolla XII Hatchback(E210)(10/2018)', 'petrol', 'corolla', 'Toyota', 'Cars'),
(7, 'Single Cylinder, Four Stroke, Natural Air Cooled', 'petrol', 'TVS STAR HLX 125', 'TVS STAR', 'Motocycles'),
(8, '114 C/330', 'diesel', 'scania 4 series', 'scania', 'Trucks');

-- --------------------------------------------------------

--
-- Table structure for table `fuel`
--

DROP TABLE IF EXISTS `fuel`;
CREATE TABLE IF NOT EXISTS `fuel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `vehicle_model` varchar(100) NOT NULL,
  `vehicle_mark` varchar(100) NOT NULL,
  `vehicle_category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel`
--

INSERT INTO `fuel` (`id`, `name`, `vehicle_model`, `vehicle_mark`, `vehicle_category`) VALUES
(2, 'Diesel', 'Cammry', 'Toyota', 'Cars'),
(4, 'petrol', 'corolla', 'Toyota', 'Cars'),
(5, 'petrol', 'TVS STAR HLX 125', 'TVS STAR', 'Motocycles'),
(6, 'diesel', 'scania 4 series', 'scania', 'Trucks');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'latest',
  `tx_id` varchar(100) NOT NULL,
  `tx_ref` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `username`, `amount`, `status`, `tx_id`, `tx_ref`, `date`) VALUES
(1, 'wanziro', '100', 'Old', '503717420', 'UFVU726061632426158760', '2021-09-23 21:43:08'),
(2, 'wanziro', '100', 'Old', '503727242', 'KSLK248961632427134110', '2021-09-23 22:00:07'),
(3, 'admin', '100', 'Old', '503978322', 'CANO725351632465154953', '2021-09-24 08:33:04'),
(4, 'benson', '100', 'Old', '503998721', 'UKNO279131632468345562', '2021-09-24 09:26:10'),
(5, 'benson', '100', 'Old', '507443748', 'WHRU393231632981733861', '2021-09-30 08:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `search_list`
--

DROP TABLE IF EXISTS `search_list`;
CREATE TABLE IF NOT EXISTS `search_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `search_list`
--

INSERT INTO `search_list` (`id`, `name`, `date`) VALUES
(35, 'oil filter', '2021-08-21 22:40:07'),
(36, 'brake pads', '2021-08-21 22:40:16'),
(37, 'brake hose', '2021-08-21 22:40:29'),
(38, 'brake servo', '2021-08-21 22:40:59'),
(40, 'camshaft sensor', '2021-09-30 10:15:09'),
(41, 'License plate light bulb', '2021-09-30 10:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_info`
--

DROP TABLE IF EXISTS `shipping_info`;
CREATE TABLE IF NOT EXISTS `shipping_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(111) NOT NULL,
  `province` varchar(111) NOT NULL,
  `username` varchar(100) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_info`
--

INSERT INTO `shipping_info` (`id`, `fname`, `lname`, `email`, `phone`, `address`, `province`, `username`, `transaction_id`) VALUES
(1, 'Fabrice', 'Wanziro', 'ninga.fab@gmail.com', '0788230990', 'Kanombe - Kabeza', 'Kigali', 'wanziro', '503727242'),
(2, 'admin', 'Ben', 'nabimanyabenson2@gmail.com', '0780848761', 'kk 498 street', 'kigali', 'admin', '503978322'),
(3, 'NABIMANYA', 'Benson', 'nabimanyabenson2@gmail.com', '0780848761', 'kk 498 street', 'kigali', 'benson', '503998721'),
(4, 'NABIMANYA', 'Benson', 'nabimanyabenson2@gmail.com', '0780848761', 'kk 498 street', 'kigali', 'benson', '507443748');

-- --------------------------------------------------------

--
-- Table structure for table `sold_products`
--

DROP TABLE IF EXISTS `sold_products`;
CREATE TABLE IF NOT EXISTS `sold_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `transaction_id` varchar(111) NOT NULL,
  `username` varchar(111) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sold_products`
--

INSERT INTO `sold_products` (`id`, `product_id`, `name`, `price`, `quantity`, `total`, `transaction_id`, `username`, `date`) VALUES
(1, '14', 'blue ticks', '100', '1', '100', '503727242', 'wanziro', '2021-09-23 23:03:16'),
(2, '14', 'blue ticks', '100', '1', '100', '503978322', 'admin', '2021-09-24 08:33:04'),
(3, '15', 'bolt', '25', '4', '100', '503998721', 'benson', '2021-09-24 09:26:10'),
(4, '15', 'bolt', '25', '4', '100', '507443748', 'benson', '2021-09-30 08:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `spare_parts`
--

DROP TABLE IF EXISTS `spare_parts`;
CREATE TABLE IF NOT EXISTS `spare_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `spare_part_category` varchar(100) NOT NULL,
  `vehicle_category` varchar(100) NOT NULL,
  `vehicle_mark` varchar(100) NOT NULL,
  `vehicle_model` varchar(100) NOT NULL,
  `fuel` varchar(111) NOT NULL,
  `engine` varchar(111) NOT NULL,
  `part_number` varchar(100) NOT NULL,
  `description` text,
  `quantity` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL DEFAULT '0',
  `image` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spare_parts`
--

INSERT INTO `spare_parts` (`id`, `name`, `spare_part_category`, `vehicle_category`, `vehicle_mark`, `vehicle_model`, `fuel`, `engine`, `part_number`, `description`, `quantity`, `price`, `discount`, `image`, `date`) VALUES
(5, 'Atlas tyres', 'Tyres', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '5420068652310', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 30, '120000', '0', '1632154877jpg', '2021-09-20 18:21:17'),
(6, 'Tristar tyres', 'Tyres', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '5420068667178', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 20, '150000', '0', '1632155466jpg', '2021-09-20 18:31:06'),
(7, 'Torque', 'Tyres', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', ' 6953913193755', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 15, '140000', '0', '1632156233jpg', '2021-09-20 18:43:52'),
(8, 'ABS pump', 'Brake system', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '44540-02030', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 15, '510000', '0', '1632157457jpg', '2021-09-20 19:04:16'),
(9, 'Brake pads', 'Brake system', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '18', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 16, '20000', '0', '1632157910jpg', '2021-09-20 19:11:49'),
(10, 'brake discs', 'Brake system', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', 'A1N154', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 14, '150000', '0', '1632158671jpg', '2021-09-20 19:24:30'),
(11, 'spark plugs', 'Ignition system', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '25', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 20, '10000', '0', '1632159329jpg', '2021-09-20 19:35:28'),
(12, 'Ignition coil', 'Ignition system', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '90919-02271', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 40, '62000', '0', '1632160066jpg', '2021-09-20 19:47:46'),
(13, 'camshaft sensor', 'Ignition system', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '9091905060', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 15, '25000', '0', '1632160402jpg', '2021-09-20 19:53:21'),
(14, 'water pmp', 'Engine', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '16100-80014', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 14, '200000', '0', '1632160887jpg', '2021-09-20 20:01:27'),
(15, 'cylinder head ,gasket set', 'Engine', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '04112-47180', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 12, '90000', '0', '1632161592jpg', '2021-09-20 20:13:12'),
(16, 'Air filter', 'Engine', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '17801-77050', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 42, '12000', '0', '1632161948jpg', '2021-09-20 20:19:07'),
(17, 'wheel bearing kit', 'suspension and arms', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '4355047011', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 32, '50000', '0', '1632162444jpg', '2021-09-20 20:27:24'),
(18, 'ABS track control arm', 'suspension and arms', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '48770F4010', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 20, '25000', '0', '1632164645jpg', '2021-09-20 21:04:04'),
(19, 'Rod/strut,stablaliser', 'suspension and arms', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '4882047040', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 23, '11000', '0', '1632165058png', '2021-09-20 21:10:57'),
(20, 'Battery', 'Electronics', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '0009823108', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 15, '110000', '0', '1632166925jpg', '2021-09-20 21:42:04'),
(21, 'Starter', 'Electronics', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '28100-0Y270', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 10, '120000', '0', '1632167411jpg', '2021-09-20 21:50:11'),
(22, 'Mass air flow sensor', 'Electronics', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '22204-0F030', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 12, '60000', '0', '1632167751jpg', '2021-09-20 21:55:51'),
(23, 'Outside mirror', 'Body parts', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '403586', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 25, '8000', '0', '1632168591jpg', '2021-09-20 22:09:50'),
(24, 'License plate light bulb', 'Body parts', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '63 21 7 160 797', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 10, '1000', '0', '1632169057jpg', '2021-09-20 22:17:36'),
(25, 'Indicator Bulb', 'Body parts', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', 'YY04500902100', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 12, '1200', '0', '1632169674jpg', '2021-09-20 22:27:54'),
(26, 'Engine oil', 'Oil and fluids', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '109231', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 70, '32000', '0', '1632170784jpg', '2021-09-20 22:46:23'),
(27, 'Gear box and transmission oil', 'Oil and fluids', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 20, '25000', '0', '1632171711jpg', '2021-09-20 23:01:51'),
(28, 'Brake fluids', 'Oil and fluids', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '26746', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 12, '1000', '0', '1632172367jpg', '2021-09-20 23:12:46'),
(29, 'chains', 'Wheel drive', 'Motocycles', 'TVS STAR', 'TVS STAR HLX 125', 'petrol', 'Single Cylinder, Four Stroke, Natural Air Cooled', '420-126', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 20, '12000', '0', '1632197962jpg', '2021-09-21 06:19:21'),
(30, 'chain pinion', 'Wheel drive', 'Motocycles', 'TVS STAR', 'TVS STAR HLX 125', 'petrol', 'Single Cylinder, Four Stroke, Natural Air Cooled', '824225200652', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 21, '6000', '0', '1632198597jpg', '2021-09-21 06:29:56'),
(31, 'Drive belt', 'Wheel drive', 'Motocycles', 'TVS STAR', 'TVS STAR HLX 125', 'petrol', 'Single Cylinder, Four Stroke, Natural Air Cooled', '8430525016156', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 10, '8000', '0', '1632199000png', '2021-09-21 06:36:39'),
(32, 'head lights', 'Motorcycle lighting', 'Motocycles', 'TVS STAR', 'TVS STAR HLX 125', 'petrol', 'Single Cylinder, Four Stroke, Natural Air Cooled', '8430525072763', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 13, '32000', '0', '1632199645jpg', '2021-09-21 06:47:25'),
(33, 'Indicators', 'Motorcycle lighting', 'Motocycles', 'TVS STAR', 'TVS STAR HLX 125', 'petrol', 'Single Cylinder, Four Stroke, Natural Air Cooled', '8430525090491', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 12, '9000', '0', '1632199937png', '2021-09-21 06:52:17'),
(34, 'Bulb', 'Motorcycle lighting', 'Motocycles', 'TVS STAR', 'TVS STAR HLX 125', 'petrol', 'Single Cylinder, Four Stroke, Natural Air Cooled', '4050300137193', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 10, '3000', '0', '1632200294jpg', '2021-09-21 06:58:13'),
(35, 'condensor ', 'Air conditioning', 'Trucks', 'scania', 'scania 4 series', 'diesel', '114 C/330', '815128', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 10, '300000', '0', '1632201549png', '2021-09-21 07:19:08'),
(36, 'interior blower', 'Air conditioning', 'Trucks', 'scania', 'scania 4 series', 'diesel', '114 C/330', 'A 000 783 00 40', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 3, '42000', '0', '1632201867jpg', '2021-09-21 07:24:26'),
(37, 'truck compressor', 'Air conditioning', 'Trucks', 'scania', 'scania 4 series', 'diesel', '114 C/330', 'QP7H15-8068', '<div><div>belt pully</div><div>132</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,<div><div>condition </div><div>new</div></div>,<div><div>weight(kg)</div><div>7.8</div></div>,', 12, '250000', '0', '1632202167jpg', '2021-09-21 07:29:27'),
(39, 'bolt', 'Body parts', 'Cars', 'Toyota', 'corolla', 'petrol', 'corolla XII Hatchback(E210)(10/2018)', '44540-02067', NULL, 16, '25', '0', '1632981536jpg', '2021-09-30 07:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `spare_part_categories`
--

DROP TABLE IF EXISTS `spare_part_categories`;
CREATE TABLE IF NOT EXISTS `spare_part_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `engine_type` varchar(100) NOT NULL,
  `fuel` varchar(111) NOT NULL,
  `vehicle_model` varchar(111) NOT NULL,
  `vehicle_mark` varchar(111) NOT NULL,
  `vehicle_category` varchar(111) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spare_part_categories`
--

INSERT INTO `spare_part_categories` (`id`, `name`, `engine_type`, `fuel`, `vehicle_model`, `vehicle_mark`, `vehicle_category`, `image`) VALUES
(5, 'Tyres', 'corolla XII Hatchback(E210)(10/2018)', 'petrol', 'corolla', 'Toyota', 'Cars', '1632153079jpg'),
(6, 'Brake system', 'corolla XII Hatchback(E210)(10/2018)', 'petrol', 'corolla', 'Toyota', 'Cars', '1632153480jpg'),
(7, 'Ignition system', 'corolla XII Hatchback(E210)(10/2018)', 'petrol', 'corolla', 'Toyota', 'Cars', '1632153702jpg'),
(8, 'Engine', 'corolla XII Hatchback(E210)(10/2018)', 'petrol', 'corolla', 'Toyota', 'Cars', '1632153815jpg'),
(9, 'suspension and arms', 'corolla XII Hatchback(E210)(10/2018)', 'petrol', 'corolla', 'Toyota', 'Cars', '1632154049jpg'),
(10, 'Electronics', 'corolla XII Hatchback(E210)(10/2018)', 'petrol', 'corolla', 'Toyota', 'Cars', '1632166673jpg'),
(11, 'Body parts', 'corolla XII Hatchback(E210)(10/2018)', 'petrol', 'corolla', 'Toyota', 'Cars', '1632168283jpg'),
(12, 'Oil and fluids', 'corolla XII Hatchback(E210)(10/2018)', 'petrol', 'corolla', 'Toyota', 'Cars', '1632170604jpg'),
(13, 'Wheel drive', 'Single Cylinder, Four Stroke, Natural Air Cooled', 'petrol', 'TVS STAR HLX 125', 'TVS STAR', 'Motocycles', '1632197629png'),
(14, 'Motorcycle lighting', 'Single Cylinder, Four Stroke, Natural Air Cooled', 'petrol', 'TVS STAR HLX 125', 'TVS STAR', 'Motocycles', '1632199494jpg'),
(15, 'Air conditioning', '114 C/330', 'diesel', 'scania 4 series', 'scania', 'Trucks', '1632201381jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'CLIENT',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `username`, `password`, `type`) VALUES
(36, 'admin', 'Ben', 'admin@gamail.com', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'ADMIN'),
(41, 'NABIMANYA', 'Benson', 'nabimanyabenson2@gmail.com', 'benson', '827ccb0eea8a706c4c34a16891f84e7b', 'CLIENT'),
(42, 'byiringiro', 'raban', 'byiringiroraban52@gmail.com', 'raban', '827ccb0eea8a706c4c34a16891f84e7b', 'CLIENT'),
(43, 'Kubwimana', 'Theophile', 'theophile@gmail.com', 'theo2020', '81dc9bdb52d04dc20036dbd8313ed055', 'CLIENT');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_categories`
--

DROP TABLE IF EXISTS `vehicle_categories`;
CREATE TABLE IF NOT EXISTS `vehicle_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_categories`
--

INSERT INTO `vehicle_categories` (`id`, `name`, `image`, `status`, `date`) VALUES
(4, 'Cars', '1631941491jpg', '1', '2021-09-18 07:04:51'),
(5, 'Trucks', '1632151351jpg', '1', '2021-09-20 17:22:31'),
(6, 'Motocycles', '1632151520jpg', '1', '2021-09-20 17:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_marks`
--

DROP TABLE IF EXISTS `vehicle_marks`;
CREATE TABLE IF NOT EXISTS `vehicle_marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `vehicle_category` varchar(100) NOT NULL,
  `logo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_marks`
--

INSERT INTO `vehicle_marks` (`id`, `name`, `vehicle_category`, `logo`) VALUES
(12, 'Toyota', 'Cars', '1632151858jpg'),
(14, 'TVS STAR', 'Motocycles', '1632197360jpg'),
(15, 'scania', 'Trucks', '1632201026jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model`
--

DROP TABLE IF EXISTS `vehicle_model`;
CREATE TABLE IF NOT EXISTS `vehicle_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `vehicle_mark` varchar(100) NOT NULL,
  `vehicle_category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_model`
--

INSERT INTO `vehicle_model` (`id`, `name`, `vehicle_mark`, `vehicle_category`) VALUES
(6, 'Cammry', 'Toyota', 'Cars'),
(8, 'corolla', 'Toyota', 'Cars'),
(9, 'TVS STAR HLX 125', 'TVS STAR', 'Motocycles'),
(10, 'scania 4 series', 'scania', 'Trucks');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
