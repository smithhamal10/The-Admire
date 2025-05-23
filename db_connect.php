<?php
// Database connection credentials
$host = "localhost";     
$username = "root";       
$password = "";           
$database = "admire";      

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set charset to utf8 for proper encoding
$conn->set_charset("utf8");
?>