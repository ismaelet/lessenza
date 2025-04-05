<?php

$header['theme'] = 'dark';
$header['floating'] = true;

$reviews = rows_to_objects(DB::select(Review::INDEX . ' FROM ' . Review::TABLE . ' ORDER BY time DESC'), 'Review');
