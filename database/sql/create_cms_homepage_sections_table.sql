CREATE TABLE `cms_homepage_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_type` varchar(50) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `link_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_section_type` (`section_type`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

