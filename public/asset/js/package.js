const package = {
    init: function(){
        const establishment = document.querySelector('.establishment');
        
                   

            let latEstablishment = establishment.dataset.lat;
            let longEstablishment = establishment.dataset.long;

        const map = L.map('map-establishment').setView([latEstablishment,longEstablishment], 12);
L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
	maxZoom: 20,
	attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
}).addTo(map);

    
                            
            // for each establishment, we add a marker on the map
            let marker = L.marker([latEstablishment, longEstablishment]).addTo(map);
    
                             

    }
}
document.addEventListener('DOMContentLoaded', package.init);