<head>
<link rel="stylesheet" href="/design.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <div class="topnav" id="myTopnav">
    <a href="/"<?php if($_SERVER['REQUEST_URI'] == "/index.php" or $_SERVER['REQUEST_URI'] == "/"){echo " class=\"active\"";} ?>>Welcome</a>
    <a href="/shop.php"<?php if($_SERVER['REQUEST_URI'] == "/shop.php" or $_SERVER['REQUEST_URI'] == "/shop.php"){echo " class=\"active\"";} ?>>Shop</a>
    <div class="search-container">
      <?php if($_SERVER['REQUEST_URI'] == "/shop.php"){
        echo "<form action=\"#\">
                <input type=\"text\" style=\"margin-right: 10px;\" placeholder=\"Search..\" name=\"search\" onkeypress=\"disableEnterKey(event)\">
              </form>";
      }
      ?>    
  </div>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="showHamburgerMenu()">&#9776;</a>
    <script>
      function disableEnterKey(event) {
    if (event.key === "Enter" || event.keyCode === 13) {
        event.preventDefault();
    }
}
      function showHamburgerMenu() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
          x.className += " responsive";
        } else {
          x.className = "topnav";
        }
      }
    </script>
  </div>
<head>

 