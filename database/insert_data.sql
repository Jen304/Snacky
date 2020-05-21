/*
	Insert Sample Data into tables
*/

-- Insert data into Administrator Table --
INSERT INTO administrator (admin_name, admin_password)
					VALUES('admin', SHA1('password'));
                    
SELECT *
FROM administrator;

-- Insert data into Image Table --
INSERT INTO image (image_path, image_name)
		   VALUES ('/User/ICS199/Admin/Images', 'chocolate.jpeg');
           
INSERT INTO image (image_path, image_name)
		   VALUES ('/User/ICS199/Admin/Images', 'cake.jpeg');
           
INSERT INTO image (image_path, image_name)
		   VALUES ('/User/ICS199/Admin/Images', 'chips.jpeg');
           
INSERT INTO image (image_path, image_name)
		   VALUES ('/User/ICS199/Admin/Images', 'dark_chocolate.jpeg');
           
INSERT INTO image (image_path, image_name)
		   VALUES ('/User/ICS199/Admin/Images', 'dry_fruit.jpeg');
           
SELECT *
FROM image;

-- Insert data into Category Table --
INSERT INTO category (category_name)
			   VALUES('Sweet');
               
INSERT INTO category (category_name)
			   VALUES('Salty');
               
INSERT INTO category (category_name)
			   VALUES('High - Calories');
               
INSERT INTO category (category_name)
			   VALUES('Low - Calories');
               
SELECT *
FROM category;

-- Insert data into Product Table --
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Chocolate', 'It is very sweet and high calory', 1, 3.98);
             
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Chips', 'It is very salty', 3, 1.98);
             
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Cake', 'It is too sweet and not recommended', 2, 5.98);
             
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Dark Chocolate', 'It is bitter and low calories', 4, 2.98);
             
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Dry Fruits', 'It is health and low calories', 5, 9.98);
             
SELECT *
FROM product;

-- Insert data into Product Category --
INSERT INTO product_category VALUES (1, 1); -- Add chocolate to Sweet Category
INSERT INTO product_category VALUES (1, 3); -- Add chocolate to Hign Calories Category

INSERT INTO product_category VALUES (2, 2); -- Add chips to Salty Category

INSERT INTO product_category VALUES (3, 1); -- Add cake to Sweet Category
INSERT INTO product_category VALUES (3, 3); -- Add chocolate to Hign Calories Category

INSERT INTO product_category VALUES (4, 4); -- Add dark chocolate to Low Carories Category

INSERT INTO product_category VALUES (5, 4); -- Add dry fruits to Low Calories Category

SELECT *
FROM product_category;


-- Insert data into Customer Table --
-- All columns are filled --
INSERT INTO customer (customer_name, customer_password, street, city, province, country, postal_code, email, phone)
			VALUES('Martin Pearson', SHA1('pearson1234'), '32 View Street','Victoria', 'BC', 'Canada', 'V7H3G6', 'martin@gmail.com','7783426364');
            
-- Phone column is NULL --
INSERT INTO customer (customer_name, customer_password, street, city, province, country, postal_code, email)
			  VALUES ('George Bismalk', SHA1('bis1234'), '45 York Ave', 'New York', 'NY', 'US', '8S9I6J', 'bismalk@yahoo.com');
 
SELECT *
FROM customer;

-- Insert data into Cart Item Table --
INSERT INTO cart_item VALUES (1, 3, 3); -- Customer 1 adds Cake to the cart

INSERT INTO cart_item VALUES (1, 1, 1); -- Customer 1 adds Chocolate to the cart

INSERT INTO cart_item VALUES (1, 5, 2); -- Customer 1 adds Dry Fruits to the cart

INSERT INTO cart_item VALUES (2, 1, 5); -- Customer 2 adds Chocolate to the cart

INSERT INTO cart_item VALUES (2, 2, 3); -- Customer 2 adds Chocolate to the cart

INSERT INTO cart_item VALUES (2, 3, 9); -- Customer 2 adds Cake to the cart

INSERT INTO cart_item VALUES (2, 4, 3); -- Customer 2 adds Dark Chocolate to the cart


SELECT *
FROM cart_item;

-- Insert data into Customer Order Table --
INSERT INTO customer_order (customer_id)
					VALUES (1);
                    
INSERT INTO customer_order (customer_id)
					VALUES (2);
                    
SELECT *
FROM customer_order;

-- Insert data into Order Item Table --
INSERT INTO order_item VALUES (1, 3, 3); -- Customer 1 orders Cake

INSERT INTO order_item VALUES (1, 1, 1); -- Customer 1 orders Chocolate

INSERT INTO order_item VALUES (1, 5, 1); -- Customer 1 orders Dry Fruits

INSERT INTO order_item VALUES (2, 1, 5); -- Customer 1 orders Chocolate

INSERT INTO order_item VALUES (2, 3, 9); -- Customer 1 orders Cake

INSERT INTO order_item VALUES (2, 4, 5); -- Customer 1 orders Dark Chocolate

SELECT *
FROM order_item;
 


            


