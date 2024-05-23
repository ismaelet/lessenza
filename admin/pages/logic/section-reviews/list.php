<?php

/*
* Page configuration
*/
// $pageConfig['add'] = false;
$pageConfig['row-action'] = 'add?id={{' . Review::INDEX . '}}';

/*
* Query configuration
*/
$queryConfig['table'] = Review::TABLE;
$queryConfig['index'] = Review::INDEX;
$queryConfig['where-search'] = "name LIKE CONCAT('%',?,'%') OR location LIKE CONCAT('%',?,'%')";

/*
* List fields
*/
$fields = [
	['title' => 'ID', 'name' => Review::INDEX,],
	['title' => 'Nome completo', 'name' => 'name', 'size' => 1],
	['title' => 'Località', 'name' => 'location', 'size' => 1],
	['title' => 'Testo', 'name' => 'text', 'maxlenght' => 80, 'size' => 2],
	['title' => 'Data', 'name' => 'time', 'parse' => 'date-day'],

	['type' => 'btn'],
];

$buttons = [
	['type' => 'edit'],
	['type' => 'delete'],
];
