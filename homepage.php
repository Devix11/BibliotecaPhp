<!DOCTYPE html>
<html lang="it">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link rel="stylesheet" href="./homepage.css">
        <title>Benvenuto</title>
    </head>
    
    <body>
        <b><h1>Registrazione nuovo utente</h1></b>
        <form action="signup_process.php" class="signupForm" method="post">
            <label>Nome: <br><input type="text" name="name" required></label><br>
            <label>Cognome: <br><input type="text" name="surname" required></label><br>
            <label>Email: <br><input type="email" name="email" required></label><br>
            <label>Password: <br><input type="password" name="password" required></label><br>
            <button type="submit">Register</button>
        </form>
    </body>
</html>