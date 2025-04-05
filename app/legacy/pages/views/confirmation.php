{% block main %}

<div class="main-wrap grid-flow center-content">
	<div class="grid-flow center-content" data-spacing="800">
		<h1 class="title">Ordine confermato</h1>
		<p class="max-width--768">
			Vi ringraziamo per il Vostro ordine, a breve elaboreremo la richiesta e vi contatteremo per informarvi come effettuare il pagamento.
		</p>

		<div class="grid-flow center-content full-width max-width--480" data-spacing="400">
			<?php if (logged()) { ?>
				<a href="<?= client_url('/profile/orders') ?>" class="button button--full-width">I Miei Ordini</a>
			<?php } ?>

			<a href="<?= client_url('/shop') ?>" class="button button--secondary button--full-width">Torna al Negozio</a>
		</div>
	</div>
</div>

{% end main %}