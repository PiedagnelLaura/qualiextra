const selectedListAdmin = {
    init: function(){
  
        // we put an eventListener on the links of the nav
        const listsLinksElmts = document.querySelectorAll('.listLink');
        for (const listLinkElmt of listsLinksElmts) {
            listLinkElmt.addEventListener('click', selectedListAdmin.handleClick);
        }
    },

    /**
     * when you click on a link in the nav, the corresponding content is displayed
     */
     handleClick: function (evt) {
        evt.preventDefault();
        for (const listElmt of document.querySelectorAll('.list')){
            // we hide all the sections
            listElmt.classList.add('d-none');
           
            // the section corresponding to the clicked link is displayed with the link id and the section class
            if (listElmt.className.includes(evt.target.id)) {
                listElmt.classList.remove('d-none');
            }
        }
 
    },


};

document.addEventListener('DOMContentLoaded', selectedListAdmin.init);
