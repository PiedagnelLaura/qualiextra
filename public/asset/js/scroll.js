//Scroll function 

function isScrolledIntoView(el) {
    const rect = el.getBoundingClientRect();
    const elemTop = rect.top;
    const elemBottom = rect.bottom;
    const isVisible = elemTop < window.innerHeight && elemBottom >= 0;

    if (isVisible) {
        
        if (window[el.id] != true) {
            el.querySelector(".fixed-title").classList.add('active');

        setTimeout(() =>  {
            el.querySelector(".fixed-title").classList.remove('active');
        window[el.id] = true;
        }, 2000)
        }
    }
}

const packageTypes = ['experience-hoteliere', 'degustation-de-spiritueux', 'diner', 'experience-atypique'];


for(let i = 0; i < packageTypes.length; i++) {
    document.addEventListener('scroll', isScrolledIntoView.bind(null, document.getElementById(packageTypes[i])));
}
