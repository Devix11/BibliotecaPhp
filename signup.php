<!-- Sessione -->
<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit();
    }
?>

<!-- Form di signup -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrazione</title>
    </head>
    <body>
        <h1>Registrazione nuovo utente</h1>
        <form action="signup_process.php" method="post">
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Surname: <input type="text" name="surname" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Password: <input type="password" name="password" required></label><br>
            <button type="submit">Register</button>
        </form>
    </body>
</html>