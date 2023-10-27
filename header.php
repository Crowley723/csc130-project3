<link rel="stylesheet" href="/design.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
  <div class="topnav" id="myTopnav">
    <a href="/"<?php if($_SERVER['REQUEST_URI'] == "/index.php" or $_SERVER['REQUEST_URI'] == "/"){echo " class=\"active\"";} ?>>Welcome</a>
    <a href="/shop.php"<?php if($_SERVER['REQUEST_URI'] == "/shop.php" or $_SERVER['REQUEST_URI'] == "/shop.php"){echo " class=\"active\"";} ?>>Shop</a>
    <?php
      session_start();
      if(isset($_SESSION['username'])){//if currently logged in, show a "Logout" button
        echo '<form action="logout.php" method="post">';
        echo '<button id="modalNavButton" type="submit">Logout</button>';
        echo '</form>';
      } else{ //show Login button
        echo '<button id="modalNavButton" onclick="document.getElementById(\'id01\').style.display=\'block\'" style="width:auto;" class="split">Login</a>';
      }
    
    ?>
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

  <div id="id01" class="modal">
    <form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <img src="/assets/login_silhouette.png" alt="Avatar" class="avatar">
      </div>
      <div class="container">
        <div id="error-message" style="color:red;"></div>
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
        <span class="password"><a href="#">Forgot password?</a></span>
      </div>
    </form>
  </div>
  <script>
  var modal = document.getElementById('id01');
  window.onclick = function(event) { //allow clicks outside the login modal to exit the modal
    if (event.target == modal){
      modal.style.display = "none";
    }
  }
  var button = document.getElementById("modalNavButton");
  if(modal.style.display == "none"){ //sets active color to login button :)
    button.style.backgroundColor = "#3caf83"
  } else{
    button.style.backgroundColor = "#555"
  }
  document.getElementById('error-message').innerHTML = '<?php echo addslashes($error); ?>';
  </script>

<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


session_start();

$servername = getenv('SQLHOSTNAME');
$dbname = getenv('USERDBNAME');
$dbusername = getenv('USERDBUSER');
$dbpassword = getenv('USERDBPASS');


$username = $password = $rememberme = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST['username']);
  $password = test_input($_POST['password']);
  $rememberme = test_input($_POST['remember']);

  $databaseConnection = new mysqli($servername, $dbusername, $dbpassword, $dbname);
  if ($databaseConnection->connect_error) {
    die("Connection failed: " . $databaseConnection->connect_error);
  } 

  $findUserQuery = $mysqli->prepare("Select `ID`, `Username`, `HashedPassword` FROM users WHERE `Username` = ?");
  $findUserQuery->bind_param("s", $username);
  
  if($findUserQuery->execute()) {
    $findUserQuery->store_result();
    if($findUserQuery->num_rows > 0) {
      $findUserQuery->bind_result($row_id, $row_username, $row_hashedPassword);
      $findUserQuery->fetch();

      if(password_verify($password, $row_hashedPassword)) {
        $_SESSION['logged-in'] = true;
        $_SESSION['username'] = $row_username;
        $_SESSION['login-expire'] = time() + 28800;//8 hours in seconds (unix time)
        $_SESSION['remember-me'] = $rememberme;
      } else{
        //passwords don't match
        $error = "Invalid username or password.";
      }
    }
  } else {
    //username not found
    $error = "Invalid username or password.";


  }
  $findUserQuery->close();
}


  
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

