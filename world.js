document.addEventListener("DOMContentLoaded", function() {

    const btns = document.querySelectorAll('.btn');
    const searchInput = document.getElementById('country');

    //Add event listener to the lookup button
    btns.forEach(function(button) {
        button.addEventListener('click', function(event) {
            const isCitiesLookup = button.id === 'cities';
            buttonClick(event, isCitiesLookup);
        });
    });
    function buttonClick(event, isCitiesLookup) {
        event.preventDefault(); //Prevent default action

        //Sanitize input for increased security
        const saniQuery = sanitizeInput(searchInput.value);

        let link = `world.php?country=${saniQuery}${isCitiesLookup ? '&lookup=cities' : ''}`;

        //Create XMLHttpRequest object and open a GET request for php
        const req = new XMLHttpRequest();
        
        req.open("GET", link, true);

        //Set onload event handler
        req.onload = function() {
            //If request is successfull
            if (req.status === 200) {
                //Get response text
                const response = req.responseText;
                //Get #result div 
                const results = document.querySelector('#result');
                
                //Display result
                results.innerHTML = response;
            }
        };
        //Send request
        req.send();
    }

    //Function to sanitize user input - Alphanumeric and whitespace only
    function sanitizeInput(input) {
        return input.replace(/[^a-zA-Z0-9\s]/g, '').trim();
    }
});
