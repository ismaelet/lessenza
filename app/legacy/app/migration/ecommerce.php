<?php

// products table
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_products (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50),
		slug VARCHAR(50),
		description VARCHAR(500),
		typeId INT(3) DEFAULT 1,
		inStock TINYINT(1) DEFAULT 1,
		highlighted TINYINT(1) DEFAULT 0,
		sales INT(11) DEFAULT 0,
		recentSales INT(11) DEFAULT 0,
		status INT(1) DEFAULT 1,
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// product images
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_product_images (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		productId INT(11),
		sort INT(2) DEFAULT 1
	)
');

// product types
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_product_types (
		id INT(3) AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50),
		names VARCHAR(50) DEFAULT "",
		category INT(3) DEFAULT 1,
		status INT(1) DEFAULT 1,
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// product categories
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_product_categories (
		id INT(3) AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50),
		names VARCHAR(50) DEFAULT "",
		status INT(1) DEFAULT 1,
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// products liked by users
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_product_likes (
		id INT(3) AUTO_INCREMENT PRIMARY KEY,
		productId INT(11),
		userId INT(11),
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// customers
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_customers (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		userId INT(11) DEFAULT 0,
		groupId INT(11) DEFAULT 0,
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// carts
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_carts (
		id INT(3) AUTO_INCREMENT PRIMARY KEY,
		customerId INT(11),
		addressId INT(11) DEFAULT 0,
		shippingMethodId INT(3) DEFAULT 1,
		paymentMethodId INT(3) DEFAULT 1,
		staticFullShippingPrice FLOAT DEFAULT 0,
		staticShippingDiscount FLOAT DEFAULT 0,
		couponId INT(11) DEFAULT 0,
		step INT(1) DEFAULT 1,
		status INT(1) DEFAULT 0,
		gift TINYINT(1) DEFAULT 0,
		trackingCode VARCHAR(30) DEFAULT "",
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// carts comments
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_carts_comments (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		cartId INT(11),
		comment VARCHAR(1000),
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// orders
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_orders (
		id INT(3) AUTO_INCREMENT PRIMARY KEY,
		cartId INT(11),
		customerId INT(11),
		productId INT(11),
		staticFullPrice FLOAT DEFAULT 0,
		staticDiscount FLOAT DEFAULT 0,
		quantity INT(3) DEFAULT 1,
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// coupons
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_coupons (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		code VARCHAR(11),
		percentage INT(3) DEFAULT 0,
		percentage2 INT(3) DEFAULT 0,
		percentageMore INT(3) DEFAULT 0,
		flat FLOAT DEFAULT 0,
		flat2 FLOAT DEFAULT 0,
		flatMore FLOAT DEFAULT 0,
		minPrice FLOAT DEFAULT 0,
		types VARCHAR(100) DEFAULT "",
		reusable TINYINT(1) DEFAULT 0,
		onePerUser TINYINT(1) DEFAULT 0,
		freeShipping TINYINT(1) DEFAULT 0,
		timeStart DATE,
		timeEnd DATE,
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// addresses
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_addresses (
		id INT(3) AUTO_INCREMENT PRIMARY KEY,
		customerId INT(11),
		fullName VARCHAR(100),
		address VARCHAR(100),
		number VARCHAR(20),
		city VARCHAR(50),
		zip VARCHAR(10),
		region VARCHAR(2),
		email VARCHAR(50),
		phone VARCHAR(20) DEFAULT "",
		notes VARCHAR(200) DEFAULT "",
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// shipping types
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_shipping_methods (
		id INT(3) AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(100),
		description VARCHAR(200) DEFAULT "",
		minimumPrice FLOAT DEFAULT 0,
		additionalPrice FLOAT DEFAULT 0,
		maximumPrice FLOAT DEFAULT 0,
		freeShippingAbove FLOAT DEFAULT 0,
		processingDays FLOAT DEFAULT 1,
		minimumDeliveryDays FLOAT DEFAULT 1,
		maximumDeliveryDays FLOAT DEFAULT 2,
		api VARCHAR(20)
	)
');

// payment types
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_payments (
		id INT(3) AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(100),
		slug VARCHAR(30),
		description VARCHAR(500) DEFAULT ""
	)
');

// product reviews
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_reviews (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		productId INT(11),
		userId INT(11),
		score INT(2) DEFAULT 0,
		text VARCHAR(500) DEFAULT "",
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');

// product promotions
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS ecommerce_promotions (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		productId INT(11),
		price FLOAT,
		expiration DATE,
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');
