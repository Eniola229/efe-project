-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2025 at 10:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `dob` text NOT NULL,
  `contact` text NOT NULL,
  `address` varchar(500) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `created_on` date NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `fname`, `lname`, `gender`, `dob`, `contact`, `address`, `image`, `created_on`, `group_id`) VALUES
(1, 'admin', 'ndbhalerao91@gmail.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Nikhil', 'Bhalerao', 'Male', '1988-05-29', '9423979339', 'Nashik', '20141025_004121_918_Developer.png', '2018-04-30', 1),
(6, 'admin', 'admin@gmail.com', 'aa7f019c326413d5b8bcad4314228bcd33ef557f5d81c7cc977f7728156f4357', 'Admin', 'admin', 'Male', '2019-01-13', '7412589636', 'pune', 'Koala.jpg', '2019-01-26', 1),
(7, 'user', 'joshuaaeyemi445@gmail.com', '82ebf3b94a396d67f3a0b0e99acf697d37cb0861a98ea820c8a886d0758e1a32', 'Joshua', 'Adeyemi', 'Male', '2025-06-30', '0907991680', 'rectem', '', '2025-07-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `allot`
--

CREATE TABLE `allot` (
  `id` int(60) NOT NULL,
  `room_id` int(11) NOT NULL,
  `class_id` int(50) NOT NULL,
  `room_type_id` int(60) NOT NULL,
  `subject_id` int(50) NOT NULL,
  `exam_id` int(50) NOT NULL,
  `added_date` date NOT NULL,
  `exam_date` varchar(20) NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `invigilator1` int(11) DEFAULT NULL,
  `cap` varchar(50) NOT NULL,
  `exam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allot`
--

INSERT INTO `allot` (`id`, `room_id`, `class_id`, `room_type_id`, `subject_id`, `exam_id`, `added_date`, `exam_date`, `start_time`, `end_time`, `invigilator1`, `cap`, `exam`) VALUES
(14, 2, 2, 2, 2, 7, '2021-08-02', '2021-08-02', '13:00', '14:00', 1, '300', 0),
(16, 1, 1, 6, 1, 6, '2021-08-02', '2021-08-02', '13:00', '14:00', 2, '10', 0),
(17, 1, 1, 6, 1, 0, '0000-00-00', '2021-08-02', '13:00', '14:00', 1, '10', 6),
(18, 2, 2, 2, 2, 0, '2021-08-02', '2021-08-02', '13:00', '14:00', 2, '300', 7);

-- --------------------------------------------------------

--
-- Table structure for table `allot_student`
--

CREATE TABLE `allot_student` (
  `id` int(100) NOT NULL,
  `allot_id` int(60) NOT NULL,
  `exam_id` int(50) NOT NULL,
  `exam_date` date NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `room_id` int(50) NOT NULL,
  `student_id` int(50) NOT NULL,
  `teacher_id` int(50) DEFAULT NULL,
  `stud_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allot_student`
--

INSERT INTO `allot_student` (`id`, `allot_id`, `exam_id`, `exam_date`, `start_time`, `end_time`, `room_id`, `student_id`, `teacher_id`, `stud_id`) VALUES
(2, 5, 2, '2021-08-01', '15:00', '17:00', 2, 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(60) NOT NULL,
  `class_id` int(50) NOT NULL,
  `subject_id` int(50) NOT NULL,
  `exam_date` date NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `added_date` date NOT NULL,
  `examname` varchar(100) NOT NULL,
  `lecturer` int(12) NOT NULL,
  `Course_Code` varchar(20) NOT NULL,
  `hall` varchar(20) NOT NULL,
  `class_size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `class_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `name`, `added_date`, `examname`, `lecturer`, `Course_Code`, `hall`, `class_size`) VALUES
(8, 0, 0, '2025-07-08', '11:47', '00:49', 'SYSTEM PROGRAMING ', '0000-00-00', '', 0, 'COM122', 'Complx 122', '21');

-- --------------------------------------------------------

--
-- Table structure for table `invigilators`
--

CREATE TABLE `invigilators` (
  `id` int(100) NOT NULL,
  `allot_id` int(60) NOT NULL,
  `exam_id` int(50) NOT NULL,
  `exam_date` date NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `room_id` int(50) NOT NULL,
  `teacher1_id` int(50) NOT NULL,
  `teacher2_id` int(50) DEFAULT NULL,
  `teacher3_id` int(50) NOT NULL,
  `cap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_website`
--

CREATE TABLE `manage_website` (
  `id` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `short_title` varchar(600) NOT NULL,
  `logo` text NOT NULL,
  `footer` text NOT NULL,
  `currency_code` varchar(600) NOT NULL,
  `currency_symbol` varchar(600) NOT NULL,
  `login_logo` text NOT NULL,
  `invoice_logo` text NOT NULL,
  `background_login_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `manage_website`
--

INSERT INTO `manage_website` (`id`, `title`, `short_title`, `logo`, `footer`, `currency_code`, `currency_symbol`, `login_logo`, `invoice_logo`, `background_login_image`) VALUES
(1, 'Exam Invigilator Scheduling System', 'EISS', 'logo3.png', 'Yaba College of Technology', 'Naira', 'N', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(30) NOT NULL,
  `type_id` int(60) NOT NULL,
  `name` varchar(30) NOT NULL,
  `strenght` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `type_id`, `name`, `strenght`) VALUES
(1, 6, 'Complx 122', '30'),
(2, 2, 'College Hall', '500');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` int(30) NOT NULL,
  `roomname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `roomname`) VALUES
(2, 'Lecture Hall'),
(3, 'Laboratory'),
(4, 'Theatre'),
(5, 'Library'),
(6, 'Classroom'),
(7, 'Sport Complex'),
(8, 'Hall 2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `id` int(30) NOT NULL,
  `classname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`id`, `classname`) VALUES
(2, 'ND2'),
(3, 'HND1'),
(4, 'HND2'),
(5, 'ND1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_config`
--

CREATE TABLE `tbl_email_config` (
  `e_id` int(21) NOT NULL,
  `name` varchar(500) NOT NULL,
  `mail_driver_host` varchar(5000) NOT NULL,
  `mail_port` int(50) NOT NULL,
  `mail_username` varchar(50) NOT NULL,
  `mail_password` varchar(30) NOT NULL,
  `mail_encrypt` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_email_config`
--

INSERT INTO `tbl_email_config` (`e_id`, `name`, `mail_driver_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encrypt`) VALUES
(1, '<student register> ', 'mail.gmail.com', 587, 'ndbhalerao91@gmail.com', 'abc@123', 'sdsad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE `tbl_group` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `name`, `description`) VALUES
(1, 'admin', 'admin'),
(4, 'user1', 'user1'),
(5, 'user2', 'user2'),
(6, 'user3', 'class nd sub adding'),
(7, 'user4', 'user permissin'),
(8, 'liu', 'liu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invigilator`
--

CREATE TABLE `tbl_invigilator` (
  `id` int(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `classname` varchar(30) NOT NULL,
  `subjectname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `contact` int(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `display_name` varchar(200) NOT NULL,
  `operation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_permission`
--

INSERT INTO `tbl_permission` (`id`, `name`, `display_name`, `operation`) VALUES
(1, 'manage_student', 'Manage Student', 'manage_student'),
(2, 'add_student', 'Add Student', 'add_student'),
(3, 'edit_student', 'Edit Student', 'edit_student'),
(4, 'delete_student', 'Delete Student', 'delete_student'),
(5, 'manage_teacher', 'Manage Teacher', 'manage_teacher'),
(6, 'add_teacher', 'Add Teacher', 'add_teacher'),
(7, 'edit_teacher', 'Edit Teacher', 'edit_teacher'),
(8, 'delete_teacher', 'Delete Teacher', 'delete_teacher'),
(9, 'manage_subject', 'Manage Subject', 'manage_subject'),
(10, 'add_subject', 'Add Subject', 'add_subject'),
(11, 'edit_subject', 'Edit Subject', 'edit_subject'),
(12, 'delete_subject', 'Delete Subject', 'delete_subject'),
(13, 'manage_class', 'Manage Class', 'manage_class'),
(14, 'add_class', 'Add Class', 'add_class'),
(15, 'edit_class', 'Edit Class', 'edit_class'),
(16, 'delete_class', 'Delete Class', 'delete_class'),
(21, 'manage_user', 'Manage User', 'manage_user'),
(22, 'add_user', 'Add User', 'add_user'),
(23, 'edit_user', 'Edit User', 'edit_user'),
(24, 'delete_user', 'Delete User', 'delete_user'),
(25, 'manage_exam', 'Manage Exam', 'manage_exam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission_role`
--

CREATE TABLE `tbl_permission_role` (
  `id` int(30) NOT NULL,
  `permission_id` int(30) NOT NULL,
  `role_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_permission_role`
--

INSERT INTO `tbl_permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 1),
(21, 21, 1),
(22, 22, 1),
(23, 23, 1),
(24, 24, 1),
(27, 25, 1),
(28, 21, 7),
(29, 22, 7),
(30, 23, 7),
(31, 24, 7),
(32, 1, 5),
(33, 2, 5),
(34, 10, 5),
(35, 14, 5),
(36, 1, 4),
(37, 5, 4),
(38, 6, 4),
(39, 9, 4),
(40, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms_config`
--

CREATE TABLE `tbl_sms_config` (
  `smsid` int(20) NOT NULL,
  `senderid` int(20) NOT NULL,
  `sms_username` varchar(30) NOT NULL,
  `sms_password` varchar(20) NOT NULL,
  `auth_key` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_sms_config`
--

INSERT INTO `tbl_sms_config` (`smsid`, `senderid`, `sms_username`, `sms_password`, `auth_key`) VALUES
(1, 101, 'username', 'password', 'authkey');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL,
  `stud_id` varchar(50) NOT NULL,
  `sfname` varchar(30) NOT NULL,
  `slname` varchar(30) NOT NULL,
  `classname` varchar(30) NOT NULL,
  `semail` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `sgender` varchar(30) NOT NULL,
  `sdob` date NOT NULL,
  `scontact` int(50) NOT NULL,
  `saddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `id` int(30) NOT NULL,
  `class_id` int(60) NOT NULL,
  `subjectname` varchar(30) NOT NULL,
  `course_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`id`, `class_id`, `subjectname`, `course_code`) VALUES
(0, 2, 'SYSTEM PROGRAMING ', 'COM122'),
(1, 1, 'JAVA', 'COM222'),
(2, 2, 'Algorithm (com123)', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `staff_id` int(11) DEFAULT NULL,
  `id` int(50) NOT NULL,
  `tfname` varchar(50) NOT NULL,
  `tlname` varchar(50) NOT NULL,
  `classname` varchar(30) NOT NULL,
  `subjectname` varchar(50) NOT NULL,
  `temail` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `tgender` varchar(50) NOT NULL,
  `tdob` date NOT NULL,
  `tcontact` int(50) NOT NULL,
  `taddress` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `tcategory` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`staff_id`, `id`, `tfname`, `tlname`, `classname`, `subjectname`, `temail`, `password`, `tgender`, `tdob`, `tcontact`, `taddress`, `role`, `tcategory`) VALUES
(0, 0, 'joshua', 'adeyemi', '', '', 'joshuaadeyemi445@gmail.com', '82ebf3b94a396d67f3a0b0e99acf697d37cb0861a98ea820c8a886d0758e1a32', 'Male', '2025-06-29', 2147483647, '', 'non-academic', 'Technologist'),
(NULL, 1, 'Olamide', 'Olukoya', '1', '1', 'olukoya@gmail.com', '5a5f9ebeeb1f5d1f692b5d6336c994c5d9ef029b1f34fdf2354ef9465ee2aec0', 'Male', '2021-08-18', 903777221, '23, tola fewer, surulrer, Lagos.', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allot`
--
ALTER TABLE `allot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allot_student`
--
ALTER TABLE `allot_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invigilators`
--
ALTER TABLE `invigilators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_website`
--
ALTER TABLE `manage_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invigilator`
--
ALTER TABLE `tbl_invigilator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_permission_role`
--
ALTER TABLE `tbl_permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sms_config`
--
ALTER TABLE `tbl_sms_config`
  ADD PRIMARY KEY (`smsid`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `allot`
--
ALTER TABLE `allot`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `allot_student`
--
ALTER TABLE `allot_student`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invigilators`
--
ALTER TABLE `invigilators`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_website`
--
ALTER TABLE `manage_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_email_config`
--
ALTER TABLE `tbl_email_config`
  MODIFY `e_id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_invigilator`
--
ALTER TABLE `tbl_invigilator`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
