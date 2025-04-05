<?php

$header['theme'] = 'dark';
$header['floating'] = true;

$reviews = rows_to_objects(\Legacy\System\Classes\DB::select(Re\Legacy\System\Classes\View::INDEX . ' FROM ' . Re\Legacy\System\Classes\View::TABLE . ' ORDER BY time DESC'), 'Review');
