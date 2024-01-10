<?php
    // Inizializza la sessione
session_start();

    // Verifica delle credenziali e autenticazione
    // Utilizza password_verify per verificare la password hash

    // Se l'autenticazione è riuscita
    $_SESSION['user_id'] = $user_id; // Imposta l'ID dell'utente in sessione
    // Salvo le credenziali del db nella variabile $db
    // Stabilire la connessione al database
    $db = mysqli_connect('localhost:3351', 'phpmyadmin', 'ciaone11!', 'biblioteca');

    // Verificare la connessione
    if (!$db) {
    die("Connessione fallita: " . mysqli_connect_error());
    }

    //Verifica delle credenziali
    //verifica email
    function checkemail(){
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $query = "SELECT * FROM utenti_registrati WHERE email='$email'";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 0) {
            $errors['email'] = "Email non valida";
        }
    }

    checkemail();

    function checkpass(){
    if (password_verify($_POST['password'], $user['password'])) {
        // Autenticazione riuscita
        $_SESSION['user_id'] = $user['id'];
        /*if (isset($_POST['remember_me'])) {
            // Imposta un cookie per ricordare l'utente
            setcookie('remember_user', $user['id'], time() + (86400 * 30), "/"); // Imposta un cookie che scade dopo 30 giorni

            // Salva il token di autenticazione nel database
            $token = bin2hex(random_bytes(64));
            $token_hash = password_hash($token, PASSWORD_DEFAULT);
            $expires = date('Y-m-d H:i:s', time() + (86400 * 30)); // Imposta la data di scadenza a 30 giorni dal momento attuale
            $query = "INSERT INTO auth_tokens (user_id, token_hash, expires) VALUES ('$user_id', '$token_hash', '$expires')";
            mysqli_query($db, $query);
        }*/
    } else {
        // Autenticazione fallita
        $errors['password'] = "Credenziali non valide";
    }
}

checkpass();

    header("Location: hompage.php");
    exit();

?>