-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 09, 2022 at 12:15 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swiftshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`ID`, `brand`, `icon`) VALUES
(1, 'Supreme', 'supreme.png'),
(2, 'Gucci', 'gucci.png'),
(3, 'Balenciaga', 'balenciaga.png'),
(4, 'Nike', 'nike.png'),
(5, 'DC', 'dc.png'),
(6, 'Champion', 'Champion.PNG'),
(7, 'Fendi', 'fendi.png'),
(8, 'Vercase', 'versace.png'),
(9, 'Lous Vuiton', 'louisvuitton.png'),
(10, 'V-Lone', 'vlone.png'),
(11, 'Burberry', 'burberry.png'),
(12, 'Fila', 'fila.png'),
(13, 'Tommy Hilfiger', 'tommy.png'),
(14, 'Levi\'s', 'levi.png'),
(15, 'Prada', 'prada.png'),
(16, 'Lacoste', 'lacoste.png'),
(17, 'Adidas', 'adidas.PNG'),
(19, 'Dior', 'christian.png'),
(20, 'Timberland', 'timberland.png'),
(21, 'Puma', 'puma.png'),
(22, 'Dolce', 'dolce.png'),
(23, 'Converse', 'converse.png'),
(24, 'Chanel', 'chanel.png'),
(25, 'Ellesse', 'ellesse.png'),
(27, 'Vans', 'vans.PNG'),
(28, 'Hugo Boss', 'hugo.png'),
(29, 'Jordan', 'jordan.png'),
(30, 'Under-armour', 'underarmour.png'),
(31, 'Polo', 'polo.png'),
(32, 'Bathing-Ape', 'bathingape.png'),
(33, 'Reebok', 'reebok.png'),
(34, 'Palace', 'palace.png'),
(35, 'Off-White', 'offwhite.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `product_photo` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY (`cart_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=488 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_ID`, `product_ID`, `user_ID`, `product_photo`, `product_name`, `product_size`, `quantity`, `price`, `total_price`, `user_name`) VALUES
(483, 68, 13, '1611581933_filagreen.jpg', 'Fila Sneakers', '42', 1, '2500', '2500', 'Ronald'),
(484, 52, 55, '1609522630_IMG-20200704-WA0066.jpg', 'Nike Short', 'L', 2, '950', '1900', 'Maya'),
(486, 83, 13, '1614848670_c91fdfb9711747c892046ad0f4eb5b37.jpg', 'Yeezy slides', '30', 1, '2500', '2500', 'Ronald'),
(487, 50, 13, '1609509451_IMG-20200319-WA0016.jpg', 'Jordan 4', '43', 2, '4000', '8000', 'Ronald');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Category_title` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Category_title`) VALUES
(1, 'Hoodies'),
(3, 'Kicks'),
(5, 'Shirts & T-shirts'),
(6, 'Accessories'),
(9, 'Durags'),
(10, 'Hats'),
(11, 'Shorts & Pants'),
(23, 'Bomber Jackets'),
(24, 'Jeans'),
(25, 'Denims'),
(26, 'Crop tops'),
(32, 'Paintings, Drawings & Arts');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

DROP TABLE IF EXISTS `collection`;
CREATE TABLE IF NOT EXISTS `collection` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `collection_title` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`ID`, `collection_title`) VALUES
(9, 'Kids'),
(10, 'Men'),
(11, 'Women'),
(12, 'Teens');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `feature_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `brand_ID` int(11) NOT NULL,
  `collection_ID` int(11) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Last_Price` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `product_condition` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `Sizes` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  PRIMARY KEY (`feature_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`feature_ID`, `product_ID`, `Title`, `category_ID`, `brand_ID`, `collection_ID`, `Price`, `Last_Price`, `Description`, `Color`, `product_condition`, `product_quantity`, `Sizes`, `product_image`) VALUES
(1, 50, 'Jordan 4', 3, 4, 3, '4000', '4500', 'Super Trendy', 'White', 'Fresh from box', '3', '32;40;42', '1609509451_IMG-20200319-WA0016.jpg'),
(2, 47, 'Airforce 1', 3, 4, 3, '3500', '5000', 'Brand New                 ', 'Pink', 'Fresh from box', '11', '32;40;42', '1609056599_sbdunknx dior.jpg'),
(3, 54, 'Hoodie', 1, 26, 3, '2500', '3000', 'Brand New and trendish\\r\\nPerfect Gift for a teenager.', 'White', 'New', '13', 'L,XL,S', '1609523198_IMG-20200509-WA0055.jpg'),
(4, 59, 'Jeans', 11, 0, 3, '1500', '1900', 'Strong', 'Blue', 'New', '9', '32;40;42', '1609583347_IMG-20200605-WA0065.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotdeals`
--

DROP TABLE IF EXISTS `hotdeals`;
CREATE TABLE IF NOT EXISTS `hotdeals` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_ID` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `last_price` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotdeals`
--

INSERT INTO `hotdeals` (`ID`, `product_ID`, `product_name`, `product_price`, `last_price`, `product_image`) VALUES
(8, 82, 'YEEZYS', '3500', '4000', '1614848516_2c911305989449a08d4e82918a34e24d.jpg'),
(7, 83, 'Yeezy slides', '2500', '3000', '1614848670_c91fdfb9711747c892046ad0f4eb5b37.jpg'),
(9, 81, 'Dior Unkle Socks', '500', '600', '1614848352_8aa2cbe7803443838b5f6cf38d1cce03.jpg'),
(10, 52, 'Nike Short', '950', '1000', '1609522630_IMG-20200704-WA0066.jpg'),
(11, 50, 'Jordan 4', '4000', '4500', '1609509451_IMG-20200319-WA0016.jpg'),
(12, 70, 'official Shoes', '3000', '4000', '1611582233_IMG-20200603-WA0169.jpg'),
(13, 57, 'Hoodie', '2000', '3000', '1609582885_vanshoodie.jpg'),
(14, 56, 'Tee', '1000', '2000', '1609523560_vlonetee1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `newarrivals`
--

DROP TABLE IF EXISTS `newarrivals`;
CREATE TABLE IF NOT EXISTS `newarrivals` (
  `newarrival_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Product_ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `brand_ID` int(11) NOT NULL,
  `collection_ID` int(11) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Last_Price` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `product_condition` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `Sizes` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  PRIMARY KEY (`newarrival_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newarrivals`
--

INSERT INTO `newarrivals` (`newarrival_ID`, `Product_ID`, `Title`, `category_ID`, `brand_ID`, `collection_ID`, `Price`, `Last_Price`, `Description`, `Color`, `product_condition`, `product_quantity`, `Sizes`, `product_image`) VALUES
(9, 50, 'Jordan 4', 3, 4, 3, '4000', '4500', 'Super Trendy', 'White', 'Fresh from box', '4', '32;40;42', '1609509451_IMG-20200319-WA0016.jpg'),
(10, 70, 'official Shoes', 3, 0, 1, '3000', '4000', 'New', 'Black', 'New', '4', '32;40;42', '1611582233_IMG-20200603-WA0169.jpg'),
(11, 51, 'Fila Sneakers', 3, 12, 3, '3500', '4000', 'Brand New and trendish\\\\r\\\\nPerfect Gift for a teenager.', 'White', 'Fresh from box', '11', '32;40;42', '1609522179_IMG-20200204-WA0063.jpg'),
(12, 66, 'Balenciaga', 3, 3, 3, '3500', '4000', 'New', 'Black and Yellow', 'Fresh from box', '7', '32;40;42', '1611581661_balenciaga1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `newregisteredusers`
--

DROP TABLE IF EXISTS `newregisteredusers`;
CREATE TABLE IF NOT EXISTS `newregisteredusers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `County` varchar(255) NOT NULL,
  `validation_code` varchar(255) NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '0',
  `IPAddress` varchar(255) NOT NULL,
  `Last_Login` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newregisteredusers`
--

INSERT INTO `newregisteredusers` (`ID`, `Email`, `Username`, `user_photo`, `Password`, `Gender`, `County`, `validation_code`, `Active`, `IPAddress`, `Last_Login`, `phone_number`) VALUES
(13, 'matekwaronald@gmail.com', 'Ronald', '1621184059_IMG_0501.jpg', '4e7dcc47bf6c8720f4f4048d4fe5c121', 'Male', 'Naivasha', '0', 1, '1', '2022-01-19 09:28:56', '0745481760'),
(55, 'maya@gmail.com', 'Maya', 'placeholder.JPG', 'b2693d9c2124f3ca9547b897794ac6a1', 'Female', 'Kwale', '0', 1, '1', '2021-08-17 15:11:02', '0713490657');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_emails`
--

DROP TABLE IF EXISTS `newsletter_emails`;
CREATE TABLE IF NOT EXISTS `newsletter_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emails` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletter_emails`
--

INSERT INTO `newsletter_emails` (`id`, `emails`) VALUES
(3, 'mate@gmail.com'),
(4, 'matekwaronald@gnail.com'),
(5, 'matekwaronald@gmail.com'),
(6, 'matekwaro@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_title` varchar(255) NOT NULL,
  `message_desc` varchar(255) NOT NULL,
  `message_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`message_id`, `message_title`, `message_desc`, `message_status`) VALUES
(1, 'Order', 'Your order is delivered', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `product_photo` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount_to_pay` varchar(255) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '1',
  `product_review` int(11) NOT NULL DEFAULT '0',
  `order_time` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `order_number`, `user_id`, `product_name`, `seller`, `product_photo`, `qty`, `product_id`, `user_name`, `email`, `phone`, `delivery_address`, `payment_method`, `amount_to_pay`, `order_date`, `order_status`, `product_review`, `order_time`, `tax`, `product_size`) VALUES
(142, 664763, 13, 'Jordan 4', 'Royal Classic', '1609509451_IMG-20200319-WA0016.jpg', 2, 50, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Embu,,', 'M-PESA', '13052', 'Wednesday, September, 15, 2021', 1, 0, '03:59:28pm', '52', '43'),
(141, 664763, 13, 'Yeezy slides', 'Swiftshop', '1614848670_c91fdfb9711747c892046ad0f4eb5b37.jpg', 1, 83, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Embu,,', 'M-PESA', '13052', 'Wednesday, September, 15, 2021', 1, 0, '03:59:28pm', '52', '30'),
(136, 288983, 13, 'Jordan 4', 'Royal Classic', '1609509451_IMG-20200319-WA0016.jpg', 2, 50, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Mandera,898080,', 'M-PESA', '13052', 'Wednesday, September, 15, 2021', 1, 0, '03:55:16pm', '52', '43'),
(129, 192829, 55, 'Fila Sneakers', 'Swiffshop Store', '1611581933_filagreen.jpg', 1, 68, 'Maya', 'maya@gmail.com', '0713490657', 'Isiolo,,Around Town', 'M-PESA', '2513', 'Friday, August, 13, 2021', 4, 1, '12:32:19pm', '13', '42'),
(127, 130209, 13, 'Dior ankle Socks', 'Swifftshop store', '1614848352_8aa2cbe7803443838b5f6cf38d1cce03.jpg', 1, 81, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Marsabit,,', 'M-PESA', '30169', 'Thursday, August, 12, 2021', 4, 1, '12:19:41pm', '169', ''),
(140, 664763, 13, 'Fila Sneakers', 'Swiffshop Store', '1611581933_filagreen.jpg', 1, 68, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Embu,,', 'M-PESA', '13052', 'Wednesday, September, 15, 2021', 1, 0, '03:59:28pm', '52', '42'),
(126, 130209, 13, 'Hoodie', 'LuckDawg', '1609523198_IMG-20200509-WA0055.jpg', 10, 54, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Marsabit,,', 'M-PESA', '30169', 'Thursday, August, 12, 2021', 4, 1, '12:19:41pm', '169', ''),
(131, 177370, 55, 'Nike Short', 'Sledge', '1609522630_IMG-20200704-WA0066.jpg', 2, 52, 'Maya', 'maya@gmail.com', '0713490657', 'Kwale,Kisumu,', 'M-PESA', '1926', 'Tuesday, August, 17, 2021', 1, 0, '04:35:05pm', '26', 'L'),
(118, 238195, 13, 'Jeans', 'LuckDawg', '1609583347_IMG-20200605-WA0065.jpg', 1, 59, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Isiolo,,', 'M-PESA', '4539', 'Monday, August, 9, 2021', 4, 1, '04:44:53pm', '39', ''),
(139, 926430, 13, 'Jordan 4', 'Royal Classic', '1609509451_IMG-20200319-WA0016.jpg', 2, 50, 'Ronald', 'matekwaronald@gmail.com', '07134906578', 'Kitui,,', 'M-PESA', '13052', 'Wednesday, September, 15, 2021', 1, 0, '03:58:00pm', '52', '43'),
(138, 926430, 13, 'Yeezy slides', 'Swiftshop', '1614848670_c91fdfb9711747c892046ad0f4eb5b37.jpg', 1, 83, 'Ronald', 'matekwaronald@gmail.com', '07134906578', 'Kitui,,', 'M-PESA', '13052', 'Wednesday, September, 15, 2021', 1, 0, '03:58:00pm', '52', '30'),
(137, 926430, 13, 'Fila Sneakers', 'Swiffshop Store', '1611581933_filagreen.jpg', 1, 68, 'Ronald', 'matekwaronald@gmail.com', '07134906578', 'Kitui,,', 'M-PESA', '13052', 'Wednesday, September, 15, 2021', 1, 0, '03:58:00pm', '52', '42'),
(135, 288983, 13, 'Yeezy slides', 'Swiftshop', '1614848670_c91fdfb9711747c892046ad0f4eb5b37.jpg', 1, 83, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Mandera,898080,', 'M-PESA', '13052', 'Wednesday, September, 15, 2021', 1, 0, '03:55:16pm', '52', '30'),
(124, 177896, 13, 'Shades', 'Bulls', '1609523407_IMG-20200523-WA0034.jpg', 1, 55, 'Ronald', 'matekwaronald@gmail.com', '0713490675', 'Kitui,,', 'M-PESA', '7552', 'Monday, August, 9, 2021', 4, 1, '11:45:07pm', '52', ''),
(132, 350810, 13, 'Fila Sneakers', 'Swiffshop Store', '1611581933_filagreen.jpg', 2, 68, 'Ronald', 'matekwaronald@gmail.com', '0735555548', 'Meru,70300,', 'M-PESA', '9039', 'Wednesday, September, 15, 2021', 1, 0, '02:56:32pm', '39', '42'),
(133, 350810, 13, 'Jordan 4', 'Royal Classic', '1609509451_IMG-20200319-WA0016.jpg', 1, 50, 'Ronald', 'matekwaronald@gmail.com', '0735555548', 'Meru,70300,', 'M-PESA', '9039', 'Wednesday, September, 15, 2021', 1, 0, '02:56:32pm', '39', '40'),
(134, 288983, 13, 'Fila Sneakers', 'Swiffshop Store', '1611581933_filagreen.jpg', 1, 68, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Mandera,898080,', 'M-PESA', '13052', 'Wednesday, September, 15, 2021', 1, 0, '03:55:16pm', '52', '42'),
(143, 49206, 13, 'Fila Sneakers', 'Swiffshop Store', '1611581933_filagreen.jpg', 1, 68, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Tharaka-Nithi,,', 'M-PESA', '13052', 'Wednesday, September, 29, 2021', 1, 0, '03:27:32pm', '52', '42'),
(144, 49206, 13, 'Yeezy slides', 'Swiftshop', '1614848670_c91fdfb9711747c892046ad0f4eb5b37.jpg', 1, 83, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Tharaka-Nithi,,', 'M-PESA', '13052', 'Wednesday, September, 29, 2021', 1, 0, '03:27:32pm', '52', '30'),
(145, 49206, 13, 'Jordan 4', 'Royal Classic', '1609509451_IMG-20200319-WA0016.jpg', 2, 50, 'Ronald', 'matekwaronald@gmail.com', '0713490657', 'Tharaka-Nithi,,', 'M-PESA', '13052', 'Wednesday, September, 29, 2021', 1, 0, '03:27:32pm', '52', '43');

-- --------------------------------------------------------

--
-- Table structure for table `partnered_products`
--

DROP TABLE IF EXISTS `partnered_products`;
CREATE TABLE IF NOT EXISTS `partnered_products` (
  `partnered_product_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `brand_ID` int(11) NOT NULL,
  `collection_ID` int(11) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Last_Price` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `product_condition` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `Sizes` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  PRIMARY KEY (`partnered_product_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partnered_products`
--

INSERT INTO `partnered_products` (`partnered_product_ID`, `product_ID`, `Title`, `category_ID`, `brand_ID`, `collection_ID`, `Price`, `Last_Price`, `Description`, `color`, `product_condition`, `product_quantity`, `Sizes`, `product_image`) VALUES
(1, 50, 'Jordan 4', 3, 4, 3, '4000', '4500', 'Super Trendy', 'White', 'Fresh from box', 3, '32;40;42', '1609509451_IMG-20200319-WA0016.jpg'),
(2, 56, 'Tee', 5, 10, 3, '1000', '2000', 'Brand New and trendish\\r\\nPerfect Gift for a teenager.', 'Black', 'New', 12, 'L,XL,S', '1609523560_vlonetee1.jpg'),
(3, 55, 'Shades', 6, 0, 3, '3000', '3500', 'Brand New and trendish\\r\\nPerfect Gift for a teenager.', 'Black', 'New', 14, '', '1609523407_IMG-20200523-WA0034.jpg'),
(4, 60, 'Vans', 3, 8, 3, '2800', '3000', 'New', 'dark blue', 'Fresh from box', 5, '32;40;42', '1609583532_IMG-20200617-WA0083.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `brand_ID` int(11) NOT NULL,
  `collection_ID` int(11) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Last_Price` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `Product_condition` varchar(255) NOT NULL,
  `Product_quantity` int(11) NOT NULL,
  `Sizes` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `sub_image_1` varchar(255) NOT NULL,
  `sub_image_2` varchar(255) NOT NULL,
  `sub_image_3` varchar(255) NOT NULL,
  `seller` varchar(255) NOT NULL,
  `quant_sold` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Title`, `category_ID`, `brand_ID`, `collection_ID`, `Price`, `Last_Price`, `Description`, `Color`, `Product_condition`, `Product_quantity`, `Sizes`, `product_image`, `sub_image_1`, `sub_image_2`, `sub_image_3`, `seller`, `quant_sold`) VALUES
(47, 'Airforce 1', 3, 4, 3, '3500', '5000', 'Brand New                 ', 'Pink', 'Fresh from box', 11, '23,56,78,87', '1609056599_sbdunknx dior.jpg', '', '', '', 'RollliRolli', '4'),
(50, 'Jordan 4', 3, 4, 3, '4000', '4500', 'Super Trendy', 'White', 'Fresh from box', 4, '32;40;42', '1609509451_IMG-20200319-WA0016.jpg', '', '', '', 'Royal Classic', '4'),
(51, 'Fila Sneakers', 3, 12, 3, '3500', '4000', 'Brand New and trendish\\\\r\\\\nPerfect Gift for a teenager.', 'White', 'Fresh from box', 11, '32;40;42', '1609522179_IMG-20200204-WA0063.jpg', '', '', '', 'LuckDawg', '8'),
(52, 'Nike Short', 11, 4, 3, '950', '1000', 'Brand New and trendish\\\\\\\\r\\\\\\\\nPerfect Gift for a teenager.', 'White', 'New', 2, 'L,XL', '1609522630_IMG-20200704-WA0066.jpg', '', '', '', 'Sledge', '9'),
(54, 'Hoodie', 1, 26, 3, '2500', '3000', 'Brand New and trendish\\r\\nPerfect Gift for a teenager.', 'White', 'New', 13, 'L,XL,S', '1609523198_IMG-20200509-WA0055.jpg', '', '', '', 'LuckDawg', '34'),
(55, 'Shades', 6, 0, 3, '3000', '3500', 'Brand New and trendish\\\\\\\\r\\\\\\\\nPerfect Gift for a teenager.', 'Black', 'New', 14, '', '1609523407_IMG-20200523-WA0034.jpg', '', '', '', 'Bulls', '3'),
(56, 'Tee', 5, 10, 3, '1000', '2000', 'Brand New and trendish\\\\r\\\\nPerfect Gift for a teenager.', 'Black', 'New', 12, 'L,XL,S', '1609523560_vlonetee1.jpg', '', '', '', 'Sledge', '2'),
(57, 'Hoodie', 1, 27, 3, '2000', '3000', 'Brand New', 'White', 'New', 10, 'L,XL,S', '1609582885_vanshoodie.jpg', '', '', '', 'Bulls', '0'),
(59, 'Jeans', 11, 0, 3, '1500', '1900', 'Strong', 'Blue', 'New', 3, '32;40;42', '1609583347_IMG-20200605-WA0065.jpg', '', '', '', 'LuckDawg', '0'),
(66, 'Balenciaga', 3, 3, 3, '3500', '4000', 'New', 'Black and Yellow', 'Fresh from box', 7, '32;40;42', '1611581661_balenciaga1.jpg', '', '', '', 'Swiffshop Store', '24'),
(67, 'Airforce 1 x New York', 3, 4, 3, '2500', '3500', 'Trending', 'Black', 'Fresh from box', 9, '32;40;42', '1611581747_airforce1xnewyork.jpg', '', '', '', 'Swiffshop Store', '24'),
(68, 'Fila Sneakers', 3, 12, 3, '2500', '3000', 'Awsome Shoes', 'Green', 'Fresh from box', 11, '32;40;42', '1611581933_filagreen.jpg', '', '', '', 'Swiffshop Store', '24'),
(69, 'Fila Sneakers', 3, 12, 3, '2500', '3000', 'Awesome product', 'Pink', 'Fresh from box', 33, '32;40;42', '1611582049_filayellow.jpg', '', '', '', 'Swiffshop Store', '24'),
(70, 'official Shoes', 3, 0, 1, '3000', '4000', 'New', 'Black', 'New', 4, '32;40;42', '1611582233_IMG-20200603-WA0169.jpg', '', '', '', 'Swiffshop Store', '8'),
(71, 'Vans', 3, 27, 3, '2500', '3000', 'New', 'White', 'New', 10, '32;40;42', '1611582327_IMG-20200619-WA0000.jpg', '', '', '', 'Swiffshop Store', '34'),
(72, 'Air Jordans', 3, 20, 3, '4000', '4500', 'New', 'Purple', 'Fresh from box', 5, '32;40;42', '1611582776_IMG-20200204-WA0140.jpg', '', '', '', 'Swiffshop Store', '34'),
(73, 'Airmax 97', 3, 4, 3, '3500', '4000', 'New', 'White and yellow', 'Fresh from box', 12, '32;40;42', '1611582841_IMG-20191024-WA0015.jpg', '', '', '', 'Swiffshop Store', '23'),
(74, 'Nike Sneakers', 3, 4, 3, '2500', '3000', 'New', 'yellow and white', 'Fresh from box', 12, '32;40;42', '1611583044_IMG-20200204-WA0061.jpg', '', '', '', 'Swiffshop Store', '23'),
(75, 'Nike Sneakers', 3, 4, 3, '4500', '5000', 'New', 'Black and white', 'Fresh from box', 2, '32;40;42', '1611583171_IMG-20200616-WA0029.jpg', '', '', '', 'Swiffshop Store', '0'),
(81, 'Dior ankle Socks', 24, 19, 3, '500', '600', 'This is a unique product,strong durable and also trendish,you  can`t afford to miss it', 'White and Brown', 'New', 4, 'Stretchable', '1614848352_8aa2cbe7803443838b5f6cf38d1cce03.jpg', '', '', '', 'Swifftshop store', '0'),
(82, 'YEEZYS', 3, 17, 3, '3500', '4000', 'Awesome', 'Black', 'Fresh from the box', 5, '38,40,42', '1614848516_2c911305989449a08d4e82918a34e24d.jpg', '', '', '', 'swifftshop store', '0'),
(83, 'Yeezy slides', 3, 17, 3, '2500', '3000', 'Great', 'brown', 'New', 11, '42', '1614848670_c91fdfb9711747c892046ad0f4eb5b37.jpg', '', '', '', 'Swiftshop', '0');

-- --------------------------------------------------------

--
-- Table structure for table `product_rating`
--

DROP TABLE IF EXISTS `product_rating`;
CREATE TABLE IF NOT EXISTS `product_rating` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_message` varchar(255) NOT NULL,
  `date_reviewed` varchar(255) NOT NULL,
  `user_rate` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_rating`
--

INSERT INTO `product_rating` (`ID`, `product_id`, `user_id`, `user_name`, `user_message`, `date_reviewed`, `user_rate`) VALUES
(113, 59, 13, 'Ronald', 'Wondersul Product', 'Tuesday, August, 17, 2021', '5'),
(112, 54, 13, 'Ronald', 'Awsome', 'Tuesday, August, 17, 2021', '5'),
(111, 81, 13, 'Ronald', 'Great', 'Tuesday, August, 17, 2021', '5'),
(110, 68, 13, 'Ronald', 'Good', 'Tuesday, August, 17, 2021', '5'),
(114, 55, 13, 'Ronald', 'Its amazing', 'Tuesday, August, 17, 2021', '5'),
(115, 68, 55, 'Maya', 'Dopee!', 'Tuesday, August, 17, 2021', '5');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `report_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_ID` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `order_ID` int(11) NOT NULL,
  PRIMARY KEY (`report_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_ID`, `product_ID`, `product_title`, `product_price`, `product_quantity`, `order_ID`) VALUES
(24, 1, 'Balenciaga', 3500, 3, 34),
(25, 2, 'Supreme Hoodie', 2500, 1, 34),
(26, 1, 'Balenciaga', 3500, 3, 35),
(27, 2, 'Supreme Hoodie', 2500, 1, 35),
(28, 47, 'Airforce 1', 3500, 1, 41);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE IF NOT EXISTS `slides` (
  `slide_ID` int(11) NOT NULL AUTO_INCREMENT,
  `slide_title` varchar(255) NOT NULL,
  `slide_image` varchar(255) NOT NULL,
  PRIMARY KEY (`slide_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_ID`, `slide_title`, `slide_image`) VALUES
(38, 'a', '1628231917_banner1.png'),
(39, 'banner2', '1628977901_banner2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `shop_location` varchar(255) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `VAT_registered` text NOT NULL,
  `business_reg_no` varchar(255) NOT NULL,
  `supply_category` varchar(255) NOT NULL,
  `mpesa_reg_name` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `mpesa_phone_no` varchar(15) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trending_products`
--

DROP TABLE IF EXISTS `trending_products`;
CREATE TABLE IF NOT EXISTS `trending_products` (
  `trending_product_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `brand_ID` int(11) NOT NULL,
  `collection_ID` int(11) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Last_Price` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `product_condition` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `Sizes` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  PRIMARY KEY (`trending_product_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trending_products`
--

INSERT INTO `trending_products` (`trending_product_ID`, `product_ID`, `Title`, `category_ID`, `brand_ID`, `collection_ID`, `Price`, `Last_Price`, `Description`, `color`, `product_condition`, `product_quantity`, `Sizes`, `product_image`) VALUES
(1, 47, 'Airforce 1', 3, 4, 3, '3500', '5000', 'Brand New                 ', 'Pink', 'Fresh from box', 11, 'k', '1609056599_sbdunknx dior.jpg'),
(2, 51, 'Fila Sneakers', 3, 12, 3, '3500', '4000', 'Brand New and trendish\\r\\nPerfect Gift for a teenager.', 'White', 'Fresh from box', 11, 'k', '1609522179_IMG-20200204-WA0063.jpg'),
(3, 52, 'Nike Short', 11, 4, 3, '950', '1000', 'Brand New and trendish\\r\\nPerfect Gift for a teenager.', 'White', 'New', 2, 't', '1609522630_IMG-20200704-WA0066.jpg'),
(5, 81, 'Dior ankle Socks', 24, 19, 3, '500', '600', 'This is a unique product,strong durable and also trendish,you  can`t afford to miss it', 'White and Brown', 'New', 4, 'Stretchable', '1614848352_8aa2cbe7803443838b5f6cf38d1cce03.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `view_counter`
--

DROP TABLE IF EXISTS `view_counter`;
CREATE TABLE IF NOT EXISTS `view_counter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `visit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `view_counter`
--

INSERT INTO `view_counter` (`ID`, `ip_address`, `product_id`, `visit_date`) VALUES
(1, '54:54:54:54', 47, '2021-02-03 16:25:11'),
(2, '::1', 47, '2021-02-03 17:03:55'),
(3, '::1', 50, '2021-02-03 17:42:34'),
(4, '::1', 66, '2021-02-03 18:31:26'),
(5, '::1', 71, '2021-02-03 18:31:43'),
(6, '::1', 68, '2021-02-03 18:32:06'),
(7, '::1', 69, '2021-02-03 18:32:29'),
(8, '::2', 47, '2021-02-03 18:41:26'),
(9, '::3', 47, '2021-02-03 18:41:26'),
(10, '::1', 51, '2021-02-03 18:41:40'),
(11, '::1', 67, '2021-02-03 18:41:46'),
(12, '::1', 73, '2021-02-03 18:41:53'),
(13, '::1', 74, '2021-02-03 18:42:01'),
(14, '::1', 75, '2021-02-03 18:44:37'),
(15, '::1', 72, '2021-02-03 19:06:07'),
(16, '::1', 70, '2021-02-04 06:43:46'),
(17, '::1', 53, '2021-02-04 07:44:50'),
(18, '::1', 58, '2021-02-06 16:17:27'),
(19, '::1', 57, '2021-02-06 16:23:31'),
(20, '::1', 54, '2021-02-07 15:23:18'),
(21, '::1', 55, '2021-02-07 15:52:44'),
(22, '::1', 52, '2021-02-09 16:00:21'),
(23, '::1', 60, '2021-02-12 13:54:27'),
(24, '::1', 56, '2021-02-12 13:54:38'),
(25, '127.0.0.1', 59, '2021-02-24 07:46:12'),
(26, '127.0.0.1', 58, '2021-02-24 08:30:48'),
(27, '127.0.0.1', 51, '2021-02-24 15:25:27'),
(28, '127.0.0.1', 52, '2021-02-24 15:25:45'),
(29, '127.0.0.1', 55, '2021-02-24 16:05:17'),
(30, '::1', 59, '2021-02-27 07:12:23'),
(31, '::1', 81, '2021-03-04 08:59:38'),
(32, '::1', 82, '2021-03-04 09:02:17'),
(33, '::1', 83, '2021-03-04 12:05:25'),
(34, '::1', 8, '2021-03-08 06:24:24'),
(35, '::1', 7, '2021-03-08 06:27:51'),
(36, '::1', 9, '2021-03-08 06:27:57'),
(37, '::1', 0, '2021-04-14 19:28:04'),
(38, '::1', 84, '2021-04-20 18:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `wishlist_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY (`wishlist_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_ID`, `product_ID`, `user_id`, `product_name`, `user_name`) VALUES
(66, 58, 19, 'Cape', 'Brel'),
(71, 71, 14, 'Vans', 'Maya'),
(183, 82, 19, 'YEEZYS', 'Brel'),
(186, 47, 19, 'Airforce 1', 'Brel'),
(190, 59, 19, 'Jeans', 'Brel'),
(205, 60, 13, '', 'Ronald');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
