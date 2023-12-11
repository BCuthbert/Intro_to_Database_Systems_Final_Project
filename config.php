<?php
/* Database credentials. */
include '/users/kent/student/dsicher/phpconfig/config.inc';
 
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
