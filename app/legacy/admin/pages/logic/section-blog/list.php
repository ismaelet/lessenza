<?php

/*
* Page configuration
*/
// $pageConfig['add'] = false;

use Blog\Post;

$pageConfig['row-action'] = 'add?id={{' . Post::INDEX . '}}';

/*
* Query configuration
*/
$queryConfig['table'] = Post::TABLE;
$queryConfig['index'] = Post::INDEX;
$queryConfig['where-search'] = "title LIKE CONCAT('%',?,'%') OR text LIKE CONCAT('%',?,'%')";

/*
* List fields
*/
$fields = [
	['title' => 'ID', 'name' => Post::INDEX,],
	['title' => 'Titolo', 'name' => 'title', 'size' => 1],
	['title' => 'Testo', 'name' => 'text', 'maxlenght' => 200, 'size' => 2],
	['title' => 'Data', 'name' => 'time', 'parse' => 'date-day'],

	['type' => 'btn'],
];

$buttons = [
	['type' => 'edit'],
	['type' => 'delete'],
];
