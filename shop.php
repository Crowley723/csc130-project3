<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop</title>
    <?php include "./header.php" ?>
    <link rel="stylesheet" href="/design.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        
jQuery(document).ready(function(){
    getPosts();
});
// Add an event listener to the search input
document.querySelector('input[name="search"]').addEventListener('input', function () {
    // Get the current search term from the input field
    var searchTerm = this.value.toLowerCase();

    // Get all grid items
    var gridItems = document.querySelectorAll('.grid-item');

    // Flag to check if any items match the search term
    var hasMatches = false;

    // Loop through each grid item and check if it contains the search term
    gridItems.forEach(function (gridItem) {
        var itemName = gridItem.querySelector('.item-name').innerText.toLowerCase();
        var itemDescription = gridItem.querySelector('.item-description').innerText.toLowerCase();

        // Check if the item name or description contains the search term
        if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
            // Show the grid item if it matches the search term
            gridItem.style.display = 'flex'; // Assuming your grid items are styled with flex
            hasMatches = true;
        } else {
            // Hide the grid item if it doesn't match the search term
            gridItem.style.display = 'none';
        }
    });

var debounceTimer;

document.querySelector('input[name="search"]').addEventListener('input', function () {
    clearTimeout(debounceTimer); // Clear the previous timer

    debounceTimer = setTimeout(function () {
        // Your code to handle the search request
        var searchTerm = document.querySelector('input[name="search"]').value.toLowerCase();
        // Perform the search or update the page as needed
        getSearchResults(searchTerm);
    }, 300); // Adjust the delay (in milliseconds) as needed
});

function getSearchResults(searchTerm) {
    // You can make your AJAX request or perform other actions here
    // For example, update the page or send a request to the server
    console.log('Search term:', searchTerm);
}


    // Display a message if there are no matches
    var noMatchMessage = document.getElementById('no-match-message');
    if (!hasMatches) {
        noMatchMessage.style.display = 'block';
    } else {
        noMatchMessage.style.display = 'none';
    }
});


function getPosts(){
    $.ajax({
        url:'/getShopItems.php',
        type:'GET',
        dataType: 'json',
        success: function(data){
            updatePage(data);
        },
        error: function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}

function updatePage(data){
    if(data && data.length > 0){  // Check if data is not null and has items
        for(var i = data.length - 1; i >= 0; i--){
            var item = data[i];
        // <div class="grid-item">
        //     <img class="item-image" src="/assets/cat-food.png" alt="Cat Food">
        //     <div class="text-container">
        //         <div class="item-name">Cat Food</div>
        //         <div class="item-quantity">Quantity on Hand: 7</div>
        //         <div class="item-description">The food that you give your cat. Duh</div>
        //     </div>
        // </div>
            if(item.hasOwnProperty('ID') && 
                item.hasOwnProperty('Name') && 
                item.hasOwnProperty('Description') && 
                item.hasOwnProperty('Image Path') &&
                item.hasOwnProperty('Quantity On Hand')){

                const gridItem = document.createElement("div");
                gridItem.className = 'grid-item';
                gridItem.id = item['ID'];
                const gridContainer = document.getElementById('grid-container');
                gridContainer.appendChild(gridItem);

                const itemImage = document.createElement("img");
                itemImage.src = item['Image Path']; // Make sure 'IMAGE PATH' property exists in your data
                itemImage.className = 'item-image';
                gridItem.appendChild(itemImage);                

                const textContainer = document.createElement("div");
                textContainer.className = 'text-container';
                gridItem.appendChild(textContainer);

                const itemName = document.createElement('div');
                itemName.className = 'item-name';
                itemName.innerText = item['Name'];
                textContainer.appendChild(itemName);

                const itemQuantity = document.createElement('div');
                itemQuantity.className = 'item-quantity';
                itemQuantity.innerText = "In stock: " + item['Quantity On Hand'];
                textContainer.appendChild(itemQuantity);

                const itemDescription = document.createElement('div');
                itemDescription.className = 'item-description';
                itemDescription.innerText = item['Description'];
                textContainer.appendChild(itemDescription);

            }
        }
    }
}

    </script>
    </head>
    <body>
    <div class="shop-header">
        <h1>The Shoppe!<h1>
    </div>
    

    <div class="grid-container" id="grid-container">
    <div id="no-match-message" style="display: none;">No items match the search term.</div>
        
    </div>
    </body>
</html>