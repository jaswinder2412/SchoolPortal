-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2018 at 07:53 AM
-- Server version: 10.0.31-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptp`
--

-- --------------------------------------------------------

--
-- Table structure for table `acedemic_year`
--

CREATE TABLE IF NOT EXISTS `acedemic_year` (
  `id` int(110) NOT NULL,
  `academic_name` text,
  `from` text,
  `to` text,
  `status` text,
  `school_id` text,
  `created_date` text,
  `updated_date` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acedemic_year`
--

INSERT INTO `acedemic_year` (`id`, `academic_name`, `from`, `to`, `status`, `school_id`, `created_date`, `updated_date`) VALUES
(1, 'Tikay Academic', '2018', '2019', '1', '2', '1515670424', '1515670424'),
(2, 'Year Of Technology', '2018', '2019', '1', '24', '1515681648', '1515681648'),
(3, 'Second Academic', '2019', '2020', '0', '2', '1515739250', '1515739250');

-- --------------------------------------------------------

--
-- Table structure for table `add_class`
--

CREATE TABLE IF NOT EXISTS `add_class` (
  `id` int(11) NOT NULL,
  `class_name` text,
  `school_id` text,
  `created` text,
  `updated` text,
  `last_updated_by` text
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_class`
--

INSERT INTO `add_class` (`id`, `class_name`, `school_id`, `created`, `updated`, `last_updated_by`) VALUES
(1, 'K.g', '2', '1515674266', '1515999348', '11'),
(2, '2', '2', '1515674276', '1515999314', '11'),
(3, '1', '2', '1515674286', '1515999273', '11'),
(7, '1', '24', '1516020868', '1516020868', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `add_exam`
--

CREATE TABLE IF NOT EXISTS `add_exam` (
  `id` int(11) NOT NULL,
  `exam_name` text,
  `school_id` text,
  `created` text,
  `updated` text,
  `last_updated_by` text
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_exam`
--

INSERT INTO `add_exam` (`id`, `exam_name`, `school_id`, `created`, `updated`, `last_updated_by`) VALUES
(1, 'First Term', '2', '1515677307', '1515677307', NULL),
(2, 'Second Term', '2', '1515677315', '1515677315', NULL),
(3, 'Third Term', '2', '1515677322', '1515677322', NULL),
(4, 'First Term', '24', '1516021435', '1516021435', NULL),
(5, 'Second Term', '24', '1516295415', '1516295415', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `add_grades`
--

CREATE TABLE IF NOT EXISTS `add_grades` (
  `id` int(12) NOT NULL,
  `grade_name` text,
  `school_id` text,
  `created` text,
  `updated` text,
  `last_updated_by` text
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_grades`
--

INSERT INTO `add_grades` (`id`, `grade_name`, `school_id`, `created`, `updated`, `last_updated_by`) VALUES
(1, 'A', '2', '1515677331', '1515677331', NULL),
(2, 'B', '2', '1515677336', '1515677336', NULL),
(3, 'C', '2', '1515677341', '1515677341', NULL),
(4, 'C+', '2', '1515677351', '1515677351', NULL),
(5, 'B+', '2', '1515677357', '1515677357', NULL),
(6, 'A+', '2', '1515677364', '1515677364', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `add_staff`
--

CREATE TABLE IF NOT EXISTS `add_staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` text,
  `lname` text,
  `dob` text,
  `gender` text,
  `date_of_joining` text,
  `qualification` text,
  `image` text,
  `co_ordinator_id` text,
  `school_id` text,
  `created` text,
  `updated` text,
  `phone_number` text,
  `blood_group` text,
  `address` text,
  `emergency_contact` text,
  `specializatin` text,
  `status` text,
  `last_updated_by` text
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_staff`
--

INSERT INTO `add_staff` (`id`, `user_id`, `fname`, `lname`, `dob`, `gender`, `date_of_joining`, `qualification`, `image`, `co_ordinator_id`, `school_id`, `created`, `updated`, `phone_number`, `blood_group`, `address`, `emergency_contact`, `specializatin`, `status`, `last_updated_by`) VALUES
(1, 11, 'Rahul', 'Dutta', '13-09-1988', '0', '07-06-2016', 'B.Ed', '5a5c81f7d31cc.jpg', '', '2', '1515672808', '1515672808', '787894564', 'O+', 'H no. 907 Viveknagar, Ahemdabad', '797978989', 'Accounts', '10', '11'),
(2, 12, 'Subash', 'Ghae', '22-07-1980', '0', '03-04-2017', 'BCA', '1515673141_12.jpg', '', '2', '1515673141', '1515673141', '7897654654', 'AB+', '108, Andheri, Navi Mumbai India', '7945346', 'Chemistry Reactions', '10', '2'),
(3, 13, 'Reena', 'Manhas', '17-09-1993', '1', '04-01-2016', 'MCA', '1515673379_5.jpg', '', '2', '1515673369', '1515673369', '7974545678', 'B+', 'Phase 5 Mohali, Punjab', '8974745645', 'Computer Application', '10', '2'),
(4, 14, 'Sukhdeep', 'Khaira', '02-08-1990', '1', '13-07-2016', 'MCA', '1515673718_11.jpg', '', '2', '1515673718', '1515673718', '7897947456', 'B+', 'Phase 6 Near Mohali tower Punjab', '89746546', 'Drupal', '10', '2'),
(5, 15, 'Vikram', 'Rathore', '06-01-1993', '0', '11-07-2017', 'BA(Arts)', '1515674056_21.jpg', '', '2', '1515674056', '1515674056', '7897979', 'AB+', 'Phase 8b, Mohali, Punjab', '797897987', 'Music', '10', '2'),
(6, 16, 'Saurabh', 'Lal', '01-01-1988', '0', '05-01-2015', 'M.A', '1516111990.jpg', '12', '2', '1515675273', '1515675273', '923423424', 'A+', 'Hamirpur, Himachal Pardesh', '09565656', 'Software', '10', '2'),
(7, 17, 'Satveer', 'Singh', '07-01-1998', '0', '14-01-2009', 'MCA', '1515675841_16.jpg', '12', '2', '1515675841', '1515675841', '6486456', 'A-', '108 Lajpat Nagar, Haryana', '76876456', 'Computer graphics', '10', '2'),
(8, 18, 'Hithesh', 'Bhardwaj', '19-01-1989', '0', '10-01-2017', 'Mtech', '1515676138_19.jpg', '13', '2', '1515676138', '1515676138', '34223234', 'O-', 'H No. 980, Sector 17-A chandigarh.', '3223423423', 'Xcode', '10', '2'),
(9, 19, 'Vijay', 'Chauhan', '07-01-1993', '0', '01-01-2018', 'MBA', '1515676867_36.jpg', '13', '2', '1515676867', '1515676867', '789753', 'A-', 'H no. 890 Sec 32 Chandigarh', '789754564', 'Physics', '10', '2'),
(10, 21, 'Rajat', 'Thakur', '03-01-1992', '0', '09-01-2018', 'Btech', '1515677892_22.jpg', '12', '2', '1515677892', '1515677892', '79815646', 'AB+', 'H No 160 Sec 80 Mohali', '78954644', 'Economics', '10', '11'),
(11, 22, 'Neha', 'Rani', '15-01-2018', '0', '18-06-2008', 'MA', '1515678073_24.jpg', '21', '2', '1515678073', '1515678073', '4654646', 'B+', 'H No. 90 Ahmed Nagar, Andheri, West Mumbai', '32123131', 'Physics', '10', '11'),
(12, 23, 'Richard', 'Henry', '05-01-1989', '0', '23-08-2016', 'BBA', '1515678563_17.jpg', '13', '2', '1515678563', '1515678563', '7894564564', 'O+', 'H : no. 120 Taragarh, Punajb', '987456546', 'English Literature', '10', '2'),
(13, 26, 'sdf', 'sdfsdf', '10-01-2018', '', '', '', '', '', '2', '1515768783', '1515768783', '', '', '', '', '', '10', '2'),
(14, 33, 'Ankit', 'Chowdhary', '02-01-2018', '0', '01-01-2018', 'B.Tech', NULL, '', '24', '1516020774', '1516020774', '', '', '', '', '', '10', '24'),
(15, 34, 'Abhishek', 'Sith', '03-01-2018', '0', '09-01-2018', 'B.Tech', NULL, '33', '24', '1516020854', '1516020854', '7727172382', 'O+', '', '', '', '10', '24'),
(16, 37, 'Vineeta', 'Sharan', '02-01-2018', '0', '', '', NULL, '33', '24', '1516021198', '1516021198', '', '', '', '', '', '10', '24'),
(17, 38, 'Rita', 'Kapoor', '02-01-2018', '', '', '', NULL, '33', '24', '1516021252', '1516021252', '', '', '', '', '', '10', '24');

-- --------------------------------------------------------

--
-- Table structure for table `add_student`
--

CREATE TABLE IF NOT EXISTS `add_student` (
  `id` int(11) NOT NULL,
  `user_id` text,
  `first_name` text,
  `last_name` text,
  `dob` text,
  `blood_group` text,
  `gender` text,
  `image` text,
  `father_name` text,
  `mother_name` text,
  `father_ph_no` text,
  `mother_phone_no` text,
  `address` text,
  `school_id` text,
  `status` text,
  `created` text,
  `updated` text,
  `admission_number` text,
  `last_updated_by` text
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_student`
--

INSERT INTO `add_student` (`id`, `user_id`, `first_name`, `last_name`, `dob`, `blood_group`, `gender`, `image`, `father_name`, `mother_name`, `father_ph_no`, `mother_phone_no`, `address`, `school_id`, `status`, `created`, `updated`, `admission_number`, `last_updated_by`) VALUES
(1, '3', 'Pardeep', 'Sharma', '17-01-2018', 'A+', '0', '1515670855_3.jpg', 'Uday Raichand', 'Reen Raichand', '988854578', '9778545212', 'Gurunagar, Zirakpur Mohali 160067', '2', '10', '1515670855', '1515670855', 'A01', '2'),
(2, '4', 'Priyanka', 'Sharma', '20-01-1999', 'AB+', '1', '1515671185_2.jpg', 'Abhay', 'Mina', '98884524', '988456475', 'Patel Nagar Bathinda, Punjab', '2', '10', '1515671185', '1515671185', 'A02', '2'),
(3, '5', 'Varsha', 'Kumari', '11-01-1995', 'AB-', '0', '1515671427_1.jpg', 'Ravinder singh', 'Anita', '7897965456', '7878956456', 'Uchakhehra , Ropar Near New colony, Punjab', '2', '10', '1515671427', '1515671427', 'A03', '2'),
(4, '6', 'Rajat', 'Saini', '12-07-1999', 'B+', '0', '1515671714_7.jpg', 'Madan lal', 'Janki saini', '789788978', '789798879', 'chandigarh sector 17 bus stand', '2', '10', '1515671714', '1515671714', 'A04', '2'),
(5, '7', 'Rohit', 'Sharma', '14-08-1991', 'A+', '1', '1515671880_4.jpg', 'Shubam lal', 'savitri Devi', '789792347', '785379345', 'V.P.O Dorangla, Gurdaspur, 143536', '2', '10', '1515671880', '1515671880', 'A05', '2'),
(6, '8', 'Varun ', 'Verma', '21-01-1999', 'B-', '0', '1515672006_10.jpg', 'Rahul Malhotra', 'Madhuri Malhotra', '923423245', '922342343', 'vijaya Nagar, Ambala. 150098', '2', '10', '1515672006', '1515672006', 'A06', '2'),
(7, '9', 'Sumit', 'Kumar', '04-04-1989', 'O+', '0', '5a5cb5871a924.jpg', 'Hari Mishra', 'Ruhi Mishra', '879797897', '87978987', 'Deep chowk, Talwara Punjab', '2', '10', '1515672315', '1515672315', 'A07', '9'),
(8, '10', 'Pawan', 'Arrora', '17-09-1996', 'A+', '0', '1515672514_20.jpg', 'Vikrant', 'Neerja', '98797878', '78798988', '108 Lajpat Nagar, Delhi', '2', '10', '1515672514', '1515672514', 'A08', '2'),
(9, '20', 'Lakshmi', 'Devi', '09-01-1992', 'O+', '0', '1515677810_35.jpg', 'Pyare Lal', 'Ruchika', '564564644', '456465456', 'H No : 154 Sec : 70, Mohali.', '2', '10', '1515677810', '1515677810', 'A09', '11'),
(10, '25', 'AbhiPray', 'gupta', '08-01-1997', 'A+', '0', '', 'Raj Gupta', 'Meena Gupta', '79845646', '87954654', '', '2', '10', '1515743229', '1515743229', 'A11', '2'),
(11, '27', 'Rohini', 'Das gupta', '16-01-1991', 'O+', '1', '1516014920_8.jpg', 'Nishant thankur', 'Devika Thakur', '56431323', '974564648', '', '2', '10', '1515768982', '1515768982', 'A20', '11'),
(12, '28', 'Diksha', 'Verma', '24-01-2018', 'B+', '1', '5a58ce7c60cb2.jpg', 'Bansal', 'Neha', '4132123', '456456', '', '2', '10', '1515769475', '1515769475', 'A22', '11'),
(13, '29', 'asdasd', 'asdasdasd', '16-01-2018', 'AB+', '1', '5a58ceba9020e.jpg', '', '', '', '', '', '2', '2', '1515769539', '1515769539', '', '11'),
(14, '30', 'asdasdasd', 'dasdasdas', '24-01-2018', 'B+', '1', '5a58d9f36390a.jpg', '', '', '', '', '', '2', '2', '1515769587', '1515769587', '', '11'),
(15, '31', 'sdfdfs', 'sdfsdf', '25-01-2018', 'A+', '1', '5a58daf3b31d7.jpg', '', '', '', '', '', '2', '2', '1515769746', '1515769746', '', '11'),
(16, '32', 'Anmol ', 'Modi', '01-01-2018', 'O+', '0', '1516023993.jpg', 'Mr. Modi', 'Mrs. Modi', '993757689', '8874737875', '1st Cross, Venkata Reddy Layout\r\nFlat No. 52', '24', '10', '1516020702', '1516020702', 'A01', '24'),
(17, '35', 'Ashish ', 'Mohanka', '04-01-2018', 'O+', '0', NULL, 'Mr. Mohanka', 'Mrs. Mohanks', '8872817886', '9984746334', '1st Cross, Venkata Reddy Layout\r\nFlat No. 52', '24', '10', '1516021053', '1516021053', 'A02', '24'),
(18, '36', 'Raunak', 'Tiwary', '01-01-2018', '', '0', NULL, 'Mr. Tiwary', 'Mrs. Tiwary', '9938278993', '9847337434', '1st Cross, Venkata Reddy Layout\r\nFlat No. 52', '24', '10', '1516021131', '1516021131', 'A03', '24');

-- --------------------------------------------------------

--
-- Table structure for table `add_test`
--

CREATE TABLE IF NOT EXISTS `add_test` (
  `id` int(12) NOT NULL,
  `test_name` text,
  `school_id` text,
  `created_by` text,
  `created` text,
  `updated` text
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_test`
--

INSERT INTO `add_test` (`id`, `test_name`, `school_id`, `created_by`, `created`, `updated`) VALUES
(1, 'First Chapter Test', '2', '16', '1515680101', '1515680101'),
(2, 'SaturdayTest', '2', '18', '1515681050', '1515681059'),
(3, 'Friday Test', '2', '17', '1515684336', '1515684336'),
(4, 'English TEST', '2', '16', '1515684854', '1515684854'),
(5, 'Maths', '24', '34', '1516021994', '1516021994'),
(6, 'Testing_Nishant', '2', '16', '1516041636', '1516041636'),
(7, 'English', '24', '34', '1516210846', '1516210846');

-- --------------------------------------------------------

--
-- Table structure for table `announcements_parent`
--

CREATE TABLE IF NOT EXISTS `announcements_parent` (
  `id` int(11) NOT NULL,
  `class_id` text,
  `section` text,
  `Academic_year_id` text,
  `school_id` text,
  `student_id` text,
  `anouncement_title` text,
  `anouncement_description` text,
  `start_date` text,
  `end_date` text,
  `status` text,
  `created_by` text,
  `created` text,
  `updated` text
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements_parent`
--

INSERT INTO `announcements_parent` (`id`, `class_id`, `section`, `Academic_year_id`, `school_id`, `student_id`, `anouncement_title`, `anouncement_description`, `start_date`, `end_date`, `status`, `created_by`, `created`, `updated`) VALUES
(1, '0', NULL, '1', '2', NULL, 'New Holiday', '<p>AmericanHort truly represents the entire horticulture industry, including breeders, greenhouse and nursery growers, retailers, distributors, interior and exterior landscapers, florists, students, educators, researchers, manufacturers, and all of those who are part of the industry market chain. We are the leading national association for the green industry, and AmericanHort works tirelessly to connect the industry across states and segments, giving you opportunities that expand your network and resources.&nbsp;</p>\r\n', '19-01-2018', '26-01-2018', '1', '2', '1515677653', '1515677653'),
(2, '1,2', NULL, '1', '2', NULL, 'Pay fee by 20 Jan', '<p><strong>Hello Everyone</strong> ,</p>\r\n\r\n<p>&nbsp;<strong>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences</strong></p>\r\n', '12-01-2018', '22-01-2018', '1', '11', '1515678239', '1515678239'),
(3, '1', '1', '1', '2', '9,10', 'New Announcement By Co-ordinator', '<p>Hello Everyone,</p>\r\n\r\n<p><br />\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumasd</p>\r\n', '18-01-2018', '31-01-2018', '1', '12', '1515678363', '1515678363'),
(4, '1', '1', '1', '2', '9,10', 'Please Pay your fine.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '12-01-2018', '25-01-2018', '1', '16', '1515680426', '1515680426'),
(5, '1', '1', '1', '2', '9,10', 'Complete your Uniform', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '17-01-2018', '31-01-2018', '1', '18', '1515681134', '1515681134'),
(6, '0', NULL, '2', '24', NULL, 'Holiday Tomorrow', '<p>Dont Come.</p>\r\n', '16-01-2018', '17-01-2018', '1', '24', '1516021638', '1516021638'),
(7, '7', '5', '2', '24', '32', 'Call your parents tomorrow.', '<p>Call your Parents tomorrow.</p>\r\n', '16-01-2018', '17-01-2018', '1', '24', '1516021698', '1516021698'),
(8, '7', '5', '2', '24', '35', 'Please bring 100 rupees', '<p>Get 100 rupees.</p>\r\n', '17-01-2018', '18-01-2018', '1', '34', '1516138406', '1516138406'),
(9, '7', '5', '2', '24', '32', 'asbkdbhaskd', '<p>dasdasdasdasd</p>\r\n', '17-01-2018', '18-01-2018', '1', '24', '1516210346', '1516210346'),
(10, '0', NULL, '2', '24', NULL, 'dsfsdfs', '<p>ajsdhkjashdkahsdjkas</p>\r\n', '17-01-2018', '18-01-2018', '1', '24', '1516210369', '1516210369'),
(11, '7', '5', '2', '24', '32', 'dsaf', '<p>asdsf</p>\r\n', '17-01-2018', '18-01-2018', '1', '34', '1516211090', '1516211090'),
(12, '7', '5', '2', '24', '32,35', 'fgdfgd', '<p>dsfsdfdsf</p>\r\n', '19-01-2018', '20-01-2018', '1', '34', '1516296303', '1516296324');

-- --------------------------------------------------------

--
-- Table structure for table `announcements_teacher`
--

CREATE TABLE IF NOT EXISTS `announcements_teacher` (
  `id` int(110) NOT NULL,
  `anouncement_title` text,
  `anouncement_description` text,
  `announcements_to` text,
  `announcements_from` text,
  `status` text,
  `school_id` text,
  `created_by` text,
  `announcement_date` text,
  `end_date` text,
  `start_date` text,
  `created_time` text,
  `academic_year` text,
  `updated_time` text,
  `seen` text
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements_teacher`
--

INSERT INTO `announcements_teacher` (`id`, `anouncement_title`, `anouncement_description`, `announcements_to`, `announcements_from`, `status`, `school_id`, `created_by`, `announcement_date`, `end_date`, `start_date`, `created_time`, `academic_year`, `updated_time`, `seen`) VALUES
(1, 'New Holiday', 'Hello Everyone, Tomorow will be holiday.', '0', '2', '1', '2', '2', NULL, '19-01-2018', '12-01-2018', '1515677557', '1', '1515677557', NULL),
(2, 'Holi Celebration', 'Hello Everyone, You all are Requested to come on ground, for Holi Celebration.', '0', '11', '1', '2', '11', NULL, '31-01-2018', '19-01-2018', '1515678166', '1', '1515678166', NULL),
(3, 'Co-Ordinators Should have to Come on third Floor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'M', '14', '1', '2', '14', NULL, '13-01-2018', '11-01-2018', '1515678687', '1', '1515678687', NULL),
(4, 'Holiday Tomorrow', 'Holiday Tomorrow.', '0', '24', '1', '24', '24', NULL, '17-01-2018', '16-01-2018', '1516021565', '2', '1516021565', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `anouncement_teachers_userids`
--

CREATE TABLE IF NOT EXISTS `anouncement_teachers_userids` (
  `id` int(11) NOT NULL,
  `announcement_id` text,
  `teacher_id` text,
  `seen` text,
  `school_id` text,
  `academic_year` text
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anouncement_teachers_userids`
--

INSERT INTO `anouncement_teachers_userids` (`id`, `announcement_id`, `teacher_id`, `seen`, `school_id`, `academic_year`) VALUES
(1, '1', '12', '1', '2', '1'),
(2, '1', '13', '0', '2', '1'),
(3, '1', '16', '1', '2', '1'),
(4, '1', '17', '1', '2', '1'),
(5, '1', '18', '1', '2', '1'),
(6, '1', '19', '0', '2', '1'),
(7, '2', '12', '1', '2', '1'),
(8, '2', '13', '0', '2', '1'),
(9, '2', '16', '1', '2', '1'),
(10, '2', '17', '1', '2', '1'),
(11, '2', '18', '1', '2', '1'),
(12, '2', '19', '0', '2', '1'),
(13, '2', '21', '0', '2', '1'),
(14, '2', '22', '0', '2', '1'),
(15, '3', '12', '0', '2', '1'),
(16, '3', '13', '0', '2', '1'),
(17, '3', '21', '0', '2', '1'),
(18, '4', '33', '0', '24', '2'),
(19, '4', '34', '1', '24', '2'),
(20, '4', '37', '0', '24', '2'),
(21, '4', '38', '0', '24', '2');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentclasses`
--

CREATE TABLE IF NOT EXISTS `assignmentclasses` (
  `id` int(11) NOT NULL,
  `class_id` text,
  `section` text,
  `Academic_year_id` text,
  `school_id` text,
  `student_id` text,
  `anouncement_title` text,
  `anouncement_description` text,
  `status` text,
  `created_by` text,
  `fileupload` text,
  `created` text,
  `updated` text
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignmentclasses`
--

INSERT INTO `assignmentclasses` (`id`, `class_id`, `section`, `Academic_year_id`, `school_id`, `student_id`, `anouncement_title`, `anouncement_description`, `status`, `created_by`, `fileupload`, `created`, `updated`) VALUES
(1, '1', '1', '1', '2', '9,10', 'Make Notes of Second Chapter.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '1', '16', '1515680486_sharpexplainervideos.txt', '1515680486', '1515747594'),
(2, '1', '1', '1', '2', '9,10', 'Complete Homework', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '1', '18', '1515681175_officedata.txt', '1515681175', '1515681175'),
(3, '7', '5', '2', '24', '32,35,36', 'Maths Trignometry', '<p>Trignometry Chapter 2.</p>\r\n', '1', '34', NULL, '1516022099', '1516022099'),
(4, '7', '5', '2', '24', '32,35,36', 'asdasd', '<p>asdasd</p>\r\n', '1', '34', NULL, '1516211120', '1516211120');

-- --------------------------------------------------------

--
-- Table structure for table `class_assigned_student`
--

CREATE TABLE IF NOT EXISTS `class_assigned_student` (
  `id` int(12) NOT NULL,
  `class_id` text,
  `section_id` text,
  `class_merge_id` text,
  `student_userid` text,
  `school_id` text,
  `academic_year` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class_info`
--

CREATE TABLE IF NOT EXISTS `class_info` (
  `id` int(110) NOT NULL,
  `class_name` text,
  `class_section` text,
  `class_description` text,
  `academic_year` text,
  `school_id` text,
  `last_updated_by` text,
  `created_date` text,
  `updated_date` text
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_info`
--

INSERT INTO `class_info` (`id`, `class_name`, `class_section`, `class_description`, `academic_year`, `school_id`, `last_updated_by`, `created_date`, `updated_date`) VALUES
(1, '1', '1', 'Unite, promote, and advance our industry through advocacy, collaboration, connectivity, education, market development, and research.', '1', '2', '2', '1515674956', '1515676980'),
(2, '1', '2', 'Unite, promote, and advance our industry through advocacy, collaboration, connectivity, education, market development, and research.', '1', '2', '11', '1515674983', '1515677911'),
(3, '2', '1', 'Unite, promote, and advance our industry through advocacy, collaboration, connectivity, education, market development, and research.', '1', '2', '2', '1515675034', '1515677191'),
(4, '2', '2', 'Unite, promote, and advance our industry through advocacy, collaboration, connectivity, education, market development, and research.', '1', '2', '2', '1515675049', '1519021611'),
(5, '3', '3', 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '1', '2', '2', '1515677963', '1521194668'),
(6, '7', '5', 'Brilliant Class.', '2', '24', '24', '1516020960', '1516021413');

-- --------------------------------------------------------

--
-- Table structure for table `class_student`
--

CREATE TABLE IF NOT EXISTS `class_student` (
  `id` int(11) NOT NULL,
  `class_id` text,
  `student_id` text,
  `Academic_year_id` text,
  `school_id` text,
  `created_date` text,
  `updated_date` text
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`id`, `class_id`, `student_id`, `Academic_year_id`, `school_id`, `created_date`, `updated_date`) VALUES
(9, '1', '9', '1', '2', '1515999680', '1515999680'),
(10, '1', '10', '1', '2', '1515676980', '1515676980'),
(13, '3', '3', '1', '2', '1515677191', '1515677191'),
(14, '3', '4', '1', '2', '1515677191', '1515677191'),
(18, '2', '7', '1', '2', '1515677911', '1515677911'),
(19, '2', '8', '1', '2', '1529649672', '1529649672'),
(22, '1', '27', '1', '2', '1516014920', '1516014920'),
(23, '1', '28', '1', '2', '1516014975', '1516014975'),
(25, '6', '32', '2', '24', '1516210430', '1516210430'),
(26, '6', '35', '2', '24', '1516021413', '1516021413'),
(27, '6', '36', '2', '24', '1516021413', '1516021413'),
(28, '4', '5', '1', '2', '1519021611', '1519021611'),
(29, '4', '6', '1', '2', '1519021611', '1519021611'),
(30, '5', '20', '1', '2', '1521194668', '1521194668'),
(31, '5', '25', '1', '2', '1521194668', '1521194668');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject`
--

CREATE TABLE IF NOT EXISTS `class_subject` (
  `id` int(11) NOT NULL,
  `class_id` text,
  `subject_id` text,
  `Assigned_teacher_id` text,
  `created_date` text,
  `updated_date` text,
  `academic_year` text,
  `school_id` text
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_subject`
--

INSERT INTO `class_subject` (`id`, `class_id`, `subject_id`, `Assigned_teacher_id`, `created_date`, `updated_date`, `academic_year`, `school_id`) VALUES
(1, '1', '1', '16', '1515676980', '1515676980', '1', '2'),
(2, '1', '2', '17', '1515676980', '1515676980', '1', '2'),
(3, '1', '3', '18', '1515676980', '1515676980', '1', '2'),
(7, '3', '2', '16', '1515677191', '1515677191', '1', '2'),
(8, '3', '3', '18', '1515677191', '1515677191', '1', '2'),
(9, '3', '5', '17', '1515677191', '1515677191', '1', '2'),
(13, '2', '6', '19', '1515677911', '1515677911', '1', '2'),
(14, '2', '5', '18', '1515677911', '1515677911', '1', '2'),
(15, '2', '4', '17', '1515677911', '1515677911', '1', '2'),
(18, '6', '7', '34', '1516021413', '1516021413', '2', '24'),
(19, '6', '8', '37', '1516021413', '1516021413', '2', '24'),
(20, '6', '9', '38', '1516021413', '1516021413', '2', '24'),
(21, '4', '1', '19', '1519021611', '1519021611', '1', '2'),
(22, '4', '3', '16', '1519021611', '1519021611', '1', '2'),
(23, '4', '2', '18', '1519021611', '1519021611', '1', '2'),
(24, '4', '2', '16', '1519021611', '1519021611', '1', '2'),
(25, '5', '4', '22', '1521194668', '1521194668', '1', '2'),
(26, '5', '2', '17', '1521194668', '1521194668', '1', '2'),
(27, '5', '3', '22', '1521194668', '1521194668', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(100) NOT NULL,
  `exam_name` text,
  `marks` text,
  `school_id` text,
  `academic_year` text,
  `exam_date` text,
  `inhouse_global` text COMMENT 'if 0 then global',
  `created_date` text,
  `updated_date` text,
  `last_updated_by` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam_class`
--

CREATE TABLE IF NOT EXISTS `exam_class` (
  `id` int(11) NOT NULL,
  `exam_id` text,
  `class_id` text,
  `section_id` text,
  `subject_id` text,
  `school_id` text,
  `academic_year` text,
  `created` text,
  `updated` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final_exam`
--

CREATE TABLE IF NOT EXISTS `final_exam` (
  `id` int(11) NOT NULL,
  `exam_id` text,
  `class_id` text,
  `section_id` text,
  `marks_in` text,
  `subject_id` text,
  `academic_year` text,
  `school_id` text,
  `created` text,
  `updated` text
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_exam`
--

INSERT INTO `final_exam` (`id`, `exam_id`, `class_id`, `section_id`, `marks_in`, `subject_id`, `academic_year`, `school_id`, `created`, `updated`) VALUES
(1, '1', '2', '1', '0', NULL, '1', '2', '1515677397', '1515677397'),
(2, '1', '2', '2', '0', NULL, '1', '2', '1515677397', '1515677397'),
(3, '1', '1', '1', '0', NULL, '1', '2', '1515677406', '1515677406'),
(4, '1', '1', '2', '0', NULL, '1', '2', '1515677406', '1515677406'),
(5, '2', '1', '1', '1', NULL, '1', '2', '1515683050', '1515683050'),
(6, '2', '1', '2', '1', NULL, '1', '2', '1515683050', '1515683050'),
(7, '4', '7', '5', '0', NULL, '2', '24', '1516021448', '1516021448'),
(8, '3', '1', '1', '0', NULL, '1', '2', '1516042412', '1516042412'),
(9, '3', '1', '2', '0', NULL, '1', '2', '1516042412', '1516042412'),
(10, '3', '2', '1', '0', NULL, '1', '2', '1516042570', '1516042570'),
(11, '3', '2', '2', '0', NULL, '1', '2', '1516042570', '1516042570'),
(12, '3', '3', '3', '0', NULL, '1', '2', '1516042583', '1516042583');

-- --------------------------------------------------------

--
-- Table structure for table `final_exam_grading`
--

CREATE TABLE IF NOT EXISTS `final_exam_grading` (
  `id` int(12) NOT NULL,
  `final_exam_id` text,
  `class_id` text,
  `section_id` text,
  `subject_id` text,
  `student_id` text,
  `grade` text,
  `marks` text
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_exam_grading`
--

INSERT INTO `final_exam_grading` (`id`, `final_exam_id`, `class_id`, `section_id`, `subject_id`, `student_id`, `grade`, `marks`) VALUES
(1, '3', '1', '1', '1', '9', NULL, '56'),
(2, '3', '1', '1', '1', '10', NULL, '40'),
(3, '1', '2', '1', '2', '3', NULL, '99'),
(4, '1', '2', '1', '2', '4', NULL, '78'),
(5, '3', '1', '1', '3', '9', NULL, '40'),
(6, '3', '1', '1', '3', '10', NULL, '50'),
(7, '4', '1', '2', '5', '7', NULL, '60'),
(8, '4', '1', '2', '5', '8', NULL, '60'),
(9, '1', '2', '1', '3', '4', NULL, '90'),
(10, '1', '2', '1', '3', '3', NULL, '80'),
(11, '2', '2', '2', '2', '5', NULL, '70'),
(12, '2', '2', '2', '2', '6', NULL, '78'),
(13, '3', '1', '1', '2', '9', NULL, '59'),
(14, '3', '1', '1', '2', '10', NULL, '50'),
(15, '4', '1', '2', '4', '8', NULL, '50'),
(16, '4', '1', '2', '4', '7', NULL, '60'),
(17, '1', '2', '1', '5', '3', NULL, '80'),
(18, '1', '2', '1', '5', '4', NULL, '90'),
(19, '2', '2', '2', '3', '5', NULL, '77'),
(20, '2', '2', '2', '3', '6', NULL, '78'),
(21, '5', '1', '1', '1', '10', 'B', NULL),
(22, '5', '1', '1', '1', '9', 'B+', NULL),
(23, '5', '1', '1', '3', '9', 'B+', NULL),
(24, '5', '1', '1', '3', '10', 'A+', NULL),
(25, '5', '1', '1', '2', '9', 'C+', NULL),
(26, '5', '1', '1', '2', '10', 'A+', NULL),
(27, '7', '7', '5', '7', '32', NULL, '56'),
(28, '7', '7', '5', '7', '35', NULL, '66'),
(29, '7', '7', '5', '7', '36', NULL, '69'),
(30, '8', '1', '1', '1', '9', NULL, '50'),
(31, '8', '1', '1', '1', '10', NULL, '50'),
(32, '8', '1', '1', '1', '27', NULL, '50'),
(33, '8', '1', '1', '1', '28', NULL, '50');

-- --------------------------------------------------------

--
-- Table structure for table `final_exam_subjects`
--

CREATE TABLE IF NOT EXISTS `final_exam_subjects` (
  `id` int(11) NOT NULL,
  `final_exam_id` text,
  `subject_id` text,
  `Assigned_teacher_id` text,
  `exam_date` text,
  `school_id` text,
  `academic_year` text,
  `created` text,
  `updated` text,
  `last_updated_by` text,
  `maximum_marks` text
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_exam_subjects`
--

INSERT INTO `final_exam_subjects` (`id`, `final_exam_id`, `subject_id`, `Assigned_teacher_id`, `exam_date`, `school_id`, `academic_year`, `created`, `updated`, `last_updated_by`, `maximum_marks`) VALUES
(1, '3', '1', '16', '01/12/2018', '2', '1', '1515677442', '1515677442', NULL, '60'),
(2, '3', '2', '17', '01/13/2018', '2', '1', '1515677442', '1515677442', NULL, '60'),
(3, '3', '3', '18', '01/14/2018', '2', '1', '1515677442', '1515677442', NULL, '60'),
(4, '4', '6', '19', '01/17/2018', '2', '1', '1515677455', '1515677455', NULL, '70'),
(5, '4', '5', '18', '01/18/2018', '2', '1', '1515677455', '1515677455', NULL, '70'),
(6, '4', '4', '17', '01/19/2018', '2', '1', '1515677455', '1515677455', NULL, '70'),
(7, '1', '2', '16', '01/26/2018', '2', '1', '1515677471', '1515677471', NULL, '100'),
(8, '1', '3', '18', '01/27/2018', '2', '1', '1515677471', '1515677471', NULL, '100'),
(9, '1', '5', '17', '01/28/2018', '2', '1', '1515677471', '1515677471', NULL, '100'),
(10, '2', '1', '19', '01/31/2018', '2', '1', '1515677488', '1515677488', NULL, '80'),
(11, '2', '3', '17', '02/01/2018', '2', '1', '1515677488', '1515677488', NULL, '80'),
(12, '2', '2', '18', '02/02/2018', '2', '1', '1515677488', '1515677488', NULL, '80'),
(13, '5', '1', '16', '02/22/2018', '2', '1', '1515683063', '1515683063', NULL, NULL),
(14, '5', '2', '17', '02/23/2018', '2', '1', '1515683063', '1515683063', NULL, NULL),
(15, '5', '3', '18', '02/24/2018', '2', '1', '1515683063', '1515683063', NULL, NULL),
(19, '6', '6', '19', '01/25/2018', '2', '1', '1515744747', '1515744747', '2', NULL),
(20, '6', '5', '18', '01/30/2018', '2', '1', '1515744747', '1515744747', '2', NULL),
(21, '6', '4', '17', '01/31/2018', '2', '1', '1515744747', '1515744747', '2', NULL),
(22, '7', '7', '34', '01/17/2018', '24', '2', '1516021484', '1516021484', NULL, '80'),
(23, '7', '8', '37', '01/18/2018', '24', '2', '1516021484', '1516021484', NULL, '80'),
(24, '7', '9', '38', '01/19/2018', '24', '2', '1516021484', '1516021484', NULL, '80'),
(26, '10', '2', '16', '01/17/2018', '2', '1', '1516089254', '1516089254', '2', '100'),
(27, '8', '1', '16', '01/31/2018', '2', '1', '1516089356', '1516089356', NULL, '50');

-- --------------------------------------------------------

--
-- Table structure for table `inhouse_test`
--

CREATE TABLE IF NOT EXISTS `inhouse_test` (
  `id` int(12) NOT NULL,
  `exam_id` text,
  `class_id` text,
  `section_id` text,
  `subject_id` text,
  `academic_year` text,
  `school_id` text,
  `teacher_created_by` text,
  `created` text,
  `updated` text
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inhouse_test`
--

INSERT INTO `inhouse_test` (`id`, `exam_id`, `class_id`, `section_id`, `subject_id`, `academic_year`, `school_id`, `teacher_created_by`, `created`, `updated`) VALUES
(1, '1', '1', '1', NULL, '1', '2', '16', '1515680109', '1515680109'),
(2, '1', '2', '1', NULL, '1', '2', '16', '1515680132', '1515680132'),
(3, '2', '1', '1', NULL, '1', '2', '18', '1515681069', '1515681069'),
(4, '2', '1', '2', NULL, '1', '2', '18', '1515681069', '1515681069'),
(5, '3', '1', '1', NULL, '1', '2', '17', '1515684350', '1515684350'),
(6, '3', '1', '2', NULL, '1', '2', '17', '1515684350', '1515684350'),
(7, '4', '2', '1', NULL, '1', '2', '16', '1515684887', '1515684887'),
(10, '3', '2', '2', NULL, '1', '2', '17', '1515687304', '1515687304'),
(11, '1', '1', '1', NULL, '1', '2', '16', '1515749642', '1515749642'),
(12, '5', '7', '5', NULL, '2', '24', '34', '1516022006', '1516022006'),
(13, '5', '7', '5', NULL, '2', '24', '34', '1516023283', '1516023283'),
(14, '5', '7', '5', NULL, '2', '24', '34', '1516023316', '1516023316'),
(15, '6', '2', '1', NULL, '1', '2', '16', '1516041679', '1516041679'),
(16, '6', '2', '1', NULL, '1', '2', '16', '1516041681', '1516041681'),
(17, '6', '2', '1', NULL, '1', '2', '16', '1516089546', '1516089546'),
(18, '6', '1', '1', NULL, '1', '2', '16', '1516096152', '1516096152'),
(19, '7', '7', '5', NULL, '2', '24', '34', '1516211026', '1516211026'),
(20, '7', '7', '5', NULL, '2', '24', '34', '1516296006', '1516296006');

-- --------------------------------------------------------

--
-- Table structure for table `inhouse_test_grading`
--

CREATE TABLE IF NOT EXISTS `inhouse_test_grading` (
  `id` int(12) NOT NULL,
  `inhouse_test_id` text,
  `class_id` text,
  `section_id` text,
  `subject_id` text,
  `student_id` text,
  `marks` text,
  `teacher_created_by` text
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inhouse_test_grading`
--

INSERT INTO `inhouse_test_grading` (`id`, `inhouse_test_id`, `class_id`, `section_id`, `subject_id`, `student_id`, `marks`, `teacher_created_by`) VALUES
(1, '4', '1', '2', '5', '7', '11', '18'),
(2, '4', '1', '2', '5', '8', '15', '18'),
(3, '3', '1', '1', '3', '9', '11', '18'),
(4, '3', '1', '1', '3', '10', '20', '18'),
(5, '2', '2', '1', '2', '3', '25', '16'),
(6, '2', '2', '1', '2', '4', '22', '16'),
(7, '1', '1', '1', '1', '9', '23', '16'),
(8, '1', '1', '1', '1', '10', '29', '16'),
(9, '6', '1', '2', '4', '7', '9', '17'),
(10, '6', '1', '2', '4', '8', '9', '17'),
(11, '5', '1', '1', '2', '9', '03', '17'),
(12, '5', '1', '1', '2', '10', '08', '17'),
(13, '14', '7', '5', '7', '32', '12', '34'),
(14, '13', '7', '5', '7', '32', '14', '34'),
(15, '12', '7', '5', '7', '32', '16', '34'),
(16, '15', '2', '1', '2', '3', '11', '16');

-- --------------------------------------------------------

--
-- Table structure for table `inhouse_test_subjects`
--

CREATE TABLE IF NOT EXISTS `inhouse_test_subjects` (
  `id` int(12) NOT NULL,
  `inhouse_test_id` text,
  `subject_id` text,
  `Assigned_teacher_id` text,
  `exam_date` text,
  `school_id` text,
  `academic_year` text,
  `created` text,
  `updated` text,
  `last_updated_by` text,
  `maximum_marks` text
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inhouse_test_subjects`
--

INSERT INTO `inhouse_test_subjects` (`id`, `inhouse_test_id`, `subject_id`, `Assigned_teacher_id`, `exam_date`, `school_id`, `academic_year`, `created`, `updated`, `last_updated_by`, `maximum_marks`) VALUES
(1, '1', '1', '16', '01/12/2018', '2', '1', '1515680120', '1515680120', NULL, '30'),
(2, '2', '2', '16', '01/24/2018', '2', '1', '1515680140', '1515680140', NULL, '30'),
(3, '4', '5', '18', '01/25/2018', '2', '1', '1515681076', '1515681076', NULL, '20'),
(4, '3', '3', '18', '01/26/2018', '2', '1', '1515681083', '1515681083', NULL, '20'),
(5, '6', '4', '17', '01/12/2018', '2', '1', '1515684359', '1515684359', NULL, '10'),
(6, '5', '2', '17', '01/19/2018', '2', '1', '1515684365', '1515684365', NULL, '10'),
(8, '12', '7', '34', '01/16/2018', '24', '2', '1516022038', '1516022038', NULL, '20'),
(9, '13', '7', '34', '01/17/2018', '24', '2', '1516023304', '1516023304', NULL, '20'),
(11, '14', '7', '34', '01/18/2018', '24', '2', '1516023330', '1516023330', '34', '20'),
(13, '15', '2', '16', '01/18/2018', '2', '1', '1516041729', '1516041729', NULL, '20'),
(15, '16', '2', '16', '01/17/2018', '2', '1', '1516092111', '1516092111', '16', '22'),
(16, '17', '2', '16', '01/25/2018', '2', '1', '1516092116', '1516092116', '16', '24'),
(17, '18', '1', '16', '01/18/2018', '2', '1', '1516096160', '1516096160', NULL, '10'),
(18, '19', '7', '34', '01/19/2018', '24', '2', '1516211044', '1516211044', NULL, '20'),
(19, '20', '7', '34', '01/22/2018', '24', '2', '1516296022', '1516296022', NULL, '20');

-- --------------------------------------------------------

--
-- Table structure for table `manage_grade`
--

CREATE TABLE IF NOT EXISTS `manage_grade` (
  `id` int(11) NOT NULL,
  `exam_id` text,
  `class_id` text,
  `subject_id` text,
  `student_id` text,
  `grade` text,
  `marks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1509971287),
('m130524_201442_init', 1509971292);

-- --------------------------------------------------------

--
-- Table structure for table `school_list`
--

CREATE TABLE IF NOT EXISTS `school_list` (
  `id` int(11) NOT NULL,
  `school_user_id` int(11) NOT NULL,
  `school_name` text,
  `school_location` text,
  `school_logo` text,
  `description` text,
  `number_of_student` text,
  `first_name` text,
  `phone_number` text,
  `last_name` text,
  `image` text,
  `status` text,
  `created_by` text,
  `created_time` text,
  `updated` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_list`
--

INSERT INTO `school_list` (`id`, `school_user_id`, `school_name`, `school_location`, `school_logo`, `description`, `number_of_student`, `first_name`, `phone_number`, `last_name`, `image`, `status`, `created_by`, `created_time`, `updated`) VALUES
(1, 2, 'Tikay elementary School', 'Mohali Punjab', '1515670344_download.png', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of ', '600', 'Sarvan', '9888836984', 'Mishra', '5a60b4c7066cd.jpg', '10', '1', '1515670344', '1516287181'),
(2, 24, 'Loyola School, Jamshedpur', 'Near Beldih Lake, Jamshedpur', '1515681596_Loyola_Jamshedpur_logo.png', 'School for brilliant minds.', '1000', 'Joshua', '8861761741', 'Borromeo', '1515998992-P1240825.jpg', '10', '1', '1515681596', '1515998992');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL,
  `section_name` text,
  `school_id` text,
  `created` text,
  `updated` text,
  `last_updated_by` text
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `section_name`, `school_id`, `created`, `updated`, `last_updated_by`) VALUES
(1, 'A', '2', '1515674242', '1515674242', NULL),
(2, 'B', '2', '1515674248', '1515674248', NULL),
(3, 'C', '2', '1515674253', '1515674253', NULL),
(4, 'D', '2', '1515674258', '1515674258', NULL),
(5, 'A', '24', '1516020876', '1516020876', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(100) NOT NULL,
  `subject_name` text,
  `subject_description` text,
  `created_by` text,
  `school_id` text,
  `created_date` text NOT NULL,
  `updated_date` text,
  `last_updated_by` text
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_name`, `subject_description`, `created_by`, `school_id`, `created_date`, `updated_date`, `last_updated_by`) VALUES
(1, 'Hindi', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ', '2', '2', '1515674358', '1515674358', NULL),
(2, 'English', 'It produces microscopes and other instruments used in chemistry laboratories. Manufacture of submersible pumps and mixers and grinders is another industry that has traditionally flourished. Ambala is also an important textile trading centre, besides Delhi and Ludhiana and has a well-known cloth market, which is famous in the region especially for those seeking bridal wear. It also produces rugs, known locally as Durries, and houses many suppliers to Indian defence forces.', '2', '2', '1515674389', '1515674389', NULL),
(3, 'Punjabi', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum,', '2', '2', '1515674420', '1515674420', NULL),
(4, 'Maths', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2', '2', '1515674439', '1515674439', NULL),
(5, 'Science', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,', '2', '2', '1515674468', '1515674468', NULL),
(6, 'Social Studies', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will', '2', '2', '1515674492', '1515674492', NULL),
(7, 'Maths', 'Maths', '24', '24', '1516020907', '1516020907', NULL),
(8, 'Physics', 'Physics', '24', '24', '1516021335', '1516021335', NULL),
(9, 'Biology', 'Biology', '24', '24', '1516021353', '1516021353', NULL),
(10, 'English', 'English', '24', '24', '1516021353', '1516021370', '24');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_exam_class`
--

CREATE TABLE IF NOT EXISTS `teacher_exam_class` (
  `id` int(11) NOT NULL,
  `exam_id` text,
  `class_id` text,
  `section_id` text,
  `subject_id` text,
  `school_id` text,
  `academic_year` text,
  `created` text,
  `updated` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_manage_grade`
--

CREATE TABLE IF NOT EXISTS `teacher_manage_grade` (
  `id` int(12) NOT NULL,
  `exam_id` text,
  `class_id` text,
  `subject_id` text,
  `student_id` text,
  `grade` text,
  `marks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_test_exam`
--

CREATE TABLE IF NOT EXISTS `teacher_test_exam` (
  `id` int(11) NOT NULL,
  `exam_name` text,
  `marks` text,
  `school_id` text,
  `academic_year` text,
  `exam_date` text,
  `inhouse_global` text,
  `created_date` text,
  `updated_date` text,
  `last_updated_by` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `id` int(11) NOT NULL,
  `teacher_id` text,
  `day_id` text,
  `lecture_id` text,
  `class_id` text,
  `section_id` text,
  `subject_id` text,
  `academic_year` text,
  `created` text,
  `updated` text,
  `lecturestatus` text,
  `lunchbreak` text
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `teacher_id`, `day_id`, `lecture_id`, `class_id`, `section_id`, `subject_id`, `academic_year`, `created`, `updated`, `lecturestatus`, `lunchbreak`) VALUES
(1, '16', '1', '1', '1', '1', '1', '1', '1515678850', '1515678850', '1', '0'),
(2, '16', '2', '1', '1', '1', '1', '1', '1515678863', '1515678863', '1', '0'),
(3, '16', '3', '1', '1', '1', '1', '1', '1515679569', '1515679569', '1', '0'),
(4, '16', '4', '1', '2', '1', '2', '1', '1515679576', '1515679576', '1', '0'),
(5, '16', '5', '1', '2', '1', '2', '1', '1515679590', '1515679590', '1', '0'),
(6, '16', '6', '1', '', '', '', '1', '1515679596', '1515679596', '0', '0'),
(7, '16', '1', '5', '', '', '', '1', '1515679601', '1515679601', '0', '1'),
(8, '16', '2', '5', '', '', '', '1', '1515679607', '1515747501', '0', '1'),
(9, '16', '3', '5', '', '', '', '1', '1515679610', '1515679610', '0', '1'),
(10, '16', '4', '5', '', '', '', '1', '1515679614', '1515679614', '0', '1'),
(11, '16', '5', '5', '', '', '', '1', '1515679619', '1515679619', '0', '1'),
(12, '16', '6', '5', '', '', '', '1', '1515679623', '1515679623', '0', '1'),
(13, '16', '1', '2', '2', '1', '2', '1', '1515679634', '1515679634', '1', '0'),
(14, '16', '2', '2', '2', '1', '2', '1', '1515679641', '1515679641', '1', '0'),
(15, '16', '3', '2', '2', '1', '2', '1', '1515679652', '1515679652', '1', '0'),
(16, '16', '4', '2', '', '', '', '1', '1515679657', '1515679657', '0', '0'),
(17, '16', '5', '2', '1', '1', '1', '1', '1515679663', '1515679663', '1', '0'),
(18, '16', '6', '2', '1', '1', '1', '1', '1515679670', '1515679670', '1', '0'),
(19, '16', '1', '3', '1', '1', '1', '1', '1515679682', '1515679682', '1', '0'),
(20, '16', '2', '3', '', '', '', '1', '1515679685', '1515679685', '0', '0'),
(21, '16', '3', '3', '1', '1', '1', '1', '1515679699', '1515679699', '1', '0'),
(22, '16', '4', '3', '2', '1', '2', '1', '1515679728', '1515679728', '1', '0'),
(23, '16', '5', '3', '', '', '', '1', '1515679732', '1515679732', '0', '0'),
(24, '16', '6', '3', '', '', '', '1', '1515679735', '1515679735', '0', '0'),
(25, '16', '1', '4', '2', '1', '2', '1', '1515679749', '1515679749', '1', '0'),
(26, '16', '2', '4', '', '', '', '1', '1515679752', '1515679752', '0', '0'),
(27, '16', '3', '4', '', '', '', '1', '1515679758', '1515679758', '0', '0'),
(28, '16', '4', '4', '2', '1', '2', '1', '1515679783', '1515679783', '1', '0'),
(29, '16', '5', '4', '', '', '', '1', '1515679787', '1515679787', '0', '0'),
(30, '16', '6', '4', '', '', '', '1', '1515679790', '1515679790', '0', '0'),
(31, '16', '1', '6', '2', '1', '2', '1', '1515679798', '1515679798', '1', '0'),
(32, '16', '2', '6', '1', '1', '1', '1', '1515679820', '1515679820', '1', '0'),
(33, '16', '3', '6', '1', '1', '1', '1', '1515679827', '1515679827', '1', '0'),
(34, '16', '4', '6', '1', '1', '1', '1', '1515679833', '1515747521', '1', '0'),
(35, '16', '6', '6', '', '', '', '1', '1515679837', '1515679837', '0', '0'),
(36, '16', '5', '6', '1', '1', '1', '1', '1515679871', '1515679871', '1', '0'),
(37, '16', '1', '7', '', '', '', '1', '1515679875', '1515679875', '0', '0'),
(38, '16', '2', '7', '', '', '', '1', '1515679879', '1515679879', '0', '0'),
(39, '16', '3', '7', '1', '1', '1', '1', '1515679886', '1515679886', '1', '0'),
(40, '16', '4', '7', '2', '1', '2', '1', '1515679893', '1515679893', '1', '0'),
(41, '16', '5', '7', '', '', '', '1', '1515679898', '1515679898', '0', '0'),
(42, '16', '6', '7', '', '', '', '1', '1515679902', '1515679902', '0', '0'),
(43, '16', '1', '8', '', '', '', '1', '1515679913', '1515679913', '0', '0'),
(44, '16', '2', '8', '1', '1', '1', '1', '1515679920', '1515749618', '1', '0'),
(45, '16', '3', '8', '2', '1', '2', '1', '1515679927', '1515679927', '1', '0'),
(46, '16', '4', '8', '1', '1', '1', '1', '1515679936', '1515679936', '1', '0'),
(47, '16', '5', '8', '', '', '', '1', '1515679941', '1515679941', '0', '0'),
(48, '16', '6', '8', '1', '1', '1', '1', '1515679956', '1515679956', '1', '0'),
(49, '16', '1', '9', '2', '1', '2', '1', '1515679963', '1515679963', '1', '0'),
(50, '16', '2', '9', '2', '1', '2', '1', '1515679970', '1515679970', '1', '0'),
(51, '16', '3', '9', '2', '1', '2', '1', '1515679980', '1515679980', '1', '0'),
(52, '16', '4', '9', '1', '1', '1', '1', '1515679989', '1515679989', '1', '0'),
(53, '16', '5', '9', '1', '1', '1', '1', '1515679998', '1515679998', '1', '0'),
(54, '16', '6', '9', '1', '1', '1', '1', '1515680005', '1515680005', '1', '0'),
(55, '17', '1', '1', '1', '2', '4', '1', '1515683901', '1515683901', '1', '0'),
(56, '17', '1', '5', '', '', '', '1', '1515683916', '1515683916', '0', '1'),
(57, '17', '2', '5', '', '', '', '1', '1515683920', '1515683920', '0', '1'),
(58, '17', '1', '6', '', '', '', '1', '1515683944', '1515683944', '0', '0'),
(59, '34', '1', '1', '7', '5', '7', '2', '1516022159', '1516022159', '1', '0'),
(60, '34', '1', '2', '7', '5', '7', '2', '1516210790', '1516210790', '1', '0'),
(61, '17', '1', '2', '2', '1', '5', '1', '1527692467', '1527692467', '1', '0'),
(62, '17', '3', '7', '1', '1', '2', '1', '1527692478', '1527692478', '1', '0'),
(63, '17', '2', '6', '', '', '', '1', '1527692516', '1527692516', '0', '0'),
(64, '23', '1', '1', '', '', '', '1', '1542959739', '1542959739', '0', '0'),
(65, '23', '1', '2', '', '', '', '1', '1542959754', '1542959754', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` text COLLATE utf8_unicode_ci,
  `last_login` text COLLATE utf8_unicode_ci,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `school_id` text COLLATE utf8_unicode_ci,
  `hidden_password` text COLLATE utf8_unicode_ci,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role_id`, `last_login`, `status`, `school_id`, `hidden_password`, `created_at`, `updated_at`) VALUES
(1, 'admin@nomail.com', '_g6ckwCB9FmHBs3zUIxEJ-i0hKmSgx_I', '$2y$13$cye0c1LbfOB11bdD7XPv8OKR5vKaVCp0uDb3veTHUypZWzULkJb1q', '', 'admin@nomail.com', '0', '1545463240', 10, NULL, NULL, 1513951831, 1513951831),
(2, 'tikay@school.com', 'KX9NfN7C2ly_FfMY4OWvX7OaoY33MQUa', '$2y$13$uT9Z6KbSXm70SVzQCXLgVu3BbDH8E/mBQy/nDMAsslspifdmTYwPe', NULL, 'tikay@school.com', '1', '1545463305', 10, NULL, 'PTP6174232', 1515670344, 1515670344),
(3, 'pardeep@nomail.com', 'EnexMEdko5VFegm9shMrtbvf6bUGZfMI', '$2y$13$1Q8dBQQsvEyvXdqizCL.2.MIc/21m8ZF6s3O7AODDhy4.Biz.Fq/m', NULL, 'pardeep@nomail.com', '6', '1518509243', 10, '2', 'STUD7025885', 1515670855, 1515670855),
(4, 'priyanka@nomail.com', 'ZStumzgsWt-JCeXgPvp7OcqwXC35nK73', '$2y$13$YY1aaNLJ0y1fiU8.PtNlpOhk.kLHvKbWPt5n338x65WquYUkNgnoi', NULL, 'priyanka@nomail.com', '6', '1515686122', 10, '2', 'STUD10509213', 1515671185, 1515671185),
(5, 'varsha@nomail.com', '3lMtxSJTfcCiXE0oVH78ne4PNp2L5pdv', '$2y$13$9DTmmKZ3mol/dYRpviRpq.7gFh3Cl0s9Yv62fvk2xFN7KeupH/IWe', NULL, 'varsha@nomail.com', '6', NULL, 10, '2', 'STUD3757920', 1515671427, 1515671427),
(6, 'rajat@nomail.com', '8L0EaRimOZNOTq3ayWszn-gcXhh9D70n', '$2y$13$7fnFHmVQbQ9m.bmjtFPJ5OMnhl6Ca2fq4FeMYv7yg.MmxrJdz37ke', NULL, 'rajat@nomail.com', '6', NULL, 10, '2', 'STUD1670417', 1515671714, 1515671714),
(7, 'rohit@nomail.com', '4lzx0-jNywDICYCfPc0YH_kUbmcSZeHZ', '$2y$13$Zin2qiQLW5cChjifb3LQAOUvNQSLscrYXO.IscusdB2Sm.G81kSOy', NULL, 'rohit@nomail.com', '6', NULL, 10, '2', 'STUD11720880', 1515671880, 1515671880),
(8, 'varun@nomail.com', 'MOv-0cCkl5ZGudaoVHqQGLUP23QnfeTp', '$2y$13$u8oDlKjUX/LcyZdVOU/gK.62Rb1ISGi89UQcxBwNOjRuOXEXHoDb.', NULL, 'varun@nomail.com', '6', '1529649694', 10, '2', 'STUD9234507', 1515672006, 1515672006),
(9, 'sumit@nomail.com', 'lojsos6clWca3sOIhs_DGqpx9GXka83_', '$2y$13$69UOJGOeK3eYcHhoFafGqeom9Wi3dT1E4Y.PKNkGAlENDbdVAHBKS', NULL, 'sumit@nomail.com', '6', '1516083571', 10, '2', 'STUD5238146', 1515672315, 1515672315),
(10, 'pawan@nomail.com', 'yWdJ6EoosgS_NphPcrTvTrIWASAVk89C', '$2y$13$o4EdAsab5USEwxVU0/RGCegqXm1fRGdS.UPhYnK0nGK.WpDBnVmBy', NULL, 'pawan@nomail.com', '6', NULL, 10, '2', 'STUD6465830', 1515672514, 1515672514),
(11, 'rahul_dutta@gmail.com', 'lwTkWUWtgP1eeURoesaX6epcZPSF-NF2', '$2y$13$aiqxk.gz1QrkOkTH5fiV1u8lE4xKMlEvHHoqRGANBpiAdbUFQOXpS', NULL, 'rahul_dutta@gmail.com', '2', '1516017326', 10, '2', 'STF12059635', 1515672808, 1515672808),
(12, 'subash@nomails.com', 'ACQ__wPMqcbC92QGZK2w9haosWXoQev5', '$2y$13$rwNizxJyXS4vY7MMKlgrIuxCLMnrPYOInUFR6s1lOvMVS.ybFabQe', NULL, 'subash@nomails.com', '3', '1516017471', 10, '2', 'STF3341203', 1515673141, 1515673141),
(13, 'reenam@nomail.com', 'BIjCqZ52z1glG5lLBiIUqAK1ieEIqeHS', '$2y$13$8LXPO.AtnZUWr6VSD2s8Y.1cMmT3teFehOoznWCDJFjGaDi4Fqhra', NULL, 'reenam@nomail.com', '3', NULL, 10, '2', 'STF8447326', 1515673369, 1515673369),
(14, 'sukhdeep2@nomail.com', 'T_Bsw-Qov26CJtwQ8sFb-LX48BCObONJ', '$2y$13$PfKF2KIjnBgjrDP9uUEym.yvluUjcUpCtvTbx.wFD1JdDtuZyb16i', NULL, 'sukhdeep2@nomail.com', '4', '1515678613', 10, '2', 'STF6169088', 1515673718, 1515673718),
(15, 'vikram@nomail.com', 'u_H8zbhFrIgeO8VkyfMU28i-icsaFJoe', '$2y$13$VqOO7TBmmyCYzYXjheu.HOv8VMUS4EF45wde52KSWrS8RKHfpOUnC', NULL, 'vikram@nomail.com', '4', NULL, 10, '2', 'STF2487113', 1515674056, 1515674056),
(16, 'saurabh@nomail.com', '_F-GkImJXNq9Z8-vb9wYnUOyIZ9zIIae', '$2y$13$q7G0TsA5uKoSf91317QgxOvGF7aaIGd/JbOXmAlr4M1xEEq9fb9h.', NULL, 'saurabh@nomail.com', '5', '1528958179', 10, '2', 'PTP7925029', 1515675273, 1515675273),
(17, 'satveer@nomail.com', 'h0kKAFhE8x1gC2697VtjYlS5CrOJ9bFv', '$2y$13$473zYZ4MBgvYABGpHXGOtOu3D11ysq7fPO27dBJ9zjtczZJrghhyO', NULL, 'satveer@nomail.com', '5', '1516018253', 10, '2', 'STF8581589', 1515675841, 1515675841),
(18, 'hitesh@nomail.com', 'vC-THxl9uGu50No0s3_hCfyXbUiP2I5p', '$2y$13$LrNNO97boG7s8FJDUjG5w.SnnpiPDQkOVy.BY2WS7otcoTGKnerjO', NULL, 'hitesh@nomail.com', '5', '1529649592', 10, '2', 'PTP2172271', 1515676138, 1515676138),
(19, 'vijay@nomail.com', 'tqgeDXM-ZA6khApqa4crBMA1lEdYBE-8', '$2y$13$XWPnEzAhdLyiSuT6dnSU2un78WRwooW.86UFEuo3ukCanrydot2Ee', NULL, 'vijay@nomail.com', '5', NULL, 10, '2', 'STF7159137', 1515676867, 1515676867),
(20, 'lakshmi@nomail.ciom', 'SnYgbYxbGSxF8UiM7vLap6ZQkcgPJIhW', '$2y$13$tSd.jCHa7AyhUby3CJKE.OvkeeIQERODYuADFXUGhjbTlPAeEiOnK', NULL, 'lakshmi@nomail.ciom', '6', NULL, 10, '2', 'STUD1490840', 1515677810, 1515677810),
(21, 'rajat@nomails.com', 'T4y9tQtYSANuCerneq_82_GNaCTF1T5k', '$2y$13$jdTr7zjpyeLLiCQFepDZUuPURgNVCr8k2uiE2RklyO7hKnjrY8EgW', NULL, 'rajat@nomails.com', '3', NULL, 10, '2', 'STF1893834', 1515677892, 1515677892),
(22, 'nearani@nomail.com', 'v4pVg7ysUJ7PKXswY2p2Clrunrah5uLA', '$2y$13$DqOhKAGLYPaxKHMG2unRQeJV/z8.xsGQ6Vd5/5WgyKbixV5qmA1re', NULL, 'nearani@nomail.com', '5', NULL, 10, '2', 'STF3559674', 1515678073, 1515678073),
(23, 'richard@nomail.com', '_5KvU19DPg42K7g231TXuAX3KTkTKu8V', '$2y$13$PlNS2kba/l2JnMn0YdYHvOr2fJ/sUP1feUcG0RR.8t739i17cI0t6', NULL, 'richard@nomail.com', '5', '1542959709', 10, '2', 'PTP2856751', 1515678563, 1515678563),
(24, 'principal@nomail.com', 'kCNDVKwo1ZyOOhpG0BYgGUovVR73qbgT', '$2y$13$MQorFGVdaEYesbQghDAPyuuNPk.1qhaHKoEF5t5zY7jyPyawI99wC', NULL, 'principal@nomail.com', '1', '1516295699', 10, NULL, 'PTP7720732', 1515681596, 1515681596),
(25, 'abhi@nomails.com', 'kCuUL5I96o0gyaWHqI7kEQPDoeaDiDZD', '$2y$13$pRiSJ5kuvcX2SBYJegnpeey.fCSlJ/FfGN9FOuySFbOztzUdg.OAe', NULL, 'abhi@nomails.com', '6', NULL, 10, '2', 'STUD11984386', 1515743229, 1515743229),
(26, 'sdfsdf@fgdfgh.ghjgh', 'fsYCnCyhlOh18Ik_nkxwolS_aDhZVA9H', '$2y$13$vBGP4V6eBuIM6RzjsQwx1ej0fvluZeuURJgDWtuxvBHiNTTa4EkoW', NULL, 'sdfsdf@fgdfgh.ghjgh', '3', NULL, 10, '2', 'STF12319318', 1515768783, 1515768783),
(27, 'asdsasa!@ghjg.ghjgh', 'UZj06E0riSIzwyoReCTsVNWQN5J_eSSR', '$2y$13$1fOvrZkdJUWQDCaJEPgbve1VAYV/5YGi4oo1S4hY6tEtCl2i.bcGe', NULL, 'asdsasa!@ghjg.ghjgh', '6', NULL, 10, '2', 'STUD12145746', 1515768982, 1515768982),
(28, 'asd@fhgf.ghjgf', 'wuaIwZ1_cWkh9R_qEdS810aAl7zkbp5f', '$2y$13$KW5cy5m9PymaXR3.IQTsDuaof/GmPR6ATVRqBpQs4xNmEiLCiPs7m', NULL, 'asd@fhgf.ghjgf', '6', NULL, 10, '2', 'STUD11007336', 1515769475, 1515769475),
(29, 'dfsf@fghf.hgjgh', '_kZ-KkFFPf2c4dYVRnkqyvqnPoer3_aP', '$2y$13$SDqmfSWCAoP6Y57n75GkdeHubyXtjB9AmkivNHOpRpYuQ41Ir6lZa', NULL, 'dfsf@fghf.hgjgh', '6', NULL, 2, '2', 'STUD9274859', 1515769539, 1515769539),
(30, 'asdasd@gfh.fg', 'AfdueQHQSVI_gHHevqhOijO_-WgnXkXU', '$2y$13$q1kTZNPbktWrhf7dVtHAmuKqkQwZXyzYliYTPW9Sj9050O77ZyCmK', NULL, 'asdasd@gfh.fg', '6', NULL, 2, '2', 'STUD11801310', 1515769587, 1515769587),
(31, 'sdf@dgfdfg.fghgf', 'fVQdcP3MTbFxtxVzmW_NZ0f2DOIYel55', '$2y$13$Yb9ExdkU7nlmXq3DvnWoQeMPLeEU.VefjWEX5M72TSgamUUbjkAIa', NULL, 'sdf@dgfdfg.fghgf', '6', NULL, 2, '2', 'STUD2040853', 1515769746, 1515769746),
(32, 'anmol.modi@yunero.com', 'oaZQKFcYZA9TJ8QsXxUP-5600vO0QuIJ', '$2y$13$DzaZjU8n/4iGSoGrm.xZ.Oo6nrlABwNAZ6NOPmatvEPvrmfH.kAH.', NULL, 'anmol.modi@yunero.com', '6', '1516211213', 10, '24', 'STUD8614304', 1516020702, 1516020702),
(33, 'ankit.chowdhary@yunero.com', 'FL4Df6nrWgjspEFzT5o-rWd4lTflAQbY', '$2y$13$8OKu41rQx5OESCqPJT6SjOfCkY2ByYSEayo4uGtyanQ9j3jEegwNO', NULL, 'ankit.chowdhary@yunero.com', '3', NULL, 10, '24', 'STF6299858', 1516020774, 1516020774),
(34, 'abhishek.sith@yunero.com', 'HXsP80NWbhOvc5Bg1hEDGiP8lRNpXonE', '$2y$13$zxFqGPezoBlf4DQmleWnw.8xEgm580vB257n61R3zwGmMTaCFUznO', NULL, 'abhishek.sith@yunero.com', '5', '1516295841', 10, '24', 'PTP7294906', 1516020854, 1516020854),
(35, 'ashish.mohanka@yunero.com', 'pCv0kpvWCQv6cgqwlNoTrvjTmm4jUwWp', '$2y$13$d9zznaARAPJc2osEqGFXJOucO9uqeQhGopzGcMfABlkiveguymGuq', NULL, 'ashish.mohanka@yunero.com', '6', NULL, 10, '24', 'STUD12256442', 1516021053, 1516021053),
(36, 'raunak.tiwary@yunero.com', 'nk9n2t71pB041lUBwRLHzC5spHCW96oP', '$2y$13$IaM9b7gpXYYCFe0eDblFf.wpmma9h.I2YQhCv0Pz4By598DI7WG32', NULL, 'raunak.tiwary@yunero.com', '6', NULL, 10, '24', 'STUD6248607', 1516021131, 1516021131),
(37, 'vineeta.sharan@yunero.com', 'DUL_UNJPkavy9qCRHXe_CTVSvnftevKR', '$2y$13$Ur4VdxSadCokJS7EORjdwe9volMJyRCxrHLS0KFGFNN0nP7P2QzeO', NULL, 'vineeta.sharan@yunero.com', '5', NULL, 10, '24', 'STF11577041', 1516021198, 1516021198),
(38, 'rita.kapoor@yunero.com', 'pbjoNut9uC0VdMS5cJuRDXprkZcGTVPF', '$2y$13$cIFJo1kv5CoYqSmiAt7JteFN76Z6yG7FTYiJ7ISAI2eOOOBpGzKLi', NULL, 'rita.kapoor@yunero.com', '5', NULL, 10, '24', 'STF11305900', 1516021252, 1516021252);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acedemic_year`
--
ALTER TABLE `acedemic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_class`
--
ALTER TABLE `add_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_exam`
--
ALTER TABLE `add_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_grades`
--
ALTER TABLE `add_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_staff`
--
ALTER TABLE `add_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_student`
--
ALTER TABLE `add_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_test`
--
ALTER TABLE `add_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements_parent`
--
ALTER TABLE `announcements_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements_teacher`
--
ALTER TABLE `announcements_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anouncement_teachers_userids`
--
ALTER TABLE `anouncement_teachers_userids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignmentclasses`
--
ALTER TABLE `assignmentclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_assigned_student`
--
ALTER TABLE `class_assigned_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_info`
--
ALTER TABLE `class_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_student`
--
ALTER TABLE `class_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_subject`
--
ALTER TABLE `class_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_class`
--
ALTER TABLE `exam_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_exam`
--
ALTER TABLE `final_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_exam_grading`
--
ALTER TABLE `final_exam_grading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_exam_subjects`
--
ALTER TABLE `final_exam_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inhouse_test`
--
ALTER TABLE `inhouse_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inhouse_test_grading`
--
ALTER TABLE `inhouse_test_grading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inhouse_test_subjects`
--
ALTER TABLE `inhouse_test_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_grade`
--
ALTER TABLE `manage_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `school_list`
--
ALTER TABLE `school_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_exam_class`
--
ALTER TABLE `teacher_exam_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_manage_grade`
--
ALTER TABLE `teacher_manage_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_test_exam`
--
ALTER TABLE `teacher_test_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acedemic_year`
--
ALTER TABLE `acedemic_year`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `add_class`
--
ALTER TABLE `add_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `add_exam`
--
ALTER TABLE `add_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `add_grades`
--
ALTER TABLE `add_grades`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `add_staff`
--
ALTER TABLE `add_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `add_student`
--
ALTER TABLE `add_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `add_test`
--
ALTER TABLE `add_test`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `announcements_parent`
--
ALTER TABLE `announcements_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `announcements_teacher`
--
ALTER TABLE `announcements_teacher`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `anouncement_teachers_userids`
--
ALTER TABLE `anouncement_teachers_userids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `assignmentclasses`
--
ALTER TABLE `assignmentclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `class_assigned_student`
--
ALTER TABLE `class_assigned_student`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class_info`
--
ALTER TABLE `class_info`
  MODIFY `id` int(110) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `class_student`
--
ALTER TABLE `class_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `class_subject`
--
ALTER TABLE `class_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_class`
--
ALTER TABLE `exam_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `final_exam`
--
ALTER TABLE `final_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `final_exam_grading`
--
ALTER TABLE `final_exam_grading`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `final_exam_subjects`
--
ALTER TABLE `final_exam_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `inhouse_test`
--
ALTER TABLE `inhouse_test`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `inhouse_test_grading`
--
ALTER TABLE `inhouse_test_grading`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `inhouse_test_subjects`
--
ALTER TABLE `inhouse_test_subjects`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `manage_grade`
--
ALTER TABLE `manage_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `school_list`
--
ALTER TABLE `school_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `teacher_exam_class`
--
ALTER TABLE `teacher_exam_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher_manage_grade`
--
ALTER TABLE `teacher_manage_grade`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacher_test_exam`
--
ALTER TABLE `teacher_test_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
