-- Hindi / English WPM for typing certificates (admin + center generate forms)
ALTER TABLE `student_certificates`
ADD COLUMN `sc_typing_speed_hindi` VARCHAR(50) NULL DEFAULT NULL AFTER `sc_typing_speed`,
ADD COLUMN `sc_typing_speed_english` VARCHAR(50) NULL DEFAULT NULL AFTER `sc_typing_speed_hindi`;
