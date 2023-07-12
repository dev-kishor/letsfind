-- for mail message

CREATE TABLE `letsfind`.`vv_mail_message` (`mail_msg_id` INT NOT NULL AUTO_INCREMENT , `receiver_id` VARCHAR(10) NOT NULL , `sender_id` VARCHAR(10) NOT NULL , `sender_name` VARCHAR(250) NOT NULL , `sender_mobile` VARCHAR(15) NOT NULL , `sender_email` TEXT NOT NULL , `subject` TEXT NOT NULL , `message` TEXT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`mail_msg_id`)) ENGINE = InnoDB;
​
-- for mail message

-- for Place fee
ALTER TABLE `vv_places` ADD `place_description` TEXT NOT NULL AFTER `place_name`;

ALTER TABLE `vv_places` ADD `min_child` VARCHAR(4) NOT NULL AFTER `place_fee`, ADD `max_child` VARCHAR(4) NOT NULL AFTER `min_child`, ADD `fee_child` VARCHAR(6) NOT NULL AFTER `max_child`, ADD `min_adult` VARCHAR(4) NOT NULL AFTER `fee_child`, ADD `max_adult` VARCHAR(4) NOT NULL AFTER `min_adult`, ADD `fee_adult` VARCHAR(6) NOT NULL AFTER `max_adult`, ADD `min_senior` VARCHAR(4) NOT NULL AFTER `fee_adult`, ADD `max_senior` VARCHAR(4) NOT NULL AFTER `min_senior`, ADD `fee_senior` VARCHAR(6) NOT NULL AFTER `max_senior`;
-- for Place fee
