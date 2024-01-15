<?php
    // Inizializza la sessione
session_start();

    // Verifica delle credenziali e autenticazione
    // Utilizza password_verify per verificare la password hash

    // Se l'autenticazione è riuscita
    $_SESSION['user_id'] = $user_id; // Imposta l'ID dell'utente in sessione
    // Salvo le credenziali del db nella variabile $db
    // Stabilire la connessione al database
    $db = mysqli_connect('localhost:3306', 'phpmyadmin', 'ciaone11!', 'biblioteca');

    // Verificare la connessione
    if (!$db) {
    exit("Connessione fallita: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            empty($_POST['email']) || 
            empty($_POST['password']) ||
            empty($_POST['profile_type'])
        ) 
            //die è una funzione che termina l'esecuzione dello script
            exit("Errore: dati mancanti");
    }

    //Values security-check
    $email = strip_tags(htmlentities($_POST['email']));
    $password = strip_tags(htmlentities($_POST['password']));
    
    // Password to hash
    $hash = password_hash($password, PASSWORD_DEFAULT);

    //controllo del tipo di account in modo da utilizzare i due diversi database
    if ($_POST['profile_type'] == "admin") {
        // L'utente è un admin
        //Controllo credenziali nel database amministratori - Ricorda che sul db i nostri utenti hanno password senza hash
        (
        // Prepare an SQL statement for execution
        $stmt = mysqli_prepare($db, "SELECT * FROM utenti_registrati WHERE email = ? AND adm = ?");
            
        if ($stmt === false) {
            // Handle errors in statement preparation
            echo "Error preparing statement: ". mysqli_error($db);
            exit;
        }
        
        // Bind parameters to the prepared statement
        // "ss" stands for the parameters types (String, String)
        mysqli_stmt_bind_param($stmt, 'sb', $email, true);
        
        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            verify($password, $email, "Location: dashboard_admin.php");
            exit();
        } else {
            // Handle errors in statement execution
            echo "Email o password non valide: ". mysqli_stmt_error($stmt);
        })

        /*
        if($result = 0){
           $errors['email'] = "Email o Password non valide";
        } else if ($result = 1){
            header("Location: dashboard_admin.php");
            exit();
        }
        **/

    } else {
        // L'utente è un utente normale
        //controllo database utenti_registrati

        (
            // Prepare an SQL statement for execution
            $stmt = mysqli_prepare($db, "SELECT * FROM utenti_registrati WHERE email = ? AND adm = ?");
                
            if ($stmt === false) {
                // Handle errors in statement preparation
                echo "Error preparing statement: ". mysqli_error($db);
                exit;
            }
            
            // Bind parameters to the prepared statement
            // "ss" stands for the parameters types (String, String)
            mysqli_stmt_bind_param($stmt, 'sb', $email, false);
            
            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                verify($password, $email, "Location: dashboard_user.php");
                exit();
            } else {
                // Handle errors in statement execution
                echo "Email o password non valide: ". mysqli_stmt_error($stmt);
            })
        /*
        if($result = 0){
            $errors['email'] = "Email o Password non valide";
        } else if ($result = 1){
            header("Location: dashboard_user.php");
           exit();
        }
        **/
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

    
        function verify($password, $email, $dashboard){
        
            // Prepare the statement to retrieve the hashed password
            $stmt = mysqli_prepare($db, "SELECT password FROM utenti_registrati WHERE email = ?");
            
            if ($stmt === false) {
                // Handle errors in statement preparation
                echo "Error preparing statement: " . mysqli_error($db);
                exit;
            }
            
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, 's', $email);
            
            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Bind the result
                mysqli_stmt_bind_result($stmt, $hashedPassword);
                
                // Fetch the result
                mysqli_stmt_fetch($stmt);
                
                // Verify the provided password against the hashed password
                if (password_verify($password, $hashedPassword)) {
                    // Password is valid, redirect to dashboard_user.php
                    header($dashboard);
                    exit();
                } else {
                    // Handle invalid password
                    echo "Email o password non valide.";
                    
                }
            } else {
                // Handle errors in statement execution
                echo "Error executing statement: " . mysqli_stmt_error($stmt);
            }
        }
        

    
?>