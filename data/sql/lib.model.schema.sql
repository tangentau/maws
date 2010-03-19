
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_test
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_test`;


CREATE TABLE `sf_test`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- maws_filter
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `maws_filter`;


CREATE TABLE `maws_filter`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) default '',
	`resource` VARCHAR(255),
	`resource_type` INTEGER default 0 NOT NULL,
	`resource_method` INTEGER default 0 NOT NULL,
	`resource_login` VARCHAR(255),
	`resource_pass` VARCHAR(255),
	`resource_params` TEXT default '',
	`filter` TEXT default '',
	`filter_type` INTEGER default 0 NOT NULL,
	`action` VARCHAR(255) default '',
	`action_type` INTEGER default 0 NOT NULL,
	`action_param1` VARCHAR(255) default '',
	`action_param2` VARCHAR(255) default '',
	`action_param3` VARCHAR(255) default '',
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- maws_thread
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `maws_thread`;


CREATE TABLE `maws_thread`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) default '',
	`filter_id` INTEGER default 0 NOT NULL,
	`update_start` DATETIME  NOT NULL,
	`update_period` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- maws_filter_result
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `maws_filter_result`;


CREATE TABLE `maws_filter_result`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) default '',
	`filter_id` INTEGER  NOT NULL,
	`thread_id` INTEGER  NOT NULL,
	`result` TEXT default '',
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `maws_filter_result_FI_1` (`filter_id`),
	CONSTRAINT `maws_filter_result_FK_1`
		FOREIGN KEY (`filter_id`)
		REFERENCES `maws_filter` (`id`),
	INDEX `maws_filter_result_FI_2` (`thread_id`),
	CONSTRAINT `maws_filter_result_FK_2`
		FOREIGN KEY (`thread_id`)
		REFERENCES `maws_thread` (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
