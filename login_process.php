<?php
    session_start();

    // Verifica delle credenziali e autenticazione
    // Utilizza password_verify per verificare la password hash

    // Se l'autenticazione è riuscita
    $_SESSION['user_id'] = $user_id; // Imposta l'ID dell'utente in sessione
    header("Location: hompage.php");
    exit();
?>