<?php

// Database configuration
$host = "localhost";
$username = "admin";
$password = "password";
$database = "dashboard_db";

// Stabilisco la connessione col database
global $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
//s Controllo la validità della connessione
if (!$db) {
    exit("<br><h3 style='color:Tomato;'>Connessione fallita: " . mysqli_connect_error() . "</h3>");
}
?>