-- Chat and Notifications Tables
-- Date: 2025-12-07

-- Chat Conversations Table
CREATE TABLE IF NOT EXISTS `chat_conversations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `participant_one_type` enum('student_login','center_login','admin_login') NOT NULL COMMENT 'Type of first participant',
  `participant_one_id` bigint(20) unsigned NOT NULL COMMENT 'ID of first participant',
  `participant_two_type` enum('student_login','center_login','admin_login') NOT NULL COMMENT 'Type of second participant',
  `participant_two_id` bigint(20) unsigned NOT NULL COMMENT 'ID of second participant',
  `last_message_at` timestamp NULL DEFAULT NULL COMMENT 'Timestamp of last message',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_participant_one` (`participant_one_type`,`participant_one_id`),
  KEY `idx_participant_two` (`participant_two_type`,`participant_two_id`),
  KEY `idx_last_message` (`last_message_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Chat Messages Table
CREATE TABLE IF NOT EXISTS `chat_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint(20) unsigned NOT NULL,
  `sender_type` enum('student_login','center_login','admin_login') NOT NULL COMMENT 'Type of sender',
  `sender_id` bigint(20) unsigned NOT NULL COMMENT 'ID of sender',
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unread, 1=read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_conversation` (`conversation_id`),
  KEY `idx_sender` (`sender_type`,`sender_id`),
  KEY `idx_read_status` (`is_read`),
  KEY `idx_created` (`created_at`),
  CONSTRAINT `fk_chat_messages_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `chat_conversations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Notifications Table
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` enum('student_login','center_login','admin_login') NOT NULL COMMENT 'Type of user receiving notification',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'ID of user receiving notification',
  `type` varchar(255) NOT NULL COMMENT 'Type of notification (e.g., chat_message, system, etc.)',
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(500) DEFAULT NULL COMMENT 'Optional link to related page',
  `is_read` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unread, 1=read',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user` (`user_type`,`user_id`),
  KEY `idx_read_status` (`is_read`),
  KEY `idx_created` (`created_at`),
  KEY `idx_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

