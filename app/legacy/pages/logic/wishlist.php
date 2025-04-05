<?php

global $user;

$likes = DB::select('itemId FROM ecommerce_product_likes WHERE userId=? ORDER BY time DESC', [$user->id]);
