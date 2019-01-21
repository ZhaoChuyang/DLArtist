// Expand Portfolio
$(document).ready(function($) {
	$('#slider-home').flexslider({
		animation: "slide",
		slideshow: false,
		controlNav: false,
	     directionNav: false,
		controlsContainer: ".bannerbutton",
		controlNav: true,
		manualControls: "#portfolio-items .folio-item"
	});

	$('.prev').on('click', function(){
		$('#slider-home').flexslider('prev')
		return false;
	})

	$('.next').on('click', function(){
		$('#slider-home').flexslider('next')
		return false;
	})
});

$('.folio-item1').on('click', function(){
	if($('.project-show').hasClass('ps-visible1')){
	   $('.project-show').removeClass('ps-visible1')

	}else{
	  $('.project-show').addClass('ps-visible1')
	}
});

$('.folio-item2').on('click', function(){
	if($('.project-show').hasClass('ps-visible2')){
	   $('.project-show').removeClass('ps-visible2')

	}else{
	  $('.project-show').addClass('ps-visible2')
	}
});

$('.folio-item3').on('click', function(){
	if($('.project-show').hasClass('ps-visible3')){
	   $('.project-show').removeClass('ps-visible3')

	}else{
	  $('.project-show').addClass('ps-visible3')
	}
});

$('.folio-item4').on('click', function(){
	if($('.project-show').hasClass('ps-visible4')){
	   $('.project-show').removeClass('ps-visible4')

	}else{
	  $('.project-show').addClass('ps-visible4')
	}
});

$('.folio-item5').on('click', function(){
	if($('.project-show').hasClass('ps-visible5')){
	   $('.project-show').removeClass('ps-visible5')

	}else{
	  $('.project-show').addClass('ps-visible5')
	}
});

$('.folio-item6').on('click', function(){
	if($('.project-show').hasClass('ps-visible6')){
	   $('.project-show').removeClass('ps-visible6')

	}else{
	  $('.project-show').addClass('ps-visible6')
	}
});

$('.folio-item7').on('click', function(){
	if($('.project-show').hasClass('ps-visible7')){
	   $('.project-show').removeClass('ps-visible7')

	}else{
	  $('.project-show').addClass('ps-visible7')
	}
});

$('.folio-item8').on('click', function(){
	if($('.project-show').hasClass('ps-visible8')){
	   $('.project-show').removeClass('ps-visible8')

	}else{
	  $('.project-show').addClass('ps-visible8')
	}
});

$('.folio-item9').on('click', function(){
	if($('.project-show').hasClass('ps-visible9')){
	   $('.project-show').removeClass('ps-visible9')

	}else{
	  $('.project-show').addClass('ps-visible9')
	}
});

$('.close-it').on('click', function(){
	  $('.project-show').removeClass('ps-visible1');
	  $('.project-show').removeClass('ps-visible2');
	  $('.project-show').removeClass('ps-visible3');
	  $('.project-show').removeClass('ps-visible4');
	  $('.project-show').removeClass('ps-visible5');
	  $('.project-show').removeClass('ps-visible6');
	  $('.project-show').removeClass('ps-visible7');
	  $('.project-show').removeClass('ps-visible8');
	  $('.project-show').removeClass('ps-visible9');
});
