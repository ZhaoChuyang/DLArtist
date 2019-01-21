// Google Map
$(function() {
	var map = new GMaps({
		el: "#map",
		lat: 40.714353,
		lng: -74.005973,
		zoom: 17,
		zoomControl: false,
		zoomControlOpt: {
			style: "BIG",
			position: "TOP_LEFT"
		},
		panControl: false,
		streetViewControl: false,
		mapTypeControl: false,
		overviewMapControl: false
	});
	var styles = [{
		stylers: [{
			hue: "#00ffe6"
		}, {
			saturation: -100
		}]
	}];
	map.addStyle({
		styledMapName: "Styled Map",
		styles: styles,
		mapTypeId: "map_style"
	});
	map.setStyle("map_style");
	map.addMarker({
		lat: 40.714353,
		lng: -74.005973,
		icon: "images/marker.png"
	});
});

