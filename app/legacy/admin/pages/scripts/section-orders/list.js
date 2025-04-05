/*
 * Filters
 */
const statusFilterSelector = '.js-status-filter'
const defaultStatusFilterSelector = '[data-default-status="1"]'
const notDefaultStatusFilterSelector = '[data-default-status="0"]'
const emptyStatusFiltersSelector = '.js-empty-filter-status'
const checkAllStatusFiltersSelector = '.js-status-all'
const removeStatusFilterSelector = '.js-remove-status-filter'

// Events
document.addEventListener('DOMContentLoaded', function () {
	const listForm = document.querySelector(listSelector)
	const emptyStatusFilters = document.querySelector(emptyStatusFiltersSelector)
	const checkAllStatusFilters = document.querySelector(checkAllStatusFiltersSelector)
	const removeStatusFilter = document.querySelector(removeStatusFilterSelector)

	// filters
	document.querySelectorAll(statusFilterSelector).forEach((element) => {
		element.addEventListener('click', () => {
			update_filter(element)
		})

		element.addEventListener('change', () => {
			update_filter(element)
		})
	})

	if (removeStatusFilter) {
		removeStatusFilter.addEventListener('click', () => {
			document.querySelectorAll(defaultStatusFilterSelector).forEach((element) => {
				element.checked = true
			})

			document.querySelectorAll(notDefaultStatusFilterSelector).forEach((element) => {
				element.checked = false
			})

			filter_admin_list()
		})
	}

	checkAllStatusFilters.addEventListener('click', () => {
		const checked = checkAllStatusFilters.checked

		document.querySelectorAll(statusFilterSelector).forEach((element) => {
			element.checked = checked

			update_filter(element)
		})

		listForm.setAttribute('method', 'GET')
		listForm.submit()
	})

	function update_filter(element) {
		if (element.classList.contains(statusFilterSelector.split('.').join(''))) {
			if (document.querySelectorAll(statusFilterSelector + ':checked').length) {
				emptyStatusFilters.checked = false
			} else {
				emptyStatusFilters.checked = true
			}
		}

		filter_admin_list()
	}
})
