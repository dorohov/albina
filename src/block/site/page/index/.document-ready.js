$('.azbn__video-poster').on('click', function() {
	$(this).addClass('is--active'); 
	$('.azbn__video').addClass('is--active').get(0).play(); 
});