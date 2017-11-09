if(screenJS.deviceLg()) {
	$('.navbar__nav-link.is--services').removeAttr('data-toggle');
} else {
	$('.navbar__nav-link.is--services').attr('data-toggle', 'dropdown');

}
/*if (device.mobile() || device.tablet()) {
	$(".navbar-collapse").prependTo($("body"));
	$(".icon-logo-full").prependTo($(".navbar-collapse-inner")).wrap('<a class="navbar-collapse__logo scrollto" href="#body-index"></a>');
}*/
/*
(function(){
	var nc = $('.navbar-collapse');
	var nc_parent = nc.parent();
	var nc_parent__is_body = (nc_parent.attr('id') == 'body-index') ? 1 : 0;
	
	if(screenJS.device()) {		
		if(nc_parent__is_body) {
			
		} else {			
			nc.prependTo($(document.body));			
			$('.icon-logo-full')
				.prependTo($('.navbar-collapse-inner'))
				.wrap('<a class="navbar-collapse__logo scrollto" href="#body-index"></a>')
			;			
		}
		
	} else {
		if(nc_parent__is_body) {
			nc.prependTo($('.navbar-collapse-cols')); // убираем элемент обратно
			$('.icon-logo-full')
				.prependTo($('.navbar-brand')) // тут перенос в исходное место
			;
			$('.navbar-collapse__logo.scrollto') // удаляем, где наследили
				.empty()
				.remove()
			;
		}
	}
})();*/