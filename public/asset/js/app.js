const app = {
    init: function(){
  
        filter.init();
        establishmentDetails.init(); 
    }
};

document.addEventListener('DOMContentLoaded', app.init);