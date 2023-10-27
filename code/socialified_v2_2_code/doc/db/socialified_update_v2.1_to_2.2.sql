ALTER TABLE `post` CHANGE `type` `type` INT(11) NOT NULL DEFAULT '1' COMMENT '1=normal post, 2=competition, 3=club, 4=reel , 5=Reshare Post';
ALTER TABLE `setting` ADD `is_coupon` INT(11) NOT NULL DEFAULT '1' AFTER `commission_on_gift`;
ALTER TABLE `coupon` ADD `website_url` VARCHAR(256) NULL DEFAULT NULL AFTER `total_comment`;
ALTER TABLE `payment` ADD `campaign_id` INT NULL DEFAULT NULL AFTER `reference_id`;
ALTER TABLE `campaign` CHANGE `start_date` `start_date` INT NULL DEFAULT '0';
ALTER TABLE `campaign` CHANGE `end_date` `end_date` INT NULL DEFAULT '0';
CREATE TABLE `user_favorite` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`reference_id` int(11) NOT NULL,
`type` int(11) NOT NULL DEFAULT 0 COMMENT '1=coupon , 2=bussines',
`user_id` int(11) NOT NULL,
`created_at` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `business_images` ( `id` int(11) NOT NULL AUTO_INCREMENT, `business_id` int(11) NOT NULL, `image` varchar(256) DEFAULT NULL, `status` int(11) NOT NULL DEFAULT 10 COMMENT '10=active,9=deleted ,0=inactive', `media_type` int(11) DEFAULT NULL, `created_at` int(11) DEFAULT NULL, `updated_at` int(11) DEFAULT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `comment` CHANGE `comment_post_id` `reference_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `story` ADD `video_time` INT NULL DEFAULT '0' AFTER `background_color`;
ALTER TABLE `setting` ADD `is_reel` INT NOT NULL DEFAULT '0' AFTER `is_coupon`;
ALTER TABLE `organization` CHANGE `description` `description` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `chat_message` ADD `delete_time` BIGINT NOT NULL DEFAULT '0' AFTER `chat_version`;

ALTER TABLE `poll` CHANGE `campaigner_id` `campaigner_id` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `poll_qustion_options` CHANGE `question_id` `poll_id` INT(11) NOT NULL;
ALTER TABLE `poll` ADD `type` INT NOT NULL DEFAULT '1' COMMENT '1= Poll , 2= Post' AFTER `description`;
ALTER TABLE `poll` CHANGE `updated_by` `updated_by` INT(11) NULL;
ALTER TABLE `poll` CHANGE `updated_at` `updated_at` INT(11) NULL;
ALTER TABLE `poll` ADD `created_by_poll` INT NOT NULL DEFAULT '1' COMMENT '1= Admin , 2=User' AFTER `type`;
ALTER TABLE `poll_question_answer` CHANGE `poll_question_id` `poll_question_id` INT(11) NULL;
ALTER TABLE `poll` CHANGE `start_time` `start_time` INT(11) NULL;
ALTER TABLE `poll` CHANGE `end_time` `end_time` INT(11) NULL;
ALTER TABLE `post` CHANGE `post_content_type` `post_content_type` INT(11) NOT NULL DEFAULT '1' COMMENT ' text=1,media=2,location=3,poll=4';
ALTER TABLE `post` ADD `poll_id` INT NULL AFTER `share_comment`;

ALTER TABLE `post` ADD `is_comment_enable` INT NOT NULL DEFAULT '1' AFTER `longitude`;
ALTER TABLE `user_favorite` CHANGE `type` `type` INT NOT NULL DEFAULT '0' COMMENT '1=coupon , 2=bussines, 3= post';
ALTER TABLE `chat_room` CHANGE `type` `type` INT NOT NULL DEFAULT '1' COMMENT 'private=1,group=2, open group = 3';
