-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 10:37 AM
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
-- Database: `products_cataloge`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` decimal(20,0) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `description`, `price`, `category`) VALUES
(66, 'iphone 14', '1702971095_5cec5d_66c1a30a936d4ab4b53f6bfda4ba782b~mv2.webp', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 1000, 'mobiles'),
(67, 'Wireless Earbuds', '1702850064_57501999-3-pdpxl.jpeg', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 100, 'accessories'),
(68, 'iphone', '1702850107_5cec5d_66c1a30a936d4ab4b53f6bfda4ba782b~mv2.webp', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 600, 'mobiles'),
(69, 'iphone', '1702850136_5cec5d_66c1a30a936d4ab4b53f6bfda4ba782b~mv2.webp', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 100, 'mobiles'),
(70, 'iphone', '1702850293_5cec5d_66c1a30a936d4ab4b53f6bfda4ba782b~mv2.webp', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 2000, 'mobiles'),
(71, 'Wireless Earbuds', '1702850324_57501999-3-pdpxl.jpeg', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 40, 'accessories'),
(81, 'iphone', '1702850576_5cec5d_66c1a30a936d4ab4b53f6bfda4ba782b~mv2.webp', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 700, 'mobiles'),
(99, 'iphone', '1702902545_5cec5d_f3d00da27ff74515bb1bd810a64ba5ac~mv2.webp', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 2000, 'mobiles'),
(100, 'iphone', '1702902569_5cec5d_f3d00da27ff74515bb1bd810a64ba5ac~mv2.webp', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 888, 'mobiles'),
(101, 'iphone', '1702935773_5cec5d_66c1a30a936d4ab4b53f6bfda4ba782b~mv2.webp', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 23, 'accessories'),
(103, 'iphone ', '1702924827_5cec5d_f3d00da27ff74515bb1bd810a64ba5ac~mv2.webp', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 222, 'mobiles');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
