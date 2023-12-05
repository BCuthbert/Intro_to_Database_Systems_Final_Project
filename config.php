<?php
/* Database credentials. */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', '(your_username)');
define('DB_PASSWORD', '(your_password)');
define('DB_NAME', '(your_username)');
 
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
