DROP TABLE IF EXISTS `whatsapp_message_logs`;
CREATE TABLE `whatsapp_message_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_id` int(11) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `variables` text DEFAULT NULL COMMENT 'JSON array of variables used',
  `status` enum('sent','failed','pending') DEFAULT 'pending',
  `response` text DEFAULT NULL COMMENT 'JSON response from API',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  KEY `phone_number` (`phone_number`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

