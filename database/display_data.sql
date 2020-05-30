SELECT *
FROM administrator;

SELECT *
FROM cart_item;

SELECT *
FROM category;

SELECT *
FROM customer;

SELECT *
FROM customer_order;

SELECT *
FROM image;

SELECT *
FROM order_item;

-- Display Products and Categories they belong to
SELECT product.product_id, CONCAT(product.product_name, " belongs to ", category.category_name, " category") AS "Product Belongs To"
FROM product
INNER JOIN product_category
USING (product_id)
INNER JOIN category
USING (category_id)
ORDER BY product_id;

-- Disply Customer's Cart Items

SELECT customer.customer_id, customer.customer_name,  product.product_name, cart_item.quantity
FROM customer
INNER JOIN cart_item 
USING(customer_id)
INNER JOIN product
USING(product_id)
ORDER BY customer_id;

-- Display Customer's Order Item List
SELECT customer.customer_id, customer.customer_name, customer_order.order_id, product.product_name, order_item.quantity, product.unit_price * order_item.quantity AS "Total"
FROM customer
INNER JOIN customer_order
USING (customer_id)
INNER JOIN order_item
USING (order_id)
INNER JOIN product
USING (product_id)
ORDER BY customer_id;

-- Display Customer's Order Total
SELECT customer.customer_id, customer.customer_name, customer_order.order_id, SUM(order_item.quantity) AS "Total Quantity", SUM(product.unit_price * order_item.quantity) AS "Total Price"
FROM customer
INNER JOIN customer_order
USING (customer_id)
INNER JOIN order_item
USING (order_id)
INNER JOIN product
USING (product_id)
GROUP BY customer_id
ORDER BY customer_id;





