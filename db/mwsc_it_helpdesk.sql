-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2021 at 12:53 PM
-- Server version: 10.6.5-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mwsc_it_helpdesk`
--
CREATE DATABASE IF NOT EXISTS `mwsc_it_helpdesk` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mwsc_it_helpdesk`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_date` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `person` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `comments`
--

TRUNCATE TABLE `comments`;
--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_date`, `comment_desc`, `ticket_id`, `person`) VALUES
(1, 'Mon, 13 Dec 2021 14:31:09', 'Thu', 9, 'Geoffrey Cheelo');

-- --------------------------------------------------------

--
-- Table structure for table `it_staff`
--

CREATE TABLE `it_staff` (
  `staff_id` int(11) NOT NULL,
  `man_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `usr_password` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `it_staff`
--

TRUNCATE TABLE `it_staff`;
--
-- Dumping data for table `it_staff`
--

INSERT INTO `it_staff` (`staff_id`, `man_no`, `full_name`, `email_address`, `department`, `job_title`, `role`, `usr_password`) VALUES
(1, 'M0000', 'Administrator', 'administrator@mwsc.com.zm', 'IT', 'IT Operations ', 'Administrator', 'Mul0ng@D7D7'),
(2, 'M1173', 'Chola Simwizye', 'chola.simwizye@mwsc.com.zm', 'IT', 'IT Manager', 'Super User', 'Welcome@1'),
(3, 'M1097', 'Ruth Yamba Chibwaya', 'yambar@outlook.com', 'IT', 'Systems Administrator', 'Super User', 'Mul0ng@D7D7'),
(4, 'M0720', 'Geoffrey Cheelo', 'cheelojef@mwsc.com.zm', 'IT', 'IT Officer', 'Administrator', 'Mul0ng@D7D7'),
(5, 'M1231', 'Cosmas Chali', 'cosmas.chali@mwsc.com.zm', 'IT', 'IT Officer', 'Administrator', 'Mul0ng@D7D7'),
(6, 'M1097', 'Phillip Chamfya', 'phillip.chamfya@mwsc.com.zm', 'IT', 'IT Officer', 'Administrator', 'Mul0ng@D7D7');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fault_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_status` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_closed` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_no` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `tickets`
--

TRUNCATE TABLE `tickets`;
--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_type_id`, `user_id`, `fault_time`, `ticket_desc`, `ticket_status`, `date_closed`, `ticket_no`, `action`) VALUES
(1, 1, 2, '08 Dec 2021 15:20:04', 'i can\'t connect', 'Closed', 'Thu, 09 Dec 2021 09:11:37', '2021-12-08-203', 'I have worked on it'),
(2, 2, 2, '09 Dec 2021 09:12:43', 'My laptop can\'t connect to the internet', 'Closed', 'Mon, 13 Dec 2021 10:42:10', '2021-12-09-273', 'Closed Issue'),
(3, 1, 2, '10 Dec 2021 13:27:49', 'connection error', 'Closed', 'Mon, 13 Dec 2021 10:42:30', '2021-12-10-507', 'Closed'),
(4, 2, 2, '10 Dec 2021 13:28:32', '', 'Closed', 'Mon, 13 Dec 2021 10:42:56', '2021-12-10-208', 'Sorted'),
(5, 3, 2, '10 Dec 2021 13:29:03', '', 'Closed', 'Mon, 13 Dec 2021 10:43:16', '2021-12-10-42', 'Sorted'),
(6, 8, 2, '13 Dec 2021 14:26:10', '', 'Overdue', '', '2021-12-13-828', NULL),
(7, 2, 2, '13 Dec 2021 14:26:47', '', 'Closed', '', '2021-12-13-2', NULL),
(8, 13, 2, '13 Dec 2021 14:28:17', '', 'Overdue', '', '2021-12-13-103', NULL),
(9, 2, 2, '13 Dec 2021 14:29:24', '', 'Closed', 'Mon, 13 Dec 2021 14:31:30', '2021-12-13-695', 'Thius'),
(10, 14, 2, '13 Dec 2021 14:32:26', '', 'Overdue', '', '2021-12-13-162', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type`
--

CREATE TABLE `ticket_type` (
  `ticket_type_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `ticket_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `problem_desc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_sla` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `ticket_type`
--

TRUNCATE TABLE `ticket_type`;
--
-- Dumping data for table `ticket_type`
--

INSERT INTO `ticket_type` (`ticket_type_id`, `staff_id`, `ticket_type`, `problem_desc`, `ticket_sla`) VALUES
(1, 4, 'Network Problems', 'Failure to connect to MWSC LAN', '120'),
(2, 4, 'Network Problems', 'Failure connect to the internet', '60'),
(3, 4, 'Network Problems', 'Wi-Fi not responding', '60'),
(4, 3, 'Microsoft Exchange', 'Failure to Connect to Outlook', '60'),
(5, 3, 'Microsoft Exchange', 'Pulling Mail Archives', '60'),
(6, 3, 'Microsoft Exchange', 'Missing Mails', '60'),
(7, 3, 'Microsoft Exchange', 'Failure to Send/Receive', '60'),
(8, 6, 'Password / Profile Problems', 'Password Reset', '60'),
(9, 6, 'Password / Profile Problems', 'Creation of User Profile', '60'),
(10, 3, 'Software Problems', 'Operating System Update', '60'),
(11, 3, 'Software Problems', 'Office App problems (word, excel...)', '60'),
(12, 3, 'Software Problems', 'Dynamics Navision Configuration', '60'),
(13, 5, 'Software Problems', 'Dynamics Navision Error', '120'),
(14, 3, 'Software Problems', 'Sophos Installation and Update', '120'),
(15, 3, 'Software Problems', 'Promun Installation and Configuration', '120'),
(16, 5, 'Software Problems', 'Promun Error', '100'),
(17, 5, 'Hardware Problems', 'Printer Problems', '60'),
(18, 5, 'Hardware Problems', 'Pc not going on', '120'),
(19, 5, 'Hardware Problems', 'PC is slow', '120'),
(20, 5, 'Hardware Problems', 'Scanner not going on', '120'),
(21, 5, 'Car Tracking', 'Car Tracking', '100'),
(22, 3, 'Other (Describe)', 'Other', '240');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `man_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `usr_password` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `man_no`, `full_name`, `email_address`, `department`, `job_title`, `role`, `usr_password`) VALUES
(2, 'M111', 'Niza Tembo', 'mcwayzj@gmail.com', 'Accounts', 'Intern', 'User', 'Mcwayz'),
(3, 'M1175', 'Sila Siame', 'sila.siame@mwsc.com.zm', 'Finance', 'DF', 'User', 'Password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comments_ibfk_1` (`ticket_id`);

--
-- Indexes for table `it_staff`
--
ALTER TABLE `it_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `tickets_ibfk_1` (`ticket_type_id`),
  ADD KEY `tickets_ibfk_2` (`user_id`);

--
-- Indexes for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`ticket_type_id`),
  ADD KEY `ticket_type_ibfk_1` (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `it_staff`
--
ALTER TABLE `it_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `ticket_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`ticket_type_id`) REFERENCES `ticket_type` (`ticket_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD CONSTRAINT `ticket_type_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `it_staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
