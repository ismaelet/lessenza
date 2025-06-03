<section class="product-images">
	<div class="product-images-content <?= 'product-images-content_single' ?>">

		<!-- Other images -->
		<?php /*
		<div class="product-image-list">

			<?php foreach ($product->clientImageList as $key => $productImage) { ?>

				<div class="stack-content">
					<video src="<?= $productImage ?>" class="product-other-img sqr image-fill clickable <?= $key ? '' : 'active' ?>" data-src="<?= $productImage ?>" data-type="video"></video>

					<div class="video-play pos-rel icon-box">
						<?= embed_svg('play') ?>
					</div>
				</div>

			<?php } ?>

			<?php /*foreach ($product->clientVideos(100) as $key => $productImage) { ?>

				<img src="<?= client_path($productImage) ?>" alt="" class="product-other-img sqr image-fill clickable <?= $key ? '' : 'active' ?>" data-src="<?= str_replace('100.', '600.', client_path($productImage)) ?>" data-type="img">

			<?php }
			
		</div>
		*/ ?>

		<!-- Spotlight image -->
		<div class="product-image-main stack-content">
			<img class="product-spotlight product-img image-fill active" src="<?= $product->clientImage ?>" alt="">
			<!-- <video src="" class="product-spotlight product-video image-fill"></video>
			<div class="play-main-video video-play pos-rel icon-box">
				<?= embed_svg('play') ?>
			</div> -->
		</div>
	</div>
</section>