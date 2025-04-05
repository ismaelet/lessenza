$(document).ready(function () {
	// coupon
	$('.add-coupon-text').click(function () {
		$(this).hide()
		$('.add-coupon').addClass('visible')
	})

	$('.coupon_inp').keydown(function () {
		$(this).removeClass('coupon_inp--error')
		$('.coupon_error').hide()
	})
})
