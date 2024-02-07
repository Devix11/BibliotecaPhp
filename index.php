<?php
  // visualizza errori
  ini_set('display_errors', 1);
  # Inizializza la sessione
  session_start();

  # Se l'utente non ha effettuato l'accesso, reindirizzalo alla pagina di login
  if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
    echo "<script>" . "window.location.href='./login.php';" . "</script>";
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema di accesso utente</title>
    <link rel="stylesheet" href="./main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
  </head>
  <body>
    <div class="container">
      <div class="alert alert-success my-5">
        Benvenuto! Hai effettuato correttamente l'accesso al tuo account.
      </div>
      <!-- Profilo utente -->
      <div class="row justify-content-center">
        <div class="col-lg-5 text-center">
          <h4 class="my-4">Ciao, <?= htmlspecialchars($_SESSION["username"]); ?></h4>
          <a href="./dashboard_user.php" class="btn btn-primary">Dashboard Utente</a>
          <a href="./dashboard_admin.php" class="btn btn-primary">Dashboard Admin (Permessi richiesti)</a>
          <a href="./logout.php" class="btn btn-primary">Esci</a>
        </div>
      </div>
    </div>
  </body>
</html>