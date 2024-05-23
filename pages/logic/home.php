<?php

use Ecommerce\Product;

$header['theme'] = 'dark';
$header['floating'] = true;

$femaleImagesDirections = ['left', 'top', 'right', 'bottom'];

use_natural_keys($femaleImagesDirections);

// reviews
$reviews = rows_to_objects(DB::select(Review::INDEX . ' FROM ' . Review::TABLE . ' ORDER BY time DESC'), 'Review');

// products
$products = rows_to_objects(DB::select(Product::INDEX . ' FROM ' . Product::TABLE . ' ORDER BY ' . Product::INDEX . ' DESC LIMIT 4'), Product::class);
