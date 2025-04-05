<?php if (count($faqs)) { ?>

	<section class="faq main-wrap">
		<h2 class="section-title txt-cen mar-b-5">Dúvidas e Respostas</h2>
		<div class="faq-list">

			<?php foreach ($faqs as $key => $faq) { ?>

				<div class="faq-element">
					<div class="faq-question clickable">
						<p class="faq-text mar-b-1 txt-11rem txt-sbold txt-ls03"><?= $faq['question'] ?></p>
						<div class="faq-arrow icon sqr" <?= icon_svg('navigation/arrow1-down') ?>></div>
					</div>

					<div class="faq-answer mar-b-1">
						<p class="txt-1rem txt-med txt-ls03"><?= $faq['answer'] ?></p>
					</div>

					<div class="faq-line"></div>
				</div>

			<?php } ?>

		</div>
	</section>

<?php } ?>