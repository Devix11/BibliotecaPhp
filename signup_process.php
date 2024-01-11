<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
<button onclick="location.href='homepage.php'">Go back to homepage</button>
<?php
            // Stabilire la connessione al database
            $db = mysqli_connect('localhost:3351', 'phpmyadmin', 'ciaone11!', 'biblioteca');
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

                $query = "SELECT * FROM utenti_registrati WHERE email = '$email'";
                if (mysqli_num_rows(mysqli_query($db, $query)) > 0){
                    echo "Errore: Utente gia' esistente!" ;
                }
            }
            //Values security-check
            $name = Strip_tags(htmlentities($_POST['name']));

            $surname = Strip_tags(htmlentities($_POST['surname']));

            $email = Strip_tags(htmlentities($_POST['email']));

            $password = Strip_tags(htmlentities($_POST['password']));

            $timestamp = time();
            
            //Password to hash
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            //Query to insert data
            $query = "INSERT INTO untenti_registrati (nome, cognome, email, password, dataRegistrazione) VALUES ($name, $surname, $email, $hash, $timestamp)";

            if(mysqli_query($conn, $query)){  

                echo "Utente registrato correttamente";  
               
               }else{  
               
               echo "Error: ". mysqli_error($conn);  
               
               }  
               
               mysqli_close($conn);  



         ?>
        </body>
    </html>