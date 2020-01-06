USE dtsmith2106;
CREATE TABLE contact_page
(
    `contact_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `f_name` VARCHAR(45) NOT NULL,
    `l_name` VARCHAR(45) NOT NULL,
    `email` VARCHAR(60) DEFAULT NULL,
    `message` VARCHAR(256) DEFAULT NULL,
    PRIMARY KEY(`contact_id`)
);
DESCRIBE contact_page;
SELECT * FROM contact_page;