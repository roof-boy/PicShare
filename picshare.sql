-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 02, 2024 at 05:41 PM
-- Server version: 8.2.0
-- PHP Version: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `picshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `uploadDate` date NOT NULL,
  `bio` text NOT NULL,
  `forReview` tinyint(1) NOT NULL,
  `ownerID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`ownerID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Table of posts. All posts are tied to user IDs';

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `uploadDate`, `bio`, `forReview`, `ownerID`) VALUES
(19, '../postPhotos/6633c39712522_NuclearBomb.jpg', '2024-05-02', 'nuc', 0, 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` char(25) NOT NULL,
  `passw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` char(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Table of users. All passwords must be encrypted';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passw`, `email`, `isAdmin`) VALUES
(23, 'Roofboy', '$2y$10$tt.kP7bvyADpXT6NLRCK7./K4bJWtCWLWgj2aSs6ukUjBNyn99FDW', 'sovaelias@gmail.com', 1),
(24, 'test1', '$2y$10$QLGTuU7sb1eLgFFwvFSZVeDwVpcEMQG9bvJMkNAIz0YZjyyDvF9yG', 'test@gmail.com', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
