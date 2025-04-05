<?php

// newsletter subscribers
DB::execute('
	CREATE TABLE IF NOT EXISTS newsletter_subscribers (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		fullName VARCHAR(200) DEFAULT "",
		firstName VARCHAR(200) DEFAULT "",
		lastName VARCHAR(200) DEFAULT "",
		email VARCHAR(200) DEFAULT "",
		sent TINYINT(1) DEFAULT 0,
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');
