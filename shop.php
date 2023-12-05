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
    const arrow = document.getElementById("arrow");

        // Show the arrow initially
        arrow.style.display = "block";

        // Set a timeout to hide the arrow after 5 seconds
        setTimeout(function () {
            arrow.style.opacity = 0;
            // You can add other hiding animations here
        }, 5000);
        arrow.addEventListener("click", function () {
            arrow.style.display = "none";
        });
});
// Add an event listener to the search input
var debounceTimer;
document.querySelector('input[name="search"]').addEventListener('input', function () {
    // Get the current search term from the input field
    var searchTerm = this.value.toLowerCase();
    clearTimeout(debounceTimer);
    
    debounceTimer = setTimeout(function() {
        var searchTerm = document.querySelector('input[name="search"]').value.toLowerCase();

        logSearchResults(searchTerm);
    }, 1000);

    var gridItems = document.querySelectorAll('.grid-item');
    var hasMatches = false;

    gridItems.forEach(function (gridItem) {
        var itemName = gridItem.querySelector('.item-name').innerText.toLowerCase();
        var itemDescription = gridItem.querySelector('.item-description').innerText.toLowerCase();

        if (itemName.includes(searchTerm) || itemDescription.includes(searchTerm)) {
            gridItem.style.display = 'flex';
            hasMatches = true;
        } else {
            gridItem.style.display = 'none';
        }
    });

    // Display a message if there are no matches
    var noMatchMessage = document.getElementById('no-match-message');
    if (!hasMatches) {
        noMatchMessage.style.display = 'block';
    } else {
        noMatchMessage.style.display = 'none';
    }
});

function logSearchResults(searchTerm) {
    $.ajax({
    url: '/logSearchTerm.php',
    method: 'POST',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
    data:{searchTerm: searchTerm 
    },
    success: function (data) {
        console.log("Search: " + searchTerm);
    },
    error: function (xhr, status, error) {
        console.error('Error:', status, error);
    }
});

}


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
    <div id="arrow">&#8599;</div>
    

    <div class="grid-container" id="grid-container">
    <div id="no-match-message" style="display: none;">No items match the search term.</div>
        
    </div>
    </body>
</html>