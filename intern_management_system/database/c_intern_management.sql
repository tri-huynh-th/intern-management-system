-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2025 at 07:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c_intern_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('open','closed','archived') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `description`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Spring Internship 2025', 'Internship for IT students', '2025-09-01', '2025-11-30', 'open', '2025-09-04 15:19:59', '2025-09-04 15:26:22'),
(8, 'Summer Internship 2025', 'Internship for CS students', '2025-08-01', '2025-10-31', 'open', '2025-09-04 15:20:49', '2025-09-04 15:20:49'),
(9, 'Winter Internship 2025', 'Internship for business students', '2025-10-01', '2025-12-31', 'archived', '2025-09-04 15:27:54', '2025-09-04 15:27:54'),
(10, 'Fall Internship 2025', 'Internship for engineering students', '2025-06-01', '2025-08-31', 'closed', '2025-09-04 15:29:16', '2025-09-04 15:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `gpa` decimal(3,2) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `major` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('applied','interviewing','offered','accepted','rejected','in_progress','completed','terminated') DEFAULT 'applied',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `user_id`, `campaign_id`, `gpa`, `university`, `major`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(8, 13, 10, 3.50, 'HCMUT', 'Computer Science', '2025-06-01', '2025-08-31', 'offered', '2025-09-04 15:37:41', '2025-09-04 16:32:26'),
(9, 19, 8, 3.80, 'HCMUS', 'Software Engineering', '2025-08-01', '2025-10-31', 'accepted', '2025-09-04 15:39:37', '2025-09-04 17:12:21'),
(10, 20, 7, 3.60, 'UEH', 'Information Systems', '2025-09-01', '2025-11-30', 'accepted', '2025-09-04 15:41:12', '2025-09-04 17:12:48'),
(11, 21, 7, 3.70, 'FTU', 'Business', '2025-09-01', '2025-11-30', 'in_progress', '2025-09-04 15:42:17', '2025-09-04 15:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `intern_evaluations`
--

CREATE TABLE `intern_evaluations` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `evaluator_id` int(11) NOT NULL,
  `evaluation_date` date NOT NULL,
  `overall_rating` int(11) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intern_evaluations`
--

INSERT INTO `intern_evaluations` (`id`, `intern_id`, `evaluator_id`, `evaluation_date`, `overall_rating`, `comments`, `created_at`, `updated_at`) VALUES
(14, 8, 1, '2025-09-04', 1, 'cố gắng thêm', '2025-09-04 16:13:55', '2025-09-04 16:13:55'),
(15, 9, 1, '2025-09-04', 2, 'cố gắng phát triển', '2025-09-04 16:26:07', '2025-09-04 16:26:07'),
(18, 11, 1, '2025-09-04', 5, 'cố gắng phát triển', '2025-09-04 16:28:39', '2025-09-04 16:28:39'),
(21, 8, 15, '2025-09-04', 2, 'cố gắng phát triển', '2025-09-04 17:07:15', '2025-09-04 17:07:15'),
(22, 8, 14, '2025-09-04', 2, 'cố gắng thêm', '2025-09-04 17:08:48', '2025-09-04 17:08:48'),
(23, 8, 16, '2025-09-04', 3, 'cố gắng thêm', '2025-09-04 17:10:27', '2025-09-04 17:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `intern_feedback`
--

CREATE TABLE `intern_feedback` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `feedback_provider_id` int(11) NOT NULL,
  `feedback_type` enum('daily_progress','skill_assessment','program_feedback') NOT NULL,
  `feedback_date` date NOT NULL,
  `feedback_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intern_feedback`
--

INSERT INTO `intern_feedback` (`id`, `intern_id`, `feedback_provider_id`, `feedback_type`, `feedback_date`, `feedback_content`, `created_at`, `updated_at`) VALUES
(15, 8, 1, 'daily_progress', '2025-09-04', 'cố gắng phát triển', '2025-09-04 16:14:41', '2025-09-04 16:31:19'),
(16, 8, 15, 'daily_progress', '2025-09-04', 'phát triển thêm', '2025-09-04 17:05:12', '2025-09-04 17:05:12'),
(17, 8, 14, 'program_feedback', '2025-09-04', 'cố gắng thêm', '2025-09-04 17:09:16', '2025-09-04 17:09:16'),
(18, 8, 16, 'skill_assessment', '2025-09-04', 'cố gắng thêm', '2025-09-04 17:10:05', '2025-09-04 17:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `intern_skills`
--

CREATE TABLE `intern_skills` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL,
  `proficiency_level` enum('beginner','intermediate','advanced','expert') DEFAULT 'beginner',
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interview_schedules`
--

CREATE TABLE `interview_schedules` (
  `id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL,
  `interviewer_id` int(11) NOT NULL,
  `interview_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT 'scheduled',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview_schedules`
--

INSERT INTO `interview_schedules` (`id`, `intern_id`, `interviewer_id`, `interview_date`, `location`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(13, 8, 16, '2025-09-30 23:16:00', 'District 1, HCM City', 'scheduled', 'tập trung vào kĩ năng mềm', '2025-09-04 16:17:30', '2025-09-04 16:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_content` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_interns`
--

CREATE TABLE `program_interns` (
  `program_id` int(11) NOT NULL,
  `intern_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(3, 'Coordinator'),
(2, 'HR'),
(5, 'Intern'),
(4, 'Mentor');

-- --------------------------------------------------------

--
-- Table structure for table `training_programs`
--

CREATE TABLE `training_programs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `coordinator_id` int(11) NOT NULL,
  `status` enum('planned','in_progress','completed') DEFAULT 'planned',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_programs`
--

INSERT INTO `training_programs` (`id`, `title`, `description`, `start_date`, `end_date`, `coordinator_id`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Web Development Basics', 'HTML/CSS/JS', '2025-01-01', '2025-02-28', 14, 'completed', '2025-09-04 15:51:04', '2025-09-04 15:51:04'),
(13, 'Database Systems', 'SQL & NoSQL', '2025-03-01', '2025-04-30', 1, 'planned', '2025-09-04 16:11:34', '2025-09-04 16:11:34'),
(14, 'Mobile Apps', 'Android & iOS', '2025-05-01', '2025-06-30', 14, 'planned', '2025-09-04 16:13:24', '2025-09-04 16:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `phone_number`, `address`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$/mfburpTQ8mOeO.sPYLUbuZQAXUT6I68pzZjGQ3G5zIXZvG1aFDK6', 'admin@gmail.com', 'Admin', '0123456789', '123 Main St, City', 1, '2025-08-30 17:59:04', '2025-09-04 15:14:45'),
(13, 'intern', '$2y$10$PPBYctjEogLcS21284c7husFHEEM5XldOBhKykDXt7dbRyClYBp9a', 'intern@gmail.com', 'Intern', '0147258369', 'District 1, HCM CIty', 5, '2025-09-03 17:57:32', '2025-09-04 15:14:39'),
(14, 'coor', '$2y$10$AisNbjupN0MfpWpEQ3.bV.LfYul4ycYqJWqgvD5zAd1ZASmGy9UMe', 'coor@gmail.com', 'Coor', '0125463879', 'District 1, HCM CIty', 3, '2025-09-03 17:58:25', '2025-09-04 15:14:33'),
(15, 'hr', '$2y$10$TZZDQCGd1OWqO2peNqGgVu04hlUanzBLvwc2QOavAJb0d2I17zDcG', 'hr@gmail.com', 'Hr', '0147963258', 'District 1, HCM CIty', 2, '2025-09-03 17:59:06', '2025-09-04 15:14:27'),
(16, 'mentor', '$2y$10$Cv267e/3OQgilw9bvR4//.NBUAbgRr.YG/ZYpqaIeSiIflCc.gj4i', 'mentor@gmail.com', 'Mentor', '0126547893', 'District 1, HCM CIty', 4, '2025-09-03 17:59:49', '2025-09-04 15:15:30'),
(19, 'intern1', '$2y$10$m5DU2YZzFlAk6DKWorg9WeiIaN8..oeoYKM5.2YKuLIgCuOyuzIpW', 'intern1@gmail.com', 'Intern1', '0900000001', 'District 1', 5, '2025-09-04 15:16:45', '2025-09-04 15:34:43'),
(20, 'intern2', '$2y$10$ClX0MPa/xQfjGrtSnswJnuIs3sq6KQqVNy6hSJIKU6VSy8rDvjnsi', 'intern2@gmail.com', 'Intern2', '0900000002', 'District 2', 5, '2025-09-04 15:32:29', '2025-09-04 15:32:29'),
(21, 'intern3', '$2y$10$Mp1vnHTPKJsAY6/rQcOrE.2zekwYT3vd7mNUpvOaoEMZY1sDrooFq', 'intern3@gmail.com', 'Intern3', '0900000003', 'District 3', 5, '2025-09-04 15:33:32', '2025-09-04 15:33:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `campaign_id` (`campaign_id`);

--
-- Indexes for table `intern_evaluations`
--
ALTER TABLE `intern_evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intern_id` (`intern_id`),
  ADD KEY `evaluator_id` (`evaluator_id`);

--
-- Indexes for table `intern_feedback`
--
ALTER TABLE `intern_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intern_id` (`intern_id`),
  ADD KEY `feedback_provider_id` (`feedback_provider_id`);

--
-- Indexes for table `intern_skills`
--
ALTER TABLE `intern_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intern_id` (`intern_id`);

--
-- Indexes for table `interview_schedules`
--
ALTER TABLE `interview_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intern_id` (`intern_id`),
  ADD KEY `interviewer_id` (`interviewer_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `program_interns`
--
ALTER TABLE `program_interns`
  ADD PRIMARY KEY (`program_id`,`intern_id`),
  ADD KEY `intern_id` (`intern_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `training_programs`
--
ALTER TABLE `training_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coordinator_id` (`coordinator_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_roles` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `intern_evaluations`
--
ALTER TABLE `intern_evaluations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `intern_feedback`
--
ALTER TABLE `intern_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `intern_skills`
--
ALTER TABLE `intern_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `interview_schedules`
--
ALTER TABLE `interview_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `training_programs`
--
ALTER TABLE `training_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `interns`
--
ALTER TABLE `interns`
  ADD CONSTRAINT `fk_interns_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `intern_skills`
--
ALTER TABLE `intern_skills`
  ADD CONSTRAINT `intern_skills_ibfk_1` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program_interns`
--
ALTER TABLE `program_interns`
  ADD CONSTRAINT `program_interns_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `training_programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `program_interns_ibfk_2` FOREIGN KEY (`intern_id`) REFERENCES `interns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
