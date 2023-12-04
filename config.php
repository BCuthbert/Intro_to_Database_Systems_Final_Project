<?php
/* Database credentials. */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'dsicher');
define('DB_PASSWORD', '8XWytyw2');
define('DB_NAME', 'dsicher');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!isset($_SESSION["demoDate"])){
    $_SESSION["demoDate"] = mktime(12,0,0,11,13,2023);
}


// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
