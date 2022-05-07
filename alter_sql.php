ALTER TABLE `student` ADD `wallet_amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00' AFTER `looking_to_learn`;

ALTER TABLE `transactions` ADD `user_id` INT NOT NULL AFTER `id`, ADD `payment_history_id` INT NULL DEFAULT NULL AFTER `user_id`, ADD `amount` DECIMAL(10,2) NOT NULL AFTER `payment_history_id`;