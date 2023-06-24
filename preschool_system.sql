-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 12:37 AM
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
(1, 'Lizz Chloe', 'chloelizz@gmail.com', 'Request More Information', 'I\'m interested about your course for kids! Please kindly contact me to let me know more information about the course.'),
(2, 'JC', 'jcjc1221@gmail,com', 'Special Website', 'Very special website for preschool kids! I LOVE IT!!!');

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
(1, 'The ABC Song', 'ezmsrB59mj8', 'ABC Song | Learn ABC alphabet for Kids.\r\n\r\nA B C D E F G\r\nH I J K L M N\r\nO P Q R S T U\r\nV W X Y Z', 'Kindergarten', NULL, 1),
(2, '123 Song', 'o0IsBUaoTrQ', '123 Song for Kids | Learn Counting & Numbers\r\n\r\nCounting 123 with this 123 song.', 'Kindergarten', NULL, 1),
(3, 'Wheels on the Bus', 'e_04ZrNroTo', 'Bounce along in the bus all over town with this favorite nursery rhyme!', 'Pre-K', NULL, 1),
(4, 'One Little Finger', '0pAZq7VHA2I', 'Super simple songs for Pre-k kids!', 'Pre-K', NULL, 1);

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
(1, 'T001', 'teacher123', 'Lim Wei Siang', '2000-08-03', NULL, NULL, 'weisiang999@outlook.com', '0167577211', '24, Jalan Rantai 2, Taman Kobena', '2018-01-01', 2, 1, 1, NULL),
(2, 'T002', 'teacher234', 'Jayden Lim', '2000-10-24', NULL, NULL, 'jaydenlim888@gmail.com', '0183435118', 'C-19-3A, The Heights Residence, 75450, Melaka', '2020-01-01', 2, 1, 1, NULL),
(3, 'S001', 'student123', 'Lan Hao Zhe', '2018-06-16', 'Kindergarten', 'Eugene Ng', 'eugene524@gmail.com', '0183435118', '30, Jalan Sutera, Taman Sutera, 81200, Johor Bahru', '2023-06-05', 1, 1, 1, NULL),
(4, 'S002', 'student456', 'Tan Yu Xi', '2019-05-20', 'Pre-K', 'Cindy Lan', 'cindylan@gmail.com', '0147825161', '70, Jalan Indah, Taman Kobena, 81200, Johor', '2023-06-05', 1, 1, 1, NULL),
(5, 'S003', 'student888', 'Joan Lim', '2016-08-24', 'Kindergarten', 'JJ Lim', 'jjlim@gmail.com', '0122419859', '90, Jalan Ampang, Ampang, 68000, Kuala Lumpur', '2021-01-04', 1, 2, 1, NULL);

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
  ADD PRIMARY KEY (`course_id`);

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
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
