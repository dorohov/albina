if(document.getElementById("2gis-map")){var map,mapCoord=[52.952442,36.065074],mapZoom=17,placeholderCoord=[52.95209,36.065025],iconUrl="/albina/img/default/map-placeholder.png",iconRetinaUrl="/albina/img/default/map-placeholder.png",iconSize=[80,80],iconAnchor=[40,80];if($(document).width()<768)var mapZoom=16;DG.then(function(){map=DG.map("2gis-map",{center:mapCoord,zoom:mapZoom,scrollWheelZoom:!1,fullscreenControl:!1});var o=DG.icon({iconUrl:iconUrl,iconRetinaUrl:iconRetinaUrl,iconSize:iconSize,iconAnchor:iconAnchor,popupAnchor:[0,0]});DG.marker(placeholderCoord,{icon:o}).addTo(map).bindPopup("г.&nbsp;Орел, ул.&nbsp;Комсомольская д.&nbsp;89")})}