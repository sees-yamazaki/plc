ALTER TABLE `schedules` ADD `sche_allday` INT(1) NOT NULL DEFAULT '0' AFTER `sche_type`, ADD `room` INT(1) NOT NULL DEFAULT '0' AFTER `sche_allday`;
