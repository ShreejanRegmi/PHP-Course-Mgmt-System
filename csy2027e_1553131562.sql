-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2019 at 06:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csy2027e`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `a_id` int(11) NOT NULL,
  `s_firstname` varchar(255) NOT NULL,
  `s_lastname` varchar(255) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `s_contact` varchar(255) NOT NULL,
  `s_dob` date NOT NULL,
  `s_email` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `intake` int(4) NOT NULL,
  `s_qualifications` longtext NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `asn_id` int(11) NOT NULL,
  `asn_title` varchar(255) NOT NULL,
  `asn_details` varchar(255) NOT NULL,
  `asn_start` date NOT NULL,
  `asn_end` date NOT NULL,
  `m_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `date` date NOT NULL,
  `s_id` int(11) NOT NULL,
  `m_code` varchar(5) NOT NULL,
  `status` enum('A','X','O') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `e_id` int(11) NOT NULL,
  `e_title` varchar(255) NOT NULL,
  `e_details` varchar(255) NOT NULL,
  `e_date` date NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `m_code` varchar(5) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_points` int(2) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `n_id` int(11) NOT NULL,
  `n_title` varchar(255) NOT NULL,
  `n_details` varchar(255) NOT NULL,
  `n_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pat_session`
--

CREATE TABLE `pat_session` (
  `session_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `query` varchar(255) NOT NULL,
  `summary` longtext,
  `attended` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_id` int(11) NOT NULL,
  `s_firstname` varchar(255) NOT NULL,
  `s_lastname` varchar(255) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `s_contact` varchar(255) NOT NULL,
  `s_dob` date NOT NULL,
  `s_email` varchar(255) NOT NULL,
  `s_password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `intake` int(4) NOT NULL,
  `s_qualifications` longtext NOT NULL,
  `t_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_modules`
--

CREATE TABLE `student_modules` (
  `sm_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `m_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_timetable`
--

CREATE TABLE `student_timetable` (
  `timetable_id` int(11) NOT NULL,
  `level` int(1) NOT NULL,
  `day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submitted_assignments`
--

CREATE TABLE `submitted_assignments` (
  `submission_id` int(11) NOT NULL,
  `asn_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `submission_date` date NOT NULL,
  `grade` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s_modules_group`
--

CREATE TABLE `s_modules_group` (
  `sm_id` int(11) NOT NULL,
  `s_group` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s_timetable_modules`
--

CREATE TABLE `s_timetable_modules` (
  `timetable_id` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `m_code` varchar(5) DEFAULT NULL,
  `class_type` enum('Lecture','Tutorial') NOT NULL,
  `room_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `t_id` int(11) NOT NULL,
  `t_firstname` varchar(255) NOT NULL,
  `t_lastname` varchar(255) NOT NULL,
  `t_address` varchar(255) NOT NULL,
  `t_contact` varchar(255) NOT NULL,
  `t_email` varchar(255) NOT NULL,
  `t_password` varchar(255) NOT NULL,
  `t_status` enum('live','dormant') NOT NULL,
  `t_status_reason` enum('retired','resigned','misconduct') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers_timetable`
--

CREATE TABLE `teachers_timetable` (
  `t_timetable_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_modules`
--

CREATE TABLE `teacher_modules` (
  `t_id` int(11) NOT NULL,
  `m_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_timetable_description`
--

CREATE TABLE `t_timetable_description` (
  `t_timetable_id` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `m_code` varchar(5) DEFAULT NULL,
  `s_group` enum('1','2','3','4','5') NOT NULL,
  `room_code` varchar(5) NOT NULL,
  `class_type` enum('Lecture','Practical') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`asn_id`),
  ADD KEY `m_id` (`m_code`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`date`,`s_id`,`m_code`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `m_code` (`m_code`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`m_code`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `pat_session`
--
ALTER TABLE `pat_session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `t_id` (`t_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `t_id` (`t_id`);

--
-- Indexes for table `student_modules`
--
ALTER TABLE `student_modules`
  ADD PRIMARY KEY (`sm_id`),
  ADD KEY `student_id` (`s_id`),
  ADD KEY `module_code` (`m_code`);

--
-- Indexes for table `student_timetable`
--
ALTER TABLE `student_timetable`
  ADD PRIMARY KEY (`timetable_id`);

--
-- Indexes for table `submitted_assignments`
--
ALTER TABLE `submitted_assignments`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `asn_id` (`asn_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `s_modules_group`
--
ALTER TABLE `s_modules_group`
  ADD PRIMARY KEY (`sm_id`,`s_group`),
  ADD KEY `sm_id` (`sm_id`);

--
-- Indexes for table `s_timetable_modules`
--
ALTER TABLE `s_timetable_modules`
  ADD PRIMARY KEY (`timetable_id`,`time`),
  ADD KEY `timetable_id` (`timetable_id`),
  ADD KEY `m_code` (`m_code`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `teachers_timetable`
--
ALTER TABLE `teachers_timetable`
  ADD PRIMARY KEY (`t_timetable_id`);

--
-- Indexes for table `teacher_modules`
--
ALTER TABLE `teacher_modules`
  ADD PRIMARY KEY (`t_id`,`m_code`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `m_code` (`m_code`);

--
-- Indexes for table `t_timetable_description`
--
ALTER TABLE `t_timetable_description`
  ADD PRIMARY KEY (`t_timetable_id`,`time`),
  ADD KEY `t_timetable_id` (`t_timetable_id`),
  ADD KEY `m_code` (`m_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `asn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pat_session`
--
ALTER TABLE `pat_session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_modules`
--
ALTER TABLE `student_modules`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_timetable`
--
ALTER TABLE `student_timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submitted_assignments`
--
ALTER TABLE `submitted_assignments`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers_timetable`
--
ALTER TABLE `teachers_timetable`
  MODIFY `t_timetable_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `fk_a_modules` FOREIGN KEY (`m_code`) REFERENCES `modules` (`m_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `fk_at_modules` FOREIGN KEY (`m_code`) REFERENCES `modules` (`m_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_at_students` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_e_students` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_n_students` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pat_session`
--
ALTER TABLE `pat_session`
  ADD CONSTRAINT `fk_ps_student` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ps_teachers` FOREIGN KEY (`t_id`) REFERENCES `teachers` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_s_teachers` FOREIGN KEY (`t_id`) REFERENCES `teachers` (`t_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `student_modules`
--
ALTER TABLE `student_modules`
  ADD CONSTRAINT `fk_sm_modules` FOREIGN KEY (`m_code`) REFERENCES `modules` (`m_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sm_students` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `submitted_assignments`
--
ALTER TABLE `submitted_assignments`
  ADD CONSTRAINT `fk_sa_assignments` FOREIGN KEY (`asn_id`) REFERENCES `assignments` (`asn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sa_students` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `s_modules_group`
--
ALTER TABLE `s_modules_group`
  ADD CONSTRAINT `fk_smg_student_modules` FOREIGN KEY (`sm_id`) REFERENCES `student_modules` (`sm_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `s_timetable_modules`
--
ALTER TABLE `s_timetable_modules`
  ADD CONSTRAINT `fk_stm_modules` FOREIGN KEY (`m_code`) REFERENCES `modules` (`m_code`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stm_student_timetables` FOREIGN KEY (`timetable_id`) REFERENCES `student_timetable` (`timetable_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_modules`
--
ALTER TABLE `teacher_modules`
  ADD CONSTRAINT `fk_tm_modules` FOREIGN KEY (`m_code`) REFERENCES `modules` (`m_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tm_teachers` FOREIGN KEY (`t_id`) REFERENCES `teachers` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_timetable_description`
--
ALTER TABLE `t_timetable_description`
  ADD CONSTRAINT `fk_ttd_modules` FOREIGN KEY (`m_code`) REFERENCES `modules` (`m_code`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ttd_teachers_timetable` FOREIGN KEY (`t_timetable_id`) REFERENCES `teachers_timetable` (`t_timetable_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
