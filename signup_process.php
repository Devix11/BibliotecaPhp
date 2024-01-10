<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
<?php
            // Stabilire la connessione al database
            $db = mysqli_connect('localhosy:3306', 'phpmyadmin', 'ciaone11!', 'biblioteca');
            // Verificare la connessione
            if (!$db) {
                die("Connessione fallita: " . mysqli_connect_error());
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (
                    empty($_POST['name']) || 
                    empty($_POST['surname']) || 
                    empty($_POST['email']) || 
                    empty($_POST['password'])
                ) 
                    //die è una funzione che termina l'esecuzione dello script
                    die("Errore: dati mancanti");

                $query = "SELECT id FROM utenti_registrati WHERE email = '$email';"
                if (mysqli_query($db, $query) != NULL){
                    echo "Utente già esistente!"
                }
            }
            //Values security-check
            $name = htmlentities($_POST['name']);
            $surname = htmlentities($_POST['surname']);
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);
            $timestamp = time();
            
            //Password to hash
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            //Query to insert data
            $query = "INSERT INTO untenti_registrati (nome, cognome, email, password, dataRegistrazione) VALUES ('$name', '$surname', '$email', '$hash', '$timestamp')";
            mysqli_query($db, $query);

         ?>
        </body>
    </html>