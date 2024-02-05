<!DOCTYPE html>
<html>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./signup.css">
        <title>Conferma Eliminazione Account</title>
    </head>
    <body>
        <form action="dashboard_user.php" method="post">
            <h3>Sei sicuro di voler eliminare l'account?</h3>
            <input type="submit" name="confirmDelete" value="Si">
            <input type="submit" name="cancelDelete" value="No">
        </form>
    </body>
</html>
