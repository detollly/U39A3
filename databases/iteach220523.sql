-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2023 at 10:48 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

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

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `cost` float NOT NULL,
  `teacher_id` int NOT NULL,
  `published_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `language` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `students_enrolled` int NOT NULL,
  `course_code` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `category`, `cost`, `teacher_id`, `published_on`, `language`, `students_enrolled`, `course_code`) VALUES
(101, 'Full Stack Web Development for Beginners', 'Web Development', 59.99, 10001, '2023-05-20 22:06:09', 'English', 0, ''),
(102, 'Introduction to Data Science', 'Data Science', 59.99, 10001, '2023-05-20 22:06:16', 'English', 0, ''),
(103, 'Cybersecurity Fundamentals', 'Cybersecurity', 59.99, 10001, '2023-05-20 22:06:19', 'English', 0, ''),
(122, 'PHP', 'Web Development', 39.99, 10001, '2023-05-20 22:06:21', 'English, Spanish', 0, ''),
(123, 'Python', 'Web Development', 69.99, 10001, '2023-05-20 22:18:24', 'English, German', 0, ''),
(124, 'Java', 'Programming', 69.99, 10001, '2023-05-20 22:06:25', 'English', 0, ''),
(125, 'C++', 'Programming', 59.99, 10001, '2023-05-20 22:06:27', 'English', 0, ''),
(127, 'HTML', 'Web Development', 29.99, 10001, '2023-05-22 00:24:29', 'English', 0, 'R404');

-- --------------------------------------------------------

--
-- Table structure for table `enrolment`
--

DROP TABLE IF EXISTS `enrolment`;
CREATE TABLE IF NOT EXISTS `enrolment` (
  `user_id` int NOT NULL,
  `course_id` int NOT NULL,
  `price` int NOT NULL,
  `teacher_id` int NOT NULL,
  `joining_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`user_id`,`course_id`),
  KEY `rel2` (`course_id`),
  KEY `re3` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `enrolment`
--

INSERT INTO `enrolment` (`user_id`, `course_id`, `price`, `teacher_id`, `joining_date`) VALUES
(10001, 101, 60, 10001, '2023-05-22 10:01:53.956451'),
(10001, 102, 60, 10001, '2023-05-22 10:47:47.349778');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ppt` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `course_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50052 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `description`, `pdf`, `ppt`, `video`, `course_id`) VALUES
(50001, 'Full Stack Web Development for Beginners ', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', NULL, NULL, 'https://www.youtube.com/watch?v=nu_pCVPKzTk', 101),
(50002, 'Full Stack Web Development for Beginners Overview', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', 'Full Stack Web Development for Beginners Overview.pdf', NULL, '', 101),
(50003, 'Full Stack Web Development for Beginners Presentation', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', NULL, 'Full Stack Web Development for Beginners Presentation.pptx', '', 101),
(50004, 'HTML Tutorial for Beginners: HTML Crash Course', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', NULL, NULL, 'https://www.youtube.com/watch?v=qz0aGYrrlhU', 101),
(50009, 'CSS in 100 Seconds', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', NULL, NULL, 'https://www.youtube.com/watch?v=OEV8gMkCHXQ', 101),
(50011, 'JavaScript Tutorial for Beginners: Learn JavaScript in 1 Hour', 'This course is designed for beginners who want to learn how to build a complete web application from scratch. You will learn the fundamentals of web development, including HTML, CSS, and JavaScript, as well as how to use popular web development frameworks like React, Node.js, and MongoDB to build full stack applications. By the end of the course, you will have built a fully functional web application that you can add to your portfolio.', NULL, NULL, 'https://www.youtube.com/watch?v=W6NZfCO5SIk&t=692s', 101),
(50013, 'Introduction to Data Science', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', NULL, NULL, 'https://www.youtube.com/watch?v=ua-CiDNNj30&pp=ygUcSW50cm9kdWN0aW9uIHRvIERhdGEgU2NpZW5jZQ%3D%3D', 102),
(50014, 'Introduction to Data Science Overview', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', 'Introduction to Data Science Overview.pdf', NULL, NULL, 102),
(50015, 'Introduction to Data Science Presentation', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', NULL, 'Introduction to Data Science Presentation.pptx', NULL, 102),
(50016, 'Big Data Full Course 2022', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', NULL, NULL, 'https://www.youtube.com/watch?v=KCEPoPJ8sWw', 102),
(50017, 'College Algebra - Full Course', 'This course is an introduction to the field of data science, which is the study of how to extract knowledge and insights from data. You will learn the basics of statistics, programming in Python, and data visualization. You will also explore popular data science techniques, such as regression analysis, classification, and clustering. By the end of the course, you will be able to use Python to manipulate data, create visualizations, and build simple predictive models.', NULL, NULL, 'https://www.youtube.com/watch?v=LwCRRUa8yTU', 102),
(50019, 'Basics Of Cybersecurity For Beginners', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', NULL, NULL, 'https://www.youtube.com/watch?v=njPY7pQTRWg', 103),
(50020, 'Cybersecurity fundamentals course Overview', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', 'Cybersecurity fundamentals course Overview.pdf', NULL, NULL, 103),
(50021, 'What is a Man-in-the-Middle Attack', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', NULL, NULL, 'https://www.youtube.com/watch?v=83LOa-dYi_A', 103),
(50022, 'Phishing Attacks', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', NULL, NULL, 'https://www.youtube.com/watch?v=XBkzBrXlle0&pp=ygUIcGhpc2hpbmc%3D', 103),
(50023, 'Botnets', 'This course provides an introduction to cybersecurity and the basics of securing computer systems and networks. You will learn about common cyber threats, such as phishing and malware, and how to protect against them using firewalls, encryption, and other security measures. You will also explore the principles of secure coding and best practices for securing web applications. By the end of the course, you will have a solid understanding of the fundamentals of cybersecurity and how to implement basic security measures.', NULL, NULL, 'https://www.youtube.com/watch?v=s0sgiY93w9c&pp=ygUHYm90bmV0cw%3D%3D', 103),
(50024, 'History of PHP', 'A PHP course is designed to teach individuals the fundamentals and advanced concepts of PHP (Hypertext Preprocessor), which is a widely-used scripting language for web development. The course aims to provide students with a solid foundation in PHP programming, enabling them to build dynamic and interactive websites and web applications.', NULL, NULL, 'https://www.youtube.com/watch?v=hYnUz1Qs-co&pp=ygUOSGlzdG9yeSBvZiBQSFA%3D', 122),
(50025, 'PHP Overview', 'A PHP course is designed to teach individuals the fundamentals and advanced concepts of PHP (Hypertext Preprocessor), which is a widely-used scripting language for web development. The course aims to provide students with a solid foundation in PHP programming, enabling them to build dynamic and interactive websites and web applications.', 'PHP Overview.pdf', NULL, NULL, 122),
(50026, 'PHP syntax and features', 'A PHP course is designed to teach individuals the fundamentals and advanced concepts of PHP (Hypertext Preprocessor), which is a widely-used scripting language for web development. The course aims to provide students with a solid foundation in PHP programming, enabling them to build dynamic and interactive websites and web applications.', NULL, NULL, 'https://www.youtube.com/watch?v=F-AWT88vsyM&pp=ygUXUEhQIHN5bnRheCBhbmQgZmVhdHVyZXM%3D', 122),
(50027, 'PHP Web Development Tutorial | Web Development Using PHP', 'A PHP course is designed to teach individuals the fundamentals and advanced concepts of PHP (Hypertext Preprocessor), which is a widely-used scripting language for web development. The course aims to provide students with a solid foundation in PHP programming, enabling them to build dynamic and interactive websites and web applications.', NULL, NULL, 'https://www.youtube.com/watch?v=PGvrnas2_Pk&pp=ygUVV2Vic2l0ZXMgdGhhdCB1c2UgUEhQ', 122),
(50028, 'How to show database data on a website using MySQLi | PHP tutorial', 'A PHP course is designed to teach individuals the fundamentals and advanced concepts of PHP (Hypertext Preprocessor), which is a widely-used scripting language for web development. The course aims to provide students with a solid foundation in PHP programming, enabling them to build dynamic and interactive websites and web applications.\r\n', NULL, NULL, 'https://www.youtube.com/watch?v=0YLJ0uO6n8I&pp=ygUVV2Vic2l0ZXMgdGhhdCB1c2UgUEhQ', 122),
(50029, 'Python in 100 Seconds', 'A Python course is designed to teach individuals the fundamentals and advanced concepts of the Python programming language. Python is a versatile and widely-used programming language known for its simplicity, readability, and vast range of applications. The course aims to equip students with the skills and knowledge needed to develop various types of software, ranging from web applications to data analysis tools.', NULL, NULL, 'https://www.youtube.com/watch?v=a7_WFUlFS94&pp=ygUVV2Vic2l0ZXMgdGhhdCB1c2UgUEhQ', 123),
(50030, 'Tuples', 'A Python course is designed to teach individuals the fundamentals and advanced concepts of the Python programming language. Python is a versatile and widely-used programming language known for its simplicity, readability, and vast range of applications. The course aims to equip students with the skills and knowledge needed to develop various types of software, ranging from web applications to data analysis tools.', NULL, NULL, 'https://www.youtube.com/watch?v=fR_D_KIAYrE&pp=ygUGdHVwbGVz', 123),
(50031, 'Python dictionaries', 'A Python course is designed to teach individuals the fundamentals and advanced concepts of the Python programming language. Python is a versatile and widely-used programming language known for its simplicity, readability, and vast range of applications. The course aims to equip students with the skills and knowledge needed to develop various types of software, ranging from web applications to data analysis tools.', NULL, NULL, 'https://www.youtube.com/watch?v=MZZSMaEAC2g&pp=ygUTcHl0aG9uIGRpY3Rpb25hcmllcw%3D%3D', 123),
(50032, 'Python Overview', 'A Python course is designed to teach individuals the fundamentals and advanced concepts of the Python programming language. Python is a versatile and widely-used programming language known for its simplicity, readability, and vast range of applications. The course aims to equip students with the skills and knowledge needed to develop various types of software, ranging from web applications to data analysis tools.', 'Python Overview.pdf', NULL, 'https://www.youtube.com/watch?v=Y8Tko2YC5hA', 123),
(50033, '5 Unique Python Projects', 'A Python course is designed to teach individuals the fundamentals and advanced concepts of the Python programming language. Python is a versatile and widely-used programming language known for its simplicity, readability, and vast range of applications. The course aims to equip students with the skills and knowledge needed to develop various types of software, ranging from web applications to data analysis tools.', NULL, NULL, 'https://www.youtube.com/watch?v=_xf1TMs0ysk&pp=ygUPYWR2YW5jZWQgcHl0aG9u', 123),
(50034, 'Introduction to Java', 'A Java course is designed to teach individuals the fundamentals and advanced concepts of the Java programming language. Java is a popular and widely-used programming language known for its platform independence, robustness, and versatility. The course aims to provide students with a strong foundation in Java programming, enabling them to develop various types of software applications, ranging from desktop applications to mobile apps and enterprise systems.', NULL, NULL, 'https://www.youtube.com/watch?v=eIrMbAQSU34', 124),
(50035, 'Java Management Service - Managing Your Java Estate Just Got Easier', 'A Java course is designed to teach individuals the fundamentals and advanced concepts of the Java programming language. Java is a popular and widely-used programming language known for its platform independence, robustness, and versatility. The course aims to provide students with a strong foundation in Java programming, enabling them to develop various types of software applications, ranging from desktop applications to mobile apps and enterprise systems.', NULL, NULL, 'https://www.youtube.com/watch?v=tvcC2FMwIIo&pp=ygUEamF2YQ%3D%3D', 124),
(50036, 'Java Overview', 'A Java course is designed to teach individuals the fundamentals and advanced concepts of the Java programming language. Java is a popular and widely-used programming language known for its platform independence, robustness, and versatility. The course aims to provide students with a strong foundation in Java programming, enabling them to develop various types of software applications, ranging from desktop applications to mobile apps and enterprise systems.', 'Java Overview.pdf', NULL, 'https://www.youtube.com/watch?v=mAtkPQO1FcA', 124),
(50037, '5 Java concepts you MUST KNOW!', 'A Java course is designed to teach individuals the fundamentals and advanced concepts of the Java programming language. Java is a popular and widely-used programming language known for its platform independence, robustness, and versatility. The course aims to provide students with a strong foundation in Java programming, enabling them to develop various types of software applications, ranging from desktop applications to mobile apps and enterprise systems.', NULL, NULL, 'https://www.youtube.com/watch?v=BJxozKJlDvg&pp=ygUEamF2YQ%3D%3D', 124),
(50038, '10 Most Common Java Developer Mistakes', 'A Java course is designed to teach individuals the fundamentals and advanced concepts of the Java programming language. Java is a popular and widely-used programming language known for its platform independence, robustness, and versatility. The course aims to provide students with a strong foundation in Java programming, enabling them to develop various types of software applications, ranging from desktop applications to mobile apps and enterprise systems.', NULL, NULL, 'https://www.youtube.com/watch?v=rjDUpxtUPAE&pp=ygUEamF2YQ%3D%3D', 124),
(50039, 'Map and HashMap in Java', 'A Java course is designed to teach individuals the fundamentals and advanced concepts of the Java programming language. Java is a popular and widely-used programming language known for its platform independence, robustness, and versatility. The course aims to provide students with a strong foundation in Java programming, enabling them to develop various types of software applications, ranging from desktop applications to mobile apps and enterprise systems.', NULL, NULL, 'https://www.youtube.com/watch?v=H62Jfv1DJlU&pp=ygUEamF2YQ%3D%3D', 124),
(50040, 'C++ in 100 Seconds', 'A C++ course is designed to teach individuals the fundamentals and advanced concepts of the C++ programming language. C++ is a powerful and versatile programming language widely used in various domains, including system programming, game development, and high-performance applications. The course aims to provide students with a solid foundation in C++ programming, enabling them to develop efficient and complex software systems.', NULL, NULL, 'https://www.youtube.com/watch?v=MNeX4EGtR5Y&pp=ygUDQysr', 125),
(50041, 'C++ Overview', 'A C++ course is designed to teach individuals the fundamentals and advanced concepts of the C++ programming language. C++ is a powerful and versatile programming language widely used in various domains, including system programming, game development, and high-performance applications. The course aims to provide students with a solid foundation in C++ programming, enabling them to develop efficient and complex software systems.dddd', 'C++ Overview.pdf', NULL, 'https://www.youtube.com/watch?v=S3nx34WFXjI', 125),
(50042, 'Classes In C++', 'A C++ course is designed to teach individuals the fundamentals and advanced concepts of the C++ programming language. C++ is a powerful and versatile programming language widely used in various domains, including system programming, game development, and high-performance applications. The course aims to provide students with a solid foundation in C++ programming, enabling them to develop efficient and complex software systems.', NULL, NULL, 'https://www.youtube.com/watch?v=vIcOhM_Vkc4&pp=ygUDQysr', 125),
(50043, 'C vs C++ vs C#', 'A C++ course is designed to teach individuals the fundamentals and advanced concepts of the C++ programming language. C++ is a powerful and versatile programming language widely used in various domains, including system programming, game development, and high-performance applications. The course aims to provide students with a solid foundation in C++ programming, enabling them to develop efficient and complex software systems.', NULL, NULL, 'https://www.youtube.com/watch?v=sNMtjs_wQiE&pp=ygUDQysr', 125),
(50044, 'Car Game in C++ for Beginners', 'A C++ course is designed to teach individuals the fundamentals and advanced concepts of the C++ programming language. C++ is a powerful and versatile programming language widely used in various domains, including system programming, game development, and high-performance applications. The course aims to provide students with a solid foundation in C++ programming, enabling them to develop efficient and complex software systems.', NULL, NULL, 'https://www.youtube.com/watch?v=X4LyyvGLABg&pp=ygUDQysr', 125),
(50050, 'Intro to HTML', 'This is just an introduction to the web development basics.', NULL, 'Introduction to HTML.pptx', 'https://www.youtube.com/watch?v=qz0aGYrrlhU', 127),
(50051, 'HTML Div', 'Divs are used to separate content.', 'HTML Flexbox.pdf', NULL, 'https://www.youtube.com/watch?v=kGA9RIFiyIE', 127);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(1) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10017 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `surname`, `dob`, `phone`, `type`, `password`) VALUES
(10001, 'cdaaniel@outlook.com', 'Daniel', 'Cobzariu', '2023-05-10', '07402883319', 'A', '$2y$10$RqedvOe1danXQo/5cJs9auhWaWsCwjyvTkc8JXjE1XSDavuPo4pYG'),
(10002, 'test@gmail.com', 'Test', 'Account', '2019-05-22', '073636732237', 'S', '$2y$10$I.wDO7Yf6ImY1PrFK.xCnuFMwpv82fEBMqKaC51hg6OPSfwYMTAD.'),
(10016, 'daniel_cobzariu@yahoo.ro', 'Daniel', 'C', '2023-05-22', '07402883319', 'S', '$2y$10$.7ZT17yWDvNtMogAi0R28uVlbFO2RlK1WLMdJ7frRV3TYTlEGsZA2');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `enrolment`
--
ALTER TABLE `enrolment`
  ADD CONSTRAINT `enrolment_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `enrolment_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `enrolment_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
