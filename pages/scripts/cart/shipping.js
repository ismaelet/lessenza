$(document).ready(function () {

	$('.shipping-row').click(function () {

		$('.shipping-row input').prop('checked', false)

		$(this).find('input').prop('checked', true)

	})

})