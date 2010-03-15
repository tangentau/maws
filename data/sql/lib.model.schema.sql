
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
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
