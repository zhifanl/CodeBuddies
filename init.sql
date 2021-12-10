-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2021 at 06:55 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `471`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '$2y$10$QgeoE0hoGprB94/acclo2.yPerp1EdBkbKFRzv5JRASjnzeahfoli');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `admin_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `email`, `username`, `teacher_name`, `course_name`, `date`, `admin_id`) VALUES
(19, 'zhifanli2000@gmail.com', 'zhifan', 'Moussavi', 'ENSF480', '2021 December 6th 2:00 pm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fulfill_request_teacher`
--

CREATE TABLE `fulfill_request_teacher` (
  `request_id` int(255) NOT NULL,
  `teacher_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `in_person`
--

CREATE TABLE `in_person` (
  `id` int(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `make_request`
--

CREATE TABLE `make_request` (
  `student_id` int(255) NOT NULL,
  `request_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_id` int(255) NOT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `student_id` int(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `salary` int(255) DEFAULT NULL,
  `admin_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_id`, `student_name`, `student_id`, `course_name`, `teacher_name`, `start_date`, `end_date`, `salary`, `admin_id`) VALUES
(22, 'Zhifan Li', 13, 'ENSF480', 'Moussavi', 'NULL', 'NULL', 250, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `admin_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `email`, `client_name`, `teacher_name`, `course_name`, `admin_id`) VALUES
(38, 'zhifanli2000@gmail.com', 'zhifan', 'Moussavi', 'ENSF480', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `select_appointment`
--

CREATE TABLE `select_appointment` (
  `student_id` int(255) NOT NULL,
  `appointment_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `software_courses`
--

CREATE TABLE `software_courses` (
  `id` int(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tuition_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `software_courses`
--

INSERT INTO `software_courses` (`id`, `course_name`, `description`, `tuition_fee`) VALUES
(1, 'ENCM511', 'Embedded System interfacing', 600),
(3, 'ENSF480', 'Principles of Software Design', 250),
(4, 'CPSC457', 'Principles of OS', 500),
(9, 'SENG401', 'Software Architecture', 200),
(10, 'SENG471', 'Software Requirement Engineering', 500),
(11, 'ENSF409', 'Principles of Software Development', 300),
(12, 'SENG438', 'Software testing and reliability', 400),
(13, 'SENG533', 'Software Performance Evaluation', 400),
(14, 'SENG511', 'Software Process and Management', 500),
(15, 'CPSC319', 'Data Structures and Algorithms', 200),
(16, 'ENCM369', 'Computer Organization', 300),
(17, 'CPSC471', 'Database Management Systems', 500),
(18, 'CPSC441', 'Computer Networks', 400);

-- --------------------------------------------------------

--
-- Table structure for table `student_course_list`
--

CREATE TABLE `student_course_list` (
  `student_id` int(255) NOT NULL,
  `tuition_fee` int(255) DEFAULT NULL,
  `course_name` varchar(255) NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `teacher_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_course_list`
--

INSERT INTO `student_course_list` (`student_id`, `tuition_fee`, `course_name`, `start_date`, `end_date`, `teacher_name`) VALUES
(13, 250, 'ENSF480', 'NULL', 'NULL', 'Moussavi');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `admin_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_name`, `admin_id`) VALUES
(7, 'Zhifan Li', NULL),
(8, 'Tianfan Zhou', NULL),
(9, 'Taimoor Abrar', NULL),
(10, 'Jorg', NULL),
(11, 'Chris', NULL),
(12, 'Moussavi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `major` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `name`, `email`, `university`, `major`, `location`, `description`) VALUES
(13, 'zhifan', '$2y$10$kAHb6o6sbIpOb/2/xNZG6OQRFcppqxQSRMb7AhW7/r2kycPfcCr22', 'Zhifan Li', 'zhifanli2000@gmail.com', 'University of Calgary', 'Software Engineering', 'Calgary', 'Third Year Student');

-- --------------------------------------------------------

--
-- Table structure for table `zoom`
--

CREATE TABLE `zoom` (
  `id` int(255) NOT NULL,
  `zoom_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fulfill_request_teacher`
--
ALTER TABLE `fulfill_request_teacher`
  ADD PRIMARY KEY (`request_id`,`teacher_id`);

--
-- Indexes for table `in_person`
--
ALTER TABLE `in_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `make_request`
--
ALTER TABLE `make_request`
  ADD PRIMARY KEY (`student_id`,`request_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `select_appointment`
--
ALTER TABLE `select_appointment`
  ADD PRIMARY KEY (`student_id`,`appointment_id`);

--
-- Indexes for table `software_courses`
--
ALTER TABLE `software_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `zoom`
--
ALTER TABLE `zoom`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `software_courses`
--
ALTER TABLE `software_courses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
