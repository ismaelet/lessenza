/**
 * Setup
 */
const formSelector = '.js-form'
const nameSelector = '[name="name"]'
const descriptionSelector = 'textarea[name="description"]'
const slugSelector = '[name="slug"]'
const seoTitleSelector = '.seo-title'
const seoTextSelector = '.seo-text'
const loaderSelector = '.js-loading'
const slugChangerSelector = [nameSelector, slugSelector].join(',')

/**
 * Events
 */
document.addEventListener('DOMContentLoaded', function () {
	const formBlock = document.querySelector(formSelector)
	const nameInput = document.querySelector(nameSelector)
	const descriptionInput = document.querySelector(descriptionSelector)
	const seoTitleElement = document.querySelector(seoTitleSelector)
	const seoTextElement = document.querySelector(seoTextSelector)
	const loaderElement = document.querySelector(loaderSelector)

	let autoSlug = true

	// slug
	document.querySelectorAll(slugChangerSelector).forEach((element) => {
		element.addEventListener('keyup', async () => {
			const name = element.value

			if (name && autoSlug) {
				const response = await call_function('Ecommerce\\generate_product_slug', name)

				if (element.classList.contains(slugSelector.split('.').join(''))) {
					autoSlug = false
				}

				document.querySelector(slugSelector).value = response
			}
		})
	})

	// SEO
	nameInput.addEventListener('keyup', async () => {
		let title = nameInput.value.trim()

		if (!title) {
			title = 'Titolo del prodotto'
		}

		seoTitleElement.innerHTML = title
	})

	descriptionInput.addEventListener('keyup', async () => {
		let title = descriptionInput.value.trim()

		if (!title) {
			title = 'Descrizione del prodotto'
		}

		seoTextElement.innerHTML = title
	})

	// form submit
	formBlock.addEventListener('submit', function () {
		loaderElement.classList.add('active')
	})
})
