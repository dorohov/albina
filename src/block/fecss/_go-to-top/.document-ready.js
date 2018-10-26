
/*
start .got-to-top document-ready
*/

$('body').prepend('<a class="go-to-top active" href="body"><img class="arrow" src="img/svg/arrow.svg" alt="Go Top"/></a>');


$(document.body).on('click.fecss.go-to-top', '.go-to-top', function(event){
	event.preventDefault();
	
	$('html, body').animate({
		scrollTop : 0
	}, 777);
});

/*
end .got-to-top document-ready
*/
