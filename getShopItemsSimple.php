<?php
$DBhostname = getenv("SQLHOSTNAME");
$usersDB = getenv("CSC130DBNAME");
$DBusername = getenv("CSC130DBUSER");
$DBpassword = getenv("CSC130DBPASS");
session_start();

if($_SERVER["REQUEST_METHOD"] == "GET") {
    ob_start();
    //echo " Get Request!";
    
    try{
        $databaseConnection = mysqli_connect($DBhostname, $DBusername, $DBpassword, $usersDB);
        if ($databaseConnection ->connect_error) {
            throw new Exception("Database Connection Error, Error No.: ".$databaseConnection->connect_errno." | ".$databaseConnection->connect_error);
        }

        $getShopItemsQuery = "SELECT * FROM `Shop`";
        //echo " Before postResult";
        //echo $getShopItemsQuery;
        if($postsResult = $databaseConnection->query($getShopItemsQuery)){
            //echo " Inside postResult";
            $outputData = array();
            while($row = $postsResult->fetch_assoc()){
                $row_ID = $row["ID"];
                $row_Name = $row["Name"];
                $outputData[] = array(
                    'ID' => $row_ID,
                    'Name' => $row_Name,
                );
            }

        
        header('Content-Type: application/json');
        echo json_encode($outputData, JSON_THROW_ON_ERROR);

        }
        //echo "After postResult";
        $databaseConnection->close();
        ob_flush();
        exit();
        
    }catch(Exception $e){
        echo "Internal Server Error: " . $e->getMessage();
        ob_flush();
        exit();
    }
        
}else{
    http_response_code(400);
    ob_flush();
    exit();
}


?>