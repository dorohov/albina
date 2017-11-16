'use strict';
$(function() { 
	$('#slick-center').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		draggable: false,
		swipe: false,
		//fade: true,
		asNavFor: '#slick-nav',
		variableWidth: true,
		centerMode: true,
		prevArrow: '<button type="button" class="slick-prev"><svg class="icon-svg icon-owl-prev" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbn7theme/img/svg/sprite.svg#owl-prev"></use></svg></button>',
		nextArrow: '<button type="button" class="slick-next"><svg class="icon-svg icon-owl-next" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbn7theme/img/svg/sprite.svg#owl-next"></use></svg></button>'
		//prevArrow: '<button type="button" class="slick-prev"><svg class="icon-svg icon-owl-prev" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/img/svg/sprite.svg#owl-prev"></use></svg></button>',
		//nextArrow: '<button type="button" class="slick-next"><svg class="icon-svg icon-owl-next" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/img/svg/sprite.svg#owl-next"></use></svg></button>'
	});
	$('#slick-nav').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '#slick-center',
		arrows: false,
		centerMode: true,
		focusOnSelect: true,
		draggable: false,
		swipe: false,
		responsive: [
		    {
		      breakpoint: 769,
		      settings: {
		        slidesToShow: 4
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1
		      }
		    }
	  	]
	});
}); 