{% extends main %}

{% block main %}

<?php /*
<section class="page-header stack-content">

	<div class="page-header-bgr fill-all background-fill" <?= background_image('bgr.jpg', $view) ?>></div>

	<div class="page-header-content pos-rel flex gap2 va-cen">

		<h1 class="page-header-title txt-f txt-ls2 txt-upp">Loja</h1>

		<form class="searcher" method="GET" autocomplete="off">

			<input type="text" name="search" class="searcher-inp inp" placeholder="Procure um produto" value="<?= $shop->search ?>" maxlength="30" onfocus="$(this).parent().addClass('focus')" onblur="$(this).parent().removeClass('focus')" autocomplete="off">

			<button type="submit" class="searcher-btn pbtn">
				<span class="icon background-f" <?= icon_svg('search') ?>></span>
			</button>

		</form>

	</div>

</section>
*/ ?>

<div class="main-wrap">

	<?php $shop->layout->render() ?>

</div>

{% end main %}