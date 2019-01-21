if (document.documentElement.clientWidth > 801) {

$('.logo').addClass('animated fadeInDownBig');

$(window).scroll(function() {
	$('header h2').each(function(){
	var imagePos = $(this).offset().top;
	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+550) {
			$(this).addClass("animated zoomIn");
		}
	});
});

$(window).scroll(function() {
	$('footer .footer-widget1').each(function(){
	var imagePos = $(this).offset().top;
	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+550) {
			$(this).addClass("animated fadeInRight animate-slow1");
		}
	});
});

$(window).scroll(function() {
	$('footer .footer-widget2').each(function(){
	var imagePos = $(this).offset().top;
	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+550) {
			$(this).addClass("animated fadeInRight animate-slow2");
		}
	});
});

$(window).scroll(function() {
	$('footer .footer-widget3').each(function(){
	var imagePos = $(this).offset().top;
	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+550) {
			$(this).addClass("animated fadeInRight animate-slow3");
		}
	});
});

$(window).scroll(function() {
	$('footer .footer-widget4').each(function(){
	var imagePos = $(this).offset().top;
	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+550) {
			$(this).addClass("animated fadeInRight animate-slow4");
		}
	});
});

$(window).scroll(function() {
	$('aside').each(function(){
	var imagePos = $(this).offset().top;
	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+550) {
			$(this).addClass("animated fadeIn");
		}
	});
});

$(window).scroll(function() {
	$('.contact-right').each(function(){
	var imagePos = $(this).offset().top;
	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+550) {
			$(this).addClass("animated fadeIn animate-fast");
		}
	});
});

$(window).scroll(function() {
	$('.contact-left').each(function(){
	var imagePos = $(this).offset().top;
	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+550) {
			$(this).addClass("animated fadeIn animate-fast");
		}
	});
});

$(window).scroll(function() {
	$('.contact-map').each(function(){
	var imagePos = $(this).offset().top;
	var topOfWindow = $(window).scrollTop();
		if (imagePos < topOfWindow+550) {
			$(this).addClass("animated fadeIn animate-fast");
		}
	});
});

       }     


