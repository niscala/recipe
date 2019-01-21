-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2019 at 02:12 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe`
--
CREATE DATABASE IF NOT EXISTS `recipe` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `recipe`;

-- --------------------------------------------------------

--
-- Table structure for table `list_category`
--

DROP TABLE IF EXISTS `list_category`;
CREATE TABLE `list_category` (
  `id` int(10) NOT NULL,
  `name_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_category`
--

INSERT INTO `list_category` (`id`, `name_category`) VALUES
(1, 'Appetizer'),
(2, 'Main Course'),
(3, 'Dessert'),
(4, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `list_ingredients`
--

DROP TABLE IF EXISTS `list_ingredients`;
CREATE TABLE `list_ingredients` (
  `id` int(10) NOT NULL,
  `name_ingredients` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_ingredients`
--

INSERT INTO `list_ingredients` (`id`, `name_ingredients`) VALUES
(1, 'Nasi'),
(2, 'Minyak Goreng'),
(3, 'Bawang Merah'),
(4, 'Bawang Putih'),
(5, 'Telor'),
(6, 'Tomat'),
(7, 'Daging Ayam'),
(8, 'Wortel'),
(9, 'Nangka'),
(10, 'Mie'),
(11, 'Garam'),
(12, 'Chocolate'),
(13, 'Butter'),
(14, 'Kacang Tanah'),
(15, 'Ikan Salmon');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE `recipes` (
  `id` int(10) NOT NULL,
  `name_recipe` varchar(50) NOT NULL,
  `id_category` int(10) NOT NULL,
  `images` varchar(100) NOT NULL,
  `code_num` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name_recipe`, `id_category`, `images`, `code_num`) VALUES
(1, 'Nasi Goreng', 2, '5c450c670e3df.png', '3134'),
(2, 'Mie Ayam', 2, '5c450d755b61b.png', '4630'),
(3, 'Gudeg', 2, '5c450da067e8a.png', '3915'),
(4, 'Layered Chocolate Pudding', 3, '5c451090075f4.png', '3863'),
(5, 'Easy Smoked Salmon', 1, '5c4510ca696ed.png', '8148'),
(6, 'Peanut Butter Cup', 3, '5c45110079263.png', '6329'),
(7, 'Cranberry and Brie Ritz Cracker', 1, '5c45113833d3e.png', '3613');

-- --------------------------------------------------------

--
-- Table structure for table `recipes_ingredients`
--

DROP TABLE IF EXISTS `recipes_ingredients`;
CREATE TABLE `recipes_ingredients` (
  `id` int(10) NOT NULL,
  `id_recipe` int(10) NOT NULL,
  `id_ingredients` int(10) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `code_num_ing` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes_ingredients`
--

INSERT INTO `recipes_ingredients` (`id`, `id_recipe`, `id_ingredients`, `amount`, `code_num_ing`) VALUES
(1, 1, 1, '1 Piring', '2400'),
(2, 1, 2, 'Secukupnya', '2400'),
(3, 1, 3, '2 Siung', '2400'),
(4, 2, 2, 'Secukupnya', '3811'),
(5, 3, 2, 'Secukupnya', '5335'),
(10, 7, 13, 'Secukupnya', '6245'),
(11, 7, 14, 'Secukupnya', '440'),
(12, 6, 12, 'Sesuai Selera', '9215'),
(13, 6, 14, 'Secukupnya', '2010'),
(14, 5, 15, '2 ekor', '2057'),
(15, 4, 12, 'Secukupnya', '4140'),
(16, 4, 13, 'Secukupnya', '3271'),
(17, 3, 9, '1 Buah', '6410'),
(18, 2, 10, '1 Kepal', '2460'),
(19, 2, 11, 'Secukupnya', '3102'),
(20, 2, 7, 'Sesuai selera', '5571');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_category`
--
ALTER TABLE `list_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_ingredients`
--
ALTER TABLE `list_ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UK_recipes_id_category` (`id_category`) USING BTREE;

--
-- Indexes for table `recipes_ingredients`
--
ALTER TABLE `recipes_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_recipes_ingredients_list_ingredients_id` (`id_ingredients`),
  ADD KEY `FK_recipes_ingredients_recipes_id` (`id_recipe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_category`
--
ALTER TABLE `list_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `list_ingredients`
--
ALTER TABLE `list_ingredients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipes_ingredients`
--
ALTER TABLE `recipes_ingredients`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `FK_recipes_list_category_id` FOREIGN KEY (`id_category`) REFERENCES `list_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipes_ingredients`
--
ALTER TABLE `recipes_ingredients`
  ADD CONSTRAINT `FK_recipes_ingredients_list_ingredients_id` FOREIGN KEY (`id_ingredients`) REFERENCES `list_ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_recipes_ingredients_recipes_id` FOREIGN KEY (`id_recipe`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
