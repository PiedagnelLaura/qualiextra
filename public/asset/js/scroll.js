//Scroll function 

function isScrolledIntoView(el) {
    const rect = el.getBoundingClientRect();
    const elemTop = rect.top;
    const elemBottom = rect.bottom;
    let isVisible = elemTop < window.innerHeight && elemBottom >= 0;


    //Je vérifie que mon bloc est visible et qu'il n'a jamais été affiché
    if (isVisible && window[el.id] != true) {
        //Je temporise pour qu'il ne s'affiche pas les uns à la suite des autres
        setTimeout(() =>  {
            //Je re-vérifie que mon bloc est toujours visible
            isVisible = elemTop < window.innerHeight && elemBottom >= 0;
            if (isVisible) {
                //si c'est le cas, 
                const elems = document.querySelectorAll(".fixed-title");
                //je remove la classe active des titres pour que rien ne s'affiche
                for(let i = 0; i < packageTypes.length; i++) {
                    elems[i].classList.remove('active');
                }
                //je l'ajoute uniquement sur le bon titre
                el.querySelector(".fixed-title").classList.add('active');

                setTimeout(() =>  {
                    //après 2sec je lui retire la classe active
                    el.querySelector(".fixed-title").classList.remove('active');
                    //et je le signale en lui indiquant que cet élément a bien été affiché
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
