-- Create course_syllabus table for storing course videos and PDFs
CREATE TABLE IF NOT EXISTS `course_syllabus` (
  `cs_id` int(11) NOT NULL AUTO_INCREMENT,
  `cs_FK_of_course_id` int(11) NOT NULL,
  `cs_type` enum('video','pdf') NOT NULL COMMENT 'Type: video (YouTube link) or pdf (file upload)',
  `cs_title` varchar(255) NOT NULL,
  `cs_description` text DEFAULT NULL,
  `cs_video_url` text DEFAULT NULL COMMENT 'YouTube video URL or embed link',
  `cs_pdf_file` varchar(255) DEFAULT NULL COMMENT 'PDF file path',
  `cs_order` int(11) DEFAULT 0 COMMENT 'Display order',
  `cs_status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`cs_id`),
  KEY `cs_FK_of_course_id` (`cs_FK_of_course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

