<?php

// blog posts table
\Legacy\System\Classes\DB::execute('
	CREATE TABLE IF NOT EXISTS blog_posts (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(200),
		text VARCHAR(2000),
		time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)
');
