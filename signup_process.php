<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link rel="stylesheet" href="./signup.css">
        <title>Registrazione</title>
    </head>
    <body>
        <?php
        //display errors
        ini_set('display_errors', 1);
        // Stabilisco la connessione col database
        include_once "database.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                empty($_POST['name']) || 
                empty($_POST['surname']) || 
                empty($_POST['email']) || 
                empty($_POST['password'])
            ) 
                exit("<br><h3 style='color:Tomato;'>Errore: dati mancanti!</h3>");
        }


        // Pulisco i valori in ingresso
        $name = strip_tags(htmlentities($_POST['name']));
        $surname = strip_tags(htmlentities($_POST['surname']));
        $email = strip_tags(htmlentities($_POST['email']));
        $password = strip_tags(htmlentities($_POST['password']));
        $query = "SELECT * FROM utenti_registrati WHERE email = '$email'";
            if (mysqli_num_rows(mysqli_query($db, $query)) > 0){
                exit("<br><h3 style='color:Tomato;'>Errore: Utente gia' esistente!</h3>");
            }
        
        // Cripto la password prima di salvarla nel database
        $hash = password_hash($password, PASSWORD_DEFAULT);
        

        // Preparo la dichiarazione per ottenere la password criptata e il tipo di account
        $stmt = mysqli_prepare($db, "INSERT INTO utenti_registrati (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
        
        if ($stmt === false) {
            // Gestisco gli errori nella dichiarazione
            echo "<br><h3 style='color:Tomato;'>Error preparing statement: ". mysqli_error($db) . "</h3>";
            exit();
        }
        
        // Lego i parametri alla dichiarazione precedente
        // "ssssi" sta per i tipi di parametri (String, String, String, String, Integer)
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $surname, $email, $hash);

        // Eseguo la dichiarazione
        if (mysqli_stmt_execute($stmt)) {
            echo "<br><h3>Utente registrato correttamente</h3>";

            // Creo il cookie per mantenere l'utente loggato
            $cookie_token = bin2hex(random_bytes(16));
            $expires_at = date('Y-m-d H:i:s', strtotime('+30 days'));
            //faccio una query per ottenere l'id dell'utente appena registrato
            $query = "SELECT * FROM utenti_registrati WHERE email = '$email'";
            $result = mysqli_query($db, $query);
            $user_id = mysqli_fetch_assoc($result)['id'];

            // Preparo la dichiarazione per inserire il cookie nel database
            $cookie_stmt = mysqli_prepare($db, "INSERT INTO user_cookies (user_id, cookie_token, expires_at) VALUES (?, ?, ?)");

            if ($cookie_stmt === false) {
                // Gestisco gli errori nella dichiarazione
                echo "<br><h3 style='color:Tomato;'>Error preparing statement: ". mysqli_error($db) . "</h3>";
                exit();
            }
            

            // Lego i parametri alla dichiarazione precedente
            mysqli_stmt_bind_param($cookie_stmt, 'iss', $user_id, $cookie_token, $expires_at);

            // Eseguo la dichiarazione
            if (mysqli_stmt_execute($cookie_stmt)) {
                header("Location: dashboard_user");
            } else {
                // Gestisco gli errori dell'esecuzione
                echo "<br><h3 style='color:Tomato;'>Error executing statement: ". mysqli_stmt_error($cookie_stmt) . "</h3>";
                exit();
            }


        // Chiudo la dichiarazione
        mysqli_stmt_close($stmt);
        } else {
            // Gestisco gli errori dell'esecuzione
            echo "<br><h3 style='color:Tomato;'>Error executing statement: ". mysqli_stmt_error($stmt) . "</h3>";
            exit();
        }

        // Chiudo la connessione col database
        mysqli_close($db);
        ?>
        <button onclick="location.href='homepage.php'">Torna alla homepage</button>
    </body>
</html>


