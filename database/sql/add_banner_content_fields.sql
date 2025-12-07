-- Add content fields to cms_banner table
ALTER TABLE `cms_banner`
ADD COLUMN `header` VARCHAR(255) NULL AFTER `file`,
ADD COLUMN `short_description` TEXT NULL AFTER `header`,
ADD COLUMN `button_name` VARCHAR(255) NULL AFTER `short_description`,
ADD COLUMN `button_url` VARCHAR(255) NULL AFTER `button_name`,
ADD COLUMN `sort_order` INT(11) NOT NULL DEFAULT 0 AFTER `button_url`,
ADD COLUMN `status` TINYINT(1) NOT NULL DEFAULT 1 AFTER `sort_order`;

