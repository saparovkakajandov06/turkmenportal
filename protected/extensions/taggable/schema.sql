-- /* Tag table */
-- CREATE TABLE `Tag` (
--   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
--   `name` VARCHAR(255) NOT NULL,
--   PRIMARY KEY  (`id`),
--   UNIQUE KEY `Tag_name` (`name`)
-- );
-- 
-- /* Tag binding table */
-- CREATE TABLE `PostTag` (
--   `post_id` INT(10) UNSIGNED NOT NULL,
--   `tagId` INT(10) UNSIGNED NOT NULL,
--   PRIMARY KEY  (`post_id`,`tagId`)
-- );
-- 
-- /* Tag table */
-- CREATE TABLE `Color` (
--   `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
--   `name` VARCHAR(255) NOT NULL,
--   PRIMARY KEY  (`id`),
--   UNIQUE KEY `Color_name` (`name`)
-- );
-- 
-- /* Tag binding table */
-- CREATE TABLE `PostColor` (
--   `post_id` INT(10) UNSIGNED NOT NULL,
--   `colorId` INT(10) UNSIGNED NOT NULL,
--   PRIMARY KEY  (`post_id`,`colorId`)
-- );



CREATE TABLE `tbl_tag` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `Tag_name` (`name`)
);


CREATE TABLE `tbl_blog_to_tag` (
  `blog_id` INT(10) UNSIGNED NOT NULL,
  `tag_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY  (`blog_id`,`tag_id`)
);