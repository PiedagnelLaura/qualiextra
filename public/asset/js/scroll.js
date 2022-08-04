//Scroll function 

function isScrolledIntoView(el) {
    const rect = el.getBoundingClientRect();
    // Top of the section
    const elemTop = rect.top;
    // Bottom of the section
    const elemBottom = rect.bottom;
    // define the lenght of the block to display the title
    let isVisible = elemTop < window.innerHeight && elemBottom >= 0;
    
    // We check if the block is visible and if it never been appears
    if (isVisible && window[el.id] != true) {
        //we delay so that it does not appear one after the other
        setTimeout(() =>  {
            // We re-check if the block is visible
            isVisible = elemTop < window.innerHeight && elemBottom >= 0;
            if (isVisible) {
                //if it's visible, 
                const elems = document.querySelectorAll(".fixed-title");
                // We remove the active class of title for doesn't display it
                for(let i = 0; i < packageTypes.length; i++) {
                    elems[i].classList.remove('active');
                }
                //We add the class active of the section which are scrolled
                el.querySelector(".fixed-title").classList.add('active');

                setTimeout(() =>  {
                    //we during the time of the titlte appears
                    el.querySelector(".fixed-title").classList.remove('active');
                    //we say to the window elmt that the title is display
                    window[el.id] = true;
                }, 2000)
            }
        }, 1200);
    }
    
}

const packageTypes = ['experience-hoteliere', 'degustation-de-spiritueux', 'diner', 'experience-atypique'];


for(let i = 0; i < packageTypes.length; i++) {
    document.addEventListener('scroll', isScrolledIntoView.bind(null, document.getElementById(packageTypes[i])));
}
