<!-- Form di signup -->
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/signup.css">
        <title>Registrazione</title>
    </head>
    <body>
        <h1>Registrazione nuovo utente</h1>
        <form action="signup_process.php" class="signupForm" method="post">
            <label>Name: <br><input type="text" name="name" required></label><br>
            <label>Surname: <br><input type="text" name="surname" required></label><br>
            <label>Email: <br><input type="email" name="email" required></label><br>
            <label>Password: <br><input type="password" name="password" required></label><br>
            <button type="submit">Register</button>
        </form>

        <?php
            include_once("./style/fonts.php");
        ?>
    </body>
</html>