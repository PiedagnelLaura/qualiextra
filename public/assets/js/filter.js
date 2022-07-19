const filter = {
    init: function () {
        const buttonFilterElmt = document.querySelector('#filter');
        const iconCloseElmt = document.querySelector('#filter-close');
        buttonFilterElmt.addEventListener('click', filter.handleClickFilter);
        iconCloseElmt.addEventListener('click', filter.handleClickClose);
    },

    /**
     * when you click on the "filter" button, a div appears
     * we close the "details" div if it is open
     */
    handleClickFilter: function (evt) {
        evt.preventDefault();
        document.querySelector('.filter-case').classList.toggle('d-none');
        document.querySelector('.details').classList.add('d-none');
        document.querySelector('.establishmentList').classList.remove('d-none');
        
    },

    /**
     * if you click on the cross, you close the div
     */
    handleClickClose: function (evt) {
        document.querySelector('.filter-case').classList.add('d-none');
        
    },
};

