const slider = {
    count: 0,
    
    init: function() {
        // We recover the two buttons previous and next
        const previousButton = document.querySelector('#previous');
        const nextButton = document.querySelector('#next');
        // We create events
        previousButton.addEventListener('click', slider.handleClick);
        nextButton.addEventListener('click', slider.handleClick);
        let sectionBoard = document.querySelectorAll('.carousel');
        sectionBoard[slider.count].classList.remove('d-none');


        // we launch a timer to simulate a click on the nextArraoxElmt arrow every 5 seconds
        setInterval(function () 
            {
                nextButton.click();
            },
            5000);
        },


    handleClick: function (event) {
        //we remove the current reload by default
        const button = event.currentTarget;
        //we call the section class
        const carousel = document.querySelectorAll('.carousel');
        // create variable for previous picture 
        let sectionBefore;

        // if we click on button previous, we display the last image of the carousel
        if (button.id == 'previous') {
            slider.count --;
         sectionBefore = carousel[slider.count+1];
        }
        else {
            slider.count ++;
         sectionBefore = carousel[slider.count-1];
        }

        
        if (slider.count < 0) {
            slider.count = 1;
         sectionBefore = carousel[0];
        }

        if (slider.count > carousel.length-1) {
            slider.count = 0;
         sectionBefore = carousel[carousel.length-1];
        }
        
        let sectionDisplay = carousel[slider.count];
        sectionDisplay.classList.remove('d-none');
     sectionBefore.classList.add('d-none');  
    },
};

document.addEventListener('DOMContentLoaded', slider.init);