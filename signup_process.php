<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
<button onclick="location.href='hompage.php'">Go back to homepage</button>
<?php
            
            // Connection to the database
            $db = mysqli_connect('localhost:3306', 'phpmyadmin', 'ciaone11!', 'biblioteca');
            // Verify the connection
            if (!$db) {
                exit("Connessione fallita: " . mysqli_connect_error());
            } else {
                echo ("Connessione avvenuta con successo");
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (
                    empty($_POST['name']) || 
                    empty($_POST['surname']) || 
                    empty($_POST['email']) || 
                    empty($_POST['password'])
                ) 
                    //die è una funzione che termina l'esecuzione dello script
                    exit("Errore: dati mancanti");

                $query = "SELECT * FROM utenti_registrati WHERE email = '$email'";
                if (mysqli_num_rows(mysqli_query($db, $query)) > 0){
                    exit("Errore: Utente gia' esistente!");
                }
            }
            //Values security-check
            $name = strip_tags(htmlentities($_POST['name']));
            $surname = strip_tags(htmlentities($_POST['surname']));
            $email = strip_tags(htmlentities($_POST['email']));
            $password = strip_tags(htmlentities($_POST['password']));
            $timestamp = time();
            
            // Password to hash
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            if(mysqli_query($db, "INSERT INTO utenti_registrati (nome, cognome, email, password, dataRegistrazione) VALUES ($name, $surname, $email, $hash, $timestamp)")){
                echo "Utente registrato correttamente";
                exit();
            } else {
                echo "Errore!";
                exit();
            }

            /*
            // Prepare an SQL statement for execution
            $stmt = mysqli_prepare($db, "INSERT INTO utenti_registrati (nome, cognome, email, password, dataRegistrazione) VALUES (?, ?, ?, ?, ?)");
            
            if ($stmt === false) {
                // Handle errors in statement preparation
                echo "Error preparing statement: ". mysqli_error($db);
                exit();
            }
            
            // Bind parameters to the prepared statement
            // "ssssi" stands for the parameters types (String, String, String, String, Integer)
            mysqli_stmt_bind_param($stmt, 'ssssi', $name, $surname, $email, $hash, $timestamp);
            
            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Utente registrato correttamente";
                exit();
            } else {
                // Handle errors in statement execution
                echo "Error executing statement: ". mysqli_stmt_error($stmt);
                exit();
            }
            
            // Close the prepared statement
            mysqli_stmt_close($stmt);
            **/
            // Close the database connection
            mysqli_close($db);
         ?>
        </body>
    </html>
