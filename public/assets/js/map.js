

// we add the map and center it on Paris
var map = L.map('map').setView([48.8588897,2.320041], 12);
L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
	maxZoom: 20,
	attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
}).addTo(map);

// for each establishment, we add a marker on the map
var marker = L.marker([48.8588897,2.320041]).addTo(map);

// we add a popup when we click on the marker
marker.bindPopup('');