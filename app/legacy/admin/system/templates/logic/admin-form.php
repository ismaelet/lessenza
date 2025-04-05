<?php

use ViewManager\Admin;

$id = View::get('id');
$entry = View::get('entry') ?? null;
$queryConfig = View::get('queryConfig');
$pageConfig = View::get('pageConfig') ?? [];
$listFilters = $_GET['list-filters'] ?? null;
$error = View::get('error') ?? false;
$done = View::get('done') ?? false;
$inputs = View::get('inputs') ?? null;
$pageConfig['edit'] = (bool) $id;

/*
* Page configuration
*	? (string) title: the page title
*	? (bool) free: active if the pace has premade static content
*	? (bool) centered: if set the all the texts inside the form will have a centered alignement
*	? (bool) upload: true if the form uploads files
*	? (string) confirm: is set, the user will have to agree to the confirmation message to procede
*	? (string) return-page: the relative path of the page to go back after the form submit
*/
$pageConfig['title'] = $pageConfig['title'] ?? View::$title;
$pageConfig['parcial-title'] = $pageConfig['parcial-title'] ?? __('Edit');
$pageConfig['free'] = $pageConfig['free'] ?? false;
$pageConfig['centered'] = $pageConfig['centered'] ?? false;
$pageConfig['upload'] = $pageConfig['upload'] ?? false;
$pageConfig['confirm'] = $pageConfig['confirm'] ?? null;
$pageConfig['return-page'] = $pageConfig['return-page'] ?? 'list';

/*
* Query configuration
*	(string) table: the table to interact with
*	(string) index-field: the name of the index field 
*	(string) title-field: the name of the field that will be used to generate the title of the page
*	? (array) select: the fields to be fetched
*	? (string) from: the table from which to fetch the data
*/
$queryConfig['select'] = isset($queryConfig['select']) ? implode(', ', $queryConfig['select']) : '*';
$queryConfig['from'] = $queryConfig['from'] ?? ($queryConfig['table'] ?? null);

// generate the return url
$pageConfig['return-url'] = $listFilters ? $pageConfig['return-page'] . '?' . urldecode($listFilters) : $pageConfig['return-page'];
$pageConfig['return-url'] .= $pageConfig['edit'] ? '#row' . $id : null;

// fetch entry data
if ($pageConfig['edit']) {
	$entry = $entry ?? DB::row($queryConfig['select'] . ' FROM ' . $queryConfig['from'] . ' WHERE ' . $queryConfig['index-field'] . '=?', [$id]);
	$pageConfig['title'] = $pageConfig['parcial-title'] . ': <span class="fw-bold">' . $entry[$queryConfig['title-field']] . '</span>';
}

/*
* Form events
*/
// add
if (isset($_POST['add'])) {
	if (Admin::$formAddFunction) {
		// Admin::setFormAddFunction(function ($inputs) {});
		$error = Admin::runFormAddFunction($inputs);
	} else {
		$id = query_from_inputs($queryConfig['table'], $inputs);

		if (Admin::$additionalFormAddFunction) {
			// Admin::setAdditionalFormAddFunction(function ($inputs, $id) {});
			$error = Admin::runAdditionalFormAddFunction($inputs, $id);
		}
	}

	if (!$error) {
		header('Location: ' . $pageConfig['return-url']);
	}
}

// edit
if (isset($_POST['edit'])) {
	if (Admin::$formUpdateFunction) {
		// Admin::setFormUpdateFunction(function ($inputs, $id) {});
		$error = Admin::runFormUpdateFunction($inputs, $id);
	} else {
		query_from_inputs($queryConfig['table'], $inputs, $id);

		if (Admin::$additionalFormUpdateFunction) {
			// Admin::setAdditionalFormUpdateFunction(function ($inputs, $id) {});
			$error = Admin::runAdditionalFormUpdateFunction($inputs, $id);
		}
	}

	if (!$error) {
		header('Location: ' . $pageConfig['return-url']);
	}
}
