

<link rel="stylesheet" href="/design.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <div class="topnav" id="myTopnav">
    <a href="/"<?php if($_SERVER['REQUEST_URI'] == "/index.php" or $_SERVER['REQUEST_URI'] == "/"){echo " class=\"active\"";} ?>>Welcome</a>
    <a href="/shop.php"<?php if($_SERVER['REQUEST_URI'] == "/shop.php" or $_SERVER['REQUEST_URI'] == "/shop.php"){echo " class=\"active\"";} ?>>Shop</a>
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</a>
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
    <div class="login">
    <div id="id01" class="modal">
      <form class="modal-content animate" action="/action_page.php" method="post">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">%times;</span>
          <img src="login_silhouette.png" alt="Avatar" class="avatar">
        </div>
        <div class="container">
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" required>

          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>

          <button type="submit">Login</button>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
        </div>
        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
      </form>
    </div>
    <script>
      var modal = document.getElementById('id01');
      window.onclick = function(event) {
        if (event.target == modal){
          modal.style.display = "none";
        }
      }
    </script>
  </div>
  </div>
