<?php

global $user;

$likes = \Legacy\System\Classes\DB::select('itemId FROM ecommerce_product_likes WHERE userId=? ORDER BY time DESC', [$user->id]);
