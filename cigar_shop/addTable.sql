USE dtsmith2106;
CREATE TABLE customer(
    `customer_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `f_name` VARCHAR(40) NOT NULL,
    `l_name` VARCHAR(40) NOT NULL,
    `email` VARCHAR(60) NOT NULL,
    `pass` VARCHAR(60) NOT NULL,
    `phone` varchar(20) DEFAULT NULL,
    `notes` LONGTEXT DEFAULT NULL,
    PRIMARY KEY(`customer_id`)
);
SET FOREIGN_KEY_CHECKS=0;
INSERT INTO customer(customer_id, f_name, l_name, email, pass, phone, notes, address_id)
VALUES
        (NULL,'Mary', 'Eoff', 'meoff@yahoo.cpm', 'eoff1234','(734)456-4433)','Number one customer',1),
        (NULL,'Jake', 'Roberts', 'roberts01@hotmail.com', 'roberts2345','(734)123-4545)','Number two customer',2),
        (NULL,'Pete', 'Rose', 'pistolPete@gmail.com', 'roseHOF2020', '(734)556-7890)','Number three customer',3);

SELECT  * FROM address;
drop TABLE customer;
DELETE FROM address WHERE address_id=1;
SET FOREIGN_KEY_CHECKS=0;
CREATE TABLE address
  (
      `address_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
      `customer_id` BIGINT UNSIGNED NOT NULL ,
      `address_num` BIGINT UNSIGNED NOT NULL,
      `street` VARCHAR(40) NOT NULL,
      `city` VARCHAR(40) NOT NULL,
      `state` VARCHAR(20) NOT NULL,
      `zip` BIGINT UNSIGNED,
      `apt_num` VARCHAR(10) DEFAULT NULL,
      `notes` VARCHAR(256) DEFAULT NULL,
      PRIMARY KEY(`address_id`),
      FOREIGN KEY(`customer_id`) REFERENCES customer(`customer_id`)
  );
DROP TABLE address;
INSERT INTO address(address_id, address_num, street, city, state, zip, apt_num)
VALUES
        (NULL, 14578, 'Grant', 'Dearborn', 'MI', 48222, NULL),
        (NULL, 233, 'Fordham', 'Southfield', 'MI', 48133, NULL),
        (NULL, 965, 'Willington', 'Adrian', 'MI', 49234, NULL);
DESCRIBE address;