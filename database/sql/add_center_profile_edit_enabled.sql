-- Add column to center_login table for profile edit enable/disable
ALTER TABLE `center_login` 
ADD COLUMN `cl_profile_edit_enabled` TINYINT(1) DEFAULT 0 COMMENT '1 = Enabled, 0 = Disabled' AFTER `cl_account_status`;

-- Update existing centers to have profile edit disabled by default (locked)
UPDATE `center_login` SET `cl_profile_edit_enabled` = 0 WHERE `cl_profile_edit_enabled` IS NULL;

