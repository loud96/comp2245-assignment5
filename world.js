document.addEventListener("DOMContentLoaded", function() {

    const btn = document.getElementById('lookup');
    const searchInput = document.getElementById('country');

    //Add event listener to the lookup button
    btn.addEventListener('click', (event) =>{
        event.preventDefault(); //Prevent default action

        //Sanitize input for increased security
        const saniQuery = santizeInput(searchInput.value);

        //Create XMLHttpRequest object and open a GET request for php
        const req = new XMLHttpRequest();
        const link = saniQuery ? `world.php?country=${saniQuery}` : 'world.php';
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
    });

    //Function to sanitize user input - Alphanumeric and whitespace only
    function santizeInput(input) {
        return input.replace(/[^a-zA-Z0-9\s]/g, '').trim();
    }
});