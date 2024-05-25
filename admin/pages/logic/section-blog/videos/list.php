<?php

/*
* Page configuration
*/
// $pageConfig['add'] = false;

use Blog\Video;

$pageConfig['row-action'] = 'add?id={{' . Video::INDEX . '}}';

/*
* Query configuration
*/
$queryConfig['table'] = Video::TABLE;
$queryConfig['index'] = Video::INDEX;
$queryConfig['where-search'] = "id=?";

/*
* List fields
*/
$fields = [
	['title' => 'ID', 'name' => 'id',],
	['title' => 'Preview', 'name' => 'id', 'size' => 1, 'type' => 'embedded-video', 'not-sortable' => true],
	['title' => 'Url', 'name' => 'url', 'size' => 1],

	['type' => 'btn'],
];

$buttons = [
	['type' => 'edit'],
	['type' => 'delete'],
];
