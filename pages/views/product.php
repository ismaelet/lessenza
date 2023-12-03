{% block main %}

<?php

use function Ecommerce\ecommerce_config;

if ($pixelEnabled) { ?>

	<script>
		fbq('track', 'ViewContent', {
			content_name: '<?= $item->name ?>',
			content_category: '<?= $item->type->name ?>',
			content_ids: ['<?= $item->id ?>'],
			content_type: 'product',
			value: <?= $item->price ?>,
			currency: 'BRL'
		});
	</script>

	<div itemscope itemtype="http://schema.org/Product">
		<meta itemprop="brand" content="<?= sys_config('name') ?>">
		<meta itemprop="name" content="<?= $item->name ?>">
		<meta itemprop="sku" content="<?= $item->sku ?>">
		<meta itemprop="description" content="<?= $item->infoShort ?>">
		<meta itemprop="category" content="Health & Beauty > Personal Care > Cosmetics > Skin Care">
		<meta itemprop="productID" content="<?= $item->id ?>">
		<meta itemprop="url" content="<?= $item->staticUrl ?>">
		<meta itemprop="image" content="<?= $item->staticImg() ?>">
		<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<link itemprop="availability" href="http://schema.org/InStock">
			<link itemprop="itemCondition" href="http://schema.org/NewCondition">
			<meta itemprop="itemCondition" content="new">
			<meta itemprop="availability" content="in stock">
			<meta itemprop="price" content="<?= $item->price ?>">
			<meta itemprop="priceCurrency" content="BRL">
		</div>
	</div>

<?php } ?>

<div class="hidden js-product-data" data-product-id="<?= $product->id ?>"></div>

<div class="product-area main-wrap pad-t-4">

	<?php
	include_once('-expands-product/images.php');
	include_once('-expands-product/data.php');
	?>

</div>

<?php
include_once('-expands-product/related-products.php');
if (ecommerce_config('product-page')['reviews']) include_once('-expands-product/reviews.php');
if (ecommerce_config('product-page')['faq']) include_once('-expands-product/faq.php');
?>

{% end main %}