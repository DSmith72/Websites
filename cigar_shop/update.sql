USE dtsmith2106;
SHOW TABLES;


CREATE TABLE cart
(
    `cart_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `customer_id` BIGINT UNSIGNED NOT NULL,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `description` varchar(235) NOT NULL,
    `qty` BIGINT UNSIGNED NOT NULL,
    `price` DOUBLE NOT NULL,
    `date_added` DATE NOT NULL,
    `date_updated` DATE DEFAULT NULL,
    `date_deleted` DATE DEFAULT NULL,
    PRIMARY KEY(`cart_id`),
    FOREIGN KEY(`customer_id`) REFERENCES customer(`customer_id`),
    FOREIGN KEY(`product_id`) REFERENCES product(`product_id`)
);

INSERT INTO cart(cart_id, customer_id, product_id, description, qty, price, date_added)
VALUES(NULL,1,1, '10 count Montecristo cigars',1,197,NOW());

CREATE TABLE orders
(
    `orders_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `customer_id` BIGINT UNSIGNED NOT NULL,
    `status` VARCHAR(30) NOT NULL,
    `total_price` DOUBLE NOT NULL,
    `date_added` DATE NOT NULL,
    `date_updated` DATE DEFAULT NULL,
    `date_deleted` DATE DEFAULT NULL,
    PRIMARY KEY(`orders_id`),
    FOREIGN KEY(`customer_id`) REFERENCES customer(`customer_id`)
);

CREATE TABLE order_items
(
    `order_item_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `orders_id` BIGINT UNSIGNED NOT NULL,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `quantity` INT NOT NULL,
    `price` DOUBLE NOT NULL,
    PRIMARY KEY(`order_item_id`),
    FOREIGN KEY (`orders_id`) REFERENCES orders(`orders_id`),
    FOREIGN KEY(`product_id`) REFERENCES product(`product_id`)
);
