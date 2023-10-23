<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/design.css">
        <?php include "./header.php" ?>
        
        <title>Login</title>
    </head>
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get the values from the form
    var uid = document.getElementById('uid').value;
    var password = document.getElementById('password').value;

    // Send the data to the backend (for example, using fetch or XMLHttpRequest)
    fetch('/handleLogin.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            uid: uid,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response from the backend
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
    </script>
    <body>
    <h1>Login Page</h1>
    <form id="loginForm">
        <div>
            <label for="uid">Username:</label>
            <input type="text" id="uid" name="uid" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>