<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <title>Registration</title>
    </head>
    <body>
        <?php
        // Stabilisco la connessione col database
        ini_set('display_errors', 1);
        // Stabilisco la connessione col database
        $db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');
        // Verifica se la connessione è attiva
        if (mysqli_connect_error()) {
            die("Errore nella connessione al database: " . mysqli_connect_error());
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['email']) || empty($_POST['password'])) {
                exit("<br><h3 style='color:Tomato;'>Errore: dati mancanti!</h3>");
            }

            // Pulisco i valori in ingresso
            $email = strip_tags(htmlentities($_POST['email']));
            $password = strip_tags(htmlentities($_POST['password']));
            $type = $_POST['profile_type']; //Non serve pulire il valore di una select

            if ($type == "admin") {
                verify($db, $email, $password, "admin");
            } else {
                verify($db, $email, $password, "user");
            }
        }

        //Prima del processo di login controllo se c'è un cookie per saltare il sistema di login
        if (isset($_COOKIE["id"])) {
            $id = $_COOKIE["id"];
            $query = "SELECT * FROM utenti_registrati WHERE id = '$id'";
            if (mysqli_num_rows(mysqli_query($db, $query)) > 0) {
                if (password_verify($password, mysqli_fetch_assoc(mysqli_query($db, $query))['password'])){
                    if (mysqli_fetch_assoc(mysqli_query($db, $query))['adm'] == "admin") {
                        header("Location: dashboard_admin.php");
                    } else {
                        header("Location: dashboard_user.php");
                    }
                }
            }
        }

        // Funzione per il controllo del login
        function verify($db, $email, $password, $type) {
            // Preparo la dichiarazione per ottenere la password criptata e il tipo di account
            $stmt = mysqli_prepare($db, "SELECT password, adm FROM utenti_registrati WHERE email = ?");

            if ($stmt === false) {
                // Gestisco gli errori nella dichiarazione
                echo "<br><h3 style='color:Tomato;'>Error preparing statement: " . mysqli_error($db) . "</h3>";
                exit;
            }

            // Lego i parametri alla dichiarazione precedente
            mysqli_stmt_bind_param($stmt, 's', $email);

            // Eseguo la dichiarazione
            if (mysqli_stmt_execute($stmt)) {
                // Lego il risultato a delle variabili
                mysqli_stmt_bind_result($stmt, $hashedPassword, $storedType);

                mysqli_stmt_fetch($stmt);

                // Verifico la password della form con la password dell'account criptata e controllo il tipo di utente
                if (password_verify($password, $hashedPassword) && $storedType === $type) {
                    // Salvo i valori nella sessione
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["password"] = $password;
                    if ($_POST["remember_me"]){
                        // Creo il cookie per mantenere l'utente loggato
                        $cookie_token = bin2hex(random_bytes(16));
                        $expires_at = date('Y-m-d H:i:s', strtotime('+7 days'));
                        //faccio una query per ottenere l'id dell'utente appena registrato
                        $query = "SELECT * FROM utenti_registrati WHERE email = '$email'";
                        $result = mysqli_query($db, $query);
                        $user_id = mysqli_fetch_assoc($result)['id'];

                        // Preparo la dichiarazione per inserire il cookie nel database
                        $cookie_stmt = mysqli_prepare($db, "INSERT INTO user_cookies (user_id, cookie_token, expires_at, password) VALUES (?, ?, ?, ?)");

                        if ($cookie_stmt === false) {
                            // Gestisco gli errori nella dichiarazione
                            echo "<br><h3 style='color:Tomato;'>Error preparing statement: ". mysqli_error($db) . "</h3>";
                            exit();
                        }
                        

                        // Lego i parametri alla dichiarazione precedente
                        mysqli_stmt_bind_param($cookie_stmt, 'isss', $user_id, $cookie_token, $expires_at, $password);

                        // Eseguo la dichiarazione
                        if (mysqli_stmt_execute($cookie_stmt)) {
                            setcookie("id", $user_id, time() + 86400, "/");
                            header("Location: dashboard_user.php");
                        } else {
                            // Gestisco gli errori dell'esecuzione
                            echo "<br><h3 style='color:Tomato;'>Error executing statement: ". mysqli_stmt_error($cookie_stmt) . "</h3>";
                            exit();
                        }


                        // Chiudo la dichiarazione
                        mysqli_stmt_close($stmt);
                    }

                    // La password è valida e il tipo di utente è corretto
                    if ($type == "admin") {
                        header("Location: dashboard_admin.php");

                    } else {
                        header("Location: dashboard_user.php");
                    }
                    exit();
                } else {
                    // Gestico le informazioni non valide
                    echo "<br><h3 style='color:Tomato;'>Informazioni inserite non valide. ( Email, password o tipo di utente )</h3>";
                }
            } else {
                // Gestisco gli errori dell'esecuzione
                echo "<br><h3 style='color:Tomato;'>Error executing statement: " . mysqli_stmt_error($stmt) . "</h3>";
            }
            // Chiudo la dichiarazione
            mysqli_stmt_close($stmt);
        }
        ?>
        <button onclick="location.href='homepage.php'">Torna alla homepage</button>
    </body>
</html>