<section class="reviews main-wrap mar-t-5 mar-b-3" id="reviews">
	<div class="reviews-body">
		<div class="inner-wrap">

			<?php if ($boughtItem && !$reviewed) { ?>

				<!-- Post a new review -->
				<form class="post-review" id="post-review" method="POST">
					<h2 class="section-title txt-cen">Lascia la tua valutazione</h2>

					<div class="post-review-body mar-t-1">
						<div class="review-stars review-stars_post">
							<?php for ($i = 1; $i <= 10; $i++) { ?>
								<label class="review-star review-star_post icon" for="post-review-cbx<?= $i ?>" <?= icon_svg('star-full') ?>></label>
								<input type="radio" class="post-review-cbx" id="post-review-cbx<?= $i ?>" name="review-score" value="<?= $i ?>">
							<?php } ?>
						</div>

						<textarea class="post-review-text textarea" name="review-text" placeholder="Scrivi qui la tua valutazione" rows="4" maxlength="1000" required></textarea>
					</div>

					<div class="flex">
						<button type="submit" class="pbtn push-right mar-t-2" name="post-review" disabled>Invia</button>
					</div>
				</form>

			<?php } ?>

			<!-- List of the reviews -->
			<section class="reviews-list">
				<h2 class="section-title txt-cen">Recensioni del prodotto</h2>

				<?php if ($reviews->num_rows) { ?>
					<div class="reviews-wrapper">

						<?php while ($review = $reviews->fetch_assoc()) {
							$review = new Ecommerce\Review($review['id']);
						?>

							<div class="review">
								<div class="review-score">
									<div class="review-stars">

										<?php for ($i = 1; $i <= 10; $i++) { ?>
											<label class="review-star <?= $i <= $review->score ? 'active' : '' ?> icon" <?= icon_svg($i <= $review->score ? 'star-full' : 'star-full') ?>></label>
										<?php } ?>

									</div>
								</div>

								<p class="review-name mar-t-05 txt-c1"><?= $review->fullName ?></p>

								<form class="review-body" method="POST">
									<p class="review-text"><?= $review->text ?></p>

									<?php if (logged() && $review->userId == $user->id) { ?>
										<button type="submit" class="delete-review" name="delete-review">Rimuovi la recensione</button>
									<?php } ?>
								</form>
							</div>

						<?php } ?>

					</div>

				<?php } else { ?>
					<p class="mar-t-2 txt-cen txt-11rem">Questo prodotto non è ancora stato recensito</p>
				<?php } ?>

			</section>
		</div>
</section>