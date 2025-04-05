<?php

use Blog\Video;

$header['theme'] = 'dark';
$header['floating'] = true;

$records = rows_to_objects(\Legacy\System\Classes\DB::select(Video::INDEX . ' FROM ' . Video::TABLE . ' ORDER BY ' . Video::INDEX . ' DESC'), Video::class);
