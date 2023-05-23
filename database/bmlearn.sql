-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 05:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmlearn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'vijayadmin', 'vijay@gmail.com', '7640e11924b46c880443297974fc3a9b');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `parent_id`, `comment`, `sender`, `date`) VALUES
(1, 0, 'vijay', 'vijay chavan', '2023-04-24 20:05:18'),
(2, 1, 'dcdjhscd', 'vijayd', '2023-04-24 20:05:43'),
(3, 0, 'cdhbjhcbd', 'sdbjasdcbhj', '2023-04-24 20:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `img_path`, `course`, `status`) VALUES
(1, 'Uploads/Courses/IMG_8932860217_BCA.png', 'BCA', 1),
(2, 'Uploads/Courses/IMG_5856573707_BBA.png', 'BBA', 1),
(3, 'Uploads/Courses/IMG_7241188048_BMS.png', 'BMS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `num` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `num`, `message`) VALUES
(1, 'vijay', 'vijsihcu', 'ubdhbh', 'bdhcjhbh');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `img_path`, `semester`, `course_id`, `status`) VALUES
(1, 'Uploads/Semesters/IMG_3886044595_SEM1.jpg', 'SEM1', 1, 1),
(2, 'Uploads/Semesters/IMG_7198161128_SEM2.jpg', 'SEM2', 1, 1),
(3, 'Uploads/Semesters/IMG_8215714752_SEM1.jpg', 'SEM1', 2, 1),
(4, 'Uploads/Semesters/IMG_2441210883_SEM2.jpg', 'SEM2', 2, 1),
(5, 'Uploads/Semesters/IMG_5309359750_SEM1.jpg', 'SEM1', 3, 1),
(6, 'Uploads/Semesters/IMG_5654845967_SEM2.jpg', 'SEM2', 3, 1),
(7, 'Uploads/Semesters/IMG_8233100556_SEM3.jpg', 'SEM3', 1, 1),
(8, 'Uploads/Semesters/IMG_5829405318_SEM4.jpg', 'SEM4', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `img_path`, `subject`, `semester_id`, `status`) VALUES
(1, 'Uploads/Subjects/IMG_2685085228_C.jpg', 'C', 1, 1),
(2, 'Uploads/Subjects/IMG_1573176254_CPP.jpg', 'CPP', 2, 1),
(3, 'Uploads/Subjects/IMG_2891752729_DS.jpg', 'DS', 3, 1),
(4, 'Uploads/Subjects/IMG_8810086521_DBMS.jpg', 'DBMS', 4, 1),
(5, 'Uploads/Subjects/IMG_6862025623_RDBMS.jpg', 'RDBMS', 5, 1),
(6, 'Uploads/Subjects/IMG_9046723686_PYTHON.jpg', 'PYTHON', 6, 1),
(7, 'Uploads/Subjects/IMG_8983998902_LINUX.jpg', 'LINUX', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `course_id` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `type` varchar(10) NOT NULL DEFAULT 'user',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `course_id`, `password`, `token`, `status`, `type`, `created_date`) VALUES
(1, 'ajay', 'ajaychavan3902@gmail.com', 1, '8e651dcf93b98a411b3c9a16e49fd576', '26209', 1, 'user', '2023-03-05 17:04:52'),
(2, 'shruti', 'shrutihole2003@gmail.com', 1, '54c69437736ea83175dc5f60b6ef4617', '37994', 1, 'user', '2023-03-05 19:32:17'),
(3, 'dvjnjkdvb', 'jdbvsjb@dchbhs.com', 2, 'd757a01a7e92773226bdf503e7e17c85', '29516', 0, 'user', '2023-03-19 11:56:24'),
(4, 'vfbhsbhj', 'vijaychavanvc2601@gmail.com', 1, 'd757a01a7e92773226bdf503e7e17c85', '55540', 1, 'user', '2023-03-19 11:59:28'),
(5, 'vijay', 'madysore10@gmail.com', 2, '7640e11924b46c880443297974fc3a9b', '87965', 1, 'user', '2023-04-22 16:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `video_path` varchar(255) NOT NULL,
  `video` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `img_path`, `video_path`, `video`, `description`, `subject_id`, `status`) VALUES
(2, 'Uploads/Videos/IMG_4571211167_VIDEO2.png', 'Uploads/Videos/VID_5157478120_VIDEO2.mp4', 'VIDEO2', 'hvgvgv', 1, 1),
(3, 'Uploads/Videos/IMG_1758671357_VIDEO3.jpg', 'Uploads/Videos/VID_5570276378_VIDEO3.mp4', 'VIDEO3', 'this is a decription', 3, 1),
(4, 'Uploads/Videos/IMG_3854614882_VIJAY_C_1.jpeg', 'Uploads/Videos/VID_9407265436_VIJAY_C_1.mp4', 'VIJAY_C_1', 'this is video of c programming', 1, 1),
(5, 'Uploads/Videos/IMG_2238987088_VIJAY1_CPROGRAMMING.png', 'Uploads/Videos/VID_2243603113_VIJAY1_CPROGRAMMING.mp4', 'VIJAY1_CPROGRAMMING', 'this is video 1', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `semester_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`),
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
