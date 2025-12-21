DROP TABLE IF EXISTS `student_certificates`;
CREATE TABLE `student_certificates` (
  `sc_id` int(11) NOT NULL AUTO_INCREMENT,
  `sc_FK_of_student_id` int(11) DEFAULT NULL,
  `sc_FK_of_center_id` int(11) DEFAULT NULL,
  `sc_FK_of_result_id` int(11) DEFAULT NULL,
  `sc_certificate_number` varchar(255) DEFAULT NULL,
  `sc_issue_date` date DEFAULT NULL,
  `sc_status` enum('GENERATED','ISSUED','VERIFIED') DEFAULT 'GENERATED',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`sc_id`),
  KEY `idx_student` (`sc_FK_of_student_id`),
  KEY `idx_center` (`sc_FK_of_center_id`),
  KEY `idx_result` (`sc_FK_of_result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

