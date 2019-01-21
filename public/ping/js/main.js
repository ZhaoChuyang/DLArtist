$(window).resize( function() {
	window.location.href = window.location.href;
});

// Flickrfeed
$(document).ready(function() {
    "use strict";

    $('#flickr').jflickrfeed({
        limit: 8,
        qstrings: {
            id: '52617155@N08'
        },
        itemTemplate: '<li><a href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
    });

    // Prettyphoto
    $("a[class^='prettyPhoto']").prettyPhoto({
        theme: 'pp_default'
    });

    // Portfolio Filter 
    $(".portfolio-filter .ico").click(function() {
        $(".portfolio-filter ul").slideToggle();
    });

    // Parallax 
    $.stellar({
        horizontalScrolling: false,
        verticalOffset: 150
    });

    // ScrollTo 
    $('.folio-item').click(function() {
    		$("html, body").animate({
    			scrollTop: $('#portfolio-single').offset().top
    		}, 1000);
    });

    $('.folio-item').click(function() {
    		$.scrollTo($('#portfolio-single'), 500);
    });

    // Responsive Menu 
    $('#menu').slicknav({
            prependTo: 'nav .row'
    });

    // Smooth Scroll
    $("html").niceScroll();

    // Owl Carousel - Blog
    $("#blog-slider").owlCarousel({
        navigation: false, // Show next and prev buttons
        slideSpeed: 300,
        pagination: true,
        paginationSpeed: 400,
        singleItem: true
            // "singleItem:true" is a shortcut for:
            // items : 1,
            // itemsDesktop : false,
            // itemsDesktopSmall : false,
            // itemsTablet: false,
            // itemsMobile : false
    });
});

if (document.documentElement.clientWidth < 767) {
	$(document).ready(function() {
		$(".portfolio-filter ul li a").click(function() {
			$(".portfolio").css('padding-bottom', '115px');
		});
	});
}

// Isotope 

$(window).load(function(){
    	var $container = $('#portfolio-items');
    	$container.isotope({
    		itemSelector: '.folio-item'
    	});
    	var $optionSets = $('.folio-filter'),
    		$optionLinks = $optionSets.find('a');
    	$optionLinks.click(function() {
    		var $this = $(this);
    		if ($this.hasClass('selected')) {
    			return false;
    		}
    		var $optionSet = $this.parents('.folio-filter');
    		$optionSet.find('.selected').removeClass('selected');
    		$this.addClass('selected');
    		// make option object dynamically, i.e. { filter: '.my-filter-class' }
    		var options = {},
    			key = $optionSet.attr('data-option-key'),
    			value = $this.attr('data-option-value');
    		value = value === 'false' ? false : value;
    		options[key] = value;
    		if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
    			changeLayoutMode($this, options);
    		} else {
    			$container.isotope(options);
    		}
    		return false;
    	});
});


