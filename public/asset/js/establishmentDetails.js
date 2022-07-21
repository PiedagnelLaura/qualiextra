const establishmentDetails = {
    init: function () {

        const aEstablishmentElmt = document.querySelectorAll('.establishment');
        for (const establishmentElmt of aEstablishmentElmt) {
            establishmentElmt.addEventListener('click', establishmentDetails.handleClickAside);
        }

        const iconsCloseElmt = document.querySelectorAll('#details-close');
        for (const iconCloseElmt of iconsCloseElmt) {
            iconCloseElmt.addEventListener('click', establishmentDetails.handleClickClose);
        }
 
    },

    /**
     * if you click on an establishment, you open a "details" div and you automatically close the "filter" div if it is open
     */
    handleClickAside: function (evt) {

        evt.preventDefault();
        let linkElmt = evt.target.closest('a');
        
        for (const detailEstablishment of document.querySelectorAll('.details')) {
            if (detailEstablishment.id === linkElmt.dataset.number) {
                detailEstablishment.classList.remove('d-none');
            }
        }

        document.querySelector('.establishmentList').classList.add('d-none');
        document.querySelector('.filter-case').classList.add('d-none');
    },

    /**
     * if you click on the cross, you close the div
     */
    handleClickClose: function (evt) {
        for (const detailEstablishment of document.querySelectorAll('.details')) {
            detailEstablishment.classList.add('d-none');
        }
        document.querySelector('.establishmentList').classList.remove('d-none');

    },

    /**
     * if you click on an marker, you open a "details" div and you automatically close the "filter" div if it is open
     */
     handleClickMarker: function (evt) {

        // we collect the classes of the marker and we keep only the last one
        let classList = evt.target.className;
        let classArray = classList.split(" ");
        let lastClasse = classArray[classArray.length-1];

        for (const detailEstablishment of document.querySelectorAll('.details')) {
            detailEstablishment.classList.add('d-none');
            if (detailEstablishment.id === lastClasse) {
                detailEstablishment.classList.remove('d-none');
            }
        }
        document.querySelector('.establishmentList').classList.add('d-none');
        document.querySelector('.filter-case').classList.add('d-none');
        
    },
};