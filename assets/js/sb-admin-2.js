"use strict";
import 'jquery.easing'
import 'multiselect'

// Toggle the side navigation
$("#sidebarToggle, #sidebarToggleTop").on('click', () => {
	const sidebar = $(".sidebar")

	$("body").toggleClass("sidebar-toggled");
	sidebar.toggleClass("toggled");
	if (sidebar.hasClass("toggled")) {
		$('.sidebar .collapse').collapse('hide');
	}
});

// Close any open menu accordions when window is resized below 768px
$(window).resize(() => {
	if ($(window).width() < 768) {
		$('.sidebar .collapse').collapse('hide');
	}
});

// Prevent the content wrapper from scrolling when the fixed side navigation hovered over
$('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
	if ($(window).width() > 768) {
		const e0    = e.originalEvent,
		      delta = e0.wheelDelta || -e0.detail
		this.scrollTop += (delta < 0 ? 1 : -1) * 30;
		e.preventDefault();
	}
});

$(document).ready(() => {
	$('select[multiple]').multiSelect({ cssClass: 'w-100' });
	$('table[data-type="datatable"]').DataTable();
})
