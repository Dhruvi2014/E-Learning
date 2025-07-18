-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 03:31 PM
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
-- Database: `e_learning_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `about_id` int(10) NOT NULL,
  `about` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`about_id`, `about`) VALUES
(1, 'We Design A Perfect Logo For You To See Our Logos Just Visit Our Logo Page By Read More Button We Design A Perfect Logo For You To See Our Logos Just Visit Our Logo Page By Read More Button');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(10) NOT NULL,
  `a_name` varchar(32) NOT NULL,
  `a_email` varchar(32) NOT NULL,
  `a_pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_email`, `a_pass`) VALUES
(2, 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `ip_add` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `cat_id` int(10) NOT NULL,
  `cat_name` varchar(20) NOT NULL,
  `cat_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`cat_id`, `cat_name`, `cat_icon`) VALUES
(1, 'Development', '<i class=\"fa fa-code\" aria-hidden=\"true\"></i>'),
(2, 'Design', '<i class=\"fa fa-database\" aria-hidden=\"true\"></i>'),
(3, 'Marketing', '<i class=\"fa fa-globe\" aria-hidden=\"true\"></i>');

-- --------------------------------------------------------

--
-- Table structure for table `chak`
--

CREATE TABLE `chak` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chak`
--

INSERT INTO `chak` (`id`, `name`) VALUES
(104, 'How To Join PUBG Tournament'),
(101, 'Creating Category Page Left Section'),
(94, 'Creating Course Description Section'),
(84, 'Designing Sharing Buttons');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `rating` int(10) NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `u_id`, `course_id`, `comment`, `rating`, `comment_time`) VALUES
(1, 12, 5, 'Perfect Course Everybody Should Try This Course', 4, '2018-05-04 10:31:27'),
(4, 12, 10, 'NIce Course', 0, '2018-05-07 12:02:32'),
(7, 15, 5, 'Good Course', 1, '2019-06-20 14:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `con_id` int(10) NOT NULL,
  `phone_no` text NOT NULL,
  `email` text NOT NULL,
  `add1` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add2` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `yt` text NOT NULL,
  `fb` text NOT NULL,
  `gp` text NOT NULL,
  `tw` text NOT NULL,
  `li` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`con_id`, `phone_no`, `email`, `add1`, `add2`, `yt`, `fb`, `gp`, `tw`, `li`) VALUES
(2, '7698903619', 'admin@gmail.com', 'B-64,Shlok Society,', 'Surat, Gujarat-395003', 'no', 'no', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `sub_cat_id` int(10) NOT NULL,
  `lang_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `img` text NOT NULL,
  `mrp_price` text NOT NULL,
  `dis` text NOT NULL,
  `dis_price` text NOT NULL,
  `c_desc` varchar(1000) NOT NULL,
  `lvl` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `privacy` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `skill` varchar(100) NOT NULL,
  `at_end` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  `enroll_by` varchar(5) NOT NULL,
  `total_earn` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `cat_id`, `sub_cat_id`, `lang_id`, `u_id`, `title`, `img`, `mrp_price`, `dis`, `dis_price`, `c_desc`, `lvl`, `status`, `privacy`, `type`, `skill`, `at_end`, `created_date`, `enroll_by`, `total_earn`) VALUES
(13, 1, 1, 1, 18, 'Project Using PHP', 'download (2).png', '8', '10%', '7.2', 'This is Basic Course', 'All Level', 'Publish', 'Private', 'Paid', 'The goal of the language is to allow web developers to write dynamically generated pages quickly.', 'PHP is a general-purpose scripting language geared towards web development. ', '2025-02-24', '0', '0'),
(14, 1, 1, 1, 18, 'Angular JS ', 'download (1).jpeg', '8', '0%', '8', 'This is Best Course for all students.', 'All Level', 'Publish', 'Public', 'Paid', 'The goal of the language is to allow web developers to write dynamically generated pages quickly.', 'AngularJs is a general-purpose scripting language geared towards web development. ', '2025-02-24', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `c_cur`
--

CREATE TABLE `c_cur` (
  `v_id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `v_title` varchar(100) NOT NULL,
  `video` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `c_cur`
--

INSERT INTO `c_cur` (`v_id`, `c_id`, `u_id`, `v_title`, `video`, `date`) VALUES
(4, 4, 13, 'Quick Introduction', '28-04-18-711149012VID-20140916-WA0014.mp4', '2018-04-28 16:35:33'),
(5, 4, 13, 'Quick Overview', '28-04-18-147196040VID-20140917-WA0017.mp4', '2018-04-28 16:55:28'),
(6, 4, 13, 'Creating Important Folders', '01-05-18-1616164920VID-20140917-WA0017.mp4', '2018-05-01 09:42:15'),
(7, 4, 13, 'Connection With Database', '01-05-18-529052321Comedy- Apple.mp4', '2018-05-01 09:43:31'),
(8, 4, 13, 'Designing Home Page', '01-05-18-1729887986VID-20140916-WA0014.mp4', '2018-05-01 09:43:54'),
(9, 5, 13, 'Introduction', '01-05-18-480381326Comedy- Apple.mp4', '2018-05-01 09:44:16'),
(10, 5, 13, 'Quick overview', '01-05-18-41775908VID-20140916-WA0014.mp4', '2018-05-01 09:44:45'),
(11, 5, 13, 'Creating Important Folders And File For Are Project E commerce website Designing in Php with PDO', '01-05-18-660597702VID-20140917-WA0017.mp4', '2018-05-01 09:44:54'),
(12, 5, 13, 'Connection With Database', '01-05-18-1760793329VID-20140917-WA0017.mp4', '2018-05-01 09:45:09'),
(13, 5, 13, 'Designing Home Page', '01-05-18-14576779Comedy- Apple.mp4', '2018-05-01 09:45:18'),
(14, 5, 13, 'Including Files', '29-07-18-1800738032Comedy- Apple.mp4', '2018-07-29 14:36:53'),
(15, 12, 13, 'dasdsadsadsa', '01-05-18-1729887986VID-20140916-WA0014.mp4', '2020-10-08 15:16:25'),
(16, 13, 18, '1st Lecture', 'Screen Recording 2025-02-23 211110.mp4', '2025-02-24 12:41:42'),
(17, 13, 18, '2nd Lecture', 'Screen Recording 2025-02-23 211110.mp4', '2025-02-24 12:42:14'),
(18, 13, 18, '3rd Lecture', 'Screen Recording 2025-02-23 211110.mp4', '2025-02-24 12:42:23'),
(19, 13, 18, '4th Lecture', 'Screen Recording 2025-02-23 211110.mp4', '2025-02-24 12:42:35'),
(20, 13, 18, '5th Lecture', 'WhatsApp Video 2025-02-19 at 9.08.52 PM.mp4', '2025-02-24 12:43:37'),
(21, 14, 18, '1st Lecture', 'Screen Recording 2025-02-23 211110.mp4', '2025-02-24 13:14:02'),
(22, 14, 18, '2nd Lecture', 'Screen Recording 2025-02-23 211110.mp4', '2025-02-24 13:14:10'),
(23, 14, 18, '3rd Lecture', 'Screen Recording 2025-02-24 181818.mp4', '2025-02-24 13:14:21'),
(24, 14, 18, '4th Lecture', 'Screen Recording 2025-02-24 181818.mp4', '2025-02-24 13:15:54'),
(25, 14, 18, '5th Lecture', 'WhatsApp Video 2025-02-19 at 8.30.10 PM.mp4', '2025-02-24 13:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `q_id` int(10) NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `answer` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`q_id`, `question`, `answer`) VALUES
(14, 'How Can I Pay?', 'You Can Pay Throgh Paypal U Need To Give Us Your Paypal Email Address'),
(15, 'Where I Can Find My Buying Courses', 'You Can Find Your Buying Courses Under The Profile And Than Go To My Courses');

-- --------------------------------------------------------

--
-- Table structure for table `ins_links`
--

CREATE TABLE `ins_links` (
  `link_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `fb_ins` text NOT NULL,
  `gp_ins` text NOT NULL,
  `twitt_ins` text NOT NULL,
  `li_ins` text NOT NULL,
  `yt_ins` text NOT NULL,
  `web` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ins_links`
--

INSERT INTO `ins_links` (`link_id`, `u_id`, `fb_ins`, `gp_ins`, `twitt_ins`, `li_ins`, `yt_ins`, `web`) VALUES
(1, 13, 'webapphub', 'azazpatel19', 'azazpatel199', 'azazpatel', 'azazpatelweb', 'https://www.webapphub.blogspot.com'),
(2, 12, '', '', '', '', '', ''),
(3, 12, '', '', '', '', '', ''),
(4, 15, '', '', '', '', '', ''),
(5, 15, '', '', '', '', '', ''),
(6, 18, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ins_payment`
--

CREATE TABLE `ins_payment` (
  `id` int(10) NOT NULL,
  `invoice_id` varchar(30) NOT NULL,
  `ins_id` int(10) NOT NULL,
  `amt` varchar(5) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `lang_id` int(10) NOT NULL,
  `lang_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`lang_id`, `lang_name`) VALUES
(1, 'English'),
(2, 'Hindi'),
(3, 'Gujarati'),
(4, 'Marathi');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `ins_id` int(10) NOT NULL,
  `trx_id` varchar(100) NOT NULL,
  `amt` varchar(4) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ins_status` varchar(15) NOT NULL,
  `user_status` varchar(15) NOT NULL,
  `payment_type` varchar(15) NOT NULL,
  `ip_add` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `course_id`, `u_id`, `ins_id`, `trx_id`, `amt`, `currency`, `payment_date`, `ins_status`, `user_status`, `payment_type`, `ip_add`) VALUES
(24, 10, 12, 13, 'UNI127409478QUE', '21', 'USD', '2018-05-04 09:20:50', 'Complete', 'Complete', 'Paypal', '::1'),
(25, 9, 12, 13, 'UNI292242130QUE', '135', 'USD', '2018-05-04 09:20:51', 'Complete', 'Complete', 'Paypal', '::1'),
(26, 7, 12, 13, 'UNI1435429546QUE', '45', 'USD', '2018-05-04 09:20:51', 'Complete', 'Complete', 'Paypal', '::1'),
(27, 6, 12, 15, 'UNI2050793117NQU', '160', 'USD', '2018-05-04 09:22:33', 'Complete', 'Complete', 'Paypal', '::1'),
(28, 5, 14, 15, 'UNI390759482NQU', '90', 'USD', '2018-05-04 09:22:40', 'Complete', 'Complete', 'Paypal', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `sub_cat_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `sub_cat_name` varchar(40) NOT NULL,
  `sub_cat_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sub_cat`
--

INSERT INTO `sub_cat` (`sub_cat_id`, `cat_id`, `sub_cat_name`, `sub_cat_icon`) VALUES
(1, 1, 'Web Development', '<i class=\"fa fa-database\" aria-hidden=\"true\"></i>'),
(2, 2, 'Web Designing', '<i class=\"fa fa-database\" aria-hidden=\"true\"></i>'),
(9, 3, 'Digital Marketing', '<i class=\"fa fa-globe\" aria-hidden=\"true\"></i>'),
(10, 3, 'SMO', '<i class=\"fa fa-facebook\" aria-hidden=\"true\"></i>');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `t_id` int(10) NOT NULL,
  `term` varchar(1000) NOT NULL,
  `term_type` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`t_id`, `term`, `term_type`) VALUES
(1, 'Instructor Should Share 50% Revenue With Are Website', 'instructor'),
(2, 'Instructor Should Be Have An Paypal Account', 'instructor'),
(3, 'Student Should Be Have An Paypal Account', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(10) NOT NULL,
  `u_name` varchar(30) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_phone` varchar(15) NOT NULL,
  `u_pass` text NOT NULL,
  `u_img` varchar(100) NOT NULL,
  `u_desig` varchar(20) NOT NULL,
  `u_bio` varchar(500) NOT NULL,
  `u_head` varchar(30) NOT NULL,
  `u_ip` varchar(30) NOT NULL,
  `u_reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_email`, `u_phone`, `u_pass`, `u_img`, `u_desig`, `u_bio`, `u_head`, `u_ip`, `u_reg_date`, `u_type`) VALUES
(14, 'patel', 'patel@gmail.com', '7698903619', '123456789', '', '', '', '', '::1', '2018-05-07 12:07:46', 'Student'),
(17, 'Dhruvi Mathukiya', 'mathukiyag@gmail.com', '09898196102', '12345678', '', '', '', '', '::1', '2025-02-24 10:38:40', 'Student'),
(18, 'Dhruvi', 'abc@gmail.com', '09898196102', '123456789', '', '', '', '', '::1', '2025-02-24 12:40:24', 'Instructor'),
(19, 'Student', 'stud@gmail.com', '7896541230', 'stud1234', '', '', '', '', '::1', '2025-02-24 13:17:40', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `u_cart_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `ip_add` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `chak`
--
ALTER TABLE `chak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `c_cur`
--
ALTER TABLE `c_cur`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `ins_links`
--
ALTER TABLE `ins_links`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `ins_payment`
--
ALTER TABLE `ins_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`lang_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`u_cart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chak`
--
ALTER TABLE `chak`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `con_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `c_cur`
--
ALTER TABLE `c_cur`
  MODIFY `v_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `q_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ins_links`
--
ALTER TABLE `ins_links`
  MODIFY `link_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ins_payment`
--
ALTER TABLE `ins_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `lang_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `sub_cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `t_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `u_cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
