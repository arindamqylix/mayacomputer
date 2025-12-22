-- Add courier/dispatch fields to student_certificates table
ALTER TABLE `student_certificates` 
ADD COLUMN `sc_dispatch_thru` VARCHAR(255) NULL COMMENT 'Courier/Company name' AFTER `sc_status`,
ADD COLUMN `sc_dispatch_date` DATE NULL COMMENT 'Date when certificate was dispatched' AFTER `sc_dispatch_thru`,
ADD COLUMN `sc_tracking_number` VARCHAR(255) NULL COMMENT 'Courier tracking number' AFTER `sc_dispatch_date`,
ADD COLUMN `sc_doc_quantity` INT(11) DEFAULT 1 COMMENT 'Number of documents dispatched' AFTER `sc_tracking_number`;

