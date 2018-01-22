if(screenJS.is('xs')){
	$(".price-list-services__text-block .table tbody tr td .is--ruble-sm").remove(); 
	$(".pricelist-panel__text-block .table tbody tr td .is--ruble-sm").remove(); 
	$(".pricelist-panel__text-block .table tbody tr td:last-child").append($('<div class="is--ruble-sm"></div>'));  
	$(".price-list-services__text-block .table tbody tr td:last-child").append($('<div class="is--ruble-sm"></div>')); 
} else {
	$(".price-list-services__text-block .table tbody tr td .is--ruble-sm").remove(); 
	$(".pricelist-panel__text-block .table tbody tr td .is--ruble-sm").remove(); 
}