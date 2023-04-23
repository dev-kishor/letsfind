-- for mail message

CREATE TABLE `letsfind`.`vv_mail_message` (`mail_msg_id` INT NOT NULL AUTO_INCREMENT , `receiver_id` VARCHAR(10) NOT NULL , `sender_id` VARCHAR(10) NOT NULL , `sender_name` VARCHAR(250) NOT NULL , `sender_mobile` VARCHAR(15) NOT NULL , `sender_email` TEXT NOT NULL , `subject` TEXT NOT NULL , `message` TEXT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`mail_msg_id`)) ENGINE = InnoDB;
​
-- for mail message