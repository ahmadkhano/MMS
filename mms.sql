-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 02:18 AM
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
-- Database: `mms`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_student`
--

CREATE TABLE `add_student` (
  `id` int(25) NOT NULL,
  `registration_number` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `admission_date` date NOT NULL,
  `current_address` varchar(100) NOT NULL,
  `permanent_address` varchar(100) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `admission_fee` int(25) NOT NULL,
  `guardian_relation` varchar(50) NOT NULL,
  `guardian_noc` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `previous_grade` varchar(50) NOT NULL,
  `current_grade` varchar(50) NOT NULL,
  `year` varchar(11) NOT NULL,
  `gender` varchar(50) NOT NULL COMMENT '1,0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_student`
--

INSERT INTO `add_student` (`id`, `registration_number`, `student_name`, `father_name`, `dob`, `admission_date`, `current_address`, `permanent_address`, `contact_number`, `admission_fee`, `guardian_relation`, `guardian_noc`, `status`, `previous_grade`, `current_grade`, `year`, `gender`) VALUES
(50, 3, '3', '33', '0003-03-31', '3333-03-31', '333', '33', '3', 3, '3', '3', 'جدیده', 'Grade A', 'Grade B', '2025', 'طالب العلم'),
(51, 12, 'Student 1', 'Father 1', '2025-02-01', '2025-02-03', 'Bodigram', 'Lahore', '03409078818', 444, 'Father', 'Approved', 'جدیده', 'Grade B', 'Grade B', '2025', 'طالب العلم'),
(52, 1, 'احمد شاہ ابدالی خان', 'محمّد خان', '2025-01-29', '2025-02-07', 'بودیگرام مٹہ سوات', 'Lahore', '03409078818', 444, 'باپ', 'NOC: Approved', 'قدیمہ', 'Grade B', 'Grade B', '2025', 'طالب العلم'),
(53, 12, 'Hanzala', 'Ashgar Khan', '2025-02-01', '2025-02-03', 'Bodigram', 'Bodigram', '03409078818', 444, 'Father', 'Approved', 'قدیمہ', 'Grade A', 'Grade B', '2025', 'طالب العلم');

-- --------------------------------------------------------

--
-- Table structure for table `add_subject`
--

CREATE TABLE `add_subject` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_subject`
--

INSERT INTO `add_subject` (`id`, `subject_name`) VALUES
(16, 'CSS'),
(17, 'CSS'),
(18, 'CSS'),
(19, 'CSS'),
(20, 'CSS'),
(22, 'CSS'),
(23, 'CSS'),
(25, 'CSS'),
(26, 'CSS'),
(27, 'CSS'),
(28, 'CSS'),
(29, 'HTML');

-- --------------------------------------------------------

--
-- Table structure for table `add_teacher`
--

CREATE TABLE `add_teacher` (
  `id` int(11) NOT NULL,
  `registration_number` int(25) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `admission_date` date NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_teacher`
--

INSERT INTO `add_teacher` (`id`, `registration_number`, `teacher_name`, `father_name`, `dob`, `complete_address`, `admission_date`, `contact_number`, `status`, `designation`, `gender`) VALUES
(148, 3, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(150, 1, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(151, 12, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(152, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(153, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(154, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(155, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(156, 1, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(157, 4, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(158, 3, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(159, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(160, 2, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(161, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(162, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(163, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(164, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(165, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(166, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(167, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(168, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(169, 12, 'Ahmad Shah', 'Father 1', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(170, 1, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(171, 12, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(172, 4, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(173, 122, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(174, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(175, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(176, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(177, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(178, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(179, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(180, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(181, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(182, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(183, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(184, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(185, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(186, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(187, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(188, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(189, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(190, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(191, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(192, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(193, 1, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(194, 1, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(195, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(196, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(197, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(198, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(199, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(200, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(201, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(202, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(203, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(204, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(205, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(206, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(207, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(208, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(209, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(210, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(211, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(212, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(213, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(214, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(215, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(216, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(217, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(218, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(219, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(220, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(221, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(222, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(223, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(224, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(225, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(226, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(227, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(228, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(229, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(230, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(231, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(232, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(233, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(234, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(235, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(236, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(237, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(238, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(239, 12121, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(240, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(241, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(242, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(243, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(244, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(245, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(246, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(247, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(248, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(249, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(250, 102, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(251, 2323, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(252, 42432, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(253, 544, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(254, 544, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(255, 4242, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(256, 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(257, 4535, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'قاری صاحب'),
(259, 42433, 'احمد شاہ ابدالی خان	', 'محمّد خان', '1999-07-06', 'بودیگرام مٹہ سوات', '2025-02-07', '03409078818', 'غیر موجود', 'Example Designation', 'قاری صاحب');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `pass`) VALUES
(1, 'Ahmad', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `assign_subject`
--

CREATE TABLE `assign_subject` (
  `id` int(11) NOT NULL,
  `assign_subject_grade` varchar(250) NOT NULL,
  `assign_subject_subject` varchar(250) NOT NULL,
  `assign_subject_teacher` varchar(250) NOT NULL,
  `assign_subject_total_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_subject`
--

INSERT INTO `assign_subject` (`id`, `assign_subject_grade`, `assign_subject_subject`, `assign_subject_teacher`, `assign_subject_total_marks`) VALUES
(1, '01', 'CSS', 'Ahmad', 100);

-- --------------------------------------------------------

--
-- Table structure for table `datesheet`
--

CREATE TABLE `datesheet` (
  `id` int(11) NOT NULL,
  `datesheet_grade` varchar(250) NOT NULL,
  `datesheet_subject` varchar(250) NOT NULL,
  `datesheet_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `exam_name` varchar(250) NOT NULL,
  `exam_status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `exam_name`, `exam_status`) VALUES
(1, 'سالانہ', 'ختم');

-- --------------------------------------------------------

--
-- Table structure for table `fee_menu`
--

CREATE TABLE `fee_menu` (
  `id` int(25) NOT NULL,
  `registration_number` int(25) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `admission_fee` int(12) NOT NULL,
  `admission_date` date NOT NULL,
  `concision` varchar(25) NOT NULL,
  `reason_of_concision` varchar(100) NOT NULL,
  `grade` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_menu`
--

INSERT INTO `fee_menu` (`id`, `registration_number`, `student_name`, `dob`, `admission_fee`, `admission_date`, `concision`, `reason_of_concision`, `grade`) VALUES
(6, 12, 'احمد شاہ ابدالی خان', '2025-01-01', 444, '2025-01-05', '40', 'Orphan', '04');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(25) NOT NULL,
  `grade_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `grade_name`) VALUES
(38, 'پہلا درجہ');

-- --------------------------------------------------------

--
-- Table structure for table `grade_fees`
--

CREATE TABLE `grade_fees` (
  `id` int(11) NOT NULL,
  `grade_id` varchar(255) NOT NULL,
  `fees` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_fees`
--

INSERT INTO `grade_fees` (`id`, `grade_id`, `fees`) VALUES
(6, 'پہلا درجہ', '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `grade_sections`
--

CREATE TABLE `grade_sections` (
  `id` int(11) NOT NULL,
  `grade_id` varchar(250) NOT NULL,
  `section_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_sections`
--

INSERT INTO `grade_sections` (`id`, `grade_id`, `section_id`) VALUES
(9, 'پہلا درجہ', 'EXAMPLE SECTION');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `message`) VALUES
(3, 'Ahmad Shah Abdali Khan', 'Ahmadshah746148@gmail.com', '03409078818', 'Dummy Message');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`) VALUES
(7, 'EXAMPLE SECTION');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_designation`
--

CREATE TABLE `teacher_designation` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_designation`
--

INSERT INTO `teacher_designation` (`id`, `designation`) VALUES
(14, 'Example Designation');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(11) NOT NULL,
  `year_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `year_name`) VALUES
(5, '2025'),
(6, 'پہلا');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_student`
--
ALTER TABLE `add_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_subject`
--
ALTER TABLE `add_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_teacher`
--
ALTER TABLE `add_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_subject`
--
ALTER TABLE `assign_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datesheet`
--
ALTER TABLE `datesheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_menu`
--
ALTER TABLE `fee_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_fees`
--
ALTER TABLE `grade_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_sections`
--
ALTER TABLE `grade_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_designation`
--
ALTER TABLE `teacher_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_student`
--
ALTER TABLE `add_student`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `add_subject`
--
ALTER TABLE `add_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `add_teacher`
--
ALTER TABLE `add_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `assign_subject`
--
ALTER TABLE `assign_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `datesheet`
--
ALTER TABLE `datesheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fee_menu`
--
ALTER TABLE `fee_menu`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `grade_fees`
--
ALTER TABLE `grade_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grade_sections`
--
ALTER TABLE `grade_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacher_designation`
--
ALTER TABLE `teacher_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
