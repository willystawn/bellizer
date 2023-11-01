-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 08:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bellizer`
--

-- --------------------------------------------------------

--
-- Table structure for table `button_presses`
--

CREATE TABLE `button_presses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`) VALUES
(1, 'grup1'),
(2, 'grup2'),
(3, 'grup3'),
(4, 'grup4'),
(5, 'grup5'),
(6, 'grup6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','group_user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$sL0jJxN2H0dil1l7RySDeuax6v44uhS8UkK1SQyiMNETKS0sLHF8K', 'admin'),
(2, 'grup1', '$2y$10$kCUlEzYh7.IGRHJGraHN7uLbTZ3wcajLXoyINzmGKQrgqUH06P8Y2', 'group_user'),
(3, 'grup2', '$2y$10$3caUJyFs8ZZeQyvMuz.pXu6aczkNEI7VBJMXprUc82aIBtN2OCZje', 'group_user'),
(4, 'grup3', '$2y$10$fpHDMpjPr945ubJ0TzkIFOfqfJCRABv2D5b0tmoQ115Pb16pBXw96', 'group_user'),
(5, 'grup4', '$2y$10$3G.YOzIWuxRa396FL82szuHtTmacFK1NhlFKncTOD8ctx3Bf5NmAC', 'group_user'),
(7, 'grup5', '$2y$10$wYqzB5ySHVw0hn/azUf6feyJCYLgBVG9ReNvbpeaTTgcG2HV8dZgS', 'group_user'),
(8, 'grup6', '$2y$10$3ENcGloxXO6PmwCwb/zaVOqYHlyy4PU2Lr6o7J6yHFECvUEEgyoRO', 'group_user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `button_presses`
--
ALTER TABLE `button_presses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `button_presses`
--
ALTER TABLE `button_presses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `button_presses`
--
ALTER TABLE `button_presses`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
