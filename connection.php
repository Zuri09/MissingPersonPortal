<?php
$servername = "127.0.0.1:3307";
$username = "admin";
$password = "Test@12345";
$database = "missing_person";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>