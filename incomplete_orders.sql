CREATE TABLE `incomplete_orders` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `session_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id` bigint(20) unsigned DEFAULT NULL,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `additional_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `cart_content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `order_summary` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
