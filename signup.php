<!-- Sessione -->
<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit();
    }
?>

<!-- Form di login -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
    </head>
    <body>
        <h1>Register new user</h1>
        <form action="registration_process.php" method="post">
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Surname: <input type="text" name="surname" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Password: <input type="password" name="password" required></label><br>
            <button type="submit">Register</button>
        </form>
        <?php
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (
                    empty($_POST['name']) || 
                    empty($_POST['surname']) || 
                    empty($_POST['email']) || 
                    empty($_POST['password'])
                ) 
                    //die è una funzione che termina l'esecuzione dello script
                    die("Errore: dati mancanti");
            }
            $name = htmlentities($_POST['name']);
            $surname = htmlentities($_POST['surname']);
            $email = htmlentities($_POST['email']);
            $password = htmlentities($_POST['password']);

            $hash = password_hash($password, PASSWORD_DEFAULT);

         ?>
    </body>
</html>
