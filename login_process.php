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
ini_set('display_errors', 1);
$db = mysqli_connect('localhost', 'phpmyadmin', 'ciaone11', 'biblioteca');


// Controllo la validità della connessione
if (!$db) {
    exit("<br><h3 style='color:Tomato;'>Connessione fallita: " . mysqli_connect_error() . "</h3>");
}

//Prima del processo di login controllo se c'è un cookie per saltare il sistema di login
if (isset($_COOKIE['login'])) {
    $email = $_COOKIE['login'];
    $query = "SELECT * FROM utenti_registrati WHERE email = '$email'";
    if (mysqli_num_rows(mysqli_query($db, $query)) > 0) {
        if (mysqli_fetch_assoc(mysqli_query($db, $query))['adm'] == 1) {
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard_user.php");
        }
    }
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
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;

            // La password è valida e il tipo di utente è corretto
            if ($profile_type == "admin") {
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