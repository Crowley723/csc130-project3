

<link rel="stylesheet" href="/design.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <div class="topnav" id="myTopnav">
    <a href="/"<?php if($_SERVER['REQUEST_URI'] == "/index.php" or $_SERVER['REQUEST_URI'] == "/"){echo " class=\"active\"";} ?>>Welcome</a>
    <a href="/shop.php"<?php if($_SERVER['REQUEST_URI'] == "/shop.php" or $_SERVER['REQUEST_URI'] == "/shop.php"){echo " class=\"active\"";} ?>>Shop</a>
    <a href="/account/login.php"<?php if($_SERVER['REQUEST_URI'] == "/account/login.php"){echo " class=\"split active\"";}else echo " class=\"split\"" ?>>Login</a>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="showHamburgerMenu()">&#9776;</a>
    <script>
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
