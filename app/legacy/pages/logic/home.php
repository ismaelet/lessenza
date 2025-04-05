<?php

use Ecommerce\Product;

$header['theme'] = 'dark';
$header['floating'] = true;

$femaleImagesDirections = ['left', 'top', 'right', 'bottom'];

use_natural_keys($femaleImagesDirections);

// reviews
$reviews = rows_to_objects(\Legacy\System\Classes\DB::select(Re\Legacy\System\Classes\View::INDEX . ' FROM ' . Re\Legacy\System\Classes\View::TABLE . ' ORDER BY time DESC'), 'Review');

// products
$products = rows_to_objects(\Legacy\System\Classes\DB::select(Product::INDEX . ' FROM ' . Product::TABLE . ' ORDER BY ' . Product::INDEX . ' DESC LIMIT 4'), Product::class);
