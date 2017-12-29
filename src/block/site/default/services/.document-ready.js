$(document.body).on('azbn.setActive', '.services-index__svg-desc', {}, function(event){
	event.preventDefault();
	
	$('.services-index__svg-desc').attr('data-hovered', 0);
	
	var block = $(this);
	var area = block.attr('data-area-id') || 0;
	block.attr('data-hovered', 1);
	
	$('.services-index__link').removeClass('is--active');
	$('.services-index__link[data-area-id="' + area + '"]').addClass('is--active');
	
});
$(document.body).on('click.azbn', '.services-index__link', {}, function(event){
	event.preventDefault();
	
	var btn = $(this);
	//var block = btn.closest('.services-index__svg');
	var area = btn.attr('data-area-id') || 0;
	
	$('.services-index__svg-desc[data-area-id="' + area + '"]').trigger('azbn.setActive');
	
	//block.find('li .desc').remove().empty();
	
	//var li = btn.parent();
	//$('.services-index__svg-desc[data-area-id="' + area + '"]').clone(true).appendTo(li);
	
	//block.find('li').removeClass('active');
	//btn.closest('li').addClass('active');
	
});
$(document.body).on('mouseover.azbn', '.services-index__svg-area-item', {}, function(event){
	event.preventDefault();
	
	var btn = $(this);
	//var block = btn.closest('.services-index__svg');
	var area = btn.attr('data-area-id') || 0;
	
	$('.services-index__svg-desc[data-area-id="' + area + '"]').trigger('azbn.setActive');
	
});