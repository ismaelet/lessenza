<?php

use Blog\Post;

$header['theme'] = 'dark';
$header['floating'] = true;

$posts = rows_to_objects(DB::select(Post::INDEX . ' FROM ' . Post::TABLE . ' ORDER BY ' . Post::INDEX . ' DESC'), Post::class);
