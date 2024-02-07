<?php
  //visualizza errori
  ini_set('display_errors', 1);
  define("DB_SERVER", "localhost");
  define("DB_USERNAME", "phpmyadmin");
  define("DB_PASSWORD", "ciaone11");
  define("DB_NAME", "biblioteca2");

  # Connessione
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  # Controllo connessione
  if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>