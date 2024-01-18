<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
<?php
            
            // Stabilisco la connessione col database
            $db = mysqli_connect('localhost', 'root', '', 'biblioteca');
            // Controllo la validità della connessione
            if (!$db) {
                exit("<br><h3 style='color:Tomato;'>Connessione fallita: " . mysqli_connect_error() . "</h3>");
            }

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
                exit();
            } else {
                // Gestisco gli errori dell'esecuzione
                echo "<br><h3 style='color:Tomato;'>Error executing statement: ". mysqli_stmt_error($stmt) . "</h3>";
                exit();
            }
            
            // Chiudo la dichiarazione
            mysqli_stmt_close($stmt);
        
            // Chiudo la connessione col database
            mysqli_close($db);
         ?>
         <button onclick="location.href='homepage.php'">Torna alla homepage</button>
        </body>
    </html>
