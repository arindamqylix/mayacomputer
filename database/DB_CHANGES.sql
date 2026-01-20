-- Adminer 5.3.0 MariaDB 10.4.32-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE `admin_login` (
  `al_id` int(11) NOT NULL AUTO_INCREMENT,
  `al_name` varchar(255) DEFAULT NULL,
  `al_email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`al_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin_login` (`al_id`, `al_name`, `al_email`, `password`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'admin@admin.com',	'$2a$12$nWdEyWHRluYNpEVARdq.n.4FDTLAdY5MavVRPOBSq4IxOh0yT9RFG',	'2024-03-22 16:43:41',	'2024-03-22 16:43:41');

DROP TABLE IF EXISTS `attendance_mark`;
CREATE TABLE `attendance_mark` (
  `am_id` int(11) NOT NULL AUTO_INCREMENT,
  `am_FK_of_batch_id` int(11) DEFAULT NULL,
  `am_FK_of_student_id` int(11) DEFAULT NULL,
  `am_FK_of_center_id` int(11) DEFAULT NULL,
  `am_status` enum('PRESENT','ABSENT') DEFAULT NULL,
  `am_date` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`am_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `attendance_mark` (`am_id`, `am_FK_of_batch_id`, `am_FK_of_student_id`, `am_FK_of_center_id`, `am_status`, `am_date`, `created_at`, `updated_at`) VALUES
(44,	1,	1,	1,	'PRESENT',	'2024-04-26',	'2024-04-27 05:41:15',	'2024-04-27 05:41:15'),
(45,	1,	2,	1,	'PRESENT',	'2024-04-26',	'2024-04-27 05:41:15',	'2024-04-27 05:41:15'),
(46,	1,	3,	1,	'PRESENT',	'2024-04-26',	'2024-04-27 05:41:15',	'2024-04-27 05:41:15'),
(47,	1,	1,	1,	'PRESENT',	'2024-04-27',	'2024-04-27 05:42:54',	'2024-04-27 05:42:54'),
(48,	1,	2,	1,	'PRESENT',	'2024-04-27',	'2024-04-27 05:42:54',	'2024-04-27 05:42:54'),
(49,	1,	3,	1,	'PRESENT',	'2024-04-27',	'2024-04-27 05:42:54',	'2024-04-27 05:42:54'),
(50,	1,	1,	1,	'PRESENT',	'2024-04-29',	'2024-04-28 23:51:56',	'2024-04-28 23:51:56'),
(51,	1,	2,	1,	'PRESENT',	'2024-04-29',	'2024-04-28 23:51:56',	'2024-04-28 23:51:56'),
(52,	1,	3,	1,	'PRESENT',	'2024-04-29',	'2024-04-28 23:51:56',	'2024-04-28 23:51:56'),
(53,	1,	2,	1,	'PRESENT',	'2024-05-24',	'2024-05-24 08:30:06',	'2024-05-24 08:30:06'),
(54,	1,	3,	1,	'PRESENT',	'2024-05-24',	'2024-05-24 08:30:06',	'2024-05-24 08:30:06'),
(55,	1,	7,	3,	'PRESENT',	'2025-11-23',	'2025-11-22 20:33:16',	'2025-11-22 20:33:16');

DROP TABLE IF EXISTS `attendence_batch`;
CREATE TABLE `attendence_batch` (
  `ab_id` int(11) NOT NULL AUTO_INCREMENT,
  `ab_FK_of_center_id` int(11) DEFAULT NULL,
  `ab_name` text DEFAULT NULL,
  `ab_start_time` varchar(100) DEFAULT NULL,
  `ab_end_time` varchar(100) DEFAULT NULL,
  `ab_status` enum('ACTIVE','PENDING','BLOCK') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `attendence_batch` (`ab_id`, `ab_FK_of_center_id`, `ab_name`, `ab_start_time`, `ab_end_time`, `ab_status`, `created_at`, `updated_at`) VALUES
(1,	1,	'Morning',	'10:00',	'12:13',	'ACTIVE',	'2024-04-11 11:13:28',	'2024-04-11 11:13:28'),
(3,	1,	'Evening',	'15:00',	'17:00',	'ACTIVE',	'2024-04-12 08:16:25',	'2024-04-12 08:16:25');

DROP TABLE IF EXISTS `attendence_set`;
CREATE TABLE `attendence_set` (
  `as_id` int(11) NOT NULL AUTO_INCREMENT,
  `as_FK_of_student_id` int(11) DEFAULT NULL,
  `as_FK_of_attendance_batch_id` int(11) DEFAULT NULL,
  `as_FK_of_center_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`as_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `attendence_set` (`as_id`, `as_FK_of_student_id`, `as_FK_of_attendance_batch_id`, `as_FK_of_center_id`, `created_at`, `updated_at`) VALUES
(15,	1,	1,	1,	'2024-04-20 01:10:29',	'2024-04-20 01:10:29'),
(16,	2,	1,	1,	'2024-04-20 01:10:29',	'2024-04-20 01:10:29'),
(17,	3,	1,	1,	'2024-04-20 01:10:29',	'2024-04-20 01:10:29'),
(18,	7,	1,	3,	'2025-11-22 20:32:28',	'2025-11-22 20:32:28'),
(19,	7,	1,	3,	'2025-11-22 20:32:36',	'2025-11-22 20:32:36');

DROP TABLE IF EXISTS `center_login`;
CREATE TABLE `center_login` (
  `cl_id` int(11) NOT NULL AUTO_INCREMENT,
  `cl_code` varchar(255) DEFAULT NULL,
  `cl_center_name` text DEFAULT NULL,
  `cl_director_name` text DEFAULT NULL,
  `cl_center_address` text DEFAULT NULL,
  `cl_cin_no` text DEFAULT NULL,
  `cl_name` text DEFAULT NULL,
  `cl_photo` text DEFAULT NULL,
  `cl_logo` text DEFAULT NULL,
  `cl_authorized_signature` text DEFAULT NULL,
  `cl_center_stamp` varchar(255) DEFAULT NULL,
  `cl_center_signature` varchar(255) DEFAULT NULL,
  `cl_director_adhar` varchar(255) DEFAULT NULL,
  `cl_director_pan` varchar(255) DEFAULT NULL,
  `cl_director_education` varchar(255) DEFAULT NULL,
  `cl_email` text DEFAULT NULL,
  `cl_mobile` varchar(20) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `cl_wallet_balance` float DEFAULT 0,
  `cl_account_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `center_login` (`cl_id`, `cl_code`, `cl_center_name`, `cl_director_name`, `cl_center_address`, `cl_cin_no`, `cl_name`, `cl_photo`, `cl_logo`, `cl_authorized_signature`, `cl_center_stamp`, `cl_center_signature`, `cl_director_adhar`, `cl_director_pan`, `cl_director_education`, `cl_email`, `cl_mobile`, `password`, `cl_wallet_balance`, `cl_account_status`, `created_at`, `updated_at`) VALUES
(3,	'61123000',	'Webel Computer Center',	'Daipayan Kayal',	'Kolkata',	NULL,	'Webel Computer Center',	'center_documents/691ebb8581a00.png',	NULL,	NULL,	'center_documents/691ebb8581f50.png',	'center_documents/691ebb8582262.png',	'center_documents/691ebb8582455.png',	'center_documents/691ebb85825f4.png',	'M.Tech',	'daipayan89@gmail.com',	'8967567890',	'$2y$10$87.TMTk1R4q9vF19x0PNG.DEkN3NEN1tnkhVgEgjydeHLf5XFphLK',	7400,	'ACTIVE',	'2025-11-20 01:26:05',	'2025-11-22 07:30:23');

DROP TABLE IF EXISTS `center_recharge`;
CREATE TABLE `center_recharge` (
  `cr_id` int(11) NOT NULL AUTO_INCREMENT,
  `cr_payment_id` text DEFAULT NULL,
  `cr_razorpay_id` text DEFAULT NULL,
  `cr_FK_of_center_id` int(11) DEFAULT NULL,
  `cr_amount` float DEFAULT NULL,
  `cr_status` int(11) NOT NULL DEFAULT 0,
  `cr_type` varchar(255) NOT NULL DEFAULT 'CREDIT',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`cr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `center_recharge` (`cr_id`, `cr_payment_id`, `cr_razorpay_id`, `cr_FK_of_center_id`, `cr_amount`, `cr_status`, `cr_type`, `created_at`, `updated_at`) VALUES
(9,	'order_O0SOFb6ghHsFt2',	'pay_O0SPjIuYBYvXFp',	1,	100,	1,	'CREDIT',	'2024-04-19 05:31:00',	'2024-04-19 11:02:38'),
(10,	'order_O0SRxG9WomYsFf',	'pay_O0SSUfEk8QD6Qb',	1,	60,	1,	'CREDIT',	'2024-04-19 05:34:30',	'2024-04-19 11:05:11'),
(11,	'order_O0UngpvybUYr3x',	'pay_O0Uo91jggVrX7R',	1,	300,	1,	'CREDIT',	'2024-04-19 07:52:28',	'2024-04-19 13:23:04'),
(12,	'order_O0lSUiAw9b2ucX',	'pay_O0lTGlche2CEAc',	1,	10000,	1,	'CREDIT',	'2024-04-20 00:10:12',	'2024-04-20 05:41:06'),
(13,	'order_O1a2v6eOzBiGxs',	'pay_O1a3PuK3OiX8Od',	1,	100,	1,	'CREDIT',	'2024-04-22 01:39:21',	'2024-04-22 07:09:59');

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_short_name` varchar(255) DEFAULT NULL,
  `c_full_name` text DEFAULT NULL,
  `c_price` float DEFAULT NULL,
  `c_duration` varchar(255) DEFAULT NULL,
  `c_module_cover` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `course` (`c_id`, `c_short_name`, `c_full_name`, `c_price`, `c_duration`, `c_module_cover`, `created_at`, `updated_at`) VALUES
(1,	'DDEO',	'Diploma in Data Entry Operation',	2000,	'2',	NULL,	'2024-04-08 08:29:58',	'2024-04-08 08:29:58');

DROP TABLE IF EXISTS `fees_payment`;
CREATE TABLE `fees_payment` (
  `fp_id` int(11) NOT NULL AUTO_INCREMENT,
  `fp_receipt_no` int(11) DEFAULT NULL,
  `fp_FK_of_student_id` int(11) DEFAULT NULL,
  `fp_FK_of_center_id` int(11) DEFAULT NULL,
  `fp_date` varchar(20) DEFAULT NULL,
  `fp_total_amount` float DEFAULT NULL,
  `fp_amount` float DEFAULT NULL,
  `fp_dues_amount` int(11) DEFAULT NULL,
  `fp_remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`fp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `fees_payment` (`fp_id`, `fp_receipt_no`, `fp_FK_of_student_id`, `fp_FK_of_center_id`, `fp_date`, `fp_total_amount`, `fp_amount`, `fp_dues_amount`, `fp_remarks`, `created_at`, `updated_at`) VALUES
(10,	1,	2,	1,	'2024-04-12',	2000,	500,	NULL,	'Fees Amount',	'2024-04-13 10:42:14',	'2024-04-13 10:42:14'),
(11,	2,	2,	1,	'2024-04-13',	1500,	300,	NULL,	'Fees Amount',	'2024-04-13 10:42:30',	'2024-04-13 10:42:30'),
(12,	3,	1,	1,	'2024-04-13',	1500,	1500,	NULL,	'Fees Amount',	'2024-04-13 10:44:38',	'2024-04-13 10:44:38');

DROP TABLE IF EXISTS `income_expense`;
CREATE TABLE `income_expense` (
  `ie_id` int(11) NOT NULL AUTO_INCREMENT,
  `ie_FK_of_center_id` int(11) DEFAULT NULL,
  `ie_FK_of_admin_id` int(11) DEFAULT NULL,
  `ie_type` varchar(255) DEFAULT NULL,
  `ie_date` varchar(20) DEFAULT NULL,
  `ie_amount` float DEFAULT NULL,
  `ie_mode` varchar(255) DEFAULT NULL,
  `ie_remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `income_expense` (`ie_id`, `ie_FK_of_center_id`, `ie_FK_of_admin_id`, `ie_type`, `ie_date`, `ie_amount`, `ie_mode`, `ie_remarks`, `created_at`, `updated_at`) VALUES
(7,	NULL,	1,	'INCOME',	'2024-04-10',	1000,	'BANK',	'Test',	'2024-04-11 06:00:42',	'2024-04-11 06:00:42'),
(9,	1,	NULL,	'INCOME',	'2024-04-10',	1000,	'CASH',	'Test',	'2024-04-12 08:13:28',	'2024-04-12 08:13:28'),
(10,	1,	NULL,	'EXPENSE',	'2024-04-12',	500,	'CASH',	'Send Money',	'2024-04-12 08:13:50',	'2024-04-12 08:13:50'),
(11,	NULL,	1,	'INCOME',	'2024-04-25',	2000,	'BANK',	'Send Money',	'2024-04-25 07:47:40',	'2024-04-25 07:47:40');

DROP TABLE IF EXISTS `set_fee`;
CREATE TABLE `set_fee` (
  `sf_id` int(11) NOT NULL AUTO_INCREMENT,
  `sf_FK_of_student_id` int(11) DEFAULT NULL,
  `sf_FK_of_center_id` int(11) DEFAULT NULL,
  `sf_amount` float DEFAULT NULL,
  `sf_paid` float DEFAULT 0,
  `sf_due` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `set_fee` (`sf_id`, `sf_FK_of_student_id`, `sf_FK_of_center_id`, `sf_amount`, `sf_paid`, `sf_due`, `created_at`, `updated_at`) VALUES
(6,	1,	1,	1500,	1500,	0,	'2024-04-13 08:20:37',	'2024-04-13 10:44:38'),
(7,	2,	1,	0,	2000,	1200,	'2024-04-13 08:20:40',	'2024-04-13 10:42:30');

DROP TABLE IF EXISTS `set_result`;
CREATE TABLE `set_result` (
  `sr_id` int(11) NOT NULL AUTO_INCREMENT,
  `sr_FK_of_student_id` int(11) DEFAULT NULL,
  `sr_FK_of_center_id` int(11) DEFAULT NULL,
  `sr_written` varchar(255) DEFAULT NULL,
  `sr_wr_full_marks` float DEFAULT NULL,
  `sr_wr_pass_marks` float DEFAULT NULL,
  `sr_wr_marks_obtained` float DEFAULT NULL,
  `sr_practical` varchar(255) DEFAULT NULL,
  `sr_pr_full_marks` float DEFAULT NULL,
  `sr_pr_pass_marks` float DEFAULT NULL,
  `sr_pr_marks_obtained` float DEFAULT NULL,
  `sr_project` varchar(255) DEFAULT NULL,
  `sr_ap_full_marks` float DEFAULT NULL,
  `sr_ap_pass_marks` float DEFAULT NULL,
  `sr_ap_marks_obtained` float DEFAULT NULL,
  `sr_viva` varchar(255) DEFAULT NULL,
  `sr_vv_full_marks` float DEFAULT NULL,
  `sr_vv_pass_marks` float DEFAULT NULL,
  `sr_vv_marks_obtained` float DEFAULT NULL,
  `sr_total_full_marks` float DEFAULT NULL,
  `sr_total_pass_marks` float DEFAULT NULL,
  `sr_total_marks_obtained` float DEFAULT NULL,
  `sr_percentage` float DEFAULT NULL,
  `sr_grade` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `set_result` (`sr_id`, `sr_FK_of_student_id`, `sr_FK_of_center_id`, `sr_written`, `sr_wr_full_marks`, `sr_wr_pass_marks`, `sr_wr_marks_obtained`, `sr_practical`, `sr_pr_full_marks`, `sr_pr_pass_marks`, `sr_pr_marks_obtained`, `sr_project`, `sr_ap_full_marks`, `sr_ap_pass_marks`, `sr_ap_marks_obtained`, `sr_viva`, `sr_vv_full_marks`, `sr_vv_pass_marks`, `sr_vv_marks_obtained`, `sr_total_full_marks`, `sr_total_pass_marks`, `sr_total_marks_obtained`, `sr_percentage`, `sr_grade`, `created_at`, `updated_at`) VALUES
(1,	2,	1,	'Written',	100,	40,	100,	'Practical',	100,	40,	99,	'Assignment/Project',	100,	40,	98,	'Viva Voce',	100,	40,	99,	400,	160,	396,	99,	'A+',	'2024-04-22 02:22:02',	'2024-04-22 02:22:02'),
(2,	3,	1,	'Written',	100,	40,	78,	'Practical',	100,	40,	90,	'Assignment/Project',	100,	40,	55,	'Viva Voce',	100,	40,	45,	400,	160,	268,	67,	'C',	'2024-04-22 08:28:06',	'2024-04-22 08:28:06');

DROP TABLE IF EXISTS `student_admit_cards`;
CREATE TABLE `student_admit_cards` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT,
  `center_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `exam_time` time DEFAULT NULL,
  `exam_venue` text DEFAULT NULL,
  `exam_notice` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `student_login`;
CREATE TABLE `student_login` (
  `sl_id` int(11) NOT NULL AUTO_INCREMENT,
  `sl_FK_of_course_id` int(11) DEFAULT NULL,
  `sl_FK_of_center_id` int(11) DEFAULT NULL,
  `sl_dob` varchar(150) DEFAULT NULL,
  `sl_qualification` text DEFAULT NULL,
  `sl_reg_no` text DEFAULT NULL,
  `sl_sex` varchar(50) DEFAULT NULL,
  `sl_address` text DEFAULT NULL,
  `sl_name` text DEFAULT NULL,
  `sl_photo` text DEFAULT NULL,
  `sl_id_card` text DEFAULT NULL,
  `sl_mother_name` varchar(255) DEFAULT NULL,
  `sl_mobile_no` varchar(150) DEFAULT NULL,
  `sl_father_name` varchar(255) DEFAULT NULL,
  `sl_educational_certificate` text DEFAULT NULL,
  `sl_email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `sl_balance` float DEFAULT 0,
  `sl_status` enum('PENDING','VERIFIED','RESULT UPDATED','RESULT OUT','DISPATCHED','BLOCK') DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `student_login` (`sl_id`, `sl_FK_of_course_id`, `sl_FK_of_center_id`, `sl_dob`, `sl_qualification`, `sl_reg_no`, `sl_sex`, `sl_address`, `sl_name`, `sl_photo`, `sl_id_card`, `sl_mother_name`, `sl_mobile_no`, `sl_father_name`, `sl_educational_certificate`, `sl_email`, `password`, `sl_balance`, `sl_status`, `created_at`, `updated_at`) VALUES
(1,	1,	0,	NULL,	NULL,	'911076010000',	NULL,	NULL,	'Student',	'1712687249_IMG-20240306-WA0014.jpg',	NULL,	NULL,	NULL,	NULL,	NULL,	'student@student.com',	'$2a$12$nWdEyWHRluYNpEVARdq.n.4FDTLAdY5MavVRPOBSq4IxOh0yT9RFG',	0,	'VERIFIED',	'2024-03-22 16:44:47',	'2024-04-12 07:53:12'),
(2,	1,	1,	'2014-12-30',	'Graduate',	'911076010001',	'MALE',	'Gutinagori',	'Arindam Bera',	'1712687249_IMG-20240306-WA0014.jpg',	'1712687249_New_2023_Yamaha_MT_15_1.jpg',	'Mita Bera',	'9007049952',	'Rupkumar Bera',	'1712687249_IMG-20240306-WA0014.jpg',	'abera0275@gmail.com',	'$2a$12$wNppcmIt9yYR2GgWGFUJNOuuaU.2PWwOWMGkalmWjM8H2EpdujbeC',	0,	'PENDING',	'2024-04-09 12:57:29',	'2025-11-19 01:16:32'),
(3,	1,	1,	'2012-01-01',	'Matric',	'911076010002',	'FEMALE',	'kolkata',	'Arpita Kumir',	'1713530750_header.png',	'1713530750_header.png',	'Radha Kumir',	'1234567890',	'Raja Kumir',	'1713530750_header.png',	'arpita@gmail.com',	NULL,	0,	'RESULT OUT',	'2024-04-19 07:15:50',	'2024-04-22 08:28:06'),
(4,	1,	1,	'2014-12-31',	'Post Graduate',	'911076010003',	'MALE',	'Oddisha',	'Ompraksah Das',	'1713611592_IMG-20240306-WA0010.jpg',	'1713611592_IMG-20240306-WA0010.jpg',	'Shamoli Das',	'8976498098',	'Suraj Das',	'1713611592_IMG-20240306-WA0010.jpg',	'omprakash@gmail.com',	NULL,	0,	'PENDING',	'2024-04-20 05:43:12',	'2024-04-20 05:43:12'),
(5,	1,	1,	'2015-01-01',	'Non Matric',	'9111076012345',	'MALE',	'Kolkata',	'Sanchita Modak',	'student/691ebab3844db.png',	'student/691ebab3857ec.png',	'Rima Modak',	'9087567890',	'Rahul Modak',	'student/691ebab385e8b.png',	'sanchita67@gmail.com',	'$2y$10$duBHlsPUaq.IMDfullg10enZT0iVaQe6zSjJQJe5/gQtdh3Gndv3u',	0,	'PENDING',	'2025-11-20 01:22:35',	'2025-11-20 01:22:35'),
(7,	1,	3,	'2015-01-01',	'Matric',	'911076019089',	'MALE',	'Kolkata',	'Raj Barman',	'1763829042_testi_1_1.jpg',	'1763828885_favicon.png',	'Ritu Barman',	'8967894567',	'Rohit Barman',	NULL,	'raj678@gmail.com',	NULL,	0,	'VERIFIED',	'2025-11-22 07:30:23',	'2025-11-22 20:32:14');

DROP TABLE IF EXISTS `student_reg_fee`;
CREATE TABLE `student_reg_fee` (
  `srf_id` int(11) NOT NULL AUTO_INCREMENT,
  `srf_amount` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`srf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `student_reg_fee` (`srf_id`, `srf_amount`, `created_at`, `updated_at`) VALUES
(1,	300,	'2024-04-19 12:49:17',	'2024-04-19 07:52:00');

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_FK_of_center_id` int(11) DEFAULT NULL,
  `t_student_reg_no` varchar(255) DEFAULT NULL,
  `t_amount` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `transaction` (`t_id`, `t_FK_of_center_id`, `t_student_reg_no`, `t_amount`, `created_at`, `updated_at`) VALUES
(1,	1,	'911076010002',	50,	'2024-04-19 12:45:50',	'2024-04-19 12:45:50'),
(2,	1,	'911076010003',	300,	'2024-04-20 11:13:12',	'2024-04-20 11:13:12'),
(3,	1,	'9111076012345',	300,	'2025-11-20 06:52:35',	'2025-11-20 06:52:35'),
(4,	3,	'91107601611230009089',	300,	'2025-11-22 12:28:00',	'2025-11-22 12:28:00'),
(5,	3,	'911076019089',	300,	'2025-11-22 13:00:23',	'2025-11-22 13:00:23');

-- 2025-11-23 02:31:06 UTC


-- 23-11-2025

-- conversations
CREATE TABLE `conversations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `type` VARCHAR(50) NULL, -- "student_center" or "center_admin"
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- conversation participants (no FK, plain columns)
CREATE TABLE `conversation_participants` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `conversation_id` BIGINT UNSIGNED NOT NULL,
  `participant_id` BIGINT UNSIGNED NOT NULL,
  `participant_type` VARCHAR(50) NOT NULL, -- 'student_login' | 'center_login' | 'admin_login'
  `last_read_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- messages (no FK constraints)
CREATE TABLE `messages` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `conversation_id` BIGINT UNSIGNED NOT NULL,
  `sender_id` BIGINT UNSIGNED NOT NULL,
  `sender_type` VARCHAR(50) NOT NULL,   -- 'student_login' | 'center_login' | 'admin_login'
  `body` TEXT,
  `is_read` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cms_directors` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255) DEFAULT NULL,
    `designation` VARCHAR(255) DEFAULT NULL,
    `type` VARCHAR(100) DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cms_course` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `course_name` VARCHAR(255) NOT NULL,
    `course_image` VARCHAR(255) DEFAULT NULL,
    `course_duration` VARCHAR(100) DEFAULT NULL,
    `course_details` TEXT DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cms_downloads` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `download_name` VARCHAR(255) NOT NULL,
    `type` VARCHAR(100) DEFAULT NULL,
    `file` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cms_gallery` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `file` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contact_requests` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    `subject` VARCHAR(255) DEFAULT NULL,
    `message` TEXT DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `site_settings` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(50) NOT NULL,
    `address` TEXT NOT NULL,
    `site_logo` VARCHAR(255) DEFAULT NULL,
    `site_fav_icon` VARCHAR(255) DEFAULT NULL,
    `copyright` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 30-11-2025

ALTER TABLE `site_settings`
ADD `map` text COLLATE 'utf8mb4_unicode_ci' NULL AFTER `copyright`;

ALTER TABLE course
ADD COLUMN file VARCHAR(255) DEFAULT NULL AFTER c_id,
ADD COLUMN description LONGTEXT DEFAULT NULL AFTER c_duration,
ADD COLUMN category_name VARCHAR(255) DEFAULT NULL AFTER description,
ADD COLUMN course_syllabus LONGTEXT DEFAULT NULL AFTER category_name,
ADD COLUMN information LONGTEXT DEFAULT NULL AFTER course_syllabus;

ALTER TABLE `course`
ADD `slug` varchar(255) COLLATE 'utf8mb4_general_ci' NULL AFTER `c_full_name`;

-- Adminer 5.3.0 MariaDB 10.4.32-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `cms_banner`;
CREATE TABLE `cms_banner` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cms_banner` (`id`, `file`, `created_at`, `updated_at`) VALUES
(1,	'banner/1764504435_692c337393988.jpg',	'2025-11-30 06:37:15',	'2025-11-30 06:37:15');

-- 2025-11-30 13:50:20 UTC

-- 01-12-2025

ALTER TABLE `cms_downloads`
ADD `slug` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `download_name`;

-- 02-12-2025

ALTER TABLE `site_settings`
ADD `breadcumb_image` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `site_fav_icon`;

ALTER TABLE `cms_directors`
ADD `description` text COLLATE 'utf8mb4_unicode_ci' NULL AFTER `designation`;

-- 03-12-2025

CREATE TABLE `course` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `c_short_name` varchar(255) DEFAULT NULL,
  `c_full_name` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `c_price` float DEFAULT NULL,
  `c_duration` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `course_syllabus` longtext DEFAULT NULL,
  `information` longtext DEFAULT NULL,
  `c_module_cover` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `cms_course`
ADD `categoy_id` int(11) NULL AFTER `c_id`;

CREATE TABLE cms_course_category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    status TINYINT(1) DEFAULT 1,          -- 1 = active, 0 = inactive
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- 05-12-2025

ALTER TABLE `site_settings`
ADD `corporate_address` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `breadcumb_image`,
ADD `facebook` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `corporate_address`,
ADD `twitter` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `facebook`,
ADD `instagram` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `twitter`,
ADD `youtube` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `instagram`;

-- 06-12-2025

CREATE TABLE `cms_pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cms_pages_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cms_about_us` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `section` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cms_homepage_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_type` varchar(50) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `link_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 18-12-2025

CREATE TABLE `whatsapp_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `variables` text DEFAULT NULL COMMENT 'JSON array of available variables like ["name", "course", "center"]',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `template_name` (`template_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Add title field to cms_banner table for badge text at top
ALTER TABLE `cms_banner`
ADD `title` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `file`;

-- 13-01-2026

ALTER TABLE `student_certificates`
CHANGE `sc_status` `sc_status` enum('GENERATED','ISSUED','VERIFIED','RECEIVED') COLLATE 'utf8mb4_general_ci' NULL DEFAULT 'GENERATED' AFTER `sc_issue_date`;

-- 20-01-2026

ALTER TABLE `site_settings`
ADD `document_logo` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `site_logo`,
ADD `certificate_footer_logos` text COLLATE 'utf8mb4_unicode_ci' NULL AFTER `document_logo`;