<?php

$DBhostname = getenv("SQLHOSTNAME");
$usersDB = getenv("CSC130DBNAME");
$DBusername = getenv("CSC130DBUSER");
$DBpassword = getenv("CSC130DBPASS");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    ob_start();    
    $databaseConnection = mysqli_connect($DBhostname, $DBusername, $DBpassword, $usersDB);

    if ($databaseConnection->connect_error) {
        http_response_code(500);
        ob_flush();
        throw new Exception("Database Connection Error, Error No.: ".$databaseConnection->connect_errno." | ".$databaseConnection->connect_error);
    }

    $getSearchHistoryQuery = mysqli_prepare($databaseConnection, "SELECT * FROM `Search History`");
    $data = array();

    if ($getSearchHistoryQuery->execute() === TRUE) {
        $searchHistoryResult = mysqli_stmt_get_result($getSearchHistoryQuery);
        
        while($row = mysqli_fetch_assoc($searchHistoryResult)){
            $row_searchTerm = $row["Search"];
            $row_timestamp = $row["Timestamp"];
            $data[] = array(
                'Search' => $row_searchTerm,
                'Timestamp' => $row_timestamp
            );
        }
        mysqli_stmt_close($getSearchHistoryQuery);
        $databaseConnection->close();
        header('Content-Type: application/json');
        echo json_encode($data, JSON_THROW_ON_ERROR);       
    } else {
        mysqli_stmt_close($getSearchHistoryQuery);
        $databaseConnection->close();
        echo "Error: " . $getSearchHistoryQuery->error;
        http_response_code(500);
        ob_flush();
        exit();
    }
}

?>