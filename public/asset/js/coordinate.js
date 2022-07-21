const coordinate = {
    init: function () {
        console.log('coucou');
        const listEstablisment = document.querySelectorAll('.establishment');
   
        for (let establishment of listEstablisment) {


            let latEstablishment = establishment.dataset.lat;
            let longEstablishment = establishment.dataset.long;

            // for each establishment, we add a marker on the map
            var marker = L.marker([latEstablishment, longEstablishment]).addTo(map);

            // we add a popup when we click on the marker
            marker.bindPopup('');
            console.log(marker);

           
        }
      

        map.on('click', function () {
            map.removeLayer(marker);
          });


    },

    
}