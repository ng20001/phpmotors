'use strict'

// Get a list of vehicles in inventory based on the classificationId 
let classificationList = document.querySelector("#classificationList");
classificationList.addEventListener("change", function () { // any change will trigger the anonymous function
    let classificationId = classificationList.value;
    console.log(`classificationId selected by user is: ${classificationId}`); // use ` when a variable is included
    let classIdURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=" + classificationId; // ***request inventory data from the vehicles controller (which is from DB)***
    fetch(classIdURL) // a modern method of initiating an AJAX request
        .then(function (response) { // A "then" method that waits for data to be returned from the fetch
            if (response.ok) {
                return response.json(); // convert response (a json object) to a js object, pass to the next "then" line 16
            }
            throw Error("Network response was not OK");
        })
        .then(function (data) { // takes the js object from line 12, passes to an anonymous function
            console.log(data);
            buildInventoryList(data); // parse the data into html tb elements (data is an multi-d-array)
        })
        .catch(function (error) {
            console.log('There was a problem: ', error.message)
        })
})

// Build inventory items into HTML table components and inject into DOM 
function buildInventoryList(data) {
    let inventoryDisplay = document.getElementById("inventoryDisplay"); // vehicle-man view table
    // Set up the table labels 
    let dataTable = '<thead>';
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
    dataTable += '</thead>';
    // Set up the table body 
    dataTable += '<tbody>';
    // Iterate over all vehicles in the array and put each in a row 
    data.forEach(function (element) {
        console.log(element.invId + ", " + element.invModel);
        dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`;
        dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`;
        dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete'>Delete</a></td></tr>`;
    })
    dataTable += '</tbody>';
    // Display the contents in the Vehicle Management view 
    inventoryDisplay.innerHTML = dataTable;
}