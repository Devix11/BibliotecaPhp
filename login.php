<!-- Sessione -->
<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit();
    }

     //Prima del processo di login controllo se c'è un cookie per saltare il sistema di login
    if (isset($_COOKIE["value"])) {
        $cookie_token = strip_tags(html_entities($_COOKIE["value"]));
        $time = time();
        $query = "SELECT * FROM utenti_registrati WHERE (SELECT user_id FROM user_cookies) = '$id' AND (SELECT expires_at FROM user_cookies) >= '$time'";
        if (mysqli_num_rows(mysqli_query($db, $query)) > 0) {
            if (password_verify($password, mysqli_fetch_assoc(mysqli_query($db, $query))['password'])){
                if (mysqli_fetch_assoc(mysqli_query($db, $query))['adm'] == "admin") {
                    header("Location: dashboard_admin.php");
                } else {
                    header("Location: dashboard_user.php");
                }
            }
        }
    }
?>

<!-- Form di login -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./login.css">
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>
        <!-- Sezione di select per il tipo di profilo, user o admin -->
        <form action="login_process.php" class="form" method="post">
            <label>Tipo di profilo:
                <select name="profile_type">
                    <option value="user">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User</option>
                    <option value="admin">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin</option>
                </select>
            </label><br>
            <label>Email: <br><input type="email" name="email" required></label><br>
            <label>Password: <br><input type="password" name="password" required></label>
            <label>
                <input type="checkbox" name="remember_me"> Remember Me </input>
            </label><br>

            <button type="submit">Accedi</button>
        </form>
    </body>
</html>

