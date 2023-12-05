<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="/design.css">
    <?php include "./header.php" ?>
    
</head>
<style>
    .get-started{
        text-decoration: none;
        padding: 8px 16px 8px;
        background-color: #2196F3;
        color: white;
    }

</style>

<body>
    <div class="body-text">
        <header class="welcome-head">
            <h1>Welcome to the Store!</h1>
            <p>For the group project, search for stuff that may or may not be in a pet store.</p>
            <a class="get-started" href="/shop.php">Click Here to Get Started</a>
            <?php echo "<p>Hello World!</p>";?>
        </header>
    </div>
    <footer>
        
        <p>&copy; 2023. Its possible this is the footer.</p>
    </footer>
</body>
</html>
