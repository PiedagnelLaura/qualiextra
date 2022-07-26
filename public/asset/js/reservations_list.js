const reservations_list = {
    init: function () {
        const AllreservationsList = document.querySelectorAll('.package-line');
        for(const oneReservation of AllreservationsList){
            oneReservation.classList.add('d-none')
        }

        //we browse the reservation to check
        reservations_list.browseToCheck();
        //we browse the reservations validated
        reservations_list.browseValidated();
        //we browse the reservation cancelled
        reservations_list.browseCancelled();
    },

    browseToCheck: function() {
        //we retrieve the element to browse the reservations to check
        const elementsToCheck= document.querySelectorAll('.toCheck'); 
      
        for(const table of elementsToCheck){
            //we retrieve all the reservations line
            const reservationsList = table.querySelectorAll('.package-line');
                 
            //we get the status of each reservation and we show these reservation
            for (const reservation of reservationsList){
                let statusReservation = reservation.dataset.status
                
                //we remove the d-none class when the status is to check
                if (statusReservation == 0){
                    reservation.classList.remove('d-none')
                }
            }        
        }
    },

    browseCancelled: function(){
        //we retrieve the element to browse the reservations cancelled
        const elementsToCheck= document.querySelectorAll('.cancelled');
        for(const table of elementsToCheck){
            //we retrieve all the reservations line
            const reservationsList = table.querySelectorAll('.package-line');
                 
            //we get the status of each reservation and we show these reservation
            for (const reservation of reservationsList){
                let statusReservation = reservation.dataset.status
                
                //we remove the d-none class when the status is cancelled
                if (statusReservation == 2){
                    reservation.classList.remove('d-none')
                }
            }        
        }
    },

    browseValidated: function(){
        //we retrieve the element to browse the reservations valitated
        const elementsToCheck= document.querySelectorAll('.validated');
        
        for(const table of elementsToCheck){
            //we retrieve all the reservations line
            const reservationsList = table.querySelectorAll('.package-line');
                 
            //we get the status of each reservation and we show these reservation
            for (const reservation of reservationsList){
                let statusReservation = reservation.dataset.status
               
                //we remove the d-none class when the status is validated
                if (statusReservation == 1){
                    reservation.classList.remove('d-none')
                }
            }        
        }

    },
}
document.addEventListener('DOMContentLoaded', reservations_list.init);