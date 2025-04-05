$(function () {
	// filter search
	$('.js-filter-type').on('change', function () {
		const self = $(this)
		const filter = self.parents('.filter')

		filter.find('.js-filter-type').not(self).prop('checked', false)
		// self.prop('checked', true)

		$('#page-inp').val(1)

		$('#shop').trigger('submit')
	})

	// on tag change
	$('.tag-cbx').on('change', function () {
		$('.tag-cbx').prop('checked', false)
		$(this).prop('checked', true)

		$('#page-inp').val(1)

		$('#search-inp').val('')

		$('#filter_tag').trigger('click')
	})

	// on sorting change
	$('.sort-cbx').on('change', function () {
		$('.sort-cbx').prop('checked', false)
		$(this).prop('checked', true)

		$('#page-inp').val(1)

		$('#sort').trigger('click')
	})

	// remove tag filter
	$('#remove-filter-tag').on('click', function () {
		$('.tag-cbx').prop('checked', false)

		$('#page-inp').val(1)

		$('#filter_tag').trigger('click')
	})

	// remove type filter
	$('.page_txt').on('click', function () {
		if (!$(this).hasClass('disabled')) {
			var page = $(this).data('page')

			$('#page-inp').val(page)

			$('#page-btn').trigger('click')
		}
	})

	// remove filters
	$('.js-clear-search').on('click', function () {
		const target = $('.' + $(this).data('target'))

		target.val('')

		$('#page-inp').val(1)
		$('#shop').trigger('submit')
	})

	// price range
	/*$('#price-range_slider').slider({
		range: true,
		min: $('#price-range_slider').data('min'),
		max: $('#price-range_slider').data('max'),
		values: [$('#price-range_slider').data('currentmin'), $('#price-range_slider').data('currentmax')],
		slide: function (event, ui) {
			$('#price-range_val').val(ui.values[0] + ',' + ui.values[1])
			$('#price-range_min').html(ui.values[0])
			$('#price-range_max').html(ui.values[1])
		},
	})*/
})
