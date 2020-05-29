/*
	Insert Sample Data into tables
*/

-- Insert data into Administrator Table --
INSERT INTO administrator (admin_name, admin_password)
					VALUES('admin', SHA1('password'));
                    
SELECT *
FROM administrator;

-- Insert data into Image Table --
INSERT INTO image (image_name)
		   VALUES ('Dark-Chocolate-Brown-Sugar-Cookie.jpg');

INSERT INTO image (image_name)
		   VALUES ('Oatmeal-Cookies-Recipe.jpg');

INSERT INTO image (image_name)
		   VALUES ('easy-peanut-butter-cookies.jpg');

INSERT INTO image (image_name)
		   VALUES ('gluten-free-lemon-cookies.jpg');

INSERT INTO image (image_name)
		   VALUES ('Creamsicle-Cake.jpg');

INSERT INTO image (image_name)
		   VALUES ('butter-cake.jpg');

INSERT INTO image (image_name)
		   VALUES ('chewy-granola-bars.jpg');

INSERT INTO image (image_name)
		   VALUES ('carrotcakebites.jpg');

INSERT INTO image (image_name)
		   VALUES ('jelloCandyMelts.jpg');

INSERT INTO image (image_name)
		   VALUES ('PeanutButterCaramelCups.jpg');

           
SELECT *
FROM image;

-- Insert data into Category Table --
INSERT INTO category (category_name)
			   VALUES('Gluten-free');
               
INSERT INTO category (category_name)
			   VALUES('Salty');
               
INSERT INTO category (category_name)
			   VALUES('Sweet');
               
INSERT INTO category (category_name)
			   VALUES('Chocolate');
			   
INSERT INTO category (category_name)
			   VALUES('Homemade');
               
SELECT *
FROM category;

-- Insert data into Product Table --
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Dark Chocolate Brown Sugar Cookies', 'Dark Chocolate Brown Sugar Cookies have the perfect chewy texture on the inside with just a bit of crisp on the outside.', 1, 5.49);
             
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Chewy Oatmeal Cookies', 'Soft and chewy, this is a classic Oatmeal Cookies. No raisins and no chocolate chips, just oatmeal and a ton of sweet flavor.', 2, 5.59);
             
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Peanut Butter Cookies', 'These easy peanut butter cookies have a perfect brownie-like texture: both chewy and soft at the same time. These are some of the best peanut butter cookies you will ever try!', 3, 5.98);
             
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Lemon Sugar Cookies', 'a gluten-free Lemon sugar cookie you’ll love!', 4, 6.98);
             
INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Orange Creamsicle Cake', 'Orange Creamsicle Cake ~ perfect for laid back summer gatherings, potlucks, family birthdays, and everyday occasions.', 5, 9.98);

INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Kentucky Butter Cake', 'This gluten-free Kentucky Butter Cake is moist, buttery and coated with a sweet buttery glaze that creates a perfect sweet crunchy crust. With a dairy-free option.', 6, 4.98);

INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Superfood Granola Bar', 'Chewy granola bars packed full of superfood ingredients such as chia, pumpkin & linseeds, almonds, goji berries, oats, coconut oil & dark chocolate.', 7, 6.98);

INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Carrot Cake Energy Balls', 'Easy carrot cake energy balls sweetened with just dates and raisins. Perfect for a healthy snack!', 8, 3.38);

INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Jello Candy Melts', 'It is HOT outside, the kids are home all day on summer vacation, and we were ready to have some fun! Jello Candy Melts is perfect to make with kids and they taste so yummy!', 9, 2.98);

INSERT INTO product (product_name, product_desc, image_id,unit_price)
			 VALUES ('Peanut Butter Caramel Candy Cups', 'Rich homemade candy cups filled with peanut butter caramel sauce and topped with the perfect amount of flaky sea salt.', 10, 5.98);        

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
 


            


