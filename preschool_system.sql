-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 08:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `preschool_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'A001', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `subject` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `message` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'I love your course!'),
(2, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'I like your content!'),
(15, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'loveeee'),
(18, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'loveeee'),
(20, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'lovee'),
(22, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'lovee'),
(24, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'loveee'),
(26, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'loveee'),
(28, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'loveee'),
(30, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', 'love'),
(40, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', '123'),
(41, 'Lim Wei Siang test', 'weisiangws0803@gmail.com', 'love', '123test'),
(42, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'test without preventdefault', 'test'),
(43, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', '123'),
(44, 'Lim Wei Siang', 'weisiangws0803@gmail.com', '123', '1123'),
(45, 'Lim Wei Siang', 'weisiangws0803@gmail.com', '123', '123'),
(50, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', '123'),
(55, 'Lim Wei Siang', 'weisiangws0803@gmail.com', 'love', '123');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(20) NOT NULL,
  `course_video` varchar(20) NOT NULL,
  `course_description` longtext NOT NULL,
  `education_stage` varchar(20) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_video`, `course_description`, `education_stage`, `teacher_id`, `admin_id`) VALUES
(2, 'Five Little Ducks', 'pZw9veQ76fo', 'Five Little Ducks, The simplest baby song!', 'K1', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `loginID` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `education_stage` varchar(50) DEFAULT NULL,
  `parentName` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `startDate` date NOT NULL,
  `role` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `loginID`, `password`, `name`, `dob`, `education_stage`, `parentName`, `email`, `contact`, `address`, `startDate`, `role`, `status`, `createdBy`, `admin_id`) VALUES
(5, '1234567890', 'student1', 'Lan Hao Zhe', '2018-06-04', 'K1', 'Yanti', 'yanti888@gmail.com', '0167955116', '24, Jalan Sutera, Taman Sutera, 81200 Johor Bahru, Johor', '2023-06-05', 1, 1, NULL, NULL),
(7, 'T001', 'teacher123', 'Lan Xin Er', '2000-09-30', NULL, NULL, 'lanxiner@gmail.com', '0183633117', '70, Jalan Indah, Taman Bukit Indah, 81200, Johor Bahru, Johor', '2017-06-07', 2, 1, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `student_id` (`admin_id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
