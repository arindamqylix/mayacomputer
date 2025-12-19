-- Add title field to cms_banner table for badge text at top
ALTER TABLE `cms_banner`
ADD `title` varchar(255) COLLATE 'utf8mb4_unicode_ci' NULL AFTER `file`;

