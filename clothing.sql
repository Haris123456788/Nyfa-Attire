-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 03, 2024 at 09:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `subtitle`, `description`, `image`) VALUES
(1, 'About Us', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, ipsamm.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatemmm fuga blanditiis, modi exercitationem quae quam eveniet! Minus labore voluptatibus corporis recusandae accusantium velit, nemo, nobis, nulla ullam pariatur totam quos.', 'about_us.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `button_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `subtitle`, `button_text`) VALUES
(22, 'best collection', 'new arrivals', 'shop now'),
(23, 'best price & offer', 'new season', 'buy now');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` enum('best','feat','new') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `rating` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `name`, `category`, `price`, `rating`, `label`, `image`) VALUES
(1, 'gray shirt', 'best', 45.50, 5, 'sale', 'c_formal_gray_shirt.png'),
(2, 'gray shirt', 'best', 45.50, 5, 'sale', 'c_pant_girl.png'),
(3, 'gray shirt', 'best', 45.50, 5, '', 'c_polo-shirt.png'),
(4, 'gray shirt', 'feat', 45.50, 5, 'sale', 'c_shirt-girl.png'),
(7, 'gray shirt\r\n\r\n', 'new', 45.50, 5, 'sale', 'c_undershirt.png'),
(8, 'gray shirt', 'new', 45.50, 5, 'sale', 'c_western-shirt.png'),
(9, 'gray shirt', 'best', 45.50, 5, 'sale', 'c_undershirt.png');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`) VALUES
(2, 'nyfaattire@gmail.com', '$2y$10$bXxvpbmiPGyf6XhbRMRq9OplqwKqO14lFTCNIbMn1u.f1oZ.9PN3W');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscriptions`
--

CREATE TABLE `newsletter_subscriptions` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter_subscriptions`
--

INSERT INTO `newsletter_subscriptions` (`id`, `email`) VALUES
(10, 'waseem123@gmail.com'),
(11, 'hariswaseem334@gmail.com'),
(12, 'waseemharis123@gmail.com'),
(13, 'info@cubemarketingagency.com'),
(14, 'demo@gmail.com'),
(15, 'nyfaattire@gmail.com'),
(16, 'demo223@gmail.com'),
(17, 'waseem1233@gmail.com'),
(18, 'demo123@gmail.com'),
(19, 'demoo@gmail.com'),
(20, 'waseem12332@gmail.com'),
(21, 'info@cubemarketingagency.comm'),
(22, 'wasee'),
(23, 'demo@gmail.co'),
(24, 'demo@gmaill.com'),
(25, 'demooo@gmail.com'),
(26, 'info@cubemarketingagenncy.com');

-- --------------------------------------------------------

--
-- Table structure for table `special_products`
--

CREATE TABLE `special_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `special_products`
--

INSERT INTO `special_products` (`id`, `name`, `price`, `image`) VALUES
(1, 'gray shirt', 45.50, 'special_product_1.jpg'),
(2, 'gray shirt', 45.50, 'special_product_2.jpg'),
(3, 'gray shirt', 45.50, 'special_product_3.jpg'),
(4, 'gray shirt', 45.50, 'special_product_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `top_rated`
--

CREATE TABLE `top_rated` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `top_rated`
--

INSERT INTO `top_rated` (`id`, `name`, `price`, `image`) VALUES
(1, 'gray shirt', 45.50, 'special_product_1.jpg'),
(2, 'gray shirt', 45.50, 'special_product_2.jpg'),
(3, 'gray shirt', 45.50, 'special_product_3.jpg'),
(4, 'gray shirt', 45.50, 'special_product_4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscriptions`
--
ALTER TABLE `newsletter_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_products`
--
ALTER TABLE `special_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_rated`
--
ALTER TABLE `top_rated`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newsletter_subscriptions`
--
ALTER TABLE `newsletter_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `special_products`
--
ALTER TABLE `special_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `top_rated`
--
ALTER TABLE `top_rated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
