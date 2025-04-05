document.addEventListener('DOMContentLoaded', async function () {
	const recapShippingElement = document.querySelector('.js-recap-shipping-price')
	const shippingCheckboxes = document.querySelectorAll('.js-shipping-method')

	shippingCheckboxes.forEach((element) => {
		element.addEventListener('change', async () => {
			const shippingMethodId = element.value

			recapShippingElement.dataset.shippingMethodId = shippingMethodId

			old_call_class_method('Ecommerce\\Cart', 'updateShippingMethodId', [shippingMethodId], await getCartId())

			update_cart()
		})
	})
})
