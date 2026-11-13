ALTER TABLE `log_notification_errors`
    ADD COLUMN `failure_stage` VARCHAR(191) NOT NULL DEFAULT 'unknown' AFTER `job_name`,
    ADD COLUMN `channel` VARCHAR(191) NULL AFTER `failure_stage`,
    ADD COLUMN `notification_type` VARCHAR(191) NULL AFTER `channel`,
    ADD COLUMN `notifiable_type` VARCHAR(191) NULL AFTER `notification_type`,
    ADD COLUMN `notifiable_id` VARCHAR(191) NULL AFTER `notifiable_type`,
    ADD COLUMN `exception_type` VARCHAR(191) NULL AFTER `notifiable_id`,
    ADD COLUMN `exception_file` TEXT NULL AFTER `exception_message`,
    ADD COLUMN `exception_line` INT UNSIGNED NULL AFTER `exception_file`;
