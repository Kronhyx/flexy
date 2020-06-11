"use strict";
import 'jquery.easing'
import 'multiselect'

// Close any open menu accordions when window is resized below 768px
$(window).resize(() => {
	if ($(window).width() < 768) {
		$('.sidebar .collapse').collapse('hide');
	}
});

// Prevent the content wrapper from scrolling when the fixed side navigation hovered over
$('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
	if ($(window).width() > 768) {
		var e0    = e.originalEvent,
		    delta = e0.wheelDelta || -e0.detail;
		this.scrollTop += (delta < 0 ? 1 : -1) * 30;
		e.preventDefault();
	}
});

// Smooth scrolling using jQuery easing
$(document).on('click', 'a.scroll-to-top', function (e) {
	var $anchor = $(this);
	$('html, body').stop().animate({
		scrollTop: ($($anchor.attr('href')).offset().top)
	}, 1000, 'easeInOutExpo');
	e.preventDefault();
});

$(document).ready(() => {
	$('select[multiple]').multiSelect({ cssClass: 'w-100' });
})
