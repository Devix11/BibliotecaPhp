<?php

// Database configuration
$host = "localhost";
$username = "admin";
$password = "password";
$database = "dashboard_db";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Other database-related code goes here

// Close the database connection
$conn->close();
global $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');

?>