const app = {
    init: function(){
  
        filter.init();
        establishmentDetails.init(); 
        coordinate.init();
    }
};

document.addEventListener('DOMContentLoaded', app.init);
