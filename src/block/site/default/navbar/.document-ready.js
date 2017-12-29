//var url = window.location.pathname;
var url = window.location.href;
$('.navbar__nav a[href="'+url+'"]').parent().addClass('is--active'); 
$('.navbar-category__nav .navbar-category__link[href="'+url+'"]').addClass('is--active'); 
$('.navbar__nav').on('click', '.navbar__nav-dropdown a[data-toggle="tab-dropdown"]', function(e) {
    e.preventDefault();
    e.stopPropagation();
});