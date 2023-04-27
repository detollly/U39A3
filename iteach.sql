-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 12:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `courses_id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(25) NOT NULL,
  `cost` varchar(6) NOT NULL,
  `teacher` int(6) NOT NULL,
  `published_on` date NOT NULL,
  `language` varchar(10) NOT NULL,
  `students-enrolled` int(3) NOT NULL,
  `ratings` int(1) NOT NULL,
  `reviews` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courses_id`, `name`, `category`, `cost`, `teacher`, `published_on`, `language`, `students-enrolled`, `ratings`, `reviews`) VALUES
(101, 'Full Stack Web Development', 'Web Development', '£59.99', 854002, '2023-04-18', 'English', 10, 4, ''),
(102, 'Introduction to Data Science', 'Data Science', '£39.99', 854004, '2023-04-20', 'English', 12, 5, ''),
(103, 'Cybersecurity Fundamentals', 'Cybersecurity', '£39.99', 854010, '2023-04-10', 'English', 10, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `enrolment`
--

CREATE TABLE `enrolment` (
  `user_id` int(6) NOT NULL,
  `courses_id` int(6) NOT NULL,
  `price` int(6) NOT NULL,
  `status` varchar(1) NOT NULL,
  `teacher` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `ppt` varchar(100) NOT NULL,
  `videos` varchar(100) NOT NULL,
  `courses_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `title`, `description`, `pdf`, `ppt`, `videos`, `courses_id`) VALUES
(10101, 'Full Stack Web Development for Beginners', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', '', '', 'https://www.youtube.com/watch?v=nu_pCVPKzTk', 101),
(10102, 'Course overview', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', 'full_stack.pdf', '', '', 101),
(10103, 'full stack course presentation', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', '', 'full_stack_presentation.ppt', '', 101),
(10201, 'Introduction to Data Science', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', '', '', 'https://www.youtube.com/watch?v=ua-CiDNNj30&pp=ygUcSW50cm9kdWN0aW9uIHRvIERhdGEgU2NpZW5jZQ%3D%3D', 102),
(10202, 'Data Science course overview', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', 'data_science_overview.pdf', '', '', 102),
(10203, 'Data science course presentation', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', '', 'data_science_presentation.ppt', '', 102),
(10301, 'Cybersecurity Fundamentals', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', '', '', 'https://www.youtube.com/watch?v=njPY7pQTRWg&pp=ygUaQ3liZXJzZWN1cml0eSBGdW5kYW1lbnRhbHM%3D', 103),
(10302, 'cybersecurity course overview', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', 'c_security_fund_overview.pdf', '', '', 103),
(10303, 'Presentation of the cybersecurity fundamentals course', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', '', 'cybersecurity_presentation.ppt', '', 103);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(13) NOT NULL,
  `type` varchar(1) NOT NULL,
  `password` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `name`, `surname`, `dob`, `phone`, `type`, `password`) VALUES
(154001, 'olivia.smith@gmail.com', 'Olivia', 'Smith', '1992-05-12', '07912345678', 'S', '#Olivia92!'),
(154003, 'chloe.brown@yahoo.co.uk', 'Chloe', 'Brown', '1996-03-05', '07734567890', 'S', '#Chloe96%'),
(154005, 'amelia.wilson@gmail.com', 'Amelia', 'Wilson', '1999-07-07', '07456789012', 'S', '#Amelia99*'),
(154006, 'william.taylor@yahoo.co.uk', 'William', 'Taylor', '1990-02-14', '07367890123', 'S', '#William90$'),
(154007, 'emily.anderson@hotmail.com', 'Emily', 'Anderson', '1993-12-03', '07278901234', 'S', '#Emily93&'),
(154008, 'daniel.jackson@gmail.com', 'Daniel', 'Jackson', '1989-06-28', '07189012345', 'S', '#Daniel89+'),
(154009, 'sophia.clark@yahoo.co.uk', 'Sophia', 'Clark', '1991-10-09', '07090123456', 'S', '#Sophia91%'),
(854002, 'ethan.johnson@hotmail.com', 'Ethan', 'Johnson', '1987-09-18', '07823456789', 'T', '#Ethan87@'),
(854004, 'samuel.davis@outlook.com', 'Samuel', 'Davis', '1985-11-21', '07545678901', 'T', '#Samuel85^'),
(854010, 'benjamin.roberts@outlook.com', 'Benjamin', 'Roberts', '1988-04-17', '07901234567', 'T', '#Benjamin88^'),
(954000, 'mia.harris@email.com', 'Mia', 'Harris', '1988-10-07', '07522345678', 'A', 'mia1989');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courses_id`),
  ADD KEY `teacher` (`teacher`);

--
-- Indexes for table `enrolment`
--
ALTER TABLE `enrolment`
  ADD PRIMARY KEY (`user_id`,`courses_id`),
  ADD KEY `rel2` (`courses_id`),
  ADD KEY `re3` (`teacher`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `courses_id` (`courses_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courses_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10304;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=954001;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `teacher` FOREIGN KEY (`teacher`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `enrolment`
--
ALTER TABLE `enrolment`
  ADD CONSTRAINT `re3` FOREIGN KEY (`teacher`) REFERENCES `courses` (`courses_id`),
  ADD CONSTRAINT `rel1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `rel2` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`courses_id`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `courses_id` FOREIGN KEY (`courses_id`) REFERENCES `courses` (`courses_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
