<?php
ini_set('display_errors', 0);

// Enable error logging
ini_set('log_errors', 1);


// Set the error reporting level
error_reporting(E_ALL);
$DBhostname = getenv("SQLHOSTNAME");
$usersDB = getenv("CSC130DBNAME");
$DBusername = getenv("CSC130DBUSER");
$DBpassword = getenv("CSC130DBPASS");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_start();
    
    $searchTerm = $_POST['searchTerm'];
    

    
    try{
        $databaseConnection = mysqli_connect($DBhostname, $DBusername, $DBpassword, $usersDB);
        if ($databaseConnection->connect_error) {
            http_response_code(500);
            ob_flush();
            throw new Exception("Database Connection Error, Error No.: ".$databaseConnection->connect_errno." | ".$databaseConnection->connect_error);
        }

        $insertUserSearchQuery = mysqli_prepare($databaseConnection, "INSERT INTO `Search History` (`Search`) VALUES (?)");
        mysqli_stmt_bind_param($insertUserSearchQuery, "s", $searchTerm);
        if(mysqli_stmt_execute($insertUserSearchQuery) === TRUE){
            mysqli_stmt_close($insertUserSearchQuery);
            $databaseConnection->close();
            http_response_code(200);
            ob_flush();
            
            exit();
        } else{
            http_response_code(500);
            mysqli_stmt_close($insertUserSearchQuery);
            $databaseConnection->close();
            ob_flush();
            exit();
        }        
    }catch(Exception $e){
        http_response_code(500);
        echo "Internal Server Error: " . $e->getMessage();
        ob_flush();
        exit();
    }     
}else{
    http_response_code(501);
    ob_flush();
    exit();
}

?>