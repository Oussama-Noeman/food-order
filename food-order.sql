-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 06:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl-admin`
--

CREATE TABLE `tbl-admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl-admin`
--

INSERT INTO `tbl-admin` (`id`, `fullname`, `username`, `password`) VALUES
(23, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl-category`
--

CREATE TABLE `tbl-category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `img-name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl-category`
--

INSERT INTO `tbl-category` (`id`, `title`, `img-name`, `featured`, `active`) VALUES
(14, 'Pizza', 'Food_Category_111.jpg', 'Yes', 'Yes'),
(15, 'Burger', 'Food_Category_151.jpg', 'Yes', 'Yes'),
(16, 'spaghetti', 'Food_Category_829.jpg', 'No', 'Yes'),
(17, 'chicken', 'Food_Category_333.jpg', 'Yes', 'Yes'),
(19, 'MOMO', 'Food_Category_738.jpg', 'Yes', 'Yes'),
(20, 'Frise', '', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl-food`
--

CREATE TABLE `tbl-food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `img-name` varchar(255) NOT NULL,
  `category-id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl-food`
--

INSERT INTO `tbl-food` (`id`, `title`, `description`, `price`, `img-name`, `category-id`, `featured`, `active`) VALUES
(8, 'classic pizza', 'I am a classic Pizza edited', '8', 'Food-Name855.jpg', 8, 'No', 'Yes'),
(10, 'classic spaghetti', 'I am a spaghetti edited\r\n', '10', 'Food-Image786.jpg', 16, 'Yes', 'Yes'),
(11, 'peperoni pizza', 'I am peperoni pizza ', '15', 'Food-Image147.jpg', 14, 'Yes', 'Yes'),
(12, 'italian pizza', 'I am italian pizza', '12', 'Food-Image307.jpg', 14, 'Yes', 'Yes'),
(13, 'big mac', 'I am the big mac burger', '8', 'Food-Image116.jpg', 15, 'Yes', 'Yes'),
(14, 'double cheese', 'I am double cheese burger', '16', 'Food-Image567.jpg', 15, 'No', 'Yes'),
(15, 'man2ouche', 'ana man2ouchet za3tar edited', '20', 'Food-Image839.jpg', 14, 'Yes', 'Yes'),
(17, 'cheese burger', 'I am cheese burger', '23', 'Food-Name535.jpg', 15, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl-order`
--

CREATE TABLE `tbl-order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `order-date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer-name` varchar(150) NOT NULL,
  `customer-contact` varchar(20) NOT NULL,
  `customer-email` varchar(150) NOT NULL,
  `customer-address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl-order`
--

INSERT INTO `tbl-order` (`id`, `food`, `price`, `qty`, `total`, `order-date`, `status`, `customer-name`, `customer-contact`, `customer-email`, `customer-address`) VALUES
(1, 'classic pizza', '8', 3, '24', '2022-12-14', 'Delivred', 'Oussama Noeman', '76535285', 'oussama@gmail.com', 'Tipoli-Biddawi'),
(2, 'cheese burger', '23', 3, '69', '2022-12-14', 'Canceled', 'mahmoud attal', '76535285', 'mahmoud@gmail.com', 'Tipoli-Biddawi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl-admin`
--
ALTER TABLE `tbl-admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl-category`
--
ALTER TABLE `tbl-category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl-food`
--
ALTER TABLE `tbl-food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl-order`
--
ALTER TABLE `tbl-order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl-admin`
--
ALTER TABLE `tbl-admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl-category`
--
ALTER TABLE `tbl-category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl-food`
--
ALTER TABLE `tbl-food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl-order`
--
ALTER TABLE `tbl-order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
