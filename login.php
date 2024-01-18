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
    <link rel="stylesheet" href="./style.css">
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <!--
        Sezione di select per il tipo di profilo, user o admin
        -->
        

        <form action="login_process.php" class="form" method="post">
            <label>Tipo di profilo:
            <select name="profile_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </label><br>
            <label>Email: <br><input type="text" name="email" required></label><br>
            <label>Password: <br><input type="password" name="password" required></label><br>
            <label>
                <input type="checkbox" name="remember_me"> Remember Me
            </label><br>

            <button type="submit">Accedi</button>
        </form>
    </body>
</html>