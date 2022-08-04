
// we add the map and center it on Paris
const map = L.map('map-establishment').setView([48.8588897,2.320041], 13);
//Calque
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

