if(document.getElementById('2gis-map')) {
	var map;
	var mapCoord = [52.952442, 36.065074];
	var mapZoom = 17;
	var placeholderCoord = [52.95209, 36.065025];
	var iconUrl = '/albina/img/default/map-placeholder.png';
	var iconRetinaUrl = '/albina/img/default/map-placeholder.png';
	var iconSize = [80, 80];
	var iconAnchor = [40, 80];	
	if($(document).width() < 768) {
		var mapZoom = 16;
		//var mapCoord = [52.9744, 36.059];
		//var iconUrl = '/wp-content/themes/azbn7theme/img/default/map-placeholder-xs.png';
		//var iconRetinaUrl = '/wp-content/themes/azbn7theme/img/default/map-placeholder-xs.png';
		//var iconSize = [74, 80];
		//var iconAnchor = [36, 74];	 
	}
	DG.then(function () {
		map = DG.map('2gis-map', {
			center: mapCoord,
			zoom: mapZoom,
			scrollWheelZoom: false,
			fullscreenControl: false
		});
		var myIcon = DG.icon({
			iconUrl: iconUrl,
			iconRetinaUrl: iconRetinaUrl,
			iconSize: iconSize,
			iconAnchor: iconAnchor,
			popupAnchor: [0, 0]
		});
		DG.marker(placeholderCoord, {icon: myIcon}).addTo(map).bindPopup('г.&nbsp;Орел, ул.&nbsp;Комсомольская д.&nbsp;89');
	});
}



