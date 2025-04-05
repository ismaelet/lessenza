<?php

// global reviews table
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS global_reviews (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(50),
		text VARCHAR(1000) DEFAULT "",
		rating INT(2) DEFAULT 0,
		contactUrl VARCHAR(100) DEFAULT "",
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');
