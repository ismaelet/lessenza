$(function () {
	const header = $('header')
	const headerMainContent = $('.h__main-content')

	// mobile menu
	$('.js-toggle-mobile-menu').on('click', function () {
		header.toggleClass('opened')
	})

	// fix height
	fix_height()

	$(window).on('resize', function () {
		fix_height()
	})

	function fix_height() {
		const headerHeight = headerMainContent.outerHeight()

		header.css('height', headerHeight + 'px')
	}
})
