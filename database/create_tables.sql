/* Creating Tables */
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS administrator;
DROP TABLE IF EXISTS cart_item;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS product_category;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS customer_order;
DROP TABLE IF EXISTS image;
DROP TABLE IF EXISTS order_item;
DROP TABLE IF EXISTS product;
SET FOREIGN_KEY_CHECKS = 1;


-- Administrator Table --
CREATE TABLE administrator(
	admin_id INT AUTO_INCREMENT,
    admin_name VARCHAR(15) NOT NULL UNIQUE,
    admin_password VARCHAR(150) NOT NULL,
    PRIMARY KEY (admin_id)
);

DESC administrator;


-- Image Table --
CREATE TABLE image(
	image_id INT AUTO_INCREMENT,
  
    image_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (image_id)
);

DESC image;

-- Category Table --

CREATE TABLE category(
	category_id INT AUTO_INCREMENT,
    category_name VARCHAR(20) NOT NULL,
    PRIMARY KEY (category_id)
);

DESC category;

-- Product Table --

CREATE TABLE product(
	product_id INT AUTO_INCREMENT,
    product_name VARCHAR(20) NOT NULL UNIQUE,
    product_desc VARCHAR(50) NOT NULL,
    image_id INT NOT NULL,
    unit_price FLOAT(5,2) NOT NULL,
    PRIMARY KEY (product_id),
    FOREIGN KEY (image_id) 
    REFERENCES image (image_id) ON DELETE CASCADE
);

DESC product;

-- Product Category --

CREATE TABLE product_category(
	product_id INT,
    category_id INT,
    PRIMARY KEY (product_id, category_id),
    FOREIGN KEY (product_id) 
    REFERENCES product (product_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id)
    REFERENCES category (category_id) ON DELETE CASCADE
);

DESC product_category;

-- Customer Table --
CREATE TABLE customer(
	customer_id INT AUTO_INCREMENT,
    customer_name VARCHAR(50) NOT NULL,
    customer_password VARCHAR(50) NOT NULL,
    street VARCHAR(30) NOT NULL,
    city VARCHAR(20) NOT NULL,
    province VARCHAR(10),
    country VARCHAR(15) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    email VARCHAR(40) NOT NULL UNIQUE,
    phone VARCHAR(15),
    PRIMARY KEY (customer_id)
);

DESC customer;

-- Cart Item Table --
CREATE TABLE cart_item(
	customer_id INT,
    product_id INT,
    quantity INT NOT NULL,
    PRIMARY KEY (customer_id, product_id),
    FOREIGN KEY (customer_id)
    REFERENCES customer (customer_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id)
    REFERENCES product (product_id) ON DELETE CASCADE
);

DESC cart_item;

-- Customer Order Table --
CREATE TABLE customer_order(
	order_id INT AUTO_INCREMENT,
    customer_id INT NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (customer_id)
    REFERENCES customer (customer_id) ON DELETE CASCADE
);

DESC customer_order;

-- Order Item Table --
CREATE TABLE order_item(
	order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY (order_id)
    REFERENCES customer_order (order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id)
    REFERENCES product (product_id) ON DELETE CASCADE
);

DESC order_item;