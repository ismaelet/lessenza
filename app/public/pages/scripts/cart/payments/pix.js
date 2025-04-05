$(document).ready(function () {
	$('#copy-qrcode').click(function () {
		const qrCode = document.getElementById('qrcode')

		qrCode.select()
		qrCode.setSelectionRange(0, 99999)

		navigator.clipboard.writeText(qrCode.value)
	})

	$('.meta-purchase').click(function () {
		const self = $(this)
		fbq('track', 'Purchase', {
			num_items: self.data('quantity'),
			value: self.data('price'),
			currency: 'BRL',
		})
	})
})
