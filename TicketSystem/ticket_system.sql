-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 11:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Open','In Progress','Closed') DEFAULT 'Open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `status`, `created_at`, `user_id`) VALUES
(5, 'sd', 'sd', 'In Progress', '2025-01-28 13:54:57', 3),
(6, 'nsds', 'asdadwqd', 'In Progress', '2025-01-28 13:55:43', 4),
(7, 'sdfsdfs', 'sfdsf', 'Closed', '2025-02-03 11:30:49', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(3, 'admin2', '$2y$10$uEudk4nX10fORf.Oky/pFOes4rjcWdrCk8K9H5xFMrZP7/UjEh0My', 'admin', '2025-01-28 13:15:52'),
(4, 'user1', '$2y$10$S92V.SgZUOxdSd5BAPPmWehSfV3NBqmfeSofnLyAm.rIU7hYjlGoG', 'user', '2025-01-28 13:38:30'),
(12, 'sssssssss', '$2y$10$xP0t9W/iHvynYPU8Cb7KQOKKsrnU0JOBLt/E8ZbLQyBjRn5pufk0e', 'user', '2025-01-28 14:18:47'),
(13, '1234', '$2y$10$x79177uB/nGjfhjqGoFD8e7vIy8/ZLe1KmCQAHm2ZP8cnt7uTBHMq', 'user', '2025-01-28 14:18:51'),
(14, '12345', '$2y$10$kH/mYVzZXxTdivq9hnJvb.a.YVWLXMCjb22S/Nj6EfnEGRbanm97G', 'user', '2025-01-30 13:28:58'),
(15, 'matze', '$2y$10$xSijew.qJGkTUUxWeQffCe2saydalpVAJxGZfELlbyWzk8/IOwE1W', 'user', '2025-02-03 11:25:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
