<?php
    session_start();

    # Cancella tutte le variabili di sessione
    $_SESSION = array();

    # Distruggi la sessione
    session_destroy();

    # Reindirizza alla pagina di login
    echo "<script>" . "window.location.href='./login.php';" . "</script>";
    exit;
?>