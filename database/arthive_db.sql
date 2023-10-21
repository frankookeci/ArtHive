-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 26, 2023 at 11:31 AM
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
-- Database: `arthive_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist_artwork`
--

CREATE TABLE `artist_artwork` (
  `artistJoin_id` int(11) NOT NULL,
  `artworkJoin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist_artwork`
--

INSERT INTO `artist_artwork` (`artistJoin_id`, `artworkJoin_id`) VALUES
(1, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `artist_table`
--

CREATE TABLE `artist_table` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `artist_email` varchar(255) NOT NULL,
  `artist_password` varchar(255) NOT NULL,
  `artist_bio` varchar(255) NOT NULL,
  `artist_profilepic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist_table`
--

INSERT INTO `artist_table` (`artist_id`, `artist_name`, `artist_email`, `artist_password`, `artist_bio`, `artist_profilepic`) VALUES
(1, 'igli', 'igli@gmail.com', '$2y$10$bmFmEfVWEEsGl9cvkYwgU.NBq3lyoujeXZDEeNyCBEiywM6Dv1DW.', 'hi im super smart', '647c88c26efbc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artwork`
--

CREATE TABLE `artwork` (
  `artwork_id` int(11) NOT NULL,
  `artwork_name` varchar(255) NOT NULL,
  `artwork_category` varchar(255) NOT NULL,
  `artwork_description` varchar(255) NOT NULL,
  `artwork_price` varchar(255) NOT NULL,
  `artwork_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artwork`
--

INSERT INTO `artwork` (`artwork_id`, `artwork_name`, `artwork_category`, `artwork_description`, `artwork_price`, `artwork_image`) VALUES
(1, 'Bukur', 'painting', 'perfaqesim i vlerave morale', '2000', 'Найкращі_миті_життя.jpg'),
(2, 'kkkk', 'photography', 'hiiiiiii', '1000', 'paulius-dragunas-M2UXVaLlfds-unsplash.jpg'),
(3, 'Summer', 'pottery', 'Amazing pottery', '1500', 'colorfulCuboid2.png'),
(4, 'Spring', 'quilling', 'cherry spring', '800', 'flowerQuilling.png'),
(5, 'Spring', 'photography', 'realism', '3500', 'AI_Transparent_3D_rendering_of_soft_fluttering_fabric_clear_09c32.png'),
(6, 'Living', 'sculpture', 'Expressing emotions', '1200', 'sculpture.png');

-- --------------------------------------------------------

--
-- Table structure for table `merge`
--

CREATE TABLE `merge` (
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merge`
--

INSERT INTO `merge` (`u_id`, `p_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `price`, `image`) VALUES
(1, 'Photography', '140000', 'ArtHive-Canva (3).jpg'),
(2, 'Photography', '110000', 'ArtHive-Canva (4).jpg'),
(3, 'Quilling', '123000', 'ArtHive-Canva (7).jpg'),
(4, 'Pottery', '22000', 'ArtHive-Canva (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `name`, `email`, `password`) VALUES
(1, 'klea', 'klea@gmail.com', '$2y$10$WL8AgUtUBDbEKWXgB7F3bOkroUayt3Q6OO2Qfp9vvKd9ErDLcpnUu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist_artwork`
--
ALTER TABLE `artist_artwork`
  ADD KEY `artistJoin_id` (`artistJoin_id`),
  ADD KEY `artworkJoin_id` (`artworkJoin_id`);

--
-- Indexes for table `artist_table`
--
ALTER TABLE `artist_table`
  ADD PRIMARY KEY (`artist_id`),
  ADD UNIQUE KEY `artist_email` (`artist_email`);

--
-- Indexes for table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`artwork_id`);

--
-- Indexes for table `merge`
--
ALTER TABLE `merge`
  ADD KEY `p_id` (`p_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist_table`
--
ALTER TABLE `artist_table`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `artwork_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artist_artwork`
--
ALTER TABLE `artist_artwork`
  ADD CONSTRAINT `artist_artwork_ibfk_1` FOREIGN KEY (`artistJoin_id`) REFERENCES `artist_table` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artist_artwork_ibfk_2` FOREIGN KEY (`artworkJoin_id`) REFERENCES `artwork` (`artwork_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `merge`
--
ALTER TABLE `merge`
  ADD CONSTRAINT `merge_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `merge_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
