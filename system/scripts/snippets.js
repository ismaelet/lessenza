$(document).ready(function () {
	/*
	 * Videos
	 */
	$('.js-playable-video-overlay').click(function () {
		const videoWrap = $(this).parent('.js-playable-video-wrap')
		const video = videoWrap.find('.js-playable-video')

		videoWrap.addClass('is-playing')
		video.trigger('play').attr('controls', true)
	})

	/*$('.js-playable-video').click(function () {
		const video = $(this)
		const videoWrap = video.parent('.js-playable-video-wrap')

		videoWrap.removeClass('is-playing')
		video.trigger('pause')
	})*/
})
