/**
 * Show the map on package details
 */
const package = {
    init: function(){
        const establishment = document.querySelector('.establishment');
        
        let latEstablishment = establishment.dataset.lat;
        let longEstablishment = establishment.dataset.long;

        const map = L.map('map-establishment').setView([latEstablishment,longEstablishment], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // for each establishment, we add a marker on the map
        let marker = L.marker([latEstablishment, longEstablishment]).addTo(map);

    }
}
document.addEventListener('DOMContentLoaded', package.init);
