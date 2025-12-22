-- Create document reissue requests table
CREATE TABLE IF NOT EXISTS `document_reissue_requests` (
  `drr_id` INT(11) NOT NULL AUTO_INCREMENT,
  `drr_FK_of_student_id` INT(11) NOT NULL,
  `drr_document_type` ENUM('CERTIFICATE', 'MARKSHEET', 'ID_CARD') NOT NULL,
  `drr_status` ENUM('PENDING', 'PAID', 'PROCESSING', 'COMPLETED', 'REJECTED') DEFAULT 'PENDING',
  `drr_amount` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `drr_payment_status` ENUM('PENDING', 'PAID', 'FAILED') DEFAULT 'PENDING',
  `drr_payment_id` VARCHAR(255) NULL,
  `drr_remarks` TEXT NULL,
  `drr_admin_remarks` TEXT NULL,
  `drr_requested_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `drr_processed_at` TIMESTAMP NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`drr_id`),
  KEY `idx_student` (`drr_FK_of_student_id`),
  KEY `idx_status` (`drr_status`),
  KEY `idx_document_type` (`drr_document_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

