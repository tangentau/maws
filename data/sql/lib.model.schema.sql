
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- maws_parser
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `maws_parser`;


CREATE TABLE `maws_parser`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) default '',
	`description` VARCHAR(255) default '',
	`access` INTEGER default 0 NOT NULL,
	`resource_url` VARCHAR(255),
	`resource_type` INTEGER default 0 NOT NULL,
	`resource_params` TEXT default '',
	`resource_method` INTEGER default 0 NOT NULL,
	`resource_login` VARCHAR(255),
	`resource_pass` VARCHAR(255),
	`filter_type` INTEGER default 0 NOT NULL,
	`filter_params` TEXT default '',
	`action_type` INTEGER default 0 NOT NULL,
	`action_params` TEXT default '',
	`result_type` INTEGER default 0 NOT NULL,
	`owner_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `maws_parser_FI_1` (`owner_id`),
	CONSTRAINT `maws_parser_FK_1`
		FOREIGN KEY (`owner_id`)
		REFERENCES `sf_guard_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- maws_thread
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `maws_thread`;


CREATE TABLE `maws_thread`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) default '',
	`description` VARCHAR(255) default '',
	`access` INTEGER default 0 NOT NULL,
	`parser_id` INTEGER default 0 NOT NULL,
	`update_start` DATETIME  NOT NULL,
	`update_period` INTEGER default 0 NOT NULL,
	`result_type` INTEGER default 0 NOT NULL,
	`owner_id` INTEGER  NOT NULL,
	`checked_at` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `maws_thread_FI_1` (`owner_id`),
	CONSTRAINT `maws_thread_FK_1`
		FOREIGN KEY (`owner_id`)
		REFERENCES `sf_guard_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- maws_parser_result
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `maws_parser_result`;


CREATE TABLE `maws_parser_result`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) default '',
	`parser_id` INTEGER  NOT NULL,
	`thread_id` INTEGER  NOT NULL,
	`result_type` INTEGER default 0 NOT NULL,
	`result` TEXT default '',
	`is_diff` INTEGER default 0,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `maws_parser_result_FI_1` (`parser_id`),
	CONSTRAINT `maws_parser_result_FK_1`
		FOREIGN KEY (`parser_id`)
		REFERENCES `maws_parser` (`id`),
	INDEX `maws_parser_result_FI_2` (`thread_id`),
	CONSTRAINT `maws_parser_result_FK_2`
		FOREIGN KEY (`thread_id`)
		REFERENCES `maws_thread` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- maws_page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `maws_page`;


CREATE TABLE `maws_page`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) default '',
	`description` VARCHAR(255) default '',
	`access` INTEGER default 0 NOT NULL,
	`result_type` INTEGER default 0 NOT NULL,
	`show_period` INTEGER default 0,
	`owner_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `maws_page_FI_1` (`owner_id`),
	CONSTRAINT `maws_page_FK_1`
		FOREIGN KEY (`owner_id`)
		REFERENCES `sf_guard_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- maws_page_thread
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `maws_page_thread`;


CREATE TABLE `maws_page_thread`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`page_id` INTEGER  NOT NULL,
	`thread_id` INTEGER  NOT NULL,
	`sort_order` INTEGER default 0,
	`color` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `maws_page_thread_FI_1` (`page_id`),
	CONSTRAINT `maws_page_thread_FK_1`
		FOREIGN KEY (`page_id`)
		REFERENCES `maws_page` (`id`),
	INDEX `maws_page_thread_FI_2` (`thread_id`),
	CONSTRAINT `maws_page_thread_FK_2`
		FOREIGN KEY (`thread_id`)
		REFERENCES `maws_thread` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`email` VARCHAR(255) default '',
	PRIMARY KEY (`id`),
	INDEX `sf_guard_user_profile_FI_1` (`user_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
