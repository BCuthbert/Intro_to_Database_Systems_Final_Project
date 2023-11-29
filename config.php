<?php
/* Database credentials. */
define('DB_SERVER', 'dbdev.cs.kent.edu');
define('DB_USERNAME', 'bcuthbe1');
define('DB_PASSWORD', '#');
define('DB_NAME', 'bcuthbe1');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
