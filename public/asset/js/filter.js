const filter = {
    init: function () {
        const buttonFilterElmt = document.querySelector('#filter');
        buttonFilterElmt.addEventListener('click', filter.handleClickFilter);

        const iconCloseElmt = document.querySelector('#filter-close');
        iconCloseElmt.addEventListener('click', filter.handleClickClose);

        // we put a listener on the checkboxes style
        const stylesCheckboxList = document.querySelectorAll('.style-checkbox');
        for( const styleCheckbox of stylesCheckboxList) {
            styleCheckbox.addEventListener('click', filter.handleClickStyle);
        }

        // we put a listener on the checkboxes tag
        const tagsCheckboxList = document.querySelectorAll('.tag-checkbox');
        for( const tagCheckbox of tagsCheckboxList) {
            tagCheckbox.addEventListener('change', filter.handleChangeTag);
        }
        
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

    /**
     * when you select a checkbox, you filter the list of restaurants
     */
    handleClickStyle: function (evt) {
        // the style associated with the check box
        let style =evt.target.id;

        //we look if the checkbox is checked or not
        let checkedBool =evt.target.checked;

        // we get the list of restaurants
        let restaurantList = document.querySelectorAll('.establishment');
        
        for( const restaurant of restaurantList) {
            // For each restaurant, we retrieve the style associated with it
           let  styleOfRestaurant = restaurant.dataset.name;

           // if the box is not checked, we remove the restaurant from the list
           if (checkedBool ==false && styleOfRestaurant === style) {
            restaurant.classList.add("d-none");
           }

           // if the box is checked, we put the restaurant in the list
           if (checkedBool ==true && styleOfRestaurant === style) {
            restaurant.classList.remove("d-none");
           }
            
        }
    },

    /**
     * when you select a checkbox, you filter the list of restaurants
     */
     handleChangeTag: function () {
        const tagsCheckboxList = document.querySelectorAll('.tag-checkbox');
        let listTagsChecked = [];
        for( const tagCheckbox of tagsCheckboxList) {
            if (tagCheckbox.checked) {
                listTagsChecked.push(tagCheckbox.id);
            }
            
        }
        
        // we get the list of restaurants
        let restaurantList = document.querySelectorAll('.establishment');
        
        for( const restaurant of restaurantList) {
            // For each restaurant, we retrieve the tags associated with it
           let  tagsOfRestaurant = restaurant.dataset.tag;
           //console.log(tagsOfRestaurant);
           restaurantTagArray = tagsOfRestaurant.split(" ");
           //console.log(restaurantTagArray);

           let counter = 0;
           for (let i=0; i< restaurantTagArray.length -1; i++) {
                if (listTagsChecked.includes(restaurantTagArray[i])) {
                    counter++;
                   
                }
           }
           console.log(counter);
           if (counter !=0) {
            restaurant.classList.remove("d-none");
           }
           else {
            restaurant.classList.add("d-none");
           }  
        }
    }
};


