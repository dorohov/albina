'use strict';
$(function() {
	$('.owl-block').owlCarousel({
		navText: ['<svg class="icon-svg icon-owl-prev" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-prev"></use></svg>', '<svg class="icon-svg icon-owl-next" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-next"></use></svg> '],
		nav: true,
		dots: false,
		smartSpeed: 500,
		margin: 30,
		//loop: true,
		//mouseDrag: false,
		responsive : {
			0 : {
				items:1,
				margin: 0,
			},
			570 : {
				items:2,
			},
			980 : {
				items:4,
			},
			1400 : {
				items:5,
			}
		}
	});
	$('.owl-one').owlCarousel({
		navText: ['<svg class="icon-svg icon-owl-prev" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-prev"></use></svg>', '<svg class="icon-svg icon-owl-next" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-next"></use></svg> '],
		nav: true,
		dots: false,
		smartSpeed: 500,
		loop: true,
		margin: 0,
		items:1,
		
	});	
	$('.owl-big').owlCarousel({
		navText: ['<svg class="icon-svg icon-owl-prev" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-prev-400"></use></svg>', '<svg class="icon-svg icon-owl-next" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-next-400"></use></svg> '],
		nav: true,
		dots: false,
		smartSpeed: 500,
		loop: true,
		margin: 0,
		items:1,	
	});	
	$('.owl-center').owlCarousel({
		navText: ['<svg class="icon-svg icon-owl-prev" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-prev-400"></use></svg>', '<svg class="icon-svg icon-owl-next" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-next-400"></use></svg> '],
		nav: true,
		dots: false,
		smartSpeed: 500,
		loop: true,
		center: true,
    	autoWidth:true,
		mouseDrag: false,
		touchDrag: false,
		margin: 50,
		items:1	,
		responsive : {
			0 : {
				margin: 30,
			},
			400 : {
				margin: 20,
			},
			1000 : {
				margin: 50,
			}
		}	
	});	
	if(screenJS.isXS()) {
		$('.portfolio-tabs__pane-row').owlCarousel({
			navText: ['<svg class="icon-svg icon-owl-prev" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-prev"></use></svg>', '<svg class="icon-svg icon-owl-next" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/wp-content/themes/azbnbasetheme2/img/svg/sprite.svg#owl-next"></use></svg> '],
			nav: false,
			dots: false,
			smartSpeed: 500,
			margin: 30,
			responsive : {
				0 : {
					items:1,
					//margin: 0,
				},
				570 : {
					items:2,
				}
			}
		});
	}
});