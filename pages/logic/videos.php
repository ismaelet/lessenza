<?php

use Blog\Video;

$header['theme'] = 'dark';
$header['floating'] = true;

$records = rows_to_objects(DB::select(Video::INDEX . ' FROM ' . Video::TABLE . ' ORDER BY ' . Video::INDEX . ' DESC'), Video::class);
