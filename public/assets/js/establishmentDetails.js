const establishmentDetails = {
    init: function () {
        const aEstablishmentElmt = document.querySelectorAll('.establishment');
        const iconCloseElmt = document.querySelector('#details-close');
        iconCloseElmt.addEventListener('click', establishmentDetails.handleClickClose);
        
        for( const establishmentElmt of aEstablishmentElmt) {
            establishmentElmt.addEventListener('click', establishmentDetails.handleClickAside);
        }
    },

    /**
     * if you click on an establishment, you open a "details" div and you automatically close the "filter" div if it is open
     */
    handleClickAside: function (evt) {
        evt.preventDefault();
        document.querySelector('.details').classList.remove('d-none');
        document.querySelector('.establishmentList').classList.add('d-none');
        document.querySelector('.filter-case').classList.add('d-none');    
    },

    /**
     * if you click on the cross, you close the div
     */
    handleClickClose: function (evt) {
        document.querySelector('.details').classList.add('d-none');
        document.querySelector('.establishmentList').classList.remove('d-none');
        
    },

  
};
