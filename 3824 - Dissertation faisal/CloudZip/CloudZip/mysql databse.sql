-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2019 at 08:40 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `added_by` bigint(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `file`, `code`, `added_by`, `date`) VALUES
(208, 'file', '848341070446bottom22222222.jpg', 'eb4463be', 1, '2019-12-20 22:27:23'),
(209, 'file', '848341070446bottom22222222.jpg', 'eb4463be', 1, '2019-12-20 22:27:28'),
(210, 'file', '848341070446bottom22222222.jpg', 'eb4463be', 1, '2019-12-20 22:29:12'),
(211, 'file', '1019053117170ab_pic.jpg', '229d64ed', 1, '2019-12-20 22:29:56'),
(212, 'file', '1019053117170ab_pic.jpg', '229d64ed', 1, '2019-12-20 22:30:08'),
(213, 'upload', '27406406764bottom444444444444.jpg', 'f5732625', 1, '2019-12-23 23:50:31'),
(214, 'file', '27406406764bottom444444444444.jpg', 'f5732625', 8, '2019-12-23 23:50:43'),
(215, 'upload', '27406406764bottom444444444444.jpg', 'f5732625', 8, '2019-12-24 00:09:16'),
(216, 'file', '27406406764bottom444444444444.jpg', 'f5732625', 8, '2019-12-24 00:09:51'),
(217, 'file', '10677138100783bot_1222.jpg', '46c20717', 8, '2019-12-24 00:12:17'),
(218, 'file', '10677138100783bot_1222.jpg', '46c20717', 8, '2019-12-24 00:12:26'),
(219, 'upload', '10677138100783bot_1222.jpg', '46c20717', 8, '2019-12-24 00:12:56'),
(220, 'File1', '99018btn_pause.png', '78e1e66c', 1, '2019-12-24 00:16:36'),
(221, 'file2', '1019053117170ab_pic.jpg', '229d64ed', 1, '2019-12-24 00:16:45'),
(222, 'File3', '422853975127bottom111111111.jpg', '289d61e4', 1, '2019-12-24 00:17:00'),
(223, 'file1', '1019053117170ab_pic.jpg', '229d64ed', 3, '2019-12-24 00:17:27'),
(224, 'file', '27406406764bottom444444444444.jpg', 'f5732625', 4, '2019-12-24 11:06:32'),
(225, 'file', '27406406764bottom444444444444.jpg', 'f5732625', 4, '2019-12-24 11:12:04'),
(226, 'icon...', '55504bottom333333333.jpg', '359ea3c2', 4, '2019-12-24 11:13:23'),
(227, 'file...', '55504bottom333333333.jpg', '359ea3c2', 4, '2019-12-24 11:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `role` varchar(3) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `username`, `date`, `role`, `password`) VALUES
(1, 'User1', 'user1@gmail.com', 'User1', '2019-12-02 18:43:24', 'u', '202cb962ac59075b964b07152d234b70'),
(2, 'User2', 'user2@gmail.com', 'User2', '2019-12-02 18:43:24', 'u', '202cb962ac59075b964b07152d234b70'),
(3, 'User3', 'user3@gmail.com', 'User3', '2019-12-02 18:43:24', 'u', '202cb962ac59075b964b07152d234b70'),
(4, 'Admin', 'admin@gmail.com', 'Admin', '2019-12-02 18:43:24', 'a', '202cb962ac59075b964b07152d234b70'),
(7, 'User4', 'user4@gmail.com', 'User4', '2019-12-23 23:26:47', 'u', '202cb962ac59075b964b07152d234b70'),
(8, 'User5', 'user5@gmail.com', 'User5', '2019-12-23 23:31:14', 'u', '202cb962ac59075b964b07152d234b70'),
(9, 'user6', 'user6@gmail.com', 'user6', '2019-12-24 11:14:32', 'u', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
