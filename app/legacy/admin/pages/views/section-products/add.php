{% block page-body %}

<!-- Main content -->
<div class="main-content grid-flow" data-spacing="700">

	<!-- Item data -->
	<section class="form">
		<h3 class="panel__subtitle panel__subtitle--outside">Dati del prodotto</h3>
		<div class="panel">
			<div class="form-inputs">

				<?= generate_form($productInputs) ?>

				<?php if (!$newProduct) { ?>

					<!-- Slug -->
					<div class="form-field mar-t-05">
						<p class="label">URL del prodotto</p>
						<div class="slug">
							<p class="slug__url"><?= str_replace('/', '<wbr>/', CLIENT_URL . ('/' . __('product') . '/' . $product->id . '-')) ?></p>
							<input type="text" class="slug__input" name="slug" value="<?= $product->slug ?>" placeholder="slug" required>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>
	</section>

	<!-- Images -->
	<section class="form">
		<h3 class="panel__subtitle panel__subtitle--outside">Immagini</h3>
		<div class="panel">

			<?= render_image_input($imageInputConfig) ?>

		</div>
	</section>
</div>

<!-- Side bar -->
<aside class="side-bar">

	<!-- Status, inventory, price -->
	<section class="form">
		<h3 class="panel__subtitle panel__subtitle--outside">Impostazioni del prodotto</h3>

		<div class="panel">
			<div class="form-inputs">

				<!-- Product status -->
				<div class="form-field">
					<p class="form-lbl">Stato del prodotto</p>

					<select name="statusId">
						<option value="0" <?= $product->statusId ? '' : 'selected' ?>>Bozza</option>
						<option value="1" <?= $newProduct || $product->statusId ? 'selected' : '' ?>>Attivo</option>
					</select>
				</div>

				<!-- Stock status -->
				<div class="form-field">
					<p class="form-lbl">Inventario</p>

					<select name="inStock">
						<option value="0" <?= $product->inStock ? '' : 'selected' ?>>Esaurito</option>
						<option value="1" <?= $newProduct || $product->inStock ? 'selected' : '' ?>>Disponibile</option>
					</select>
				</div>

				<!-- Price -->
				<div class="price-field form-field">
					<p class="form-lbl">Prezzo</p>
					<div class="price-input stack-content center-items">
						<input type="text" name="price" value="<?= $newProduct ? format(0) : $product->formattedFullPrice ?>" placeholder="Prezzo" disabled>
					</div>
				</div>

				<div class="form-field">
					<label class="toggle-switch">
						<input type="checkbox" name="highlighted" <?= !$newProduct && $product->highlighted ? 'checked' : '' ?>>
						<span></span>
						<p>Prodotto in evidenza</p>
					</label>
				</div>
			</div>

		</div>
	</section>

	<?php if (!$newProduct) { ?>

		<!-- SEO preview -->
		<section class="form">
			<h3 class="panel__subtitle panel__subtitle--outside">Preview SEO</h3>

			<div class="panel">
				<div class="panel__body text">
					<p class="seo-url"><?= $product->staticUrl ?></p>
					<h3 class="seo-title"><?= $product->name ?></h3>
					<p class="seo-text txt-line3"><?= $product->description ?></p>
				</div>
			</div>
		</section>

	<?php } ?>

</aside>

{% end page-body %}