document.addEventListener('DOMContentLoaded', function () {
	const formSelector = '.js-newsletter-form'
	const fullNameSelector = '.js-newsletter-fullname'
	const emailSelector = '.js-newsletter-email'
	const signUpButtonSelector = '.js-newsletter-signup'

	document.querySelectorAll(signUpButtonSelector).forEach((element) => {
		element.addEventListener('click', async () => {
			const form = element.closest(formSelector)
			const fullName = form.querySelector(fullNameSelector).value
			const email = form.querySelector(emailSelector).value

			let parameters = [{ fullName: fullName, email: email }]

			if (form.reportValidity()) {
				const response = await call_class_method('Newsletter\\Subscriber', 'new', parameters)

				if (response.id) {
					form.classList.add('signed-up')
				}
			}
		})
	})
})
