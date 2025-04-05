<?php

use Blog\Video;

$id = \Legacy\System\Classes\View::get('id');
$record = new Video($id);

/*
* Page configuration
*/
// $pageConfig['confirm'] = $pageConfig['confirm'] ?? null;

/*
* Query configuration
*/
$queryConfig['table'] = Video::TABLE;
$queryConfig['index-field'] = Video::INDEX;
$queryConfig['title-field'] = 'id';

/*
* Form fields
*/
$inputs = [
	[
		['type' => 'lbl', 'text' => 'URL del video su YouTube'],
		['name' => 'url', 'text' => 'URL del video su YouTube', 'required' => true,],
	],
];
