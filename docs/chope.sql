CREATE SCHEMA `chope` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

/*CREATE TABLE `chope`.`users` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `created_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login_time` DATETIME NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE INDEX `username_UNIQUE` (`email` ASC));*/

-- ALTER TABLE `chope`.`users` ADD COLUMN `contact_no` VARCHAR(45) NOT NULL AFTER `name`;

CREATE TABLE `users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username_UNIQUE` (`email` ASC));

CREATE TABLE `audits` (
  `id_audit` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('LOGOUT','LOGIN_SUCCESS','LOGIN_FAILED','REGISTER') COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `user_email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_audit`),
  KEY `idx_type` (`type`),
  KEY `idx_id_user` (`id_user`),
  KEY `idx_user_email` (`user_email`));