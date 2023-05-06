-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 02:33 AM
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
-- Database: `iteach`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(25) NOT NULL,
  `cost` float NOT NULL,
  `teacher_id` int(6) NOT NULL,
  `published_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `language` varchar(255) NOT NULL,
  `students_enrolled` int(3) NOT NULL,
  `course_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `category`, `cost`, `teacher_id`, `published_on`, `language`, `students_enrolled`, `course_code`) VALUES
(101, 'Full Stack Web Development', 'Web Development', 59.99, 100001, '2023-04-17 23:00:00', 'English', 0, ''),
(102, 'Introduction to Data Science', 'Data Science', 59.99, 100001, '2023-04-19 23:00:00', 'English', 0, ''),
(103, 'Cybersecurity Fundamentals', 'Cybersecurity', 59.99, 100001, '2023-04-09 23:00:00', 'English', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `pdf` varchar(100) DEFAULT NULL,
  `ppt` varchar(100) DEFAULT NULL,
  `video` varchar(100) NOT NULL,
  `course_id` int(6) NOT NULL,
  `course_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `title`, `description`, `pdf`, `ppt`, `video`, `course_id`, `course_code`) VALUES
(10101, 'Full Stack Web Development for Beginners', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', '', '', 'https://www.youtube.com/watch?v=nu_pCVPKzTk', 101, ''),
(10102, 'Course overview', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', 'full_stack.pdf', '', 'https://www.youtube.com/watch?v=nu_pCVPKzTk', 101, ''),
(10103, 'full stack course presentation', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', '', 'full_stack_presentation.ppt', '', 101, ''),
(10201, 'Introduction to Data Science', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', '', '', 'https://www.youtube.com/watch?v=ua-CiDNNj30&pp=ygUcSW50cm9kdWN0aW9uIHRvIERhdGEgU2NpZW5jZQ%3D%3D', 102, ''),
(10202, 'Data Science course overview', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', 'data_science_overview.pdf', '', '', 102, ''),
(10203, 'Data science course presentation', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', '', 'data_science_presentation.ppt', '', 102, ''),
(10301, 'Cybersecurity Fundamentals', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', '', '', 'https://www.youtube.com/watch?v=njPY7pQTRWg&pp=ygUaQ3liZXJzZWN1cml0eSBGdW5kYW1lbnRhbHM%3D', 103, ''),
(10302, 'cybersecurity course overview', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', 'c_security_fund_overview.pdf', '', '', 103, ''),
(10303, 'Presentation of the cybersecurity fundamentals course', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', '', 'cybersecurity_presentation.ppt', '', 103, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(13) NOT NULL,
  `type` varchar(1) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `surname`, `dob`, `phone`, `type`, `password`) VALUES
(100001, 'cdaaniel@outlook.com', 'Daniel', 'Cobzariu', '2023-05-10', '07402883319', 'A', '$2y$10$RqedvOe1danXQo/5cJs9auhWaWsCwjyvTkc8JXjE1XSDavuPo4pYG'),
(954004, 'test@gmail.com', 'Test', 'Account', '2019-05-22', '073636732237', 'A', '$2y$10$I.wDO7Yf6ImY1PrFK.xCnuFMwpv82fEBMqKaC51hg6OPSfwYMTAD.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher` (`teacher_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `courses_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10317;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=954006;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `courses_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
