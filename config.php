<?php
// Database configuration
$servername = 'localhost';
$username = 'cmjzmxbk_Amolpatilofficial_Admin';
$password = 'Shiva@88988898';
$dbname = 'cmjzmxbk_digitalvyapari_DB'; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
