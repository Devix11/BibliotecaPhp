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

    //controllo del tipo di account in modo da utilizzare i due diversi database
    if ($_POST['profile_type'] == "admin") {
        // L'utente è un admin
        //Controllo credenziali nel database amministratori
        $query = "SELECT * FROM amministratori WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($db, $query);
        
        if($result = 0){
            $errors['email'] = "Email o Password non valide";
        } else if ($result = 1){
            header("Location: dashboard_admin.php");
            exit();
        }

    } else {
        // L'utente è un utente normale
        //controllo database utenti_registrati

        $query = "SELECT * FROM utenti_registrati WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($db, $query);

        if($result = 0){
            $errors['email'] = "Email o Password non valide";
        } else if ($result = 1){
            header("Location: dashboard_user.php");
            exit();
        }
    }





/*
    //Verifica delle credenziali
    //verifica email
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $query = "SELECT * FROM utenti_registrati WHERE email='$email'";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 0) {
            $errors['email'] = "Email non valida";
        }

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

        //check se è un account admin o utente
        /*$query = "SELECT * FROM utenti_registrati WHERE email = '$email' AND admin = 1";
        $result = mysqli_query($db, $query);*/
        //check tramite la checkbox metodo post al volo per provare
        /*
        if ($_POST['profile_type'] == "admin") {
            header("Location: dashboard_admin.php");
            exit();
        } else {
            header("Location: dashboard_user.php");
            exit();
        }/*
        if (mysqli_num_rows($result) == 1) {
            // L'utente è un admin
            header("Location: dashboard_admin.php");
            exit();
        } else {
            // L'utente è un utente normale
            header("Location: dashboard_user.php");
            exit();
        }*/
            
 /*else {
        // Autenticazione fallita
        $errors['password'] = "Credenziali non valide";
    }*/

?>